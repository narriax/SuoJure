-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Feb 05, 2020 at 08:00 AM
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
-- Table structure for table `sj_clr`
--

DROP TABLE IF EXISTS `sj_clr`;
CREATE TABLE IF NOT EXISTS `sj_clr` (
  `name` varchar(16) NOT NULL,
  `color` varchar(6) NOT NULL,
  `family` varchar(16) NOT NULL,
  `shade` varchar(16) NOT NULL,
  PRIMARY KEY (`name`) USING BTREE
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sj_clr`
--

INSERT INTO `sj_clr` (`name`, `color`, `family`, `shade`) VALUES
('red', '', 'red', 'pure'),
('maroon', '', 'red', 'dark'),
('rose', '', 'red', 'pastel'),
('orange', '', 'orange', 'pure'),
('brown', '', 'orange', 'dark'),
('salmon', '', 'orange', 'pastel'),
('yellow', '', 'yellow', 'pure'),
('bile', '', 'yellow', 'dark'),
('canary', '', 'yellow', 'pastel'),
('grass', '', 'grass', 'pure'),
('swamp', '', 'grass', 'dark'),
('tea', '', 'grass', 'pastel'),
('lime', '', 'lime', 'pure'),
('green', '', 'lime', 'dark'),
('eco', '', 'lime', 'pastel'),
('leygreen', '', 'leygreen', 'pure'),
('forest', '', 'leygreen', 'dark'),
('aero', '', 'leygreen', 'pastel'),
('cyan', '', 'cyan', 'pure'),
('teal', '', 'cyan', 'dark'),
('ice', '', 'cyan', 'pastel'),
('sky', '', 'sky', 'pure'),
('sea', '', 'sky', 'dark'),
('babyblue', '', 'sky', 'pastel'),
('blue', '', 'blue', 'pure'),
('navy', '', 'blue', 'dark'),
('powder', '', 'blue', 'pastel'),
('violet', '', 'violet', 'pure'),
('universe', '', 'violet', 'dark'),
('lavender', '', 'violet', 'pastel'),
('magenta', '', 'magenta', 'pure'),
('purple', '', 'magenta', 'dark'),
('lace', '', 'magenta', 'pastel'),
('fuchsia', '', 'fuchsia', 'pure'),
('wine', '', 'fuchsia', 'dark'),
('pink', '', 'fuchsia', 'pastel');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
