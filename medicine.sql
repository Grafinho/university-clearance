-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3307
-- Generation Time: Apr 26, 2026 at 06:54 PM
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
-- Database: `grafino`
--

-- --------------------------------------------------------

--
-- Table structure for table `medicine`
--

CREATE TABLE `medicine` (
  `id` int(11) NOT NULL,
  `username` varchar(20) NOT NULL,
  `full_name` varchar(100) NOT NULL,
  `department` varchar(100) NOT NULL,
  `total_units` int(11) NOT NULL,
  `units_completed` int(11) NOT NULL,
  `incomplete_units` int(11) GENERATED ALWAYS AS (`total_units` - `units_completed`) STORED,
  `status` varchar(20) DEFAULT NULL,
  `comments` text DEFAULT NULL,
  `last_updated` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `medicine`
--

INSERT INTO `medicine` (`id`, `username`, `full_name`, `department`, `total_units`, `units_completed`, `status`, `comments`, `last_updated`) VALUES
(1, 'MD/MED/2001/21', 'Dr. Jane Muriuki', 'General Medicine', 30, 25, 'Pending', 'Awaiting final clinical rotations report.', '2026-04-13 11:03:49'),
(2, 'MD/MED/2004/21', 'Dr. Ali Yusuf', 'Surgery', 28, 27, 'Approved', 'Final clearance approved.', '2026-04-13 11:03:49'),
(3, 'MD/MED/2010/21', 'Dr. Cynthia Atieno', 'Pediatrics', 25, 22, 'Requires Update', 'Missing immunization practical logs.', '2026-04-13 11:03:49'),
(4, 'MD/MED/2023/21', 'Dr. Kelvin Obiero', 'Pharmacy', 20, 15, 'Pending', 'Final exam results yet to be submitted.', '2026-04-13 11:03:49'),
(5, 'MD/MED/2035/21', 'Dr. Fatuma Mwangi', 'Nursing', 18, 16, 'Pending', 'Pending clearance for clinical assessments.', '2026-04-13 11:03:49'),
(6, 'MD/MED/2048/21', 'Dr. David Wafula', 'Radiology', 22, 20, 'Approved', 'All requirements satisfied.', '2026-04-13 11:03:49'),
(7, 'MD/MED/2052/21', 'Dr. Anita Kimani', 'Dermatology', 24, 21, 'Requires Update', 'Incomplete coursework for DERM302.', '2026-04-13 11:03:49');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `medicine`
--
ALTER TABLE `medicine`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `medicine`
--
ALTER TABLE `medicine`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
