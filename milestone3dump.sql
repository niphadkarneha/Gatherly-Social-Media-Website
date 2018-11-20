-- phpMyAdmin SQL Dump
-- version 4.4.6
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Nov 20, 2018 at 11:52 AM
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
) ENGINE=InnoDB AUTO_INCREMENT=881 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`commentId`, `parent_messageId`, `comment`, `commentUserId`, `timeOfComent`) VALUES
(871, 1837, '11', 45, '2018-11-20 12:23:34'),
(872, 1837, '12', 45, '2018-11-20 12:23:36'),
(873, 1837, '13', 45, '2018-11-20 12:23:38'),
(874, 1837, '14', 45, '2018-11-20 12:23:43'),
(875, 1837, '15', 45, '2018-11-20 12:23:45'),
(876, 1837, '16', 45, '2018-11-20 12:23:47'),
(877, 1837, '17', 45, '2018-11-20 12:23:50'),
(878, 1837, '18', 45, '2018-11-20 12:23:53'),
(879, 1837, '19', 45, '2018-11-20 12:23:56'),
(880, 1837, '20', 45, '2018-11-20 12:23:59');

-- --------------------------------------------------------

--
-- Table structure for table `groupInvite`
--

CREATE TABLE IF NOT EXISTS `groupInvite` (
  `groupId` int(20) NOT NULL,
  `inviteId` int(11) NOT NULL,
  `userIdInvited` int(20) NOT NULL,
  `timeOfInvite` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `groups`
--

CREATE TABLE IF NOT EXISTS `groups` (
  `groupId` int(11) NOT NULL,
  `groupName` varchar(244) NOT NULL,
  `ownerUserId` int(11) NOT NULL,
  `type` varchar(50) NOT NULL,
  `status` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=114 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `groups`
--

INSERT INTO `groups` (`groupId`, `groupName`, `ownerUserId`, `type`, `status`, `created_at`) VALUES
(3, 'global', 61, 'public', 0, '2018-11-20 12:42:35'),
(113, 'fasdfasd', 69, 'private', 0, '2018-11-20 12:40:46');

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
  `postType` text NOT NULL,
  `upVotes` int(22) NOT NULL,
  `downVotes` int(11) NOT NULL,
  `likeCount` int(22) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=1845 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`messageId`, `groupId`, `message`, `UserId`, `TimeOfPost`, `postType`, `upVotes`, `downVotes`, `likeCount`) VALUES
(1844, 3, 'hello', 66, '2018-11-20 12:43:06', '', 0, 0, 0);

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
  `ProfilePicture` varchar(244) NOT NULL,
  `Password` varchar(244) NOT NULL,
  `PhoneNumber` text NOT NULL,
  `type` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=70 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`ID`, `UserName`, `FirstName`, `LastName`, `Email`, `ProfilePicture`, `Password`, `PhoneNumber`, `type`) VALUES
(45, 'mater@rsprings.gov', 'Tom', 'Mater', 'mater@rsprings.gov', 'images/45.png', '@mater', '', 0),
(46, 'porsche@rsprings.gov', 'Sally', 'Carrera', 'porsche@rsprings.gov', '', '@sally', '', 0),
(47, 'hornet@rsprings.gov', 'Doc', 'Hudson', 'hornet@rsprings.gov', '', '@doc', '', 0),
(48, 'topsecret@agent.org', 'Finn', 'McMissile', 'topsecret@agent.org', '', '@mcmissile', '', 0),
(49, 'kachow@rusteze.com', 'Lightning', 'McQueen', 'kachow@rusteze.com', '', '@mcqueen', '', 0),
(66, 'admin', 'admin', 'admin', 'admin@gatherly.com', 'images/66.jpeg', '123', '', 1);

-- --------------------------------------------------------

--
-- Table structure for table `userGroup`
--

CREATE TABLE IF NOT EXISTS `userGroup` (
  `id` int(11) NOT NULL,
  `groupUserId` int(11) NOT NULL,
  `groupId` int(11) NOT NULL,
  `joinedAt` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=171 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `userGroup`
--

INSERT INTO `userGroup` (`id`, `groupUserId`, `groupId`, `joinedAt`) VALUES
(162, 66, 3, '2018-11-20 11:53:30'),
(163, 46, 3, '2018-11-20 11:54:25'),
(164, 47, 3, '2018-11-20 11:55:07'),
(165, 48, 3, '2018-11-20 11:55:58'),
(166, 49, 3, '2018-11-20 11:56:32'),
(167, 69, 3, '2018-11-20 12:26:12'),
(168, 69, 113, '2018-11-20 12:37:10'),
(169, 66, 113, '2018-11-20 12:37:10'),
(170, 45, 3, '2018-11-20 12:41:21');

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
  MODIFY `commentId` int(25) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=881;
--
-- AUTO_INCREMENT for table `groupInvite`
--
ALTER TABLE `groupInvite`
  MODIFY `inviteId` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=31;
--
-- AUTO_INCREMENT for table `groups`
--
ALTER TABLE `groups`
  MODIFY `groupId` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=114;
--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `messageId` int(20) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=1845;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=70;
--
-- AUTO_INCREMENT for table `userGroup`
--
ALTER TABLE `userGroup`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=171;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
