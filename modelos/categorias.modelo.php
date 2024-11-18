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
            tipo_archivo_empresa
        ) VALUES (
            :id_empresa_fk, 
            :id_categoria_fk, 
            :ruta_archivos_empresas, 
            :tipo_archivo_empresa
        )");

        $stmt->bindParam(":id_empresa_fk", $datos["id_empresa_fk"], PDO::PARAM_INT);
        $stmt->bindParam(":id_categoria_fk", $datos["id_categoria_fk"], PDO::PARAM_INT);
        $stmt->bindParam(":ruta_archivos_empresas", $datos["ruta_archivos_empresas"], PDO::PARAM_STR);
        $stmt->bindParam(":tipo_archivo_empresa", $datos["tipo_archivo_empresa"], PDO::PARAM_STR);

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
              WHERE a.id_empresa_fk = :perfil"
          );
      
          // Enlazamos el parámetro de manera segura
          $stmt->bindParam(':perfil', $perfil, PDO::PARAM_INT);
      
          // Ejecutamos la consulta
          $stmt->execute();
      
          // Retornamos los resultados de la consulta
          return $stmt->fetchAll(PDO::FETCH_ASSOC);
      }
      


}
