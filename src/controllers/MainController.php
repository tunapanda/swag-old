<?php

	require_once __DIR__."/../utils/FileUtil.php";

	/**
	 * Controller class.
	 */
	class MainController extends WebController {

		function MainController() {
			session_start();

			$this->method("main");
			$this->method("logout");
			$this->method("showmap")->args("filename");
			$this->method("getmap")->args("filename");
			$this->method("login")->args("username","password");
			$this->setDefaultMethod("main");
		}

		/**
		 * The main page.
		 * Show list of swagmaps or the login screen.
		 */
		function main() {
			if (!isset($_SESSION["username"])) {
				$t=new Template(__DIR__."/../templates/login.php");
				$t->set("message",NULL);
				$this->showContent($t);
				return;
			}

			$this->showSwagList();
		}

		/**
		 * Login the user.
		 */
		function login($username, $password) {
			$error=NULL;
			$res=pam_auth($username,$password,$error);

			if (!$res) {
				$t=new Template(__DIR__."/../templates/login.php");
				$t->set("message",$error);
				$this->showContent($t);
				return;
			}

			$_SESSION["username"]=$username;
			$this->redirect();
		}

		/**
		 * Log out the current user.
		 */
		function logout() {
			unset($_SESSION["username"]);
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

		}

		/**
		 * Get data for a swagmap.
		 */
		function getmap($filename) {
			$swagmapdir=__DIR__."/../../extern/swagmaps";

			echo file_get_contents($swagmapdir."/".$filename);
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
	}