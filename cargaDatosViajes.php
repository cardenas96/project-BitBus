<?php
header('Content-Type: text/html; charset=ISO-8859-1');         
                $idv = $_GET['idViaje'];
                $host_db="localhost"; 
                $usuario_db="root"; 
                $pass_db=""; 
                $conexion=mysqli_connect($host_db,$usuario_db,$pass_db); 
                mysqli_select_db($conexion,"bitbus");
				$resultados = mysqli_query($conexion,"SELECT v.idViaje,p.nombre,po.nombre,h.hora,v.dia,v.AsientosDisponibles,h.precioBoleto FROM viajes v 
				INNER JOIN horario h ON v.idHorario = h.idHorario
				INNER JOIN POBLACIONES p ON h.idPoblacionO = p.idPoblacion
				INNER JOIN POBLACIONES po ON h.idPoblacionD = po.idPoblacion
				WHERE idViaje = $idv");
				$Disponible = 0;
				while($fila = mysqli_fetch_array($resultados))
				{

						$filas = $fila[5]. '?' . $fila[6];
				}
				echo $filas;

?>