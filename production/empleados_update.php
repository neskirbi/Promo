<?php
include "../controler/conn.php";

$size = count($_POST['Id_usuario']);

$i = 0;
while ($i < $size) {
    $pago1 = $_POST['pago'][$i];
    $sueldos1 = $_POST['sueldos'][$i];
    $Incentivos1 = $_POST['Incentivos'][$i];
    $dias_trabajados1 = $_POST['dias_trabajados'][$i];
    $dias_adicionales1 = $_POST['dias_adicionales'][$i];
    $id = $_POST['Id_usuario'][$i];
    $incent_diario1 = $_POST['incent_diario'][$i];
    $incdia1 = $_POST['incdia'][$i];
$pasajes1=$_POST['Pasajes'][$i];    

    $query = "UPDATE usuarios SET 
                     incdia    ='$incdia1', 
                     pago             ='$pago1', 
                     sueldos          ='$sueldos1',
                     Pasajes             ='$pasajes1',  
                     dias_trabajados  ='$dias_trabajados1', 
                     dias_adicionales ='$dias_adicionales1'  
              WHERE Id_usuario = '$id' ";



    sqlsrv_query($conn, $query) or die (print_r( sqlsrv_errors(), true));
    //echo "$pago<br /><br /><em>Updated!</em><br /><br />";
    ++$i;
}
header("location: empleados.php");
?>

