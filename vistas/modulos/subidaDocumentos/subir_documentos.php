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
                                <input list="nit_empresas" id="id_empresa_fk" name="id_empresa_fk" class="form-control" placeholder="Ingrese el nit de la empresa" required>
                                <datalist id="nit_empresas">
                                    <?php
                                    $item = null;
                                    $valor = null;
                                    $nit = ControladorEmpresa::ctrMostrarEmpresa($item, $valor);
                                    
                                    foreach ($nit as $key => $value) {
                                        echo '<option value="' . $value["id"] . '"> ' . $value["NombreEmpresa"] . ' </option>';
                                    }
                                    ?>
                                </datalist>
                            </div>
                            <div class="form-group">
                                <label for="id_categoria_fk" class="font-weight-bold">Nombre de la Categoria</label>
                                <input list="categoria" id="id_categoria_fk" name="id_categoria_fk" class="form-control" placeholder="Ingrese el id de la categoria" required>
                                <datalist id="categoria">
                                    <?php
                                    $item = null;
                                    $valor = null;
                                    $idcategoria = ControladorCategorias::ctrMostrarCategoria($item, $valor);
                                    
                                    foreach ($idcategoria as $key => $value) {
                                        echo '<option value="' . $value["id_categoria"] . '"> ' . $value["nombre_categoria"] . ' </option>';
                                    }
                                    ?>
                                </datalist>
                            
                            </div>
                            <div class="form-group">
                                <label for="ruta_archivos_empresas" class="font-weight-bold">Subir Archivo</label>
                                <input type="file" class="form-control" id="ruta_archivos_empresas" name="ruta_archivos_empresas" required>
                            </div>

                            <div class="form-group">
                                <label>Tipo de Archivo</label>
                                <select class="form-control" id="tipo_archivo_empresa" name="tipo_archivo_empresa" required>
                                    <option value="Excel">Excel</option>
                                    <option value="Word">Word</option>
                                    <option value="Pdf">Pdf</option>
                                </select>
                            </div>
                            <button type="submit" class="btn text-white font-weight-bold" style="background-color: #004085; border-radius: 5px;">Guardar</button>
                            <?php
                            $SubirDocumentos = new ControladorCategorias();
                            $SubirDocumentos->ctrSubirDocumentosEmpresa();
                            ?>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>