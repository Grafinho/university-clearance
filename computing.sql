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
-- Table structure for table `computing`
--

CREATE TABLE `computing` (
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
-- Dumping data for table `computing`
--

INSERT INTO `computing` (`id`, `username`, `full_name`, `department`, `total_units`, `units_completed`, `status`, `comments`, `last_updated`) VALUES
(1, 'CP/COMP/1001/21', 'Brian Mwangi', 'Software Engineering', 40, 35, 'Pending', 'Capstone project review in progress.', '2026-04-13 10:57:26'),
(2, 'CP/COMP/1005/21', 'Linda Achieng', 'Cybersecurity', 38, 38, 'Approved', 'Clearance completed without issues.', '2026-04-13 10:57:26'),
(3, 'CP/COMP/1010/21', 'Mark Kamau', 'Data Science', 36, 30, 'Requires Update', 'Missing final project data files.', '2026-04-13 10:57:26'),
(4, 'CP/COMP/1017/21', 'Grace Wanjiru', 'Artificial Intelligence', 35, 28, 'Pending', 'Awaiting peer evaluation for AI capstone project.', '2026-04-13 10:57:26'),
(5, 'CP/COMP/1023/21', 'Dennis Njoroge', 'Network Administration', 30, 25, 'Pending', 'Network lab practical results not yet submitted.', '2026-04-13 10:57:26'),
(6, 'CP/COMP/1029/21', 'Diana Ndungu', 'Web Development', 32, 32, 'Approved', 'All coursework and projects reviewed and approved.', '2026-04-13 10:57:26'),
(7, 'CP/COMP/1034/21', 'Kevin Omondi', 'Mobile Computing', 33, 29, 'Requires Update', 'Additional documentation needed for project MC401.', '2026-04-13 10:57:26');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `computing`
--
ALTER TABLE `computing`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `computing`
--
ALTER TABLE `computing`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
