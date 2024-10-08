<?php
     // Incluyendo las librerías necesarias
     require_once('extensiones/tbs/tbs_class.php'); // Clase TBS
     require_once('extensiones/tbs/plugins/tbs_plugin_opentbs.php'); // Plugin OpenTBS
class ControladorArchivo {

    // Método para crear un archivo
    static public function ctrCrearArchivo() {
        if (isset($_POST['guardar_excel'])) {  // Verifica si el formulario fue enviado

            // Validación básica del archivo
            if (isset($_FILES['archivo']) && !empty($_FILES['archivo']['tmp_name'])) {

                // Extensiones permitidas
                $extensionesPermitidas = array('application/vnd.openxmlformats-officedocument.wordprocessingml.document', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');

                // Validar tipo de archivo
                $tipoArchivo = $_FILES['archivo']['type'];

                if (in_array($tipoArchivo, $extensionesPermitidas)) {
                    // Ruta donde se guardará el archivo
                    $rutaArchivo = "vistas/archivos/" . basename($_FILES['archivo']['name']);
                    
                    // Mover el archivo al directorio de destino
                    if (move_uploaded_file($_FILES['archivo']['tmp_name'], $rutaArchivo)) {

                        // Preparar los datos a enviar al modelo
                        $datos = array(
                            "descripcion_archivo" => $_POST['descripcion_archivo'],  // Descripción del archivo
                            "tipo_archivo" => $_POST['tipo_archivo'],  // Tipo de archivo (Word o Excel)
                            "ruta" => $rutaArchivo  // Ruta del archivo guardado
                        );

                        // Llamar al modelo para guardar los datos
                        $respuesta = ModeloArchivo::mdlGuardarArchivo($datos);

                        if ($respuesta == "ok") {
                            echo '<script>
                                    Swal.fire({
                                        icon: "success",
                                        title: "¡El archivo ha sido guardado correctamente!",
                                        showConfirmButton: true,
                                        confirmButtonText: "Cerrar"
                                    }).then((result) => {
                                        if (result.isConfirmed) {
                                            window.location = "ruta_deseada";
                                        }
                                    });
                                </script>';
                        } else {
                            echo '<script>
                                    Swal.fire({
                                        icon: "error",
                                        title: "¡Hubo un error al guardar los datos del archivo!",
                                        showConfirmButton: true,
                                        confirmButtonText: "Cerrar"
                                    });
                                </script>';
                        }
                    } else {
                        echo '<script>
                                Swal.fire({
                                    icon: "error",
                                    title: "¡Error al subir el archivo!",
                                    showConfirmButton: true,
                                    confirmButtonText: "Cerrar"
                                });
                            </script>';
                    }
                } else {
                    echo '<script>
                            Swal.fire({
                                icon: "error",
                                title: "¡Solo se permiten archivos en formato Word o Excel!",
                                showConfirmButton: true,
                                confirmButtonText: "Cerrar"
                            });
                        </script>';
                }
            }
        }
    }

  

    // Método para mostrar los archivos
    static public function ctrMostrarArchivos($item, $valor) {

        $tabla = "archivos_evaluacion";  // Nombre de la tabla
        $respuesta = ModeloArchivo::mdlMostrarArchivos($tabla, $item, $valor);
        
        return $respuesta;
    }

    static public function ctrDescargarArchivoWord($idArchivo, $idEmpresa) {
        $tabla="datosempresa";
        // Obtener datos del archivo y de la empresa usando los IDs
        $datosArchivo = ModeloArchivo::mdlObtenerArchivo($idArchivo);
        $datosEmpresa = ModeloEmpresas::mdlMostraEmpresaid($tabla,$idEmpresa);

        // Verifica si los datos se obtuvieron correctamente
        if ($datosArchivo && $datosEmpresa) {
            
            echo '<script>
            Swal.fire({
                icon: "success",
                title: "¡El archivo ha sido guardado correctamente!",
                showConfirmButton: true,
                confirmButtonText: "Cerrar"
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location = "ruta_deseada";
                }
            });
        </script>';
        } else {
            echo 'Error: No se pudieron obtener los datos necesarios.';
        }
    }


}
?>