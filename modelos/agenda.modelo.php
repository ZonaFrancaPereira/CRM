<?php

require_once "conexion.php";

class ModeloAgenda{

     static public function mdlGuardarEvento($datos) {

        $stmt = Conexion::conectar()->prepare("INSERT INTO eventos (title, start, end, backgroundColor, borderColor, textColor, allDay) VALUES (:title, :start, :end, :backgroundColor, :borderColor, :textColor, :allDay)");

        $stmt->bindParam(":title", $datos["title"], PDO::PARAM_STR);
        $stmt->bindParam(":start", $datos["start"], PDO::PARAM_STR);
        $stmt->bindParam(":end", $datos["end"], PDO::PARAM_STR);
        $stmt->bindParam(":backgroundColor", $datos["backgroundColor"], PDO::PARAM_STR);
        $stmt->bindParam(":borderColor", $datos["borderColor"], PDO::PARAM_STR);
        $stmt->bindParam(":textColor", $datos["textColor"], PDO::PARAM_STR);
        $stmt->bindParam(":allDay", $datos["allDay"], PDO::PARAM_INT);

		if ($stmt->execute()) {
			return "ok";
		} else {
			return "error";
		}

		
		$stmt = null;


    }

     static  public function mdlEliminarEvento($id) {
        $stmt = Conexion::conectar()->prepare("DELETE FROM eventos WHERE id = :id");

        $stmt->bindParam(":id", $id, PDO::PARAM_INT);

        return $stmt->execute();
    }

     static public  function mdlObtenerEventos($start, $end) {
        $stmt = Conexion::conectar()->prepare("SELECT * FROM eventos WHERE start BETWEEN :start AND :end");

        $stmt->bindParam(":start", $start, PDO::PARAM_STR);
        $stmt->bindParam(":end", $end, PDO::PARAM_STR);
        $stmt->execute();

		// Utilizar fetchAll para obtener todos los resultados
		return $stmt->fetchAll();
    }
}
 ?>