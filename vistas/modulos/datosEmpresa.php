<nav class="mt-2">
    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <li class="nav-item">
            <a data-toggle="tab" href="#panel" class="active nav-link">
                <i class="fas fa-desktop"></i>
                <p>Panel de Control</p>
            </a>
        </li>

        <li class="nav-item" name="">
            <a data-toggle="tab" href="#nuevaempresa" class="nav-link">
                <i class="nav-icon fas fa-qrcode"></i>
                <p> Nueva Empresa</p>
            </a>
        </li>

        <li class="nav-item" name="">
            <a data-toggle="tab" href="#listar_empresa" class="nav-link">
                <i class="nav-icon fas fa-qrcode"></i>
                <p>Empresas</p>
            </a>
        </li>
    </ul>
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
