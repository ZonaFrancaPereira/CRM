$(document).ready(iniciar_ct);

function iniciar_ct() {
	$(".ReporteInventario").on("click", informe_inventario);
	
}

function informe_inventario(){
	var id_inventario = $(this).data('id_inventario');
    //alert('ID de Inventario: ' + id_inventario);
	window.open("extensiones/tcpdf/pdf/factura.php?UUID=" + id_inventario, "_blank");

}
//TABLAS Y DEMAS FUNCIONES COMO MODALES
var tablaInventario = $("#tabla-inventario").DataTable({
	"ajax": "ajax/datatable-inventario.ajax.php",
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
	
	
	
	"order":[[0,'asc']],
	autoWidth: true
	
});

var tablaVerificados = $("#tabla-verificados").DataTable({
		"ajax": {
			"url": "ajax/datatable-verificarActivos.ajax.php", // Ruta a tu archivo PHP que devuelve los datos JSON
			"type": "POST", // Método de solicitud POST
			"data": function (d) {
	
				// Puedes enviar parámetros adicionales si es necesario
				d.especifico = "verificados"; // Ejemplo de parámetro, ajusta según tu lógica
				console.log("Valor de específico:", d.especifico);
			},
			"dataSrc": "data" // Nombre del objeto JSON que contiene los datos para DataTable
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
		responsive: "true",
		dom: "Bfrtilp",
	
	
		"buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"],
	
	
	
		"order": [[0, 'desc']],
		autoWidth: true
	
});


	var tablaVerificados = $("#tabla-sinverificar").DataTable({
        "ajax": {
            "url": "ajax/datatable-verificarActivos.ajax.php",
            "type": "POST",
            "data": function (d) {
                d.id_inventario = 123; // Ajusta según tu lógica
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
        "responsive": true,
        "dom": "Bfrtilp",
        "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"],
        "order": [[0, 'desc']],
        "autoWidth": true
    });


//MODAL PARA CERRAR EL INVENTARIO
$('#modalCerrarInventario').on('show.bs.modal', function(event) {
	var button = $(event.relatedTarget);
	var id_inventario = button.data('id_inventario');
   
	var modal = $(this);
	modal.find('.modal-title').text('Cierrre de Inventario # : ' + id_inventario );
	modal.find('.modal-body #id_inventario').val(id_inventario);
  });

        // Capturar el div cuando se hace clic en él
        document.querySelectorAll('.product-info').forEach((div) => {
            div.addEventListener('click', function() {
                // Capturar el li entero
                html2canvas(this.parentNode, {
                    allowTaint: true,
                    useCORS: true,
                    backgroundColor: null
                }).then(canvas => {
                    // Convertir a Data URL y descargar
                    const imgData = canvas.toDataURL('image/png');
                    const link = document.createElement('a');
                    link.href = imgData;
                    link.download = 'captured-product.png';
                    link.click();
                }).catch(error => {
                    console.error('Error capturando el contenido:', error);
                });
            });
        });