<br>
<table id="formulario">
	<tr><th>Clave de Boleto: </th><td><input type="text" class="textbox" name="clave[]"value=<?php echo $claveb;?>></td>
		<th>Folio: </th><td><input type="text" class="textbox" name="folio[]"value=<?php echo $Foliob;?>></td></tr>
		<tr><th>Asiento:</th><td><select class="textboxAsientos" name='noAsiento[]' id='noAsientos'>
						<option hidden selected>Seleccione Asiento</option>	
						
						</select></td>
                    <th>Tipo:</th><td><select class="textbox" name='tipo[]' id='tipo'>
						<?php
                                $host_db="localhost"; 
                                $usuario_db="root"; 
                                $pass_db=""; 
                                $conexion=mysqli_connect($host_db,$usuario_db,$pass_db); 
                                mysqli_select_db($conexion,"bitbus");
                                $resultados = mysqli_query($conexion,"SELECT * FROM tipopasajero");
                                while($row = mysqli_fetch_row($resultados))
                                {
                                        echo "<option value='" .$row[0]."'>" . $row[1] . "</option>";      
                                }
                                mysqli_close($conexion);
                        ?>	
						
						</select></td></tr>
</table>
