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
            <div class="col-sm-6"></div>
            <div class="col-sm-6">
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
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header bg-info">
                        <h3 class="card-title">EMPRESAS ASIGNADAS </h3>
                    </div>
                    <div class="card-body">
                        <table id="tabla-usuario" class="table table-bordered table-striped dt-responsive" width="100%">
                            <thead class="bg-dark">
                                <tr>
                                <th>Nit</th>
                                    <th>Nombre</th>
                                    <th>Dirección</th>
                                    <th>Teléfono</th>
                                    <th>Nombre Representante Legal</th>
                                    <th>Correo Electrónico</th>
                                    <th>Perfil</th>
                                </tr>
                            </thead>
                        </table>

                        <div class="modal fade" id="modal-perfil" tabindex="-1" role="dialog" aria-labelledby="modalPerfilLabel" aria-hidden="true">
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
                                                        echo '<option value="' . $value["id"] . '"> ' . $value["nombre"] . $value["apellidos_usuario"] . ' </option>';
                                                    }
                                                    $item = null;
                                                    $valor = null;
                                                    $usuario = ControladorUsuarios::ctrMostrarUsuarios($item, $valor);
                                                    foreach ($usuario as $key => $value) {
                                                        echo '<option value="' . $value["id"] . '"> ' . $value["nombre"] . $value["apellidos_usuario"] . ' </option>';
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
