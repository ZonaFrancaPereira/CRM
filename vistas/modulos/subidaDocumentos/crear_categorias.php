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
                        <h3 class="card-title font-weight-bold">Formulario de Categoría</h3>
                    </div>
                    <div class="card-body">
                        <form id="form_crear_categorias" method="POST" enctype="multipart/form-data">
                            <div class="form-group">
                                <label for="nombre_categoria" class="font-weight-bold">Nombre de la Categoría</label>
                                <input type="text" class="form-control" id="nombre_categoria" name="nombre_categoria" placeholder="Ingrese el nombre de la categoría" style="border-radius: 5px;" required>

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


<!-- Main Content -->
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card border-0 shadow-sm" style="border-radius: 15px; overflow: hidden;">
                    <div class="card-header text-white" style="background: linear-gradient(135deg, #1e3c72, #2a5298);">
                        <h3 class="card-title font-weight-bold">Categorias</h3>
                    </div>
                    <div class="card-body">
                        <table id="tabla-categoria" class="table table-hover table-bordered dt-responsive" width="100%" style="border-radius: 10px; overflow: hidden; box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);">
                            <thead style="background-color: #004085; color: white;">
                                <tr style="text-align: center;">
                                    <th style="padding: 10px; text-align: center;">#</th>
                                    <th style="padding: 10px; text-align: center;">Nombre de la Categoria</th>
                                    <th style="padding: 10px; text-align: center;">Eliminar</th>
                                </tr>
                            </thead>

                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<div class="modal fade" id="modalEliminar" tabindex="-1" role="dialog" aria-labelledby="modalEliminarLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalEliminarLabel">Confirmar Eliminación</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                ¿Estás seguro de que deseas eliminar esta categoría?

            </div>
            <div class="modal-footer">
                <form method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="id_categoria" id="id_categoria_eliminar" value="">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <button type="submit" name="eliminar_categoria" class="btn btn-danger">Eliminar</button>

                    <?php
                    $EliminarCategorias = new ControladorCategorias();
                    $EliminarCategorias->ctrEliminarCategoria();
                    ?>
                </form>
            </div>
        </div>
    </div>
</div>
<script>

</script>