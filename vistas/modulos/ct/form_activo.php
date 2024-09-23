<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header bg-info">
                        <h3 class="card-title">Registrar Activo Fijo</h3>
                    </div>
                    <div class="card-body">
                        <form id="GuardarActivo" role="form" method="post" enctype="multipart/form-data">
                            <div class="row">


                                <div class="col-md-4 col-sm-12">
                                    <div class="form-group">
                                        <label for="cod_renta">Código de Renta</label>
                                        <input type="text" class="form-control" id="cod_renta" name="cod_renta" value="No Aplica">
                                    </div>
                                </div>

                                <div class="col-md-4 col-sm-12">
                                    <div class="form-group">
                                        <label for="nombre_articulo">Nombre del Artículo</label>
                                        <input type="text" class="form-control" id="nombre_articulo" name="nombre_articulo" required>
                                    </div>
                                </div>
                                <div class="col-md-4 col-sm-12">
                                    <div class="form-group">
                                        <label for="descripcion_articulo">Descripción del Artículo</label>
                                        <input type="text" class="form-control" id="descripcion_articulo" name="descripcion_articulo" required>
                                    </div>
                                </div>
                                <div class="col-md-4 col-sm-12">
                                    <div class="form-group">
                                        <label for="modelo_articulo">Modelo del Artículo</label>
                                        <input type="text" class="form-control" id="modelo_articulo" name="modelo_articulo">
                                    </div>
                                </div>
                                <div class="col-md-4 col-sm-12">
                                    <div class="form-group">
                                        <label for="referencia_articulo">Referencia del Artículo</label>
                                        <input type="text" class="form-control" id="referencia_articulo" name="referencia_articulo">
                                    </div>
                                </div>
                                <div class="col-md-4 col-sm-12">
                                    <div class="form-group">
                                        <label for="marca_articulo">Marca del Artículo</label>
                                        <input type="text" class="form-control" id="marca_articulo" name="marca_articulo">
                                    </div>
                                </div>
                                <div class="col-md-4 col-sm-12">
                                    <div class="form-group">
                                        <label for="tipo_articulo">Tipo del Artículo</label>
                                        <input type="text" class="form-control" id="tipo_articulo" name="tipo_articulo">
                                    </div>
                                </div>

                                <div class="col-md-4 col-sm-12">
                                    <div class="form-group">
                                        <label for="lugar_articulo">Lugar del Artículo</label>
                                        <input type="text" class="form-control" id="lugar_articulo" name="lugar_articulo" required>
                                    </div>
                                </div>

                                <div class="col-md-4 col-sm-12">
                                    <div class="form-group">
                                        <label for="numero_factura">Número de Factura</label>
                                        <input type="text" class="form-control" id="numero_factura" name="numero_factura" required>
                                    </div>
                                </div>
                                <div class="col-md-12 col-sm-12">
                                    <div class="form-group">
                                        <label for="observaciones_articulo">Observaciones del Artículo</label>
                                        <textarea class="form-control" id="observaciones_articulo" name="observaciones_articulo" rows="3"></textarea>
                                    </div>
                                </div>
                                <div class="col-md-4 col-sm-12">
                                    <div class="form-group">
                                        <label for="fecha_garantia">Fecha de Garantía</label>
                                        <input type="date" class="form-control" id="fecha_garantia" name="fecha_garantia">
                                    </div>
                                </div>
                                <div class="col-md-4 col-sm-12">
                                    <div class="form-group">
                                        <label for="valor_articulo">Valor del Artículo</label>
                                        <input type="number" class="form-control" id="valor_articulo" name="valor_articulo" required>
                                    </div>
                                </div>
                                <div class="col-md-4 col-sm-12">
                                    <div class="form-group">
                                        <label for="condicion_articulo">Condición del Artículo</label>
                                        <input type="text" class="form-control" id="condicion_articulo" name="condicion_articulo">
                                    </div>
                                </div>
                                <div class="col-md-4 col-sm-12">
                                    <div class="form-group">

                                        <label for="id_proveedor_fk"> Proveedor</label>
                                        <input list="proveedor" class="form-control select2 seleccionarCliente" id="id_proveedor_fk" name="id_proveedor_fk" required style="width: 100%;">
                                        <datalist id="proveedor">
                                            <?php
                                            if ($proveedor["documento"] <> 0) {
                                                echo '<option value="' . $proveedor["id_proveedor"] . '"> ' . $proveedor["nombre_proveedor"] . '</option>';
                                            }
                                            $item = null;
                                            $valor = null;
                                            $proveedor = ControladorProveedor::ctrMostrarProveedor($item, $valor);
                                            // Devolver los datos en formato JSON

                                            foreach ($proveedor as $key => $value) {
                                                echo '<option value="' . $value["id_proveedor"] . '">' . $value["id_proveedor"] . " - " . $value["nombre_proveedor"] . '</option>';
                                            }
                                            ?>
                                        </datalist>
                                    </div>
                                </div>
                                <div class="col-md-8 col-sm-12">
                                    <div class="form-group">
                                        <label for="descripcion_proveedor">Descripción del Proveedor</label>
                                        <input type="text" class="form-control" id="descripcion_proveedor" name="descripcion_proveedor">
                                    </div>
                                </div>
                                <div class="col-md-4 col-sm-12">
                                    <div class="form-group">
                                        <label for="id_usuario_fk">Usuario</label>
                                        <input list="usuarios" class="form-control select2 " id="id_usuario_fk" name="id_usuario_fk" required style="width: 100%;">
                                        <datalist id="usuarios">
                                            <?php
                                            if ($usuario["id"] <> 0) {
                                                echo '<option value="' . $value["id"] . '"> ' . $value["nombre"] . $value["apellidos_usuario"] . ' </option>';
                                            }
                                            $item = null;
                                            $valor = null;
                                            $usuario = ControladorUsuarios::ctrMostrarUsuarios($item, $valor);
                                            // Devolver los datos en formato JSON

                                            foreach ($usuario as $key => $value) {
                                                echo '<option value="' . $value["id"] . '"> ' . $value["nombre"] . $value["apellidos_usuario"] . ' </option>';
                                            }
                                            ?>
                                        </datalist>

                                    </div>
                                </div>
                                <div class="col-md-4 col-sm-12">
                                    <div class="form-group">
                                        <label for="estado_activo">Estado del Activo</label>
                                        <select class="form-control" id="estado_activo" name="estado_activo">
                                            <option value="Activo">Activo</option>
                                            <option value="Inactivo">Inactivo</option>
                                            <option value="Rentado">Rentado</option>

                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4 col-sm-12">
                                    <div class="form-group">
                                        <label for="recurso_tecnologico">Recurso Tecnológico</label>
                                        <select class="form-control" id="recurso_tecnologico" name="recurso_tecnologico">
                                            <option value="Si">Sí</option>
                                            <option value="No">No</option>

                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <button type="submit" class="btn btn-success btn-block">Guardar</button>
                                </div>
                                <?php
                                $crearActivo = new ControladorActivos();
                                $crearActivo->ctrCrearActivos();
                                ?>
                            </div>

                        </form>
                    </div><!-- /.card-body -->
                </div><!-- /.card -->
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</section><!-- /.content -->