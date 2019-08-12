<?php 
    header('Content-Type: text/html; charset=ISO-8859-1');
                
                $idChofer = $_GET['idChofer'];
                $host_db="localhost"; 
                $usuario_db="root"; 
                $pass_db=""; 
                $conexion=mysqli_connect($host_db,$usuario_db,$pass_db); 
                mysqli_select_db($conexion,"bitbus");
                $resultados = mysqli_query($conexion,"select * from choferes where idChofer = $idChofer");
                if($row = mysqli_fetch_array($resultados))
                {
                      echo $row[3] . "¿" . $row[5];
                }
                else
                {
                    echo "";
                }
   
?>
