<?php
include "../controler/conn.php";

$size = count($_POST['pago']);

$i = 0;
while ($i < $size) {
    $pago1 = $_POST['pago'][$i];
    $sueldos1 = $_POST['sueldos'][$i];
    $dias_trabajados1 = $_POST['dias_trabajados'][$i];
    $dias_adicionales1 = $_POST['dias_adicionales'][$i];
    $idusuario = $_POST['idusuario'][$i];

    $query = "UPDATE usuario SET pago = '$pago1', sueldos = '$sueldos1', dias_trabajados ='$dias_trabajados1', dias_adicionales ='$dias_adicionales1'  WHERE idusuario = '$idusuario' ";



    sqlsrv_query($conn, $query) or die ("Error in query: $query");
    //echo "$pago<br /><br /><em>Updated!</em><br /><br />";
    ++$i;
}
header("location: puestos.php");
?>

