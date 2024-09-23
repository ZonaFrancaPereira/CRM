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
					"ModuloTI" => $_POST["smModuloTI"],
					"AdminUsuarios" => $_POST["smAdminUsuarios"],
					"VerUsuarios" => $_POST["smVerUsuarios"],
					"EstadoUsuarios" => $_POST["smEstadoUsuarios"],
					"AdminPerfiles" => $_POST["smAdminPerfiles"],
					"AdminMantenimientos" => $_POST["smAdminMantenimientos"],
					"InventarioEquipos" => $_POST["smInventarioEquipos"],
					"AdminSoporte" => $_POST["smAdminSoporte"],
					"SolicitudSoporte" => $_POST["smSolicitudSoporte"],
					"ConsultarSoporte" => $_POST["smConsultarSoporte"],
					"AdminAcpm" => $_POST["smAdminAcpm"],
					"CrearAcpm" => $_POST["smCrearAcpm"],
					"ConsultarAcpm" => $_POST["smConsultarAcpm"],
					"EditarAcpm" => $_POST["smEditarAcpm"],
					"EliminarAcpm" => $_POST["smEliminarAcpm"],
					"AsignarActividades" => $_POST["smAsignarActividades"],
					"ResponderActividades" => $_POST["smResponderActividades"],
					"VerActividades" => $_POST["smVerActividades"],
					"EditarActividades" => $_POST["smEditarActividades"],
					"EliminarActividades" => $_POST["smEliminarActividades"],
					"ArchivosSadoc" => $_POST["smArchivosSadoc"],
					"CarpetasSadoc" => $_POST["smCarpetasSadoc"],
					"EliminarSadoc" => $_POST["smEliminarSadoc"],
					"SolicitudCodificacion" => $_POST["smSolicitudCodificacion"],
					"ResponderCodificacion" => $_POST["smResponderCodificacion"],
					"ConsultarCodificacion" => $_POST["smConsultarCodificacion"],
					"EditarCodificacion" => $_POST["smEditarCodificacion"],
					"EliminarCodificacion" => $_POST["smEliminarCodificacion"],
					"CrearOrden" => $_POST["smCrearOrden"],
					"EditarOrden" => $_POST["smEditarOrden"],
					"EliminarOrden" => $_POST["smEliminarOrden"],
					"ConsultarOrden" => $_POST["smConsultarOrden"],
					"AdminProveedorLider" => $_POST["smAdminProveedorLider"],
					"AdminProveedorCT" => $_POST["smAdminProveedorCT"],
					"AprobacionGH" => $_POST["smAprobacionGH"],
					"AprobacionGR" => $_POST["smAprobacionGR"],
					"AprobacionCT" => $_POST["smAprobacionCT"],
					"CrearBascula" => $_POST["smCrearBascula"],
					"ConsultarBascula" => $_POST["smConsultarBascula"],
					"EditarBascula" => $_POST["smEditarBascula"],
					"BasculaProceso" => $_POST["smBasculaProceso"],
					"BasculaFact" => $_POST["smBasculaFact"],
					"ValorPesaje" => $_POST["smValorPesaje"]
				);

				$respuesta = ModeloPerfiles::mdlIngresarPerfil($tabla, $datos);

				if ($respuesta == "ok") {

					echo '<script>
							Swal.fire(
							"Buen Trabajo!",
							"El perfil ha sido registrado con éxito.",
							"success"
							).then(function() {
							$("#perfiles").addClass("active");
							tablaPerfiles.ajax.reload();
							});
						</script>
					';
				}
			} else {
				echo '<script>
						Swal.fire({
							type: "error",
							title: "¡La discrición del perfil no puede ir vacío o llevar caracteres especiales!",
							showConfirmButton: true,
							confirmButtonText: "Cerrar"

						}).then(function(result){
							if(result.value){
								$("#perfiles").addClass("active");
								tablaPerfiles.ajax.reload();
							}
						});
					</script>
				';
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
