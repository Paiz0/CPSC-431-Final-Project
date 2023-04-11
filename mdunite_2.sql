-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Apr 08, 2023 at 04:29 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

-- SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
-- START TRANSACTION;
-- SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mdunite`
--

CREATE DATABASE IF NOT EXISTS mdunite;

USE mdunite;

-- --------------------------------------------------------

--
-- Table structure for table `medicalProfessional`
--

CREATE TABLE IF NOT EXISTS `medicalProfessional` (
  `mpID` int(11) NOT NULL AUTO_INCREMENT,
  `mpTitle` varchar(40) NOT NULL,
  `mpEmail` varchar(50) NOT NULL,
  `mpPassword` varchar(50) NOT NULL,
  `mpLocation` int(11) NOT NULL,
  `mpContact` tinyint(1) NOT NULL,
  `mpFullName` varchar(50) NOT NULL,

  PRIMARY KEY (`mpID`),
  UNIQUE KEY `mpEmail` (`mpEmail`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `medicalProfessional`
--

INSERT INTO `medicalProfessional` (`mpID`, `mpTitle`, `mpEmail`, `mpPassword`, `mpLocation`, `mpContact`, `mpFullName`) VALUES
(14, 'Dr', 'email@email.com', 'ad', 23123, 0, 'full name '),
(32, 'Dr', 'ema23il@email.com', 'adas', 23123, 1, 'full name '),
(35, 'd', '23email@email.com', 'asd', 231, 1, 'a '),
(38, 'Dr', 'emadsdil@email.com', 'e', 43, 0, 's ');

-- --------------------------------------------------------

--
-- Table structure for table `message`
--

CREATE TABLE IF NOT EXISTS `message` (
  `mpID` int(11) NOT NULL,
  `senderID` int(11) NOT NULL,
  `messageID` int(11) NOT NULL AUTO_INCREMENT,
  `message` varchar(500) NOT NULL,
  `receiverID` int(11) NOT NULL,

  PRIMARY KEY (`messageID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `supplier`
--

CREATE TABLE IF NOT EXISTS `supplier` (
  `supplierID` int(11) NOT NULL,
  `supplierName` varchar(30) NOT NULL,
  `supplierField` varchar(50) NOT NULL,
  `supplierLocation` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `medicalProfessional`
--
-- ALTER TABLE `medicalProfessional`
--   ADD PRIMARY KEY (`mpID`),
--   ADD UNIQUE KEY `mpEmail` (`mpEmail`);

--
-- Indexes for table `message`
--
-- ALTER TABLE `message`
--   ADD PRIMARY KEY (`messageID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `medicalProfessional`
--
-- ALTER TABLE `medicalProfessional`
--   MODIFY `mpID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;

--
-- AUTO_INCREMENT for table `message`
--
-- ALTER TABLE `message`
--   MODIFY `messageID` int(11) NOT NULL AUTO_INCREMENT;
-- COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
