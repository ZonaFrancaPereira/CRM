-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 14-02-2025 a las 17:31:29
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `tm`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `archivos_empresa`
--

CREATE TABLE `archivos_empresa` (
  `id_archivos` int(11) NOT NULL,
  `id_empresa_fk` int(100) NOT NULL,
  `id_categoria_fk` int(11) NOT NULL,
  `ruta_archivos_empresas` varchar(300) DEFAULT NULL,
  `nombre_archivo` varchar(200) DEFAULT NULL,
  `tipo_archivo_empresa` enum('Excel','Word','Pdf','') DEFAULT NULL,
  `estado_archivo` enum('Activo','Inactivo') DEFAULT NULL,
  `fecha_archivo` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `archivos_empresa`
--

INSERT INTO `archivos_empresa` (`id_archivos`, `id_empresa_fk`, `id_categoria_fk`, `ruta_archivos_empresas`, `nombre_archivo`, `tipo_archivo_empresa`, `estado_archivo`, `fecha_archivo`) VALUES
(17, 900910663, 1, 'vistas/files/EMPRESAS/FO-GH-19 Solicitud de Permiso V4.xlsx', 'FG', 'Excel', 'Inactivo', '2025-02-13'),
(18, 1, 16, 'vistas/files/EMPRESAS/HV_Joan_OP.docx', 'COTIZACION 1', 'Word', 'Activo', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `archivos_evaluacion`
--

CREATE TABLE `archivos_evaluacion` (
  `cod_archivo_e` int(11) NOT NULL,
  `nombre_archivo_e` text NOT NULL,
  `archivo_e` text NOT NULL,
  `tipo_archivo_e` enum('excel','word','guia') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

--
-- Volcado de datos para la tabla `archivos_evaluacion`
--

INSERT INTO `archivos_evaluacion` (`cod_archivo_e`, `nombre_archivo_e`, `archivo_e`, `tipo_archivo_e`) VALUES
(1, 'dd', 'vistas/archivos/Fase 2 - Perspectivas sociales_Yuliana_Melissa_Montoya.docx', 'word'),
(2, 'sds', 'vistas/archivos/Anexo 1 - Ejercicio Tarea 1 (1).docx', 'word'),
(3, '', 'vistas/archivos/extensiones.docx', 'word'),
(4, 'prueba', 'vistas/archivos/Anexo 2 - Fase 3 - Reflexión ético-ciudadana.docx', 'word');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `archivos_propuesta`
--

CREATE TABLE `archivos_propuesta` (
  `id_propuesta` int(11) NOT NULL,
  `id_empresa_prospecto` int(100) DEFAULT NULL,
  `id_categoria_prospecto` int(11) DEFAULT NULL,
  `nombre_propuesta` varchar(100) DEFAULT NULL,
  `ruta_archivos_propuesta` varchar(300) DEFAULT NULL,
  `tipo_archivo_propuesta` enum('Excel','Word','Pdf','') DEFAULT NULL,
  `fecha_propuesta` date DEFAULT current_timestamp(),
  `valor_propuesta` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `archivos_propuesta`
--

INSERT INTO `archivos_propuesta` (`id_propuesta`, `id_empresa_prospecto`, `id_categoria_prospecto`, `nombre_propuesta`, `ruta_archivos_propuesta`, `tipo_archivo_propuesta`, `fecha_propuesta`, `valor_propuesta`) VALUES
(1, 1, 16, 'C', 'vistas/files/EMPRESAS/HV_Joan_OP (1).docx', 'Word', '2025-02-14', '152000'),
(2, 1, 16, 'Z', 'vistas/files/COTIZACION/HV_Joan_OP (1).docx', 'Word', '2025-02-26', '1478963');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias`
--

CREATE TABLE `categorias` (
  `id_categoria` int(11) NOT NULL,
  `nombre_categoria` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `categorias`
--

INSERT INTO `categorias` (`id_categoria`, `nombre_categoria`) VALUES
(1, 'VALOR'),
(10, 'VENCIMIENTOS'),
(16, 'PROSPECTO');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clases`
--

CREATE TABLE `clases` (
  `id` int(11) NOT NULL,
  `clase` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `clases`
--

INSERT INTO `clases` (`id`, `clase`) VALUES
(1, 'controladores/plantilla.controlador.php'),
(2, 'controladores/usuarios.controlador.php'),
(4, 'controladores/empresa.controlador.php'),
(5, 'controladores/perfiles.controlador.php'),
(7, 'modelos/usuarios.modelo.php'),
(8, 'modelos/empresa.modelo.php'),
(10, 'modelos/perfiles.modelo.php'),
(11, 'modelos/bitacora.modelo.php'),
(40, 'controladores/agenda.controlador.php'),
(41, 'modelos/agenda.modelo.php'),
(42, 'controladores/archivo.controlador.php'),
(43, 'modelos/archivo.modelo.php'),
(44, 'modelos/categorias.modelo.php'),
(45, 'controladores/categorias.controlador.php');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `configuracioncorreo`
--

CREATE TABLE `configuracioncorreo` (
  `correoSaliente` varchar(75) DEFAULT NULL,
  `host` varchar(30) DEFAULT NULL,
  `SMTPDebug` int(11) DEFAULT NULL,
  `SMTPAuth` tinyint(1) DEFAULT NULL,
  `Puerto` int(11) DEFAULT NULL,
  `clave` varchar(250) DEFAULT NULL,
  `SMTPSeguridad` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `configuracioncorreo`
--

INSERT INTO `configuracioncorreo` (`correoSaliente`, `host`, `SMTPDebug`, `SMTPAuth`, `Puerto`, `clave`, `SMTPSeguridad`) VALUES
('correo@asd.com', 'smtp.gmail.com', 2, 1, 465, 'CEsar1234578@', 'ssl');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `datosempresa`
--

CREATE TABLE `datosempresa` (
  `id` int(100) NOT NULL,
  `dv` int(100) DEFAULT NULL,
  `NombreEmpresa` varchar(500) DEFAULT NULL,
  `DireccionEmpresa` varchar(1000) DEFAULT NULL,
  `ciudad` varchar(100) DEFAULT NULL,
  `Telefono` varchar(20) DEFAULT NULL,
  `telefono2` int(100) DEFAULT NULL,
  `nombre_rep_legal` varchar(200) DEFAULT NULL,
  `fecha_nap_red_legal` date DEFAULT NULL,
  `correoElectronico` varchar(250) DEFAULT NULL,
  `fecha_inicio_contrato` date DEFAULT NULL,
  `id_usuario_fk` int(11) DEFAULT NULL,
  `estado_empresa` enum('Cliente','Prospecto') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `datosempresa`
--

INSERT INTO `datosempresa` (`id`, `dv`, `NombreEmpresa`, `DireccionEmpresa`, `ciudad`, `Telefono`, `telefono2`, `nombre_rep_legal`, `fecha_nap_red_legal`, `correoElectronico`, `fecha_inicio_contrato`, `id_usuario_fk`, `estado_empresa`) VALUES
(0, 0, 'HOME MASTERY SAS', '', '', '', 0, '', '0000-00-00', '', '0000-00-00', 3, 'Cliente'),
(1, 1, '1', '1', '1', '1', 1, 'yuli', '2025-02-13', '1', '2025-02-27', 3, 'Prospecto'),
(72043322, 3, 'SERNA GIRALDO ARGIRO DE JESUS ', 'CALLE 17 # 7-34 PISO 2', 'PEREIRA', '3250824', 2147483647, 'ARGIRO DE JESUS SERNA GIRALDO', '2024-09-03', 'argirosernagiraldo@gmail.com', '0000-00-00', 2, 'Cliente'),
(800197111, 7, 'COOPERATIVA DE ENTIDADES DE SALUD DEL RISARALDA COODESURIS', 'CRA 13 # 87-298 BARRIO BELMONTE ', 'PEREIRA', '3515466', 0, 'MIGUEL ANGEL RENDON MONCADA', '0000-00-00', 'contabilidad@coodesuris.com', '0000-00-00', 2, 'Cliente'),
(816008012, 5, 'C M G  IMPORTACIONES SAS      ', 'CRA 14 # 103-61 BODEGA 14 TIERRA BUENA', 'PEREIRA', '3155545', 2147483647, 'LUIS FERNANDO GUTIERRES BRAVO', '0000-00-00', 'cmgautopartes@etp.net.co', '0000-00-00', 2, 'Cliente'),
(830106788, 2, 'ASOCIACION COLOMBIANA DE EMPRESAS SOCIALES DEL ESTADO Y HOSPITALES PUBLICOS ACESI', 'CL 84 CRA 23 MZ 12 CA 24 ESQUINA BARRIO CORRALES', 'PEREIRA', '3272974', 2147483647, 'OLGA LUCIA ZULUAGA  RODRIGUEZ', '0000-00-00', 'acesi.asociacion@gmail.com', '0000-00-00', 2, 'Cliente'),
(830146283, 6, 'MOVITRONIC SAS', 'CALLE 134 D #  45 A-34 ', 'BOGOTA', '8135235', 2147483647, 'CAROLINA ANDREA RESTREPO LOPEZ', '0000-00-00', 'crestrepo@ejercicioenlinea.com', '0000-00-00', 2, 'Cliente'),
(900129551, 7, 'HOME TERRITORY SAS            ', 'CALLE 82 # 20-40', 'BOGOTA', '6160492', 2147483647, 'ALEJANDRA RESTREPO CADAVID', '0000-00-00', 'administracion@pro-aqua.co', '0000-00-00', 2, 'Cliente'),
(900147334, 1, 'COMERCIALIZADORA PROQUIMEL LTDA ', 'CRA 6 # 16-82 BARRIO EL LLANO', 'CARTAGO', '3176428429', 2147483647, 'DAVID VALENCIA QUINTERO', '0000-00-00', 'proquimel.cartago@gmail.com', '0000-00-00', 2, 'Cliente'),
(900303570, 0, 'SOLUCIONES ARQUITECTONICAS EJE CAFETERO SAS', 'AV 30 AGOSTO 121 -16', 'PEREIRA', '3408883', 2147483647, 'CARLOS EDUARDO DELGADO VALENCIA', '0000-00-00', 'comercialsoluciones.arq@gmail.com', '0000-00-00', 2, 'Cliente'),
(900315215, 6, 'juam', 'juuio', 'sdxdc', 'czsdszc', 0, 'dc', '2024-11-20', 'xcd', '2024-11-06', NULL, 'Cliente'),
(900413336, 7, 'CACHARRERIA Y VARIEDADES ZONA  SAS', 'CALLE 17 # 7 -26 PISO 2', 'PEREIRA', '3250824', 2147483647, 'EDISON JOHAN SERNA ARISTIZABAL', '0000-00-00', 'contabilidadzfpereira@gmail.com', '0000-00-00', 2, 'Cliente'),
(900418896, 2, 'FANTASIAS Y VARIEDADES YULY SAS', 'CALLE 17 # 7 -28 PISO 2', 'PEREIRA', '3332083', 2147483647, 'MARIA AMPARO ARISTIZABAL RAMIREZ', '0000-00-00', 'variedadesyulysas@hotmail.com', '0000-00-00', 2, 'Cliente'),
(900565867, 8, 'ASELOG ASESORIAS Y LOGISTICA ZF SAS', 'VIA LA VIRGINIA CAIMALITO ZONA FRANCA INTERNACIONAL', 'PEREIRA', '3158527742', 3163438, 'DORA LORENA PINZON MARTINEZ', '0000-00-00', 'gerencia@aselogzf.com', '0000-00-00', 2, 'Cliente'),
(900607305, 2, 'NUTRICION E IMAGENES DEL EJE CAFETERO SAS', 'BARRIO SAN JOSE DE LAS VILLAS CASA 10 ET 1', 'PEREIRA', '3207202075', 3207676, 'ELSY YANETH PORRAS FRANCO', '0000-00-00', 'elsyguille@hotmail.com', '0000-00-00', 2, 'Cliente'),
(900645204, 9, 'AGRUPACION ZONA FRANCA INTERNACIONAL DE PEREIRA -PH', 'VEREDA ZONA FRANCA INTERNACIONAL CORREGIMIENTO DE CAIMALITO KM 10 VIA PEREIRA', 'PEREIRA', '3343000', 2147483647, 'JULIO CESAR RAIGOSA FRANCO', '0000-00-00', 'jraigosa@zonafrancadepereira.com', '0000-00-00', 2, 'Cliente'),
(900909789, 1, 'HOME MOLINA SAS               ', 'CRA 9 # 21-72', 'PEREIRA', '3386822', 2147483647, 'DIANA MARCELA MOLINA BETANCURTH', '0000-00-00', 'dm.homemolina@gmail.com', '0000-00-00', 2, 'Cliente'),
(900910663, 2, 'HOME GOLD S A S               ', 'CALLE 136 A 58 C 67 APTO 101', 'BOGOTA', '3174396143', 3003948, 'MARIA ADELAIDA MURILLO DE LA CRUZ', '0000-00-00', 'homegoldinternational@gmail.com', '0000-00-00', 3, 'Cliente'),
(900910817, 1, 'HOME BM SAS', 'CALLE 82 # 20-40', 'BOGOTA', '3143700277', 0, 'JACQUELINE MURCIA GARCIA', '0000-00-00', 'homebmsas@gmail.com', '0000-00-00', 3, 'Cliente'),
(901062742, 0, 'MEDIUM CONSULTORIA Y PROYECTOS SAS', 'CRA 16 BIS # 9-28 BARRIO PINARES', 'PEREIRA', '3133359', 2147483647, 'JULIAN  ALBERTO VILLEGAS FLORES', '0000-00-00', 'gerencia@mediumsas.com', '0000-00-00', 3, 'Cliente'),
(901111107, 4, 'HOME LION SAS                 ', 'CALLE 48 SUR 86 60 TORRE 28 AP 4109', 'BOGOTA', '3107917855', 0, 'DAVID ENRIQUE GONZALES FERRER', '0000-00-00', 'homelionsas@gmail.com', '0000-00-00', 3, 'Cliente'),
(901124002, 6, 'HOME POWER SAS', 'CRA 7 B # 135-77 TORRE 2 APTO 607', 'BOGOTA', '3004313956', 0, 'VIVIANA MORA ACU?A', '0000-00-00', 'viv25mora@gmail.com', '0000-00-00', 2, 'Cliente'),
(901219185, 4, 'INUT SAS                      ', 'CONDOMINIO CAMPESTRE CERROS DE ALHAMBRA CASA 1A', 'MANIZALES', '3215509680', 2147483647, 'ADRIANA TORRES NATES', '0000-00-00', 'juadma@hotmail.com', '0000-00-00', 3, 'Cliente'),
(901238036, 6, 'HOME TOP SAS                  ', 'CALLE 58 # 27-29 BARRIO LOS ANDES', 'BARRANQUILLA', '3016515072', 0, 'WILMER JOSE SOBRINO CAMACHO', '0000-00-00', 'hometopsas@gmail.com', '0000-00-00', 3, 'Cliente'),
(901244483, 1, 'HOME SALUDABLE SAS', 'CALLE 10 # 32-16 APTO 501 BARRIO LA AURORA', 'PASTO', '3206872821', 0, 'PAOLA ANDREA PATI?O CABRERA', '0000-00-00', 'paopatino0311@hotmail.com', '0000-00-00', 3, 'Cliente'),
(901265186, 7, 'INNVESTPRO S.A.S.', 'CL 34 AV LA DULCERA 20 51 APTO 302 TORRE 1', 'PEREIRA', '3002031747', 2147483647, 'ANDRES FELIPE BETANCURT GARCIA', '0000-00-00', 'director1.pro@gmail.com', '0000-00-00', 2, 'Cliente'),
(901278857, 7, 'HOME ETERNITY SAS', 'CALLE 82 # 20-40', 'BOGOTA', '3227539008', 6160492, 'OLGA JEANNETTY BARRIO JIMENEZ', '0000-00-00', 'hometernitysas@gmail.com', '0000-00-00', 3, 'Cliente'),
(901291880, 0, 'PINILLA OBREGON SAS           ', 'CALLE 3 A # 20 -70 APTO 702 ED PINAMAR', 'PEREIRA', '3163734', 2147483647, 'MARIA TERESA OBREGON ROJAS', '0000-00-00', 'mariatobregon76@hotmail.com', '0000-00-00', 3, 'Cliente'),
(901344164, 4, 'HOME JIREHS SAS', 'CALLE 113 # 50-27', 'BOGOTA', '3012431782', 0, 'SABRINA RANGEL CRESPO', '0000-00-00', 'homejirehssas@gmaail.com', '0000-00-00', 3, 'Cliente'),
(901386604, 3, 'HOME INNOVA SAS', 'CALLE 82 # 20-40', 'BOGOTA', '3203624300', 0, 'JUAN DAVID AVILA RODRIGUEZ', '0000-00-00', 'jdavila_@outlook.es', '0000-00-00', 3, 'Cliente'),
(901429320, 3, 'HOME GLOW SAS', 'CRA 9 # 21-72', 'PEREIRA', '3015247470', 2147483647, 'DANIELA GARCIA URIBE', '0000-00-00', 'homeglowsas@gmail.com', '0000-00-00', 3, 'Cliente'),
(901480830, 3, 'HOME FULL SAS', 'CALLE 10 NORTE 14-57', 'ARMENIA', '3106159739', 0, 'LUIS EDUARDO GONZALES VERA', '0000-00-00', 'homefullsas@gmail.com', '0000-00-00', 3, 'Cliente'),
(901487429, 4, 'HOME LA SABANA SAS', 'CALLE 82 # 20-40', 'BOGOTA', '3157079015', 0, 'CARLOS ALEXANDER HERRERA', '0000-00-00', 'cherrerahomeprestigesas@gmail.com', '0000-00-00', 3, 'Cliente'),
(901503664, 8, 'DU BLE SAS', 'CRA 9 # 8 -15 LOTE 3  ZONA INDUSTRIAL LA BADEA ', 'DOSQUEBRADAS', '3155300339', 0, 'JACQUELINE SALAZAR PEREZ', '0000-00-00', 'gerencia@loly.com.co', '0000-00-00', 1, 'Cliente'),
(901503847, 9, 'HOME VICTORY ED SAS', 'CRA 2 # 32-49 TORRE 1 OF 206 ED QUINTA SANTANA', 'TUNJA', '3138499755', 2147483647, 'EDGAR ALFONSO FUENTES FERNANDEZ', '0000-00-00', 'homevictoryed@gmail.com', '0000-00-00', 3, 'Cliente'),
(901536337, 6, 'SYNERGIA OCUPACIONAL SAS', 'CALLE 11 #12B - 26 CIRCUNVALAR', 'PEREIRA', '3113894162', 2147483647, 'JAQUELINE CRISTANCHO PULIDO', '0000-00-00', 'macrisaralda@gmail.com', '0000-00-00', 3, 'Cliente'),
(901552905, 7, 'HOME LIBERTY SAS', 'CALLE 113 # 50-27', 'BOGOTA', '3106590230', 0, 'DEIVIS KARINA GALVIS CAMARGO', '0000-00-00', 'homelibertysas@gmail.com', '0000-00-00', 3, 'Cliente'),
(901561066, 0, 'HOME AMATISTA SAS', 'CRA 49 B # 93-38', 'BOGOTA', '3012403325', 0, 'ENNYS MAIRYN QUIROGA HERRERA', '0000-00-00', 'homeamatista.eq@gmail.com', '0000-00-00', 2, 'Cliente'),
(901562973, 0, 'HOME ANGELS SAS', 'CRA 49 B # 93-38', 'BOGOTA', '3222167675', 0, 'DANIRE MATA TOVAR', '0000-00-00', 'homeangels25@gmail.com', '0000-00-00', 3, 'Cliente'),
(901671111, 6, 'HOME EXPERIENCE SAS', 'CALLE 82 # 20-40', 'BOGOTA', '3197272378', 0, 'JULIANA ANDREA SERNA DEVIA', '0000-00-00', 'gerenciahomeexperience@gmail.com', '0000-00-00', 3, 'Cliente'),
(901694205, 9, 'HOME ASSA SAS', 'CRA 20 # 21- 29 APTO 202 BARRIO PROVIDENCIA', 'PEREIRA', '3135125392', 0, 'RAY ASHAEL APONTE PULGAR', '0000-00-00', 'apontepulgarray@gmail.com', '0000-00-00', 3, 'Cliente'),
(901779441, 7, 'HOME SMART BY POWER SAS', 'CL 82 # 20-40', 'BOGOTA', '3104671341', 0, 'DIEGO FERNANDO HENAO BELTRAN', '0000-00-00', 'homesmartbypower@gmail.com', '0000-00-00', 3, 'Cliente'),
(901796184, 0, 'GARCIA CIFUENTES MEDICINA DEL TRABAJO SAS', 'CR 5 18 -33 CS 601', 'PEREIRA', '3006545846', 3469000, 'BEATRIZ ELENA GARCIA CARDONA', '0000-00-00', 'garciacifuentessst@gmail.com', '0000-00-00', 3, 'Cliente'),
(901806453, 1, 'PEOPLE MOVIL S.A.S.', 'CR 7 #17-21 PASAJE COMERCIAL ZONA FRANCA', 'PEREIRA', '3183256440', 0, 'JAIME ALBERTO CASTA?O QUINTERO', '0000-00-00', '', '0000-00-00', 3, 'Cliente');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_actividades`
--

CREATE TABLE `detalle_actividades` (
  `id_actividad` int(11) NOT NULL,
  `actividades_realizadas` varchar(500) DEFAULT NULL,
  `id_visita_fk` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `detalle_actividades`
--

INSERT INTO `detalle_actividades` (`id_actividad`, `actividades_realizadas`, `id_visita_fk`) VALUES
(18, '<div style=\"color: rgb(171, 178, 191); background-color: rgb(35, 39, 46); font-family: Consolas, &quot;Courier New&quot;, monospace; font-size: 14px; line-height: 19px; white-space: pre;\">Lorem ipsum dolor sit amet consectetur adipisicing elit. Molestiae repellat animi sapiente</div><div style=\"color: rgb(171, 178, 191); background-color: rgb(35, 39, 46); font-family: Consolas, &quot;Courier New&quot;, monospace; font-size: 14px; line-height: 19px; white-space: pre;\"> maxime, recusandae a facili', 20),
(19, '<p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Molestiae repellat animi sapiente maxime, recusandae a facilis. Dolorum ratione voluptatum pariatur? Autem nemo obcaecati laudantium officia reprehenderit distinctio iste, natus harum!</p>', 21);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_compromiso`
--

CREATE TABLE `detalle_compromiso` (
  `id_compromiso` int(11) NOT NULL,
  `fecha_proyectada` text DEFAULT current_timestamp(),
  `descripcion_compromiso` varchar(300) DEFAULT NULL,
  `id_responsable_fk` int(11) DEFAULT NULL,
  `observaciones_compromiso` varchar(300) DEFAULT NULL,
  `id_visita_fk` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `detalle_compromiso`
--

INSERT INTO `detalle_compromiso` (`id_compromiso`, `fecha_proyectada`, `descripcion_compromiso`, `id_responsable_fk`, `observaciones_compromiso`, `id_visita_fk`) VALUES
(13, '', '', 0, '', 20),
(14, '', '', 0, '', 21);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `eventos`
--

CREATE TABLE `eventos` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `start` datetime NOT NULL,
  `end` datetime DEFAULT NULL,
  `background_color` varchar(7) NOT NULL,
  `border_color` varchar(7) NOT NULL,
  `text_color` varchar(7) NOT NULL,
  `allDay` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `perfiles`
--

CREATE TABLE `perfiles` (
  `perfil` int(11) NOT NULL,
  `descripcion` varchar(50) DEFAULT NULL,
  `AdminUsuarios` enum('off','on') DEFAULT NULL,
  `VerUsuarios` enum('off','on') DEFAULT NULL,
  `EstadoUsuarios` enum('off','on') DEFAULT NULL,
  `AdminPerfiles` enum('off','on') DEFAULT NULL,
  `AdminEmpresa` enum('off','on') NOT NULL,
  `SubirDocumentos` enum('off','on') NOT NULL,
  `SubirCalendario` enum('off','on') NOT NULL,
  `AdminCalendario` enum('off','on') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `perfiles`
--

INSERT INTO `perfiles` (`perfil`, `descripcion`, `AdminUsuarios`, `VerUsuarios`, `EstadoUsuarios`, `AdminPerfiles`, `AdminEmpresa`, `SubirDocumentos`, `SubirCalendario`, `AdminCalendario`) VALUES
(1, 'sd', 'off', 'off', 'off', 'off', 'off', 'off', 'off', 'off');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `registro_visitas`
--

CREATE TABLE `registro_visitas` (
  `id_visita` int(11) NOT NULL,
  `id_empresa_fk` int(100) DEFAULT NULL,
  `fecha_visita` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `hora_inicio` time DEFAULT current_timestamp(),
  `hora_fin` time DEFAULT current_timestamp(),
  `firma_consultor` text DEFAULT NULL,
  `firma_cliente` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `registro_visitas`
--

INSERT INTO `registro_visitas` (`id_visita`, `id_empresa_fk`, `fecha_visita`, `hora_inicio`, `hora_fin`, `firma_consultor`, `firma_cliente`) VALUES
(21, 901503664, '2025-03-03 00:00:00', '09:23:00', '07:21:00', 'g', 'hg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rutinas`
--

CREATE TABLE `rutinas` (
  `id_rutina` int(11) NOT NULL,
  `nombre_rutina` varchar(300) NOT NULL,
  `descripcion_rutina` text NOT NULL,
  `video_rutina` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nombre` text NOT NULL,
  `apellidos_usuario` varchar(100) NOT NULL,
  `correo_usuario` varchar(100) NOT NULL,
  `password` text NOT NULL,
  `perfil` int(11) NOT NULL,
  `firma` text NOT NULL,
  `estado` int(11) DEFAULT NULL,
  `id_cargo_fk` int(11) NOT NULL,
  `id_proceso_fk` int(11) NOT NULL,
  `ultimo_login` datetime DEFAULT NULL,
  `fecha` timestamp NULL DEFAULT current_timestamp(),
  `intentos` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `nombre`, `apellidos_usuario`, `correo_usuario`, `password`, `perfil`, `firma`, `estado`, `id_cargo_fk`, `id_proceso_fk`, `ultimo_login`, `fecha`, `intentos`) VALUES
(0, 'n/a', 'n/a', 'n/a', '$2a$07$asxx54ahjppf45sd87a5auXBm1Vr2M1NV5t/zNQtGHGpS5fFirrbG', 0, '', 1, 0, 0, NULL, '2025-02-11 20:14:11', NULL),
(1, 'Administrador', 'Admin', 'admin', '$2a$07$asxx54ahjppf45sd87a5auXBm1Vr2M1NV5t/zNQtGHGpS5fFirrbG', 1, 'vistas/img/usuarios/admin/489.jpg', 1, 2, 2, '2025-02-14 09:38:40', '2020-04-28 06:20:56', 2),
(3, 'vendedor', '', 'vendedor', '$2a$07$asxx54ahjppf45sd87a5auXBm1Vr2M1NV5t/zNQtGHGpS5fFirrbG', 4, '', 1, 2, 2, '2025-01-14 13:47:51', '2022-08-03 02:07:21', NULL);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `archivos_empresa`
--
ALTER TABLE `archivos_empresa`
  ADD PRIMARY KEY (`id_archivos`),
  ADD KEY `id_empresa_fk` (`id_empresa_fk`,`id_categoria_fk`),
  ADD KEY `id_categoria_fk` (`id_categoria_fk`);

--
-- Indices de la tabla `archivos_evaluacion`
--
ALTER TABLE `archivos_evaluacion`
  ADD PRIMARY KEY (`cod_archivo_e`);

--
-- Indices de la tabla `archivos_propuesta`
--
ALTER TABLE `archivos_propuesta`
  ADD PRIMARY KEY (`id_propuesta`),
  ADD KEY `id_empresa_prospecto` (`id_empresa_prospecto`,`id_categoria_prospecto`),
  ADD KEY `id_categoria_prospecto` (`id_categoria_prospecto`);

--
-- Indices de la tabla `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`id_categoria`);

--
-- Indices de la tabla `clases`
--
ALTER TABLE `clases`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `datosempresa`
--
ALTER TABLE `datosempresa`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_usuario_fk` (`id_usuario_fk`);

--
-- Indices de la tabla `detalle_actividades`
--
ALTER TABLE `detalle_actividades`
  ADD PRIMARY KEY (`id_actividad`),
  ADD KEY `id_visita_fk` (`id_visita_fk`);

--
-- Indices de la tabla `detalle_compromiso`
--
ALTER TABLE `detalle_compromiso`
  ADD PRIMARY KEY (`id_compromiso`),
  ADD KEY `id_responsable_fk` (`id_responsable_fk`),
  ADD KEY `id_visita_fk` (`id_visita_fk`);

--
-- Indices de la tabla `eventos`
--
ALTER TABLE `eventos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `registro_visitas`
--
ALTER TABLE `registro_visitas`
  ADD PRIMARY KEY (`id_visita`),
  ADD KEY `id_empresa_fk` (`id_empresa_fk`);

--
-- Indices de la tabla `rutinas`
--
ALTER TABLE `rutinas`
  ADD PRIMARY KEY (`id_rutina`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `archivos_empresa`
--
ALTER TABLE `archivos_empresa`
  MODIFY `id_archivos` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT de la tabla `archivos_evaluacion`
--
ALTER TABLE `archivos_evaluacion`
  MODIFY `cod_archivo_e` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `archivos_propuesta`
--
ALTER TABLE `archivos_propuesta`
  MODIFY `id_propuesta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `categorias`
--
ALTER TABLE `categorias`
  MODIFY `id_categoria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT de la tabla `clases`
--
ALTER TABLE `clases`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT de la tabla `detalle_actividades`
--
ALTER TABLE `detalle_actividades`
  MODIFY `id_actividad` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT de la tabla `detalle_compromiso`
--
ALTER TABLE `detalle_compromiso`
  MODIFY `id_compromiso` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT de la tabla `eventos`
--
ALTER TABLE `eventos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `registro_visitas`
--
ALTER TABLE `registro_visitas`
  MODIFY `id_visita` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `archivos_empresa`
--
ALTER TABLE `archivos_empresa`
  ADD CONSTRAINT `archivos_empresa_ibfk_1` FOREIGN KEY (`id_categoria_fk`) REFERENCES `categorias` (`id_categoria`) ON UPDATE CASCADE,
  ADD CONSTRAINT `archivos_empresa_ibfk_2` FOREIGN KEY (`id_empresa_fk`) REFERENCES `datosempresa` (`id`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `archivos_propuesta`
--
ALTER TABLE `archivos_propuesta`
  ADD CONSTRAINT `archivos_propuesta_ibfk_1` FOREIGN KEY (`id_empresa_prospecto`) REFERENCES `datosempresa` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `archivos_propuesta_ibfk_2` FOREIGN KEY (`id_categoria_prospecto`) REFERENCES `categorias` (`id_categoria`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `datosempresa`
--
ALTER TABLE `datosempresa`
  ADD CONSTRAINT `datosempresa_ibfk_1` FOREIGN KEY (`id_usuario_fk`) REFERENCES `usuarios` (`id`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `detalle_actividades`
--
ALTER TABLE `detalle_actividades`
  ADD CONSTRAINT `detalle_actividades_ibfk_1` FOREIGN KEY (`id_visita_fk`) REFERENCES `registro_visitas` (`id_visita`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `detalle_compromiso`
--
ALTER TABLE `detalle_compromiso`
  ADD CONSTRAINT `detalle_compromiso_ibfk_1` FOREIGN KEY (`id_responsable_fk`) REFERENCES `usuarios` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `detalle_compromiso_ibfk_2` FOREIGN KEY (`id_visita_fk`) REFERENCES `registro_visitas` (`id_visita`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `registro_visitas`
--
ALTER TABLE `registro_visitas`
  ADD CONSTRAINT `registro_visitas_ibfk_2` FOREIGN KEY (`id_empresa_fk`) REFERENCES `datosempresa` (`id`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
