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
        $sql = "SELECT * FROM usuario ORDER BY Id_usuario ASC";
        $result = sqlsrv_query($conn, $sql);
    

// aqui el 2
    $i = 0;  ?>

    <table class="table table-striped jambo_table table-bordered">
 
</tbody>  
    <form name='form_update' method='post' id="registerUser" action='periodo_update.php'>
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
$SD=$usuario['SD'];
$Pasajes=$usuario['Pasajes'];
$DiasT=$usuario['DiasT'];
$Incentivos=$usuario['Incentivos'];
$transferencia=$usuario['transferencia'];
$cheque=$usuario['cheque'];
$infonavit=$usuario['infonavit'];
$cahorro=$usuario['cachorro'];
  $dias_trabajados=$usuario['dias_trabajados'];
 $dias_adicionales=$usuario['dias_adicionales'];
$OneDivSix = 1/6;
$dias_descanso = $DiasT*($OneDivSix);
$dias_adicionales=$usuario['dias_adicionales'];

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
  //echo "<td>$NoEmpleado</td>";
echo "<td> $SD </td>";
echo "<td> $Pasajes </td>";
echo "<td> $DiasT </td>";
echo "<td> $Incentivos </td>";
echo "<td> $transferencia </td>";
echo "<td> $cheque </td>";
echo "<td> $infonavit </td>";
echo "<td> $cachorro </td>";
echo "<td> $infonavit </td>";
echo "<td> $cahorro </td>";
echo "<td> $dias_descanso </td>";
echo "<td> $dias_adicionales </td>";



 // echo "<td><img src='$foto'  width='56'></td>";
  //echo "<td>$us_nombre_real</td>";

  //echo "<td>$ruta</td>";
  // echo "<td>$puesto_descripcion</td>";




echo "<input type='hidden' class='form-control' name='us_nombre_real[$i]' value='{$usuario['us_nombre_real']}' /></td>";


echo "<input type='hidden' class='form-control' name='Id_usuario[$i]' value='{$usuario['Id_usuario']}' />";
echo "<input type='hidden' class='form-control' name='incdia[$i]' value='{$usuario['incdia']}' />";
echo "<input type='hidden' class='form-control' name='puesto[$i]' value='{$usuario['puesto']}' />";
echo "<input type='hidden' class='form-control' name='ruta[$i]' value='{$usuario['ruta']}' />";
echo "<input type='hidden' class='form-control' name='ucfdi[$i]' value='{$usuario['ucfdi']}' />";
echo "<input type='hidden' class='form-control' name='foto[$i]' value='{$usuario['foto']}' />";



  echo '</tr>';
        ++$i;
    } ?>
   <tr>
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
<td><input type='submit' value='Update' class='btn btn-info' data-toggle='confirmation'  /></td>
  
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
    return window.confirm('Esta REALMENTE seguro de que quieres guardar este periodo?');

}
</script>         
<?php include "footer.php" ?>