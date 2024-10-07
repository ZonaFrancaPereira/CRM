<!-- Sidebar Menu -->
<nav class="mt-2">
    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <li class="nav-item active" role="presentation">
            <a data-toggle="tab" href="#archivos" class="nav-link active">
                <i class="nav-icon far fa-smile-wink"></i>
                <p>Agregar Archivos</p>
            </a>
        </li>
        <li class="nav-item" role="presentation">
            <a data-toggle="tab" href="#biblioteca" class="nav-link">
                <i class="nav-icon far fa-smile-wink"></i>
                <p>Biblioteca</p>
            </a>
        </li>
    </ul>
</nav>
<!-- /.sidebar-menu -->
</aside>

<!-- Main content -->
<div class="content-wrapper">
    <div id="wrapper" class="toggled">
        <div id="page-content-wrapper">
            <div class="container-fluid">
                <div class="tab-content card">

                    <!-- Sección de Archivos -->
                    <div id="archivos" class="tab-pane active">
                        <div class="row">
                            <div class="col-12">
                                <div class="card card-primary">
                                    <div class="card-header">
                                        <h3 class="card-title">Añadir Excel ó Word</h3>
                                    </div>
                                    <!-- /.card-header -->
                                    <!-- form start -->
                                    <form id="formArchivo" action="" method="POST" enctype="multipart/form-data">
                                        <div class="card-body">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Nombre Archivo</label>
                                                <input type="text" class="form-control" id="exampleInputEmail1" name="descripcion_archivo" placeholder="Descripcion del archivo">
                                            </div>
                                            <div class="form-group">
                                                <label for="inputPassword4">Tipo de Archivo</label>
                                                <select name="tipo_archivo" id="" class="form-control">
                                                    <option value="word">Word</option>
                                                    <option value="excel">Excel</option>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="inputPassword4">Seleccionar Archivo (Excel ó Word Configurado)</label>
                                                <input type="file" name="archivo" class="form-control" required>
                                            </div>

                                        </div>
                                        <!-- /.card-body -->

                                        <div class="card-footer">
                                            <button type="submit" form="formArchivo" name="guardar_excel" class="btn bg-success btn-block">
                                                <i class="fas fa-2x fa-save"></i>
                                                Guardar Cambios</button>
                                        </div>
                                        <?php

                                        $crearArchivo = new ControladorArchivo();
                                        $crearArchivo->ctrCrearArchivo();

                                        ?>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Sección de Biblioteca -->
                    <div id="biblioteca" class="tab-pane">
                        <div class="row">
                            <div class="col-12">
                                <table class="display table table-bordered table-striped dt-responsive " width="100%">
                                    <thead>
                                        <tr>
                                            <th style="width:10px">#</th>
                                            <th>Nombre Archivo</th>
                                            <th>Tipo Archivo</th>
                                            <th>Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $item = null;
                                        $valor = null;

                                        $archivos = ControladorArchivo::ctrMostrarArchivos($item, $valor);

                                        foreach ($archivos as $key => $value) {

                                            echo ' <tr>
                                                <td>' . ($key + 1) . '</td>
                                                <td>' . $value["nombre_archivo_e"] . '</td>
                                                <td>' . $value["tipo_archivo_e"] . '</td>
                                                <td>
                                                    <div class="btn-group">
                                                        <button class="btn btn-warning btnEditarArchivo" idArchivo="' . $value["cod_archivo_e"] . '" data-toggle="modal" data-target="#modalEditarArchivo"><i class="fa fa-edit"></i></button>
                                                        <button class="btn bg-success btnDescargarArchivo" idArchivo="' . $value["cod_archivo_e"] . '"><i class="fa fa-download"></i></button>
                                                        <button class="btn btn-danger btnEliminarArchivo" idArchivo="' . $value["cod_archivo_e"] . '"><i class="fa fa-times"></i></button>
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
        </div>
    </div>
</div>
<!-- /.content -->
</div>

<!-- /.control-sidebar -->
</div>