<?php
session_start();
include('header.php');
include('menu.php');
$conexion=mysqli_connect('localhost','root','');
mysqli_select_db($conexion,'php-intro');
$sql="SELECT * FROM tbl_users";
$resultado=mysqli_query($conexion,$sql);



	while ($nota = mysqli_fetch_assoc($resultado) ) 
	{
?>
	<div class="col-md-10 col-md-offset-1">
		<br>
	</div>
	<div style="background-color: #ccc;" class="col-md-10 col-md-offset-1">
		<h4 ><?php echo "<b>Nombre</b><br>". $nota['nombres']." ".$nota['apellidos']."<br><br><b>E-mail</b><br> ".$nota['email']."<br><br><b>Rol</b><br> ".$nota['role']."<br><br><b>Usuario</b><br> ".$nota['user'];?></h4>
		<div style="float: right;">
			<a href="eliminarusuario.php?userid=<?php echo $nota['email'];?>" class="btn btn-danger">Eliminar</a>
		</div>
	</div>
	
<?php
	}
	include('footer.php');
?>