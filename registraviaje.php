<HTML> 
<HEAD> <title>Registro de Viajes</title>
	<link rel="stylesheet" type="text/css" href="estilo.css"></HEAD> 
<BODY> 
    <?php 
	include("menu.php"); 
	?>
	<center>
		<div id="formulario">
			<form method='post' action='seleccionaHorario.php'>
			
			<fieldset class="bordear-fiel1">
			<legend align="center">Selecciona Los Datos Del Viaje</legend>
			<table>
			<tr>
			<td>
			<table >    
                <tr><th><label>FECHA DE VIAJE      </label></th>
                <td><input class='textbox' type="date" name='fechaViaje'></td>
                </tr>
            </table>
            </td>
            <td>
            <table class='segunda'>
				<tr><th><label>ORIGEN   </label></th>
				<td><select class="textbox" name='origen'>
				<?php poblaciones(); ?>
				</select></td>
                <tr><th><label>DESTINO   </label></th>
				<td><select class="textbox" name='destino'>
				<?php poblaciones(); ?>
				</select></td>

            </table>
            </td>
            </tr>
            </table>
                <input class="botones-input" type='submit' value='Siguiente'>
				<input class="botones-input" type='reset' value='Limpiar'>
			</fieldset>	
			
            <?php
                function poblaciones()
                {
                    $host_db="localhost"; 
                    $usuario_db="root"; 
                    $pass_db=""; 
                    $conexion=mysqli_connect($host_db,$usuario_db,$pass_db); 
                    mysqli_select_db($conexion,"bitbus");
                    $resultados=mysqli_query($conexion,"select * from poblaciones");
                    while($row = mysqli_fetch_array($resultados))
                    {
                        echo "<option value='" .$row['idPoblacion']."'>" . $row['nombre'] . "</option>";
                    }
                    mysqli_close($conexion);
                }
            ?>
			</form>
		</div>
		<br><br><br><br><br>
	</center>            
    <?php 
	include("pie_pagina.html");
    ?>
    </BODY>
    </HTML>