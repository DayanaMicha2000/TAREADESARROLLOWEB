-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 23-05-2025 a las 02:58:59
-- Versión del servidor: 10.4.22-MariaDB
-- Versión de PHP: 8.1.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `cursos_online`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cursos`
--

CREATE TABLE `cursos` (
  `id_curso` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `descripcion` text DEFAULT NULL,
  `fecha_inicio` date NOT NULL,
  `fecha_fin` date NOT NULL,
  `cupos` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `cursos`
--

INSERT INTO `cursos` (`id_curso`, `nombre`, `descripcion`, `fecha_inicio`, `fecha_fin`, `cupos`) VALUES
(1, 'Matemáticas', 'Las matemáticas son la ciencia que estudia las relaciones entre cantidades, magnitudes y propiedades, así como las operaciones lógicas para deducir cantidades y propiedades desconocidas. Se han utilizado para estudiar, describir y analizar fenómenos de la vida cotidiana y de otras ciencias. ', '2025-05-01', '2025-08-07', 51),
(2, 'Física ', 'La física es la ciencia que estudia el universo, incluyendo la materia, la energía, el espacio y el tiempo, y sus interacciones. Busca comprender los fenómenos naturales a través de leyes y principios fundamentales, utilizando el método científico y las matemáticas como herramientas esenciales. ', '2025-05-01', '2025-07-17', 98),
(3, ' Bases de datos', 'Se enfoca en la gestión, organización y almacenamiento de información de forma estructurada y accesible. Implica aprender a diseñar, implementar, mantener y utilizar sistemas de bases de datos para la gestión de datos en diversas organizaciones y aplicaciones. ', '2025-05-19', '2025-07-11', 59);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `inscripciones`
--

CREATE TABLE `inscripciones` (
  `id_inscripcion` int(11) NOT NULL,
  `fecha_inscripcion` datetime NOT NULL DEFAULT current_timestamp(),
  `id_curso` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `inscripciones`
--

INSERT INTO `inscripciones` (`id_inscripcion`, `fecha_inscripcion`, `id_curso`, `id_usuario`) VALUES
(9, '2025-05-21 23:22:01', 2, 2),
(10, '2025-05-21 23:22:05', 3, 2),
(11, '2025-05-22 18:50:47', 2, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id_usuario` int(11) NOT NULL,
  `cedula` varchar(10) NOT NULL,
  `nombres` varchar(100) NOT NULL,
  `apellidos` varchar(100) NOT NULL,
  `pais` varchar(100) DEFAULT NULL,
  `ciudad` varchar(100) DEFAULT NULL,
  `telefono` varchar(10) DEFAULT NULL,
  `direccion` varchar(100) NOT NULL,
  `correo` varchar(50) NOT NULL,
  `usuario` varchar(100) NOT NULL,
  `contrasena` varchar(100) NOT NULL,
  `fecha_nacimiento` date DEFAULT NULL,
  `rol` enum('estudiante','admin') NOT NULL DEFAULT 'estudiante'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id_usuario`, `cedula`, `nombres`, `apellidos`, `pais`, `ciudad`, `telefono`, `direccion`, `correo`, `usuario`, `contrasena`, `fecha_nacimiento`, `rol`) VALUES
(1, '1111111111', 'DAYI', 'eee', 'EEEE', 'QQQQQ', '2222222222', 'ssss', 'Ddddd@gmail.com', 'MISHY', '123456', '2025-04-30', 'estudiante'),
(2, '4444444444', 'sssss', 'sssscv', 'dddddddd', 'dddd', '1111111666', 'eee', 'Ddddd@gmail.com', 'DAYA', '123', '2025-05-07', 'estudiante'),
(3, 'NNNNNNNNN', 'Admin', 'NNNNN', NULL, NULL, NULL, 'NNNN', 'NNNN@NNN.COM', 'Admin', 'Admin', NULL, 'admin'),
(5, '1251293030', 'FFFF', 'FFFFF', 'FFF', 'FFF', '2222222222', 'SSS', 'BBB@GMAIL.COM', 'DAYANA', '123456', '2025-02-24', 'estudiante');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `cursos`
--
ALTER TABLE `cursos`
  ADD PRIMARY KEY (`id_curso`);

--
-- Indices de la tabla `inscripciones`
--
ALTER TABLE `inscripciones`
  ADD PRIMARY KEY (`id_inscripcion`),
  ADD KEY `fk_inscripciones_id_usuario` (`id_usuario`),
  ADD KEY `fk_inscripciones_id_curso` (`id_curso`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id_usuario`),
  ADD UNIQUE KEY `cedula` (`cedula`),
  ADD UNIQUE KEY `usuario` (`usuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `cursos`
--
ALTER TABLE `cursos`
  MODIFY `id_curso` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `inscripciones`
--
ALTER TABLE `inscripciones`
  MODIFY `id_inscripcion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `inscripciones`
--
ALTER TABLE `inscripciones`
  ADD CONSTRAINT `fk_inscripciones_id_curso` FOREIGN KEY (`id_curso`) REFERENCES `cursos` (`id_curso`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_inscripciones_id_usuario` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
