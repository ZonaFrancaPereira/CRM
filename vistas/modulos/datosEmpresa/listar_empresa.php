<?php
if ($_SESSION["datosEmpresa"] == "off") {
    echo '<script>window.location = "inicio";</script>';
    return;
}
?>
<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-12 col-sm-6"></div>
            <div class="col-12 col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="inicio">Inicio</a></li>
                    <li class="breadcrumb-item active">ACPM</li>
                </ol>
            </div>
        </div>
    </div>
</section>

<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header bg-info">
                        <h3 class="card-title">Empresas</h3>
                    </div>
                    <div class="card-body">

                        <div class="tab-pane show" id="">
                            <div class="row">
                                <div class="col-12">
                                    <div class="card">
                                        <div class="card-body table-responsive p-0">
                                            <table class="display table table-striped table-valign-middle" width="100%">
                                                <thead>
                                                    <tr>
                                                        <th style="width:10px">Nit</th>
                                                        <th>Nombre</th>
                                                        <th>Dirección</th>
                                                        <th>Ciudad</th>
                                                        <th>Teléfono</th>
                                                        <th>Nombre Representante Legal</th>
                                                        <th>Correo Electrónico</th>
                                                        <th>Usuario Asignado</th>
                                                        <th>Asignar</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    $item = null;
                                                    $valor = null;

                                                    $empresas = ControladorEmpresa::ctrMostrarEmpresa($item, $valor);

                                                    foreach ($empresas as $key => $value) {

                                                        echo '<tr>
                                                            <td>' . $value["id"] . '</td>
                                                            <td>' . $value["NombreEmpresa"] . '</td>
                                                            <td>' . $value["DireccionEmpresa"] . '</td>
                                                            <td>' . $value["ciudad"] . '</td>
                                                            <td>' . $value["Telefono"] . '</td>
                                                            <td>' . $value["nombre_rep_legal"] . '</td>
                                                            <td>' . $value["correoElectronico"] . '</td>
                                                            <td>' . $value["id_usuario_fk"] . '</td>
                                                            <td>
                                                                <div class="btn-group">
                                                                    <button type="button" class="btn btn-outline-info" data-id="' . $value["id"] . '" data-toggle="modal" data-target="#modal-asignarempresa">Asignar</button>
                                                                </div>
                                                            </td>
                                                        </tr>';
                                                    }
                                                    ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="modal fade" id="modal-asignarempresa" tabindex="-1" role="dialog" aria-labelledby="modalAsignarempresaLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header bg-dark text-white">
                                        <h5 class="modal-title" id="modalAsignarempresaLabel">Asignar Empresa</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form id="formAsignarEmpresa" method="POST" enctype="multipart/form-data">
                                            <div class="form-group">
                                                <label for="id_asignar">NIT Empresa</label>
                                                <input type="text" class="form-control" id="id_asignar" name="id_asignar" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="">Asignar Empresa</label>
                                                <input list="usuarios" id="id_usuario_fk_empresa" name="id_usuario_fk_empresa" class="form-control" placeholder="Nombre del responsable" required>
                                                <datalist id="usuarios">
                                                    <?php
                                                    if ($usuario["id"] <> 0) {
                                                        echo '<option value="' . $value["id"] . '"> ' . $value["nombre"] . ' ' . $value["apellidos_usuario"] . ' </option>';
                                                    }
                                                    $item = null;
                                                    $valor = null;
                                                    $usuario = ControladorUsuarios::ctrMostrarUsuarios($item, $valor);
                                                    foreach ($usuario as $key => $value) {
                                                        echo '<option value="' . $value["id"] . '"> ' . $value["nombre"] . ' ' . $value["apellidos_usuario"] . ' </option>';
                                                    }
                                                    ?>
                                                </datalist>
                                            </div>
                                            <button type="submit" class="btn btn-primary" name="asignar_empresa" id="asignar_empresa">Asignar Empresa</button>

                                            <?php
                                            $AsignarEmpresa = new ControladorEmpresa();
                                            $AsignarEmpresa->ctrAsignarEmpresa();
                                            ?>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
