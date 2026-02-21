-- MariaDB dump 10.19  Distrib 10.5.19-MariaDB, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: realtyinterface_app
-- ------------------------------------------------------
-- Server version	10.5.19-MariaDB-0+deb11u2

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `admins`
--

DROP TABLE IF EXISTS `admins`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `admins` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `admins`
--

LOCK TABLES `admins` WRITE;
/*!40000 ALTER TABLE `admins` DISABLE KEYS */;
INSERT INTO `admins` VALUES (1,'shiv','$2y$10$whJZhjX4obgNpX6JWM6N8O2FdZWEZp97orN8nZBTr0ArV7Vt2X6Mu','2022-09-27 12:08:46','2022-09-27 12:08:46'),(2,'admin@odysseydesign.us','$2y$10$P/xcP7vHJBsOhPyOFW4ayOBIy59tN1Fm1N6RkByiMBFKbcuDplqaW',NULL,NULL);
/*!40000 ALTER TABLE `admins` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `agent_addresses`
--

DROP TABLE IF EXISTS `agent_addresses`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `agent_addresses` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `agent_id` bigint(20) unsigned NOT NULL,
  `business_name` varchar(100) DEFAULT NULL,
  `phone` varchar(50) NOT NULL,
  `address` text NOT NULL,
  `city` varchar(100) NOT NULL,
  `state_id` int(11) NOT NULL,
  `country_id` int(11) NOT NULL,
  `zip` varchar(10) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `agent_addresses_agent_id_foreign` (`agent_id`),
  CONSTRAINT `agent_addresses_agent_id_foreign` FOREIGN KEY (`agent_id`) REFERENCES `agents` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `agent_addresses`
--

LOCK TABLES `agent_addresses` WRITE;
/*!40000 ALTER TABLE `agent_addresses` DISABLE KEYS */;
INSERT INTO `agent_addresses` VALUES (1,1,'Nirvaat Internet Private Limited','9910212345','Thjis is test address','Scranton',8,230,'23564','2022-12-15 14:02:23','2022-12-15 14:02:23'),(2,2,'REMAX LUXURY PROPERTIES','5305543312','10210 123rd Street Ct E Ste D\r\nPuyallup, WA 98374-2634','Puyallup',68,230,'98374','2022-12-18 16:54:56','2022-12-18 16:54:56'),(3,3,'REMAX Luxury Collection','5307954398','13709 107th Avenue Ct E','Puyallup',68,230,'98374','2023-06-23 14:44:47','2023-06-23 14:44:47'),(4,10,'hello','7076249692','1490 Mountainwood Drive','WEED',0,230,'96094','2023-08-29 02:26:08','2023-08-29 02:26:08'),(5,11,'Odyssey Design','5554446666','456 Marbella Drive','Vacaville',0,230,'95688','2023-08-29 02:39:07','2023-08-29 02:39:07');
/*!40000 ALTER TABLE `agent_addresses` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `agent_subscriptions`
--

DROP TABLE IF EXISTS `agent_subscriptions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `agent_subscriptions` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `agent_id` int(11) NOT NULL,
  `plan_id` bigint(20) unsigned NOT NULL,
  `payment_id` varchar(255) DEFAULT NULL,
  `start_date` date DEFAULT NULL,
  `expiry_date` date DEFAULT NULL,
  `property_count` varchar(50) NOT NULL,
  `duration` varchar(10) NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `agent_subscriptions`
--

LOCK TABLES `agent_subscriptions` WRITE;
/*!40000 ALTER TABLE `agent_subscriptions` DISABLE KEYS */;
/*!40000 ALTER TABLE `agent_subscriptions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `agents`
--

DROP TABLE IF EXISTS `agents`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `agents` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `first_name` varchar(100) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(75) NOT NULL,
  `credit_balance` int(11) NOT NULL DEFAULT 0,
  `verification_code` varchar(255) NOT NULL DEFAULT '0',
  `active` tinyint(1) NOT NULL DEFAULT 1,
  `deleted` tinyint(1) NOT NULL DEFAULT 0,
  `profile_image` varchar(100) DEFAULT NULL,
  `facebook_profile` varchar(255) DEFAULT NULL,
  `instagram_profile` varchar(255) DEFAULT NULL,
  `twitter_profile` varchar(255) DEFAULT NULL,
  `linkedin_profile` varchar(255) DEFAULT NULL,
  `logo_image` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `agents`
--

LOCK TABLES `agents` WRITE;
/*!40000 ALTER TABLE `agents` DISABLE KEYS */;
INSERT INTO `agents` VALUES (1,'Rajendra','Tiwari','raj@nirvaat.com','$2y$10$aE9yx/7m8/Lb0/9JmeKkoOWF2FfLzzxOOyGqYe5ihCgBzJ/8phRoG',11,'0',1,0,NULL,NULL,NULL,NULL,NULL,NULL,'2022-12-15 14:01:45','2022-12-23 10:59:50'),(2,'Alexander','Shelton','ra@odysseydesign.us','$2y$10$P/xcP7vHJBsOhPyOFW4ayOBIy59tN1Fm1N6RkByiMBFKbcuDplqaW',-4,'789027',1,0,'https://realtyinterface.s3.amazonaws.com/agents/LDNfhPiNQW67CkHQ9eZUyy3Z78JN2tXIWas0vTrE.jpg',NULL,NULL,NULL,NULL,'https://realtyinterface.s3.amazonaws.com/agents/6vNQLlUA2HeTazOIaXbDaYue1jG1uIYot3EWePfy.jpg','2022-12-18 16:51:56','2023-08-23 18:39:38'),(3,'Alexander','Shelton','alex@remaxluxurycollection.com','$2y$10$krDfn1IkBUYUfxvEBnbRTue5sNqPnVZ4eeRkIDzvnhIPbTBfHYQfa',-1,'0',1,0,NULL,NULL,NULL,NULL,NULL,NULL,'2023-06-23 14:42:52','2023-08-23 18:11:49'),(4,'Stacy','Smith','ra@avilahomesllc.com','$2y$10$s/lQTiTkEQSu2m6YdBfrxel4cyvuI0mN5AnGSuolKl0Hv0rraLHR6',0,'0',1,0,NULL,NULL,NULL,NULL,NULL,NULL,'2023-08-22 19:20:06','2023-08-22 19:20:06'),(5,'Shamim','Hasan','shamimhasan008@gmail.com','$2y$10$EhuxtJDm5QsqfqTsWXnSH.C9f81a97CgiFVkr3RXw6nwy67C.zJyS',0,'512516',1,0,NULL,NULL,NULL,NULL,NULL,NULL,'2023-08-29 00:09:36','2023-08-29 00:11:47'),(6,'Rosanne','Avila','sales@realtyinterface.com','$2y$10$vbXNNdfMfctb6a9IskL5TOGWQyCxnlxp07Zq305s/VUe1XQ4ZIHTO',0,'0',1,0,NULL,NULL,NULL,NULL,NULL,NULL,'2023-08-29 00:44:11','2023-08-29 00:44:11'),(7,'Shamim','Hasan','shamimhasan009@gmail.com','$2y$10$yRISJ5z2nn9c6k.8odZMH.QnPTOQcFcxEK7FEniNyrCh/GxUv.wsm',0,'0',1,0,NULL,NULL,NULL,NULL,NULL,NULL,'2023-08-29 00:57:01','2023-08-29 00:57:01'),(8,'Shamim','Hasan','shamimhasan007@gmail.com','$2y$10$ce.tj6Ax/5YO2ZMv3V3x7evTY4WPe4r/j1.7zF0sDUz4yG3bnIsge',0,'0',1,0,NULL,NULL,NULL,NULL,NULL,NULL,'2023-08-29 01:02:38','2023-08-29 01:02:38'),(9,'Stephanie','Avila','ra@realtyinterface.com','$2y$10$1ydY2aEN7t0mIUpdoLpzOe1JkW8wQ.bnEG0vX4PGxDg5NxEr4v.3S',0,'0',1,0,NULL,NULL,NULL,NULL,NULL,NULL,'2023-08-29 01:11:11','2023-08-29 01:11:11'),(10,'Kol','Stancil','info@odysseydesign.us','$2y$10$EUueY.QUq6SqTihULYI/tuPUoe1tMnSc/vOIG27MgzMR1d.QdoUFu',0,'0',1,0,NULL,NULL,NULL,NULL,NULL,NULL,'2023-08-29 02:07:26','2023-08-29 02:07:26'),(11,'Stephanie','Stancil','testing1@realtyinterface.com','$2y$10$9G0pXGk0414FWadbCzj8UetaKArXWb.et4WpRuN55/OnWtvN/6giW',0,'0',1,0,NULL,NULL,NULL,NULL,NULL,NULL,'2023-08-29 02:33:35','2023-08-29 02:33:35');
/*!40000 ALTER TABLE `agents` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `amenities`
--

DROP TABLE IF EXISTS `amenities`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `amenities` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `agent_id` int(11) DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=79 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `amenities`
--

LOCK TABLES `amenities` WRITE;
/*!40000 ALTER TABLE `amenities` DISABLE KEYS */;
INSERT INTO `amenities` VALUES (1,'Beach Access',0,'2022-08-10 00:56:23','2022-08-10 00:56:23'),(2,'City Lights Views',0,'2022-08-10 00:56:23','2022-08-10 00:56:23'),(3,'Community Clubhouse',0,'2022-08-10 00:56:23','2022-08-10 00:56:23'),(4,'Community Pool',0,'2022-08-10 00:56:23','2022-08-10 00:56:23'),(5,'Frameless Glass Showers',0,'2022-08-10 00:56:23','2022-08-10 00:56:23'),(6,'Gated Community',0,'2022-08-10 00:56:23','2022-08-10 00:56:23'),(7,'Golf Course Lot',0,'2022-08-10 00:56:23','2022-08-10 00:56:23'),(8,'Great Schools',0,'2022-08-10 00:56:23','2022-08-10 00:56:23'),(9,'Hardwood Floors',0,'2022-08-10 00:56:23','2022-08-10 00:56:23'),(10,'Heated Floors',0,'2022-08-10 00:56:23','2022-08-10 00:56:23'),(11,'Heated Pool',0,'2022-08-10 00:56:23','2022-08-10 00:56:23'),(12,'High Ceilings',0,'2022-08-10 00:56:23','2022-08-10 00:56:23'),(13,'Large Kitchen',0,'2022-08-10 00:56:23','2022-08-10 00:56:23'),(14,'Large Lot',0,'2022-08-10 00:56:23','2022-08-10 00:56:23'),(15,'Mountain Views',0,'2022-08-10 00:56:23','2022-08-10 00:56:23'),(16,'New Construction',0,'2022-08-10 00:56:23','2022-08-10 00:56:23'),(17,'Ocean Views',0,'2022-08-10 00:56:23','2022-08-10 00:56:23'),(18,'Open Floor Plan',0,'2022-08-10 00:56:23','2022-08-10 00:56:23'),(19,'Oversized Windows',0,'2022-08-10 00:56:23','2022-08-10 00:56:23'),(20,'Pool',0,'2022-08-10 00:56:23','2022-08-10 00:56:23'),(21,'Quartz Countertops',0,'2022-08-10 00:56:23','2022-08-10 00:56:23'),(22,'Quiet and Private',0,'2022-08-10 00:56:23','2022-08-10 00:56:23'),(23,'Shopping Nearby',0,'2022-08-10 00:56:23','2022-08-10 00:56:23'),(24,'Side-by-Side Washer and Dryer',0,'2022-08-10 00:56:23','2022-08-10 00:56:23'),(25,'Spa',0,'2022-08-10 00:56:23','2022-08-10 00:56:23'),(26,'Stainless Steel Appliances',0,'2022-08-10 00:56:23','2022-08-10 00:56:23'),(27,'Walk-In Closets',0,'2022-08-10 00:56:23','2022-08-10 00:56:23'),(35,'RADIANT HEATING',2,'2022-12-27 17:41:49','2022-12-27 17:41:49'),(36,'PANORAMIC VIEWS',2,'2022-12-27 17:41:49','2022-12-27 17:41:49'),(37,'ONE ACRE',2,'2022-12-27 17:41:49','2022-12-27 17:41:49'),(38,'FOUR INSULATED GARAGES',2,'2022-12-27 17:41:49','2022-12-27 17:41:49'),(39,'RECREATION ROOM',2,'2022-12-27 17:41:49','2022-12-27 17:41:49'),(40,'FULLY FURNISHED',2,'2022-12-27 17:41:49','2022-12-27 17:41:49'),(41,'TSMLS 20203279',2,'2022-12-27 17:41:49','2022-12-27 17:41:49'),(42,'STUNNING VIEWS OF THE MARTIS VALLEY & THE CARSON RANGE',2,'2022-12-27 17:41:49','2022-12-27 17:41:49'),(43,'FOUR GAS AND STONE FIREPLACES',2,'2022-12-27 17:41:49','2022-12-27 17:41:49'),(44,'TWO MASTER BEDROOMS',2,'2022-12-27 17:41:49','2022-12-27 17:41:49'),(45,'RADIANT DRIVEWAYS',2,'2022-12-27 17:41:49','2022-12-27 17:41:49'),(46,'MUD ROOMS',2,'2022-12-27 17:41:49','2022-12-27 17:41:49'),(47,'test new amenity',2,'2023-05-03 10:09:03','2023-05-03 10:09:03'),(48,'Martis Camp Homes',2,'2023-06-15 16:26:44','2023-06-15 16:26:44'),(49,'Golf Course Membership',2,'2023-06-15 16:26:44','2023-06-15 16:26:44'),(50,'Club House',2,'2023-06-15 16:26:44','2023-06-15 16:26:44'),(51,'Members Only Ski Lodge',2,'2023-07-24 16:47:02','2023-07-24 16:47:02'),(52,'Tom Fazio 18-Home Golf Course',2,'2023-07-24 16:47:02','2023-07-24 16:47:02'),(53,'Martis Camp Express Chairlift',2,'2023-07-24 16:47:02','2023-07-24 16:47:02'),(54,'Chairlift to Northstar',2,'2023-07-24 16:47:02','2023-07-24 16:47:02'),(55,'Exquisite Dining',2,'2023-07-24 16:47:02','2023-07-24 16:47:02'),(56,'Four-Season Private Community',2,'2023-07-24 16:47:02','2023-07-24 16:47:02'),(57,'Sub-Zero',2,'2023-07-24 16:47:02','2023-07-24 16:47:02'),(58,' Wolf',2,'2023-07-24 16:47:02','2023-07-24 16:47:02'),(59,' and Miele Appliances',2,'2023-07-24 16:47:02','2023-07-24 16:47:02'),(60,'Soaring Outdoor and Indoor Fireplaces',2,'2023-07-24 16:47:02','2023-07-24 16:47:02'),(61,'Two Master Suites',2,'2023-07-24 16:47:02','2023-07-24 16:47:02'),(62,'Alder and Maple Cabinets',2,'2023-07-24 16:47:02','2023-07-24 16:47:02'),(63,'Soapstone Countertops',2,'2023-07-24 16:47:02','2023-07-24 16:47:02'),(64,'Radiant Heating and Driveways',2,'2023-07-24 16:47:02','2023-07-24 16:47:02'),(65,'PhantomCar Subterranean Lifts',2,'2023-07-24 16:47:02','2023-07-24 16:47:02'),(66,'Members Only Ski Lodge',3,'2023-07-24 17:19:02','2023-07-24 17:19:02'),(67,'Tom Fazio 18-Hole Golf Course',3,'2023-07-24 17:19:02','2023-07-24 17:19:02'),(68,'Private Chairlift to Northstar',3,'2023-07-24 17:19:02','2023-07-24 17:19:02'),(69,'Exquisite Dining at Club',3,'2023-07-24 17:19:02','2023-07-24 17:19:02'),(70,'Four-Season Private Community',3,'2023-07-24 17:19:02','2023-07-24 17:19:02'),(71,'Sub-Zero and Wolf',3,'2023-07-24 17:19:02','2023-07-24 17:19:02'),(72,'Soaring Outdoor/Indoor Fireplaces',3,'2023-07-24 17:19:02','2023-07-24 17:19:02'),(73,'Two Master Suites',3,'2023-07-24 17:19:02','2023-07-24 17:19:02'),(74,'Alder and Maple Cabinets',3,'2023-07-24 17:19:02','2023-07-24 17:19:02'),(75,'Soapstone Countertops',3,'2023-07-24 17:19:02','2023-07-24 17:19:02'),(76,'Radiant Floors and Driveways',3,'2023-07-24 17:19:02','2023-07-24 17:19:02'),(77,'PhantomCar Subterranean Lifts',3,'2023-07-24 17:19:02','2023-07-24 17:19:02'),(78,'Recreation Room',2,'2023-08-28 16:36:40','2023-08-28 16:36:40');
/*!40000 ALTER TABLE `amenities` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `countries`
--

DROP TABLE IF EXISTS `countries`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `countries` (
  `country_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `code` char(2) NOT NULL,
  `name` varchar(100) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`country_id`)
) ENGINE=InnoDB AUTO_INCREMENT=244 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `countries`
--

LOCK TABLES `countries` WRITE;
/*!40000 ALTER TABLE `countries` DISABLE KEYS */;
INSERT INTO `countries` VALUES (1,'AF','Afghanistan','2022-08-10 00:55:24','2022-08-10 00:55:24'),(2,'AX','Åland Islands','2022-08-10 00:55:24','2022-08-10 00:55:24'),(3,'AL','Albania','2022-08-10 00:55:24','2022-08-10 00:55:24'),(4,'DZ','Algeria','2022-08-10 00:55:24','2022-08-10 00:55:24'),(5,'AS','American Samoa','2022-08-10 00:55:24','2022-08-10 00:55:24'),(6,'AD','AndorrA','2022-08-10 00:55:24','2022-08-10 00:55:24'),(7,'AO','Angola','2022-08-10 00:55:24','2022-08-10 00:55:24'),(8,'AI','Anguilla','2022-08-10 00:55:24','2022-08-10 00:55:24'),(9,'AQ','Antarctica','2022-08-10 00:55:24','2022-08-10 00:55:24'),(10,'AG','Antigua and Barbuda','2022-08-10 00:55:24','2022-08-10 00:55:24'),(11,'AR','Argentina','2022-08-10 00:55:24','2022-08-10 00:55:24'),(12,'AM','Armenia','2022-08-10 00:55:24','2022-08-10 00:55:24'),(13,'AW','Aruba','2022-08-10 00:55:24','2022-08-10 00:55:24'),(14,'AU','Australia','2022-08-10 00:55:24','2022-08-10 00:55:24'),(15,'AT','Austria','2022-08-10 00:55:24','2022-08-10 00:55:24'),(16,'AZ','Azerbaijan','2022-08-10 00:55:24','2022-08-10 00:55:24'),(17,'BS','Bahamas','2022-08-10 00:55:24','2022-08-10 00:55:24'),(18,'BH','Bahrain','2022-08-10 00:55:24','2022-08-10 00:55:24'),(19,'BD','Bangladesh','2022-08-10 00:55:24','2022-08-10 00:55:24'),(20,'BB','Barbados','2022-08-10 00:55:24','2022-08-10 00:55:24'),(21,'BY','Belarus','2022-08-10 00:55:24','2022-08-10 00:55:24'),(22,'BE','Belgium','2022-08-10 00:55:24','2022-08-10 00:55:24'),(23,'BZ','Belize','2022-08-10 00:55:24','2022-08-10 00:55:24'),(24,'BJ','Benin','2022-08-10 00:55:24','2022-08-10 00:55:24'),(25,'BM','Bermuda','2022-08-10 00:55:24','2022-08-10 00:55:24'),(26,'BT','Bhutan','2022-08-10 00:55:24','2022-08-10 00:55:24'),(27,'BO','Bolivia','2022-08-10 00:55:24','2022-08-10 00:55:24'),(28,'BA','Bosnia and Herzegovina','2022-08-10 00:55:24','2022-08-10 00:55:24'),(29,'BW','Botswana','2022-08-10 00:55:24','2022-08-10 00:55:24'),(30,'BV','Bouvet Island','2022-08-10 00:55:24','2022-08-10 00:55:24'),(31,'BR','Brazil','2022-08-10 00:55:24','2022-08-10 00:55:24'),(32,'IO','British Indian Ocean Territory','2022-08-10 00:55:24','2022-08-10 00:55:24'),(33,'BN','Brunei Darussalam','2022-08-10 00:55:24','2022-08-10 00:55:24'),(34,'BG','Bulgaria','2022-08-10 00:55:24','2022-08-10 00:55:24'),(35,'BF','Burkina Faso','2022-08-10 00:55:24','2022-08-10 00:55:24'),(36,'BI','Burundi','2022-08-10 00:55:24','2022-08-10 00:55:24'),(37,'KH','Cambodia','2022-08-10 00:55:24','2022-08-10 00:55:24'),(38,'CM','Cameroon','2022-08-10 00:55:24','2022-08-10 00:55:24'),(39,'CA','Canada','2022-08-10 00:55:24','2022-08-10 00:55:24'),(40,'CV','Cape Verde','2022-08-10 00:55:24','2022-08-10 00:55:24'),(41,'KY','Cayman Islands','2022-08-10 00:55:24','2022-08-10 00:55:24'),(42,'CF','Central African Republic','2022-08-10 00:55:24','2022-08-10 00:55:24'),(43,'TD','Chad','2022-08-10 00:55:24','2022-08-10 00:55:24'),(44,'CL','Chile','2022-08-10 00:55:24','2022-08-10 00:55:24'),(45,'CN','China','2022-08-10 00:55:24','2022-08-10 00:55:24'),(46,'CX','Christmas Island','2022-08-10 00:55:24','2022-08-10 00:55:24'),(47,'CC','Cocos (Keeling) Islands','2022-08-10 00:55:24','2022-08-10 00:55:24'),(48,'CO','Colombia','2022-08-10 00:55:24','2022-08-10 00:55:24'),(49,'KM','Comoros','2022-08-10 00:55:24','2022-08-10 00:55:24'),(50,'CG','Congo','2022-08-10 00:55:24','2022-08-10 00:55:24'),(51,'CD','Congo, The Democratic Republic of the','2022-08-10 00:55:24','2022-08-10 00:55:24'),(52,'CK','Cook Islands','2022-08-10 00:55:24','2022-08-10 00:55:24'),(53,'CR','Costa Rica','2022-08-10 00:55:24','2022-08-10 00:55:24'),(54,'CI','Cote D\"Ivoire','2022-08-10 00:55:24','2022-08-10 00:55:24'),(55,'HR','Croatia','2022-08-10 00:55:24','2022-08-10 00:55:24'),(56,'CU','Cuba','2022-08-10 00:55:24','2022-08-10 00:55:24'),(57,'CY','Cyprus','2022-08-10 00:55:24','2022-08-10 00:55:24'),(58,'CZ','Czech Republic','2022-08-10 00:55:24','2022-08-10 00:55:24'),(59,'DK','Denmark','2022-08-10 00:55:24','2022-08-10 00:55:24'),(60,'DJ','Djibouti','2022-08-10 00:55:24','2022-08-10 00:55:24'),(61,'DM','Dominica','2022-08-10 00:55:24','2022-08-10 00:55:24'),(62,'DO','Dominican Republic','2022-08-10 00:55:24','2022-08-10 00:55:24'),(63,'EC','Ecuador','2022-08-10 00:55:24','2022-08-10 00:55:24'),(64,'EG','Egypt','2022-08-10 00:55:24','2022-08-10 00:55:24'),(65,'SV','El Salvador','2022-08-10 00:55:24','2022-08-10 00:55:24'),(66,'GQ','Equatorial Guinea','2022-08-10 00:55:24','2022-08-10 00:55:24'),(67,'ER','Eritrea','2022-08-10 00:55:24','2022-08-10 00:55:24'),(68,'EE','Estonia','2022-08-10 00:55:24','2022-08-10 00:55:24'),(69,'ET','Ethiopia','2022-08-10 00:55:24','2022-08-10 00:55:24'),(70,'FK','Falkland Islands (Malvinas)','2022-08-10 00:55:24','2022-08-10 00:55:24'),(71,'FO','Faroe Islands','2022-08-10 00:55:24','2022-08-10 00:55:24'),(72,'FJ','Fiji','2022-08-10 00:55:24','2022-08-10 00:55:24'),(73,'FI','Finland','2022-08-10 00:55:24','2022-08-10 00:55:24'),(74,'FR','France','2022-08-10 00:55:24','2022-08-10 00:55:24'),(75,'GF','French Guiana','2022-08-10 00:55:24','2022-08-10 00:55:24'),(76,'PF','French Polynesia','2022-08-10 00:55:24','2022-08-10 00:55:24'),(77,'TF','French Southern Territories','2022-08-10 00:55:24','2022-08-10 00:55:24'),(78,'GA','Gabon','2022-08-10 00:55:24','2022-08-10 00:55:24'),(79,'GM','Gambia','2022-08-10 00:55:24','2022-08-10 00:55:24'),(80,'GE','Georgia','2022-08-10 00:55:24','2022-08-10 00:55:24'),(81,'DE','Germany','2022-08-10 00:55:24','2022-08-10 00:55:24'),(82,'GH','Ghana','2022-08-10 00:55:24','2022-08-10 00:55:24'),(83,'GI','Gibraltar','2022-08-10 00:55:24','2022-08-10 00:55:24'),(84,'GR','Greece','2022-08-10 00:55:24','2022-08-10 00:55:24'),(85,'GL','Greenland','2022-08-10 00:55:24','2022-08-10 00:55:24'),(86,'GD','Grenada','2022-08-10 00:55:24','2022-08-10 00:55:24'),(87,'GP','Guadeloupe','2022-08-10 00:55:24','2022-08-10 00:55:24'),(88,'GU','Guam','2022-08-10 00:55:24','2022-08-10 00:55:24'),(89,'GT','Guatemala','2022-08-10 00:55:24','2022-08-10 00:55:24'),(90,'GG','Guernsey','2022-08-10 00:55:24','2022-08-10 00:55:24'),(91,'GN','Guinea','2022-08-10 00:55:24','2022-08-10 00:55:24'),(92,'GW','Guinea-Bissau','2022-08-10 00:55:24','2022-08-10 00:55:24'),(93,'GY','Guyana','2022-08-10 00:55:24','2022-08-10 00:55:24'),(94,'HT','Haiti','2022-08-10 00:55:24','2022-08-10 00:55:24'),(95,'HM','Heard Island and Mcdonald Islands','2022-08-10 00:55:24','2022-08-10 00:55:24'),(96,'VA','Holy See (Vatican City State)','2022-08-10 00:55:24','2022-08-10 00:55:24'),(97,'HN','Honduras','2022-08-10 00:55:24','2022-08-10 00:55:24'),(98,'HK','Hong Kong','2022-08-10 00:55:24','2022-08-10 00:55:24'),(99,'HU','Hungary','2022-08-10 00:55:24','2022-08-10 00:55:24'),(100,'IS','Iceland','2022-08-10 00:55:24','2022-08-10 00:55:24'),(101,'IN','India','2022-08-10 00:55:24','2022-08-10 00:55:24'),(102,'ID','Indonesia','2022-08-10 00:55:24','2022-08-10 00:55:24'),(103,'IR','Iran, Islamic Republic Of','2022-08-10 00:55:24','2022-08-10 00:55:24'),(104,'IQ','Iraq','2022-08-10 00:55:24','2022-08-10 00:55:24'),(105,'IE','Ireland','2022-08-10 00:55:24','2022-08-10 00:55:24'),(106,'IM','Isle of Man','2022-08-10 00:55:24','2022-08-10 00:55:24'),(107,'IL','Israel','2022-08-10 00:55:24','2022-08-10 00:55:24'),(108,'IT','Italy','2022-08-10 00:55:24','2022-08-10 00:55:24'),(109,'JM','Jamaica','2022-08-10 00:55:24','2022-08-10 00:55:24'),(110,'JP','Japan','2022-08-10 00:55:24','2022-08-10 00:55:24'),(111,'JE','Jersey','2022-08-10 00:55:24','2022-08-10 00:55:24'),(112,'JO','Jordan','2022-08-10 00:55:24','2022-08-10 00:55:24'),(113,'KZ','Kazakhstan','2022-08-10 00:55:24','2022-08-10 00:55:24'),(114,'KE','Kenya','2022-08-10 00:55:24','2022-08-10 00:55:24'),(115,'KI','Kiribati','2022-08-10 00:55:24','2022-08-10 00:55:24'),(116,'KP','Korea, Democratic People\"S Republic of','2022-08-10 00:55:24','2022-08-10 00:55:24'),(117,'KR','Korea, Republic of','2022-08-10 00:55:24','2022-08-10 00:55:24'),(118,'KW','Kuwait','2022-08-10 00:55:24','2022-08-10 00:55:24'),(119,'KG','Kyrgyzstan','2022-08-10 00:55:24','2022-08-10 00:55:24'),(120,'LA','Lao People\"S Democratic Republic','2022-08-10 00:55:24','2022-08-10 00:55:24'),(121,'LV','Latvia','2022-08-10 00:55:24','2022-08-10 00:55:24'),(122,'LB','Lebanon','2022-08-10 00:55:24','2022-08-10 00:55:24'),(123,'LS','Lesotho','2022-08-10 00:55:24','2022-08-10 00:55:24'),(124,'LR','Liberia','2022-08-10 00:55:24','2022-08-10 00:55:24'),(125,'LY','Libyan Arab Jamahiriya','2022-08-10 00:55:24','2022-08-10 00:55:24'),(126,'LI','Liechtenstein','2022-08-10 00:55:24','2022-08-10 00:55:24'),(127,'LT','Lithuania','2022-08-10 00:55:24','2022-08-10 00:55:24'),(128,'LU','Luxembourg','2022-08-10 00:55:24','2022-08-10 00:55:24'),(129,'MO','Macao','2022-08-10 00:55:24','2022-08-10 00:55:24'),(130,'MK','Macedonia, The Former Yugoslav Republic of','2022-08-10 00:55:24','2022-08-10 00:55:24'),(131,'MG','Madagascar','2022-08-10 00:55:24','2022-08-10 00:55:24'),(132,'MW','Malawi','2022-08-10 00:55:24','2022-08-10 00:55:24'),(133,'MY','Malaysia','2022-08-10 00:55:24','2022-08-10 00:55:24'),(134,'MV','Maldives','2022-08-10 00:55:24','2022-08-10 00:55:24'),(135,'ML','Mali','2022-08-10 00:55:24','2022-08-10 00:55:24'),(136,'MT','Malta','2022-08-10 00:55:25','2022-08-10 00:55:25'),(137,'MH','Marshall Islands','2022-08-10 00:55:25','2022-08-10 00:55:25'),(138,'MQ','Martinique','2022-08-10 00:55:25','2022-08-10 00:55:25'),(139,'MR','Mauritania','2022-08-10 00:55:25','2022-08-10 00:55:25'),(140,'MU','Mauritius','2022-08-10 00:55:25','2022-08-10 00:55:25'),(141,'YT','Mayotte','2022-08-10 00:55:25','2022-08-10 00:55:25'),(142,'MX','Mexico','2022-08-10 00:55:25','2022-08-10 00:55:25'),(143,'FM','Micronesia, Federated States of','2022-08-10 00:55:25','2022-08-10 00:55:25'),(144,'MD','Moldova, Republic of','2022-08-10 00:55:25','2022-08-10 00:55:25'),(145,'MC','Monaco','2022-08-10 00:55:25','2022-08-10 00:55:25'),(146,'MN','Mongolia','2022-08-10 00:55:25','2022-08-10 00:55:25'),(147,'MS','Montserrat','2022-08-10 00:55:25','2022-08-10 00:55:25'),(148,'MA','Morocco','2022-08-10 00:55:25','2022-08-10 00:55:25'),(149,'MZ','Mozambique','2022-08-10 00:55:25','2022-08-10 00:55:25'),(150,'MM','Myanmar','2022-08-10 00:55:25','2022-08-10 00:55:25'),(151,'NA','Namibia','2022-08-10 00:55:25','2022-08-10 00:55:25'),(152,'NR','Nauru','2022-08-10 00:55:25','2022-08-10 00:55:25'),(153,'NP','Nepal','2022-08-10 00:55:25','2022-08-10 00:55:25'),(154,'NL','Netherlands','2022-08-10 00:55:25','2022-08-10 00:55:25'),(155,'AN','Netherlands Antilles','2022-08-10 00:55:25','2022-08-10 00:55:25'),(156,'NC','New Caledonia','2022-08-10 00:55:25','2022-08-10 00:55:25'),(157,'NZ','New Zealand','2022-08-10 00:55:25','2022-08-10 00:55:25'),(158,'NI','Nicaragua','2022-08-10 00:55:25','2022-08-10 00:55:25'),(159,'NE','Niger','2022-08-10 00:55:25','2022-08-10 00:55:25'),(160,'NG','Nigeria','2022-08-10 00:55:25','2022-08-10 00:55:25'),(161,'NU','Niue','2022-08-10 00:55:25','2022-08-10 00:55:25'),(162,'NF','Norfolk Island','2022-08-10 00:55:25','2022-08-10 00:55:25'),(163,'MP','Northern Mariana Islands','2022-08-10 00:55:25','2022-08-10 00:55:25'),(164,'NO','Norway','2022-08-10 00:55:25','2022-08-10 00:55:25'),(165,'OM','Oman','2022-08-10 00:55:25','2022-08-10 00:55:25'),(166,'PK','Pakistan','2022-08-10 00:55:25','2022-08-10 00:55:25'),(167,'PW','Palau','2022-08-10 00:55:25','2022-08-10 00:55:25'),(168,'PS','Palestinian Territory, Occupied','2022-08-10 00:55:25','2022-08-10 00:55:25'),(169,'PA','Panama','2022-08-10 00:55:25','2022-08-10 00:55:25'),(170,'PG','Papua New Guinea','2022-08-10 00:55:25','2022-08-10 00:55:25'),(171,'PY','Paraguay','2022-08-10 00:55:25','2022-08-10 00:55:25'),(172,'PE','Peru','2022-08-10 00:55:25','2022-08-10 00:55:25'),(173,'PH','Philippines','2022-08-10 00:55:25','2022-08-10 00:55:25'),(174,'PN','Pitcairn','2022-08-10 00:55:25','2022-08-10 00:55:25'),(175,'PL','Poland','2022-08-10 00:55:25','2022-08-10 00:55:25'),(176,'PT','Portugal','2022-08-10 00:55:25','2022-08-10 00:55:25'),(177,'PR','Puerto Rico','2022-08-10 00:55:25','2022-08-10 00:55:25'),(178,'QA','Qatar','2022-08-10 00:55:25','2022-08-10 00:55:25'),(179,'RE','Reunion','2022-08-10 00:55:25','2022-08-10 00:55:25'),(180,'RO','Romania','2022-08-10 00:55:25','2022-08-10 00:55:25'),(181,'RU','Russian Federation','2022-08-10 00:55:25','2022-08-10 00:55:25'),(182,'RW','RWANDA','2022-08-10 00:55:25','2022-08-10 00:55:25'),(183,'SH','Saint Helena','2022-08-10 00:55:25','2022-08-10 00:55:25'),(184,'KN','Saint Kitts and Nevis','2022-08-10 00:55:25','2022-08-10 00:55:25'),(185,'LC','Saint Lucia','2022-08-10 00:55:25','2022-08-10 00:55:25'),(186,'PM','Saint Pierre and Miquelon','2022-08-10 00:55:25','2022-08-10 00:55:25'),(187,'VC','Saint Vincent and the Grenadines','2022-08-10 00:55:25','2022-08-10 00:55:25'),(188,'WS','Samoa','2022-08-10 00:55:25','2022-08-10 00:55:25'),(189,'SM','San Marino','2022-08-10 00:55:25','2022-08-10 00:55:25'),(190,'ST','Sao Tome and Principe','2022-08-10 00:55:25','2022-08-10 00:55:25'),(191,'SA','Saudi Arabia','2022-08-10 00:55:25','2022-08-10 00:55:25'),(192,'SN','Senegal','2022-08-10 00:55:25','2022-08-10 00:55:25'),(193,'CS','Serbia and Montenegro','2022-08-10 00:55:25','2022-08-10 00:55:25'),(194,'SC','Seychelles','2022-08-10 00:55:25','2022-08-10 00:55:25'),(195,'SL','Sierra Leone','2022-08-10 00:55:25','2022-08-10 00:55:25'),(196,'SG','Singapore','2022-08-10 00:55:25','2022-08-10 00:55:25'),(197,'SK','Slovakia','2022-08-10 00:55:25','2022-08-10 00:55:25'),(198,'SI','Slovenia','2022-08-10 00:55:25','2022-08-10 00:55:25'),(199,'SB','Solomon Islands','2022-08-10 00:55:25','2022-08-10 00:55:25'),(200,'SO','Somalia','2022-08-10 00:55:25','2022-08-10 00:55:25'),(201,'ZA','South Africa','2022-08-10 00:55:25','2022-08-10 00:55:25'),(202,'GS','South Georgia and the South Sandwich Islands','2022-08-10 00:55:25','2022-08-10 00:55:25'),(203,'ES','Spain','2022-08-10 00:55:25','2022-08-10 00:55:25'),(204,'LK','Sri Lanka','2022-08-10 00:55:25','2022-08-10 00:55:25'),(205,'SD','Sudan','2022-08-10 00:55:25','2022-08-10 00:55:25'),(206,'SR','Suri','2022-08-10 00:55:25','2022-08-10 00:55:25'),(207,'SJ','Svalbard and Jan Mayen','2022-08-10 00:55:25','2022-08-10 00:55:25'),(208,'SZ','Swaziland','2022-08-10 00:55:25','2022-08-10 00:55:25'),(209,'SE','Sweden','2022-08-10 00:55:25','2022-08-10 00:55:25'),(210,'CH','Switzerland','2022-08-10 00:55:25','2022-08-10 00:55:25'),(211,'SY','Syrian Arab Republic','2022-08-10 00:55:25','2022-08-10 00:55:25'),(212,'TW','Taiwan, Province of China','2022-08-10 00:55:25','2022-08-10 00:55:25'),(213,'TJ','Tajikistan','2022-08-10 00:55:25','2022-08-10 00:55:25'),(214,'TZ','Tanzania, United Republic of','2022-08-10 00:55:25','2022-08-10 00:55:25'),(215,'TH','Thailand','2022-08-10 00:55:25','2022-08-10 00:55:25'),(216,'TL','Timor-Leste','2022-08-10 00:55:25','2022-08-10 00:55:25'),(217,'TG','Togo','2022-08-10 00:55:25','2022-08-10 00:55:25'),(218,'TK','Tokelau','2022-08-10 00:55:25','2022-08-10 00:55:25'),(219,'TO','Tonga','2022-08-10 00:55:25','2022-08-10 00:55:25'),(220,'TT','Trinidad and Tobago','2022-08-10 00:55:25','2022-08-10 00:55:25'),(221,'TN','Tunisia','2022-08-10 00:55:25','2022-08-10 00:55:25'),(222,'TR','Turkey','2022-08-10 00:55:25','2022-08-10 00:55:25'),(223,'TM','Turkmenistan','2022-08-10 00:55:25','2022-08-10 00:55:25'),(224,'TC','Turks and Caicos Islands','2022-08-10 00:55:25','2022-08-10 00:55:25'),(225,'TV','Tuvalu','2022-08-10 00:55:25','2022-08-10 00:55:25'),(226,'UG','Uganda','2022-08-10 00:55:25','2022-08-10 00:55:25'),(227,'UA','Ukraine','2022-08-10 00:55:25','2022-08-10 00:55:25'),(228,'AE','United Arab Emirates','2022-08-10 00:55:25','2022-08-10 00:55:25'),(229,'GB','United Kingdom','2022-08-10 00:55:25','2022-08-10 00:55:25'),(230,'US','United States','2022-08-10 00:55:25','2022-08-10 00:55:25'),(231,'UM','United States Minor Outlying Islands','2022-08-10 00:55:25','2022-08-10 00:55:25'),(232,'UY','Uruguay','2022-08-10 00:55:25','2022-08-10 00:55:25'),(233,'UZ','Uzbekistan','2022-08-10 00:55:25','2022-08-10 00:55:25'),(234,'VU','Vanuatu','2022-08-10 00:55:25','2022-08-10 00:55:25'),(235,'VE','Venezuela','2022-08-10 00:55:25','2022-08-10 00:55:25'),(236,'VN','Viet Nam','2022-08-10 00:55:25','2022-08-10 00:55:25'),(237,'VG','Virgin Islands, British','2022-08-10 00:55:25','2022-08-10 00:55:25'),(238,'VI','Virgin Islands, U.S.','2022-08-10 00:55:25','2022-08-10 00:55:25'),(239,'WF','Wallis and Futuna','2022-08-10 00:55:25','2022-08-10 00:55:25'),(240,'EH','Western Sahara','2022-08-10 00:55:25','2022-08-10 00:55:25'),(241,'YE','Yemen','2022-08-10 00:55:25','2022-08-10 00:55:25'),(242,'ZM','Zambia','2022-08-10 00:55:25','2022-08-10 00:55:25'),(243,'ZW','Zimbabwe','2022-08-10 00:55:25','2022-08-10 00:55:25');
/*!40000 ALTER TABLE `countries` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `credit_logs`
--

DROP TABLE IF EXISTS `credit_logs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `credit_logs` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT 'Credits spent and purchase log for agent',
  `agent_id` int(10) unsigned NOT NULL,
  `property_id` int(10) unsigned NOT NULL,
  `credits` tinyint(4) NOT NULL,
  `type` enum('Spent','Bought') NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `credit_logs`
--

LOCK TABLES `credit_logs` WRITE;
/*!40000 ALTER TABLE `credit_logs` DISABLE KEYS */;
INSERT INTO `credit_logs` VALUES (1,1,0,2,'Bought','2022-12-22 14:24:57','2022-12-22 14:24:57'),(2,1,0,10,'Bought','2022-12-22 14:31:35','2022-12-22 14:31:35'),(3,1,1,-1,'Spent','2022-12-23 10:59:50','2022-12-23 10:59:50'),(4,2,4,-1,'Spent','2023-06-29 20:46:21','2023-06-29 20:46:21'),(5,2,5,-1,'Spent','2023-06-30 02:03:09','2023-06-30 02:03:09'),(6,2,3,-1,'Spent','2023-06-30 02:03:33','2023-06-30 02:03:33'),(7,2,2,-1,'Spent','2023-07-13 19:12:17','2023-07-13 19:12:17'),(8,3,9,-1,'Spent','2023-07-25 19:38:27','2023-07-25 19:38:27');
/*!40000 ALTER TABLE `credit_logs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `failed_jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `failed_jobs`
--

LOCK TABLES `failed_jobs` WRITE;
/*!40000 ALTER TABLE `failed_jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `failed_jobs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=67 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (7,'2022_07_26_060742_create_countries_table',2),(38,'2014_10_12_000000_create_users_table',3),(39,'2014_10_12_100000_create_password_resets_table',3),(40,'2019_08_19_000000_create_failed_jobs_table',3),(41,'2019_12_14_000001_create_personal_access_tokens_table',3),(42,'2022_07_26_054344_create_agents_table',3),(43,'2022_07_26_054506_create_agent_addresses_table',3),(44,'2022_07_27_122953_create_countries_table',3),(45,'2022_08_01_095144_create_amenities_table',3),(46,'2022_08_01_130207_create_properties_table',3),(47,'2022_08_01_130301_create_property_amenities_table',3),(48,'2022_08_01_130919_create_property_floorplans_table',3),(49,'2022_08_01_131227_create_property_floorplan_images_table',3),(50,'2022_08_01_133652_create_property_galleries_table',3),(51,'2022_08_01_133929_create_property_gallery_images_table',3),(52,'2022_08_01_134424_create_property_videos_table',3),(53,'2022_08_05_130452_add_columns_to_properties',3),(54,'2022_08_08_061349_add_badroom_to_properties',3),(55,'2022_08_08_093531_create_property_images_table',3),(56,'2022_08_09_103633_edit_columns_to_agents',3),(57,'2022_08_18_122725_rename_columns_to_property_gallery_images',4),(58,'2022_08_18_123644_rename_columnsize_to_property_gallery_images',4),(59,'2022_08_29_072441_changetitle_in_property_videos_table',5),(60,'2022_08_29_092801_change_column_in_property_videos_table',5),(61,'2022_08_31_121827_create_property_matterport_table',5),(62,'2022_09_01_124203_property_documents',5),(63,'2022_09_05_061109_add_country_id_to_properties',5),(64,'2022_09_20_111556_create_admins_table',6),(65,'2022_09_26_041636_create_plans_table',6),(66,'2022_09_26_062703_create_pages_table',6);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pages`
--

DROP TABLE IF EXISTS `pages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pages` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(50) NOT NULL,
  `slug` varchar(50) NOT NULL,
  `content` text NOT NULL,
  `action` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pages`
--

LOCK TABLES `pages` WRITE;
/*!40000 ALTER TABLE `pages` DISABLE KEYS */;
/*!40000 ALTER TABLE `pages` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `password_resets` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_resets`
--

LOCK TABLES `password_resets` WRITE;
/*!40000 ALTER TABLE `password_resets` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_resets` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `payments`
--

DROP TABLE IF EXISTS `payments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `payments` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `agent_id` int(11) NOT NULL,
  `plan_id` int(11) NOT NULL,
  `payment_date` date DEFAULT NULL,
  `payment_id` varchar(255) DEFAULT NULL,
  `amount` decimal(5,2) DEFAULT NULL,
  `gateway_fees` decimal(5,2) DEFAULT NULL,
  `currency` varchar(10) DEFAULT NULL,
  `other` text DEFAULT NULL,
  `status` enum('Pending','Paid','Unpaid') NOT NULL DEFAULT 'Unpaid',
  `active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `payments`
--

LOCK TABLES `payments` WRITE;
/*!40000 ALTER TABLE `payments` DISABLE KEYS */;
INSERT INTO `payments` VALUES (1,1,3,'2022-12-22','cs_test_a1dkVnXpxi44kLYN3Aw5l72ikGPJkCWQdtgdBwGv9x7xMioydl6O5ym3PT',22.00,NULL,'usd',NULL,'Paid',1,'2022-12-22 14:23:25','2022-12-22 14:24:57'),(2,1,3,NULL,'cs_test_a10ersSxGYp2NID7o2SzPSXBOdDJzUNulKAyp3RDPhFi2XzOfVf4qjrXzl',22.00,NULL,'USD',NULL,'Unpaid',1,'2022-12-22 14:30:11','2022-12-22 14:30:11'),(3,1,4,'2022-12-22','cs_test_a1q9ZH3w7Huz8BNaMvrfhuau8gAIFhjXdBsanVTc8SwhiC8ZyfoGBHFyci',50.00,NULL,'usd',NULL,'Paid',1,'2022-12-22 14:31:05','2022-12-22 14:31:35'),(4,1,4,NULL,'cs_live_a1bXuWR0kSyLEbx1RxDIL15v7Ef79zD4KvnlVmM9mfsWbygOqd87Pdo5yg',50.00,NULL,'USD',NULL,'Unpaid',1,'2022-12-23 10:56:26','2022-12-23 10:56:26'),(5,2,3,NULL,'cs_live_a1cM9wY97FksMnRqo497DRv0j9sse38Jj3cWTTzw3AyxAqFlHXyXzeoRup',22.00,NULL,'USD',NULL,'Unpaid',1,'2023-01-10 22:04:09','2023-01-10 22:04:09'),(6,2,3,NULL,'cs_live_a1e5B60dRdQqzDdl8tJ4vgqajwkEXkXGGbsmI6aoLZfQVTvu9CW72FiMah',22.00,NULL,'USD',NULL,'Unpaid',1,'2023-05-08 09:51:25','2023-05-08 09:51:25'),(7,2,3,NULL,'cs_live_a18YtbcLWaXVSJwqj9Y91FMLZgcMqgZMktcrVWv7fdlnOZgI8TbsidEO2x',22.00,NULL,'USD',NULL,'Unpaid',1,'2023-06-23 13:42:39','2023-06-23 13:42:39');
/*!40000 ALTER TABLE `payments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `personal_access_tokens`
--

DROP TABLE IF EXISTS `personal_access_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) unsigned NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `personal_access_tokens`
--

LOCK TABLES `personal_access_tokens` WRITE;
/*!40000 ALTER TABLE `personal_access_tokens` DISABLE KEYS */;
/*!40000 ALTER TABLE `personal_access_tokens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `plans`
--

DROP TABLE IF EXISTS `plans`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `plans` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `price` decimal(5,2) NOT NULL,
  `credits` int(11) NOT NULL DEFAULT 1,
  `active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `plans`
--

LOCK TABLES `plans` WRITE;
/*!40000 ALTER TABLE `plans` DISABLE KEYS */;
INSERT INTO `plans` VALUES (3,'Nothing',22.00,2,1,'2022-10-19 07:46:57','2022-10-19 23:56:56'),(4,'Popular',50.00,10,1,'2022-12-22 14:30:59','2022-12-22 14:30:59');
/*!40000 ALTER TABLE `plans` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `properties`
--

DROP TABLE IF EXISTS `properties`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `properties` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `agent_id` bigint(20) unsigned DEFAULT NULL,
  `name` varchar(100) NOT NULL,
  `headline` varchar(100) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `bedroom` tinyint(3) unsigned DEFAULT NULL,
  `bedroom_image` varchar(255) DEFAULT NULL,
  `bathroom` tinyint(3) unsigned DEFAULT NULL,
  `bathroom_image` varchar(255) DEFAULT NULL,
  `garage` tinyint(3) unsigned DEFAULT NULL,
  `parking_spaces` tinyint(3) unsigned DEFAULT NULL,
  `unique_url` varchar(50) NOT NULL,
  `address_line_1` varchar(100) DEFAULT NULL,
  `price` varchar(20) DEFAULT NULL,
  `property_area` varchar(20) DEFAULT NULL,
  `address_line_2` varchar(255) DEFAULT NULL,
  `city` varchar(50) DEFAULT NULL,
  `state_id` varchar(50) DEFAULT NULL,
  `country_id` int(11) DEFAULT NULL,
  `zip` varchar(10) DEFAULT NULL,
  `latitude` varchar(50) DEFAULT NULL,
  `longitude` varchar(50) DEFAULT NULL,
  `levels` tinyint(3) unsigned DEFAULT NULL,
  `levels_image` varchar(255) DEFAULT NULL,
  `matterport_data` varchar(100) NOT NULL,
  `publish_date` date DEFAULT NULL,
  `views` int(11) NOT NULL DEFAULT 0,
  `published` tinyint(1) NOT NULL DEFAULT 0,
  `featured_image` int(11) NOT NULL DEFAULT 0,
  `main_section` enum('Video','Slider','Image') DEFAULT NULL,
  `expiry_date` timestamp NULL DEFAULT NULL,
  `reviewed` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `properties_agent_id_foreign` (`agent_id`),
  CONSTRAINT `properties_agent_id_foreign` FOREIGN KEY (`agent_id`) REFERENCES `agents` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `properties`
--

LOCK TABLES `properties` WRITE;
/*!40000 ALTER TABLE `properties` DISABLE KEYS */;
INSERT INTO `properties` VALUES (1,2,'9500 Wawona Court','Luxury Mountain Experience','<p class=\"p1\" style=\"font-variant-numeric: normal; font-variant-east-asian: normal; font-variant-alternates: normal; font-kerning: auto; font-optical-sizing: auto; font-feature-settings: normal; font-variation-settings: normal; font-stretch: normal; font-size: 13px; line-height: normal; font-family: &quot;Helvetica Neue&quot;;\">This modern 4,362 square foot legacy home is a crown jewel of Martis Camp, offering privacy, provoking imaginations, and dishing up views from all its deck.<span class=\"Apple-converted-space\">&nbsp;</span><span style=\"font-family: &quot;Helvetica Neue&quot;;\">Immerse yourself in a luxury mountain experience like never before. Live amidst natural splendor, sunrise to sunset and twinkling stars,</span></p>',5,'http://realtyinterface.s3.amazonaws.com/property_features/1691268501_bedroomuse.jpg',6,'http://realtyinterface.s3.amazonaws.com/property_features/1691268501_gar4.jpeg',7,10,'9500-wawona-court','9500 Wawona Court','8,376,027','4,632',NULL,'Truckee','68',230,'96161',NULL,NULL,3,'http://realtyinterface.s3.amazonaws.com/property_features/1693512083_use_1691274622.jpg','9500 Wawona Court','2023-08-31',70,0,2,'Video','2023-11-05 16:25:20',0,'2023-08-05 19:45:32','2023-09-01 15:45:06'),(2,9,'14828 MOUNTAIN WOOD DR','Nice Home','<p><span style=\"color: rgb(32, 33, 36); font-family: &quot;Google Sans&quot;, Roboto, arial, sans-serif; font-size: 20px;\">Squarespace offers straightforward payment and checkout options for your customers. Take online payments with&nbsp;</span><span style=\"background-color: rgba(80, 151, 255, 0.18); color: rgb(4, 12, 40); font-family: &quot;Google Sans&quot;, Roboto, arial, sans-serif; font-size: 20px;\">Stripe, Paypal, Apple Pay, and Afterpay</span><span style=\"color: rgb(32, 33, 36); font-family: &quot;Google Sans&quot;, Roboto, arial, sans-serif; font-size: 20px;\">&nbsp;(Afterpay is available in the US, Canada, Australia, and New Zealand).</span><br></p>',5,'http://realtyinterface.s3.amazonaws.com/property_features/1693272107_97777537_m.jpg',NULL,'http://realtyinterface.s3.amazonaws.com/property_features/1693272107_45169192_l.jpg',5,5,'14828-mountain-wood-dr','14828 MOUNTAIN WOOD DR','13,899,000','5,555',NULL,'WEED',NULL,230,'96094-9305',NULL,NULL,3,'http://realtyinterface.s3.amazonaws.com/property_features/1693272106_60870311_l%20%281%29.jpg','14828 MOUNTAIN WOOD DR','2023-08-29',3,1,0,NULL,'2023-11-27 01:25:33',1,'2023-08-29 01:19:55','2023-08-30 15:45:57');
/*!40000 ALTER TABLE `properties` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `property_amenities`
--

DROP TABLE IF EXISTS `property_amenities`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `property_amenities` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `property_id` bigint(20) unsigned NOT NULL,
  `amenity_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `property_amenities_property_id_foreign` (`property_id`),
  CONSTRAINT `property_amenities_property_id_foreign` FOREIGN KEY (`property_id`) REFERENCES `properties` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=92 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `property_amenities`
--

LOCK TABLES `property_amenities` WRITE;
/*!40000 ALTER TABLE `property_amenities` DISABLE KEYS */;
INSERT INTO `property_amenities` VALUES (62,2,2,'2023-08-29 01:20:30','2023-08-29 01:20:30'),(63,2,4,'2023-08-29 01:20:30','2023-08-29 01:20:30'),(64,2,9,'2023-08-29 01:20:30','2023-08-29 01:20:30'),(65,2,19,'2023-08-29 01:20:30','2023-08-29 01:20:30'),(66,2,14,'2023-08-29 01:20:30','2023-08-29 01:20:30'),(67,2,17,'2023-08-29 01:20:30','2023-08-29 01:20:30'),(68,2,20,'2023-08-29 01:20:30','2023-08-29 01:20:30'),(69,2,24,'2023-08-29 01:20:30','2023-08-29 01:20:30'),(70,2,23,'2023-08-29 01:20:30','2023-08-29 01:20:30'),(71,2,22,'2023-08-29 01:20:30','2023-08-29 01:20:30'),(72,1,49,'2023-08-30 20:16:35','2023-08-30 20:16:35'),(73,1,50,'2023-08-30 20:16:35','2023-08-30 20:16:35'),(74,1,51,'2023-08-30 20:16:35','2023-08-30 20:16:35'),(75,1,52,'2023-08-30 20:16:35','2023-08-30 20:16:35'),(76,1,53,'2023-08-30 20:16:35','2023-08-30 20:16:35'),(77,1,55,'2023-08-30 20:16:35','2023-08-30 20:16:35'),(78,1,56,'2023-08-30 20:16:35','2023-08-30 20:16:35'),(79,1,57,'2023-08-30 20:16:36','2023-08-30 20:16:36'),(80,1,58,'2023-08-30 20:16:36','2023-08-30 20:16:36'),(81,1,60,'2023-08-30 20:16:36','2023-08-30 20:16:36'),(82,1,61,'2023-08-30 20:16:36','2023-08-30 20:16:36'),(83,1,62,'2023-08-30 20:16:36','2023-08-30 20:16:36'),(84,1,63,'2023-08-30 20:16:36','2023-08-30 20:16:36'),(85,1,64,'2023-08-30 20:16:36','2023-08-30 20:16:36'),(86,1,65,'2023-08-30 20:16:36','2023-08-30 20:16:36'),(87,1,78,'2023-08-30 20:16:36','2023-08-30 20:16:36'),(88,1,5,'2023-08-30 20:16:36','2023-08-30 20:16:36'),(89,1,10,'2023-08-30 20:16:36','2023-08-30 20:16:36'),(90,1,27,'2023-08-30 20:16:36','2023-08-30 20:16:36'),(91,1,15,'2023-08-30 20:16:36','2023-08-30 20:16:36');
/*!40000 ALTER TABLE `property_amenities` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `property_documents`
--

DROP TABLE IF EXISTS `property_documents`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `property_documents` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `property_id` bigint(20) unsigned NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `file_name` varchar(512) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `property_documents_property_id_foreign` (`property_id`),
  CONSTRAINT `property_documents_property_id_foreign` FOREIGN KEY (`property_id`) REFERENCES `properties` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `property_documents`
--

LOCK TABLES `property_documents` WRITE;
/*!40000 ALTER TABLE `property_documents` DISABLE KEYS */;
INSERT INTO `property_documents` VALUES (1,1,'Martis Camp Beach Shack.pdf','http://realtyinterface.s3.amazonaws.com/property_documents/fTzBVfQE533kDny2lZ6lsgCcXCFb0QguDuMJQDv1.pdf','2023-08-07 15:32:43','2023-08-07 15:35:27'),(2,1,'Tom Fazio Golf.pdf','http://realtyinterface.s3.amazonaws.com/property_documents/JgagzqDX9d7mxuxPPIHrF7m6eG9amcgPVPMJRpp5.pdf','2023-08-07 15:32:44','2023-08-07 15:34:46'),(3,1,'Private Ski Connection.pdf','http://realtyinterface.s3.amazonaws.com/property_documents/wNnJpX1iHKO7yAqg9DrovvfLOw19sWY8bipVY6nR.pdf','2023-08-07 15:32:48','2023-08-07 15:36:34'),(4,1,'Lost Library.pdf','http://realtyinterface.s3.amazonaws.com/property_documents/Wm0sILCNBrJSMXjLqcX0IwvVy5d8WrLQRWgrWlIx.pdf','2023-08-07 15:32:51','2023-08-07 15:37:27'),(5,1,'Camp Lodge.pdf','http://realtyinterface.s3.amazonaws.com/property_documents/qhQKwytAQ36xvgQUoI8sC61CX8ZM8WhNbNkBfHKE.pdf','2023-08-07 15:32:57','2023-08-07 15:37:53'),(6,1,'Family Barn.pdf','http://realtyinterface.s3.amazonaws.com/property_documents/NTKWTv0WmC51RUWPLwRtHGr2P27AVFHotyrRM7RN.pdf','2023-08-07 15:32:57','2023-08-07 15:38:58');
/*!40000 ALTER TABLE `property_documents` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `property_floorplan_images`
--

DROP TABLE IF EXISTS `property_floorplan_images`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `property_floorplan_images` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `property_id` bigint(20) unsigned NOT NULL,
  `property_floorplan_id` bigint(20) unsigned NOT NULL,
  `property_image_id` int(10) unsigned NOT NULL,
  `coordinates` varchar(50) NOT NULL,
  `floorplan_image_ratio` varchar(50) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `property_floorplan_images_property_floorplan_id_foreign` (`property_floorplan_id`),
  KEY `property_image_id` (`property_image_id`),
  CONSTRAINT `property_floorplan_images_ibfk_1` FOREIGN KEY (`property_image_id`) REFERENCES `property_images` (`id`),
  CONSTRAINT `property_floorplan_images_property_floorplan_id_foreign` FOREIGN KEY (`property_floorplan_id`) REFERENCES `property_floorplans` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=38 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `property_floorplan_images`
--

LOCK TABLES `property_floorplan_images` WRITE;
/*!40000 ALTER TABLE `property_floorplan_images` DISABLE KEYS */;
INSERT INTO `property_floorplan_images` VALUES (18,1,2,39,'494,338','640,913','2023-08-07 15:47:17','2023-08-07 15:47:17'),(19,1,2,36,'300,263','640,913','2023-08-07 15:47:36','2023-08-07 15:47:36'),(20,1,3,79,'452,177','930,913','2023-08-07 15:50:44','2023-08-07 15:50:44'),(21,1,1,2,'385,376','633,832','2023-08-17 21:11:49','2023-08-17 21:11:49'),(22,1,1,8,'500,73','633,832','2023-08-17 21:12:08','2023-08-17 21:12:08'),(23,1,1,9,'381,34','633,832','2023-08-17 21:12:12','2023-08-17 21:12:12'),(24,1,1,10,'772,533','633,832','2023-08-17 21:12:22','2023-08-17 21:12:22'),(25,1,1,17,'465,332','633,832','2023-08-17 21:13:01','2023-08-17 21:13:01'),(26,1,1,18,'418,235','633,832','2023-08-17 21:13:07','2023-08-17 21:13:07'),(27,1,1,20,'380,270','633,832','2023-08-17 21:13:14','2023-08-17 21:13:14'),(28,1,1,19,'332,321','633,832','2023-08-17 21:13:19','2023-08-17 21:13:19'),(29,1,1,24,'323,246','633,832','2023-08-17 21:13:28','2023-08-17 21:13:28'),(30,1,1,26,'256,239','633,832','2023-08-17 21:13:33','2023-08-17 21:13:33'),(31,1,1,29,'776,114','633,832','2023-08-17 21:13:45','2023-08-17 21:13:45'),(32,1,1,27,'161,278','633,832','2023-08-17 21:13:55','2023-08-17 21:13:55'),(33,1,1,28,'660,54','633,832','2023-08-17 21:14:03','2023-08-17 21:14:03'),(34,1,1,30,'589,452','633,832','2023-08-17 21:14:09','2023-08-17 21:14:09'),(35,1,1,31,'742,429','633,832','2023-08-17 21:14:14','2023-08-17 21:14:14'),(36,1,1,34,'59,224','568,745','2023-08-28 16:40:39','2023-08-28 16:40:39'),(37,1,1,32,'825,224','692,911','2023-08-30 20:19:43','2023-08-30 20:19:43');
/*!40000 ALTER TABLE `property_floorplan_images` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `property_floorplans`
--

DROP TABLE IF EXISTS `property_floorplans`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `property_floorplans` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `property_id` bigint(20) unsigned NOT NULL,
  `name` varchar(100) NOT NULL,
  `file_name` varchar(512) NOT NULL,
  `thumb` varchar(255) DEFAULT NULL,
  `sequence` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `property_floorplans_property_id_foreign` (`property_id`),
  CONSTRAINT `property_floorplans_property_id_foreign` FOREIGN KEY (`property_id`) REFERENCES `properties` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `property_floorplans`
--

LOCK TABLES `property_floorplans` WRITE;
/*!40000 ALTER TABLE `property_floorplans` DISABLE KEYS */;
INSERT INTO `property_floorplans` VALUES (1,1,'Main Level','http://realtyinterface.s3.amazonaws.com/property_floorplans/mainlevel_1691265121.jpg','http://realtyinterface.s3.amazonaws.com/property_floorplans_thumb/mainlevel_1691265122.jpg',1,'2023-08-05 19:52:02','2023-08-09 17:15:50'),(2,1,'Upper Level','http://realtyinterface.s3.amazonaws.com/property_floorplans/upperlevel_1691423146.jpg','http://realtyinterface.s3.amazonaws.com/property_floorplans_thumb/upperlevel_1691423146.jpg',2,'2023-08-07 15:45:46','2023-08-07 15:46:00'),(3,1,'Lower and Garage','http://realtyinterface.s3.amazonaws.com/property_floorplans/lowerlevel_1691423407.jpg','http://realtyinterface.s3.amazonaws.com/property_floorplans_thumb/lowerlevel_1691423408.jpg',3,'2023-08-07 15:50:08','2023-08-09 17:27:09');
/*!40000 ALTER TABLE `property_floorplans` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `property_galleries`
--

DROP TABLE IF EXISTS `property_galleries`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `property_galleries` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `property_id` bigint(20) unsigned NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `short_description` varchar(255) DEFAULT NULL,
  `active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `property_galleries_property_id_foreign` (`property_id`),
  CONSTRAINT `property_galleries_property_id_foreign` FOREIGN KEY (`property_id`) REFERENCES `properties` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `property_galleries`
--

LOCK TABLES `property_galleries` WRITE;
/*!40000 ALTER TABLE `property_galleries` DISABLE KEYS */;
INSERT INTO `property_galleries` VALUES (1,1,'Exteriors','Over 4,000 square feet of space unfolds across five bedrooms and five and a half bathrooms, with opulent shared spaces and amenities. A truly rare opportunity!',1,'2023-08-05 19:49:22','2023-08-08 02:39:20'),(2,1,'Main Living Level','In the great room, tall Weiland pocket glass doors on opposing sides of the room disappear, ushering in to the great room, breakfast nook, kitchen and dining room.   There’s a soaring fireplace calling out from the corner of the great room.',1,'2023-08-05 22:26:47','2023-08-05 22:26:47'),(3,1,'Upper Level','Featured on the upper level is a theater room, recreation area and family room. with it\'s own deck and hot tub.',1,'2023-08-05 23:26:00','2023-08-06 00:03:40'),(4,1,'Lower Level','Featured on the upper level is a theater room, recreation area and family room. with it\'s own deck and hot tub.',1,'2023-08-06 00:07:55','2023-08-06 00:07:55'),(5,1,'Dream Garage','A dream garage  is a 4,700 sq ft custom built (heated/insulated) toy shop. It comes complete with separate office, clean room and main work area and 3 PhantomPark 2-deck subterranean parking systems. The main shop area can hold 12+ cars and toys.',1,'2023-08-06 00:49:02','2023-08-07 15:07:45'),(6,2,'Dream Garage','Squarespace offers straightforward payment and checkout options for your customers. Take online payments with Stripe, Paypal, Apple Pay, and Afterpay (Afterpay is available in the US, Canada, Australia, and New Zealand).',1,'2023-08-29 01:24:10','2023-08-29 01:24:10');
/*!40000 ALTER TABLE `property_galleries` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `property_gallery_images`
--

DROP TABLE IF EXISTS `property_gallery_images`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `property_gallery_images` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `gallery_id` bigint(20) unsigned NOT NULL,
  `property_image_id` int(10) unsigned NOT NULL,
  `featured_image` bigint(20) NOT NULL DEFAULT 0,
  `sequence` int(10) unsigned NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `property_gallery_images_gallery_id_foreign` (`gallery_id`),
  CONSTRAINT `property_gallery_images_gallery_id_foreign` FOREIGN KEY (`gallery_id`) REFERENCES `property_galleries` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=292 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `property_gallery_images`
--

LOCK TABLES `property_gallery_images` WRITE;
/*!40000 ALTER TABLE `property_gallery_images` DISABLE KEYS */;
INSERT INTO `property_gallery_images` VALUES (106,3,39,1,1,'2023-08-06 00:06:28','2023-08-30 20:18:20'),(107,3,37,0,2,'2023-08-06 00:06:28','2023-08-06 00:06:28'),(108,3,40,0,3,'2023-08-06 00:06:28','2023-08-06 00:06:28'),(109,3,29,0,4,'2023-08-06 00:06:28','2023-08-06 00:06:28'),(110,3,31,0,5,'2023-08-06 00:06:28','2023-08-06 00:06:28'),(111,3,42,0,6,'2023-08-06 00:06:28','2023-08-06 00:06:28'),(112,3,36,0,7,'2023-08-06 00:06:28','2023-08-06 00:06:28'),(220,5,72,0,1,'2023-08-07 15:07:45','2023-08-07 15:07:45'),(221,5,78,0,2,'2023-08-07 15:07:45','2023-08-28 16:39:17'),(222,5,79,1,3,'2023-08-07 15:07:45','2023-08-30 20:18:32'),(223,5,83,0,4,'2023-08-07 15:07:45','2023-08-30 20:18:32'),(224,5,75,0,5,'2023-08-07 15:07:45','2023-08-07 15:07:45'),(225,5,52,0,6,'2023-08-07 15:07:45','2023-08-07 15:07:45'),(226,5,82,0,7,'2023-08-07 15:07:45','2023-08-07 15:07:45'),(227,5,80,0,8,'2023-08-07 15:07:45','2023-08-07 15:07:45'),(228,5,84,0,9,'2023-08-07 15:07:45','2023-08-07 15:07:45'),(229,5,76,0,10,'2023-08-07 15:07:45','2023-08-07 15:07:45'),(230,5,57,0,11,'2023-08-07 15:07:45','2023-08-07 15:07:45'),(231,5,58,0,12,'2023-08-07 15:07:45','2023-08-07 15:07:45'),(232,5,74,0,13,'2023-08-07 15:07:45','2023-08-07 15:07:45'),(233,5,59,0,14,'2023-08-07 15:07:45','2023-08-07 15:07:45'),(234,5,62,0,15,'2023-08-07 15:07:45','2023-08-07 15:07:45'),(235,5,73,0,16,'2023-08-07 15:07:45','2023-08-07 15:07:45'),(236,5,61,0,17,'2023-08-07 15:07:45','2023-08-07 15:07:45'),(237,5,63,0,18,'2023-08-07 15:07:45','2023-08-07 15:07:45'),(238,5,64,0,19,'2023-08-07 15:07:45','2023-08-07 15:07:45'),(239,5,68,0,20,'2023-08-07 15:07:45','2023-08-07 15:07:45'),(240,4,85,1,1,'2023-08-08 02:37:02','2023-08-30 20:18:25'),(241,4,45,0,2,'2023-08-08 02:37:02','2023-08-08 02:37:02'),(242,4,46,0,3,'2023-08-08 02:37:02','2023-08-08 02:37:02'),(243,4,47,0,4,'2023-08-08 02:37:02','2023-08-08 02:37:02'),(244,4,28,0,5,'2023-08-08 02:37:02','2023-08-08 02:37:02'),(245,4,43,0,6,'2023-08-08 02:37:02','2023-08-08 02:37:02'),(246,4,44,0,7,'2023-08-08 02:37:02','2023-08-08 02:37:02'),(247,1,4,1,1,'2023-08-08 02:39:20','2023-08-28 16:38:54'),(248,1,1,0,2,'2023-08-08 02:39:20','2023-08-08 02:39:20'),(249,1,2,0,3,'2023-08-08 02:39:20','2023-08-08 02:39:20'),(250,1,6,0,4,'2023-08-08 02:39:20','2023-08-08 02:39:20'),(251,1,9,0,5,'2023-08-08 02:39:20','2023-08-08 02:39:20'),(252,1,11,0,6,'2023-08-08 02:39:20','2023-08-08 02:39:20'),(253,1,10,0,7,'2023-08-08 02:39:20','2023-08-08 02:39:20'),(254,1,3,0,8,'2023-08-08 02:39:20','2023-08-08 02:39:20'),(255,1,8,0,9,'2023-08-08 02:39:20','2023-08-08 02:39:20'),(256,1,7,0,10,'2023-08-08 02:39:20','2023-08-08 02:39:20'),(257,1,5,0,11,'2023-08-08 02:39:20','2023-08-08 02:39:20'),(258,6,86,0,1,'2023-08-29 01:24:10','2023-08-29 01:24:10'),(259,6,90,1,2,'2023-08-29 01:24:10','2023-08-29 01:24:20'),(260,6,87,0,3,'2023-08-29 01:24:10','2023-08-29 01:24:10'),(261,6,93,0,4,'2023-08-29 01:24:10','2023-08-29 01:24:10'),(262,6,92,0,5,'2023-08-29 01:24:10','2023-08-29 01:24:10'),(263,6,91,0,6,'2023-08-29 01:24:10','2023-08-29 01:24:10'),(264,6,89,0,7,'2023-08-29 01:24:10','2023-08-29 01:24:10'),(265,6,88,0,8,'2023-08-29 01:24:10','2023-08-29 01:24:10'),(266,6,94,0,9,'2023-08-29 01:24:10','2023-08-29 01:24:10'),(267,6,95,0,10,'2023-08-29 01:24:10','2023-08-29 01:24:10'),(268,6,98,0,11,'2023-08-29 01:24:10','2023-08-29 01:24:10'),(269,6,96,0,12,'2023-08-29 01:24:10','2023-08-29 01:24:10'),(270,6,100,0,13,'2023-08-29 01:24:10','2023-08-29 01:24:10'),(271,6,97,0,14,'2023-08-29 01:24:10','2023-08-29 01:24:10'),(272,6,102,0,15,'2023-08-29 01:24:10','2023-08-29 01:24:10'),(273,6,101,0,16,'2023-08-29 01:24:10','2023-08-29 01:24:10'),(274,6,103,0,17,'2023-08-29 01:24:10','2023-08-29 01:24:10'),(275,6,99,0,18,'2023-08-29 01:24:10','2023-08-29 01:24:10'),(276,2,24,1,1,'2023-08-30 20:17:46','2023-08-30 20:18:14'),(277,2,17,0,2,'2023-08-30 20:17:46','2023-08-30 20:17:46'),(278,2,18,0,3,'2023-08-30 20:17:46','2023-08-30 20:17:46'),(279,2,23,0,4,'2023-08-30 20:17:46','2023-08-30 20:17:46'),(280,2,22,0,5,'2023-08-30 20:17:46','2023-08-30 20:17:46'),(281,2,20,0,6,'2023-08-30 20:17:46','2023-08-30 20:17:46'),(282,2,19,0,7,'2023-08-30 20:17:46','2023-08-30 20:17:46'),(283,2,21,0,8,'2023-08-30 20:17:46','2023-08-30 20:17:46'),(284,2,27,0,9,'2023-08-30 20:17:46','2023-08-30 20:17:46'),(285,2,26,0,10,'2023-08-30 20:17:46','2023-08-30 20:17:46'),(286,2,30,0,11,'2023-08-30 20:17:46','2023-08-30 20:17:46'),(287,2,29,0,12,'2023-08-30 20:17:46','2023-08-30 20:17:46'),(288,2,28,0,13,'2023-08-30 20:17:46','2023-08-30 20:17:46'),(289,2,31,0,14,'2023-08-30 20:17:46','2023-08-30 20:17:46'),(290,2,32,0,15,'2023-08-30 20:17:46','2023-08-30 20:17:46'),(291,2,8,0,16,'2023-08-30 20:17:46','2023-08-30 20:17:46');
/*!40000 ALTER TABLE `property_gallery_images` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `property_images`
--

DROP TABLE IF EXISTS `property_images`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `property_images` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `property_id` bigint(20) unsigned NOT NULL,
  `file_name` varchar(512) NOT NULL,
  `thumb` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `property_images_property_id_foreign` (`property_id`),
  CONSTRAINT `property_images_property_id_foreign` FOREIGN KEY (`property_id`) REFERENCES `properties` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=104 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `property_images`
--

LOCK TABLES `property_images` WRITE;
/*!40000 ALTER TABLE `property_images` DISABLE KEYS */;
INSERT INTO `property_images` VALUES (1,1,'http://realtyinterface.s3.amazonaws.com/property_images/dblupeOmne5aGGGA4pPD3YYtvCDvbQf0R8P1TKM8.jpg','http://realtyinterface.s3.amazonaws.com/property_images_thumb/back1_1691264765.jpg','2023-08-05 19:46:05','2023-08-05 19:46:05'),(2,1,'http://realtyinterface.s3.amazonaws.com/property_images/rD8NL5DqbHAdZHxbU5wz2ro7QvReO3NoEvSaaody.jpg','http://realtyinterface.s3.amazonaws.com/property_images_thumb/firepitfront_1691264767.jpg','2023-08-05 19:46:07','2023-08-05 19:46:07'),(3,1,'http://realtyinterface.s3.amazonaws.com/property_images/bsCoZhDXsRjBuyWdSRtE4ShgtPGEtut1ZfK9tPz1.jpg','http://realtyinterface.s3.amazonaws.com/property_images_thumb/back2_1691264767.jpg','2023-08-05 19:46:07','2023-08-05 19:46:07'),(4,1,'http://realtyinterface.s3.amazonaws.com/property_images/5DN3NZAzj6IVunzwwYz4XoMRt8iTzSeGshxvIUEp.jpg','http://realtyinterface.s3.amazonaws.com/property_images_thumb/front2_1691264768.jpg','2023-08-05 19:46:08','2023-08-05 19:46:08'),(5,1,'http://realtyinterface.s3.amazonaws.com/property_images/0yjMVaX8xOensCPWNimcdJub5nPmREOMwq9Uw24T.jpg','http://realtyinterface.s3.amazonaws.com/property_images_thumb/front1_1691264771.jpg','2023-08-05 19:46:11','2023-08-05 19:46:11'),(6,1,'http://realtyinterface.s3.amazonaws.com/property_images/DJ1r8usaa5iRPvMEJ7eEYk0zNmb0umjVFn2vE7t8.jpg','http://realtyinterface.s3.amazonaws.com/property_images_thumb/front3_1691264772.jpg','2023-08-05 19:46:12','2023-08-05 19:46:12'),(7,1,'http://realtyinterface.s3.amazonaws.com/property_images/imnto1EiNZDVzG1trVFaLgzGySN7wRwIUOmqK02I.jpg','http://realtyinterface.s3.amazonaws.com/property_images_thumb/longdriveway_1691264772.jpg','2023-08-05 19:46:13','2023-08-05 19:46:13'),(8,1,'http://realtyinterface.s3.amazonaws.com/property_images/4ebzLD8oSHnEnJa1jIEeSAtVFXRgIY1PMwXheYf3.jpg','http://realtyinterface.s3.amazonaws.com/property_images_thumb/1deck_1691264796.jpg','2023-08-05 19:46:37','2023-08-05 19:46:37'),(9,1,'http://realtyinterface.s3.amazonaws.com/property_images/EPp1awzwNpYEoCUfPZNWcfE40IolH0hNLJ4TZ9RA.jpg','http://realtyinterface.s3.amazonaws.com/property_images_thumb/2deck_1691264796.jpg','2023-08-05 19:46:37','2023-08-05 19:46:37'),(10,1,'http://realtyinterface.s3.amazonaws.com/property_images/D9njWMRC11S8JAIz63cGl3VGdYl5exmIcMcAHzKZ.jpg','http://realtyinterface.s3.amazonaws.com/property_images_thumb/5hottub-deck_1691264798.jpg','2023-08-05 19:46:38','2023-08-05 19:46:38'),(11,1,'http://realtyinterface.s3.amazonaws.com/property_images/eYPojASIyhBhGbHNMbHJjd4YiF9EheEdIzSGP9rF.jpg','http://realtyinterface.s3.amazonaws.com/property_images_thumb/fireplace_1691264798.jpg','2023-08-05 19:46:38','2023-08-05 19:46:38'),(17,1,'http://realtyinterface.s3.amazonaws.com/property_images/lIqmx1FhIoTgBQb0dGS3TnEXpAn0DZIHEgYvfjGv.jpg','http://realtyinterface.s3.amazonaws.com/property_images_thumb/2_1691274480.jpg','2023-08-05 22:28:00','2023-08-05 22:28:00'),(18,1,'http://realtyinterface.s3.amazonaws.com/property_images/qfNxQTf0poJDGyaZmKYni65nvtvQRnwoaz9GZQEj.jpg','http://realtyinterface.s3.amazonaws.com/property_images_thumb/1_1691274480.jpg','2023-08-05 22:28:00','2023-08-05 22:28:00'),(19,1,'http://realtyinterface.s3.amazonaws.com/property_images/OkZSTvanrgxELWjzrxyXXkDwYY8lSgTuR9d8pJti.jpg','http://realtyinterface.s3.amazonaws.com/property_images_thumb/3_1691274481.jpg','2023-08-05 22:28:02','2023-08-05 22:28:02'),(20,1,'http://realtyinterface.s3.amazonaws.com/property_images/BiwhiSEDsLToO4RqRxNUk1p47EiecP0kblUYqCl2.jpg','http://realtyinterface.s3.amazonaws.com/property_images_thumb/4_1691274482.jpg','2023-08-05 22:28:02','2023-08-05 22:28:02'),(21,1,'http://realtyinterface.s3.amazonaws.com/property_images/40fOCAfqXo2ZxVClLZcNHvsnBASOJ7u25BaMdGzB.jpg','http://realtyinterface.s3.amazonaws.com/property_images_thumb/5_1691274483.jpg','2023-08-05 22:28:03','2023-08-05 22:28:03'),(22,1,'http://realtyinterface.s3.amazonaws.com/property_images/c0nUT1XZhgOdNyI72qHprYfsM2iEX0FIimUoa0rf.jpg','http://realtyinterface.s3.amazonaws.com/property_images_thumb/6_1691274483.jpg','2023-08-05 22:28:03','2023-08-05 22:28:03'),(23,1,'http://realtyinterface.s3.amazonaws.com/property_images/wpYPcJMI5EFy4r2Zeg7fcJWsY70NubCK1WNiVm4k.jpg','http://realtyinterface.s3.amazonaws.com/property_images_thumb/7_1691274484.jpg','2023-08-05 22:28:04','2023-08-05 22:28:04'),(24,1,'http://realtyinterface.s3.amazonaws.com/property_images/w8Vd27tQ0S0rsr8X7LijtsM2zk0OAM0FrdxK6WdW.jpg','http://realtyinterface.s3.amazonaws.com/property_images_thumb/use_1691274622.jpg','2023-08-05 22:30:22','2023-08-05 22:30:22'),(26,1,'http://realtyinterface.s3.amazonaws.com/property_images/fLDj0lrw2nU8UBE7REfbWmsRxWjodMADaSU3mxne.jpg','http://realtyinterface.s3.amazonaws.com/property_images_thumb/1_1691275171.jpg','2023-08-05 22:39:31','2023-08-05 22:39:31'),(27,1,'http://realtyinterface.s3.amazonaws.com/property_images/Vrbnto5OgEVDZ8HMtoao16SfqVWlTajXak8pCm9p.jpg','http://realtyinterface.s3.amazonaws.com/property_images_thumb/2_1691275171.jpg','2023-08-05 22:39:31','2023-08-05 22:39:31'),(28,1,'http://realtyinterface.s3.amazonaws.com/property_images/28hyBIiPMJJYwRUvRvJbtwS80M13mNcTVaha2wDu.jpg','http://realtyinterface.s3.amazonaws.com/property_images_thumb/2_1691277565.jpg','2023-08-05 23:19:26','2023-08-05 23:19:26'),(29,1,'http://realtyinterface.s3.amazonaws.com/property_images/doBEwQtJ6OijVCctLJmq51CRtXkKrKLAkxhNi2XK.jpg','http://realtyinterface.s3.amazonaws.com/property_images_thumb/1_1691277566.jpg','2023-08-05 23:19:26','2023-08-05 23:19:26'),(30,1,'http://realtyinterface.s3.amazonaws.com/property_images/H5mJtoTaf5J9gLd6eadlePJt776I8aPNfFxGphOl.jpg','http://realtyinterface.s3.amazonaws.com/property_images_thumb/3_1691277567.jpg','2023-08-05 23:19:27','2023-08-05 23:19:27'),(31,1,'http://realtyinterface.s3.amazonaws.com/property_images/7NFAYDYNu36yaFOrJZCO1hEYlWpIwMFNfdwoFaFe.jpg','http://realtyinterface.s3.amazonaws.com/property_images_thumb/4_1691277567.jpg','2023-08-05 23:19:27','2023-08-05 23:19:27'),(32,1,'http://realtyinterface.s3.amazonaws.com/property_images/CAF3TUe9qwYQqdEag74cYl9RLWbqlCwjRGgiVQIa.jpg','http://realtyinterface.s3.amazonaws.com/property_images_thumb/6_1691277568.jpg','2023-08-05 23:19:28','2023-08-05 23:19:28'),(33,1,'http://realtyinterface.s3.amazonaws.com/property_images/tWI4s888aoEUUPgH5OTyK9GPkSZ4NEDUHO9mzzQc.jpg','http://realtyinterface.s3.amazonaws.com/property_images_thumb/5_1691277568.jpg','2023-08-05 23:19:28','2023-08-05 23:19:28'),(34,1,'http://realtyinterface.s3.amazonaws.com/property_images/PHEtHh1HUWDM4AXBtx8E2FHLOAynObCYEVKTKfhd.jpg','http://realtyinterface.s3.amazonaws.com/property_images_thumb/7_1691277569.jpg','2023-08-05 23:19:29','2023-08-05 23:19:29'),(35,1,'http://realtyinterface.s3.amazonaws.com/property_images/HRBFJAMAdOTMUtTTQ8jXOYvXqyqWkGisWdSswtYs.jpg','http://realtyinterface.s3.amazonaws.com/property_images_thumb/8_1691277569.jpg','2023-08-05 23:19:29','2023-08-05 23:19:29'),(36,1,'http://realtyinterface.s3.amazonaws.com/property_images/alOpypnHBfZudVbGlDnuSzZUc7McLQBhNGdCbqXI.jpg','http://realtyinterface.s3.amazonaws.com/property_images_thumb/9_1691277570.jpg','2023-08-05 23:19:30','2023-08-05 23:19:30'),(37,1,'http://realtyinterface.s3.amazonaws.com/property_images/vv0lvokNJXoliWpzCPlTjylvEyrq2y3wEWmkvPeP.jpg','http://realtyinterface.s3.amazonaws.com/property_images_thumb/1_1691277991.jpg','2023-08-05 23:26:32','2023-08-05 23:26:32'),(39,1,'http://realtyinterface.s3.amazonaws.com/property_images/hHexhlca04Up90qMGQBP5XXWFqef0v7VOTMT2FqG.jpg','http://realtyinterface.s3.amazonaws.com/property_images_thumb/billiard_1691277993.jpg','2023-08-05 23:26:33','2023-08-05 23:26:33'),(40,1,'http://realtyinterface.s3.amazonaws.com/property_images/AbtVo6xobrzwWDC2c2U35V2j5cpPRJsOCfv3oN2w.jpg','http://realtyinterface.s3.amazonaws.com/property_images_thumb/theater_1691277993.jpg','2023-08-05 23:26:33','2023-08-05 23:26:33'),(41,1,'http://realtyinterface.s3.amazonaws.com/property_images/edNfxt9Rk0IaS45ppohnwhzKldpgn0bTmooS7QDI.jpg','http://realtyinterface.s3.amazonaws.com/property_images_thumb/pinballUSE_1691278111.jpg','2023-08-05 23:28:31','2023-08-05 23:28:31'),(42,1,'http://realtyinterface.s3.amazonaws.com/property_images/ob2htOKt8vF9qeMZXbOS04Mxpqzf8IvYW0j5az6H.jpg','http://realtyinterface.s3.amazonaws.com/property_images_thumb/upperhottub_1691280318.jpg','2023-08-06 00:05:18','2023-08-06 00:05:18'),(43,1,'http://realtyinterface.s3.amazonaws.com/property_images/e2Gkc9xmYFORiT5JALeNkJhyK11vasI3QDfPvpnZ.jpg','http://realtyinterface.s3.amazonaws.com/property_images_thumb/lowerspa_1691280823.jpg','2023-08-06 00:13:44','2023-08-06 00:13:44'),(44,1,'http://realtyinterface.s3.amazonaws.com/property_images/GwE6ticX7JYNOS4WfJnsb3hN7b3nxm39SJiI35qc.jpg','http://realtyinterface.s3.amazonaws.com/property_images_thumb/lowersteam_1691280824.jpg','2023-08-06 00:13:44','2023-08-06 00:13:44'),(45,1,'http://realtyinterface.s3.amazonaws.com/property_images/gRcB8krjCKzlMMhM80GX2sfZAakOQ30C2gkltBxh.jpg','http://realtyinterface.s3.amazonaws.com/property_images_thumb/bath_1691280850.jpg','2023-08-06 00:14:10','2023-08-06 00:14:10'),(46,1,'http://realtyinterface.s3.amazonaws.com/property_images/MP3hpXgUTKXt9faBXrIDEwML839E4JWkpQDdcYOo.jpg','http://realtyinterface.s3.amazonaws.com/property_images_thumb/bedroom1_1691280850.jpg','2023-08-06 00:14:10','2023-08-06 00:14:10'),(47,1,'http://realtyinterface.s3.amazonaws.com/property_images/5NzXL2PmSjzHDudCMGjywfTIddPujauVCdfAWk6t.jpg','http://realtyinterface.s3.amazonaws.com/property_images_thumb/bedroom2_1691280851.jpg','2023-08-06 00:14:11','2023-08-06 00:14:11'),(48,1,'http://realtyinterface.s3.amazonaws.com/property_images/YOzPI9O3AvWtMhVdiv39o678f3ACgEvZK4leNbAJ.jpg','http://realtyinterface.s3.amazonaws.com/property_images_thumb/bunk_1691280851.jpg','2023-08-06 00:14:12','2023-08-06 00:14:12'),(49,1,'http://realtyinterface.s3.amazonaws.com/property_images/LXozCfEJXPH6tUGCYWIjv0KsqhB69I38vyXNdxQW.jpg','http://realtyinterface.s3.amazonaws.com/property_images_thumb/bunkbath_1691280852.jpg','2023-08-06 00:14:12','2023-08-06 00:14:12'),(52,1,'http://realtyinterface.s3.amazonaws.com/property_images/NucFEfWxMVeuuZEwll2uaFEotGGTnpOHqo5f2meo.jpg','http://realtyinterface.s3.amazonaws.com/property_images_thumb/gar4_1691282711.jpg','2023-08-06 00:45:11','2023-08-06 00:45:11'),(57,1,'http://realtyinterface.s3.amazonaws.com/property_images/SdoneNdPhFH0p8thu05iI9cB67CN0nsdFUNtRmnj.jpg','http://realtyinterface.s3.amazonaws.com/property_images_thumb/gar8_1691282713.jpg','2023-08-06 00:45:14','2023-08-06 00:45:14'),(58,1,'http://realtyinterface.s3.amazonaws.com/property_images/qSYs2d2GIFtzHTx8wBmikUNzDQENVFI0nDYj8PIi.jpg','http://realtyinterface.s3.amazonaws.com/property_images_thumb/gar9_1691282714.jpg','2023-08-06 00:45:14','2023-08-06 00:45:14'),(59,1,'http://realtyinterface.s3.amazonaws.com/property_images/N7KuqOoIDmIvbpBwiqumRAeopY5ToEpOiFkYmVG2.jpg','http://realtyinterface.s3.amazonaws.com/property_images_thumb/gar10_1691282714.jpg','2023-08-06 00:45:14','2023-08-06 00:45:14'),(61,1,'http://realtyinterface.s3.amazonaws.com/property_images/H74ec3UgvlKELCJVCrLungFHGYJUfygE62r0QWFr.jpg','http://realtyinterface.s3.amazonaws.com/property_images_thumb/gar12_1691282715.jpg','2023-08-06 00:45:15','2023-08-06 00:45:15'),(62,1,'http://realtyinterface.s3.amazonaws.com/property_images/pUOxBKnmWYkneEO25UIrZucJ5tXkLGtDzCeBq6zg.jpg','http://realtyinterface.s3.amazonaws.com/property_images_thumb/gar13_1691282716.jpg','2023-08-06 00:45:16','2023-08-06 00:45:16'),(63,1,'http://realtyinterface.s3.amazonaws.com/property_images/Dpl9MNH99nEl66ND5EuuLITTQkVMbReAcua6YEiz.jpg','http://realtyinterface.s3.amazonaws.com/property_images_thumb/gar14_1691282716.jpg','2023-08-06 00:45:16','2023-08-06 00:45:16'),(64,1,'http://realtyinterface.s3.amazonaws.com/property_images/qJIVb83N3HvXO41gWKFS394JEQ59WHIDWO2dzjGs.jpg','http://realtyinterface.s3.amazonaws.com/property_images_thumb/gar15_1691282717.jpg','2023-08-06 00:45:17','2023-08-06 00:45:17'),(68,1,'http://realtyinterface.s3.amazonaws.com/property_images/JtfJp26XKHYSNPy8RUWJcXYNnyIo4pSpk4J0pscA.jpg','http://realtyinterface.s3.amazonaws.com/property_images_thumb/garage4_1691282719.jpg','2023-08-06 00:45:19','2023-08-06 00:45:19'),(70,1,'http://realtyinterface.s3.amazonaws.com/property_images/B5Q6kjxs9YdDZwQjAIIaQ8I7oR8GKKdSSoPuBpc8.jpg','http://realtyinterface.s3.amazonaws.com/property_images_thumb/boat_1691283184.jpg','2023-08-06 00:53:04','2023-08-06 00:53:04'),(71,1,'http://realtyinterface.s3.amazonaws.com/property_images/zVpiSLSqQZBdQjFSTTrqS8EU8eHzro5o7K6SUFh0.jpg','http://realtyinterface.s3.amazonaws.com/property_images_thumb/newhome_1691284841.jpg','2023-08-06 01:20:42','2023-08-06 01:20:42'),(72,1,'http://realtyinterface.s3.amazonaws.com/property_images/dyBf5JO79sZUJYa9NqY3mYKXHmS4SQMl1aEihsec.jpg','http://realtyinterface.s3.amazonaws.com/property_images_thumb/boat_1691419982.jpg','2023-08-07 14:53:02','2023-08-07 14:53:02'),(73,1,'http://realtyinterface.s3.amazonaws.com/property_images/iaLMnDdRYBMYOU371d7bEOU1ReqJKz29IDxI5kqA.jpg','http://realtyinterface.s3.amazonaws.com/property_images_thumb/1_1691419982.jpg','2023-08-07 14:53:03','2023-08-07 14:53:03'),(74,1,'http://realtyinterface.s3.amazonaws.com/property_images/oUv3EmjQjCZv9o5pFDzFP7mWULbxoAE6CRjYW5dO.jpg','http://realtyinterface.s3.amazonaws.com/property_images_thumb/car2_1691419984.jpg','2023-08-07 14:53:04','2023-08-07 14:53:04'),(75,1,'http://realtyinterface.s3.amazonaws.com/property_images/bvODD8CAmQW1c3H97kzuwkZfjcB7Id6IjTpWFDOq.jpg','http://realtyinterface.s3.amazonaws.com/property_images_thumb/carlift_1691419984.jpg','2023-08-07 14:53:04','2023-08-07 14:53:04'),(76,1,'http://realtyinterface.s3.amazonaws.com/property_images/w7Cn0RUqxUCt70bUKOYkFIOxmn7lou40tZa5z6qX.jpg','http://realtyinterface.s3.amazonaws.com/property_images_thumb/carlift2_1691419984.jpg','2023-08-07 14:53:05','2023-08-07 14:53:05'),(77,1,'http://realtyinterface.s3.amazonaws.com/property_images/R9MMKQAQrWN5EBqF8qqyTfVi6VhgpNWTXN5Il8PI.jpg','http://realtyinterface.s3.amazonaws.com/property_images_thumb/garflat_1691419985.jpg','2023-08-07 14:53:05','2023-08-07 14:53:05'),(78,1,'http://realtyinterface.s3.amazonaws.com/property_images/XmrBJtvhwqyIvKoPz5fbIFF8ttvyNaMb6jNncmYF.jpg','http://realtyinterface.s3.amazonaws.com/property_images_thumb/lift_1691419986.jpg','2023-08-07 14:53:06','2023-08-07 14:53:06'),(79,1,'http://realtyinterface.s3.amazonaws.com/property_images/tZ3BIAqk82U68jgWHw59DT8nOhskV0rB7rLa582L.jpg','http://realtyinterface.s3.amazonaws.com/property_images_thumb/lift2_1691419986.jpg','2023-08-07 14:53:06','2023-08-07 14:53:06'),(80,1,'http://realtyinterface.s3.amazonaws.com/property_images/SvyTTfTaHOLw1lhiNvdBCXXLDwfbvn7EfdGPQM8C.jpg','http://realtyinterface.s3.amazonaws.com/property_images_thumb/lift3_1691419986.jpg','2023-08-07 14:53:07','2023-08-07 14:53:07'),(81,1,'http://realtyinterface.s3.amazonaws.com/property_images/jFSNIs0X3cvUT1peARmfeHphdM3wnrgjBmSSjGrW.jpg','http://realtyinterface.s3.amazonaws.com/property_images_thumb/Untitled-3_1691419987.jpg','2023-08-07 14:53:07','2023-08-07 14:53:07'),(82,1,'http://realtyinterface.s3.amazonaws.com/property_images/4W1vdtTJVnn0an5jEPm7fzBjrh66YJCrohZNMYlz.jpg','http://realtyinterface.s3.amazonaws.com/property_images_thumb/Untitled-6_1691419987.jpg','2023-08-07 14:53:08','2023-08-07 14:53:08'),(83,1,'http://realtyinterface.s3.amazonaws.com/property_images/PnlBQnetknk8jwS3xxUZvkeWdfKgOnczTE5G26Vw.jpg','http://realtyinterface.s3.amazonaws.com/property_images_thumb/Untitled-7_1691419988.jpg','2023-08-07 14:53:08','2023-08-07 14:53:08'),(84,1,'http://realtyinterface.s3.amazonaws.com/property_images/72nYHBRdSz5RVlar0cXgtOwyQPIZNxEr2XeHe9rA.jpg','http://realtyinterface.s3.amazonaws.com/property_images_thumb/Untitled-8_1691419988.jpg','2023-08-07 14:53:09','2023-08-07 14:53:09'),(85,1,'http://realtyinterface.s3.amazonaws.com/property_images/EUjcSIw2aBJP1vnKiyqfl88WTuAWzpOR1tCk8dtQ.jpg','http://realtyinterface.s3.amazonaws.com/property_images_thumb/01newlower_1691462153.jpg','2023-08-08 02:35:53','2023-08-08 02:35:53'),(86,2,'http://realtyinterface.s3.amazonaws.com/property_images/GS8hpnGLbLr6VIcXmZZkeOYTYM8SrgCBhKHB7Tkc.jpg','http://realtyinterface.s3.amazonaws.com/property_images_thumb/gar1_1693272151.jpg','2023-08-29 01:22:31','2023-08-29 01:22:31'),(87,2,'http://realtyinterface.s3.amazonaws.com/property_images/JrwOF5j8ISXAeC2IuDYZVMnVBXX2jL3XHImWsF5z.jpg','http://realtyinterface.s3.amazonaws.com/property_images_thumb/boat_1693272151.jpg','2023-08-29 01:22:31','2023-08-29 01:22:31'),(88,2,'http://realtyinterface.s3.amazonaws.com/property_images/4MxkKhhLhnAUVv5Ns8NV3vNhUvvLJtj6GWUwy65f.jpg','http://realtyinterface.s3.amazonaws.com/property_images_thumb/gar2_1693272152.jpg','2023-08-29 01:22:32','2023-08-29 01:22:32'),(89,2,'http://realtyinterface.s3.amazonaws.com/property_images/OrJ2uHiHDNC2WaOSQJYNlKYm1u9r2Hy6G8K1r08D.jpg','http://realtyinterface.s3.amazonaws.com/property_images_thumb/gar4_1693272152.jpg','2023-08-29 01:22:32','2023-08-29 01:22:32'),(90,2,'http://realtyinterface.s3.amazonaws.com/property_images/z8yyiPeQO4wgBHL0rRyM4zCHR0oH5shylLaqXN1B.jpg','http://realtyinterface.s3.amazonaws.com/property_images_thumb/gar5_1693272153.jpg','2023-08-29 01:22:33','2023-08-29 01:22:33'),(91,2,'http://realtyinterface.s3.amazonaws.com/property_images/M0HbHjdox4RNAVJ0aDe8EsU1i7xbclmgp63UVeDk.jpg','http://realtyinterface.s3.amazonaws.com/property_images_thumb/gar6_1693272153.jpg','2023-08-29 01:22:33','2023-08-29 01:22:33'),(92,2,'http://realtyinterface.s3.amazonaws.com/property_images/euI5fXspMDqwXmsoYsQ4afZH5UYSmRae1u9rWbt6.jpg','http://realtyinterface.s3.amazonaws.com/property_images_thumb/gar8_1693272153.jpg','2023-08-29 01:22:33','2023-08-29 01:22:33'),(93,2,'http://realtyinterface.s3.amazonaws.com/property_images/xW1FXE1TdmCtwG28mKnlofT8prXuUrf2ulWvJ3Oe.jpg','http://realtyinterface.s3.amazonaws.com/property_images_thumb/gar7_1693272153.jpg','2023-08-29 01:22:34','2023-08-29 01:22:34'),(94,2,'http://realtyinterface.s3.amazonaws.com/property_images/mIdAmYLNWeru2UHkKvZ1CvOGFIg55F7ML4gm0Kqo.jpg','http://realtyinterface.s3.amazonaws.com/property_images_thumb/gar9_1693272154.jpg','2023-08-29 01:22:34','2023-08-29 01:22:34'),(95,2,'http://realtyinterface.s3.amazonaws.com/property_images/JljCdpmoe6axE0GAtkZTp2TQaVVcCMZLvot7qFJs.jpg','http://realtyinterface.s3.amazonaws.com/property_images_thumb/gar10_1693272154.jpg','2023-08-29 01:22:34','2023-08-29 01:22:34'),(96,2,'http://realtyinterface.s3.amazonaws.com/property_images/JZr3BDFq2ybm5LPADmNXXzxdGh2g8GszBCWw3DyL.jpg','http://realtyinterface.s3.amazonaws.com/property_images_thumb/gar12_1693272155.jpg','2023-08-29 01:22:35','2023-08-29 01:22:35'),(97,2,'http://realtyinterface.s3.amazonaws.com/property_images/RCptbIeug3zdQkoiM2TXc1JjjMTevJlJRo5rvvCg.jpg','http://realtyinterface.s3.amazonaws.com/property_images_thumb/gar11_1693272155.jpg','2023-08-29 01:22:35','2023-08-29 01:22:35'),(98,2,'http://realtyinterface.s3.amazonaws.com/property_images/zHjLiILxyjjWTmTg8YpGpUbvjDnp8eKk4tZ38Qpx.jpg','http://realtyinterface.s3.amazonaws.com/property_images_thumb/gar14_1693272155.jpg','2023-08-29 01:22:36','2023-08-29 01:22:36'),(99,2,'http://realtyinterface.s3.amazonaws.com/property_images/JEjSm8u486xCXsh6hcZR1Q9GFv1SfSpuRTb3Edy1.jpg','http://realtyinterface.s3.amazonaws.com/property_images_thumb/gar13_1693272156.jpg','2023-08-29 01:22:36','2023-08-29 01:22:36'),(100,2,'http://realtyinterface.s3.amazonaws.com/property_images/dngnxNH8oe76jFldLeCLXhfAmrdNYls4Nm9SWiDz.jpg','http://realtyinterface.s3.amazonaws.com/property_images_thumb/gar15_1693272156.jpg','2023-08-29 01:22:36','2023-08-29 01:22:36'),(101,2,'http://realtyinterface.s3.amazonaws.com/property_images/o1Hft6S0frVlY2BqppvjyMQX9IeCfRj286uYez1H.jpg','http://realtyinterface.s3.amazonaws.com/property_images_thumb/garage1_1693272157.jpg','2023-08-29 01:22:37','2023-08-29 01:22:37'),(102,2,'http://realtyinterface.s3.amazonaws.com/property_images/IOfZ6q4o23EH9cPVyskqgagKCuoJ7DFwMnTu96cg.jpg','http://realtyinterface.s3.amazonaws.com/property_images_thumb/garage2_1693272157.jpg','2023-08-29 01:22:37','2023-08-29 01:22:37'),(103,2,'http://realtyinterface.s3.amazonaws.com/property_images/6eydYUPmO2Ei07YM5W8h9ykxGV0GnoeDLNVsjNtM.jpg','http://realtyinterface.s3.amazonaws.com/property_images_thumb/garage4_1693272157.jpg','2023-08-29 01:22:38','2023-08-29 01:22:38');
/*!40000 ALTER TABLE `property_images` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `property_matterport`
--

DROP TABLE IF EXISTS `property_matterport`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `property_matterport` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `property_id` bigint(20) unsigned NOT NULL,
  `matterport_url` varchar(500) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `property_matterport_property_id_foreign` (`property_id`),
  CONSTRAINT `property_matterport_property_id_foreign` FOREIGN KEY (`property_id`) REFERENCES `properties` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `property_matterport`
--

LOCK TABLES `property_matterport` WRITE;
/*!40000 ALTER TABLE `property_matterport` DISABLE KEYS */;
INSERT INTO `property_matterport` VALUES (1,1,'https://my.matterport.com/show/?m=ZFSNF6SuXPQ&epik=dj0yJnU9MWM4a0pDX3JTeWdMcmJ1RnhEendWSW5RVzd0T2FIYTkmcD0wJm49eGZiOHhZaFJvU3Zlbjl2TVppQUZaUSZ0PUFBQUFBR1NMTlJR','2023-08-05 20:54:06','2023-08-05 20:54:06');
/*!40000 ALTER TABLE `property_matterport` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `property_slider`
--

DROP TABLE IF EXISTS `property_slider`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `property_slider` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `property_id` bigint(20) unsigned NOT NULL,
  `image_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `property_slider`
--

LOCK TABLES `property_slider` WRITE;
/*!40000 ALTER TABLE `property_slider` DISABLE KEYS */;
/*!40000 ALTER TABLE `property_slider` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `property_videos`
--

DROP TABLE IF EXISTS `property_videos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `property_videos` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `property_id` bigint(20) unsigned NOT NULL,
  `title` varchar(100) DEFAULT NULL,
  `file_name` varchar(100) DEFAULT NULL,
  `video_type` enum('YouTube','Vimeo') DEFAULT 'YouTube',
  `video_url` varchar(255) DEFAULT NULL,
  `featured` tinyint(1) NOT NULL DEFAULT 0,
  `main_video` tinyint(1) NOT NULL DEFAULT 0,
  `active` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `property_videos_property_id_foreign` (`property_id`),
  CONSTRAINT `property_videos_property_id_foreign` FOREIGN KEY (`property_id`) REFERENCES `properties` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `property_videos`
--

LOCK TABLES `property_videos` WRITE;
/*!40000 ALTER TABLE `property_videos` DISABLE KEYS */;
INSERT INTO `property_videos` VALUES (1,1,NULL,NULL,'Vimeo','https://vimeo.com/843895447?share=copy',0,0,0,'2023-08-05 20:52:59','2023-08-05 20:56:17'),(2,1,NULL,NULL,'Vimeo','https://vimeo.com/843895447?share=copy',1,0,0,'2023-08-05 20:55:11','2023-08-05 20:56:17');
/*!40000 ALTER TABLE `property_videos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `states`
--

DROP TABLE IF EXISTS `states`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `states` (
  `state_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `code` char(2) NOT NULL,
  `name` varchar(100) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`state_id`)
) ENGINE=InnoDB AUTO_INCREMENT=76 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `states`
--

LOCK TABLES `states` WRITE;
/*!40000 ALTER TABLE `states` DISABLE KEYS */;
INSERT INTO `states` VALUES (1,'AL','Alabama','2022-10-06 00:28:44','2022-10-06 00:28:44'),(2,'AK','Alaska','2022-10-06 00:28:45','2022-10-06 00:28:45'),(3,'AB','Alberta','2022-10-06 00:28:45','2022-10-06 00:28:45'),(4,'AS','American Samoa','2022-10-06 00:28:45','2022-10-06 00:28:45'),(5,'AZ','Arizona','2022-10-06 00:28:45','2022-10-06 00:28:45'),(6,'AR','Arkansas','2022-10-06 00:28:45','2022-10-06 00:28:45'),(7,'BC','British Columbia','2022-10-06 00:28:45','2022-10-06 00:28:45'),(8,'CA','California','2022-10-06 00:28:45','2022-10-06 00:28:45'),(9,'PW','Caroline ISLANDS','2022-10-06 00:28:45','2022-10-06 00:28:45'),(10,'CO','Colorado','2022-10-06 00:28:45','2022-10-06 00:28:45'),(11,'CT','Conneticut','2022-10-06 00:28:45','2022-10-06 00:28:45'),(12,'DE','Delaware','2022-10-06 00:28:45','2022-10-06 00:28:45'),(13,'DC','District of Columbia','2022-10-06 00:28:45','2022-10-06 00:28:45'),(14,'FM','Federated State','2022-10-06 00:28:45','2022-10-06 00:28:45'),(15,'FL','Florida','2022-10-06 00:28:45','2022-10-06 00:28:45'),(16,'GA','Georgia','2022-10-06 00:28:45','2022-10-06 00:28:45'),(17,'GU','Guam','2022-10-06 00:28:45','2022-10-06 00:28:45'),(18,'HI','Hawaii','2022-10-06 00:28:45','2022-10-06 00:28:45'),(19,'ID','Idoha','2022-10-06 00:28:45','2022-10-06 00:28:45'),(20,'IL','Illinois','2022-10-06 00:28:46','2022-10-06 00:28:46'),(21,'IN','Indiana','2022-10-06 00:28:46','2022-10-06 00:28:46'),(22,'IA','Iowa','2022-10-06 00:28:46','2022-10-06 00:28:46'),(23,'KS','Kansas','2022-10-06 00:28:46','2022-10-06 00:28:46'),(24,'KY','Kentucky','2022-10-06 00:28:46','2022-10-06 00:28:46'),(25,'LA','Lousiana','2022-10-06 00:28:46','2022-10-06 00:28:46'),(26,'ME','Maine','2022-10-06 00:28:46','2022-10-06 00:28:46'),(27,'MB','Manitoba','2022-10-06 00:28:46','2022-10-06 00:28:46'),(28,'MP','Mariana Islands','2022-10-06 00:28:46','2022-10-06 00:28:46'),(29,'MH','Marshall Islands','2022-10-06 00:28:46','2022-10-06 00:28:46'),(30,'MD','Maryland','2022-10-06 00:28:46','2022-10-06 00:28:46'),(31,'MA','Massachusetts','2022-10-06 00:28:46','2022-10-06 00:28:46'),(32,'MI','Illmichiganinois','2022-10-06 00:28:46','2022-10-06 00:28:46'),(33,'MN','Minnesota','2022-10-06 00:28:46','2022-10-06 00:28:46'),(34,'MS','Mississippi','2022-10-06 00:28:46','2022-10-06 00:28:46'),(35,'MO','Missouri','2022-10-06 00:28:46','2022-10-06 00:28:46'),(36,'MT','Montana','2022-10-06 00:28:46','2022-10-06 00:28:46'),(37,'NE','Nebraska','2022-10-06 00:28:46','2022-10-06 00:28:46'),(38,'NV','Nevada','2022-10-06 00:28:46','2022-10-06 00:28:46'),(39,'NB','New Brunswick','2022-10-06 00:28:46','2022-10-06 00:28:46'),(40,'NH','New Hampshire','2022-10-06 00:28:46','2022-10-06 00:28:46'),(41,'NJ','New Jersey','2022-10-06 00:28:46','2022-10-06 00:28:46'),(42,'NM','New Mexico','2022-10-06 00:28:47','2022-10-06 00:28:47'),(43,'NY','New York','2022-10-06 00:28:47','2022-10-06 00:28:47'),(44,'NF','Newfoundland','2022-10-06 00:28:47','2022-10-06 00:28:47'),(45,'NC','North Carlolina','2022-10-06 00:28:47','2022-10-06 00:28:47'),(46,'ND','North Dakota','2022-10-06 00:28:47','2022-10-06 00:28:47'),(47,'NT','Northwest Territories','2022-10-06 00:28:47','2022-10-06 00:28:47'),(48,'NS','Nova Scotia','2022-10-06 00:28:47','2022-10-06 00:28:47'),(49,'NU','Nunavut','2022-10-06 00:28:47','2022-10-06 00:28:47'),(50,'OH','Ohio','2022-10-06 00:28:47','2022-10-06 00:28:47'),(51,'OK','Oklahoma','2022-10-06 00:28:47','2022-10-06 00:28:47'),(52,'ON','Ontario','2022-10-06 00:28:47','2022-10-06 00:28:47'),(53,'OR','Oregon','2022-10-06 00:28:47','2022-10-06 00:28:47'),(54,'PA','Pennsylvania','2022-10-06 00:28:47','2022-10-06 00:28:47'),(55,'PE','Prince Edward Island','2022-10-06 00:28:47','2022-10-06 00:28:47'),(56,'PR','Puerto Rica','2022-10-06 00:28:47','2022-10-06 00:28:47'),(57,'PQ','Quebec','2022-10-06 00:28:48','2022-10-06 00:28:48'),(58,'RI','Rhode Island','2022-10-06 00:28:48','2022-10-06 00:28:48'),(59,'SK','Saskatchewan','2022-10-06 00:28:48','2022-10-06 00:28:48'),(60,'SC','South Carolina','2022-10-06 00:28:48','2022-10-06 00:28:48'),(61,'SD','South Dakota','2022-10-06 00:28:48','2022-10-06 00:28:48'),(62,'TN','Tennessee','2022-10-06 00:28:48','2022-10-06 00:28:48'),(63,'TX','Texas','2022-10-06 00:28:48','2022-10-06 00:28:48'),(64,'UT','Utah','2022-10-06 00:28:48','2022-10-06 00:28:48'),(65,'VT','Vermont','2022-10-06 00:28:48','2022-10-06 00:28:48'),(66,'VI','Virgin Islands','2022-10-06 00:28:48','2022-10-06 00:28:48'),(67,'VA','Virginia','2022-10-06 00:28:48','2022-10-06 00:28:48'),(68,'WA','Washington','2022-10-06 00:28:48','2022-10-06 00:28:48'),(69,'WV','West Virgania','2022-10-06 00:28:48','2022-10-06 00:28:48'),(70,'WI','Wisconsin','2022-10-06 00:28:48','2022-10-06 00:28:48'),(71,'WY','Wyoming','2022-10-06 00:28:49','2022-10-06 00:28:49'),(72,'YT','Yukon Territory','2022-10-06 00:28:49','2022-10-06 00:28:49'),(73,'AE','Armed Forces - EUROPE','2022-10-06 00:28:49','2022-10-06 00:28:49'),(74,'AA','Armed Forces - AMERICAS','2022-10-06 00:28:49','2022-10-06 00:28:49'),(75,'AP','Armed Forces - PACIFIC','2022-10-06 00:28:49','2022-10-06 00:28:49');
/*!40000 ALTER TABLE `states` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
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

-- Dump completed on 2023-09-01 22:00:24
