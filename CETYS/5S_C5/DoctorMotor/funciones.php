<?php
	// Este archivo será solo php
	function getListaCliente()
		{
		include_once('MySqli_conexionDB.php');

		$query = "SELECT * FROM cliente";

		$resultado = mysqli_query($conexion, $query);

		if(!$resultado)
		{
			exit(mysqli_error($conexion));
		}

		// un arreglo puede guardar datos de diferentes tipos
		// el arreglo no necesita declarar límite para guardar datos
		$lista = array();

		if(mysqli_num_rows($resultado)>0)
		{
			while($renglon = mysqli_fetch_assoc($resultado))
			{
				// Lo que está antes del "$renglon" es para un alias, fácil de ver
				$lista[] = array(
					'id_cliente' => $renglon['id_cliente'],
					'id_tipo_cliente' => $renglon['id_tipo_cliente'],
					'correo' => $renglon['correo'],
					'telefono' => $renglon['telefono'],
					'apellido1' => $renglon['apellido1'],
					'apellido2' => $renglon['apellido2'],
					'nombre1' => $renglon['nombre1'],
					'nombre2' => $renglon['nombre2'],
					'direccion_calle' => $renglon['direccion_calle'],
					'direccion_numero' => $renglon['direccion_numero'],
					'direccion_colonia' => $renglon['direccion_colonia'],
					'codigo_postal' => $renglon['codigo_postal'],
					'ciudad' => $renglon['ciudad'],
					'fecha_nacimiento' => $renglon['fecha_nacimiento'],
					'rfc_cliente' => $renglon['rfc_cliente'],
					'fecha_registro' => $renglon['fecha_registro']
				);
			}
		}
		return $lista;
	}

	function obtenerDatosCliente($id_cliente)
	{
		include('MySqli_conexiondb.php'); 

		//ESTA ES MI SENTENCIA DE CONSULTA CON UNA CONDICIÓN
		$query = "SELECT 
		id_cliente, 
		id_tipo_cliente, 
		correo, 
		telefono, 
		apellido1, 
		apellido2, 
		nombre1,
		nombre2, 
		direccion_calle, 
		direccion_numero, 
		direccion_colonia,
		codigo_postal, 
		ciudad,
		fecha_nacimiento,
		rfc_cliente,
		fecha_registro
		FROM cliente WHERE id_cliente=".$id_cliente;
		
		$resultado = mysqli_query($conexion,$query);
		
		if(!$resultado)
		{
			exit(mysqli_error($conexion));
		}
		
		$lista = array(); 
		
		if(mysqli_num_rows($resultado)>0)
		{
			while($renglon = mysqli_fetch_assoc($resultado))
			{				
				$lista = array(
					'id_cliente' => $renglon['id_cliente'],
					'id_tipo_cliente' => $renglon['id_tipo_cliente'],
					'correo' => $renglon['correo'],
					'telefono' => $renglon['telefono'],
					'apellido1' => $renglon['apellido1'],
					'apellido2' => $renglon['apellido2'],
					'nombre1' => $renglon['nombre1'],
					'nombre2' => $renglon['nombre2'],
					'direccion_calle' => $renglon['direccion_calle'],
					'direccion_numero' => $renglon['direccion_numero'],
					'direccion_colonia' => $renglon['direccion_colonia'],
					'codigo_postal' => $renglon['codigo_postal'],
					'ciudad' => $renglon['ciudad'],
					'fecha_nacimiento' => $renglon['fecha_nacimiento'],
					'rfc_cliente' => $renglon['rfc_cliente'],
					'fecha_registro' => $renglon['fecha_registro']
				);
			}
		}
		
		return $lista; 

		
	}
 ?>