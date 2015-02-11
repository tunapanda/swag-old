<?php

	class MainController extends WebController {

		function MainController() {
			session_start();

			$this->method("main");
			$this->method("logout");
			$this->method("login")->args("username","password");
			$this->setDefaultMethod("main");
		}

		function main() {
			if (!isset($_SESSION["username"])) {
				$t=new Template(__DIR__."/../templates/login.php");
				$t->set("message",NULL);
				$this->showContent($t);
				return;
			}

			$t=new Template(__DIR__."/../templates/swaglist.php");
			$this->showContent($t);
		}

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

		function logout() {
			unset($_SESSION["username"]);
			$this->redirect();
		}

		function showContent($c) {
			$t=new Template(__DIR__."/../templates/base.php");
			$t->set("content",$c->render());
			$t->set("baseUrl",RewriteUtil::getBaseUrl());
			$t->show();
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