<?php
	include_once('header.php');
	session_start();
	if(isset($_POST['enviar'])){
		$usuario = $_POST['user'];
		$password = $_POST['password'];
		$email = $_POST['email'];
		//Estableciendo la conexión con la BD
		$conexion = mysqli_connect('localhost','root','');
		if(!$conexion){
			die("Error conectando con el servidor.");
		}
		//Seleccionar la base de datos para hacer las consultas
		mysqli_select_db($conexion,'php-intro')
			or die("Error seleccionando la base de datos;");
		//Preparando la consulta SQL
		$sql="SELECT * FROM tbl_users WHERE user='".$usuario."' AND password='".$password."' AND email = '".$email."';";
		$result=mysqli_query($conexion,$sql);
		if(mysqli_num_rows($result)>0)
		{
			$user = mysqli_fetch_assoc($result);
			echo "Se ha iniciado sesión correctamente.";
			echo "Bienvenido ".$user['nombres']." ".$user['apellidos']."!<br>";
			$_SESSION['user']=array(
						'username'=>$user['user'],
						'nombre'=>$user['nombres'],
						'apellido'=>$user['apellidos'],
						'email'=>$user['email'],
						'role'=>$user['role']
			);
			header('Location: notas.php');
		}else{
			echo '<div class="col-md-4 col-md-offset-4"><p class="bg-danger" style="padding: 10px; text-align:center; color: red;">Los datos que ingreso no son correctos.</p></div>';
		}
	}
	#Comentario de Linea
 ?>
<div class="col-md-4 col-md-offset-4">
	<h1 style="text-align: center;">Iniciar Sesión</h1>
	<form class="form" action="login.php" method="POST">
		<div class="form-group">
			<label for="user">Usuario</label>
			<input class="form-control" type="text" id="user" name="user" placeholder="Usuario"><br>
			<label for="email">E-mail</label>
			<input class="form-control" type="text" name="email" placeholder="E-mail">
			<br>
			<label for="pass">Password</label>
			<input class="form-control" type="password" id="pass" name="password" placeholder="password"><br><br>
			<input class="form-control btn btn-primary" type="submit" name="enviar" value="Entrar"><br><br>
		</div>
	</form>
</div>


<?php 
	//session_destroy();//Borrar todas las variables de sesion activas
	//unset($_SESSION['user']);//Borrar una variable especifica
	include_once('footer.php');
 ?>