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
-- Table structure for table `catering`
--

CREATE TABLE `catering` (
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
-- Dumping data for table `catering`
--

INSERT INTO `catering` (`id`, `username`, `full_name`, `department`, `item_name`, `quantity_lost`, `cost_of_item`, `status`, `comments`, `last_updated`) VALUES
(1, 'CP/COMP/1099/21', 'Grafaa Delaprince', 'Computing', 'Lunch Tray', 2, 500.00, 'Requires Update', 'Unpaid catering charges', '2026-04-13 10:56:33'),
(2, 'CP/COMP/1001/21', 'Brian Mwangi', 'Computing', 'Breakfast Meal', 0, 500.00, 'Approved', 'No outstanding issues', '2026-04-13 10:56:33'),
(3, 'CP/COMP/1005/21', 'Linda Achieng', 'Computing', 'Dinner Plate', 0, 500.00, 'Approved', 'All meals accounted for', '2026-04-13 10:56:33'),
(4, 'CP/COMP/1010/21', 'Mark Kamau', 'Computing', 'Tea Cups', 1, 500.00, 'Pending', 'Missing item reported', '2026-04-13 10:56:33'),
(5, 'CP/COMP/1017/21', 'Grace Wanjiru', 'Computing', 'Lunch Tray', 0, 500.00, 'Approved', 'Cleared', '2026-04-13 10:56:33'),
(6, 'SCI/PS/1001/21', 'Kwame Mensah', 'Science', 'Lab Catering Pack', 1, 500.00, 'Pending', 'Pending replacement fee', '2026-04-13 10:56:33'),
(7, 'SCI/BI/1004/21', 'Samuel Okoth', 'Science', 'Breakfast Set', 0, 500.00, 'Approved', 'No issues', '2026-04-13 10:56:33'),
(8, 'SCI/MT/1008/21', 'Chika Amadi', 'Science', 'Dinner Set', 1, 500.00, 'Requires Update', 'Lost meal tray', '2026-04-13 10:56:33'),
(9, 'SCI/PS/1011/21', 'Mercy Otieno', 'Science', 'Lunch Pack', 0, 500.00, 'Approved', 'All clear', '2026-04-13 10:56:33'),
(10, 'BUSS/FC/1002/21', 'Fatima Abubakar', 'Business', 'Tea Set', 1, 500.00, 'Requires Update', 'Unreturned items', '2026-04-13 10:56:33'),
(11, 'BUSS/MAR/1007/21', 'Grace Njeri', 'Business', 'Lunch Tray', 0, 500.00, 'Approved', 'Cleared', '2026-04-13 10:56:33'),
(12, 'BUSS/EC/1012/21', 'Ibrahim Suleiman', 'Business', 'Dinner Plate', 0, 500.00, 'Approved', 'No issues', '2026-04-13 10:56:33'),
(13, 'BUSS/ACC/1016/21', 'Michael Onyango', 'Business', 'Breakfast Set', 0, 500.00, 'Approved', 'All returned', '2026-04-13 10:56:33'),
(14, 'ART/HIST/1003/21', 'Josephine Nyong', 'Arts', 'Lunch Tray', 1, 500.00, 'Pending', 'Missing tray reported', '2026-04-13 10:56:33'),
(15, 'ART/LING/1009/21', 'Eunice Wanjiku', 'Arts', 'Tea Cup Set', 0, 500.00, 'Approved', 'No issues', '2026-04-13 10:56:33'),
(16, 'ART/PHIL/1013/21', 'Abena Gyasi', 'Arts', 'Dinner Plate', 1, 500.00, 'Pending', 'Lost plate', '2026-04-13 10:56:33'),
(17, 'ART/LIT/1017/21', 'Patience Ouma', 'Arts', 'Breakfast Set', 0, 500.00, 'Approved', 'Cleared', '2026-04-13 10:56:33'),
(18, 'ENG/CV/1005/21', 'Amina Juma', 'Engineering', 'Lunch Set', 0, 500.00, 'Approved', 'All items returned', '2026-04-13 10:56:33'),
(19, 'ENG/MC/1010/21', 'Babatunde Adebayo', 'Engineering', 'Dinner Tray', 1, 500.00, 'Pending', 'Lost tray reported', '2026-04-13 10:56:33'),
(20, 'LAW/CRL/1006/21', 'David Ochieng', 'Law', 'Tea Set', 0, 500.00, 'Approved', 'No issues', '2026-04-13 10:56:33'),
(21, 'LAW/CML/1015/21', 'Lucy Kamau', 'Law', 'Lunch Plate', 0, 500.00, 'Approved', 'Cleared', '2026-04-13 10:56:33'),
(22, 'ED/EDU/1012/21', 'John Kimani', 'Education', 'Breakfast Set', 0, 500.00, 'Approved', 'No issues', '2026-04-13 10:56:33'),
(23, 'ED/EDU/1025/21', 'Grace Achieng', 'Education', 'Lunch Tray', 0, 500.00, 'Approved', 'Cleared', '2026-04-13 10:56:33'),
(24, 'ED/EDU/1033/21', 'Fatima Khalid', 'Education', 'Dinner Plate', 1, 500.00, 'Pending', 'Missing plate', '2026-04-13 10:56:33'),
(25, 'ED/EDU/1044/21', 'Daniel Mutua', 'Education', 'Tea Set', 1, 500.00, 'Requires Update', 'Lost catering items', '2026-04-13 10:56:33'),
(26, 'ED/EDU/1056/21', 'Alice Njenga', 'Education', 'Lunch Set', 0, 500.00, 'Approved', 'All clear', '2026-04-13 10:56:33'),
(27, 'ED/EDU/1061/21', 'Robert Ochieng', 'Education', 'Breakfast Tray', 0, 500.00, 'Approved', 'No issues', '2026-04-13 10:56:33'),
(28, 'ED/EDU/1074/21', 'Esther Wanjiru', 'Education', 'Dinner Set', 1, 500.00, 'Pending', 'Missing dinner set', '2026-04-13 10:56:33');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `catering`
--
ALTER TABLE `catering`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `catering`
--
ALTER TABLE `catering`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
