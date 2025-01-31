-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 31-01-2025 a las 21:59:21
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

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
(1, 900910663, 1, 'vistas/files/EMPRESAS/Nuevo documento (12)[2].docx', NULL, 'Excel', 'Inactivo', '2024-12-04'),
(2, 901238036, 10, 'vistas/files/EMPRESAS/Nuevo documento (12)[2].docx', NULL, 'Excel', 'Inactivo', '2024-11-19'),
(3, 900910663, 1, 'vistas/files/EMPRESAS/Nuevo documento (12)[2].docx', NULL, 'Word', 'Inactivo', '2024-11-19'),
(4, 900910663, 1, 'vistas/files/EMPRESAS/Nuevo documento (12)[2].pdf', NULL, 'Pdf', 'Inactivo', '2024-11-27'),
(5, 900910663, 10, 'vistas/files/EMPRESAS/Anexo 3 - Ejercicio Tarea 3.pdf', NULL, 'Pdf', 'Inactivo', '2024-11-19'),
(6, 900910817, 10, 'vistas/files/EMPRESAS/Nuevo documento (12)[2].pdf', NULL, 'Pdf', 'Activo', NULL),
(7, 900910663, 1, 'vistas/files/EMPRESAS/Nuevo documento (12)[2].pdf', NULL, 'Pdf', 'Inactivo', '2024-11-29'),
(8, 900909789, 10, 'vistas/files/EMPRESAS/PROGRAMACIÓN AUXILIAR TI 25-10-2024.xlsx', NULL, 'Excel', 'Activo', NULL),
(9, 900910663, 10, 'vistas/files/EMPRESAS/Nuevo documento (12)[2].docx', 'ESTADOS FINANCIEROS', 'Excel', 'Activo', NULL),
(10, 900910817, 10, 'vistas/files/EMPRESAS/Nuevo documento (12)[2].docx', 'ju', 'Excel', 'Activo', NULL),
(11, 900910663, 10, 'vistas/files/EMPRESAS/Nuevo documento (12)[2].docx', 'lk', 'Excel', 'Activo', NULL);

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
(10, 'VENCIMIENTOS');

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
  `id_usuario_fk` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `datosempresa`
--

INSERT INTO `datosempresa` (`id`, `dv`, `NombreEmpresa`, `DireccionEmpresa`, `ciudad`, `Telefono`, `telefono2`, `nombre_rep_legal`, `fecha_nap_red_legal`, `correoElectronico`, `fecha_inicio_contrato`, `id_usuario_fk`) VALUES
(816008012, 5, 'C M G  IMPORTACIONES SAS      ', 'CRA 14 # 103-61 BODEGA 14 TIERRA BUENA', 'PEREIRA', '3155545', 2147483647, 'LUIS FERNANDO GUTIERRES BRAVO', '0000-00-00', 'cmgautopartes@etp.net.co', '0000-00-00', 3),
(830106788, 2, 'ASOCIACION COLOMBIANA DE EMPRESAS SOCIALES DEL ESTADO Y HOSPITALES PUBLICOS ACESI', 'CL 84 CRA 23 MZ 12 CA 24 ESQUINA BARRIO CORRALES', 'PEREIRA', '3272974', 2147483647, 'OLGA LUCIA ZULUAGA  RODRIGUEZ', '0000-00-00', 'acesi.asociacion@gmail.com', '0000-00-00', 1),
(830146283, 6, 'MOVITRONIC SAS', 'CALLE 134 D #  45 A-34 ', 'BOGOTA', '8135235', 2147483647, 'CAROLINA ANDREA RESTREPO LOPEZ', '0000-00-00', 'crestrepo@ejercicioenlinea.com', '0000-00-00', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `eventos`
--

CREATE TABLE `eventos` (
  `id` int(11) NOT NULL,
  `title` int(100) NOT NULL,
  `start2` datetime NOT NULL,
  `end2` datetime DEFAULT NULL,
  `background_color` varchar(7) NOT NULL,
  `border_color` varchar(7) NOT NULL,
  `text_color` varchar(7) NOT NULL,
  `allDay` tinyint(1) DEFAULT 0,
  `id_usuario_fk` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `eventos`
--

INSERT INTO `eventos` (`id`, `title`, `start2`, `end2`, `background_color`, `border_color`, `text_color`, `allDay`, `id_usuario_fk`) VALUES
(24, 830106788, '2025-01-29 09:00:00', '2025-01-29 10:00:00', '#007bff', '#007bff', '#fff', 0, 1),
(25, 816008012, '2025-01-30 08:00:00', '2025-01-31 10:00:00', '#007bff', '#007bff', '#fff', 0, 3);

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
  `nombre` text DEFAULT NULL,
  `apellidos_usuario` varchar(100) DEFAULT NULL,
  `correo_usuario` varchar(100) DEFAULT NULL,
  `password` text DEFAULT NULL,
  `perfil` int(11) DEFAULT NULL,
  `firma` text DEFAULT NULL,
  `estado` int(11) DEFAULT NULL,
  `ultimo_login` datetime DEFAULT NULL,
  `fecha` timestamp NULL DEFAULT current_timestamp(),
  `intentos` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `nombre`, `apellidos_usuario`, `correo_usuario`, `password`, `perfil`, `firma`, `estado`, `ultimo_login`, `fecha`, `intentos`) VALUES
(1, 'Administrador', '', 'admin', '$2a$07$asxx54ahjppf45sd87a5auXBm1Vr2M1NV5t/zNQtGHGpS5fFirrbG', 1, 'vistas/img/usuarios/admin/489.jpg', 1, '2025-01-31 15:55:38', '2020-04-28 06:20:56', 2),
(3, 'vendedor', '', 'vendedor', '$2a$07$asxx54ahjppf45sd87a5auXBm1Vr2M1NV5t/zNQtGHGpS5fFirrbG', 4, '', 1, '2025-01-14 15:09:11', '2022-08-03 02:07:21', NULL);

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
-- Indices de la tabla `eventos`
--
ALTER TABLE `eventos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `title` (`title`),
  ADD KEY `id_usuario_fk` (`id_usuario_fk`);

--
-- Indices de la tabla `perfiles`
--
ALTER TABLE `perfiles`
  ADD PRIMARY KEY (`perfil`);

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
  MODIFY `id_archivos` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `archivos_evaluacion`
--
ALTER TABLE `archivos_evaluacion`
  MODIFY `cod_archivo_e` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `categorias`
--
ALTER TABLE `categorias`
  MODIFY `id_categoria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `clases`
--
ALTER TABLE `clases`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT de la tabla `eventos`
--
ALTER TABLE `eventos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT de la tabla `perfiles`
--
ALTER TABLE `perfiles`
  MODIFY `perfil` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

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
-- Filtros para la tabla `datosempresa`
--
ALTER TABLE `datosempresa`
  ADD CONSTRAINT `datosempresa_ibfk_1` FOREIGN KEY (`id_usuario_fk`) REFERENCES `usuarios` (`id`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
