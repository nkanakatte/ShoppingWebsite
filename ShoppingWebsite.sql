-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Mar 01, 2022 at 01:44 AM
-- Server version: 5.7.34
-- PHP Version: 7.4.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ShoppingWebsite`
--
CREATE DATABASE IF NOT EXISTS `ShoppingWebsite1` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `ShoppingWebsite1`;

-- --------------------------------------------------------

--
-- Table structure for table `Administrators`
--

DROP TABLE IF EXISTS `Administrators`;
CREATE TABLE IF NOT EXISTS `Administrators` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `EmailAddress` varchar(50) NOT NULL,
  `FirstName` varchar(50) NOT NULL,
  `LastName` varchar(50) NOT NULL,
  `Password` varchar(50) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `Administrators`
--

INSERT INTO `Administrators` (`ID`, `EmailAddress`, `FirstName`, `LastName`, `Password`) VALUES
(1, 'joe@samshta.com', 'Joe', 'Brady', 'samshta'),
(2, 'jane@samshta.com', 'Jane', 'austin', 'samshta');

-- --------------------------------------------------------

--
-- Table structure for table `Customers`
--

DROP TABLE IF EXISTS `Customers`;
CREATE TABLE IF NOT EXISTS `Customers` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `FirstName` varchar(50) NOT NULL,
  `LastName` varchar(50) NOT NULL,
  `Email` varchar(50) NOT NULL,
  `Password` varchar(50) NOT NULL,
  `isDeleted` tinyint(1) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `Customers`
--

INSERT INTO `Customers` (`ID`, `FirstName`, `LastName`, `Email`, `Password`, `isDeleted`) VALUES
(1, 'Naveen', 'Kanakatte', 'naveenkn1977@yahoo.com', 'samshta', 0);

-- --------------------------------------------------------

--
-- Table structure for table `OrderItems`
--

DROP TABLE IF EXISTS `OrderItems`;
CREATE TABLE IF NOT EXISTS `OrderItems` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `OrderID` int(11) NOT NULL,
  `ProductID` int(11) NOT NULL,
  `Price` decimal(10,2) NOT NULL,
  `Quantity` int(10) NOT NULL,
  PRIMARY KEY (`ID`),
  KEY `OrderID` (`OrderID`),
  KEY `ProductID` (`ProductID`)
) ENGINE=InnoDB AUTO_INCREMENT=66 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `OrderItems`
--

INSERT INTO `OrderItems` (`ID`, `OrderID`, `ProductID`, `Price`, `Quantity`) VALUES
(54, 57, 1, '10.35', 1),
(55, 57, 2, '8.00', 1),
(56, 58, 1, '10.35', 1),
(57, 59, 3, '34.00', 1),
(58, 59, 5, '28.00', 1),
(59, 60, 2, '8.00', 150),
(60, 61, 6, '28.00', 1),
(61, 62, 6, '28.00', 1),
(62, 62, 1, '10.35', 1),
(63, 63, 1, '10.35', 1),
(64, 64, 5, '28.00', 1),
(65, 65, 1, '10.35', 1);

-- --------------------------------------------------------

--
-- Table structure for table `Orders`
--

DROP TABLE IF EXISTS `Orders`;
CREATE TABLE IF NOT EXISTS `Orders` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `CustomerID` int(11) NOT NULL,
  `OrderDate` datetime NOT NULL,
  `isDeleted` tinyint(1) NOT NULL,
  PRIMARY KEY (`ID`),
  KEY `CustomerID` (`CustomerID`)
) ENGINE=InnoDB AUTO_INCREMENT=66 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `Orders`
--

INSERT INTO `Orders` (`ID`, `CustomerID`, `OrderDate`, `isDeleted`) VALUES
(57, 1, '2022-02-22 20:50:21', 1),
(58, 1, '2022-02-23 00:26:34', 1),
(59, 1, '2022-02-23 00:26:59', 0),
(60, 1, '2022-02-23 00:27:49', 0),
(61, 1, '2022-03-01 01:04:09', 0),
(62, 1, '2022-03-01 01:04:26', 0),
(63, 1, '2022-03-01 01:05:39', 0),
(64, 1, '2022-03-01 01:06:47', 0),
(65, 1, '2022-03-01 01:07:46', 0);

-- --------------------------------------------------------

--
-- Table structure for table `Products`
--

DROP TABLE IF EXISTS `Products`;
CREATE TABLE IF NOT EXISTS `Products` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Name` varchar(50) NOT NULL,
  `Description` varchar(255) NOT NULL,
  `Price` decimal(10,2) NOT NULL,
  `Quantity` int(10) NOT NULL,
  `isDeleted` tinyint(1) NOT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `Products`
--

INSERT INTO `Products` (`Id`, `Name`, `Description`, `Price`, `Quantity`, `isDeleted`) VALUES
(1, 'Basketball', 'The preferred ball of many high school and college athletes which is among the top performers in its class. Advanced Cushion Technology combines low-density sponge rubber, producing a basketball with exceptional feel and unmatched durability.', '10.35', 7, 0),
(2, 'Volleyball', 'Your future all-star can develop his skills with this awesome Baseball. The RLLB1 Official Competition Grade Ball is designed with a full grain leather cover and composite cork/rubber pill center for predictable, long-lasting play.', '8.00', 293, 0),
(3, 'Tennis Raquet', 'A lightweight racquet for players with short, compact swings. This Racquet features a super stiff construction of titanium and graphite for incredible power and durability. A soft grip provides the ideal feel when going up strong against the competition.', '34.00', 49, 0),
(4, 'Baseball Bat', 'Strongest Alloy Yet: Delivers a stronger, more durable bat. Features a new variable wall thickness, a modified taper, and an improved wall design for higher performance and durability. Provides players with a larger surface area and a bigger sweet spot.', '34.00', 50, 0),
(5, 'Table Tennis Bat', 'Improve your table tennis performance with this able Tennis Paddle. This Paddle features a 5-ply select hardwood laminate blade, a hollow core handle, and 1.8mm sponge backing. Offering quality power, control, and accuracy.', '28.00', 33, 0),
(6, 'Cricket Bat', 'Grade Vellum Air Dried Willow cricket bat with Massive concave TON Edges to enable high impact with optimum performance.\r\nEmbossed sticker with 3 tone grip with a wide play area with clean bat face.', '28.00', 33, 0),
(7, 'Test', 'test', '10.00', 100, 1);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `OrderItems`
--
ALTER TABLE `OrderItems`
  ADD CONSTRAINT `orderitems_ibfk_1` FOREIGN KEY (`OrderID`) REFERENCES `Orders` (`ID`),
  ADD CONSTRAINT `orderitems_ibfk_2` FOREIGN KEY (`ProductID`) REFERENCES `Products` (`Id`);

--
-- Constraints for table `Orders`
--
ALTER TABLE `Orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`CustomerID`) REFERENCES `Customers` (`ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

CREATE USER 'cs602_user'@'%' IDENTIFIED BY 'cs602_secret';
GRANT ALL PRIVILEGES ON ShoppingWebsite1 . * TO 'cs602_user'@'localhost';