<?php
include "../controler/conn.php";




$Id_usuario = $_POST['id'];

$us_nombre_real= $_POST['us_nombre_real'];
$us_nombre= $_POST['us_nombre'];
$us_apellidos= $_POST['us_apellidos'];
$us_direccion= $_POST['us_direccion'];
$smartphone= $_POST['smartphone'];
$us_login= $_POST['us_login'];
$us_password= $_POST['us_password'];
$Id_tipouser= $_POST['Id_tipouser'];
$Id_movil= $_POST['Id_movil'];
$Id_ruta= $_POST['Id_ruta'];
$ucfdi= $_POST['ucfdi'];
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
$mail= $_POST['mail'];
$gafete= $_POST['gafete'];
$dateTimeVariable = date("j-m-Y ");
 
//$query = "INSERT INTO usuarionom (Id_ruta,  us_nombre_real, estatus,  fecha_entrega) VALUES ('$Id_ruta', Vacante,  Vacante, CURRENT_TIMESTAMP)";

    $query = "UPDATE usuarionom SET 
                     estatus= 'Activo',
                     fecha_baja_us=''
              WHERE Id_usuario = '$Id_usuario' ";



    sqlsrv_query($conn, $query) or die (print_r( sqlsrv_errors(), true));
    //echo "$pago<br /><br /><em>Updated!</em><br /><br />";

header("location: dashboard.php");
/*if (isset($_POST['Generar'])) { 
    echo '<p>Hola1</p>';
}
if (isset($_POST['Editar'])) {
    echo '<p>Hola2</p>';
}
echo '<p>Hola3</p>'; */

?>


