<?php 
$server = "D5CLQ382\SQLEXPRESS";
$connectionInfo = array( "Database"=>"dbdds", "UID"=>"CBDRCVP", "PWD"=>"cbd1" );
$conn = sqlsrv_connect( $server, $connectionInfo ); ?>

<?php
$data = array();
 
function add_person( $id, $incdia )
{
global $data;
 
$data []= array(
'id' => $id,
'incdia' => $incdia
);
}
 
if ( $_FILES['file']['tmp_name'] )
{
$dom = DOMDocument::load( $_FILES['file']['tmp_name'] );
$rows = $dom->getElementsByTagName( 'Row' );
$first_row = true;
foreach ($rows as $row)
{
if ( !$first_row )
{
$id = "";
$incdia = "";

 
$index = 1;
$cells = $row->getElementsByTagName( 'Cell' );
foreach( $cells as $cell )
{ 
$ind = $cell->getAttribute( 'Index' );
if ( $ind != null ) $index = $ind;
 
if ( $index == 1 ) $id = $cell->nodeValue;
if ( $index == 2 ) $incdia = $cell->nodeValue;
 
		
$index += 1;
}
add_person( $id, $incdia );
}
$first_row = false;
}
}
?>

<table>
<tr>
<th>id</th>
<th>incdia</th>
</tr>
<?php foreach( $data as $row ) { ?>
<tr>

<td><?php echo( $row['id'] ); ?></td>
<td><?php echo( $row['incdia'] ); ?></td>
</tr>


<?php 

$id1=$row['id'] ;
$incdia1=$row['incdia'] ;



//$excel_update = "UPDATE usuarionom SET incdia='$incdia1' WHERE ucfdi='$id1'  "; 
$excel_update = "UPDATE usuarionom SET incdia='88.2' WHERE ucfdi='88229'"; 
sqlsrv_query($conn, $excel_update) or die (print_r( sqlsrv_errors(), true));

echo $sqlsrv_query;

//$excel_insert = "INSERT INTO test (first, middle,last,email) SELECT '$first','$middle','$last','$email'";
//sqlsrv_query($conn, $excel_insert) or die (print_r( sqlsrv_errors(), true));

//Nota:
//hay muchos detalles que pulir aqui , incluso se puede mejorar rapido para que se puede adjuntar directamente 
//el documento en excel pero en vista de que aun hay cambios en esta parte dejar pendiente 


header("location: excel.php"); 
echo "no hizo nada";
} 

?>
</table>



                                                                                                       