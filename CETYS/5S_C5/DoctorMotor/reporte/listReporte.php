<!-- Tabla de Reportes -->
<TABLE border="1">
    <TR>
        <TH colspan="3">Lista de Reportes</TH>
    </TR>
    <TR>
        <TH># </TH>
        <TH>Descripción</TH>
        <TH>Acción</TH>
    </TR>

    <?php
    // Array de reportes para recorrer dinámicamente
    $reportes = [
        ["Información del cliente con mayor frecuencia en reparaciones que se le hayan atendido en un periodo de tiempo.", "reporte01"],
        ["Información de las promociones aplicadas en el departamento mecánico en un periodo de fechas específico.", "reporte02"],
        ["Información del inventario de refacciones que tiene cada producto registrado.", "reporte03"],
        ["Ventas obtenidas con respecto al servicio de sólo diagnósticos.", "reporte04"],
        ["Número de atenciones para cada departamento del taller en un rango de fechas.", "reporte05"],
        ["Ganancias obtenidas en un rango de fechas específico en base a un departamento en particular.", "reporte06"],
        ["Empleado que mayor ganancia obtuvo en un rango de fechas específico.", "reporte07"],
        ["Listado de supervisores y sus supervisados en base a un departamento específico.", "reporte08"],
        ["Clientes registrados junto con los automóviles que tienen registrados en el sistema.", "reporte09"],
        ["Reparaciones más concurrentes en base a un departamento específico.", "reporte10"],
        ["Departamento con el mayor consumo de refacciones en un periodo de fecha determinado.", "reporte11"],
        ["Promociones vigentes por un rango de fechas determinado.", "reporte12"],
        ["Garantías presentadas en los servicios y costos generados en un rango de fechas específico.", "reporte13"],
        ["Departamento con mayor afluencia de reparaciones en un rango de fechas determinado.", "reporte14"],
        ["Departamento con menor afluencia de reparaciones en un rango de fechas determinado.", "reporte15"],
        ["Consumo de refacciones clasificado por departamento.", "reporte16"],
        ["Ganancias obtenidas del taller por un rango de fechas determinado.", "reporte17"],
        ["Listado de empleados clasificados por departamentos.", "reporte18"],
        ["Características de los automóviles registrados en un periodo de tiempo determinado.", "reporte19"],
        ["Clientes que solo realizaron servicios de diagnóstico en un periodo de fecha determinado.", "reporte20"],
        ["Cliente con el mayor gasto en reparaciones realizado.", "reporte21"],
        ["Automóvil con el mayor gasto realizado en un periodo de tiempo determinado.", "reporte22"],
        ["Refacción más vendida del departamento de refacciones y ganancia generada.", "reporte23"],
        ["Departamento con mayor número de garantías aplicadas y costo acumulado.", "reporte24"],
        ["Cliente con mayor tiempo de no visitar el taller en un rango de fechas determinado.", "reporte25"],
        ["Promoción más aplicada en un rango de fechas determinado.", "reporte26"],
        ["Número de promociones vencidas en un rango de fechas determinado.", "reporte27"],
        ["Trabajador con mayor garantías aplicadas en los servicios realizados.", "reporte28"],
        ["Nombre del cliente y automóvil con mayor número de servicios aplicados en un periodo de fechas.", "reporte29"],
        ["Servicios con menores ganancias obtenidas en un periodo de fechas determinado.", "reporte30"],
    ];
    
    // Ciclo que recorrera el arreglo para desplegar los titulos de reportes 
    foreach ($reportes as $indice => $reporte) {
        $numero = $indice + 1;
        $descripcion = $reporte[0];
        $accion = $reporte[1];
        ?>
        <TR>
            <TD><?= $numero ?></TD>
            <TD><?= $descripcion ?></TD>
            <TD><A href="<?= ROOTURL ?>?accion=<?=$accion?>">Ingresar</A></TD>
        </TR>
    <?php } ?>
</TABLE>
