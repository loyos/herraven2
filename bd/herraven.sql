-- phpMyAdmin SQL Dump
-- version 3.5.2.2
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 05-07-2013 a las 19:51:34
-- Versión del servidor: 5.5.27
-- Versión de PHP: 5.4.7

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


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
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Volcado de datos para la tabla `acabados`
--

INSERT INTO `acabados` (`id`, `descripcion`, `oculto`, `acabado`) VALUES
(2, 'descripcion cualquiera', 0, 'acabado_uno1');

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
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Volcado de datos para la tabla `articulos`
--

INSERT INTO `articulos` (`id`, `codigo`, `descripcion`, `cantidad_por_caja`, `imagen`, `subcategoria_id`, `oculto`, `costo_produccion`, `margen_ganancia`) VALUES
(3, '1234', 'articulo_uno', 150, 'Tulips.jpg', 1, 0, 30, 10),
(6, '123123', 'articulo x', 70, 'Koala.jpg', 4, 1, 20, 50);

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
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=55 ;

--
-- Volcado de datos para la tabla `articulos_materiasprimas`
--

INSERT INTO `articulos_materiasprimas` (`id`, `articulo_id`, `materiasprima_id`, `cantidad`) VALUES
(46, 3, 2, 250),
(45, 3, 2, 200),
(54, 6, 2, 500),
(53, 6, 3, 100);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cajas`
--

CREATE TABLE IF NOT EXISTS `cajas` (
  `id` int(11) NOT NULL,
  `inventarioalmacen_id` int(11) NOT NULL,
  `codigo` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

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

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias`
--

CREATE TABLE IF NOT EXISTS `categorias` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(255) NOT NULL,
  `oculto` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Volcado de datos para la tabla `categorias`
--

INSERT INTO `categorias` (`id`, `descripcion`, `oculto`) VALUES
(1, 'Categoria_uno', 0),
(3, 'categoria_dos', 0);

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
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Volcado de datos para la tabla `clientes`
--

INSERT INTO `clientes` (`id`, `denominacion_legal`, `rif`, `representante`, `ciudad`, `direccion`, `direccion_despacho`, `telefono_uno`, `telefono_dos`, `fax`, `email_representante`, `sitio_web`, `precio_id`) VALUES
(4, 'Chialgoclet', 'J-3453124', 'Loy', 'Caracas', 'La colonia tovar', 'Casa de loy', '0258285', 'J-8763434', '', 'loy@gmail.com', 'chiclet@chiclet.com', 2),
(3, 'ACK1', 'J-23434343', 'Paola PiÃ±ero', 'Caracas', 'La trinidad', 'La trinidad', '04141788590', '582129458257', '', 'ppaola1409@gmail.com', '1234123', 0);

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
-- Volcado de datos para la tabla `configs`
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
-- Volcado de datos para la tabla `inventariomaterials`
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

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `materiasprimas`
--

CREATE TABLE IF NOT EXISTS `materiasprimas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(255) NOT NULL,
  `unidad` varchar(255) NOT NULL,
  `precio` float NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Volcado de datos para la tabla `materiasprimas`
--

INSERT INTO `materiasprimas` (`id`, `descripcion`, `unidad`, `precio`) VALUES
(2, 'materia_dos', 'litros', 100),
(3, 'materia paola', 'litros', 200),
(5, 'mat_1', 'litros', 50);

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
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Volcado de datos para la tabla `materiasprimas_precios`
--

INSERT INTO `materiasprimas_precios` (`id`, `precio`, `precio_id`, `materiasprima_id`) VALUES
(5, 100, 2, 2),
(6, 110, 1, 2);

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

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `precios`
--

CREATE TABLE IF NOT EXISTS `precios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(255) NOT NULL,
  `ganancia` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Volcado de datos para la tabla `precios`
--

INSERT INTO `precios` (`id`, `descripcion`, `ganancia`) VALUES
(1, 'Lista base', 0),
(2, 'Lista uno', 20);

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
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Volcado de datos para la tabla `subcategorias`
--

INSERT INTO `subcategorias` (`id`, `descripcion`, `categoria_id`, `oculto`) VALUES
(1, 'subcategoria 1', 1, 0),
(4, 'Subcatergoria_dos', 3, 0);

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
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `email`, `nombre`, `apellido`, `rol`, `cliente_id`, `admin_usuario`, `admin_catalogo`, `admin_materia_prima`, `admin_almacen`, `admin_pedidos`, `admin_despachos`, `admin_cuentas`, `admin_almacenes_clientes`, `admin_reportes`, `cliente_perfil`, `cliente_almacen`, `cliente_catalogo`) VALUES
(3, 'paolap', '77b6b96a3df9d5703e27f9142733f4ee', 'ppaola1409@gmail.com', 'paola', 'Pinero', 'cliente', 3, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 1, 1),
(5, 'admin', '77b6b96a3df9d5703e27f9142733f4ee', 'admin@gmail.com', 'admin', 'admin', 'admin', 4, 1, 1, 1, 1, 1, 1, 0, 1, 1, 0, 0, 0);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
