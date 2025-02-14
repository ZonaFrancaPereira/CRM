

  
  $('#modalEliminar').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget); // Botón que activó el modal
    var id_categoria = button.data('id'); // Extraer el valor del atributo data-id
    var modal = $(this);
    modal.find('#id_categoria_eliminar').val(id_categoria); // Asignar el ID al campo oculto
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
