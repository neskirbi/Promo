<?php  
$server = "D5CLQ382\SQLEXPRESS";
$connectionInfo = array( "Database"=>"dbventasjtib", "UID"=>"claudio", "PWD"=>"cpromo*" );
$conn = sqlsrv_connect( $server, $connectionInfo );

 $output = '';  
 $sql = "SELECT * FROM testC ORDER BY id DESC";  
 $result = sqlsrv_query($conn, $sql);  
 $output .= '  
      <div class="table-responsive">  
           <table class="table table-bordered">  
                <tr>  
                     <th width="10%">Id</th>  
                     <th width="40%">First Name</th>  
                     <th width="40%">Last Nkame</th>  
                     <th width="10%">Delete</th>  
                </tr>';  
 $rows = sqlsrv_num_rows($result);
 if($rows > 0)  
 {  
	  if($rows > 10)
	  {
		  $delete_records = $rows - 10;
		  $delete_sql = "DELETE FROM testC LIMIT $delete_records";
		  sqlsrv_query($conn, $delete_sql);
	  }
      while($row = sqlsrv_fetch_array($result))  
      {  
           $output .= '  
                <tr>  
                     <td>'.$row["id"].'</td>  
                     <td class="fisrt" data-id1="'.$row["id"].'" contenteditable>'.$row["fisrt"].'</td>  
                     <td class="last" data-id2="'.$row["id"].'" contenteditable>'.$row["last"].'</td>  
                     <td><button type="button" name="delete_btn" data-id3="'.$row["id"].'" class="btn btn-xs btn-danger btn_delete">x</button></td>  
                </tr>  
           ';  
      }  
      $output .= '  
           <tr>  
                <td></td>  
                <td id="fisrt" contenteditable></td>  
                <td id="last" contenteditable></td>  
                <td><button type="button" name="btn_add" id="btn_add" class="btn btn-xs btn-success">+</button></td>  
           </tr>  
      ';  
 }  
 else  
 {  
      $output .= '
				<tr>  
					<td></td>  
					<td id="fisrt" contenteditable></td>  
					<td id="last" contenteditable></td>  
					<td><button type="button" name="btn_add" id="btn_add" class="btn btn-xs btn-success">+</button></td>  
			   </tr>';  
 }  
 $output .= '</table>  
      </div>';  
 echo $output;  
 ?>