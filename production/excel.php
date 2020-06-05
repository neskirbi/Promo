<?php
include "head.php";
include "sidebar.php";

     session_start();        
     $id= $_SESSION['user_log']; 
	
        $sql4 = sqlsrv_query($conn, "SELECT TOP 1 periodo, period, sem, sema FROM periodo ORDER BY idp DESC");
                           if($c=sqlsrv_fetch_array($sql4)) {
                                $ultimoPeriodo=$c['periodo'];
								$peractual=$c['period'];
								$semperiodo=$c['sem'];
								$semac=$c['sema'];
                      
                            } 



if (isset($_POST["enviar"])) {//nos permite recepcionar una variable que si exista y que no sea null
	require_once("conexion.php");
	require_once("functions.php");
	
	
	$archivo = $_FILES["archivo"]["name"];
	$archivo_copiado= $_FILES["archivo"]["tmp_name"];
	$archivo_guardado = "copia_".$archivo;
	
	$extension = end(explode(".", $_FILES['archivo']['name']));
	
	if ($extension != "csv"){
		//echo "Archivo no compatible";
	
		echo "<script>
                alert('Archivo no compatible');
                window.location= 'excel.php'
				</script>";
	}
	else{
		echo "";
	}
	
	//echo $archivo."esta en la ruta temporal: " .$archivo_copiado;

	if (copy($archivo_copiado ,$archivo_guardado )) {
				 
		//echo "Se guardo el archivo en nuestra carpeta temporal <br/>";
		
		echo "<br>";   
	}else{
		echo "Error en archivo <br/>";
	}
    
    if (file_exists($archivo_guardado)) {
    	 
    	 $fp = fopen($archivo_guardado,"r");//abrir un archivo
         $rows = 0;
         while ($datos = fgetcsv($fp , 1000 , ",")) {
         	    $rows ++;
			         	
         	if ($rows > 1) {
         		//$resultado = insertar_datos($datos[0],$datos[1]);
				$resultado = update_datosn($datos[0],$datos[1],$datos[2],$datos[3],$datos[4],$datos[5],$peractual,$semperiodo,$semac);	
								
			if($resultado == "existe"){
         		//echo "se insertaron los datos correctamnete<br/>";
				//echo "Se actualizo el incentivo al empleado ".$datos[0]."<br/>";
				
         	}else{
         		//echo "no se insertaron los incentivos <br/>";
				echo "Alerta No se actualizo el incentivo al empleado numero ".$datos[0]." <br/>";
				//echo "<br>";   
		     	}
         	}
     
		}

    }else{
    	echo "El archivo esta vacio <br/>";
    }

}


?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
<?php



?>	
	
	<title>Actualizar incentivos semanales </title>
</head>
<body>

  <div class="">
            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Importar Incentivos <?php echo "Periodo "?> </h2>
                    <div class="clearfix"></div>
                  </div>
					<div class="formulario">
					    <form action="excel.php" class="formulariocompleto" method="post" enctype="multipart/form-data">
							<table width="600">
							  <tr>
							    <td>Name file:</td>
								<td><input type="file" name="archivo" class="form-control"/></td>
								<td><input type="submit" value="Upload" class="form-control" name="enviar"></td>
							  </tr>
							</table>		
					  	</form>
					</div>				   
			  </div>
				
<!---  instruciones --->                
                <div class="x_panel">

                  <div class="x_title">
                    <h2>Instruciones: </h2>
         
                    <div class="clearfix"></div>
                  </div>


                  <div class="x_content">
					1 - Crear documento Excel como en el ejemplo:<br>
					<img src="images/1.jpg" alt="Trulli" ><br><br>
					2 - Dentro del documento anotamos dentro del primer renglón los títulos de referencia id y incdia correspondiente al identificador de empleado y su incentivo correspondiente.<br>
					<img src="images/2.jpg" alt="Trulli"><br> <br>
					3 - Guardamos el documento en nuestro equipo y en "tipo" seleccionamos como tipo de documento "CSV (delimitado por comas) (*.csv)" y guardamos <img src="images/5.jpg" alt="Trulli">.<br>
					<img src="images/4.jpg" alt="Trulli" ><br><br>
					4 - Dentro de nuestra Herramienta en nuestro modulo de "Importar Incentivos" seleccionamos nuestro documento.<br> 
					<img src="images/7.jpg" alt="Trulli"><br>
					<img src="images/6.jpg" alt="Trulli"><br><br>
					5 - Al tener cargado el documento podremos ver el titulo.<br>
					<img src="images/8.jpg" alt="Trulli"><br><br>
					6 - Presionamos el botón de Upload para importar la información <img src="images/9.jpg" alt="Trulli">.<br><br>
                  </div>
                </div>

              </div>
            </div>
          </div> 
	 
	 
</body>
</html>
