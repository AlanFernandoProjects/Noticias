<?php
	if (isset($_GET['autorid'])) 
	{
		$conexion = mysqli_connect("localhost","root","");
		mysqli_select_db($conexion,'php-intro');
		$sql="DELETE FROM tbl_autores WHERE id = ".$_GET['autorid']." ";
		$result = mysqli_query($conexion,$sql);
		header('location: verautores.php');
	}
	else
	{
		echo '<div class="col-md-4 col-md-offset-4"><p class="bg-danger" style="padding: 10px; text-align:center; color: red;">No se pudo eliminar al autor</p></div>';
	}

?>