<?php

class ControladorEmpresa
{
    /* =============================================
      CREAR EMPRESA
      ============================================= */

    public static function ctrCrearEmpresas()
    {
        if (isset($_POST["NombreEmpresa"])) {
            // Validar que los campos obligatorios no estén vacíos
            if (!empty($_POST["id"]) && !empty($_POST["dv"]) && !empty($_POST["NombreEmpresa"])) {
                // Preparar datos para el modelo
                $tabla = "datosempresa";
                $datos = array(
                    "id" => $_POST["id"],
                    "dv" => $_POST["dv"],
                    "NombreEmpresa" => $_POST["NombreEmpresa"],
                    "DireccionEmpresa" => $_POST["DireccionEmpresa"],
                    "ciudad" => $_POST["ciudad"],
                    "Telefono" => $_POST["Telefono"],
                    "telefono2" => $_POST["telefono2"],
                    "nombre_rep_legal" => $_POST["nombre_rep_legal"],
                    "fecha_nap_red_legal" => $_POST["fecha_nap_red_legal"],
                    "correoElectronico" => $_POST["correoElectronico"],
                    "fecha_inicio_contrato" => $_POST["fecha_inicio_contrato"]
                );

                // Llamar al modelo
                $respuesta = ModeloEmpresas::mdlCrearEmpresa($tabla, $datos);

                // Verificar la respuesta y mostrar alertas
                if ($respuesta == "ok") {
                    echo '<script>
                            Swal.fire(
                            "Buen Trabajo!",
                            "Su respuesta se ha registrado con éxito.",
                            "success"
                            ).then(function() {
                            document.getElementById("crear_empresa").reset();
                            });
                        </script>';
                } else {
                    echo '<script>
                        Swal.fire({
                            type: "error",
                            title: "¡La Respuesta no pudo ser guardada!",
                            text: "Error: ' . implode(" - ", $respuesta) . '", // Mostrar error específico de PDO
                            showConfirmButton: true,
                            confirmButtonText: "Cerrar"
                        });
                    </script>';
                }
            } else {
                echo '<script>
                        Swal.fire({
                            type: "error",
                            title: "¡Faltan Datos Obligatorios!",
                            text: "Por favor, complete todos los campos obligatorios.",
                            showConfirmButton: true,
                            confirmButtonText: "Cerrar"
                        });
                    </script>';
            }
        }
    }


    /* =============================================
      MOSTRAR EMPRESA
      ============================================= */

    static public function ctrMostrarEmpresa($item, $valor)
    {
        $tabla = "datosempresa";

        $respuesta = ModeloEmpresas::mdlMostraEmpresas($tabla, $item, $valor);

        return $respuesta;
    }

    static public function ctrMostrarEmpresaAsignada($consulta)
    {
        $tabla = "datosempresa";

        $respuesta = ModeloEmpresas::mdlMostraEmpresasAsignada($tabla, $consulta);

        return $respuesta;
    }

    /* =============================================
      EDITAR EMPRESA
      ============================================= */

    public static function ctrActualizarEmpresa()
    {
        if (isset($_POST["actualizar_empresa"])) {
            // Capturar datos desde el formulario
            $datos = array(
                "id" => $_POST["id_empresa"],
                "dv" => $_POST["dv_empresa"],
                "NombreEmpresa" => $_POST["nombre_empresa"],
                "DireccionEmpresa" => $_POST["direccion_empresa"],
                "ciudad" => $_POST["ciudad_empresa"],
                "Telefono" => $_POST["telefono_empresa"],
                "telefono2" => $_POST["telefono2_empresa"],
                "nombre_rep_legal" => $_POST["nombre_rep_legal_empresa"],
                "correoElectronico" => $_POST["correo_empresa"]
            );

            // Llamar al modelo para actualizar la fecha y otros datos
            $respuesta = ModeloEmpresas::mdlActualizarEmpresa($datos);

            // Manejar la respuesta del modelo
            if ($respuesta == "ok") {
                echo '<script>
                Swal.fire(
                    "Actualizado!",
                    "La información de la empresa ha sido actualizada con éxito.",
                    "success"
                ).then(function() {
                    window.location = ""; // Redirige a la página "perfil"
                });
                </script>';
            } else {
                echo '<script>
                    Swal.fire(
                        "ERROR!",
                        "Error al actualizar la información de la empresa.",
                        "error"
                    ).then(function() {
                        window.location = ""; // Redirige a la página actual o a la vista correcta
                    });
                    </script>';
            }
        }
    }

    public static function ctrAsignarEmpresa()
{
    if (isset($_POST["asignar_empresa"])) {
        // Capturar datos desde el formulario
        $datos = array(
            "id" => $_POST["id_asignar"],
            "id_usuario_fk" => $_POST["id_usuario_fk_empresa"]
        );

        // Llamar al modelo para actualizar la fecha y otros datos
        $respuesta = ModeloEmpresas::mdlAsignarEmpresa($datos);

        // Manejar la respuesta del modelo
        if ($respuesta == "ok") {
            // Si la asignación fue exitosa, mostrar mensaje y recargar la página dos veces
            echo '<script>
                Swal.fire(
                    "Asignado!",
                    "La Empresa ha sido asignada con exito.",
                    "success"
                ).then(function() {
                    // Primer recarga
                    window.location = ""; 
                    // Segundo recarga (esto ocurre después de la primera recarga)
                    setTimeout(function(){
                        window.location = "";
                    }, 2000); // Este segundo recarga se ejecuta 2 segundos después de la primera
                });
            </script>';
        } else {
            // Si hubo un error al asignar la empresa, mostrar mensaje de error
            echo '<script>
                Swal.fire(
                    "ERROR!",
                    "Error al asignar la empresa.",
                    "error"
                ).then(function() {
                    // Primer recarga
                    window.location = ""; 
                    // Segundo recarga (esto ocurre después de la primera recarga)
                    setTimeout(function(){
                        window.location = "";
                    }, 2000); // Este segundo recarga se ejecuta 2 segundos después de la primera
                });
            </script>';
        }
    }
}


}
