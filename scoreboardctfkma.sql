-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Feb 04, 2018 at 11:13 AM
-- Server version: 10.1.19-MariaDB
-- PHP Version: 7.0.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `scoreboardctfkma`
--

-- --------------------------------------------------------

--
-- Table structure for table `event`
--

CREATE TABLE `event` (
  `id` int(11) NOT NULL,
  `name` varchar(20) DEFAULT NULL,
  `weight` double DEFAULT NULL,
  `start_at` date DEFAULT NULL,
  `maxScore` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=ascii;


-- --------------------------------------------------------

--
-- Table structure for table `player`
--

CREATE TABLE `player` (
  `id` int(11) NOT NULL,
  `username` varchar(20) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `fullname` varchar(255) DEFAULT NULL,
  `class` varchar(5) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `role` int(1) NOT NULL DEFAULT '0',
  `main_category` varchar(25) NOT NULL,
  `cryptScore` double NOT NULL DEFAULT '0',
  `forScore` double NOT NULL DEFAULT '0',
  `miscScore` double NOT NULL DEFAULT '0',
  `pwnScore` double NOT NULL DEFAULT '0',
  `reScore` double NOT NULL DEFAULT '0',
  `webScore` double NOT NULL DEFAULT '0',
  `totalScore` double NOT NULL DEFAULT '0',
  `lastUpdate` date NOT NULL DEFAULT '0000-00-00'
) ENGINE=InnoDB DEFAULT CHARSET=ascii;


-- --------------------------------------------------------

--
-- Table structure for table `score`
--

CREATE TABLE `score` (
  `playerID` int(11) NOT NULL,
  `eventID` int(11) NOT NULL,
  `cryptScore` double DEFAULT NULL,
  `forScore` double DEFAULT NULL,
  `miscScore` double DEFAULT NULL,
  `pwnScore` double DEFAULT NULL,
  `reScore` double DEFAULT NULL,
  `webScore` double DEFAULT NULL,
  `isConfirm` int(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=ascii;


--
-- Indexes for dumped tables
--


--
-- Indexes for table `event`
--
ALTER TABLE `event`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `player`
--
ALTER TABLE `player`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `score`
--
ALTER TABLE `score`
  ADD PRIMARY KEY (`playerID`,`eventID`),
  ADD KEY `eventID` (`eventID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `event`
--
ALTER TABLE `event`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `player`
--
ALTER TABLE `player`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `score`
--
ALTER TABLE `score`
  ADD CONSTRAINT `score_ibfk_1` FOREIGN KEY (`playerID`) REFERENCES `player` (`id`),
  ADD CONSTRAINT `score_ibfk_2` FOREIGN KEY (`eventID`) REFERENCES `event` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
