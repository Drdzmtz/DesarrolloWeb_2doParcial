-- --------------------------------------------------------
-- Versión del servidor:         10.4.20-MariaDB - mariadb.org binary distribution
-- --------------------------------------------------------

CREATE DATABASE IF NOT EXISTS `dweb` /*!40100 DEFAULT CHARACTER SET utf8mb4 */;
USE `dweb`;

CREATE TABLE IF NOT EXISTS `tickets` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `TNAME` varchar(50) DEFAULT NULL,
  `CURP` varchar(50) DEFAULT NULL,
  `NAME` varchar(50) DEFAULT NULL,
  `LPNAME` varchar(50) DEFAULT NULL,
  `LMNAME` varchar(50) DEFAULT NULL,
  `TELEPHONE` varchar(10) DEFAULT NULL,
  `CELPHONE` varchar(10) DEFAULT NULL,
  `MAIL` varchar(50) DEFAULT NULL,
  `LEVEL` varchar(50) DEFAULT NULL,
  `CITY` varchar(50) DEFAULT NULL,
  `SUBJECT` enum('Comprobante','Consulta','Quejas','Otro') NOT NULL DEFAULT 'Otro',
  `STATUS` enum('Sin atender','Atendiendo','Atendido','Cancelado') NOT NULL DEFAULT 'Sin atender',
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4;