-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Aug 15, 2015 at 10:15 AM
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
  `department` varchar(10) NOT NULL,
  PRIMARY KEY (`empno`),
  KEY `EmpNo` (`empno`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `empdetail`
--

INSERT INTO `empdetail` (`empno`, `epfno`, `company`, `name`, `gender`, `nic`, `designation`, `pendingitems`, `roles`, `department`) VALUES
(98, 99, 'LOMC', 'M.D.K Jayawardana', 'Male', '875489261V', 'Trainee Marketing Officer - Islamic Business Unit', '', 'EM', 'SD'),
(120, 121, 'LTEC', 'D.A.M Silva', 'Male', '992123348V', 'Customer', '', 'FD-MBT', 'SD'),
(130, 131, 'LOLC FAC', 'G.K Suraj', 'Male', '911256325V', 'Manager - Portfolio Development', '', 'FD-RSG', 'SD'),
(150, 151, 'LTEC', 'T.P Sanjaya', 'Male', '954312321V', 'Officer In Charge', '', 'FD-FST', 'SD'),
(300, 301, 'LOMC', 'C.D Bandara', 'Male', '923212458V', 'Assistant Manager', '', 'FD-LNE', 'SD'),
(305, 702, 'LOITS', 'R.M Amarasinghe', 'Male', '921223458V', 'junior manager', '', 'EM', 'SD'),
(320, 700, 'LOFIN', 'L.K Anura Kumara', 'male', '123122321V', 'Senior Manager', '', 'HH', 'SD'),
(343, 344, 'LOLC', 'P.V.C Chandimal', 'Male', '322526351V', 'Documentation Assistant', '', 'EM', 'SD'),
(350, 351, 'LOLC', 'F.B Samantha', 'Male', '988759234V', 'Senior Marketing Officer - FD & Savings', '', 'EM', 'SD'),
(500, 501, 'LOLC', 'P.K sewwandi', 'Female', '32987223V', 'Branch Assistant', '', 'PO', 'SD'),
(505, 506, 'LOMC', 'D.M perera', 'male', '453245346V', 'Marketing Executive', '', 'FD-DLG', 'SD'),
(569, 570, 'LOLC', 'S.E Lahiru', 'Male', '216598785V', 'Documentation Assistant', '', 'PO', 'SD'),
(590, 591, 'LOLC', 'O.P Opatha', 'Male', '786545561V', 'Marketing Officer', '', 'FD-RMT', 'SD'),
(600, 601, 'LOSEC', 'S.D Fernando', 'Female', '349098877V', 'Officer In Charge', '', 'FD-DLG', 'SD'),
(656, 657, 'LOLC', 'D.V Gunarathna', 'Female', '879865984V', 'Trainee Marketing Officer', '', 'FD-LNS', 'SD'),
(666, 667, 'LOFIN', 'R.D.N Ranapthi', 'Male', '983121235V', 'Senior Marketing Executive - FD & Savings', '', 'PO', 'SD'),
(755, 756, 'LOLC Insurance Company Ltd', 'G.B Dias', 'Male', '875984651V', 'Branch Head', '', 'PO', 'SD'),
(800, 801, 'UDE', 'L.B Herath', 'Female', '223354312V', 'Marketing Executive - FD & Savings', '', 'HP-LOLC', 'SD'),
(880, 881, 'LOSEC', 'J.B Bandara', 'Male', '78986545V', 'Senior Marketing Officer', '', 'FD-NPY', 'SD'),
(882, 883, 'LOITS', 'P.C Vishaka', 'Female', '412659484X', 'Officer In Charge', '', 'EM', 'SD'),
(900, 901, 'UDE', 'T.R Hettiarachi', 'Female', '902321195V', 'Public Relational Officer', '', 'HH', 'SD'),
(920, 921, 'LOLC', 'S.L Malsha', 'Female', '875948652V', 'Public Relations Assistant', '', 'PO', 'SD'),
(1000, 1001, 'LOMC', 'G.N Anuradha', 'Male', '894321231V', 'Officer', 'MBT11;MBT20;MBT29;MBT38;MBT47;MBT56;MBT65;MBT74;MBT83;MBT92;MBT101;MBT107;MBT113;', 'HP-LOMC', 'SD'),
(1001, 1002, 'LOMC', 'K.L Rathnayaka', 'Female', '455689781V', 'Senior Marketing Officer', '', 'FD-OVT', 'SD'),
(2000, 212, 'LOITS', 'Mr. Lahiru Jayakody', 'Male', '923170688V', 'Project Manager', 'DLG118;DLG521;DLG524;DLG592;DLG595;DLG633;DLG636;DLG675;DLG678;DLG717;DLG720;DLG759;DLG762;', 'EM', 'SD');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
