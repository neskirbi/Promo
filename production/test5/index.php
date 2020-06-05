<?php 
$server = "D5CLQ382\SQLEXPRESS";
$connectionInfo = array( "Database"=>"dbventasjtib", "UID"=>"claudio", "PWD"=>"cpromo*" );
$conn = sqlsrv_connect( $server, $connectionInfo ); ?>

<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
<!-- jQuery -->

<script type="text/javascript" src="jquery.tabledit.js"></script>

</head>
<body class="">
	<div class="container" style="min-height:500px;">

<div class="container home">	
	 
	<table id="data_table" class="table table-striped">
		<thead>
			<tr>
				<th>Id</th>
				<th>Name</th>
				<th>Gender</th>
				<th>Age</th>	
				<th>Designation</th>
				<th>Address</th>
			</tr>
		</thead>
		<tbody>
			<?php 
			$sql_query = "SELECT id, name, gender, address, designation, age FROM developers";
			$resultset = sqlsrv_query($conn, $sql_query) or die("database error:". sqlsrv_error($conn));
			while( $developer = sqlsrv_fetch_array($resultset) ) {
			?>
	   <tr id="<?php echo $developer ['id']; ?>">
			   <td><?php echo $developer ['id']; ?></td>
			   <td><?php echo $developer ['name']; ?></td>
			   <td><?php echo $developer ['gender']; ?></td>
			   <td><?php echo $developer ['age']; ?></td>   
			   <td><?php echo $developer ['designation']; ?></td>
			   <td><?php echo $developer ['address']; ?></td> 
		 
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
		  editable: [[1, 'name'], [2, 'gender'], [3, 'age'], [4, 'designation'], [5, 'address']]
		},
		hideIdentifier: true,
		url: 'live_edit.php'		
	});
});

</script>

</div>
</body>
</html>
 



                                                                                                       