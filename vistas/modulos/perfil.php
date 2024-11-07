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
                                    <div class="card card-primary card-outline">
                                        <div class="card-body box-profile">
                                            <div class="text-center">
                                                <img class="profile-user-img img-fluid img-circle"
                                                    src="vistas/img/plantilla/icono-blanco.png"
                                                    alt="User profile picture">
                                            </div>

                                            <h3 class="profile-username text-center">
                                                <?php echo htmlspecialchars($nombreEmpresa, ENT_QUOTES, 'UTF-8'); ?>
                                            </h3>
                                            <p class="text-muted text-center"><?php echo htmlspecialchars($perfil, ENT_QUOTES, 'UTF-8') . ' - ' . htmlspecialchars($digito, ENT_QUOTES, 'UTF-8'); ?></p>

                                        </div>
                                    </div>
                                    <div class="card card-primary">
                                        <div class="card-header">
                                            <h3 class="card-title">información de la Empresa</h3>
                                        </div>
                                        <div class="card-body">
                                            <strong><i class="fas fa-book mr-1"></i> Nombre Representante Legal</strong>

                                            <p class="text-muted">
                                                <?php echo htmlspecialchars($representante_legal, ENT_QUOTES, 'UTF-8'); ?>
                                            </p>
                                            <hr>
                                            <strong><i class="fas fa-map-marker-alt mr-1"></i>Ciudad</strong>
                                            <p class="text-muted"><?php echo htmlspecialchars($ciudad, ENT_QUOTES, 'UTF-8');  ?></p>

                                            <hr>
                                            <strong><i class="fas fa-map-marker-alt mr-1"></i>Dirección</strong>

                                            <p class="text-muted"><?php echo htmlspecialchars($direccion, ENT_QUOTES, 'UTF-8');  ?></p>
                                            <hr>
                                            <strong><i class="fas fa-phone-alt mr-1"></i> Telefono</strong>
                                            <p class="text-muted">
                                                <?php echo htmlspecialchars($telefono1, ENT_QUOTES, 'UTF-8') . ' - ' . htmlspecialchars($telefono2, ENT_QUOTES, 'UTF-8'); ?>
                                            </p>
                                            <hr>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-9">
                                    <div class="card">
                                        <div class="card-header p-2">
                                            <ul class="nav nav-pills">
                                                <li class="nav-item"><a class="nav-link active" href="#activity" data-toggle="tab">Informacion</a></li>
                                                <li class="nav-item"><a class="nav-link" href="#documentos" data-toggle="tab">Documentos</a></li>
                                                <li class="nav-item"><a class="nav-link" href="#settings" data-toggle="tab">Settings</a></li>
                                            </ul>
                                        </div><!-- /.card-header -->
                                        <div class="card-body">
                                            <div class="tab-content">
                                                <div class="active tab-pane" id="activity">
                                                    <!-- Post -->
                                                    <div class="post">
                                                        <div class="user-block">
                                                            <img class="img-circle img-bordered-sm" src="vistas/img/plantilla/icono-blanco.png" alt="user image">
                                                            <span class="username">
                                                                <a href="#"><?php echo htmlspecialchars($nombreEmpresa, ENT_QUOTES, 'UTF-8'); ?></a>
                                                                <a href="#" class="float-right btn-tool"><i class="fas fa-times"></i></a>
                                                            </span>
                                                            <span class="description"><?php echo htmlspecialchars($perfil, ENT_QUOTES, 'UTF-8') . ' - ' . htmlspecialchars($digito, ENT_QUOTES, 'UTF-8'); ?></p></span>
                                                        </div>
                                                        <!-- /.user-block -->
                                                        <div class="info-container">
                                                            <ul>
                                                                <br><br>
                                                                <li class="list-group-item">
                                                                    <strong><i class="fas fa-user-tie mr-1"></i> Representante Legal:</strong>
                                                                    <a class="float-right"><?php echo htmlspecialchars($representante_legal, ENT_QUOTES, 'UTF-8'); ?></a>
                                                                </li>
                                                                <li class="list-group-item">
                                                                    <strong><i class="fas fa-map-marker-alt mr-1"></i> Dirección:</strong>
                                                                    <a class="float-right"><?php echo htmlspecialchars($direccion, ENT_QUOTES, 'UTF-8'); ?></a>
                                                                </li>
                                                                <li class="list-group-item">
                                                                    <strong><i class="fas fa-city mr-1"></i> Ciudad:</strong>
                                                                    <a class="float-right"><?php echo htmlspecialchars($ciudad, ENT_QUOTES, 'UTF-8'); ?></a>
                                                                </li>
                                                                <li class="list-group-item">
                                                                    <strong><i class="fas fa-phone mr-1"></i> Teléfono 1:</strong>
                                                                    <a class="float-right"><?php echo htmlspecialchars($telefono1, ENT_QUOTES, 'UTF-8'); ?></a>
                                                                </li>
                                                                <li class="list-group-item">
                                                                    <strong><i class="fas fa-phone mr-1"></i> Teléfono 2:</strong>
                                                                    <a class="float-right"><?php echo htmlspecialchars($telefono2, ENT_QUOTES, 'UTF-8'); ?></a>
                                                                </li>
                                                                <li class="list-group-item">
                                                                    <strong><i class="fas fa-calendar-day mr-1"></i> Fecha de Nacimiento del Representante Legal:</strong>
                                                                    <a class="float-right"><?php echo htmlspecialchars($fecha_nacimiento, ENT_QUOTES, 'UTF-8'); ?></a>
                                                                </li>
                                                                <li class="list-group-item">
                                                                    <strong><i class="fas fa-envelope mr-1"></i> Correo Electrónico:</strong>
                                                                    <a class="float-right"><?php echo htmlspecialchars($correo, ENT_QUOTES, 'UTF-8'); ?></a>
                                                                </li>
                                                                <li class="list-group-item">
                                                                    <strong><i class="fas fa-calendar-alt mr-1"></i> Fecha de Inicio de Contrato:</strong>
                                                                    <a class="float-right"><?php echo htmlspecialchars($fecha_contrato, ENT_QUOTES, 'UTF-8'); ?></a>
                                                                </li>
                                                            </ul>

                                                            <button type="submit"
                                                                class="btn btn-primary float-right"
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
                                                    <table class="display table table-bordered table-striped dt-responsive" width="100%">
                                                        <thead>
                                                            <tr>
                                                                <th style="width:10px">#</th>
                                                                <th>Nombre Archivo</th>
                                                                <th>Tipo Archivo</th>
                                                                <th>Acciones</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php
                                                            $item = null;
                                                            $valor = null;

                                                            // Obtener la lista de archivos desde el controlador
                                                            $archivos = ControladorArchivo::ctrMostrarArchivos($item, $valor);

                                                            // Mostrar cada archivo en la tabla
                                                            foreach ($archivos as $key => $value) {
                                                                echo '<tr>
                                                                            <td>' . ($key + 1) . '</td>
                                                                            <td>' . htmlspecialchars($value["nombre_archivo_e"]) . '</td>
                                                                            <td>' . htmlspecialchars($value["tipo_archivo_e"]) . '</td>
                                                                            <td>
                                                                                <div class="btn-group">
                                                                                    <!-- Botón Editar Archivo -->
                                                                                    <button class="btn btn-warning btnEditarArchivo" idArchivo="' . htmlspecialchars($value["cod_archivo_e"]) . '" data-toggle="modal" data-target="#modalEditarArchivo">
                                                                                        <i class="fa fa-edit"></i>
                                                                                    </button>

                                                                                    <!-- Botón Descargar Archivo -->
                                                                                    <button class="btn bg-success" onclick="descargarArchivo(' . htmlspecialchars($value["cod_archivo_e"]) . ', ' . htmlspecialchars($perfil) . ')">
                                                                                        <i class="fa fa-download"></i>
                                                                                    </button>

                                                                                    <!-- Botón Eliminar Archivo -->
                                                                                    <button class="btn btn-danger btnEliminarArchivo" idArchivo="' . htmlspecialchars($value["cod_archivo_e"]) . '">
                                                                                        <i class="fa fa-times"></i>
                                                                                    </button>
                                                                                </div>
                                                                            </td>
                                                                        </tr>';
                                                            }
                                                            ?>
                                                        </tbody>
                                                    </table>
                                                </div>
                                                <script>
                                                   function descargarArchivo(idArchivo, idEmpresa) {
                                                            var xhr = new XMLHttpRequest();
                                                            xhr.open('POST', 'controladores/archivo.controlador.php', true);
                                                            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

                                                            xhr.responseType = 'blob'; // Esperamos un Blob

                                                            xhr.onload = function() {
                                                                if (xhr.status === 200) {
                                                                    var blob = new Blob([xhr.response], { type: 'application/octet-stream' });
                                                                    var link = document.createElement('a');
                                                                    link.href = window.URL.createObjectURL(blob);
                                                                    link.download = "archivo_" + idArchivo + ".docx"; // Nombre del archivo
                                                                    link.click();
                                                                } else {
                                                                    console.error("Error en la descarga del archivo: " + xhr.statusText);
                                                                }
                                                            };

                                                            xhr.onerror = function() {
                                                                console.error("Error en la solicitud.");
                                                            };

                                                            xhr.send('action=descargarArchivoWord&idArchivo=' + idArchivo + '&idEmpresa=' + idEmpresa);
                                                        }

                                                        // Enviar la solicitud POST con los parámetros necesarios
                                                        xhr.send('action=descargarArchivoWord&idArchivo=' + idArchivo + '&idEmpresa=' + idEmpresa);
                                                    
                                                </script>






                                                <div class="tab-pane" id="settings">
                                                    <form class="form-horizontal">
                                                        <div class="form-group row">
                                                            <label for="inputName" class="col-sm-2 col-form-label">Name</label>
                                                            <div class="col-sm-10">
                                                                <input type="email" class="form-control" id="inputName" placeholder="Name">
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label for="inputEmail" class="col-sm-2 col-form-label">Email</label>
                                                            <div class="col-sm-10">
                                                                <input type="email" class="form-control" id="inputEmail" placeholder="Email">
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label for="inputName2" class="col-sm-2 col-form-label">Name</label>
                                                            <div class="col-sm-10">
                                                                <input type="text" class="form-control" id="inputName2" placeholder="Name">
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label for="inputExperience" class="col-sm-2 col-form-label">Experience</label>
                                                            <div class="col-sm-10">
                                                                <textarea class="form-control" id="inputExperience" placeholder="Experience"></textarea>
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label for="inputSkills" class="col-sm-2 col-form-label">Skills</label>
                                                            <div class="col-sm-10">
                                                                <input type="text" class="form-control" id="inputSkills" placeholder="Skills">
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <div class="offset-sm-2 col-sm-10">
                                                                <div class="checkbox">
                                                                    <label>
                                                                        <input type="checkbox"> I agree to the <a href="#">terms and conditions</a>
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <div class="offset-sm-2 col-sm-10">
                                                                <button type="submit" class="btn btn-danger">Submit</button>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                                <div class="modal fade" id="modal-editempresa" tabindex="-1" role="dialog" aria-labelledby="modalEditarEmpresaLabel" aria-hidden="true">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header bg-dark text-white">
                                                                <h5 class="modal-title" id="modalEditarEmpresaLabel">Editar Empresa</h5>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
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
                                                                    <button type="submit" class="btn btn-primary" name="actualizar_empresa" id="actualizar_empresa">Actualizar Empresa</button>

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