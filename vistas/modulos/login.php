<div class="row">
  <div class="col-md-4"></div>
  <div class="col-md-4">
    <center>
      <div class="login-box pt-5">
        <!-- /.login-logo -->
        <div class="card card-outline card-primary ">
          <div class="card-header text-center">
            <a href="index.php" class="h1"><b>TM</b></a>
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

                <!-- /.col -->
                <div class="col-12">
                  <button type="submit" class="btn btn-primary btn-block">Ingresar</button>
                </div>
                <!-- /.col -->
              </div>
              <?php
              $login = new ControladorUsuarios();
              $login->ctrIngresoUsuario();
              ?>
            </form>


            <!-- /.social-auth-links -->

            <p class="mb-1">
              <a href="forgot-password.php">Olvide mi Contraseña</a>
            </p>
            <p class="mb-0">
              <a href="register.php" class="text-center">Registrarme</a>
            </p>
          </div>
          <!-- /.card-body -->
        </div>
        <!-- /.card -->
      </div>
    </center>
  </div>
  <div class="col-md-4"></div>

</div>