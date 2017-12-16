<?php

class Controller_Account
{
	public $model;
	function __construct()
	{
		$this->model = new Model_Account();
	}
	
	function action_index()
	{
		Session::init();
		$logged_in = Session::get('logged_in');
		$client_id = Session::get('client_id');
		Session::write_close();
		$message = '';
		if ($logged_in == true){			
			if (isset($_POST['write_off'])) {
				$check_summa = $this->model->check_summa($_POST['write_off']);
				if ($check_summa['isset'] === true) $message = $this->model->write_off($check_summa['summa'],$client_id);
				else $message = 'Некорректно введена сумма списания. Попробуйте еще раз';
			}
			$client_info = $this->model->get_client_info($client_id);
			$client_name = $client_info[0]['client_name'];
			$client_balance = $client_info[0]['balance'];
		}
		else header('Location: https://mysite.ru/login/index');

		include '../application/views/v_account.php';
	}
}
