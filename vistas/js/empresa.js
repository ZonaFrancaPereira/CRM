
/*=============================================
TABLA PARA MOSTRAR TODAS LAS EMPRESAS
=============================================*/
var tablaEmpresas = $("#tabla-empresas").DataTable({
  "ajax": {
      "url": "ajax/datatable-empresas.ajax.php",
      "type": "POST",
      "data": function (d) {
          d.especifico = "empresas";
          console.log("Valor de específico:", d.especifico);
      },
      "dataSrc": "data"
  },
  "deferRender": true,
  "serverSide": true,
  "retrieve": true,
  "processing": true,
  "language": {
      "sProcessing": "Procesando...",
      "sLengthMenu": "Mostrar _MENU_ registros",
      "sZeroRecords": "No se encontraron resultados",
      "sEmptyTable": "Ningún dato disponible en esta tabla",
      "sInfo": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
      "sInfoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
      "sInfoFiltered": "(filtrado de un total de _MAX_ registros)",
      "sSearch": "Buscar:",
      "sInfoThousands": ",",
      "sLoadingRecords": "Cargando...",
      "oPaginate": {
          "sFirst": "Primero",
          "sLast": "Último",
          "sNext": "Siguiente",
          "sPrevious": "Anterior"
      },
      "oAria": {
          "sSortAscending": ": Activar para ordenar la columna de manera ascendente",
          "sSortDescending": ": Activar para ordenar la columna de manera descendente"
      },
      "buttons": {
          "copy": "Copiar",
          "colvis": "Visibilidad"
      }
  },
  responsive: true,
  dom: "Bfrtilp",
  "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"],
  "order": [[0, 'desc']],
  autoWidth: true
});

/*=============================================
MODAL PARA TRAER LOS DATOS DE LA EMPRESA
=============================================*/
// Abre el modal y establece los datos en el formulario
$('#modal-editempresa').on('show.bs.modal', function (event) {
  var button = $(event.relatedTarget); // Botón que activó el modal

  // Extrae todos los datos del botón
  var id_empresa = button.data('id');
  var dv = button.data('dv');
  var nombre = button.data('nombre');
  var direccion = button.data('direccion');
  var ciudad = button.data('ciudad');
  var telefono = button.data('telefono');
  var telefono2 = button.data('telefono2');
  var nombre_rep = button.data('nombre-rep');
  var correo = button.data('correo');

  var modal = $(this);
  
  // Establece los valores en los campos del modal
  modal.find('#id_empresa').val(id_empresa);
  modal.find('#dv_empresa').val(dv);
  modal.find('#nombre_empresa').val(nombre);
  modal.find('#direccion_empresa').val(direccion);
  modal.find('#ciudad_empresa').val(ciudad);
  modal.find('#telefono_empresa').val(telefono);
  modal.find('#telefono2_empresa').val(telefono2);
  modal.find('#nombre_rep_legal_empresa').val(nombre_rep);
  modal.find('#correo_empresa').val(correo);
});


/*=============================================
MODAL PARA TRAER LOS DATOS DE LA EMPRESA
=============================================*/
// Abre el modal y establece los datos en el formulario
$('#modal-asignarempresa').on('show.bs.modal', function (event) {
  var button = $(event.relatedTarget); // Botón que activó el modal

  // Extrae todos los datos del botón
  var id_asignar = button.data('id');

  var modal = $(this);
  
  // Establece los valores en los campos del modal
  modal.find('#id_asignar').val(id_asignar);
});
