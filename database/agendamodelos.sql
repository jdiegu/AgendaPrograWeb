-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 13-05-2025 a las 20:30:10
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
-- Base de datos: `agendamodelos`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `contactos`
--

CREATE TABLE `contactos` (
  `id_contacto` smallint(6) NOT NULL,
  `apPaterno` varchar(20) NOT NULL,
  `apMaterno` varchar(20) NOT NULL,
  `nombre` varchar(20) NOT NULL,
  `numero` varchar(20) NOT NULL,
  `direccion` varchar(50) NOT NULL,
  `email` varchar(30) NOT NULL,
  `clave_usuario` smallint(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `contactos`
--

INSERT INTO `contactos` (`id_contacto`, `apPaterno`, `apMaterno`, `nombre`, `numero`, `direccion`, `email`, `clave_usuario`) VALUES
(4, 'Morales', 'Vazquez', 'Diegu1', '2717069225', 'Yanga,Ver2', 'correo@gmail.com2', 2),
(5, 'Carreon', 'Nuñez', 'James', '2717908978', 'Nogales', 'correo@gmail.com', 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `clave_usuario` smallint(6) NOT NULL,
  `apPaterno` varchar(20) NOT NULL,
  `apMaterno` varchar(20) NOT NULL,
  `nombre` varchar(20) NOT NULL,
  `contrasena` varchar(16) NOT NULL,
  `tipo_usuario` smallint(6) NOT NULL COMMENT '0=Visualizador 1=Admin'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`clave_usuario`, `apPaterno`, `apMaterno`, `nombre`, `contrasena`, `tipo_usuario`) VALUES
(1, 'Morales', 'Vazquez', 'Diego', '1234', 1),
(2, 'Van', 'Gogh', 'Vincent', 'abcd', 0);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `contactos`
--
ALTER TABLE `contactos`
  ADD PRIMARY KEY (`id_contacto`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`clave_usuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `contactos`
--
ALTER TABLE `contactos`
  MODIFY `id_contacto` smallint(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `clave_usuario` smallint(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
