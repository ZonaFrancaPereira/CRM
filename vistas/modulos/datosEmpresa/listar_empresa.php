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
                    <li class="breadcrumb-item active">EMPRESAS</li>
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
                    <div class="card-header bg-info" style="background: linear-gradient(135deg, #1e3c72, #2a5298);">
                        <h3 class="card-title">Empresas</h3>
                    </div>
                    <div class="card-body">

                        <div class="tab-pane show" id="empresas_listar">
                            <div class="row">
                                <div class="col-12">
                                    <div class="card">
                                        <div class="card-body table-responsive p-0">
                                            <table class="display table table-striped table-valign-middle" width="100%" style="border-radius: 10px; overflow: hidden; box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);">
                                                <thead style="background-color: #004085; color: white; text-align: center;">
                                                    <tr>
                                                        <th style="padding: 10px;">Nit</th>
                                                        <th style="padding: 10px;">Nombre</th>
                                                        <th style="padding: 10px;">Dirección</th>
                                                        <th style="padding: 10px;">Ciudad</th>
                                                        <th style="padding: 10px;">Teléfono</th>
                                                        <th style="padding: 10px;">Nombre Representante Legal</th>
                                                        <th style="padding: 10px;">Correo Electrónico</th>
                                                        <th style="padding: 10px;">Usuario Asignado</th>
                                                        <th style="padding: 10px;">Asignar</th>
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
                                                            <td>' . $value["nombre"] . '</td>
                                                            <td>
                                                                <div class="btn-group">
                                                                    <button type="button" class="btn" style="
                                                                        display: inline-block;
                                                                        border: 2px solid #f39c12; /* Borde dorado */
                                                                        color: #f39c12; /* Texto dorado */
                                                                        background-color: #004085; /* Fondo azul */
                                                                        padding: 8px 15px;
                                                                        text-decoration: none;
                                                                        border-radius: 5px;
                                                                        transition: all 0.3s ease;
                                                                        font-weight: bold;
                                                                    "
                                                                    onmouseover="this.style.backgroundColor="#f39c12"; this.style.color="#004085"; this.style.borderColor="#004085";"
                                                                    onmouseout="this.style.backgroundColor="#004085"; this.style.color="#f39c12"; this.style.borderColor="#f39c12";"
                                                                    data-id="' . $value["id"] . '" data-toggle="modal" data-target="#modal-asignarempresa">Asignar</button>
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