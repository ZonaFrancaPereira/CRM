<?php
session_start();  // Asegúrate de que esto esté presente

class ControladorAgenda {
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

    static public function ctrEliminarEvento() {
        if (isset($_POST['id'])) {
            $id = $_POST['id'];
            $respuesta = ModeloAgenda::mdlEliminarEvento($id);

            echo json_encode(['status' => $respuesta ? 'success' : 'error']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'ID no proporcionado']);
        }
    }

    public static function ctrObtenerEventos() {
       
        // Comprobar si la acción está definida
        if (isset($_GET['action']) && $_GET['action'] === 'obtenerEventos') {
            // Obtén los parámetros start y end
            $start = isset($_GET['start']) ? $_GET['start'] : null;
            $end = isset($_GET['end']) ? $_GET['end'] : null;
            $userId = $_SESSION["id"];
           
      
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
}
// Inicia sesión para manejar las solicitudes AJAX

// Maneja las solicitudes AJAX basadas en el parámetro de acción



if (isset($_POST['action'])) {
   
    require_once "../modelos/agenda.modelo.php"; // Incluye el modelo aquí dentro del switch

    switch ($_POST['action']) {
        case 'crearEvento':
            ControladorAgenda::ctrCrearEvento();
            break;
        case 'eliminarEvento':
            ControladorAgenda::ctrEliminarEvento();
            break;
        default:
            echo json_encode(['status' => 'error', 'message' => 'Acción no válida']);
    }
}if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Manejo para POST
} elseif ($_SERVER['REQUEST_METHOD'] === 'GET') {

   
    if (isset($_GET['action']) && $_GET['action'] === 'obtenerEventos') {
        require_once "../modelos/agenda.modelo.php"; // Incluye el modelo aquí dentro del switch
       
        ControladorAgenda::ctrObtenerEventos();
    } else {
        //echo json_encode(['status' => 'error', 'message' => 'Acción no definida']);
    }
} else {
   // echo json_encode(['status' => 'error', 'message' => 'Método no permitido']);
}
?>
