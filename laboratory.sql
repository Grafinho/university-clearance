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
-- Table structure for table `laboratory`
--

CREATE TABLE `laboratory` (
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
-- Dumping data for table `laboratory`
--

INSERT INTO `laboratory` (`id`, `username`, `full_name`, `department`, `item_name`, `quantity_lost`, `cost_of_item`, `status`, `comments`, `last_updated`) VALUES
(1, 'CP/COMP/1099/21', 'Grafaa Delaprince', 'LABORATORY', 'Experimental kit', 1, 1200.00, 'Requires Update', 'Pending resolution for a lost experimental kit.', '2026-04-13 11:03:48'),
(2, 'CP/COMP/1001/21', 'Brian Mwangi', 'LABORATORY', 'None', 0, 1200.00, 'Approved', 'All items accounted for.', '2026-04-13 11:03:48'),
(3, 'CP/COMP/1005/21', 'Linda Achieng', 'LABORATORY', 'None', 0, 1200.00, 'Approved', 'No issues reported.', '2026-04-13 11:03:48'),
(4, 'CP/COMP/1010/21', 'Mark Kamau', 'LABORATORY', 'Lab equipment', 1, 1200.00, 'Pending', 'Pending fine for broken equipment.', '2026-04-13 11:03:48'),
(5, 'CP/COMP/1017/21', 'Grace Wanjiru', 'LABORATORY', 'None', 0, 1200.00, 'Approved', 'Clear record with no delays.', '2026-04-13 11:03:48'),
(6, 'CP/COMP/1023/21', 'Dennis Njoroge', 'LABORATORY', 'Lab equipment', 1, 1200.00, 'Requires Update', 'Lab equipment damaged; under review.', '2026-04-13 11:03:48'),
(7, 'CP/COMP/1029/21', 'Diana Ndungu', 'LABORATORY', 'None', 0, 1200.00, 'Approved', 'All items returned on time.', '2026-04-13 11:03:48'),
(8, 'CP/COMP/1034/21', 'Kevin Omondi', 'LABORATORY', 'Pipette', 1, 1200.00, 'Pending', 'Lost pipette under investigation.', '2026-04-13 11:03:48'),
(9, 'SCI/PS/1001/21', 'Kwame Mensah', 'LABORATORY', 'None', 1, 1200.00, 'Pending', 'Delayed return of lab chemicals.', '2026-04-13 11:03:48'),
(10, 'SCI/BI/1004/21', 'Samuel Okoth', 'LABORATORY', NULL, 0, 1200.00, 'Approved', 'No missing items.', '2026-04-13 11:03:48'),
(11, 'SCI/MT/1008/21', 'Chika Amadi', 'LABORATORY', 'Microscope lens', 1, 1200.00, 'Requires Update', 'Broken microscope lens reported.', '2026-04-13 11:03:48'),
(12, 'SCI/PS/1011/21', 'Mercy Otieno', 'LABORATORY', 'None', 0, 1200.00, 'Approved', 'All equipment returned.', '2026-04-13 11:03:48'),
(13, 'SCI/ES/1020/21', 'Asha Mohammed', 'LABORATORY', 'Lab equipment', 1, 1200.00, 'Pending', 'Fine pending for damaged equipment.', '2026-04-13 11:03:48'),
(14, 'SCI/CH/1023/21', 'Njeri Wachira', 'LABORATORY', 'None', 1, 1200.00, 'Pending', 'Late return under review.', '2026-04-13 11:03:48'),
(15, 'BUSS/FC/1002/21', 'Fatima Abubakar', 'LABORATORY', 'Calculator', 1, 1200.00, 'Requires Update', 'Damage to borrowed calculators reported.', '2026-04-13 11:03:48'),
(16, 'BUSS/MAR/1007/21', 'Grace Njeri', 'LABORATORY', 'None', 0, 1200.00, 'Approved', 'Clear borrowing record.', '2026-04-13 11:03:48'),
(17, 'BUSS/EC/1012/21', 'Ibrahim Suleiman', 'LABORATORY', 'None', 0, 1200.00, 'Approved', 'No issues reported.', '2026-04-13 11:03:48'),
(18, 'BUSS/ACC/1016/21', 'Michael Onyango', 'LABORATORY', 'None', 0, 1200.00, 'Approved', 'All items accounted for.', '2026-04-13 11:03:48'),
(19, 'BUSS/ET/1018/21', 'Amara Okoro', 'LABORATORY', 'Lab tool', 1, 1200.00, 'Pending', 'Lost lab tool reported.', '2026-04-13 11:03:48'),
(20, 'BUSS/ACC/1024/21', 'Adisa Balogun', 'LABORATORY', 'Equipment', 1, 1200.00, 'Requires Update', 'Pending resolution for broken equipment.', '2026-04-13 11:03:48'),
(21, 'ART/HIST/1003/21', 'Josephine Nyong', 'LABORATORY', 'Lab material', 1, 1200.00, 'Pending', 'Awaiting approval for a fine.', '2026-04-13 11:03:48'),
(22, 'ART/LING/1009/21', 'Eunice Wanjiku', 'LABORATORY', 'None', 0, 1200.00, 'Approved', 'Clear borrowing history.', '2026-04-13 11:03:48'),
(23, 'ART/PHIL/1013/21', 'Abena Gyasi', 'LABORATORY', 'Lab material', 1, 1200.00, 'Pending', 'Pending fine for damaged lab materials.', '2026-04-13 11:03:48'),
(24, 'ART/LIT/1017/21', 'Patience Ouma', 'LABORATORY', 'None', 0, 1200.00, 'Approved', 'No issues during borrowing period.', '2026-04-13 11:03:48'),
(25, 'ART/SOCI/1019/21', 'Chinedu Eze', 'LABORATORY', 'None', 0, 1200.00, 'Approved', 'All items accounted for.', '2026-04-13 11:03:48'),
(26, 'ART/PSY/1022/21', 'Obinna Nwachukwu', 'LABORATORY', 'Lab manual', 1, 1200.00, 'Requires Update', 'Missing lab manual reported.', '2026-04-13 11:03:48'),
(27, 'ART/FIN/1025/21', 'Zainab Diallo', 'LABORATORY', 'Lab tool', 1, 1200.00, 'Pending', 'Pending resolution for a damaged tool.', '2026-04-13 11:03:48'),
(28, 'ENG/MC/1010/21', 'Babatunde Adebayo', 'LABORATORY', 'Lab monitor', 1, 1200.00, 'Pending', 'Broken lab monitor reported.', '2026-04-13 11:03:48'),
(29, 'ED/EDU/1033/21', 'Fatima Khalid', 'LABORATORY', 'Lab tools', 1, 1200.00, 'Pending', 'Fine pending for lost tools.', '2026-04-13 11:03:48'),
(30, 'ED/EDU/1044/21', 'Daniel Mutua', 'LABORATORY', 'Lab item', 1, 1200.00, 'Requires Update', 'Lost item reported.', '2026-04-13 11:03:48'),
(31, 'ED/EDU/1074/21', 'Esther Wanjiru', 'LABORATORY', 'Lab materials', 1, 1200.00, 'Pending', 'Pending review for lost lab materials.', '2026-04-13 11:03:48');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `laboratory`
--
ALTER TABLE `laboratory`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `laboratory`
--
ALTER TABLE `laboratory`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
