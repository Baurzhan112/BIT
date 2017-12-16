<?php

class Controller_Login
{
	public $model;
	function __construct()
	{
		$this->model = new Model_Login();
	}
	
	function action_index()
	{
		Session::init();
		if (isset($_POST['login']) and isset($_POST['password'])) {
			$login = $_POST['login'];
			$password = md5($_POST['password']);
			$is_client = $this->model->check_client($login,$password);
			if (count($is_client) == 1) {
				$client_id = $is_client[0]['id'];
		        $client_name = $is_client[0]['client_name'];
		        Session::init();
		        Session::set('client_id',$client_id);
		        Session::set('client_name',$client_name);
		        Session::set('logged_in', true);     
		        header("Location: https://mysite.ru/account/index");
			}
		}
		elseif (isset($_SESSION['client_id']) and isset($_SESSION['client_name'])) {
					header("Location: https://mysite.ru/account/index");
				}	
		include '../application/views/v_login.php';
	}

	function action_logout()
	{
		Session::init();
		Session::destroy();
    	header("Location: https://mysite.ru/login/index");
	}
}