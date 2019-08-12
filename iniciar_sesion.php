 <!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Iniciar Sesion</title>
<link href="estilo.css" rel="stylesheet" type="text/css">
<link href="css/bootstrap.min.css" rel="stylesheet" type="text/css">
</head>
<body bgcolor=#EC3E3E>
	<?
		include("menu_libre.html");
	$correo = isset($_POST['correo']) ? $_POST['correo'] : null ;
	if($correo == null || $_POST['pass'] == null)
	{
	?>
	<center><div class="inicio-sesion">
	<form class="form-signin" method="post" action="iniciar_sesion.php">
      <img src="imagenes/users.png" width="200" height="200">
      <h1 class="h3 mb-3 font-weight-normal text-white">Iniciar Sesion</h1>
      <label for="inputEmail" class="sr-only">Correo:</label>
      <input type="email" id="inputEmail" class="form-control" placeholder="Cuenta de Usuario" required="" autofocus="" name='correo'>
      <label for="inputPassword" class="sr-only">Contraseña:</label>
      <input type="password" id="inputPassword" class="form-control" placeholder="Contraseña de usuario" required="" name="pass">
      <div class="checkbox mb-3">
        <label>
          <input type="checkbox" class="text-white" value="remember-me"> Recordar Cuenta
        </label>
      </div>
      <button class="btn btn-lg btn-primary btn-block" type="submit">Iniciar Sesion</button>
      <!--<p class="mt-5 mb-3 text-muted">© 2017-2018</p>-->
    </form>
	</div></center>
	<?
	}
	else
	{
		$host_db="localhost";
        $usuario_db="root";
        $pass_db="";
		$conexion=mysqli_connect($host_db,$usuario_db,$pass_db);
        mysqli_select_db($conexion,"bitbus");
		$c = $_POST['correo'];
		$p = $_POST['pass'];
		$ban1 = false;
		$ban2 = false;
		$query = "SELECT idRol,nombre,correo,contrasena FROM Usuarios WHERE correo = '$c'";
		$resultado = mysqli_query($conexion,$query);

		//$fila = mysqli_fetch_row($resultado);
		if($resultado)
		{

			$fila = mysqli_fetch_row($resultado);
			$correo = $fila[2];
			if ($correo == $c)
			{
				$cadena = '';
				$ban1 = true;
			}
			else
				//$cadena = '<center><h1>Correo Incorrecto<h1></center><br>';
				$cadena = 'Correo Incorrecto\n';


			$pass = $fila[3];
			if ($pass == $p)
			{
				$ban2 = true;
			}
			else
				//$cadena = $cadena . '<center><h2>Contraseña Incorrecta<h2></center>';
				$cadena = $cadena . 'Contraseña Incorrecta';

			if($ban1 == true && $ban2 == true)
			{
				session_start();
				$_SESSION['idRol'] = $fila[0];
				$_SESSION['nombre'] = $fila[1];
				echo "<center><h1>Bienvenido $fila[1]</h1></center>";
				echo '<meta http-equiv="Refresh" content="4;URL=http://localhost:8080/Bitbus/principal.php">';
				//echo "<script type=\"text/javascript\">alert('Bienvenido ' . $fila[1]');window.location='principal.php';</script>";
			}
			else
			{
				//echo "$cadena";
				//echo "<meta http-equiv='Refresh' content='5;URL=http://localhost:8080/Bitbus/iniciar_sesion.php'>";
				echo "<script type=\"text/javascript\">alert('$cadena');window.location='iniciar_sesion.php';</script>";
			}
		}


	}
	include("pie_pagina.html");
	?>
</body>
</html>
