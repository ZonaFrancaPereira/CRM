<?php
session_start();  // Asegúrate de que esto esté presente

class ControladorAgenda
{
    /* =============================================
     CREAR EVENTO
     ============================================= */
    static public function ctrCrearEvento()
    {
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
    static public function ctrEliminarEvento()
    {
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
    public static function ctrObtenerEventos()
    {

        // Comprobar si la acción está definida
        if (isset($_GET['action']) && $_GET['action'] === 'obtenerEventos') {
            // Obtén los parámetros start y end
            $start = isset($_GET['start']) ? $_GET['start'] : null;
            $end = isset($_GET['end']) ? $_GET['end'] : null;

            $userId = isset($_GET['id_usuario_fk']) ? intval($_GET['id_usuario_fk']) : (isset($_SESSION["id"]) ? $_SESSION["id"] : 0);


            // Llama al modelo para obtener los eventos en el rango de fechas
            $eventos = ModeloAgenda::mdlObtenerEventos($start, $end, $userId);

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
    public static function ctrObtenerEventosU()
    {

        // Comprobar si la acción está definida
        if (isset($_GET['action']) && $_GET['action'] === 'obtenerEventosU') {
            // Obtén los parámetros start y end
            $start = isset($_GET['start']) ? $_GET['start'] : null;
            $end = isset($_GET['end']) ? $_GET['end'] : null;
            $userId = isset($_GET['usuario']) ? intval($_GET['usuario']) : 0;

            // Llama al modelo para obtener los eventos en el rango de fechas
            $eventos = ModeloAgenda::mdlObtenerEventosU($start, $end, $userId);

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
    static public function ctrEditarEvento()
    {
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
    /* =============================================
     RESTRINGIR CALENDARIO POR INTERVALO DE DIAS
    ============================================= */
    public static function ctrValidarRestriccion()
    {
        date_default_timezone_set("America/Bogota"); // Asegura la zona horaria correcta

        // Mapea los días en inglés a español
        $dias_numericos = [
            "Sunday" => 0,
            "Monday" => 1,
            "Tuesday" => 2,
            "Wednesday" => 3,
            "Thursday" => 4,
            "Friday" => 5,
            "Saturday" => 6
        ];


        $dia_actual = date("l"); // Obtiene el día en inglés
        $hora_actual = date("H:i:s");

        $dia_actual = $dias_numericos[$dia_actual]; // Convierte a número

        // Llama al modelo para verificar si hay restricción
        $restriccion = ModeloAgenda::mdlObtenerRestriccion($dia_actual, $hora_actual);

        if ($restriccion) {
            echo json_encode(["restriccion" => true, "mensaje" => "No puedes modificar eventos en este horario."]);
        } else {
            echo json_encode(["restriccion" => false]);
        }
    }

    /* =============================================
     CONFIGURAR RESTRICCIÓN
    ============================================= */
    public static function ctrMostrarRestricciones()
    {
        return ModeloAgenda::mdlMostrarRestricciones();
    }

    public static function ctrActualizarRestriccion() {
        
        if (isset($_POST['id_restriccion']) && isset($_POST['dia_inicio']) && isset($_POST['dia_fin']) && isset($_POST['estado'])) {

                $tabla = "restricciones_calendario";
                $datos = array(
                    "id_restriccion" => $_POST["id_restriccion"],
                    "dia_inicio" => $_POST["dia_inicio"],
                    "dia_fin" => $_POST["dia_fin"],
                    "estado" => $_POST["estado"]
                );

                $respuesta = ModeloAgenda::mdlActualizarRestriccion($tabla, $datos);
                	// Manejar la respuesta del modelo
			if ($respuesta == "ok") {
				echo '<script>
					Swal.fire(
						"Buen Trabajo!",
						"Se actualizó la configuración correctamente",
						"success"
					).then(function() {
						document.getElementById("form-calendario").reset();
                        window.location = ""; // Redirige a la página actual

					});
				</script>';
			} else {
				echo '<script>
					Swal.fire(
						"ERROR!",
						"Hubo un problema al guardar los datos.",
						"error"
					).then(function() {
						document.getElementById("form-calendario").reset();
                        window.location = ""; // Redirige a la página actual

					});
				</script>';
			}
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
            case 'validar':
                ControladorAgenda::ctrValidarRestriccion();
                break;
            default:
                echo json_encode(['status' => 'error', 'message' => 'Acción no válida']);
                break;
        }
    } else {
        //echo json_encode(['status' => 'error', 'message' => 'No se recibió ninguna acción para procesar.']);
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
