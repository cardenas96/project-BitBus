<HTML> 
<HEAD> <title>Administracion De Usuarios</title>
	<link rel="stylesheet" type="text/css" href="estilo.css"></HEAD> 
<BODY> 
    <?php 
	include("menu.php");
        IF (!@$_POST['nombre']) 
        { 
	?>
	<center>
		<div id="formulario">
			<form method='post' action='usuarios.php'>
			<fieldset class="bordear-fiel">
			<legend align="center">Registro de Usuarios</legend>
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
				<tr><th><label>TELEFONO   </label></th>
				<td><input class="textbox" type='text' name='telefono' maxlength='12'></td></tr>
				<tr><th><label>FOTOGRAFIA   </label></th>
				<td><input class="botones-input" type='file' name='foto'></td></tr>
				<tr><th><label>FECHA DE REGISTRO   </label></th>
				<td><input class="textbox" type='date' name='fechaRegistro'></td></tr>
            </table>
            </td>
            </tr>
            </table>
				<input class="botones-input" type='submit' value='Guardar'>
				<input class="botones-input" type='reset' value='Limpiar'>
			</fieldset>	
			</form>
		</div>
	</center>                
    <?php 
        } 
        else 
        { //inserta datos
            $host_db="localhost"; 
            $usuario_db="root"; 
            $pass_db=""; 
            $a=$_POST['rol'];
            $b=$_POST['nombre']; 
            $c=$_POST['direccion']; 
            $d=$_POST['colonia']; 
            $e=$_POST['ciudad']; 
            $f=$_POST['cp'];
            $g=$_POST['telefono'];
            $h=$_POST['foto'];
            $i=$_POST['fechaRegistro']; 
            $j=$_POST['email']; 
            $k=$_POST['contra'];
            $k2=$_POST['confirmaContra'];
            $h = str_replace('\\',";",$h);
            $conexion=mysqli_connect($host_db,$usuario_db,$pass_db); 
            mysqli_select_db($conexion,"bitbus");
            $resultados=mysqli_query($conexion,"select * from usuarios");
            if (mysqli_num_rows($resultados)>0)
            {
                $contador = mysqli_num_rows($resultados) + 1;
            } 
            else
            {
                $contador = 1;
            }
            switch($a)
            {
                case 'Administrador':
                    $a = 1;
                    break;
                case 'Vendedor';
                    $a = 2;
                    break;
            }
            $sql="insert into usuarios values ('$contador','$a','$b','$c','$d','$e','$f','$g','$h','$i','$j','$k')"; 
            echo $sql."<br>"; 
            $resultados=mysqli_query($conexion,$sql); 
            if (!mysqli_error($conexion)) 
            {  
                 echo "<br><center><h1>El Usuario fué registrado con éxito</h1></center>"."<br>"; 
				echo "<meta http-equiv='Refresh' content='5'>";
            } 
            else 
            {  
                echo "El usuario no fué insertado con éxito"."<br>"; 

            }
        }
		$host_db = "localhost";
		$usuario_db = "root";
		$pass_db ="";
		$conexion = mysqli_connect($host_db,$usuario_db,$pass_db);
		mysqli_select_db($conexion,"bitbus");
		echo '<br><br><br><center><table id = "tabla-consulta-u">';
		echo '<tr><th colspan="10"><h2>Usuarios Registrados<h2></th></tr>';
		echo '<tr><th>Nombre</th><th>Direccion</th><th>Colonia</th><th>Ciudad</th><th>Codigo Postal</th><th>Telefono</th><th>Foto</th><th>Registro</th><th>Correo</th><th>Contraseña</th><th>Rol</th></tr>';
		if($resultado = mysqli_query($conexion,"SELECT * FROM Usuarios"))
		{
			while($fila = mysqli_fetch_row($resultado))
			{
				if($fila[1] = 1)
				{
					$estado = "Administrador";
				}
				else
				{
					$estado = "Vendedor";
				}
				printf( '<tr><td>%s</td><td>%s</td><td>%s</td><td>%s</td><td>%s</td><td>%s</td><td>%s</td><td>%s</td><td>%s</td><td>%s</td><td>%s</td></tr>',$fila[2],$fila[3],$fila[4],$fila[5],$fila[6],$fila[7],$fila[8],$fila[9],$fila[10],$fila[11],$estado);
			}
		}
		echo '</table></center>';
		mysqli_close($conexion);
	include("pie_pagina.html");
    ?>
    </BODY>
    </HTML>