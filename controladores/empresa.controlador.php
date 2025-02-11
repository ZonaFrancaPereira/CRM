<?php

class ControladorEmpresa
{
    /* =============================================
      CREAR EMPRESA
      ============================================= */

    public static function ctrCrearEmpresas()
    {
        if (isset($_POST["NombreEmpresa"])) {
            // Validar que los campos obligatorios no estén vacíos
            if (!empty($_POST["id"]) && !empty($_POST["dv"]) && !empty($_POST["NombreEmpresa"])) {
                // Preparar datos para el modelo
                $tabla = "datosempresa";
                $datos = array(
                    "id" => $_POST["id"],
                    "dv" => $_POST["dv"],
                    "NombreEmpresa" => $_POST["NombreEmpresa"],
                    "DireccionEmpresa" => $_POST["DireccionEmpresa"],
                    "ciudad" => $_POST["ciudad"],
                    "Telefono" => $_POST["Telefono"],
                    "telefono2" => $_POST["telefono2"],
                    "nombre_rep_legal" => $_POST["nombre_rep_legal"],
                    "fecha_nap_red_legal" => $_POST["fecha_nap_red_legal"],
                    "correoElectronico" => $_POST["correoElectronico"],
                    "fecha_inicio_contrato" => $_POST["fecha_inicio_contrato"]
                );

                // Llamar al modelo
                $respuesta = ModeloEmpresas::mdlCrearEmpresa($tabla, $datos);

                // Verificar la respuesta y mostrar alertas
                if ($respuesta == "ok") {
                    echo '<script>
                            Swal.fire(
                            "Buen Trabajo!",
                            "Su respuesta se ha registrado con éxito.",
                            "success"
                            ).then(function() {
                            document.getElementById("crear_empresa").reset();
                            });
                        </script>';
                } else {
                    echo '<script>
                        Swal.fire({
                            type: "error",
                            title: "¡La Respuesta no pudo ser guardada!",
                            text: "Error: ' . implode(" - ", $respuesta) . '", // Mostrar error específico de PDO
                            showConfirmButton: true,
                            confirmButtonText: "Cerrar"
                        });
                    </script>';
                }
            } else {
                echo '<script>
                        Swal.fire({
                            type: "error",
                            title: "¡Faltan Datos Obligatorios!",
                            text: "Por favor, complete todos los campos obligatorios.",
                            showConfirmButton: true,
                            confirmButtonText: "Cerrar"
                        });
                    </script>';
            }
        }
    }


    /* =============================================
      MOSTRAR EMPRESA
      ============================================= */

    static public function ctrMostrarEmpresa($item, $valor)
    {
        $tabla = "datosempresa";

        $respuesta = ModeloEmpresas::mdlMostraEmpresas($tabla, $item, $valor);

        return $respuesta;
    }
      /* =============================================
      MOSTRAR EMPRESA ASIGNADA AL USUARIO
      ============================================= */

      static public function ctrMostrarEmpresaUsuario($item, $valor)
      {
          $tabla = "datosempresa";
  
          $respuesta = ModeloEmpresas::mdlMostraEmpresasUsuario($tabla, $item, $valor);
  
          return $respuesta;
      }

/* =============================================
      MOSTRAR EMPRESA
      ============================================= */

    static public function ctrMostrarEmpresaAsignada($consulta)
    {
        $tabla = "datosempresa";

        $respuesta = ModeloEmpresas::mdlMostraEmpresasAsignada($tabla, $consulta);

        return $respuesta;
    }

    /* =============================================
      EDITAR EMPRESA
      ============================================= */

    public static function ctrActualizarEmpresa()
    {
        if (isset($_POST["actualizar_empresa"])) {
            // Capturar datos desde el formulario
            $datos = array(
                "id" => $_POST["id_empresa"],
                "dv" => $_POST["dv_empresa"],
                "NombreEmpresa" => $_POST["nombre_empresa"],
                "DireccionEmpresa" => $_POST["direccion_empresa"],
                "ciudad" => $_POST["ciudad_empresa"],
                "Telefono" => $_POST["telefono_empresa"],
                "telefono2" => $_POST["telefono2_empresa"],
                "nombre_rep_legal" => $_POST["nombre_rep_legal_empresa"],
                "correoElectronico" => $_POST["correo_empresa"]
            );

            // Llamar al modelo para actualizar la fecha y otros datos
            $respuesta = ModeloEmpresas::mdlActualizarEmpresa($datos);

            // Manejar la respuesta del modelo
            if ($respuesta == "ok") {
                echo '<script>
                Swal.fire(
                    "Actualizado!",
                    "La información de la empresa ha sido actualizada con éxito.",
                    "success"
                ).then(function() {
                    window.location = ""; // Redirige a la página "perfil"
                });
                </script>';
            } else {
                echo '<script>
                    Swal.fire(
                        "ERROR!",
                        "Error al actualizar la información de la empresa.",
                        "error"
                    ).then(function() {
                        window.location = ""; // Redirige a la página actual o a la vista correcta
                    });
                    </script>';
            }
        }
    }

        /* =============================================
      ASIGNAR EMPRESA
      ============================================= */
    public static function ctrAsignarEmpresa()
    {
        if (isset($_POST["asignar_empresa"])) {
            // Capturar datos desde el formulario
            $datos = array(
                "id" => $_POST["id_asignar"],
                "id_usuario_fk" => $_POST["id_usuario_fk_empresa"]
            );

            // Llamar al modelo para actualizar la fecha y otros datos
            $respuesta = ModeloEmpresas::mdlAsignarEmpresa($datos);

            // Manejar la respuesta del modelo
            if ($respuesta == "ok") {
                // Si la asignación fue exitosa, mostrar mensaje y recargar la página dos veces
                echo '<script>
                    Swal.fire(
                        "Asignado!",
                        "La Empresa ha sido asignada con exito.",
                        "success"
                    ).then(function() {
                        // Primer recarga
                        window.location = ""; 
                        // Segundo recarga (esto ocurre después de la primera recarga)
                        setTimeout(function(){
                            window.location = "";
                        }, 2000); // Este segundo recarga se ejecuta 2 segundos después de la primera
                    });
                </script>';
            } else {
                // Si hubo un error al asignar la empresa, mostrar mensaje de error
                echo '<script>
                    Swal.fire(
                        "ERROR!",
                        "Error al asignar la empresa.",
                        "error"
                    ).then(function() {
                        // Primer recarga
                        window.location = ""; 
                        // Segundo recarga (esto ocurre después de la primera recarga)
                        setTimeout(function(){
                            window.location = "";
                        }, 2000); // Este segundo recarga se ejecuta 2 segundos después de la primera
                    });
                </script>';
            }
        }
    }

     /* =============================================
      REGISTRAR VISITA
      ============================================= */
      public static function ctrRegistrarVisita()
      {
          if (isset($_POST["id_empresa_fk_visita"])) {
              // Convertir la hora de AM/PM a formato 24 horas antes de guardarla
              $hora_inicio = date("H:i:s", strtotime($_POST["hora_inicio"]));
              $hora_fin = date("H:i:s", strtotime($_POST["hora_fin"]));
      
              // Capturar datos desde el formulario
              $datos = array(
                  "id_empresa_fk" => $_POST["id_empresa_fk_visita"],
                  "fecha_visita" => $_POST["fecha_visita"],
                  "hora_inicio" => $hora_inicio, // Guardar en formato 24 horas
                  "hora_fin" => $hora_fin, // Guardar en formato 24 horas
                  "firma_consultor" => $_POST["firma_consultor"],
                  "firma_cliente" => $_POST["firma_cliente"]
              );
      
              // Llamar al modelo para actualizar la fecha y otros datos
              $respuesta = ModeloEmpresas::mdlRegistrarVisita($datos);

              if (is_array($respuesta) && $respuesta["status"] === "ok") {
                // Usar el último ID insertado
                $id_visita_fk = $respuesta["id_visita_fk"];
                $actividad = $_POST["actividades_realizadas"];
                $totalItems = count($actividad);
    
                for ($i = 0; $i < $totalItems; $i++) {
                    // Capturar datos de cada fila
                    $datosActividad = array(
                        "actividades_realizadas" => $actividad[$i],
                        "id_visita_fk" => $id_visita_fk
                    );
    
                    // Llamar al modelo para insertar los detalles de cada artículo
                    $respuestaDetalle = ModeloEmpresas::mdlCrearDetalleActividad($datosActividad);
      
                    if ($respuestaDetalle !== "ok") {
                        echo '<script>
                            Swal.fire({
                                icon: "error",
                                title: "Error al insertar el artículo: ' . htmlspecialchars($id_visita_fk[$i]) . '",
                                showConfirmButton: true,
                                confirmButtonText: "Cerrar"
                            });
                        </script>';
                        return;
                    }
                }

                // Capturar datos de los compromisos
                $fecha_proyectada = $_POST["fecha_proyectada"];
                $descripcion_compromiso = $_POST["descripcion_compromiso"];
                $id_responsable_fk = $_POST["id_responsable_fk"];
                $observaciones_compromiso = $_POST["observaciones_compromiso"];
                $totalCompromisos = count($fecha_proyectada);

                for ($i = 0; $i < $totalCompromisos; $i++) {
                    // Capturar datos de cada fila
                    $datosCompromiso = array(
                        "fecha_proyectada" => $fecha_proyectada[$i],
                        "descripcion_compromiso" => $descripcion_compromiso[$i],
                        "id_responsable_fk" => $id_responsable_fk[$i],
                        "observaciones_compromiso" => $observaciones_compromiso[$i],
                        "id_visita_fk" => $id_visita_fk
                    );

                    // Llamar al modelo para insertar los detalles de cada compromiso
                    $respuestaCompromiso = ModeloEmpresas::mdlCrearDetalleCompromiso($datosCompromiso);

                    if ($respuestaCompromiso !== "ok") {
                        echo '<script>
                            Swal.fire({
                                icon: "error",
                                title: "Error al insertar el compromiso: ' . htmlspecialchars($descripcion_compromiso[$i]) . '",
                                showConfirmButton: true,
                                confirmButtonText: "Cerrar"
                            });
                        </script>';
                        return;
                    }
                }

                // Si todas las actividades se registraron correctamente
                echo '<script>
                    Swal.fire(
                        "Registrado!",
                        "La Visita ha sido registrada con éxito.",
                        "success"
                    ).then(function() {
                        window.location = "";
                    });
                </script>';
            } else {
                echo '<script>
                    Swal.fire(
                        "ERROR!",
                        "Error al registrar la visita.",
                        "error"
                    ).then(function() {
                        window.location = "";
                    });
                </script>';
            }
        }
    }

      /* =============================================
      MOSTRAR VISITAS
      ============================================= */

      static public function ctrMostrarVisita($item, $valor, $visita)
      {
          $tabla = "registro_visitas";
  
          $respuesta = ModeloEmpresas::mdlMostraVisita($tabla, $item, $valor, $visita);
  
          return $respuesta;
      }









}
