<?php
class DBController {
	private $host = "D5CLQ382\SQLEXPRESS";
	private $user = "claudio";
	private $password = "cpromo*";
	private $database = "dbventasjtib";
	private $conn;
	


	function __construct() {
		$this->conn = $this->connectDB();
	}
	
	function connectDB() {
		$conn = sqlsrv_connect($this->host,$this->user,$this->password,$this->database);
		return $conn;
	}
	
	function runQuery($query) {
		$result = sqlsrv_query($this->conn,$query);
		while($row=sqlsrv_fetch_assoc($result)) {
			$resultset[] = $row;
		}		
		if(!empty($resultset))
			return $resultset;
	}
	
	function numRows($query) {
		$result = sqlsrv_query($this->conn,$query);
		$rowcount = sqlsrv_fetch_assoc($result);
		return $rowcount;	
	}
	function executeUpdate($query) {
        $result = sqlsrv_query($this->conn,$query);        
		return $result;		
    }
}
?>