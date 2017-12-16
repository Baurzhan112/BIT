<?php

class Model_Login {
	public $db;

	public function __construct()
	{
		$this->db = new Database();
	}

	public function check_client($login,$password){
		$stmt = $this->db->get_Rows('select * from clients where login = ? and password = ?', array($login,$password));
		return $stmt;
	}
}