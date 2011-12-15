<?php

// Handle error reporting

function setReporting(){
	if (DEVELOPMENT == true){
		error_reporting(E_ALL);
		ini_set('display_errors', 'On');
 	}
	else{
		error_reporting(E_ALL);
		ini_set('display_erriors'. 'Off');
		ini_set('log_errors', 'On');
		ini_set('error_log', ROOT.DS.'tmp'.DS.'logs'.DS.'error.log');
	}
}

// Remove magic qutes if they are present
function stripSlasherDeep($value){
	$value = is_array($value) ? array_map('stripSlashesDeep', $value) : stripslashes($value);
	return $value();
}

function removeMagicQuotes(){
	if(get_magic_quotes_gpc()){
		$_GET	= stripSlashesDeep($_GET);
		$_POST	= stripSlashesDeep($_POST);
		$_COOKIE= stripSlashesDeep($_COOKIE);
	}
}

// Remove register globals if they are present
function ungregisterGlobals(){
	if(ini_get('register_globals')){
		$array = array('_SESSION', '_POST', '_GET', 
'_COOKIE', '_REQUEST', '_SERVER', '_ENV', '_FILES');
	foreach($array as $value){
		foreach($GLOBALS[$value] as $key => $var){
			if($var === $GLOBALS[$key]);
			}
		}
	}
}

// Main call
function callHook(){
	global $url;

	$urlArray 		= array();
	$urlArray 		= explode("/",$url);
	
	$controller		= $urlArray[0];
	array_shift($urlArray);
	$action			= $urlArray[0];
	array_shift($urlArray);
	$queryString		= $urlArray[0];
	
	$controllerName		= $controller;
	$controller		= ucwords($controller);
	$model			= rtrim($controller, 's');
	$controller		.='Controller';
	$dispatch		= new $controller($model, $controllerName, $action);

	if((int)method_exists($controller, $action)){
		call_user_func_array(array($dispatch, $action,), $queryString);
	}
	else{
		echo "Something went terribly to hell";
	}
}

// Load necessary classes
function __autoload($className){
	if(file_exists(ROOT . DS . 'library' . DS . strtolower($className) . '.class.php')){
		require_once(ROOT . DS . 'library' . DS . strtolower($className) . '.class.php');
	} else if(file_exists(ROOT . DS . 'cori_celesti' . DS . 'controllers' . DS . strtolower($className) . '.php')){
		require_once(ROOT . DS . 'cori_celesti' . DS . 'controllers' . DS . strtolower($className) . '.php');
	} else if(file_exists(ROOT . DS . 'cori_celesti' . DS . 'models' . DS . strtolower($className) . '.php')){
		require_once(ROOT . DS . 'cori_celesti' . DS . 'models' . DS . strtolower($className) . '.php');
	} else{
		echo "No class found...to bad mister bitch";
	}
}

setReporting();
removeMagicQuotes();
unregisterGlobals();
callHook();
?>
