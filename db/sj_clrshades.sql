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
-- Table structure for table `sj_clrshades`
--

DROP TABLE IF EXISTS `sj_clrshades`;
CREATE TABLE IF NOT EXISTS `sj_clrshades` (
  `name` varchar(16) NOT NULL,
  `math` varchar(32) NOT NULL,
  `weight` int(2) NOT NULL,
  PRIMARY KEY (`name`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sj_clrshades`
--

INSERT INTO `sj_clrshades` (`name`, `math`, `weight`) VALUES
('pastel', 'n+(max-n)*0.6', 20),
('pure', '', 30),
('gem', 'n/2', 40),
('dark', 'n/4', 50),
('offwhite', 'n+(max-n)*0.85', 10),
('deep', 'n/8', 60),
('suede', 'n/15+max/10', 70),
('drab', 'n/15+max/4', 80),
('soft', 'n/15+max/2', 90),
('light', 'n/15+max/1.5', 100);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
