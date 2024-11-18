<?php
if ($_SESSION["datosEmpresa"] == "off") {
    echo '<script>window.location = "inicio";</script>';
    return;
}
?>
<!-- Content Header -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <!-- Puedes agregar un título aquí si lo deseas -->
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="inicio">Inicio</a></li>
                    <li class="breadcrumb-item active">CATEGORIAS</li>
                </ol>
            </div>
        </div>
    </div>
</section>

<!-- Main Content -->
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card border-0 shadow-sm" style="border-radius: 15px; overflow: hidden;">
                    <div class="card-header text-white" style="background: linear-gradient(135deg, #1e3c72, #2a5298);">
                        <h3 class="card-title font-weight-bold">Empresas Asignadas</h3>
                    </div>
                    <div class="card-body">
                        <table id="" class="table table-hover table-bordered dt-responsive" width="100%" style="border-radius: 10px; overflow: hidden; box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);">
                            <thead style="background-color: #004085; color: white; text-align: center;">
                                <tr>
                                    <th style="padding: 10px;">NIT</th>
                                    <th style="padding: 10px;">Nombre</th>
                                    <th style="padding: 10px;">Dirección</th>
                                    <th style="padding: 10px;">Teléfono</th>
                                    <th style="padding: 10px;">Nombre Representante Legal</th>
                                    <th style="padding: 10px;">Correo Electrónico</th>
                                    <th style="padding: 10px;">Perfil</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>