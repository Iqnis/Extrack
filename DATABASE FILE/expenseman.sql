-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 24, 2024 at 01:13 PM
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
-- Database: `expenseman`
--

-- --------------------------------------------------------

--
-- Table structure for table `expense`
--

CREATE TABLE `expense` (
  `UserId` int(11) NOT NULL,
  `ID` int(11) NOT NULL,
  `Item` varchar(255) NOT NULL,
  `Category` varchar(100) NOT NULL,
  `Cost` decimal(25,2) NOT NULL,
  `Date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `expense`
--

INSERT INTO `expense` (`UserId`, `ID`, `Item`, `Category`, `Cost`, `Date`) VALUES
(2, 2, 'Grocery', '', 196.00, '2023-04-01 13:56:00'),
(2, 4, 'Test Yesterday', '', 699.00, '2023-06-11 17:55:00'),
(2, 5, 'T220', '', 2000.00, '2023-06-12 04:52:00'),
(3, 9, 'AAC Honey Badger', '', 1500.00, '2024-11-24 07:49:00'),
(3, 10, 'Glock 19', '', 500.00, '2024-11-24 07:50:00'),
(3, 11, 'ACOG Thermal Scope', '', 1000.00, '2024-11-24 07:50:00'),
(3, 12, 'Lightweight Custom Thumb Grip', '', 250.00, '2024-11-24 07:51:00'),
(3, 13, '5.56 mm Subsonic Round - 120 rounds', '', 100.00, '2024-11-24 07:51:00'),
(3, 14, 'Night Vision Thermal Lazer', '', 700.00, '2024-11-24 07:52:00'),
(3, 15, 'AAC Quickdraw Custom Mag', '', 300.00, '2024-11-24 07:52:00'),
(3, 16, 'Kel-Tec Plate Carrier', '', 500.00, '2024-11-24 07:54:00'),
(3, 17, 'Swiss Skeletal Tact-Knife', '', 120.00, '2024-11-24 07:54:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `expense`
--
ALTER TABLE `expense`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `expense`
--
ALTER TABLE `expense`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
