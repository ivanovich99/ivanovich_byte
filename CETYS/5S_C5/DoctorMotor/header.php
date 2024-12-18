<!DOCTYPE HTML>
<HTML>
	<HEAD>
		<META charset = "UTF-8">
		<META name = "description" content = "Proeycto Sistema de Bases de Datos ICC">
		<META name = "author" content = "Avila Chiu Oscar Ivanovich">
		<TITLE> Doctor Motor </TITLE>
		<LINK rel="shortcut icon" href="favicon.ico" type="image/x-icon">
		<link rel="stylesheet" type="text/css" href="<?=CSS?>menu.css" />	
		<link rel="stylesheet" type="text/css" href="<?=CSS?>general.css" />
		<link rel="stylesheet" type="text/css" href="<?=CSS?>producto.css" />
		<link rel="stylesheet" type="text/css" href="<?=CSS?>tablas.css" />
		
		<!-- Para poner bonita letra ;)) -->
		<link rel="preconnect" href="https://fonts.googleapis.com">
		<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
		<link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;600&display=swap" rel="stylesheet">

		<!-- Para fecha actual en footer  -->
		<script src="<?=JS?>fechaActual.js"></script>
		<script src="<?=JS?>validaciones.js"></script>
	</HEAD>
	<!-- Funcionalidad desdde JS para footer actualizando constante la fecha y hora actual  -->
	<BODY onload="horaActual()">
		<div id = "header">	
		<center> 
			<H1 id="TituloPagina" style="margin:33px 20px"> Doctor </br> Motor </H1>
		 </center>
			<div id = "menu">	
				<UL>
					<!-- <LI>=Lista y <A>=Ancla para link -->
					<LI> <A href="<?=ROOTURL?>"> Inicio </A> </LI>
					
					<LI> <A href="<?=ROOTURL?>?accion=listReporte"> Reporte </A> </LI>

					<LI> <A href="<?=ROOTURL?>?accion=listCliente"> Cliente </A>
						<Ul> 
							<LI> <A href="<?=ROOTURL?>?accion=addCliente"> Agregar Cliente </A></LI>
						</UL>
					</LI>
					
					<LI> <A href="<?=ROOTURL?>?accion=listVehiculo"> Vehículo </A>
						<Ul> 
							<LI> <A href="<?=ROOTURL?>?accion=filterAddVehiculo"> Agregar Vehículo </A></LI>
						</UL>
					</LI>
					
					<LI> <A href="<?=ROOTURL?>?accion=listDepartamento"> Departamento </A>
						<Ul> 
							<LI> <A href="<?=ROOTURL?>?accion=addDepartamento"> Agregar Departamento</A></LI>
						</UL>
					</LI>
					
					<LI> <A href="<?=ROOTURL?>?accion=listEmpleado"> Empleado </A>
						<Ul> 
							<LI> <A href="<?=ROOTURL?>?accion=addEmpleado"> Agregar Empleado </A></LI>
						</UL>
					</LI>

					<LI> <A href="<?=ROOTURL?>?accion=listCatalogo"> Catalogo </A>
						<Ul> 
							<LI> <A href="<?=ROOTURL?>?accion=addCatalogo"> Agregar Catalogo </A></LI>
						</UL>
					</LI>


					<LI> <A href="<?=ROOTURL?>?accion=listDetalleGarantia"> Detalle </br> Garantia </A>
						<Ul> 
							<LI> <A href="<?=ROOTURL?>?accion=addDetalleGarantia"> Agregar Detalle Garantia </A></LI>
						</UL>
					</LI>
					
					<LI> <A href="<?=ROOTURL?>?accion=listDetalleInventario"> Detalle </br>Inventario </A>
						<Ul> 
							<LI> <A href="<?=ROOTURL?>?accion=addDetalleInventario"> Agregar Detalle Inventario </A></LI>
						</UL>
					</LI>

					<LI> <A href="<?=ROOTURL?>?accion=listDetallesManoObra"> Detalles </br> Mano Obra </A>
						<Ul> 	
							<LI> <A href="<?=ROOTURL?>?accion=addDetallesManoObra"> Agregar DetallesManoObra</A></LI>
						</UL>
					</LI>
					
					<LI> <A href="<?=ROOTURL?>?accion=listFactura"> Factura  </A>
					</LI>
					
					<LI> <A href="<?=ROOTURL?>?accion=listInventario"> Inventario </A>
					</LI>
					
					<LI> <A href="<?=ROOTURL?>?accion=listManoObra"> Mano obra </A>
					</LI>
					
					<LI> <A href="<?=ROOTURL?>?accion=listPromocion"> Promocion  </A>
					</LI>
					
					<LI> <A href="<?=ROOTURL?>?accion=listServicio"> Servicio </A>
					</LI>
					<LI> <A href="<?=ROOTURL?>?accion=listVenta"> Venta  </A>
					</LI>
				</UL>
			</div>
		</div>