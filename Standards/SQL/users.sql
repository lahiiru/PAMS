-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Aug 15, 2015 at 11:47 AM
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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=19 ;

--
-- Dumping data for table `members`
--

INSERT INTO `members` (`id`, `empno`, `username`, `password`) VALUES
(5, 98, 'em', '1234'),
(6, 120, 'f_mbt', '1234'),
(7, 130, 'f_rsg', '1234'),
(8, 150, 'f_fst', '1234'),
(9, 300, 'f_lne', '1234'),
(10, 320, 'hh', '1234'),
(11, 500, 'po', '1234'),
(12, 590, 'f_rmt', '1234'),
(13, 600, 'f_dlg', '1234'),
(14, 656, 'f_lns', '1234'),
(15, 800, 'hp', '1234'),
(16, 880, 'f_npy', '1234'),
(17, 900, 'hh', '1234'),
(18, 1001, 'f_ovt', '1234');

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
(8, 'em', 'EM'),
(9, 'f_mbt', 'FD-MBT'),
(10, 'f_rsg', 'FD-RSG'),
(11, 'f_fst', 'FD-FST'),
(12, 'f_lne', 'FD-LNE'),
(13, 'hh', 'HH'),
(14, 'po', 'PO'),
(15, 'f_rmt', 'FD-RMT'),
(16, 'f_dlg', 'FD-DLG'),
(17, 'f_lns', 'FD-LNS'),
(18, 'hp', 'HP-LOMC'),
(19, 'f_npy', 'FD-NPY'),
(20, 'f_ovt', 'FD-OVT');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
