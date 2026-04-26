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
-- Table structure for table `non_students`
--

CREATE TABLE `non_students` (
  `non_student_id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `full_name` varchar(100) NOT NULL,
  `role_id` int(11) NOT NULL,
  `department` varchar(100) DEFAULT NULL,
  `position` varchar(100) DEFAULT NULL,
  `contact_email` varchar(100) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `theme` varchar(10) DEFAULT 'light'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `non_students`
--

INSERT INTO `non_students` (`non_student_id`, `username`, `password`, `full_name`, `role_id`, `department`, `position`, `contact_email`, `created_at`, `theme`) VALUES
(101, 'LIB/101/2024', '$2y$10$3SEQ3mGAoWOexoewiwKiuOchy7T/YxxCAV6.mYJ9b3sAyn0FrKT6K', 'Brian Otieno Mwangi', 2, 'Library', 'Librarian', 'library.admin@university.ac.ke', '2026-04-08 08:39:46', 'light'),
(102, 'FIN/102/2024', '$2y$10$TNzAX1mmkpSWephR2g9jxet3l7pt2mIoqgn/tPdh0x52et0sK2b7.', 'Mary Njeri Wanjiku', 3, 'Finance', 'Head of Finance', 'finance.head@university.ac.ke', '2026-04-08 08:39:46', 'light'),
(103, 'ENG/103/2024', '$2y$10$Yh8fJBlL5szlthOBLa6geOJlNueTqzWScs7X7ep3K/Pa6.NMsbtVy', 'Chinedu Okafor Obi', 4, 'Engineering', 'Lecturer', 'eng.lecturer@university.ac.ke', '2026-04-08 08:39:46', 'light'),
(104, 'SCI/104/2024', '$2y$10$C8dp07aMxJWuEzqPzIWLU.LS7c1MruE3WBGzjM5YI3AUAfnHvkDsG', 'Thandi Mbali Nkosi', 5, 'Science', 'Senior Lecturer', 'sci.srlecturer@university.ac.ke', '2026-04-08 08:39:46', 'light'),
(105, 'LAW/105/2024', '$2y$10$eTZLSfLdHkx0buH8kKdJhO6ttYOsd78qqNylQIDgjRmEKKmqrUVIq', 'Ahmed Hassan Abdullahi', 6, 'Law', 'Dean of Faculty', 'law.dean@university.ac.ke', '2026-04-08 08:39:46', 'light'),
(106, 'ART/106/2024', '$2y$10$IXaRckbV7IEdjrUHTB/pouEQCx9bc.isJEer0ZSmde2BeGW1cDxi2', 'Tunde Adebayo Ogunleye', 7, 'Arts', 'Lecturer', 'arts.lecturer@university.ac.ke', '2026-04-08 08:39:46', 'light'),
(107, 'ICT/107/2024', '$2y$10$wzxL8QL/apS4Zgl05GyXCurTUHsufTQ9jLjy45AUD9hMKM.OeHP3m', 'Grace Wanyama Achieng', 8, 'ICT', 'Administrator', 'admin.ict@university.ac.ke', '2026-04-08 08:39:46', 'light'),
(108, 'MAT/108/2025', '$2y$10$WRWOM7E3tcZfw9gQr3Ne6.A6in9SeyAnNCsWHf7KDhq8jgtLMykcG', 'Peter Kamau Njoroge', 9, 'Estates', 'Lecturer', 'estates.lecturer@university.ac.ke', '2026-04-08 08:39:46', 'light'),
(109, 'STA/109/2025', '$2y$10$h1WYbBJjOpEk4lQLPbIeteYYCKwVSgIANZoY1zsHq/yidNfdjC91e', 'Fatima Zahra Musa', 10, 'Student Affairs', 'Counselor', 'student.counselor@university.ac.ke', '2026-04-08 08:39:46', 'light'),
(110, 'BUS/110/2025', '$2y$10$rk.2FoDp/D6QA9FUg3qm1uMtm6jjZ/psxswQ91FIH9Tq9Uyuujuvi', 'James Mwangi Kariuki', 11, 'Business', 'Lecturer', 'biz.lecturer@university.ac.ke', '2026-04-08 08:39:46', 'light'),
(111, 'ADM/111/2025', '$2y$10$UbRzVtXCthUHV.4OhzNBTem55SQ7eji.Xnj2Pil9F5r00FpIlxbpO', 'David Okello Ouma', 1, 'Admissions', 'Admissions Officer', 'delaprincekingmall@gmail.com', '2026-04-08 08:39:46', 'dark'),
(112, 'ENV/112/2025', '$2y$10$vEmbLvTwEDwr4ayrqoErUuVNF3pqx.JQbqQ.cuii5K41rtojGH0Zm', 'Sipho Ndlovu Khumalo', 12, 'Halls', 'Manager', 'halls.rooms@university.ac.ke', '2026-04-08 08:39:46', 'light'),
(113, 'PHY/113/2025', '$2y$10$6pf7789uCX4YPmYJc7tGA.mJ6LGIZvFqo72Oa3TmLpFWZiqE0zAzW', 'Kofi Mensah Owusu', 14, 'Transport', 'Secretary', 'transport.services@university.ac.ke', '2026-04-08 08:39:46', 'light'),
(114, 'CHE/114/2025', '$2y$10$4pFQF0lgb7/YIbeLOt/NO..soOke8oDiXjSedLQvHbTGt4TlxmKYC', 'Aminata Diallo Traore', 16, 'Security', 'Sargent', 'security.services@university.ac.ke', '2026-04-08 08:39:46', 'light'),
(115, 'ECO/115/2025', '$2y$10$8.cAKuOKVdowtNPEiBB7B.HKzbBmJm6B..lZg2Kp0le9ERoa.7UEO', 'Sade Balogun Adeyemi', 17, 'Catering', 'Chief chef', 'catering.hospitality@university.ac.ke', '2026-04-08 08:39:46', 'light'),
(117, 'EDU/117/2024', '$2y$10$RQOEQYdeVhGUduFpHoW8.eKFTx0E7UNUz8l8fjJYdtqSjhPe1kN8e', 'JOAN WANJIRU SHIKU', 19, 'EDUCATION', 'CURRICULUM', 'info@education.university.ac.ke', '2026-04-08 12:52:50', 'light'),
(118, 'MED/118/2025', '$2y$10$RFfG0dUk9syUD50DA7.ujudNF4qy.rN7ELQoHp/fOitjGAwRN3fa6', 'FAITH KISHUYA MAMAI', 20, 'Medicine', 'Supervisor', 'support@medicine.university.ac.ke', '2026-04-08 12:52:50', 'light'),
(119, 'COM/119/2025', '$2y$10$ao/qvwORO9WLJ3SupAT2putBQY/9OQ13yTNrFpiDmXYL9tR5qbSqy', 'BRIAN KIPROTICH', 21, 'COMTECH', 'Technician', 'support@comtech.university.ac.ke', '2026-04-08 12:59:26', 'light'),
(120, 'LAB/120/2025', '$2y$10$T7S18uf.tF5xNGfRV5Wg/O2/HdrfpfmSzdYd0emMkb5kNdRGiHs52', 'GRACE NJERI', 22, 'LABORATORY', 'Lab Assistant', 'lab@university.ac.ke', '2026-04-08 12:59:26', 'light'),
(121, 'COMP/121/2023', '$2y$10$g2ujHRjV0AhTcJGC1HrZgOA96LY2D9xAyVpofU10pKl7JMgCTfq6K', 'GADDIEL JUDE ONCHARI', 23, 'COMPUTING', 'IT CONSULTANT', 'computing@it.university.ac.ke', '2026-04-19 16:41:10', 'light');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `non_students`
--
ALTER TABLE `non_students`
  ADD PRIMARY KEY (`non_student_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `non_students`
--
ALTER TABLE `non_students`
  MODIFY `non_student_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=126;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
