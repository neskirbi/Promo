<?php
 function insertar_datos($nombre,$fecha){
 		global $conexion;
 	$sentencia = "INSERT into Prueba (param1,param2) values ('$nombre','$fecha')";
 	$ejecutar = odbc_exec($conexion, $sentencia); //mysqli_query($conexion,$sentencia);
 	return $ejecutar;
			
 }
 
 function update_datos($nempleado,$incentivo,$incentivo2,$incentivo3,$incentivo4){
 		global $conexion;
     $dias = array("domingo","lunes","martes","miercoles","jueves","viernes","sabado");
	 
	 //echo "Hoy es es ".$dias[date("w")];		
		
	$sql4 = sqlsrv_query($conexion, "SELECT TOP 1 periodo, period, sem FROM periodo ORDER BY idp DESC");
			                if($c=sqlsrv_fetch_array($sql4)) {
                                $ultimoPeriodo=$c['periodo'];
								$peractual=$c['period'];
								$semperiodo=$c['sem'];
                      
              } 
		
	$sentenciac = "SELECT incdia,is1,is2,is3,is4, ucfdi from usuarionom where ucfdi='$nempleado'";
	  $sql_s = odbc_exec($conexion, $sentenciac);
		
		if(odbc_fetch_row($sql_s))
			 {
		
			 switch ($semana )
			 {
				 case "1":
				   $sentencia = "UPDATE usuarionom set is1='$incentivo', is2='$incentivo2', is3='$incentivo3', is4='$incentivo4' where ucfdi='$nempleado'".$sql;
				   $ejecutar = odbc_exec($conexion, $sentencia); //mysqli_query($conexion,$sentencia);
			       $res ="existe";
				  break;
				 case "2":
				   $sentencia = "UPDATE usuarionom set is1='$incentivo', is2='$incentivo2', is3='$incentivo3', is4='$incentivo4' where ucfdi='$nempleado'".$sql;
				   $ejecutar = odbc_exec($conexion, $sentencia); //mysqli_query($conexion,$sentencia);
			       $res ="existe";
				  break;
				 case "3":
				   $sentencia = "UPDATE usuarionom set is1='$incentivo', is2='$incentivo2', is3='$incentivo3', is4='$incentivo4' where ucfdi='$nempleado'".$sql;
				   $ejecutar = odbc_exec($conexion, $sentencia); //mysqli_query($conexion,$sentencia);
			       $res ="existe";
				  break;
				 case "4":
				   $sentencia = "UPDATE usuarionom set is1='$incentivo', is2='$incentivo2', is3='$incentivo3', is4='$incentivo4' where ucfdi='$nempleado'".$sql;
				   $ejecutar = odbc_exec($conexion, $sentencia); //mysqli_query($conexion,$sentencia);
			       $res ="existe";
				  break;
				  default:
				  $res ="existe";
			 }

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