function refrescarClientes() { 
  alert("sii");
  
  $("#contenidoClientes").load(window.location.href + " #contenidoClientes", function() {
    
  });
}

tablaClientes = $('.tablaClientes').DataTable({
  "ajax": "ajax/datatable-clientes.ajax.php",
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
  responsive: "true",
  dom: "Bfrtilp",
  "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"],
  "order": [[0, 'desc']],
  autoWidth: true

})



/*=============================================
EDITAR CLIENTE
=============================================*/
$(".tablaClientes").on("click", ".btnEditarCliente", function () {

  var idCliente = $(this).attr("idCliente");

  var datos = new FormData();
  datos.append("idCliente", idCliente);

  $.ajax({

    url: "ajax/clientes.ajax.php",
    method: "POST",
    data: datos,
    cache: false,
    contentType: false,
    processData: false,
    dataType: "json",
    success: function (respuesta) {

      $("#idCliente").val(respuesta["id"]);
      $("#editarCliente").val(respuesta["nombre"]);
      $("#editarDocumentoId").val(respuesta["documento"]);
      $("#editarEmail").val(respuesta["email"]);
      $("#editarTelefono").val(respuesta["telefono"]);
      $("#editarDireccion").val(respuesta["direccion"]);
      $("#editarFechaNacimiento").val(respuesta["fecha_nacimiento"]);
    }

  })

})

/*=============================================
ELIMINAR CLIENTE
=============================================*/
$(".tablaClientes").on("click", ".btnEliminarCliente", function () {

  var idCliente = $(this).attr("idCliente");

  Swal.fire({
    title: '¿Está seguro de borrar el Cliente?',
    text: "¡Si no lo está puede cancelar la acción!",
    type: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    cancelButtonText: 'Cancelar',
    confirmButtonText: 'Sí, borrar cliente!'
  }).then(function (result) {
    if (result.value) {
      $.ajax({
        url: 'operaciones',
        type: 'POST',
        data: { idCliente: idCliente },
        success: function (response) {
          Swal.fire(
            'Eliminado!',
            'El cliente ha sido eliminado.',
            'success'
          ).then(function () {
            refrescarClientes();
            
            tablaClientes.ajax.reload();
            $("#ConsultarClientes").addClass("active");


          });
        },
        error: function () {
          Swal.fire(
            'Error!',
            'Hubo un problema al eliminar el cliente.',
            'error'
          );
        }
      });
    }
  });

})