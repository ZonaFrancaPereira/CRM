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

    public static function ctrDescargarArchivoWord($idArchivo,$idEmpresa) {
        // Obtener el archivo desde la base de datos
        $archivo = ModeloArchivo::mdlObtenerArchivo($idArchivo);
    
        if ($archivo) {
                // Crear una instancia de TinyButStrong (TBS)
    $TBS = new clsTinyButStrong; 
    // Instalar el plugin OpenTBS
    $TBS->Plugin(TBS_INSTALL, OPENTBS_PLUGIN); 
    
    // Definir los parámetros que se van a fusionar con el documento
    $nomprofesor = 'Anderson Code';
    $fechaprofesor = '04/06/2020';
    $firmadecano = 'firma.png'; // Asegúrate de que la imagen esté en el mismo directorio o proporciona la ruta correcta
    
    // Cargar la plantilla de Word (asegúrate de que la plantilla esté en la ruta especificada)
    $template = 'Plantilla_Colegiado.docx';
    $TBS->LoadTemplate($template, OPENTBS_ALREADY_UTF8);
    
    // Fusionar los campos de texto con la plantilla
    $TBS->MergeField('pro.nomprofesor', $nomprofesor); // Asocia el campo con los datos
    $TBS->MergeField('pro.fechaprofesor', $fechaprofesor);
    
    // Asignar una variable de referencia para la firma (si tienes un marcador que se usa en el documento)
    $TBS->VarRef['x'] = $firmadecano;

    // Eliminar los comentarios en la plantilla (esto es opcional)
    $TBS->PlugIn(OPENTBS_DELETE_COMMENTS);

    // Definir el nombre del archivo de salida (el nombre del archivo generado)
    $save_as = (isset($_POST['save_as']) && (trim($_POST['save_as'])!=='') && ($_SERVER['SERVER_NAME']=='localhost')) ? trim($_POST['save_as']) : '';
    $output_file_name = str_replace('.', '_'.date('Y-m-d').$save_as.'.', $template);
    
    // Descargar el archivo o guardarlo según la opción seleccionada
    if ($save_as === '') {
        // Descargar directamente el archivo al navegador
        $TBS->Show(OPENTBS_DOWNLOAD, $output_file_name); 
        exit();
    } else {
        // Guardar el archivo en el servidor
        $TBS->Show(OPENTBS_FILE, $output_file_name);
        exit("El archivo [$output_file_name] ha sido creado.");
    }
        } else {
            //echo json_encode(['error' => 'No se encontró el archivo.']);
        }
    }
}
    // Verifica si se ha solicitado la descarga
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] == 'descargarArchivoWord') {
        $idArchivo = $_POST['idArchivo'];
        $idEmpresa = $_POST['idEmpresa'];
        ControladorArchivo::ctrDescargarArchivoWord($idArchivo, $idEmpresa);
    }
    


?>