<?php 
    header('Content-Type: text/html; charset=ISO-8859-1');
                $idAutobus = $_GET['idAutobus'];
                $host_db="localhost"; 
                $usuario_db="root"; 
                $pass_db=""; 
                $conexion=mysqli_connect($host_db,$usuario_db,$pass_db); 
                mysqli_select_db($conexion,"bitbus");
                $resultados = mysqli_query($conexion,"select * from autobus where idAutobus = $idAutobus");
                if($row = mysqli_fetch_array($resultados))
                {
                      echo $row[1] . "¿" . $row[3];
                }
                else
                {
                    echo "";
                }   
?>