<div class="row">
    <div class="col-lg-12 ">
        <div class="card">
            <div class="card-header border-0 bg-primary">
                <h3 class="card-title">Mis Activos</h3>
                <div class="card-tools">
                </div>
            </div>
            <div class="card-body table-responsive p-0">

                <table class="display table table-striped table-valign-middle" width="100%">
                    <thead>
                        <tr>
                            <th>Cod</th>
                            <th>Fecha</th>
                            <th>Articulo</th>
                            <th>Descripción</th>
                            <th>Modelo</th>
                            <th>Referencia</th>
                            <th>Marca</th>
                            <th>Lugar</th>
                            <th>Observaciones</th>
                            
                            <th>Proveedor</th>
                            <th>Descripción Proveedor</th>
                            <th>Tecnológico</th>
                            <th>Estado</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $item = "id_usuario_fk";
                        $valor = $_SESSION['id'];
                        $activos = ControladorActivos::ctrMostrarActivos($item, $valor);
                        foreach ($activos as $row) {
                            echo '<tr style="text-align:center">';
                            echo '<td>' . $row["id_activo"] . '</td>';
                            echo '<td>' . $row["fecha_asignacion"] . '</td>';
                            echo '<td>' . $row["nombre_articulo"] . '</td>';
                            echo '<td>' . $row["descripcion_articulo"] . '</td>';
                            echo '<td>' . $row["modelo_articulo"] . '</td>';
                            echo '<td>' . $row["referencia_articulo"] . '</td>';
                            echo '<td>' . $row["marca_articulo"] . '</td>';
                            echo '<td>' . $row["lugar_articulo"] . '</td>';
                            echo '<td>' . $row["observaciones_articulo"] . '</td>';
                            echo '<td>' . $row["id_proveedor"] . ' - '. $row["nombre_proveedor"] .'</td>';
                            echo '<td>' . $row["descripcion_proveedor"] . '</td>';
                            echo '<td>' . $row["recurso_tecnologico"] . '</td>';
                            echo '<td>' . $row["estado_activo"] . '</td>';
                            echo '</tr>';
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>