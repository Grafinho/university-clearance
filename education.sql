-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3307
-- Generation Time: Apr 26, 2026 at 06:53 PM
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
-- Table structure for table `education`
--

CREATE TABLE `education` (
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
-- Dumping data for table `education`
--

INSERT INTO `education` (`id`, `username`, `full_name`, `department`, `total_units`, `units_completed`, `status`, `comments`, `last_updated`) VALUES
(1, 'ED/EDU/1012/21', 'John Kimani', 'Curriculum Development', 10, 7, 'Pending', 'Missing marks for Comp 245', '2026-04-13 11:00:46'),
(2, 'ED/EDU/1025/21', 'Grace Achieng', 'Educational Psychology', 12, 11, 'Approved', 'Completed unit assessment.', '2026-04-13 11:00:46'),
(3, 'ED/EDU/1033/21', 'Fatima Khalid', 'Special Needs Education', 15, 10, 'Pending', 'Pending submission of final project.', '2026-04-13 11:00:46'),
(4, 'ED/EDU/1044/21', 'Daniel Mutua', 'Physical Education', 8, 5, 'Requires Update', 'Missing attendance records for PE101.', '2026-04-13 11:00:46'),
(5, 'ED/EDU/1056/21', 'Alice Njenga', 'Early Childhood Education', 18, 16, 'Pending', 'Awaiting final exam scores.', '2026-04-13 11:00:46'),
(6, 'ED/EDU/1061/21', 'Robert Ochieng', 'Teacher Training', 20, 18, 'Approved', 'Final clearance approved.', '2026-04-13 11:00:46'),
(7, 'ED/EDU/1074/21', 'Esther Wanjiru', 'Instructional Design', 10, 8, 'Pending', 'Pending practical teaching evaluation.', '2026-04-13 11:00:46');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `education`
--
ALTER TABLE `education`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `education`
--
ALTER TABLE `education`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
