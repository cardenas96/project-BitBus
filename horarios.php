<HTML> 
<HEAD><title>ADMINISTRACION DE HORARIOS</title> 
	<link rel="stylesheet" type="text/css" href="estilo.css">
	</HEAD> 
<BODY> 
 
    <?php 
	include("menu.php");
        IF (!@$_POST['origen']) 
        { 
			?>
		<center>
			<div id="formulario">
                <FORM method='post' action='horarios.php'>
				<fieldset class="bordear-fiel">
				<legend align="center">Registro de Horarios</legend>
				<table >
                <tr><th><label>ORIGEN   </label></th>
                <td><select name='origen' class="textbox">
			<?php
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
                echo "</select></td></tr>";
            
                echo "<tr><th><label>DESTINO   </label></th>";
                echo "<td><select name='destino' class='textbox'>";
                $resultados=mysqli_query($conexion,"select * from poblaciones");
                while($row = mysqli_fetch_array($resultados))
                {
                    echo "<option value='" .$row['idPoblacion']."'>" . $row['nombre'] . "</option>";
                }
			?>
                </select></td></tr>
				<tr><th><label>HORA   </label></th>
                <td><input class="textbox" type='time' name='hora'></td></tr>
				<tr><th><label>DIA   </label></th>
                <td><select class="textbox" name='dia'>
                <option value'lunes'>Lunes</option>
                <option value'martes'>Martes</option>
                <option value'miercoles'>Miercoles</option>
                <option value'jueves'>Jueves</option>
                <option value'viernes'>Viernes</option>
                <option value'sabado'>Sabado</option>
                <option value'domingo'>Domingo</option>
				</select></td></tr>
				<tr><th><label>ESTADO   </label></th>
                <td><select class="textbox" name='estado'>
                <option value'activo'>Activo</option>
                <option value'inactivo'>Inactivo</option>
                </select></td></tr>
				<tr><th><label>PRECIO DEL BOLETO  (SIN IVA)   </label></th>
				<td><input class="textbox" type='number' name='precioBoleto' placeholder='0.0' step='0.01'></td></tr>
				<tr><th><label>Hora Aproximada Llegada:  </label></th>
				<td><input class="textbox" type='time' name='horaLlegada'></td></tr>
				</table>
                <input class="botones-input" type='submit' value='Guardar'>
                <input class="botones-input" type='reset' value='Limpiar'>
				</fieldset>
                </form>
			<?
                mysqli_close($conexion);
            ?>
			</div>
		</center>
    <?php 
        } 
        else 
        { //inserta datos
            $host_db="localhost"; 
            $usuario_db="root"; 
            $pass_db=""; 
            $a=$_POST['origen'];
            $b=$_POST['destino']; 
            $c=$_POST['hora']; 
            $d=$_POST['dia']; 
            $e=$_POST['estado']; 
            $f=$_POST['precioBoleto'];
			$g= $_POST['horaLlegada'];
            $conexion=mysqli_connect($host_db,$usuario_db,$pass_db); 
            mysqli_select_db($conexion,"bitbus");
            $resultados=mysqli_query($conexion,"select * from horario");
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
                case "Lunes":
                    $d = 1;
                    break;
                case "Martes":
                    $d = 2;
                    break;
                case "Miercoles":
                    $d = 3;
                    break;
                case "Jueves":
                    $d = 4;
                    break;
                case "Viernes":
                    $d = 5;
                    break;
                case "Sabado":
                    $d = 6;
                    break;
                case "Domingo":
                    $d = 7;
                    break;
            }
            switch($e)
            {
                case 'Activo':
                    $e = 1;
                    break;
                case 'Inactivo';
                    $e = 2;
                    break;
            }
            $sql="insert into horario values ('$contador','$a','$b','$c','$d','$e','$f','$g')"; 
            //echo $sql."<br>"; 
            $resultados=mysqli_query($conexion,$sql); 
            if (!mysqli_error($conexion)) 
            {  
               echo "<br><center><h1>El horario fué registrado con éxito</h1></center>"."<br>"; 
				echo "<meta http-equiv='Refresh' content='5'>";
            } 
            else 
            {  
                echo "La horario no fué insertada con éxito"."<br>"; 
                echo "<meta http-equiv='Refresh' content='5'>";
            }
            
            //mysqli_close($conexion);
        }
		$host_db = "localhost";
		$usuario_db = "root";
		$pass_db ="";
		$conexion = mysqli_connect($host_db,$usuario_db,$pass_db);
		mysqli_select_db($conexion,"bitbus");
		echo '<br><br><br><center><table id = "tabla-consulta" width="600px">';
		echo '<tr><th colspan="7"><h2>Horarios Registrados<h2></th></tr>';
		echo '<tr><th>Origen</th><th>Destino</th><th>Hora</th><th>Dia</th><th>Estado</th><th>Precio</th><th>Llegada</th></tr>';
		if($resultado = mysqli_query($conexion,"SELECT * FROM horario"))
		{			
			while($fila = mysqli_fetch_row($resultado))
			{
				$origen = mysqli_query($conexion,"SELECT * FROM Poblaciones where idPoblacion = $fila[1]");
				$origenc = mysqli_fetch_row($origen);
				$destino = mysqli_query($conexion,"SELECT * FROM Poblaciones where idPoblacion = $fila[2]");
				$destinoc = mysqli_fetch_row($destino);
				
				switch($fila[4])
				{
					case 1:
						$dia = "Lunes";
						break;
					case 2:
						$dia = "Martes";
						break;
					case 3:
						$dia = "Miercoles";
						break;
					case 4:
						$dia = "Jueves";
						break;
					case 5:
						$dia = "Viernes";
						break;
					case 6:
						$dia = "Sabado";
						break;
					case 7:
						$dia = "Domingo";
						break;
				} 
				
				if($fila[5] = 1)
				{
					$estado = "Activo";
				}
				else
				{
					$estado = "Inactivo";
				}
				printf( '<tr><td>%s</td><td>%s</td><td>%s</td><td>%s</td><td>%s</td><td>%s</td><td>%s</td></tr>',$origenc[1],$destinoc[1],$fila[3],$dia,$estado,$fila[6],$fila[7]);
			}
		}
		echo '</table></center>';
		mysqli_close($conexion);
	
	include("pie_pagina.html");
    ?>
    </BODY>
    </HTML>