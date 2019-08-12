<HTML> 
<HEAD><title>Administracion Choferes</title> </HEAD>
	<link rel="stylesheet" type="text/css" href="estilo.css">
<BODY> 
 
    <?php
	include("menu.php");
                        $host_db="localhost"; 
                        $usuario_db="root"; 
                        $pass_db=""; 
                        $conexion=mysqli_connect($host_db,$usuario_db,$pass_db); 
                        mysqli_select_db($conexion,"bitbus");
                        $resultados = mysqli_query($conexion,"insert into viajes values()");
                        while($row = mysqli_fetch_array($resultados))
                        {
                            echo "<option value='" .$row[0]."'>" . $row[2] . "</option>";
                        }
                        mysqli_close($conexion);
    ?>
    <?php  
                echo "<br><center><h1>El Viaje fué registrado con éxito</h1></center>"."<br>"; 
				echo "<meta http-equiv='Refresh' content='5;URL=registraViaje.php'>";
          
	include("pie_pagina.html");
    ?>
    </BODY>
    </HTML>