-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 28-11-2023 a las 08:53:47
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
-- Base de datos: `carritocompra`
--
CREATE DATABASE IF NOT EXISTS `carritocompra` DEFAULT CHARACTER SET utf8 COLLATE utf8_spanish_ci;
USE `carritocompra`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedido`
--

CREATE TABLE `pedido` (
  `id` int(11) NOT NULL,
  `idusuario` int(11) NOT NULL,
  `idprod` int(11) NOT NULL,
  `total` decimal(10,0) NOT NULL,
  `fecha` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `pedido`
--

INSERT INTO `pedido` (`id`, `idusuario`, `idprod`, `total`, `fecha`) VALUES
(73, 26, 6, 55, '2023-11-25 11:58:41'),
(74, 26, 7, 150, '2023-11-25 11:58:53'),
(75, 26, 12, 45, '2023-11-25 11:58:56'),
(76, 27, 8, 50, '2023-11-25 12:00:28'),
(77, 27, 9, 40, '2023-11-25 12:00:31'),
(78, 27, 13, 40, '2023-11-25 12:00:34'),
(79, 31, 9, 40, '2023-11-25 12:11:24'),
(80, 31, 15, 35, '2023-11-25 12:11:27'),
(81, 26, 11, 65, '2023-11-28 08:30:32'),
(82, 26, 6, 110, '2023-11-28 08:41:00'),
(83, 27, 11, 65, '2023-11-28 08:45:30');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `idprod` int(11) NOT NULL,
  `nombreprod` varchar(250) NOT NULL,
  `imagenprod` varchar(250) NOT NULL,
  `precio` decimal(10,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`idprod`, `nombreprod`, `imagenprod`, `precio`) VALUES
(6, 'Zapatillas', 'zapatillas', 55),
(7, 'Chandal impermeable', 'chandal2', 75),
(8, 'Sudadera', 'chandal', 50),
(9, 'Sudadera impermeable', 'impermeable', 40),
(10, 'Zapatillas Nike', 'nike', 65),
(11, 'Zapatillas futbol sala', 'nike2', 65),
(12, 'Chaqueta ', 'sudadera', 45),
(13, 'Zapatillas camping', 'zapcamp', 40),
(14, 'Zapatillas ciclismo', 'zapciclismo', 75),
(15, 'Zapatillias footing', 'zapnegra', 35),
(17, 'Chandal adidas', 'adidas', 80);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `usuario` varchar(250) NOT NULL,
  `pass` varchar(100) NOT NULL,
  `roles` enum('cliente','administrador') DEFAULT 'cliente',
  `correo` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `usuario`, `pass`, `roles`, `correo`) VALUES
(25, 'Leonti', '81dc9bdb52d04dc20036dbd8313ed055', 'administrador', 'leonti@shon.com'),
(26, 'Jane Doe', 'a677049cbf351ae139fb13b85e0129a2', 'cliente', 'jane@doe.com'),
(27, 'John Doe', '558813098d0d0df9a9d19aaed8df75fd', 'cliente', 'jon@doe.com'),
(31, 'user3', '7da70de0a09a30b3b12d55e6c0416cec', 'cliente', 'user3@user.com');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `pedido`
--
ALTER TABLE `pedido`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pedido_idproducto_fk` (`idprod`),
  ADD KEY `pedido_idusuario_fk` (`idusuario`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`idprod`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `usuarios_usuario_pass` (`pass`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `pedido`
--
ALTER TABLE `pedido`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=84;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `idprod` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `pedido`
--
ALTER TABLE `pedido`
  ADD CONSTRAINT `pedido_idproducto_fk` FOREIGN KEY (`idprod`) REFERENCES `productos` (`idprod`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `pedido_idusuario_fk` FOREIGN KEY (`idusuario`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
