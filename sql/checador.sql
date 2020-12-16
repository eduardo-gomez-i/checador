-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 12-12-2020 a las 01:00:00
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

INSERT INTO `asistencia` (`id`, `id_trabajador`, `hora_entrada`, `hora_comida_salida`, `hora_comida_entrada`, `hora_salida`, `fecha`, `id_incidencia`, `estado_trabajo`, `actualizado`) VALUES
(1, 2, '08:00:00', '16:54:26', NULL, NULL, '2020-12-11', NULL, 2, '2020-12-11 22:55:17.207'),
(2, 3, '16:54:07', '17:06:50', '18:40:09', NULL, '2020-12-11', NULL, 3, '2020-12-11 22:53:40.235'),
(3, 1, '17:36:01', '17:57:36', '18:13:34', '18:39:08', '2020-12-11', NULL, 4, '2020-12-11 22:53:40.235'),
(4, 4, '08:00:00', NULL, NULL, '18:40:00', '2020-12-10', NULL, 4, '2020-12-10 22:40:40.000');

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

INSERT INTO `avisos` (`idavisos`, `texto`, `leido`) VALUES
(1, 'ERROR SALIDA', NULL);

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

INSERT INTO `departamentos` (`id`, `departamento`) VALUES
(1, 'Almacen'),
(2, 'Almacen de pisos'),
(4, 'Cliente'),
(5, 'Contabilidad'),
(6, 'Mantenimiento'),
(7, 'Patio'),
(8, 'Pisos'),
(9, 'Sistemas'),
(10, 'Taller'),
(11, 'Ventas');

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
(1, 'Registrando H. Entrada', 'Eduardo Gomez');

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

INSERT INTO `events` (`id`, `title`, `color`, `start`, `end`) VALUES
(1, 'Evento Azul', '#0071c5', '2017-08-01 00:00:00', '2017-08-02 00:00:00'),
(2, 'Eventos 2', '#40E0D0', '2017-08-02 00:00:00', '2017-08-03 00:00:00'),
(3, 'Doble click para editar evento', '#008000', '2017-08-03 00:00:00', '2017-08-07 00:00:00'),
(4, 'dia festivo', '#0071c5', '2020-12-07 00:00:00', '2020-12-08 00:00:00'),
(6, 'awa UwU', '#FF8C00', '2020-12-08 00:00:00', '2020-12-09 00:00:00'),
(8, 'dia festivo largo', '#FF0000', '2020-12-14 00:00:00', '2020-12-18 00:00:00'),
(9, 'dia de los chatos', '#FFD700', '2020-12-10 00:00:00', '2020-12-11 00:00:00'),
(10, 'vacaiones', '#40E0D0', '2020-12-28 00:00:00', '2020-12-31 00:00:00');

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

INSERT INTO `horarios_trabajadores` (`id`, `id_trabajador`, `dia_semana`, `hora_llegada`, `hora_comida_salida`, `hora_comida_llegada`, `hora_salida`, `estado`) VALUES
(1, 1, '1', '08:00:00', '13:00:00', '14:00:00', '18:00:00', 1),
(2, 2, '1', '08:00:00', '13:00:00', '14:00:00', '18:00:00', 1),
(3, 3, '1', '08:00:00', '13:00:00', '14:00:00', '18:00:00', 1),
(4, 4, '1', '08:00:00', '13:00:00', '14:00:00', '18:00:00', 1),
(5, 5, '1', '08:00:00', '13:00:00', '14:00:00', '18:00:00', 1),
(6, 6, '1', '08:00:00', '13:00:00', '14:00:00', '18:00:00', 1),
(7, 7, '1', '08:00:00', '13:00:00', '14:00:00', '18:00:00', 1),
(8, 8, '1', '08:00:00', '13:00:00', '14:00:00', '18:00:00', 1),
(9, 9, '1', '08:00:00', '13:00:00', '14:00:00', '18:00:00', 1),
(10, 10, '1', '08:00:00', '13:00:00', '14:00:00', '18:00:00', 1),
(11, 11, '1', '08:00:00', '13:00:00', '14:00:00', '18:00:00', 1),
(12, 12, '1', '08:00:00', '13:00:00', '14:00:00', '18:00:00', 1),
(13, 13, '1', '08:00:00', '13:00:00', '14:00:00', '18:00:00', 1),
(14, 14, '1', '08:00:00', '13:00:00', '14:00:00', '18:00:00', 1),
(15, 15, '1', '08:00:00', '13:00:00', '14:00:00', '18:00:00', 1),
(16, 16, '1', '08:00:00', '13:00:00', '14:00:00', '18:00:00', 1),
(17, 17, '1', '08:00:00', '13:00:00', '14:00:00', '18:00:00', 1),
(18, 18, '1', '08:00:00', '13:00:00', '14:00:00', '18:00:00', 1),
(19, 19, '1', '08:00:00', '13:00:00', '14:00:00', '18:00:00', 1),
(20, 20, '1', '08:00:00', '13:00:00', '14:00:00', '18:00:00', 1),
(21, 21, '1', '08:00:00', '13:00:00', '14:00:00', '18:00:00', 1),
(22, 22, '1', '08:00:00', '13:00:00', '14:00:00', '18:00:00', 1),
(23, 23, '1', '08:00:00', '13:00:00', '14:00:00', '18:00:00', 1),
(24, 24, '1', '08:00:00', '13:00:00', '14:00:00', '18:00:00', 1),
(25, 25, '1', '08:00:00', '13:00:00', '14:00:00', '18:00:00', 1),
(26, 26, '1', '08:00:00', '13:00:00', '14:00:00', '18:00:00', 1),
(27, 27, '1', '08:00:00', '13:00:00', '14:00:00', '18:00:00', 1),
(28, 28, '1', '08:00:00', '13:00:00', '14:00:00', '18:00:00', 1),
(29, 29, '1', '08:00:00', '13:00:00', '14:00:00', '18:00:00', 1),
(30, 30, '1', '08:00:00', '13:00:00', '14:00:00', '18:00:00', 1),
(31, 31, '1', '08:00:00', '13:00:00', '14:00:00', '18:00:00', 1),
(32, 32, '1', '08:00:00', '13:00:00', '14:00:00', '18:00:00', 1),
(33, 33, '1', '08:00:00', '13:00:00', '14:00:00', '18:00:00', 1),
(34, 34, '1', '08:00:00', '13:00:00', '14:00:00', '18:00:00', 1),
(35, 35, '1', '08:00:00', '13:00:00', '14:00:00', '18:00:00', 1),
(36, 36, '1', '08:00:00', '13:00:00', '14:00:00', '18:00:00', 1),
(37, 1, '2', '08:00:00', '13:00:00', '14:00:00', '18:00:00', 1),
(38, 1, '3', '08:00:00', '13:00:00', '14:00:00', '18:00:00', 1),
(39, 1, '4', '08:00:00', '13:00:00', '14:00:00', '18:00:00', 1),
(40, 1, '5', '08:00:00', '13:00:00', '14:00:00', '18:00:00', 1),
(41, 1, '6', '08:00:00', NULL, NULL, '14:00:00', 1),
(42, 1, '0', NULL, NULL, NULL, NULL, 0),
(43, 2, '2', '08:00:00', '13:00:00', '14:00:00', '18:00:00', 1),
(44, 2, '3', '08:00:00', '13:00:00', '14:00:00', '18:00:00', 1),
(45, 2, '4', '08:00:00', '13:00:00', '14:00:00', '18:00:00', 1),
(46, 2, '5', '08:00:00', '13:00:00', '14:00:00', '18:00:00', 1),
(47, 2, '6', '08:00:00', NULL, NULL, '14:00:00', 1),
(48, 2, '0', NULL, NULL, NULL, NULL, 0),
(49, 3, '2', '08:00:00', '13:00:00', '14:00:00', '18:00:00', 1),
(50, 3, '3', '08:00:00', '13:00:00', '14:00:00', '18:00:00', 1),
(51, 3, '4', '08:00:00', '13:00:00', '14:00:00', '18:00:00', 1),
(52, 3, '5', '08:00:00', '13:00:00', '14:00:00', '18:00:00', 1),
(53, 3, '6', '08:00:00', NULL, NULL, '14:00:00', 1),
(54, 3, '0', NULL, NULL, NULL, NULL, 0),
(55, 4, '2', '08:00:00', '13:00:00', '14:00:00', '18:00:00', 1),
(56, 4, '3', '08:00:00', '13:00:00', '14:00:00', '18:00:00', 1),
(57, 4, '4', '08:00:00', '13:00:00', '14:00:00', '18:00:00', 1),
(58, 4, '5', '08:00:00', '13:00:00', '14:00:00', '18:00:00', 1),
(59, 4, '6', '08:00:00', NULL, NULL, '14:00:00', 1),
(60, 4, '0', NULL, NULL, NULL, NULL, 0),
(61, 5, '2', '08:00:00', '13:00:00', '14:00:00', '18:00:00', 1),
(62, 5, '3', '08:00:00', '13:00:00', '14:00:00', '18:00:00', 1),
(63, 5, '4', '08:00:00', '13:00:00', '14:00:00', '18:00:00', 1),
(64, 5, '5', '08:00:00', '13:00:00', '14:00:00', '18:00:00', 1),
(65, 5, '6', '08:00:00', NULL, NULL, '14:00:00', 1),
(66, 5, '0', NULL, NULL, NULL, NULL, 0),
(67, 6, '2', '08:00:00', '13:00:00', '14:00:00', '18:00:00', 1),
(68, 6, '3', '08:00:00', '13:00:00', '14:00:00', '18:00:00', 1),
(69, 6, '4', '08:00:00', '13:00:00', '14:00:00', '18:00:00', 1),
(70, 6, '5', '08:00:00', '13:00:00', '14:00:00', '18:00:00', 1),
(71, 6, '6', '08:00:00', NULL, NULL, '14:00:00', 1),
(72, 6, '0', NULL, NULL, NULL, NULL, 0),
(73, 7, '2', '08:00:00', '13:00:00', '14:00:00', '18:00:00', 1),
(74, 7, '3', '08:00:00', '13:00:00', '14:00:00', '18:00:00', 1),
(75, 7, '4', '08:00:00', '13:00:00', '14:00:00', '18:00:00', 1),
(76, 7, '5', '08:00:00', '13:00:00', '14:00:00', '18:00:00', 1),
(77, 7, '6', '08:00:00', NULL, NULL, '14:00:00', 1),
(78, 7, '0', NULL, NULL, NULL, NULL, 0),
(79, 8, '2', '08:00:00', '13:00:00', '14:00:00', '18:00:00', 1),
(80, 8, '3', '08:00:00', '13:00:00', '14:00:00', '18:00:00', 1),
(81, 8, '4', '08:00:00', '13:00:00', '14:00:00', '18:00:00', 1),
(82, 8, '5', '08:00:00', '13:00:00', '14:00:00', '18:00:00', 1),
(83, 8, '6', '08:00:00', NULL, NULL, '14:00:00', 1),
(84, 8, '0', NULL, NULL, NULL, NULL, 0),
(85, 9, '2', '08:00:00', '13:00:00', '14:00:00', '18:00:00', 1),
(86, 9, '3', '08:00:00', '13:00:00', '14:00:00', '18:00:00', 1),
(87, 9, '4', '08:00:00', '13:00:00', '14:00:00', '18:00:00', 1),
(88, 9, '5', '08:00:00', '13:00:00', '14:00:00', '18:00:00', 1),
(89, 9, '6', '08:00:00', NULL, NULL, '14:00:00', 1),
(90, 9, '0', NULL, NULL, NULL, NULL, 0),
(91, 10, '2', '08:00:00', '13:00:00', '14:00:00', '18:00:00', 1),
(92, 10, '3', '08:00:00', '13:00:00', '14:00:00', '18:00:00', 1),
(93, 10, '4', '08:00:00', '13:00:00', '14:00:00', '18:00:00', 1),
(94, 10, '5', '08:00:00', '13:00:00', '14:00:00', '18:00:00', 1),
(95, 10, '6', '08:00:00', NULL, NULL, '14:00:00', 1),
(96, 10, '0', NULL, NULL, NULL, NULL, 0),
(97, 11, '2', '08:00:00', '13:00:00', '14:00:00', '18:00:00', 1),
(98, 11, '3', '08:00:00', '13:00:00', '14:00:00', '18:00:00', 1),
(99, 11, '4', '08:00:00', '13:00:00', '14:00:00', '18:00:00', 1),
(100, 11, '5', '08:00:00', '13:00:00', '14:00:00', '18:00:00', 1),
(101, 11, '6', '08:00:00', NULL, NULL, '14:00:00', 1),
(102, 11, '0', NULL, NULL, NULL, NULL, 0),
(103, 12, '2', '08:00:00', '13:00:00', '14:00:00', '18:00:00', 1),
(104, 12, '3', '08:00:00', '13:00:00', '14:00:00', '18:00:00', 1),
(105, 12, '4', '08:00:00', '13:00:00', '14:00:00', '18:00:00', 1),
(106, 12, '5', '08:00:00', '13:00:00', '14:00:00', '18:00:00', 1),
(107, 12, '6', '08:00:00', NULL, NULL, '14:00:00', 1),
(108, 12, '0', NULL, NULL, NULL, NULL, 0),
(109, 13, '2', '08:00:00', '13:00:00', '14:00:00', '18:00:00', 1),
(110, 13, '3', '08:00:00', '13:00:00', '14:00:00', '18:00:00', 1),
(111, 13, '4', '08:00:00', '13:00:00', '14:00:00', '18:00:00', 1),
(112, 13, '5', '08:00:00', '13:00:00', '14:00:00', '18:00:00', 1),
(113, 13, '6', '08:00:00', NULL, NULL, '14:00:00', 1),
(114, 13, '0', NULL, NULL, NULL, NULL, 0),
(115, 14, '2', '08:00:00', '13:00:00', '14:00:00', '18:00:00', 1),
(116, 14, '3', '08:00:00', '13:00:00', '14:00:00', '18:00:00', 1),
(117, 14, '4', '08:00:00', '13:00:00', '14:00:00', '18:00:00', 1),
(118, 14, '5', '08:00:00', '13:00:00', '14:00:00', '18:00:00', 1),
(119, 14, '6', '08:00:00', NULL, NULL, '14:00:00', 1),
(120, 14, '0', NULL, NULL, NULL, NULL, 0),
(121, 15, '2', '08:00:00', '13:00:00', '14:00:00', '18:00:00', 1),
(122, 15, '3', '08:00:00', '13:00:00', '14:00:00', '18:00:00', 1),
(123, 15, '4', '08:00:00', '13:00:00', '14:00:00', '18:00:00', 1),
(124, 15, '5', '08:00:00', '13:00:00', '14:00:00', '18:00:00', 1),
(125, 15, '6', '08:00:00', NULL, NULL, '14:00:00', 1),
(126, 15, '0', NULL, NULL, NULL, NULL, 0),
(127, 16, '2', '08:00:00', '13:00:00', '14:00:00', '18:00:00', 1),
(128, 16, '3', '08:00:00', '13:00:00', '14:00:00', '18:00:00', 1),
(129, 16, '4', '08:00:00', '13:00:00', '14:00:00', '18:00:00', 1),
(130, 16, '5', '08:00:00', '13:00:00', '14:00:00', '18:00:00', 1),
(131, 16, '6', '08:00:00', NULL, NULL, '14:00:00', 1),
(132, 16, '0', NULL, NULL, NULL, NULL, 0),
(133, 17, '2', '08:00:00', '13:00:00', '14:00:00', '18:00:00', 1),
(134, 17, '3', '08:00:00', '13:00:00', '14:00:00', '18:00:00', 1),
(135, 17, '4', '08:00:00', '13:00:00', '14:00:00', '18:00:00', 1),
(136, 17, '5', '08:00:00', '13:00:00', '14:00:00', '18:00:00', 1),
(137, 17, '6', '08:00:00', NULL, NULL, '14:00:00', 1),
(138, 17, '0', NULL, NULL, NULL, NULL, 0),
(139, 18, '2', '08:00:00', '13:00:00', '14:00:00', '18:00:00', 1),
(140, 18, '3', '08:00:00', '13:00:00', '14:00:00', '18:00:00', 1),
(141, 18, '4', '08:00:00', '13:00:00', '14:00:00', '18:00:00', 1),
(142, 18, '5', '08:00:00', '13:00:00', '14:00:00', '18:00:00', 1),
(143, 18, '6', '08:00:00', NULL, NULL, '14:00:00', 1),
(144, 18, '0', NULL, NULL, NULL, NULL, 0),
(145, 19, '2', '08:00:00', '13:00:00', '14:00:00', '18:00:00', 1),
(146, 19, '3', '08:00:00', '13:00:00', '14:00:00', '18:00:00', 1),
(147, 19, '4', '08:00:00', '13:00:00', '14:00:00', '18:00:00', 1),
(148, 19, '5', '08:00:00', '13:00:00', '14:00:00', '18:00:00', 1),
(149, 19, '6', '08:00:00', NULL, NULL, '14:00:00', 1),
(150, 19, '0', NULL, NULL, NULL, NULL, 0),
(151, 20, '2', '08:00:00', '13:00:00', '14:00:00', '18:00:00', 1),
(152, 20, '3', '08:00:00', '13:00:00', '14:00:00', '18:00:00', 1),
(153, 20, '4', '08:00:00', '13:00:00', '14:00:00', '18:00:00', 1),
(154, 20, '5', '08:00:00', '13:00:00', '14:00:00', '18:00:00', 1),
(155, 20, '6', '08:00:00', NULL, NULL, '14:00:00', 1),
(156, 20, '0', NULL, NULL, NULL, NULL, 0),
(157, 21, '2', '08:00:00', '13:00:00', '14:00:00', '18:00:00', 1),
(158, 21, '3', '08:00:00', '13:00:00', '14:00:00', '18:00:00', 1),
(159, 21, '4', '08:00:00', '13:00:00', '14:00:00', '18:00:00', 1),
(160, 21, '5', '08:00:00', '13:00:00', '14:00:00', '18:00:00', 1),
(161, 21, '6', '08:00:00', NULL, NULL, '14:00:00', 1),
(162, 21, '0', NULL, NULL, NULL, NULL, 0),
(163, 22, '2', '08:00:00', '13:00:00', '14:00:00', '18:00:00', 1),
(164, 22, '3', '08:00:00', '13:00:00', '14:00:00', '18:00:00', 1),
(165, 22, '4', '08:00:00', '13:00:00', '14:00:00', '18:00:00', 1),
(166, 22, '5', '08:00:00', '13:00:00', '14:00:00', '18:00:00', 1),
(167, 22, '6', '08:00:00', NULL, NULL, '14:00:00', 1),
(168, 22, '0', NULL, NULL, NULL, NULL, 0),
(169, 23, '2', '08:00:00', '13:00:00', '14:00:00', '18:00:00', 1),
(170, 23, '3', '08:00:00', '13:00:00', '14:00:00', '18:00:00', 1),
(171, 23, '4', '08:00:00', '13:00:00', '14:00:00', '18:00:00', 1),
(172, 23, '5', '08:00:00', '13:00:00', '14:00:00', '18:00:00', 1),
(173, 23, '6', '08:00:00', NULL, NULL, '14:00:00', 1),
(174, 23, '0', NULL, NULL, NULL, NULL, 0),
(175, 24, '2', '08:00:00', '13:00:00', '14:00:00', '18:00:00', 1),
(176, 24, '3', '08:00:00', '13:00:00', '14:00:00', '18:00:00', 1),
(177, 24, '4', '08:00:00', '13:00:00', '14:00:00', '18:00:00', 1),
(178, 24, '5', '08:00:00', '13:00:00', '14:00:00', '18:00:00', 1),
(179, 24, '6', '08:00:00', NULL, NULL, '14:00:00', 1),
(180, 24, '0', NULL, NULL, NULL, NULL, 0),
(181, 25, '2', '08:00:00', '13:00:00', '14:00:00', '18:00:00', 1),
(182, 25, '3', '08:00:00', '13:00:00', '14:00:00', '18:00:00', 1),
(183, 25, '4', '08:00:00', '13:00:00', '14:00:00', '18:00:00', 1),
(184, 25, '5', '08:00:00', '13:00:00', '14:00:00', '18:00:00', 1),
(185, 25, '6', '08:00:00', NULL, NULL, '14:00:00', 1),
(186, 25, '0', NULL, NULL, NULL, NULL, 0),
(187, 26, '2', '08:00:00', '13:00:00', '14:00:00', '18:00:00', 1),
(188, 26, '3', '08:00:00', '13:00:00', '14:00:00', '18:00:00', 1),
(189, 26, '4', '08:00:00', '13:00:00', '14:00:00', '18:00:00', 1),
(190, 26, '5', '08:00:00', '13:00:00', '14:00:00', '18:00:00', 1),
(191, 26, '6', '08:00:00', NULL, NULL, '14:00:00', 1),
(192, 26, '0', NULL, NULL, NULL, NULL, 0),
(193, 27, '2', '08:00:00', '13:00:00', '14:00:00', '18:00:00', 1),
(194, 27, '3', '08:00:00', '13:00:00', '14:00:00', '18:00:00', 1),
(195, 27, '4', '08:00:00', '13:00:00', '14:00:00', '18:00:00', 1),
(196, 27, '5', '08:00:00', '13:00:00', '14:00:00', '18:00:00', 1),
(197, 27, '6', '08:00:00', NULL, NULL, '14:00:00', 1),
(198, 27, '0', NULL, NULL, NULL, NULL, 0),
(199, 28, '2', '08:00:00', '13:00:00', '14:00:00', '18:00:00', 1),
(200, 28, '3', '08:00:00', '13:00:00', '14:00:00', '18:00:00', 1),
(201, 28, '4', '08:00:00', '13:00:00', '14:00:00', '18:00:00', 1),
(202, 28, '5', '08:00:00', '13:00:00', '14:00:00', '18:00:00', 1),
(203, 28, '6', '08:00:00', NULL, NULL, '14:00:00', 1),
(204, 28, '0', NULL, NULL, NULL, NULL, 0),
(205, 29, '2', '08:00:00', '13:00:00', '14:00:00', '18:00:00', 1),
(206, 29, '3', '08:00:00', '13:00:00', '14:00:00', '18:00:00', 1),
(207, 29, '4', '08:00:00', '13:00:00', '14:00:00', '18:00:00', 1),
(208, 29, '5', '08:00:00', '13:00:00', '14:00:00', '18:00:00', 1),
(209, 29, '6', '08:00:00', NULL, NULL, '14:00:00', 1),
(210, 29, '0', NULL, NULL, NULL, NULL, 0),
(211, 30, '2', '08:00:00', '13:00:00', '14:00:00', '18:00:00', 1),
(212, 30, '3', '08:00:00', '13:00:00', '14:00:00', '18:00:00', 1),
(213, 30, '4', '08:00:00', '13:00:00', '14:00:00', '18:00:00', 1),
(214, 30, '5', '08:00:00', '13:00:00', '14:00:00', '18:00:00', 1),
(215, 30, '6', '08:00:00', NULL, NULL, '14:00:00', 1),
(216, 30, '0', NULL, NULL, NULL, NULL, 0),
(217, 31, '2', '08:00:00', '13:00:00', '14:00:00', '18:00:00', 1),
(218, 31, '3', '08:00:00', '13:00:00', '14:00:00', '18:00:00', 1),
(219, 31, '4', '08:00:00', '13:00:00', '14:00:00', '18:00:00', 1),
(220, 31, '5', '08:00:00', '13:00:00', '14:00:00', '18:00:00', 1),
(221, 31, '6', '08:00:00', NULL, NULL, '14:00:00', 1),
(222, 31, '0', NULL, NULL, NULL, NULL, 0),
(223, 32, '2', '08:00:00', '13:00:00', '14:00:00', '18:00:00', 1),
(224, 32, '3', '08:00:00', '13:00:00', '14:00:00', '18:00:00', 1),
(225, 32, '4', '08:00:00', '13:00:00', '14:00:00', '18:00:00', 1),
(226, 32, '5', '08:00:00', '13:00:00', '14:00:00', '18:00:00', 1),
(227, 32, '6', '08:00:00', NULL, NULL, '14:00:00', 1),
(228, 32, '0', NULL, NULL, NULL, NULL, 0),
(229, 33, '2', '08:00:00', '13:00:00', '14:00:00', '18:00:00', 1),
(230, 33, '3', '08:00:00', '13:00:00', '14:00:00', '18:00:00', 1),
(231, 33, '4', '08:00:00', '13:00:00', '14:00:00', '18:00:00', 1),
(232, 33, '5', '08:00:00', '13:00:00', '14:00:00', '18:00:00', 1),
(233, 33, '6', '08:00:00', NULL, NULL, '14:00:00', 1),
(234, 33, '0', NULL, NULL, NULL, NULL, 0),
(235, 34, '2', '08:00:00', '13:00:00', '14:00:00', '18:00:00', 1),
(236, 34, '3', '08:00:00', '13:00:00', '14:00:00', '18:00:00', 1),
(237, 34, '4', '08:00:00', '13:00:00', '14:00:00', '18:00:00', 1),
(238, 34, '5', '08:00:00', '13:00:00', '14:00:00', '18:00:00', 1),
(239, 34, '6', '08:00:00', NULL, NULL, '14:00:00', 1),
(240, 34, '0', NULL, NULL, NULL, NULL, 0),
(241, 35, '2', '08:00:00', '13:00:00', '14:00:00', '18:00:00', 1),
(242, 35, '3', '08:00:00', '13:00:00', '14:00:00', '18:00:00', 1),
(243, 35, '4', '08:00:00', '13:00:00', '14:00:00', '18:00:00', 1),
(244, 35, '5', '08:00:00', '13:00:00', '14:00:00', '18:00:00', 1),
(245, 35, '6', '08:00:00', NULL, NULL, '14:00:00', 1),
(246, 35, '0', NULL, NULL, NULL, NULL, 0),
(247, 36, '2', '08:00:00', '13:00:00', '14:00:00', '18:00:00', 1),
(248, 36, '3', '08:00:00', '13:00:00', '14:00:00', '18:00:00', 1),
(249, 36, '4', '08:00:00', '13:00:00', '14:00:00', '18:00:00', 1),
(250, 36, '5', '08:00:00', '13:00:00', '14:00:00', '18:00:00', 1),
(251, 36, '6', '08:00:00', NULL, NULL, '14:00:00', 1),
(252, 36, '0', NULL, NULL, NULL, NULL, 0),
(253, 37, '1', '08:00:00', '13:00:00', '14:00:00', '18:00:00', 1),
(254, 37, '2', '08:00:00', '13:00:00', '14:00:00', '18:00:00', 1),
(255, 37, '3', '08:00:00', '13:00:00', '14:00:00', '18:00:00', 1),
(256, 37, '4', '08:00:00', '13:00:00', '14:00:00', '18:00:00', 1),
(257, 37, '5', '08:00:00', '13:00:00', '14:00:00', '18:00:00', 1),
(258, 37, '6', '08:00:00', NULL, NULL, '14:00:00', 1),
(259, 37, '0', NULL, NULL, NULL, NULL, 0);

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

INSERT INTO `new` (`id`, `tarjeta`, `conocida`) VALUES
(1, '1234', NULL);

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

INSERT INTO `permisos` (`id`, `id_trabajador`, `razon`, `fecha`, `tipo`, `descuento`) VALUES
(1, 32, 'Razones medicas', '2020-10-30', 'falta', 150),
(2, 7, 'Razones medicas', '2020-10-30', 'falta', 100),
(3, 10, 'Razones medicas', '2020-11-03', 'falta', 0);

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

INSERT INTO `semana` (`id`, `dia`) VALUES
(0, 'Domingo'),
(1, 'Lunes'),
(2, 'Martes'),
(3, 'Miercoles'),
(4, 'Jueves'),
(5, 'Viernes'),
(6, 'Sabado');

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

INSERT INTO `tipo_incidencias` (`id_incidencia`, `nombre`, `tiempo`, `descuento`, `id_departamento`) VALUES
(1, 'con retardo', 15, 50, 1),
(2, 'sin incidencia', 0, 0, 0);

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
  `fecha_nacimiento` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `trabajadores`
--

INSERT INTO `trabajadores` (`id`, `nombre`, `direccion`, `telefono`, `genero`, `estado_civil`, `id_departamento`, `puesto`, `tipo_pago`, `sueldo`, `tarjeta`, `fecha_ingreso`, `fecha_nacimiento`) VALUES
(1, 'ABIGAIL', 'conocido', '4271234567', 'Mujer', 'Soltero(a)', 1, 'Almacenista', 'semanal', '1300.00', '41076000', '2020-01-01', '2000-01-01'),
(2, 'ADRIANA BADILLO', 'asdm', '5464654350', 'Mujer', 'Soltero(a)', 11, 'mantenimiento', 'semanal', '1300.00', '1461061978600', '2020-01-01', '2000-01-01'),
(3, 'ANA', 'El Pedregoso', '4271565124', 'Mujer', 'Casado(a)', 1, 'ventas', 'semanal', '1300.00', '1302162148600', '2020-01-01', '2000-01-01'),
(4, 'ANTONIO BARRERA', NULL, NULL, NULL, NULL, 7, NULL, 'semanal', '1300.00', NULL, '2020-01-01', '2000-01-01'),
(5, 'ANTONIO COLIN', NULL, NULL, NULL, NULL, 1, NULL, 'semanal', '1300.00', NULL, '2020-01-01', '2000-01-01'),
(6, 'ANTONIO GARCIA', NULL, NULL, NULL, NULL, 1, NULL, 'semanal', '1300.00', NULL, '2020-01-01', '2000-01-01'),
(7, 'ANTONIO MARTINEZ', NULL, NULL, NULL, NULL, 11, NULL, 'semanal', '1300.00', NULL, '2020-01-01', '2000-01-01'),
(8, 'ARMANDO', NULL, NULL, NULL, NULL, 1, NULL, 'semanal', '1300.00', NULL, '2020-01-01', '2000-01-01'),
(9, 'CUAUHTEMOC ONTIVEROS', NULL, NULL, NULL, NULL, 11, NULL, 'semanal', '1300.00', NULL, '2020-01-01', '2000-01-01'),
(10, 'DANIEL CARDOSO', NULL, NULL, NULL, NULL, 7, NULL, 'semanal', '1300.00', NULL, '2020-01-01', '2000-01-01'),
(11, 'EDUARDO ALBERTO FUENTES', NULL, NULL, NULL, NULL, 11, NULL, 'semanal', '1300.00', NULL, '2020-01-01', '2000-01-01'),
(12, 'ELEAZAR ALCANTARA', NULL, NULL, NULL, NULL, 11, NULL, 'semanal', '1300.00', NULL, '2020-01-01', '2000-01-01'),
(13, 'ENRIQUE GONZALEZ', NULL, NULL, NULL, NULL, 11, NULL, 'semanal', '1300.00', NULL, '2020-01-01', '2000-01-01'),
(14, 'FRANCISCO CORONA', NULL, NULL, NULL, NULL, 11, NULL, 'semanal', '1300.00', NULL, '2020-01-01', '2000-01-01'),
(15, 'FRANCISCO GONZALEZ', NULL, NULL, NULL, NULL, 1, NULL, 'semanal', '1300.00', NULL, '2020-01-01', '2000-01-01'),
(16, 'FRANCISCO TALLER', NULL, NULL, NULL, NULL, 10, NULL, 'semanal', '1300.00', NULL, '2020-01-01', '2000-01-01'),
(17, 'GUADALUPE REYES', NULL, NULL, NULL, NULL, 11, NULL, 'semanal', '1300.00', NULL, '2020-01-01', '2000-01-01'),
(18, 'GUADALUPE SILVESTRE', NULL, NULL, NULL, NULL, 11, NULL, 'semanal', '1300.00', NULL, '2020-01-01', '2000-01-01'),
(19, 'GUILLERMO', NULL, NULL, NULL, NULL, 1, NULL, 'semanal', '1300.00', NULL, '2020-01-01', '2000-01-01'),
(20, 'GUSTAVO NIETO', NULL, NULL, NULL, NULL, 11, NULL, 'semanal', '1300.00', NULL, '2020-01-01', '2000-01-01'),
(21, 'HUGO JIMENEZ', NULL, NULL, NULL, NULL, 7, NULL, 'semanal', '1300.00', NULL, '2020-01-01', '2000-01-01'),
(22, 'JAVIER ALEGRIA', NULL, NULL, NULL, NULL, 11, NULL, 'semanal', '1300.00', NULL, '2020-01-01', '2000-01-01'),
(23, 'JOSE GUADALUPE', NULL, NULL, NULL, NULL, 1, NULL, 'semanal', '1300.00', NULL, '2020-01-01', '2000-01-01'),
(24, 'JUAN IGNACIO CORREA', NULL, NULL, NULL, NULL, 11, NULL, 'semanal', '1300.00', NULL, '2020-01-01', '2000-01-01'),
(25, 'KALID NOE SOTO', NULL, NULL, NULL, NULL, 10, NULL, 'semanal', '1300.00', NULL, '2020-01-01', '2000-01-01'),
(26, 'LAURA MANRIQUEZ', NULL, NULL, NULL, NULL, 11, NULL, 'semanal', '1300.00', NULL, '2020-01-01', '2000-01-01'),
(27, 'LEONARDO DANIEL', NULL, NULL, NULL, NULL, 7, NULL, 'semanal', '1300.00', NULL, '2020-01-01', '2000-01-01'),
(28, 'LUCIA NUñEZ', NULL, NULL, NULL, NULL, 11, NULL, 'semanal', '1300.00', NULL, '2020-01-01', '2000-01-01'),
(29, 'LUCIO RIVAS', NULL, NULL, NULL, NULL, 11, NULL, 'semanal', '1300.00', NULL, '2020-01-01', '2000-01-01'),
(30, 'PABLO', NULL, NULL, NULL, NULL, 1, NULL, 'semanal', '1300.00', NULL, '2020-01-01', '2000-01-01'),
(31, 'RAFAEL ECHEVERRIA', NULL, NULL, NULL, NULL, 11, NULL, 'semanal', '1300.00', NULL, '2020-01-01', '2000-01-01'),
(32, 'RICARDO GARCIA', NULL, NULL, NULL, NULL, 11, NULL, 'semanal', '1300.00', NULL, '2020-01-01', '2000-01-01'),
(33, 'RICARDO MUNDO', NULL, NULL, NULL, NULL, 7, NULL, 'semanal', '1300.00', NULL, '2020-01-01', '2000-01-01'),
(34, 'SAMANTHA ', NULL, NULL, NULL, NULL, 1, NULL, 'semanal', '1300.00', NULL, '2020-01-01', '2000-01-01'),
(35, 'SERGIO GARCIA', NULL, NULL, NULL, NULL, 11, NULL, 'semanal', '1300.00', NULL, '2020-01-01', '2000-01-01'),
(36, 'TOMAS ', NULL, NULL, NULL, NULL, 1, NULL, 'semanal', '1300.00', NULL, '2020-01-01', '2000-01-01'),
(37, 'CONCEPCION GONZALEZ', NULL, NULL, NULL, NULL, NULL, NULL, 'semanal', '1300.00', NULL, '2020-01-01', '2000-01-01');

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

INSERT INTO `unidades` (`id`, `modelo`, `placas`, `odometro_inicial`, `servicio_cada`, `tarjeta_circulacion`, `poliza`, `fecha_compra`, `notas`, `estado_unidad`) VALUES
(1, 'NISSAN NP300 ESTACAS', 'ABC-1234', 100, 5000, 'TJA567', '0123456789', '2010-01-19', '', 'disponible'),
(2, 'modelo', 'plca', 1000, 500, 'tarjeta', 'poliza', '2020-10-06', 'unidad de prueba', 'disponible');

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
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

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
