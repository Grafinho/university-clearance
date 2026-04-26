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
-- Table structure for table `halls`
--

CREATE TABLE `halls` (
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
-- Dumping data for table `halls`
--

INSERT INTO `halls` (`id`, `username`, `full_name`, `department`, `item_name`, `quantity_lost`, `cost_of_item`, `status`, `comments`, `last_updated`) VALUES
(1, 'CP/COMP/1099/21', 'Grafaa Delaprince', 'Computing', 'Database Systems', 2, 1000.00, 'Requires Update', 'Missed key classes; clearance pending', '2026-04-13 11:00:47'),
(2, 'CP/COMP/1001/21', 'Brian Mwangi', 'Computing', 'Networking', 0, 1000.00, 'Approved', 'All classes attended', '2026-04-13 11:00:47'),
(3, 'CP/COMP/1005/21', 'Linda Achieng', 'Computing', 'Software Engineering', 0, 1000.00, 'Approved', 'Completed successfully', '2026-04-13 11:00:47'),
(4, 'CP/COMP/1010/21', 'Mark Kamau', 'Computing', 'Operating Systems', 1, 1000.00, 'Pending', 'Missed one class; makeup pending', '2026-04-13 11:00:47'),
(5, 'CP/COMP/1017/21', 'Grace Wanjiru', 'Computing', 'Web Development', 0, 1000.00, 'Approved', 'All requirements met', '2026-04-13 11:00:47'),
(6, 'SCI/PS/1001/21', 'Kwame Mensah', 'Science', 'Physics II', 1, 1000.00, 'Pending', 'Missed practical session', '2026-04-13 11:00:47'),
(7, 'SCI/BI/1004/21', 'Samuel Okoth', 'Science', 'Biology Lab', 0, 1000.00, 'Approved', 'Completed all labs', '2026-04-13 11:00:47'),
(8, 'SCI/MT/1008/21', 'Chika Amadi', 'Science', 'Calculus III', 2, 1000.00, 'Requires Update', 'Missed multiple lectures', '2026-04-13 11:00:47'),
(9, 'SCI/PS/1011/21', 'Mercy Otieno', 'Science', 'Statistics', 0, 1000.00, 'Approved', 'All classes attended', '2026-04-13 11:00:47'),
(10, 'BUSS/FC/1002/21', 'Fatima Abubakar', 'Business', 'Financial Accounting', 1, 1000.00, 'Requires Update', 'Missed CAT', '2026-04-13 11:00:47'),
(11, 'BUSS/MAR/1007/21', 'Grace Njeri', 'Business', 'Marketing Principles', 0, 1000.00, 'Approved', 'No issues', '2026-04-13 11:00:47'),
(12, 'BUSS/EC/1012/21', 'Ibrahim Suleiman', 'Business', 'Microeconomics', 0, 1000.00, 'Approved', 'Completed course', '2026-04-13 11:00:47'),
(13, 'BUSS/ACC/1016/21', 'Michael Onyango', 'Business', 'Auditing', 0, 1000.00, 'Approved', 'All classes attended', '2026-04-13 11:00:47'),
(14, 'ART/HIST/1003/21', 'Josephine Nyong', 'Arts', 'African History', 1, 1000.00, 'Pending', 'Missed presentation', '2026-04-13 11:00:47'),
(15, 'ART/LING/1009/21', 'Eunice Wanjiku', 'Arts', 'Linguistics', 0, 1000.00, 'Approved', 'Completed successfully', '2026-04-13 11:00:47'),
(16, 'ART/PHIL/1013/21', 'Abena Gyasi', 'Arts', 'Philosophy Ethics', 1, 1000.00, 'Pending', 'Missed discussion session', '2026-04-13 11:00:47'),
(17, 'ART/LIT/1017/21', 'Patience Ouma', 'Arts', 'Literature', 0, 1000.00, 'Approved', 'All requirements met', '2026-04-13 11:00:47'),
(18, 'ENG/CV/1005/21', 'Amina Juma', 'Engineering', 'Structural Analysis', 0, 1000.00, 'Approved', 'Completed successfully', '2026-04-13 11:00:47'),
(19, 'ENG/MC/1010/21', 'Babatunde Adebayo', 'Engineering', 'Thermodynamics', 1, 1000.00, 'Pending', 'Missed lab session', '2026-04-13 11:00:47'),
(20, 'LAW/CRL/1006/21', 'David Ochieng', 'Law', 'Criminal Law', 0, 1000.00, 'Approved', 'All classes attended', '2026-04-13 11:00:47'),
(21, 'LAW/CML/1015/21', 'Lucy Kamau', 'Law', 'Civil Procedure', 0, 1000.00, 'Approved', 'Completed', '2026-04-13 11:00:47'),
(22, 'ED/EDU/1012/21', 'John Kimani', 'Education', 'Curriculum Studies', 0, 1000.00, 'Approved', 'All classes attended', '2026-04-13 11:00:47'),
(23, 'ED/EDU/1025/21', 'Grace Achieng', 'Education', 'Educational Psychology', 0, 1000.00, 'Approved', 'No issues', '2026-04-13 11:00:47'),
(24, 'ED/EDU/1033/21', 'Fatima Khalid', 'Education', 'Teaching Practice', 2, 1000.00, 'Pending', 'Missed assessment sessions', '2026-04-13 11:00:47'),
(25, 'ED/EDU/1044/21', 'Daniel Mutua', 'Education', 'Instructional Methods', 1, 1000.00, 'Requires Update', 'Incomplete coursework', '2026-04-13 11:00:47');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `halls`
--
ALTER TABLE `halls`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `halls`
--
ALTER TABLE `halls`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
