-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jan 02, 2020 at 11:21 PM
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
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `username` varchar(16) NOT NULL,
  `email` varchar(32) NOT NULL,
  `password` varchar(32) NOT NULL,
  `secret` text NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_visited` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`username`),
  UNIQUE KEY `email` (`email`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`username`, `email`, `password`, `secret`, `date_created`, `date_visited`) VALUES
('narriax', 'narriax@gmail.com', 'lord', '', '2020-01-02 20:51:09', '2020-01-03 04:17:11');

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
  `username` varchar(16) NOT NULL,
  `personaname` varchar(16) NOT NULL,
  PRIMARY KEY (`username`),
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
('FJV5NWBkMPxAMC3KiGDutCNA7bmKlRKk', 'narriax', 'testapp', '2020-01-02 23:17:11');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
