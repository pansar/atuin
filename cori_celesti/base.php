<?php
	if(!defined('BASE_PATH')) exit('Not allowed.');

	class Cori_celesti
	{
		var $uri;
		var $model;

		function __construct($uri)
		{
			$this->uri = $uri;
		}

		function loadController($class)
		{
			$file = "cori_celesti/controller/".$this->uri['controller'].".php";
			if(!file_exists($file)) die("Try using a working controller, smart-ass") ;
			
			require_once($file);

			$controller = new $class();

			if(method_exists($controller, $this->uri['method'])){
				$controller->{$this->uri['method']}($this->uri['var']);
			}
			else{
				$controller->index();
			}
		}
		
		function loadView($view,$vars="")
		{
			if(is_array($vars) && count($vars)>0){
				extract($vars, EXTR_PREFIX_SAME, "wddx");}
			require_once('view/'.$view.'.php');
		}

		function loadModel($model)
		{
			require_once('model/'.$model.'.php');
			$this->$model = new $model;
		}
	}
?>
