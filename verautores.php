<?php
session_start();
include('header.php');
include('menu.php');
$conexion=mysqli_connect('localhost','root','');
mysqli_select_db($conexion,'php-intro');
$sql="SELECT * FROM tbl_autores";
$resultado=mysqli_query($conexion,$sql);


	while ($nota = mysqli_fetch_assoc($resultado) ) 
	{
?>
	<div class="col-md-10 col-md-offset-1">
		<h4 class="form-control"><?php echo $nota['nombre']." ".$nota['apellido']; ?></h4>
		<div style="float: right;">
			<a href="eliminarautor.php?autorid=<?php echo $nota['id'];?>" class="btn btn-danger">Eliminar</a>
		</div>
	</div>
	
<?php
	}
	include('footer.php');
?>