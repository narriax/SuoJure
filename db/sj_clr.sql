-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Feb 10, 2020 at 02:40 PM
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
('garnet', '', 'red', 'dark'),
('blush', '', 'red', 'pastel'),
('orange', '', 'orange', 'pure'),
('brown', '', 'orange', 'dark'),
('salmon', '', 'orange', 'pastel'),
('yellow', '', 'yellow', 'pure'),
('olive', '', 'yellow', 'dark'),
('canary', '', 'yellow', 'pastel'),
('peridot', '', 'grass', 'pure'),
('swamp', '', 'grass', 'suede'),
('tea', '', 'grass', 'pastel'),
('lime', '', 'lime', 'pure'),
('green', '', 'lime', 'dark'),
('eco', '', 'lime', 'pastel'),
('leygreen', '', 'leygreen', 'pure'),
('forest', '', 'leygreen', 'dark'),
('aero', '', 'leygreen', 'pastel'),
('cyan', '', 'cyan', 'pure'),
('teal', '', 'cyan', 'dark'),
('ice', '', 'cyan', 'offwhite'),
('babyblue', '', 'sky', 'offwhite'),
('sea', '', 'sky', 'dark'),
('blue', '', 'blue', 'pure'),
('navy', '', 'blue', 'dark'),
('powder', '', 'blue', 'pastel'),
('violet', '', 'violet', 'pure'),
('universe', '', 'violet', 'deep'),
('lavender', '', 'violet', 'pastel'),
('magenta', '', 'magenta', 'pure'),
('purple', '', 'magenta', 'dark'),
('lace', '', 'magenta', 'pastel'),
('fuchsia', '', 'fuchsia', 'pure'),
('wine', '', 'fuchsia', 'dark'),
('pink', '', 'fuchsia', 'pastel'),
('champaigne', '', 'orange', 'offwhite'),
('babypink', '', 'red', 'offwhite'),
('cream', '', 'yellow', 'offwhite'),
('mint', '', 'lime', 'offwhite'),
('ruby', '', 'red', 'gem'),
('sith', '', 'red', 'deep'),
('emerald', '', 'lime', 'gem'),
('sage', '', 'yellow', 'suede'),
('pine', '', 'leygreen', 'deep'),
('malachite', '', 'lime', 'deep'),
('grass', '', 'grass', 'gem'),
('white', '', 'white', 'pure'),
('sapphhire', '', 'blue', 'gem'),
('midnight', '', 'blue', 'deep'),
('sky', '', 'sky', 'pastel'),
('leyblue', '', 'sky', 'pure'),
('rose', '', 'fuchsia', 'offwhite'),
('royal', '', 'violet', 'dark'),
('leather', '', 'red', 'suede'),
('bark', '', 'orange', 'suede'),
('turquoise', '', 'cyan', 'gem'),
('lapis', '', 'violet', 'gem'),
('eggplant', '', 'magenta', 'suede'),
('bordo', '', 'fuchsia', 'deep'),
('twilight', '', 'violet', 'suede'),
('black', '', 'white', 'pastel'),
('silver', '', 'leygreen', 'touch'),
('panther', '', 'red', 'pitch'),
('gold', '', 'orange', 'light'),
('camo', '', 'yellow', 'drab'),
('mouse', '', 'white', 'suede'),
('gray', '', 'white', 'drab'),
('chocolate', '', 'orange', 'deep'),
('caramel', '', 'orange', 'gem'),
('storm', '', 'blue', 'drab'),
('fog', '', 'sky', 'touch'),
('topaz', '', 'yellow', 'light'),
('cobalt', '', 'sky', 'gem'),
('steel', '', 'white', 'gem'),
('moss', '', 'grass', 'dark'),
('jade', '', 'leygreen', 'gem'),
('cave', '', 'yellow', 'pitch'),
('stone', '', 'orange', 'drab'),
('marble', '', 'yellow', 'touch'),
('amethyst', '', 'magenta', 'gem'),
('bile', '', 'yellow', 'gem'),
('chrome', '', 'white', 'offwhite'),
('titanium', '', 'white', 'touch'),
('blackberry', '', 'fuchsia', 'pitch'),
('calypso', '', 'leygreen', 'light'),
('electric', '', 'cyan', 'light'),
('hotpink', '', 'fuchsia', 'light'),
('smoke', '', 'magenta', 'soft'),
('agate', '', 'fuchsia', 'soft'),
('orchid', '', 'magenta', 'light'),
('plum', '', 'fuchsia', 'gem');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
