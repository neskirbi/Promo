<?php
include "../controler/conn.php";




$size = count($_POST['Id_usuario']);


$i = 0;
while ($i < $size) {
    $pago1 = $_POST['pago'][$i];
    $sueldos1 = $_POST['sueldos'][$i];
    $Incentivos1 = $_POST['Incentivos'][$i];
    //$dias_trabajados1 = $_POST['DiasT'][$i];
    //$dias_adicionales1 = $_POST['dias_adicionales'][$i];
    $id = $_POST['Id_usuario'][$i];
    $incent_diario1 = $_POST['incent_diario'][$i];
    //$incdia1 = $_POST['incdia'][$i];
//$pasajes1=$_POST['Pasajes'][$i]; 
$generar= $_POST['Generar'][$i];
$editar= $_POST['Editar'][$i];
$sueldo_diario1=$_POST['SD'][$i];



$incentivo1=$_POST['incdia'][$i];
$pasajes1=$_POST['Pasajes'][$i];
$dias_trabajados1=$_POST['dias_trabajados'][$i];
$dias_adicionales1=$_POST['dias_adicionales'][$i];


    $query = "UPDATE usuarionom SET 
                     incdia           ='0'
            
              WHERE Id_usuario = '$id' ";



    sqlsrv_query($conn, $query) or die (print_r( sqlsrv_errors(), true));
    //echo "$pago<br /><br /><em>Updated!</em><br /><br />";
    ++$i;
}
header("location: dashboard.php");
/*if (isset($_POST['Generar'])) { 
    echo '<p>Hola1</p>';
}
if (isset($_POST['Editar'])) {
    echo '<p>Hola2</p>';
}
echo '<p>Hola3</p>'; */

?>


