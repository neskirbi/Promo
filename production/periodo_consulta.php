<?php
    $title ="HeadCount | ";
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
      //print_r(count($_POST));
//solo lo que corresponde al que se logeo ...falta moverle el id usuaro por otra cosa
//$result = sqlsrv_query($conn, "SELECT * FROM usuario WHERE Id_usuario=".$_SESSION['Id_usuario']." ORDER BY Id_usuario DESC");
//esta comentado alfinal parece que no se usara pero guardar por si acaso si se usa 
if(count($_POST)==0){
  $sql4 = sqlsrv_query($conn, "SELECT TOP 1 periodo FROM periodo ORDER BY idp DESC");
  if($c=sqlsrv_fetch_array($sql4)) {
    $ultimoPeriodo=$c['periodo'];
  } 
}else{
 $ultimoPeriodo=$_POST['periodo'];
}



?>  
<i class="fa fa-globe"> Nómina autorizada por el cliente.</i> <!--- Periordo. --->
<small class="pull-right">Periodo: <?php echo $ultimoPeriodo; ?>.</small>
    </div> 
<?php     
//solo lo que corresponde al que se logeo ...falta moverle el id usuaro por otra cosa
//$result = sqlsrv_query($conn, "SELECT * FROM usuario WHERE Id_usuario=".$_SESSION['Id_usuario']." ORDER BY Id_usuario DESC");
$sql = "SELECT * FROM datosp where Periodo='$ultimoPeriodo' AND us_nombre_real != 'VACANTE' ORDER BY Id_usuario ASC ";
//$sql = "SELECT * FROM datosp where Periodo='$ultimoPeriodo' ORDER BY Id_usuario ASC ";        
$result = sqlsrv_query($conn, $sql);
//$result = sqlsrv_query($conn, "SELECT * FROM usuario ORDER BY Id_usuario DESC");  
?> 
                    <section class="content invoice">
                      <!-- title row -->
<!-- this row will not appear when printing -->              
  <div class="row no-print">
    <div class="col-xs-12 no-print">
      <a data-toggle="tooltip" data-placement="top" title='Aprobar Nomina' class='btn btn-primary' /><i class="glyphicon glyphicon-ok"></i></a> 
      <select id="periodos" class="form-control pull-right" style="width: 220px; " onchange="FiltaPeriodo(this);">

        <?php
        if(count($_POST)!=0){
          echo'<option value="'.$ultimoPeriodo.'">'.$ultimoPeriodo.'</option>';
        } 

        $opt = "SELECT distinct Periodo,ultima_actualizacion FROM datosp  ORDER BY ultima_actualizacion ASC ";     
        $opt = sqlsrv_query($conn, $opt);
        while($options = sqlsrv_fetch_array($opt)){
          echo'<option value="'.$options['Periodo'].'">'.$options['Periodo'].'</option>';
        }

          ?>
      </select>
      <a data-toggle="tooltip" data-placement="top" title="" class="btn btn-info pull-right" onclick="TableToExcel('nomina', 'W3C Example Table')" data-original-title="Exportar Excel"><i class="glyphicon glyphicon-folder-open"></i></a>
      <button data-toggle="tooltip" data-placement="top" title='Imprimir' class="btn btn-success pull-right no-print" onclick="window.print();"><i class="fa fa-print"></i></button>
 
    <!---
    button data-toggle="tooltip" data-placement="top" title='Exportar Excel' class="btn btn-primary pull-right no-print" onclick="tableToExcel('testTable', 'W3C Example Table')" ><i class="fa fa-file-excel-o"></i></button

      CONSTE este boton es para exportar a Excel de manera custom con plantilla y todo  
    --->


    </div>    
  </div>          
                        <!-- /.col -->
                        <div class="col-xs-12 table">
<!---input type="text" id="myInput" onkeyup="myFunction()" placeholder="Search for names.." title="Type in a name" --->
  <div style="width:1700px;  overflow:auto;">
<div>

              <!---table id="datatable-buttons" class="table table-striped table-bordered nowrap" cellspacing="0" width="100%"--->
                <table  class="table table-striped jambo_table table-bordered bulk_action" id="nomina">
                <!--- Para Excel Custom cambiar la id por id="testTable" NOTA ES EL FILTRO O ESTO  --->
              <!--table id="myTable" class="table table-striped table-bordered"-->
                            <thead>
                              <tr>
      <th style="text-align: center; background-color: #405467; border:solid #fff 1px;"><font style="color: #fff; "  size="2" >Numero Empleado</font></th>
      <th style="text-align: center; background-color: #405467; border:solid #fff 1px;"><font style="color: #fff; "  size="2" >Nombre</font></th>    
      <th style="text-align: center; background-color: #405467; border:solid #fff 1px;"><font style="color: #fff; "  size="2" >Periodo</font></th>
      <th style="text-align: center; background-color: #405467; border:solid #fff 1px;"><font style="color: #fff; "  size="2" >Cheque</font></th>
      <th style="text-align: center; background-color: #405467; border:solid #fff 1px;"><font style="color: #fff; "  size="2" >Transferencia</font></th>
      <th style="text-align: center; background-color: #405467; border:solid #fff 1px;"><font style="color: #fff; "  size="2" >Dias Trabajados</font></th>
      <th style="text-align: center; background-color: #405467; border:solid #fff 1px;"><font style="color: #fff; "  size="2" >Dias de Descanso</font></th>
      <th style="text-align: center; background-color: #405467; border:solid #fff 1px;"><font style="color: #fff; "  size="2" >Dias Adicionales</font></th>
      <th style="text-align: center; background-color: #405467; border:solid #fff 1px;"><font style="color: #fff; "  size="2" >Dias Descanso Adicionales</font></th>
	    <th style="text-align: center; background-color: #405467; border:solid #fff 1px;"><font style="color: #fff; "  size="2" >Dias Vacaciones</font></th>
      <th style="text-align: center; background-color: #405467; border:solid #fff 1px;"><font style="color: #fff; "  size="2" >Dias Totales</font></th>
      <th style="text-align: center; background-color: #405467; border:solid #fff 1px;"><font style="color: #fff; "  size="2" >Sueldo Diario</font></th>
      <th style="text-align: center; background-color: #405467; border:solid #fff 1px;"><font style="color: #fff; "  size="2" >Total Sueldo D</font></th>
      <th style="text-align: center; background-color: #405467; border:solid #fff 1px;"><font style="color: #fff; "  size="2" >Pasaje Dirario</font></th>
      <th style="text-align: center; background-color: #405467; border:solid #fff 1px;"><font style="color: #fff; "  size="2" >Total Pasaje</font></th>
      <th style="text-align: center; background-color: #405467; border:solid #fff 1px;"><font style="color: #fff; "  size="2" >Total Incentivo</font></th>
	    <th style="text-align: center; background-color: #405467; border:solid #fff 1px;"><font style="color: #fff; "  size="2" >Total Incent.Permanencia</font></th>
      <th style="text-align: center; background-color: #405467; border:solid #fff 1px;"><font style="color: #fff; "  size="2" >Total Percepciones</font></th>
                
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
      $dias_dvac=$periodo['dias_vacaciones'];
      $sueldos=$periodo['SD'];
      $pasajes=$periodo['Pasajes'];
      $Id_usuario=$periodo['Id_usuario'];
      $periodo_fecha=$periodo['Periodo'];
      $SD=$periodo['SD'];
      $Pasajediario=$periodo['Pasajediario'];
      $diaspago=$periodo['pago'];
      $tincentivo=$periodo['Incentivos'];
      $tincentivop=$periodo['incentivosp'];
      $transferencia=$periodo['transferencia'];
      $cheque=$periodo['cheque'];
      $infonavit=$periodo['infonavit'];
      $cahorro=$periodo['cachorro'];
      $ddescanso=$periodo['ddescanso'];
      $diasextra=$periodo['diasextra'];
      $diaspago=$periodo['diaspago'];
      //$idp=$periodo['idp'];
      $id_ruta=$periodo['us_nombre'];

      $sql1 = sqlsrv_query($conn, "SELECT * from puesto where id=$puesto");
                            if($c=sqlsrv_fetch_array($sql1)) {
                                $puesto_descripcion=$c['descripcion'];
                      
                            } 

      $total+=$periodo['incdia'];                          
      $total_us_pago+=$periodo['pago'];
      $total_us_dias_trabajados+=$periodo['dias_trabajados'];  
      $total_us_dias_adicionales+=$periodo['dias_adicionales']; 
      $total_us_dias_dvac+=$periodo['dias_vacaciones']; 
      $total_us_sueldos+=$periodo['SD']; 
      $suma_de_todo+=$total_suma_final;
      //operadores
      $OneDivSix = 1/6;
      $toatels_trabajados = ($dias_adicionales+($dias_adicionales*($OneDivSix)))+($dias_trabajados+($dias_trabajados*($OneDivSix)))+($dias_dvac+($dias_dvac*($OneDivSix)));
      $totales_adicionales = $dias_adicionales*($OneDivSix);
      $totales_dvac = $dias_dvac*($OneDivSix);
      $totales_trabj_sueld = $toatels_trabajados*$sueldos;
      $dias_descanso = $dias_trabajados*($OneDivSix);
      $pasaje_total= $toatels_trabajados*$pasajes;
      $pasaje_monto= 50*$pasaje_total;
      $total_suma_final = $totales_trabj_sueld+$incentivo+$incentivosp+$pasaje_total;
      $pasajes_suma +=$pasajes;
      $suma_pasaje_total+=$pasaje_total;
      $suma_incentivo+=$incentivo;
      $suma_incentivop+=$incentivosp;
      $suma_totales_trabj_sueld+=$totales_trabj_sueld;
      $suma_sueldos+=$sueldos;
      $suma_toatels_trabajados+=$toatels_trabajados;
      $suma_totales_adicionales+=$totales_adicionales;
      $suma_totales_dvac+=$totales_dvac;
      $suma_infonavit+=$infonavit;
      $suma_cahorro+=$cahorro;
    ?>
  <tr>
    <td style="text-align: center; min-width: 100px;"><font size="2"><?php echo $NoEmpleado; ?></font></td>
    <td style="text-align: center; min-width: 100px;"><font size="2"><?php echo $us_nombre_real; ?></font></td>  
    <td style="text-align: center; min-width: 100px;"><font size="2"><?php echo $periodo_fecha; ?></font></td>           
    <td style="text-align: center; min-width: 100px;"><font size="2"><?php echo $cheque; ?></font></td>                  
    <td style="text-align: center; min-width: 100px;"><font size="2"><?php echo $transferencia; ?></font></td>  
    <td style="text-align: center; min-width: 100px;"><font size="2"><?php echo $dias_trabajados; ?></font></td>         
    <td style="text-align: center; min-width: 100px;"><font size="2"><?php echo number_format($dias_descanso, 2, ".", ","); ?></font></td>           
    <td style="text-align: center; min-width: 100px;"><font size="2"><?php echo $dias_adicionales; ?></font></td>   
    <td style="text-align: center; min-width: 100px;"><font size="2"><?php echo number_format($totales_adicionales, 2, ".", ","); ?></font></td>    
    <td style="text-align: center; min-width: 100px;"><font size="2"><?php echo number_format($totales_dvac, 2, ".", ","); ?></font></td>     
    <td style="text-align: center; min-width: 100px;"><font size="2"><?php echo number_format($toatels_trabajados, 2, ".", ","); ?></font></td>      
    <td style="text-align: center; min-width: 100px;"><font size="2">$<?php echo number_format($sueldos, 2, ".", ","); ?></font></td>                  
    <td style="text-align: center; min-width: 100px;"><font size="2">$<?php echo number_format($totales_trabj_sueld, 2, ".", ","); ?></font></td>      
    <td style="text-align: center; min-width: 100px;"><font size="2">$<?php echo number_format($pasajes, 2, ".", ","); ?></font></td>                  
    <td style="text-align: center; min-width: 100px;"><font size="2">$<?php echo number_format($pasaje_total, 2, ".", ","); ?></font></td>             
    <td style="text-align: center; min-width: 100px;"><font size="2">$<?php echo number_format($incentivo, 2, ".", ","); ?></font></td> 
    <td style="text-align: center; min-width: 100px;"><font size="2">$<?php echo number_format($incentivosp, 2, ".", ","); ?></font></td>                
    <td style="text-align: center; min-width: 100px;"><font size="2">$<?php echo number_format($total_suma_final, 2, ".", ","); ?></font></td>         
 
  </tr>
<?php 
} 
?> 
                             
</tbody>
   <tr>
   <td style="text-align: center; background-color:#405467;"></td>
   <td style="text-align: center; background-color:#405467;"></td>
   <td style="text-align: center; background-color:#405467;"><font style="color: #fff;">Total</font></td>
   <td style="text-align: center; background-color:#405467;"></td>
   <td style="text-align: center; background-color:#405467;"></td>
 <?php /*  <td><?=$total_us_dias_trabajados; ?></td>
   <td><?=$total_us_dias_adicionales; ?></td>
   <td><?=$total_us_sueldos; ?></td> */ ?>
<?php /*   <td>$<?php echo number_format($suma_cahorro, 2, ".", ","); ?></td>  */ ?> 
<?php /*   <td>$<?php echo number_format($suma_infonavit, 2, ".", ","); ?></td> */ ?> 
   <td style="text-align: center; background-color:#405467;"></td>
   <td style="text-align: center; background-color:#405467;"></td> 
   <td style="text-align: center; background-color:#405467;"></td>    
   <td style="text-align: center; background-color:#405467; "><font style="color: #fff;"> <?php echo number_format($suma_totales_adicionales, 2, ".", ","); ?></font></td>
   <td style="text-align: center; background-color:#405467; "><font style="color: #fff;"> <?php echo number_format($suma_totales_dvac, 2, ".", ","); ?></font></td>
   <td style="text-align: center; background-color:#405467; "><font style="color: #fff;"> <?php echo number_format($suma_toatels_trabajados, 2, ".", ","); ?></font></td>
   <td style="text-align: center; background-color:#405467; "><font style="color: #fff;">$<?php echo number_format($suma_sueldos, 2, ".", ","); ?></font></td>
   <td style="text-align: center; background-color:#405467; "><font style="color: #fff;">$<?php echo number_format($suma_totales_trabj_sueld, 2, ".", ","); ?></font></td>
   <td style="text-align: center; background-color:#405467; "><font style="color: #fff;">$<?php echo number_format($pasajes_suma, 2, ".", ","); ?></font></td>
   <td style="text-align: center; background-color:#405467; "><font style="color: #fff;">$<?php echo number_format($suma_pasaje_total, 2, ".", ","); ?></font></td>
   <td style="text-align: center; background-color:#405467; "><font style="color: #fff;">$<?php echo number_format($suma_incentivo, 2, ".", ","); ?></font></td>
   <td style="text-align: center; background-color:#405467; "><font style="color: #fff;">$<?php echo number_format($suma_incentivop, 2, ".", ","); ?></font></td>
   <td style="text-align: center; background-color:#405467; "><font style="color: #fff;">$<?php echo number_format($suma_de_todo, 2, ".", ","); ?></font></td>
   </tr>                            
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

function FiltaPeriodo(este,path="periodo_consulta.php", params, method='post') {

  // The rest of this code assumes you are not using a library.
  // It can be made less wordy if you use one.
  const form = document.createElement('form');
  form.method = method;
  form.action = path;

  //for (const key in params) {
    //if (params.hasOwnProperty(key)) {
      const hiddenField = document.createElement('input');
      hiddenField.type = 'hidden';
      hiddenField.name = "periodo";
      hiddenField.value = este.value;

      form.appendChild(hiddenField);
    //}
  //}

  document.body.appendChild(form);
  form.submit();
}


function TableToExcel(table, name) {
  var uri = 'data:application/vnd.ms-excel;base64,'
    , template = '<html xmlns:o="urn:schemas-microsoft-com:office:office" xmlns:x="urn:schemas-microsoft-com:office:excel" xmlns="http://www.w3.org/TR/REC-html40"><head><!--[if gte mso 9]><xml><x:ExcelWorkbook><x:ExcelWorksheets><x:ExcelWorksheet><x:Name>{worksheet}</x:Name><x:WorksheetOptions><x:DisplayGridlines/></x:WorksheetOptions></x:ExcelWorksheet></x:ExcelWorksheets></x:ExcelWorkbook></xml><![endif]--></head><body><table>{table}</table></body></html>'
    , base64 = function(s) { return window.btoa(unescape(encodeURIComponent(s))); }
    , format = function(s, c) { return s.replace(/{(\w+)}/g, function(m, p) { return c[p]; }); };
   if (!table.nodeType)
      table = document.getElementById(table);
      
     
    var ctx = {worksheet: name || 'Worksheet', table: table.innerHTML};
    window.location.href = uri + base64(format(template, ctx));
}

</script>        
<?php include "footer.php" ?>