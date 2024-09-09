-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 09, 2024 at 05:18 AM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 7.3.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
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
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `visitor_info`
--

INSERT INTO `visitor_info` (`id`, `fname`, `lname`, `purpose`, `date`) VALUES
(1, 'dd', 'ddd', 'dd', '2024-09-11'),
(2, 'Navos', 'Hackers', 'Mang hack', '2024-09-10'),
(3, 'Navos', 'Aryana', 'Mangoyab', '2024-09-27'),
(4, 'Navos', 'Aryana', 'Mangoyab', '2024-09-27'),
(5, 'Daniel', 'Bonaks', 'ojt', '2024-09-10'),
(6, 'Navos', 'ddd', 'dsdfsfs', '2024-09-23'),
(7, 'Ericson', 'Anuada', 'Appying Internship', '2024-09-25'),
(8, 'Jeryme', 'Gwapa', 'Internship', '2024-09-08'),
(9, 'Navos', 'dsdfs', 'sdfsdfsa', '2024-09-27'),
(10, 'Micheal', 'Hangol', 'Mangawat', '2024-09-17'),
(11, 'Navos', 'ddd', 'jhdabfdjasldfa', '2024-09-23'),
(12, 'Daniel', 'ds', 'sdfs', '2024-09-19'),
(13, 'Daniel', 'ds', 'sdfs', '2024-09-19'),
(14, 'd', 'd', 'd', '2024-09-12'),
(15, 'Mharben', 'Laray', 'Applicant', '2024-09-10'),
(16, 'Ericson', 'Anuada', 'OJT', '2024-09-19'),
(17, 'Ernel', 'Lazaragga', 'OJT', '2024-09-27'),
(18, 'Devota', 'Langyao', 'OJT', '2024-09-25'),
(19, 'Alisaca', 'Yawming', 'OJT', '2024-09-26'),
(20, 'Poral', 'Porlas', 'OJT', '2024-09-19'),
(21, 'merna', 'gabuta', 'Applicant', '2024-09-20'),
(22, 's', 's', 's', '2024-09-26'),
(23, 'Daniel', 'ddd', 's', '2024-10-02'),
(24, 'Daniel', 's', 's', '2024-09-25'),
(25, 'dd', 's', 's', '2024-09-26');

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
