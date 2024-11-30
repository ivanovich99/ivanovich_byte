
<?php
// Obtener la fecha actual para validar fecha nacimiento 
$fecha_actual = date("Y-m-d");
$fecha_min = date("Y-m-d", strtotime("-120 years", strtotime($fecha_actual)));
$fecha_max = date("Y-m-d", strtotime("-18 years", strtotime($fecha_actual)));
?>

<center> 
    <form name="frmCliente" id="frmCliente" action="cliente/addCliente.php" method="POST">
        <input type="hidden" name="accion" id="accion" value="addCliente" />

        <h3>Registro de cliente</h3></br>

        <!-- Apellidos -->
        <input type="text" name="apellido1" style="width: 45%;" placeholder="Escribe primer apellido" title="Primer apellido" required maxlength="20" /> 
        <input type="text" name="apellido2" style="width: 45%;" placeholder="Escribe segundo apellido" title="Segundo apellido" maxlength="20" /></br> 

        <!-- Nombres -->
        <input type="text" name="nombre1" style="width: 45%;" placeholder="Escribe primer nombre" title="Primer nombre" required maxlength="20" /> 
        <input type="text" name="nombre2" style="width: 45%;" placeholder="Escribe segundo nombre" title="Segundo nombre" maxlength="20" /></br>

		<!-- Fecha de nacimiento con rango de 18 a 120 años -->
		<input type="date" name="fecha_nacimiento" placeholder="Escribe fecha nacimiento AAAA-MM-DD" min="<?= $fecha_min ?>" max="<?= $fecha_max ?>" title="Fecha de nacimiento entre 18 y 120 años" required /></br>
        <!-- Correo -->
        <input type="email" name="correo" style="width: 45%;" placeholder="Escribe tu correo" title="Correo" required maxlength="50" pattern="^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$" />

        <!-- Teléfono -->
        <input type="text" name="telefono" style="width: 45%;" placeholder="Escribe tu telefono" title="Telefono (10)" required maxlength="10" pattern="\d{10}" />

        <!-- Direcciones -->
        <input type="text" name="direccion_calle" style="width: 45%;" placeholder="Escribe tu calle de domicilio" title="Calle de domicilio" required maxlength="15" />
        <input type="text" name="direccion_numero" style="width: 45%;" placeholder="Escribe tu numero de domicilio" title="Numero de domicilio" required maxlength="15" pattern="\d+" />

        <input type="text" name="direccion_colonia" style="width: 45%;" placeholder="Escribe colonia de domicilio" title="Colonia de domicilio" maxlength="15" />
        
        <!-- Código Postal -->
        <input type="text" name="codigo_postal" style="width: 45%;" placeholder="Escribe tu codigo postal" title="Codigo postal" required maxlength="20" pattern="\d+" />

        <!-- Ciudad -->
        <input type="text" name="ciudad" style="width: 45%;" placeholder="Escribe ciudad de domicilio" title="Ciudad de domicilio" required maxlength="20" />

        <!-- RFC -->
        <input type="text" name="rfc_cliente" style="width: 45%;" placeholder="Escribe rfc" title="RFC" required maxlength="20" />

        <!-- Tipo de cliente -->
        <select name="id_tipo_cliente" required>
            <option value="">Selecciona tipo del cliente</option>
            <option value="1">Regular</option>
            <option value="2">Preferente</option>
            <option value="3">Publico General</option>
        </select></br></br>

        <input type="submit" name="btnRegistrar" id="btnRegistrar" value="Registrar cliente" />
    </form>
</center>
