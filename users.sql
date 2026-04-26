-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3307
-- Generation Time: Apr 26, 2026 at 06:56 PM
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
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `full_name` varchar(100) NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  `school` varchar(100) DEFAULT NULL,
  `course` varchar(100) DEFAULT NULL,
  `program_fees` decimal(10,2) NOT NULL,
  `paid_fees` decimal(10,2) DEFAULT 0.00,
  `balance` decimal(10,2) GENERATED ALWAYS AS (`program_fees` - `paid_fees`) STORED,
  `hostel_name` varchar(50) DEFAULT NULL,
  `room_no` varchar(20) DEFAULT NULL,
  `theme` varchar(10) DEFAULT 'light',
  `role` varchar(20) DEFAULT 'student'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `password`, `created_at`, `full_name`, `email`, `school`, `course`, `program_fees`, `paid_fees`, `hostel_name`, `room_no`, `theme`, `role`) VALUES
(1, 'ED/SCI/1004/21', '$2y$10$.azfW5Dli0rvO6nH3Urrhe8a0XbsDBO5U9bia0u.xbqwhR2ryF3Ae', '2024-12-31 06:50:04', 'Samuel Okoth', 'jaymothekingmall@gmail.com', 'School of Arts', 'History', 90000.00, 0.00, 'Hostel C', 'C103', 'light', 'student'),
(2, 'ED/SCI/1005/21', '$2y$10$8P4wOcAP6P/IETivB0sUB.BlR8t76/gU9hdbVECvwWQyoyW3h8Ghy', '2024-12-31 06:50:05', 'Amina Juma', 'amina.juma@student.keny.ac.ke', 'School of Science', 'Biology', 95000.00, 0.00, 'Hostel D', 'D104', 'light', 'student'),
(3, 'ED/SCI/1006/21', '$2y$10$1ftQDZiB0Ahc3J0wDzKIY.HCjR6Di2x1t8uY9.y8ZeeTJhoDDpf6q', '2024-12-31 06:50:06', 'David Ochieng', 'david.ochieng@student.keny.ac.ke', 'School of Engineering', 'Civil Engineering', 150000.00, 0.00, 'Hostel E', 'E105', 'light', 'student'),
(4, 'ED/SCI/1007/21', '$2y$10$P2xzAnMAduJInwEcM2zL1.6hjHTuv2AHxjXF3wY8mCp9mjMqFFn7i', '2024-12-31 06:50:07', 'Grace Njeri', 'grace.njeri@student.keny.ac.ke', 'School of Law', 'Corporate Law', 180000.00, 0.00, 'Hostel F', 'F106', 'light', 'student'),
(5, 'ED/SCI/1008/21', '$2y$10$dZ2skUoizLdDPxlKZuvq4OYKdsVrny1whxE9e7hoE8a0.kjqZUTEG', '2024-12-31 06:50:08', 'Chika Amadi', 'chika.amadi@student.keny.ac.ke', 'School of Business', 'Marketing', 115000.00, 0.00, 'Hostel G', 'G107', 'light', 'student'),
(6, 'ED/SCI/1009/21', '$2y$10$rMAK1DDOV.UXhMe5NQIWmuusOq8EHzmgJKsIIJi0OL8YQDad/LHUm', '2024-12-31 06:50:09', 'Eunice Wanjiku', 'eunice.wanjiku@student.keny.ac.ke', 'School of Science', 'Mathematics', 100000.00, 0.00, 'Hostel H', 'H108', 'light', 'student'),
(7, 'ED/SCI/1010/21', '$2y$10$GmpNei/qQwDhvWBybgUraeT2fxLG3mh5/B7b3tW9wnB7Lb4A7/ice', '2024-12-31 06:50:10', 'Babatunde Adebayo', 'babatunde.adebayo@student.keny.ac.ke', 'School of Arts', 'Linguistics', 92000.00, 0.00, 'Hostel I', 'I109', 'light', 'student'),
(8, 'ED/SCI/1011/21', '$2y$10$gM6S1YpMWb/UlQk25P6j6.yZlm.u1Ls.y4TjncC80eYwMF/17QRZu', '2024-12-31 06:50:11', 'Mercy Otieno', 'mercy.otieno@student.keny.ac.ke', 'School of Engineering', 'Mechanical Engineering', 140000.00, 0.00, 'Hostel J', 'J110', 'light', 'student'),
(9, 'ED/SCI/1012/21', '$2y$10$NX3yLrhMOw5MsCcgr0kP2uUZiImZpY8Hp9wGIVPEx7HwpzpZ8iKa6', '2024-12-31 06:50:12', 'Ibrahim Suleiman', 'ibrahim.suleiman@student.keny.ac.ke', 'School of Science', 'Computer Science', 110000.00, 0.00, 'Hostel K', 'K111', 'light', 'student'),
(10, 'ED/SCI/1013/21', '$2y$10$bl7TlgBCDcqU8ZbvLpqWf.dRAN7BXnP1V2UTdnVllQAiEA2VugR8C', '2024-12-31 06:50:13', 'Abena Gyasi', 'abena.gyasi@student.keny.ac.ke', 'School of Business', 'Economics', 125000.00, 0.00, 'Hostel L', 'L112', 'light', 'student'),
(11, 'ED/SCI/1014/21', '$2y$10$OTnZZzp5Q.HIy9DikVvLBOkAOyONTGVJsSOIDwPK1ekmoKrr3/r2u', '2024-12-31 06:50:14', 'Felix Mukasa', 'felix.mukasa@student.keny.ac.ke', 'School of Arts', 'Philosophy', 90000.00, 0.00, 'Hostel M', 'M113', 'light', 'student'),
(12, 'ED/SCI/1015/21', '$2y$10$K1oNL5fVLqTBpwLkLddjNe4UFQepdfBxOe/K4vdFY4S3Q1TqABYx6', '2024-12-31 06:50:15', 'Lucy Kamau', 'lucy.kamau@student.keny.ac.ke', 'School of Engineering', 'Electrical Engineering', 130000.00, 0.00, 'Hostel N', 'N114', 'light', 'student'),
(13, 'ED/SCI/1016/21', '$2y$10$nPXxLF62j61VljZJ3somNuT0tFivaZyFRyKPRSMzTXthttD8jEMGK', '2024-12-31 06:50:16', 'Michael Onyango', 'michael.onyango@student.keny.ac.ke', 'School of Law', 'Criminal Law', 160000.00, 0.00, 'Hostel O', 'O115', 'light', 'student'),
(14, 'ED/SCI/1017/21', '$2y$10$gVXXnWrxohqHUQ/Sdo.LluvuxA9x7/3w6XrzbyUJnQhbdO1N7B8di', '2024-12-31 06:50:17', 'Patience Ouma', 'patience.ouma@student.keny.ac.ke', 'School of Business', 'Accounting', 110000.00, 0.00, 'Hostel P', 'P116', 'light', 'student'),
(15, 'ED/SCI/1018/21', '$2y$10$hyjPaIGz0nOinEXtP5zaQerGXnJ25vQiAaeZKpayb/ozugAuUf9EK', '2024-12-31 06:50:18', 'Amara Okoro', 'amara.okoro@student.keny.ac.ke', 'School of Arts', 'Literature', 85000.00, 0.00, 'Hostel Q', 'Q117', 'light', 'student'),
(16, 'ED/SCI/1019/21', '$2y$10$llPSSSGTAq9JeBHGEV2JPOLSh0LA9l4yfBMx4avkmIWB7/9lCwsi6', '2024-12-31 06:50:19', 'Chinedu Eze', 'chinedu.eze@student.keny.ac.ke', 'School of Business', 'Entrepreneurship', 95000.00, 0.00, 'Hostel R', 'R118', 'light', 'student'),
(17, 'ED/SCI/1020/21', '$2y$10$wdYy/D/nt.Iq5YClj6NUe./Zr8fl9fuXxNa5yt3ApJ9fRcocCXb2m', '2024-12-31 06:50:20', 'Asha Mohammed', 'asha.mohammed@student.keny.ac.ke', 'School of Arts', 'Sociology', 87000.00, 0.00, 'Hostel S', 'S119', 'light', 'student'),
(18, 'ED/SCI/1021/21', '$2y$10$JGssWxCBSaAhQcMrKOltg.qhvccjN.v15k/N7Cq12JhFlzb8v4qfe', '2024-12-31 06:50:21', 'Thandiwe Ndlovu', 'thandiwe.ndlovu@student.keny.ac.ke', 'School of Science', 'Environmental Science', 90000.00, 0.00, 'Hostel T', 'T120', 'light', 'student'),
(19, 'ED/SCI/1022/21', '$2y$10$tb8dtoRnruh9ZQe7pHtg2O.BUHu2pva3X/S/yaLRCm0ORH0rHBJWW', '2024-12-31 06:50:22', 'Obinna Nwachukwu', 'obinna.nwachukwu@student.keny.ac.ke', 'School of Law', 'Human Rights Law', 120000.00, 0.00, 'Hostel U', 'U121', 'light', 'student'),
(20, 'ED/SCI/1023/21', '$2y$10$U5vCT/Vm559bEWnm476L/uT5tdjstf88t3Fe.hHa4mB/YgCsun2am', '2024-12-31 06:50:23', 'Njeri Wachira', 'njeri.wachira@student.keny.ac.ke', 'School of Arts', 'Psychology', 95000.00, 0.00, 'Hostel V', 'V122', 'light', 'student'),
(21, 'ED/SCI/1024/21', '$2y$10$MpV/rcKKWBrI5MWgdWMVUeqO9GyxmCWtwo1i/LJtEMSTdkPr7Qh8S', '2024-12-31 06:50:24', 'Adisa Balogun', 'adisa.balogun@student.keny.ac.ke', 'School of Science', 'Chemistry', 100000.00, 0.00, 'Hostel W', 'W123', 'light', 'student'),
(22, 'ED/SCI/1025/21', '$2y$10$0.gIWGjvsKcVideyBksPEOGzrjaVNTArzv8d3abfiWwfUGdOZbYau', '2024-12-31 06:50:25', 'Zainab Diallo', 'zainab.diallo@student.keny.ac.ke', 'School of Business', 'Accounting', 105000.00, 0.00, 'Hostel X', 'X124', 'light', 'student'),
(23, 'ED/EDU/1012/21', '482c811da5d5b4bc6d497ffa98491e38', '2026-04-08 23:18:13', 'John Kimani', 'john.kimani@university.ac.ke', 'School of Education', 'Curriculum Development', 75000.00, 0.00, '<br /><b>Deprecated</b>:  htmlspecialchars(): Pass', '<br /><b>Deprecated<', 'light', 'student'),
(24, 'ED/EDU/1025/21', '482c811da5d5b4bc6d497ffa98491e38', '2026-04-08 23:18:13', 'Grace Achieng', 'grace.achieng@university.ac.ke', 'School of Education', 'Educational Psychology', 90000.00, 0.00, '<br /><b>Deprecated</b>:  htmlspecialchars(): Pass', '<br /><b>Deprecated<', 'light', 'student'),
(25, 'ED/EDU/1033/21', '482c811da5d5b4bc6d497ffa98491e38', '2026-04-08 23:18:13', 'Fatima Khalid', 'fatima.khalid@university.ac.ke', 'School of Education', 'Special Needs Education', 100000.00, 0.00, '<br /><b>Deprecated</b>:  htmlspecialchars(): Pass', '<br /><b>Deprecated<', 'light', 'student'),
(26, 'ED/EDU/1044/21', '482c811da5d5b4bc6d497ffa98491e38', '2026-04-08 23:18:13', 'Daniel Mutua', 'daniel.mutua@university.ac.ke', 'School of Education', 'Physical Education', 85000.00, 0.00, '<br /><b>Deprecated</b>:  htmlspecialchars(): Pass', '<br /><b>Deprecated<', 'light', 'student'),
(27, 'ED/EDU/1056/21', '482c811da5d5b4bc6d497ffa98491e38', '2026-04-08 23:18:13', 'Alice Njenga', 'alice.njenga@university.ac.ke', 'School of Education', 'Early Childhood Education', 110000.00, 0.00, '<br /><b>Deprecated</b>:  htmlspecialchars(): Pass', '<br /><b>Deprecated<', 'light', 'student'),
(28, 'ED/EDU/1061/21', '482c811da5d5b4bc6d497ffa98491e38', '2026-04-08 23:18:13', 'Robert Ochieng', 'robert.ochieng@university.ac.ke', 'School of Education', 'Teacher Training', 120000.00, 0.00, '<br /><b>Deprecated</b>:  htmlspecialchars(): Pass', '<br /><b>Deprecated<', 'light', 'student'),
(29, 'ED/EDU/1074/21', '482c811da5d5b4bc6d497ffa98491e38', '2026-04-08 23:18:13', 'Esther Wanjiru', 'esther.wanjiru@university.ac.ke', 'School of Education', 'Instructional Design', 95000.00, 0.00, '<br /><b>Deprecated</b>:  htmlspecialchars(): Pass', '<br /><b>Deprecated<', 'light', 'student'),
(30, 'MD/MED/2001/21', '482c811da5d5b4bc6d497ffa98491e38', '2026-04-08 23:18:13', 'Dr. Jane Muriuki', 'jane.muriuki@university.ac.ke', 'School of Medicine', 'General Medicine', 150000.00, 0.00, '<br /><b>Deprecated</b>:  htmlspecialchars(): Pass', '<br /><b>Deprecated<', 'light', 'student'),
(31, 'MD/MED/2004/21', '482c811da5d5b4bc6d497ffa98491e38', '2026-04-08 23:18:13', 'Dr. Ali Yusuf', 'ali.yusuf@university.ac.ke', 'School of Medicine', 'Surgery', 180000.00, 0.00, '<br /><b>Deprecated</b>:  htmlspecialchars(): Pass', '<br /><b>Deprecated<', 'light', 'student'),
(32, 'MD/MED/2010/21', '482c811da5d5b4bc6d497ffa98491e38', '2026-04-08 23:18:13', 'Dr. Cynthia Atieno', 'cynthia.atieno@university.ac.ke', 'School of Medicine', 'Pediatrics', 140000.00, 0.00, '<br /><b>Deprecated</b>:  htmlspecialchars(): Pass', '<br /><b>Deprecated<', 'light', 'student'),
(33, 'MD/MED/2023/21', '482c811da5d5b4bc6d497ffa98491e38', '2026-04-08 23:18:13', 'Dr. Kelvin Obiero', 'kelvin.obiero@university.ac.ke', 'School of Medicine', 'Pharmacy', 130000.00, 0.00, '<br /><b>Deprecated</b>:  htmlspecialchars(): Pass', '<br /><b>Deprecated<', 'light', 'student'),
(34, 'MD/MED/2035/21', '482c811da5d5b4bc6d497ffa98491e38', '2026-04-08 23:18:13', 'Dr. Fatuma Mwangi', 'fatuma.mwangi@university.ac.ke', 'School of Medicine', 'Nursing', 160000.00, 0.00, '<br /><b>Deprecated</b>:  htmlspecialchars(): Pass', '<br /><b>Deprecated<', 'light', 'student'),
(35, 'MD/MED/2048/21', '482c811da5d5b4bc6d497ffa98491e38', '2026-04-08 23:18:13', 'Dr. David Wafula', 'david.wafula@university.ac.ke', 'School of Medicine', 'Radiology', 175000.00, 0.00, '<br /><b>Deprecated</b>:  htmlspecialchars(): Pass', '<br /><b>Deprecated<', 'light', 'student'),
(36, 'MD/MED/2052/21', '482c811da5d5b4bc6d497ffa98491e38', '2026-04-08 23:18:13', 'Dr. Anita Kimani', 'anita.kimani@university.ac.ke', 'School of Medicine', 'Dermatology', 190000.00, 0.00, '<br /><b>Deprecated</b>:  htmlspecialchars(): Pass', '<br /><b>Deprecated<', 'light', 'student'),
(37, 'CP/COMP/1001/21', '482c811da5d5b4bc6d497ffa98491e38', '2026-04-08 23:18:15', 'Brian Mwangi', 'brian.mwangi@university.ac.ke', 'School of Computing', 'Software Engineering', 120000.00, 0.00, '<br /><b>Deprecated</b>:  htmlspecialchars(): Pass', '<br /><b>Deprecated<', 'light', 'student'),
(38, 'CP/COMP/1005/21', '482c811da5d5b4bc6d497ffa98491e38', '2026-04-08 23:18:15', 'Linda Achieng', 'linda.achieng@university.ac.ke', 'School of Computing', 'Cybersecurity', 130000.00, 0.00, '<br /><b>Deprecated</b>:  htmlspecialchars(): Pass', '<br /><b>Deprecated<', 'light', 'student'),
(39, 'CP/COMP/1010/21', '482c811da5d5b4bc6d497ffa98491e38', '2026-04-08 23:18:15', 'Mark Kamau', 'mark.kamau@university.ac.ke', 'School of Computing', 'Data Science', 140000.00, 0.00, '<br /><b>Deprecated</b>:  htmlspecialchars(): Pass', '<br /><b>Deprecated<', 'light', 'student'),
(40, 'CP/COMP/1017/21', '482c811da5d5b4bc6d497ffa98491e38', '2026-04-08 23:18:15', 'Grace Wanjiru', 'grace.wanjiru@university.ac.ke', 'School of Computing', 'Artificial Intelligence', 150000.00, 0.00, '<br /><b>Deprecated</b>:  htmlspecialchars(): Pass', '<br /><b>Deprecated<', 'light', 'student'),
(41, 'CP/COMP/1023/21', '482c811da5d5b4bc6d497ffa98491e38', '2026-04-08 23:18:15', 'Dennis Njoroge', 'dennis.njoroge@university.ac.ke', 'School of Computing', 'Network Administration', 110000.00, 0.00, '<br /><b>Deprecated</b>:  htmlspecialchars(): Pass', '<br /><b>Deprecated<', 'light', 'student'),
(42, 'CP/COMP/1029/21', '482c811da5d5b4bc6d497ffa98491e38', '2026-04-08 23:18:15', 'Diana Ndungu', 'diana.ndungu@university.ac.ke', 'School of Computing', 'Web Development', 125000.00, 0.00, '<br /><b>Deprecated</b>:  htmlspecialchars(): Pass', '<br /><b>Deprecated<', 'light', 'student'),
(43, 'CP/COMP/1034/21', '482c811da5d5b4bc6d497ffa98491e38', '2026-04-08 23:18:15', 'Kevin Omondi', 'kevin.omondi@university.ac.ke', 'School of Computing', 'Mobile Computing', 135000.00, 0.00, '<br /><b>Deprecated</b>:  htmlspecialchars(): Pass', '<br /><b>Deprecated<', 'light', 'student'),
(44, 'ED/SCI/1004/21', '$2y$10$wIPIGF8SGb2qoOoT92407.2.LGZFl/lo69bzstrbDqSKRjSwf6iMO', '2024-12-31 06:50:04', 'Samuel Okoth', 'samuel.okoth@student.keny.ac.ke', 'School of Arts', 'History', 90000.00, 0.00, 'Hostel C', 'C103', 'light', 'student'),
(45, 'ED/SCI/1005/21', '$2y$10$8P4wOcAP6P/IETivB0sUB.BlR8t76/gU9hdbVECvwWQyoyW3h8Ghy', '2024-12-31 06:50:05', 'Amina Juma', 'amina.juma@student.keny.ac.ke', 'School of Science', 'Biology', 95000.00, 0.00, 'Hostel D', 'D104', 'light', 'student'),
(46, 'ED/SCI/1006/21', '$2y$10$1ftQDZiB0Ahc3J0wDzKIY.HCjR6Di2x1t8uY9.y8ZeeTJhoDDpf6q', '2024-12-31 06:50:06', 'David Ochieng', 'david.ochieng@student.keny.ac.ke', 'School of Engineering', 'Civil Engineering', 150000.00, 0.00, 'Hostel E', 'E105', 'light', 'student'),
(47, 'ED/SCI/1007/21', '$2y$10$P2xzAnMAduJInwEcM2zL1.6hjHTuv2AHxjXF3wY8mCp9mjMqFFn7i', '2024-12-31 06:50:07', 'Grace Njeri', 'grace.njeri@student.keny.ac.ke', 'School of Law', 'Corporate Law', 180000.00, 0.00, 'Hostel F', 'F106', 'light', 'student'),
(48, 'ED/SCI/1008/21', '$2y$10$dZ2skUoizLdDPxlKZuvq4OYKdsVrny1whxE9e7hoE8a0.kjqZUTEG', '2024-12-31 06:50:08', 'Chika Amadi', 'chika.amadi@student.keny.ac.ke', 'School of Business', 'Marketing', 115000.00, 0.00, 'Hostel G', 'G107', 'light', 'student'),
(49, 'ED/SCI/1009/21', '$2y$10$rMAK1DDOV.UXhMe5NQIWmuusOq8EHzmgJKsIIJi0OL8YQDad/LHUm', '2024-12-31 06:50:09', 'Eunice Wanjiku', 'eunice.wanjiku@student.keny.ac.ke', 'School of Science', 'Mathematics', 100000.00, 0.00, 'Hostel H', 'H108', 'light', 'student'),
(50, 'ED/SCI/1010/21', '$2y$10$GmpNei/qQwDhvWBybgUraeT2fxLG3mh5/B7b3tW9wnB7Lb4A7/ice', '2024-12-31 06:50:10', 'Babatunde Adebayo', 'babatunde.adebayo@student.keny.ac.ke', 'School of Arts', 'Linguistics', 92000.00, 0.00, 'Hostel I', 'I109', 'light', 'student'),
(51, 'ED/SCI/1011/21', '$2y$10$gM6S1YpMWb/UlQk25P6j6.yZlm.u1Ls.y4TjncC80eYwMF/17QRZu', '2024-12-31 06:50:11', 'Mercy Otieno', 'mercy.otieno@student.keny.ac.ke', 'School of Engineering', 'Mechanical Engineering', 140000.00, 0.00, 'Hostel J', 'J110', 'light', 'student'),
(52, 'ED/SCI/1012/21', '$2y$10$NX3yLrhMOw5MsCcgr0kP2uUZiImZpY8Hp9wGIVPEx7HwpzpZ8iKa6', '2024-12-31 06:50:12', 'Ibrahim Suleiman', 'ibrahim.suleiman@student.keny.ac.ke', 'School of Science', 'Computer Science', 110000.00, 0.00, 'Hostel K', 'K111', 'light', 'student'),
(53, 'ED/SCI/1013/21', '$2y$10$bl7TlgBCDcqU8ZbvLpqWf.dRAN7BXnP1V2UTdnVllQAiEA2VugR8C', '2024-12-31 06:50:13', 'Abena Gyasi', 'abena.gyasi@student.keny.ac.ke', 'School of Business', 'Economics', 125000.00, 0.00, 'Hostel L', 'L112', 'light', 'student'),
(54, 'ED/SCI/1014/21', '$2y$10$OTnZZzp5Q.HIy9DikVvLBOkAOyONTGVJsSOIDwPK1ekmoKrr3/r2u', '2024-12-31 06:50:14', 'Felix Mukasa', 'felix.mukasa@student.keny.ac.ke', 'School of Arts', 'Philosophy', 90000.00, 0.00, 'Hostel M', 'M113', 'light', 'student'),
(55, 'ED/SCI/1015/21', '$2y$10$K1oNL5fVLqTBpwLkLddjNe4UFQepdfBxOe/K4vdFY4S3Q1TqABYx6', '2024-12-31 06:50:15', 'Lucy Kamau', 'lucy.kamau@student.keny.ac.ke', 'School of Engineering', 'Electrical Engineering', 130000.00, 0.00, 'Hostel N', 'N114', 'light', 'student'),
(56, 'ED/SCI/1016/21', '$2y$10$nPXxLF62j61VljZJ3somNuT0tFivaZyFRyKPRSMzTXthttD8jEMGK', '2024-12-31 06:50:16', 'Michael Onyango', 'michael.onyango@student.keny.ac.ke', 'School of Law', 'Criminal Law', 160000.00, 0.00, 'Hostel O', 'O115', 'light', 'student'),
(57, 'ED/SCI/1017/21', '$2y$10$gVXXnWrxohqHUQ/Sdo.LluvuxA9x7/3w6XrzbyUJnQhbdO1N7B8di', '2024-12-31 06:50:17', 'Patience Ouma', 'patience.ouma@student.keny.ac.ke', 'School of Business', 'Accounting', 110000.00, 0.00, 'Hostel P', 'P116', 'light', 'student'),
(58, 'ED/SCI/1018/21', '$2y$10$hyjPaIGz0nOinEXtP5zaQerGXnJ25vQiAaeZKpayb/ozugAuUf9EK', '2024-12-31 06:50:18', 'Amara Okoro', 'amara.okoro@student.keny.ac.ke', 'School of Arts', 'Literature', 85000.00, 0.00, 'Hostel Q', 'Q117', 'light', 'student'),
(59, 'ED/SCI/1019/21', '$2y$10$llPSSSGTAq9JeBHGEV2JPOLSh0LA9l4yfBMx4avkmIWB7/9lCwsi6', '2024-12-31 06:50:19', 'Chinedu Eze', 'chinedu.eze@student.keny.ac.ke', 'School of Business', 'Entrepreneurship', 95000.00, 0.00, 'Hostel R', 'R118', 'light', 'student'),
(60, 'ED/SCI/1020/21', '$2y$10$wdYy/D/nt.Iq5YClj6NUe./Zr8fl9fuXxNa5yt3ApJ9fRcocCXb2m', '2024-12-31 06:50:20', 'Asha Mohammed', 'asha.mohammed@student.keny.ac.ke', 'School of Arts', 'Sociology', 87000.00, 0.00, 'Hostel S', 'S119', 'light', 'student'),
(61, 'ED/SCI/1021/21', '$2y$10$JGssWxCBSaAhQcMrKOltg.qhvccjN.v15k/N7Cq12JhFlzb8v4qfe', '2024-12-31 06:50:21', 'Thandiwe Ndlovu', 'thandiwe.ndlovu@student.keny.ac.ke', 'School of Science', 'Environmental Science', 90000.00, 0.00, 'Hostel T', 'T120', 'light', 'student'),
(62, 'ED/SCI/1022/21', '$2y$10$tb8dtoRnruh9ZQe7pHtg2O.BUHu2pva3X/S/yaLRCm0ORH0rHBJWW', '2024-12-31 06:50:22', 'Obinna Nwachukwu', 'obinna.nwachukwu@student.keny.ac.ke', 'School of Law', 'Human Rights Law', 120000.00, 0.00, 'Hostel U', 'U121', 'light', 'student'),
(63, 'ED/SCI/1023/21', '$2y$10$U5vCT/Vm559bEWnm476L/uT5tdjstf88t3Fe.hHa4mB/YgCsun2am', '2024-12-31 06:50:23', 'Njeri Wachira', 'njeri.wachira@student.keny.ac.ke', 'School of Arts', 'Psychology', 95000.00, 0.00, 'Hostel V', 'V122', 'light', 'student'),
(64, 'ED/SCI/1024/21', '$2y$10$MpV/rcKKWBrI5MWgdWMVUeqO9GyxmCWtwo1i/LJtEMSTdkPr7Qh8S', '2024-12-31 06:50:24', 'Adisa Balogun', 'adisa.balogun@student.keny.ac.ke', 'School of Science', 'Chemistry', 100000.00, 0.00, 'Hostel W', 'W123', 'light', 'student'),
(65, 'ED/SCI/1025/21', '$2y$10$0.gIWGjvsKcVideyBksPEOGzrjaVNTArzv8d3abfiWwfUGdOZbYau', '2024-12-31 06:50:25', 'Zainab Diallo', 'zainab.diallo@student.keny.ac.ke', 'School of Business', 'Accounting', 105000.00, 0.00, 'Hostel X', 'X124', 'light', 'student'),
(66, 'ED/EDU/1012/21', '482c811da5d5b4bc6d497ffa98491e38', '2026-04-08 23:18:13', 'John Kimani', 'john.kimani@university.ac.ke', 'School of Education', 'Curriculum Development', 75000.00, 0.00, '<br /><b>Deprecated</b>:  htmlspecialchars(): Pass', '<br /><b>Deprecated<', 'light', 'student'),
(67, 'ED/EDU/1025/21', '482c811da5d5b4bc6d497ffa98491e38', '2026-04-08 23:18:13', 'Grace Achieng', 'grace.achieng@university.ac.ke', 'School of Education', 'Educational Psychology', 90000.00, 0.00, '<br /><b>Deprecated</b>:  htmlspecialchars(): Pass', '<br /><b>Deprecated<', 'light', 'student'),
(68, 'ED/EDU/1033/21', '482c811da5d5b4bc6d497ffa98491e38', '2026-04-08 23:18:13', 'Fatima Khalid', 'fatima.khalid@university.ac.ke', 'School of Education', 'Special Needs Education', 100000.00, 0.00, '<br /><b>Deprecated</b>:  htmlspecialchars(): Pass', '<br /><b>Deprecated<', 'light', 'student'),
(69, 'ED/EDU/1044/21', '482c811da5d5b4bc6d497ffa98491e38', '2026-04-08 23:18:13', 'Daniel Mutua', 'daniel.mutua@university.ac.ke', 'School of Education', 'Physical Education', 85000.00, 0.00, '<br /><b>Deprecated</b>:  htmlspecialchars(): Pass', '<br /><b>Deprecated<', 'light', 'student'),
(70, 'ED/EDU/1056/21', '482c811da5d5b4bc6d497ffa98491e38', '2026-04-08 23:18:13', 'Alice Njenga', 'alice.njenga@university.ac.ke', 'School of Education', 'Early Childhood Education', 110000.00, 0.00, '<br /><b>Deprecated</b>:  htmlspecialchars(): Pass', '<br /><b>Deprecated<', 'light', 'student'),
(71, 'ED/EDU/1061/21', '482c811da5d5b4bc6d497ffa98491e38', '2026-04-08 23:18:13', 'Robert Ochieng', 'robert.ochieng@university.ac.ke', 'School of Education', 'Teacher Training', 120000.00, 0.00, '<br /><b>Deprecated</b>:  htmlspecialchars(): Pass', '<br /><b>Deprecated<', 'light', 'student'),
(72, 'ED/EDU/1074/21', '482c811da5d5b4bc6d497ffa98491e38', '2026-04-08 23:18:13', 'Esther Wanjiru', 'esther.wanjiru@university.ac.ke', 'School of Education', 'Instructional Design', 95000.00, 0.00, '<br /><b>Deprecated</b>:  htmlspecialchars(): Pass', '<br /><b>Deprecated<', 'light', 'student'),
(73, 'MD/MED/2001/21', '482c811da5d5b4bc6d497ffa98491e38', '2026-04-08 23:18:13', 'Dr. Jane Muriuki', 'jane.muriuki@university.ac.ke', 'School of Medicine', 'General Medicine', 150000.00, 0.00, '<br /><b>Deprecated</b>:  htmlspecialchars(): Pass', '<br /><b>Deprecated<', 'light', 'student'),
(74, 'MD/MED/2004/21', '482c811da5d5b4bc6d497ffa98491e38', '2026-04-08 23:18:13', 'Dr. Ali Yusuf', 'ali.yusuf@university.ac.ke', 'School of Medicine', 'Surgery', 180000.00, 0.00, '<br /><b>Deprecated</b>:  htmlspecialchars(): Pass', '<br /><b>Deprecated<', 'light', 'student'),
(75, 'MD/MED/2010/21', '482c811da5d5b4bc6d497ffa98491e38', '2026-04-08 23:18:13', 'Dr. Cynthia Atieno', 'cynthia.atieno@university.ac.ke', 'School of Medicine', 'Pediatrics', 140000.00, 0.00, '<br /><b>Deprecated</b>:  htmlspecialchars(): Pass', '<br /><b>Deprecated<', 'light', 'student'),
(76, 'MD/MED/2023/21', '482c811da5d5b4bc6d497ffa98491e38', '2026-04-08 23:18:13', 'Dr. Kelvin Obiero', 'kelvin.obiero@university.ac.ke', 'School of Medicine', 'Pharmacy', 130000.00, 0.00, '<br /><b>Deprecated</b>:  htmlspecialchars(): Pass', '<br /><b>Deprecated<', 'light', 'student'),
(77, 'MD/MED/2035/21', '482c811da5d5b4bc6d497ffa98491e38', '2026-04-08 23:18:13', 'Dr. Fatuma Mwangi', 'fatuma.mwangi@university.ac.ke', 'School of Medicine', 'Nursing', 160000.00, 0.00, '<br /><b>Deprecated</b>:  htmlspecialchars(): Pass', '<br /><b>Deprecated<', 'light', 'student'),
(78, 'MD/MED/2048/21', '482c811da5d5b4bc6d497ffa98491e38', '2026-04-08 23:18:13', 'Dr. David Wafula', 'david.wafula@university.ac.ke', 'School of Medicine', 'Radiology', 175000.00, 0.00, '<br /><b>Deprecated</b>:  htmlspecialchars(): Pass', '<br /><b>Deprecated<', 'light', 'student'),
(79, 'MD/MED/2052/21', '482c811da5d5b4bc6d497ffa98491e38', '2026-04-08 23:18:13', 'Dr. Anita Kimani', 'anita.kimani@university.ac.ke', 'School of Medicine', 'Dermatology', 190000.00, 0.00, '<br /><b>Deprecated</b>:  htmlspecialchars(): Pass', '<br /><b>Deprecated<', 'light', 'student'),
(80, 'CP/COMP/1001/21', '482c811da5d5b4bc6d497ffa98491e38', '2026-04-08 23:18:15', 'Brian Mwangi', 'brian.mwangi@university.ac.ke', 'School of Computing', 'Software Engineering', 120000.00, 0.00, '<br /><b>Deprecated</b>:  htmlspecialchars(): Pass', '<br /><b>Deprecated<', 'light', 'student'),
(81, 'CP/COMP/1005/21', '482c811da5d5b4bc6d497ffa98491e38', '2026-04-08 23:18:15', 'Linda Achieng', 'linda.achieng@university.ac.ke', 'School of Computing', 'Cybersecurity', 130000.00, 0.00, '<br /><b>Deprecated</b>:  htmlspecialchars(): Pass', '<br /><b>Deprecated<', 'light', 'student'),
(82, 'CP/COMP/1010/21', '482c811da5d5b4bc6d497ffa98491e38', '2026-04-08 23:18:15', 'Mark Kamau', 'mark.kamau@university.ac.ke', 'School of Computing', 'Data Science', 140000.00, 0.00, '<br /><b>Deprecated</b>:  htmlspecialchars(): Pass', '<br /><b>Deprecated<', 'light', 'student'),
(83, 'CP/COMP/1017/21', '482c811da5d5b4bc6d497ffa98491e38', '2026-04-08 23:18:15', 'Grace Wanjiru', 'grace.wanjiru@university.ac.ke', 'School of Computing', 'Artificial Intelligence', 150000.00, 0.00, '<br /><b>Deprecated</b>:  htmlspecialchars(): Pass', '<br /><b>Deprecated<', 'light', 'student'),
(84, 'CP/COMP/1023/21', '482c811da5d5b4bc6d497ffa98491e38', '2026-04-08 23:18:15', 'Dennis Njoroge', 'dennis.njoroge@university.ac.ke', 'School of Computing', 'Network Administration', 110000.00, 0.00, '<br /><b>Deprecated</b>:  htmlspecialchars(): Pass', '<br /><b>Deprecated<', 'light', 'student'),
(85, 'CP/COMP/1029/21', '482c811da5d5b4bc6d497ffa98491e38', '2026-04-08 23:18:15', 'Diana Ndungu', 'diana.ndungu@university.ac.ke', 'School of Computing', 'Web Development', 125000.00, 0.00, '<br /><b>Deprecated</b>:  htmlspecialchars(): Pass', '<br /><b>Deprecated<', 'light', 'student'),
(86, 'CP/COMP/1034/21', '482c811da5d5b4bc6d497ffa98491e38', '2026-04-08 23:18:15', 'Kevin Omondi', 'kevin.omondi@university.ac.ke', 'School of Computing', 'Mobile Computing', 135000.00, 0.00, '<br /><b>Deprecated</b>:  htmlspecialchars(): Pass', '<br /><b>Deprecated<', 'light', 'student');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=87;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
