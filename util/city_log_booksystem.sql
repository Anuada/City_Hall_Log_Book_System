-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               8.0.30 - MySQL Community Server - GPL
-- Server OS:                    Win64
-- HeidiSQL Version:             12.1.0.6537
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

-- Dumping structure for table city_log_booksystem.visitor_info
CREATE TABLE IF NOT EXISTS `visitor_info` (
  `id` int NOT NULL AUTO_INCREMENT,
  `fname` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `lname` varchar(100) NOT NULL,
  `purpose` varchar(100) NOT NULL,
  `type` enum('Employee','Visitor') CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT 'Visitor',
  `status` enum('Pending','Accepted','Cancelled') CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT 'Pending',
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=59 DEFAULT CHARSET=latin1;

-- Dumping data for table city_log_booksystem.visitor_info: ~15 rows (approximately)
INSERT INTO `visitor_info` (`id`, `fname`, `lname`, `purpose`, `type`, `status`, `date`) VALUES
	(31, 'Ericson', 'Anuada', 'Internship', 'Employee', 'Accepted', '2024-09-11 09:32:20'),
	(32, 'French', 'Butera', 'Apply', 'Visitor', 'Accepted', '2024-09-11 09:39:42'),
	(33, 'Torya', 'Bulacao', 'I work here', 'Employee', 'Accepted', '2024-09-11 09:55:59'),
	(34, 'Mardon', 'Dela Peña', 'Paper Works', 'Visitor', 'Pending', '2024-09-11 10:23:48'),
	(35, 'Ariana', 'Grande', 'Working', 'Employee', 'Pending', '2024-09-11 11:48:29'),
	(36, 'Karl John', 'Delfin', 'License', 'Visitor', 'Pending', '2024-09-11 12:11:55'),
	(37, 'Dweight Dewey', 'Fuentes', 'License', 'Visitor', 'Pending', '2024-09-11 13:22:22'),
	(38, 'Ariana', 'Grande', 'Snack', 'Visitor', 'Accepted', '2024-09-11 17:38:58'),
	(39, 'Zhuang', 'Cruz', 'Deed of Sale', 'Visitor', 'Accepted', '2024-09-12 02:44:21'),
	(40, 'French', 'Butera', 'Application', 'Employee', 'Accepted', '2024-09-12 12:19:53'),
	(41, 'Ariana', 'Grande', 'Work', 'Employee', 'Accepted', '2024-09-13 12:54:43'),
	(42, 'Mardon', 'Dela Peña', 'Application', 'Employee', 'Accepted', '2024-09-13 12:57:30'),
	(48, 'Ericson', 'Anuada', 'Work', 'Employee', 'Accepted', '2024-09-14 06:09:40'),
	(56, 'Zhuang', 'Cruz', 'Malibang', 'Employee', 'Accepted', '2024-09-14 10:58:50'),
	(57, 'Ariana', 'Grande', 'Woah', 'Visitor', 'Accepted', '2024-09-14 11:22:51');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
