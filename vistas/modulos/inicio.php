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
           <h1 class="m-0">Dashboard</h1>
         </div><!-- /.col -->
         <div class="col-sm-6">
           <ol class="breadcrumb float-sm-right">
             <li class="breadcrumb-item"><a href="#">Home</a></li>
             <li class="breadcrumb-item active">Dashboard v1</li>
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
         <div class="card card-primary">
           <div class="card-body p-0">
           
             <div id="calendar"></div>
           </div>
         </div>
       </div>
     </div>
   </div>

 </div>
 
 <!-- Modal para Crear/Editar Evento -->
 
 <div class="modal fade" id="eventModal" tabindex="-1" role="dialog" aria-labelledby="eventModalLabel" aria-hidden="true">
   <div class="modal-dialog" role="document">
     <div class="modal-content">
       <div class="modal-header">
         <h5 class="modal-title" id="eventModalLabel">Crear Evento</h5>
         <button type="button" class="close" data-dismiss="modal" aria-label="Close">
           <span aria-hidden="true">&times;</span>
         </button>
       </div>
       <div class="modal-body">
         <div class="form-group">
           <label for="eventTitle">Título del Evento</label>

           <label for="">Asignar Empresa</label>

           <input list="empresas" id="eventTitle" name="id_usuario_fk_empresa" class="form-control" placeholder="Nombre del responsable" required>
           <datalist id="empresas">
             <?php

              $item = "id_usuario_fk";
              $valor = $_SESSION['id'];
              $usuario = ControladorEmpresa::ctrMostrarEmpresaUsuario($item, $valor);
              foreach ($usuario as $key => $value) {
                echo '<option value="' . $value["id"] . '"> ' . $value["NombreEmpresa"] . '  </option>';
              }
              ?>
           </datalist>

         </div>
         <div class="form-group">
           <label for="eventStart">Fecha y Hora de Inicio</label>
           <input type="datetime-local" class="form-control" id="eventStart">
         </div>
         <div class="form-group">
           <label for="eventEnd">Fecha y Hora de Fin</label>
           <input type="datetime-local" class="form-control" id="eventEnd">
         </div>
         <div class="form-group">
           <label for="eventColor">Color de Fondo</label>
           <input type="color" class="form-control" id="eventColor" value="#007bff">
           <input type="hidden" class="form-control" id="id_usuario_fke" value="<?php echo $_SESSION['id'] ?>">
         </div>
       </div>
       <div class="modal-footer">
         <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
         <button type="button" class="btn btn-danger" id="deleteEvent" style="display:none;">Eliminar Evento</button>
         <button type="button" class="btn btn-primary" id="saveEvent">Guardar Evento</button>
       </div>
     </div>
   </div>
 </div>



 <!-- /.control-sidebar -->
 </div>
 <script>
   $(function() {
     var Calendar = FullCalendar.Calendar;
     var calendarEl = document.getElementById('calendar');
     var currentEventId = null; // Variable para almacenar el ID del evento cuando se edita

     var calendar = new Calendar(calendarEl, {
       headerToolbar: {
         left: 'prev,next today',
         center: 'title',
         right: 'dayGridMonth,timeGridWeek,timeGridDay,listWeek'
       },
       locale: 'es',
       editable: false, // No permitir arrastrar y soltar
       selectable: true, // Habilitar la selección de días
       themeSystem: 'bootstrap',
       events: function(fetchInfo, successCallback, failureCallback) {
         $.ajax({
           url: 'controladores/agenda.controlador.php',
           method: 'GET',
           data: {
             action: 'obtenerEventos',
             start: fetchInfo.startStr,
             end: fetchInfo.endStr
           },
           success: function(response) {
             console.log(response); // Verifica la respuesta del servidor
             try {
               var events = JSON.parse(response);

               successCallback(events);
             } catch (e) {
               failureCallback('Error al cargar eventos.');
             }
           },
           error: function(xhr, status, error) {
             failureCallback('Error al cargar eventos: ' + error);
           }
         });
       },
       // Crear un nuevo evento al hacer clic en un día vacío
       dateClick: function(info) {
         // Al hacer clic en un día vacío, se abrirá el modal para crear un evento
         var selectedDate = info.dateStr; // Fecha seleccionada (en formato 'YYYY-MM-DD')

         // Establecer la fecha de inicio y fin en el modal con la fecha seleccionada
         $('#eventStart').val(selectedDate + 'T09:00'); // Por defecto, la hora de inicio será a las 9:00 AM
         $('#eventEnd').val(selectedDate + 'T10:00'); // Por defecto, la hora de fin será a las 10:00 AM

         // Limpiar el campo de título y color de fondo
         $('#eventTitle').val('');
         $('#eventColor').val('#007bff'); // Establecer color de fondo por defecto

         // Cambiar título del modal a "Crear Evento"
         $('#eventModalLabel').text('Crear Evento');
         $('#deleteEvent').hide(); // Ocultar el botón de eliminar

         // Mostrar el modal
         $.ajax({
           url: "controladores/agenda.controlador.php",
           type: "POST",
           data: {
             action: 'validar'
           },
           dataType: "json",
           success: function(response) {
             console.log("Respuesta del servidor:", response); // Para depuración

             if (response.restriccion) {
               Swal.fire({
                 icon: "warning",
                 title: "Acción no permitida",
                 text: response.mensaje
               });
             } else {
               $("#eventModal").modal("show"); // Si no hay restricción, abre el modal
             }
           },
           error: function(xhr, status, error) {
             console.error("Error en la validación:", error);
             Swal.fire({
               icon: "error",
               title: "Error",
               text: "Hubo un problema al validar las restricciones. Inténtalo nuevamente."
             });
           }
         });

         // Guardar el evento
         $('#saveEvent').off('click').on('click', function() {
           var title = $('#eventTitle').val();
           var start = $('#eventStart').val();
           var end = $('#eventEnd').val();
           var color = $('#eventColor').val();
           var id_usuario_fke = $('#id_usuario_fke').val();

           if (title && start && end) {
             var eventData = {
               title: title,
               start: start,
               end: end,
               backgroundColor: color,
               borderColor: color,
               textColor: "#fff",
               id_usuario_fke: id_usuario_fke
             };

             // Añadir evento al calendario
             calendar.addEvent(eventData);

             // Guardar el evento en la base de datos
             $.ajax({
               url: 'controladores/agenda.controlador.php',
               method: 'POST',
               data: {
                 action: 'crearEvento',
                 title: title,
                 start: start,
                 end: end,
                 backgroundColor: color,
                 borderColor: color,
                 textColor: "#fff",
                 id_usuario_fke: id_usuario_fke
               },
               success: function(response) {
                 $('#eventModal').modal('hide');
                 console.log('Evento guardado:', response);
                 Swal.fire({
                   icon: "success",
                   title: "¡El evento ha sido guardado correctamente!",
                   showConfirmButton: true,
                   confirmButtonText: "Cerrar"
                 }).then((result) => {
                   if (result.isConfirmed) {
                     window.location = "inicio";
                   }
                 });
               },
               error: function(xhr, status, error) {
                 console.error('Error al guardar el evento:', error);
               }
             });
           } else {
             alert('Por favor, complete todos los campos.');
           }
         });
       },
       // Editar un evento al hacer clic sobre un evento existente
       eventClick: function(info) {
         // Al hacer clic en un evento, abrir el modal para editarlo
         var event = info.event;

         // Cargar los datos del evento en los campos del modal
         $('#eventTitle').val(event.title);
         $('#eventStart').val(event.start.toISOString().slice(0, 16)); // Convertir a formato 'YYYY-MM-DDTHH:MM'
         $('#eventEnd').val(event.end.toISOString().slice(0, 16)); // Convertir a formato 'YYYY-MM-DDTHH:MM'
         $('#eventColor').val(event.backgroundColor);

         // Establecer el ID del evento para poder editarlo después
         currentEventId = event.id;

         // Cambiar título del modal a "Editar Evento"
         $('#eventModalLabel').text('Editar Evento');
         $('#deleteEvent').show(); // Mostrar el botón de eliminar

         // Mostrar el modal
         $('#eventModal').modal('show');

         // Guardar los cambios en el evento
         $('#saveEvent').off('click').on('click', function() {
           var title = $('#eventTitle').val();
           var start = $('#eventStart').val();
           var end = $('#eventEnd').val();
           var color = $('#eventColor').val();

           if (title && start && end) {
             event.setProp('title', title);
             event.setStart(start);
             event.setEnd(end);
             event.setProp('backgroundColor', color);
             event.setProp('borderColor', color);
             event.setProp('textColor', "#fff");

             // Actualizar el evento en la base de datos
             $.ajax({
               url: 'controladores/agenda.controlador.php',
               method: 'POST',
               data: {
                 action: 'editarEvento',
                 id: currentEventId,
                 title: title,
                 start: start,
                 end: end,
                 backgroundColor: color,
                 borderColor: color,
                 textColor: "#fff"
               },
               success: function(response) {
                 $('#eventModal').modal('hide');
                 console.log('Evento editado:', response);
               },
               error: function(xhr, status, error) {
                 console.error('Error al editar el evento:', error);
               }
             });
           } else {
             alert('Por favor, complete todos los campos.');
           }
         });

         // Eliminar el evento
         $('#deleteEvent').off('click').on('click', function() {
           Swal.fire({
             title: "¿Estás seguro?",
             text: "¿Quieres eliminar este evento?",
             icon: "warning",
             showCancelButton: true,
             confirmButtonColor: "#d33",
             cancelButtonColor: "#3085d6",
             confirmButtonText: "Sí, eliminar",
             cancelButtonText: "Cancelar"
           }).then((result) => {
             if (result.isConfirmed) {
               // Eliminar el evento del calendario
               event.remove();

               // Eliminar el evento de la base de datos
               $.ajax({
                 url: 'controladores/agenda.controlador.php',
                 method: 'POST',
                 data: {
                   action: 'eliminarEvento',
                   id: currentEventId
                 },
                 success: function(response) {
                   $('#eventModal').modal('hide');
                   Swal.fire("Eliminado", "El evento ha sido eliminado.", "success");
                   console.log('Evento eliminado:', response);
                 },
                 error: function(xhr, status, error) {
                   Swal.fire("Error", "Hubo un problema al eliminar el evento.", "error");
                   console.error('Error al eliminar el evento:', error);
                 }
               });
             }
           });


         });
       }
     });

     // Inicializar el calendario
     calendar.render();
   });
 </script>