<?php
include "../controler/conn.php";

$Id_usuario = $_POST['id'];
$us_apellidos= $_POST['us_apellidos'];
$us_direccion= $_POST['us_direccion'];
$smartphone= $_POST['smartphone'];
$us_login= $_POST['us_login'];
$us_password= $_POST['us_password'];
$Id_tipouser= $_POST['Id_tipouser'];
$Id_movil= $_POST['Id_movil'];
$Id_ruta= $_POST['Id_ruta'];

$upass= $_POST['upass'];
$oruta= $_POST['oruta'];
$dni= $_POST['dni'];
$cl_tipovisit= $_POST['cl_tipovisit'];
$us_region= $_POST['us_region'];
$Laptop= $_POST['Laptop'];
$Modelo= $_POST['Modelo'];
$Comenta= $_POST['Comenta'];
$smartphone= $_POST['smartphone'];
$cuenta_smart= $_POST['cuenta_smart'];
$estado_smart= $_POST['estado_smart'];
$canal= $_POST['canal'];
$puesto_descripcion= $_POST['puesto_descripcion'];
$gafete= $_POST['gafete'];


$ucfdi= $_POST['ucfdi'];
$us_nombre_real= $_POST['us_nombre_real'];
$phone= $_POST['phone'];
$us_login= $_POST['us_login'];
$password= $_POST['password'];//check
$password2= $_POST['password2'];
$mail= $_POST['mail'];
$confirm_email= $_POST['confirm_email'];
$us_nombre= $_POST['us_nombre'];
$SD= $_POST['SD'];
$Pasajes= $_POST['Pasajes'];
$incdia= $_POST['incdia'];
$puesto=$_POST['puesto']; //revizar 
$dias_adicionales=$_POST['dias_adicionales'];
$incidencias=$_POST['incidencias'];

$dateTimeVariable = date("j-m-Y ");
 


$query_nuevo_us = "INSERT INTO usuarionom (
                   ucfdi,                   
                   us_nombre_real,
                   us_telefono,
                   us_login,
                   us_password,
                   mail,
                   estatus,
                   us_nombre,
                   SD,
                   Pasajes,
                   puesto,
                   dias_adicionales,
                   incidencias,
                   fechaalta
               ) VALUES (
                   '$ucfdi', 
                   '$us_nombre_real', 
                   '$phone', 
                   '$us_login',
                   '$password', 
                   '$mail',
                   'Activo', 
                   '$us_nombre', 
                   '$SD', 
                   '$Pasajes', 
                   '$puesto', 
                   '$dias_adicionales', 
                   '$incidencias', 
                   '$dateTimeVariable'
               )";  
//us_nombre es ruta...

sqlsrv_query($conn, $query_nuevo_us) or die (print_r( sqlsrv_errors(), true));
    //echo "$pago<br /><br /><em>Updated!</em><br /><br />";

header("location: dashboard.php");    



 

?>


