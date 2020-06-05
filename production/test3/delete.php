<?php  
$server = "D5CLQ382\SQLEXPRESS";
$connectionInfo = array( "Database"=>"dbventasjtib", "UID"=>"claudio", "PWD"=>"cpromo*" );
$conn = sqlsrv_connect( $server, $connectionInfo );

	$sql = "DELETE FROM testC WHERE id = '".$_POST["id"]."'";  
	if(sqlsrv_query($con, $sql))  
	{  
		echo 'Data Deleted';  
	}  
 ?>