<?php
class ModeloArchivo {

    // Método para guardar el archivo en la base de datos
    static public function mdlGuardarArchivo($datos) {
        try {
            // Conexión a la base de datos
            $stmt = Conexion::conectar()->prepare(
                "INSERT INTO archivos_evaluacion (nombre_archivo_e, archivo_e, tipo_archivo_e) 
                VALUES (:nombre_archivo_e, :archivo_e, :tipo_archivo_e)"
            );

            // Vincular los parámetros con los datos recibidos
            $stmt->bindParam(":nombre_archivo_e", $datos["descripcion_archivo"], PDO::PARAM_STR);
            $stmt->bindParam(":archivo_e", $datos["ruta"], PDO::PARAM_STR);  // La ruta del archivo subido
          
            $stmt->bindParam(":tipo_archivo_e", $datos["tipo_archivo"], PDO::PARAM_STR);

            // Ejecutar la consulta
            if ($stmt->execute()) {
                return "ok";  // Si la inserción fue exitosa, devuelve "ok"
            } else {
                return "error";  // En caso de fallo, devuelve "error"
            }

            // Cerrar la conexión
            $stmt = null;
        } catch (Exception $e) {
            return "error: " . $e->getMessage();  // Retorna un mensaje de error en caso de excepción
        }
    }
    

    // Método para mostrar los archivos
    static public function mdlMostrarArchivos($tabla, $item, $valor) {

        if($item != null) {
            // Consulta preparada para obtener un registro específico
            $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item");
            $stmt->bindParam(":" . $item, $valor, PDO::PARAM_STR);
            $stmt->execute();
            return $stmt->fetch();
        } else {
            // Consulta para obtener todos los registros
            $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla");
            $stmt->execute();
            return $stmt->fetchAll();
        }

        // Cerramos la conexión
        $stmt->close();
        $stmt = null;
    }

    // Método para obtener el archivo por su ID
    static public function mdlObtenerArchivo($idArchivo) {
        $stmt = Conexion::conectar()->prepare("SELECT * FROM archivos_evaluacion WHERE cod_archivo_e = :cod_archivo_e");
        $stmt->bindParam(":cod_archivo_e", $idArchivo, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }


}
?>
