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
            case 'empresas':
                $this->mostrarTabla($item, $valor, "empresas");
                break;
        }
    }

    private function mostrarTabla($item, $valor, $consulta)
    {
        $empresas = ControladorEmpresa::ctrMostrarEmpresa($consulta);
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
                $editar = "<button type='button' class='btn btn-outline-info' 
              data-id='{$s["id"]}' 
              data-dv='{$s["dv"]}' 
              data-nombre='{$s["NombreEmpresa"]}' 
              data-direccion='{$s["DireccionEmpresa"]}' 
              data-ciudad='{$s["ciudad"]}' 
              data-telefono='{$s["Telefono"]}' 
              data-telefono2='{$s["telefono2"]}' 
              data-nombre-rep='{$s["nombre_rep_legal"]}' 
              data-correo='{$s["correoElectronico"]}' 
              data-toggle='modal' 
              data-target='#modal-editempresa'>Editar</button>";

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
                    $editar,
                    $asignar

                ];
            default:
                return null;
        }
    }
}

// Inicialización y llamada a la función para mostrar la tabla
$activarEmpresas = new TablaEmpresas();
$activarEmpresas->mostrarTablaEmpresas();
