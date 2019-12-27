<?php
session_start();
	include('header.php');
	INCLUDE('menu.php');

	if (isset($_POST['agregar'])) 
	{
		$nombre = $_POST['nombre'];
		$apellido = $_POST['apellido'];
		$user = $_POST['user'];
		$contraseña = $_POST['pass'];
		$email = $_POST['email'];
		$role = $_POST['tipo'];

		$conexion = mysqli_connect("localhost","root","");
		mysqli_select_db($conexion,'php-intro');

		$sql = "  INSERT INTO tbl_users values ('".$nombre."','".$contraseña."','".$user."','".$nombre."','".$apellido."','".$role."')  ";
		
		if (mysqli_query($conexion,$sql)) 
		{
			header('location: notas.php');
		}
		else
		{
			echo '<div class="col-md-4 col-md-offset-4"><p class="bg-danger" style="padding: 10px; text-align:center; color: red;">Los datos que ingreso no son correctos o ya existe un usuario con dichos datos.</p></div>';
		}
	}

?>

<div class="col-md-10 col-md-offset-1">
	<h1>Agregar usuario</h1>
	<br>
	<form class="form" action="agregarusuario.php" method="POST">
		<dic class="form-group">
			<label>Nombre</label>
			<input class="form-control" type="text" name="nombre" placeholder="Nombre">
			<br>
			<label>Apellido</label>
			<input class="form-control" type="text" name="apellido" placeholder="Apellido">
			<br>
			<label>User</label>
			<input class="form-control" type="text" name="user" placeholder="Nombre de usuario">
			<br>
			<label>Contraseña</label>
			<input class="form-control" type="password" name="pass" placeholder="Contraseña">
			<br>
			<label>Email</label>
			<input class="form-control" type="text" name="email" placeholder="E-mail">
			<br>
			<label>Tipo de Usuario</label>
			<select name="tipo" class="form-control">
                    <option>Usuario</option>
                    <option>Administrador</option>
        	</select>
        	<br>
        	<br>


			<div style="float: right;">
				<button style="margin-bottom: 20%;" name="agregar" type="submit" class="btn btn-primary">Agregar</button>
				<a style="margin-bottom: 20%;" type="submit" class="btn btn-danger" href="notas.php">Cancelar</a>
			</div>
		</dic>
	</form>
</div>


<?php
	include('footer.php');
?>