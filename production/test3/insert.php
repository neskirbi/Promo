<?php  
$server = "D5CLQ382\SQLEXPRESS";
$connectionInfo = array( "Database"=>"dbventasjtib", "UID"=>"claudio", "PWD"=>"cpromo*" );
$conn = sqlsrv_connect( $server, $connectionInfo );

$sql = "INSERT INTO testC(fisrt, last) VALUES('".$_POST["fisrt"]."', '".$_POST["last"]."')";  
if(sqlsrv_query($connect, $sql))  
{  
     echo 'Data Inserted';  
}  
 ?>