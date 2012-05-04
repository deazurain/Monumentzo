SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL';

DROP SCHEMA IF EXISTS `monumentzo` ;
CREATE SCHEMA IF NOT EXISTS `monumentzo` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci ;
USE `monumentzo` ;

-- -----------------------------------------------------
-- Table `monumentzo`.`User`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `monumentzo`.`User` (
  `UserID` INT UNSIGNED NOT NULL ,
  `Name` VARCHAR(45) NOT NULL ,
  `HashedPassword` VARCHAR(64) NOT NULL ,
  `EmailAddress` VARCHAR(255) NOT NULL ,
  PRIMARY KEY (`UserID`) ,
  UNIQUE INDEX `UserID_UNIQUE` (`UserID` ASC) ,
  UNIQUE INDEX `Name_UNIQUE` (`Name` ASC) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `monumentzo`.`Image`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `monumentzo`.`Image` (
  `ImageID` INT UNSIGNED NOT NULL AUTO_INCREMENT ,
  `MonumentID` INT UNSIGNED NOT NULL ,
  `Path` VARCHAR(255) NOT NULL ,
  PRIMARY KEY (`ImageID`) ,
  INDEX `Monumentzo.Image.MonumentID` (`MonumentID` ASC) ,
  UNIQUE INDEX `ImageID_UNIQUE` (`ImageID` ASC) ,
  UNIQUE INDEX `Path_UNIQUE` (`Path` ASC) ,
  CONSTRAINT `Monumentzo.Image.MonumentID`
    FOREIGN KEY (`MonumentID` )
    REFERENCES `monumentzo`.`Monument` (`MonumentID` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `monumentzo`.`Monument`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `monumentzo`.`Monument` (
  `MonumentID` INT UNSIGNED NOT NULL ,
  `ImageID` INT UNSIGNED NULL ,
  `Name` TEXT NOT NULL ,
  `Description` TEXT NULL ,
  `Latitude` FLOAT NULL ,
  `Longitude` FLOAT NULL ,
  `City` VARCHAR(45) NULL ,
  `Province` VARCHAR(45) NULL ,
  `Street` VARCHAR(45) NULL ,
  `StreetNumberText` VARCHAR(45) NULL ,
  `FoundationDateText` VARCHAR(45) NULL ,
  `FoundationYear` INT NULL ,
  `WikiArticle` TEXT NULL ,
  PRIMARY KEY (`MonumentID`) ,
  UNIQUE INDEX `MonumentID_UNIQUE` (`MonumentID` ASC) ,
  INDEX `Monumentzo.Monument.ImageID` (`ImageID` ASC) ,
  CONSTRAINT `Monumentzo.Monument.ImageID`
    FOREIGN KEY (`ImageID` )
    REFERENCES `monumentzo`.`Image` (`ImageID` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `monumentzo`.`FavoriteList`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `monumentzo`.`FavoriteList` (
  `UserID` INT UNSIGNED NOT NULL ,
  `MonumentID` INT UNSIGNED NOT NULL ,
  PRIMARY KEY (`UserID`, `MonumentID`) ,
  INDEX `Monumentzo.FavoriteList.UserID` (`UserID` ASC) ,
  INDEX `Monumentzo.FavoriteList.MonumentID` (`MonumentID` ASC) ,
  CONSTRAINT `Monumentzo.FavoriteList.UserID`
    FOREIGN KEY (`UserID` )
    REFERENCES `monumentzo`.`User` (`UserID` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `Monumentzo.FavoriteList.MonumentID`
    FOREIGN KEY (`MonumentID` )
    REFERENCES `monumentzo`.`Monument` (`MonumentID` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `monumentzo`.`Comment`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `monumentzo`.`Comment` (
  `CommentID` INT UNSIGNED NOT NULL ,
  `UserID` INT UNSIGNED NOT NULL ,
  `MonumentID` INT UNSIGNED NOT NULL ,
  `PlaceDate` DATE NULL ,
  `Comment` TEXT NULL ,
  PRIMARY KEY (`CommentID`) ,
  INDEX `Monumentzo.Comment.UserID` (`UserID` ASC) ,
  INDEX `Monumentzo.Comment.MonumentID` (`MonumentID` ASC) ,
  UNIQUE INDEX `CommentID_UNIQUE` (`CommentID` ASC) ,
  CONSTRAINT `Monumentzo.Comment.UserID`
    FOREIGN KEY (`UserID` )
    REFERENCES `monumentzo`.`User` (`UserID` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `Monumentzo.Comment.MonumentID`
    FOREIGN KEY (`MonumentID` )
    REFERENCES `monumentzo`.`Monument` (`MonumentID` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `monumentzo`.`Category`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `monumentzo`.`Category` (
  `CategoryID` INT UNSIGNED NOT NULL ,
  `Category` VARCHAR(45) NOT NULL ,
  PRIMARY KEY (`CategoryID`) ,
  UNIQUE INDEX `Category_UNIQUE` (`Category` ASC) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `monumentzo`.`WishList`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `monumentzo`.`WishList` (
  `UserID` INT UNSIGNED NOT NULL ,
  `MonumentID` INT UNSIGNED NOT NULL ,
  PRIMARY KEY (`UserID`, `MonumentID`) ,
  INDEX `Monumentzo.WishList.MonumentID` (`MonumentID` ASC) ,
  INDEX `Monumentzo.WishList.UserID` (`UserID` ASC) ,
  CONSTRAINT `Monumentzo.WishList.MonumentID`
    FOREIGN KEY (`MonumentID` )
    REFERENCES `monumentzo`.`Monument` (`MonumentID` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `Monumentzo.WishList.UserID`
    FOREIGN KEY (`UserID` )
    REFERENCES `monumentzo`.`User` (`UserID` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `monumentzo`.`TextTag`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `monumentzo`.`TextTag` (
  `TextTagID` INT UNSIGNED NOT NULL ,
  `TextTag` VARCHAR(45) NOT NULL ,
  `InverseDocumentFrequency` DOUBLE UNSIGNED NULL ,
  PRIMARY KEY (`TextTagID`) ,
  UNIQUE INDEX `TextTag_UNIQUE` (`TextTag` ASC) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `monumentzo`.`Monument_TextTag`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `monumentzo`.`Monument_TextTag` (
  `MonumentID` INT UNSIGNED NOT NULL ,
  `TextTagID` INT UNSIGNED NOT NULL ,
  `TermFrequencyInverseDocumentFrequency` DOUBLE NULL ,
  `TermFrequency` DOUBLE NULL ,
  PRIMARY KEY (`MonumentID`, `TextTagID`) ,
  INDEX `Monumentzo.Monument_TextTag.MonumentID` (`MonumentID` ASC) ,
  INDEX `Monumentzo.Monument_TextTag.TextTag` (`TextTagID` ASC) ,
  CONSTRAINT `Monumentzo.Monument_TextTag.MonumentID`
    FOREIGN KEY (`MonumentID` )
    REFERENCES `monumentzo`.`Monument` (`MonumentID` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `Monumentzo.Monument_TextTag.TextTag`
    FOREIGN KEY (`TextTagID` )
    REFERENCES `monumentzo`.`TextTag` (`TextTagID` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `monumentzo`.`Monument_Category`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `monumentzo`.`Monument_Category` (
  `MonumentID` INT UNSIGNED NOT NULL ,
  `CategoryID` INT UNSIGNED NOT NULL ,
  PRIMARY KEY (`MonumentID`, `CategoryID`) ,
  INDEX `Monumentzo.Monument_Category.MonumentID` (`MonumentID` ASC) ,
  INDEX `Monumentzo.Monument_Category.CategoryID` (`CategoryID` ASC) ,
  CONSTRAINT `Monumentzo.Monument_Category.MonumentID`
    FOREIGN KEY (`MonumentID` )
    REFERENCES `monumentzo`.`Monument` (`MonumentID` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `Monumentzo.Monument_Category.CategoryID`
    FOREIGN KEY (`CategoryID` )
    REFERENCES `monumentzo`.`Category` (`CategoryID` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `monumentzo`.`ReadList`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `monumentzo`.`ReadList` (
  `UserID` INT UNSIGNED NOT NULL ,
  `Book` TEXT NOT NULL ,
  PRIMARY KEY (`UserID`) ,
  INDEX `Monumentzo.ReadList.UserID` (`UserID` ASC) ,
  CONSTRAINT `Monumentzo.ReadList.UserID`
    FOREIGN KEY (`UserID` )
    REFERENCES `monumentzo`.`User` (`UserID` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `monumentzo`.`VisitedList`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `monumentzo`.`VisitedList` (
  `UserID` INT UNSIGNED NOT NULL ,
  `MonumentID` INT UNSIGNED NOT NULL ,
  PRIMARY KEY (`UserID`, `MonumentID`) ,
  INDEX `Monumentzo.VisitedList.UserID` (`UserID` ASC) ,
  INDEX `Monumentzo.VisitedList.MonumentID` (`MonumentID` ASC) ,
  CONSTRAINT `Monumentzo.VisitedList.UserID`
    FOREIGN KEY (`UserID` )
    REFERENCES `monumentzo`.`User` (`UserID` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `Monumentzo.VisitedList.MonumentID`
    FOREIGN KEY (`MonumentID` )
    REFERENCES `monumentzo`.`Monument` (`MonumentID` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `monumentzo`.`Image_Image`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `monumentzo`.`Image_Image` (
  `ImageID` INT UNSIGNED NOT NULL ,
  `LinkedImage` INT UNSIGNED NOT NULL ,
  PRIMARY KEY (`ImageID`, `LinkedImage`) ,
  INDEX `Monumentzo.Image_Image.ImageID` (`ImageID` ASC) ,
  INDEX `Monumentzo.Image_Image.LinkedImage` (`LinkedImage` ASC) ,
  CONSTRAINT `Monumentzo.Image_Image.ImageID`
    FOREIGN KEY (`ImageID` )
    REFERENCES `monumentzo`.`Image` (`ImageID` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `Monumentzo.Image_Image.LinkedImage`
    FOREIGN KEY (`LinkedImage` )
    REFERENCES `monumentzo`.`Image` (`ImageID` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;



SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
