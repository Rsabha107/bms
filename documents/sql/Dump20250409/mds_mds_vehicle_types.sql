
-- MariaDB dump 10.19  Distrib 10.4.24-MariaDB, for Win64 (AMD64)
--
-- Host: 127.0.0.1    Database: mds
-- ------------------------------------------------------
-- Server version	10.4.24-MariaDB

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
-- Table structure for table `mds_vehicle_types`
--

DROP TABLE IF EXISTS `mds_vehicle_types`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mds_vehicle_types` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(250) CHARACTER SET utf8mb4 NOT NULL,
  `active_flag` int(11) NOT NULL,
  `created_by` int(11) NOT NULL,
  `updated_by` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mds_vehicle_types`
--

LOCK TABLES `mds_vehicle_types` WRITE;
/*!40000 ALTER TABLE `mds_vehicle_types` DISABLE KEYS */;
INSERT INTO `mds_vehicle_types` VALUES (5,'3 or 5 tonne rigid, truck',1,10,10,'2025-04-05 20:35:30','2025-04-05 20:35:30'),(6,'7 or 7.5 tonne rigid, truck',1,10,10,'2025-04-05 20:35:30','2025-04-05 20:35:30'),(7,'10 tonne rigid, truck',1,10,10,'2025-04-05 20:35:30','2025-04-05 20:35:30'),(8,'18 tonne rigid, truck',1,10,10,'2025-04-05 20:35:30','2025-04-05 20:35:30'),(9,'38 tonne articulated, truck',1,10,10,'2025-04-05 20:35:30','2025-04-05 20:35:30'),(10,'Ambulance',1,10,10,'2025-04-05 20:35:30','2025-04-05 20:35:30'),(11,'Broadcast Operations Vehicle',1,10,10,'2025-04-05 20:35:30','2025-04-05 20:35:30'),(12,'Car-derived (Small) van',1,10,10,'2025-04-05 20:35:30','2025-04-05 20:35:30'),(13,'Cash in Transit Vehicle',1,10,10,'2025-04-05 20:35:30','2025-04-05 20:35:30'),(14,'Flatbed Truck (oversized only)',1,10,10,'2025-04-05 20:35:30','2025-04-05 20:35:30'),(15,'Fuel Tanker Truck',1,10,10,'2025-04-05 20:35:30','2025-04-05 20:35:30'),(16,'Large van',1,10,10,'2025-04-05 20:35:30','2025-04-05 20:35:30'),(17,'Medium van',1,10,10,'2025-04-05 20:35:30','2025-04-05 20:35:30'),(18,'Pick-Up Truck',1,10,10,'2025-04-05 20:35:30','2025-04-05 20:35:30'),(19,'Team Kit Van',1,10,10,'2025-04-05 20:35:30','2025-04-05 20:35:30'),(20,'Trailer Vehicle rigid, truck',1,10,10,'2025-04-05 20:35:30','2025-04-05 20:35:30'),(21,'Waste Collection Vehicle',1,10,10,'2025-04-05 20:35:30','2025-04-05 20:35:30'),(22,'Water Tank Truck',1,10,10,'2025-04-05 20:35:30','2025-04-05 20:35:30'),(23,'Other',1,10,10,'2025-04-05 20:35:30','2025-04-05 20:35:30');
/*!40000 ALTER TABLE `mds_vehicle_types` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2025-04-09  9:13:38
