-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 07-11-2024 a las 15:12:15
-- Versión del servidor: 10.4.28-MariaDB
-- Versión de PHP: 8.0.28

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
(5, '', 'vistas/archivos/Plantilla_Colegiado.docx', 'word');

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
(42, 'modelos/archivo.modelo.php'),
(43, 'controladores/archivo.controlador.php');

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
  `id_usuario_fk` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `datosempresa`
--

INSERT INTO `datosempresa` (`id`, `dv`, `NombreEmpresa`, `DireccionEmpresa`, `ciudad`, `Telefono`, `telefono2`, `nombre_rep_legal`, `fecha_nap_red_legal`, `correoElectronico`, `fecha_inicio_contrato`, `id_usuario_fk`) VALUES
(0, 0, 'HOME MASTERY SAS', '', '', '', 0, '', '0000-00-00', '', '0000-00-00', 2),
(1, 1, '1', '1', '1', '1', 1, '1', '2024-09-27', '2', '2024-09-27', 2),
(72043322, 3, 'SERNA GIRALDO ARGIRO DE JESUS ', 'CALLE 17 # 7-34 PISO 2', 'PEREIRA', '3250824', 2147483647, 'ARGIRO DE JESUS SERNA GIRALDO', '2024-09-03', 'argirosernagiraldo@gmail.com', '0000-00-00', 2),
(800197111, 7, 'COOPERATIVA DE ENTIDADES DE SALUD DEL RISARALDA COODESURIS', 'CRA 13 # 87-298 BARRIO BELMONTE ', 'PEREIRA', '3515466', 0, 'MIGUEL ANGEL RENDON MONCADA', '0000-00-00', 'contabilidad@coodesuris.com', '0000-00-00', 2),
(816008012, 5, 'C M G  IMPORTACIONES SAS      ', 'CRA 14 # 103-61 BODEGA 14 TIERRA BUENA', 'PEREIRA', '3155545', 2147483647, 'LUIS FERNANDO GUTIERRES BRAVO', '0000-00-00', 'cmgautopartes@etp.net.co', '0000-00-00', 2),
(830106788, 2, 'ASOCIACION COLOMBIANA DE EMPRESAS SOCIALES DEL ESTADO Y HOSPITALES PUBLICOS ACESI', 'CL 84 CRA 23 MZ 12 CA 24 ESQUINA BARRIO CORRALES', 'PEREIRA', '3272974', 2147483647, 'OLGA LUCIA ZULUAGA  RODRIGUEZ', '0000-00-00', 'acesi.asociacion@gmail.com', '0000-00-00', 2),
(830146283, 6, 'MOVITRONIC SAS', 'CALLE 134 D #  45 A-34 ', 'BOGOTA', '8135235', 2147483647, 'CAROLINA ANDREA RESTREPO LOPEZ', '0000-00-00', 'crestrepo@ejercicioenlinea.com', '0000-00-00', 2),
(900129551, 7, 'HOME TERRITORY SAS            ', 'CALLE 82 # 20-40', 'BOGOTA', '6160492', 2147483647, 'ALEJANDRA RESTREPO CADAVID', '0000-00-00', 'administracion@pro-aqua.co', '0000-00-00', 2),
(900147334, 1, 'COMERCIALIZADORA PROQUIMEL LTDA ', 'CRA 6 # 16-82 BARRIO EL LLANO', 'CARTAGO', '3176428429', 2147483647, 'DAVID VALENCIA QUINTERO', '0000-00-00', 'proquimel.cartago@gmail.com', '0000-00-00', 2),
(900303570, 0, 'SOLUCIONES ARQUITECTONICAS EJE CAFETERO SAS', 'AV 30 AGOSTO 121 -16', 'PEREIRA', '3408883', 2147483647, 'CARLOS EDUARDO DELGADO VALENCIA', '0000-00-00', 'comercialsoluciones.arq@gmail.com', '0000-00-00', 2),
(900413336, 7, 'CACHARRERIA Y VARIEDADES ZONA  SAS', 'CALLE 17 # 7 -26 PISO 2', 'PEREIRA', '3250824', 2147483647, 'EDISON JOHAN SERNA ARISTIZABAL', '0000-00-00', 'contabilidadzfpereira@gmail.com', '0000-00-00', 2),
(900418896, 2, 'FANTASIAS Y VARIEDADES YULY SAS', 'CALLE 17 # 7 -28 PISO 2', 'PEREIRA', '3332083', 2147483647, 'MARIA AMPARO ARISTIZABAL RAMIREZ', '0000-00-00', 'variedadesyulysas@hotmail.com', '0000-00-00', 2),
(900565867, 8, 'ASELOG ASESORIAS Y LOGISTICA ZF SAS', 'VIA LA VIRGINIA CAIMALITO ZONA FRANCA INTERNACIONAL', 'PEREIRA', '3158527742', 3163438, 'DORA LORENA PINZON MARTINEZ', '0000-00-00', 'gerencia@aselogzf.com', '0000-00-00', 2),
(900607305, 2, 'NUTRICION E IMAGENES DEL EJE CAFETERO SAS', 'BARRIO SAN JOSE DE LAS VILLAS CASA 10 ET 1', 'PEREIRA', '3207202075', 3207676, 'ELSY YANETH PORRAS FRANCO', '0000-00-00', 'elsyguille@hotmail.com', '0000-00-00', 2),
(900645204, 9, 'AGRUPACION ZONA FRANCA INTERNACIONAL DE PEREIRA -PH', 'VEREDA ZONA FRANCA INTERNACIONAL CORREGIMIENTO DE CAIMALITO KM 10 VIA PEREIRA', 'PEREIRA', '3343000', 2147483647, 'JULIO CESAR RAIGOSA FRANCO', '0000-00-00', 'jraigosa@zonafrancadepereira.com', '0000-00-00', 2),
(900909789, 1, 'HOME MOLINA SAS               ', 'CRA 9 # 21-72', 'PEREIRA', '3386822', 2147483647, 'DIANA MARCELA MOLINA BETANCURTH', '0000-00-00', 'dm.homemolina@gmail.com', '0000-00-00', 2),
(900910663, 2, 'HOME GOLD S A S               ', 'CALLE 136 A 58 C 67 APTO 101', 'BOGOTA', '3174396143', 3003948, 'MARIA ADELAIDA MURILLO DE LA CRUZ', '0000-00-00', 'homegoldinternational@gmail.com', '0000-00-00', 1),
(900910817, 1, 'HOME BM SAS', 'CALLE 82 # 20-40', 'BOGOTA', '3143700277', 0, 'JACQUELINE MURCIA GARCIA', '0000-00-00', 'homebmsas@gmail.com', '0000-00-00', 1),
(901062742, 0, 'MEDIUM CONSULTORIA Y PROYECTOS SAS', 'CRA 16 BIS # 9-28 BARRIO PINARES', 'PEREIRA', '3133359', 2147483647, 'JULIAN  ALBERTO VILLEGAS FLORES', '0000-00-00', 'gerencia@mediumsas.com', '0000-00-00', 1),
(901111107, 4, 'HOME LION SAS                 ', 'CALLE 48 SUR 86 60 TORRE 28 AP 4109', 'BOGOTA', '3107917855', 0, 'DAVID ENRIQUE GONZALES FERRER', '0000-00-00', 'homelionsas@gmail.com', '0000-00-00', 1),
(901124002, 6, 'HOME POWER SAS', 'CRA 7 B # 135-77 TORRE 2 APTO 607', 'BOGOTA', '3004313956', 0, 'VIVIANA MORA ACU?A', '0000-00-00', 'viv25mora@gmail.com', '0000-00-00', 1),
(901219185, 4, 'INUT SAS                      ', 'CONDOMINIO CAMPESTRE CERROS DE ALHAMBRA CASA 1A', 'MANIZALES', '3215509680', 2147483647, 'ADRIANA TORRES NATES', '0000-00-00', 'juadma@hotmail.com', '0000-00-00', 1),
(901238036, 6, 'HOME TOP SAS                  ', 'CALLE 58 # 27-29 BARRIO LOS ANDES', 'BARRANQUILLA', '3016515072', 0, 'WILMER JOSE SOBRINO CAMACHO', '0000-00-00', 'hometopsas@gmail.com', '0000-00-00', 1),
(901244483, 1, 'HOME SALUDABLE SAS', 'CALLE 10 # 32-16 APTO 501 BARRIO LA AURORA', 'PASTO', '3206872821', 0, 'PAOLA ANDREA PATI?O CABRERA', '0000-00-00', 'paopatino0311@hotmail.com', '0000-00-00', 1),
(901265186, 7, 'INNVESTPRO S.A.S.', 'CL 34 AV LA DULCERA 20 51 APTO 302 TORRE 1', 'PEREIRA', '3002031747', 2147483647, 'ANDRES FELIPE BETANCURT GARCIA', '0000-00-00', 'director1.pro@gmail.com', '0000-00-00', 2),
(901278857, 7, 'HOME ETERNITY SAS', 'CALLE 82 # 20-40', 'BOGOTA', '3227539008', 6160492, 'OLGA JEANNETTY BARRIO JIMENEZ', '0000-00-00', 'hometernitysas@gmail.com', '0000-00-00', 1),
(901291880, 0, 'PINILLA OBREGON SAS           ', 'CALLE 3 A # 20 -70 APTO 702 ED PINAMAR', 'PEREIRA', '3163734', 2147483647, 'MARIA TERESA OBREGON ROJAS', '0000-00-00', 'mariatobregon76@hotmail.com', '0000-00-00', 1),
(901344164, 4, 'HOME JIREHS SAS', 'CALLE 113 # 50-27', 'BOGOTA', '3012431782', 0, 'SABRINA RANGEL CRESPO', '0000-00-00', 'homejirehssas@gmaail.com', '0000-00-00', 1),
(901386604, 3, 'HOME INNOVA SAS', 'CALLE 82 # 20-40', 'BOGOTA', '3203624300', 0, 'JUAN DAVID AVILA RODRIGUEZ', '0000-00-00', 'jdavila_@outlook.es', '0000-00-00', 1),
(901429320, 3, 'HOME GLOW SAS', 'CRA 9 # 21-72', 'PEREIRA', '3015247470', 2147483647, 'DANIELA GARCIA URIBE', '0000-00-00', 'homeglowsas@gmail.com', '0000-00-00', 1),
(901480830, 3, 'HOME FULL SAS', 'CALLE 10 NORTE 14-57', 'ARMENIA', '3106159739', 0, 'LUIS EDUARDO GONZALES VERA', '0000-00-00', 'homefullsas@gmail.com', '0000-00-00', 1),
(901487429, 4, 'HOME LA SABANA SAS', 'CALLE 82 # 20-40', 'BOGOTA', '3157079015', 0, 'CARLOS ALEXANDER HERRERA', '0000-00-00', 'cherrerahomeprestigesas@gmail.com', '0000-00-00', 1),
(901503664, 8, 'DU BLE SAS', 'CRA 9 # 8 -15 LOTE 3  ZONA INDUSTRIAL LA BADEA ', 'DOSQUEBRADAS', '3155300339', 0, 'JACQUELINE SALAZAR PEREZ', '0000-00-00', 'gerencia@loly.com.co', '0000-00-00', 1),
(901503847, 9, 'HOME VICTORY ED SAS', 'CRA 2 # 32-49 TORRE 1 OF 206 ED QUINTA SANTANA', 'TUNJA', '3138499755', 2147483647, 'EDGAR ALFONSO FUENTES FERNANDEZ', '0000-00-00', 'homevictoryed@gmail.com', '0000-00-00', 1),
(901536337, 6, 'SYNERGIA OCUPACIONAL SAS', 'CALLE 11 #12B - 26 CIRCUNVALAR', 'PEREIRA', '3113894162', 2147483647, 'JAQUELINE CRISTANCHO PULIDO', '0000-00-00', 'macrisaralda@gmail.com', '0000-00-00', 1),
(901552905, 7, 'HOME LIBERTY SAS', 'CALLE 113 # 50-27', 'BOGOTA', '3106590230', 0, 'DEIVIS KARINA GALVIS CAMARGO', '0000-00-00', 'homelibertysas@gmail.com', '0000-00-00', 1),
(901561066, 0, 'HOME AMATISTA SAS', 'CRA 49 B # 93-38', 'BOGOTA', '3012403325', 0, 'ENNYS MAIRYN QUIROGA HERRERA', '0000-00-00', 'homeamatista.eq@gmail.com', '0000-00-00', 1),
(901562973, 0, 'HOME ANGELS SAS', 'CRA 49 B # 93-38', 'BOGOTA', '3222167675', 0, 'DANIRE MATA TOVAR', '0000-00-00', 'homeangels25@gmail.com', '0000-00-00', 1),
(901671111, 6, 'HOME EXPERIENCE SAS', 'CALLE 82 # 20-40', 'BOGOTA', '3197272378', 0, 'JULIANA ANDREA SERNA DEVIA', '0000-00-00', 'gerenciahomeexperience@gmail.com', '0000-00-00', 1),
(901694205, 9, 'HOME ASSA SAS', 'CRA 20 # 21- 29 APTO 202 BARRIO PROVIDENCIA', 'PEREIRA', '3135125392', 0, 'RAY ASHAEL APONTE PULGAR', '0000-00-00', 'apontepulgarray@gmail.com', '0000-00-00', 1),
(901779441, 7, 'HOME SMART BY POWER SAS', 'CL 82 # 20-40', 'BOGOTA', '3104671341', 0, 'DIEGO FERNANDO HENAO BELTRAN', '0000-00-00', 'homesmartbypower@gmail.com', '0000-00-00', 1),
(901796184, 0, 'GARCIA CIFUENTES MEDICINA DEL TRABAJO SAS', 'CR 5 18 -33 CS 601', 'PEREIRA', '3006545846', 3469000, 'BEATRIZ ELENA GARCIA CARDONA', '0000-00-00', 'garciacifuentessst@gmail.com', '0000-00-00', 1),
(901806453, 1, 'PEOPLE MOVIL S.A.S.', 'CR 7 #17-21 PASAJE COMERCIAL ZONA FRANCA', 'PEREIRA', '3183256440', 0, 'JAIME ALBERTO CASTA?O QUINTERO', '0000-00-00', '', '0000-00-00', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `eventos`
--

CREATE TABLE `eventos` (
  `id` int(11) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `start2` datetime DEFAULT NULL,
  `end2` datetime DEFAULT NULL,
  `background_color` varchar(7) DEFAULT NULL,
  `border_color` varchar(7) DEFAULT NULL,
  `text_color` varchar(7) DEFAULT NULL,
  `allDay` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `eventos`
--

INSERT INTO `eventos` (`id`, `title`, `start2`, `end2`, `background_color`, `border_color`, `text_color`, `allDay`) VALUES
(32, 'Empresa 5', '2024-10-26 05:00:00', '0000-00-00 00:00:00', 'rgb(220', 'rgb(220', 'rgb(255', 1),
(38, 'Empresa 4', '2024-09-29 05:00:00', '0000-00-00 00:00:00', 'rgb(0, ', 'rgb(0, ', 'rgb(255', 1),
(40, 'Empresa 4', '2024-09-29 05:00:00', '0000-00-00 00:00:00', 'rgb(0, ', 'rgb(0, ', 'rgb(255', 1),
(41, 'Empresa 2', '2024-09-29 05:00:00', '0000-00-00 00:00:00', 'rgb(255', 'rgb(255', 'rgb(31,', 1),
(42, 'Empresa 1', '2024-09-29 05:00:00', '0000-00-00 00:00:00', 'rgb(40,', 'rgb(40,', 'rgb(255', 1),
(43, 'Empresa 4', '2024-09-30 05:00:00', '0000-00-00 00:00:00', 'rgb(0, ', 'rgb(0, ', 'rgb(255', 1),
(44, 'Empresa 3', '2024-10-01 05:00:00', '0000-00-00 00:00:00', 'rgb(23,', 'rgb(23,', 'rgb(255', 1),
(45, 'Empresa 5', '2024-10-01 05:00:00', '0000-00-00 00:00:00', 'rgb(220', 'rgb(220', 'rgb(255', 1),
(46, 'Empresa 2', '2024-09-30 05:00:00', '0000-00-00 00:00:00', 'rgb(255', 'rgb(255', 'rgb(31,', 1),
(47, 'Empresa 1', '2024-10-03 05:00:00', '0000-00-00 00:00:00', 'rgb(40,', 'rgb(40,', 'rgb(255', 1),
(48, 'Empresa 4', '2024-10-02 05:00:00', '0000-00-00 00:00:00', 'rgb(0, ', 'rgb(0, ', 'rgb(255', 1),
(49, 'Empresa 5', '2024-10-08 05:00:00', '0000-00-00 00:00:00', 'rgb(220', 'rgb(220', 'rgb(255', 1),
(50, 'Empresa 4', '2024-10-09 05:00:00', '0000-00-00 00:00:00', 'rgb(0, ', 'rgb(0, ', 'rgb(255', 1),
(51, 'Empresa 3', '2024-10-08 05:00:00', '0000-00-00 00:00:00', 'rgb(23,', 'rgb(23,', 'rgb(255', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `perfiles`
--

CREATE TABLE `perfiles` (
  `perfil` int(11) NOT NULL,
  `descripcion` varchar(50) DEFAULT NULL,
  `ModuloTI` enum('off','on') DEFAULT NULL,
  `AdminUsuarios` enum('off','on') DEFAULT NULL,
  `VerUsuarios` enum('off','on') DEFAULT NULL,
  `EstadoUsuarios` enum('off','on') DEFAULT NULL,
  `AdminPerfiles` enum('off','on') DEFAULT NULL,
  `AdminMantenimientos` enum('off','on') DEFAULT NULL,
  `InventarioEquipos` enum('off','on') DEFAULT NULL,
  `AdminSoporte` enum('off','on') DEFAULT NULL,
  `SolicitudSoporte` enum('off','on') DEFAULT NULL,
  `ConsultarSoporte` enum('off','on') DEFAULT NULL,
  `AdminAcpm` enum('off','on') DEFAULT NULL,
  `CrearAcpm` enum('on','off') DEFAULT NULL,
  `ConsultarAcpm` enum('off','on') DEFAULT NULL,
  `EditarAcpm` enum('off','on') DEFAULT NULL,
  `EliminarAcpm` enum('off','on') DEFAULT NULL,
  `AsignarActividades` enum('off','on') DEFAULT NULL,
  `ResponderActividades` enum('off','on') DEFAULT NULL,
  `VerActividades` enum('on','off') DEFAULT NULL,
  `EditarActividades` enum('off','on') DEFAULT NULL,
  `EliminarActividades` enum('off','on') DEFAULT NULL,
  `ArchivosSadoc` enum('off','on') DEFAULT NULL,
  `CarpetasSadoc` enum('off','on') DEFAULT NULL,
  `EliminarSadoc` enum('off','on') DEFAULT NULL,
  `SolicitudCodificacion` enum('off','on') DEFAULT NULL,
  `ResponderCodificacion` enum('off','on') DEFAULT NULL,
  `ConsultarCodificacion` enum('off','on') DEFAULT NULL,
  `EditarCodificacion` enum('off','on') DEFAULT NULL,
  `EliminarCodificacion` enum('off','on') DEFAULT NULL,
  `CrearOrden` enum('off','on') DEFAULT NULL,
  `EditarOrden` enum('off','on') DEFAULT NULL,
  `EliminarOrden` enum('off','on') DEFAULT NULL,
  `ConsultarOrden` enum('off','on') DEFAULT NULL,
  `AdminProveedorLider` enum('off','on') DEFAULT NULL,
  `AdminProveedorCT` enum('off','on') DEFAULT NULL,
  `AprobacionGH` enum('off','on') DEFAULT NULL,
  `AprobacionGR` enum('off','on') DEFAULT NULL,
  `AprobacionCT` enum('off','on') DEFAULT NULL,
  `CrearBascula` enum('off','on') DEFAULT NULL,
  `ConsultarBascula` enum('off','on') DEFAULT NULL,
  `EditarBascula` enum('off','on') DEFAULT NULL,
  `BasculaProceso` enum('off','on') DEFAULT NULL,
  `BasculaFact` enum('off','on') DEFAULT NULL,
  `ValorPesaje` enum('off','on') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `perfiles`
--

INSERT INTO `perfiles` (`perfil`, `descripcion`, `ModuloTI`, `AdminUsuarios`, `VerUsuarios`, `EstadoUsuarios`, `AdminPerfiles`, `AdminMantenimientos`, `InventarioEquipos`, `AdminSoporte`, `SolicitudSoporte`, `ConsultarSoporte`, `AdminAcpm`, `CrearAcpm`, `ConsultarAcpm`, `EditarAcpm`, `EliminarAcpm`, `AsignarActividades`, `ResponderActividades`, `VerActividades`, `EditarActividades`, `EliminarActividades`, `ArchivosSadoc`, `CarpetasSadoc`, `EliminarSadoc`, `SolicitudCodificacion`, `ResponderCodificacion`, `ConsultarCodificacion`, `EditarCodificacion`, `EliminarCodificacion`, `CrearOrden`, `EditarOrden`, `EliminarOrden`, `ConsultarOrden`, `AdminProveedorLider`, `AdminProveedorCT`, `AprobacionGH`, `AprobacionGR`, `AprobacionCT`, `CrearBascula`, `ConsultarBascula`, `EditarBascula`, `BasculaProceso`, `BasculaFact`, `ValorPesaje`) VALUES
(56, 'MELISSA', 'off', 'off', 'off', 'off', 'off', 'off', 'off', 'off', 'off', 'off', 'off', 'off', 'off', 'off', 'off', 'off', 'off', 'off', 'off', 'off', 'off', 'off', 'off', 'off', 'off', 'off', 'off', 'off', 'off', 'off', 'off', 'off', 'off', 'off', 'off', 'off', 'off', 'off', 'off', 'off', 'off', 'off', 'off'),
(0, 'sdsd', 'on', 'on', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(0, 'nuevo', NULL, 'on', 'on', 'on', NULL, NULL, NULL, 'on', 'on', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

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
(1, 'Administrador', '', 'admin', '$2a$07$asxx54ahjppf45sd87a5auXBm1Vr2M1NV5t/zNQtGHGpS5fFirrbG', 1, 'vistas/img/usuarios/admin/489.jpg', 1, 2, 2, '2024-10-26 11:08:04', '2020-04-28 06:20:56', 2),
(2, 'vendedor', '', 'vendedor', '$2a$07$asxx54ahjppf45sd87a5auF3SxTPxKrykQWP2opioJ/PI/QjcniEW', 4, '', 1, 2, 2, '2022-08-02 14:02:24', '2022-08-03 02:07:21', NULL),
(3, 'vendedor', '', 'vendedor', '$2a$07$asxx54ahjppf45sd87a5auF3SxTPxKrykQWP2opioJ/PI/QjcniEW', 4, '', 1, 2, 2, '2022-08-02 14:02:24', '2022-08-03 02:07:21', NULL);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `archivos_evaluacion`
--
ALTER TABLE `archivos_evaluacion`
  ADD PRIMARY KEY (`cod_archivo_e`);

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
-- Indices de la tabla `eventos`
--
ALTER TABLE `eventos`
  ADD PRIMARY KEY (`id`);

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
-- AUTO_INCREMENT de la tabla `archivos_evaluacion`
--
ALTER TABLE `archivos_evaluacion`
  MODIFY `cod_archivo_e` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `clases`
--
ALTER TABLE `clases`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT de la tabla `eventos`
--
ALTER TABLE `eventos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `datosempresa`
--
ALTER TABLE `datosempresa`
  ADD CONSTRAINT `datosempresa_ibfk_1` FOREIGN KEY (`id_usuario_fk`) REFERENCES `usuarios` (`id`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
