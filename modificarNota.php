<?php
	if(isset($_POST['enviar'])){
		if(is_uploaded_file($_FILES['imagen']['tmp_name'])){
			$ruta = "images/";
			$nombreFinal = strtolower($_FILES['imagen']['name']);
			$nombreFinal = str_replace(" ", "-", $nombreFinal);
			$upload = $ruta.$nombreFinal;
			if(move_uploaded_file($_FILES['imagen']['tmp_name'],$upload)){
				echo "Se subió correctamente el archivo al
				servidor.";
			}
		}

		$titulo = $_POST['titulo'];
		$autor = $_POST['autor'];
		$fecha = date("Y-m-d");
		$contenido = htmlspecialchars($_POST['contenido']);
		$enlace = $_POST['enlace'];
		$id = $_POST['id'];
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
		$sql="UPDATE tbl_notas SET titulo='".$titulo."', autor='".$autor."',fecha='".$fecha."',contenido='".$contenido."',enlace='".$enlace."',imagen='".$nombreFinal."' WHERE id='".$id."';";
		if(!$resultado = mysqli_query($conexion,$sql)){
			echo "No se pudo modificar la nota.";
		}else{
			echo "Se modificó correctamente la nota.";
			header('Location: notas.php');
		}
	}
	if(isset($_GET['notaid'])){
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
		$resultado = mysqli_query($conexion,$sql);
		$nota = mysqli_fetch_assoc($resultado);
	}

?>

<div class="notas col-xs-10 col-xs-offset-1">
	<h1>Actualizar los datos de la nota</h1>
	<form class="form" action="modificarNota.php" role="form" method="post" enctype="multipart/form-data">
		<div class="form-group">
			<label for="titulo">Titulo de la nota: </label>
			<input type="text"  class="form-control" name="titulo" placeholder="Ingrese el titulo" id="titulo" value="<?php echo $nota['titulo']; ?>">
		</div>
		<div class="form-group">
			<label for="autor">Autor:</label>
			<input type="text"  class="form-control" name="autor" placeholder="Ingrese el nombre del autor" id="autor" value="<?php echo $nota['autor']; ?>">
		</div>
		<div class="form-group">
			<label for="contenido">Contenido: </label>
			<textarea name="contenido" class="form-control" id="contenido" rows="10" placeholder="Contenido"><?php echo htmlspecialchars_decode($nota['contenido']); ?></textarea>
		</div>
		<div class="form-group">
			<label for="enlace">Enlace: </label>
			<input type="text" class="form-control" name="enlace" placeholder="http://"  value="<?php echo $nota['enlace']; ?>">
		</div>
		<div class="form group">
			<label for="imagen">Imagen: </label>
			<input type="file"   class="form-control" name="imagen">
		</div>
			<input type="hidden" name="id" value="<?php echo $id; ?>">
		<div class="form-group">
			
			<a class="btn btn-danger pull-right" href="notas.php?op=6&notaid=<?php echo $id; ?>">Cancelar</a>
			<button type="submit" name="enviar" class="pull-right btn btn-primary">Actualizar Nota</button>
			<!-- Comentarios en HTML -->
		</div>
	</form>
</div>