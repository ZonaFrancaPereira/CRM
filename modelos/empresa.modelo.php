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
				fecha_inicio_contrato
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
				:fecha_inicio_contrato
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

public static function mdlMostraEmpresas($tabla, $item, $valor)
{
    // Prepara la consulta SQL para obtener todos los datos de la tabla especificada
    $stmt = Conexion::conectar()->prepare("SELECT $tabla.*, usuarios.nombre 
                      FROM $tabla 
                      INNER JOIN usuarios ON usuarios.id = $tabla.id_usuario_fk ");
    
    // Ejecuta la consulta
    $stmt->execute();
    
    // Devuelve todos los resultados como un array asociativo
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}


	public static function mdlMostraEmpresasAsignada($tabla, $consulta)
	{
		switch ($consulta) {
			
			case 'usuario':
					// Consulta para obtener todos los datos de la tabla
					$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla");
					$stmt->execute();
					return $stmt->fetchAll(PDO::FETCH_ASSOC); // Usar fetchAll() para obtener todos los resultados como un array asociativo
					break;
			default:
				return []; // Retorna un array vacío si no se cumple ninguna condición
				break;
		}
	}

	 /*=============================================
	MOSTRAR EMPRESA POR ID
	=============================================*/

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

	
	
}
