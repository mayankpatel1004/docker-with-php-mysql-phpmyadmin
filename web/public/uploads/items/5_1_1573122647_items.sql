-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Nov 06, 2019 at 02:03 PM
-- Server version: 5.7.19
-- PHP Version: 7.1.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cloudswiftsolutions_com`
--

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

DROP TABLE IF EXISTS `items`;
CREATE TABLE IF NOT EXISTS `items` (
  `item_id` int(11) NOT NULL AUTO_INCREMENT,
  `item_title` varchar(255) DEFAULT NULL,
  `item_alias` varchar(255) DEFAULT NULL,
  `item_parent` int(11) NOT NULL DEFAULT '0',
  `item_type` varchar(255) DEFAULT NULL,
  `item_category` varchar(255) DEFAULT NULL,
  `item_description` longtext,
  `item_shortdescription` text,
  `guest_item` enum('Y','N') NOT NULL DEFAULT 'N',
  `user_id` int(11) NOT NULL DEFAULT '0',
  `file1` varchar(255) DEFAULT NULL,
  `file2` varchar(255) DEFAULT NULL,
  `file3` varchar(255) DEFAULT NULL,
  `external_url` varchar(255) DEFAULT NULL,
  `controller` varchar(50) DEFAULT NULL,
  `action` varchar(50) DEFAULT 'index',
  `robots` varchar(50) DEFAULT 'NOINDEX, NOFOLLOW',
  `published_at` date DEFAULT NULL,
  `published_end_at` date DEFAULT NULL,
  `meta_title` varchar(255) DEFAULT NULL,
  `meta_description` text,
  `html_sitemap` enum('Y','N') NOT NULL DEFAULT 'Y',
  `html_sitemap_order` int(11) NOT NULL DEFAULT '0',
  `admin_module` enum('Y','N') NOT NULL DEFAULT 'N',
  `custom_view` varchar(255) DEFAULT NULL,
  `display_order` int(11) NOT NULL DEFAULT '0',
  `display_status` enum('Y','N') NOT NULL DEFAULT 'Y',
  `deleted_status` enum('Y','N') NOT NULL DEFAULT 'N',
  `deleted_by` int(11) NOT NULL DEFAULT '0',
  `deleted_by_name` varchar(255) DEFAULT NULL,
  `deleted_time` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`item_id`)
) ENGINE=MyISAM AUTO_INCREMENT=585 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`item_id`, `item_title`, `item_alias`, `item_parent`, `item_type`, `item_category`, `item_description`, `item_shortdescription`, `guest_item`, `user_id`, `file1`, `file2`, `file3`, `external_url`, `controller`, `action`, `robots`, `published_at`, `published_end_at`, `meta_title`, `meta_description`, `html_sitemap`, `html_sitemap_order`, `admin_module`, `custom_view`, `display_order`, `display_status`, `deleted_status`, `deleted_by`, `deleted_by_name`, `deleted_time`, `created_at`, `updated_at`) VALUES
(584, 'Clients', 'clients', 0, 'blogs', NULL, '<p>All Sections</p>', NULL, 'N', 1, NULL, NULL, NULL, NULL, 'allsections', 'index', 'INDEX, FOLLOW', '2019-03-22', NULL, 'All Clients', 'All Clients', 'Y', 344, 'Y', NULL, 10, 'Y', 'N', 0, NULL, NULL, '2019-03-22 05:23:36', '2019-03-22 05:23:36');

--
-- Triggers `items`
--
DROP TRIGGER IF EXISTS `Item_Delete_Log`;
DELIMITER $$
CREATE TRIGGER `Item_Delete_Log` BEFORE DELETE ON `items` FOR EACH ROW BEGIN
DECLARE username varchar(255);
SELECT users.name INTO username from users WHERE id = OLD.user_id;
INSERT INTO `item_logs`(`item_id`, `change_date`, `user_id`, `user_name`, `action`) VALUES (OLD.item_id,CURRENT_TIMESTAMP,OLD.user_id,username,'DELETE');
END
$$
DELIMITER ;
DROP TRIGGER IF EXISTS `Item_Logs`;
DELIMITER $$
CREATE TRIGGER `Item_Logs` AFTER INSERT ON `items` FOR EACH ROW BEGIN
DECLARE username varchar(255);
SELECT users.name INTO username from users WHERE id = NEW.user_id;
INSERT INTO `item_logs`(`item_id`, `change_date`, `user_id`, `user_name`, `action`) VALUES (NEW.item_id,CURRENT_TIMESTAMP,NEW.user_id,username,'INSERT');
END
$$
DELIMITER ;
DROP TRIGGER IF EXISTS `Item_Update_Log`;
DELIMITER $$
CREATE TRIGGER `Item_Update_Log` BEFORE UPDATE ON `items` FOR EACH ROW BEGIN
DECLARE username varchar(255);
SELECT users.name INTO username from users WHERE id = NEW.user_id;
INSERT INTO `item_logs`(`item_id`, `change_date`, `user_id`, `user_name`, `action`) VALUES (NEW.item_id,CURRENT_TIMESTAMP,NEW.user_id,username,'UPDATE');
END
$$
DELIMITER ;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
