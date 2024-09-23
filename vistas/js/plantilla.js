$('.modal-dialog').draggable({
	 handle: ".modal-header"
 });

/*=============================================
SideBar Menu
=============================================*/

$('.sidebar-menu').tree()

/*=============================================
Inicializar Select2
=============================================*/
$('.select2').select2()

//Funcionamiento de Select2 para modal
$.fn.modal.Constructor.prototype.enforceFocus = function() {};


/*=============================================
Data Table
=============================================*/


/*=============================================
 //iCheck for checkbox and radio inputs
=============================================*/

$('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
  checkboxClass: 'icheckbox_minimal-blue',
  radioClass   : 'iradio_minimal-blue'
})

/*=============================================
 //input Mask
=============================================*/

$('#datemask').inputmask('dd/mm/yyyy', { 'placeholder': 'dd/mm/yyyy' })
//Datemask2 mm/dd/yyyy
$('#datemask2').inputmask('mm/dd/yyyy', { 'placeholder': 'mm/dd/yyyy' })

//MASCARA DATAPICKER
$.fn.datepicker.defaults.format = "yyyy/mm/dd"

//Money Euro
$('[data-mask]').inputmask()


//Date picker
    $('#datepicker').datepicker({
      autoclose: true
    })

$(document).ready(function(){
     $.fn.datepicker.defaults.language = 'es';
});

//PARA CERRARLO AUTOMATICAMENTE
$.fn.datepicker.defaults.autoclose = true;

/*=============================================
CORRECCIÓN BOTONERAS OCULTAS BACKEND
=============================================*/


$(document).ready(function(){
	 //Limpiar el formulario
	 $("#GuardarActivo")[0].reset(); // Resetea el formulario
     $.fn.datepicker.defaults.language = 'es';
});

//PARA CERRARLO AUTOMATICAMENTE
$.fn.datepicker.defaults.autoclose = true;

if(window.matchMedia("(max-width:767px)").matches){

	$("body").removeClass('sidebar-collapse');

}else{

	$("body").addClass('sidebar-collapse');
}

$(function () {
    // Summernote
    $('.textarea').summernote()

    // CodeMirror
    CodeMirror.fromTextArea(document.getElementById("codeMirrorDemo"), {
      mode: "htmlmixed",
      theme: "monokai"
    });
  })