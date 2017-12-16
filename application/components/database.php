<?php
class Database {
	
	protected $datab;

	public function __construct(){
		try {
			$this->datab = new PDO('mysql:host=localhost;dbname=test;charset=utf8', 'root','');
			$this->datab->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$this->datab->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
		} catch (PDOException $e) {
			throw new Exception($e->getMessage());
		}
	}

	public function get_Rows($query, $params){
		$stmt = $this->datab->prepare($query);
		$stmt->execute($params);
		return $stmt->fetchAll();
	}

	public function update_Rows($query, $params){
		$stmt = $this->datab->prepare($query);
		$stmt->execute($params);
		$rowcount = $stmt->rowCount();
		return $rowcount;
	}
}