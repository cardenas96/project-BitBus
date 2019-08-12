<HTML> 
<HEAD><title>Administracion Choferes</title> </HEAD>
	<link rel="stylesheet" type="text/css" href="estilo.css">
<BODY> 
 
    <?php
	include("menu.php");
        IF (!@$_POST['nombre']) 
        {
			 ?>
		<center>
			<div id="formulario">
			<FORM method='post' action='choferes.php'>
			<fieldset class="bordear-fiel"  >
				<legend align="center">Registro de Choferes</legend>
				<div class="form-group">
				<table>
					<tr><th><label>NOMBRE   </label></th>
					<td><input class="textbox" type='text' name='nombre' size="40"></td></tr>
					<tr><th><label>DIRECCION   </label></th>
					<td><input class="textbox" type='text' name='direccion' size="40"></td></tr>
					<tr><th><label>TELEFONO   </label></th>
					<td><input class="textbox" type='text' name='telefono' maxlength='12'></td></tr>
					<tr><th><label>FECHA DE REGISTRO   </label></th>
					<td><input class="textbox" type='date' name='fechaRegistro'></td></tr>
					<tr><th><label>VIGENCIA DE LA LICENCIA   </label></th>
					<td><input class="textbox" type='date' name='vigenciaLicencia'><br><td></th></tr>
					<tr><th></tg><label>FOTOGRAFIA   </label></th>
					<td></rd><input class="botones-input" type='file' name='foto'></td></tr>
					<tr><th><label>ESTADO   </label></th>
					<td><select class="textbox" name='estado'>
					<option value='activo'>Activo</option>
					<option value='inactivo'>Inactivo</option>
						</select></td></tr>
				</table>
				</div>
				<br>
				<input class="botones-input" type='submit' value='Guardar'>
				<input class="botones-input" type='reset' value='Limpiar'>
			</fieldset>
			</div>
			</form>		
		</center>
    <?php 
        } 
        else 
        { //inserta datos
            $host_db="localhost"; 
            $usuario_db="root"; 
            $pass_db=""; 
            $a=$_POST['nombre'];
            $b=$_POST['direccion']; 
            $c=$_POST['telefono']; 
            $d=$_POST['fechaRegistro']; 
            $e=$_POST['vigenciaLicencia']; 
            $f=$_POST['foto'];
            $g=$_POST['estado'];
            $f = str_replace('\\',";",$f);
            $conexion=mysqli_connect($host_db,$usuario_db,$pass_db); 
            mysqli_select_db($conexion,"bitbus");
            $resultados=mysqli_query($conexion,"select * from choferes");
            if (mysqli_num_rows($resultados)>0)
            {
                $contador = mysqli_num_rows($resultados) + 1;
            } 
            else
            {
                $contador = 1;
            }
            switch($g)
            {
                case 'activo':
                    $g = 1;
                    break;
                case 'inactivo';
                    $g = 2;
                    break;
            }
            $sql="insert into choferes values ('$contador','$a','$b','$c','$d','$f','$e','$g')"; 
            //echo $sql."<br>"; 
            $resultados=mysqli_query($conexion,$sql); 
            if (!mysqli_error($conexion)) 
            {  
                echo "<br><center><h1>El Chofer fué registrado con éxito</h1></center>"."<br>"; 
				echo "<meta http-equiv='Refresh' content='5'>";
            } 
            else 
            {  
                echo "El chofer no fué insertado con éxito"."<br>"; 
            }
        }
			$host_db = "localhost";
			$usuario_db = "root";
			$pass_db ="";
			$conexion = mysqli_connect($host_db,$usuario_db,$pass_db);
			mysqli_select_db($conexion,"bitbus");
			echo '<br><br><br><center><table id = "tabla-consulta">';
			echo '<tr><th><h2>Choferes Registrados<h2></th></tr>';
			echo '<tr><th>Nombre</th><th>Direccion</th><th>Telefono</th><th>Fecha de Registro</th><th>foto</th><th>Caducidad Licencia</th><th>Estado</th></tr>';
			if($resultado = mysqli_query($conexion,"SELECT * FROM choferes"))
			{
				while($fila = mysqli_fetch_row($resultado))
				{
					if($fila[7] = 1)
					{
						$estado = "Activo";
					}
					else
					{
						$estado = "Inactivo";
					}
					printf( '<tr><td>%s</td><td>%s</td><td>%s</td><td>%s</td><td>%s</td><td>%s</td><td>%s</td></tr>',$fila[1],$fila[2],$fila[3],$fila[4],$fila[5],$fila[6],$estado);
				}
			}
			echo '</table></center>';
			mysqli_close($conexion);
	include("pie_pagina.html");
    ?>
    </BODY>
    </HTML>