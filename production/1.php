<?php
include"../conexion/conexion.php";
    $title ="Tickets | ";
    include "head.php";
    include "sidebar.php";
?>
<!----------------------------------------------------------------------------------------------------------------------------------------------------->              


<div class="col-md-12 col-sm-12 col-xs-12">
<div class="tile-stats">
     <div class="x_panel ">
                  <div class="x_title ">
                    <h2>Head Count Main...</h2>
                    <div class="clearfix"></div>
                  </div>
    <div class="x_content">
    <div class="row">
<div class="table-responsive">
<table id="datatable" class="table table-striped jambo_table table-bordered">
    <thead>
        <tr>
            <th>#</th>
            <th>ucfdi</th>
            <th>foto</th>
            <th>us_nombre_real</th>
            <th>us_apellidos</th>
            <th>ruta</th>
            <th>puesto</th>
<!--- tabla 2  --->
<th>sueldo</th>
<th>pagos</th>
<th>Ina</th>
<th>Días Trabajados</th>
<th>Días A</th>
<!--- /tabla 2 --->            
        </tr>
    </thead>
   <tbody>
<?php
//  -----1 usuarios*
$cons="SELECT * from  usuario";
$cons=odbc_exec($conexion,$cons);
while($cons2=odbc_fetch_object($cons))
{ 
//  -----2 supervisor
$datos ="SELECT * FROM supervisor WHERE id= $cons2->idusuario";
//$datos ="SELECT * FROM supervisor";
$datos = odbc_exec($conexion, $datos);
while ($datos2 = odbc_fetch_object($datos)) {
//-------3 puesto
$puestoT ="SELECT * FROM puesto WHERE id= $cons2->puesto";
//$puestoT ="SELECT * FROM puesto";
$puestoT = odbc_exec($conexion, $puestoT);
while ($puestoT2 = odbc_fetch_object($puestoT)) {  

//-------4 canal
$canalT ="SELECT * FROM canal WHERE id= $cons2->canal";
//$puestoT ="SELECT * FROM puesto";
$canalT = odbc_exec($conexion, $canalT);
while ($canalT2 = odbc_fetch_object($canalT)) {  

//-------5 tipopousuario
$canalT ="SELECT * FROM tipousuario WHERE Id_tipouser= $cons2->gafete";
    ?>

<tr>
    <td><?php echo $cons2->idusuario; ?></td>
    <td><?php echo $cons2->ucfdi; ?></td>
    <td><img src="<?php echo $cons2->foto; ?>"  width="56"></td> 
    <td><?php echo utf8_encode($cons2->us_nombre_real); ?></td>
    <td><?php echo utf8_encode($cons2->us_apellidos); ?></td>
    <td><?php echo $cons2->ruta; ?></td>
    <td><?php echo $cons2->puesto; ?></td>
<!--- tabla 2  --->    
<td><input value='<?php echo $cons2->idusuario;?>'>/Ttipopousuario</td>
<td><input value='<?php echo $canalT2->descripcion;?>'>/tCanal'></td>
<td><input value='<?php echo $datos2->Ruta;?>'>/tSupervisor</td>
<td><input value='<?php echo $puestoT2->descripcion;?>'>/tPuesto</td>
<td><input value='<?php echo $cons2->dni;?>'>/tUsuario</td>
<!--- /tabla 2 --->  
</tr> 
<?php } } } } ?>  
    </tbody>
</table>
</div>





<!--- --->

                      <div class="ln_solid"></div>
                      <div class="form-group">
                        <div class="col-md-9 col-sm-9 col-xs-12 col-md-offset-3">
                  
                          <button type="submit" class="btn btn-success">Submit</button>
                        </div>
                      </div>
<!--- --->


</div>

</div>
      </div>
</div>
</div>        


<!----------------------------------------------------------------------------------------------------------------------------------------------------->          
<?php include "footer.php" ?>