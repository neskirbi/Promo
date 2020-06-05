<?php
    $title ="Tickets | ";
    include "head.php";
    include "sidebar.php";
    //nota en el head esta el conect db
?>
<!-----------------------------------------------------------------------------------------------------------------------------------------------------> 






<?php
$sql_reclutamiento_checkbox = "SELECT * FROM usuarionom WHERE us_nombre_real='VACANTE'  ORDER BY Id_usuario ASC";
$result = sqlsrv_query($conn, $sql_reclutamiento_checkbox) or die(mysqli_error());

?>
<script language="javascript" src="users.js" type="text/javascript"></script>
<form name="frmUser" method="post" action="">
<div>
    <tr>    
        <input type="button" name="update" value="Update" onClick="setUpdateAction();" />
    <input type="button" name="generar periodo" value="generar"  onClick="setDeleteAction();" /> 
     </tr>
<table class="table table-striped jambo_table table-bordered col-xs-12">
<tr class="listheader">
<td></td>
<td>2</td>
<td>1</td>
<td>0</td>
</tr>
<?php
$i=0;
while($row = sqlsrv_fetch_array($result))  {
if($i%2==0)
$classname="evenRow";
else
$classname="oddRow";
?>
<tr class="<?php if(isset($classname)) echo $classname;?>">
<td><input type="checkbox" name="users[]" value="<?php echo $row["Id_usuario"]; ?>" ></td>
<td><?php echo $row["puesto"]; ?>puestoid</td>
<td><?php echo $row["us_nombre_real"]; ?>nombre</td>
<td><?php echo $row["ruta"]; ?>ruta</td>
</tr>
<?php
$i++;
}
?>
<tr class="listheader">
<td colspan="4">
</td>

</tr>
</table>
</form>



<!----------------------------------------------------------------------------------------------------------------------------------------------------->        

<?php include "footer.php" ?>
