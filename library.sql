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
-- Table structure for table `library`
--

CREATE TABLE `library` (
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
-- Dumping data for table `library`
--

INSERT INTO `library` (`id`, `username`, `full_name`, `department`, `item_name`, `quantity_lost`, `cost_of_item`, `status`, `comments`, `last_updated`) VALUES
(1, 'CP/COMP/1099/21', 'Grafaa Delaprince', 'COMPUTER SCIENCE', 'Database Systems Book', 2, 1500.00, 'Requires Update', 'Pending payment for lost books.', '2026-04-13 11:03:49'),
(2, 'CP/COMP/1001/21', 'Brian Mwangi', 'COMPUTER SCIENCE', NULL, 0, 1500.00, 'Approved', 'All books returned.', '2026-04-13 11:03:49'),
(3, 'CP/COMP/1010/21', 'Mark Kamau', 'COMPUTER SCIENCE', 'Networking Book', 1, 1500.00, 'Pending', 'One book missing.', '2026-04-13 11:03:49'),
(4, 'CP/COMP/1023/21', 'Dennis Njoroge', 'COMPUTER SCIENCE', 'Programming Book', 1, 1500.00, 'Requires Update', 'Lost book reported.', '2026-04-13 11:03:49'),
(5, 'SCI/PS/1001/21', 'Kwame Mensah', 'SCIENCE', 'Physics Textbook', 1, 1500.00, 'Pending', 'Damaged book fine pending.', '2026-04-13 11:03:49'),
(6, 'SCI/BI/1004/21', 'Samuel Okoth', 'SCIENCE', NULL, 0, 1500.00, 'Approved', 'All returned.', '2026-04-13 11:03:49'),
(7, 'SCI/MT/1008/21', 'Chika Amadi', 'SCIENCE', 'Mathematics Book', 2, 1500.00, 'Requires Update', 'Multiple losses.', '2026-04-13 11:03:49'),
(8, 'BUSS/FC/1002/21', 'Fatima Abubakar', 'BUSINESS', 'Finance Book', 1, 1500.00, 'Requires Update', 'Outstanding fine.', '2026-04-13 11:03:49'),
(9, 'BUSS/MAR/1007/21', 'Grace Njeri', 'BUSINESS', NULL, 0, 1500.00, 'Approved', 'No issues.', '2026-04-13 11:03:49'),
(10, 'BUSS/ET/1018/21', 'Amara Okoro', 'BUSINESS', 'Entrepreneurship Book', 1, 1500.00, 'Pending', 'Missing book.', '2026-04-13 11:03:49'),
(11, 'ART/HIST/1003/21', 'Josephine Nyong', 'ARTS', 'History Book', 1, 1500.00, 'Pending', 'Damaged book.', '2026-04-13 11:03:49'),
(12, 'ART/LING/1009/21', 'Eunice Wanjiku', 'ARTS', NULL, 0, 1500.00, 'Approved', 'Clear record.', '2026-04-13 11:03:49'),
(13, 'ART/PSY/1022/21', 'Obinna Nwachukwu', 'ARTS', 'Psychology Book', 2, 1500.00, 'Requires Update', 'Multiple losses.', '2026-04-13 11:03:49'),
(14, 'ENG/CV/1005/21', 'Amina Juma', 'ENGINEERING', NULL, 0, 1500.00, 'Approved', 'All returned.', '2026-04-13 11:03:49'),
(15, 'ENG/MC/1010/21', 'Babatunde Adebayo', 'ENGINEERING', 'Mechanics Book', 1, 1500.00, 'Pending', 'Lost book.', '2026-04-13 11:03:49'),
(16, 'LAW/CRL/1006/21', 'David Ochieng', 'LAW', NULL, 0, 1500.00, 'Approved', 'No issues.', '2026-04-13 11:03:49'),
(17, 'ED/EDU/1033/21', 'Fatima Khalid', 'EDUCATION', 'Teaching Methods Book', 1, 1500.00, 'Pending', 'Lost book.', '2026-04-13 11:03:49'),
(18, 'ED/EDU/1044/21', 'Daniel Mutua', 'EDUCATION', 'Curriculum Book', 1, 1500.00, 'Requires Update', 'Not resolved.', '2026-04-13 11:03:49'),
(19, 'ED/EDU/1074/21', 'Esther Wanjiru', 'EDUCATION', 'Education Psychology Book', 1, 1500.00, 'Pending', 'Missing book.', '2026-04-13 11:03:49');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `library`
--
ALTER TABLE `library`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `library`
--
ALTER TABLE `library`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
