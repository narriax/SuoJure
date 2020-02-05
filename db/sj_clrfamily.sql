-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Feb 05, 2020 at 08:01 AM
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
-- Table structure for table `sj_clrfamily`
--

DROP TABLE IF EXISTS `sj_clrfamily`;
CREATE TABLE IF NOT EXISTS `sj_clrfamily` (
  `name` varchar(16) NOT NULL,
  `weight` int(2) NOT NULL,
  `baseclr` varchar(6) NOT NULL,
  PRIMARY KEY (`name`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sj_clrfamily`
--

INSERT INTO `sj_clrfamily` (`name`, `weight`, `baseclr`) VALUES
('red', 1, 'ff0000'),
('orange', 2, 'ff8800'),
('yellow', 3, 'ffff00'),
('grass', 4, '88ff00'),
('lime', 5, '00ff00'),
('leygreen', 6, '00ff99'),
('cyan', 7, '00ddff'),
('sky', 8, '0099ff'),
('blue', 9, '0033ff'),
('violet', 10, '7700ff'),
('magenta', 11, 'bb00ff'),
('fuchsia', 12, 'ff0099'),
('white', 30, 'ffffff');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
