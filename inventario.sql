-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 26-12-2023 a las 03:17:12
-- Versión del servidor: 10.4.28-MariaDB
-- Versión de PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `inventario`
--
CREATE DATABASE IF NOT EXISTS `inventario` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish2_ci;
USE `inventario`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoria`
--

CREATE TABLE `categoria` (
  `id_categoria` int(11) NOT NULL,
  `nombre_categoria` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

--
-- Volcado de datos para la tabla `categoria`
--

INSERT INTO `categoria` (`id_categoria`, `nombre_categoria`) VALUES
(1, 'CPU'),
(2, 'Monitor'),
(3, 'Notebook'),
(5, 'Impresora');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `equipos`
--

CREATE TABLE `equipos` (
  `id_equipo` int(11) NOT NULL,
  `equipo_activo` int(11) NOT NULL,
  `equipo_sector` varchar(100) NOT NULL,
  `equipo_piso` varchar(100) NOT NULL,
  `equipo_ubicacion` varchar(100) NOT NULL,
  `equipo_serie` varchar(100) NOT NULL,
  `equipo_marca` varchar(100) NOT NULL,
  `equipo_modelo` varchar(100) NOT NULL,
  `equipo_responsable` varchar(100) NOT NULL,
  `id_categoria` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

--
-- Volcado de datos para la tabla `equipos`
--

INSERT INTO `equipos` (`id_equipo`, `equipo_activo`, `equipo_sector`, `equipo_piso`, `equipo_ubicacion`, `equipo_serie`, `equipo_marca`, `equipo_modelo`, `equipo_responsable`, `id_categoria`) VALUES
(1, 12345, 'Bodega', 'Subsuelo', 'No aplica', 'MXL467JKL', 'HP', '280 G3', 'Desktop', 1),
(2, 12346, 'Bodega', 'Subsuelo', 'No aplica', 'LDC3789IOK09', 'Hp', 'LSD300', 'Desktop', 2),
(3, 12347, 'Bodega', 'Subsuelo', 'No aplica', '67YH90Z3W3', 'Dell', '14 300', 'Desktop', 3),
(4, 12348, 'Bodega', 'Subsuelo', 'No aplica', 'YUI890OLK', 'HP', 'Ink Tank 315', 'DEsktop', 5);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id_usuario` int(11) NOT NULL,
  `nombre_usuario` varchar(100) NOT NULL,
  `apellido_usuario` varchar(100) NOT NULL,
  `usuario_usuario` varchar(100) NOT NULL,
  `contrasena_usuario` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id_usuario`, `nombre_usuario`, `apellido_usuario`, `usuario_usuario`, `contrasena_usuario`) VALUES
(1, 'Administrador', 'Principal', 'administrador', '$2y$10$L0Rwp9jwZ1C3xrsRGf6w3u8RXs8lBgMVEWaQtl2QMxGwv6zR5bPC.'),
(2, 'Jose', 'Perez', 'perez.5@inventario.com', '$2y$10$3W2Ne4S.s2WcEnKclPd8jOmNHVT0yMOgLbIwiwtbqkbf8SMFKEPkW'),
(3, 'Maria', 'Gomez', 'gomez.9@inventario.com', '$2y$10$VRHzPbKTGKUtwCPn2cpU9u38d2WUoWtW284MXv56vN0Yat6.3Fj3K'),
(7, 'Patricia', 'Hormazabal', 'hormazabal.9@inventario.com', '$2y$10$gWHg6EQAWvEZUHpz4sNpL.ZgUw4NrtHUhc94mvau7Xtgeoni7AlOK'),
(8, 'Juan', 'Moreno', 'moreno.7@inventario', '$2y$10$IDkNzdCFR8iOpPespuElDONx9j5xA1Xg1.hNyYCo3Qf2WV1DInE5K');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `categoria`
--
ALTER TABLE `categoria`
  ADD PRIMARY KEY (`id_categoria`);

--
-- Indices de la tabla `equipos`
--
ALTER TABLE `equipos`
  ADD PRIMARY KEY (`id_equipo`),
  ADD KEY `id_categoria` (`id_categoria`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id_usuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `categoria`
--
ALTER TABLE `categoria`
  MODIFY `id_categoria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `equipos`
--
ALTER TABLE `equipos`
  MODIFY `id_equipo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
