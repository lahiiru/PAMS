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

--
-- Constraints for dumped tables
--

--
-- Constraints for table `itemovt`
--
ALTER TABLE `itemovt`
  ADD CONSTRAINT `itemovt_ibfk_1` FOREIGN KEY (`empno`) REFERENCES `empdetail` (`empno`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
