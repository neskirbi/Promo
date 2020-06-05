<?php
    $title ="Tickets | ";
    include "head.php";
    include "sidebar.php";
?>
<!----------------------------------------------------------------------------------------------------------------------------------------------------->
<!--- meta http-equiv="Content-Type" content="text/html; charset=utf-8" / --->
<!--- link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css" --->
<!--- link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css" --->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<!---script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script --->
<!-- jQuery -->
<script type="text/javascript" src="jquery.tabledit.js"></script><!---- esto es importante recuerda editar cada ves que lo reuses ----->

<div class="pull-right">
<a data-toggle="tooltip" data-placement="top" title='Autorizar Nómina'  class='btn btn-danger'  /><i class="glyphicon glyphicon-bell"></i></a>
<a data-toggle="tooltip" data-placement="top" title='Actualizar Nómina' class='btn btn-primary'  /><i class="glyphicon glyphicon-briefcase"></i></a>
<a data-toggle="tooltip" data-placement="top" title='Reiniciar Incentivos' class='btn btn-warning' /><i class="glyphicon glyphicon-flag"></i></a>
<a data-toggle="tooltip" data-placement="top" title='Exportar Excel' class="btn btn-info" ><i class="glyphicon glyphicon-folder-open"></i></a>
<a data-toggle="tooltip" data-placement="top" title='Crear Usuario' class="btn btn-success" ><i class="glyphicon glyphicon-user"></i></a>
<a data-toggle="tooltip" data-placement="top" title='Importar Incentivos' class="btn btn-info" ><i class="glyphicon glyphicon-save-file"></i></a>
</div>

<div>	 
	<table id="data_table" class="table table-striped jambo_table" >
		<thead>
			<tr>
				<th>Id</th>
				<th>No. Empleado</th>
				<th>Nombre</th>
				<th>Ruta</th>	
				<th>Estado</th>			
			</tr>
		</thead>
		<tbody>
			<?php 
			$sql_query = "SELECT * FROM usuarionom";
			$resultset = sqlsrv_query($conn, $sql_query) or die("database error:". sqlsrv_error($conn));
			while( $developer = sqlsrv_fetch_array($resultset) ) {
			?>


	   <tr id="<?php echo $developer ['id']; ?>">
			   <td><?php echo $developer ['id']; ?></td>
			   <td><?php echo $developer ['us_telefono']; ?></td>
			   <td><?php echo $developer ['us_nombre_real']; ?></td>
			   <td><?php echo $developer ['us_nombre']; ?></td>   
			   <td><?php echo $developer ['estatus']; ?></td>
		 
			   </tr>
			<?php } ?>
		</tbody>
    </table>	
</div>

<script>
$(document).ready(function(){
	$('#data_table').Tabledit({
		deleteButton: false,
		editButton: false,   		
		columns: {
		  identifier: [0, 'id'],                    
		  editable: [[1, 'us_telefono'], [2, 'us_nombre_real'], [3, 'us_nombre'], [4, 'estatus']]
		},
		hideIdentifier: true,
		url: 'live_edit.php'		
	});
});
</script>

        <!-- /page content -->

        <!-- footer content -->
        <footer>
          <div class="pull-right">
            Bootstrap Admin Template by 
          </div>
          <div class="clearfix"></div>
        </footer>
        <!-- /footer content -->
      </div>
    </div>



   </body>
</html>




                                                                                                      