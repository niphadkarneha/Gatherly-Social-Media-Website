-- phpMyAdmin SQL Dump
-- version 4.4.6
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Oct 30, 2018 at 12:58 AM
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
-- Table structure for table `comments`
--

CREATE TABLE IF NOT EXISTS `comments` (
  `commentId` int(25) NOT NULL,
  `parent_messageId` int(25) NOT NULL,
  `comment` text NOT NULL,
  `commentUserId` int(25) NOT NULL,
  `timeOfComent` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=310 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `groupInvite`
--

CREATE TABLE IF NOT EXISTS `groupInvite` (
  `groupId` int(20) NOT NULL,
  `inviteId` int(11) NOT NULL,
  `userIdInvited` int(20) NOT NULL,
  `timeOfInvite` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `groups`
--

CREATE TABLE IF NOT EXISTS `groups` (
  `groupId` int(11) NOT NULL,
  `groupName` varchar(244) NOT NULL,
  `ownerUserId` int(11) NOT NULL,
  `type` varchar(50) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=69 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `groups`
--

INSERT INTO `groups` (`groupId`, `groupName`, `ownerUserId`, `type`, `created_at`) VALUES
(64, 'NewPrivateGroup', 40, 'private', '2018-10-30 03:36:16'),
(65, 'newPublicGroup', 37, 'public', '2018-10-30 03:44:45'),
(66, 'NewPrivateGroupbyMater', 16, 'private', '2018-10-30 04:05:50'),
(67, 'PrivateGroup', 16, 'private', '2018-10-30 04:06:21'),
(68, 'GroupOnDockerPrivate', 16, 'private', '2018-10-30 04:51:47');

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE IF NOT EXISTS `posts` (
  `messageId` int(20) NOT NULL,
  `groupId` int(20) NOT NULL,
  `message` text NOT NULL,
  `UserId` int(20) NOT NULL,
  `TimeOfPost` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `likeCount` int(22) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=525 DEFAULT CHARSET=latin1;

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
) ENGINE=InnoDB AUTO_INCREMENT=42 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`ID`, `UserName`, `FirstName`, `LastName`, `Email`, `Status`, `ProfilePicture`, `Password`, `PhoneNumber`, `profile`) VALUES
(8, 'porsche@rsprings.gov', 'Sally', 'Carrera', 'porsche@rsprings.gov', '', '', '@sally', '', ''),
(9, 'hornet@rsprings.gov', 'Doc', 'Hudson', 'hornet@rsprings.gov', '', '', '@doc', '', ''),
(12, 'topsecret@agent.org', 'Finn', 'McMissile', 'topsecret@agent.org', '', '', '@mcmissile', '', ''),
(13, 'kachow@rusteze.com', 'Lightning', 'McQueen', 'kachow@rusteze.com', '', 'images/13.jpeg', '@mcqueen', '', ''),
(16, 'mater@rsprings.gov', 'Tom', 'Mater', 'mater@rsprings.gov', '', 'images/16.png', '@mater', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `userGroup`
--

CREATE TABLE IF NOT EXISTS `userGroup` (
  `id` int(11) NOT NULL,
  `groupUserId` int(11) NOT NULL,
  `groupId` int(11) NOT NULL,
  `joinedAt` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=42 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `userGroup`
--

INSERT INTO `userGroup` (`id`, `groupUserId`, `groupId`, `joinedAt`) VALUES
(35, 40, 64, '2018-10-30 03:36:16'),
(36, 37, 65, '2018-10-30 03:44:45'),
(37, 16, 66, '2018-10-30 04:05:50'),
(38, 16, 67, '2018-10-30 04:06:21'),
(39, 16, 68, '2018-10-30 04:51:47'),
(40, 12, 68, '2018-10-30 04:54:12'),
(41, 8, 65, '2018-10-30 04:55:38');

-- --------------------------------------------------------

--
-- Table structure for table `userLikes`
--

CREATE TABLE IF NOT EXISTS `userLikes` (
  `message_id` int(20) NOT NULL,
  `userId` int(20) NOT NULL,
  `reactionId` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`commentId`);

--
-- Indexes for table `groupInvite`
--
ALTER TABLE `groupInvite`
  ADD PRIMARY KEY (`inviteId`);

--
-- Indexes for table `groups`
--
ALTER TABLE `groups`
  ADD PRIMARY KEY (`groupId`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`messageId`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `userGroup`
--
ALTER TABLE `userGroup`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `userLikes`
--
ALTER TABLE `userLikes`
  ADD UNIQUE KEY `message_id` (`message_id`,`userId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `commentId` int(25) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=310;
--
-- AUTO_INCREMENT for table `groupInvite`
--
ALTER TABLE `groupInvite`
  MODIFY `inviteId` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=21;
--
-- AUTO_INCREMENT for table `groups`
--
ALTER TABLE `groups`
  MODIFY `groupId` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=69;
--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `messageId` int(20) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=525;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=42;
--
-- AUTO_INCREMENT for table `userGroup`
--
ALTER TABLE `userGroup`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=42;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
