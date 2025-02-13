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
}
