-- phpMyAdmin SQL Dump
-- version 3.4.5
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jan 04, 2014 at 04:56 AM
-- Server version: 5.5.16
-- PHP Version: 5.3.8

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `dem`
--

-- --------------------------------------------------------

--
-- Table structure for table `counter`
--

CREATE TABLE IF NOT EXISTS `counter` (
  `id` int(1) NOT NULL AUTO_INCREMENT,
  `counter` int(10) NOT NULL,
  `DemNgay` int(11) NOT NULL,
  `counter_ngay` int(11) NOT NULL,
  `NgayNgay` date NOT NULL,
  `DemTuan` int(11) NOT NULL,
  `counter_tuan` int(11) NOT NULL,
  `NgayTuan` date NOT NULL,
  `DemThang` int(11) NOT NULL,
  `counter_thang` int(11) NOT NULL,
  `NgayThang` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

--
-- Dumping data for table `counter`
--

INSERT INTO `counter` (`id`, `counter`, `DemNgay`, `counter_ngay`, `NgayNgay`, `DemTuan`, `counter_tuan`, `NgayTuan`, `DemThang`, `counter_thang`, `NgayThang`) VALUES
(1, 87340, 1, 87338, '2014-01-04', 2, 87339, '2014-01-04', 2, 87339, '2014-01-04');

-- --------------------------------------------------------

--
-- Table structure for table `users_online`
--

CREATE TABLE IF NOT EXISTS `users_online` (
  `visitor` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `lastvisit` int(14) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `users_online`
--

INSERT INTO `users_online` (`visitor`, `lastvisit`) VALUES
('::1', 1388805461);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
