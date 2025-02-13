<?php

require_once "conexion.php";

class ModeloCategorias
{

    
    /* =============================================
      CREAR CATEGORIAS
      ============================================= */

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


    /* =============================================
      MOSTRAR TODAS LAS CATEGORIAS
      ============================================= */
    public static function mdlMostraCategorias($tabla, $item, $valor)
    {
        // Obtener la conexión PDO
        $pdo = Conexion::conectar();

        // Preparar la consulta para obtener todos los datos de la tabla
        $stmt = $pdo->prepare("SELECT * FROM $tabla");

        // Ejecutar la consulta
        $stmt->execute();

        // Retornar los resultados obtenidos como un array asociativo
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

  /* =============================================
      MOSTRAR TODAS LAS CATEGORIAS PARA UN DATALIST
      ============================================= */

    public static function mdlMostraCategoria($tabla, $item, $valor)
    {
 
        $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla ");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

     /* =============================================
     ELIMINAR CATEGORIAS
      ============================================= */
    public static function mdlEliminarCategoria($id_categoria)
    {
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

       /* =============================================
      GUARDAR ARCHIO DE CATEGORIAS
      ============================================= */

      public static function mdlSubirDocumentosEmpresa($tabla, $datos)
    {
        try {
            $pdo = Conexion::conectar();

            $stmt = $pdo->prepare("INSERT INTO $tabla (
                id_empresa_fk, 
                id_categoria_fk, 
                ruta_archivos_empresas, 
                nombre_archivo,
                tipo_archivo_empresa,
                estado_archivo
            ) VALUES (
                :id_empresa_fk, 
                :id_categoria_fk, 
                :ruta_archivos_empresas, 
                :nombre_archivo,
                :tipo_archivo_empresa,
                :estado_archivo
            )");

            $stmt->bindParam(":id_empresa_fk", $datos["id_empresa_fk"], PDO::PARAM_INT);
            $stmt->bindParam(":id_categoria_fk", $datos["id_categoria_fk"], PDO::PARAM_INT);
            $stmt->bindParam(":ruta_archivos_empresas", $datos["ruta_archivos_empresas"], PDO::PARAM_STR);
            $stmt->bindParam(":nombre_archivo", $datos["nombre_archivo"], PDO::PARAM_STR);
            $stmt->bindParam(":tipo_archivo_empresa", $datos["tipo_archivo_empresa"], PDO::PARAM_STR);
            $stmt->bindParam(":estado_archivo", $datos["estado_archivo"], PDO::PARAM_STR);

            if ($stmt->execute()) {
                return "ok";
            } else {
                error_log(print_r($stmt->errorInfo(), true));
                return $stmt->errorInfo();
            }
        } catch (PDOException $e) {
            error_log($e->getMessage());
            return "error: " . $e->getMessage();
        }
    }

  /* =============================================
      MOSTRAR TODAS ARCHIVOS DE LA EMPRESA
      ============================================= */

      public static function mdlMostrarArchivosEmpresas($tabla, $item, $valor)
      {
          // Capturamos el id desde la URL de manera segura
          $perfil = isset($_GET['id']) ? intval($_GET['id']) : 0;
      
          // Si no hay un id válido, retornamos un array vacío
          if ($perfil == 0) {
              return [];
          }
      
          // Consulta SQL con parámetros preparados para evitar inyecciones
          $stmt = Conexion::conectar()->prepare(
              "SELECT 
                  a.*, 
                  c.nombre_categoria 
              FROM $tabla a 
              INNER JOIN categorias c 
                  ON a.id_categoria_fk = c.id_categoria 
              WHERE a.id_empresa_fk = :perfil 
                  AND a.estado_archivo != 'Inactivo'"  // Añadimos la condición para excluir los inactivos
          );
      
          // Enlazamos el parámetro de manera segura
          $stmt->bindParam(':perfil', $perfil, PDO::PARAM_INT);
      
          // Ejecutamos la consulta
          $stmt->execute();
      
          // Retornamos los resultados de la consulta
          return $stmt->fetchAll(PDO::FETCH_ASSOC);
      }
      
      
  /* =============================================
      MOSTRAR TODAS ARCHIVOS DE TODAS LAS EMPRESAS
      ============================================= */

      public static function mdlMostrarArchivosEmpresa($tabla, $valor, $item)
      {

           
                // Conexión a la base de datos
                $conexion = Conexion::conectar();
            
                // Paso 1: Actualizar el estado a 'Inactivo' si la fecha_archivo es menor a la fecha actual
                $updateStmtInactivo = $conexion->prepare("UPDATE $tabla 
                    SET estado_archivo = 'Inactivo'
                    WHERE fecha_archivo < CURDATE()
                ");
                $updateStmtInactivo->execute();
                $updateStmtInactivo = null; // Cerrar la declaración de la actualización
            
                // Paso 2: Actualizar el estado a 'Activo' si la fecha_archivo es mayor o igual a la fecha actual
                $updateStmtActivo = $conexion->prepare("UPDATE $tabla 
                    SET estado_archivo = 'Activo'
                    WHERE fecha_archivo >= CURDATE()
                ");
                $updateStmtActivo->execute();
                $updateStmtActivo = null; // Cerrar la declaración de la actualización
            
                // Paso 3: Consulta para obtener todos los datos de la tabla, sin importar si están activos o inactivos
                $stmt = Conexion::conectar()->prepare("SELECT a.*, 
                       b.NombreEmpresa, 
                       c.nombre_categoria
                FROM $tabla a
                INNER JOIN datosempresa b 
                    ON a.id_empresa_fk = b.id
                INNER JOIN categorias c 
                    ON a.id_categoria_fk = c.id_categoria
                ");
                $stmt->execute();
            
                // Retornar los resultados obtenidos como un array asociativo
                return $stmt->fetchAll(PDO::FETCH_ASSOC); 
            
      }

          /* =============================================
      CREAR CATEGORIAS
      ============================================= */

      public static function mdlAsignarFecha($datos, $tabla)
      {
          try {
              // Obtener la conexión PDO
              $pdo = Conexion::conectar();
      
              // Preparar la consulta de actualización
              $stmt = $pdo->prepare("UPDATE $tabla SET fecha_archivo = :fecha_archivo WHERE id_archivos = :id_archivos");
      
              // Vincular parámetros
              $stmt->bindParam(":fecha_archivo", $datos["fecha_archivo"], PDO::PARAM_STR);
              $stmt->bindParam(":id_archivos", $datos["id_archivos"], PDO::PARAM_INT);
      
              // Ejecutar la consulta
              if ($stmt->execute()) {
                  return "ok";
              } else {
                  return $stmt->errorInfo(); // Retornar error detallado
              }
          } catch (PDOException $e) {
              return "error: " . $e->getMessage(); // Retornar mensaje de error
          }
      }

      
      

}
