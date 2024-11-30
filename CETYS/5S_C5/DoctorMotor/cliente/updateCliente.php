<?php
	 require_once('../configuracion.php');
	 include_once('../MySqli_conexiondb.php'); 
	 
	 $accion = $_POST['accion'];

	 $id_cliente = $_POST['id_cliente'];
	 $apellido1 = $_POST['apellido1'];
	 $apellido2 = $_POST['apellido2'];
	 $nombre1 = $_POST['nombre1'];
	 $nombre2= $_POST['nombre2'];
	 $fecha_nacimiento = $_POST['fecha_nacimiento']; 
	 $correo = $_POST['correo']; 
	 $telefono = $_POST['telefono']; 
	 $direccion_calle = $_POST['direccion_calle']; 
	 $direccion_numero= $_POST['direccion_numero']; 
	 $direccion_colonia = $_POST['direccion_colonia'];
	 $codigo_postal = $_POST['codigo_postal'];
	 $ciudad = $_POST['ciudad'];
	 $rfc_cliente = $_POST['rfc_cliente'];
	 $id_tipo_cliente = $_POST['id_tipo_cliente'];
	 
	 require_once(HEADERADMIN);
	 
	  if($accion=="updateCliente")
		 {
			# Llamada a procedimiento almacenado para actualizar cliente
		 $query = "CALL stp_updateCliente(
                $id_cliente,
				$id_tipo_cliente, 
				'$correo', 
				'$telefono', 
				'$apellido1', 
				'$apellido2', 
				'$nombre1', 
				'$nombre2', 
				'$direccion_calle', 
				'$direccion_numero', 
				'$direccion_colonia', 
				'$codigo_postal', 
				'$ciudad', 
				'$fecha_nacimiento', 
				'$rfc_cliente'
			)";
		 
		 $resultado = mysqli_query($conexion,$query);
		 
				 if(!$resultado)
				 {   ?>
			 
				 <center> <FORM>
					
					<h3>Error al intentar actualizar datos</BR>
					 <?=mysqli_error($conexion)?> </h3>
					  
		 
					 <br> <input type="button" value="Ir a lista de clientes" onclick=self.location="<?=ROOTURL?>?accion=listCliente" />
				 </center> </form>

 <?php 			 } else {?>
 
				 <center> <FORM>
					 
					 <h3>Datos del cliente actualizados</h3>
					 
					 
					 </br><input type="button" value="Ir a lista de clientes" onclick=self.location="<?=ROOTURL?>?accion=listCliente" />
				 
				 </center> </FORM>
				 
<?php 				 } ?>

<?php		} else { ?>
			 <center>
			 <FORM>
			 <h3>Opci&oacute;n incorrecta</h3>
			 
			 
			 <br> <input type="button" value="Ir a lista de clientes" onclick=self.location="<?=ROOTURL?>?accion=listCliente" />
			 </FORM>
		 </center>
		 
<?php		 } ?>
<?php require_once(FOOTERADMIN); ?>