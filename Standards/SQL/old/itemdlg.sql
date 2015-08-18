-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Aug 08, 2015 at 11:19 AM
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
  UNIQUE KEY `empno` (`empno`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1235 ;

--
-- Dumping data for table `itemdlg`
--

INSERT INTO `itemdlg` (`id`, `empno`, `epfno`, `name`, `company`, `department`, `corporatetitle`, `dialogdeductions`, `actions`) VALUES
(1234, 1000, 212, 'Mr Test Unit', 'LOMC', 'Finacial', 'Manager', 1234.45, 'CRE1210');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `itemdlg`
--
ALTER TABLE `itemdlg`
  ADD CONSTRAINT `itemdlg_ibfk_1` FOREIGN KEY (`empno`) REFERENCES `empdetail` (`empno`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
