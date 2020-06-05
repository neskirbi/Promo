<?php  
$server = "D5CLQ382\SQLEXPRESS";
$connectionInfo = array( "Database"=>"dbventasjtib", "UID"=>"claudio", "PWD"=>"cpromo*" );
$conn = sqlsrv_connect( $server, $connectionInfo );

	$id = $_POST["id"];  
	$text = $_POST["text"];  
	$column_name = $_POST["column_name"];  
	$sql = "UPDATE testC SET ".$column_name."='".$text."' WHERE id='".$id."'";  
	if(sqlsrv_query($conn, $sql))  
	{  
		echo 'Data Updated';  
	}  
 ?>