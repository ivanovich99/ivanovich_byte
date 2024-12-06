<?php
	// INICIO FUNCION GENERALES 
	function obtenerDepartamentos($conexion) 
	{
		// Consulta para obtener productos
		$query = "SELECT id_departamento, nombre_departamento FROM departamento ORDER BY nombre_departamento";
		$result = $conexion->query($query);
	
		if (!$result) {
			die("Error en la consulta: " . $conexion->error);
		}
	
		// Generar las opciones de la lista desplegable
		$opciones = "";
		while ($row = $result->fetch_assoc()) {
			$opciones .= "<option value='{$row['id_departamento']}'>{$row['nombre_departamento']}</option>";
		}
	
		return $opciones;
	}

	function obtenerEmpleados($conexion) 
	{
		// Consulta para obtener empleados
		$query = "SELECT id_empleado, nombre1, apellido1 FROM empleado ORDER BY nombre1, apellido1";
		$result = $conexion->query($query);

		if (!$result) {
			die("Error en la consulta: " . $conexion->error);
		}

		// Generar las opciones de la lista desplegable
		$opciones = "";
		while ($row = $result->fetch_assoc()) {
			$opciones .= "<option value='{$row['id_empleado']}'>{$row['nombre1']} {$row['apellido1']}</option>";
		}

		return $opciones;
	}

	function obtenerServicios($conexion) 
	{
		// Consulta para obtener productos
		$query = "SELECT id_servicio FROM servicio ORDER BY id_servicio";
		$result = $conexion->query($query);
	
		if (!$result) {
			die("Error en la consulta: " . $conexion->error);
		}
	
		// Generar las opciones de la lista desplegable
		$opciones = "";
		while ($row = $result->fetch_assoc()) {
			$opciones .= "<option value='{$row['id_servicio']}'>{$row['id_servicio']}</option>";
		}
	
		return $opciones;
	}

	function obtenerInventarios($conexion) 
	{
		// Consulta para obtener productos
		$query = "SELECT id_catalogo, descripcion, costo FROM catalogo ORDER BY id_catalogo";
		$result = $conexion->query($query);
	
		if (!$result) {
			die("Error en la consulta: " . $conexion->error);
		}
	
		// Generar las opciones de la lista desplegable
		$opciones = "";
		while ($row = $result->fetch_assoc()) {
			$opciones .= "<option value='{$row['id_catalogo']}'> {$row['descripcion']} </option>";
		}
	
		return $opciones;
	}

	function obtenerManoObra($conexion) 
	{
		// Consulta para obtener productos
		$query = "SELECT id_mano_obra, descripcion FROM mano_obra ORDER BY id_mano_obra";
		$result = $conexion->query($query);
	
		if (!$result) {
			die("Error en la consulta: " . $conexion->error);
		}
	
		// Generar las opciones de la lista desplegable
		$opciones = "";
		while ($row = $result->fetch_assoc()) {
			$opciones .= "<option value='{$row['id_mano_obra']}'> {$row['descripcion']} </option>";
		}
	
		return $opciones;
	}

	function obtenerClientes($conexion) 
	{
		// Consulta para obtener productos
		$query = "SELECT id_cliente, nombre1, apellido1 FROM cliente ORDER BY nombre1";
		$result = $conexion->query($query);
	
		if (!$result) {
			die("Error en la consulta: " . $conexion->error);
		}
	
		// Generar las opciones de la lista desplegable
		$opciones = "";
		while ($row = $result->fetch_assoc()) {
			$opciones .= "<option value='{$row['id_cliente']}'> {$row['nombre1']} {$row['apellido1']} </option>";
		}
	
		return $opciones;
	}function obtenerVentas($conexion) 
	{
		// Consulta para obtener productos
		$query = "SELECT id_venta, total FROM venta ORDER BY id_venta";
		$result = $conexion->query($query);
	
		if (!$result) {
			die("Error en la consulta: " . $conexion->error);
		}
	
		// Generar las opciones de la lista desplegable
		$opciones = "";
		while ($row = $result->fetch_assoc()) {
			$opciones .= "<option value='{$row['id_venta']}'> {$row['total']} </option>";
		}
	
		return $opciones;
	}
	// FIN FUNCION GENERALES 
	
	// INICIO FUNCIONES CLIENTE
	class Cliente {
		private $apellido1;
		private $apellido2;
		private $nombre1;
		private $nombre2;
		private $fechaNacimiento;
		private $correo;
		private $telefono;
		private $direccionCalle;
		private $direccionNumero;
		private $direccionColonia;
		private $codigoPostal;
		private $ciudad;
		private $rfcCliente;
		private $idTipoCliente;

		// Constructor
		public function __construct($apellido1, $apellido2, $nombre1, $nombre2, $fechaNacimiento, $correo, $telefono, $direccionCalle, $direccionNumero, $direccionColonia, $codigoPostal, $ciudad, $rfcCliente, $idTipoCliente) {
			$this->apellido1 = $apellido1;
			$this->apellido2 = $apellido2;
			$this->nombre1 = $nombre1;
			$this->nombre2 = $nombre2;
			$this->fechaNacimiento = $fechaNacimiento;
			$this->correo = $correo;
			$this->telefono = $telefono;
			$this->direccionCalle = $direccionCalle;
			$this->direccionNumero = $direccionNumero;
			$this->direccionColonia = $direccionColonia;
			$this->codigoPostal = $codigoPostal;
			$this->ciudad = $ciudad;
			$this->rfcCliente = $rfcCliente;
			$this->idTipoCliente = $idTipoCliente;
		}

		// Método para registrar el cliente en la base de datos
		public function registrarCliente($conexion) {
			$query = "CALL stp_addCliente(
				'$this->idTipoCliente',
				'$this->correo',
				'$this->telefono',
				'$this->apellido1',
				'$this->apellido2',
				'$this->nombre1',
				'$this->nombre2',
				'$this->direccionCalle',
				'$this->direccionNumero',
				'$this->direccionColonia',
				'$this->codigoPostal',
				'$this->ciudad',
				'$this->fechaNacimiento',
				'$this->rfcCliente'
			)";

			return mysqli_query($conexion, $query);
		}
	}


	function obtenerListaCliente()
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
	// FIN FUNCIONES CLIENTE

	// FUNCIONES VEHICULOS 
	function obtenerListaVehiculo() 
	{
		include_once('MySqli_conexionDB.php');
	
		$query = "SELECT 
                v.id_vehiculo, 
                v.id_cliente, 
                v.marca, 
                v.modelo, 
                v.anio_vehiculo, 
                v.color, 
                v.placas, 
                v.vin_vehiculo, 
                v.fecha_registro, 
                c.nombre1, 
                c.nombre2, 
                c.apellido1, 
                c.apellido2 
              FROM vehiculo v
              JOIN cliente c ON v.id_cliente = c.id_cliente";
	
		$resultado = mysqli_query($conexion, $query);
	
		if (!$resultado) {
			exit(mysqli_error($conexion));
		}
	
		// Lista de vehículos
		$lista = array();
	
		if (mysqli_num_rows($resultado) > 0) {
			while ($renglon = mysqli_fetch_assoc($resultado)) {
				$lista[] = array(
					'id_vehiculo' => $renglon['id_vehiculo'],
					'id_cliente' => $renglon['id_cliente'],
					'nombre_cliente' => $renglon['nombre1'] . ' ' . $renglon['nombre2'] . ' ' . $renglon['apellido1'] . ' ' . $renglon['apellido2'],
					'marca' => $renglon['marca'],
					'modelo' => $renglon['modelo'],
					'anio_vehiculo' => $renglon['anio_vehiculo'],
					'color' => $renglon['color'],
					'placas' => $renglon['placas'],
					'vin_vehiculo' => $renglon['vin_vehiculo'],
					'fecha_registro' => $renglon['fecha_registro']
				);
			}
		}
	
		return $lista;
	}
	
	function obtenerDatosVehiculo($id_vehiculo) 
	{
		include('MySqli_conexiondb.php');
	
		$query = "SELECT 
					id_vehiculo, 
					id_cliente, 
					anio_vehiculo, 
					marca, 
					modelo, 
					color, 
					placas, 
					vin_vehiculo, 
					fecha_registro 
				  FROM vehiculo 
				  WHERE id_vehiculo = " . intval($id_vehiculo);
	
		$resultado = mysqli_query($conexion, $query);
	
		if (!$resultado) {
			exit(mysqli_error($conexion));
		}
	
		$lista = array();
	
		if (mysqli_num_rows($resultado) > 0) {
			while ($renglon = mysqli_fetch_assoc($resultado)) {
				$lista = array(
					'id_vehiculo' => $renglon['id_vehiculo'],
					'id_cliente' => $renglon['id_cliente'],
					'anio_vehiculo' => $renglon['anio_vehiculo'],
					'marca' => $renglon['marca'],
					'modelo' => $renglon['modelo'],
					'color' => $renglon['color'],
					'placas' => $renglon['placas'],
					'vin_vehiculo' => $renglon['vin_vehiculo'],
					'fecha_registro' => $renglon['fecha_registro']
				);
			}
		}
	
		return $lista;
	}
	// FIN FUNCIONES VEHICULOS 
	// INICIO FUNCIONES DEPARTAMENTO 
	function obtenerListaDepartamento() 
	{
		include_once('MySqli_conexionDB.php');

		$query = "SELECT 
					d.id_departamento, 
					d.nombre_departamento, 
					d.id_supervisor, 
					e.nombre1, 
					e.nombre2, 
					e.apellido1, 
					e.apellido2 
				FROM departamento d
				LEFT JOIN empleado e ON d.id_supervisor = e.id_empleado";

		$resultado = mysqli_query($conexion, $query);

		if (!$resultado) {
			exit(mysqli_error($conexion));
		}

		// Lista de departamentos
		$lista = array();

		if (mysqli_num_rows($resultado) > 0) {
			while ($renglon = mysqli_fetch_assoc($resultado)) {
				$lista[] = array(
					'id_departamento' => $renglon['id_departamento'],
					'nombre_departamento' => $renglon['nombre_departamento'],
					'id_supervisor' => $renglon['id_supervisor'],
					'nombre_supervisor' => $renglon['nombre1'] . ' ' . $renglon['nombre2'] . ' ' . $renglon['apellido1'] . ' ' . $renglon['apellido2']
				);
			}
		}

		return $lista;
	}

	function obtenerDatosDepartamento($id_departamento) 
	{
		include('MySqli_conexionDB.php');

		$query = "SELECT 
					d.id_departamento, 
					d.nombre_departamento, 
					d.id_supervisor, 
					e.nombre1, 
					e.nombre2, 
					e.apellido1, 
					e.apellido2 
				FROM departamento d
				LEFT JOIN empleado e ON d.id_supervisor = e.id_empleado
				WHERE d.id_departamento = " . intval($id_departamento);

		$resultado = mysqli_query($conexion, $query);

		if (!$resultado) {
			exit(mysqli_error($conexion));
		}

		$lista = array();

		if (mysqli_num_rows($resultado) > 0) {
			while ($renglon = mysqli_fetch_assoc($resultado)) {
				$lista = array(
					'id_departamento' => $renglon['id_departamento'],
					'nombre_departamento' => $renglon['nombre_departamento'],
					'id_supervisor' => $renglon['id_supervisor'],
					'nombre_supervisor' => $renglon['nombre1'] . ' ' . $renglon['nombre2'] . ' ' . $renglon['apellido1'] . ' ' . $renglon['apellido2']
				);
			}
		}

		return $lista;
	}
	// FIN FUNCIONES DEPARTAMENTO
	// INICIO FUNCIONES EMPLEADO 
	function obtenerListaEmpleado() 
	{
		include_once('MySqli_conexionDB.php');

		$query = "SELECT 
            e.id_empleado, 
            e.id_departamento, 
            e.id_supervisor, 
            e.correo, 
            e.telefono, 
            e.apellido1, 
            e.apellido2, 
            e.nombre1, 
            e.nombre2, 
            e.direccion_calle, 
            e.direccion_numero, 
            e.direccion_colonia, 
            e.codigo_postal, 
            e.ciudad, 
            e.fecha_nacimiento, 
            e.sueldo, 
            e.fecha_ingreso, 
            d.nombre_departamento, 
            CONCAT(s.nombre1, ' ', s.nombre2, ' ', s.apellido1, ' ', s.apellido2) AS nombre_supervisor
          FROM empleado e
          LEFT JOIN departamento d ON e.id_departamento = d.id_departamento
          LEFT JOIN empleado s ON e.id_supervisor = s.id_empleado";

			$resultado = mysqli_query($conexion, $query);

			if (!$resultado) {
				exit(mysqli_error($conexion));
			}

			// Lista de empleados
			$lista = array();

			if (mysqli_num_rows($resultado) > 0) {
				while ($renglon = mysqli_fetch_assoc($resultado)) {
					$lista[] = array(
						'id_empleado' => $renglon['id_empleado'],
						'id_departamento' => $renglon['id_departamento'],
						'id_supervisor' => $renglon['id_supervisor'],
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
						'sueldo' => $renglon['sueldo'],
						'fecha_ingreso' => $renglon['fecha_ingreso'],
						'nombre_departamento' => $renglon['nombre_departamento'],
						'nombre_supervisor' => $renglon['nombre_supervisor']
					);
				}
			}


		return $lista;
	}

	function obtenerDatosEmpleado($id_empleado) 
	{
		include('MySqli_conexionDB.php');

		$query = "SELECT * FROM empleado WHERE id_empleado = " . intval($id_empleado);

		$resultado = mysqli_query($conexion, $query);

		if (!$resultado) {
			exit(mysqli_error($conexion));
		}

		$lista = array();

		if (mysqli_num_rows($resultado) > 0) {
			while ($renglon = mysqli_fetch_assoc($resultado)) {
				$lista = array(
					'id_empleado' => $renglon['id_empleado'],
					'id_departamento' => $renglon['id_departamento'],
					'id_supervisor' => $renglon['id_supervisor'],
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
					'sueldo' => $renglon['sueldo'],
					'fecha_ingreso' => $renglon['fecha_ingreso']	
				);
			}
		}

		return $lista;
	}
	// FIN FUNCIONES EMPLEADO 
	// INICIO FUNCIONES CATALOGO 
	function obtenerListaCatalogo() 
	{
		include_once('MySqli_conexionDB.php');

		$query = "SELECT 
            c.id_catalogo, 
            c.descripcion, 
            c.id_departamento, 
            c.costo, 
            d.nombre_departamento
          FROM catalogo c
          LEFT JOIN departamento d ON c.id_departamento = d.id_departamento";

		$resultado = mysqli_query($conexion, $query);

		if (!$resultado) {
			exit(mysqli_error($conexion));
		}

		// Lista de catálogo
		$lista = array();

		if (mysqli_num_rows($resultado) > 0) {
		while ($renglon = mysqli_fetch_assoc($resultado)) {
			$lista[] = array(
				'id_catalogo' => $renglon['id_catalogo'],
				'descripcion' => $renglon['descripcion'],
				'id_departamento' => $renglon['id_departamento'],
				'costo' => $renglon['costo'],
				'nombre_departamento' => $renglon['nombre_departamento']
			);
			}
		}


		return $lista;
	}

	function obtenerDatosCatalogo($id_catalogo) 
	{
		include('MySqli_conexionDB.php');

		$query = "SELECT * FROM catalogo WHERE id_catalogo = " . intval($id_catalogo);

		$resultado = mysqli_query($conexion, $query);

		if (!$resultado) {
			exit(mysqli_error($conexion));
		}

		$lista = array();

		if (mysqli_num_rows($resultado) > 0) {
			while ($renglon = mysqli_fetch_assoc($resultado)) {
				$lista = array(
					'id_catalogo' => $renglon['id_catalogo'],
					'descripcion' => $renglon['descripcion'],
					'id_departamento' => $renglon['id_departamento'],
					'costo' => $renglon['costo']
				);
			}
		}

		return $lista;
	}
	//FIN FUNCIONES CATALOGO 

	// INICIO FUNCIONES DETALLE GARANTIA
function obtenerListaDetalleGarantia() 
{
    include_once('MySqli_conexionDB.php');

    $query = "SELECT 
                dg.id_detalle_garantia, 
                dg.procede, 
                dg.descripcion, 
                dg.resolucion, 
                dg.id_empleado, 
                dg.fecha_seguimiento,
                e.nombre1 AS nombre_empleado, 
                e.nombre2 AS nombre_empleado2, 
                e.apellido1 AS apellido_empleado, 
                e.apellido2 AS apellido_empleado2
              FROM detalle_garantia dg
              LEFT JOIN empleado e ON dg.id_empleado = e.id_empleado";

    $resultado = mysqli_query($conexion, $query);

    if (!$resultado) {
        exit(mysqli_error($conexion));
    }

    // Lista de detalles de garantía
    $lista = array();

    if (mysqli_num_rows($resultado) > 0) {
        while ($renglon = mysqli_fetch_assoc($resultado)) {
            $lista[] = array(
                'id_detalle_garantia' => $renglon['id_detalle_garantia'],
                'procede' => $renglon['procede'],
                'descripcion' => $renglon['descripcion'],
                'resolucion' => $renglon['resolucion'],
                'id_empleado' => $renglon['id_empleado'],
                'fecha_seguimiento' => $renglon['fecha_seguimiento'],
                'nombre_empleado' => $renglon['nombre_empleado'] . ' ' . $renglon['nombre_empleado2'] . ' ' . $renglon['apellido_empleado'] . ' ' . $renglon['apellido_empleado2']
            );
        }
    }

    return $lista;
}

// INICIO FUNCION DETALLE GARANTIA
function obtenerDatosDetalleGarantia($id_detalle_garantia) 
{
    include('MySqli_conexionDB.php');

    $query = "SELECT 
                dg.id_detalle_garantia, 
                dg.procede, 
                dg.descripcion, 
                dg.resolucion, 
                dg.id_empleado, 
                dg.fecha_seguimiento,
                e.nombre1 AS nombre_empleado, 
                e.nombre2 AS nombre_empleado2, 
                e.apellido1 AS apellido_empleado, 
                e.apellido2 AS apellido_empleado2
              FROM detalle_garantia dg
              LEFT JOIN empleado e ON dg.id_empleado = e.id_empleado
              WHERE dg.id_detalle_garantia = " . intval($id_detalle_garantia);

    $resultado = mysqli_query($conexion, $query);

    if (!$resultado) {
        exit(mysqli_error($conexion));
    }

    $lista = array();

    if (mysqli_num_rows($resultado) > 0) {
        while ($renglon = mysqli_fetch_assoc($resultado)) {
            $lista = array(
                'id_detalle_garantia' => $renglon['id_detalle_garantia'],
                'procede' => $renglon['procede'],
                'descripcion' => $renglon['descripcion'],
                'resolucion' => $renglon['resolucion'],
                'id_empleado' => $renglon['id_empleado'],
                'fecha_seguimiento' => $renglon['fecha_seguimiento'],
                'nombre_empleado' => $renglon['nombre_empleado'] . ' ' . $renglon['nombre_empleado2'] . ' ' . $renglon['apellido_empleado'] . ' ' . $renglon['apellido_empleado2']
            );
        }
    }

    return $lista;
}
	// FIN FUNCIONES detalle_garantia
	// INICIO FUNCIONES DETALLE INVENTARIO 
	// INICIO FUNCIONES INVENTARIO
function obtenerListaDetalleInventario() 
{
    include_once('MySqli_conexionDB.php');

    $query = "SELECT 
                di.id_inventario, 
                di.id_servicio, 
                di.descuento, 
                di.cantidad
            FROM detalle_inventario di";

    $resultado = mysqli_query($conexion, $query);

    if (!$resultado) {
        exit(mysqli_error($conexion));
    }

    // Lista de inventario
    $lista = array();

    if (mysqli_num_rows($resultado) > 0) {
        while ($renglon = mysqli_fetch_assoc($resultado)) {
            $lista[] = array(
                'id_inventario' => $renglon['id_inventario'],
                'id_servicio' => $renglon['id_servicio'],
                'descuento' => $renglon['descuento'],
                'cantidad' => $renglon['cantidad'],
            );
        }
    }

    return $lista;
}

// INICIO FUNCION INVENTARIO
function obtenerDatosDetalleInventario($id_inventario) 
{
    include('MySqli_conexionDB.php');

    $query = "SELECT 
               di.id_inventario, 
                di.id_servicio, 
                di.descuento, 
                di.cantidad
            FROM detalle_inventario di
              WHERE di.id_inventario = " . intval($id_inventario);

    $resultado = mysqli_query($conexion, $query);

    if (!$resultado) {
        exit(mysqli_error($conexion));
    }

    $lista = array();

    if (mysqli_num_rows($resultado) > 0) {
        while ($renglon = mysqli_fetch_assoc($resultado)) {
            $lista = array(
                'id_inventario' => $renglon['id_inventario'],
                'id_servicio' => $renglon['id_servicio'],
                'descuento' => $renglon['descuento'],
                'cantidad' => $renglon['cantidad']
			);
        }
    }

    return $lista;
}

	// FIN  FUNCIONES DETALLE INVENTARIO 

	// INICIO FUNCIONES DETALLES MANO OBRA
function obtenerListaDetallesManoObra() 
{
    include_once('MySqli_conexionDB.php');

    $query = "SELECT 
                dmo.id_mano_obra, 
                dmo.descuento, 
                dmo.id_servicio, 
                mo.descripcion AS descripcion_mano_obra
              FROM detalles_mano_obra dmo
              LEFT JOIN mano_obra mo ON dmo.id_mano_obra = mo.id_mano_obra;";

    $resultado = mysqli_query($conexion, $query);

    if (!$resultado) {
        exit(mysqli_error($conexion));
    }

    // Lista de detalles de mano de obra
    $lista = array();

    if (mysqli_num_rows($resultado) > 0) {
        while ($renglon = mysqli_fetch_assoc($resultado)) {
            $lista[] = array(
                'id_mano_obra' => $renglon['id_mano_obra'],
                'descuento' => $renglon['descuento'],
                'id_servicio' => $renglon['id_servicio'],
                'descripcion_mano_obra' => $renglon['descripcion_mano_obra']
			);
        }
    }

    return $lista;
}

function obtenerDatosDetallesManoObra($id_mano_obra) 
{
    include('MySqli_conexionDB.php');

    $query = "SELECT 
                dmo.id_mano_obra, 
                dmo.descuento, 
                dmo.id_servicio, 
                mo.descripcion AS descripcion_mano_obra
              FROM detalles_mano_obra dmo
              LEFT JOIN mano_obra mo ON dmo.id_mano_obra = mo.id_mano_obra
              WHERE dmo.id_mano_obra = " . intval($id_mano_obra);

    $resultado = mysqli_query($conexion, $query);

    if (!$resultado) {
        exit(mysqli_error($conexion));
    }

    $lista = array();

    if (mysqli_num_rows($resultado) > 0) {
        while ($renglon = mysqli_fetch_assoc($resultado)) {
            $lista = array(
                'id_mano_obra' => $renglon['id_mano_obra'],
                'descuento' => $renglon['descuento'],
                'id_servicio' => $renglon['id_servicio'],
                'descripcion_mano_obra' => $renglon['descripcion_mano_obra']
			);
        }
    }

    return $lista;
}
	// FIN  FUNCIONES DETALLES MANO OBRA

	// INICIO FUNCIONES FACTURA
// INICIO FUNCIONES FACTURA
function obtenerListaFactura() 
{
    include_once('MySqli_conexionDB.php');

    $query = "SELECT 
                f.id_factura, 
                f.id_venta, 
                f.id_cliente, 
                c.nombre1 AS nombre_cliente, 
                c.apellido1 AS apellido_cliente, 
                v.fecha_venta AS fecha_venta, 
                v.total AS total_venta
              FROM factura f
              LEFT JOIN cliente c ON f.id_cliente = c.id_cliente
              LEFT JOIN venta v ON f.id_venta = v.id_venta";

    $resultado = mysqli_query($conexion, $query);

    if (!$resultado) {
        exit(mysqli_error($conexion));
    }

    // Lista de facturas
    $lista = array();

    if (mysqli_num_rows($resultado) > 0) {
        while ($renglon = mysqli_fetch_assoc($resultado)) {
            $lista[] = array(
                'id_factura' => $renglon['id_factura'],
                'id_venta' => $renglon['id_venta'],
                'id_cliente' => $renglon['id_cliente'],
                'nombre_cliente' => $renglon['nombre_cliente'] . ' ' . $renglon['apellido_cliente'],
                'fecha_venta' => $renglon['fecha_venta'],
                'total_venta' => $renglon['total_venta']
            );
        }
    }

    return $lista;
}

function obtenerDatosFactura($id_factura) 
{
    include('MySqli_conexionDB.php');

    $query = "SELECT 
                f.id_factura, 
                f.id_venta, 
                f.id_cliente, 
                c.nombre1 AS nombre_cliente, 
                c.apellido1 AS apellido_cliente, 
                v.fecha_venta AS fecha_venta, 
                v.total AS total_venta
              FROM factura f
              LEFT JOIN cliente c ON f.id_cliente = c.id_cliente
              LEFT JOIN venta v ON f.id_venta = v.id_venta
              WHERE f.id_factura = " . intval($id_factura);

    $resultado = mysqli_query($conexion, $query);

    if (!$resultado) {
        exit(mysqli_error($conexion));
    }

    $datos = array();

    if (mysqli_num_rows($resultado) > 0) {
        while ($renglon = mysqli_fetch_assoc($resultado)) {
            $datos = array(
                'id_factura' => $renglon['id_factura'],
                'id_venta' => $renglon['id_venta'],
                'id_cliente' => $renglon['id_cliente'],
                'nombre_cliente' => $renglon['nombre_cliente'] . ' ' . $renglon['apellido_cliente'],
                'fecha_venta' => $renglon['fecha_venta'],
                'total_venta' => $renglon['total_venta']
            );
        }
    }

    return $datos;
}
	// FIN FUNCIONES FACTURA

	// INICIO FUNCIONES INVENTARIO 
	function obtenerListaInventario() 
	{
		include_once('MySqli_conexionDB.php');

		$query = "SELECT 
					i.id_catalogo, 
					i.cantidad_min, 
					i.cantidad_max, 
					i.cantidad, 
					c.descripcion AS nombre_catalogo
				FROM inventario i
				LEFT JOIN catalogo c ON i.id_catalogo = c.id_catalogo";

		$resultado = mysqli_query($conexion, $query);

		if (!$resultado) {
			exit(mysqli_error($conexion));
		}

		// Lista de inventario
		$lista = array();

		if (mysqli_num_rows($resultado) > 0) {
			while ($renglon = mysqli_fetch_assoc($resultado)) {
				$lista[] = array(
					'id_catalogo' => $renglon['id_catalogo'],
					'cantidad_min' => $renglon['cantidad_min'],
					'cantidad_max' => $renglon['cantidad_max'],
					'cantidad' => $renglon['cantidad'],
					'nombre_catalogo' => $renglon['nombre_catalogo']
				);
			}
		}

		return $lista;
	}

	// FIN  FUNCIONES INVENTARIO

	// INICIO FUNCIONES MANOOBRA
	function obtenerListaManoObra() 
	{
		include_once('MySqli_conexionDB.php');

		$query = "SELECT 
					mo.id_mano_obra, 
					mo.descripcion, 
					mo.id_departamento, 
					mo.costo, 
					mo.tiempo_garantia, 
					d.nombre_departamento AS nombre_departamento
				FROM mano_obra mo
				LEFT JOIN departamento d ON mo.id_departamento = d.id_departamento";

		$resultado = mysqli_query($conexion, $query);

		if (!$resultado) {
			exit(mysqli_error($conexion));
		}

		// Lista de mano de obra
		$lista = array();

		if (mysqli_num_rows($resultado) > 0) {
			while ($renglon = mysqli_fetch_assoc($resultado)) {
				$lista[] = array(
					'id_mano_obra' => $renglon['id_mano_obra'],
					'descripcion' => $renglon['descripcion'],
					'id_departamento' => $renglon['id_departamento'],
					'costo' => $renglon['costo'],
					'tiempo_garantia' => $renglon['tiempo_garantia'],
					'nombre_departamento' => $renglon['nombre_departamento']
				);
			}
		}

		return $lista;
	}
	// FIN FUNCIONES MANO OBRA

	// INICIO FUNCIONES PROMOCION 
	function obtenerListaPromocion() 
	{
		include_once('MySqli_conexionDB.php');

		$query = "SELECT 
            p.id_promocion, 
            p.id_tipo_cliente, 
            p.fecha_inicio, 
            p.fecha_fin, 
            p.nombre, 
            p.descuento, 
            tc.estatus_cliente
          FROM promocion p
          LEFT JOIN tipo_cliente tc ON p.id_tipo_cliente = tc.id_tipo_cliente";


		$resultado = mysqli_query($conexion, $query);

		if (!$resultado) {
			exit(mysqli_error($conexion));
		}

		// Lista de promociones
		$lista = array();

		if (mysqli_num_rows($resultado) > 0) {
			while ($renglon = mysqli_fetch_assoc($resultado)) {
				$lista[] = array(
					'id_promocion' => $renglon['id_promocion'],
					'id_tipo_cliente' => $renglon['id_tipo_cliente'],
					'fecha_inicio' => $renglon['fecha_inicio'],
					'fecha_fin' => $renglon['fecha_fin'],
					'nombre' => $renglon['nombre'],
					'descuento' => $renglon['descuento'],
					'estatus_cliente' => isset($renglon['estatus_cliente']) ? $renglon['estatus_cliente'] : 'No disponible' // Si no existe, asigna un valor predeterminado
				);
			}

		}

		return $lista;
	}

	// FIN FUNCIONES PROMOCION 

	// INICIO FUNCIONES SERVICIO 
	function obtenerListaServicio() 
	{
		include_once('MySqli_conexionDB.php');

		$query = "SELECT 
					s.id_servicio, 
					s.id_cliente, 
					s.id_encargado, 
					s.id_vehiculo, 
					s.fecha_entrada, 
					s.fecha_salida, 
					c.nombre1 AS nombre_cliente, 
					e.nombre1 AS nombre_encargado, 
					e.nombre2 AS nombre_encargado2, 
					e.apellido1 AS apellido_encargado, 
					e.apellido2 AS apellido_encargado2, 
					v.marca AS marca_vehiculo, 
					v.modelo AS modelo_vehiculo
				FROM servicio s
				LEFT JOIN cliente c ON s.id_cliente = c.id_cliente
				LEFT JOIN empleado e ON s.id_encargado = e.id_empleado
				LEFT JOIN vehiculo v ON s.id_vehiculo = v.id_vehiculo";

		$resultado = mysqli_query($conexion, $query);

		if (!$resultado) {
			exit(mysqli_error($conexion));
		}

		// Lista de servicios
		$lista = array();

		if (mysqli_num_rows($resultado) > 0) {
			while ($renglon = mysqli_fetch_assoc($resultado)) {
				$lista[] = array(
					'id_servicio' => $renglon['id_servicio'],
					'id_cliente' => $renglon['id_cliente'],
					'id_encargado' => $renglon['id_encargado'],
					'id_vehiculo' => $renglon['id_vehiculo'],
					'fecha_entrada' => $renglon['fecha_entrada'],
					'fecha_salida' => $renglon['fecha_salida'],
					'nombre_cliente' => $renglon['nombre_cliente'],
					'nombre_encargado' => $renglon['nombre_encargado'] . ' ' . $renglon['nombre_encargado2'] . ' ' . $renglon['apellido_encargado'] . ' ' . $renglon['apellido_encargado2'],
					'marca_vehiculo' => $renglon['marca_vehiculo'],
					'modelo_vehiculo' => $renglon['modelo_vehiculo']
				);
			}
		}

		return $lista;
	}

	// FIN FUNCIONES SERVICIO 
	
	// INICIO FUNCIONES VENTA 
	function obtenerListaVenta() 
	{
		include_once('MySqli_conexionDB.php');
	
		$query = "SELECT 
					v.id_venta, 
					v.id_servicio, 
					v.subtotal, 
					v.id_promocion, 
					v.iva_venta, 
					v.total, 
					v.forma_pago, 
					v.fecha_venta, 
					s.fecha_entrada, 
					s.fecha_salida, 
					p.nombre AS nombre_promocion
				  FROM venta v
				  LEFT JOIN servicio s ON v.id_servicio = s.id_servicio
				  LEFT JOIN promocion p ON v.id_promocion = p.id_promocion";
	
		$resultado = mysqli_query($conexion, $query);
	
		if (!$resultado) {
			exit(mysqli_error($conexion));
		}
	
		// Lista de ventas
		$lista = array();
	
		if (mysqli_num_rows($resultado) > 0) {
			while ($renglon = mysqli_fetch_assoc($resultado)) {
				$lista[] = array(
					'id_venta' => $renglon['id_venta'],
					'id_servicio' => $renglon['id_servicio'],
					'subtotal' => $renglon['subtotal'],
					'id_promocion' => $renglon['id_promocion'],
					'iva_venta' => $renglon['iva_venta'],
					'total' => $renglon['total'],
					'forma_pago' => $renglon['forma_pago'],
					'fecha_venta' => $renglon['fecha_venta'],
					'fecha_entrada' => $renglon['fecha_entrada'],
					'fecha_salida' => $renglon['fecha_salida'],
					'nombre_promocion' => $renglon['nombre_promocion']
				);
			}
		}
	
		return $lista;
	}
	
	// FIN FUNCIONES VENTA 


 ?>