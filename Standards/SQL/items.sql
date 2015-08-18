-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Aug 15, 2015 at 08:41 PM
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
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
