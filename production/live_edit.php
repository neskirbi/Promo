<?php

$server = "D5CLQ382\SQLEXPRESS";
$connectionInfo = array( "Database"=>"dbventasjtib", "UID"=>"claudio", "PWD"=>"cpromo*" );
$conn = sqlsrv_connect( $server, $connectionInfo );

$input = filter_input_array(INPUT_POST);
if ($input['action'] == 'edit') {	
	$update_field='';

	if(isset($input['us_telefono'])) {
		$update_field.= "us_telefono='".$input['us_telefono']."'";

	} else if(isset($input['us_nombre_real'])) {
		$update_field.= "us_nombre_real='".$input['us_nombre_real']."'";

	} else if(isset($input['us_nombre'])) {
		$update_field.= "us_nombre='".$input['us_nombre']."'";

	} else if(isset($input['estatus'])) {
		$update_field.= "estatus='".$input['estatus']."'";

	} 	

	if($update_field && $input['id']) {
		$sql_query = "UPDATE developers SET $update_field WHERE id='" . $input['id'] . "'";	
		sqlsrv_query($conn, $sql_query) or die("database error:". sqlsrv_error($conn));		
	}
}


