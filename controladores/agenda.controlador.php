<?php
session_start();  // Asegúrate de que esto esté presente

class ControladorAgenda {
    /* =============================================
     CREAR EVENTO
     ============================================= */
    static public function ctrCrearEvento() {
        if (isset($_POST['title']) && isset($_POST['start'])) {
            $datos = array(
                "title" => $_POST['title'],
                "start" => $_POST['start'],
                "end" => isset($_POST['end']) ? $_POST['end'] : null, // Manejo opcional de 'end'
                "backgroundColor" => $_POST['backgroundColor'],
                "borderColor" => $_POST['borderColor'],
                "textColor" => $_POST['textColor'],
                "allDay" => isset($_POST['allDay']) ? 1 : 0,
                "id_usuario_fk" => $_POST['id_usuario_fke']
            );
    
            $respuesta = ModeloAgenda::mdlGuardarEvento($datos);

            echo json_encode(['status' => $respuesta ? 'success' : 'error']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Datos incompletos']);
        }
    }
    /* =============================================
     ELIMINAR EVENTO
    ============================================= */
    static public function ctrEliminarEvento() {
        if (isset($_POST['id'])) {
            $id = $_POST['id'];
            $respuesta = ModeloAgenda::mdlEliminarEvento($id);

            echo json_encode(['status' => $respuesta ? 'success' : 'error']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'ID no proporcionado']);
        }
    }
    /*=============================================
     OBTENER EVENTOS DEL USUARIO QUE INICIA SESION
    ============================================= */
    public static function ctrObtenerEventos() {
       
        // Comprobar si la acción está definida
        if (isset($_GET['action']) && $_GET['action'] === 'obtenerEventos') {
            // Obtén los parámetros start y end
            $start = isset($_GET['start']) ? $_GET['start'] : null;
            $end = isset($_GET['end']) ? $_GET['end'] : null;

            $userId = isset($_GET['id_usuario_fk']) ? intval($_GET['id_usuario_fk']) : (isset($_SESSION["id"]) ? $_SESSION["id"] : 0);
           
      
            // Llama al modelo para obtener los eventos en el rango de fechas
            $eventos = ModeloAgenda::mdlObtenerEventos($start, $end,$userId);

            // Crear un array para almacenar los eventos formateados
            $eventosFormateados = [];

            foreach ($eventos as $evento) {
                // Asegúrate de que los datos tengan la estructura correcta
                $eventosFormateados[] = [
                    'id' => $evento['id'], // ID del evento
                    'title' => $evento['empresa_nombre'], // Título del evento
                    'start' => $evento['start2'], // Fecha de inicio
                    'end' => $evento['end2'], // Fecha de finalización (si está disponible)
                    'backgroundColor' => $evento['background_color'], // Color de fondo
                    'borderColor' => $evento['border_color'], // Color del borde
                    'textColor' => $evento['text_color'], // Color del texto
                    'allDay' => $evento['allDay'] // Indicador de día completo
                ];
            }

            // Devuelve los eventos formateados en formato JSON
            echo json_encode($eventosFormateados);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Acción no definida']);
        }
    }
     /* =============================================
     OBTENER EVENTOS DE TODOS LOS USUARIOS
    ============================================= */
    public static function ctrObtenerEventosU() {
       
        // Comprobar si la acción está definida
        if (isset($_GET['action']) && $_GET['action'] === 'obtenerEventosU') {
            // Obtén los parámetros start y end
            $start = isset($_GET['start']) ? $_GET['start'] : null;
            $end = isset($_GET['end']) ? $_GET['end'] : null;
            $userId = isset($_GET['usuario']) ? intval($_GET['usuario']) : 0;           
      
            // Llama al modelo para obtener los eventos en el rango de fechas
            $eventos = ModeloAgenda::mdlObtenerEventosU($start, $end,$userId);

            // Crear un array para almacenar los eventos formateados
            $eventosFormateados = [];

            foreach ($eventos as $evento) {
                // Asegúrate de que los datos tengan la estructura correcta
                $eventosFormateados[] = [
                    'id' => $evento['id'], // ID del evento
                    'title' => $evento['empresa_nombre'], // Título del evento
                    'nombre_usuario' => $evento['nombre'], // Nombre_usuario
                    'apellidos_usuario' => $evento['apellidos_usuario'], // Apellidos Usuario
                    'start' => $evento['start2'], // Fecha de inicio
                    'end' => $evento['end2'], // Fecha de finalización (si está disponible)
                    'backgroundColor' => $evento['background_color'], // Color de fondo
                    'borderColor' => $evento['border_color'], // Color del borde
                    'textColor' => $evento['text_color'], // Color del texto
                    'allDay' => $evento['allDay'] // Indicador de día completo
                ];
            }

            // Devuelve los eventos formateados en formato JSON
            echo json_encode($eventosFormateados);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Acción no definida']);
        }
    }
    /* =============================================
     EDITAR LOS EVENTOS
    ============================================= */
    static public function ctrEditarEvento() {
        if (isset($_POST['id']) && isset($_POST['title']) && isset($_POST['start']) && isset($_POST['end'])) {
            $datos = array(
                "id" => $_POST['id'],
                
                "start" => $_POST['start'],
                "end" => $_POST['end'],
                "backgroundColor" => $_POST['backgroundColor'],
                "borderColor" => $_POST['borderColor'],
                "textColor" => $_POST['textColor'],
                "allDay" => isset($_POST['allDay']) ? 1 : 0,
                "id_usuario_fk" => $_POST['id_usuario_fk']
            );
    
            $respuesta = ModeloAgenda::mdlEditarEvento($datos);
    
            echo json_encode(['status' => $respuesta ? 'success' : 'error']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Datos incompletos']);
        }
    }
    
}
// Inicia sesión para manejar las solicitudes AJAX
// Asegúrate de que este archivo se ejecute cuando el método de la solicitud sea POST o GET.
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Si es POST, verificamos la acción
    if (isset($_POST['action'])) {
        require_once "../modelos/agenda.modelo.php";  // Incluimos el modelo aquí

        // Realizamos las acciones según el valor de 'action'
        switch ($_POST['action']) {
            case 'crearEvento':
                ControladorAgenda::ctrCrearEvento();
                break;
            case 'eliminarEvento':
                ControladorAgenda::ctrEliminarEvento();
                break;
                case 'editarEvento':
                    ControladorAgenda::ctrEditarEvento();
                    break;
            default:
                echo json_encode(['status' => 'error', 'message' => 'Acción no válida']);
                break;
        }
    } else {
        echo json_encode(['status' => 'error', 'message' => 'No se recibió ninguna acción para procesar.']);
    }
    
} elseif ($_SERVER['REQUEST_METHOD'] === 'GET') {
    // Si es GET, verificamos qué acción se solicita
    if (isset($_GET['action'])) {
        require_once "../modelos/agenda.modelo.php";  // Incluimos el modelo aquí

        // Realizamos las acciones según el valor de 'action'
        switch ($_GET['action']) {
            case 'obtenerEventos':
                ControladorAgenda::ctrObtenerEventos();
                break;
            case 'obtenerEventosU':
                ControladorAgenda::ctrObtenerEventosU();
                break;
            default:
                echo json_encode(['status' => 'error', 'message' => 'Acción no definida']);
                break;
        }
    } else {
        //echo json_encode(['status' => 'error', 'message' => 'No se recibió ninguna acción para procesar.']);
    }

} else {
    //echo json_encode(['status' => 'error', 'message' => 'Método no permitido']);
}

?>
