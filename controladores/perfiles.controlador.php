<?php

class ControladorPerfiles
{


	/*=============================================
	REGISTRO DE PERFILES
	=============================================*/

	static public function ctrCrearPerfil()
{
    if (isset($_POST["nuevoDescripcionPerfil"])) {
        if (preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["nuevoDescripcionPerfil"])) {
            
            $tabla = "perfiles";
            $datos = array(
                "descripcion" => $_POST["nuevoDescripcionPerfil"],
                "AdminUsuarios" => $_POST["AdminUsuarios"],
                "VerUsuarios" => $_POST["VerUsuarios"],
                "EstadoUsuarios" => $_POST["EstadoUsuarios"],
                "AdminPerfiles" => $_POST["AdminPerfiles"],
                "AdminEmpresa" => $_POST["AdminEmpresa"],
                "SubirDocumentos" => $_POST["SubirDocumentos"],
                "SubirCalendario" => $_POST["SubirCalendario"],
                "AdminCalendario" => $_POST["AdminCalendario"]
            );

            $respuesta = ModeloPerfiles::mdlIngresarPerfil($tabla, $datos);

            if ($respuesta == "ok") {
                echo '<script>
                        Swal.fire(
                        "Buen Trabajo!",
                        "El perfil ha sido registrado con éxito.",
                        "success"
                        ).then(function() {
							window.location = "ti";

                        });
                      </script>';
            }
        } else {
            echo '<script>
                    Swal.fire({
                        type: "error",
                        title: "¡La descripción del perfil no puede ir vacía o llevar caracteres especiales!",
                        showConfirmButton: true,
                        confirmButtonText: "Cerrar"
                    }).then(function(result){
                        if(result.value){
                            $("#perfiles").addClass("active");
                            tablaPerfiles.ajax.reload();
                        }
                    });
                  </script>';
        }
    }
}


	/*=============================================
	MOSTRAR PERFILES
	=============================================*/

	static public function ctrMostrarPerfiles($item, $valor)
	{

		$tabla = "perfiles";

		$respuesta = ModeloPerfiles::mdlMostrarPerfiles($tabla, $item, $valor);

		return $respuesta;
	}

	/*=============================================
	EDITAR PERFIL
	=============================================*/

	static public function ctrEditarPerfil()
	{

		if (isset($_POST["idPerfil"])) {

			if (preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["idPerfil"])) {

				$tabla = "perfiles";

				$datos = array(
					"perfil" => $_POST["idPerfil"], "descripcion" => $_POST["editarDescripcion"], "editarModuloTI" => $_POST["editarModuloTI"]

				);

				$respuesta = ModeloPerfiles::mdlEditarPerfil($tabla, $datos);

				if ($respuesta == "ok") {

					echo '<script>

					swal({
						  type: "success",
						  title: "El perfil ha sido editado correctamente",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
							if(result.value){
								$("#perfiles").addClass("active");
								tablaPerfiles.ajax.reload();
							}
						});

					</script>';
				}
			} else {

				echo '<script>
						swal({
						  type: "error",
						  title: "¡El nombre no puede ir vacío o llevar caracteres especiales!",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result) {
							if (result.value) {

							$("#perfiles").addClass("active");
								tablaPerfiles.ajax.reload();

							}
						})
			  		</script>
				';
			}
		}
	}

	/*=============================================
	BORRAR PERFIL
	=============================================*/
	static public function ctrBorrarPerfil()
	{
		if (isset($_POST["idPerfil"]) && isset($_POST["eliminar"])) {

			$tabla = "perfiles";
			$datos = $_POST["idPerfil"];

			$respuesta = ModeloPerfiles::mdlBorrarPerfil($tabla, $datos);
			if ($respuesta == "ok") {
				echo 'ok';
			}
		}
	}


	/*=============================================
	ACTUALIZAR PERFIL
	=============================================*/
	public function ctrActualizarPerfil()
{
    if (isset($_POST['id'])) {
        // Ruta donde se guardará el archivo
        $directorio = "vistas/img/usuarios/";

        // Obtener datos actuales del usuario antes de actualizar
        $usuarioActual = ModeloPerfiles::mdlObtenerUsuario("usuarios", $_POST["id"]);
        $passwordActual = $usuarioActual["password"];
        $firmaActual = $usuarioActual["firma"];

        // Verificar si el directorio existe, si no, crearlo
        if (!file_exists($directorio)) {
            mkdir($directorio, 0755, true);
        }

        // Verificar si se ha subido un nuevo archivo de firma
        if (!empty($_FILES['firma']['name'])) {
            $archivo = $_FILES['firma'];
            $nombreArchivo = $archivo['name'];
            $rutaArchivo = $directorio . basename($nombreArchivo);

            // Mover el archivo cargado al directorio
            if (move_uploaded_file($archivo['tmp_name'], $rutaArchivo)) {
                $firma = $rutaArchivo; // Guardamos la nueva firma
            } else {
                echo '<script>
                    Swal.fire(
                        "ERROR!",
                        "No se pudo mover el archivo al servidor.",
                        "error"
                    );
                </script>';
                return;
            }
        } else {
            $firma = $firmaActual; // Mantener la firma actual si no se sube una nueva
        }

        // Si el campo de contraseña no está vacío, se encripta, si no, se mantiene la actual
        if (!empty($_POST["password"])) {
            $password = crypt($_POST["password"], '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');
        } else {
            $password = $passwordActual; // Mantener la contraseña actual
        }

        // Datos para el modelo
        $tabla = "usuarios";
        $datos = array(
            "id" => $_POST["id"],
            "nombre" => $_POST["nombre"],
            "firma" => $firma, // Se mantiene la firma actual si no se subió una nueva
            "password" => $password // Se mantiene la contraseña si no se ingresó una nueva
        );

        // Llamar al modelo
        $respuesta = ModeloPerfiles::mdlActualizarPerfil($tabla, $datos);

        // Manejar la respuesta del modelo
        if ($respuesta == "ok") {
            echo '<script>
                Swal.fire(
                    "Guardado!",
                    "Se actualizó el perfil correctamente",
                    "success"
                ).then(function() {
                    document.getElementById("").reset();
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
    }
}

	
}
