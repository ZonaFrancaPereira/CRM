<div class="wrapper">

  <!-- Preloader -->
  <div class="preloader flex-column justify-content-center align-items-center" hidden>
    <img class="animation__shake" src="vistas/img/logo.png" alt="AdminLTELogo" height="60" width="60">
  </div>

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand" style="background-color: #003366; border-bottom: 3px solid #FFD700;">
      <!-- Left navbar links -->
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>

        <li class="nav-item d-none d-sm-inline-block">
          <a href="index.php" class="nav-link"  style="color: #FFD700; font-size: 1.0rem;">Inicio</a>
        </li>

        <li class="nav-item d-none d-sm-inline-block">
          <a href="ti" class="nav-link" style="color: #FFD700; font-size: 1.0rem;">Usuarios</a>
        </li>

        <li class="nav-item d-none d-sm-inline-block">
          <a href="datosEmpresa" class="nav-link" style="color: #FFD700; font-size: 1.0rem;">Empresa</a>
        </li>

        <li class="nav-item d-none d-sm-inline-block">
          <a href="subirDocumentos" class="nav-link" style="color: #FFD700; font-size: 1.0rem;">Documentos</a>
        </li>

        
        <li class="nav-item dropdown" >
            <a id="dropdownSubMenu1" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle" style="color: #FFD700; font-size: 1.0rem;">Parametrizar</a>
            <ul aria-labelledby="dropdownSubMenu1" class="dropdown-menu border-0 shadow">
              <li><a href="documentos" class="dropdown-item">Documentos </a></li>
              <li><a href="#" class="dropdown-item">Calendario</a></li>
              

              <li class="dropdown-divider"></li>

              <!-- Level two dropdown-->
              <li class="dropdown-submenu dropdown-hover" hidden>
                <a id="dropdownSubMenu2" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">Hover for action</a>
                <ul aria-labelledby="dropdownSubMenu2" class="dropdown-menu border-0 shadow">
                  <li>
                    <a tabindex="-1" href="#" class="dropdown-item">level 2</a>
                  </li>

                  <!-- Level three dropdown-->
                  <li class="dropdown-submenu">
                    <a id="dropdownSubMenu3" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">level 2</a>
                    <ul aria-labelledby="dropdownSubMenu3" class="dropdown-menu border-0 shadow">
                      <li><a href="#" class="dropdown-item">3rd level</a></li>
                      <li><a href="#" class="dropdown-item">3rd level</a></li>
                    </ul>
                  </li>
                  <!-- End Level three -->

                  <li><a href="#" class="dropdown-item">level 2</a></li>
                  <li><a href="#" class="dropdown-item">level 2</a></li>
                </ul>
              </li>
              <!-- End Level two -->
            </ul>
          </li>
       
      </ul>
      <!-- Right navbar links -->
      <ul class="navbar-nav ml-auto">
        <!-- MENU PARA DISPOSITIVOS MOVILES -->
        <li class="nav-item dropdown d-block d-sm-block d-md-none">
          <a class="nav-link" data-toggle="dropdown" href="#">
            <i class="fas fa-list-ul"></i>
            <span class="badge badge-warning navbar-badge">3</span>
          </a>
          <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
            <span class="dropdown-item dropdown-header">Otros Aplicativos</span>
            <div class="dropdown-divider"></div>
            <a href="sadoc.php" class="dropdown-item">
              <i class="fas fa-folder-open"></i> SADOC
              <span class="float-right text-muted text-sm">Ir</span>
            </a>
           
              <div class="dropdown-divider"></div>
              <a href="ordenes.php" class="dropdown-item">
                <i class="fas fa-money-check-alt"></i> Ordenes de Compra
                <span class="float-right text-muted text-sm">Ir</span>
              </a>
          
            <div class="dropdown-divider"></div>
            <a href="acpm.php" class="dropdown-item">
              <i class="fas fa-tasks"></i> ACPM
              <span class="float-right text-muted text-sm">Ir</span>
            </a>
            <div class="dropdown-divider"></div>
            <a href="index.php" class="dropdown-item dropdown-footer">Plataforma ZFIP</a>
          </div>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link" data-toggle="dropdown" href="#">
            <i class="far fa-bell"></i>
            <span class="badge badge-danger navbar-badge"><?= $notificaciones = ($total_acpm + $cantidad_orden + $total_actividades_vencidas); ?></span>
          </a>
          <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
            <span class="dropdown-item dropdown-header"><B><?= $notificaciones; ?> Pendientes</B></span>
            <div class="dropdown-divider"></div>
            <a href="#" class="dropdown-item">
              <i class="far fa-times-circle mr-2"></i> <?= $total_acpm; ?> | ACPM Pendientes
              <span class="float-right badge badge-info">Pendientes</span>
            </a>
            <div class="dropdown-divider"></div>
            <a href="#" class="dropdown-item">
              <i class="far fa-thumbs-down mr-2"></i> <?= $total_actividades_vencidas; ?> | Actividades Vencidas
              <span class="float-right badge badge-danger">Urgente</span>
            </a>
            <div class="dropdown-divider"></div>
            <a href="#" class="dropdown-item">
              <i class="fas fa-cart-plus mr-2"></i> <?= $cantidad_orden; ?> | Ordenes en Proceso
              <span class="float-right badge badge-success">Proceso</span>
            </a>

          </div>
        </li>
        <!-- Notifications Dropdown Menu -->
        <li class="nav-item dropdown">
          <a class="nav-link" data-toggle="dropdown" href="#">

            <i class="fas fa-cogs"></i>
          </a>
          <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
            <i class="dropdown-item dropdown-header">Opciones</i>
            <div class="dropdown-divider"></div>
            <a href="salir" class="dropdown-item">
              <i class="fas fa-sign-in-alt mr-2"></i> Cerrar Sesion

            </a>
            <div class="dropdown-divider"></div>
        </li>
        <li class="nav-item">
          <a class="nav-link" data-widget="fullscreen" href="#" role="button">
            <i class="fas fa-expand-arrows-alt"></i>
          </a>
        </li>

      </ul>
    </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar  elevation-4" style="background-color: #003366; border-bottom: 3px solid #FFD700;">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
      <!-- <img src="vistas/img/logo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8"> -->
      <span class="brand-text font-weight-light" style="color: #FFD700; font-size: 1.0rem;">TM</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        
        <div class="info">
          <a href="#" class="brand-text font-weight-light d-block" style="color: #FFD700; font-size: 1.0rem;"><?php echo $_SESSION["nombre"]; ?></a>
        </div>
      </div>

      <!-- SidebarSearch Form -->
      <div class="form-inline">
        <div class="input-group" data-widget="sidebar-search">
          <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Buscar">
          <div class="input-group-append">
            <button class="btn btn-sidebar">
              <i class="fas fa-search fa-fw"></i>
            </button>
          </div>
        </div>
      </div>

     