-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3307
-- Generation Time: Apr 26, 2026 at 06:52 PM
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
-- Table structure for table `business`
--

CREATE TABLE `business` (
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
-- Dumping data for table `business`
--

INSERT INTO `business` (`id`, `username`, `full_name`, `department`, `total_units`, `units_completed`, `status`, `comments`, `last_updated`) VALUES
(1, 'BUSS/FC/1002/21', 'Fatima Abubakar', 'BUSINESS', 1, 0, 'Requires Update', 'Lost property report filed; awaiting clearance from lost and found.', '2026-04-13 10:54:52'),
(2, 'BUSS/MAR/1007/21', 'Grace Njeri', 'BUSINESS', 1, 1, 'Approved', 'Misplaced documents recovered.', '2026-04-13 10:54:52'),
(3, 'BUSS/EC/1012/21', 'Ibrahim Suleiman', 'BUSINESS', 1, 1, 'Approved', 'Student conflict resolved.', '2026-04-13 10:54:52'),
(4, 'BUSS/ACC/1016/21', 'Michael Onyango', 'BUSINESS', 1, 1, 'Approved', 'Unreturned keys returned.', '2026-04-13 10:54:52'),
(5, 'BUSS/ET/1018/21', 'Amara Okoro', 'BUSINESS', 1, 0, 'Requires Update', 'Fire safety violation under review.', '2026-04-13 10:54:52'),
(6, 'BUSS/ACC/1024/21', 'Adisa Balogun', 'BUSINESS', 1, 1, 'Approved', 'Late clearance submission resolved.', '2026-04-13 10:54:52');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `business`
--
ALTER TABLE `business`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `business`
--
ALTER TABLE `business`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
