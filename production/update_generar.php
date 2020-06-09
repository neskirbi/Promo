
<?php
include "../controler/conn.php";
session_start();
  include "../controler/conn.php";
  if (!isset($_SESSION['user_log'])&& $_SESSION['user_log']==null) {
  header("location: ../action/logout.php");
}
$id=$_SESSION['user_log'];
//print_r($_POST);
$query_user=sqlsrv_query($conn,"SELECT * from usuarionom WHERE $id=us_login and gafete='B'");  //se ingresa el grupo al que pertenece
while ($row=sqlsrv_fetch_array($query_user)) {
    $us_nombre_real_id_head = $row['us_nombre_real'];

}

$resultado= "SELECT * FROM `usuario` ";

$sql3 = sqlsrv_query($conn, "SELECT TOP 1 periodo, period, sem, Autorizado from periodo ORDER BY idp DESC");
if($c=sqlsrv_fetch_array($sql3)) {
  $periodo3=$c['periodo'];								
	$peractual=$c['period'];
	$semperiodo=$c['sem'];
	$pera=$c['sema'];
	$autor=$c['Autorizado'];
		
  $varcompa = "2020".$peractual."-".$semperiodo;							
                      
} 
//sql3 nos da el ultimo periodo (el que esta escrito con letra...) elegido apartir del ultimo con DESC eje: del 30 al once 
$sql4 = sqlsrv_query($conn, "SELECT TOP 1 Periodo FROM datosp ORDER BY id DESC");
if($c=sqlsrv_fetch_array($sql4)) {
  $ultimoPeriodo=$c['Periodo'];
	$peractual=$c['Periodo'];
} 
							
$sql6 = sqlsrv_query($conn, "SELECT idempleado, pano, periodo, sem, incentivo, sema, ckey  FROM incentivo where periodo=$peractual and sem=$semperiodo");
	if($c=sqlsrv_fetch_array($sql6))
  {
     $inc_idemp=$c['idempleado'];
		 $inc_pano=$c['pano'];
		 $inc_periodo=$c['periodo'];
		 $inc_periodo=$c['sem'];
		 $inc_periodo=$c['incentivo'];
		 $inc_periodo=$c['sema'];
		 $inc_periodo=$c['ckey'];
 } 								
	

$perab = $pera;		
							
//seleciona el utimo periodo generado de tabla 'datosp' esto es para comparar vs el 'periodo' de tabla 'periodo' 
//si ya existe y es igual poder sacar el mensaje de ya existe el perriodo                            
$date = strtotime("+12 day", time());
$date1 = strtotime("+0 day", time());
$datePlus12 = date('M d Y', $date);
$datePlus0 = date('M d Y', $date1);
$dateAldate = $datePlus0." al ".$datePlus12;
$date_formato = "del".$date1."al";
//no borrar asta que estemos seguros que no se utilizara despues}
echo"<br> $periodo3 == $ultimoPeriodo";
if ($periodo3 == $ultimoPeriodo) {
//si es igual muestra error ...habria que poner formato o algo ...tal ves en lavalidacion de user.js 
echo '<br>error, el periodo en datosp ya existe y es:';
echo "<br>".$ultimoPeriodo;
echo '<br>Y el periodo actual en periodo es: ';
echo "<br>".$periodo3;
} else {

$size = count($_POST['ucfdi']);

echo"<br> size". $size;
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
$incentivo1= $_POST['incentivon'][$i]; //$_POST['incdia'][$i];
$incentivo2=$_POST['incentivosp'][$i];
$pasajes1=$_POST['Pasajes'][$i];
$incidencias=$_POST['incidencia'][$i];
$ucfdi=$_POST['ucfdi'][$i];
$dias_trabajados1=$_POST['dias_trabajados'][$i];
$dias_adicionales1=$_POST['dias_ad'][$i];
$dateTimeVariable = date("j-m-Y ");

echo"<br>incentivo". $incentivo1;

if($incentivo1 === ''){
		$incentivo1 = "0";	
	}
	else{
		$incentivo1= $_POST['incentivon'][$i];
}
	

    echo"<br>".$query1 = "UPDATE usuarionom SET 
                     incdia           ='$incentivo1', 
					           incentivosp      ='$incentivo2', 
                     Pasajes          ='$pasajes1',
                     dias_trabajados  ='$dias_trabajados1', 
                     incidencias      ='$incidencias',
                     dias_adicionales ='$dias_adicionales1'  
              WHERE ucfdi = '$ucfdi' and gafete = 'B' ";
	
	
	  sqlsrv_query($conn, $query1) or die (print_r( sqlsrv_errors(), true));
    //echo "$pago<br /><br /><em>Updated!</em><br /><br />";
    ++$i;

	echo "<br>Tama".$size."Que".$query1;
	 
	$ucf = $ucfdi;		
			
	$an = "2020";
	$ckey1 = $ucf.$an.$peractual.$semperiodo;
  
 	echo"<br>".$sentenciac = "SELECT idempleado, periodo, sem, incentivo, sema, ckey from incentivo where ckey='$ckey1'";
	$sql_s = sqlsrv_query($conn, $sentenciac);
	sqlsrv_fetch_array($sql_s);
	
		  /* if(odbc_fetch_row($sql_s))
			 {	
			 //  echo "\nupdate".$ckeyval."\n";
			//  $sentencia = "UPDATE incentivo set incentivo = '$incentivo1'  where ckey='$ckeyval'".$sql;
			 // sqlsrv_query($conn, $sentencia) or die (print_r( sqlsrv_errors(), true));				 
	
					 }
			else
			 {
			//echo "\nInsert ".$ckeyval."\n";
			  $semact1b = $an.$peractual."-".$semperiodo;			
			//   $sentenciai = "INSERT INTO incentivo (idempleado, pano, periodo,sem,incentivo,sema,ckey) VALUES ('$ucfdi', '$an','$peractual','$semperiodo','$incentivo1','$semact1b','$ckey1')";
			 //  sqlsrv_query($conn, $sentenciai) or die (print_r( sqlsrv_errors(), true));			 			  
					
				}	*/
				  
//si ya tiene cambios hace el update primero ...esto no es mala idea pero no siento que este bien ejecutado de esta manera
  //++$i;
}
//echo "id".$autor;
//if ($autor='0'){
	
//}else

    echo"<br>".$query = "INSERT INTO datosp (
    Id_usuario,
    Periodo,
    SD,
    Pasajediario,
    diaspago,
    tincentivo,
	  tincentivop,
    transferencia,
    cheque,
    infonavit,
    cahorro,
    ucfdi,
    dias_trabajados,
    ddescanso,
	  dvac,
    us_nombre_real,
    dias_adicionales,
    sueldos,
    Pasajes,
    Incentivos,
    us_nombre,
    estatus,
    ultima_actualizacion)
    SELECT Id_usuario,
   '$periodo3',
    SD,
    Pasajes,
    diaspago,
    incdia,
		incentivosp,
    transferencia,
    cheque,
    infonavit,
    cahorro,
    ucfdi,
    dias_trabajados,
    ddescanso,
		dvac,
    us_nombre_real,
    dias_adicionales,
    sueldo,
    Pasajes,
    incdia,
    us_nombre,
    estatus,
    '$dateTimeVariable' FROM usuarionom WHERE gafete = 'B'";
//me preocupa el current timestamp no hay quejas aun pero ver sdi a futuro le ponemos una variable con formato data format
/*$query1 = "INSERT INTO periodo (periodo,fechaautorizado,diai,diaf,Autorizado)
SELECT  '$dateAldate', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP,'$datePlus12',1 FROM usuario"; */

/* $query1 = "INSERT INTO periodo (periodo, fechaautorizado, diai,diaf, Autorizado)
VALUES ('$dateAldate',CURRENT_TIMESTAMP,CURRENT_TIMESTAMP,'$datePlus12','1')"; */
//echo $query;
sqlsrv_query($conn, $query) or die (print_r( sqlsrv_errors(), true));

$sql_ttperiodo = sqlsrv_query($conn, "SELECT TOP 1 periodo, period, sem, sema fROM periodo ORDER BY idp DESC");
 if($h=sqlsrv_fetch_array($sql_ttperiodo)) {
                                $idpb=$h['idp'];
								$perac=$h['sema'];
								//echo "pera c". $perac;
                      
                            } 
                            
$query_peridodo_updt = "UPDATE periodo SET Autorizado ='1', id_us_autorizo='$id', fechaautorizado = '$dateTimeVariable' WHERE idp = '$perac' "; 

//echo "periodo ".$query_peridodo_updt. "Pera +".$perac ;

//sqlsrv_query($conn, $query1) or die (print_r( sqlsrv_errors(), true));
//sqlsrv_query($conn, $query2) or die (print_r( sqlsrv_errors(), true));
sqlsrv_query($conn, $query_peridodo_updt) or die (print_r( sqlsrv_errors(), true));


header("location: dashboard.php");
 //header("location: dashboard.php"); 

//echo $periodo3 ;
//echo $ultimoPeriodo ;

}
?>














