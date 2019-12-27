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
		$contenido = nl2br($_POST['contenido']);
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
			echo "No se pudo agregar la nota.";
		}else{
			echo "Se agrego correctamente la nota.";
			header('Location: notas.php');
		}
	}

?>
<div class="notas col-xs-10 col-xs-offset-1">
	<h1 style="text-align: center; margin-bottom: 30px;">Agregar un nueva nota al blog</h1>
	<form class="form" action="agregarNota.php" role="form" method="post" enctype="multipart/form-data">
		<div class="form-group">
			<label for="titulo">Titulo de la nota: </label>
			<input type="text"  class="form-control" name="titulo" placeholder="Ingrese el titulo" id="titulo">
		</div>
		<div class="form-group">
			<label for="autor">Autor:</label>
			<select name="autor" class="form-control" id="autor">
                    <option>Usuario</option>
                    <option>Administrador</option>
        	</select>
		</div>
		<div class="form-group">
			<label for="contenido">Contenido: </label>
			<textarea name="contenido" class="form-control" id="contenido" rows="10" placeholder="Contenido"></textarea>
		</div>
		<div class="form-group">
			<label for="enlace">Enlace: </label>
			<input type="text"   class="form-control" name="enlace" placeholder="http://">
		</div>
		<div class="form group">
			<label for="imagen">Imagen: </label>
			<input type="file"   class="form-control" name="imagen">
		</div>
		<br>
		<br>
		<div class="form-group">
			<a class="btn btn-danger pull-right" href="notas.php">Cancelar</a>
			<button type="submit" name="enviar" class="pull-right btn btn-primary">Agregar Nota</button>
		</div>
	</form>
</div>