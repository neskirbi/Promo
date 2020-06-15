
<form method="post" action="Stack2.php" enctype="multipart/form-data">
	<input type="file" name="archivo">
	<input type="text" name="directorio">
	<input type="submit" name="boton">
</form>

<?php

if(isset($_FILES['archivo']))
{
	//datos del arhivo 
	$nombre_archivo = $_FILES['archivo']['name']; 
	$tipo_archivo = $_FILES['archivo']['type']; 
	$tamano_archivo = $_FILES['archivo']['size']; 

	echo "Nombre del archivo: ".$_FILES['archivo']['name']."<br>";
	echo "Tipo del archivo: ".$_FILES['archivo']['type']."<br>";
	echo "Tamaño del archivo: ".$_FILES['archivo']['size']." bytes<br>";

	if(isset($_POST['directorio']) and !empty($_POST['directorio']))
	{
		$path = $_POST['directorio'].$_FILES['archivo']['name'];
	}
	else
	{
		$path = $_FILES['archivo']['name'];
	}

	//Guardar archivo
	if (move_uploaded_file($_FILES['archivo']['tmp_name'], $path)) 
	{
        echo "Se guardo";
    }
}



?>
	