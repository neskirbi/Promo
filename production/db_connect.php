<?php
/* Database connection start */



$server = "DESKTOP-KCR2IR9\SQLEXPRESS";
$connectionInfo = array( "Database"=>"dbdds", "UID"=>"dbprom", "PWD"=>"ddprom*" );
$conn = sqlsrv_connect( $server, $connectionInfo );
?>