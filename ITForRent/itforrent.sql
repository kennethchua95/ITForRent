-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 21, 2022 at 10:56 AM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.1.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `itforrent`
--
CREATE DATABASE IF NOT EXISTS `itforrent` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `itforrent`;

-- --------------------------------------------------------

--
-- Table structure for table `productlist`
--

CREATE TABLE IF NOT EXISTS `productlist` (
  `productID` varchar(255) NOT NULL,
  `Category` varchar(255) NOT NULL,
  `Brand` varchar(255) NOT NULL,
  `Description` varchar(255) NOT NULL,
  `Status` varchar(255) NOT NULL,
  `costPerDay` varchar(255) NOT NULL DEFAULT '0',
  `extCostPerDay` varchar(255) NOT NULL DEFAULT '0',
  `rented` varchar(255) NOT NULL DEFAULT 'Not rented',
  `daysRented` varchar(255) NOT NULL DEFAULT '0',
  `dueDate` varchar(255) DEFAULT NULL,
  `totalCost` varchar(255) NOT NULL DEFAULT '0',
  PRIMARY KEY (`productID`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `productlist`
--

INSERT INTO `productlist` (`productID`, `Category`, `Brand`, `Description`, `Status`, `costPerDay`, `extCostPerDay`, `rented`, `daysRented`, `dueDate`, `totalCost`) VALUES
('product1', 'laptop', 'apple', 'macbook', 'good', '10', '20', 'Not rented', '0', NULL, '0'),
('product2', 'router', 'Acer', 'Acer router', 'good', '10', '30', 'Not rented', '0', NULL, '0'),
('product3', 'modem', 'acer', 'modem', 'excellent', '20', '40', 'Not rented', '0', NULL, '0'),
('product4', 'others', 'apple', 'mac stuff', 'good', '70', '80', 'Not rented', '0', NULL, '0'),
('product5', 'laptop', 'alienware', 'alienware laptop', 'good', '30', '45', 'Not rented', '0', NULL, '0');

-- --------------------------------------------------------

--
-- Table structure for table `useraccount`
--

CREATE TABLE IF NOT EXISTS `useraccount` (
  `loginID` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `surname` varchar(255) NOT NULL,
  `phone` int(8) NOT NULL,
  `email` varchar(255) NOT NULL,
  `userType` varchar(20) NOT NULL,
  PRIMARY KEY (`loginID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `useraccount`
--

INSERT INTO `useraccount` (`loginID`, `password`, `name`, `surname`, `phone`, `email`, `userType`) VALUES
('AdminKen', 'asdasd', 'kenneth', 'chua', 92883282, 'ken@mail.com', 'administrator'),
('clientKen', 'asdasd', 'ken', 'chua', 92838238, 'k@mail.com', 'client');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
