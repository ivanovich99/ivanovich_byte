<?php
	// variables constantes globales, al inicio del index
	//define ('MICONSTANTEGLOBAL','Hola');
	// las variables constantes globales están en configuracion.php
	include_once('configuracion.php');

	// isset para verificar la existencia de una variable, con GET o POST
	// crear if, una línea de código (condición)?verdadero:falso
	// null = vacio o no tiene nada 
	$accion= (isset($_POST['accion']))?$_POST['accion']:null;
	$accion= (isset($_GET['accion']))?$_GET['accion']:$accion;
	
	// para concatenar en php es con "." Y abajo imprime que valor tiene la variable accion qu ees donde nos dirigira 
	// echo"accion tiene el valor de: ".$accion;
	
	// if(isset($_SESSION['user_session']))
	// {
		// Para verificar el ID del usuario que inició sesión 
		// print_r($_SESSION);
		
		// Este es el inicio de mi código de mi aplicación web
		include_once("header.php");
		
		switch($accion)
		{
			// INICIO ACCIONES REPORTES 
			case"listReporte":
				include_once("reporte/listReporte.php");
			break;
			
			case "reporte01":
				include_once("reporte/reporte01.php");
			break;
			
			case "reporte02":
				include_once("reporte/reporte02.php");
			break;
			
			case "reporte03":
				include_once("reporte/reporte03.php");
			break;
			
			case "reporte04":
				include_once("reporte/reporte04.php");
			break;
			
			case "reporte05":
				include_once("reporte/reporte05.php");
			break;
			
			case "reporte06":
				include_once("reporte/reporte06.php");
			break;
			
			case "reporte07":
				include_once("reporte/reporte07.php");
			break;
			
			case "reporte08":
				include_once("reporte/reporte08.php");
			break;
			
			case "reporte09":
				include_once("reporte/reporte09.php");
			break;
			
			case "reporte10":
				include_once("reporte/reporte10.php");
			break;
			
			case "reporte11":
				include_once("reporte/reporte11.php");
			break;
			
			case "reporte12":
				include_once("reporte/reporte12.php");
			break;
			
			case "reporte13":
				include_once("reporte/reporte13.php");
			break;
			
			case "reporte14":
				include_once("reporte/reporte14.php");
			break;
			
			case "reporte15":
				include_once("reporte/reporte15.php");
			break;
			
			case "reporte16":
				include_once("reporte/reporte16.php");
			break;
			
			case "reporte17":
				include_once("reporte/reporte17.php");
			break;
			
			case "reporte18":
				include_once("reporte/reporte18.php");
			break;
			
			case "reporte19":
				include_once("reporte/reporte19.php");
			break;
			
			case "reporte20":
				include_once("reporte/reporte20.php");
			break;
			
			case "reporte21":
				include_once("reporte/reporte21.php");
			break;
			
			case "reporte22":
				include_once("reporte/reporte22.php");
			break;
			
			case "reporte23":
				include_once("reporte/reporte23.php");
			break;
			
			case "reporte24":
				include_once("reporte/reporte24.php");
			break;
			
			case "reporte25":
				include_once("reporte/reporte25.php");
			break;
			
			case "reporte26":
				include_once("reporte/reporte26.php");
			break;
			
			case "reporte27":
				include_once("reporte/reporte27.php");
			break;
			
			case "reporte28":
				include_once("reporte/reporte28.php");
			break;
			
			case "reporte29":
				include_once("reporte/reporte29.php");
			break;
			
			case "reporte30":
				include_once("reporte/reporte30.php");
			break;

			//FIN ACCIONES REPORTE 
            // INICIO ACCIONES CLIENTE 
			case"listCliente":
				include_once("cliente/listCliente.php");
			break;
			
			case"addCliente":
                include_once("cliente/formAddCliente.php");
            break;
		
			case"editCliente":
                include_once("cliente/formEditCliente.php");
            break;

            case"deleteCliente":
                include_once("cliente/deleteCliente.php");
            break;

			// FIN ACCIONES CLIENTE 
            // INICIO ACCIONES  
            // FIN ACCIONES 

			default:
				// Este es el archivo de inicio de mi aplicación web
				include_once("home.php");
			break;
		}
		//Este es el pie de página de mi aplicación web
		include_once("footer.php");
	// } else 
	// {
	// 	include_once("Login/formLogin.php");
	// }
?>