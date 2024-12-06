<?php
	// nombre de página web
	if($_SERVER['SERVER_NAME']=='localhost' || $_SERVER['SERVER_NAME']== '127.0.0.1')
	{
		define('MICONSTANTEGLOBAL',' Hola');
		
		define ('ROOTURL', 'http://localhost/doctorMotor/');
		define ('AUTOR','Avila Chiu Oscar Ivanovich - García Morales David Alexandro');
		define ('DOCROOT', $_SERVER['DOCUMENT_ROOT'].'/doctorMotor/');
		define ('SITENAME','Doctor Motor');

		define ('IMAGES', ROOTURL.'images/');
		define ('CSS', ROOTURL.'css/');
		define ('JS', ROOTURL.'js/');
		
		define ('DBHOST', 'localhost');//nombre de nuestro servidor, administrador de bases de datos
		
		//nombre de usuario para accesar
		// define ('DBUSER', 'administrador_doctor_motor'); 
		define ('DBUSER', 'analista_de_datos_doctor_motor'); 
		// define ('DBUSER', 'analista_doctor_motor'); 
		// define ('DBUSER', 'root');

		//es la contraseña para accesar a la base de datos
		// define ('DBPASSWD', 'AdminD0cM0t0r'); 
		define ('DBPASSWD', 'An4list4D4t05D0cM0t0r'); 
		// define ('DBPASSWD', 'An4list4D0cM0t0r');
		// define ('DBPASSWD', '#Basesdedatos9');

		define ('DBNAME', 'taller_mecanico'); // Nombre base de datos 
		define ('DBPORT', '3306'); // Nombre base de datos 

		define('HEADERADMIN', DOCROOT. 'header.php');
		define('FOOTERADMIN', DOCROOT. 'footer.php');
	}
	include_once('funciones.php');
	session_start(); // Se indica que se utilizarán variables de tipo sesión o cookies 
?>