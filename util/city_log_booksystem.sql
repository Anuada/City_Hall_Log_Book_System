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

-- Dumping structure for table city_log_booksystem.employee_info
CREATE TABLE IF NOT EXISTS `employee_info` (
  `tin_number` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `fname` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `lname` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `office` enum('Sangguniang Panlungsod','PARKS & PLAYGROUND','OFFICE OF THE CITY VICE-MAYOR','OFFICE OF THE CITY MAYOR','OFFICE OF THE CITY CIVIL REGISTRAR (OCCR)','OFFICE OF THE CITY ASSESSORS','OFFICE OF THE CITY ADMINISTRATOR','OFFICE OF THE CITY ACCOUNTANT','OFFICE OF THE BUILDING OFFICIAL (OBO)','OFFICE OF CITY BUDGET','MANAGEMENT INFORMATION & COMPUTER SERVICES (MICS)','LOCAL SCHOOL BOARD(LSB)','Invitation to BID (Notice of Auction Sale)','INTERNAL AUDIT SERVICE OFFICE (IASO)','HUMAN RESOURCE AND DEVELOPMENT OFFICE (HRDO)','DEPARTMENT OF VETERINARY MEDICINE & FISHERIES (DVMF)','DEPARTMENT OF SOCIAL WELFARE AND SERVICES (DSWS)','DEPARTMENT OF PUBLIC SERVICES (DPS)','DEPARTMENT OF MANPOWER DEVELOPMENT AND PLACEMENT (DMDP)','DEPARTMENT OF GENERAL SERVICES (DGS)','DEPARTMENT OF ENGINEERING & PUBLIC WORKS (DEPW)','Contact Center ng Bayan Partner Recognition Program','CITY TREASURER’S OFFICE (CTO)','CITY PLANNING DEVELOPMENT OFFICE (CPDO)','CITY LEGAL OFFICE','CITY HEALTH DEPARTMENT (CHD)','CITY AGRICULTURE DEPARTMENT (CAD)','CEBU CITY TRANSPORTATION OFFICE (CCTO)','CEBU CITY RESOURCE MANAGEMENT AND DEVELOPMENT CENTER (CREMDEC)','CEBU CITY MEDICAL CENTER (CCMC)') COLLATE utf8mb4_general_ci DEFAULT 'OFFICE OF THE CITY ADMINISTRATOR',
  PRIMARY KEY (`tin_number`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table city_log_booksystem.employee_info: ~4 rows (approximately)
INSERT INTO `employee_info` (`tin_number`, `fname`, `lname`, `office`) VALUES
	('235-874-619-342', 'Torya', 'Bulacao', 'OFFICE OF THE CITY ADMINISTRATOR'),
	('501-279-463-158', 'Nicki', 'Minaj', 'OFFICE OF THE CITY ADMINISTRATOR'),
	('674-983-204-751', 'Ice', 'Spice', 'OFFICE OF THE CITY ADMINISTRATOR'),
	('849-356-712-934', 'Lady', 'Gaga', 'OFFICE OF THE CITY ADMINISTRATOR'),
	('890-456-321-987', 'Ariana', 'Grande', 'OFFICE OF THE CITY ADMINISTRATOR');

-- Dumping structure for table city_log_booksystem.visitor_info
CREATE TABLE IF NOT EXISTS `visitor_info` (
  `id` int NOT NULL AUTO_INCREMENT,
  `employee_id` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `fname` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `lname` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `purpose` varchar(100) NOT NULL,
  `office` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `type` enum('Employee','Visitor') NOT NULL DEFAULT 'Visitor',
  `status` enum('Pending','Accepted','Cancelled') NOT NULL DEFAULT 'Pending',
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `FK_visitor_info_employee_info` (`employee_id`),
  CONSTRAINT `FK_visitor_info_employee_info` FOREIGN KEY (`employee_id`) REFERENCES `employee_info` (`tin_number`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=106 DEFAULT CHARSET=latin1;

-- Dumping data for table city_log_booksystem.visitor_info: ~23 rows (approximately)
INSERT INTO `visitor_info` (`id`, `employee_id`, `fname`, `lname`, `purpose`, `office`, `type`, `status`, `date`) VALUES
	(31, NULL, 'Ericson', 'Anuada', 'Internship', 'DEPARTMENT OF SOCIAL WELFARE AND SERVICES (DSWS)', 'Visitor', 'Accepted', '2024-09-11 09:32:20'),
	(32, NULL, 'French', 'Butera', 'Apply', 'OFFICE OF THE CITY ADMINISTRATOR', 'Visitor', 'Accepted', '2024-09-11 09:39:42'),
	(33, NULL, 'Glitter', 'Sparkles', 'Lukat Lisensya', 'OFFICE OF THE BUILDING OFFICIAL (OBO)', 'Visitor', 'Accepted', '2024-09-11 09:55:59'),
	(34, NULL, 'Mardon', 'Dela Peña', 'Paper Works', 'OFFICE OF THE CITY ASSESSORS', 'Visitor', 'Accepted', '2024-09-11 10:23:48'),
	(35, NULL, 'Janine', 'Ubal', 'Lukat Lisensya', 'OFFICE OF THE CITY CIVIL REGISTRAR (OCCR)', 'Visitor', 'Pending', '2024-09-11 11:48:29'),
	(88, NULL, 'Mardon', 'Dela Peña', 'Visit the Office Of The City Vice Mayor', 'OFFICE OF THE CITY VICE-MAYOR', 'Visitor', 'Pending', '2024-09-20 03:31:46'),
	(92, NULL, 'Mardon', 'Dela Peña', 'Visit the Office Of The City Civil Registrar (occr)', 'OFFICE OF THE CITY CIVIL REGISTRAR (OCCR)', 'Visitor', 'Pending', '2024-09-20 15:27:21'),
	(93, NULL, 'Taylor', 'Swift', 'Visit the Parks & Playground', 'PARKS & PLAYGROUND', 'Visitor', 'Pending', '2024-09-20 15:27:57'),
	(99, NULL, 'Mardon', 'Dela Peña', 'Visit the Parks & Playground', 'PARKS & PLAYGROUND', 'Visitor', 'Accepted', '2024-09-23 05:57:42'),
	(103, '235-874-619-342', NULL, NULL, 'Work at the Office Of The City Administrator', NULL, 'Employee', 'Accepted', '2024-09-24 03:01:41'),
	(104, NULL, 'John', 'Smith', 'Visit the Vice Mayor', 'Vice Mayor', 'Visitor', 'Pending', '2024-09-24 03:03:20'),
	(105, NULL, 'Zhuang', 'Cruz', 'Visit the Vice Mayor', 'Vice Mayor', 'Visitor', 'Accepted', '2024-09-24 03:04:11');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
