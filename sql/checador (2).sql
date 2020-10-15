-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 13-10-2020 a las 01:05:51
-- Versión del servidor: 10.4.13-MariaDB
-- Versión de PHP: 7.4.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `checador`
--
CREATE DATABASE IF NOT EXISTS `checador` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `checador`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `asistencia`
--

CREATE TABLE `asistencia` (
  `id` int(10) NOT NULL,
  `id_trabajador` int(11) DEFAULT NULL,
  `hora_entrada` time DEFAULT NULL,
  `hora_comida_salida` time DEFAULT NULL,
  `hora_comida_entrada` time DEFAULT NULL,
  `hora_salida` time DEFAULT NULL,
  `fecha` date DEFAULT NULL,
  `id_incidencia` tinyint(1) DEFAULT NULL,
  `estado_trabajo` tinyint(1) DEFAULT NULL,
  `horas_trabajadas` time DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `asistencia`
--

INSERT INTO `asistencia` (`id`, `id_trabajador`, `hora_entrada`, `hora_comida_salida`, `hora_comida_entrada`, `hora_salida`, `fecha`, `id_incidencia`, `estado_trabajo`, `horas_trabajadas`) VALUES
(1, 2, '16:08:13', '16:08:34', NULL, NULL, '2020-10-10', NULL, 2, NULL),
(2, 3, '16:15:46', NULL, NULL, NULL, '2020-10-10', 1, 1, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estatus`
--

CREATE TABLE `estatus` (
  `id` int(1) NOT NULL,
  `mensaje` varchar(50) DEFAULT NULL,
  `trabajador` varchar(75) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `estatus`
--

INSERT INTO `estatus` (`id`, `mensaje`, `trabajador`) VALUES
(1, 'Registrando H. Entrada', 'Juan Perez');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `new`
--

CREATE TABLE `new` (
  `id` int(1) NOT NULL,
  `tarjeta` varchar(16) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `new`
--

INSERT INTO `new` (`id`, `tarjeta`) VALUES
(1, '9876');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reglas_incidencias`
--

CREATE TABLE `reglas_incidencias` (
  `id_incidencia` int(11) NOT NULL,
  `tolerancia` time DEFAULT NULL,
  `retardo` time DEFAULT NULL,
  `falta` time DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `reglas_incidencias`
--

INSERT INTO `reglas_incidencias` (`id_incidencia`, `tolerancia`, `retardo`, `falta`) VALUES
(1, '00:05:00', '00:15:00', '00:30:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_incidencias`
--

CREATE TABLE `tipo_incidencias` (
  `id_incidencia` int(11) NOT NULL,
  `nombre` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `tipo_incidencias`
--

INSERT INTO `tipo_incidencias` (`id_incidencia`, `nombre`) VALUES
(1, 'a tiempo'),
(2, 'con retardo'),
(3, 'con falta');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `trabajadores`
--

CREATE TABLE `trabajadores` (
  `id` int(11) NOT NULL,
  `nombre` varchar(50) DEFAULT NULL,
  `direccion` varchar(75) DEFAULT NULL,
  `telefono` varchar(10) DEFAULT NULL,
  `genero` varchar(10) DEFAULT NULL,
  `estado_civil` varchar(10) DEFAULT NULL,
  `departamento` varchar(20) DEFAULT NULL,
  `puesto` varchar(45) DEFAULT NULL,
  `sueldo` double DEFAULT NULL,
  `hora_llegada` time DEFAULT NULL,
  `hora_salida` time DEFAULT NULL,
  `tarjeta` varchar(16) DEFAULT NULL,
  `fecha_ingreso` date DEFAULT NULL,
  `fecha_nacimiento` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `trabajadores`
--

INSERT INTO `trabajadores` (`id`, `nombre`, `direccion`, `telefono`, `genero`, `estado_civil`, `departamento`, `puesto`, `sueldo`, `hora_llegada`, `hora_salida`, `tarjeta`, `fecha_ingreso`, `fecha_nacimiento`) VALUES
(2, 'Eduardo Gomez', 'Palmillas City', '4271234567', 'Hombre', 'Soltero(a)', 'Sistemas', 'Admin', 15000, '15:40:00', '02:30:00', 'sda1sda321', '2020-06-11', '2000-01-01'),
(3, 'Pacheco cara floja', 'asdm', '5464654350', 'Hombre', 'Soltero(a)', 'Administracion', 'contador', 10000, '09:00:00', '17:30:00', 'tarjeta1', '2020-09-29', '2000-01-01');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `unidades`
--

CREATE TABLE `unidades` (
  `id` int(5) NOT NULL,
  `modelo` varchar(25) DEFAULT NULL,
  `placas` varchar(10) DEFAULT NULL,
  `odometro_inicial` int(7) DEFAULT NULL,
  `servicio_cada` int(5) DEFAULT NULL,
  `tarjeta_circulacion` varchar(20) DEFAULT NULL,
  `poliza` varchar(20) DEFAULT NULL,
  `fecha_compra` date DEFAULT NULL,
  `notas` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `unidades`
--

INSERT INTO `unidades` (`id`, `modelo`, `placas`, `odometro_inicial`, `servicio_cada`, `tarjeta_circulacion`, `poliza`, `fecha_compra`, `notas`) VALUES
(1, 'NISSAN NP300 ESTACAS', 'ABC-1234', 100, 5000, 'TJA567', '0123456789', '2010-01-19', ''),
(2, 'modelo', 'plca', 1000, 500, 'tarjeta', 'poliza', '2020-10-06', 'unidad de prueba');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `viajes`
--

CREATE TABLE `viajes` (
  `id` int(10) NOT NULL,
  `hora1` varchar(5) DEFAULT NULL,
  `fecha1` date DEFAULT NULL,
  `unidad` varchar(25) NOT NULL,
  `chofer` varchar(50) DEFAULT NULL,
  `uso` varchar(50) DEFAULT NULL,
  `odometro1` int(7) DEFAULT NULL,
  `odometro2` int(7) DEFAULT NULL,
  `hora2` varchar(5) DEFAULT NULL,
  `fecha2` date DEFAULT NULL,
  `kms` int(7) DEFAULT NULL,
  `notas` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `viajes`
--

INSERT INTO `viajes` (`id`, `hora1`, `fecha1`, `unidad`, `chofer`, `uso`, `odometro1`, `odometro2`, `hora2`, `fecha2`, `kms`, `notas`) VALUES
(1, '12:30', '2020-05-18', 'NISSAN NP300 ESTACAS', 'Juan Perez', 'REPARTO DE MATERIAL', 120, 170, '16:45', '2020-05-18', 50, 'hizo una parada para cargar gasolina y revisar llantas');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `asistencia`
--
ALTER TABLE `asistencia`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `estatus`
--
ALTER TABLE `estatus`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `new`
--
ALTER TABLE `new`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `reglas_incidencias`
--
ALTER TABLE `reglas_incidencias`
  ADD PRIMARY KEY (`id_incidencia`);

--
-- Indices de la tabla `tipo_incidencias`
--
ALTER TABLE `tipo_incidencias`
  ADD PRIMARY KEY (`id_incidencia`);

--
-- Indices de la tabla `trabajadores`
--
ALTER TABLE `trabajadores`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `unidades`
--
ALTER TABLE `unidades`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `viajes`
--
ALTER TABLE `viajes`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `asistencia`
--
ALTER TABLE `asistencia`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `estatus`
--
ALTER TABLE `estatus`
  MODIFY `id` int(1) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `new`
--
ALTER TABLE `new`
  MODIFY `id` int(1) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `reglas_incidencias`
--
ALTER TABLE `reglas_incidencias`
  MODIFY `id_incidencia` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `tipo_incidencias`
--
ALTER TABLE `tipo_incidencias`
  MODIFY `id_incidencia` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `trabajadores`
--
ALTER TABLE `trabajadores`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `unidades`
--
ALTER TABLE `unidades`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `viajes`
--
ALTER TABLE `viajes`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
