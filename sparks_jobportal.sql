-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Apr 26, 2016 at 11:40 PM
-- Server version: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `sparks_jobportal`
--

-- --------------------------------------------------------

--
-- Table structure for table `activity`
--

CREATE TABLE IF NOT EXISTS `activity` (
  `activity_id` int(11) NOT NULL AUTO_INCREMENT,
  `activity_name` varchar(125) NOT NULL,
  `module_id` int(11) NOT NULL,
  `screen_id` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  PRIMARY KEY (`activity_id`),
  KEY `module_id` (`module_id`,`screen_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `activity`
--

INSERT INTO `activity` (`activity_id`, `activity_name`, `module_id`, `screen_id`, `status`) VALUES
(1, 'index', 1, 1, 1),
(2, 'login', 1, 1, 1),
(3, 'index', 2, 2, 1),
(4, 'index', 3, 3, 1),
(5, 'index', 4, 4, 1),
(6, 'dashboard', 2, 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `lusers`
--

CREATE TABLE IF NOT EXISTS `lusers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `oauth_provider` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `oauth_uid` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `fname` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `lname` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `location` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `country` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `picture_url` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `profile_url` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=3 ;

--
-- Dumping data for table `lusers`
--

INSERT INTO `lusers` (`id`, `oauth_provider`, `oauth_uid`, `fname`, `lname`, `email`, `location`, `country`, `picture_url`, `profile_url`, `created`, `modified`) VALUES
(1, 'linkedin', 'DXoh4KJZVx', 'Mahesh', 'Kumar', '', 'Tirunelveli Area, India', 'in', 'https://media.licdn.com/mpr/mprx/0_wM8zE7KqaIaqGJekWgrEEDFvawU58JekLjNEE2cHAm7NxgxXFxKJXu_6hLRUiOWeEsCI5wWYHbMx', 'https://www.linkedin.com/in/mahesh-kumar-5b6a871a', '2016-03-12 21:29:29', '2016-03-12 21:29:29'),
(2, 'linkedin', 'DXoh4KJZVx', 'Mahesh', 'Kumar', 'smakeshindia@gmail.com', 'Tirunelveli Area, India', 'in', 'https://media.licdn.com/mpr/mprx/0_wM8zE7KqaIaqGJekWgrEEDFvawU58JekLjNEE2cHAm7NxgxXFxKJXu_6hLRUiOWeEsCI5wWYHbMx', 'https://www.linkedin.com/in/mahesh-kumar-5b6a871a', '2016-03-12 21:30:58', '2016-03-12 22:13:12');

-- --------------------------------------------------------

--
-- Table structure for table `module`
--

CREATE TABLE IF NOT EXISTS `module` (
  `module_id` int(11) NOT NULL AUTO_INCREMENT,
  `module_name` varchar(125) NOT NULL,
  `default_role` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  PRIMARY KEY (`module_id`),
  UNIQUE KEY `module_name` (`module_name`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `module`
--

INSERT INTO `module` (`module_id`, `module_name`, `default_role`, `status`) VALUES
(1, 'defult', 4, 1),
(2, 'admin', 1, 1),
(3, 'employeer', 2, 1),
(4, 'specialist', 3, 1);

-- --------------------------------------------------------

--
-- Table structure for table `new_table`
--

CREATE TABLE IF NOT EXISTS `new_table` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `test` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE IF NOT EXISTS `permissions` (
  `permission_id` int(11) NOT NULL AUTO_INCREMENT,
  `module_id` int(11) NOT NULL,
  `screen_id` int(11) NOT NULL,
  `activity_id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`permission_id`),
  KEY `module_id` (`module_id`,`screen_id`,`activity_id`,`role_id`,`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`permission_id`, `module_id`, `screen_id`, `activity_id`, `role_id`, `user_id`) VALUES
(1, 1, 1, 1, 1, NULL),
(2, 1, 1, 2, 1, NULL),
(3, 2, 2, 3, 1, NULL),
(6, 2, 2, 6, 1, NULL),
(4, 3, 3, 4, 2, NULL),
(5, 4, 4, 5, 3, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE IF NOT EXISTS `roles` (
  `role_id` int(11) NOT NULL AUTO_INCREMENT,
  `role_name` varchar(50) NOT NULL,
  `status` int(11) NOT NULL,
  PRIMARY KEY (`role_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`role_id`, `role_name`, `status`) VALUES
(1, 'admin', 1),
(2, 'employeer', 1),
(3, 'specialist', 1),
(4, 'guest', 1);

-- --------------------------------------------------------

--
-- Table structure for table `role_menu`
--

CREATE TABLE IF NOT EXISTS `role_menu` (
  `role_menu_id` int(11) NOT NULL AUTO_INCREMENT,
  `menu_name` varchar(255) NOT NULL,
  `menu_order` int(11) NOT NULL,
  `activity_id` int(11) NOT NULL,
  `module_id` int(11) NOT NULL,
  `screen_id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  PRIMARY KEY (`role_menu_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `role_menu`
--

INSERT INTO `role_menu` (`role_menu_id`, `menu_name`, `menu_order`, `activity_id`, `module_id`, `screen_id`, `role_id`) VALUES
(1, 'Dashboard', 1, 6, 2, 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `screen`
--

CREATE TABLE IF NOT EXISTS `screen` (
  `screen_id` int(11) NOT NULL AUTO_INCREMENT,
  `screen_name` varchar(125) NOT NULL,
  `module_id` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  PRIMARY KEY (`screen_id`),
  KEY `module_id` (`module_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `screen`
--

INSERT INTO `screen` (`screen_id`, `screen_name`, `module_id`, `status`) VALUES
(1, 'auth', 1, 1),
(2, 'index', 2, 1),
(3, 'index', 3, 1),
(4, 'index', 4, 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_name` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `role` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `user_name`, `password`, `role`, `status`) VALUES
(1, 'admin', 'sparks', 1, 1),
(2, 'employeer', 'sparks', 2, 1),
(3, 'specialist', 'sparks', 3, 1);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
