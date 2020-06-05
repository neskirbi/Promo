<?php
$server = "D5CLQ382\SQLEXPRESS";
$connectionInfo = array( "Database"=>"dbventasjtib", "UID"=>"claudio", "PWD"=>"cpromo*" );
$conn = sqlsrv_connect( $server, $connectionInfo );
$query = "SELECT * FROM testC ORDER BY id DESC";
$result = sqlsrv_query($conn, $query);
?>

        
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
     <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />  
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>            
    <script src="jquery.tabledit.js"></script>



    
  
    <table id="editable_table" class="table table-bordered table-striped">
     <thead>
      <tr>
       <th>ID</th>
       <th>First Name</th>
       <th>Last Name</th>
      </tr>
     </thead>
     <tbody>
     <?php

     while($row = sqlsrv_fetch_array($result)){
      echo '
      <tr>
       <td>'.$row["id"].'</td>
       <td>'.$row["fisrt"].'</td>
       <td>'.$row["last"].'</td>
      </tr>
      ';
     }?>
     </tbody>
    </table>
    

 
<script>  

     $('#editable_table').Tabledit({
      url:'action.php',
      columns:{
       identifier:[0, "id"],
       editable:[[1, 'fisrt'], [2, 'last']]
      },
     });
 

 </script>

