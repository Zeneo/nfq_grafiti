-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Oct 28, 2013 at 01:40 AM
-- Server version: 5.5.24-log
-- PHP Version: 5.3.13

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `grafiti`
--

-- --------------------------------------------------------

--
-- Table structure for table `basics`
--

CREATE TABLE IF NOT EXISTS `basics` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `site_title` varchar(30) NOT NULL,
  `published` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `galleries`
--

CREATE TABLE IF NOT EXISTS `galleries` (
  `id` int(30) NOT NULL AUTO_INCREMENT,
  `owner_id` int(11) NOT NULL,
  `name` varchar(30) NOT NULL,
  `text` text NOT NULL,
  `creation_date` date NOT NULL,
  `published` tinyint(4) NOT NULL DEFAULT '1',
  `admin_priority` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `galleries`
--

INSERT INTO `galleries` (`id`, `owner_id`, `name`, `text`, `creation_date`, `published`, `admin_priority`) VALUES
(1, 1, 'Mano kuriniai', '', '2013-10-27', 1, 0),
(2, 1, 'Megstami kuriniai', '', '2013-10-27', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `images`
--

CREATE TABLE IF NOT EXISTS `images` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `gallery_id` int(11) NOT NULL,
  `name` varchar(30) NOT NULL,
  `src` text NOT NULL,
  `active` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `images`
--

INSERT INTO `images` (`id`, `gallery_id`, `name`, `src`, `active`) VALUES
(1, 1, 'Pirmasis darbas', '1.jpg', 1),
(2, 1, 'Antrasis', '2.jpg', 1),
(3, 1, 'Visai nieko', '3.jpg', 1),
(4, 2, 'Sienos projektas', '4.jpg', 1),
(7, 1, 'asd', '1382924135.jpg', 0),
(8, 1, 'asd', '1382924188.jpg', 0),
(9, 2, 'Paulius Navickas', '1382924342.jpg', 0);

-- --------------------------------------------------------

--
-- Table structure for table `menus`
--

CREATE TABLE IF NOT EXISTS `menus` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(30) NOT NULL,
  `published` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `menus`
--

INSERT INTO `menus` (`id`, `name`, `published`) VALUES
(1, 'topmenu', 1),
(2, 'footermenu', 1),
(3, 'user_menu', 1);

-- --------------------------------------------------------

--
-- Table structure for table `menu_items`
--

CREATE TABLE IF NOT EXISTS `menu_items` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` text COLLATE utf8_lithuanian_ci NOT NULL,
  `menu_id` int(11) NOT NULL,
  `module` varchar(30) COLLATE utf8_lithuanian_ci DEFAULT NULL,
  `alias` varchar(40) COLLATE utf8_lithuanian_ci DEFAULT NULL,
  `url` varchar(40) COLLATE utf8_lithuanian_ci DEFAULT NULL,
  `published` tinyint(1) NOT NULL,
  `active` tinyint(1) NOT NULL,
  `order` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_lithuanian_ci AUTO_INCREMENT=6 ;

--
-- Dumping data for table `menu_items`
--

INSERT INTO `menu_items` (`id`, `title`, `menu_id`, `module`, `alias`, `url`, `published`, `active`, `order`) VALUES
(1, 'Pagrindinis', 1, NULL, NULL, '/', 1, 1, 1),
(2, 'Galerija', 1, 'galleries', NULL, '', 1, 1, 2),
(3, 'Apie mus', 2, 'pages', 'about-us', NULL, 1, 0, 3),
(4, 'Kontaktai', 2, 'pages', 'contacts', NULL, 1, 0, 4),
(5, '2013 Paulius Navickas. Visos teises saugomos', 2, 'rights', NULL, '', 1, 1, 5);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `role` varchar(20) NOT NULL DEFAULT 'user',
  `username` varchar(100) DEFAULT NULL,
  `password` varchar(40) NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  `status` enum('inactive','active','blocked') NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `role`, `username`, `password`, `email`, `status`, `created`, `modified`) VALUES
(1, 'user', 'zee', 'be8bdd9a75031dcf65049dd9c1bf25d1905e8115', 'paulius.zee@gmail.com', 'active', '2012-04-04 13:33:02', '2012-08-22 12:27:19');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
