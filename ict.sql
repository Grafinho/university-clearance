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
-- Table structure for table `ict`
--

CREATE TABLE `ict` (
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
-- Dumping data for table `ict`
--

INSERT INTO `ict` (`id`, `username`, `full_name`, `department`, `item_name`, `quantity_lost`, `cost_of_item`, `status`, `comments`, `last_updated`) VALUES
(1, 'CP/COMP/1099/21', 'Grafaa Delaprince', 'ICT', 'Laptop charger', 1, 1200.00, 'Requires Update', 'Pending resolution for a missing laptop charger.', '2026-04-13 11:00:47'),
(2, 'CP/COMP/1001/21', 'Brian Mwangi', 'ICT', 'None', 0, 1200.00, 'Approved', 'All items returned without issues.', '2026-04-13 11:00:47'),
(3, 'CP/COMP/1005/21', 'Linda Achieng', 'ICT', 'None', 0, 1200.00, 'Approved', 'No issues reported during borrowing period.', '2026-04-13 11:00:47'),
(4, 'CP/COMP/1010/21', 'Mark Kamau', 'ICT', 'Computer mouse', 1, 1200.00, 'Pending', 'Pending fine for a lost mouse.', '2026-04-13 11:00:47'),
(5, 'CP/COMP/1017/21', 'Grace Wanjiru', 'ICT', 'None', 0, 1200.00, 'Approved', 'Clear record; no delays.', '2026-04-13 11:00:47'),
(6, 'CP/COMP/1023/21', 'Dennis Njoroge', 'ICT', 'Monitor', 1, 1200.00, 'Requires Update', 'Pending review for a damaged monitor.', '2026-04-13 11:00:47'),
(7, 'CP/COMP/1029/21', 'Diana Ndungu', 'ICT', 'None', 0, 1200.00, 'Approved', 'All items returned on time.', '2026-04-13 11:00:47'),
(8, 'CP/COMP/1034/21', 'Kevin Omondi', 'ICT', 'Ethernet cable', 1, 1200.00, 'Pending', 'Damage report for an Ethernet cable under review.', '2026-04-13 11:00:47'),
(9, 'SCI/PS/1001/21', 'Kwame Mensah', 'ICT', 'None', 1, 1200.00, 'Pending', 'Returned items late; awaiting approval.', '2026-04-13 11:00:47'),
(10, 'SCI/BI/1004/21', 'Samuel Okoth', 'ICT', NULL, 0, 1200.00, 'Approved', 'All equipment accounted for.', '2026-04-13 11:00:47'),
(11, 'SCI/MT/1008/21', 'Chika Amadi', 'ICT', 'Unknown device', 1, 1200.00, 'Requires Update', 'Lost item reported; awaiting replacement.', '2026-04-13 11:00:47'),
(12, 'SCI/PS/1011/21', 'Mercy Otieno', 'ICT', 'None', 0, 1200.00, 'Approved', 'No outstanding charges or issues.', '2026-04-13 11:00:47'),
(13, 'SCI/ES/1020/21', 'Asha Mohammed', 'ICT', 'Equipment', 1, 1200.00, 'Pending', 'Lost equipment awaiting resolution.', '2026-04-13 11:00:47'),
(14, 'SCI/CH/1023/21', 'Njeri Wachira', 'ICT', 'None', 1, 1200.00, 'Pending', 'Pending fine for delayed returns.', '2026-04-13 11:00:47'),
(15, 'BUSS/FC/1002/21', 'Fatima Abubakar', 'ICT', 'Unknown device', 1, 1200.00, 'Requires Update', 'Lost item under investigation.', '2026-04-13 11:00:47'),
(16, 'BUSS/MAR/1007/21', 'Grace Njeri', 'ICT', 'None', 0, 1200.00, 'Approved', 'No issues reported.', '2026-04-13 11:00:47'),
(17, 'BUSS/EC/1012/21', 'Ibrahim Suleiman', 'ICT', NULL, 0, 1200.00, 'Approved', 'All items returned without problems.', '2026-04-13 11:00:47'),
(18, 'BUSS/ACC/1016/21', 'Michael Onyango', 'ICT', 'None', 0, 1200.00, 'Approved', 'All equipment returned as per the policy.', '2026-04-13 11:00:47'),
(19, 'BUSS/ET/1018/21', 'Amara Okoro', 'ICT', 'Keyboard', 1, 1200.00, 'Pending', 'Lost keyboard reported; fine pending.', '2026-04-13 11:00:47'),
(20, 'BUSS/ACC/1024/21', 'Adisa Balogun', 'ICT', 'Equipment', 1, 1200.00, 'Requires Update', 'Damage to equipment reported; awaiting resolution.', '2026-04-13 11:00:47'),
(21, 'ART/HIST/1003/21', 'Josephine Nyong', 'ICT', 'USB drive', 1, 1200.00, 'Pending', 'Awaiting fine approval for a lost USB drive.', '2026-04-13 11:00:47'),
(22, 'ART/LING/1009/21', 'Eunice Wanjiku', 'ICT', 'None', 0, 1200.00, 'Approved', 'Clear record with no reported issues.', '2026-04-13 11:00:47'),
(23, 'ART/PHIL/1013/21', 'Abena Gyasi', 'ICT', 'Adapter', 1, 1200.00, 'Pending', 'Lost adapter; pending fine resolution.', '2026-04-13 11:00:47'),
(24, 'ART/LIT/1017/21', 'Patience Ouma', 'ICT', 'None', 0, 1200.00, 'Approved', 'All items returned in good condition.', '2026-04-13 11:00:47'),
(25, 'ART/SOCI/1019/21', 'Chinedu Eze', 'ICT', 'None', 0, 1200.00, 'Approved', 'No issues during borrowing period.', '2026-04-13 11:00:47'),
(26, 'ART/PSY/1022/21', 'Obinna Nwachukwu', 'ICT', 'Headset', 1, 1200.00, 'Requires Update', 'Lost headset reported.', '2026-04-13 11:00:47'),
(27, 'ART/FIN/1025/21', 'Zainab Diallo', 'ICT', 'Device', 1, 1200.00, 'Pending', 'Damage report under review.', '2026-04-13 11:00:47');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `ict`
--
ALTER TABLE `ict`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `ict`
--
ALTER TABLE `ict`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
