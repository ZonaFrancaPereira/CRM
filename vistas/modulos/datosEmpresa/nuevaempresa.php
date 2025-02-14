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

<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card shadow-lg">
                    <div class="card-header" style="background: linear-gradient(135deg, #1e3c72, #2a5298);">
                        <h3 class="card-title text-white">Agregar Datos de Empresa</h3>
                    </div>
                    <div class="card-body">

                        <form id="crear_empresa" method="POST" enctype="multipart/form-data">
                            <div class="row">
                                <!-- ID -->
                                <div class="form-group col-md-6">
                                    <label class="font-weight-bold">Nit Empresa</label>
                                    <input type="text" class="form-control" id="id" name="id" placeholder="Nit de la empresa" required>
                                </div>

                                <!-- DV -->
                                <div class="form-group col-md-6">
                                    <label class="font-weight-bold">Digito de Verificación</label>
                                    <input type="text" class="form-control" id="dv" name="dv" placeholder="Digito de Verificación" required>
                                </div>
                            </div>

                            <div class="row">
                                <!-- Nombre Empresa -->
                                <div class="form-group col-md-6">
                                    <label class="font-weight-bold">Nombre de la Empresa</label>
                                    <input type="text" class="form-control" id="NombreEmpresa" name="NombreEmpresa" placeholder="Nombre de la empresa" required>
                                </div>

                                <!-- Dirección Empresa -->
                                <div class="form-group col-md-6">
                                    <label class="font-weight-bold">Dirección</label>
                                    <input type="text" class="form-control" id="DireccionEmpresa" name="DireccionEmpresa" placeholder="Dirección de la empresa" required>
                                </div>
                            </div>

                            <div class="row">
                                <!-- Ciudad -->
                                <div class="form-group col-md-6">
                                    <label class="font-weight-bold">Ciudad</label>
                                    <input type="text" class="form-control" id="ciudad" name="ciudad" placeholder="Ciudad" required>
                                </div>

                                <!-- Teléfono -->
                                <div class="form-group col-md-6">
                                    <label class="font-weight-bold">Teléfono</label>
                                    <input type="text" class="form-control" id="Telefono" name="Telefono" placeholder="Teléfono principal" required>
                                </div>
                            </div>

                            <div class="row">
                                <!-- Teléfono 2 -->
                                <div class="form-group col-md-6">
                                    <label class="font-weight-bold">Teléfono 2</label>
                                    <input type="text" class="form-control" id="telefono2" name="telefono2" placeholder="Segundo teléfono">
                                </div>

                                <!-- Correo Electrónico -->
                                <div class="form-group col-md-6">
                                    <label class="font-weight-bold">Correo Electrónico</label>
                                    <input type="text" class="form-control" id="correoElectronico" name="correoElectronico" placeholder="Correo electrónico" required>
                                </div>
                            </div>

                            <div class="row">
                                <!-- Nombre Representante Legal -->
                                <div class="form-group col-md-6">
                                    <label class="font-weight-bold">Representante Legal</label>
                                    <input type="text" class="form-control" id="nombre_rep_legal" name="nombre_rep_legal" placeholder="Nombre del representante legal" required>
                                </div>

                                <!-- Fecha de Nacimiento Representante Legal -->
                                <div class="form-group col-md-6">
                                    <label class="font-weight-bold">Fecha de Nacimiento Representante Legal</label>
                                    <input type="date" name="fecha_nap_red_legal" class="form-control" id="fecha_nap_red_legal">
                                </div>
                            </div>

                            <div class="row">
                                <!-- Fecha de Inicio de Contrato -->
                                <div class="form-group col-md-6">
                                    <label class="font-weight-bold">Fecha de Inicio de Contrato</label>
                                    <input type="date" name="fecha_inicio_contrato" class="form-control" id="fecha_inicio_contrato">
                                </div>

                                <!-- Estado de la Empresa -->
                                <div class="form-group col-md-6">
                                    <label class="font-weight-bold">Estado de la Empresa</label>
                                    <select class="form-control" id="estado_empresa" name="estado_empresa" required>
                                        <option value="">Seleccione el estado</option>
                                        <option value="Cliente">Cliente</option>
                                        <option value="Prospecto">Prospecto</option>
                                    </select>
                                </div>

                            </div>

                            <!-- Botón de envío con estilo similar a "$perfil" -->
                            <div class="form-group text-center">
                                <button type="submit" class="btn" style="
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
                                    onmouseover="this.style.backgroundColor='#f39c12'; this.style.color='#004085'; this.style.borderColor='#004085';"
                                    onmouseout="this.style.backgroundColor='#004085'; this.style.color='#f39c12'; this.style.borderColor='#f39c12';">
                                    Guardar Empresa
                                </button>
                            </div>

                            <?php
                            $CrearEmpresa = new ControladorEmpresa();
                            $CrearEmpresa->ctrCrearEmpresas();
                            ?>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>