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
            <div class="col-12 col-sm-6"></div>
            <div class="col-12 col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="inicio">Inicio</a></li>
                    <li class="breadcrumb-item active">EMPRESAS</li>
                </ol>
            </div>
        </div>
    </div>
</section>

<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header bg-info" style="background: linear-gradient(135deg, #1e3c72, #2a5298);">
                        <h3 class="card-title">Empresas - Prospecto</h3>
                    </div>
                    <div class="card-body">

                        <div class="tab-pane show" id="prospecto_empresa">
                            <div class="row">
                                <div class="col-12">
                                    <div class="card">
                                        <div class="card-body table-responsive p-0">
                                            <table class="display table table-striped table-valign-middle" width="100%" style="border-radius: 10px; overflow: hidden; box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);">
                                                <thead style="background-color: #004085; color: white; text-align: center;">
                                                    <tr>
                                                        <th style="padding: 10px;">Nit</th>
                                                        <th style="padding: 10px;">Nombre</th>
                                                        <th style="padding: 10px;">Dirección</th>
                                                        <th style="padding: 10px;">Teléfono</th>
                                                        <th style="padding: 10px;">Nombre Representante Legal</th>
                                                        <th style="padding: 10px;">Correo Electrónico</th>
                                                        <th style="padding: 10px;">Convertir a Cliente</th>
                                                        <th style="padding: 10px;">Perfil</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    $item = null;
                                                    $valor = null;

                                                    $empresas = ControladorEmpresa::ctrMostrarEmpresaProspecto($item, $valor);

                                                    foreach ($empresas as $key => $value) {
                                                        echo '<tr>
                                                            <td>' . $value["id"] . '</td>
                                                            <td>' . $value["NombreEmpresa"] . '</td>
                                                            <td>' . $value["DireccionEmpresa"] . '</td>
                                                            <td>' . $value["Telefono"] . '</td>
                                                            <td>' . $value["nombre_rep_legal"] . '</td>
                                                            <td>' . $value["correoElectronico"] . '</td>
                                                            <td>
                                                                <div class="btn-group d-flex justify-content-center" text-align="center">
                                                                    <button type="button" class="btn" style="
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
                                                                     onmouseover="this.style.backgroundColor=\'#f39c12\'; this.style.color=\'#004085\'; this.style.borderColor=\'#004085\';" 
                                                                onmouseout="this.style.backgroundColor=\'#004085\'; this.style.color=\'#f39c12\'; this.style.borderColor=\'#f39c12\';"
                                                                    data-id="' . $value["id"] . '" data-toggle="modal" data-target="#modal-prospecto"><i class="fas fa-user-edit"></i></button>
                                                                </div>
                                                            </td>
                                                            <td>
                                                            <a class="btn-group d-flex justify-content-center" text-align="center" target="_blank" href="index.php?ruta=perfil&id=' . $value["id"] . '" 
                                                                style="
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
                                                                onmouseover="this.style.backgroundColor=\'#f39c12\'; this.style.color=\'#004085\'; this.style.borderColor=\'#004085\';" 
                                                                onmouseout="this.style.backgroundColor=\'#004085\'; this.style.color=\'#f39c12\'; this.style.borderColor=\'#f39c12\';">
                                                                Perfil
                                                            </a>
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

                        <div class="modal fade" id="modal-prospecto" tabindex="-1" role="dialog" aria-labelledby="modalprospectoLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content" style="
                                    border: none;
                                    background: linear-gradient(135deg, #1e3c72, #2a5298);
                                    border-radius: 10px;
                                    overflow: hidden;
                                    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
                                ">
                                    <div class="modal-header" style="background: #2a5298; color: white;">
                                        <h5 class="modal-title" id="modalprospectoLabel">Convertir a Cliente</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="color: white;">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body" style="color: white;">
                                        <p>¿Estás seguro de que deseas convertir esta empresa en cliente?</p>
                                        <form id="formprospecto" method="POST" enctype="multipart/form-data">
                                            <input type="hidden" id="id_prospecto" name="id_prospecto">
                                            <input type="hidden" id="estado_empresa" name="estado_empresa" value="Cliente">
                                            <button type="submit" class="btn" name="convertir_cliente" id="convertir_cliente" style="
                                                display: inline-block;
                                                border: 2px solid #f39c12;
                                                color: #f39c12;
                                                background-color: transparent;
                                                padding: 8px 15px;
                                                text-decoration: none;
                                                border-radius: 5px;
                                                transition: all 0.3s ease;
                                                font-weight: bold;
                                            ">Aceptar</button>
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal" style="
                                                display: inline-block;
                                                border: none;
                                                color: #2a5298;
                                                background-color: #f39c12;
                                                padding: 8px 15px;
                                                text-decoration: none;
                                                border-radius: 5px;
                                                transition: all 0.3s ease;
                                                font-weight: bold;
                                            ">Cancelar</button>
                                        </form>
                                        <?php
                                        if (isset($_POST["convertir_cliente"])) {
                                            $id_prospecto = $_POST["id_prospecto"];
                                            $estado_empresa = $_POST["estado_empresa"];

                                            $respuesta = ControladorEmpresa::ctrConvertirCliente($id_prospecto, $estado_empresa);

                                            if ($respuesta == "ok") {
                                                echo '<script>
                                                    Swal.fire(
                                                        "Registrado!",
                                                        "La empresa ha sido convertida a cliente con éxito.",
                                                        "success"
                                                    ).then(function() {
                                                        window.location = "";
                                                    });
                                                </script>';
                                            } else {
                                                echo '<script>
                                                    Swal.fire({
                                                        type: "error",
                                                        title: "¡Error!",
                                                        text: "No se pudo convertir la empresa a cliente. Error: ' . $respuesta . '",
                                                        showConfirmButton: true,
                                                        confirmButtonText: "Cerrar"
                                                    });
                                                </script>';
                                            }
                                        }
                                        ?>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>