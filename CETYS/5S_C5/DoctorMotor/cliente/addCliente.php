<?php
	 //print_r($_POST);
	 //print_r($_GET);
	 
	 require_once('../configuracion.php');
	 include_once('../MySqli_conexiondb.php'); 
	 
	//  Leer nombre si ya presiono input o no
	 $accion = $_POST['accion'];

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
		 if($accion=="addCliente") 
		 {
			// Llamada al procedimiento almacenado con las variables directamente4
			$query = "CALL stp_addCliente(
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
			 
				 <center>
				 <FORM>
					 <h3>Error al intentar registrar el cliente</BR> <?=mysqli_error($conexion)?></h3>
					 				 
					 <input type="button" value="Intentar de nuevo" onclick=self.location="<?=ROOTURL?>?accion=addCliente" />
					</FORM>
				 </center>

<?php			 } else { ?>
	 
				 <center>
				 <FORM style="width: 33%;">
				 <h3>Cliente registrado</h3>
				 
				 
				 <input type="button" value="Ir a lista de clientes" onclick=self.location="<?=ROOTURL?>?accion=listCliente" />
				 </FORM>
				 </center>
<?php 				 } ?>
 
<?php	 } 
		else  
		{ ?>
		<!-- Por si  logra ingresar a este archivo pero el valor de la accion no es addCliente -->
		 <center>
		 <FORM style="width: 33%;">
			 <h3>Opci&oacute;n incorrecta</h3>
			 			 
			<input type="button" value="Intentar de nuevo" onclick=self.location="<?=ROOTURL?>?accion=addCliente" />
			</FORM>
		 </center>
		 
<?php 	 }   ?>
<?php require_once(FOOTERADMIN); ?>