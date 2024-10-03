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

-- Dumping structure for table city_log_booksystem.admin_info
CREATE TABLE IF NOT EXISTS `admin_info` (
  `id` int NOT NULL AUTO_INCREMENT,
  `username` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table city_log_booksystem.admin_info: ~0 rows (approximately)
INSERT INTO `admin_info` (`id`, `username`, `password`, `created_at`) VALUES
	(1, 'admin_imnida', '$2y$10$vbK3d9v3KDbxuY.zp6irdeaCBf2RiCNxtYMKSEP8kgOdbwnxRVAMK', '2024-09-22 15:02:41');

-- Dumping structure for table city_log_booksystem.visitor_info
CREATE TABLE IF NOT EXISTS `visitor_info` (
  `id` int NOT NULL AUTO_INCREMENT,
  `employee_id` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `fname` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `lname` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `purpose` varchar(100) NOT NULL,
  `office` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `division` enum('Administrative','Client Support','Technical Support','Developers','GIS') NOT NULL DEFAULT 'Technical Support',
  `type` enum('Employee','Visitor') NOT NULL DEFAULT 'Visitor',
  `status` enum('Pending','Accepted','Cancelled') NOT NULL DEFAULT 'Pending',
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=124 DEFAULT CHARSET=latin1;

-- Dumping data for table city_log_booksystem.visitor_info: ~3 rows (approximately)
INSERT INTO `visitor_info` (`id`, `employee_id`, `fname`, `lname`, `purpose`, `office`, `division`, `type`, `status`, `date`) VALUES
	(119, '58831', 'Maribel', 'Abadia', 'Work at the Office Of The Mayor', 'Office Of The Mayor', 'Developers', 'Employee', 'Accepted', '2024-10-03 13:40:32'),
	(120, NULL, 'Ericson', 'Anuada', 'Visit the Misc', 'Misc', 'Developers', 'Visitor', 'Accepted', '2024-10-03 13:41:20'),
	(121, '8', 'Fernando', 'Abad', 'Work at the Sangguniang Panlungsod - Secretariat', 'Sangguniang Panlungsod - Secretariat', 'Administrative', 'Employee', 'Accepted', '2024-10-03 14:01:15'),
	(122, '12', 'Jonathan', 'Abadia', 'Work at the Office Of The City Agriculturist - General Admin.', 'Office Of The City Agriculturist - General Admin.', 'Technical Support', 'Employee', 'Pending', '2024-10-03 14:45:59'),
	(123, NULL, 'Dua', 'Lipa', 'Visit the Office', 'Office', 'Client Support', 'Visitor', 'Pending', '2024-10-03 14:46:35');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
