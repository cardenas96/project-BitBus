<header id="main-header">
	<div id ="navHead">
	  <a id="logo-img" href="principal.php">
		<span class="site-name"><img src="imagenes/logo01.png" alt="imagen" width="134px" height="96px"></span>
	  </a>
	   <a id="logo-header" href="principal.php">
		 <span class="site-name">Sistema BitBus</span>
		 <span class="site-desc">Administracion / Consultas / Informes</span>
	  </a>

	   <!--<nav class="navbar navbar-expand-lg navbar-light bg-light">-->
	   <nav class="nav" role="navigation">
		<? 
		  
		   session_start();
			@$nombre = $_SESSION['nombre'];
			if($nombre == 1)
			{
    		?>
		 	 <ul>
			<!--<li>
				<a>
					Catalogos</a>
			 <ul>
				 <li><a href="poblaciones.php">Poblacion</a></li>
				 <li><a href="camiones.php">Camiones</a></li>
				 <li><a href="choferes.php">Choferes</a></li>
				 <li><a href="horarios.php">Horarios</a></li>
				 <li><a href="usuarios.php">Usuarios</a></li>
			 </ul></li>
			<li><a href="#">Viajes</a></li>-->
			<li><a href="iniciar_sesion.php">Iniciar Sesion</a></li>
		 </ul>
		   <?
		   }
		   else
		   {
		   ?>
		   	<ul>
			 <li>
				 <a>Reportes</a>
				 <ul>
					 <li><a href="ReporteDeViajes.php">Viajes</a></li>
					 <li><a href="ReporteHorarios.php">Horario</a></li>
					 <li><a href="PoblacionesR.php">Poblaciones</a></li>
					 <li><a href="ReporteCamiones.php">Camiones</a></li>
					 <li><a href="ReporteChoferes.php">Choferes</a></li>
					 <li><a href="ReporteBoletoV.php">Boletos x Viaje</a></li>
				 </ul>
			 </li>
			<li>
				<a>Catalogos</a>
			 <ul>
				 <li><a href="poblaciones.php">Poblacion</a></li>
				 <li><a href="camiones.php">Camiones</a></li>
				 <li><a href="choferes.php">Choferes</a></li>
				 <li><a href="horarios.php">Horarios</a></li>
				 <li><a href="usuarios.php">Usuarios</a></li>
				 <li><a href="HorariosOD.php">Viajes</a></li>
			 </ul></li>
			<li>
				<a>Movimientos</a>
				<ul><li><a href="registraviaje.php">Viajes</a></li>
					<li><a href="ventaBoletos.php">Vender Boleto</a></li>
					</ul></li>
			<li><a href="#"><? echo $nombre; ?></a>
				<ul><li><a href="CierreS.php">Cerrar Sesión</a></li>
				</ul>
				</li>
		 </ul>
		   <?
		   }
		   ?>
	   </nav>
	</div>
</header>