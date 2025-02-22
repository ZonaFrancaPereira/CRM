<?php

require_once "conexion.php";

class ModeloUsuarios
{

	
	/*=============================================
	MOSTRAR USUARIOS
	=============================================*/

	static public function mdlMostrarUsuarios($tabla, $item, $valor)
	{

		if ($item != null) {

			$stmt = Conexion::conectar()->prepare("SELECT * 

													,(select b.descripcion 
														from perfiles b
														where b.perfil=a.perfil

													) as nombrePerfil
													FROM $tabla a WHERE $item = :$item");

			$stmt->bindParam(":" . $item, $valor, PDO::PARAM_STR);

			$stmt->execute();

			return $stmt->fetch();
		} else {

			$stmt = Conexion::conectar()->prepare("SELECT * 

													,(select b.descripcion 
														from perfiles b
														where b.perfil=a.perfil

													) as nombrePerfil

													FROM $tabla a");

			$stmt->execute();

			return $stmt->fetchAll();
		}




		$stmt = null;
	}
	/*=============================================
	MOSTRAR USUARIOS PDF
	=============================================*/
	static public function mdlMostrarUsuariosPdf($tabla, $item, $valor)
	{
		// Consulta con INNER JOIN incluyendo la tabla proceso
		$stmt = Conexion::conectar()->prepare(
			"SELECT * FROM $tabla WHERE $item = :valor"
		);
		$stmt->bindParam(":valor", $valor, PDO::PARAM_INT);
		$stmt->execute();

		// Utilizar fetchAll para obtener todos los resultados
		return $stmt->fetchAll();
	}
	/*=============================================
		MOSTRAR USUARIOS CORREO
	=============================================*/
	static public function mdlMostrarUsuariosCorreo($tabla, $item, $valor)
	{
		// Consulta con INNER JOIN incluyendo la tabla proceso
		$stmt = Conexion::conectar()->prepare(
			"SELECT u.*, s.*, p.* 
         FROM $tabla u
         INNER JOIN soporte s ON u.id = s.id_usuario_fk
         INNER JOIN proceso p ON u.id_proceso_fk = p.id_proceso
         WHERE u.$item = :valor"
		);
		$stmt->bindParam(":valor", $valor, PDO::PARAM_INT);
		$stmt->execute();

		// Utilizar fetchAll para obtener todos los resultados
		return $stmt->fetchAll();
	}
	/*=============================================
	REGISTRO DE USUARIO
	=============================================*/

	static public function mdlIngresarUsuario($tabla, $datos)
	{

		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(nombre,apellidos_usuario,correo_usuario, password, perfil, firma) VALUES (:nombre,:apellidos_usuario, :correo_usuario, :password, :perfil, :firma)");

		$stmt->bindParam(":nombre", $datos["nombre"], PDO::PARAM_STR);
		$stmt->bindParam(":apellidos_usuario", $datos["apellidos_usuario"], PDO::PARAM_STR);
		$stmt->bindParam(":correo_usuario", $datos["correo_usuario"], PDO::PARAM_STR);
		$stmt->bindParam(":password", $datos["password"], PDO::PARAM_STR);
		$stmt->bindParam(":perfil", $datos["perfil"], PDO::PARAM_INT);
		$stmt->bindParam(":firma", $datos["firma"], PDO::PARAM_STR);

		if ($stmt->execute()) {

			return "ok";
		} else {

			$arr = $stmt->errorInfo();
			$arr[3] = "ERROR";
			return $arr[2];
		}



		$stmt = null;
	}

	/*=============================================
	EDITAR USUARIO
	=============================================*/

	static public function mdlEditarUsuario($tabla, $datos)
	{

		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET nombre = :nombre, password = :password, perfil = :perfil, firma = :foto WHERE usuario = :usuario");

		$stmt->bindParam(":nombre", $datos["nombre"], PDO::PARAM_STR);
		$stmt->bindParam(":password", $datos["password"], PDO::PARAM_STR);
		$stmt->bindParam(":perfil", $datos["perfil"], PDO::PARAM_STR);
		$stmt->bindParam(":foto", $datos["foto"], PDO::PARAM_STR);
		$stmt->bindParam(":usuario", $datos["usuario"], PDO::PARAM_STR);

		if ($stmt->execute()) {

			return "ok";
		} else {

			return "error";
		}



		$stmt = null;
	}


	/*=============================================
	EDITAR CONTRA
	=============================================*/

	static public function mdlEditarContra($tabla, $datos)
	{

		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET 
                                                                         password = :password
                                                                      
                                                                        , foto = :foto 
                                                                        WHERE usuario = :usuario");


		$stmt->bindParam(":password", $datos["password"], PDO::PARAM_STR);
		$stmt->bindParam(":foto", $datos["foto"], PDO::PARAM_STR);
		$stmt->bindParam(":usuario", $datos["usuario"], PDO::PARAM_STR);

		if ($stmt->execute()) {

			return "ok";
		} else {

			return "error";
		}



		$stmt = null;
	}


	/*=============================================
	ACTUALIZAR USUARIO
	=============================================*/

	static public function mdlActualizarUsuario($tabla, $item1, $valor1, $item2, $valor2)
	{

		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET $item1 = :$item1 WHERE $item2 = :$item2");

		$stmt->bindParam(":" . $item1, $valor1, PDO::PARAM_STR);
		$stmt->bindParam(":" . $item2, $valor2, PDO::PARAM_STR);

		if ($stmt->execute()) {

			return "ok";
		} else {

			return "error";
		}



		$stmt = null;
	}

	/*=============================================
	BORRAR USUARIO
	=============================================*/

	static public function mdlBorrarUsuario($tabla, $datos)
	{

		$stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE id = :id");

		$stmt->bindParam(":id", $datos, PDO::PARAM_INT);

		if ($stmt->execute()) {

			return "ok";
		} else {

			return "error";
		}



		$stmt = null;
	}


	/**
	 * Ver Empresas Por usuario
	 */

	public static function mdlDecuentosPorUsuario($idUsuario)
	{

		$query = "SELECT
                id AS idEmpresa,
                a.NombreEmpresa,
                
                IFNULL(
                    (
                    SELECT
                        b.permiteVer
                    FROM
                        empresasPorUsuario b
                    WHERE
                        a.id = b.idEmpresa AND b.idUsuario = :idUsuario
                ),
                'NO'
                ) AS permiteVer
     
          
                FROM
                datosempresa a;";

		$con = Conexion::conectar()->prepare($query);

		$con->bindParam(":idUsuario", $idUsuario, PDO::PARAM_INT);


		try {

			$con->execute();

			return $con->fetchAll();
		} catch (PDOException $ex) {

			return $ex->getMessage();
		}
	}
}
