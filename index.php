<?php

	//Site url. Localhost during development
	define("BASE_PATH", "http//localhost");

	//Basepath
	$path = "/atuin";

	//Initial path
	$url = $_SERVER['REQUEST_URI'];
	$url = str_replace($path,"",$url);

	//Create array of the rest of url
	$array_tmp_uri = preg_split('[\\/]', $url, -1, PREG_SPLIT_NO_EMPTY);

	//Define different parts of url
	$array_uri['controller']	= $array_tmp_uri[0]; //class
	$array_uri['method']		= $array_tmp_uri[1]; //function
	$array_uri['var']		= $array_tmp_uri[2]; //variabel

	//Load base API
	require_once("cori_celesti/base.php");

	//load controller
	$CI = new Cori_celesti($array_uri);
	$CI->loadController($array_uri['controller']);

?>
