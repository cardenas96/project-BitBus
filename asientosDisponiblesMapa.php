                <?php
                    $idViaje = $_GET['idViaje'];
                    $host_db="localhost"; 
                    $usuario_db="root"; 
                    $pass_db=""; 
                    $conexion=mysqli_connect($host_db,$usuario_db,$pass_db); 
                    mysqli_select_db($conexion,"bitbus");
                    $resultados=mysqli_query($conexion,"select a.capacidad from Autobus a inner join viajes v on a.idAutobus = v.idAutobus where idviaje = $idViaje"); 
                    echo "<h2>ASIENTOS DISPONIBLES</h2>";
                    $row = mysqli_fetch_array($resultados);
                    $i=0;
                    $espacio=1;
                    $resultados2=mysqli_query($conexion,"select estado from detalleasiento where idViaje = $idViaje");
                    $total = (ceil($row[0] * 1.2) + 1);
                    $noas = 1;
                    while($i <= $total)
                    {
                        if($espacio != 3)
                        {
                            $row2 = mysqli_fetch_array($resultados2);
                            if($row2[0] == 0 )
                            {
                                echo "<img src='imagenes/asiento.png'>";
                            }
                            else
                            {
                                echo "<img src='imagenes/asientoOcupado2.png'>";
                            }
                            if($espacio == 5)
                            {
                                $espacio = 0;
                                echo "<a>" . $noas++ ."</a>";
                                echo "<a>" . $noas++ ."</a>";
                                echo "<a>   </a>";
                                echo "<a>" . $noas++ ."</a>";
                                echo "<a>" . $noas++ ."</a>";
                            }
                        }
                        else
                        {
                            echo "<img>";
                        }
                        $espacio++;
                        $i++;
                    }

                    //CORREGIR PARA CUANDO HAY 1,2 O 3 EN UNA FILA NADA MAS
                    if($espacio > 1)
                    {
                        for($z=$espacio;$z < 6;$z++)
                            echo "<a>   </a>";
                        for($x=$noas - 1;$x < (($total - 1)/1.2);$x++)
                        {
                            echo "<a>" . ++$x ."</a>";
                        }
                    }
                    mysqli_close($conexion);
                ?>