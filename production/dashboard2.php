<?php
    $title ="Tickets | ";
    include "head.php";
    include "sidebar.php";
    //nota en el head esta el conect db
?>
<!----------------------------------------------------------------------------------------------------------------------------------------------------->  

    <script src="http://code.jquery.com/jquery-1.10.2.js"></script>
    <script>
    function showEdit(editableObj) {
      $(editableObj).css("background","#FFF");
    } 
    
    function saveToDatabase(editableObj,column,id) {
      $(editableObj).css("background","#FFF url(loaderIcon.gif) no-repeat right");
      $.ajax({
        url: "saveedit.php",
        type: "POST",
        data:'column='+column+'&editval='+editableObj.innerHTML+'&id='+id,
        success: function(data){
          $(editableObj).css("background","#FDFDFD");
        }        
       });
    }
    </script>

<div class="col-md-12 col-sm-12 col-xs-12">
<div class="tile-stats">
     <div class="x_panel ">
      <?php     
//solo lo que corresponde al que se logeo ...falta moverle el id usuaro por otra cosa
//$result = sqlsrv_query($conn, "SELECT * FROM usuario WHERE Id_usuario=".$_SESSION['Id_usuario']." ORDER BY Id_usuario DESC");

      
//$result = sqlsrv_query($conn, "SELECT * FROM usuario ORDER BY Id_usuario DESC");  
$sql4 = sqlsrv_query($conn, "SELECT TOP 1 periodo FROM periodo ORDER BY idp DESC");
 if($c=sqlsrv_fetch_array($sql4)) {
                                $ultimoPeriodo=$c['periodo'];
                      
                            } 
?>
                  <div class="x_title ">
                    <h4><i class="fa fa-globe"> Personal activo autorizado.</i></h4><h4 class="pull-right">Periodo: <?php echo $ultimoPeriodo; ?>.</h4>
                    <div class="clearfix"></div>
                  </div>

    <div class="x_content">
    <div class="row">
<?php 
$sql = "SELECT * from usuariosnomi ORDER BY Id_usuario ASC";
$result = sqlsrv_query($conn, $sql);



?>
<div class="table-responsive">

<form name="frmUser" method="post" action="">
<div style="width:500px;">
<table border="0" cellpadding="10" cellspacing="1" width="500" class="tblListForm">
<tr class="listheader">
<td></td>
<td>Username</td>
<td>First Name</td>
<td>Last Name</td>
</tr>
<?php
$i=0;
while($row = mysqli_fetch_array($result))  {
if($i%2==0)
$classname="evenRow";
else
$classname="oddRow";
?>
<tr class="<?php if(isset($classname)) echo $classname;?>">
<td><input type="checkbox" name="users[]" value="<?php echo $row["userId"]; ?>" ></td>
<td><?php echo $row["userName"]; ?></td>
<td><?php echo $row["firstName"]; ?></td>
<td><?php echo $row["lastName"]; ?></td>
</tr>
<?php
$i++;
}
?>
<tr class="listheader">
<td colspan="4"><input type="button" name="update" value="Update" onClick="setUpdateAction();" /> <input type="button" name="delete" value="Delete"  onClick="setDeleteAction();" /></td>
</tr>
</table>
</form>
</div>






</div>
</div>
<div>
</div>
</div>
      </div>
</div>
</div> 



<!----------------------------------------------------------------------------------------------------------------------------------------------------->        


<?php include "footer.php" ?>