<?php
include "../controler/conn.php";

$size = count($_POST['Id_usuario']);
echo "agregado correctamente <br> <br>";
$i = 0;
while ($i < $size) {
    $sueldos1 = $_POST['sueldos'][$i];
    $dias_trabajados1 = $_POST['dias_trabajados'][$i];
    $dias_adicionales1 = $_POST['dias_adicionales'][$i];
    $idusuario1 = $_POST['idusuario'][$i];
 $puesto1 = $_POST['puesto'][$i];
 $ruta1 = $_POST['ruta'][$i];
 $ucfdi1 = $_POST['ucfdi'][$i];
 $foto1 = $_POST['foto'][$i];   
 $us_nombre_real1 = $_POST['us_nombre_real'][$i]; 
 // $ruta1 = $_POST['ruta'][$i];   
 $Pasajediario = $_POST['pasaje_total'][$i]; 
 $diaspago = $_POST['toatels_trabajados'][$i]; 

$Id_usuario1 = $_POST['Id_usuario'][$i]; 
$SD1 = $_POST['SD'][$i]; 
$pasajes1 = $_POST['Pasajes'][$i];
$pago1 = $_POST['pago'][$i];
$incdia1 = $_POST['incdia'][$i];
$transferencia1 = $_POST['transferencia'][$i]; 
$cheque1 = $_POST['cheque'][$i]; 
$infonavit1 = $_POST['infonavit'][$i]; 
$cahorro1 = $_POST['cachorro'][$i]; 
$ddescanso1 = $_POST['dias_descanso'][$i]; 
$diasextra1 = $_POST['totales_adicionales'][$i]; 
    //$query = "UPDATE usuario SET pago = '$pago1', sueldos = '$sueldos1', dias_trabajados ='$dias_trabajados1', dias_adicionales ='$dias_adicionales1'  WHERE idusuario = '$idusuario' ";
/*$query = "INSERT INTO datosp (pago,sueldos,dias_trabajados,dias_adicionales,Id_usuario,incdia,idusuario,puesto,ruta,ucfdi,foto,us_nombre_real,periodo)
                       VALUES ('$pago1','$sueldos1','$dias_trabajados1','$dias_adicionales1','$Id_usuario1','$incdia1','$idusuario1','$puesto1','$ruta1','$ucfdi1','$foto1'$us_nombre_real1',GETUTCDATE())"; */
$query = "INSERT INTO datosp (Id_usuario,Periodo,SD,Pasajediario,diaspago,tincentivo,transferencia,cheque,infonavit,cahorro,ddescanso,diasextra)
          VALUES ('$Id_usuario1',GETUTCDATE(),'$SD1','$pasajes1','$pago1','$incdia1','$transferencia1','$cheque1','$infonavit1','$cahorro1','$ddescanso1','$diasextra1')";




//ultima act2 y ultima act2+14 

    //@sqlsrv_query($conn, $query) or die( print_r( sqlsrv_errors(), true));
    sqlsrv_query($conn, $query) or die (print_r( sqlsrv_errors(), true));
    //echo "$pago<br /><br /><em>Updated!</em><br /><br />";
    ++$i;
}

//header("location: dashboard.php");
?>


periodo actual guardado <br>

regresar link dashboard / 
regresar link edit usuario / 
regresar link ver periodos /
regresar link guardar periodo actual /


updated_at=NOW()