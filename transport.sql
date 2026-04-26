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
-- Table structure for table `transport`
--

CREATE TABLE `transport` (
  `id` int(11) NOT NULL,
  `username` varchar(20) NOT NULL,
  `full_name` varchar(100) NOT NULL,
  `department` varchar(100) NOT NULL,
  `route` varchar(255) DEFAULT NULL,
  `pending_fare` decimal(10,2) DEFAULT 0.00,
  `status` varchar(20) DEFAULT 'Pending',
  `comments` text DEFAULT NULL,
  `last_updated` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `transport`
--

INSERT INTO `transport` (`id`, `username`, `full_name`, `department`, `route`, `pending_fare`, `status`, `comments`, `last_updated`) VALUES
(1, 'CP/COMP/1099/21', 'Grafaa Delaprince', 'TRANSPORT', 'Main Campus - CBD', 1200.00, 'Requires Update', 'Pending bus fare clearance.', '2026-04-13 11:03:55'),
(2, 'CP/COMP/1001/21', 'Brian Mwangi', 'TRANSPORT', 'Main Campus - Rongai', 0.00, 'Approved', 'All transport fees cleared.', '2026-04-13 11:03:55'),
(3, 'CP/COMP/1005/21', 'Linda Achieng', 'TRANSPORT', 'Main Campus - Westlands', 0.00, 'Approved', 'No pending transport issues.', '2026-04-13 11:03:55'),
(4, 'CP/COMP/1010/21', 'Mark Kamau', 'TRANSPORT', 'Main Campus - Ngong', 800.00, 'Pending', 'Outstanding transport balance.', '2026-04-13 11:03:55'),
(5, 'CP/COMP/1017/21', 'Grace Wanjiru', 'TRANSPORT', 'Main Campus - Thika Road', 0.00, 'Approved', 'Transport cleared.', '2026-04-13 11:03:55'),
(6, 'CP/COMP/1023/21', 'Dennis Njoroge', 'TRANSPORT', 'Main Campus - CBD', 600.00, 'Requires Update', 'Pending transport verification.', '2026-04-13 11:03:55'),
(7, 'CP/COMP/1029/21', 'Diana Ndungu', 'TRANSPORT', 'Main Campus - Kiserian', 0.00, 'Approved', 'No issues reported.', '2026-04-13 11:03:55'),
(8, 'CP/COMP/1034/21', 'Kevin Omondi', 'TRANSPORT', 'Main Campus - Kitengela', 500.00, 'Pending', 'Partial payment made.', '2026-04-13 11:03:55'),
(9, 'SCI/PS/1001/21', 'Kwame Mensah', 'TRANSPORT', 'Main Campus - CBD', 700.00, 'Pending', 'Outstanding fare.', '2026-04-13 11:03:55'),
(10, 'SCI/BI/1004/21', 'Samuel Okoth', 'TRANSPORT', 'Main Campus - Rongai', 0.00, 'Approved', 'Transport cleared.', '2026-04-13 11:03:55'),
(11, 'SCI/MT/1008/21', 'Chika Amadi', 'TRANSPORT', 'Main Campus - Westlands', 900.00, 'Requires Update', 'Pending fare payment.', '2026-04-13 11:03:55'),
(12, 'SCI/PS/1011/21', 'Mercy Otieno', 'TRANSPORT', 'Main Campus - Ngong', 0.00, 'Approved', 'No pending issues.', '2026-04-13 11:03:55'),
(13, 'SCI/ES/1020/21', 'Asha Mohammed', 'TRANSPORT', 'Main Campus - CBD', 400.00, 'Pending', 'Outstanding balance.', '2026-04-13 11:03:55'),
(14, 'SCI/CH/1023/21', 'Njeri Wachira', 'TRANSPORT', 'Main Campus - Thika Road', 300.00, 'Pending', 'Late payment.', '2026-04-13 11:03:55'),
(15, 'BUSS/FC/1002/21', 'Fatima Abubakar', 'TRANSPORT', 'Main Campus - Kiserian', 1000.00, 'Requires Update', 'Pending clearance.', '2026-04-13 11:03:55'),
(16, 'BUSS/MAR/1007/21', 'Grace Njeri', 'TRANSPORT', 'Main Campus - Rongai', 0.00, 'Approved', 'All fees cleared.', '2026-04-13 11:03:55'),
(17, 'BUSS/EC/1012/21', 'Ibrahim Suleiman', 'TRANSPORT', 'Main Campus - CBD', 0.00, 'Approved', 'No issues.', '2026-04-13 11:03:55'),
(18, 'BUSS/ACC/1016/21', 'Michael Onyango', 'TRANSPORT', 'Main Campus - Ngong', 0.00, 'Approved', 'Transport cleared.', '2026-04-13 11:03:55'),
(19, 'BUSS/ET/1018/21', 'Amara Okoro', 'TRANSPORT', 'Main Campus - Kitengela', 650.00, 'Pending', 'Outstanding fare.', '2026-04-13 11:03:55'),
(20, 'BUSS/ACC/1024/21', 'Adisa Balogun', 'TRANSPORT', 'Main Campus - Westlands', 850.00, 'Requires Update', 'Pending payment.', '2026-04-13 11:03:55'),
(21, 'ART/HIST/1003/21', 'Josephine Nyong', 'TRANSPORT', 'Main Campus - CBD', 500.00, 'Pending', 'Awaiting payment.', '2026-04-13 11:03:55'),
(22, 'ART/LING/1009/21', 'Eunice Wanjiku', 'TRANSPORT', 'Main Campus - Rongai', 0.00, 'Approved', 'No issues.', '2026-04-13 11:03:55'),
(23, 'ART/PHIL/1013/21', 'Abena Gyasi', 'TRANSPORT', 'Main Campus - Ngong', 400.00, 'Pending', 'Outstanding balance.', '2026-04-13 11:03:55'),
(24, 'ART/LIT/1017/21', 'Patience Ouma', 'TRANSPORT', 'Main Campus - Thika Road', 0.00, 'Approved', 'Transport cleared.', '2026-04-13 11:03:55'),
(25, 'ART/SOCI/1019/21', 'Chinedu Eze', 'TRANSPORT', 'Main Campus - CBD', 0.00, 'Approved', 'No issues.', '2026-04-13 11:03:55'),
(26, 'ART/PSY/1022/21', 'Obinna Nwachukwu', 'TRANSPORT', 'Main Campus - Westlands', 600.00, 'Requires Update', 'Pending payment.', '2026-04-13 11:03:55'),
(27, 'ART/FIN/1025/21', 'Zainab Diallo', 'TRANSPORT', 'Main Campus - Kitengela', 550.00, 'Pending', 'Outstanding fare.', '2026-04-13 11:03:55'),
(28, 'ENG/CV/1005/21', 'Amina Juma', 'TRANSPORT', 'Main Campus - Rongai', 0.00, 'Approved', 'Transport cleared.', '2026-04-13 11:03:55'),
(29, 'ENG/MC/1010/21', 'Babatunde Adebayo', 'TRANSPORT', 'Main Campus - CBD', 700.00, 'Pending', 'Pending payment.', '2026-04-13 11:03:55'),
(30, 'ENG/EL/1014/21', 'Felix Mukasa', 'TRANSPORT', 'Main Campus - Ngong', 0.00, 'Approved', 'No issues.', '2026-04-13 11:03:55'),
(31, 'LAW/CRL/1006/21', 'David Ochieng', 'TRANSPORT', 'Main Campus - Thika Road', 0.00, 'Approved', 'Cleared.', '2026-04-13 11:03:55'),
(32, 'LAW/CML/1015/21', 'Lucy Kamau', 'TRANSPORT', 'Main Campus - CBD', 0.00, 'Approved', 'All fees paid.', '2026-04-13 11:03:55'),
(33, 'LAW/HRL/1021/21', 'Thandiwe Ndlovu', 'TRANSPORT', 'Main Campus - Westlands', 0.00, 'Approved', 'No pending issues.', '2026-04-13 11:03:55'),
(34, 'ED/EDU/1012/21', 'John Kimani', 'TRANSPORT', 'Main Campus - Rongai', 0.00, 'Approved', 'Cleared.', '2026-04-13 11:03:55'),
(35, 'ED/EDU/1025/21', 'Grace Achieng', 'TRANSPORT', 'Main Campus - CBD', 0.00, 'Approved', 'No issues.', '2026-04-13 11:03:55'),
(36, 'ED/EDU/1033/21', 'Fatima Khalid', 'TRANSPORT', 'Main Campus - Ngong', 500.00, 'Pending', 'Pending transport clearance.', '2026-04-13 11:03:55'),
(37, 'ED/EDU/1044/21', 'Daniel Mutua', 'TRANSPORT', 'Main Campus - Kitengela', 750.00, 'Requires Update', 'Outstanding fare.', '2026-04-13 11:03:55'),
(38, 'ED/EDU/1056/21', 'Alice Njenga', 'TRANSPORT', 'Main Campus - Thika Road', 0.00, 'Approved', 'Transport cleared.', '2026-04-13 11:03:55'),
(39, 'ED/EDU/1061/21', 'Robert Ochieng', 'TRANSPORT', 'Main Campus - CBD', 0.00, 'Approved', 'No issues.', '2026-04-13 11:03:55'),
(40, 'ED/EDU/1074/21', 'Esther Wanjiru', 'TRANSPORT', 'Main Campus - Westlands', 0.00, 'Pending', 'Pending fare clearance.', '2026-04-13 11:03:55');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `transport`
--
ALTER TABLE `transport`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `transport`
--
ALTER TABLE `transport`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
