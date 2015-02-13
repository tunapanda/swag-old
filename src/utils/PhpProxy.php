<?php

	/**
	 * Simple php proxy.
	 */
	class PhpProxy {

		private $remoteSite;

		/**
		 * Constructor.
		 */
		public function PhpProxy($remoteSite=NULL) {
			if ($remoteSite)
				$this->setRemoteSite($remoteSite);

			$this->headers=array();
			$this->forwardHeaders=array();
		}

		/**
		 * Set remote site.
		 */
		public function setRemoteSite($remoteSite) {
			if (substr($remoteSite,strlen($remoteSite)-1,1)=="/") {
				$remoteSite=substr($remoteSite,0,strlen($remoteSite)-1);
			}

			$this->remoteSite=$remoteSite;
		}

		/**
		 * Add a request header that will be forwarded.
		 */
		public function addForwardHeader($header) {
			$this->forwardHeaders[]=$header;
		}

		/**
		 * Add a header that will have a fixed value.
		 */
		public function addHeader($header, $value) {
			$this->headers[$header]=$value;
		}

		/**
		 * Dispatch.
		 */
		public function dispatch() {
			$curl=curl_init();

			$url=$this->remoteSite.PhpProxy::getPath();

			curl_setopt($curl, CURLOPT_URL, $url);

			$headers=array();

			foreach ($this->headers as $header=>$value)
				$headers[$header]=$value;

			if (sizeof($this->forwardHeaders)) {
				$inheaders=getallheaders();

				foreach ($this->forwardHeaders as $header=>$value)
					$headers[$header]=$inheaders[$header];
			}

			curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);

			if (isset($_SERVER['PHP_AUTH_USER']) && isset($_SERVER['PHP_AUTH_PW'])) {
				curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
				curl_setopt($curl, CURLOPT_USERPWD, $_SERVER['PHP_AUTH_USER'].":".$_SERVER['PHP_AUTH_PW']);
			}

			curl_exec($curl);
		}

		/**
		 * Get the path relative to where the index.php file is
		 * served from.
		 */
		public static function getPath() {
			$pathinfo=pathinfo($_SERVER["SCRIPT_NAME"]);
			$dirname=$pathinfo["dirname"];
			$url=$_SERVER["REQUEST_URI"];

			if (substr($url,0,strlen($dirname))!=$dirname)
				throw new Exception("Somthing is malformed.");

			return substr($url,strlen($dirname));
		}
	}