-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jan 03, 2020 at 11:42 PM
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
-- Database: `suojure`
--

-- --------------------------------------------------------

--
-- Table structure for table `uobj_data`
--

DROP TABLE IF EXISTS `uobj_data`;
CREATE TABLE IF NOT EXISTS `uobj_data` (
  `uoid` int(16) NOT NULL,
  `idx` int(11) NOT NULL DEFAULT '0',
  `note` varchar(32) DEFAULT NULL,
  `datum` text NOT NULL,
  `last_modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  KEY `uoid` (`uoid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `uobj_types`
--

DROP TABLE IF EXISTS `uobj_types`;
CREATE TABLE IF NOT EXISTS `uobj_types` (
  `tablename` varchar(16) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `uobj_types`
--

INSERT INTO `uobj_types` (`tablename`) VALUES
('users'),
('user_personas');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `uoid` int(16) NOT NULL COMMENT 'unique object id',
  `username` varchar(16) NOT NULL,
  `email` varchar(32) NOT NULL,
  `password` varchar(32) NOT NULL,
  `secret` text NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_visited` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`username`),
  UNIQUE KEY `email` (`email`),
  UNIQUE KEY `uoid` (`uoid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`uoid`, `username`, `email`, `password`, `secret`, `date_created`, `date_visited`) VALUES
(111, 'narriax', 'narriax@gmail.com', 'lord', '', '2020-01-02 20:51:09', '2020-01-04 02:38:46');

-- --------------------------------------------------------

--
-- Table structure for table `user_cookiesign`
--

DROP TABLE IF EXISTS `user_cookiesign`;
CREATE TABLE IF NOT EXISTS `user_cookiesign` (
  `username` varchar(16) NOT NULL,
  `ip` varchar(16) NOT NULL,
  `cookiesign` varchar(64) NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`username`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `user_personas`
--

DROP TABLE IF EXISTS `user_personas`;
CREATE TABLE IF NOT EXISTS `user_personas` (
  `uoid` int(16) NOT NULL COMMENT 'unique object id',
  `username` varchar(16) NOT NULL,
  `personaname` varchar(16) NOT NULL,
  PRIMARY KEY (`username`),
  UNIQUE KEY `uoid` (`uoid`),
  KEY `personaname` (`personaname`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `user_sessions`
--

DROP TABLE IF EXISTS `user_sessions`;
CREATE TABLE IF NOT EXISTS `user_sessions` (
  `id` varchar(32) NOT NULL,
  `username` varchar(16) NOT NULL,
  `device` varchar(32) NOT NULL,
  `started` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `username` (`username`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user_sessions`
--

INSERT INTO `user_sessions` (`id`, `username`, `device`, `started`) VALUES
('1yPS22KuCloWzEphXyE56LAg5cBJKbqv', 'narriax', 'testapp', '2020-01-02 23:14:23'),
('OZ5JAKngRHmohiWhazkSg41j6E2w9LvS', 'narriax', 'browser', '2020-01-02 22:37:00'),
('FJV5NWBkMPxAMC3KiGDutCNA7bmKlRKk', 'narriax', 'testapp', '2020-01-02 23:17:11'),
('s5KM2YUgNXIe8gyiW6r6lMoC21cEIk7t', 'narriax', 'testdevice', '2020-01-03 21:38:46');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
