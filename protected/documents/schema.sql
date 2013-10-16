SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

CREATE SCHEMA IF NOT EXISTS `booking` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci ;
USE `booking` ;

-- -----------------------------------------------------
-- Table `user_account`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `user_account` (
  `id` SMALLINT(5) UNSIGNED NOT NULL AUTO_INCREMENT,
  `username` CHAR(6) NOT NULL,
  `password` CHAR(40) NOT NULL,
  `identity` CHAR(10) NOT NULL,
  `realname` VARCHAR(64) NOT NULL,
  `division` TINYINT(3) UNSIGNED NOT NULL DEFAULT 0,
  `created_at` INT(10) UNSIGNED NOT NULL DEFAULT 0,
  `updated_at` INT(10) UNSIGNED NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `INDEX_USERNAME` (`username` ASC) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `comm_migrate_company`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `comm_migrate_company` (
  `id` SMALLINT(5) UNSIGNED NOT NULL AUTO_INCREMENT,
  `code` CHAR(5) NOT NULL,
  `name` VARCHAR(255) NOT NULL,
  `created_at` INT(10) UNSIGNED NOT NULL,
  `updated_at` INT(10) UNSIGNED NOT NULL,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `comm_booking`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `comm_booking` (
  `id` SMALLINT(5) UNSIGNED NOT NULL AUTO_INCREMENT,
  `ua_id` SMALLINT(5) UNSIGNED NOT NULL,
  `sa_id` SMALLINT(5) UNSIGNED NOT NULL,
  `co_id` SMALLINT(5) UNSIGNED NOT NULL,
  `name` VARCHAR(32) NOT NULL,
  `stat` TINYINT(3) UNSIGNED NOT NULL DEFAULT 0,
  `note` VARCHAR(1024) NOT NULL,
  `created_at` INT(10) UNSIGNED NOT NULL DEFAULT 0,
  `updated_at` INT(10) UNSIGNED NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`),
  INDEX `INDEX_FK1` (`ua_id` ASC),
  INDEX `INDEX_FK2` (`sa_id` ASC),
  INDEX `INDEX_FK3` (`co_id` ASC),
  CONSTRAINT `FK_COMM_BOOKING_1`
    FOREIGN KEY (`ua_id` )
    REFERENCES `user_account` (`id` )
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `FK_COMM_BOOKING_2`
    FOREIGN KEY (`sa_id` )
    REFERENCES `user_account` (`id` )
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `FK_COMM_BOOKING_3`
    FOREIGN KEY (`co_id` )
    REFERENCES `comm_migrate_company` (`id` )
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `news_section`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `news_section` (
  `id` TINYINT(3) UNSIGNED NOT NULL AUTO_INCREMENT,
  `ps_id` TINYINT(3) UNSIGNED NULL,
  `name` VARCHAR(32) NOT NULL,
  `created_at` INT(10) UNSIGNED NOT NULL DEFAULT 0,
  `updated_at` INT(10) UNSIGNED NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`),
  INDEX `INDEX_FK1` (`ps_id` ASC),
  CONSTRAINT `FK_NEWS_SECTION_1`
    FOREIGN KEY (`ps_id` )
    REFERENCES `news_section` (`id` )
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `comm_booking_request`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `comm_booking_request` (
  `id` MEDIUMINT(7) UNSIGNED NOT NULL AUTO_INCREMENT,
  `ua_id` SMALLINT(5) UNSIGNED NOT NULL,
  `cb_id` SMALLINT(5) UNSIGNED NOT NULL,
  `ns_id` TINYINT(3) UNSIGNED NOT NULL,
  `page` TINYINT(3) UNSIGNED NOT NULL,
  `stat` TINYINT(3) UNSIGNED NOT NULL,
  `note` VARCHAR(1000) NOT NULL,
  `sizex` VARCHAR(4) NOT NULL,
  `sizey` VARCHAR(8) NOT NULL,
  `color` TINYINT(3) UNSIGNED NOT NULL,
  `publish_at` DATE NOT NULL,
  `created_at` INT(10) UNSIGNED NOT NULL DEFAULT 0,
  `updated_at` INT(10) UNSIGNED NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`),
  INDEX `INDEX_FK1` (`ua_id` ASC),
  INDEX `INDEX_FK2` (`cb_id` ASC),
  INDEX `INDEX_FK3` (`ns_id` ASC),
  CONSTRAINT `FK_COMM_BOOKING_REQUEST_1`
    FOREIGN KEY (`ua_id` )
    REFERENCES `user_account` (`id` )
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `FK_COMM_BOOKING_REQUEST_2`
    FOREIGN KEY (`cb_id` )
    REFERENCES `comm_booking` (`id` )
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `FK_COMM_BOOKING_REQUEST_3`
    FOREIGN KEY (`ns_id` )
    REFERENCES `news_section` (`id` )
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `news_edition`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `news_edition` (
  `id` TINYINT(3) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(32) NOT NULL,
  `created_at` INT(10) UNSIGNED NOT NULL DEFAULT 0,
  `updated_at` INT(10) UNSIGNED NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `comm_booking_placing`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `comm_booking_placing` (
  `id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `ua_id` SMALLINT(5) UNSIGNED NOT NULL,
  `br_id` MEDIUMINT(7) UNSIGNED NOT NULL,
  `ne_id` TINYINT(3) UNSIGNED NOT NULL,
  `ns_id` TINYINT(3) UNSIGNED NOT NULL,
  `page` TINYINT(3) UNSIGNED NOT NULL DEFAULT 0,
  `posx` TINYINT(3) UNSIGNED NOT NULL DEFAULT 0,
  `posy` TINYINT(3) UNSIGNED NOT NULL DEFAULT 0,
  `created_at` INT(10) UNSIGNED NOT NULL DEFAULT 0,
  `updated_at` INT(10) UNSIGNED NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`),
  INDEX `INDEX_FK1` (`ua_id` ASC),
  INDEX `INDEX_FK2` (`br_id` ASC),
  INDEX `INDEX_FK3` (`ne_id` ASC),
  INDEX `INDEX_FK4` (`ns_id` ASC),
  CONSTRAINT `FK_COMM_BOOKING_PLACING_1`
    FOREIGN KEY (`ua_id` )
    REFERENCES `user_account` (`id` )
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `FK_COMM_BOOKING_PLACING_2`
    FOREIGN KEY (`br_id` )
    REFERENCES `comm_booking_request` (`id` )
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `FK_COMM_BOOKING_PLACING_3`
    FOREIGN KEY (`ne_id` )
    REFERENCES `news_edition` (`id` )
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `FK_COMM_BOOKING_PLACING_4`
    FOREIGN KEY (`ns_id` )
    REFERENCES `news_section` (`id` )
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `comm_booking_edition`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `comm_booking_edition` (
  `cb_id` SMALLINT(5) UNSIGNED NOT NULL,
  `ne_id` TINYINT(3) UNSIGNED NOT NULL,
  `created_at` INT(10) UNSIGNED NOT NULL DEFAULT 0,
  PRIMARY KEY (`cb_id`, `ne_id`),
  INDEX `INDEX_FK1` (`cb_id` ASC),
  INDEX `INDEX_FK2` (`ne_id` ASC),
  CONSTRAINT `FK_COMM_BOOKING_EDITION_1`
    FOREIGN KEY (`cb_id` )
    REFERENCES `comm_booking` (`id` )
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `FK_COMM_BOOKING_EDITION_2`
    FOREIGN KEY (`ne_id` )
    REFERENCES `news_edition` (`id` )
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `comm_booking_storage`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `comm_booking_storage` (
  `id` MEDIUMINT(7) UNSIGNED NOT NULL,
  `ua_id` SMALLINT(5) UNSIGNED NOT NULL,
  `cb_id` SMALLINT(5) UNSIGNED NOT NULL,
  `name` VARCHAR(32) NOT NULL,
  `type` VARCHAR(32) NOT NULL,
  `path` VARCHAR(32) NOT NULL,
  `created_at` INT(10) UNSIGNED NOT NULL DEFAULT 0,
  `updated_at` INT(10) UNSIGNED NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`),
  INDEX `INDEX_FK1` (`ua_id` ASC),
  INDEX `INDEX_FK2` (`cb_id` ASC),
  CONSTRAINT `FK_COMM_BOOKING_STORAGE_1`
    FOREIGN KEY (`ua_id` )
    REFERENCES `user_account` (`id` )
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `FK_COMM_BOOKING_STORAGE_2`
    FOREIGN KEY (`cb_id` )
    REFERENCES `comm_booking` (`id` )
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `comm_migrate_account`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `comm_migrate_account` (
  `user_id` SMALLINT(5) UNSIGNED NOT NULL,
  `code` CHAR(3) NOT NULL,
  `created_at` INT(10) UNSIGNED NOT NULL DEFAULT 0,
  PRIMARY KEY (`user_id`),
  CONSTRAINT `FK_COMM_MIGRATE_ACCOUNT_1`
    FOREIGN KEY (`user_id` )
    REFERENCES `user_account` (`id` )
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `comm_placing_dateset`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `comm_placing_dateset` (
  `id` INT(10) UNSIGNED NOT NULL,
  `ua_id` SMALLINT(5) UNSIGNED NOT NULL,
  `date` DATE NOT NULL,
  `type` TINYINT(3) UNSIGNED NOT NULL DEFAULT 0,
  `created_at` INT(10) UNSIGNED NOT NULL DEFAULT 0,
  `updated_at` INT(10) UNSIGNED NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`),
  INDEX `INDEX_FK1` (`ua_id` ASC),
  CONSTRAINT `FK_COMM_PLACING_DATESET_1`
    FOREIGN KEY (`ua_id` )
    REFERENCES `user_account` (`id` )
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Placeholder table for view `comm_placing`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `comm_placing` (`id` INT, `cb_id` INT, `ne_id` INT, `br_id` INT, `bp_id` INT);
-- -----------------------------------------------------
-- View `comm_placing`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `comm_placing`;
CREATE  OR REPLACE VIEW `comm_placing` AS
SELECT `br`.`id` + `be`.`ne_id` AS `id`,
       `be`.`cb_id` AS `cb_id`,
       `be`.`ne_id` AS `ne_id`,
       `br`.`id` AS `br_id`,
       `bp`.`id` AS `bp_id`
FROM `comm_booking` `cb`
LEFT JOIN `comm_booking_edition` `be` ON `cb`.`id` = `be`.`cb_id`
LEFT JOIN `comm_booking_request` `br` ON `cb`.`id` = `br`.`cb_id`
LEFT JOIN `comm_booking_placing` `bp` ON `br`.`id` = `bp`.`br_id` AND `be`.`ne_id` = `bp`.`ne_id`;

SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
