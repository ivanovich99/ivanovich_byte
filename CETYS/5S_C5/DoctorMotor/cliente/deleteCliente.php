<?php
	 include_once('MySqli_conexionDB.php'); 
	 $id_cliente = (isset($_GET['id_cliente']))?$_GET['id_cliente']:null;
	 $respuesta =  (isset($_GET['respuesta']))?$_GET['respuesta']:null;
	 
	 if(!$respuesta)
	 {
		 
 ?>
	 <center> <FORM style="width: 35%;">
		 <h3>¿Estás seguro de eliminar al cliente?</h3>
			
		 <input id="btnDeleteClienteSi" type = "button" value="S&iacute;"  onclick=self.location="<?=ROOTURL?>?accion=deleteCliente&id_cliente=<?=$id_cliente?>&respuesta=si" />
		 
		 <input id="btnDeleteClienteNo" type = "button" value="No" onclick=self.location="<?=ROOTURL?>?accion=listCliente" />
	 </center> </FORM>
	 
 <?php } ?>
 
 <?php
	 if(strtolower($respuesta)=="si")
	 {
		 //Estás sentencias son con los nombres de la tabla/archivo de la base de datos
		 //DELETE FROM nombreTabla WHERE NOMBRE campo=ValorBuscar
		 $query = "CALL `stp_deleteCliente`('$id_cliente')";
		 
		 $resultado = mysqli_query($conexion,$query);
		 
		 	 if(!$resultado)
			 {
			 ?>
                <!-- Este código se muestra cuando hay un error en la sentencia para eliminar un registro -->
				 <center>
				 <FORM>
					 <h3>Error al intentar eliminar al cliente</BR>
					 <?=mysqli_error($conexion)?></h3>
					 <input type= "button" value="Ir a lista de clientes" onclick=self.location="<?=ROOTURL?>?accion=listCliente" />
					</FORM>
				 </center>
	 <?php   } else
			 {
		 //Este codigo se ejecuta cuando no hay errores en la sentencia 
		 ?>
			 <center>
			 <FORM style="width: 33%;">
				 <h3>Cliente eliminado correctamente</h3>
				 <input type="button" value="Ir a lista de clientes" onclick=self.location="<?=ROOTURL?>?accion=listCliente" />
				</FORM>
			 </center>
	 <?php   }
	 }
 ?>