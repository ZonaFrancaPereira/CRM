<?php

require_once "conexion.php";

class ModeloCategorias{


    public static function mdlCrearCategorias($datos, $tabla)
    {
        try {
            // Obtener la conexión PDO
            $pdo = Conexion::conectar();
            
            // Preparar la consulta de inserción
            $stmt = $pdo->prepare("INSERT INTO $tabla (
                nombre_categoria
            ) VALUES (
                :nombre_categoria
            )");
    
            // Vincular parámetros
            $stmt->bindParam(":nombre_categoria", $datos["nombre_categoria"], PDO::PARAM_STR);
    
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
    

    public static function mdlMostraCategorias($tabla, $consulta)
	{
		switch ($consulta) {
			
			case 'categorias':
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
    
    public static function mdlEliminarCategoria($id_categoria) {
        try {
            $pdo = Conexion::conectar();
            $stmt = $pdo->prepare("DELETE FROM categorias WHERE id_categoria = :id_categoria");
            $stmt->bindParam(":id_categoria", $id_categoria, PDO::PARAM_INT);
    
            if ($stmt->execute()) {
                return "ok";
            } else {
                return $stmt->errorInfo();
            }
        } catch (PDOException $e) {
            return "error: " . $e->getMessage();
        }
    }
    



}