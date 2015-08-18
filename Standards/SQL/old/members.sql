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
-- Database: `users`
--

-- --------------------------------------------------------

--
-- Table structure for table `members`
--

CREATE TABLE IF NOT EXISTS `members` (
  `id` int(4) NOT NULL AUTO_INCREMENT,
  `empno` int(10) NOT NULL,
  `username` varchar(65) NOT NULL DEFAULT '',
  `password` varchar(65) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`),
  KEY `empno` (`empno`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=18 ;

--
-- Dumping data for table `members`
--

INSERT INTO `members` (`id`, `empno`, `username`, `password`) VALUES
(2, 2000, 'lahiru', '123'),
(3, 1000, 'user', '1234'),
(4, 4171, 'malitha', '123'),
(5, 7777, 'test', '1234'),
(7, 1000, 'niroshan', '1234'),
(8, 4567, 'F_FST', '1234'),
(9, 4568, 'F_LNE', '1234'),
(10, 4569, 'F_LNS', '1234'),
(11, 4590, 'F_MDC', '1234'),
(12, 1001, 'F_MBT', '1234'),
(13, 1002, 'F_RMT', '1234'),
(14, 1005, 'F_NPY', '1234'),
(15, 1006, 'F_OVT', '1234'),
(16, 1007, 'F_RSG', '1234'),
(17, 1007, 'F_RSG', '1234');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
