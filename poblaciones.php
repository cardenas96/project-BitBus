<HTML> 
<HEAD><title>Consulta Poblacion</title>
	
	</HEAD>
	<link rel="stylesheet" type="text/css" href="estilo.css">
<BODY> 
 <?
	  	include("menu.php");
	  ?>
    <?php 
        IF (!@$_POST['nombre']) 
        { 
    ?>
	<div id="formulario">
            <center><FORM method='post' action='poblaciones.php'> 
				<fieldset class="bordear-fiel" >
					<legend align="center"> Consultar Municipio </legend>
				<div class="form-group">
				<table>
					<tr><th><label>NOMBRE   </label></th></tr>
					<tr><td><INPUT class="textbox" type='text' size=30 name='nombre' placeholder="Ingrese poblacion"><BR> </td></tr>
				</table>
					<br>
					</div>
					<INPUT class="botones-input" type='submit' value='Agregar'>
					<INPUT class="botones-input" type='reset' value='Limpiar'>
					</fieldset>			
            </FORM> </center>
		   </div>
    <?php
        } 
        else 
        { //inserta datos
            $host_db="localhost"; 
            $usuario_db="root"; 
            $pass_db=""; 
            $b=$_POST['nombre']; 
            $conexion=mysqli_connect($host_db,$usuario_db,$pass_db); 
            mysqli_select_db($conexion,"bitbus");
            $resultados=mysqli_query($conexion,"select * from poblaciones"); 
            $a = mysqli_num_rows($resultados) + 1; 

            $sql="insert into poblaciones (idPoblacion,nombre) values ('$a','$b')"; 
            //echo $sql."<br>"; 
            $resultados=mysqli_query($conexion,$sql); 
            if (!mysqli_error($conexion)) 
            {  
                echo "<br><center><h1>La población fué insertada con éxito</h1></center>"."<br>"; 
				echo "<meta http-equiv='Refresh' content='5'>";
            } 
            else 
            {  
                echo "<br><center><h1>La población no fué insertada con éxito</h1></center>"."
				<br>"; 
				echo "<meta http-equiv='Refresh' content='5'>";

            }
            
            mysqli_close($conexion);
        }
	$host_db = "localhost";
	$usuario_db = "root";
	$pass_db ="";
	$conexion = mysqli_connect($host_db,$usuario_db,$pass_db);
	mysqli_select_db($conexion,"bitbus");
	//$resultado = mysqli_query($conexion,"SELECT * FROM Poblacion");
	echo '<br><br><br><center><table id = "tabla-consulta">';
	echo '<tr><th><h2>Poblaciones Registradas<h2></th></tr>';
	if($resultado = mysqli_query($conexion,"SELECT * FROM poblaciones"))
	{
		while($fila = mysqli_fetch_row($resultado))
		{
			printf( '<tr><td>%s</td></tr>',$fila[1]);
		}
	}
	//else
		//echo "<h1>No hay datos registrados</h1>";
	echo '</table></center>';
	mysqli_close($conexion);
    ?>
	
	<?
		include("pie_pagina.html");
	?><!-- / #main-footer -->			
    </BODY>
    </HTML>