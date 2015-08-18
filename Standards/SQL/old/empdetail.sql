-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Aug 09, 2015 at 07:57 PM
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
(1000, 2011, 'LOMC', 'Mr. Test Unit', 'Male', '812450547V', 'Customer', 'DLG1238;DLG1241;DLG1247;DLG1248;DLG1250;', 'EM'),
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

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
