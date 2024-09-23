<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">

            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="inicio">Inicio</a></li>
                    <li class="breadcrumb-item active">Inventario</li>
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>

<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header bg-info">
                        <h3 class="card-title">Inventario de Activos Fijos</h3>
                    </div>
                    <div class="card-body row">
                        <?php 
                           $ctrInventario = new ControladorInventario();

                           // Obtener todas las verificaciones asociadas al inventario abierto actualmente
                           $id_inventario_abierto = $ctrInventario->ctrVerificarInventarioAbierto();
                       
                           if ($id_inventario_abierto) { 
                            echo '<div class="alert alert-warning alert-dismissible col-md-12">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                <h5><i class="icon fas fa-exclamation-triangle"></i> Atención!</h5>
                                Actualmente, existe un inventario en proceso. Debe finalizar el inventario actual antes de poder iniciar uno nuevo. Por favor, complete todas las verificaciones y cierre el inventario en curso para proceder con la apertura de un nuevo inventario. Si necesita ayuda, consulte con el administrador del sistema..
                                </div>';
                             }else{ ?>
                        <div id="nuevo_inventario" class="card col-md-12">
                            <form method="post">
                                <label for="fecha_apertura">Fecha de Apertura:</label>
                                <input type="date" class="form-control" id="fecha_apertura" name="fecha_apertura" required>

                                <br>
                                <button type="submit" class="btn bg-success" name="abrir_inventario">Abrir Inventario</button>
                            </form>
                            <?php
                            if (isset($_POST['abrir_inventario'])) {
                                $crearInventario = new ControladorInventario();
                                $crearInventario->ctrAbrirInventario();
                            } 
                            ?>
                        </div>
                        <?php } ?>
                        <div class="card col-md-6">
                            <div class="card-header border-0">
                                <h3 class="card-title">Inventario</h3>

                            </div>
                            <div class="card-body table-responsive p-0">
                                <table id="tabla-inventario" class="table table-striped table-valign-middle">
                                    <thead>
                                        <tr>
                                            <th>Inventario</th>
                                            <th>Fecha Apertura</th>
                                            <th>Fecha Cierre</th>
                                            <th>Estado</th>
                                            <th>Informe</th>
                                            <th>Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                      

                                    </tbody>
                                </table>
                            </div>
                        </div>
                        
                        <div class="card col-md-6">
                        
                            <div class="card-header border-0">
                                <div class="d-flex justify-content-between">
                                    <h3 class="card-title">Estadísticas</h3>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="d-flex">
                                    <p class="d-flex flex-column">
                                        <span class="text-bold text-lg" id="no_verificados"></span>
                                        <span>Cantidad por Verificar</span>
                                    </p>
                                    <p class="ml-auto d-flex flex-column text-right">
                                        <span class="text-success text-lg"  id="verificados">
                                            <i class="fas fa-arrow-up"></i> 
                                        </span>
                                        <span class="text-muted" >Verificados</span>
                                    </p>
                                </div>
                                <!-- /.d-flex -->

                                <div class="position-relative mb-4">
                                    <canvas id="graficaVerificacion"  style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                                </div>

                                
                            </div>
                        </div>
                    </div><!-- /.card-body -->
                </div><!-- /.card -->
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</section><!-- /.content -->

<div class="modal fade" id="modalCerrarInventario" tabindex="-1" role="dialog" aria-labelledby="modalCerrarInventarioLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalCerrarInventarioLabel">Cerrar Inventario</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="formCerrarInventario" method="POST" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="id_inventario">ID de Inventario</label>
                        <input type="text" class="form-control" id="id_inventario" name="id_inventario" readonly hidden>
                    </div>
                    <div class="form-group">
                        <label for="fecha_cierre">Fecha de Cierre</label>
                        <input type="date" class="form-control" id="fecha_cierre" name="fecha_cierre">
                    </div>
                    
                    <button type="submit" class="btn bg-success" name="cerrarInventario">Cerrar Inventario</button>
                    <?php
                if (isset($_POST['cerrarInventario'])) {
                  $cerrarInventario = new ControladorInventario();
                  $cerrarInventario->ctrCerrarInventario();
                }
                ?>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
        document.addEventListener('DOMContentLoaded', function() {
            function cargarGrafica() {
                fetch('controladores/activos.controlador.php?action=graficaVerificacionActivos')
                .then(response => response.json())
                    .then(data => {
                        if (data.error) {
                            console.error('Error en los datos:', data.error);
                        } else if (data.verificados !== undefined && data.no_verificados !== undefined) {
                            // Actualizar los elementos HTML con los valores obtenidos
                            document.getElementById('verificados').textContent = data.verificados;
                            document.getElementById('no_verificados').textContent = data.no_verificados;

                            // Crear la gráfica
                            var pieChartCanvas = document.getElementById('graficaVerificacion').getContext('2d');
                            var pieData = {
                                labels: ['Verificados', 'No Verificados'],
                                datasets: [{
                                    data: [data.verificados, data.no_verificados],
                                    backgroundColor: ['#28a745', '#dc3545'],
                                    borderColor: ['#28a745', '#dc3545']
                                }]
                            };
                            var pieOptions = {
                            maintainAspectRatio: false,
                            responsive: true,
                            plugins: {
                                legend: {
                                    labels: {
                                        color: 'white' // Cambia el color de las etiquetas a blanco
                                    }
                                }
                            }
                        };
                        new Chart(pieChartCanvas, {
                            type: 'pie',
                            data: pieData,
                            options: pieOptions
                        });
                        } else {
                            console.error('Datos no válidos:', data);
                        }
                    })
                    .catch(error => console.error('Error al cargar datos:', error));
            }

            cargarGrafica();
        });
    </script>