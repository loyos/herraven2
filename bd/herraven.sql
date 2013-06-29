-- phpMyAdmin SQL Dump
-- version 3.3.9
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 29-06-2013 a las 16:45:46
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
-- Estructura de tabla para la tabla `acabados`
--

CREATE TABLE IF NOT EXISTS `acabados` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `descripcion` text NOT NULL,
  `oculto` int(11) NOT NULL DEFAULT '0',
  `acabado` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Volcar la base de datos para la tabla `acabados`
--

INSERT INTO `acabados` (`id`, `descripcion`, `oculto`, `acabado`) VALUES
(2, 'descripcion cualquiera', 0, 'acabado_uno');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `articulos`
--

CREATE TABLE IF NOT EXISTS `articulos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `codigo` varchar(255) NOT NULL,
  `descripcion` varchar(255) NOT NULL,
  `cantidad_por_caja` int(11) NOT NULL,
  `imagen` varchar(255) NOT NULL,
  `subcategoria_id` int(11) NOT NULL,
  `oculto` tinyint(4) NOT NULL,
  `costo_produccion` int(11) NOT NULL,
  `margen_ganancia` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Volcar la base de datos para la tabla `articulos`
--

INSERT INTO `articulos` (`id`, `codigo`, `descripcion`, `cantidad_por_caja`, `imagen`, `subcategoria_id`, `oculto`, `costo_produccion`, `margen_ganancia`) VALUES
(3, '1234', 'articulo_uno', 150, 'Tulips.jpg', 1, 0, 30, 10),
(5, '147147', 'articulo_2', 20, 'Lighthouse.jpg', 1, 0, 20, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `articulos_materiasprimas`
--

CREATE TABLE IF NOT EXISTS `articulos_materiasprimas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `articulo_id` int(11) NOT NULL,
  `materiasprima_id` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=49 ;

--
-- Volcar la base de datos para la tabla `articulos_materiasprimas`
--

INSERT INTO `articulos_materiasprimas` (`id`, `articulo_id`, `materiasprima_id`, `cantidad`) VALUES
(48, 5, 2, 10),
(47, 5, 1, 10),
(46, 3, 2, 250),
(45, 3, 1, 200);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cajas`
--

CREATE TABLE IF NOT EXISTS `cajas` (
  `id` int(11) NOT NULL,
  `inventarioalmacen_id` int(11) NOT NULL,
  `codigo` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Volcar la base de datos para la tabla `cajas`
--


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cajas_pedidos`
--

CREATE TABLE IF NOT EXISTS `cajas_pedidos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `caja_id` int(11) NOT NULL,
  `pedido_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Volcar la base de datos para la tabla `cajas_pedidos`
--


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias`
--

CREATE TABLE IF NOT EXISTS `categorias` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(255) NOT NULL,
  `oculto` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Volcar la base de datos para la tabla `categorias`
--

INSERT INTO `categorias` (`id`, `descripcion`, `oculto`) VALUES
(1, 'Categoria uno', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clientes`
--

CREATE TABLE IF NOT EXISTS `clientes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `denominacion_legal` varchar(255) NOT NULL,
  `rif` varchar(255) NOT NULL,
  `representante` varchar(255) NOT NULL,
  `ciudad` varchar(255) NOT NULL,
  `direccion` text NOT NULL,
  `direccion_despacho` text NOT NULL,
  `telefono_uno` varchar(255) NOT NULL,
  `telefono_dos` varchar(255) NOT NULL,
  `fax` varchar(255) NOT NULL,
  `email_representante` varchar(255) NOT NULL,
  `sitio_web` varchar(255) NOT NULL,
  `precio_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Volcar la base de datos para la tabla `clientes`
--

INSERT INTO `clientes` (`id`, `denominacion_legal`, `rif`, `representante`, `ciudad`, `direccion`, `direccion_despacho`, `telefono_uno`, `telefono_dos`, `fax`, `email_representante`, `sitio_web`, `precio_id`) VALUES
(3, 'ACK', 'J-23434343', 'Paola PiÃ±ero', 'Caracas', 'La trinidad', 'La trinidad', '04141788590', '582129458257', '', 'ppaola1409@gmail.com', '1234123', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `configs`
--

CREATE TABLE IF NOT EXISTS `configs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `costo_produccion` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Volcar la base de datos para la tabla `configs`
--

INSERT INTO `configs` (`id`, `costo_produccion`) VALUES
(1, 20);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cuentas`
--

CREATE TABLE IF NOT EXISTS `cuentas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pedido_id` int(11) NOT NULL,
  `total` float NOT NULL,
  `deposito` float NOT NULL,
  `status` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Volcar la base de datos para la tabla `cuentas`
--


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `inventarioalmacens`
--

CREATE TABLE IF NOT EXISTS `inventarioalmacens` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tipo` varchar(255) NOT NULL,
  `articulo_id` int(11) NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `cajas` int(11) NOT NULL,
  `acabado_id` int(11) NOT NULL,
  `pedido_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Volcar la base de datos para la tabla `inventarioalmacens`
--


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `inventariomaterials`
--

CREATE TABLE IF NOT EXISTS `inventariomaterials` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cantidad` int(11) NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `materiasprima_id` int(11) NOT NULL,
  `tipo` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Volcar la base de datos para la tabla `inventariomaterials`
--


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `materiasprimas`
--

CREATE TABLE IF NOT EXISTS `materiasprimas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(255) NOT NULL,
  `unidad` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Volcar la base de datos para la tabla `materiasprimas`
--

INSERT INTO `materiasprimas` (`id`, `descripcion`, `unidad`) VALUES
(1, 'materia_unp', 'Kg'),
(2, 'materia_dos', 'Litros');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `materiasprimas_precios`
--

CREATE TABLE IF NOT EXISTS `materiasprimas_precios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `precio` float NOT NULL,
  `precio_id` int(11) NOT NULL,
  `materiasprima_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Volcar la base de datos para la tabla `materiasprimas_precios`
--


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedidos`
--

CREATE TABLE IF NOT EXISTS `pedidos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fecha` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `cliente_id` int(11) NOT NULL,
  `status` varchar(255) NOT NULL,
  `factura` varchar(255) NOT NULL,
  `articulo_id` int(11) NOT NULL,
  `cantidad_cajas` int(11) NOT NULL,
  `acabado_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Volcar la base de datos para la tabla `pedidos`
--


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `precios`
--

CREATE TABLE IF NOT EXISTS `precios` (
  `id` int(11) NOT NULL,
  `descripcion` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Volcar la base de datos para la tabla `precios`
--


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `subcategorias`
--

CREATE TABLE IF NOT EXISTS `subcategorias` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(255) NOT NULL,
  `categoria_id` int(11) NOT NULL,
  `oculto` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Volcar la base de datos para la tabla `subcategorias`
--

INSERT INTO `subcategorias` (`id`, `descripcion`, `categoria_id`, `oculto`) VALUES
(1, 'subcategoria 1', 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `apellido` varchar(255) NOT NULL,
  `rol` varchar(255) NOT NULL,
  `cliente_id` int(11) NOT NULL,
  `admin_usuario` tinyint(11) NOT NULL DEFAULT '0',
  `admin_catalogo` tinyint(11) NOT NULL DEFAULT '0',
  `admin_materia_prima` tinyint(11) NOT NULL DEFAULT '0',
  `admin_almacen` tinyint(11) NOT NULL DEFAULT '0',
  `admin_pedidos` tinyint(11) NOT NULL DEFAULT '0',
  `admin_despachos` tinyint(11) NOT NULL DEFAULT '0',
  `admin_cuentas` tinyint(11) NOT NULL DEFAULT '0',
  `admin_almacenes_clientes` tinyint(11) NOT NULL DEFAULT '0',
  `admin_reportes` tinyint(11) NOT NULL DEFAULT '0',
  `cliente_perfil` tinyint(11) NOT NULL DEFAULT '0',
  `cliente_almacen` tinyint(11) NOT NULL DEFAULT '0',
  `cliente_catalogo` tinyint(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Volcar la base de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `email`, `nombre`, `apellido`, `rol`, `cliente_id`, `admin_usuario`, `admin_catalogo`, `admin_materia_prima`, `admin_almacen`, `admin_pedidos`, `admin_despachos`, `admin_cuentas`, `admin_almacenes_clientes`, `admin_reportes`, `cliente_perfil`, `cliente_almacen`, `cliente_catalogo`) VALUES
(1, 'Paola', '096842', 'ppaola1409@gmail.com', 'Paola', 'Pinero', 'admin', 3, 0, 1, 1, 1, 1, 1, 0, 1, 1, 1, 0, 0);
