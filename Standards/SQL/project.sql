-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Aug 16, 2015 at 01:50 PM
-- Server version: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `project`
--

-- --------------------------------------------------------

--
-- Table structure for table `actions`
--

CREATE TABLE IF NOT EXISTS `actions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `relation` char(1) NOT NULL,
  `type` varchar(3) NOT NULL,
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `author` varchar(50) NOT NULL,
  `comment` varchar(1000) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=29 ;

-- --------------------------------------------------------

--
-- Table structure for table `batches`
--

CREATE TABLE IF NOT EXISTS `batches` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

-- --------------------------------------------------------

--
-- Table structure for table `batch_action_map`
--

CREATE TABLE IF NOT EXISTS `batch_action_map` (
  `batchid` int(11) NOT NULL,
  `actionid` int(11) NOT NULL,
  KEY `actionid` (`actionid`),
  KEY `batchid` (`batchid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `empdetail`
--

CREATE TABLE IF NOT EXISTS `empdetail` (
  `empno` int(6) NOT NULL,
  `epfno` int(6) NOT NULL,
  `company` varchar(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `nic` varchar(10) NOT NULL,
  `designation` varchar(100) NOT NULL,
  `roles` varchar(10) NOT NULL,
  `department` varchar(10) NOT NULL,
  PRIMARY KEY (`empno`),
  KEY `EmpNo` (`empno`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `empdetail`
--

INSERT INTO `empdetail` (`empno`, `epfno`, `company`, `name`, `gender`, `nic`, `designation`, `roles`, `department`) VALUES
(98, 99, 'LOMC', 'M.D.K Jayawardana', 'Male', '875489261V', 'Trainee Marketing Officer - Islamic Business Unit', 'EM', 'SD'),
(120, 121, 'LTEC', 'D.A.M Silva', 'Male', '992123348V', 'Customer', 'FD-MBT', 'SD'),
(130, 131, 'LOLC FAC', 'G.K Suraj', 'Male', '911256325V', 'Manager - Portfolio Development', 'FD-RSG', 'SD'),
(150, 151, 'LTEC', 'T.P Sanjaya', 'Male', '954312321V', 'Officer In Charge', 'FD-FST', 'SD'),
(300, 301, 'LOMC', 'C.D Bandara', 'Male', '923212458V', 'Assistant Manager', 'FD-LNE', 'SD'),
(305, 702, 'LOITS', 'R.M Amarasinghe', 'Male', '921223458V', 'junior manager', 'EM', 'SD'),
(320, 700, 'LOFIN', 'L.K Anura Kumara', 'male', '123122321V', 'Senior Manager', 'HH', 'SD'),
(343, 344, 'LOLC', 'P.V.C Chandimal', 'Male', '322526351V', 'Documentation Assistant', 'EM', 'SD'),
(350, 351, 'LOLC', 'F.B Samantha', 'Male', '988759234V', 'Senior Marketing Officer - FD & Savings', 'EM', 'SD'),
(500, 501, 'LOLC', 'P.K sewwandi', 'Female', '32987223V', 'Branch Assistant', 'PO', 'SD'),
(505, 506, 'LOMC', 'D.M perera', 'male', '453245346V', 'Marketing Executive', 'FD-DLG', 'SD'),
(569, 570, 'LOLC', 'S.E Lahiru', 'Male', '216598785V', 'Documentation Assistant', 'PO', 'SD'),
(590, 591, 'LOLC', 'O.P Opatha', 'Male', '786545561V', 'Marketing Officer', 'FD-RMT', 'SD'),
(600, 601, 'LOSEC', 'S.D Fernando', 'Female', '349098877V', 'Officer In Charge', 'FD-DLG', 'SD'),
(656, 657, 'LOLC', 'D.V Gunarathna', 'Female', '879865984V', 'Trainee Marketing Officer', 'FD-LNS', 'SD'),
(666, 667, 'LOFIN', 'R.D.N Ranapthi', 'Male', '983121235V', 'Senior Marketing Executive - FD & Savings', 'PO', 'SD'),
(755, 756, 'LOLC Insurance Company Ltd', 'G.B Dias', 'Male', '875984651V', 'Branch Head', 'PO', 'SD'),
(800, 801, 'UDE', 'L.B Herath', 'Female', '223354312V', 'Marketing Executive - FD & Savings', 'HP-LOLC', 'SD'),
(880, 881, 'LOSEC', 'J.B Bandara', 'Male', '78986545V', 'Senior Marketing Officer', 'FD-NPY', 'SD'),
(882, 883, 'LOITS', 'P.C Vishaka', 'Female', '412659484X', 'Officer In Charge', 'EM', 'SD'),
(900, 901, 'UDE', 'T.R Hettiarachi', 'Female', '902321195V', 'Public Relational Officer', 'HH', 'SD'),
(920, 921, 'LOLC', 'S.L Malsha', 'Female', '875948652V', 'Public Relations Assistant', 'PO', 'SD'),
(1000, 1001, 'LOMC', 'G.N Anuradha', 'Male', '894321231V', 'Officer', 'HP-LOMC', 'SD'),
(1001, 1002, 'LOMC', 'K.L Rathnayaka', 'Female', '455689781V', 'Senior Marketing Officer', 'FD-OVT', 'SD'),
(2000, 212, 'LOITS', 'Mr. Lahiru Jayakody', 'Male', '923170688V', 'Project Manager', 'EM', 'SD');

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

CREATE TABLE IF NOT EXISTS `items` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `itemtype` varchar(3) NOT NULL,
  `empno` int(11) NOT NULL,
  `epfno` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `company` varchar(10) NOT NULL,
  `department` varchar(10) DEFAULT NULL,
  `corporatetitle` varchar(15) NOT NULL,
  `amount` float DEFAULT NULL,
  `int_1` int(11) DEFAULT NULL,
  `date1` date DEFAULT NULL,
  `date2` date DEFAULT NULL,
  `varchar1` varchar(100) DEFAULT NULL,
  `varchar2` varchar(30) DEFAULT NULL,
  `varchar3` varchar(30) DEFAULT NULL,
  `varchar4` varchar(30) DEFAULT NULL,
  `floate_1` float DEFAULT NULL,
  `floate_2` float DEFAULT NULL,
  `floate_3` float DEFAULT NULL,
  `floate_4` float DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=27 ;

-- --------------------------------------------------------

--
-- Table structure for table `item_action_map`
--

CREATE TABLE IF NOT EXISTS `item_action_map` (
  `itemid` int(11) NOT NULL,
  `actionid` int(11) NOT NULL,
  KEY `itemid` (`itemid`),
  KEY `actionid` (`actionid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `item_batch_map`
--

CREATE TABLE IF NOT EXISTS `item_batch_map` (
  `itemid` int(11) NOT NULL,
  `batchid` int(11) NOT NULL,
  KEY `itemid` (`itemid`),
  KEY `batchid` (`batchid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `batch_action_map`
--
ALTER TABLE `batch_action_map`
  ADD CONSTRAINT `batch_action_map_ibfk_1` FOREIGN KEY (`batchid`) REFERENCES `batches` (`id`),
  ADD CONSTRAINT `batch_action_map_ibfk_2` FOREIGN KEY (`actionid`) REFERENCES `actions` (`id`);

--
-- Constraints for table `item_action_map`
--
ALTER TABLE `item_action_map`
  ADD CONSTRAINT `item_action_map_ibfk_2` FOREIGN KEY (`actionid`) REFERENCES `actions` (`id`),
  ADD CONSTRAINT `item_action_map_ibfk_3` FOREIGN KEY (`itemid`) REFERENCES `items` (`id`);

--
-- Constraints for table `item_batch_map`
--
ALTER TABLE `item_batch_map`
  ADD CONSTRAINT `item_batch_map_ibfk_2` FOREIGN KEY (`batchid`) REFERENCES `batches` (`id`),
  ADD CONSTRAINT `item_batch_map_ibfk_3` FOREIGN KEY (`itemid`) REFERENCES `items` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
