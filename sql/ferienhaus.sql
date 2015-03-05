-- phpMyAdmin SQL Dump
-- version 4.1.12
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Mar 05, 2015 at 10:12 AM
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
  `objekt_plz` int(11) NOT NULL,
  `objekt_adresse` varchar(255) NOT NULL,
  `eigentuemer_plz` int(11) NOT NULL,
  `eigentuemer_adresse` varchar(255) NOT NULL,
  `betten` int(11) NOT NULL,
  `schlafzimmer` int(11) NOT NULL,
  `bezeichnung` varchar(255) NOT NULL,
  `verfuegbar_anfang` date NOT NULL,
  `verfuegbar_ende` date NOT NULL,
  `preis` float NOT NULL,
  PRIMARY KEY (`id_ferienhaus`),
  UNIQUE KEY `id_ferienhaus_UNIQUE` (`id_ferienhaus`),
  UNIQUE KEY `eigentuemer_adresse_UNIQUE` (`eigentuemer_adresse`),
  UNIQUE KEY `objekt_adresse_UNIQUE` (`objekt_adresse`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `ferienhaus`
--

INSERT INTO `ferienhaus` (`id_ferienhaus`, `objekt_plz`, `objekt_adresse`, `eigentuemer_plz`, `eigentuemer_adresse`, `betten`, `schlafzimmer`, `bezeichnung`, `verfuegbar_anfang`, `verfuegbar_ende`, `preis`) VALUES
(1, 12345, 'Test 1', 54321, 'Test 2', 10, 5, 'Testbezeichnung', '2015-03-18', '2015-11-18', 312.55);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
