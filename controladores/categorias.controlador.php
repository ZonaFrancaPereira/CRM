<?php


class ControladorCategorias{

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

      static public function ctrMostrarCategorias($consulta)
      {
          $tabla = "categorias";
  
          $respuesta = ModeloCategorias::mdlMostraCategorias($tabla,$consulta);
  
          return $respuesta;
      }



      public static function ctrEliminarCategoria() {
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
                        document.getElementById("form_crear_categorias").reset(); // Reemplaza con el ID correcto de tu formulario
                        $("#crear_categorias").addClass("active");
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
    

}