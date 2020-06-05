<?php
/* Database connection start */



$server = "D5CLQ382\SQLEXPRESS";
$connectionInfo = array( "Database"=>"dbmars", "UID"=>"claudio", "PWD"=>"cpromo*" );
$conn = sqlsrv_connect( $server, $connectionInfo );
?>