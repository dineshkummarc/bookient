-- MySQL dump 10.13  Distrib 5.5.43, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: bookient
-- ------------------------------------------------------
-- Server version	5.6.24

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
-- Table structure for table `app_admin_menu`
--

DROP TABLE IF EXISTS `app_admin_menu`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `app_admin_menu` (
  `admin_menu_id` int(20) NOT NULL AUTO_INCREMENT,
  `parent` int(20) NOT NULL,
  `menu_name` varchar(255) NOT NULL,
  `page_link` varchar(255) NOT NULL,
  `position` enum('L','R') NOT NULL DEFAULT 'L',
  `menu_authorization` int(11) NOT NULL COMMENT '1->super_admin,2->local_admin,3->fornt_end',
  `status` int(11) NOT NULL,
  `order` int(25) NOT NULL DEFAULT '0',
  `date_added` date NOT NULL,
  PRIMARY KEY (`admin_menu_id`)
) ENGINE=InnoDB AUTO_INCREMENT=60 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `app_admin_menu`
--

LOCK TABLES `app_admin_menu` WRITE;
/*!40000 ALTER TABLE `app_admin_menu` DISABLE KEYS */;
INSERT INTO `app_admin_menu` VALUES (1,0,'Settings','setting','R',2,1,0,'2012-08-17'),(2,1,'My Account','myaccount','R',2,1,1,'2012-08-17'),(3,1,'Business','business','R',2,1,2,'2012-08-17'),(4,1,'Services','service','R',2,1,4,'2012-08-17'),(6,1,'Staff','staff','R',2,1,5,'2012-08-17'),(8,1,'Business Hour','business_hour','R',2,1,6,'2012-08-17'),(9,1,'Dependency','dependency','R',2,1,7,'2012-08-17'),(10,1,'Rules','rules','R',2,1,9,'2012-08-17'),(11,0,'Mashups','mashups','R',2,0,0,'2012-08-17'),(13,54,'Logout','logout','R',2,1,3,'2012-08-17'),(14,12,'Account Overview','account_overview','R',2,1,1,'2012-08-17'),(15,1,'PrePayment','prepayment','R',2,1,8,'2012-08-24'),(16,1,'Look & Feel','#','R',2,0,10,'2012-09-14'),(17,1,'Customize','#','R',2,0,11,'2012-09-14'),(18,11,'Facebook','#','R',2,1,11,'2012-09-14'),(19,11,'Twitter','#','R',2,1,12,'2012-09-14'),(22,12,'Buy Credits','credits','R',2,0,0,'2012-09-17'),(23,12,'Cancel Account','cancelaccount','R',2,1,0,'2012-09-17'),(24,11,'Google Calendar','#','R',2,1,0,'2012-09-17'),(25,0,'Mashups','#','R',3,1,1,'2012-09-17'),(26,0,'My Appointments','#','R',3,1,2,'2012-09-17'),(27,0,'Modify My Information','#','R',3,1,3,'2012-09-17'),(28,54,'Logout','logout','R',3,1,4,'2012-09-17'),(29,0,'Calendar','calender','L',2,1,0,'2012-09-17'),(30,0,'Promote','#','L',2,1,0,'2012-09-17'),(31,0,'Reports','#','L',2,1,0,'2012-09-17'),(32,0,'Dashboard','dashboard','L',2,0,0,'2012-09-17'),(33,0,'Customers','#','L',2,1,0,'2012-09-17'),(34,31,'Appointment Reports','appointment_report','L',2,1,0,'2012-09-17'),(35,31,'Sales Reports','sales_report','L',2,1,0,'2012-09-17'),(36,31,'Clients List','clientlist','L',2,1,0,'2012-09-17'),(37,31,'Alert Reports','alert_report','L',2,1,0,'2012-09-17'),(38,31,'SMS Reports','sms_report','L',2,1,0,'2012-09-17'),(39,31,'Approvals','approval','L',2,1,0,'2012-09-17'),(40,31,'Reviews','review_status','L',2,1,0,'2012-09-17'),(41,30,'Getting Started','#','L',2,0,0,'2012-09-17'),(42,30,'Integrate on Your Website','integrate_on_your_website','L',2,1,0,'2012-09-17'),(43,30,'Discount Coupons','coupon','L',2,1,0,'2012-09-17'),(44,30,'Email Mktg.','email_mktg','L',2,1,0,'2012-09-17'),(45,30,'Social Promotion','social_promotion','L',2,1,0,'2012-09-17'),(46,1,'Service Category','servicecategory','R',2,1,3,'2012-10-26'),(47,1,'Look & Feel','look_feel','R',2,0,10,'2012-11-27'),(48,1,'Look & Feel','look_feel','R',2,1,10,'2012-11-27'),(49,0,'Graph','graph','L',2,1,0,'2013-04-08'),(50,1,'Customize','customize','R',2,1,11,'2013-07-22'),(51,1,'Staff Settings','staff_settings','R',2,1,5,'2013-08-20'),(52,30,'Google Calender','gcal','L',2,1,0,'2012-09-17'),(53,1,'Manage CMS','cms','R',2,1,13,'2013-07-22'),(54,0,'Location','#','R',2,1,0,'2014-01-29'),(55,54,'Add Location','javascript:void(0)\" onclick=\"addLocation()','R',2,1,1,'2014-01-29'),(56,1,'My Membership ','membership ','R',2,1,17,'2014-02-05'),(57,33,'Customer','customer','L',2,1,2,'2014-04-10'),(58,33,'Customer type','customertype','L',2,1,2,'2014-04-10'),(59,30,'auto promotion','autopromotion','L',2,1,0,'2014-05-05');
/*!40000 ALTER TABLE `app_admin_menu` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `app_admin_menu_translation`
--

DROP TABLE IF EXISTS `app_admin_menu_translation`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `app_admin_menu_translation` (
  `admin_menu_id` int(20) NOT NULL,
  `language_id` int(11) NOT NULL,
  `menu_name` varchar(255) NOT NULL,
  KEY `fk_admin_menu_translation_admin_menu_id` (`admin_menu_id`),
  KEY `fk_admin_menu_translation_language_id` (`language_id`),
  CONSTRAINT `fk_admin_menu_translation_admin_menu_id` FOREIGN KEY (`admin_menu_id`) REFERENCES `app_admin_menu` (`admin_menu_id`),
  CONSTRAINT `fk_admin_menu_translation_language_id` FOREIGN KEY (`language_id`) REFERENCES `app_languages` (`languages_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `app_admin_menu_translation`
--

LOCK TABLES `app_admin_menu_translation` WRITE;
/*!40000 ALTER TABLE `app_admin_menu_translation` DISABLE KEYS */;
INSERT INTO `app_admin_menu_translation` VALUES (1,1,'Settings'),(2,1,'My Account'),(3,1,'Business'),(4,1,'Services'),(6,1,'Staff'),(8,1,'Business Hour'),(9,1,'Dependency'),(10,1,'Rules'),(11,1,'Mashups'),(13,1,'Logout'),(14,1,'Account Overview'),(15,1,'PrePayment'),(16,1,'Look & Feel'),(17,1,'Customize'),(18,1,'Facebook'),(19,1,'Twitter'),(22,1,'Buy Credits'),(23,1,'Cancel Account'),(24,1,'Google Calendar'),(25,1,'Mashups'),(26,1,'My Appointments'),(27,1,'Modify My Information'),(28,1,'Logout'),(29,1,'Calendar'),(30,1,'Promote'),(31,1,'Reports'),(32,1,'Dashboard'),(33,1,'Customers'),(34,1,'Appointment Reports'),(35,1,'Sales Reports'),(36,1,'Clients Reports'),(37,1,'Alert Reports'),(38,1,'SMS Reports'),(39,1,'Approvals'),(40,1,'Reviews'),(41,1,'Getting Started'),(42,1,'Integrate on Your Website'),(43,1,'Discount Coupons'),(44,1,'Email Marketing'),(45,1,'Social Promotion'),(46,1,'Service Category'),(47,1,'Look & Feel'),(48,1,'Look & Feel'),(49,1,'Graph'),(50,1,'Customize'),(51,1,'Staff Settings'),(52,1,'Google Calendar'),(53,1,'Manage CMS'),(54,1,'Location'),(55,1,'Add Location'),(56,1,'My Membership '),(57,1,'Customer'),(58,1,'Customer type'),(59,1,'auto promotion'),(1,2,'Asetukset'),(2,2,'Oma Tili'),(3,2,'Yritys'),(4,2,'Palvelut'),(6,2,'Henkilökunta'),(8,2,'Työajat'),(9,2,'Riippuvuudet'),(10,2,'Säännöt'),(13,2,'Kirjaudu ulos'),(14,2,'Tilin yleisnäkymä'),(15,2,'Ennakkomaksut'),(16,2,'Ulkoasu'),(17,2,'Kustomoi'),(18,2,'Facebook'),(19,2,'Twitter'),(22,2,'Osta Krediittejä'),(23,2,'Tilin peruuttaminen'),(24,2,'Google Kalenteri'),(26,2,'Ajanvaraukseni'),(28,2,'Kirjaudu ulos'),(29,2,'Kalenteri'),(30,2,'Markkinointi'),(31,2,'Raportit'),(32,2,'Kojelauta'),(33,2,'Asiakkaat'),(34,2,'Ajanvarausraportti'),(35,2,'Myynnin raportti'),(36,2,'Asiakasraportti'),(37,2,'Varoitus raportti'),(38,2,'Tekstiviesti raportti'),(39,2,'Hyväksynnät'),(40,2,'Arvostelut'),(41,2,'Alkuun pääseminen'),(42,2,'Lisää nettisivuille'),(43,2,'Alennuskupongit'),(44,2,'Sähköpostimarkkinointi'),(45,2,'Sosiaalinen mainostus'),(46,2,'Palveluiden ryhmät'),(47,2,'Ulkoasu'),(48,2,'Ulkoasu'),(49,2,'Graafit'),(50,2,'Mukauta'),(51,2,'Henkilökunnan asetukset'),(52,2,'Google Kalenteri'),(53,2,'Hallitse sisältöjä'),(54,2,'Sijainti'),(55,2,'Lisää sijainti'),(56,2,'Oma Jäsenyys'),(57,2,'Asiakkaat'),(58,2,'Asiakastyypit'),(59,2,'Automaattinen markkinointi');
/*!40000 ALTER TABLE `app_admin_menu_translation` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `app_appoint_cancellation_policy`
--

DROP TABLE IF EXISTS `app_appoint_cancellation_policy`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `app_appoint_cancellation_policy` (
  `customize_id` int(11) NOT NULL AUTO_INCREMENT,
  `local_admin_id` int(11) NOT NULL,
  `background_image_url` varchar(255) DEFAULT NULL,
  `widget_url` varchar(255) DEFAULT NULL,
  `facebook_page_url` varchar(255) DEFAULT NULL,
  `twitter_page_url` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`customize_id`),
  KEY `app_appoint_cancellation_policy_local_admin_id` (`local_admin_id`),
  CONSTRAINT `app_appoint_cancellation_policy_ibfk_1` FOREIGN KEY (`local_admin_id`) REFERENCES `app_password_manager` (`user_id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=104 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `app_appoint_cancellation_policy`
--

LOCK TABLES `app_appoint_cancellation_policy` WRITE;
/*!40000 ALTER TABLE `app_appoint_cancellation_policy` DISABLE KEYS */;
INSERT INTO `app_appoint_cancellation_policy` VALUES (5,11,'','','http://www.facebook.com/Bookient','http://twitter.com/Bookient'),(8,37,'','','http://www.facebook.com/Bookient','http://twitter.com/Bookient'),(77,2942,'','','http://www.facebook.com/Bookient','http://twitter.com/Bookient'),(82,3496,'','','http://www.facebook.com/Bookient','http://twitter.com/Bookient'),(83,3513,'','','http://www.facebook.com/Bookient','http://twitter.com/Bookient');
/*!40000 ALTER TABLE `app_appoint_cancellation_policy` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `app_auto_promotion`
--

DROP TABLE IF EXISTS `app_auto_promotion`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `app_auto_promotion` (
  `auto_promo_id` int(11) NOT NULL AUTO_INCREMENT,
  `auto_local_admin_id` int(11) NOT NULL,
  `auto_promo_title` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `auto_promo_type` int(2) NOT NULL,
  `auto_promo_time` time NOT NULL,
  `auto_promo_date` date NOT NULL,
  `auto_promo_applyon` text COLLATE latin1_general_ci NOT NULL COMMENT '0 for all service and othre wise json array',
  `auto_promo_linkon` int(2) NOT NULL COMMENT '1 for discount, 2 for offer',
  `auto_promo_linkid` int(11) NOT NULL,
  `auto_promo_remaning_value` int(5) NOT NULL COMMENT 'total amount',
  `auto_promo_remaning_value_type` text COLLATE latin1_general_ci NOT NULL COMMENT '1 for %  , .2 for Unit wise',
  `auto_promo_priority` int(11) NOT NULL COMMENT '1 for high priority',
  `auto_promo_status` enum('0','1') COLLATE latin1_general_ci NOT NULL DEFAULT '0',
  `auto_promo_edit_date` date NOT NULL,
  `auto_promo_add_date` date NOT NULL,
  PRIMARY KEY (`auto_promo_id`),
  KEY `app_auto_promotion_auto_local_admin_id` (`auto_local_admin_id`),
  KEY `fk_app_auto_promotion_auto_promo_linkid` (`auto_promo_linkid`),
  CONSTRAINT `app_auto_promotion_auto_local_admin_id` FOREIGN KEY (`auto_local_admin_id`) REFERENCES `app_password_manager` (`user_id`),
  CONSTRAINT `fk_app_auto_promotion_auto_promo_linkid` FOREIGN KEY (`auto_promo_linkid`) REFERENCES `app_coupon` (`coupon_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `app_auto_promotion`
--

LOCK TABLES `app_auto_promotion` WRITE;
/*!40000 ALTER TABLE `app_auto_promotion` DISABLE KEYS */;
/*!40000 ALTER TABLE `app_auto_promotion` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `app_biz_hours`
--

DROP TABLE IF EXISTS `app_biz_hours`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `app_biz_hours` (
  `biz_hours_id` int(11) NOT NULL AUTO_INCREMENT,
  `service_id` int(11) NOT NULL,
  `local_admin_id` int(11) NOT NULL,
  `employee_id` int(11) NOT NULL,
  `day_id` int(1) NOT NULL COMMENT '1-> Monday; 7->Sunday',
  `time_from` time NOT NULL,
  `time_to` time NOT NULL,
  `continuation_id` int(25) NOT NULL,
  `date_added` date NOT NULL,
  `date_edited` date NOT NULL,
  PRIMARY KEY (`biz_hours_id`),
  KEY `local_admin_id` (`local_admin_id`),
  KEY `service_id` (`service_id`),
  KEY `employee_id` (`employee_id`),
  CONSTRAINT `app_biz_hours_ibfk_1` FOREIGN KEY (`local_admin_id`) REFERENCES `app_local_admin` (`local_admin_id`) ON DELETE CASCADE,
  CONSTRAINT `app_biz_hours_ibfk_2` FOREIGN KEY (`service_id`) REFERENCES `app_service` (`service_id`) ON DELETE CASCADE,
  CONSTRAINT `app_biz_hours_ibfk_3` FOREIGN KEY (`employee_id`) REFERENCES `app_employee` (`employee_id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `app_biz_hours`
--

LOCK TABLES `app_biz_hours` WRITE;
/*!40000 ALTER TABLE `app_biz_hours` DISABLE KEYS */;
/*!40000 ALTER TABLE `app_biz_hours` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `app_booking`
--

DROP TABLE IF EXISTS `app_booking`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `app_booking` (
  `booking_id` int(11) NOT NULL AUTO_INCREMENT,
  `local_admin_id` int(11) NOT NULL,
  `booking_date_time` datetime NOT NULL,
  `customer_id` int(11) NOT NULL,
  `currency_id` int(11) NOT NULL,
  `booking_sub_total` varchar(25) NOT NULL,
  `booking_disc_amount` varchar(25) NOT NULL,
  `booking_disc_coupon_details` text NOT NULL COMMENT 'discount coupon array in serialized format',
  `booking_total_tax` varchar(25) NOT NULL,
  `booking_tax_dtls_arr` text NOT NULL,
  `booking_grnd_total` varchar(25) NOT NULL,
  `booking_prepayment_amount` varchar(25) NOT NULL,
  `booking_prepayment_details` text NOT NULL COMMENT 'it will be a serialized array, which includes all payment related data',
  `booking_comment` text NOT NULL,
  `payment_status` int(11) NOT NULL DEFAULT '0' COMMENT '0= not complete,1=complete,2=half paid,3=due but booking complete,4=for free service',
  `transaction_id` int(11) NOT NULL,
  `added_by` int(11) NOT NULL COMMENT '1=>Customer; 2=>Employee; 3=>Local admin; 4=>System redistributor; 5->System head administrator ',
  `booking_from` int(11) NOT NULL COMMENT '	1=>computer;2=>mobile ',
  `data_added` datetime NOT NULL,
  `date_edited` datetime NOT NULL,
  `booking_is_deleted` enum('0','1') NOT NULL DEFAULT '0' COMMENT '1->deleted, 0->Active',
  PRIMARY KEY (`booking_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `app_booking`
--

LOCK TABLES `app_booking` WRITE;
/*!40000 ALTER TABLE `app_booking` DISABLE KEYS */;
/*!40000 ALTER TABLE `app_booking` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `app_booking_extra_field`
--

DROP TABLE IF EXISTS `app_booking_extra_field`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `app_booking_extra_field` (
  `field_id` int(11) NOT NULL AUTO_INCREMENT,
  `local_admin_id` int(11) NOT NULL,
  `data_type_id` int(11) NOT NULL,
  `field_name` varchar(255) CHARACTER SET latin1 NOT NULL,
  `services_ids` text CHARACTER SET latin1 NOT NULL,
  `is_required` enum('1','0') CHARACTER SET latin1 NOT NULL DEFAULT '0',
  `date_added` date DEFAULT NULL,
  `date_edited` date DEFAULT NULL,
  PRIMARY KEY (`field_id`),
  KEY `fk_app_booking_extra_field_local_admin_id` (`local_admin_id`),
  KEY `fk_app_booking_extra_field_data_type_id` (`data_type_id`),
  CONSTRAINT `fk_app_booking_extra_field_data_type_id` FOREIGN KEY (`data_type_id`) REFERENCES `app_datatype` (`data_type_id`),
  CONSTRAINT `fk_app_booking_extra_field_local_admin_id` FOREIGN KEY (`local_admin_id`) REFERENCES `app_local_admin` (`local_admin_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `app_booking_extra_field`
--

LOCK TABLES `app_booking_extra_field` WRITE;
/*!40000 ALTER TABLE `app_booking_extra_field` DISABLE KEYS */;
/*!40000 ALTER TABLE `app_booking_extra_field` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `app_booking_extra_field_option`
--

DROP TABLE IF EXISTS `app_booking_extra_field_option`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `app_booking_extra_field_option` (
  `option_id` int(11) NOT NULL AUTO_INCREMENT,
  `field_id` int(11) NOT NULL,
  `value` varchar(255) CHARACTER SET latin1 NOT NULL,
  `default_val` enum('0','1') CHARACTER SET latin1 NOT NULL DEFAULT '0',
  PRIMARY KEY (`option_id`),
  KEY `fk_option` (`field_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `app_booking_extra_field_option`
--

LOCK TABLES `app_booking_extra_field_option` WRITE;
/*!40000 ALTER TABLE `app_booking_extra_field_option` DISABLE KEYS */;
/*!40000 ALTER TABLE `app_booking_extra_field_option` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `app_booking_service_details`
--

DROP TABLE IF EXISTS `app_booking_service_details`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `app_booking_service_details` (
  `srvDtls_id` int(11) NOT NULL AUTO_INCREMENT,
  `srvDtls_booking_id` int(11) NOT NULL,
  `srvDtls_service_id` int(11) NOT NULL,
  `srvDtls_service_name` varchar(200) NOT NULL,
  `srvDtls_service_cost` varchar(50) NOT NULL,
  `srvDtls_service_duration` varchar(10) NOT NULL,
  `srvDtls_service_duration_unit` enum('M','H') NOT NULL,
  `srvDtls_service_start` datetime NOT NULL,
  `srvDtls_service_end` datetime NOT NULL,
  `srvDtls_employee_id` int(11) NOT NULL,
  `srvDtls_employee_name` varchar(55) NOT NULL,
  `srvDtls_booking_status` int(5) NOT NULL DEFAULT '2' COMMENT 'unapproved=>0; aproved=>1; pending=>2; Cmpleted=>3; canceledByAdmin=>4; CancelledByUser=>5;Set Status=>6;As scheduled=>7; Arrived late=>8;No show=>9; gift cerificates=>10; Reschedule=>16;',
  `srvDtls_status_date` datetime NOT NULL,
  `srvDtls_service_quantity` int(25) NOT NULL DEFAULT '1',
  `srvDtls_rescheduled_child_id` int(5) NOT NULL DEFAULT '0' COMMENT 'Default 0',
  `srvDtls_service_description` text NOT NULL,
  PRIMARY KEY (`srvDtls_id`),
  KEY `app_booking_service_details_srvDtls_booking_id` (`srvDtls_booking_id`),
  KEY `app_booking_service_details_srvDtls_service_id` (`srvDtls_service_id`),
  KEY `fk_app_booking_service_details_srvDtls_employee_id` (`srvDtls_employee_id`),
  CONSTRAINT `app_booking_service_details_srvDtls_booking_id` FOREIGN KEY (`srvDtls_booking_id`) REFERENCES `app_booking` (`booking_id`),
  CONSTRAINT `app_booking_service_details_srvDtls_service_id` FOREIGN KEY (`srvDtls_service_id`) REFERENCES `app_service` (`service_id`),
  CONSTRAINT `fk_app_booking_service_details_srvDtls_employee_id` FOREIGN KEY (`srvDtls_employee_id`) REFERENCES `app_employee` (`employee_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `app_booking_service_details`
--

LOCK TABLES `app_booking_service_details` WRITE;
/*!40000 ALTER TABLE `app_booking_service_details` DISABLE KEYS */;
/*!40000 ALTER TABLE `app_booking_service_details` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `app_cash_register`
--

DROP TABLE IF EXISTS `app_cash_register`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `app_cash_register` (
  `cash_register_id` int(10) NOT NULL AUTO_INCREMENT,
  `cash_booking_id` int(10) NOT NULL,
  `cash_payment_mode` int(5) NOT NULL COMMENT '1=>cash;2=>card;3=>cheque',
  `cash_total_amount` decimal(10,2) NOT NULL,
  `cash_additional_charges` decimal(10,2) NOT NULL,
  `cash_paid_total` decimal(10,2) NOT NULL,
  `cash_discount` decimal(10,2) NOT NULL,
  `cash_payment_notes` varchar(255) CHARACTER SET latin1 NOT NULL,
  PRIMARY KEY (`cash_register_id`),
  KEY `app_cash_register_cash_booking_id` (`cash_booking_id`),
  CONSTRAINT `app_cash_register_cash_booking_id` FOREIGN KEY (`cash_booking_id`) REFERENCES `app_booking` (`booking_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `app_cash_register`
--

LOCK TABLES `app_cash_register` WRITE;
/*!40000 ALTER TABLE `app_cash_register` DISABLE KEYS */;
/*!40000 ALTER TABLE `app_cash_register` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `app_change_status`
--

DROP TABLE IF EXISTS `app_change_status`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `app_change_status` (
  `change_status_id` int(11) NOT NULL AUTO_INCREMENT,
  `change_status_type` varchar(10) NOT NULL DEFAULT '',
  `table_name` varchar(255) NOT NULL DEFAULT '',
  `pkey` varchar(255) NOT NULL DEFAULT '',
  `change_status_name` varchar(255) NOT NULL DEFAULT '',
  `is_other_status` enum('Y','N') NOT NULL DEFAULT 'N',
  `other_status_dependency` varchar(10) DEFAULT NULL,
  `is_other_status_mode` enum('Y','N','B') DEFAULT NULL,
  `other_status_type` varchar(10) DEFAULT NULL,
  `other_status_name` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`change_status_id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `app_change_status`
--

LOCK TABLES `app_change_status` WRITE;
/*!40000 ALTER TABLE `app_change_status` DISABLE KEYS */;
INSERT INTO `app_change_status` VALUES (1,'Activate','countries','country_id','is_active','N',NULL,NULL,NULL,NULL),(2,'Activate','time_zone','time_zone_id','is_active','N',NULL,NULL,NULL,NULL),(5,'Activate','tax_master','tax_master_id','status','N',NULL,NULL,NULL,NULL),(6,'Activate','date_format','date_format_id','is_active','N',NULL,NULL,NULL,NULL),(7,'Activate','payment_gateways','payment_gateways_id','status','N',NULL,NULL,NULL,NULL),(8,'Activate','logins','login_typ_id','status','N',NULL,NULL,NULL,NULL),(9,'Activate','profession','profession_id','is_active','N',NULL,NULL,NULL,NULL),(10,'Activate','regions','region_id','is_actives','N',NULL,NULL,NULL,NULL),(11,'Activate','languages','languages_id','status','N',NULL,NULL,NULL,NULL),(12,'Activate','cities','city_id','is_active_s','N',NULL,NULL,NULL,NULL),(13,'Activate','faq','faq_id','is_active','N',NULL,NULL,NULL,NULL),(14,'Activate','membership_smscall_dtls','smscall_dtls_id','status','N',NULL,NULL,NULL,NULL),(15,'Activate','membership_types','membership_type_id','membership_order','N',NULL,NULL,NULL,NULL),(16,'Activate','membership_smscall_rate_dtls','smscall_rate_dtls_id','status','N',NULL,NULL,NULL,NULL),(17,'Activate','membership_plan_subscriptions','plan_subscriptions_id','plan_subscriptions_order','N',NULL,NULL,NULL,NULL);
/*!40000 ALTER TABLE `app_change_status` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `app_cities`
--

DROP TABLE IF EXISTS `app_cities`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `app_cities` (
  `city_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `country_id` bigint(20) NOT NULL,
  `region_id` bigint(20) NOT NULL,
  `city_name` varchar(255) CHARACTER SET latin1 NOT NULL,
  `lat` varchar(255) CHARACTER SET latin1 NOT NULL,
  `long` varchar(255) CHARACTER SET latin1 NOT NULL,
  `city_key` varchar(255) CHARACTER SET latin1 NOT NULL,
  `is_active_s` enum('Y','N') CHARACTER SET latin1 NOT NULL,
  `city_order` int(11) NOT NULL,
  PRIMARY KEY (`city_id`),
  KEY `country_id` (`country_id`),
  KEY `region_id` (`region_id`),
  CONSTRAINT `app_cities_ibfk_1` FOREIGN KEY (`country_id`) REFERENCES `app_countries` (`country_id`) ON DELETE CASCADE,
  CONSTRAINT `app_cities_ibfk_2` FOREIGN KEY (`region_id`) REFERENCES `app_regions` (`region_id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `app_cities`
--

LOCK TABLES `app_cities` WRITE;
/*!40000 ALTER TABLE `app_cities` DISABLE KEYS */;
INSERT INTO `app_cities` VALUES (1,68,2,'Espoo','24.655556','60.205556','esp','Y',1),(2,68,2,'Helsinki','24.9375','60.1708','hel','Y',2),(3,68,2,'Hämeenlinna','24.466667','61','hameenlinna','Y',3),(4,68,2,'Kouvola','26.704167','60.868056','kouvola','Y',4),(5,68,2,'Lahti','25.655556','60.983333','lahti','Y',5),(6,68,2,'Lappeenranta','28.183333','61.066667','lappeenranta','Y',6),(7,68,2,'Vantaa','25.040278','60.294444','vantaa','Y',7),(8,68,6,'Jyväskylä','25.7417','62.2417','JYV','Y',8),(9,68,6,'Kokkola','23.131944','63.838889','kokkola','Y',9),(10,68,6,'Pori','21.8','61.483333','pori','Y',10),(11,68,6,'Salo','23.125','60.386111','salo','Y',11),(12,68,6,'Seinäjoki','22.840278','62.790278','seinajoki','Y',12),(13,68,6,'Tampere','23.7667','61.5000','Tam','Y',13),(14,68,6,'Turku','22.266667','60.451389','turku','Y',14),(15,68,6,'Vaasa','21.615278','63.095833','vaasa','Y',15),(16,68,3,'Iisalmi','27.188889','63.561111','iisalmi','Y',16),(17,68,3,'Joensuu','29.763889','62.6','joensuu','Y',17),(18,68,3,'Kuopio','27.6783','62.8925','Kuo','Y',18),(19,68,3,'Mikkeli','27.266667','61.683333','mikkeli','Y',19),(20,68,3,'Savonlinna','28.886111','61.868056','savonlinna','Y',20),(21,68,4,'Kajaani','62.244747000000000000','25.747218400000065000','kaj','Y',21),(22,68,4,'Kuusamo','29.183333','65.966667','kuusamo','Y',22),(23,68,4,'Oulu','25.4667','65.0167','Oulu','Y',23),(24,68,4,'Raahe','24.466667','64.683333','raahe','Y',24),(25,68,4,'Ylivieska','24.5375','64.072222','yli','Y',25),(26,68,5,'Kemi','24.563889','65.736111','kemi','Y',26),(27,68,5,'Kemijärvi','27.433333','66.713889','kemijarvi','Y',27),(28,68,5,'Rovaniemi','25.7333','66.5000','Rova','Y',28),(29,68,5,'Tornio','24.147222','65.848611','tornio','Y',29),(30,68,1,'Maarianhamina','19.9333','60.1000','Marie','Y',30),(31,223,7,'New York City','40.714623','-74.006605','NYC','Y',31),(32,68,2,'Lohja','60.25','24.0833','Lohja','Y',32);
/*!40000 ALTER TABLE `app_cities` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `app_cms`
--

DROP TABLE IF EXISTS `app_cms`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `app_cms` (
  `cms_id` int(11) NOT NULL AUTO_INCREMENT,
  `local_admin_id` int(11) NOT NULL,
  `cms_type` varchar(100) NOT NULL,
  `cms_dec` text NOT NULL,
  PRIMARY KEY (`cms_id`),
  KEY `app_cms_local_admin_id` (`local_admin_id`),
  CONSTRAINT `app_cms_ibfk_1` FOREIGN KEY (`local_admin_id`) REFERENCES `app_password_manager` (`user_id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `app_cms`
--

LOCK TABLES `app_cms` WRITE;
/*!40000 ALTER TABLE `app_cms` DISABLE KEYS */;
/*!40000 ALTER TABLE `app_cms` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `app_code_code`
--

DROP TABLE IF EXISTS `app_code_code`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `app_code_code` (
  `code_code_id` int(25) NOT NULL AUTO_INCREMENT,
  `category` varchar(255) NOT NULL,
  `is_active` enum('Y','N') NOT NULL,
  `date_added` date NOT NULL,
  PRIMARY KEY (`code_code_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `app_code_code`
--

LOCK TABLES `app_code_code` WRITE;
/*!40000 ALTER TABLE `app_code_code` DISABLE KEYS */;
INSERT INTO `app_code_code` VALUES (1,'Appointment status','Y','2013-03-20'),(2,'Staff Selection','Y','2013-03-20');
/*!40000 ALTER TABLE `app_code_code` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `app_code_value`
--

DROP TABLE IF EXISTS `app_code_value`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `app_code_value` (
  `code_value_id` int(25) NOT NULL AUTO_INCREMENT,
  `code_code_id` int(25) NOT NULL,
  `value` varchar(255) NOT NULL,
  `is_active` enum('Y','N') NOT NULL,
  `date_added` date NOT NULL,
  PRIMARY KEY (`code_value_id`),
  KEY `fk_app_code_value_code_code_id` (`code_code_id`),
  CONSTRAINT `fk_app_code_value_code_code_id` FOREIGN KEY (`code_code_id`) REFERENCES `app_code_code` (`code_code_id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `app_code_value`
--

LOCK TABLES `app_code_value` WRITE;
/*!40000 ALTER TABLE `app_code_value` DISABLE KEYS */;
INSERT INTO `app_code_value` VALUES (1,1,'Aproved','N','2013-07-17'),(2,1,'Pending','N','2013-07-17'),(3,1,'Completed','N','2013-07-17'),(4,1,'Canceled by admin','N','2013-07-17'),(5,1,'Cancel by user','N','2013-07-17'),(6,1,'Set Status','Y','2013-03-20'),(7,1,'As scheduled','Y','2013-03-20'),(8,1,'Arrived late','Y','2013-03-20'),(9,1,'No show','Y','2013-03-20'),(10,1,'Gift Cerificates','Y','2013-03-20'),(11,2,'Most free staff (Timewise)','Y','2013-05-18'),(12,2,'Most free staff (Appointmentwise)','','0000-00-00'),(13,2,'Most busy staff (Timewise)','Y','0000-00-00'),(14,2,'Most busy staff (Appointmentwise)','Y','0000-00-00'),(15,2,'Order in which staff are displayed','Y','0000-00-00'),(16,1,'Reschedule','N','0000-00-00'),(17,1,'Unapproved','N','0000-00-00');
/*!40000 ALTER TABLE `app_code_value` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `app_countries`
--

DROP TABLE IF EXISTS `app_countries`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `app_countries` (
  `country_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `country_code` varchar(255) NOT NULL,
  `country_dial_prefix` bigint(50) NOT NULL,
  `country_name` varchar(255) NOT NULL,
  `is_active` enum('Y','N') NOT NULL,
  `country_order` int(11) NOT NULL,
  PRIMARY KEY (`country_id`)
) ENGINE=InnoDB AUTO_INCREMENT=242 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `app_countries`
--

LOCK TABLES `app_countries` WRITE;
/*!40000 ALTER TABLE `app_countries` DISABLE KEYS */;
INSERT INTO `app_countries` VALUES (1,'AD',376,'Andorra','Y',3),(2,'AE',971,'United Arab Emirates','Y',5),(3,'AF',93,'Afghanistan','Y',1),(4,'AG',1268,'Antigua and Barbuda','Y',4),(5,'AI',1264,'Anguilla','Y',2),(6,'AL',355,'Albania','Y',6),(7,'AM',374,'Armenia','Y',7),(8,'AN',599,'Netherlands Antilles','Y',9),(9,'AO',244,'Angola','Y',8),(10,'AQ',672,'Antarctica','Y',10),(11,'AR',54,'Argentina','Y',11),(12,'AS',1684,'American Samoa','Y',13),(13,'AT',43,'Austria','Y',12),(14,'AU',61,'Australia','Y',15),(15,'AW',297,'Aruba','Y',16),(16,'AZ',994,'Azerbaijan','Y',17),(17,'BA',387,'Bosnia and Herzegovina','Y',14),(18,'BB',1246,'Barbados','Y',18),(19,'BD',880,'Bangladesh','Y',19),(20,'BE',32,'Belgium','Y',21),(21,'BF',226,'Burkina Faso','Y',20),(22,'BG',359,'Bulgaria','Y',22),(23,'BH',973,'Bahrain','Y',23),(24,'BI',257,'Burundi','Y',24),(25,'BJ',229,'Benin','Y',25),(26,'BM',1441,'Bermuda','Y',26),(27,'BN',673,'Brunei Darussalam','Y',27),(28,'BO',591,'Bolivia','Y',28),(29,'BR',55,'Brazil','Y',29),(30,'BS',1242,'Bahamas','Y',30),(31,'BT',975,'Bhutan','Y',31),(32,'BV',47,'Bouvet Island','Y',32),(33,'BW',267,'Botswana','Y',33),(34,'BY',375,'Belarus','Y',34),(35,'BZ',501,'Belize','Y',35),(36,'CA',1,'Canada','Y',36),(37,'CC',891,'Cocos (Keeling) Islands','Y',37),(38,'CD',243,'Congo Democratic Republic','Y',38),(39,'CF',236,'Central African Republic','Y',39),(40,'CG',242,'Congo','Y',40),(41,'CH',41,'Switzerland','Y',41),(42,'CI',225,'Cote D\'Ivoire','Y',42),(43,'CK',682,'Cook Islands','Y',43),(44,'CL',56,'Chile','Y',44),(45,'CM',237,'Cameroon','Y',45),(46,'CN',86,'China','Y',46),(47,'CO',57,'Colombia','Y',47),(48,'CR',506,'Costa Rica','Y',48),(49,'CS',381,'Serbia and Montenegro','Y',49),(50,'CU',53,'Cuba','Y',50),(51,'CV',238,'Cape Verde','Y',51),(52,'CX',61,'Christmas Island','Y',52),(53,'CY',357,'Cyprus','Y',53),(54,'CZ',420,'Czech Republic','Y',54),(55,'DE',49,'Germany','Y',55),(56,'DJ',253,'Djibouti','Y',56),(57,'DK',45,'Denmark','Y',57),(58,'DM',1767,'Dominica','Y',58),(59,'DO',1809,'Dominican Republic','Y',60),(60,'DZ',213,'Algeria','Y',59),(61,'EC',593,'Ecuador','Y',61),(62,'EE',372,'Estonia','Y',62),(63,'EG',20,'Egypt','Y',63),(64,'EH',212,'Western Sahara','Y',64),(65,'ER',291,'Eritrea','Y',65),(66,'ES',34,'Spain','Y',66),(67,'ET',251,'Ethiopia','Y',67),(68,'FI',358,'Finland','Y',68),(69,'FJ',679,'Fiji','Y',69),(70,'FK',500,'Falkland Islands (Malvinas)','Y',70),(71,'FM',691,'Micronesia, Federated States','Y',71),(72,'FO',298,'Faroe Islands','Y',72),(73,'FR',33,'France','Y',73),(74,'GA',241,'Gabon','Y',74),(75,'GB',44,'United Kingdom','Y',75),(76,'GD',1473,'Grenada','Y',76),(77,'GE',995,'Georgia','Y',77),(78,'GF',594,'French Guiana','Y',78),(79,'GH',233,'Ghana','Y',79),(80,'GI',350,'Gibraltar','Y',80),(81,'GL',299,'Greenland','Y',81),(82,'GM',220,'Gambia','Y',82),(83,'GN',224,'Guinea','Y',83),(84,'GP',312,'Guadeloupe','Y',84),(85,'GQ',240,'Equatorial Guinea','Y',85),(86,'GR',30,'Greece','Y',86),(87,'GS',0,'South Georgia, South Sandwich Islands','Y',87),(88,'GT',502,'Guatemala','Y',88),(89,'GU',1671,'Guam','Y',89),(90,'GW',245,'Guinea-Bissau','Y',90),(91,'GY',592,'Guyana','Y',91),(92,'HK',852,'Hong Kong','Y',92),(93,'HM',0,'Heard Island and Mcdonald Islands','Y',93),(94,'HN',504,'Honduras','Y',94),(95,'HR',385,'Croatia','Y',95),(96,'HT',509,'Haiti','Y',96),(97,'HU',36,'Hungary','Y',97),(98,'ID',62,'Indonesia','Y',98),(99,'IE',353,'Ireland','Y',100),(100,'IL',972,'Israel','Y',99),(101,'IN',91,'Hongkong','Y',101),(102,'IO',246,'British Indian Ocean Territory','Y',102),(103,'IQ',964,'Iraq','Y',103),(104,'IR',98,'Iran','Y',104),(105,'IS',354,'Iceland','Y',105),(106,'IT',39,'Italy','Y',106),(107,'JM',1876,'Jamaica','Y',107),(108,'JO',962,'Jordan','Y',108),(109,'JP',81,'Japan','Y',109),(110,'KE',254,'Kenya','Y',110),(111,'KG',996,'Kyrgyzstan','Y',111),(112,'KH',855,'Cambodia','Y',112),(113,'KI',686,'Kiribati','Y',113),(114,'KM',269,'Comoros','Y',114),(115,'KN',1869,'Saint Kitts and Nevis','Y',115),(116,'KP',850,'Korea, Democratic People\'s Republic','Y',116),(117,'KR',82,'Korea, Republic of','Y',117),(118,'KW',965,'Kuwait','Y',118),(119,'KY',1345,'Cayman Islands','Y',119),(120,'KZ',7,'Kazakhstan','Y',120),(121,'LA',856,'Lao People\'s Democratic Republic','Y',121),(122,'LB',961,'Lebanon','Y',122),(123,'LC',1758,'Saint Lucia','Y',123),(124,'LI',423,'Liechtenstein','Y',124),(125,'LK',94,'Sri Lanka','Y',125),(126,'LR',231,'Liberia','Y',126),(127,'LS',266,'Lesotho','Y',127),(128,'LT',370,'Lithuania','Y',128),(129,'LU',352,'Luxembourg','Y',129),(130,'LV',371,'Latvia','Y',130),(131,'LY',218,'Libyan Arab Jamahiriya','Y',131),(132,'MA',212,'Morocco','Y',132),(133,'MC',377,'Monaco','Y',133),(134,'MD',373,'Moldova, Republic of','Y',134),(135,'MG',261,'Madagascar','Y',135),(136,'MH',692,'Marshall Islands','Y',136),(137,'MK',0,'Macedonia','Y',137),(138,'ML',223,'Mali','Y',138),(139,'MM',95,'Myanmar','Y',139),(140,'MN',976,'Mongolia','Y',140),(141,'MO',853,'Macao','Y',141),(142,'MP',1670,'Northern Mariana Islands','Y',142),(143,'MQ',596,'Martinique','Y',143),(144,'MR',222,'Mauritania','Y',144),(145,'MS',1664,'Montserrat','Y',145),(146,'MT',356,'Malta','Y',146),(147,'MU',230,'Mauritius','Y',147),(148,'MV',960,'Maldives','Y',148),(149,'MW',265,'Malawi','Y',149),(150,'MX',52,'Mexico','Y',150),(151,'MY',60,'Malaysia','Y',151),(152,'MZ',258,'Mozambique','Y',152),(153,'NA',264,'Namibia','Y',153),(154,'NC',687,'New Caledonia','Y',154),(155,'NE',227,'Niger','Y',155),(156,'NF',672,'Norfolk Island','Y',156),(157,'NG',234,'Nigeria','Y',157),(158,'NI',505,'Nicaragua','Y',158),(159,'NL',31,'Netherlands','Y',159),(160,'NO',47,'Norway','Y',160),(161,'NP',977,'Nepal','Y',161),(162,'NR',674,'Nauru','Y',162),(163,'NU',683,'Niue','Y',163),(164,'NZ',64,'New Zealand','Y',164),(165,'OM',968,'Oman','Y',165),(166,'PA',507,'Panama','Y',166),(167,'PE',51,'Peru','Y',167),(168,'PF',689,'French Polynesia','Y',168),(169,'PG',675,'Papua New Guinea','Y',169),(170,'PH',63,'Philippines','Y',170),(171,'PK',92,'Pakistan','Y',171),(172,'PL',48,'Poland','Y',172),(173,'PM',508,'Saint Pierre and Miquelon','Y',173),(174,'PN',870,'Pitcairn','Y',174),(175,'PR',1,'Puerto Rico','Y',175),(176,'PS',970,'Palestinian Territory, Occupied','Y',176),(177,'PT',351,'Portugal','Y',177),(178,'PW',680,'Palau','Y',178),(179,'PY',595,'Paraguay','Y',179),(180,'QA',974,'Qatar','Y',180),(181,'RE',262,'Reunion','Y',181),(182,'RO',40,'Romania','Y',182),(183,'RU',7,'Russian Federation','Y',183),(184,'RW',250,'Rwanda','Y',184),(185,'SA',966,'Saudi Arabia','Y',185),(186,'SB',677,'Solomon Islands','Y',186),(187,'SC',248,'Seychelles','Y',187),(188,'SD',249,'Sudan','Y',188),(189,'SE',46,'Sweden','Y',189),(190,'SG',65,'Singapore','Y',190),(191,'SH',290,'Saint Helena','Y',191),(192,'SI',386,'Slovenia','Y',192),(193,'SJ',47,'Svalbard and Jan Mayen','Y',193),(194,'SK',421,'Slovakia','Y',194),(195,'SL',232,'Sierra Leone','Y',195),(196,'SM',378,'San Marino','Y',196),(197,'SN',221,'Senegal','Y',197),(198,'SO',252,'Somalia','Y',198),(199,'SR',597,'Suriname','Y',199),(200,'ST',239,'Sao Tome and Principe','Y',200),(201,'SV',503,'El Salvador','Y',201),(202,'SY',963,'Syrian Arab Republic','Y',202),(203,'SZ',268,'Swaziland','Y',203),(204,'TC',1649,'Turks and Caicos Islands','Y',204),(205,'TD',235,'Chad','Y',205),(206,'TF',262,'French Southern Territories','Y',206),(207,'TG',228,'Togo','Y',207),(208,'TH',66,'Thailand','Y',208),(209,'TJ',992,'Tajikistan','Y',209),(210,'TK',690,'Tokelau','Y',210),(211,'TL',670,'Timor-Leste','Y',211),(212,'TM',993,'Turkmenistan','Y',212),(213,'TN',216,'Tunisia','Y',213),(214,'TO',676,'Tonga','Y',214),(215,'TR',90,'Turkey','Y',215),(216,'TT',1868,'Trinidad and Tobago','Y',216),(217,'TV',688,'Tuvalu','Y',217),(218,'TW',886,'Taiwan, Province of China','Y',218),(219,'TZ',255,'Tanzania, United Republic of','Y',219),(220,'UA',380,'Ukraine','Y',220),(221,'UG',256,'Uganda','Y',221),(222,'UM',0,'United States Minor Outlying Islands','Y',222),(223,'US',1,'United States','Y',223),(224,'UY',598,'Uruguay','Y',224),(225,'UZ',998,'Uzbekistan','Y',225),(226,'VA',379,'Holy See (Vatican City State)','Y',226),(227,'VC',1784,'Saint Vincent and the Grenadines','Y',227),(228,'VE',58,'Venezuela','Y',228),(229,'VG',1,'Virgin Islands, British','Y',229),(230,'VI',1,'Virgin Islands, U.s.','Y',230),(231,'VN',84,'Viet Nam','Y',231),(232,'VU',678,'Vanuatu','Y',232),(233,'WF',681,'Wallis and Futuna','Y',233),(234,'WS',685,'Samoa','Y',234),(235,'YE',967,'Yemen','Y',235),(236,'YT',262,'Mayotte','Y',236),(237,'ZA',27,'South Africa','Y',237),(238,'ZM',260,'Zambia','Y',238),(239,'ZW',263,'Zimbabwe','Y',239),(240,'',0,'China','Y',240),(241,'IND',123,'India','Y',241);
/*!40000 ALTER TABLE `app_countries` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `app_coupon`
--

DROP TABLE IF EXISTS `app_coupon`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `app_coupon` (
  `coupon_id` int(11) NOT NULL AUTO_INCREMENT,
  `local_admin_id` int(11) NOT NULL,
  `coupon_type` int(11) NOT NULL COMMENT '1-> Discount Coupon; 2->Offer coupon',
  `discount_amnt_setting` int(3) NOT NULL COMMENT 'Aplcb for typ 1 cpn; 1->%; 2->fixed amnt; 0-> not applicable',
  `discount_amnt` float(10,2) NOT NULL COMMENT 'Aplcb for typ 1 cpn; 0-> not applicable',
  `coupon_heading` varchar(255) CHARACTER SET latin1 NOT NULL,
  `coupon_desc` text CHARACTER SET latin1 NOT NULL,
  `coupon_img_url` text CHARACTER SET latin1 NOT NULL,
  `coupon_works_over` float(10,2) NOT NULL,
  `applicbl_services_for` text CHARACTER SET latin1 NOT NULL,
  `aplcbl_emp` text CHARACTER SET latin1 NOT NULL,
  `aplcbl_date_from` varchar(50) CHARACTER SET latin1 NOT NULL DEFAULT '0',
  `aplcbl_date_to` varchar(50) CHARACTER SET latin1 NOT NULL DEFAULT '0',
  `aplcbl_hour_from` varchar(11) CHARACTER SET latin1 NOT NULL DEFAULT '0',
  `aplcbl_hour_to` varchar(11) CHARACTER SET latin1 NOT NULL DEFAULT '0',
  `aplcbl_days_on_week` text CHARACTER SET latin1 NOT NULL,
  `coupon_code` varchar(255) CHARACTER SET latin1 NOT NULL,
  `first_time_use_only` int(2) NOT NULL DEFAULT '0',
  `one_time_use_only` int(2) NOT NULL DEFAULT '0',
  `no_of_booking_possible` int(11) NOT NULL,
  `date_of_creation` date NOT NULL,
  `date_modify` date NOT NULL,
  `status` int(2) NOT NULL DEFAULT '1',
  `acitive` int(2) NOT NULL DEFAULT '1',
  `is_autoPromo` int(2) NOT NULL DEFAULT '0' COMMENT '0=Defult 1= auto promotions ',
  PRIMARY KEY (`coupon_id`),
  KEY `fk_app_coupon_local_admin_id` (`local_admin_id`),
  CONSTRAINT `fk_app_coupon_local_admin_id` FOREIGN KEY (`local_admin_id`) REFERENCES `app_local_admin` (`local_admin_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `app_coupon`
--

LOCK TABLES `app_coupon` WRITE;
/*!40000 ALTER TABLE `app_coupon` DISABLE KEYS */;
/*!40000 ALTER TABLE `app_coupon` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `app_cron_manager`
--

DROP TABLE IF EXISTS `app_cron_manager`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `app_cron_manager` (
  `cron_id` int(11) NOT NULL AUTO_INCREMENT,
  `cron_job_code` varchar(255) NOT NULL,
  `cron_local_admin_id` int(11) NOT NULL,
  `cron_customer_id` int(11) NOT NULL,
  `cron_customer_name` varchar(255) NOT NULL,
  `cron_alert_type` enum('1','2') NOT NULL COMMENT '1=SMS , 2=Mail',
  `cron_subject` varchar(255) NOT NULL,
  `cron_messages` text NOT NULL,
  `cron_customer_mobile` varchar(255) NOT NULL,
  `cron_customer_email` varchar(255) NOT NULL,
  `cron_sender_mobile` varchar(255) NOT NULL,
  `cron_sender_email` varchar(255) NOT NULL,
  `cron_messages_status` int(5) NOT NULL COMMENT '1=waiting for sending, 2=Waiting for respons, 3= message send,4= faild',
  `cron_email_respons` text NOT NULL,
  `cron_sms_respons` text NOT NULL,
  `cron_create_datetime` datetime NOT NULL,
  `cron_executed_datetime` datetime NOT NULL,
  `cron_finished_datetime` datetime NOT NULL,
  PRIMARY KEY (`cron_id`),
  KEY `fk_app_cron_manager_cron_customer_id` (`cron_customer_id`),
  KEY `app_cron_manager_cron_local_admin_id` (`cron_local_admin_id`),
  CONSTRAINT `app_cron_manager_cron_local_admin_id` FOREIGN KEY (`cron_local_admin_id`) REFERENCES `app_password_manager` (`user_id`),
  CONSTRAINT `fk_app_cron_manager_cron_customer_id` FOREIGN KEY (`cron_customer_id`) REFERENCES `app_password_manager` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `app_cron_manager`
--

LOCK TABLES `app_cron_manager` WRITE;
/*!40000 ALTER TABLE `app_cron_manager` DISABLE KEYS */;
/*!40000 ALTER TABLE `app_cron_manager` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `app_currency`
--

DROP TABLE IF EXISTS `app_currency`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `app_currency` (
  `currency_id` int(11) NOT NULL AUTO_INCREMENT,
  `currency_name` varchar(50) NOT NULL,
  `currency_abbriviation` varchar(50) NOT NULL,
  `currency_symbol` varchar(50) NOT NULL,
  `is_active` enum('Y','N') NOT NULL DEFAULT 'Y',
  PRIMARY KEY (`currency_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `app_currency`
--

LOCK TABLES `app_currency` WRITE;
/*!40000 ALTER TABLE `app_currency` DISABLE KEYS */;
INSERT INTO `app_currency` VALUES (1,'USD','USD','$','Y'),(2,'EURO','EUR','&euro;','Y');
/*!40000 ALTER TABLE `app_currency` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `app_currency_format`
--

DROP TABLE IF EXISTS `app_currency_format`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `app_currency_format` (
  `currency_format_id` int(11) NOT NULL AUTO_INCREMENT,
  `currency_format` varchar(255) NOT NULL,
  `is_active` enum('Y','N') NOT NULL DEFAULT 'Y',
  PRIMARY KEY (`currency_format_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `app_currency_format`
--

LOCK TABLES `app_currency_format` WRITE;
/*!40000 ALTER TABLE `app_currency_format` DISABLE KEYS */;
INSERT INTO `app_currency_format` VALUES (1,'XX,XXX.XX','Y'),(2,'XX.XXX,XX','Y');
/*!40000 ALTER TABLE `app_currency_format` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `app_currency_rate`
--

DROP TABLE IF EXISTS `app_currency_rate`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `app_currency_rate` (
  `currency_from` char(3) NOT NULL DEFAULT '',
  `currency_to` char(3) NOT NULL DEFAULT '',
  `rate` decimal(24,12) NOT NULL DEFAULT '0.000000000000',
  PRIMARY KEY (`currency_from`,`currency_to`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `app_currency_rate`
--

LOCK TABLES `app_currency_rate` WRITE;
/*!40000 ALTER TABLE `app_currency_rate` DISABLE KEYS */;
INSERT INTO `app_currency_rate` VALUES ('USD','EUR',0.734098000000),('USD','USD',1.000000000000);
/*!40000 ALTER TABLE `app_currency_rate` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `app_custom_calender_colors`
--

DROP TABLE IF EXISTS `app_custom_calender_colors`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `app_custom_calender_colors` (
  `local_admin_id` int(11) NOT NULL,
  `approved_color` varchar(24) NOT NULL,
  `pending_color` varchar(24) NOT NULL,
  `scheduled_color` varchar(24) NOT NULL,
  `late_color` varchar(24) NOT NULL,
  `noshow_color` varchar(24) NOT NULL,
  `unknown_color` varchar(24) NOT NULL,
  `approved_color_L` varchar(24) NOT NULL,
  `pending_color_L` varchar(24) NOT NULL,
  `scheduled_color_L` varchar(24) NOT NULL,
  `late_color_L` varchar(24) NOT NULL,
  `noshow_color_L` varchar(24) NOT NULL,
  `unknown_color_L` varchar(24) NOT NULL,
  PRIMARY KEY (`local_admin_id`),
  CONSTRAINT `app_custom_calender_colors_ibfk_1` FOREIGN KEY (`local_admin_id`) REFERENCES `app_local_admin` (`local_admin_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Admin Calendar color themes';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `app_custom_calender_colors`
--

LOCK TABLES `app_custom_calender_colors` WRITE;
/*!40000 ALTER TABLE `app_custom_calender_colors` DISABLE KEYS */;
/*!40000 ALTER TABLE `app_custom_calender_colors` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `app_custom_color_scheme`
--

DROP TABLE IF EXISTS `app_custom_color_scheme`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `app_custom_color_scheme` (
  `ccs_id` int(50) NOT NULL AUTO_INCREMENT,
  `theme_name` varchar(255) NOT NULL COMMENT 'Options are:  CS1->Color Scheme1; CS2->Color Scheme2; CS3->Color Scheme3; CS4->Color Scheme4; CCS->Custom color Scheme;',
  `local_admin_id` int(50) NOT NULL DEFAULT '0',
  `background_color` varchar(255) NOT NULL DEFAULT 'ffffff',
  `background_image` varchar(255) NOT NULL DEFAULT 'images/none.png',
  `staffServicePanel_color` varchar(255) NOT NULL DEFAULT 'c3d9f3',
  `staffToolTip_color` varchar(255) NOT NULL DEFAULT '000',
  `serviceTooltip_color` varchar(255) NOT NULL DEFAULT 'c3d9f3',
  `tabBG_color` varchar(255) NOT NULL DEFAULT 'E6B85C',
  `activTabBG_color` varchar(255) NOT NULL DEFAULT 'a5bade',
  `tabContentBGColor_color` varchar(255) NOT NULL DEFAULT 'ccc',
  `tabHeaderBGColor_color` varchar(255) NOT NULL DEFAULT 'f3f3f3',
  `weekCalBGColor_color` varchar(255) NOT NULL DEFAULT 'ccc',
  `weekCalfont_color` varchar(255) NOT NULL DEFAULT 'f3f3f3',
  `btnBGColor_color` varchar(255) NOT NULL DEFAULT 'ccc',
  `btnAcountBGColor_color` varchar(255) NOT NULL DEFAULT 'f3f3f3',
  `date_added` date NOT NULL,
  `date_edited` date NOT NULL,
  PRIMARY KEY (`ccs_id`),
  UNIQUE KEY `local_admin_id` (`local_admin_id`),
  CONSTRAINT `app_custom_color_scheme_ibfk_1` FOREIGN KEY (`local_admin_id`) REFERENCES `app_password_manager` (`user_id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `app_custom_color_scheme`
--

LOCK TABLES `app_custom_color_scheme` WRITE;
/*!40000 ALTER TABLE `app_custom_color_scheme` DISABLE KEYS */;
/*!40000 ALTER TABLE `app_custom_color_scheme` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `app_customer_admin_relationship`
--

DROP TABLE IF EXISTS `app_customer_admin_relationship`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `app_customer_admin_relationship` (
  `local_admin_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `search_id` int(11) NOT NULL DEFAULT '0',
  `customer_tag` text,
  `customer_info` text,
  PRIMARY KEY (`local_admin_id`,`customer_id`),
  KEY `app_customer_admin_relationship_customer_id` (`customer_id`),
  CONSTRAINT `app_customer_admin_relationship_customer_id` FOREIGN KEY (`customer_id`) REFERENCES `app_password_manager` (`user_id`),
  CONSTRAINT `fk_app_customer_admin_relationship_local_admin_id` FOREIGN KEY (`local_admin_id`) REFERENCES `app_password_manager` (`user_id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `app_customer_admin_relationship`
--

LOCK TABLES `app_customer_admin_relationship` WRITE;
/*!40000 ALTER TABLE `app_customer_admin_relationship` DISABLE KEYS */;
/*!40000 ALTER TABLE `app_customer_admin_relationship` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `app_customer_approval_type`
--

DROP TABLE IF EXISTS `app_customer_approval_type`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `app_customer_approval_type` (
  `approval_id` int(11) NOT NULL AUTO_INCREMENT,
  `approval_type` varchar(255) NOT NULL,
  PRIMARY KEY (`approval_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `app_customer_approval_type`
--

LOCK TABLES `app_customer_approval_type` WRITE;
/*!40000 ALTER TABLE `app_customer_approval_type` DISABLE KEYS */;
INSERT INTO `app_customer_approval_type` VALUES (1,'Pre-Paying Members'),(2,'Phone Verified Members'),(3,'Non Phone Verified Members'),(4,'Non email verified members');
/*!40000 ALTER TABLE `app_customer_approval_type` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `app_customer_search`
--

DROP TABLE IF EXISTS `app_customer_search`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `app_customer_search` (
  `search_id` int(11) NOT NULL AUTO_INCREMENT,
  `cus_fname` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `cus_lname` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `cus_address` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `cus_countryid` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `cus_regionid` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `cus_cityid` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `cus_zip` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `cus_mob` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `cus_phn1` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `cus_phn2` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `cus_status` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `created_by` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `created_on` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `updated_by` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `time_zone_id` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `updated_on` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `cus_id` int(11) NOT NULL,
  PRIMARY KEY (`search_id`),
  KEY `id_index` (`cus_fname`),
  KEY `app_customer_search_cus_id` (`cus_id`),
  CONSTRAINT `app_customer_search_cus_id` FOREIGN KEY (`cus_id`) REFERENCES `app_password_manager` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `app_customer_search`
--

LOCK TABLES `app_customer_search` WRITE;
/*!40000 ALTER TABLE `app_customer_search` DISABLE KEYS */;
/*!40000 ALTER TABLE `app_customer_search` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `app_customer_type_relation`
--

DROP TABLE IF EXISTS `app_customer_type_relation`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `app_customer_type_relation` (
  `typerelation_id` int(11) NOT NULL AUTO_INCREMENT,
  `typerelation_customer_id` int(11) NOT NULL,
  `typerelation_customertype_id` int(11) NOT NULL,
  `typerelation_localadmin` int(11) NOT NULL,
  `typerelation_status` enum('Y','N') NOT NULL DEFAULT 'Y',
  PRIMARY KEY (`typerelation_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `app_customer_type_relation`
--

LOCK TABLES `app_customer_type_relation` WRITE;
/*!40000 ALTER TABLE `app_customer_type_relation` DISABLE KEYS */;
/*!40000 ALTER TABLE `app_customer_type_relation` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `app_customertype`
--

DROP TABLE IF EXISTS `app_customertype`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `app_customertype` (
  `customertype_id` int(11) NOT NULL AUTO_INCREMENT,
  `customertype_localadmin` int(11) NOT NULL,
  `customertype_name` varchar(255) NOT NULL,
  `customertype_status` enum('Y','N') NOT NULL,
  `customertype_isdeleted` enum('Y','N') NOT NULL,
  `customertype_adddate` date DEFAULT NULL,
  `customertype_editdate` date DEFAULT NULL,
  PRIMARY KEY (`customertype_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `app_customertype`
--

LOCK TABLES `app_customertype` WRITE;
/*!40000 ALTER TABLE `app_customertype` DISABLE KEYS */;
/*!40000 ALTER TABLE `app_customertype` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `app_customize`
--

DROP TABLE IF EXISTS `app_customize`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `app_customize` (
  `customize_id` int(11) NOT NULL AUTO_INCREMENT,
  `lcal_admin_id` int(11) NOT NULL,
  `is_customize_form` enum('0','1') NOT NULL,
  `back_ground_image_url` varchar(255) NOT NULL,
  `widget_url` varchar(255) NOT NULL,
  `facebook_image_url` varchar(255) NOT NULL,
  `twitter_image_url` varchar(255) NOT NULL,
  PRIMARY KEY (`customize_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `app_customize`
--

LOCK TABLES `app_customize` WRITE;
/*!40000 ALTER TABLE `app_customize` DISABLE KEYS */;
/*!40000 ALTER TABLE `app_customize` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `app_datatype`
--

DROP TABLE IF EXISTS `app_datatype`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `app_datatype` (
  `data_type_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `value` varchar(100) NOT NULL,
  PRIMARY KEY (`data_type_id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `app_datatype`
--

LOCK TABLES `app_datatype` WRITE;
/*!40000 ALTER TABLE `app_datatype` DISABLE KEYS */;
INSERT INTO `app_datatype` VALUES (1,'TEXT','text'),(2,'NUMBER','text'),(3,'DATE','text'),(4,'RADIO','radio'),(5,'LIST','select'),(6,'CHECK BOX','checkbox'),(7,'PASSWORD','password');
/*!40000 ALTER TABLE `app_datatype` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `app_date_format`
--

DROP TABLE IF EXISTS `app_date_format`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `app_date_format` (
  `date_format_id` int(11) NOT NULL AUTO_INCREMENT,
  `date_format` varchar(255) NOT NULL,
  `is_active` enum('Y','N') NOT NULL DEFAULT 'Y',
  `date_format_order` int(11) NOT NULL,
  PRIMARY KEY (`date_format_id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `app_date_format`
--

LOCK TABLES `app_date_format` WRITE;
/*!40000 ALTER TABLE `app_date_format` DISABLE KEYS */;
INSERT INTO `app_date_format` VALUES (1,'MM/DD/YYYY','Y',2),(2,'DD/MM/YYYY','Y',1),(3,'YYYY-MM-DD','Y',3),(4,'YY-MM-DD','Y',4),(6,'YYYY/MM/DD','Y',5),(7,'DD.MM.YYYY','Y',6);
/*!40000 ALTER TABLE `app_date_format` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `app_dependency`
--

DROP TABLE IF EXISTS `app_dependency`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `app_dependency` (
  `dependency_id` int(11) NOT NULL AUTO_INCREMENT,
  `local_admin_id` int(11) NOT NULL,
  `non_dependent_service_id` int(11) NOT NULL,
  `dependent_service_id` int(11) NOT NULL,
  `date_added` date NOT NULL,
  `date_edited` date NOT NULL,
  PRIMARY KEY (`dependency_id`),
  KEY `local_admin_id` (`local_admin_id`),
  KEY `dependent_service_id` (`dependent_service_id`),
  CONSTRAINT `app_dependency_ibfk_1` FOREIGN KEY (`local_admin_id`) REFERENCES `app_local_admin` (`local_admin_id`) ON DELETE CASCADE,
  CONSTRAINT `app_dependency_ibfk_4` FOREIGN KEY (`dependent_service_id`) REFERENCES `app_service` (`service_id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `app_dependency`
--

LOCK TABLES `app_dependency` WRITE;
/*!40000 ALTER TABLE `app_dependency` DISABLE KEYS */;
/*!40000 ALTER TABLE `app_dependency` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `app_dependency_custom`
--

DROP TABLE IF EXISTS `app_dependency_custom`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `app_dependency_custom` (
  `field_option_message_id` int(11) NOT NULL AUTO_INCREMENT,
  `option_id` int(11) NOT NULL,
  `message` varchar(255) NOT NULL DEFAULT '' COMMENT 'Message to show',
  PRIMARY KEY (`field_option_message_id`),
  UNIQUE KEY `option_id` (`option_id`),
  CONSTRAINT `app_dependency_custom_ibfk_5` FOREIGN KEY (`option_id`) REFERENCES `app_booking_extra_field_option` (`option_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `app_dependency_custom`
--

LOCK TABLES `app_dependency_custom` WRITE;
/*!40000 ALTER TABLE `app_dependency_custom` DISABLE KEYS */;
/*!40000 ALTER TABLE `app_dependency_custom` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `app_design_offer`
--

DROP TABLE IF EXISTS `app_design_offer`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `app_design_offer` (
  `design_offer_id` int(11) NOT NULL AUTO_INCREMENT,
  `local_admin_id` int(11) NOT NULL,
  `template_id` int(11) NOT NULL,
  `title` varchar(256) CHARACTER SET latin1 NOT NULL,
  `description` text CHARACTER SET latin1 NOT NULL,
  `background_color` varchar(8) CHARACTER SET latin1 NOT NULL,
  `border_color` varchar(8) CHARACTER SET latin1 NOT NULL,
  `title_color` varchar(8) CHARACTER SET latin1 NOT NULL,
  `description_color` varchar(8) CHARACTER SET latin1 NOT NULL,
  `image_path` varchar(256) CHARACTER SET latin1 NOT NULL,
  `repeat` varchar(100) CHARACTER SET latin1 NOT NULL,
  `position` varchar(100) CHARACTER SET latin1 DEFAULT NULL,
  `date_added` date NOT NULL,
  `date_edited` date NOT NULL,
  PRIMARY KEY (`design_offer_id`),
  KEY `fk_app_design_offer_template_id` (`template_id`),
  CONSTRAINT `fk_app_design_offer_template_id` FOREIGN KEY (`template_id`) REFERENCES `app_offer_template` (`template_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `app_design_offer`
--

LOCK TABLES `app_design_offer` WRITE;
/*!40000 ALTER TABLE `app_design_offer` DISABLE KEYS */;
/*!40000 ALTER TABLE `app_design_offer` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `app_email_msg`
--

DROP TABLE IF EXISTS `app_email_msg`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `app_email_msg` (
  `msg_id` int(11) NOT NULL AUTO_INCREMENT,
  `purpose` text NOT NULL,
  `purpose_details` text NOT NULL,
  `mail_demo_subject` text NOT NULL,
  `mail_demo_content` text NOT NULL,
  `is_active` enum('0','1') NOT NULL DEFAULT '1' COMMENT '1=>Active, 0=>Inactive',
  PRIMARY KEY (`msg_id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `app_email_msg`
--

LOCK TABLES `app_email_msg` WRITE;
/*!40000 ALTER TABLE `app_email_msg` DISABLE KEYS */;
INSERT INTO `app_email_msg` VALUES (1,'Booking Confirmation Email ','This email will be sent to your customer after every confirmed booking. ','Appointment Confirmation!',' <div style=\"margin: 0; background-color: #fff; text-align: center; font-size: 14px; line-height: 1.5; color: #333; font-family: Arial; font-weight: normal;\"> <div style=\"padding: 5px; margin: 0 auto; width: auto; text-align: left;\"> <img src=\"http://bookient.com/images/defult_logo.png\" alt=\"bookient-logo\"> </div> <div style=\"padding: 5px; background-color: #f0f0f0; -webkit-text-size-adjust: none; -ms-text-size-adjust: 100%; font-size: 1em;\"> <div style=\"margin: 0 auto; text-align: left; width: auto; background-color: #fff; border-radius: 8px; padding: 12px; border-top: solid 8px #742894; border-bottom: solid 8px #742894; border-left: solid 1px #E3E3E3; border-right: solid 1px #E3E3E3;\"> <div> <div style=\"font-size: 1.4em; white-space: nowrap;\"><strong>{businessname} - Appointment Confirmation!</strong></div> <div> <div style=\"margin: 1em 0px;\"><strong>Hello </strong>{fname} {lname}<strong>,</strong></div> <div style=\"margin: 1em 0px;\">Your appointment on {appointmentdate} has been successfully scheduled for the following service(s).&nbsp;</div> <div style=\"border-radius:5px; margin: 1em 0px; border: 1px solid #E3E3E3; padding: 10px; background-color: #F6F6F6; white-space: nowrap;\"> {AppointmentInfo} </div> <div style=\"margin: 1em 0px;\"><span style=\"line-height: 1.5;\">If you have any questions, please feel free to contact us by email at <a href=\"mailto:{businessemail}\" target=\"_blank\" rel=\"nofollow\">{businessemail}</a> or by phone {businessphone} during our normal business hours.&nbsp;</span></div> <div style=\"margin: 1em 0px;\"> <strong>Address:</strong> {businessaddress} </div> <div style=\"margin: 1em 0px;\"> You may cancel your appointment 24 hour(s) in advance. We look forward to meeting with you! </div> <div style=\"margin: 1em 0px;\"> <a href=\"{cancelAppLink}\">Click here to cancel this appointment.</a> </div> <div style=\"border-top: 1px solid #dcdcdc;\"></div> <div style=\"margin: 1em 0px;\"> <div style=\"margin: 1em 0px;\">&nbsp;</div><div style=\"margin: 1em 0px;\"><strong>Cancellation Policy</strong> {cancellationpolicy}</div> </div> <div style=\"margin: 1em 0px;\"> For more information, please contact us at <a href=\"mailto:{businessemail}\" target=\"_blank\" rel=\"nofollow\">{businessemail}</a> </div> </div> </div> </div> </div> </div> ','1'),(2,'Waiting for Approval','This email will be sent to your customer who book appointments that need approval before final confirmation. ','Appointment sent for approval',' <div style=\"text-align: left;padding-left: 25px;\"><img src=\"http://bookient.com/images/defult_logo.png\" alt=\"bookient-logo\"></div><h1 style=\"margin: 0px; padding: 15px 0px 5px 25px; font-weight: bold; font-size: 22px; color: rgb(0, 191, 255); font-family: Arial;\"> {businessname}<span style=\"font-weight: normal; font-size: 21px;\"> - Appointment Confirmation!</span></h1> <div style=\"border-top: 1px solid rgb(0, 191, 255); border-bottom: 1px solid rgb(0, 191, 255); margin-bottom: 16px; margin-left: 25px;\"> <div style=\"border-top: 3px solid rgb(0, 191, 255); margin-top: 1px; margin-bottom: 1px;\"> </div> </div> <p style=\"margin: 0px;\">&nbsp; <strong></strong><strong>&nbsp;&nbsp; <br></strong></p><p style=\"margin: 0px;\"><strong>&nbsp;&nbsp;&nbsp;&nbsp; <font style=\"font-weight: bold;\" size=\"2\">Hello </font></strong><font style=\"font-weight: bold;\" size=\"2\"><span style=\"color: rgb(0, 0, 0);\">{fname} {lname}</span><strong style=\"color: rgb(0, 0, 0);\">,</strong></font></p><span class=\"Apple-style-span\" style=\"border-collapse: separate; color: rgb(0, 0, 0); font-family: \'Times New Roman\'; font-size: 16px; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; line-height: normal; orphans: 2; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px;\"><span class=\"Apple-style-span\" style=\"border-collapse: collapse; font-family: Helvetica; font-size: 13px; line-height: 19px;\"><h1 style=\"margin: 0px; padding: 15px 0px 5px 25px; font-weight: bold; font-size: 22px; color: rgb(0, 191, 255); font-family: Arial;\"><span style=\"font-weight: normal; font-size: 21px;\"></span></h1><div style=\"margin-left: 25px; margin-right: 50px;\"><p style=\"margin: 0px;\">Your appointment on<span class=\"Apple-converted-space\"> </span>{appointmentdate} has been successfully sent in for approval for the following service(s).&nbsp;<font size=\"1\"><br></font></p><p style=\"margin: 0px;\"><font size=\"1\"></font><br></p> <p style=\"border: 1px solid rgb(182, 213, 238); margin: 0px; padding: 10px; font-size: 18px; background-color: rgb(222, 238, 246);\">{AppointmentInfo}<span style=\"color: rgb(77, 77, 77);\"></span></p><p style=\"margin: 0px; font-size: 12px; font-weight: bold; color: rgb(0, 0, 0);\"><span style=\"color: rgb(51, 51, 51); text-transform: capitalize;\"><br></span></p><p style=\"margin: 0px;\">If you have any questions, please feel free to contact us by email at {businessemail}<span class=\"Apple-converted-space\"> </span>or by phone on {businessphone} during our normal business hours.</p><p style=\"margin: 0px;\"><br></p><p style=\"margin: 0px;\"><strong>Address:<br></strong>{businessaddress}</p><p style=\"margin: 0px;\"><br></p><p style=\"margin: 0px;\">You may cancel your appointment at anytime. We look forward to seeing you.</p><hr><div style=\"font-family: Verdana; font-size: 10px; line-height: 10px;\"><p style=\"margin: 0px;\"><strong>Additional Information</strong></p><p style=\"margin: 0px;\">{additionalinformation}</p><p style=\"margin: 0px;\"><br></p><p style=\"margin: 0px;\"><strong><br></strong></p><p style=\"margin: 0px;\"><strong>Cancellation Policy</strong></p><p style=\"margin: 0px;\">{cancellationpolicy}</p><p style=\"margin: 0px;\"><br></p></div><p style=\"margin: 0px;\"><br></p><p style=\"margin: 0px;\">For more information, please contact us at<span class=\"Apple-converted-space\"> </span>{businessemail}</p></div></span></span> ','1'),(3,'Waiting for Approval - Approved Appointment ','This email will be sent to advise your customer after an administrator or member of staff approves an Appointment. This email will be a follow up notification to the \"Waiting for Approval\" appointments. This email is not the same as the \"Booking confirmation email\". ','Appointment confirmed with Pardco IT-services',' <div style=\"margin: 0; background-color: #fff; text-align: center; font-size: 14px; line-height: 1.5; color: #333; font-family: Arial; font-weight: normal;\"> <div style=\"padding: 5px; margin: 0 auto; width: auto; text-align: left;\"> <img src=\"http://bookient.com/images/defult_logo.png\" alt=\"bookient-logo\"> </div> <div style=\"padding: 5px; background-color: #f0f0f0; -webkit-text-size-adjust: none; -ms-text-size-adjust: 100%; font-size: 1em;\"> <div style=\"margin: 0 auto; text-align: left; width: auto; background-color: #fff; border-radius: 8px; padding: 12px; border-top: solid 8px #742894; border-bottom: solid 8px #742894; border-left: solid 1px #E3E3E3; border-right: solid 1px #E3E3E3;\"> <div> <div style=\"font-size: 1.4em; white-space: nowrap;\"><strong>{businessname} - Appointment Information!</strong></div> <div> <div> <div style=\"margin: 1em 0px;\"><strong>Hello </strong>{fname} {lname}<strong>,</strong></div><div style=\"margin: 1em 0px;\">Thank you for using our online scheduling system.</div><div>Your appointment with us on {appointmentdate} has been successfully added to our calendar.</div><div>We kindly request that you present 5 minutes prior to your appointment time.</div><div style=\"margin: 1em 0px;\"><strong>Our Address</strong> {businessaddress}</div><div style=\"margin: 1em 0px;\">Remember you have {hoursbeforecancellation} hours prior to the time of your appointment in which you can cancel if you need to do so.</div><div style=\"margin: 1em 0px;\">We look forward to see you.</div><div style=\"margin: 1em 0px;\">Regards {businessname}</div><div style=\"border-top: 1px solid #dcdcdc;\"></div><div style=\"margin: 1em 0px;\"><span style=\"font-weight: bold;\">Additional Information</span> {additionalinformation}</div><div style=\"margin: 1em 0px;\">&nbsp;</div><div style=\"margin: 1em 0px;\"><strong>Cancellation Policy</strong> {cancellationpolicy}</div> </div> <div style=\"margin: 1em 0px;\"> For more information contact us at: <a href=\"mailto:{businessemail}\" target=\"_blank\" rel=\"nofollow\">{businessemail}</a> </div> </div> </div> </div> </div> </div> ','1'),(4,'Waiting for Approval - Appointment denied','This email will be sent to advise your customer if an administrator or member of staff denies an appointment. This email will act as a follow up email for “Waiting for Approval” appointments. ','Appointment Denied sss',' <div style=\"margin: 0; background-color: #fff; text-align: center; font-size: 14px; line-height: 1.5; color: #333; font-family: Arial; font-weight: normal;\"> <div style=\"padding: 5px; margin: 0 auto; width: auto; text-align: left;\"> <img src=\"http://bookient.com/images/defult_logo.png\" alt=\"bookient-logo\"> </div> <div style=\"padding: 5px; background-color: #f0f0f0; -webkit-text-size-adjust: none; -ms-text-size-adjust: 100%; font-size: 1em;\"> <div style=\"margin: 0 auto; text-align: left; width: auto; background-color: #fff; border-radius: 8px; padding: 12px; border-top: solid 8px #742894; border-bottom: solid 8px #742894; border-left: solid 1px #E3E3E3; border-right: solid 1px #E3E3E3;\"> <div> <div style=\"font-size: 1.4em; white-space: nowrap;\"><strong>{businessname} - Important Appointment Notification</strong></div> <div> <div style=\"margin: 1em 0px;\"><strong>Hello </strong>{fname} {lname}<strong>,</strong></div> <div style=\"margin: 1em 0px;\">Your appointment has been denied by our administrator for the following service(s).&nbsp;</div> <div style=\"border-radius:5px; margin: 1em 0px; border: 1px solid #E3E3E3; padding: 10px; background-color: #F6F6F6; white-space: nowrap;\"> {AppointmentInfo} </div> <div style=\"margin: 1em 0px;\"><span style=\"line-height: 1.5;\">If you have any questions, please feel free to contact us by email at <a href=\"mailto:{businessemail}\" target=\"_blank\" rel=\"nofollow\">{businessemail}</a> or by phone {businessphone} during our normal business hours.&nbsp;</span></div> <div style=\"margin: 1em 0px;\"> <strong>Address:</strong> {businessaddress} </div> <div style=\"border-top: 1px solid #dcdcdc;\"></div> <div style=\"margin: 1em 0px;\"> <div style=\"margin: 1em 0px;\">&nbsp;</div><div style=\"margin: 1em 0px;\"><strong>Cancellation Policy</strong> {cancellationpolicy}</div> </div> <div style=\"margin: 1em 0px;\"> For more information, please contact us at <a href=\"mailto:{businessemail}\" target=\"_blank\" rel=\"nofollow\">{businessemail}</a> </div> </div> </div> </div> </div> </div> ','1'),(5,'Appointment Rescheduled ','This email will be sent to alert your customer if an administrator or member of staff reschedules an appointment. ','Appointment Rescheduled',' <div style=\"margin: 0; background-color: #fff; text-align: center; font-size: 14px; line-height: 1.5; color: #333; font-family: Arial; font-weight: normal;\"> <div style=\"padding: 5px; margin: 0 auto; width: auto; text-align: left;\"> <img src=\"http://bookient.com/images/defult_logo.png\" alt=\"bookient-logo\"> </div> <div style=\"padding: 5px; background-color: #f0f0f0; -webkit-text-size-adjust: none; -ms-text-size-adjust: 100%; font-size: 1em;\"> <div style=\"margin: 0 auto; text-align: left; width: auto; background-color: #fff; border-radius: 8px; padding: 12px; border-top: solid 8px #742894; border-bottom: solid 8px #742894; border-left: solid 1px #E3E3E3; border-right: solid 1px #E3E3E3;\"> <div> <div style=\"font-size: 1.4em; white-space: nowrap;\"><strong>{businessname} - Appointment Rescheduled</strong></div> <div> <div style=\"margin: 1em 0px;\"><strong>Hello </strong>{fname} {lname}<strong>,</strong></div> <div style=\"margin: 1em 0px;\">Your appointment has been updated, please check appointment details in the box below.</div> <div style=\"margin: 1em 0px;text-decoration: underline;\"> <strong>Changed Details</strong> </div> <div style=\"border-radius: 5px; margin: 1em 0px; border: 1px solid #E3E3E3; padding: 10px; background-color: #F6F6F6; white-space: nowrap;\"> {AppointmentInfo} </div> <div style=\"margin: 1em 0px;text-decoration: underline;\"> <strong>Previous Details</strong> </div> <div style=\"border-radius: 5px; margin: 1em 0px; border: 1px solid #E3E3E3; padding: 10px; background-color: #F6F6F6; white-space: nowrap;\"> {OldAppointmentInfo} </div> <div style=\"margin: 1em 0px;\"><span style=\"line-height: 1.5;\">If you have any questions, please feel free to contact us by email at <a href=\"mailto:{businessemail}\" target=\"_blank\" rel=\"nofollow\">{businessemail}</a> or by phone {businessphone} during our normal business hours.&nbsp;</span></div> <div style=\"margin: 1em 0px;\"> <strong>Address:</strong> {businessaddress} </div> <div style=\"margin: 1em 0px;\"> You may cancel your appointment 24 hour(s) in advance. We look forward to meeting with you! </div> <div style=\"margin: 1em 0px;\"> <a href=\"{cancelAppLink}\">Click here to cancel this appointment.</a> </div> <div style=\"border-top: 1px solid #dcdcdc;\"></div> <div style=\"margin: 1em 0px;\"> <div style=\"margin: 1em 0px;\">&nbsp;</div><div style=\"margin: 1em 0px;\"><strong>Cancellation Policy</strong> {cancellationpolicy}</div> </div> <div style=\"margin: 1em 0px;\"> For more information, please contact us at <a href=\"mailto:{businessemail}\" target=\"_blank\" rel=\"nofollow\">{businessemail}</a> </div> </div> </div> </div> </div> </div> ','1'),(6,'Appointment Cancellation','This email will be sent to alert a customer if an administrator or member of staff cancels an appointment.','Appointment Canceled',' <div style=\"margin: 0; background-color: #fff; text-align: center; font-size: 14px; line-height: 1.5; color: #333; font-family: Arial; font-weight: normal;\"> <div style=\"padding: 5px; margin: 0 auto; width: auto; text-align: left;\"> <img src=\"http://bookient.com/images/defult_logo.png\" alt=\"bookient-logo\"> </div> <div style=\"padding: 5px; background-color: #f0f0f0; -webkit-text-size-adjust: none; -ms-text-size-adjust: 100%; font-size: 1em;\"> <div style=\"margin: 0 auto; text-align: left; width: auto; background-color: #fff; border-radius: 8px; padding: 12px; border-top: solid 8px #742894; border-bottom: solid 8px #742894; border-left: solid 1px #E3E3E3; border-right: solid 1px #E3E3E3;\"> <div> <div style=\"font-size: 1.4em; white-space: nowrap;\"><strong>{businessname} - Important Appointment Notification</strong></div> <div> <div style=\"margin: 1em 0px;\"><strong>Hello </strong>{fname} {lname}<strong>,</strong></div> <div style=\"margin: 1em 0px;\">Your appointment has been cancelled by our administrator for the following service(s).&nbsp;</div> <div style=\"border-radius:5px; margin: 1em 0px; border: 1px solid #E3E3E3; padding: 10px; background-color: #F6F6F6; white-space: nowrap;\"> {AppointmentInfo} </div> <div style=\"margin: 1em 0px;\"><span style=\"line-height: 1.5;\">If you have any questions, please feel free to contact us by email at <a href=\"mailto:{businessemail}\" target=\"_blank\" rel=\"nofollow\">{businessemail}</a> or by phone {businessphone} during our normal business hours.&nbsp;</span></div> <div style=\"margin: 1em 0px;\"> <strong>Address:</strong> {businessaddress} </div> <div style=\"border-top: 1px solid #dcdcdc;\"></div> <div style=\"margin: 1em 0px;\"> <div style=\"margin: 1em 0px;\">&nbsp;</div><div style=\"margin: 1em 0px;\"><strong>Cancellation Policy</strong> {cancellationpolicy}</div> </div> <div style=\"margin: 1em 0px;\"> For more information, please contact us at <a href=\"mailto:{businessemail}\" target=\"_blank\" rel=\"nofollow\">{businessemail}</a> </div> </div> </div> </div> </div> </div> ','1'),(7,'New user registration by Administrator/Staff ','This email will be sent to new customers added by administrator or a member of staff. This email provides the customer with login details. ','Welcome for new registration',' <div style=\"margin: 0; background-color: #fff; text-align: center; font-size: 14px; line-height: 1.5; color: #333; font-family: Arial; font-weight: normal;\"> <div style=\"padding: 5px; margin: 0 auto; width: auto; text-align: left;\"> <img src=\"http://bookient.com/images/defult_logo.png\" alt=\"bookient-logo\"> </div> <div style=\"padding: 5px; background-color: #f0f0f0; -webkit-text-size-adjust: none; -ms-text-size-adjust: 100%; font-size: 1em;\"> <div style=\"margin: 0 auto; text-align: left; width: auto; background-color: #fff; border-radius: 8px; padding: 12px; border-top: solid 8px #742894; border-bottom: solid 8px #742894; border-left: solid 1px #E3E3E3; border-right: solid 1px #E3E3E3;\"> <div> <div style=\"font-size: 1.4em; white-space: nowrap;\"><strong>Welcome to {businessname}</strong></div> <div> <div style=\"margin: 1em 0px;\"><strong>Hello </strong>{fname} {lname}<strong>,</strong></div> <div style=\"margin: 1em 0px;\"> We invite you to schedule your next appointment with {businessname} using our Online Appointment System. It is very simple and you can select the exact service and date you require. Make your appointments at any time, 24 hours a day. No more waiting on the phone. </div> <div style=\"margin: 1em 0px;\"> <div> To book appointments you will be required to remember the following login details. </div> URL: {businessLink} username: {clientemail} password: <a href=\"{genratePassword}\">Generate your password</a> </div> <div style=\"margin: 1em 0px;\"> We hope you will like this new service and look forward to seeing you soon. </div> <div style=\"margin: 1em 0px;\"> Thank You. </div> <div style=\"margin: 1em 0px;\"> {yourfullname} {businessname} </div> </div> </div> </div> </div> </div> ','1'),(8,'Reminder email alert prior to appointment ','This email will be sent to customers prior to their appointment. Sending an Email alerts prior to appointments helps to reduce customer no-show. ','Appointment Alert',' <div style=\"margin: 0; background-color: #fff; text-align: center; font-size: 14px; line-height: 1.5; color: #333; font-family: Arial; font-weight: normal;\"> <div style=\"padding: 5px; margin: 0 auto; width: auto; text-align: left;\"> <img src=\"http://bookient.com/images/defult_logo.png\" alt=\"bookient-logo\"></div> <div style=\"padding: 5px; background-color: #f0f0f0; -webkit-text-size-adjust: none; -ms-text-size-adjust: 100%; font-size: 1em;\"> <div style=\"margin: 0 auto; text-align: left; width: auto; background-color: #fff; border-radius: 8px; padding: 12px; border-top: solid 8px #742894; border-bottom: solid 8px #742894; border-left: solid 1px #E3E3E3; border-right: solid 1px #E3E3E3;\"> <div> <div style=\"font-size: 1.4em; white-space: nowrap;\"><strong>{businessname} - Appointment Reminder</strong></div> <div> <div style=\"margin: 1em 0px;\"><strong>Hello </strong>{fname} {lname}<strong>,</strong></div> <div style=\"margin: 1em 0px;\"> <div style=\"margin: 1em 0px;\">We hope you are having a pleasant day. We\'re writing to remind you of your appointment with {businessname} on {appointmentdate}.</div> </div> <div style=\"margin: 1em 0px;\"> Thank you for choosing {businessname} online scheduling system and services. We are looking forward to meeting you </div> <div style=\"margin: 1em 0px;\"> <a href=\"{cancelAppLink}\">Click here to cancel this appointment.</a> </div> <div style=\"margin: 1em 0px;\"> If you have any questions, please feel free to contact us by email at <a href=\"mailto:{businessemail}\" target=\"_blank\" rel=\"nofollow\">{businessemail}</a> or by phone {businessphone} during our normal business hours. </div> </div> </div> </div> </div> </div> ','1'),(9,'Thank you email ','This email will be sent to customers after their appointment asking for their feedback. A customer can leave a bad, good or excellent rating with comments. This email is triggered manually. ','Thankyou!',' <div style=\"margin: 0; background-color: #fff; text-align: center; font-size: 14px; line-height: 1.5; color: #333; font-family: Arial; font-weight: normal;\"> <div style=\"padding: 5px; margin: 0 auto; width: auto; text-align: left;\"> <img src=\"http://bookient.com/images/defult_logo.png\" alt=\"bookient-logo\"> </div> <div style=\"padding: 5px; background-color: #f0f0f0; -webkit-text-size-adjust: none; -ms-text-size-adjust: 100%; font-size: 1em;\"> <div style=\"margin: 0 auto; text-align: left; width: auto; background-color: #fff; border-radius: 8px; padding: 12px; border-top: solid 8px #742894; border-bottom: solid 8px #742894; border-left: solid 1px #E3E3E3; border-right: solid 1px #E3E3E3;\"> <div style=\"font-size: 1.4em; white-space: nowrap;\"><strong>{businessname} - Thankyou!</strong></div> <div> <div style=\"margin: 1em 0px;\"> <strong>Dear {fname} {lname},</strong> </div> <div style=\"margin: 1em 0px;\"> Thank you for providing us with an opportunity to serve you. </div> <div style=\"margin: 1em 0px;\"> We would appreciate 2 minutes of your time to rate your experience with Appointment held on {appointmentStartDate}. Click on the link below to rate our service now. </div> <div style=\"margin: 1em 0px;\" p=\"\"> <a href=\"{clickurl}\">Click here</a> </div> <div style=\"margin: 1em 0px;\"> Contact us for more information at: <a href=\"mailto:{businessemail}\" target=\"_blank\" rel=\"nofollow\">{businessemail}</a> </div> <div style=\"margin: 1em 0px;\">Thank you!!</div> </div> </div> </div> </div> ','1'),(10,'Welcome mail for new user','A mail will be send when new user complete his loging details.','Welcome!','<div style=\"margin: 0; background-color: #fff; text-align: center; font-size: 14px; line-height: 1.5; color: #333; font-family: Arial; font-weight: normal;\"> <div style=\"padding: 5px; margin: 0 auto; width: auto; text-align: left;\"> <img src=\"http://bookient.com/images/defult_logo.png\" alt=\"bookient-logo\"> </div> <div style=\"padding: 5px; background-color: #f0f0f0; -webkit-text-size-adjust: none; -ms-text-size-adjust: 100%; font-size: 1em;\"> <div style=\"margin: 0 auto; text-align: left; width: auto; background-color: #fff; border-radius: 8px; padding: 12px; border-top: solid 8px #742894; border-bottom: solid 8px #742894; border-left: solid 1px #E3E3E3; border-right: solid 1px #E3E3E3;\"> <div> <div style=\"font-size: 1.4em; white-space: nowrap;\"><strong>Welcome to {businessname}</strong></div> <div> <div style=\"margin: 1em 0px;\"><strong>Hello </strong>{fname} {lname}<strong>,</strong></div> <div style=\"margin: 1em 0px;\"> We invite you to schedule your next appointment with {businessname} using our Online Appointment System. It is very simple and you can select the exact service and date you require. Make your appointments at any time, 24 hours a day. No more waiting on the phone. </div> <div style=\"margin: 1em 0px;\"> <div> To book appointments you will be required to remember the following login details. </div> URL: {businessLink} username: {clientemail} </div> <div style=\"margin: 1em 0px;\"> We hope you will like this new service and look forward to seeing you soon. </div> <div style=\"margin: 1em 0px;\"> Thank You. </div> <div style=\"margin: 1em 0px;\"> {yourfullname} {businessname} </div> </div> </div> </div> </div> </div>','1'),(11,'Mail for forgot password','A mail will be send when user request his password','Forgot Password','<div style=\"margin: 0; background-color: #fff; text-align: center; font-size: 14px; line-height: 1.5; color: #333; font-family: Arial; font-weight: normal;\">\r\n    <div style=\"padding: 5px; margin: 0 auto; width: auto; text-align: left;\">\r\n        <img src=\"http://bookient.com/images/defult_logo.png\" alt=\"bookient-logo\">\r\n    </div>\r\n    <div style=\"padding: 5px; background-color: #f0f0f0; -webkit-text-size-adjust: none; -ms-text-size-adjust: 100%; font-size: 1em;\">\r\n        <div style=\"margin: 0 auto; text-align: left; width: auto; background-color: #fff; border-radius: 8px; padding: 12px; border-top: solid 8px #742894; border-bottom: solid 8px #742894; border-left: solid 1px #E3E3E3; border-right: solid 1px #E3E3E3;\">\r\n            <div>\r\n                <div>\r\n                    <div style=\"margin: 1em 0px;\"><strong>Hello </strong>{fname} {lname}<strong>,</strong>\r\n                    </div>\r\n                    <div style=\"margin: 1em 0px;\">Your requested current password is :</div>\r\n                    <div style=\"border-radius:5px; margin: 1em 0px; border: 1px solid #E3E3E3; padding: 10px; background-color: #F6F6F6; white-space: nowrap;\">{CurrentPassword}</div>\r\n                </div>\r\n            </div>\r\n        </div>\r\n    </div>\r\n</div>','1'),(12,'Mail for send password','A mail will be send when admin send customers  password','Password','<div style=\"margin: 0; background-color: #fff; text-align: center; font-size: 14px; line-height: 1.5; color: #333; font-family: Arial; font-weight: normal;\">\r\n    <div style=\"padding: 5px; margin: 0 auto; width: auto; text-align: left;\">\r\n        <img src=\"http://bookient.com/images/defult_logo.png\" alt=\"bookient-logo\">\r\n    </div>\r\n    <div style=\"padding: 5px; background-color: #f0f0f0; -webkit-text-size-adjust: none; -ms-text-size-adjust: 100%; font-size: 1em;\">\r\n        <div style=\"margin: 0 auto; text-align: left; width: auto; background-color: #fff; border-radius: 8px; padding: 12px; border-top: solid 8px #742894; border-bottom: solid 8px #742894; border-left: solid 1px #E3E3E3; border-right: solid 1px #E3E3E3;\">\r\n            <div>\r\n                <div>\r\n                    <div style=\"margin: 1em 0px;\"><strong>Hello </strong>{fname} {lname}<strong>,</strong>\r\n                    </div>\r\n                    <div style=\"margin: 1em 0px;\">Your requested current password is :</div>\r\n                    <div style=\"border-radius:5px; margin: 1em 0px; border: 1px solid #E3E3E3; padding: 10px; background-color: #F6F6F6; white-space: nowrap;\">{CurrentPassword}</div>\r\n                </div>\r\n            </div>\r\n        </div>\r\n    </div>\r\n</div>','1');
/*!40000 ALTER TABLE `app_email_msg` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `app_eml_mrktn_templt`
--

DROP TABLE IF EXISTS `app_eml_mrktn_templt`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `app_eml_mrktn_templt` (
  `eml_mrktn_templt_id` int(11) NOT NULL AUTO_INCREMENT,
  `eml_mrktn_templt_cat_id` int(11) NOT NULL,
  `tmplt_name` varchar(255) NOT NULL,
  `tmplt_subject` varchar(50) NOT NULL,
  `tmplt_header_content` text NOT NULL,
  `tmplt_header_bgcolor` varchar(11) NOT NULL,
  `tmplt_body_content` text NOT NULL,
  `tmplt_body_bgcolor` varchar(11) NOT NULL,
  `tmplt_footer_content` text NOT NULL,
  `tmplt_footer_bgcolor` varchar(11) NOT NULL,
  `status` int(2) NOT NULL DEFAULT '1',
  `active` int(2) NOT NULL DEFAULT '1',
  `date_added` date NOT NULL,
  `date_modi` date NOT NULL,
  PRIMARY KEY (`eml_mrktn_templt_id`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `app_eml_mrktn_templt`
--

LOCK TABLES `app_eml_mrktn_templt` WRITE;
/*!40000 ALTER TABLE `app_eml_mrktn_templt` DISABLE KEYS */;
INSERT INTO `app_eml_mrktn_templt` VALUES (12,2,'Salon Thanks','Thanks','<p>\n	<img alt=\"\" height=\"103\" src=\"http://www.polisci.wisc.edu/Uploads/Images/UPTA/thank_you_comment_graphic_01.gif\" width=\"539\" /></p>\n<p>\n	&nbsp;</p>\n','#CAE1F3','<p>\n	&nbsp;There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don&#39;t look even slightly believable. If you are going to use a passage of .</p>\n<p>\n	<strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Lorem Ipsum</strong> is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>\n<p>\n	<strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </strong></p>\n','#EFEFEF','<p>\n	ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi</p>\n','#A97F79',1,1,'0000-00-00','0000-00-00'),(13,2,'Heartly Thanks','','<p>\n	<img alt=\"\" height=\"195\" src=\"http://studiohelper.com/blog/wp-content/uploads/2012/11/Customer-appreciation2.jpg\" width=\"502\" /></p>\n','#1B1B1B','<p>\n	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci vel</p>\n<p>\n	<strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Lorem Ipsum</strong> is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>\n<p>\n	<strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Lorem Ipsum</strong> is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>\n<p>\n	<strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </strong></p>\n','#BOCCF7','<p>\n	ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It</p>\n','#E7E7E7',1,1,'0000-00-00','0000-00-00'),(14,1,'Rich Text','','<p>\n	t is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is</p>\n','#FAFAFA','<p>\n	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p>\n<p>\n	&nbsp;</p>\n<p>\n	&nbsp;</p>\n<p>\n	&nbsp;</p>\n<p>\n	&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; hat it has a more-or-less normal distribution of letters, as opposed to using &#39;Content here, content here&#39;, making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for &#39;lorem ipsum&#39; will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).</p>\n<p>\n	&nbsp;</p>\n<p>\n	<strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Lorem Ipsum</strong> is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>\n<p>\n	<strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Lorem Ipsum</strong> is simply dummy text of the printing and typesetting industry. Lorem</p>\n','#FBD0E4','<p>\n	e. To take a trivial example, which of us ever undertakes laborious physical exercise, except to obtain some advantage from it? But who has any right to find fault with a man who chooses to enjoy a pleasure that has no annoying consequences, or one who avoids a pain that produces no resultant pleasure?&quot;</p>\n','#E2EEEC',1,1,'0000-00-00','0000-00-00'),(15,1,'Haiti','','<p>\n	<img alt=\"\" height=\"219\" src=\"http://repeatingislands.files.wordpress.com/2011/07/haiti11.jpg\" width=\"529\" /></p>\n','#A4EFEA','<p>\n	&nbsp;</p>\n<p>\n	&nbsp;</p>\n<p>\n	&nbsp;</p>\n<p>\n	&nbsp;</p>\n<p>\n	&nbsp;</p>\n<p>\n	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &quot;Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem. Ut enim ad minima veniam, quis nostrum exercitati</p>\n<p>\n	<strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Lorem Ipsum</strong> is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>\n','#F5F6F8','<p>\n	&quot;But I must explain to you how all this mistaken idea of denouncing pleasure and praising pain was born and I will give you a complete account of the system, and expound the actual teachings</p>\n','#F1F1F1',1,1,'0000-00-00','0000-00-00'),(17,3,'Balloon(y) birthday','','<p>\n	<img alt=\"\" height=\"97\" src=\"http://upload.wikimedia.org/wikipedia/commons/d/dd/Birthday_candles.jpg\" width=\"525\" /></p>\n','#EDE9E8','<p>\n	et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga. Et harum quidem rerum facilis est et expedita distinctio. Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil impedit quo minus id quod maxime placeat facere possimus,</p>\n<p>\n	<strong>Lorem Ipsum</strong> is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>\n<p>\n	<strong>Lorem Ipsum</strong> is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>\n<p>\n	<strong>Lorem Ipsum</strong> is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>\n','#FFAC38','<p>\n	the other hand, we denounce with righteous indignation and dislike men who are so beguiled and demoralized by the charms of pleasure of the moment, so blinded by desire, that they cannot foresee the pain and trouble that are bound to ensue; and equal blame belongs to those who fail in their duty through weak</p>\n','#EDE9E8',1,1,'0000-00-00','0000-00-00'),(18,5,'Chirstmas','','<p>\n	<img alt=\"\" height=\"235\" src=\"https://werejumpin.files.wordpress.com/2012/05/2008-12-24_merry-christmas.jpeg\" width=\"512\" /></p>\n','#7DB4DD','<p>\n	extremely painful. Nor again is there anyone who loves or pursues or desires to obtain pain of itself, because it is pain, but because occasionally circumstances occur in which toil and pain can procure him some great pleasure. To take a trivial example, which of us ever undertakes laborious physical exercise, except to obtain some advantage from it? But who has any right to find fault with a man who chooses to enjoy a pleasure</p>\n<p>\n	<strong>Lorem Ipsum</strong> is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>\n<p>\n	<strong>Lorem Ipsum</strong> is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>\n<p>\n	<strong>Lorem Ipsum</strong> is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>\n','#FFFFFF','<p>\n	Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil impedit quo minus id quod maxime placeat facere possimus, omnis voluptas assumenda est, omnis dolor repellendus. Temporibus autem quibusdam et aut officiis debitis aut rerum necessitatibus saepe eveniet ut et voluptates repudiandae</p>\n','#F0F9FD',1,1,'0000-00-00','0000-00-00'),(19,5,'Orangy Chirstmas','','<p>\n	<img alt=\"\" height=\"360\" src=\"http://blog.yah.in/wp-content/uploads/merry%20christmas%202011%20wallpaper.jpg\" width=\"529\" /></p>\n','#245374','<p>\n	onsequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem. Ut enim ad minima veniam</p>\n<p>\n	<strong>Lorem Ipsum</strong> is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>\n<p>\n	<strong>Lorem Ipsum</strong> is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>\n<p>\n	<strong>Lorem Ipsum</strong> is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>\n','#FFFFFF','<p>\n	not know how to pursue pleasure rationally encounter consequences that are extremely painful. Nor again is there anyone who loves or pursues or desires to obtain pain of itself, because it is pain, but because occasionally circumstances occur in which toil and pain can procure him</p>\n','#C1B2CF',1,1,'0000-00-00','0000-00-00'),(20,4,'Marriage Aniversary','','<p>\n	<img alt=\"\" height=\"203\" src=\"http://www.dilsecomments.com/graphics/Anniversary-4440.jpg\" width=\"536\" /></p>\n','#4C4C4C','<p>\n	consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem. Ut enim ad minima veniam,</p>\n<p>\n	<strong>Lorem Ipsum</strong> is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>\n<p>\n	<strong>Lorem Ipsum</strong> is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>\n<p>\n	<strong>Lorem Ipsum</strong> is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>\n','#F5F5F5','<p>\n	is there anyone who loves or pursues or desires to obtain pain of itself, because it is pain, but because occasionally circumstances occur in which toil and pain can procure him some great pleasure. To take a trivial example, which of us ever undertakes laborious physical exercise, ex</p>\n','#9A9A9A',1,1,'0000-00-00','0000-00-00'),(21,6,'Valentine Day','','<p>\n	<img alt=\"\" height=\"350\" src=\"http://naldzgraphics.net/wp-content/uploads/2010/02/44-lovely-valentine-wallpaper.jpg\" width=\"547\" /></p>\n','#F7FFD9','<p>\n	et expedita distinctio. Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil impedit quo minus id quod maxime placeat facere possimus, omnis voluptas assumenda est, omnis dolor repellendus. Temporibus autem quibusdam et aut officiis debitis aut rerum necessitatibus saepe evenie</p>\n<p>\n	&nbsp;</p>\n<p>\n	<strong>Lorem Ipsum</strong> is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>\n<p>\n	<strong>Lorem Ipsum</strong> is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>\n<p>\n	<strong>Lorem Ipsum</strong> is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>\n','#E0F2FF','<p>\n	foresee the pain and trouble that are bound to ensue; and equal blame belongs to those who fail in their duty through weakness of will, which is the same as saying through shrinking from toil and pain. These cases are perfectly simple and easy to distinguish. In a free hour, when our power</p>\n','#66EBFF',1,1,'0000-00-00','0000-00-00'),(22,6,'Valentine Day_2','','<p>\n	<img alt=\"\" height=\"353\" src=\"http://2.bp.blogspot.com/-W6iGLUA-xn8/UBTqXOVGYrI/AAAAAAAACMM/nSD5LfxG-Iw/s1600/Happy+Valentines+Day+Wallpapers+%2841%29.jpg\" width=\"576\" /></p>\n','#2C2E27','<p>\n	those who do not know how to pursue pleasure rationally encounter consequences that are extremely painful. Nor again is there anyone who loves or pursues or desires to obtain pain of itself, because it is pain, but because occasionally circumstances occur in which toil and pain can</p>\n<p>\n	<strong>Lorem Ipsum</strong> is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>\n<p>\n	<strong>Lorem Ipsum</strong> is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>\n<p>\n	<strong>Lorem Ipsum</strong> is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>\n','#CEDFEB','<p>\n	erunt mollitia animi, id est laborum et dolorum fuga. Et harum quidem rerum facilis est et expedita distinctio. Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil impedit quo minus id quod maxime placeat facere possimus, omnis voluptas assumenda est, omnis dolor repellendus. Temporibus autem quibusdam et aut officiis debitis aut rerum necessitatibus saepe eveniet ut et voluptates repudiandae sint et molestiae non recusand</p>\n','#D6CBC7',1,1,'0000-00-00','0000-00-00'),(23,7,'wedding invitations','','<p>\n	<br />\n	<img alt=\"\" height=\"339\" src=\"http://www.magnetstreet.com/stores/html/weddings/images/All-Pocket-Wedding-Invitations_25504.jpg\" width=\"570\" /></p>\n','#FFFFFF','<p>\n	<strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Lorem Ipsum</strong> is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>\n<p>\n	<strong>Lorem Ipsum</strong> is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>\n<p>\n	<strong>Lorem Ipsum</strong> is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>\n','#FFFFFF','<p>\n	<strong>Lorem Ipsum</strong> is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown</p>\n','#FFFFFF',1,1,'0000-00-00','0000-00-00');
/*!40000 ALTER TABLE `app_eml_mrktn_templt` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `app_eml_mrktn_templt_cat`
--

DROP TABLE IF EXISTS `app_eml_mrktn_templt_cat`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `app_eml_mrktn_templt_cat` (
  `eml_mrktn_templt_cat_id` int(11) NOT NULL AUTO_INCREMENT,
  `cat_name` varchar(255) NOT NULL,
  `status` int(2) NOT NULL DEFAULT '1',
  `date_added` date NOT NULL,
  PRIMARY KEY (`eml_mrktn_templt_cat_id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `app_eml_mrktn_templt_cat`
--

LOCK TABLES `app_eml_mrktn_templt_cat` WRITE;
/*!40000 ALTER TABLE `app_eml_mrktn_templt_cat` DISABLE KEYS */;
INSERT INTO `app_eml_mrktn_templt_cat` VALUES (1,'Basic',1,'2012-12-12'),(2,'Thankyou',1,'2012-12-13'),(3,'Birthday',1,'2012-12-12'),(4,'Anniversary',1,'2012-12-12'),(5,'Holidays',1,'0000-00-00'),(6,'Valentine',1,'0000-00-00'),(7,'Invitation',1,'0000-00-00');
/*!40000 ALTER TABLE `app_eml_mrktn_templt_cat` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `app_eml_mrktn_templt_local_admin`
--

DROP TABLE IF EXISTS `app_eml_mrktn_templt_local_admin`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `app_eml_mrktn_templt_local_admin` (
  `eml_mrktn_templt_local_admin_id` int(11) NOT NULL AUTO_INCREMENT,
  `eml_mrktn_templt_id` int(11) NOT NULL,
  `local_admin_id` int(11) NOT NULL,
  `eml_mrktn_templt_cat_id` int(11) NOT NULL,
  `tmplt_name` varchar(255) NOT NULL,
  `tmplt_subject` varchar(50) NOT NULL,
  `tmplt_header_content` text NOT NULL,
  `tmplt_header_bgcolor` varchar(11) NOT NULL,
  `tmplt_body_content` text NOT NULL,
  `tmplt_body_bgcolor` varchar(11) NOT NULL,
  `tmplt_footer_content` text NOT NULL,
  `tmplt_footer_bgcolor` varchar(11) NOT NULL,
  `status` int(2) NOT NULL,
  `active` int(2) NOT NULL,
  `date_added` date NOT NULL,
  `date_modi` date NOT NULL,
  PRIMARY KEY (`eml_mrktn_templt_local_admin_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `app_eml_mrktn_templt_local_admin`
--

LOCK TABLES `app_eml_mrktn_templt_local_admin` WRITE;
/*!40000 ALTER TABLE `app_eml_mrktn_templt_local_admin` DISABLE KEYS */;
/*!40000 ALTER TABLE `app_eml_mrktn_templt_local_admin` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `app_eml_mrktn_templt_local_admin_temp`
--

DROP TABLE IF EXISTS `app_eml_mrktn_templt_local_admin_temp`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `app_eml_mrktn_templt_local_admin_temp` (
  `eml_mrktn_templt_local_admin_id` int(11) NOT NULL,
  `eml_mrktn_templt_id` int(11) NOT NULL,
  `local_admin_id` int(11) NOT NULL,
  `eml_mrktn_templt_cat_id` int(11) NOT NULL,
  `tmplt_name` varchar(255) NOT NULL,
  `tmplt_subject` varchar(50) NOT NULL,
  `tmplt_header_content` text NOT NULL,
  `tmplt_header_bgcolor` varchar(11) NOT NULL,
  `tmplt_body_content` text NOT NULL,
  `tmplt_body_bgcolor` varchar(11) NOT NULL,
  `tmplt_footer_content` text NOT NULL,
  `tmplt_footer_bgcolor` varchar(11) NOT NULL,
  `status` int(2) NOT NULL,
  `active` int(2) NOT NULL,
  `date_added` date NOT NULL,
  `date_modi` date NOT NULL,
  PRIMARY KEY (`eml_mrktn_templt_local_admin_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `app_eml_mrktn_templt_local_admin_temp`
--

LOCK TABLES `app_eml_mrktn_templt_local_admin_temp` WRITE;
/*!40000 ALTER TABLE `app_eml_mrktn_templt_local_admin_temp` DISABLE KEYS */;
/*!40000 ALTER TABLE `app_eml_mrktn_templt_local_admin_temp` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `app_emlmrktn_category`
--

DROP TABLE IF EXISTS `app_emlmrktn_category`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `app_emlmrktn_category` (
  `emlMrktn_cat_id` int(11) NOT NULL AUTO_INCREMENT,
  `emlMrktn_cat_name` varchar(255) NOT NULL,
  `emlMrktn_cat_isdefult` enum('1','0') NOT NULL DEFAULT '0',
  `emlMrktn_cat_status` enum('1','0') NOT NULL DEFAULT '1',
  `emlMrktn_cat_addDate` date DEFAULT NULL,
  `emlMrktn_cat_editDAte` date DEFAULT NULL,
  PRIMARY KEY (`emlMrktn_cat_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `app_emlmrktn_category`
--

LOCK TABLES `app_emlmrktn_category` WRITE;
/*!40000 ALTER TABLE `app_emlmrktn_category` DISABLE KEYS */;
INSERT INTO `app_emlmrktn_category` VALUES (1,'Happy birthday','1','1','2014-04-03','0000-00-00'),(2,'Happy new year','1','1','2014-04-03','0000-00-00'),(3,'Happy anniversary','1','1','2014-04-03','0000-00-00'),(4,'happy thanksgiving','1','1','2014-04-03','0000-00-00'),(5,'Merry christmas','1','1','2014-04-03','0000-00-00');
/*!40000 ALTER TABLE `app_emlmrktn_category` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `app_emlmrktn_relation`
--

DROP TABLE IF EXISTS `app_emlmrktn_relation`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `app_emlmrktn_relation` (
  `app_emlmrktn_rel_id` int(11) NOT NULL AUTO_INCREMENT,
  `app_emlmrktn_rel_cat_id` int(11) NOT NULL,
  `app_emlmrktn_rel_tmp_id` int(11) NOT NULL,
  `app_emlmrktn_rel_localadmin_id` int(11) DEFAULT NULL,
  `app_emlmrktn_rel_adddate` date DEFAULT NULL,
  `app_emlmrktn_rel_editdate` date DEFAULT NULL,
  PRIMARY KEY (`app_emlmrktn_rel_id`),
  KEY `fk_app_emlmrktn_relation_app_emlmrktn_rel_localadmin_id` (`app_emlmrktn_rel_localadmin_id`),
  KEY `fk_app_emlmrktn_relation_app_emlmrktn_rel_cat_id` (`app_emlmrktn_rel_cat_id`),
  KEY `fk_app_emlmrktn_relation_app_emlmrktn_rel_tmp_id` (`app_emlmrktn_rel_tmp_id`),
  CONSTRAINT `fk_app_emlmrktn_relation_app_emlmrktn_rel_cat_id` FOREIGN KEY (`app_emlmrktn_rel_cat_id`) REFERENCES `app_emlmrktn_category` (`emlMrktn_cat_id`),
  CONSTRAINT `fk_app_emlmrktn_relation_app_emlmrktn_rel_localadmin_id` FOREIGN KEY (`app_emlmrktn_rel_localadmin_id`) REFERENCES `app_password_manager` (`user_id`) ON DELETE CASCADE,
  CONSTRAINT `fk_app_emlmrktn_relation_app_emlmrktn_rel_tmp_id` FOREIGN KEY (`app_emlmrktn_rel_tmp_id`) REFERENCES `app_emlmrktn_template` (`app_emlmrktn_tem_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `app_emlmrktn_relation`
--

LOCK TABLES `app_emlmrktn_relation` WRITE;
/*!40000 ALTER TABLE `app_emlmrktn_relation` DISABLE KEYS */;
/*!40000 ALTER TABLE `app_emlmrktn_relation` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `app_emlmrktn_setting`
--

DROP TABLE IF EXISTS `app_emlmrktn_setting`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `app_emlmrktn_setting` (
  `emlmrktn_setting_id` int(11) NOT NULL AUTO_INCREMENT,
  `emlmrktn_cat_id` int(11) NOT NULL,
  `app_emlmrktn_tem_id` int(11) NOT NULL,
  `emlmrktn_localadmin` int(11) NOT NULL,
  `customertype_id` int(11) NOT NULL,
  `customer_ids` text NOT NULL,
  `date_added` date NOT NULL,
  `date_edited` date NOT NULL,
  PRIMARY KEY (`emlmrktn_setting_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `app_emlmrktn_setting`
--

LOCK TABLES `app_emlmrktn_setting` WRITE;
/*!40000 ALTER TABLE `app_emlmrktn_setting` DISABLE KEYS */;
/*!40000 ALTER TABLE `app_emlmrktn_setting` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `app_emlmrktn_template`
--

DROP TABLE IF EXISTS `app_emlmrktn_template`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `app_emlmrktn_template` (
  `app_emlmrktn_tem_id` int(11) NOT NULL AUTO_INCREMENT,
  `app_emlmrktn_tem_subject` varchar(255) NOT NULL,
  `app_emlmrktn_tem_content` text NOT NULL,
  `app_emlmrktn_tem_status` enum('1','0') NOT NULL DEFAULT '1',
  `app_emlmrktn_tem_adddate` date DEFAULT NULL,
  `app_emlmrktn_tem_editdate` date DEFAULT NULL,
  PRIMARY KEY (`app_emlmrktn_tem_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `app_emlmrktn_template`
--

LOCK TABLES `app_emlmrktn_template` WRITE;
/*!40000 ALTER TABLE `app_emlmrktn_template` DISABLE KEYS */;
INSERT INTO `app_emlmrktn_template` VALUES (1,'Basic email template','<!DOCTYPE HTML PUBLIC \"-//W3C//DTD HTML 4.0 Transitional//EN\">\r\n<html>\r\n<head>\r\n<title>Basic email content.</title>\r\n<meta name=\"\" content=\"\">\r\n</head>\r\n<body>\r\n<div style=\"margin: 0; background-color:#f0f0f0; text-align: center; font-size: 14px; line-height: 1.5; color: #333; font-family: Arial; font-weight: normal;\">\r\n    <div style=\"padding: 5px; margin: 0px 15px; width: auto; text-align: left;\">\r\n        <img height=\"50px\"  src=\"http://bookient.com/images/defult_logo.png\" alt=\"bookient-logo\">\r\n       <span style=\"padding: 5px; font-size: 26px; font-weight: bold; margin: 0 auto; width: auto; text-align: left;\">Your heading!</span>\r\n    </div>\r\n	<div style=\"padding: 5px; background-color: #f0f0f0; -webkit-text-size-adjust: none; -ms-text-size-adjust: 100%; font-size: 1em;\">\r\n		<div style=\"margin: 0 auto; text-align: left; width: auto; background-color: #fff; border-radius: 8px; padding: 12px; border-top: solid 8px #742894; border-bottom: solid 8px #742894; border-left: solid 1px #E3E3E3; border-right: solid 1px #E3E3E3;\">\r\n		<div style=\"border-radius:5px; margin: 1em 0px; border: 1px solid #E3E3E3; padding: 10px; background-color: #97C12F; white-space: nowrap;\">\r\n		<!--img height=\"220px\" width=\"100%\"  src=\"http://bookient.com/asset/basic_banner.jpg\" alt=\"bookient-logo\"-->\r\n		</div>\r\n\r\n		<div style=\"border-radius:5px; margin: 1em 0px; border: 1px solid #E3E3E3; padding: 10px; background-color: #F6F6F6;\">\r\n			<p>This is the default template to help you get started with our email marketing tool.</p>\r\n\r\n<p>You are free to change anything within this template to match the needs of the email you want to send out.</p>\r\n<p>After you have modified the template, save it for future use and start using it!</p>\r\n<p>If you are looking for more specific template with some preset content, please check out our templates under each default category.</p>\r\n		</div>\r\n		\r\n		<div style=\"border-radius:5px; margin: 1em 0px; border: 1px solid #E3E3E3; padding: 10px; background-color: #97C12F; line-height: 2em; height: 2em;\">\r\n		<div style=\"float: left;\"><a href=\"http://www.bookient.com\" target=\"_blank\">http://www.bookient.com</a></div>\r\n		<div style=\"float: right;\">\r\n			<img src=\"http://bookient.com/asset/front_image/facebook.png\" alt=\"\">\r\n			<img src=\"http://bookient.com/asset/front_image/youtubesmall.png\" alt=\"\">\r\n			<img src=\"http://bookient.com/asset/front_image/google.png\" alt=\"\">\r\n			<img src=\"http://bookient.com/asset/front_image/twittersmall.png\" alt=\"\">\r\n			<img src=\"http://bookient.com/asset/front_image/linkedinbluesmall.png\" alt=\"\">\r\n		</div>\r\n		</div>\r\n		</div>\r\n	</div>\r\n</div>\r\n</body>\r\n</html>','1','2014-04-03','0000-00-00'),(2,'Happy birthday','<!DOCTYPE HTML PUBLIC \"-//W3C//DTD HTML 4.0 Transitional//EN\">\r\n<html>\r\n<head>\r\n<title>Happy birthday.</title>\r\n<meta name=\"\" content=\"\">\r\n</head>\r\n<body>\r\n<div style=\"margin: 0; background-color:#f0f0f0; text-align: center; font-size: 14px; line-height: 1.5; color: #333; font-family: Arial; font-weight: normal;\">\r\n    <div style=\"padding: 5px; margin: 0px 15px; width: auto; text-align: left;\">\r\n        <img height=\"50px\"  src=\"http://bookient.com/images/defult_logo.png\" alt=\"bookient-logo\">\r\n       <span style=\"padding: 5px; font-size: 26px; font-weight: bold; margin: 0 auto; width: auto; text-align: left;\">Happy birthday!</span>\r\n    </div>\r\n	<div style=\"padding: 5px; background-color: #f0f0f0; -webkit-text-size-adjust: none; -ms-text-size-adjust: 100%; font-size: 1em;\">\r\n		<div style=\"margin: 0 auto; text-align: left; width: auto; background-color: #fff; border-radius: 8px; padding: 12px; border-top: solid 8px #742894; border-bottom: solid 8px #742894; border-left: solid 1px #E3E3E3; border-right: solid 1px #E3E3E3;\">\r\n		<div style=\"border-radius:5px; margin: 1em 0px; border: 1px solid #E3E3E3; padding: 10px; background-color: #9933FF; white-space: nowrap;\">\r\n		<!--img height=\"220px\" width=\"100%\"  src=\"http://bookient.com/asset/birthday-banner.png\" alt=\"birthday-banner\"-->\r\n		</div>\r\n\r\n		<div style=\"border-radius:5px; margin: 1em 0px; border: 1px solid #E3E3E3; padding: 10px; background-color: #F6F6F6;\">\r\n			<p>We wanted to contact you to wish you happy birthday!.</p>\r\n<p>Hopefully you have enjoyed the services and continue to do so in the future.</p>\r\n<p>Your birthday only comes around once a year, so let\'s make today a day to remember.</p>\r\n		</div>\r\n		\r\n		<div style=\"border-radius:5px; margin: 1em 0px; border: 1px solid #E3E3E3; padding: 10px; background-color: #9933FF; line-height: 2em; height: 2em;\">\r\n		<div style=\"float: left;\"><a href=\"http://www.bookient.com\" target=\"_blank\">http://www.bookient.com</a></div>\r\n		<div style=\"float: right;\">\r\n			<img src=\"http://bookient.com/asset/front_image/facebook.png\" alt=\"\">\r\n			<img src=\"http://bookient.com/asset/front_image/youtubesmall.png\" alt=\"\">\r\n			<img src=\"http://bookient.com/asset/front_image/google.png\" alt=\"\">\r\n			<img src=\"http://bookient.com/asset/front_image/twittersmall.png\" alt=\"\">\r\n			<img src=\"http://bookient.com/asset/front_image/linkedinbluesmall.png\" alt=\"\">\r\n		</div>\r\n		</div>\r\n		</div>\r\n	</div>\r\n</div>\r\n</body>\r\n</html>','1','2014-04-03','0000-00-00'),(3,'Happy new year','<!DOCTYPE HTML PUBLIC \"-//W3C//DTD HTML 4.0 Transitional//EN\">\r\n<html>\r\n<head>\r\n<title>Happy new year!</title>\r\n<meta name=\"\" content=\"\">\r\n</head>\r\n<body>\r\n<div style=\"margin: 0; background-color:#f0f0f0; text-align: center; font-size: 14px; line-height: 1.5; color: #333; font-family: Arial; font-weight: normal;\">\r\n    <div style=\"padding: 5px; margin: 0px 15px; width: auto; text-align: left;\">\r\n        <img height=\"50px\"  src=\"http://bookient.com/images/defult_logo.png\" alt=\"bookient-logo\">\r\n       <span style=\"padding: 5px; font-size: 26px; font-weight: bold; margin: 0 auto; width: auto; text-align: left;\">Happy new year!</span>\r\n    </div>\r\n	<div style=\"padding: 5px; background-color: #f0f0f0; -webkit-text-size-adjust: none; -ms-text-size-adjust: 100%; font-size: 1em;\">\r\n		<div style=\"margin: 0 auto; text-align: left; width: auto; background-color: #fff; border-radius: 8px; padding: 12px; border-top: solid 8px #742894; border-bottom: solid 8px #742894; border-left: solid 1px #E3E3E3; border-right: solid 1px #E3E3E3;\">\r\n		<div style=\"border-radius:5px; margin: 1em 0px; border: 1px solid #E3E3E3; padding: 10px; background-color:#EDDA74; white-space: nowrap;\">\r\n		<!--img height=\"220px\" width=\"100%\"  src=\"http://bookient.com/asset/happy-new-year-banner.jpg\" alt=\"new-year-banner\"-->\r\n		</div>\r\n\r\n		<div style=\"border-radius:5px; margin: 1em 0px; border: 1px solid #E3E3E3; padding: 10px; background-color: #F6F6F6;\">\r\n			<p>Thank you for using our services! We hope that you have enjoyed our services and continue to do so during next year also.</p>\r\n<p>We are delighted to have you as a customer, and we look forward to serving you in the new year.</p>\r\n		</div>\r\n		\r\n		<div style=\"border-radius:5px; margin: 1em 0px; border: 1px solid #E3E3E3; padding: 10px; background-color:#EDDA74; line-height: 2em; height: 2em;\">\r\n		<div style=\"float: left;\"><a href=\"http://www.bookient.com\" target=\"_blank\">http://www.bookient.com</a></div>\r\n		<div style=\"float: right;\">\r\n			<img src=\"http://bookient.com/asset/front_image/facebook.png\" alt=\"\">\r\n			<img src=\"http://bookient.com/asset/front_image/youtubesmall.png\" alt=\"\">\r\n			<img src=\"http://bookient.com/asset/front_image/google.png\" alt=\"\">\r\n			<img src=\"http://bookient.com/asset/front_image/twittersmall.png\" alt=\"\">\r\n			<img src=\"http://bookient.com/asset/front_image/linkedinbluesmall.png\" alt=\"\">\r\n		</div>\r\n		</div>\r\n		</div>\r\n	</div>\r\n</div>\r\n</body>\r\n</html>','1','2014-04-03','0000-00-00'),(4,'Happy anniversary','<!DOCTYPE HTML PUBLIC \"-//W3C//DTD HTML 4.0 Transitional//EN\">\r\n<html>\r\n<head>\r\n<title>Happy anniversary</title>\r\n<meta name=\"\" content=\"\">\r\n</head>\r\n<body>\r\n<div style=\"margin: 0; background-color:#f0f0f0; text-align: center; font-size: 14px; line-height: 1.5; color: #333; font-family: Arial; font-weight: normal;\">\r\n    <div style=\"padding: 5px; margin: 0px 15px; width: auto; text-align: left;\">\r\n        <img height=\"50px\"  src=\"http://bookient.com/images/defult_logo.png\" alt=\"bookient-logo\">\r\n       <span style=\"padding: 5px; font-size: 26px; font-weight: bold; margin: 0 auto; width: auto; text-align: left;\">Happy anniversary</span>\r\n    </div>\r\n	<div style=\"padding: 5px; background-color: #f0f0f0; -webkit-text-size-adjust: none; -ms-text-size-adjust: 100%; font-size: 1em;\">\r\n		<div style=\"margin: 0 auto; text-align: left; width: auto; background-color: #fff; border-radius: 8px; padding: 12px; border-top: solid 8px #742894; border-bottom: solid 8px #742894; border-left: solid 1px #E3E3E3; border-right: solid 1px #E3E3E3;\">\r\n		<div style=\"border-radius:5px; margin: 1em 0px; border: 1px solid #E3E3E3; padding: 10px; background-color: #E27C7D; white-space: nowrap;\">\r\n		<!--img height=\"220px\" width=\"100%\"  src=\"http://bookient.com/asset/anniversary.jpg\" alt=\"anniversary-banner\"-->\r\n		</div>\r\n\r\n		<div style=\"border-radius:5px; margin: 1em 0px; border: 1px solid #E3E3E3; padding: 10px; background-color: #F6F6F6;\">\r\n			<p>We have now served our customers for another year and we wanted to thank our customers for making our work possible</p>\r\n<p>We would not be standing here, one year older, if it wasn\'t for you, valued customer.</p>\r\n<p>We hope you have enjoyed our services and continue to do so in the future.</p>\r\n		</div>\r\n		\r\n		<div style=\"border-radius:5px; margin: 1em 0px; border: 1px solid #E3E3E3; padding: 10px; background-color:#E27C7D; line-height: 2em; height: 2em;\">\r\n		<div style=\"float: left;\"><a href=\"http://www.bookient.com\" target=\"_blank\">http://www.bookient.com</a></div>\r\n		<div style=\"float: right;\">\r\n			<img src=\"http://bookient.com/asset/front_image/facebook.png\" alt=\"\">\r\n			<img src=\"http://bookient.com/asset/front_image/youtubesmall.png\" alt=\"\">\r\n			<img src=\"http://bookient.com/asset/front_image/google.png\" alt=\"\">\r\n			<img src=\"http://bookient.com/asset/front_image/twittersmall.png\" alt=\"\">\r\n			<img src=\"http://bookient.com/asset/front_image/linkedinbluesmall.png\" alt=\"\">\r\n		</div>\r\n		</div>\r\n		</div>\r\n	</div>\r\n</div>\r\n</body>\r\n</html>','1','2014-04-03','0000-00-00'),(5,'Happy thanksgiving','<!DOCTYPE HTML PUBLIC \"-//W3C//DTD HTML 4.0 Transitional//EN\">\r\n<html>\r\n<head>\r\n<title>Happy thanksgiving.</title>\r\n<meta name=\"\" content=\"\">\r\n</head>\r\n<body>\r\n<div style=\"margin: 0; background-color:#f0f0f0; text-align: center; font-size: 14px; line-height: 1.5; color: #333; font-family: Arial; font-weight: normal;\">\r\n    <div style=\"padding: 5px; margin: 0px 15px; width: auto; text-align: left;\">\r\n        <img height=\"50px\"  src=\"http://bookient.com/images/defult_logo.png\" alt=\"bookient-logo\">\r\n       <span style=\"padding: 5px; font-size: 26px; font-weight: bold; margin: 0 auto; width: auto; text-align: left;\">Happy thanksgiving!</span>\r\n    </div>\r\n	<div style=\"padding: 5px; background-color: #f0f0f0; -webkit-text-size-adjust: none; -ms-text-size-adjust: 100%; font-size: 1em;\">\r\n		<div style=\"margin: 0 auto; text-align: left; width: auto; background-color: #fff; border-radius: 8px; padding: 12px; border-top: solid 8px #742894; border-bottom: solid 8px #742894; border-left: solid 1px #E3E3E3; border-right: solid 1px #E3E3E3;\">\r\n		<div style=\"border-radius:5px; margin: 1em 0px; border: 1px solid #E3E3E3; padding: 10px; background-color:#FF7519; white-space: nowrap;\">\r\n		<!--img height=\"220px\" width=\"100%\"  src=\"http://bookient.com/asset/thnaks.jpg\" alt=\"thanksgiving-banner\"-->\r\n		</div>\r\n\r\n		<div style=\"border-radius:5px; margin: 1em 0px; border: 1px solid #E3E3E3; padding: 10px; background-color: #F6F6F6;\">\r\n			<p>In this time of gratitude, we give thanks for you. We value your patronage and appreciate your confidence in us. Counting you among our customers is something for which we are especially grateful.</p>\r\n\r\n<p>On behalf of all of us, I wish you a very happy Thanksgiving.</p>\r\n		</div>\r\n		\r\n		<div style=\"border-radius:5px; margin: 1em 0px; border: 1px solid #E3E3E3; padding: 10px; background-color:#FF7519; line-height: 2em; height: 2em;\">\r\n		<div style=\"float: left;\"><a href=\"http://www.bookient.com\" target=\"_blank\">http://www.bookient.com</a></div>\r\n		<div style=\"float: right;\">\r\n			<img src=\"http://bookient.com/asset/front_image/facebook.png\" alt=\"\">\r\n			<img src=\"http://bookient.com/asset/front_image/youtubesmall.png\" alt=\"\">\r\n			<img src=\"http://bookient.com/asset/front_image/google.png\" alt=\"\">\r\n			<img src=\"http://bookient.com/asset/front_image/twittersmall.png\" alt=\"\">\r\n			<img src=\"http://bookient.com/asset/front_image/linkedinbluesmall.png\" alt=\"\">\r\n		</div>\r\n		</div>\r\n		</div>\r\n	</div>\r\n</div>\r\n</body>\r\n</html>','1','2014-04-03','0000-00-00'),(6,'Merry christmas','<!DOCTYPE HTML PUBLIC \"-//W3C//DTD HTML 4.0 Transitional//EN\">\r\n<html>\r\n<head>\r\n<title>Basic email content</title>\r\n<meta name=\"\" content=\"\">\r\n</head>\r\n<body>\r\n<div style=\"margin: 0; background-color:#f0f0f0; text-align: center; font-size: 14px; line-height: 1.5; color: #333; font-family: Arial; font-weight: normal;\">\r\n    <div style=\"padding: 5px; margin: 0px 15px; width: auto; text-align: left;\">\r\n        <img height=\"50px\"  src=\"http://bookient.com/images/defult_logo.png\" alt=\"bookient-logo\">\r\n       <span style=\"padding: 5px; font-size: 26px; font-weight: bold; margin: 0 auto; width: auto; text-align: left;\">Merry christmas!</span>\r\n    </div>\r\n	<div style=\"padding: 5px; background-color: #f0f0f0; -webkit-text-size-adjust: none; -ms-text-size-adjust: 100%; font-size: 1em;\">\r\n		<div style=\"margin: 0 auto; text-align: left; width: auto; background-color: #fff; border-radius: 8px; padding: 12px; border-top: solid 8px #742894; border-bottom: solid 8px #742894; border-left: solid 1px #E3E3E3; border-right: solid 1px #E3E3E3;\">\r\n		<div style=\"border-radius:5px; margin: 1em 0px; border: 1px solid #E3E3E3; padding: 10px; background-color:#D11111; white-space: nowrap;\">\r\n		<!--img height=\"220px\" width=\"100%\"  src=\"http://bookient.com/asset/Merry-Christmas.jpg\" alt=\"christmas-banner\"-->\r\n		</div>\r\n\r\n		<div style=\"border-radius:5px; margin: 1em 0px; border: 1px solid #E3E3E3; padding: 10px; background-color: #F6F6F6;\">\r\n			<p>We want to wish you a merry christmas!</p>\r\n			<p>Holidays are busy time but we wanted to take a moment to thank our valued customer.</p>\r\n		</div>\r\n		\r\n		<div style=\"border-radius:5px; margin: 1em 0px; border: 1px solid #E3E3E3; padding: 10px; background-color:#D11111; line-height: 2em; height: 2em;\">\r\n		<div style=\"float: left;\"><a href=\"http://www.bookient.com\" target=\"_blank\">http://www.bookient.com</a></div>\r\n		<div style=\"float: right;\">\r\n			<img src=\"http://bookient.com/asset/front_image/facebook.png\" alt=\"\">\r\n			<img src=\"http://bookient.com/asset/front_image/youtubesmall.png\" alt=\"\">\r\n			<img src=\"http://bookient.com/asset/front_image/google.png\" alt=\"\">\r\n			<img src=\"http://bookient.com/asset/front_image/twittersmall.png\" alt=\"\">\r\n			<img src=\"http://bookient.com/asset/front_image/linkedinbluesmall.png\" alt=\"\">\r\n		</div>\r\n		</div>\r\n		</div>\r\n	</div>\r\n</div>\r\n</body>\r\n</html>','1','2014-04-03','0000-00-00');
/*!40000 ALTER TABLE `app_emlmrktn_template` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `app_employee`
--

DROP TABLE IF EXISTS `app_employee`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `app_employee` (
  `employee_id` int(11) NOT NULL,
  `local_admin_id` int(11) NOT NULL,
  `employee_image` varchar(255) CHARACTER SET latin1 NOT NULL,
  `employee_image_original` varchar(255) CHARACTER SET latin1 NOT NULL,
  `employee_name` varchar(255) CHARACTER SET latin1 NOT NULL,
  `employee_mobile_no` varchar(30) CHARACTER SET latin1 NOT NULL,
  `employee_languages` text CHARACTER SET latin1 NOT NULL,
  `employee_description` text CHARACTER SET latin1 NOT NULL,
  `employee_education` text CHARACTER SET latin1 NOT NULL,
  `employee_membership` text CHARACTER SET latin1 NOT NULL,
  `employee_awards` text CHARACTER SET latin1 NOT NULL,
  `employee_publications` text CHARACTER SET latin1 NOT NULL,
  `is_active` enum('Y','N') CHARACTER SET latin1 NOT NULL DEFAULT 'Y',
  `date_added` date NOT NULL,
  `date_edited` date NOT NULL,
  PRIMARY KEY (`employee_id`),
  KEY `local_admin_id` (`local_admin_id`),
  CONSTRAINT `app_employee_ibfk_1` FOREIGN KEY (`local_admin_id`) REFERENCES `app_local_admin` (`local_admin_id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `app_employee`
--

LOCK TABLES `app_employee` WRITE;
/*!40000 ALTER TABLE `app_employee` DISABLE KEYS */;
/*!40000 ALTER TABLE `app_employee` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `app_faq`
--

DROP TABLE IF EXISTS `app_faq`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `app_faq` (
  `faq_id` int(11) NOT NULL AUTO_INCREMENT,
  `faq_question` text NOT NULL,
  `faq_answer` longtext NOT NULL,
  `is_active` enum('Y','N') NOT NULL DEFAULT 'Y',
  `date_added` date NOT NULL,
  `date_edited` date NOT NULL,
  `faq_order` int(11) NOT NULL,
  PRIMARY KEY (`faq_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `app_faq`
--

LOCK TABLES `app_faq` WRITE;
/*!40000 ALTER TABLE `app_faq` DISABLE KEYS */;
INSERT INTO `app_faq` VALUES (1,'What is bookient','<p>\n	Bookient is our show of love towards you</p>','Y','2014-08-01','0000-00-00',1);
/*!40000 ALTER TABLE `app_faq` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `app_languages`
--

DROP TABLE IF EXISTS `app_languages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `app_languages` (
  `languages_id` int(11) NOT NULL AUTO_INCREMENT,
  `languages_name` varchar(255) NOT NULL,
  `language_flag` varchar(255) NOT NULL,
  `image` varchar(60) NOT NULL,
  `languages_order` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  PRIMARY KEY (`languages_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `app_languages`
--

LOCK TABLES `app_languages` WRITE;
/*!40000 ALTER TABLE `app_languages` DISABLE KEYS */;
INSERT INTO `app_languages` VALUES (1,'English','English','England.png',1,1),(2,'Finnish','Finnish','images.jpg',2,1);
/*!40000 ALTER TABLE `app_languages` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `app_local_admin`
--

DROP TABLE IF EXISTS `app_local_admin`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `app_local_admin` (
  `local_admin_id` int(11) NOT NULL,
  `currency_id` int(11) NOT NULL DEFAULT '1',
  `currency_format_id` int(11) NOT NULL DEFAULT '1',
  `profession_id` int(11) NOT NULL,
  `time_zone_id` int(11) NOT NULL DEFAULT '145',
  `time_format_id` int(11) NOT NULL DEFAULT '1',
  `date_format_id` int(11) NOT NULL DEFAULT '1',
  `country_id` bigint(20) NOT NULL,
  `region_id` bigint(20) NOT NULL DEFAULT '1',
  `city_id` bigint(20) NOT NULL DEFAULT '1',
  `first_name` varchar(100) CHARACTER SET latin1 NOT NULL,
  `last_name` varchar(200) CHARACTER SET latin1 NOT NULL,
  `home_phone` varchar(50) CHARACTER SET latin1 NOT NULL,
  `work_phone` varchar(50) CHARACTER SET latin1 NOT NULL,
  `mobile_phone` varchar(50) CHARACTER SET latin1 NOT NULL,
  `business_logo` varchar(255) CHARACTER SET latin1 NOT NULL,
  `business_name` varchar(200) CHARACTER SET latin1 NOT NULL,
  `business_description` text CHARACTER SET latin1 NOT NULL,
  `page_title` varchar(200) CHARACTER SET latin1 NOT NULL,
  `business_tag` text CHARACTER SET latin1 NOT NULL,
  `business_location` varchar(255) CHARACTER SET latin1 NOT NULL,
  `business_city_id` int(11) NOT NULL,
  `business_state_id` int(11) NOT NULL,
  `business_zip_code` varchar(30) CHARACTER SET latin1 NOT NULL,
  `business_phone` varchar(50) CHARACTER SET latin1 NOT NULL,
  `latitude` varchar(15) CHARACTER SET latin1 NOT NULL,
  `longitude` varchar(15) CHARACTER SET latin1 NOT NULL,
  `facebook_link` varchar(255) CHARACTER SET latin1 NOT NULL,
  `youtube_link` varchar(255) CHARACTER SET latin1 NOT NULL,
  `google_link` varchar(255) CHARACTER SET latin1 NOT NULL,
  `twitter_link` varchar(255) CHARACTER SET latin1 NOT NULL,
  `linkedin_link` varchar(255) CHARACTER SET latin1 NOT NULL,
  `is_active` enum('Y','N') CHARACTER SET latin1 NOT NULL DEFAULT 'Y',
  `is_email_verified` int(2) NOT NULL DEFAULT '0',
  `date_added` date NOT NULL,
  `date_edited` date NOT NULL,
  PRIMARY KEY (`local_admin_id`),
  KEY `profession_id` (`profession_id`),
  KEY `currency_id` (`currency_id`),
  KEY `currency_format_id` (`currency_format_id`),
  KEY `time_format_id` (`time_format_id`),
  KEY `date_format_id` (`date_format_id`),
  KEY `region_id` (`region_id`),
  KEY `country_id` (`country_id`),
  KEY `city_id` (`city_id`),
  KEY `time_zone_id` (`time_zone_id`),
  CONSTRAINT `app_local_admin_ibfk_1` FOREIGN KEY (`profession_id`) REFERENCES `app_profession` (`profession_id`) ON DELETE CASCADE,
  CONSTRAINT `app_local_admin_ibfk_2` FOREIGN KEY (`currency_id`) REFERENCES `app_currency` (`currency_id`) ON DELETE CASCADE,
  CONSTRAINT `app_local_admin_ibfk_3` FOREIGN KEY (`currency_format_id`) REFERENCES `app_currency_format` (`currency_format_id`) ON DELETE CASCADE,
  CONSTRAINT `app_local_admin_ibfk_4` FOREIGN KEY (`time_format_id`) REFERENCES `app_time_format` (`time_format_id`) ON DELETE CASCADE,
  CONSTRAINT `app_local_admin_ibfk_5` FOREIGN KEY (`date_format_id`) REFERENCES `app_date_format` (`date_format_id`) ON DELETE CASCADE,
  CONSTRAINT `app_local_admin_ibfk_6` FOREIGN KEY (`region_id`) REFERENCES `app_regions` (`region_id`) ON DELETE CASCADE,
  CONSTRAINT `app_local_admin_ibfk_7` FOREIGN KEY (`country_id`) REFERENCES `app_countries` (`country_id`) ON DELETE CASCADE,
  CONSTRAINT `app_local_admin_ibfk_8` FOREIGN KEY (`city_id`) REFERENCES `app_cities` (`city_id`) ON DELETE CASCADE,
  CONSTRAINT `app_local_admin_ibfk_9` FOREIGN KEY (`time_zone_id`) REFERENCES `app_time_zone` (`time_zone_id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `app_local_admin`
--

LOCK TABLES `app_local_admin` WRITE;
/*!40000 ALTER TABLE `app_local_admin` DISABLE KEYS */;
/*!40000 ALTER TABLE `app_local_admin` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `app_local_admin_gen_setting`
--

DROP TABLE IF EXISTS `app_local_admin_gen_setting`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `app_local_admin_gen_setting` (
  `local_admin_gen_setting_id` int(11) NOT NULL AUTO_INCREMENT,
  `local_admin_id` int(11) NOT NULL,
  `service_alias_name` varchar(255) NOT NULL,
  `servicesalias_order_id` int(11) NOT NULL,
  `staff_alias_name` varchar(255) NOT NULL,
  `enable_system` int(1) NOT NULL DEFAULT '1' COMMENT '1-> Yes; 0-> No',
  `aprvl_rqrd_pre_payin_mem` int(1) NOT NULL DEFAULT '1' COMMENT '1-> Yes; 0-> No',
  `aprvl_rqrd_mob_verfd_mem` int(1) NOT NULL DEFAULT '1' COMMENT '1-> Yes; 0-> No',
  `aprvl_rqrd_mob_non_verfd_mem` varchar(1) NOT NULL DEFAULT '1' COMMENT '1-> Yes; 0-> No',
  `no_of_booking` varchar(5) NOT NULL DEFAULT '0' COMMENT '0 = no restriction; other integer -> restriction quantity',
  `no_of_booking_period` int(5) NOT NULL DEFAULT '1' COMMENT '1 = unlimited; 2-> not allowed; 3->daily; 4->weekly; 5->monthly; 6->yearly;  7-> fixed date',
  `booking_starting_point` varchar(20) NOT NULL COMMENT 'it store starting point of a booking restriction setting, for example for week, it will store the week start day, for monthly it will store the date, for year it will store the montrh name etc',
  `no_of_booking_period_from` date NOT NULL,
  `no_of_booking_period_to` date NOT NULL,
  `recurring_appointments` int(1) NOT NULL DEFAULT '1' COMMENT '1-> Yes; 0-> No',
  `recurring_admin` int(1) NOT NULL COMMENT '1-> Yes; 0-> No',
  `quantity_appointment_setting` int(1) NOT NULL DEFAULT '1' COMMENT '1-> Yes; 0-> No',
  `quantity_appointment` varchar(100) NOT NULL DEFAULT '1' COMMENT 'Quantity of appointment per booking',
  `allow_international_users` int(1) NOT NULL DEFAULT '1' COMMENT '1-> Yes; 0-> No',
  `show_service_cost` int(1) DEFAULT NULL,
  `show_service_time_duration` int(1) DEFAULT NULL,
  `clients_name_with_reviews` int(1) DEFAULT NULL,
  `detect_client_timezone` int(1) NOT NULL DEFAULT '1' COMMENT '1-> Yes; 0-> No',
  `booked_times_striked` int(1) NOT NULL DEFAULT '1' COMMENT '1-> Yes; 0-> No',
  `blocked_times_striked_out` int(1) NOT NULL DEFAULT '1' COMMENT '1-> Yes; 0-> No',
  `default_view` int(4) NOT NULL DEFAULT '1' COMMENT '0->Cal Week; 1-> Cal Month; 2-> Aboutus/Review',
  `cal_strting_weekday` int(1) NOT NULL DEFAULT '1' COMMENT '1->day of current date; 2-> Sunday; 3->Monday',
  `cal_strting_dt` date NOT NULL,
  `show_staff_customers` int(1) NOT NULL DEFAULT '1' COMMENT '1-> Yes; 0-> No',
  `staff_selection_mandatory` int(1) NOT NULL DEFAULT '1' COMMENT '1-> Yes; 0-> No',
  `staff_order` int(10) NOT NULL DEFAULT '1' COMMENT '1=>Most free staff (Timewise);2=>Most free staff (Appointmentwise);3=>Most busy staff (Timewise);4=>Most busy staff (Appointmentwise);5=>Order in which staff are displayed;',
  `clint_signup_info_sriliz_arry` text NOT NULL COMMENT 'This field will carry the serialize array from the table app_local_admin_gen_setting_clint_signup_info for particular local admin ',
  `languages` text NOT NULL COMMENT 'This field will carry the serialize array of enabled languages from table app_local_admin_gen_setting_languages   for particular local admin ',
  `default_language_id` int(5) NOT NULL DEFAULT '1',
  `login_typ_del` text NOT NULL COMMENT 'This field will carry the serialize array of enabled login_typ from table app_local_admin_gen_setting_login_typ   for particular local admin ',
  `default_login_typ_id` int(11) NOT NULL,
  `cal_time_interval_typ` int(5) NOT NULL DEFAULT '1' COMMENT '1=>automatically calculate; 2=>fix time interval; 3=>specific times',
  `cal_time_interval_variable` text NOT NULL COMMENT 'For  type 1 it is 0; For type 2 => tiem in minute; For type 3=> comma separated specific times',
  `adv_bk_min_setting` int(2) NOT NULL COMMENT '1=>Days; 2=>hour; 3=>Min',
  `adv_bk_min_tim` varchar(255) NOT NULL COMMENT 'How long before appointments can be booked ?',
  `tim_intrvl_btwn_appo_settingin` int(2) NOT NULL COMMENT '1=>Days; 2=>hour; 3=>Min',
  `tim_intrvl_btwn_appo` varchar(255) DEFAULT NULL,
  `adv_bk_mx_tim` varchar(255) NOT NULL COMMENT 'How many days in advance can appointments be booked?',
  `bkin_can_setin` int(2) NOT NULL COMMENT '1=>Days; 2=>hour; 3=>Min',
  `bkin_can_mx_tim` varchar(255) NOT NULL COMMENT 'How long before appointments can be cancelled?',
  `bkin_reschdl_setin` int(2) NOT NULL COMMENT '1=>Days; 2=>hour; 3=>Min',
  `bkin_reschdl_mx_tim` varchar(255) NOT NULL COMMENT 'How long before appointments can be reschedule? ',
  `admn_tim_intrvl` varchar(255) NOT NULL COMMENT 'Set time interval for Administrator ',
  `sms_alert` int(2) NOT NULL DEFAULT '0' COMMENT '0->No; 1->yes',
  `sms_alrt_bfr_appo` int(5) NOT NULL COMMENT ' Send alerts to clients prior to their appointment. (in Hour); 0-> if not applicable',
  `sms_thanks_aftrappo` int(1) NOT NULL DEFAULT '1' COMMENT '1-> Yes; 0-> No',
  `send_sms_for` int(5) NOT NULL COMMENT '1=>Never send any SMS; 2=>Whenever an appointment requires approval; 3=>Every time an appointment is booked',
  `sms_alart_to_admin` varchar(1) NOT NULL DEFAULT '1' COMMENT '1-> Yes; 0-> No',
  `sms_alart_to_staff` varchar(1) NOT NULL DEFAULT '1' COMMENT '1-> Yes; 0-> No',
  `email_alert` int(2) NOT NULL DEFAULT '1' COMMENT '0->No; 1->yes',
  `email_alrt_bfr_appo` int(5) NOT NULL COMMENT 'Send email alerts to clients prior to their appointment.(in Hour)',
  `pre_pmnt_setting` int(5) NOT NULL DEFAULT '0' COMMENT '0=>PrementSetting Disabled; 1=>Full service amount ; 2=> fixed booking fee.; 3=>% of service value.',
  `pre_pmnt_val` int(11) NOT NULL DEFAULT '0' COMMENT 'For Type 0 & 1 = 0 by default; for type 2=> fixed amount ; for Typ 3 => percentage',
  `pre_booking_frm` int(1) NOT NULL,
  `payment_gateways_enabled` text NOT NULL COMMENT 'This filled will carry the serialize array of enabled payment gateway id for the particular local admin ',
  `tax_rules_rate` text NOT NULL COMMENT 'his filed will carry the tax rule and rate as a serialize array',
  `membership_type_id` int(11) NOT NULL DEFAULT '1' COMMENT 'foreign key of the table app_membership_types',
  `membership_activation_dt` date NOT NULL COMMENT 'date of activation, of teh current plan',
  `membership_plan_deactivation_dt` date NOT NULL COMMENT 'date of deactivation of the current  plan',
  `multiple_services_booking` int(2) NOT NULL DEFAULT '0' COMMENT '0->Not possible; 1->Possible',
  `layout` varchar(50) NOT NULL DEFAULT 'L' COMMENT 'Options are:  L->Left; R->Right; T->Top',
  `theme` varchar(50) NOT NULL DEFAULT 'CS1' COMMENT 'Options are:  CS1->Color Scheme1; CS2->Color Scheme2; CS3->Color Scheme3; CS4->Color Scheme4; CCS->Custom color Scheme;',
  `hours_type` int(1) NOT NULL,
  `day_interval` int(11) NOT NULL DEFAULT '60',
  `day_cellwith` int(11) NOT NULL DEFAULT '250',
  `show_block_timinig` int(1) NOT NULL DEFAULT '0' COMMENT '0->Not Show ; 1->Show',
  `admin_always_allowed` int(1) NOT NULL,
  `frontend_header` int(1) unsigned NOT NULL DEFAULT '1',
  `admin_show_who` int(1) unsigned NOT NULL DEFAULT '1',
  PRIMARY KEY (`local_admin_gen_setting_id`),
  KEY `local_admin_id` (`local_admin_id`),
  KEY `default_login_typ_id` (`default_login_typ_id`),
  KEY `default_language_id` (`default_language_id`),
  KEY `membership_type_id` (`membership_type_id`),
  CONSTRAINT `app_local_admin_gen_setting_ibfk_2` FOREIGN KEY (`local_admin_id`) REFERENCES `app_local_admin` (`local_admin_id`) ON DELETE CASCADE,
  CONSTRAINT `app_local_admin_gen_setting_ibfk_3` FOREIGN KEY (`default_login_typ_id`) REFERENCES `app_logins` (`login_typ_id`) ON DELETE CASCADE,
  CONSTRAINT `app_local_admin_gen_setting_ibfk_4` FOREIGN KEY (`default_language_id`) REFERENCES `app_languages` (`languages_id`) ON DELETE CASCADE,
  CONSTRAINT `app_local_admin_gen_setting_ibfk_5` FOREIGN KEY (`membership_type_id`) REFERENCES `app_membership_types` (`membership_type_id`) ON DELETE CASCADE,
  CONSTRAINT `fk_app_local_admin_gen_setting_default_language_id` FOREIGN KEY (`default_language_id`) REFERENCES `app_languages` (`languages_id`),
  CONSTRAINT `fk_app_local_admin_gen_setting_local_admin_id` FOREIGN KEY (`local_admin_id`) REFERENCES `app_password_manager` (`user_id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `app_local_admin_gen_setting`
--

LOCK TABLES `app_local_admin_gen_setting` WRITE;
/*!40000 ALTER TABLE `app_local_admin_gen_setting` DISABLE KEYS */;
/*!40000 ALTER TABLE `app_local_admin_gen_setting` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `app_local_admin_gen_setting_admin_user_info`
--

DROP TABLE IF EXISTS `app_local_admin_gen_setting_admin_user_info`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `app_local_admin_gen_setting_admin_user_info` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `local_admin_id` int(11) NOT NULL,
  `sign_upinfo_item_id` int(5) NOT NULL COMMENT 'foreign key of app_local_clint_signup_info table',
  `mandetory` int(1) NOT NULL COMMENT '1=>yes; 0=>No; ',
  `disp_on_screen` int(2) NOT NULL DEFAULT '1' COMMENT '0->No; 1->yes',
  `status` int(1) NOT NULL DEFAULT '1' COMMENT '1-> Yes; 0-> No',
  PRIMARY KEY (`id`),
  KEY `local_admin_id` (`local_admin_id`),
  KEY `sign_upinfo_item_id` (`sign_upinfo_item_id`),
  CONSTRAINT `app_local_admin_gen_setting_admin_user_info_ibfk_1` FOREIGN KEY (`local_admin_id`) REFERENCES `app_local_admin` (`local_admin_id`) ON DELETE CASCADE,
  CONSTRAINT `app_local_admin_gen_setting_admin_user_info_ibfk_2` FOREIGN KEY (`sign_upinfo_item_id`) REFERENCES `app_local_clint_signup_info` (`sign_upinfo_item_id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `app_local_admin_gen_setting_admin_user_info`
--

LOCK TABLES `app_local_admin_gen_setting_admin_user_info` WRITE;
/*!40000 ALTER TABLE `app_local_admin_gen_setting_admin_user_info` DISABLE KEYS */;
/*!40000 ALTER TABLE `app_local_admin_gen_setting_admin_user_info` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `app_local_admin_gen_setting_clint_signup_info`
--

DROP TABLE IF EXISTS `app_local_admin_gen_setting_clint_signup_info`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `app_local_admin_gen_setting_clint_signup_info` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `local_admin_id` int(11) NOT NULL,
  `sign_upinfo_item_id` int(5) NOT NULL COMMENT 'foreign key of app_local_clint_signup_info table',
  `type` enum('S','E') NOT NULL DEFAULT 'S',
  `mandetory` int(1) NOT NULL COMMENT '1=>yes; 0=>No; ',
  `disp_on_screen` int(2) NOT NULL DEFAULT '1' COMMENT '0->No; 1->yes',
  `status` int(1) NOT NULL DEFAULT '1' COMMENT '1-> Yes; 0-> No',
  PRIMARY KEY (`id`),
  KEY `local_admin_id` (`local_admin_id`),
  KEY `sign_upinfo_item_id` (`sign_upinfo_item_id`),
  CONSTRAINT `app_local_admin_gen_setting_clint_signup_info_ibfk_1` FOREIGN KEY (`local_admin_id`) REFERENCES `app_local_admin` (`local_admin_id`) ON DELETE CASCADE,
  CONSTRAINT `app_local_admin_gen_setting_clint_signup_info_ibfk_2` FOREIGN KEY (`sign_upinfo_item_id`) REFERENCES `app_local_clint_signup_info` (`sign_upinfo_item_id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `app_local_admin_gen_setting_clint_signup_info`
--

LOCK TABLES `app_local_admin_gen_setting_clint_signup_info` WRITE;
/*!40000 ALTER TABLE `app_local_admin_gen_setting_clint_signup_info` DISABLE KEYS */;
/*!40000 ALTER TABLE `app_local_admin_gen_setting_clint_signup_info` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `app_local_admin_gen_setting_languages`
--

DROP TABLE IF EXISTS `app_local_admin_gen_setting_languages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `app_local_admin_gen_setting_languages` (
  `gen_setting_languages_id` int(11) NOT NULL AUTO_INCREMENT,
  `local_admin_id` int(11) NOT NULL,
  `languages_id` int(5) NOT NULL COMMENT 'foreign key of app_languages table',
  `status` int(1) NOT NULL DEFAULT '1' COMMENT '1-> Yes; 0-> No',
  PRIMARY KEY (`gen_setting_languages_id`),
  KEY `local_admin_id` (`local_admin_id`),
  KEY `languages_id` (`languages_id`),
  CONSTRAINT `app_local_admin_gen_setting_languages_ibfk_1` FOREIGN KEY (`local_admin_id`) REFERENCES `app_local_admin` (`local_admin_id`) ON DELETE CASCADE,
  CONSTRAINT `app_local_admin_gen_setting_languages_ibfk_2` FOREIGN KEY (`languages_id`) REFERENCES `app_languages` (`languages_id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `app_local_admin_gen_setting_languages`
--

LOCK TABLES `app_local_admin_gen_setting_languages` WRITE;
/*!40000 ALTER TABLE `app_local_admin_gen_setting_languages` DISABLE KEYS */;
/*!40000 ALTER TABLE `app_local_admin_gen_setting_languages` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `app_local_admin_gen_setting_login_typ`
--

DROP TABLE IF EXISTS `app_local_admin_gen_setting_login_typ`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `app_local_admin_gen_setting_login_typ` (
  `gen_setting_login_typ_id` int(11) NOT NULL AUTO_INCREMENT,
  `local_admin_id` int(11) NOT NULL,
  `login_typ_id` int(5) NOT NULL COMMENT 'foreign key of app_logins table',
  `status` int(1) NOT NULL DEFAULT '1' COMMENT '1-> Yes; 0-> No',
  PRIMARY KEY (`gen_setting_login_typ_id`),
  KEY `local_admin_id` (`local_admin_id`),
  KEY `login_typ_id` (`login_typ_id`),
  CONSTRAINT `app_local_admin_gen_setting_login_typ_ibfk_1` FOREIGN KEY (`local_admin_id`) REFERENCES `app_local_admin` (`local_admin_id`) ON DELETE CASCADE,
  CONSTRAINT `app_local_admin_gen_setting_login_typ_ibfk_2` FOREIGN KEY (`login_typ_id`) REFERENCES `app_logins` (`login_typ_id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='it wil stor status of diff log in typ for each local admin';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `app_local_admin_gen_setting_login_typ`
--

LOCK TABLES `app_local_admin_gen_setting_login_typ` WRITE;
/*!40000 ALTER TABLE `app_local_admin_gen_setting_login_typ` DISABLE KEYS */;
/*!40000 ALTER TABLE `app_local_admin_gen_setting_login_typ` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `app_local_clint_signup_info`
--

DROP TABLE IF EXISTS `app_local_clint_signup_info`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `app_local_clint_signup_info` (
  `sign_upinfo_item_id` int(11) NOT NULL AUTO_INCREMENT,
  `info_item_name` varchar(255) NOT NULL,
  `info_status` int(1) NOT NULL DEFAULT '1',
  `front_disp` int(2) NOT NULL DEFAULT '0' COMMENT '0->No; 1->yes',
  PRIMARY KEY (`sign_upinfo_item_id`),
  UNIQUE KEY `info_item_name` (`info_item_name`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `app_local_clint_signup_info`
--

LOCK TABLES `app_local_clint_signup_info` WRITE;
/*!40000 ALTER TABLE `app_local_clint_signup_info` DISABLE KEYS */;
INSERT INTO `app_local_clint_signup_info` VALUES (2,'cus_fname',1,1),(3,'cus_lname',1,1),(4,'cus_address',1,1),(5,'cus_countryid',1,1),(6,'cus_regionid',1,1),(7,'cus_cityid',1,1),(8,'cus_zip',1,1),(9,'cus_mob',1,1),(10,'cus_phn1',1,1),(11,'cus_phn2',1,1),(14,'cus_status',1,0),(15,'created_by',1,0),(16,'created_on',1,0),(17,'updated_by',1,0),(18,'updated_on',1,0),(21,'time_zone_id',1,1);
/*!40000 ALTER TABLE `app_local_clint_signup_info` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `app_local_customer_details`
--

DROP TABLE IF EXISTS `app_local_customer_details`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `app_local_customer_details` (
  `id` int(25) NOT NULL AUTO_INCREMENT,
  `local_admin_id` int(11) NOT NULL,
  `sign_upinfo_item_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `value` text NOT NULL,
  `date_inserted` date NOT NULL,
  `date_edited` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `local_admin_id` (`local_admin_id`,`sign_upinfo_item_id`,`customer_id`),
  KEY `app_local_customer_details_customer_id` (`customer_id`),
  KEY `fk_app_local_customer_details_sign_upinfo_item_id` (`sign_upinfo_item_id`),
  CONSTRAINT `app_local_customer_details_customer_id` FOREIGN KEY (`customer_id`) REFERENCES `app_password_manager` (`user_id`),
  CONSTRAINT `app_local_customer_details_ibfk_1` FOREIGN KEY (`local_admin_id`) REFERENCES `app_local_admin` (`local_admin_id`) ON DELETE CASCADE,
  CONSTRAINT `fk_app_local_customer_details_sign_upinfo_item_id` FOREIGN KEY (`sign_upinfo_item_id`) REFERENCES `app_local_clint_signup_info` (`sign_upinfo_item_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `app_local_customer_details`
--

LOCK TABLES `app_local_customer_details` WRITE;
/*!40000 ALTER TABLE `app_local_customer_details` DISABLE KEYS */;
/*!40000 ALTER TABLE `app_local_customer_details` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `app_localadmin_relation`
--

DROP TABLE IF EXISTS `app_localadmin_relation`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `app_localadmin_relation` (
  `relation_id` int(11) NOT NULL AUTO_INCREMENT,
  `relation_localadmin_id` int(11) NOT NULL,
  `relation_parent_id` int(11) NOT NULL,
  `relation_active` enum('1') NOT NULL DEFAULT '1',
  `menu_authorization` int(11) NOT NULL,
  `is_parent` enum('1') NOT NULL DEFAULT '1',
  PRIMARY KEY (`relation_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `app_localadmin_relation`
--

LOCK TABLES `app_localadmin_relation` WRITE;
/*!40000 ALTER TABLE `app_localadmin_relation` DISABLE KEYS */;
/*!40000 ALTER TABLE `app_localadmin_relation` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `app_logins`
--

DROP TABLE IF EXISTS `app_logins`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `app_logins` (
  `login_typ_id` int(11) NOT NULL AUTO_INCREMENT,
  `login_name` varchar(255) NOT NULL,
  `login_identifier` varchar(255) NOT NULL,
  `login_order` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  PRIMARY KEY (`login_typ_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1 COMMENT='diff. typ of login optn will str here, like FB google Twitr';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `app_logins`
--

LOCK TABLES `app_logins` WRITE;
/*!40000 ALTER TABLE `app_logins` DISABLE KEYS */;
INSERT INTO `app_logins` VALUES (1,'Pardco','pardco_login',2,1),(2,'Facebook','facebook_login',1,1),(4,'Google','google_login',3,1);
/*!40000 ALTER TABLE `app_logins` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `app_member_plan_subscription`
--

DROP TABLE IF EXISTS `app_member_plan_subscription`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `app_member_plan_subscription` (
  `plan_subscription_id` int(11) NOT NULL AUTO_INCREMENT,
  `local_admin_id` int(11) NOT NULL,
  `plan_id` int(11) NOT NULL,
  `is_multilocation` tinyint(4) NOT NULL,
  `plan_desc` text NOT NULL,
  `billing_cycle` varchar(255) NOT NULL,
  `no_of_location` int(10) NOT NULL DEFAULT '1',
  `staff_per_location` int(10) NOT NULL DEFAULT '0',
  `extra_staff` int(10) NOT NULL,
  `total_staff` int(10) NOT NULL,
  `currency_id` int(11) NOT NULL,
  `base_price` double(10,2) NOT NULL DEFAULT '0.00',
  `base_saving_amt` double(10,2) NOT NULL DEFAULT '0.00',
  `base_promo_amt` double(10,2) NOT NULL DEFAULT '0.00',
  `base_discount_amt` double(10,2) NOT NULL DEFAULT '0.00',
  `base_total_amt` double(10,2) NOT NULL DEFAULT '0.00',
  `price` double(10,2) NOT NULL DEFAULT '0.00',
  `saving_amt` double(10,2) NOT NULL DEFAULT '0.00',
  `promo_amt` double(10,2) NOT NULL DEFAULT '0.00',
  `discount_amt` double(10,2) NOT NULL DEFAULT '0.00',
  `total_amt` double(10,2) NOT NULL DEFAULT '0.00',
  `subscription_date` datetime NOT NULL,
  `plan_expiry_date` datetime NOT NULL,
  `feature_desc` text NOT NULL COMMENT 'encoded value of features',
  `payment_method_id` int(11) NOT NULL,
  `is_active` enum('Y','N') NOT NULL,
  `date_added` date NOT NULL,
  PRIMARY KEY (`plan_subscription_id`),
  KEY `fk_app_member_plan_subscription_plan_id` (`plan_id`),
  CONSTRAINT `fk_app_member_plan_subscription_plan_id` FOREIGN KEY (`plan_id`) REFERENCES `app_membership_plan` (`plan_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `app_member_plan_subscription`
--

LOCK TABLES `app_member_plan_subscription` WRITE;
/*!40000 ALTER TABLE `app_member_plan_subscription` DISABLE KEYS */;
/*!40000 ALTER TABLE `app_member_plan_subscription` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `app_membership_credits`
--

DROP TABLE IF EXISTS `app_membership_credits`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `app_membership_credits` (
  `credit_id` int(11) NOT NULL AUTO_INCREMENT,
  `package_name` varchar(255) NOT NULL,
  `package_desc` text,
  `credits` varchar(255) NOT NULL,
  `base_amt` double(10,2) NOT NULL DEFAULT '0.00',
  `credit_order` int(10) NOT NULL DEFAULT '0',
  `status` enum('1','0') NOT NULL DEFAULT '1',
  PRIMARY KEY (`credit_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `app_membership_credits`
--

LOCK TABLES `app_membership_credits` WRITE;
/*!40000 ALTER TABLE `app_membership_credits` DISABLE KEYS */;
INSERT INTO `app_membership_credits` VALUES (1,'Visa Infinite','Enter a world of luxury and privilege with Visa Infinite. Enjoy excellent spending power with a high credit limit, the convenience of Visa Infinite Concierge 24 hours a day, 7 days a week, personalized privileges, rewards and service anywhere in the world.','50',150.00,1,'1');
/*!40000 ALTER TABLE `app_membership_credits` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `app_membership_credits_country_cost`
--

DROP TABLE IF EXISTS `app_membership_credits_country_cost`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `app_membership_credits_country_cost` (
  `credit_id` int(11) NOT NULL,
  `credit_service_id` int(11) NOT NULL,
  `country_id` int(11) NOT NULL,
  `cost` double(10,2) NOT NULL DEFAULT '0.00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `app_membership_credits_country_cost`
--

LOCK TABLES `app_membership_credits_country_cost` WRITE;
/*!40000 ALTER TABLE `app_membership_credits_country_cost` DISABLE KEYS */;
/*!40000 ALTER TABLE `app_membership_credits_country_cost` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `app_membership_credits_country_price`
--

DROP TABLE IF EXISTS `app_membership_credits_country_price`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `app_membership_credits_country_price` (
  `credit_id` int(11) NOT NULL,
  `credit_service_id` int(11) NOT NULL,
  `country_id` int(11) NOT NULL,
  `cost` double(10,2) NOT NULL,
  KEY `fk_app_membership_credits_country_price_credit_service_id` (`credit_service_id`),
  CONSTRAINT `fk_app_membership_credits_country_price_credit_service_id` FOREIGN KEY (`credit_service_id`) REFERENCES `app_membership_credits_service` (`credit_service_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `app_membership_credits_country_price`
--

LOCK TABLES `app_membership_credits_country_price` WRITE;
/*!40000 ALTER TABLE `app_membership_credits_country_price` DISABLE KEYS */;
/*!40000 ALTER TABLE `app_membership_credits_country_price` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `app_membership_credits_inventory`
--

DROP TABLE IF EXISTS `app_membership_credits_inventory`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `app_membership_credits_inventory` (
  `local_admin_id` int(11) NOT NULL,
  `available_credits` varchar(255) NOT NULL,
  PRIMARY KEY (`local_admin_id`),
  CONSTRAINT `fk_app_membership_credits_inventory_local_admin_id` FOREIGN KEY (`local_admin_id`) REFERENCES `app_password_manager` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `app_membership_credits_inventory`
--

LOCK TABLES `app_membership_credits_inventory` WRITE;
/*!40000 ALTER TABLE `app_membership_credits_inventory` DISABLE KEYS */;
/*!40000 ALTER TABLE `app_membership_credits_inventory` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `app_membership_credits_service`
--

DROP TABLE IF EXISTS `app_membership_credits_service`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `app_membership_credits_service` (
  `credit_service_id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `status` enum('1','0') NOT NULL DEFAULT '1',
  PRIMARY KEY (`credit_service_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `app_membership_credits_service`
--

LOCK TABLES `app_membership_credits_service` WRITE;
/*!40000 ALTER TABLE `app_membership_credits_service` DISABLE KEYS */;
INSERT INTO `app_membership_credits_service` VALUES (1,'Call Cost','1'),(2,'SMS Cost','1');
/*!40000 ALTER TABLE `app_membership_credits_service` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `app_membership_credits_subscription`
--

DROP TABLE IF EXISTS `app_membership_credits_subscription`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `app_membership_credits_subscription` (
  `credit_subscription_id` int(11) NOT NULL AUTO_INCREMENT,
  `local_admin_id` int(11) NOT NULL,
  `credit_id` int(11) NOT NULL,
  `package_name` varchar(255) NOT NULL,
  `package_desc` text,
  `base_amt` double(10,2) NOT NULL,
  `amount` double(10,2) NOT NULL COMMENT 'USD amount',
  `payment_date` datetime NOT NULL,
  `date_added` datetime NOT NULL,
  PRIMARY KEY (`credit_subscription_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `app_membership_credits_subscription`
--

LOCK TABLES `app_membership_credits_subscription` WRITE;
/*!40000 ALTER TABLE `app_membership_credits_subscription` DISABLE KEYS */;
/*!40000 ALTER TABLE `app_membership_credits_subscription` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `app_membership_feature`
--

DROP TABLE IF EXISTS `app_membership_feature`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `app_membership_feature` (
  `feature_id` int(10) NOT NULL AUTO_INCREMENT,
  `feature_name` text NOT NULL,
  `feature_order` int(10) NOT NULL,
  `status` int(1) NOT NULL,
  PRIMARY KEY (`feature_id`)
) ENGINE=InnoDB AUTO_INCREMENT=87 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `app_membership_feature`
--

LOCK TABLES `app_membership_feature` WRITE;
/*!40000 ALTER TABLE `app_membership_feature` DISABLE KEYS */;
INSERT INTO `app_membership_feature` VALUES (33,'Separate login for staff members',2,1),(34,'Staff login control: Rights and restrictions',3,1),(35,'SMS messages before and/or after appointment',4,1),(36,'Graphs: Weekdays, Staff performance, Service performance',5,1),(37,'Phone support',6,1),(38,'Email support',7,1),(39,'Recurring appointments',8,1),(40,'Discount / Offer coupons with multiple options',9,1),(41,'Autopromotion',10,1),(42,'Reports: Appointments, Sales, Clients, Alerts, SMS',11,1),(43,'Google Calendar integration',12,1),(44,'Calendar appearance modification: Layouts, color settings',13,1),(45,'Ads free',14,1),(46,'Capacity booking (Book multiple instances at once)',15,1),(47,'Book multiple services at once',16,1),(48,'Book to preferred staff',17,1),(49,'Booking automatically to staff (most free, most busy, display order)',18,1),(50,'Service specific further details (extra fields for bookings)',19,1),(51,'\"Versatile calendar views for customers and staff \n(Day, Week, Month, Agenda for staff. Week, Month, Review for customers)\"',20,1),(52,'Appointment view for customers with possibility to cancel appointments',21,1),(53,'Own appointment history for customers',22,1),(54,'Drag and drop -reschedule',23,1),(55,'Mobile version (customers)',24,1),(56,'Easy calendar printing',25,1),(57,'Block Staff member for day',26,1),(58,'Appointment: Status, Edit, Cancel, Client details, Order details and Review easily accessible for staff',27,1),(59,'Website integration widget',28,1),(60,'Facebook integration',29,1),(61,'Share in social media',30,1),(62,'Email marketing',31,1),(63,'Social media marketing with discount/offer integration',32,1),(64,'Possibility to require staff approval on appointments',33,1),(65,'Possibility to require staff approval on appointments',34,1),(66,'Export your customers in Excel format',35,1),(67,'Customer upkeep: edit and assist your customers in admin panel',36,1),(68,'Customizable customer types',37,1),(69,'Company settings: choose your currency, business category and alot of other options',38,1),(70,'Service groups',39,1),(71,'Service dependencies',40,1),(72,'Service control, temporary hide your service(s)',41,1),(73,'Staff control: temporary blocking, staff info',42,1),(74,'Business hours: service, quantity and staff specific implementation',43,1),(75,'Accept prepayments',44,1),(76,'Booking settings for different verification level customers',45,1),(77,'Booking restrictions: Amount, recurring, display of price/duration, how far into the future, how often',46,1),(78,'Possibility to hide Staff from Customers',47,1),(79,'Multiple languages',48,1),(80,'Rich login options: Google login, Facebook login, Bookient login',49,1),(81,'Occupancy of the backup',50,1),(82,'Email notification before appointment',51,1),(83,'Email \"thank you\" message after appointment with possibility for review',52,1),(84,'Email customization',53,1),(85,'Company specific Privacy Policy, Security Info, Company Info',54,1),(86,'Adding multiple locations',1,1);
/*!40000 ALTER TABLE `app_membership_feature` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `app_membership_payment_smscall_credit_history`
--

DROP TABLE IF EXISTS `app_membership_payment_smscall_credit_history`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `app_membership_payment_smscall_credit_history` (
  `payment_smscall_credit_history_id` int(11) NOT NULL AUTO_INCREMENT,
  `local_admin_id` int(11) NOT NULL,
  `smscall_dtls_id` int(11) NOT NULL,
  `package_name` varchar(250) NOT NULL,
  `amount` float(10,2) NOT NULL,
  `payment_method_id` int(11) NOT NULL,
  `payment_date` datetime NOT NULL,
  `activation_date` date NOT NULL,
  `credit` int(11) NOT NULL,
  `date_purchased` date NOT NULL,
  PRIMARY KEY (`payment_smscall_credit_history_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `app_membership_payment_smscall_credit_history`
--

LOCK TABLES `app_membership_payment_smscall_credit_history` WRITE;
/*!40000 ALTER TABLE `app_membership_payment_smscall_credit_history` DISABLE KEYS */;
/*!40000 ALTER TABLE `app_membership_payment_smscall_credit_history` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `app_membership_plan`
--

DROP TABLE IF EXISTS `app_membership_plan`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `app_membership_plan` (
  `plan_id` int(20) NOT NULL AUTO_INCREMENT,
  `plan_name` text NOT NULL,
  `plan_desc` text,
  `status` smallint(1) NOT NULL,
  `plan_cost` varchar(20) NOT NULL,
  `plan_validity` int(10) NOT NULL DEFAULT '365',
  `is_multilocation` smallint(1) NOT NULL,
  `currency_id` int(20) NOT NULL,
  `created_on` date NOT NULL,
  `membership_order` int(20) NOT NULL,
  `is_deleted` enum('Y','N') NOT NULL DEFAULT 'N',
  PRIMARY KEY (`plan_id`),
  KEY `fk_app_membership_plan_currency_id` (`currency_id`),
  CONSTRAINT `fk_app_membership_plan_currency_id` FOREIGN KEY (`currency_id`) REFERENCES `app_currency` (`currency_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `app_membership_plan`
--

LOCK TABLES `app_membership_plan` WRITE;
/*!40000 ALTER TABLE `app_membership_plan` DISABLE KEYS */;
INSERT INTO `app_membership_plan` VALUES (1,'Free','<p>\n	<span class=\"mp_text\">Free is the default plan that includes basic functionality of the system. </span></p>\n<p>\n	<span class=\"mp_text\">For more advanced features you will need to upgrade to some of our premium plans.</span></p>',1,'',0,0,1,'2014-06-23',1,'N'),(2,'Extra','<p>\n	Extra is cheapest of the premium plans.</p>\n<p>\n	On top of the features from Free plan, Extra includes basic support and most of advanced features.</p>',1,'',0,0,1,'2014-06-23',2,'N'),(3,'Pro','<p>\n	Pro is the mid-price premium plan.</p>\n<p>\n	On top of Free and Extra plan features you will also get phone support, graphs and SMS features.</p>',1,'',0,0,1,'2014-06-23',4,'N'),(4,'Enterprise','<p>\n	Enterprise is the plan with everything included.</p>\n<p>\n	On top of all the other plans you will get possibility to add multiple locations and have your staff members use their own logins into the system.</p>',1,'',0,1,1,'2014-06-23',3,'N');
/*!40000 ALTER TABLE `app_membership_plan` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `app_membership_plan_feature`
--

DROP TABLE IF EXISTS `app_membership_plan_feature`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `app_membership_plan_feature` (
  `membership_plan_feature_id` int(11) NOT NULL AUTO_INCREMENT,
  `membership_plan_feature` text NOT NULL,
  `status` int(2) NOT NULL COMMENT '0->No; 1->yes',
  `created_on` date NOT NULL,
  PRIMARY KEY (`membership_plan_feature_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='diff func of each membrshp pln';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `app_membership_plan_feature`
--

LOCK TABLES `app_membership_plan_feature` WRITE;
/*!40000 ALTER TABLE `app_membership_plan_feature` DISABLE KEYS */;
/*!40000 ALTER TABLE `app_membership_plan_feature` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `app_membership_plan_feature_relation`
--

DROP TABLE IF EXISTS `app_membership_plan_feature_relation`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `app_membership_plan_feature_relation` (
  `plan_id` int(11) NOT NULL,
  `feature_id` int(11) NOT NULL,
  KEY `fk_app_membership_plan_feature_relation_plan_id` (`plan_id`),
  CONSTRAINT `fk_app_membership_plan_feature_relation_plan_id` FOREIGN KEY (`plan_id`) REFERENCES `app_membership_plan` (`plan_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='diff func of each membrshp pln';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `app_membership_plan_feature_relation`
--

LOCK TABLES `app_membership_plan_feature_relation` WRITE;
/*!40000 ALTER TABLE `app_membership_plan_feature_relation` DISABLE KEYS */;
INSERT INTO `app_membership_plan_feature_relation` VALUES (4,86),(4,33),(4,34),(4,35),(3,35),(4,36),(3,36),(4,37),(3,37),(2,38),(4,38),(3,38),(2,39),(4,39),(3,39),(2,40),(4,40),(3,40),(2,41),(4,41),(3,41),(2,42),(4,42),(3,42),(2,43),(4,43),(3,43),(2,44),(4,44),(3,44),(1,45),(2,45),(4,45),(3,45),(1,46),(2,46),(4,46),(3,46),(1,47),(2,47),(4,47),(3,47),(1,48),(2,48),(4,48),(3,48),(1,49),(2,49),(4,49),(3,49),(1,50),(2,50),(4,50),(3,50),(1,51),(2,51),(4,51),(3,51),(1,52),(2,52),(4,52),(3,52),(1,53),(2,53),(4,53),(3,53),(1,54),(2,54),(4,54),(3,54),(1,55),(2,55),(4,55),(3,55),(1,56),(2,56),(4,56),(3,56),(1,57),(2,57),(4,57),(3,57),(1,58),(2,58),(4,58),(3,58),(1,59),(2,59),(4,59),(3,59),(1,60),(2,60),(4,60),(3,60),(1,61),(2,61),(4,61),(3,61),(1,62),(2,62),(4,62),(3,62),(1,63),(2,63),(4,63),(3,63),(1,64),(2,64),(4,64),(3,64),(1,65),(2,65),(4,65),(3,65),(1,66),(2,66),(4,66),(3,66),(1,67),(2,67),(4,67),(3,67),(1,68),(2,68),(4,68),(3,68),(1,69),(2,69),(4,69),(3,69),(1,70),(2,70),(4,70),(3,70),(1,71),(2,71),(4,71),(3,71),(1,72),(2,72),(4,72),(3,72),(1,73),(2,73),(4,73),(3,73),(1,74),(2,74),(4,74),(3,74),(1,75),(2,75),(4,75),(3,75),(1,76),(2,76),(4,76),(3,76),(1,77),(2,77),(4,77),(3,77),(1,78),(2,78),(4,78),(3,78),(1,79),(2,79),(4,79),(3,79),(1,80),(2,80),(4,80),(3,80),(1,81),(2,81),(4,81),(3,81),(1,82),(2,82),(4,82),(3,82),(1,83),(2,83),(4,83),(3,83),(1,84),(2,84),(4,84),(3,84),(1,85),(2,85),(4,85),(3,85);
/*!40000 ALTER TABLE `app_membership_plan_feature_relation` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `app_membership_plan_subscriptions`
--

DROP TABLE IF EXISTS `app_membership_plan_subscriptions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `app_membership_plan_subscriptions` (
  `plan_subscriptions_id` int(11) NOT NULL AUTO_INCREMENT,
  `membership_type_id` int(11) NOT NULL,
  `sub_plan_desc` text NOT NULL,
  `amount` float(10,2) NOT NULL,
  `validity` int(11) NOT NULL,
  `extra_validity` int(11) NOT NULL DEFAULT '0',
  `status` int(2) NOT NULL,
  `date_creation` date NOT NULL,
  `plan_subscriptions_order` int(11) NOT NULL,
  PRIMARY KEY (`plan_subscriptions_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `app_membership_plan_subscriptions`
--

LOCK TABLES `app_membership_plan_subscriptions` WRITE;
/*!40000 ALTER TABLE `app_membership_plan_subscriptions` DISABLE KEYS */;
/*!40000 ALTER TABLE `app_membership_plan_subscriptions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `app_membership_plan_tierprice`
--

DROP TABLE IF EXISTS `app_membership_plan_tierprice`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `app_membership_plan_tierprice` (
  `tierprice_id` int(10) NOT NULL AUTO_INCREMENT,
  `plan_id` int(10) NOT NULL,
  `price` int(10) NOT NULL,
  `billing_cycle` varchar(20) NOT NULL,
  `no_of_location` int(10) NOT NULL,
  `staff_per_location` int(10) NOT NULL,
  `additional_cost_location` int(10) NOT NULL,
  `is_base_price` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`tierprice_id`),
  KEY `fk_app_membership_plan_tierprice_relation_plan_id` (`plan_id`),
  CONSTRAINT `fk_app_membership_plan_tierprice_relation_plan_id` FOREIGN KEY (`plan_id`) REFERENCES `app_membership_plan` (`plan_id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `app_membership_plan_tierprice`
--

LOCK TABLES `app_membership_plan_tierprice` WRITE;
/*!40000 ALTER TABLE `app_membership_plan_tierprice` DISABLE KEYS */;
INSERT INTO `app_membership_plan_tierprice` VALUES (1,1,0,'monthly',0,20,0,1),(2,1,0,'helf_yearly',0,0,0,0),(3,1,0,'yearly',0,0,0,0),(4,2,10,'monthly',0,20,0,1),(5,2,60,'helf_yearly',0,0,0,0),(6,2,120,'yearly',0,0,0,0),(7,3,20,'monthly',0,20,0,1),(8,3,120,'helf_yearly',0,0,0,0),(9,3,240,'yearly',0,0,0,0),(10,4,40,'monthly',20,20,0,1),(11,4,240,'helf_yearly',20,20,0,0),(12,4,480,'yearly',20,20,0,0);
/*!40000 ALTER TABLE `app_membership_plan_tierprice` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `app_membership_smscall_dtls`
--

DROP TABLE IF EXISTS `app_membership_smscall_dtls`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `app_membership_smscall_dtls` (
  `smscall_dtls_id` int(11) NOT NULL AUTO_INCREMENT,
  `package_name` varchar(250) NOT NULL,
  `amount` float(10,2) NOT NULL,
  `credit` int(11) NOT NULL,
  `description` text NOT NULL,
  `status` int(2) NOT NULL,
  `date_creation` date NOT NULL,
  `currency_id` int(11) NOT NULL,
  `smscall_dtls_order` int(11) NOT NULL,
  PRIMARY KEY (`smscall_dtls_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `app_membership_smscall_dtls`
--

LOCK TABLES `app_membership_smscall_dtls` WRITE;
/*!40000 ALTER TABLE `app_membership_smscall_dtls` DISABLE KEYS */;
/*!40000 ALTER TABLE `app_membership_smscall_dtls` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `app_membership_smscall_rate_dtls`
--

DROP TABLE IF EXISTS `app_membership_smscall_rate_dtls`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `app_membership_smscall_rate_dtls` (
  `smscall_rate_dtls_id` int(11) NOT NULL AUTO_INCREMENT,
  `country_id` int(11) NOT NULL,
  `smscall_dtls_id` int(11) NOT NULL,
  `sms_rate` float(10,2) NOT NULL,
  `call_rate` float(10,2) NOT NULL,
  `status` int(2) NOT NULL,
  `smscall_rate_dtls_order` int(11) NOT NULL,
  PRIMARY KEY (`smscall_rate_dtls_id`),
  KEY `fk_app_membership_smscall_rate_dtls_smscall_dtls_id` (`smscall_dtls_id`),
  CONSTRAINT `fk_app_membership_smscall_rate_dtls_smscall_dtls_id` FOREIGN KEY (`smscall_dtls_id`) REFERENCES `app_membership_smscall_dtls` (`smscall_dtls_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `app_membership_smscall_rate_dtls`
--

LOCK TABLES `app_membership_smscall_rate_dtls` WRITE;
/*!40000 ALTER TABLE `app_membership_smscall_rate_dtls` DISABLE KEYS */;
/*!40000 ALTER TABLE `app_membership_smscall_rate_dtls` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `app_membership_types`
--

DROP TABLE IF EXISTS `app_membership_types`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `app_membership_types` (
  `membership_type_id` int(11) NOT NULL AUTO_INCREMENT,
  `membership_name` varchar(255) NOT NULL,
  `membership_amount` varchar(11) NOT NULL,
  `currency_id` int(11) NOT NULL,
  `membership_validity` int(11) NOT NULL COMMENT 'How many days ',
  `membership_tagline` varchar(255) NOT NULL,
  `membership_description` text NOT NULL,
  `created_on` date NOT NULL,
  `status` int(2) NOT NULL COMMENT '0->No; 1->yes;2->logically delete',
  `membership_order` int(11) NOT NULL,
  PRIMARY KEY (`membership_type_id`),
  KEY `currency_id` (`currency_id`),
  CONSTRAINT `app_membership_types_ibfk_1` FOREIGN KEY (`currency_id`) REFERENCES `app_currency` (`currency_id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1 COMMENT='All Membership plan will be stored here';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `app_membership_types`
--

LOCK TABLES `app_membership_types` WRITE;
/*!40000 ALTER TABLE `app_membership_types` DISABLE KEYS */;
INSERT INTO `app_membership_types` VALUES (1,'Unknown','Unknown',1,1,'Unknown','Unknown','2014-08-01',1,1);
/*!40000 ALTER TABLE `app_membership_types` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `app_msg_language`
--

DROP TABLE IF EXISTS `app_msg_language`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `app_msg_language` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `local_admin_id` int(11) NOT NULL,
  `language_id` int(11) NOT NULL,
  `msg_id` int(11) NOT NULL,
  `msg_subject` varchar(255) CHARACTER SET latin1 NOT NULL,
  `msg_body` text COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_app_msg_language_language_id` (`language_id`),
  KEY `fk_app_msg_language_msg_id` (`msg_id`),
  CONSTRAINT `fk_app_msg_language_language_id` FOREIGN KEY (`language_id`) REFERENCES `app_languages` (`languages_id`),
  CONSTRAINT `fk_app_msg_language_msg_id` FOREIGN KEY (`msg_id`) REFERENCES `app_email_msg` (`msg_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `app_msg_language`
--

LOCK TABLES `app_msg_language` WRITE;
/*!40000 ALTER TABLE `app_msg_language` DISABLE KEYS */;
/*!40000 ALTER TABLE `app_msg_language` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `app_offer_template`
--

DROP TABLE IF EXISTS `app_offer_template`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `app_offer_template` (
  `template_id` int(11) NOT NULL AUTO_INCREMENT,
  `social_icon` text,
  `template_body` text NOT NULL,
  `is_active` int(1) NOT NULL,
  PRIMARY KEY (`template_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `app_offer_template`
--

LOCK TABLES `app_offer_template` WRITE;
/*!40000 ALTER TABLE `app_offer_template` DISABLE KEYS */;
INSERT INTO `app_offer_template` VALUES (1,'simple.png','<div class=\"socialInner\" style=\"min-height: 237px;padding:10px;\">\r\n	<div  class=\"SocialHead\" style=\"font-size:20px; text-align:center;text-align: center;\">\r\n 		Hey, lets get social!\r\n 	</div>\r\n	<div  class=\"SocialDes\" style=\"text-align: center;padding: 5px;\">Why come alone? Invite your friends to come along with you. Just click on the button below and invite your friends on Facebook & Twitter.\r\n	</div>\r\n	<div class=\"social link\" style=\"text-align: center;padding: 5px;\">\r\n        <a onclick=\"tweetToTwteer();\" class=\"fb_link\" href=\"javascript:void(0);\">\r\n            <img width=\"125\" border=\"0\" src=\"../../../../uploads/social_icon/post_tweet.png\" alt=\"Post to Twitter\" title=\"Post to twitter\">\r\n        </a>\r\n		<a class=\"tw_link\"  onclick=\"faceToFacebook();\" href=\"javascript:void(0);\">\r\n            <img width=\"125\" border=\"0\" src=\"../../../../uploads/social_icon/post_fb.png\" alt=\"Post to Facebook\" title=\"Post to facebook\">\r\n        </a>\r\n    </div>\r\n    <div class=\"SocialDFooter\" style=\"text-align: center;padding: 5px;\">\r\n        You need to disable all popup blockers\r\n    </div> \r\n</div>',1),(2,'left.png','								<div  style=\"padding:10px;\">\r\n<div class=\"socialInner\" style=\"min-height: 237px;float:left;padding:10px; width:20%;\"></div>\r\n<div style=\"float:left;width:75%;\">\r\n<div  class=\"SocialHead\" style=\"font-size:20px; text-align:center;text-align: left;\">\r\n 		Hey, lets get social!\r\n 	</div>\r\n	<div  class=\"SocialDes\" style=\"text-align: left;padding: 5px;\">Why come alone? Invite your friends to come along with you. Just click on the button below and invite your friends on Facebook & Twitter.\r\n	</div>\r\n	<div class=\"social link\" style=\"text-align: left;padding: 5px;\">\r\n        <a onclick=\"tweetToTwteer();\" class=\"fb_link\" href=\"javascript:void(0);\">\r\n            <img width=\"125\" border=\"0\" src=\"../../../../uploads/social_icon/post_tweet.png\" alt=\"Post to Twitter\" title=\"Post to twitter\">\r\n        </a>\r\n		<a class=\"tw_link\" onclick=\"faceToFacebook();\" href=\"javascript:void(0);\">\r\n            <img width=\"125\" border=\"0\" src=\"../../../../uploads/social_icon/post_fb.png\" alt=\"Post to Facebook\" title=\"Post to Facebook\">\r\n        </a>\r\n    </div>\r\n    <div class=\"SocialDFooter\" style=\"text-align: left;padding: 5px;\">\r\n        You need to disable all popup blockers\r\n    </div> \r\n</div>\r\n<div style=\"clear:both;\"></div>\r\n</div>',1),(3,'right.png','<div  style=\"padding:10px;\">\r\n<div style=\"float:left;width:75%;\">\r\n<div  class=\"SocialHead\" style=\"font-size:20px; text-align:center;text-align: left;\">\r\n 		Hey, lets get social!\r\n 	</div>\r\n	<div  class=\"SocialDes\" style=\"text-align: left;padding: 5px;\">Why come alone? Invite your friends to come along with you. Just click on the button below and invite your friends on Facebook & Twitter.\r\n	</div>\r\n	<div class=\"social link\" style=\"text-align: left;padding: 5px;\">\r\n        <a class=\"fb_link\" onclick=\"tweetToTwteer();\" href=\"javascript:void(0);\">\r\n            <img width=\"125\" border=\"0\" src=\"../../../../uploads/social_icon/post_tweet.png\" alt=\"Post to Twitter\" title=\"Post to twitter\">\r\n        </a>\r\n		<a class=\"fb_link\" onclick=\"faceToFacebook();\" href=\"javascript:void(0);\">\r\n            <img width=\"125\" border=\"0\" src=\"../../../../uploads/social_icon/post_fb.png\" alt=\"Post to Facebook\" title=\"Post to Facebook\">\r\n        </a>\r\n    </div>\r\n    <div class=\"SocialDFooter\" style=\"text-align: left;padding: 5px;\">\r\n        You need to disable all popup blockers\r\n    </div> \r\n</div>\r\n<div class=\"socialInner\" style=\"min-height: 237px;float:left;padding:10px; width:20%;\"></div>\r\n<div style=\"clear:both;\"></div>\r\n</div>',1);
/*!40000 ALTER TABLE `app_offer_template` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `app_pardco_code_code`
--

DROP TABLE IF EXISTS `app_pardco_code_code`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `app_pardco_code_code` (
  `code_code_id` int(25) NOT NULL AUTO_INCREMENT,
  `code_type_master_id` int(25) NOT NULL,
  `code_code` varchar(255) NOT NULL,
  `code_value` varchar(255) NOT NULL,
  `code_order` int(25) NOT NULL,
  `is_active` enum('Y','N') NOT NULL DEFAULT 'Y',
  PRIMARY KEY (`code_code_id`),
  UNIQUE KEY `code_code` (`code_code`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `app_pardco_code_code`
--

LOCK TABLES `app_pardco_code_code` WRITE;
/*!40000 ALTER TABLE `app_pardco_code_code` DISABLE KEYS */;
INSERT INTO `app_pardco_code_code` VALUES (1,1,'1','Verified',1,'Y'),(2,1,'0','Unverified',2,'Y'),(3,7,'monthly','Monthly',1,'Y'),(4,7,'helf_yearly','Helf yearly',2,'Y'),(5,7,'yearly','Yearly',3,'Y');
/*!40000 ALTER TABLE `app_pardco_code_code` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `app_pardco_code_type_master`
--

DROP TABLE IF EXISTS `app_pardco_code_type_master`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `app_pardco_code_type_master` (
  `code_type_master_id` int(25) NOT NULL AUTO_INCREMENT,
  `code` varchar(255) NOT NULL,
  `place` text,
  `is_active` enum('1','0') NOT NULL DEFAULT '1',
  PRIMARY KEY (`code_type_master_id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `app_pardco_code_type_master`
--

LOCK TABLES `app_pardco_code_type_master` WRITE;
/*!40000 ALTER TABLE `app_pardco_code_type_master` DISABLE KEYS */;
INSERT INTO `app_pardco_code_type_master` VALUES (1,'Customer_Status','Required for status dropdown','1'),(2,'IndustryType','Required in Organization registration in both admin and user panel','1'),(3,'Degree','Required in user registration in both admin and user panel','1'),(4,'Major','Required in user registration in both admin and user panel','1'),(5,'Event Type','Required in Calender Manager in admin panel','1'),(6,'Job Type','Required in Opportunity Manager in admin panel','1'),(7,'Billing Cycle','in supper admin','1');
/*!40000 ALTER TABLE `app_pardco_code_type_master` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `app_password_manager`
--

DROP TABLE IF EXISTS `app_password_manager`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `app_password_manager` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_type` int(11) NOT NULL COMMENT '1=>Customer; 2=>Employee; 3=>Local admin; 4=>System redistributor; 5->System head administrator',
  `register_from` int(11) NOT NULL COMMENT '1=>admin,2=>self,3=>google,4=>facebook',
  `facebook_uid` varchar(255) NOT NULL DEFAULT '0',
  `user_name` varchar(255) DEFAULT NULL,
  `user_name_enc` text,
  `password` varchar(255) NOT NULL,
  `f_password` varchar(255) NOT NULL,
  `user_email` varchar(255) NOT NULL,
  `encription_key` text,
  `approval_status` int(25) NOT NULL DEFAULT '4',
  `email_veri_status` int(2) NOT NULL,
  `user_status` int(5) NOT NULL DEFAULT '1',
  `date_creation` date NOT NULL,
  `date_modified` date NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `app_password_manager`
--

LOCK TABLES `app_password_manager` WRITE;
/*!40000 ALTER TABLE `app_password_manager` DISABLE KEYS */;
INSERT INTO `app_password_manager` VALUES (1,5,1,'0','bookient','','superbookient','','notreal@bookient.com','',4,1,1,'2015-06-10','2015-06-10');
/*!40000 ALTER TABLE `app_password_manager` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `app_payment_gateways`
--

DROP TABLE IF EXISTS `app_payment_gateways`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `app_payment_gateways` (
  `payment_gateways_id` int(11) NOT NULL AUTO_INCREMENT,
  `payment_gateways_name` varchar(255) NOT NULL,
  `type` int(2) NOT NULL DEFAULT '1' COMMENT '0->SuperAdmin; 1->Local Admin;2->Both',
  `date` date NOT NULL,
  `payment_gateways_order` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  PRIMARY KEY (`payment_gateways_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `app_payment_gateways`
--

LOCK TABLES `app_payment_gateways` WRITE;
/*!40000 ALTER TABLE `app_payment_gateways` DISABLE KEYS */;
INSERT INTO `app_payment_gateways` VALUES (1,'PayPal',2,'2012-07-27',1,1),(2,'Google Wallet',2,'2014-06-04',6,1),(3,'Paytrail',2,'2014-06-04',2,1);
/*!40000 ALTER TABLE `app_payment_gateways` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `app_payment_gateways_fields`
--

DROP TABLE IF EXISTS `app_payment_gateways_fields`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `app_payment_gateways_fields` (
  `payment_gateways_fields_id` int(11) NOT NULL AUTO_INCREMENT,
  `payment_gateways_id` int(11) NOT NULL,
  `field_name` varchar(255) NOT NULL,
  `field_type` varchar(255) NOT NULL DEFAULT 'text',
  `status` varchar(1) NOT NULL COMMENT '1=>enableed; 0=>Disabled;',
  PRIMARY KEY (`payment_gateways_fields_id`),
  KEY `payment_gateways_id` (`payment_gateways_id`),
  CONSTRAINT `app_payment_gateways_fields_ibfk_2` FOREIGN KEY (`payment_gateways_id`) REFERENCES `app_payment_gateways` (`payment_gateways_id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `app_payment_gateways_fields`
--

LOCK TABLES `app_payment_gateways_fields` WRITE;
/*!40000 ALTER TABLE `app_payment_gateways_fields` DISABLE KEYS */;
INSERT INTO `app_payment_gateways_fields` VALUES (1,1,'API Username','text','1'),(2,1,'API Password','text','1'),(3,1,'API Signature','text','1');
/*!40000 ALTER TABLE `app_payment_gateways_fields` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `app_payment_gateways_superadmn_values`
--

DROP TABLE IF EXISTS `app_payment_gateways_superadmn_values`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `app_payment_gateways_superadmn_values` (
  `payment_gateways_values_id` int(11) NOT NULL AUTO_INCREMENT,
  `payment_gateways_id` int(11) NOT NULL,
  `payment_gateways_fields_id` int(11) NOT NULL,
  `superadmn_id` int(11) NOT NULL,
  `payment_gateways_values` varchar(255) NOT NULL,
  `date_added` date NOT NULL,
  `date_modified` date NOT NULL,
  PRIMARY KEY (`payment_gateways_values_id`),
  KEY `payment_gateways_id` (`payment_gateways_id`),
  KEY `payment_gateways_fields_id` (`payment_gateways_fields_id`),
  KEY `local_admin_id` (`superadmn_id`),
  CONSTRAINT `fk_app_payment_gateways_superadmn_fields_id` FOREIGN KEY (`payment_gateways_fields_id`) REFERENCES `app_payment_gateways_fields` (`payment_gateways_fields_id`),
  CONSTRAINT `fk_app_payment_gateways_superadmn_values_payment_gateways_id` FOREIGN KEY (`payment_gateways_id`) REFERENCES `app_payment_gateways` (`payment_gateways_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `app_payment_gateways_superadmn_values`
--

LOCK TABLES `app_payment_gateways_superadmn_values` WRITE;
/*!40000 ALTER TABLE `app_payment_gateways_superadmn_values` DISABLE KEYS */;
INSERT INTO `app_payment_gateways_superadmn_values` VALUES (1,1,1,2,'aa@aa.aa','2012-10-11','2012-10-11');
/*!40000 ALTER TABLE `app_payment_gateways_superadmn_values` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `app_payment_gateways_values`
--

DROP TABLE IF EXISTS `app_payment_gateways_values`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `app_payment_gateways_values` (
  `payment_gateways_values_id` int(11) NOT NULL AUTO_INCREMENT,
  `payment_gateways_id` int(11) NOT NULL,
  `payment_gateways_fields_id` int(11) NOT NULL,
  `local_admin_id` int(11) NOT NULL,
  `payment_gateways_values` varchar(255) NOT NULL,
  `date_added` date NOT NULL,
  `date_modified` date NOT NULL,
  PRIMARY KEY (`payment_gateways_values_id`),
  KEY `payment_gateways_id` (`payment_gateways_id`),
  KEY `payment_gateways_fields_id` (`payment_gateways_fields_id`),
  KEY `local_admin_id` (`local_admin_id`),
  CONSTRAINT `app_payment_gateways_values_ibfk_1` FOREIGN KEY (`payment_gateways_id`) REFERENCES `app_payment_gateways` (`payment_gateways_id`) ON DELETE CASCADE,
  CONSTRAINT `app_payment_gateways_values_ibfk_2` FOREIGN KEY (`payment_gateways_fields_id`) REFERENCES `app_payment_gateways_fields` (`payment_gateways_fields_id`) ON DELETE CASCADE,
  CONSTRAINT `app_payment_gateways_values_ibfk_3` FOREIGN KEY (`local_admin_id`) REFERENCES `app_local_admin` (`local_admin_id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `app_payment_gateways_values`
--

LOCK TABLES `app_payment_gateways_values` WRITE;
/*!40000 ALTER TABLE `app_payment_gateways_values` DISABLE KEYS */;
/*!40000 ALTER TABLE `app_payment_gateways_values` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `app_plan_feature_allocation`
--

DROP TABLE IF EXISTS `app_plan_feature_allocation`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `app_plan_feature_allocation` (
  `plan_id` int(20) NOT NULL,
  `feature_id` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `app_plan_feature_allocation`
--

LOCK TABLES `app_plan_feature_allocation` WRITE;
/*!40000 ALTER TABLE `app_plan_feature_allocation` DISABLE KEYS */;
/*!40000 ALTER TABLE `app_plan_feature_allocation` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `app_pre_booking_customer_details`
--

DROP TABLE IF EXISTS `app_pre_booking_customer_details`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `app_pre_booking_customer_details` (
  `pre_booking_id` int(11) NOT NULL AUTO_INCREMENT,
  `pre_booking_field_name` varchar(255) CHARACTER SET latin1 NOT NULL,
  `pre_booking_field_value` varchar(255) CHARACTER SET latin1 NOT NULL,
  `customer_id` int(25) NOT NULL,
  `local_admin_id` int(25) NOT NULL,
  `booking_id` int(25) NOT NULL,
  PRIMARY KEY (`pre_booking_id`),
  KEY `app_pre_booking_customer_details_booking_id` (`booking_id`),
  KEY `fk_app_pre_booking_customer_details_local_admin_id` (`local_admin_id`),
  CONSTRAINT `app_pre_booking_customer_details_booking_id` FOREIGN KEY (`booking_id`) REFERENCES `app_booking` (`booking_id`),
  CONSTRAINT `fk_app_pre_booking_customer_details_local_admin_id` FOREIGN KEY (`local_admin_id`) REFERENCES `app_password_manager` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `app_pre_booking_customer_details`
--

LOCK TABLES `app_pre_booking_customer_details` WRITE;
/*!40000 ALTER TABLE `app_pre_booking_customer_details` DISABLE KEYS */;
/*!40000 ALTER TABLE `app_pre_booking_customer_details` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `app_preserve_variable`
--

DROP TABLE IF EXISTS `app_preserve_variable`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `app_preserve_variable` (
  `preserve_id` int(11) NOT NULL AUTO_INCREMENT,
  `preserve_variable` text,
  `preserve_session` varchar(255) NOT NULL DEFAULT '',
  `preserve_date` date NOT NULL DEFAULT '0000-00-00',
  PRIMARY KEY (`preserve_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `app_preserve_variable`
--

LOCK TABLES `app_preserve_variable` WRITE;
/*!40000 ALTER TABLE `app_preserve_variable` DISABLE KEYS */;
/*!40000 ALTER TABLE `app_preserve_variable` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `app_profession`
--

DROP TABLE IF EXISTS `app_profession`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `app_profession` (
  `profession_id` int(11) NOT NULL AUTO_INCREMENT,
  `profession_name` varchar(255) NOT NULL,
  `is_active` enum('Y','N') NOT NULL DEFAULT 'Y',
  `profession_order` int(11) NOT NULL,
  PRIMARY KEY (`profession_id`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `app_profession`
--

LOCK TABLES `app_profession` WRITE;
/*!40000 ALTER TABLE `app_profession` DISABLE KEYS */;
INSERT INTO `app_profession` VALUES (1,'Empty Field','N',4),(2,'Beta Testaaja','N',5),(3,'IT Professional','N',6),(4,'3','N',7),(5,'Parturikampaamo','Y',8),(6,'5','N',9),(7,'5','N',10),(8,'5','N',11),(9,'Autokoulu','Y',12),(10,'Beauty Salon','Y',1),(11,'Dentist','Y',3),(12,'Nail Salon','Y',2),(13,'Mainostoimisto','Y',13),(14,'Projektipäällikkö','Y',14),(15,'Training Centre','Y',15),(16,'Kotikoirien trimmaus, Parturi-Kampaaja','Y',16),(17,'Atk-Tilaus','Y',17),(18,'Atk','Y',18),(19,'Verkkokauppa asiakaspalvelu','Y',19),(20,'yksityinen','Y',20),(21,'hieroja','Y',21),(22,'Coaching','Y',22),(23,'Hoitohuone My Green Today','Y',23),(24,'Koirakoulu ja koirahieronta','Y',24),(25,'Kuvastudio','Y',25),(26,'Company','Y',26),(27,'Jalkojen terveyshoito','Y',27);
/*!40000 ALTER TABLE `app_profession` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `app_promo_type`
--

DROP TABLE IF EXISTS `app_promo_type`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `app_promo_type` (
  `promo_type_id` int(11) NOT NULL AUTO_INCREMENT,
  `promo_type_name` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `promo_type_status` enum('0','1') COLLATE latin1_general_ci NOT NULL DEFAULT '0',
  PRIMARY KEY (`promo_type_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `app_promo_type`
--

LOCK TABLES `app_promo_type` WRITE;
/*!40000 ALTER TABLE `app_promo_type` DISABLE KEYS */;
INSERT INTO `app_promo_type` VALUES (1,'Tomorrow','1'),(2,'Day after tomorrow','1'),(3,'Specific date','1'),(4,'Specific range of dates','1');
/*!40000 ALTER TABLE `app_promo_type` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `app_promotion_message`
--

DROP TABLE IF EXISTS `app_promotion_message`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `app_promotion_message` (
  `message_id` int(11) NOT NULL AUTO_INCREMENT,
  `local_admin_id` int(11) NOT NULL,
  `facebook_msg_body` text NOT NULL,
  `twitter_msg_body` text NOT NULL,
  PRIMARY KEY (`message_id`),
  KEY `fk_app_promotion_message_local_admin_id` (`local_admin_id`),
  CONSTRAINT `fk_app_promotion_message_local_admin_id` FOREIGN KEY (`local_admin_id`) REFERENCES `app_password_manager` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `app_promotion_message`
--

LOCK TABLES `app_promotion_message` WRITE;
/*!40000 ALTER TABLE `app_promotion_message` DISABLE KEYS */;
/*!40000 ALTER TABLE `app_promotion_message` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `app_regions`
--

DROP TABLE IF EXISTS `app_regions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `app_regions` (
  `region_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `country_id` bigint(20) NOT NULL,
  `region_code` varchar(100) CHARACTER SET latin1 NOT NULL,
  `region_name` varchar(100) CHARACTER SET latin1 NOT NULL,
  `is_actives` enum('Y','N') CHARACTER SET latin1 NOT NULL,
  `region_order` int(11) NOT NULL,
  PRIMARY KEY (`region_id`),
  KEY `country_id` (`country_id`),
  CONSTRAINT `app_regions_ibfk_1` FOREIGN KEY (`country_id`) REFERENCES `app_countries` (`country_id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `app_regions`
--

LOCK TABLES `app_regions` WRITE;
/*!40000 ALTER TABLE `app_regions` DISABLE KEYS */;
INSERT INTO `app_regions` VALUES (1,68,'FI-AL','Ahvenanmaan lääni','Y',8),(2,68,'FI-ES','Etelä-Suomen lääni','Y',9),(3,68,'FI-IS','Itä-Suomen lääni','Y',11),(4,68,'FI-OL','Oulun Lääni','Y',6),(5,68,'FI-LL','Lapin Lääni','Y',7),(6,68,'FI-LS','Länsi-Suomen lääni','Y',10),(7,223,'10021','State of New York','Y',12);
/*!40000 ALTER TABLE `app_regions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `app_review`
--

DROP TABLE IF EXISTS `app_review`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `app_review` (
  `review_id` int(11) NOT NULL AUTO_INCREMENT,
  `local_admin_id` int(11) NOT NULL,
  `comments` text NOT NULL,
  `posted_by` int(11) NOT NULL COMMENT 'customer id',
  `srvDtls_id` int(11) NOT NULL COMMENT 'Booking details Id',
  `service_id` int(11) NOT NULL,
  `staff_id` int(11) NOT NULL,
  `is_approve` enum('1','0') NOT NULL DEFAULT '1',
  `rating` int(2) NOT NULL,
  `posted_on` datetime NOT NULL,
  PRIMARY KEY (`review_id`),
  KEY `app_review_srvDtls_id` (`srvDtls_id`),
  KEY `app_review_service_id` (`service_id`),
  KEY `fk_app_review_local_admin_id` (`local_admin_id`),
  KEY `fk_app_review_staff_id` (`staff_id`),
  CONSTRAINT `app_review_service_id` FOREIGN KEY (`service_id`) REFERENCES `app_service` (`service_id`),
  CONSTRAINT `app_review_srvDtls_id` FOREIGN KEY (`srvDtls_id`) REFERENCES `app_booking_service_details` (`srvDtls_id`),
  CONSTRAINT `fk_app_review_local_admin_id` FOREIGN KEY (`local_admin_id`) REFERENCES `app_password_manager` (`user_id`),
  CONSTRAINT `fk_app_review_staff_id` FOREIGN KEY (`staff_id`) REFERENCES `app_employee` (`employee_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `app_review`
--

LOCK TABLES `app_review` WRITE;
/*!40000 ALTER TABLE `app_review` DISABLE KEYS */;
/*!40000 ALTER TABLE `app_review` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `app_review_report`
--

DROP TABLE IF EXISTS `app_review_report`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `app_review_report` (
  `review_id` int(11) NOT NULL AUTO_INCREMENT,
  `local_admin_id` int(11) NOT NULL,
  `booking_id` int(11) NOT NULL,
  `booking_service_id` int(11) NOT NULL,
  `review_request_sent_date` date NOT NULL,
  `review_request_sent_time` time NOT NULL,
  `review_request_sent_to` varchar(40) NOT NULL,
  `review_text` text NOT NULL,
  `review_text_date` date NOT NULL,
  `review_text_time` time NOT NULL,
  `status` varchar(10) NOT NULL COMMENT '1-> Pending; 0-> Active',
  `url-encode` varchar(40) NOT NULL,
  `customer_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`review_id`),
  KEY `app_review_report_customer_id` (`customer_id`),
  KEY `app_review_report_booking_id` (`booking_id`),
  CONSTRAINT `app_review_report_booking_id` FOREIGN KEY (`booking_id`) REFERENCES `app_booking` (`booking_id`),
  CONSTRAINT `app_review_report_customer_id` FOREIGN KEY (`customer_id`) REFERENCES `app_password_manager` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `app_review_report`
--

LOCK TABLES `app_review_report` WRITE;
/*!40000 ALTER TABLE `app_review_report` DISABLE KEYS */;
/*!40000 ALTER TABLE `app_review_report` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `app_service`
--

DROP TABLE IF EXISTS `app_service`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `app_service` (
  `service_id` int(11) NOT NULL AUTO_INCREMENT,
  `category_id` int(11) NOT NULL,
  `local_admin_id` int(11) NOT NULL,
  `service_name` varchar(200) DEFAULT NULL,
  `service_cost` decimal(10,2) NOT NULL,
  `no_cost` enum('Y','N') NOT NULL DEFAULT 'N',
  `service_duration` varchar(11) NOT NULL,
  `service_duration_unit` enum('M','H') NOT NULL DEFAULT 'M',
  `service_duration_min` int(25) NOT NULL,
  `service_capacity` int(11) NOT NULL,
  `service_description` mediumtext NOT NULL,
  `service_tags` mediumtext NOT NULL,
  `is_hide` enum('Y','N') NOT NULL DEFAULT 'N' COMMENT 'For hiding a service from customer',
  `is_active` enum('Y','N') NOT NULL DEFAULT 'N',
  `date_added` date NOT NULL,
  `date_edited` date NOT NULL,
  PRIMARY KEY (`service_id`),
  KEY `local_admin_id` (`local_admin_id`),
  KEY `category_id` (`category_id`),
  CONSTRAINT `app_service_ibfk_1` FOREIGN KEY (`local_admin_id`) REFERENCES `app_local_admin` (`local_admin_id`) ON DELETE CASCADE,
  CONSTRAINT `app_service_ibfk_2` FOREIGN KEY (`category_id`) REFERENCES `app_service_category` (`category_id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `app_service`
--

LOCK TABLES `app_service` WRITE;
/*!40000 ALTER TABLE `app_service` DISABLE KEYS */;
/*!40000 ALTER TABLE `app_service` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `app_service_category`
--

DROP TABLE IF EXISTS `app_service_category`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `app_service_category` (
  `category_id` int(11) NOT NULL AUTO_INCREMENT,
  `category_name` varchar(200) NOT NULL,
  `local_admin_id` int(11) NOT NULL,
  `is_active` enum('Y','N') NOT NULL DEFAULT 'Y',
  `date_added` date NOT NULL,
  `date_edited` date NOT NULL,
  PRIMARY KEY (`category_id`),
  KEY `local_admin_id` (`local_admin_id`)
) ENGINE=InnoDB AUTO_INCREMENT=132 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `app_service_category`
--

LOCK TABLES `app_service_category` WRITE;
/*!40000 ALTER TABLE `app_service_category` DISABLE KEYS */;
/*!40000 ALTER TABLE `app_service_category` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `app_sms_data`
--

DROP TABLE IF EXISTS `app_sms_data`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `app_sms_data` (
  `sms_id` int(11) NOT NULL AUTO_INCREMENT,
  `message_id` varchar(255) NOT NULL,
  `message_type` int(1) NOT NULL COMMENT '1=Complite,2=Failed,3=Authentication failure',
  `local_admin_id` int(11) NOT NULL,
  `msg_sent_date_time` datetime NOT NULL,
  `sent_to` enum('admin','staff','user') NOT NULL,
  `phone_no` varchar(25) NOT NULL,
  `message` text NOT NULL,
  `event` varchar(255) NOT NULL,
  PRIMARY KEY (`sms_id`),
  KEY `fk_app_sms_data_local_admin_id` (`local_admin_id`),
  CONSTRAINT `fk_app_sms_data_local_admin_id` FOREIGN KEY (`local_admin_id`) REFERENCES `app_password_manager` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `app_sms_data`
--

LOCK TABLES `app_sms_data` WRITE;
/*!40000 ALTER TABLE `app_sms_data` DISABLE KEYS */;
/*!40000 ALTER TABLE `app_sms_data` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `app_staff_settings`
--

DROP TABLE IF EXISTS `app_staff_settings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `app_staff_settings` (
  `app_staff_settings_id` int(11) NOT NULL AUTO_INCREMENT,
  `staff_id` int(11) NOT NULL,
  `is_active` int(1) NOT NULL DEFAULT '1',
  `logIntoTheSystem` int(1) NOT NULL DEFAULT '1',
  `chooseACalendarView` int(1) NOT NULL DEFAULT '1',
  `creatCustomer` int(1) NOT NULL DEFAULT '1',
  `VerifyCustomerAccount` int(1) NOT NULL DEFAULT '1',
  `resetCustomerAccountPassword` int(1) NOT NULL DEFAULT '1',
  `inviteCustomerForOnlineScheduling` int(1) NOT NULL DEFAULT '1',
  `editCustomerAccount` int(1) NOT NULL DEFAULT '1',
  `addTagsToCustomerAccount` int(1) NOT NULL DEFAULT '1',
  `readNdEditFAQ` int(1) NOT NULL DEFAULT '1',
  `setWorkingTime` int(1) NOT NULL DEFAULT '1',
  `setAppointmentStatus` int(1) NOT NULL DEFAULT '1',
  `editAppointment` int(1) NOT NULL DEFAULT '1',
  `cancelAppointment` int(1) NOT NULL DEFAULT '1',
  `viewAppointment` int(1) NOT NULL DEFAULT '1',
  `askReviewFromCustomer` int(1) NOT NULL DEFAULT '1',
  `exportToGoogleCalendar` int(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`app_staff_settings_id`),
  KEY `fk_app_staff_settings_staff_id` (`staff_id`),
  CONSTRAINT `fk_app_staff_settings_staff_id` FOREIGN KEY (`staff_id`) REFERENCES `app_employee` (`employee_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `app_staff_settings`
--

LOCK TABLES `app_staff_settings` WRITE;
/*!40000 ALTER TABLE `app_staff_settings` DISABLE KEYS */;
/*!40000 ALTER TABLE `app_staff_settings` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `app_staff_unavailable`
--

DROP TABLE IF EXISTS `app_staff_unavailable`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `app_staff_unavailable` (
  `employee_id` int(11) NOT NULL,
  `block_date` date NOT NULL,
  `date_added` datetime NOT NULL,
  PRIMARY KEY (`employee_id`,`block_date`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `app_staff_unavailable`
--

LOCK TABLES `app_staff_unavailable` WRITE;
/*!40000 ALTER TABLE `app_staff_unavailable` DISABLE KEYS */;
/*!40000 ALTER TABLE `app_staff_unavailable` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `app_staff_unavailable_time`
--

DROP TABLE IF EXISTS `app_staff_unavailable_time`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `app_staff_unavailable_time` (
  `unavailable_time_id` int(11) NOT NULL AUTO_INCREMENT,
  `employee_id` int(11) NOT NULL,
  `time_form` time NOT NULL,
  `time_to` time NOT NULL,
  `date` date NOT NULL,
  `continuation_id` int(11) NOT NULL,
  `date_added` datetime NOT NULL,
  `date_edited` datetime NOT NULL,
  PRIMARY KEY (`unavailable_time_id`),
  KEY `fk_app_staff_unavailable_time_employee_id` (`employee_id`),
  CONSTRAINT `fk_app_staff_unavailable_time_employee_id` FOREIGN KEY (`employee_id`) REFERENCES `app_employee` (`employee_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `app_staff_unavailable_time`
--

LOCK TABLES `app_staff_unavailable_time` WRITE;
/*!40000 ALTER TABLE `app_staff_unavailable_time` DISABLE KEYS */;
/*!40000 ALTER TABLE `app_staff_unavailable_time` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `app_superadmin_details`
--

DROP TABLE IF EXISTS `app_superadmin_details`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `app_superadmin_details` (
  `organisation_name` varchar(255) NOT NULL,
  `address` text NOT NULL,
  `city_id` int(10) NOT NULL,
  `region_id` int(10) NOT NULL,
  `country_id` int(10) NOT NULL,
  `phone_no` varchar(20) NOT NULL,
  `fax` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `app_superadmin_details`
--

LOCK TABLES `app_superadmin_details` WRITE;
/*!40000 ALTER TABLE `app_superadmin_details` DISABLE KEYS */;
INSERT INTO `app_superadmin_details` VALUES ('Pardco Group','Tapionkatu 4 B 14',2,6,68,'020 729 9840','020 729 9841');
/*!40000 ALTER TABLE `app_superadmin_details` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `app_superadmin_gen_setting`
--

DROP TABLE IF EXISTS `app_superadmin_gen_setting`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `app_superadmin_gen_setting` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `item_name` varchar(40) NOT NULL,
  `item_val` text NOT NULL,
  `status` int(2) NOT NULL COMMENT '0-inactive; 1->active',
  `date` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `app_superadmin_gen_setting`
--

LOCK TABLES `app_superadmin_gen_setting` WRITE;
/*!40000 ALTER TABLE `app_superadmin_gen_setting` DISABLE KEYS */;
INSERT INTO `app_superadmin_gen_setting` VALUES (1,'currency_id','2',1,'2014-08-01');
/*!40000 ALTER TABLE `app_superadmin_gen_setting` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `app_superadmin_share_link`
--

DROP TABLE IF EXISTS `app_superadmin_share_link`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `app_superadmin_share_link` (
  `superadmin_link_id` int(11) NOT NULL AUTO_INCREMENT,
  `superadmin_facebook` text NOT NULL,
  `superadmin_google` text NOT NULL,
  `superadmin_youtube` text NOT NULL,
  `superadmin_twitter` text NOT NULL,
  `superadmin_linkedin` text NOT NULL,
  PRIMARY KEY (`superadmin_link_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `app_superadmin_share_link`
--

LOCK TABLES `app_superadmin_share_link` WRITE;
/*!40000 ALTER TABLE `app_superadmin_share_link` DISABLE KEYS */;
INSERT INTO `app_superadmin_share_link` VALUES (1,'www.facebook.com','www.google.com','www.youtube.com','www.twitter.com','www.linkedIn.com');
/*!40000 ALTER TABLE `app_superadmin_share_link` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `app_tax_local_admin`
--

DROP TABLE IF EXISTS `app_tax_local_admin`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `app_tax_local_admin` (
  `tax_local_admin_setting_id` int(11) NOT NULL AUTO_INCREMENT,
  `local_admin_id` int(11) NOT NULL,
  `tax_master_id` int(11) NOT NULL COMMENT '0, if not in list entered',
  `tax_rate` float(10,2) NOT NULL,
  `not_in_list_title` varchar(255) NOT NULL COMMENT 'if, tax_master_id=0; not in list title will be stored here',
  `date_added` date NOT NULL,
  `date_edited` date NOT NULL,
  `status` int(11) NOT NULL COMMENT '0->Inactive, 1->active',
  PRIMARY KEY (`tax_local_admin_setting_id`),
  UNIQUE KEY ` 	local_admin_id` (`local_admin_id`,`tax_master_id`,`not_in_list_title`),
  KEY `fk_app_tax_local_admin_tax_master_id` (`tax_master_id`),
  CONSTRAINT `fk_app_tax_local_admin_tax_master_id` FOREIGN KEY (`tax_master_id`) REFERENCES `app_tax_master` (`tax_master_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `app_tax_local_admin`
--

LOCK TABLES `app_tax_local_admin` WRITE;
/*!40000 ALTER TABLE `app_tax_local_admin` DISABLE KEYS */;
/*!40000 ALTER TABLE `app_tax_local_admin` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `app_tax_master`
--

DROP TABLE IF EXISTS `app_tax_master`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `app_tax_master` (
  `tax_master_id` int(11) NOT NULL AUTO_INCREMENT,
  `tax_title` varchar(255) NOT NULL,
  `date_added` date NOT NULL,
  `date_edited` date NOT NULL,
  `tax_master_order` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  PRIMARY KEY (`tax_master_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `app_tax_master`
--

LOCK TABLES `app_tax_master` WRITE;
/*!40000 ALTER TABLE `app_tax_master` DISABLE KEYS */;
INSERT INTO `app_tax_master` VALUES (1,'Service Tax','2012-08-27','2013-06-07',1,1),(2,'Value added tax','2012-08-27','2014-06-04',2,1),(3,'Wealth tax','2014-06-04','0000-00-00',3,1),(4,'Sales tax','2014-06-04','0000-00-00',4,1),(5,'Direct tax','2014-06-04','0000-00-00',5,1),(6,'Income Tax','2014-06-04','0000-00-00',6,1);
/*!40000 ALTER TABLE `app_tax_master` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `app_temp_booking`
--

DROP TABLE IF EXISTS `app_temp_booking`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `app_temp_booking` (
  `temp_id` int(25) NOT NULL AUTO_INCREMENT,
  `service_id` int(25) NOT NULL,
  `staff_id` int(25) NOT NULL,
  `booking_date` date NOT NULL,
  `booking_time` time NOT NULL,
  `customer_id` int(25) NOT NULL,
  `delete_time` datetime NOT NULL,
  `insert_time` datetime NOT NULL,
  PRIMARY KEY (`temp_id`),
  KEY `app_temp_booking_customer_id` (`customer_id`),
  CONSTRAINT `app_temp_booking_customer_id` FOREIGN KEY (`customer_id`) REFERENCES `app_password_manager` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=145 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `app_temp_booking`
--

LOCK TABLES `app_temp_booking` WRITE;
/*!40000 ALTER TABLE `app_temp_booking` DISABLE KEYS */;
/*!40000 ALTER TABLE `app_temp_booking` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `app_temp_data`
--

DROP TABLE IF EXISTS `app_temp_data`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `app_temp_data` (
  `id` int(25) NOT NULL AUTO_INCREMENT,
  `item` text NOT NULL,
  `val` text NOT NULL,
  `datetime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `app_temp_data`
--

LOCK TABLES `app_temp_data` WRITE;
/*!40000 ALTER TABLE `app_temp_data` DISABLE KEYS */;
/*!40000 ALTER TABLE `app_temp_data` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `app_time_format`
--

DROP TABLE IF EXISTS `app_time_format`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `app_time_format` (
  `time_format_id` int(11) NOT NULL AUTO_INCREMENT,
  `time_format` varchar(50) NOT NULL,
  `is_active` enum('Y','N') NOT NULL DEFAULT 'Y',
  PRIMARY KEY (`time_format_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `app_time_format`
--

LOCK TABLES `app_time_format` WRITE;
/*!40000 ALTER TABLE `app_time_format` DISABLE KEYS */;
INSERT INTO `app_time_format` VALUES (1,'12:00','Y'),(2,'24:00','Y');
/*!40000 ALTER TABLE `app_time_format` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `app_time_zone`
--

DROP TABLE IF EXISTS `app_time_zone`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `app_time_zone` (
  `time_zone_id` int(11) NOT NULL AUTO_INCREMENT,
  `time_zone_name` varchar(255) NOT NULL,
  `gmt_symbol` int(1) NOT NULL,
  `gmt_value` time NOT NULL,
  `is_active` enum('Y','N') NOT NULL,
  `time_zone_order` int(11) NOT NULL,
  PRIMARY KEY (`time_zone_id`)
) ENGINE=InnoDB AUTO_INCREMENT=147 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `app_time_zone`
--

LOCK TABLES `app_time_zone` WRITE;
/*!40000 ALTER TABLE `app_time_zone` DISABLE KEYS */;
INSERT INTO `app_time_zone` VALUES (1,'Calcutta, Chennai, Mumbai, Delhi',1,'05:30:00','Y',3),(2,'Dhaka, Astana',1,'06:00:00','Y',1),(3,'Perth',1,'08:00:00','Y',2),(4,'Midway Island',0,'11:00:00','Y',4),(5,'Hawai',0,'10:00:00','Y',5),(6,'Tahiti',0,'10:00:00','Y',6),(7,'Alaska',0,'09:10:00','Y',7),(8,'Pacific Time (US & Canada)',0,'08:00:00','Y',8),(9,'Tijuana',0,'08:00:00','Y',9),(10,'Chihuahua',0,'07:00:00','Y',10),(11,'Baja Sur, Mexico',0,'07:00:00','Y',11),(12,'Mazatlan',0,'07:00:00','Y',12),(13,'Arizona',0,'07:00:00','Y',13),(14,'Mountain Time (US & Canada)',0,'07:00:00','Y',14),(15,'Pacific Daylight Time (US & Canada)',0,'07:00:00','Y',15),(16,'Mountain Daylight Time',0,'06:00:00','Y',16),(17,'San Jose',0,'06:00:00','Y',17),(18,'Central Time (US & Canada)',0,'06:00:00','Y',18),(19,'Mexico City',0,'06:00:00','Y',19),(20,'Monterrey',0,'06:00:00','Y',20),(21,'Saskatchewan, Canada',0,'06:00:00','Y',21),(22,'Bogota',0,'05:00:00','Y',22),(23,'Lima, Quito',0,'05:00:00','Y',23),(24,'Eastern Time (US & Canada)',0,'05:00:00','Y',24),(25,'Indiana (East)',0,'05:00:00','Y',25),(26,'Central Daylight Time',0,'05:00:00','Y',26),(27,'Eastern Standard Time(EST)',0,'05:00:00','Y',27),(28,'Venezuelan Standard Time',0,'04:30:00','Y',28),(29,'Caracas',0,'04:30:00','Y',29),(30,'La Paz, Bolivia',0,'04:00:00','Y',30),(31,'Santiago',0,'04:00:00','Y',31),(32,'Atlantic Time (Canada)',0,'04:00:00','Y',32),(33,'Atlantic Standard Time (Philipsburg)',0,'04:00:00','Y',33),(34,'Atlantic Standard Time (Curacao)',0,'04:00:00','Y',34),(35,'Eastern Daylight Savings',0,'04:00:00','Y',35),(36,'Saint Kitts and Nevis',0,'04:00:00','Y',36),(37,'Atlantic Standard Time(AST)',0,'04:00:00','Y',37),(38,'Newfoundland',0,'03:30:00','Y',38),(39,'Sao Paulo, Buenos Aires, Georgetown',0,'03:00:00','Y',39),(40,'Montevideo',0,'03:00:00','Y',40),(41,'Buenos Aires',0,'03:00:00','Y',41),(42,'Azores',0,'01:00:00','Y',42),(43,'Cape Verde Is',0,'01:00:00','Y',43),(44,'Casablanca',0,'00:00:00','Y',44),(45,'Dublin',0,'00:00:00','Y',45),(46,'Lisbon',0,'00:00:00','Y',46),(47,'London, Edinburgh',0,'00:00:00','Y',47),(48,'Monrovia',0,'00:00:00','Y',48),(49,'Western European Standard Time(WET)',0,'00:00:00','Y',49),(50,'Gambia Standard Time',0,'00:00:00','Y',50),(51,'British Summer Time(BST)',1,'01:00:00','N',51),(52,'West Africa Time(WAT)',0,'01:00:00','N',52),(53,'Central European Time (CET)',1,'01:00:00','N',53),(54,'Amsterdam',1,'01:00:00','N',54),(55,'Belgrade',1,'01:00:00','N',55),(56,'Berlin, Bern',1,'01:00:00','N',56),(57,'Bratislava',1,'01:00:00','N',57),(58,'Brussels',1,'01:00:00','N',58),(59,'Budapest',1,'01:00:00','N',59),(60,'Copenhagen',1,'01:00:00','N',60),(61,'Ljubljana',1,'01:00:00','N',61),(62,'Madrid',1,'01:00:00','N',62),(63,'Paris',1,'01:00:00','N',63),(64,'Prague',1,'01:00:00','N',64),(65,'Rome',1,'01:00:00','N',65),(66,'Sarajevo',1,'01:00:00','N',66),(67,'Skopje',1,'01:00:00','N',67),(68,'Stockholm',1,'01:00:00','N',68),(69,'Vienna',1,'01:00:00','N',69),(70,'Warsaw',1,'01:00:00','N',70),(71,'Zagreb',1,'01:00:00','N',71),(72,'Athens',1,'02:00:00','N',72),(73,'Bucharest',1,'02:00:00','N',73),(74,'Cairo',1,'02:00:00','N',74),(75,'Cairo',1,'02:00:00','N',75),(76,'Johannesburg, Harare',1,'02:00:00','N',76),(77,'Helsinki',1,'02:00:00','Y',77),(78,'Istanbul',1,'02:00:00','N',78),(79,'Jerusalem',1,'02:00:00','N',79),(80,'Kyiv',1,'02:00:00','N',80),(81,'Riga',1,'02:00:00','N',81),(82,'Sofia',1,'02:00:00','N',82),(83,'Tallinn',1,'02:00:00','N',83),(84,'Vilnius',1,'02:00:00','N',84),(85,'Central European Summer Time (CEST)',1,'02:00:00','N',85),(86,'East Africa Time(EAT)',1,'03:00:00','N',86),(87,'Manama',1,'03:00:00','N',87),(88,'Kaliningrad Time',1,'03:00:00','N',88),(89,'Eastern European Summer Time',1,'03:00:00','N',89),(90,'Doha',1,'03:00:00','N',90),(91,'Baghdad',1,'03:00:00','N',91),(92,'Kuwait',1,'03:00:00','N',92),(93,'Nairobi',1,'03:00:00','N',93),(94,'Riyadh',1,'03:00:00','N',94),(95,'Minsk',1,'03:00:00','N',95),(96,'Tehran',1,'03:30:00','N',96),(97,'Abu Dhabi',1,'04:00:00','N',97),(98,'Baku',1,'04:00:00','N',98),(99,'Muscat',1,'04:00:00','N',99),(100,'Tbilisi',1,'04:00:00','N',100),(101,'Yerevan',1,'04:00:00','N',101),(102,'Moscow, St. Petersburg, Volgograd',1,'04:00:00','N',102),(103,'Moscow Daylight Time',1,'04:00:00','N',103),(104,'Samara Time',1,'04:00:00','N',104),(105,'Kabul',1,'04:30:00','N',105),(106,'Karachi, Islamabad',1,'05:00:00','N',106),(107,'Tashkent',1,'05:00:00','N',107),(108,'Sri Lanka Time(SLT)',1,'05:30:00','N',108),(109,'Nepal Time (NPT)',1,'05:45:00','N',109),(110,'Almaty',1,'06:00:00','N',110),(111,'Novosibirsk',1,'06:00:00','N',111),(112,'Ekaterinburg',1,'06:00:00','N',112),(113,'Rangoon',1,'06:30:00','N',113),(114,'Bangkok, Hanoi',1,'07:00:00','N',114),(115,'Jakarta',1,'07:00:00','N',115),(116,'Krasnoyarsk',1,'08:00:00','N',116),(117,'Beijing, Chongqing',1,'08:00:00','N',117),(118,'Hong Kong, Manila',1,'08:00:00','N',118),(119,'Kuala Lumpur',1,'08:00:00','N',119),(120,'Perth',1,'08:00:00','N',120),(121,'Singapore',1,'08:00:00','N',121),(122,'Taipei',1,'08:00:00','N',122),(123,'Ulaan Bataar',1,'08:00:00','N',123),(124,'Urumqi',1,'08:00:00','N',124),(125,'Osaka, Sapporo, Japan',1,'09:00:00','N',125),(126,'Seoul',1,'09:00:00','N',126),(127,'Tokyo',0,'09:00:00','Y',127),(128,'Irkutsk',1,'09:00:00','N',128),(129,'Adelaide',1,'09:30:00','N',129),(130,'Darwin',1,'09:30:00','N',130),(131,'Brisbane',1,'10:00:00','N',131),(132,'Canberra',1,'10:00:00','N',132),(133,'Guam, Port Moresby',1,'10:00:00','N',133),(134,'Hobart',1,'10:00:00','N',134),(135,'Melbourne',1,'10:00:00','N',135),(136,'Sydney',1,'10:00:00','N',136),(137,'Yakutsk',1,'10:00:00','N',137),(138,'Vladivostok Time',1,'11:00:00','N',138),(139,'Magadan Time',1,'12:00:00','N',139),(140,'Kamchatka Time',1,'12:00:00','N',140),(141,'Auckland, Wellington)',0,'12:00:00','N',141),(142,'Fiji',1,'12:00:00','N',142),(143,'Samoa',1,'13:00:00','N',143),(144,'Eastern European Time Zone',1,'02:00:00','Y',144),(145,'Finland',1,'02:00:00','N',145),(146,'Helsinki (Summer)',1,'03:00:00','Y',146);
/*!40000 ALTER TABLE `app_time_zone` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `app_webinfo`
--

DROP TABLE IF EXISTS `app_webinfo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `app_webinfo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` text NOT NULL,
  `content` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `app_webinfo`
--

LOCK TABLES `app_webinfo` WRITE;
/*!40000 ALTER TABLE `app_webinfo` DISABLE KEYS */;
/*!40000 ALTER TABLE `app_webinfo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `appointment_no_show_graph`
--

DROP TABLE IF EXISTS `appointment_no_show_graph`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `appointment_no_show_graph` (
  `info_date` varchar(255) NOT NULL,
  `booking_cnt` varchar(255) NOT NULL,
  `no_show_cnt` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `appointment_no_show_graph`
--

LOCK TABLES `appointment_no_show_graph` WRITE;
/*!40000 ALTER TABLE `appointment_no_show_graph` DISABLE KEYS */;
/*!40000 ALTER TABLE `appointment_no_show_graph` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cron_schedule`
--

DROP TABLE IF EXISTS `cron_schedule`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cron_schedule` (
  `schedule_id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT 'Schedule Id',
  `job_code` varchar(255) NOT NULL DEFAULT '0' COMMENT 'Job Code',
  `user_data` text,
  `status` varchar(7) NOT NULL DEFAULT 'pending' COMMENT 'Status',
  `messages` text COMMENT 'Messages',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT 'Created At',
  `scheduled_at` timestamp NULL DEFAULT NULL COMMENT 'Scheduled At',
  `executed_at` timestamp NULL DEFAULT NULL COMMENT 'Executed At',
  `finished_at` timestamp NULL DEFAULT NULL COMMENT 'Finished At',
  PRIMARY KEY (`schedule_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Cron Schedule';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cron_schedule`
--

LOCK TABLES `cron_schedule` WRITE;
/*!40000 ALTER TABLE `cron_schedule` DISABLE KEYS */;
/*!40000 ALTER TABLE `cron_schedule` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `del_app_staff_unavailable`
--

DROP TABLE IF EXISTS `del_app_staff_unavailable`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `del_app_staff_unavailable` (
  `unavailable_id` int(11) NOT NULL AUTO_INCREMENT,
  `employee_id` int(11) NOT NULL,
  `date_serialize` text NOT NULL,
  `date_added` datetime NOT NULL,
  `date_edited` datetime NOT NULL,
  PRIMARY KEY (`unavailable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `del_app_staff_unavailable`
--

LOCK TABLES `del_app_staff_unavailable` WRITE;
/*!40000 ALTER TABLE `del_app_staff_unavailable` DISABLE KEYS */;
/*!40000 ALTER TABLE `del_app_staff_unavailable` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `delete_app_appoint_cancellation_policy`
--

DROP TABLE IF EXISTS `delete_app_appoint_cancellation_policy`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `delete_app_appoint_cancellation_policy` (
  `customize_id` int(11) NOT NULL AUTO_INCREMENT,
  `local_admin_id` int(11) NOT NULL,
  `cancellation_policy` text,
  `additional_info` text,
  `terms_condition` text,
  `confirm_booking_email_temp_id` int(11) NOT NULL,
  `confirm_booking_email_subject` text NOT NULL,
  `confirm_booking_email` text,
  `waiting_fr_approval_email_temp_id` int(11) NOT NULL,
  `waiting_fr_approval_email_subject` text NOT NULL,
  `waiting_fr_approval_email` text,
  `sent_after_service_email_temp_id` int(11) NOT NULL,
  `sent_after_service_email_subject` text NOT NULL,
  `sent_after_service_email` text,
  `reschedu_an_appoint_email_temp_id` int(11) NOT NULL,
  `reschedu_an_appoint_email_subject` text NOT NULL,
  `reschedu_an_appoint_email` text,
  `alert_before_appointment_email_temp_id` int(11) NOT NULL,
  `alert_before_appointment_email_subject` text NOT NULL,
  `alert_before_appointment_email` text,
  `alert_appointment_approval_email_temp_id` int(11) NOT NULL,
  `alert_appointment_approval_email_subject` text NOT NULL,
  `alert_appointment_approval_email` text,
  `appointment_cancellation_email_temp_id` int(11) NOT NULL,
  `appointment_cancellation_email_subject` text NOT NULL,
  `appointment_cancellation_email` text,
  `appointment_denial_email_temp_id` int(11) NOT NULL,
  `appointment_denial_email_subject` text NOT NULL,
  `appointment_denial_email` text,
  `login_detail_email_temp_id` int(11) NOT NULL,
  `login_detail_email_subject` text NOT NULL,
  `login_detail_email` text,
  `is_customize_form` enum('1','0') DEFAULT '0',
  `background_image_url` varchar(255) DEFAULT NULL,
  `widget_url` varchar(255) DEFAULT NULL,
  `facebook_page_url` varchar(255) DEFAULT NULL,
  `twitter_page_url` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`customize_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `delete_app_appoint_cancellation_policy`
--

LOCK TABLES `delete_app_appoint_cancellation_policy` WRITE;
/*!40000 ALTER TABLE `delete_app_appoint_cancellation_policy` DISABLE KEYS */;
/*!40000 ALTER TABLE `delete_app_appoint_cancellation_policy` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `graph_temp`
--

DROP TABLE IF EXISTS `graph_temp`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `graph_temp` (
  `info_date` varchar(255) NOT NULL,
  `booking_cnt` varchar(255) NOT NULL,
  `cancel_cnt` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `graph_temp`
--

LOCK TABLES `graph_temp` WRITE;
/*!40000 ALTER TABLE `graph_temp` DISABLE KEYS */;
/*!40000 ALTER TABLE `graph_temp` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pr_app_admin_menu`
--

DROP TABLE IF EXISTS `pr_app_admin_menu`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pr_app_admin_menu` (
  `admin_menu_id` int(20) NOT NULL AUTO_INCREMENT,
  `parent` int(20) NOT NULL,
  `menu_name` varchar(255) NOT NULL,
  `page_link` varchar(255) NOT NULL,
  `position` enum('L','R') NOT NULL DEFAULT 'L',
  `menu_authorization` int(11) NOT NULL COMMENT '1->super_admin,2->local_admin,3->fornt_end',
  `status` int(11) NOT NULL,
  `order` int(25) NOT NULL DEFAULT '0',
  `date_added` date NOT NULL,
  PRIMARY KEY (`admin_menu_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pr_app_admin_menu`
--

LOCK TABLES `pr_app_admin_menu` WRITE;
/*!40000 ALTER TABLE `pr_app_admin_menu` DISABLE KEYS */;
/*!40000 ALTER TABLE `pr_app_admin_menu` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Temporary table structure for view `vw_customerdetails`
--

DROP TABLE IF EXISTS `vw_customerdetails`;
/*!50001 DROP VIEW IF EXISTS `vw_customerdetails`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE TABLE `vw_customerdetails` (
  `user_id` tinyint NOT NULL,
  `date_inserted` tinyint NOT NULL,
  `country_name` tinyint NOT NULL,
  `city_name` tinyint NOT NULL,
  `region_name` tinyint NOT NULL,
  `user_email` tinyint NOT NULL,
  `cus_fname` tinyint NOT NULL,
  `customer_info` tinyint NOT NULL,
  `user_status` tinyint NOT NULL,
  `approval` tinyint NOT NULL,
  `time_zone_id` tinyint NOT NULL,
  `customer_tag` tinyint NOT NULL,
  `no_of_booking` tinyint NOT NULL,
  `register_from` tinyint NOT NULL,
  `cus_lname` tinyint NOT NULL,
  `cus_address` tinyint NOT NULL,
  `customer_status` tinyint NOT NULL,
  `cus_zip` tinyint NOT NULL,
  `cus_mob` tinyint NOT NULL,
  `cus_phn1` tinyint NOT NULL,
  `cus_phn2` tinyint NOT NULL
) ENGINE=MyISAM */;
SET character_set_client = @saved_cs_client;

--
-- Temporary table structure for view `vw_customerdetails_search`
--

DROP TABLE IF EXISTS `vw_customerdetails_search`;
/*!50001 DROP VIEW IF EXISTS `vw_customerdetails_search`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE TABLE `vw_customerdetails_search` (
  `user_id` tinyint NOT NULL,
  `cus_fname` tinyint NOT NULL,
  `cus_lname` tinyint NOT NULL,
  `cus_mob` tinyint NOT NULL,
  `cus_phn1` tinyint NOT NULL,
  `cus_phn2` tinyint NOT NULL
) ENGINE=MyISAM */;
SET character_set_client = @saved_cs_client;

--
-- Dumping routines for database 'bookient'
--
/*!50003 DROP FUNCTION IF EXISTS `conver_epoc` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = '' */ ;
DELIMITER ;;
CREATE DEFINER=`bookient`@`localhost` FUNCTION `conver_epoc`(
	in_time_stamp INT, 
	my_ind char(1)
) RETURNS int(11)
BEGIN
   DECLARE dist INT(11);
   DECLARE res INT(11) DEFAULT 0;
   SET dist = TIMESTAMPDIFF(second,utc_timestamp(), now());
   IF my_ind = '+' THEN
       SET res = in_time_stamp-dist;
   ELSE
          SET res = in_time_stamp+dist;
   END IF;
   RETURN res;
   END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP FUNCTION IF EXISTS `getCustomerId` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = '' */ ;
DELIMITER ;;
CREATE DEFINER=`bookient`@`localhost` FUNCTION `getCustomerId`(in_customer_id INT) RETURNS int(10) unsigned
BEGIN

 
 RETURN in_customer_id;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `bookingDetails` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = '' */ ;
DELIMITER ;;
CREATE DEFINER=`bookient`@`localhost` PROCEDURE `bookingDetails`(
	IN locl_admin INT,
	IN time_zone varchar(15),
	IN in_string_data varchar(255),
	IN in_start_data varchar(255))
BEGIN

   DECLARE li_booking_id,
       li_customer_id INT;
   DECLARE lt_booking_date_time DATETIME;
   DECLARE ls_total_tax varchar(100);
   DECLARE ls_discount_amnt varchar(100);
   DECLARE ls_grand_total varchar(100);
   DECLARE ls_prepayment_amount  varchar(100);
   DECLARE ls_grand_sub_cost varchar(100);
   DECLARE ls_discount_coupon_dtls varchar(100);
   DECLARE ls_tax_dtls_arr varchar(100);
   DECLARE ls_prepayment_details varchar(100);
   DECLARE ls_comment varchar(255);
   DECLARE first_cursor boolean;
   DECLARE temp_booking_id INT;
       DECLARE ls_currency_id INT;
       
   
   DECLARE bookingTab_cursor CURSOR FOR


           SELECT    
               booking_id,
               customer_id,
                               currency_id,
               ADDTIME(booking_date_time,time_zone) booking_date_time,
               booking_sub_total,
               booking_disc_amount,
               booking_disc_coupon_details,
               booking_total_tax,
               booking_tax_dtls_arr,
               booking_grnd_total,
               booking_prepayment_amount,
               booking_prepayment_details,
               booking_comment
           FROM    
               app_booking
           WHERE    
               booking_is_deleted = '0'
               AND
               local_admin_id = locl_admin
           ORDER BY
               booking_id;

   DECLARE continue handler for not found set first_cursor = true;
OPEN bookingTab_cursor;

DROP TEMPORARY TABLE IF EXISTS app_temp_booking;

CREATE TEMPORARY TABLE IF NOT EXISTS `app_temp_booking` (
                       `booking_id` int(11) NOT NULL,
                       `customer_id` int(11) NOT NULL,
                                               `currency_id` int(11) NOT NULL,
                       `booking_date_time` DATETIME NOT NULL,
                       `booking_sub_total` varchar(100) NOT NULL,
                       `booking_disc_amount` varchar(100) NOT NULL,
                       `booking_disc_coupon_details` varchar(255) NOT NULL,
                       `booking_total_tax` varchar(100) NOT NULL,
                       `booking_tax_dtls_arr` varchar(255) NOT NULL,
                       `booking_grnd_total` varchar(100) NOT NULL,
                       `booking_prepayment_amount` varchar(100) NOT NULL,
                       `booking_prepayment_details` varchar(255) NOT NULL,
                       `booking_comment` varchar(255) NOT NULL,
                       `srvDtls_id` int(11) NOT NULL,
                       `srvDtls_service_id` int(11) NOT NULL,
                       `srvDtls_service_name` varchar(255) NOT NULL,
                       `srvDtls_service_cost` varchar(100) NOT NULL,
                       `srvDtls_service_duration` int(11) NOT NULL,
                       `srvDtls_service_duration_unit` varchar(10) NOT NULL,
                       `srvDtls_service_start` DATETIME NOT NULL,
                       `srvDtls_service_end` DATETIME NOT NULL,
                       `srvDtls_employee_id` int(11) NOT NULL,
                       `srvDtls_employee_name` varchar(255) NOT NULL,
                       `srvDtls_booking_status` varchar(255) NOT NULL,
                       `srvDtls_status_date` DATETIME NOT NULL,
                       `srvDtls_service_quantity` int(11) NOT NULL,
                       `srvDtls_service_description` varchar(255) NOT NULL
                             ) ENGINE=HEAP DEFAULT CHARSET=latin1;

   curloop: loop

       fetch bookingTab_cursor into
                   li_booking_id,
                   li_customer_id,
                                       ls_currency_id,
                   lt_booking_date_time,
                   ls_grand_sub_cost,
                   ls_discount_amnt,
                   ls_discount_coupon_dtls,
                   ls_total_tax,
                   ls_tax_dtls_arr,
                   ls_grand_total,
                   ls_prepayment_amount,
                   ls_prepayment_details,
                   ls_comment ;

       if first_cursor then
           close bookingTab_cursor;
           set first_cursor = false;
           leave curloop;
       end if;
       SET temp_booking_id = li_booking_id ;
BLOCK2: BEGIN

   DECLARE srvLi_srvDtls_id,
       srvLi_srvDtls_service_id INT;
       DECLARE srvLs_srvDtls_service_name varchar(255);
   DECLARE srvLs_srvDtls_service_cost varchar(255);
   DECLARE srvLi_srvDtls_service_duration INT;
   DECLARE srvLs_srvDtls_service_duration_unit varchar(100);
   DECLARE srvLt_srvDtls_service_start DATETIME;
   DECLARE srvLt_srvDtls_service_end DATETIME;
   DECLARE srvLi_srvDtls_continuation_id INT;
   DECLARE srvLi_srvDtls_employee_id INT;
   DECLARE srvLs_srvDtls_employee_name varchar(100);
   DECLARE srvLi_srvDtls_booking_status INT;
   DECLARE srvLt_srvDtls_status_date DATETIME;
   DECLARE srvLi_srvDtls_service_quantity INT;
   DECLARE srvLi_rescheduled_child_id INT;
   DECLARE srvLs_srvDtls_service_description varchar(255);
   DECLARE inner_done boolean;
       DECLARE innerCursor CURSOR FOR


           SELECT
               srvDtls_id,
               srvDtls_service_id,
               srvDtls_service_name,
               srvDtls_service_cost,
               srvDtls_service_duration,
               srvDtls_service_duration_unit,
               ADDTIME(srvDtls_service_start,time_zone) srvDtls_service_start,
               ADDTIME(srvDtls_service_end,time_zone) srvDtls_service_end,
               srvDtls_employee_id,
               srvDtls_employee_name,
               srvDtls_booking_status,
               ADDTIME(srvDtls_status_date,time_zone) srvDtls_status_date,
               srvDtls_service_quantity,
               srvDtls_service_description
           FROM
               app_booking_service_details
           WHERE
               srvDtls_booking_id  = temp_booking_id
               AND
               srvDtls_rescheduled_child_id = 0
           ORDER BY
               srvDtls_id;


DECLARE CONTINUE HANDLER FOR NOT FOUND SET inner_done = TRUE;
OPEN innerCursor ;
   cur_inner_loop: LOOP

       FETCH FROM innerCursor INTO
                   srvLi_srvDtls_id,
                   srvLi_srvDtls_service_id,
                   srvLs_srvDtls_service_name,
                   srvLs_srvDtls_service_cost,
                   srvLi_srvDtls_service_duration,
                   srvLs_srvDtls_service_duration_unit,
                   srvLt_srvDtls_service_start,
                   srvLt_srvDtls_service_end,
                   srvLi_srvDtls_employee_id,
                   srvLs_srvDtls_employee_name,
                   srvLi_srvDtls_booking_status,
                   srvLt_srvDtls_status_date,
                   srvLi_srvDtls_service_quantity,
                   srvLs_srvDtls_service_description ;  

       
       IF inner_done THEN
           CLOSE innerCursor ;
           LEAVE cur_inner_loop;
       END IF;

   INSERT INTO
       app_temp_booking (
               booking_id,
               customer_id,
                               currency_id,
               booking_date_time,
               booking_sub_total,
               booking_disc_amount,
               booking_disc_coupon_details,
               booking_total_tax,
               booking_tax_dtls_arr,
               booking_grnd_total,
               booking_prepayment_amount,
               booking_prepayment_details,
               booking_comment,
               srvDtls_id,
               srvDtls_service_id,
               srvDtls_service_name,
               srvDtls_service_cost,
               srvDtls_service_duration,
               srvDtls_service_duration_unit,
               srvDtls_service_start,
               srvDtls_service_end,
               srvDtls_employee_id,
               srvDtls_employee_name,
               srvDtls_booking_status,
               srvDtls_status_date,
               srvDtls_service_quantity,
               srvDtls_service_description
               )values(
               li_booking_id,
               li_customer_id,
               ls_currency_id,
               lt_booking_date_time,
               ls_grand_sub_cost,
               ls_discount_amnt,
               ls_discount_coupon_dtls,
               ls_total_tax,
               ls_tax_dtls_arr,
               ls_grand_total,
               ls_prepayment_amount,
               ls_prepayment_details,
               ls_comment,
               srvLi_srvDtls_id,
               srvLi_srvDtls_service_id,
               srvLs_srvDtls_service_name,
               srvLs_srvDtls_service_cost,
               srvLi_srvDtls_service_duration,
               srvLs_srvDtls_service_duration_unit,
               srvLt_srvDtls_service_start,
               srvLt_srvDtls_service_end,
               srvLi_srvDtls_employee_id,
               srvLs_srvDtls_employee_name,
               srvLi_srvDtls_booking_status,
               srvLt_srvDtls_status_date,
               srvLi_srvDtls_service_quantity,
               srvLs_srvDtls_service_description        
               );

END LOOP cur_inner_loop;
END BLOCK2;
   end loop curloop;

   SET @sql_stmt = 'SELECT ';
   IF in_start_data ='' THEN
       SET  @sql_stmt = CONCAT(@sql_stmt,' * ');
   ELSE
       SET  @sql_stmt = CONCAT(@sql_stmt,' ',in_start_data ,' ');
   END IF;
   
   SET @sql_stmt = CONCAT(@sql_stmt,' FROM app_temp_booking WHERE 1=1 ');
   IF in_string_data !='' THEN
       SET @sql_stmt =  CONCAT(@sql_stmt,' ',in_string_data);
   END IF;
   PREPARE statementExecute FROM @sql_stmt;
   EXECUTE statementExecute;

   DROP TEMPORARY TABLE IF EXISTS app_temp_booking;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `convToLocal` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = '' */ ;
DELIMITER ;;
CREATE DEFINER=`bookient`@`localhost` PROCEDURE `convToLocal`(
	IN locl_admin INT,
	IN time_zone varchar(15),
	IN in_string_data varchar(255),
	IN in_start_data varchar(255)
)
BEGIN
    DECLARE my_biz_hours_id,my_service_id,my_local_admin_id, my_employee_id, my_day_id, my_continuation_id INT;
    DECLARE my_time_from, my_time_to TIME;
    DECLARE final_time_from, final_time_to TIME;
    DECLARE final_day_id INT;
    DECLARE finished boolean;
    DECLARE cnt INT DEFAULT 0;
    DECLARE first_value int;

     
   DECLARE cur_biz CURSOR FOR

   SELECT  
       biz_hours_id,
       service_id,
       local_admin_id,
       employee_id,
       day_id,
       ADDTIME(time_from,time_zone) time_from,
       ADDTIME(time_to,time_zone) time_to ,
       continuation_id
   FROM
       app_biz_hours
   WHERE
       continuation_id=0
       AND
       local_admin_id=locl_admin
   ORDER BY
       biz_hours_id;

   
   DECLARE continue handler for not found set finished = true;
OPEN cur_biz;

DROP TEMPORARY TABLE IF EXISTS app_biz_hours_temptable;

CREATE TEMPORARY TABLE IF NOT EXISTS `app_biz_hours_temptable` (
                                 `service_id` int(11) NOT NULL,
                                 `local_admin_id` int(11) NOT NULL,
                                 `employee_id` int(11) NOT NULL,
                                 `day_id` int(1) NOT NULL COMMENT '1-> Monday; 7->Sunday',
                                 `time_from` time NOT NULL,
                                 `time_to` time NOT NULL,
                                 `main_id` int(25) NOT NULL
                                 ) ENGINE=HEAP DEFAULT CHARSET=latin1;


   curloop: loop
     
   fetch cur_biz into
           my_biz_hours_id,
           my_service_id,
           my_local_admin_id,
           my_employee_id,
           my_day_id,
           my_time_from,
           my_time_to,
           my_continuation_id ;
     
   if finished then
       close cur_biz;
       set finished = false;
       leave curloop;
   end if;
   SET final_day_id = my_day_id;


BLOCK2: BEGIN
       DECLARE inner_done boolean;
       DECLARE  no_of_row INT DEFAULT 0;
       DECLARE  inner_time_from, inner_time_to TIME;
       DECLARE innerCursor CURSOR FOR
  
   SELECT
       ADDTIME(time_from,time_zone) time_from,
       ADDTIME(time_to,time_zone) time_to
   FROM
       app_biz_hours
   WHERE
       continuation_id  = my_biz_hours_id;

       
DECLARE CONTINUE HANDLER FOR NOT FOUND SET inner_done = TRUE;

OPEN innerCursor ;
   cur_inner_loop: LOOP
       FETCH FROM innerCursor INTO
                   inner_time_from,
                   inner_time_to ;  
       
       IF inner_done THEN
           CLOSE innerCursor ;
           LEAVE cur_inner_loop;
       END IF;
           SET  no_of_row = no_of_row +1;
   END LOOP cur_inner_loop;


   IF no_of_row =0 THEN
         SET final_time_from = my_time_from;
         SET final_time_to     =ADDTIME(CAST('00:00:01' as TIME),my_time_to);
    ELSE
         SET final_time_from = my_time_from;
         SET final_time_to     = ADDTIME(CAST('00:00:01' as TIME),inner_time_to);
    END IF;


   SET first_value = SUBSTRING_INDEX(final_time_from, ':', 1 );
   IF first_value < 0 THEN
       SET final_time_from  =  ADDTIME(CAST('24:00:00' as TIME),final_time_from);
       IF final_day_id =1 THEN
           SET  final_day_id = 7;
       ELSE
           SET final_day_id  = final_day_id -1;
       END IF;
   ELSEIF first_value > 24 THEN
       SET final_time_from  =  SUBTIME(final_time_from, CAST('24:00:00' as TIME));  
       IF final_day_id =7 THEN
           SET  final_day_id =1;
       ELSE
           SET final_day_id  = final_day_id +1;
       END IF;
   END IF;

   

   SET first_value = SUBSTRING_INDEX(final_time_to, ':', 1 );
   IF first_value < 0 THEN
       SET final_time_to  =  ADDTIME(CAST('24:00:00' as TIME),final_time_to);              
   ELSEIF first_value  > 24 THEN
       SET final_time_to  =  SUBTIME(final_time_to, CAST('24:00:00' as TIME));
   END IF;


   INSERT INTO
       app_biz_hours_temptable (
                   service_id,
                   local_admin_id,
                   employee_id,
                   day_id,
                   time_from,
                   time_to,
                   main_id)
   values
       (my_service_id,
       my_local_admin_id,
       my_employee_id,
       final_day_id ,
       final_time_from,
       final_time_to,
       my_biz_hours_id);

END BLOCK2;
      
end loop curloop;

   SET @sql_stmt = 'SELECT ';
   IF in_start_data ='' THEN
       SET  @sql_stmt = CONCAT(@sql_stmt,' * ');
   ELSE
       SET  @sql_stmt = CONCAT(@sql_stmt,' ',in_start_data ,' ');
   END IF;
   
   SET @sql_stmt = CONCAT(@sql_stmt,' FROM app_biz_hours_temptable WHERE 1=1 ');
   IF in_string_data !='' THEN
       SET @sql_stmt =  CONCAT(@sql_stmt,' ',in_string_data);
   END IF;
   PREPARE statementExecute FROM @sql_stmt;
   EXECUTE statementExecute;

   DROP TEMPORARY TABLE IF EXISTS app_biz_hours_temptable;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `delete_row_app_temp_booking` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = '' */ ;
DELIMITER ;;
CREATE DEFINER=`bookient`@`localhost` PROCEDURE `delete_row_app_temp_booking`()
BEGIN

   DELETE
   FROM app_temp_booking
   WHERE  TIMESTAMPDIFF(MINUTE, `time`, NOW()) < 1 ;

END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `getWorkTime` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = '' */ ;
DELIMITER ;;
CREATE DEFINER=`bookient`@`localhost` PROCEDURE `getWorkTime`(
	IN locl_admin INT,
	IN time_zone varchar(15),
	IN in_string_data varchar(255),
	IN in_start_data varchar(255)
)
BEGIN
    DECLARE my_service_duration_min,my_biz_hours_id,my_service_id,my_local_admin_id, my_employee_id, my_day_id, my_continuation_id INT;
    DECLARE my_time_from, my_time_to TIME;
    DECLARE final_time_from, final_time_to TIME;
    DECLARE final_day_id INT;
    DECLARE finished boolean;
    DECLARE cnt INT DEFAULT 0;
    DECLARE first_value int;

     
   DECLARE cur_biz CURSOR FOR

   SELECT  
       bh.biz_hours_id,
       ser.service_duration_min,
       bh.service_id,
       bh.local_admin_id,
       bh.employee_id,
       bh.day_id,
       ADDTIME(time_from,time_zone) time_from,
       ADDTIME(time_to,time_zone) time_to ,
       bh.continuation_id
   FROM
       app_biz_hours AS bh, app_service AS ser
   WHERE
       bh.continuation_id=0
   AND
       bh.local_admin_id=locl_admin
   AND
       ser.service_id=bh.service_id
   ORDER BY
       bh.biz_hours_id;

   
   DECLARE continue handler for not found set finished = true;
OPEN cur_biz;

DROP TEMPORARY TABLE IF EXISTS app_biz_hours_temptable;

CREATE TEMPORARY TABLE IF NOT EXISTS `app_biz_hours_temptable` (
                                 `service_id` int(11) NOT NULL,
                                 `service_duration_min` int(11) NOT NULL,
                                 `local_admin_id` int(11) NOT NULL,
                                 `employee_id` int(11) NOT NULL,
                                 `day_id` int(1) NOT NULL COMMENT '1-> Monday; 7->Sunday',
                                 `time_from` time NOT NULL,
                                 `time_to` time NOT NULL,
                                 `main_id` int(25) NOT NULL
                                 ) ENGINE=HEAP DEFAULT CHARSET=latin1;


   curloop: loop
     
   fetch cur_biz into
           my_biz_hours_id,
           my_service_duration_min,
           my_service_id,
           my_local_admin_id,
           my_employee_id,
           my_day_id,
           my_time_from,
           my_time_to,
           my_continuation_id ;
     
   if finished then
       close cur_biz;
       set finished = false;
       leave curloop;
   end if;
   SET final_day_id = my_day_id;


BLOCK2: BEGIN
       DECLARE inner_done boolean;
       DECLARE  no_of_row INT DEFAULT 0;
       DECLARE  inner_time_from, inner_time_to TIME;
       DECLARE innerCursor CURSOR FOR
  
   SELECT
       ADDTIME(time_from,time_zone) time_from,
       ADDTIME(time_to,time_zone) time_to
   FROM
       app_biz_hours
   WHERE
       continuation_id  = my_biz_hours_id;

       
DECLARE CONTINUE HANDLER FOR NOT FOUND SET inner_done = TRUE;

OPEN innerCursor ;
   cur_inner_loop: LOOP
       FETCH FROM innerCursor INTO
                   inner_time_from,
                   inner_time_to ;  
       
       IF inner_done THEN
           CLOSE innerCursor ;
           LEAVE cur_inner_loop;
       END IF;
           SET  no_of_row = no_of_row +1;
   END LOOP cur_inner_loop;


   IF no_of_row =0 THEN
         SET final_time_from = my_time_from;
         SET final_time_to     =ADDTIME(CAST('00:00:01' as TIME),my_time_to);
    ELSE
         SET final_time_from = my_time_from;
         SET final_time_to     = ADDTIME(CAST('00:00:01' as TIME),inner_time_to);
    END IF;


   SET first_value = SUBSTRING_INDEX(final_time_from, ':', 1 );
   IF first_value < 0 THEN
       SET final_time_from  =  ADDTIME(CAST('24:00:00' as TIME),final_time_from);
       IF final_day_id =1 THEN
           SET  final_day_id = 7;
       ELSE
           SET final_day_id  = final_day_id -1;
       END IF;
   ELSEIF first_value > 24 THEN
       SET final_time_from  =  SUBTIME(final_time_from, CAST('24:00:00' as TIME));  
       IF final_day_id =7 THEN
           SET  final_day_id =1;
       ELSE
           SET final_day_id  = final_day_id +1;
       END IF;
   END IF;

   

   SET first_value = SUBSTRING_INDEX(final_time_to, ':', 1 );
   IF first_value < 0 THEN
       SET final_time_to  =  ADDTIME(CAST('24:00:00' as TIME),final_time_to);              
   ELSEIF first_value  > 24 THEN
       SET final_time_to  =  SUBTIME(final_time_to, CAST('24:00:00' as TIME));
   END IF;


   INSERT INTO
       app_biz_hours_temptable (
                   service_id,
                   service_duration_min,
                   local_admin_id,
                   employee_id,
                   day_id,
                   time_from,
                   time_to,
                   main_id)
   values
       (my_service_id,
       my_service_duration_min,
       my_local_admin_id,
       my_employee_id,
       final_day_id ,
       final_time_from,
       final_time_to,
       my_biz_hours_id);

END BLOCK2;
      
end loop curloop;

   SET @sql_stmt = 'SELECT ';
   IF in_start_data ='' THEN
       SET  @sql_stmt = CONCAT(@sql_stmt,' * ');
   ELSE
       SET  @sql_stmt = CONCAT(@sql_stmt,' ',in_start_data ,' ');
   END IF;
   
   SET @sql_stmt = CONCAT(@sql_stmt,' FROM app_biz_hours_temptable WHERE 1=1 ');
   IF in_string_data !='' THEN
       SET @sql_stmt =  CONCAT(@sql_stmt,' ',in_string_data);
   END IF;
   PREPARE statementExecute FROM @sql_stmt;
   EXECUTE statementExecute;

   DROP TEMPORARY TABLE IF EXISTS app_biz_hours_temptable;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `mainBizScheduleFrontend` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = '' */ ;
DELIMITER ;;
CREATE DEFINER=`bookient`@`localhost` PROCEDURE `mainBizScheduleFrontend`(
	IN locl_admin INT,
	IN time_zone varchar(15),
	IN in_string_data varchar(255),
	IN in_start_data varchar(255)
)
BEGIN
    DECLARE my_biz_hours_id,my_service_id,my_local_admin_id, my_employee_id, my_day_id, my_continuation_id INT;
    DECLARE my_time_from, my_time_to TIME;
    DECLARE final_time_from, final_time_to TIME;
    DECLARE final_day_id INT;
    DECLARE finished boolean;
    DECLARE cnt INT DEFAULT 0;
    DECLARE first_value int;
    DECLARE duration int;
    DECLARE capacity int;

     
   DECLARE cur_biz CURSOR FOR

   SELECT  
       biz_hours_id,
       service_id,
       local_admin_id,
       employee_id,
       day_id,
       ADDTIME(time_from,time_zone) time_from,
       ADDTIME(time_to,time_zone) time_to ,
       continuation_id
   FROM
       app_biz_hours
   WHERE
       continuation_id=0
       AND
       local_admin_id=locl_admin
   ORDER BY
       biz_hours_id;

   
   DECLARE continue handler for not found set finished = true;
OPEN cur_biz;

DROP TEMPORARY TABLE IF EXISTS mainBizScheduleFrontendTmp;

CREATE TEMPORARY TABLE IF NOT EXISTS `mainBizScheduleFrontendTmp` (
                               `service_id` int(11) NOT NULL,
                               `local_admin_id` int(11) NOT NULL,
                               `employee_id` int(11) NOT NULL,
                               `day_id` int(1) NOT NULL COMMENT '1-> Monday; 7->Sunday',
                               `time_from` time NOT NULL,
                               `time_to` time NOT NULL,
                               `booking_capacity` int(11) NOT NULL,
                               `service_duration` int(11) NOT NULL,
                               `main_id` int(25) NOT NULL
                                 ) ENGINE=HEAP DEFAULT CHARSET=latin1;


   curloop: loop
     
   fetch cur_biz into
           my_biz_hours_id,
           my_service_id,
           my_local_admin_id,
           my_employee_id,
           my_day_id,
           my_time_from,
           my_time_to,
           my_continuation_id ;
     
   if finished then
       close cur_biz;
       set finished = false;
       leave curloop;
   end if;
   SET final_day_id = my_day_id;


BLOCK2: BEGIN
       DECLARE inner_done boolean;
       DECLARE  no_of_row INT DEFAULT 0;
       DECLARE  inner_time_from, inner_time_to TIME;
       DECLARE innerCursor CURSOR FOR
  
   SELECT
       ADDTIME(time_from,time_zone) time_from,
       ADDTIME(time_to,time_zone) time_to
   FROM
       app_biz_hours
   WHERE
       continuation_id  = my_biz_hours_id;

       
DECLARE CONTINUE HANDLER FOR NOT FOUND SET inner_done = TRUE;

OPEN innerCursor ;
   cur_inner_loop: LOOP
       FETCH FROM innerCursor INTO
                   inner_time_from,
                   inner_time_to ;  
       
       IF inner_done THEN
           CLOSE innerCursor ;
           LEAVE cur_inner_loop;
       END IF;
           SET  no_of_row = no_of_row +1;
   END LOOP cur_inner_loop;


   IF no_of_row =0 THEN
         SET final_time_from = my_time_from;
         SET final_time_to     =ADDTIME(CAST('00:00:01' as TIME),my_time_to);
    ELSE
         SET final_time_from = my_time_from;
         SET final_time_to     = ADDTIME(CAST('00:00:01' as TIME),inner_time_to);
    END IF;


   SET first_value = SUBSTRING_INDEX(final_time_from, ':', 1 );
   IF first_value < 0 THEN
       SET final_time_from  =  ADDTIME(CAST('24:00:00' as TIME),final_time_from);
       IF final_day_id =1 THEN
           SET  final_day_id = 7;
       ELSE
           SET final_day_id  = final_day_id -1;
       END IF;
   ELSEIF first_value > 24 THEN
       SET final_time_from  =  SUBTIME(final_time_from, CAST('24:00:00' as TIME));  
       IF final_day_id =7 THEN
           SET  final_day_id =1;
       ELSE
           SET final_day_id  = final_day_id +1;
       END IF;
   END IF;

   

   SET first_value = SUBSTRING_INDEX(final_time_to, ':', 1 );
   IF first_value < 0 THEN
       SET final_time_to  =  ADDTIME(CAST('24:00:00' as TIME),final_time_to);              
   ELSEIF first_value  > 24 THEN
       SET final_time_to  =  SUBTIME(final_time_to, CAST('24:00:00' as TIME));
   END IF;

BLOCK3: BEGIN

   DECLARE li_booking_capacity INT;
   DECLARE li_service_duration INT;
   DECLARE service_done boolean;
   DECLARE serviceCursor CURSOR FOR
   
   SELECT
       service_duration_min AS duration,
       service_capacity AS capacity
   FROM
       app_service
   WHERE
       service_id  = my_service_id;
DECLARE CONTINUE HANDLER FOR NOT FOUND SET service_done = TRUE;

OPEN serviceCursor ;
   service_loop: LOOP
       FETCH FROM serviceCursor INTO
                   li_service_duration,
                   li_booking_capacity ;  
       
       IF service_done THEN
           CLOSE serviceCursor ;
           LEAVE service_loop;
       END IF;
   END LOOP service_loop;
   SET duration = li_service_duration;
   SET capacity = li_booking_capacity;

END BLOCK3;


   INSERT INTO
       mainBizScheduleFrontendTmp (
                   service_id,
                   local_admin_id,
                   employee_id,
                   day_id,
                   time_from,
                   time_to,
                   booking_capacity,
                   service_duration,
                   main_id)
   values
       (my_service_id,
       my_local_admin_id,
       my_employee_id,
       final_day_id ,
       final_time_from,
       final_time_to,
       capacity,
       duration,            
       my_biz_hours_id);

END BLOCK2;
      
end loop curloop;

   SET @sql_stmt = 'SELECT ';
   IF in_start_data ='' THEN
       SET  @sql_stmt = CONCAT(@sql_stmt,' * ');
   ELSE
       SET  @sql_stmt = CONCAT(@sql_stmt,' ',in_start_data ,' ');
   END IF;
   
   SET @sql_stmt = CONCAT(@sql_stmt,' FROM mainBizScheduleFrontendTmp WHERE 1=1 ');
   IF in_string_data !='' THEN
       SET @sql_stmt =  CONCAT(@sql_stmt,' ',in_string_data);
   END IF;
   PREPARE statementExecute FROM @sql_stmt;
   EXECUTE statementExecute;

   DROP TEMPORARY TABLE IF EXISTS mainBizScheduleFrontendTmp;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `pardco_appointment_no_show_graph` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = '' */ ;
DELIMITER ;;
CREATE DEFINER=`bookient`@`localhost` PROCEDURE `pardco_appointment_no_show_graph`(
	IN from_date VARCHAR(255),
	IN to_date VARCHAR(255),
	IN local_admin_id VARCHAR(255)
)
BEGIN
       DECLARE info_date1 DATE;
       DECLARE info1 VARCHAR(250);
       DECLARE cnt1  INTEGER (11) UNSIGNED;
       DECLARE chkentry  INTEGER (11) UNSIGNED;
       
           DECLARE graphDone INT;
           DECLARE appointmentnoshowgraphcursor CURSOR FOR
        SELECT * FROM (
           (
           SELECT booking_date_time AS info_date, COUNT( * ) AS cnt, '1' AS info
           FROM app_booking
           WHERE booking_date_time >= from_date
           AND booking_date_time <= to_date
           AND local_admin_id = local_admin_id
           GROUP BY DATE_FORMAT( booking_date_time, '%Y-%m-%d' ) , info
           )
           UNION (
           SELECT no_show_date AS info_date, COUNT( * ) AS cnt, '0' AS info
           FROM app_booking_service
           WHERE no_show_date >= from_date
           AND no_show_date <= to_date
           AND local_admin_id = local_admin_id
           GROUP BY DATE_FORMAT( no_show_date, '%Y-%m-%d' ) , info
           )
           ) AS X ORDER BY info_date, info ASC;
       DECLARE CONTINUE HANDLER FOR NOT FOUND SET graphDone = 1;
       TRUNCATE TABLE appointment_no_show_graph;
       SET graphDone = 0;
       OPEN appointmentnoshowgraphcursor;
       graphIterator: LOOP
       FETCH appointmentnoshowgraphcursor INTO info_date1,cnt1,info1;
       IF 1 = graphDone THEN
           LEAVE graphIterator;
       END IF;
       BLOCK2: BEGIN
           
       SELECT COUNT(*) mycnt INTO chkentry FROM appointment_no_show_graph WHERE info_date = info_date1;
       IF(chkentry>0) THEN
            IF(info1=1)THEN
           UPDATE appointment_no_show_graph SET booking_cnt= cnt1 WHERE info_date = info_date1;
            ELSE
           UPDATE appointment_no_show_graph SET no_show_cnt= cnt1 WHERE info_date = info_date1;    
            END IF;    
       ELSE
           IF(info1=1)THEN
           INSERT INTO appointment_no_show_graph (info_date,booking_cnt) VALUES(info_date1,cnt1);
            ELSE
           INSERT INTO appointment_no_show_graph (info_date,no_show_cnt)  VALUES(info_date1,cnt1);    
            END IF;    
       END IF;    
           
       END BLOCK2;
       END LOOP graphIterator;
       CLOSE appointmentnoshowgraphcursor;
   END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `pardco_graph` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = '' */ ;
DELIMITER ;;
CREATE DEFINER=`bookient`@`localhost` PROCEDURE `pardco_graph`(
	IN from_date VARCHAR(255),
	IN to_date VARCHAR(255),
	IN local_admin_id VARCHAR(255)
)
BEGIN
           DECLARE info_date1 DATE;
       DECLARE info1 VARCHAR(250);
       DECLARE cnt1  INTEGER (11) UNSIGNED;
       DECLARE chkentry  INTEGER (11) UNSIGNED;
       
           DECLARE graphDone INT;
           DECLARE graphcursor CURSOR FOR
               SELECT * FROM (( SELECT booking_date_time AS info_date, COUNT( * ) AS cnt, '1' AS info
                   FROM app_booking
                   WHERE booking_date_time >= from_date
                   AND booking_date_time <= to_date
                   AND local_admin_id = local_admin_id
                   GROUP BY DATE_FORMAT( booking_date_time, '%Y-%m-%d' ) , info)
               UNION (
                   SELECT cancellation_date AS info_date, COUNT( * ) AS cnt, '0' AS info
                   FROM app_booking_service
                   WHERE cancellation_date >= from_date
                   AND cancellation_date <= to_date
                   AND local_admin_id = local_admin_id
                   GROUP BY DATE_FORMAT( cancellation_date, '%Y-%m-%d' ) , info
                     )
                   ) AS X  ORDER BY info_date, info;
                       
           DECLARE CONTINUE HANDLER FOR NOT FOUND SET graphDone = 1;
           TRUNCATE TABLE graph_temp;
           SET graphDone = 0;
           OPEN graphcursor;
           graphIterator: LOOP
               FETCH graphcursor INTO info_date1,cnt1,info1;
               IF 1 = graphDone THEN
                   LEAVE graphIterator;
               END IF;
       BLOCK2: BEGIN
           
       SELECT COUNT(*) mycnt INTO chkentry FROM graph_temp WHERE info_date = info_date1;
       IF(chkentry>0) THEN
            IF(info1=1)THEN
           UPDATE graph_temp SET booking_cnt= cnt1 WHERE info_date = info_date1;
            ELSE
               UPDATE graph_temp SET cancel_cnt= cnt1 WHERE info_date = info_date1;    
            END IF;    
       ELSE
           IF(info1=1)THEN
           INSERT INTO graph_temp (info_date,booking_cnt) VALUES(info_date1,cnt1);
            ELSE
               INSERT INTO graph_temp (info_date,cancel_cnt)  VALUES(info_date1,cnt1);    
            END IF;    
       END IF;    
           
       END BLOCK2;
           END LOOP graphIterator;
           CLOSE graphcursor;
                         
         
       END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `pardco_theme` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = '' */ ;
DELIMITER ;;
CREATE DEFINER=`bookient`@`localhost` PROCEDURE `pardco_theme`(
	IN user_id INT(5),
	OUT return_data VARCHAR(255)
)
BEGIN
   DECLARE themeData VARCHAR(255);
   DECLARE themeType VARCHAR(255);
   DECLARE themeCursor CURSOR FOR
   SELECT `theme` FROM `app_local_admin_gen_setting` WHERE `local_admin_id` = 6;                
   DECLARE CONTINUE HANDLER FOR NOT FOUND SET themeData = 1;
   SET themeData = 0;
   OPEN themeCursor;
   
   FETCH themeCursor INTO themeType;
        IF themeType = 'CCS' THEN
       BEGIN
       DECLARE themedetailsCursor CURSOR FOR
           SELECT * FROM `app_custom_color_scheme` WHERE `local_admin_id` = 0 AND `theme_name` = themeType;
       END;
        ELSE
       BEGIN
       DECLARE themedetailsCursor CURSOR FOR
           SELECT * FROM `app_custom_color_scheme` WHERE `local_admin_id` = user_id AND `theme_name` = themeType;
       END;
        END IF;
   
   CLOSE themeCursor;
           
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `reviewDetailsReport` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = '' */ ;
DELIMITER ;;
CREATE DEFINER=`bookient`@`localhost` PROCEDURE `reviewDetailsReport`(
	IN `locl_admin` int,
	IN `time_zone` varchar(15),
	IN `in_string_data` varchar(255),
	IN `in_start_data` varchar(255)
)
BEGIN

   DECLARE li_booking_id,
       li_customer_id INT;
   DECLARE lt_booking_date_time DATETIME;
   DECLARE ls_total_tax varchar(100);
   DECLARE ls_discount_amnt varchar(100);
   DECLARE ls_grand_total varchar(100);
   DECLARE ls_prepayment_amount  varchar(100);
   DECLARE ls_grand_sub_cost varchar(100);
   DECLARE ls_discount_coupon_dtls varchar(100);
   DECLARE ls_tax_dtls_arr varchar(100);
   DECLARE ls_prepayment_details varchar(100);
   DECLARE ls_comment varchar(255);
   DECLARE first_cursor boolean;
   DECLARE temp_booking_id INT;
       DECLARE ls_currency_id INT;
       
   
   DECLARE bookingTab_cursor CURSOR FOR


           SELECT    
               booking_id,
               customer_id,
                               currency_id,
               ADDTIME(booking_date_time,time_zone) booking_date_time,
               booking_sub_total,
               booking_disc_amount,
               booking_disc_coupon_details,
               booking_total_tax,
               booking_tax_dtls_arr,
               booking_grnd_total,
               booking_prepayment_amount,
               booking_prepayment_details,
               booking_comment
           FROM    
               app_booking
           WHERE    
               booking_is_deleted = '0'
               AND
               local_admin_id = locl_admin
           ORDER BY
               booking_id;

   DECLARE continue handler for not found set first_cursor = true;
OPEN bookingTab_cursor;

DROP TEMPORARY TABLE IF EXISTS app_temp_booking;

CREATE TEMPORARY TABLE IF NOT EXISTS `app_temp_booking_review` (
                       `booking_id` int(11) NOT NULL,
                       `customer_id` int(11) NOT NULL,
                                               `currency_id` int(11) NOT NULL,
                       `booking_date_time` DATETIME NOT NULL,
                       `booking_sub_total` varchar(100) NOT NULL,
                       `booking_disc_amount` varchar(100) NOT NULL,
                       `booking_disc_coupon_details` varchar(255) NOT NULL,
                       `booking_total_tax` varchar(100) NOT NULL,
                       `booking_tax_dtls_arr` varchar(255) NOT NULL,
                       `booking_grnd_total` varchar(100) NOT NULL,
                       `booking_prepayment_amount` varchar(100) NOT NULL,
                       `booking_prepayment_details` varchar(255) NOT NULL,
                       `booking_comment` varchar(255) NOT NULL,
                       `srvDtls_id` int(11) NOT NULL,
                       `srvDtls_service_id` int(11) NOT NULL,
                       `srvDtls_service_name` varchar(255) NOT NULL,
                       `srvDtls_service_cost` varchar(100) NOT NULL,
                       `srvDtls_service_duration` int(11) NOT NULL,
                       `srvDtls_service_duration_unit` varchar(10) NOT NULL,
                       `srvDtls_service_start` DATETIME NOT NULL,
                       `srvDtls_service_end` DATETIME NOT NULL,
                       `srvDtls_employee_id` int(11) NOT NULL,
                       `srvDtls_employee_name` varchar(255) NOT NULL,
                       `srvDtls_booking_status` varchar(255) NOT NULL,
                       `srvDtls_status_date` DATETIME NOT NULL,
                       `srvDtls_service_quantity` int(11) NOT NULL,
                       `srvDtls_service_description` varchar(255) NOT NULL
                             ) ENGINE=HEAP DEFAULT CHARSET=latin1;

   curloop: loop

       fetch bookingTab_cursor into
                   li_booking_id,
                   li_customer_id,
                                       ls_currency_id,
                   lt_booking_date_time,
                   ls_grand_sub_cost,
                   ls_discount_amnt,
                   ls_discount_coupon_dtls,
                   ls_total_tax,
                   ls_tax_dtls_arr,
                   ls_grand_total,
                   ls_prepayment_amount,
                   ls_prepayment_details,
                   ls_comment ;

       if first_cursor then
           close bookingTab_cursor;
           set first_cursor = false;
           leave curloop;
       end if;
       SET temp_booking_id = li_booking_id ;
BLOCK2: BEGIN

   DECLARE srvLi_srvDtls_id,
       srvLi_srvDtls_service_id INT;
       DECLARE srvLs_srvDtls_service_name varchar(255);
   DECLARE srvLs_srvDtls_service_cost varchar(255);
   DECLARE srvLi_srvDtls_service_duration INT;
   DECLARE srvLs_srvDtls_service_duration_unit varchar(100);
   DECLARE srvLt_srvDtls_service_start DATETIME;
   DECLARE srvLt_srvDtls_service_end DATETIME;
   DECLARE srvLi_srvDtls_continuation_id INT;
   DECLARE srvLi_srvDtls_employee_id INT;
   DECLARE srvLs_srvDtls_employee_name varchar(100);
   DECLARE srvLi_srvDtls_booking_status INT;
   DECLARE srvLt_srvDtls_status_date DATETIME;
   DECLARE srvLi_srvDtls_service_quantity INT;
   DECLARE srvLi_rescheduled_child_id INT;
   DECLARE srvLs_srvDtls_service_description varchar(255);
   DECLARE inner_done boolean;
       DECLARE innerCursor CURSOR FOR


           SELECT
               srvDtls_id,
               srvDtls_service_id,
               srvDtls_service_name,
               srvDtls_service_cost,
               srvDtls_service_duration,
               srvDtls_service_duration_unit,
               ADDTIME(srvDtls_service_start,time_zone) srvDtls_service_start,
               ADDTIME(srvDtls_service_end,time_zone) srvDtls_service_end,
               srvDtls_employee_id,
               srvDtls_employee_name,
               srvDtls_booking_status,
               ADDTIME(srvDtls_status_date,time_zone) srvDtls_status_date,
               srvDtls_service_quantity,
               srvDtls_service_description
           FROM
               app_booking_service_details
           WHERE
               srvDtls_booking_id  = temp_booking_id
               AND
               srvDtls_rescheduled_child_id = 0
           ORDER BY
               srvDtls_id;


DECLARE CONTINUE HANDLER FOR NOT FOUND SET inner_done = TRUE;
OPEN innerCursor ;
   cur_inner_loop: LOOP

       FETCH FROM innerCursor INTO
                   srvLi_srvDtls_id,
                   srvLi_srvDtls_service_id,
                   srvLs_srvDtls_service_name,
                   srvLs_srvDtls_service_cost,
                   srvLi_srvDtls_service_duration,
                   srvLs_srvDtls_service_duration_unit,
                   srvLt_srvDtls_service_start,
                   srvLt_srvDtls_service_end,
                   srvLi_srvDtls_employee_id,
                   srvLs_srvDtls_employee_name,
                   srvLi_srvDtls_booking_status,
                   srvLt_srvDtls_status_date,
                   srvLi_srvDtls_service_quantity,
                   srvLs_srvDtls_service_description ;  

       
       IF inner_done THEN
           CLOSE innerCursor ;
           LEAVE cur_inner_loop;
       END IF;

   INSERT INTO
       app_temp_booking_review (
               booking_id,
               customer_id,
                               currency_id,
               booking_date_time,
               booking_sub_total,
               booking_disc_amount,
               booking_disc_coupon_details,
               booking_total_tax,
               booking_tax_dtls_arr,
               booking_grnd_total,
               booking_prepayment_amount,
               booking_prepayment_details,
               booking_comment,
               srvDtls_id,
               srvDtls_service_id,
               srvDtls_service_name,
               srvDtls_service_cost,
               srvDtls_service_duration,
               srvDtls_service_duration_unit,
               srvDtls_service_start,
               srvDtls_service_end,
               srvDtls_employee_id,
               srvDtls_employee_name,
               srvDtls_booking_status,
               srvDtls_status_date,
               srvDtls_service_quantity,
               srvDtls_service_description
               )values(
               li_booking_id,
               li_customer_id,
               ls_currency_id,
               lt_booking_date_time,
               ls_grand_sub_cost,
               ls_discount_amnt,
               ls_discount_coupon_dtls,
               ls_total_tax,
               ls_tax_dtls_arr,
               ls_grand_total,
               ls_prepayment_amount,
               ls_prepayment_details,
               ls_comment,
               srvLi_srvDtls_id,
               srvLi_srvDtls_service_id,
               srvLs_srvDtls_service_name,
               srvLs_srvDtls_service_cost,
               srvLi_srvDtls_service_duration,
               srvLs_srvDtls_service_duration_unit,
               srvLt_srvDtls_service_start,
               srvLt_srvDtls_service_end,
               srvLi_srvDtls_employee_id,
               srvLs_srvDtls_employee_name,
               srvLi_srvDtls_booking_status,
               srvLt_srvDtls_status_date,
               srvLi_srvDtls_service_quantity,
               srvLs_srvDtls_service_description        
               );

END LOOP cur_inner_loop;
END BLOCK2;
   end loop curloop;

   SET @sql_stmt = 'SELECT ';
   IF in_start_data ='' THEN
       SET  @sql_stmt = CONCAT(@sql_stmt,' * ');
   ELSE
       SET  @sql_stmt = CONCAT(@sql_stmt,' ',in_start_data ,' ');
   END IF;
   
   SET @sql_stmt = CONCAT(@sql_stmt,' FROM app_temp_booking_review right join app_review ON app_temp_booking_review.srvDtls_id = app_review.srvDtls_id LEFT JOIN vw_customerdetails  ON app_temp_booking_review.customer_id =vw_customerdetails.user_id WHERE 1=1 ');
   
   
   IF in_string_data !='' THEN
       SET @sql_stmt =  CONCAT(@sql_stmt,' ',in_string_data);
   END IF;
   PREPARE statementExecute FROM @sql_stmt;
   EXECUTE statementExecute;

   DROP TEMPORARY TABLE IF EXISTS app_temp_booking_review;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_booking` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = '' */ ;
DELIMITER ;;
CREATE DEFINER=`bookient`@`localhost` PROCEDURE `sp_booking`(
	IN locl_admin INT,
	IN time_zone varchar(15),
	IN in_string_data varchar(255),
	IN in_start_data varchar(255)
)
BEGIN

   DECLARE li_booking_id,
       li_customer_id INT;
   DECLARE lt_booking_date_time DATETIME;
   DECLARE ls_total_tax varchar(100);
   DECLARE ls_discount_amnt varchar(100);
   DECLARE ls_grand_total varchar(100);
   DECLARE ls_prepayment_amount  varchar(100);
   DECLARE ls_grand_sub_cost varchar(100);
   DECLARE ls_discount_coupon_dtls varchar(100);
   DECLARE ls_tax_dtls_arr varchar(100);
   DECLARE ls_prepayment_details varchar(100);
   DECLARE ls_comment varchar(255);
   DECLARE first_cursor boolean;
   DECLARE temp_booking_id INT;
       DECLARE ls_currency_id INT;
       
   
   DECLARE bookingTab_cursor CURSOR FOR


           SELECT    
               booking_id,
               customer_id,
                               currency_id,
               ADDTIME(booking_date_time,time_zone) booking_date_time,
               booking_sub_total,
               booking_disc_amount,
               booking_disc_coupon_details,
               booking_total_tax,
               booking_tax_dtls_arr,
               booking_grnd_total,
               booking_prepayment_amount,
               booking_prepayment_details,
               booking_comment
           FROM    
               app_booking
           WHERE    
               booking_is_deleted = '0'
               AND
               local_admin_id = locl_admin
           ORDER BY
               booking_id;

   DECLARE continue handler for not found set first_cursor = true;
OPEN bookingTab_cursor;

DROP TEMPORARY TABLE IF EXISTS app_temp_booking;

CREATE TEMPORARY TABLE IF NOT EXISTS `app_temp_booking` (
                       `booking_id` int(11) NOT NULL,
                       `customer_id` int(11) NOT NULL,
                                               `currency_id` int(11) NOT NULL,
                       `booking_date_time` DATETIME NOT NULL,
                       `booking_sub_total` varchar(100) NOT NULL,
                       `booking_disc_amount` varchar(100) NOT NULL,
                       `booking_disc_coupon_details` varchar(255) NOT NULL,
                       `booking_total_tax` varchar(100) NOT NULL,
                       `booking_tax_dtls_arr` varchar(255) NOT NULL,
                       `booking_grnd_total` varchar(100) NOT NULL,
                       `booking_prepayment_amount` varchar(100) NOT NULL,
                       `booking_prepayment_details` varchar(255) NOT NULL,
                       `booking_comment` varchar(255) NOT NULL,
                       `srvDtls_id` int(11) NOT NULL,
                       `srvDtls_service_id` int(11) NOT NULL,
                       `srvDtls_service_name` varchar(255) NOT NULL,
                       `srvDtls_service_cost` varchar(100) NOT NULL,
                       `srvDtls_service_duration` int(11) NOT NULL,
                       `srvDtls_service_duration_unit` varchar(10) NOT NULL,
                       `srvDtls_service_start` DATETIME NOT NULL,
                       `srvDtls_service_end` DATETIME NOT NULL,
                       `srvDtls_employee_id` int(11) NOT NULL,
                       `srvDtls_employee_name` varchar(255) NOT NULL,
                       `srvDtls_booking_status` varchar(255) NOT NULL,
                       `srvDtls_status_date` DATETIME NOT NULL,
                       `srvDtls_service_quantity` int(11) NOT NULL,
                       `srvDtls_service_description` varchar(255) NOT NULL
                             ) ENGINE=HEAP DEFAULT CHARSET=latin1;

   curloop: loop

       fetch bookingTab_cursor into
                   li_booking_id,
                   li_customer_id,
                                       ls_currency_id,
                   lt_booking_date_time,
                   ls_grand_sub_cost,
                   ls_discount_amnt,
                   ls_discount_coupon_dtls,
                   ls_total_tax,
                   ls_tax_dtls_arr,
                   ls_grand_total,
                   ls_prepayment_amount,
                   ls_prepayment_details,
                   ls_comment ;

       if first_cursor then
           close bookingTab_cursor;
           set first_cursor = false;
           leave curloop;
       end if;
       SET temp_booking_id = li_booking_id ;
BLOCK2: BEGIN

   DECLARE srvLi_srvDtls_id,
       srvLi_srvDtls_service_id INT;
       DECLARE srvLs_srvDtls_service_name varchar(255);
   DECLARE srvLs_srvDtls_service_cost varchar(255);
   DECLARE srvLi_srvDtls_service_duration INT;
   DECLARE srvLs_srvDtls_service_duration_unit varchar(100);
   DECLARE srvLt_srvDtls_service_start DATETIME;
   DECLARE srvLt_srvDtls_service_end DATETIME;
   DECLARE srvLi_srvDtls_continuation_id INT;
   DECLARE srvLi_srvDtls_employee_id INT;
   DECLARE srvLs_srvDtls_employee_name varchar(100);
   DECLARE srvLi_srvDtls_booking_status INT;
   DECLARE srvLt_srvDtls_status_date DATETIME;
   DECLARE srvLi_srvDtls_service_quantity INT;
   DECLARE srvLi_rescheduled_child_id INT;
   DECLARE srvLs_srvDtls_service_description varchar(255);
   DECLARE inner_done boolean;
       DECLARE innerCursor CURSOR FOR


           SELECT
               srvDtls_id,
               srvDtls_service_id,
               srvDtls_service_name,
               srvDtls_service_cost,
               srvDtls_service_duration,
               srvDtls_service_duration_unit,
               ADDTIME(srvDtls_service_start,time_zone) srvDtls_service_start,
               ADDTIME(srvDtls_service_end,time_zone) srvDtls_service_end,
               srvDtls_employee_id,
               srvDtls_employee_name,
               srvDtls_booking_status,
               ADDTIME(srvDtls_status_date,time_zone) srvDtls_status_date,
               srvDtls_service_quantity,
               srvDtls_service_description
           FROM
               app_booking_service_details
           WHERE
               srvDtls_booking_id  = temp_booking_id
               AND
               srvDtls_rescheduled_child_id = 0
           ORDER BY
               srvDtls_id;


DECLARE CONTINUE HANDLER FOR NOT FOUND SET inner_done = TRUE;
OPEN innerCursor ;
   cur_inner_loop: LOOP

       FETCH FROM innerCursor INTO
                   srvLi_srvDtls_id,
                   srvLi_srvDtls_service_id,
                   srvLs_srvDtls_service_name,
                   srvLs_srvDtls_service_cost,
                   srvLi_srvDtls_service_duration,
                   srvLs_srvDtls_service_duration_unit,
                   srvLt_srvDtls_service_start,
                   srvLt_srvDtls_service_end,
                   srvLi_srvDtls_employee_id,
                   srvLs_srvDtls_employee_name,
                   srvLi_srvDtls_booking_status,
                   srvLt_srvDtls_status_date,
                   srvLi_srvDtls_service_quantity,
                   srvLs_srvDtls_service_description ;  

       
       IF inner_done THEN
           CLOSE innerCursor ;
           LEAVE cur_inner_loop;
       END IF;

   INSERT INTO
       app_temp_booking (
               booking_id,
               customer_id,
                               currency_id,
               booking_date_time,
               booking_sub_total,
               booking_disc_amount,
               booking_disc_coupon_details,
               booking_total_tax,
               booking_tax_dtls_arr,
               booking_grnd_total,
               booking_prepayment_amount,
               booking_prepayment_details,
               booking_comment,
               srvDtls_id,
               srvDtls_service_id,
               srvDtls_service_name,
               srvDtls_service_cost,
               srvDtls_service_duration,
               srvDtls_service_duration_unit,
               srvDtls_service_start,
               srvDtls_service_end,
               srvDtls_employee_id,
               srvDtls_employee_name,
               srvDtls_booking_status,
               srvDtls_status_date,
               srvDtls_service_quantity,
               srvDtls_service_description
               )values(
               li_booking_id,
               li_customer_id,
               ls_currency_id,
               lt_booking_date_time,
               ls_grand_sub_cost,
               ls_discount_amnt,
               ls_discount_coupon_dtls,
               ls_total_tax,
               ls_tax_dtls_arr,
               ls_grand_total,
               ls_prepayment_amount,
               ls_prepayment_details,
               ls_comment,
               srvLi_srvDtls_id,
               srvLi_srvDtls_service_id,
               srvLs_srvDtls_service_name,
               srvLs_srvDtls_service_cost,
               srvLi_srvDtls_service_duration,
               srvLs_srvDtls_service_duration_unit,
               srvLt_srvDtls_service_start,
               srvLt_srvDtls_service_end,
               srvLi_srvDtls_employee_id,
               srvLs_srvDtls_employee_name,
               srvLi_srvDtls_booking_status,
               srvLt_srvDtls_status_date,
               srvLi_srvDtls_service_quantity,
               srvLs_srvDtls_service_description        
               );

END LOOP cur_inner_loop;
END BLOCK2;
   end loop curloop;

   SET @sql_stmt = 'SELECT ';
   IF in_start_data ='' THEN
       SET  @sql_stmt = CONCAT(@sql_stmt,' * ');
   ELSE
       SET  @sql_stmt = CONCAT(@sql_stmt,' ',in_start_data ,' ');
   END IF;
   
   SET @sql_stmt = CONCAT(@sql_stmt,' FROM app_temp_booking WHERE 1=1 ');
   IF in_string_data !='' THEN
       SET @sql_stmt =  CONCAT(@sql_stmt,' ',in_string_data);
   END IF;
   PREPARE statementExecute FROM @sql_stmt;
   EXECUTE statementExecute;

   DROP TEMPORARY TABLE IF EXISTS app_temp_booking;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_report_booking_details` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = '' */ ;
DELIMITER ;;
CREATE DEFINER=`bookient`@`localhost` PROCEDURE `sp_report_booking_details`(
	IN locl_admin INT,
	IN time_zone varchar(15),
	IN in_string_data varchar(255),
	IN in_start_data varchar(255)
)
BEGIN
   DECLARE li_booking_id,
       li_customer_id INT;
   DECLARE lt_booking_date_time DATETIME;
   DECLARE ls_total_tax varchar(100);
   DECLARE ls_discount_amnt varchar(100);
   DECLARE ls_grand_total varchar(100);
   DECLARE ls_prepayment_amount  varchar(100);
   DECLARE ls_grand_sub_cost varchar(100);
   DECLARE ls_discount_coupon_dtls varchar(100);
   DECLARE ls_tax_dtls_arr varchar(100);
   DECLARE ls_prepayment_details varchar(100);
   DECLARE ls_comment varchar(255);
   DECLARE ls_added_by INT;
   DECLARE ls_booking_from INT;
   DECLARE first_cursor boolean;
   DECLARE temp_booking_id INT;
   DECLARE ls_currency_id INT;
           
   DECLARE bookingTab_cursor CURSOR FOR
           SELECT    
               booking_id,
               customer_id,
               currency_id,
               ADDTIME(booking_date_time,time_zone) booking_date_time,
               booking_sub_total,
               booking_disc_amount,
               booking_disc_coupon_details,
               booking_total_tax,
               booking_tax_dtls_arr,
               booking_grnd_total,
               booking_prepayment_amount,
               booking_prepayment_details,
               booking_comment,
               added_by,
               booking_from
           FROM    
               app_booking
           WHERE    
               booking_is_deleted = '0'
               AND
               local_admin_id = locl_admin
           ORDER BY
               booking_id;
   DECLARE continue handler for not found set first_cursor = true;
OPEN bookingTab_cursor;
DROP TEMPORARY TABLE IF EXISTS app_temp_booking_repo;

CREATE TEMPORARY TABLE IF NOT EXISTS `app_temp_booking_repo` (
                       `booking_id` int(11) NOT NULL,
                       `customer_id` int(11) NOT NULL,
                       `currency_id` int(11) NOT NULL,
                       `booking_date_time` DATETIME NOT NULL,
                       `booking_sub_total` varchar(100) NOT NULL,
                       `booking_disc_amount` varchar(100) NOT NULL,
                       `booking_disc_coupon_details` varchar(255) NOT NULL,
                       `booking_total_tax` varchar(100) NOT NULL,
                       `booking_tax_dtls_arr` varchar(255) NOT NULL,
                       `booking_grnd_total` varchar(100) NOT NULL,
                       `booking_prepayment_amount` varchar(100) NOT NULL,
                       `booking_prepayment_details` varchar(255) NOT NULL,
                       `booking_comment` varchar(255) NOT NULL,
                       `added_by` int(11) NOT NULL,
                       `booking_from` int(11) NOT NULL,
                       `srvDtls_id` int(11) NOT NULL,
                       `srvDtls_service_id` int(11) NOT NULL,
                       `srvDtls_service_name` varchar(255) NOT NULL,
                       `srvDtls_service_cost` varchar(100) NOT NULL,
                       `srvDtls_service_duration` int(11) NOT NULL,
                       `srvDtls_service_duration_unit` varchar(10) NOT NULL,
                       `srvDtls_service_start` DATETIME NOT NULL,
                       `srvDtls_service_end` DATETIME NOT NULL,
                       `srvDtls_employee_id` int(11) NOT NULL,
                       `srvDtls_employee_name` varchar(255) NOT NULL,
                       `srvDtls_booking_status` varchar(255) NOT NULL,
                       `srvDtls_status_date` DATETIME NOT NULL,
                       `srvDtls_service_quantity` int(11) NOT NULL,
                       `srvDtls_service_description` varchar(255) NOT NULL
                             ) ENGINE=HEAP DEFAULT CHARSET=latin1;
   curloop: loop
       fetch bookingTab_cursor into
                   li_booking_id,
                   li_customer_id,
                   ls_currency_id,
                   lt_booking_date_time,
                   ls_grand_sub_cost,
                   ls_discount_amnt,
                   ls_discount_coupon_dtls,
                   ls_total_tax,
                   ls_tax_dtls_arr,
                   ls_grand_total,
                   ls_prepayment_amount,
                   ls_prepayment_details,
                   ls_comment,
                   ls_added_by,
                   ls_booking_from ;
       if first_cursor then
           close bookingTab_cursor;
           set first_cursor = false;
           leave curloop;
       end if;
       SET temp_booking_id = li_booking_id ;
BLOCK2: BEGIN
   DECLARE srvLi_srvDtls_id,
       srvLi_srvDtls_service_id INT;
   DECLARE srvLs_srvDtls_service_name varchar(255);
   DECLARE srvLs_srvDtls_service_cost varchar(255);
   DECLARE srvLi_srvDtls_service_duration INT;
   DECLARE srvLs_srvDtls_service_duration_unit varchar(100);
   DECLARE srvLt_srvDtls_service_start DATETIME;
   DECLARE srvLt_srvDtls_service_end DATETIME;
   DECLARE srvLi_srvDtls_continuation_id INT;
   DECLARE srvLi_srvDtls_employee_id INT;
   DECLARE srvLs_srvDtls_employee_name varchar(100);
   DECLARE srvLi_srvDtls_booking_status INT;
   DECLARE srvLt_srvDtls_status_date DATETIME;
   DECLARE srvLi_srvDtls_service_quantity INT;
   DECLARE srvLi_rescheduled_child_id INT;
   DECLARE srvLs_srvDtls_service_description varchar(255);
   DECLARE inner_done boolean;
       DECLARE innerCursor CURSOR FOR
           SELECT
               srvDtls_id,
               srvDtls_service_id,
               srvDtls_service_name,
               srvDtls_service_cost,
               srvDtls_service_duration,
               srvDtls_service_duration_unit,
               ADDTIME(srvDtls_service_start,time_zone) srvDtls_service_start,
               ADDTIME(srvDtls_service_end,time_zone) srvDtls_service_end,
               srvDtls_employee_id,
               srvDtls_employee_name,
               srvDtls_booking_status,
               ADDTIME(srvDtls_status_date,time_zone) srvDtls_status_date,
               srvDtls_service_quantity,
               srvDtls_service_description
           FROM
               app_booking_service_details
           WHERE
               srvDtls_booking_id  = temp_booking_id
               AND
               srvDtls_rescheduled_child_id = 0
           ORDER BY
               srvDtls_id;

DECLARE CONTINUE HANDLER FOR NOT FOUND SET inner_done = TRUE;
OPEN innerCursor ;
   cur_inner_loop: LOOP
       FETCH FROM innerCursor INTO
                   srvLi_srvDtls_id,
                   srvLi_srvDtls_service_id,
                   srvLs_srvDtls_service_name,
                   srvLs_srvDtls_service_cost,
                   srvLi_srvDtls_service_duration,
                   srvLs_srvDtls_service_duration_unit,
                   srvLt_srvDtls_service_start,
                   srvLt_srvDtls_service_end,
                   srvLi_srvDtls_employee_id,
                   srvLs_srvDtls_employee_name,
                   srvLi_srvDtls_booking_status,
                   srvLt_srvDtls_status_date,
                   srvLi_srvDtls_service_quantity,
                   srvLs_srvDtls_service_description ;  
       
       IF inner_done THEN
           CLOSE innerCursor ;
           LEAVE cur_inner_loop;
       END IF;
   INSERT INTO
       app_temp_booking_repo (
               booking_id,
               customer_id,
               currency_id,
               booking_date_time,
               booking_sub_total,
               booking_disc_amount,
               booking_disc_coupon_details,
               booking_total_tax,
               booking_tax_dtls_arr,
               booking_grnd_total,
               booking_prepayment_amount,
               booking_prepayment_details,
               booking_comment,
               added_by,
               booking_from,
               srvDtls_id,
               srvDtls_service_id,
               srvDtls_service_name,
               srvDtls_service_cost,
               srvDtls_service_duration,
               srvDtls_service_duration_unit,
               srvDtls_service_start,
               srvDtls_service_end,
               srvDtls_employee_id,
               srvDtls_employee_name,
               srvDtls_booking_status,
               srvDtls_status_date,
               srvDtls_service_quantity,
               srvDtls_service_description
               )values(
               li_booking_id,
               li_customer_id,
               ls_currency_id,
               lt_booking_date_time,
               ls_grand_sub_cost,
               ls_discount_amnt,
               ls_discount_coupon_dtls,
               ls_total_tax,
               ls_tax_dtls_arr,
               ls_grand_total,
               ls_prepayment_amount,
               ls_prepayment_details,
               ls_comment,
               ls_added_by,
               ls_booking_from,
               srvLi_srvDtls_id,
               srvLi_srvDtls_service_id,
               srvLs_srvDtls_service_name,
               srvLs_srvDtls_service_cost,
               srvLi_srvDtls_service_duration,
               srvLs_srvDtls_service_duration_unit,
               srvLt_srvDtls_service_start,
               srvLt_srvDtls_service_end,
               srvLi_srvDtls_employee_id,
               srvLs_srvDtls_employee_name,
               srvLi_srvDtls_booking_status,
               srvLt_srvDtls_status_date,
               srvLi_srvDtls_service_quantity,
               srvLs_srvDtls_service_description        
               );
END LOOP cur_inner_loop;
END BLOCK2;
   end loop curloop;
   SET @sql_stmt = 'SELECT ';
   IF in_start_data ='' THEN
       SET  @sql_stmt = CONCAT(@sql_stmt,' * ');
   ELSE
       SET  @sql_stmt = CONCAT(@sql_stmt,' ',in_start_data ,' ');
   END IF;
   
   SET @sql_stmt = CONCAT(@sql_stmt,' FROM app_temp_booking_repo LEFT JOIN vw_customerdetails  ON app_temp_booking_repo.customer_id =vw_customerdetails.user_id WHERE 1=1 ');
   IF in_string_data !='' THEN
       SET @sql_stmt =  CONCAT(@sql_stmt,' ',in_string_data);
   END IF;
   PREPARE statementExecute FROM @sql_stmt;
   EXECUTE statementExecute;
   DROP TEMPORARY TABLE IF EXISTS app_temp_booking;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `staffBlockDetails` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = '' */ ;
DELIMITER ;;
CREATE DEFINER=`bookient`@`localhost` PROCEDURE `staffBlockDetails`(
	IN locl_admin INT,
	IN time_zone varchar(15),
	IN in_string_data varchar(255),
	IN in_start_data varchar(255)
)
BEGIN

   DECLARE li_employee_id INT;
   DECLARE ld_block_date DATE;
   DECLARE ls_is_active varchar(2);
   DECLARE first_cursor boolean;
   
   DECLARE bookingTab_cursor CURSOR FOR


           SELECT    
               bkDt.employee_id AS employee_id,
               bkDt.block_date AS block_date,
               emp.is_active AS is_active
           FROM    
               app_staff_unavailable AS bkDt,
               app_employee AS emp

           WHERE    
               emp.employee_id = bkDt.employee_id
               AND
               emp.local_admin_id = locl_admin
           ORDER BY
               bkDt.block_date;

   DECLARE continue handler for not found set first_cursor = true;
OPEN bookingTab_cursor;

DROP TEMPORARY TABLE IF EXISTS app_temp_blocking;

CREATE TEMPORARY TABLE IF NOT EXISTS `app_temp_blocking` (
                                   `unavailable_time_id` int(11) NULL,
                                   `employee_id` int(11) NOT NULL,
                                   `block_date` DATE NOT NULL,
                                   `time_form` TIME NOT NULL,
                                   `time_to` TIME NOT NULL,
                                   `is_active` varchar(20) NOT NULL
                                    ) ENGINE=HEAP DEFAULT CHARSET=latin1;

   curloop: loop

       fetch bookingTab_cursor into
                               li_employee_id,
                               ld_block_date,
                               ls_is_active ;

       if first_cursor then
           close bookingTab_cursor;
           set first_cursor = false;
           leave curloop;
       end if;
   INSERT INTO
       app_temp_blocking (
               unavailable_time_id,
               employee_id,
               block_date,
               time_form,
               time_to,
               is_active
               )values(
               0,
               li_employee_id,
               ld_block_date,
               '00:00:00',
               '24:00:00',
               ls_is_active        
               );
   end loop curloop;
   
BLOCK2: BEGIN

   DECLARE timLi_unavailable_time_id INT;
   DECLARE timLi_employee_id INT;
   DECLARE timLd_date DATE;
   DECLARE timLs_is_active varchar(2);
   DECLARE timLt_time_form TIME;
   DECLARE timLt_time_to TIME;
   DECLARE timLt_temp_time_form TIME;
   DECLARE timLt_temp_time_to TIME;
   DECLARE timLi_temp_unavailable_time_id INT;
   DECLARE inner_done boolean;
   DECLARE innerCursor CURSOR FOR


           SELECT
               bkTm.unavailable_time_id unavailable_time_id,
               bkTm.employee_id employee_id,
               bkTm.date date,
               ADDTIME(bkTm.time_form,time_zone) time_form,
               ADDTIME(bkTm.time_to,time_zone) time_to,
               emp.is_active is_active
           FROM
               app_staff_unavailable_time bkTm,
               app_employee emp
           WHERE
               emp.employee_id = bkTm.employee_id
               AND
               emp.local_admin_id = locl_admin
               AND
               bkTm.continuation_id  = 0
           ORDER BY
               bkTm.date;
               


DECLARE CONTINUE HANDLER FOR NOT FOUND SET inner_done = TRUE;
OPEN innerCursor ;
   cur_inner_loop: LOOP

       FETCH FROM innerCursor INTO
                   timLi_unavailable_time_id,
                   timLi_employee_id,
                   timLd_date,
                   timLt_time_form,
                   timLt_time_to,
                   timLs_is_active;  

       
       IF inner_done THEN
           CLOSE innerCursor ;
           LEAVE cur_inner_loop;
       END IF;
       
       SET timLt_temp_time_form    = timLt_time_form;
       SET timLt_temp_time_to        = timLt_time_to;
       SET timLi_temp_unavailable_time_id = timLi_unavailable_time_id;
       

BLOCK3: BEGIN
       DECLARE child boolean;
       DECLARE no_of_row INT DEFAULT 0;
       DECLARE child_time_form, child_time_to TIME;
       DECLARE final_time_form, final_time_to TIME;
       DECLARE final_date DATE;
       DECLARE first_value INT;
       DECLARE childCursor CURSOR FOR

   SELECT
       ADDTIME(time_form,time_zone) time_form,
       ADDTIME(time_to,time_zone) time_to
   FROM
       app_staff_unavailable_time
   WHERE
       continuation_id  = timLi_temp_unavailable_time_id;

       
DECLARE CONTINUE HANDLER FOR NOT FOUND SET child = TRUE;

OPEN childCursor ;
   cur_child_loop: LOOP
       FETCH FROM childCursor INTO
                   child_time_form,
                   child_time_to ;  
       
       IF child THEN
           CLOSE childCursor ;
           LEAVE cur_child_loop;
       END IF;
           SET  no_of_row = no_of_row +1;
   END LOOP cur_child_loop;


   IF no_of_row =0 THEN
         SET final_time_form    = timLt_temp_time_form;
         SET final_time_to     =ADDTIME(CAST('00:00:01' as TIME),timLt_temp_time_to);
    ELSE
         SET final_time_form    = timLt_temp_time_form;
         SET final_time_to     = ADDTIME(CAST('00:00:01' as TIME),child_time_to);
    END IF;


   SET first_value = SUBSTRING_INDEX(final_time_form, ':', 1 );
   IF first_value < 0 THEN
       SET final_time_form  =  ADDTIME(CAST('24:00:00' as TIME),final_time_form);
       SET final_date = DATE_SUB(CAST(timLd_date as DATE),INTERVAL 1 DAY);
   ELSEIF first_value > 24 THEN
       SET final_time_form  =  SUBTIME(final_time_form, CAST('24:00:00' as TIME));  
       SET final_date = DATE_ADD(CAST(timLd_date as DATE),INTERVAL 1 DAY);
   END IF;

   

   SET first_value = SUBSTRING_INDEX(final_time_to, ':', 1 );
   IF first_value < 0 THEN
       SET final_time_to  =  ADDTIME(CAST('24:00:00' as TIME),final_time_to);              
   ELSEIF first_value  > 24 THEN
       SET final_time_to  =  SUBTIME(final_time_to, CAST('24:00:00' as TIME));
   END IF;

       

   INSERT INTO
       app_temp_blocking (
               unavailable_time_id,
               employee_id,
               block_date,
               time_form,
               time_to,
               is_active
               )values(
               timLi_unavailable_time_id,
               timLi_employee_id,
               timLd_date,
               final_time_form,
               final_time_to,
               timLs_is_active        
               );

END BLOCK3;
END LOOP cur_inner_loop;
END BLOCK2;

   SET @sql_stmt = 'SELECT ';
   IF in_start_data ='' THEN
       SET  @sql_stmt = CONCAT(@sql_stmt,' * ');
   ELSE
       SET  @sql_stmt = CONCAT(@sql_stmt,' ',in_start_data ,' ');
   END IF;
   
   SET @sql_stmt = CONCAT(@sql_stmt,' FROM app_temp_blocking WHERE 1=1 ');
   IF in_string_data !='' THEN
       SET @sql_stmt =  CONCAT(@sql_stmt,' ',in_string_data);
   END IF;
   SET @sql_stmt = CONCAT(@sql_stmt,' ORDER BY block_date ');
   
   PREPARE statementExecute FROM @sql_stmt;
   EXECUTE statementExecute;

   DROP TEMPORARY TABLE IF EXISTS app_temp_blocking;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `staffBlockDetailsFront` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = '' */ ;
DELIMITER ;;
CREATE DEFINER=`bookient`@`localhost` PROCEDURE `staffBlockDetailsFront`(
	IN locl_admin INT,
	IN time_zone varchar(15),
	IN in_string_data varchar(255),
	IN in_start_data varchar(255)
)
BEGIN
   DECLARE li_employee_id INT;
   DECLARE ld_block_date DATE;
   DECLARE ls_is_active varchar(2);
   DECLARE first_cursor boolean;
   
   DECLARE bookingTab_cursor CURSOR FOR
           SELECT    
               bkDt.employee_id AS employee_id,
               bkDt.block_date AS block_date,
               emp.is_active AS is_active
           FROM    
               app_staff_unavailable AS bkDt,
               app_employee AS emp

           WHERE    
               emp.employee_id = bkDt.employee_id
               AND
               emp.local_admin_id = locl_admin
           ORDER BY
               bkDt.block_date;
   DECLARE continue handler for not found set first_cursor = true;
OPEN bookingTab_cursor;
DROP TEMPORARY TABLE IF EXISTS app_temp_blocking;

CREATE TEMPORARY TABLE IF NOT EXISTS `app_temp_blocking` (
                                   `unavailable_time_id` int(11) NULL,
                                   `employee_id` int(11) NOT NULL,
                                   `block_date` DATE NOT NULL,
                                   `time_form` TIME NOT NULL,
                                   `time_to` TIME NOT NULL,
                                   `is_active` varchar(20) NOT NULL
                                    ) ENGINE=HEAP DEFAULT CHARSET=latin1;
   curloop: loop
       fetch bookingTab_cursor into
                               li_employee_id,
                               ld_block_date,
                               ls_is_active ;
       if first_cursor then
           close bookingTab_cursor;
           set first_cursor = false;
           leave curloop;
       end if;
   INSERT INTO
       app_temp_blocking (
               unavailable_time_id,
               employee_id,
               block_date,
               time_form,
               time_to,
               is_active
               )values(
               0,
               li_employee_id,
               ld_block_date,
               '00:00:00',
               '23:59:59',
               ls_is_active        
               );
   end loop curloop;
   
BLOCK2: BEGIN
   DECLARE timLi_unavailable_time_id INT;
   DECLARE timLi_employee_id INT;
   DECLARE timLd_date DATE;
   DECLARE timLs_is_active varchar(2);
   DECLARE timLt_time_form TIME;
   DECLARE timLt_time_to TIME;
   DECLARE timLt_temp_time_form TIME;
   DECLARE timLt_temp_time_to TIME;
   DECLARE timLi_temp_unavailable_time_id INT;
   DECLARE inner_done boolean;
   DECLARE innerCursor CURSOR FOR
           SELECT
               bkTm.unavailable_time_id unavailable_time_id,
               bkTm.employee_id employee_id,
               bkTm.date date,
               ADDTIME(bkTm.time_form,time_zone) time_form,
               ADDTIME(bkTm.time_to,time_zone) time_to,
               emp.is_active is_active
           FROM
               app_staff_unavailable_time bkTm,
               app_employee emp
           WHERE
               emp.employee_id = bkTm.employee_id
               AND
               emp.local_admin_id = locl_admin
               AND
               bkTm.continuation_id  = 0
           ORDER BY
               bkTm.date;
               

DECLARE CONTINUE HANDLER FOR NOT FOUND SET inner_done = TRUE;
OPEN innerCursor ;
   cur_inner_loop: LOOP
       FETCH FROM innerCursor INTO
                   timLi_unavailable_time_id,
                   timLi_employee_id,
                   timLd_date,
                   timLt_time_form,
                   timLt_time_to,
                   timLs_is_active;  
       
       IF inner_done THEN
           CLOSE innerCursor ;
           LEAVE cur_inner_loop;
       END IF;
       
       SET timLt_temp_time_form    = timLt_time_form;
       SET timLt_temp_time_to        = timLt_time_to;
       SET timLi_temp_unavailable_time_id = timLi_unavailable_time_id;
       
BLOCK3: BEGIN
       DECLARE child boolean;
       DECLARE no_of_row INT DEFAULT 0;
       DECLARE child_time_form, child_time_to TIME;
       DECLARE final_time_form, final_time_to TIME;
       DECLARE final_date DATE;
       DECLARE first_value INT;
       DECLARE childCursor CURSOR FOR
   SELECT
       ADDTIME(time_form,time_zone) time_form,
       ADDTIME(time_to,time_zone) time_to
   FROM
       app_staff_unavailable_time
   WHERE
       continuation_id  = timLi_temp_unavailable_time_id;
       
DECLARE CONTINUE HANDLER FOR NOT FOUND SET child = TRUE;
OPEN childCursor ;
   cur_child_loop: LOOP
       FETCH FROM childCursor INTO
                   child_time_form,
                   child_time_to ;  
       
       IF child THEN
           CLOSE childCursor ;
           LEAVE cur_child_loop;
       END IF;
           SET  no_of_row = no_of_row +1;
   END LOOP cur_child_loop;
   IF no_of_row =0 THEN
         SET final_time_form    = timLt_temp_time_form;
         SET final_time_to     =ADDTIME(CAST('00:00:01' as TIME),timLt_temp_time_to);
    ELSE
         SET final_time_form    = timLt_temp_time_form;
         SET final_time_to     = ADDTIME(CAST('00:00:01' as TIME),child_time_to);
    END IF;
   SET first_value = SUBSTRING_INDEX(final_time_form, ':', 1 );
   IF first_value < 0 THEN
       SET final_time_form  =  ADDTIME(CAST('23:59:59' as TIME),final_time_form);
       SET final_date = DATE_SUB(CAST(timLd_date as DATE),INTERVAL 1 DAY);
   ELSEIF first_value > 24 THEN
       SET final_time_form  =  SUBTIME(final_time_form, CAST('23:59:59' as TIME));  
       SET final_date = DATE_ADD(CAST(timLd_date as DATE),INTERVAL 1 DAY);
   END IF;
   
   SET first_value = SUBSTRING_INDEX(final_time_to, ':', 1 );
   IF first_value < 0 THEN
       SET final_time_to  =  ADDTIME(CAST('23:59:59' as TIME),final_time_to);              
   ELSEIF first_value  > 24 THEN
       SET final_time_to  =  SUBTIME(final_time_to, CAST('23:59:59' as TIME));
   END IF;
       
   INSERT INTO
       app_temp_blocking (
               unavailable_time_id,
               employee_id,
               block_date,
               time_form,
               time_to,
               is_active
               )values(
               timLi_unavailable_time_id,
               timLi_employee_id,
               timLd_date,
               final_time_form,
               final_time_to,
               timLs_is_active        
               );
END BLOCK3;
END LOOP cur_inner_loop;
END BLOCK2;
   SET @sql_stmt = 'SELECT ';
   IF in_start_data ='' THEN
       SET  @sql_stmt = CONCAT(@sql_stmt,' * ');
   ELSE
       SET  @sql_stmt = CONCAT(@sql_stmt,' ',in_start_data ,' ');
   END IF;
   
   SET @sql_stmt = CONCAT(@sql_stmt,' FROM app_temp_blocking WHERE 1=1 ');
   IF in_string_data !='' THEN
       SET @sql_stmt =  CONCAT(@sql_stmt,' ',in_string_data);
   END IF;
   SET @sql_stmt = CONCAT(@sql_stmt,' ORDER BY employee_id ');
   
   PREPARE statementExecute FROM @sql_stmt;
   EXECUTE statementExecute;
   DROP TEMPORARY TABLE IF EXISTS app_temp_blocking;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `staffBlockDetailsFrontWihService` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = '' */ ;
DELIMITER ;;
CREATE DEFINER=`bookient`@`localhost` PROCEDURE `staffBlockDetailsFrontWihService`(
	IN locl_admin INT,
	IN time_zone varchar(15),
	IN in_string_data varchar(255),
	IN in_start_data varchar(255)
)
BEGIN
   DECLARE li_employee_id INT;
   DECLARE ld_block_date DATE;
   DECLARE ls_is_active varchar(2);
   DECLARE first_cursor boolean;
   DECLARE new_employee_id INT;
   
   DECLARE bookingTab_cursor CURSOR FOR
           SELECT    
               bkDt.employee_id AS employee_id,
               bkDt.block_date AS block_date,
               emp.is_active AS is_active
           FROM    
               app_staff_unavailable AS bkDt,
               app_employee AS emp

           WHERE    
               emp.employee_id = bkDt.employee_id
               AND
               emp.local_admin_id = locl_admin
           ORDER BY
               bkDt.block_date;
   DECLARE continue handler for not found set first_cursor = true;
OPEN bookingTab_cursor;
DROP TEMPORARY TABLE IF EXISTS app_temp_blocking_local;

CREATE TEMPORARY TABLE IF NOT EXISTS `app_temp_blocking_local` (
                                   `unavailable_time_id` int(11) NULL,
                                   `employee_id` int(11) NOT NULL,
                                   `services_ids` varchar(256) NOT NULL,
                                   `block_date` DATE NOT NULL,
                                   `time_form` TIME NOT NULL,
                                   `time_to` TIME NOT NULL,
                                   `is_active` varchar(20) NOT NULL
                                    ) ENGINE=HEAP DEFAULT CHARSET=latin1;
   curloop: loop
       fetch bookingTab_cursor into
                               li_employee_id,
                               ld_block_date,
                               ls_is_active ;
       if first_cursor then
           close bookingTab_cursor;
           set first_cursor = false;
           leave curloop;
       end if;
       
       SET new_employee_id = li_employee_id;
       NEWBLOCK: BEGIN
           DECLARE services_ids TEXT;
           DECLARE temp_service_id varchar(10);
           DECLARE new_service_cur_done boolean;
           DECLARE new_app_biz_hours_cursor CURSOR FOR
           SELECT
           service_id
           FROM
           app_biz_hours  
           WHERE
           employee_id  = new_employee_id
           AND
           local_admin_id = locl_admin;
       
       DECLARE CONTINUE HANDLER FOR NOT FOUND SET new_service_cur_done = TRUE;
           OPEN new_app_biz_hours_cursor ;
           cur_service_loop: LOOP
           FETCH FROM new_app_biz_hours_cursor INTO
                   temp_service_id;  
       
           IF new_service_cur_done THEN
               CLOSE new_app_biz_hours_cursor ;
               LEAVE cur_service_loop;
           END IF;
       
           SET services_ids = 5 ;
           END LOOP cur_service_loop;
       END NEWBLOCK;
       
       
       
       
   INSERT INTO
       app_temp_blocking_local (
               unavailable_time_id,
               employee_id,
               services_ids,
               block_date,
               time_form,
               time_to,
               is_active
               )values(
               0,
               li_employee_id,
               5,
               ld_block_date,
               '00:00:00',
               '23:59:59',
               ls_is_active        
               );
   end loop curloop;
   
BLOCK2: BEGIN
   DECLARE timLi_unavailable_time_id INT;
   DECLARE timLi_employee_id INT;
   DECLARE timLd_date DATE;
   DECLARE timLs_is_active varchar(2);
   DECLARE timLt_time_form TIME;
   DECLARE timLt_time_to TIME;
   DECLARE timLt_temp_time_form TIME;
   DECLARE timLt_temp_time_to TIME;
   DECLARE timLi_temp_unavailable_time_id INT;
   DECLARE inner_done boolean;
   DECLARE innerCursor CURSOR FOR
           SELECT
               bkTm.unavailable_time_id unavailable_time_id,
               bkTm.employee_id employee_id,
               bkTm.date date,
               ADDTIME(bkTm.time_form,time_zone) time_form,
               ADDTIME(bkTm.time_to,time_zone) time_to,
               emp.is_active is_active
           FROM
               app_staff_unavailable_time bkTm,
               app_employee emp
           WHERE
               emp.employee_id = bkTm.employee_id
               AND
               emp.local_admin_id = locl_admin
               AND
               bkTm.continuation_id  = 0
           ORDER BY
               bkTm.date;
               

DECLARE CONTINUE HANDLER FOR NOT FOUND SET inner_done = TRUE;
OPEN innerCursor ;
   cur_inner_loop: LOOP
       FETCH FROM innerCursor INTO
                   timLi_unavailable_time_id,
                   timLi_employee_id,
                   timLd_date,
                   timLt_time_form,
                   timLt_time_to,
                   timLs_is_active;  
       
       IF inner_done THEN
           CLOSE innerCursor ;
           LEAVE cur_inner_loop;
       END IF;
       
       SET timLt_temp_time_form    = timLt_time_form;
       SET timLt_temp_time_to        = timLt_time_to;
       SET timLi_temp_unavailable_time_id = timLi_unavailable_time_id;
       
BLOCK3: BEGIN
       DECLARE child boolean;
       DECLARE no_of_row INT DEFAULT 0;
       DECLARE child_time_form, child_time_to TIME;
       DECLARE final_time_form, final_time_to TIME;
       DECLARE final_date DATE;
       DECLARE first_value INT;
       DECLARE childCursor CURSOR FOR
   SELECT
       ADDTIME(time_form,time_zone) time_form,
       ADDTIME(time_to,time_zone) time_to
   FROM
       app_staff_unavailable_time
   WHERE
       continuation_id  = timLi_temp_unavailable_time_id;
       
DECLARE CONTINUE HANDLER FOR NOT FOUND SET child = TRUE;
OPEN childCursor ;
   cur_child_loop: LOOP
       FETCH FROM childCursor INTO
                   child_time_form,
                   child_time_to ;  
       
       IF child THEN
           CLOSE childCursor ;
           LEAVE cur_child_loop;
       END IF;
           SET  no_of_row = no_of_row +1;
   END LOOP cur_child_loop;
   IF no_of_row =0 THEN
         SET final_time_form    = timLt_temp_time_form;
         SET final_time_to     =ADDTIME(CAST('00:00:01' as TIME),timLt_temp_time_to);
    ELSE
         SET final_time_form    = timLt_temp_time_form;
         SET final_time_to     = ADDTIME(CAST('00:00:01' as TIME),child_time_to);
    END IF;
   SET first_value = SUBSTRING_INDEX(final_time_form, ':', 1 );
   IF first_value < 0 THEN
       SET final_time_form  =  ADDTIME(CAST('23:59:59' as TIME),final_time_form);
       SET final_date = DATE_SUB(CAST(timLd_date as DATE),INTERVAL 1 DAY);
   ELSEIF first_value > 24 THEN
       SET final_time_form  =  SUBTIME(final_time_form, CAST('23:59:59' as TIME));  
       SET final_date = DATE_ADD(CAST(timLd_date as DATE),INTERVAL 1 DAY);
   END IF;
   
   SET first_value = SUBSTRING_INDEX(final_time_to, ':', 1 );
   IF first_value < 0 THEN
       SET final_time_to  =  ADDTIME(CAST('23:59:59' as TIME),final_time_to);              
   ELSEIF first_value  > 24 THEN
       SET final_time_to  =  SUBTIME(final_time_to, CAST('23:59:59' as TIME));
   END IF;
       
   INSERT INTO
       app_temp_blocking_local (
               unavailable_time_id,
               employee_id,
               block_date,
               time_form,
               time_to,
               is_active
               )values(
               timLi_unavailable_time_id,
               timLi_employee_id,
               timLd_date,
               final_time_form,
               final_time_to,
               timLs_is_active        
               );
END BLOCK3;
END LOOP cur_inner_loop;
END BLOCK2;
   SET @sql_stmt = 'SELECT ';
   IF in_start_data ='' THEN
       SET  @sql_stmt = CONCAT(@sql_stmt,' * ');
   ELSE
       SET  @sql_stmt = CONCAT(@sql_stmt,' ',in_start_data ,' ');
   END IF;
   
   SET @sql_stmt = CONCAT(@sql_stmt,' FROM app_temp_blocking_local WHERE 1=1 ');
   IF in_string_data !='' THEN
       SET @sql_stmt =  CONCAT(@sql_stmt,' ',in_string_data);
   END IF;
   SET @sql_stmt = CONCAT(@sql_stmt,' ORDER BY employee_id ');
   
   PREPARE statementExecute FROM @sql_stmt;
   EXECUTE statementExecute;
   DROP TEMPORARY TABLE IF EXISTS app_temp_blocking_local;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;

--
-- Final view structure for view `vw_customerdetails`
--

/*!50001 DROP TABLE IF EXISTS `vw_customerdetails`*/;
/*!50001 DROP VIEW IF EXISTS `vw_customerdetails`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8 */;
/*!50001 SET character_set_results     = utf8 */;
/*!50001 SET collation_connection      = utf8_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`bookient`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `vw_customerdetails` AS select `rel`.`customer_id` AS `user_id`,`user`.`date_creation` AS `date_inserted`,`country`.`country_name` AS `country_name`,`city`.`city_name` AS `city_name`,`region`.`region_name` AS `region_name`,`user`.`user_email` AS `user_email`,`cus`.`cus_fname` AS `cus_fname`,`rel`.`customer_info` AS `customer_info`,`user`.`user_status` AS `user_status`,`user`.`approval_status` AS `approval`,`cus`.`time_zone_id` AS `time_zone_id`,`rel`.`customer_tag` AS `customer_tag`,count(`book`.`booking_id`) AS `no_of_booking`,`user`.`register_from` AS `register_from`,`cus`.`cus_lname` AS `cus_lname`,`cus`.`cus_address` AS `cus_address`,`user`.`user_status` AS `customer_status`,`cus`.`cus_zip` AS `cus_zip`,`cus`.`cus_mob` AS `cus_mob`,`cus`.`cus_phn1` AS `cus_phn1`,`cus`.`cus_phn2` AS `cus_phn2` from ((((((`app_customer_admin_relationship` `rel` join `app_password_manager` `user` on((`rel`.`customer_id` = `user`.`user_id`))) left join `app_customer_search` `cus` on((`cus`.`cus_id` = `rel`.`customer_id`))) left join `app_countries` `country` on((`country`.`country_id` = `cus`.`cus_countryid`))) left join `app_cities` `city` on((`city`.`city_id` = `cus`.`cus_cityid`))) left join `app_regions` `region` on((`region`.`region_id` = `cus`.`cus_regionid`))) left join `app_booking` `book` on((`book`.`customer_id` = `user`.`user_id`))) group by `rel`.`customer_id` */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `vw_customerdetails_search`
--

/*!50001 DROP TABLE IF EXISTS `vw_customerdetails_search`*/;
/*!50001 DROP VIEW IF EXISTS `vw_customerdetails_search`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8 */;
/*!50001 SET character_set_results     = utf8 */;
/*!50001 SET collation_connection      = utf8_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `vw_customerdetails_search` AS select distinct `c1`.`user_id` AS `user_id`,(select `v1`.`value` AS `value` from (`app_local_customer_details` `v1` join `app_local_clint_signup_info` `a1` on(((`a1`.`sign_upinfo_item_id` = `v1`.`sign_upinfo_item_id`) and (`a1`.`info_item_name` = _latin1'cus_fname')))) where (`v1`.`customer_id` = `c1`.`user_id`) order by `v1`.`value` limit 1) AS `cus_fname`,(select `v1`.`value` AS `value` from (`app_local_customer_details` `v1` join `app_local_clint_signup_info` `a1` on(((`a1`.`sign_upinfo_item_id` = `v1`.`sign_upinfo_item_id`) and (`a1`.`info_item_name` = _latin1'cus_lname')))) where (`v1`.`customer_id` = `c1`.`user_id`) order by `v1`.`value` limit 1) AS `cus_lname`,(select `v1`.`value` AS `value` from (`app_local_customer_details` `v1` join `app_local_clint_signup_info` `a1` on(((`a1`.`sign_upinfo_item_id` = `v1`.`sign_upinfo_item_id`) and (`a1`.`info_item_name` = _latin1'cus_mob')))) where (`v1`.`customer_id` = `c1`.`user_id`) order by `v1`.`value` limit 1) AS `cus_mob`,(select `v1`.`value` AS `value` from (`app_local_customer_details` `v1` join `app_local_clint_signup_info` `a1` on(((`a1`.`sign_upinfo_item_id` = `v1`.`sign_upinfo_item_id`) and (`a1`.`info_item_name` = _latin1'cus_phn1')))) where (`v1`.`customer_id` = `c1`.`user_id`) order by `v1`.`value` limit 1) AS `cus_phn1`,(select `v1`.`value` AS `value` from (`app_local_customer_details` `v1` join `app_local_clint_signup_info` `a1` on(((`a1`.`sign_upinfo_item_id` = `v1`.`sign_upinfo_item_id`) and (`a1`.`info_item_name` = _latin1'cus_phn2')))) where (`v1`.`customer_id` = `c1`.`user_id`) order by `v1`.`value` limit 1) AS `cus_phn2` from ((((`app_password_manager` `c1` join `app_local_customer_details` `c2`) left join `app_countries` `c3` on((`c3`.`country_id` = (select `v1`.`value` AS `value` from (`app_local_customer_details` `v1` join `app_local_clint_signup_info` `a1` on(((`a1`.`sign_upinfo_item_id` = `v1`.`sign_upinfo_item_id`) and (`a1`.`info_item_name` = _latin1'cus_countryid')))) where (`v1`.`customer_id` = `c1`.`user_id`) order by `v1`.`value` limit 1)))) left join `app_cities` `c4` on((`c4`.`city_id` = (select `v1`.`value` AS `value` from (`app_local_customer_details` `v1` join `app_local_clint_signup_info` `a1` on(((`a1`.`sign_upinfo_item_id` = `v1`.`sign_upinfo_item_id`) and (`a1`.`info_item_name` = _latin1'cus_cityid')))) where (`v1`.`customer_id` = `c1`.`user_id`) order by `v1`.`value` limit 1)))) left join `app_regions` `c5` on((`c5`.`region_id` = (select `v1`.`value` AS `value` from (`app_local_customer_details` `v1` join `app_local_clint_signup_info` `a1` on(((`a1`.`sign_upinfo_item_id` = `v1`.`sign_upinfo_item_id`) and (`a1`.`info_item_name` = _latin1'cus_regionid')))) where (`v1`.`customer_id` = `c1`.`user_id`) order by `v1`.`value` limit 1)))) where ((`c1`.`user_type` = _utf8'1') and (`c1`.`user_id` = `c2`.`customer_id`)) */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2015-06-10 14:24:20
