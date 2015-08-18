-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Aug 09, 2015 at 10:55 PM
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

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE IF NOT EXISTS `roles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(20) NOT NULL,
  `roles` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=21 ;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `username`, `roles`) VALUES
(1, 'lahiru', 'FD-DLG'),
(6, 'user', 'FD-DLG'),
(7, 'malitha', 'PO'),
(8, 'test', 'FD-FST'),
(9, 'niroshan', 'FD-LNE'),
(10, 'F_FST', 'FD-FST'),
(11, 'F_LNE', 'FD-LNE'),
(12, 'F_LNE', 'FD-LNE'),
(13, 'F_LNS', 'FD-LNS'),
(14, 'F_MDC', 'FD-MDC'),
(15, 'F_MBT', 'FD-MBT'),
(16, 'F_RMT', 'FD-RMT'),
(17, 'F_NPY', 'FD-NPY'),
(18, 'F_OVT', 'FD-OVT'),
(19, 'F_OVT', 'FD-OVT'),
(20, 'F_RSG', 'FD-RSG');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
