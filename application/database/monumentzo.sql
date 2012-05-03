-- phpMyAdmin SQL Dump
-- version 3.5.0
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: May 03, 2012 at 09:46 AM
-- Server version: 5.1.62-0ubuntu0.11.10.1
-- PHP Version: 5.3.6-13ubuntu3.6

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `monumentzo`
--

CREATE SCHEMA IF NOT EXISTS `monumentzo` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci ;
USE `monumentzo` ;

-- --------------------------------------------------------

--
-- Table structure for table `Category`
--

CREATE TABLE IF NOT EXISTS `Category` (
  `CategoryID` int(10) unsigned NOT NULL,
  `Category` varchar(45) NOT NULL,
  PRIMARY KEY (`CategoryID`),
  UNIQUE KEY `Category_UNIQUE` (`Category`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Comment`
--

CREATE TABLE IF NOT EXISTS `Comment` (
  `CommentID` int(10) unsigned NOT NULL,
  `UserID` int(10) unsigned NOT NULL,
  `MonumentID` int(10) unsigned NOT NULL,
  `PlaceDate` date DEFAULT NULL,
  `Comment` text DEFAULT NULL,
  PRIMARY KEY (`CommentID`),
  UNIQUE KEY `CommentID_UNIQUE` (`CommentID`),
  KEY `Monumentzo.Comment.UserID` (`UserID`),
  KEY `Monumentzo.Comment.MonumentID` (`MonumentID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `FavoriteList`
--

CREATE TABLE IF NOT EXISTS `FavoriteList` (
  `UserID` int(11) NOT NULL,
  `MonumentID` int(10) unsigned NOT NULL,
  PRIMARY KEY (`UserID`,`MonumentID`),
  KEY `Monumentzo.FavoriteList.UserID` (`UserID`),
  KEY `Monumentzo.FavoriteList.MonumentID` (`MonumentID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Image_Image`
--

CREATE TABLE IF NOT EXISTS `Image_Image` (
  `ImageID` int(10) unsigned NOT NULL,
  `LinkedImage` int(10) unsigned NOT NULL,
  PRIMARY KEY (`ImageID`,`LinkedImage`),
  KEY `Monumentzo.Image_Image.ImageID` (`ImageID`),
  KEY `Monumentzo.Image_Image.LinkedImage` (`LinkedImage`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Monument`
--

CREATE TABLE IF NOT EXISTS `Monument` (
  `MonumentID` int(10) unsigned NOT NULL,
  `ImageID` int(10) unsigned DEFAULT NULL,
  `Name` varchar(255) DEFAULT NULL,
  `Description` text DEFAULT NULL,
  `Latitude` float DEFAULT NULL,
  `Longitude` float DEFAULT NULL,
  `City` varchar(45) DEFAULT NULL,
  `Province` varchar(45) DEFAULT NULL,
  `Street` varchar(45) DEFAULT NULL,
  `StreetNumberText` varchar(45) DEFAULT NULL,
  `FoundationDateText` varchar(45) DEFAULT NULL,
  `FoundationYear` int(11) DEFAULT NULL,
  `WikiArticle` text DEFAULT NULL,
  PRIMARY KEY (`MonumentID`),
  UNIQUE KEY `MonumentID_UNIQUE` (`MonumentID`),
  UNIQUE KEY `Name_UNIQUE` (`Name`),
  KEY `Monumentzo.Monument.ImageID` (`ImageID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Monument_Category`
--

CREATE TABLE IF NOT EXISTS `Monument_Category` (
  `MonumentID` int(10) unsigned NOT NULL,
  `CategoryID` int(10) unsigned NOT NULL,
  PRIMARY KEY (`MonumentID`,`CategoryID`),
  KEY `Monumentzo.Monument_Category.MonumentID` (`MonumentID`),
  KEY `Monumentzo.Monument_Category.CategoryID` (`CategoryID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Monument_Image`
--

CREATE TABLE IF NOT EXISTS `Monument_Image` (
  `MonumentID` int(10) unsigned NOT NULL,
  `ImageID` int(10) unsigned NOT NULL,
  `ImagePath` text NOT NULL,
  PRIMARY KEY (`MonumentID`,`ImageID`),
  KEY `Monumentzo.Monument_Image.MonumentID` (`MonumentID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Monument_TextTag`
--

CREATE TABLE IF NOT EXISTS `Monument_TextTag` (
  `MonumentID` int(10) unsigned NOT NULL,
  `TextTagID` int(10) unsigned NOT NULL,
  PRIMARY KEY (`MonumentID`,`TextTagID`),
  KEY `Monumentzo.Monument_TextTag.MonumentID` (`MonumentID`),
  KEY `Monumentzo.Monument_TextTag.TextTag` (`TextTagID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `ReadList`
--

CREATE TABLE IF NOT EXISTS `ReadList` (
  `UserID` int(10) unsigned NOT NULL,
  `Book` varchar(2083) NOT NULL,
  PRIMARY KEY (`UserID`),
  KEY `Monumentzo.ReadList.UserID` (`UserID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `TextTag`
--

CREATE TABLE IF NOT EXISTS `TextTag` (
  `TextTagID` int(10) unsigned NOT NULL,
  `TextTag` varchar(45) NOT NULL,
  PRIMARY KEY (`TextTagID`),
  UNIQUE KEY `TextTag_UNIQUE` (`TextTag`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `User`
--

CREATE TABLE IF NOT EXISTS `User` (
  `UserID` int(10) unsigned NOT NULL,
  `Name` varchar(45) NOT NULL,
  `HashedPassword` varchar(45) NOT NULL,
  `EmailAddress` varchar(45) NOT NULL,
  PRIMARY KEY (`UserID`),
  UNIQUE KEY `UserID_UNIQUE` (`UserID`),
  UNIQUE KEY `Name_UNIQUE` (`Name`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `VisitedList`
--

CREATE TABLE IF NOT EXISTS `VisitedList` (
  `UserID` int(10) unsigned NOT NULL,
  `MonumentID` int(10) unsigned NOT NULL,
  PRIMARY KEY (`UserID`,`MonumentID`),
  KEY `Monumentzo.VisitedList.UserID` (`UserID`),
  KEY `Monumentzo.VisitedList.MonumentID` (`MonumentID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `WishList`
--

CREATE TABLE IF NOT EXISTS `WishList` (
  `UserID` int(10) unsigned NOT NULL,
  `MonumentID` int(10) unsigned NOT NULL,
  PRIMARY KEY (`UserID`,`MonumentID`),
  KEY `Monumentzo.WishList.MonumentID` (`MonumentID`),
  KEY `Monumentzo.WishList.UserID` (`UserID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `Comment`
--
ALTER TABLE `Comment`
  ADD CONSTRAINT `Monumentzo.Comment.UserID` FOREIGN KEY (`UserID`) REFERENCES `User` (`UserID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `Monumentzo.Comment.MonumentID` FOREIGN KEY (`MonumentID`) REFERENCES `Monument` (`MonumentID`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `Monument_Category`
--
ALTER TABLE `Monument_Category`
  ADD CONSTRAINT `Monumentzo.Monument_Category.MonumentID` FOREIGN KEY (`MonumentID`) REFERENCES `Monument` (`MonumentID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `Monumentzo.Monument_Category.CategoryID` FOREIGN KEY (`CategoryID`) REFERENCES `Category` (`CategoryID`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `Monument_Image`
--
ALTER TABLE `Monument_Image`
  ADD CONSTRAINT `Monumentzo.Monument_Image.MonumentID` FOREIGN KEY (`MonumentID`) REFERENCES `Monument` (`MonumentID`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `Monument_TextTag`
--
ALTER TABLE `Monument_TextTag`
  ADD CONSTRAINT `Monumentzo.Monument_TextTag.MonumentID` FOREIGN KEY (`MonumentID`) REFERENCES `Monument` (`MonumentID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `Monumentzo.Monument_TextTag.TextTag` FOREIGN KEY (`TextTagID`) REFERENCES `TextTag` (`TextTagID`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `ReadList`
--
ALTER TABLE `ReadList`
  ADD CONSTRAINT `Monumentzo.ReadList.UserID` FOREIGN KEY (`UserID`) REFERENCES `User` (`UserID`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `VisitedList`
--
ALTER TABLE `VisitedList`
  ADD CONSTRAINT `Monumentzo.VisitedList.UserID` FOREIGN KEY (`UserID`) REFERENCES `User` (`UserID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `Monumentzo.VisitedList.MonumentID` FOREIGN KEY (`MonumentID`) REFERENCES `Monument` (`MonumentID`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `WishList`
--
ALTER TABLE `WishList`
  ADD CONSTRAINT `Monumentzo.WishList.MonumentID` FOREIGN KEY (`MonumentID`) REFERENCES `Monument` (`MonumentID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `Monumentzo.WishList.UserID` FOREIGN KEY (`UserID`) REFERENCES `User` (`UserID`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
