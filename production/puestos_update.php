<?php
include "../controler/conn.php";

$size = count($_POST['pago']);

$i = 0;
while ($i < $size) {
    $pago1 = $_POST['pago'][$i];
    $sueldos1 = $_POST['sueldos'][$i];
    $dias_trabajados1 = $_POST['dias_trabajados'][$i];
    $dias_adicionales1 = $_POST['dias_adicionales'][$i];
    $Id_usuario = $_POST['Id_usuario'][$i];

    $query = "UPDATE datosp SET 
                    pago = '$pago1', 
                    sueldos = '$sueldos1', 
                    dias_trabajados ='$dias_trabajados1', 
                    dias_adicionales ='$dias_adicionales1'  WHERE Id_usuario = '$Id_usuario' ";



    sqlsrv_query($conn, $query) or die (print_r(sqlsrv_errors(), true));
    echo "$pago1,$sueldos1,$dias_trabajados1,$dias_adicionales1<br /><br /><em>Updated!</em><br /><br />";
    ++$i;
}
//header("location: puestos.php");
?>

