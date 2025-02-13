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
                    <li class="breadcrumb-item active">DOCUMENTOS EMPRESAS</li>
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
                        <h3 class="card-title font-weight-bold">DOCUMENTOS EMPRESAS</h3>
                    </div>
                    <div class="card-body">
                    <table class="display table table-striped table-valign-middle" width="100%" style="border-radius: 10px; overflow: hidden; box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);">
                            <thead style="background-color: #004085; color: white;">
                                <tr style="text-align: center;">
                                    <th style="padding: 10px; text-align: center;">#</th>
                                    <th style="padding: 10px; text-align: center;">Nit de la Empresa</th>
                                    <th style="padding: 10px; text-align: center;">Nombre de la empresa</th>
                                    <th style="padding: 10px; text-align: center;">Categoria </th>
                                    <th style="padding: 10px; text-align: center;">Nombre Archivo</th>
                                    <th style="padding: 10px; text-align: center;">Tipo Archivo </th>
                                    <th style="padding: 10px; text-align: center;">Estado </th>
                                    <th style="padding: 10px; text-align: center;">Fecha </th>
                                    <th style="padding: 10px; text-align: center;">Asignar fecha </th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $item = null;
                                $valor = null;
                                $documentosEmpresas = ControladorCategorias::ctrMostrarArchivosEmpresa($valor,$item);
                                foreach ($documentosEmpresas as $row) {
                                    echo '<tr style="text-align: center;">
                                        <td>' . $row["id_archivos"] . '</td>
                                        <td>' . $row["id_empresa_fk"] . '</td>
                                        <td>' . $row["NombreEmpresa"] . '</td>
                                        <td>' . $row["nombre_categoria"] . '</td>
                                        <td>' . $row["nombre_archivo"] . '</td>
                                        <td>' . $row["tipo_archivo_empresa"] . '</td>
                                        <td>' . $row["estado_archivo"] . '</td>
                                        <td>' . $row["fecha_archivo"] . '</td>
                                        <td>
                                                <button type="button" 
                                                        class="btn btn-outline-info" 
                                                        data-id_archivos="' . $row["id_archivos"] . '" 
                                                        data-toggle="modal" 
                                                        data-target="#modal-fechadocumentos">
                                                    Asignar
                                                </button>
                                            </td>
                                    </tr>';
                                }
                                ?>
                        </table>

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<div id="modal-fechadocumentos" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="modal-fechadocumentos-label" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h5 class="modal-title" id="modal-fechadocumentos-label">Asignar Fecha</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <!-- Modal Body -->
            <div class="modal-body">
                <form id="formAsignarFecha"  method="POST" enctype="multipart/form-data" >
                    <div class="form-group" hidden>
                        <label for="id_archivos">ID ARCHIVO</label>
                        <input type="text" id="id_archivos" name="id_archivos" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="fecha_archivo">Fecha</label>
                        <input type="date" id="fecha_archivo" name="fecha_archivo" class="form-control" required>
                    </div>
                    <div class="form-group">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary">Guardar</button>
                    <?php
                    $AsignarFecha = new ControladorCategorias();
                    $AsignarFecha->ctrAsignarFecha();
                    ?>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>