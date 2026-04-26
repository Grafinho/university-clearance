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
-- Table structure for table `comtech`
--

CREATE TABLE `comtech` (
  `id` int(11) NOT NULL,
  `username` varchar(20) NOT NULL,
  `full_name` varchar(100) NOT NULL,
  `department` varchar(100) NOT NULL,
  `item_name` varchar(255) DEFAULT NULL,
  `quantity_lost` int(11) DEFAULT 1,
  `cost_of_item` decimal(10,2) NOT NULL,
  `fine` decimal(10,2) GENERATED ALWAYS AS (`quantity_lost` * `cost_of_item`) STORED,
  `status` varchar(20) DEFAULT 'Pending',
  `comments` text DEFAULT NULL,
  `last_updated` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `comtech`
--

INSERT INTO `comtech` (`id`, `username`, `full_name`, `department`, `item_name`, `quantity_lost`, `cost_of_item`, `status`, `comments`, `last_updated`) VALUES
(1, 'CP/COMP/1099/21', 'Grafaa Delaprince', 'Computing', 'Radio Microphone', 1, 800.00, 'Requires Update', 'Unreturned studio microphone', '2026-04-13 10:57:04'),
(2, 'CP/COMP/1001/21', 'Brian Mwangi', 'Computing', 'Headphones', 0, 800.00, 'Approved', 'All equipment returned', '2026-04-13 10:57:04'),
(3, 'CP/COMP/1005/21', 'Linda Achieng', 'Computing', 'Audio Mixer', 0, 1500.00, 'Approved', 'No issues reported', '2026-04-13 10:57:04'),
(4, 'CP/COMP/1010/21', 'Mark Kamau', 'Computing', 'Studio Camera', 1, 2500.00, 'Pending', 'Camera not returned', '2026-04-13 10:57:04'),
(5, 'CP/COMP/1017/21', 'Grace Wanjiru', 'Computing', 'Boom Microphone', 0, 900.00, 'Approved', 'Cleared', '2026-04-13 10:57:04'),
(6, 'SCI/PS/1001/21', 'Kwame Mensah', 'Science', 'Recording Mic', 1, 800.00, 'Pending', 'Mic damaged during recording', '2026-04-13 10:57:04'),
(7, 'SCI/BI/1004/21', 'Samuel Okoth', 'Science', 'Studio Headset', 0, 600.00, 'Approved', 'No issues', '2026-04-13 10:57:04'),
(8, 'SCI/MT/1008/21', 'Chika Amadi', 'Science', 'Sound Recorder', 1, 1200.00, 'Requires Update', 'Device missing', '2026-04-13 10:57:04'),
(9, 'SCI/PS/1011/21', 'Mercy Otieno', 'Science', 'Radio Console', 0, 3000.00, 'Approved', 'All equipment returned', '2026-04-13 10:57:04'),
(10, 'BUSS/FC/1002/21', 'Fatima Abubakar', 'Business', 'Studio Microphone', 1, 800.00, 'Requires Update', 'Microphone not returned', '2026-04-13 10:57:04'),
(11, 'BUSS/MAR/1007/21', 'Grace Njeri', 'Business', 'Headset', 0, 500.00, 'Approved', 'Cleared', '2026-04-13 10:57:04'),
(12, 'BUSS/EC/1012/21', 'Ibrahim Suleiman', 'Business', 'Audio Recorder', 0, 1000.00, 'Approved', 'No issues', '2026-04-13 10:57:04'),
(13, 'BUSS/ACC/1016/21', 'Michael Onyango', 'Business', 'Broadcast Mixer', 0, 2500.00, 'Approved', 'Returned', '2026-04-13 10:57:04'),
(14, 'ART/HIST/1003/21', 'Josephine Nyong', 'Arts', 'Studio Microphone', 1, 800.00, 'Pending', 'Mic missing after recording', '2026-04-13 10:57:04'),
(15, 'ART/LING/1009/21', 'Eunice Wanjiku', 'Arts', 'Headphones', 0, 500.00, 'Approved', 'No issues', '2026-04-13 10:57:04'),
(16, 'ART/PHIL/1013/21', 'Abena Gyasi', 'Arts', 'Recording Console', 1, 2000.00, 'Pending', 'Console not returned', '2026-04-13 10:57:04'),
(17, 'ART/LIT/1017/21', 'Patience Ouma', 'Arts', 'Boom Mic', 0, 900.00, 'Approved', 'Cleared', '2026-04-13 10:57:04'),
(18, 'ENG/CV/1005/21', 'Amina Juma', 'Engineering', 'Studio Camera', 0, 2500.00, 'Approved', 'All equipment returned', '2026-04-13 10:57:04'),
(19, 'ENG/MC/1010/21', 'Babatunde Adebayo', 'Engineering', 'Audio Mixer', 1, 1500.00, 'Pending', 'Mixer damaged', '2026-04-13 10:57:04'),
(20, 'LAW/CRL/1006/21', 'David Ochieng', 'Law', 'Radio Microphone', 0, 800.00, 'Approved', 'No issues', '2026-04-13 10:57:04'),
(21, 'LAW/CML/1015/21', 'Lucy Kamau', 'Law', 'Headset', 0, 500.00, 'Approved', 'Cleared', '2026-04-13 10:57:04'),
(22, 'ED/EDU/1012/21', 'John Kimani', 'Education', 'Studio Mic', 0, 800.00, 'Approved', 'No issues', '2026-04-13 10:57:04'),
(23, 'ED/EDU/1025/21', 'Grace Achieng', 'Education', 'Sound Recorder', 0, 1200.00, 'Approved', 'Returned', '2026-04-13 10:57:04'),
(24, 'ED/EDU/1033/21', 'Fatima Khalid', 'Education', 'Broadcast Mixer', 1, 2500.00, 'Pending', 'Missing mixer', '2026-04-13 10:57:04'),
(25, 'ED/EDU/1044/21', 'Daniel Mutua', 'Education', 'Headphones', 1, 500.00, 'Requires Update', 'Lost headset', '2026-04-13 10:57:04'),
(26, 'ED/EDU/1056/21', 'Alice Njenga', 'Education', 'Radio Console', 0, 3000.00, 'Approved', 'All clear', '2026-04-13 10:57:04'),
(27, 'ED/EDU/1061/21', 'Robert Ochieng', 'Education', 'Studio Mic', 0, 800.00, 'Approved', 'No issues', '2026-04-13 10:57:04'),
(28, 'ED/EDU/1074/21', 'Esther Wanjiru', 'Education', 'Recording Mic', 1, 800.00, 'Pending', 'Mic missing', '2026-04-13 10:57:04');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `comtech`
--
ALTER TABLE `comtech`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `comtech`
--
ALTER TABLE `comtech`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
