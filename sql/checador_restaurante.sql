-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 17-12-2020 a las 18:45:48
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
  `actualizado` timestamp(3) NOT NULL DEFAULT current_timestamp(3) ON UPDATE current_timestamp(3)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `asistencia`
--
-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `avisos`
--

CREATE TABLE `avisos` (
  `idavisos` int(11) NOT NULL,
  `texto` varchar(45) DEFAULT NULL,
  `leido` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `avisos`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `departamentos`
--

CREATE TABLE `departamentos` (
  `id` int(11) NOT NULL,
  `departamento` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `departamentos`
--

-----------------------------------------------------

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


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `events`
--

CREATE TABLE `events` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `color` varchar(7) DEFAULT NULL,
  `start` datetime NOT NULL,
  `end` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `events`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `historial_unidad`
--

CREATE TABLE `historial_unidad` (
  `id` int(11) NOT NULL,
  `id_unidad` int(11) NOT NULL,
  `id_trabajador` int(11) NOT NULL,
  `kilometraje_inicial` double NOT NULL,
  `kilometraje_final` double NOT NULL,
  `gasolina_inicial` int(11) NOT NULL,
  `gasolina_final` int(11) NOT NULL,
  `fecha_salida` datetime NOT NULL,
  `fecha_entrada` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `horarios_trabajadores`
--

CREATE TABLE `horarios_trabajadores` (
  `id` int(11) NOT NULL,
  `id_trabajador` int(11) NOT NULL,
  `dia_semana` varchar(45) NOT NULL,
  `hora_llegada` time DEFAULT NULL,
  `hora_comida_salida` time DEFAULT NULL,
  `hora_comida_llegada` time DEFAULT NULL,
  `hora_salida` time DEFAULT NULL,
  `estado` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `horarios_trabajadores`
--


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `new`
--

CREATE TABLE `new` (
  `id` int(1) NOT NULL,
  `tarjeta` varchar(16) DEFAULT NULL,
  `conocida` varchar(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `new`
--


-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `nomina`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `nomina` (
`nombre` varchar(50)
,`departamento` varchar(60)
,`dias_trabajados` bigint(21)
,`horas_trabajadas` time
,`sueldo` double
);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `permisos`
--

CREATE TABLE `permisos` (
  `id` int(11) NOT NULL,
  `id_trabajador` int(11) NOT NULL,
  `razon` varchar(45) NOT NULL,
  `fecha` date NOT NULL,
  `tipo` varchar(45) NOT NULL,
  `descuento` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `permisos`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `semana`
--

CREATE TABLE `semana` (
  `id` int(11) NOT NULL,
  `dia` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `semana`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_incidencias`
--

CREATE TABLE `tipo_incidencias` (
  `id_incidencia` int(11) NOT NULL,
  `nombre` varchar(45) NOT NULL,
  `tiempo` int(11) NOT NULL,
  `descuento` double NOT NULL,
  `id_departamento` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `tipo_incidencias`
--

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
  `id_departamento` int(11) DEFAULT NULL,
  `puesto` varchar(45) DEFAULT NULL,
  `tipo_pago` varchar(45) DEFAULT NULL,
  `sueldo` decimal(8,2) DEFAULT NULL,
  `tarjeta` varchar(32) DEFAULT NULL,
  `fecha_ingreso` date DEFAULT NULL,
  `fecha_nacimiento` date DEFAULT NULL,
  `id_temporal` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `trabajadores`
--

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
  `notas` varchar(45) DEFAULT NULL,
  `estado_unidad` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `unidades`
--

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

-- --------------------------------------------------------

--
-- Estructura para la vista `nomina`
--
DROP TABLE IF EXISTS `nomina`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `nomina`  AS  select `trabajadores`.`nombre` AS `nombre`,`departamentos`.`departamento` AS `departamento`,count(`asistencia`.`fecha`) AS `dias_trabajados`,sec_to_time(sum(time_to_sec(timediff(`asistencia`.`hora_salida`,`asistencia`.`hora_entrada`)))) AS `horas_trabajadas`,`trabajadores`.`sueldo` - sum(`tipo_incidencias`.`descuento`) AS `sueldo` from (((`asistencia` left join `trabajadores` on(`asistencia`.`id_trabajador` = `trabajadores`.`id`)) left join `departamentos` on(`departamentos`.`id` = `trabajadores`.`id_departamento`)) left join `tipo_incidencias` on(`tipo_incidencias`.`id_incidencia` = `asistencia`.`id_incidencia`)) where week(`asistencia`.`fecha`,3) >= week(current_timestamp(),3) group by `asistencia`.`id_trabajador` ;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `asistencia`
--
ALTER TABLE `asistencia`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `avisos`
--
ALTER TABLE `avisos`
  ADD PRIMARY KEY (`idavisos`);

--
-- Indices de la tabla `departamentos`
--
ALTER TABLE `departamentos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `estatus`
--
ALTER TABLE `estatus`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `historial_unidad`
--
ALTER TABLE `historial_unidad`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `horarios_trabajadores`
--
ALTER TABLE `horarios_trabajadores`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `new`
--
ALTER TABLE `new`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `permisos`
--
ALTER TABLE `permisos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `semana`
--
ALTER TABLE `semana`
  ADD PRIMARY KEY (`id`);

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
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=163;

--
-- AUTO_INCREMENT de la tabla `avisos`
--
ALTER TABLE `avisos`
  MODIFY `idavisos` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `departamentos`
--
ALTER TABLE `departamentos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `estatus`
--
ALTER TABLE `estatus`
  MODIFY `id` int(1) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `events`
--
ALTER TABLE `events`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `historial_unidad`
--
ALTER TABLE `historial_unidad`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `horarios_trabajadores`
--
ALTER TABLE `horarios_trabajadores`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=260;

--
-- AUTO_INCREMENT de la tabla `new`
--
ALTER TABLE `new`
  MODIFY `id` int(1) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41076002;

--
-- AUTO_INCREMENT de la tabla `permisos`
--
ALTER TABLE `permisos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `semana`
--
ALTER TABLE `semana`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `tipo_incidencias`
--
ALTER TABLE `tipo_incidencias`
  MODIFY `id_incidencia` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `trabajadores`
--
ALTER TABLE `trabajadores`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

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
