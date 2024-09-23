<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Bascula</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="inicio">Inicio</a></li>
                    <li class="breadcrumb-item active">Administrar Pesaje</li>
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
                            <li class="nav-item"><a class="active nav-link" href="#SegundoPesaje" data-toggle="tab">Segundo Pesaje</a></li>
                            <li class="nav-item"><a class="nav-link " href="#Facturar" data-toggle="tab">Facturar</a></li>
                            <li class="nav-item"><a class="nav-link " href="#Facturado" data-toggle="tab">Facturado</a></li>
                        </ul>
                    </div><!-- /.card-header -->
                    <div class="card-body">
                        <div class="tab-content">
                            <!-- /.TAB PARA MOSTRAR LOS PERFILES-->
                            <div class=" active tab-pane" id="SegundoPesaje">
                                <div class="card">
                                    <div class="card-header">
                                        <h3 class="card-title">Administrar Segundo Pesaje</h3>
                                    </div>
                                    <!-- TABLA PARA MOSTRAR LOS PERFILES CREADOS -->
                                    <table class="tabla-spesaje table table-bordered table-striped dt-responsive " width="100%">
                                        <thead class="bg-dark">
                                            <tr>
                                                <th>#</th>
                                                <th>Fecha</th>
                                                <th>Placa</th>
                                                <th>Primer Pesaje</th>
                                                <th>Cliente</th>
                                                <th>Acciones</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        </tbody>

                                    </table>

                                </div>
                            </div>
                            <div class=" tab-pane" id="Facturar">
                                <div class="card">
                                    <div class="card-header">
                                        <h3 class="card-title">Administrar Pesajes por Facturar</h3>
                                    </div>
                                    <!-- TABLA PARA MOSTRAR LOS PERFILES CREADOS -->
                                    <table class="tabla-spesaje table table-bordered table-striped dt-responsive " width="100%">
                                        <thead class="bg-dark">
                                            <tr>
                                                <th>#</th>
                                                <th>Fecha</th>
                                                <th>Placa</th>
                                                <th>Fecha Peso 1</th>
                                                <th>Peso 1</th>
                                                <th>Fecha Peso 2</th>
                                                <th>Peso 2</th>
                                                <th>Cliente</th>
                                                <th>Acciones</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                        </tbody>

                                    </table>
                                </div>
                            </div>
                            <div class=" tab-pane" id="Facturado">
                                <div class="card">
                                    <div class="card-header">
                                        <h3 class="card-title">Pesajes Facturados</h3>
                                    </div>
                                    <!-- TABLA PARA MOSTRAR LOS PERFILES CREADOS -->
                                    <table class="tabla-spesaje table table-bordered table-striped dt-responsive " width="100%">
                                        <thead class="bg-dark">
                                            <tr>
                                                <th>#</th>
                                                <th>Fecha</th>
                                                <th>Placa</th>
                                                <th>Fecha Peso 1</th>
                                                <th>Peso 1</th>
                                                <th>Fecha Peso 2</th>
                                                <th>Peso 2</th>
                                                <th>Cliente</th>
                                                <th>Acciones</th>
                                            </tr>

                                        </thead>
                                        <tbody>

                                        </tbody>

                                    </table>
                                </div>
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