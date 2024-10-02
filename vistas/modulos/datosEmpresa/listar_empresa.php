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

<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <!-- Full width column -->
            <div class="col-12">
                <div class="card shadow-lg border-0 rounded-lg mt-5">
                    <div class="card-header bg-gradient-primary text-white text-center">
                        <h3 class="card-title font-weight-bold">Empresas</h3>
                    </div>
                    <div class="card-body p-4">

                        <table id="tabla-empresas" class="table table-bordered nowrap text-center" width="100%">
                            <thead class="bg-dark text-white">
                                <tr>
                                    <th>Nit</th>
                                    <th>Digito de Verificación</th>
                                    <th>Nombre</th>
                                    <th>Dirección</th>
                                    <th>Ciudad</th>
                                    <th>Teléfono</th>
                                    <th>Teléfono</th>
                                    <th>Nombre Representante Legal</th>
                                    <th>Correo Electrónico</th>
                                    <th>Usuario Asignado</th>
                                    <th>Actualizar</th>
                                    <th>Asignar</th>
                                    
                                </tr>
                            </thead>
                        </table>


                        <div class="modal fade" id="modal-editempresa" tabindex="-1" role="dialog" aria-labelledby="modalEditarEmpresaLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header bg-dark text-white">
                                        <h5 class="modal-title" id="modalEditarEmpresaLabel">Editar Empresa</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form id="formEditarEmpresa" method="POST" enctype="multipart/form-data">
                                            <div class="form-group">
                                                <label for="id_empresa">NIT Empresa</label>
                                                <input type="text" class="form-control" id="id_empresa" name="id_empresa" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="dv_empresa">Dígito de Verificación Empresa</label>
                                                <input type="text" class="form-control" id="dv_empresa" name="dv_empresa" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="nombre_empresa">Nombre Empresa</label>
                                                <input type="text" class="form-control" id="nombre_empresa" name="nombre_empresa" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="direccion_empresa">Dirección Empresa</label>
                                                <input type="text" class="form-control" id="direccion_empresa" name="direccion_empresa" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="ciudad_empresa">Ciudad Empresa</label>
                                                <input type="text" class="form-control" id="ciudad_empresa" name="ciudad_empresa" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="telefono_empresa">Teléfono Empresa 1</label>
                                                <input type="text" class="form-control" id="telefono_empresa" name="telefono_empresa" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="telefono2_empresa">Teléfono Empresa 2</label>
                                                <input type="text" class="form-control" id="telefono2_empresa" name="telefono2_empresa">
                                            </div>
                                            <div class="form-group">
                                                <label for="nombre_rep_legal_empresa">Nombre Representante Legal Empresa</label>
                                                <input type="text" class="form-control" id="nombre_rep_legal_empresa" name="nombre_rep_legal_empresa" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="correo_empresa">Correo Electrónico Empresa</label>
                                                <input type="text" class="form-control" id="correo_empresa" name="correo_empresa" required>
                                            </div>
                                            <button type="submit" class="btn btn-primary" name="actualizar_empresa" id="actualizar_empresa">Actualizar Empresa</button>

                                            <?php
                                            $ActualizarEmpresa = new ControladorEmpresa();
                                            $ActualizarEmpresa->ctrActualizarEmpresa();
                                            ?>
                                        </form>

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