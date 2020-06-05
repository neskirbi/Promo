<?php
include"../conexion/conexion.php";
    $title ="Tickets | ";
    include "head.php";
    include "sidebar.php";
?>
<!----------------------------------------------------------------------------------------------------------------------------------------------------->              


asdas
<?php


$sql = "SELECT * FROM usuarionom";
$params = array();
$options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
$stmt = sqlsrv_query( $conn, $sql , $params, $options );

$row_count = sqlsrv_num_rows( $stmt );
   
if ($row_count === false)
   echo "Error in retrieveing row count.";
else
   echo $row_count;
?>

<!----------------------------------------------------------------------------------------------------------------------------------------------------->          
<?php include "footer.php" ?>