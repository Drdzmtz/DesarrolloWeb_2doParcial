-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Versión del servidor:         10.4.20-MariaDB - mariadb.org binary distribution
-- SO del servidor:              Win64
-- HeidiSQL Versión:             11.0.0.5919
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Volcando estructura de base de datos para dweb
CREATE DATABASE IF NOT EXISTS `dweb` /*!40100 DEFAULT CHARACTER SET utf8mb4 */;
USE `dweb`;

-- Volcando estructura para tabla dweb.tickets
CREATE TABLE IF NOT EXISTS `tickets` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `TURN` int(11) NOT NULL,
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

-- La exportación de datos fue deseleccionada.

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
