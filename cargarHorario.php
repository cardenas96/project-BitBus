<?php
header('Content-Type: text/html; charset=ISO-8859-1');
                
                $Origen = $_GET['Origen'];
				$Destino = $_GET['Destino'];
				$dia = $_GET['Dia'];
                $host_db="localhost"; 
                $usuario_db="root"; 
                $pass_db=""; 
                $conexion=mysqli_connect($host_db,$usuario_db,$pass_db); 
                mysqli_select_db($conexion,"bitbus");
				$resultados = mysqli_query($conexion,"SELECT v.idViaje,p.nombre,po.nombre,h.hora,v.dia,v.Asientos,h.precioBoleto FROM VIAJES v 
				INNER JOIN HORARIO h ON v.idHorario = h.idHorario
				INNER JOIN POBLACIONES p ON h.idPoblacionO = p.idPoblacion
				INNER JOIN POBLACIONES po ON h.idPoblacionD = po.idPoblacion
				WHERE h.idPoblacionO = $Origen AND h.idPoblacionD = $Destino AND h.dia = WEEKDAY('$dia') ");
				//"Seleccione Hora";
				$Disponible = 0;
				while($fila = mysqli_fetch_array($resultados))
				{
					if($fila != null)
						$Disponible = 1;
				}
				echo $Disponible;

?>