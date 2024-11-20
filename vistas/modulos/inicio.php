 
    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

        <li class="nav-item En_linea 1" role="presentation">
          <a data-toggle="tab" href="#acpm" class="nav-link">
            <i class="nav-icon far fa-smile-wink"></i>
            <p>
              Novedades
            </p>
          </a>
        </li>
        <li class="nav-item En_linea 1" role="presentation">
          <a data-toggle="tab" href="#acpm" class="nav-link">
            <i class="nav-icon far fa-smile-wink"></i>
            <p>
             Enviar Comentario
            </p>
          </a>
        </li>

      </ul>

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
    <!-- Modal para agregar un evento -->
<!-- Modal para Crear/Editar Evento -->
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
                                                <input list="usuarios" type="text" class="form-control" id="eventTitle" required>
                                             
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
$(function () {
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
    editable: false,  // No permitir arrastrar y soltar
    selectable: true, // Habilitar la selección de días
    themeSystem: 'bootstrap',
    events: function (fetchInfo, successCallback, failureCallback) {
      $.ajax({
        url: 'controladores/agenda.controlador.php',
        method: 'GET',
        data: {
          action: 'obtenerEventos',
          start: fetchInfo.startStr,
          end: fetchInfo.endStr
        },
        success: function (response) {
          try {
            var events = JSON.parse(response);
            successCallback(events);
          } catch (e) {
            failureCallback('Error al cargar eventos.');
          }
        },
        error: function (xhr, status, error) {
          failureCallback('Error al cargar eventos: ' + error);
        }
      });
    },
    // Crear un nuevo evento al hacer clic en un día vacío
    dateClick: function (info) {
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
      $('#eventModal').modal('show');

      // Guardar el evento
      $('#saveEvent').off('click').on('click', function () {
        var title = $('#eventTitle').val();
        var start = $('#eventStart').val();
        var end = $('#eventEnd').val();
        var color = $('#eventColor').val();

        if (title && start && end) {
          var eventData = {
            title: title,
            start: start,
            end: end,
            backgroundColor: color,
            borderColor: color,
            textColor: "#fff"
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
              textColor: "#fff"
            },
            success: function (response) {
              $('#eventModal').modal('hide');
              console.log('Evento guardado:', response);
            },
            error: function (xhr, status, error) {
              console.error('Error al guardar el evento:', error);
            }
          });
        } else {
          alert('Por favor, complete todos los campos.');
        }
      });
    },
    // Editar un evento al hacer clic sobre un evento existente
    eventClick: function (info) {
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
      $('#saveEvent').off('click').on('click', function () {
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
            success: function (response) {
              $('#eventModal').modal('hide');
              console.log('Evento editado:', response);
            },
            error: function (xhr, status, error) {
              console.error('Error al editar el evento:', error);
            }
          });
        } else {
          alert('Por favor, complete todos los campos.');
        }
      });

      // Eliminar el evento
      $('#deleteEvent').off('click').on('click', function () {
        if (confirm('¿Estás seguro de que quieres eliminar este evento?')) {
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
            success: function (response) {
              $('#eventModal').modal('hide');
              console.log('Evento eliminado:', response);
            },
            error: function (xhr, status, error) {
              console.error('Error al eliminar el evento:', error);
            }
          });
        }
      });
    }
  });

  // Inicializar el calendario
  calendar.render();
});

    </script>

