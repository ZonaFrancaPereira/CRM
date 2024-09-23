<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">

            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="inicio">Inicio</a></li>
                    <li class="breadcrumb-item active">Transferencia de Activos</li>
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header bg-info">
                        <h3 class="card-title">Transferencia de Activo </h3>
                    </div>
                    <div class="card-body">
                        <form method="post" action="">
                            <div class="form-group">
                                <label for="id_activo">Activo</label>
                                <input list="activos" class="form-control" id="id_activo" name="id_activo" required style="width: 100%;">
                                <datalist id="activos">
                                    <?php
                                    // Obtener los activos y los usuarios que los tienen
                                    $activos = ControladorActivos::obtenerActivosConUsuarios();

                                    foreach ($activos as $activo) {
                                        echo '<option value="' . $activo["id_activo"] . '">' . $activo["nombre_articulo"] . ' - ' . $activo["nombre_usuario"] . ' ' . $activo["apellidos_usuario"] . '</option>';
                                    }
                                    ?>
                                </datalist>
                            </div>
                            <div class="form-group">
                                <label for="usuario_destino">Usuario Destino</label>
                                <input list="usuarios" class="form-control select2" id="usuario_destino" name="usuario_destino" required style="width: 100%;">
                                <datalist id="usuarios">
                                    <?php
                                    if ($usuario["id"] <> 0) {
                                        echo '<option value="' . $value["id"] . '"> ' . $value["nombre"] . $value["apellidos_usuario"] . ' </option>';
                                    }
                                    $item = null;
                                    $valor = null;
                                    $usuarios = ControladorUsuarios::ctrMostrarUsuarios($item, $valor);
                                    foreach ($usuarios as $key => $value) {
                                        echo '<option value="' . $value["id"] . '"> ' . $value["nombre"] . ' ' . $value["apellidos_usuario"] . ' </option>';
                                    }
                                    ?>
                                </datalist>
                            </div>
                            <div class="form-group">
                                <label for="observaciones">Observaciones</label>
                                <textarea id="observaciones" name="observaciones" class="form-control"></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary">Transferir</button>
                            <?php
                            $transferirActivo = new ControladorActivos();
                            $transferirActivo->ctrTransferirActivo();
                            ?>
                        </form>
                    </div><!-- /.card-body -->
                </div><!-- /.card -->
            </div><!-- /.col -->
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header bg-info">
                        <h3 class="card-title">Transferir todos los activos de un usuario a otro</h3>
                    </div>
                    <div class="card-body">
                        <form method="post" action="">
                            <div class="form-group">
                            <label for="usuario_origen">Usuario Origen</label>
                                <input list="usuarios_origen" class="form-control select2" id="usuario_origen" name="usuario_origen" required style="width: 100%;">
                                <datalist id="usuarios_origen">
                                    <?php
                                    if ($usuario["id"] <> 0) {
                                        echo '<option value="' . $value["id"] . '"> ' . $value["nombre"] . $value["apellidos_usuario"] . ' </option>';
                                    }
                                    $item = null;
                                    $valor = null;
                                    $usuarios = ControladorUsuarios::ctrMostrarUsuarios($item, $valor);
                                    foreach ($usuarios as $key => $value) {
                                        echo '<option value="' . $value["id"] . '"> ' . $value["nombre"] . ' ' . $value["apellidos_usuario"] . ' </option>';
                                    }
                                    ?>
                                </datalist>
                            </div>
                            <div class="form-group">
                                <label for="usuario_destino">Usuario Destino</label>
                              
                                <input list="usuarios" class="form-control select2" id="usuario_destino" name="usuario_destino" required style="width: 100%;">
                                <datalist id="usuarios">
                                    <?php
                                    if ($usuario["id"] <> 0) {
                                        echo '<option value="' . $value["id"] . '"> ' . $value["nombre"] . $value["apellidos_usuario"] . ' </option>';
                                    }
                                    $item = null;
                                    $valor = null;
                                    $usuarios = ControladorUsuarios::ctrMostrarUsuarios($item, $valor);
                                    foreach ($usuarios as $key => $value) {
                                        echo '<option value="' . $value["id"] . '"> ' . $value["nombre"] . ' ' . $value["apellidos_usuario"] . ' </option>';
                                    }
                                    ?>
                                </datalist>
                            </div>
                            <div class="form-group">
                                <label for="observaciones">Observaciones</label>
                                <textarea class="form-control" id="observaciones" name="observaciones"></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary" name="masivo">Transferir Activos</button>
                            <?php
                            if (isset($_POST['masivo'])) {
                                $transferenciaM = new ControladorActivos();
                                $transferenciaM->ctrTransferirActivosUsuarioMasivo();
                            } 
                            ?>
                        </form>
                    </div><!-- /.card-body -->
                </div><!-- /.card -->
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</section><!-- /.content -->