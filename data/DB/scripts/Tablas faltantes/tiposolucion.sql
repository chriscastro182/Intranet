-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 11-12-2017 a las 19:09:34
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
-- Estructura de tabla para la tabla `tiposolucion`
--

CREATE TABLE `tiposolucion` (
  `idtipoSolucion` int(11) NOT NULL,
  `nombreSolucion` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `tiposolucion`
--

INSERT INTO `tiposolucion` (`idtipoSolucion`, `nombreSolucion`) VALUES
(1, 'Sin requerimiento asignado'),
(10, 'Error de Usuario'),
(20, 'Consulta del Usuario'),
(30, 'Error del Sistema'),
(40, 'Error causado por Sistemas externos'),
(50, 'Requerimiento Menor de software'),
(60, 'Requerimiento Mayor de software'),
(70, 'Requerimiento Menor de Soporte'),
(80, 'Requerimiento Mayor de Soporte'),
(90, 'Requerimiento Menor de Mantenimiento'),
(100, 'Requerimiento Mayor de Soporte Mantenimiento'),
(110, 'Solicitud de Datos'),
(120, 'Caso Preventivo'),
(130, 'Falla en Red LAN'),
(140, 'Falla en la Computadora'),
(150, 'Mantenimiento Correctivo'),
(160, 'Error causado por Aduanas'),
(170, 'Configuración de Usuario');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `tiposolucion`
--
ALTER TABLE `tiposolucion`
  ADD PRIMARY KEY (`idtipoSolucion`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
