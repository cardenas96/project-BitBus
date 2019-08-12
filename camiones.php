<HTML> 
<HEAD><title>Administracion De Camiones</title></HEAD> 
	<link rel="stylesheet" type="text/css" href="estilo.css">
<BODY> 
    <?php
	include("menu.php");
        IF (!@$_POST['marca']) 
        { 
			?>
			<div id ="formulario">
				<center>
                <FORM method='post' action='camiones.php'>
					<fieldset class="bordear-fiel" >
						<legend align="center">Registro de Camiones</legend>
					<table>
					<tr><th><label>MARCA   </label></th>
					<td><input type='text'  class="textbox" name='marca'></td></tr>
					<tr><th><label>MODELO   </label></th>
					<td><input type='text'  class="textbox" name='modelo'></td></tr>
					<tr><th><label>CAPACIDAD   </label></th>
					<td><input type='number'  class="textbox" name='capacidad' step='1'></td></tr>
					<tr><th><label>ESTADO   </label></th>
					<td><select name='estado'  class="textbox">
					<option value='activo'>Activo</option>
					<option value='inactivo'>Inactivo</option></td></tr>
					</table>
					</select><br>
					<input class="botones-input" type='submit' value='Guardar'>
					<input class="botones-input"  type='reset' value='Limpiar'>
					</fieldset>
                </form>
				</center>
            </div>
            
    <?php 
        } 
        else 
        { //inserta datos
            $host_db="localhost"; 
            $usuario_db="root"; 
            $pass_db=""; 
            $a=$_POST['marca'];
            $b=$_POST['modelo']; 
            $c=$_POST['capacidad']; 
            $d=$_POST['estado']; 
            $conexion=mysqli_connect($host_db,$usuario_db,$pass_db); 
            mysqli_select_db($conexion,"bitbus");
            $resultados=mysqli_query($conexion,"select * from autobus");
            if (mysqli_num_rows($resultados)>0)
            {
                $contador = mysqli_num_rows($resultados) + 1;
            } 
            else
            {
                $contador = 1;
            }
            switch($d)
            {
                case 'activo':
                    $d = 1;
                    break;
                case 'inactivo';
                    $d = 2;
                    break;
            }
            $sql="insert into autobus values ('$contador','$a','$b','$c','$d')"; 
            echo $sql."<br>"; 
            $resultados=mysqli_query($conexion,$sql); 
            if (!mysqli_error($conexion)) 
            {  
            	echo "<br><center><h1>El Autobus fué registrado con éxito</h1></center>"."<br>"; 
			 	echo "<meta http-equiv='Refresh' content='5'>";
            } 
            else 
            {  
                echo "El autobus no fué registrado con éxito"."<br>"; 

            }
            
            mysqli_close($conexion);
        }
	$host_db = "localhost";
	$usuario_db = "root";
	$pass_db ="";
	$conexion = mysqli_connect($host_db,$usuario_db,$pass_db);
	mysqli_select_db($conexion,"bitbus");
	echo '<br><br><br><center><table id = "tabla-consulta">';
	echo '<tr><th><h2>Poblaciones Registradas<h2></th></tr>';
	echo '<tr><th>Marca</th><th>Modelo</th><th>Capacidad</th><th>Estado</th></tr>';
	if($resultado = mysqli_query($conexion,"SELECT * FROM autobus"))
	{
		while($fila = mysqli_fetch_row($resultado))
		{
			if($fila[4] = 1)
			{
				$estado = "Activo";
			}
			else
			{
				$estado = "Inactivo";
			}
			printf( '<tr><td>%s</td><td>%s</td><td>%s</td><td>%s</td></tr>',$fila[1],$fila[2],$fila[3],$estado);
		}
	}
	echo '</table></center>';
	mysqli_close($conexion);
    ?>
	<?
		include("pie_pagina.html");
	?><!-- / #main-footer -->	
    </BODY>
    </HTML>