 
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
    <section class="content">
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-3">
                    <div class="sticky-top mb-3">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Draggable Events</h4>
                            </div>
                            <div class="card-body">
                                <div id="external-events">
                                    <div class="external-event bg-success">Lunch</div>
                                    <div class="external-event bg-warning">Go home</div>
                                    <div class="external-event bg-info">Do homework</div>
                                    <div class="external-event bg-primary">Work on UI design</div>
                                    <div class="external-event bg-danger">Sleep tight</div>
                                    <div class="checkbox">
                                        <label for="drop-remove">
                                            <input type="checkbox" id="drop-remove">
                                            remove after drop
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Create Event</h3>
                            </div>
                            <div class="card-body">
                                <div class="btn-group" style="width: 100%; margin-bottom: 10px;">
                                    <ul class="fc-color-picker" id="color-chooser">
                                        <li><a class="text-primary" href="#"><i class="fas fa-square"></i></a></li>
                                        <li><a class="text-warning" href="#"><i class="fas fa-square"></i></a></li>
                                        <li><a class="text-success" href="#"><i class="fas fa-square"></i></a></li>
                                        <li><a class="text-danger" href="#"><i class="fas fa-square"></i></a></li>
                                        <li><a class="text-muted" href="#"><i class="fas fa-square"></i></a></li>
                                    </ul>
                                </div>
                                <div class="input-group">
                                    <input id="new-event" type="text" class="form-control" placeholder="Event Title">
                                    <div class="input-group-append">
                                        <button id="add-new-event" type="button" class="btn btn-primary">Add</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-9">
                    <div class="card card-primary">
                        <div class="card-body p-0">
                            <div id="calendar"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    </section>
    <!-- /.content -->
  </div>



  <!-- /.control-sidebar -->
</div>

<script>
    $(function () {
        function ini_events(ele) {
            ele.each(function () {
                var eventObject = {
                    title: $.trim($(this).text())
                }
                $(this).data('eventObject', eventObject)
                $(this).draggable({
                    zIndex        : 1070,
                    revert        : true,
                    revertDuration: 0
                })
            })
        }

        ini_events($('#external-events div.external-event'))

        var Calendar = FullCalendar.Calendar;
        var Draggable = FullCalendar.Draggable;

        var containerEl = document.getElementById('external-events');
        var calendarEl = document.getElementById('calendar');

        new Draggable(containerEl, {
            itemSelector: '.external-event',
            eventData: function(eventEl) {
                return {
                    title: eventEl.innerText,
                    backgroundColor: window.getComputedStyle(eventEl, null).getPropertyValue('background-color'),
                    borderColor: window.getComputedStyle(eventEl, null).getPropertyValue('background-color'),
                    textColor: window.getComputedStyle(eventEl, null).getPropertyValue('color'),
                };
            }
        });

        var calendar = new Calendar(calendarEl, {
            headerToolbar: {
                left: 'prev,next today',
                center: 'title',
                right: 'dayGridMonth,timeGridWeek,timeGridDay,listWeek'
            },
            themeSystem: 'bootstrap',
            locale: 'es',
            editable: true,
            droppable: true,
            views: {
                listWeek: {
                    buttonText: 'Lista'
                }
            },
            eventReceive: function(info) {
                var event = info.event;
                event.setProp('allDay', true);
                $.ajax({
                    url: 'controladores/agenda.controlador.php',
                    method: 'POST',
                    data: {
                        action: 'crearEvento',
                        title: event.title,
                        start: event.start.toISOString(),
                        end: event.end ? event.end.toISOString() : null,
                        backgroundColor: event.backgroundColor,
                        borderColor: event.borderColor,
                        textColor: event.textColor,
                        allDay: event.allDay ? 1 : 0
                    },
                    success: function(response) {
                        try {
                            response = JSON.parse(response);
                            if (response.status === 'success') {
                                alert('Evento guardado correctamente.');
                            } else {
                                alert('Error al guardar el evento: ' + response.message);
                            }
                        } catch (e) {
                            console.error('Error al parsear la respuesta:', response);
                            alert('Error al guardar el evento.');
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error('Error al guardar el evento:', error);
                        alert('Error al guardar el evento: ' + error);
                    }
                });
            },
            eventClick: function(info) {
                if (confirm('¿Deseas eliminar este evento?')) {
                    $.ajax({
                        url: 'controladores/agenda.controlador.php',
                        method: 'POST',
                        data: {
                            action: 'eliminarEvento',
                            id: info.event.id
                        },
                        success: function(response) {
                            try {
                                response = JSON.parse(response);
                                if (response.status === 'success') {
                                    info.event.remove();
                                    alert('Evento eliminado correctamente.');
                                } else {
                                    alert('Error al eliminar el evento: ' + response.message);
                                }
                            } catch (e) {
                                console.error('Error al parsear la respuesta:', response);
                                alert('Error al eliminar el evento.');
                            }
                        },
                        error: function(xhr, status, error) {
                            console.error('Error al eliminar el evento:', error);
                            alert('Error al eliminar el evento: ' + error);
                        }
                    });
                }
            },
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
                        try {
                            var events = JSON.parse(response);
                            if (events.status && events.status === 'error') {
                                alert('Error al cargar eventos: ' + events.message);
                            } else {
                                successCallback(events);
                            }
                        } catch (e) {
                            console.error('Error al parsear los eventos:', response);
                            failureCallback('Error al cargar eventos.');
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error('Error al cargar los eventos:', error);
                        failureCallback('Error al cargar eventos: ' + error);
                    }
                });
            }
        });

        calendar.render();

        var currColor = '#3c8dbc';
        $('#color-chooser > li > a').click(function (e) {
            e.preventDefault();
            currColor = $(this).css('color');
            $('#add-new-event').css({
                'background-color': currColor,
                'border-color'    : currColor
            });
        });

        $('#add-new-event').click(function (e) {
            e.preventDefault();
            var val = $('#new-event').val();
            if (val.length == 0) {
                return;
            }

            var event = $('<div />');
            event.css({
                'background-color': currColor,
                'border-color'    : currColor,
                'color'           : '#fff'
            }).addClass('external-event');
            event.text(val);
            $('#external-events').prepend(event);
            ini_events(event);
            $('#new-event').val('');
        });
    });
</script>


