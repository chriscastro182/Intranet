-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 11-12-2017 a las 19:04:39
-- Versión del servidor: 10.1.26-MariaDB
-- Versión de PHP: 7.0.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `intranet`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `transferencias`
--

CREATE TABLE `transferencias` (
  `idTransferencia` int(11) NOT NULL,
  `guiaMaster` int(15) NOT NULL,
  `guiaHouse` int(15) DEFAULT NULL,
  `registro` int(11) NOT NULL,
  `peso` float NOT NULL,
  `guiaDirecta` int(15) DEFAULT NULL,
  `averia` tinyint(1) NOT NULL,
  `setransfiere` varchar(45) NOT NULL,
  `fecha` datetime NOT NULL,
  `piezas` smallint(6) NOT NULL,
  `consignatario` varchar(30) NOT NULL,
  `contenido` varchar(45) NOT NULL,
  `ubicaciÃ³n` int(11) NOT NULL,
  `pesobascula` float NOT NULL,
  `observaciones` varchar(200) DEFAULT NULL,
  `fechaentrada` date NOT NULL,
  `almacenqueentrega` varchar(60) NOT NULL,
  `correo` varchar(50) NOT NULL,
  `gafete` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
