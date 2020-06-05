<?php
include "../controler/conn.php";
date_default_timezone_set('America/Mexico_City');

$inicio= strtotime(filter_input(INPUT_GET, "inicio"));
$fin= strtotime(filter_input(INPUT_GET, "final"));
$date1 = new DateTime();
$date1->setTimestamp($inicio);

$date2 = new DateTime();
$date2->setTimestamp($fin);
setlocale(LC_ALL, 'es');                                              
$monthName = strftime('%B', mktime(0, 0, 0, $date1->format('m')));
$monthName1 = strftime('%B', mktime(0, 0, 0, $date2->format('m')));

if ($date1->format('Y-m') === $date2->format('Y-m')) {
    $rango= "del ".$date1->format('d')." al ".$date2->format('d')." de ".$monthName.' '.$date1->format('Y');
}
else{
    $rango= "del ".$date1->format('d')." de ".$monthName.' '." al ".$date2->format('d')." de ".$monthName1.' '.$date1->format('Y');
}

$sql = sqlsrv_query($conn, "SELECT TOP 1 idp from periodo ORDER BY idp DESC");
if($c=sqlsrv_fetch_array($sql)) {
    $idp=$c['idp']+1;
} 
else
{
    $idp=1;
}
$query= "Insert into periodo (idp,periodo,diai,diaf) Values('$idp','$rango','".$date1->format('Y-m-d')."','".$date2->format('Y-m-d')."')";
sqlsrv_query($conn, $query) or die (print_r( sqlsrv_errors(), true));
header('dashboard.php');

