<?php

require_once "conexion.php";

class ModeloEmpresas
{

	/*=============================================
	MOSTRAR EMPRESA
	=============================================*/
	public static function mdlCrearEmpresa($tabla, $datos) {
		try {
			// Obtener la conexión PDO
			$pdo = Conexion::conectar();
			
			// Preparar la consulta de inserción
			$stmt = $pdo->prepare("INSERT INTO $tabla (
				id, 
				dv, 
				NombreEmpresa, 
				DireccionEmpresa, 
				ciudad, 
				Telefono, 
				telefono2, 
				nombre_rep_legal, 
				fecha_nap_red_legal, 
				correoElectronico, 
				fecha_inicio_contrato,
				estado_empresa
			) VALUES (
				:id, 
				:dv, 
				:NombreEmpresa, 
				:DireccionEmpresa, 
				:ciudad, 
				:Telefono, 
				:telefono2, 
				:nombre_rep_legal, 
				:fecha_nap_red_legal, 
				:correoElectronico, 
				:fecha_inicio_contrato,
				:estado_empresa
			)");
	
			// Vincular parámetros
			$stmt->bindParam(":id", $datos["id"], PDO::PARAM_INT);
			$stmt->bindParam(":dv", $datos["dv"], PDO::PARAM_STR);
			$stmt->bindParam(":NombreEmpresa", $datos["NombreEmpresa"], PDO::PARAM_STR);
			$stmt->bindParam(":DireccionEmpresa", $datos["DireccionEmpresa"], PDO::PARAM_STR);
			$stmt->bindParam(":ciudad", $datos["ciudad"], PDO::PARAM_STR);
			$stmt->bindParam(":Telefono", $datos["Telefono"], PDO::PARAM_STR);
			$stmt->bindParam(":telefono2", $datos["telefono2"], PDO::PARAM_STR);
			$stmt->bindParam(":nombre_rep_legal", $datos["nombre_rep_legal"], PDO::PARAM_STR);
			$stmt->bindParam(":fecha_nap_red_legal", $datos["fecha_nap_red_legal"], PDO::PARAM_STR);
			$stmt->bindParam(":correoElectronico", $datos["correoElectronico"], PDO::PARAM_STR);
			$stmt->bindParam(":fecha_inicio_contrato", $datos["fecha_inicio_contrato"], PDO::PARAM_STR);
			$stmt->bindParam(":estado_empresa", $datos["estado_empresa"], PDO::PARAM_STR);
	
			// Ejecutar la consulta
			if ($stmt->execute()) {
				return "ok";
			} else {
				// Retornar error detallado de PDO
				return $stmt->errorInfo();
			}
	
		} catch (PDOException $e) {
			// Retornar mensaje de error
			return "error: " . $e->getMessage();
		}
	}
	
 /*=============================================
	MOSTRAR EMPRESAS
	=============================================*/
	public static function mdlMostraEmpresas($tabla)
	{
		// Prepara la consulta SQL para obtener todos los datos de la tabla especificada junto con el nombre del usuario asignado
		$stmt = Conexion::conectar()->prepare(
			"SELECT $tabla.*, usuarios.nombre
			 FROM $tabla 
			 LEFT JOIN usuarios ON $tabla.id_usuario_fk = usuarios.id WHERE estado_empresa = 'Cliente'"
		);
		
		// Ejecuta la consulta
		$stmt->execute();
		
		// Devuelve todos los resultados como un array asociativo
		return $stmt->fetchAll(PDO::FETCH_ASSOC);
	}


	 /*=============================================
	MOSTRAR EMPRESAS PROPSECTO
	=============================================*/
	public static function mdlMostraEmpresasProspecto($tabla)
	{
		// Prepara la consulta SQL para obtener todos los datos de la tabla especificada junto con el nombre del usuario asignado
		$stmt = Conexion::conectar()->prepare(
			"SELECT * FROM $tabla WHERE estado_empresa = 'Prospecto'"
		);
		
		// Ejecuta la consulta
		$stmt->execute();
		
		// Devuelve todos los resultados como un array asociativo
		return $stmt->fetchAll(PDO::FETCH_ASSOC);
	}

 /*=============================================
	CAMBIAR A CLIENTE
	=============================================*/

	static public function mdlConvertirCliente($tabla, $id_prospecto, $estado_empresa)
	{
		try {
			// Prepara la consulta para actualizar el estado de la empresa
			$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET estado_empresa = :estado_empresa WHERE id = :id");
			
			// Vincula los parámetros con los datos del formulario
			$stmt->bindParam(":id", $id_prospecto, PDO::PARAM_INT);
			$stmt->bindParam(":estado_empresa", $estado_empresa, PDO::PARAM_STR);
			
			// Ejecuta la consulta
			if ($stmt->execute()) {
				return "ok";
			} else {
				return "error";
			}
		} catch (PDOException $e) {
			return "error: " . $e->getMessage();
		} finally {
			$stmt = null; // Libera el recurso
		}
	}

	public static function mdlMostraEmpresasAsignada($tabla,$item, $valor, $id_usuario_fk)
	{
		// Consulta para obtener todos los datos de la empresa asignada al usuario que inicia sesión
		$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE id_usuario_fk = :id_usuario_fk");
		
		// Vincular el parámetro de manera segura
		$stmt->bindParam(':id_usuario_fk', $id_usuario_fk, PDO::PARAM_INT);
		
		// Ejecutar la consulta
		$stmt->execute();
		
		// Retornar los resultados como un array asociativo
		return $stmt->fetchAll(PDO::FETCH_ASSOC);
	}


	public static function mdlMostraEmpresaid($tabla, $idEmpresa)
{
    // Conectar a la base de datos
    $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE id = :idempresa");
    
    // Vincular el parámetro de manera segura
    $stmt->bindParam(':id_empresa',$idEmpresa, PDO::PARAM_INT);

    // Ejecutar la consulta
    $stmt->execute();

    // Retornar los resultados
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

 /*=============================================
	MOSTRAR EMPRESAS ASIGNADAS A USUARIO
	=============================================*/

	public static function mdlMostraEmpresasUsuario($tabla, $item, $valor)
	{
		// Comprueba si se pasa un filtro
		if ($item !== null && $valor !== null) {
			// Prepara la consulta con el filtro dinámico
			$stmt = Conexion::conectar()->prepare(
				"SELECT $tabla.*, usuarios.nombre 
				 FROM $tabla 
				 INNER JOIN usuarios ON usuarios.id = $tabla.id_usuario_fk
				 WHERE $item = :valor"
			);
	
			// Enlaza el valor al parámetro
			$stmt->bindParam(":valor", $valor, PDO::PARAM_STR);
		} else {
			// Prepara la consulta sin filtro
			$stmt = Conexion::conectar()->prepare(
				"SELECT $tabla.*, usuarios.nombre 
				 FROM $tabla 
				 INNER JOIN usuarios ON usuarios.id = $tabla.id_usuario_fk"
			);
		}
	
		// Ejecuta la consulta
		$stmt->execute();
	
		// Devuelve todos los resultados como un array asociativo
		return $stmt->fetchAll(PDO::FETCH_ASSOC);
	}
	


	/*=============================================
    ACTUALIZAR EMPRESA
    =============================================*/
	static public function mdlActualizarEmpresa($datos)
{
    try {
        // Prepara la consulta para actualizar todos los campos necesarios
        $stmt = Conexion::conectar()->prepare("UPDATE datosempresa 
            SET 
                dv = :dv,
                NombreEmpresa = :NombreEmpresa,
                DireccionEmpresa = :DireccionEmpresa,
                ciudad = :ciudad,
                Telefono = :Telefono,
                telefono2 = :telefono2,
                nombre_rep_legal = :nombre_rep_legal,
                correoElectronico = :correoElectronico
            WHERE id = :id");

        // Vincula los parámetros con los datos del formulario
        $stmt->bindParam(":id", $datos["id"], PDO::PARAM_INT);
        $stmt->bindParam(":dv", $datos["dv"], PDO::PARAM_STR);
        $stmt->bindParam(":NombreEmpresa", $datos["NombreEmpresa"], PDO::PARAM_STR);
        $stmt->bindParam(":DireccionEmpresa", $datos["DireccionEmpresa"], PDO::PARAM_STR);
        $stmt->bindParam(":ciudad", $datos["ciudad"], PDO::PARAM_STR);
        $stmt->bindParam(":Telefono", $datos["Telefono"], PDO::PARAM_STR);
        $stmt->bindParam(":telefono2", $datos["telefono2"], PDO::PARAM_STR);
        $stmt->bindParam(":nombre_rep_legal", $datos["nombre_rep_legal"], PDO::PARAM_STR);
        $stmt->bindParam(":correoElectronico", $datos["correoElectronico"], PDO::PARAM_STR);

        // Ejecuta la consulta
        if ($stmt->execute()) {
            return "ok";
        } else {
            return "error";
        }
    } catch (PDOException $e) {
        return "error: " . $e->getMessage();
    } finally {
        $stmt = null; // Libera el recurso
    }
}

/*=============================================
    ACTUALIZAR EMPRESA
    =============================================*/
	static public function mdlAsignarEmpresa($datos)
{
    try {
        // Prepara la consulta para actualizar todos los campos necesarios
        $stmt = Conexion::conectar()->prepare("UPDATE datosempresa 
            SET 
                id_usuario_fk = :id_usuario_fk
            WHERE id = :id");

        // Vincula los parámetros con los datos del formulario
        $stmt->bindParam(":id", $datos["id"], PDO::PARAM_INT);
        $stmt->bindParam(":id_usuario_fk", $datos["id_usuario_fk"], PDO::PARAM_STR);

        // Ejecuta la consulta
        if ($stmt->execute()) {
            return "ok";
        } else {
            return "error";
        }
    } catch (PDOException $e) {
        return "error: " . $e->getMessage();
    } finally {
        $stmt = null; // Libera el recurso
    }
}

/*=============================================
   REGISTRAR vISITA
    =============================================*/

	static public function mdlRegistrarVisita($datos){
		try {
			// Obtener la conexión PDO
			$pdo = Conexion::conectar();
			
			// Preparar la consulta de inserción
			$stmt = $pdo->prepare("INSERT INTO registro_visitas (
				id_empresa_fk, 
				fecha_visita, 
				hora_inicio, 
				hora_fin, 
				firma_consultor, 
				firma_cliente
			) VALUES (
				:id_empresa_fk, 
				:fecha_visita, 
				:hora_inicio, 
				:hora_fin, 
				:firma_consultor, 
				:firma_cliente
			)");
	
			// Vincular parámetros
			$stmt->bindParam(":id_empresa_fk", $datos["id_empresa_fk"], PDO::PARAM_INT);
			$stmt->bindParam(":fecha_visita", $datos["fecha_visita"], PDO::PARAM_STR);
			$stmt->bindParam(":hora_inicio", $datos["hora_inicio"], PDO::PARAM_STR);
			$stmt->bindParam(":hora_fin", $datos["hora_fin"], PDO::PARAM_STR);
			$stmt->bindParam(":firma_consultor", $datos["firma_consultor"], PDO::PARAM_STR);
			$stmt->bindParam(":firma_cliente", $datos["firma_cliente"], PDO::PARAM_STR);
	
			// Ejecutar la consulta
			if ($stmt->execute()) {
                // Retornar el último ID y el estado "ok"
                return array("status" => "ok", "id_visita_fk" => $pdo->lastInsertId());
            } else {
                return "error";
            }
        } catch (PDOException $e) {
            return "error: " . $e->getMessage();
        }
	}

	
/*=============================================
   REGISTRAR ACTIVIDAD
    =============================================*/

	public static function mdlCrearDetalleActividad($datosActividad){
        try {
            // Obtener la conexión PDO
            $pdo = Conexion::conectar();
    
            // Preparar la consulta de inserción
            $stmt = $pdo->prepare("INSERT INTO detalle_actividades(
                    actividades_realizadas,
                    id_visita_fk
                ) VALUES (
                    :actividades_realizadas,
                    :id_visita_fk
                )"
            );
    
            // Vincular los parámetros
            $stmt->bindParam(":actividades_realizadas", $datosActividad["actividades_realizadas"], PDO::PARAM_STR);
            $stmt->bindParam(":id_visita_fk", $datosActividad["id_visita_fk"], PDO::PARAM_INT);

    
            if ($stmt->execute()) {
                return "ok";
            } else {
                return "error";
            }
        } catch (PDOException $e) {
            return "error: " . $e->getMessage();
        }
    
        $stmt = null;
    }
	
	
/*=============================================
   REGISTRAR ACTIVIDAD
    =============================================*/

	public static function mdlCrearDetalleCompromiso($datosCompromiso){
        try {
            // Obtener la conexión PDO
            $pdo = Conexion::conectar();
    
            // Preparar la consulta de inserción
            $stmt = $pdo->prepare("INSERT INTO detalle_compromiso(
                    fecha_proyectada,
					descripcion_compromiso, 
					id_responsable_fk, 
					observaciones_compromiso, 
                    id_visita_fk
                ) VALUES (
                    :fecha_proyectada,
					:descripcion_compromiso, 
					:id_responsable_fk, 
					:observaciones_compromiso, 
                    :id_visita_fk
                )"
            );
    
            // Vincular los parámetros
            $stmt->bindParam(":fecha_proyectada", $datosCompromiso["fecha_proyectada"], PDO::PARAM_STR);
			$stmt->bindParam(":descripcion_compromiso", $datosCompromiso["descripcion_compromiso"], PDO::PARAM_STR);
			$stmt->bindParam(":id_responsable_fk", $datosCompromiso["id_responsable_fk"], PDO::PARAM_INT);
			$stmt->bindParam(":observaciones_compromiso", $datosCompromiso["observaciones_compromiso"], PDO::PARAM_STR);
            $stmt->bindParam(":id_visita_fk", $datosCompromiso["id_visita_fk"], PDO::PARAM_INT);

    
            if ($stmt->execute()) {
                return "ok";
            } else {
                return "error";
            }
        } catch (PDOException $e) {
            return "error: " . $e->getMessage();
        }
    
        $stmt = null;
    }

		 /*=============================================
	MOSTRAR EMPRESA POR ID
	=============================================*/

	public static function mdlMostraVisita($tabla, $item, $valor, $visita)
	{
		// Conectar a la base de datos
		$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE id_empresa_fk = :visita");
		
		// Vincular el parámetro de manera segura
		$stmt->bindParam(':visita', $visita, PDO::PARAM_INT);

		// Ejecutar la consulta
		$stmt->execute();

		// Retornar los resultados
		return $stmt->fetchAll(PDO::FETCH_ASSOC);
	}


	/*=============================================
	MOSTRAR VISITAS PDF
	=============================================*/

		public static function mdlMostrarVisitasPdf($tabla, $item, $valor, $consulta)
		{
			switch ($consulta) {
				case 'registro_visitas':
					// Consulta con filtro
					$stmt = Conexion::conectar()->prepare("SELECT m.*, m.NombreEmpresa, p.*, u.*, c.*
					 FROM datosempresa m
					INNER JOIN registro_visitas p ON m.id = p.id_empresa_fk
					INNER JOIN detalle_actividades u ON p.id_visita = u.id_visita_fk
					INNER JOIN detalle_compromiso c ON p.id_visita = c.id_visita_fk WHERE $item = :valor");
					$stmt->bindParam(":valor", $valor, PDO::PARAM_STR);
					$stmt->execute();
					return $stmt->fetchAll(); // Usar fetchAll() para obtener todos los resultados
					$stmt = null;
					break;
	
				default:
					$consulta = null;
					$item = null;
					$valor = null;
					break;
			}
		}



}
