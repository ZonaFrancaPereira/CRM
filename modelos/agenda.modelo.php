<?php

require_once "conexion.php";

class ModeloAgenda{

     static public function mdlGuardarEvento($datos) {

        $stmt = Conexion::conectar()->prepare("INSERT INTO eventos (title, start2, end2, background_color, border_color, text_color, allDay,id_usuario_fk) VALUES (:title, :start2, :end2, :backgroundColor, :borderColor, :textColor, :allDay,:id_usuario_fk)");

        $stmt->bindParam(":title", $datos["title"], PDO::PARAM_STR);
        $stmt->bindParam(":start2", $datos["start"], PDO::PARAM_STR);
        $stmt->bindParam(":end2", $datos["end"], PDO::PARAM_STR);
        $stmt->bindParam(":backgroundColor", $datos["backgroundColor"], PDO::PARAM_STR);
        $stmt->bindParam(":borderColor", $datos["borderColor"], PDO::PARAM_STR);
        $stmt->bindParam(":textColor", $datos["textColor"], PDO::PARAM_STR);
        $stmt->bindParam(":allDay", $datos["allDay"], PDO::PARAM_INT);
        $stmt->bindParam(":id_usuario_fk", $datos["id_usuario_fk"], PDO::PARAM_INT);

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


    
    static public function mdlObtenerEventos($start, $end,$userId) {
      // Prepara la consulta SQL
      $stmt = Conexion::conectar()->prepare(
        "SELECT 
            e.id,
            e.title,
            e.start2,
            e.end2,
            e.background_color,
            e.border_color,
            e.text_color,
            e.allDay,
            e.id_usuario_fk,
            d.NombreEmpresa AS empresa_nombre
           
        FROM eventos e
        INNER JOIN usuarios u ON e.id_usuario_fk = u.id
        INNER JOIN datosempresa d ON e.title = d.id
        WHERE e.id_usuario_fk = :userId 
        AND e.start2 >= :start2 
        AND e.end2 <= :end2"
    );

    // Asigna los parámetros
    $stmt->bindParam(":userId", $userId);
    $stmt->bindParam(":start2", $start);
    $stmt->bindParam(":end2", $end);
      
      // Ejecuta la consulta
      $stmt->execute();
      
      // Devuelve los resultados en un formato de array asociativo
      return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }

    
  static public function mdlObtenerEventosU($start, $end, $userId) {
    // Construye la consulta SQL dinámicamente
    $sql = "SELECT 
                e.id,
                e.title,
                e.start2,
                e.end2,
                e.background_color,
                e.border_color,
                e.text_color,
                e.allDay,
                e.id_usuario_fk,
                u.nombre,
                u.apellidos_usuario,
                d.NombreEmpresa AS empresa_nombre
            FROM eventos e
            INNER JOIN usuarios u ON e.id_usuario_fk = u.id
            INNER JOIN datosempresa d ON e.title = d.id
            WHERE e.start2 >= :start2 
            AND e.end2 <= :end2";
    
    // Si el userId es diferente de 0, agregamos el filtro por usuario
    if ($userId != 0) {
        $sql .= " AND e.id_usuario_fk = :userId";
    }

    // Prepara la consulta
    $stmt = Conexion::conectar()->prepare($sql);

    // Asigna los parámetros
    $stmt->bindParam(":start2", $start);
    $stmt->bindParam(":end2", $end);

    // Si el userId no es 0, se asigna también el parámetro userId
    if ($userId != 0) {
        $stmt->bindParam(":userId", $userId, PDO::PARAM_INT);
    }

    // Ejecuta la consulta
    $stmt->execute();

    // Devuelve los resultados en un formato de array asociativo
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

static public function mdlEditarEvento($datos) {
    $stmt = Conexion::conectar()->prepare(
        "UPDATE eventos 
         SET 
             start2 = :start2, 
             end2 = :end2, 
             background_color = :backgroundColor, 
             border_color = :borderColor, 
             text_color = :textColor, 
             allDay = :allDay 
         WHERE id = :id"
    );

   
    $stmt->bindParam(":start2", $datos["start"], PDO::PARAM_STR);
    $stmt->bindParam(":end2", $datos["end"], PDO::PARAM_STR);
    $stmt->bindParam(":backgroundColor", $datos["backgroundColor"], PDO::PARAM_STR);
    $stmt->bindParam(":borderColor", $datos["borderColor"], PDO::PARAM_STR);
    $stmt->bindParam(":textColor", $datos["textColor"], PDO::PARAM_STR);
    $stmt->bindParam(":allDay", $datos["allDay"], PDO::PARAM_INT);
    $stmt->bindParam(":id", $datos["id"], PDO::PARAM_INT);

    if ($stmt->execute()) {
        return "ok";
    } else {
        return "error";
    }

    $stmt = null;
}

public static function mdlObtenerRestriccion($dia) {
    $stmt = Conexion::conectar()->prepare("SELECT * FROM restricciones_calendario 
    WHERE estado = 1
    AND (
        -- Caso 1: Restricción dentro de un mismo día
        (dia_inicio = :dia AND dia_fin = :dia)

        -- Caso 2: Día actual dentro del rango de días normales (sin cruzar medianoche)
        OR (dia_inicio < dia_fin AND :dia BETWEEN dia_inicio AND dia_fin)

        -- Caso 3: Restricción que cruza la medianoche
        OR (dia_inicio > dia_fin AND (:dia >= dia_inicio OR :dia <= dia_fin))
    )");

    $stmt->bindParam(":dia", $dia, PDO::PARAM_INT); // Cambio a PARAM_INT
    $stmt->bindParam(":hora", $hora, PDO::PARAM_STR);
    
    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

public static function mdlMostrarRestricciones() {
    $stmt = Conexion::conectar()->prepare("SELECT id_restriccion, dia_inicio, dia_fin, estado FROM restricciones_calendario");
    $stmt->execute();
    return $stmt->fetchAll();
  }




    public static function mdlActualizarRestriccion($tabla, $datos) {
        $stmt = Conexion::conectar()->prepare(
			"UPDATE $tabla SET dia_inicio = :dia_inicio, dia_fin = :dia_fin, estado = :estado 
            WHERE id_restriccion = :id_restriccion"
		);


        $stmt->bindParam(":dia_inicio", $datos["dia_inicio"], PDO::PARAM_STR);
        $stmt->bindParam(":dia_fin", $datos["dia_fin"], PDO::PARAM_STR);
        $stmt->bindParam(":estado", $datos["estado"], PDO::PARAM_INT);
        $stmt->bindParam(":id_restriccion", $datos["id_restriccion"], PDO::PARAM_INT);



		if ($stmt->execute()) {

			return "ok";
		} else {

			return "error";
		}

	

		$stmt = null;

    }







}
 ?>
 