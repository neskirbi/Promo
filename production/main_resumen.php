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

      
//$result = sqlsrv_query($conn, "SELECT * FROM usuario ORDER BY Id_usuario DESC");  
$sql4 = sqlsrv_query($conn, "SELECT TOP 1 Periodo FROM datosp ORDER BY Periodo DESC");
 if($c=sqlsrv_fetch_array($sql4)) {
                                $ultimoPeriodo=$c['Periodo'];
                      
                            } 
?>
                  <div class="x_title ">
                    <h2><i class="fa fa-globe"> Personal activo autorizado</i></h2><h2 class="pull-right"><?php echo $ultimoPeriodo; ?></h2>
                    <div class="clearfix"></div>
                  </div>

    <div class="x_content">
    <div class="row">

<div class="table-responsive">


<?php 



//aqui inicia 1        
        $sql = "SELECT * FROM usuario ORDER BY Id_usuario ASC";
        $result = sqlsrv_query($conn, $sql);
    

// aqui el 2
    $i = 0;  ?>
    <form name='form_update' method='post' id="registerUser" action='update.php'>
<div class="pull-right">
<a class='btn btn-danger' onclick="return confirm('Al proseguir con esta opcion se generara un periodo correspondiente al actual, esta seguro de proseguir ?')" href="update_generar.php">Autorizar Nóminar</a> 
<!---td><input type='submit' value='Update' onclick='myFunction()' class='btn btn-info' data-toggle='confirmation' data-title='Proceed with Action?' /></td--->
<input type='submit' value='Actualizar Nóminar'  name='Editar1' class='btn btn-info' data-toggle='confirmation' data-title='Proceeder con Editar?' />
</div>


    <table class="table table-striped jambo_table table-bordered">

      <thead>
    <tr>
    <td>#</td>
    <th>No.Empleado</th> 
    <td>Foto</td>
    <th>Nombre</th>
<!---th>Ruta</th--->
<th>Puesto</th>

<th>Días Trabajados</th>
<th>Días Adicionales</th> 
<th>Sueldo Diario</th>
<td>Pasaje Diario</td>
<td>Incentivos</td>

   

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
  $incentivo=$usuario['incdia'];
  $usuario_pago=$usuario['pago'];
  $dias_trabajados=$usuario['dias_trabajados'];
 $dias_adicionales=$usuario['dias_adicionales'];
$sueldos=$usuario['sueldos'];
$usuario_Incentivos=$usuario['Incentivos'];
$usuario_incent_diario=$usuario['incent_diario'];
$pasajes=$usuario['Pasajes'];

$sql = sqlsrv_query($conn, "select * from puesto where id=$puesto");
                            if($c=sqlsrv_fetch_array($sql)) {
                                $puesto_descripcion=$c['descripcion'];
                      
                            } 

$total+=$usuario['incdia'];                          
$total_us_pago+=$usuario['pago'];
$total_us_pasaje+=$usuario['Pasajes'];
$total_us_dias_trabajados+=$usuario['dias_trabajados'];  
$total_us_dias_adicionales+=$usuario['dias_adicionales']; 
$total_us_sueldos+=$usuario['sueldos']; 


  echo '<tr>';
  echo "<td>{$usuario['Id_usuario']}<input type='hidden' name='Id_usuario[$i]' value='{$usuario['Id_usuario']}' /></td>";
  echo "<td>$NoEmpleado</td>";
  echo "<td><img src='$foto'  width='56'></td>";
  echo "<td>$us_nombre_real</td>";

  //echo "<td>$ruta</td>";
  echo "<td>$puesto_descripcion</td>";

//$incentivo=$usuario['incdia'];
//$incent_diario=$usuario['incent_diario'];

echo "<td><input type='text' class='form-control' onkeypress='return /\d/.test(String.fromCharCode(((event||window.event).which||(event||window.event).which)));' name='dias_trabajados[$i]' value='{$usuario['dias_trabajados']}' /></td>";

echo "<td><input type='text' class='form-control' onkeypress='return /\d/.test(String.fromCharCode(((event||window.event).which||(event||window.event).which)));' name='dias_adicionales[$i]' value='{$usuario['dias_adicionales']}' /></td>";

echo "<td><input type='text' class='form-control' onkeypress='return /\d/.test(String.fromCharCode(((event||window.event).which||(event||window.event).which)));' name='sueldos[$i]' value='{$usuario['sueldos']}' /></td>";

echo "<td><input type='text' class='form-control' onkeypress='return /\d/.test(String.fromCharCode(((event||window.event).which||(event||window.event).which)));' name='Pasajes[$i]' value='{$usuario['Pasajes']}' /></td>";

echo "<td><input type='text' class='form-control' onkeypress='return /\d/.test(String.fromCharCode(((event||window.event).which||(event||window.event).which)));' name='incdia[$i]' value='{$usuario['incdia']}' /></td>";





  echo '</tr>';
        ++$i;
    } ?>
   <tr>
   <td></td>
   <td></td>
   <td></td> 
   <td></td> 
   <td>Total</td>
   <td><?=$total_us_dias_trabajados ?></td>
   <td><?=$total_us_dias_adicionales ?></td>
   <td><?=$total_us_sueldos ?></td>
   <td><?=$total_us_pasaje ?></td> 
   <td><?=$total ?></td>
    
   </tr>





    



   
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