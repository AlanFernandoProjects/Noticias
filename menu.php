<div id="menu-principal" class="col-xs-12">
	<div class="pull-left">
		<ul id="opciones" class="nav nav-pills">
			<li><a href="notas.php">Inicio</a></li>
			<li><a href="?op=1">Nosotros</a></li>
			<li><a href="?op=2">Portafolio</a></li>
			<li><a href="?op=3">Blog</a></li>
			<li><a href="?op=4">Contacto</a></li>

			
				
			
<?php
		//Esta opción está reservada y sólo se mostrará a los usuarios que hayan iniciado sesión en el sitio.
		if(isset($_SESSION['user'])){
			echo '<li><a href="?op=5">Agregar Nota</a></li>';
		}
?>
<?php 
		if (isset($_SESSION['user'])) 
		{
			if ($_SESSION['user']['role']=='Administrador') 
			{
				echo '
<li><div  class="btn-group">
  <button style="margin:5px;" type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    Usuarios
  </button>
  <div style="text-align: center;" class="dropdown-menu">
    <a style=" color:black; text-align: center;" class="dropdown-item" href="verusuarios.php">Ver usuarios</a><br>
    <a style="color:black; text-align: center;" class="dropdown-item" href="agregarusuario.php">Agregar usuario</a><br>
  </div>
</div></li>';
				echo '
<li><div  class="btn-group">
  <button style="margin:5px;" type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    Autores
  </button>
  <div style="text-align: center;" class="dropdown-menu">
    <a style=" color:black; text-align: center;" class="dropdown-item" href="verautores.php">Ver autores</a><br>
    <a style="color:black; text-align: center;" class="dropdown-item" href="agregarautor.php">Agregar autor</a><br>
  </div>
</div></li>';
			}
			
		}

?>
		</ul>
	</div>
	<div  class="pull-right">
		<ul id="sesion" class="nav nav-pills">
<?php
			//Dependiendo de si se ha iniciado una sesión se mostrará el boton de 'Iniciar Sesión' o las acciones que puede hacer un usuario logueado (entre ellas cerrar sesión). 
			if(isset($_SESSION['user'])){
				//Si entra aquí es por que existe una sesión abierta y se muestran las acciones que puede realizar un usuario logueado.
				echo '<li><a class="btn btn-success" href="cerrarSesion.php">'.$_SESSION['user']['username'].'</a></li>';
			}else{
				//Si entra aquí es por que no se ha iniciado sesión y se da la opción de iniciarla y es redireccionado al formulario de inicio de sesión.
				echo '<li><a class="btn btn-primary" href="login.php">Iniciar Sesión</a></li>';
				
			}
?>
		</ul>
	</div>
</div>

