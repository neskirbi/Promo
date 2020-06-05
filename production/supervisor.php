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
                  <div class="x_title ">
                    <h2>Head Count Main</h2>
                    <div class="clearfix"></div>
                  </div>
    <div class="x_content">
    <div class="row">

<div class="table-responsive">


<?php 



//aqui inicia 1        
        $sql = "SELECT * FROM usuario";
        $result = sqlsrv_query($conn, $sql);
    

// aqui el 2
    $i = 0;  ?>

    <table class="table table-striped jambo_table table-bordered">
      <thead>
    <tr>
    <td>#</td>
    <th>No.Empleado</th> 
    <td>foto</td>
    <th>Nombre</th>
<th>Ruta</th>
<th>Puesto</th>

<td>pagos</td>
<th>Sueldos</th>
<th>D. Trabajados</th>
<th>D. Adicionales</th>    

    </tr>
    </thead>
</tbody>  
    <form name='form_update' method='post' action='update_supervisor.php'>
<?php
    while ($usuario = sqlsrv_fetch_array($result)) {

  $idusuario=$usuario['idusuario'];
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

$sql = sqlsrv_query($conn, "select * from puesto where id=$puesto");
                            if($c=sqlsrv_fetch_array($sql)) {
                                $puesto_descripcion=$c['descripcion'];
                      
                            } 

$total+=$usuario['incdia'];                          
$total_us_pago+=$usuario['pago'];
$total_us_dias_trabajados+=$usuario['dias_trabajados'];  
$total_us_dias_adicionales+=$usuario['dias_adicionales']; 
$total_us_sueldos+=$usuario['sueldos']; 


  echo '<tr>';
  echo "<td>{$usuario['idusuario']}<input type='hidden' name='idusuario[$i]' value='{$usuario['idusuario']}' /></td>";
  echo "<td>$NoEmpleado</td>";
  echo "<td><img src='$foto'  width='56'></td>";
  echo "<td>$us_nombre_real</td>";

  echo "<td>$ruta</td>";
  echo "<td>$puesto_descripcion</td>";


echo "<td><input type='text' class='form-control'  name='pago[$i]' value='{$usuario['pago']}' /></td>";

echo "<td><input type='text' class='form-control'  name='sueldos[$i]' value='{$usuario['sueldos']}' /></td>";

echo "<td><input type='text' class='form-control'  name='dias_trabajados[$i]' value='{$usuario['dias_trabajados']}' /></td>";

echo "<td><input type='text' class='form-control'  name='dias_adicionales[$i]' value='{$usuario['dias_adicionales']}' /></td>";

  echo '</tr>';
        ++$i;
    } ?>
   <tr>
   <td></td>
   <td></td>
   <td></td>
   <td></td>
   <td></td>
   <td>Total</td>
   <td><?=$total_us_pago ?></td>
   <td><?=$total_us_sueldos ?></td>   
   <td><?=$total_us_dias_trabajados ?></td>
   <td><?=$total_us_dias_adicionales ?></td>

   </tr>


   <tr>
   <td></td>
   <td></td>
   <td></td>
   <td></td>
   <td></td>
   <td></td>
   <td></td>

   <td></td>
   <td></td>   
<td><input type='submit' value='Update' class='btn btn-info'/></td>
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
<?php include "footer.php" ?>