-- MySQL dump 10.13  Distrib 5.7.9, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: marketdata
-- ------------------------------------------------------
-- Server version	5.7.11-log

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
-- Table structure for table `offer_price`
--

DROP TABLE IF EXISTS `offer_price`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `offer_price` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `offer_id` int(11) NOT NULL,
  `list_price` decimal(12,3) DEFAULT NULL,
  `erp_price` decimal(12,3) DEFAULT NULL,
  `created` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `deleted` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=136 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `offer_price`
--

LOCK TABLES `offer_price` WRITE;
/*!40000 ALTER TABLE `offer_price` DISABLE KEYS */;
INSERT INTO `offer_price` VALUES (1,1,0.800,1.000,'2016-02-23 20:35:19',NULL),(2,2,0.700,0.900,'2016-02-23 20:35:19',NULL),(3,3,4.800,6.000,'2016-02-23 20:35:19',NULL),(4,4,4.080,5.100,'2016-02-23 20:35:20',NULL),(5,5,1.410,1.800,'2016-02-23 20:35:20',NULL),(6,6,1.600,2.000,'2016-02-23 20:35:20',NULL),(7,7,1.600,2.000,'2016-02-23 20:35:20',NULL),(8,8,1.400,1.800,'2016-02-23 20:35:20',NULL),(9,9,3.200,4.000,'2016-02-23 20:35:20',NULL),(10,10,2.800,3.500,'2016-02-23 20:35:20',NULL),(11,11,6.990,8.700,'2016-02-23 20:35:20',NULL),(12,12,6.150,7.700,'2016-02-23 20:35:20',NULL),(13,13,3.200,4.000,'2016-02-23 20:35:20',NULL),(14,14,6.400,8.000,'2016-02-23 20:35:20',NULL),(15,15,5.600,7.000,'2016-02-23 20:35:20',NULL),(16,16,1.600,2.000,'2016-02-23 20:35:20',NULL),(17,17,1.410,1.800,'2016-02-23 20:35:20',NULL),(18,18,2.400,3.000,'2016-02-23 20:35:21',NULL),(19,19,1.600,2.000,'2016-02-23 20:35:21',NULL),(20,20,1.600,2.000,'2016-02-23 20:35:21',NULL),(21,21,1.200,1.500,'2016-02-23 20:35:21',NULL),(22,22,2.800,3.500,'2016-02-23 20:35:21',NULL),(23,23,0.800,1.000,'2016-02-23 20:35:21',NULL),(24,24,4.090,5.100,'2016-02-23 20:35:21',NULL),(25,25,2.000,2.500,'2016-02-23 20:35:21',NULL),(26,26,112.500,150.000,'2016-02-23 20:35:21',NULL),(27,27,87.000,116.000,'2016-02-23 20:35:21',NULL),(28,28,411.750,549.000,'2016-02-23 20:35:22',NULL),(29,29,318.750,425.000,'2016-02-23 20:35:22',NULL),(30,30,7.500,10.000,'2016-02-23 20:35:22',NULL),(31,31,6.800,9.100,'2016-02-23 20:35:22',NULL),(32,32,22.500,30.000,'2016-02-23 20:35:22',NULL),(33,33,17.250,23.000,'2016-02-23 20:35:22',NULL),(34,34,11.250,15.000,'2016-02-23 20:35:22',NULL),(35,35,8.600,11.500,'2016-02-23 20:35:22',NULL),(36,36,48.750,65.000,'2016-02-23 20:35:22',NULL),(37,37,37.500,50.000,'2016-02-23 20:35:22',NULL),(38,38,37.500,50.000,'2016-02-23 20:35:22',NULL),(39,39,32.500,43.300,'2016-02-23 20:35:22',NULL),(40,40,4.800,6.000,'2016-02-23 20:35:22',NULL),(41,41,2.000,2.500,'2016-02-23 20:35:22',NULL),(42,42,75.000,100.000,'2016-02-23 20:35:22',NULL),(43,43,75.000,100.000,'2016-02-23 20:35:22',NULL),(44,44,52.500,70.000,'2016-02-23 20:35:22',NULL),(45,45,52.500,70.000,'2016-02-23 20:35:23',NULL),(46,46,30.000,40.000,'2016-02-23 20:35:23',NULL),(47,47,30.000,40.000,'2016-02-23 20:35:23',NULL),(48,48,6.400,8.000,'2016-02-23 20:35:23',NULL),(49,49,5.600,7.000,'2016-02-23 20:35:23',NULL),(50,50,6.600,8.300,'2016-02-23 20:35:23',NULL),(51,51,4.000,5.000,'2016-02-23 20:35:23',NULL),(52,52,10.000,12.500,'2016-02-23 20:35:23',NULL),(53,53,6.400,8.000,'2016-02-23 20:35:23',NULL),(54,54,4.800,6.000,'2016-02-23 20:35:23',NULL),(55,55,16.000,20.000,'2016-02-23 20:35:23',NULL),(56,56,13.600,17.000,'2016-02-23 20:35:23',NULL),(57,57,17.600,22.000,'2016-02-23 20:35:23',NULL),(58,58,15.200,19.000,'2016-02-23 20:35:23',NULL),(59,59,26.400,33.000,'2016-02-23 20:35:23',NULL),(60,60,22.440,28.100,'2016-02-23 20:35:23',NULL),(61,61,3.200,4.000,'2016-02-23 20:35:23',NULL),(62,62,2.400,3.000,'2016-02-23 20:35:23',NULL),(63,63,0.620,0.800,'2016-02-23 20:35:24',NULL),(64,64,0.160,0.200,'2016-02-23 20:35:24',NULL),(65,65,0.160,0.200,'2016-02-23 20:35:24',NULL),(66,66,9.600,12.000,'2016-02-23 20:35:24',NULL),(67,67,7.200,9.000,'2016-02-23 20:35:24',NULL),(68,68,4.000,5.000,'2016-02-23 20:35:24',NULL),(69,69,3.520,4.400,'2016-02-23 20:35:24',NULL),(70,70,7.990,10.000,'2016-02-23 20:35:24',NULL),(71,71,6.950,8.700,'2016-02-23 20:35:24',NULL),(72,72,5.600,7.000,'2016-02-23 20:35:24',NULL),(73,73,4.960,6.200,'2016-02-23 20:35:24',NULL),(74,74,26.400,33.000,'2016-02-23 20:35:24',NULL),(75,75,19.800,24.800,'2016-02-23 20:35:24',NULL),(76,76,46.400,58.000,'2016-02-23 20:35:24',NULL),(77,77,20.000,25.000,'2016-02-23 20:35:24',NULL),(78,78,17.220,21.500,'2016-02-23 20:35:24',NULL),(79,79,4.000,5.000,'2016-02-23 20:35:25',NULL),(80,80,6.400,8.000,'2016-02-23 20:35:25',NULL),(81,81,5.600,7.000,'2016-02-23 20:35:25',NULL),(82,82,1.600,2.000,'2016-02-23 20:35:25',NULL),(83,83,1.200,1.500,'2016-02-23 20:35:25',NULL),(84,84,4.400,5.500,'2016-02-23 20:35:25',NULL),(85,85,3.600,4.500,'2016-02-23 20:35:25',NULL),(86,86,1.600,2.000,'2016-02-23 20:35:25',NULL),(87,87,1.400,1.800,'2016-02-23 20:35:25',NULL),(88,88,10.400,13.000,'2016-02-23 20:35:25',NULL),(89,89,8.960,11.200,'2016-02-23 20:35:25',NULL),(90,90,2.400,3.000,'2016-02-23 20:35:25',NULL),(91,91,2.080,2.600,'2016-02-23 20:35:25',NULL),(92,92,6.990,10.000,'2016-02-23 20:35:25',NULL),(93,93,52.500,75.000,'2016-02-23 20:35:25',NULL),(94,94,133.000,190.100,'2016-02-23 20:35:26',NULL),(95,95,297.500,425.100,'2016-02-23 08:00:00','2016-04-21 19:27:17'),(96,96,945.000,1350.400,'2016-02-23 20:35:26',NULL),(97,97,2835.000,4051.100,'2016-02-23 08:00:00','2016-04-21 19:27:17'),(98,98,5530.000,7902.200,'2016-02-23 20:35:26',NULL),(99,99,8400.000,12003.400,'2016-02-23 20:35:26',NULL),(100,100,5.600,8.000,'2016-02-23 20:35:26',NULL),(101,101,21.000,30.000,'2016-02-23 20:35:26',NULL),(102,102,1.120,1.400,'2016-02-23 20:35:26',NULL),(103,103,3.200,4.000,'2016-02-23 20:35:26',NULL),(104,104,2.400,3.000,'2016-02-23 08:00:00','2016-04-21 19:27:17'),(105,105,19.200,24.000,'2016-02-23 20:35:26',NULL),(106,106,16.800,21.000,'2016-02-23 20:35:26',NULL),(107,107,9.600,12.000,'2016-02-23 20:35:26',NULL),(108,108,8.400,10.500,'2016-02-23 20:35:26',NULL),(109,109,8.000,10.000,'2016-02-23 20:35:26',NULL),(110,110,7.000,8.800,'2016-02-23 20:35:26',NULL),(111,111,8.000,10.000,'2016-02-23 20:35:27',NULL),(112,95,298.000,425.000,'2016-04-21 19:00:14',NULL),(113,97,2840.000,4050.000,'2016-04-21 19:00:14',NULL),(114,104,3.500,3.500,'2016-04-21 19:00:14',NULL),(115,112,24.000,24.000,'2016-04-21 19:00:14',NULL),(116,113,21.000,21.000,'2016-04-21 19:00:14',NULL),(117,114,12.000,12.000,'2016-04-21 19:00:14',NULL),(118,115,10.500,10.500,'2016-04-21 19:00:14',NULL),(119,116,4.000,5.000,'2016-04-21 19:00:14',NULL),(120,117,3.500,4.400,'2016-04-21 19:00:14',NULL),(121,95,298.000,425.000,'2016-04-21 19:11:13',NULL),(122,97,2840.000,4050.000,'2016-04-21 19:11:13',NULL),(123,104,3.500,3.500,'2016-04-21 19:11:13',NULL),(124,95,298.000,425.000,'2016-04-21 19:25:08',NULL),(125,97,2840.000,4050.000,'2016-04-21 19:25:09',NULL),(126,104,3.500,3.500,'2016-04-21 19:25:09',NULL),(127,95,298.000,425.000,'2016-04-21 19:27:09',NULL),(128,97,2840.000,4050.000,'2016-04-21 19:27:09',NULL),(129,104,3.500,3.500,'2016-04-21 19:27:10',NULL),(130,95,298.000,425.000,'2016-04-21 19:27:13',NULL),(131,97,2840.000,4050.000,'2016-04-21 19:27:13',NULL),(132,104,3.500,3.500,'2016-04-21 19:27:13',NULL),(133,95,298.000,425.000,'2016-04-21 19:27:17',NULL),(134,97,2840.000,4050.000,'2016-04-21 19:27:17',NULL),(135,104,3.500,3.500,'2016-04-21 19:27:17',NULL);
/*!40000 ALTER TABLE `offer_price` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2016-04-21 12:34:04
