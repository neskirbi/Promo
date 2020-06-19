<?php
/*ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);*/
$temp="";
$temp2="";
$script="";
    $title ="HeadCount | Grupo B ";
    include "head.php";
    include "sidebar.php";
?>

<style type="text/css">
  .fijo{
    position: sticky;
    left: 0px;
  }
</style>

<script language="javascript" src="users.js" type="text/javascript"></script>
<script>
  var cambiar="",por="";
    var tableToExcel = (function() {
  var uri = 'data:application/vnd.ms-excel;base64,'
    , template = '<html xmlns:o="urn:schemas-microsoft-com:office:office" xmlns:x="urn:schemas-microsoft-com:office:excel" xmlns="http://www.w3.org/TR/REC-html40"><head><!--[if gte mso 9]><xml><x:ExcelWorkbook><x:ExcelWorksheets><x:ExcelWorksheet><x:Name>{worksheet}</x:Name><x:WorksheetOptions><x:DisplayGridlines/></x:WorksheetOptions></x:ExcelWorksheet></x:ExcelWorksheets></x:ExcelWorkbook></xml><![endif]--></head><body><table>{table}</table></body></html>'
    , base64 = function(s) { return window.btoa(unescape(encodeURIComponent(s))); }
    , format = function(s, c) { return s.replace(/{(\w+)}/g, function(m, p) { return c[p]; }); };
  return function(table, name,periodo) {
     
    if (!table.nodeType)
      table = document.getElementById(table);
      
      var acambiar=cambiar.split("#sep#");
      var apor=por.split("#sep#");
      
      

    var row1='<tr><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td></tr><tr><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td></tr><tr><td></td><td>Promotecnicas y ventas SA de Cv.</td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td></tr>',
    row2='<tr><td></td><td colspan="2">'+periodo+'</td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td></tr><tr><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td></tr><tr><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td></tr>';
    
    var tablef=$("<table></table>").html(table.innerHTML);
    tablef.find("thead").before(row1).before(row2);//+$("#Personal_sub tbody").html()
    
    var limpio=$("#Personal_sub tbody").html();
    for(var i=1;i<acambiar.length;i++){
      //console.log(acambiar[i]+","+apor[i]);
      limpio=limpio.replace(acambiar[i].replace("/d/","/\\d/"),apor[i]);
    }

    tablef.find("thead").after(limpio);

    var ctx = {worksheet: name || 'Worksheet', table: tablef.html()};
    window.location.href = uri + base64(format(template, ctx));
  };
})()
</script>

      <?php     
       //session_start();        
         $id= $_SESSION['user_log']; 
   // echo $id;
  // $dias = array("domingo","lunes","martes","miercoles","jueves","viernes","sabado");
   //echo "Hoy es es ".$dias[date("w")];
   
//solo lo que corresponde al que se logeo ...falta moverle el id usuaro por otra cosa
//echo'<script>console.log(\''.json_encode($_SESSION).'\');</script>';          
$resultusu = sqlsrv_query($conn, "SELECT * FROM usuaripsPromo WHERE nombre='$id'");

if($c=sqlsrv_fetch_array($resultusu)) 
{
  $zonausu=$c['zona'];              
} 

$timestamp = mktime(0, 0, 0, date('n') - 1, 21);
$lastday = date('Y/m/t',strtotime('last month'));


$sql4 = sqlsrv_query($conn, "SELECT TOP 1 periodo, period, sem FROM periodo ORDER BY idp DESC");
 if($c=sqlsrv_fetch_array($sql4)) {
                                $ultimoPeriodo=$c['periodo'];
                $peractual=$c['period'];
                $semperiodo=$c['sem'];
                
              $varcompa = "2020".$peractual."-".$semperiodo;
                      
                            } 

/*$sql6 = sqlsrv_query($conn, "SELECT idempleado, pano, periodo, sem, incentivo, sema, ckey  FROM incentivo where periodo=$peractual and sem=$semperiodo");
  if($c=sqlsrv_fetch_array($sql6))
         {
             $inc_idemp=$c['idempleado'];
       $inc_pano=$c['pano'];
       $inc_periodo=$c['periodo'];
       $inc_periodo=$c['sem'];
       $inc_periodo=$c['incentivo'];
       $inc_periodo=$c['sema'];
       $inc_periodo=$c['ckey'];
         }  */            
              
              
?>
<?php
$dateTimeVariable = date("j-m-Y ");
//echo  $dateTimeVariable ;
?>

                  <div class="x_title">
                    <i class="fa fa-globe"> Personal activo autorizado.</i><i class="pull-right"> <?php echo $ultimoPeriodo. "    Periodo: ". $peractual. " Semana ". $semperiodo;   ?></i>
                     <div class="clearfix"></div>
<?php 
  $sql_periodo_inicial = sqlsrv_query($conn, "SELECT top 1 diai FROM periodo order by diai DESC");
   if($t_periodo_c=sqlsrv_fetch_array($sql_periodo_inicial)) {
                                $t_perido_diai=$t_periodo_c['diai'];
                              
                            } 

  $sql_periodo_inicial = sqlsrv_query($conn, "SELECT top 1 diaf FROM periodo order by diaf DESC");
   if($t_periodo_c=sqlsrv_fetch_array($sql_periodo_inicial)) {
                                $t_perido_diaf=$t_periodo_c['diaf'];
                            }   

 $sql_periodo_inicial = sqlsrv_query($conn, "SELECT top 1 diasp FROM periodo order by diasp DESC");
 if($t_periodo_c=sqlsrv_fetch_array($sql_periodo_inicial)) {
    $t_perido_diap=$t_periodo_c['diasp'];
  }                 
  //echo $t_perido_diai ; 
  //echo $t_perido_diaf ;                          
?>
                  </div>
    <div class="row">
<?php 
        //$sql = "SELECT * FROM usuarionom where gafete='B' and dni in ('".str_replace(",","','",$zonausu)."') ORDER BY canal,us_apellidos,puesto ASC";  //aqui esta la consulta por bloque
        
$i = 0;  ?>

    <a data-toggle="tooltip" data-placement="top" title='Borrar Ultima Nomina Generada' class='btn btn-danger' onclick="setBorrarNominaAction();" /><i class="glyphicon glyphicon-alert"></i></a> 
    <button id="btnModal" data-toggle="tooltip" name="btnModal" class="btn btn-primary" onclick="periodos();" title="Crear Periodo"><i class="glyphicon glyphicon-calendar"></i></button>


<div class="pull-right">

<a data-toggle="tooltip" data-placement="top" title='Autorizar Nómina'  class='btn btn-danger' onClick="setInsertarAction();" /><i class="glyphicon glyphicon-bell"></i></a>
<a data-toggle="tooltip" data-placement="top" title='Actualizar Nómina' class='btn btn-primary' onClick="setModificarAction();" /><i class="glyphicon glyphicon-briefcase"></i></a>
<!--input type='submit' value='Actualizar Nóminar'  name='Editar1' class='btn btn-info' data-toggle='confirmation' data-title='Proceeder con Editar?' /class="glyphicon glyphicon-send"-->
<a data-toggle="tooltip" data-placement="top" title='Reiniciar Incentivos' class='btn btn-warning' onClick="setCleanIncentAction();" /><i class="glyphicon glyphicon-flag"></i></a>

<!--input type="button" onclick="tableToExcel('testTable', 'W3C Example Table')" value="Export to Excel"-->
 <a data-toggle="tooltip" data-placement="top" title='Exportar Excel' class="btn btn-info" onclick="tableToExcel('Personal', 'W3C Example Table','<?php echo $ultimoPeriodo. "    Periodo: ". $peractual. " Semana ". $semperiodo;   ?>')"><i class="glyphicon glyphicon-folder-open"></i></a>

<!-- <a data-toggle="tooltip" data-placement="top" title='Crear Usuario' class="btn btn-success" onclick="setCrearUsuarioAction()"><i class="glyphicon glyphicon-user"></i></a> -->

 <a data-toggle="tooltip" data-placement="top" title='Importar Incentivos' class="btn btn-info" href="excel.php"><i class="glyphicon glyphicon-save-file"></i></a>

 <!-- a data-toggle="tooltip" data-placement="top" title='Importar Incentivos' class="btn btn-info" onclick="setExcelAction()"><i class="glyphicon glyphicon-save-file"></i></a -->
</div>
<br>
<div class="pull-right">
  <select id="puestos" class="form-control pull-right" style="width: 220px; margin-right: 5px;" onchange="Buscar(this);">
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
    $opt = "SELECT distinct us_nombre_real FROM usuarionom   ORDER BY us_nombre_real desc";     
    $opt = sqlsrv_query($conn, $opt);
    while($options = sqlsrv_fetch_array($opt)){
      echo'<option value="'.$options['us_nombre_real'].'">'.$options['us_nombre_real'].'</option>';
    }
    ?>
  </select>

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
<form name='frmUser' method='post' action=''>    
  <table id="Personal" class="table"  >
    <thead>
      <th style=" min-width: 60px; background-color: #405467;">&nbsp;</th>
      <th style="text-align: center; background-color: #405467; border:solid #fff 1px; min-width:80px; "><font style="color: #fff;" size="2" >No. Empleado</font></th>
      <th class="fijo" style="text-align: center; background-color: #405467; border:solid #fff 1px; min-width:250px; "><font style="color: #fff;" size="2" >Nombre</font></th>
      <th style="text-align: center; background-color: #405467; border:solid #fff 1px; min-width:80px; "><font style="color: #fff;" size="2" >Canal</font></th>
      <th style="text-align: center; background-color: #405467; border:solid #fff 1px; min-width:120px; "><font style="color: #fff;" size="2" >Cedis</font></th>
      <th style="text-align: center; background-color: #405467; border:solid #fff 1px; min-width:150px; "><font style="color: #fff;" size="2" >Puesto</font></th>
      <th style="text-align: center; background-color: #405467; border:solid #fff 1px; min-width:110px; "><font style="color: #fff;" size="2" >Status</font></th>
      <th style="text-align: center; background-color: #405467; border:solid #fff 1px; min-width:100px; "><font style="color: #fff;" size="2" >Fecha Alta</font></th>
      <th style="text-align: center; background-color: #405467; border:solid #fff 1px; min-width:100px; "><font style="color: #fff;" size="2" >Fecha Baja</font></th>
      <th style="text-align: center; background-color: #405467; border:solid #fff 1px; min-width:80px; "><font style="color: #fff;" size="2" >Sueldo Diario</font></th>
      <th style="text-align: center; background-color: #405467; border:solid #fff 1px; min-width:90px; "><font style="color: #fff;" size="2" >Días Trabajados</font></th>
      <th style="text-align: center; background-color: #405467; border:solid #fff 1px; min-width:90px; "><font style="color: #fff;" size="2" > Dias descanso </font></th>
      <th style="text-align: center; background-color: #405467; border:solid #fff 1px; min-width:100px; "><font style="color: #fff;" size="2" > Faltas </font></th>
      <th style="text-align: center; background-color: #405467; border:solid #fff 1px; min-width:100px; "><font style="color: #fff;" size="2" > Faltas x retardos </font></th>
      <th style="text-align: center; background-color: #405467; border:solid #fff 1px; min-width:100px; "><font style="color: #fff;" size="2" >Días Vacaciones</font></th>
      <th style="text-align: center; background-color: #405467; border:solid #fff 1px; min-width:120px; "><font style="color: #fff;" size="2" >Días Vac. Prop.</font></th>
      <th style="text-align: center; background-color: #405467; border:solid #fff 1px; min-width:120px; "><font style="color: #fff;" size="2" >Días Adicionales</font></th>
      <th style="text-align: center; background-color: #405467; border:solid #fff 1px; min-width:120px; "><font style="color: #fff;" size="2" >Dias Desc Adic </font></th>
      <th style="text-align: center; background-color: #405467; border:solid #fff 1px; min-width:100px; "><font style="color: #fff;" size="2" >Pasaje Diario</font></th>
      <th style="text-align: center; background-color: #405467; border:solid #fff 1px; min-width:120px; "><font style="color: #fff;" size="2" >Incentivo Sem.Act</font></th>
      <th style="text-align: center; background-color: #405467; border:solid #fff 1px; min-width:100px; "><font style="color: #fff;" size="2" >Incent.Perman.</font></th>
      <th style="text-align: center; background-color: #405467; border:solid #fff 1px; min-width:120px; "><font style="color: #fff;" size="2" >Incidencias</font></th>
      <th style="text-align: center; background-color: #405467; border:solid #fff 1px; min-width:100px; "><font style="color: #fff;" size="2" >Incentivo Sem1</font></th>
      <th style="text-align: center; background-color: #405467; border:solid #fff 1px; min-width:100px; "><font style="color: #fff;" size="2" >Incentivo Sem2</font></th>
      <th style="text-align: center; background-color: #405467; border:solid #fff 1px; min-width:100px; "><font style="color: #fff;" size="2" >Incentivo Sem3</font></th>
      <th style="text-align: center; background-color: #405467; border:solid #fff 1px; min-width:100px; "><font style="color: #fff;" size="2" >Incentivo Sem4</font></th>
      <th style="text-align: center; background-color: #405467; border:solid #fff 1px; min-width:100px; "><font style="color: #fff;" size="2" >Total Incentivo</font></th>
    </thead>
   
    
  </table>

  <table class="table"  id="Personal_sub">
    <tbody>

      <?php
      $sql = "SELECT can.descripcion as canal,pus.descripcion as puesto,usu.foto,usu.us_nombre_real,usu.ruta,usu.ucfdi,usu.us_nombre
      ,usu.fecha_baja_us,usu.fechaalta,usu.SD,usu.dias_adicionales,usu.Pasajes,usu.pasajes,inc.incentivo,usu.incentivosp
      ,usu.ddescanso,usu.estatus,usu.is1,usu.is2,usu.is3,usu.is4,usu.Id_usuario,usu.incidencias,
      (SELECT count(asistencia) FROM asistencia where id_usuario= usu.Id_usuario and asistencia = '1' and fecha between '$t_perido_diai' and '$t_perido_diaf') as dias_trabajados,
      (SELECT count(asistencia) FROM asistencia where id_usuario= usu.Id_usuario and id_motivo = '3' and fecha between '$t_perido_diai' and '$t_perido_diaf') as dias_dvac1,
      (SELECT count(asistencia) FROM asistencia where id_usuario= usu.Id_usuario and id_motivo = '4' and fecha between '$t_perido_diai' and '$t_perido_diaf') as retardos
      FROM usuarionom usu 
      LEFT OUTER JOIN incentivo inc on inc.idempleado = usu.ucfdi and inc.sema = '$varcompa'
      LEFT JOIN puesto as pus on  pus.id=usu.puesto
      LEFT JOIN canal as can on can.id=usu.canal 
      where usu.gafete='B' and usu.dni in ('".str_replace(",","','",$zonausu)."')  or (inc.periodo + inc.sem) is NULL ORDER BY canal,us_apellidos,puesto ASC";  //aqui esta la consulta por bloque 
      //echo'<script>console.log("'.$sql.'");</script>';   
      $result = sqlsrv_query($conn, $sql);
      while ($usuario = sqlsrv_fetch_array($result)) {

        // $idusuario=$usuario['id'];
        $foto=$usuario['foto'];
        $us_nombre_real= utf8_encode($usuario['us_nombre_real']);
        $ruta=$usuario['ruta'];
        $puesto_descripcion=$usuario['puesto'];
        $canal_descripcion=$canal=$usuario['canal'];
        $ucfdi=$NoEmpleado=$usuario['ucfdi'];
        $id_ruta=$usuario['us_nombre'];
        $fecha_baja_us= $usuario['fecha_baja_us'];
        $fecha_alta_us= $usuario['fechaalta'];
        $sueldo_diario=$usuario['SD'];
        $dias_trabajados= $usuario['dias_trabajados'];
        $dias_dvac1=$usuario['dias_dvac1'];
        $dias_dretardo=$usuario['retardos'];
        $dias_adicionales= $usuario['dias_adicionales'];
        $pasajes=$usuario['Pasajes'];
        $incentivo= $usuario['incentivo'];
        $incentivosp=$usuario['incentivosp'];
        $ddescanso=$usuario['ddescanso'];
        $estatus=$usuario['estatus'];
        $is1=$usuario['is1'];
        $is2=$usuario['is2'];
        $is3=$usuario['is3'];
        $is4=$usuario['is4'];
        $Id_usuario=$usuario['Id_usuario'];
        $now = new \DateTime('now');
        $anio = (int)$now->format('Y');
        $mes = (int)$now->format('m');
        $dia = (int)$now->format('d');
        $dia <= 20 ? $mes -= 1 : $mes;
        $fecha1= $t_perido_diai;
        $fecha2= $t_perido_diaf;
        $diaob= $t_perido_diap;
        //$dias_dvac= $usuario['dias_vacaciones'];
        //$usuario_pago=$usuario['pago'];
        //$sueldos=$usuario['sueldos'];
        //$usuario_Incentivos=$usuario['Incentivos'];
        //$usuario_Incentivosp=$usuario['incentivosp'];
        //$usuario_incent_diario=$usuario['incent_diario'];

        //$fecha1 = "$anio-$mes-25";

        //nota esta fue pesado ya que los datos estavan incorrectos en la tabla y las funciones estandar de php y sql no funcionan igual o son validas en SQL server . checar luego que esta solucion es valida pero hay que simplificar desde la tabla
        /*$sql_puesto = sqlsrv_query($conn, "SELECT * from puesto where id=$puesto");
        if($c=sqlsrv_fetch_array($sql_puesto)) {
          $puesto_descripcion=$c['descripcion'];
        } */
        /*$sql_canal = sqlsrv_query($conn, "SELECT * from canal where id=$canal");
        if($c=sqlsrv_fetch_array($sql_canal)) {
            $canal_descripcion=$c['descripcion'];
        } */
          
        /*$sql_periodo = sqlsrv_query($conn, "SELECT TOP 1 periodo FROM periodo ORDER BY idp DESC");
        if($a=sqlsrv_fetch_array($sql_periodo)) {
            $ultimoPeriodo=$a['periodo'];
        } */

        /*$sql_asistencia = sqlsrv_query($conn, "SELECT asistencia from asistencia where id_usuario='$Id_usuario'");
                        if($d=sqlsrv_fetch_array($sql_asistencia)) {
                            $asistencia_fecha=date_format ($d['fecha'], 'd-m-Y');
                            $asistencias_asistidas=$d['id_app'];
                        }  */

          
          //dias asistencia           
        //$sql_asistencia2 = "SELECT * FROM asistencia where id_usuario=$Id_usuario and fecha >= '$fecha1' and fecha <= '$fecha2' and asistencia = '1'";
        //echo'<script>console.log("'.$sql_asistencia2.'");</script>';
        //echo'<script>console.log("'.$sql_asistencia_asistidas2.'");</script>';

        //$sql_asistencia_adicionales2="SELECT * FROM asistencia WHERE id_usuario=$Id_usuario AND asistencia = '1' AND $fecha_alta_us BETWEEN '$fecha1' AND '$fecha2'";
        //echo'<script>console.log("'.$sql_asistencia_adicionales2.'");</script>';
        //echo $Id_usuario ." ";

        //dias de vacaciones
        //$sql_asistencia2v = "SELECT * FROM asistencia where id_usuario=$Id_usuario and fecha >= '$fecha1' and fecha <= '$fecha2' and id_motivo = '3'";
        //echo'<script>console.log("'.$sql_asistencia2v.'");</script>';
        //echo'<script>console.log("'.$sql_asistencia_asistidas2v.'");</script>';

        //$sql_asistencia_adicionales2v="SELECT * FROM asistencia WHERE id_usuario=$Id_usuario AND id_motivo = '3' AND $fecha_alta_us BETWEEN '$fecha1' AND '$fecha2'";
        //echo'<script>console.log("'.$sql_asistencia_adicionales2v.'");</script>';


        //$sql_asistencia2 = "SELECT * FROM asistencia where id_usuario=$Id_usuario and fecha > '2018-07-25' and asistencia = '0'";
        //$sql_asistencia2 = "SELECT * FROM asistencia where id_usuario=$Id_usuario and fecha >= GETDATE()-15 and asistencia = '0' ";
        /*$options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
        $stmt = sqlsrv_query( $conn, $sql_asistencia2 , $params, $options );*/
        //$stmt = sqlsrv_query( $conn, $sql_trabjados_ttAsist2 , $params, $options );
        //$result1233 = sqlsrv_num_rows( $stmt );
        //echo $result1233;
        //$total_asistencias+=$asistencias_asistidas;
        //nota los parametros de sql no todos son validos para sql server y los valores de la tabla estan fuera de formato o con tipo de dato mesclado int , varchar, real, date ...etc checar luego  
        //$sql_asistencia2 = "SELECT * FROM asistencia where id_usuario=$Id_usuario and fecha > '$fecha_asist' and asistencia = '0'";
        //$options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
        //$stmt = sqlsrv_query( $conn, $sql_asistencia2 , $params, $options );
        $params = array();
        /*$sql_asistencia_asistidas2 = "SELECT * FROM asistencia where id_usuario= $Id_usuario and asistencia = '1' and fecha between '$fecha1' and '$fecha2'";
        $stmt2 = sqlsrv_query( $conn, $sql_asistencia_asistidas2 , $params, $options );
        $dias_trabajados_ttAsist = sqlsrv_num_rows( $stmt2 );*/
        //$stmt3 = sqlsrv_query( $conn, $sql_asistencia_adicionales2 , $params, $options );
        //$dias_adicionales_ttAsist = sqlsrv_num_rows( $stmt3 );//dias adicionales.... pendiente tuve que dejarlo para atenbder otra cosa... pff

        //echo $dias_adicionales_ttAsist;


        // calculos de dias vacaciones
        //$stmtv = sqlsrv_query( $conn, $sql_asistencia2v , $params, $options );
        //$result1233v = sqlsrv_num_rows( $stmtv );
        /*$sql_asistencia_asistidas2v = "SELECT * FROM asistencia where id_usuario= $Id_usuario and id_motivo = '3' and fecha between '$fecha1' and '$fecha2'";
        $stmt2v = sqlsrv_query( $conn, $sql_asistencia_asistidas2v , $params, $options );
        $dias_dvac1 = sqlsrv_num_rows( $stmt2v );*/





        //dias de vacaciones
        //$sql_asistencia2r = "SELECT * FROM asistencia where id_usuario=$Id_usuario and fecha >= '$fecha1' and fecha <= '$fecha2' and id_motivo = '4'";
        //$stmtr = sqlsrv_query( $conn, $sql_asistencia2r , $params, $options );
        //$result1233r = sqlsrv_num_rows( $stmtr );
        
        // calculos de retardos
        /*$sql_asistencia_asistidas2r = "SELECT * FROM asistencia where id_usuario= $Id_usuario and id_motivo = '4' and fecha between '$fecha1' and '$fecha2'";
        $stmt2r = sqlsrv_query( $conn, $sql_asistencia_asistidas2r , $params, $options );
        $dias_dretardo = sqlsrv_num_rows( $stmt2r );*/

        $dias_dec = ($dias_dretardo / 3);
        $dias_dretardos = intval($dias_dec); 

        ///////

        //$fechawewe+=$asistencia_fecha;
        //$total+=$usuario['incentivo'];   //$usuario['incdia'];  
        //$total+=$usuario['incentivosp'];                          
        //$total_us_pago+=$usuario['pago'];
        //$total_us_pasaje+=$usuario['Pasajes'];
        //$total_us_dias_trabajados+= $usuario['dias_trabajados'];  
        //$total_us_dias_adicionales+=$usuario['dias_adicionales']; 
        //$total_us_sueldos+=$usuario['sueldos']; 
        //$total+= $periodo['incentivo'];    //$periodo['incdia'];  
        //$total+=$periodo['incentivosp'];                          
        //$total_us_pago+=$periodo['pago'];
        //$total_us_dias_trabajados+=$periodo['dias_trabajados'];  
        //$total_us_dias_adicionales+=$periodo['dias_adicionales']; 
        //$total_us_dias_dvac = ($dias_dvac1) + (($dias_dvac1)*(1/6));
        //$total_us_dias_dvacprop = (($dias_dvac1)*(1/6));
        //$total_us_sueldos+=$periodo['sueldos']; 
        //$suma_de_todo+=$total_suma_final;
        $OneDivSix = 1/6;
        //$toatels_trabajados = ($dias_adicionales+($dias_adicionales*($OneDivSix)))+($dias_trabajados+($dias_trabajados*($OneDivSix)))+($dias_dvac1+($dias_dvac1*($OneDivSix))) - ($dias_dretardos+($dias_dretardos*($OneDivSix)));
        $totales_adicionales = $dias_adicionales*($OneDivSix);
        //$totales_trabj_sueld = $toatels_trabajados*$sueldos;
        //$dias_descanso = (($dias_trabajados_ttAsist)*(1/6));
        //$pasaje_total= $toatels_trabajados*$pasajes;
        //$pasaje_monto= 0*$pasaje_total; //pasajes
        //$total_suma_final = $totales_trabj_sueld+$incentivo+$pasaje_total;
        //$pasajes_suma +=$pasajes;
        //$suma_pasaje_total+=$pasaje_total;
        //$suma_totales_trabj_sueld+=$totales_trabj_sueld;
        //$suma_sueldos+=$sueldos;
        //$suma_toatels_trabajados+=$toatels_trabajados;
        //$suma_totales_adicionales+=$totales_adicionales;
        //$suma_infonavit+=$infonavit;
        //$suma_cahorro+=$cahorro;

        $dias_trabajados_ttAsist2= $dias_trabajados - $dias_dretardos;

        //echo $row_cnt;
        echo '<tr>';
        echo '<td style="text-align: center; min-width: 60px; ">';
        if( $us_tt_promo_apellido1==='claus1') {
          echo "<a href=\"edit.php?id=$usuario[Id_usuario]\" class='fa fa-edit'></a> ";
        }
        echo "<a href=\"tusuarioAsistencia.php?id=$usuario[Id_usuario]\" class='fa fa-bell'></a></td>"; //edit
        $temp='<input type="hidden" name="Id_usuario['.$i.']" value="'.$usuario['Id_usuario'].'">' ;   
        $temp2="";   
        $script.='cambiar+=\'#sep#'.$temp.'\'; por+=\'#sep#'.$temp2.'\';';
        echo '<td class="fijo" style="text-align: center; min-width: 80px; ">'.$NoEmpleado.$temp.' </td>'; //no empleado
       
        $temp='<input type="hidden" name="ucfdi['.$i.']" value="'.$usuario['ucfdi'].'">' ;   
        $temp2="";   
        $script.='cambiar+=\'#sep#'.$temp.'\'; por+=\'#sep#'.$temp2.'\';';
        echo '<td class="fijo" style="text-align: center; min-width: 250px; background-color:#fff; ">'.$us_nombre_real.$temp.' </td>';//nombre us

        echo '<td style="text-align: center; min-width: 80px; ">'.$canal_descripcion.'</td>';//canal
        echo '<td style="text-align: center; min-width: 120px; ">'.$id_ruta.'</td>';//ruta
        echo '<td style="text-align: center; min-width: 150px;">'.$puesto_descripcion.'</td>';//puesto
        echo '<td style="text-align: center; min-width: 110px;">'.$estatus.'</td>';//estado
        echo '<td style="text-align: center; min-width: 100px;">'.$fecha_alta_us.'</td>'; 
        echo '<td style="text-align: center; min-width: 100px;">'.$fecha_baja_us.'</td>';
        ?>
        <td style="text-align: center; min-width: 80px;">$<?php echo number_format($sueldo_diario, 2, ".", ","); ?></td> 
        <?php

        $temp='<input type="text" class="form-control" onkeypress="return /\d/.test(String.fromCharCode(((event||window.event).which||(event||window.event).which)));" name="dias_trabajados['.$i.']" value="'.$dias_trabajados_ttAsist2.'">' ;   
        $temp2="$dias_trabajados_ttAsist2";   
        $script.='cambiar+=\'#sep#'.$temp.'\'; por+=\'#sep#'.$temp2.'\';';
        echo '<td style="text-align: center; min-width: 100px;" >'.$temp.'</td>';//dias trabajados
        ?>
        <td style="text-align: center; min-width: 90px;"><?php echo number_format((($dias_trabajados)*(1/6)), 2, ".", ","); ?></td> 
        <td style="text-align: center; min-width: 90px;"><?php echo ($diaob - $dias_trabajados - $dias_dvac1) ; ?> </td>
        <td style="text-align: center; min-width: 100px;"><?php echo ($dias_dretardos) ; ?> </td>
        <td style="text-align: center; min-width: 100px;"><?php echo ($dias_dvac1) ; ?> </td> 
        <td style="text-align: center; min-width: 100px;"><?php echo number_format((($dias_dvac1)*(1/6)), 2, ".", ","); ?> </td> 
        <?php


        $temp='<input type="text" class="form-control" name="dias_ad['.$i.']" value="'.$usuario['dias_adicionales'].'">' ;   
        $temp2="$usuario[dias_adicionales]";   
        $script.='cambiar+=\'#sep#'.$temp.'\'; por+=\'#sep#'.$temp2.'\';';  
        echo '<td style="text-align: center; min-width: 120px;">'.$temp.'</td>';//dias adicionales

        ?>
        <?php
        $tincen = ($is1 + $is2 + $is3 + $is4);
        ?>
        <td style="text-align: center; min-width: 120px;" ><?php echo number_format($totales_adicionales, 2, ".", ","); ?> </td>
        <?php

        $temp='<input type="text" class="form-control" onkeypress="return /\d/.test(String.fromCharCode(((event||window.event).which||(event||window.event).which)));" name="Pasajes['.$i.']" value="'.$usuario['Pasajes'].'">' ;   
        $temp2="$usuario[Pasajes]";   
        $script.='cambiar+=\'#sep#'.$temp.'\'; por+=\'#sep#'.$temp2.'\';';
        echo '<td style="text-align: center; min-width: 120px;" >'.$temp.'</td>';


        $temp='<input type="number" class="form-control" name="incentivon['.$i.']" value="'.$usuario['incentivo'].'">' ;   
        $temp2="$usuario[incentivo]";
        $script.='cambiar+=\'#sep#'.$temp.'\'; por+=\'#sep#'.$temp2.'\';';
        echo '<td style="text-align: center; min-width: 100px;" >'.$temp.'</td>'; 

        $temp='<input type="number" class="form-control" name="incentivosp['.$i.']" value="'.$usuario['incentivosp'].'">' ;   
        $temp2="$usuario[incentivosp]";
        $script.='cambiar+=\'#sep#'.$temp.'\'; por+=\'#sep#'.$temp2.'\';';
        echo '<td style="text-align: center; min-width: 120px;" >'.$temp.'</td>';

        $temp='<input type="number" class="form-control" name="incidencia['.$i.']" value="'.$usuario['incidencias'].'">' ;   
        $temp2="$usuario[incidencias]";
        $script.='cambiar+=\'#sep#'.$temp.'\'; por+=\'#sep#'.$temp2.'\';';
        echo '<td style="text-align: center; min-width: 100px;">'.$temp.'</td>'; // pendiente pero igual mente colocar
        echo '<td style="text-align: center; min-width: 120px;">'.$is1.'</td>';//Incentivo1
        echo '<td style="text-align: center; min-width: 100px;">'.$is2.'</td>';//Incentivo2
        echo '<td style="text-align: center; min-width: 100px;">'.$is3.'</td>';//Incentivo3
        echo '<td style="text-align: center; min-width: 100px;">'.$is4.'</td>';//Incentivo4
        echo '<td style="text-align: center; min-width: 100px;">'.$tincen.' </td>';//Incentivo1
        echo '</tr>';
        ++$i;
      } 
      ?>
    </tbody>
  </table>
</form>
<br>
<br>
      <?php echo"<script> ".$script."</script>";?>
    </div>
  </div>
</div>
</div> 
<!-- Modal -->
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Crear nuevo Periodo</h4>
        </div>
        <div class="modal-body">   
            <label  for="startDate">Fecha de Inicio:</label>
            <input  type="date" id="startDate" name="startDate">
            <label for="endDate">Fecha de Corte:</label>
            <input class="pull-right" type='date' id="endDate" name='endDate'>
            
        </div>
        <div class="modal-footer">
            <button class="btn btn-info" id="enviarFechas" onclick="enviarFechas(startDate.value,endDate.value);" name="enviarFechas">Crear</button>
          <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
        </div>
      </div>
      
    </div>
  </div>

<script>
    function enviarFechas(inicio,final){
        document.frmUser.action = "crearPeriodo.php?inicio="+inicio+"&final="+final;
        document.frmUser.submit(); 
    }
    function periodos(){
        $("#myModal").modal();
    }
    function setBorrarNominaAction() {
        if(confirm("Se borrarán todos los datos referentes a la última nómina")) {
            document.frmUser.action = "borrarNomina.php";
            document.frmUser.submit();
        }
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
    console.log(value);
    $("#Personal_sub tr").filter(function() {
      $(this).toggle($(this).text().indexOf(value) > -1)
    });
  }

  /*$('html, body').css({
  'overflow': 'hidden',
  'height': '100%'
  });*/

  /*$(document).ready(function(){

    $(".fijo").each(function(){
  
      $(this).css("position","sticky").css("left",$(this).position().left);
    });

    $('html, body').css({
      'overflow': 'visible',
      'height': 'auto'
    });
  });*/
</script>
<!-----------------------------------------------------------------------------------------------------------------------------------------------------> 
<?php include "footer.php"; 