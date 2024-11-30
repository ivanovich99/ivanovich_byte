<?php
    $id_cliente = $_GET['id_cliente'];
    $datosCliente = obtenerDatosCliente($id_cliente);

    // Obtener la fecha actual para validar fecha nacimiento
    $fecha_actual = date("Y-m-d");
    $fecha_min = date("Y-m-d", strtotime("-120 years", strtotime($fecha_actual)));
    $fecha_max = date("Y-m-d", strtotime("-18 years", strtotime($fecha_actual)));

    if ($datosCliente != null) {
?>
        <center>
            <form name="frmCliente" id="frmCliente" action="cliente/updateCliente.php" method="POST">
                <input type="hidden" name="accion" id="accion" value="updateCliente" />
                <input type="hidden" name="id_cliente" id="id_cliente" value="<?=$datosCliente['id_cliente']?>" />

                <h3>Modificar datos del cliente</h3> </br>
                
                <!-- Apellidos -->
                <label>↓ Apellido paterno y Apellido materno ↓</br>
                    <input type="text" name="apellido1" style="width: 45%;" title="Primer apellido" value="<?=$datosCliente['apellido1']?>" maxlength="20" />
                    <input type="text" name="apellido2" style="width: 45%;" title="Segundo apellido" value="<?=$datosCliente['apellido2']?>" maxlength="20" />
                </label></br>	
                
                <!-- Nombres -->
                <label>↓ Primer nombre y Segundo nombre ↓</br>
                    <input type="text" name="nombre1" style="width: 45%;" title="Primer nombre" value="<?=$datosCliente['nombre1']?>" maxlength="20" />
                    <input type="text" name="nombre2" style="width: 45%;" title="Segundo nombre" value="<?=$datosCliente['nombre2']?>" maxlength="20" />
                </label></br>

                <!-- Fecha de nacimiento -->
                <label>↓ Fecha de nacimiento (AAAA-MM-DD) ↓</br>
                    <input type="date" name="fecha_nacimiento" title="Fecha de nacimiento entre 18 y 120 años" value="<?=$datosCliente['fecha_nacimiento']?>" min="<?= $fecha_min ?>" max="<?= $fecha_max ?>" />
                </label></br>

                <!-- Correo y Teléfono -->
                <label>↓ Correo electrónico y Teléfono ↓</br>
                    <input type="email" name="correo" style="width: 45%;" title="Correo" value="<?=$datosCliente['correo']?>" maxlength="50" pattern="^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$" />
                    <input type="text" name="telefono" style="width: 45%;" title="Teléfono (10 dígitos)" value="<?=$datosCliente['telefono']?>" maxlength="10" pattern="\d{10}" />
                </label></br>

                <!-- Direcciones -->
                <label>↓ Calle de domicilio y Número de domicilio ↓</br>
                    <input type="text" name="direccion_calle" style="width: 45%;" title="Calle de domicilio" value="<?=$datosCliente['direccion_calle']?>" maxlength="15" />
                    <input type="text" name="direccion_numero" style="width: 45%;" title="Número de domicilio" value="<?=$datosCliente['direccion_numero']?>" maxlength="15" pattern="\d+" />
                </label></br>

                <label>↓ Colonia de domicilio y Código postal ↓</br>
                    <input type="text" name="direccion_colonia" style="width: 45%;" title="Colonia de domicilio" value="<?=$datosCliente['direccion_colonia']?>" maxlength="15" />
                    <input type="text" name="codigo_postal" style="width: 45%;" title="Código postal" value="<?=$datosCliente['codigo_postal']?>" maxlength="20" pattern="\d+" />
                </label></br>

                <!-- Ciudad y RFC -->
                <label>↓ Ciudad de domicilio y RFC ↓</br>
                    <input type="text" name="ciudad" style="width: 45%;" title="Ciudad de domicilio" value="<?=$datosCliente['ciudad']?>" maxlength="20" />
                    <input type="text" name="rfc_cliente" style="width: 45%;" title="RFC" value="<?=$datosCliente['rfc_cliente']?>" maxlength="20" />
                </label></br>
                
                <!-- Tipo de cliente -->
                <select name="id_tipo_cliente" id="id_tipo_cliente">
                    <option value="1" <?= ($datosCliente['id_tipo_cliente'] == 1) ? 'selected' : ''; ?>>Regular</option>
                    <option value="2" <?= ($datosCliente['id_tipo_cliente'] == 2) ? 'selected' : ''; ?>>Preferente</option>
                    <option value="3" <?= ($datosCliente['id_tipo_cliente'] == 3) ? 'selected' : ''; ?>>Público General</option>
                </select> </br></br>

                <input type="submit" name="btnActualizar" id="btnActualizar" value="Actualizar datos" />
            </form>
        </center>
<?php
    }
?>
