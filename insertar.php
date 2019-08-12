<?php 
    header('Content-Type: text/html; charset=ISO-8859-1');
                
    $v1 =$_GET['v1'];
   $v2 =$_GET['v2'];
   $v3 =$_GET['v3'];
   $v4 =$_GET['v4'];
   $v5 =$_GET['v5'];
   $v6 =$_GET['v6'];
   $v7 =$_GET['v7'];
   $v8 =$_GET['v8'];
                $host_db="localhost"; 
                $usuario_db="root"; 
                $pass_db=""; 
                $conexion=mysqli_connect($host_db,$usuario_db,$pass_db); 
                mysqli_select_db($conexion,"bitbus");
                $resultados = mysqli_query($conexion,"INSERT INTO VIAJES VALUES('$v1','$v2','$v3','$v4','$v5','$v6','$v7','$v8')");
                mysqli_close($conexion);
                //echo "<meta http-equiv='Refresh' content='5;URL=registraviaje.php'>";
   
?>
