-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3307
-- Generation Time: Apr 26, 2026 at 06:55 PM
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
-- Table structure for table `science`
--

CREATE TABLE `science` (
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
-- Dumping data for table `science`
--

INSERT INTO `science` (`id`, `username`, `full_name`, `department`, `total_units`, `units_completed`, `status`, `comments`, `last_updated`) VALUES
(1, 'ED/SCI/1001/21', 'Kwame Mensah', 'Physics', 10, 8, 'Pending', 'Clear incomplete units', '2026-04-13 11:03:49'),
(2, 'ED/SCI/1004/21', 'Samuel Okoth', 'Biology', 12, 10, 'Pending', 'Clear units', '2026-04-13 11:03:49'),
(3, 'ED/SCI/1008/21', 'Chika Amadi', 'Mathematics', 15, 13, 'Pending', 'Clear units', '2026-04-13 11:03:49'),
(4, 'ED/SCI/1011/21', 'Mercy Otieno', 'Computer Science', 20, 18, 'Pending', 'Clear units', '2026-04-13 11:03:49'),
(5, 'ED/SCI/1020/21', 'Asha Mohammed', 'Environmental Science', 8, 6, 'Pending', 'Clear units', '2026-04-13 11:03:49'),
(6, 'ED/SCI/1023/21', 'Njeri Wachira', 'Chemistry', 10, 9, 'Pending', 'Clear units', '2026-04-13 11:03:49'),
(7, 'ED/SCI/1001/21', 'Kwame Mensah', 'Physics', 10, 8, 'Pending', 'Clear units', '2026-04-13 11:03:49'),
(8, 'ED/SCI/1004/21', 'Samuel Okoth', 'Biology', 12, 10, 'Pending', 'Clear units', '2026-04-13 11:03:49'),
(9, 'ED/SCI/1008/21', 'Chika Amadi', 'Mathematics', 15, 13, 'Pending', 'Clear units', '2026-04-13 11:03:49'),
(10, 'ED/SCI/1011/21', 'Mercy Otieno', 'Computer Science', 20, 18, 'Pending', 'Clear units', '2026-04-13 11:03:49'),
(11, 'ED/SCI/1020/21', 'Asha Mohammed', 'Environmental Science', 8, 6, 'Pending', 'Clear units', '2026-04-13 11:03:49'),
(12, 'ED/SCI/1023/21', 'Njeri Wachira', 'Chemistry', 10, 9, 'Pending', 'Clear units', '2026-04-13 11:03:49');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `science`
--
ALTER TABLE `science`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `science`
--
ALTER TABLE `science`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
