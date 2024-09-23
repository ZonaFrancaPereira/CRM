
var tablaPerfiles = $(".tabla-perfiles").DataTable({
	"ajax": "ajax/datatable-perfiles.ajax.php",
    "deferRender": true,
     "serverSide" : true,
  "retrieve": true,
  "processing": true,
	"language":{
	  "sProcessing":     "Procesando...",
	  "sLengthMenu":     "Mostrar _MENU_ registros",
	  "sZeroRecords":    "No se encontraron resultados",
	  "sEmptyTable":     "Ningún dato disponible en esta tabla",
	  "sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
	  "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
	  "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
	  "sSearch":         "Buscar:",
	  "sInfoThousands":  ",",
	  "sLoadingRecords": "Cargando...",
	  "oPaginate": {
		"sFirst":    "Primero",
		"sLast":     "Último",
		"sNext":     "Siguiente",
		"sPrevious": "Anterior"
	  },
	  "oAria": {
		"sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
		"sSortDescending": ": Activar para ordenar la columna de manera descendente"
	  },
	  "buttons": {
		"copy": "Copiar",
		"colvis": "Visibilidad"
	  }
	},
	responsive:"true",
	dom:"Bfrtilp",
	
	
	"buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"],
	
	
	
	"order":[[0,'desc']],
	autoWidth: true
	
	});
/*=============================================
EDITAR PERFIL
=============================================*/
$(".table").on("click", ".btnEditarPerfil", function(){

	var idPerfil= $(this).attr("idPerfil");



	var datos = new FormData();
	datos.append("idPerfil", idPerfil);

	console.log(idPerfil);

	$.ajax({

		url:"ajax/perfiles.ajax.php",
		method: "POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		dataType: "json",
		success: function(respuesta){


			$("#editarDescripcion").val(respuesta["descripcion"]);
			$("#idPerfil").val(respuesta["perfil"]);



		}

	});

})



$(".table").on("click", ".btnEliminarPerfil", function(){

	var idPerfil = $(this).attr("idPerfil");
  
	Swal.fire({
	  title: '¿Está seguro de borrar el Perfil?',
	  text: "¡Si no lo está puede cancelar la acción!",
	  type: 'warning',
	  showCancelButton: true,
	  confirmButtonColor: '#3085d6',
	  cancelButtonColor: '#d33',
	  cancelButtonText: 'Cancelar',
	  confirmButtonText: 'Sí, borrar perfil!'
	}).then(function(result){
	  if(result.value){
		$.ajax({
		  url: 'ti',
		  type: 'POST',
		  data: { idPerfil: idPerfil, eliminar: 'si' },
		  success: function(response) {
			Swal.fire(
			  'Eliminado!',
			  'El perfil ha sido eliminado.',
			  'success'
			).then(function() {
	
			  $("#ConsultarPerfil").addClass("active");
			  tablaPerfiles.ajax.reload();
			 
			});
		  },
		  error: function() {
			Swal.fire(
			  'Error!',
			  'Hubo un problema al eliminar el perfil.',
			  'error'
			);
		  }
		});
	  }
	});
  
  });
