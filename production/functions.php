<?php
 function insertar_datos($nombre,$fecha){
 		global $conexion;
 	$sentencia = "INSERT into Prueba (param1,param2) values ('$nombre','$fecha')";
 	$ejecutar = odbc_exec($conexion, $sentencia); //mysqli_query($conexion,$sentencia);
 	return $ejecutar;
			
 }
 
 function update_datosn($nempleado,$periodo,$incentivo1,$incentivo2,$incentivo3,$incentivo4,$perac,$semc,$sema){
  global $conexion;
  $dias = array("domingo","lunes","martes","miercoles","jueves","viernes","sabado");

    $peractual = $perac; //$peractual1;
	$semperiodo = $semc; //$semperiodo1;
    $semact = $sema; //$semac1;	
	
    $an = date("Y");	
    $idcalc1 = $nempleado."".$an."".$peractual."".$semperiodo."".$semact."1";	
	$ckey1 = $nempleado.$an."PD".$peractual."-1";
	
	$sentenciac = "SELECT idempleado, periodo, sem, incentivo, sema, ckey from incentivo where ckey='$ckey1'";
	$sql_s = odbc_exec($conexion, $sentenciac);
		   if(odbc_fetch_row($sql_s))
			 {			 
		    //echo "Entro aqui primero".$ckey1;
			  $sentencia = "UPDATE incentivo set incentivo='$incentivo1'  where ckey='$ckey1'".$sql;
			  $ejecutar = odbc_exec($conexion, $sentencia); //mysqli_query($conexion,$sentencia);
			  $res ="existe";
			 }
			else
			 {
			  $semperiodo = "1";
			  $semact1b = $an."PD".$peractual."-1";
			  $sentencia = "INSERT into incentivo (idempleado,pano,periodo,sem,incentivo,sema,ckey) values('$nempleado', '$an','$peractual','$semperiodo','$incentivo1','$semact1b','$ckey1')";
			  $ejecutar = odbc_exec($conexion, $sentencia); //mysqli_query($conexion,$sentencia);	 
			  $res ="No existe";
			 }	
	$idcalc2 = $nempleado."".$an."".$peractual."".$semperiodo."".$semact."2";
	$ckey2 = $nempleado.$an."PD".$peractual."-2";	
	$sentenciac = "SELECT idempleado, periodo, sem, incentivo, sema, ckey from incentivo where ckey='$ckey2'";
	//"SELECT Id_actividad from actividad where Idcliente='$Id_cliente' and Idusuario='$Id_ruta' and FechaVisita='$fechavisita'";
		$sql_s = odbc_exec($conexion, $sentenciac);
		   if(odbc_fetch_row($sql_s))
			 {
				//echo "Si existe en la BD2"; no hacer nada				
			  $sentencia = "UPDATE incentivo set incentivo='$incentivo2'  where ckey='$ckey2'".$sql;
			  $ejecutar = odbc_exec($conexion, $sentencia); //mysqli_query($conexion,$sentencia);
			  $res ="existe";
			 }
			else
			 {
			  $semperiodo = "2";
			  $semact2b = $an."PD".$peractual."-2";
			  $sentencia = "INSERT into incentivo (idempleado,pano,periodo,sem,incentivo,sema,ckey) values('$nempleado', '$an','$peractual','$semperiodo','$incentivo2','$semact2b','$ckey2')";
			  $ejecutar = odbc_exec($conexion, $sentencia); //mysqli_query($conexion,$sentencia);	 
			  $res ="No existe";
			 }	
	
	$idcalc3 = $nempleado."".$an."".$peractual."".$semperiodo."".$semact."3";		
	$ckey3 = $nempleado.$an."PD".$peractual."-3";
	$sentenciac = "SELECT idempleado, periodo, sem, incentivo, sema, ckey from incentivo where ckey='$ckey3'";
	//"SELECT Id_actividad from actividad where Idcliente='$Id_cliente' and Idusuario='$Id_ruta' and FechaVisita='$fechavisita'";
		$sql_s = odbc_exec($conexion, $sentenciac);
		   if(odbc_fetch_row($sql_s))
			 {
				//echo "Si existe en la BD"; no hacer nada				
			  $sentencia = "UPDATE incentivo set incentivo='$incentivo3'  where ckey='$ckey3'".$sql;
			  $ejecutar = odbc_exec($conexion, $sentencia); //mysqli_query($conexion,$sentencia);
			  $res ="existe";
			 }
			else
			 {
			  $semperiodo = "3";
			  $semact3b = $an."PD".$peractual."-3";
			  $sentencia = "INSERT into incentivo (idempleado,pano,periodo,sem,incentivo,sema,ckey) values('$nempleado', '$an','$peractual','$semperiodo','$incentivo3','$semact3b','$ckey3')";
			  $ejecutar = odbc_exec($conexion, $sentencia); //mysqli_query($conexion,$sentencia);	 
			  $res ="No existe";
			 }	

	$idcalc4 = $nempleado."".$an."".$peractual."".$semperiodo."".$semact."4";	
	$ckey4 = $nempleado.$an."PD".$peractual."-4";	
	$sentenciac = "SELECT idempleado, periodo, sem, incentivo, sema, ckey from incentivo where ckey='$ckey4'";
	//"SELECT Id_actividad from actividad where Idcliente='$Id_cliente' and Idusuario='$Id_ruta' and FechaVisita='$fechavisita'";
		$sql_s = odbc_exec($conexion, $sentenciac);
		   if(odbc_fetch_row($sql_s))
			 {
				//echo "Si existe en la BD"; no hacer nada				
			  $sentencia = "UPDATE incentivo set incentivo='$incentivo4'  where ckey='$ckey4'".$sql;
			  $ejecutar = odbc_exec($conexion, $sentencia); //mysqli_query($conexion,$sentencia);
			  $res ="existe";
			 }
			else
			 {
			  $semperiodo = "4";
			  $semact4b = $an."PD".$peractual."-4";
			  $sentencia = "INSERT into incentivo (idempleado,pano,periodo,sem,incentivo,sema,ckey) values('$nempleado', '$an','$peractual','$semperiodo','$incentivo4','$semact4b','$ckey4')";
			  $ejecutar = odbc_exec($conexion, $sentencia); //mysqli_query($conexion,$sentencia);	 
			  $res ="No existe";
			 }
	
		return $res;
 }
 
 
  function update_datos($nempleado,$periodo,$incentivo,$incentivo2,$incentivo3,$incentivo4){
 		global $conexion;
		
	$sentenciac = "SELECT incdia, ucfdi from usuarionom where ucfdi='$nempleado'";
	//"SELECT Id_actividad from actividad where Idcliente='$Id_cliente' and Idusuario='$Id_ruta' and FechaVisita='$fechavisita'";
 	$sql_s = odbc_exec($conexion, $sentenciac);
		
		if(odbc_fetch_row($sql_s))
			 {
				//echo "Si existe en la BD"; no hacer nada				
			  $sentencia = "UPDATE usuarionom set incdia='$incentivo' where ucfdi='$nempleado'".$sql;
			  $ejecutar = odbc_exec($conexion, $sentencia); //mysqli_query($conexion,$sentencia);
			  $res ="existe";
			 }
			else
			 {
			  $res ="No existe";
			 }	
	
		return $res;
 }
 
?>