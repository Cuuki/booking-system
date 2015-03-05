-- phpMyAdmin SQL Dump
-- version 4.1.12
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Mar 05, 2015 at 05:03 PM
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
-- Table structure for table `kunde`
--

CREATE TABLE IF NOT EXISTS `kunde` (
  `id_kunde` int(11) NOT NULL AUTO_INCREMENT,
  `vorname` varchar(255) NOT NULL,
  `nachname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `plz` int(11) NOT NULL,
  `ort` varchar(255) NOT NULL,
  `straße` varchar(255) NOT NULL,
  `id_ferienhaus` int(11) NOT NULL,
  PRIMARY KEY (`id_kunde`),
  UNIQUE KEY `id_kunde_UNIQUE` (`id_kunde`),
  UNIQUE KEY `email_UNIQUE` (`email`),
  KEY `fk_kunde_ferienhaus1_idx` (`id_ferienhaus`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `kunde`
--

INSERT INTO `kunde` (`id_kunde`, `vorname`, `nachname`, `email`, `plz`, `ort`, `straße`, `id_ferienhaus`) VALUES
(1, 'Patrick', 'Söllner', 'soellner.patrick95@gmail.com', 91341, 'Rotterdam', 'Am Oldberg 2', 1);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `kunde`
--
ALTER TABLE `kunde`
  ADD CONSTRAINT `fk_kunde_ferienhaus1` FOREIGN KEY (`id_ferienhaus`) REFERENCES `ferienhaus` (`id_ferienhaus`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
