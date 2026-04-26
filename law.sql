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
-- Table structure for table `law`
--

CREATE TABLE `law` (
  `id` int(11) NOT NULL,
  `username` varchar(20) NOT NULL,
  `full_name` varchar(100) NOT NULL,
  `department` varchar(100) NOT NULL,
  `total_units` int(11) NOT NULL,
  `units_completed` int(11) NOT NULL,
  `incomplete_units` int(11) GENERATED ALWAYS AS (`total_units` - `units_completed`) STORED,
  `status` varchar(20) DEFAULT NULL,
  `comments` text DEFAULT NULL,
  `last_updated` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `law`
--

INSERT INTO `law` (`id`, `username`, `full_name`, `department`, `total_units`, `units_completed`, `status`, `comments`, `last_updated`) VALUES
(1, 'LAW/CRL/1006/21', 'David Ochieng', 'LAW', 1, 0, 'Pending', 'Disruption of session under review.', '2026-04-13 11:03:48'),
(2, 'LAW/CML/1015/21', 'Lucy Kamau', 'LAW', 1, 0, 'Pending', 'Access abuse; access revoked.', '2026-04-13 11:03:48'),
(3, 'LAW/HRL/1021/21', 'Thandiwe Ndlovu', 'LAW', 1, 0, 'Pending', 'Unauthorized document removal under investigation.', '2026-04-13 11:03:48');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `law`
--
ALTER TABLE `law`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `law`
--
ALTER TABLE `law`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
