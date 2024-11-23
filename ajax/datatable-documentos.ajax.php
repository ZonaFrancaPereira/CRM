<?php
require_once "../controladores/categorias.controlador.php";
require_once "../modelos/categorias.modelo.php";
session_start();

class TablaDocumentos
{

    public function mostrarTablaDocumentos()
    {
        $especifico = isset($_POST['especifico']) ? $_POST['especifico'] : '';
        $item = 'id_usuario_fk';
        $valor = $_SESSION['id'];

        switch ($especifico) {
            case 'documentos-empresas':
                $this->mostrarTabla($item, $valor, "documentos-empresas");
                break;
        }
    }

    private function mostrarTabla($item, $valor, $consulta)
    {
        $documentos = ControladorCategorias::ctrMostrarArchivosEmpresa($consulta);
        $data = [];

        foreach ($documentos as $s) {
            $columns = $this->prepararDatos($s, $consulta);
            if ($columns) {
                $data[] = $columns;
            }
        }

        echo json_encode(["data" => $data]);
    }

    private function prepararDatos($s, $consulta)
    {
        switch ($consulta) {
            case 'documentos-empresas':
              
                $fecha = "<button type='button' 
                  class='btn btn-outline-info' 
                  data-id_archivos='{$s["id_archivos"]}' 
                  data-toggle='modal' 
                  data-target='#modal-fechadocumentos'>Asignar</button>";

                return [
                    $s["id_archivos"],
                    $s["id_empresa_fk"],
                    $s["NombreEmpresa"],
                    $s["nombre_categoria"],
                    $s["nombre_archivo"],
                    $s["tipo_archivo_empresa"],
                    $s["estado_archivo"],
                    $s["fecha_archivo"],
                    $fecha
                    
                ];

         
            default:
                return null;
        }
    }
}

// Inicialización y llamada a la función para mostrar la tabla
$activarDocumentos = new TablaDocumentos();
$activarDocumentos->mostrarTablaDocumentos();
