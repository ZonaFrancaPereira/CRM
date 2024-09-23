<?php
require_once "../../../configuracion.php";
require_once "../../../controladores/bascula.controlador.php";
require_once "../../../modelos/bascula.modelo.php";
require_once "../../../controladores/clientes.controlador.php";
require_once "../../../modelos/clientes.modelo.php";
require_once "../../../controladores/usuarios.controlador.php";
require_once "../../../modelos/usuarios.modelo.php";

class imprimirFactura
{
    public $codigo;

    public function traerImpresionFactura()
    {
        require_once('tcpdf_include.php');

        // Crear una instancia de TCPDF
        $pdf = new TCPDF('P', 'mm', array(60, 120), true, 'UTF-8', false);

        // Configurar la información del documento
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetAuthor('Zona Franca Internacional de Pereira');
        $pdf->SetTitle('Ticket de Pesaje Bascula');
        $pdf->SetSubject('Operaciones');
        $pdf->SetKeywords('Soporte de Pesaje');

        // Eliminar las líneas de encabezado y pie de página
        $pdf->setPrintHeader(false);
        $pdf->setPrintFooter(false);

        // Establecer los márgenes
        $pdf->SetMargins(2, 2, 2);

        // Establecer el espaciado entre líneas
        $pdf->SetAutoPageBreak(TRUE, 2);

        // Establecer el tipo de letra predeterminado
        $pdf->SetFont('helvetica', '', 5);

        // Añadir una página
        $pdf->AddPage();

        // Contenido del documento
        $datos = "900.311.215-6 PBX 3346000 Opción 2"; // Asegúrate de obtener este valor de la base de datos u otra fuente.
        $codigo = $this->codigo;

        $bloque1 = <<<EOF
        <div style="text-align: center;">
            <img src="images/logo_zf.jpg" height="70">
            <p>$datos</p>
            <h3>SOPORTE DE PAGO BASCULA</h3>
        </div>

        <table border="0" cellspacing="0" cellpadding="2">
            <tr>
                <td style="font-weight: bold;">Código</td>
                <td>$codigo</td>
            </tr>
            <tr>
                <td style="font-weight: bold;">Fecha</td>
                <td>2024-07-04</td>
            </tr>
            <tr>
                <td style="font-weight: bold;">Placa</td>
                <td>123ABC</td>
            </tr>
            <tr>
                <td style="font-weight: bold;">NIT /CC </td>
                <td>123456789</td>
            </tr>
            <tr>
                <td style="font-weight: bold;">N./ Razón Social</td>
                <td>Ejemplo S.A. Ejemplo S.A.Ejemplo S.A.</td>
            </tr>
            <hr>
            <tr>
                <td style="font-weight: bold;">Peso 1</td>
                <td>1000 kg</td>
            </tr>
            <tr>
                <td style="font-weight: bold;">Peso 2</td>
                <td>800 kg</td>
            </tr>
            <tr>
                <td style="font-weight: bold;">Peso Neto</td>
                <td>200 kg</td>
            </tr>
            <hr>
            <tr>
                <td style="font-weight: bold;">Valor Bruto</td>
                <td>$100.00</td>
            </tr>
            <tr>
                <td style="font-weight: bold;">Valor Impuestos</td>
                <td>$19.00</td>
            </tr>
            <tr>
                <td style="font-weight: bold;">Valor Total</td>
                <td>$119.00</td>
            </tr>
        </table>
        <hr>
        <p style="text-align: justify;"><b>NOTA:</b> Este soporte no reemplaza la factura electrónica. Si no has recibido la factura electrónica, puedes solicitarla enviando un correo a <B>facturacion@zonafrancadepereira.com</B>, incluyendo el código de este soporte de pago.</p>

    EOF;

        // Imprimir el contenido en el PDF
        $pdf->writeHTML($bloque1, true, false, true, false, '');

        // Salida del PDF
        $pdf->Output(getcwd() . '/PDF/factura' . $codigo . '.pdf', 'I');
    }
}

$factura = new imprimirFactura();
$factura->codigo = $_GET["codigo"];
$factura->traerImpresionFactura();
