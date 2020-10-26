<?php 

class Sql extends PDO{


	private $conn;



	public function __construct(){

		$this->conn = new PDO("mysql:dbname=dbphp7;host=localhost", "root", "1a2b3c4d5e6f@A");
	}



	private function setParams($statment, $parameters = array()){
		foreach ($parameters as $key => $value) {
			$this->setParam($statment, $key, $value);
		}
	}



	private function setParam($statment, $key, $value){
		$statment->bindParam($key, $value);
	}



	public function query($rawQuerry, $params = array()){
		$stmt = $this->conn->prepare($rawQuerry);

		$this->setParams($stmt, $params);

		$stmt->execute();

		return $stmt; 
	}



	public function select($rawQuerry, $params = array()):array{
		$stmt = $this->query($rawQuerry, $params);

		return $stmt->fetchAll(PDO::FETCH_ASSOC);
	}
}





 ?>