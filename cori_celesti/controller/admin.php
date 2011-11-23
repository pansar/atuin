<?php
	class Admin extends Cori_celesti
	{
		function __construct()
		{	
			$text = $this->model_blog->select();
			$data['articles'] = $text;
			$this->loadModel('model_admin');
		}

		function index()
		{
			$temp = $this->model_admin_select();
			$this->loadView($temp);
		}

}

?>
