<?php
    $title ="Tickets | ";
    include "head.php";
    include "sidebar.php";
    //nota en el head esta el conect db
?>
<!-----------------------------------------------------------------------------------------------------------------------------------------------------> 
<script>
    var tableToExcel = (function() {
  var uri = 'data:application/vnd.ms-excel;base64,'
    , template = '<html xmlns:o="urn:schemas-microsoft-com:office:office" xmlns:x="urn:schemas-microsoft-com:office:excel" xmlns="http://www.w3.org/TR/REC-html40"><head><!--[if gte mso 9]><xml><x:ExcelWorkbook><x:ExcelWorksheets><x:ExcelWorksheet><x:Name>{worksheet}</x:Name><x:WorksheetOptions><x:DisplayGridlines/></x:WorksheetOptions></x:ExcelWorksheet></x:ExcelWorksheets></x:ExcelWorkbook></xml><![endif]--></head><body><table>{table}</table></body></html>'
    , base64 = function(s) { return window.btoa(unescape(encodeURIComponent(s))) }
    , format = function(s, c) { return s.replace(/{(\w+)}/g, function(m, p) { return c[p]; }) }
  return function(table, name) {
    if (!table.nodeType) table = document.getElementById(table)
    var ctx = {worksheet: name || 'Worksheet', table: table.innerHTML}
    window.location.href = uri + base64(format(template, ctx))
  }
})()
</script>   

<div class="row"><!--- --->
  <div class="col-md-12">
    <div class="x_title">
      <?php  

$faltas_us_id = $_GET['id'];      
//solo lo que corresponde al que se logeo ...falta moverle el id usuaro por otra cosa
//$result = sqlsrv_query($conn, "SELECT * FROM usuario WHERE Id_usuario=".$_SESSION['Id_usuario']." ORDER BY Id_usuario DESC");
//esta comentado alfinal parece que no se usara pero guardar por si acaso si se usa      
$sql4 = sqlsrv_query($conn, "SELECT TOP 1 periodo FROM periodo ORDER BY idp DESC");
 if($c=sqlsrv_fetch_array($sql4)) {
                                $ultimoPeriodo=$c['periodo'];
                            } 

$sql_usuarionom = sqlsrv_query($conn, "SELECT * FROM usuarionom where Id_usuario='$faltas_us_id' ");
 if($c=sqlsrv_fetch_array($sql4)) {
                                $ultimoPeriodo=$c['us_nombre_real'];
                            } 
?>  
                                          <i class="fa fa-globe"> Asistencia de <?php echo $faltas_us_id; ?>.</i> <!--- Periordo. --->
                                          <small class="pull-right">Periodo: <?php echo $ultimoPeriodo; ?>.</small>
    </div> 
<?php     
        $sql = "SELECT * FROM datosp where Periodo='$ultimoPeriodo' AND us_nombre_real != 'VACANTE' ";       
        $result = sqlsrv_query($conn, $sql);
?> 
                    <section class="content invoice">
                        <div class="col-xs-12 table">
  <div>
<div>
                <table id="datatable-buttons" class="table table-striped jambo_table table-bordered bulk_action">
     
                            <thead>
                              <tr>
      <th>No.</th>
      <th>Nombre</th>
      <th>Periodo</th>
      <th>asistencia</th>
      <th>faltas</th>
      <th>fecha</th>

                              </tr>
                            </thead>
                            <tbody>
  <?php  
  while($periodo = sqlsrv_fetch_array($result)) {   

  $foto=$periodo['foto'];
  $us_nombre_real=utf8_encode($periodo['us_nombre_real']);
  $ruta=$periodo['ruta'];
  $puesto=$periodo['puesto'];
  $NoEmpleado=$periodo['ucfdi'];
  $incentivo=$periodo['Incentivos'];
   $incentivosp=$periodo['incentivosp'];
  $usuario_pago=$periodo['pago'];
  $dias_trabajados=$periodo['dias_trabajados'];
 $dias_adicionales=$periodo['dias_adicionales'];
$sueldos=$periodo['SD'];
$pasajes=$periodo['Pasajes'];

$Id_usuario=$periodo['Id_usuario'];
$periodo_fecha=$periodo['Periodo'];
$SD=$periodo['SD'];
$Pasajediario=$periodo['Pasajediario'];
$diaspago=$periodo['pago'];
$tincentivo=$periodo['Incentivos'];
$tincentivosp=$periodo['incentivosp'];
$transferencia=$periodo['transferencia'];
$cheque=$periodo['cheque'];
$infonavit=$periodo['infonavit'];
$cahorro=$periodo['cachorro'];
$ddescanso=$periodo['ddescanso'];
$diasextra=$periodo['diasextra'];
$diaspago=$periodo['diaspago'];
//$idp=$periodo['idp'];
$id_ruta=$periodo['us_nombre'];

$sql1 = sqlsrv_query($conn, "select * from puesto where id=$puesto");
                            if($c=sqlsrv_fetch_array($sql1)) {
                                $puesto_descripcion=$c['descripcion'];
                      
                            } 

$total+=$periodo['incdia']; 
$total+=$periodo['incentivosp'];                          
$total_us_pago+=$periodo['pago'];
$total_us_dias_trabajados+=$periodo['dias_trabajados'];  
$total_us_dias_adicionales+=$periodo['dias_adicionales']; 
$total_us_sueldos+=$periodo['SD']; 
$suma_de_todo+=$total_suma_final;

    ?>
                              <tr>
<td><?php echo $NoEmpleado; ?></td>
<td><?php echo $us_nombre_real; ?></td>  
<td><?php echo $periodo_fecha; ?></td>           
<td>11</td>    
<td>1</td>    
<td>27/08/2018</td>         
 
                              </tr>
<?php } ?> 
                             
                            </tbody>
                           
                          </table>
                      </div><!--- style="width:1700px;  overflow:auto --->
                        </div>
                        </div>
                        <!-- /.col -->
                      <!-- /.row -->
                    </section>
              </div>
            </div><!--- --->
<!-----------------------------------------------------------------------------------------------------------------------------------------------------> 
<script>
function myFunction() {
  var input, filter, table, tr, td, i;
  input = document.getElementById("myInput");
  filter = input.value.toUpperCase();
  table = document.getElementById("myTable");
  tr = table.getElementsByTagName("tr");
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[1];
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
<?php include "footer.php" ?>