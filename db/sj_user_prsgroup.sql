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
-- Table structure for table `sj_user_prsgroup`
--

DROP TABLE IF EXISTS `sj_user_prsgroup`;
CREATE TABLE IF NOT EXISTS `sj_user_prsgroup` (
  `id` int(4) NOT NULL,
  `username` varchar(16) NOT NULL,
  `name` varchar(16) NOT NULL,
  `weight` int(2) NOT NULL DEFAULT '99',
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_last_modified` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sj_user_prsgroup`
--

INSERT INTO `sj_user_prsgroup` (`id`, `username`, `name`, `weight`, `date_created`, `date_last_modified`) VALUES
(3875, 'narriax', 'ClusterS', 99, '2020-02-10 13:47:51', '2020-02-10 08:47:51'),
(9938, 'narriax', 'Cluster1', 1, '2020-02-10 14:19:07', '2020-02-10 09:26:58'),
(3186, 'narriax', 'Cluster2', 2, '2020-02-10 14:28:09', '2020-02-10 09:28:25'),
(9937, 'narriax', 'Cluster3', 3, '2020-02-10 14:28:43', '2020-02-10 09:29:03');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
