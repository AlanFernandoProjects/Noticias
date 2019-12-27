<?php
session_start();
include('header.php');
include('menu.php');

if (isset($_POST['agregar'])) 
{
	$conexion = mysqli_connect('localhost','root','');
	mysqli_select_db($conexion,'php-intro');
	$nombre = $_POST['nombre'];
	$apellido = $_POST['apellido'];
	$sql = "INSERT INTO tbl_autores values (null,'".$nombre."','".$apellido."')";
	if ($nombre != "" and $apellido != "") 
	{
	
		if(mysqli_query($conexion,$sql))
		{
			echo '<div class="col-md-4 col-md-offset-4"><p class="bg-defaut" style="padding: 10px; text-align:center; color: green;">Se agregp cprrectamente al autor <br> <a href="agregarautor.php" class="btn btn-primary">Regresar</a></p></div> ';
		}
		else
		{
			echo '<div class="col-md-4 col-md-offset-4"><p class="bg-danger" style="padding: 10px; text-align:center; color: red;">No se pudo agregar al autor. <br/><a href="agregarautor.php" class="btn btn-primary">Regresar</a></p></div> ';
		}
	}
	else
	{
		echo '<div class="col-md-4 col-md-offset-4"><p class="bg-danger" style="padding: 10px; text-align:center; color: red;">Los datos que ingreso no son correctos. <br/><a href="agregarautor.php" class="btn btn-primary">Regresar</a></p></div> ';

	}


}
else
{
?>

	<div class="col-md-10 col-md-offset-1">
		<div class="form-group" class="row">
			<form action="agregarautor.php" method="POST">
				<label>Nombre</label>
				<input class="form-control" type="text" name="nombre" placeholder="Nombre del autor">
				<br>
				<label>Apellido</label>
				<input class="form-control" type="text" name="apellido" placeholder="Apellido del autor">
				<br>
				<div style="float: right; margin-bottom: 5%;">
					<button name="agregar" class="btn btn-primary">Agregar</button>
					<a href="notas.php" class="btn btn-danger">Cancelar</a>
				</div>
			</form>
		</div>
	</div>


<?php
}
include('footer.php');
?>