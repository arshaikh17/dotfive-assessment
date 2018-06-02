CREATE DATABASE  IF NOT EXISTS `dotfive` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `dotfive`;
-- MySQL dump 10.13  Distrib 5.7.17, for Win64 (x86_64)
--
-- Host: localhost    Database: dotfive
-- ------------------------------------------------------
-- Server version	5.0.67-community-nt

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
-- Not dumping tablespaces as no INFORMATION_SCHEMA.FILES table on this server
--

--
-- Table structure for table `categories`
--

DROP TABLE IF EXISTS `categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `categories` (
  `category_id` int(10) unsigned NOT NULL auto_increment,
  `category_name` varchar(255) collate utf8_unicode_ci NOT NULL default 'Default Category',
  `category_slug` varchar(255) collate utf8_unicode_ci NOT NULL default 'default-category',
  `category_parent_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL default NULL,
  `updated_at` timestamp NULL default NULL,
  PRIMARY KEY  (`category_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categories`
--

LOCK TABLES `categories` WRITE;
/*!40000 ALTER TABLE `categories` DISABLE KEYS */;
/*!40000 ALTER TABLE `categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `followers`
--

DROP TABLE IF EXISTS `followers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `followers` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `user_id` int(11) NOT NULL,
  `follows_id` int(11) NOT NULL,
  `created_at` timestamp NULL default NULL,
  `updated_at` timestamp NULL default NULL,
  PRIMARY KEY  (`id`),
  KEY `followers_user_id_index` (`user_id`),
  KEY `followers_follows_id_index` (`follows_id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `followers`
--

LOCK TABLES `followers` WRITE;
/*!40000 ALTER TABLE `followers` DISABLE KEYS */;
INSERT INTO `followers` VALUES (1,2,1,'2018-06-02 15:34:58','2018-06-02 15:34:58'),(2,1,2,'2018-06-02 20:22:14','2018-06-02 20:22:14');
/*!40000 ALTER TABLE `followers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `items`
--

DROP TABLE IF EXISTS `items`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `items` (
  `item_id` int(10) unsigned NOT NULL auto_increment,
  `item_name` varchar(255) collate utf8_unicode_ci NOT NULL default 'Default item',
  `item_slug` varchar(255) collate utf8_unicode_ci NOT NULL default 'default-item',
  `category_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL default NULL,
  `updated_at` timestamp NULL default NULL,
  PRIMARY KEY  (`item_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `items`
--

LOCK TABLES `items` WRITE;
/*!40000 ALTER TABLE `items` DISABLE KEYS */;
/*!40000 ALTER TABLE `items` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `migration` varchar(255) collate utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'2014_10_12_000000_create_users_table',1),(2,'2014_10_12_100000_create_password_resets_table',1),(3,'2017_04_25_211918_create_followers_table',1),(4,'2017_04_25_214632_create_notifications_table',1),(5,'2018_06_02_142024_create_categories_table',1),(6,'2018_06_02_142030_create_items_table',1),(8,'2018_06_02_144418_create_user_access_rights_table',2);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `notifications`
--

DROP TABLE IF EXISTS `notifications`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `notifications` (
  `id` char(36) collate utf8_unicode_ci NOT NULL,
  `type` varchar(255) collate utf8_unicode_ci NOT NULL,
  `notifiable_id` int(10) unsigned NOT NULL,
  `notifiable_type` varchar(255) collate utf8_unicode_ci NOT NULL,
  `data` text collate utf8_unicode_ci NOT NULL,
  `read_at` timestamp NULL default NULL,
  `created_at` timestamp NULL default NULL,
  `updated_at` timestamp NULL default NULL,
  PRIMARY KEY  (`id`),
  KEY `notifications_notifiable_id_notifiable_type_index` (`notifiable_id`,`notifiable_type`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `notifications`
--

LOCK TABLES `notifications` WRITE;
/*!40000 ALTER TABLE `notifications` DISABLE KEYS */;
/*!40000 ALTER TABLE `notifications` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `password_resets` (
  `email` varchar(255) collate utf8_unicode_ci NOT NULL,
  `token` varchar(255) collate utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL default NULL,
  KEY `password_resets_email_index` (`email`),
  KEY `password_resets_token_index` (`token`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_resets`
--

LOCK TABLES `password_resets` WRITE;
/*!40000 ALTER TABLE `password_resets` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_resets` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_access_rights`
--

DROP TABLE IF EXISTS `user_access_rights`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user_access_rights` (
  `uar_id` int(10) unsigned NOT NULL auto_increment,
  `user_id` int(11) NOT NULL,
  `access_key` varchar(255) collate utf8_unicode_ci NOT NULL,
  `access_value` tinyint(4) NOT NULL default '1',
  `created_at` timestamp NULL default NULL,
  `updated_at` timestamp NULL default NULL,
  PRIMARY KEY  (`uar_id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_access_rights`
--

LOCK TABLES `user_access_rights` WRITE;
/*!40000 ALTER TABLE `user_access_rights` DISABLE KEYS */;
INSERT INTO `user_access_rights` VALUES (1,3,'add',1,'2018-06-02 20:30:03','2018-06-02 20:30:03'),(2,3,'update',1,'2018-06-02 20:30:03','2018-06-02 20:30:03'),(3,1,'add',1,NULL,'2018-06-02 22:17:46'),(4,1,'update',1,NULL,'2018-06-02 22:18:40'),(5,2,'add',1,NULL,NULL),(6,2,'update',1,NULL,NULL),(7,3,'admin',1,NULL,NULL);
/*!40000 ALTER TABLE `user_access_rights` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `name` varchar(255) collate utf8_unicode_ci NOT NULL,
  `email` varchar(255) collate utf8_unicode_ci NOT NULL,
  `password` varchar(255) collate utf8_unicode_ci NOT NULL,
  `remember_token` varchar(100) collate utf8_unicode_ci default NULL,
  `created_at` timestamp NULL default NULL,
  `updated_at` timestamp NULL default NULL,
  PRIMARY KEY  (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'Mark Wahlberg','mark@hotmail.com','$2y$10$x6Z4JrJoejmwAkyL/m17VeS/Fg3lDvZzmYpUHPdCSUdmnmgR6YJ0e','3Ac4K1oz9Gr6UMuymSPZzWGyrZSvJWuLb2cNkDcCIxSpZTfEVmQyak2nF2j9','2018-06-02 14:26:23','2018-06-02 14:26:23'),(2,'Sandy Shores','sandy@hotmail.com','$2y$10$eVQ7Adey9IyxWqTs2.xvc.VA3x1LODenXd3CeCx9zxROtrOkq2y8e','BqSrHOGR5ObW9mzBey5HkCH7IOHgUvR4wg19SY7kVKUOehTUJ3QNALGvtu6Q','2018-06-02 15:34:48','2018-06-02 15:34:48'),(3,'DotFive','admin@dotfive.com','$2y$10$0cpm2rR7ilPD.Z/SN.14.umML7TOUo6XXN4.7J7r8Jjl55tzUuMJC',NULL,'2018-06-02 20:30:03','2018-06-02 20:30:03');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2018-06-03  0:23:31
