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
  `fname` varchar(100) NOT NULL,
  `lname` varchar(100) NOT NULL,
  `purpose` varchar(100) NOT NULL,
  `type` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `date` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=latin1;

-- Dumping data for table city_log_booksystem.visitor_info: ~26 rows (approximately)
INSERT INTO `visitor_info` (`id`, `fname`, `lname`, `purpose`, `type`, `date`) VALUES
	(1, 'dd', 'ddd', 'dd', '', '2024-09-11'),
	(2, 'Navos', 'Hackers', 'Mang hack', '', '2024-09-10'),
	(3, 'Navos', 'Aryana', 'Mangoyab', '', '2024-09-27'),
	(4, 'Navos', 'Aryana', 'Mangoyab', '', '2024-09-27'),
	(5, 'Daniel', 'Bonaks', 'ojt', '', '2024-09-10'),
	(6, 'Navos', 'ddd', 'dsdfsfs', '', '2024-09-23'),
	(7, 'Ericson', 'Anuada', 'Appying Internship', '', '2024-09-25'),
	(8, 'Jeryme', 'Gwapa', 'Internship', '', '2024-09-08'),
	(9, 'Navos', 'dsdfs', 'sdfsdfsa', '', '2024-09-27'),
	(10, 'Micheal', 'Hangol', 'Mangawat', '', '2024-09-17'),
	(11, 'Navos', 'ddd', 'jhdabfdjasldfa', '', '2024-09-23'),
	(12, 'Daniel', 'ds', 'sdfs', '', '2024-09-19'),
	(13, 'Daniel', 'ds', 'sdfs', '', '2024-09-19'),
	(14, 'd', 'd', 'd', '', '2024-09-12'),
	(15, 'Mharben', 'Laray', 'Applicant', '', '2024-09-10'),
	(16, 'Ericson', 'Anuada', 'OJT', '', '2024-09-19'),
	(17, 'Ernel', 'Lazaragga', 'OJT', '', '2024-09-27'),
	(18, 'Devota', 'Langyao', 'OJT', '', '2024-09-25'),
	(19, 'Alisaca', 'Yawming', 'OJT', '', '2024-09-26'),
	(20, 'Poral', 'Porlas', 'OJT', '', '2024-09-19'),
	(21, 'merna', 'gabuta', 'Applicant', '', '2024-09-20'),
	(22, 's', 's', 's', '', '2024-09-26'),
	(23, 'Daniel', 'ddd', 's', '', '2024-10-02'),
	(24, 'Daniel', 's', 's', '', '2024-09-25'),
	(25, 'dd', 's', 's', '', '2024-09-26'),
	(27, 'Remina', 'Largo', 'OJT', '', '2024-09-10');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
