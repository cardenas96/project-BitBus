                <?php
                    $idViaje = $_GET['idViaje'];
                    $host_db="localhost"; 
                    $usuario_db="root"; 
                    $pass_db=""; 
                    $conexion=mysqli_connect($host_db,$usuario_db,$pass_db); 
                    mysqli_select_db($conexion,"bitbus");
                    $resultados=mysqli_query($conexion,"select * from detalleasiento where idViaje = $idViaje"); 
                    while($row = mysqli_fetch_row($resultados))
                    {
                        if($row[2] == 0)
                            echo "<option value='" .$row[1]."'>" . $row[1] . "</option>";
                    }
                    mysqli_close($conexion);
                ?>