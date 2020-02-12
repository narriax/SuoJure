-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Feb 12, 2020 at 06:23 AM
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
  `active` tinyint(1) NOT NULL DEFAULT '1',
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

INSERT INTO `sj_user_persona` (`id`, `username`, `name`, `grp`, `clrsetid`, `active`, `weight`, `date_added`, `date_last_modified`) VALUES
(6917, 'narriax', 'Anri', '9938', NULL, 1, 10, '2020-02-08 16:53:04', '2020-02-12 05:53:56'),
(9417, 'narriax', 'Krey', '3186', NULL, 1, 50, '2020-02-08 17:46:03', '2020-02-12 05:56:00'),
(5904, 'narriax', 'Nars', '9938', NULL, 1, 20, '2020-02-10 10:25:41', '2020-02-12 05:55:16'),
(9798, 'narriax', 'Silver', '3875', NULL, 1, 130, '2020-02-10 10:51:43', '2020-02-12 06:00:09'),
(6922, 'narriax', 'Julia', '9937', NULL, 0, 150, '2020-02-10 10:51:59', '2020-02-12 05:59:50'),
(8712, 'narriax', 'Raze', '9938', NULL, 1, 30, '2020-02-12 04:17:04', '2020-02-12 05:55:37'),
(5566, 'narriax', 'Raven', '3186', NULL, 0, 70, '2020-02-12 04:17:11', '2020-02-12 05:56:26'),
(8231, 'narriax', 'Drek', '3186', NULL, 0, 90, '2020-02-12 04:17:14', '2020-02-12 05:56:45'),
(5687, 'narriax', 'Christa', '3186', NULL, 1, 100, '2020-02-12 04:17:31', '2020-02-12 05:56:58'),
(5502, 'narriax', 'Lan', '3186', NULL, 0, 60, '2020-02-12 04:17:49', '2020-02-12 05:56:12'),
(6651, 'narriax', 'Lexi', '3186', NULL, 1, 120, '2020-02-12 04:17:53', '2020-02-12 05:59:16'),
(9151, 'narriax', 'Mik', '3186', NULL, 0, 110, '2020-02-12 04:17:57', '2020-02-12 05:59:32');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
