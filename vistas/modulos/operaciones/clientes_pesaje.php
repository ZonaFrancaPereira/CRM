<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Administrar Clientes de Bascula</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="inicio">Inicio</a></li>
                    <li class="breadcrumb-item active">Administrar Clientes</li>
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>

<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="row">

            <!-- /.col -->
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header p-2">
                        <ul class="nav nav-pills">
                            <li class="nav-item"><a class="active nav-link" href="#NuevoCliente" data-toggle="tab">Nuevo Cliente</a></li>
                            <li class="nav-item"><a class="nav-link " href="#ConsultarClientes" data-toggle="tab">Consultar</a></li>
                        </ul>
                    </div><!-- /.card-header -->
                    <div class="card-body">
                        <div class="tab-content">
                            <!-- /.TAB PARA MOSTRAR LOS PERFILES-->
                            <div class=" active tab-pane" id="NuevoCliente">
                                <form id="GuardarCliente" role="form" method="post" enctype="multipart/form-data">
                                    <div class="row">
                                        <div class="col-md-4 col-sm-6">
                                            <div class="form-group">
                                                <label for="nuevoDocumentoId">Identificación</label>
                                                <input type="text" class="form-control" id="nuevoDocumentoId" name="nuevoDocumentoId" placeholder="Ingresar documento" required>
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-sm-6">
                                            <div class="form-group">
                                                <label for="nuevoCliente"> Nombres y apellidos / Razón social</label>
                                                <input type="text" class="form-control" id="nuevoCliente" name="nuevoCliente" placeholder="Ingresar  Nombres y apellidos / Razón social" required>
                                            </div>
                                        </div>

                                        <div class="col-md-4 col-sm-6">
                                            <div class="form-group">
                                                <label for="nuevoEmail">Email</label>
                                                <input type="email" class="form-control" id="nuevoEmail" name="nuevoEmail" placeholder="Ingresar email" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4 col-sm-6">
                                            <div class="form-group">
                                                <label for="nuevoTelefono">Teléfono</label>
                                                <input type="text" class="form-control" id="nuevoTelefono" name="nuevoTelefono" placeholder="Ingresar teléfono" data-inputmask="'mask':'(999) 999-9999'" data-mask required>
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-sm-6">
                                            <div class="form-group">
                                                <label for="nuevaDireccion">Dirección</label>
                                                <input type="text" class="form-control" id="nuevaDireccion" name="nuevaDireccion" placeholder="Ingresar dirección" required>
                                            </div>
                                        </div>

                                        <div class="col-md-4 col-sm-6">
                                            <div class="form-group">
                                                <label for="nuevaCiudad">Ciudad</label>
                                                <input type="text" class="form-control" id="nuevaCiudad" name="nuevaCiudad" placeholder="Ingresar dirección" required>
                                            </div>
                                        </div>

                                        <div class="col-md-4 col-sm-6">
                                            <div class="form-group">
                                                <label for="departamento">Departamento</label>
                                                <input list="departamentos" class="form-control" id="departamento" name="nuevoDepartamento" placeholder="Seleccionar departamento" required>
                                                <datalist id="departamentos">
                                                    <option value="Amazonas">
                                                    <option value="Antioquia">
                                                    <option value="Arauca">
                                                    <option value="Atlántico">
                                                    <option value="Bolívar">
                                                    <option value="Boyacá">
                                                    <option value="Caldas">
                                                    <option value="Caquetá">
                                                    <option value="Casanare">
                                                    <option value="Cauca">
                                                    <option value="Cesar">
                                                    <option value="Chocó">
                                                    <option value="Córdoba">
                                                    <option value="Cundinamarca">
                                                    <option value="Guainía">
                                                    <option value="Guaviare">
                                                    <option value="Huila">
                                                    <option value="La Guajira">
                                                    <option value="Magdalena">
                                                    <option value="Meta">
                                                    <option value="Nariño">
                                                    <option value="Norte de Santander">
                                                    <option value="Putumayo">
                                                    <option value="Quindío">
                                                    <option value="Risaralda">
                                                    <option value="San Andrés y Providencia">
                                                    <option value="Santander">
                                                    <option value="Sucre">
                                                    <option value="Tolima">
                                                    <option value="Valle del Cauca">
                                                    <option value="Vaupés">
                                                    <option value="Vichada">
                                                </datalist>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <button type="submit" class="btn bg-success btn-block">Guardar Cliente</button>
                                            <?php
                                            $crearCliente = new ControladorClientes();
                                            $crearCliente->ctrCrearCliente();
                                            ?>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class=" tab-pane" id="ConsultarClientes">
                                <table class="table table-bordered table-striped dt-responsive tablaClientes" width="100%">
                                    <thead>
                                        <tr>
                                        <th>Documento</th>
                                            <th>Nombre</th>
                                            <th>Email</th>
                                            <th>Teléfono</th>
                                            <th>Dirección</th>
                                            <th>Total compras</th>
                                            <th>Última compra</th>
                                            <th>Ingreso al sistema</th>
                                            <th>Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.tab-pane -->
                        </div>
                        <!-- /.tab-content -->
                    </div><!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </div><!-- /.container-fluid -->
</section>

