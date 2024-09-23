<?php

require_once "../controladores/perfiles.controlador.php";
require_once "../modelos/perfiles.modelo.php";
session_start();

class TablaPerfiles
{
	/*=============================================
 	 MOSTRAR LA TABLA DE PERFILES
  	=============================================*/
	public function mostrarTablaPerfiles()
	{
		$item = null;
		$valor = null;

		$usuarios = ControladorPerfiles::ctrMostrarPerfiles($item, $valor);

		if (count($usuarios) == 0) {
			echo '{"data": []}';
			return;
		}

		$datosJson = '{
		  "data": [';

		for ($i = 0; $i < count($usuarios); $i++) {
			/*=============================================
 	 		TRAEMOS LAS ACCIONES
  			=============================================*/
			$editar =  "";
			$eliminar =  "";

			$editar =  "<div class='btn-group'><button class='btn btn-warning btnEditarPerfil' idPerfil='" . $usuarios[$i]["perfil"] . "' data-toggle='modal' data-target='#modalEditarPerfil'><i class='fas fa-edit'></i></button></div>";
			$eliminar .=  "<div class='btn-group'><button class='btn btn-danger btnEliminarPerfil' idPerfil='" . $usuarios[$i]["perfil"] . "' ><i class='fas fa-times'></i></button> </div>";

			$datosJson .= '[
			      "' . $usuarios[$i]["perfil"] . '",
			      "' . $usuarios[$i]["descripcion"] . '",
			      "' . $editar . '",
				  "' . $eliminar . '"
			    ],';
		}

		$datosJson = substr($datosJson, 0, -1);
		$datosJson .=   '] 
		 }';
		echo $datosJson;
	}
}

/*=============================================
ACTIVAR TABLA DE PERFILES
=============================================*/
$activarPerfiles = new TablaPerfiles();
$activarPerfiles->mostrarTablaPerfiles();
