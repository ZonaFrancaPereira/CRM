<style>
    .cover-image {
      object-fit: cover; /* Ajusta la imagen para cubrir el contenedor manteniendo la proporción */
      height: 100%; /* Asegura que la imagen tenga el 100% de altura del contenedor */
      width: 100%; /* Asegura que la imagen tenga el 100% de ancho del contenedor */
    }

    .login-box {
      max-width: 400px; /* Ajusta el ancho máximo del contenedor de login */
      width: 100%;
    }

    .vh-100 {
      height: 100vh; /* Asegura que el contenedor tenga una altura de 100% del viewport */
    }

    /* Estilo opcional para mejorar la visibilidad en dispositivos móviles */
    @media (max-width: 767.98px) {
      .login-box {
        margin: 0 15px;
      }
    }
  </style>
<div class="container-fluid vh-100 d-flex p-0">
  <div class="row w-100 m-0 flex-fill">
    <div class="col-md-8 d-flex align-items-center p-0 d-none d-md-flex">
      <!-- Este div se oculta en dispositivos móviles y se muestra en pantallas medianas y más grandes -->
      <img src="vistas/img/plantilla/portada.jpg" class="cover-image">
    </div>
    <div class="col-md-4 d-flex justify-content-center align-items-center p-0">
      <div class="login-box">
        
          <div class="card-header text-center">
            <div class="login-logo">
              <img src="vistas/img/logo.png" width="50%">
            </div>
            <a href="index.php" class="h4"><b>CRM</b></a>
          </div>
          <div class="card-body">
            <p class="login-box-msg">Iniciar Sesión</p>
            <form action="" method="post">
              <div class="input-group mb-3">
                <input type="text" class="form-control" placeholder="Usuario" name="ingUsuario" required>
                <div class="input-group-append">
                  <div class="input-group-text">
                    <span class="fas fa-envelope"></span>
                  </div>
                </div>
              </div>
              <div class="input-group mb-3">
                <input type="password" class="form-control" placeholder="Password" name="ingPassword" required>
                <div class="input-group-append">
                  <div class="input-group-text">
                    <span class="fas fa-lock"></span>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-12">
                  <button type="submit" class="btn btn-primary btn-block">Ingresar</button>
                </div>
              </div>
              <?php
              $login = new ControladorUsuarios();
              $login->ctrIngresoUsuario();
              ?>
            </form>
          </div>
        
      </div>
    </div>
  </div>
</div>