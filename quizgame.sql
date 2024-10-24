-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 25-10-2024 a las 01:18:46
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
  `color` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `categoria`
--

INSERT INTO `categoria` (`id`, `descripcion`, `color`) VALUES
(1, 'Geografía', '#ff0000'),
(2, 'Historia', '#00ff00'),
(3, 'Ciencia', '#0000ff');

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
  `idUsuario` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `partida`
--

INSERT INTO `partida` (`id`, `puntaje_obtenido`, `fecha_partida`, `idUsuario`) VALUES
(51, 2, '0000-00-00 00:00:00', 68),
(52, 0, '0000-00-00 00:00:00', 68),
(53, 3, '0000-00-00 00:00:00', 68),
(54, 0, '0000-00-00 00:00:00', 68);

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
(35, '¿Quién escribió \"Don Quijote de la Mancha\"?', 1, 68, 1),
(36, '¿Qué elemento químico tiene el símbolo \"O\"?', 1, 68, 1),
(37, '¿Cuál es el océano más grande del mundo?', 1, 68, 1),
(38, '¿En qué año cayó el muro de Berlín?', 1, 68, 1),
(39, '¿Qué país ganó la Copa Mundial de Fútbol 2018?', 1, 68, 1),
(40, '¿Quién pintó la \"Mona Lisa\"?', 1, 68, 1),
(41, '¿Qué idioma se habla en Brasil?', 1, 68, 1),
(42, '¿Qué número romano representa el 100?', 1, 68, 1),
(43, '¿Qué gas es esencial para la respiración humana?', 1, 68, 1),
(44, '¿Cuál es el río más largo del mundo?', 1, 68, 1),
(45, '¿Quién desarrolló la teoría de la relatividad?', 1, 68, 1),
(46, '¿Qué es el \"Big Bang\"?', 1, 68, 1),
(47, '¿En qué país se encuentra la Torre Eiffel?', 1, 68, 1),
(48, '¿Qué es la fuerza de gravedad?', 1, 68, 1);

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
  `puntaje` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`id`, `nombre`, `apellido`, `usuario`, `genero`, `email`, `password`, `estado`, `token`, `puntaje`) VALUES
(65, 'dddd', 'dasdasd', 'dsadwe', 'masculino', 'laati@mail.3a88.dev', '123', 1, 794238, 0),
(67, 'ads', 'sddsa', 'asddsa', 'M', 'ggg@gmail.com', '123', 0, 859813, 0),
(68, 'Lautaro', 'Gerez', 'lautigrz', 'M', 'lautarogerezz12@gmail.com', '123', 1, 681159, 5);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `categoria`
--
ALTER TABLE `categoria`
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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `opciones`
--
ALTER TABLE `opciones`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=73;

--
-- AUTO_INCREMENT de la tabla `partida`
--
ALTER TABLE `partida`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT de la tabla `preguntas`
--
ALTER TABLE `preguntas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT de la tabla `respuesta`
--
ALTER TABLE `respuesta`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=70;

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
-- Filtros para la tabla `respuesta`
--
ALTER TABLE `respuesta`
  ADD CONSTRAINT `respuesta_ibfk_1` FOREIGN KEY (`opcionID`) REFERENCES `opciones` (`id`),
  ADD CONSTRAINT `respuesta_ibfk_2` FOREIGN KEY (`preguntaID`) REFERENCES `preguntas` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
