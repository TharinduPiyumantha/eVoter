-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jun 24, 2016 at 02:03 AM
-- Server version: 10.1.9-MariaDB
-- PHP Version: 5.6.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `evoter`
--

-- --------------------------------------------------------

--
-- Table structure for table `ballotpaper`
--

CREATE TABLE `ballotpaper` (
  `ballotID` int(11) NOT NULL,
  `securityPIN` int(11) NOT NULL,
  `vote` int(11) NOT NULL,
  `electionID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `campaignpost`
--

CREATE TABLE `campaignpost` (
  `psotID` int(11) NOT NULL,
  `description` varchar(10000) NOT NULL,
  `attachment` varchar(200) NOT NULL,
  `memberID` int(11) NOT NULL,
  `electionID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `candidate`
--

CREATE TABLE `candidate` (
  `electionID` int(11) NOT NULL,
  `memberID` int(11) NOT NULL,
  `candidateNo` int(11) NOT NULL,
  `symbolImage` varchar(100) NOT NULL,
  `result` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `candidate`
--

INSERT INTO `candidate` (`electionID`, `memberID`, `candidateNo`, `symbolImage`, `result`) VALUES
(0, 0, 0, '', NULL),
(14, 2, 34, 'aaaaaaaaaaaaaaa', NULL),
(15, 2, 34, 'aaaaaaaaaaaaaaa', NULL),
(16, 2, 12, 'aaaaaaaaaaaaaaa', NULL),
(18, 2, 23, 'aaaaaaaaaaaaaaa', NULL),
(19, 2, 34, 'aaaaaaaaaaaaaaa', NULL),
(20, 2, 23, 'aaaaaaaaaaaaaaa', NULL),
(22, 2, 345, 'aaaaaaaaaaaaaaa', NULL),
(29, 2, 345, 'aaaaaaaaaaaaaaa', NULL),
(30, 2, 2345, 'aaaaaaaaaaaaaaa', NULL),
(11, 3, 21, 'aaaaaaaaaaaaaaa', NULL),
(12, 3, 23, 'aaaaaaaaaaaaaaa', NULL),
(13, 3, 20, 'aaaaaaaaaaaaaaa', NULL),
(14, 3, 78, 'aaaaaaaaaaaaaaa', NULL),
(15, 3, 21, 'aaaaaaaaaaaaaaa', NULL),
(16, 3, 13, 'aaaaaaaaaaaaaaa', NULL),
(18, 3, 12, 'aaaaaaaaaaaaaaa', NULL),
(20, 3, 45, 'aaaaaaaaaaaaaaa', NULL),
(22, 3, 231, 'aaaaaaaaaaaaaaa', NULL),
(23, 3, 21, 'aaaaaaaaaaaaaaa', NULL),
(29, 3, 90, 'aaaaaaaaaaaaaaa', NULL),
(30, 3, 2134, 'aaaaaaaaaaaaaaa', NULL),
(15, 4, 25, 'aaaaaaaaaaaaaaa', NULL),
(16, 4, 14, 'aaaaaaaaaaaaaaa', NULL),
(26, 1111, 53, 'aaaaaaaaaaaaaaa', NULL),
(25, 1234, 50, 'aaaaaaaaaaaaaaa', NULL),
(26, 1234, 52, 'aaaaaaaaaaaaaaa', NULL),
(27, 2134, 23, 'aaaaaaaaaaaaaaa', NULL),
(27, 3421, 23, 'aaaaaaaaaaaaaaa', NULL),
(25, 5678, 51, 'aaaaaaaaaaaaaaa', NULL),
(28, 21345, 23, 'aaaaaaaaaaaaaaa', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `clubmember`
--

CREATE TABLE `clubmember` (
  `memberID` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `NIC` varchar(10) NOT NULL,
  `email` varchar(50) NOT NULL,
  `mobileNumber` varchar(20) NOT NULL,
  `clubPost` varchar(50) NOT NULL,
  `profileImage` varchar(100) NOT NULL,
  `status` varchar(50) NOT NULL,
  `dateofjoin` date NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `clubmember`
--

INSERT INTO `clubmember` (`memberID`, `name`, `NIC`, `email`, `mobileNumber`, `clubPost`, `profileImage`, `status`, `dateofjoin`, `username`, `password`) VALUES
(2, 'shalika fernando', '927744082v', 'fshalika.fdo@gmail.com', '+94711877531', '', '', 'candidate', '0000-00-00', '', ''),
(3, 'ayeshan peiris', '907744082v', 'ayeshan@gmail.com', '+94714482511', '', '', 'candidate', '0000-00-00', '', ''),
(4, 'tharindu piyumantha', '927787697v', 'fshalika.fdo@gmail.com', '+94711877531', 'Gold Member', '', 'not-registered', '2016-06-03', '', ''),
(5, 'dilini', '917788098v', 'fshalika.fdo@gmail.com', '+94711877531', 'member', '', 'registered', '2016-06-04', '', ''),
(6, 'darshana', '927765843v', 'fshalika.fdo@gmail.com', '+94711877531', '', '', 'not-registered', '2016-02-04', '', ''),
(7, 'nilanka', '927733876v', 'fshalika.fdo@gmail.com', '+94711877531', '', '', 'not-registered', '2015-06-10', '', ''),
(8, 'shashini peiris', '989934652v', 'shashini@gmail.com', '+94711877531', '', '', 'registered', '0000-00-00', '', ''),
(9, 'kamal ', '9899923v', 'fshalika.fdo@gmail.com', '+94714992779', '', '', 'registered', '0000-00-00', '', ''),
(10, 'kamal ', '9899923v', 'fshalika.fdo@gmail.com', '+94714992779', '', '', 'not-registered', '0000-00-00', '', ''),
(11, 'amal', '', 'fshalika.fdo@gmail.com', '+94714992779', '', '', 'registered', '0000-00-00', '', ''),
(12, 'amal', '', 'fshalika.fdo@gmail.com', '+94714992779', '', '', 'not-registered', '0000-00-00', '', ''),
(13, 'ayyoob', '', 'fshalika.fdo@gmail.com', '+94714992779', '', '', 'registered', '0000-00-00', '', ''),
(14, 'ayyoob', '', 'fshalika.fdo@gmail.com', '+94714992779', '', '', 'not-registered', '0000-00-00', '', ''),
(15, 'nishadi', '', 'fshalika.fdo@gmail.com', '+94714992779', '', '', 'registered', '0000-00-00', '', ''),
(16, 'nishadi', '', 'fshalika.fdo@gmail.com', '+94714992779', '', '', 'registered', '0000-00-00', '', ''),
(17, 'pumudinie', '', 'fshalika.fdo@gmail.com', '+94711877531', '', '', 'registered', '2016-06-01', '', ''),
(18, 'ruvini', '', 'fshalika.fdo@gmail.com', '+94711877531', '', '', 'registered', '0000-00-00', '', ''),
(19, 'shavindi', '', 'fshalika.fdo@gmail.com', '+94711877531', '', '', 'not-registered', '2016-06-04', '', ''),
(20, 'shavindi', '', 'fshalika.fdo@gmail.com', '+94711877531', '', '', 'registered', '2016-06-04', '', ''),
(23456, 'Dilini', '916191197v', 'dweerasinghe91@gmail.com', '0718759697', 'Secretary', '#', 'registered', '2016-06-03', 'dilini', '123456');

-- --------------------------------------------------------

--
-- Table structure for table `election`
--

CREATE TABLE `election` (
  `electionID` int(11) NOT NULL,
  `electionName` varchar(50) NOT NULL,
  `date` date NOT NULL,
  `startTime` time NOT NULL,
  `endTime` time NOT NULL,
  `noOfVotesPerPerson` int(11) NOT NULL,
  `noOfVoters` int(11) NOT NULL,
  `noOfUsedVotes` int(11) DEFAULT NULL,
  `electionStatus` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `election`
--

INSERT INTO `election` (`electionID`, `electionName`, `date`, `startTime`, `endTime`, `noOfVotesPerPerson`, `noOfVoters`, `noOfUsedVotes`, `electionStatus`) VALUES
(23, 'shalika 1', '2016-06-25', '09:00:00', '21:00:00', 2, 0, NULL, 'scheduled'),
(24, 'sjhhhh', '2016-06-25', '09:00:00', '21:00:00', 3, 0, NULL, 'scheduled'),
(25, 'presidential', '2016-06-11', '10:00:00', '11:00:00', 2, 0, NULL, 'scheduled'),
(26, 'Name', '2016-06-18', '10:00:00', '12:00:00', 2, 0, NULL, 'scheduled'),
(27, 'Thursday Eve', '2016-06-25', '09:00:00', '21:00:00', 2, 0, NULL, 'scheduled'),
(28, 'Thursday Night', '2016-06-23', '09:00:00', '21:00:00', 2, 0, NULL, 'scheduled'),
(29, 'shalika 99', '2016-06-25', '09:00:00', '21:00:00', 23, 0, NULL, 'scheduled'),
(30, 'friday morning', '2016-06-25', '07:00:00', '19:00:00', 8, 0, NULL, 'scheduled');

-- --------------------------------------------------------

--
-- Table structure for table `memberelectiondetails`
--

CREATE TABLE `memberelectiondetails` (
  `memberID` int(11) NOT NULL,
  `electionID` int(11) NOT NULL,
  `votingStatus` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `memberelectiondetails`
--

INSERT INTO `memberelectiondetails` (`memberID`, `electionID`, `votingStatus`) VALUES
(2, 13, 'To Be Voting'),
(2, 15, 'to be voting'),
(2, 18, 'to be voting'),
(2, 19, 'To Be Voting'),
(3, 18, 'to be voting'),
(4, 11, 'To Be Voting'),
(4, 12, 'To Be Voting'),
(5, 11, 'To Be Voting'),
(5, 16, 'to be voting'),
(5, 20, 'to be voting'),
(5, 22, 'to be voting'),
(5, 23, 'to be voting'),
(5, 26, 'to be voting'),
(5, 28, 'to be voting'),
(5, 30, 'to be voting'),
(6, 11, 'To Be Voting'),
(8, 22, 'to be voting'),
(8, 30, 'to be voting'),
(9, 23, 'to be voting'),
(9, 30, 'to be voting'),
(11, 30, 'to be voting'),
(13, 23, 'to be voting'),
(13, 30, 'to be voting'),
(15, 30, 'to be voting'),
(16, 23, 'to be voting'),
(16, 30, 'to be voting'),
(17, 28, 'to be voting'),
(17, 30, 'to be voting'),
(18, 30, 'to be voting'),
(20, 28, 'to be voting'),
(20, 29, 'to be voting'),
(20, 30, 'to be voting'),
(23456, 25, 'to be voting'),
(23456, 26, 'to be voting');

-- --------------------------------------------------------

--
-- Table structure for table `newsfeed`
--

CREATE TABLE `newsfeed` (
  `newsFeedID` int(11) NOT NULL,
  `news` varchar(10000) NOT NULL,
  `attachment` varchar(10000) NOT NULL,
  `electionID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `securityquestion`
--

CREATE TABLE `securityquestion` (
  `SecQueID` int(11) NOT NULL,
  `question` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `securityquestionanswer`
--

CREATE TABLE `securityquestionanswer` (
  `SecQueID` int(11) NOT NULL,
  `memberID` int(11) NOT NULL,
  `answer` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `ballotpaper`
--
ALTER TABLE `ballotpaper`
  ADD PRIMARY KEY (`ballotID`);

--
-- Indexes for table `campaignpost`
--
ALTER TABLE `campaignpost`
  ADD PRIMARY KEY (`psotID`);

--
-- Indexes for table `candidate`
--
ALTER TABLE `candidate`
  ADD PRIMARY KEY (`memberID`,`electionID`);

--
-- Indexes for table `clubmember`
--
ALTER TABLE `clubmember`
  ADD PRIMARY KEY (`memberID`);

--
-- Indexes for table `election`
--
ALTER TABLE `election`
  ADD PRIMARY KEY (`electionID`);

--
-- Indexes for table `memberelectiondetails`
--
ALTER TABLE `memberelectiondetails`
  ADD PRIMARY KEY (`memberID`,`electionID`);

--
-- Indexes for table `newsfeed`
--
ALTER TABLE `newsfeed`
  ADD PRIMARY KEY (`newsFeedID`);

--
-- Indexes for table `securityquestion`
--
ALTER TABLE `securityquestion`
  ADD PRIMARY KEY (`SecQueID`);

--
-- Indexes for table `securityquestionanswer`
--
ALTER TABLE `securityquestionanswer`
  ADD PRIMARY KEY (`SecQueID`,`memberID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `ballotpaper`
--
ALTER TABLE `ballotpaper`
  MODIFY `ballotID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `campaignpost`
--
ALTER TABLE `campaignpost`
  MODIFY `psotID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `election`
--
ALTER TABLE `election`
  MODIFY `electionID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;
--
-- AUTO_INCREMENT for table `newsfeed`
--
ALTER TABLE `newsfeed`
  MODIFY `newsFeedID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `securityquestion`
--
ALTER TABLE `securityquestion`
  MODIFY `SecQueID` int(11) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
