-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 16, 2021 at 10:10 AM
-- Server version: 10.4.18-MariaDB
-- PHP Version: 7.4.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `shopping_items`
--

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `catID` int(11) NOT NULL,
  `catName` varchar(64) NOT NULL,
  `catDescription` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`catID`, `catName`, `catDescription`) VALUES
(1, 'Food', 'You can find all the food you need here'),
(2, 'Cleaning', 'All your cleaning material are here'),
(3, 'Miscellaneous\r\n\r\n', 'All the miscellaneous are here');

-- --------------------------------------------------------

--
-- Table structure for table `item`
--

CREATE TABLE `item` (
  `itemID` int(11) NOT NULL,
  `itemName` varchar(64) NOT NULL,
  `itemDescription` text NOT NULL,
  `itemPrice` decimal(8,2) NOT NULL,
  `itemPhoto` varchar(100) NOT NULL,
  `itemQuantity` int(11) NOT NULL,
  `catID` int(11) NOT NULL,
  `userID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `item`
--

INSERT INTO `item` (`itemID`, `itemName`, `itemDescription`, `itemPrice`, `itemPhoto`, `itemQuantity`, `catID`, `userID`) VALUES
(12, 'apples', 'you can eat it in the morning if you like', '3.00', '', 6, 1, 1),
(13, 'bananas', 'eat it for breakfast', '2.00', '', 4, 1, 1),
(14, 'chicken', 'nice and juicy ', '5.00', '', 1, 1, 1),
(15, 'steak', 'treat yourself', '6.00', '', 2, 1, 1),
(16, 'lettuce', 'refreshing', '2.00', '', 1, 1, 1),
(17, 'tomatoes', 'great in summer', '1.00', '', 6, 1, 2),
(18, 'apple juice', 'great healthy choice', '3.00', '', 1, 1, 2),
(19, 'soap', 'clean the house with it', '2.00', '', 1, 2, 2),
(20, 'toothpaste', 'brush your teeth', '2.00', '', 1, 3, 2),
(21, 'shampoo', 'wash your hair', '3.00', '', 1, 3, 2),
(24, 'rocket', 'healthy salad', '5.00', '', 3, 1, 2),
(27, 'capsicum', 'ideal for soups', '5.00', '', 6, 1, 1),
(28, 'strawberry', 'seasonal, juicy and sweet', '2.00', '', 5, 1, 1),
(40, 'zucchini', 'nice and green ', '4.00', '', 2, 1, 2),
(42, 'dishwasher liquid', 'clean the dishes', '3.00', '', 2, 2, 3);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `userID` int(11) NOT NULL,
  `firstName` varchar(64) NOT NULL,
  `lastName` varchar(64) NOT NULL,
  `email` varchar(64) NOT NULL,
  `username` varchar(64) NOT NULL,
  `salt` char(64) NOT NULL,
  `password` char(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`userID`, `firstName`, `lastName`, `email`, `username`, `salt`, `password`) VALUES
(1, 'john', 'green', 'john@gmail.com', 'johnGreen', 'bd804aa6b398d36d4e454c1788a37d00', 'f8b5f86ed3d31f6d6e8e252df59dd7830f9e0835c7b21ad0bde55afe3eeaa6e2'),
(2, 'Mark', 'Green', 'mark@gmail.com', 'markGreen', '99b8dacf15abe491c39285e7a596bc5d', 'e817b30b82713812cccf86695887c1205d24e8a5dbcfd3227888bdf00455bc6e'),
(3, 'stew', 'red', 'stew@gmail.com', 'stewRed', 'c444b83ecc0ef6013d9c0750266958eb', 'dc70d116bff7a004f78192b5a141d6e510c56334dd58798132086a0809f8ca14');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`catID`);

--
-- Indexes for table `item`
--
ALTER TABLE `item`
  ADD PRIMARY KEY (`itemID`),
  ADD KEY `catID` (`catID`),
  ADD KEY `item_ibfk_2` (`userID`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`userID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `catID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `item`
--
ALTER TABLE `item`
  MODIFY `itemID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `userID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `item`
--
ALTER TABLE `item`
  ADD CONSTRAINT `item_ibfk_1` FOREIGN KEY (`catID`) REFERENCES `category` (`catID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `item_ibfk_2` FOREIGN KEY (`userID`) REFERENCES `user` (`userID`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
