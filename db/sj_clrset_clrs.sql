-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Feb 15, 2020 at 09:34 PM
-- Server version: 5.7.24
-- PHP Version: 7.2.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `suojure_d7`
--

-- --------------------------------------------------------

--
-- Table structure for table `sj_clrset_clrs`
--

DROP TABLE IF EXISTS `sj_clrset_clrs`;
CREATE TABLE IF NOT EXISTS `sj_clrset_clrs` (
  `clrsetid` int(16) NOT NULL,
  `clrtype` varchar(16) NOT NULL,
  `clr` varchar(6) DEFAULT NULL COMMENT 'hex color',
  KEY `clrsetid` (`clrsetid`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sj_clrset_clrs`
--

INSERT INTO `sj_clrset_clrs` (`clrsetid`, `clrtype`, `clr`) VALUES
(7553, 'primary', '67f9c6'),
(7553, 'secondary', 'f7f7f7'),
(7553, 'aux', 'f9c667'),
(1794, 'primary', '001180'),
(1794, 'secondary', '0f0f0f'),
(1794, 'aux', 'ccd9d3'),
(4371, 'primary', '000e66'),
(4371, 'secondary', '0f0f0f'),
(4371, 'aux', 'bf0000'),
(1567, 'primary', '0f0020'),
(1567, 'secondary', '000940'),
(1567, 'aux', 'ccd9d3'),
(7408, 'primary', '0f0020'),
(7408, 'secondary', '000940'),
(7408, 'aux', 'ccd9d3'),
(3552, 'primary', '0f0020'),
(3552, 'secondary', '000e66'),
(3552, 'aux', '0073bf'),
(2184, 'primary', '660000'),
(2184, 'secondary', '0f0606'),
(2184, 'aux', 'bf0000'),
(3752, 'primary', '4b0066'),
(3752, 'secondary', '919191'),
(3752, 'aux', '2b231a'),
(2417, 'primary', '004000'),
(2417, 'secondary', '0f0b06'),
(2417, 'aux', '663600'),
(9408, 'primary', '402200'),
(9408, 'secondary', '0099ff'),
(9408, 'aux', '66bf00'),
(4371, 'contrast', 'ccd9d3'),
(3552, 'contrast', 'ccd9d3'),
(2184, 'contrast', 'ccd9d3'),
(7553, 'contrast', '8c00bf'),
(3752, 'contrast', 'f7f7f7'),
(2417, 'contrast', 'f1f16f'),
(9408, 'contrast', 'f9c667'),
(8556, 'primary', 'bf0000'),
(8556, 'secondary', '400000'),
(8556, 'aux', 'f7f7f7'),
(8556, 'contrast', 'f9c667'),
(2717, 'primary', '000000'),
(2717, 'secondary', '202020'),
(2717, 'aux', 'd9d9d9'),
(2717, 'contrast', 'ffffff'),
(5150, 'primary', '404a51'),
(5150, 'secondary', '2b1a1a'),
(5150, 'aux', '0f0b06'),
(5150, 'contrast', 'd9d9d9'),
(7735, 'primary', 'bf0000'),
(7735, 'secondary', '0022ff'),
(7735, 'aux', '2b1a1a'),
(7735, 'contrast', 'f7f7f7'),
(2312, 'primary', '0073bf'),
(2312, 'secondary', '00bfbf'),
(2312, 'aux', 'f9c667'),
(2312, 'contrast', '004040');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
