<?php
require_once "../controladores/categorias.controlador.php";
require_once "../modelos/categorias.modelo.php";
session_start();

class TablaCategorias
{

    public function mostrarTablaCategorias()
    {
        $especifico = isset($_POST['especifico']) ? $_POST['especifico'] : '';
        $item = 'id_usuario_fk';
        $valor = $_SESSION['id'];

        switch ($especifico) {
            case 'categorias':
                $this->mostrarTabla($item, $valor, "categorias");
                break;
        }
    }

    private function mostrarTabla($item, $valor, $consulta)
    {
        $categorias = ControladorCategorias::ctrMostrarCategorias($consulta,);
        $data = [];

        foreach ($categorias as $s) {
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
            case 'categorias':

                $eliminar_categoria = "
                                        <button type='button' class='btn btn-danger font-weight-bold' style='border-radius: 5px; display: inline-flex; align-items: center; padding: 8px 12px;' data-toggle='modal' data-target='#modalEliminar' data-id='{$s["id_categoria"]}'>
                                            <i class='fas fa-trash' style='margin-right: 5px;'></i> ELIMINAR
                                        </button>";
                return [
                    $s["id_categoria"],
                    $s["nombre_categoria"],
                    "<div style='display: flex; justify-content: center;'>{$eliminar_categoria}</div>" 

                ];

            default:
                return null;
        }
    }
}

// Inicialización y llamada a la función para mostrar la tabla
$activarEmpresas = new TablaCategorias();
$activarEmpresas->mostrarTablaCategorias();
