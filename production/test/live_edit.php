<?php
$server = "D5CLQ382\SQLEXPRESS";
$connectionInfo = array( "Database"=>"dbventasjtib", "UID"=>"claudio", "PWD"=>"cpromo*" );
$conn = sqlsrv_connect( $server, $connectionInfo );


$input = filter_input_array(INPUT_POST);
if ($input['action'] == 'edit') {
$update_field='';
if(isset($input['fisrt'])) {
$update_field.= "fisrt='".$input['fisrt']."'";
} else if(isset($input['last'])) {
$update_field.= "last='".$input['last']."'";
}
if($update_field && $input['id']) {
$sql_query = "UPDATE testC SET $update_field WHERE id='" . $input['id'] . "'";
sqlsrv_query($conn, $sql_query) or die("database error:". sqlsrv_error($conn));
}
}
?>