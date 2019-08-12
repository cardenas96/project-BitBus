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
        
    function Grabar()
    {
      
            alert("jaosdhsl");
        /*
        conexion = crearXMLHttpRequest(); 
        conexion.onreadystatechange = inserta; 
        conexion.open('GET', 'insertarBoletos.php?v1=' + val1 + '&v2=' + val2 + '&v3=' + val3 + '&v4=' + val4 + '&v5=' + val5 + '&v6=' + val6 + '&v7=' + val7 + '&v8=' + val8, true); 
        conexion.send(null); */
    }
    
    function inserta()
    {
        if (conexion.readyState == 4)
            {
                vale = 2;
                //alert("SE REGISTRO LA VENTA DE LOS BOLETOS CORRECTAMENTE");
                //location.href='ventaBoletos.php';
            }
    }  
        
    function GrabarMensaje()
    {

                alert("SE REGISTRO LA VENTA DE LOS BOLETOS CORRECTAMENTE");
                location.href='ventaBoletos.php';
    }
	
	
</script>
<head>
<meta charset="utf-8">
<title>Información de los boletos</title>
	<link rel="stylesheet" type="text/css" href="estilo.css"> 
	<?php include("menu.html");?>
</head>
<body>
	<div id="formulario">
		<center>
            <fieldset>
			<legend align="center">Información de boletos</legend>
              <div class="infoBoletos">
               <?php
                    $clave = $_POST['clave'];
                    $destino = $_POST['destino'];
                    $folio = $_POST['folio'];
                    $asiento = $_POST['noAsiento'];
                    $tipo = $_POST['tipo'];
                    $host_db="localhost"; 
                    $usuario_db="root"; 
                    $pass_db=""; 
                    $conexion=mysqli_connect($host_db,$usuario_db,$pass_db); 
                    mysqli_select_db($conexion,"bitbus");
                    $resultadoPre = mysqli_query($conexion,"select * from viajes where idViaje = $destino");
                    $rowPre = mysqli_fetch_row($resultadoPre);
                    $resultado = mysqli_query($conexion,"select * from horario where idHorario = $rowPre[3]");
                    $row = mysqli_fetch_row($resultado);
                    $resultado2 = mysqli_query($conexion,"select nombre from poblaciones where idPoblacion = $row[1]");
                    $row2 = mysqli_fetch_row($resultado2);
                    $resultado3 = mysqli_query($conexion,"select nombre from poblaciones where idPoblacion = $row[2]");
                    $row3 = mysqli_fetch_row($resultado3);
                    $resultado4 = mysqli_query($conexion,"select marca,modelo from autobus where idAutobus =  $rowPre[1]");
                    $row4 = mysqli_fetch_row($resultado4);
                    $resultadoA = mysqli_query($conexion,"update viajes set AsientosDisponibles = AsientosDisponibles - ". count($clave) . " where idViaje = $destino");
                    $resultadoCuenta=mysqli_query($conexion,"select * from boletos");
                    $contador;
                    if (mysqli_num_rows($resultadoCuenta)>0)
                    {
                            $contador = mysqli_num_rows($resultadoCuenta) + 1;
                    } 
                    else
                    {
                            $contador = 1;
                     }
                    for($i = 0; $i < count($clave); $i++) 
                    {
                        $resultado5 = mysqli_query($conexion,"select * from tipopasajero where idTipo =  $tipo[$i]");
                        $row5 = mysqli_fetch_row($resultado5);
                        echo "<h5>CLAVE DEL BOLETO: $clave[$i]</h5>";
                        echo "<h5>FOLIO: $folio[$i]</h5>";
                        echo "<h5>FECHA: " . substr($clave[$i],8,2) . "/" . substr($clave[$i],2,2) . "/" . substr($clave[$i],4,2) . "</h5>";
                        echo "<h5>HORA: $row[3]</h5>";
                        echo "<h5>ORIGEN: ". strtoupper($row2[0]) ."</h5>";
                        echo "<h5>DESTINO: ". strtoupper($row3[0]) ."</h5>";
                        echo "<h5>AUTOBUS: $row4[0] $row4[1]</h5>";
                        echo "<h5>NO. ASIENTO: $asiento[$i]</h5>";
                        echo "<h5>TIPO DE BOLETO: " . strtoupper($row5[1]) . "</h5>";
                        echo "<h5 class='linea1'>IMPORTE DE BOLETO:  $$row[6]</h5>";
                        echo "<h5 class='linea1'>IVA($16%): $". ($row[6] * .16) . "</h5>";
                        echo "<h5 class='linea1'>SUBTOTAL: $". ($row[6] * 1.16) . "</h5>";
                        echo "<h5 class='linea1'>DESCUENTO: $" . ($row5[2] * ($row[6] * 1.16)) ."</h5>";
                        echo "<h5 class='linea1'>TOTAL A PAGAR: $" . (($row[6] * 1.16) + ($row5[2] * ($row[6] * 1.16)) )."</h5>";
                        echo "<h5 class='linea'>-------------------------------------------</h5>";
                        $resultadoDetalle = mysqli_query($conexion,"update detalleAsiento set estado = 1 where idViaje = $destino and noAsiento = $asiento[$i]");
                        $resultadoBoletos = mysqli_query($conexion,"insert into boletos values('$contador','$destino','$tipo[$i]','". substr($clave[$i],8,2) . "','" . substr($clave[$i],2,2) . "','". substr($clave[$i],4,2) . "','$folio[$i]','$asiento[$i]','$row[6]','" . ($row[6] * .16) . "','" . ($row5[2] * ($row[6] * 1.16)) ."','" . (($row[6] * 1.16) + ($row5[2] * ($row[6] * 1.16)) ) ."')");
                        $contador++;
                    }
                echo "</div>";
                echo "<div id='botoncitos' >";
				echo "<input class='botones-input' type='button' value='ACEPTAR' onclick='javascript: GrabarMensaje();'>";
			    echo "</div>";
            ?>
            </fieldset>
		</center>
	</div>
<?php 
	include("pie_pagina.html");
    ?>
</body>
</html>