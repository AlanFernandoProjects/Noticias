<?php
	if(isset($_GET['insertado'])){
		if($_GET['insertado']){
			echo "Se ha agregado la nota correctamente";
		}else{
			echo "No se ha podido agregar la nota.";
		}
	}
	if(isset($_POST['enviar'])){
		if(is_uploaded_file($_FILES['imagen']['tmp_name'])){
			$ruta = "images/";
			$nombreFinal = strtolower($_FILES['imagen']['name']);
			$nombreFinal = str_replace(" ", "-", $nombreFinal);
			//$nombreFinal = trim($nombreFinal);
			//$nombreFinal = preg_replace(" ", "-", $nombreFinal);
			$upload = $ruta.$nombreFinal;

			if(move_uploaded_file($_FILES['imagen']['tmp_name'], $upload)){
				echo "Se subió correctamente el archivo al servidor.";
			}



		}
		$titulo = $_POST['titulo'];
		$autor = $_POST['autor'];
		$fecha = date('Y-m-d');
		$contenido = $_POST['contenido'];
		$enlace = $_POST['enlace'];
		//$imagen = $_POST['imagen'];
		
		//Estableciendo la conexión con la BD
		$conexion = mysqli_connect('localhost','root','');
		if(!$conexion){
			die("Error conectando con el servidor.");
		}
		//Seleccionar la base de datos para hacer las consultas
		mysqli_select_db($conexion,'php-intro')
			or die("Error seleccionando la base de datos;");
		//Preparando la consulta SQL
		$sql="INSERT INTO tbl_notas (titulo,autor,fecha,contenido,enlace,imagen) VALUES ('".$titulo."','".$autor."','".$fecha."','".$contenido."','".$enlace."','".$nombreFinal."');";
		if(!$resultado = mysqli_query($conexion,$sql)){
			echo "No se pudo hacer la inserción de la nota en la base de datos.";
		}else{
			echo "Se ha insertado correctamente la nota la base de datos.";
			header('Location: notas.php?op=5&insertado=true');

		}
		
		
	}
?>
<div class="col-xs-10 col-xs-offset-2">
	<h2>Agregar un nueva nota al blog</h2>
	<form class="form" role="form" action="agregarNota_bk.php" method="post" enctype="multipart/form-data">
		<div class="form-group">
			<label for="titulo">Titulo de la nota: </label>
			<input type="text" name="titulo" placeholder="Introduce el titulo para la nota" id="titulo">
		</div>
		<div class="form-group">
			<label for="autor">Autor:</label>
			<input type="text" name="autor" placeholder="Introduce el nombre del autor" id="autor">
		</div>
		<div class="form-group">
			<label for="contenido">Contenido: </label>
			<textarea name="contenido" rows="5" placeholder="Contenido" id="contenido"></textarea>
		</div>
		<div class="form-group">
			<label for="imagen">Imagen: </label>
			<input type="file" name="imagen">
		</div>
		<div class="form-group">
			<label for="enlace">Enlace: </label>
			<input type="text" name="enlace" placeholder="http://">
		</div>
		<button type="submit" class="btn btn-primary" name="enviar">Agregar Nota</button>
	</form>
</div>