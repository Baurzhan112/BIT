<?php

class Model_Account {
	public $db;

	public function __construct()
	{
		$this->db = new Database();
	}

	public function get_client_info($client_id){
		$stmt = $this->db->get_Rows('select * from clients where id = ?', array($client_id));
		return $stmt;
	}

	public function check_summa($summa) {
	    if(is_numeric($summa) and $summa > 0) {
	        $result['isset'] = true; $result['summa'] = $summa + 0;
	    }
	    else $result['isset'] = false;
	    return $result;
	}

	function write_off($summa,$client_id) {	
	    $stmt = $this->db->get_Rows('select balance from clients where id = ?', array($client_id));
	    $old_balance = $stmt[0]['balance'];
	    if ($old_balance >= $summa) {
		    $stmt = $this->db->update_Rows('update clients set balance = balance - ? where id = ? and balance >= ? and balance = ?',array($summa,$client_id,$summa,$old_balance));
		    if ($stmt == 1) $message = 'Списано '.$summa.' рублей';
		    else $message = 'Кто то другой осуществил списание с вашего счета. Перепроверьте свой баланс и повторите попытку!';
		}
		else $message = 'Сумма списания превышает баланс';
		return $message;
	}
}