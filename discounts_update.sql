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
  `offer_uri` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cart`
--

LOCK TABLES `cart` WRITE;
/*!40000 ALTER TABLE `cart` DISABLE KEYS */;
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
  `billing_id` varchar(255) DEFAULT NULL,
  `company_tid` varchar(255) DEFAULT NULL,
  `ms_key` varchar(45) DEFAULT NULL,
  `is_provised` tinyint(4) DEFAULT NULL,
  `primary_domain` varchar(255) DEFAULT NULL,
  `relationship` varchar(100) DEFAULT NULL,
  `discount` float DEFAULT NULL,
  `active` tinyint(4) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `customer`
--

LOCK TABLES `customer` WRITE;
/*!40000 ALTER TABLE `customer` DISABLE KEYS */;
INSERT INTO `customer` VALUES (1,'testing inc.','Corporate',NULL,NULL,NULL,1,'www.testing.onmicrosoft.com','CLOUD RESELLER',1,1),(2,'Fake inc.','Government',NULL,NULL,NULL,0,'www.fakeinc.onmicrosoft.com','CLOUD RESELLER',6.5,1),(6,'managedtesting123498798','Corporate',NULL,NULL,NULL,0,'managedtesting1234897987','CLOUD RESELLER',0,1),(10,'finaltesting','Corporate',NULL,NULL,NULL,0,'finaltesting1234','CLOUD RESELLER',0,1),(11,'jasonstestingcsp','Corporate',NULL,NULL,NULL,0,'jasonstestingcsp','CLOUD RESELLER',0,1),(12,'jasontest','Corporate',NULL,NULL,NULL,0,'jasontest1234','CLOUD RESELLER',0,1),(13,'Power Management Solutions','Corporate',NULL,NULL,NULL,0,'powermanagementsolutions','CLOUD RESELLER',0,1),(16,'jason sdk','Corporate',NULL,NULL,NULL,0,'jasonsdk','CLOUD RESELLER',0,1),(17,'testing','Corporate',NULL,NULL,NULL,0,'testingthisSDk','CLOUD RESELLER',0,1),(18,'final testing 55554444','Corporate','','',NULL,0,'finaltesting5555','Cloud Reseller',0,1),(19,'jasons12345','Corporate','a6e93bf1-041e-431a-9c60-0b75e455ee83','27b5f081-8bee-4008-b36a-66c45978294d',NULL,0,'jasons12345.onmicrosoft.com','Cloud Reseller',0,1),(20,'jasons123456','Corporate','7da2baa0-053f-4813-9234-3b3a9f5b0704','2f1e6233-8252-4115-b40a-723c9d409ec3',NULL,0,'jasons123456.onmicrosoft.com','Cloud Reseller',0,1),(21,'jasons1234567','Corporate','ccad252a-79d8-4323-8994-faaa31b8f074','4538b066-5530-415f-8308-0a2a8343f554',NULL,0,'jasons1234567.onmicrosoft.com','Cloud Reseller',0,1),(22,'mangedsolutiontesting','Corporate','1c0dd71c-c855-40f8-8d14-613a07d64ff2','e031010f-5d28-430d-99bb-74aee0c0f7fc',NULL,0,'managedsolutiontesting.onmicrosoft.com','Cloud Reseller',0,1),(23,'managed testing2','Corporate','ab0f5b0c-716d-4bec-8dd1-4e5f0ae8e6fe','be1fd16d-08ac-4ed8-a03e-ea6c2f377578',NULL,0,'managedtesting2.onmicrosoft.com','Cloud Reseller',0,1),(24,'managed testing3','Corporate','ed77f898-3399-46d7-aeae-527d10c94d97','e80927a7-deb2-41e7-90b6-1c113785842e',NULL,0,'managedtesting3.onmicrosoft.com','Cloud Reseller',0,1),(25,'managed testing4','Corporate','7447f665-dcbc-42ec-808b-e036eba3fecc','fb828080-7928-4fdf-b2e3-b9353af6233f',NULL,0,'managedtesting4.onmicrosoft.com','Cloud Reseller',0,1);
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
-- Table structure for table `image`
--

DROP TABLE IF EXISTS `image`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `image` (
  `offer_name` varchar(255) DEFAULT NULL,
  `img_tag` varchar(255) DEFAULT NULL,
  `details` varchar(510) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `image`
--

LOCK TABLES `image` WRITE;
/*!40000 ALTER TABLE `image` DISABLE KEYS */;
INSERT INTO `image` VALUES ('Azure Active Directory Basic','azure_active_directory.jpg','Windows Azure Active Directory, built on top of the free offering of Windows Azure AD, provides a robust set of capabilities to empower enterprises with more demanding needs on identity and access management'),('Azure Active Directory Basic (Government Pricing)','azure_active_directory.jpg','Windows Azure Active Directory, built on top of the free offering of Windows Azure AD, provides a robust set of capabilities to empower enterprises with more demanding needs on identity and access management.\n'),('Azure Active Directory Premium','azure_active_directory.jpg','Azure Active Directory Premium, built on top of the free offering of Microsoft Azure AD, provides a robust set of capabilities to empower enterprises with more demanding needs on identity and access management\n'),('Azure Active Directory Premium (Government Pricing)','azure_active_directory.jpg','Azure Active Directory Premium, built on top of the free offering of Microsoft Azure AD, provides a robust set of capabilities to empower enterprises with more demanding needs on identity and access management.\n'),('Azure Rights Management Premium','azure_rights_management.jpg','Microsoft Azure Rights Management Premium helps you protect confidential documents and email with strong encryption. Control the use of your information by specifying who can view, edit, print, save and share your data. Simple to use and integrated with Microsoft Office, SharePoint and Exchange.\n'),('Customer Lockbox','customer_lockbox.jpg','Customer Lockbox gives customers explicit control in the very rare instances when a Microsoft engineer may need access to customer content to resolve a customer issue.\n'),('Customer Lockbox (Government Pricing)','customer_lockbox.jpg','Customer Lockbox gives customers explicit control in the very rare instances when a Microsoft engineer may need access to customer content to resolve a customer issue.\n'),('Delve Analytics','delve_analytics.jpg','Delve Analytics uses big data to reveal how behaviors drive business outcomes. Leverage personal and \nteam work analytics dashboards to understand how you actually work, get time back and spend it more \neffectively.\n'),('Delve Analytics (Government Pricing)','delve_analytics.jpg','Delve Analytics uses big data to reveal how behaviors drive business outcomes. Leverage personal and \nteam work analytics dashboards to understand how you actually work, get time back and spend it more \neffectively.\n'),('Enterprise Mobility Suite','enterprise_mobility_suite.jpg','Enterprise Mobility Suite provides a convenient cost effective way for customers to purchase Microsoft\'s end user and device cloud services: Azure Active Directory Premium, Azure Rights Management Premium, and Windows Intune.\n'),('Enterprise Mobility Suite (Government Pricing)','enterprise_mobility_suite.jpg','Enterprise Mobility Suite provides a convenient cost effective way for customers to purchase Microsoft\'s end user and device cloud services: Azure Active Directory Premium, Azure Rights Management Premium, and Windows Intune.\n'),('Exchange Online (Plan 1)','exchange_online.jpg','Messaging, calendaring, and email archiving plan accessible from Outlook on PCs, the Web and mobile devices.\n'),('Exchange Online (Plan 2)','exchange_online.jpg','Best messaging and calendaring plan accessible from PCs, the Web and mobile devices with advanced archiving, compliance and integrated voicemail capabilities.\n'),('Exchange Online (Plan 2) (Government Pricing)','exchange_online.jpg','Best messaging and calendaring plan accessible from PCs, the Web and mobile devices with advanced archiving, compliance and integrated voicemail capabilities.\n'),('Exchange Online Advanced Threat Protection ','exchange_online_protection.jpg','Advanced Threat Protection for Exchange Online provides modern email protection techniques such as Safe Links and Safe Attachment, complementing the defense of Exchange Online Protection to protect your mailboxes against sophisticated attacks.\n'),('Exchange Online Advanced Threat Protection ','exchange_online_protection.jpg','Advanced Threat Protection for Exchange Online provides modern email protection techniques such as Safe Links and Safe Attachment, complementing the defense of Exchange Online Protection to protect your mailboxes against sophisticated attacks.\n'),('Exchange Online Advanced Threat Protection','exchange_online_protection.jpg','Advanced Threat Protection for Exchange Online provides modern email protection techniques such as Safe Links and Safe Attachment, complementing the defense of Exchange Online Protection to protect your mailboxes against sophisticated attacks.\n'),('Exchange Online Advanced Threat Protection (Government Pricing)','exchange_online_protection.jpg','Advanced Threat Protection for Exchange Online provides modern email protection techniques such as Safe Links and Safe Attachment, complementing the defense of Exchange Online Protection to protect your mailboxes against sophisticated attacks.\n'),('Exchange Online Archiving for Exchange Online','exchange_online_archiving.jpg','A personal e-mail archive for users who have mailboxes on Exchange Server 2010 or later.\n'),('Exchange Online Archiving for Exchange Online (Government Pricing)','exchange_online_archiving.jpg','A personal e-mail archive for users who have mailboxes on Exchange Server 2010 or later.\n'),('Exchange Online Kiosk','exchange_online_kiosk.jpg','Basic messaging and calendaring plan with Web email and POP access.\n'),('Exchange Online Kiosk (Government Pricing)','exchange_online_kiosk.jpg','Basic messaging and calendaring plan with Web email and POP access.\n'),('Exchange Online Plan 1 (Government Pricing)','exchange_online.jpg','Messaging, calendaring, and email archiving plan accessible from Outlook on PCs, the Web and mobile devices.\n'),('Exchange Online Protection','exchange_online_protection.jpg','Exchange Online Protection provides advanced anti-malware and anti-spam protection for email deployments.\n'),('Intune (Government Pricing)','intune.jpg','Microsoft Intune helps organizations provide their employees with access to corporate applications, data, and resources from anywhere on almost any device, while helping secure corporate information.\n'),('Intune Additional Storage (Government Pricing)','intune.jpg','Acquire additional storage at 1 GB increments to store applications for software distribution. The additional storage will be added to your company-wide application storage pool. Note: You must have an underlying paid Microsoft Intune™ subscription to purchase the Microsoft Intune™ Extra Storage.\n'),('Microsoft Dynamics CRM Online Additional Non-Production Instance','microsoft_dynamics_crm.jpg','Additional Microsoft Dynamics CRM Online non-production instance add-on to expand the number of non-production instances of Microsoft Dynamics CRM Online subscription.\n'),('Microsoft Dynamics CRM Online Additional Non-Production Instance','microsoft_dynamics_crm.jpg','Additional Microsoft Dynamics CRM Online non-production instance add-on to expand the number of non-production instances of Microsoft Dynamics CRM Online subscription.\n'),('Microsoft Dynamics CRM Online Additional Non-Production Instance','microsoft_dynamics_crm.jpg','Additional Microsoft Dynamics CRM Online non-production instance add-on to expand the number of non-production instances of Microsoft Dynamics CRM Online subscription.\n'),('Microsoft Dynamics CRM Online Additional Production Instance','microsoft_dynamics_crm.jpg','Additional Microsoft Dynamics CRM Online production instance add-on to expand the number of production instances of Microsoft Dynamics CRM Online subscription.\n'),('Microsoft Dynamics CRM Online Additional Production Instance (Government Pricing)','microsoft_dynamics_crm.jpg','Additional Microsoft Dynamics CRM Online production instance add-on to expand the number of production instances of Microsoft Dynamics CRM Online subscription.\n'),('Microsoft Dynamics CRM Online Additional Storage','microsoft_dynamics_crm.jpg','1 gigabyte Storage add-on to expand the storage capacity of Microsoft Dynamics CRM Online subscription.\n'),('Microsoft Dynamics CRM Online Basic','microsoft_dynamics_crm.jpg','Subscription plan for users who need access to accounts, contacts, leads, cases, reporting, and custom relationship management (xRM) capabilities of Microsoft Dynamics CRM Online.\n'),('Microsoft Dynamics CRM Online Basic (Government Pricing)','microsoft_dynamics_crm.jpg','Subscription plan for users who need access to accounts, contacts, leads, cases, reporting, and custom relationship management (xRM) capabilities of Microsoft Dynamics CRM Online.\n'),('Microsoft Dynamics CRM Online Essential','microsoft_dynamics_crm.jpg','Subscription plan for users who need access to custom relationship management (xRM) capabilities of Microsoft Dynamics CRM Online.\n'),('Microsoft Dynamics CRM Online Essential (Government Pricing)','microsoft_dynamics_crm.jpg','Subscription plan for users who need access to custom relationship management (xRM) capabilities of Microsoft Dynamics CRM Online.\n'),('Microsoft Dynamics CRM Online Professional','microsoft_dynamics_crm.jpg','The most comprehensive plan for users who need full sales, service, and marketing capabilities of Microsoft Dynamics CRM Online.\n'),('Microsoft Dynamics CRM Online Professional (Government Pricing)','microsoft_dynamics_crm.jpg','The most comprehensive plan for users who need full sales, service, and marketing capabilities of Microsoft Dynamics CRM Online.\n'),('Microsoft Dynamics CRM Online Professional Add-On to Office 365 ','microsoft_dynamics_crm.jpg','An add-on for Office 365 users who need the full sales, service, and marketing capabilities of Microsoft Dynamics CRM Online. This plan is available for new or existing Office 365 Enterprise E3, Office 365 Enterprise E4, Office 365 Enterprise E5, Office 365 Business Premium, or Enterprise Cloud Suite users.\n'),('Microsoft Dynamics CRM Online Professional Add-On to Office 365 (Government Pricing)','microsoft_dynamics_crm.jpg','An add-on for Office 365 users who need the full sales, service, and marketing capabilities of Microsoft Dynamics CRM Online. This plan is available for new or existing Office 365 Enterprise E3, Office 365 Enterprise E4, Office 365 Enterprise E5, Office 365 Business Premium, or Enterprise Cloud Suite users.\n'),('Microsoft Intune','intune.jpg','Microsoft Intune helps organizations provide their employees with access to corporate applications, data, and resources from anywhere on almost any device, while helping secure corporate information.\n'),('Microsoft Intune™ Extra Storage','intune.jpg','Acquire additional storage at 1 GB increments to store applications for software distribution. The additional storage will be added to your company-wide application storage pool. Note: You must have an underlying paid Microsoft Intune™ subscription to purchase the Microsoft Intune™ Extra Storage.\n'),('Microsoft Social Engagement Additional 10K Posts','microsoft-social-engagement.jpg','10,000 Posts per month to expand the search/listening capabilities of Microsoft Social Listening (no minimum).\n'),('Microsoft Social Engagement Additional 10K Posts (Government Pricing)','microsoft-social-engagement.jpg','10,000 Posts per month to expand the search/listening capabilities of Microsoft Social Listening (no minimum).\n'),('Microsoft Social Engagement Additional 10k Posts (minimum 10 licenses)','microsoft-social-engagement.jpg','10,000 Posts per month to expand the search/Engagement capabilities of Microsoft Social Engagement (minimum 10 licenses)\n'),('Microsoft Social Engagement Additional 10k Posts (minimum 10 licenses) (Government Pricing)','microsoft-social-engagement.jpg','10,000 Posts per month to expand the search/Engagement capabilities of Microsoft Social Engagement (minimum 10 licenses)\n'),('Microsoft Social Engagement Additional 10k Posts (minimum 100 licenses)','microsoft-social-engagement.jpg','10,000 Posts per month to expand the search/Engagement capabilities of Microsoft Social Engagement (minimum 100 licenses)\n'),('Microsoft Social Engagement Additional 10k Posts (minimum 100 licenses) (Government Pricing)','microsoft-social-engagement.jpg','10,000 Posts per month to expand the search/listening capabilities of Microsoft Social Listening (minimum 100 licenses)\n'),('Office 365 Business','office_365_business.jpg','For businesses with 1 to 300 users that need the latest desktop Office applications plus online file storage and sharing.\n'),('Office 365 Business Essentials','office_365_business_essentials.jpg','For businesses with 1 to 300 users that need anywhere access to email, file sharing, and online conferencing without a subscription to the desktop version of Office.\n'),('Office 365 Business Premium','office_365_business-premium.jpg','For businesses with 1 to 300 users that need the latest desktop version of Office, plus anywhere access to email, file sharing, and online conferencing.\n'),('Office 365 Business Premium','microsoft_365_business-premium.jpg','For businesses with 1 to 300 users that need the latest desktop version of Office, plus anywhere access to email, file sharing, and online conferencing.\n'),('Office 365 Business','microsoft_365_business.jpg','For businesses with 1 to 300 users that need the latest desktop Office applications plus online file storage and sharing.\n'),('Office 365 Enterprise E1','office_365_e1.jpg','For businesses that need communication and collaboration tools and the ability to read and do lightweight editing of documents with Office Online.\n'),('Office 365 Enterprise E1 (Government Pricing)','office_365_e1.jpg','For businesses that need communication and collaboration tools and the ability to read and do lightweight editing of documents with Office Online.\n'),('Office 365 Enterprise E3','office_365_e3.jpg','The best plan for businesses that need full productivity, communication and collaboration tools with the familiar Office suite, including Office Online.\n'),('Office 365 Enterprise E3 (Government Pricing)','office_365_e3.jpg','The best plan for businesses that need full productivity, communication and collaboration tools with the familiar Office suite, including Office Online.\n'),('Office 365 Enterprise E4','office_365_e4.jpg','For businesses that need full productivity, communication and collaboration tools with the familiar Office suite, including Office Online and on-premises server rights to information protection and enterprise voice capabilities.\n'),('Office 365 Enterprise E4 (Government Pricing)','office_365_e4.jpg','For businesses that need full productivity, communication and collaboration tools with the familiar Office suite, including Office Online and on-premises server rights to information protection and enterprise voice capabilities.\n'),('Office 365 Enterprise E4 (Government Pricing)','office_365_e4.jpg','For businesses that need full productivity, communication and collaboration tools with the familiar Office suite, including Office Online and on-premises server rights to information protection and enterprise voice capabilities.\n'),('Office 365 Enterprise E5 without PSTN Conferencing','office_365_e5.jpg','The best plan for businesses that need advanced security and analytics in addition to full productivity, communication and collaboration tools.\n'),('Office 365 Enterprise E5 without PSTN Conferencing (Government Pricing)','office_365_e5.jpg','The best plan for businesses that need advanced security and analytics in addition to full productivity, communication and collaboration tools.\n'),('Office 365 Enterprise K1','office_365_k1.jpg','For people in your business without a dedicated PC that need occasional access to web email, internal sites and documents with Office Online.\n'),('Office 365 Exchange Online Protection (Goverment Pricing)','exchange_online_protection.jpg',NULL),('Office 365 Extra File Storage','generic_office_logo.jpg','Priced per gigabyte, Office 365 offers additional file storage options to support an organization’s file growth.\n'),('Office 365 Extra File Storage','generic_office_logo.jpg','Priced per gigabyte, Office 365 offers additional file storage options to support an organization’s file growth.\n'),('Office 365 Extra File Storage (Government Pricing)','generic_office_logo.jpg','Priced per gigabyte, Office 365 offers additional file storage options to support an organization’s file growth.\n'),('Office 365 ProPlus','Office365-ProPlus.jpg','The premium Office suite for business - including Word, Excel, PowerPoint, Outlook, OneNote, Access, and Skype for Business - plus online file storage and sharing. Connected to the cloud, enabling you to roam between your devices of choice as part of the Office 365 experience.\n'),('Office 365 ProPlus (Government Pricing)','Office365-ProPlus.jpg','The premium Office suite for business - including Word, Excel, PowerPoint, Outlook, OneNote, Access, and Skype for Business - plus online file storage and sharing. Connected to the cloud, enabling you to roam between your devices of choice as part of the Office 365 experience.\n'),('OneDrive for Business (Plan 1)','OneDrive-for-Business.jpg','Convenient online companions to Microsoft Word, Excel, PowerPoint, and OneNote to do light editing of documents directly from your Web browser with OneDrive for Business.\n'),('OneDrive for Business (Plan 1) (Government Pricing)','OneDrive-for-Business.jpg','OneDrive for Business (Plan 2) provides personal cloud storage, offline access and sharing along with convenient online companions to Microsoft Word, Excel, PowerPoint, and OneNote to do light editing of documents directly from your Web browser. It also includes compliance and information protection for your files including legal hold, rights management and data loss prevention.\n'),('Power BI Pro','power_bi.jpg','Power BI is a cloud-based business analytics service that enables anyone to visualize and analyze data with greater speed, efficiency, and understanding. Power BI Pro provides extended data source support, data capacity, team collaboration and admin capabilities.\n'),('Power BI Pro (Government Pricing)','power_bi.jpg','Power BI is a cloud-based business analytics service that enables anyone to visualize and analyze data with greater speed, efficiency, and understanding. Power BI Pro provides extended data source support, data capacity, team collaboration and admin capabilities.\n'),('Project Lite','projectlite.jpg','Project Lite enables team members to collaborate on projects managed using Project Online, see tasks, enter timesheets, and flag issues or risks.\n'),('Project Lite (Government Pricing)','projectlite.jpg','Project Lite enables team members to collaborate on projects managed using Project Online, see tasks, enter timesheets, and flag issues or risks.\n'),('Project Online','project.jpg','A flexible solution for project portfolio management (PPM) and everyday work. Project Online enables organizations to get started, prioritize project portfolio investments and deliver with the intended business value. For people who need to participate online from virtually anywhere on almost any device.\n'),('Project Online (Government Pricing)','project.jpg','A flexible solution for project portfolio management (PPM) and everyday work. Project Online enables organizations to get started, prioritize project portfolio investments and deliver with the intended business value. For people who need to participate online from virtually anywhere on almost any device.\n'),('Project Online with Project Pro for Office 365','projectPRO.jpg','A flexible solution for project portfolio management (PPM) and everyday work. Project Online enables organizations to get started, prioritize project portfolio investments and deliver with the intended business value. Includes Project Pro for Office 365—for people who need to manage with full project management capabilities on the desktop and participate online from virtually anywhere on almost any device.\n'),('Project Pro for Office 365','projectPRO.jpg','Effectively plan, manage and collaborate with others from virtually anywhere to deliver winning projects. For people who need to manage with full project management capabilities on the desktop.\n'),('Project Pro for Office 365 (Government Pricing)','projectPRO.jpg','Effectively plan, manage and collaborate with others from virtually anywhere to deliver winning projects. For people who need to manage with full project management capabilities on the desktop.\n'),('SharePoint Online (Plan 1)','sharepoint.jpg','Collaboration plan that enables users to share, manage and search for information and resources.\n'),('Skype for Business Cloud PBX','skypeforbusiness.jpg','For businesses that need to enable call management capabilities (make, receive and transfer calls) in the cloud and use Office 365 administration portal as central location to manage users for communications. There are base pre-requisites required to purchase this offering.\n'),('Skype for Business Cloud PBX (Government Pricing)','skypeforbusiness.jpg','For businesses that need to enable call management capabilities (make, receive and transfer calls) in the cloud and use Office 365 administration portal as central location to manage users for communications. There are base pre-requisites required to purchase this offering.\n'),('Skype for Business Online (Plan 1)','skypeforbusiness.jpg','Unified communications plan that includes enterprise Instant Messaging, Presence and pc-to-pc audio and video calling capabilities.\n'),('Skype for Business Online (Plan 1) (Government Pricing)','skypeforbusiness.jpg','Unified communications plan that includes enterprise Instant Messaging, Presence and pc-to-pc audio and video calling capabilities.\n'),('Skype for Business Online (Plan 2)','skypeforbusiness.jpg','Unified communications plan with advanced capabilities including enterprise Instant Messaging, Presence and online meetings with audio and video conferencing and multiparty data sharing.\n'),('Skype for Business Online (Plan 2) (Government Pricing)','skypeforbusiness.jpg','Unified communications plan with advanced capabilities including enterprise Instant Messaging, Presence and online meetings with audio and video conferencing and multiparty data sharing.\n'),('Skype for Business Plus CAL','skypeforbusiness.jpg','Skype for Business Server Plus CAL authorizes users to access enterprise telephony and call management features in Skype for Business Server on any number of computers or other devices.\n'),('Skype for Business Plus CAL (Government Pricing)','skypeforbusiness.jpg','Skype for Business Server Plus CAL authorizes users to access enterprise telephony and call management features in Skype for Business Server on any number of computers or other devices.\n'),('Visio Pro for Office 365','visio-pro.jpg','Visio Pro for Office 365 gives you the ability to create professional and engaging diagrams – with a variety of new and updated shapes, stencils and themes – as well as adding support for BPMN 2.0 and UML 2.4. And it has new collaboration capabilities to facilitate working together as a team.\n'),('Visio Pro for Office 365 (Government Pricing)','visio-pro.jpg','Visio Pro for Office 365 gives you the ability to create professional and engaging diagrams – with a variety of new and updated shapes, stencils and themes – as well as adding support for BPMN 2.0 and UML 2.4. And it has new collaboration capabilities to facilitate working together as a team.\n'),('Yammer Enterprise','yammer.jpg','Best-in-class enterprise social for company collaboration, knowledge exchange, and team efficiency.\n'),('Yammer Enterprise (Government Pricing)','yammer.jpg','Best-in-class enterprise social for company collaboration, knowledge exchange, and team efficiency.\n'),('OneDrive for Business (Plan 2)','OneDrive-for-Business.jpg','OneDrive for Business (Plan 2) provides personal cloud storage, offline access and sharing along with convenient online companions to Microsoft Word, Excel, PowerPoint, and OneNote to do light editing of documents directly from your Web browser. It also includes compliance and information protection for your files including legal hold, rights management and data loss prevention.\n'),('OneDrive for Business (Plan 2) (Government Pricing)','OneDrive-for-Business.jpg','OneDrive for Business (Plan 2) provides personal cloud storage, offline access and sharing along with convenient online companions to Microsoft Word, Excel, PowerPoint, and OneNote to do light editing of documents directly from your Web browser. It also includes compliance and information protection for your files including legal hold, rights management and data loss prevention.\n'),('SharePoint Online (Plan 2)','sharepoint.jpg','Best collaboration plan with advanced capabilities for rich forms, enhanced data visualization, publishing of Access databases, and hosted Visio diagrams.\n'),('Office 365 Advanced eDiscovery','noImage.png','Office 365 Advanced eDiscovery fully integrates the Equivio machine learning, predictive coding and text analytics platform, to reduce the costs and challenges that come along with sorting through large quantities of data for eDiscovery purposes by quickly zeroing in on what is relevant.\n'),('Office 365 Advanced eDiscovery (Government Pricing)','noImage.png','Office 365 Advanced eDiscovery fully integrates the Equivio machine learning, predictive coding and text analytics platform, to reduce the costs and challenges that come along with sorting through large quantities of data for eDiscovery purposes by quickly zeroing in on what is relevant.\n'),('Microsoft Dynamics CRM Online Additional Non-Production Instance (Government Pricing)','microsoft_dynamics_crm.jpg','Additional Microsoft Dynamics CRM Online non-production instance add-on to expand the number of non-production instances of Microsoft Dynamics CRM Online subscription.\n'),('Microsoft Dynamics CRM Online Professional Add-On to Office 365','microsoft_dynamics_crm.jpg','An add-on for Office 365 users who need the full sales, service, and marketing capabilities of Microsoft Dynamics CRM Online. This plan is available for new or existing Office 365 Enterprise E3, Office 365 Enterprise E4, Office 365 Enterprise E5, Office 365 Business Premium, or Enterprise Cloud Suite users.\n'),('Microsoft Dynamics CRM Online Professional Add-On to Office 365 (Government Pricing)','microsoft_dynamics_crm.jpg','An add-on for Office 365 users who need the full sales, service, and marketing capabilities of Microsoft Dynamics CRM Online. This plan is available for new or existing Office 365 Enterprise E3, Office 365 Enterprise E4, Office 365 Enterprise E5, Office 365 Business Premium, or Enterprise Cloud Suite users.\n');
/*!40000 ALTER TABLE `image` ENABLE KEYS */;
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
  `offer_uri` varchar(255) NOT NULL,
  `created` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `deleted` timestamp NULL DEFAULT NULL,
  `active` tinyint(4) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=114 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `offer`
--

LOCK TABLES `offer` WRITE;
/*!40000 ALTER TABLE `offer` DISABLE KEYS */;
INSERT INTO `offer` VALUES (1,'Azure Active Directory Basic','Corporate','1 Month(s)','NON-SPECIFIC','84a03d81-6b37-4d66-8d4a-faea24541538','/3c95518e-8c37-41e3-9627-0ca339200f53/offers/84A03D81-6B37-4D66-8D4A-FAEA24541538','2016-02-23 20:35:19',NULL,1),(2,'Azure Active Directory Basic (Government Pricing)','Government','1 Month(s)','NON-SPECIFIC','0a7983cd-961f-4c7c-9cbf-1f6bb322cbf3','/3c95518e-8c37-41e3-9627-0ca339200f53/offers/0A7983CD-961F-4C7C-9CBF-1F6BB322CBF3','2016-02-23 20:35:19',NULL,1),(3,'Azure Active Directory Premium','Corporate','1 Month(s)','NON-SPECIFIC','16c9f982-a827-4003-a88e-e75df1927f27','/3c95518e-8c37-41e3-9627-0ca339200f53/offers/16C9F982-A827-4003-A88E-E75DF1927F27','2016-02-23 20:35:19',NULL,1),(4,'Azure Active Directory Premium (Government Pricing)','Government','1 Month(s)','NON-SPECIFIC','ceca6875-f3ba-4f9a-916f-9cc9e322d4aa','/3c95518e-8c37-41e3-9627-0ca339200f53/offers/CECA6875-F3BA-4F9A-916F-9CC9E322D4AA','2016-02-23 20:35:20',NULL,1),(6,'Azure Rights Management Premium','Corporate','1 Month(s)','NON-SPECIFIC','648bf77b-1f0a-4911-8066-caf37d67dc72','/3c95518e-8c37-41e3-9627-0ca339200f53/offers/648BF77B-1F0A-4911-8066-CAF37D67DC72','2016-02-23 20:35:20',NULL,1),(7,'Customer Lockbox','Corporate','1 Month(s)','ADDON','68f6373c-31cb-43f0-bfaa-85f3688f8cfb','/3c95518e-8c37-41e3-9627-0ca339200f53/offers/68F6373C-31CB-43F0-BFAA-85F3688F8CFB','2016-02-23 20:35:20',NULL,1),(8,'Customer Lockbox (Government Pricing)','Government','1 Month(s)','ADDON','f8a22f25-2b60-4fdb-b920-b0bec26bff5f','/3c95518e-8c37-41e3-9627-0ca339200f53/offers/F8A22F25-2B60-4FDB-B920-B0BEC26BFF5F','2016-02-23 20:35:20',NULL,1),(9,'Delve Analytics','Corporate','1 Month(s)','ADDON','45320ec9-9b8e-49d0-b900-f14141a0abd1','/3c95518e-8c37-41e3-9627-0ca339200f53/offers/45320EC9-9B8E-49D0-B900-F14141A0ABD1','2016-02-23 20:35:20',NULL,1),(10,'Delve Analytics (Government Pricing)','Government','1 Month(s)','ADDON','58de892e-9962-4477-96f9-bc1bef83a02c','/3c95518e-8c37-41e3-9627-0ca339200f53/offers/58DE892E-9962-4477-96F9-BC1BEF83A02C','2016-02-23 20:35:20',NULL,1),(11,'Enterprise Mobility Suite','Corporate','1 Month(s)','NON-SPECIFIC','79c29af7-3cd0-4a6f-b182-a81e31dec84e','/3c95518e-8c37-41e3-9627-0ca339200f53/offers/79C29AF7-3CD0-4A6F-B182-A81E31DEC84E','2016-02-23 20:35:20',NULL,1),(12,'Enterprise Mobility Suite (Government Pricing)','Government','1 Month(s)','NON-SPECIFIC','461d7db7-ec67-4671-bf9b-22efde413f0f','/3c95518e-8c37-41e3-9627-0ca339200f53/offers/461D7DB7-EC67-4671-BF9B-22EFDE413F0F','2016-02-23 20:35:20',NULL,1),(13,'Exchange Online (Plan 1)','Corporate','1 Month(s)','NON-SPECIFIC','195416c1-3447-423a-b37b-ee59a99a19c4','/3c95518e-8c37-41e3-9627-0ca339200f53/offers/195416C1-3447-423A-B37B-EE59A99A19C4','2016-02-23 20:35:20',NULL,1),(14,'Exchange Online (Plan 2)','Corporate','1 Month(s)','NON-SPECIFIC','2f707c7c-2433-49a5-a437-9ca7cf40d3eb','/3c95518e-8c37-41e3-9627-0ca339200f53/offers/2F707C7C-2433-49A5-A437-9CA7CF40D3EB','2016-02-23 20:35:20',NULL,1),(15,'Exchange Online (Plan 2) (Government Pricing)','Government','1 Month(s)','NON-SPECIFIC','ec0d51df-916f-4455-a096-5ab08f58dbd2','/3c95518e-8c37-41e3-9627-0ca339200f53/offers/EC0D51DF-916F-4455-A096-5AB08F58DBD2','2016-02-23 20:35:20',NULL,1),(16,'Exchange Online Advanced Threat Protection ','Corporate','1 Month(s)','ADDON','a2706f86-868d-4048-989b-0c69e5c76b63','/3c95518e-8c37-41e3-9627-0ca339200f53/offers/A2706F86-868D-4048-989B-0C69E5C76B63','2016-02-23 20:35:20',NULL,1),(17,'Exchange Online Advanced Threat Protection (Government Pricing)','Government','1 Month(s)','ADDON','84690799-e043-4de3-b4bd-3e6493283c92','/3c95518e-8c37-41e3-9627-0ca339200f53/offers/84690799-E043-4DE3-B4BD-3E6493283C92','2016-02-23 20:35:20',NULL,1),(18,'Exchange Online Archiving for Exchange Online','Corporate','1 Month(s)','ADDON','2828be95-46ba-4f91-b2fd-0bef192ecf60','/3c95518e-8c37-41e3-9627-0ca339200f53/offers/2828BE95-46BA-4F91-B2FD-0BEF192ECF60','2016-02-23 20:35:20',NULL,1),(19,'Exchange Online Archiving for Exchange Online (Government Pricing)','Government','1 Month(s)','NON-SPECIFIC','cb038730-6cbe-47b9-afd4-ca7fa5d0c39b','/3c95518e-8c37-41e3-9627-0ca339200f53/offers/CB038730-6CBE-47B9-AFD4-CA7FA5D0C39B','2016-02-23 20:35:21',NULL,1),(20,'Exchange Online Kiosk','Corporate','1 Month(s)','NON-SPECIFIC','35a36b80-270a-44bf-9290-00545d350866','/3c95518e-8c37-41e3-9627-0ca339200f53/offers/35A36B80-270A-44BF-9290-00545D350866','2016-02-23 20:35:21',NULL,1),(21,'Exchange Online Kiosk (Government Pricing)','Government','1 Month(s)','NON-SPECIFIC','22b61e04-b7eb-4405-9cb3-6a4407b9f95a','/3c95518e-8c37-41e3-9627-0ca339200f53/offers/22B61E04-B7EB-4405-9CB3-6A4407B9F95A','2016-02-23 20:35:21',NULL,1),(22,'Exchange Online Plan 1 (Government Pricing)','Government','1 Month(s)','NON-SPECIFIC','24cc266d-6fd3-4b85-b9c8-4d5f587521ac','/3c95518e-8c37-41e3-9627-0ca339200f53/offers/24CC266D-6FD3-4B85-B9C8-4D5F587521AC','2016-02-23 20:35:21',NULL,1),(23,'Exchange Online Protection','Corporate','1 Month(s)','NON-SPECIFIC','d903a2db-bf6f-4434-83f1-21ba44017813','/3c95518e-8c37-41e3-9627-0ca339200f53/offers/D903A2DB-BF6F-4434-83F1-21BA44017813','2016-02-23 20:35:21',NULL,1),(24,'Intune (Government Pricing)','Government','1 Month(s)','NON-SPECIFIC','16879030-563b-4c89-9586-2cb79ed270ee','/3c95518e-8c37-41e3-9627-0ca339200f53/offers/16879030-563B-4C89-9586-2CB79ED270EE','2016-02-23 20:35:21',NULL,1),(25,'Intune Additional Storage (Government Pricing)','Government','1 Month(s)','NON-SPECIFIC','1641fe13-5a95-4ba7-a5eb-740caee8d509','/3c95518e-8c37-41e3-9627-0ca339200f53/offers/1641FE13-5A95-4BA7-A5EB-740CAEE8D509','2016-02-23 20:35:21',NULL,1),(26,'Microsoft Dynamics CRM Online Additional Non-Production Instance','Corporate','1 Month(s)','ADDON','3396e762-af96-42f1-bea4-5c97a1efa94f','/3c95518e-8c37-41e3-9627-0ca339200f53/offers/3396E762-AF96-42F1-BEA4-5C97A1EFA94F','2016-02-23 20:35:21',NULL,1),(27,'Microsoft Dynamics CRM Online Additional Non-Production Instance (Government Pricing)','Government','1 Month(s)','ADDON','f5a22ff0-71e6-4569-92a9-826290151fd8','/3c95518e-8c37-41e3-9627-0ca339200f53/offers/F5A22FF0-71E6-4569-92A9-826290151FD8','2016-02-23 20:35:21',NULL,1),(28,'Microsoft Dynamics CRM Online Additional Production Instance','Corporate','1 Month(s)','ADDON','2bcf9fe8-8b65-4fcf-9240-419203fb8cf4','/3c95518e-8c37-41e3-9627-0ca339200f53/offers/2BCF9FE8-8B65-4FCF-9240-419203FB8CF4','2016-02-23 20:35:21',NULL,1),(29,'Microsoft Dynamics CRM Online Additional Production Instance (Government Pricing)','Government','1 Month(s)','ADDON','d99c49c8-c9eb-4651-b8b8-5ec217b8ccd8','/3c95518e-8c37-41e3-9627-0ca339200f53/offers/D99C49C8-C9EB-4651-B8B8-5EC217B8CCD8','2016-02-23 20:35:22',NULL,1),(30,'Microsoft Dynamics CRM Online Additional Storage','Corporate','1 Month(s)','ADDON','fbf0328a-8b0f-47a6-9483-dc2b36183fce','/3c95518e-8c37-41e3-9627-0ca339200f53/offers/FBF0328A-8B0F-47A6-9483-DC2B36183FCE','2016-02-23 20:35:22',NULL,1),(32,'Microsoft Dynamics CRM Online Basic','Corporate','1 Month(s)','NON-SPECIFIC','ffb8bb89-9573-4e76-840f-6521450325a1','/3c95518e-8c37-41e3-9627-0ca339200f53/offers/FFB8BB89-9573-4E76-840F-6521450325A1','2016-02-23 20:35:22',NULL,1),(33,'Microsoft Dynamics CRM Online Basic (Government Pricing)','Government','1 Month(s)','NON-SPECIFIC','66eaff1c-2d07-40ce-a66f-8e49987fe910','/3c95518e-8c37-41e3-9627-0ca339200f53/offers/66EAFF1C-2D07-40CE-A66F-8E49987FE910','2016-02-23 20:35:22',NULL,1),(34,'Microsoft Dynamics CRM Online Essential','Corporate','1 Month(s)','NON-SPECIFIC','d431de8a-1ac2-49dd-a6f5-07f3a0a880ff','/3c95518e-8c37-41e3-9627-0ca339200f53/offers/D431DE8A-1AC2-49DD-A6F5-07F3A0A880FF','2016-02-23 20:35:22',NULL,1),(35,'Microsoft Dynamics CRM Online Essential (Government Pricing)','Government','1 Month(s)','NON-SPECIFIC','378a8b77-e3f3-4ab7-a784-a6803f2e78e9','/3c95518e-8c37-41e3-9627-0ca339200f53/offers/378A8B77-E3F3-4AB7-A784-A6803F2E78E9','2016-02-23 20:35:22',NULL,1),(36,'Microsoft Dynamics CRM Online Professional','Corporate','1 Month(s)','NON-SPECIFIC','921cb1b8-a289-4437-a0b8-11104bcc3cba','/3c95518e-8c37-41e3-9627-0ca339200f53/offers/921CB1B8-A289-4437-A0B8-11104BCC3CBA','2016-02-23 20:35:22',NULL,1),(37,'Microsoft Dynamics CRM Online Professional (Government Pricing)','Government','1 Month(s)','NON-SPECIFIC','4271aa57-4129-477e-ba88-0a276d4a1619','/3c95518e-8c37-41e3-9627-0ca339200f53/offers/4271AA57-4129-477E-BA88-0A276D4A1619','2016-02-23 20:35:22',NULL,1),(38,'Microsoft Dynamics CRM Online Professional Add-On to Office 365 ','Corporate','1 Month(s)','NON-SPECIFIC','4443cb9e-651e-4295-be7c-5bc89d1e3916','/3c95518e-8c37-41e3-9627-0ca339200f53/offers/4443CB9E-651E-4295-BE7C-5BC89D1E3916','2016-02-23 20:35:22',NULL,1),(39,'Microsoft Dynamics CRM Online Professional Add-On to Office 365 (Government Pricing)','Government','1 Month(s)','NON-SPECIFIC','2a5454d2-08a8-4162-9ab9-32963b8cc5d0','/3c95518e-8c37-41e3-9627-0ca339200f53/offers/2A5454D2-08A8-4162-9AB9-32963B8CC5D0','2016-02-23 20:35:22',NULL,1),(40,'Microsoft Intune','Corporate','1 Month(s)','NON-SPECIFIC','51e95709-dc35-4780-9040-22278cb7c0e1','/3c95518e-8c37-41e3-9627-0ca339200f53/offers/51E95709-DC35-4780-9040-22278CB7C0E1','2016-02-23 20:35:22',NULL,1),(41,'Microsoft Intune™ Extra Storage','Corporate','1 Month(s)','ADDON','ced5f693-2d40-40ae-8848-9809ab1b0ee9','/3c95518e-8c37-41e3-9627-0ca339200f53/offers/CED5F693-2D40-40AE-8848-9809AB1B0EE9','2016-02-23 20:35:22',NULL,1),(42,'Microsoft Social Engagement Additional 10K Posts','Corporate','1 Month(s)','ADDON','145A2B93-3583-4A9A-8564-BCDC20714651','/3c95518e-8c37-41e3-9627-0ca339200f53/offers/145A2B93-3583-4A9A-8564-BCDC20714651','2016-02-23 20:35:22',NULL,1),(43,'Microsoft Social Engagement Additional 10K Posts (Government Pricing)','Government','1 Month(s)','ADDON','21e4b963-3d7c-4bde-946c-b4110e4de0bf','/3c95518e-8c37-41e3-9627-0ca339200f53/offers/21E4B963-3D7C-4BDE-946C-B4110E4DE0BF','2016-02-23 20:35:22',NULL,1),(44,'Microsoft Social Engagement Additional 10k Posts (minimum 10 licenses)','Corporate','1 Month(s)','ADDON','CBE22A27-20C4-48AD-B8D2-F41644DDC0B2','/3c95518e-8c37-41e3-9627-0ca339200f53/offers/CBE22A27-20C4-48AD-B8D2-F41644DDC0B2','2016-02-23 20:35:22',NULL,1),(45,'Microsoft Social Engagement Additional 10k Posts (minimum 10 licenses) (Government Pricing)','Government','1 Month(s)','ADDON','853bc104-2ce1-4727-ac31-3c454bcb0e73','/3c95518e-8c37-41e3-9627-0ca339200f53/offers/853BC104-2CE1-4727-AC31-3C454BCB0E73','2016-02-23 20:35:23',NULL,1),(46,'Microsoft Social Engagement Additional 10k Posts (minimum 100 licenses)','Corporate','1 Month(s)','ADDON','D91596FF-B990-4A15-A9F0-704B91DB2583','/3c95518e-8c37-41e3-9627-0ca339200f53/offers/D91596FF-B990-4A15-A9F0-704B91DB2583','2016-02-23 20:35:23',NULL,1),(47,'Microsoft Social Engagement Additional 10k Posts (minimum 100 licenses) (Government Pricing)','Government','1 Month(s)','ADDON','59e61ebc-b1f5-4e58-9887-ecf6993d38e8','/3c95518e-8c37-41e3-9627-0ca339200f53/offers/59E61EBC-B1F5-4E58-9887-ECF6993D38E8','2016-02-23 20:35:23',NULL,1),(48,'Office 365 Advanced eDiscovery','Corporate','1 Month(s)','ADDON','6b648c1e-f472-46c0-8379-09f50a3315e0','/3c95518e-8c37-41e3-9627-0ca339200f53/offers/6B648C1E-F472-46C0-8379-09F50A3315E0','2016-02-23 20:35:23',NULL,1),(49,'Office 365 Advanced eDiscovery (Government Pricing)','Government','1 Month(s)','ADDON','c11d32d0-7943-4137-9fcc-40797c9bea85','/3c95518e-8c37-41e3-9627-0ca339200f53/offers/C11D32D0-7943-4137-9FCC-40797C9BEA85','2016-02-23 20:35:23',NULL,1),(50,'Office 365 Business','Corporate','1 Month(s)','NON-SPECIFIC','5c9fd4cc-edce-44a8-8e91-07df09744609','/3c95518e-8c37-41e3-9627-0ca339200f53/offers/5C9FD4CC-EDCE-44A8-8E91-07DF09744609','2016-02-23 20:35:23',NULL,1),(51,'Office 365 Business Essentials','Corporate','1 Month(s)','NON-SPECIFIC','bd938f12-058f-4927-bba3-ae36b1d2501c','/3c95518e-8c37-41e3-9627-0ca339200f53/offers/BD938F12-058F-4927-BBA3-AE36B1D2501C','2016-02-23 20:35:23',NULL,1),(52,'Office 365 Business Premium','Corporate','1 Month(s)','NON-SPECIFIC','031c9e47-4802-4248-838e-778fb1d2cc05','/3c95518e-8c37-41e3-9627-0ca339200f53/offers/031C9E47-4802-4248-838E-778FB1D2CC05','2016-02-23 20:35:23',NULL,1),(53,'Office 365 Enterprise E1','Corporate','1 Month(s)','NON-SPECIFIC','91fd106f-4b2c-4938-95ac-f54f74e9a239','/3c95518e-8c37-41e3-9627-0ca339200f53/offers/91FD106F-4B2C-4938-95AC-F54F74E9A239','2016-02-23 20:35:23',NULL,1),(54,'Office 365 Enterprise E1 (Government Pricing)','Government','1 Month(s)','NON-SPECIFIC','cfc69058-5106-40bd-81e4-44e0e29034b2','/3c95518e-8c37-41e3-9627-0ca339200f53/offers/CFC69058-5106-40BD-81E4-44E0E29034B2','2016-02-23 20:35:23',NULL,1),(55,'Office 365 Enterprise E3','Corporate','1 Month(s)','NON-SPECIFIC','796b6b5f-613c-4e24-a17c-eba730d49c02','/3c95518e-8c37-41e3-9627-0ca339200f53/offers/796B6B5F-613C-4E24-A17C-EBA730D49C02','2016-02-23 20:35:23',NULL,1),(56,'Office 365 Enterprise E3 (Government Pricing)','Government','1 Month(s)','NON-SPECIFIC','6b551829-de8c-41e5-8678-41d52c27aee8','/3c95518e-8c37-41e3-9627-0ca339200f53/offers/6B551829-DE8C-41E5-8678-41D52C27AEE8','2016-02-23 20:35:23',NULL,1),(57,'Office 365 Enterprise E4','Corporate','1 Month(s)','NON-SPECIFIC','8909e28e-5832-42f4-9886-b0a5545f3645','/3c95518e-8c37-41e3-9627-0ca339200f53/offers/8909E28E-5832-42F4-9886-B0A5545F3645','2016-02-23 20:35:23',NULL,1),(58,'Office 365 Enterprise E4 (Government Pricing)','Government','1 Month(s)','NON-SPECIFIC','379dc555-ddcb-4ccb-bebf-37437333e278','/3c95518e-8c37-41e3-9627-0ca339200f53/offers/379DC555-DDCB-4CCB-BEBF-37437333E278','2016-02-23 20:35:23',NULL,1),(59,'Office 365 Enterprise E5 without PSTN Conferencing','Corporate','1 Month(s)','NON-SPECIFIC','4f7ecaf1-e9d6-4cac-9687-e22eb3dfdd70','/3c95518e-8c37-41e3-9627-0ca339200f53/offers/4F7ECAF1-E9D6-4CAC-9687-E22EB3DFDD70','2016-02-23 20:35:23',NULL,1),(60,'Office 365 Enterprise E5 without PSTN Conferencing (Government Pricing)','Government','1 Month(s)','NON-SPECIFIC','c4158aa7-00e7-4ce1-9cf3-3cf8321f377a','/3c95518e-8c37-41e3-9627-0ca339200f53/offers/C4158AA7-00E7-4CE1-9CF3-3CF8321F377A','2016-02-23 20:35:23',NULL,1),(61,'Office 365 Enterprise K1','Corporate','1 Month(s)','NON-SPECIFIC','6fbad345-b7de-42a6-b6ab-79b363d0b371','/3c95518e-8c37-41e3-9627-0ca339200f53/offers/6FBAD345-B7DE-42A6-B6AB-79B363D0B371','2016-02-23 20:35:23',NULL,1),(63,'Office 365 Exchange Online Protection (Goverment Pricing)','Government','1 Month(s)','NON-SPECIFIC','0cca44d6-68e9-4762-94ee-31ece98783b9','/3c95518e-8c37-41e3-9627-0ca339200f53/offers/0CCA44D6-68E9-4762-94EE-31ECE98783B9','2016-02-23 20:35:24',NULL,1),(64,'Office 365 Extra File Storage','Corporate','1 Month(s)','ADDON','53fc25f7-6639-4f78-bb44-3c2dfec3ed40','/3c95518e-8c37-41e3-9627-0ca339200f53/offers/53FC25F7-6639-4F78-BB44-3C2DFEC3ED40','2016-02-23 20:35:24',NULL,1),(65,'Office 365 Extra File Storage (Government Pricing)','Government','1 Month(s)','NON-SPECIFIC','3ea7e320-65e2-45f0-abf5-6f6fabb2255b','/3c95518e-8c37-41e3-9627-0ca339200f53/offers/3EA7E320-65E2-45F0-ABF5-6F6FABB2255B','2016-02-23 20:35:24',NULL,1),(66,'Office 365 ProPlus','Corporate','1 Month(s)','NON-SPECIFIC','be57ff4c-100c-4f1f-b82d-f1c5ab63a665','/3c95518e-8c37-41e3-9627-0ca339200f53/offers/BE57FF4C-100C-4F1F-B82D-F1C5AB63A665','2016-02-23 20:35:24',NULL,1),(67,'Office 365 ProPlus (Government Pricing)','Government','1 Month(s)','NON-SPECIFIC','2b6f895d-dfd3-4fb5-8c8c-1a551c9db59a','/3c95518e-8c37-41e3-9627-0ca339200f53/offers/2B6F895D-DFD3-4FB5-8C8C-1A551C9DB59A','2016-02-23 20:35:24',NULL,1),(68,'OneDrive for Business (Plan 1)','Corporate','1 Month(s)','NON-SPECIFIC','90d3615e-aa96-478e-b6ce-8eb1e9a96b4b','/3c95518e-8c37-41e3-9627-0ca339200f53/offers/90D3615E-AA96-478E-B6CE-8EB1E9A96B4B','2016-02-23 20:35:24',NULL,1),(69,'OneDrive for Business (Plan 1) (Government Pricing)','Government','1 Month(s)','NON-SPECIFIC','8f827dc9-5d95-4321-b4b3-a0ee086d02a3','/3c95518e-8c37-41e3-9627-0ca339200f53/offers/8F827DC9-5D95-4321-B4B3-A0EE086D02A3','2016-02-23 20:35:24',NULL,1),(70,'Power BI Pro','Corporate','1 Month(s)','NON-SPECIFIC','800f4f3b-cfe1-42c1-9cea-675512810488','/3c95518e-8c37-41e3-9627-0ca339200f53/offers/800F4F3B-CFE1-42C1-9CEA-675512810488','2016-02-23 20:35:24',NULL,1),(71,'Power BI Pro (Government Pricing)','Government','1 Month(s)','NON-SPECIFIC','a6acbc1c-9d2a-482a-abda-dfb9285e301e','/3c95518e-8c37-41e3-9627-0ca339200f53/offers/A6ACBC1C-9D2A-482A-ABDA-DFB9285E301E','2016-02-23 20:35:24',NULL,1),(72,'Project Lite','Corporate','1 Month(s)','NON-SPECIFIC','a4179d30-cc09-49f0-977e-dc2cb70b874f','/3c95518e-8c37-41e3-9627-0ca339200f53/offers/A4179D30-CC09-49F0-977E-DC2CB70B874F','2016-02-23 20:35:24',NULL,1),(73,'Project Lite (Government Pricing)','Government','1 Month(s)','NON-SPECIFIC','af87bced-1900-4bde-9037-9356bc08e235','/3c95518e-8c37-41e3-9627-0ca339200f53/offers/AF87BCED-1900-4BDE-9037-9356BC08E235','2016-02-23 20:35:24',NULL,1),(74,'Project Online','Corporate','1 Month(s)','NON-SPECIFIC','1f1d89ab-6c52-4a16-a9b6-b358edb27aab','/3c95518e-8c37-41e3-9627-0ca339200f53/offers/1F1D89AB-6C52-4A16-A9B6-B358EDB27AAB','2016-02-23 20:35:24',NULL,1),(75,'Project Online (Government Pricing)','Government','1 Month(s)','NON-SPECIFIC','fa86a86a-2266-41ef-91ef-48e31a6200ac','/3c95518e-8c37-41e3-9627-0ca339200f53/offers/FA86A86A-2266-41EF-91EF-48E31A6200AC','2016-02-23 20:35:24',NULL,1),(76,'Project Online with Project Pro for Office 365','Corporate','1 Month(s)','NON-SPECIFIC','63741246-68c5-4ae2-8a2d-333b9eda85d4','/3c95518e-8c37-41e3-9627-0ca339200f53/offers/63741246-68C5-4AE2-8A2D-333B9EDA85D4','2016-02-23 20:35:24',NULL,1),(77,'Project Pro for Office 365','Corporate','1 Month(s)','NON-SPECIFIC','d3bca131-4772-47bc-9c2e-e4040f82268c','/3c95518e-8c37-41e3-9627-0ca339200f53/offers/D3BCA131-4772-47BC-9C2E-E4040F82268C','2016-02-23 20:35:24',NULL,1),(78,'Project Pro for Office 365 (Government Pricing)','Government','1 Month(s)','NON-SPECIFIC','11e3c9a9-24a2-4cfd-9f60-a9797d68e296','/3c95518e-8c37-41e3-9627-0ca339200f53/offers/11E3C9A9-24A2-4CFD-9F60-A9797D68E296','2016-02-23 20:35:24',NULL,1),(79,'SharePoint Online (Plan 1)','Corporate','1 Month(s)','NON-SPECIFIC','ff7a4f5b-4973-4241-8c43-80f2be39311d','/3c95518e-8c37-41e3-9627-0ca339200f53/offers/FF7A4F5B-4973-4241-8C43-80F2BE39311D','2016-02-23 20:35:25',NULL,1),(80,'Skype for Business Cloud PBX','Corporate','1 Month(s)','ADDON','4260988e-990d-479c-ae7b-f01ce8e1bb4d','/3c95518e-8c37-41e3-9627-0ca339200f53/offers/4260988E-990D-479C-AE7B-F01CE8E1BB4D','2016-02-23 20:35:25',NULL,1),(81,'Skype for Business Cloud PBX (Government Pricing)','Government','1 Month(s)','ADDON','d6985a19-c58d-4352-88ae-9095d2fe8736','/3c95518e-8c37-41e3-9627-0ca339200f53/offers/D6985A19-C58D-4352-88AE-9095D2FE8736','2016-02-23 20:35:25',NULL,1),(82,'Skype for Business Online (Plan 1)','Corporate','1 Month(s)','NON-SPECIFIC','aca0c06c-890d-4abb-83cf-bc519a2565e5','/3c95518e-8c37-41e3-9627-0ca339200f53/offers/ACA0C06C-890D-4ABB-83CF-BC519A2565E5','2016-02-23 20:35:25',NULL,1),(83,'Skype for Business Online (Plan 1) (Government Pricing)','Government','1 Month(s)','NON-SPECIFIC','ae1d0798-28fa-4460-8c67-c09b3ac7133d','/3c95518e-8c37-41e3-9627-0ca339200f53/offers/AE1D0798-28FA-4460-8C67-C09B3AC7133D','2016-02-23 20:35:25',NULL,1),(84,'Skype for Business Online (Plan 2)','Corporate','1 Month(s)','NON-SPECIFIC','14c61739-b45a-42c0-832c-d330972d3173','/3c95518e-8c37-41e3-9627-0ca339200f53/offers/14C61739-B45A-42C0-832C-D330972D3173','2016-02-23 20:35:25',NULL,1),(85,'Skype for Business Online (Plan 2) (Government Pricing)','Government','1 Month(s)','NON-SPECIFIC','a6c260a7-545c-42f7-bb27-461c1e131534','/3c95518e-8c37-41e3-9627-0ca339200f53/offers/A6C260A7-545C-42F7-BB27-461C1E131534','2016-02-23 20:35:25',NULL,1),(86,'Skype for Business Plus CAL','Corporate','1 Month(s)','ADDON','fc233c3f-25bc-4bba-8984-860ce561af86','/3c95518e-8c37-41e3-9627-0ca339200f53/offers/FC233C3F-25BC-4BBA-8984-860CE561AF86','2016-02-23 20:35:25',NULL,1),(87,'Skype for Business Plus CAL (Government Pricing)','Government','1 Month(s)','ADDON','65c891ba-418c-41ef-9f18-364ee7d6435c','/3c95518e-8c37-41e3-9627-0ca339200f53/offers/65C891BA-418C-41EF-9F18-364EE7D6435C','2016-02-23 20:35:25',NULL,1),(88,'Visio Pro for Office 365','Corporate','1 Month(s)','NON-SPECIFIC','b4d4b7f4-4089-43b6-9c44-de97b760fb11','/3c95518e-8c37-41e3-9627-0ca339200f53/offers/B4D4B7F4-4089-43B6-9C44-DE97B760FB11','2016-02-23 20:35:25',NULL,1),(89,'Visio Pro for Office 365 (Government Pricing)','Government','1 Month(s)','NON-SPECIFIC','b0b0890d-f5bc-404e-898e-7b6932766528','/3c95518e-8c37-41e3-9627-0ca339200f53/offers/B0B0890D-F5BC-404E-898E-7B6932766528','2016-02-23 20:35:25',NULL,1),(90,'Yammer Enterprise','Corporate','1 Month(s)','NON-SPECIFIC','a3f4ab4e-6239-4ecb-a859-77369dca1c08','/3c95518e-8c37-41e3-9627-0ca339200f53/offers/A3F4AB4E-6239-4ECB-A859-77369DCA1C08','2016-02-23 20:35:25',NULL,1),(91,'Yammer Enterprise (Government Pricing)','Government','1 Month(s)','NON-SPECIFIC','8aa7e78b-b265-4ac6-ada0-14900a8a3f94','/3c95518e-8c37-41e3-9627-0ca339200f53/offers/8AA7E78B-B265-4AC6-ADA0-14900A8A3F94','2016-02-23 20:35:25',NULL,1),(109,'OneDrive for Business (Plan 2)','Corporate','1 Month(s)','NON-SPECIFIC','bf1f6907-1f8e-4f05-b327-4896d1395c15','/3c95518e-8c37-41e3-9627-0ca339200f53/offers/BF1F6907-1F8E-4F05-B327-4896D1395C15','2016-02-23 20:35:26',NULL,1),(110,'OneDrive for Business (Plan 2) (Government Pricing)','Government','1 Month(s)','NON-SPECIFIC','e2efc935-4a17-45ee-a643-bb59f1961261','/3c95518e-8c37-41e3-9627-0ca339200f53/offers/E2EFC935-4A17-45EE-A643-BB59F1961261','2016-02-23 20:35:26',NULL,1),(111,'SharePoint Online (Plan 2)','Corporate','1 Month(s)','NON-SPECIFIC','69c67983-cf78-4102-83f6-3e5fd246864f','/3c95518e-8c37-41e3-9627-0ca339200f53/offers/69C67983-CF78-4102-83F6-3E5FD246864F','2016-02-23 20:35:26',NULL,1),(112,'Microsoft Dynamics CRM Online Professional Add-On to Office 365','Corporate','1 Month(s)','NON-Specific','4443cb9e-651e-4295-be7c-5bc89d1e3916','/3c95518e-8c37-41e3-9627-0ca3392=00f53/offers/4443CB9E-651E-4295-BE7C-5BC89D1E3916','2016-03-30 14:48:18',NULL,1),(113,'Microsoft Dynamics CRM Online Professional Add-On to Office 365 (Government Pricing)','Government','1 Month(s)','NON-Specific','2a5454d2-08a8-4162-9ab9-32963b8cc5d0','/3c95518e-8c37-41e3-9627-0ca339200f53/offers/2A5454D2-08A8-4162-9AB9-32963B8CC5D0','2016-03-30 14:49:23',NULL,1);
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
) ENGINE=InnoDB AUTO_INCREMENT=114 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `offer_price`
--

LOCK TABLES `offer_price` WRITE;
/*!40000 ALTER TABLE `offer_price` DISABLE KEYS */;
INSERT INTO `offer_price` VALUES (1,1,0.800,1.000,'2016-02-23 20:35:19',NULL),(2,2,0.700,0.900,'2016-02-23 20:35:19',NULL),(3,3,4.800,6.000,'2016-02-23 20:35:19',NULL),(4,4,4.080,5.100,'2016-02-23 20:35:20',NULL),(5,5,1.410,1.800,'2016-02-23 20:35:20',NULL),(6,6,1.600,2.000,'2016-02-23 20:35:20',NULL),(7,7,1.600,2.000,'2016-02-23 20:35:20',NULL),(8,8,1.400,1.800,'2016-02-23 20:35:20',NULL),(9,9,3.200,4.000,'2016-02-23 20:35:20',NULL),(10,10,2.800,3.500,'2016-02-23 20:35:20',NULL),(11,11,6.990,8.700,'2016-02-23 20:35:20',NULL),(12,12,6.150,7.700,'2016-02-23 20:35:20',NULL),(13,13,3.200,4.000,'2016-02-23 20:35:20',NULL),(14,14,6.400,8.000,'2016-02-23 20:35:20',NULL),(15,15,5.600,7.000,'2016-02-23 20:35:20',NULL),(16,16,1.600,2.000,'2016-02-23 20:35:20',NULL),(17,17,1.410,1.800,'2016-02-23 20:35:20',NULL),(18,18,2.400,3.000,'2016-02-23 20:35:21',NULL),(19,19,1.600,2.000,'2016-02-23 20:35:21',NULL),(20,20,1.600,2.000,'2016-02-23 20:35:21',NULL),(21,21,1.200,1.500,'2016-02-23 20:35:21',NULL),(22,22,2.800,3.500,'2016-02-23 20:35:21',NULL),(23,23,0.800,1.000,'2016-02-23 20:35:21',NULL),(24,24,4.090,5.100,'2016-02-23 20:35:21',NULL),(25,25,2.000,2.500,'2016-02-23 20:35:21',NULL),(26,26,112.500,150.000,'2016-02-23 20:35:21',NULL),(27,27,87.000,116.000,'2016-02-23 20:35:21',NULL),(28,28,411.750,549.000,'2016-02-23 20:35:22',NULL),(29,29,318.750,425.000,'2016-02-23 20:35:22',NULL),(30,30,7.500,10.000,'2016-02-23 20:35:22',NULL),(31,31,6.800,9.100,'2016-02-23 20:35:22',NULL),(32,32,22.500,30.000,'2016-02-23 20:35:22',NULL),(33,33,17.250,23.000,'2016-02-23 20:35:22',NULL),(34,34,11.250,15.000,'2016-02-23 20:35:22',NULL),(35,35,8.600,11.500,'2016-02-23 20:35:22',NULL),(36,36,48.750,65.000,'2016-02-23 20:35:22',NULL),(37,37,37.500,50.000,'2016-02-23 20:35:22',NULL),(38,38,37.500,50.000,'2016-02-23 20:35:22',NULL),(39,39,32.500,43.300,'2016-02-23 20:35:22',NULL),(40,40,4.800,6.000,'2016-02-23 20:35:22',NULL),(41,41,2.000,2.500,'2016-02-23 20:35:22',NULL),(42,42,75.000,100.000,'2016-02-23 20:35:22',NULL),(43,43,75.000,100.000,'2016-02-23 20:35:22',NULL),(44,44,52.500,70.000,'2016-02-23 20:35:22',NULL),(45,45,52.500,70.000,'2016-02-23 20:35:23',NULL),(46,46,30.000,40.000,'2016-02-23 20:35:23',NULL),(47,47,30.000,40.000,'2016-02-23 20:35:23',NULL),(48,48,6.400,8.000,'2016-02-23 20:35:23',NULL),(49,49,5.600,7.000,'2016-02-23 20:35:23',NULL),(50,50,6.600,8.300,'2016-02-23 20:35:23',NULL),(51,51,4.000,5.000,'2016-02-23 20:35:23',NULL),(52,52,10.000,12.500,'2016-02-23 20:35:23',NULL),(53,53,6.400,8.000,'2016-02-23 20:35:23',NULL),(54,54,4.800,6.000,'2016-02-23 20:35:23',NULL),(55,55,16.000,20.000,'2016-02-23 20:35:23',NULL),(56,56,13.600,17.000,'2016-02-23 20:35:23',NULL),(57,57,17.600,22.000,'2016-02-23 20:35:23',NULL),(58,58,15.200,19.000,'2016-02-23 20:35:23',NULL),(59,59,26.400,33.000,'2016-02-23 20:35:23',NULL),(60,60,22.440,28.100,'2016-02-23 20:35:23',NULL),(61,61,3.200,4.000,'2016-02-23 20:35:23',NULL),(62,62,2.400,3.000,'2016-02-23 20:35:23',NULL),(63,63,0.620,0.800,'2016-02-23 20:35:24',NULL),(64,64,0.160,0.200,'2016-02-23 20:35:24',NULL),(65,65,0.160,0.200,'2016-02-23 20:35:24',NULL),(66,66,9.600,12.000,'2016-02-23 20:35:24',NULL),(67,67,7.200,9.000,'2016-02-23 20:35:24',NULL),(68,68,4.000,5.000,'2016-02-23 20:35:24',NULL),(69,69,3.520,4.400,'2016-02-23 20:35:24',NULL),(70,70,7.990,10.000,'2016-02-23 20:35:24',NULL),(71,71,6.950,8.700,'2016-02-23 20:35:24',NULL),(72,72,5.600,7.000,'2016-02-23 20:35:24',NULL),(73,73,4.960,6.200,'2016-02-23 20:35:24',NULL),(74,74,26.400,33.000,'2016-02-23 20:35:24',NULL),(75,75,19.800,24.800,'2016-02-23 20:35:24',NULL),(76,76,46.400,58.000,'2016-02-23 20:35:24',NULL),(77,77,20.000,25.000,'2016-02-23 20:35:24',NULL),(78,78,17.220,21.500,'2016-02-23 20:35:24',NULL),(79,79,4.000,5.000,'2016-02-23 20:35:25',NULL),(80,80,6.400,8.000,'2016-02-23 20:35:25',NULL),(81,81,5.600,7.000,'2016-02-23 20:35:25',NULL),(82,82,1.600,2.000,'2016-02-23 20:35:25',NULL),(83,83,1.200,1.500,'2016-02-23 20:35:25',NULL),(84,84,4.400,5.500,'2016-02-23 20:35:25',NULL),(85,85,3.600,4.500,'2016-02-23 20:35:25',NULL),(86,86,1.600,2.000,'2016-02-23 20:35:25',NULL),(87,87,1.400,1.800,'2016-02-23 20:35:25',NULL),(88,88,10.400,13.000,'2016-02-23 20:35:25',NULL),(89,89,8.960,11.200,'2016-02-23 20:35:25',NULL),(90,90,2.400,3.000,'2016-02-23 20:35:25',NULL),(91,91,2.080,2.600,'2016-02-23 20:35:25',NULL),(92,92,6.990,10.000,'2016-02-23 20:35:25',NULL),(93,93,52.500,75.000,'2016-02-23 20:35:25',NULL),(94,94,133.000,190.100,'2016-02-23 20:35:26',NULL),(95,95,297.500,425.100,'2016-02-23 20:35:26',NULL),(96,96,945.000,1350.400,'2016-02-23 20:35:26',NULL),(97,97,2835.000,4051.100,'2016-02-23 20:35:26',NULL),(98,98,5530.000,7902.200,'2016-02-23 20:35:26',NULL),(99,99,8400.000,12003.400,'2016-02-23 20:35:26',NULL),(100,100,5.600,8.000,'2016-02-23 20:35:26',NULL),(101,101,21.000,30.000,'2016-02-23 20:35:26',NULL),(102,102,1.120,1.400,'2016-02-23 20:35:26',NULL),(103,103,3.200,4.000,'2016-02-23 20:35:26',NULL),(104,104,2.400,3.000,'2016-02-23 20:35:26',NULL),(105,105,19.200,24.000,'2016-02-23 20:35:26',NULL),(106,106,16.800,21.000,'2016-02-23 20:35:26',NULL),(107,107,9.600,12.000,'2016-02-23 20:35:26',NULL),(108,108,8.400,10.500,'2016-02-23 20:35:26',NULL),(109,109,8.000,10.000,'2016-02-23 20:35:26',NULL),(110,110,7.000,8.800,'2016-02-23 20:35:26',NULL),(111,111,8.000,10.000,'2016-02-23 20:35:27',NULL),(112,112,37.500,50.000,'2016-03-30 14:50:46',NULL),(113,113,32.500,43.300,'2016-03-30 14:51:36',NULL);
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
) ENGINE=InnoDB AUTO_INCREMENT=110 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `transactions`
--

LOCK TABLES `transactions` WRITE;
/*!40000 ALTER TABLE `transactions` DISABLE KEYS */;
INSERT INTO `transactions` VALUES (30,1,1,'796b6b5f-613c-4e24-a17c-eba730d49c02','Office 365 Enterprise E3','1 month(s)',20,1,2,2.05,102.4,1),(31,1,2,'79c29af7-3cd0-4a6f-b182-a81e31dec84e','Enterprise Mobility Suite','1 month(s)',8.7,2,2,2.05,102.4,1),(32,1,3,'921cb1b8-a289-4437-a0b8-11104bcc3cba','Microsoft Dynamics CRM Online Professional','1 month(s)',65,1,2,2.05,102.4,1),(34,1,1,'84a03d81-6b37-4d66-8d4a-faea24541538','Azure Active Directory Basic','1 month(s)',1,1,2,0.06,3,3),(35,1,2,'648bf77b-1f0a-4911-8066-caf37d67dc72','Azure Rights Management Premium','1 month(s)',2,1,2,0.06,3,3),(37,1,1,'45320ec9-9b8e-49d0-b900-f14141a0abd1','Delve Analytics','1 month(s)',4,1,2,0.14,7,5),(38,1,2,'2828be95-46ba-4f91-b2fd-0bef192ecf60','Exchange Online Archiving for Exchange Online','1 month(s)',3,1,2,0.14,7,5),(40,1,1,'921cb1b8-a289-4437-a0b8-11104bcc3cba','Microsoft Dynamics CRM Online Professional','1 month(s)',65,1,2,1.3,65,7),(42,1,1,'796b6b5f-613c-4e24-a17c-eba730d49c02','Office 365 Enterprise E3','1 month(s)',20,1,2,1.87,93.7,9),(43,1,2,'79c29af7-3cd0-4a6f-b182-a81e31dec84e','Enterprise Mobility Suite','1 month(s)',8.7,1,2,1.87,93.7,9),(44,1,3,'921cb1b8-a289-4437-a0b8-11104bcc3cba','Microsoft Dynamics CRM Online Professional','1 month(s)',65,1,2,1.87,93.7,9),(46,1,1,'79c29af7-3cd0-4a6f-b182-a81e31dec84e','Enterprise Mobility Suite','1 month(s)',8.7,1,2,1.47,73.7,11),(47,1,2,'921cb1b8-a289-4437-a0b8-11104bcc3cba','Microsoft Dynamics CRM Online Professional','1 month(s)',65,1,2,1.47,73.7,11),(48,1,1,'79c29af7-3cd0-4a6f-b182-a81e31dec84e','Enterprise Mobility Suite','1 month(s)',8.7,2,2,1.81,90.4,13),(49,1,2,'921cb1b8-a289-4437-a0b8-11104bcc3cba','Microsoft Dynamics CRM Online Professional','1 month(s)',65,1,2,1.81,90.4,13),(50,1,3,'16c9f982-a827-4003-a88e-e75df1927f27','Azure Active Directory Premium','1 month(s)',6,1,2,1.81,90.4,13),(51,1,4,'a2706f86-868d-4048-989b-0c69e5c76b63','Exchange Online Advanced Threat Protection','1 month(s)',2,1,2,1.81,90.4,13),(52,1,1,'79c29af7-3cd0-4a6f-b182-a81e31dec84e','Enterprise Mobility Suite','1 month(s)',8.7,2,2,1.89,94.4,15),(53,1,2,'921cb1b8-a289-4437-a0b8-11104bcc3cba','Microsoft Dynamics CRM Online Professional','1 month(s)',65,1,2,1.89,94.4,15),(54,1,3,'16c9f982-a827-4003-a88e-e75df1927f27','Azure Active Directory Premium','1 month(s)',6,1,2,1.89,94.4,15),(55,1,4,'a2706f86-868d-4048-989b-0c69e5c76b63','Exchange Online Advanced Threat Protection','1 month(s)',2,1,2,1.89,94.4,15),(56,1,5,'35a36b80-270a-44bf-9290-00545d350866','Exchange Online Kiosk','1 month(s)',2,2,2,1.89,94.4,15),(57,1,1,'79c29af7-3cd0-4a6f-b182-a81e31dec84e','Enterprise Mobility Suite','1 month(s)',8.7,2,2,2.45,122.4,17),(58,1,2,'921cb1b8-a289-4437-a0b8-11104bcc3cba','Microsoft Dynamics CRM Online Professional','1 month(s)',65,1,2,2.45,122.4,17),(59,1,3,'a2706f86-868d-4048-989b-0c69e5c76b63','Exchange Online Advanced Threat Protection','1 month(s)',2,1,2,2.45,122.4,17),(60,1,4,'90d3615e-aa96-478e-b6ce-8eb1e9a96b4b','OneDrive for Business (Plan 1)','1 month(s)',5,1,2,2.45,122.4,17),(61,1,5,'4f7ecaf1-e9d6-4cac-9687-e22eb3dfdd70','Office 365 Enterprise E5 without PSTN Conferencing','1 month(s)',33,1,2,2.45,122.4,17),(62,1,1,'79c29af7-3cd0-4a6f-b182-a81e31dec84e','Enterprise Mobility Suite','1 month(s)',8.7,1,2,0.29,14.7,19),(63,1,2,'16c9f982-a827-4003-a88e-e75df1927f27','Azure Active Directory Premium','1 month(s)',6,1,2,0.29,14.7,19),(64,1,1,'79c29af7-3cd0-4a6f-b182-a81e31dec84e','Enterprise Mobility Suite','1 month(s)',8.7,3,2,2.5,125.1,21),(65,1,2,'648bf77b-1f0a-4911-8066-caf37d67dc72','Azure Rights Management Premium','1 month(s)',2,1,2,2.5,125.1,21),(66,1,3,'921cb1b8-a289-4437-a0b8-11104bcc3cba','Microsoft Dynamics CRM Online Professional','1 month(s)',65,1,2,2.5,125.1,21),(67,1,4,'796b6b5f-613c-4e24-a17c-eba730d49c02','Office 365 Enterprise E3','1 month(s)',20,1,2,2.5,125.1,21),(68,1,5,'16c9f982-a827-4003-a88e-e75df1927f27','Azure Active Directory Premium','1 month(s)',6,1,2,2.5,125.1,21),(69,1,6,'2828be95-46ba-4f91-b2fd-0bef192ecf60','Exchange Online Archiving for Exchange Online','1 month(s)',3,2,2,2.5,125.1,21),(70,1,1,'796b6b5f-613c-4e24-a17c-eba730d49c02','Office 365 Enterprise E3','1 month(s)',20,1,2,1.87,93.7,23),(71,1,2,'79c29af7-3cd0-4a6f-b182-a81e31dec84e','Enterprise Mobility Suite','1 month(s)',8.7,1,2,1.87,93.7,23),(72,1,3,'921cb1b8-a289-4437-a0b8-11104bcc3cba','Microsoft Dynamics CRM Online Professional','1 month(s)',65,1,2,1.87,93.7,23),(73,1,1,'921cb1b8-a289-4437-a0b8-11104bcc3cba','Microsoft Dynamics CRM Online Professional','1 month(s)',65,1,2,1.51,75.7,25),(74,1,2,'79c29af7-3cd0-4a6f-b182-a81e31dec84e','Enterprise Mobility Suite','1 month(s)',8.7,1,2,1.51,75.7,25),(75,1,3,'68f6373c-31cb-43f0-bfaa-85f3688f8cfb','Customer Lockbox','1 month(s)',2,1,2,1.51,75.7,25),(76,1,1,'79c29af7-3cd0-4a6f-b182-a81e31dec84e','Enterprise Mobility Suite','1 month(s)',8.7,1,2,0.29,14.7,27),(77,1,2,'45320ec9-9b8e-49d0-b900-f14141a0abd1','Delve Analytics','1 month(s)',4,1,2,0.29,14.7,27),(78,1,3,'a2706f86-868d-4048-989b-0c69e5c76b63','Exchange Online Advanced Threat Protection','1 month(s)',2,1,2,0.29,14.7,27),(79,1,1,'79c29af7-3cd0-4a6f-b182-a81e31dec84e','Enterprise Mobility Suite','1 month(s)',8.7,1,2,1.07,53.7,29),(80,1,2,'796b6b5f-613c-4e24-a17c-eba730d49c02','Office 365 Enterprise E3','1 month(s)',20,1,2,1.07,53.7,29),(81,1,3,'84a03d81-6b37-4d66-8d4a-faea24541538','Azure Active Directory Basic','1 month(s)',1,1,2,1.07,53.7,29),(82,1,4,'16c9f982-a827-4003-a88e-e75df1927f27','Azure Active Directory Premium','1 month(s)',6,1,2,1.07,53.7,29),(83,1,5,'2f707c7c-2433-49a5-a437-9ca7cf40d3eb','Exchange Online (Plan 2)','1 month(s)',8,2,2,1.07,53.7,29),(84,1,6,'35a36b80-270a-44bf-9290-00545d350866','Exchange Online Kiosk','1 month(s)',2,1,2,1.07,53.7,29),(85,2,1,'79c29af7-3cd0-4a6f-b182-a81e31dec84e','Enterprise Mobility Suite','1 month(s)',8.7,1,8,6.3,78.7,31),(86,2,2,'921cb1b8-a289-4437-a0b8-11104bcc3cba','Microsoft Dynamics CRM Online Professional','1 month(s)',65,1,8,6.3,78.7,31),(87,2,3,'84a03d81-6b37-4d66-8d4a-faea24541538','Azure Active Directory Basic','1 month(s)',1,1,8,6.3,78.7,31),(88,2,4,'195416c1-3447-423a-b37b-ee59a99a19c4','Exchange Online (Plan 1)','1 month(s)',4,1,8,6.3,78.7,31),(89,2,1,'79c29af7-3cd0-4a6f-b182-a81e31dec84e','Enterprise Mobility Suite','1 month(s)',8.7,3,8,6.09,76.1,33),(90,2,2,'796b6b5f-613c-4e24-a17c-eba730d49c02','Office 365 Enterprise E3','1 month(s)',20,1,8,6.09,76.1,33),(91,2,3,'ffb8bb89-9573-4e76-840f-6521450325a1','Microsoft Dynamics CRM Online Basic','1 month(s)',30,1,8,6.09,76.1,33),(92,1,1,'79c29af7-3cd0-4a6f-b182-a81e31dec84e','Enterprise Mobility Suite','1 month(s)',8.7,1,2,1.47,73.7,35),(93,1,2,'921cb1b8-a289-4437-a0b8-11104bcc3cba','Microsoft Dynamics CRM Online Professional','1 month(s)',65,1,2,1.47,73.7,35),(94,2,1,'461d7db7-ec67-4671-bf9b-22efde413f0f','Enterprise Mobility Suite (Government Pricing)','1 month(s)',7.7,1,8,5.98,74.7,37),(95,2,2,'4271aa57-4129-477e-ba88-0a276d4a1619','Microsoft Dynamics CRM Online Professional (Government Pricing)','1 month(s)',50,1,8,5.98,74.7,37),(96,2,3,'6b551829-de8c-41e5-8678-41d52c27aee8','Office 365 Enterprise E3 (Government Pricing)','1 month(s)',17,1,8,5.98,74.7,37),(97,1,1,'796b6b5f-613c-4e24-a17c-eba730d49c02','Office 365 Enterprise E3','1 month(s)',20,1,0,0.91,90.09,39),(98,1,2,'16c9f982-a827-4003-a88e-e75df1927f27','Azure Active Directory Premium','1 month(s)',6,1,0,0.91,90.09,39),(99,1,3,'921cb1b8-a289-4437-a0b8-11104bcc3cba','Microsoft Dynamics CRM Online Professional','1 month(s)',65,1,0,0.91,90.09,39),(100,1,1,'796b6b5f-613c-4e24-a17c-eba730d49c02','Office 365 Enterprise E3','1 month(s)',20,2,1,0,178.7,41),(101,1,2,'79c29af7-3cd0-4a6f-b182-a81e31dec84e','Enterprise Mobility Suite','1 month(s)',8.7,1,1,0,178.7,41),(102,1,3,'921cb1b8-a289-4437-a0b8-11104bcc3cba','Microsoft Dynamics CRM Online Professional','1 month(s)',65,2,1,0,178.7,41),(103,1,1,'79c29af7-3cd0-4a6f-b182-a81e31dec84e','Enterprise Mobility Suite','1 month(s)',8.7,1,1,0.74,72.96,43),(104,1,2,'921cb1b8-a289-4437-a0b8-11104bcc3cba','Microsoft Dynamics CRM Online Professional','1 month(s)',65,1,1,0.74,72.96,43),(105,2,1,'6b551829-de8c-41e5-8678-41d52c27aee8','Office 365 Enterprise E3 (Government Pricing)','1 month(s)',17,1,6.5,10.86,156.15,45),(106,2,2,'4271aa57-4129-477e-ba88-0a276d4a1619','Microsoft Dynamics CRM Online Professional (Government Pricing)','1 month(s)',50,3,6.5,10.86,156.15,45),(107,1,1,'4443cb9e-651e-4295-be7c-5bc89d1e3916','Microsoft Dynamics CRM Online Professional Add-On to Office 365','1 month(s)',50,1,1,0.79,77.91,47),(108,1,2,'79c29af7-3cd0-4a6f-b182-a81e31dec84e','Enterprise Mobility Suite','1 month(s)',8.7,1,1,0.79,77.91,47),(109,1,3,'796b6b5f-613c-4e24-a17c-eba730d49c02','Office 365 Enterprise E3','1 month(s)',20,1,1,0.79,77.91,47);
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
  `customer_id` int(11) DEFAULT NULL,
  `commerce_id` varchar(255) DEFAULT NULL,
  `aud` varchar(255) DEFAULT NULL,
  `oid` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `role` int(2) DEFAULT NULL,
  `tid` varchar(255) DEFAULT NULL,
  `create_time` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES ('',NULL,NULL,NULL,NULL,'jsmith@gmail.com',10,'c196e87e-b293-421d-9b3e-47023889da17','2016-03-31 20:49:28'),('admin',NULL,NULL,NULL,NULL,'admin@gmail.com',30,NULL,'2016-03-10 06:09:03'),('admin@managedsolutiontesting.onmicrosoft.com',22,'2d3500e3-fac0-49ee-8ad7-dfc822beedc6',NULL,NULL,'jsmith@gmail.com',10,'e031010f-5d28-430d-99bb-74aee0c0f7fc','2016-03-31 21:53:15'),('admin@managedtesting2.onmicrosoft.com',NULL,'e09da035-5ba4-41e2-8fcc-9d15148ff229',NULL,NULL,'jsmith@managedsolution.com',10,'be1fd16d-08ac-4ed8-a03e-ea6c2f377578','2016-04-04 15:49:58'),('admin@managedtesting3.onmicrosoft.com',NULL,'3a7281ad-f5b3-4df2-96db-dfb65ff3d748',NULL,NULL,'jsmith@managedsolution.com',10,'e80927a7-deb2-41e7-90b6-1c113785842e','2016-04-04 15:51:25'),('admin@managedtesting4.onmicrosoft.com',25,'eb11c3c8-131c-480d-ac6a-6aa2d257d18c',NULL,NULL,'jsmith@managedsolution.com',10,'fb828080-7928-4fdf-b2e3-b9353af6233f','2016-04-04 16:20:17'),('adminjasons1234567.onmicrosoft.com',NULL,NULL,NULL,NULL,NULL,10,'4538b066-5530-415f-8308-0a2a8343f554','2016-03-31 21:19:58'),('bad',NULL,NULL,NULL,NULL,'bad@gmail.com',NULL,NULL,'2016-03-15 17:47:03'),('finaltesting',NULL,NULL,NULL,NULL,'jsmith@gmail.com',10,'f8689e5f-c6bb-4118-a494-15856cc7e937','2016-03-23 20:21:48'),('finaltesting5555',NULL,NULL,NULL,NULL,NULL,10,'','2016-03-31 21:13:42'),('jasonbsmith1568',NULL,NULL,NULL,NULL,'jsmith@managedsolution.com',10,'6f1f72d2-f006-4e70-ab7c-6636a0dcc86a','2016-03-24 15:33:31'),('jasons12345.onmicrosoft.com',NULL,NULL,NULL,NULL,NULL,10,'27b5f081-8bee-4008-b36a-66c45978294d','2016-03-31 21:14:51'),('jasons123456.onmicrosoft.com',NULL,NULL,NULL,NULL,NULL,10,'2f1e6233-8252-4115-b40a-723c9d409ec3','2016-03-31 21:18:53'),('jasonsdk',NULL,NULL,NULL,NULL,'jsmith@managedsolution.com',10,'','2016-03-25 22:07:37'),('jasonsdktesting1234',NULL,NULL,NULL,NULL,'jsmith@gmail.com',10,'503e5b74-e1cb-4790-abea-b68a0e4d70ac','2016-03-31 19:01:16'),('jasonsdktesting12345',NULL,NULL,NULL,NULL,'jsmith@gmail.com',10,'f3b54793-2f9f-4e7a-940f-7ac3ed912847','2016-03-31 19:11:35'),('jasonsdktesting12346',NULL,NULL,NULL,NULL,'jsmith@gmail.com',10,'e975ed9a-43e2-4a5a-96fd-af0bb33c5aea','2016-03-31 19:13:55'),('jasontestingcsp',NULL,NULL,NULL,NULL,'jsmith@gmail.com',10,'6d813e3e-0fae-4654-aa8f-f3affc2c4f27','2016-03-23 21:08:46'),('jsmith1234',NULL,NULL,NULL,NULL,'jsmith@gmail.com',10,'6f856fd6-a6d1-43df-b9eb-71bd61d9cbb4','2016-03-23 21:15:21'),('jsmith1568',NULL,NULL,NULL,NULL,'jsmith@gmail.com',10,'01085b6d-c2e1-4e56-a0a8-6e12b321131a','2016-03-23 19:45:24'),('jsmith15681',NULL,NULL,NULL,NULL,'jsmith@gmail.com',10,'','2016-03-31 15:19:18'),('jsmith15681234',NULL,NULL,NULL,NULL,'jsmith@managedsolution.com',10,'daf1b175-6c7f-4211-8919-3106e10c60ec','2016-03-31 20:08:00'),('jsmith15681568',NULL,NULL,NULL,NULL,'jsmith@managedsolution.com',10,'918cb633-64d3-49e4-be2d-19c882a1db17','2016-03-31 19:41:13'),('jsmith15682',NULL,NULL,NULL,NULL,'jsmith@gmail.com',10,'','2016-03-31 16:52:01'),('jsmith15684',NULL,NULL,NULL,NULL,'jsmith@gmail.com',10,'','2016-03-31 17:28:45'),('jsmith15686',NULL,NULL,NULL,NULL,'jsmith@gmail.com',10,'173a5ee9-86be-4de2-9f3c-6caeab4e519f','2016-03-31 18:18:08'),('test',1,NULL,NULL,NULL,'test@test.com',10,NULL,'2016-02-12 04:00:02'),('testing2',NULL,NULL,NULL,NULL,'testing@test.com',10,NULL,'2016-03-10 05:06:09');
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

-- Dump completed on 2016-04-04 11:19:19
