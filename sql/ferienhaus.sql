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
  `id_region` int(11) NOT NULL,
  `id_objekt_adresse` int(11) NOT NULL,
  `id_eigentuemer_adresse` int(11) NOT NULL,
  PRIMARY KEY (`id_ferienhaus`),
  UNIQUE KEY `id_ferienhaus_UNIQUE` (`id_ferienhaus`),
  KEY `fk_ferienhaus_region1_idx` (`id_region`),
  KEY `fk_ferienhaus_objekt_adresse1_idx` (`id_objekt_adresse`),
  KEY `fk_ferienhaus_eigentuemer_adresse1_idx` (`id_eigentuemer_adresse`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `ferienhaus`
--

INSERT INTO `ferienhaus` (`id_ferienhaus`, `betten`, `schlafzimmer`, `bezeichnung`, `preis`, `verfuegbar_anfang`, `verfuegbar_ende`, `id_region`, `id_objekt_adresse`, `id_eigentuemer_adresse`) VALUES
(1, 4, 2, 'Schönes verträumtes Landhaus', 70, '2015-03-05', '2015-03-27', 1, 1, 1),
(2, 2, 2, 'Bauklotz', 25.75, '2015-03-12', '2015-03-16', 1, 2, 2);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `ferienhaus`
--
ALTER TABLE `ferienhaus`
  ADD CONSTRAINT `fk_ferienhaus_region1` FOREIGN KEY (`id_region`) REFERENCES `region` (`id_region`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_ferienhaus_objekt_adresse1` FOREIGN KEY (`id_objekt_adresse`) REFERENCES `objekt_adresse` (`id_objekt_adresse`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_ferienhaus_eigentuemer_adresse1` FOREIGN KEY (`id_eigentuemer_adresse`) REFERENCES `eigentuemer_adresse` (`id_eigentuemer_adresse`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
