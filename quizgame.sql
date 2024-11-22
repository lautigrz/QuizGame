-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 22-11-2024 a las 17:50:29
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
-- Base de datos: `quizgame`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoria`
--

CREATE TABLE `categoria` (
  `id` int(11) NOT NULL,
  `descripcion` varchar(100) DEFAULT NULL,
  `color` varchar(20) DEFAULT NULL,
  `icono` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `categoria`
--

INSERT INTO `categoria` (`id`, `descripcion`, `color`, `icono`) VALUES
(1, 'Geografía', '#227ecf ', 'https://media.tenor.com/Z5xqb9zvxSEAAAAi/world-globe.gif'),
(2, 'Historia', '#ecdc1f ', 'https://media.tenor.com/upryM9ilIuUAAAAi/historia.gif'),
(3, 'Ciencia', '#2fcf22', 'https://media.tenor.com/V9-CgNCwFBYAAAAi/experience-green-liquid.gif'),
(4, 'Deporte', '#e98f30 ', 'https://media.tenor.com/nX-zTFSiAZwAAAAi/soccer-sports.gif'),
(5, 'Arte', '#e93030 ', 'https://media.tenor.com/P3gTeupuuW4AAAAi/grandmother-granny.gif');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `dificultad`
--

CREATE TABLE `dificultad` (
  `id` int(11) NOT NULL,
  `idUsuario` int(11) NOT NULL,
  `idPregunta` int(11) NOT NULL,
  `veces_correctas` int(11) NOT NULL,
  `veces_vista` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `dificultad`
--

INSERT INTO `dificultad` (`id`, `idUsuario`, `idPregunta`, `veces_correctas`, `veces_vista`) VALUES
(27, 68, 42, 19, 26),
(28, 68, 34, 30, 43),
(29, 68, 44, 31, 49),
(30, 68, 39, 26, 44),
(31, 68, 41, 30, 48),
(32, 68, 1, 29, 47),
(33, 68, 40, 32, 51),
(34, 68, 2, 22, 37),
(35, 68, 45, 28, 50),
(36, 68, 38, 35, 47),
(37, 68, 46, 31, 45),
(38, 68, 47, 27, 52),
(39, 68, 37, 31, 45),
(40, 68, 48, 28, 43),
(41, 68, 36, 30, 48),
(42, 68, 3, 23, 37),
(43, 68, 35, 25, 43),
(44, 68, 43, 21, 27),
(45, 76, 39, 3, 4),
(46, 76, 1, 3, 3),
(47, 76, 3, 3, 8),
(48, 76, 37, 3, 6),
(49, 76, 2, 3, 4),
(50, 76, 42, 2, 4),
(51, 76, 48, 4, 4),
(52, 76, 40, 2, 3),
(53, 76, 38, 3, 3),
(54, 76, 47, 2, 4),
(55, 76, 35, 3, 3),
(56, 76, 43, 4, 4),
(57, 76, 46, 6, 6),
(58, 76, 44, 2, 3),
(59, 76, 41, 2, 4),
(60, 76, 45, 3, 3),
(61, 76, 34, 2, 3),
(62, 76, 36, 3, 4),
(63, 78, 3, 1, 1),
(64, 78, 35, 1, 1),
(65, 78, 37, 1, 1),
(66, 78, 38, 1, 1),
(67, 78, 36, 1, 1),
(68, 78, 41, 1, 1),
(69, 78, 40, 1, 1),
(70, 78, 47, 0, 1),
(71, 77, 3, 1, 2),
(72, 77, 2, 1, 1),
(73, 77, 41, 1, 2),
(74, 70, 35, 1, 1),
(75, 70, 45, 1, 1),
(76, 70, 47, 1, 1),
(77, 70, 41, 1, 1),
(78, 70, 3, 0, 1),
(79, 79, 1, 1, 1),
(80, 79, 36, 1, 1),
(81, 79, 38, 1, 1),
(82, 79, 41, 0, 1),
(83, 80, 41, 1, 1),
(84, 80, 35, 1, 1),
(85, 80, 36, 1, 1),
(86, 80, 1, 1, 1),
(87, 80, 34, 0, 1),
(88, 77, 43, 1, 1),
(89, 77, 1, 1, 1),
(90, 77, 39, 1, 1),
(91, 77, 44, 1, 1),
(92, 77, 42, 1, 1),
(93, 77, 38, 1, 2),
(94, 79, 2, 1, 1),
(95, 79, 34, 1, 1),
(96, 79, 46, 1, 1),
(97, 79, 48, 1, 1),
(98, 79, 35, 1, 1),
(99, 79, 44, 0, 1),
(100, 79, 40, 1, 1),
(101, 79, 39, 1, 1),
(102, 79, 45, 1, 1),
(103, 79, 47, 1, 1),
(104, 79, 37, 1, 1),
(105, 79, 3, 2, 3),
(106, 68, 63, 2, 6),
(107, 68, 64, 0, 1),
(108, 68, 65, 0, 2),
(109, 68, 77, 3, 5),
(110, 77, 48, 1, 1),
(111, 77, 77, 1, 1),
(112, 77, 46, 1, 1),
(113, 77, 37, 1, 1),
(114, 77, 47, 1, 1),
(115, 77, 35, 1, 1),
(116, 77, 40, 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `historico`
--

CREATE TABLE `historico` (
  `id` int(11) NOT NULL,
  `idUsuario` int(11) NOT NULL,
  `idPregunta` int(11) NOT NULL,
  `hora` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `historico`
--

INSERT INTO `historico` (`id`, `idUsuario`, `idPregunta`, `hora`) VALUES
(1430, 68, 38, '2024-11-22 16:05:12'),
(1431, 68, 41, '2024-11-22 16:05:15'),
(1432, 68, 44, '2024-11-22 16:13:43'),
(1433, 68, 43, '2024-11-22 16:13:49'),
(1434, 68, 36, '2024-11-22 16:13:52'),
(1435, 68, 34, '2024-11-22 16:14:01'),
(1436, 77, 48, '2024-11-22 16:25:00'),
(1437, 77, 77, '2024-11-22 16:25:03'),
(1438, 77, 38, '2024-11-22 16:25:08'),
(1439, 77, 41, '2024-11-22 16:25:10'),
(1440, 77, 46, '2024-11-22 16:25:13'),
(1441, 77, 37, '2024-11-22 16:25:16'),
(1442, 77, 47, '2024-11-22 16:25:22'),
(1443, 77, 35, '2024-11-22 16:25:25'),
(1444, 77, 40, '2024-11-22 16:25:28'),
(1445, 77, 3, '2024-11-22 16:25:31');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `notificacion`
--

CREATE TABLE `notificacion` (
  `id` int(11) NOT NULL,
  `idUsuario` int(11) NOT NULL,
  `mensaje` text NOT NULL,
  `leido` tinyint(1) NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `tipo` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `notificacion`
--

INSERT INTO `notificacion` (`id`, `idUsuario`, `mensaje`, `leido`, `fecha`, `tipo`) VALUES
(7, 68, 'Hola lautigrz tu Sugerencia fue aprobada ', 1, '2024-11-15 20:00:09', 'Sugerencia'),
(8, 68, 'Hola lautigrz tu Reporte fue rechazado ', 1, '2024-11-16 00:08:43', 'Reporte'),
(9, 68, 'Hola lautigrz tu Sugerencia fue rechazada ', 1, '2024-11-16 00:30:19', 'Sugerencia'),
(10, 68, 'Hola lautigrz tu Sugerencia fue aprobada ', 1, '2024-11-16 00:36:35', 'Sugerencia'),
(11, 68, 'Hola lautigrz tu Reporte fue aprobado ', 1, '2024-11-16 00:36:35', 'Reporte'),
(12, 68, 'Hola lautigrz tu Reporte fue aprobado ', 1, '2024-11-16 00:40:49', 'Reporte'),
(13, 68, 'Hola lautigrz tu Sugerencia fue rechazada ', 1, '2024-11-22 00:51:43', 'Sugerencia'),
(14, 68, 'Hola lautigrz tu Reporte fue rechazado ', 1, '2024-11-22 00:51:43', 'Reporte'),
(15, 68, 'Hola lautigrz tu Reporte fue rechazado ', 1, '2024-11-22 18:08:09', 'Reporte'),
(16, 68, 'Hola lautigrz tu Reporte fue aprobado ', 1, '2024-11-22 18:08:09', 'Reporte'),
(17, 77, 'Hola lionelmessi tu Sugerencia fue rechazada ', 1, '2024-11-22 19:42:40', 'Sugerencia'),
(18, 77, 'Hola lionelmessi tu sugerencia fue rechazada ', 1, '2024-11-22 19:46:20', 'Sugerencia');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `opciones`
--

CREATE TABLE `opciones` (
  `id` int(11) NOT NULL,
  `preguntaID` int(11) DEFAULT NULL,
  `opcion` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `opciones`
--

INSERT INTO `opciones` (`id`, `preguntaID`, `opcion`) VALUES
(1, 1, 'Francia'),
(2, 1, 'Argentina'),
(3, 1, 'Holanda'),
(4, 1, 'Brasil'),
(5, 2, 'George Washington'),
(6, 2, 'Thomas Jefferson'),
(7, 2, 'Abraham Lincoln'),
(8, 2, 'John Adams'),
(9, 3, 'Proceso de respiración celular'),
(10, 3, 'Proceso por el cual las plantas obtienen energía del sol'),
(11, 3, 'Cambio químico en animales'),
(12, 3, 'Reacción del cuerpo a estímulos'),
(13, 34, 'Saturno'),
(14, 34, 'Júpiter'),
(15, 34, 'Marte'),
(16, 34, 'Tierra'),
(17, 35, 'William Shakespeare'),
(18, 35, 'Julio Verne'),
(19, 35, 'Miguel de Cervantes'),
(20, 35, 'Gabriel García Márquez'),
(21, 36, 'Oro'),
(22, 36, 'Osmio'),
(23, 36, 'Hidrógeno'),
(24, 36, 'Oxígeno'),
(25, 37, 'Océano Índico'),
(26, 37, 'Océano Atlántico'),
(27, 37, 'Océano Pacífico'),
(28, 37, 'Océano Ártico'),
(29, 38, '1991'),
(30, 38, '1993'),
(31, 38, '1989'),
(32, 38, '1987'),
(33, 39, 'Brasil'),
(34, 39, 'Croacia'),
(35, 39, 'Francia'),
(36, 39, 'Alemania'),
(37, 40, 'Salvador Dalí'),
(38, 40, 'Leonardo da Vinci'),
(39, 40, 'Pablo Picasso'),
(40, 40, 'Vincent van Gogh'),
(41, 41, 'Portugués'),
(42, 41, 'Español'),
(43, 41, 'Inglés'),
(44, 41, 'Francés'),
(45, 42, 'X'),
(46, 42, 'C'),
(47, 42, 'D'),
(48, 42, 'L'),
(49, 43, 'Dióxido de carbono'),
(50, 43, 'Oxígeno'),
(51, 43, 'Nitrógeno'),
(52, 43, 'Helio'),
(53, 44, 'Misisipi'),
(54, 44, 'Amazonas'),
(55, 44, 'Nilo'),
(56, 44, 'Yangtsé'),
(57, 45, 'Nikola Tesla'),
(58, 45, 'Albert Einstein'),
(59, 45, 'Isaac Newton'),
(60, 45, 'Galileo Galilei'),
(61, 46, 'Un fenómeno climático'),
(62, 46, 'La teoría del origen del universo'),
(63, 46, 'Una estrella explosiva'),
(64, 46, 'Un tipo de partícula subatómica'),
(65, 47, 'Inglaterra'),
(66, 47, 'Francia'),
(67, 47, 'Italia'),
(68, 47, 'España'),
(69, 48, 'La fuerza que impulsa el viento'),
(70, 48, 'El campo magnético de la Tierra'),
(71, 48, 'La atracción de los cuerpos hacia el centro de la Tierra'),
(72, 48, 'La energía solar'),
(145, 75, 'messi'),
(146, 75, 'dasd'),
(147, 75, 'ads'),
(148, 75, 'asda'),
(153, 77, 'Liverpool'),
(154, 77, 'FC Barcelona'),
(155, 77, 'Real Madrid'),
(156, 77, 'Chelsea'),
(165, 80, 'messi'),
(166, 80, 'dasd'),
(167, 80, 'ads'),
(168, 80, 'asda'),
(169, 81, 'messi'),
(170, 81, 'dasd'),
(171, 81, 'ads'),
(172, 81, 'asda');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `partida`
--

CREATE TABLE `partida` (
  `id` int(11) NOT NULL,
  `puntaje_obtenido` int(11) DEFAULT NULL,
  `fecha_partida` datetime DEFAULT NULL,
  `idUsuario` int(11) DEFAULT NULL,
  `estado` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `partida`
--

INSERT INTO `partida` (`id`, `puntaje_obtenido`, `fecha_partida`, `idUsuario`, `estado`) VALUES
(159, 0, '2024-10-29 19:20:12', 68, 0),
(160, 0, '2024-10-29 19:27:43', 68, 0),
(161, 0, '2024-10-29 19:27:51', 68, 0),
(162, 0, '2024-10-29 19:27:59', 68, 0),
(163, 7, '2024-10-29 19:30:09', 68, 0),
(164, 2, '2024-10-29 19:35:24', 68, 0),
(165, 1, '2024-10-29 19:41:49', 68, 0),
(166, 10, '2024-10-29 20:28:43', 68, 0),
(167, 0, '2024-10-31 15:25:35', 68, 0),
(168, 0, '2024-10-31 15:25:45', 68, 0),
(169, 0, '2024-10-31 15:25:52', 68, 0),
(170, 0, '2024-10-31 15:25:59', 68, 0),
(171, 0, '2024-10-31 15:36:39', 68, 0),
(172, 0, '2024-10-31 15:36:46', 68, 0),
(173, 0, '2024-10-31 15:36:53', 68, 0),
(174, 0, '2024-10-31 15:37:12', 68, 0),
(175, 1, '2024-10-31 15:37:37', 68, 0),
(176, 0, '2024-10-31 15:51:43', 68, 0),
(177, 0, '2024-10-31 15:51:55', 68, 0),
(178, 0, '2024-10-31 15:52:04', 68, 0),
(179, 0, '2024-10-31 15:53:27', 68, 0),
(180, 29, '2024-10-31 15:56:31', 68, 0),
(181, 0, '2024-10-31 16:11:46', 68, 0),
(182, 0, '2024-10-31 16:12:05', 68, 0),
(183, 0, '2024-10-31 16:12:15', 68, 0),
(184, 0, '2024-10-31 16:12:22', 68, 0),
(185, 0, '2024-10-31 16:12:29', 68, 0),
(186, 0, '2024-10-31 16:12:37', 68, 0),
(187, 0, '2024-10-31 16:13:18', 68, 0),
(188, 5, '2024-10-31 16:18:18', 68, 0),
(189, 0, '2024-10-31 16:23:01', 68, 0),
(190, 0, '2024-10-31 16:23:09', 68, 0),
(191, 0, '2024-10-31 16:23:17', 68, 0),
(192, 0, '2024-10-31 16:23:24', 68, 0),
(193, 0, '2024-10-31 16:23:32', 68, 0),
(194, 1, '2024-10-31 16:24:26', 68, 0),
(195, 11, '2024-10-31 16:25:45', 68, 0),
(196, 12, '2024-10-31 16:35:03', 68, 0),
(197, 2, '2024-10-31 16:43:11', 68, 0),
(198, 6, '2024-10-31 16:49:50', 68, 0),
(199, 2, '2024-10-31 16:57:16', 68, 0),
(200, 5, '2024-10-31 16:59:39', 68, 0),
(201, 7, '2024-10-31 19:22:18', 76, 0),
(202, 11, '2024-10-31 19:30:32', 76, 0),
(203, 7, '2024-10-31 20:11:38', 78, 0),
(204, 2, '2024-10-31 20:15:44', 77, 0),
(205, 4, '2024-11-02 13:52:16', 70, 0),
(206, 3, '2024-11-02 13:55:07', 79, 0),
(207, 4, '2024-11-02 14:00:40', 80, 0),
(208, 5, '2024-11-02 14:26:18', 77, 0),
(209, 1, '2024-11-03 18:30:25', 68, 0),
(210, 5, '2024-11-04 14:08:10', 79, 0),
(211, 7, '2024-11-04 14:50:34', 79, 0),
(212, 0, '2024-11-04 14:53:50', 68, 0),
(213, 7, '2024-11-04 14:54:14', 68, 0),
(9387, 0, '2024-11-04 15:18:22', 68, 0),
(9388, 10, '2024-11-04 15:25:47', 68, 0),
(9389, 12, '2024-11-04 15:29:10', 68, 0),
(9390, 18, '2024-11-04 15:32:28', 68, 0),
(9391, 15, '2024-11-04 15:37:21', 68, 0),
(9392, 8, '2024-11-04 15:43:32', 68, 0),
(9393, 1, '2024-11-07 17:49:11', 68, 0),
(9394, 0, '2024-11-08 13:12:38', 68, 0),
(9395, 5, '2024-11-08 13:45:23', 68, 0),
(9396, 0, '2024-11-08 14:03:11', 68, 0),
(9397, 0, '2024-11-08 14:04:42', 68, 0),
(9398, 1, '2024-11-08 14:22:54', 68, 0),
(9399, 0, '2024-11-08 14:29:17', 68, 0),
(9400, 0, '2024-11-08 14:29:24', 68, 0),
(9401, 0, '2024-11-08 14:29:31', 68, 0),
(9402, 0, '2024-11-08 14:29:43', 68, 0),
(9403, 0, '2024-11-08 14:31:01', 68, 0),
(9404, 0, '2024-11-08 14:31:04', 68, 0),
(9405, 0, '2024-11-08 14:31:08', 68, 0),
(9406, 0, '2024-11-08 14:32:50', 68, 0),
(9407, 0, '2024-11-08 14:42:49', 68, 0),
(9408, 0, '2024-11-08 14:45:04', 68, 0),
(9409, 0, '2024-11-08 14:45:14', 68, 0),
(9410, 0, '2024-11-08 14:47:23', 68, 0),
(9411, 0, '2024-11-08 14:52:03', 68, 0),
(9412, 0, '2024-11-08 14:56:38', 68, 0),
(9413, 0, '2024-11-08 14:58:34', 68, 0),
(9414, 0, '2024-11-08 14:59:00', 68, 0),
(9415, 0, '2024-11-08 15:06:57', 68, 0),
(9416, 0, '2024-11-08 15:07:40', 68, 0),
(9417, 0, '2024-11-08 15:23:41', 68, 0),
(9418, 1, '2024-11-08 15:23:51', 68, 0),
(9419, 0, '2024-11-08 15:38:31', 68, 0),
(9420, 3, '2024-11-08 15:38:58', 68, 0),
(9421, 0, '2024-11-08 15:42:39', 68, 0),
(9422, 0, '2024-11-08 15:52:57', 68, 0),
(9423, 0, '2024-11-08 15:54:21', 68, 0),
(9424, 0, '2024-11-08 15:54:27', 68, 0),
(9425, 1, '2024-11-08 15:54:46', 68, 0),
(9426, 2, '2024-11-08 15:56:33', 68, 0),
(9427, 1, '2024-11-08 16:00:50', 68, 0),
(9428, 0, '2024-11-08 16:03:36', 68, 0),
(9429, 0, '2024-11-08 16:03:44', 68, 0),
(9430, 0, '2024-11-08 16:03:52', 68, 0),
(9431, 0, '2024-11-08 16:05:00', 68, 0),
(9432, 0, '2024-11-08 16:07:17', 68, 0),
(9433, 0, '2024-11-08 16:07:22', 68, 0),
(9434, 0, '2024-11-08 16:07:29', 68, 0),
(9435, 0, '2024-11-08 16:07:29', 68, 0),
(9436, 0, '2024-11-08 16:07:29', 68, 0),
(9437, 0, '2024-11-08 16:21:02', 68, 0),
(9438, 2, '2024-11-08 16:25:43', 68, 0),
(9439, 0, '2024-11-08 16:26:55', 68, 0),
(9440, 0, '2024-11-08 16:29:24', 68, 0),
(9441, 0, '2024-11-08 16:30:27', 68, 0),
(9442, 0, '2024-11-08 16:30:31', 68, 0),
(9443, 0, '2024-11-08 16:32:06', 68, 0),
(9444, 0, '2024-11-08 16:32:14', 68, 0),
(9445, 0, '2024-11-08 16:32:18', 68, 0),
(9447, 0, '2024-11-08 16:33:04', 68, 0),
(9448, 0, '2024-11-08 16:33:08', 68, 0),
(9449, 0, '2024-11-08 16:35:26', 68, 0),
(9450, 0, '2024-11-08 16:35:58', 68, 0),
(9451, 1, '2024-11-08 16:39:22', 68, 0),
(9452, 0, '2024-11-08 16:45:19', 68, 0),
(9453, 1, '2024-11-08 16:45:31', 68, 0),
(9454, 0, '2024-11-08 16:46:37', 68, 0),
(9455, 0, '2024-11-08 16:47:42', 68, 0),
(9456, 1, '2024-11-08 16:48:00', 68, 0),
(9457, 1, '2024-11-08 16:48:14', 68, 0),
(9458, 1, '2024-11-08 16:50:48', 68, 0),
(9459, 1, '2024-11-08 18:08:37', 68, 0),
(9460, 0, '2024-11-08 18:08:55', 68, 0),
(9462, 0, '2024-11-08 18:09:36', 68, 0),
(9467, 1, '2024-11-08 18:19:08', 68, 0),
(9468, 0, '2024-11-08 18:19:47', 68, 0),
(9469, 0, '2024-11-08 18:27:03', 68, 0),
(9470, 3, '2024-11-08 18:27:27', 68, 0),
(9471, 0, '2024-11-08 18:27:51', 68, 0),
(9472, 2, '2024-11-08 18:36:33', 68, 0),
(9473, 2, '2024-11-08 18:37:45', 68, 0),
(9474, 1, '2024-11-08 18:39:27', 68, 0),
(9475, 3, '2024-11-08 18:45:45', 68, 0),
(9476, 0, '2024-11-08 18:52:28', 68, 0),
(9477, 0, '2024-11-08 18:53:47', 68, 0),
(9478, 0, '2024-11-08 18:54:34', 68, 0),
(9479, 0, '2024-11-08 18:55:42', 68, 0),
(9480, 0, '2024-11-08 18:56:10', 68, 0),
(9481, 1, '2024-11-08 18:58:10', 68, 0),
(9482, 2, '2024-11-08 18:59:35', 68, 0),
(9483, 1, '2024-11-08 19:02:52', 68, 0),
(9484, 0, '2024-11-08 19:04:49', 68, 0),
(9485, 0, '2024-11-08 19:05:13', 68, 0),
(9486, 0, '2024-11-08 19:06:18', 68, 0),
(9487, 2, '2024-11-08 19:07:26', 68, 0),
(9488, 0, '2024-11-08 19:10:05', 68, 0),
(9489, 1, '2024-11-08 19:25:45', 68, 0),
(9490, 2, '2024-11-08 19:26:21', 68, 0),
(9491, 0, '2024-11-08 19:27:06', 68, 0),
(9492, 0, '2024-11-08 19:31:35', 68, 0),
(9493, 0, '2024-11-08 19:34:28', 68, 0),
(9494, 0, '2024-11-08 19:44:12', 68, 0),
(9495, 0, '2024-11-08 19:50:30', 68, 0),
(9496, 0, '2024-11-08 19:52:05', 68, 0),
(9497, 0, '2024-11-08 19:56:22', 68, 0),
(9498, 0, '2024-11-08 19:58:07', 68, 0),
(9499, 0, '2024-11-08 19:59:28', 68, 0),
(9500, 0, '2024-11-08 20:00:00', 68, 0),
(9501, 0, '2024-11-08 20:00:27', 68, 0),
(9502, 0, '2024-11-08 20:01:53', 68, 0),
(9503, 3, '2024-11-09 13:33:34', 68, 0),
(9504, 6, '2024-11-09 13:37:20', 68, 0),
(9505, 5, '2024-11-09 14:08:09', 68, 0),
(9506, 4, '2024-11-09 14:24:53', 68, 0),
(9507, 9, '2024-11-09 14:28:56', 68, 0),
(9508, 1, '2024-11-09 14:53:14', 68, 0),
(9509, 1, '2024-11-09 15:02:02', 68, 0),
(9510, 0, '2024-11-09 15:06:19', 68, 0),
(9511, 0, '2024-11-09 15:07:20', 68, 0),
(9512, 1, '2024-11-09 15:08:50', 68, 0),
(9513, 0, '2024-11-09 15:09:29', 68, 0),
(9514, 0, '2024-11-09 15:10:39', 68, 0),
(9515, 0, '2024-11-09 15:12:24', 68, 0),
(9516, 0, '2024-11-09 15:12:49', 68, 0),
(9517, 4, '2024-11-09 15:13:41', 68, 0),
(9518, 0, '2024-11-09 15:14:52', 68, 0),
(9519, 0, '2024-11-09 15:15:08', 68, 0),
(9520, 0, '2024-11-09 15:16:19', 68, 0),
(9521, 0, '2024-11-09 15:17:04', 68, 0),
(9522, 0, '2024-11-09 15:17:17', 68, 0),
(9523, 0, '2024-11-09 15:19:05', 68, 0),
(9524, 1, '2024-11-09 15:19:50', 68, 0),
(9525, 0, '2024-11-09 15:21:50', 68, 0),
(9526, 0, '2024-11-09 15:22:33', 68, 0),
(9527, 0, '2024-11-09 15:23:41', 68, 0),
(9528, 0, '2024-11-09 15:25:15', 68, 0),
(9529, 0, '2024-11-09 15:25:29', 68, 0),
(9530, 0, '2024-11-09 15:28:53', 68, 0),
(9531, 0, '2024-11-09 15:29:43', 68, 0),
(9532, 2, '2024-11-09 15:30:09', 68, 0),
(9533, 16, '2024-11-09 15:35:59', 68, 0),
(9534, 4, '2024-11-10 18:21:39', 68, 0),
(9535, 0, '2024-11-11 14:58:22', 68, 0),
(9536, 1, '2024-11-11 15:05:02', 68, 0),
(9537, 2, '2024-11-11 15:05:57', 68, 0),
(9538, 1, '2024-11-11 15:07:34', 68, 0),
(9539, 5, '2024-11-11 15:09:23', 68, 0),
(9540, 2, '2024-11-11 15:10:49', 68, 0),
(9541, 3, '2024-11-11 15:13:20', 68, 0),
(9542, 3, '2024-11-11 15:14:30', 68, 0),
(9543, 1, '2024-11-14 14:11:38', 68, 0),
(9544, 0, '2024-11-14 14:21:56', 68, 0),
(9545, 0, '2024-11-14 14:22:06', 68, 0),
(9546, 0, '2024-11-14 14:22:16', 68, 0),
(9547, 3, '2024-11-14 14:24:14', 68, 0),
(9548, 2, '2024-11-14 14:58:49', 68, 0),
(9549, 0, '2024-11-14 15:04:20', 68, 0),
(9550, 2, '2024-11-14 15:07:06', 68, 0),
(9551, 2, '2024-11-14 15:08:54', 68, 0),
(9552, 0, '2024-11-14 15:09:26', 68, 0),
(9553, 2, '2024-11-14 15:09:51', 68, 0),
(9554, 2, '2024-11-14 15:14:31', 68, 0),
(9555, 4, '2024-11-14 15:17:28', 68, 0),
(9556, 3, '2024-11-14 15:17:52', 68, 0),
(9557, 4, '2024-11-14 15:18:16', 68, 0),
(9558, 2, '2024-11-14 15:22:42', 68, 0),
(9559, 0, '2024-11-14 15:29:14', 68, 0),
(9560, 3, '2024-11-14 15:29:32', 68, 0),
(9561, 1, '2024-11-14 15:30:18', 68, 0),
(9562, 0, '2024-11-14 15:32:45', 68, 0),
(9563, 2, '2024-11-14 15:33:00', 68, 0),
(9564, 0, '2024-11-15 20:07:42', 68, 0),
(9565, 0, '2024-11-15 21:30:58', 68, 0),
(9566, 0, '2024-11-21 16:23:00', 68, 0),
(9567, 1, '2024-11-21 16:25:11', 68, 0),
(9568, 0, '2024-11-21 16:25:57', 68, 0),
(9569, 1, '2024-11-21 16:27:55', 68, 0),
(9570, 2, '2024-11-21 16:29:17', 68, 0),
(9571, 0, '2024-11-21 16:32:19', 68, 0),
(9572, 2, '2024-11-21 16:34:12', 68, 0),
(9573, 1, '2024-11-21 16:39:32', 68, 0),
(9574, 1, '2024-11-21 16:40:09', 68, 0),
(9575, 0, '2024-11-21 16:41:17', 68, 0),
(9576, 0, '2024-11-21 16:42:47', 68, 0),
(9577, 1, '2024-11-21 16:44:44', 68, 0),
(9578, 0, '2024-11-21 17:18:26', 68, 0),
(9579, 2, '2024-11-21 17:19:26', 68, 0),
(9580, 3, '2024-11-21 17:22:15', 68, 0),
(9581, 3, '2024-11-21 17:22:54', 68, 0),
(9582, 0, '2024-11-21 17:30:20', 68, 0),
(9583, 0, '2024-11-21 17:30:43', 68, 0),
(9584, 0, '2024-11-21 17:31:56', 68, 0),
(9585, 0, '2024-11-21 17:32:29', 68, 0),
(9586, 0, '2024-11-21 17:34:59', 68, 0),
(9587, 0, '2024-11-21 17:35:14', 68, 0),
(9588, 0, '2024-11-21 17:36:48', 68, 0),
(9589, 0, '2024-11-21 17:37:03', 68, 0),
(9590, 0, '2024-11-21 17:38:02', 68, 0),
(9591, 0, '2024-11-21 17:38:57', 68, 0),
(9592, 0, '2024-11-21 17:40:43', 68, 0),
(9593, 0, '2024-11-21 17:43:59', 68, 0),
(9594, 0, '2024-11-21 17:44:44', 68, 0),
(9595, 0, '2024-11-21 17:45:18', 68, 0),
(9596, 0, '2024-11-21 17:46:51', 68, 0),
(9597, 0, '2024-11-21 17:48:47', 68, 0),
(9598, 0, '2024-11-21 17:49:11', 68, 0),
(9599, 0, '2024-11-21 17:56:06', 68, 0),
(9600, 0, '2024-11-21 17:59:49', 68, 0),
(9601, 0, '2024-11-21 18:02:57', 68, 0),
(9602, 0, '2024-11-21 18:04:18', 68, 0),
(9603, 0, '2024-11-21 18:05:28', 68, 0),
(9604, 0, '2024-11-21 18:06:12', 68, 0),
(9605, 0, '2024-11-21 18:10:05', 68, 0),
(9606, 0, '2024-11-21 18:10:30', 68, 0),
(9607, 0, '2024-11-21 18:12:40', 68, 0),
(9608, 0, '2024-11-21 18:12:57', 68, 0),
(9609, 0, '2024-11-21 18:14:07', 68, 0),
(9610, 0, '2024-11-21 18:14:44', 68, 0),
(9611, 0, '2024-11-21 18:15:05', 68, 0),
(9612, 0, '2024-11-21 20:06:26', 68, 0),
(9613, 0, '2024-11-21 20:11:07', 68, 0),
(9614, 0, '2024-11-21 20:11:22', 68, 0),
(9615, 0, '2024-11-21 20:11:41', 68, 0),
(9616, 0, '2024-11-21 20:12:01', 68, 0),
(9617, 0, '2024-11-21 20:12:27', 68, 0),
(9618, 0, '2024-11-21 20:12:58', 68, 0),
(9619, 0, '2024-11-21 20:14:00', 68, 0),
(9620, 0, '2024-11-21 20:15:43', 68, 0),
(9621, 0, '2024-11-21 20:16:38', 68, 0),
(9622, 0, '2024-11-21 20:21:52', 68, 0),
(9623, 0, '2024-11-21 20:22:16', 68, 0),
(9624, 0, '2024-11-21 20:23:05', 68, 0),
(9625, 0, '2024-11-21 20:23:52', 68, 0),
(9626, 0, '2024-11-21 20:24:12', 68, 0),
(9627, 0, '2024-11-21 20:24:35', 68, 0),
(9628, 0, '2024-11-21 20:25:32', 68, 0),
(9629, 0, '2024-11-21 20:26:14', 68, 0),
(9630, 0, '2024-11-21 20:26:51', 68, 0),
(9631, 2, '2024-11-21 20:28:54', 68, 0),
(9632, 0, '2024-11-21 20:30:00', 68, 0),
(9633, 0, '2024-11-21 20:31:37', 68, 0),
(9634, 0, '2024-11-21 20:33:59', 68, 0),
(9635, 0, '2024-11-21 20:34:19', 68, 0),
(9636, 0, '2024-11-21 20:35:05', 68, 0),
(9637, 2, '2024-11-21 20:38:15', 68, 0),
(9638, 0, '2024-11-21 20:43:22', 68, 0),
(9639, 0, '2024-11-21 20:43:46', 68, 0),
(9640, 0, '2024-11-21 20:44:23', 68, 0),
(9641, 0, '2024-11-21 20:45:06', 68, 0),
(9642, 0, '2024-11-21 20:45:25', 68, 0),
(9643, 0, '2024-11-21 20:45:50', 68, 0),
(9644, 0, '2024-11-21 20:46:23', 68, 0),
(9645, 0, '2024-11-21 20:47:22', 68, 0),
(9646, 5, '2024-11-21 20:47:59', 68, 0),
(9647, 5, '2024-11-21 20:55:24', 68, 0),
(9648, 1, '2024-11-21 20:59:57', 68, 0),
(9649, 0, '2024-11-21 21:07:01', 68, 0),
(9650, 2, '2024-11-21 21:09:09', 68, 0),
(9651, 0, '2024-11-21 21:49:15', 68, 0),
(9652, 0, '2024-11-21 21:51:52', 68, 0),
(9653, 2, '2024-11-22 15:08:40', 68, 0),
(9654, 2, '2024-11-22 15:44:35', 68, 0),
(9655, 0, '2024-11-22 15:47:31', 68, 0),
(9656, 8, '2024-11-22 16:04:45', 68, 0),
(9657, 3, '2024-11-22 16:13:43', 68, 0),
(9658, 9, '2024-11-22 16:25:00', 77, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `preguntas`
--

CREATE TABLE `preguntas` (
  `id` int(11) NOT NULL,
  `pregunta` varchar(255) NOT NULL,
  `estado` tinyint(1) NOT NULL,
  `idUsuario` int(11) DEFAULT NULL,
  `idCategoria` int(11) DEFAULT NULL,
  `verificado` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `preguntas`
--

INSERT INTO `preguntas` (`id`, `pregunta`, `estado`, `idUsuario`, `idCategoria`, `verificado`) VALUES
(1, '¿Campeon mundial 2022?', 1, 68, 4, 'aprobado'),
(2, '¿Quién fue el primer presidente de EE.UU?', 0, 68, 2, 'aprobado'),
(3, '¿Qué es la fotosíntesis?', 1, 68, 3, 'aprobado'),
(34, '¿Cuál es el planeta más grande del sistema solar?', 1, 68, 1, 'aprobado'),
(35, '¿Quién escribió \"Don Quijote de la Mancha\"?', 1, 68, 5, 'aprobado'),
(36, '¿Qué elemento químico tiene el símbolo \"O\"?', 1, 68, 3, 'aprobado'),
(37, '¿Cuál es el océano más grande del mundo?', 1, 68, 1, 'aprobado'),
(38, '¿En qué año cayó el muro de Berlín?', 1, 68, 2, 'aprobado'),
(39, '¿Qué país ganó la Copa Mundial de Fútbol 2018?', 1, 68, 4, 'aprobado'),
(40, '¿Quién pintó la \"Mona Lisa\"?', 1, 68, 5, 'aprobado'),
(41, '¿Qué idioma se habla en Brasil?', 1, 68, 1, 'aprobado'),
(42, '¿Qué número romano representa el 100?', 0, 68, 3, 'aprobado'),
(43, '¿Qué gas es esencial para la respiración humana?', 1, 68, 3, 'aprobado'),
(44, '¿Cuál es el río más largo del mundo?', 1, 68, 1, 'aprobado'),
(45, '¿Quién desarrolló la teoría de la relatividad?', 0, 68, 3, 'aprobado'),
(46, '¿Qué es el \"Big Bang\"?', 1, 68, 3, 'aprobado'),
(47, '¿En qué país se encuentra la Torre Eiffel?', 1, 68, 1, 'aprobado'),
(48, '¿Qué es la fuerza de gravedad?', 1, 68, 3, 'aprobado'),
(75, 'Quien es el mejor jugador del mundo?', 0, 68, 2, 'aprobado'),
(77, 'Campeon champions 2022?', 1, 74, 4, 'aprobado'),
(80, 'Quien es el mejor jugador del mundo?', 0, 77, 4, 'rechazada'),
(81, 'Quien es el mejor jugador del mundo?', 0, 77, 3, 'rechazada');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reporte`
--

CREATE TABLE `reporte` (
  `id` int(11) NOT NULL,
  `idPregunta` int(11) DEFAULT NULL,
  `idUsuarioReporte` int(11) DEFAULT NULL,
  `detalleReporte` varchar(255) DEFAULT NULL,
  `verificado` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `reporte`
--

INSERT INTO `reporte` (`id`, `idPregunta`, `idUsuarioReporte`, `detalleReporte`, `verificado`) VALUES
(10, 41, 68, 'horrible', 'rechazado'),
(11, 45, 68, 'ZZZZ', 'aprobado');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `respuesta`
--

CREATE TABLE `respuesta` (
  `id` int(11) NOT NULL,
  `preguntaID` int(11) DEFAULT NULL,
  `opcionID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `respuesta`
--

INSERT INTO `respuesta` (`id`, `preguntaID`, `opcionID`) VALUES
(1, 1, 1),
(2, 2, 5),
(3, 3, 10),
(4, 34, 14),
(5, 35, 19),
(6, 36, 24),
(7, 37, 27),
(8, 38, 31),
(9, 39, 35),
(10, 40, 38),
(11, 41, 41),
(12, 42, 46),
(13, 43, 50),
(14, 44, 54),
(15, 45, 58),
(16, 46, 62),
(17, 47, 66),
(18, 48, 71),
(31, 75, 148),
(33, 77, 155),
(36, 80, 165),
(37, 81, 172);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `id` int(11) NOT NULL,
  `nombre` varchar(20) NOT NULL,
  `apellido` varchar(20) NOT NULL,
  `usuario` varchar(20) NOT NULL,
  `genero` varchar(20) NOT NULL,
  `email` varchar(60) NOT NULL,
  `password` varchar(20) NOT NULL,
  `estado` tinyint(1) NOT NULL,
  `token` int(6) NOT NULL,
  `puntaje` int(11) NOT NULL,
  `fotoPerfil` varchar(255) NOT NULL,
  `admin` tinyint(1) NOT NULL,
  `editor` tinyint(1) NOT NULL,
  `ciudad` varchar(255) NOT NULL,
  `pais` varchar(255) NOT NULL,
  `created_at` date NOT NULL DEFAULT current_timestamp(),
  `fecha_nacimiento` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`id`, `nombre`, `apellido`, `usuario`, `genero`, `email`, `password`, `estado`, `token`, `puntaje`, `fotoPerfil`, `admin`, `editor`, `ciudad`, `pais`, `created_at`, `fecha_nacimiento`) VALUES
(68, 'Lautaro', 'Gerez', 'lautigrz', 'M', 'lautarogerezz12@gmail.com', '123', 1, 681159, 269, './public/image/perfil/lautigrz.jpg', 0, 0, '', 'Uruguay', '2024-11-14', '2005-07-20'),
(70, 'lionel', 'scaloni', 'scaloni10', 'F', 'sca@gmial.com', '123', 1, 432768, 4, './public/image/perfil/scaloni10.jpg', 0, 0, '', 'Chile', '2024-10-15', '1998-10-15'),
(73, 'admin', 'admin', 'admin', 'M', 'admin@gmail.com', 'admin', 1, 300048, 0, './public/image/perfil/chad123.jpg', 1, 0, '', 'Chile', '2024-07-10', '1990-05-05'),
(74, 'editor', 'editor', 'editor', 'F', 'editor@gmail.com', 'editor', 1, 369750, 0, './public/image/perfil/messi.jpg', 0, 1, '', 'Paraguay', '2023-07-16', '1945-10-15'),
(76, 'melany', 'sidero', 'melany122', 'F', 'gerez.lautaro12@gmail.com', '123', 1, 144803, 18, './public/image/perfil/melany122.jpg', 0, 0, '', 'Brasil', '2022-01-20', '1999-07-01'),
(77, 'messi', 'messi', 'lionelmessi', 'M', 'messi@gmail.com', '123', 1, 865539, 16, './public/image/perfil/lionelmessi.jpg', 0, 0, '', 'Argentina', '2024-05-22', '1994-03-02'),
(78, 'chad', 'chad', 'chad09', 'F', 'chade@gmail.com', '123', 1, 850298, 7, './public/image/perfil/chad09.jpg', 0, 0, '', 'Uruguay', '2024-09-22', '2001-12-20'),
(79, 'bixsor', 'bix', 'bixx12', 'M', 'bix@gmail.com', '123', 1, 759712, 15, './public/image/perfil/bixx12.jpg', 0, 0, '', 'Brasil', '2024-04-02', '1993-01-20'),
(80, 'diss', 'cot', 'cot23', 'F', 'cot@gmail.com', '123', 1, 222121, 4, './public/image/perfil/cot23.jpg', 0, 0, '', 'Brasil', '2024-01-31', '1987-05-12'),
(82, 'totti', 'Rugna', 'chouny1109', 'M', 'joni.rugna@gmail.com', '123', 1, 462194, 0, './public/image/perfil/chouny1109.jpeg', 0, 0, 'Isidro Casanova', 'Argentina', '2024-10-18', '1997-10-10'),
(83, 'asddas', 'asdsda', 'saddd', 'M', 'dddd@gmail.com', '221', 0, 516868, 0, '', 0, 0, 'González Catán', 'Argentina', '2024-11-18', '2002-05-03');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `categoria`
--
ALTER TABLE `categoria`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `dificultad`
--
ALTER TABLE `dificultad`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `historico`
--
ALTER TABLE `historico`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `notificacion`
--
ALTER TABLE `notificacion`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idUsuario` (`idUsuario`);

--
-- Indices de la tabla `opciones`
--
ALTER TABLE `opciones`
  ADD PRIMARY KEY (`id`),
  ADD KEY `preguntaID` (`preguntaID`);

--
-- Indices de la tabla `partida`
--
ALTER TABLE `partida`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idUsuario` (`idUsuario`);

--
-- Indices de la tabla `preguntas`
--
ALTER TABLE `preguntas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idUsuario` (`idUsuario`),
  ADD KEY `idCategoria` (`idCategoria`);

--
-- Indices de la tabla `reporte`
--
ALTER TABLE `reporte`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idPregunta` (`idPregunta`),
  ADD KEY `idUsuarioReporte` (`idUsuarioReporte`);

--
-- Indices de la tabla `respuesta`
--
ALTER TABLE `respuesta`
  ADD PRIMARY KEY (`id`),
  ADD KEY `opcionID` (`opcionID`),
  ADD KEY `preguntaID` (`preguntaID`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `usuario` (`usuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `categoria`
--
ALTER TABLE `categoria`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `dificultad`
--
ALTER TABLE `dificultad`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=117;

--
-- AUTO_INCREMENT de la tabla `historico`
--
ALTER TABLE `historico`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1446;

--
-- AUTO_INCREMENT de la tabla `notificacion`
--
ALTER TABLE `notificacion`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT de la tabla `opciones`
--
ALTER TABLE `opciones`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=173;

--
-- AUTO_INCREMENT de la tabla `partida`
--
ALTER TABLE `partida`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9659;

--
-- AUTO_INCREMENT de la tabla `preguntas`
--
ALTER TABLE `preguntas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=82;

--
-- AUTO_INCREMENT de la tabla `reporte`
--
ALTER TABLE `reporte`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `respuesta`
--
ALTER TABLE `respuesta`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=84;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `notificacion`
--
ALTER TABLE `notificacion`
  ADD CONSTRAINT `notificacion_ibfk_1` FOREIGN KEY (`idUsuario`) REFERENCES `usuario` (`id`);

--
-- Filtros para la tabla `opciones`
--
ALTER TABLE `opciones`
  ADD CONSTRAINT `opciones_ibfk_1` FOREIGN KEY (`preguntaID`) REFERENCES `preguntas` (`id`);

--
-- Filtros para la tabla `partida`
--
ALTER TABLE `partida`
  ADD CONSTRAINT `partida_ibfk_1` FOREIGN KEY (`idUsuario`) REFERENCES `usuario` (`id`);

--
-- Filtros para la tabla `preguntas`
--
ALTER TABLE `preguntas`
  ADD CONSTRAINT `preguntas_ibfk_1` FOREIGN KEY (`idUsuario`) REFERENCES `usuario` (`id`),
  ADD CONSTRAINT `preguntas_ibfk_2` FOREIGN KEY (`idCategoria`) REFERENCES `categoria` (`id`);

--
-- Filtros para la tabla `reporte`
--
ALTER TABLE `reporte`
  ADD CONSTRAINT `reporte_ibfk_1` FOREIGN KEY (`idPregunta`) REFERENCES `preguntas` (`id`),
  ADD CONSTRAINT `reporte_ibfk_2` FOREIGN KEY (`idUsuarioReporte`) REFERENCES `usuario` (`id`);

--
-- Filtros para la tabla `respuesta`
--
ALTER TABLE `respuesta`
  ADD CONSTRAINT `respuesta_ibfk_1` FOREIGN KEY (`opcionID`) REFERENCES `opciones` (`id`),
  ADD CONSTRAINT `respuesta_ibfk_2` FOREIGN KEY (`preguntaID`) REFERENCES `preguntas` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
