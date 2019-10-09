-- MySQL dump 10.13  Distrib 8.0.13, for Win64 (x86_64)
--
-- Host: apeldoornindata.nl    Database: apeldoornindata
-- ------------------------------------------------------
-- Server version	5.5.5-10.1.41-MariaDB-0+deb9u1

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
 SET NAMES utf8 ;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `gateway`
--

DROP TABLE IF EXISTS `gateway`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `gateway` (
  `Id` bigint(20) NOT NULL AUTO_INCREMENT,
  `Gateway` text NOT NULL,
  `Name` text NOT NULL,
  `Ch0` bigint(20) NOT NULL,
  `Ch1` bigint(20) NOT NULL,
  `Ch2` bigint(20) NOT NULL,
  `Ch3` bigint(20) NOT NULL,
  `Ch4` bigint(20) NOT NULL,
  `Ch5` bigint(20) NOT NULL,
  `Ch6` bigint(20) NOT NULL,
  `Ch7` bigint(20) NOT NULL,
  `Sf7` bigint(20) NOT NULL,
  `Sf8` bigint(20) NOT NULL,
  `Sf9` bigint(20) NOT NULL,
  `Sf10` bigint(20) NOT NULL,
  `Sf11` bigint(20) NOT NULL,
  `Sf12` bigint(20) NOT NULL,
  `Lastmessage` datetime NOT NULL,
  `Packets` bigint(20) NOT NULL DEFAULT '0',
  PRIMARY KEY (`Id`),
  UNIQUE KEY `Gateway_UNIQUE` (`Gateway`(50))
) ENGINE=MyISAM AUTO_INCREMENT=464 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `gpsgateway`
--

DROP TABLE IF EXISTS `gpsgateway`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `gpsgateway` (
  `Id` bigint(20) NOT NULL AUTO_INCREMENT,
  `Gpslocationid` bigint(20) NOT NULL,
  `Gwid` text NOT NULL,
  `Channel` int(11) NOT NULL,
  `Rssi` int(11) NOT NULL,
  `Snr` decimal(10,5) NOT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=MyISAM AUTO_INCREMENT=19461 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `gpslocation1`
--

DROP TABLE IF EXISTS `gpslocation1`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `gpslocation1` (
  `Id` bigint(20) NOT NULL AUTO_INCREMENT,
  `Moment` datetime NOT NULL,
  `Lat` decimal(10,5) NOT NULL,
  `Lon` decimal(10,5) NOT NULL,
  `Alt` decimal(10,5) NOT NULL,
  `Hdop` decimal(10,5) NOT NULL,
  PRIMARY KEY (`Id`),
  UNIQUE KEY `Moment_UNIQUE` (`Moment`),
  UNIQUE KEY `Id_UNIQUE` (`Id`)
) ENGINE=MyISAM AUTO_INCREMENT=4048796 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `gpslocation16`
--

DROP TABLE IF EXISTS `gpslocation16`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `gpslocation16` (
  `Id` bigint(20) NOT NULL AUTO_INCREMENT,
  `Moment` datetime NOT NULL,
  `Lat` decimal(10,5) NOT NULL,
  `Lon` decimal(10,5) NOT NULL,
  `Alt` decimal(10,5) NOT NULL,
  `Hdop` decimal(10,5) NOT NULL,
  `Speed` decimal(10,5) NOT NULL,
  `Direction` decimal(10,5) NOT NULL,
  PRIMARY KEY (`Id`),
  UNIQUE KEY `Moment_UNIQUE` (`Moment`),
  UNIQUE KEY `Id_UNIQUE` (`Id`)
) ENGINE=MyISAM AUTO_INCREMENT=3011 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `gpslocation2`
--

DROP TABLE IF EXISTS `gpslocation2`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `gpslocation2` (
  `Id` bigint(20) NOT NULL AUTO_INCREMENT,
  `Moment` datetime NOT NULL,
  `Lat` decimal(10,5) NOT NULL,
  `Lon` decimal(10,5) NOT NULL,
  `Alt` decimal(10,5) NOT NULL,
  `Hdop` decimal(10,5) NOT NULL,
  PRIMARY KEY (`Id`),
  UNIQUE KEY `Moment_UNIQUE` (`Moment`),
  UNIQUE KEY `Id_UNIQUE` (`Id`)
) ENGINE=MyISAM AUTO_INCREMENT=55923 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `gpslocation67`
--

DROP TABLE IF EXISTS `gpslocation67`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `gpslocation67` (
  `Id` bigint(20) NOT NULL AUTO_INCREMENT,
  `Moment` datetime NOT NULL,
  `Lat` decimal(10,5) NOT NULL,
  `Lon` decimal(10,5) NOT NULL,
  `Alt` decimal(10,5) NOT NULL,
  `Hdop` decimal(10,5) NOT NULL,
  `Speed` decimal(10,5) NOT NULL,
  `Direction` decimal(10,5) NOT NULL,
  PRIMARY KEY (`Id`),
  UNIQUE KEY `Moment_UNIQUE` (`Moment`),
  UNIQUE KEY `Id_UNIQUE` (`Id`)
) ENGINE=MyISAM AUTO_INCREMENT=45487 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `location`
--

DROP TABLE IF EXISTS `location`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `location` (
  `Id` bigint(20) NOT NULL AUTO_INCREMENT,
  `Nodeid` bigint(20) NOT NULL,
  `Moment` datetime NOT NULL,
  `Lat` decimal(10,5) NOT NULL,
  `Lon` decimal(10,5) NOT NULL,
  `Alt` decimal(10,5) NOT NULL,
  `Speed` decimal(10,5) NOT NULL,
  `Heading` decimal(10,5) NOT NULL,
  `locationcol` varchar(45) NOT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `locationnode125`
--

DROP TABLE IF EXISTS `locationnode125`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `locationnode125` (
  `Id` bigint(11) unsigned NOT NULL AUTO_INCREMENT,
  `Moment` datetime DEFAULT NULL,
  `Lat` decimal(10,5) DEFAULT NULL,
  `Lon` decimal(10,5) DEFAULT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=804 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `locationnode126`
--

DROP TABLE IF EXISTS `locationnode126`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `locationnode126` (
  `Id` bigint(11) unsigned NOT NULL AUTO_INCREMENT,
  `Moment` datetime DEFAULT NULL,
  `Lat` decimal(10,5) DEFAULT NULL,
  `Lon` decimal(10,5) DEFAULT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=1652 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `locationnode127`
--

DROP TABLE IF EXISTS `locationnode127`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `locationnode127` (
  `Id` bigint(11) unsigned NOT NULL AUTO_INCREMENT,
  `Moment` datetime DEFAULT NULL,
  `Lat` decimal(10,5) DEFAULT NULL,
  `Lon` decimal(10,5) DEFAULT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=105 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `locationnode128`
--

DROP TABLE IF EXISTS `locationnode128`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `locationnode128` (
  `Id` bigint(11) unsigned NOT NULL AUTO_INCREMENT,
  `Moment` datetime DEFAULT NULL,
  `Lat` decimal(10,5) DEFAULT NULL,
  `Lon` decimal(10,5) DEFAULT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=93 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `locationnode129`
--

DROP TABLE IF EXISTS `locationnode129`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `locationnode129` (
  `Id` bigint(11) unsigned NOT NULL AUTO_INCREMENT,
  `Moment` datetime DEFAULT NULL,
  `Lat` decimal(10,5) DEFAULT NULL,
  `Lon` decimal(10,5) DEFAULT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=81 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `locationnode130`
--

DROP TABLE IF EXISTS `locationnode130`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `locationnode130` (
  `Id` bigint(11) unsigned NOT NULL AUTO_INCREMENT,
  `Moment` datetime DEFAULT NULL,
  `Lat` decimal(10,5) DEFAULT NULL,
  `Lon` decimal(10,5) DEFAULT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=424 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `locationnode131`
--

DROP TABLE IF EXISTS `locationnode131`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `locationnode131` (
  `Id` bigint(11) unsigned NOT NULL AUTO_INCREMENT,
  `Moment` datetime DEFAULT NULL,
  `Lat` decimal(10,5) DEFAULT NULL,
  `Lon` decimal(10,5) DEFAULT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=94 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `locationnode132`
--

DROP TABLE IF EXISTS `locationnode132`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `locationnode132` (
  `Id` bigint(11) unsigned NOT NULL AUTO_INCREMENT,
  `Moment` datetime DEFAULT NULL,
  `Lat` decimal(10,5) DEFAULT NULL,
  `Lon` decimal(10,5) DEFAULT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=146 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `locationnode133`
--

DROP TABLE IF EXISTS `locationnode133`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `locationnode133` (
  `Id` bigint(11) unsigned NOT NULL AUTO_INCREMENT,
  `Moment` datetime DEFAULT NULL,
  `Lat` decimal(10,5) DEFAULT NULL,
  `Lon` decimal(10,5) DEFAULT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=83 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `locationnode134`
--

DROP TABLE IF EXISTS `locationnode134`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `locationnode134` (
  `Id` bigint(11) unsigned NOT NULL AUTO_INCREMENT,
  `Moment` datetime DEFAULT NULL,
  `Lat` decimal(10,5) DEFAULT NULL,
  `Lon` decimal(10,5) DEFAULT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `locationnode135`
--

DROP TABLE IF EXISTS `locationnode135`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `locationnode135` (
  `Id` bigint(11) unsigned NOT NULL AUTO_INCREMENT,
  `Moment` datetime DEFAULT NULL,
  `Lat` decimal(10,5) DEFAULT NULL,
  `Lon` decimal(10,5) DEFAULT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `locationnode136`
--

DROP TABLE IF EXISTS `locationnode136`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `locationnode136` (
  `Id` bigint(11) unsigned NOT NULL AUTO_INCREMENT,
  `Moment` datetime DEFAULT NULL,
  `Lat` decimal(10,5) DEFAULT NULL,
  `Lon` decimal(10,5) DEFAULT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `locationnode137`
--

DROP TABLE IF EXISTS `locationnode137`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `locationnode137` (
  `Id` bigint(11) unsigned NOT NULL AUTO_INCREMENT,
  `Moment` datetime DEFAULT NULL,
  `Lat` decimal(10,5) DEFAULT NULL,
  `Lon` decimal(10,5) DEFAULT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=116 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `locationnode138`
--

DROP TABLE IF EXISTS `locationnode138`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `locationnode138` (
  `Id` bigint(11) unsigned NOT NULL AUTO_INCREMENT,
  `Moment` datetime DEFAULT NULL,
  `Lat` decimal(10,5) DEFAULT NULL,
  `Lon` decimal(10,5) DEFAULT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=67 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `loraraw`
--

DROP TABLE IF EXISTS `loraraw`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `loraraw` (
  `Id` bigint(20) NOT NULL AUTO_INCREMENT,
  `Data` mediumtext NOT NULL,
  `Moment` datetime NOT NULL,
  `Processed` tinyint(4) NOT NULL DEFAULT '0',
  `Nodeid` bigint(20) NOT NULL DEFAULT '0',
  PRIMARY KEY (`Id`),
  KEY `nodeid` (`Nodeid`),
  KEY `processed` (`Processed`),
  KEY `moment` (`Moment`)
) ENGINE=MyISAM AUTO_INCREMENT=4812655 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `lorarawttnmapper`
--

DROP TABLE IF EXISTS `lorarawttnmapper`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `lorarawttnmapper` (
  `Id` bigint(20) NOT NULL AUTO_INCREMENT,
  `Data` mediumtext NOT NULL,
  `Moment` datetime NOT NULL,
  `Processed` tinyint(4) NOT NULL DEFAULT '0',
  `Nodeid` bigint(20) NOT NULL DEFAULT '0',
  PRIMARY KEY (`Id`),
  KEY `nodeid` (`Nodeid`),
  KEY `processed` (`Processed`),
  KEY `moment` (`Moment`)
) ENGINE=MyISAM AUTO_INCREMENT=1879750 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `lorarawttnmappergateway`
--

DROP TABLE IF EXISTS `lorarawttnmappergateway`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `lorarawttnmappergateway` (
  `Id` bigint(20) NOT NULL AUTO_INCREMENT,
  `Gwid` text,
  `Lastmessage` datetime DEFAULT NULL,
  `Lat` decimal(10,5) DEFAULT NULL,
  `Lon` decimal(10,5) DEFAULT NULL,
  `Alt` decimal(10,5) DEFAULT NULL,
  `Ch0` bigint(20) DEFAULT '0',
  `Ch1` bigint(20) DEFAULT '0',
  `Ch2` bigint(20) DEFAULT '0',
  `Ch3` bigint(20) DEFAULT '0',
  `Ch4` bigint(20) DEFAULT '0',
  `Ch5` bigint(20) DEFAULT '0',
  `Ch6` bigint(20) DEFAULT '0',
  `Ch7` bigint(20) DEFAULT '0',
  PRIMARY KEY (`Id`),
  UNIQUE KEY `Gwid` (`Gwid`(50))
) ENGINE=InnoDB AUTO_INCREMENT=3471386 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `lorarawttnmapperlocation`
--

DROP TABLE IF EXISTS `lorarawttnmapperlocation`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `lorarawttnmapperlocation` (
  `Id` bigint(11) unsigned NOT NULL AUTO_INCREMENT,
  `Moment` datetime DEFAULT NULL,
  `Lat` decimal(10,5) DEFAULT NULL,
  `Lon` decimal(10,5) DEFAULT NULL,
  `Alt` decimal(10,5) DEFAULT NULL,
  `Rssi` int(11) DEFAULT NULL,
  `Rawid` bigint(20) DEFAULT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `lorarawttnmapperlocationgwrelation`
--

DROP TABLE IF EXISTS `lorarawttnmapperlocationgwrelation`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `lorarawttnmapperlocationgwrelation` (
  `Id` bigint(20) NOT NULL AUTO_INCREMENT,
  `Gwid` bigint(20) DEFAULT NULL,
  `Location` bigint(20) DEFAULT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `measurement`
--

DROP TABLE IF EXISTS `measurement`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `measurement` (
  `Id` bigint(20) NOT NULL AUTO_INCREMENT,
  `Point` bigint(20) NOT NULL,
  `Moment` datetime NOT NULL,
  `Measurevalue` decimal(10,5) NOT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=MyISAM AUTO_INCREMENT=205 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `measurement1`
--

DROP TABLE IF EXISTS `measurement1`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `measurement1` (
  `Moment` datetime NOT NULL,
  `Tagvalue` decimal(10,5) NOT NULL,
  PRIMARY KEY (`Moment`),
  UNIQUE KEY `Index_2` (`Moment`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `measurement10`
--

DROP TABLE IF EXISTS `measurement10`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `measurement10` (
  `Moment` datetime NOT NULL,
  `Tagvalue` decimal(10,5) NOT NULL,
  PRIMARY KEY (`Moment`),
  UNIQUE KEY `Index_2` (`Moment`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `measurement100`
--

DROP TABLE IF EXISTS `measurement100`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `measurement100` (
  `Moment` datetime NOT NULL,
  `Tagvalue` decimal(10,5) NOT NULL,
  PRIMARY KEY (`Moment`),
  UNIQUE KEY `Index_2` (`Moment`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `measurement101`
--

DROP TABLE IF EXISTS `measurement101`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `measurement101` (
  `Moment` datetime NOT NULL,
  `Tagvalue` decimal(10,5) NOT NULL,
  PRIMARY KEY (`Moment`),
  UNIQUE KEY `Index_2` (`Moment`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `measurement102`
--

DROP TABLE IF EXISTS `measurement102`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `measurement102` (
  `Moment` datetime NOT NULL,
  `Tagvalue` decimal(10,5) NOT NULL,
  PRIMARY KEY (`Moment`),
  UNIQUE KEY `Index_2` (`Moment`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `measurement103`
--

DROP TABLE IF EXISTS `measurement103`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `measurement103` (
  `Moment` datetime NOT NULL,
  `Tagvalue` decimal(10,5) NOT NULL,
  PRIMARY KEY (`Moment`),
  UNIQUE KEY `Index_2` (`Moment`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `measurement104`
--

DROP TABLE IF EXISTS `measurement104`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `measurement104` (
  `Moment` datetime NOT NULL,
  `Tagvalue` decimal(10,5) NOT NULL,
  PRIMARY KEY (`Moment`),
  UNIQUE KEY `Index_2` (`Moment`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `measurement105`
--

DROP TABLE IF EXISTS `measurement105`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `measurement105` (
  `Moment` datetime NOT NULL,
  `Tagvalue` decimal(10,5) NOT NULL,
  PRIMARY KEY (`Moment`),
  UNIQUE KEY `Index_2` (`Moment`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `measurement106`
--

DROP TABLE IF EXISTS `measurement106`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `measurement106` (
  `Moment` datetime NOT NULL,
  `Tagvalue` decimal(10,5) NOT NULL,
  PRIMARY KEY (`Moment`),
  UNIQUE KEY `Index_2` (`Moment`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `measurement107`
--

DROP TABLE IF EXISTS `measurement107`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `measurement107` (
  `Moment` datetime NOT NULL,
  `Tagvalue` decimal(10,5) NOT NULL,
  PRIMARY KEY (`Moment`),
  UNIQUE KEY `Index_2` (`Moment`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `measurement108`
--

DROP TABLE IF EXISTS `measurement108`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `measurement108` (
  `Moment` datetime NOT NULL,
  `Tagvalue` decimal(10,5) NOT NULL,
  PRIMARY KEY (`Moment`),
  UNIQUE KEY `Index_2` (`Moment`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `measurement109`
--

DROP TABLE IF EXISTS `measurement109`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `measurement109` (
  `Moment` datetime NOT NULL,
  `Tagvalue` decimal(10,5) NOT NULL,
  PRIMARY KEY (`Moment`),
  UNIQUE KEY `Index_2` (`Moment`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `measurement11`
--

DROP TABLE IF EXISTS `measurement11`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `measurement11` (
  `Moment` datetime NOT NULL,
  `Tagvalue` decimal(10,5) NOT NULL,
  PRIMARY KEY (`Moment`),
  UNIQUE KEY `Index_2` (`Moment`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `measurement110`
--

DROP TABLE IF EXISTS `measurement110`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `measurement110` (
  `Moment` datetime NOT NULL,
  `Tagvalue` decimal(10,5) NOT NULL,
  PRIMARY KEY (`Moment`),
  UNIQUE KEY `Index_2` (`Moment`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `measurement111`
--

DROP TABLE IF EXISTS `measurement111`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `measurement111` (
  `Moment` datetime NOT NULL,
  `Tagvalue` decimal(10,5) NOT NULL,
  PRIMARY KEY (`Moment`),
  UNIQUE KEY `Index_2` (`Moment`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `measurement112`
--

DROP TABLE IF EXISTS `measurement112`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `measurement112` (
  `Moment` datetime NOT NULL,
  `Tagvalue` decimal(10,5) NOT NULL,
  PRIMARY KEY (`Moment`),
  UNIQUE KEY `Index_2` (`Moment`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `measurement113`
--

DROP TABLE IF EXISTS `measurement113`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `measurement113` (
  `Moment` datetime NOT NULL,
  `Tagvalue` decimal(10,5) NOT NULL,
  PRIMARY KEY (`Moment`),
  UNIQUE KEY `Index_2` (`Moment`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `measurement114`
--

DROP TABLE IF EXISTS `measurement114`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `measurement114` (
  `Moment` datetime NOT NULL,
  `Tagvalue` decimal(10,5) NOT NULL,
  PRIMARY KEY (`Moment`),
  UNIQUE KEY `Index_2` (`Moment`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `measurement115`
--

DROP TABLE IF EXISTS `measurement115`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `measurement115` (
  `Moment` datetime NOT NULL,
  `Tagvalue` decimal(10,5) NOT NULL,
  PRIMARY KEY (`Moment`),
  UNIQUE KEY `Index_2` (`Moment`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `measurement116`
--

DROP TABLE IF EXISTS `measurement116`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `measurement116` (
  `Moment` datetime NOT NULL,
  `Tagvalue` decimal(10,5) NOT NULL,
  PRIMARY KEY (`Moment`),
  UNIQUE KEY `Index_2` (`Moment`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `measurement117`
--

DROP TABLE IF EXISTS `measurement117`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `measurement117` (
  `Moment` datetime NOT NULL,
  `Tagvalue` decimal(10,5) NOT NULL,
  PRIMARY KEY (`Moment`),
  UNIQUE KEY `Index_2` (`Moment`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `measurement118`
--

DROP TABLE IF EXISTS `measurement118`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `measurement118` (
  `Moment` datetime NOT NULL,
  `Tagvalue` decimal(10,5) NOT NULL,
  PRIMARY KEY (`Moment`),
  UNIQUE KEY `Index_2` (`Moment`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `measurement119`
--

DROP TABLE IF EXISTS `measurement119`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `measurement119` (
  `Moment` datetime NOT NULL,
  `Tagvalue` decimal(10,5) NOT NULL,
  PRIMARY KEY (`Moment`),
  UNIQUE KEY `Index_2` (`Moment`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `measurement12`
--

DROP TABLE IF EXISTS `measurement12`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `measurement12` (
  `Moment` datetime NOT NULL,
  `Tagvalue` decimal(10,5) NOT NULL,
  PRIMARY KEY (`Moment`),
  UNIQUE KEY `Index_2` (`Moment`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `measurement120`
--

DROP TABLE IF EXISTS `measurement120`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `measurement120` (
  `Moment` datetime NOT NULL,
  `Tagvalue` decimal(10,5) NOT NULL,
  PRIMARY KEY (`Moment`),
  UNIQUE KEY `Index_2` (`Moment`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `measurement121`
--

DROP TABLE IF EXISTS `measurement121`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `measurement121` (
  `Moment` datetime NOT NULL,
  `Tagvalue` decimal(10,5) NOT NULL,
  PRIMARY KEY (`Moment`),
  UNIQUE KEY `Index_2` (`Moment`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `measurement122`
--

DROP TABLE IF EXISTS `measurement122`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `measurement122` (
  `Moment` datetime NOT NULL,
  `Tagvalue` decimal(10,5) NOT NULL,
  PRIMARY KEY (`Moment`),
  UNIQUE KEY `Index_2` (`Moment`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `measurement123`
--

DROP TABLE IF EXISTS `measurement123`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `measurement123` (
  `Moment` datetime NOT NULL,
  `Tagvalue` decimal(10,5) NOT NULL,
  PRIMARY KEY (`Moment`),
  UNIQUE KEY `Index_2` (`Moment`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `measurement124`
--

DROP TABLE IF EXISTS `measurement124`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `measurement124` (
  `Moment` datetime NOT NULL,
  `Tagvalue` decimal(10,5) NOT NULL,
  PRIMARY KEY (`Moment`),
  UNIQUE KEY `Index_2` (`Moment`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `measurement125`
--

DROP TABLE IF EXISTS `measurement125`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `measurement125` (
  `Moment` datetime NOT NULL,
  `Tagvalue` decimal(10,5) NOT NULL,
  PRIMARY KEY (`Moment`),
  UNIQUE KEY `Index_2` (`Moment`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `measurement126`
--

DROP TABLE IF EXISTS `measurement126`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `measurement126` (
  `Moment` datetime NOT NULL,
  `Tagvalue` decimal(10,5) NOT NULL,
  PRIMARY KEY (`Moment`),
  UNIQUE KEY `Index_2` (`Moment`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `measurement127`
--

DROP TABLE IF EXISTS `measurement127`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `measurement127` (
  `Moment` datetime NOT NULL,
  `Tagvalue` decimal(10,5) NOT NULL,
  PRIMARY KEY (`Moment`),
  UNIQUE KEY `Index_2` (`Moment`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `measurement128`
--

DROP TABLE IF EXISTS `measurement128`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `measurement128` (
  `Moment` datetime NOT NULL,
  `Tagvalue` decimal(10,5) NOT NULL,
  PRIMARY KEY (`Moment`),
  UNIQUE KEY `Index_2` (`Moment`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `measurement129`
--

DROP TABLE IF EXISTS `measurement129`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `measurement129` (
  `Moment` datetime NOT NULL,
  `Tagvalue` decimal(10,5) NOT NULL,
  PRIMARY KEY (`Moment`),
  UNIQUE KEY `Index_2` (`Moment`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `measurement13`
--

DROP TABLE IF EXISTS `measurement13`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `measurement13` (
  `Moment` datetime NOT NULL,
  `Tagvalue` decimal(10,5) NOT NULL,
  PRIMARY KEY (`Moment`),
  UNIQUE KEY `Index_2` (`Moment`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `measurement130`
--

DROP TABLE IF EXISTS `measurement130`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `measurement130` (
  `Moment` datetime NOT NULL,
  `Tagvalue` decimal(10,5) NOT NULL,
  PRIMARY KEY (`Moment`),
  UNIQUE KEY `Index_2` (`Moment`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `measurement131`
--

DROP TABLE IF EXISTS `measurement131`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `measurement131` (
  `Moment` datetime NOT NULL,
  `Tagvalue` decimal(10,5) NOT NULL,
  PRIMARY KEY (`Moment`),
  UNIQUE KEY `Index_2` (`Moment`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `measurement132`
--

DROP TABLE IF EXISTS `measurement132`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `measurement132` (
  `Moment` datetime NOT NULL,
  `Tagvalue` decimal(10,5) NOT NULL,
  PRIMARY KEY (`Moment`),
  UNIQUE KEY `Index_2` (`Moment`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `measurement133`
--

DROP TABLE IF EXISTS `measurement133`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `measurement133` (
  `Moment` datetime NOT NULL,
  `Tagvalue` decimal(10,5) NOT NULL,
  PRIMARY KEY (`Moment`),
  UNIQUE KEY `Index_2` (`Moment`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `measurement134`
--

DROP TABLE IF EXISTS `measurement134`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `measurement134` (
  `Moment` datetime NOT NULL,
  `Tagvalue` decimal(10,5) NOT NULL,
  PRIMARY KEY (`Moment`),
  UNIQUE KEY `Index_2` (`Moment`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `measurement135`
--

DROP TABLE IF EXISTS `measurement135`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `measurement135` (
  `Moment` datetime NOT NULL,
  `Tagvalue` decimal(10,5) NOT NULL,
  PRIMARY KEY (`Moment`),
  UNIQUE KEY `Index_2` (`Moment`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `measurement136`
--

DROP TABLE IF EXISTS `measurement136`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `measurement136` (
  `Moment` datetime NOT NULL,
  `Tagvalue` decimal(10,5) NOT NULL,
  PRIMARY KEY (`Moment`),
  UNIQUE KEY `Index_2` (`Moment`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `measurement137`
--

DROP TABLE IF EXISTS `measurement137`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `measurement137` (
  `Moment` datetime NOT NULL,
  `Tagvalue` decimal(10,5) NOT NULL,
  PRIMARY KEY (`Moment`),
  UNIQUE KEY `Index_2` (`Moment`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `measurement138`
--

DROP TABLE IF EXISTS `measurement138`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `measurement138` (
  `Moment` datetime NOT NULL,
  `Tagvalue` decimal(10,5) NOT NULL,
  PRIMARY KEY (`Moment`),
  UNIQUE KEY `Index_2` (`Moment`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `measurement139`
--

DROP TABLE IF EXISTS `measurement139`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `measurement139` (
  `Moment` datetime NOT NULL,
  `Tagvalue` decimal(10,5) NOT NULL,
  PRIMARY KEY (`Moment`),
  UNIQUE KEY `Index_2` (`Moment`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `measurement14`
--

DROP TABLE IF EXISTS `measurement14`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `measurement14` (
  `Moment` datetime NOT NULL,
  `Tagvalue` decimal(10,5) NOT NULL,
  PRIMARY KEY (`Moment`),
  UNIQUE KEY `Index_2` (`Moment`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `measurement140`
--

DROP TABLE IF EXISTS `measurement140`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `measurement140` (
  `Moment` datetime NOT NULL,
  `Tagvalue` decimal(10,5) NOT NULL,
  PRIMARY KEY (`Moment`),
  UNIQUE KEY `Index_2` (`Moment`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `measurement141`
--

DROP TABLE IF EXISTS `measurement141`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `measurement141` (
  `Moment` datetime NOT NULL,
  `Tagvalue` decimal(10,5) NOT NULL,
  PRIMARY KEY (`Moment`),
  UNIQUE KEY `Index_2` (`Moment`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `measurement142`
--

DROP TABLE IF EXISTS `measurement142`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `measurement142` (
  `Moment` datetime NOT NULL,
  `Tagvalue` decimal(10,5) NOT NULL,
  PRIMARY KEY (`Moment`),
  UNIQUE KEY `Index_2` (`Moment`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `measurement143`
--

DROP TABLE IF EXISTS `measurement143`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `measurement143` (
  `Moment` datetime NOT NULL,
  `Tagvalue` decimal(10,5) NOT NULL,
  PRIMARY KEY (`Moment`),
  UNIQUE KEY `Index_2` (`Moment`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `measurement144`
--

DROP TABLE IF EXISTS `measurement144`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `measurement144` (
  `Moment` datetime NOT NULL,
  `Tagvalue` decimal(10,5) NOT NULL,
  PRIMARY KEY (`Moment`),
  UNIQUE KEY `Index_2` (`Moment`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `measurement145`
--

DROP TABLE IF EXISTS `measurement145`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `measurement145` (
  `Moment` datetime NOT NULL,
  `Tagvalue` decimal(10,5) NOT NULL,
  PRIMARY KEY (`Moment`),
  UNIQUE KEY `Index_2` (`Moment`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `measurement146`
--

DROP TABLE IF EXISTS `measurement146`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `measurement146` (
  `Moment` datetime NOT NULL,
  `Tagvalue` decimal(10,5) NOT NULL,
  PRIMARY KEY (`Moment`),
  UNIQUE KEY `Index_2` (`Moment`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `measurement147`
--

DROP TABLE IF EXISTS `measurement147`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `measurement147` (
  `Moment` datetime NOT NULL,
  `Tagvalue` decimal(10,5) NOT NULL,
  PRIMARY KEY (`Moment`),
  UNIQUE KEY `Index_2` (`Moment`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `measurement148`
--

DROP TABLE IF EXISTS `measurement148`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `measurement148` (
  `Moment` datetime NOT NULL,
  `Tagvalue` decimal(10,5) NOT NULL,
  PRIMARY KEY (`Moment`),
  UNIQUE KEY `Index_2` (`Moment`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `measurement149`
--

DROP TABLE IF EXISTS `measurement149`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `measurement149` (
  `Moment` datetime NOT NULL,
  `Tagvalue` decimal(10,5) NOT NULL,
  PRIMARY KEY (`Moment`),
  UNIQUE KEY `Index_2` (`Moment`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `measurement15`
--

DROP TABLE IF EXISTS `measurement15`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `measurement15` (
  `Moment` datetime NOT NULL,
  `Tagvalue` decimal(10,5) NOT NULL,
  PRIMARY KEY (`Moment`),
  UNIQUE KEY `Index_2` (`Moment`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `measurement150`
--

DROP TABLE IF EXISTS `measurement150`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `measurement150` (
  `Moment` datetime NOT NULL,
  `Tagvalue` decimal(10,5) NOT NULL,
  PRIMARY KEY (`Moment`),
  UNIQUE KEY `Index_2` (`Moment`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `measurement151`
--

DROP TABLE IF EXISTS `measurement151`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `measurement151` (
  `Moment` datetime NOT NULL,
  `Tagvalue` decimal(10,5) NOT NULL,
  PRIMARY KEY (`Moment`),
  UNIQUE KEY `Index_2` (`Moment`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `measurement152`
--

DROP TABLE IF EXISTS `measurement152`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `measurement152` (
  `Moment` datetime NOT NULL,
  `Tagvalue` decimal(10,5) NOT NULL,
  PRIMARY KEY (`Moment`),
  UNIQUE KEY `Index_2` (`Moment`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `measurement153`
--

DROP TABLE IF EXISTS `measurement153`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `measurement153` (
  `Moment` datetime NOT NULL,
  `Tagvalue` decimal(10,5) NOT NULL,
  PRIMARY KEY (`Moment`),
  UNIQUE KEY `Index_2` (`Moment`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `measurement154`
--

DROP TABLE IF EXISTS `measurement154`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `measurement154` (
  `Moment` datetime NOT NULL,
  `Tagvalue` decimal(10,5) NOT NULL,
  PRIMARY KEY (`Moment`),
  UNIQUE KEY `Index_2` (`Moment`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `measurement155`
--

DROP TABLE IF EXISTS `measurement155`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `measurement155` (
  `Moment` datetime NOT NULL,
  `Tagvalue` decimal(10,5) NOT NULL,
  PRIMARY KEY (`Moment`),
  UNIQUE KEY `Index_2` (`Moment`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `measurement156`
--

DROP TABLE IF EXISTS `measurement156`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `measurement156` (
  `Moment` datetime NOT NULL,
  `Tagvalue` decimal(10,5) NOT NULL,
  PRIMARY KEY (`Moment`),
  UNIQUE KEY `Index_2` (`Moment`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `measurement157`
--

DROP TABLE IF EXISTS `measurement157`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `measurement157` (
  `Moment` datetime NOT NULL,
  `Tagvalue` decimal(10,5) NOT NULL,
  PRIMARY KEY (`Moment`),
  UNIQUE KEY `Index_2` (`Moment`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `measurement158`
--

DROP TABLE IF EXISTS `measurement158`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `measurement158` (
  `Moment` datetime NOT NULL,
  `Tagvalue` decimal(10,5) NOT NULL,
  PRIMARY KEY (`Moment`),
  UNIQUE KEY `Index_2` (`Moment`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `measurement159`
--

DROP TABLE IF EXISTS `measurement159`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `measurement159` (
  `Moment` datetime NOT NULL,
  `Tagvalue` decimal(10,5) NOT NULL,
  PRIMARY KEY (`Moment`),
  UNIQUE KEY `Index_2` (`Moment`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `measurement16`
--

DROP TABLE IF EXISTS `measurement16`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `measurement16` (
  `Moment` datetime NOT NULL,
  `Tagvalue` decimal(10,5) NOT NULL,
  PRIMARY KEY (`Moment`),
  UNIQUE KEY `Index_2` (`Moment`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `measurement160`
--

DROP TABLE IF EXISTS `measurement160`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `measurement160` (
  `Moment` datetime NOT NULL,
  `Tagvalue` decimal(10,5) NOT NULL,
  PRIMARY KEY (`Moment`),
  UNIQUE KEY `Index_2` (`Moment`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `measurement161`
--

DROP TABLE IF EXISTS `measurement161`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `measurement161` (
  `Moment` datetime NOT NULL,
  `Tagvalue` decimal(10,5) NOT NULL,
  PRIMARY KEY (`Moment`),
  UNIQUE KEY `Index_2` (`Moment`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `measurement162`
--

DROP TABLE IF EXISTS `measurement162`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `measurement162` (
  `Moment` datetime NOT NULL,
  `Tagvalue` decimal(10,5) NOT NULL,
  PRIMARY KEY (`Moment`),
  UNIQUE KEY `Index_2` (`Moment`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `measurement163`
--

DROP TABLE IF EXISTS `measurement163`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `measurement163` (
  `Moment` datetime NOT NULL,
  `Tagvalue` decimal(10,5) NOT NULL,
  PRIMARY KEY (`Moment`),
  UNIQUE KEY `Index_2` (`Moment`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `measurement164`
--

DROP TABLE IF EXISTS `measurement164`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `measurement164` (
  `Moment` datetime NOT NULL,
  `Tagvalue` decimal(10,5) NOT NULL,
  PRIMARY KEY (`Moment`),
  UNIQUE KEY `Index_2` (`Moment`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `measurement165`
--

DROP TABLE IF EXISTS `measurement165`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `measurement165` (
  `Moment` datetime NOT NULL,
  `Tagvalue` decimal(10,5) NOT NULL,
  PRIMARY KEY (`Moment`),
  UNIQUE KEY `Index_2` (`Moment`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `measurement166`
--

DROP TABLE IF EXISTS `measurement166`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `measurement166` (
  `Moment` datetime NOT NULL,
  `Tagvalue` decimal(10,5) NOT NULL,
  PRIMARY KEY (`Moment`),
  UNIQUE KEY `Index_2` (`Moment`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `measurement167`
--

DROP TABLE IF EXISTS `measurement167`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `measurement167` (
  `Moment` datetime NOT NULL,
  `Tagvalue` decimal(10,5) NOT NULL,
  PRIMARY KEY (`Moment`),
  UNIQUE KEY `Index_2` (`Moment`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `measurement168`
--

DROP TABLE IF EXISTS `measurement168`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `measurement168` (
  `Moment` datetime NOT NULL,
  `Tagvalue` decimal(10,5) NOT NULL,
  PRIMARY KEY (`Moment`),
  UNIQUE KEY `Index_2` (`Moment`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `measurement169`
--

DROP TABLE IF EXISTS `measurement169`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `measurement169` (
  `Moment` datetime NOT NULL,
  `Tagvalue` decimal(10,5) NOT NULL,
  PRIMARY KEY (`Moment`),
  UNIQUE KEY `Index_2` (`Moment`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `measurement17`
--

DROP TABLE IF EXISTS `measurement17`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `measurement17` (
  `Moment` datetime NOT NULL,
  `Tagvalue` decimal(10,5) NOT NULL,
  PRIMARY KEY (`Moment`),
  UNIQUE KEY `Index_2` (`Moment`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `measurement170`
--

DROP TABLE IF EXISTS `measurement170`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `measurement170` (
  `Moment` datetime NOT NULL,
  `Tagvalue` decimal(10,5) NOT NULL,
  PRIMARY KEY (`Moment`),
  UNIQUE KEY `Index_2` (`Moment`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `measurement171`
--

DROP TABLE IF EXISTS `measurement171`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `measurement171` (
  `Moment` datetime NOT NULL,
  `Tagvalue` decimal(10,5) NOT NULL,
  PRIMARY KEY (`Moment`),
  UNIQUE KEY `Index_2` (`Moment`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `measurement172`
--

DROP TABLE IF EXISTS `measurement172`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `measurement172` (
  `Moment` datetime NOT NULL,
  `Tagvalue` decimal(10,5) NOT NULL,
  PRIMARY KEY (`Moment`),
  UNIQUE KEY `Index_2` (`Moment`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `measurement173`
--

DROP TABLE IF EXISTS `measurement173`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `measurement173` (
  `Moment` datetime NOT NULL,
  `Tagvalue` decimal(10,5) NOT NULL,
  PRIMARY KEY (`Moment`),
  UNIQUE KEY `Index_2` (`Moment`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `measurement174`
--

DROP TABLE IF EXISTS `measurement174`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `measurement174` (
  `Moment` datetime NOT NULL,
  `Tagvalue` decimal(10,5) NOT NULL,
  PRIMARY KEY (`Moment`),
  UNIQUE KEY `Index_2` (`Moment`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `measurement175`
--

DROP TABLE IF EXISTS `measurement175`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `measurement175` (
  `Moment` datetime NOT NULL,
  `Tagvalue` decimal(10,5) NOT NULL,
  PRIMARY KEY (`Moment`),
  UNIQUE KEY `Index_2` (`Moment`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `measurement176`
--

DROP TABLE IF EXISTS `measurement176`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `measurement176` (
  `Moment` datetime NOT NULL,
  `Tagvalue` decimal(10,5) NOT NULL,
  PRIMARY KEY (`Moment`),
  UNIQUE KEY `Index_2` (`Moment`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `measurement177`
--

DROP TABLE IF EXISTS `measurement177`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `measurement177` (
  `Moment` datetime NOT NULL,
  `Tagvalue` decimal(10,5) NOT NULL,
  PRIMARY KEY (`Moment`),
  UNIQUE KEY `Index_2` (`Moment`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `measurement178`
--

DROP TABLE IF EXISTS `measurement178`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `measurement178` (
  `Moment` datetime NOT NULL,
  `Tagvalue` decimal(10,5) NOT NULL,
  PRIMARY KEY (`Moment`),
  UNIQUE KEY `Index_2` (`Moment`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `measurement179`
--

DROP TABLE IF EXISTS `measurement179`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `measurement179` (
  `Moment` datetime NOT NULL,
  `Tagvalue` decimal(10,5) NOT NULL,
  PRIMARY KEY (`Moment`),
  UNIQUE KEY `Index_2` (`Moment`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `measurement18`
--

DROP TABLE IF EXISTS `measurement18`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `measurement18` (
  `Moment` datetime NOT NULL,
  `Tagvalue` decimal(10,5) NOT NULL,
  PRIMARY KEY (`Moment`),
  UNIQUE KEY `Index_2` (`Moment`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `measurement180`
--

DROP TABLE IF EXISTS `measurement180`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `measurement180` (
  `Moment` datetime NOT NULL,
  `Tagvalue` decimal(10,5) NOT NULL,
  PRIMARY KEY (`Moment`),
  UNIQUE KEY `Index_2` (`Moment`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `measurement181`
--

DROP TABLE IF EXISTS `measurement181`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `measurement181` (
  `Moment` datetime NOT NULL,
  `Tagvalue` decimal(10,5) NOT NULL,
  PRIMARY KEY (`Moment`),
  UNIQUE KEY `Index_2` (`Moment`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `measurement182`
--

DROP TABLE IF EXISTS `measurement182`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `measurement182` (
  `Moment` datetime NOT NULL,
  `Tagvalue` decimal(10,5) NOT NULL,
  PRIMARY KEY (`Moment`),
  UNIQUE KEY `Index_2` (`Moment`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `measurement183`
--

DROP TABLE IF EXISTS `measurement183`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `measurement183` (
  `Moment` datetime NOT NULL,
  `Tagvalue` decimal(10,5) NOT NULL,
  PRIMARY KEY (`Moment`),
  UNIQUE KEY `Index_2` (`Moment`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `measurement184`
--

DROP TABLE IF EXISTS `measurement184`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `measurement184` (
  `Moment` datetime NOT NULL,
  `Tagvalue` decimal(10,5) NOT NULL,
  PRIMARY KEY (`Moment`),
  UNIQUE KEY `Index_2` (`Moment`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `measurement185`
--

DROP TABLE IF EXISTS `measurement185`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `measurement185` (
  `Moment` datetime NOT NULL,
  `Tagvalue` decimal(10,5) NOT NULL,
  PRIMARY KEY (`Moment`),
  UNIQUE KEY `Index_2` (`Moment`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `measurement186`
--

DROP TABLE IF EXISTS `measurement186`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `measurement186` (
  `Moment` datetime NOT NULL,
  `Tagvalue` decimal(10,5) NOT NULL,
  PRIMARY KEY (`Moment`),
  UNIQUE KEY `Index_2` (`Moment`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `measurement187`
--

DROP TABLE IF EXISTS `measurement187`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `measurement187` (
  `Moment` datetime NOT NULL,
  `Tagvalue` decimal(10,5) NOT NULL,
  PRIMARY KEY (`Moment`),
  UNIQUE KEY `Index_2` (`Moment`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `measurement188`
--

DROP TABLE IF EXISTS `measurement188`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `measurement188` (
  `Moment` datetime NOT NULL,
  `Tagvalue` decimal(10,5) NOT NULL,
  PRIMARY KEY (`Moment`),
  UNIQUE KEY `Index_2` (`Moment`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `measurement189`
--

DROP TABLE IF EXISTS `measurement189`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `measurement189` (
  `Moment` datetime NOT NULL,
  `Tagvalue` decimal(10,5) NOT NULL,
  PRIMARY KEY (`Moment`),
  UNIQUE KEY `Index_2` (`Moment`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `measurement19`
--

DROP TABLE IF EXISTS `measurement19`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `measurement19` (
  `Moment` datetime NOT NULL,
  `Tagvalue` decimal(10,5) NOT NULL,
  PRIMARY KEY (`Moment`),
  UNIQUE KEY `Index_2` (`Moment`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `measurement190`
--

DROP TABLE IF EXISTS `measurement190`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `measurement190` (
  `Moment` datetime NOT NULL,
  `Tagvalue` decimal(10,5) NOT NULL,
  PRIMARY KEY (`Moment`),
  UNIQUE KEY `Index_2` (`Moment`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `measurement191`
--

DROP TABLE IF EXISTS `measurement191`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `measurement191` (
  `Moment` datetime NOT NULL,
  `Tagvalue` decimal(10,5) NOT NULL,
  PRIMARY KEY (`Moment`),
  UNIQUE KEY `Index_2` (`Moment`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `measurement192`
--

DROP TABLE IF EXISTS `measurement192`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `measurement192` (
  `Moment` datetime NOT NULL,
  `Tagvalue` decimal(10,5) NOT NULL,
  PRIMARY KEY (`Moment`),
  UNIQUE KEY `Index_2` (`Moment`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `measurement193`
--

DROP TABLE IF EXISTS `measurement193`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `measurement193` (
  `Moment` datetime NOT NULL,
  `Tagvalue` decimal(10,5) NOT NULL,
  PRIMARY KEY (`Moment`),
  UNIQUE KEY `Index_2` (`Moment`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `measurement194`
--

DROP TABLE IF EXISTS `measurement194`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `measurement194` (
  `Moment` datetime NOT NULL,
  `Tagvalue` decimal(10,5) NOT NULL,
  PRIMARY KEY (`Moment`),
  UNIQUE KEY `Index_2` (`Moment`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `measurement195`
--

DROP TABLE IF EXISTS `measurement195`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `measurement195` (
  `Moment` datetime NOT NULL,
  `Tagvalue` decimal(10,5) NOT NULL,
  PRIMARY KEY (`Moment`),
  UNIQUE KEY `Index_2` (`Moment`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `measurement196`
--

DROP TABLE IF EXISTS `measurement196`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `measurement196` (
  `Moment` datetime NOT NULL,
  `Tagvalue` decimal(10,5) NOT NULL,
  PRIMARY KEY (`Moment`),
  UNIQUE KEY `Index_2` (`Moment`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `measurement197`
--

DROP TABLE IF EXISTS `measurement197`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `measurement197` (
  `Moment` datetime NOT NULL,
  `Tagvalue` decimal(10,5) NOT NULL,
  PRIMARY KEY (`Moment`),
  UNIQUE KEY `Index_2` (`Moment`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `measurement198`
--

DROP TABLE IF EXISTS `measurement198`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `measurement198` (
  `Moment` datetime NOT NULL,
  `Tagvalue` decimal(10,5) NOT NULL,
  PRIMARY KEY (`Moment`),
  UNIQUE KEY `Index_2` (`Moment`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `measurement199`
--

DROP TABLE IF EXISTS `measurement199`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `measurement199` (
  `Moment` datetime NOT NULL,
  `Tagvalue` decimal(10,5) NOT NULL,
  PRIMARY KEY (`Moment`),
  UNIQUE KEY `Index_2` (`Moment`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `measurement2`
--

DROP TABLE IF EXISTS `measurement2`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `measurement2` (
  `Moment` datetime NOT NULL,
  `Tagvalue` decimal(10,5) NOT NULL,
  PRIMARY KEY (`Moment`),
  UNIQUE KEY `Index_2` (`Moment`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `measurement20`
--

DROP TABLE IF EXISTS `measurement20`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `measurement20` (
  `Moment` datetime NOT NULL,
  `Tagvalue` decimal(10,5) NOT NULL,
  PRIMARY KEY (`Moment`),
  UNIQUE KEY `Index_2` (`Moment`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `measurement200`
--

DROP TABLE IF EXISTS `measurement200`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `measurement200` (
  `Moment` datetime NOT NULL,
  `Tagvalue` decimal(10,5) NOT NULL,
  PRIMARY KEY (`Moment`),
  UNIQUE KEY `Index_2` (`Moment`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `measurement201`
--

DROP TABLE IF EXISTS `measurement201`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `measurement201` (
  `Moment` datetime NOT NULL,
  `Tagvalue` decimal(10,5) NOT NULL,
  PRIMARY KEY (`Moment`),
  UNIQUE KEY `Index_2` (`Moment`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `measurement202`
--

DROP TABLE IF EXISTS `measurement202`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `measurement202` (
  `Moment` datetime NOT NULL,
  `Tagvalue` decimal(10,5) NOT NULL,
  PRIMARY KEY (`Moment`),
  UNIQUE KEY `Index_2` (`Moment`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `measurement203`
--

DROP TABLE IF EXISTS `measurement203`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `measurement203` (
  `Moment` datetime NOT NULL,
  `Tagvalue` decimal(10,5) NOT NULL,
  PRIMARY KEY (`Moment`),
  UNIQUE KEY `Index_2` (`Moment`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `measurement204`
--

DROP TABLE IF EXISTS `measurement204`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `measurement204` (
  `Moment` datetime NOT NULL,
  `Tagvalue` decimal(10,5) NOT NULL,
  PRIMARY KEY (`Moment`),
  UNIQUE KEY `Index_2` (`Moment`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `measurement205`
--

DROP TABLE IF EXISTS `measurement205`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `measurement205` (
  `Moment` datetime NOT NULL,
  `Tagvalue` decimal(10,5) NOT NULL,
  PRIMARY KEY (`Moment`),
  UNIQUE KEY `Index_2` (`Moment`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `measurement206`
--

DROP TABLE IF EXISTS `measurement206`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `measurement206` (
  `Moment` datetime NOT NULL,
  `Tagvalue` decimal(10,5) NOT NULL,
  PRIMARY KEY (`Moment`),
  UNIQUE KEY `Index_2` (`Moment`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `measurement207`
--

DROP TABLE IF EXISTS `measurement207`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `measurement207` (
  `Moment` datetime NOT NULL,
  `Tagvalue` decimal(10,5) NOT NULL,
  PRIMARY KEY (`Moment`),
  UNIQUE KEY `Index_2` (`Moment`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `measurement208`
--

DROP TABLE IF EXISTS `measurement208`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `measurement208` (
  `Moment` datetime NOT NULL,
  `Tagvalue` decimal(10,5) NOT NULL,
  PRIMARY KEY (`Moment`),
  UNIQUE KEY `Index_2` (`Moment`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `measurement209`
--

DROP TABLE IF EXISTS `measurement209`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `measurement209` (
  `Moment` datetime NOT NULL,
  `Tagvalue` decimal(10,5) NOT NULL,
  PRIMARY KEY (`Moment`),
  UNIQUE KEY `Index_2` (`Moment`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `measurement21`
--

DROP TABLE IF EXISTS `measurement21`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `measurement21` (
  `Moment` datetime NOT NULL,
  `Tagvalue` decimal(10,5) NOT NULL,
  PRIMARY KEY (`Moment`),
  UNIQUE KEY `Index_2` (`Moment`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `measurement210`
--

DROP TABLE IF EXISTS `measurement210`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `measurement210` (
  `Moment` datetime NOT NULL,
  `Tagvalue` decimal(10,5) NOT NULL,
  PRIMARY KEY (`Moment`),
  UNIQUE KEY `Index_2` (`Moment`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `measurement211`
--

DROP TABLE IF EXISTS `measurement211`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `measurement211` (
  `Moment` datetime NOT NULL,
  `Tagvalue` decimal(10,5) NOT NULL,
  PRIMARY KEY (`Moment`),
  UNIQUE KEY `Index_2` (`Moment`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `measurement212`
--

DROP TABLE IF EXISTS `measurement212`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `measurement212` (
  `Moment` datetime NOT NULL,
  `Tagvalue` decimal(10,5) NOT NULL,
  PRIMARY KEY (`Moment`),
  UNIQUE KEY `Index_2` (`Moment`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `measurement213`
--

DROP TABLE IF EXISTS `measurement213`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `measurement213` (
  `Moment` datetime NOT NULL,
  `Tagvalue` decimal(10,5) NOT NULL,
  PRIMARY KEY (`Moment`),
  UNIQUE KEY `Index_2` (`Moment`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `measurement214`
--

DROP TABLE IF EXISTS `measurement214`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `measurement214` (
  `Moment` datetime NOT NULL,
  `Tagvalue` decimal(10,5) NOT NULL,
  PRIMARY KEY (`Moment`),
  UNIQUE KEY `Index_2` (`Moment`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `measurement215`
--

DROP TABLE IF EXISTS `measurement215`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `measurement215` (
  `Moment` datetime NOT NULL,
  `Tagvalue` decimal(10,5) NOT NULL,
  PRIMARY KEY (`Moment`),
  UNIQUE KEY `Index_2` (`Moment`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `measurement216`
--

DROP TABLE IF EXISTS `measurement216`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `measurement216` (
  `Moment` datetime NOT NULL,
  `Tagvalue` decimal(10,5) NOT NULL,
  PRIMARY KEY (`Moment`),
  UNIQUE KEY `Index_2` (`Moment`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `measurement217`
--

DROP TABLE IF EXISTS `measurement217`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `measurement217` (
  `Moment` datetime NOT NULL,
  `Tagvalue` decimal(10,5) NOT NULL,
  PRIMARY KEY (`Moment`),
  UNIQUE KEY `Index_2` (`Moment`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `measurement218`
--

DROP TABLE IF EXISTS `measurement218`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `measurement218` (
  `Moment` datetime NOT NULL,
  `Tagvalue` decimal(10,5) NOT NULL,
  PRIMARY KEY (`Moment`),
  UNIQUE KEY `Index_2` (`Moment`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `measurement219`
--

DROP TABLE IF EXISTS `measurement219`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `measurement219` (
  `Moment` datetime NOT NULL,
  `Tagvalue` decimal(10,5) NOT NULL,
  PRIMARY KEY (`Moment`),
  UNIQUE KEY `Index_2` (`Moment`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `measurement22`
--

DROP TABLE IF EXISTS `measurement22`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `measurement22` (
  `Moment` datetime NOT NULL,
  `Tagvalue` decimal(10,5) NOT NULL,
  PRIMARY KEY (`Moment`),
  UNIQUE KEY `Index_2` (`Moment`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `measurement220`
--

DROP TABLE IF EXISTS `measurement220`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `measurement220` (
  `Moment` datetime NOT NULL,
  `Tagvalue` decimal(10,5) NOT NULL,
  PRIMARY KEY (`Moment`),
  UNIQUE KEY `Index_2` (`Moment`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `measurement221`
--

DROP TABLE IF EXISTS `measurement221`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `measurement221` (
  `Moment` datetime NOT NULL,
  `Tagvalue` decimal(10,5) NOT NULL,
  PRIMARY KEY (`Moment`),
  UNIQUE KEY `Index_2` (`Moment`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `measurement222`
--

DROP TABLE IF EXISTS `measurement222`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `measurement222` (
  `Moment` datetime NOT NULL,
  `Tagvalue` decimal(10,5) NOT NULL,
  PRIMARY KEY (`Moment`),
  UNIQUE KEY `Index_2` (`Moment`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `measurement223`
--

DROP TABLE IF EXISTS `measurement223`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `measurement223` (
  `Moment` datetime NOT NULL,
  `Tagvalue` decimal(10,5) NOT NULL,
  PRIMARY KEY (`Moment`),
  UNIQUE KEY `Index_2` (`Moment`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `measurement224`
--

DROP TABLE IF EXISTS `measurement224`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `measurement224` (
  `Moment` datetime NOT NULL,
  `Tagvalue` decimal(10,5) NOT NULL,
  PRIMARY KEY (`Moment`),
  UNIQUE KEY `Index_2` (`Moment`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `measurement225`
--

DROP TABLE IF EXISTS `measurement225`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `measurement225` (
  `Moment` datetime NOT NULL,
  `Tagvalue` decimal(10,5) NOT NULL,
  PRIMARY KEY (`Moment`),
  UNIQUE KEY `Index_2` (`Moment`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `measurement226`
--

DROP TABLE IF EXISTS `measurement226`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `measurement226` (
  `Moment` datetime NOT NULL,
  `Tagvalue` decimal(10,5) NOT NULL,
  PRIMARY KEY (`Moment`),
  UNIQUE KEY `Index_2` (`Moment`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `measurement227`
--

DROP TABLE IF EXISTS `measurement227`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `measurement227` (
  `Moment` datetime NOT NULL,
  `Tagvalue` decimal(10,5) NOT NULL,
  PRIMARY KEY (`Moment`),
  UNIQUE KEY `Index_2` (`Moment`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `measurement228`
--

DROP TABLE IF EXISTS `measurement228`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `measurement228` (
  `Moment` datetime NOT NULL,
  `Tagvalue` decimal(10,5) NOT NULL,
  PRIMARY KEY (`Moment`),
  UNIQUE KEY `Index_2` (`Moment`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `measurement229`
--

DROP TABLE IF EXISTS `measurement229`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `measurement229` (
  `Moment` datetime NOT NULL,
  `Tagvalue` decimal(10,5) NOT NULL,
  PRIMARY KEY (`Moment`),
  UNIQUE KEY `Index_2` (`Moment`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `measurement23`
--

DROP TABLE IF EXISTS `measurement23`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `measurement23` (
  `Moment` datetime NOT NULL,
  `Tagvalue` decimal(10,5) NOT NULL,
  PRIMARY KEY (`Moment`),
  UNIQUE KEY `Index_2` (`Moment`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `measurement230`
--

DROP TABLE IF EXISTS `measurement230`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `measurement230` (
  `Moment` datetime NOT NULL,
  `Tagvalue` decimal(10,5) NOT NULL,
  PRIMARY KEY (`Moment`),
  UNIQUE KEY `Index_2` (`Moment`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `measurement231`
--

DROP TABLE IF EXISTS `measurement231`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `measurement231` (
  `Moment` datetime NOT NULL,
  `Tagvalue` decimal(10,5) NOT NULL,
  PRIMARY KEY (`Moment`),
  UNIQUE KEY `Index_2` (`Moment`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `measurement232`
--

DROP TABLE IF EXISTS `measurement232`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `measurement232` (
  `Moment` datetime NOT NULL,
  `Tagvalue` decimal(10,5) NOT NULL,
  PRIMARY KEY (`Moment`),
  UNIQUE KEY `Index_2` (`Moment`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `measurement233`
--

DROP TABLE IF EXISTS `measurement233`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `measurement233` (
  `Moment` datetime NOT NULL,
  `Tagvalue` decimal(10,5) NOT NULL,
  PRIMARY KEY (`Moment`),
  UNIQUE KEY `Index_2` (`Moment`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `measurement234`
--

DROP TABLE IF EXISTS `measurement234`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `measurement234` (
  `Moment` datetime NOT NULL,
  `Tagvalue` decimal(10,5) NOT NULL,
  PRIMARY KEY (`Moment`),
  UNIQUE KEY `Index_2` (`Moment`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `measurement235`
--

DROP TABLE IF EXISTS `measurement235`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `measurement235` (
  `Moment` datetime NOT NULL,
  `Tagvalue` decimal(10,5) NOT NULL,
  PRIMARY KEY (`Moment`),
  UNIQUE KEY `Index_2` (`Moment`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `measurement236`
--

DROP TABLE IF EXISTS `measurement236`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `measurement236` (
  `Moment` datetime NOT NULL,
  `Tagvalue` decimal(10,5) NOT NULL,
  PRIMARY KEY (`Moment`),
  UNIQUE KEY `Index_2` (`Moment`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `measurement237`
--

DROP TABLE IF EXISTS `measurement237`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `measurement237` (
  `Moment` datetime NOT NULL,
  `Tagvalue` decimal(10,5) NOT NULL,
  PRIMARY KEY (`Moment`),
  UNIQUE KEY `Index_2` (`Moment`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `measurement238`
--

DROP TABLE IF EXISTS `measurement238`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `measurement238` (
  `Moment` datetime NOT NULL,
  `Tagvalue` decimal(10,5) NOT NULL,
  PRIMARY KEY (`Moment`),
  UNIQUE KEY `Index_2` (`Moment`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `measurement239`
--

DROP TABLE IF EXISTS `measurement239`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `measurement239` (
  `Moment` datetime NOT NULL,
  `Tagvalue` decimal(10,5) NOT NULL,
  PRIMARY KEY (`Moment`),
  UNIQUE KEY `Index_2` (`Moment`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `measurement24`
--

DROP TABLE IF EXISTS `measurement24`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `measurement24` (
  `Moment` datetime NOT NULL,
  `Tagvalue` decimal(10,5) NOT NULL,
  PRIMARY KEY (`Moment`),
  UNIQUE KEY `Index_2` (`Moment`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `measurement240`
--

DROP TABLE IF EXISTS `measurement240`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `measurement240` (
  `Moment` datetime NOT NULL,
  `Tagvalue` decimal(10,5) NOT NULL,
  PRIMARY KEY (`Moment`),
  UNIQUE KEY `Index_2` (`Moment`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `measurement241`
--

DROP TABLE IF EXISTS `measurement241`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `measurement241` (
  `Moment` datetime NOT NULL,
  `Tagvalue` decimal(10,5) NOT NULL,
  PRIMARY KEY (`Moment`),
  UNIQUE KEY `Index_2` (`Moment`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `measurement242`
--

DROP TABLE IF EXISTS `measurement242`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `measurement242` (
  `Moment` datetime NOT NULL,
  `Tagvalue` decimal(10,5) NOT NULL,
  PRIMARY KEY (`Moment`),
  UNIQUE KEY `Index_2` (`Moment`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `measurement243`
--

DROP TABLE IF EXISTS `measurement243`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `measurement243` (
  `Moment` datetime NOT NULL,
  `Tagvalue` decimal(10,5) NOT NULL,
  PRIMARY KEY (`Moment`),
  UNIQUE KEY `Index_2` (`Moment`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `measurement244`
--

DROP TABLE IF EXISTS `measurement244`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `measurement244` (
  `Moment` datetime NOT NULL,
  `Tagvalue` decimal(10,5) NOT NULL,
  PRIMARY KEY (`Moment`),
  UNIQUE KEY `Index_2` (`Moment`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `measurement245`
--

DROP TABLE IF EXISTS `measurement245`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `measurement245` (
  `Moment` datetime NOT NULL,
  `Tagvalue` decimal(10,5) NOT NULL,
  PRIMARY KEY (`Moment`),
  UNIQUE KEY `Index_2` (`Moment`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `measurement246`
--

DROP TABLE IF EXISTS `measurement246`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `measurement246` (
  `Moment` datetime NOT NULL,
  `Tagvalue` decimal(10,5) NOT NULL,
  PRIMARY KEY (`Moment`),
  UNIQUE KEY `Index_2` (`Moment`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `measurement247`
--

DROP TABLE IF EXISTS `measurement247`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `measurement247` (
  `Moment` datetime NOT NULL,
  `Tagvalue` decimal(10,5) NOT NULL,
  PRIMARY KEY (`Moment`),
  UNIQUE KEY `Index_2` (`Moment`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `measurement248`
--

DROP TABLE IF EXISTS `measurement248`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `measurement248` (
  `Moment` datetime NOT NULL,
  `Tagvalue` decimal(10,5) NOT NULL,
  PRIMARY KEY (`Moment`),
  UNIQUE KEY `Index_2` (`Moment`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `measurement249`
--

DROP TABLE IF EXISTS `measurement249`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `measurement249` (
  `Moment` datetime NOT NULL,
  `Tagvalue` decimal(10,5) NOT NULL,
  PRIMARY KEY (`Moment`),
  UNIQUE KEY `Index_2` (`Moment`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `measurement25`
--

DROP TABLE IF EXISTS `measurement25`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `measurement25` (
  `Moment` datetime NOT NULL,
  `Tagvalue` decimal(10,5) NOT NULL,
  PRIMARY KEY (`Moment`),
  UNIQUE KEY `Index_2` (`Moment`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `measurement250`
--

DROP TABLE IF EXISTS `measurement250`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `measurement250` (
  `Moment` datetime NOT NULL,
  `Tagvalue` decimal(10,5) NOT NULL,
  PRIMARY KEY (`Moment`),
  UNIQUE KEY `Index_2` (`Moment`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `measurement251`
--

DROP TABLE IF EXISTS `measurement251`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `measurement251` (
  `Moment` datetime NOT NULL,
  `Tagvalue` decimal(10,5) NOT NULL,
  PRIMARY KEY (`Moment`),
  UNIQUE KEY `Index_2` (`Moment`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `measurement252`
--

DROP TABLE IF EXISTS `measurement252`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `measurement252` (
  `Moment` datetime NOT NULL,
  `Tagvalue` decimal(10,5) NOT NULL,
  PRIMARY KEY (`Moment`),
  UNIQUE KEY `Index_2` (`Moment`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `measurement253`
--

DROP TABLE IF EXISTS `measurement253`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `measurement253` (
  `Moment` datetime NOT NULL,
  `Tagvalue` decimal(10,5) NOT NULL,
  PRIMARY KEY (`Moment`),
  UNIQUE KEY `Index_2` (`Moment`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `measurement254`
--

DROP TABLE IF EXISTS `measurement254`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `measurement254` (
  `Moment` datetime NOT NULL,
  `Tagvalue` decimal(10,5) NOT NULL,
  PRIMARY KEY (`Moment`),
  UNIQUE KEY `Index_2` (`Moment`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `measurement255`
--

DROP TABLE IF EXISTS `measurement255`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `measurement255` (
  `Moment` datetime NOT NULL,
  `Tagvalue` decimal(10,5) NOT NULL,
  PRIMARY KEY (`Moment`),
  UNIQUE KEY `Index_2` (`Moment`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `measurement256`
--

DROP TABLE IF EXISTS `measurement256`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `measurement256` (
  `Moment` datetime NOT NULL,
  `Tagvalue` decimal(10,5) NOT NULL,
  PRIMARY KEY (`Moment`),
  UNIQUE KEY `Index_2` (`Moment`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `measurement257`
--

DROP TABLE IF EXISTS `measurement257`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `measurement257` (
  `Moment` datetime NOT NULL,
  `Tagvalue` decimal(10,5) NOT NULL,
  PRIMARY KEY (`Moment`),
  UNIQUE KEY `Index_2` (`Moment`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `measurement258`
--

DROP TABLE IF EXISTS `measurement258`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `measurement258` (
  `Moment` datetime NOT NULL,
  `Tagvalue` decimal(10,5) NOT NULL,
  PRIMARY KEY (`Moment`),
  UNIQUE KEY `Index_2` (`Moment`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `measurement259`
--

DROP TABLE IF EXISTS `measurement259`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `measurement259` (
  `Moment` datetime NOT NULL,
  `Tagvalue` decimal(10,5) NOT NULL,
  PRIMARY KEY (`Moment`),
  UNIQUE KEY `Index_2` (`Moment`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `measurement26`
--

DROP TABLE IF EXISTS `measurement26`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `measurement26` (
  `Moment` datetime NOT NULL,
  `Tagvalue` decimal(10,5) NOT NULL,
  PRIMARY KEY (`Moment`),
  UNIQUE KEY `Index_2` (`Moment`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `measurement260`
--

DROP TABLE IF EXISTS `measurement260`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `measurement260` (
  `Moment` datetime NOT NULL,
  `Tagvalue` decimal(10,5) NOT NULL,
  PRIMARY KEY (`Moment`),
  UNIQUE KEY `Index_2` (`Moment`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `measurement261`
--

DROP TABLE IF EXISTS `measurement261`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `measurement261` (
  `Moment` datetime NOT NULL,
  `Tagvalue` decimal(10,5) NOT NULL,
  PRIMARY KEY (`Moment`),
  UNIQUE KEY `Index_2` (`Moment`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `measurement262`
--

DROP TABLE IF EXISTS `measurement262`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `measurement262` (
  `Moment` datetime NOT NULL,
  `Tagvalue` decimal(10,5) NOT NULL,
  PRIMARY KEY (`Moment`),
  UNIQUE KEY `Index_2` (`Moment`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `measurement263`
--

DROP TABLE IF EXISTS `measurement263`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `measurement263` (
  `Moment` datetime NOT NULL,
  `Tagvalue` decimal(10,5) NOT NULL,
  PRIMARY KEY (`Moment`),
  UNIQUE KEY `Index_2` (`Moment`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `measurement264`
--

DROP TABLE IF EXISTS `measurement264`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `measurement264` (
  `Moment` datetime NOT NULL,
  `Tagvalue` decimal(10,5) NOT NULL,
  PRIMARY KEY (`Moment`),
  UNIQUE KEY `Index_2` (`Moment`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `measurement265`
--

DROP TABLE IF EXISTS `measurement265`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `measurement265` (
  `Moment` datetime NOT NULL,
  `Tagvalue` decimal(10,5) NOT NULL,
  PRIMARY KEY (`Moment`),
  UNIQUE KEY `Index_2` (`Moment`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `measurement266`
--

DROP TABLE IF EXISTS `measurement266`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `measurement266` (
  `Moment` datetime NOT NULL,
  `Tagvalue` decimal(10,5) NOT NULL,
  PRIMARY KEY (`Moment`),
  UNIQUE KEY `Index_2` (`Moment`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `measurement267`
--

DROP TABLE IF EXISTS `measurement267`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `measurement267` (
  `Moment` datetime NOT NULL,
  `Tagvalue` decimal(10,5) NOT NULL,
  PRIMARY KEY (`Moment`),
  UNIQUE KEY `Index_2` (`Moment`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `measurement268`
--

DROP TABLE IF EXISTS `measurement268`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `measurement268` (
  `Moment` datetime NOT NULL,
  `Tagvalue` decimal(10,5) NOT NULL,
  PRIMARY KEY (`Moment`),
  UNIQUE KEY `Index_2` (`Moment`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `measurement269`
--

DROP TABLE IF EXISTS `measurement269`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `measurement269` (
  `Moment` datetime NOT NULL,
  `Tagvalue` decimal(10,5) NOT NULL,
  PRIMARY KEY (`Moment`),
  UNIQUE KEY `Index_2` (`Moment`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `measurement27`
--

DROP TABLE IF EXISTS `measurement27`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `measurement27` (
  `Moment` datetime NOT NULL,
  `Tagvalue` decimal(10,5) NOT NULL,
  PRIMARY KEY (`Moment`),
  UNIQUE KEY `Index_2` (`Moment`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `measurement270`
--

DROP TABLE IF EXISTS `measurement270`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `measurement270` (
  `Moment` datetime NOT NULL,
  `Tagvalue` decimal(10,5) NOT NULL,
  PRIMARY KEY (`Moment`),
  UNIQUE KEY `Index_2` (`Moment`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `measurement271`
--

DROP TABLE IF EXISTS `measurement271`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `measurement271` (
  `Moment` datetime NOT NULL,
  `Tagvalue` decimal(10,5) NOT NULL,
  PRIMARY KEY (`Moment`),
  UNIQUE KEY `Index_2` (`Moment`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `measurement272`
--

DROP TABLE IF EXISTS `measurement272`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `measurement272` (
  `Moment` datetime NOT NULL,
  `Tagvalue` decimal(10,5) NOT NULL,
  PRIMARY KEY (`Moment`),
  UNIQUE KEY `Index_2` (`Moment`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `measurement273`
--

DROP TABLE IF EXISTS `measurement273`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `measurement273` (
  `Moment` datetime NOT NULL,
  `Tagvalue` decimal(10,5) NOT NULL,
  PRIMARY KEY (`Moment`),
  UNIQUE KEY `Index_2` (`Moment`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `measurement274`
--

DROP TABLE IF EXISTS `measurement274`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `measurement274` (
  `Moment` datetime NOT NULL,
  `Tagvalue` decimal(10,5) NOT NULL,
  PRIMARY KEY (`Moment`),
  UNIQUE KEY `Index_2` (`Moment`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `measurement275`
--

DROP TABLE IF EXISTS `measurement275`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `measurement275` (
  `Moment` datetime NOT NULL,
  `Tagvalue` decimal(10,5) NOT NULL,
  PRIMARY KEY (`Moment`),
  UNIQUE KEY `Index_2` (`Moment`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `measurement276`
--

DROP TABLE IF EXISTS `measurement276`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `measurement276` (
  `Moment` datetime NOT NULL,
  `Tagvalue` decimal(10,5) NOT NULL,
  PRIMARY KEY (`Moment`),
  UNIQUE KEY `Index_2` (`Moment`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `measurement277`
--

DROP TABLE IF EXISTS `measurement277`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `measurement277` (
  `Moment` datetime NOT NULL,
  `Tagvalue` decimal(10,5) NOT NULL,
  PRIMARY KEY (`Moment`),
  UNIQUE KEY `Index_2` (`Moment`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `measurement278`
--

DROP TABLE IF EXISTS `measurement278`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `measurement278` (
  `Moment` datetime NOT NULL,
  `Tagvalue` decimal(10,5) NOT NULL,
  PRIMARY KEY (`Moment`),
  UNIQUE KEY `Index_2` (`Moment`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `measurement279`
--

DROP TABLE IF EXISTS `measurement279`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `measurement279` (
  `Moment` datetime NOT NULL,
  `Tagvalue` decimal(10,5) NOT NULL,
  PRIMARY KEY (`Moment`),
  UNIQUE KEY `Index_2` (`Moment`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `measurement28`
--

DROP TABLE IF EXISTS `measurement28`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `measurement28` (
  `Moment` datetime NOT NULL,
  `Tagvalue` decimal(10,5) NOT NULL,
  PRIMARY KEY (`Moment`),
  UNIQUE KEY `Index_2` (`Moment`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `measurement280`
--

DROP TABLE IF EXISTS `measurement280`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `measurement280` (
  `Moment` datetime NOT NULL,
  `Tagvalue` decimal(10,5) NOT NULL,
  PRIMARY KEY (`Moment`),
  UNIQUE KEY `Index_2` (`Moment`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `measurement281`
--

DROP TABLE IF EXISTS `measurement281`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `measurement281` (
  `Moment` datetime NOT NULL,
  `Tagvalue` decimal(10,5) NOT NULL,
  PRIMARY KEY (`Moment`),
  UNIQUE KEY `Index_2` (`Moment`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `measurement282`
--

DROP TABLE IF EXISTS `measurement282`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `measurement282` (
  `Moment` datetime NOT NULL,
  `Tagvalue` decimal(10,5) NOT NULL,
  PRIMARY KEY (`Moment`),
  UNIQUE KEY `Index_2` (`Moment`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `measurement283`
--

DROP TABLE IF EXISTS `measurement283`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `measurement283` (
  `Moment` datetime NOT NULL,
  `Tagvalue` decimal(10,5) NOT NULL,
  PRIMARY KEY (`Moment`),
  UNIQUE KEY `Index_2` (`Moment`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `measurement284`
--

DROP TABLE IF EXISTS `measurement284`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `measurement284` (
  `Moment` datetime NOT NULL,
  `Tagvalue` decimal(10,5) NOT NULL,
  PRIMARY KEY (`Moment`),
  UNIQUE KEY `Index_2` (`Moment`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `measurement285`
--

DROP TABLE IF EXISTS `measurement285`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `measurement285` (
  `Moment` datetime NOT NULL,
  `Tagvalue` decimal(10,5) NOT NULL,
  PRIMARY KEY (`Moment`),
  UNIQUE KEY `Index_2` (`Moment`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `measurement286`
--

DROP TABLE IF EXISTS `measurement286`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `measurement286` (
  `Moment` datetime NOT NULL,
  `Tagvalue` decimal(10,5) NOT NULL,
  PRIMARY KEY (`Moment`),
  UNIQUE KEY `Index_2` (`Moment`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `measurement287`
--

DROP TABLE IF EXISTS `measurement287`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `measurement287` (
  `Moment` datetime NOT NULL,
  `Tagvalue` decimal(10,5) NOT NULL,
  PRIMARY KEY (`Moment`),
  UNIQUE KEY `Index_2` (`Moment`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `measurement288`
--

DROP TABLE IF EXISTS `measurement288`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `measurement288` (
  `Moment` datetime NOT NULL,
  `Tagvalue` decimal(10,5) NOT NULL,
  PRIMARY KEY (`Moment`),
  UNIQUE KEY `Index_2` (`Moment`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `measurement289`
--

DROP TABLE IF EXISTS `measurement289`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `measurement289` (
  `Moment` datetime NOT NULL,
  `Tagvalue` decimal(10,5) NOT NULL,
  PRIMARY KEY (`Moment`),
  UNIQUE KEY `Index_2` (`Moment`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `measurement29`
--

DROP TABLE IF EXISTS `measurement29`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `measurement29` (
  `Moment` datetime NOT NULL,
  `Tagvalue` decimal(10,5) NOT NULL,
  PRIMARY KEY (`Moment`),
  UNIQUE KEY `Index_2` (`Moment`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `measurement290`
--

DROP TABLE IF EXISTS `measurement290`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `measurement290` (
  `Moment` datetime NOT NULL,
  `Tagvalue` decimal(10,5) NOT NULL,
  PRIMARY KEY (`Moment`),
  UNIQUE KEY `Index_2` (`Moment`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `measurement291`
--

DROP TABLE IF EXISTS `measurement291`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `measurement291` (
  `Moment` datetime NOT NULL,
  `Tagvalue` decimal(10,5) NOT NULL,
  PRIMARY KEY (`Moment`),
  UNIQUE KEY `Index_2` (`Moment`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `measurement292`
--

DROP TABLE IF EXISTS `measurement292`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `measurement292` (
  `Moment` datetime NOT NULL,
  `Tagvalue` decimal(10,5) NOT NULL,
  PRIMARY KEY (`Moment`),
  UNIQUE KEY `Index_2` (`Moment`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `measurement293`
--

DROP TABLE IF EXISTS `measurement293`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `measurement293` (
  `Moment` datetime NOT NULL,
  `Tagvalue` decimal(10,5) NOT NULL,
  PRIMARY KEY (`Moment`),
  UNIQUE KEY `Index_2` (`Moment`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `measurement294`
--

DROP TABLE IF EXISTS `measurement294`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `measurement294` (
  `Moment` datetime NOT NULL,
  `Tagvalue` decimal(10,5) NOT NULL,
  PRIMARY KEY (`Moment`),
  UNIQUE KEY `Index_2` (`Moment`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `measurement295`
--

DROP TABLE IF EXISTS `measurement295`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `measurement295` (
  `Moment` datetime NOT NULL,
  `Tagvalue` decimal(10,5) NOT NULL,
  PRIMARY KEY (`Moment`),
  UNIQUE KEY `Index_2` (`Moment`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `measurement296`
--

DROP TABLE IF EXISTS `measurement296`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `measurement296` (
  `Moment` datetime NOT NULL,
  `Tagvalue` decimal(10,5) NOT NULL,
  PRIMARY KEY (`Moment`),
  UNIQUE KEY `Index_2` (`Moment`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `measurement297`
--

DROP TABLE IF EXISTS `measurement297`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `measurement297` (
  `Moment` datetime NOT NULL,
  `Tagvalue` decimal(10,5) NOT NULL,
  PRIMARY KEY (`Moment`),
  UNIQUE KEY `Index_2` (`Moment`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `measurement298`
--

DROP TABLE IF EXISTS `measurement298`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `measurement298` (
  `Moment` datetime NOT NULL,
  `Tagvalue` decimal(10,5) NOT NULL,
  PRIMARY KEY (`Moment`),
  UNIQUE KEY `Index_2` (`Moment`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `measurement299`
--

DROP TABLE IF EXISTS `measurement299`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `measurement299` (
  `Moment` datetime NOT NULL,
  `Tagvalue` decimal(10,5) NOT NULL,
  PRIMARY KEY (`Moment`),
  UNIQUE KEY `Index_2` (`Moment`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `measurement3`
--

DROP TABLE IF EXISTS `measurement3`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `measurement3` (
  `Moment` datetime NOT NULL,
  `Tagvalue` decimal(10,5) NOT NULL,
  PRIMARY KEY (`Moment`),
  UNIQUE KEY `Index_2` (`Moment`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `measurement30`
--

DROP TABLE IF EXISTS `measurement30`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `measurement30` (
  `Moment` datetime NOT NULL,
  `Tagvalue` decimal(10,5) NOT NULL,
  PRIMARY KEY (`Moment`),
  UNIQUE KEY `Index_2` (`Moment`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `measurement300`
--

DROP TABLE IF EXISTS `measurement300`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `measurement300` (
  `Moment` datetime NOT NULL,
  `Tagvalue` decimal(10,5) NOT NULL,
  PRIMARY KEY (`Moment`),
  UNIQUE KEY `Index_2` (`Moment`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `measurement301`
--

DROP TABLE IF EXISTS `measurement301`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `measurement301` (
  `Moment` datetime NOT NULL,
  `Tagvalue` decimal(10,5) NOT NULL,
  PRIMARY KEY (`Moment`),
  UNIQUE KEY `Index_2` (`Moment`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `measurement302`
--

DROP TABLE IF EXISTS `measurement302`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `measurement302` (
  `Moment` datetime NOT NULL,
  `Tagvalue` decimal(10,5) NOT NULL,
  PRIMARY KEY (`Moment`),
  UNIQUE KEY `Index_2` (`Moment`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `measurement303`
--

DROP TABLE IF EXISTS `measurement303`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `measurement303` (
  `Moment` datetime NOT NULL,
  `Tagvalue` decimal(10,5) NOT NULL,
  PRIMARY KEY (`Moment`),
  UNIQUE KEY `Index_2` (`Moment`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `measurement304`
--

DROP TABLE IF EXISTS `measurement304`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `measurement304` (
  `Moment` datetime NOT NULL,
  `Tagvalue` decimal(10,5) NOT NULL,
  PRIMARY KEY (`Moment`),
  UNIQUE KEY `Index_2` (`Moment`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `measurement305`
--

DROP TABLE IF EXISTS `measurement305`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `measurement305` (
  `Moment` datetime NOT NULL,
  `Tagvalue` decimal(10,5) NOT NULL,
  PRIMARY KEY (`Moment`),
  UNIQUE KEY `Index_2` (`Moment`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `measurement306`
--

DROP TABLE IF EXISTS `measurement306`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `measurement306` (
  `Moment` datetime NOT NULL,
  `Tagvalue` decimal(10,5) NOT NULL,
  PRIMARY KEY (`Moment`),
  UNIQUE KEY `Index_2` (`Moment`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `measurement307`
--

DROP TABLE IF EXISTS `measurement307`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `measurement307` (
  `Moment` datetime NOT NULL,
  `Tagvalue` decimal(10,5) NOT NULL,
  PRIMARY KEY (`Moment`),
  UNIQUE KEY `Index_2` (`Moment`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `measurement308`
--

DROP TABLE IF EXISTS `measurement308`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `measurement308` (
  `Moment` datetime NOT NULL,
  `Tagvalue` decimal(10,5) NOT NULL,
  PRIMARY KEY (`Moment`),
  UNIQUE KEY `Index_2` (`Moment`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `measurement309`
--

DROP TABLE IF EXISTS `measurement309`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `measurement309` (
  `Moment` datetime NOT NULL,
  `Tagvalue` decimal(10,5) NOT NULL,
  PRIMARY KEY (`Moment`),
  UNIQUE KEY `Index_2` (`Moment`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `measurement31`
--

DROP TABLE IF EXISTS `measurement31`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `measurement31` (
  `Moment` datetime NOT NULL,
  `Tagvalue` decimal(10,5) NOT NULL,
  PRIMARY KEY (`Moment`),
  UNIQUE KEY `Index_2` (`Moment`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `measurement310`
--

DROP TABLE IF EXISTS `measurement310`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `measurement310` (
  `Moment` datetime NOT NULL,
  `Tagvalue` decimal(10,5) NOT NULL,
  PRIMARY KEY (`Moment`),
  UNIQUE KEY `Index_2` (`Moment`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `measurement311`
--

DROP TABLE IF EXISTS `measurement311`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `measurement311` (
  `Moment` datetime NOT NULL,
  `Tagvalue` decimal(10,5) NOT NULL,
  PRIMARY KEY (`Moment`),
  UNIQUE KEY `Index_2` (`Moment`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `measurement312`
--

DROP TABLE IF EXISTS `measurement312`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `measurement312` (
  `Moment` datetime NOT NULL,
  `Tagvalue` decimal(10,5) NOT NULL,
  PRIMARY KEY (`Moment`),
  UNIQUE KEY `Index_2` (`Moment`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `measurement313`
--

DROP TABLE IF EXISTS `measurement313`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `measurement313` (
  `Moment` datetime NOT NULL,
  `Tagvalue` decimal(10,5) NOT NULL,
  PRIMARY KEY (`Moment`),
  UNIQUE KEY `Index_2` (`Moment`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `measurement314`
--

DROP TABLE IF EXISTS `measurement314`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `measurement314` (
  `Moment` datetime NOT NULL,
  `Tagvalue` decimal(10,5) NOT NULL,
  PRIMARY KEY (`Moment`),
  UNIQUE KEY `Index_2` (`Moment`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `measurement315`
--

DROP TABLE IF EXISTS `measurement315`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `measurement315` (
  `Moment` datetime NOT NULL,
  `Tagvalue` decimal(10,5) NOT NULL,
  PRIMARY KEY (`Moment`),
  UNIQUE KEY `Index_2` (`Moment`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `measurement316`
--

DROP TABLE IF EXISTS `measurement316`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `measurement316` (
  `Moment` datetime NOT NULL,
  `Tagvalue` decimal(10,5) NOT NULL,
  PRIMARY KEY (`Moment`),
  UNIQUE KEY `Index_2` (`Moment`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `measurement317`
--

DROP TABLE IF EXISTS `measurement317`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `measurement317` (
  `Moment` datetime NOT NULL,
  `Tagvalue` decimal(10,5) NOT NULL,
  PRIMARY KEY (`Moment`),
  UNIQUE KEY `Index_2` (`Moment`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `measurement318`
--

DROP TABLE IF EXISTS `measurement318`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `measurement318` (
  `Moment` datetime NOT NULL,
  `Tagvalue` decimal(10,5) NOT NULL,
  PRIMARY KEY (`Moment`),
  UNIQUE KEY `Index_2` (`Moment`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `measurement319`
--

DROP TABLE IF EXISTS `measurement319`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `measurement319` (
  `Moment` datetime NOT NULL,
  `Tagvalue` decimal(10,5) NOT NULL,
  PRIMARY KEY (`Moment`),
  UNIQUE KEY `Index_2` (`Moment`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `measurement32`
--

DROP TABLE IF EXISTS `measurement32`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `measurement32` (
  `Moment` datetime NOT NULL,
  `Tagvalue` decimal(10,5) NOT NULL,
  PRIMARY KEY (`Moment`),
  UNIQUE KEY `Index_2` (`Moment`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `measurement320`
--

DROP TABLE IF EXISTS `measurement320`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `measurement320` (
  `Moment` datetime NOT NULL,
  `Tagvalue` decimal(10,5) NOT NULL,
  PRIMARY KEY (`Moment`),
  UNIQUE KEY `Index_2` (`Moment`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `measurement321`
--

DROP TABLE IF EXISTS `measurement321`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `measurement321` (
  `Moment` datetime NOT NULL,
  `Tagvalue` decimal(10,5) NOT NULL,
  PRIMARY KEY (`Moment`),
  UNIQUE KEY `Index_2` (`Moment`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `measurement322`
--

DROP TABLE IF EXISTS `measurement322`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `measurement322` (
  `Moment` datetime NOT NULL,
  `Tagvalue` decimal(10,5) NOT NULL,
  PRIMARY KEY (`Moment`),
  UNIQUE KEY `Index_2` (`Moment`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `measurement323`
--

DROP TABLE IF EXISTS `measurement323`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `measurement323` (
  `Moment` datetime NOT NULL,
  `Tagvalue` decimal(10,5) NOT NULL,
  PRIMARY KEY (`Moment`),
  UNIQUE KEY `Index_2` (`Moment`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `measurement324`
--

DROP TABLE IF EXISTS `measurement324`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `measurement324` (
  `Moment` datetime NOT NULL,
  `Tagvalue` decimal(10,5) NOT NULL,
  PRIMARY KEY (`Moment`),
  UNIQUE KEY `Index_2` (`Moment`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `measurement325`
--

DROP TABLE IF EXISTS `measurement325`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `measurement325` (
  `Moment` datetime NOT NULL,
  `Tagvalue` decimal(10,5) NOT NULL,
  PRIMARY KEY (`Moment`),
  UNIQUE KEY `Index_2` (`Moment`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `measurement326`
--

DROP TABLE IF EXISTS `measurement326`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `measurement326` (
  `Moment` datetime NOT NULL,
  `Tagvalue` decimal(10,5) NOT NULL,
  PRIMARY KEY (`Moment`),
  UNIQUE KEY `Index_2` (`Moment`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `measurement327`
--

DROP TABLE IF EXISTS `measurement327`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `measurement327` (
  `Moment` datetime NOT NULL,
  `Tagvalue` decimal(10,5) NOT NULL,
  PRIMARY KEY (`Moment`),
  UNIQUE KEY `Index_2` (`Moment`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `measurement328`
--

DROP TABLE IF EXISTS `measurement328`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `measurement328` (
  `Moment` datetime NOT NULL,
  `Tagvalue` decimal(10,5) NOT NULL,
  PRIMARY KEY (`Moment`),
  UNIQUE KEY `Index_2` (`Moment`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `measurement329`
--

DROP TABLE IF EXISTS `measurement329`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `measurement329` (
  `Moment` datetime NOT NULL,
  `Tagvalue` decimal(10,5) NOT NULL,
  PRIMARY KEY (`Moment`),
  UNIQUE KEY `Index_2` (`Moment`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `measurement33`
--

DROP TABLE IF EXISTS `measurement33`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `measurement33` (
  `Moment` datetime NOT NULL,
  `Tagvalue` decimal(10,5) NOT NULL,
  PRIMARY KEY (`Moment`),
  UNIQUE KEY `Index_2` (`Moment`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `measurement330`
--

DROP TABLE IF EXISTS `measurement330`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `measurement330` (
  `Moment` datetime NOT NULL,
  `Tagvalue` decimal(10,5) NOT NULL,
  PRIMARY KEY (`Moment`),
  UNIQUE KEY `Index_2` (`Moment`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `measurement331`
--

DROP TABLE IF EXISTS `measurement331`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `measurement331` (
  `Moment` datetime NOT NULL,
  `Tagvalue` decimal(10,5) NOT NULL,
  PRIMARY KEY (`Moment`),
  UNIQUE KEY `Index_2` (`Moment`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `measurement332`
--

DROP TABLE IF EXISTS `measurement332`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `measurement332` (
  `Moment` datetime NOT NULL,
  `Tagvalue` decimal(10,5) NOT NULL,
  PRIMARY KEY (`Moment`),
  UNIQUE KEY `Index_2` (`Moment`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `measurement333`
--

DROP TABLE IF EXISTS `measurement333`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `measurement333` (
  `Moment` datetime NOT NULL,
  `Tagvalue` decimal(10,5) NOT NULL,
  PRIMARY KEY (`Moment`),
  UNIQUE KEY `Index_2` (`Moment`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `measurement334`
--

DROP TABLE IF EXISTS `measurement334`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `measurement334` (
  `Moment` datetime NOT NULL,
  `Tagvalue` decimal(10,5) NOT NULL,
  PRIMARY KEY (`Moment`),
  UNIQUE KEY `Index_2` (`Moment`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `measurement335`
--

DROP TABLE IF EXISTS `measurement335`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `measurement335` (
  `Moment` datetime NOT NULL,
  `Tagvalue` decimal(10,5) NOT NULL,
  PRIMARY KEY (`Moment`),
  UNIQUE KEY `Index_2` (`Moment`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `measurement336`
--

DROP TABLE IF EXISTS `measurement336`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `measurement336` (
  `Moment` datetime NOT NULL,
  `Tagvalue` decimal(10,5) NOT NULL,
  PRIMARY KEY (`Moment`),
  UNIQUE KEY `Index_2` (`Moment`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `measurement337`
--

DROP TABLE IF EXISTS `measurement337`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `measurement337` (
  `Moment` datetime NOT NULL,
  `Tagvalue` decimal(10,5) NOT NULL,
  PRIMARY KEY (`Moment`),
  UNIQUE KEY `Index_2` (`Moment`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `measurement338`
--

DROP TABLE IF EXISTS `measurement338`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `measurement338` (
  `Moment` datetime NOT NULL,
  `Tagvalue` decimal(10,5) NOT NULL,
  PRIMARY KEY (`Moment`),
  UNIQUE KEY `Index_2` (`Moment`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `measurement339`
--

DROP TABLE IF EXISTS `measurement339`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `measurement339` (
  `Moment` datetime NOT NULL,
  `Tagvalue` decimal(10,5) NOT NULL,
  PRIMARY KEY (`Moment`),
  UNIQUE KEY `Index_2` (`Moment`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `measurement34`
--

DROP TABLE IF EXISTS `measurement34`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `measurement34` (
  `Moment` datetime NOT NULL,
  `Tagvalue` decimal(10,5) NOT NULL,
  PRIMARY KEY (`Moment`),
  UNIQUE KEY `Index_2` (`Moment`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `measurement340`
--

DROP TABLE IF EXISTS `measurement340`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `measurement340` (
  `Moment` datetime NOT NULL,
  `Tagvalue` decimal(10,5) NOT NULL,
  PRIMARY KEY (`Moment`),
  UNIQUE KEY `Index_2` (`Moment`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `measurement341`
--

DROP TABLE IF EXISTS `measurement341`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `measurement341` (
  `Moment` datetime NOT NULL,
  `Tagvalue` decimal(10,5) NOT NULL,
  PRIMARY KEY (`Moment`),
  UNIQUE KEY `Index_2` (`Moment`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `measurement342`
--

DROP TABLE IF EXISTS `measurement342`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `measurement342` (
  `Moment` datetime NOT NULL,
  `Tagvalue` decimal(10,5) NOT NULL,
  PRIMARY KEY (`Moment`),
  UNIQUE KEY `Index_2` (`Moment`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `measurement343`
--

DROP TABLE IF EXISTS `measurement343`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `measurement343` (
  `Moment` datetime NOT NULL,
  `Tagvalue` decimal(10,5) NOT NULL,
  PRIMARY KEY (`Moment`),
  UNIQUE KEY `Index_2` (`Moment`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `measurement344`
--

DROP TABLE IF EXISTS `measurement344`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `measurement344` (
  `Moment` datetime NOT NULL,
  `Tagvalue` decimal(10,5) NOT NULL,
  PRIMARY KEY (`Moment`),
  UNIQUE KEY `Index_2` (`Moment`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `measurement345`
--

DROP TABLE IF EXISTS `measurement345`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `measurement345` (
  `Moment` datetime NOT NULL,
  `Tagvalue` decimal(10,5) NOT NULL,
  PRIMARY KEY (`Moment`),
  UNIQUE KEY `Index_2` (`Moment`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `measurement346`
--

DROP TABLE IF EXISTS `measurement346`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `measurement346` (
  `Moment` datetime NOT NULL,
  `Tagvalue` decimal(10,5) NOT NULL,
  PRIMARY KEY (`Moment`),
  UNIQUE KEY `Index_2` (`Moment`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `measurement347`
--

DROP TABLE IF EXISTS `measurement347`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `measurement347` (
  `Moment` datetime NOT NULL,
  `Tagvalue` decimal(10,5) NOT NULL,
  PRIMARY KEY (`Moment`),
  UNIQUE KEY `Index_2` (`Moment`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `measurement348`
--

DROP TABLE IF EXISTS `measurement348`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `measurement348` (
  `Moment` datetime NOT NULL,
  `Tagvalue` decimal(10,5) NOT NULL,
  PRIMARY KEY (`Moment`),
  UNIQUE KEY `Index_2` (`Moment`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `measurement349`
--

DROP TABLE IF EXISTS `measurement349`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `measurement349` (
  `Moment` datetime NOT NULL,
  `Tagvalue` decimal(10,5) NOT NULL,
  PRIMARY KEY (`Moment`),
  UNIQUE KEY `Index_2` (`Moment`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `measurement35`
--

DROP TABLE IF EXISTS `measurement35`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `measurement35` (
  `Moment` datetime NOT NULL,
  `Tagvalue` decimal(10,5) NOT NULL,
  PRIMARY KEY (`Moment`),
  UNIQUE KEY `Index_2` (`Moment`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `measurement350`
--

DROP TABLE IF EXISTS `measurement350`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `measurement350` (
  `Moment` datetime NOT NULL,
  `Tagvalue` decimal(10,5) NOT NULL,
  PRIMARY KEY (`Moment`),
  UNIQUE KEY `Index_2` (`Moment`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `measurement351`
--

DROP TABLE IF EXISTS `measurement351`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `measurement351` (
  `Moment` datetime NOT NULL,
  `Tagvalue` decimal(10,5) NOT NULL,
  PRIMARY KEY (`Moment`),
  UNIQUE KEY `Index_2` (`Moment`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `measurement352`
--

DROP TABLE IF EXISTS `measurement352`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `measurement352` (
  `Moment` datetime NOT NULL,
  `Tagvalue` decimal(10,5) NOT NULL,
  PRIMARY KEY (`Moment`),
  UNIQUE KEY `Index_2` (`Moment`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `measurement353`
--

DROP TABLE IF EXISTS `measurement353`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `measurement353` (
  `Moment` datetime NOT NULL,
  `Tagvalue` decimal(10,5) NOT NULL,
  PRIMARY KEY (`Moment`),
  UNIQUE KEY `Index_2` (`Moment`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `measurement354`
--

DROP TABLE IF EXISTS `measurement354`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `measurement354` (
  `Moment` datetime NOT NULL,
  `Tagvalue` decimal(10,5) NOT NULL,
  PRIMARY KEY (`Moment`),
  UNIQUE KEY `Index_2` (`Moment`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `measurement355`
--

DROP TABLE IF EXISTS `measurement355`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `measurement355` (
  `Moment` datetime NOT NULL,
  `Tagvalue` decimal(10,5) NOT NULL,
  PRIMARY KEY (`Moment`),
  UNIQUE KEY `Index_2` (`Moment`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `measurement356`
--

DROP TABLE IF EXISTS `measurement356`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `measurement356` (
  `Moment` datetime NOT NULL,
  `Tagvalue` decimal(10,5) NOT NULL,
  PRIMARY KEY (`Moment`),
  UNIQUE KEY `Index_2` (`Moment`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `measurement357`
--

DROP TABLE IF EXISTS `measurement357`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `measurement357` (
  `Moment` datetime NOT NULL,
  `Tagvalue` decimal(10,5) NOT NULL,
  PRIMARY KEY (`Moment`),
  UNIQUE KEY `Index_2` (`Moment`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `measurement358`
--

DROP TABLE IF EXISTS `measurement358`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `measurement358` (
  `Moment` datetime NOT NULL,
  `Tagvalue` decimal(10,5) NOT NULL,
  PRIMARY KEY (`Moment`),
  UNIQUE KEY `Index_2` (`Moment`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `measurement359`
--

DROP TABLE IF EXISTS `measurement359`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `measurement359` (
  `Moment` datetime NOT NULL,
  `Tagvalue` decimal(10,5) NOT NULL,
  PRIMARY KEY (`Moment`),
  UNIQUE KEY `Index_2` (`Moment`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `measurement36`
--

DROP TABLE IF EXISTS `measurement36`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `measurement36` (
  `Moment` datetime NOT NULL,
  `Tagvalue` decimal(10,5) NOT NULL,
  PRIMARY KEY (`Moment`),
  UNIQUE KEY `Index_2` (`Moment`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `measurement360`
--

DROP TABLE IF EXISTS `measurement360`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `measurement360` (
  `Moment` datetime NOT NULL,
  `Tagvalue` decimal(10,5) NOT NULL,
  PRIMARY KEY (`Moment`),
  UNIQUE KEY `Index_2` (`Moment`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `measurement361`
--

DROP TABLE IF EXISTS `measurement361`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `measurement361` (
  `Moment` datetime NOT NULL,
  `Tagvalue` decimal(10,5) NOT NULL,
  PRIMARY KEY (`Moment`),
  UNIQUE KEY `Index_2` (`Moment`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `measurement362`
--

DROP TABLE IF EXISTS `measurement362`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `measurement362` (
  `Moment` datetime NOT NULL,
  `Tagvalue` decimal(10,5) NOT NULL,
  PRIMARY KEY (`Moment`),
  UNIQUE KEY `Index_2` (`Moment`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `measurement363`
--

DROP TABLE IF EXISTS `measurement363`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `measurement363` (
  `Moment` datetime NOT NULL,
  `Tagvalue` decimal(10,5) NOT NULL,
  PRIMARY KEY (`Moment`),
  UNIQUE KEY `Index_2` (`Moment`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `measurement364`
--

DROP TABLE IF EXISTS `measurement364`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `measurement364` (
  `Moment` datetime NOT NULL,
  `Tagvalue` decimal(10,5) NOT NULL,
  PRIMARY KEY (`Moment`),
  UNIQUE KEY `Index_2` (`Moment`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `measurement365`
--

DROP TABLE IF EXISTS `measurement365`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `measurement365` (
  `Moment` datetime NOT NULL,
  `Tagvalue` decimal(10,5) NOT NULL,
  PRIMARY KEY (`Moment`),
  UNIQUE KEY `Index_2` (`Moment`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `measurement366`
--

DROP TABLE IF EXISTS `measurement366`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `measurement366` (
  `Moment` datetime NOT NULL,
  `Tagvalue` decimal(10,5) NOT NULL,
  PRIMARY KEY (`Moment`),
  UNIQUE KEY `Index_2` (`Moment`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `measurement367`
--

DROP TABLE IF EXISTS `measurement367`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `measurement367` (
  `Moment` datetime NOT NULL,
  `Tagvalue` decimal(10,5) NOT NULL,
  PRIMARY KEY (`Moment`),
  UNIQUE KEY `Index_2` (`Moment`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `measurement368`
--

DROP TABLE IF EXISTS `measurement368`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `measurement368` (
  `Moment` datetime NOT NULL,
  `Tagvalue` decimal(10,5) NOT NULL,
  PRIMARY KEY (`Moment`),
  UNIQUE KEY `Index_2` (`Moment`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `measurement369`
--

DROP TABLE IF EXISTS `measurement369`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `measurement369` (
  `Moment` datetime NOT NULL,
  `Tagvalue` decimal(10,5) NOT NULL,
  PRIMARY KEY (`Moment`),
  UNIQUE KEY `Index_2` (`Moment`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `measurement37`
--

DROP TABLE IF EXISTS `measurement37`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `measurement37` (
  `Moment` datetime NOT NULL,
  `Tagvalue` decimal(10,5) NOT NULL,
  PRIMARY KEY (`Moment`),
  UNIQUE KEY `Index_2` (`Moment`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `measurement370`
--

DROP TABLE IF EXISTS `measurement370`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `measurement370` (
  `Moment` datetime NOT NULL,
  `Tagvalue` decimal(10,5) NOT NULL,
  PRIMARY KEY (`Moment`),
  UNIQUE KEY `Index_2` (`Moment`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `measurement371`
--

DROP TABLE IF EXISTS `measurement371`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `measurement371` (
  `Moment` datetime NOT NULL,
  `Tagvalue` decimal(10,5) NOT NULL,
  PRIMARY KEY (`Moment`),
  UNIQUE KEY `Index_2` (`Moment`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `measurement372`
--

DROP TABLE IF EXISTS `measurement372`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `measurement372` (
  `Moment` datetime NOT NULL,
  `Tagvalue` decimal(10,5) NOT NULL,
  PRIMARY KEY (`Moment`),
  UNIQUE KEY `Index_2` (`Moment`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `measurement373`
--

DROP TABLE IF EXISTS `measurement373`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `measurement373` (
  `Moment` datetime NOT NULL,
  `Tagvalue` decimal(10,5) NOT NULL,
  PRIMARY KEY (`Moment`),
  UNIQUE KEY `Index_2` (`Moment`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `measurement374`
--

DROP TABLE IF EXISTS `measurement374`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `measurement374` (
  `Moment` datetime NOT NULL,
  `Tagvalue` decimal(10,5) NOT NULL,
  PRIMARY KEY (`Moment`),
  UNIQUE KEY `Index_2` (`Moment`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `measurement375`
--

DROP TABLE IF EXISTS `measurement375`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `measurement375` (
  `Moment` datetime NOT NULL,
  `Tagvalue` decimal(10,5) NOT NULL,
  PRIMARY KEY (`Moment`),
  UNIQUE KEY `Index_2` (`Moment`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `measurement376`
--

DROP TABLE IF EXISTS `measurement376`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `measurement376` (
  `Moment` datetime NOT NULL,
  `Tagvalue` decimal(10,5) NOT NULL,
  PRIMARY KEY (`Moment`),
  UNIQUE KEY `Index_2` (`Moment`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `measurement377`
--

DROP TABLE IF EXISTS `measurement377`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `measurement377` (
  `Moment` datetime NOT NULL,
  `Tagvalue` decimal(10,5) NOT NULL,
  PRIMARY KEY (`Moment`),
  UNIQUE KEY `Index_2` (`Moment`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `measurement378`
--

DROP TABLE IF EXISTS `measurement378`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `measurement378` (
  `Moment` datetime NOT NULL,
  `Tagvalue` decimal(10,5) NOT NULL,
  PRIMARY KEY (`Moment`),
  UNIQUE KEY `Index_2` (`Moment`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `measurement379`
--

DROP TABLE IF EXISTS `measurement379`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `measurement379` (
  `Moment` datetime NOT NULL,
  `Tagvalue` decimal(10,5) NOT NULL,
  PRIMARY KEY (`Moment`),
  UNIQUE KEY `Index_2` (`Moment`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `measurement38`
--

DROP TABLE IF EXISTS `measurement38`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `measurement38` (
  `Moment` datetime NOT NULL,
  `Tagvalue` decimal(10,5) NOT NULL,
  PRIMARY KEY (`Moment`),
  UNIQUE KEY `Index_2` (`Moment`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `measurement380`
--

DROP TABLE IF EXISTS `measurement380`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `measurement380` (
  `Moment` datetime NOT NULL,
  `Tagvalue` decimal(10,5) NOT NULL,
  PRIMARY KEY (`Moment`),
  UNIQUE KEY `Index_2` (`Moment`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `measurement381`
--

DROP TABLE IF EXISTS `measurement381`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `measurement381` (
  `Moment` datetime NOT NULL,
  `Tagvalue` decimal(10,5) NOT NULL,
  PRIMARY KEY (`Moment`),
  UNIQUE KEY `Index_2` (`Moment`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `measurement382`
--

DROP TABLE IF EXISTS `measurement382`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `measurement382` (
  `Moment` datetime NOT NULL,
  `Tagvalue` decimal(10,5) NOT NULL,
  PRIMARY KEY (`Moment`),
  UNIQUE KEY `Index_2` (`Moment`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `measurement383`
--

DROP TABLE IF EXISTS `measurement383`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `measurement383` (
  `Moment` datetime NOT NULL,
  `Tagvalue` decimal(10,5) NOT NULL,
  PRIMARY KEY (`Moment`),
  UNIQUE KEY `Index_2` (`Moment`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `measurement384`
--

DROP TABLE IF EXISTS `measurement384`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `measurement384` (
  `Moment` datetime NOT NULL,
  `Tagvalue` decimal(10,5) NOT NULL,
  PRIMARY KEY (`Moment`),
  UNIQUE KEY `Index_2` (`Moment`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `measurement385`
--

DROP TABLE IF EXISTS `measurement385`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `measurement385` (
  `Moment` datetime NOT NULL,
  `Tagvalue` decimal(10,5) NOT NULL,
  PRIMARY KEY (`Moment`),
  UNIQUE KEY `Index_2` (`Moment`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `measurement386`
--

DROP TABLE IF EXISTS `measurement386`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `measurement386` (
  `Moment` datetime NOT NULL,
  `Tagvalue` decimal(10,5) NOT NULL,
  PRIMARY KEY (`Moment`),
  UNIQUE KEY `Index_2` (`Moment`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `measurement387`
--

DROP TABLE IF EXISTS `measurement387`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `measurement387` (
  `Moment` datetime NOT NULL,
  `Tagvalue` decimal(10,5) NOT NULL,
  PRIMARY KEY (`Moment`),
  UNIQUE KEY `Index_2` (`Moment`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `measurement388`
--

DROP TABLE IF EXISTS `measurement388`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `measurement388` (
  `Moment` datetime NOT NULL,
  `Tagvalue` decimal(10,5) NOT NULL,
  PRIMARY KEY (`Moment`),
  UNIQUE KEY `Index_2` (`Moment`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `measurement389`
--

DROP TABLE IF EXISTS `measurement389`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `measurement389` (
  `Moment` datetime NOT NULL,
  `Tagvalue` decimal(10,5) NOT NULL,
  PRIMARY KEY (`Moment`),
  UNIQUE KEY `Index_2` (`Moment`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `measurement39`
--

DROP TABLE IF EXISTS `measurement39`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `measurement39` (
  `Moment` datetime NOT NULL,
  `Tagvalue` decimal(10,5) NOT NULL,
  PRIMARY KEY (`Moment`),
  UNIQUE KEY `Index_2` (`Moment`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `measurement390`
--

DROP TABLE IF EXISTS `measurement390`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `measurement390` (
  `Moment` datetime NOT NULL,
  `Tagvalue` decimal(10,5) NOT NULL,
  PRIMARY KEY (`Moment`),
  UNIQUE KEY `Index_2` (`Moment`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `measurement391`
--

DROP TABLE IF EXISTS `measurement391`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `measurement391` (
  `Moment` datetime NOT NULL,
  `Tagvalue` decimal(10,5) NOT NULL,
  PRIMARY KEY (`Moment`),
  UNIQUE KEY `Index_2` (`Moment`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `measurement392`
--

DROP TABLE IF EXISTS `measurement392`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `measurement392` (
  `Moment` datetime NOT NULL,
  `Tagvalue` decimal(10,5) NOT NULL,
  PRIMARY KEY (`Moment`),
  UNIQUE KEY `Index_2` (`Moment`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `measurement393`
--

DROP TABLE IF EXISTS `measurement393`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `measurement393` (
  `Moment` datetime NOT NULL,
  `Tagvalue` decimal(10,5) NOT NULL,
  PRIMARY KEY (`Moment`),
  UNIQUE KEY `Index_2` (`Moment`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `measurement394`
--

DROP TABLE IF EXISTS `measurement394`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `measurement394` (
  `Moment` datetime NOT NULL,
  `Tagvalue` decimal(10,5) NOT NULL,
  PRIMARY KEY (`Moment`),
  UNIQUE KEY `Index_2` (`Moment`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `measurement395`
--

DROP TABLE IF EXISTS `measurement395`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `measurement395` (
  `Moment` datetime NOT NULL,
  `Tagvalue` decimal(10,5) NOT NULL,
  PRIMARY KEY (`Moment`),
  UNIQUE KEY `Index_2` (`Moment`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `measurement396`
--

DROP TABLE IF EXISTS `measurement396`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `measurement396` (
  `Moment` datetime NOT NULL,
  `Tagvalue` decimal(10,5) NOT NULL,
  PRIMARY KEY (`Moment`),
  UNIQUE KEY `Index_2` (`Moment`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `measurement397`
--

DROP TABLE IF EXISTS `measurement397`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `measurement397` (
  `Moment` datetime NOT NULL,
  `Tagvalue` decimal(10,5) NOT NULL,
  PRIMARY KEY (`Moment`),
  UNIQUE KEY `Index_2` (`Moment`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `measurement398`
--

DROP TABLE IF EXISTS `measurement398`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `measurement398` (
  `Moment` datetime NOT NULL,
  `Tagvalue` decimal(10,5) NOT NULL,
  PRIMARY KEY (`Moment`),
  UNIQUE KEY `Index_2` (`Moment`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `measurement399`
--

DROP TABLE IF EXISTS `measurement399`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `measurement399` (
  `Moment` datetime NOT NULL,
  `Tagvalue` decimal(10,5) NOT NULL,
  PRIMARY KEY (`Moment`),
  UNIQUE KEY `Index_2` (`Moment`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `measurement4`
--

DROP TABLE IF EXISTS `measurement4`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `measurement4` (
  `Moment` datetime NOT NULL,
  `Tagvalue` decimal(10,5) NOT NULL,
  PRIMARY KEY (`Moment`),
  UNIQUE KEY `Index_2` (`Moment`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `measurement40`
--

DROP TABLE IF EXISTS `measurement40`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `measurement40` (
  `Moment` datetime NOT NULL,
  `Tagvalue` decimal(10,5) NOT NULL,
  PRIMARY KEY (`Moment`),
  UNIQUE KEY `Index_2` (`Moment`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `measurement400`
--

DROP TABLE IF EXISTS `measurement400`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `measurement400` (
  `Moment` datetime NOT NULL,
  `Tagvalue` decimal(10,5) NOT NULL,
  PRIMARY KEY (`Moment`),
  UNIQUE KEY `Index_2` (`Moment`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `measurement401`
--

DROP TABLE IF EXISTS `measurement401`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `measurement401` (
  `Moment` datetime NOT NULL,
  `Tagvalue` decimal(10,5) NOT NULL,
  PRIMARY KEY (`Moment`),
  UNIQUE KEY `Index_2` (`Moment`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `measurement402`
--

DROP TABLE IF EXISTS `measurement402`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `measurement402` (
  `Moment` datetime NOT NULL,
  `Tagvalue` decimal(10,5) NOT NULL,
  PRIMARY KEY (`Moment`),
  UNIQUE KEY `Index_2` (`Moment`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `measurement403`
--

DROP TABLE IF EXISTS `measurement403`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `measurement403` (
  `Moment` datetime NOT NULL,
  `Tagvalue` decimal(10,5) NOT NULL,
  PRIMARY KEY (`Moment`),
  UNIQUE KEY `Index_2` (`Moment`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `measurement404`
--

DROP TABLE IF EXISTS `measurement404`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `measurement404` (
  `Moment` datetime NOT NULL,
  `Tagvalue` decimal(10,5) NOT NULL,
  PRIMARY KEY (`Moment`),
  UNIQUE KEY `Index_2` (`Moment`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `measurement41`
--

DROP TABLE IF EXISTS `measurement41`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `measurement41` (
  `Moment` datetime NOT NULL,
  `Tagvalue` decimal(10,5) NOT NULL,
  PRIMARY KEY (`Moment`),
  UNIQUE KEY `Index_2` (`Moment`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `measurement42`
--

DROP TABLE IF EXISTS `measurement42`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `measurement42` (
  `Moment` datetime NOT NULL,
  `Tagvalue` decimal(10,5) NOT NULL,
  PRIMARY KEY (`Moment`),
  UNIQUE KEY `Index_2` (`Moment`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `measurement43`
--

DROP TABLE IF EXISTS `measurement43`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `measurement43` (
  `Moment` datetime NOT NULL,
  `Tagvalue` decimal(10,5) NOT NULL,
  PRIMARY KEY (`Moment`),
  UNIQUE KEY `Index_2` (`Moment`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `measurement44`
--

DROP TABLE IF EXISTS `measurement44`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `measurement44` (
  `Moment` datetime NOT NULL,
  `Tagvalue` decimal(10,5) NOT NULL,
  PRIMARY KEY (`Moment`),
  UNIQUE KEY `Index_2` (`Moment`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `measurement45`
--

DROP TABLE IF EXISTS `measurement45`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `measurement45` (
  `Moment` datetime NOT NULL,
  `Tagvalue` decimal(10,5) NOT NULL,
  PRIMARY KEY (`Moment`),
  UNIQUE KEY `Index_2` (`Moment`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `measurement46`
--

DROP TABLE IF EXISTS `measurement46`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `measurement46` (
  `Moment` datetime NOT NULL,
  `Tagvalue` decimal(10,5) NOT NULL,
  PRIMARY KEY (`Moment`),
  UNIQUE KEY `Index_2` (`Moment`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `measurement47`
--

DROP TABLE IF EXISTS `measurement47`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `measurement47` (
  `Moment` datetime NOT NULL,
  `Tagvalue` decimal(10,5) NOT NULL,
  PRIMARY KEY (`Moment`),
  UNIQUE KEY `Index_2` (`Moment`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `measurement48`
--

DROP TABLE IF EXISTS `measurement48`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `measurement48` (
  `Moment` datetime NOT NULL,
  `Tagvalue` decimal(10,5) NOT NULL,
  PRIMARY KEY (`Moment`),
  UNIQUE KEY `Index_2` (`Moment`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `measurement49`
--

DROP TABLE IF EXISTS `measurement49`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `measurement49` (
  `Moment` datetime NOT NULL,
  `Tagvalue` decimal(10,5) NOT NULL,
  PRIMARY KEY (`Moment`),
  UNIQUE KEY `Index_2` (`Moment`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `measurement50`
--

DROP TABLE IF EXISTS `measurement50`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `measurement50` (
  `Moment` datetime NOT NULL,
  `Tagvalue` decimal(10,5) NOT NULL,
  PRIMARY KEY (`Moment`),
  UNIQUE KEY `Index_2` (`Moment`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `measurement51`
--

DROP TABLE IF EXISTS `measurement51`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `measurement51` (
  `Moment` datetime NOT NULL,
  `Tagvalue` decimal(10,5) NOT NULL,
  PRIMARY KEY (`Moment`),
  UNIQUE KEY `Index_2` (`Moment`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `measurement52`
--

DROP TABLE IF EXISTS `measurement52`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `measurement52` (
  `Moment` datetime NOT NULL,
  `Tagvalue` decimal(10,5) NOT NULL,
  PRIMARY KEY (`Moment`),
  UNIQUE KEY `Index_2` (`Moment`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `measurement53`
--

DROP TABLE IF EXISTS `measurement53`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `measurement53` (
  `Moment` datetime NOT NULL,
  `Tagvalue` decimal(10,5) NOT NULL,
  PRIMARY KEY (`Moment`),
  UNIQUE KEY `Index_2` (`Moment`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `measurement54`
--

DROP TABLE IF EXISTS `measurement54`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `measurement54` (
  `Moment` datetime NOT NULL,
  `Tagvalue` decimal(10,5) NOT NULL,
  PRIMARY KEY (`Moment`),
  UNIQUE KEY `Index_2` (`Moment`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `measurement55`
--

DROP TABLE IF EXISTS `measurement55`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `measurement55` (
  `Moment` datetime NOT NULL,
  `Tagvalue` decimal(10,5) NOT NULL,
  PRIMARY KEY (`Moment`),
  UNIQUE KEY `Index_2` (`Moment`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `measurement56`
--

DROP TABLE IF EXISTS `measurement56`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `measurement56` (
  `Moment` datetime NOT NULL,
  `Tagvalue` decimal(10,5) NOT NULL,
  PRIMARY KEY (`Moment`),
  UNIQUE KEY `Index_2` (`Moment`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `measurement57`
--

DROP TABLE IF EXISTS `measurement57`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `measurement57` (
  `Moment` datetime NOT NULL,
  `Tagvalue` decimal(10,5) NOT NULL,
  PRIMARY KEY (`Moment`),
  UNIQUE KEY `Index_2` (`Moment`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `measurement58`
--

DROP TABLE IF EXISTS `measurement58`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `measurement58` (
  `Moment` datetime NOT NULL,
  `Tagvalue` decimal(10,5) NOT NULL,
  PRIMARY KEY (`Moment`),
  UNIQUE KEY `Index_2` (`Moment`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `measurement59`
--

DROP TABLE IF EXISTS `measurement59`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `measurement59` (
  `Moment` datetime NOT NULL,
  `Tagvalue` decimal(10,5) NOT NULL,
  PRIMARY KEY (`Moment`),
  UNIQUE KEY `Index_2` (`Moment`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `measurement6`
--

DROP TABLE IF EXISTS `measurement6`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `measurement6` (
  `Moment` datetime NOT NULL,
  `Tagvalue` decimal(10,5) NOT NULL,
  PRIMARY KEY (`Moment`),
  UNIQUE KEY `Index_2` (`Moment`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `measurement60`
--

DROP TABLE IF EXISTS `measurement60`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `measurement60` (
  `Moment` datetime NOT NULL,
  `Tagvalue` decimal(10,5) NOT NULL,
  PRIMARY KEY (`Moment`),
  UNIQUE KEY `Index_2` (`Moment`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `measurement61`
--

DROP TABLE IF EXISTS `measurement61`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `measurement61` (
  `Moment` datetime NOT NULL,
  `Tagvalue` decimal(10,5) NOT NULL,
  PRIMARY KEY (`Moment`),
  UNIQUE KEY `Index_2` (`Moment`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `measurement62`
--

DROP TABLE IF EXISTS `measurement62`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `measurement62` (
  `Moment` datetime NOT NULL,
  `Tagvalue` decimal(10,5) NOT NULL,
  PRIMARY KEY (`Moment`),
  UNIQUE KEY `Index_2` (`Moment`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `measurement63`
--

DROP TABLE IF EXISTS `measurement63`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `measurement63` (
  `Moment` datetime NOT NULL,
  `Tagvalue` decimal(10,5) NOT NULL,
  PRIMARY KEY (`Moment`),
  UNIQUE KEY `Index_2` (`Moment`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `measurement64`
--

DROP TABLE IF EXISTS `measurement64`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `measurement64` (
  `Moment` datetime NOT NULL,
  `Tagvalue` decimal(10,5) NOT NULL,
  PRIMARY KEY (`Moment`),
  UNIQUE KEY `Index_2` (`Moment`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `measurement65`
--

DROP TABLE IF EXISTS `measurement65`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `measurement65` (
  `Moment` datetime NOT NULL,
  `Tagvalue` decimal(10,5) NOT NULL,
  PRIMARY KEY (`Moment`),
  UNIQUE KEY `Index_2` (`Moment`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `measurement66`
--

DROP TABLE IF EXISTS `measurement66`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `measurement66` (
  `Moment` datetime NOT NULL,
  `Tagvalue` decimal(10,5) NOT NULL,
  PRIMARY KEY (`Moment`),
  UNIQUE KEY `Index_2` (`Moment`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `measurement67`
--

DROP TABLE IF EXISTS `measurement67`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `measurement67` (
  `Moment` datetime NOT NULL,
  `Tagvalue` decimal(10,5) NOT NULL,
  PRIMARY KEY (`Moment`),
  UNIQUE KEY `Index_2` (`Moment`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `measurement68`
--

DROP TABLE IF EXISTS `measurement68`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `measurement68` (
  `Moment` datetime NOT NULL,
  `Tagvalue` decimal(10,5) NOT NULL,
  PRIMARY KEY (`Moment`),
  UNIQUE KEY `Index_2` (`Moment`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `measurement69`
--

DROP TABLE IF EXISTS `measurement69`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `measurement69` (
  `Moment` datetime NOT NULL,
  `Tagvalue` decimal(10,5) NOT NULL,
  PRIMARY KEY (`Moment`),
  UNIQUE KEY `Index_2` (`Moment`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `measurement7`
--

DROP TABLE IF EXISTS `measurement7`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `measurement7` (
  `Moment` datetime NOT NULL,
  `Tagvalue` decimal(10,5) NOT NULL,
  PRIMARY KEY (`Moment`),
  UNIQUE KEY `Index_2` (`Moment`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `measurement70`
--

DROP TABLE IF EXISTS `measurement70`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `measurement70` (
  `Moment` datetime NOT NULL,
  `Tagvalue` decimal(10,5) NOT NULL,
  PRIMARY KEY (`Moment`),
  UNIQUE KEY `Index_2` (`Moment`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `measurement71`
--

DROP TABLE IF EXISTS `measurement71`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `measurement71` (
  `Moment` datetime NOT NULL,
  `Tagvalue` decimal(10,5) NOT NULL,
  PRIMARY KEY (`Moment`),
  UNIQUE KEY `Index_2` (`Moment`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `measurement72`
--

DROP TABLE IF EXISTS `measurement72`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `measurement72` (
  `Moment` datetime NOT NULL,
  `Tagvalue` decimal(10,5) NOT NULL,
  PRIMARY KEY (`Moment`),
  UNIQUE KEY `Index_2` (`Moment`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `measurement73`
--

DROP TABLE IF EXISTS `measurement73`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `measurement73` (
  `Moment` datetime NOT NULL,
  `Tagvalue` decimal(10,5) NOT NULL,
  PRIMARY KEY (`Moment`),
  UNIQUE KEY `Index_2` (`Moment`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `measurement74`
--

DROP TABLE IF EXISTS `measurement74`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `measurement74` (
  `Moment` datetime NOT NULL,
  `Tagvalue` decimal(10,5) NOT NULL,
  PRIMARY KEY (`Moment`),
  UNIQUE KEY `Index_2` (`Moment`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `measurement75`
--

DROP TABLE IF EXISTS `measurement75`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `measurement75` (
  `Moment` datetime NOT NULL,
  `Tagvalue` decimal(10,5) NOT NULL,
  PRIMARY KEY (`Moment`),
  UNIQUE KEY `Index_2` (`Moment`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `measurement76`
--

DROP TABLE IF EXISTS `measurement76`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `measurement76` (
  `Moment` datetime NOT NULL,
  `Tagvalue` decimal(10,5) NOT NULL,
  PRIMARY KEY (`Moment`),
  UNIQUE KEY `Index_2` (`Moment`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `measurement77`
--

DROP TABLE IF EXISTS `measurement77`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `measurement77` (
  `Moment` datetime NOT NULL,
  `Tagvalue` decimal(10,5) NOT NULL,
  PRIMARY KEY (`Moment`),
  UNIQUE KEY `Index_2` (`Moment`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `measurement78`
--

DROP TABLE IF EXISTS `measurement78`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `measurement78` (
  `Moment` datetime NOT NULL,
  `Tagvalue` decimal(10,5) NOT NULL,
  PRIMARY KEY (`Moment`),
  UNIQUE KEY `Index_2` (`Moment`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `measurement79`
--

DROP TABLE IF EXISTS `measurement79`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `measurement79` (
  `Moment` datetime NOT NULL,
  `Tagvalue` decimal(10,5) NOT NULL,
  PRIMARY KEY (`Moment`),
  UNIQUE KEY `Index_2` (`Moment`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `measurement8`
--

DROP TABLE IF EXISTS `measurement8`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `measurement8` (
  `Moment` datetime NOT NULL,
  `Tagvalue` decimal(10,5) NOT NULL,
  PRIMARY KEY (`Moment`),
  UNIQUE KEY `Index_2` (`Moment`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `measurement80`
--

DROP TABLE IF EXISTS `measurement80`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `measurement80` (
  `Moment` datetime NOT NULL,
  `Tagvalue` decimal(10,5) NOT NULL,
  PRIMARY KEY (`Moment`),
  UNIQUE KEY `Index_2` (`Moment`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `measurement81`
--

DROP TABLE IF EXISTS `measurement81`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `measurement81` (
  `Moment` datetime NOT NULL,
  `Tagvalue` decimal(10,5) NOT NULL,
  PRIMARY KEY (`Moment`),
  UNIQUE KEY `Index_2` (`Moment`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `measurement82`
--

DROP TABLE IF EXISTS `measurement82`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `measurement82` (
  `Moment` datetime NOT NULL,
  `Tagvalue` decimal(10,5) NOT NULL,
  PRIMARY KEY (`Moment`),
  UNIQUE KEY `Index_2` (`Moment`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `measurement83`
--

DROP TABLE IF EXISTS `measurement83`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `measurement83` (
  `Moment` datetime NOT NULL,
  `Tagvalue` decimal(10,5) NOT NULL,
  PRIMARY KEY (`Moment`),
  UNIQUE KEY `Index_2` (`Moment`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `measurement84`
--

DROP TABLE IF EXISTS `measurement84`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `measurement84` (
  `Moment` datetime NOT NULL,
  `Tagvalue` decimal(10,5) NOT NULL,
  PRIMARY KEY (`Moment`),
  UNIQUE KEY `Index_2` (`Moment`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `measurement85`
--

DROP TABLE IF EXISTS `measurement85`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `measurement85` (
  `Moment` datetime NOT NULL,
  `Tagvalue` decimal(10,5) NOT NULL,
  PRIMARY KEY (`Moment`),
  UNIQUE KEY `Index_2` (`Moment`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `measurement86`
--

DROP TABLE IF EXISTS `measurement86`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `measurement86` (
  `Moment` datetime NOT NULL,
  `Tagvalue` decimal(10,5) NOT NULL,
  PRIMARY KEY (`Moment`),
  UNIQUE KEY `Index_2` (`Moment`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `measurement87`
--

DROP TABLE IF EXISTS `measurement87`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `measurement87` (
  `Moment` datetime NOT NULL,
  `Tagvalue` decimal(10,5) NOT NULL,
  PRIMARY KEY (`Moment`),
  UNIQUE KEY `Index_2` (`Moment`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `measurement88`
--

DROP TABLE IF EXISTS `measurement88`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `measurement88` (
  `Moment` datetime NOT NULL,
  `Tagvalue` decimal(10,5) NOT NULL,
  PRIMARY KEY (`Moment`),
  UNIQUE KEY `Index_2` (`Moment`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `measurement89`
--

DROP TABLE IF EXISTS `measurement89`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `measurement89` (
  `Moment` datetime NOT NULL,
  `Tagvalue` decimal(10,5) NOT NULL,
  PRIMARY KEY (`Moment`),
  UNIQUE KEY `Index_2` (`Moment`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `measurement9`
--

DROP TABLE IF EXISTS `measurement9`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `measurement9` (
  `Moment` datetime NOT NULL,
  `Tagvalue` decimal(10,5) NOT NULL,
  PRIMARY KEY (`Moment`),
  UNIQUE KEY `Index_2` (`Moment`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `measurement90`
--

DROP TABLE IF EXISTS `measurement90`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `measurement90` (
  `Moment` datetime NOT NULL,
  `Tagvalue` decimal(10,5) NOT NULL,
  PRIMARY KEY (`Moment`),
  UNIQUE KEY `Index_2` (`Moment`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `measurement91`
--

DROP TABLE IF EXISTS `measurement91`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `measurement91` (
  `Moment` datetime NOT NULL,
  `Tagvalue` decimal(10,5) NOT NULL,
  PRIMARY KEY (`Moment`),
  UNIQUE KEY `Index_2` (`Moment`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `measurement92`
--

DROP TABLE IF EXISTS `measurement92`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `measurement92` (
  `Moment` datetime NOT NULL,
  `Tagvalue` decimal(10,5) NOT NULL,
  PRIMARY KEY (`Moment`),
  UNIQUE KEY `Index_2` (`Moment`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `measurement93`
--

DROP TABLE IF EXISTS `measurement93`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `measurement93` (
  `Moment` datetime NOT NULL,
  `Tagvalue` decimal(10,5) NOT NULL,
  PRIMARY KEY (`Moment`),
  UNIQUE KEY `Index_2` (`Moment`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `measurement94`
--

DROP TABLE IF EXISTS `measurement94`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `measurement94` (
  `Moment` datetime NOT NULL,
  `Tagvalue` decimal(10,5) NOT NULL,
  PRIMARY KEY (`Moment`),
  UNIQUE KEY `Index_2` (`Moment`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `measurement95`
--

DROP TABLE IF EXISTS `measurement95`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `measurement95` (
  `Moment` datetime NOT NULL,
  `Tagvalue` decimal(10,5) NOT NULL,
  PRIMARY KEY (`Moment`),
  UNIQUE KEY `Index_2` (`Moment`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `measurement96`
--

DROP TABLE IF EXISTS `measurement96`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `measurement96` (
  `Moment` datetime NOT NULL,
  `Tagvalue` decimal(10,5) NOT NULL,
  PRIMARY KEY (`Moment`),
  UNIQUE KEY `Index_2` (`Moment`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `measurement97`
--

DROP TABLE IF EXISTS `measurement97`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `measurement97` (
  `Moment` datetime NOT NULL,
  `Tagvalue` decimal(10,5) NOT NULL,
  PRIMARY KEY (`Moment`),
  UNIQUE KEY `Index_2` (`Moment`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `measurement98`
--

DROP TABLE IF EXISTS `measurement98`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `measurement98` (
  `Moment` datetime NOT NULL,
  `Tagvalue` decimal(10,5) NOT NULL,
  PRIMARY KEY (`Moment`),
  UNIQUE KEY `Index_2` (`Moment`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `measurement99`
--

DROP TABLE IF EXISTS `measurement99`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `measurement99` (
  `Moment` datetime NOT NULL,
  `Tagvalue` decimal(10,5) NOT NULL,
  PRIMARY KEY (`Moment`),
  UNIQUE KEY `Index_2` (`Moment`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `nbiotraw`
--

DROP TABLE IF EXISTS `nbiotraw`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `nbiotraw` (
  `Id` bigint(20) NOT NULL AUTO_INCREMENT,
  `Data` mediumtext NOT NULL,
  `Moment` datetime NOT NULL,
  `Processed` tinyint(4) NOT NULL DEFAULT '0',
  `Nodeid` bigint(20) NOT NULL DEFAULT '0',
  PRIMARY KEY (`Id`),
  KEY `nodeid` (`Nodeid`),
  KEY `processed` (`Processed`),
  KEY `moment` (`Moment`)
) ENGINE=MyISAM AUTO_INCREMENT=3690 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `node`
--

DROP TABLE IF EXISTS `node`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `node` (
  `Id` bigint(20) NOT NULL AUTO_INCREMENT,
  `Name` text,
  `Lastlocationlat` decimal(10,5) DEFAULT NULL,
  `Lastlocationlon` decimal(10,5) DEFAULT NULL,
  `Devid` text NOT NULL,
  `Hwserial` text NOT NULL,
  `Ch0` bigint(20) NOT NULL DEFAULT '0',
  `Ch1` bigint(20) NOT NULL DEFAULT '0',
  `Ch2` bigint(20) NOT NULL DEFAULT '0',
  `Ch3` bigint(20) NOT NULL DEFAULT '0',
  `Ch4` bigint(20) NOT NULL DEFAULT '0',
  `Ch5` bigint(20) NOT NULL DEFAULT '0',
  `Ch6` bigint(20) NOT NULL DEFAULT '0',
  `Ch7` bigint(20) NOT NULL DEFAULT '0',
  `Sf7` bigint(20) NOT NULL DEFAULT '0',
  `Sf8` bigint(20) NOT NULL DEFAULT '0',
  `Sf9` bigint(20) NOT NULL DEFAULT '0',
  `Sf10` bigint(20) NOT NULL DEFAULT '0',
  `Sf11` bigint(20) NOT NULL DEFAULT '0',
  `Sf12` bigint(20) NOT NULL DEFAULT '0',
  `Lastmessage` datetime NOT NULL,
  `Packets` bigint(20) NOT NULL DEFAULT '0',
  PRIMARY KEY (`Id`)
) ENGINE=MyISAM AUTO_INCREMENT=160 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `point`
--

DROP TABLE IF EXISTS `point`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `point` (
  `Id` bigint(20) NOT NULL AUTO_INCREMENT,
  `Name` text NOT NULL,
  `Unitid` bigint(20) NOT NULL,
  `Nodeid` bigint(20) NOT NULL,
  `Priority` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`Id`)
) ENGINE=MyISAM AUTO_INCREMENT=405 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `ttngateways`
--

DROP TABLE IF EXISTS `ttngateways`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `ttngateways` (
  `Id` bigint(20) NOT NULL AUTO_INCREMENT,
  `Gwid` text,
  `Lastseen` datetime DEFAULT NULL,
  `Latitude` decimal(10,6) DEFAULT NULL,
  `Longitude` decimal(10,6) DEFAULT NULL,
  PRIMARY KEY (`Id`),
  UNIQUE KEY `Gwid_UNIQUE` (`Gwid`(20))
) ENGINE=MyISAM AUTO_INCREMENT=32128 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `unit`
--

DROP TABLE IF EXISTS `unit`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `unit` (
  `Id` bigint(20) NOT NULL AUTO_INCREMENT,
  `Unit` text,
  PRIMARY KEY (`Id`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2019-10-09 20:25:58
