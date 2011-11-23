<?php
class model_admin extends Cori_celesti
{
	function __construct()
	{
		//Fix config...or fix other file for this
	}

	function select()//called from controller
	{
		return array("title 1","title2","title3");
	}
}
