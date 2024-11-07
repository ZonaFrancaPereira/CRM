<?php

require_once "conexion.php";

class ModeloAgenda{

     static public function mdlGuardarEvento($datos) {

        $stmt = Conexion::conectar()->prepare("INSERT INTO eventos (title, start2, end2, background_color, border_color, text_color, allDay) VALUES (:title, :start2, :end2, :backgroundColor, :borderColor, :textColor, :allDay)");

        $stmt->bindParam(":title", $datos["title"], PDO::PARAM_STR);
        $stmt->bindParam(":start2", $datos["start"], PDO::PARAM_STR);
        $stmt->bindParam(":end2", $datos["end"], PDO::PARAM_STR);
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

    static public function mdlObtenerEventos($start, $end) {
      // Prepara la consulta SQL
      $stmt = Conexion::conectar()->prepare("SELECT * FROM eventos WHERE start2 >= :start AND end2 <= :end");

      // Asigna los parámetros
      $stmt->bindParam(":start", $start);
      $stmt->bindParam(":end", $end);
      
      // Ejecuta la consulta
      $stmt->execute();
      
      // Devuelve los resultados en un formato de array asociativo
      return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }
}
 ?>