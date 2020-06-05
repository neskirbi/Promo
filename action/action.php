<?php 
$_TEMP = array();


$_TEMP["server"] = 'D5CLQ382\SQLEXPRESS'; //server de base de datos
$_TEMP["database"] = 'dbventasjti'; //nombre de la base de datos
$_TEMP["username"] = 'claudio';
$_TEMP["password"] = 'cpromo*';

$connection_string = 'DRIVER={SQL SERVER};SERVER='. $_TEMP["server"] . ';DATABASE=' . $_TEMP["database"];
$conexion = odbc_connect($connection_string, $_TEMP["username"], $_TEMP["password"]);


unset($_TEMP);



@session_start(); 
// Get the data collected from the user 
$username=$_POST['username'];
$password=$_POST['password'];
$username = stripslashes($username);
$password = stripslashes($password);
function isLoggedIn()
    {
        if($_SESSION['LoggedIn'])
        {
            return true;
        }
        else return false;
    } 
$sql="SELECT * FROM usuario WHERE us_login  ='$username' AND us_password ='$password'";
// prepare and execute in 1 statement
$result=odbc_exec($conexion,$sql) 
or die ("result error ".odbc_error().'-'.odbc_errormsg());
// if no result: no rows read
if (!odbc_fetch_row($result))
die("Wrong Username or Password"); 
// else: all is okay
else { 
session_regenerate_id();
$_SESSION['LoggedIn'] = true;
$_SESSION['username']=$username;
header("location:../production/1.php");
}
function logout()
    {
        unset($_SESSION['LoggedIn']);
        unset($_SESSION['username']);
        session_destroy();
        header('location: ../index.php');
    }
odbc_close($conexion);
?> 