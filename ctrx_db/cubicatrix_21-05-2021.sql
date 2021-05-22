-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 21-05-2021 a las 16:11:35
-- Versión del servidor: 5.5.24-log
-- Versión de PHP: 5.4.3

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `cubicatrix`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ctrx_usuarios`
--

CREATE TABLE IF NOT EXISTS `ctrx_usuarios` (
  `rut` int(11) NOT NULL,
  `usuario` varchar(50) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `clave` varchar(255) NOT NULL,
  `bloqueado` int(1) NOT NULL DEFAULT '0',
  `admin` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`usuario`,`clave`,`bloqueado`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `ctrx_usuarios`
--

INSERT INTO `ctrx_usuarios` (`rut`, `usuario`, `nombre`, `clave`, `bloqueado`, `admin`) VALUES
(12480591, 'bcontreras', 'Beatriz Contreras', '202cb962ac59075b964b07152d234b70', 0, 0),
(18121512, 'drubilar', 'David Rubilar', '827ccb0eea8a706c4c34a16891f84e7b', 0, 1),
(17424903, 'jrubilar', 'Jose Rubilar', 'e10adc3949ba59abbe56e057f20f883e', 0, 1),
(11, 'prubilar', 'pipe gays', '202cb962ac59075b964b07152d234b70', 0, 0);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
