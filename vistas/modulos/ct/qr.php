<ul class="products-list product-list-in-card pl-2 pr-2">
    <div class="row">
        <?php
        session_start(); // Asegúrate de iniciar la sesión

        // Incluye el archivo del generador de códigos QR
        include 'qr/barcode.php';
        $generator = new barcode_generator(); // Inicializa el generador de QR

        // Variables de sesión
        $id_usuario = $_SESSION['id'];
        $siglas_usuario = $_SESSION['siglas_usuario'];

        // Generar QR del usuario
        $svg = $generator->render_svg("qr", "https://app.zonafrancadepereira.com/admin/mis_activos.php?Id_usuario=$id_usuario", "");
        $qr = $svg;
        ?>
        <style>
            .product-info {
                
            background-color: #fff;
            color: #000;
           
            cursor: pointer;
           
            }
        </style>
        <li class="col-md-6" style="border: 1px solid black; background: white;">
            <div class="product-img">
                <a href="javascript:void(0)" class="product-title"><?php echo htmlspecialchars($siglas_usuario); ?></a>
                <?= $qr ?>
            </div>
            <div class="product-info">
                <img src="vistas/img/logo_zf.png" width="25%"><br>
                <a href="javascript:void(0)" class="product-title">INVENTARIO GENERAL</a>
                <p style="color:black;">Consulta todos los activos que tienes asignados aquí.</p>
            </div>
        </li>
        <?php
        // Obtener datos de activos desde el controlador
        $item = "id_usuario_fk";
        $valor = $_SESSION['id'];
        $activos = ControladorActivos::ctrMostrarActivos($item, $valor);

        foreach ($activos as $row) {
            $id_activo = $row["id_activo"];
            $nombre_articulo = $row["nombre_articulo"];
            $descripcion_articulo = $row["descripcion_articulo"];

            // Generar QR para cada activo
            $svg = $generator->render_svg("qr", "https://app.zonafrancadepereira.com/admin/ver_activos.php?id_activo=$id_activo", "");
            $qr = $svg;
        ?>
            <li class="col-md-6" style="border: 1px solid black; background: white;">
                <div class="product-img">
                    <a href="javascript:void(0)" class="product-title"><?php echo htmlspecialchars($siglas_usuario); ?></a>
                    <?= $qr ?>
                </div>
                <div class="product-info">
                    <img src="vistas/img/logo_zf.png" width="25%"><br>
                    <a href="javascript:void(0)" class="product-title"><?= htmlspecialchars($nombre_articulo) ?></a>
                    <span class="product-description" style="color:black;"><?= htmlspecialchars($id_activo) ?></span>
                </div>
            </li>
        <?php
        }
        ?>
    </div>
</ul>