<?php
session_start();
include "../controler/conn.php";

if (!isset($_SESSION['user_log']) && $_SESSION['user_log'] == null)
{
    header("location: ../action/logout.php");
}
$id = $_SESSION['user_log'];
$query_user = sqlsrv_query($conn, "SELECT * from usuarionom WHERE $id=us_login");
while ($row = sqlsrv_fetch_array($query_user))
{
    $us_nombre_real_id_head = $row['us_nombre_real'];
}
$resultado = "SELECT * FROM `usuario` ";
$sql3 = sqlsrv_query($conn, "SELECT TOP 1 periodo from periodo ORDER BY idp DESC");
if ($c = sqlsrv_fetch_array($sql3))
{
    $periodo = $c['periodo'];
}
$query_borra="delete from datosp where Periodo='$periodo'";

sqlsrv_query($conn, $query_borra) or die (print_r( sqlsrv_errors(), true));
header("location: dashboard.php");