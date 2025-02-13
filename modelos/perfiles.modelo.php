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
			$stmt = Conexion::conectar()->prepare(
				"SELECT perfil,
						descripcion,
						(CASE WHEN AdminUsuarios = 'on' THEN 'on' ELSE 'off' END) AS AdminUsuarios,
						(CASE WHEN VerUsuarios = 'on' THEN 'on' ELSE 'off' END) AS VerUsuarios,
					
						(CASE WHEN AdminPerfiles = 'on' THEN 'on' ELSE 'off' END) AS AdminPerfiles,
						(CASE WHEN AdminEmpresa = 'on' THEN 'on' ELSE 'off' END) AS AdminEmpresa,
						(CASE WHEN SubirDocumentos = 'on' THEN 'on' ELSE 'off' END) AS SubirDocumentos,
						(CASE WHEN SubirCalendario = 'on' THEN 'on' ELSE 'off' END) AS SubirCalendario,
						(CASE WHEN AdminCalendario = 'on' THEN 'on' ELSE 'off' END) AS AdminCalendario
				 FROM $tabla
				 WHERE $item = :$item"
			);
	
			$stmt->bindParam(":" . $item, $valor, PDO::PARAM_STR);
			$stmt->execute();
	
			return $stmt->fetch();
		} else {
			$stmt = Conexion::conectar()->prepare(
				"SELECT perfil,
						descripcion,
						(CASE WHEN AdminUsuarios = 'on' THEN 'on' ELSE 'off' END) AS AdminUsuarios,
						(CASE WHEN VerUsuarios = 'on' THEN 'on' ELSE 'off' END) AS VerUsuarios,
						
						(CASE WHEN AdminPerfiles = 'on' THEN 'on' ELSE 'off' END) AS AdminPerfiles,
						(CASE WHEN AdminEmpresa = 'on' THEN 'on' ELSE 'off' END) AS AdminEmpresa,
						(CASE WHEN SubirDocumentos = 'on' THEN 'on' ELSE 'off' END) AS SubirDocumentos,
						(CASE WHEN SubirCalendario = 'on' THEN 'on' ELSE 'off' END) AS SubirCalendario,
						(CASE WHEN AdminCalendario = 'on' THEN 'on' ELSE 'off' END) AS AdminCalendario
				 FROM $tabla"
			);
	
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
        AdminUsuarios,
        VerUsuarios,
  
        AdminPerfiles,
        AdminEmpresa,
        SubirDocumentos,
        SubirCalendario,
        AdminCalendario
    ) VALUES (
        :descripcion,
        :AdminUsuarios,
        :VerUsuarios,
   
        :AdminPerfiles,
        :AdminEmpresa,
        :SubirDocumentos,
        :SubirCalendario,
        :AdminCalendario
    )");

   
    $stmt->bindParam(":descripcion", $datos["descripcion"], PDO::PARAM_STR);
    $stmt->bindParam(":AdminUsuarios", $datos["AdminUsuarios"], PDO::PARAM_STR);
    $stmt->bindParam(":VerUsuarios", $datos["VerUsuarios"], PDO::PARAM_STR);
   
    $stmt->bindParam(":AdminPerfiles", $datos["AdminPerfiles"], PDO::PARAM_STR);
    $stmt->bindParam(":AdminEmpresa", $datos["AdminEmpresa"], PDO::PARAM_STR);
    $stmt->bindParam(":SubirDocumentos", $datos["SubirDocumentos"], PDO::PARAM_STR);
    $stmt->bindParam(":SubirCalendario", $datos["SubirCalendario"], PDO::PARAM_STR);
    $stmt->bindParam(":AdminCalendario", $datos["AdminCalendario"], PDO::PARAM_STR);

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
