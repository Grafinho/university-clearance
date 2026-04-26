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
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `payment_method` enum('MPESA','Credit Card','Bank Transfer') NOT NULL,
  `bank_name` varchar(100) DEFAULT NULL,
  `branch` varchar(100) DEFAULT NULL,
  `account_number` varchar(50) DEFAULT NULL,
  `amount` decimal(10,2) NOT NULL,
  `transaction_id` varchar(100) DEFAULT NULL,
  `confirmation_code` varchar(100) DEFAULT NULL,
  `phone_number` varchar(20) DEFAULT NULL,
  `payment_status` enum('Pending','Completed','Failed') DEFAULT 'Pending',
  `transaction_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`id`, `username`, `payment_method`, `bank_name`, `branch`, `account_number`, `amount`, `transaction_id`, `confirmation_code`, `phone_number`, `payment_status`, `transaction_date`) VALUES
(1, 'ED/SCI/1004/21', 'MPESA', '', '', '', 1.00, '', '', '0701526977', 'Pending', '2026-04-17 14:56:41'),
(2, 'ED/SCI/1004/21', 'MPESA', '', '', '', 1.00, '', '', '0701526977', 'Pending', '2026-04-17 15:09:51'),
(3, 'ED/SCI/1004/21', 'MPESA', '', '', '', 1.00, '', '', '254701526977', 'Pending', '2026-04-17 15:12:54'),
(4, 'ED/SCI/1004/21', 'MPESA', '', '', '', 1.00, '', '', '254701526977', 'Pending', '2026-04-17 15:34:34'),
(5, 'ED/SCI/1004/21', 'MPESA', '', '', '', 1.00, '', '', '254701526977', 'Pending', '2026-04-17 15:46:44'),
(6, 'ED/SCI/1004/21', 'MPESA', '', '', '', 1.00, '', '', '254701526977', 'Pending', '2026-04-17 15:51:52'),
(7, 'ED/SCI/1004/21', 'MPESA', '', '', '', 1.00, '', '', '254705039454', 'Pending', '2026-04-17 16:00:20'),
(8, 'ED/SCI/1004/21', 'MPESA', '', '', '', 1.00, '', '', '254705039454', 'Pending', '2026-04-17 16:10:29'),
(9, 'CP/COMP/1001/21', 'MPESA', '', '', '', 1.00, '', '', '254796272551', 'Pending', '2026-04-25 14:54:10'),
(10, 'CP/COMP/1001/21', 'MPESA', '', '', '', 1.00, '', '', '254796272551', 'Pending', '2026-04-25 14:54:45'),
(11, 'CP/COMP/1001/21', 'MPESA', '', '', '', 1.00, '', '', '254701526977', 'Pending', '2026-04-25 14:57:40'),
(12, 'ED/SCI/1004/21', 'MPESA', '', '', '', 1.00, '', '', '254701526977', 'Pending', '2026-04-26 06:03:13'),
(13, 'ED/SCI/1004/21', 'MPESA', '', '', '', 1.00, '', '', '254701526977', 'Completed', '2026-04-26 06:46:41'),
(14, 'ED/SCI/1004/21', 'MPESA', '', '', '', 1.00, '', '', '254796272551', 'Completed', '2026-04-26 10:11:17');

--
-- Triggers `payments`
--
DELIMITER $$
CREATE TRIGGER `update_paid_fees_after_payment` AFTER INSERT ON `payments` FOR EACH ROW BEGIN
    IF NEW.payment_status = 'Completed' THEN
        UPDATE users
        SET paid_fees = paid_fees + NEW.amount
        WHERE username = NEW.username;
    END IF;
END
$$
DELIMITER ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
