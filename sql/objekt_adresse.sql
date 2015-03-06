-- phpMyAdmin SQL Dump
-- version 4.1.12
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Mar 05, 2015 at 05:44 PM
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
-- Table structure for table `objekt_adresse`
--

CREATE TABLE IF NOT EXISTS `objekt_adresse` (
  `id_objekt_adresse` int(11) NOT NULL AUTO_INCREMENT,
  `region` varchar(255) NOT NULL,
  `plz` int(11) NOT NULL,
  `ort` varchar(255) NOT NULL,
  `straße` varchar(255) NOT NULL,
  `id_ferienhaus` int(11) NOT NULL,
  PRIMARY KEY (`id_objekt_adresse`),
  KEY `fk_objekt_adresse_ferienhaus1_idx` (`id_ferienhaus`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `objekt_adresse`
--

INSERT INTO `objekt_adresse` (`id_objekt_adresse`, `region`, `plz`, `ort`, `straße`, `id_ferienhaus`) VALUES
(1, 'Deutschland', 91341, 'Röttenbach', 'Am Goldberg 10', 1),
(2, 'Deutschland', 91052, 'Erlangen', 'Nägelsbachstraße 33', 2);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `objekt_adresse`
--
ALTER TABLE `objekt_adresse`
  ADD CONSTRAINT `fk_objekt_adresse_ferienhaus1` FOREIGN KEY (`id_ferienhaus`) REFERENCES `ferienhaus` (`id_ferienhaus`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
