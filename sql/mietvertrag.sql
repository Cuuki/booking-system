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
-- Table structure for table `mietvertrag`
--

CREATE TABLE IF NOT EXISTS `mietvertrag` (
  `id_mietvertrag` int(11) NOT NULL AUTO_INCREMENT,
  `beginn` date NOT NULL,
  `ende` date NOT NULL,
  `id_ferienhaus` int(11) NOT NULL,
  `id_kunde` int(11) NOT NULL,
  PRIMARY KEY (`id_mietvertrag`),
  UNIQUE KEY `id_mietvertrag_UNIQUE` (`id_mietvertrag`),
  KEY `fk_miervertrag_ferienhaus1_idx` (`id_ferienhaus`),
  KEY `fk_miervertrag_kunde1_idx` (`id_kunde`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `mietvertrag`
--

INSERT INTO `mietvertrag` (`id_mietvertrag`, `beginn`, `ende`, `id_ferienhaus`, `id_kunde`) VALUES
(1, '2015-03-08', '2015-03-12', 1, 1);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `mietvertrag`
--
ALTER TABLE `mietvertrag`
  ADD CONSTRAINT `fk_miervertrag_ferienhaus1` FOREIGN KEY (`id_ferienhaus`) REFERENCES `ferienhaus` (`id_ferienhaus`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_miervertrag_kunde1` FOREIGN KEY (`id_kunde`) REFERENCES `kunde` (`id_kunde`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
