<?php
    $title ="Tickets | ";
    include "head.php";
    include "sidebar.php";
    //nota en el head esta el conect db

?>
<!----------------------------------------------------------------------------------------------------------------------------------------------------->
<script language="javascript" src="users.js" type="text/javascript"></script>

<?php
//getting id from url
$TTpuesto =sqlsrv_query($conn, "select * from puesto");
$id = $_GET['id'];

        $sql_edit_vacante = "SELECT * FROM usuarionom WHERE Id_usuario=$id ORDER BY Id_usuario ASC";
        $result = sqlsrv_query($conn, $sql_edit_vacante);
while($res = sqlsrv_fetch_array($result))
{
	$Id_usuario = $res['Id_usuario']; 
	$dias_trabajados = $res['dias_trabajados']; 
	$dias_adicionales = $res['dias_adicionales']; //sale de la fecha de ingreso - los dias de fecha de corte antes de la quincena
	$incdia = $res['incdia'];// insentivo diario 
	$incentivosp = $res['incentivosp'];// insentivo diario permanencia 
	$ruta=$res['ruta'];//ruta 
	$us_nombre_real=utf8_encode($res['us_nombre_real']);
	$fecha_alta_us= $res['fechaalta'];
  //$fecha_alta_us= date_format ($res['fechaalta'], 'd-m-Y');
    $foto=$res['foto'];	
      $us_nombre=$res['us_nombre'];//*clave ... quien diseño esto?!
      $us_apellidos=$res['us_apellidos'];//* ruta.. realy?!
      $us_direccion=$res['us_direccion'];//* zona..pff...
      $us_telefono=$res['us_telefono'];//* telefono
      $us_login=$res['us_login'];//*login usuario
      $us_password=$res['us_password'];//*login pasweord
$Id_tipouser=$res['Id_tipouser'];//* id de tipo de usuario.. a que tabla relaciona?
      $Id_movil=$res['Id_movil'];//* id de tipo de movil a que tabla relaciona????
      $Id_ruta=$res['Id_ruta'];//* ... repetido
$hentrada=$res['hentrada'];//* no se a que va los campos estan vacios en la tabla y no tiene formato de fecha
      $ucfdi=$res['ucfdi'];//* numero de empleado... otra ves?
      $upass=$res['upass'];//* es un pasword para algo?
      $oruta=$res['oruta'];//* algo de ruta, no se que es ya hay una columna para ruta
      $idusuario=$res['idusuario'];// id repetido 
      $dni=$res['dni'];// no se que es....
      $cl_tipovisit=$res['cl_tipovisita'];//*
      $us_region=$res['us_region'];//*
      $Laptop=$res['Laptop'];//* tengo entendido que nisiquiera se usa
      $estatus=$res['estatus'];//* parece que nadie le tioma en cuenta pero es el estado de activo o inactivo del trabajador/puesto
      //nota : hace falta una tabla puesto, que tenga valores de vacante , y informacion del sueldo fecha de baja (igual y algun link a manual, cosas de capasitacion , horario , opiniones y comentarios de este puesto mas prioridad , y claro algo para control de susecion ya que el trabajador tiene que crecer) igual mente ver algo para sueldos, asistencias, etc ya que cada uno es todo un tema
      $Pasajes=$res['Pasajes'];
      $incidencias=$res['incidencias'];
      $Modelo=$res['Modelo'];//* creo que hace falta una tabla para telefonos y que aqui solo sea el is
      $Comenta=$res['Comenta'];//parecen ser comentarios.. con valor numerico... 
      $smartphone=$res['smartphone'];//* telefono
      $cuenta_smart=$res['cuenta_smart'];//*wtf!
      $estado_smart=$res['estado_smart'];//* recuperdado pero tendria que decir nuevo , reparado y cosas asi
      $canal=$res['canal'];// es un id, hay que ver a donde pertenece 
      $puesto=$res['puesto'];// es un id sacado de puesto 
$sql_puesto = sqlsrv_query($conn, "select * from puesto where id=$puesto");
                            if($c=sqlsrv_fetch_array($sql_puesto)) {
                                $puesto_descripcion=$c['descripcion'];
                            } 

      $mail=$res['mail'];//* correo
      $sueldo=$res['sueldo'];//* campo vacio pero si tendria que mostrar algo 
      $gafete=$res['gafete'];//* rolf  ahahahha! 
      $fecha_entrega=$res['fecha_entrega'];//* comienzo a creer que esta es la fecha de entrega de telefono y no de baja 
      //es correcto fecha de entrega es de otra cosa ... no existe fecha de baja de empleado asi que lo creare ...
      $SD=$res['SD'];//* sueldo diario , no veo mucho problema aqui , solo que en lo personal me usta que los campos sean mas descriptivos
      $fecha_baja_us=$res['fecha_baja_us'];//bueno, este es fecha de baja 

$now = new \DateTime('now');
$anio = (int)$now->format('Y');
$mes = (int)$now->format('m');
$dia = (int)$now->format('d');

$dia <= 20 ? $mes -= 1 : $mes;
$fecha1 = "$anio-$mes-25";
$sql_asistencia2 = "SELECT * FROM asistencia where id_usuario=$Id_usuario and fecha > '$fecha1' and asistencia = '0'";
$params = array();
$options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
$stmt = sqlsrv_query( $conn, $sql_asistencia2 , $params, $options );
//$stmt = sqlsrv_query( $conn, $sql_trabjados_ttAsist2 , $params, $options );
$result1233 = sqlsrv_num_rows( $stmt );

}
?>
            
            <div class="clearfix"></div>

            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Editar Usuario <small>Reporte</small></h2>
                  
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <div class="col-md-3 col-sm-3 col-xs-12 profile_left">
                      <div class="profile_img">
                        <div id="crop-avatar">
                          <!-- Current avatar -->
                          <img src='<?=$foto; ?>' alt="Avatar" width='112'>
                          <!--img class="img-responsive avatar-view" src="images/picture.jpg" alt="Avatar" title="Change the avatar"--->
                        </div>
                      </div>
                      <h3><?php echo $us_nombre_real; ?></h3>

                      <ul class="list-unstyled user_data">
                        

                        <li>
                          <i class="fa fa-briefcase user-profile-icon"></i> Puesto <?php echo $puesto_descripcion; ?>
                        </li>

                     
                        <li><i class="fa fa-map-marker user-profile-icon"></i> Fecha de Alta <?php echo $fecha_alta_us; ?>
                        </li>
                   
                      </ul>
<?php if ($estatus=="Vacante"){  ?>
	                  <a class="btn btn-warning" onClick="setActivaUsuarioBidAction();"><i class="fa fa-edit m-right-xs"></i>Activar Usuario</a>
                      <br />
<?php }else{ ?>  	<br>
                      <a class="btn btn-danger" onClick="setBajaUsuarioBidAction();"><i class="fa fa-edit m-right-xs"></i>Asignar Vacante a Usuario</a>
                      <br />
<?php }?>
<?php if ($estatus=="Vacante"){  ?>
   <ul class="list-unstyled user_data">                  
   <li><i class="fa fa-map-marker user-profile-icon"></i> Fecha de Baja  <?php echo $fecha_baja_us; ?></li>
   </ul>
<?php } ?>   
                      <h4>Sueldo:  <?php echo '123'; ?></h4>
                      <ul class="list-unstyled user_data">
                        <li>
                          <p>Faltas: <?php echo $result1233; ?> </p>
                          <div class="progress progress_sm">
                            <div class="progress-bar bg-green" role="progressbar" data-transitiongoal='<?php echo $result1233; ?>%'></div>
                          </div>
                        </li>
                        <li>
                          <p>Asistencias: <?php echo $dias_trabajados;?></p>
                          <div class="progress progress_sm">
                            <div class="progress-bar bg-green" role="progressbar" data-transitiongoal="<?php echo $dias_trabajados;?>%"></div>
                          </div>
                        </li>
                       
                      </ul>
                      <!-- end of skills -->

                    </div>
                    <div class="col-md-9 col-sm-9 col-xs-12">

                      <div class="profile_title">
                        <div class="col-md-6">
                          <h2>Datos Usuario</h2>
                        </div>
                        <div class="col-md-6">
                          
                        </div>
                      </div>

	<br/><br/>
          
<form name='frmUser' method='post' action='' class="form-horizontal form-label-left">		


<label class="control-label" >No. Empleado *</label><!--- agregar a edicion --->
      <div class="item form-group">
        <div class="col-md-10 col-sm-10 col-xs-12">
        <input type="number" id="number" name="ucfdi" required="required" data-validate-minmax="10000,99999" class="form-control" value="<?php echo $ucfdi;?>">
        </div>
      </div>
<label class="control-label">Nombre Completo *</label>
      <div class="item form-group">                
        <div class="col-md-10 col-sm-10 col-xs-12">
        <input id="name" class="form-control" data-validate-length-range="6" data-validate-words="3" name="us_nombre_real" value="<?php echo $us_nombre_real;?>" required="required" type="text">
        </div>
      </div>
<label class="control-label">Ruta *</label>
      <div class="item form-group">                
        <div class="col-md-10 col-sm-10 col-xs-12">
        <input id="name" class="form-control" data-validate-length-range="6" data-validate-words="1" name="us_nombre" value="<?php echo $us_nombre;?>" required="required" type="text">
        </div>
      </div>
<label class="control-label" >Sueldo Diario *</label><!--- agregar a edicion --->
      <div class="item form-group">
        <div class="col-md-10 col-sm-10 col-xs-12">
        <input type="number" id="number" name="SD" required="required" data-validate-minmax="10,1000" class="form-control" value="<?php echo $SD;?>">
        </div>
      </div> 
<label class="control-label" >Pasaje Diario *</label><!--- agregar a edicion --->
      <div class="item form-group">
        <div class="col-md-10 col-sm-10 col-xs-12">
        <input type="number" id="number" name="Pasajes" required="required" data-validate-minmax="10,1000" class="form-control" value="<?php echo $Pasajes;?>">
        </div>
      </div> 
<label class="control-label" >Incentivos *</label>
      <div class="item form-group">
        <div class="col-md-10 col-sm-10 col-xs-12">
        <input type="number" id="number" name="incdia" required="required" data-validate-minmax="0,100" class="form-control" value="<?php echo $incdia;?>">
        </div>
      </div> 
<label class="control-label" >Incentivos Permanencia *</label>
      <div class="item form-group">
        <div class="col-md-10 col-sm-10 col-xs-12">
        <input type="number" id="number" name="incdia" required="required" data-validate-minmax="0,100" class="form-control" value="<?php echo $incentivosp;?>">
        </div>
      </div> 
	  
<label class="control-label" >Puesto *</label><!--- agregar a edicion --->
         <div class="form-group">           
          <div class="col-md-10 col-sm-10 col-xs-12">
<select class="form-control" name="puesto"><?php
    //$the_key = 1; // or whatever you want
    foreach(array(
        1 => 'Supervisor',
        2 => 'Merchandiser',
        3 => 'Asesor de Ventas',
        4 => 'Representante de Ventas',
        5 => 'Demostradora',
        6 => 'Vendedor Sombra',
        7 => 'Desarrollo',
        8 => 'Terceros',
        9 => 'Inplant'

    ) as $key => $val){
        ?><option value="<?php echo $key; ?>"<?php
            if($key==$puesto)echo ' selected="selected"';
        ?>><?php echo $val; ?></option><?php
    }
?></select>
          </div>
        </div>
<label class="control-label" >Dias Adicionales *</label>
      <div class="item form-group">
        <div class="col-md-10 col-sm-10 col-xs-12">
        <input type="number" id="number" name="dias_adicionales" required="required" data-validate-minmax="0,6" class="form-control" value="<?php echo $dias_adicionales;?>">
        </div>
      </div>       
<label class="control-label" >Incidencias </label><!--- agregar a edicion --->
        <div class="form-group">           
          <div class="col-md-10 col-sm-10 col-xs-12">
          <input name="incidencias" type="text"   class="form-control" value="<?php echo $incidencias;?>">
          </div>
        </div>

                      <div class="ln_solid"></div>
                      <div class="form-group">
                <input type="hidden" name="id" value=<?php echo $id;?>>
               
				<input  class="btn btn-primary" name="update" onClick="setEditUserBidAction();" value="Editar">
                        </div>
                      </div>

                    </form>
 
<?php echo $id; ?>

                    </div>
                  </div>
                </div>
              </div>
            </div>	
  <!-----------------------------------------------------------------------------------------------------------------------------------------------------> 
    <!-- validator nota apartir de hoy pondre los "extras" en el documento  ya que incluso hay elementos por tabla que puedo modificar para cada una custom ..ver ejempolo de la tabla 3-->
    
<?php include "footer.php" ?>  


