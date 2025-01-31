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
          <h1 class="m-0">Administrar Calendarios</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Administrar Calendarios v1</li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content-header -->

  <!-- Main content -->
  <div class="container-fluid">
    <div class="row">


      <!-- Tarjeta para el calendario -->
      <div class="col-md-12">
        <div class="card card-navy">
          <div class="card-header">
            <h3 class="card-title">Calendario de Eventos</h3>
          </div>
          <div class="card-body">
            <!-- Campo de entrada con datalist -->
            <div class="form-group">
              <label for="filtroUsuario">Seleccionar usuario:</label>
              <input type="text" id="filtroUsuario" class="form-control" list="listaUsuarios" value="0">
              <?php
                $item = null;
                $valor = null;
                $usuarios = ControladorUsuarios::ctrMostrarUsuarios($item, $valor);
              ?>
       
              <datalist id="listaUsuarios">
                <option value="0">Todos los usuarios</option>
                <?php foreach ($usuarios as $key => $value) : ?>
                  <option value="<?php echo $value["id"]; ?>"><?php echo $value["nombre"]." ".$value["apellidos_usuario"]; ?></option>
                <?php endforeach; ?>
              
              </datalist>
            </div>
            <!-- Tarjeta para mostrar el usuario seleccionado -->
            <div class="col-md-12">
              <div class="card bg-primary text-white">
                <div class="card-body text-center">
                  <h3 id="usuarioSeleccionado">Todos los usuarios</h3>
                </div>
              </div>
            </div>
            <!-- Contenedor del calendario -->
            <div id="calendar-admin"></div>
          </div>
        </div>
      </div>
    </div>
  </div>


</div>
<!-- /.control-sidebar -->
</div>

<script>
  document.addEventListener("DOMContentLoaded", function() {
    var filtroUsuario = document.getElementById("filtroUsuario");
    var usuarioSeleccionado = document.getElementById("usuarioSeleccionado");

    // Establecer "Todos los usuarios" como valor inicial
    filtroUsuario.value = "0";
    usuarioSeleccionado.textContent = "Todos los usuarios";

    // Actualizar el nombre del usuario seleccionado cuando cambia
    filtroUsuario.addEventListener("input", function() {
      var selectedValue = filtroUsuario.value;
      var selectedText = "Todos los usuarios"; // Valor por defecto

      var options = document.getElementById("listaUsuarios").options;
      for (var i = 0; i < options.length; i++) {
        if (options[i].value === selectedValue) {
          selectedText = options[i].text;
          break;
        }
      }

      usuarioSeleccionado.textContent = selectedText;
    });

    // Configurar y renderizar el calendario
    var Calendar = FullCalendar.Calendar;
    var calendarEl = document.getElementById('calendar-admin');

    var calendar = new Calendar(calendarEl, {
      headerToolbar: {
        left: 'prev,next today',
        center: 'title',
        right: 'dayGridMonth,timeGridWeek,timeGridDay,listWeek'
      },
      locale: 'es',
      editable: false,
      selectable: true,
      themeSystem: 'bootstrap',
      events: function(fetchInfo, successCallback, failureCallback) {
        var usuarioSeleccionado = $('#filtroUsuario').val();

        $.ajax({
          url: 'controladores/agenda.controlador.php',
          method: 'GET',
          data: {
            action: 'obtenerEventosU',
            start: fetchInfo.startStr,
            end: fetchInfo.endStr,
            usuario: usuarioSeleccionado
          },
          success: function(response) {
            try {
              var events = JSON.parse(response);

              if (usuarioSeleccionado !== "0" && events.length > 0) {
                // Mostrar el nombre del usuario en la tarjeta
                var nombreUsuario = events[0].nombre_usuario + " " + events[0].apellido_usuario;
                $('#usuarioSeleccionado').text("Calendario de: " + nombreUsuario);
              } else {
                $('#usuarioSeleccionado').text("Todos los usuarios");
              }

              // Mapear eventos
              var formattedEvents = events.map(event => ({
                id: event.id,
                title: usuarioSeleccionado === "0" ?
                  event.title + " - " + event.nombre_usuario + " " + event.apellido_usuario :
                  event.title,
                start: event.start,
                end: event.end,
                backgroundColor: event.backgroundColor,
                borderColor: event.borderColor,
                textColor: event.textColor
              }));

              successCallback(formattedEvents);
            } catch (e) {
              failureCallback('Error al cargar eventos.');
            }
          },
          error: function(xhr, status, error) {
            failureCallback('Error al cargar eventos: ' + error);
          }
        });
      }
    });

    calendar.render();

    // Refrescar eventos cuando cambia el usuario seleccionado
    $('#filtroUsuario').change(function() {
      calendar.refetchEvents();
    });
  });
</script>