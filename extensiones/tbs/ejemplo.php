<?php
    // Incluyendo las librerías necesarias
    require_once('tbs_class.php'); // Clase TBS
    require_once('plugins/tbs_plugin_opentbs.php'); // Plugin OpenTBS

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
?>
