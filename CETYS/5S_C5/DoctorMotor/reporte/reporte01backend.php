<?php
    require_once('../configuracion.php');
    include_once('../MySqli_conexiondb.php'); 

    // Leer la acción y las fechas enviadas por el formulario
    $accion = $_POST['accion'];

    $fechaInicio = $_POST['fecha_inicio'];
    $fechaFin = $_POST['fecha_fin'];

    require_once(HEADERADMIN);
    if ($accion == "consultar") {

        // Validar formato de fechas en el servidor (seguridad adicional)
        if (!preg_match('/^\d{4}-\d{2}-\d{2}$/', $fechaInicio) || !preg_match('/^\d{4}-\d{2}-\d{2}$/', $fechaFin)) {
            echo "<center><h3 style='color: red;'>Formato de fecha inválido. Use AAAA-MM-DD.</h3></center>";
            return;
        }

        if ($fechaInicio > $fechaFin) {
            echo "<center><h3 style='color: red;'>La fecha de inicio no puede ser mayor que la fecha de fin.</h3></center>";
            return;
        }

        // Consulta SQL
        $query = "
            SELECT 
                vw.id_cliente,
                vw.nombre1,
                vw.nombre2,
                vw.apellido1,
                vw.apellido2,
                vw.correo,
                vw.telefono,
                COUNT(vw.id_cliente) AS cantidad_reparaciones
            FROM 
                vw_01_ClienteFrecuenciaReparacion vw
            WHERE 
                ? <= vw.fecha_entrada AND vw.fecha_salida <= ?
            GROUP BY 
                vw.id_cliente, vw.nombre1, vw.nombre2, vw.apellido1, vw.apellido2, vw.correo, vw.telefono
            ORDER BY 
                cantidad_reparaciones DESC
            LIMIT 1;
        ";

        // Preparar y ejecutar consulta
        $stmt = $conexion->prepare($query);
        if (!$stmt) {
            echo "<center><h3 style='color: red;'>Error al preparar la consulta: " . htmlspecialchars($conexion->error) . "</h3></center>";
            return;
        }

        $stmt->bind_param("ss", $fechaInicio, $fechaFin);
        $stmt->execute();
        $resultado = $stmt->get_result();

        // Verificar si se obtuvieron resultados
        if ($resultado->num_rows > 0) {
            $resultados = $resultado->fetch_all(MYSQLI_ASSOC);
            ?>
            <center>
                <!-- Tabla de resultados -->
                <table border="1" width="80%">
                    <TR>
                        <TH colspan="18">Lista de Clientes</TH>
                    </TR>
                        <tr>
                            <th>Nombre Completo</th>
                            <th>Correo</th>
                            <th>Teléfono</th>
                            <th>Cantidad de Reparaciones</th>
                            <th>Acción</th>
                        </tr>
                    <tbody>
                        <?php foreach ($resultados as $fila): ?>
                            <tr>
                                <td><?= htmlspecialchars($fila['apellido1']) ?> 
                                <?= htmlspecialchars($fila['apellido2']) ?>
                                <?= htmlspecialchars($fila['nombre1']) ?>
                                <?= htmlspecialchars($fila['nombre2']) ?></td>
                                <td><?= htmlspecialchars($fila['correo']) ?></td>
                                <td><?= htmlspecialchars($fila['telefono']) ?></td>
                                <td><?= htmlspecialchars($fila['cantidad_reparaciones']) ?></td>
                                <td> <A href="<?=ROOTURL?>?accion=reporte01"> Regresar </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </center>
            <?php
        } else { ?>
            <center>
		    <FORM style="width: 33%;">
			 <h3>No hay datos para fechas dadas</h3>
			 			 
			<input type="button" value="Intentar de nuevo" onclick=self.location="<?=ROOTURL?>?accion=reporte01" />
			</FORM>
		 </center>
            <?php 	}

        // Cerrar conexión
        $stmt->close();
        $conexion->close();

    } else {
        // Manejo de acción no válida
        ?>
            <center>
            <FORM style="width: 33%;">
                <h3>Opci&oacute;n incorrecta</h3>
                            
                <input type="button" value="Intentar de nuevo" onclick=self.location="<?=ROOTURL?>?accion=reporte01" />
                </FORM>
            </center>
        <?php
    }
?>  
<?php require_once(FOOTERADMIN); ?>