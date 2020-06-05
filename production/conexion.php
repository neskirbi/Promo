<?php

$_TEMP = array();


$_TEMP["server"] = 'D5CLQ382\SQLEXPRESS'; //server de base de datos
$_TEMP["database"] = 'dbdds'; //nombre de la base de datos
$_TEMP["username"] = 'CBDRCVP';
$_TEMP["password"] = 'cbd1';

$connection_string = 'DRIVER={SQL SERVER};SERVER='. $_TEMP["server"] . ';DATABASE=' . $_TEMP["database"];
$conexion = odbc_connect($connection_string, $_TEMP["username"], $_TEMP["password"]);



//$conexion = mysqli_connect("D5CLQ382","CBDRCVP","cbd1","dbdds");

if($conexion){
}else{
 echo "Error no hay conexión";
}
?>