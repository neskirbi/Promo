<?php 
$server = "CASA3\SQLEXPRESS";
$connectionInfo = array( "Database"=>"dbdds", "UID"=>"sa", "PWD"=>"sa" );
$conn = sqlsrv_connect( $server, $connectionInfo );
?>