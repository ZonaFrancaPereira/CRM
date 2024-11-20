<nav class="mt-2">
    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <li class="nav-item">
            <a data-toggle="tab" href="#panel" class="active nav-link" style="color: #FFD700; font-size: 1.0rem;">
                <i class="fas fa-desktop"></i>
                <p>Panel de Control</p>
            </a>
        </li>

        <li class="nav-item" name="">
            <a data-toggle="tab" href="#nuevaempresa" class="nav-link" style="color: #FFD700; font-size: 1.0rem;">
                <i class="nav-icon fas fa-qrcode"></i>
                <p> Nueva Empresa</p>
            </a>
        </li>

        <li class="nav-item" name="">
            <a data-toggle="tab" href="#listar_empresa" class="nav-link" style="color: #FFD700; font-size: 1.0rem;">
                <i class="nav-icon fas fa-qrcode"></i>
                <p>Empresas</p>
            </a>
        </li>
    </ul>
    
    <!-- Estilos dentro del nav -->
    <style>
        /* Estilo para eliminar el fondo azul en enlaces activos */
        .nav-link.active {
            background-color: transparent !important;  /* Sin fondo */
            color: #FFD700 !important;  /* Color dorado cuando está activo */
        }

        /* Estilo para el estado de hover */
        .nav-link:hover {
            background-color: #FFD700 !important;  /* Fondo dorado al pasar el ratón */
            color: #003366 !important;  /* Color azul al hacer hover */
        }
    </style>

</nav>


<?php

if ($_SESSION["ti"] == "off") {
    echo '<script>
        window.location = "inicio";
    </script>';
    return;
}

?>
</div>
<!-- /.sidebar -->
</aside>

<div class="content-wrapper">
    <div id="wrapper" class="toggled">
        <div id="page-content-wrapper">
            <div class="container-fluid">
                <div class="tab-content card">

                    <div id="nuevaempresa" class="tab-pane">
                        <div class="row">
                            <div class="col-md-12">
                                <?php require "datosEmpresa/nuevaempresa.php"; ?>
                            </div>
                        </div>
                    </div>

                    <div id="listar_empresa" class="tab-pane">
                        <div class="row">
                            <div class="col-md-12">
                                <?php require "datosEmpresa/listar_empresa.php"; ?>
                            </div>
                        </div>
                    </div>

                    <div id="panel" class="tab-pane active"> <!-- Se añade la clase "active" aquí -->
                        <div class="row">
                            <div class="col-md-12">
                                <?php require "datosEmpresa/panel.php"; ?>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>
