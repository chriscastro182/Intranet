-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 11-12-2017 a las 18:12:19
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
-- Estructura de tabla para la tabla `sistemaproceso`
--

CREATE TABLE `sistemaproceso` (
  `idSistemaProceso` int(11) NOT NULL,
  `nombreSistemaPro` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `sistemaproceso`
--

INSERT INTO `sistemaproceso` (`idSistemaProceso`, `nombreSistemaPro`) VALUES
(1, 'Contpaq'),
(2, 'Comercial'),
(3, 'Sicafi'),
(4, 'DigitalizaciÃ³n'),
(5, 'CÃ¡lculo de abandono'),
(6, 'Interfaz comercial'),
(7, 'FacturaciÃ³n'),
(8, 'Monitoreo'),
(9, 'Control de Inventarios'),
(10, 'Consulta de Pedimentos');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `sistemaproceso`
--
ALTER TABLE `sistemaproceso`
  ADD PRIMARY KEY (`idSistemaProceso`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
