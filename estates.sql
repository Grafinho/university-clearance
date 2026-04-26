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
-- Table structure for table `estates`
--

CREATE TABLE `estates` (
  `id` int(11) NOT NULL,
  `username` varchar(20) NOT NULL,
  `full_name` varchar(100) NOT NULL,
  `department` varchar(100) NOT NULL,
  `hostel_name` varchar(255) DEFAULT NULL,
  `room_no` varchar(20) DEFAULT NULL,
  `pending_arrears` decimal(10,2) DEFAULT 0.00,
  `status` varchar(20) DEFAULT 'Pending',
  `comments` text DEFAULT NULL,
  `last_updated` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `estates`
--

INSERT INTO `estates` (`id`, `username`, `full_name`, `department`, `hostel_name`, `room_no`, `pending_arrears`, `status`, `comments`, `last_updated`) VALUES
(1, 'CP/COMP/1099/21', 'Grafaa Delaprince', 'Computing', 'Hostel A', 'A-101', 2500.00, 'Requires Update', 'Outstanding hostel fee balance', '2026-04-13 11:00:47'),
(2, 'CP/COMP/1001/21', 'Brian Mwangi', 'Computing', 'Hostel B', 'B-203', 0.00, 'Approved', 'All dues cleared', '2026-04-13 11:00:47'),
(3, 'CP/COMP/1005/21', 'Linda Achieng', 'Computing', 'Hostel C', 'C-110', 0.00, 'Approved', 'No pending issues', '2026-04-13 11:00:47'),
(4, 'CP/COMP/1010/21', 'Mark Kamau', 'Computing', 'Hostel A', 'A-115', 1500.00, 'Pending', 'Pending payment for damages', '2026-04-13 11:00:47'),
(5, 'CP/COMP/1017/21', 'Grace Wanjiru', 'Computing', 'Hostel D', 'D-220', 0.00, 'Approved', 'Room cleared', '2026-04-13 11:00:47'),
(6, 'SCI/PS/1001/21', 'Kwame Mensah', 'Science', 'Hostel B', 'B-101', 1000.00, 'Pending', 'Late hostel payment', '2026-04-13 11:00:47'),
(7, 'SCI/BI/1004/21', 'Samuel Okoth', 'Science', 'Hostel C', 'C-205', 0.00, 'Approved', 'Cleared', '2026-04-13 11:00:47'),
(8, 'SCI/MT/1008/21', 'Chika Amadi', 'Science', 'Hostel D', 'D-310', 2000.00, 'Requires Update', 'Pending repair charges', '2026-04-13 11:00:47'),
(9, 'SCI/PS/1011/21', 'Mercy Otieno', 'Science', 'Hostel A', 'A-210', 0.00, 'Approved', 'No arrears', '2026-04-13 11:00:47'),
(10, 'BUSS/FC/1002/21', 'Fatima Abubakar', 'Business', 'Hostel C', 'C-120', 1800.00, 'Requires Update', 'Unpaid hostel fees', '2026-04-13 11:00:47'),
(11, 'BUSS/MAR/1007/21', 'Grace Njeri', 'Business', 'Hostel B', 'B-220', 0.00, 'Approved', 'Cleared', '2026-04-13 11:00:47'),
(12, 'BUSS/EC/1012/21', 'Ibrahim Suleiman', 'Business', 'Hostel A', 'A-312', 0.00, 'Approved', 'No issues', '2026-04-13 11:00:47'),
(13, 'BUSS/ACC/1016/21', 'Michael Onyango', 'Business', 'Hostel D', 'D-101', 0.00, 'Approved', 'All cleared', '2026-04-13 11:00:47'),
(14, 'ART/HIST/1003/21', 'Josephine Nyong', 'Arts', 'Hostel B', 'B-115', 1200.00, 'Pending', 'Pending hostel damage fee', '2026-04-13 11:00:47'),
(15, 'ART/LING/1009/21', 'Eunice Wanjiku', 'Arts', 'Hostel C', 'C-230', 0.00, 'Approved', 'No issues', '2026-04-13 11:00:47'),
(16, 'ART/PHIL/1013/21', 'Abena Gyasi', 'Arts', 'Hostel A', 'A-305', 900.00, 'Pending', 'Late clearance payment', '2026-04-13 11:00:47'),
(17, 'ART/LIT/1017/21', 'Patience Ouma', 'Arts', 'Hostel D', 'D-111', 0.00, 'Approved', 'Room inspected and cleared', '2026-04-13 11:00:47'),
(18, 'ENG/CV/1005/21', 'Amina Juma', 'Engineering', 'Hostel C', 'C-101', 0.00, 'Approved', 'All dues settled', '2026-04-13 11:00:47'),
(19, 'ENG/MC/1010/21', 'Babatunde Adebayo', 'Engineering', 'Hostel B', 'B-310', 1700.00, 'Pending', 'Pending maintenance fee', '2026-04-13 11:00:47'),
(20, 'LAW/CRL/1006/21', 'David Ochieng', 'Law', 'Hostel A', 'A-120', 0.00, 'Approved', 'Cleared', '2026-04-13 11:00:47'),
(21, 'LAW/CML/1015/21', 'Lucy Kamau', 'Law', 'Hostel D', 'D-205', 0.00, 'Approved', 'No issues', '2026-04-13 11:00:47'),
(22, 'ED/EDU/1012/21', 'John Kimani', 'Education', 'Hostel B', 'B-130', 0.00, 'Approved', 'All cleared', '2026-04-13 11:00:47'),
(23, 'ED/EDU/1025/21', 'Grace Achieng', 'Education', 'Hostel C', 'C-140', 0.00, 'Approved', 'No pending arrears', '2026-04-13 11:00:47'),
(24, 'ED/EDU/1033/21', 'Fatima Khalid', 'Education', 'Hostel A', 'A-220', 2100.00, 'Pending', 'Pending hostel fee', '2026-04-13 11:00:47'),
(25, 'ED/EDU/1044/21', 'Daniel Mutua', 'Education', 'Hostel D', 'D-330', 1300.00, 'Requires Update', 'Repair charges pending', '2026-04-13 11:00:47');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `estates`
--
ALTER TABLE `estates`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `estates`
--
ALTER TABLE `estates`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
