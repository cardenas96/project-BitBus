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
    
    function mostrarOcultar(val)
    {
        if(val != 0)
            {
                document.getElementById("choferbus").style.display = 'block';
            }
        else
            document.getElementById("choferbus").style.display = 'none';
    }
    
     function mostrarBus(val)
    {
                                                       
                        conexion = crearXMLHttpRequest(); 
                        conexion.onreadystatechange = procesarBus; 
                        conexion.open('GET', 'cargarBusAjax.php?idAutobus=' + val, true); 
                        conexion.send(null); 
    }
    
    function procesarBus()
    {
        
        if (conexion.readyState == 4)
            {
                var cadena = conexion.responseText;
                document.getElementById("capacidad").value = cadena.slice(cadena.indexOf("¿")+1);
                //document.getElementById("foto").value = cadena.slice(cadena.indexOf("¿")+1).replace(/;/g,"\\");
                document.getElementById("marca").value = cadena.slice(0,cadena.indexOf("¿")-1);
                
            }

    }
    
    function Grabar(val1,val2,val3,val4,val5,val6,val7,val8)
    {

        conexion = crearXMLHttpRequest(); 
        conexion.onreadystatechange = inserta; 
        conexion.open('GET', 'insertar.php?v1=' + val1 + '&v2=' + val2 + '&v3=' + val3 + '&v4=' + val4 + '&v5=' + val5 + '&v6=' + val6 + '&v7=' + val7 + '&v8=' + val8, true); 
        conexion.send(null); 
    }
    
    function inserta()
    {
        if (conexion.readyState == 4)
            {
                alert("SE REGISTRO EL VIAJE CORRECTAMENTE");
                location.href='registraviaje.php';
            }
    }   
    
    function mostrarChofer(val)
    {
                                                       
                        conexion = crearXMLHttpRequest(); 
                        conexion.onreadystatechange = procesarChofer; 
                        conexion.open('GET', 'cargarChoferAjax.php?idChofer=' + val, true);  
                        conexion.send(null); 
    }
    
    function procesarChofer()
    {
        
        if (conexion.readyState == 4)
            {
                var cadena = conexion.responseText;
                var foto = cadena.slice(cadena.indexOf("¿")+1);
                document.getElementById("foto").src = "imagenes\\" + foto.slice(foto.lastIndexOf(";") + 1);
                //document.getElementById("foto").value = cadena.slice(cadena.indexOf("¿")+1).replace(/;/g,"\\");
                document.getElementById("telefono").value = cadena.slice(0,cadena.indexOf("¿")-1);
                
            }

    }
    
    function consultar(valor) 
    { 
       // alert("no mames");
        // alert(valor);
        conexion = crearXMLHttpRequest(); 
        conexion.onreadystatechange = procesarEventos; 
        conexion.open('GET', 'cargarAsientos.php?autobus=' + valor, true); 
        conexion.send(null); 
    }
    
    function procesarEventos() 
    {
        var detalles = document.getElementById("asientos"); 
        if(conexion.readyState== 4) //respuesta = 4 Completo //0=Sin iniciar, 1= Cargando, 2=Cargando,3=Descargando 
        { 
            detalles.innerHTML= conexion.responseText;
        } 
        else 
        { 
            detalles.innerHTML= 'Cargando...'; 
        } 
    } 
    
</script>

    


<HTML> 
<HEAD> <title>Registro de Viajes</title>
	<link rel="stylesheet" type="text/css" href="estilo.css"></HEAD> 
<BODY> 
    <?php 
	include("menu.php");
    $fechaViaje = $_POST['fechaViaje'];
    $origen = $_POST['origen'];
    $destino = $_POST['destino'];
	?>
	<center>
		<div id="formularioViajes">
			<form method="post" action="insertaViaje">
			
			<fieldset class="bordear-fiel2">
			<legend align="center">Selecciona Horario</legend>
			<table>
			<tr>
			<td>
			<table >
				<tr><th><label>FECHA DE VIAJE:</label></th><th><?php echo $fechaViaje; ?></th></tr>
                <tr><th><label>ORIGEN:</label></th><th>  
                   <?php
                    $host_db="localhost"; 
                    $usuario_db="root"; 
                    $pass_db=""; 
                    $conexion=mysqli_connect($host_db,$usuario_db,$pass_db); 
                    mysqli_select_db($conexion,"bitbus");
                    $resultados=mysqli_query($conexion,"select nombre from poblaciones where idPoblacion = $origen");
                    while($row = mysqli_fetch_array($resultados))
                    {
                        echo $row[0];
                    }
                    mysqli_close($conexion);
                    //echo $origen; 
                    ?>         </th></tr>
                <tr><th><label>DESTINO:</label></th><th>   
                <?php 
                     $host_db="localhost"; 
                    $usuario_db="root"; 
                    $pass_db=""; 
                    $conexion=mysqli_connect($host_db,$usuario_db,$pass_db); 
                    mysqli_select_db($conexion,"bitbus");
                    $resultados=mysqli_query($conexion,"select nombre from poblaciones where idPoblacion = $destino");
                    while($row = mysqli_fetch_array($resultados))
                    {
                        echo $row[0];
                    }
                    mysqli_close($conexion);
                    //echo $origen;  
                ?> </th></tr>
            </table>
            </td>
            <td>
            <table class='segunda' id='registraViaje'>
                <tr style="{width: 700px;}"><th><label>HORARIOS DISPONIBLES   </label></th>
				<td><select class="textbox" name='horario' onchange='javascript: mostrarOcultar(horario.value);'>
				<?php 
                    $host_db="localhost"; 
                    $usuario_db="root"; 
                    $pass_db=""; 
                    $conexion=mysqli_connect($host_db,$usuario_db,$pass_db); 
                    mysqli_select_db($conexion,"bitbus");
                    $resultados=mysqli_query($conexion,"select * from horario where idPoblacionO = '$origen' and idPoblacionD = '$destino' and dia = WEEKDAY('$fechaViaje') + 1");
                    echo "<option value='0'>" . "Elige un horario..." . "</option>";
                    while($row = mysqli_fetch_array($resultados))
                    {
                        echo "<option value='" .$row[0]."'>" . $row[3] . "</option>";
                    }
                    mysqli_close($conexion);
                ?>
				</select>
				</td>
				</tr>     
            </table>
            </td>
            </tr>
            </table>
			</fieldset>
  
           <div id="choferbus" style='display:none;'>
           <fieldset class="bordear-fiel">
			<legend align="center">Selecciona Chofer Y Autobus</legend>
			<table class='tercera'>
			<tr>
			<td>
			<table >
				<tr><th><label>CHOFER   </label></th>
				<td><select class="textbox" name='chofer' id='chofer' onchange="javascript: mostrarChofer(chofer.value);" >
'>
				<?php choferes(); ?>
				</select></td>
				</tr>
                <tr><th><label>FOTO   </label></th>
                <td><img id='foto' width="50px" height="50px"></td>
                </tr>
                <tr><th><label>TELEFONO   </label></th>
                <td><input class='textbox' type='text' id='telefono' readonly='true'></td>
                </tr>;
            </table>
            </td>
            <td>
            <table class='segunda'>
				<tr><th><label>AUTOBUS   </label></th>
				<td><select class="textbox" name='autobus' id='autobus' onchange="javascript: mostrarBus(autobus.value);">
				<?php autobuses(); ?>
				</select></td>
				<tr><th><label>MARCA   </label></th>
				<td><input class="textbox" type='text' readonly='true' id='marca' name='marca'></td></tr>
				<tr><th><label>CAPACIDAD   </label></th>
				<td><input class="textbox" type='text' readonly='true' id='capacidad' name='capacidad'></td></tr>
            </table>
            </td>
            </tr>
            </table>
            <?php
               $host_db="localhost"; 
                $usuario_db="root"; 
                $pass_db=""; 
                $conexion=mysqli_connect($host_db,$usuario_db,$pass_db); 
                mysqli_select_db($conexion,"bitbus");
                $resultados=mysqli_query($conexion,"select * from viajes");
                $contador;
                if (mysqli_num_rows($resultados)>0)
                {
                    $contador = mysqli_num_rows($resultados) + 1;
                } 
                else
                {
                    $contador = 1;
                }
               $an = date('Y',strtotime($fechaViaje));
               $mes = date('m',strtotime($fechaViaje));
               $dia = date('d',strtotime($fechaViaje));
               echo "<input class='botones-input' type='button' value='Guardar' onclick='javascript: Grabar($contador,autobus.value,chofer.value,horario.value,capacidad.value,$dia,$mes,$an);' > ";
            ?>
				<input class="botones-input" type='reset' value='Limpiar'>
			</fieldset>	
            <?php 
               function choferes()
                {
                    $host_db="localhost"; 
                    $usuario_db="root"; 
                    $pass_db=""; 
                    $conexion=mysqli_connect($host_db,$usuario_db,$pass_db); 
                    mysqli_select_db($conexion,"bitbus");
                    $resultados=mysqli_query($conexion,"select * from choferes");
                   echo "<option value='0'>" . "Selecciona..." . "</option>";
                    while($row = mysqli_fetch_array($resultados))
                    {
                        echo "<option value='" .$row[0]."'>" . $row[1] . "</option>";
                    }
                    mysqli_close($conexion);
                }
               function autobuses()
                   {
                        $host_db="localhost"; 
                        $usuario_db="root"; 
                        $pass_db=""; 
                        $conexion=mysqli_connect($host_db,$usuario_db,$pass_db); 
                        mysqli_select_db($conexion,"bitbus");
                        $resultados = mysqli_query($conexion,"select * from autobus");
                        echo "<option value='0'>" . "Selecciona..." . "</option>";
                        while($row = mysqli_fetch_array($resultados))
                        {
                            echo "<option value='" .$row[0]."'>" . $row[2] . "</option>";
                        }
                        mysqli_close($conexion);
                   }
            ?>
           </div>
				
			</form>
			
		</div>
		<div id='resultado' style='display:none;'>
            
		</div>
		<br><br><br><br><br><br><br><br>
	</center>            
    <?php

	include("pie_pagina.html");
    ?>
    </BODY>
    </HTML>