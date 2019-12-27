<?php
	session_start();
	
	//Estableciendo la conexión con la BD
	$conexion = mysqli_connect('localhost','root','');
	if(!$conexion){
		die("Error conectando con el servidor.");
	}
	//Seleccionar la base de datos para hacer las consultas
	mysqli_select_db($conexion,'php-intro')
		or die("Error seleccionando la base de datos;");
	//Preparando la consulta SQL
	$sql="SELECT * FROM tbl_notas";
	//El resultado de la consulta se guardará en la siguiente variable:
	$resultado=mysqli_query($conexion,$sql);
	//Vamos a convertir el objeto en un array asociativo
	//$notas = mysqli_fetch_assoc($result);
	//Mostramos el resultado para analizarlo
	//echo "<h1>".$row['contenido']."</h1>";







	include_once('header.php');
	include('menu.php');
	if(isset($_GET['op'])){
		switch ($_GET['op']){
			case 1:
				include('nosotros.php');
				break;
			case 2:
				echo "<h1>Portafolio</h1>";
				break;
			case 3:
				echo "<h1>Blog</h1>";
				break;
			case 4:
				echo "<h1>Contacto</h1>";
				break;
			case 5:
				include('agregarNota.php');
				break;
			case 6:
				include('vernota.php');
				break;
			case 7:
				include('modificarNota.php');
				break;
			case 8:
				header('location: agregarusuario.php');
				break;
			default:
				echo "<h1>Página no encontrada</h1>";
				break;
		}
	}else{
	
	#echo $nota['fecha'];//como se accede a los elementos por medio de su llave
	while ($nota = mysqli_fetch_assoc($resultado) ) {
?>
	<div class="notas col-xs-12 col-md-4">
		<!--<img class="img img-responsive" src="images/<?php echo $nota['imagen']; ?>.jpg" alt="">-->
		<div class="nota" style="width:100%; min-height: 150px; background: url('images/<?php echo $nota['imagen']; ?>'); background-position: center;"></div>
		<h2><?php echo $nota['titulo']; ?></h2>
		<h4><?php echo $nota['autor']; ?></h4>
		<p><b><?php echo $nota['fecha']; ?></b></p>
		<p><?php echo substr($nota['contenido'],0,200)." ..."; ?></p>
		<a class="pull-right btn btn-default" href="<?php echo "?op=6&notaid=".$nota['id']; ?>">Leer más</a>
		<br>
	</div>
<?php
	}
}
	include_once('footer.php');
?>
