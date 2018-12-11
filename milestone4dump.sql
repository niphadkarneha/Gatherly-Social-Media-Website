-- phpMyAdmin SQL Dump
-- version 4.4.6
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Dec 11, 2018 at 01:05 PM
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
) ENGINE=InnoDB AUTO_INCREMENT=1125 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`commentId`, `parent_messageId`, `comment`, `commentUserId`, `timeOfComent`) VALUES
(1122, 2126, 'asf sf asd', 96, '2018-12-06 19:18:36'),
(1123, 2126, 'a sdfa asf as f', 96, '2018-12-06 19:18:39'),
(1124, 2127, 'xsfd', 96, '2018-12-09 23:09:16');

-- --------------------------------------------------------

--
-- Table structure for table `directMessages`
--

CREATE TABLE IF NOT EXISTS `directMessages` (
  `directMessageId` int(11) NOT NULL,
  `fromUserId` int(22) NOT NULL,
  `toUserId` int(22) NOT NULL,
  `message` text NOT NULL,
  `betweenUsers` int(22) NOT NULL,
  `timeOfDm` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=71 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `directMessages`
--

INSERT INTO `directMessages` (`directMessageId`, `fromUserId`, `toUserId`, `message`, `betweenUsers`, `timeOfDm`) VALUES
(70, 96, 49, 'hi lightining', 0, '0000-00-00 00:00:00');

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
) ENGINE=InnoDB AUTO_INCREMENT=123 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `groups`
--

INSERT INTO `groups` (`groupId`, `groupName`, `ownerUserId`, `type`, `status`, `created_at`) VALUES
(3, 'global', 61, 'public', 0, '2018-12-06 15:45:05'),
(122, 'publicgroupbyTom', 45, 'public', 0, '2018-11-28 06:00:17');

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
) ENGINE=InnoDB AUTO_INCREMENT=2128 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`messageId`, `groupId`, `message`, `UserId`, `TimeOfPost`, `postType`, `upVotes`, `downVotes`, `likeCount`) VALUES
(2122, 3, 'hi from admin', 66, '2018-12-06 18:24:38', '', 0, 0, 0),
(2124, 3, 'fa sdfas', 96, '2018-12-06 19:18:16', '', 0, 0, 0),
(2125, 3, 'a sdfasd a', 96, '2018-12-06 19:18:18', '', 0, 0, 0),
(2126, 3, 'a sdfas f', 96, '2018-12-06 19:18:19', '', 0, 0, 0),
(2127, 3, 'ser', 96, '2018-12-09 23:09:14', '', 0, 0, 0);

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
  `displayPic` int(11) NOT NULL,
  `Password` varchar(244) NOT NULL,
  `PhoneNumber` text NOT NULL,
  `type` int(11) NOT NULL,
  `github` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=98 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`ID`, `UserName`, `FirstName`, `LastName`, `Email`, `ProfilePicture`, `displayPic`, `Password`, `PhoneNumber`, `type`, `github`) VALUES
(45, 'mater@rsprings.gov', 'Tom', 'Mater', 'mater@rsprings.gov', 'images/45.png', 1, '@mater', '', 0, 0),
(46, 'porsche@rsprings.gov', 'Sally', 'Carrera', 'porsche@rsprings.gov', '', 0, '@sally', '', 0, 0),
(47, 'hornet@rsprings.gov', 'Doc', 'Hudson', 'hornet@rsprings.gov', '', 0, '@doc', '', 0, 0),
(48, 'topsecret@agent.org', 'Finn', 'McMissile', 'topsecret@agent.org', '', 0, '@mcmissile', '', 0, 0),
(49, 'kachow@rusteze.com', 'Lightning', 'McQueen', 'kachow@rusteze.com', '', 0, '@mcqueen', '', 0, 0),
(66, 'admin', 'admin', 'admin', 'admin@gatherly.com', 'images/66.png', 1, '123', '', 1, 0),
(71, 'mack', 'Mack', 'truck', 'mack@gmail.com', '', 0, '123', '', 0, 0),
(72, 'nniph001', 'Neha', 'Niphadkar', 'nniph001@odu.edu', '', 0, '123', '', 0, 0),
(97, 'AbelWeldaregay', 'AbelWeldaregay', '', 'aweld002@odu.edu', 'https://avatars.githubusercontent.com/AbelWeldaregay', 0, '', '', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `userGroup`
--

CREATE TABLE IF NOT EXISTS `userGroup` (
  `id` int(11) NOT NULL,
  `groupUserId` int(11) NOT NULL,
  `groupId` int(11) NOT NULL,
  `joinedAt` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=224 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `userGroup`
--

INSERT INTO `userGroup` (`id`, `groupUserId`, `groupId`, `joinedAt`) VALUES
(162, 66, 3, '2018-11-20 11:53:30'),
(164, 47, 3, '2018-11-20 11:55:07'),
(165, 48, 3, '2018-11-20 11:55:58'),
(166, 49, 3, '2018-11-20 11:56:32'),
(167, 69, 3, '2018-11-20 12:26:12'),
(183, 70, 3, '2018-11-20 18:20:06'),
(191, 66, 122, '2018-11-20 18:37:16'),
(192, 71, 3, '2018-11-20 22:19:31'),
(194, 45, 122, '2018-11-26 12:02:19'),
(195, 72, 3, '2018-11-28 20:30:24'),
(196, 45, 3, '2018-11-29 19:31:14'),
(197, 73, 3, '2018-12-03 20:44:36'),
(198, 74, 3, '2018-12-03 20:45:53'),
(199, 75, 3, '2018-12-03 20:46:42'),
(200, 76, 3, '2018-12-03 20:50:49'),
(201, 77, 3, '2018-12-03 20:56:19'),
(202, 78, 3, '2018-12-03 20:56:46'),
(203, 79, 3, '2018-12-03 20:59:03'),
(204, 80, 3, '2018-12-03 21:02:16'),
(205, 81, 3, '2018-12-03 21:03:55'),
(206, 46, 3, '2018-12-04 02:05:06'),
(207, 83, 3, '2018-12-05 07:48:31'),
(208, 83, 122, '2018-12-05 07:48:52'),
(209, 84, 3, '2018-12-05 07:58:45'),
(210, 85, 3, '2018-12-05 08:09:44'),
(211, 86, 3, '2018-12-05 08:17:46'),
(212, 87, 3, '2018-12-05 11:04:17'),
(213, 88, 3, '2018-12-05 17:37:21'),
(214, 89, 3, '2018-12-05 19:32:23'),
(215, 90, 3, '2018-12-05 19:42:21'),
(216, 91, 3, '2018-12-06 17:54:52'),
(217, 92, 3, '2018-12-06 17:56:17'),
(218, 93, 3, '2018-12-06 18:04:55'),
(219, 93, 122, '2018-12-06 18:05:59'),
(220, 94, 3, '2018-12-06 18:23:33'),
(221, 95, 3, '2018-12-06 18:27:53'),
(222, 96, 3, '2018-12-06 18:29:16'),
(223, 97, 3, '2018-12-11 17:41:29');

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
-- Indexes for table `directMessages`
--
ALTER TABLE `directMessages`
  ADD PRIMARY KEY (`directMessageId`);

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
  MODIFY `commentId` int(25) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=1125;
--
-- AUTO_INCREMENT for table `directMessages`
--
ALTER TABLE `directMessages`
  MODIFY `directMessageId` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=71;
--
-- AUTO_INCREMENT for table `groupInvite`
--
ALTER TABLE `groupInvite`
  MODIFY `inviteId` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=31;
--
-- AUTO_INCREMENT for table `groups`
--
ALTER TABLE `groups`
  MODIFY `groupId` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=123;
--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `messageId` int(20) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2128;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=98;
--
-- AUTO_INCREMENT for table `userGroup`
--
ALTER TABLE `userGroup`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=224;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
