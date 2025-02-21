<?php

include 'conexion.php'; // Asegúrate de que el archivo de conexión está en la ruta correcta

// Obtener el ID de ACPM desde la URL y asegurarse de que sea un entero
$perfil = isset($_GET['id']) ? intval($_GET['id']) : 0;

if ($perfil > 0) {
    try {
        // Nombre de la tabla de perfil
        $tabla_perfil = 'datosempresa';

        // Preparar la consulta para obtener datos de ACPM
        $query_perfil = "SELECT 
                $tabla_perfil.*, 
                usuarios.nombre, 
                usuarios.apellidos_usuario
            FROM 
                $tabla_perfil
            INNER JOIN 
                usuarios 
            ON 
                $tabla_perfil.id_usuario_fk = usuarios.id
            WHERE 
                $tabla_perfil.id = :perfil
        ";

        // Preparar la consulta
        $stmt_perfil = Conexion::conectar()->prepare($query_perfil);

        // Vincular el parámetro
        $stmt_perfil->bindParam(':perfil', $perfil, PDO::PARAM_INT);

        // Ejecutar la consulta
        $stmt_perfil->execute();

        // Obtener el resultado
        $resultado = $stmt_perfil->fetch(PDO::FETCH_ASSOC);

        // Comprobar si se obtuvieron resultados
        if ($resultado) {
            // Almacenar el nombre de la empresa
            $nombreEmpresa = $resultado['NombreEmpresa']; // Asegúrate de que 'nombre_empresa' es el nombre correcto del campo en tu tabla
            $digito = $resultado['dv'];
            $representante_legal = $resultado['nombre_rep_legal'];
            $direccion = $resultado['DireccionEmpresa'];
            $ciudad = $resultado['ciudad'];
            $telefono1 = $resultado['Telefono'];
            $telefono2 = $resultado['telefono2'];
            $fecha_nacimiento = $resultado['fecha_nap_red_legal'];
            $correo = $resultado['correoElectronico'];
            $fecha_contrato = $resultado['fecha_inicio_contrato'];
        } else {
            echo 'No se encontraron datos para el ID proporcionado.';
        }
    } catch (PDOException $e) {
        echo 'Error: ' . $e->getMessage();
    }
} else {
    echo 'ID ACPM no válido.';
}

?>

<!-- /.sidebar-menu -->
</div>
<!-- /.sidebar -->
</aside>
<!-- Content Wrapper -->
<div class="content-wrapper">
    <!-- /.content-header -->
    <!-- Sección de Contenido Principal -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <!-- Content Header (Page header) -->
                    <section class="content-header">
                        <div class="container-fluid">
                            <div class="row mb-2">
                                <div class="col-sm-6"></div>
                                <div class="col-sm-6">
                                    <ol class="breadcrumb float-sm-right">
                                        <li class="breadcrumb-item"><a href="inicio">Inicio</a></li>
                                        <li class="breadcrumb-item active">Perfil</li>
                                    </ol>
                                </div>
                            </div>
                        </div>
                    </section>
                    <!-- Main content -->
                    <section class="content">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-md-3">
                                    <!-- Profile Image -->
                                    <div class="card card-primary card-outline" style="border: 2px solid #1e3c72; border-radius: 10px;">
                                        <div class="card-body box-profile">
                                            <div class="text-center">

                                            </div>
                                            <h3 class="profile-username text-center" style="color: #2a5298;">
                                                <?php echo htmlspecialchars($nombreEmpresa, ENT_QUOTES, 'UTF-8'); ?>
                                            </h3>
                                            <p class="text-muted text-center" style="color: #2a5298;">
                                                <?php echo htmlspecialchars($perfil, ENT_QUOTES, 'UTF-8') . ' - ' . htmlspecialchars($digito, ENT_QUOTES, 'UTF-8'); ?>
                                            </p>


                                        </div>
                                    </div>

                                    <div class="card card-primary" style="border: 2px solid #1e3c72; border-radius: 10px;">
                                        <div class="card-header text-center" style="background: linear-gradient(135deg, #1e3c72, #2a5298); color: white; border-bottom: 4px solid #f39c12;">
                                            <h3 class="card-title">Información de la Empresa</h3>
                                        </div>
                                        <div class="card-body">
                                            <ul class="list-group list-group-flush text-center">
                                                <li class="list-group-item border-0">
                                                    <strong><i class="fas fa-user-tie mr-2" style="color: #f39c12;"></i> Representante Legal:</strong>
                                                    <br>
                                                    <span style="color: #000000;"><?php echo htmlspecialchars($representante_legal, ENT_QUOTES, 'UTF-8'); ?></span>
                                                </li>
                                                <li class="list-group-item border-0">
                                                    <strong><i class="fas fa-map-marker-alt mr-2" style="color: #f39c12;"></i> Ciudad:</strong>
                                                    <br>
                                                    <span style="color: #000000;"><?php echo htmlspecialchars($ciudad, ENT_QUOTES, 'UTF-8'); ?></span>
                                                </li>
                                                <li class="list-group-item border-0">
                                                    <strong><i class="fas fa-map-marker-alt mr-2" style="color: #f39c12;"></i> Dirección:</strong>
                                                    <br>
                                                    <span style="color: #000000;"><?php echo htmlspecialchars($direccion, ENT_QUOTES, 'UTF-8'); ?></span>
                                                </li>
                                                <li class="list-group-item border-0">
                                                    <strong><i class="fas fa-phone-alt mr-2" style="color: #f39c12;"></i> Teléfono:</strong>
                                                    <br>
                                                    <span style="color: #000000;"><?php echo htmlspecialchars($telefono1, ENT_QUOTES, 'UTF-8') . ' - ' . htmlspecialchars($telefono2, ENT_QUOTES, 'UTF-8'); ?></span>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>

                                </div>
                                <div class="col-md-9">
                                    <div class="card shadow-lg border-0 rounded-lg">
                                        <?php if ($resultado['estado_empresa'] == 'Cliente') : ?>
                                            <div class="card-header p-" style="background: linear-gradient(135deg, #1e3c72, #2a5298); color: white; border-bottom: 4px solid #f39c12; box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2); border-radius: 12px;">
                                                <ul class="nav nav-pills d-flex flex-wrap justify-content-center gap-2" style="font-size: 1rem; font-weight: bold; padding: 0;">
                                                    <li class="nav-item flex-grow-1 text-center">
                                                        <a class="nav-link active" href="#activity" data-toggle="tab" style="color: #f1c40f; background: rgba(255, 255, 255, 0.15); border-radius: 12px; padding: 10px; transition: all 0.3s ease; box-shadow: 0px 3px 6px rgba(0, 0, 0, 0.15); display: block;">
                                                            <i class="fas fa-info-circle"></i> Información
                                                        </a>
                                                    </li>
                                                    <li class="nav-item flex-grow-1 text-center">
                                                        <a class="nav-link" href="#documentos" data-toggle="tab" style="color: #f1c40f; background: rgba(255, 255, 255, 0.15); border-radius: 12px; padding: 10px; transition: all 0.3s ease; box-shadow: 0px 3px 6px rgba(0, 0, 0, 0.15); display: block;">
                                                            <i class="fas fa-file-alt"></i> Documentos
                                                        </a>
                                                    </li>
                                                    <li class="nav-item flex-grow-1 text-center">
                                                        <a class="nav-link" href="#settings" data-toggle="tab" style="color: #f1c40f; background: rgba(255, 255, 255, 0.15); border-radius: 12px; padding: 10px; transition: all 0.3s ease; box-shadow: 0px 3px 6px rgba(0, 0, 0, 0.15); display: block;">
                                                            <i class="fas fa-cog"></i> Subir Documentos
                                                        </a>
                                                    </li>
                                                    <li class="nav-item flex-grow-1 text-center">
                                                        <a class="nav-link" href="#registrar_visita" data-toggle="tab" style="color: #f1c40f; background: rgba(255, 255, 255, 0.15); border-radius: 12px; padding: 10px; transition: all 0.3s ease; box-shadow: 0px 3px 6px rgba(0, 0, 0, 0.15); display: block;">
                                                            <i class="fas fa-calendar-check"></i> Registrar Visita
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>


                                        <?php elseif ($resultado['estado_empresa'] == 'Prospecto') : ?>
                                            <div class="card-header p-" style="background: linear-gradient(135deg, #1e3c72, #2a5298); color: white; border-bottom: 4px solid #f39c12; box-shadow: 0 8px 24px rgba(0, 0, 0, 0.2); border-radius: 12px;">
                                                <ul class="nav nav-pills d-grid" style="display: grid; grid-template-columns: repeat(4, 1fr); gap: 10px; text-align: center; font-size: 1.1rem; font-weight: bold; padding: 0;">
                                                    <li class="nav-item">
                                                        <a class="nav-link active" href="#activity" data-toggle="tab" style="color: #f1c40f; background: rgba(255, 255, 255, 0.15); border-radius: 15px; padding: 12px; transition: all 0.4s ease; box-shadow: 0px 6px 12px rgba(0, 0, 0, 0.2);">
                                                            <i class="fas fa-info-circle"></i> Información
                                                        </a>
                                                    </li>
                                                    <li class="nav-item">
                                                        <a class="nav-link" href="#propuesta" data-toggle="tab" style="color: #f1c40f; background: rgba(255, 255, 255, 0.15); border-radius: 15px; padding: 12px; transition: all 0.4s ease; box-shadow: 0px 6px 12px rgba(0, 0, 0, 0.2);">
                                                            <i class="fas fa-file-upload"></i> Subir Propuesta
                                                        </a>
                                                    </li>
                                                    <li class="nav-item">
                                                        <a class="nav-link" href="#cotizacion" data-toggle="tab" style="color: #f1c40f; background: rgba(255, 255, 255, 0.15); border-radius: 15px; padding: 12px; transition: all 0.4s ease; box-shadow: 0px 6px 12px rgba(0, 0, 0, 0.2);">
                                                            <i class="fas fa-file-invoice"></i> Panel Cotización
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                        <?php endif; ?>

                                        <div class="card-body bg-light">
                                            <div class="tab-content">
                                                <div class="active tab-pane" id="activity">
                                                    <!-- Post -->
                                                    <div class="post">
                                                        <div class="user-block d-flex flex-wrap align-items-center mb-3">

                                                            <div class="flex-grow-1">
                                                                <span class="username font-weight-bold">
                                                                    <a href="#" style="color: #1e3c72;"><?php echo htmlspecialchars($nombreEmpresa, ENT_QUOTES, 'UTF-8'); ?></a>
                                                                    <a href="#" class="btn-tool text-secondary float-right"><i class="fas fa-times"></i></a>
                                                                </span>
                                                                <span class="description text-muted d-block" style="color: #2a5298;"><?php echo htmlspecialchars($perfil, ENT_QUOTES, 'UTF-8') . ' - ' . htmlspecialchars($digito, ENT_QUOTES, 'UTF-8'); ?></span>
                                                            </div>
                                                        </div>

                                                        <!-- Info Container -->
                                                        <div class="info-container p-3 rounded-lg" style="background-color: #fff; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">
                                                            <ul class="list-unstyled mb-4">
                                                                <li class="list-group-item border-0 d-flex justify-content-between align-items-center">
                                                                    <strong><i class="fas fa-user-tie mr-1"></i> Representante Legal:</strong>
                                                                    <span class="text-dark"><?php echo htmlspecialchars($representante_legal, ENT_QUOTES, 'UTF-8'); ?></span>
                                                                </li>
                                                                <li class="list-group-item border-0 d-flex justify-content-between align-items-center">
                                                                    <strong><i class="fas fa-map-marker-alt mr-1"></i> Dirección:</strong>
                                                                    <span class="text-dark"><?php echo htmlspecialchars($direccion, ENT_QUOTES, 'UTF-8'); ?></span>
                                                                </li>
                                                                <li class="list-group-item border-0 d-flex justify-content-between align-items-center">
                                                                    <strong><i class="fas fa-city mr-1"></i> Ciudad:</strong>
                                                                    <span class="text-dark"><?php echo htmlspecialchars($ciudad, ENT_QUOTES, 'UTF-8'); ?></span>
                                                                </li>
                                                                <li class="list-group-item border-0 d-flex justify-content-between align-items-center">
                                                                    <strong><i class="fas fa-phone mr-1"></i> Teléfono 1:</strong>
                                                                    <span class="text-dark"><?php echo htmlspecialchars($telefono1, ENT_QUOTES, 'UTF-8'); ?></span>
                                                                </li>
                                                                <li class="list-group-item border-0 d-flex justify-content-between align-items-center">
                                                                    <strong><i class="fas fa-phone mr-1"></i> Teléfono 2:</strong>
                                                                    <span class="text-dark"><?php echo htmlspecialchars($telefono2, ENT_QUOTES, 'UTF-8'); ?></span>
                                                                </li>
                                                                <li class="list-group-item border-0 d-flex justify-content-between align-items-center">
                                                                    <strong><i class="fas fa-calendar-day mr-1"></i> Fecha de Nacimiento del Representante Legal:</strong>
                                                                    <span class="text-dark"><?php echo htmlspecialchars($fecha_nacimiento, ENT_QUOTES, 'UTF-8'); ?></span>
                                                                </li>
                                                                <li class="list-group-item border-0 d-flex justify-content-between align-items-center">
                                                                    <strong><i class="fas fa-envelope mr-1"></i> Correo Electrónico:</strong>
                                                                    <span class="text-dark"><?php echo htmlspecialchars($correo, ENT_QUOTES, 'UTF-8'); ?></span>
                                                                </li>
                                                                <li class="list-group-item border-0 d-flex justify-content-between align-items-center">
                                                                    <strong><i class="fas fa-calendar-alt mr-1"></i> Fecha de Inicio de Contrato:</strong>
                                                                    <span class="text-dark"><?php echo htmlspecialchars($fecha_contrato, ENT_QUOTES, 'UTF-8'); ?></span>
                                                                </li>
                                                            </ul>

                                                            <button type="submit"
                                                                class="btn mt-3"
                                                                style="background: linear-gradient(135deg, #1e3c72, #2a5298); color: white; border: 2px solid #f39c12; border-radius: 10px; padding: 10px 20px; font-weight: bold; transition: all 0.3s ease-in-out; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); float: right;"
                                                                data-representante-legal="<?php echo htmlspecialchars($representante_legal, ENT_QUOTES, 'UTF-8'); ?>"
                                                                data-id="<?php echo htmlspecialchars($perfil, ENT_QUOTES, 'UTF-8'); ?>"
                                                                data-dv=" <?php echo htmlspecialchars($digito, ENT_QUOTES, 'UTF-8'); ?>"
                                                                data-nombre="<?php echo htmlspecialchars($nombreEmpresa, ENT_QUOTES, 'UTF-8'); ?>"
                                                                data-direccion="<?php echo htmlspecialchars($direccion, ENT_QUOTES, 'UTF-8'); ?>"
                                                                data-ciudad="<?php echo htmlspecialchars($ciudad, ENT_QUOTES, 'UTF-8'); ?>"
                                                                data-telefono="<?php echo htmlspecialchars($telefono1, ENT_QUOTES, 'UTF-8'); ?>"
                                                                data-telefono2="<?php echo htmlspecialchars($telefono2, ENT_QUOTES, 'UTF-8'); ?>"
                                                                data-nombre-rep="<?php echo htmlspecialchars($representante_legal, ENT_QUOTES, 'UTF-8'); ?>"
                                                                data-correo="<?php echo htmlspecialchars($correo, ENT_QUOTES, 'UTF-8'); ?>"
                                                                data-toggle="modal"
                                                                data-target="#modal-editempresa">
                                                                Actualizar Empresa
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="tab-pane" id="documentos">
                                                    <div class="card mb-4">
                                                        <div class="card-header" style="background: linear-gradient(135deg, #1e3c72, #2a5298); color: white; border-bottom: 4px solid #f39c12;">
                                                            <h3 class="card-title text-center">Archivos de la Empresa</h3>
                                                        </div>
                                                        <div class="card-body">
                                                            <table class="display table table-bordered table-striped dt-responsive" width="100%">
                                                                <thead>
                                                                    <tr>
                                                                        <th style="width:10px">#</th>
                                                                        <th>Categoria</th>
                                                                        <th>Nombre Archivo</th>
                                                                        <th>Acciones</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    <?php
                                                                    $item = null;
                                                                    $valor = null;
                                                                    // Obtener la lista de archivos desde el controlador
                                                                    $archivos = ControladorCategorias::ctrMostrarArchivosEmpresas($item, $valor);

                                                                    // Mostrar cada archivo en la tabla
                                                                    foreach ($archivos as $key => $value) {
                                                                        // Obtén el nombre del archivo desde la base de datos
                                                                        $archivo = htmlspecialchars($value["ruta_archivos_empresas"]);
                                                                        // Genera la ruta correcta solo con la parte relativa a la carpeta EMPRESAS
                                                                        $rutaArchivo = $archivo; // Ya debe ser una ruta válida, como 'EMPRESAS/archivo.pdf'

                                                                        echo '<tr>
                                                                                <td>' . htmlspecialchars($value["id_archivos"]) . '</td>
                                                                                <td>' . htmlspecialchars($value["nombre_categoria"]) . '</td>
                                                                                <td>' . htmlspecialchars($value["nombre_archivo"]) . '</td>
                                                                                <td>
                                                                                    <div class="btn-group">
                                                                                        <!-- Botón Descargar Archivo -->
                                                                                        <button class="btn bg-success" onclick="descargarArchivo(\'' . $rutaArchivo . '\')">
                                                                                            <i class="fa fa-download"></i>
                                                                                        </button>
                                                                                    </div>
                                                                                </td>
                                                                            </tr>';
                                                                    }
                                                                    ?>
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>

                                                    <div class="card">
                                                        <div class="card-header" style="background: linear-gradient(135deg, #1e3c72, #2a5298); color: white; border-bottom: 4px solid #f39c12;">
                                                            <h3 class="card-title text-center">Visitas de la Empresa</h3>
                                                        </div>
                                                        <div class="card-body">
                                                            <table class="display table table-bordered table-striped dt-responsive" width="100%">
                                                                <thead>
                                                                    <tr>
                                                                        <th style="width:10px">#</th>
                                                                        <th>Fecha de la Visita</th>
                                                                        <th>Formato</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    <?php
                                                                    $item = null;
                                                                    $valor = null;
                                                                    // Obtener el ID de ACPM desde la URL y asegurarse de que sea un entero
                                                                    $visita = isset($_GET['id']) ? intval($_GET['id']) : 0;
                                                                    // Obtener la lista de archivos desde el controlador
                                                                    $archivos = ControladorEmpresa::ctrMostrarVisita($item, $valor, $visita);

                                                                    // Mostrar cada archivo en la tabla
                                                                    foreach ($archivos as $key => $value) {

                                                                        echo '<tr>
                                                                                <td>' . htmlspecialchars($value["id_visita"]) . '</td>
                                                                                <td>' . htmlspecialchars($value["fecha_visita"]) . '</td>
                                                                                <td><a target="_blank" href="extensiones/tcpdf/pdf/visitaspdf.php?id=' . htmlspecialchars($value["id_visita"], ENT_QUOTES, 'UTF-8') . '" class="btn btn-outline-success"><i class="fas fa-file-signature"></i> Formato</a></td>
                                                                                
                                                                            </tr>';
                                                                    }
                                                                    ?>
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="tab-pane" id="settings">
                                                    <form id="form_subir_documentos" method="POST" enctype="multipart/form-data">
                                                        <div class="form-group">
                                                            <label for="id_empresa_fk" class="font-weight-bold">Nombre de la Empresa</label>
                                                            <input type="text" id="id_empresa_fk" name="id_empresa_fk" class="form-control" value="<?php echo htmlspecialchars($perfil, ENT_QUOTES, 'UTF-8'); ?>" placeholder="Ingrese el nit de la empresa" readonly>
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
                                                            <label for="nombre_archivo" class="font-weight-bold">Nombre del Documento</label>
                                                            <input type="text" class="form-control" id="nombre_archivo" name="nombre_archivo" required>
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

                                                <div class="tab-pane" id="registrar_visita">
                                                    <form id="form_registrar_visita" method="POST" enctype="multipart/form-data">
                                                        <div class="form-group">
                                                            <label for="id_empresa_fk_visita" class="font-weight-bold">Nombre de la Empresa</label>
                                                            <input type="text" id="id_empresa_fk_visita" name="id_empresa_fk_visita" class="form-control" value="<?php echo htmlspecialchars($perfil, ENT_QUOTES, 'UTF-8'); ?>" placeholder="Ingrese el nit de la empresa" readonly>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="" class="font-weight-bold">Fecha de la Visita</label>
                                                            <input type="date" class="form-control" id="fecha_visita" name="fecha_visita" required>
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="hora_inicio" class="font-weight-bold">Hora Inicio</label>
                                                            <input type="time" class="form-control" id="hora_inicio" name="hora_inicio" required>
                                                        </div>
                                                        <div class="card-header" style="background: linear-gradient(135deg, #1e3c72, #2a5298); color: white; border-bottom: 4px solid #f39c12;">
                                                            <h3 class="card-title text-center">Actividades Realizadas</h3>
                                                        </div>
                                                        <div class="form-group">
                                                            <table class="table pt-2" id="tabla">
                                                                <thead class="text-center">
                                                                    <tr>
                                                                        <th>Actividad</th>
                                                                        <th>Eliminar</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    <tr class="fila-fija ">
                                                                        <td class="col-md-6">
                                                                            <textarea class="textarea form-control" name="actividades_realizadas[]" id="actividades_realizadas" class=" form-control" cols="10" rows="5"></textarea>
                                                                        </td>
                                                                        <td class="eliminar col-md-1 text-center">
                                                                            <input type="button" class="btn btn-danger" value="X" />
                                                                        </td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                            <div class="col-md-2 text-center mt-2">
                                                                <button id="adicional" name="adicional" type="button" class="adicional btn btn-info btn-block"> <i class="fas fa-plus"></i> Agregar</button>
                                                            </div>
                                                        </div>
                                                        <div class="card-header" style="background: linear-gradient(135deg, #1e3c72, #2a5298); color: white; border-bottom: 4px solid #f39c12;">
                                                            <h3 class="card-title text-center">Compromisos</h3>
                                                        </div>
                                                        <div class="form-group">
                                                            <table class="table pt-2" id="tabla2">
                                                                <thead class="text-center">
                                                                    <tr>
                                                                        <th>Fecha Proyectada</th>
                                                                        <th>Descripcion</th>
                                                                        <th>Responsable</th>
                                                                        <th>Observaciones</th>
                                                                        <th>Eliminar</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    <tr class="fila-fija2 ">
                                                                        <td class="col-md-2">
                                                                            <input type="date" class="form-control" name="fecha_proyectada[]" id="fecha_proyectada">
                                                                        </td>
                                                                        <td class="col-md-4">
                                                                            <textarea name="descripcion_compromiso[]" id="descripcion_compromiso" class=" form-control" cols="10" rows="5"></textarea>
                                                                        </td>
                                                                        <td>
                                                                            <input list="usuarios" id="id_responsable_fk" name="id_responsable_fk[]" class="form-control">
                                                                            <datalist id="usuarios">
                                                                                <?php
                                                                                if ($usuario["id"] <> 0) {
                                                                                    echo '<option value="' . $value["id"] . '"> ' . $value["nombre"] . ' ' . $value["apellidos_usuario"] . ' </option>';
                                                                                }
                                                                                $item = null;
                                                                                $valor = null;
                                                                                $usuario = ControladorUsuarios::ctrMostrarUsuarios($item, $valor);
                                                                                foreach ($usuario as $key => $value) {
                                                                                    echo '<option value="' . $value["id"] . '"> ' . $value["nombre"] . ' ' . $value["apellidos_usuario"] . ' </option>';
                                                                                }
                                                                                ?>
                                                                            </datalist>
                                                                        </td>
                                                                        <td class="col-md-4">
                                                                            <textarea name="observaciones_compromiso[]" id="observaciones_compromiso" class=" form-control" cols="10" rows="5"></textarea>
                                                                        </td>
                                                                        <td class="eliminar col-md-1 text-center">
                                                                            <input type="button" class="btn btn-danger" value="X" />
                                                                        </td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                            <div class="col-md-2 text-center mt-2">
                                                                <button id="adicional2" name="adicional2" type="button" class="adicional2 btn btn-info btn-block"> <i class="fas fa-plus"></i> Agregar</button>
                                                            </div>
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="hora_fin" class="font-weight-bold">Hora Fin</label>
                                                            <input type="time" class="form-control" id="hora_fin" name="hora_fin" required>
                                                        </div>

                                                        <div class="card-header" style="background: linear-gradient(135deg, #1e3c72, #2a5298); color: white; border-bottom: 4px solid #f39c12;">
                                                            <h3 class="card-title text-center">Datos de quien recibió la visita</h3>
                                                        </div>
                                                        <div class="row pt-5">
                                                            <div class="col-md-6 form-group">
                                                                <label for="cc_cliente" class="font-weight-bold">Identificación </label>
                                                                <input type="text" class="form-control" id="cc_cliente" name="cc_cliente" required placeholder="CC del Cliente">
                                                            </div>
                                                            <div class="col-md-6 form-group">
                                                                <label for="nombre_cliente" class="font-weight-bold">Nombre</label>
                                                                <input type="text" class="form-control" id="nombre_cliente" name="nombre_cliente" required placeholder="Nombre del cliente">
                                                            </div>
                                                            <div class="col-md-6 text-center" hidden>
                                                                <h3>Firma del Operador</h3>
                                                                <canvas id="canvasOperador" width="400" height="200" style="border:1px solid #000; margin-bottom: 10px;"></canvas>
                                                                <br>
                                                                <button type="button" id="btnLimpiarOperador" class="btn bg-warning">Limpiar</button>
                                                                <button type="button" id="btnDescargarOperador" class="btn btn-success" hidden>Descargar</button>
                                                            </div>

                                                            <div class="col-md-12 text-center">
                                                                <label for="" class="font-weight-bold">Firma de Cliente</label>
                                                                <input type="hidden" name="base64" value="" id="base64">

                                                                <canvas id="canvasZonaFranca" width="400" height="200" style="border:1px solid #000; margin-bottom: 10px;"></canvas>
                                                                <br>
                                                                <button type="button" id="btnLimpiarZonaFranca" class="btn bg-warning">Limpiar</button>
                                                                <button type="button" id="btnDescargarZonaFranca" class="btn btn-success" hidden>Descargar</button>
                                                            </div>
                                                        </div>
                                                        <div class="pt-2">
                                                            <button type="submit" class="btn text-white font-weight-bold btn-block" style="background-color: #004085; border-radius: 5px;">Guardar</button>
                                                            <?php
                                                            $RegistrarVisita = new ControladorEmpresa();
                                                            $RegistrarVisita->ctrRegistrarVisita();
                                                            ?>
                                                        </div>
                                                    </form>
                                                </div>

                                                <div class="tab-pane" id="propuesta">
                                                    <form id="form_subir_propuesta" method="POST" enctype="multipart/form-data">
                                                        <div class="form-group">
                                                            <label for="id_empresa_prospecto" class="font-weight-bold">Nombre de la Empresa</label>
                                                            <input type="text" id="id_empresa_prospecto" name="id_empresa_prospecto" class="form-control" value="<?php echo htmlspecialchars($perfil, ENT_QUOTES, 'UTF-8'); ?>" placeholder="Ingrese el nit de la empresa" readonly>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="id_categoria_prospecto" class="font-weight-bold">Nombre de la Categoria</label>
                                                            <select id="id_categoria_prospecto" name="id_categoria_prospecto" class="form-control" required>
                                                                <option value="" disabled selected>Seleccione una categoría</option>
                                                                <?php
                                                                $item = null;
                                                                $valor = null;
                                                                $idcategoria = ControladorCategorias::ctrMostrarCategoria($item, $valor);

                                                                foreach ($idcategoria as $key => $value) {
                                                                    echo '<option value="' . $value["id_categoria"] . '">' . $value["nombre_categoria"] . '</option>';
                                                                }
                                                                ?>
                                                            </select>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="nombre_propuesta" class="font-weight-bold">Nombre del Documento</label>
                                                            <input type="text" class="form-control" id="nombre_propuesta" name="nombre_propuesta" required>
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="ruta_archivos_propuesta" class="font-weight-bold">Subir Archivo</label>
                                                            <input type="file" class="form-control" id="ruta_archivos_propuesta" name="ruta_archivos_propuesta" required>
                                                        </div>

                                                        <div class="form-group">
                                                            <label>Tipo de Archivo</label>
                                                            <select class="form-control" id="tipo_archivo_propuesta" name="tipo_archivo_propuesta" required>
                                                                <option value="Excel">Excel</option>
                                                                <option value="Word">Word</option>
                                                                <option value="Pdf">Pdf</option>
                                                            </select>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="fecha_propuesta" class="font-weight-bold">Fecha Propuesta</label>
                                                            <input type="date" class="form-control" id="fecha_propuesta" name="fecha_propuesta" required>
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="valor_propuesta" class="font-weight-bold">Valor Propuesta</label>
                                                            <input type="number" class="form-control" id="valor_propuesta" name="valor_propuesta" required>
                                                        </div>

                                                        <button type="submit" class="btn text-white font-weight-bold" style="background-color: #004085; border-radius: 5px;">Guardar</button>
                                                        <?php
                                                        $SubirPropuesta = new ControladorCategorias();
                                                        $SubirPropuesta->ctrSubirCotizacion();
                                                        ?>
                                                    </form>
                                                </div>

                                                <div class="tab-pane" id="cotizacion">
                                                    <div class="card mb-4">
                                                        <div class="card-header" style="background: linear-gradient(135deg, #1e3c72, #2a5298); color: white; border-bottom: 4px solid #f39c12;">
                                                            <h3 class="card-title text-center">Cotizacion</h3>
                                                        </div>
                                                        <div class="card-body">
                                                            <table class="display table table-bordered table-striped dt-responsive" width="100%">
                                                                <thead>
                                                                    <tr>
                                                                        <th style="width:10px">#</th>
                                                                        <th>Categoria</th>
                                                                        <th>Nombre Archivo</th>
                                                                        <th>Fecha</th>
                                                                        <th>Valor</th>
                                                                        <th>Acciones</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    <?php
                                                                    $item = null;
                                                                    $valor = null;
                                                                    // Obtener la lista de archivos desde el controlador
                                                                    $archivos = ControladorCategorias::ctrMostrarArchivosCotizacion($item, $valor);

                                                                    // Mostrar cada archivo en la tabla
                                                                    foreach ($archivos as $key => $value) {
                                                                        // Obtén el nombre del archivo desde la base de datos
                                                                        $archivo = htmlspecialchars($value["ruta_archivos_propuesta"]);
                                                                        // Genera la ruta correcta solo con la parte relativa a la carpeta EMPRESAS
                                                                        $rutaArchivo = $archivo; // Ya debe ser una ruta válida, como 'EMPRESAS/archivo.pdf'

                                                                        echo '<tr>
                                                                                <td>' . htmlspecialchars($value["id_propuesta"]) . '</td>
                                                                                <td>' . htmlspecialchars($value["nombre_categoria"]) . '</td>
                                                                                <td>' . htmlspecialchars($value["nombre_propuesta"]) . '</td>
                                                                                <td>' . htmlspecialchars($value["fecha_propuesta"]) . '</td>
                                                                                <td>' . htmlspecialchars($value["valor_propuesta"]) . '</td>
                                                                                <td>
                                                                                    <div class="btn-group">
                                                                                        <!-- Botón Descargar Archivo -->
                                                                                        <button class="btn bg-success" onclick="descargarArchivo(\'' . $rutaArchivo . '\')">
                                                                                            <i class="fa fa-download"></i>
                                                                                        </button>
                                                                                    </div>
                                                                                </td>
                                                                            </tr>';
                                                                    }
                                                                    ?>
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="modal fade" id="modal-editempresa" tabindex="-1" role="dialog" aria-labelledby="modalEditarEmpresaLabel" aria-hidden="true">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header p-3" style="background: linear-gradient(135deg, #1e3c72, #2a5298); color: white; border-bottom: 4px solid #f39c12; box-shadow: 0 8px 24px rgba(0, 0, 0, 0.2);">
                                                                <h5 class="modal-title" id="modalEditarEmpresaLabel" style="font-size: 1.3rem; font-weight: bold;">
                                                                    Editar Empresa
                                                                </h5>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="color: #f1c40f; font-size: 1.5rem; background: rgba(255, 255, 255, 0.15); border-radius: 15px; padding: 5px 10px; transition: all 0.4s ease; box-shadow: 0px 6px 12px rgba(0, 0, 0, 0.2);">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <form id="formEditarEmpresa" method="POST" enctype="multipart/form-data">
                                                                    <div class="form-group">
                                                                        <label for="id_empresa">NIT Empresa</label>
                                                                        <input type="text" class="form-control" id="id_empresa" name="id_empresa" required>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="dv_empresa">Dígito de Verificación Empresa</label>
                                                                        <input type="text" class="form-control" id="dv_empresa" name="dv_empresa" required>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="nombre_empresa">Nombre Empresa</label>
                                                                        <input type="text" class="form-control" id="nombre_empresa" name="nombre_empresa" required>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="direccion_empresa">Dirección Empresa</label>
                                                                        <input type="text" class="form-control" id="direccion_empresa" name="direccion_empresa" required>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="ciudad_empresa">Ciudad Empresa</label>
                                                                        <input type="text" class="form-control" id="ciudad_empresa" name="ciudad_empresa" required>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="telefono_empresa">Teléfono Empresa 1</label>
                                                                        <input type="text" class="form-control" id="telefono_empresa" name="telefono_empresa" required>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="telefono2_empresa">Teléfono Empresa 2</label>
                                                                        <input type="text" class="form-control" id="telefono2_empresa" name="telefono2_empresa">
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="nombre_rep_legal_empresa">Nombre Representante Legal Empresa</label>
                                                                        <input type="text" class="form-control" id="nombre_rep_legal_empresa" name="nombre_rep_legal_empresa" required>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="correo_empresa">Correo Electrónico Empresa</label>
                                                                        <input type="text" class="form-control" id="correo_empresa" name="correo_empresa" required>
                                                                    </div>
                                                                    <button style="background: linear-gradient(135deg, #1e3c72, #2a5298); color: white; border: 2px solid #f39c12; border-radius: 10px; padding: 10px 20px; font-weight: bold; transition: all 0.3s ease-in-out; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); float:right;"
                                                                        type="submit" class="btn btn-primary" name="actualizar_empresa" id="actualizar_empresa">Actualizar Empresa</button>

                                                                    <?php
                                                                    $ActualizarEmpresa = new ControladorEmpresa();
                                                                    $ActualizarEmpresa->ctrActualizarEmpresa();
                                                                    ?>
                                                                </form>

                                                            </div>
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
                </div>
            </div>
        </div>
    </section>
</div>
<!-- /.content-wrapper -->
<?php require('footer.php'); ?>
<!-- Agregar un poco de estilo para los estados activos -->
<style>
    .nav-link.active {
        background: linear-gradient(135deg, #f39c12, #f1c40f);
        /* gradiente dorado */
        color: #fff !important;
        transform: scale(1.05);
    }

    .nav-link:hover {
        background: rgba(255, 255, 255, 0.25);
        box-shadow: 0px 8px 16px rgba(0, 0, 0, 0.3);
        transform: scale(1.05);
    }
</style>
<script>
    function descargarArchivo(rutaArchivo) {
        // Verificar si la ruta ya incluye 'vistas/files/', si es así, no agregarla
        var prefijo = 'vistas/files/';
        if (!rutaArchivo.startsWith(prefijo)) {
            // Si no tiene el prefijo 'vistas/files/', agregarlo
            rutaArchivo = prefijo + rutaArchivo;
        }

        // Crear un enlace dinámico para descargar el archivo
        var enlace = document.createElement('a');
        // Concatenar la ruta completa con el prefijo 'CRM/' para generar la URL correcta
        enlace.href = '/CRM/' + rutaArchivo; // Ahora la ruta se forma correctamente
        enlace.download = rutaArchivo.substring(rutaArchivo.lastIndexOf('/') + 1); // Extrae el nombre del archivo

        // Agregar el enlace al documento y hacer clic para descargar
        document.body.appendChild(enlace);
        enlace.click();

        // Eliminar el enlace del DOM después de usarlo
        document.body.removeChild(enlace);
    }
</script>

<script>
    // Función para inicializar el canvas y asociar los eventos
    function inicializarCanvas(canvasId, btnLimpiarId, btnDescargarId, nombreArchivo, inputBase64Id) {
        const canvas = document.getElementById(canvasId);
        const contexto = canvas.getContext("2d");
        const COLOR_PINCEL = "black";
        const COLOR_FONDO = "white";
        const GROSOR = 2;
        let xAnterior = 0,
            yAnterior = 0,
            xActual = 0,
            yActual = 0;
        let haComenzadoDibujo = false;

        // Establece el color de fondo inicial del canvas
        const limpiarCanvas = () => {
            contexto.fillStyle = COLOR_FONDO;
            contexto.fillRect(0, 0, canvas.width, canvas.height);
        };
        limpiarCanvas(); // Limpia el canvas al cargar la página

        // Botón para limpiar el canvas
        document.getElementById(btnLimpiarId).onclick = limpiarCanvas;

        // Botón para descargar el contenido del canvas como una imagen PNG
        document.getElementById(btnDescargarId).onclick = () => {
            try {
                const imagenDataURL = canvas.toDataURL("image/png");
                if (imagenDataURL) {
                    const enlace = document.createElement('a');
                    enlace.href = imagenDataURL;
                    enlace.download = `${nombreArchivo}.png`;

                    // Solución para navegadores: agregar el enlace al DOM y hacer clic programático
                    document.body.appendChild(enlace);
                    enlace.click();
                    document.body.removeChild(enlace);
                } else {
                    alert("Error: No se pudo generar la imagen del canvas.");
                }
            } catch (error) {
                console.error("Error al descargar la imagen:", error);
                alert("Error al guardar la imagen. Verifica la consola para más detalles.");
            }
        };

        // Función para iniciar el dibujo
        const onClicOToqueIniciado = (evento) => {
            evento.preventDefault();
            xAnterior = xActual;
            yAnterior = yActual;
            xActual = evento.clientX ? evento.clientX - canvas.getBoundingClientRect().left : evento.touches[0].clientX - canvas.getBoundingClientRect().left;
            yActual = evento.clientY ? evento.clientY - canvas.getBoundingClientRect().top : evento.touches[0].clientY - canvas.getBoundingClientRect().top;
            contexto.beginPath();
            contexto.fillStyle = COLOR_PINCEL;
            contexto.fillRect(xActual, yActual, GROSOR, GROSOR);
            contexto.closePath();
            haComenzadoDibujo = true;
        };

        // Función para dibujar a medida que se mueve el mouse o el toque
        const onMouseODedoMovido = (evento) => {
            evento.preventDefault();
            if (!haComenzadoDibujo) return;
            xAnterior = xActual;
            yAnterior = yActual;
            xActual = evento.clientX ? evento.clientX - canvas.getBoundingClientRect().left : evento.touches[0].clientX - canvas.getBoundingClientRect().left;
            yActual = evento.clientY ? evento.clientY - canvas.getBoundingClientRect().top : evento.touches[0].clientY - canvas.getBoundingClientRect().top;
            contexto.beginPath();
            contexto.moveTo(xAnterior, yAnterior);
            contexto.lineTo(xActual, yActual);
            contexto.strokeStyle = COLOR_PINCEL;
            contexto.lineWidth = GROSOR;
            contexto.stroke();
            contexto.closePath();
        };

        // Función para finalizar el dibujo
        const onMouseODedoLevantado = () => {
            haComenzadoDibujo = false;
        };



        // Event listeners para los distintos tipos de eventos
        canvas.addEventListener("mousedown", onClicOToqueIniciado); // Mouse click
        canvas.addEventListener("touchstart", onClicOToqueIniciado); // Touch start
        canvas.addEventListener("mousemove", onMouseODedoMovido); // Mouse move
        canvas.addEventListener("touchmove", onMouseODedoMovido); // Touch move
        canvas.addEventListener("mouseup", onMouseODedoLevantado); // Mouse up
        canvas.addEventListener("mouseout", onMouseODedoLevantado); // Mouse out
        canvas.addEventListener("touchend", onMouseODedoLevantado); // Touch end
        canvas.addEventListener("touchcancel", onMouseODedoLevantado); // Touch cancel
    }

    // Inicializar los canvas para cada firma
    window.onload = function() {
        // Asegúrate de pasar el id del input base64 para cada canvas
        inicializarCanvas("canvasOperador", "btnLimpiarOperador", "btnDescargarOperador", "Firma_Operador", "base64Operador");
        inicializarCanvas("canvasZonaFranca", "btnLimpiarZonaFranca", "btnDescargarZonaFranca", "Firma_Usuario_Zona_Franca", "base64ZonaFranca");
    };
</script>

<script>
    document.getElementById('form_registrar_visita').addEventListener("submit", function(e) {

        var ctx = document.getElementById("canvasZonaFranca");
        var image = ctx.toDataURL(); // data:image/png....
        document.getElementById('base64').value = image;
    }, false);

    document.querySelectorAll('option').forEach(option => {
        if (!option.textContent.trim()) {
            option.textContent = option.value;
        }
    });
</script>



<style>
    canvas {
        max-width: 100%;
        height: auto;
    }
</style>