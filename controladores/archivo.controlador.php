<?php
     // Incluyendo las librerías necesarias
   // Incluyendo las librerías necesarias
   require_once(__DIR__ . '/../extensiones/tbs/tbs_class.php');
   require_once(__DIR__ . '/../extensiones/tbs/plugins/tbs_plugin_opentbs.php');
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
        $tabla = "datosempresa";
        $datosArchivo = ModeloArchivo::mdlObtenerArchivo($idArchivo);
        $datosEmpresa = ModeloEmpresas::mdlMostraEmpresaid($tabla, $idEmpresa);
    
        // Verifica si los datos se obtuvieron correctamente
        if ($datosArchivo && $datosEmpresa) {
            // Asignar la ruta del archivo
            // Si el campo 'archivo_e' solo tiene el nombre del archivo
            $rutaArchivo = $datosArchivo['archivo_e']; 
    
            // Comprobar si el archivo existe
            if (file_exists($rutaArchivo)) {
                // Forzar la descarga
                header('Content-Description: File Transfer');
                header('Content-Type: application/octet-stream');
                header('Content-Disposition: attachment; filename="' . basename($rutaArchivo) . '"');
                header('Expires: 0');
                header('Cache-Control: must-revalidate');
                header('Pragma: public');
                header('Content-Length: ' . filesize($rutaArchivo));
                flush(); // Limpiar el buffer del sistema
                readfile($rutaArchivo);
                exit; // Termina el script
            } else {
                echo 'Error: El archivo no existe.';
            }
        } else {
            echo 'Error: No se pudieron obtener los datos necesarios.';
        }
    }
    



}
?>