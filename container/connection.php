<?php
class DatabaseConn {
	public $host="localhost";
	protected $database= "gasdelivery";
	private   $user="root";
	private   $pass="";
	public    $conn;

	public function connection() {
		try {
			$dsn = "mysql:host=$this->host; dbname=$this->database";
			$this->conn = new PDO($dsn, $this->user, $this->pass);
			return $this->conn;
		} catch(PDOException $error) {
			echo "ERROR OCCURED ".$error->getMessage();
		}
	}
}

?>