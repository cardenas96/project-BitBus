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
	
	function mostrarHorario()
	{
		var origen = document.querySelector('#origen');
		var destino = document.querySelector('#destino');
		var dia = document.querySelector('#fechaHora');
		var valorO = origen.value;
		alert(valorO);
		var valorD = destino.value;
		alert(valorD);
		var valordia = dia.value;
		console.log(valorD);
		conexion = crearXMLHttpRequest(); 
        conexion.onreadystatechange = procesarHora;
        conexion.open('GET', 'cargarHorario.php?Origen=' + valorO +'&Destino=' + valorD+'&dia='+valordia, true); 
        conexion.send(null); 
	}
	
	function procesarHora()
	{
		if (conexion.readyState == 4)
			{
				var cadena = conexion.responseText;
				if(cadena != 0)
				{
					document.getElementById("Horarios").style.display = 'block';
					document.getElementById("ViajesD").style.display = 'none';
				}
				else
				{
					document.getElementById("ViajesD").style.display = 'block';
					document.getElementById("Horarios").style.display = 'none';
				}
				/*var texto = "";
			   //Recorremos los valores con un for each.
			   $.each(function(i,cadena){
				   texto += "<option value='"+i+"'>"+cadena+"</option>";
			   });         
			   //Agregamos en el id "idprovincia" el valor que tenga la variable texto. (todas las provincias).
			   $("#shorario").html(texto);*/
				/*var select = document.getElementById("hora"); //Seleccionamos el select
    			//separador = "?", // un espacio en blanco
    			//arregloHorarios = cadena.split(separador);	
				console.log(arregloHorarios);
				for(var i=0; i < cadena.length; i++)
				{ 
					if(arregloHorarios[i] != 'undefined')
						{
							var option = document.createElement("option"); //Creamos la opcion
							option.innerHTML = arregloHorarios[i]; //Metemos el texto en la opción
							select.appendChild(option); //Metemos la opción en el select
						}
    			}*/
			}
		else
			alert("ni Madres " + conexion.readyState);
	}
	
</script>
<head>
<meta charset="utf-8">
<title>Venta de Boletos</title>
	<link rel="stylesheet" type="text/css" href="estilo.css"> 
	<? include("menu.php");?>
</head>
<body>
	<div id="formulario">
		<center>
			<form method="post" action="HorarioBoleto.php">
				<fieldset>
			<legend align="center">Selecciona Los Datos Del Viaje</legend>
			<table class="tabla-poblacion">
				<tr><th><label>ORIGEN   </label></th>
				<td><select id="origen" class="textbox" name='origen'>
					<option hidden selected>Seleccione Origen</option>
				<?php poblaciones(); ?>
					</select></td>
					<td><label>         </label></td>
                <th><label>DESTINO   </label></th>
				<td><select id="destino" class="textbox" name='destino'>
					<option hidden selected>Seleccione Destino</option>					
				<?php poblaciones(); ?>
					</select></td></tr>							
				<table>
					<script type="text/javascript">
						document.getElementById('fechaViaje').value = new Date();
					</script>
						<tr><td><th><label>FECHA DE VIAJE   </label></th>
					</td><td><input id='fechaHora' type="date" class="textbox" name="fechaViaje" value="<?php echo date("Y-m-d"); ?>"></td>
				</tr>
				<tr>
					<td><th><label>CANTIDAD DE BOLETOS </label></th>
					<td><select id="cantidad" class="textbox" name='cantidad'>
						<option hidden selected>Seleccione Cantidad</option>	
						<option value="1">1</option>
						<option value="2">2</option>
						<option value="3">3</option>
						<option value="4">4</option>
						<option value="5">5</option>
						<option value="6">6</option>
						<option value="7">7</option>
						<option value="8">8</option>
						<option value="9">9</option>
						<option value="10">10</option>
						</select></td>
				</tr>
				</table>
				</table>
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
							//alert("No se permite la misma ubicacion");
							mostrarMensaje(1);
						}
						else
							mostrarMensaje(0);
					}
					function mostrarMensaje(val)
					{
						if(val != 0)
							{
								document.getElementById("mensaje").style.display = 'block';
								document.getElementById("botones-s").style.display = 'none';
							}
						else
							{
								document.getElementById("mensaje").style.display = 'none';
								document.getElementById("botones-s").style.display = 'block';
							}
					}
				</script>
			<br>
			<!--button class="botones-input" onClick="javascript: mostrarHorario;" >Buscar Viaje</button-->
			<div id="mensaje" style='display:none;'>
				<h2>Seleccione un Origen o destino diferente</h2>
			</div>

			<br>
			<div id="botones-s" style='display:none;'>
                <input class="botones-input" type='submit' value='Siguiente'>
				<input class="botones-input" type='reset' value='Limpiar'></div>
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
		</center>
	</div>
<?php 
	include("pie_pagina.html");
    ?>
</body>
</html>