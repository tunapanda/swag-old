<?php

	require_once __DIR__."/../utils/FileUtil.php";
	require_once __DIR__."/../../extern/hybridauth/hybridauth/Hybrid/Auth.php";
	require_once __DIR__."/../../extern/hybridauth/hybridauth/Hybrid/Endpoint.php";

	/**
	 * Controller class.
	 */
	class MainController extends WebController {

		private $config;

		/**
		 * Constructor.
		 */
		function MainController() {
			session_start();

			$this->method("main");
			$this->method("logout");
			$this->method("showmap")->args("filename");
			$this->method("getmap")->args("filename");
			$this->method("login")->args("username","password");
			$this->method("hybridlogin")->args("provider");
			$this->setDefaultMethod("main");

			$this->loadConfig();
		}

		/**
		 * Load configuration.
		 */
		private function loadConfig() {
			$configFileName=__DIR__."/../../config.ini";

			if (!file_exists($configFileName))
				exit("Config file does not exists, looking for: ".realpath(__DIR__."/../../")."/config.ini");

			$this->config=parse_ini_file($configFileName);
		}

		/**
		 * Login using hybrid auth.
		 */
		function hybridlogin($provider) {
			if (isset($_REQUEST['hauth_start']) || isset($_REQUEST['hauth_done'])) {
				Hybrid_Endpoint::process();
				exit();
			}

			$config=array(
				"base_url" => RewriteUtil::getBaseUrl()."main/hybridlogin?provider=".$provider,
				"providers" => array();
			);

			if (isset($this->config["facebookAppId"])) {
				$config["providers"]["Facebook"]=array(
					"enabled"=>true,
					"trustForwarded"=>false,
					"scope"=>"email",
					"keys"=>array(
						"id"=>$this->config["facebookAppId"],
						"secret"=>$this->config["facebookSecret"]
					)
				);
			}

			$hybridauth=new Hybrid_Auth($config);

			try {
				$auth=$hybridauth->authenticate($provider);
				$profile = $auth->getUserProfile();

				$_SESSION["email"]=$profile->email;
				$this->redirect();
			}

			catch (Exception $e) {
				$this->showLoginForm($e->getMessage());
			}
		}

		/**
		 * The main page.
		 * Show list of swagmaps or the login screen.
		 */
		function main() {
			if (!$this->getCurrentEmail())
				$this->showLoginForm();

			$this->showSwagList();
		}

		/**
		 * Show login form, then exit.
		 */
		function showLoginForm($message=NULL) {
			$t=new Template(__DIR__."/../templates/login.php");
			$t->set("message",$message);

			$t->set("showlogin", isset($this->config["actorDomain"]));
			$t->set("showfacebook", isset($this->config["facebookAppId"]));

			$this->showContent($t);
			exit();
		}

		/**
		 * Login the user.
		 */
		function login($username, $password) {
			$error=NULL;
			$res=pam_auth($username,$password,$error);

			if (!$res)
				$this->showLoginForm($error);

			$_SESSION["email"]=$username."@".$this->config["actorDomain"];
			$this->redirect();
		}

		/**
		 * Log out the current user.
		 */
		function logout() {
			unset($_SESSION["email"]);
			$this->redirect();
		}

		/**
		 * Show list of swagmaps.
		 */
		function showSwagList() {
			$swagmapdir=__DIR__."/../../extern/swagmaps";
			$swagmaps=array();
			$swagmapfiles=FileUtil::findFilesWithExt($swagmapdir,"json");

			foreach ($swagmapfiles as $swagmapfile) {
				$swagmap=json_decode(file_get_contents($swagmapdir."/".$swagmapfile),TRUE);
				$swagmap["filename"]=$swagmapfile;

				if (!isset($swagmap["title"]))
					$swagmap["title"]=$swagmapfile;

				$swagmaps[]=$swagmap;
			}

			$t=new Template(__DIR__."/../templates/swaglist.php");
			$t->set("swagmaps",$swagmaps);
			$this->showContent($t);
		}

		/**
		 * Show content with header and footer.
		 */
		function showContent($c) {
			$t=new Template(__DIR__."/../templates/base.php");
			$t->set("content",$c->render());
			$t->set("baseUrl",RewriteUtil::getBaseUrl());
			$t->show();
		}

		/**
		 * Show a swagmap.
		 */
		function showmap($filename) {
			$this->requireLogin();

			$t=new Template(__DIR__."/../templates/swagmap.php");
			$t->set("baseUrl",RewriteUtil::getBaseUrl());
			$t->set("mapUrl",RewriteUtil::getBaseUrl()."/main/getmap?filename=".urlencode($filename));
			$t->set("actorEmail",$this->getCurrentEmail());

			if (isset($this->config["useProxy"]) && $this->config["useProxy"])
				$t->set("xapiEndpoint",RewriteUtil::getBaseUrl()."xapiproxy");

			else
				$t->set("xapiEndpoint",$this->config["xapiEndpoint"]);

			$t->set("xapiUsername",$this->config["xapiUsername"]);
			$t->set("xapiPassword",$this->config["xapiPassword"]);
			$t->show();
		}

		/**
		 * Get data for a swagmap.
		 */
		function getmap($filename) {
			$swagmapdir=__DIR__."/../../extern/swagmaps";

			echo file_get_contents($swagmapdir."/".$filename);
		}

		/**
		 * Redirect to the frontpage if not logged in.
		 */
		protected function requireLogin() {
			if (isset($this->config["email"]))
				return;

			if (!isset($_SESSION["email"]))
				$this->redirect();
		}

		/**
		 * Redirect to a page.
		 */
		protected function redirect($page=NULL) {
			$url=RewriteUtil::getBaseUrl();

			if ($page)
				$url.="/".$page;

			header("Location: ".$url);
			exit();
		}

		/**
		 * Get email for the current user.
		 */
		protected function getCurrentEmail() {
			if (isset($_SESSION["email"]))
				return $_SESSION["email"];

			if (isset($this->config["email"]))
				return $this->config["email"];

			return NULL;
		}
	}
