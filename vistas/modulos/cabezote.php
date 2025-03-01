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
        <a href="index.php" class="nav-link" style="color: #FFD700; font-size: 1.0rem;">Inicio</a>
      </li>
      <?php
if ($_SESSION["AdminUsuarios"] === "on") {
    echo '<li class="nav-item d-none d-sm-inline-block">
            <a href="ti" class="nav-link" style="color: #FFD700; font-size: 1.0rem;">Usuarios</a>
          </li>';
}
?>




      <li class="nav-item d-none d-sm-inline-block">
        <a href="datosEmpresa" class="nav-link" style="color: #FFD700; font-size: 1.0rem;">Empresa</a>
      </li>
      <?php
      if ($_SESSION["SubirDocumentos"] === "on") {
       echo '<li class="nav-item d-none d-sm-inline-block">
        <a href="subirDocumentos" class="nav-link" style="color: #FFD700; font-size: 1.0rem;">Documentos</a>
      </li>';
}
?>


      
      <?php
if ($_SESSION["AdminCalendario"] === "on") {
    echo '<li class="nav-item d-none d-sm-inline-block">
        <a href="calendario" class="nav-link" style="color: #FFD700; font-size: 1.0rem;">Calendario</a>
      </li>';
}
?>



    </ul>
    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto" >
      <!-- MENU PARA DISPOSITIVOS MOVILES -->
      <li class="nav-item dropdown d-block d-sm-block d-md-none">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="fas fa-list-ul"></i>
          <span class="badge badge-warning navbar-badge">3</span>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <span class="dropdown-item dropdown-header">Otros Aplicativos</span>
          <div class="dropdown-divider"></div>
          <a href="index.php" class="dropdown-item"> <i class="fas fa-home"></i> Inicio</a>
          <div class="dropdown-divider"></div>
          <?php
if ($_SESSION["AdminUsuarios"] === "on") {
    echo '<a href="ti" class="dropdown-item"> <i class="fas fa-users"></i> Usuarios</a>
  ';
}
?>
 <div class="dropdown-divider"></div>
<a href="datosEmpresa" class="dropdown-item"> <i class="fas fa-building"></i> Empresa</a>
<div class="dropdown-divider"></div>
<?php
      if ($_SESSION["SubirDocumentos"] === "on") {
       echo '
       <a href="subirDocumentos" class="dropdown-item"> <i class="fas fa-folder"></i> Documentos</a>
       ';
}
?>
 <div class="dropdown-divider"></div>
 <?php
if ($_SESSION["AdminCalendario"] === "on") {
    echo '<a href="calendario" class="dropdown-item"> <i class="fas fa-calendar"></i> Calendario</a>
   ';
}
?>
          
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
    <a href="inicio" class="brand-link">
      <img src="vistas/img/logo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3">
      <span class="brand-text font-weight-light" style="color: #FFD700; font-size: 1.0rem;"></span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">

        <div class="info">
          <a href="perfilUsuario" class="brand-text font-weight-light d-block" style="color: #FFD700; font-size: 1.0rem;"><?php echo $_SESSION["nombre"]; ?></a>
        </div>
      </div>

      <!-- SidebarSearch Form 
      <div class="form-inline">
        <div class="input-group" data-widget="sidebar-search">
          <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Buscar">
          <div class="input-group-append">
            <button class="btn btn-sidebar">
              <i class="fas fa-search fa-fw"></i>
            </button>
          </div>
        </div>
      </div>-->