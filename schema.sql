-- MySQL dump 10.13  Distrib 5.7.30, for Linux (x86_64)
--
-- Host: localhost    Database: decision_maker
-- ------------------------------------------------------
-- Server version	5.7.30-0ubuntu0.18.04.1

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
-- Table structure for table `answers`
--

DROP TABLE IF EXISTS `answers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `answers` (
  `q_id` int(11) NOT NULL DEFAULT '0',
  `u_id` int(11) NOT NULL DEFAULT '0',
  `r_id` int(11) NOT NULL,
  `c_id1` int(11) NOT NULL DEFAULT '0',
  `c_id2` int(11) NOT NULL DEFAULT '0',
  `value` float DEFAULT NULL,
  PRIMARY KEY (`q_id`,`u_id`,`r_id`,`c_id1`,`c_id2`),
  KEY `user_id_fk` (`u_id`),
  KEY `criteria_id_fk` (`c_id1`),
  KEY `criteria_id_fk2` (`c_id2`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `avg_weight`
--

DROP TABLE IF EXISTS `avg_weight`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `avg_weight` (
  `q_id` int(11) NOT NULL DEFAULT '0',
  `r_id` int(11) NOT NULL DEFAULT '0',
  `weight` text,
  PRIMARY KEY (`q_id`,`r_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `avg_weight_technology`
--

DROP TABLE IF EXISTS `avg_weight_technology`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `avg_weight_technology` (
  `q_id` int(11) NOT NULL DEFAULT '0',
  `r_id` int(11) NOT NULL DEFAULT '0',
  `c_id` int(11) NOT NULL DEFAULT '0',
  `weight` text,
  PRIMARY KEY (`q_id`,`r_id`,`c_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `criteria`
--

DROP TABLE IF EXISTS `criteria`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `criteria` (
  `criterion_id` int(11) NOT NULL AUTO_INCREMENT,
  `r_id` int(11) DEFAULT NULL,
  `c_name` text,
  `c_description` text,
  `sub_criteria` int(11) NOT NULL,
  PRIMARY KEY (`criterion_id`),
  KEY `fk_r_id2` (`r_id`)
) ENGINE=MyISAM AUTO_INCREMENT=315 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `eigenvalues`
--

DROP TABLE IF EXISTS `eigenvalues`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `eigenvalues` (
  `q_id` int(11) NOT NULL DEFAULT '0',
  `r_id` int(11) NOT NULL DEFAULT '0',
  `u_id` int(11) NOT NULL DEFAULT '0',
  `lmax` float DEFAULT NULL,
  `vectors` text,
  `ci` float DEFAULT NULL,
  `ri` float DEFAULT NULL,
  `cr` float DEFAULT NULL,
  PRIMARY KEY (`q_id`,`r_id`,`u_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `eigenvalues_technology`
--

DROP TABLE IF EXISTS `eigenvalues_technology`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `eigenvalues_technology` (
  `q_id` int(11) NOT NULL DEFAULT '0',
  `r_id` int(11) NOT NULL DEFAULT '0',
  `u_id` int(11) NOT NULL DEFAULT '0',
  `f_id` int(11) NOT NULL DEFAULT '0',
  `lmax` float DEFAULT NULL,
  `vectors` text,
  `ci` float DEFAULT NULL,
  `ri` float DEFAULT NULL,
  `cr` float DEFAULT NULL,
  PRIMARY KEY (`q_id`,`r_id`,`u_id`,`f_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `lime_groups`
--

DROP TABLE IF EXISTS `lime_groups`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `lime_groups` (
  `gid` int(11) NOT NULL AUTO_INCREMENT,
  `sid` int(11) NOT NULL DEFAULT '0',
  `group_name` varchar(100) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `group_order` int(11) NOT NULL DEFAULT '0',
  `description` text COLLATE utf8_unicode_ci,
  `language` varchar(20) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'en',
  `randomization_group` varchar(20) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `grelevance` text COLLATE utf8_unicode_ci,
  PRIMARY KEY (`gid`,`language`),
  KEY `groups_idx2` (`sid`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `lime_questions`
--

DROP TABLE IF EXISTS `lime_questions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `lime_questions` (
  `qid` int(11) NOT NULL AUTO_INCREMENT,
  `parent_qid` int(11) NOT NULL DEFAULT '0',
  `sid` int(11) NOT NULL DEFAULT '0',
  `gid` int(11) NOT NULL DEFAULT '0',
  `type` char(1) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'T',
  `title` varchar(20) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `question` text COLLATE utf8_unicode_ci NOT NULL,
  `preg` text COLLATE utf8_unicode_ci,
  `help` text COLLATE utf8_unicode_ci,
  `other` char(1) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'N',
  `mandatory` char(1) COLLATE utf8_unicode_ci DEFAULT NULL,
  `question_order` int(11) NOT NULL,
  `language` varchar(20) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'en',
  `scale_id` tinyint(4) NOT NULL DEFAULT '0',
  `same_default` tinyint(4) NOT NULL DEFAULT '0' COMMENT 'Saves if user set to use the same default value across languages in default options dialog',
  `relevance` text COLLATE utf8_unicode_ci,
  PRIMARY KEY (`qid`,`language`),
  KEY `questions_idx2` (`sid`),
  KEY `questions_idx3` (`gid`),
  KEY `questions_idx4` (`type`),
  KEY `parent_qid_idx` (`parent_qid`)
) ENGINE=MyISAM AUTO_INCREMENT=1959 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `lime_survey_49731`
--

DROP TABLE IF EXISTS `lime_survey_49731`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `lime_survey_49731` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `submitdate` datetime DEFAULT NULL,
  `lastpage` int(11) DEFAULT NULL,
  `startlanguage` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(36) COLLATE utf8_unicode_ci DEFAULT NULL,
  `49731X8X1398` varchar(5) COLLATE utf8_unicode_ci DEFAULT NULL,
  `49731X8X1399` varchar(5) COLLATE utf8_unicode_ci DEFAULT NULL,
  `49731X8X1400` text COLLATE utf8_unicode_ci,
  `49731X8X1401` double DEFAULT NULL,
  `49731X8X1402SQ001_SQ001` text COLLATE utf8_unicode_ci,
  `49731X8X1402SQ001_SQ002` text COLLATE utf8_unicode_ci,
  `49731X8X1402SQ002_SQ001` text COLLATE utf8_unicode_ci,
  `49731X8X1402SQ002_SQ002` text COLLATE utf8_unicode_ci,
  `49731X8X1402SQ003_SQ001` text COLLATE utf8_unicode_ci,
  `49731X8X1402SQ003_SQ002` text COLLATE utf8_unicode_ci,
  `49731X8X1402SQ004_SQ001` text COLLATE utf8_unicode_ci,
  `49731X8X1402SQ004_SQ002` text COLLATE utf8_unicode_ci,
  `49731X8X1402SQ005_SQ001` text COLLATE utf8_unicode_ci,
  `49731X8X1402SQ005_SQ002` text COLLATE utf8_unicode_ci,
  `49731X8X1402SQ006_SQ001` text COLLATE utf8_unicode_ci,
  `49731X8X1402SQ006_SQ002` text COLLATE utf8_unicode_ci,
  `49731X8X1402SQ007_SQ001` text COLLATE utf8_unicode_ci,
  `49731X8X1402SQ007_SQ002` text COLLATE utf8_unicode_ci,
  `49731X8X1402SQ008_SQ001` text COLLATE utf8_unicode_ci,
  `49731X8X1402SQ008_SQ002` text COLLATE utf8_unicode_ci,
  `49731X8X1402SQ009_SQ001` text COLLATE utf8_unicode_ci,
  `49731X8X1402SQ009_SQ002` text COLLATE utf8_unicode_ci,
  `49731X8X1402SQ010_SQ001` text COLLATE utf8_unicode_ci,
  `49731X8X1402SQ010_SQ002` text COLLATE utf8_unicode_ci,
  `49731X8X1403SQ001_SQ001` text COLLATE utf8_unicode_ci,
  `49731X8X1403SQ002_SQ001` text COLLATE utf8_unicode_ci,
  `49731X8X1403SQ003_SQ001` text COLLATE utf8_unicode_ci,
  `49731X8X1403SQ004_SQ001` text COLLATE utf8_unicode_ci,
  `49731X8X1403SQ005_SQ001` text COLLATE utf8_unicode_ci,
  `49731X8X1403SQ006_SQ001` text COLLATE utf8_unicode_ci,
  `49731X8X1403SQ007_SQ001` text COLLATE utf8_unicode_ci,
  `49731X8X1403SQ008_SQ001` text COLLATE utf8_unicode_ci,
  `49731X8X1403SQ009_SQ001` text COLLATE utf8_unicode_ci,
  `49731X8X1403SQ010_SQ001` text COLLATE utf8_unicode_ci,
  `49731X8X1404` varchar(1) COLLATE utf8_unicode_ci DEFAULT NULL,
  `49731X8X1405SQ001_SQ001` text COLLATE utf8_unicode_ci,
  `49731X8X1405SQ001_SQ002` text COLLATE utf8_unicode_ci,
  `49731X8X1405SQ001_SQ003` text COLLATE utf8_unicode_ci,
  `49731X8X1405SQ001_SQ004` text COLLATE utf8_unicode_ci,
  `49731X8X1405SQ001_SQ005` text COLLATE utf8_unicode_ci,
  `49731X8X1405SQ002_SQ001` text COLLATE utf8_unicode_ci,
  `49731X8X1405SQ002_SQ002` text COLLATE utf8_unicode_ci,
  `49731X8X1405SQ002_SQ003` text COLLATE utf8_unicode_ci,
  `49731X8X1405SQ002_SQ004` text COLLATE utf8_unicode_ci,
  `49731X8X1405SQ002_SQ005` text COLLATE utf8_unicode_ci,
  `49731X8X1405SQ003_SQ001` text COLLATE utf8_unicode_ci,
  `49731X8X1405SQ003_SQ002` text COLLATE utf8_unicode_ci,
  `49731X8X1405SQ003_SQ003` text COLLATE utf8_unicode_ci,
  `49731X8X1405SQ003_SQ004` text COLLATE utf8_unicode_ci,
  `49731X8X1405SQ003_SQ005` text COLLATE utf8_unicode_ci,
  `49731X8X1405SQ004_SQ001` text COLLATE utf8_unicode_ci,
  `49731X8X1405SQ004_SQ002` text COLLATE utf8_unicode_ci,
  `49731X8X1405SQ004_SQ003` text COLLATE utf8_unicode_ci,
  `49731X8X1405SQ004_SQ004` text COLLATE utf8_unicode_ci,
  `49731X8X1405SQ004_SQ005` text COLLATE utf8_unicode_ci,
  `49731X8X1405SQ005_SQ001` text COLLATE utf8_unicode_ci,
  `49731X8X1405SQ005_SQ002` text COLLATE utf8_unicode_ci,
  `49731X8X1405SQ005_SQ003` text COLLATE utf8_unicode_ci,
  `49731X8X1405SQ005_SQ004` text COLLATE utf8_unicode_ci,
  `49731X8X1405SQ005_SQ005` text COLLATE utf8_unicode_ci,
  `49731X8X1406SQ001_SQ001` text COLLATE utf8_unicode_ci,
  `49731X8X1406SQ001_SQ002` text COLLATE utf8_unicode_ci,
  `49731X8X1406SQ001_SQ003` text COLLATE utf8_unicode_ci,
  `49731X8X1406SQ001_SQ004` text COLLATE utf8_unicode_ci,
  `49731X8X1406SQ002_SQ001` text COLLATE utf8_unicode_ci,
  `49731X8X1406SQ002_SQ002` text COLLATE utf8_unicode_ci,
  `49731X8X1406SQ002_SQ003` text COLLATE utf8_unicode_ci,
  `49731X8X1406SQ002_SQ004` text COLLATE utf8_unicode_ci,
  `49731X8X1406SQ003_SQ001` text COLLATE utf8_unicode_ci,
  `49731X8X1406SQ003_SQ002` text COLLATE utf8_unicode_ci,
  `49731X8X1406SQ003_SQ003` text COLLATE utf8_unicode_ci,
  `49731X8X1406SQ003_SQ004` text COLLATE utf8_unicode_ci,
  `49731X8X1406SQ004_SQ001` text COLLATE utf8_unicode_ci,
  `49731X8X1406SQ004_SQ002` text COLLATE utf8_unicode_ci,
  `49731X8X1406SQ004_SQ003` text COLLATE utf8_unicode_ci,
  `49731X8X1406SQ004_SQ004` text COLLATE utf8_unicode_ci,
  `49731X8X1406SQ005_SQ001` text COLLATE utf8_unicode_ci,
  `49731X8X1406SQ005_SQ002` text COLLATE utf8_unicode_ci,
  `49731X8X1406SQ005_SQ003` text COLLATE utf8_unicode_ci,
  `49731X8X1406SQ005_SQ004` text COLLATE utf8_unicode_ci,
  `49731X8X1406SQ006_SQ001` text COLLATE utf8_unicode_ci,
  `49731X8X1406SQ006_SQ002` text COLLATE utf8_unicode_ci,
  `49731X8X1406SQ006_SQ003` text COLLATE utf8_unicode_ci,
  `49731X8X1406SQ006_SQ004` text COLLATE utf8_unicode_ci,
  `49731X8X1406SQ007_SQ001` text COLLATE utf8_unicode_ci,
  `49731X8X1406SQ007_SQ002` text COLLATE utf8_unicode_ci,
  `49731X8X1406SQ007_SQ003` text COLLATE utf8_unicode_ci,
  `49731X8X1406SQ007_SQ004` text COLLATE utf8_unicode_ci,
  `49731X8X1406SQ008_SQ001` text COLLATE utf8_unicode_ci,
  `49731X8X1406SQ008_SQ002` text COLLATE utf8_unicode_ci,
  `49731X8X1406SQ008_SQ003` text COLLATE utf8_unicode_ci,
  `49731X8X1406SQ008_SQ004` text COLLATE utf8_unicode_ci,
  `49731X8X1406SQ009_SQ001` text COLLATE utf8_unicode_ci,
  `49731X8X1406SQ009_SQ002` text COLLATE utf8_unicode_ci,
  `49731X8X1406SQ009_SQ003` text COLLATE utf8_unicode_ci,
  `49731X8X1406SQ009_SQ004` text COLLATE utf8_unicode_ci,
  `49731X8X1406SQ010_SQ001` text COLLATE utf8_unicode_ci,
  `49731X8X1406SQ010_SQ002` text COLLATE utf8_unicode_ci,
  `49731X8X1406SQ010_SQ003` text COLLATE utf8_unicode_ci,
  `49731X8X1406SQ010_SQ004` text COLLATE utf8_unicode_ci,
  `49731X8X1406SQ011_SQ001` text COLLATE utf8_unicode_ci,
  `49731X8X1406SQ011_SQ002` text COLLATE utf8_unicode_ci,
  `49731X8X1406SQ011_SQ003` text COLLATE utf8_unicode_ci,
  `49731X8X1406SQ011_SQ004` text COLLATE utf8_unicode_ci,
  `49731X8X1406SQ012_SQ001` text COLLATE utf8_unicode_ci,
  `49731X8X1406SQ012_SQ002` text COLLATE utf8_unicode_ci,
  `49731X8X1406SQ012_SQ003` text COLLATE utf8_unicode_ci,
  `49731X8X1406SQ012_SQ004` text COLLATE utf8_unicode_ci,
  `49731X8X1406SQ013_SQ001` text COLLATE utf8_unicode_ci,
  `49731X8X1406SQ013_SQ002` text COLLATE utf8_unicode_ci,
  `49731X8X1406SQ013_SQ003` text COLLATE utf8_unicode_ci,
  `49731X8X1406SQ013_SQ004` text COLLATE utf8_unicode_ci,
  `49731X8X1406SQ014_SQ001` text COLLATE utf8_unicode_ci,
  `49731X8X1406SQ014_SQ002` text COLLATE utf8_unicode_ci,
  `49731X8X1406SQ014_SQ003` text COLLATE utf8_unicode_ci,
  `49731X8X1406SQ014_SQ004` text COLLATE utf8_unicode_ci,
  `49731X8X1406SQ015_SQ001` text COLLATE utf8_unicode_ci,
  `49731X8X1406SQ015_SQ002` text COLLATE utf8_unicode_ci,
  `49731X8X1406SQ015_SQ003` text COLLATE utf8_unicode_ci,
  `49731X8X1406SQ015_SQ004` text COLLATE utf8_unicode_ci,
  `49731X8X1406SQ016_SQ001` text COLLATE utf8_unicode_ci,
  `49731X8X1406SQ016_SQ002` text COLLATE utf8_unicode_ci,
  `49731X8X1406SQ016_SQ003` text COLLATE utf8_unicode_ci,
  `49731X8X1406SQ016_SQ004` text COLLATE utf8_unicode_ci,
  `49731X8X1406SQ017_SQ001` text COLLATE utf8_unicode_ci,
  `49731X8X1406SQ017_SQ002` text COLLATE utf8_unicode_ci,
  `49731X8X1406SQ017_SQ003` text COLLATE utf8_unicode_ci,
  `49731X8X1406SQ017_SQ004` text COLLATE utf8_unicode_ci,
  `49731X8X1406SQ018_SQ001` text COLLATE utf8_unicode_ci,
  `49731X8X1406SQ018_SQ002` text COLLATE utf8_unicode_ci,
  `49731X8X1406SQ018_SQ003` text COLLATE utf8_unicode_ci,
  `49731X8X1406SQ018_SQ004` text COLLATE utf8_unicode_ci,
  `49731X8X1406SQ019_SQ001` text COLLATE utf8_unicode_ci,
  `49731X8X1406SQ019_SQ002` text COLLATE utf8_unicode_ci,
  `49731X8X1406SQ019_SQ003` text COLLATE utf8_unicode_ci,
  `49731X8X1406SQ019_SQ004` text COLLATE utf8_unicode_ci,
  `49731X8X1406SQ020_SQ001` text COLLATE utf8_unicode_ci,
  `49731X8X1406SQ020_SQ002` text COLLATE utf8_unicode_ci,
  `49731X8X1406SQ020_SQ003` text COLLATE utf8_unicode_ci,
  `49731X8X1406SQ020_SQ004` text COLLATE utf8_unicode_ci,
  `49731X8X1406SQ021_SQ001` text COLLATE utf8_unicode_ci,
  `49731X8X1406SQ021_SQ002` text COLLATE utf8_unicode_ci,
  `49731X8X1406SQ021_SQ003` text COLLATE utf8_unicode_ci,
  `49731X8X1406SQ021_SQ004` text COLLATE utf8_unicode_ci,
  `49731X8X1406SQ022_SQ001` text COLLATE utf8_unicode_ci,
  `49731X8X1406SQ022_SQ002` text COLLATE utf8_unicode_ci,
  `49731X8X1406SQ022_SQ003` text COLLATE utf8_unicode_ci,
  `49731X8X1406SQ022_SQ004` text COLLATE utf8_unicode_ci,
  `49731X8X1406SQ023_SQ001` text COLLATE utf8_unicode_ci,
  `49731X8X1406SQ023_SQ002` text COLLATE utf8_unicode_ci,
  `49731X8X1406SQ023_SQ003` text COLLATE utf8_unicode_ci,
  `49731X8X1406SQ023_SQ004` text COLLATE utf8_unicode_ci,
  `49731X8X1406SQ024_SQ001` text COLLATE utf8_unicode_ci,
  `49731X8X1406SQ024_SQ002` text COLLATE utf8_unicode_ci,
  `49731X8X1406SQ024_SQ003` text COLLATE utf8_unicode_ci,
  `49731X8X1406SQ024_SQ004` text COLLATE utf8_unicode_ci,
  `49731X8X1406SQ025_SQ001` text COLLATE utf8_unicode_ci,
  `49731X8X1406SQ025_SQ002` text COLLATE utf8_unicode_ci,
  `49731X8X1406SQ025_SQ003` text COLLATE utf8_unicode_ci,
  `49731X8X1406SQ025_SQ004` text COLLATE utf8_unicode_ci,
  `49731X8X1406SQ026_SQ001` text COLLATE utf8_unicode_ci,
  `49731X8X1406SQ026_SQ002` text COLLATE utf8_unicode_ci,
  `49731X8X1406SQ026_SQ003` text COLLATE utf8_unicode_ci,
  `49731X8X1406SQ026_SQ004` text COLLATE utf8_unicode_ci,
  `49731X8X1406SQ027_SQ001` text COLLATE utf8_unicode_ci,
  `49731X8X1406SQ027_SQ002` text COLLATE utf8_unicode_ci,
  `49731X8X1406SQ027_SQ003` text COLLATE utf8_unicode_ci,
  `49731X8X1406SQ027_SQ004` text COLLATE utf8_unicode_ci,
  `49731X8X1406SQ028_SQ001` text COLLATE utf8_unicode_ci,
  `49731X8X1406SQ028_SQ002` text COLLATE utf8_unicode_ci,
  `49731X8X1406SQ028_SQ003` text COLLATE utf8_unicode_ci,
  `49731X8X1406SQ028_SQ004` text COLLATE utf8_unicode_ci,
  `49731X8X1406SQ029_SQ001` text COLLATE utf8_unicode_ci,
  `49731X8X1406SQ029_SQ002` text COLLATE utf8_unicode_ci,
  `49731X8X1406SQ029_SQ003` text COLLATE utf8_unicode_ci,
  `49731X8X1406SQ029_SQ004` text COLLATE utf8_unicode_ci,
  `49731X8X1406SQ030_SQ001` text COLLATE utf8_unicode_ci,
  `49731X8X1406SQ030_SQ002` text COLLATE utf8_unicode_ci,
  `49731X8X1406SQ030_SQ003` text COLLATE utf8_unicode_ci,
  `49731X8X1406SQ030_SQ004` text COLLATE utf8_unicode_ci,
  `49731X8X1406SQ031_SQ001` text COLLATE utf8_unicode_ci,
  `49731X8X1406SQ031_SQ002` text COLLATE utf8_unicode_ci,
  `49731X8X1406SQ031_SQ003` text COLLATE utf8_unicode_ci,
  `49731X8X1406SQ031_SQ004` text COLLATE utf8_unicode_ci,
  `49731X8X1406SQ032_SQ001` text COLLATE utf8_unicode_ci,
  `49731X8X1406SQ032_SQ002` text COLLATE utf8_unicode_ci,
  `49731X8X1406SQ032_SQ003` text COLLATE utf8_unicode_ci,
  `49731X8X1406SQ032_SQ004` text COLLATE utf8_unicode_ci,
  `49731X8X1406SQ033_SQ001` text COLLATE utf8_unicode_ci,
  `49731X8X1406SQ033_SQ002` text COLLATE utf8_unicode_ci,
  `49731X8X1406SQ033_SQ003` text COLLATE utf8_unicode_ci,
  `49731X8X1406SQ033_SQ004` text COLLATE utf8_unicode_ci,
  `49731X8X1406SQ034_SQ001` text COLLATE utf8_unicode_ci,
  `49731X8X1406SQ034_SQ002` text COLLATE utf8_unicode_ci,
  `49731X8X1406SQ034_SQ003` text COLLATE utf8_unicode_ci,
  `49731X8X1406SQ034_SQ004` text COLLATE utf8_unicode_ci,
  `49731X8X1406SQ035_SQ001` text COLLATE utf8_unicode_ci,
  `49731X8X1406SQ035_SQ002` text COLLATE utf8_unicode_ci,
  `49731X8X1406SQ035_SQ003` text COLLATE utf8_unicode_ci,
  `49731X8X1406SQ035_SQ004` text COLLATE utf8_unicode_ci,
  `49731X8X1406SQ036_SQ001` text COLLATE utf8_unicode_ci,
  `49731X8X1406SQ036_SQ002` text COLLATE utf8_unicode_ci,
  `49731X8X1406SQ036_SQ003` text COLLATE utf8_unicode_ci,
  `49731X8X1406SQ036_SQ004` text COLLATE utf8_unicode_ci,
  `49731X8X1406SQ037_SQ001` text COLLATE utf8_unicode_ci,
  `49731X8X1406SQ037_SQ002` text COLLATE utf8_unicode_ci,
  `49731X8X1406SQ037_SQ003` text COLLATE utf8_unicode_ci,
  `49731X8X1406SQ037_SQ004` text COLLATE utf8_unicode_ci,
  `49731X8X1406SQ038_SQ001` text COLLATE utf8_unicode_ci,
  `49731X8X1406SQ038_SQ002` text COLLATE utf8_unicode_ci,
  `49731X8X1406SQ038_SQ003` text COLLATE utf8_unicode_ci,
  `49731X8X1406SQ038_SQ004` text COLLATE utf8_unicode_ci,
  `49731X8X1406SQ039_SQ001` text COLLATE utf8_unicode_ci,
  `49731X8X1406SQ039_SQ002` text COLLATE utf8_unicode_ci,
  `49731X8X1406SQ039_SQ003` text COLLATE utf8_unicode_ci,
  `49731X8X1406SQ039_SQ004` text COLLATE utf8_unicode_ci,
  `49731X8X1406SQ040_SQ001` text COLLATE utf8_unicode_ci,
  `49731X8X1406SQ040_SQ002` text COLLATE utf8_unicode_ci,
  `49731X8X1406SQ040_SQ003` text COLLATE utf8_unicode_ci,
  `49731X8X1406SQ040_SQ004` text COLLATE utf8_unicode_ci,
  `49731X8X1406SQ041_SQ001` text COLLATE utf8_unicode_ci,
  `49731X8X1406SQ041_SQ002` text COLLATE utf8_unicode_ci,
  `49731X8X1406SQ041_SQ003` text COLLATE utf8_unicode_ci,
  `49731X8X1406SQ041_SQ004` text COLLATE utf8_unicode_ci,
  `49731X8X1406SQ042_SQ001` text COLLATE utf8_unicode_ci,
  `49731X8X1406SQ042_SQ002` text COLLATE utf8_unicode_ci,
  `49731X8X1406SQ042_SQ003` text COLLATE utf8_unicode_ci,
  `49731X8X1406SQ042_SQ004` text COLLATE utf8_unicode_ci,
  `49731X8X1406SQ043_SQ001` text COLLATE utf8_unicode_ci,
  `49731X8X1406SQ043_SQ002` text COLLATE utf8_unicode_ci,
  `49731X8X1406SQ043_SQ003` text COLLATE utf8_unicode_ci,
  `49731X8X1406SQ043_SQ004` text COLLATE utf8_unicode_ci,
  `49731X8X1406SQ044_SQ001` text COLLATE utf8_unicode_ci,
  `49731X8X1406SQ044_SQ002` text COLLATE utf8_unicode_ci,
  `49731X8X1406SQ044_SQ003` text COLLATE utf8_unicode_ci,
  `49731X8X1406SQ044_SQ004` text COLLATE utf8_unicode_ci,
  `49731X8X1406SQ045_SQ001` text COLLATE utf8_unicode_ci,
  `49731X8X1406SQ045_SQ002` text COLLATE utf8_unicode_ci,
  `49731X8X1406SQ045_SQ003` text COLLATE utf8_unicode_ci,
  `49731X8X1406SQ045_SQ004` text COLLATE utf8_unicode_ci,
  `49731X8X1406SQ046_SQ001` text COLLATE utf8_unicode_ci,
  `49731X8X1406SQ046_SQ002` text COLLATE utf8_unicode_ci,
  `49731X8X1406SQ046_SQ003` text COLLATE utf8_unicode_ci,
  `49731X8X1406SQ046_SQ004` text COLLATE utf8_unicode_ci,
  `49731X8X1406SQ047_SQ001` text COLLATE utf8_unicode_ci,
  `49731X8X1406SQ047_SQ002` text COLLATE utf8_unicode_ci,
  `49731X8X1406SQ047_SQ003` text COLLATE utf8_unicode_ci,
  `49731X8X1406SQ047_SQ004` text COLLATE utf8_unicode_ci,
  `49731X8X1406SQ048_SQ001` text COLLATE utf8_unicode_ci,
  `49731X8X1406SQ048_SQ002` text COLLATE utf8_unicode_ci,
  `49731X8X1406SQ048_SQ003` text COLLATE utf8_unicode_ci,
  `49731X8X1406SQ048_SQ004` text COLLATE utf8_unicode_ci,
  `49731X8X1406SQ049_SQ001` text COLLATE utf8_unicode_ci,
  `49731X8X1406SQ049_SQ002` text COLLATE utf8_unicode_ci,
  `49731X8X1406SQ049_SQ003` text COLLATE utf8_unicode_ci,
  `49731X8X1406SQ049_SQ004` text COLLATE utf8_unicode_ci,
  `49731X8X1406SQ050_SQ001` text COLLATE utf8_unicode_ci,
  `49731X8X1406SQ050_SQ002` text COLLATE utf8_unicode_ci,
  `49731X8X1406SQ050_SQ003` text COLLATE utf8_unicode_ci,
  `49731X8X1406SQ050_SQ004` text COLLATE utf8_unicode_ci,
  `49731X8X1406SQ051_SQ001` text COLLATE utf8_unicode_ci,
  `49731X8X1406SQ051_SQ002` text COLLATE utf8_unicode_ci,
  `49731X8X1406SQ051_SQ003` text COLLATE utf8_unicode_ci,
  `49731X8X1406SQ051_SQ004` text COLLATE utf8_unicode_ci,
  `49731X8X1406SQ052_SQ001` text COLLATE utf8_unicode_ci,
  `49731X8X1406SQ052_SQ002` text COLLATE utf8_unicode_ci,
  `49731X8X1406SQ052_SQ003` text COLLATE utf8_unicode_ci,
  `49731X8X1406SQ052_SQ004` text COLLATE utf8_unicode_ci,
  `49731X8X1406SQ053_SQ001` text COLLATE utf8_unicode_ci,
  `49731X8X1406SQ053_SQ002` text COLLATE utf8_unicode_ci,
  `49731X8X1406SQ053_SQ003` text COLLATE utf8_unicode_ci,
  `49731X8X1406SQ053_SQ004` text COLLATE utf8_unicode_ci,
  `49731X8X1406SQ054_SQ001` text COLLATE utf8_unicode_ci,
  `49731X8X1406SQ054_SQ002` text COLLATE utf8_unicode_ci,
  `49731X8X1406SQ054_SQ003` text COLLATE utf8_unicode_ci,
  `49731X8X1406SQ054_SQ004` text COLLATE utf8_unicode_ci,
  `49731X8X1406SQ055_SQ001` text COLLATE utf8_unicode_ci,
  `49731X8X1406SQ055_SQ002` text COLLATE utf8_unicode_ci,
  `49731X8X1406SQ055_SQ003` text COLLATE utf8_unicode_ci,
  `49731X8X1406SQ055_SQ004` text COLLATE utf8_unicode_ci,
  `49731X8X1406SQ056_SQ001` text COLLATE utf8_unicode_ci,
  `49731X8X1406SQ056_SQ002` text COLLATE utf8_unicode_ci,
  `49731X8X1406SQ056_SQ003` text COLLATE utf8_unicode_ci,
  `49731X8X1406SQ056_SQ004` text COLLATE utf8_unicode_ci,
  `49731X8X1406SQ057_SQ001` text COLLATE utf8_unicode_ci,
  `49731X8X1406SQ057_SQ002` text COLLATE utf8_unicode_ci,
  `49731X8X1406SQ057_SQ003` text COLLATE utf8_unicode_ci,
  `49731X8X1406SQ057_SQ004` text COLLATE utf8_unicode_ci,
  `49731X8X1406SQ058_SQ001` text COLLATE utf8_unicode_ci,
  `49731X8X1406SQ058_SQ002` text COLLATE utf8_unicode_ci,
  `49731X8X1406SQ058_SQ003` text COLLATE utf8_unicode_ci,
  `49731X8X1406SQ058_SQ004` text COLLATE utf8_unicode_ci,
  `49731X8X1406SQ059_SQ001` text COLLATE utf8_unicode_ci,
  `49731X8X1406SQ059_SQ002` text COLLATE utf8_unicode_ci,
  `49731X8X1406SQ059_SQ003` text COLLATE utf8_unicode_ci,
  `49731X8X1406SQ059_SQ004` text COLLATE utf8_unicode_ci,
  `49731X8X1406SQ060_SQ001` text COLLATE utf8_unicode_ci,
  `49731X8X1406SQ060_SQ002` text COLLATE utf8_unicode_ci,
  `49731X8X1406SQ060_SQ003` text COLLATE utf8_unicode_ci,
  `49731X8X1406SQ060_SQ004` text COLLATE utf8_unicode_ci,
  `49731X8X1406SQ061_SQ001` text COLLATE utf8_unicode_ci,
  `49731X8X1406SQ061_SQ002` text COLLATE utf8_unicode_ci,
  `49731X8X1406SQ061_SQ003` text COLLATE utf8_unicode_ci,
  `49731X8X1406SQ061_SQ004` text COLLATE utf8_unicode_ci,
  `49731X8X1406SQ062_SQ001` text COLLATE utf8_unicode_ci,
  `49731X8X1406SQ062_SQ002` text COLLATE utf8_unicode_ci,
  `49731X8X1406SQ062_SQ003` text COLLATE utf8_unicode_ci,
  `49731X8X1406SQ062_SQ004` text COLLATE utf8_unicode_ci,
  `49731X8X1406SQ063_SQ001` text COLLATE utf8_unicode_ci,
  `49731X8X1406SQ063_SQ002` text COLLATE utf8_unicode_ci,
  `49731X8X1406SQ063_SQ003` text COLLATE utf8_unicode_ci,
  `49731X8X1406SQ063_SQ004` text COLLATE utf8_unicode_ci,
  `49731X8X1406SQ064_SQ001` text COLLATE utf8_unicode_ci,
  `49731X8X1406SQ064_SQ002` text COLLATE utf8_unicode_ci,
  `49731X8X1406SQ064_SQ003` text COLLATE utf8_unicode_ci,
  `49731X8X1406SQ064_SQ004` text COLLATE utf8_unicode_ci,
  `49731X8X1406SQ065_SQ001` text COLLATE utf8_unicode_ci,
  `49731X8X1406SQ065_SQ002` text COLLATE utf8_unicode_ci,
  `49731X8X1406SQ065_SQ003` text COLLATE utf8_unicode_ci,
  `49731X8X1406SQ065_SQ004` text COLLATE utf8_unicode_ci,
  `49731X8X1406SQ066_SQ001` text COLLATE utf8_unicode_ci,
  `49731X8X1406SQ066_SQ002` text COLLATE utf8_unicode_ci,
  `49731X8X1406SQ066_SQ003` text COLLATE utf8_unicode_ci,
  `49731X8X1406SQ066_SQ004` text COLLATE utf8_unicode_ci,
  `49731X8X1406SQ067_SQ001` text COLLATE utf8_unicode_ci,
  `49731X8X1406SQ067_SQ002` text COLLATE utf8_unicode_ci,
  `49731X8X1406SQ067_SQ003` text COLLATE utf8_unicode_ci,
  `49731X8X1406SQ067_SQ004` text COLLATE utf8_unicode_ci,
  `49731X8X1406SQ068_SQ001` text COLLATE utf8_unicode_ci,
  `49731X8X1406SQ068_SQ002` text COLLATE utf8_unicode_ci,
  `49731X8X1406SQ068_SQ003` text COLLATE utf8_unicode_ci,
  `49731X8X1406SQ068_SQ004` text COLLATE utf8_unicode_ci,
  `49731X8X1406SQ069_SQ001` text COLLATE utf8_unicode_ci,
  `49731X8X1406SQ069_SQ002` text COLLATE utf8_unicode_ci,
  `49731X8X1406SQ069_SQ003` text COLLATE utf8_unicode_ci,
  `49731X8X1406SQ069_SQ004` text COLLATE utf8_unicode_ci,
  `49731X8X1406SQ070_SQ001` text COLLATE utf8_unicode_ci,
  `49731X8X1406SQ070_SQ002` text COLLATE utf8_unicode_ci,
  `49731X8X1406SQ070_SQ003` text COLLATE utf8_unicode_ci,
  `49731X8X1406SQ070_SQ004` text COLLATE utf8_unicode_ci,
  `49731X8X1407SQ001_SQ001` text COLLATE utf8_unicode_ci,
  `49731X8X1407SQ001_SQ002` text COLLATE utf8_unicode_ci,
  `49731X8X1407SQ001_SQ003` text COLLATE utf8_unicode_ci,
  `49731X8X1407SQ001_SQ004` text COLLATE utf8_unicode_ci,
  `49731X8X1407SQ001_SQ005` text COLLATE utf8_unicode_ci,
  `49731X8X1408SQ001_SQ001` text COLLATE utf8_unicode_ci,
  `49731X8X1408SQ001_SQ002` text COLLATE utf8_unicode_ci,
  `49731X8X1408SQ001_SQ003` text COLLATE utf8_unicode_ci,
  `49731X8X1408SQ001_SQ004` text COLLATE utf8_unicode_ci,
  `49731X8X1408SQ001_SQ005` text COLLATE utf8_unicode_ci,
  `49731X8X1408SQ002_SQ001` text COLLATE utf8_unicode_ci,
  `49731X8X1408SQ002_SQ002` text COLLATE utf8_unicode_ci,
  `49731X8X1408SQ002_SQ003` text COLLATE utf8_unicode_ci,
  `49731X8X1408SQ002_SQ004` text COLLATE utf8_unicode_ci,
  `49731X8X1408SQ002_SQ005` text COLLATE utf8_unicode_ci,
  `49731X8X1409SQ001_SQ001` text COLLATE utf8_unicode_ci,
  `49731X8X1409SQ001_SQ002` text COLLATE utf8_unicode_ci,
  `49731X8X1409SQ001_SQ003` text COLLATE utf8_unicode_ci,
  `49731X8X1409SQ002_SQ001` text COLLATE utf8_unicode_ci,
  `49731X8X1409SQ002_SQ002` text COLLATE utf8_unicode_ci,
  `49731X8X1409SQ002_SQ003` text COLLATE utf8_unicode_ci,
  `49731X8X1409SQ003_SQ001` text COLLATE utf8_unicode_ci,
  `49731X8X1409SQ003_SQ002` text COLLATE utf8_unicode_ci,
  `49731X8X1409SQ003_SQ003` text COLLATE utf8_unicode_ci,
  `49731X8X1409SQ004_SQ001` text COLLATE utf8_unicode_ci,
  `49731X8X1409SQ004_SQ002` text COLLATE utf8_unicode_ci,
  `49731X8X1409SQ004_SQ003` text COLLATE utf8_unicode_ci,
  `49731X8X1409SQ005_SQ001` text COLLATE utf8_unicode_ci,
  `49731X8X1409SQ005_SQ002` text COLLATE utf8_unicode_ci,
  `49731X8X1409SQ005_SQ003` text COLLATE utf8_unicode_ci,
  `49731X8X1409SQ006_SQ001` text COLLATE utf8_unicode_ci,
  `49731X8X1409SQ006_SQ002` text COLLATE utf8_unicode_ci,
  `49731X8X1409SQ006_SQ003` text COLLATE utf8_unicode_ci,
  `49731X8X1409SQ007_SQ001` text COLLATE utf8_unicode_ci,
  `49731X8X1409SQ007_SQ002` text COLLATE utf8_unicode_ci,
  `49731X8X1409SQ007_SQ003` text COLLATE utf8_unicode_ci,
  `49731X8X1409SQ008_SQ001` text COLLATE utf8_unicode_ci,
  `49731X8X1409SQ008_SQ002` text COLLATE utf8_unicode_ci,
  `49731X8X1409SQ008_SQ003` text COLLATE utf8_unicode_ci,
  `49731X8X1409SQ009_SQ001` text COLLATE utf8_unicode_ci,
  `49731X8X1409SQ009_SQ002` text COLLATE utf8_unicode_ci,
  `49731X8X1409SQ009_SQ003` text COLLATE utf8_unicode_ci,
  `49731X8X1409SQ010_SQ001` text COLLATE utf8_unicode_ci,
  `49731X8X1409SQ010_SQ002` text COLLATE utf8_unicode_ci,
  `49731X8X1409SQ010_SQ003` text COLLATE utf8_unicode_ci,
  `49731X8X1409SQ011_SQ001` text COLLATE utf8_unicode_ci,
  `49731X8X1409SQ011_SQ002` text COLLATE utf8_unicode_ci,
  `49731X8X1409SQ011_SQ003` text COLLATE utf8_unicode_ci,
  `49731X8X1409SQ012_SQ001` text COLLATE utf8_unicode_ci,
  `49731X8X1409SQ012_SQ002` text COLLATE utf8_unicode_ci,
  `49731X8X1409SQ012_SQ003` text COLLATE utf8_unicode_ci,
  `49731X8X1409SQ013_SQ001` text COLLATE utf8_unicode_ci,
  `49731X8X1409SQ013_SQ002` text COLLATE utf8_unicode_ci,
  `49731X8X1409SQ013_SQ003` text COLLATE utf8_unicode_ci,
  `49731X8X1409SQ014_SQ001` text COLLATE utf8_unicode_ci,
  `49731X8X1409SQ014_SQ002` text COLLATE utf8_unicode_ci,
  `49731X8X1409SQ014_SQ003` text COLLATE utf8_unicode_ci,
  `49731X8X1409SQ015_SQ001` text COLLATE utf8_unicode_ci,
  `49731X8X1409SQ015_SQ002` text COLLATE utf8_unicode_ci,
  `49731X8X1409SQ015_SQ003` text COLLATE utf8_unicode_ci,
  `49731X8X1409SQ016_SQ001` text COLLATE utf8_unicode_ci,
  `49731X8X1409SQ016_SQ002` text COLLATE utf8_unicode_ci,
  `49731X8X1409SQ016_SQ003` text COLLATE utf8_unicode_ci,
  `49731X8X1409SQ017_SQ001` text COLLATE utf8_unicode_ci,
  `49731X8X1409SQ017_SQ002` text COLLATE utf8_unicode_ci,
  `49731X8X1409SQ017_SQ003` text COLLATE utf8_unicode_ci,
  `49731X8X1409SQ018_SQ001` text COLLATE utf8_unicode_ci,
  `49731X8X1409SQ018_SQ002` text COLLATE utf8_unicode_ci,
  `49731X8X1409SQ018_SQ003` text COLLATE utf8_unicode_ci,
  `49731X8X1409SQ019_SQ001` text COLLATE utf8_unicode_ci,
  `49731X8X1409SQ019_SQ002` text COLLATE utf8_unicode_ci,
  `49731X8X1409SQ019_SQ003` text COLLATE utf8_unicode_ci,
  `49731X8X1409SQ020_SQ001` text COLLATE utf8_unicode_ci,
  `49731X8X1409SQ020_SQ002` text COLLATE utf8_unicode_ci,
  `49731X8X1409SQ020_SQ003` text COLLATE utf8_unicode_ci,
  `49731X8X1409SQ021_SQ001` text COLLATE utf8_unicode_ci,
  `49731X8X1409SQ021_SQ002` text COLLATE utf8_unicode_ci,
  `49731X8X1409SQ021_SQ003` text COLLATE utf8_unicode_ci,
  `49731X8X1409SQ022_SQ001` text COLLATE utf8_unicode_ci,
  `49731X8X1409SQ022_SQ002` text COLLATE utf8_unicode_ci,
  `49731X8X1409SQ022_SQ003` text COLLATE utf8_unicode_ci,
  `49731X8X1409SQ023_SQ001` text COLLATE utf8_unicode_ci,
  `49731X8X1409SQ023_SQ002` text COLLATE utf8_unicode_ci,
  `49731X8X1409SQ023_SQ003` text COLLATE utf8_unicode_ci,
  `49731X8X1409SQ024_SQ001` text COLLATE utf8_unicode_ci,
  `49731X8X1409SQ024_SQ002` text COLLATE utf8_unicode_ci,
  `49731X8X1409SQ024_SQ003` text COLLATE utf8_unicode_ci,
  `49731X8X1409SQ025_SQ001` text COLLATE utf8_unicode_ci,
  `49731X8X1409SQ025_SQ002` text COLLATE utf8_unicode_ci,
  `49731X8X1409SQ025_SQ003` text COLLATE utf8_unicode_ci,
  `49731X8X1410SQ001_SQ001` text COLLATE utf8_unicode_ci,
  `49731X8X1410SQ001_SQ002` text COLLATE utf8_unicode_ci,
  `49731X8X1410SQ001_SQ003` text COLLATE utf8_unicode_ci,
  `49731X8X1410SQ001_SQ004` text COLLATE utf8_unicode_ci,
  `49731X8X1410SQ001_SQ005` text COLLATE utf8_unicode_ci,
  `49731X8X1410SQ002_SQ001` text COLLATE utf8_unicode_ci,
  `49731X8X1410SQ002_SQ002` text COLLATE utf8_unicode_ci,
  `49731X8X1410SQ002_SQ003` text COLLATE utf8_unicode_ci,
  `49731X8X1410SQ002_SQ004` text COLLATE utf8_unicode_ci,
  `49731X8X1410SQ002_SQ005` text COLLATE utf8_unicode_ci,
  `49731X8X1410SQ003_SQ001` text COLLATE utf8_unicode_ci,
  `49731X8X1410SQ003_SQ002` text COLLATE utf8_unicode_ci,
  `49731X8X1410SQ003_SQ003` text COLLATE utf8_unicode_ci,
  `49731X8X1410SQ003_SQ004` text COLLATE utf8_unicode_ci,
  `49731X8X1410SQ003_SQ005` text COLLATE utf8_unicode_ci,
  `49731X8X1411SQ001_SQ001` text COLLATE utf8_unicode_ci,
  `49731X8X1411SQ001_SQ002` text COLLATE utf8_unicode_ci,
  `49731X8X1411SQ001_SQ003` text COLLATE utf8_unicode_ci,
  `49731X8X1411SQ001_SQ004` text COLLATE utf8_unicode_ci,
  `49731X8X1411SQ002_SQ001` text COLLATE utf8_unicode_ci,
  `49731X8X1411SQ002_SQ002` text COLLATE utf8_unicode_ci,
  `49731X8X1411SQ002_SQ003` text COLLATE utf8_unicode_ci,
  `49731X8X1411SQ002_SQ004` text COLLATE utf8_unicode_ci,
  `49731X8X1411SQ003_SQ001` text COLLATE utf8_unicode_ci,
  `49731X8X1411SQ003_SQ002` text COLLATE utf8_unicode_ci,
  `49731X8X1411SQ003_SQ003` text COLLATE utf8_unicode_ci,
  `49731X8X1411SQ003_SQ004` text COLLATE utf8_unicode_ci,
  `49731X8X1411SQ004_SQ001` text COLLATE utf8_unicode_ci,
  `49731X8X1411SQ004_SQ002` text COLLATE utf8_unicode_ci,
  `49731X8X1411SQ004_SQ003` text COLLATE utf8_unicode_ci,
  `49731X8X1411SQ004_SQ004` text COLLATE utf8_unicode_ci,
  `49731X8X1411SQ005_SQ001` text COLLATE utf8_unicode_ci,
  `49731X8X1411SQ005_SQ002` text COLLATE utf8_unicode_ci,
  `49731X8X1411SQ005_SQ003` text COLLATE utf8_unicode_ci,
  `49731X8X1411SQ005_SQ004` text COLLATE utf8_unicode_ci,
  `49731X8X1411SQ006_SQ001` text COLLATE utf8_unicode_ci,
  `49731X8X1411SQ006_SQ002` text COLLATE utf8_unicode_ci,
  `49731X8X1411SQ006_SQ003` text COLLATE utf8_unicode_ci,
  `49731X8X1411SQ006_SQ004` text COLLATE utf8_unicode_ci,
  `49731X8X1411SQ007_SQ001` text COLLATE utf8_unicode_ci,
  `49731X8X1411SQ007_SQ002` text COLLATE utf8_unicode_ci,
  `49731X8X1411SQ007_SQ003` text COLLATE utf8_unicode_ci,
  `49731X8X1411SQ007_SQ004` text COLLATE utf8_unicode_ci,
  `49731X8X1411SQ008_SQ001` text COLLATE utf8_unicode_ci,
  `49731X8X1411SQ008_SQ002` text COLLATE utf8_unicode_ci,
  `49731X8X1411SQ008_SQ003` text COLLATE utf8_unicode_ci,
  `49731X8X1411SQ008_SQ004` text COLLATE utf8_unicode_ci,
  `49731X8X1411SQ009_SQ001` text COLLATE utf8_unicode_ci,
  `49731X8X1411SQ009_SQ002` text COLLATE utf8_unicode_ci,
  `49731X8X1411SQ009_SQ003` text COLLATE utf8_unicode_ci,
  `49731X8X1411SQ009_SQ004` text COLLATE utf8_unicode_ci,
  `49731X8X1411SQ010_SQ001` text COLLATE utf8_unicode_ci,
  `49731X8X1411SQ010_SQ002` text COLLATE utf8_unicode_ci,
  `49731X8X1411SQ010_SQ003` text COLLATE utf8_unicode_ci,
  `49731X8X1411SQ010_SQ004` text COLLATE utf8_unicode_ci,
  `49731X8X1411SQ011_SQ001` text COLLATE utf8_unicode_ci,
  `49731X8X1411SQ011_SQ002` text COLLATE utf8_unicode_ci,
  `49731X8X1411SQ011_SQ003` text COLLATE utf8_unicode_ci,
  `49731X8X1411SQ011_SQ004` text COLLATE utf8_unicode_ci,
  `49731X8X1411SQ012_SQ001` text COLLATE utf8_unicode_ci,
  `49731X8X1411SQ012_SQ002` text COLLATE utf8_unicode_ci,
  `49731X8X1411SQ012_SQ003` text COLLATE utf8_unicode_ci,
  `49731X8X1411SQ012_SQ004` text COLLATE utf8_unicode_ci,
  `49731X8X1411SQ013_SQ001` text COLLATE utf8_unicode_ci,
  `49731X8X1411SQ013_SQ002` text COLLATE utf8_unicode_ci,
  `49731X8X1411SQ013_SQ003` text COLLATE utf8_unicode_ci,
  `49731X8X1411SQ013_SQ004` text COLLATE utf8_unicode_ci,
  `49731X8X1411SQ014_SQ001` text COLLATE utf8_unicode_ci,
  `49731X8X1411SQ014_SQ002` text COLLATE utf8_unicode_ci,
  `49731X8X1411SQ014_SQ003` text COLLATE utf8_unicode_ci,
  `49731X8X1411SQ014_SQ004` text COLLATE utf8_unicode_ci,
  `49731X8X1411SQ015_SQ001` text COLLATE utf8_unicode_ci,
  `49731X8X1411SQ015_SQ002` text COLLATE utf8_unicode_ci,
  `49731X8X1411SQ015_SQ003` text COLLATE utf8_unicode_ci,
  `49731X8X1411SQ015_SQ004` text COLLATE utf8_unicode_ci,
  `49731X8X1412SQ001_SQ001` text COLLATE utf8_unicode_ci,
  `49731X8X1412SQ001_SQ002` text COLLATE utf8_unicode_ci,
  `49731X8X1412SQ001_SQ003` text COLLATE utf8_unicode_ci,
  `49731X8X1412SQ001_SQ004` text COLLATE utf8_unicode_ci,
  `49731X8X1412SQ001_SQ005` text COLLATE utf8_unicode_ci,
  `49731X8X1412SQ002_SQ001` text COLLATE utf8_unicode_ci,
  `49731X8X1412SQ002_SQ002` text COLLATE utf8_unicode_ci,
  `49731X8X1412SQ002_SQ003` text COLLATE utf8_unicode_ci,
  `49731X8X1412SQ002_SQ004` text COLLATE utf8_unicode_ci,
  `49731X8X1412SQ002_SQ005` text COLLATE utf8_unicode_ci,
  `49731X8X1412SQ003_SQ001` text COLLATE utf8_unicode_ci,
  `49731X8X1412SQ003_SQ002` text COLLATE utf8_unicode_ci,
  `49731X8X1412SQ003_SQ003` text COLLATE utf8_unicode_ci,
  `49731X8X1412SQ003_SQ004` text COLLATE utf8_unicode_ci,
  `49731X8X1412SQ003_SQ005` text COLLATE utf8_unicode_ci,
  `49731X8X1413SQ001_SQ001` text COLLATE utf8_unicode_ci,
  `49731X8X1413SQ001_SQ002` text COLLATE utf8_unicode_ci,
  `49731X8X1413SQ001_SQ003` text COLLATE utf8_unicode_ci,
  `49731X8X1413SQ002_SQ001` text COLLATE utf8_unicode_ci,
  `49731X8X1413SQ002_SQ002` text COLLATE utf8_unicode_ci,
  `49731X8X1413SQ002_SQ003` text COLLATE utf8_unicode_ci,
  `49731X8X1413SQ003_SQ001` text COLLATE utf8_unicode_ci,
  `49731X8X1413SQ003_SQ002` text COLLATE utf8_unicode_ci,
  `49731X8X1413SQ003_SQ003` text COLLATE utf8_unicode_ci,
  `49731X8X1413SQ004_SQ001` text COLLATE utf8_unicode_ci,
  `49731X8X1413SQ004_SQ002` text COLLATE utf8_unicode_ci,
  `49731X8X1413SQ004_SQ003` text COLLATE utf8_unicode_ci,
  `49731X8X1413SQ005_SQ001` text COLLATE utf8_unicode_ci,
  `49731X8X1413SQ005_SQ002` text COLLATE utf8_unicode_ci,
  `49731X8X1413SQ005_SQ003` text COLLATE utf8_unicode_ci,
  `49731X8X1413SQ006_SQ001` text COLLATE utf8_unicode_ci,
  `49731X8X1413SQ006_SQ002` text COLLATE utf8_unicode_ci,
  `49731X8X1413SQ006_SQ003` text COLLATE utf8_unicode_ci,
  `49731X8X1413SQ007_SQ001` text COLLATE utf8_unicode_ci,
  `49731X8X1413SQ007_SQ002` text COLLATE utf8_unicode_ci,
  `49731X8X1413SQ007_SQ003` text COLLATE utf8_unicode_ci,
  `49731X8X1413SQ008_SQ001` text COLLATE utf8_unicode_ci,
  `49731X8X1413SQ008_SQ002` text COLLATE utf8_unicode_ci,
  `49731X8X1413SQ008_SQ003` text COLLATE utf8_unicode_ci,
  `49731X8X1413SQ009_SQ001` text COLLATE utf8_unicode_ci,
  `49731X8X1413SQ009_SQ002` text COLLATE utf8_unicode_ci,
  `49731X8X1413SQ009_SQ003` text COLLATE utf8_unicode_ci,
  `49731X8X1413SQ010_SQ001` text COLLATE utf8_unicode_ci,
  `49731X8X1413SQ010_SQ002` text COLLATE utf8_unicode_ci,
  `49731X8X1413SQ010_SQ003` text COLLATE utf8_unicode_ci,
  `49731X8X1413SQ011_SQ001` text COLLATE utf8_unicode_ci,
  `49731X8X1413SQ011_SQ002` text COLLATE utf8_unicode_ci,
  `49731X8X1413SQ011_SQ003` text COLLATE utf8_unicode_ci,
  `49731X8X1413SQ012_SQ001` text COLLATE utf8_unicode_ci,
  `49731X8X1413SQ012_SQ002` text COLLATE utf8_unicode_ci,
  `49731X8X1413SQ012_SQ003` text COLLATE utf8_unicode_ci,
  `49731X8X1413SQ013_SQ001` text COLLATE utf8_unicode_ci,
  `49731X8X1413SQ013_SQ002` text COLLATE utf8_unicode_ci,
  `49731X8X1413SQ013_SQ003` text COLLATE utf8_unicode_ci,
  `49731X8X1413SQ014_SQ001` text COLLATE utf8_unicode_ci,
  `49731X8X1413SQ014_SQ002` text COLLATE utf8_unicode_ci,
  `49731X8X1413SQ014_SQ003` text COLLATE utf8_unicode_ci,
  `49731X8X1413SQ015_SQ001` text COLLATE utf8_unicode_ci,
  `49731X8X1413SQ015_SQ002` text COLLATE utf8_unicode_ci,
  `49731X8X1413SQ015_SQ003` text COLLATE utf8_unicode_ci,
  `49731X8X1415SQ001_SQ001` text COLLATE utf8_unicode_ci,
  `49731X8X1415SQ001_SQ002` text COLLATE utf8_unicode_ci,
  `49731X8X1415SQ001_SQ003` text COLLATE utf8_unicode_ci,
  `49731X8X1415SQ001_SQ004` text COLLATE utf8_unicode_ci,
  `49731X8X1415SQ001_SQ005` text COLLATE utf8_unicode_ci,
  `49731X8X1415SQ001_SQ006` text COLLATE utf8_unicode_ci,
  `49731X8X1415SQ002_SQ001` text COLLATE utf8_unicode_ci,
  `49731X8X1415SQ002_SQ002` text COLLATE utf8_unicode_ci,
  `49731X8X1415SQ002_SQ003` text COLLATE utf8_unicode_ci,
  `49731X8X1415SQ002_SQ004` text COLLATE utf8_unicode_ci,
  `49731X8X1415SQ002_SQ005` text COLLATE utf8_unicode_ci,
  `49731X8X1415SQ002_SQ006` text COLLATE utf8_unicode_ci,
  `49731X8X1415SQ003_SQ001` text COLLATE utf8_unicode_ci,
  `49731X8X1415SQ003_SQ002` text COLLATE utf8_unicode_ci,
  `49731X8X1415SQ003_SQ003` text COLLATE utf8_unicode_ci,
  `49731X8X1415SQ003_SQ004` text COLLATE utf8_unicode_ci,
  `49731X8X1415SQ003_SQ005` text COLLATE utf8_unicode_ci,
  `49731X8X1415SQ003_SQ006` text COLLATE utf8_unicode_ci,
  `49731X8X1415SQ004_SQ001` text COLLATE utf8_unicode_ci,
  `49731X8X1415SQ004_SQ002` text COLLATE utf8_unicode_ci,
  `49731X8X1415SQ004_SQ003` text COLLATE utf8_unicode_ci,
  `49731X8X1415SQ004_SQ004` text COLLATE utf8_unicode_ci,
  `49731X8X1415SQ004_SQ005` text COLLATE utf8_unicode_ci,
  `49731X8X1415SQ004_SQ006` text COLLATE utf8_unicode_ci,
  `49731X8X1415SQ005_SQ001` text COLLATE utf8_unicode_ci,
  `49731X8X1415SQ005_SQ002` text COLLATE utf8_unicode_ci,
  `49731X8X1415SQ005_SQ003` text COLLATE utf8_unicode_ci,
  `49731X8X1415SQ005_SQ004` text COLLATE utf8_unicode_ci,
  `49731X8X1415SQ005_SQ005` text COLLATE utf8_unicode_ci,
  `49731X8X1415SQ005_SQ006` text COLLATE utf8_unicode_ci,
  `49731X8X1415SQ006_SQ001` text COLLATE utf8_unicode_ci,
  `49731X8X1415SQ006_SQ002` text COLLATE utf8_unicode_ci,
  `49731X8X1415SQ006_SQ003` text COLLATE utf8_unicode_ci,
  `49731X8X1415SQ006_SQ004` text COLLATE utf8_unicode_ci,
  `49731X8X1415SQ006_SQ005` text COLLATE utf8_unicode_ci,
  `49731X8X1415SQ006_SQ006` text COLLATE utf8_unicode_ci,
  `49731X8X1415SQ007_SQ001` text COLLATE utf8_unicode_ci,
  `49731X8X1415SQ007_SQ002` text COLLATE utf8_unicode_ci,
  `49731X8X1415SQ007_SQ003` text COLLATE utf8_unicode_ci,
  `49731X8X1415SQ007_SQ004` text COLLATE utf8_unicode_ci,
  `49731X8X1415SQ007_SQ005` text COLLATE utf8_unicode_ci,
  `49731X8X1415SQ007_SQ006` text COLLATE utf8_unicode_ci,
  `49731X8X1415SQ008_SQ001` text COLLATE utf8_unicode_ci,
  `49731X8X1415SQ008_SQ002` text COLLATE utf8_unicode_ci,
  `49731X8X1415SQ008_SQ003` text COLLATE utf8_unicode_ci,
  `49731X8X1415SQ008_SQ004` text COLLATE utf8_unicode_ci,
  `49731X8X1415SQ008_SQ005` text COLLATE utf8_unicode_ci,
  `49731X8X1415SQ008_SQ006` text COLLATE utf8_unicode_ci,
  `49731X8X1415SQ009_SQ001` text COLLATE utf8_unicode_ci,
  `49731X8X1415SQ009_SQ002` text COLLATE utf8_unicode_ci,
  `49731X8X1415SQ009_SQ003` text COLLATE utf8_unicode_ci,
  `49731X8X1415SQ009_SQ004` text COLLATE utf8_unicode_ci,
  `49731X8X1415SQ009_SQ005` text COLLATE utf8_unicode_ci,
  `49731X8X1415SQ009_SQ006` text COLLATE utf8_unicode_ci,
  `49731X8X1415SQ010_SQ001` text COLLATE utf8_unicode_ci,
  `49731X8X1415SQ010_SQ002` text COLLATE utf8_unicode_ci,
  `49731X8X1415SQ010_SQ003` text COLLATE utf8_unicode_ci,
  `49731X8X1415SQ010_SQ004` text COLLATE utf8_unicode_ci,
  `49731X8X1415SQ010_SQ005` text COLLATE utf8_unicode_ci,
  `49731X8X1415SQ010_SQ006` text COLLATE utf8_unicode_ci,
  `49731X8X1415SQ011_SQ001` text COLLATE utf8_unicode_ci,
  `49731X8X1415SQ011_SQ002` text COLLATE utf8_unicode_ci,
  `49731X8X1415SQ011_SQ003` text COLLATE utf8_unicode_ci,
  `49731X8X1415SQ011_SQ004` text COLLATE utf8_unicode_ci,
  `49731X8X1415SQ011_SQ005` text COLLATE utf8_unicode_ci,
  `49731X8X1415SQ011_SQ006` text COLLATE utf8_unicode_ci,
  `49731X8X1415SQ012_SQ001` text COLLATE utf8_unicode_ci,
  `49731X8X1415SQ012_SQ002` text COLLATE utf8_unicode_ci,
  `49731X8X1415SQ012_SQ003` text COLLATE utf8_unicode_ci,
  `49731X8X1415SQ012_SQ004` text COLLATE utf8_unicode_ci,
  `49731X8X1415SQ012_SQ005` text COLLATE utf8_unicode_ci,
  `49731X8X1415SQ012_SQ006` text COLLATE utf8_unicode_ci,
  `49731X8X1415SQ013_SQ001` text COLLATE utf8_unicode_ci,
  `49731X8X1415SQ013_SQ002` text COLLATE utf8_unicode_ci,
  `49731X8X1415SQ013_SQ003` text COLLATE utf8_unicode_ci,
  `49731X8X1415SQ013_SQ004` text COLLATE utf8_unicode_ci,
  `49731X8X1415SQ013_SQ005` text COLLATE utf8_unicode_ci,
  `49731X8X1415SQ013_SQ006` text COLLATE utf8_unicode_ci,
  `49731X8X1415SQ014_SQ001` text COLLATE utf8_unicode_ci,
  `49731X8X1415SQ014_SQ002` text COLLATE utf8_unicode_ci,
  `49731X8X1415SQ014_SQ003` text COLLATE utf8_unicode_ci,
  `49731X8X1415SQ014_SQ004` text COLLATE utf8_unicode_ci,
  `49731X8X1415SQ014_SQ005` text COLLATE utf8_unicode_ci,
  `49731X8X1415SQ014_SQ006` text COLLATE utf8_unicode_ci,
  `49731X8X1415SQ015_SQ001` text COLLATE utf8_unicode_ci,
  `49731X8X1415SQ015_SQ002` text COLLATE utf8_unicode_ci,
  `49731X8X1415SQ015_SQ003` text COLLATE utf8_unicode_ci,
  `49731X8X1415SQ015_SQ004` text COLLATE utf8_unicode_ci,
  `49731X8X1415SQ015_SQ005` text COLLATE utf8_unicode_ci,
  `49731X8X1415SQ015_SQ006` text COLLATE utf8_unicode_ci,
  `49731X8X1415SQ016_SQ001` text COLLATE utf8_unicode_ci,
  `49731X8X1415SQ016_SQ002` text COLLATE utf8_unicode_ci,
  `49731X8X1415SQ016_SQ003` text COLLATE utf8_unicode_ci,
  `49731X8X1415SQ016_SQ004` text COLLATE utf8_unicode_ci,
  `49731X8X1415SQ016_SQ005` text COLLATE utf8_unicode_ci,
  `49731X8X1415SQ016_SQ006` text COLLATE utf8_unicode_ci,
  `49731X8X1415SQ017_SQ001` text COLLATE utf8_unicode_ci,
  `49731X8X1415SQ017_SQ002` text COLLATE utf8_unicode_ci,
  `49731X8X1415SQ017_SQ003` text COLLATE utf8_unicode_ci,
  `49731X8X1415SQ017_SQ004` text COLLATE utf8_unicode_ci,
  `49731X8X1415SQ017_SQ005` text COLLATE utf8_unicode_ci,
  `49731X8X1415SQ017_SQ006` text COLLATE utf8_unicode_ci,
  `49731X8X1415SQ018_SQ001` text COLLATE utf8_unicode_ci,
  `49731X8X1415SQ018_SQ002` text COLLATE utf8_unicode_ci,
  `49731X8X1415SQ018_SQ003` text COLLATE utf8_unicode_ci,
  `49731X8X1415SQ018_SQ004` text COLLATE utf8_unicode_ci,
  `49731X8X1415SQ018_SQ005` text COLLATE utf8_unicode_ci,
  `49731X8X1415SQ018_SQ006` text COLLATE utf8_unicode_ci,
  `49731X8X1415SQ019_SQ001` text COLLATE utf8_unicode_ci,
  `49731X8X1415SQ019_SQ002` text COLLATE utf8_unicode_ci,
  `49731X8X1415SQ019_SQ003` text COLLATE utf8_unicode_ci,
  `49731X8X1415SQ019_SQ004` text COLLATE utf8_unicode_ci,
  `49731X8X1415SQ019_SQ005` text COLLATE utf8_unicode_ci,
  `49731X8X1415SQ019_SQ006` text COLLATE utf8_unicode_ci,
  `49731X8X1415SQ020_SQ001` text COLLATE utf8_unicode_ci,
  `49731X8X1415SQ020_SQ002` text COLLATE utf8_unicode_ci,
  `49731X8X1415SQ020_SQ003` text COLLATE utf8_unicode_ci,
  `49731X8X1415SQ020_SQ004` text COLLATE utf8_unicode_ci,
  `49731X8X1415SQ020_SQ005` text COLLATE utf8_unicode_ci,
  `49731X8X1415SQ020_SQ006` text COLLATE utf8_unicode_ci,
  `49731X8X1416SQ001` varchar(5) COLLATE utf8_unicode_ci DEFAULT NULL,
  `49731X8X1416SQ002` varchar(5) COLLATE utf8_unicode_ci DEFAULT NULL,
  `49731X8X1416SQ003` varchar(5) COLLATE utf8_unicode_ci DEFAULT NULL,
  `49731X8X1417SQ001_SQ001` text COLLATE utf8_unicode_ci,
  `49731X8X1417SQ001_SQ002` text COLLATE utf8_unicode_ci,
  `49731X8X1417SQ001_SQ003` text COLLATE utf8_unicode_ci,
  `49731X8X1417SQ001_SQ004` text COLLATE utf8_unicode_ci,
  `49731X8X1417SQ002_SQ001` text COLLATE utf8_unicode_ci,
  `49731X8X1417SQ002_SQ002` text COLLATE utf8_unicode_ci,
  `49731X8X1417SQ002_SQ003` text COLLATE utf8_unicode_ci,
  `49731X8X1417SQ002_SQ004` text COLLATE utf8_unicode_ci,
  `49731X8X1417SQ003_SQ001` text COLLATE utf8_unicode_ci,
  `49731X8X1417SQ003_SQ002` text COLLATE utf8_unicode_ci,
  `49731X8X1417SQ003_SQ003` text COLLATE utf8_unicode_ci,
  `49731X8X1417SQ003_SQ004` text COLLATE utf8_unicode_ci,
  `49731X8X1417SQ004_SQ001` text COLLATE utf8_unicode_ci,
  `49731X8X1417SQ004_SQ002` text COLLATE utf8_unicode_ci,
  `49731X8X1417SQ004_SQ003` text COLLATE utf8_unicode_ci,
  `49731X8X1417SQ004_SQ004` text COLLATE utf8_unicode_ci,
  `49731X8X1417SQ005_SQ001` text COLLATE utf8_unicode_ci,
  `49731X8X1417SQ005_SQ002` text COLLATE utf8_unicode_ci,
  `49731X8X1417SQ005_SQ003` text COLLATE utf8_unicode_ci,
  `49731X8X1417SQ005_SQ004` text COLLATE utf8_unicode_ci,
  `49731X8X1417SQ006_SQ001` text COLLATE utf8_unicode_ci,
  `49731X8X1417SQ006_SQ002` text COLLATE utf8_unicode_ci,
  `49731X8X1417SQ006_SQ003` text COLLATE utf8_unicode_ci,
  `49731X8X1417SQ006_SQ004` text COLLATE utf8_unicode_ci,
  `49731X8X1417SQ007_SQ001` text COLLATE utf8_unicode_ci,
  `49731X8X1417SQ007_SQ002` text COLLATE utf8_unicode_ci,
  `49731X8X1417SQ007_SQ003` text COLLATE utf8_unicode_ci,
  `49731X8X1417SQ007_SQ004` text COLLATE utf8_unicode_ci,
  `49731X8X1417SQ008_SQ001` text COLLATE utf8_unicode_ci,
  `49731X8X1417SQ008_SQ002` text COLLATE utf8_unicode_ci,
  `49731X8X1417SQ008_SQ003` text COLLATE utf8_unicode_ci,
  `49731X8X1417SQ008_SQ004` text COLLATE utf8_unicode_ci,
  `49731X8X1417SQ009_SQ001` text COLLATE utf8_unicode_ci,
  `49731X8X1417SQ009_SQ002` text COLLATE utf8_unicode_ci,
  `49731X8X1417SQ009_SQ003` text COLLATE utf8_unicode_ci,
  `49731X8X1417SQ009_SQ004` text COLLATE utf8_unicode_ci,
  `49731X8X1417SQ010_SQ001` text COLLATE utf8_unicode_ci,
  `49731X8X1417SQ010_SQ002` text COLLATE utf8_unicode_ci,
  `49731X8X1417SQ010_SQ003` text COLLATE utf8_unicode_ci,
  `49731X8X1417SQ010_SQ004` text COLLATE utf8_unicode_ci,
  `49731X8X1414SQ001_SQ001` text COLLATE utf8_unicode_ci,
  `49731X8X1414SQ002_SQ001` text COLLATE utf8_unicode_ci,
  `49731X8X1414SQ003_SQ001` text COLLATE utf8_unicode_ci,
  `49731X8X1414SQ004_SQ001` text COLLATE utf8_unicode_ci,
  `49731X8X1414SQ005_SQ001` text COLLATE utf8_unicode_ci,
  `49731X8X1414SQ006_SQ001` text COLLATE utf8_unicode_ci,
  `49731X8X1414SQ007_SQ001` text COLLATE utf8_unicode_ci,
  `49731X8X1414SQ008_SQ001` text COLLATE utf8_unicode_ci,
  `49731X8X1414SQ009_SQ001` text COLLATE utf8_unicode_ci,
  `49731X8X1414SQ010_SQ001` text COLLATE utf8_unicode_ci,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=36 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `lime_survey_83198`
--

DROP TABLE IF EXISTS `lime_survey_83198`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `lime_survey_83198` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `submitdate` datetime DEFAULT NULL,
  `lastpage` int(11) DEFAULT NULL,
  `startlanguage` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(36) COLLATE utf8_unicode_ci DEFAULT NULL,
  `83198X11X1684` varchar(5) COLLATE utf8_unicode_ci DEFAULT NULL,
  `83198X11X1685` varchar(5) COLLATE utf8_unicode_ci DEFAULT NULL,
  `83198X11X1686` text COLLATE utf8_unicode_ci,
  `83198X11X1687` double DEFAULT NULL,
  `83198X11X1688SQ001_SQ001` text COLLATE utf8_unicode_ci,
  `83198X11X1688SQ001_SQ002` text COLLATE utf8_unicode_ci,
  `83198X11X1688SQ002_SQ001` text COLLATE utf8_unicode_ci,
  `83198X11X1688SQ002_SQ002` text COLLATE utf8_unicode_ci,
  `83198X11X1688SQ003_SQ001` text COLLATE utf8_unicode_ci,
  `83198X11X1688SQ003_SQ002` text COLLATE utf8_unicode_ci,
  `83198X11X1688SQ004_SQ001` text COLLATE utf8_unicode_ci,
  `83198X11X1688SQ004_SQ002` text COLLATE utf8_unicode_ci,
  `83198X11X1688SQ005_SQ001` text COLLATE utf8_unicode_ci,
  `83198X11X1688SQ005_SQ002` text COLLATE utf8_unicode_ci,
  `83198X11X1688SQ006_SQ001` text COLLATE utf8_unicode_ci,
  `83198X11X1688SQ006_SQ002` text COLLATE utf8_unicode_ci,
  `83198X11X1688SQ007_SQ001` text COLLATE utf8_unicode_ci,
  `83198X11X1688SQ007_SQ002` text COLLATE utf8_unicode_ci,
  `83198X11X1688SQ008_SQ001` text COLLATE utf8_unicode_ci,
  `83198X11X1688SQ008_SQ002` text COLLATE utf8_unicode_ci,
  `83198X11X1688SQ009_SQ001` text COLLATE utf8_unicode_ci,
  `83198X11X1688SQ009_SQ002` text COLLATE utf8_unicode_ci,
  `83198X11X1688SQ010_SQ001` text COLLATE utf8_unicode_ci,
  `83198X11X1688SQ010_SQ002` text COLLATE utf8_unicode_ci,
  `83198X11X1689SQ001_SQ001` text COLLATE utf8_unicode_ci,
  `83198X11X1689SQ002_SQ001` text COLLATE utf8_unicode_ci,
  `83198X11X1689SQ003_SQ001` text COLLATE utf8_unicode_ci,
  `83198X11X1689SQ004_SQ001` text COLLATE utf8_unicode_ci,
  `83198X11X1689SQ005_SQ001` text COLLATE utf8_unicode_ci,
  `83198X11X1689SQ006_SQ001` text COLLATE utf8_unicode_ci,
  `83198X11X1689SQ007_SQ001` text COLLATE utf8_unicode_ci,
  `83198X11X1689SQ008_SQ001` text COLLATE utf8_unicode_ci,
  `83198X11X1689SQ009_SQ001` text COLLATE utf8_unicode_ci,
  `83198X11X1689SQ010_SQ001` text COLLATE utf8_unicode_ci,
  `83198X11X1690` varchar(1) COLLATE utf8_unicode_ci DEFAULT NULL,
  `83198X11X1691SQ001_SQ001` text COLLATE utf8_unicode_ci,
  `83198X11X1691SQ001_SQ002` text COLLATE utf8_unicode_ci,
  `83198X11X1691SQ001_SQ003` text COLLATE utf8_unicode_ci,
  `83198X11X1691SQ001_SQ004` text COLLATE utf8_unicode_ci,
  `83198X11X1691SQ001_SQ005` text COLLATE utf8_unicode_ci,
  `83198X11X1691SQ002_SQ001` text COLLATE utf8_unicode_ci,
  `83198X11X1691SQ002_SQ002` text COLLATE utf8_unicode_ci,
  `83198X11X1691SQ002_SQ003` text COLLATE utf8_unicode_ci,
  `83198X11X1691SQ002_SQ004` text COLLATE utf8_unicode_ci,
  `83198X11X1691SQ002_SQ005` text COLLATE utf8_unicode_ci,
  `83198X11X1691SQ003_SQ001` text COLLATE utf8_unicode_ci,
  `83198X11X1691SQ003_SQ002` text COLLATE utf8_unicode_ci,
  `83198X11X1691SQ003_SQ003` text COLLATE utf8_unicode_ci,
  `83198X11X1691SQ003_SQ004` text COLLATE utf8_unicode_ci,
  `83198X11X1691SQ003_SQ005` text COLLATE utf8_unicode_ci,
  `83198X11X1691SQ004_SQ001` text COLLATE utf8_unicode_ci,
  `83198X11X1691SQ004_SQ002` text COLLATE utf8_unicode_ci,
  `83198X11X1691SQ004_SQ003` text COLLATE utf8_unicode_ci,
  `83198X11X1691SQ004_SQ004` text COLLATE utf8_unicode_ci,
  `83198X11X1691SQ004_SQ005` text COLLATE utf8_unicode_ci,
  `83198X11X1691SQ005_SQ001` text COLLATE utf8_unicode_ci,
  `83198X11X1691SQ005_SQ002` text COLLATE utf8_unicode_ci,
  `83198X11X1691SQ005_SQ003` text COLLATE utf8_unicode_ci,
  `83198X11X1691SQ005_SQ004` text COLLATE utf8_unicode_ci,
  `83198X11X1691SQ005_SQ005` text COLLATE utf8_unicode_ci,
  `83198X11X1692SQ001_SQ001` text COLLATE utf8_unicode_ci,
  `83198X11X1692SQ001_SQ002` text COLLATE utf8_unicode_ci,
  `83198X11X1692SQ001_SQ003` text COLLATE utf8_unicode_ci,
  `83198X11X1692SQ001_SQ004` text COLLATE utf8_unicode_ci,
  `83198X11X1692SQ002_SQ001` text COLLATE utf8_unicode_ci,
  `83198X11X1692SQ002_SQ002` text COLLATE utf8_unicode_ci,
  `83198X11X1692SQ002_SQ003` text COLLATE utf8_unicode_ci,
  `83198X11X1692SQ002_SQ004` text COLLATE utf8_unicode_ci,
  `83198X11X1692SQ003_SQ001` text COLLATE utf8_unicode_ci,
  `83198X11X1692SQ003_SQ002` text COLLATE utf8_unicode_ci,
  `83198X11X1692SQ003_SQ003` text COLLATE utf8_unicode_ci,
  `83198X11X1692SQ003_SQ004` text COLLATE utf8_unicode_ci,
  `83198X11X1692SQ004_SQ001` text COLLATE utf8_unicode_ci,
  `83198X11X1692SQ004_SQ002` text COLLATE utf8_unicode_ci,
  `83198X11X1692SQ004_SQ003` text COLLATE utf8_unicode_ci,
  `83198X11X1692SQ004_SQ004` text COLLATE utf8_unicode_ci,
  `83198X11X1692SQ005_SQ001` text COLLATE utf8_unicode_ci,
  `83198X11X1692SQ005_SQ002` text COLLATE utf8_unicode_ci,
  `83198X11X1692SQ005_SQ003` text COLLATE utf8_unicode_ci,
  `83198X11X1692SQ005_SQ004` text COLLATE utf8_unicode_ci,
  `83198X11X1692SQ006_SQ001` text COLLATE utf8_unicode_ci,
  `83198X11X1692SQ006_SQ002` text COLLATE utf8_unicode_ci,
  `83198X11X1692SQ006_SQ003` text COLLATE utf8_unicode_ci,
  `83198X11X1692SQ006_SQ004` text COLLATE utf8_unicode_ci,
  `83198X11X1692SQ007_SQ001` text COLLATE utf8_unicode_ci,
  `83198X11X1692SQ007_SQ002` text COLLATE utf8_unicode_ci,
  `83198X11X1692SQ007_SQ003` text COLLATE utf8_unicode_ci,
  `83198X11X1692SQ007_SQ004` text COLLATE utf8_unicode_ci,
  `83198X11X1692SQ008_SQ001` text COLLATE utf8_unicode_ci,
  `83198X11X1692SQ008_SQ002` text COLLATE utf8_unicode_ci,
  `83198X11X1692SQ008_SQ003` text COLLATE utf8_unicode_ci,
  `83198X11X1692SQ008_SQ004` text COLLATE utf8_unicode_ci,
  `83198X11X1692SQ009_SQ001` text COLLATE utf8_unicode_ci,
  `83198X11X1692SQ009_SQ002` text COLLATE utf8_unicode_ci,
  `83198X11X1692SQ009_SQ003` text COLLATE utf8_unicode_ci,
  `83198X11X1692SQ009_SQ004` text COLLATE utf8_unicode_ci,
  `83198X11X1692SQ010_SQ001` text COLLATE utf8_unicode_ci,
  `83198X11X1692SQ010_SQ002` text COLLATE utf8_unicode_ci,
  `83198X11X1692SQ010_SQ003` text COLLATE utf8_unicode_ci,
  `83198X11X1692SQ010_SQ004` text COLLATE utf8_unicode_ci,
  `83198X11X1692SQ011_SQ001` text COLLATE utf8_unicode_ci,
  `83198X11X1692SQ011_SQ002` text COLLATE utf8_unicode_ci,
  `83198X11X1692SQ011_SQ003` text COLLATE utf8_unicode_ci,
  `83198X11X1692SQ011_SQ004` text COLLATE utf8_unicode_ci,
  `83198X11X1692SQ012_SQ001` text COLLATE utf8_unicode_ci,
  `83198X11X1692SQ012_SQ002` text COLLATE utf8_unicode_ci,
  `83198X11X1692SQ012_SQ003` text COLLATE utf8_unicode_ci,
  `83198X11X1692SQ012_SQ004` text COLLATE utf8_unicode_ci,
  `83198X11X1692SQ013_SQ001` text COLLATE utf8_unicode_ci,
  `83198X11X1692SQ013_SQ002` text COLLATE utf8_unicode_ci,
  `83198X11X1692SQ013_SQ003` text COLLATE utf8_unicode_ci,
  `83198X11X1692SQ013_SQ004` text COLLATE utf8_unicode_ci,
  `83198X11X1692SQ014_SQ001` text COLLATE utf8_unicode_ci,
  `83198X11X1692SQ014_SQ002` text COLLATE utf8_unicode_ci,
  `83198X11X1692SQ014_SQ003` text COLLATE utf8_unicode_ci,
  `83198X11X1692SQ014_SQ004` text COLLATE utf8_unicode_ci,
  `83198X11X1692SQ015_SQ001` text COLLATE utf8_unicode_ci,
  `83198X11X1692SQ015_SQ002` text COLLATE utf8_unicode_ci,
  `83198X11X1692SQ015_SQ003` text COLLATE utf8_unicode_ci,
  `83198X11X1692SQ015_SQ004` text COLLATE utf8_unicode_ci,
  `83198X11X1692SQ016_SQ001` text COLLATE utf8_unicode_ci,
  `83198X11X1692SQ016_SQ002` text COLLATE utf8_unicode_ci,
  `83198X11X1692SQ016_SQ003` text COLLATE utf8_unicode_ci,
  `83198X11X1692SQ016_SQ004` text COLLATE utf8_unicode_ci,
  `83198X11X1692SQ017_SQ001` text COLLATE utf8_unicode_ci,
  `83198X11X1692SQ017_SQ002` text COLLATE utf8_unicode_ci,
  `83198X11X1692SQ017_SQ003` text COLLATE utf8_unicode_ci,
  `83198X11X1692SQ017_SQ004` text COLLATE utf8_unicode_ci,
  `83198X11X1692SQ018_SQ001` text COLLATE utf8_unicode_ci,
  `83198X11X1692SQ018_SQ002` text COLLATE utf8_unicode_ci,
  `83198X11X1692SQ018_SQ003` text COLLATE utf8_unicode_ci,
  `83198X11X1692SQ018_SQ004` text COLLATE utf8_unicode_ci,
  `83198X11X1692SQ019_SQ001` text COLLATE utf8_unicode_ci,
  `83198X11X1692SQ019_SQ002` text COLLATE utf8_unicode_ci,
  `83198X11X1692SQ019_SQ003` text COLLATE utf8_unicode_ci,
  `83198X11X1692SQ019_SQ004` text COLLATE utf8_unicode_ci,
  `83198X11X1692SQ020_SQ001` text COLLATE utf8_unicode_ci,
  `83198X11X1692SQ020_SQ002` text COLLATE utf8_unicode_ci,
  `83198X11X1692SQ020_SQ003` text COLLATE utf8_unicode_ci,
  `83198X11X1692SQ020_SQ004` text COLLATE utf8_unicode_ci,
  `83198X11X1692SQ021_SQ001` text COLLATE utf8_unicode_ci,
  `83198X11X1692SQ021_SQ002` text COLLATE utf8_unicode_ci,
  `83198X11X1692SQ021_SQ003` text COLLATE utf8_unicode_ci,
  `83198X11X1692SQ021_SQ004` text COLLATE utf8_unicode_ci,
  `83198X11X1692SQ022_SQ001` text COLLATE utf8_unicode_ci,
  `83198X11X1692SQ022_SQ002` text COLLATE utf8_unicode_ci,
  `83198X11X1692SQ022_SQ003` text COLLATE utf8_unicode_ci,
  `83198X11X1692SQ022_SQ004` text COLLATE utf8_unicode_ci,
  `83198X11X1692SQ023_SQ001` text COLLATE utf8_unicode_ci,
  `83198X11X1692SQ023_SQ002` text COLLATE utf8_unicode_ci,
  `83198X11X1692SQ023_SQ003` text COLLATE utf8_unicode_ci,
  `83198X11X1692SQ023_SQ004` text COLLATE utf8_unicode_ci,
  `83198X11X1692SQ024_SQ001` text COLLATE utf8_unicode_ci,
  `83198X11X1692SQ024_SQ002` text COLLATE utf8_unicode_ci,
  `83198X11X1692SQ024_SQ003` text COLLATE utf8_unicode_ci,
  `83198X11X1692SQ024_SQ004` text COLLATE utf8_unicode_ci,
  `83198X11X1692SQ025_SQ001` text COLLATE utf8_unicode_ci,
  `83198X11X1692SQ025_SQ002` text COLLATE utf8_unicode_ci,
  `83198X11X1692SQ025_SQ003` text COLLATE utf8_unicode_ci,
  `83198X11X1692SQ025_SQ004` text COLLATE utf8_unicode_ci,
  `83198X11X1692SQ026_SQ001` text COLLATE utf8_unicode_ci,
  `83198X11X1692SQ026_SQ002` text COLLATE utf8_unicode_ci,
  `83198X11X1692SQ026_SQ003` text COLLATE utf8_unicode_ci,
  `83198X11X1692SQ026_SQ004` text COLLATE utf8_unicode_ci,
  `83198X11X1692SQ027_SQ001` text COLLATE utf8_unicode_ci,
  `83198X11X1692SQ027_SQ002` text COLLATE utf8_unicode_ci,
  `83198X11X1692SQ027_SQ003` text COLLATE utf8_unicode_ci,
  `83198X11X1692SQ027_SQ004` text COLLATE utf8_unicode_ci,
  `83198X11X1692SQ028_SQ001` text COLLATE utf8_unicode_ci,
  `83198X11X1692SQ028_SQ002` text COLLATE utf8_unicode_ci,
  `83198X11X1692SQ028_SQ003` text COLLATE utf8_unicode_ci,
  `83198X11X1692SQ028_SQ004` text COLLATE utf8_unicode_ci,
  `83198X11X1692SQ029_SQ001` text COLLATE utf8_unicode_ci,
  `83198X11X1692SQ029_SQ002` text COLLATE utf8_unicode_ci,
  `83198X11X1692SQ029_SQ003` text COLLATE utf8_unicode_ci,
  `83198X11X1692SQ029_SQ004` text COLLATE utf8_unicode_ci,
  `83198X11X1692SQ030_SQ001` text COLLATE utf8_unicode_ci,
  `83198X11X1692SQ030_SQ002` text COLLATE utf8_unicode_ci,
  `83198X11X1692SQ030_SQ003` text COLLATE utf8_unicode_ci,
  `83198X11X1692SQ030_SQ004` text COLLATE utf8_unicode_ci,
  `83198X11X1692SQ031_SQ001` text COLLATE utf8_unicode_ci,
  `83198X11X1692SQ031_SQ002` text COLLATE utf8_unicode_ci,
  `83198X11X1692SQ031_SQ003` text COLLATE utf8_unicode_ci,
  `83198X11X1692SQ031_SQ004` text COLLATE utf8_unicode_ci,
  `83198X11X1692SQ032_SQ001` text COLLATE utf8_unicode_ci,
  `83198X11X1692SQ032_SQ002` text COLLATE utf8_unicode_ci,
  `83198X11X1692SQ032_SQ003` text COLLATE utf8_unicode_ci,
  `83198X11X1692SQ032_SQ004` text COLLATE utf8_unicode_ci,
  `83198X11X1692SQ033_SQ001` text COLLATE utf8_unicode_ci,
  `83198X11X1692SQ033_SQ002` text COLLATE utf8_unicode_ci,
  `83198X11X1692SQ033_SQ003` text COLLATE utf8_unicode_ci,
  `83198X11X1692SQ033_SQ004` text COLLATE utf8_unicode_ci,
  `83198X11X1692SQ034_SQ001` text COLLATE utf8_unicode_ci,
  `83198X11X1692SQ034_SQ002` text COLLATE utf8_unicode_ci,
  `83198X11X1692SQ034_SQ003` text COLLATE utf8_unicode_ci,
  `83198X11X1692SQ034_SQ004` text COLLATE utf8_unicode_ci,
  `83198X11X1692SQ035_SQ001` text COLLATE utf8_unicode_ci,
  `83198X11X1692SQ035_SQ002` text COLLATE utf8_unicode_ci,
  `83198X11X1692SQ035_SQ003` text COLLATE utf8_unicode_ci,
  `83198X11X1692SQ035_SQ004` text COLLATE utf8_unicode_ci,
  `83198X11X1692SQ036_SQ001` text COLLATE utf8_unicode_ci,
  `83198X11X1692SQ036_SQ002` text COLLATE utf8_unicode_ci,
  `83198X11X1692SQ036_SQ003` text COLLATE utf8_unicode_ci,
  `83198X11X1692SQ036_SQ004` text COLLATE utf8_unicode_ci,
  `83198X11X1692SQ037_SQ001` text COLLATE utf8_unicode_ci,
  `83198X11X1692SQ037_SQ002` text COLLATE utf8_unicode_ci,
  `83198X11X1692SQ037_SQ003` text COLLATE utf8_unicode_ci,
  `83198X11X1692SQ037_SQ004` text COLLATE utf8_unicode_ci,
  `83198X11X1692SQ038_SQ001` text COLLATE utf8_unicode_ci,
  `83198X11X1692SQ038_SQ002` text COLLATE utf8_unicode_ci,
  `83198X11X1692SQ038_SQ003` text COLLATE utf8_unicode_ci,
  `83198X11X1692SQ038_SQ004` text COLLATE utf8_unicode_ci,
  `83198X11X1692SQ039_SQ001` text COLLATE utf8_unicode_ci,
  `83198X11X1692SQ039_SQ002` text COLLATE utf8_unicode_ci,
  `83198X11X1692SQ039_SQ003` text COLLATE utf8_unicode_ci,
  `83198X11X1692SQ039_SQ004` text COLLATE utf8_unicode_ci,
  `83198X11X1692SQ040_SQ001` text COLLATE utf8_unicode_ci,
  `83198X11X1692SQ040_SQ002` text COLLATE utf8_unicode_ci,
  `83198X11X1692SQ040_SQ003` text COLLATE utf8_unicode_ci,
  `83198X11X1692SQ040_SQ004` text COLLATE utf8_unicode_ci,
  `83198X11X1692SQ041_SQ001` text COLLATE utf8_unicode_ci,
  `83198X11X1692SQ041_SQ002` text COLLATE utf8_unicode_ci,
  `83198X11X1692SQ041_SQ003` text COLLATE utf8_unicode_ci,
  `83198X11X1692SQ041_SQ004` text COLLATE utf8_unicode_ci,
  `83198X11X1692SQ042_SQ001` text COLLATE utf8_unicode_ci,
  `83198X11X1692SQ042_SQ002` text COLLATE utf8_unicode_ci,
  `83198X11X1692SQ042_SQ003` text COLLATE utf8_unicode_ci,
  `83198X11X1692SQ042_SQ004` text COLLATE utf8_unicode_ci,
  `83198X11X1692SQ043_SQ001` text COLLATE utf8_unicode_ci,
  `83198X11X1692SQ043_SQ002` text COLLATE utf8_unicode_ci,
  `83198X11X1692SQ043_SQ003` text COLLATE utf8_unicode_ci,
  `83198X11X1692SQ043_SQ004` text COLLATE utf8_unicode_ci,
  `83198X11X1692SQ044_SQ001` text COLLATE utf8_unicode_ci,
  `83198X11X1692SQ044_SQ002` text COLLATE utf8_unicode_ci,
  `83198X11X1692SQ044_SQ003` text COLLATE utf8_unicode_ci,
  `83198X11X1692SQ044_SQ004` text COLLATE utf8_unicode_ci,
  `83198X11X1692SQ045_SQ001` text COLLATE utf8_unicode_ci,
  `83198X11X1692SQ045_SQ002` text COLLATE utf8_unicode_ci,
  `83198X11X1692SQ045_SQ003` text COLLATE utf8_unicode_ci,
  `83198X11X1692SQ045_SQ004` text COLLATE utf8_unicode_ci,
  `83198X11X1692SQ046_SQ001` text COLLATE utf8_unicode_ci,
  `83198X11X1692SQ046_SQ002` text COLLATE utf8_unicode_ci,
  `83198X11X1692SQ046_SQ003` text COLLATE utf8_unicode_ci,
  `83198X11X1692SQ046_SQ004` text COLLATE utf8_unicode_ci,
  `83198X11X1692SQ047_SQ001` text COLLATE utf8_unicode_ci,
  `83198X11X1692SQ047_SQ002` text COLLATE utf8_unicode_ci,
  `83198X11X1692SQ047_SQ003` text COLLATE utf8_unicode_ci,
  `83198X11X1692SQ047_SQ004` text COLLATE utf8_unicode_ci,
  `83198X11X1692SQ048_SQ001` text COLLATE utf8_unicode_ci,
  `83198X11X1692SQ048_SQ002` text COLLATE utf8_unicode_ci,
  `83198X11X1692SQ048_SQ003` text COLLATE utf8_unicode_ci,
  `83198X11X1692SQ048_SQ004` text COLLATE utf8_unicode_ci,
  `83198X11X1692SQ049_SQ001` text COLLATE utf8_unicode_ci,
  `83198X11X1692SQ049_SQ002` text COLLATE utf8_unicode_ci,
  `83198X11X1692SQ049_SQ003` text COLLATE utf8_unicode_ci,
  `83198X11X1692SQ049_SQ004` text COLLATE utf8_unicode_ci,
  `83198X11X1692SQ050_SQ001` text COLLATE utf8_unicode_ci,
  `83198X11X1692SQ050_SQ002` text COLLATE utf8_unicode_ci,
  `83198X11X1692SQ050_SQ003` text COLLATE utf8_unicode_ci,
  `83198X11X1692SQ050_SQ004` text COLLATE utf8_unicode_ci,
  `83198X11X1692SQ051_SQ001` text COLLATE utf8_unicode_ci,
  `83198X11X1692SQ051_SQ002` text COLLATE utf8_unicode_ci,
  `83198X11X1692SQ051_SQ003` text COLLATE utf8_unicode_ci,
  `83198X11X1692SQ051_SQ004` text COLLATE utf8_unicode_ci,
  `83198X11X1692SQ052_SQ001` text COLLATE utf8_unicode_ci,
  `83198X11X1692SQ052_SQ002` text COLLATE utf8_unicode_ci,
  `83198X11X1692SQ052_SQ003` text COLLATE utf8_unicode_ci,
  `83198X11X1692SQ052_SQ004` text COLLATE utf8_unicode_ci,
  `83198X11X1692SQ053_SQ001` text COLLATE utf8_unicode_ci,
  `83198X11X1692SQ053_SQ002` text COLLATE utf8_unicode_ci,
  `83198X11X1692SQ053_SQ003` text COLLATE utf8_unicode_ci,
  `83198X11X1692SQ053_SQ004` text COLLATE utf8_unicode_ci,
  `83198X11X1692SQ054_SQ001` text COLLATE utf8_unicode_ci,
  `83198X11X1692SQ054_SQ002` text COLLATE utf8_unicode_ci,
  `83198X11X1692SQ054_SQ003` text COLLATE utf8_unicode_ci,
  `83198X11X1692SQ054_SQ004` text COLLATE utf8_unicode_ci,
  `83198X11X1692SQ055_SQ001` text COLLATE utf8_unicode_ci,
  `83198X11X1692SQ055_SQ002` text COLLATE utf8_unicode_ci,
  `83198X11X1692SQ055_SQ003` text COLLATE utf8_unicode_ci,
  `83198X11X1692SQ055_SQ004` text COLLATE utf8_unicode_ci,
  `83198X11X1692SQ056_SQ001` text COLLATE utf8_unicode_ci,
  `83198X11X1692SQ056_SQ002` text COLLATE utf8_unicode_ci,
  `83198X11X1692SQ056_SQ003` text COLLATE utf8_unicode_ci,
  `83198X11X1692SQ056_SQ004` text COLLATE utf8_unicode_ci,
  `83198X11X1692SQ057_SQ001` text COLLATE utf8_unicode_ci,
  `83198X11X1692SQ057_SQ002` text COLLATE utf8_unicode_ci,
  `83198X11X1692SQ057_SQ003` text COLLATE utf8_unicode_ci,
  `83198X11X1692SQ057_SQ004` text COLLATE utf8_unicode_ci,
  `83198X11X1692SQ058_SQ001` text COLLATE utf8_unicode_ci,
  `83198X11X1692SQ058_SQ002` text COLLATE utf8_unicode_ci,
  `83198X11X1692SQ058_SQ003` text COLLATE utf8_unicode_ci,
  `83198X11X1692SQ058_SQ004` text COLLATE utf8_unicode_ci,
  `83198X11X1692SQ059_SQ001` text COLLATE utf8_unicode_ci,
  `83198X11X1692SQ059_SQ002` text COLLATE utf8_unicode_ci,
  `83198X11X1692SQ059_SQ003` text COLLATE utf8_unicode_ci,
  `83198X11X1692SQ059_SQ004` text COLLATE utf8_unicode_ci,
  `83198X11X1692SQ060_SQ001` text COLLATE utf8_unicode_ci,
  `83198X11X1692SQ060_SQ002` text COLLATE utf8_unicode_ci,
  `83198X11X1692SQ060_SQ003` text COLLATE utf8_unicode_ci,
  `83198X11X1692SQ060_SQ004` text COLLATE utf8_unicode_ci,
  `83198X11X1692SQ061_SQ001` text COLLATE utf8_unicode_ci,
  `83198X11X1692SQ061_SQ002` text COLLATE utf8_unicode_ci,
  `83198X11X1692SQ061_SQ003` text COLLATE utf8_unicode_ci,
  `83198X11X1692SQ061_SQ004` text COLLATE utf8_unicode_ci,
  `83198X11X1692SQ062_SQ001` text COLLATE utf8_unicode_ci,
  `83198X11X1692SQ062_SQ002` text COLLATE utf8_unicode_ci,
  `83198X11X1692SQ062_SQ003` text COLLATE utf8_unicode_ci,
  `83198X11X1692SQ062_SQ004` text COLLATE utf8_unicode_ci,
  `83198X11X1692SQ063_SQ001` text COLLATE utf8_unicode_ci,
  `83198X11X1692SQ063_SQ002` text COLLATE utf8_unicode_ci,
  `83198X11X1692SQ063_SQ003` text COLLATE utf8_unicode_ci,
  `83198X11X1692SQ063_SQ004` text COLLATE utf8_unicode_ci,
  `83198X11X1692SQ064_SQ001` text COLLATE utf8_unicode_ci,
  `83198X11X1692SQ064_SQ002` text COLLATE utf8_unicode_ci,
  `83198X11X1692SQ064_SQ003` text COLLATE utf8_unicode_ci,
  `83198X11X1692SQ064_SQ004` text COLLATE utf8_unicode_ci,
  `83198X11X1692SQ065_SQ001` text COLLATE utf8_unicode_ci,
  `83198X11X1692SQ065_SQ002` text COLLATE utf8_unicode_ci,
  `83198X11X1692SQ065_SQ003` text COLLATE utf8_unicode_ci,
  `83198X11X1692SQ065_SQ004` text COLLATE utf8_unicode_ci,
  `83198X11X1692SQ066_SQ001` text COLLATE utf8_unicode_ci,
  `83198X11X1692SQ066_SQ002` text COLLATE utf8_unicode_ci,
  `83198X11X1692SQ066_SQ003` text COLLATE utf8_unicode_ci,
  `83198X11X1692SQ066_SQ004` text COLLATE utf8_unicode_ci,
  `83198X11X1692SQ067_SQ001` text COLLATE utf8_unicode_ci,
  `83198X11X1692SQ067_SQ002` text COLLATE utf8_unicode_ci,
  `83198X11X1692SQ067_SQ003` text COLLATE utf8_unicode_ci,
  `83198X11X1692SQ067_SQ004` text COLLATE utf8_unicode_ci,
  `83198X11X1692SQ068_SQ001` text COLLATE utf8_unicode_ci,
  `83198X11X1692SQ068_SQ002` text COLLATE utf8_unicode_ci,
  `83198X11X1692SQ068_SQ003` text COLLATE utf8_unicode_ci,
  `83198X11X1692SQ068_SQ004` text COLLATE utf8_unicode_ci,
  `83198X11X1692SQ069_SQ001` text COLLATE utf8_unicode_ci,
  `83198X11X1692SQ069_SQ002` text COLLATE utf8_unicode_ci,
  `83198X11X1692SQ069_SQ003` text COLLATE utf8_unicode_ci,
  `83198X11X1692SQ069_SQ004` text COLLATE utf8_unicode_ci,
  `83198X11X1692SQ070_SQ001` text COLLATE utf8_unicode_ci,
  `83198X11X1692SQ070_SQ002` text COLLATE utf8_unicode_ci,
  `83198X11X1692SQ070_SQ003` text COLLATE utf8_unicode_ci,
  `83198X11X1692SQ070_SQ004` text COLLATE utf8_unicode_ci,
  `83198X11X1693SQ001_SQ001` text COLLATE utf8_unicode_ci,
  `83198X11X1693SQ001_SQ002` text COLLATE utf8_unicode_ci,
  `83198X11X1693SQ001_SQ003` text COLLATE utf8_unicode_ci,
  `83198X11X1693SQ001_SQ004` text COLLATE utf8_unicode_ci,
  `83198X11X1693SQ001_SQ005` text COLLATE utf8_unicode_ci,
  `83198X11X1694SQ001_SQ001` text COLLATE utf8_unicode_ci,
  `83198X11X1694SQ001_SQ002` text COLLATE utf8_unicode_ci,
  `83198X11X1694SQ001_SQ003` text COLLATE utf8_unicode_ci,
  `83198X11X1694SQ001_SQ004` text COLLATE utf8_unicode_ci,
  `83198X11X1694SQ001_SQ005` text COLLATE utf8_unicode_ci,
  `83198X11X1694SQ002_SQ001` text COLLATE utf8_unicode_ci,
  `83198X11X1694SQ002_SQ002` text COLLATE utf8_unicode_ci,
  `83198X11X1694SQ002_SQ003` text COLLATE utf8_unicode_ci,
  `83198X11X1694SQ002_SQ004` text COLLATE utf8_unicode_ci,
  `83198X11X1694SQ002_SQ005` text COLLATE utf8_unicode_ci,
  `83198X11X1695SQ001_SQ001` text COLLATE utf8_unicode_ci,
  `83198X11X1695SQ001_SQ002` text COLLATE utf8_unicode_ci,
  `83198X11X1695SQ001_SQ003` text COLLATE utf8_unicode_ci,
  `83198X11X1695SQ002_SQ001` text COLLATE utf8_unicode_ci,
  `83198X11X1695SQ002_SQ002` text COLLATE utf8_unicode_ci,
  `83198X11X1695SQ002_SQ003` text COLLATE utf8_unicode_ci,
  `83198X11X1695SQ003_SQ001` text COLLATE utf8_unicode_ci,
  `83198X11X1695SQ003_SQ002` text COLLATE utf8_unicode_ci,
  `83198X11X1695SQ003_SQ003` text COLLATE utf8_unicode_ci,
  `83198X11X1695SQ004_SQ001` text COLLATE utf8_unicode_ci,
  `83198X11X1695SQ004_SQ002` text COLLATE utf8_unicode_ci,
  `83198X11X1695SQ004_SQ003` text COLLATE utf8_unicode_ci,
  `83198X11X1695SQ005_SQ001` text COLLATE utf8_unicode_ci,
  `83198X11X1695SQ005_SQ002` text COLLATE utf8_unicode_ci,
  `83198X11X1695SQ005_SQ003` text COLLATE utf8_unicode_ci,
  `83198X11X1695SQ006_SQ001` text COLLATE utf8_unicode_ci,
  `83198X11X1695SQ006_SQ002` text COLLATE utf8_unicode_ci,
  `83198X11X1695SQ006_SQ003` text COLLATE utf8_unicode_ci,
  `83198X11X1695SQ007_SQ001` text COLLATE utf8_unicode_ci,
  `83198X11X1695SQ007_SQ002` text COLLATE utf8_unicode_ci,
  `83198X11X1695SQ007_SQ003` text COLLATE utf8_unicode_ci,
  `83198X11X1695SQ008_SQ001` text COLLATE utf8_unicode_ci,
  `83198X11X1695SQ008_SQ002` text COLLATE utf8_unicode_ci,
  `83198X11X1695SQ008_SQ003` text COLLATE utf8_unicode_ci,
  `83198X11X1695SQ009_SQ001` text COLLATE utf8_unicode_ci,
  `83198X11X1695SQ009_SQ002` text COLLATE utf8_unicode_ci,
  `83198X11X1695SQ009_SQ003` text COLLATE utf8_unicode_ci,
  `83198X11X1695SQ010_SQ001` text COLLATE utf8_unicode_ci,
  `83198X11X1695SQ010_SQ002` text COLLATE utf8_unicode_ci,
  `83198X11X1695SQ010_SQ003` text COLLATE utf8_unicode_ci,
  `83198X11X1695SQ011_SQ001` text COLLATE utf8_unicode_ci,
  `83198X11X1695SQ011_SQ002` text COLLATE utf8_unicode_ci,
  `83198X11X1695SQ011_SQ003` text COLLATE utf8_unicode_ci,
  `83198X11X1695SQ012_SQ001` text COLLATE utf8_unicode_ci,
  `83198X11X1695SQ012_SQ002` text COLLATE utf8_unicode_ci,
  `83198X11X1695SQ012_SQ003` text COLLATE utf8_unicode_ci,
  `83198X11X1695SQ013_SQ001` text COLLATE utf8_unicode_ci,
  `83198X11X1695SQ013_SQ002` text COLLATE utf8_unicode_ci,
  `83198X11X1695SQ013_SQ003` text COLLATE utf8_unicode_ci,
  `83198X11X1695SQ014_SQ001` text COLLATE utf8_unicode_ci,
  `83198X11X1695SQ014_SQ002` text COLLATE utf8_unicode_ci,
  `83198X11X1695SQ014_SQ003` text COLLATE utf8_unicode_ci,
  `83198X11X1695SQ015_SQ001` text COLLATE utf8_unicode_ci,
  `83198X11X1695SQ015_SQ002` text COLLATE utf8_unicode_ci,
  `83198X11X1695SQ015_SQ003` text COLLATE utf8_unicode_ci,
  `83198X11X1695SQ016_SQ001` text COLLATE utf8_unicode_ci,
  `83198X11X1695SQ016_SQ002` text COLLATE utf8_unicode_ci,
  `83198X11X1695SQ016_SQ003` text COLLATE utf8_unicode_ci,
  `83198X11X1695SQ017_SQ001` text COLLATE utf8_unicode_ci,
  `83198X11X1695SQ017_SQ002` text COLLATE utf8_unicode_ci,
  `83198X11X1695SQ017_SQ003` text COLLATE utf8_unicode_ci,
  `83198X11X1695SQ018_SQ001` text COLLATE utf8_unicode_ci,
  `83198X11X1695SQ018_SQ002` text COLLATE utf8_unicode_ci,
  `83198X11X1695SQ018_SQ003` text COLLATE utf8_unicode_ci,
  `83198X11X1695SQ019_SQ001` text COLLATE utf8_unicode_ci,
  `83198X11X1695SQ019_SQ002` text COLLATE utf8_unicode_ci,
  `83198X11X1695SQ019_SQ003` text COLLATE utf8_unicode_ci,
  `83198X11X1695SQ020_SQ001` text COLLATE utf8_unicode_ci,
  `83198X11X1695SQ020_SQ002` text COLLATE utf8_unicode_ci,
  `83198X11X1695SQ020_SQ003` text COLLATE utf8_unicode_ci,
  `83198X11X1695SQ021_SQ001` text COLLATE utf8_unicode_ci,
  `83198X11X1695SQ021_SQ002` text COLLATE utf8_unicode_ci,
  `83198X11X1695SQ021_SQ003` text COLLATE utf8_unicode_ci,
  `83198X11X1695SQ022_SQ001` text COLLATE utf8_unicode_ci,
  `83198X11X1695SQ022_SQ002` text COLLATE utf8_unicode_ci,
  `83198X11X1695SQ022_SQ003` text COLLATE utf8_unicode_ci,
  `83198X11X1695SQ023_SQ001` text COLLATE utf8_unicode_ci,
  `83198X11X1695SQ023_SQ002` text COLLATE utf8_unicode_ci,
  `83198X11X1695SQ023_SQ003` text COLLATE utf8_unicode_ci,
  `83198X11X1695SQ024_SQ001` text COLLATE utf8_unicode_ci,
  `83198X11X1695SQ024_SQ002` text COLLATE utf8_unicode_ci,
  `83198X11X1695SQ024_SQ003` text COLLATE utf8_unicode_ci,
  `83198X11X1695SQ025_SQ001` text COLLATE utf8_unicode_ci,
  `83198X11X1695SQ025_SQ002` text COLLATE utf8_unicode_ci,
  `83198X11X1695SQ025_SQ003` text COLLATE utf8_unicode_ci,
  `83198X11X1696SQ001_SQ001` text COLLATE utf8_unicode_ci,
  `83198X11X1696SQ001_SQ002` text COLLATE utf8_unicode_ci,
  `83198X11X1696SQ001_SQ003` text COLLATE utf8_unicode_ci,
  `83198X11X1696SQ001_SQ004` text COLLATE utf8_unicode_ci,
  `83198X11X1696SQ001_SQ005` text COLLATE utf8_unicode_ci,
  `83198X11X1696SQ002_SQ001` text COLLATE utf8_unicode_ci,
  `83198X11X1696SQ002_SQ002` text COLLATE utf8_unicode_ci,
  `83198X11X1696SQ002_SQ003` text COLLATE utf8_unicode_ci,
  `83198X11X1696SQ002_SQ004` text COLLATE utf8_unicode_ci,
  `83198X11X1696SQ002_SQ005` text COLLATE utf8_unicode_ci,
  `83198X11X1696SQ003_SQ001` text COLLATE utf8_unicode_ci,
  `83198X11X1696SQ003_SQ002` text COLLATE utf8_unicode_ci,
  `83198X11X1696SQ003_SQ003` text COLLATE utf8_unicode_ci,
  `83198X11X1696SQ003_SQ004` text COLLATE utf8_unicode_ci,
  `83198X11X1696SQ003_SQ005` text COLLATE utf8_unicode_ci,
  `83198X11X1697SQ001_SQ001` text COLLATE utf8_unicode_ci,
  `83198X11X1697SQ001_SQ002` text COLLATE utf8_unicode_ci,
  `83198X11X1697SQ001_SQ003` text COLLATE utf8_unicode_ci,
  `83198X11X1697SQ001_SQ004` text COLLATE utf8_unicode_ci,
  `83198X11X1697SQ002_SQ001` text COLLATE utf8_unicode_ci,
  `83198X11X1697SQ002_SQ002` text COLLATE utf8_unicode_ci,
  `83198X11X1697SQ002_SQ003` text COLLATE utf8_unicode_ci,
  `83198X11X1697SQ002_SQ004` text COLLATE utf8_unicode_ci,
  `83198X11X1697SQ003_SQ001` text COLLATE utf8_unicode_ci,
  `83198X11X1697SQ003_SQ002` text COLLATE utf8_unicode_ci,
  `83198X11X1697SQ003_SQ003` text COLLATE utf8_unicode_ci,
  `83198X11X1697SQ003_SQ004` text COLLATE utf8_unicode_ci,
  `83198X11X1697SQ004_SQ001` text COLLATE utf8_unicode_ci,
  `83198X11X1697SQ004_SQ002` text COLLATE utf8_unicode_ci,
  `83198X11X1697SQ004_SQ003` text COLLATE utf8_unicode_ci,
  `83198X11X1697SQ004_SQ004` text COLLATE utf8_unicode_ci,
  `83198X11X1697SQ005_SQ001` text COLLATE utf8_unicode_ci,
  `83198X11X1697SQ005_SQ002` text COLLATE utf8_unicode_ci,
  `83198X11X1697SQ005_SQ003` text COLLATE utf8_unicode_ci,
  `83198X11X1697SQ005_SQ004` text COLLATE utf8_unicode_ci,
  `83198X11X1697SQ006_SQ001` text COLLATE utf8_unicode_ci,
  `83198X11X1697SQ006_SQ002` text COLLATE utf8_unicode_ci,
  `83198X11X1697SQ006_SQ003` text COLLATE utf8_unicode_ci,
  `83198X11X1697SQ006_SQ004` text COLLATE utf8_unicode_ci,
  `83198X11X1697SQ007_SQ001` text COLLATE utf8_unicode_ci,
  `83198X11X1697SQ007_SQ002` text COLLATE utf8_unicode_ci,
  `83198X11X1697SQ007_SQ003` text COLLATE utf8_unicode_ci,
  `83198X11X1697SQ007_SQ004` text COLLATE utf8_unicode_ci,
  `83198X11X1697SQ008_SQ001` text COLLATE utf8_unicode_ci,
  `83198X11X1697SQ008_SQ002` text COLLATE utf8_unicode_ci,
  `83198X11X1697SQ008_SQ003` text COLLATE utf8_unicode_ci,
  `83198X11X1697SQ008_SQ004` text COLLATE utf8_unicode_ci,
  `83198X11X1697SQ009_SQ001` text COLLATE utf8_unicode_ci,
  `83198X11X1697SQ009_SQ002` text COLLATE utf8_unicode_ci,
  `83198X11X1697SQ009_SQ003` text COLLATE utf8_unicode_ci,
  `83198X11X1697SQ009_SQ004` text COLLATE utf8_unicode_ci,
  `83198X11X1697SQ010_SQ001` text COLLATE utf8_unicode_ci,
  `83198X11X1697SQ010_SQ002` text COLLATE utf8_unicode_ci,
  `83198X11X1697SQ010_SQ003` text COLLATE utf8_unicode_ci,
  `83198X11X1697SQ010_SQ004` text COLLATE utf8_unicode_ci,
  `83198X11X1697SQ011_SQ001` text COLLATE utf8_unicode_ci,
  `83198X11X1697SQ011_SQ002` text COLLATE utf8_unicode_ci,
  `83198X11X1697SQ011_SQ003` text COLLATE utf8_unicode_ci,
  `83198X11X1697SQ011_SQ004` text COLLATE utf8_unicode_ci,
  `83198X11X1697SQ012_SQ001` text COLLATE utf8_unicode_ci,
  `83198X11X1697SQ012_SQ002` text COLLATE utf8_unicode_ci,
  `83198X11X1697SQ012_SQ003` text COLLATE utf8_unicode_ci,
  `83198X11X1697SQ012_SQ004` text COLLATE utf8_unicode_ci,
  `83198X11X1697SQ013_SQ001` text COLLATE utf8_unicode_ci,
  `83198X11X1697SQ013_SQ002` text COLLATE utf8_unicode_ci,
  `83198X11X1697SQ013_SQ003` text COLLATE utf8_unicode_ci,
  `83198X11X1697SQ013_SQ004` text COLLATE utf8_unicode_ci,
  `83198X11X1697SQ014_SQ001` text COLLATE utf8_unicode_ci,
  `83198X11X1697SQ014_SQ002` text COLLATE utf8_unicode_ci,
  `83198X11X1697SQ014_SQ003` text COLLATE utf8_unicode_ci,
  `83198X11X1697SQ014_SQ004` text COLLATE utf8_unicode_ci,
  `83198X11X1697SQ015_SQ001` text COLLATE utf8_unicode_ci,
  `83198X11X1697SQ015_SQ002` text COLLATE utf8_unicode_ci,
  `83198X11X1697SQ015_SQ003` text COLLATE utf8_unicode_ci,
  `83198X11X1697SQ015_SQ004` text COLLATE utf8_unicode_ci,
  `83198X11X1698SQ001_SQ001` text COLLATE utf8_unicode_ci,
  `83198X11X1698SQ001_SQ002` text COLLATE utf8_unicode_ci,
  `83198X11X1698SQ001_SQ003` text COLLATE utf8_unicode_ci,
  `83198X11X1698SQ001_SQ004` text COLLATE utf8_unicode_ci,
  `83198X11X1698SQ001_SQ005` text COLLATE utf8_unicode_ci,
  `83198X11X1698SQ002_SQ001` text COLLATE utf8_unicode_ci,
  `83198X11X1698SQ002_SQ002` text COLLATE utf8_unicode_ci,
  `83198X11X1698SQ002_SQ003` text COLLATE utf8_unicode_ci,
  `83198X11X1698SQ002_SQ004` text COLLATE utf8_unicode_ci,
  `83198X11X1698SQ002_SQ005` text COLLATE utf8_unicode_ci,
  `83198X11X1698SQ003_SQ001` text COLLATE utf8_unicode_ci,
  `83198X11X1698SQ003_SQ002` text COLLATE utf8_unicode_ci,
  `83198X11X1698SQ003_SQ003` text COLLATE utf8_unicode_ci,
  `83198X11X1698SQ003_SQ004` text COLLATE utf8_unicode_ci,
  `83198X11X1698SQ003_SQ005` text COLLATE utf8_unicode_ci,
  `83198X11X1699SQ001_SQ001` text COLLATE utf8_unicode_ci,
  `83198X11X1699SQ001_SQ002` text COLLATE utf8_unicode_ci,
  `83198X11X1699SQ001_SQ003` text COLLATE utf8_unicode_ci,
  `83198X11X1699SQ002_SQ001` text COLLATE utf8_unicode_ci,
  `83198X11X1699SQ002_SQ002` text COLLATE utf8_unicode_ci,
  `83198X11X1699SQ002_SQ003` text COLLATE utf8_unicode_ci,
  `83198X11X1699SQ003_SQ001` text COLLATE utf8_unicode_ci,
  `83198X11X1699SQ003_SQ002` text COLLATE utf8_unicode_ci,
  `83198X11X1699SQ003_SQ003` text COLLATE utf8_unicode_ci,
  `83198X11X1699SQ004_SQ001` text COLLATE utf8_unicode_ci,
  `83198X11X1699SQ004_SQ002` text COLLATE utf8_unicode_ci,
  `83198X11X1699SQ004_SQ003` text COLLATE utf8_unicode_ci,
  `83198X11X1699SQ005_SQ001` text COLLATE utf8_unicode_ci,
  `83198X11X1699SQ005_SQ002` text COLLATE utf8_unicode_ci,
  `83198X11X1699SQ005_SQ003` text COLLATE utf8_unicode_ci,
  `83198X11X1699SQ006_SQ001` text COLLATE utf8_unicode_ci,
  `83198X11X1699SQ006_SQ002` text COLLATE utf8_unicode_ci,
  `83198X11X1699SQ006_SQ003` text COLLATE utf8_unicode_ci,
  `83198X11X1699SQ007_SQ001` text COLLATE utf8_unicode_ci,
  `83198X11X1699SQ007_SQ002` text COLLATE utf8_unicode_ci,
  `83198X11X1699SQ007_SQ003` text COLLATE utf8_unicode_ci,
  `83198X11X1699SQ008_SQ001` text COLLATE utf8_unicode_ci,
  `83198X11X1699SQ008_SQ002` text COLLATE utf8_unicode_ci,
  `83198X11X1699SQ008_SQ003` text COLLATE utf8_unicode_ci,
  `83198X11X1699SQ009_SQ001` text COLLATE utf8_unicode_ci,
  `83198X11X1699SQ009_SQ002` text COLLATE utf8_unicode_ci,
  `83198X11X1699SQ009_SQ003` text COLLATE utf8_unicode_ci,
  `83198X11X1699SQ010_SQ001` text COLLATE utf8_unicode_ci,
  `83198X11X1699SQ010_SQ002` text COLLATE utf8_unicode_ci,
  `83198X11X1699SQ010_SQ003` text COLLATE utf8_unicode_ci,
  `83198X11X1699SQ011_SQ001` text COLLATE utf8_unicode_ci,
  `83198X11X1699SQ011_SQ002` text COLLATE utf8_unicode_ci,
  `83198X11X1699SQ011_SQ003` text COLLATE utf8_unicode_ci,
  `83198X11X1699SQ012_SQ001` text COLLATE utf8_unicode_ci,
  `83198X11X1699SQ012_SQ002` text COLLATE utf8_unicode_ci,
  `83198X11X1699SQ012_SQ003` text COLLATE utf8_unicode_ci,
  `83198X11X1699SQ013_SQ001` text COLLATE utf8_unicode_ci,
  `83198X11X1699SQ013_SQ002` text COLLATE utf8_unicode_ci,
  `83198X11X1699SQ013_SQ003` text COLLATE utf8_unicode_ci,
  `83198X11X1699SQ014_SQ001` text COLLATE utf8_unicode_ci,
  `83198X11X1699SQ014_SQ002` text COLLATE utf8_unicode_ci,
  `83198X11X1699SQ014_SQ003` text COLLATE utf8_unicode_ci,
  `83198X11X1699SQ015_SQ001` text COLLATE utf8_unicode_ci,
  `83198X11X1699SQ015_SQ002` text COLLATE utf8_unicode_ci,
  `83198X11X1699SQ015_SQ003` text COLLATE utf8_unicode_ci,
  `83198X11X1702SQ001` varchar(5) COLLATE utf8_unicode_ci DEFAULT NULL,
  `83198X11X1702SQ002` varchar(5) COLLATE utf8_unicode_ci DEFAULT NULL,
  `83198X11X1702SQ003` varchar(5) COLLATE utf8_unicode_ci DEFAULT NULL,
  `83198X11X1703SQ001_SQ001` text COLLATE utf8_unicode_ci,
  `83198X11X1703SQ001_SQ002` text COLLATE utf8_unicode_ci,
  `83198X11X1703SQ001_SQ003` text COLLATE utf8_unicode_ci,
  `83198X11X1703SQ001_SQ004` text COLLATE utf8_unicode_ci,
  `83198X11X1703SQ002_SQ001` text COLLATE utf8_unicode_ci,
  `83198X11X1703SQ002_SQ002` text COLLATE utf8_unicode_ci,
  `83198X11X1703SQ002_SQ003` text COLLATE utf8_unicode_ci,
  `83198X11X1703SQ002_SQ004` text COLLATE utf8_unicode_ci,
  `83198X11X1703SQ003_SQ001` text COLLATE utf8_unicode_ci,
  `83198X11X1703SQ003_SQ002` text COLLATE utf8_unicode_ci,
  `83198X11X1703SQ003_SQ003` text COLLATE utf8_unicode_ci,
  `83198X11X1703SQ003_SQ004` text COLLATE utf8_unicode_ci,
  `83198X11X1703SQ004_SQ001` text COLLATE utf8_unicode_ci,
  `83198X11X1703SQ004_SQ002` text COLLATE utf8_unicode_ci,
  `83198X11X1703SQ004_SQ003` text COLLATE utf8_unicode_ci,
  `83198X11X1703SQ004_SQ004` text COLLATE utf8_unicode_ci,
  `83198X11X1703SQ005_SQ001` text COLLATE utf8_unicode_ci,
  `83198X11X1703SQ005_SQ002` text COLLATE utf8_unicode_ci,
  `83198X11X1703SQ005_SQ003` text COLLATE utf8_unicode_ci,
  `83198X11X1703SQ005_SQ004` text COLLATE utf8_unicode_ci,
  `83198X11X1703SQ006_SQ001` text COLLATE utf8_unicode_ci,
  `83198X11X1703SQ006_SQ002` text COLLATE utf8_unicode_ci,
  `83198X11X1703SQ006_SQ003` text COLLATE utf8_unicode_ci,
  `83198X11X1703SQ006_SQ004` text COLLATE utf8_unicode_ci,
  `83198X11X1703SQ007_SQ001` text COLLATE utf8_unicode_ci,
  `83198X11X1703SQ007_SQ002` text COLLATE utf8_unicode_ci,
  `83198X11X1703SQ007_SQ003` text COLLATE utf8_unicode_ci,
  `83198X11X1703SQ007_SQ004` text COLLATE utf8_unicode_ci,
  `83198X11X1703SQ008_SQ001` text COLLATE utf8_unicode_ci,
  `83198X11X1703SQ008_SQ002` text COLLATE utf8_unicode_ci,
  `83198X11X1703SQ008_SQ003` text COLLATE utf8_unicode_ci,
  `83198X11X1703SQ008_SQ004` text COLLATE utf8_unicode_ci,
  `83198X11X1703SQ009_SQ001` text COLLATE utf8_unicode_ci,
  `83198X11X1703SQ009_SQ002` text COLLATE utf8_unicode_ci,
  `83198X11X1703SQ009_SQ003` text COLLATE utf8_unicode_ci,
  `83198X11X1703SQ009_SQ004` text COLLATE utf8_unicode_ci,
  `83198X11X1703SQ010_SQ001` text COLLATE utf8_unicode_ci,
  `83198X11X1703SQ010_SQ002` text COLLATE utf8_unicode_ci,
  `83198X11X1703SQ010_SQ003` text COLLATE utf8_unicode_ci,
  `83198X11X1703SQ010_SQ004` text COLLATE utf8_unicode_ci,
  `83198X11X1700SQ001_SQ001` text COLLATE utf8_unicode_ci,
  `83198X11X1700SQ002_SQ001` text COLLATE utf8_unicode_ci,
  `83198X11X1700SQ003_SQ001` text COLLATE utf8_unicode_ci,
  `83198X11X1700SQ004_SQ001` text COLLATE utf8_unicode_ci,
  `83198X11X1700SQ005_SQ001` text COLLATE utf8_unicode_ci,
  `83198X11X1700SQ006_SQ001` text COLLATE utf8_unicode_ci,
  `83198X11X1700SQ007_SQ001` text COLLATE utf8_unicode_ci,
  `83198X11X1700SQ008_SQ001` text COLLATE utf8_unicode_ci,
  `83198X11X1700SQ009_SQ001` text COLLATE utf8_unicode_ci,
  `83198X11X1700SQ010_SQ001` text COLLATE utf8_unicode_ci,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=37 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `lime_surveys_languagesettings`
--

DROP TABLE IF EXISTS `lime_surveys_languagesettings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `lime_surveys_languagesettings` (
  `surveyls_survey_id` int(11) NOT NULL DEFAULT '0',
  `surveyls_language` varchar(45) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'en',
  `surveyls_title` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `surveyls_description` text COLLATE utf8_unicode_ci,
  `surveyls_welcometext` text COLLATE utf8_unicode_ci,
  `surveyls_endtext` text COLLATE utf8_unicode_ci,
  `surveyls_url` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `surveyls_urldescription` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `surveyls_email_invite_subj` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `surveyls_email_invite` text COLLATE utf8_unicode_ci,
  `surveyls_email_remind_subj` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `surveyls_email_remind` text COLLATE utf8_unicode_ci,
  `surveyls_email_register_subj` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `surveyls_email_register` text COLLATE utf8_unicode_ci,
  `surveyls_email_confirm_subj` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `surveyls_email_confirm` text COLLATE utf8_unicode_ci,
  `surveyls_dateformat` int(10) unsigned NOT NULL DEFAULT '1',
  `email_admin_notification_subj` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email_admin_notification` text COLLATE utf8_unicode_ci,
  `email_admin_responses_subj` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email_admin_responses` text COLLATE utf8_unicode_ci,
  `surveyls_numberformat` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`surveyls_survey_id`,`surveyls_language`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `lime_tokens_49731`
--

DROP TABLE IF EXISTS `lime_tokens_49731`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `lime_tokens_49731` (
  `tid` int(11) NOT NULL AUTO_INCREMENT,
  `firstname` varchar(40) COLLATE utf8_unicode_ci DEFAULT NULL,
  `lastname` varchar(40) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` text COLLATE utf8_unicode_ci,
  `emailstatus` text COLLATE utf8_unicode_ci,
  `token` varchar(36) COLLATE utf8_unicode_ci DEFAULT NULL,
  `language` varchar(25) COLLATE utf8_unicode_ci DEFAULT NULL,
  `sent` varchar(17) COLLATE utf8_unicode_ci DEFAULT 'N',
  `remindersent` varchar(17) COLLATE utf8_unicode_ci DEFAULT 'N',
  `remindercount` int(11) DEFAULT '0',
  `completed` varchar(17) COLLATE utf8_unicode_ci DEFAULT 'N',
  `usesleft` int(11) DEFAULT '1',
  `validfrom` datetime DEFAULT NULL,
  `validuntil` datetime DEFAULT NULL,
  `mpid` int(11) DEFAULT NULL,
  PRIMARY KEY (`tid`),
  KEY `lime_tokens_49731_idx` (`token`),
  KEY `idx_lime_tokens_49731_efl` (`email`(120),`firstname`,`lastname`)
) ENGINE=MyISAM AUTO_INCREMENT=16 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `lime_tokens_83198`
--

DROP TABLE IF EXISTS `lime_tokens_83198`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `lime_tokens_83198` (
  `tid` int(11) NOT NULL AUTO_INCREMENT,
  `firstname` varchar(40) COLLATE utf8_unicode_ci DEFAULT NULL,
  `lastname` varchar(40) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` text COLLATE utf8_unicode_ci,
  `emailstatus` text COLLATE utf8_unicode_ci,
  `token` varchar(36) COLLATE utf8_unicode_ci DEFAULT NULL,
  `language` varchar(25) COLLATE utf8_unicode_ci DEFAULT NULL,
  `sent` varchar(17) COLLATE utf8_unicode_ci DEFAULT 'N',
  `remindersent` varchar(17) COLLATE utf8_unicode_ci DEFAULT 'N',
  `remindercount` int(11) DEFAULT '0',
  `completed` varchar(17) COLLATE utf8_unicode_ci DEFAULT 'N',
  `usesleft` int(11) DEFAULT '1',
  `validfrom` datetime DEFAULT NULL,
  `validuntil` datetime DEFAULT NULL,
  `mpid` int(11) DEFAULT NULL,
  PRIMARY KEY (`tid`),
  KEY `lime_tokens_83198_idx` (`token`),
  KEY `idx_lime_tokens_83198_efl` (`email`(120),`firstname`,`lastname`)
) ENGINE=MyISAM AUTO_INCREMENT=14 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `quest`
--

DROP TABLE IF EXISTS `quest`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `quest` (
  `quest_id` int(11) NOT NULL AUTO_INCREMENT,
  `r_id` int(11) DEFAULT NULL,
  `qname` text,
  `now_date` datetime DEFAULT NULL,
  `description` text,
  `c_id` int(11) DEFAULT NULL,
  `type` int(11) NOT NULL,
  `sub` int(11) NOT NULL,
  `edited` int(11) NOT NULL,
  PRIMARY KEY (`quest_id`),
  KEY `fk_r_id` (`r_id`)
) ENGINE=MyISAM AUTO_INCREMENT=165 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `quest1`
--

DROP TABLE IF EXISTS `quest1`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `quest1` (
  `q_id` int(11) NOT NULL DEFAULT '0',
  `c1_id` int(11) NOT NULL DEFAULT '0',
  `c2_id` int(11) NOT NULL DEFAULT '0',
  `r_id` int(11) DEFAULT NULL,
  `c_range` text,
  `description` text,
  `sub` int(11) DEFAULT NULL,
  PRIMARY KEY (`q_id`,`c1_id`,`c2_id`),
  KEY `quest1_c1_id_fk` (`c1_id`),
  KEY `quest1_c2_id_fk` (`c2_id`),
  KEY `quest1_r_id_fk` (`r_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `quest2`
--

DROP TABLE IF EXISTS `quest2`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `quest2` (
  `q_id` int(11) NOT NULL DEFAULT '0',
  `c_id` int(11) NOT NULL DEFAULT '0',
  `r_id` int(11) NOT NULL,
  `c_range` text,
  `unit` text,
  `description` text,
  PRIMARY KEY (`q_id`,`c_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `quest3`
--

DROP TABLE IF EXISTS `quest3`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `quest3` (
  `q_id` int(11) NOT NULL DEFAULT '0',
  `c_id` int(11) NOT NULL DEFAULT '0',
  `r_id` int(11) DEFAULT NULL,
  `c_range` text,
  `unit` text,
  `description` text,
  PRIMARY KEY (`q_id`,`c_id`),
  KEY `quest3_fk_c_id` (`c_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `quest_alternatives`
--

DROP TABLE IF EXISTS `quest_alternatives`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `quest_alternatives` (
  `q_id` int(11) NOT NULL DEFAULT '0',
  `t_id1` int(11) NOT NULL DEFAULT '0',
  `r_id` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`q_id`,`t_id1`,`r_id`),
  KEY `fk_t1_ID` (`t_id1`),
  KEY `fk_r_ID` (`r_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `quest_criteria`
--

DROP TABLE IF EXISTS `quest_criteria`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `quest_criteria` (
  `q_id` int(11) NOT NULL DEFAULT '0',
  `c_id` int(11) NOT NULL DEFAULT '0',
  `r_id` int(11) NOT NULL,
  `sub` int(11) NOT NULL,
  PRIMARY KEY (`q_id`,`c_id`),
  KEY `fk_c_id2` (`c_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `ranking`
--

DROP TABLE IF EXISTS `ranking`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ranking` (
  `r_id` int(11) NOT NULL DEFAULT '0',
  `t_id` int(11) NOT NULL DEFAULT '0',
  `u_id` int(11) NOT NULL DEFAULT '0',
  `ranking` float NOT NULL DEFAULT '0',
  PRIMARY KEY (`r_id`,`u_id`,`t_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `ranking_final`
--

DROP TABLE IF EXISTS `ranking_final`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ranking_final` (
  `r_id` int(11) NOT NULL DEFAULT '0',
  `t_id` int(11) NOT NULL DEFAULT '0',
  `ranking` float DEFAULT NULL,
  PRIMARY KEY (`r_id`,`t_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `research`
--

DROP TABLE IF EXISTS `research`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `research` (
  `research_id` int(11) NOT NULL AUTO_INCREMENT,
  `rname` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `now_date` datetime NOT NULL,
  `end_date` datetime NOT NULL,
  `description` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `published` tinyint(1) NOT NULL,
  `completed` tinyint(1) NOT NULL,
  PRIMARY KEY (`research_id`)
) ENGINE=MyISAM AUTO_INCREMENT=98 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `research_user`
--

DROP TABLE IF EXISTS `research_user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `research_user` (
  `r_id` int(11) DEFAULT NULL,
  `u_id` int(11) DEFAULT NULL,
  `completed` int(11) NOT NULL,
  KEY `r_id_fk` (`r_id`),
  KEY `u_id_fk` (`u_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `sub_answers`
--

DROP TABLE IF EXISTS `sub_answers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sub_answers` (
  `u_id` int(11) DEFAULT NULL,
  `r_id` int(11) NOT NULL,
  `sub_c_id1` int(11) DEFAULT NULL,
  `sub_c_id2` int(11) DEFAULT NULL,
  `value` int(11) DEFAULT NULL,
  `sub_q_id` int(11) DEFAULT NULL,
  KEY `user_id_fk2` (`u_id`),
  KEY `sub_criteria_id_fk` (`sub_c_id1`),
  KEY `sub_criteria_id_fk2` (`sub_c_id2`),
  KEY `f_sub_q_id` (`sub_q_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `sub_criteria`
--

DROP TABLE IF EXISTS `sub_criteria`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sub_criteria` (
  `sub_criteria_id` int(11) NOT NULL AUTO_INCREMENT,
  `c_id` int(11) DEFAULT NULL,
  `sub_cr_name` text,
  `r_id` int(11) DEFAULT NULL,
  `sub_cr_description` text NOT NULL,
  PRIMARY KEY (`sub_criteria_id`),
  KEY `fk_c_id` (`c_id`),
  KEY `rr_id_fk` (`r_id`)
) ENGINE=MyISAM AUTO_INCREMENT=227 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `sub_quest`
--

DROP TABLE IF EXISTS `sub_quest`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sub_quest` (
  `sub_quest_id` int(11) NOT NULL AUTO_INCREMENT,
  `sub_name` text,
  `now_date` datetime DEFAULT NULL,
  `r_id` int(11) DEFAULT NULL,
  `description` text,
  PRIMARY KEY (`sub_quest_id`),
  KEY `f_r_id` (`r_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `technology`
--

DROP TABLE IF EXISTS `technology`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `technology` (
  `t_id` int(11) NOT NULL AUTO_INCREMENT,
  `r_id` int(11) DEFAULT NULL,
  `t_name` text,
  `t_description` text,
  PRIMARY KEY (`t_id`),
  KEY `fk_r_iddddd` (`r_id`)
) ENGINE=MyISAM AUTO_INCREMENT=52 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `technology_answers`
--

DROP TABLE IF EXISTS `technology_answers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `technology_answers` (
  `r_id` int(11) NOT NULL DEFAULT '0',
  `q_id` int(11) NOT NULL DEFAULT '0',
  `u_id` int(11) NOT NULL DEFAULT '0',
  `t1_id` int(11) NOT NULL DEFAULT '0',
  `t2_id` int(11) NOT NULL DEFAULT '0',
  `f_id` int(11) NOT NULL DEFAULT '0',
  `value` float DEFAULT NULL,
  PRIMARY KEY (`r_id`,`q_id`,`u_id`,`t1_id`,`t2_id`,`f_id`),
  KEY `fk_qid_id` (`q_id`),
  KEY `fk_uid_id` (`u_id`),
  KEY `fk_t1id_id` (`t1_id`),
  KEY `fk_t2id_id` (`t2_id`),
  KEY `fk_fid_id` (`f_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `password` text COLLATE utf8_unicode_ci NOT NULL,
  `email` text COLLATE utf8_unicode_ci NOT NULL,
  `fname` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `lname` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `type` varchar(300) COLLATE utf8_unicode_ci NOT NULL,
  `validate` int(11) NOT NULL,
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=54 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `weights`
--

DROP TABLE IF EXISTS `weights`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `weights` (
  `q_id` int(11) NOT NULL DEFAULT '0',
  `r_id` int(11) NOT NULL DEFAULT '0',
  `u_id` int(11) NOT NULL DEFAULT '0',
  `c_id` int(11) NOT NULL DEFAULT '0',
  `weight` text,
  PRIMARY KEY (`q_id`,`r_id`,`u_id`,`c_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `weights_technology`
--

DROP TABLE IF EXISTS `weights_technology`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `weights_technology` (
  `q_id` int(11) NOT NULL DEFAULT '0',
  `r_id` int(11) NOT NULL DEFAULT '0',
  `u_id` int(11) NOT NULL DEFAULT '0',
  `f_id` int(11) NOT NULL DEFAULT '0',
  `weight` text,
  PRIMARY KEY (`q_id`,`r_id`,`u_id`,`f_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `years`
--

DROP TABLE IF EXISTS `years`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `years` (
  `q_id` int(11) NOT NULL DEFAULT '0',
  `year` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`q_id`,`year`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2020-06-29 20:41:55
