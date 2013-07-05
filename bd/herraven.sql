-- phpMyAdmin SQL Dump
-- version 3.3.9
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 05-07-2013 a las 16:14:51
-- Versión del servidor: 5.1.53
-- Versión de PHP: 5.3.4

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `herraven`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `inventariomaterials`
--

CREATE TABLE IF NOT EXISTS `inventariomaterials` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cantidad` int(11) NOT NULL,
  `materiasprima_id` int(11) NOT NULL,
  `tipo` varchar(255) NOT NULL,
  `trimestre` int(11) NOT NULL,
  `ano` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Volcar la base de datos para la tabla `inventariomaterials`
--

INSERT INTO `inventariomaterials` (`id`, `cantidad`, `materiasprima_id`, `tipo`, `trimestre`, `ano`) VALUES
(5, 100, 3, 'entrada', 3, 2013),
(2, 100, 2, 'entrada', 3, 2013),
(3, 60, 2, 'salida', 3, 2013),
(4, 500, 2, 'entrada', 3, 2013),
(6, 50, 3, 'salida', 3, 2013),
(7, 50, 3, 'entrada', 2, 2013),
(8, 20, 3, 'entrada', 3, 2012),
(9, 200, 5, 'entrada', 3, 2013);
