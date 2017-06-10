-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               5.5.27 - MySQL Community Server (GPL)
-- Server OS:                    Win32
-- HeidiSQL Version:             9.3.0.4984
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Dumping database structure for gonnon_university
CREATE DATABASE IF NOT EXISTS `gonnon_university` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `gonnon_university`;


-- Dumping structure for table gonnon_university.gu_admin
CREATE TABLE IF NOT EXISTS `gu_admin` (
  `admin_id` int(11) DEFAULT NULL,
  `username` varchar(100) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `status` varchar(100) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table gonnon_university.gu_admin: ~0 rows (approximately)
/*!40000 ALTER TABLE `gu_admin` DISABLE KEYS */;
/*!40000 ALTER TABLE `gu_admin` ENABLE KEYS */;


-- Dumping structure for table gonnon_university.gu_categories
CREATE TABLE IF NOT EXISTS `gu_categories` (
  `category_id` int(11) NOT NULL AUTO_INCREMENT,
  `category_name` varchar(200) NOT NULL DEFAULT '0',
  `category_image` varchar(200) NOT NULL DEFAULT '0',
  `status` varchar(200) NOT NULL DEFAULT '0',
  PRIMARY KEY (`category_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table gonnon_university.gu_categories: ~0 rows (approximately)
/*!40000 ALTER TABLE `gu_categories` DISABLE KEYS */;
/*!40000 ALTER TABLE `gu_categories` ENABLE KEYS */;


-- Dumping structure for table gonnon_university.gu_events
CREATE TABLE IF NOT EXISTS `gu_events` (
  `event_id` int(11) NOT NULL AUTO_INCREMENT,
  `category_id` int(100) NOT NULL DEFAULT '0',
  `sub_category_id` int(100) NOT NULL DEFAULT '0',
  `event_title` varchar(200) NOT NULL DEFAULT '0',
  `event_date` varchar(50) NOT NULL DEFAULT '0',
  `event_description` varchar(1000) NOT NULL DEFAULT '0',
  `current_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` varchar(50) NOT NULL DEFAULT '1',
  PRIMARY KEY (`event_id`),
  KEY `FK_gu_events_gu_categories` (`category_id`),
  KEY `FK_gu_events_gu_sub_categories` (`sub_category_id`),
  CONSTRAINT `FK_gu_events_gu_categories` FOREIGN KEY (`category_id`) REFERENCES `gu_categories` (`category_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_gu_events_gu_sub_categories` FOREIGN KEY (`sub_category_id`) REFERENCES `gu_sub_categories` (`sub_category_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table gonnon_university.gu_events: ~0 rows (approximately)
/*!40000 ALTER TABLE `gu_events` DISABLE KEYS */;
/*!40000 ALTER TABLE `gu_events` ENABLE KEYS */;


-- Dumping structure for table gonnon_university.gu_feedback
CREATE TABLE IF NOT EXISTS `gu_feedback` (
  `feedback_id` int(11) NOT NULL,
  `feedback_title` varchar(500) NOT NULL,
  `status` varchar(500) NOT NULL,
  PRIMARY KEY (`feedback_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table gonnon_university.gu_feedback: ~0 rows (approximately)
/*!40000 ALTER TABLE `gu_feedback` DISABLE KEYS */;
/*!40000 ALTER TABLE `gu_feedback` ENABLE KEYS */;


-- Dumping structure for table gonnon_university.gu_gallery
CREATE TABLE IF NOT EXISTS `gu_gallery` (
  `galley_id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(200) DEFAULT NULL,
  `category_id` int(11) DEFAULT NULL,
  `sub_category_id` int(11) NOT NULL DEFAULT '0',
  `image_path` varchar(200) DEFAULT NULL,
  `current_date` varchar(200) DEFAULT NULL,
  `description` varchar(500) DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`galley_id`),
  KEY `FK_gu_gallery_gu_categories` (`category_id`),
  KEY `FK_gu_gallery_gu_sub_categories` (`sub_category_id`),
  CONSTRAINT `FK_gu_gallery_gu_sub_categories` FOREIGN KEY (`sub_category_id`) REFERENCES `gu_sub_categories` (`sub_category_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_gu_gallery_gu_categories` FOREIGN KEY (`category_id`) REFERENCES `gu_categories` (`category_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table gonnon_university.gu_gallery: ~0 rows (approximately)
/*!40000 ALTER TABLE `gu_gallery` DISABLE KEYS */;
/*!40000 ALTER TABLE `gu_gallery` ENABLE KEYS */;


-- Dumping structure for table gonnon_university.gu_notification
CREATE TABLE IF NOT EXISTS `gu_notification` (
  `notification_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_febak_id` int(11) DEFAULT NULL,
  `status` int(11) DEFAULT '1',
  PRIMARY KEY (`notification_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table gonnon_university.gu_notification: ~0 rows (approximately)
/*!40000 ALTER TABLE `gu_notification` DISABLE KEYS */;
/*!40000 ALTER TABLE `gu_notification` ENABLE KEYS */;


-- Dumping structure for table gonnon_university.gu_sub_categories
CREATE TABLE IF NOT EXISTS `gu_sub_categories` (
  `sub_category_id` int(11) NOT NULL AUTO_INCREMENT,
  `category_id` int(11) NOT NULL DEFAULT '0',
  `sub_category_name` varchar(200) NOT NULL DEFAULT '0',
  `sub_cat_image` varchar(200) NOT NULL DEFAULT '0',
  `status` varchar(200) NOT NULL DEFAULT '0',
  PRIMARY KEY (`sub_category_id`),
  KEY `FK_gu_sub_categories_gu_categories` (`category_id`),
  CONSTRAINT `FK_gu_sub_categories_gu_categories` FOREIGN KEY (`category_id`) REFERENCES `gu_categories` (`category_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table gonnon_university.gu_sub_categories: ~0 rows (approximately)
/*!40000 ALTER TABLE `gu_sub_categories` DISABLE KEYS */;
/*!40000 ALTER TABLE `gu_sub_categories` ENABLE KEYS */;


-- Dumping structure for table gonnon_university.gu_user_feedbacks
CREATE TABLE IF NOT EXISTS `gu_user_feedbacks` (
  `user_febak_id` int(11) NOT NULL AUTO_INCREMENT,
  `feedback_id` int(11) NOT NULL DEFAULT '0',
  `feedback_discription` varchar(500) DEFAULT NULL,
  `status` varchar(500) DEFAULT '1',
  PRIMARY KEY (`user_febak_id`),
  KEY `FK_gu_user_feedbacks_gu_feedback` (`feedback_id`),
  CONSTRAINT `FK_gu_user_feedbacks_gu_feedback` FOREIGN KEY (`feedback_id`) REFERENCES `gu_feedback` (`feedback_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table gonnon_university.gu_user_feedbacks: ~0 rows (approximately)
/*!40000 ALTER TABLE `gu_user_feedbacks` DISABLE KEYS */;
/*!40000 ALTER TABLE `gu_user_feedbacks` ENABLE KEYS */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
