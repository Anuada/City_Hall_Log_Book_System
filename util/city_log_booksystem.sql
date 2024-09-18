-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 18, 2024 at 03:28 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `city_log_booksystem`
--

-- --------------------------------------------------------

--
-- Table structure for table `visitor_info`
--

CREATE TABLE `visitor_info` (
  `id` int(11) NOT NULL,
  `fname` varchar(100) NOT NULL,
  `lname` varchar(100) NOT NULL,
  `purpose` varchar(100) NOT NULL,
  `type` enum('Employee','Visitor') NOT NULL DEFAULT 'Visitor',
  `office` varchar(100) NOT NULL,
  `status` enum('Pending','Accepted','Cancelled') NOT NULL DEFAULT 'Pending',
  `date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `visitor_info`
--

INSERT INTO `visitor_info` (`id`, `fname`, `lname`, `purpose`, `type`, `office`, `status`, `date`) VALUES
(31, 'Ericson', 'Anuada', 'Internship', 'Employee', '', 'Accepted', '2024-09-11 09:32:20'),
(32, 'French', 'Butera', 'Apply', 'Visitor', '', 'Accepted', '2024-09-11 09:39:42'),
(33, 'Torya', 'Bulacao', 'I work here', 'Employee', '', 'Accepted', '2024-09-11 09:55:59'),
(34, 'Mardon', 'Dela Peña', 'Paper Works', 'Visitor', '', 'Accepted', '2024-09-11 10:23:48'),
(35, 'Ariana', 'Grande', 'Working', 'Employee', '', 'Pending', '2024-09-11 11:48:29'),
(36, 'Karl John', 'Delfin', 'License', 'Visitor', '', 'Pending', '2024-09-11 12:11:55'),
(37, 'Dweight Dewey', 'Fuentes', 'License', 'Visitor', '', 'Pending', '2024-09-11 13:22:22'),
(38, 'Ariana', 'Grande', 'Snack', 'Visitor', '', 'Accepted', '2024-09-11 17:38:58'),
(39, 'Zhuang', 'Cruz', 'Deed of Sale', 'Visitor', '', 'Accepted', '2024-09-12 02:44:21'),
(40, 'French', 'Butera', 'Application', 'Employee', '', 'Accepted', '2024-09-12 12:19:53'),
(41, 'Ariana', 'Grande', 'Work', 'Employee', '', 'Accepted', '2024-09-13 12:54:43'),
(42, 'Mardon', 'Dela Peña', 'Application', 'Employee', '', 'Accepted', '2024-09-13 12:57:30'),
(48, 'Ericson', 'Anuada', 'Work', 'Employee', '', 'Accepted', '2024-09-14 06:09:40'),
(56, 'Zhuang', 'Cruz', 'Malibang', 'Employee', '', 'Accepted', '2024-09-14 10:58:50'),
(57, 'Ariana', 'Grande', 'Woah', 'Visitor', '', 'Accepted', '2024-09-14 11:22:51'),
(59, 'Jeremy', 'Traya', 'Looking for Ojt', 'Visitor', 'Office2', 'Cancelled', '2024-09-16 02:55:35');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `visitor_info`
--
ALTER TABLE `visitor_info`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `visitor_info`
--
ALTER TABLE `visitor_info`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
