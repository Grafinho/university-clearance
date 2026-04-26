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
-- Table structure for table `security`
--

CREATE TABLE `security` (
  `id` int(11) NOT NULL,
  `username` varchar(20) NOT NULL,
  `full_name` varchar(100) NOT NULL,
  `department` varchar(100) NOT NULL,
  `offence` varchar(255) DEFAULT NULL,
  `critical` enum('Yes','No') NOT NULL DEFAULT 'No',
  `fine_amount` decimal(10,2) DEFAULT 0.00,
  `status` varchar(20) DEFAULT 'Pending',
  `comments` text DEFAULT NULL,
  `last_updated` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `security`
--

INSERT INTO `security` (`id`, `username`, `full_name`, `department`, `offence`, `critical`, `fine_amount`, `status`, `comments`, `last_updated`) VALUES
(1, 'CP/COMP/1099/21', 'Grafaa Delaprince', 'COMPUTER SCIENCE', 'Unauthorized access to restricted area.', 'Yes', 2000.00, 'Pending', 'Under investigation.', '2026-04-13 11:03:49'),
(2, 'SCI/PS/1001/21', 'Kwame Mensah', 'SCIENCE', 'Late submission of clearance documents.', 'No', 0.00, 'Approved', 'Issue resolved with no critical impact.', '2026-04-13 11:03:49'),
(3, 'BUSS/FC/1002/21', 'Fatima Abubakar', 'BUSINESS', 'Lost property report filed.', 'No', 500.00, 'Requires Update', 'Awaiting final clearance from lost and found.', '2026-04-13 11:03:49'),
(4, 'ART/HIST/1003/21', 'Josephine Nyong', 'ARTS', 'Failure to produce ID on request.', 'No', 300.00, 'Pending', 'Reminder issued.', '2026-04-13 11:03:49'),
(5, 'SCI/BI/1004/21', 'Samuel Okoth', 'SCIENCE', 'Breach of lab protocol.', 'Yes', 2500.00, 'Requires Update', 'Pending resolution.', '2026-04-13 11:03:49'),
(6, 'ENG/CV/1005/21', 'Amina Juma', 'ENGINEERING', 'Unauthorized parking.', 'No', 500.00, 'Approved', 'Cleared.', '2026-04-13 11:03:49'),
(7, 'LAW/CRL/1006/21', 'David Ochieng', 'LAW', 'Disruption of session.', 'Yes', 1500.00, 'Pending', 'Under review.', '2026-04-13 11:03:49'),
(8, 'BUSS/MAR/1007/21', 'Grace Njeri', 'BUSINESS', 'Misplaced documents.', 'No', 0.00, 'Approved', 'Recovered.', '2026-04-13 11:03:49'),
(9, 'SCI/MT/1008/21', 'Chika Amadi', 'SCIENCE', 'Fire alarm incident.', 'Yes', 3000.00, 'Requires Update', 'Safety review pending.', '2026-04-13 11:03:49'),
(10, 'ART/LING/1009/21', 'Eunice Wanjiku', 'ARTS', 'Vandalism.', 'Yes', 2000.00, 'Pending', 'Under review.', '2026-04-13 11:03:49'),
(11, 'ENG/MC/1010/21', 'Babatunde Adebayo', 'ENGINEERING', 'Expired chemicals usage.', 'Yes', 1800.00, 'Requires Update', 'Logged.', '2026-04-13 11:03:49'),
(12, 'SCI/PS/1011/21', 'Mercy Otieno', 'SCIENCE', 'Unauthorized lab equipment use.', 'No', 0.00, 'Approved', 'Cleared.', '2026-04-13 11:03:49'),
(13, 'BUSS/EC/1012/21', 'Ibrahim Suleiman', 'BUSINESS', 'Student conflict.', 'No', 0.00, 'Approved', 'Resolved.', '2026-04-13 11:03:49'),
(14, 'ART/PHIL/1013/21', 'Abena Gyasi', 'ARTS', 'Missed security briefing.', 'No', 200.00, 'Pending', 'Scheduled.', '2026-04-13 11:03:49'),
(15, 'ENG/EL/1014/21', 'Felix Mukasa', 'ENGINEERING', 'Littering.', 'No', 100.00, 'Approved', 'Warning issued.', '2026-04-13 11:03:49'),
(16, 'LAW/CML/1015/21', 'Lucy Kamau', 'LAW', 'Access abuse.', 'Yes', 2500.00, 'Pending', 'Access revoked.', '2026-04-13 11:03:49'),
(17, 'BUSS/ACC/1016/21', 'Michael Onyango', 'BUSINESS', 'Unreturned keys.', 'No', 0.00, 'Approved', 'Returned.', '2026-04-13 11:03:49'),
(18, 'ART/LIT/1017/21', 'Patience Ouma', 'ARTS', 'Noise complaints.', 'No', 0.00, 'Approved', 'Resolved.', '2026-04-13 11:03:49'),
(19, 'BUSS/ET/1018/21', 'Amara Okoro', 'BUSINESS', 'Fire safety violation.', 'Yes', 2200.00, 'Requires Update', 'Pending review.', '2026-04-13 11:03:49'),
(20, 'ART/SOCI/1019/21', 'Chinedu Eze', 'ARTS', 'Unauthorized gathering.', 'Yes', 1800.00, 'Pending', 'Under review.', '2026-04-13 11:03:49'),
(21, 'SCI/ES/1020/21', 'Asha Mohammed', 'SCIENCE', 'Evacuation protocol breach.', 'No', 300.00, 'Approved', 'Warning issued.', '2026-04-13 11:03:49'),
(22, 'LAW/HRL/1021/21', 'Thandiwe Ndlovu', 'LAW', 'Unauthorized document removal.', 'Yes', 2000.00, 'Pending', 'Under review.', '2026-04-13 11:03:49'),
(23, 'ART/PSY/1022/21', 'Obinna Nwachukwu', 'ARTS', 'Confidentiality breach.', 'Yes', 2500.00, 'Requires Update', 'Awaiting decision.', '2026-04-13 11:03:49'),
(24, 'SCI/CH/1023/21', 'Njeri Wachira', 'SCIENCE', 'Chemical waste disposal issue.', 'Yes', 2300.00, 'Pending', 'Safety review.', '2026-04-13 11:03:49'),
(25, 'BUSS/ACC/1024/21', 'Adisa Balogun', 'BUSINESS', 'Late clearance submission.', 'No', 0.00, 'Approved', 'Resolved.', '2026-04-13 11:03:49'),
(26, 'ART/FIN/1025/21', 'Zainab Diallo', 'ARTS', 'Unauthorized financial documents.', 'Yes', 2700.00, 'Pending', 'Escalated.', '2026-04-13 11:03:49');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `security`
--
ALTER TABLE `security`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `security`
--
ALTER TABLE `security`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
