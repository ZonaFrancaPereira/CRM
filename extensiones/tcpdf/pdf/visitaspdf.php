<?php
require_once "../../../configuracion.php";
require_once "../../../controladores/empresa.controlador.php";
require_once "../../../modelos/empresa.modelo.php";
require_once "../../../controladores/usuarios.controlador.php";
require_once "../../../modelos/usuarios.modelo.php";
require_once('tcpdf_include.php');

// Obtener el ID de mantenimiento desde la URL
$id_visita = $_GET['id'];

// Obtener los datos del mantenimiento desde la base de datos
$tabla = 'registro_visitas'; // Nombre de la tabla o configuración
$item = 'id_visita'; // Campo por el cual filtrar
$valor = $id_visita; // Valor para filtrar
$consulta = 'registro_visitas';

// Llamar a la función para obtener los datos
$datos = ModeloEmpresas::mdlMostrarVisitasPdf($tabla, $item, $valor, $consulta);

// Verificar si se obtuvieron datos
if (empty($datos)) {
    die('No se encontraron datos para formato');
}

// Crear una instancia de TCPDF
$pdf = new TCPDF('P', 'mm', 'A4', true, 'UTF-8', false);

// Configurar la información del documento
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Zona Franca Internacional de Pereira');
$pdf->SetTitle('Formato de Inspección');
$pdf->SetSubject('Detalles de la Inspección');

// Eliminar las líneas de encabezado y pie de página
$pdf->setPrintHeader(false);
$pdf->setPrintFooter(false);

// Establecer los márgenes
$pdf->SetMargins(15, 15, 15);
$pdf->SetAutoPageBreak(TRUE, 10);


// Establecer la fuente a una que soporte caracteres Unicode
$pdf->SetFont('dejavusans', '', 10, '', true);

// Establecer el tipo de letra predeterminado
$pdf->SetFont('helvetica', '', 10);

// Añadir una página
$pdf->AddPage();

// Obtener la información del primer registro
$row = $datos[0];


// Asignar variables para el contenido del PDF
$id_registro_visita = $row["id_visita"];
$id_empresa_fk = $row["id_empresa_fk"];
$NombreEmpresa = $row["NombreEmpresa"];
$fecha_visita = $row["fecha_visita"];
$hora_inicio = date("g:i A", strtotime($row["hora_inicio"]));
$hora_fin = date("g:i A", strtotime($row["hora_fin"]));
$actividades_realizadas = $row["actividades_realizadas"];
$cc_cliente = $row["cc_cliente"];
$nombre_cliente = $row["nombre_cliente"];
$firma_consultor = $row["firma_consultor"];

//TRAER LOS DATOS Y FIRMA DE QUIEN REALIZO LA VISITA
                $item = "id";
                $valor = $firma_consultor;

                $usuarios = ControladorUsuarios::ctrMostrarUsuariosPdf($item, $valor);

                foreach ($usuarios as $key => $value) {
                    $cc_contador = $value["id"];
                        $nombre_contador = $value["nombre"];
                        $apellidos_contador = $value["apellidos"];
                        $firma_usuario = $value["firma"];
                    
                }

$nombreImagen = "images/logoservicontable.png";
$imagenBase64 = "data:image/png;base64," . base64_encode(file_get_contents($nombreImagen));
//$baseUrl = "https://beta.zonafrancadepereira.com/"; // Cambia esto según sea necesario para tu entorno de hosting
$baseUrl = "/CRM/";


//$rutaRelativa = $row["firma_recibido"];

// Construct the full URL
//$firma_recibido = $baseUrl . $rutaRelativa;

$rutaFirmaCliente = $row["firma_cliente"];

// Construct the full URL
$firma_consultor = $baseUrl . $firma_usuario;
$firma_cliente = $baseUrl . $rutaFirmaCliente;
// Construct the full URL
//$firma_recibido = $baseUrl . $rutaRelativa;

// Construcción del contenido HTML
$html = <<<EOF
<style>
    .title {
        text-align: center;
        font-size: 18px;
        font-weight: bold;
        margin-bottom: 15px;
        color: #004080;
    }
    .section-title {
        font-weight: bold;
        background-color: #004080;
        color: #ffffff;
        text-align: center;
        padding: 5px;
        margin-top: 20px;
    }
    .content-table {
        border-collapse: collapse;
        width: 100%;
        margin-top: 10px;
    }
    .content-table th, .content-table td {
        border: 1px solid #004080;
        padding: 8px;
        text-align: left;
    }
    .content-table th {
        background-color: #004080;
        color: #ffffff;
    }
    .content-table td {
        background-color: #f2f2f2;
    }
    .content-encabezado {
        border-collapse: collapse;
        width: 100%;
        margin-top: 10px;
        text-align: center;
    }
    .content-encabezado th, .content-encabezado td {
        font-weight: bold;
        border: 1px solid #004080;
        padding: 8px;
        text-align: center;
    }
    .content-encabezado th {
        background-color: #004080;
        color: #ffffff;
    }
    .external-border-table {
        border: 1px solid #004080;
        width: 100%;
    }
    .external-border-table th {
        padding: 10px;
        text-align: center;
    }
</style>

<!-- Encabezado -->

<table class="content-encabezado">
    <tr>
        <th><img src="$imagenBase64" alt="Logo" width="50"></th>
        <th>ACTA DE VISITA Y COMPROMISOS</th>
        <th>Versión: 2</th>
        <th>Fecha: 01/10/2023</th>
    </tr>
</table>
<!-- Información del Cliente -->
<div class="section-title">CLIENTE</div>
<table class="content-table">
    <tr>
        <td><B>NIT:</B> $id_empresa_fk | $NombreEmpresa </td>
        <td>Fecha: $fecha_visita</td>
    </tr>
    <tr>
        <td>Hora Inicio: $hora_inicio</td>
        <td>Hora Fin: $hora_fin</td>
    </tr>
</table>
<br>
EOF;

// Consultar las actividades relacionadas con el ACPM
try {
    $stmt2 = Conexion::conectar()->prepare('SELECT * FROM detalle_actividades a INNER JOIN registro_visitas b ON a.id_visita_fk = b.id_visita WHERE b.id_visita = :id_registro_visita');
    $stmt2->bindParam(':id_registro_visita', $id_registro_visita, PDO::PARAM_INT);
    $stmt2->execute();

    if ($stmt2->rowCount() > 0) {
        $html .= <<<EOF
        <div class="section-title">ACTIVIDADES REALIZADAS</div>
        <table class="content-table">
EOF;

        while ($row2 = $stmt2->fetch()) {
            $actividades_realizadas = $row2['actividades_realizadas'];
            $html .= "<tr><td>$actividades_realizadas</td></tr>";
        }

        $html .= "</table>";
    }
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}

// Consultar los compromisos relacionados con el ACPM
try {
    $stmt3 = Conexion::conectar()->prepare('SELECT a.*, c.* FROM detalle_compromiso a INNER JOIN registro_visitas b ON a.id_visita_fk = b.id_visita INNER JOIN usuarios c ON a.id_responsable_fk = c.id WHERE b.id_visita = :id_registro_visita');
    $stmt3->bindParam(':id_registro_visita', $id_registro_visita, PDO::PARAM_INT);
    $stmt3->execute();

    if ($stmt3->rowCount() > 0) {
        $html .= <<<EOF
        <br>
        <div class="section-title">COMPROMISOS</div>
        <table class="content-table">
            <tr>
                <th><strong>Fecha Proyectada</strong></th>
                <th><strong>Descripción</strong></th>
                <th><strong>Responsable</strong></th>
                <th><strong>Observaciones</strong></th>
            </tr>
EOF;

        while ($row3 = $stmt3->fetch()) {
            $fecha_proyectada = $row3['fecha_proyectada'];
            $descripcion_compromiso = $row3['descripcion_compromiso'];
            $nombre = $row3['nombre'];
            $apellidos_usuario = $row3['apellidos_usuario'];
            $observaciones_compromiso = $row3['observaciones_compromiso'];

            $html .= "<tr>
                        <td>$fecha_proyectada</td>
                        <td>$descripcion_compromiso</td>
                        <td>$nombre $apellidos_usuario</td>
                        <td>$observaciones_compromiso</td>
                      </tr>";
        }

        $html .= "</table>";
    }
} catch (PDOException $e) {
    die('Error al consultar los compromisos: ' . $e->getMessage());
} finally {
    $stmt2 = null;
    $stmt3 = null;
}
$html .= <<<EOF
   <br>
    <div class="section-title">FIRMA CONTADOR</div>
    <table class="content-table">
        <tr>
            <th>Nombre</th>
            <td>$nombre_contador $apellidos_contador</td>
            <th>CC</th>
            <td>$cc_contador</td>
        </tr>

    <tr>
        <td colspan="4" class="signature" style="text-align: center;">
            <div>
                <b>FIRMA</b>
            </div>
            <div>
                <img src="$firma_consultor" alt="Firma" width="120" style="margin-left: 50px;">
            </div>
        </td>
    </tr>

    </table>

        <br>
    <div class="section-title">FIRMA DE RECIBIDO</div>
    <table class="content-table">
        <tr>
            <th>Nombre</th>
            <td>$nombre_cliente</td>
            <th>CC</th>
            <td>$cc_cliente</td>
        </tr>

    <tr>
        <td colspan="4" class="signature" style="text-align: center;">
            <div>
                <b>FIRMA</b>
            </div>
            <div>
            <center>
                <img src="$firma_cliente" alt="Firma" width="120" style="margin-center: 50px;">
                </center>
            </div>
        </td>
    </tr>

    </table>



<table class="content-table">
    <tr>
        <th colspan="5"><p style="text-align: justify;">Al registrar y entregar sus datos personales mediante este mecanismo de recolección de información, 
    usted declara que conoce nuestra política de tratamiento de datos personales disponible en: 
    <a href="" target="_blank">www.politicadeprivacidad.co</a>, 
    también declara que conoce sus derechos como titular de la información y que autoriza de manera libre, 
    voluntaria, previa, explícita, informada e inequívoca a ---
    con NIT ----- para gestionar sus datos personales bajo los parámetros indicados en dicha política de tratamiento.
</p>
</th>
    </tr>

</table>




EOF;
// Cierre del HTML
$html .= "</body></html>";

// Escribir el contenido HTML en el documento PDF
$pdf->writeHTML($html, true, false, true, false, '');

// Salida del PDF
$pdf->Output("Inspeccion_$id_inspeccion.pdf", 'I');
