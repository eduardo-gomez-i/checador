-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 25-09-2020 a las 01:22:56
-- Versión del servidor: 10.4.11-MariaDB
-- Versión de PHP: 7.4.4

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

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `asistencia`
--

CREATE TABLE `asistencia` (
  `id` int(10) NOT NULL,
  `nombre` varchar(35) DEFAULT NULL,
  `depto` varchar(35) DEFAULT NULL,
  `hentrada` varchar(5) DEFAULT NULL,
  `hscomida` varchar(5) DEFAULT NULL,
  `hrcomida` varchar(5) DEFAULT NULL,
  `hsalida` varchar(5) DEFAULT NULL,
  `tarjeta` varchar(16) DEFAULT NULL,
  `fecha` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `asistencia`
--

INSERT INTO `asistencia` (`id`, `nombre`, `depto`, `hentrada`, `hscomida`, `hrcomida`, `hsalida`, `tarjeta`, `fecha`) VALUES
(1, 'Juan Perez', 'ADMINISTRACION', '23:56', NULL, NULL, NULL, '9876', '2020-05-18');

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
-- Estructura de tabla para la tabla `trabajadores`
--

CREATE TABLE `trabajadores` (
  `id` int(11) NOT NULL,
  `nombre` varchar(50) DEFAULT NULL,
  `direccion` varchar(75) DEFAULT NULL,
  `telefono` varchar(10) DEFAULT NULL,
  `genero` varchar(10) DEFAULT NULL,
  `edocivil` varchar(10) DEFAULT NULL,
  `depto` varchar(20) DEFAULT NULL,
  `sueldo` int(5) DEFAULT NULL,
  `tarjeta` varchar(16) DEFAULT NULL,
  `f_ingreso` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `trabajadores`
--

INSERT INTO `trabajadores` (`id`, `nombre`, `direccion`, `telefono`, `genero`, `edocivil`, `depto`, `sueldo`, `tarjeta`, `f_ingreso`) VALUES
(1, 'Juan Perez', 'Domicilio conocido', '5566778899', 'HOMBRE', 'SOLTERO', 'ADMINISTRACION', 9600, '9876', '2020-05-18');

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
  `poliza` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `unidades`
--

INSERT INTO `unidades` (`id`, `modelo`, `placas`, `odometro_inicial`, `servicio_cada`, `tarjeta_circulacion`, `poliza`) VALUES
(1, 'NISSAN NP300 ESTACAS', 'ABC-1234', 100, 5000, 'TJA567', '0123456789');

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
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

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
-- AUTO_INCREMENT de la tabla `trabajadores`
--
ALTER TABLE `trabajadores`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `unidades`
--
ALTER TABLE `unidades`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `viajes`
--
ALTER TABLE `viajes`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
