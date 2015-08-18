-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Aug 09, 2015 at 07:56 PM
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
