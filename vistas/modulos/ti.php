<?php
require_once "configuracion.php";

// Validación de sesión
// if ($_SESSION["AdminUsuarios"] != "on") {
//     echo '<script> window.location = "inicio"; </script>';
//     return;
// }
//
?>

<!-- Sidebar Menu -->
<nav class="mt-2">
    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <li class="nav-item">
            <a data-toggle="tab" href="#usuarios" class="nav-link active">
                <i class="fas fa-users"></i>
                <p>Usuarios</p>
            </a>
        </li>
        
        <li class="nav-item">
            <a data-toggle="tab" href="#perfiles" class="nav-link">
                <i class="fas fa-id-card"></i>
                <p>Perfiles</p>
            </a>
        </li>
    </ul>

    <!-- Estilos dentro del nav -->
    <style>
        /* Eliminar fondo azul en enlaces activos */
        .nav-link.active {
            background-color: transparent !important;
            color: #FFD700 !important; /* Color dorado cuando está activo */
        }

        /* Estilo para el estado de hover */
        .nav-link:hover {
            background-color: #FFD700 !important; /* Fondo dorado al pasar el ratón */
            color: #003366 !important; /* Color azul al hacer hover */
        }

        /* Estilo para los elementos en la lista */
        .nav-item {
            padding: 5px 0;
        }
    </style>
</nav>

<!-- Sidebar cierre -->
</aside>

<!-- Contenido principal -->
<div class="content-wrapper">
    <div id="wrapper" class="toggled">
        <div id="page-content-wrapper">
            <div class="container-fluid">
                <div class="tab-content card">

                    <!-- Pestaña Usuarios -->
                    <div id="usuarios" class="tab-pane active">
                        <div class="row">
                            <div class="col-md-12">
                                <?php require "ti/usuarios.php"; ?>
                            </div>
                        </div>
                    </div>

                    <!-- Pestaña Perfiles -->
                    <div id="perfiles" class="tab-pane">
                        <div class="row">
                            <div class="col-md-12">
                                <?php require "ti/perfiles.php"; ?>
                                <?php
                                $borrarPerfil = new ControladorPerfiles();
                                $borrarPerfil->ctrBorrarPerfil();
                                ?>
                            </div>
                        </div>
                    </div>

                </div> <!-- /.tab-content -->
            </div> <!-- /.container-fluid -->
        </div> <!-- /#page-content-wrapper -->
    </div> <!-- /#wrapper -->
</div> <!-- /.content-wrapper -->

</body>
</html>
