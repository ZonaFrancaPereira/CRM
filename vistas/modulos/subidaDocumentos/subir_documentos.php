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
                    <li class="breadcrumb-item active">DOCUMENTOS</li>
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
                        <h3 class="card-title font-weight-bold">Formulario de Documentos</h3>
                    </div>
                    <div class="card-body">
                        <form id="form_subir_documentos" method="POST" enctype="multipart/form-data">
                            <div class="form-group">
                                <label for="id_empresa_fk" class="font-weight-bold">Nombre de la Empresa</label>
                                <input type="text" class="form-control" id="id_empresa_fk" name="id_empresa_fk" placeholder="Ingrese el nit de la empresa" style="border-radius: 5px;" required>
                            </div>
                            <div class="form-group">
                                <label for="id_categoria_fk" class="font-weight-bold">Nombre de la Categoria</label>
                                <input type="text" class="form-control" id="id_categoria_fk" name="id_categoria_fk" placeholder="Ingrese el nit de la empresa" style="border-radius: 5px;" required>
                            </div>
                            <button type="submit" class="btn text-white font-weight-bold" style="background-color: #004085; border-radius: 5px;">Guardar</button>
                            <?php
                            $CrearCategorias = new ControladorCategorias();
                            $CrearCategorias->ctrCrearCategorias();
                            ?>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>