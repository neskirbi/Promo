<?php  
//action.php
//$connect = mysqli_connect('localhost', 'root', '', 'testC');

$server = "D5CLQ382\SQLEXPRESS";
$connectionInfo = array( "Database"=>"dbventasjtib", "UID"=>"claudio", "PWD"=>"cpromo*" );
$conn = sqlsrv_connect( $server, $connectionInfo );
/*
$input = filter_input_array(INPUT_POST);

$query = "SELECT * FROM testC WHERE fisrt=? AND last=?";
$parameters = [$_POST["fisrt"], $_POST["last"]];
$result = sqlsrv_query($conn, $query, $parameters);



if($input["action"] === 'edit')
{
 $query_edit = "UPDATE testC 
                   SET fisrt = ' $first_name', 
                       last = ' $last_name' 
                   WHERE id = ' $input['id']' ";

 sqlsrv_query($conn, $query);

}
if($input["action"] === 'delete')
{
 //$query_del = "DELETE FROM testC WHERE id = '".$input["id"]."'";sqlsrv_query($conn, $query);
 $query_del = "UPDATE testC 
                   SET fisrt = '$first_name', 
                       last = '$last_name' 
                   WHERE id = '$input['id']' ";

 sqlsrv_query($conn, $query_del);


}

echo json_encode($input);
*/
?>  

<?php

// Basic example of PHP script to handle with jQuery-Tabledit plug-in.
// Note that is just an example. Should take precautions such as filtering the input data.

header('Content-Type: application/json');

// CHECK REQUEST METHOD
if ($_SERVER['REQUEST_METHOD']=='POST') {
  $input = filter_input_array(INPUT_POST);
} else {
  $input = filter_input_array(INPUT_GET);
}

// PHP QUESTION TO MYSQL DB

// Connect to DB

  /*  Your code for new connection to DB*/


// Php question
if ($input['action'] === 'edit') {

 $query_del = "UPDATE testC 
                   SET fisrt = '$first_name', 
                       last = '$last_name' 
                   WHERE id = '$input['id']' ";

} else if ($input['action'] === 'delete') {

 $query_del = "UPDATE testC 
                   SET fisrt = '$first_name', 
                       last = '$last_name' 
                   WHERE id = '$input['id']' ";

} else if ($input['action'] === 'restore') {

 $query_del = "UPDATE testC 
                   SET fisrt = '$first_name', 
                       last = '$last_name' 
                   WHERE id = '$input['id']' ";

}

// Close connection to DB

/*  Your code for close connection to DB*/

// RETURN OUTPUT
echo json_encode($input);

?>