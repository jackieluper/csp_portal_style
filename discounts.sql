CREATE DATABASE  IF NOT EXISTS `discount_estimates` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `discount_estimates`;
-- MySQL dump 10.13  Distrib 5.7.9, for Win32 (AMD64)
--
-- Host: localhost    Database: discount_estimates
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
-- Table structure for table `adjustment`
--

DROP TABLE IF EXISTS `adjustment`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `adjustment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `offer_id` int(11) NOT NULL,
  `adjustment` decimal(12,3) DEFAULT NULL,
  `adjustment_type` varchar(15) DEFAULT NULL,
  `created` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `deleted` timestamp NULL DEFAULT NULL,
  `active` tinyint(4) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `adjustment`
--

LOCK TABLES `adjustment` WRITE;
/*!40000 ALTER TABLE `adjustment` DISABLE KEYS */;
/*!40000 ALTER TABLE `adjustment` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cart`
--

DROP TABLE IF EXISTS `cart`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cart` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `customer_id` int(11) NOT NULL,
  `saved_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `items` int(11) DEFAULT NULL,
  `item_name` varchar(255) DEFAULT NULL,
  `our_cost` decimal(12,3) DEFAULT NULL,
  `msrp` decimal(6,2) DEFAULT NULL,
  `proposed_cost` decimal(12,3) DEFAULT NULL,
  `qty` int(11) DEFAULT NULL,
  `transaction_id` int(11) DEFAULT NULL,
  `sku` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cart`
--

LOCK TABLES `cart` WRITE;
/*!40000 ALTER TABLE `cart` DISABLE KEYS */;
INSERT INTO `cart` VALUES (5,1,'2016-03-09 17:17:08',55,'Office 365 Enterprise E3',16.000,20.00,20.000,1,9,'796b6b5f-613c-4e24-a17c-eba730d49c02'),(6,1,'2016-03-09 17:17:09',11,'Enterprise Mobility Suite',6.990,8.70,8.700,1,9,'79c29af7-3cd0-4a6f-b182-a81e31dec84e');
/*!40000 ALTER TABLE `cart` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cart_item`
--

DROP TABLE IF EXISTS `cart_item`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cart_item` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cart_id` int(11) NOT NULL,
  `offer_id` int(11) NOT NULL,
  `unit_count` int(11) DEFAULT NULL,
  `our_cost` decimal(12,3) DEFAULT NULL,
  `msrp` decimal(12,3) DEFAULT NULL,
  `proposed_cost` decimal(12,3) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cart_item`
--

LOCK TABLES `cart_item` WRITE;
/*!40000 ALTER TABLE `cart_item` DISABLE KEYS */;
/*!40000 ALTER TABLE `cart_item` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `customer`
--

DROP TABLE IF EXISTS `customer`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `customer` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `customer_name` varchar(100) DEFAULT NULL,
  `entity_type` varchar(45) DEFAULT NULL,
  `ms_customer_id` varchar(100) DEFAULT NULL,
  `ms_key` varchar(45) DEFAULT NULL,
  `is_provised` tinyint(4) DEFAULT NULL,
  `primary_domain` varchar(255) DEFAULT NULL,
  `relationship` varchar(100) DEFAULT NULL,
  `discount` float DEFAULT NULL,
  `active` tinyint(4) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `customer`
--

LOCK TABLES `customer` WRITE;
/*!40000 ALTER TABLE `customer` DISABLE KEYS */;
INSERT INTO `customer` VALUES (1,'testing inc.','Corporate','123456789',NULL,1,'www.testing.onmicrosoft.com','CLOUD RESELLER',2,1),(2,'Fake inc.','Corporate','123879456',NULL,0,'www.fakeinc.onmicrosoft.com','CLOUD RESELLER',8,1);
/*!40000 ALTER TABLE `customer` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `customer_adjustment`
--

DROP TABLE IF EXISTS `customer_adjustment`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `customer_adjustment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `offer_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `adjustment` decimal(12,3) DEFAULT NULL,
  `created` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `deleted` timestamp NULL DEFAULT NULL,
  `active` tinyint(4) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `customer_adjustment`
--

LOCK TABLES `customer_adjustment` WRITE;
/*!40000 ALTER TABLE `customer_adjustment` DISABLE KEYS */;
/*!40000 ALTER TABLE `customer_adjustment` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `description`
--

DROP TABLE IF EXISTS `description`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `description` (
  `id` int(11) NOT NULL,
  `offer_id` int(11) NOT NULL,
  `product_desc` varchar(500) DEFAULT NULL,
  `product_image` blob,
  `created` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `deleted` timestamp NULL DEFAULT NULL,
  `active` tinyint(4) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `description`
--

LOCK TABLES `description` WRITE;
/*!40000 ALTER TABLE `description` DISABLE KEYS */;
/*!40000 ALTER TABLE `description` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `offer`
--

DROP TABLE IF EXISTS `offer`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `offer` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `display_name` varchar(500) NOT NULL,
  `license_agreement_type` varchar(45) DEFAULT NULL,
  `purchase_unit` varchar(45) DEFAULT NULL,
  `secondary_license_type` varchar(45) DEFAULT NULL,
  `sku` varchar(45) DEFAULT NULL,
  `created` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `deleted` timestamp NULL DEFAULT NULL,
  `active` tinyint(4) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=112 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `offer`
--

LOCK TABLES `offer` WRITE;
/*!40000 ALTER TABLE `offer` DISABLE KEYS */;
INSERT INTO `offer` VALUES (1,'Azure Active Directory Basic','Corporate','1 Month(s)','NON-SPECIFIC','84a03d81-6b37-4d66-8d4a-faea24541538','2016-02-23 20:35:19',NULL,1),(2,'Azure Active Directory Basic (Government Pricing)','Government','1 Month(s)','NON-SPECIFIC','0a7983cd-961f-4c7c-9cbf-1f6bb322cbf3','2016-02-23 20:35:19',NULL,1),(3,'Azure Active Directory Premium','Corporate','1 Month(s)','NON-SPECIFIC','16c9f982-a827-4003-a88e-e75df1927f27','2016-02-23 20:35:19',NULL,1),(4,'Azure Active Directory Premium (Government Pricing)','Government','1 Month(s)','NON-SPECIFIC','ceca6875-f3ba-4f9a-916f-9cc9e322d4aa','2016-02-23 20:35:20',NULL,1),(5,'Azure Rights Management (Government Pricing)','Government','1 Month(s)','NON-SPECIFIC','e60e0348-1710-484b-992a-32b294d4cde1','2016-02-23 20:35:20',NULL,1),(6,'Azure Rights Management Premium','Corporate','1 Month(s)','NON-SPECIFIC','648bf77b-1f0a-4911-8066-caf37d67dc72','2016-02-23 20:35:20',NULL,1),(7,'Customer Lockbox','Corporate','1 Month(s)','ADDON','68f6373c-31cb-43f0-bfaa-85f3688f8cfb','2016-02-23 20:35:20',NULL,1),(8,'Customer Lockbox (Government Pricing)','Government','1 Month(s)','ADDON','f8a22f25-2b60-4fdb-b920-b0bec26bff5f','2016-02-23 20:35:20',NULL,1),(9,'Delve Analytics','Corporate','1 Month(s)','ADDON','45320ec9-9b8e-49d0-b900-f14141a0abd1','2016-02-23 20:35:20',NULL,1),(10,'Delve Analytics (Government Pricing)','Government','1 Month(s)','ADDON','58de892e-9962-4477-96f9-bc1bef83a02c','2016-02-23 20:35:20',NULL,1),(11,'Enterprise Mobility Suite','Corporate','1 Month(s)','NON-SPECIFIC','79c29af7-3cd0-4a6f-b182-a81e31dec84e','2016-02-23 20:35:20',NULL,1),(12,'Enterprise Mobility Suite (Government Pricing)','Government','1 Month(s)','NON-SPECIFIC','461d7db7-ec67-4671-bf9b-22efde413f0f','2016-02-23 20:35:20',NULL,1),(13,'Exchange Online (Plan 1)','Corporate','1 Month(s)','NON-SPECIFIC','195416c1-3447-423a-b37b-ee59a99a19c4','2016-02-23 20:35:20',NULL,1),(14,'Exchange Online (Plan 2)','Corporate','1 Month(s)','NON-SPECIFIC','2f707c7c-2433-49a5-a437-9ca7cf40d3eb','2016-02-23 20:35:20',NULL,1),(15,'Exchange Online (Plan 2) (Government Pricing)','Government','1 Month(s)','NON-SPECIFIC','ec0d51df-916f-4455-a096-5ab08f58dbd2','2016-02-23 20:35:20',NULL,1),(16,'Exchange Online Advanced Threat Protection ','Corporate','1 Month(s)','ADDON','a2706f86-868d-4048-989b-0c69e5c76b63','2016-02-23 20:35:20',NULL,1),(17,'Exchange Online Advanced Threat Protection (Government Pricing)','Government','1 Month(s)','ADDON','84690799-e043-4de3-b4bd-3e6493283c92','2016-02-23 20:35:20',NULL,1),(18,'Exchange Online Archiving for Exchange Online','Corporate','1 Month(s)','ADDON','2828be95-46ba-4f91-b2fd-0bef192ecf60','2016-02-23 20:35:20',NULL,1),(19,'Exchange Online Archiving for Exchange Online (Government Pricing)','Government','1 Month(s)','NON-SPECIFIC','cb038730-6cbe-47b9-afd4-ca7fa5d0c39b','2016-02-23 20:35:21',NULL,1),(20,'Exchange Online Kiosk','Corporate','1 Month(s)','NON-SPECIFIC','35a36b80-270a-44bf-9290-00545d350866','2016-02-23 20:35:21',NULL,1),(21,'Exchange Online Kiosk (Government Pricing)','Government','1 Month(s)','NON-SPECIFIC','22b61e04-b7eb-4405-9cb3-6a4407b9f95a','2016-02-23 20:35:21',NULL,1),(22,'Exchange Online Plan 1 (Government Pricing)','Government','1 Month(s)','NON-SPECIFIC','24cc266d-6fd3-4b85-b9c8-4d5f587521ac','2016-02-23 20:35:21',NULL,1),(23,'Exchange Online Protection','Corporate','1 Month(s)','NON-SPECIFIC','d903a2db-bf6f-4434-83f1-21ba44017813','2016-02-23 20:35:21',NULL,1),(24,'Intune (Government Pricing)','Government','1 Month(s)','NON-SPECIFIC','16879030-563b-4c89-9586-2cb79ed270ee','2016-02-23 20:35:21',NULL,1),(25,'Intune Additional Storage (Government Pricing)','Government','1 Month(s)','NON-SPECIFIC','1641fe13-5a95-4ba7-a5eb-740caee8d509','2016-02-23 20:35:21',NULL,1),(26,'Microsoft Dynamics CRM Online Additional Non-Production Instance','Corporate','1 Month(s)','ADDON','3396e762-af96-42f1-bea4-5c97a1efa94f','2016-02-23 20:35:21',NULL,1),(27,'Microsoft Dynamics CRM Online Additional Non-Production Instance (Government Pricing)','Government','1 Month(s)','ADDON','f5a22ff0-71e6-4569-92a9-826290151fd8','2016-02-23 20:35:21',NULL,1),(28,'Microsoft Dynamics CRM Online Additional Production Instance','Corporate','1 Month(s)','ADDON','2bcf9fe8-8b65-4fcf-9240-419203fb8cf4','2016-02-23 20:35:21',NULL,1),(29,'Microsoft Dynamics CRM Online Additional Production Instance (Government Pricing)','Government','1 Month(s)','ADDON','d99c49c8-c9eb-4651-b8b8-5ec217b8ccd8','2016-02-23 20:35:22',NULL,1),(30,'Microsoft Dynamics CRM Online Additional Storage','Corporate','1 Month(s)','ADDON','fbf0328a-8b0f-47a6-9483-dc2b36183fce','2016-02-23 20:35:22',NULL,1),(31,'Microsoft Dynamics CRM Online Additional Storage (Government Pricing)','Government','1 Month(s)','ADDON','7f975734-3e60-4a1a-9200-084befa083e6','2016-02-23 20:35:22',NULL,1),(32,'Microsoft Dynamics CRM Online Basic','Corporate','1 Month(s)','NON-SPECIFIC','ffb8bb89-9573-4e76-840f-6521450325a1','2016-02-23 20:35:22',NULL,1),(33,'Microsoft Dynamics CRM Online Basic (Government Pricing)','Government','1 Month(s)','NON-SPECIFIC','66eaff1c-2d07-40ce-a66f-8e49987fe910','2016-02-23 20:35:22',NULL,1),(34,'Microsoft Dynamics CRM Online Essential','Corporate','1 Month(s)','NON-SPECIFIC','d431de8a-1ac2-49dd-a6f5-07f3a0a880ff','2016-02-23 20:35:22',NULL,1),(35,'Microsoft Dynamics CRM Online Essential (Government Pricing)','Government','1 Month(s)','NON-SPECIFIC','378a8b77-e3f3-4ab7-a784-a6803f2e78e9','2016-02-23 20:35:22',NULL,1),(36,'Microsoft Dynamics CRM Online Professional','Corporate','1 Month(s)','NON-SPECIFIC','921cb1b8-a289-4437-a0b8-11104bcc3cba','2016-02-23 20:35:22',NULL,1),(37,'Microsoft Dynamics CRM Online Professional (Government Pricing)','Government','1 Month(s)','NON-SPECIFIC','4271aa57-4129-477e-ba88-0a276d4a1619','2016-02-23 20:35:22',NULL,1),(38,'Microsoft Dynamics CRM Online Professional Add-On to Office 365 ','Corporate','1 Month(s)','NON-SPECIFIC','4443cb9e-651e-4295-be7c-5bc89d1e3916','2016-02-23 20:35:22',NULL,1),(39,'Microsoft Dynamics CRM Online Professional Add-On to Office 365 (Government Pricing)','Government','1 Month(s)','NON-SPECIFIC','2a5454d2-08a8-4162-9ab9-32963b8cc5d0','2016-02-23 20:35:22',NULL,1),(40,'Microsoft Intune','Corporate','1 Month(s)','NON-SPECIFIC','51e95709-dc35-4780-9040-22278cb7c0e1','2016-02-23 20:35:22',NULL,1),(41,'Microsoft Intune™ Extra Storage','Corporate','1 Month(s)','ADDON','ced5f693-2d40-40ae-8848-9809ab1b0ee9','2016-02-23 20:35:22',NULL,1),(42,'Microsoft Social Engagement Additional 10K Posts','Corporate','1 Month(s)','ADDON','145A2B93-3583-4A9A-8564-BCDC20714651','2016-02-23 20:35:22',NULL,1),(43,'Microsoft Social Engagement Additional 10K Posts (Government Pricing)','Government','1 Month(s)','ADDON','21e4b963-3d7c-4bde-946c-b4110e4de0bf','2016-02-23 20:35:22',NULL,1),(44,'Microsoft Social Engagement Additional 10k Posts (minimum 10 licenses)','Corporate','1 Month(s)','ADDON','CBE22A27-20C4-48AD-B8D2-F41644DDC0B2','2016-02-23 20:35:22',NULL,1),(45,'Microsoft Social Engagement Additional 10k Posts (minimum 10 licenses) (Government Pricing)','Government','1 Month(s)','ADDON','853bc104-2ce1-4727-ac31-3c454bcb0e73','2016-02-23 20:35:23',NULL,1),(46,'Microsoft Social Engagement Additional 10k Posts (minimum 100 licenses)','Corporate','1 Month(s)','ADDON','D91596FF-B990-4A15-A9F0-704B91DB2583','2016-02-23 20:35:23',NULL,1),(47,'Microsoft Social Engagement Additional 10k Posts (minimum 100 licenses) (Government Pricing)','Government','1 Month(s)','ADDON','59e61ebc-b1f5-4e58-9887-ecf6993d38e8','2016-02-23 20:35:23',NULL,1),(48,'Office 365 Advanced eDiscovery','Corporate','1 Month(s)','ADDON','6b648c1e-f472-46c0-8379-09f50a3315e0','2016-02-23 20:35:23',NULL,1),(49,'Office 365 Advanced eDiscovery (Government Pricing)','Government','1 Month(s)','ADDON','c11d32d0-7943-4137-9fcc-40797c9bea85','2016-02-23 20:35:23',NULL,1),(50,'Office 365 Business','Corporate','1 Month(s)','NON-SPECIFIC','5c9fd4cc-edce-44a8-8e91-07df09744609','2016-02-23 20:35:23',NULL,1),(51,'Office 365 Business Essentials','Corporate','1 Month(s)','NON-SPECIFIC','bd938f12-058f-4927-bba3-ae36b1d2501c','2016-02-23 20:35:23',NULL,1),(52,'Office 365 Business Premium','Corporate','1 Month(s)','NON-SPECIFIC','031c9e47-4802-4248-838e-778fb1d2cc05','2016-02-23 20:35:23',NULL,1),(53,'Office 365 Enterprise E1','Corporate','1 Month(s)','NON-SPECIFIC','91fd106f-4b2c-4938-95ac-f54f74e9a239','2016-02-23 20:35:23',NULL,1),(54,'Office 365 Enterprise E1 (Government Pricing)','Government','1 Month(s)','NON-SPECIFIC','cfc69058-5106-40bd-81e4-44e0e29034b2','2016-02-23 20:35:23',NULL,1),(55,'Office 365 Enterprise E3','Corporate','1 Month(s)','NON-SPECIFIC','796b6b5f-613c-4e24-a17c-eba730d49c02','2016-02-23 20:35:23',NULL,1),(56,'Office 365 Enterprise E3 (Government Pricing)','Government','1 Month(s)','NON-SPECIFIC','6b551829-de8c-41e5-8678-41d52c27aee8','2016-02-23 20:35:23',NULL,1),(57,'Office 365 Enterprise E4','Corporate','1 Month(s)','NON-SPECIFIC','8909e28e-5832-42f4-9886-b0a5545f3645','2016-02-23 20:35:23',NULL,1),(58,'Office 365 Enterprise E4 (Government Pricing)','Government','1 Month(s)','NON-SPECIFIC','379dc555-ddcb-4ccb-bebf-37437333e278','2016-02-23 20:35:23',NULL,1),(59,'Office 365 Enterprise E5 without PSTN Conferencing','Corporate','1 Month(s)','NON-SPECIFIC','4f7ecaf1-e9d6-4cac-9687-e22eb3dfdd70','2016-02-23 20:35:23',NULL,1),(60,'Office 365 Enterprise E5 without PSTN Conferencing (Government Pricing)','Government','1 Month(s)','NON-SPECIFIC','c4158aa7-00e7-4ce1-9cf3-3cf8321f377a','2016-02-23 20:35:23',NULL,1),(61,'Office 365 Enterprise K1','Corporate','1 Month(s)','NON-SPECIFIC','6fbad345-b7de-42a6-b6ab-79b363d0b371','2016-02-23 20:35:23',NULL,1),(62,'Office 365 Enterprise K1 with Yammer (Government Pricing)','Government','1 Month(s)','NON-SPECIFIC','6ce1ccc8-8b18-4e1b-a1c4-f89de9904389','2016-02-23 20:35:23',NULL,1),(63,'Office 365 Exchange Online Protection (Goverment Pricing)','Government','1 Month(s)','NON-SPECIFIC','0cca44d6-68e9-4762-94ee-31ece98783b9','2016-02-23 20:35:24',NULL,1),(64,'Office 365 Extra File Storage','Corporate','1 Month(s)','ADDON','53fc25f7-6639-4f78-bb44-3c2dfec3ed40','2016-02-23 20:35:24',NULL,1),(65,'Office 365 Extra File Storage (Government Pricing)','Government','1 Month(s)','NON-SPECIFIC','3ea7e320-65e2-45f0-abf5-6f6fabb2255b','2016-02-23 20:35:24',NULL,1),(66,'Office 365 ProPlus','Corporate','1 Month(s)','NON-SPECIFIC','be57ff4c-100c-4f1f-b82d-f1c5ab63a665','2016-02-23 20:35:24',NULL,1),(67,'Office 365 ProPlus (Government Pricing)','Government','1 Month(s)','NON-SPECIFIC','2b6f895d-dfd3-4fb5-8c8c-1a551c9db59a','2016-02-23 20:35:24',NULL,1),(68,'OneDrive for Business (Plan 1)','Corporate','1 Month(s)','NON-SPECIFIC','90d3615e-aa96-478e-b6ce-8eb1e9a96b4b','2016-02-23 20:35:24',NULL,1),(69,'OneDrive for Business (Plan 1) (Government Pricing)','Government','1 Month(s)','NON-SPECIFIC','8f827dc9-5d95-4321-b4b3-a0ee086d02a3','2016-02-23 20:35:24',NULL,1),(70,'Power BI Pro','Corporate','1 Month(s)','NON-SPECIFIC','800f4f3b-cfe1-42c1-9cea-675512810488','2016-02-23 20:35:24',NULL,1),(71,'Power BI Pro (Government Pricing)','Government','1 Month(s)','NON-SPECIFIC','a6acbc1c-9d2a-482a-abda-dfb9285e301e','2016-02-23 20:35:24',NULL,1),(72,'Project Lite','Corporate','1 Month(s)','NON-SPECIFIC','a4179d30-cc09-49f0-977e-dc2cb70b874f','2016-02-23 20:35:24',NULL,1),(73,'Project Lite (Government Pricing)','Government','1 Month(s)','NON-SPECIFIC','af87bced-1900-4bde-9037-9356bc08e235','2016-02-23 20:35:24',NULL,1),(74,'Project Online','Corporate','1 Month(s)','NON-SPECIFIC','1f1d89ab-6c52-4a16-a9b6-b358edb27aab','2016-02-23 20:35:24',NULL,1),(75,'Project Online (Government Pricing)','Government','1 Month(s)','NON-SPECIFIC','fa86a86a-2266-41ef-91ef-48e31a6200ac','2016-02-23 20:35:24',NULL,1),(76,'Project Online with Project Pro for Office 365','Corporate','1 Month(s)','NON-SPECIFIC','63741246-68c5-4ae2-8a2d-333b9eda85d4','2016-02-23 20:35:24',NULL,1),(77,'Project Pro for Office 365','Corporate','1 Month(s)','NON-SPECIFIC','d3bca131-4772-47bc-9c2e-e4040f82268c','2016-02-23 20:35:24',NULL,1),(78,'Project Pro for Office 365 (Government Pricing)','Government','1 Month(s)','NON-SPECIFIC','11e3c9a9-24a2-4cfd-9f60-a9797d68e296','2016-02-23 20:35:24',NULL,1),(79,'SharePoint Online (Plan 1)','Corporate','1 Month(s)','NON-SPECIFIC','ff7a4f5b-4973-4241-8c43-80f2be39311d','2016-02-23 20:35:25',NULL,1),(80,'Skype for Business Cloud PBX','Corporate','1 Month(s)','ADDON','4260988e-990d-479c-ae7b-f01ce8e1bb4d','2016-02-23 20:35:25',NULL,1),(81,'Skype for Business Cloud PBX (Government Pricing)','Government','1 Month(s)','ADDON','d6985a19-c58d-4352-88ae-9095d2fe8736','2016-02-23 20:35:25',NULL,1),(82,'Skype for Business Online (Plan 1)','Corporate','1 Month(s)','NON-SPECIFIC','aca0c06c-890d-4abb-83cf-bc519a2565e5','2016-02-23 20:35:25',NULL,1),(83,'Skype for Business Online (Plan 1) (Government Pricing)','Government','1 Month(s)','NON-SPECIFIC','ae1d0798-28fa-4460-8c67-c09b3ac7133d','2016-02-23 20:35:25',NULL,1),(84,'Skype for Business Online (Plan 2)','Corporate','1 Month(s)','NON-SPECIFIC','14c61739-b45a-42c0-832c-d330972d3173','2016-02-23 20:35:25',NULL,1),(85,'Skype for Business Online (Plan 2) (Government Pricing)','Government','1 Month(s)','NON-SPECIFIC','a6c260a7-545c-42f7-bb27-461c1e131534','2016-02-23 20:35:25',NULL,1),(86,'Skype for Business Plus CAL','Corporate','1 Month(s)','ADDON','fc233c3f-25bc-4bba-8984-860ce561af86','2016-02-23 20:35:25',NULL,1),(87,'Skype for Business Plus CAL (Government Pricing)','Government','1 Month(s)','ADDON','65c891ba-418c-41ef-9f18-364ee7d6435c','2016-02-23 20:35:25',NULL,1),(88,'Visio Pro for Office 365','Corporate','1 Month(s)','NON-SPECIFIC','b4d4b7f4-4089-43b6-9c44-de97b760fb11','2016-02-23 20:35:25',NULL,1),(89,'Visio Pro for Office 365 (Government Pricing)','Government','1 Month(s)','NON-SPECIFIC','b0b0890d-f5bc-404e-898e-7b6932766528','2016-02-23 20:35:25',NULL,1),(90,'Yammer Enterprise','Corporate','1 Month(s)','NON-SPECIFIC','a3f4ab4e-6239-4ecb-a859-77369dca1c08','2016-02-23 20:35:25',NULL,1),(91,'Yammer Enterprise (Government Pricing)','Government','1 Month(s)','NON-SPECIFIC','8aa7e78b-b265-4ac6-ada0-14900a8a3f94','2016-02-23 20:35:25',NULL,1),(92,'Dynamics AX Additional Storage','Corporate','1 Month(s)','ADDON','007DDFBD-28FD-457E-B65A-7CD150538AB9','2016-02-23 20:35:25',NULL,1),(93,'Dynamics AX Device','Corporate','1 Month(s)','NON-SPECIFIC','82E1CCA5-8E8E-4385-9919-1C2AB2E1776F','2016-02-23 20:35:25',NULL,1),(94,'Dynamics AX Enterprise','Corporate','1 Month(s)','NON-SPECIFIC','9E23E01E-00D0-4402-A5EF-27B275411D5A','2016-02-23 20:35:25',NULL,1),(95,'Dynamics AX Sandbox Tier 1: Developer & Test Instance','Corporate','1 Month(s)','ADDON','4179016C-6039-4322-AA9E-0D39DB97861B','2016-02-23 20:35:26',NULL,1),(96,'Dynamics AX Sandbox Tier 2: Standard Acceptance testing','Corporate','1 Month(s)','ADDON','D8A131C6-8DF5-4048-8EB1-8E6FE7DBE23C','2016-02-23 20:35:26',NULL,1),(97,'Dynamics AX Sandbox Tier 3: Premier Acceptance testing','Corporate','1 Month(s)','ADDON','05DC36DB-1E45-4333-8E5A-E71C09A11591','2016-02-23 20:35:26',NULL,1),(98,'Dynamics AX Sandbox Tier 4: Standard Performance testing','Corporate','1 Month(s)','ADDON','D9624669-BA5A-4B5F-A360-98CDEE6CB4C5','2016-02-23 20:35:26',NULL,1),(99,'Dynamics AX Sandbox Tier 5: Premier Performance testing','Corporate','1 Month(s)','ADDON','435FB8EA-17BF-4499-9716-A52A7E65BB73','2016-02-23 20:35:26',NULL,1),(100,'Dynamics AX Self Serve','Corporate','1 Month(s)','NON-SPECIFIC','3A602B12-43AA-45CB-8FCD-A3FB61C75FF9','2016-02-23 20:35:26',NULL,1),(101,'Dynamics AX Task','Corporate','1 Month(s)','NON-SPECIFIC','87E44AEF-6B4C-402C-8A17-BCD33BF68C51','2016-02-23 20:35:26',NULL,1),(102,'Microsoft Azure Multi-Factor Authentication','Corporate','1 Month(s)','NON-SPECIFIC','F4753E83-1A85-4962-8D0A-C1DB12BC82AB','2016-02-23 20:35:26',NULL,1),(103,'Skype for Business PSTN Conferencing','Corporate','1 Month(s)','ADDON','c94271d8-b431-4a25-a3c5-a57737a1c909','2016-02-23 20:35:26',NULL,1),(104,'Skype for Business PSTN Conferencing (Government Pricing)','Government','1 Month(s)','ADDON','4ef473f8-b01a-48de-907f-7b20dd495e84','2016-02-23 20:35:26',NULL,1),(105,'Skype for Business PSTN Domestic and International Calling','Corporate','1 Month(s)','ADDON','ded34535-507f-4246-8370-f9180318c537','2016-02-23 20:35:26',NULL,1),(106,'Skype for Business PSTN Domestic and International Calling (Government Pricing)','Government','1 Month(s)','ADDON','d97b23b4-627c-41db-8f55-ce342b0db656','2016-02-23 20:35:26',NULL,1),(107,'Skype for Business PSTN Domestic Calling','Corporate','1 Month(s)','ADDON','0f598efe-f330-4d79-b79f-c9480bb7ce3e','2016-02-23 20:35:26',NULL,1),(108,'Skype for Business PSTN Domestic Calling (Government Pricing)','Government','1 Month(s)','ADDON','96b96fd8-b77d-41a4-ae5d-0a6652f454b7','2016-02-23 20:35:26',NULL,1),(109,'OneDrive for Business (Plan 2)','Corporate','1 Month(s)','NON-SPECIFIC','bf1f6907-1f8e-4f05-b327-4896d1395c15','2016-02-23 20:35:26',NULL,1),(110,'OneDrive for Business (Plan 2) (Government Pricing)','Government','1 Month(s)','NON-SPECIFIC','e2efc935-4a17-45ee-a643-bb59f1961261','2016-02-23 20:35:26',NULL,1),(111,'SharePoint Online (Plan 2)','Corporate','1 Month(s)','NON-SPECIFIC','69c67983-cf78-4102-83f6-3e5fd246864f','2016-02-23 20:35:26',NULL,1);
/*!40000 ALTER TABLE `offer` ENABLE KEYS */;
UNLOCK TABLES;

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
) ENGINE=InnoDB AUTO_INCREMENT=112 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `offer_price`
--

LOCK TABLES `offer_price` WRITE;
/*!40000 ALTER TABLE `offer_price` DISABLE KEYS */;
INSERT INTO `offer_price` VALUES (1,1,0.800,1.000,'2016-02-23 20:35:19',NULL),(2,2,0.700,0.900,'2016-02-23 20:35:19',NULL),(3,3,4.800,6.000,'2016-02-23 20:35:19',NULL),(4,4,4.080,5.100,'2016-02-23 20:35:20',NULL),(5,5,1.410,1.800,'2016-02-23 20:35:20',NULL),(6,6,1.600,2.000,'2016-02-23 20:35:20',NULL),(7,7,1.600,2.000,'2016-02-23 20:35:20',NULL),(8,8,1.400,1.800,'2016-02-23 20:35:20',NULL),(9,9,3.200,4.000,'2016-02-23 20:35:20',NULL),(10,10,2.800,3.500,'2016-02-23 20:35:20',NULL),(11,11,6.990,8.700,'2016-02-23 20:35:20',NULL),(12,12,6.150,7.700,'2016-02-23 20:35:20',NULL),(13,13,3.200,4.000,'2016-02-23 20:35:20',NULL),(14,14,6.400,8.000,'2016-02-23 20:35:20',NULL),(15,15,5.600,7.000,'2016-02-23 20:35:20',NULL),(16,16,1.600,2.000,'2016-02-23 20:35:20',NULL),(17,17,1.410,1.800,'2016-02-23 20:35:20',NULL),(18,18,2.400,3.000,'2016-02-23 20:35:21',NULL),(19,19,1.600,2.000,'2016-02-23 20:35:21',NULL),(20,20,1.600,2.000,'2016-02-23 20:35:21',NULL),(21,21,1.200,1.500,'2016-02-23 20:35:21',NULL),(22,22,2.800,3.500,'2016-02-23 20:35:21',NULL),(23,23,0.800,1.000,'2016-02-23 20:35:21',NULL),(24,24,4.090,5.100,'2016-02-23 20:35:21',NULL),(25,25,2.000,2.500,'2016-02-23 20:35:21',NULL),(26,26,112.500,150.000,'2016-02-23 20:35:21',NULL),(27,27,87.000,116.000,'2016-02-23 20:35:21',NULL),(28,28,411.750,549.000,'2016-02-23 20:35:22',NULL),(29,29,318.750,425.000,'2016-02-23 20:35:22',NULL),(30,30,7.500,10.000,'2016-02-23 20:35:22',NULL),(31,31,6.800,9.100,'2016-02-23 20:35:22',NULL),(32,32,22.500,30.000,'2016-02-23 20:35:22',NULL),(33,33,17.250,23.000,'2016-02-23 20:35:22',NULL),(34,34,11.250,15.000,'2016-02-23 20:35:22',NULL),(35,35,8.600,11.500,'2016-02-23 20:35:22',NULL),(36,36,48.750,65.000,'2016-02-23 20:35:22',NULL),(37,37,37.500,50.000,'2016-02-23 20:35:22',NULL),(38,38,37.500,50.000,'2016-02-23 20:35:22',NULL),(39,39,32.500,43.300,'2016-02-23 20:35:22',NULL),(40,40,4.800,6.000,'2016-02-23 20:35:22',NULL),(41,41,2.000,2.500,'2016-02-23 20:35:22',NULL),(42,42,75.000,100.000,'2016-02-23 20:35:22',NULL),(43,43,75.000,100.000,'2016-02-23 20:35:22',NULL),(44,44,52.500,70.000,'2016-02-23 20:35:22',NULL),(45,45,52.500,70.000,'2016-02-23 20:35:23',NULL),(46,46,30.000,40.000,'2016-02-23 20:35:23',NULL),(47,47,30.000,40.000,'2016-02-23 20:35:23',NULL),(48,48,6.400,8.000,'2016-02-23 20:35:23',NULL),(49,49,5.600,7.000,'2016-02-23 20:35:23',NULL),(50,50,6.600,8.300,'2016-02-23 20:35:23',NULL),(51,51,4.000,5.000,'2016-02-23 20:35:23',NULL),(52,52,10.000,12.500,'2016-02-23 20:35:23',NULL),(53,53,6.400,8.000,'2016-02-23 20:35:23',NULL),(54,54,4.800,6.000,'2016-02-23 20:35:23',NULL),(55,55,16.000,20.000,'2016-02-23 20:35:23',NULL),(56,56,13.600,17.000,'2016-02-23 20:35:23',NULL),(57,57,17.600,22.000,'2016-02-23 20:35:23',NULL),(58,58,15.200,19.000,'2016-02-23 20:35:23',NULL),(59,59,26.400,33.000,'2016-02-23 20:35:23',NULL),(60,60,22.440,28.100,'2016-02-23 20:35:23',NULL),(61,61,3.200,4.000,'2016-02-23 20:35:23',NULL),(62,62,2.400,3.000,'2016-02-23 20:35:23',NULL),(63,63,0.620,0.800,'2016-02-23 20:35:24',NULL),(64,64,0.160,0.200,'2016-02-23 20:35:24',NULL),(65,65,0.160,0.200,'2016-02-23 20:35:24',NULL),(66,66,9.600,12.000,'2016-02-23 20:35:24',NULL),(67,67,7.200,9.000,'2016-02-23 20:35:24',NULL),(68,68,4.000,5.000,'2016-02-23 20:35:24',NULL),(69,69,3.520,4.400,'2016-02-23 20:35:24',NULL),(70,70,7.990,10.000,'2016-02-23 20:35:24',NULL),(71,71,6.950,8.700,'2016-02-23 20:35:24',NULL),(72,72,5.600,7.000,'2016-02-23 20:35:24',NULL),(73,73,4.960,6.200,'2016-02-23 20:35:24',NULL),(74,74,26.400,33.000,'2016-02-23 20:35:24',NULL),(75,75,19.800,24.800,'2016-02-23 20:35:24',NULL),(76,76,46.400,58.000,'2016-02-23 20:35:24',NULL),(77,77,20.000,25.000,'2016-02-23 20:35:24',NULL),(78,78,17.220,21.500,'2016-02-23 20:35:24',NULL),(79,79,4.000,5.000,'2016-02-23 20:35:25',NULL),(80,80,6.400,8.000,'2016-02-23 20:35:25',NULL),(81,81,5.600,7.000,'2016-02-23 20:35:25',NULL),(82,82,1.600,2.000,'2016-02-23 20:35:25',NULL),(83,83,1.200,1.500,'2016-02-23 20:35:25',NULL),(84,84,4.400,5.500,'2016-02-23 20:35:25',NULL),(85,85,3.600,4.500,'2016-02-23 20:35:25',NULL),(86,86,1.600,2.000,'2016-02-23 20:35:25',NULL),(87,87,1.400,1.800,'2016-02-23 20:35:25',NULL),(88,88,10.400,13.000,'2016-02-23 20:35:25',NULL),(89,89,8.960,11.200,'2016-02-23 20:35:25',NULL),(90,90,2.400,3.000,'2016-02-23 20:35:25',NULL),(91,91,2.080,2.600,'2016-02-23 20:35:25',NULL),(92,92,6.990,10.000,'2016-02-23 20:35:25',NULL),(93,93,52.500,75.000,'2016-02-23 20:35:25',NULL),(94,94,133.000,190.100,'2016-02-23 20:35:26',NULL),(95,95,297.500,425.100,'2016-02-23 20:35:26',NULL),(96,96,945.000,1350.400,'2016-02-23 20:35:26',NULL),(97,97,2835.000,4051.100,'2016-02-23 20:35:26',NULL),(98,98,5530.000,7902.200,'2016-02-23 20:35:26',NULL),(99,99,8400.000,12003.400,'2016-02-23 20:35:26',NULL),(100,100,5.600,8.000,'2016-02-23 20:35:26',NULL),(101,101,21.000,30.000,'2016-02-23 20:35:26',NULL),(102,102,1.120,1.400,'2016-02-23 20:35:26',NULL),(103,103,3.200,4.000,'2016-02-23 20:35:26',NULL),(104,104,2.400,3.000,'2016-02-23 20:35:26',NULL),(105,105,19.200,24.000,'2016-02-23 20:35:26',NULL),(106,106,16.800,21.000,'2016-02-23 20:35:26',NULL),(107,107,9.600,12.000,'2016-02-23 20:35:26',NULL),(108,108,8.400,10.500,'2016-02-23 20:35:26',NULL),(109,109,8.000,10.000,'2016-02-23 20:35:26',NULL),(110,110,7.000,8.800,'2016-02-23 20:35:26',NULL),(111,111,8.000,10.000,'2016-02-23 20:35:27',NULL);
/*!40000 ALTER TABLE `offer_price` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `price`
--

DROP TABLE IF EXISTS `price`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `price` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `offer_id` int(11) NOT NULL,
  `list_price` decimal(12,3) DEFAULT NULL,
  `erp_price` decimal(12,3) DEFAULT NULL,
  `created` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `deleted` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `price`
--

LOCK TABLES `price` WRITE;
/*!40000 ALTER TABLE `price` DISABLE KEYS */;
INSERT INTO `price` VALUES (1,123456789,19.990,29.990,'2016-02-13 04:24:43',NULL);
/*!40000 ALTER TABLE `price` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `proposal`
--

DROP TABLE IF EXISTS `proposal`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `proposal` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `customer_id` int(11) NOT NULL,
  `saved_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `items` int(11) DEFAULT NULL,
  `our_cost` decimal(12,3) DEFAULT NULL,
  `msrp` decimal(12,3) DEFAULT NULL,
  `proposed_cost` decimal(12,3) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `proposal`
--

LOCK TABLES `proposal` WRITE;
/*!40000 ALTER TABLE `proposal` DISABLE KEYS */;
/*!40000 ALTER TABLE `proposal` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `proposal_item`
--

DROP TABLE IF EXISTS `proposal_item`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `proposal_item` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `offer_id` int(11) NOT NULL,
  `proposal_id` int(11) NOT NULL,
  `unit_count` int(11) DEFAULT NULL,
  `our_cost` decimal(12,3) DEFAULT NULL,
  `msrp` decimal(12,3) DEFAULT NULL,
  `proposed_cost` decimal(12,3) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `proposal_item`
--

LOCK TABLES `proposal_item` WRITE;
/*!40000 ALTER TABLE `proposal_item` DISABLE KEYS */;
/*!40000 ALTER TABLE `proposal_item` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `transactions`
--

DROP TABLE IF EXISTS `transactions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `transactions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `customer_id` int(11) DEFAULT NULL,
  `item_num` int(11) DEFAULT NULL,
  `sku` varchar(255) DEFAULT NULL,
  `product_name` varchar(255) DEFAULT NULL,
  `subscription_length` varchar(255) DEFAULT NULL,
  `product_cost` float DEFAULT NULL,
  `qty` int(11) DEFAULT NULL,
  `discount_rate` float DEFAULT NULL,
  `total_savings` float DEFAULT NULL,
  `total` float DEFAULT NULL,
  `transaction_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=42 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `transactions`
--

LOCK TABLES `transactions` WRITE;
/*!40000 ALTER TABLE `transactions` DISABLE KEYS */;
INSERT INTO `transactions` VALUES (30,1,1,'796b6b5f-613c-4e24-a17c-eba730d49c02','Office 365 Enterprise E3','1 month(s)',20,1,2,2.05,102.4,1),(31,1,2,'79c29af7-3cd0-4a6f-b182-a81e31dec84e','Enterprise Mobility Suite','1 month(s)',8.7,2,2,2.05,102.4,1),(32,1,3,'921cb1b8-a289-4437-a0b8-11104bcc3cba','Microsoft Dynamics CRM Online Professional','1 month(s)',65,1,2,2.05,102.4,1),(33,1,3,'921cb1b8-a289-4437-a0b8-11104bcc3cba','Microsoft Dynamics CRM Online Professional','1 month(s)',65,1,2,2.05,102.4,1),(34,1,1,'84a03d81-6b37-4d66-8d4a-faea24541538','Azure Active Directory Basic','1 month(s)',1,1,2,0.06,3,3),(35,1,2,'648bf77b-1f0a-4911-8066-caf37d67dc72','Azure Rights Management Premium','1 month(s)',2,1,2,0.06,3,3),(36,1,2,'648bf77b-1f0a-4911-8066-caf37d67dc72','Azure Rights Management Premium','1 month(s)',2,1,2,0.06,3,3),(37,1,1,'45320ec9-9b8e-49d0-b900-f14141a0abd1','Delve Analytics','1 month(s)',4,1,2,0.14,7,5),(38,1,2,'2828be95-46ba-4f91-b2fd-0bef192ecf60','Exchange Online Archiving for Exchange Online','1 month(s)',3,1,2,0.14,7,5),(39,1,2,'2828be95-46ba-4f91-b2fd-0bef192ecf60','Exchange Online Archiving for Exchange Online','1 month(s)',3,1,2,0.14,7,5),(40,1,1,'921cb1b8-a289-4437-a0b8-11104bcc3cba','Microsoft Dynamics CRM Online Professional','1 month(s)',65,1,2,1.3,65,7),(41,1,1,'921cb1b8-a289-4437-a0b8-11104bcc3cba','Microsoft Dynamics CRM Online Professional','1 month(s)',65,1,2,1.3,65,7);
/*!40000 ALTER TABLE `transactions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user` (
  `username` varchar(100) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `role` int(2) DEFAULT NULL,
  `create_time` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES ('test',1,'test@test.com',10,'2016-02-12 04:00:02');
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(200) DEFAULT NULL,
  `name` varchar(200) DEFAULT NULL,
  `first_name` varchar(200) DEFAULT NULL,
  `last_name` varchar(200) DEFAULT NULL,
  `gender` varchar(10) DEFAULT NULL,
  `birthday` varchar(20) DEFAULT NULL,
  `location` varchar(200) DEFAULT NULL,
  `hometown` varchar(200) DEFAULT NULL,
  `bio` text,
  `relationship` varchar(30) DEFAULT NULL,
  `timezone` varchar(10) DEFAULT NULL,
  `provider` varchar(10) DEFAULT NULL,
  `provider_id` int(30) DEFAULT NULL,
  `picture` text,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;
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

-- Dump completed on 2016-03-09 10:15:24
