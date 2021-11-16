-- --------------------------------------------------------
-- Versión del servidor:         10.4.20-MariaDB - mariadb.org binary distribution
-- --------------------------------------------------------

-- Volcando estructura de base de datos para dweb
CREATE DATABASE IF NOT EXISTS `dweb` /*!40100 DEFAULT CHARACTER SET utf8mb4 */;
USE `dweb`;

-- Volcando estructura para tabla dweb.tickets
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
  `SUBJECT` enum('Tutorias','Comprobante de estudios','Consulta','Quejas','Otro') NOT NULL DEFAULT 'Otro',
  `STATUS` enum('Sin atender','Atendiendo','Atendido','Cancelado') NOT NULL DEFAULT 'Sin atender',
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Volcando estructura para tabla dweb.users
CREATE TABLE IF NOT EXISTS `users` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `USERNAME` varchar(25) NOT NULL,
  `PASSWORD` varchar(32) NOT NULL,
  `NAME` varchar(50) NOT NULL,
  PRIMARY KEY (`ID`),
  UNIQUE KEY `USERNAME` (`USERNAME`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;

-- Volcando datos para la tabla dweb.users: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` (`ID`, `USERNAME`, `PASSWORD`, `NAME`) VALUES
	(1, 'admin', '827ccb0eea8a706c4c34a16891f84e7b', 'ADMINISTRADOR'),
	(2, 'david', '827ccb0eea8a706c4c34a16891f84e7b', 'DAVID AGUIRRE'),
	(3, 'daniela', '827ccb0eea8a706c4c34a16891f84e7b', 'DANIELA RODRIGUEZ'),
	(4, 'daniel', '827ccb0eea8a706c4c34a16891f84e7b', 'JUAN DANIEL');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
