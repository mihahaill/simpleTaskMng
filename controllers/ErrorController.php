<?php

class ErrorController extends Controller
{
	
	function action_index()
	{
		$this->view->render('error.php', 'template.php');
	}

}
