-- MySQL dump 10.13  Distrib 5.7.17, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: war_of_warriors
-- ------------------------------------------------------
-- Server version	5.5.5-10.1.26-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `archer`
--

DROP TABLE IF EXISTS `archer`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `archer` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Name` varchar(45) NOT NULL,
  `Damage` int(11) NOT NULL,
  `Life` int(11) NOT NULL,
  `Level` int(11) NOT NULL,
  `NumberOfArrows` varchar(45) NOT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `archer`
--

LOCK TABLES `archer` WRITE;
/*!40000 ALTER TABLE `archer` DISABLE KEYS */;
/*!40000 ALTER TABLE `archer` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `axeman`
--

DROP TABLE IF EXISTS `axeman`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `axeman` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Name` varchar(45) NOT NULL,
  `Damage` int(11) NOT NULL,
  `Life` int(11) NOT NULL,
  `Level` int(11) NOT NULL,
  `AxeSize` varchar(45) NOT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `axeman`
--

LOCK TABLES `axeman` WRITE;
/*!40000 ALTER TABLE `axeman` DISABLE KEYS */;
/*!40000 ALTER TABLE `axeman` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `swordsman`
--

DROP TABLE IF EXISTS `swordsman`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `swordsman` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Name` varchar(45) NOT NULL,
  `Damage` int(11) NOT NULL,
  `Life` int(11) NOT NULL,
  `Level` int(11) NOT NULL,
  `SwordLength` varchar(45) NOT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `swordsman`
--

LOCK TABLES `swordsman` WRITE;
/*!40000 ALTER TABLE `swordsman` DISABLE KEYS */;
/*!40000 ALTER TABLE `swordsman` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `war`
--

DROP TABLE IF EXISTS `war`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `war` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Name` varchar(45) NOT NULL,
  `Date` varchar(45) NOT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `war`
--

LOCK TABLES `war` WRITE;
/*!40000 ALTER TABLE `war` DISABLE KEYS */;
/*!40000 ALTER TABLE `war` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `warrior`
--

DROP TABLE IF EXISTS `warrior`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `warrior` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `WarId` int(11) NOT NULL,
  `WarriorId` int(11) NOT NULL,
  `Type` varchar(45) NOT NULL,
  PRIMARY KEY (`Id`),
  KEY `fk_war_idx` (`WarId`),
  CONSTRAINT `fk_war` FOREIGN KEY (`WarId`) REFERENCES `war` (`Id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `warrior`
--

LOCK TABLES `warrior` WRITE;
/*!40000 ALTER TABLE `warrior` DISABLE KEYS */;
/*!40000 ALTER TABLE `warrior` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2017-09-26 10:39:35
