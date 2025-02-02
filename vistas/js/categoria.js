
/*=============================================
TABLA PARA MOSTRAR LAS CATEGORIAS
=============================================*/
var tablaCategorias = $("#tabla-categoria").DataTable({
    "ajax": {
        "url": "ajax/datatable-categorias.ajax.php",
        "type": "POST",
        "data": function (d) {
            d.especifico = "categorias";
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

  
  $('#modalEliminar').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget); // Botón que activó el modal
    var id_categoria = button.data('id'); // Extraer el valor del atributo data-id
    var modal = $(this);
    modal.find('#id_categoria_eliminar').val(id_categoria); // Asignar el ID al campo oculto
});

/*=============================================
TABLA PARA MOSTRAR LOS DOCUMENTOS
=============================================*/
var tablaDocumentos = $("#tabla-documentos-empresas").DataTable({
    "ajax": {
        "url": "ajax/datatable-documentos.ajax.php",
        "type": "POST",
        "data": function (d) {
            d.especifico = "documentos-empresas";
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
MODAL PARA TRAER EL ID DE LA EMPRESA
=============================================*/
$('#modal-fechadocumentos').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget); 
    var id_archivos = button.data('id_archivos');

    var modal = $(this);
    modal.find('#id_archivos').val(id_archivos);
});
