-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 14-12-2017 a las 00:28:05
-- Versión del servidor: 10.1.25-MariaDB
-- Versión de PHP: 7.1.7

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
  `guiaHouse` varchar(20) DEFAULT NULL,
  `registro` int(11) NOT NULL,
  `costotransferencia` float DEFAULT NULL,
  `peso` float NOT NULL,
  `guiaDirecta` int(15) DEFAULT NULL,
  `averia` tinyint(1) NOT NULL,
  `setransfiere` varchar(45) NOT NULL,
  `fecha` datetime NOT NULL,
  `piezas` smallint(6) NOT NULL,
  `consignatario` varchar(30) NOT NULL,
  `contenido` varchar(45) NOT NULL,
  `ubicacion` varchar(5) NOT NULL,
  `pesobascula` float NOT NULL,
  `observaciones` varchar(200) DEFAULT NULL,
  `fechaentrada` date NOT NULL,
  `almacenqueentrega` varchar(60) NOT NULL,
  `correo` varchar(50) NOT NULL,
  `gafete` varchar(200) NOT NULL,
  `fk_condiciondecarga` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `transferencias`
--

INSERT INTO `transferencias` (`idTransferencia`, `guiaMaster`, `guiaHouse`, `registro`, `costotransferencia`, `peso`, `guiaDirecta`, `averia`, `setransfiere`, `fecha`, `piezas`, `consignatario`, `contenido`, `ubicacion`, `pesobascula`, `observaciones`, `fechaentrada`, `almacenqueentrega`, `correo`, `gafete`, `fk_condiciondecarga`) VALUES
(1, 1234567890, '0987654321', 21, 666, 234, 0, 0, 'SCHENKER', '2017-12-11 18:30:54', 21, 'Volkswagen de MÃ©xico', 'Consol', 'B 104', 234, 'Ninguna', '2017-12-11', 'RenÃ© GarcÃ­a', 'rene.garcia@volkswagen.com.mx', 'gafetes/1/WhatsApp Image 2017-12-08 at 6.07.59 PM.jpeg', 1),
(2, 12345, '12345', 0, 234, 200, 12345, 0, '', '2017-12-12 09:37:26', 100, '', '', '', 0, '', '2017-12-12', '', '', 'gafetes/', 3),
(3, 1233, '1234', 0, 0, 100, 0, 1, 'tytru', '2017-12-12 09:40:08', 100, 'fghfg', 'sdfsd', '', 0, '', '2017-12-12', 'sdfdsgsdfg', 'gilberto.silva@interpuerto.com', 'gafetes/', 3),
(4, 0, '', 0, 463.6, 98.3, 0, 1, 'SCHENKER', '2017-12-13 14:38:13', 4, 'Kehune Nagel', 'Consol', 'B 204', 463.2, 'Muestras de maltrato al empaque', '2017-12-13', 'Pablo DÃ­as', 'pablo.dias@keunenagel.com.mx', 'gafetes/4/WhatsApp Image 2017-12-08 at 6.07.59 PM.jpeg', 6),
(5, 1283047, '', 0, 863.7, 85.6, 0, 1, 'asdasd', '2017-12-13 14:46:00', 23, 'asdasd', 'consol', 'F 18', 87.2, 'El empaque presenta marcas de haber sido golpeado', '2017-12-13', 'gtgregserg', 'correo@correo.com', 'gafetes/5/1 VwGamDkf23xnm2gUBoCotQ@2x.png', 2),
(6, 0, '', 0, 10, 4, 0, 0, 'sasfg', '2017-12-13 16:06:49', 2, 'asdas', 'sss', 'P 10', 4, 'alkjfoiwej', '2017-12-13', 'zxcv', 'correo@mail.com', 'gafetes/6/200px-2017_WCS_logo.png', 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `transferencias`
--
ALTER TABLE `transferencias`
  ADD PRIMARY KEY (`idTransferencia`),
  ADD KEY `fk_condiciondecarga_idtransferencias` (`fk_condiciondecarga`);

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `transferencias`
--
ALTER TABLE `transferencias`
  ADD CONSTRAINT `fk_condiciondecarga_idtransferencias` FOREIGN KEY (`fk_condiciondecarga`) REFERENCES `condiciondecarga` (`idCondicion`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
