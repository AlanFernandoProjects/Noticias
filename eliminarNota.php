<?php 
	if(isset($_GET['notaid'])) {
		$id = $_GET['notaid'];

		//Estableciendo la conexión con la BD
		$conexion = mysqli_connect('localhost','root','');
		if(!$conexion){
			die("Error conectando con el servidor.");
		}
		//Seleccionar la base de datos para hacer las consultas
		mysqli_select_db($conexion,'php-intro')
			or die("Error seleccionando la base de datos;");
		//Preparando la consulta SQL
		$sql="DELETE FROM tbl_notas WHERE id=".$id.";";
		//Ejecutamos la sentencia sql en el servidor de BD
		$result = mysqli_query($conexion, $sql);
		header('Location: notas.php');
	}
?>