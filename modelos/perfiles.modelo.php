<?php

require_once "conexion.php";

class ModeloPerfiles
{

	/*=============================================
	MOSTRAR USUARIOS
	=============================================*/

	static public function mdlMostrarPerfiles($tabla, $item, $valor)
	{

		if ($item != null) {

			$stmt = Conexion::conectar()->prepare("SELECT perfil
                                                                        ,descripcion

                                                                         ,(case when ModuloTI='on' then 'on'
                                                                                       else 'off'
                                                                                       end) as ModuloTI,
																					   (case when AdminUsuarios='on' then 'on' else 'off' end) as AdminUsuarios,
(case when VerUsuarios='on' then 'on' else 'off' end) as VerUsuarios,
(case when EstadoUsuarios='on' then 'on' else 'off' end) as EstadoUsuarios,
(case when AdminPerfiles='on' then 'on' else 'off' end) as AdminPerfiles,
(case when AdminMantenimientos='on' then 'on' else 'off' end) as AdminMantenimientos,
(case when InventarioEquipos='on' then 'on' else 'off' end) as InventarioEquipos,
(case when AdminSoporte='on' then 'on' else 'off' end) as AdminSoporte,
(case when SolicitudSoporte='on' then 'on' else 'off' end) as SolicitudSoporte,
(case when ConsultarSoporte='on' then 'on' else 'off' end) as ConsultarSoporte,
(case when AdminAcpm='on' then 'on' else 'off' end) as AdminAcpm,
(case when CrearAcpm='on' then 'on' else 'off' end) as CrearAcpm,
(case when ConsultarAcpm='on' then 'on' else 'off' end) as ConsultarAcpm,
(case when EditarAcpm='on' then 'on' else 'off' end) as EditarAcpm,
(case when EliminarAcpm='on' then 'on' else 'off' end) as EliminarAcpm,
(case when AsignarActividades='on' then 'on' else 'off' end) as AsignarActividades,
(case when ResponderActividades='on' then 'on' else 'off' end) as ResponderActividades,
(case when VerActividades='on' then 'on' else 'off' end) as VerActividades,
(case when EditarActividades='on' then 'on' else 'off' end) as EditarActividades,
(case when EliminarActividades='on' then 'on' else 'off' end) as EliminarActividades,
(case when ArchivosSadoc='on' then 'on' else 'off' end) as ArchivosSadoc,
(case when CarpetasSadoc='on' then 'on' else 'off' end) as CarpetasSadoc,
(case when EliminarSadoc='on' then 'on' else 'off' end) as EliminarSadoc,
(case when SolicitudCodificacion='on' then 'on' else 'off' end) as SolicitudCodificacion,
(case when ResponderCodificacion='on' then 'on' else 'off' end) as ResponderCodificacion,
(case when ConsultarCodificacion='on' then 'on' else 'off' end) as ConsultarCodificacion,
(case when EditarCodificacion='on' then 'on' else 'off' end) as EditarCodificacion,
(case when EliminarCodificacion='on' then 'on' else 'off' end) as EliminarCodificacion,
(case when CrearOrden='on' then 'on' else 'off' end) as CrearOrden,
(case when EditarOrden='on' then 'on' else 'off' end) as EditarOrden,
(case when EliminarOrden='on' then 'on' else 'off' end) as EliminarOrden,
(case when ConsultarOrden='on' then 'on' else 'off' end) as ConsultarOrden,
(case when AdminProveedorLider='on' then 'on' else 'off' end) as AdminProveedorLider,
(case when AdminProveedorCT='on' then 'on' else 'off' end) as AdminProveedorCT,
(case when AprobacionGH='on' then 'on' else 'off' end) as AprobacionGH,
(case when AprobacionGR='on' then 'on' else 'off' end) as AprobacionGR,
(case when AprobacionCT='on' then 'on' else 'off' end) as AprobacionCT,
(case when CrearBascula='on' then 'on' else 'off' end) as CrearBascula,
(case when ConsultarBascula='on' then 'on' else 'off' end) as ConsultarBascula,
(case when EditarBascula='on' then 'on' else 'off' end) as EditarBascula,
(case when BasculaProceso='on' then 'on' else 'off' end) as BasculaProceso,
(case when BasculaFact='on' then 'on' else 'off' end) as BasculaFact,
(case when ValorPesaje='on' then 'on' else 'off' end) as ValorPesaje

                                                                        
	                                                                                        



                                                               FROM $tabla

                                                               WHERE $item = :$item");

			$stmt->bindParam(":" . $item, $valor, PDO::PARAM_STR);

			$stmt->execute();

			return $stmt->fetch();
		} else {

			$stmt = Conexion::conectar()->prepare("SELECT perfil
                                                                    ,descripcion

                                                                    ,(case when ModuloTI='on' then 'on'
                                                                                  else 'off'
                                                                                  end) as ModuloTI,
																				  (case when AdminUsuarios='on' then 'on' else 'off' end) as AdminUsuarios,
(case when VerUsuarios='on' then 'on' else 'off' end) as VerUsuarios,
(case when EstadoUsuarios='on' then 'on' else 'off' end) as EstadoUsuarios,
(case when AdminPerfiles='on' then 'on' else 'off' end) as AdminPerfiles,
(case when AdminMantenimientos='on' then 'on' else 'off' end) as AdminMantenimientos,
(case when InventarioEquipos='on' then 'on' else 'off' end) as InventarioEquipos,
(case when AdminSoporte='on' then 'on' else 'off' end) as AdminSoporte,
(case when SolicitudSoporte='on' then 'on' else 'off' end) as SolicitudSoporte,
(case when ConsultarSoporte='on' then 'on' else 'off' end) as ConsultarSoporte,
(case when AdminAcpm='on' then 'on' else 'off' end) as AdminAcpm,
(case when CrearAcpm='on' then 'on' else 'off' end) as CrearAcpm,
(case when ConsultarAcpm='on' then 'on' else 'off' end) as ConsultarAcpm,
(case when EditarAcpm='on' then 'on' else 'off' end) as EditarAcpm,
(case when EliminarAcpm='on' then 'on' else 'off' end) as EliminarAcpm,
(case when AsignarActividades='on' then 'on' else 'off' end) as AsignarActividades,
(case when ResponderActividades='on' then 'on' else 'off' end) as ResponderActividades,
(case when VerActividades='on' then 'on' else 'off' end) as VerActividades,
(case when EditarActividades='on' then 'on' else 'off' end) as EditarActividades,
(case when EliminarActividades='on' then 'on' else 'off' end) as EliminarActividades,
(case when ArchivosSadoc='on' then 'on' else 'off' end) as ArchivosSadoc,
(case when CarpetasSadoc='on' then 'on' else 'off' end) as CarpetasSadoc,
(case when EliminarSadoc='on' then 'on' else 'off' end) as EliminarSadoc,
(case when SolicitudCodificacion='on' then 'on' else 'off' end) as SolicitudCodificacion,
(case when ResponderCodificacion='on' then 'on' else 'off' end) as ResponderCodificacion,
(case when ConsultarCodificacion='on' then 'on' else 'off' end) as ConsultarCodificacion,
(case when EditarCodificacion='on' then 'on' else 'off' end) as EditarCodificacion,
(case when EliminarCodificacion='on' then 'on' else 'off' end) as EliminarCodificacion,
(case when CrearOrden='on' then 'on' else 'off' end) as CrearOrden,
(case when EditarOrden='on' then 'on' else 'off' end) as EditarOrden,
(case when EliminarOrden='on' then 'on' else 'off' end) as EliminarOrden,
(case when ConsultarOrden='on' then 'on' else 'off' end) as ConsultarOrden,
(case when AdminProveedorLider='on' then 'on' else 'off' end) as AdminProveedorLider,
(case when AdminProveedorCT='on' then 'on' else 'off' end) as AdminProveedorCT,
(case when AprobacionGH='on' then 'on' else 'off' end) as AprobacionGH,
(case when AprobacionGR='on' then 'on' else 'off' end) as AprobacionGR,
(case when AprobacionCT='on' then 'on' else 'off' end) as AprobacionCT,
(case when CrearBascula='on' then 'on' else 'off' end) as CrearBascula,
(case when ConsultarBascula='on' then 'on' else 'off' end) as ConsultarBascula,
(case when EditarBascula='on' then 'on' else 'off' end) as EditarBascula,
(case when BasculaProceso='on' then 'on' else 'off' end) as BasculaProceso,
(case when BasculaFact='on' then 'on' else 'off' end) as BasculaFact,
(case when ValorPesaje='on' then 'on' else 'off' end) as ValorPesaje

                                                                   

                                                     FROM
                                                     $tabla");

			$stmt->execute();

			return $stmt->fetchAll();
		}


	

		$stmt = null;
	}

	/*=============================================
	REGISTRO DE PERFIL
	=============================================*/

	static public function mdlIngresarPerfil($tabla, $datos)
	{
		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(
			descripcion,
			ModuloTI,
			AdminUsuarios,
			VerUsuarios,
			EstadoUsuarios,
			AdminPerfiles,
			AdminMantenimientos,
			InventarioEquipos,
			AdminSoporte,
			SolicitudSoporte,
			ConsultarSoporte,
			AdminAcpm,
			CrearAcpm,
			ConsultarAcpm,
			EditarAcpm,
			EliminarAcpm,
			AsignarActividades,
			ResponderActividades,
			VerActividades,
			EditarActividades,
			EliminarActividades,
			ArchivosSadoc,
			CarpetasSadoc,
			EliminarSadoc,
			SolicitudCodificacion,
			ResponderCodificacion,
			ConsultarCodificacion,
			EditarCodificacion,
			EliminarCodificacion,
			CrearOrden,
			EditarOrden,
			EliminarOrden,
			ConsultarOrden,
			AdminProveedorLider,
			AdminProveedorCT,
			AprobacionGH,
			AprobacionGR,
			AprobacionCT,
			CrearBascula,
			ConsultarBascula,
			EditarBascula,
			BasculaProceso,
			BasculaFact,
			ValorPesaje
		) VALUES (
			:descripcion,
			:ModuloTI,
			:AdminUsuarios,
			:VerUsuarios,
			:EstadoUsuarios,
			:AdminPerfiles,
			:AdminMantenimientos,
			:InventarioEquipos,
			:AdminSoporte,
			:SolicitudSoporte,
			:ConsultarSoporte,
			:AdminAcpm,
			:CrearAcpm,
			:ConsultarAcpm,
			:EditarAcpm,
			:EliminarAcpm,
			:AsignarActividades,
			:ResponderActividades,
			:VerActividades,
			:EditarActividades,
			:EliminarActividades,
			:ArchivosSadoc,
			:CarpetasSadoc,
			:EliminarSadoc,
			:SolicitudCodificacion,
			:ResponderCodificacion,
			:ConsultarCodificacion,
			:EditarCodificacion,
			:EliminarCodificacion,
			:CrearOrden,
			:EditarOrden,
			:EliminarOrden,
			:ConsultarOrden,
			:AdminProveedorLider,
			:AdminProveedorCT,
			:AprobacionGH,
			:AprobacionGR,
			:AprobacionCT,
			:CrearBascula,
			:ConsultarBascula,
			:EditarBascula,
			:BasculaProceso,
			:BasculaFact,
			:ValorPesaje
		)");

		$stmt->bindParam(":descripcion", $datos["descripcion"], PDO::PARAM_STR);
		$stmt->bindParam(":ModuloTI", $datos["ModuloTI"], PDO::PARAM_STR);
		$stmt->bindParam(":AdminUsuarios", $datos["AdminUsuarios"], PDO::PARAM_STR);
		$stmt->bindParam(":VerUsuarios", $datos["VerUsuarios"], PDO::PARAM_STR);
		$stmt->bindParam(":EstadoUsuarios", $datos["EstadoUsuarios"], PDO::PARAM_STR);
		$stmt->bindParam(":AdminPerfiles", $datos["AdminPerfiles"], PDO::PARAM_STR);
		$stmt->bindParam(":AdminMantenimientos", $datos["AdminMantenimientos"], PDO::PARAM_STR);
		$stmt->bindParam(":InventarioEquipos", $datos["InventarioEquipos"], PDO::PARAM_STR);
		$stmt->bindParam(":AdminSoporte", $datos["AdminSoporte"], PDO::PARAM_STR);
		$stmt->bindParam(":SolicitudSoporte", $datos["SolicitudSoporte"], PDO::PARAM_STR);
		$stmt->bindParam(":ConsultarSoporte", $datos["ConsultarSoporte"], PDO::PARAM_STR);
		$stmt->bindParam(":AdminAcpm", $datos["AdminAcpm"], PDO::PARAM_STR);
		$stmt->bindParam(":CrearAcpm", $datos["CrearAcpm"], PDO::PARAM_STR);
		$stmt->bindParam(":ConsultarAcpm", $datos["ConsultarAcpm"], PDO::PARAM_STR);
		$stmt->bindParam(":EditarAcpm", $datos["EditarAcpm"], PDO::PARAM_STR);
		$stmt->bindParam(":EliminarAcpm", $datos["EliminarAcpm"], PDO::PARAM_STR);
		$stmt->bindParam(":AsignarActividades", $datos["AsignarActividades"], PDO::PARAM_STR);
		$stmt->bindParam(":ResponderActividades", $datos["ResponderActividades"], PDO::PARAM_STR);
		$stmt->bindParam(":VerActividades", $datos["VerActividades"], PDO::PARAM_STR);
		$stmt->bindParam(":EditarActividades", $datos["EditarActividades"], PDO::PARAM_STR);
		$stmt->bindParam(":EliminarActividades", $datos["EliminarActividades"], PDO::PARAM_STR);
		$stmt->bindParam(":ArchivosSadoc", $datos["ArchivosSadoc"], PDO::PARAM_STR);
		$stmt->bindParam(":CarpetasSadoc", $datos["CarpetasSadoc"], PDO::PARAM_STR);
		$stmt->bindParam(":EliminarSadoc", $datos["EliminarSadoc"], PDO::PARAM_STR);
		$stmt->bindParam(":SolicitudCodificacion", $datos["SolicitudCodificacion"], PDO::PARAM_STR);
		$stmt->bindParam(":ResponderCodificacion", $datos["ResponderCodificacion"], PDO::PARAM_STR);
		$stmt->bindParam(":ConsultarCodificacion", $datos["ConsultarCodificacion"], PDO::PARAM_STR);
		$stmt->bindParam(":EditarCodificacion", $datos["EditarCodificacion"], PDO::PARAM_STR);
		$stmt->bindParam(":EliminarCodificacion", $datos["EliminarCodificacion"], PDO::PARAM_STR);
		$stmt->bindParam(":CrearOrden", $datos["CrearOrden"], PDO::PARAM_STR);
		$stmt->bindParam(":EditarOrden", $datos["EditarOrden"], PDO::PARAM_STR);
		$stmt->bindParam(":EliminarOrden", $datos["EliminarOrden"], PDO::PARAM_STR);
		$stmt->bindParam(":ConsultarOrden", $datos["ConsultarOrden"], PDO::PARAM_STR);
		$stmt->bindParam(":AdminProveedorLider", $datos["AdminProveedorLider"], PDO::PARAM_STR);
		$stmt->bindParam(":AdminProveedorCT", $datos["AdminProveedorCT"], PDO::PARAM_STR);
		$stmt->bindParam(":AprobacionGH", $datos["AprobacionGH"], PDO::PARAM_STR);
		$stmt->bindParam(":AprobacionGR", $datos["AprobacionGR"], PDO::PARAM_STR);
		$stmt->bindParam(":AprobacionCT", $datos["AprobacionCT"], PDO::PARAM_STR);
		$stmt->bindParam(":CrearBascula", $datos["CrearBascula"], PDO::PARAM_STR);
		$stmt->bindParam(":ConsultarBascula", $datos["ConsultarBascula"], PDO::PARAM_STR);
		$stmt->bindParam(":EditarBascula", $datos["EditarBascula"], PDO::PARAM_STR);
		$stmt->bindParam(":BasculaProceso", $datos["BasculaProceso"], PDO::PARAM_STR);
		$stmt->bindParam(":BasculaFact", $datos["BasculaFact"], PDO::PARAM_STR);
		$stmt->bindParam(":ValorPesaje", $datos["ValorPesaje"], PDO::PARAM_STR);

		if ($stmt->execute()) {
			return "ok";
		} else {
			return "error";
		}

		$stmt->closeCursor();
		$stmt = null;
	}

	/*=============================================
	EDITAR PERFIL
	=============================================*/

	static public function mdlEditarPerfil($tabla, $datos)
	{

		$stmt = Conexion::conectar()->prepare(
			"UPDATE $tabla
                                                            SET descripcion = :descripcion

                                                                    ,ModuloTI = :ModuloTI
																	
                                                                  
                                                            WHERE perfil = :perfil"
		);


		$stmt->bindParam(":descripcion", $datos["descripcion"], PDO::PARAM_STR);
		$stmt->bindParam(":ModuloTI", $datos["ModuloTI"], PDO::PARAM_STR);



		if ($stmt->execute()) {

			return "ok";
		} else {

			return "error";
		}

	

		$stmt = null;
	}


	/*=============================================
	BORRAR PERFIL
	=============================================*/

	static public function mdlBorrarPerfil($tabla, $datos)
	{

		$stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE perfil = :id");

		$stmt->bindParam(":id", $datos, PDO::PARAM_INT);

		if ($stmt->execute()) {

			return "ok";
		} else {

			return "error";
		}

		

		$stmt = null;
	}
}
