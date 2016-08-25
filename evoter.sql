-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Aug 25, 2016 at 06:37 AM
-- Server version: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `evoter`
--

-- --------------------------------------------------------

--
-- Table structure for table `ballotpaper`
--

CREATE TABLE IF NOT EXISTS `ballotpaper` (
  `ballotID` int(11) NOT NULL AUTO_INCREMENT,
  `securityPIN` int(11) NOT NULL,
  `vote` int(11) NOT NULL,
  `electionID` int(11) NOT NULL,
  PRIMARY KEY (`ballotID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `ballotpaper`
--

INSERT INTO `ballotpaper` (`ballotID`, `securityPIN`, `vote`, `electionID`) VALUES
(1, 0, 234, 33),
(2, 0, 234, 33);

-- --------------------------------------------------------

--
-- Table structure for table `campaignpost`
--

CREATE TABLE IF NOT EXISTS `campaignpost` (
  `psotID` int(11) NOT NULL AUTO_INCREMENT,
  `description` varchar(10000) NOT NULL,
  `attachment` varchar(200) NOT NULL,
  `memberID` int(11) NOT NULL,
  `electionID` int(11) NOT NULL,
  PRIMARY KEY (`psotID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `candidate`
--

CREATE TABLE IF NOT EXISTS `candidate` (
  `electionID` int(11) NOT NULL,
  `memberID` int(11) NOT NULL,
  `candidateNo` int(11) NOT NULL,
  `symbolImage` varchar(100) NOT NULL,
  `result` int(11) DEFAULT NULL,
  PRIMARY KEY (`memberID`,`electionID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `candidate`
--

INSERT INTO `candidate` (`electionID`, `memberID`, `candidateNo`, `symbolImage`, `result`) VALUES
(32, 1, 45, '../../public/uploads/bd50b2ab6418094db248941a661081f7.png', NULL),
(35, 2, 0, '', NULL),
(33, 4, 234, '../../public/uploads/a36f9f0bd96f56678bbd26fb9a698dc2.png', NULL),
(35, 8, 0, '', NULL),
(36, 9, 0, '', NULL),
(36, 12, 0, '', NULL),
(32, 123467, 67, '../../public/uploads/b563d587e67fc621a49caed799c65a40.png', NULL),
(32, 1234567890, 235, '../../public/uploads/a36f9f0bd96f56678bbd26fb9a698dc2.png80dd2d81d2a598a0cc5ee0f7879df2a0.png', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `clubmember`
--

CREATE TABLE IF NOT EXISTS `clubmember` (
  `memberID` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `NIC` varchar(10) NOT NULL,
  `email` varchar(50) NOT NULL,
  `mobileNumber` varchar(20) NOT NULL,
  `clubPost` varchar(50) NOT NULL,
  `profileImage` varchar(100) NOT NULL,
  `status` varchar(50) NOT NULL,
  `user_group` int(11) NOT NULL DEFAULT '1',
  `dateofjoin` date NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL,
  `securityquestions` int(2) NOT NULL DEFAULT '0',
  PRIMARY KEY (`memberID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `clubmember`
--

INSERT INTO `clubmember` (`memberID`, `name`, `NIC`, `email`, `mobileNumber`, `clubPost`, `profileImage`, `status`, `user_group`, `dateofjoin`, `username`, `password`, `securityquestions`) VALUES
(1, 'Dilini Weerasinghe', '916191197v', 'dweerasinghe91@gmail.com', '0718759697', 'Secretary', '#', 'registered', 2, '2016-06-14', 'dilini', '11111', 1),
(2, 'Tharindu', '923006678v', 'tharindu@yahoo.com', '0716789708', 'President', '#', 'registered', 0, '2016-01-14', 'piyuma', '11111', 1),
(3, 'Dilushika', '934567789v', 'dweerasingh91@gmail.com', '0718759697', 'Gold Member', '#', 'deleted-user', 0, '2016-02-02', 'dilu', '11111', 1),
(4, 'Shalika', '934578896v', 'fshalika.fdo@gmail.com', '0711877531', 'Senior Member', '#', 'registered', 0, '2016-05-01', 'shalika', '11111', 0),
(5, 'Darshana', '934511789v', 'drashana@gamail.com', '0776457872', 'Member', '#', 'registered', 0, '2016-06-18', 'darsh', '11111', 0),
(6, 'Nilanka', '924567784v', 'nilankasoori@gmail.com', '0711877531', 'Junior Member', '#', 'registered', 0, '2016-06-08', 'soori', '11111', 0),
(7, 'Niluma', '914537765v', 'niluamaa@yahoo.com', '0765678765', 'Member', '#', 'deleted-user', 0, '2016-05-02', 'Nilu', '11111', 0),
(8, 'Thushara', '916478845v', 'thush@gmail.com', '0715870087', 'Member', '#', 'registered', 0, '2016-06-10', 'thush', '11111', 1),
(9, 'Oshadhi', '923456674v', 'oshiw@yahoo.com', '0778975645', 'Member', '#', 'registered', 0, '2016-03-10', 'oshi', '11111', 1),
(10, 'Udara', '923456678v', 'ud@gmail.com', '0712567834', 'Member', '#', 'deleted-user', 0, '2016-06-16', 'ud', '11111', 0),
(11, 'Gayan', '934567783v', 'dgayanh@gmail.com', '0716789475', 'Member', '#', 'deleted-user', 0, '2016-07-02', 'gayya', '11111', 0),
(12, 'Nathaliya', '932456789v', 'nattyj@gmail.com', '0774567867', 'Member', '#', 'registered', 0, '2016-05-04', 'natty', '11111', 0),
(3456, 'ddddddddddd', '678888888v', 'ddadw@gmail.com', '0716789232', 'Vice President', '#', 'deleted-user', 1, '2016-08-27', 'et', '11111', 0),
(12345, 'Chathura', '789678803v', 'dweerasinghe@gmail.com', '0718759697', 'Member', '#', 'deleted-user', 1, '2016-08-05', 'chathu', '11111', 0),
(45678, 'dddddddddd', '916191198v', 'dweerasinghe96@gmail.com', '0718759697', 'member', '#', 'deleted-user', 1, '2016-07-05', 'iam', '11111', 1),
(122222, 'Gayan Herath', '945678896v', 'gayan.c.herath@gmail.com', '0718759697', 'President', '#', 'registered', 1, '2016-08-10', 'gayan', '11111', 1),
(123456, 'dulani', '111111111v', 'dweerasinghe91@gmail.com', '0718759697', 'Member', '#', 'deleted-user', 1, '2016-08-07', 'duli', '11111', 0),
(123467, 'Tharindu Piyumantha', '922222222v', 'tharindupiyumantha@gmail.com', '0714992888', 'Member', '#', 'registered', 1, '2016-02-02', 'tharindu', '11111', 1),
(222222, 'ssss', '222222222v', 'dweerasinghe97@gmail.com', '0718759697', 'Member', '#', 'deleted-user', 1, '2016-07-05', 'thushara', '11111', 0),
(777777, 'Gimshani', '787876578v', 'dweasinghe91@gmail.com', '0718674756', 'Member', '#', 'deleted-user', 1, '2016-08-12', 'gimi', '11111', 0),
(99999999, 'Nirmali', '999999999v', 'dweerasinghe91@gmail.com', '0718759697', 'Member', '#', 'deleted-user', 1, '0000-00-00', 'nirmali', '11111', 0),
(1234567890, 'Kasun Manathunga', '934000086v', 'kasun@hotmail.com', '0789890987', 'member', '#', 'registered', 1, '2015-12-01', 'kasun', '11111', 1);

-- --------------------------------------------------------

--
-- Table structure for table `election`
--

CREATE TABLE IF NOT EXISTS `election` (
  `electionID` int(11) NOT NULL AUTO_INCREMENT,
  `electionName` varchar(50) NOT NULL,
  `date` date NOT NULL,
  `startTime` time NOT NULL,
  `endTime` time NOT NULL,
  `noOfVotesPerPerson` int(11) NOT NULL,
  PRIMARY KEY (`electionID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=37 ;

--
-- Dumping data for table `election`
--

INSERT INTO `election` (`electionID`, `electionName`, `date`, `startTime`, `endTime`, `noOfVotesPerPerson`) VALUES
(32, 'presidential election', '2016-07-10', '00:00:00', '12:00:00', 2),
(33, 'Presidential election 2016', '2016-07-10', '10:00:00', '18:00:00', 1),
(34, 'rrr', '2016-08-26', '12:00:00', '12:00:00', 2),
(35, 'bbbb', '2016-09-07', '10:00:00', '12:00:00', 2),
(36, 'ggg', '2016-08-26', '12:00:00', '14:30:00', 2);

-- --------------------------------------------------------

--
-- Table structure for table `groups`
--

CREATE TABLE IF NOT EXISTS `groups` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `permissions` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `groups`
--

INSERT INTO `groups` (`id`, `name`, `permissions`) VALUES
(1, 'Standard user', ''),
(2, 'Administrator', '{"administrator":1}');

-- --------------------------------------------------------

--
-- Table structure for table `images`
--

CREATE TABLE IF NOT EXISTS `images` (
  `image_id` int(11) NOT NULL AUTO_INCREMENT,
  `image_name` varchar(50) NOT NULL,
  `image` varchar(50) NOT NULL,
  PRIMARY KEY (`image_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=18 ;

--
-- Dumping data for table `images`
--

INSERT INTO `images` (`image_id`, `image_name`, `image`) VALUES
(15, '43w53', '9H3A5551.jpg'),
(16, '43w53', '9H3A5551.jpg'),
(17, 'sdad', '13713293_1027691287351413_1293808272_n.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `memberelectiondetails`
--

CREATE TABLE IF NOT EXISTS `memberelectiondetails` (
  `memberID` int(11) NOT NULL,
  `electionID` int(11) NOT NULL,
  `votingStatus` varchar(20) NOT NULL,
  PRIMARY KEY (`memberID`,`electionID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `memberelectiondetails`
--

INSERT INTO `memberelectiondetails` (`memberID`, `electionID`, `votingStatus`) VALUES
(1, 32, 'to be voting'),
(2, 32, 'to be voting'),
(2, 33, 'to be voting'),
(3, 33, 'to be voting'),
(4, 32, 'to be voting'),
(4, 33, 'to be voting'),
(5, 32, 'to be voting'),
(5, 33, 'to be voting'),
(6, 33, 'to be voting');

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE IF NOT EXISTS `messages` (
  `msg_id` int(11) NOT NULL AUTO_INCREMENT,
  `msg_time` time NOT NULL,
  `msg_date` date NOT NULL,
  `to_user` varchar(15) NOT NULL,
  `from_user` varchar(15) NOT NULL,
  `read_status` int(11) NOT NULL,
  `inbox_delete` int(11) NOT NULL,
  `outbox_delete` int(11) NOT NULL,
  `msg` varchar(255) NOT NULL,
  PRIMARY KEY (`msg_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`msg_id`, `msg_time`, `msg_date`, `to_user`, `from_user`, `read_status`, `inbox_delete`, `outbox_delete`, `msg`) VALUES
(1, '00:00:00', '0000-00-00', '916191197v ', '926578935v', 0, 0, 0, 'Hiiii Dr'),
(2, '22:07:45', '2016-07-04', '924567784v', '916191197v', 0, 0, 0, 'fffffffffffffff'),
(3, '22:07:21', '2016-07-04', '923456674v', '916191197v', 0, 0, 0, 'Pissu nathnm shok'),
(4, '22:07:23', '2016-07-04', '923456674v', '916191197v', 0, 0, 0, 'Pissu nathnm shok'),
(5, '22:07:41', '2016-07-04', '923006678v', '916191197v', 0, 0, 0, 'Done'),
(6, '22:07:40', '2016-07-04', '934567783v', '916191197v', 0, 0, 0, 'Ane manda'),
(7, '22:07:40', '2016-07-04', '934511789v', '916191197v', 0, 0, 0, 'ekath hari'),
(8, '06:08:26', '2016-08-03', '934578896v', '916191197v', 0, 0, 0, 'hghhghhh'),
(9, '06:08:10', '2016-08-03', '934578896v', '916191197v', 0, 0, 0, 'hiii');

-- --------------------------------------------------------

--
-- Table structure for table `newsfeed`
--

CREATE TABLE IF NOT EXISTS `newsfeed` (
  `newsFeedID` int(11) NOT NULL AUTO_INCREMENT,
  `news` varchar(10000) NOT NULL,
  `attachment` varchar(10000) NOT NULL,
  `image` blob NOT NULL,
  `news_Owner` varchar(50) NOT NULL,
  `Date_Time` datetime NOT NULL,
  `electionID` int(11) NOT NULL,
  PRIMARY KEY (`newsFeedID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=37 ;

--
-- Dumping data for table `newsfeed`
--

INSERT INTO `newsfeed` (`newsFeedID`, `news`, `attachment`, `image`, `news_Owner`, `Date_Time`, `electionID`) VALUES
(7, 'abc', 'dilushika', '', '', '2016-06-16 22:55:07', 1111),
(8, 'abc', 'dscscccsccxczcc', '', 'D.S.Weerawardhana', '2016-06-16 22:58:55', 1111),
(9, 'abc', 'ghhjh', '', 'D.S.Weerawardhana', '2016-06-17 16:01:15', 1111),
(10, 'abc', 'sgsses', '', 'D.S.Weerawardhana', '2016-06-17 16:04:46', 1111),
(11, 'abc', 'FF', '', 'D.S.Weerawardhana', '2016-06-17 16:10:38', 1111),
(12, 'abc', 'EAE', '', 'D.S.Weerawardhana', '2016-06-17 16:10:47', 1111),
(13, 'abc', 'today', '', 'D.S.Weerawardhana', '2016-06-18 02:04:44', 1111),
(14, 'abc', 'today', '', 'D.S.Weerawardhana', '2016-06-18 02:13:27', 1111),
(15, 'abc', 'university of colombo scool of computing', '', 'D.S.Weerawardhana', '2016-06-29 05:07:47', 1111),
(16, 'abc', 'hkdsncjnncncmk', '', 'D.S.Weerawardhana', '2016-06-29 06:00:03', 1111),
(17, 'abc', 'jds,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,', '', 'D.S.Weerawardhana', '2016-06-29 06:00:38', 1111),
(18, 'abc', 'jds,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,', '', 'D.S.Weerawardhana', '2016-06-29 06:02:55', 1111),
(19, 'abc', 'kkkk', '', 'D.S.Weerawardhana', '2016-06-29 06:03:13', 1111),
(20, 'abc', 'fhg', '', 'D.S.Weerawardhana', '2016-06-29 06:06:20', 1111),
(21, 'abc', 'hkdsncjnncncmk', '', 'D.S.Weerawardhana', '2016-06-29 02:03:44', 1111),
(22, 'abc', 'jjjfkfkf', '', 'D.S.Weerawardhana', '2016-06-29 02:33:36', 1111),
(23, 'abc', 'jjjfkfkf', '', 'D.S.Weerawardhana', '2016-06-29 02:46:32', 1111),
(24, 'abc', 'dilusshuifijfisifia', '', 'D.S.Weerawardhana', '2016-06-30 09:12:45', 1111),
(25, 'abc', 'dilusshuifijfisifia', '', 'D.S.Weerawardhana', '2016-06-30 09:15:58', 1111),
(26, 'abc', 'dilusshuifijfisifia', '', 'D.S.Weerawardhana', '2016-06-30 09:17:05', 1111),
(27, 'abc', 'dilusshuifijfisifia', '', 'D.S.Weerawardhana', '2016-06-30 09:17:25', 1111),
(28, 'abc', 'dilusshuifijfisifia', '', 'D.S.Weerawardhana', '2016-06-30 09:17:49', 1111),
(29, 'abc', 'dilusshuifijfisifia', '', 'D.S.Weerawardhana', '2016-06-30 09:18:05', 1111),
(30, 'abc', 'dilusshuifijfisifia', '', 'D.S.Weerawardhana', '2016-06-30 09:19:41', 1111),
(31, 'abc', 'bvvhfgdg', '', 'D.S.Weerawardhana', '2016-06-30 09:23:14', 1111),
(32, 'abc', 'bvvhfgdg', '', 'D.S.Weerawardhana', '2016-06-30 09:25:01', 1111),
(33, 'abc', 'hhhhhhhhhhhhhhhhhhhhhhhhhhh', '', 'D.S.Weerawardhana', '2016-06-30 09:32:54', 1111),
(34, 'abc', 'ggggggggggggggg', '', 'D.S.Weerawardhana', '2016-06-30 09:33:22', 1111),
(35, 'abc', 'fffffffffffffffff', '', 'D.S.Weerawardhana', '2016-06-30 09:33:37', 1111),
(36, 'abc', 'Hii Every one. Today we have Pre Final Presentation', '', 'D.S.Weerawardhana', '2016-06-30 11:00:36', 1111);

-- --------------------------------------------------------

--
-- Table structure for table `securitypin`
--

CREATE TABLE IF NOT EXISTS `securitypin` (
  `memberID` int(11) NOT NULL,
  `pin` varchar(255) NOT NULL,
  PRIMARY KEY (`memberID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `securitypin`
--

INSERT INTO `securitypin` (`memberID`, `pin`) VALUES
(11, ' '),
(12, ' '),
(3456, ' '),
(12345, ' '),
(44444, ' '),
(122222, ' '),
(123467, ' '),
(99999999, ' '),
(1234567890, ' ');

-- --------------------------------------------------------

--
-- Table structure for table `securityquestionanswer`
--

CREATE TABLE IF NOT EXISTS `securityquestionanswer` (
  `SecQueID` int(11) NOT NULL,
  `memberID` int(11) NOT NULL,
  `answer` varchar(255) NOT NULL,
  PRIMARY KEY (`SecQueID`,`memberID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `securityquestionanswer`
--

INSERT INTO `securityquestionanswer` (`SecQueID`, `memberID`, `answer`) VALUES
(1, 0, 'cccccccc'),
(1, 1, 'Vihara Maha Devi'),
(1, 3, 'dddddddddddd'),
(1, 5, 'aaaaaa'),
(1, 20, 'ooooooo'),
(1, 22, 'uuuuuuuuu'),
(1, 23, 'ttttttt'),
(1, 25, 'hhhh'),
(1, 28, 'dsffregrg'),
(1, 29, 'jjkkkkk'),
(1, 30, 'mmmmmmmm'),
(1, 35, 'ddddd'),
(1, 36, 'dddcccc'),
(1, 37, 'dddddd'),
(1, 39, 'Rajarata'),
(1, 40, 'dddd'),
(1, 12345, 'nnnnnnnnnn'),
(1, 45678, 'rtthhhh'),
(1, 54321, 'xxxxxx'),
(1, 122222, 'wwwwwwwwww'),
(1, 123467, 'hhhhh'),
(1, 1234567890, 'ddddd'),
(2, 0, 'ccccccccc'),
(2, 1, 'Colombo'),
(2, 3, 'dddddddddddd'),
(2, 5, 'ssssss'),
(2, 20, 'ooooooooooo'),
(2, 25, ''),
(2, 28, ''),
(2, 29, ''),
(2, 30, ''),
(2, 32, 'uhhhhhhhhhhhhhhhhhhhhhhhhh'),
(2, 35, ''),
(2, 37, ''),
(2, 38, 'Galle'),
(2, 40, 'hnjnn l l'),
(2, 12345, 'nnnnnnnnnn'),
(2, 45678, 'gbgbryt'),
(2, 54321, 'xxxxxxxxxx'),
(2, 122222, 'wwwwwww'),
(2, 123467, 'hhhhhhhh'),
(2, 1234567890, 'dddddddd'),
(3, 0, 'ccccccccc'),
(3, 1, '04:21'),
(3, 3, 'dddddddddddddd'),
(3, 5, 'sssssss'),
(3, 10, '06:09'),
(3, 11, '06:09'),
(3, 20, 'kkkkkkkkkkkk'),
(3, 25, ''),
(3, 28, ''),
(3, 29, ''),
(3, 30, ''),
(3, 35, ''),
(3, 37, ''),
(3, 38, ''),
(3, 40, ''),
(3, 12345, 'nnnnnnnnnn'),
(3, 45678, 'rthhyh'),
(3, 54321, 'xxxxxxxxxxxxxx'),
(3, 122222, 'wwwwwwwwwwwww'),
(3, 123467, 'hhhhhhhhhhhh'),
(3, 1234567890, 'dddddddddddddd'),
(4, 8, '0718759697'),
(4, 9, '0722507422'),
(4, 26, 'gggggggg'),
(4, 40, ''),
(5, 2, 'Mac '),
(5, 4, 'galle face'),
(5, 13, 'Sea'),
(5, 18, 'uuuuuuu'),
(5, 22, 'nnnnnnnnnn'),
(5, 23, 'gggggggggg'),
(5, 26, 'ffffff'),
(5, 32, ''),
(5, 38, ''),
(5, 40, ''),
(6, 4, 'Winkey'),
(6, 13, 'Tuffy'),
(6, 26, ''),
(6, 34, 'fg g  g gggg'),
(6, 36, ''),
(6, 40, 'yuondnd'),
(7, 4, 'badulla'),
(7, 7, 'Haliela'),
(7, 9, 'Badulla'),
(7, 13, 'Kaduwela'),
(7, 16, 'Negambo'),
(7, 33, 'iiii'),
(7, 38, 'mknoln'),
(8, 2, 'Run'),
(8, 7, '3idiots'),
(8, 10, 'Dhoom'),
(8, 11, 'Dhoom'),
(8, 18, 'uuuuuuuuu'),
(8, 21, 'tttttttt'),
(8, 23, 'vvvvvvvvvvv'),
(8, 32, 'hhhh'),
(8, 33, ''),
(8, 38, ''),
(9, 3, 'jayathilake'),
(9, 21, 'yyyyyyyyyy'),
(9, 33, ''),
(9, 38, ''),
(9, 40, 'gggggggggg'),
(10, 3, 'lanzer'),
(10, 16, 'Hybrid'),
(10, 21, 'uuuuuuuuuuuuu'),
(10, 22, 'mmmmmmmmm'),
(10, 31, 'hhhhhhhhh'),
(10, 36, ''),
(10, 39, 'dedddd'),
(10, 40, 'uuuuuuuuu'),
(11, 3, 'purpule'),
(11, 6, 'pink'),
(11, 7, 'white'),
(11, 8, 'black'),
(11, 10, 'Yellow'),
(11, 11, 'Green'),
(11, 12, 'Ash'),
(11, 16, 'Red'),
(11, 17, 'Blue'),
(11, 18, 'uuuuuuuuuu'),
(11, 31, ''),
(11, 34, ''),
(11, 39, 'vvvvv'),
(12, 17, 'Weerasinghe'),
(12, 31, ''),
(12, 34, ''),
(13, 2, 'Chamari'),
(13, 14, 'Janaki'),
(13, 15, 'Manel'),
(13, 24, ''),
(13, 27, 'jukkyu'),
(14, 6, 'Chrome'),
(14, 8, 'chrome'),
(14, 9, 'Chrome'),
(14, 12, 'Mozilla'),
(14, 14, 'Explore'),
(14, 15, 'Chrome'),
(14, 17, 'Chrome'),
(14, 24, ''),
(14, 27, ''),
(15, 6, 'Dad'),
(15, 12, 'Mom'),
(15, 14, 'Father'),
(15, 15, 'Mother'),
(15, 24, ''),
(15, 27, 'op');

-- --------------------------------------------------------

--
-- Table structure for table `securityquestions`
--

CREATE TABLE IF NOT EXISTS `securityquestions` (
  `q_id` int(11) NOT NULL AUTO_INCREMENT,
  `question` varchar(255) NOT NULL,
  PRIMARY KEY (`q_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=16 ;

--
-- Dumping data for table `securityquestions`
--

INSERT INTO `securityquestions` (`q_id`, `question`) VALUES
(1, 'What was the name of your primary school?'),
(2, 'In what city or town does your nearest sibling live?'),
(3, 'What time of the day were you born? (hh:mm)'),
(4, 'Which phone number do you remember most from your childhood?'),
(5, 'What was your favorite place to visit as a child?'),
(6, 'What is the name of your favorite pet?'),
(7, 'In what city were you born?'),
(8, 'What is your favorite movie?'),
(9, 'What street did you grow up on?'),
(10, 'What was the make of your first car?'),
(11, 'What is your favorite color?'),
(12, 'What is your father''s middle name?'),
(13, 'What is the name of your first grade teacher?'),
(14, 'Which is your favorite web browser?'),
(15, 'Who was your childhood hero?');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
