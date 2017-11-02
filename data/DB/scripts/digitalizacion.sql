

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


CREATE SCHEMA IF NOT EXISTS `digitalizacion` DEFAULT CHARACTER SET utf8 ;
USE `digitalizacion` ;


CREATE TABLE `registrodescon` (
  `idRegistroDescon` int(11) NOT NULL,
  `guiaHouse` varchar(15) NOT NULL,
  `numDesconsol` smallint(6) NOT NULL,
  `RegistroVD_idRegistroVD` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



CREATE TABLE `registrovd` (
  `idRegistroVD` int(11) NOT NULL,
  `guiaMaster` mediumtext NOT NULL,
  `guiaHouse` varchar(15) DEFAULT NULL,
  `descon` tinyint(4) NOT NULL,
  `VueloDigitalizacion_idVueloDigitalizacion` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



CREATE TABLE `vuelodigitalizacion` (
  `idVueloDigitalizacion` int(11) NOT NULL,
  `fecha` datetime NOT NULL,
  `registroVD` bigint(20) NOT NULL,
  `numGuias` tinyint(4) NOT NULL,
  `documentoVD` varchar(45) NOT NULL,
  `estatusVD` tinyint(4) NOT NULL,
  `nomVuelo` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


ALTER TABLE `registrodescon`
  ADD PRIMARY KEY (`idRegistroDescon`),
  ADD KEY `fk_RegistroDescon_RegistroVD1_idx` (`RegistroVD_idRegistroVD`);


ALTER TABLE `registrovd`
  ADD PRIMARY KEY (`idRegistroVD`,`VueloDigitalizacion_idVueloDigitalizacion`),
  ADD KEY `fk_RegistroVD_VueloDigitalizacion_idx` (`VueloDigitalizacion_idVueloDigitalizacion`);


ALTER TABLE `vuelodigitalizacion`
  ADD PRIMARY KEY (`idVueloDigitalizacion`);


ALTER TABLE `registrodescon`
  ADD CONSTRAINT `fk_RegistroDescon_RegistroVD1` FOREIGN KEY (`RegistroVD_idRegistroVD`) REFERENCES `registrovd` (`idRegistroVD`) ON DELETE NO ACTION ON UPDATE NO ACTION;

ALTER TABLE `registrovd`
  ADD CONSTRAINT `fk_RegistroVD_VueloDigitalizacion` FOREIGN KEY (`VueloDigitalizacion_idVueloDigitalizacion`) REFERENCES `vuelodigitalizacion` (`idVueloDigitalizacion`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;
