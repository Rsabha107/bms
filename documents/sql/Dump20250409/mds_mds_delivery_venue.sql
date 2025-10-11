
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
-- Table structure for table `mds_delivery_venue`
--

DROP TABLE IF EXISTS `mds_delivery_venue`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mds_delivery_venue` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(250) CHARACTER SET utf8mb4 NOT NULL,
  `short_name` varchar(50) CHARACTER SET utf8mb4 NOT NULL,
  `active_flag` int(11) NOT NULL,
  `created_by` int(11) NOT NULL,
  `updated_by` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mds_delivery_venue`
--

LOCK TABLES `mds_delivery_venue` WRITE;
/*!40000 ALTER TABLE `mds_delivery_venue` DISABLE KEYS */;
INSERT INTO `mds_delivery_venue` VALUES (1,'974 - Stadium 974','974',1,10,10,'2024-08-05 10:40:33','2025-03-18 05:17:05'),(3,'Doha Exhibition Center','DEC',1,10,10,'2024-08-05 16:51:21','2024-08-06 14:27:12'),(5,'ASZ - ASPIRE ZONE','ASZ',1,10,10,'2025-03-02 11:06:20','2025-03-02 11:06:20'),(6,'KIS - KHALIFA INTERNATIONAL STADIUM','KIS',1,1,1,'2025-03-06 20:59:47','2025-03-06 20:59:47'),(7,'AAS - Ahmad bin Ali Stadium','AAS',1,1,1,'2025-03-18 05:14:05','2025-03-18 05:16:56'),(8,'LUS - Lusail Stadium','LUS',1,1,1,'2025-03-18 05:14:21','2025-03-18 05:16:50'),(9,'ABS - Al Bayt Stadium','ABS',1,1,1,'2025-03-18 05:14:34','2025-03-18 05:16:44'),(10,'LIC - Lusail International Circuit','LIC',1,1,1,'2025-03-18 05:21:03','2025-03-18 05:21:03');
/*!40000 ALTER TABLE `mds_delivery_venue` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2025-04-09  9:13:31
