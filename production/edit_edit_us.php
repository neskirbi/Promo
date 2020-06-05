<?php
include "../controler/conn.php";
$Id_usuario = $_POST['id'];
$ruta=$_POST['ruta'];
$us_apellidos= $_POST['us_apellidos'];
$us_direccion= $_POST['us_direccion'];
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
$mail= $_POST['mail'];
$gafete= $_POST['gafete'];
$puesto_descripcion= $_POST['puesto_descripcion'];
$dias_trabajados= $_POST['dias_trabajados'];

$ucfdi= $_POST['ucfdi'];
$us_nombre_real= $_POST['us_nombre_real'];
$us_nombre= $_POST['us_nombre'];
$SD= $_POST['SD'];
$Pasajes=$_POST['Pasajes'];
$incdia=$_POST['incdia'];
$puesto= $_POST['puesto'];
$dias_adicionales=$_POST['dias_adicionales'];
$incidencias=$_POST['incidencias'];

    $query = "UPDATE usuarionom SET 
                     ucfdi='$ucfdi',
                     us_nombre_real='$us_nombre_real',
                     us_nombre='$us_nombre',
                     SD='$SD',
                     Pasajes='$Pasajes',
                     incdia='$incdia',
                     puesto='$puesto',
                     dias_adicionales='$dias_adicionales',
                     incidencias='incidencias'
              WHERE Id_usuario = '$Id_usuario' ";
sqlsrv_query($conn, $query) or die (print_r( sqlsrv_errors(), true));
header("location: dashboard.php");
?>


