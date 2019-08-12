<html>
	<script type="text/JavaScript">
	var conexion; //variable que manejará la conexionAJAX
    
    function crearXMLHttpRequest()  
    { 
        var xmlHttp=null; 
        if(window.ActiveXObject) 
            xmlHttp= new ActiveXObject("Microsoft.XMLHTTP"); 
        else if(window.XMLHttpRequest) 
            xmlHttp= new XMLHttpRequest(); 
        return xmlHttp; 
    }
	
	function mostrarMensaje(val)
	{
		if(val != 0)
            {
                document.getElementById("mensaje").style.display = 'block';
            }
        else
            document.getElementById("mensaje").style.display = 'none';
	}
	
	function obtenerViaje(val)
	{
		//alert(val);
		conexion = crearXMLHttpRequest(); 
        conexion.onreadystatechange = procesarViaje;
        conexion.open('GET', 'cargaDatosViajes.php?idViaje=' + val , true); 
        conexion.send(null); 
	}
        
        
    function asientosDisponiblesMapa(val)
	{
        //alert(val);
		conexion = crearXMLHttpRequest(); 
        conexion.onreadystatechange = procesarAsientosDisponiblesMapa;
        conexion.open('GET', 'asientosDisponiblesMapa.php?idViaje=' + val , true); 
        conexion.send(null); 
	}
        function procesarAsientosDisponiblesMapa()
        {
            if (conexion.readyState == 4)
            {
                document.getElementById("mapita").innerHTML = conexion.responseText;
                obtenerAsientosDisponibles(document.getElementById("destino").value);
            }
        }
        
        
        
        
        
        function obtenerAsientosDisponibles(val)
        {
            conexion = crearXMLHttpRequest(); 
            conexion.onreadystatechange = procesarAsientosDisponibles;
            conexion.open('GET', 'asientosDisponibles.php?idViaje=' + val , true); 
            conexion.send(null); 
        }
        function procesarAsientosDisponibles()
        {
            if (conexion.readyState == 4)
            {
                var r = conexion.responseText;
                var x = document.getElementsByClassName("textboxAsientos");
                var i;
                for (i = 0; i < x.length; i++) 
                {
                    x[i].innerHTML = r;
                } 
                
            }
        }
        
        
        
        
        
	function procesarViaje()
	{
		if (conexion.readyState == 4)
            {
                var cadena = conexion.responseText;
				separador = "?", // un espacio en blanco
    			arregloHorarios = cadena.split(separador);	//Convierte en Arreglo
				console.log(arregloHorarios);
				document.getElementById("asientos").value = arregloHorarios[0];
                document.getElementById("precio").value = "$" + arregloHorarios[1];
                asientosDisponiblesMapa(document.getElementById("destino").value)
            }
	}
</script>
<head>
<meta charset="utf-8">
<title>Venta de Boletos</title>
	<link rel="stylesheet" type="text/css" href="estilo.css"> 
	<?php include("menu.php");?>
</head>
<body>
	<?php
		$origen = $_POST['origen'];
		$destino = $_POST['destino'];
		$fecha = $_POST['fechaViaje'];
	    $cantidad = $_POST['cantidad'];
	    ?>
	<?php
		function obtenerDia($d)
		{
			/*$num = @$d[weekday];
			if($num == 1)
				$num = 7;
			else
				$num = $num-1;
			*/
			$array_dias['Sunday'] = 7;
			$array_dias['Monday'] = 1;
			$array_dias['Tuesday'] = 2;
			$array_dias['Wednesday'] = 3;
			$array_dias['Thursday'] = 4;
			$array_dias['Friday'] = 5;
			$array_dias['Saturday'] = 6;

			$num = $array_dias[date('l', @strtotime($d))]; 
			
			//echo $num;
			return $num;
		}
		function poblaciones($p)
		{
			$host_db="localhost"; 
			$usuario_db="root"; 
			$pass_db=""; 
			$conexion=mysqli_connect($host_db,$usuario_db,$pass_db); 
			mysqli_select_db($conexion,"bitbus");
			$resultados=mysqli_query($conexion,"select * from poblaciones WHERE idPoblacion = $p");
			while($row = mysqli_fetch_array($resultados))
			{
				echo "<th>" . $row['nombre'] . "</th>";
			}
			mysqli_close($conexion);
		}
	
	
	function horariosDisponibles($or,$de,$fe)
		{
			$host_db="localhost"; 
			$usuario_db="root"; 
			$pass_db=""; 
			$conexion=mysqli_connect($host_db,$usuario_db,$pass_db); 
			mysqli_select_db($conexion,"bitbus");
            $resultados=mysqli_query($conexion,"SELECT v.idViaje,v.idHorario,h.hora from viajes v inner join horario h on v.idHorario = h.idHorario where h.idPoblacionO = $or and h.idPoblacionD = $de and h.dia =" . obtenerDia($fe)); 
            //$resultados=mysqli_query($conexion,"SELECT * from horario where idPoblacionO = $or and idPoblacionD = $de");
        
		/*	$resultados=mysqli_query($conexion,"SELECT v.idViaje,p.nombre,po.nombre,h.hora,v.dia,v.Asientos,h.precioBoleto FROM VIAJES v 
			INNER JOIN HORARIO h ON v.idHorario = h.idHorario
			INNER JOIN POBLACIONES p ON h.idPoblacionO = p.idPoblacion
			INNER JOIN POBLACIONES po ON h.idPoblacionD = po.idPoblacion
			WHERE h.idPoblacionO = $or AND h.idPoblacionD = $de AND h.dia = ".obtenerDia($fe).""); */
			//echo "h1>".$f."</h1>";
			while($row = mysqli_fetch_array($resultados))
			{
				echo "<option value='" .$row[0]."'>" . $row[2] . "</option>";
			}
			//echo "<option>" .obtenerDia($fe). "</option>";
			mysqli_close($conexion);
		}
		
	?>
	<div class="contenedorGrande">
       <div class="mapita" id="mapita">
               <script type="text/JavaScript">
                   
                </script>
       </div>
	   <div id="formularioBoletos">
		<center>
			<h1><label>FECHA: <?php echo $fecha; ?></label></h1>
			<form method="post" action="infoBoletos.php">
				<fieldset>
			<legend align="center">Selecciona Los Datos Del Viaje</legend>
			<table class="tabla-poblacion">
				<tr><th width="170"><label>Poblacion De Partida:   </label></th>
					<td><?php poblaciones($origen); ?></td></tr>
                <tr><th width="170"><label>Poblacion de Destino:   </label></th>
					<td><?php poblaciones($destino); ?></td></tr>	
				<tr>
					<table>
					<tr><th><label>Horarios Disponibles</label></th>
						<td><select id="destino" class="textbox" name='destino' onChange='javascript:obtenerViaje(destino.value);'>
						<option hidden selected>Seleccione Horario</option>	
						<?php horariosDisponibles($origen,$destino,$fecha); ?>
						</select></td>
					</tr>
				</table>
				<br>
				</tr>
            </table>
			<div id ="detalles viaje" style='display:block;'>
				<table>
					<tr><th>Asientos Disponibles</th><th>Precio</th></tr>
					<tr><td><input class="textbox" type='text' readonly='true' id='asientos' name='asientos'></td>
						<td><input class="textbox" type='text' readonly='true' id='precio' name='precio'></td></tr>
				</table>
				
			</div>
				<script type="text/javascript">
					var origen = document.querySelector('#origen');
					var destino = document.querySelector('#destino');
					origen.addEventListener('change',calificar);
					destino.addEventListener('change',calificar);
					
					function calificar()
					{
						var valorO = origen.value;
						//alert(valorO);
						var valorD = destino.value;
						//alert(valorD);
						if(valorO == valorD)
						{
							alert("No se permite la misma ubicacion");
							mostrarMensaje(1);
						}
						else
							mostrarMensaje(0);
					}
					function mostrarMensaje(val)
					{
						if(val != 0)
							{
								document.getElementById("botoncitos").style.display = 'block';
							}
						else
							document.getElementById("botoncitos").style.display = 'none';
					}
				</script>
					</fieldset>	
			<div id="boleto">
				<?php
					for($x = 0;$x < $cantidad;$x++)
					{ 
						$claveb = $origen .$destino .date('m') .  date('Y') . date('d') .$x;
						$Foliob = 12309123123 + $x+1 * 12;
						$asientob = '0' . $x;
						include("boleto.php");
					}
				?>
			</div>
			<div id="botoncitos" >
				<input class="botones-input" type='submit' value='Proceder'>
				<input class="botones-input" type='reset' value='Cancelar'>
			</div>               
        </form>
		</center>
	</div>
	</div>

</body>
</html>