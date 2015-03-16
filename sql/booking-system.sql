CREATE DATABASE IF NOT EXISTS `booking_system` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;

USE `booking_system` ;

CREATE TABLE IF NOT EXISTS `booking_system`.`kunde` (
  `id_kunde` INT NOT NULL AUTO_INCREMENT,
  `vorname` VARCHAR(255) NOT NULL,
  `nachname` VARCHAR(255) NOT NULL,
  `email` VARCHAR(255) NOT NULL,
  `plz` INT NOT NULL,
  `ort` VARCHAR(255) NOT NULL,
  `straße` VARCHAR(255) NOT NULL,
  PRIMARY KEY (`id_kunde`),
  UNIQUE INDEX `id_kunde_UNIQUE` (`id_kunde` ASC),
  UNIQUE INDEX `email_UNIQUE` (`email` ASC))
ENGINE = InnoDB;

CREATE TABLE IF NOT EXISTS `booking_system`.`ferienhaus` (
  `id_ferienhaus` INT NOT NULL AUTO_INCREMENT,
  `betten` INT NOT NULL,
  `schlafzimmer` INT NOT NULL,
  `bezeichnung` VARCHAR(255) NOT NULL,
  `preis` FLOAT NOT NULL,
  `verfuegbar_anfang` DATE NOT NULL,
  `verfuegbar_ende` DATE NOT NULL,
  PRIMARY KEY (`id_ferienhaus`),
  UNIQUE INDEX `id_ferienhaus_UNIQUE` (`id_ferienhaus` ASC),
  UNIQUE INDEX `bezeichnung_UNIQUE` (`bezeichnung` ASC))
ENGINE = InnoDB;

CREATE TABLE IF NOT EXISTS `booking_system`.`mietvertrag` (
  `id_mietvertrag` INT NOT NULL AUTO_INCREMENT,
  `beginn` DATE NOT NULL,
  `ende` DATE NOT NULL,
  `id_ferienhaus` INT NOT NULL,
  `id_kunde` INT NOT NULL,
  PRIMARY KEY (`id_mietvertrag`),
  UNIQUE INDEX `id_mietvertrag_UNIQUE` (`id_mietvertrag` ASC),
  INDEX `fk_miervertrag_ferienhaus1_idx` (`id_ferienhaus` ASC),
  INDEX `fk_miervertrag_kunde1_idx` (`id_kunde` ASC),
  UNIQUE INDEX `id_ferienhaus_id_kunde_UNIQUE` (`id_kunde` ASC, `id_ferienhaus` ASC),
  CONSTRAINT `fk_miervertrag_ferienhaus1`
    FOREIGN KEY (`id_ferienhaus`)
    REFERENCES `booking_system`.`ferienhaus` (`id_ferienhaus`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_miervertrag_kunde1`
    FOREIGN KEY (`id_kunde`)
    REFERENCES `booking_system`.`kunde` (`id_kunde`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

CREATE TABLE IF NOT EXISTS `booking_system`.`maengelanzeige` (
  `id_maengel` INT NOT NULL AUTO_INCREMENT,
  `beschreibung` TEXT(1000) NOT NULL,
  `meldedatum` TIMESTAMP NOT NULL,
  `id_kunde` INT NOT NULL,
  `id_ferienhaus` INT NOT NULL,
  PRIMARY KEY (`id_maengel`),
  UNIQUE INDEX `id_maengel_UNIQUE` (`id_maengel` ASC),
  INDEX `fk_maengelanzeige_kunde1_idx` (`id_kunde` ASC),
  INDEX `fk_maengelanzeige_ferienhaus1_idx` (`id_ferienhaus` ASC),
  CONSTRAINT `fk_maengelanzeige_kunde1`
    FOREIGN KEY (`id_kunde`)
    REFERENCES `booking_system`.`kunde` (`id_kunde`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_maengelanzeige_ferienhaus1`
    FOREIGN KEY (`id_ferienhaus`)
    REFERENCES `booking_system`.`ferienhaus` (`id_ferienhaus`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

CREATE TABLE IF NOT EXISTS `booking_system`.`admin` (
  `id_admin` INT NOT NULL AUTO_INCREMENT,
  `username` VARCHAR(255) NOT NULL,
  `email` VARCHAR(255) NOT NULL,
  `passwort` VARCHAR(255) NOT NULL,
  PRIMARY KEY (`id_admin`),
  UNIQUE INDEX `id_admin_UNIQUE` (`id_admin` ASC),
  UNIQUE INDEX `username_UNIQUE` (`username` ASC),
  UNIQUE INDEX `email_UNIQUE` (`email` ASC))
ENGINE = InnoDB;

CREATE TABLE IF NOT EXISTS `booking_system`.`eigentuemer_adresse` (
  `id_eigentuemer_adresse` INT NOT NULL AUTO_INCREMENT,
  `plz` INT NOT NULL,
  `ort` VARCHAR(255) NOT NULL,
  `straße` VARCHAR(255) NOT NULL,
  `id_ferienhaus` INT NOT NULL,
  PRIMARY KEY (`id_eigentuemer_adresse`),
  INDEX `fk_eigentuemer_adresse_ferienhaus1_idx` (`id_ferienhaus` ASC),
  CONSTRAINT `fk_eigentuemer_adresse_ferienhaus1`
    FOREIGN KEY (`id_ferienhaus`)
    REFERENCES `booking_system`.`ferienhaus` (`id_ferienhaus`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

CREATE TABLE IF NOT EXISTS `booking_system`.`objekt_adresse` (
  `id_objekt_adresse` INT NOT NULL AUTO_INCREMENT,
  `region` VARCHAR(255) NOT NULL,
  `plz` INT NOT NULL,
  `ort` VARCHAR(255) NOT NULL,
  `straße` VARCHAR(255) NOT NULL,
  `id_ferienhaus` INT NOT NULL,
  PRIMARY KEY (`id_objekt_adresse`),
  INDEX `fk_objekt_adresse_ferienhaus1_idx` (`id_ferienhaus` ASC),
  CONSTRAINT `fk_objekt_adresse_ferienhaus1`
    FOREIGN KEY (`id_ferienhaus`)
    REFERENCES `booking_system`.`ferienhaus` (`id_ferienhaus`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

CREATE TABLE IF NOT EXISTS `booking_system`.`ferienhaus_kunde` (
  `id_ferienhaus` INT NOT NULL,
  `id_kunde` INT NOT NULL,
  PRIMARY KEY (`id_ferienhaus`, `id_kunde`),
  INDEX `fk_ferienhaus_has_kunde1_kunde1_idx` (`id_kunde` ASC),
  INDEX `fk_ferienhaus_has_kunde1_ferienhaus1_idx` (`id_ferienhaus` ASC),
  CONSTRAINT `fk_ferienhaus_has_kunde1_ferienhaus1`
    FOREIGN KEY (`id_ferienhaus`)
    REFERENCES `booking_system`.`ferienhaus` (`id_ferienhaus`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_ferienhaus_has_kunde1_kunde1`
    FOREIGN KEY (`id_kunde`)
    REFERENCES `booking_system`.`kunde` (`id_kunde`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;