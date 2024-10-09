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

   
    public static function ctrHandleRequest() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action'])) {
            switch ($_POST['action']) {
                case 'descargarArchivoWord':
                    $idArchivo = $_POST['idArchivo'];
                    $idEmpresa = $_POST['idEmpresa'];
                    self::ctrDescargarArchivoWord($idArchivo, $idEmpresa);
                    break;

                // Otros casos según sea necesario...

                default:
                    echo json_encode(['error' => 'Acción no válida']);
                    break;
            }
        } else {
            echo json_encode(['error' => 'Método no permitido']);
        }
    }

    public static function ctrDescargarArchivoWord($idArchivo) {
        // Obtener el archivo desde la base de datos
        $archivo = ModeloArchivo::mdlObtenerArchivo($idArchivo);

        if ($archivo) {
            // La ruta absoluta del archivo en el servidor local (XAMPP en Windows)
            $rutaArchivo = $_SERVER['DOCUMENT_ROOT'] . '/CRM/' . $archivo["archivo_e"];
            // Verificar si el archivo existe en el servidor
            if (file_exists($rutaArchivo)) {
                // Limpia cualquier salida previa
                ob_clean(); // Limpia el buffer de salida
                flush(); // Libera el sistema de salida

                // Configura las cabeceras para la descarga
                header('Content-Description: File Transfer');
                header('Content-Type: application/vnd.openxmlformats-officedocument.wordprocessingml.document');
                header('Content-Disposition: attachment; filename="' . basename($archivo["archivo_e"]) . '"');
                header('Expires: 0');
                header('Cache-Control: must-revalidate');
                header('Pragma: public');
                header('Content-Length: ' . filesize($rutaArchivo));

                // Enviar el archivo al navegador para su descarga
                readfile($rutaArchivo);
                exit;
            } else {
                echo json_encode(['error' => 'El archivo no existe en el servidor.']);
            }
        } else {
            echo json_encode(['error' => 'No se encontró el archivo.']);
        }
    }
}

// Manejar la solicitud
ControladorArchivo::ctrHandleRequest();
?>