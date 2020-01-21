-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jan 21, 2020 at 05:45 AM
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
-- Table structure for table `tasks`
--

DROP TABLE IF EXISTS `tasks`;
CREATE TABLE IF NOT EXISTS `tasks` (
  `taskid` varchar(16) NOT NULL,
  `name` varchar(32) NOT NULL,
  `owner_uoid` int(16) NOT NULL,
  `date_archived` timestamp NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `task_assignments`
--

DROP TABLE IF EXISTS `task_assignments`;
CREATE TABLE IF NOT EXISTS `task_assignments` (
  `uoid` int(16) NOT NULL,
  `taskid` int(16) NOT NULL,
  `masterid` int(16) NOT NULL,
  `status` varchar(16) NOT NULL,
  `duedate` timestamp NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `task_history`
--

DROP TABLE IF EXISTS `task_history`;
CREATE TABLE IF NOT EXISTS `task_history` (
  `taskid` int(16) NOT NULL,
  `userid` int(16) NOT NULL,
  `newstatus` varchar(16) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `task_projects`
--

DROP TABLE IF EXISTS `task_projects`;
CREATE TABLE IF NOT EXISTS `task_projects` (
  `uoid` int(16) NOT NULL,
  `status` varchar(16) NOT NULL,
  `date_archived` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `task_status`
--

DROP TABLE IF EXISTS `task_status`;
CREATE TABLE IF NOT EXISTS `task_status` (
  `name` varchar(16) NOT NULL,
  `allow_for_projects` tinyint(1) NOT NULL,
  `allow_for_tasks` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`name`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `task_status`
--

INSERT INTO `task_status` (`name`, `allow_for_projects`, `allow_for_tasks`) VALUES
('new', 1, 1),
('claimed', 0, 1),
('started', 1, 1),
('blocked', 1, 1),
('paused', 1, 1),
('finished', 0, 1),
('accepted', 0, 1),
('rejected', 0, 1),
('complete', 1, 1);

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
  `tablename` varchar(16) NOT NULL,
  `uotype_group` varchar(16) NOT NULL,
  PRIMARY KEY (`tablename`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `uobj_types`
--

INSERT INTO `uobj_types` (`tablename`, `uotype_group`) VALUES
('users', 'users'),
('user_personas', 'users'),
('tasks', 'tasks'),
('task_assignments', 'tasks'),
('task_projects', 'tasks');

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
(111, 'narriax', 'narriax@gmail.com', 'lord', '', '2020-01-02 20:51:09', '2020-01-21 10:07:00');

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
  PRIMARY KEY (`uoid`) USING BTREE,
  KEY `username` (`username`),
  KEY `personaname` (`personaname`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user_personas`
--

INSERT INTO `user_personas` (`uoid`, `username`, `personaname`) VALUES
(2085568596, 'narriax', 'Anri'),
(1034582707, 'narriax', 'Krey');

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
('hiuon2gjpkkflVBZueDbitzqQ6hzIvB2', 'narriax', 'browser', '2020-01-21 05:07:00');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
