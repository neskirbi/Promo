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
//$id = $_GET['id'];

//selecting data associated with this particular id
//$result = sqlsrv_query($mysqli, "SELECT * FROM products WHERE id=$id");
/*        $sql_edit_vacante = "SELECT * FROM usuarionom WHERE Id_usuario=$id ORDER BY Id_usuario ASC";
        $result = sqlsrv_query($conn, $sql_edit_vacante);


while($res = sqlsrv_fetch_array($result))
{
	$Id_usuario = $res['Id_usuario']; 
	$dias_trabajados = $res['dias_trabajados']; //sale de asistencias
	$dias_adicionales = $res['dias_adicionales']; //sale de la fecha de ingreso - los dias de fecha de corte antes de la quincena
	$incdia = $res['incdia'];// insentivo diario 
	$ruta=$res['ruta'];//ruta 
	$us_nombre_real=utf8_encode($res['us_nombre_real']);
	$fecha_alta_us= date_format ($res['fechaalta'], 'd-m-Y');
    $foto=$res['foto'];	

      $us_nombre=$res['us_nombre'];//*clave 
      $us_apellidos=$res['us_apellidos'];//* ruta
      $us_direccion=$res['us_direccion'];//* zona
      $us_telefono=$res['us_telefono'];//* telefono
      $us_login=$res['us_login'];//*login usuario
      $us_password=$res['us_password'];//*login pasweord
      $Id_tipouser=$res['Id_tipouser'];//* id de tipo de usuario a que tabla relaciona?
      $Id_movil=$res['Id_movil'];//* id de tipo de movil a que tabla relaciona?
      $Id_ruta=$res['Id_ruta'];//*
      $hentrada=$res['hentrada'];//* no se a que va los campos estan vacios 
      $ucfdi=$res['ucfdi'];//* numero de empleado
      $upass=$res['upass'];//* es un pasword para algo?
      $oruta=$res['oruta'];//* algo de ruta, no se que es
      $idusuario=$res['idusuario'];// id repetido 
      $dni=$res['dni'];// no se que es
      $cl_tipovisit=$res['cl_tipovisita'];//*
      $us_region=$res['us_region'];//*
      $Laptop=$res['Laptop'];//* 
      $Modelo=$res['Modelo'];//*
      $Comenta=$res['Comenta'];//parecen ser comentarios
      $smartphone=$res['smartphone'];//*
      $cuenta_smart=$res['cuenta_smart'];//*
      $estado_smart=$res['estado_smart'];//* recuperdado pero tendria que decir nuevo , reparado y cosas asi
      $canal=$res['canal'];// es un id hay que ver a donde pertenece 
      $puesto=$res['puesto'];// es un id sacado de puesto 
$sql_puesto = sqlsrv_query($conn, "select * from puesto where id=$puesto");
                            if($c=sqlsrv_fetch_array($sql_puesto)) {
                                $puesto_descripcion=$c['descripcion'];
                      
                            } 


      $mail=$res['mail'];//*
      $sueldo=$res['sueldo'];//* campo vacio pero si tendria que mostrar algo 
      $gafete=$res['gafete'];//*
      $fecha_entrega=$res['fecha_entrega'];//* comienzo a creer que esta es la fecha de entrega de telefono y no de baja 

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

} */

$t_sql_usuarionom = sqlsrv_query($conn, "SELECT TOP 1 id FROM usuarionom ORDER BY id DESC");
 if($c=sqlsrv_fetch_array($t_sql_usuarionom)) {
                                $us_id_ult=$c['id'];
                      
                            } 
?>

<!------------------->	
      
            
            <div class="clearfix"></div>
            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Agregar Usuario </h2>
                    <div class="clearfix"></div>
                  </div>


                  <div class="x_content">
<div class="col-md-2 col-sm-2 col-xs-12 profile_left"><!--- profile_left --->
                      <div class="profile_img">
                        <div id="crop-avatar">
                          <!-- Current avatar -->
                          <img src='http://promdf.mine.nu/helpdesk/imagenes/perfil.png' alt="Avatar" width='112'>
<!--- aqui subiremos la foto de ultimo id +1 de tabla usuarios --->
                          <!--img class="img-responsive avatar-view" src="images/picture.jpg" alt="Avatar" title="Change the avatar"--->
                        </div>
                      </div>
                      <h3><?=$us_nombre_real; ?></h3>
<ul class="list-unstyled user_data">   
    <li>
      <input  class="btn btn-success btn-sm" name="foto" onClick="setFotoAction();" value="Imagen De Usuario">
    </li>
    <li>
      <i class="fa fa-calendar user-profile-icon"></i> <?php echo "Fecha de apertura: " . date("Y-m-d") ;?>
    </li>
    <li>
      <i class="fa fa-info user-profile-icon"></i> Identificador de usuario ID: <?php echo $us_id_ult +1; ?>
    </li>
</ul>                      
</div> <!--- profile_left --->


<div class="col-md-10 col-sm-10 col-xs-12"><!--- profile_right --->

           
  <form id="demo-form2" name='frmUser' method='post' action='' data-parsley-validate class="form-horizontal form-label-left">		
                   
                      <div class="form-group">
<!--- 
<button class="btn btn-primary" type="button">Cancel</button>
<button class="btn btn-primary" type="reset">Reset</button>
---><?php /*
<label class="control-label" >No. Empleado *</label><!--- agregar a edicion --->
      <div class="item form-group">
        <div class="col-md-10 col-sm-10 col-xs-12">
        <input type="number" id="number" name="ucfdi"  data-validate-minmax="10000,99999" class="form-control" value="" placeholder="5 cifras numericas ej 54345" required>
        </div>
      </div>
<label class="control-label">Nombre Completo *</label>
      <div class="item form-group">                
        <div class="col-md-10 col-sm-10 col-xs-12">
        <input id="name" class="form-control" data-validate-length-range="6" data-validate-words="3" name="us_nombre_real" value=""  type="text" placeholder="Nombre Apellido Paterno Apellido Materno e.j Jon Doe Doe"  required >
        </div>
      </div>          
<label class="control-label">Telephone *</label>
  <div class="item form-group">
    <div class="col-md-10 col-sm-10 col-xs-12">
      <input type="tel" id="telephone" name="phone"  data-validate-length-range="8,20" class="form-control" placeholder="Numero local clave lada ej 55 5555 5555" required>
    </div>
  </div>  
<label class="control-label">Usuario *</label>
  <div class="item form-group">
    <div class="col-md-10 col-sm-10 col-xs-12">
    <input id="password" type="text" name="us_login" class="form-control" placeholder="Usuario" required>
    </div>
  </div> 

<label for="password" class="control-label">Contraseña</label>
  <div class="item form-group">
    <div class="col-md-10 col-sm-10 col-xs-12">
    <input id="password" type="password" name="password" data-validate-length="6,8" class="form-control" placeholder="Contraseña" required>
    </div>
  </div>    
<label for="password2" class="control-label">Contraseña</label>
  <div class="item form-group">
    <div class="col-md-10 col-sm-10 col-xs-12">
    <input id="password2" type="password" name="password2" data-validate-linked="password" class="form-control" placeholder="Repite tu contraseña" required>
    </div>
  </div>                       
<label class="control-label" for="email">Correo *</label>
  <div class="item form-group">
    <div class="col-md-10 col-sm-10 col-xs-12">
        <input type="email" id="email" name="mail" class="form-control" placeholder="Correo electronico ej abc@cde.efg" required>
    </div>
  </div>
                      
<label class="control-label" for="email">Confirmar Correo *</label>
  <div class="item form-group">
    <div class="col-md-10 col-sm-10 col-xs-12">
        <input type="email" id="email2" name="confirm_email" data-validate-linked="mail" class="form-control" placeholder="confirma tu correo electronico" required>
    </div>
  </div> */ ?>
<label class="control-label">Ruta *</label>
      <div class="item form-group">                
        <div class="col-md-10 col-sm-10 col-xs-12">
        <input id="name" class="form-control" data-validate-length-range="6" data-validate-words="1" name="us_nombre" value="<?php echo $us_nombre;?>"  type="text" placeholder="Ruta ej MX-M-1" required>
        </div>
      </div>
<label class="control-label" >Sueldo Diario *</label><!--- agregar a edicion --->
      <div class="item form-group">
        <div class="col-md-10 col-sm-10 col-xs-12">
        <input type="number" id="number" name="SD" data-validate-minmax="10,1000" class="form-control" value="<?php echo $SD;?>" placeholder="Sueldo diario" required>
        </div>
      </div> 
<label class="control-label" >Pasaje Diario *</label><!--- agregar a edicion --->
      <div class="item form-group">
        <div class="col-md-10 col-sm-10 col-xs-12">
        <input type="number" id="number" name="Pasajes" data-validate-minmax="10,1000" class="form-control" value="<?php echo $Pasajes;?>" placeholder="Pasaje diario" required>
        </div>
      </div> 
<label class="control-label" >Incentivos *</label>
      <div class="item form-group">
        <div class="col-md-10 col-sm-10 col-xs-12">
        <input type="number" id="number" name="incdia" data-validate-minmax="0,100" class="form-control" value="" placeholder="Incentivos" required>
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
        <input type="number" id="number" name="dias_adicionales" data-validate-minmax="0,6" class="form-control" value="" placeholder="Si es el caso agregar Dias Adicionales" required>
        </div>
      </div>    
      <?php /*   
<label class="control-label" >Incidencias </label><!--- agregar a edicion --->
        <div class="form-group">           
          <div class="col-md-10 col-sm-10 col-xs-12">
          <input name="incidencias" type="text" placeholder="Incidencias"  class="form-control" value="">
          </div>
        </div> */ ?>

<?PHP /*
IMPORTANTE ESTE CAMPO HIDDEN SE USA PARA REGRESAR LA VARIABLE , 
SI EN EDIT QUIEREN QUE LA PAGINA LES REGRESE AL FORMULARIO DE EDITAR USUARIO 
SE MANDA ESTE IMPUT DE ID<->A A LA CONSULAT Y SE REGRESA CON ESTE MISMO BOTON
                <input type="hidden" name="id" value=<?php echo $_GET['id'];?>>   */ ?>


			
        <input  class="btn btn-primary" name="new_us" onClick="setNewUserBAction();" value="Crrear Usuario">
                        </div>
                      

  </form>
</div><!--- profile_right --->
                


                    </div>
                  </div>
                </div>
              </div>
            </div>	
  <!-----------------------------------------------------------------------------------------------------------------------------------------------------> 
<?php include "footer.php" ?>  


