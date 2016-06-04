-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jun 04, 2016 at 06:34 AM
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
  `memberID` int(11) NOT NULL,
  `electionID` int(11) NOT NULL,
  `candidateNo` int(11) NOT NULL,
  `symbolImage` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `clubmember`
--

CREATE TABLE `clubmember` (
  `memberID` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `NIC` varchar(10) NOT NULL,
  `dateOfBirth` date NOT NULL,
  `email` varchar(50) NOT NULL,
  `homeAddress` varchar(100) NOT NULL,
  `mobileNumber` varchar(20) NOT NULL,
  `occupation` varchar(50) NOT NULL,
  `clubPost` varchar(50) NOT NULL,
  `profileImage` varchar(100) NOT NULL,
  `status` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
  `noOfUsedVotes` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `memberelectiondetails`
--

CREATE TABLE `memberelectiondetails` (
  `memberID` int(11) NOT NULL,
  `electionID` int(11) NOT NULL,
  `votingStatus` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
-- AUTO_INCREMENT for table `clubmember`
--
ALTER TABLE `clubmember`
  MODIFY `memberID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `election`
--
ALTER TABLE `election`
  MODIFY `electionID` int(11) NOT NULL AUTO_INCREMENT;
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
