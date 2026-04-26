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
-- Table structure for table `arts`
--

CREATE TABLE `arts` (
  `id` int(11) NOT NULL,
  `username` varchar(20) NOT NULL,
  `full_name` varchar(100) NOT NULL,
  `department` varchar(100) NOT NULL,
  `total_units` int(11) NOT NULL,
  `units_completed` int(11) NOT NULL,
  `incomplete_units` int(11) GENERATED ALWAYS AS (`total_units` - `units_completed`) STORED,
  `status` varchar(20) DEFAULT NULL,
  `comments` text DEFAULT NULL,
  `last_updated` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `arts`
--

INSERT INTO `arts` (`id`, `username`, `full_name`, `department`, `total_units`, `units_completed`, `status`, `comments`, `last_updated`) VALUES
(1, 'ART/HIST/1003/21', 'Josephine Nyong', 'ARTS', 6, 1, 'Pending', 'Reminder issued for failure to produce ID on request.', '2026-04-13 16:17:20'),
(2, 'ART/LING/1009/21', 'Eunice Wanjiku', 'ARTS', 1, 0, 'Pending', 'Under review for vandalism incident.', '2026-04-13 08:50:45'),
(3, 'ART/PHIL/1013/21', 'Abena Gyasi', 'ARTS', 1, 1, 'Pending', 'Missed security briefing; scheduled follow-up.', '2026-04-13 08:50:45'),
(4, 'ART/LIT/1017/21', 'Patience Ouma', 'ARTS', 1, 1, 'Approved', 'Noise complaints resolved successfully.', '2026-04-13 08:50:45'),
(5, 'ART/SOCI/1019/21', 'Chinedu Eze', 'ARTS', 1, 0, 'Pending', 'Unauthorized gathering under review.', '2026-04-13 08:50:45'),
(6, 'ART/PSY/1022/21', 'Obinna Nwachukwu', 'ARTS', 1, 0, 'Requires Update', 'Confidentiality breach awaiting decision.', '2026-04-13 08:50:45'),
(7, 'ART/FIN/1025/21', 'Zainab Diallo', 'ARTS', 1, 0, 'Pending', 'Unauthorized financial documents escalated.', '2026-04-13 08:50:45');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `arts`
--
ALTER TABLE `arts`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `arts`
--
ALTER TABLE `arts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
