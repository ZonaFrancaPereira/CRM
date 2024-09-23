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
                                        <input type="text" class="form-control input-lg" name="nuevoDescripcionPerfil" placeholder="Ejemplo: TI | Usuarios | Super Usuario" required>
                                    </div>
                                    <ul class="nav nav-tabs" id="custom-tabs-one-tab" role="tablist">
                                        <li class="nav-item ">
                                            <a class="nav-link active " id="custom-tabs-one-home-tab" data-toggle="pill" href="#ti" role="tab" aria-controls="ti" aria-selected="true">TI</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" id="custom-tabs-one-profile-tab" data-toggle="pill" href="#sig" role="tab" aria-controls="sig" aria-selected="false">SIG</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" id="custom-tabs-one-messages-tab" data-toggle="pill" href="#ct" role="tab" aria-controls="ct" aria-selected="false">Contabilidad</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" id="custom-tabs-one-messages-tab" data-toggle="pill" href="#op" role="tab" aria-controls="op" aria-selected="false">Operaciones</a>
                                        </li>
                                    </ul>
                                    <div class="tab-content" id="custom-tabs-one-tabContent">
                                        <div class="tab-pane fade show active" id="ti" role="tabpanel" aria-labelledby="custom-tabs-one-home-tab">
                                            <!-- MODULO PARA DAR LOS PERMISOS QUE TIENE CADA USUARIO CON RELACIÓN A TI -->
                                            <div class="card-header bg-teal">
                                                Configuraciones Tecnología e Informática.
                                            </div>
                                            <!-- DIV PARA CONTENER LAS OPCIONES  DE TI-->
                                            <div class="pt-2 card">
                                                <!-- MODULO PARA GESTIONAR TODO LO RELACIONADO CON EL AREA DE TI, USUARIOS, PERFILES -->
                                                <div class="card pt-2">
                                                    <h6 class="text-center">MODULO GESTIÓN TI</h6>
                                                </div>
                                                <p><B>Gestionar Usuarios</B> : Permisos para crear, consultar, editar, eliminar usuarios de ZFIP</p>

                                                <!-- Check MODULO TI -->
                                                <div class="checkbox">
                                                    <input type="checkbox" data-toggle="toggle" name="smModuloTI" data-on="Si" data-off="No">
                                                    <label for="exampleInputEmail1" data-toggle="tooltip" data-placement="top" title="Permisos para crear,editar,consultar,eliminar  usuarios">Modulo TI</label>
                                                </div>
                                                <!-- Check ADMINISTRAR USUARIOS -->
                                                <div class="checkbox">
                                                    <input type="checkbox" data-toggle="toggle" name="smAdminUsuarios" data-on="Si" data-off="No">
                                                    <label for="exampleInputEmail1" data-toggle="tooltip" data-placement="top" title="Permisos para crear,editar,consultar,eliminar  usuarios">Administrador de Usuarios</label>
                                                </div>
                                                <!-- Check CONSULTAR USUARIOS -->
                                                <div class="checkbox">
                                                    <input type="checkbox" data-toggle="toggle" name="smVerUsuarios" data-on="Si" data-off="No">
                                                    <label for="exampleInputEmail1" data-toggle="tooltip" data-placement="top" title="Permisos para consultar usuarios">Consultar</label>
                                                </div>
                                                <!-- Check ESTADO USUARIOS -->
                                                <div class="checkbox">
                                                    <input type="checkbox" data-toggle="toggle" name="smEstadoUsuarios" data-on="Si" data-off="No">
                                                    <label for="exampleInputEmail1" data-toggle="tooltip" data-placement="top" title="Permisos para cambiar el estado de los usuarios usuarios">Habilitar y Deshabilitar Usuarios</label>
                                                </div>
                                                <p class="pt-2"><B>Gestionar Perfiles</B> : Permisos para crear, consultar, editar, eliminar perfiles de los Usuarios</p>
                                                <!-- Check CREAR PERFILES -->
                                                <div class="checkbox ">
                                                    <input type="checkbox" data-toggle="toggle" name="smAdminPerfiles" data-on="Si" data-off="No">
                                                    <label for="exampleInputEmail1" data-toggle="tooltip" data-placement="top" title="Permisos para crear,editar,consultar,eliminar perfiles">Administrador de Perfiles</label>
                                                </div>
                                                <br>
                                                <!-- MODULO PARA GESTIONAR LOS MANTENIMIENTOS DE LOS EQUIPOS TECNOLÓGICOS -->
                                                <div class="card pt-2">
                                                    <h6 class="text-center">MODULO MANTENIMIENTO DE RECURSOS TECNOLÓGICOS</h6>
                                                </div>
                                                <p class="pt-2"><B>Gestionar Mantenimientos</B> : Permisos para crear, consultar, editar, eliminar Mantenimientos de los Recursos Tecnológicos</p>

                                                <!-- Check Mantenimientos -->
                                                <div class="checkbox pt-2">
                                                    <input type="checkbox" data-toggle="toggle" name="smAdminMantenimientos" data-on="Si" data-off="No">
                                                    <label for="exampleInputEmail1" data-toggle="tooltip" data-placement="top" title="Permisos para administrar los mantenimientos de equipos y dispositivos de ZFIP">Administrador de Mantenimientos</label>
                                                </div>

                                                <p class="pt-2"><B>Gestionar Inventarios</B> : Permisos para crear, consultar, editar, eliminar Inventario de los Recursos Tecnológicos</p>
                                                <!-- Check Inventario Equipos TI -->
                                                <div class="checkbox pt-2">
                                                    <input type="checkbox" data-toggle="toggle" name="smInventarioEquipos" data-on="Si" data-off="No">
                                                    <label for="exampleInputEmail1" data-toggle="tooltip" data-placement="top" title="Permisos para administrar el inventario de licencias">Inventario de Recursos Tecnológicos</label>
                                                </div>
                                                <br>
                                                <!-- MODULO PARA GESTIONAR LOS SOPORTES TÉCNICOS -->
                                                <div class="card pt-2">
                                                    <h6 class="text-center">MODULO SOPORTE TÉCNICO</h6>
                                                </div>
                                                <p class="pt-2"><B>Gestionar Soportes Técnicos</B> : Permisos para crear, consultar, editar, eliminar Soportes Técnicos</p>
                                                <!-- Check Administrador de soportes TI -->
                                                <div class="checkbox pt-2">
                                                    <input type="checkbox" data-toggle="toggle" name="smAdminSoporte" data-on="Si" data-off="No">
                                                    <label for="exampleInputEmail1" data-toggle="tooltip" data-placement="top" title="Permisos para responder solicitudes de soporte técnico a los usuarios">Administrador de Soportes TI</label>
                                                </div>
                                                <!-- Check Solicitud de soporte TI -->
                                                <div class="checkbox pt-2">
                                                    <input type="checkbox" data-toggle="toggle" name="smSolicitudSoporte" data-on="Si" data-off="No">
                                                    <label for="exampleInputEmail1" data-toggle="tooltip" data-placement="top" title="Permisos para enviar solicitudes de soporte técnico al area de TI">Solicitud de Soporte TI</label>
                                                </div>
                                                <!-- Check CONSULTAR SOLICITUDES POR CADA USUARIO -->
                                                <div class="checkbox pt-2">
                                                    <input type="checkbox" data-toggle="toggle" name="smConsultarSoporte" data-on="Si" data-off="No">
                                                    <label for="exampleInputEmail1" data-toggle="tooltip" data-placement="top" title="Permisos para consultar solicitudes de soporte técnico realizadas">Consultar Solicitudes de Soporte Técnico </label>
                                                </div>

                                                <br>
                                            </div>
                                        </div>
                                        <div class="tab-pane fade" id="sig" role="tabpanel" aria-labelledby="custom-tabs-one-profile-tab">
                                            <!-- MODULO PARA DAR LOS PERMISOS QUE TIENE CADA USUARIO CON RELACIÓN A SISTEMA INTEGRADO DE GESTIÓN SIG -->
                                            <div class="card-header bg-success">
                                                Configuraciones Sistema Integrado de Gestión.
                                            </div>


                                            <!-- DIV PARA CONTENER LAS OPCIONES  DE SIG-->
                                            <div class="pt-2 card">
                                                <!-- MODULO ACPM -->
                                                <div class="card pt-2">
                                                    <h6 class="text-center">MODULO ACCIONES CORRECTIVAS, PREVENTIVAS Y DE MEJORA</h6>
                                                </div>
                                                <p class="pt-2"><B>Gestionar ACPM</B> : Permisos para crear, consultar, editar, eliminar : ACPM</p>
                                                <!-- Check RECHAZAR-ACEPTAR-CERRAR ACPM SOLO CORRESPONDE AL SIG -->
                                                <div class="checkbox">
                                                    <input type="checkbox" data-toggle="toggle" name="smAdminAcpm" data-on="Si" data-off="No">
                                                    <label for="exampleInputEmail1" data-toggle="tooltip" data-placement="top" title="Permisos para rechazar, aceptar y cerrar ACPM de los lideres de proceso.">Administrador ACPM</label>
                                                </div>
                                                <!-- Check RADICAR ACPM -->
                                                <div class="checkbox">
                                                    <input type="checkbox" data-toggle="toggle" name="smCrearAcpm" data-on="Si" data-off="No">
                                                    <label for="exampleInputEmail1" data-toggle="tooltip" data-placement="top" title="Permisos para radicar una acpm, solo lideres de proceso y personal autorizado">Crear</label>
                                                </div>
                                                <!-- Check CONSULTAR ACPM -->
                                                <div class="checkbox">
                                                    <input type="checkbox" data-toggle="toggle" name="smConsultarAcpm" data-on="Si" data-off="No">
                                                    <label for="exampleInputEmail1" data-toggle="tooltip" data-placement="top" title="Permisos para consultar las ACPM que se tienen en el proceso, solo para lideres de proceso ó personal autorizado.">Consultar</label>
                                                </div>
                                                <!-- Check EDITAR ACPM -->
                                                <div class="checkbox">
                                                    <input type="checkbox" data-toggle="toggle" name="smEditarAcpm" data-on="Si" data-off="No">
                                                    <label for="exampleInputEmail1" data-toggle="tooltip" data-placement="top" title="Permisos para radicar editar la ACPM">Editar</label>
                                                </div>
                                                <!-- Check ELIMINAR ACPM -->
                                                <div class="checkbox">
                                                    <input type="checkbox" data-toggle="toggle" name="smEliminarAcpm" data-on="Si" data-off="No">
                                                    <label for="exampleInputEmail1" data-toggle="tooltip" data-placement="top" title="Permisos para radicar una acpm, solo lideres de proceso y personal autorizado">Eliminar</label>
                                                </div>

                                                <hr>
                                                <p class="pt-2"><B>Gestionar Actividades</B> : Permisos para crear, consultar, editar, eliminar : Actividades</p>
                                                <!-- Check ASIGNAR ACTIVIDADES -->
                                                <div class="checkbox">
                                                    <input type="checkbox" data-toggle="toggle" name="smAsignarActividades" data-on="Si" data-off="No">
                                                    <label for="exampleInputEmail1" data-toggle="tooltip" data-placement="top" title="Permisos para asignar actividades a los colaboradores">Asignar</label>
                                                </div>
                                                <!-- Check RESPONDER ACTIVIDADES -->
                                                <div class="checkbox">
                                                    <input type="checkbox" data-toggle="toggle" name="smResponderActividades" data-on="Si" data-off="No">
                                                    <label for="exampleInputEmail1" data-toggle="tooltip" data-placement="top" title="Permisos para responder actividades que tienen asignadas">Responder</label>
                                                </div>
                                                <!-- Check CONSULTAR ACTIVIDADES -->
                                                <div class="checkbox">
                                                    <input type="checkbox" data-toggle="toggle" name="smVerActividades" data-on="Si" data-off="No">
                                                    <label for="exampleInputEmail1" data-toggle="tooltip" data-placement="top" title="Permisos para editar actividades creadas">Consultar</label>
                                                </div>
                                                <!-- Check EDITAR ACTIVIDADES -->
                                                <div class="checkbox">
                                                    <input type="checkbox" data-toggle="toggle" name="smEditarActividades" data-on="Si" data-off="No">
                                                    <label for="exampleInputEmail1" data-toggle="tooltip" data-placement="top" title="Permisos para editar actividades creadas">Editar</label>
                                                </div>
                                                <!-- Check ELIMINAR ACTIVIDADES -->
                                                <div class="checkbox">
                                                    <input type="checkbox" data-toggle="toggle" name="smEliminarActividades" data-on="Si" data-off="No">
                                                    <label for="exampleInputEmail1" data-toggle="tooltip" data-placement="top" title="Permisos para eliminar actividades creadas">Eliminar</label>
                                                </div>

                                                <br>
                                                <!-- MODULO PARA GESTIONAR SADOC -->
                                                <div class="card pt-2">
                                                    <h6 class="text-center">MODULO SADOC</h6>
                                                </div>
                                                <p class="pt-2"><B>Gestionar SADOC</B> : Permisos para crear, consultar, editar, eliminar : Archivos de SADOC</p>

                                                <!-- Check SUBIR DOCUMENTACIÓN A SADOC -->
                                                <div class="checkbox">
                                                    <input type="checkbox" data-toggle="toggle" name="smArchivosSadoc" data-on="Si" data-off="No">
                                                    <label for="exampleInputEmail1" data-toggle="tooltip" data-placement="top" title="Permisos para subir archivos a SADOC">Subir Archivos </label>
                                                </div>
                                                <!-- Check CREAR CARPETAS EN SADOC -->
                                                <div class="checkbox">
                                                    <input type="checkbox" data-toggle="toggle" name="smCarpetasSadoc" data-on="Si" data-off="No">
                                                    <label for="exampleInputEmail1" data-toggle="tooltip" data-placement="top" title="Permisos para crear carpetas en SADOC">Crear Carpetas</label>
                                                </div>
                                                <!-- Check ELIMINAR DOCUMENTACIÓN A SADOC -->
                                                <div class="checkbox">
                                                    <input type="checkbox" data-toggle="toggle" name="smEliminarSadoc" data-on="Si" data-off="No">
                                                    <label for="exampleInputEmail1" data-toggle="tooltip" data-placement="top" title="Permisos para eliminar archivos de SADOC">Eliminar Archivos</label>
                                                </div>
                                                <br>
                                                <!-- MODULO PARA GESTIONAR LAS SOLICITUDES DE CODIFICACIÓN -->
                                                <div class="card pt-2">
                                                    <h6 class="text-center">MODULO SOLICITUDES DE CODIFICACIÓN</h6>
                                                </div>
                                                <p class="pt-2"><B>Gestionar Solicitudes de Codificación</B> : Permisos para crear, consultar, editar, eliminar : Solicitudes de Codificación </p>

                                                <!-- Check CREAR SOLICITUD DE CODIFICACIÓN -->
                                                <div class="checkbox">
                                                    <input type="checkbox" data-toggle="toggle" name="smSolicitudCodificacion" data-on="Si" data-off="No">
                                                    <label for="exampleInputEmail1" data-toggle="tooltip" data-placement="top" title="Permisos para crear solicitudes de codificación">Crear</label>
                                                </div>
                                                <!-- Check RESPONDER SOLICITUD DE CODIFICACIÓN -->
                                                <div class="checkbox">
                                                    <input type="checkbox" data-toggle="toggle" name="smResponderCodificacion" data-on="Si" data-off="No">
                                                    <label for="exampleInputEmail1" data-toggle="tooltip" data-placement="top" title="Permisos para Responder solicitudes de codificación">Responder</label>
                                                </div>
                                                <!-- Check CONSULTAR SOLICITUD DE CODIFICACIÓN -->
                                                <div class="checkbox">
                                                    <input type="checkbox" data-toggle="toggle" name="smConsultarCodificacion" data-on="Si" data-off="No">
                                                    <label for="exampleInputEmail1" data-toggle="tooltip" data-placement="top" title="Permisos para consultar solicitudes de codificación">Consultar</label>
                                                </div>
                                                <!-- Check EDITAR SOLICITUD DE CODIFICACIÓN -->
                                                <div class="checkbox">
                                                    <input type="checkbox" data-toggle="toggle" name="smEditarCodificacion" data-on="Si" data-off="No">
                                                    <label for="exampleInputEmail1" data-toggle="tooltip" data-placement="top" title="Permisos para editar solicitudes de codificación">Editar</label>
                                                </div>
                                                <!-- Check ELIMINAR SOLICITUD DE CODIFICACIÓN -->
                                                <div class="checkbox">
                                                    <input type="checkbox" data-toggle="toggle" name="smEliminarCodificacion" data-on="Si" data-off="No">
                                                    <label for="exampleInputEmail1" data-toggle="tooltip" data-placement="top" title="Permisos para consultar solicitudes de codificación">Eliminar</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tab-pane fade" id="ct" role="tabpanel" aria-labelledby="custom-tabs-one-messages-tab">
                                            <!-- MODULO PARA DAR LOS PERMISOS QUE TIENE CADA USUARIO CON RELACIÓN A CONTABILIDAD -->
                                            <div class="card-header bg-warning">
                                                Configuraciones Contabilidad y Finanzas.
                                            </div>

                                            <div class="pt-2 card">
                                                <!-- DIV PARA CONTENER LAS OPCIONES  DE LAS ORDENES DE COMPRA-->
                                                <div class="card pt-2">
                                                    <h6 class="text-center">MODULO ORDENES DE COMPRA</h6>
                                                </div>

                                                <p class="pt-2"><B>Gestionar Ordenes de Compra</B> : Permisos para crear, consultar, editar, eliminar : Ordenes de Compra </p>

                                                <!-- Check CREAR ORDENES DE COMPRA -->
                                                <div class="checkbox">
                                                    <input type="checkbox" data-toggle="toggle" name="smCrearOrden" data-on="Si" data-off="No">
                                                    <label for="exampleInputEmail1" data-toggle="tooltip" data-placement="top" title="Permisos para crear ordenes de compra">Crear</label>
                                                </div>
                                                <!-- Check EDITAR ORDEN DE COMPRA -->
                                                <div class="checkbox">
                                                    <input type="checkbox" data-toggle="toggle" name="smEditarOrden" data-on="Si" data-off="No">
                                                    <label for="exampleInputEmail1" data-toggle="tooltip" data-placement="top" title="Permisos para editar ordenes de compra">Editar</label>
                                                </div>
                                                <!-- Check CONSULTAR ORDENES DE COMPRA -->
                                                <div class="checkbox">
                                                    <input type="checkbox" data-toggle="toggle" name="smConsultarOrden" data-on="Si" data-off="No">
                                                    <label for="exampleInputEmail1" data-toggle="tooltip" data-placement="top" title="Permisos para consultar ordenes de compra">Consultar</label>
                                                </div>
                                                <!-- Check ELIMINAR ORDENES DE COMPRA -->
                                                <div class="checkbox">
                                                    <input type="checkbox" data-toggle="toggle" name="smEliminarOrden" data-on="Si" data-off="No">
                                                    <label for="exampleInputEmail1" data-toggle="tooltip" data-placement="top" title="Permisos para eliminar ordenes de compra">Eliminar</label>
                                                </div>

                                                <p class="pt-2"><B>Gestionar Proveedores</B> : Permisos para crear, consultar, editar, eliminar : Proveedores </p>

                                                <!-- Check CREAR PROVEEDOR -->
                                                <div class="checkbox">
                                                    <input type="checkbox" data-toggle="toggle" name="smAdminProveedorLider" data-on="Si" data-off="No">
                                                    <label for="exampleInputEmail1" data-toggle="tooltip" data-placement="top" title="Permisos para crear Proveedores">Administrador de Proveedores Lideres de Proceso</label>
                                                </div>
                                                <!-- Check EDITAR PROVEEDOR -->
                                                <div class="checkbox">
                                                    <input type="checkbox" data-toggle="toggle" name="smAdminProveedorCT" data-on="Si" data-off="No">
                                                    <label for="exampleInputEmail1" data-toggle="tooltip" data-placement="top" title="Permisos para responder actividades que tienen asignadas">Administrador de Proveedores Contabilidad</label>
                                                </div>
                                                <p class="pt-2"><B>Aprobar Ordenes de Compra</B> : Permisos para gestionar el estado de las ordenes de compra </p>

                                                <hr>
                                                <!-- Check TABLA PARA QUE GESTIÓN ADMINISTRATIVA APRUEBE LAS ORDENES DE COMPRA -->
                                                <div class="checkbox">
                                                    <input type="checkbox" data-toggle="toggle" name="smAprobacionGH" data-on="Si" data-off="No">
                                                    <label for="exampleInputEmail1" data-toggle="tooltip" data-placement="top" title="Permisos para aprobar la orden de compra y pase a revision por la gerencia">Aprobación Gestión Administrativa</label>
                                                </div>
                                                <!-- Check TABLA PARA QUE GERENCIA APRUEBE LAS ORDENES DE COMPRA -->
                                                <div class="checkbox">
                                                    <input type="checkbox" data-toggle="toggle" name="smAprobacionGR" data-on="Si" data-off="No">
                                                    <label for="exampleInputEmail1" data-toggle="tooltip" data-placement="top" title="Permisos para aprobar la orden de compra y pase a proceso de pago">Aprobación Gerencia</label>
                                                </div>
                                                <!-- Check TABLA PARA QUE CONTABILIDAD APRUEBE LAS ORDENES DE COMPRA -->
                                                <div class="checkbox">
                                                    <input type="checkbox" data-toggle="toggle" name="smAprobacionCT" data-on="Si" data-off="No">
                                                    <label for="exampleInputEmail1" data-toggle="tooltip" data-placement="top" title="Permisos para ejecutar el pago de las ordenes de compra">Aprobación Contabilidad</label>
                                                </div>
                                            </div>

                                        </div>

                                        <div class="tab-pane fade" id="op" role="tabpanel" aria-labelledby="custom-tabs-one-messages-tab">
                                            <!-- MODULO PARA DAR LOS PERMISOS QUE TIENE CADA USUARIO CON RELACIÓN A CONTABILIDAD -->
                                            <div class="card-header bg-navy">
                                                Configuraciones Operaciones
                                            </div>

                                            <div class="pt-2 card">
                                                <!-- DIV PARA CONTENER LAS OPCIONES  DE LAS ORDENES DE COMPRA-->
                                                <div class="card pt-2">
                                                    <h6 class="text-center">MODULO SERVICIO DE BASCULA</h6>
                                                </div>

                                                <p class="pt-2"><B>Gestionar el Servicio de Bascula</B> : Permisos para crear, consultar, editar, eliminar : Bascula </p>

                                                <!-- Check CREAR SERVICIÓ DE BASCULA -->
                                                <div class="checkbox">
                                                    <input type="checkbox" data-toggle="toggle" name="smCrearBascula" data-on="Si" data-off="No">
                                                    <label for="exampleInputEmail1" data-toggle="tooltip" data-placement="top" title="Permisos para crear ordenes de compra">Crear (Solo habilitar para personal de Operaciones)</label>
                                                </div>
                                                <!-- Check EDITAR PESAJES -->
                                                <div class="checkbox">
                                                    <input type="checkbox" data-toggle="toggle" name="smEditarBascula" data-on="Si" data-off="No">
                                                    <label for="exampleInputEmail1" data-toggle="tooltip" data-placement="top" title="Permisos para editar ordenes de compra">Editar (Solo habilitar para personal de Operaciones)</label>
                                                </div>
                                                <!-- Check CONSULTAR EL ESTADO DE LOS SERVICIOS DE BASCULA -->
                                                <div class="checkbox">
                                                    <input type="checkbox" data-toggle="toggle" name="smBasculaProceso" data-on="Si" data-off="No">
                                                    <label for="exampleInputEmail1" data-toggle="tooltip" data-placement="top" title="Permisos para consultar ordenes de compra">Opciones para Servicio de Bascula en Proceso (Solo habilitar para personal de Operaciones)</label>
                                                </div>
                                                <!-- Check SERVICIO DE BASCULA EN PROCESO DE 2 PESAJE-->
                                                <div class="checkbox">
                                                    <input type="checkbox" data-toggle="toggle" name="smConsultarBascula" data-on="Si" data-off="No">
                                                    <label for="exampleInputEmail1" data-toggle="tooltip" data-placement="top" title="Permisos para consultar ordenes de compra">Acumulado y estado del Servicio de Bascula (Solo habilitar para personal de Operaciones y Contabilidad)</label>
                                                </div>
                                                <!-- Check SERVICIO DE BASCULA EN PROCESO DE FACTURACIÓN -->
                                                <div class="checkbox">
                                                    <input type="checkbox" data-toggle="toggle" name="smBasculaFact" data-on="Si" data-off="No">
                                                    <label for="exampleInputEmail1" data-toggle="tooltip" data-placement="top" title="Permisos para eliminar ordenes de compra">Opciones para Servicio de Bascula en Facturación (Solo habilitar para personal de Contabilidad)</label>
                                                </div>

                                                <p class="pt-2"><B>Gestionar Valor de Formulario</B> : Permisos para parametrizar el valor a facturar por servicio de bascula </p>

                                                <!-- Check VALOR DEL PESAJE -->
                                                <div class="checkbox">
                                                    <input type="checkbox" data-toggle="toggle" name="smValorPesaje" data-on="Si" data-off="No">
                                                    <label for="exampleInputEmail1" data-toggle="tooltip" data-placement="top" title="Permisos para crear Proveedores">Configurar valor de Pesajes</label>
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