<?php
    $title ="Tickets | ";
    include "head.php";
    include "sidebar.php";
    //nota en el head esta el conect db
?>

<!----------------------------------------------------------------------------------------------------------------------------------------------------->  


<div class="col-md-12 col-sm-12 col-xs-12">
<div class="tile-stats">
     <div class="x_panel ">
      <?php     
//solo lo que corresponde al que se logeo ...falta moverle el id usuaro por otra cosa
//$result = sqlsrv_query($conn, "SELECT * FROM usuario WHERE Id_usuario=".$_SESSION['Id_usuario']." ORDER BY Id_usuario DESC");
$timestamp = mktime(0, 0, 0, date('n') - 1, 21);
      $lastday = date('t/m/Y',strtotime('last month'));
          

//$result = sqlsrv_query($conn, "SELECT * FROM usuario ORDER BY Id_usuario DESC");  
$sql4 = sqlsrv_query($conn, "SELECT TOP 1 periodo FROM periodo ORDER BY idp DESC");
 if($c=sqlsrv_fetch_array($sql4)) {
                                $ultimoPeriodo=$c['periodo'];
                      
                            } 



$result2 = sqlsrv_query( $conn, "SELECT asistencia FROM asistencia");

$result = sqlsrv_num_rows( $result2 );


echo $result;


?>
                  <div class="x_title ">
                    <h4><i class="fa fa-globe"> Personal activo autorizado.</i></h4><h4 class="pull-right">Periodo: <?php echo $ultimoPeriodo;  ?>.</h4>
                     <div class="clearfix"></div>
                  </div>

    <div class="x_content">
    <div class="row">

<div class="table-responsive">


<?php 



//aqui inicia 1        
        $sql = "SELECT * FROM usuarionom ORDER BY Id_usuario ASC";
        $result = sqlsrv_query($conn, $sql);
    

// aqui el 2
    $i = 0;  ?>
    <form name='form_update' method='post' id="registerUser" action='update.php'>
<div class="pull-right">
<a class='btn btn-danger' onclick="return confirm('Al proseguir con esta opcion se generara un periodo correspondiente al actual, esta seguro de proseguir ?')" href="update_generar.php">Autorizar Nóminar</a> 
<!---td><input type='submit' value='Update' onclick='myFunction()' class='btn btn-info' data-toggle='confirmation' data-title='Proceed with Action?' /></td--->
<input type='submit' value='Actualizar Nóminar'  name='Editar1' class='btn btn-info' data-toggle='confirmation' data-title='Proceeder con Editar?' />
</div>


    <table class="table table-striped jambo_table table-bordered col-xs-12">

      <thead>
    <tr>
    <th class="text-center">#</th>
    <th></th>
    <th class="text-center">No.Empleado</th> 
    <th class="text-center">Foto</th>
    <th class="text-center">Nombre</th>
<!---th>Ruta</th--->
<th class="text-center">Puesto</th>
<th class="text-center">Ruta</th>
<th class="text-center">Estado</th>
<th class="text-center">Fecha Alta</th>
<th class="text-center">Fecha Baja</th>
<th class="text-center">Sueldo Diario</th>
<th class="text-center">Días Trabajados</th>
<th class="text-center"> Dias descanso </th> <!---  agregado--->
<th class="text-center"> Faltas </th> <!---  agregado---><!---  --->

<th class="text-center">Días Adicionales</th> 

<th class="text-center"> Dias de Descanso Adicionales </th> <!---  agregado--->
<th class="text-center">Pasaje Diario</th>
<th class="text-center">Incentivos</th><!--- // --->




   

    </tr>
    </thead>
</tbody>  



<?php
    while ($usuario = sqlsrv_fetch_array($result)) {

  //$idusuario=$usuario['id'];
  $foto=$usuario['foto'];
  $us_nombre_real=utf8_encode($usuario['us_nombre_real']);
  $ruta=$usuario['ruta'];
  $puesto=$usuario['puesto'];
  $NoEmpleado=$usuario['ucfdi'];
  $usuario_pago=$usuario['pago'];
 
 
$sueldos=$usuario['sueldos'];
$usuario_Incentivos=$usuario['Incentivos'];
$usuario_incent_diario=$usuario['incent_diario'];

$id_ruta=$usuario['us_nombre'];
$fecha_baja_us= $usuario['fecha_entrega'];
$fecha_alta_us= date_format ($usuario['fechaalta'], 'd-m-Y');

$sueldo_diario=$usuario['SD'];
$dias_trabajados=$usuario['dias_trabajados'];
$dias_adicionales=$usuario['dias_adicionales'];
$pasajes=$usuario['Pasajes'];
$incentivo=$usuario['incdia'];
$ddescanso=$usuario['ddescanso'];
$estatus=$usuario['estatus'];
$Id_usuario=$usuario['Id_usuario'];
$last_periodo_date = "25-".date("m-Y", strtotime("- 1 month")) ;



$sql_puesto = sqlsrv_query($conn, "select * from puesto where id=$puesto");
                            if($c=sqlsrv_fetch_array($sql_puesto)) {
                                $puesto_descripcion=$c['descripcion'];
                      
                            } 

$sql_periodo = sqlsrv_query($conn, "SELECT TOP 1 periodo FROM periodo ORDER BY idp DESC");
 if($a=sqlsrv_fetch_array($sql_periodo)) {
                                $ultimoPeriodo=$a['periodo'];
                      
                            } 

$sql_asistencia = sqlsrv_query($conn, "select asistencia from asistencia where id_usuario='49'");

                            if($d=sqlsrv_fetch_array($sql_asistencia)) {
                                $asistencia_fecha=date_format ($d['fecha'], 'd-m-Y');
                                $asistencias_asistidas=$d['asistencia'];



                            }                            

$row_cnt = sqlsrv_num_rows($sql_asistencia);
$total_asistencias+=$asistencias_asistidas;

$fechawewe+=$asistencia_fecha;
$total+=$usuario['incdia'];                          
$total_us_pago+=$usuario['pago'];
$total_us_pasaje+=$usuario['Pasajes'];
$total_us_dias_trabajados+=$usuario['dias_trabajados'];  
$total_us_dias_adicionales+=$usuario['dias_adicionales']; 
$total_us_sueldos+=$usuario['sueldos']; 

//-------------------
$total+=$periodo['incdia'];                          
$total_us_pago+=$periodo['pago'];
$total_us_dias_trabajados+=$periodo['dias_trabajados'];  
$total_us_dias_adicionales+=$periodo['dias_adicionales']; 
$total_us_sueldos+=$periodo['sueldos']; 
$suma_de_todo+=$total_suma_final;
//operadores
$OneDivSix = 1/6;
$toatels_trabajados = ($dias_adicionales+($dias_adicionales*($OneDivSix)))+($dias_trabajados+($dias_trabajados*($OneDivSix)));
$totales_adicionales = $dias_adicionales*($OneDivSix);
$totales_trabj_sueld = $toatels_trabajados*$sueldos;
$dias_descanso = $dias_trabajados*($OneDivSix);
$pasaje_total= $toatels_trabajados*$pasajes;
$pasaje_monto= 50*$pasaje_total;
$total_suma_final = $totales_trabj_sueld+$incentivo+$pasaje_total;
$pasajes_suma +=$pasajes;
$suma_pasaje_total+=$pasaje_total;
$suma_totales_trabj_sueld+=$totales_trabj_sueld;
$suma_sueldos+=$sueldos;
$suma_toatels_trabajados+=$toatels_trabajados;
$suma_totales_adicionales+=$totales_adicionales;
$suma_infonavit+=$infonavit;
$suma_cahorro+=$cahorro;
//-------------------
echo $row_cnt;
  echo '<tr>';
  echo "<td class='text-center'>{$usuario['Id_usuario']}<input type='hidden' name='Id_usuario[$i]' value='{$usuario['Id_usuario']}' /></td>";

  echo "<td><a href=\"edit.php?id=$usuario[Id_usuario]\">Editar</a> </td>";

  echo "<td class='text-center'>$NoEmpleado</td>";
  echo "<td class='text-center'><img src='$foto'  width='56'></td>";
  echo "<td class='text-center'>$us_nombre_real</td>";

  //echo "<td>$ruta</td>";
  echo "<td class='text-center'>$puesto_descripcion</td>";

  echo "<td class='text-center'>$id_ruta</td>";

echo "<td class='text-center'>$estatus</td>";

  echo "<td class='text-center'>$fecha_alta_us</td>"; 
  //echo "<td>$fecha_baja_us</td>"; 
  echo "<td class='text-center'>$fecha_baja_us</td>";

?>

  <td class="text-center">$<?php echo number_format($sueldo_diario, 2, ".", ","); ?></td> 
<?php
echo "<td><input type='text' class='form-control' onkeypress='return /\d/.test(String.fromCharCode(((event||window.event).which||(event||window.event).which)));' name='dias_trabajados[$i]' value='$dias_trabajados' /></td>";
//cambio de value='{$usuario['dias_trabajados']}' a value='$dias_trabajados'
 ?>

  <td class="text-center"><?php echo number_format($dias_descanso, 2, ".", ","); ?></td> <!--- agregado colocar suma--->
  

<!---

  $asistencia_fecha;

--->


  <td class="text-center"><?php echo $total_asistencias; ?></td> <!--- agregado faltas, valores donde !asistencia where fecha = periodo actual--->

  <?php
  

echo "<td><input type='text' class='form-control' onkeypress='return /\d/.test(String.fromCharCode(((event||window.event).which||(event||window.event).which)));' name='dias_adicionales[$i]' value='{$usuario['dias_adicionales']}' /></td>";

/* echo "<td><input type='text' class='form-control' onkeypress='return /\d/.test(String.fromCharCode(((event||window.event).which||(event||window.event).which)));' name='sueldos[$i]' value='{$usuario['sueldos']}' /></td>"; */

?>
<td class="text-center"><?php echo number_format($totales_adicionales, 2, ".", ","); ?> </td>

<?php

echo "<td><input type='text' class='form-control' onkeypress='return /\d/.test(String.fromCharCode(((event||window.event).which||(event||window.event).which)));' name='Pasajes[$i]' value='{$usuario['Pasajes']}' /></td>";

echo "<td><input type='text' class='form-control' onkeypress='return /\d/.test(String.fromCharCode(((event||window.event).which||(event||window.event).which)));' name='incdia[$i]' value='{$usuario['incdia']}' /></td>"; 


  echo '</tr>';
        ++$i;
    } ?>
<?php /*   <tr>
   <td></td>
   <td></td>
   <td></td> 
   <td></td> 
   <td>Total</td>
   <td><?php echo $total_us_dias_adicionales; ?></td>
   <td>$<?php echo number_format($total_us_sueldos, 2, ".", ","); ?></td> 
   
   <td><?php echo $total_us_dias_trabajados; ?></td>
   

   <td>$<?php echo number_format($total_us_pasaje, 2, ".", ","); ?></td> 
   <td>$<?php echo number_format($total, 2, ".", ","); ?></td>
    
   </tr> */ ?>





    



   
   </form>
</tbody>   
   </table>
</div>
</div>
<div>
</div>
</div>
      </div>
</div>
</div> 



<!----------------------------------------------------------------------------------------------------------------------------------------------------->        
<script type="text/javascript">
var form = document.getElementById('registerUser');
form.onsubmit = function () {
    // this method is cancelled if window.confirm returns false
    return window.confirm('Proceeder con esta Acción?');

}
</script>

<?php include "footer.php" ?>