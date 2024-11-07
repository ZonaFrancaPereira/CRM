<?php
require_once "../controladores/empresa.controlador.php";
require_once "../modelos/empresa.modelo.php";
session_start();

class TablaEmpresas
{

    public function mostrarTablaEmpresas()
    {
        $especifico = isset($_POST['especifico']) ? $_POST['especifico'] : '';
        $item = 'id_usuario_fk';
        $valor = $_SESSION['id'];

        switch ($especifico) {
            case 'usuario':
                $this->mostrarTabla($item, $valor, "usuario");
                break;
        }
    }

    private function mostrarTabla($item, $valor, $consulta)
    {
        $empresas = ControladorEmpresa::ctrMostrarEmpresaAsignada($consulta);
        $data = [];

        foreach ($empresas as $s) {
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
            case 'empresas':
              
                $asignar = "<button type='button' class='btn btn-outline-info' data-id='{$s["id"]}' data-toggle='modal' data-target='#modal-asignarempresa'>Asignar</button>";
                return [
                    $s["id"],
                    $s["dv"],
                    $s["NombreEmpresa"],
                    $s["DireccionEmpresa"],
                    $s["ciudad"],
                    $s["Telefono"],
                    $s["telefono2"],
                    $s["nombre_rep_legal"],
                    $s["correoElectronico"],
                    $s["id_usuario_fk"],
                    $asignar

                ];

            case 'usuario':
                $perfil = "<a target='_blank' class='btn btn-outline-warning' href='index.php?ruta=perfil&id={$s["id"]}'>Perfil</a>";
                if ($s["id_usuario_fk"] !== $_SESSION['id']) return null;
                return [
                    $s["id"],
                    $s["NombreEmpresa"],
                    $s["DireccionEmpresa"],
                    $s["Telefono"],
                    $s["nombre_rep_legal"],
                    $s["correoElectronico"],
                    $perfil
                ];
            default:
                return null;
        }
    }
}

// Inicialización y llamada a la función para mostrar la tabla
$activarEmpresas = new TablaEmpresas();
$activarEmpresas->mostrarTablaEmpresas();
