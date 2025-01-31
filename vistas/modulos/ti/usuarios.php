<?php

if ($_SESSION["usuarios"] == "off") {

  echo '<script>

    window.location = "inicio";

  </script>';

  return;
}

?>
<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>Administrar usuarios</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="inicio">Inicio</a></li>
          <li class="breadcrumb-item active">INVENTARIO</li>
        </ol>
      </div>
    </div>
  </div>
</section>

<div class="container-fluid">
  <section class="content">

    <div class="box">

      <div class="box-header with-border">

        <button class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarUsuario">

          Agregar usuario

        </button>

      </div>

      <div class="box-body">

        <table class="display table table-bordered table-striped dt-responsive tablas" width="100%">

          <thead>

            <tr>

              <th style="width:10px">#</th>
              <th>Nombre</th>
              <th>Usuario</th>
              <th>Foto</th>
              <th>Perfil</th>
              <th>Estado</th>
              <th>Último login</th>
              <th>Acciones</th>

            </tr>

          </thead>

          <tbody>

            <?php

            $item = null;
            $valor = null;

            $usuarios = ControladorUsuarios::ctrMostrarUsuarios($item, $valor);

            foreach ($usuarios as $key => $value) {

              echo ' <tr>
                  <td>' . ($key + 1) . '</td>
                  <td>' . $value["nombre"] . " ".$value["apellidos_usuario"].'</td>
                  <td>' . $value["correo_usuario"] . '</td>';

              if ($value["foto"] != "") {

                echo '<td><img src="' . $value["foto"] . '" class="img-thumbnail" data-action="zoom" width="40px"></td>';
              } else {

                echo '<td><img src="vistas/img/usuarios/default/anonymous.png" class="img-thumbnail" data-action="zoom" width="40px"></td>';
              }

              echo '<td>' . $value["nombrePerfil"] . '</td>';

              if ($value["estado"] != 0) {

                echo '<td><button class="btn btn-success btn-xs btnActivar" idUsuario="' . $value["id"] . '" estadoUsuario="0">Activado</button></td>';
              } else {

                echo '<td><button class="btn btn-danger btn-xs btnActivar" idUsuario="' . $value["id"] . '" estadoUsuario="1">Desactivado</button></td>';
              }

              echo '<td>' . $value["ultimo_login"] . '</td>
                  <td>

                    <div class="btn-group">

                      <button class="btn btn-warning btnEditarUsuario" idUsuario="' . $value["id"] . '" data-toggle="modal" data-target="#modalEditarUsuario"><i class="fa fa-pencil"></i></button>

                      <button class="btn btn-danger btnEliminarUsuario" idUsuario="' . $value["id"] . '" fotoUsuario="' . $value["foto"] . '" usuario="' . $value["usuario"] . '"><i class="fa fa-times"></i></button>

                    </div>

                  </td>

                </tr>';
            }


            ?>

          </tbody>

        </table>

      </div>

    </div>

  </section>

</div>

<!--=====================================
MODAL AGREGAR USUARIO
======================================-->

<!-- MODAL AGREGAR USUARIO -->

<div class="modal fade" id="modalAgregarUsuario">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Registrar Usuario</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="POST" enctype="multipart/form-data" action="">


          <!--=====================================
                CUERPO DEL MODAL
                ======================================-->
          <div class="modal-body row">


            <!-- ENTRADA PARA EL NOMBRE -->
            <div class="form-group col-md-6">
              <div class="input-group mb-3">
                <div class="input-group-prepend">
                  <span class="input-group-text"><i class="fas fa-address-card"></i></i></span>
                </div>
                <input type="text" class="form-control" name="nuevoNombre" placeholder="Ingresar nombre" required>
              </div>
            </div>

            <!-- ENTRADA PARA LOS APELLIDOS -->
            <div class="form-group col-md-6">
              <div class="input-group mb-3 ">
                <div class="input-group-prepend">
                  <span class="input-group-text"><i class="fas fa-address-card"></i></i></span>
                </div>
                <input type="text" class="form-control" name="apellidos_usuario" placeholder="Apellidos" required>
              </div>
            </div>

            <!-- ENTRADA PARA EL CORREO USUARIO -->
            <div class="form-group col-md-6">
              <div class="input-group mb-3">
                <div class="input-group-prepend">
                  <span class="input-group-text"><i class="fa fa-envelope"></i></span>
                </div>
                <input type="text" class="form-control" name="correo_usuario" placeholder="Ingresar correo" required>
              </div>
            </div>
            <!-- ENTRADA PARA LA CONTRASEÑA -->
            <div class="form-group col-md-6">
              <div class="input-group mb-3">
                <div class="input-group-prepend">
                  <span class="input-group-text"><i class="fa fa-lock"></i></span>
                </div>
                <input type="password" class="form-control" id="nuevoPassword" name="nuevoPassword" placeholder="Ingresar contraseña" required>
                <div class="input-group-append">
                  <button class="btn btn-outline-secondary" type="button" id="togglePassword">
                    <i class="fa fa-eye"></i>
                  </button>
                </div>
              </div>
              <!-- Indicador de fortaleza de la contraseña -->
              <div id="passwordStrength" class="mt-2"></div>
            </div>
            <!-- ENTRADA PARA SELECCIONAR SU PERFIL -->
            <div class="form-group col-md-6">
              <div class="input-group mb-3">
                <div class="input-group-prepend">
                  <span class="input-group-text"><i class="fa fa-users"></i></span>
                </div>
                <input type="text" class="form-control" name="nuevoPerfil" id="nuevoPerfil" list="perfilesList" placeholder="Seleccionar perfil" required>
              </div>
              <!-- Lista de datos para el input -->
              <datalist id="perfilesList">
                <?php
                $item = null;
                $valor = null;
                $perfiles = ControladorPerfiles::ctrMostrarPerfiles($item, $valor);
                foreach ($perfiles as $key => $value) {
                  echo '<option value="' . $value["perfil"] . '">' . $value["descripcion"] . '</option>';
                }
                ?>
              </datalist>
            </div>

            <!-- ENTRADA PARA SUBIR FOTO -->
            <div class="form-group col-md-6">

              <div class="panel">Subir Firma</div>

              <input type="file" class="nuevaFoto" name="nuevaFoto">

              <p class="help-block">Peso máximo de la foto 2MB</p>
              <center>
                <img src="vistas/img/usuarios/default/anonymous.png" class="img-thumbnail previsualizar" width="70%">
              </center>
            </div>
          </div>
          <div class="modal-footer justify-content-between">
            <button type="button" class="btn bg-danger" data-dismiss="modal">Cancelar</button>
            <button type="submit" class="btn bg-success">Guardar</button>
            <?php
            $crearUsuario = new ControladorUsuarios();
            $crearUsuario->ctrCrearUsuario();
            ?>
          </div>
        </form>
      </div>

    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>

<!--=====================================
MODAL EDITAR USUARIO
======================================-->

<div id="modalEditarUsuario" class="modal fade" role="dialog">

  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post" enctype="multipart/form-data">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Editar usuario</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">

            <!-- ENTRADA PARA EL NOMBRE -->

            <div class="form-group">

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-user"></i></span>

                <input type="text" class="form-control input-lg" id="editarNombre" name="editarNombre" value="" required>

              </div>

            </div>

            <!-- ENTRADA PARA EL USUARIO -->

            <div class="form-group">

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-key"></i></span>

                <input type="text" class="form-control input-lg" id="editarUsuario" name="editarUsuario" value="" readonly>

              </div>

            </div>

            <!-- ENTRADA PARA LA CONTRASEÑA -->

            <div class="form-group">

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-lock"></i></span>

                <input type="password" class="form-control input-lg" name="editarPassword" placeholder="Escriba la nueva contraseña">

                <input type="hidden" id="passwordActual" name="passwordActual">

              </div>

            </div>

            <!-- ENTRADA PARA SELECCIONAR SU PERFIL -->

            <div class="form-group">

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-users"></i></span>

                <select class="form-control input-lg" name="editarPerfil" id="editarPerfil">



                  <?php
                  $item = null;
                  $valor = null;

                  $perfiles = ControladorPerfiles::ctrMostrarPerfiles($item, $valor);

                  foreach ($perfiles as $key => $value) {

                    echo '<option value="' . $value["perfil"] . '">' . $value["descripcion"] . '</option>';
                  }

                  ?>

                </select>

              </div>

            </div>

            <!-- ENTRADA PARA SUBIR FOTO -->

            <div class="form-group">

              <div class="panel">SUBIR FOTO</div>

              <input type="file" class="nuevaFoto" name="editarFoto">

              <p class="help-block">Peso máximo de la foto 2MB</p>

              <img src="vistas/img/usuarios/default/anonymous.png" class="img-thumbnail previsualizarEditar" width="100px">

              <input type="hidden" name="fotoActual" id="fotoActual">

            </div>

          </div>

        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

          <button type="submit" class="btn btn-primary">Modificar usuario</button>

        </div>

        <?php

        $editarUsuario = new ControladorUsuarios();
        $editarUsuario->ctrEditarUsuario();

        ?>

      </form>

    </div>

  </div>

</div>

<?php

$borrarUsuario = new ControladorUsuarios();
$borrarUsuario->ctrBorrarUsuario();

?>