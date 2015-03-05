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
-- Table structure for table `maengelanzeige`
--

CREATE TABLE IF NOT EXISTS `maengelanzeige` (
  `id_maengel` int(11) NOT NULL AUTO_INCREMENT,
  `beschreibung` text NOT NULL,
  `meldedatum` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `id_kunde` int(11) NOT NULL,
  PRIMARY KEY (`id_maengel`),
  UNIQUE KEY `id_maengel_UNIQUE` (`id_maengel`),
  KEY `fk_maengelanzeige_kunde1_idx` (`id_kunde`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `maengelanzeige`
--

INSERT INTO `maengelanzeige` (`id_maengel`, `beschreibung`, `meldedatum`, `id_kunde`) VALUES
(1, 'Das Bett war kaputt.', '2015-03-05 09:05:08', 1);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `maengelanzeige`
--
ALTER TABLE `maengelanzeige`
  ADD CONSTRAINT `fk_maengelanzeige_kunde1` FOREIGN KEY (`id_kunde`) REFERENCES `kunde` (`id_kunde`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
