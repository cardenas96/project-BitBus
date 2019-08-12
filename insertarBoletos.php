<?php
    $host_db="localhost"; 
    $usuario_db="root"; 
    $pass_db=""; 
    $conexion=mysqli_connect($host_db,$usuario_db,$pass_db); 
    mysqli_select_db($conexion,"bitbus");
?>