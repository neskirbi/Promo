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

      <br>
      <div class="pull-right">
        <select id="puestos" class="form-control pull-right" style="width: 220px;" onchange="Buscar(this);">
          <option value="">--Puesto--</option>
          <?php

          $opt = "SELECT distinct descripcion FROM puesto  ";     
          $opt = sqlsrv_query($conn, $opt);
          while($options = sqlsrv_fetch_array($opt)){
            echo'<option value="'.$options['descripcion'].'">'.$options['descripcion'].'</option>';
          }
          ?>
        </select>


        <select id="empleados" class="form-control pull-right" style="width: 180px; margin-right: 5px;" onchange="Buscar(this);">
          <option value="">--Empleado--</option>
          <?php
          $opt = "SELECT us_nombre_real FROM datosp where Periodo='$ultimoPeriodo' AND us_nombre_real != 'VACANTE' ORDER BY Id_usuario ASC";     
          $opt = sqlsrv_query($conn, $opt);
          while($options = sqlsrv_fetch_array($opt)){
            echo'<option value="'.$options['us_nombre_real'].'">'.$options['us_nombre_real'].'</option>';
          }
          ?>
        </select>

        <!--<input type="text" class="form-control pull-right" styname="" style="width: 180px; margin-right: 5px;" onkeyup="Buscar(this);" placeholder="Numero Empleado">-->

        <select id="cedis" class="form-control pull-right" style="width: 180px; margin-right: 5px;" onchange="Buscar(this);">
          <option value="">--cedis--</option>
          <?php
          $opt = "SELECT distinct us_nombre FROM usuarionom   ORDER BY us_nombre desc";     
          $opt = sqlsrv_query($conn, $opt);
          while($options = sqlsrv_fetch_array($opt)){
            echo'<option value="'.$options['us_nombre'].'">'.$options['us_nombre'].'</option>';
          }
          ?>
        </select>


      </div>
    </div>

  </div>     

  
<!---input type="text" id="myInput" onkeyup="myFunction()" placeholder="Search for names.." title="Type in a name" --->
  


              <!---table id="datatable-buttons" class="table table-striped table-bordered nowrap" cellspacing="0" width="100%"--->
  <table  class="table table-striped jambo_table table-bordered bulk_action" id="nomina">
                <!--- Para Excel Custom cambiar la id por id="testTable" NOTA ES EL FILTRO O ESTO  --->
              <!--table id="myTable" class="table table-striped table-bordered"-->
    <thead>
      <tr>
        <th style="text-align: center; background-color: #405467; border:solid #fff 1px;"><font style="color: #fff; "  size="2" >Numero Empleado</font></th>
        <th style="text-align: center; background-color: #405467; border:solid #fff 1px;"><font style="color: #fff; "  size="2" >Nombre</font></th>   
        <th style="text-align: center; background-color: #405467; border:solid #fff 1px;"><font style="color: #fff; "  size="2" >Puesto</font></th> 
        <th style="text-align: center; background-color: #405467; border:solid #fff 1px;"><font style="color: #fff; "  size="2" >CEDIS</font></th>  
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

      $suma_totales_adicionales=0;
      $suma_totales_dvac=0;
      $suma_toatels_trabajados=0;
      $suma_sueldos=0;
      $suma_totales_trabj_sueld=0;
      $pasajes_suma=0;
      $suma_pasaje_total=0;
      $suma_incentivo=0;
      $suma_incentivop=0;
      $suma_de_todo=0;
      $sql = "SELECT dat.id,dat.Id_usuario,dat.Periodo,dat.SD,dat.Pasajediario,dat.diaspago,dat.tincentivo,dat.tincentivop,dat.transferencia,dat.cheque,dat.infonavit,dat.cahorro,dat.ddescanso,dat.dvac,dat.diasextra,dat.ucfdi,dat.dias_trabajados,dat.us_nombre_real,dat.dias_adicionales,dat.sueldos,dat.Pasajes,dat.Incentivos,dat.incentivosp,dat.us_nombre,dat.ultima_actualizacion,dat.estatus,usu.us_nombre,pus.descripcion
      FROM datosp as dat 
      join usuarionom as usu on usu.Id_usuario = dat.Id_usuario
      join puesto as pus on pus.id=usu.puesto
      where dat.Periodo='$ultimoPeriodo' AND dat.us_nombre_real != 'VACANTE' 
      ORDER BY dat.Id_usuario ASC ";  

      echo'<script> console.log("'.str_replace("\n"," ",$sql).'"); </script>';  
      $result = sqlsrv_query($conn, $sql);  
      while($periodo = sqlsrv_fetch_array($result)) {


        $Id_usuario=$periodo['Id_usuario'];
        $us_nombre_real=utf8_encode($periodo['us_nombre_real']);
        $periodo_fecha=$periodo['Periodo'];
        $SD=$sueldos=$periodo['SD'];
        $Pasajediario=$periodo['Pasajediario'];
        $diaspago=$periodo['diaspago'];
        $periodo['tincentivo'];
        $periodo['tincentivop'];
        $transferencia=$periodo['transferencia'];
        $cheque=$periodo['cheque'];
        $infonavit=$periodo['infonavit'];
        $cahorro=$periodo['cahorro'];
        $ddescanso=$periodo['ddescanso'];
        $dias_dvac=$periodo['dvac'];
        $diasextra=$periodo['diasextra'];
        $NoEmpleado=$periodo['ucfdi'];
        $dias_trabajados=$periodo['dias_trabajados'];
        $dias_adicionales=$periodo['dias_adicionales'];
        $periodo['sueldos'];
        $pasajes=floatval($periodo['Pasajes']);
        $tincentivo=$incentivo=$periodo['Incentivos'];
        $incentivosp=$periodo['incentivosp'];
        $id_ruta=$periodo['us_nombre'];
        $periodo['ultima_actualizacion'];
        $periodo['estatus'];   
        $us_nombre=$periodo['us_nombre'];
        $descripcion=$periodo['descripcion'];

     

        $OneDivSix = 1/6;
        $dias_descanso = $dias_trabajados*($OneDivSix);
        $totales_adicionales = $dias_adicionales*($OneDivSix);
        $totales_dvac = $dias_dvac*($OneDivSix);
        $toatels_trabajados = ($dias_adicionales+($dias_adicionales*($OneDivSix)))+($dias_trabajados+($dias_trabajados*($OneDivSix)))+($dias_dvac+($dias_dvac*($OneDivSix)));
        $totales_trabj_sueld = $toatels_trabajados*$sueldos;
        $pasaje_total= $toatels_trabajados*$pasajes;
        $total_suma_final = $totales_trabj_sueld+$incentivo+$incentivosp+$pasaje_total;
        
        $suma_totales_adicionales+=$totales_adicionales;
        $suma_totales_dvac+=$totales_dvac;
        $suma_toatels_trabajados+=$toatels_trabajados;
        $suma_sueldos+=$sueldos;
        $suma_totales_trabj_sueld+=$totales_trabj_sueld;
        $pasajes_suma +=$pasajes;
        $suma_pasaje_total+=$pasaje_total;
        $suma_incentivo+=$incentivo;
        $suma_incentivop+=$incentivosp;
        $suma_de_todo+=$total_suma_final;

        ?>
      <tr>
        <td style="text-align: center; min-width: 100px;"><font size="2"><?php echo $NoEmpleado; ?></font></td>
        <td style="text-align: center; min-width: 100px;"><font size="2"><?php echo $us_nombre_real; ?></font></td>
        <td style="text-align: center; min-width: 100px;"><font size="2"><?php echo $descripcion; ?></font></td>
        <td style="text-align: center; min-width: 100px;"><font size="2"><?php echo $us_nombre; ?></font></td>  
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

function Buscar(este) {

    switch($(este).attr('id')){
      case "puestos":
      $('#empleados').prop('selectedIndex',0);
      $('#cedis').prop('selectedIndex',0);
      break;
      case "empleados":
      $('#puestos').prop('selectedIndex',0);
      $('#cedis').prop('selectedIndex',0);
      break;
      case "cedis":
      $('#empleados').prop('selectedIndex',0);
      $('#puestos').prop('selectedIndex',0);
      break;

    }

    $('#baba').prop('selectedIndex',0);


    var value = $(este).val();
    $("#nomina tbody tr").filter(function() {
      $(this).toggle($(this).text().indexOf(value) > -1)
    });
  }

</script>        
<?php include "footer.php" ?>