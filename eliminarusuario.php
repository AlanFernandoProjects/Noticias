<?php
session_start();
include('header.php');
include('menu.php');
	if (isset($_GET['userid'])) 
	{
		if ($_SESSION['user']['email'] != $_GET['userid']) {	
		
			$email = $_GET['userid'];
			$conexion = mysqli_connect("localhost","root","");
			mysqli_select_db($conexion,'php-intro');
			$sql="DELETE FROM tbl_users WHERE email = '".$email."' ";
			$result = mysqli_query($conexion,$sql);
			header('location: verusuarios.php');
		}
		else
		{
			echo '<div class="col-md-4 col-md-offset-4"><p class="bg-danger" style="padding: 10px; text-align:center; color: red;"> No se pudo eliminar al usuario activo</p> <br> <a style="margin-bottom: 20%;"  class="btn btn-danger" href="verusuarios.php">Cancelar</a></div>';
		}
	}
	else
	{
		echo '<div class="col-md-4 col-md-offset-4"><p class="bg-danger" style="padding: 10px; text-align:center; color: red;">No se pudo eliminar al usuario</p><br><a style="margin-bottom: 20%;" class="btn btn-danger" href="verusuarios.php">Cancelar</a></div>';
	}

?>