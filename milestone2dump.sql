-- phpMyAdmin SQL Dump
-- version 4.4.6
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Oct 30, 2018 at 10:47 AM
-- Server version: 10.0.36-MariaDB-1~trusty
-- PHP Version: 5.5.9-1ubuntu4.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `fordFanatics`
--

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `ID` int(11) NOT NULL,
  `UserName` varchar(244) NOT NULL,
  `FirstName` varchar(244) NOT NULL,
  `LastName` varchar(244) NOT NULL,
  `Email` varchar(244) NOT NULL,
  `Status` varchar(244) NOT NULL,
  `ProfilePicture` varchar(244) NOT NULL,
  `Password` varchar(244) NOT NULL,
  `PhoneNumber` text NOT NULL,
  `profile` varchar(344) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=50 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`ID`, `UserName`, `FirstName`, `LastName`, `Email`, `Status`, `ProfilePicture`, `Password`, `PhoneNumber`, `profile`) VALUES
(45, 'mater@rsprings.gov', 'Tom', 'Mater', 'mater@rsprings.gov', '', '', '@mater', '', ''),
(46, 'porsche@rsprings.gov', 'Sally', 'Carrera', 'porsche@rsprings.gov', '', '', '@sally', '', ''),
(47, 'hornet@rsprings.gov', 'Doc', 'Hudson', 'hornet@rsprings.gov', '', '', '@doc', '', ''),
(48, 'topsecret@agent.org', 'Finn', 'McMissile', 'topsecret@agent.org', '', '', '@mcmissile', '', ''),
(49, 'kachow@rusteze.com', 'Lightning', 'McQueen', 'kachow@rusteze.com', '', '', '@mcqueen', '', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=50;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
