<center> <form method="POST" name="frmReporte01" id="frmReporte01"  action="reporte/reporte01backend.php">
<h3>Reporte 1</h3>
    <h4>Mostrar la información del cliente con mayor frecuencia en reparaciones en un periodo de tiempo.</h4> 
    <input type="hidden" name="accion" id="accion" value="consultar" />
                 <!-- Fechas -->
                 <label>↓ Fecha de inicio y fin (AAAA-MM-DD) ↓</br>
                    <input type="date" id="fecha_inicio" name="fecha_inicio" style="width: 45%;" required />
                    <input type="date" id="fecha_fin" name="fecha_fin" style="width: 45%;" required />
                 </label></br>

                 <input type="submit" name="btnReporte" class="btnReporte" value="Consultar" />
</center></form>


<!-- Script para validar en el front-end -->
<script>
    document.getElementById('frmReporte01').addEventListener('submit', function (e) {
        // Obtener valores de los inputs
        const fecha_inicio = document.getElementById('fecha_inicio').value;
        const fecha_fin = document.getElementById('fecha_fin').value;

        // Validar que las fechas no estén vacías (HTML5 ya lo hace con 'required')
        if (!fecha_inicio || !fecha_fin) {
            alert('Ambas fechas son obligatorias.');
            e.preventDefault(); // Cancelar el envío del formulario
            return;
        }

        // Validar que la fecha de inicio no sea mayor a la de fin
        if (fecha_inicio > fecha_fin) {
            alert('La fecha de inicio no puede ser mayor que la fecha de fin.');
            e.preventDefault(); // Cancelar el envío del formulario
        }
    });
</script>