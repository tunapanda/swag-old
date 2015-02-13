<?php

	require_once __DIR__."/../src/utils/PhpProxy.php";
	require_once __DIR__."/../config.php";

	$proxy=new PhpProxy();
	$proxy->setRemoteSite($xapiEndpoint);
	$proxy->dispatch();