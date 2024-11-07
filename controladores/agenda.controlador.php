<?php


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
                "allDay" => isset($_POST['allDay']) ? 1 : 0
            );
    
            $respuesta = ModeloAgenda::mdlGuardarEvento($datos);
<<<<<<< HEAD
    
            if ($respuesta == "ok") {
                echo json_encode(['status' => 'success']);
            } else {
                echo json_encode(['status' => 'error', 'message' => 'Error al guardar el evento.']);
            }
=======

            echo json_encode(['status' => $respuesta ? 'success' : 'error']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Datos incompletos']);
>>>>>>> 6f5dd241682f8e54f995f7a7c3a32fd61ff1f0df
        }
    }

    static public function ctrEliminarEvento() {
        if (isset($_POST['id'])) {
            $id = $_POST['id'];
            $respuesta = ModeloAgenda::mdlEliminarEvento($id);
<<<<<<< HEAD
    
            if ($respuesta) {
                echo json_encode(['status' => 'success']);
            } else {
                echo json_encode(['status' => 'error', 'message' => 'Error al eliminar el evento.']);
            }
        }
    }

    static public function ctrObtenerEventos() {
        if (isset($_GET['start']) && isset($_GET['end'])) {
            $start = $_GET['start'];
            $end = $_GET['end'];
    
            $eventos = ModeloAgenda::mdlObtenerEventos($start, $end);
    
            echo json_encode($eventos);  // Asegurarte de devolver los eventos en formato JSON
=======

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

            // Llama al modelo para obtener los eventos en el rango de fechas
            $eventos = ModeloAgenda::mdlObtenerEventos($start, $end);

            // Crear un array para almacenar los eventos formateados
            $eventosFormateados = [];

            foreach ($eventos as $evento) {
                // Asegúrate de que los datos tengan la estructura correcta
                $eventosFormateados[] = [
                    'id' => $evento['id'], // ID del evento
                    'title' => $evento['title'], // Título del evento
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
>>>>>>> 6f5dd241682f8e54f995f7a7c3a32fd61ff1f0df
        }
    }
}
// Inicia sesión para manejar las solicitudes AJAX

// Maneja las solicitudes AJAX basadas en el parámetro de acción



<<<<<<< HEAD
// Aquí va el código para manejar las solicitudes AJAX
// Verificamos si hay una solicitud POST para crear o eliminar eventos
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Para crear un evento
    if (isset($_POST['title'])) {
        ControladorAgenda::ctrCrearEvento();

    // Para eliminar un evento
    } elseif (isset($_POST['id'])) {
        ControladorAgenda::ctrEliminarEvento();
    }

} elseif ($_SERVER['REQUEST_METHOD'] === 'GET') {
    
    // Para obtener eventos
    if (isset($_GET['action']) && $_GET['action'] == 'obtenerEventos') {
        ControladorAgenda::ctrObtenerEventos();
    }
}5
=======
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
>>>>>>> 6f5dd241682f8e54f995f7a7c3a32fd61ff1f0df
?>
