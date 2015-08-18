-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Aug 09, 2015 at 10:56 PM
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
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `type` varchar(10) NOT NULL,
  `date` varchar(50) NOT NULL,
  `author` int(11) NOT NULL,
  `comment` varchar(200) NOT NULL,
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `actions`
--

INSERT INTO `actions` (`id`, `type`, `date`, `author`, `comment`) VALUES
(1, 'CRE', '2015/08/01', 2000, 'This is the new sample of DLG item json'),
(2, 'CRE', '2015/8/10', 1001, ''),
(3, 'CRE', '2015/8/10', 1001, '');

-- --------------------------------------------------------

--
-- Table structure for table `batches`
--

CREATE TABLE IF NOT EXISTS `batches` (
  `batchid` int(11) NOT NULL AUTO_INCREMENT,
  `items` varchar(100) DEFAULT NULL,
  `actions` varchar(20) NOT NULL,
  PRIMARY KEY (`batchid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `batches`
--

INSERT INTO `batches` (`batchid`, `items`, `actions`) VALUES
(1, '', 'CRE-2;'),
(2, '', 'CRE-4;'),
(3, 'DLG1238;DLG1239;DLG1240;DLG1241;DLG1242;DLG1243;DLG1244;DLG1245;DLG1246;DLG1247;DLG1248;DLG1249;DLG1', 'CRE-6;'),
(4, 'MBT1;MBT2;MBT3;', 'CRE-2;');

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
  `pendingitems` varchar(200) NOT NULL,
  `roles` varchar(10) NOT NULL,
  PRIMARY KEY (`empno`),
  KEY `EmpNo` (`empno`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `empdetail`
--

INSERT INTO `empdetail` (`empno`, `epfno`, `company`, `name`, `gender`, `nic`, `designation`, `pendingitems`, `roles`) VALUES
(1000, 2011, 'LOMC', 'Mr. Test Unit', 'Male', '812450547V', 'Customer', 'DLG1238;DLG1241;DLG1247;DLG1248;DLG1250;MBT1;', 'EM'),
(1001, 7865, 'LOMC', 'F_MBT', 'M', '8976898656', 'Kotte', 'No', 'FD-MBT'),
(1002, 765, 'LOMC', 'F_RMT', 'M', '87654V', 'Kotte', 'No', 'FD-RMT'),
(1005, 876, 'LOMC', 'F_NPY', 'M', '7890678B', 'Borrella', 'NO', 'FD-NPY'),
(1006, 789, 'LOMC', 'F_OVT', 'M', '89765234V', 'Colombo 8', 'No', 'FD-OVT'),
(1007, 866, 'LOMC', 'F_RSG', 'M', '88789678V', 'Colombo 2\r\n\r\n', 'No', 'FD-RSG'),
(2000, 212, 'LOITS', 'Mr. Lahiru Jayakody', 'Male', '923170688V', 'Project Manager', 'DLG118;DLG1239;DLG1242;DLG1246;DLG1249;', 'EM'),
(4171, 125, 'LOLC', 'Mr. Malitha Karunanayake', 'Male', '91211223', '', 'DLG1240;DLG1243;DLG1244;DLG1245;DLG1251;', ''),
(4567, 675, 'LOMC', 'F_FST', 'Male', '897056789V', 'Moratuwa', 'Pending', 'FD-FST'),
(4568, 876, 'LOLC', 'F_LNE', 'Male', '641018978V', 'Maharagama', 'No', 'FD-LNE'),
(4569, 7654, 'LOMC', 'F_LNS', 'M', '897654321V', 'Kandy', 'No', 'FD-LNS'),
(4590, 876, 'Panadura', 'F_MDC', 'M', '8765431243', 'Kandy', 'No', 'FD-MDC'),
(7777, 789, 'LOMC', 'shene', 'male', '921567860V', 'Moratuwa', 'no', 'FD-FST');

-- --------------------------------------------------------

--
-- Table structure for table `itemdlg`
--

CREATE TABLE IF NOT EXISTS `itemdlg` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `empno` int(11) NOT NULL,
  `epfno` int(11) NOT NULL,
  `name` varchar(80) NOT NULL,
  `company` varchar(50) NOT NULL,
  `department` varchar(50) NOT NULL,
  `corporatetitle` varchar(50) NOT NULL,
  `dialogdeductions` float NOT NULL,
  `actions` varchar(20) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `empno` (`empno`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1252 ;

--
-- Dumping data for table `itemdlg`
--

INSERT INTO `itemdlg` (`id`, `empno`, `epfno`, `name`, `company`, `department`, `corporatetitle`, `dialogdeductions`, `actions`) VALUES
(1234, 1000, 212, 'Mr Test Unit', 'LOMC', 'Finacial', 'Manager', 1234.45, 'CRE1210'),
(1238, 1000, 534, 'R.E.C.Start', 'LOMC', 'Finace', 'Employee', 1234.9, 'CRE-7;'),
(1239, 2000, 789, 'T.M.L.Ranga', 'LOLC', 'Loan', 'Employee', 456.9, 'CRE-7;'),
(1240, 4171, 123, 'N.M.P.Rathnayake', 'LOLC', 'Loan', 'Manager', 2345.8, 'CRE-7;'),
(1241, 1000, 154, 'JALP Jayakody', 'LOITS', 'SD', 'SD', 10.5, 'CRE-7;'),
(1242, 2000, 155, 'BMC Rathnayaka', 'LOITS', 'SD', 'SDM', 200.1, 'CRE-7;'),
(1243, 4171, 156, 'AMNB Rathnayaka', 'LOITS', 'SD', 'SDM', 10000, 'CRE-7;'),
(1244, 4171, 157, 'RDN Ranapathi', 'LOITS', 'SD', 'SDM', 500.5, 'CRE-7;'),
(1245, 4171, 534, 'R.M.P.Jayaweera', 'LOMC', 'Finace', 'Employee', 1234.9, 'CRE-7;'),
(1246, 2000, 789, 'T.M.L.Ranga', 'LOLC', 'Loan', 'Employee', 456.9, 'CRE-7;'),
(1247, 1000, 123, 'N.M.P.Rathnayake', 'LOLC', 'Loan', 'Manager', 2345.8, 'CRE-7;'),
(1248, 1000, 156, 'AMNB Rathnayaka', 'LOITS', 'SD', 'SDM', 10000, 'CRE-7;'),
(1249, 2000, 157, 'RDN Ranapathi', 'LOITS', 'SD', 'SDM', 500.5, 'CRE-7;'),
(1250, 1000, 534, 'R.M.P.Jayaweera', 'LOMC', 'Finace', 'Employee', 1234.9, 'CRE-7;'),
(1251, 4171, 789, 'R.E.C.End', 'LOLC', 'Loan', 'Employee', 456.9, 'CRE-7;');

-- --------------------------------------------------------

--
-- Table structure for table `itemfst`
--

CREATE TABLE IF NOT EXISTS `itemfst` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `empno` int(11) NOT NULL,
  `epfno` int(11) NOT NULL,
  `company` varchar(20) NOT NULL,
  `name` varchar(50) NOT NULL,
  `corparatetitle` varchar(20) NOT NULL,
  `department` varchar(20) NOT NULL,
  `amount` float NOT NULL,
  `actions` varchar(20) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `empno` (`empno`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `itemlne`
--

CREATE TABLE IF NOT EXISTS `itemlne` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `empno` int(11) NOT NULL,
  `epfno` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `company` varchar(20) NOT NULL,
  `nic` varchar(20) NOT NULL,
  `contractno` varchar(20) NOT NULL,
  `monthlyrental` float NOT NULL,
  `noofinstallment` int(11) NOT NULL,
  `date` varchar(20) NOT NULL,
  `actions` varchar(20) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `empno` (`empno`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `itemlns`
--

CREATE TABLE IF NOT EXISTS `itemlns` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `empno` int(11) NOT NULL,
  `epfno` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `company` varchar(20) NOT NULL,
  `nic` varchar(20) NOT NULL,
  `contractno` varchar(20) NOT NULL,
  `settledate` varchar(20) NOT NULL,
  `actions` varchar(20) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `empno` (`empno`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `itemmbt`
--

CREATE TABLE IF NOT EXISTS `itemmbt` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `empno` int(11) NOT NULL,
  `epfno` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `company` varchar(20) NOT NULL,
  `department` varchar(20) NOT NULL,
  `corporatetitle` varchar(20) NOT NULL,
  `mobiteldeduction` float NOT NULL,
  `actions` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `itemmbt`
--

INSERT INTO `itemmbt` (`id`, `empno`, `epfno`, `name`, `company`, `department`, `corporatetitle`, `mobiteldeduction`, `actions`) VALUES
(1, 1000, 678, 'Jayantha R.M.M', 'LOMC', 'Head office', 'Manager', 1234.89, 'CRE-3;'),
(2, 1234, 980, 'Shiran J.K', 'LOLC', 'Recovery', 'Feeder', 908.9, 'CRE-3;'),
(3, 1294, 567, 'Kumara N.N', 'LOLC', 'Loan', 'Employee', 789.9, 'CRE-3;');

-- --------------------------------------------------------

--
-- Table structure for table `itemnpy`
--

CREATE TABLE IF NOT EXISTS `itemnpy` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `empno` int(11) NOT NULL,
  `epfno` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `company` varchar(20) NOT NULL,
  `department` varchar(20) NOT NULL,
  `corperatetitle` varchar(20) NOT NULL,
  `nunberofdays` int(11) NOT NULL,
  `actions` varchar(20) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`),
  UNIQUE KEY `empno` (`empno`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `itemovt`
--

CREATE TABLE IF NOT EXISTS `itemovt` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `empno` int(11) NOT NULL,
  `epfno` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `company` varchar(20) NOT NULL,
  `department` varchar(20) NOT NULL,
  `branch` varchar(20) NOT NULL,
  `corperatetitle` varchar(20) NOT NULL,
  `normalot` float NOT NULL,
  `doubleot` float NOT NULL,
  `tribleot` float NOT NULL,
  `totalot` float NOT NULL,
  `actions` varchar(20) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `empno` (`empno`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `itemrmt`
--

CREATE TABLE IF NOT EXISTS `itemrmt` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `empno` int(11) NOT NULL,
  `epfno` int(11) NOT NULL,
  `company` varchar(20) NOT NULL,
  `othername` varchar(30) NOT NULL,
  `fullname` varchar(100) NOT NULL,
  `nic` varchar(20) NOT NULL,
  `designation` varchar(50) NOT NULL,
  `startdate` date NOT NULL,
  `emptype` varchar(20) NOT NULL,
  `corporatetitle` varchar(20) NOT NULL,
  `salgrade` varchar(20) NOT NULL,
  `bucategory` varchar(20) NOT NULL,
  `departmet` varchar(20) NOT NULL,
  `branch` varchar(20) NOT NULL,
  `email` varchar(100) NOT NULL,
  `bankname` varchar(20) NOT NULL,
  `bankbranch` varchar(30) NOT NULL,
  `accno` varchar(30) NOT NULL,
  `basicsalary` float NOT NULL,
  `brallowance` float NOT NULL,
  `travellingallowance` float NOT NULL,
  `attendance_mealallowance` float NOT NULL,
  `cashierallowance` float NOT NULL,
  `sportclub` varchar(50) NOT NULL,
  `recreationclub` varchar(50) NOT NULL,
  `benevelentfund` varchar(50) NOT NULL,
  `actions` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `itemrsg`
--

CREATE TABLE IF NOT EXISTS `itemrsg` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `empno` int(11) NOT NULL,
  `epfno` int(11) NOT NULL,
  `company` varchar(20) NOT NULL,
  `name` varchar(50) NOT NULL,
  `dateofjoin` date NOT NULL,
  `designation` varchar(20) NOT NULL,
  `bu_department` varchar(20) NOT NULL,
  `corporatetitle` varchar(20) NOT NULL,
  `resignationeffectivedate` varchar(20) NOT NULL,
  `type` varchar(20) NOT NULL,
  `vehicleloan` float NOT NULL,
  `mobilebill` float NOT NULL,
  `festivaladvance` float NOT NULL,
  `other` float NOT NULL,
  `actions` varchar(20) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `empno` (`empno`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `itemdlg`
--
ALTER TABLE `itemdlg`
  ADD CONSTRAINT `itemdlg_ibfk_1` FOREIGN KEY (`empno`) REFERENCES `empdetail` (`empno`);

--
-- Constraints for table `itemfst`
--
ALTER TABLE `itemfst`
  ADD CONSTRAINT `itemfst_ibfk_1` FOREIGN KEY (`empno`) REFERENCES `empdetail` (`empno`);

--
-- Constraints for table `itemlne`
--
ALTER TABLE `itemlne`
  ADD CONSTRAINT `itemlne_ibfk_1` FOREIGN KEY (`empno`) REFERENCES `empdetail` (`empno`);

--
-- Constraints for table `itemlns`
--
ALTER TABLE `itemlns`
  ADD CONSTRAINT `itemlns_ibfk_1` FOREIGN KEY (`empno`) REFERENCES `empdetail` (`empno`);

--
-- Constraints for table `itemnpy`
--
ALTER TABLE `itemnpy`
  ADD CONSTRAINT `itemnpy_ibfk_1` FOREIGN KEY (`empno`) REFERENCES `empdetail` (`empno`);

--
-- Constraints for table `itemovt`
--
ALTER TABLE `itemovt`
  ADD CONSTRAINT `itemovt_ibfk_1` FOREIGN KEY (`empno`) REFERENCES `empdetail` (`empno`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
