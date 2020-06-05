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
                    <h2>Personal Activo Periodo</h2>
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
<input type="text" id="myInput" onkeyup="myFunction()" placeholder="Buscar por id.." title="Buscar por id">
    <table id="myTable" class="table table-striped jambo_table table-bordered">
      <thead>
    <tr>
    <td>#</td>
    <th>foto</th> 
    <td>Nombre</td>
    <th>Puesto</th>
    <th>Ruta</th>
    <th>Sueldo Diario</th>
    <th>Pasaje Diario</th>
    <th>Pago</th>
    <th>Incentivo</th>
    <th>Transferencia</th>  
    <th>Cheque</th> 
    <th>Infonavit</th> 
    <th>Caja Ahorro</th> 
    <th>Dias Descanso</th> 
    <th>Totales Adicionales </th> 

    </tr>
    </thead>
</tbody>  
    <form name='form_update' method='post' id="registerUser" action='periodo_update.php'>
<?php
    while ($usuario = sqlsrv_fetch_array($result)) {

  $Id_usuario=$usuario['Id_usuario'];
  $foto=$usuario['foto'];
  $us_nombre_real=utf8_encode($usuario['us_nombre_real']);
  $ruta=$usuario['ruta'];
  $puesto=$usuario['puesto'];
  $NoEmpleado=$usuario['ucfdi'];
  $incentivo=$usuario['incdia'];
  $pago=$usuario['pago'];
  $dias_trabajados=$usuario['dias_trabajados'];
 $dias_adicionales=$usuario['dias_adicionales'];
$sueldos=$usuario['sueldos'];
$pasajes=$usuario['Pasajes'];
$SD=$usuario['SD']; 
$cahorro=$usuario['cahorro']; 
$transferencia=$usuario['transferencia']; 
$cheque=$usuario['cheque']; 
$infonavit=$usuario['infonavit']; 
$cachorro=$usuario['cachorro']; 

$sql = sqlsrv_query($conn, "select * from puesto where id=$puesto");
                            if($c=sqlsrv_fetch_array($sql)) {
                                $puesto_descripcion=$c['descripcion'];
                      
                            } 

$total+=$usuario['incdia'];                          
$total_us_pago+=$usuario['pago'];
$total_us_dias_trabajados+=$usuario['dias_trabajados'];  
$total_us_dias_adicionales+=$usuario['dias_adicionales']; 
$total_us_sueldos+=$usuario['sueldos']; 

// operadores
$OneDivSix = 1/6;
$toatels_trabajados = ($dias_adicionales+($dias_adicionales*($OneDivSix)))+($dias_trabajados+($dias_trabajados*($OneDivSix)));
$totales_adicionales = $dias_adicionales*($OneDivSix);
$totales_trabj_sueld = $toatels_trabajados*$sueldos;
$dias_descanso = $dias_trabajados*($OneDivSix);
$pasaje_total= $toatels_trabajados*$pasajes;
$pasaje_monto= 50*$pasaje_total;
$total_suma_final = $totales_trabj_sueld+$incentivo+$pasaje_total;

$suma_pasaje_total+=$pasaje_total;
$suma_totales_trabj_sueld+=$totales_trabj_sueld;

echo "<tr>";
echo "<td>{$usuario['Id_usuario']}<input type='hidden' name='Id_usuario[$i]'     value='{$usuario['Id_usuario']}' /></td>";
echo "<td><img src='$foto'  width='56'></td>";
echo "<td>$us_nombre_real</td>";
echo "<td>$puesto_descripcion</td>";
echo "<td>$ruta</td>";
echo "<td>$SD                 <input type='hidden' name='SD[$i]'                  value=$SD /></td>";
echo "<td>".number_format($pasaje_total, 2, ".", ",")."<input type='hidden' name='Pasajes[$i]'             value=$pasaje_total /></td>";
echo "<td>$pago               <input type='hidden' name='pago[$i]'                value=$pago /></td>";
echo "<td>$incentivo          <input type='hidden' name='incdia[$i]'              value=$incentivo /></td>";
echo "<td>$transferencia      <input type='hidden' name='transferencia[$i]'       value=$transferencia /></td>"; 
echo "<td>$cheque             <input type='hidden' name='cheque[$i]'              value=$cheque /></td>"; 
echo "<td>$infonavit          <input type='hidden' name='infonavit[$i]'           value=$infonavit /></td>"; 
echo "<td>$cachorro           <input type='hidden' name='cachorro[$i]'            value=$cachorro /></td>"; 
echo "<td>".number_format($dias_descanso, 2, ".", ",")."<input type='hidden' name='dias_descanso[$i]'       value=$dias_descanso /></td>"; 
echo "<td>".number_format($totales_adicionales, 2, ".", ",")."<input type='hidden' name='totales_adicionales[$i]' value=$totales_adicionales /></td>"; 


  
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
<td><input type='submit' value='Generar Periodo Actual' class='btn btn-info' data-toggle='confirmation'  /></td>
  
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
<script>
function myFunction() {
  // Declare variables 
  var input, filter, table, tr, td, i;
  input = document.getElementById("myInput");
  filter = input.value.toUpperCase();
  table = document.getElementById("myTable");
  tr = table.getElementsByTagName("tr");

  // Loop through all table rows, and hide those who don't match the search query
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[0];
    if (td) {
      if (td.innerHTML.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    } 
  }
}
</script>
<script type="text/javascript">
var form = document.getElementById('registerUser');
form.onsubmit = function () {
    // this method is cancelled if window.confirm returns false
    return window.confirm('Esta REALMENTE seguro de que quieres guardar este periodo?');

}
</script>         
<?php include "footer.php" ?>