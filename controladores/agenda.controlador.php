<?php
class ControladorAgenda {
    static public function ctrCrearEvento() {
        if (isset($_POST['title'])) {
            $datos = array(
                "title" => $_POST['title'],
                "start" => $_POST['start'],
                "end" => $_POST['end'] ?? null,
                "backgroundColor" => $_POST['backgroundColor'],
                "borderColor" => $_POST['borderColor'],
                "textColor" => $_POST['textColor'],
                "allDay" => $_POST['allDay']
            );
    
            $respuesta = ModeloAgenda::mdlGuardarEvento($datos);
    
            if ($respuesta == "ok") {
                echo json_encode(['status' => 'success']);
            } else {
                echo json_encode(['status' => 'error', 'message' => 'Error al guardar el evento.']);
            }
        }
    }

    static public function ctrEliminarEvento() {
        if (isset($_POST['id'])) {
            $id = $_POST['id'];
            $respuesta = ModeloAgenda::mdlEliminarEvento($id);
    
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
        }
    }
}

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
?>
