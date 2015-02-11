<?php

	require_once __DIR__."/extern/minimvc/src/dispatcher/WebDispatcher.php";

	$dispather=new WebDispatcher(__DIR__."/src/controllers");
	$dispather->setDefaultController("main");

	$dispather->dispatch();