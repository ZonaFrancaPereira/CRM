<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Perfiles de Usuario</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="inicio">Inicio</a></li>
                    <li class="breadcrumb-item active">Administrar Perfiles</li>
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
                            <li class="nav-item"><a class="active nav-link" href="#ConsultarPerfiles" data-toggle="tab">Consultar Perfiles</a></li>

                            <li class="nav-item"><a class="nav-link " href="#NuevoPerfil" data-toggle="tab">Nuevo Perfil</a></li>
                        </ul>
                    </div><!-- /.card-header -->
                    <div class="card-body">
                        <div class="tab-content">
                            <!-- /.TAB PARA MOSTRAR LOS PERFILES-->
                            <div class=" active tab-pane" id="ConsultarPerfiles">
                                <div class="card">
                                    <div class="card-header">
                                        <h3 class="card-title">Administrar los Perfiles</h3>
                                    </div>
                                    <!-- TABLA PARA MOSTRAR LOS PERFILES CREADOS -->
                                    <table class="tabla-perfiles table table-bordered table-striped dt-responsive " width="100%">
                                        <thead class="bg-dark">
                                            <tr>
                                                <th style="width:20px">#</th>
                                                <th style="width:40px">Descripción</th>
                                                <th style="width:20px">Editar</th>
                                                <th style="width:20px">Eliminar</th>
                                            </tr>

                                        </thead>
                                        <tbody>

                                        </tbody>

                                    </table>

                                </div>
                            </div>
                            <div class=" tab-pane" id="NuevoPerfil">

                                <form role="form" method="post" enctype="multipart/form-data">
                                    <!-- #INPUT PARA AGREGAR LA DESCRIPCIÓN DEL PERFIL -->
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-user"></i></span>
                                        </div>
                                        <input type="text" class="form-control input-lg" name="nuevoDescripcionPerfil" placeholder="Ejemplo: Usuarios | Super Usuario" required>
                                    </div>
                                    <ul class="nav nav-tabs" id="custom-tabs-one-tab" role="tablist">
                                    <li class="nav-item">
                                            <a class="nav-link active" id="custom-tabs-one-messages-tab" data-toggle="pill" href="#ct" role="tab" aria-controls="ct" aria-selected="false">Usuarios</a>
                                        </li>
                                        <li class="nav-item ">
                                            <a class="nav-link  " id="custom-tabs-one-home-tab" data-toggle="pill" href="#empresas" role="tab" aria-controls="empresas" aria-selected="true">Empresas</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" id="custom-tabs-one-profile-tab" data-toggle="pill" href="#sig" role="tab" aria-controls="sig" aria-selected="false">Calendario</a>
                                        </li>
                                      
                                      
                                    </ul>
                                    <div class="tab-content" id="custom-tabs-one-tabContent">
                                        <div class="tab-pane fade " id="empresas" role="tabpanel" aria-labelledby="custom-tabs-one-home-tab">
                                            <!-- MODULO PARA DAR LOS PERMISOS PARA ADMINISTRAR LAS EMPRESAS -->
                                            <div class="card-header bg-teal">
                                                Administrar Empresas.
                                            </div>
                                            <!-- DIV PARA CONTENER LAS OPCIONES  DE TI-->
                                            <div class="pt-2 card">
                                                <!-- MODULO PARA GESTIONAR TODO LO RELACIONADO CON EL AREA DE TI, USUARIOS, PERFILES -->
                                                <div class="card pt-2">
                                                    <h6 class="text-center">MODULO EMPRESAS</h6>
                                                </div>
                                                <p><B>Gestionar Empresas</B> : Permisos para crear, asignar empresas</p>

                                                <!-- Check MODULO TI -->
                                                <div class="checkbox">
                                                    <input type="checkbox" data-toggle="toggle" name="AdminEmpresa" data-on="Si" data-off="No">
                                                    <label for="exampleInputEmail1" data-toggle="tooltip" data-placement="top" title="Permisos para crear,editar,consultar,eliminar  usuarios">Administrar Empresas</label>
                                                </div>
                                                <!-- Check ADMINISTRAR USUARIOS -->
                                                <div class="checkbox">
                                                    <input type="checkbox" data-toggle="toggle" name="EmpresasAsignadas" data-on="Si" data-off="No">
                                                    <label for="exampleInputEmail1" data-toggle="tooltip" data-placement="top" title="Permisos para crear,editar,consultar,eliminar  usuarios">Empresas Asignadas</label>
                                                </div>
                                                <!-- Check CONSULTAR USUARIOS -->
                                                <div class="checkbox">
                                                    <input type="checkbox" data-toggle="toggle" name="SubirDocumentos" data-on="Si" data-off="No">
                                                    <label for="exampleInputEmail1" data-toggle="tooltip" data-placement="top" title="Permisos para consultar usuarios">Subir Documentos</label>
                                                </div>
                           
                                            </div>
                                        </div>
                                        <div class="tab-pane fade" id="sig" role="tabpanel" aria-labelledby="custom-tabs-one-profile-tab">
                                            <!-- MODULO PARA DAR LOS PERMISOS QUE TIENE CADA USUARIO CON RELACIÓN A SISTEMA INTEGRADO DE GESTIÓN SIG -->
                                            <div class="card-header bg-navy">
                                                Configuraciones Calendario
                                            </div>

                                            <div class="pt-2 card">
                                                <!-- DIV PARA CONTENER LAS OPCIONES  DE LAS ORDENES DE COMPRA-->
                                                <div class="card pt-2">
                                                    <h6 class="text-center">MODULO CALENDARIO</h6>
                                                </div>

                                                <p class="pt-2"><B>Gestionar Calendario</B> : Permisos para crear, consultar, editar, eliminar : Calendario </p>

                                                <!-- Check CREAR SERVICIÓ DE BASCULA -->
                                                <div class="checkbox">
                                                    <input type="checkbox" data-toggle="toggle" name="AdminCalendario" data-on="Si" data-off="No">
                                                    <label for="exampleInputEmail1" data-toggle="tooltip" data-placement="top" title="Permisos para Administrar Calendario">Administrar Calendario</label>
                                                </div>
                                                <!-- Check EDITAR PESAJES -->
                                                <div class="checkbox">
                                                    <input type="checkbox" data-toggle="toggle" name="SubirCalendario" data-on="Si" data-off="No">
                                                    <label for="exampleInputEmail1" data-toggle="tooltip" data-placement="top" title="Permisos para subir calendario de la semana">Subir Calendario</label>
                                                </div>
                                                

                                            </div>
                                        </div>
                                        <div class="tab-pane fade show active" id="ct" role="tabpanel" aria-labelledby="custom-tabs-one-messages-tab">
                                            <!-- MODULO PARA DAR LOS PERMISOS QUE TIENE CADA USUARIO CON RELACIÓN A CONTABILIDAD -->
                                            <div class="card-header bg-warning">
                                                Configuraciones para Usuarios
                                            </div>

                                            <div class="pt-2 card">
                                                <!-- DIV PARA CONTENER LAS OPCIONES  DE LAS ORDENES DE COMPRA-->
                                                <div class="card pt-2">
                                                    <h6 class="text-center">MODULO USUARIOS</h6>
                                                </div>

                                                <p class="pt-2"><B>Gestionar Usuarios</B> : Permisos para crear, consultar, editar, eliminar : Usuarios</p>

                                                <!-- Check CREAR ORDENES DE COMPRA -->
                                                <div class="checkbox">
                                                    <input type="checkbox" data-toggle="toggle" name="AdminUsuarios" data-on="Si" data-off="No">
                                                    <label for="exampleInputEmail1" data-toggle="tooltip" data-placement="top" title="Permisos para gestionar usuarios">Administrar Usuario</label>
                                                </div>
                                                <!-- Check EDITAR ORDEN DE COMPRA -->
                                                <div class="checkbox">
                                                    <input type="checkbox" data-toggle="toggle" name="VerUsuarios" data-on="Si" data-off="No">
                                                    <label for="exampleInputEmail1" data-toggle="tooltip" data-placement="top" title="Ver Usuarios">Consultar Usuarios</label>
                                                </div>
                                                <!-- Check CONSULTAR ORDENES DE COMPRA -->
                                                <div class="checkbox">
                                                    <input type="checkbox" data-toggle="toggle" name="AdminPerfiles" data-on="Si" data-off="No">
                                                    <label for="exampleInputEmail1" data-toggle="tooltip" data-placement="top" title="Permisos para Gestionar Perfiles">Administrar Perfiles</label>
                                                </div>
                                               
                                            </div>

                                        </div>

                                       
                                    </div>
                                    <button type="submit" class="btn bg-success btn-block">Guardar Perfil</button>
                                    <?php
                                    $crearPerfil = new ControladorPerfiles();
                                    $crearPerfil->ctrCrearPerfil();
                                    ?>
                                </form>
                            </div>
                            <!-- /.tab-pane -->
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