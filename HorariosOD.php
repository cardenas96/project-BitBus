<HTML> 
<HEAD> <title>Consulta los horarios</title>
	<link rel="stylesheet" type="text/css" href="estilo.css"></HEAD> 
<BODY> 
    <?php 
	include("menu.php"); 
	?>
	<center>
		<div id="formulario">
			<form method='post' action='consultaHorarios.php'>
			
			<fieldset class="bordear-fiel1">
			<legend align="center">Selecciona el dia, origen y destino</legend>
			<table>
			<tr>
			<td>
			<table >
<!--				<tr><th><label>DIA   </label></th>
				<td><select class="textbox" name='dia'>
				<option value='lunes'>Lunes</option>
                <option value='martes'>Martes</option>
				<option value='miercoles'>Miercoles</option>
				<option value='jueves'>Jueves</option>
				<option value='viernes'>Viernes</option>
				<option value='sabado'>Sabado</option>
				<option value='domingo'>Domingo</option>
				</select></td>
				</tr>   -->       
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
			
<!--			<fieldset class="bordear-fiel">
			<legend align="center">Selecciona Chofer y Autobus</legend>
			<table>
			<tr>
			<td>
			<table >
			 
				<tr><th><label>NOMBRE   </label></th>
				<td><input class="textbox" type='text' name='nombre'></td>
				</tr>
				<tr><th><label>EMAIL   </label></th>
				<td><input  class="textbox" type='email' name='email'></td>
				</tr>
				<tr><th><label>PASSWORD   </label></th>
				<td><input class="textbox" type='password' name='contra' maxlength='35'></td>
				</tr>
				<tr><th><label>CONFIRMA PASSWORD   </label></th>
				<td><input class="textbox" type='password' name='confirmaContra' maxlength='35'></td>
				</tr>

				<tr><th><label>ROL   </label></th>
				<td><select class="textbox" name='rol'>
				<option value='Administrador'>Administrador</option>
				<option value='Vendedor'>Vendedor</option>
				</select></td>
				</tr>
                <tr><th><label>DIRECCION   </label></th>
				<td><input class="textbox" type='text' name='direccion'></td></tr>
            </table>
            </td>
            <td>
            <table class='segunda'>
				<tr><th><label>CIUDAD   </label></th>
				<td><input class="textbox" type='text' name='ciudad'></td></tr>
				<tr><th><label>COLONIA   </label></th>
				<td><input class="textbox" type='text' name='colonia'></td></tr>
				<tr><th><label>CODIGO POSTAL   </label></th>
				<td><input class="textbox" type='text' name='cp' maxlength='5'></td></tr>
            </table>
            </td>
            </tr>
            </table>
				<input class="botones-input" type='submit' value='Guardar'>
				<input class="botones-input" type='reset' value='Limpiar'>
			</fieldset>	  -->
			</form>
			
		</div>
		<br><br><br><br><br>
	</center>            
    <?php 
	include("pie_pagina.html");
    ?>
    </BODY>
    </HTML>