<HTML> 
<HEAD><title>HORARIOS DISPONIBLES</title> </HEAD>
	<link rel="stylesheet" type="text/css" href="estilo.css">
<BODY> 
 
    <?php
	include("menu.php");
            $d = $_POST["destino"];
            $o = $_POST["origen"];
            $fechaViaje = $_POST["fechaViaje"];
            $cont = 0;
			$host_db = "localhost";
			$usuario_db = "root";
			$pass_db ="";
			$conexion = mysqli_connect($host_db,$usuario_db,$pass_db);
			mysqli_select_db($conexion,"bitbus");
            $an = date('Y',strtotime($fechaViaje));
            $mes = date('m',strtotime($fechaViaje));
            $dia = date('d',strtotime($fechaViaje));
			echo '<div id = "tabla-consulta" class="pruebaFlex">';
            $nombreOrigen = mysqli_query($conexion,"select nombre from poblaciones where idPoblacion = $o");
            $fila1 = mysqli_fetch_row($nombreOrigen);
            $nombreDestino = mysqli_query($conexion,"select nombre from poblaciones where idPoblacion = $d");
            $fila2 = mysqli_fetch_row($nombreDestino);
			echo '<h2>HORARIOS DISPONIBLES DE: ' . strtoupper($fila1[0]) . " A: " . strtoupper($fila2[0]) .  '</h2>';
			echo '<h3 id="dia">Día</h3><h3 id="partida">Hora Partida</h3><h3 id="llegada">Hora Llegada (Estimada)</h3>';
			if($resultado = mysqli_query($conexion,"SELECT * FROM viajes where dia = $dia and mes = $mes and an = $an"))
			{
                while($fila = mysqli_fetch_row($resultado))
				{
                    $resultado2 = mysqli_query($conexion,"SELECT * FROM horario where idPoblacionO = $o and idPoblacionD = $d ");
                    while($fila2 = mysqli_fetch_row($resultado2))
                    {
                        if($fila2[0] === $fila[3])
                        {
                            if($cont == 0)
                                echo "<h4 id='r1'>$dia/$mes/$an</h4><h4 id='r2'>$fila2[3]</h4><h4 id='r3'>$fila2[7]</h4>";
                            else
                                echo "<h4 id='r1'> </h4><h4 id='r2'>$fila2[3]</h4><h4 id='r3'>$fila2[7]</h4>";
                            $cont++;
                            break;
                        }
                    }
				}
			}
			echo '</div><br><br><br><br>';
			mysqli_close($conexion);
	include("pie_pagina.html");
    ?>
    </BODY>
    </HTML>