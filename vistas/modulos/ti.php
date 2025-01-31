<?php
require_once "configuracion.php";
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
    /* Estilo para eliminar el fondo azul en enlaces activos */
    .nav-link.active {
      background-color: transparent !important; /* Sin fondo */
      color: #FFD700 !important; /* Color dorado cuando está activo */
    }

    /* Estilo para el estado de hover */
    .nav-link:hover {
      background-color: #FFD700 !important; /* Fondo dorado al pasar el ratón */
      color: #003366 !important; /* Color azul al hacer hover */
    }

    /* Estilo para los elementos en la lista (opcional) */
    .nav-item {
      padding: 5px 0;
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
              
                    <div id="usuarios" class="tab-pane">
                        <div class="row">
                            <div class="col-md-12">
                                <?php require "ti/usuarios.php"; ?>
                            </div>
                        </div>
                    </div>
                  


                    <!-- /.FORMULARIO PARA REALIZAR SOLICITUD DE SOPORTE -->
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

                </div>
            </div>
        </div>
    </div>
</div>
</body>

</html>