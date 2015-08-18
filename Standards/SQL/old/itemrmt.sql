-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Aug 08, 2015 at 01:37 PM
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

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
