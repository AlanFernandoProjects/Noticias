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
		$sql="SELECT * FROM tbl_notas WHERE id=".$id.";";
		//Ejecutamos la sentencia sql en el servidor de BD
		$result = mysqli_query($conexion, $sql);
		$nota = mysqli_fetch_assoc($result);
	}
?>
	
	<div class="col-xs-10 col-xs-offset-1">
		<h2><?php echo $nota['titulo']; ?></h2>
		<div style="width:100%; min-height: 200px; background: url('images/<?php echo $nota['imagen']; ?>'); background-position: center;"></div>
		
		<h4><?php echo $nota['autor']; ?></h4>
		<p><b><?php echo $nota['fecha']; ?></b></p>
		<p><?php echo htmlspecialchars_decode($nota['contenido']); ?></p>
		<p><a class="btn btn-default" href="notas.php"><span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span> Volver</a><a class="btn btn-info" href="<?php echo $nota['enlace']; ?>" target="blank"><span class="glyphicon glyphicon-info-sign" aria-hidden="true"></span> Ver Fuente</a>
<?php
		//Si esta iniciada una sesión de usuario se mostrarán los botones de 'Editar Nota' y 'Eliminar Nota'.
		if(isset($_SESSION['user'])){
?>
		<a class="btn btn-warning" href="notas.php?op=7&notaid=<?php echo $nota['id']; ?>"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> Editar Nota</a>
<?php
		if (isset($_SESSION['user'])) 
		{
			if ($_SESSION['user']['role']=='Administrador') 
			{
?>
				<a class="btn btn-danger" href="eliminarNota.php?notaid=<?php echo $nota['id']; ?>"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span> Eliminar Nota</a></p>';
<?php
			}
		}
		
?>
<?php
	}
?>
		<br>
	</div>

	