-- MySQL dump 10.13  Distrib 5.6.24, for Win64 (x86_64)
--
-- Host: localhost    Database: inventory_system
-- ------------------------------------------------------
-- Server version	5.5.47-0ubuntu0.14.04.1

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
-- Table structure for table `address`
--

DROP TABLE IF EXISTS `address`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `address` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `type_id` int(10) unsigned NOT NULL,
  `country_id` int(10) unsigned NOT NULL,
  `province_id` int(10) unsigned NOT NULL,
  `city_id` int(10) unsigned NOT NULL,
  `name_` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `line1` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `line2` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `postal_code` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_date` datetime NOT NULL,
  `modified_date` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_D4E6F81C54C8C93` (`type_id`),
  KEY `IDX_D4E6F81F92F3E70` (`country_id`),
  KEY `IDX_D4E6F81E946114A` (`province_id`),
  KEY `IDX_D4E6F818BAC62AF` (`city_id`),
  CONSTRAINT `FK_D4E6F818BAC62AF` FOREIGN KEY (`city_id`) REFERENCES `city` (`id`),
  CONSTRAINT `FK_D4E6F81C54C8C93` FOREIGN KEY (`type_id`) REFERENCES `address_type` (`id`),
  CONSTRAINT `FK_D4E6F81E946114A` FOREIGN KEY (`province_id`) REFERENCES `province` (`id`),
  CONSTRAINT `FK_D4E6F81F92F3E70` FOREIGN KEY (`country_id`) REFERENCES `country` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `address`
--

LOCK TABLES `address` WRITE;
/*!40000 ALTER TABLE `address` DISABLE KEYS */;
/*!40000 ALTER TABLE `address` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `address_type`
--

DROP TABLE IF EXISTS `address_type`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `address_type` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name_` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_date` datetime NOT NULL,
  `modified_date` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `slug_idx` (`slug`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `address_type`
--

LOCK TABLES `address_type` WRITE;
/*!40000 ALTER TABLE `address_type` DISABLE KEYS */;
INSERT INTO `address_type` VALUES (1,'Billing','billing','2016-02-24 14:29:45',NULL),(2,'Shipping','shipping','2016-02-24 14:29:45',NULL),(3,'Residential','residential','2016-02-24 14:29:45',NULL),(4,'Head Office','head-office','2016-02-24 14:29:45',NULL);
/*!40000 ALTER TABLE `address_type` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `city`
--

DROP TABLE IF EXISTS `city`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `city` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `province_id` int(10) unsigned NOT NULL,
  `name_` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `category` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_date` datetime NOT NULL,
  `modified_date` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_2D5B0234E946114A` (`province_id`),
  CONSTRAINT `FK_2D5B0234E946114A` FOREIGN KEY (`province_id`) REFERENCES `province` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `city`
--

LOCK TABLES `city` WRITE;
/*!40000 ALTER TABLE `city` DISABLE KEYS */;
/*!40000 ALTER TABLE `city` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `companies_addresses`
--

DROP TABLE IF EXISTS `companies_addresses`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `companies_addresses` (
  `company_id` int(10) unsigned NOT NULL,
  `address_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`company_id`,`address_id`),
  KEY `IDX_9E53F944979B1AD6` (`company_id`),
  KEY `IDX_9E53F944F5B7AF75` (`address_id`),
  CONSTRAINT `FK_9E53F944979B1AD6` FOREIGN KEY (`company_id`) REFERENCES `company` (`id`),
  CONSTRAINT `FK_9E53F944F5B7AF75` FOREIGN KEY (`address_id`) REFERENCES `address` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `companies_addresses`
--

LOCK TABLES `companies_addresses` WRITE;
/*!40000 ALTER TABLE `companies_addresses` DISABLE KEYS */;
/*!40000 ALTER TABLE `companies_addresses` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `companies_email_addresses`
--

DROP TABLE IF EXISTS `companies_email_addresses`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `companies_email_addresses` (
  `company_id` int(10) unsigned NOT NULL,
  `email_address_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`company_id`,`email_address_id`),
  KEY `IDX_21DFA99B979B1AD6` (`company_id`),
  KEY `IDX_21DFA99B59045DAA` (`email_address_id`),
  CONSTRAINT `FK_21DFA99B59045DAA` FOREIGN KEY (`email_address_id`) REFERENCES `email_address` (`id`),
  CONSTRAINT `FK_21DFA99B979B1AD6` FOREIGN KEY (`company_id`) REFERENCES `company` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `companies_email_addresses`
--

LOCK TABLES `companies_email_addresses` WRITE;
/*!40000 ALTER TABLE `companies_email_addresses` DISABLE KEYS */;
/*!40000 ALTER TABLE `companies_email_addresses` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `companies_numbers`
--

DROP TABLE IF EXISTS `companies_numbers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `companies_numbers` (
  `company_id` int(10) unsigned NOT NULL,
  `number_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`company_id`,`number_id`),
  KEY `IDX_ABEF4399979B1AD6` (`company_id`),
  KEY `IDX_ABEF439930A1DE10` (`number_id`),
  CONSTRAINT `FK_ABEF439930A1DE10` FOREIGN KEY (`number_id`) REFERENCES `phone_number` (`id`),
  CONSTRAINT `FK_ABEF4399979B1AD6` FOREIGN KEY (`company_id`) REFERENCES `company` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `companies_numbers`
--

LOCK TABLES `companies_numbers` WRITE;
/*!40000 ALTER TABLE `companies_numbers` DISABLE KEYS */;
/*!40000 ALTER TABLE `companies_numbers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `companies_types`
--

DROP TABLE IF EXISTS `companies_types`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `companies_types` (
  `company_id` int(10) unsigned NOT NULL,
  `type_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`company_id`,`type_id`),
  KEY `IDX_BAB9C6D4979B1AD6` (`company_id`),
  KEY `IDX_BAB9C6D4C54C8C93` (`type_id`),
  CONSTRAINT `FK_BAB9C6D4979B1AD6` FOREIGN KEY (`company_id`) REFERENCES `company` (`id`),
  CONSTRAINT `FK_BAB9C6D4C54C8C93` FOREIGN KEY (`type_id`) REFERENCES `company_type` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `companies_types`
--

LOCK TABLES `companies_types` WRITE;
/*!40000 ALTER TABLE `companies_types` DISABLE KEYS */;
/*!40000 ALTER TABLE `companies_types` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `company`
--

DROP TABLE IF EXISTS `company`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `company` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `status_id` int(10) unsigned NOT NULL,
  `number_id` int(10) unsigned DEFAULT NULL,
  `email_address_id` int(10) unsigned DEFAULT NULL,
  `address_id` int(10) unsigned DEFAULT NULL,
  `name_` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `registered_date` datetime NOT NULL,
  `created_date` datetime NOT NULL,
  `modified_date` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_4FBF094F6BF700BD` (`status_id`),
  KEY `IDX_4FBF094F30A1DE10` (`number_id`),
  KEY `IDX_4FBF094F59045DAA` (`email_address_id`),
  KEY `IDX_4FBF094FF5B7AF75` (`address_id`),
  CONSTRAINT `FK_4FBF094F30A1DE10` FOREIGN KEY (`number_id`) REFERENCES `phone_number` (`id`),
  CONSTRAINT `FK_4FBF094F59045DAA` FOREIGN KEY (`email_address_id`) REFERENCES `email_address` (`id`),
  CONSTRAINT `FK_4FBF094F6BF700BD` FOREIGN KEY (`status_id`) REFERENCES `company_status` (`id`),
  CONSTRAINT `FK_4FBF094FF5B7AF75` FOREIGN KEY (`address_id`) REFERENCES `address` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `company`
--

LOCK TABLES `company` WRITE;
/*!40000 ALTER TABLE `company` DISABLE KEYS */;
/*!40000 ALTER TABLE `company` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `company_relation`
--

DROP TABLE IF EXISTS `company_relation`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `company_relation` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `parent_id` int(10) unsigned NOT NULL,
  `child_id` int(10) unsigned NOT NULL,
  `company_relation_type_id` int(10) unsigned NOT NULL,
  `created_date` datetime NOT NULL,
  `modified_date` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_7A1E5224727ACA70` (`parent_id`),
  KEY `IDX_7A1E5224DD62C21B` (`child_id`),
  KEY `IDX_7A1E5224F2CC6259` (`company_relation_type_id`),
  CONSTRAINT `FK_7A1E5224727ACA70` FOREIGN KEY (`parent_id`) REFERENCES `company` (`id`),
  CONSTRAINT `FK_7A1E5224DD62C21B` FOREIGN KEY (`child_id`) REFERENCES `company` (`id`),
  CONSTRAINT `FK_7A1E5224F2CC6259` FOREIGN KEY (`company_relation_type_id`) REFERENCES `company_relation_type` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `company_relation`
--

LOCK TABLES `company_relation` WRITE;
/*!40000 ALTER TABLE `company_relation` DISABLE KEYS */;
/*!40000 ALTER TABLE `company_relation` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `company_relation_type`
--

DROP TABLE IF EXISTS `company_relation_type`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `company_relation_type` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `created_date` datetime NOT NULL,
  `modified_date` datetime DEFAULT NULL,
  `name_` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `slug_idx` (`slug`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `company_relation_type`
--

LOCK TABLES `company_relation_type` WRITE;
/*!40000 ALTER TABLE `company_relation_type` DISABLE KEYS */;
INSERT INTO `company_relation_type` VALUES (1,'2016-04-16 14:06:47',NULL,'Subsidiary','subsidiary'),(2,'2016-04-16 14:06:47',NULL,'Representative','rep');
/*!40000 ALTER TABLE `company_relation_type` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `company_rep`
--

DROP TABLE IF EXISTS `company_rep`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `company_rep` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `company_id` int(10) unsigned NOT NULL,
  `user_id` int(10) unsigned DEFAULT NULL,
  `client_company_id` int(10) unsigned NOT NULL,
  `client_user_id` int(10) unsigned DEFAULT NULL,
  `created_date` datetime NOT NULL,
  `modified_date` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_E4480F9A979B1AD6` (`company_id`),
  KEY `IDX_E4480F9AA76ED395` (`user_id`),
  KEY `IDX_E4480F9A7CF2797` (`client_company_id`),
  KEY `IDX_E4480F9AF55397E8` (`client_user_id`),
  CONSTRAINT `FK_E4480F9AF55397E8` FOREIGN KEY (`client_user_id`) REFERENCES `fos_user` (`id`),
  CONSTRAINT `FK_E4480F9A7CF2797` FOREIGN KEY (`client_company_id`) REFERENCES `company` (`id`),
  CONSTRAINT `FK_E4480F9A979B1AD6` FOREIGN KEY (`company_id`) REFERENCES `company` (`id`),
  CONSTRAINT `FK_E4480F9AA76ED395` FOREIGN KEY (`user_id`) REFERENCES `fos_user` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `company_rep`
--

LOCK TABLES `company_rep` WRITE;
/*!40000 ALTER TABLE `company_rep` DISABLE KEYS */;
/*!40000 ALTER TABLE `company_rep` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `company_status`
--

DROP TABLE IF EXISTS `company_status`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `company_status` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `created_date` datetime NOT NULL,
  `modified_date` datetime DEFAULT NULL,
  `name_` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `slug_idx` (`slug`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `company_status`
--

LOCK TABLES `company_status` WRITE;
/*!40000 ALTER TABLE `company_status` DISABLE KEYS */;
/*!40000 ALTER TABLE `company_status` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `company_tree`
--

DROP TABLE IF EXISTS `company_tree`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `company_tree` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `root_company_id` int(10) unsigned NOT NULL,
  `parent_company_id` int(10) unsigned NOT NULL,
  `child_company_id` int(10) unsigned NOT NULL,
  `name_` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `level` int(10) unsigned NOT NULL DEFAULT '1',
  `created_date` datetime NOT NULL,
  `modified_date` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_F453443232D8BDA7` (`root_company_id`),
  KEY `IDX_F4534432D0D89E86` (`parent_company_id`),
  KEY `IDX_F45344327344E4BD` (`child_company_id`),
  CONSTRAINT `FK_F45344327344E4BD` FOREIGN KEY (`child_company_id`) REFERENCES `company` (`id`),
  CONSTRAINT `FK_F453443232D8BDA7` FOREIGN KEY (`root_company_id`) REFERENCES `company` (`id`),
  CONSTRAINT `FK_F4534432D0D89E86` FOREIGN KEY (`parent_company_id`) REFERENCES `company` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `company_tree`
--

LOCK TABLES `company_tree` WRITE;
/*!40000 ALTER TABLE `company_tree` DISABLE KEYS */;
/*!40000 ALTER TABLE `company_tree` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `company_type`
--

DROP TABLE IF EXISTS `company_type`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `company_type` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `created_date` datetime NOT NULL,
  `modified_date` datetime DEFAULT NULL,
  `name_` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `slug_idx` (`slug`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `company_type`
--

LOCK TABLES `company_type` WRITE;
/*!40000 ALTER TABLE `company_type` DISABLE KEYS */;
INSERT INTO `company_type` VALUES (1,'2016-02-24 14:29:45',NULL,'Manufacturer','manufacturer'),(2,'2016-02-24 14:29:45',NULL,'Wholesaler','wholesaler'),(3,'2016-02-24 14:29:45',NULL,'Rep Agency','rep-agency'),(4,'2016-02-24 14:29:45',NULL,'Architectural','architect'),(5,'2016-02-24 14:29:45',NULL,'Engineering','engineer');
/*!40000 ALTER TABLE `company_type` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `country`
--

DROP TABLE IF EXISTS `country`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `country` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name_` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alpha2Code` varchar(5) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alpha3Code` varchar(5) COLLATE utf8mb4_unicode_ci NOT NULL,
  `numericCode` smallint(5) unsigned NOT NULL,
  `created_date` datetime NOT NULL,
  `modified_date` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `country`
--

LOCK TABLES `country` WRITE;
/*!40000 ALTER TABLE `country` DISABLE KEYS */;
/*!40000 ALTER TABLE `country` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `email_address`
--

DROP TABLE IF EXISTS `email_address`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `email_address` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name_` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_date` datetime NOT NULL,
  `modified_date` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `email_address`
--

LOCK TABLES `email_address` WRITE;
/*!40000 ALTER TABLE `email_address` DISABLE KEYS */;
/*!40000 ALTER TABLE `email_address` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `fos_user`
--

DROP TABLE IF EXISTS `fos_user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `fos_user` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `number_id` int(10) unsigned DEFAULT NULL,
  `address_id` int(10) unsigned DEFAULT NULL,
  `locale_id` int(10) unsigned DEFAULT NULL,
  `timezone_id` int(10) unsigned DEFAULT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username_canonical` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_canonical` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `enabled` tinyint(1) NOT NULL,
  `salt` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_login` datetime DEFAULT NULL,
  `locked` tinyint(1) NOT NULL,
  `expired` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL,
  `confirmation_token` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password_requested_at` datetime DEFAULT NULL,
  `roles` longtext COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '(DC2Type:array)',
  `credentials_expired` tinyint(1) NOT NULL,
  `credentials_expire_at` datetime DEFAULT NULL,
  `salutation` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `first_name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `registered_date` datetime DEFAULT NULL,
  `iso_locale` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `iso_timezone` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_date` datetime NOT NULL,
  `modified_date` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_957A647992FC23A8` (`username_canonical`(20)),
  UNIQUE KEY `UNIQ_957A6479A0D96FBF` (`email_canonical`(100)),
  KEY `IDX_957A647930A1DE10` (`number_id`),
  KEY `IDX_957A6479F5B7AF75` (`address_id`),
  KEY `IDX_957A6479E559DFD1` (`locale_id`),
  KEY `IDX_957A64793FE997DE` (`timezone_id`),
  CONSTRAINT `FK_957A647930A1DE10` FOREIGN KEY (`number_id`) REFERENCES `phone_number` (`id`),
  CONSTRAINT `FK_957A64793FE997DE` FOREIGN KEY (`timezone_id`) REFERENCES `timezone` (`id`),
  CONSTRAINT `FK_957A6479E559DFD1` FOREIGN KEY (`locale_id`) REFERENCES `locale` (`id`),
  CONSTRAINT `FK_957A6479F5B7AF75` FOREIGN KEY (`address_id`) REFERENCES `address` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `fos_user`
--

LOCK TABLES `fos_user` WRITE;
/*!40000 ALTER TABLE `fos_user` DISABLE KEYS */;
INSERT INTO `fos_user` VALUES (1,NULL,NULL,NULL,NULL,'rahi','rahi','rahi.parsi@gmail.com','rahi.parsi@gmail.com',1,'rav7ufhwef40k0cc8ggwsok008csw4c','$2y$12$6xIiJGkeDnaanVLVfPE5I.fl4j0TNHGrDzGrLbPMzDKoEsPMG7wYu','2016-04-24 17:38:27',0,0,NULL,NULL,NULL,'a:1:{i:0;s:9:\"ROLE_USER\";}',0,NULL,'Mr.','Rahi','Parsi','2016-04-03 21:24:18','en_CA','America/Toronto','2016-04-03 21:24:18',NULL);
/*!40000 ALTER TABLE `fos_user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `language_`
--

DROP TABLE IF EXISTS `language_`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `language_` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name_` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `iso_code` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_date` datetime NOT NULL,
  `modified_date` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `language_`
--

LOCK TABLES `language_` WRITE;
/*!40000 ALTER TABLE `language_` DISABLE KEYS */;
/*!40000 ALTER TABLE `language_` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `locale`
--

DROP TABLE IF EXISTS `locale`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `locale` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `language_id` int(10) unsigned NOT NULL,
  `country_id` int(10) unsigned NOT NULL,
  `name_` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `iso_code` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_date` datetime NOT NULL,
  `modified_date` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `unique_locale_idx` (`language_id`,`country_id`),
  KEY `IDX_4180C69882F1BAF4` (`language_id`),
  KEY `IDX_4180C698F92F3E70` (`country_id`),
  CONSTRAINT `FK_4180C69882F1BAF4` FOREIGN KEY (`language_id`) REFERENCES `language_` (`id`),
  CONSTRAINT `FK_4180C698F92F3E70` FOREIGN KEY (`country_id`) REFERENCES `country` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `locale`
--

LOCK TABLES `locale` WRITE;
/*!40000 ALTER TABLE `locale` DISABLE KEYS */;
/*!40000 ALTER TABLE `locale` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `phone_number`
--

DROP TABLE IF EXISTS `phone_number`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `phone_number` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `type_id` int(10) unsigned DEFAULT NULL,
  `name_` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `country_code` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `area_code` int(10) unsigned NOT NULL,
  `number_` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `extension` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_date` datetime NOT NULL,
  `modified_date` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_6B01BC5BC54C8C93` (`type_id`),
  CONSTRAINT `FK_6B01BC5BC54C8C93` FOREIGN KEY (`type_id`) REFERENCES `phone_number_type` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `phone_number`
--

LOCK TABLES `phone_number` WRITE;
/*!40000 ALTER TABLE `phone_number` DISABLE KEYS */;
/*!40000 ALTER TABLE `phone_number` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `phone_number_type`
--

DROP TABLE IF EXISTS `phone_number_type`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `phone_number_type` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name_` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_date` datetime NOT NULL,
  `modified_date` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `slug_idx` (`slug`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `phone_number_type`
--

LOCK TABLES `phone_number_type` WRITE;
/*!40000 ALTER TABLE `phone_number_type` DISABLE KEYS */;
INSERT INTO `phone_number_type` VALUES (1,'Fax','fax','2016-02-24 14:29:45',NULL),(2,'Office','office','2016-02-24 14:29:45',NULL),(3,'Mobile','cell','2016-02-24 14:29:45',NULL);
/*!40000 ALTER TABLE `phone_number_type` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `province`
--

DROP TABLE IF EXISTS `province`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `province` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `country_id` int(10) unsigned NOT NULL,
  `name_` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `iso_code` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `category` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_date` datetime NOT NULL,
  `modified_date` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_4ADAD40BF92F3E70` (`country_id`),
  CONSTRAINT `FK_4ADAD40BF92F3E70` FOREIGN KEY (`country_id`) REFERENCES `country` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `province`
--

LOCK TABLES `province` WRITE;
/*!40000 ALTER TABLE `province` DISABLE KEYS */;
/*!40000 ALTER TABLE `province` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `region`
--

DROP TABLE IF EXISTS `region`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `region` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name_` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_date` datetime NOT NULL,
  `modified_date` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `region`
--

LOCK TABLES `region` WRITE;
/*!40000 ALTER TABLE `region` DISABLE KEYS */;
/*!40000 ALTER TABLE `region` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `region_item`
--

DROP TABLE IF EXISTS `region_item`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `region_item` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `parent_region_id` int(10) unsigned NOT NULL,
  `type_id` int(10) unsigned NOT NULL,
  `country_id` int(10) unsigned DEFAULT NULL,
  `province_id` int(10) unsigned DEFAULT NULL,
  `city_id` int(10) unsigned DEFAULT NULL,
  `region_id` int(10) unsigned DEFAULT NULL,
  `name_` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `inheritsChildren` tinyint(1) NOT NULL DEFAULT '1',
  `created_date` datetime NOT NULL,
  `modified_date` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_C6BD3229696D2EBB` (`parent_region_id`),
  KEY `IDX_C6BD3229C54C8C93` (`type_id`),
  KEY `IDX_C6BD3229F92F3E70` (`country_id`),
  KEY `IDX_C6BD3229E946114A` (`province_id`),
  KEY `IDX_C6BD32298BAC62AF` (`city_id`),
  KEY `IDX_C6BD322998260155` (`region_id`),
  CONSTRAINT `FK_C6BD3229696D2EBB` FOREIGN KEY (`parent_region_id`) REFERENCES `region` (`id`),
  CONSTRAINT `FK_C6BD32298BAC62AF` FOREIGN KEY (`city_id`) REFERENCES `city` (`id`),
  CONSTRAINT `FK_C6BD322998260155` FOREIGN KEY (`region_id`) REFERENCES `region` (`id`),
  CONSTRAINT `FK_C6BD3229C54C8C93` FOREIGN KEY (`type_id`) REFERENCES `region_item_type` (`id`),
  CONSTRAINT `FK_C6BD3229E946114A` FOREIGN KEY (`province_id`) REFERENCES `province` (`id`),
  CONSTRAINT `FK_C6BD3229F92F3E70` FOREIGN KEY (`country_id`) REFERENCES `country` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `region_item`
--

LOCK TABLES `region_item` WRITE;
/*!40000 ALTER TABLE `region_item` DISABLE KEYS */;
/*!40000 ALTER TABLE `region_item` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `region_item_type`
--

DROP TABLE IF EXISTS `region_item_type`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `region_item_type` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name_` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_date` datetime NOT NULL,
  `modified_date` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `slug_idx` (`slug`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `region_item_type`
--

LOCK TABLES `region_item_type` WRITE;
/*!40000 ALTER TABLE `region_item_type` DISABLE KEYS */;
INSERT INTO `region_item_type` VALUES (1,'Country','country','2016-02-24 14:29:45',NULL),(2,'Province','province','2016-02-24 14:29:45',NULL),(3,'City','city','2016-02-24 14:29:45',NULL),(4,'Region','region','2016-02-24 14:29:45',NULL);
/*!40000 ALTER TABLE `region_item_type` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `timezone`
--

DROP TABLE IF EXISTS `timezone`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `timezone` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name_` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `utc_hours_offset` int(11) NOT NULL,
  `php_timezone` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `location` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_date` datetime NOT NULL,
  `modified_date` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `timezone`
--

LOCK TABLES `timezone` WRITE;
/*!40000 ALTER TABLE `timezone` DISABLE KEYS */;
/*!40000 ALTER TABLE `timezone` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users_addresses`
--

DROP TABLE IF EXISTS `users_addresses`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users_addresses` (
  `user_id` int(10) unsigned NOT NULL,
  `address_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`user_id`,`address_id`),
  KEY `IDX_9B70FF7A76ED395` (`user_id`),
  KEY `IDX_9B70FF7F5B7AF75` (`address_id`),
  CONSTRAINT `FK_9B70FF7A76ED395` FOREIGN KEY (`user_id`) REFERENCES `fos_user` (`id`),
  CONSTRAINT `FK_9B70FF7F5B7AF75` FOREIGN KEY (`address_id`) REFERENCES `address` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users_addresses`
--

LOCK TABLES `users_addresses` WRITE;
/*!40000 ALTER TABLE `users_addresses` DISABLE KEYS */;
/*!40000 ALTER TABLE `users_addresses` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users_companies`
--

DROP TABLE IF EXISTS `users_companies`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users_companies` (
  `user_id` int(10) unsigned NOT NULL,
  `company_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`user_id`,`company_id`),
  KEY `IDX_E439D0DBA76ED395` (`user_id`),
  KEY `IDX_E439D0DB979B1AD6` (`company_id`),
  CONSTRAINT `FK_E439D0DB979B1AD6` FOREIGN KEY (`company_id`) REFERENCES `company` (`id`) ON DELETE CASCADE,
  CONSTRAINT `FK_E439D0DBA76ED395` FOREIGN KEY (`user_id`) REFERENCES `fos_user` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users_companies`
--

LOCK TABLES `users_companies` WRITE;
/*!40000 ALTER TABLE `users_companies` DISABLE KEYS */;
/*!40000 ALTER TABLE `users_companies` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users_email_addresses`
--

DROP TABLE IF EXISTS `users_email_addresses`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users_email_addresses` (
  `user_id` int(10) unsigned NOT NULL,
  `email_address_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`user_id`,`email_address_id`),
  KEY `IDX_DBB415A7A76ED395` (`user_id`),
  KEY `IDX_DBB415A759045DAA` (`email_address_id`),
  CONSTRAINT `FK_DBB415A759045DAA` FOREIGN KEY (`email_address_id`) REFERENCES `email_address` (`id`),
  CONSTRAINT `FK_DBB415A7A76ED395` FOREIGN KEY (`user_id`) REFERENCES `fos_user` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users_email_addresses`
--

LOCK TABLES `users_email_addresses` WRITE;
/*!40000 ALTER TABLE `users_email_addresses` DISABLE KEYS */;
/*!40000 ALTER TABLE `users_email_addresses` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users_numbers`
--

DROP TABLE IF EXISTS `users_numbers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users_numbers` (
  `user_id` int(10) unsigned NOT NULL,
  `number_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`user_id`,`number_id`),
  KEY `IDX_879EBE33A76ED395` (`user_id`),
  KEY `IDX_879EBE3330A1DE10` (`number_id`),
  CONSTRAINT `FK_879EBE3330A1DE10` FOREIGN KEY (`number_id`) REFERENCES `phone_number` (`id`),
  CONSTRAINT `FK_879EBE33A76ED395` FOREIGN KEY (`user_id`) REFERENCES `fos_user` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users_numbers`
--

LOCK TABLES `users_numbers` WRITE;
/*!40000 ALTER TABLE `users_numbers` DISABLE KEYS */;
/*!40000 ALTER TABLE `users_numbers` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2016-04-24 17:47:56
