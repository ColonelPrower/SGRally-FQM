-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 24-09-2015 a las 03:15:23
-- Versión del servidor: 5.6.17
-- Versión de PHP: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `prally`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `admins`
--

CREATE TABLE IF NOT EXISTS `admins` (
  `id` int(4) NOT NULL,
  `nombre` varchar(15) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `equipos`
--

CREATE TABLE IF NOT EXISTS `equipos` (
  `num_equipo` int(2) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) DEFAULT NULL,
  `nivel` int(1) NOT NULL,
  `representante` varchar(9) DEFAULT NULL,
  `fecha_reg` date NOT NULL,
  `foto` varchar(14) DEFAULT NULL,
  `calendario` varchar(5) NOT NULL,
  `hora_reg` time DEFAULT NULL,
  PRIMARY KEY (`num_equipo`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `historial`
--

CREATE TABLE IF NOT EXISTS `historial` (
  `num_equipo` int(2) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `representante` varchar(9) NOT NULL,
  `duracion` time NOT NULL,
  `aciertos` int(11) NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `log`
--

CREATE TABLE IF NOT EXISTS `log` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `usuario` int(4) NOT NULL,
  `evento` text NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `maestros`
--

CREATE TABLE IF NOT EXISTS `maestros` (
  `codigo` varchar(9) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `materia` varchar(50) DEFAULT NULL,
  `telefono` varchar(15) DEFAULT NULL,
  `foto` varchar(13) NOT NULL,
  PRIMARY KEY (`codigo`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mesas`
--

CREATE TABLE IF NOT EXISTS `mesas` (
  `num_mesa` int(11) NOT NULL AUTO_INCREMENT,
  `maestro` varchar(9) NOT NULL,
  PRIMARY KEY (`num_mesa`),
  KEY `maestro` (`maestro`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `participantes`
--

CREATE TABLE IF NOT EXISTS `participantes` (
  `codigo` varchar(9) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `telefono` varchar(15) DEFAULT NULL,
  `num_equipo` int(2) NOT NULL,
  `carrera` varchar(15) NOT NULL,
  `semestre` varchar(10) NOT NULL,
  `foto` varchar(13) NOT NULL,
  PRIMARY KEY (`codigo`),
  KEY `num_equipo` (`num_equipo`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ranking`
--

CREATE TABLE IF NOT EXISTS `ranking` (
  `num_equipo` int(2) NOT NULL,
  `duracion` time NOT NULL,
  `aciertos` int(11) NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reactivos`
--

CREATE TABLE IF NOT EXISTS `reactivos` (
  `folio` int(11) NOT NULL AUTO_INCREMENT,
  `descripcion` text NOT NULL,
  `foto_desc` varchar(30) DEFAULT NULL,
  `opca` text,
  `opcb` text,
  `opcc` text,
  `fotoa` varchar(12) DEFAULT NULL,
  `fotob` varchar(12) DEFAULT NULL,
  `fotoc` varchar(12) DEFAULT NULL,
  `respuesta` char(1) NOT NULL,
  `nivel` int(1) NOT NULL,
  `materia` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`folio`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `resultados`
--

CREATE TABLE IF NOT EXISTS `resultados` (
  `folio` int(11) NOT NULL AUTO_INCREMENT,
  `pregunta` int(2) DEFAULT NULL,
  `num_equipo` int(2) NOT NULL,
  `num_mesa` int(2) DEFAULT NULL,
  `respuesta` char(1) NOT NULL,
  `correcta` varchar(2) NOT NULL,
  `hora_ini` time NOT NULL,
  `hora_fin` time DEFAULT NULL,
  `duracion` time DEFAULT NULL,
  PRIMARY KEY (`folio`),
  KEY `num_equipo` (`num_equipo`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tiemposreact`
--

CREATE TABLE IF NOT EXISTS `tiemposreact` (
  `id_preg` int(11) NOT NULL DEFAULT '0',
  `minutos` int(11) DEFAULT '0',
  `segundos` int(11) DEFAULT '0',
  PRIMARY KEY (`id_preg`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE IF NOT EXISTS `usuarios` (
  `usuario_id` int(4) NOT NULL AUTO_INCREMENT,
  `usuario_nombre` varchar(15) NOT NULL DEFAULT '',
  `usuario_clave` varchar(32) NOT NULL DEFAULT '',
  `usuario_email` varchar(50) NOT NULL DEFAULT '',
  `usuario_freg` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`usuario_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
