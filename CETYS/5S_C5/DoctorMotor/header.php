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
	</HEAD>
	<!-- Funcionalidad desdde JS para footer actualizando constante la fecha y hora actual  -->
	<BODY onload="horaActual()">
		<div id = "header">	
		<center> 
			<H1 id="TituloPagina" style="margin:15px 0px 0px 10px"> Doctor </br> Motor </H1>
		 </center>
			<div id = "menu">	
				<UL>
					<!-- <LI>=Lista y <A>=Ancla para link -->
					<LI> <A href="."> Inicio </A> </LI>
					
					<LI> <A href="<?=ROOTURL?>?accion=listReporte"> Reportes </A> </LI>

					<LI> <A href="<?=ROOTURL?>?accion=listCliente"> Cliente </A>
						<Ul> 
							<LI> <A href="<?=ROOTURL?>?accion=addCliente"> Agregar Cliente </A></LI>
						</UL>
					</LI>

					
				</UL>
			</div>
		</div>