-- phpMyAdmin SQL Dump
-- version 4.1.12
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Mar 06, 2015 at 06:53 PM
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
-- Table structure for table `ferienhaus`
--

CREATE TABLE IF NOT EXISTS `ferienhaus` (
  `id_ferienhaus` int(11) NOT NULL AUTO_INCREMENT,
  `betten` int(11) NOT NULL,
  `schlafzimmer` int(11) NOT NULL,
  `bezeichnung` varchar(255) NOT NULL,
  `preis` float NOT NULL,
  `verfuegbar_anfang` date NOT NULL,
  `verfuegbar_ende` date NOT NULL,
  PRIMARY KEY (`id_ferienhaus`),
  UNIQUE KEY `id_ferienhaus_UNIQUE` (`id_ferienhaus`),
  UNIQUE KEY `bezeichnung` (`bezeichnung`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `ferienhaus`
--

INSERT INTO `ferienhaus` (`id_ferienhaus`, `betten`, `schlafzimmer`, `bezeichnung`, `preis`, `verfuegbar_anfang`, `verfuegbar_ende`) VALUES
(1, 4, 2, 'Schönes Landhaus', 70.5, '2015-03-08', '2015-03-29'),
(2, 2, 1, 'Wohnung in belebter Stadt', 35.7, '2015-03-05', '2015-05-31');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
