<?php


class ControladorCategorias{


        /* =============================================
     CREAR CATEGORIAS
      ============================================= */
    public static function ctrCrearCategorias()
    {
        if (isset($_POST["nombre_categoria"])) {
            // Capturar datos desde el formulario
            $tabla = "categorias";
            $datos = array(
                "nombre_categoria" => $_POST["nombre_categoria"]
            );
    
            // Llamar al modelo para actualizar la fecha y otros datos
            $respuesta = ModeloCategorias::mdlCrearCategorias($datos, $tabla);
    
            // Manejar la respuesta del modelo
            if ($respuesta == "ok") {
                echo '<script>
                    Swal.fire(
                        "Actualizado!",
                        "La Categoria ha sido creada con Éxito.",
                        "success"
                    ).then(function() {
                        document.getElementById("form_crear_categorias").reset(); // Reemplaza con el ID correcto de tu formulario
                        $("#crear_categorias").addClass("active");
                        });
                </script>';
            } else {
                echo '<script>
                    Swal.fire(
                        "ERROR!",
                        "Error al actualizar la información de la categoría.",
                        "error"
                    ).then(function() {
                        window.location = ""; // Redirige a la página actual
                    });
                </script>';
            }
        }
    }
    
    /* =============================================
      MOSTRAR CATEGORIAS
      ============================================= */

      static public function ctrMostrarCategorias($item, $valor)
      {
          $tabla = "categorias";
  
          $respuesta = ModeloCategorias::mdlMostraCategorias($tabla,$item, $valor);
  
          return $respuesta;
      }

        /* =============================================
      MOSTRAR CATEGORIA
      ============================================= */

      static public function ctrMostrarCategoria($item, $valor)
      {
          $tabla = "categorias";
  
          $respuesta = ModeloCategorias::mdlMostraCategoria($tabla, $item, $valor);

          return $respuesta;
      }

    /* =============================================
      ELIMINAR CATEGORIAS
      ============================================= */
      public static function ctrEliminarCategoria() 
      {
        if (isset($_POST['eliminar_categoria'])) {
            $id_categoria = $_POST['id_categoria'];
    
            // Llamar al modelo para eliminar la categoría
            $respuesta = ModeloCategorias::mdlEliminarCategoria($id_categoria);
    
            // Manejar la respuesta del modelo
            if ($respuesta == "ok") {
                echo '<script>
                    Swal.fire(
                        "Eliminado!",
                        "La categoría ha sido eliminada con éxito.",
                        "success"
                    ).then(function() {
                        window.location = "subirDocumentos"; // Recargar la página
                    });
                    </script>';
            } else {
                echo '<script>
                    Swal.fire(
                        "ERROR!",
                        "Hubo un problema al eliminar la categoría.",
                        "error"
                    );
                    </script>';
            }
        }
      }


        /* =============================================
      SUBIR DOCUMENTOS
      ============================================= */
      public static function ctrSubirDocumentosEmpresa()
      {
          if (isset($_POST['id_empresa_fk']) && isset($_FILES['ruta_archivos_empresas'])) {
              // Ruta donde se guardará el archivo
              $directorio = "vistas/files/EMPRESAS/";
      
              // Verificar si el directorio existe, si no, crearlo
              if (!file_exists($directorio)) {
                  mkdir($directorio, 0755, true); // Crear directorio con permisos
              }
      
              // Obtener información del archivo
              $archivo = $_FILES['ruta_archivos_empresas'];
              $nombreArchivo = $archivo['name'];
              $rutaArchivo = $directorio . basename($nombreArchivo);
      
              // Mover el archivo cargado al directorio
              if (move_uploaded_file($archivo['tmp_name'], $rutaArchivo)) {
                  // Datos para el modelo
                  $tabla = "archivos_empresa";
                  $datos = array(
                      "id_empresa_fk" => $_POST["id_empresa_fk"],
                      "id_categoria_fk" => $_POST["id_categoria_fk"],
                      "ruta_archivos_empresas" => $rutaArchivo, // Ruta completa guardada en la base de datos
                      "nombre_archivo" => $_POST["nombre_archivo"],
                      "tipo_archivo_empresa" => $_POST["tipo_archivo_empresa"],
                      "estado_archivo" => "Activo" // Configuración automática
                  );
      
                  // Llamar al modelo
                  $respuesta = ModeloCategorias::mdlSubirDocumentosEmpresa($tabla, $datos);
      
                  // Manejar la respuesta del modelo
                  if ($respuesta == "ok") {
                      echo '<script>
                          Swal.fire(
                              "Guardado!",
                              "El archivo se ha guardado exitosamente",
                              "success"
                          ).then(function() {
                              document.getElementById("form_subir_documentos").reset();
                          });
                      </script>';
                  } else {
                      echo '<script>
                          Swal.fire(
                              "ERROR!",
                              "Hubo un problema al guardar los datos.",
                              "error"
                          );
                      </script>';
                  }
              } else {
                  echo '<script>
                      Swal.fire(
                          "ERROR!",
                          "No se pudo mover el archivo al servidor.",
                          "error"
                      );
                  </script>';
              }
          }
      }
      
              /* =============================================
      SUBIR DOCUMENTOS COTIZACIONES
      ============================================= */
      public static function ctrSubirCotizacion()
      {
          if (isset($_POST['id_empresa_prospecto']) && isset($_FILES['ruta_archivos_propuesta'])) {
              // Ruta donde se guardará el archivo
              $directorio = "vistas/files/COTIZACION/";
      
              // Verificar si el directorio existe, si no, crearlo
              if (!file_exists($directorio)) {
                  mkdir($directorio, 0755, true); // Crear directorio con permisos
              }
      
              // Obtener información del archivo
              $archivo = $_FILES['ruta_archivos_propuesta'];
              $nombreArchivo = $archivo['name'];
              $rutaArchivo = $directorio . basename($nombreArchivo);
      
              // Mover el archivo cargado al directorio
              if (move_uploaded_file($archivo['tmp_name'], $rutaArchivo)) {
                  // Datos para el modelo
                  $tabla = "archivos_propuesta";
                  $datos = array(
                      "id_empresa_prospecto" => $_POST["id_empresa_prospecto"],
                      "id_categoria_prospecto" => $_POST["id_categoria_prospecto"],
                      "ruta_archivos_propuesta" => $rutaArchivo, // Ruta completa guardada en la base de datos
                      "nombre_propuesta" => $_POST["nombre_propuesta"],
                      "tipo_archivo_propuesta" => $_POST["tipo_archivo_propuesta"],
                      "fecha_propuesta" => $_POST["fecha_propuesta"],
                      "valor_propuesta" => $_POST["valor_propuesta"]

                  );
      
                  // Llamar al modelo
                  $respuesta = ModeloCategorias::mdlSubirCotizacion($tabla, $datos);
      
                  // Manejar la respuesta del modelo
                  if ($respuesta == "ok") {
                      echo '<script>
                          Swal.fire(
                              "Guardado!",
                              "El archivo se ha guardado exitosamente",
                              "success"
                          ).then(function() {
                              document.getElementById("form_subir_documentos").reset();
                          });
                      </script>';
                  } else {
                      echo '<script>
                          Swal.fire(
                              "ERROR!",
                              "Hubo un problema al guardar los datos.",
                              "error"
                          );
                      </script>';
                  }
              } else {
                  echo '<script>
                      Swal.fire(
                          "ERROR!",
                          "No se pudo mover el archivo al servidor.",
                          "error"
                      );
                  </script>';
              }
          }
      }

   /* =============================================
      MOSTRAR ARCHIVOS EMPRESAS
      ============================================= */

      static public function ctrMostrarArchivosEmpresas($item, $valor)
      {
          $tabla = "archivos_empresa";
  
          $respuesta = ModeloCategorias::mdlMostrarArchivosEmpresas($tabla,$item, $valor);
  
          return $respuesta;
      }

         /* =============================================
      MOSTRAR ARCHIVOS COTIZACION
      ============================================= */

      static public function ctrMostrarArchivosCotizacion($item, $valor)
      {
          $tabla = "archivos_propuesta";
  
          $respuesta = ModeloCategorias::mdlMostrarArchivosCotizacion($tabla,$item, $valor);
  
          return $respuesta;
      }

         /* =============================================
      MOSTRAR ARCHIVOS DE LAS EMPRESAS PARA ACTIVARLOS
      ============================================= */

      static public function ctrMostrarArchivosEmpresa($valor,$item)
      {
          $tabla = "archivos_empresa";
  
          $respuesta = ModeloCategorias::mdlMostrarArchivosEmpresa($tabla,$valor,$item);
  
          return $respuesta;
      }

              /* =============================================
     CREAR CATEGORIAS
      ============================================= */
      public static function ctrAsignarFecha()
      {
          if (isset($_POST["fecha_archivo"]) && isset($_POST["id_archivos"])) {
              // Capturar datos desde el formulario
              $tabla = "archivos_empresa";
              $datos = array(
                  "id_archivos" => $_POST["id_archivos"],
                  "fecha_archivo" => $_POST["fecha_archivo"]
              );
      
              // Llamar al modelo para actualizar la fecha
              $respuesta = ModeloCategorias::mdlAsignarFecha($datos, $tabla);
      
              // Manejar la respuesta del modelo
              if ($respuesta == "ok") {
                  echo '<script>
                      Swal.fire(
                          "Actualizado!",
                          "Se ha asignado una fecha de visualización al documento.",
                          "success"
                      ).then(function() {
                          document.getElementById("formAsignarFecha").reset(); // Restablecer formulario
                          $("#documentos_empresa").addClass("active"); // Actualizar vista
                      });
                  </script>';
              } else {
                  echo '<script>
                      Swal.fire(
                          "ERROR!",
                          "Error al actualizar la información del documento.",
                          "error"
                      ).then(function() {
                          window.location = ""; // Redirige a la página actual
                      });
                  </script>';
              }
          }
      }
      
      

}