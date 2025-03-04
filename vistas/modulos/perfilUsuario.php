	  <!-- Sidebar Menu -->
 <nav class="mt-2">
   <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

     <li class="nav-item En_linea 1" role="presentation">
       <a data-toggle="tab" href="#acpm" class="nav-link" style="color: #FFD700; font-size: 1.0rem;">
         <i class="nav-icon far fa-smile-wink"></i>
         <p>
           Novedades
         </p>
       </a>
     </li>

     <li class="nav-item En_linea 1" role="presentation">
       <a data-toggle="tab" href="#acpm" class="nav-link" style="color: #FFD700; font-size: 1.0rem;">
         <i class="nav-icon far fa-smile-wink"></i>
         <p>
           Enviar Comentario
         </p>
       </a>
     </li>

   </ul>

   <!-- Estilos dentro del nav -->
   <style>
     /* Estilo para eliminar el fondo azul en enlaces activos */
     .nav-link.active {
       background-color: transparent !important;
       /* Sin fondo */
       color: #FFD700 !important;
       /* Color dorado cuando está activo */
     }

     /* Estilo para el estado de hover */
     .nav-link:hover {
       background-color: #FFD700 !important;
       /* Fondo dorado al pasar el ratón */
       color: #003366 !important;
       /* Color azul al hacer hover */
     }

     /* Estilo para los elementos en la lista (opcional) */
     .nav-item {
       padding: 5px 0;
     }
   </style>

 </nav>

 <!-- /.sidebar-menu -->
 </div>
 <!-- /.sidebar -->
 </aside>

 <!-- Content Wrapper. Contains page content -->
 <div class="content-wrapper">
   <!-- Content Header (Page header) -->
   <div class="content-header">
     <div class="container-fluid">
       <div class="row mb-2">
         <div class="col-sm-6">
           <h1 class="m-0">Perfil</h1>
         </div><!-- /.col -->
         <div class="col-sm-6">
           <ol class="breadcrumb float-sm-right">
             <li class="breadcrumb-item"><a href="#">Home</a></li>
             <li class="breadcrumb-item active">Perfil v1</li>
           </ol>
         </div><!-- /.col -->
       </div><!-- /.row -->
     </div><!-- /.container-fluid -->
   </div>
   <!-- /.content-header -->

   <!-- Main content -->
   <div class="container-fluid">
     <div class="row">


       <!-- Calendario -->
       <div class="col-md-12">
	   <section class="content">
		<div class="container-fluid">
			<div class="row">
				<div class="col-md-3">

					<!-- Profile Image -->
					<div class="card card-primary card-outline">
						<div class="card-body box-profile">
							<div class="text-center">
								<img class="profile-user-img img-fluid" src="<?php echo $_SESSION['firma']; ?>" alt="User profile picture">			</div>

							<h3 class="profile-username text-center text-uppercase"><?php echo $_SESSION['nombre_usuario'] . " " . $_SESSION['apellidos_usuario']; ?></h3>
							<h3 class="profile-username text-center "><?php echo $_SESSION['nombre_cargo'] . " " . $_SESSION['proceso_fk']; ?></h5>
								<span class=" btn btn-primary btn-block fa fa-fw fa-eye password-icon show-password "> Mostrar Contraseña</span>

						</div>
						<!-- Button trigger modal -->
						<button type="button" class="btn bg-teal" data-toggle="modal" data-target="#exampleModal">
							Aviso de Datos Personales
						</button>

						<!-- Modal -->
						<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
							<div class="modal-dialog" role="document">
								<div class="modal-content">
									<div class="modal-header">
										<h5 class="modal-title" id="exampleModalLabel">Aviso Proteccion de Datos Personales </h5>
										<button type="button" class="close" data-dismiss="modal" aria-label="Close">
											<span aria-hidden="true">&times;</span>
										</button>
									</div>
									<div class="modal-body">
									<p>AVISO DE REGISTRO ELECTRÓNICO DE DATOS: Al registrar y entregar sus datos personales mediante este mecanismo electrónico de página web y/o similares, usted declara que conoce nuestra política de tratamiento de datos personales disponible en: www.politicadeprivacidad.co/politica/zfipusuariooperador, también declara que conoce sus derechos como titular de la información y que autoriza de manera libre, voluntaria, previa, explícita, informada e inequívoca a ZONA FRANCA INTERNACIONAL DE PEREIRA SAS USUARIO OPERADOR DE ZONAS FRANCAS con NIT 900.311.215-6 para gestionar sus datos personales bajo los parámetros indicados en dicha política de tratamiento.</p>

									</div>
								
								</div>
							</div>
						</div>

						<!-- /.card-body -->
					</div>
					<!-- /.card -->


					<!-- /.card -->
				</div>
				<!-- /.col -->
				<div class="col-md-9">
					<div class="card">
						<div class="card-header p-2 bg-primary">
							<h5 class="text-center"><B>Configurar Perfil</B></h5>
						</div><!-- /.card-header -->
						<div class="card-body">
							<div class="tab-content">


								<div class="active tab-pane" id="settings">
									<form class="form-horizontal" action="" method="POST" enctype="multipart/form-data">
										<div class="form-group row" hidden>
											<label for="inputName" class="col-sm-2 col-form-label">Usuario</label>
											<div class="col-sm-10">
											<input type="text" name="id" id="id" class="form-control" value="<?php echo $_SESSION['id']; ?>" readonly hidden></div>
											<input type="text" name="nombre" id="nombre" class="form-control" value="<?php echo $_SESSION['nombre']; ?>" readonly></div>
										</div>

										<div class="form-group row" hidden>
											<label for="inputEmail" class="col-sm-2 col-form-label">Contraseña Actual</label>
											<div class="col-sm-10">
												<input type="password" name=""  value="<?php echo $_SESSION['password']; ?>" class="form-control password3" placeholder="Ingrese su actual contraseña">
											</div>
										</div>
										<div class="form-group row">
											<label for="usertag" class="col-sm-2 col-form-label">Nueva Contraseña <font color='brown'> (opcional)</font></label>
											<div class="col-sm-10">
												<input type="password" name="password" class="form-control password1 " placeholder="Ingrese nueva contraseña">
											</div>
										</div>
										<div class="form-group row">
											<label for="inputName2" class="col-sm-2 col-form-label">Confirmar Contraseña </label>
											<div class="col-sm-10">

												<input type="password" name="pass2" class="form-control password2" placeholder="Confirme su nueva contraseña">
											</div>
										</div>
										<div class="form-group row">
											<label for="inputName2" class="col-sm-2 col-form-label">Firma </label>
											<input type="file" name="firma" class="form-control col-sm-10" id="firma">
										</div>
										<div class="form-group row">
											<div class="offset-sm-2 col-sm-10">
												<button type="submit" class="btn btn-success btn-block" name="update" value="Update User">Guardar Cambios</button>
											</div>
										</div>
										<?php
										$ActualizarPerfil = new ControladorPerfiles();
										$ActualizarPerfil->ctrActualizarPerfil();
										?>
									</form>


								</div>
								<!-- /.tab-pane -->
							</div>
							<!-- /.tab-content -->
						</div><!-- /.card-body -->
					</div>
					<!-- /.card -->
				</div>
				<!-- /.col -->
			</div>
			<!-- /.row -->
		</div><!-- /.container-fluid -->
	</section>

       </div>
     </div>
   </div>

 </div>
	 





<script>
	window.addEventListener("load", function() {

		// icono para mostrar contraseña
		showPassword = document.querySelector('.show-password');
		showPassword.addEventListener('click', () => {

			// elementos input de tipo clave
			password3 = document.querySelector('.password3');
			password1 = document.querySelector('.password1');
			password2 = document.querySelector('.password2');

			if (password1.type === "text") {
				password1.type = "password"
				password2.type = "password"
				password3.type = "password"
				showPassword.classList.remove('fa-eye-slash');
			} else {
				password1.type = "text"
				password2.type = "text"
				password3.type = "text"
				showPassword.classList.toggle("fa-eye-slash");
			}

		})

	});
</script>