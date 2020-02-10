-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Feb 10, 2020 at 02:41 PM
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
-- Table structure for table `sj_user_persona`
--

DROP TABLE IF EXISTS `sj_user_persona`;
CREATE TABLE IF NOT EXISTS `sj_user_persona` (
  `id` int(4) NOT NULL,
  `username` varchar(16) NOT NULL,
  `name` varchar(16) NOT NULL,
  `grp` varchar(16) DEFAULT NULL,
  `clrsetid` int(16) DEFAULT NULL,
  `weight` int(3) NOT NULL DEFAULT '999',
  `date_added` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_last_modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `username` (`username`),
  KEY `name` (`name`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sj_user_persona`
--

INSERT INTO `sj_user_persona` (`id`, `username`, `name`, `grp`, `clrsetid`, `weight`, `date_added`, `date_last_modified`) VALUES
(6917, 'narriax', 'Anri', 'Cluster1', NULL, 999, '2020-02-08 16:53:04', '2020-02-08 16:53:04'),
(9417, 'narriax', 'Krey', 'Cluster2', NULL, 999, '2020-02-08 17:46:03', '2020-02-08 17:46:03'),
(5904, 'narriax', 'Nars', 'Cluster1', NULL, 999, '2020-02-10 10:25:41', '2020-02-10 10:25:41'),
(9798, 'narriax', 'Silver', 'Silver', NULL, 999, '2020-02-10 10:51:43', '2020-02-10 10:51:43'),
(6922, 'narriax', 'Julia', 'Cluster3', NULL, 999, '2020-02-10 10:51:59', '2020-02-10 10:51:59');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
