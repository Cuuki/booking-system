-- phpMyAdmin SQL Dump
-- version 4.1.12
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Mar 05, 2015 at 04:53 PM
-- Server version: 5.6.16
-- PHP Version: 5.5.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `booking_system`
--

-- --------------------------------------------------------

--
-- Table structure for table `eigentuemer_adresse`
--

CREATE TABLE IF NOT EXISTS `eigentuemer_adresse` (
  `id_eigentuemer_adresse` int(11) NOT NULL AUTO_INCREMENT,
  `plz` int(11) NOT NULL,
  `ort` varchar(255) NOT NULL,
  `straße` varchar(255) NOT NULL,
  PRIMARY KEY (`id_eigentuemer_adresse`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `eigentuemer_adresse`
--

INSERT INTO `eigentuemer_adresse` (`id_eigentuemer_adresse`, `plz`, `ort`, `straße`) VALUES
(1, 91341, 'Röttenbach', 'Am Goldberg 10'),
(2, 91052, 'Erlangen', 'Nägelsbachstraße 33');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
