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

        }
    }

    static public function ctrEliminarEvento() {
        if (isset($_POST['id'])) {
            $id = $_POST['id'];
            $respuesta = ModeloAgenda::mdlEliminarEvento($id);

            echo json_encode(['status' => $respuesta ? 'success' : 'error']);
        }
    }

    static public function ctrObtenerEventos() {
        if (isset($_GET['start']) && isset($_GET['end'])) {
            $start = $_GET['start'];
            $end = $_GET['end'];

            $eventos = ModeloAgenda::mdlObtenerEventos($start, $end);

            return $eventos;
        }
    }
}

// Aquí va el código para manejar las solicitudes AJAX
if (isset($_POST['action'])) {
    switch ($_POST['action']) {
        case 'crearEvento':
            ControladorAgenda::ctrCrearEvento();
            break;
        case 'eliminarEvento':
            ControladorAgenda::ctrEliminarEvento();
            break;
    }
} elseif (isset($_GET['action']) && $_GET['action'] == 'obtenerEventos') {
    ControladorAgenda::ctrObtenerEventos();
}
?>
