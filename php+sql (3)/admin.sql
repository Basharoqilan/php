-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 23, 2024 at 01:09 PM
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
-- Database: `admin`
--

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id_roles` int(11) NOT NULL,
  `role` varchar(100) DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id_roles`, `role`) VALUES
(1, 'admin'),
(2, 'user');

-- --------------------------------------------------------

--
-- Table structure for table `superuser`
--

CREATE TABLE `superuser` (
  `ID` int(11) NOT NULL,
  `User_image` blob DEFAULT NULL,
  `Name` varchar(255) DEFAULT NULL,
  `Email` varchar(255) DEFAULT NULL,
  `date_created` date DEFAULT NULL,
  `Phone_number` int(10) DEFAULT NULL,
  `id_roles` int(11) DEFAULT 2,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `superuser`
--

INSERT INTO `superuser` (`ID`, `User_image`, `Name`, `Email`, `date_created`, `Phone_number`, `id_roles`, `password`) VALUES
(25, 0x696d672f322e6a7067, 'bashar mahmoud musa oqilan', 'basharoqilan@gmail.com', '2024-07-23', 775498658, 1, '$2y$10$6LkJIruH93EHG5weZN3o0.Jc9dOPIiU9iHMLbjsVK/V088WE/M3KW'),
(28, 0x696d672f322e6a7067, 'yousef mahmoud musa oqilan', 'basharoqilan2@gmail.com', '2024-07-23', 775498658, 2, '$2y$10$J.PQWspr0.XEyg6w7hwax.KtlewgERjxcswM6fkQ2ulab40WypmMG'),
(29, 0x696d672f322e6a7067, 'bashar mahmoud musa oqilan', 'basharoqilan@gmail.com', '2024-07-23', 775498658, 2, '$2y$10$aLKm3azY6.fqWBtOk8U7Yu9hN24pO4Hq/YJnSigM6yyVDeDs5CeRm');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id_roles`);

--
-- Indexes for table `superuser`
--
ALTER TABLE `superuser`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `id_roles` (`id_roles`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id_roles` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `superuser`
--
ALTER TABLE `superuser`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `superuser`
--
ALTER TABLE `superuser`
  ADD CONSTRAINT `superuser_ibfk_1` FOREIGN KEY (`id_roles`) REFERENCES `roles` (`id_roles`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
