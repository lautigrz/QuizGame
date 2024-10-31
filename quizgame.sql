-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 31-10-2024 a las 17:02:16
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
  `veces_vista` int(11) NOT NULL,
  `porcentaje_acierto` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `dificultad`
--

INSERT INTO `dificultad` (`id`, `idUsuario`, `idPregunta`, `veces_correctas`, `veces_vista`, `porcentaje_acierto`) VALUES
(27, 68, 42, 16, 22, 72.727272727273),
(28, 68, 34, 12, 15, 80),
(29, 68, 44, 14, 20, 70),
(30, 68, 39, 10, 14, 71.428571428571),
(31, 68, 41, 16, 23, 69.565217391304),
(32, 68, 1, 15, 22, 68.181818181818),
(33, 68, 40, 15, 21, 71.428571428571),
(34, 68, 2, 11, 15, 73.333333333333),
(35, 68, 45, 11, 17, 64.705882352941),
(36, 68, 38, 14, 19, 73.684210526316),
(37, 68, 46, 11, 15, 73.333333333333),
(38, 68, 47, 14, 18, 77.777777777778),
(39, 68, 37, 11, 15, 73.333333333333),
(40, 68, 48, 13, 16, 81.25),
(41, 68, 36, 13, 18, 72.222222222222),
(42, 68, 3, 11, 15, 73.333333333333),
(43, 68, 35, 10, 14, 71.428571428571),
(44, 68, 43, 12, 15, 80),
(45, 76, 39, 2, 3, 66.666666666667),
(46, 76, 1, 2, 2, 100),
(47, 76, 3, 2, 7, 28.571428571429),
(48, 76, 37, 2, 5, 40),
(49, 76, 2, 2, 2, 100),
(50, 76, 42, 1, 3, 33.333333333333),
(51, 76, 48, 3, 3, 100),
(52, 76, 40, 1, 2, 50),
(53, 76, 38, 2, 2, 100),
(54, 76, 47, 1, 2, 50),
(55, 76, 35, 2, 2, 100),
(56, 76, 43, 3, 3, 100),
(57, 76, 46, 5, 5, 100),
(58, 76, 44, 1, 2, 50),
(59, 76, 41, 1, 3, 33.333333333333),
(60, 76, 45, 2, 2, 100),
(61, 76, 34, 1, 2, 50),
(62, 76, 36, 2, 3, 66.666666666667);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `historico`
--

CREATE TABLE `historico` (
  `id` int(11) NOT NULL,
  `idUsuario` int(11) NOT NULL,
  `idPregunta` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `historico`
--

INSERT INTO `historico` (`id`, `idUsuario`, `idPregunta`) VALUES
(844, 68, 36),
(845, 68, 38),
(846, 68, 41),
(847, 68, 44),
(848, 68, 45),
(849, 68, 1);

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
(1, 1, 'París'),
(2, 1, 'Madrid'),
(3, 1, 'Roma'),
(4, 1, 'Londres'),
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
(72, 48, 'La energía solar');

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
(200, 5, '2024-10-31 16:59:39', 68, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `preguntas`
--

CREATE TABLE `preguntas` (
  `id` int(11) NOT NULL,
  `pregunta` varchar(255) NOT NULL,
  `estado` tinyint(1) NOT NULL,
  `idUsuario` int(11) DEFAULT NULL,
  `idCategoria` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `preguntas`
--

INSERT INTO `preguntas` (`id`, `pregunta`, `estado`, `idUsuario`, `idCategoria`) VALUES
(1, '¿Cuál es la capital de Francia?', 1, 68, 1),
(2, '¿Quién fue el primer presidente de EE.UU?', 1, 68, 2),
(3, '¿Qué es la fotosíntesis?', 1, 68, 3),
(34, '¿Cuál es el planeta más grande del sistema solar?', 1, 68, 1),
(35, '¿Quién escribió \"Don Quijote de la Mancha\"?', 1, 68, 5),
(36, '¿Qué elemento químico tiene el símbolo \"O\"?', 1, 68, 3),
(37, '¿Cuál es el océano más grande del mundo?', 1, 68, 1),
(38, '¿En qué año cayó el muro de Berlín?', 1, 68, 2),
(39, '¿Qué país ganó la Copa Mundial de Fútbol 2018?', 1, 68, 4),
(40, '¿Quién pintó la \"Mona Lisa\"?', 1, 68, 5),
(41, '¿Qué idioma se habla en Brasil?', 1, 68, 1),
(42, '¿Qué número romano representa el 100?', 1, 68, 3),
(43, '¿Qué gas es esencial para la respiración humana?', 1, 68, 3),
(44, '¿Cuál es el río más largo del mundo?', 1, 68, 1),
(45, '¿Quién desarrolló la teoría de la relatividad?', 1, 68, 3),
(46, '¿Qué es el \"Big Bang\"?', 1, 68, 3),
(47, '¿En qué país se encuentra la Torre Eiffel?', 1, 68, 1),
(48, '¿Qué es la fuerza de gravedad?', 1, 68, 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reporte`
--

CREATE TABLE `reporte` (
  `id` int(11) NOT NULL,
  `idPregunta` int(11) DEFAULT NULL,
  `idUsuarioReporte` int(11) DEFAULT NULL,
  `detalleReporte` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `reporte`
--

INSERT INTO `reporte` (`id`, `idPregunta`, `idUsuarioReporte`, `detalleReporte`) VALUES
(3, 46, 68, 'asd'),
(4, 39, 68, 'nose');

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
(18, 48, 71);

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
  `editor` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`id`, `nombre`, `apellido`, `usuario`, `genero`, `email`, `password`, `estado`, `token`, `puntaje`, `fotoPerfil`, `admin`, `editor`) VALUES
(68, 'Lautaro', 'Gerez', 'lautigrz', 'M', 'lautarogerezz12@gmail.com', '123', 1, 681159, 97, '', 0, 0),
(70, '', '', '', '', '', '', 0, 432768, 0, '', 0, 0),
(73, 'admin', 'admin', 'admin', 'M', 'admin@gmail.com', 'admin', 1, 300048, 0, './public/image/perfil/chad123.jpg', 1, 0),
(74, 'editor', 'editor', 'editor', 'F', 'editor@gmail.com', 'editor', 1, 369750, 0, './public/image/perfil/messi.jpg', 0, 1),
(76, 'melany', 'sidero', 'melany122', 'F', 'gerez.lautaro12@gmail.com', '123', 1, 144803, 0, './public/image/perfil/melany122.jpg', 0, 0);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;

--
-- AUTO_INCREMENT de la tabla `historico`
--
ALTER TABLE `historico`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=850;

--
-- AUTO_INCREMENT de la tabla `opciones`
--
ALTER TABLE `opciones`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=73;

--
-- AUTO_INCREMENT de la tabla `partida`
--
ALTER TABLE `partida`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=201;

--
-- AUTO_INCREMENT de la tabla `preguntas`
--
ALTER TABLE `preguntas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT de la tabla `reporte`
--
ALTER TABLE `reporte`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `respuesta`
--
ALTER TABLE `respuesta`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=77;

--
-- Restricciones para tablas volcadas
--

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
