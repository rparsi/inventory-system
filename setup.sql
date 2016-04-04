/*
SQLyog Ultimate v12.01 (64 bit)
MySQL - 5.6.29 : Database - inventory_system
*********************************************************************
*/


/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`inventory_system` /*!40100 DEFAULT CHARACTER SET utf8mb4 */;

USE `inventory_system`;

/*Table structure for table `address` */

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

/*Data for the table `address` */

/*Table structure for table `address_type` */

CREATE TABLE `address_type` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name_` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_date` datetime NOT NULL,
  `modified_date` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `slug_idx` (`slug`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `address_type` */

insert  into `address_type`(`id`,`name_`,`slug`,`created_date`,`modified_date`) values (1,'Billing','billing','2016-02-24 14:29:45',NULL),(2,'Shipping','shipping','2016-02-24 14:29:45',NULL),(3,'Residential','residential','2016-02-24 14:29:45',NULL),(4,'Head Office','head-office','2016-02-24 14:29:45',NULL);

/*Table structure for table `city` */

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

/*Data for the table `city` */

/*Table structure for table `companies_addresses` */

CREATE TABLE `companies_addresses` (
  `company_id` int(10) unsigned NOT NULL,
  `address_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`company_id`,`address_id`),
  KEY `IDX_9E53F944979B1AD6` (`company_id`),
  KEY `IDX_9E53F944F5B7AF75` (`address_id`),
  CONSTRAINT `FK_9E53F944979B1AD6` FOREIGN KEY (`company_id`) REFERENCES `company` (`id`),
  CONSTRAINT `FK_9E53F944F5B7AF75` FOREIGN KEY (`address_id`) REFERENCES `address` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `companies_addresses` */

/*Table structure for table `companies_email_addresses` */

CREATE TABLE `companies_email_addresses` (
  `company_id` int(10) unsigned NOT NULL,
  `email_address_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`company_id`,`email_address_id`),
  KEY `IDX_21DFA99B979B1AD6` (`company_id`),
  KEY `IDX_21DFA99B59045DAA` (`email_address_id`),
  CONSTRAINT `FK_21DFA99B59045DAA` FOREIGN KEY (`email_address_id`) REFERENCES `email_address` (`id`),
  CONSTRAINT `FK_21DFA99B979B1AD6` FOREIGN KEY (`company_id`) REFERENCES `company` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `companies_email_addresses` */

/*Table structure for table `companies_numbers` */

CREATE TABLE `companies_numbers` (
  `company_id` int(10) unsigned NOT NULL,
  `number_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`company_id`,`number_id`),
  KEY `IDX_ABEF4399979B1AD6` (`company_id`),
  KEY `IDX_ABEF439930A1DE10` (`number_id`),
  CONSTRAINT `FK_ABEF439930A1DE10` FOREIGN KEY (`number_id`) REFERENCES `phone_number` (`id`),
  CONSTRAINT `FK_ABEF4399979B1AD6` FOREIGN KEY (`company_id`) REFERENCES `company` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `companies_numbers` */

/*Table structure for table `companies_types` */

CREATE TABLE `companies_types` (
  `company_id` int(10) unsigned NOT NULL,
  `type_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`company_id`,`type_id`),
  KEY `IDX_BAB9C6D4979B1AD6` (`company_id`),
  KEY `IDX_BAB9C6D4C54C8C93` (`type_id`),
  CONSTRAINT `FK_BAB9C6D4979B1AD6` FOREIGN KEY (`company_id`) REFERENCES `company` (`id`),
  CONSTRAINT `FK_BAB9C6D4C54C8C93` FOREIGN KEY (`type_id`) REFERENCES `company_type` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `companies_types` */

/*Table structure for table `company` */

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

/*Data for the table `company` */

/*Table structure for table `company_relation` */

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

/*Data for the table `company_relation` */

/*Table structure for table `company_relation_type` */

CREATE TABLE `company_relation_type` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `created_date` datetime NOT NULL,
  `modified_date` datetime DEFAULT NULL,
  `name_` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `slug_idx` (`slug`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `company_relation_type` */

/*Table structure for table `company_status` */

CREATE TABLE `company_status` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `created_date` datetime NOT NULL,
  `modified_date` datetime DEFAULT NULL,
  `name_` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `slug_idx` (`slug`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `company_status` */

/*Table structure for table `company_type` */

CREATE TABLE `company_type` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `created_date` datetime NOT NULL,
  `modified_date` datetime DEFAULT NULL,
  `name_` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `slug_idx` (`slug`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `company_type` */

insert  into `company_type`(`id`,`created_date`,`modified_date`,`name_`,`slug`) values (1,'2016-02-24 14:29:45',NULL,'Manufacturer','manufacturer'),(2,'2016-02-24 14:29:45',NULL,'Wholesaler','wholesaler'),(3,'2016-02-24 14:29:45',NULL,'Rep Agency','rep-agency'),(4,'2016-02-24 14:29:45',NULL,'Architectural','architect'),(5,'2016-02-24 14:29:45',NULL,'Engineering','engineer');

/*Table structure for table `country` */

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

/*Data for the table `country` */

/*Table structure for table `email_address` */

CREATE TABLE `email_address` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name_` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_date` datetime NOT NULL,
  `modified_date` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `email_address` */

/*Table structure for table `fos_user` */

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `fos_user` */

/*Table structure for table `language_` */

CREATE TABLE `language_` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name_` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `iso_code` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_date` datetime NOT NULL,
  `modified_date` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `language_` */

/*Table structure for table `locale` */

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

/*Data for the table `locale` */

/*Table structure for table `phone_number` */

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

/*Data for the table `phone_number` */

/*Table structure for table `phone_number_type` */

CREATE TABLE `phone_number_type` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name_` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_date` datetime NOT NULL,
  `modified_date` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `slug_idx` (`slug`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `phone_number_type` */

insert  into `phone_number_type`(`id`,`name_`,`slug`,`created_date`,`modified_date`) values (1,'Fax','fax','2016-02-24 14:29:45',NULL),(2,'Office','office','2016-02-24 14:29:45',NULL),(3,'Mobile','cell','2016-02-24 14:29:45',NULL);

/*Table structure for table `province` */

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

/*Data for the table `province` */

/*Table structure for table `region` */

CREATE TABLE `region` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name_` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_date` datetime NOT NULL,
  `modified_date` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `region` */

/*Table structure for table `region_item` */

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

/*Data for the table `region_item` */

/*Table structure for table `region_item_type` */

CREATE TABLE `region_item_type` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name_` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_date` datetime NOT NULL,
  `modified_date` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `slug_idx` (`slug`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `region_item_type` */

insert  into `region_item_type`(`id`,`name_`,`slug`,`created_date`,`modified_date`) values (1,'Country','country','2016-02-24 14:29:45',NULL),(2,'Province','province','2016-02-24 14:29:45',NULL),(3,'City','city','2016-02-24 14:29:45',NULL),(4,'Region','region','2016-02-24 14:29:45',NULL);

/*Table structure for table `timezone` */

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

/*Data for the table `timezone` */

/*Table structure for table `users_addresses` */

CREATE TABLE `users_addresses` (
  `user_id` int(10) unsigned NOT NULL,
  `address_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`user_id`,`address_id`),
  KEY `IDX_9B70FF7A76ED395` (`user_id`),
  KEY `IDX_9B70FF7F5B7AF75` (`address_id`),
  CONSTRAINT `FK_9B70FF7A76ED395` FOREIGN KEY (`user_id`) REFERENCES `fos_user` (`id`),
  CONSTRAINT `FK_9B70FF7F5B7AF75` FOREIGN KEY (`address_id`) REFERENCES `address` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `users_addresses` */

/*Table structure for table `users_companies` */

CREATE TABLE `users_companies` (
  `user_id` int(10) unsigned NOT NULL,
  `company_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`user_id`,`company_id`),
  KEY `IDX_E439D0DBA76ED395` (`user_id`),
  KEY `IDX_E439D0DB979B1AD6` (`company_id`),
  CONSTRAINT `FK_E439D0DB979B1AD6` FOREIGN KEY (`company_id`) REFERENCES `company` (`id`) ON DELETE CASCADE,
  CONSTRAINT `FK_E439D0DBA76ED395` FOREIGN KEY (`user_id`) REFERENCES `fos_user` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `users_companies` */

/*Table structure for table `users_email_addresses` */

CREATE TABLE `users_email_addresses` (
  `user_id` int(10) unsigned NOT NULL,
  `email_address_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`user_id`,`email_address_id`),
  KEY `IDX_DBB415A7A76ED395` (`user_id`),
  KEY `IDX_DBB415A759045DAA` (`email_address_id`),
  CONSTRAINT `FK_DBB415A759045DAA` FOREIGN KEY (`email_address_id`) REFERENCES `email_address` (`id`),
  CONSTRAINT `FK_DBB415A7A76ED395` FOREIGN KEY (`user_id`) REFERENCES `fos_user` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `users_email_addresses` */

/*Table structure for table `users_numbers` */

CREATE TABLE `users_numbers` (
  `user_id` int(10) unsigned NOT NULL,
  `number_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`user_id`,`number_id`),
  KEY `IDX_879EBE33A76ED395` (`user_id`),
  KEY `IDX_879EBE3330A1DE10` (`number_id`),
  CONSTRAINT `FK_879EBE3330A1DE10` FOREIGN KEY (`number_id`) REFERENCES `phone_number` (`id`),
  CONSTRAINT `FK_879EBE33A76ED395` FOREIGN KEY (`user_id`) REFERENCES `fos_user` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `users_numbers` */

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;