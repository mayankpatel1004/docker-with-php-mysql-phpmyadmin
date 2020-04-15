-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 14, 2019 at 09:08 AM
-- Server version: 10.2.27-MariaDB
-- PHP Version: 7.2.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `u475647915_tring`
--

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `display_status` enum('1','0') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1',
  `deleted_status` enum('1','0') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `name`, `display_status`, `deleted_status`, `created_at`, `updated_at`) VALUES
(1, 'Printer', '1', '0', '2019-07-17 05:53:33', '2019-09-17 07:04:31'),
(3, 'Flax Print Banner', '1', '0', '2019-07-17 23:39:04', '2019-07-17 23:39:04'),
(4, 'Printer', '1', '0', '2019-07-17 23:57:24', '2019-09-16 06:16:09'),
(5, 'Curtain', '1', '0', '2019-07-18 00:37:59', '2019-09-21 00:00:32'),
(6, 'Laptop', '1', '0', '2019-07-18 00:45:48', '2019-09-21 00:00:10'),
(7, 'Desktop', '1', '0', '2019-07-29 01:43:06', '2019-09-20 23:59:59'),
(8, 'Desktop', '1', '0', '2019-07-29 01:53:43', '2019-09-18 00:42:59'),
(9, 'Desktop', '1', '0', '2019-07-29 01:56:48', '2019-07-29 01:56:48'),
(10, 'UPS', '1', '0', '2019-07-29 02:08:02', '2019-07-29 02:08:02'),
(11, 'Wi-Fi Router', '1', '0', '2019-07-29 02:11:48', '2019-07-29 02:11:48'),
(12, 'Table', '1', '0', '2019-07-29 02:56:31', '2019-09-21 00:01:38'),
(13, 'Chair', '1', '0', '2019-07-29 02:58:48', '2019-09-21 00:01:46'),
(14, 'Projector', '1', '0', '2019-07-29 03:03:01', '2019-09-18 00:28:41'),
(15, 'Charging Cart', '1', '0', '2019-07-29 03:04:38', '2019-07-29 03:04:38'),
(16, 'Visual Presenter', '1', '0', '2019-07-29 03:06:02', '2019-07-29 03:06:02'),
(17, 'Laser Pointer', '1', '0', '2019-07-29 03:09:08', '2019-07-29 03:09:08'),
(18, 'Wireless Audio System', '1', '0', '2019-07-29 03:11:31', '2019-07-29 03:11:31'),
(19, 'Board', '1', '0', '2019-07-29 03:14:06', '2019-09-21 00:01:24'),
(20, 'Board', '1', '0', '2019-07-29 03:16:53', '2019-09-21 00:02:37'),
(21, 'Keybox', '1', '0', '2019-07-29 03:20:26', '2019-07-29 03:20:26'),
(22, 'Board', '1', '0', '2019-07-29 03:24:05', '2019-09-21 00:02:56'),
(23, 'TV', '1', '0', '2019-08-12 23:37:48', '2019-09-21 00:03:42'),
(24, 'Printer', '1', '0', '2019-08-20 00:34:16', '2019-09-21 00:03:13'),
(25, 'Laptop', '1', '0', '2019-08-24 00:55:47', '2019-09-21 00:03:29'),
(26, 'Table', '1', '0', '2019-09-17 06:44:02', '2019-09-17 06:44:02'),
(27, 'Podium', '1', '0', '2019-09-17 06:55:11', '2019-09-17 06:55:11'),
(28, 'Board', '1', '0', '2019-09-17 06:57:47', '2019-09-17 06:57:47'),
(29, 'TV', '1', '0', '2019-09-17 07:13:38', '2019-09-17 07:13:38'),
(30, 'Projector', '1', '0', '2019-09-17 07:15:36', '2019-09-17 07:15:36'),
(31, 'Cabinate Wall Mount', '1', '0', '2019-09-17 07:19:53', '2019-09-17 07:19:53'),
(32, 'Mayank', '1', '0', '2019-11-11 10:24:43', '2019-11-11 10:24:43'),
(33, 'Mayank update', '1', '0', '2019-11-11 10:25:44', '2019-11-11 10:25:44');

-- --------------------------------------------------------

--
-- Table structure for table `certificates`
--

CREATE TABLE `certificates` (
  `certificate_id` bigint(20) UNSIGNED NOT NULL,
  `course_id` int(11) NOT NULL DEFAULT 0,
  `trainee_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `trainee_email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `duration_from` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `duration_to` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `additional1` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `additional2` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_by` int(11) NOT NULL DEFAULT 0,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `course`
--

CREATE TABLE `course` (
  `course_id` bigint(20) UNSIGNED NOT NULL,
  `trainee_id` int(11) NOT NULL DEFAULT 0,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `duration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `preferred_date` date DEFAULT NULL,
  `preferred_time` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `additional` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `additional2` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_by` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `course`
--

INSERT INTO `course` (`course_id`, `trainee_id`, `name`, `duration`, `preferred_date`, `preferred_time`, `additional`, `additional2`, `created_by`, `created_at`, `updated_at`) VALUES
(1, 0, 'DIGITAL SURVEYING', '0', NULL, NULL, NULL, NULL, 0, '2019-07-22 01:26:20', '2019-07-22 01:26:20'),
(2, 0, 'Slab Track Casting, Transportation & Construction', '0', NULL, NULL, NULL, NULL, 0, '2019-08-08 03:13:48', '2019-08-08 03:13:48'),
(3, 0, 'Planning, Scheduling, Monitoring & Billing Process', '0', NULL, NULL, NULL, NULL, 0, '2019-08-20 01:16:43', '2019-08-22 05:24:48');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

CREATE TABLE `feedback` (
  `feedback_id` bigint(20) UNSIGNED NOT NULL,
  `feedback_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `contact_number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `changed_by` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `hostel`
--

CREATE TABLE `hostel` (
  `hostel_id` bigint(20) UNSIGNED NOT NULL,
  `occupancy` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `capacity` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1',
  `room_number` int(11) NOT NULL DEFAULT 0,
  `level` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `furnished` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `floor` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_by` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `hostel`
--

INSERT INTO `hostel` (`hostel_id`, `occupancy`, `capacity`, `room_number`, `level`, `furnished`, `floor`, `description`, `created_by`, `created_at`, `updated_at`) VALUES
(1, 'Double Occupancy', '2', 202, 'No Supervisory', 'Yes', 'First', 'Double room', 0, '2019-11-13 08:48:17', '2019-11-13 08:53:54'),
(2, 'Double Occupancy', '2', 203, 'No Supervisory', 'Yes', 'Second', 'Full furnished', 0, '2019-11-13 08:54:17', '2019-11-13 08:54:17'),
(3, 'Single Occupancy', '1', 101, 'Executive and above', 'Yes', 'Ground', 'Fully furnished room for officers', 0, '2019-11-13 09:02:03', '2019-11-13 09:02:03'),
(4, 'Double Occupancy', '2', 523, 'No Supervisory', 'No', 'Ground', 'NA', 0, '2019-11-13 10:06:53', '2019-11-13 10:07:37');

-- --------------------------------------------------------

--
-- Table structure for table `hostel_room`
--

CREATE TABLE `hostel_room` (
  `hostel_room_id` bigint(20) UNSIGNED NOT NULL,
  `hostel_id` int(11) NOT NULL DEFAULT 0,
  `charges` decimal(8,2) NOT NULL DEFAULT 0.00,
  `trainee_id` int(11) NOT NULL DEFAULT 0,
  `booking_date` date DEFAULT NULL,
  `booking_end_date` date DEFAULT NULL,
  `booking_full_startdate` datetime DEFAULT NULL,
  `booking_full_enddate` datetime DEFAULT NULL,
  `booking_time_start` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `booking_time_end` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `checkout_done` enum('Yes','No') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'No',
  `bill_cleared` enum('Yes','No') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'No',
  `any_breakage` enum('Yes','No') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'No',
  `payment_done` enum('Yes','No') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'No',
  `checkout_remark` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `checkout_time` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `checkout_date` date DEFAULT NULL,
  `checkout_by` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_by` int(11) NOT NULL DEFAULT 0,
  `created_by_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deleted_status` enum('1','0') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `deleted_by` int(11) NOT NULL DEFAULT 0,
  `deleted_date` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `hostel_room`
--

INSERT INTO `hostel_room` (`hostel_room_id`, `hostel_id`, `charges`, `trainee_id`, `booking_date`, `booking_end_date`, `booking_full_startdate`, `booking_full_enddate`, `booking_time_start`, `booking_time_end`, `description`, `checkout_done`, `bill_cleared`, `any_breakage`, `payment_done`, `checkout_remark`, `checkout_time`, `checkout_date`, `checkout_by`, `created_by`, `created_by_name`, `deleted_status`, `deleted_by`, `deleted_date`, `created_at`, `updated_at`) VALUES
(1, 1, '0.00', 64, '2019-11-13', '2019-11-16', '2019-11-13 11:00:00', '2019-11-16 09:59:00', '11:00', '10:00', 'Mayank Booked', 'No', 'No', 'No', 'No', NULL, NULL, NULL, NULL, 1, NULL, '1', 1, NULL, '2019-11-13 09:02:37', '2019-11-13 09:02:37'),
(2, 1, '0.00', 68, '2019-11-13', '2019-11-15', '2019-11-13 11:00:00', '2019-11-15 09:59:00', '11:00', '10:00', 'Mrugesh partner with mayank', 'No', 'No', 'No', 'No', NULL, NULL, NULL, NULL, 1, NULL, '1', 1, NULL, '2019-11-13 09:03:37', '2019-11-13 09:03:37'),
(3, 2, '0.00', 66, '2019-11-13', '2019-11-14', '2019-11-13 11:00:00', '2019-11-14 09:59:00', '11:00', '10:00', 'Checkout done', 'No', 'No', 'No', 'No', NULL, NULL, NULL, NULL, 1, NULL, '0', 0, NULL, '2019-11-13 09:04:09', '2019-11-13 09:04:09'),
(4, 1, '0.00', 66, '2019-11-13', '2019-11-16', '2019-11-13 11:00:00', '2019-11-16 09:59:00', '11:00', '10:00', 'This is testing description', 'No', 'No', 'No', 'No', NULL, NULL, NULL, NULL, 1, NULL, '0', 0, NULL, '2019-11-13 09:11:38', '2019-11-13 09:11:38'),
(5, 4, '0.00', 65, '2019-11-14', '2019-11-16', '2019-11-14 10:00:00', '2019-11-16 09:59:00', '10:00', '10:00', NULL, 'No', 'No', 'No', 'No', NULL, NULL, NULL, NULL, 1, NULL, '0', 0, NULL, '2019-11-13 10:12:27', '2019-11-13 10:12:27'),
(6, 4, '0.00', 66, '2019-11-14', '2019-11-16', '2019-11-14 10:00:00', '2019-11-16 09:59:00', '10:00', '10:00', NULL, 'No', 'No', 'No', 'No', NULL, NULL, NULL, NULL, 1, NULL, '0', 0, NULL, '2019-11-13 10:13:27', '2019-11-13 10:13:27');

-- --------------------------------------------------------

--
-- Table structure for table `hostel_room_activity`
--

CREATE TABLE `hostel_room_activity` (
  `hostel_room_activity_id` bigint(20) UNSIGNED NOT NULL,
  `hostel_room_id` int(11) NOT NULL DEFAULT 0,
  `hostel_id` int(11) NOT NULL DEFAULT 0,
  `trainee_id` int(11) NOT NULL DEFAULT 0,
  `booking_full_startdate` datetime DEFAULT NULL,
  `booking_full_enddate` datetime DEFAULT NULL,
  `checkout_by` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `charges` decimal(8,2) NOT NULL DEFAULT 0.00,
  `bill_cleared` enum('Yes','No') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'No',
  `any_breakage` enum('Yes','No') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'No',
  `payment_done` enum('Yes','No') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'No',
  `checkout_date` date DEFAULT NULL,
  `checkout_time` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `checkout_remark` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `hostel_room_activity`
--

INSERT INTO `hostel_room_activity` (`hostel_room_activity_id`, `hostel_room_id`, `hostel_id`, `trainee_id`, `booking_full_startdate`, `booking_full_enddate`, `checkout_by`, `description`, `charges`, `bill_cleared`, `any_breakage`, `payment_done`, `checkout_date`, `checkout_time`, `checkout_remark`, `created_at`, `updated_at`) VALUES
(1, 2, 1, 68, '2019-11-13 11:00:00', '2019-11-15 09:59:00', 'Administrator Role', 'Mrugesh partner with mayank', '300.00', 'Yes', 'Yes', 'Yes', '2019-11-16', '09:10', 'This is checkout remark by administrator', '2019-11-13 09:11:10', '2019-11-13 09:11:10'),
(2, 1, 1, 64, '2019-11-13 11:00:00', '2019-11-16 09:59:00', 'Administrator Role', 'Mayank Booked', '0.00', 'Yes', 'No', 'Yes', '2019-11-13', '10:37', 'kjhkj', '2019-11-13 10:37:30', '2019-11-13 10:37:30');

-- --------------------------------------------------------

--
-- Table structure for table `inches`
--

CREATE TABLE `inches` (
  `id` int(10) UNSIGNED NOT NULL,
  `inches` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `display_status` enum('1','0') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1',
  `deleted_status` enum('1','0') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `inches`
--

INSERT INTO `inches` (`id`, `inches`, `display_status`, `deleted_status`, `created_at`, `updated_at`) VALUES
(1, NULL, '1', '0', '2019-07-17 05:53:33', '2019-07-17 05:53:33'),
(2, '1', '1', '0', '2019-07-17 06:07:48', '2019-07-17 06:07:48'),
(3, '14', '1', '0', '2019-07-18 00:45:47', '2019-07-18 00:45:47');

-- --------------------------------------------------------

--
-- Table structure for table `inventories`
--

CREATE TABLE `inventories` (
  `inventory_id` bigint(20) UNSIGNED NOT NULL,
  `make` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `model` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `year` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `supplier` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `consumable` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `category` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `po_number` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bill_no` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `item_unit` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `attachment` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `picture` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `purchase_date` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `total_inventory` decimal(10,2) DEFAULT NULL,
  `cost` decimal(10,2) DEFAULT NULL,
  `size` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `color` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `warrenty` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `item_description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deleted_status` enum('0','1') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `deleted_date` date DEFAULT NULL,
  `deleted_by` int(11) NOT NULL DEFAULT 0,
  `deleted_by_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_by` int(11) NOT NULL DEFAULT 0,
  `created_by_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `inventories`
--

INSERT INTO `inventories` (`inventory_id`, `make`, `model`, `year`, `supplier`, `consumable`, `category`, `po_number`, `bill_no`, `item_unit`, `attachment`, `picture`, `purchase_date`, `total_inventory`, `cost`, `size`, `color`, `warrenty`, `item_description`, `status`, `deleted_status`, `deleted_date`, `deleted_by`, `deleted_by_name`, `created_by`, `created_by_name`, `created_at`, `updated_at`) VALUES
(1, 'Dell', 'Dell Latitude 3490', '2019', 'EDCIL House, 18A,Sector 16A, Noada (U.P.)', 'T&P', 'Laptop', 'NHSRCL/MA CEO3/TI-3/Gen-01/12', '03', NULL, NULL, NULL, '2019-04-16', '20.00', '1106360.00', '14\" Inch', 'Black', '1 Year', 'Dell Latitude 3490\r\n1 TB hard Disk \r\n4GB RAM\r\ni5, 8 GEN,1.60 -1.80 GHz\r\nWindows 10 Pro', 'InStore', '0', NULL, 0, NULL, 6, NULL, '2019-09-16 00:55:01', '2019-09-21 00:00:10'),
(2, 'EMERSON', 'Liebert ITON CX 1500 VA', '2019', 'EDCIL House, 18A,Sector 16A, Noada (U.P.)', 'T&P', 'UPS', 'NHSRCL/MA CE03/TI-3/Gen-01/12', '03', NULL, NULL, NULL, '2019-04-16', '4.00', '46824.00', 'Small', 'Black', '1 year', '3 UPS are installed in 3 corresponding training rooms.\r\n1st floor = 2 UPS\r\nGround floor = 1 UPS', 'InStore', '0', NULL, 0, NULL, 6, NULL, '2019-09-17 06:39:01', '2019-11-11 04:16:14'),
(3, 'D-Link', 'DIR-825', '2019', 'EDCIL House, 18A,Sector 16A, Noada (U.P.)', 'T&P', 'Wi-Fi Router', 'NHSRCL/MA CE03/TI-3/Gen-01/12', '03', NULL, NULL, NULL, '2019-04-16', '3.00', '10302.00', 'Small', 'Black', '1 year', '3 Router are purchased for 3 class rooms.', 'InStore', '0', NULL, 0, NULL, 6, NULL, '2019-09-17 06:41:35', '2019-09-17 06:41:35'),
(4, 'Godrej', 'Godrej Interio', '2019', 'EDCIL House, 18A,Sector 16A, Noada (U.P.)', 'T&P', 'Table', 'NHSRCL/MA CE03/TI-3/Gen-01/12', '03', NULL, NULL, NULL, '2019-04-16', '30.00', '437310.00', 'standard', 'white', '1 year', '30 Tables for Training purpose.', 'InStore', '0', NULL, 0, NULL, 6, NULL, '2019-09-17 06:44:02', '2019-09-20 23:53:05'),
(5, 'Godrej', 'Godrej Interio', '2019', 'EDCIL House, 18A,Sector 16A, Noada (U.P.)', 'T&P', 'Chair', 'NHSRCL/MA CE03/TI-3/Gen-01/12', '03', NULL, NULL, NULL, '2019-04-16', '60.00', '576300.00', 'small', 'blue', '1 Year', '2 Different colors of chairs are here for training rooms.\r\nBlue & Green', 'InStore', '0', NULL, 0, NULL, 6, NULL, '2019-09-17 06:47:22', '2019-09-21 00:01:46'),
(6, 'Flip chart Board', 'FLIP CHART', '2019', 'EDCIL House, 18A,Sector 16A, Noada (U.P.)', 'T&P', 'Charging Cart', 'NHSRCL/MA CE03/TI-3/Gen-01/12', '03', NULL, NULL, NULL, '2019-04-16', '1.00', '35898.00', 'medium', 'Red', '1 Year', 'Charging Cart is using for multiples Laptops Charging at One time.', 'InStore', '0', NULL, 0, NULL, 6, NULL, '2019-09-17 06:50:05', '2019-09-20 23:52:05'),
(7, 'Targus', 'FLIP CHART', '2019', 'EDCIL House, 18A,Sector 16A, Noada (U.P.)', 'T&P', 'Laser Pointer', 'NHSRCL/MA CE03/TI-3/Gen-01/12', '03', NULL, NULL, NULL, '2019-04-16', '3.00', '15426.00', 'small', 'black', '1 year', '3 Laser Pointer are use for presentation.', 'InStore', '0', NULL, 0, NULL, 6, NULL, '2019-09-17 06:53:16', '2019-09-18 00:31:24'),
(8, 'Flip chart Board', 'FLIP CHART', '2019', 'EDCIL House, 18A,Sector 16A, Noada (U.P.)', 'T&P', 'Podium', 'NHSRCL/MA CE03/TI-3/Gen-01/12', '03', NULL, NULL, NULL, '2019-04-16', '3.00', '190518.00', 'Standard', 'Black', '1 year', '3 Podium here for trainings', 'InStore', '0', NULL, 0, NULL, 6, NULL, '2019-09-17 06:55:11', '2019-09-20 23:52:05'),
(9, 'Flip chart Board', 'FLIP CHART', '2019', 'EDCIL House, 18A,Sector 16A, Noada (U.P.)', 'T&P', 'Board', 'NHSRCL/MA CE03/TI-3/Gen-01/12', '03', NULL, NULL, NULL, '2019-04-16', '3.00', '17289.00', 'small', 'white', 'N/A', '3 flip chart board are here for training.', 'InStore', '0', NULL, 0, NULL, 6, NULL, '2019-09-17 06:57:47', '2019-09-21 00:02:37'),
(10, 'Flip chart Board', 'FLIP CHART', '2019', 'EDCIL House, 18A,Sector 16A, Noada (U.P.)', 'T&P', 'Keybox', 'NHSRCL/MA CE03/TI-3/Gen-01/12', '03', NULL, NULL, NULL, '2019-04-16', '1.00', '10735.00', 'small', 'white', 'N/A', 'Keybox for rooms key management', 'InStore', '0', NULL, 0, NULL, 6, NULL, '2019-09-17 06:59:23', '2019-09-20 23:52:05'),
(11, 'Ceramic Board', 'FLIP CHART', '2019', 'EDCIL House, 18A,Sector 16A, Noada (U.P.)', 'T&P', 'Board', 'NHSRCL/MA CE03/TI-3/Gen-01/12', '03', NULL, NULL, NULL, '2019-04-16', '3.00', '37290.00', '8x3', 'white', 'N/A', '3 white ceramic has been changed dated 25 august 2019.', 'InStore', '0', NULL, 0, NULL, 6, NULL, '2019-09-17 07:03:34', '2019-09-21 00:02:37'),
(12, 'LG', '65TC3D-B.ATR', '2019', 'EDCIL House, 18A,Sector 16A, Noada (U.P.)', 'T&P', 'TV', 'NHSRCL/MA CE03/TI-3/Gen-01/12', '03', NULL, NULL, NULL, '2019-04-16', '1.00', '339000.00', '65\"', 'Black', '1 year', 'LED Interactive Panel Is smart Boad which is used to smart Class and so on.', 'InStore', '0', NULL, 0, NULL, 6, NULL, '2019-09-17 07:13:38', '2019-09-21 00:03:42'),
(13, 'K-Yan', 'K-Yan', '2019', 'EDCIL House, 18A,Sector 16A, Noada (U.P.)', 'T&P', 'Projector', 'NHSRCL/MA CE03/TI-3/Gen-01/12', '03', NULL, NULL, NULL, '2019-04-16', '3.00', '40680.00', 'Standard', 'Black', '1 Year', '3 Projectors are installed for training in TI', 'InStore', '0', NULL, 0, NULL, 6, NULL, '2019-09-17 07:15:36', '2019-09-17 07:15:36'),
(14, 'Cabinate wall Mount', 'FLIP CHART', '2019', 'EDCIL House, 18A,Sector 16A, Noada (U.P.)', 'T&P', 'Cabinate Wall Mount', 'NHSRCL/MA CE03/TI-3/Gen-01/12', '03', NULL, NULL, NULL, '2019-04-16', '3.00', '18645.00', 'Small', 'Grey', 'N/A', 'Cabinate Wall  mount are installed for UPS Using 3 projectors.', 'InStore', '0', NULL, 0, NULL, 6, NULL, '2019-09-17 07:19:53', '2019-09-18 00:31:24'),
(15, 'Exhibition Board', 'Stand Board', '2019', 'EDCIL House, 18A,Sector 16A, Noada (U.P.)', 'T&P', 'Board', 'NHSRCL/MA CE03TI-3/Gen-01/12', '03', NULL, NULL, NULL, '2019-04-16', '3.00', '29380.00', '2x3', 'Black', '1 Year', 'Exhibition Board has to be changed.still not change.', 'InStore', '0', NULL, 0, NULL, 6, NULL, '2019-09-21 00:16:49', '2019-09-21 00:16:49'),
(16, 'HP', 'HP Laserjet Pro 377dw', '2019', 'Digiflux', 'Consumable', 'DesKTop', '123456', '2345678', NULL, '1569567306_5.jpg', NULL, '2019-09-27', '11.00', '333.00', '222', '1111', '111', 'test', 'InStore', '0', NULL, 0, NULL, 1, NULL, '2019-09-27 06:55:06', '2019-09-27 06:55:06'),
(17, 'Mayank update', 'Mayank update', '1987', 'Mayank update', 'T&P', 'Mayank update', 'Mayank update', '1112222', 'Number', '1573467944_reports (2).txt', '1573467944_p_reports (5).csv', '2020-12-02', '12.40', '22.32', '11', 'Green', '3 Years', 'Mayank', 'InStore', '0', NULL, 0, NULL, 1, NULL, '2019-11-11 10:24:43', '2019-11-11 10:25:44');

-- --------------------------------------------------------

--
-- Table structure for table `inventories_activity`
--

CREATE TABLE `inventories_activity` (
  `inventory_activity_id` bigint(20) UNSIGNED NOT NULL,
  `inventory_id` int(11) NOT NULL DEFAULT 0,
  `make` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `model` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `year` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `supplier` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `consumable` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `category` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `po_number` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bill_no` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `item_unit` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `attachment` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `picture` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `purchase_date` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `total_inventory` decimal(10,2) DEFAULT NULL,
  `cost` decimal(10,2) DEFAULT NULL,
  `size` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `color` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `warrenty` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `item_description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `action` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deleted_status` enum('0','1') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `deleted_date` date DEFAULT NULL,
  `deleted_by` int(11) NOT NULL DEFAULT 0,
  `deleted_by_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_by` int(11) NOT NULL DEFAULT 0,
  `created_by_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `inventories_activity`
--

INSERT INTO `inventories_activity` (`inventory_activity_id`, `inventory_id`, `make`, `model`, `year`, `supplier`, `consumable`, `category`, `po_number`, `bill_no`, `item_unit`, `attachment`, `picture`, `purchase_date`, `total_inventory`, `cost`, `size`, `color`, `warrenty`, `item_description`, `status`, `action`, `deleted_status`, `deleted_date`, `deleted_by`, `deleted_by_name`, `created_by`, `created_by_name`, `created_at`, `updated_at`) VALUES
(1, 1, 'Dell', 'Dell Latitude 3490', '2019', 'EDCIL House, 18A,Sector 16A, Noada (U.P.)', 'T&P', 'Laptop', 'NHSRCL/MA CEO3/TI-3/Gen-01/12', '03', NULL, NULL, NULL, '2019-04-16', '20.00', '1106360.00', '14\" Inch', 'Black', '1 Year', 'Dell Latitude 3490\r\n1 TB hard Disk \r\n4GB RAM\r\ni5, 8 GEN,1.60 -1.80 GHz\r\nWindows 10 Pro', 'InStore', 'Add', '0', NULL, 0, NULL, 6, 'Vinay', '2019-09-16 00:55:01', '2019-09-21 00:00:10'),
(2, 2, 'EMERSON', 'Liebert ITON CX 1500 VA', '2019', 'EDCIL House, 18A,Sector 16A, Noada (U.P.)', 'T&P', 'UPS', 'NHSRCL/MA CE03/TI-3/Gen-01/12', '03', NULL, NULL, NULL, '2019-04-16', '3.00', '46824.00', 'Small', 'Black', '1 year', '3 UPS are installed in 3 corresponding training rooms.\r\n1st floor = 2 UPS\r\nGround floor = 1 UPS', 'InStore', 'Add', '0', NULL, 0, NULL, 6, 'Vinay', '2019-09-17 06:39:01', '2019-09-17 06:39:01'),
(3, 3, 'D-Link', 'DIR-825', '2019', 'EDCIL House, 18A,Sector 16A, Noada (U.P.)', 'T&P', 'Wi-Fi Router', 'NHSRCL/MA CE03/TI-3/Gen-01/12', '03', NULL, NULL, NULL, '2019-04-16', '3.00', '10302.00', 'Small', 'Black', '1 year', '3 Router are purchased for 3 class rooms.', 'InStore', 'Add', '0', NULL, 0, NULL, 6, 'Vinay', '2019-09-17 06:41:35', '2019-09-17 06:41:35'),
(4, 4, 'Godrej', 'Godrej Interio', '2019', 'EDCIL House, 18A,Sector 16A, Noada (U.P.)', 'T&P', 'Table', 'NHSRCL/MA CE03/TI-3/Gen-01/12', '03', NULL, NULL, NULL, '2019-04-16', '30.00', '437310.00', 'standard', 'white', '1 year', '30 Tables for Training purpose.', 'InStore', 'Add', '0', NULL, 0, NULL, 6, 'Vinay', '2019-09-17 06:44:02', '2019-09-20 23:53:05'),
(5, 5, 'Godrej', 'Godrej Interio', '2019', 'EDCIL House, 18A,Sector 16A, Noada (U.P.)', 'T&P', 'Chair', 'NHSRCL/MA CE03/TI-3/Gen-01/12', '03', NULL, NULL, NULL, '2019-04-16', '60.00', '576300.00', 'small', 'blue', '1 Year', '2 Different colors of chairs are here for training rooms.\r\nBlue & Green', 'InStore', 'Add', '0', NULL, 0, NULL, 6, 'Vinay', '2019-09-17 06:47:22', '2019-09-21 00:01:46'),
(6, 6, 'Flip chart Board', 'FLIP CHART', '2019', 'EDCIL House, 18A,Sector 16A, Noada (U.P.)', 'T&P', 'Charging Cart', 'NHSRCL/MA CE03/TI-3/Gen-01/12', '03', NULL, NULL, NULL, '2019-04-16', '1.00', '35898.00', 'medium', 'Red', '1 Year', 'Charging Cart is using for multiples Laptops Charging at One time.', 'InStore', 'Add', '0', NULL, 0, NULL, 6, 'Vinay', '2019-09-17 06:50:05', '2019-09-20 23:52:05'),
(7, 7, 'Targus', 'FLIP CHART', '2019', 'EDCIL House, 18A,Sector 16A, Noada (U.P.)', 'T&P', 'Laser Pointer', 'NHSRCL/MA CE03/TI-3/Gen-01/12', '03', NULL, NULL, NULL, '2019-04-16', '3.00', '15426.00', 'small', 'black', '1 year', '3 Laser Pointer are use for presentation.', 'InStore', 'Add', '0', NULL, 0, NULL, 6, 'Vinay', '2019-09-17 06:53:16', '2019-09-18 00:31:24'),
(8, 8, 'Flip chart Board', 'FLIP CHART', '2019', 'EDCIL House, 18A,Sector 16A, Noada (U.P.)', 'T&P', 'Podium', 'NHSRCL/MA CE03/TI-3/Gen-01/12', '03', NULL, NULL, NULL, '2019-04-16', '3.00', '190518.00', 'Standard', 'Black', '1 year', '3 Podium here for trainings', 'InStore', 'Add', '0', NULL, 0, NULL, 6, 'Vinay', '2019-09-17 06:55:11', '2019-09-20 23:52:05'),
(9, 9, 'Flip chart Board', 'FLIP CHART', '2019', 'EDCIL House, 18A,Sector 16A, Noada (U.P.)', 'T&P', 'Board', 'NHSRCL/MA CE03/TI-3/Gen-01/12', '03', NULL, NULL, NULL, '2019-04-16', '3.00', '17289.00', 'small', 'white', 'N/A', '3 flip chart board are here for training.', 'InStore', 'Add', '0', NULL, 0, NULL, 6, 'Vinay', '2019-09-17 06:57:47', '2019-09-21 00:02:37'),
(10, 10, 'Flip chart Board', 'FLIP CHART', '2019', 'EDCIL House, 18A,Sector 16A, Noada (U.P.)', 'T&P', 'Keybox', 'NHSRCL/MA CE03/TI-3/Gen-01/12', '03', NULL, NULL, NULL, '2019-04-16', '1.00', '10735.00', 'small', 'white', 'N/A', 'Keybox for rooms key management', 'InStore', 'Add', '0', NULL, 0, NULL, 6, 'Vinay', '2019-09-17 06:59:23', '2019-09-20 23:52:05'),
(11, 11, 'Ceramic Board', 'FLIP CHART', '2019', 'EDCIL House, 18A,Sector 16A, Noada (U.P.)', 'T&P', 'Board', 'NHSRCL/MA CE03/TI-3/Gen-01/12', '03', NULL, NULL, NULL, '2019-04-16', '3.00', '37290.00', '8x3', 'white', 'N/A', '3 white ceramic has been changed dated 25 august 2019.', 'InStore', 'Add', '0', NULL, 0, NULL, 6, 'Vinay', '2019-09-17 07:03:34', '2019-09-21 00:02:37'),
(12, 12, 'LG', '65TC3D-B.ATR', '2019', 'EDCIL House, 18A,Sector 16A, Noada (U.P.)', 'T&P', 'TV', 'NHSRCL/MA CE03/TI-3/Gen-01/12', '03', NULL, NULL, NULL, '2019-04-16', '1.00', '339000.00', '65\"', 'Black', '1 year', 'LED Interactive Panel Is smart Boad which is used to smart Class and so on.', 'InStore', 'Add', '0', NULL, 0, NULL, 6, 'Vinay', '2019-09-17 07:13:38', '2019-09-21 00:03:42'),
(13, 13, 'K-Yan', 'K-Yan', '2019', 'EDCIL House, 18A,Sector 16A, Noada (U.P.)', 'T&P', 'Projector', 'NHSRCL/MA CE03/TI-3/Gen-01/12', '03', NULL, NULL, NULL, '2019-04-16', '3.00', '40680.00', 'Standard', 'Black', '1 Year', '3 Projectors are installed for training in TI', 'InStore', 'Add', '0', NULL, 0, NULL, 6, 'Vinay', '2019-09-17 07:15:36', '2019-09-17 07:15:36'),
(14, 14, 'Cabinate wall Mount', 'FLIP CHART', '2019', 'EDCIL House, 18A,Sector 16A, Noada (U.P.)', 'T&P', 'Cabinate Wall Mount', 'NHSRCL/MA CE03/TI-3/Gen-01/12', '03', NULL, NULL, NULL, '2019-04-16', '3.00', '18645.00', 'Small', 'Grey', 'N/A', 'Cabinate Wall  mount are installed for UPS Using 3 projectors.', 'InStore', 'Add', '0', NULL, 0, NULL, 6, 'Vinay', '2019-09-17 07:19:53', '2019-09-18 00:31:24'),
(15, 15, 'Exhibition Board', 'Stand Board', '2019', 'EDCIL House, 18A,Sector 16A, Noada (U.P.)', 'T&P', 'Board', 'NHSRCL/MA CE03TI-3/Gen-01/12', '03', NULL, NULL, NULL, '2019-04-16', '3.00', '29380.00', '2x3', 'Black', '1 Year', 'Exhibition Board has to be changed.still not change.', 'InStore', 'Add', '0', NULL, 0, NULL, 6, 'Vinay', '2019-09-21 00:16:49', '2019-09-21 00:16:49'),
(16, 16, 'HP', 'HP Laserjet Pro 377dw', '2019', 'Digiflux', 'Consumable', 'DesKTop', '123456', '2345678', NULL, '1569567306_5.jpg', NULL, '2019-09-27', '11.00', '333.00', '222', '1111', '111', 'test', 'InStore', 'Add', '0', NULL, 0, NULL, 1, 'Administrator Role', '2019-09-27 06:55:06', '2019-09-27 06:55:06'),
(17, 2, 'EMERSON', 'Liebert ITON CX 1500 VA', '2019', 'EDCIL House, 18A,Sector 16A, Noada (U.P.)', 'T&P', 'UPS', 'NHSRCL/MA CE03/TI-3/Gen-01/12', '03', NULL, NULL, NULL, '2019-04-16', '4.00', '46824.00', 'Small', 'Black', '1 year', '3 UPS are installed in 3 corresponding training rooms.\r\n1st floor = 2 UPS\r\nGround floor = 1 UPS', NULL, 'Update', '0', NULL, 0, NULL, 1, 'Administrator Role', '2019-11-11 04:16:14', '2019-11-11 04:16:14'),
(18, 2, 'EMERSON', 'Liebert ITON CX 1500 VA', '2019', 'EDCIL House, 18A,Sector 16A, Noada (U.P.)', 'T&P', 'UPS', 'NHSRCL/MA CE03/TI-3/Gen-01/12', '03', NULL, NULL, NULL, '2019-04-16', '4.00', '46824.00', 'Small', 'Black', '1 year', '3 UPS are installed in 3 corresponding training rooms.\r\n1st floor = 2 UPS\r\nGround floor = 1 UPS', NULL, 'Update', '0', NULL, 0, NULL, 1, 'Administrator Role', '2019-11-11 04:16:14', '2019-11-11 04:16:14'),
(19, 17, 'Mayank', 'Mayank', '1987', 'Mayank', 'Consumable', 'Mayank', 'Mayank', '111', 'Number', '1573467883_training_center_2019-09-19_09_49_40.sql', '1573467883_p_training_center_2019-09-19_09_49_40.sql', '2020-01-01', '12.40', '22.22', '22', 'Black', '2 Years', 'Mayank', 'InStore', 'Add', '0', NULL, 0, NULL, 1, 'Administrator Role', '2019-11-11 10:24:43', '2019-11-11 10:24:43'),
(20, 17, 'Mayank update', 'Mayank update', '1987', 'Mayank update', 'T&P', 'Mayank update', 'Mayank update', '1112222', 'Number', '1573467944_reports (2).txt', '1573467944_p_reports (5).csv', '2020-12-02', '12.40', '22.32', '11', 'Green', '3 Years', 'Mayank', NULL, 'Update', '0', NULL, 0, NULL, 1, 'Administrator Role', '2019-11-11 10:25:44', '2019-11-11 10:25:44');

-- --------------------------------------------------------

--
-- Table structure for table `inventory_details`
--

CREATE TABLE `inventory_details` (
  `inventory_detail_id` bigint(20) UNSIGNED NOT NULL,
  `inventory_id` int(11) NOT NULL DEFAULT 0,
  `unique_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `make` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `model` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `year` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `supplier` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `consumable` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `category` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `po_number` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bill_no` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `item_unit` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `purchase_date` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `total_inventory` decimal(10,2) DEFAULT NULL,
  `cost` decimal(10,2) DEFAULT NULL,
  `size` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `color` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `warrenty` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `item_description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `location` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `service_period` int(11) NOT NULL DEFAULT 0,
  `remarks` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `outward_date` date DEFAULT NULL,
  `outward_by` int(11) NOT NULL DEFAULT 0,
  `outward_by_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deleted_status` enum('0','1') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `deleted_date` date DEFAULT NULL,
  `deleted_by` int(11) NOT NULL DEFAULT 0,
  `deleted_by_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_by` int(11) NOT NULL DEFAULT 0,
  `created_by_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `inventory_details`
--

INSERT INTO `inventory_details` (`inventory_detail_id`, `inventory_id`, `unique_id`, `make`, `model`, `year`, `supplier`, `consumable`, `category`, `po_number`, `bill_no`, `item_unit`, `purchase_date`, `total_inventory`, `cost`, `size`, `color`, `warrenty`, `item_description`, `status`, `location`, `service_period`, `remarks`, `outward_date`, `outward_by`, `outward_by_name`, `deleted_status`, `deleted_date`, `deleted_by`, `deleted_by_name`, `created_by`, `created_by_name`, `created_at`, `updated_at`) VALUES
(1, 1, '8X70XS2', 'Dell', 'Dell Latitude 3490', '2019', 'EDCIL House, 18A,Sector 16A, Noada (U.P.)', 'T&P', 'Laptop', 'NHSRCL/MA CEO3/TI-3/Gen-01/12', '03', NULL, '2019-04-16', '20.00', '1106360.00', '14\" Inch', 'Black', '1 Year', 'Dell Latitude 3490\r\n1 TB hard Disk \r\n4GB RAM\r\ni5, 8 GEN,1.60 -1.80 GHz\r\nWindows 10 Pro', 'Dispatched', 'hall 2', 0, 'vinay 1', '2019-09-16', 6, 'Vinay', '0', NULL, 0, NULL, 6, NULL, '2019-09-16 00:55:01', '2019-09-21 00:00:10'),
(2, 1, '7JVSWS2', 'Dell', 'Dell Latitude 3490', '2019', 'EDCIL House, 18A,Sector 16A, Noada (U.P.)', 'T&P', 'Laptop', 'NHSRCL/MA CEO3/TI-3/Gen-01/12', '03', NULL, '2019-04-16', '20.00', '1106360.00', '14\" Inch', 'Black', '1 Year', 'Dell Latitude 3490\r\n1 TB hard Disk \r\n4GB RAM\r\ni5, 8 GEN,1.60 -1.80 GHz\r\nWindows 10 Pro', 'InStore', NULL, 0, NULL, NULL, 0, NULL, '0', NULL, 0, NULL, 6, NULL, '2019-09-16 00:55:01', '2019-09-21 00:00:10'),
(3, 1, 'FCPZWS2', 'Dell', 'Dell Latitude 3490', '2019', 'EDCIL House, 18A,Sector 16A, Noada (U.P.)', 'T&P', 'Laptop', 'NHSRCL/MA CEO3/TI-3/Gen-01/12', '03', NULL, '2019-04-16', '20.00', '1106360.00', '14\" Inch', 'Black', '1 Year', 'Dell Latitude 3490\r\n1 TB hard Disk \r\n4GB RAM\r\ni5, 8 GEN,1.60 -1.80 GHz\r\nWindows 10 Pro', 'InStore', NULL, 0, NULL, NULL, 0, NULL, '0', NULL, 0, NULL, 6, NULL, '2019-09-16 00:55:01', '2019-09-21 00:00:10'),
(4, 1, '94MOXS2', 'Dell', 'Dell Latitude 3490', '2019', 'EDCIL House, 18A,Sector 16A, Noada (U.P.)', 'T&P', 'Laptop', 'NHSRCL/MA CEO3/TI-3/Gen-01/12', '03', NULL, '2019-04-16', '20.00', '1106360.00', '14\" Inch', 'Black', '1 Year', 'Dell Latitude 3490\r\n1 TB hard Disk \r\n4GB RAM\r\ni5, 8 GEN,1.60 -1.80 GHz\r\nWindows 10 Pro', 'InStore', NULL, 0, NULL, NULL, 0, NULL, '0', NULL, 0, NULL, 6, NULL, '2019-09-16 00:55:01', '2019-09-21 00:00:10'),
(5, 1, 'DW10XS2', 'Dell', 'Dell Latitude 3490', '2019', 'EDCIL House, 18A,Sector 16A, Noada (U.P.)', 'T&P', 'Laptop', 'NHSRCL/MA CEO3/TI-3/Gen-01/12', '03', NULL, '2019-04-16', '20.00', '1106360.00', '14\" Inch', 'Black', '1 Year', 'Dell Latitude 3490\r\n1 TB hard Disk \r\n4GB RAM\r\ni5, 8 GEN,1.60 -1.80 GHz\r\nWindows 10 Pro', 'InStore', NULL, 0, NULL, NULL, 0, NULL, '0', NULL, 0, NULL, 6, NULL, '2019-09-16 00:55:01', '2019-09-21 00:00:10'),
(6, 1, 'BWSWS2', 'Dell', 'Dell Latitude 3490', '2019', 'EDCIL House, 18A,Sector 16A, Noada (U.P.)', 'T&P', 'Laptop', 'NHSRCL/MA CEO3/TI-3/Gen-01/12', '03', NULL, '2019-04-16', '20.00', '1106360.00', '14\" Inch', 'Black', '1 Year', 'Dell Latitude 3490\r\n1 TB hard Disk \r\n4GB RAM\r\ni5, 8 GEN,1.60 -1.80 GHz\r\nWindows 10 Pro', 'InStore', NULL, 0, NULL, NULL, 0, NULL, '0', NULL, 0, NULL, 6, NULL, '2019-09-16 00:55:01', '2019-09-21 00:00:10'),
(7, 1, '76MOXS2', 'Dell', 'Dell Latitude 3490', '2019', 'EDCIL House, 18A,Sector 16A, Noada (U.P.)', 'T&P', 'Laptop', 'NHSRCL/MA CEO3/TI-3/Gen-01/12', '03', NULL, '2019-04-16', '20.00', '1106360.00', '14\" Inch', 'Black', '1 Year', 'Dell Latitude 3490\r\n1 TB hard Disk \r\n4GB RAM\r\ni5, 8 GEN,1.60 -1.80 GHz\r\nWindows 10 Pro', 'InStore', NULL, 0, NULL, NULL, 0, NULL, '0', NULL, 0, NULL, 6, NULL, '2019-09-16 00:55:01', '2019-09-21 00:00:10'),
(8, 1, '1HFOXS2', 'Dell', 'Dell Latitude 3490', '2019', 'EDCIL House, 18A,Sector 16A, Noada (U.P.)', 'T&P', 'Laptop', 'NHSRCL/MA CEO3/TI-3/Gen-01/12', '03', NULL, '2019-04-16', '20.00', '1106360.00', '14\" Inch', 'Black', '1 Year', 'Dell Latitude 3490\r\n1 TB hard Disk \r\n4GB RAM\r\ni5, 8 GEN,1.60 -1.80 GHz\r\nWindows 10 Pro', 'InStore', NULL, 0, NULL, NULL, 0, NULL, '0', NULL, 0, NULL, 6, NULL, '2019-09-16 00:55:01', '2019-09-21 00:00:10'),
(9, 1, '71MOXS2', 'Dell', 'Dell Latitude 3490', '2019', 'EDCIL House, 18A,Sector 16A, Noada (U.P.)', 'T&P', 'Laptop', 'NHSRCL/MA CEO3/TI-3/Gen-01/12', '03', NULL, '2019-04-16', '20.00', '1106360.00', '14\" Inch', 'Black', '1 Year', 'Dell Latitude 3490\r\n1 TB hard Disk \r\n4GB RAM\r\ni5, 8 GEN,1.60 -1.80 GHz\r\nWindows 10 Pro', 'InStore', NULL, 0, NULL, NULL, 0, NULL, '0', NULL, 0, NULL, 6, NULL, '2019-09-16 00:55:01', '2019-09-21 00:00:10'),
(10, 1, '3TVZWS2', 'Dell', 'Dell Latitude 3490', '2019', 'EDCIL House, 18A,Sector 16A, Noada (U.P.)', 'T&P', 'Laptop', 'NHSRCL/MA CEO3/TI-3/Gen-01/12', '03', NULL, '2019-04-16', '20.00', '1106360.00', '14\" Inch', 'Black', '1 Year', 'Dell Latitude 3490\r\n1 TB hard Disk \r\n4GB RAM\r\ni5, 8 GEN,1.60 -1.80 GHz\r\nWindows 10 Pro', 'InStore', NULL, 0, NULL, NULL, 0, NULL, '0', NULL, 0, NULL, 6, NULL, '2019-09-16 00:55:01', '2019-09-21 00:00:10'),
(11, 1, 'C2PSWS2', 'Dell', 'Dell Latitude 3490', '2019', 'EDCIL House, 18A,Sector 16A, Noada (U.P.)', 'T&P', 'Laptop', 'NHSRCL/MA CEO3/TI-3/Gen-01/12', '03', NULL, '2019-04-16', '20.00', '1106360.00', '14\" Inch', 'Black', '1 Year', 'Dell Latitude 3490\r\n1 TB hard Disk \r\n4GB RAM\r\ni5, 8 GEN,1.60 -1.80 GHz\r\nWindows 10 Pro', 'InStore', NULL, 0, NULL, NULL, 0, NULL, '0', NULL, 0, NULL, 6, NULL, '2019-09-16 00:55:01', '2019-09-21 00:00:10'),
(12, 1, 'GH1TWS2', 'Dell', 'Dell Latitude 3490', '2019', 'EDCIL House, 18A,Sector 16A, Noada (U.P.)', 'T&P', 'Laptop', 'NHSRCL/MA CEO3/TI-3/Gen-01/12', '03', NULL, '2019-04-16', '20.00', '1106360.00', '14\" Inch', 'Black', '1 Year', 'Dell Latitude 3490\r\n1 TB hard Disk \r\n4GB RAM\r\ni5, 8 GEN,1.60 -1.80 GHz\r\nWindows 10 Pro', 'InStore', NULL, 0, NULL, NULL, 0, NULL, '0', NULL, 0, NULL, 6, NULL, '2019-09-16 00:55:01', '2019-09-21 00:00:10'),
(13, 1, 'DH1TWS2', 'Dell', 'Dell Latitude 3490', '2019', 'EDCIL House, 18A,Sector 16A, Noada (U.P.)', 'T&P', 'Laptop', 'NHSRCL/MA CEO3/TI-3/Gen-01/12', '03', NULL, '2019-04-16', '20.00', '1106360.00', '14\" Inch', 'Black', '1 Year', 'Dell Latitude 3490\r\n1 TB hard Disk \r\n4GB RAM\r\ni5, 8 GEN,1.60 -1.80 GHz\r\nWindows 10 Pro', 'InStore', NULL, 0, NULL, NULL, 0, NULL, '0', NULL, 0, NULL, 6, NULL, '2019-09-16 00:55:01', '2019-09-21 00:00:10'),
(14, 1, '2XVZWS2', 'Dell', 'Dell Latitude 3490', '2019', 'EDCIL House, 18A,Sector 16A, Noada (U.P.)', 'T&P', 'Laptop', 'NHSRCL/MA CEO3/TI-3/Gen-01/12', '03', NULL, '2019-04-16', '20.00', '1106360.00', '14\" Inch', 'Black', '1 Year', 'Dell Latitude 3490\r\n1 TB hard Disk \r\n4GB RAM\r\ni5, 8 GEN,1.60 -1.80 GHz\r\nWindows 10 Pro', 'InStore', NULL, 0, NULL, NULL, 0, NULL, '0', NULL, 0, NULL, 6, NULL, '2019-09-16 00:55:01', '2019-09-21 00:00:10'),
(15, 1, '9GHZWS2', 'Dell', 'Dell Latitude 3490', '2019', 'EDCIL House, 18A,Sector 16A, Noada (U.P.)', 'T&P', 'Laptop', 'NHSRCL/MA CEO3/TI-3/Gen-01/12', '03', NULL, '2019-04-16', '20.00', '1106360.00', '14\" Inch', 'Black', '1 Year', 'Dell Latitude 3490\r\n1 TB hard Disk \r\n4GB RAM\r\ni5, 8 GEN,1.60 -1.80 GHz\r\nWindows 10 Pro', 'InStore', NULL, 0, NULL, NULL, 0, NULL, '0', NULL, 0, NULL, 6, NULL, '2019-09-16 00:55:01', '2019-09-21 00:00:10'),
(16, 1, '8V9ZWS2', 'Dell', 'Dell Latitude 3490', '2019', 'EDCIL House, 18A,Sector 16A, Noada (U.P.)', 'T&P', 'Laptop', 'NHSRCL/MA CEO3/TI-3/Gen-01/12', '03', NULL, '2019-04-16', '20.00', '1106360.00', '14\" Inch', 'Black', '1 Year', 'Dell Latitude 3490\r\n1 TB hard Disk \r\n4GB RAM\r\ni5, 8 GEN,1.60 -1.80 GHz\r\nWindows 10 Pro', 'InStore', NULL, 0, NULL, NULL, 0, NULL, '0', NULL, 0, NULL, 6, NULL, '2019-09-16 00:55:01', '2019-09-21 00:00:10'),
(17, 1, '5XVZWS2', 'Dell', 'Dell Latitude 3490', '2019', 'EDCIL House, 18A,Sector 16A, Noada (U.P.)', 'T&P', 'Laptop', 'NHSRCL/MA CEO3/TI-3/Gen-01/12', '03', NULL, '2019-04-16', '20.00', '1106360.00', '14\" Inch', 'Black', '1 Year', 'Dell Latitude 3490\r\n1 TB hard Disk \r\n4GB RAM\r\ni5, 8 GEN,1.60 -1.80 GHz\r\nWindows 10 Pro', 'InStore', NULL, 0, NULL, NULL, 0, NULL, '0', NULL, 0, NULL, 6, NULL, '2019-09-16 00:55:01', '2019-09-21 00:00:10'),
(18, 1, '9P9SWS2', 'Dell', 'Dell Latitude 3490', '2019', 'EDCIL House, 18A,Sector 16A, Noada (U.P.)', 'T&P', 'Laptop', 'NHSRCL/MA CEO3/TI-3/Gen-01/12', '03', NULL, '2019-04-16', '20.00', '1106360.00', '14\" Inch', 'Black', '1 Year', 'Dell Latitude 3490\r\n1 TB hard Disk \r\n4GB RAM\r\ni5, 8 GEN,1.60 -1.80 GHz\r\nWindows 10 Pro', 'InStore', NULL, 0, NULL, NULL, 0, NULL, '0', NULL, 0, NULL, 6, NULL, '2019-09-16 00:55:01', '2019-09-21 00:00:10'),
(19, 1, '2T9ZWS2', 'Dell', 'Dell Latitude 3490', '2019', 'EDCIL House, 18A,Sector 16A, Noada (U.P.)', 'T&P', 'Laptop', 'NHSRCL/MA CEO3/TI-3/Gen-01/12', '03', NULL, '2019-04-16', '20.00', '1106360.00', '14\" Inch', 'Black', '1 Year', 'Dell Latitude 3490\r\n1 TB hard Disk \r\n4GB RAM\r\ni5, 8 GEN,1.60 -1.80 GHz\r\nWindows 10 Pro', 'InStore', NULL, 0, NULL, NULL, 0, NULL, '0', NULL, 0, NULL, 6, NULL, '2019-09-16 00:55:01', '2019-09-21 00:00:10'),
(20, 1, '4P7OXS2', 'Dell', 'Dell Latitude 3490', '2019', 'EDCIL House, 18A,Sector 16A, Noada (U.P.)', 'T&P', 'Laptop', 'NHSRCL/MA CEO3/TI-3/Gen-01/12', '03', NULL, '2019-04-16', '20.00', '1106360.00', '14\" Inch', 'Black', '1 Year', 'Dell Latitude 3490\r\n1 TB hard Disk \r\n4GB RAM\r\ni5, 8 GEN,1.60 -1.80 GHz\r\nWindows 10 Pro', 'InStore', NULL, 0, NULL, NULL, 0, NULL, '0', NULL, 0, NULL, 6, NULL, '2019-09-16 00:55:01', '2019-09-21 00:00:10'),
(21, 2, '1568722141_1', 'EMERSON', 'Liebert ITON CX 1500 VA', '2019', 'EDCIL House, 18A,Sector 16A, Noada (U.P.)', 'T&P', 'UPS', 'NHSRCL/MA CE03/TI-3/Gen-01/12', '03', NULL, '2019-04-16', '4.00', '46824.00', 'Small', 'Black', '1 year', '3 UPS are installed in 3 corresponding training rooms.\r\n1st floor = 2 UPS\r\nGround floor = 1 UPS', 'InStore', NULL, 0, NULL, NULL, 0, NULL, '0', NULL, 0, NULL, 1, NULL, '2019-09-17 06:39:01', '2019-11-11 04:16:14'),
(22, 2, '1568722141_2', 'EMERSON', 'Liebert ITON CX 1500 VA', '2019', 'EDCIL House, 18A,Sector 16A, Noada (U.P.)', 'T&P', 'UPS', 'NHSRCL/MA CE03/TI-3/Gen-01/12', '03', NULL, '2019-04-16', '4.00', '46824.00', 'Small', 'Black', '1 year', '3 UPS are installed in 3 corresponding training rooms.\r\n1st floor = 2 UPS\r\nGround floor = 1 UPS', 'InStore', NULL, 0, NULL, NULL, 0, NULL, '0', NULL, 0, NULL, 1, NULL, '2019-09-17 06:39:01', '2019-11-11 04:16:14'),
(23, 2, '1568722141_3', 'EMERSON', 'Liebert ITON CX 1500 VA', '2019', 'EDCIL House, 18A,Sector 16A, Noada (U.P.)', 'T&P', 'UPS', 'NHSRCL/MA CE03/TI-3/Gen-01/12', '03', NULL, '2019-04-16', '4.00', '46824.00', 'Small', 'Black', '1 year', '3 UPS are installed in 3 corresponding training rooms.\r\n1st floor = 2 UPS\r\nGround floor = 1 UPS', 'InStore', NULL, 0, NULL, NULL, 0, NULL, '0', NULL, 0, NULL, 1, NULL, '2019-09-17 06:39:01', '2019-11-11 04:16:14'),
(24, 3, '1568722295_1', 'D-Link', 'DIR-825', '2019', 'EDCIL House, 18A,Sector 16A, Noada (U.P.)', 'T&P', 'Wi-Fi Router', 'NHSRCL/MA CE03/TI-3/Gen-01/12', '03', NULL, '2019-04-16', '3.00', '10302.00', 'Small', 'Black', '1 year', '3 Router are purchased for 3 class rooms.', 'InStore', NULL, 0, NULL, NULL, 0, NULL, '0', NULL, 0, NULL, 6, NULL, '2019-09-17 06:41:35', '2019-09-17 06:41:35'),
(25, 3, '1568722295_2', 'D-Link', 'DIR-825', '2019', 'EDCIL House, 18A,Sector 16A, Noada (U.P.)', 'T&P', 'Wi-Fi Router', 'NHSRCL/MA CE03/TI-3/Gen-01/12', '03', NULL, '2019-04-16', '3.00', '10302.00', 'Small', 'Black', '1 year', '3 Router are purchased for 3 class rooms.', 'InStore', NULL, 0, NULL, NULL, 0, NULL, '0', NULL, 0, NULL, 6, NULL, '2019-09-17 06:41:35', '2019-09-17 06:41:35'),
(26, 3, '1568722295_3', 'D-Link', 'DIR-825', '2019', 'EDCIL House, 18A,Sector 16A, Noada (U.P.)', 'T&P', 'Wi-Fi Router', 'NHSRCL/MA CE03/TI-3/Gen-01/12', '03', NULL, '2019-04-16', '3.00', '10302.00', 'Small', 'Black', '1 year', '3 Router are purchased for 3 class rooms.', 'InStore', NULL, 0, NULL, NULL, 0, NULL, '0', NULL, 0, NULL, 6, NULL, '2019-09-17 06:41:35', '2019-09-17 06:41:35'),
(27, 4, '1568722442_1', 'Godrej', 'Godrej Interio', '2019', 'EDCIL House, 18A,Sector 16A, Noada (U.P.)', 'T&P', 'Table', 'NHSRCL/MA CE03/TI-3/Gen-01/12', '03', NULL, '2019-04-16', '30.00', '437310.00', 'standard', 'white', '1 year', '30 Tables for Training purpose.', 'InStore', NULL, 0, NULL, NULL, 0, NULL, '0', NULL, 0, NULL, 6, NULL, '2019-09-17 06:44:02', '2019-09-20 23:53:05'),
(28, 4, '1568722442_2', 'Godrej', 'Godrej Interio', '2019', 'EDCIL House, 18A,Sector 16A, Noada (U.P.)', 'T&P', 'Table', 'NHSRCL/MA CE03/TI-3/Gen-01/12', '03', NULL, '2019-04-16', '30.00', '437310.00', 'standard', 'white', '1 year', '30 Tables for Training purpose.', 'InStore', NULL, 0, NULL, NULL, 0, NULL, '0', NULL, 0, NULL, 6, NULL, '2019-09-17 06:44:02', '2019-09-20 23:53:05'),
(29, 4, '1568722442_3', 'Godrej', 'Godrej Interio', '2019', 'EDCIL House, 18A,Sector 16A, Noada (U.P.)', 'T&P', 'Table', 'NHSRCL/MA CE03/TI-3/Gen-01/12', '03', NULL, '2019-04-16', '30.00', '437310.00', 'standard', 'white', '1 year', '30 Tables for Training purpose.', 'InStore', NULL, 0, NULL, NULL, 0, NULL, '0', NULL, 0, NULL, 6, NULL, '2019-09-17 06:44:02', '2019-09-20 23:53:05'),
(30, 4, '1568722442_4', 'Godrej', 'Godrej Interio', '2019', 'EDCIL House, 18A,Sector 16A, Noada (U.P.)', 'T&P', 'Table', 'NHSRCL/MA CE03/TI-3/Gen-01/12', '03', NULL, '2019-04-16', '30.00', '437310.00', 'standard', 'white', '1 year', '30 Tables for Training purpose.', 'InStore', NULL, 0, NULL, NULL, 0, NULL, '0', NULL, 0, NULL, 6, NULL, '2019-09-17 06:44:02', '2019-09-20 23:53:05'),
(31, 4, '1568722442_5', 'Godrej', 'Godrej Interio', '2019', 'EDCIL House, 18A,Sector 16A, Noada (U.P.)', 'T&P', 'Table', 'NHSRCL/MA CE03/TI-3/Gen-01/12', '03', NULL, '2019-04-16', '30.00', '437310.00', 'standard', 'white', '1 year', '30 Tables for Training purpose.', 'InStore', NULL, 0, NULL, NULL, 0, NULL, '0', NULL, 0, NULL, 6, NULL, '2019-09-17 06:44:02', '2019-09-20 23:53:05'),
(32, 4, '1568722442_6', 'Godrej', 'Godrej Interio', '2019', 'EDCIL House, 18A,Sector 16A, Noada (U.P.)', 'T&P', 'Table', 'NHSRCL/MA CE03/TI-3/Gen-01/12', '03', NULL, '2019-04-16', '30.00', '437310.00', 'standard', 'white', '1 year', '30 Tables for Training purpose.', 'InStore', NULL, 0, NULL, NULL, 0, NULL, '0', NULL, 0, NULL, 6, NULL, '2019-09-17 06:44:02', '2019-09-20 23:53:05'),
(33, 4, '1568722442_7', 'Godrej', 'Godrej Interio', '2019', 'EDCIL House, 18A,Sector 16A, Noada (U.P.)', 'T&P', 'Table', 'NHSRCL/MA CE03/TI-3/Gen-01/12', '03', NULL, '2019-04-16', '30.00', '437310.00', 'standard', 'white', '1 year', '30 Tables for Training purpose.', 'InStore', NULL, 0, NULL, NULL, 0, NULL, '0', NULL, 0, NULL, 6, NULL, '2019-09-17 06:44:02', '2019-09-20 23:53:05'),
(34, 4, '1568722442_8', 'Godrej', 'Godrej Interio', '2019', 'EDCIL House, 18A,Sector 16A, Noada (U.P.)', 'T&P', 'Table', 'NHSRCL/MA CE03/TI-3/Gen-01/12', '03', NULL, '2019-04-16', '30.00', '437310.00', 'standard', 'white', '1 year', '30 Tables for Training purpose.', 'InStore', NULL, 0, NULL, NULL, 0, NULL, '0', NULL, 0, NULL, 6, NULL, '2019-09-17 06:44:02', '2019-09-20 23:53:05'),
(35, 4, '1568722442_9', 'Godrej', 'Godrej Interio', '2019', 'EDCIL House, 18A,Sector 16A, Noada (U.P.)', 'T&P', 'Table', 'NHSRCL/MA CE03/TI-3/Gen-01/12', '03', NULL, '2019-04-16', '30.00', '437310.00', 'standard', 'white', '1 year', '30 Tables for Training purpose.', 'InStore', NULL, 0, NULL, NULL, 0, NULL, '0', NULL, 0, NULL, 6, NULL, '2019-09-17 06:44:02', '2019-09-20 23:53:05'),
(36, 4, '1568722442_10', 'Godrej', 'Godrej Interio', '2019', 'EDCIL House, 18A,Sector 16A, Noada (U.P.)', 'T&P', 'Table', 'NHSRCL/MA CE03/TI-3/Gen-01/12', '03', NULL, '2019-04-16', '30.00', '437310.00', 'standard', 'white', '1 year', '30 Tables for Training purpose.', 'InStore', NULL, 0, NULL, NULL, 0, NULL, '0', NULL, 0, NULL, 6, NULL, '2019-09-17 06:44:02', '2019-09-20 23:53:05'),
(37, 4, '1568722442_11', 'Godrej', 'Godrej Interio', '2019', 'EDCIL House, 18A,Sector 16A, Noada (U.P.)', 'T&P', 'Table', 'NHSRCL/MA CE03/TI-3/Gen-01/12', '03', NULL, '2019-04-16', '30.00', '437310.00', 'standard', 'white', '1 year', '30 Tables for Training purpose.', 'InStore', NULL, 0, NULL, NULL, 0, NULL, '0', NULL, 0, NULL, 6, NULL, '2019-09-17 06:44:02', '2019-09-20 23:53:05'),
(38, 4, '1568722442_12', 'Godrej', 'Godrej Interio', '2019', 'EDCIL House, 18A,Sector 16A, Noada (U.P.)', 'T&P', 'Table', 'NHSRCL/MA CE03/TI-3/Gen-01/12', '03', NULL, '2019-04-16', '30.00', '437310.00', 'standard', 'white', '1 year', '30 Tables for Training purpose.', 'InStore', NULL, 0, NULL, NULL, 0, NULL, '0', NULL, 0, NULL, 6, NULL, '2019-09-17 06:44:02', '2019-09-20 23:53:05'),
(39, 4, '1568722442_13', 'Godrej', 'Godrej Interio', '2019', 'EDCIL House, 18A,Sector 16A, Noada (U.P.)', 'T&P', 'Table', 'NHSRCL/MA CE03/TI-3/Gen-01/12', '03', NULL, '2019-04-16', '30.00', '437310.00', 'standard', 'white', '1 year', '30 Tables for Training purpose.', 'InStore', NULL, 0, NULL, NULL, 0, NULL, '0', NULL, 0, NULL, 6, NULL, '2019-09-17 06:44:02', '2019-09-20 23:53:05'),
(40, 4, '1568722442_14', 'Godrej', 'Godrej Interio', '2019', 'EDCIL House, 18A,Sector 16A, Noada (U.P.)', 'T&P', 'Table', 'NHSRCL/MA CE03/TI-3/Gen-01/12', '03', NULL, '2019-04-16', '30.00', '437310.00', 'standard', 'white', '1 year', '30 Tables for Training purpose.', 'InStore', NULL, 0, NULL, NULL, 0, NULL, '0', NULL, 0, NULL, 6, NULL, '2019-09-17 06:44:02', '2019-09-20 23:53:05'),
(41, 4, '1568722442_15', 'Godrej', 'Godrej Interio', '2019', 'EDCIL House, 18A,Sector 16A, Noada (U.P.)', 'T&P', 'Table', 'NHSRCL/MA CE03/TI-3/Gen-01/12', '03', NULL, '2019-04-16', '30.00', '437310.00', 'standard', 'white', '1 year', '30 Tables for Training purpose.', 'InStore', NULL, 0, NULL, NULL, 0, NULL, '0', NULL, 0, NULL, 6, NULL, '2019-09-17 06:44:02', '2019-09-20 23:53:05'),
(42, 4, '1568722442_16', 'Godrej', 'Godrej Interio', '2019', 'EDCIL House, 18A,Sector 16A, Noada (U.P.)', 'T&P', 'Table', 'NHSRCL/MA CE03/TI-3/Gen-01/12', '03', NULL, '2019-04-16', '30.00', '437310.00', 'standard', 'white', '1 year', '30 Tables for Training purpose.', 'InStore', NULL, 0, NULL, NULL, 0, NULL, '0', NULL, 0, NULL, 6, NULL, '2019-09-17 06:44:02', '2019-09-20 23:53:05'),
(43, 4, '1568722442_17', 'Godrej', 'Godrej Interio', '2019', 'EDCIL House, 18A,Sector 16A, Noada (U.P.)', 'T&P', 'Table', 'NHSRCL/MA CE03/TI-3/Gen-01/12', '03', NULL, '2019-04-16', '30.00', '437310.00', 'standard', 'white', '1 year', '30 Tables for Training purpose.', 'InStore', NULL, 0, NULL, NULL, 0, NULL, '0', NULL, 0, NULL, 6, NULL, '2019-09-17 06:44:02', '2019-09-20 23:53:05'),
(44, 4, '1568722442_18', 'Godrej', 'Godrej Interio', '2019', 'EDCIL House, 18A,Sector 16A, Noada (U.P.)', 'T&P', 'Table', 'NHSRCL/MA CE03/TI-3/Gen-01/12', '03', NULL, '2019-04-16', '30.00', '437310.00', 'standard', 'white', '1 year', '30 Tables for Training purpose.', 'InStore', NULL, 0, NULL, NULL, 0, NULL, '0', NULL, 0, NULL, 6, NULL, '2019-09-17 06:44:02', '2019-09-20 23:53:05'),
(45, 4, '1568722442_19', 'Godrej', 'Godrej Interio', '2019', 'EDCIL House, 18A,Sector 16A, Noada (U.P.)', 'T&P', 'Table', 'NHSRCL/MA CE03/TI-3/Gen-01/12', '03', NULL, '2019-04-16', '30.00', '437310.00', 'standard', 'white', '1 year', '30 Tables for Training purpose.', 'InStore', NULL, 0, NULL, NULL, 0, NULL, '0', NULL, 0, NULL, 6, NULL, '2019-09-17 06:44:02', '2019-09-20 23:53:05'),
(46, 4, '1568722442_20', 'Godrej', 'Godrej Interio', '2019', 'EDCIL House, 18A,Sector 16A, Noada (U.P.)', 'T&P', 'Table', 'NHSRCL/MA CE03/TI-3/Gen-01/12', '03', NULL, '2019-04-16', '30.00', '437310.00', 'standard', 'white', '1 year', '30 Tables for Training purpose.', 'InStore', NULL, 0, NULL, NULL, 0, NULL, '0', NULL, 0, NULL, 6, NULL, '2019-09-17 06:44:02', '2019-09-20 23:53:05'),
(47, 4, '1568722442_21', 'Godrej', 'Godrej Interio', '2019', 'EDCIL House, 18A,Sector 16A, Noada (U.P.)', 'T&P', 'Table', 'NHSRCL/MA CE03/TI-3/Gen-01/12', '03', NULL, '2019-04-16', '30.00', '437310.00', 'standard', 'white', '1 year', '30 Tables for Training purpose.', 'InStore', NULL, 0, NULL, NULL, 0, NULL, '0', NULL, 0, NULL, 6, NULL, '2019-09-17 06:44:02', '2019-09-20 23:53:05'),
(48, 4, '1568722442_22', 'Godrej', 'Godrej Interio', '2019', 'EDCIL House, 18A,Sector 16A, Noada (U.P.)', 'T&P', 'Table', 'NHSRCL/MA CE03/TI-3/Gen-01/12', '03', NULL, '2019-04-16', '30.00', '437310.00', 'standard', 'white', '1 year', '30 Tables for Training purpose.', 'InStore', NULL, 0, NULL, NULL, 0, NULL, '0', NULL, 0, NULL, 6, NULL, '2019-09-17 06:44:02', '2019-09-20 23:53:05'),
(49, 4, '1568722442_23', 'Godrej', 'Godrej Interio', '2019', 'EDCIL House, 18A,Sector 16A, Noada (U.P.)', 'T&P', 'Table', 'NHSRCL/MA CE03/TI-3/Gen-01/12', '03', NULL, '2019-04-16', '30.00', '437310.00', 'standard', 'white', '1 year', '30 Tables for Training purpose.', 'InStore', NULL, 0, NULL, NULL, 0, NULL, '0', NULL, 0, NULL, 6, NULL, '2019-09-17 06:44:02', '2019-09-20 23:53:05'),
(50, 4, '1568722442_24', 'Godrej', 'Godrej Interio', '2019', 'EDCIL House, 18A,Sector 16A, Noada (U.P.)', 'T&P', 'Table', 'NHSRCL/MA CE03/TI-3/Gen-01/12', '03', NULL, '2019-04-16', '30.00', '437310.00', 'standard', 'white', '1 year', '30 Tables for Training purpose.', 'InStore', NULL, 0, NULL, NULL, 0, NULL, '0', NULL, 0, NULL, 6, NULL, '2019-09-17 06:44:02', '2019-09-20 23:53:05'),
(51, 4, '1568722442_25', 'Godrej', 'Godrej Interio', '2019', 'EDCIL House, 18A,Sector 16A, Noada (U.P.)', 'T&P', 'Table', 'NHSRCL/MA CE03/TI-3/Gen-01/12', '03', NULL, '2019-04-16', '30.00', '437310.00', 'standard', 'white', '1 year', '30 Tables for Training purpose.', 'InStore', NULL, 0, NULL, NULL, 0, NULL, '0', NULL, 0, NULL, 6, NULL, '2019-09-17 06:44:02', '2019-09-20 23:53:05'),
(52, 4, '1568722442_26', 'Godrej', 'Godrej Interio', '2019', 'EDCIL House, 18A,Sector 16A, Noada (U.P.)', 'T&P', 'Table', 'NHSRCL/MA CE03/TI-3/Gen-01/12', '03', NULL, '2019-04-16', '30.00', '437310.00', 'standard', 'white', '1 year', '30 Tables for Training purpose.', 'InStore', NULL, 0, NULL, NULL, 0, NULL, '0', NULL, 0, NULL, 6, NULL, '2019-09-17 06:44:02', '2019-09-20 23:53:05'),
(53, 4, '1568722442_27', 'Godrej', 'Godrej Interio', '2019', 'EDCIL House, 18A,Sector 16A, Noada (U.P.)', 'T&P', 'Table', 'NHSRCL/MA CE03/TI-3/Gen-01/12', '03', NULL, '2019-04-16', '30.00', '437310.00', 'standard', 'white', '1 year', '30 Tables for Training purpose.', 'InStore', NULL, 0, NULL, NULL, 0, NULL, '0', NULL, 0, NULL, 6, NULL, '2019-09-17 06:44:02', '2019-09-20 23:53:05'),
(54, 4, '1568722442_28', 'Godrej', 'Godrej Interio', '2019', 'EDCIL House, 18A,Sector 16A, Noada (U.P.)', 'T&P', 'Table', 'NHSRCL/MA CE03/TI-3/Gen-01/12', '03', NULL, '2019-04-16', '30.00', '437310.00', 'standard', 'white', '1 year', '30 Tables for Training purpose.', 'InStore', NULL, 0, NULL, NULL, 0, NULL, '0', NULL, 0, NULL, 6, NULL, '2019-09-17 06:44:02', '2019-09-20 23:53:05'),
(55, 4, '1568722442_29', 'Godrej', 'Godrej Interio', '2019', 'EDCIL House, 18A,Sector 16A, Noada (U.P.)', 'T&P', 'Table', 'NHSRCL/MA CE03/TI-3/Gen-01/12', '03', NULL, '2019-04-16', '30.00', '437310.00', 'standard', 'white', '1 year', '30 Tables for Training purpose.', 'InStore', NULL, 0, NULL, NULL, 0, NULL, '0', NULL, 0, NULL, 6, NULL, '2019-09-17 06:44:02', '2019-09-20 23:53:05'),
(56, 4, '1568722442_30', 'Godrej', 'Godrej Interio', '2019', 'EDCIL House, 18A,Sector 16A, Noada (U.P.)', 'T&P', 'Table', 'NHSRCL/MA CE03/TI-3/Gen-01/12', '03', NULL, '2019-04-16', '30.00', '437310.00', 'standard', 'white', '1 year', '30 Tables for Training purpose.', 'InStore', NULL, 0, NULL, NULL, 0, NULL, '0', NULL, 0, NULL, 6, NULL, '2019-09-17 06:44:02', '2019-09-20 23:53:05'),
(57, 5, '1568722642_1', 'Godrej', 'Godrej Interio', '2019', 'EDCIL House, 18A,Sector 16A, Noada (U.P.)', 'T&P', 'Chair', 'NHSRCL/MA CE03/TI-3/Gen-01/12', '03', NULL, '2019-04-16', '60.00', '576300.00', 'small', 'blue', '1 Year', '2 Different colors of chairs are here for training rooms.\r\nBlue & Green', 'InStore', NULL, 0, NULL, NULL, 0, NULL, '0', NULL, 0, NULL, 6, NULL, '2019-09-17 06:47:22', '2019-09-21 00:01:46'),
(58, 5, '1568722642_2', 'Godrej', 'Godrej Interio', '2019', 'EDCIL House, 18A,Sector 16A, Noada (U.P.)', 'T&P', 'Chair', 'NHSRCL/MA CE03/TI-3/Gen-01/12', '03', NULL, '2019-04-16', '60.00', '576300.00', 'small', 'blue', '1 Year', '2 Different colors of chairs are here for training rooms.\r\nBlue & Green', 'InStore', NULL, 0, NULL, NULL, 0, NULL, '0', NULL, 0, NULL, 6, NULL, '2019-09-17 06:47:22', '2019-09-21 00:01:46'),
(59, 5, '1568722642_3', 'Godrej', 'Godrej Interio', '2019', 'EDCIL House, 18A,Sector 16A, Noada (U.P.)', 'T&P', 'Chair', 'NHSRCL/MA CE03/TI-3/Gen-01/12', '03', NULL, '2019-04-16', '60.00', '576300.00', 'small', 'blue', '1 Year', '2 Different colors of chairs are here for training rooms.\r\nBlue & Green', 'InStore', NULL, 0, NULL, NULL, 0, NULL, '0', NULL, 0, NULL, 6, NULL, '2019-09-17 06:47:22', '2019-09-21 00:01:46'),
(60, 5, '1568722642_4', 'Godrej', 'Godrej Interio', '2019', 'EDCIL House, 18A,Sector 16A, Noada (U.P.)', 'T&P', 'Chair', 'NHSRCL/MA CE03/TI-3/Gen-01/12', '03', NULL, '2019-04-16', '60.00', '576300.00', 'small', 'blue', '1 Year', '2 Different colors of chairs are here for training rooms.\r\nBlue & Green', 'InStore', NULL, 0, NULL, NULL, 0, NULL, '0', NULL, 0, NULL, 6, NULL, '2019-09-17 06:47:22', '2019-09-21 00:01:46'),
(61, 5, '1568722642_5', 'Godrej', 'Godrej Interio', '2019', 'EDCIL House, 18A,Sector 16A, Noada (U.P.)', 'T&P', 'Chair', 'NHSRCL/MA CE03/TI-3/Gen-01/12', '03', NULL, '2019-04-16', '60.00', '576300.00', 'small', 'blue', '1 Year', '2 Different colors of chairs are here for training rooms.\r\nBlue & Green', 'InStore', NULL, 0, NULL, NULL, 0, NULL, '0', NULL, 0, NULL, 6, NULL, '2019-09-17 06:47:22', '2019-09-21 00:01:46'),
(62, 5, '1568722642_6', 'Godrej', 'Godrej Interio', '2019', 'EDCIL House, 18A,Sector 16A, Noada (U.P.)', 'T&P', 'Chair', 'NHSRCL/MA CE03/TI-3/Gen-01/12', '03', NULL, '2019-04-16', '60.00', '576300.00', 'small', 'blue', '1 Year', '2 Different colors of chairs are here for training rooms.\r\nBlue & Green', 'InStore', NULL, 0, NULL, NULL, 0, NULL, '0', NULL, 0, NULL, 6, NULL, '2019-09-17 06:47:22', '2019-09-21 00:01:46'),
(63, 5, '1568722642_7', 'Godrej', 'Godrej Interio', '2019', 'EDCIL House, 18A,Sector 16A, Noada (U.P.)', 'T&P', 'Chair', 'NHSRCL/MA CE03/TI-3/Gen-01/12', '03', NULL, '2019-04-16', '60.00', '576300.00', 'small', 'blue', '1 Year', '2 Different colors of chairs are here for training rooms.\r\nBlue & Green', 'InStore', NULL, 0, NULL, NULL, 0, NULL, '0', NULL, 0, NULL, 6, NULL, '2019-09-17 06:47:22', '2019-09-21 00:01:46'),
(64, 5, '1568722642_8', 'Godrej', 'Godrej Interio', '2019', 'EDCIL House, 18A,Sector 16A, Noada (U.P.)', 'T&P', 'Chair', 'NHSRCL/MA CE03/TI-3/Gen-01/12', '03', NULL, '2019-04-16', '60.00', '576300.00', 'small', 'blue', '1 Year', '2 Different colors of chairs are here for training rooms.\r\nBlue & Green', 'InStore', NULL, 0, NULL, NULL, 0, NULL, '0', NULL, 0, NULL, 6, NULL, '2019-09-17 06:47:22', '2019-09-21 00:01:46'),
(65, 5, '1568722642_9', 'Godrej', 'Godrej Interio', '2019', 'EDCIL House, 18A,Sector 16A, Noada (U.P.)', 'T&P', 'Chair', 'NHSRCL/MA CE03/TI-3/Gen-01/12', '03', NULL, '2019-04-16', '60.00', '576300.00', 'small', 'blue', '1 Year', '2 Different colors of chairs are here for training rooms.\r\nBlue & Green', 'InStore', NULL, 0, NULL, NULL, 0, NULL, '0', NULL, 0, NULL, 6, NULL, '2019-09-17 06:47:22', '2019-09-21 00:01:46'),
(66, 5, '1568722642_10', 'Godrej', 'Godrej Interio', '2019', 'EDCIL House, 18A,Sector 16A, Noada (U.P.)', 'T&P', 'Chair', 'NHSRCL/MA CE03/TI-3/Gen-01/12', '03', NULL, '2019-04-16', '60.00', '576300.00', 'small', 'blue', '1 Year', '2 Different colors of chairs are here for training rooms.\r\nBlue & Green', 'InStore', NULL, 0, NULL, NULL, 0, NULL, '0', NULL, 0, NULL, 6, NULL, '2019-09-17 06:47:22', '2019-09-21 00:01:46'),
(67, 5, '1568722642_11', 'Godrej', 'Godrej Interio', '2019', 'EDCIL House, 18A,Sector 16A, Noada (U.P.)', 'T&P', 'Chair', 'NHSRCL/MA CE03/TI-3/Gen-01/12', '03', NULL, '2019-04-16', '60.00', '576300.00', 'small', 'blue', '1 Year', '2 Different colors of chairs are here for training rooms.\r\nBlue & Green', 'InStore', NULL, 0, NULL, NULL, 0, NULL, '0', NULL, 0, NULL, 6, NULL, '2019-09-17 06:47:22', '2019-09-21 00:01:46'),
(68, 5, '1568722642_12', 'Godrej', 'Godrej Interio', '2019', 'EDCIL House, 18A,Sector 16A, Noada (U.P.)', 'T&P', 'Chair', 'NHSRCL/MA CE03/TI-3/Gen-01/12', '03', NULL, '2019-04-16', '60.00', '576300.00', 'small', 'blue', '1 Year', '2 Different colors of chairs are here for training rooms.\r\nBlue & Green', 'InStore', NULL, 0, NULL, NULL, 0, NULL, '0', NULL, 0, NULL, 6, NULL, '2019-09-17 06:47:22', '2019-09-21 00:01:46'),
(69, 5, '1568722642_13', 'Godrej', 'Godrej Interio', '2019', 'EDCIL House, 18A,Sector 16A, Noada (U.P.)', 'T&P', 'Chair', 'NHSRCL/MA CE03/TI-3/Gen-01/12', '03', NULL, '2019-04-16', '60.00', '576300.00', 'small', 'blue', '1 Year', '2 Different colors of chairs are here for training rooms.\r\nBlue & Green', 'InStore', NULL, 0, NULL, NULL, 0, NULL, '0', NULL, 0, NULL, 6, NULL, '2019-09-17 06:47:22', '2019-09-21 00:01:46'),
(70, 5, '1568722642_14', 'Godrej', 'Godrej Interio', '2019', 'EDCIL House, 18A,Sector 16A, Noada (U.P.)', 'T&P', 'Chair', 'NHSRCL/MA CE03/TI-3/Gen-01/12', '03', NULL, '2019-04-16', '60.00', '576300.00', 'small', 'blue', '1 Year', '2 Different colors of chairs are here for training rooms.\r\nBlue & Green', 'InStore', NULL, 0, NULL, NULL, 0, NULL, '0', NULL, 0, NULL, 6, NULL, '2019-09-17 06:47:22', '2019-09-21 00:01:46'),
(71, 5, '1568722642_15', 'Godrej', 'Godrej Interio', '2019', 'EDCIL House, 18A,Sector 16A, Noada (U.P.)', 'T&P', 'Chair', 'NHSRCL/MA CE03/TI-3/Gen-01/12', '03', NULL, '2019-04-16', '60.00', '576300.00', 'small', 'blue', '1 Year', '2 Different colors of chairs are here for training rooms.\r\nBlue & Green', 'InStore', NULL, 0, NULL, NULL, 0, NULL, '0', NULL, 0, NULL, 6, NULL, '2019-09-17 06:47:22', '2019-09-21 00:01:46'),
(72, 5, '1568722642_16', 'Godrej', 'Godrej Interio', '2019', 'EDCIL House, 18A,Sector 16A, Noada (U.P.)', 'T&P', 'Chair', 'NHSRCL/MA CE03/TI-3/Gen-01/12', '03', NULL, '2019-04-16', '60.00', '576300.00', 'small', 'blue', '1 Year', '2 Different colors of chairs are here for training rooms.\r\nBlue & Green', 'InStore', NULL, 0, NULL, NULL, 0, NULL, '0', NULL, 0, NULL, 6, NULL, '2019-09-17 06:47:22', '2019-09-21 00:01:46'),
(73, 5, '1568722642_17', 'Godrej', 'Godrej Interio', '2019', 'EDCIL House, 18A,Sector 16A, Noada (U.P.)', 'T&P', 'Chair', 'NHSRCL/MA CE03/TI-3/Gen-01/12', '03', NULL, '2019-04-16', '60.00', '576300.00', 'small', 'blue', '1 Year', '2 Different colors of chairs are here for training rooms.\r\nBlue & Green', 'InStore', NULL, 0, NULL, NULL, 0, NULL, '0', NULL, 0, NULL, 6, NULL, '2019-09-17 06:47:22', '2019-09-21 00:01:46'),
(74, 5, '1568722642_18', 'Godrej', 'Godrej Interio', '2019', 'EDCIL House, 18A,Sector 16A, Noada (U.P.)', 'T&P', 'Chair', 'NHSRCL/MA CE03/TI-3/Gen-01/12', '03', NULL, '2019-04-16', '60.00', '576300.00', 'small', 'blue', '1 Year', '2 Different colors of chairs are here for training rooms.\r\nBlue & Green', 'InStore', NULL, 0, NULL, NULL, 0, NULL, '0', NULL, 0, NULL, 6, NULL, '2019-09-17 06:47:22', '2019-09-21 00:01:46'),
(75, 5, '1568722642_19', 'Godrej', 'Godrej Interio', '2019', 'EDCIL House, 18A,Sector 16A, Noada (U.P.)', 'T&P', 'Chair', 'NHSRCL/MA CE03/TI-3/Gen-01/12', '03', NULL, '2019-04-16', '60.00', '576300.00', 'small', 'blue', '1 Year', '2 Different colors of chairs are here for training rooms.\r\nBlue & Green', 'InStore', NULL, 0, NULL, NULL, 0, NULL, '0', NULL, 0, NULL, 6, NULL, '2019-09-17 06:47:22', '2019-09-21 00:01:46'),
(76, 5, '1568722642_20', 'Godrej', 'Godrej Interio', '2019', 'EDCIL House, 18A,Sector 16A, Noada (U.P.)', 'T&P', 'Chair', 'NHSRCL/MA CE03/TI-3/Gen-01/12', '03', NULL, '2019-04-16', '60.00', '576300.00', 'small', 'blue', '1 Year', '2 Different colors of chairs are here for training rooms.\r\nBlue & Green', 'InStore', NULL, 0, NULL, NULL, 0, NULL, '0', NULL, 0, NULL, 6, NULL, '2019-09-17 06:47:22', '2019-09-21 00:01:46'),
(77, 5, '1568722642_21', 'Godrej', 'Godrej Interio', '2019', 'EDCIL House, 18A,Sector 16A, Noada (U.P.)', 'T&P', 'Chair', 'NHSRCL/MA CE03/TI-3/Gen-01/12', '03', NULL, '2019-04-16', '60.00', '576300.00', 'small', 'blue', '1 Year', '2 Different colors of chairs are here for training rooms.\r\nBlue & Green', 'InStore', NULL, 0, NULL, NULL, 0, NULL, '0', NULL, 0, NULL, 6, NULL, '2019-09-17 06:47:22', '2019-09-21 00:01:46'),
(78, 5, '1568722642_22', 'Godrej', 'Godrej Interio', '2019', 'EDCIL House, 18A,Sector 16A, Noada (U.P.)', 'T&P', 'Chair', 'NHSRCL/MA CE03/TI-3/Gen-01/12', '03', NULL, '2019-04-16', '60.00', '576300.00', 'small', 'blue', '1 Year', '2 Different colors of chairs are here for training rooms.\r\nBlue & Green', 'InStore', NULL, 0, NULL, NULL, 0, NULL, '0', NULL, 0, NULL, 6, NULL, '2019-09-17 06:47:22', '2019-09-21 00:01:46'),
(79, 5, '1568722642_23', 'Godrej', 'Godrej Interio', '2019', 'EDCIL House, 18A,Sector 16A, Noada (U.P.)', 'T&P', 'Chair', 'NHSRCL/MA CE03/TI-3/Gen-01/12', '03', NULL, '2019-04-16', '60.00', '576300.00', 'small', 'blue', '1 Year', '2 Different colors of chairs are here for training rooms.\r\nBlue & Green', 'InStore', NULL, 0, NULL, NULL, 0, NULL, '0', NULL, 0, NULL, 6, NULL, '2019-09-17 06:47:22', '2019-09-21 00:01:46'),
(80, 5, '1568722642_24', 'Godrej', 'Godrej Interio', '2019', 'EDCIL House, 18A,Sector 16A, Noada (U.P.)', 'T&P', 'Chair', 'NHSRCL/MA CE03/TI-3/Gen-01/12', '03', NULL, '2019-04-16', '60.00', '576300.00', 'small', 'blue', '1 Year', '2 Different colors of chairs are here for training rooms.\r\nBlue & Green', 'InStore', NULL, 0, NULL, NULL, 0, NULL, '0', NULL, 0, NULL, 6, NULL, '2019-09-17 06:47:22', '2019-09-21 00:01:46'),
(81, 5, '1568722642_25', 'Godrej', 'Godrej Interio', '2019', 'EDCIL House, 18A,Sector 16A, Noada (U.P.)', 'T&P', 'Chair', 'NHSRCL/MA CE03/TI-3/Gen-01/12', '03', NULL, '2019-04-16', '60.00', '576300.00', 'small', 'blue', '1 Year', '2 Different colors of chairs are here for training rooms.\r\nBlue & Green', 'InStore', NULL, 0, NULL, NULL, 0, NULL, '0', NULL, 0, NULL, 6, NULL, '2019-09-17 06:47:22', '2019-09-21 00:01:46'),
(82, 5, '1568722642_26', 'Godrej', 'Godrej Interio', '2019', 'EDCIL House, 18A,Sector 16A, Noada (U.P.)', 'T&P', 'Chair', 'NHSRCL/MA CE03/TI-3/Gen-01/12', '03', NULL, '2019-04-16', '60.00', '576300.00', 'small', 'blue', '1 Year', '2 Different colors of chairs are here for training rooms.\r\nBlue & Green', 'InStore', NULL, 0, NULL, NULL, 0, NULL, '0', NULL, 0, NULL, 6, NULL, '2019-09-17 06:47:22', '2019-09-21 00:01:46'),
(83, 5, '1568722642_27', 'Godrej', 'Godrej Interio', '2019', 'EDCIL House, 18A,Sector 16A, Noada (U.P.)', 'T&P', 'Chair', 'NHSRCL/MA CE03/TI-3/Gen-01/12', '03', NULL, '2019-04-16', '60.00', '576300.00', 'small', 'blue', '1 Year', '2 Different colors of chairs are here for training rooms.\r\nBlue & Green', 'InStore', NULL, 0, NULL, NULL, 0, NULL, '0', NULL, 0, NULL, 6, NULL, '2019-09-17 06:47:22', '2019-09-21 00:01:46'),
(84, 5, '1568722642_28', 'Godrej', 'Godrej Interio', '2019', 'EDCIL House, 18A,Sector 16A, Noada (U.P.)', 'T&P', 'Chair', 'NHSRCL/MA CE03/TI-3/Gen-01/12', '03', NULL, '2019-04-16', '60.00', '576300.00', 'small', 'blue', '1 Year', '2 Different colors of chairs are here for training rooms.\r\nBlue & Green', 'InStore', NULL, 0, NULL, NULL, 0, NULL, '0', NULL, 0, NULL, 6, NULL, '2019-09-17 06:47:22', '2019-09-21 00:01:46'),
(85, 5, '1568722642_29', 'Godrej', 'Godrej Interio', '2019', 'EDCIL House, 18A,Sector 16A, Noada (U.P.)', 'T&P', 'Chair', 'NHSRCL/MA CE03/TI-3/Gen-01/12', '03', NULL, '2019-04-16', '60.00', '576300.00', 'small', 'blue', '1 Year', '2 Different colors of chairs are here for training rooms.\r\nBlue & Green', 'InStore', NULL, 0, NULL, NULL, 0, NULL, '0', NULL, 0, NULL, 6, NULL, '2019-09-17 06:47:22', '2019-09-21 00:01:46'),
(86, 5, '1568722642_30', 'Godrej', 'Godrej Interio', '2019', 'EDCIL House, 18A,Sector 16A, Noada (U.P.)', 'T&P', 'Chair', 'NHSRCL/MA CE03/TI-3/Gen-01/12', '03', NULL, '2019-04-16', '60.00', '576300.00', 'small', 'blue', '1 Year', '2 Different colors of chairs are here for training rooms.\r\nBlue & Green', 'InStore', NULL, 0, NULL, NULL, 0, NULL, '0', NULL, 0, NULL, 6, NULL, '2019-09-17 06:47:22', '2019-09-21 00:01:46'),
(87, 5, '1568722642_31', 'Godrej', 'Godrej Interio', '2019', 'EDCIL House, 18A,Sector 16A, Noada (U.P.)', 'T&P', 'Chair', 'NHSRCL/MA CE03/TI-3/Gen-01/12', '03', NULL, '2019-04-16', '60.00', '576300.00', 'small', 'blue', '1 Year', '2 Different colors of chairs are here for training rooms.\r\nBlue & Green', 'InStore', NULL, 0, NULL, NULL, 0, NULL, '0', NULL, 0, NULL, 6, NULL, '2019-09-17 06:47:22', '2019-09-21 00:01:46'),
(88, 5, '1568722642_32', 'Godrej', 'Godrej Interio', '2019', 'EDCIL House, 18A,Sector 16A, Noada (U.P.)', 'T&P', 'Chair', 'NHSRCL/MA CE03/TI-3/Gen-01/12', '03', NULL, '2019-04-16', '60.00', '576300.00', 'small', 'blue', '1 Year', '2 Different colors of chairs are here for training rooms.\r\nBlue & Green', 'InStore', NULL, 0, NULL, NULL, 0, NULL, '0', NULL, 0, NULL, 6, NULL, '2019-09-17 06:47:22', '2019-09-21 00:01:46'),
(89, 5, '1568722642_33', 'Godrej', 'Godrej Interio', '2019', 'EDCIL House, 18A,Sector 16A, Noada (U.P.)', 'T&P', 'Chair', 'NHSRCL/MA CE03/TI-3/Gen-01/12', '03', NULL, '2019-04-16', '60.00', '576300.00', 'small', 'blue', '1 Year', '2 Different colors of chairs are here for training rooms.\r\nBlue & Green', 'InStore', NULL, 0, NULL, NULL, 0, NULL, '0', NULL, 0, NULL, 6, NULL, '2019-09-17 06:47:22', '2019-09-21 00:01:46'),
(90, 5, '1568722642_34', 'Godrej', 'Godrej Interio', '2019', 'EDCIL House, 18A,Sector 16A, Noada (U.P.)', 'T&P', 'Chair', 'NHSRCL/MA CE03/TI-3/Gen-01/12', '03', NULL, '2019-04-16', '60.00', '576300.00', 'small', 'blue', '1 Year', '2 Different colors of chairs are here for training rooms.\r\nBlue & Green', 'InStore', NULL, 0, NULL, NULL, 0, NULL, '0', NULL, 0, NULL, 6, NULL, '2019-09-17 06:47:22', '2019-09-21 00:01:46'),
(91, 5, '1568722642_35', 'Godrej', 'Godrej Interio', '2019', 'EDCIL House, 18A,Sector 16A, Noada (U.P.)', 'T&P', 'Chair', 'NHSRCL/MA CE03/TI-3/Gen-01/12', '03', NULL, '2019-04-16', '60.00', '576300.00', 'small', 'blue', '1 Year', '2 Different colors of chairs are here for training rooms.\r\nBlue & Green', 'InStore', NULL, 0, NULL, NULL, 0, NULL, '0', NULL, 0, NULL, 6, NULL, '2019-09-17 06:47:22', '2019-09-21 00:01:46'),
(92, 5, '1568722642_36', 'Godrej', 'Godrej Interio', '2019', 'EDCIL House, 18A,Sector 16A, Noada (U.P.)', 'T&P', 'Chair', 'NHSRCL/MA CE03/TI-3/Gen-01/12', '03', NULL, '2019-04-16', '60.00', '576300.00', 'small', 'blue', '1 Year', '2 Different colors of chairs are here for training rooms.\r\nBlue & Green', 'InStore', NULL, 0, NULL, NULL, 0, NULL, '0', NULL, 0, NULL, 6, NULL, '2019-09-17 06:47:22', '2019-09-21 00:01:46'),
(93, 5, '1568722642_37', 'Godrej', 'Godrej Interio', '2019', 'EDCIL House, 18A,Sector 16A, Noada (U.P.)', 'T&P', 'Chair', 'NHSRCL/MA CE03/TI-3/Gen-01/12', '03', NULL, '2019-04-16', '60.00', '576300.00', 'small', 'blue', '1 Year', '2 Different colors of chairs are here for training rooms.\r\nBlue & Green', 'InStore', NULL, 0, NULL, NULL, 0, NULL, '0', NULL, 0, NULL, 6, NULL, '2019-09-17 06:47:22', '2019-09-21 00:01:46'),
(94, 5, '1568722642_38', 'Godrej', 'Godrej Interio', '2019', 'EDCIL House, 18A,Sector 16A, Noada (U.P.)', 'T&P', 'Chair', 'NHSRCL/MA CE03/TI-3/Gen-01/12', '03', NULL, '2019-04-16', '60.00', '576300.00', 'small', 'blue', '1 Year', '2 Different colors of chairs are here for training rooms.\r\nBlue & Green', 'InStore', NULL, 0, NULL, NULL, 0, NULL, '0', NULL, 0, NULL, 6, NULL, '2019-09-17 06:47:22', '2019-09-21 00:01:46'),
(95, 5, '1568722642_39', 'Godrej', 'Godrej Interio', '2019', 'EDCIL House, 18A,Sector 16A, Noada (U.P.)', 'T&P', 'Chair', 'NHSRCL/MA CE03/TI-3/Gen-01/12', '03', NULL, '2019-04-16', '60.00', '576300.00', 'small', 'blue', '1 Year', '2 Different colors of chairs are here for training rooms.\r\nBlue & Green', 'InStore', NULL, 0, NULL, NULL, 0, NULL, '0', NULL, 0, NULL, 6, NULL, '2019-09-17 06:47:22', '2019-09-21 00:01:46'),
(96, 5, '1568722642_40', 'Godrej', 'Godrej Interio', '2019', 'EDCIL House, 18A,Sector 16A, Noada (U.P.)', 'T&P', 'Chair', 'NHSRCL/MA CE03/TI-3/Gen-01/12', '03', NULL, '2019-04-16', '60.00', '576300.00', 'small', 'blue', '1 Year', '2 Different colors of chairs are here for training rooms.\r\nBlue & Green', 'InStore', NULL, 0, NULL, NULL, 0, NULL, '0', NULL, 0, NULL, 6, NULL, '2019-09-17 06:47:22', '2019-09-21 00:01:46'),
(97, 5, '1568722642_41', 'Godrej', 'Godrej Interio', '2019', 'EDCIL House, 18A,Sector 16A, Noada (U.P.)', 'T&P', 'Chair', 'NHSRCL/MA CE03/TI-3/Gen-01/12', '03', NULL, '2019-04-16', '60.00', '576300.00', 'small', 'blue', '1 Year', '2 Different colors of chairs are here for training rooms.\r\nBlue & Green', 'InStore', NULL, 0, NULL, NULL, 0, NULL, '0', NULL, 0, NULL, 6, NULL, '2019-09-17 06:47:22', '2019-09-21 00:01:46'),
(98, 5, '1568722642_42', 'Godrej', 'Godrej Interio', '2019', 'EDCIL House, 18A,Sector 16A, Noada (U.P.)', 'T&P', 'Chair', 'NHSRCL/MA CE03/TI-3/Gen-01/12', '03', NULL, '2019-04-16', '60.00', '576300.00', 'small', 'blue', '1 Year', '2 Different colors of chairs are here for training rooms.\r\nBlue & Green', 'InStore', NULL, 0, NULL, NULL, 0, NULL, '0', NULL, 0, NULL, 6, NULL, '2019-09-17 06:47:22', '2019-09-21 00:01:46'),
(99, 5, '1568722642_43', 'Godrej', 'Godrej Interio', '2019', 'EDCIL House, 18A,Sector 16A, Noada (U.P.)', 'T&P', 'Chair', 'NHSRCL/MA CE03/TI-3/Gen-01/12', '03', NULL, '2019-04-16', '60.00', '576300.00', 'small', 'blue', '1 Year', '2 Different colors of chairs are here for training rooms.\r\nBlue & Green', 'InStore', NULL, 0, NULL, NULL, 0, NULL, '0', NULL, 0, NULL, 6, NULL, '2019-09-17 06:47:22', '2019-09-21 00:01:46'),
(100, 5, '1568722642_44', 'Godrej', 'Godrej Interio', '2019', 'EDCIL House, 18A,Sector 16A, Noada (U.P.)', 'T&P', 'Chair', 'NHSRCL/MA CE03/TI-3/Gen-01/12', '03', NULL, '2019-04-16', '60.00', '576300.00', 'small', 'blue', '1 Year', '2 Different colors of chairs are here for training rooms.\r\nBlue & Green', 'InStore', NULL, 0, NULL, NULL, 0, NULL, '0', NULL, 0, NULL, 6, NULL, '2019-09-17 06:47:22', '2019-09-21 00:01:46'),
(101, 5, '1568722642_45', 'Godrej', 'Godrej Interio', '2019', 'EDCIL House, 18A,Sector 16A, Noada (U.P.)', 'T&P', 'Chair', 'NHSRCL/MA CE03/TI-3/Gen-01/12', '03', NULL, '2019-04-16', '60.00', '576300.00', 'small', 'blue', '1 Year', '2 Different colors of chairs are here for training rooms.\r\nBlue & Green', 'InStore', NULL, 0, NULL, NULL, 0, NULL, '0', NULL, 0, NULL, 6, NULL, '2019-09-17 06:47:22', '2019-09-21 00:01:46'),
(102, 5, '1568722642_46', 'Godrej', 'Godrej Interio', '2019', 'EDCIL House, 18A,Sector 16A, Noada (U.P.)', 'T&P', 'Chair', 'NHSRCL/MA CE03/TI-3/Gen-01/12', '03', NULL, '2019-04-16', '60.00', '576300.00', 'small', 'blue', '1 Year', '2 Different colors of chairs are here for training rooms.\r\nBlue & Green', 'InStore', NULL, 0, NULL, NULL, 0, NULL, '0', NULL, 0, NULL, 6, NULL, '2019-09-17 06:47:22', '2019-09-21 00:01:46'),
(103, 5, '1568722642_47', 'Godrej', 'Godrej Interio', '2019', 'EDCIL House, 18A,Sector 16A, Noada (U.P.)', 'T&P', 'Chair', 'NHSRCL/MA CE03/TI-3/Gen-01/12', '03', NULL, '2019-04-16', '60.00', '576300.00', 'small', 'blue', '1 Year', '2 Different colors of chairs are here for training rooms.\r\nBlue & Green', 'InStore', NULL, 0, NULL, NULL, 0, NULL, '0', NULL, 0, NULL, 6, NULL, '2019-09-17 06:47:22', '2019-09-21 00:01:46'),
(104, 5, '1568722642_48', 'Godrej', 'Godrej Interio', '2019', 'EDCIL House, 18A,Sector 16A, Noada (U.P.)', 'T&P', 'Chair', 'NHSRCL/MA CE03/TI-3/Gen-01/12', '03', NULL, '2019-04-16', '60.00', '576300.00', 'small', 'blue', '1 Year', '2 Different colors of chairs are here for training rooms.\r\nBlue & Green', 'InStore', NULL, 0, NULL, NULL, 0, NULL, '0', NULL, 0, NULL, 6, NULL, '2019-09-17 06:47:22', '2019-09-21 00:01:46'),
(105, 5, '1568722642_49', 'Godrej', 'Godrej Interio', '2019', 'EDCIL House, 18A,Sector 16A, Noada (U.P.)', 'T&P', 'Chair', 'NHSRCL/MA CE03/TI-3/Gen-01/12', '03', NULL, '2019-04-16', '60.00', '576300.00', 'small', 'blue', '1 Year', '2 Different colors of chairs are here for training rooms.\r\nBlue & Green', 'InStore', NULL, 0, NULL, NULL, 0, NULL, '0', NULL, 0, NULL, 6, NULL, '2019-09-17 06:47:22', '2019-09-21 00:01:46'),
(106, 5, '1568722642_50', 'Godrej', 'Godrej Interio', '2019', 'EDCIL House, 18A,Sector 16A, Noada (U.P.)', 'T&P', 'Chair', 'NHSRCL/MA CE03/TI-3/Gen-01/12', '03', NULL, '2019-04-16', '60.00', '576300.00', 'small', 'blue', '1 Year', '2 Different colors of chairs are here for training rooms.\r\nBlue & Green', 'InStore', NULL, 0, NULL, NULL, 0, NULL, '0', NULL, 0, NULL, 6, NULL, '2019-09-17 06:47:22', '2019-09-21 00:01:46'),
(107, 5, '1568722642_51', 'Godrej', 'Godrej Interio', '2019', 'EDCIL House, 18A,Sector 16A, Noada (U.P.)', 'T&P', 'Chair', 'NHSRCL/MA CE03/TI-3/Gen-01/12', '03', NULL, '2019-04-16', '60.00', '576300.00', 'small', 'blue', '1 Year', '2 Different colors of chairs are here for training rooms.\r\nBlue & Green', 'InStore', NULL, 0, NULL, NULL, 0, NULL, '0', NULL, 0, NULL, 6, NULL, '2019-09-17 06:47:22', '2019-09-21 00:01:46'),
(108, 5, '1568722642_52', 'Godrej', 'Godrej Interio', '2019', 'EDCIL House, 18A,Sector 16A, Noada (U.P.)', 'T&P', 'Chair', 'NHSRCL/MA CE03/TI-3/Gen-01/12', '03', NULL, '2019-04-16', '60.00', '576300.00', 'small', 'blue', '1 Year', '2 Different colors of chairs are here for training rooms.\r\nBlue & Green', 'InStore', NULL, 0, NULL, NULL, 0, NULL, '0', NULL, 0, NULL, 6, NULL, '2019-09-17 06:47:22', '2019-09-21 00:01:46'),
(109, 5, '1568722642_53', 'Godrej', 'Godrej Interio', '2019', 'EDCIL House, 18A,Sector 16A, Noada (U.P.)', 'T&P', 'Chair', 'NHSRCL/MA CE03/TI-3/Gen-01/12', '03', NULL, '2019-04-16', '60.00', '576300.00', 'small', 'blue', '1 Year', '2 Different colors of chairs are here for training rooms.\r\nBlue & Green', 'InStore', NULL, 0, NULL, NULL, 0, NULL, '0', NULL, 0, NULL, 6, NULL, '2019-09-17 06:47:22', '2019-09-21 00:01:46'),
(110, 5, '1568722642_54', 'Godrej', 'Godrej Interio', '2019', 'EDCIL House, 18A,Sector 16A, Noada (U.P.)', 'T&P', 'Chair', 'NHSRCL/MA CE03/TI-3/Gen-01/12', '03', NULL, '2019-04-16', '60.00', '576300.00', 'small', 'blue', '1 Year', '2 Different colors of chairs are here for training rooms.\r\nBlue & Green', 'InStore', NULL, 0, NULL, NULL, 0, NULL, '0', NULL, 0, NULL, 6, NULL, '2019-09-17 06:47:22', '2019-09-21 00:01:46'),
(111, 5, '1568722642_55', 'Godrej', 'Godrej Interio', '2019', 'EDCIL House, 18A,Sector 16A, Noada (U.P.)', 'T&P', 'Chair', 'NHSRCL/MA CE03/TI-3/Gen-01/12', '03', NULL, '2019-04-16', '60.00', '576300.00', 'small', 'blue', '1 Year', '2 Different colors of chairs are here for training rooms.\r\nBlue & Green', 'InStore', NULL, 0, NULL, NULL, 0, NULL, '0', NULL, 0, NULL, 6, NULL, '2019-09-17 06:47:22', '2019-09-21 00:01:46'),
(112, 5, '1568722642_56', 'Godrej', 'Godrej Interio', '2019', 'EDCIL House, 18A,Sector 16A, Noada (U.P.)', 'T&P', 'Chair', 'NHSRCL/MA CE03/TI-3/Gen-01/12', '03', NULL, '2019-04-16', '60.00', '576300.00', 'small', 'blue', '1 Year', '2 Different colors of chairs are here for training rooms.\r\nBlue & Green', 'InStore', NULL, 0, NULL, NULL, 0, NULL, '0', NULL, 0, NULL, 6, NULL, '2019-09-17 06:47:22', '2019-09-21 00:01:46'),
(113, 5, '1568722642_57', 'Godrej', 'Godrej Interio', '2019', 'EDCIL House, 18A,Sector 16A, Noada (U.P.)', 'T&P', 'Chair', 'NHSRCL/MA CE03/TI-3/Gen-01/12', '03', NULL, '2019-04-16', '60.00', '576300.00', 'small', 'blue', '1 Year', '2 Different colors of chairs are here for training rooms.\r\nBlue & Green', 'InStore', NULL, 0, NULL, NULL, 0, NULL, '0', NULL, 0, NULL, 6, NULL, '2019-09-17 06:47:22', '2019-09-21 00:01:46'),
(114, 5, '1568722642_58', 'Godrej', 'Godrej Interio', '2019', 'EDCIL House, 18A,Sector 16A, Noada (U.P.)', 'T&P', 'Chair', 'NHSRCL/MA CE03/TI-3/Gen-01/12', '03', NULL, '2019-04-16', '60.00', '576300.00', 'small', 'blue', '1 Year', '2 Different colors of chairs are here for training rooms.\r\nBlue & Green', 'InStore', NULL, 0, NULL, NULL, 0, NULL, '0', NULL, 0, NULL, 6, NULL, '2019-09-17 06:47:22', '2019-09-21 00:01:46'),
(115, 5, '1568722642_59', 'Godrej', 'Godrej Interio', '2019', 'EDCIL House, 18A,Sector 16A, Noada (U.P.)', 'T&P', 'Chair', 'NHSRCL/MA CE03/TI-3/Gen-01/12', '03', NULL, '2019-04-16', '60.00', '576300.00', 'small', 'blue', '1 Year', '2 Different colors of chairs are here for training rooms.\r\nBlue & Green', 'InStore', NULL, 0, NULL, NULL, 0, NULL, '0', NULL, 0, NULL, 6, NULL, '2019-09-17 06:47:22', '2019-09-21 00:01:46'),
(116, 5, '1568722642_60', 'Godrej', 'Godrej Interio', '2019', 'EDCIL House, 18A,Sector 16A, Noada (U.P.)', 'T&P', 'Chair', 'NHSRCL/MA CE03/TI-3/Gen-01/12', '03', NULL, '2019-04-16', '60.00', '576300.00', 'small', 'blue', '1 Year', '2 Different colors of chairs are here for training rooms.\r\nBlue & Green', 'InStore', NULL, 0, NULL, NULL, 0, NULL, '0', NULL, 0, NULL, 6, NULL, '2019-09-17 06:47:22', '2019-09-21 00:01:46'),
(117, 6, '1568722805_1', 'Flip chart Board', 'FLIP CHART', '2019', 'EDCIL House, 18A,Sector 16A, Noada (U.P.)', 'T&P', 'Charging Cart', 'NHSRCL/MA CE03/TI-3/Gen-01/12', '03', NULL, '2019-04-16', '1.00', '35898.00', 'medium', 'Red', '1 Year', 'Charging Cart is using for multiples Laptops Charging at One time.', 'InStore', NULL, 0, NULL, NULL, 0, NULL, '0', NULL, 0, NULL, 6, NULL, '2019-09-17 06:50:05', '2019-09-20 23:52:05'),
(118, 7, '1568722996_1', 'Targus', 'FLIP CHART', '2019', 'EDCIL House, 18A,Sector 16A, Noada (U.P.)', 'T&P', 'Laser Pointer', 'NHSRCL/MA CE03/TI-3/Gen-01/12', '03', NULL, '2019-04-16', '3.00', '15426.00', 'small', 'black', '1 year', '3 Laser Pointer are use for presentation.', 'InStore', NULL, 0, NULL, NULL, 0, NULL, '0', NULL, 0, NULL, 6, NULL, '2019-09-17 06:53:16', '2019-09-18 00:31:24');
INSERT INTO `inventory_details` (`inventory_detail_id`, `inventory_id`, `unique_id`, `make`, `model`, `year`, `supplier`, `consumable`, `category`, `po_number`, `bill_no`, `item_unit`, `purchase_date`, `total_inventory`, `cost`, `size`, `color`, `warrenty`, `item_description`, `status`, `location`, `service_period`, `remarks`, `outward_date`, `outward_by`, `outward_by_name`, `deleted_status`, `deleted_date`, `deleted_by`, `deleted_by_name`, `created_by`, `created_by_name`, `created_at`, `updated_at`) VALUES
(119, 7, '1568722996_2', 'Targus', 'FLIP CHART', '2019', 'EDCIL House, 18A,Sector 16A, Noada (U.P.)', 'T&P', 'Laser Pointer', 'NHSRCL/MA CE03/TI-3/Gen-01/12', '03', NULL, '2019-04-16', '3.00', '15426.00', 'small', 'black', '1 year', '3 Laser Pointer are use for presentation.', 'InStore', NULL, 0, NULL, NULL, 0, NULL, '0', NULL, 0, NULL, 6, NULL, '2019-09-17 06:53:16', '2019-09-18 00:31:24'),
(120, 7, '1568722996_3', 'Targus', 'FLIP CHART', '2019', 'EDCIL House, 18A,Sector 16A, Noada (U.P.)', 'T&P', 'Laser Pointer', 'NHSRCL/MA CE03/TI-3/Gen-01/12', '03', NULL, '2019-04-16', '3.00', '15426.00', 'small', 'black', '1 year', '3 Laser Pointer are use for presentation.', 'InStore', NULL, 0, NULL, NULL, 0, NULL, '0', NULL, 0, NULL, 6, NULL, '2019-09-17 06:53:16', '2019-09-18 00:31:24'),
(121, 8, '1568723111_1', 'Flip chart Board', 'FLIP CHART', '2019', 'EDCIL House, 18A,Sector 16A, Noada (U.P.)', 'T&P', 'Podium', 'NHSRCL/MA CE03/TI-3/Gen-01/12', '03', NULL, '2019-04-16', '3.00', '190518.00', 'Standard', 'Black', '1 year', '3 Podium here for trainings', 'InStore', NULL, 0, NULL, NULL, 0, NULL, '0', NULL, 0, NULL, 6, NULL, '2019-09-17 06:55:11', '2019-09-20 23:52:05'),
(122, 8, '1568723111_2', 'Flip chart Board', 'FLIP CHART', '2019', 'EDCIL House, 18A,Sector 16A, Noada (U.P.)', 'T&P', 'Podium', 'NHSRCL/MA CE03/TI-3/Gen-01/12', '03', NULL, '2019-04-16', '3.00', '190518.00', 'Standard', 'Black', '1 year', '3 Podium here for trainings', 'InStore', NULL, 0, NULL, NULL, 0, NULL, '0', NULL, 0, NULL, 6, NULL, '2019-09-17 06:55:11', '2019-09-20 23:52:05'),
(123, 8, '1568723111_3', 'Flip chart Board', 'FLIP CHART', '2019', 'EDCIL House, 18A,Sector 16A, Noada (U.P.)', 'T&P', 'Podium', 'NHSRCL/MA CE03/TI-3/Gen-01/12', '03', NULL, '2019-04-16', '3.00', '190518.00', 'Standard', 'Black', '1 year', '3 Podium here for trainings', 'InStore', NULL, 0, NULL, NULL, 0, NULL, '0', NULL, 0, NULL, 6, NULL, '2019-09-17 06:55:11', '2019-09-20 23:52:05'),
(124, 9, '1568723267_1', 'Flip chart Board', 'FLIP CHART', '2019', 'EDCIL House, 18A,Sector 16A, Noada (U.P.)', 'T&P', 'Board', 'NHSRCL/MA CE03/TI-3/Gen-01/12', '03', NULL, '2019-04-16', '3.00', '17289.00', 'small', 'white', 'N/A', '3 flip chart board are here for training.', 'InStore', '', 0, 'received', '2019-09-17', 6, 'Vinay', '0', NULL, 0, NULL, 6, NULL, '2019-09-17 06:57:47', '2019-09-21 00:02:37'),
(125, 9, '1568723267_2', 'Flip chart Board', 'FLIP CHART', '2019', 'EDCIL House, 18A,Sector 16A, Noada (U.P.)', 'T&P', 'Board', 'NHSRCL/MA CE03/TI-3/Gen-01/12', '03', NULL, '2019-04-16', '3.00', '17289.00', 'small', 'white', 'N/A', '3 flip chart board are here for training.', 'InStore', NULL, 0, NULL, NULL, 0, NULL, '0', NULL, 0, NULL, 6, NULL, '2019-09-17 06:57:47', '2019-09-21 00:02:37'),
(126, 9, '1568723267_3', 'Flip chart Board', 'FLIP CHART', '2019', 'EDCIL House, 18A,Sector 16A, Noada (U.P.)', 'T&P', 'Board', 'NHSRCL/MA CE03/TI-3/Gen-01/12', '03', NULL, '2019-04-16', '3.00', '17289.00', 'small', 'white', 'N/A', '3 flip chart board are here for training.', 'InStore', NULL, 0, NULL, NULL, 0, NULL, '0', NULL, 0, NULL, 6, NULL, '2019-09-17 06:57:47', '2019-09-21 00:02:37'),
(127, 10, '1568723363_1', 'Flip chart Board', 'FLIP CHART', '2019', 'EDCIL House, 18A,Sector 16A, Noada (U.P.)', 'T&P', 'Keybox', 'NHSRCL/MA CE03/TI-3/Gen-01/12', '03', NULL, '2019-04-16', '1.00', '10735.00', 'small', 'white', 'N/A', 'Keybox for rooms key management', 'InStore', NULL, 0, NULL, NULL, 0, NULL, '0', NULL, 0, NULL, 6, NULL, '2019-09-17 06:59:23', '2019-09-20 23:52:05'),
(128, 11, '1568723614_1', 'Ceramic Board', 'FLIP CHART', '2019', 'EDCIL House, 18A,Sector 16A, Noada (U.P.)', 'T&P', 'Board', 'NHSRCL/MA CE03/TI-3/Gen-01/12', '03', NULL, '2019-04-16', '3.00', '37290.00', '8x3', 'white', 'N/A', '3 white ceramic has been changed dated 25 august 2019.', 'InStore', NULL, 0, NULL, NULL, 0, NULL, '0', NULL, 0, NULL, 6, NULL, '2019-09-17 07:03:34', '2019-09-21 00:02:37'),
(129, 11, '1568723614_2', 'Ceramic Board', 'FLIP CHART', '2019', 'EDCIL House, 18A,Sector 16A, Noada (U.P.)', 'T&P', 'Board', 'NHSRCL/MA CE03/TI-3/Gen-01/12', '03', NULL, '2019-04-16', '3.00', '37290.00', '8x3', 'white', 'N/A', '3 white ceramic has been changed dated 25 august 2019.', 'InStore', NULL, 0, NULL, NULL, 0, NULL, '0', NULL, 0, NULL, 6, NULL, '2019-09-17 07:03:34', '2019-09-21 00:02:37'),
(130, 11, '1568723614_3', 'Ceramic Board', 'FLIP CHART', '2019', 'EDCIL House, 18A,Sector 16A, Noada (U.P.)', 'T&P', 'Board', 'NHSRCL/MA CE03/TI-3/Gen-01/12', '03', NULL, '2019-04-16', '3.00', '37290.00', '8x3', 'white', 'N/A', '3 white ceramic has been changed dated 25 august 2019.', 'InStore', NULL, 0, NULL, NULL, 0, NULL, '0', NULL, 0, NULL, 6, NULL, '2019-09-17 07:03:34', '2019-09-21 00:02:37'),
(131, 12, '1568724218_1', 'LG', '65TC3D-B.ATR', '2019', 'EDCIL House, 18A,Sector 16A, Noada (U.P.)', 'T&P', 'TV', 'NHSRCL/MA CE03/TI-3/Gen-01/12', '03', NULL, '2019-04-16', '1.00', '339000.00', '65\"', 'Black', '1 year', 'LED Interactive Panel Is smart Boad which is used to smart Class and so on.', 'InStore', NULL, 0, NULL, NULL, 0, NULL, '0', NULL, 0, NULL, 6, NULL, '2019-09-17 07:13:38', '2019-09-21 00:03:42'),
(132, 13, '1568724336_1', 'K-Yan', 'K-Yan', '2019', 'EDCIL House, 18A,Sector 16A, Noada (U.P.)', 'T&P', 'Projector', 'NHSRCL/MA CE03/TI-3/Gen-01/12', '03', NULL, '2019-04-16', '3.00', '40680.00', 'Standard', 'Black', '1 Year', '3 Projectors are installed for training in TI', 'InStore', NULL, 0, NULL, NULL, 0, NULL, '0', NULL, 0, NULL, 6, NULL, '2019-09-17 07:15:36', '2019-09-17 07:15:36'),
(133, 13, '1568724336_2', 'K-Yan', 'K-Yan', '2019', 'EDCIL House, 18A,Sector 16A, Noada (U.P.)', 'T&P', 'Projector', 'NHSRCL/MA CE03/TI-3/Gen-01/12', '03', NULL, '2019-04-16', '3.00', '40680.00', 'Standard', 'Black', '1 Year', '3 Projectors are installed for training in TI', 'InStore', NULL, 0, NULL, NULL, 0, NULL, '0', NULL, 0, NULL, 6, NULL, '2019-09-17 07:15:36', '2019-09-17 07:15:36'),
(134, 13, '1568724336_3', 'K-Yan', 'K-Yan', '2019', 'EDCIL House, 18A,Sector 16A, Noada (U.P.)', 'T&P', 'Projector', 'NHSRCL/MA CE03/TI-3/Gen-01/12', '03', NULL, '2019-04-16', '3.00', '40680.00', 'Standard', 'Black', '1 Year', '3 Projectors are installed for training in TI', 'InStore', NULL, 0, NULL, NULL, 0, NULL, '0', NULL, 0, NULL, 6, NULL, '2019-09-17 07:15:36', '2019-09-17 07:15:36'),
(135, 14, '1568724593_1', 'Cabinate wall Mount', 'FLIP CHART', '2019', 'EDCIL House, 18A,Sector 16A, Noada (U.P.)', 'T&P', 'Cabinate Wall Mount', 'NHSRCL/MA CE03/TI-3/Gen-01/12', '03', NULL, '2019-04-16', '3.00', '18645.00', 'Small', 'Grey', 'N/A', 'Cabinate Wall  mount are installed for UPS Using 3 projectors.', 'InStore', NULL, 0, NULL, NULL, 0, NULL, '0', NULL, 0, NULL, 6, NULL, '2019-09-17 07:19:53', '2019-09-18 00:31:24'),
(136, 14, '1568724593_2', 'Cabinate wall Mount', 'FLIP CHART', '2019', 'EDCIL House, 18A,Sector 16A, Noada (U.P.)', 'T&P', 'Cabinate Wall Mount', 'NHSRCL/MA CE03/TI-3/Gen-01/12', '03', NULL, '2019-04-16', '3.00', '18645.00', 'Small', 'Grey', 'N/A', 'Cabinate Wall  mount are installed for UPS Using 3 projectors.', 'InStore', NULL, 0, NULL, NULL, 0, NULL, '0', NULL, 0, NULL, 6, NULL, '2019-09-17 07:19:53', '2019-09-18 00:31:24'),
(137, 14, '1568724593_3', 'Cabinate wall Mount', 'FLIP CHART', '2019', 'EDCIL House, 18A,Sector 16A, Noada (U.P.)', 'T&P', 'Cabinate Wall Mount', 'NHSRCL/MA CE03/TI-3/Gen-01/12', '03', NULL, '2019-04-16', '3.00', '18645.00', 'Small', 'Grey', 'N/A', 'Cabinate Wall  mount are installed for UPS Using 3 projectors.', 'InStore', NULL, 0, NULL, NULL, 0, NULL, '0', NULL, 0, NULL, 6, NULL, '2019-09-17 07:19:53', '2019-09-18 00:31:24'),
(138, 15, '1569044809_1', 'Exhibition Board', 'Stand Board', '2019', 'EDCIL House, 18A,Sector 16A, Noada (U.P.)', 'T&P', 'Board', 'NHSRCL/MA CE03TI-3/Gen-01/12', '03', NULL, '2019-04-16', '3.00', '29380.00', '2x3', 'Black', '1 Year', 'Exhibition Board has to be changed.still not change.', 'InStore', NULL, 0, NULL, NULL, 0, NULL, '0', NULL, 0, NULL, 6, NULL, '2019-09-21 00:16:49', '2019-09-21 00:16:49'),
(139, 15, '1569044809_2', 'Exhibition Board', 'Stand Board', '2019', 'EDCIL House, 18A,Sector 16A, Noada (U.P.)', 'T&P', 'Board', 'NHSRCL/MA CE03TI-3/Gen-01/12', '03', NULL, '2019-04-16', '3.00', '29380.00', '2x3', 'Black', '1 Year', 'Exhibition Board has to be changed.still not change.', 'InStore', NULL, 0, NULL, NULL, 0, NULL, '0', NULL, 0, NULL, 6, NULL, '2019-09-21 00:16:49', '2019-09-21 00:16:49'),
(140, 15, '1569044809_3', 'Exhibition Board', 'Stand Board', '2019', 'EDCIL House, 18A,Sector 16A, Noada (U.P.)', 'T&P', 'Board', 'NHSRCL/MA CE03TI-3/Gen-01/12', '03', NULL, '2019-04-16', '3.00', '29380.00', '2x3', 'Black', '1 Year', 'Exhibition Board has to be changed.still not change.', 'InStore', NULL, 0, NULL, NULL, 0, NULL, '0', NULL, 0, NULL, 6, NULL, '2019-09-21 00:16:49', '2019-09-21 00:16:49'),
(141, 16, '1569567306_1', 'HP', 'HP Laserjet Pro 377dw', '2019', 'Digiflux', 'Consumable', 'DesKTop', '123456', '2345678', NULL, '2019-09-27', '11.00', '333.00', '222', '1111', '111', 'test', 'InStore', NULL, 0, NULL, NULL, 0, NULL, '0', NULL, 0, NULL, 1, NULL, '2019-09-27 06:55:06', '2019-09-27 06:55:06'),
(142, 16, '1569567306_2', 'HP', 'HP Laserjet Pro 377dw', '2019', 'Digiflux', 'Consumable', 'DesKTop', '123456', '2345678', NULL, '2019-09-27', '11.00', '333.00', '222', '1111', '111', 'test', 'InStore', NULL, 0, NULL, NULL, 0, NULL, '0', NULL, 0, NULL, 1, NULL, '2019-09-27 06:55:06', '2019-09-27 06:55:06'),
(143, 16, '1569567306_3', 'HP', 'HP Laserjet Pro 377dw', '2019', 'Digiflux', 'Consumable', 'DesKTop', '123456', '2345678', NULL, '2019-09-27', '11.00', '333.00', '222', '1111', '111', 'test', 'InStore', NULL, 0, NULL, NULL, 0, NULL, '0', NULL, 0, NULL, 1, NULL, '2019-09-27 06:55:06', '2019-09-27 06:55:06'),
(144, 16, '1569567306_4', 'HP', 'HP Laserjet Pro 377dw', '2019', 'Digiflux', 'Consumable', 'DesKTop', '123456', '2345678', NULL, '2019-09-27', '11.00', '333.00', '222', '1111', '111', 'test', 'InStore', NULL, 0, NULL, NULL, 0, NULL, '0', NULL, 0, NULL, 1, NULL, '2019-09-27 06:55:06', '2019-09-27 06:55:06'),
(145, 16, '1569567306_5', 'HP', 'HP Laserjet Pro 377dw', '2019', 'Digiflux', 'Consumable', 'DesKTop', '123456', '2345678', NULL, '2019-09-27', '11.00', '333.00', '222', '1111', '111', 'test', 'InStore', NULL, 0, NULL, NULL, 0, NULL, '0', NULL, 0, NULL, 1, NULL, '2019-09-27 06:55:06', '2019-09-27 06:55:06'),
(146, 16, '1569567306_6', 'HP', 'HP Laserjet Pro 377dw', '2019', 'Digiflux', 'Consumable', 'DesKTop', '123456', '2345678', NULL, '2019-09-27', '11.00', '333.00', '222', '1111', '111', 'test', 'InStore', NULL, 0, NULL, NULL, 0, NULL, '0', NULL, 0, NULL, 1, NULL, '2019-09-27 06:55:06', '2019-09-27 06:55:06'),
(147, 16, '1569567306_7', 'HP', 'HP Laserjet Pro 377dw', '2019', 'Digiflux', 'Consumable', 'DesKTop', '123456', '2345678', NULL, '2019-09-27', '11.00', '333.00', '222', '1111', '111', 'test', 'InStore', NULL, 0, NULL, NULL, 0, NULL, '0', NULL, 0, NULL, 1, NULL, '2019-09-27 06:55:06', '2019-09-27 06:55:06'),
(148, 16, '1569567306_8', 'HP', 'HP Laserjet Pro 377dw', '2019', 'Digiflux', 'Consumable', 'DesKTop', '123456', '2345678', NULL, '2019-09-27', '11.00', '333.00', '222', '1111', '111', 'test', 'InStore', NULL, 0, NULL, NULL, 0, NULL, '0', NULL, 0, NULL, 1, NULL, '2019-09-27 06:55:06', '2019-09-27 06:55:06'),
(149, 16, '1569567306_9', 'HP', 'HP Laserjet Pro 377dw', '2019', 'Digiflux', 'Consumable', 'DesKTop', '123456', '2345678', NULL, '2019-09-27', '11.00', '333.00', '222', '1111', '111', 'test', 'InStore', NULL, 0, NULL, NULL, 0, NULL, '0', NULL, 0, NULL, 1, NULL, '2019-09-27 06:55:06', '2019-09-27 06:55:06'),
(150, 16, '1569567306_10', 'HP', 'HP Laserjet Pro 377dw', '2019', 'Digiflux', 'Consumable', 'DesKTop', '123456', '2345678', NULL, '2019-09-27', '11.00', '333.00', '222', '1111', '111', 'test', 'InStore', NULL, 0, NULL, NULL, 0, NULL, '0', NULL, 0, NULL, 1, NULL, '2019-09-27 06:55:06', '2019-09-27 06:55:06'),
(151, 16, '1569567306_11', 'HP', 'HP Laserjet Pro 377dw', '2019', 'Digiflux', 'Consumable', 'DesKTop', '123456', '2345678', NULL, '2019-09-27', '11.00', '333.00', '222', '1111', '111', 'test', 'InStore', NULL, 0, NULL, NULL, 0, NULL, '0', NULL, 0, NULL, 1, NULL, '2019-09-27 06:55:06', '2019-09-27 06:55:06'),
(152, 17, '1573467883_1', 'Mayank update', 'Mayank update', '1987', 'Mayank update', 'T&P', 'Mayank update', 'Mayank update', '1112222', 'Number', '2020-12-02', '12.40', '22.32', '11', 'Green', '3 Years', 'Mayank', 'InStore', NULL, 0, NULL, NULL, 0, NULL, '0', NULL, 0, NULL, 1, NULL, '2019-11-11 10:24:43', '2019-11-11 10:25:44'),
(153, 17, '1573467883_2', 'Mayank update', 'Mayank update', '1987', 'Mayank update', 'T&P', 'Mayank update', 'Mayank update', '1112222', 'Number', '2020-12-02', '12.40', '22.32', '11', 'Green', '3 Years', 'Mayank', 'InStore', NULL, 0, NULL, NULL, 0, NULL, '0', NULL, 0, NULL, 1, NULL, '2019-11-11 10:24:43', '2019-11-11 10:25:44'),
(154, 17, '1573467883_3', 'Mayank update', 'Mayank update', '1987', 'Mayank update', 'T&P', 'Mayank update', 'Mayank update', '1112222', 'Number', '2020-12-02', '12.40', '22.32', '11', 'Green', '3 Years', 'Mayank', 'InStore', NULL, 0, NULL, NULL, 0, NULL, '0', NULL, 0, NULL, 1, NULL, '2019-11-11 10:24:43', '2019-11-11 10:25:44'),
(155, 17, '1573467883_4', 'Mayank update', 'Mayank update', '1987', 'Mayank update', 'T&P', 'Mayank update', 'Mayank update', '1112222', 'Number', '2020-12-02', '12.40', '22.32', '11', 'Green', '3 Years', 'Mayank', 'InStore', NULL, 0, NULL, NULL, 0, NULL, '0', NULL, 0, NULL, 1, NULL, '2019-11-11 10:24:43', '2019-11-11 10:25:44'),
(156, 17, '1573467883_5', 'Mayank update', 'Mayank update', '1987', 'Mayank update', 'T&P', 'Mayank update', 'Mayank update', '1112222', 'Number', '2020-12-02', '12.40', '22.32', '11', 'Green', '3 Years', 'Mayank', 'InStore', NULL, 0, NULL, NULL, 0, NULL, '0', NULL, 0, NULL, 1, NULL, '2019-11-11 10:24:43', '2019-11-11 10:25:44'),
(157, 17, '1573467883_6', 'Mayank update', 'Mayank update', '1987', 'Mayank update', 'T&P', 'Mayank update', 'Mayank update', '1112222', 'Number', '2020-12-02', '12.40', '22.32', '11', 'Green', '3 Years', 'Mayank', 'InStore', NULL, 0, NULL, NULL, 0, NULL, '0', NULL, 0, NULL, 1, NULL, '2019-11-11 10:24:43', '2019-11-11 10:25:44'),
(158, 17, '1573467883_7', 'Mayank update', 'Mayank update', '1987', 'Mayank update', 'T&P', 'Mayank update', 'Mayank update', '1112222', 'Number', '2020-12-02', '12.40', '22.32', '11', 'Green', '3 Years', 'Mayank', 'InStore', NULL, 0, NULL, NULL, 0, NULL, '0', NULL, 0, NULL, 1, NULL, '2019-11-11 10:24:43', '2019-11-11 10:25:44'),
(159, 17, '1573467883_8', 'Mayank update', 'Mayank update', '1987', 'Mayank update', 'T&P', 'Mayank update', 'Mayank update', '1112222', 'Number', '2020-12-02', '12.40', '22.32', '11', 'Green', '3 Years', 'Mayank', 'InStore', NULL, 0, NULL, NULL, 0, NULL, '0', NULL, 0, NULL, 1, NULL, '2019-11-11 10:24:43', '2019-11-11 10:25:44'),
(160, 17, '1573467883_9', 'Mayank update', 'Mayank update', '1987', 'Mayank update', 'T&P', 'Mayank update', 'Mayank update', '1112222', 'Number', '2020-12-02', '12.40', '22.32', '11', 'Green', '3 Years', 'Mayank', 'InStore', NULL, 0, NULL, NULL, 0, NULL, '0', NULL, 0, NULL, 1, NULL, '2019-11-11 10:24:43', '2019-11-11 10:25:44'),
(161, 17, '1573467883_10', 'Mayank update', 'Mayank update', '1987', 'Mayank update', 'T&P', 'Mayank update', 'Mayank update', '1112222', 'Number', '2020-12-02', '12.40', '22.32', '11', 'Green', '3 Years', 'Mayank', 'InStore', NULL, 0, NULL, NULL, 0, NULL, '0', NULL, 0, NULL, 1, NULL, '2019-11-11 10:24:43', '2019-11-11 10:25:44'),
(162, 17, '1573467883_11', 'Mayank update', 'Mayank update', '1987', 'Mayank update', 'T&P', 'Mayank update', 'Mayank update', '1112222', 'Number', '2020-12-02', '12.40', '22.32', '11', 'Green', '3 Years', 'Mayank', 'InStore', NULL, 0, NULL, NULL, 0, NULL, '0', NULL, 0, NULL, 1, NULL, '2019-11-11 10:24:43', '2019-11-11 10:25:44'),
(163, 17, '1573467883_12', 'Mayank update', 'Mayank update', '1987', 'Mayank update', 'T&P', 'Mayank update', 'Mayank update', '1112222', 'Number', '2020-12-02', '12.40', '22.32', '11', 'Green', '3 Years', 'Mayank', 'InStore', NULL, 0, NULL, NULL, 0, NULL, '0', NULL, 0, NULL, 1, NULL, '2019-11-11 10:24:43', '2019-11-11 10:25:44'),
(164, 17, '1573467883_13', 'Mayank update', 'Mayank update', '1987', 'Mayank update', 'T&P', 'Mayank update', 'Mayank update', '1112222', 'Number', '2020-12-02', '12.40', '22.32', '11', 'Green', '3 Years', 'Mayank', 'InStore', NULL, 0, NULL, NULL, 0, NULL, '0', NULL, 0, NULL, 1, NULL, '2019-11-11 10:24:43', '2019-11-11 10:25:44');

-- --------------------------------------------------------

--
-- Table structure for table `inventory_details_activity`
--

CREATE TABLE `inventory_details_activity` (
  `inventory_detail_activity_id` bigint(20) UNSIGNED NOT NULL,
  `inventory_detail_id` int(11) NOT NULL DEFAULT 0,
  `inventory_id` int(11) NOT NULL DEFAULT 0,
  `unique_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `make` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `model` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `year` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `supplier` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `consumable` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `category` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `po_number` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bill_no` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `item_unit` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `purchase_date` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `total_inventory` decimal(10,2) DEFAULT NULL,
  `cost` decimal(10,2) DEFAULT NULL,
  `size` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `color` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `warrenty` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `item_description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `location` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `service_period` int(11) NOT NULL DEFAULT 0,
  `remarks` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `outward_date` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `outward_by` int(11) DEFAULT NULL,
  `outward_by_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `action` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deleted_status` enum('0','1') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `deleted_date` date DEFAULT NULL,
  `deleted_by` int(11) NOT NULL DEFAULT 0,
  `deleted_by_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_by` int(11) NOT NULL DEFAULT 0,
  `created_by_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `inventory_details_activity`
--

INSERT INTO `inventory_details_activity` (`inventory_detail_activity_id`, `inventory_detail_id`, `inventory_id`, `unique_id`, `make`, `model`, `year`, `supplier`, `consumable`, `category`, `po_number`, `bill_no`, `item_unit`, `purchase_date`, `total_inventory`, `cost`, `size`, `color`, `warrenty`, `item_description`, `status`, `location`, `service_period`, `remarks`, `outward_date`, `outward_by`, `outward_by_name`, `action`, `deleted_status`, `deleted_date`, `deleted_by`, `deleted_by_name`, `created_by`, `created_by_name`, `created_at`, `updated_at`) VALUES
(1, 1, 1, '8X70XS2', 'Dell', 'Dell Latitude 3490', '2019', 'EDCIL House, 18A,Sector 16A, Noada (U.P.)', 'T&P', 'Laptop', 'NHSRCL/MA CEO3/TI-3/Gen-01/12', '03', NULL, '2019-04-16', '20.00', '1106360.00', '14\" Inch', 'Black', '1 Year', 'Dell Latitude 3490\r\n1 TB hard Disk \r\n4GB RAM\r\ni5, 8 GEN,1.60 -1.80 GHz\r\nWindows 10 Pro', 'SentToRepair', 'Workshop', 5, 'Testing Purpose', '2019-09-16', 6, 'Vinay', NULL, '0', NULL, 0, NULL, 6, NULL, '2019-09-16 00:55:01', '2019-09-21 00:00:10'),
(2, 1, 1, '8X70XS2', 'Dell', 'Dell Latitude 3490', '2019', 'EDCIL House, 18A,Sector 16A, Noada (U.P.)', 'T&P', 'Laptop', 'NHSRCL/MA CEO3/TI-3/Gen-01/12', '03', NULL, '2019-04-16', '20.00', '1106360.00', '14\" Inch', 'Black', '1 Year', 'Dell Latitude 3490\r\n1 TB hard Disk \r\n4GB RAM\r\ni5, 8 GEN,1.60 -1.80 GHz\r\nWindows 10 Pro', 'SentToRepair', 'Workshop', -1, 'Testing', '2019-09-16', 6, 'Vinay', NULL, '0', NULL, 0, NULL, 6, NULL, '2019-09-16 00:55:01', '2019-09-21 00:00:10'),
(3, 1, 1, '8X70XS2', 'Dell', 'Dell Latitude 3490', '2019', 'EDCIL House, 18A,Sector 16A, Noada (U.P.)', 'T&P', 'Laptop', 'NHSRCL/MA CEO3/TI-3/Gen-01/12', '03', NULL, '2019-04-16', '20.00', '1106360.00', '14\" Inch', 'Black', '1 Year', 'Dell Latitude 3490\r\n1 TB hard Disk \r\n4GB RAM\r\ni5, 8 GEN,1.60 -1.80 GHz\r\nWindows 10 Pro', 'InStore', '', 0, 'Back from Repair', '2019-09-16', 6, 'Vinay', NULL, '0', NULL, 0, NULL, 6, NULL, '2019-09-16 00:55:01', '2019-09-21 00:00:10'),
(4, 1, 1, '8X70XS2', 'Dell', 'Dell Latitude 3490', '2019', 'EDCIL House, 18A,Sector 16A, Noada (U.P.)', 'T&P', 'Laptop', 'NHSRCL/MA CEO3/TI-3/Gen-01/12', '03', NULL, '2019-04-16', '20.00', '1106360.00', '14\" Inch', 'Black', '1 Year', 'Dell Latitude 3490\r\n1 TB hard Disk \r\n4GB RAM\r\ni5, 8 GEN,1.60 -1.80 GHz\r\nWindows 10 Pro', 'Dispatched', 'hall 2', 0, 'vinay 1', '2019-09-16', 6, 'Vinay', NULL, '0', NULL, 0, NULL, 6, NULL, '2019-09-16 00:55:01', '2019-09-21 00:00:10'),
(5, 1, 1, '8X70XS2', 'Dell', 'Dell Latitude 3490', '2019', 'EDCIL House, 18A,Sector 16A, Noada (U.P.)', 'T&P', 'Laptop', 'NHSRCL/MA CEO3/TI-3/Gen-01/12', '03', NULL, '2019-04-16', '20.00', '1106360.00', '14\" Inch', 'Black', '1 Year', 'Dell Latitude 3490\r\n1 TB hard Disk \r\n4GB RAM\r\ni5, 8 GEN,1.60 -1.80 GHz\r\nWindows 10 Pro', 'InStore', '', 0, 'return', '2019-09-16', 6, 'Vinay', NULL, '0', NULL, 0, NULL, 6, NULL, '2019-09-16 00:55:01', '2019-09-21 00:00:10'),
(6, 1, 1, '8X70XS2', 'Dell', 'Dell Latitude 3490', '2019', 'EDCIL House, 18A,Sector 16A, Noada (U.P.)', 'T&P', 'Laptop', 'NHSRCL/MA CEO3/TI-3/Gen-01/12', '03', NULL, '2019-04-16', '20.00', '1106360.00', '14\" Inch', 'Black', '1 Year', 'Dell Latitude 3490\r\n1 TB hard Disk \r\n4GB RAM\r\ni5, 8 GEN,1.60 -1.80 GHz\r\nWindows 10 Pro', 'Dispatched', 'hall 2', 0, 'vinay 1', '2019-09-16', 6, 'Vinay', NULL, '0', NULL, 0, NULL, 6, NULL, '2019-09-16 00:55:01', '2019-09-21 00:00:10'),
(7, 124, 9, '1568723267_1', 'Flip chart Board', 'FLIP CHART', '2019', 'EDCIL House, 18A,Sector 16A, Noada (U.P.)', 'T&P', 'Board', 'NHSRCL/MA CE03/TI-3/Gen-01/12', '03', NULL, '2019-04-16', '3.00', '17289.00', 'small', 'white', 'N/A', '3 flip chart board are here for training.', 'InStore', '', 0, 'received', '2019-09-17', 6, 'Vinay', NULL, '0', NULL, 0, NULL, 6, NULL, '2019-09-17 06:57:47', '2019-09-21 00:02:37');

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `jobs`
--

INSERT INTO `jobs` (`id`, `queue`, `payload`, `attempts`, `reserved_at`, `available_at`, `created_at`) VALUES
(563, 'default', '{\"displayName\":\"App\\\\Notifications\\\\ResetPassword\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"delay\":null,\"timeout\":null,\"timeoutAt\":null,\"data\":{\"commandName\":\"Illuminate\\\\Notifications\\\\SendQueuedNotifications\",\"command\":\"O:48:\\\"Illuminate\\\\Notifications\\\\SendQueuedNotifications\\\":11:{s:11:\\\"notifiables\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":4:{s:5:\\\"class\\\";s:8:\\\"App\\\\User\\\";s:2:\\\"id\\\";i:19;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";}s:12:\\\"notification\\\";O:31:\\\"App\\\\Notifications\\\\ResetPassword\\\":9:{s:5:\\\"token\\\";s:64:\\\"e818822e52eacececa6f720e037eb7eb7806d30ed108032b2a5a949c5a3f80f6\\\";s:2:\\\"id\\\";s:36:\\\"9a54539b-0c49-4986-ad20-e23d1631bcf6\\\";s:6:\\\"locale\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:5:\\\"delay\\\";N;s:7:\\\"chained\\\";a:0:{}}s:8:\\\"channels\\\";a:1:{i:0;s:4:\\\"mail\\\";}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:5:\\\"delay\\\";N;s:7:\\\"chained\\\";a:0:{}}\"}}', 255, NULL, 1571046198, 1571046198),
(564, 'default', '{\"displayName\":\"App\\\\Notifications\\\\ResetPassword\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"delay\":null,\"timeout\":null,\"timeoutAt\":null,\"data\":{\"commandName\":\"Illuminate\\\\Notifications\\\\SendQueuedNotifications\",\"command\":\"O:48:\\\"Illuminate\\\\Notifications\\\\SendQueuedNotifications\\\":11:{s:11:\\\"notifiables\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":4:{s:5:\\\"class\\\";s:8:\\\"App\\\\User\\\";s:2:\\\"id\\\";i:52;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";}s:12:\\\"notification\\\";O:31:\\\"App\\\\Notifications\\\\ResetPassword\\\":9:{s:5:\\\"token\\\";s:64:\\\"482620ac77642aa1636fb632fbe54a6504936af9a543e4db348587b755776bad\\\";s:2:\\\"id\\\";s:36:\\\"324c0003-19c8-4f4c-aef4-0f074914843f\\\";s:6:\\\"locale\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:5:\\\"delay\\\";N;s:7:\\\"chained\\\";a:0:{}}s:8:\\\"channels\\\";a:1:{i:0;s:4:\\\"mail\\\";}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:5:\\\"delay\\\";N;s:7:\\\"chained\\\";a:0:{}}\"}}', 238, NULL, 1571046199, 1571046199),
(565, 'default', '{\"displayName\":\"App\\\\Notifications\\\\ResetPassword\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"delay\":null,\"timeout\":null,\"timeoutAt\":null,\"data\":{\"commandName\":\"Illuminate\\\\Notifications\\\\SendQueuedNotifications\",\"command\":\"O:48:\\\"Illuminate\\\\Notifications\\\\SendQueuedNotifications\\\":11:{s:11:\\\"notifiables\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":4:{s:5:\\\"class\\\";s:8:\\\"App\\\\User\\\";s:2:\\\"id\\\";i:8;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";}s:12:\\\"notification\\\";O:31:\\\"App\\\\Notifications\\\\ResetPassword\\\":9:{s:5:\\\"token\\\";s:64:\\\"564941518f656b7fd496c35a64a498a66103e46be02d885a51b5aefdb4a63741\\\";s:2:\\\"id\\\";s:36:\\\"2b73748a-9b3e-402a-a681-c7bcf70b95ca\\\";s:6:\\\"locale\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:5:\\\"delay\\\";N;s:7:\\\"chained\\\";a:0:{}}s:8:\\\"channels\\\";a:1:{i:0;s:4:\\\"mail\\\";}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:5:\\\"delay\\\";N;s:7:\\\"chained\\\";a:0:{}}\"}}', 0, NULL, 1572421008, 1572421008),
(566, 'default', '{\"displayName\":\"App\\\\Notifications\\\\ResetPassword\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"delay\":null,\"timeout\":null,\"timeoutAt\":null,\"data\":{\"commandName\":\"Illuminate\\\\Notifications\\\\SendQueuedNotifications\",\"command\":\"O:48:\\\"Illuminate\\\\Notifications\\\\SendQueuedNotifications\\\":11:{s:11:\\\"notifiables\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":4:{s:5:\\\"class\\\";s:8:\\\"App\\\\User\\\";s:2:\\\"id\\\";i:8;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";}s:12:\\\"notification\\\";O:31:\\\"App\\\\Notifications\\\\ResetPassword\\\":9:{s:5:\\\"token\\\";s:64:\\\"384dd310641829ab3a484fdf1dbc075b3e871ba52699d98a3b0a6168026ac193\\\";s:2:\\\"id\\\";s:36:\\\"cec7ee70-c29c-4596-9360-caeb52297116\\\";s:6:\\\"locale\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:5:\\\"delay\\\";N;s:7:\\\"chained\\\";a:0:{}}s:8:\\\"channels\\\";a:1:{i:0;s:4:\\\"mail\\\";}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:5:\\\"delay\\\";N;s:7:\\\"chained\\\";a:0:{}}\"}}', 0, NULL, 1572421107, 1572421107),
(567, 'default', '{\"displayName\":\"App\\\\Notifications\\\\ResetPassword\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"delay\":null,\"timeout\":null,\"timeoutAt\":null,\"data\":{\"commandName\":\"Illuminate\\\\Notifications\\\\SendQueuedNotifications\",\"command\":\"O:48:\\\"Illuminate\\\\Notifications\\\\SendQueuedNotifications\\\":11:{s:11:\\\"notifiables\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":4:{s:5:\\\"class\\\";s:8:\\\"App\\\\User\\\";s:2:\\\"id\\\";i:19;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";}s:12:\\\"notification\\\";O:31:\\\"App\\\\Notifications\\\\ResetPassword\\\":9:{s:5:\\\"token\\\";s:64:\\\"d26f8b060c8853b6c505cdca077cb42ea145e5e23419c07f9b8b676373ff80bb\\\";s:2:\\\"id\\\";s:36:\\\"eaf3cd92-e339-48f6-a94e-d73a571aab47\\\";s:6:\\\"locale\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:5:\\\"delay\\\";N;s:7:\\\"chained\\\";a:0:{}}s:8:\\\"channels\\\";a:1:{i:0;s:4:\\\"mail\\\";}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:5:\\\"delay\\\";N;s:7:\\\"chained\\\";a:0:{}}\"}}', 0, NULL, 1572421183, 1572421183);

-- --------------------------------------------------------

--
-- Table structure for table `location`
--

CREATE TABLE `location` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `display_status` enum('1','0') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1',
  `deleted_status` enum('1','0') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `location`
--

INSERT INTO `location` (`id`, `name`, `display_status`, `deleted_status`, `created_at`, `updated_at`) VALUES
(1, 'Workshop', '1', '0', '2019-09-16 08:53:23', '2019-09-16 08:53:23'),
(2, 'hall 2', '1', '0', '2019-09-16 11:29:39', '2019-09-16 11:29:39');

-- --------------------------------------------------------

--
-- Table structure for table `make`
--

CREATE TABLE `make` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `display_status` enum('1','0') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1',
  `deleted_status` enum('1','0') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `make`
--

INSERT INTO `make` (`id`, `name`, `display_status`, `deleted_status`, `created_at`, `updated_at`) VALUES
(1, 'HP', '1', '0', '2019-07-17 05:53:33', '2019-07-17 05:53:33'),
(3, 'Flax print', '1', '0', '2019-07-17 23:39:04', '2019-07-17 23:39:04'),
(4, 'EPSON', '1', '0', '2019-07-17 23:57:24', '2019-07-17 23:57:24'),
(5, 'Shangar', '1', '0', '2019-07-18 00:37:59', '2019-07-18 00:37:59'),
(6, 'Dell', '1', '0', '2019-07-18 00:45:47', '2019-07-18 00:45:47'),
(7, 'Tyrone Systems', '1', '0', '2019-07-29 01:43:06', '2019-07-29 01:43:06'),
(8, 'BenQ', '1', '0', '2019-07-29 01:49:50', '2019-07-29 01:49:50'),
(9, 'EMERSON', '1', '0', '2019-07-29 02:08:02', '2019-07-29 02:08:02'),
(10, 'D-Link', '1', '0', '2019-07-29 02:11:48', '2019-07-29 02:11:48'),
(11, 'Godrej', '1', '0', '2019-07-29 02:56:31', '2019-07-29 02:56:31'),
(12, 'K-Yan', '1', '0', '2019-07-29 03:03:01', '2019-07-29 03:03:01'),
(13, 'Charging Cart', '1', '0', '2019-07-29 03:04:38', '2019-07-29 03:04:38'),
(14, 'RoHS', '1', '0', '2019-07-29 03:06:02', '2019-07-29 03:06:02'),
(15, 'Studeo master', '1', '0', '2019-07-29 03:11:31', '2019-07-29 03:11:31'),
(16, 'Flip chart Board', '1', '0', '2019-07-29 03:14:06', '2019-09-20 23:52:05'),
(17, 'LG', '1', '0', '2019-08-12 23:37:48', '2019-08-12 23:37:48'),
(18, 'TOSHIBA', '1', '0', '2019-08-20 00:34:16', '2019-08-20 00:34:16'),
(19, 'EdCIL', '1', '0', '2019-09-17 06:50:05', '2019-09-20 23:41:33'),
(20, 'Targus', '1', '0', '2019-09-17 06:53:16', '2019-09-17 06:53:16'),
(21, 'Ceramic Board', '1', '0', '2019-09-17 07:03:34', '2019-09-17 07:03:34'),
(22, 'Cabinate wall Mount', '1', '0', '2019-09-17 07:19:53', '2019-09-17 07:19:53'),
(23, 'Exhibition Board', '1', '0', '2019-09-21 00:16:49', '2019-09-21 00:16:49'),
(24, 'Mayank', '1', '0', '2019-11-11 10:24:43', '2019-11-11 10:24:43'),
(25, 'Mayank update', '1', '0', '2019-11-11 10:25:44', '2019-11-11 10:25:44');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_04_21_033551_add_user_fields', 1),
(4, '2019_04_21_035239_trainee', 1),
(5, '2019_04_21_035759_items', 1),
(6, '2019_04_21_040540_inventory', 1),
(7, '2019_04_21_040911_hostel_rooms', 1),
(8, '2019_04_21_041311_hostel', 1),
(9, '2019_04_21_041640_feedback', 1),
(10, '2019_04_21_042155_course', 1),
(11, '2019_04_21_042937_certificates', 1),
(12, '2019_04_21_065752_roles', 1),
(13, '2019_04_21_065906_roles_access', 1),
(14, '2019_04_25_015630_items_activities', 1),
(15, '2019_05_17_092049_trainee_field_add', 1),
(16, '2019_05_17_094150_trainee_activity', 1),
(17, '2019_05_17_134554_trainee_fields_added', 1),
(18, '2019_05_19_034416_add_activities_field', 1),
(19, '2019_05_23_105557_session_management', 1),
(20, '2019_05_23_105823_add_session_to_training', 1),
(21, '2019_06_20_052121_outward', 1),
(22, '2019_06_21_151940_supplier', 1),
(23, '2019_06_21_152113_make', 1),
(24, '2019_06_21_152128_model', 1),
(25, '2019_06_21_152142_inches', 1),
(26, '2019_06_21_152156_years', 1),
(27, '2019_07_05_112717_category', 1),
(28, '2019_07_12_130130_item_outward_quantity', 1),
(29, '2019_07_24_091159_create_jobs_table', 2),
(30, '2019_07_24_132457_create_failed_jobs_table', 3),
(31, '2019_08_09_072405_create_remove_extra_tables_table', 4),
(32, '2019_08_09_083010_create_inventories_table', 4),
(33, '2019_08_09_083042_create_inventory_details_table', 4),
(34, '2019_08_13_064204_create_inventories_activity_table', 4),
(35, '2019_08_13_064500_create_inventory_details_activity_table', 4),
(36, '2019_08_16_061935_remove_sr_no_from_inventories_table', 4),
(37, '2019_08_19_043451_change_datatype_trainee', 4),
(38, '2019_08_19_050829_add_field_to_trainee', 4),
(39, '2019_08_19_055028_add_field_training', 4),
(40, '2019_08_19_103551_create_location_table', 4),
(41, '2019_08_20_101714_add_field_inventory_attachment', 4),
(42, '2019_08_23_095458_generate_cert_id_trainee', 4),
(43, '2019_08_30_103240_add_service_period_in_inventory_details_table', 5),
(44, '2019_07_10_103608_create_cache_table', 6),
(45, '2019_10_14_050238_add_field_to_session', 6),
(46, '2019_11_11_063528_add_field_unit', 7),
(47, '2019_11_11_065649_changefield_quantity', 7),
(48, '2019_11_11_072338_add_field_to_inventories', 7),
(49, '2019_11_11_074121_add_field_to_session', 7),
(50, '2019_11_11_095147_hostel_modifications', 8),
(51, '2019_11_11_112631_modifications_rooms', 9),
(52, '2019_11_11_134204_add_fields_to_all_hostel_room_time', 9),
(53, '2019_11_12_020732_hostel_rooms_modifications', 10),
(54, '2019_11_12_045555_hostel_room_activity', 10),
(55, '2019_11_13_112036_add_level_trainee_table', 11);

-- --------------------------------------------------------

--
-- Table structure for table `model`
--

CREATE TABLE `model` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `display_status` enum('1','0') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1',
  `deleted_status` enum('1','0') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `model`
--

INSERT INTO `model` (`id`, `name`, `display_status`, `deleted_status`, `created_at`, `updated_at`) VALUES
(1, 'HP Laserjet Pro 377dw', '1', '0', '2019-07-17 05:53:33', '2019-07-17 05:53:33'),
(3, 'NHSRCL TI Banner', '1', '0', '2019-07-17 23:39:04', '2019-07-17 23:39:04'),
(4, 'EPSON L3110', '1', '0', '2019-07-17 23:57:24', '2019-07-17 23:57:24'),
(5, '6303 Roller Blind', '1', '0', '2019-07-18 00:37:59', '2019-07-18 00:37:59'),
(6, 'Dell Latitude 3490', '1', '0', '2019-07-18 00:45:47', '2019-07-18 00:45:47'),
(7, 'Camarero SS400T3R-34-256RK042', '1', '0', '2019-07-29 01:43:06', '2019-07-29 01:43:06'),
(8, 'BenQ GW2780', '1', '0', '2019-07-29 01:49:50', '2019-07-29 01:49:50'),
(9, 'Liebert ITON CS 1500 VA', '1', '0', '2019-07-29 02:08:02', '2019-07-29 02:08:02'),
(10, 'DIR-825', '1', '0', '2019-07-29 02:11:48', '2019-07-29 02:11:48'),
(11, 'Godrej Interio', '1', '0', '2019-07-29 02:56:31', '2019-07-29 02:56:31'),
(12, 'K-Yan', '1', '0', '2019-07-29 03:03:01', '2019-07-29 03:03:01'),
(13, 'Charging Cart', '1', '0', '2019-07-29 03:04:38', '2019-07-29 03:04:38'),
(14, 'V-G-YAAN', '1', '0', '2019-07-29 03:06:02', '2019-07-29 03:06:02'),
(15, 'Classroom Wireless Audio System', '1', '0', '2019-07-29 03:11:31', '2019-07-29 03:11:31'),
(16, 'FLIP CHART', '1', '0', '2019-07-29 03:14:06', '2019-09-18 00:31:24'),
(17, '65TC3D-B.ATR', '1', '0', '2019-08-12 23:37:48', '2019-08-12 23:37:48'),
(18, 'All In One', '1', '0', '2019-08-20 00:19:42', '2019-08-20 00:19:42'),
(19, 'Toshiba e-studio  2510AC', '1', '0', '2019-08-20 00:34:16', '2019-08-20 00:34:16'),
(20, 'Liebert ITON CX 1500 VA', '1', '0', '2019-09-17 06:39:01', '2019-09-17 06:39:01'),
(21, 'Stand Board', '1', '0', '2019-09-21 00:16:49', '2019-09-21 00:16:49'),
(22, 'Mayank', '1', '0', '2019-11-11 10:24:43', '2019-11-11 10:24:43'),
(23, 'Mayank update', '1', '0', '2019-11-11 10:25:44', '2019-11-11 10:25:44');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `password_resets`
--

INSERT INTO `password_resets` (`email`, `token`, `created_at`) VALUES
('dchsrti.brc@nhsrcl.in', '$2y$10$oK7WlNtE2oAPYmjSJsLz1Oydbfatkp/SPdsor9xRScrXhKaAOlbSi', '2019-07-17 05:49:17'),
('srmgrciv1.adi@nhsrcl.in', '$2y$10$c44ML9Ih0EFwRyqbf50J.uYN23tjkIK.EhAQisncJgwQnK4AVuvdy', '2019-07-23 07:01:47'),
('mgrciv3.st@nhsrcl.in', '$2y$10$ek/x4mAHIdYLhK6wOxc0XeUcpESiXOfddgCWqba4Lg/Cz3YJIAdtq', '2019-07-23 07:04:29'),
('sanamsoni91@gmail.com', '$2y$10$4XSdceHH7tVKBUJpSMwtbONiWGjgZm5VlWheWeipYxTHtghla.AGm', '2019-08-08 03:24:49'),
('mgrcivmum1@nhsrcl.in', '$2y$10$r6EUDHdOub88g8zR7EPTcupQgXWVj8RnN7xq5Jd6fukd5h3TzUQr.', '2019-08-08 03:26:02'),
('mgrbrc.nhsrcl@gmail.com', '$2y$10$G1HELRAcpzCUbaCU.YfJlO8siCygvUdwloLMYH3TXbBjAYaJGmEKW', '2019-08-08 03:28:53'),
('dycpmciv1.vapi@nhsrcl.in', '$2y$10$49ZO9UNa5G1cmGuUnGawfOF98N6s9lzN4duMvNjz9jMqCifRNQFQ6', '2019-08-08 03:35:07'),
('dgoffice92@gmail.com', '$2y$10$bFJDn3efZj1uKPhmelkmjOhVxR7en3mlSCXqZilVn03MbmdSdmSS.', '2019-08-08 03:49:38'),
('srmciv1.adi@nhsrcl.in', '$2y$10$sXCAFQ9jGHCynMfxKNW.YuxGi5o4vxPX2X8lKBkjCtxwmpkBPvGli', '2019-08-20 01:21:29'),
('bhaskarswr@gmail.com', '$2y$10$gL4qp8NngQsD3p8SluqZ.O6taixcIEAppN1OdqExVHAysLSKE85XG', '2019-08-20 01:23:31'),
('dycpmsnt.st@nhsrcl.in', '$2y$10$m.JJ9p/ZlQpy4jDVkzdI9Osw2p5GH6ZkcxWL2mkTKE.LM9dfSbFYW', '2019-08-20 01:31:58'),
('dycpmelect1.st@nhsrcl.in', '$2y$10$mj7NjxCpCxKRJVJm.A4O9u0qOvzi0sth/v6TZ25UOHoukDFX7p7tq', '2019-08-20 01:35:10'),
('mgrciv2.st@nhsrcl.in', '$2y$10$1xK.tQxN1vHymR/cpIv1JufIZEzx.Ywc.LZNvQdfQW01BiuFIDM.K', '2019-08-20 01:36:33'),
('balwant_cd@yahoo.com', '$2y$10$G7cbOEeERuCItmlTmCCZdecaUyAFa9T5.1GWGu6IpMCAnLPvdixi6', '2019-08-20 01:37:19'),
('mgrelec2dli@nhsrcl.in', '$2y$10$Y2llZ/yWzFBs9gP.x6d62.mxflOhYVYN3yfPT107Y6lJOvK7QM0mu', '2019-08-20 01:41:19'),
('rahulpathaknhsrcl@gamil.com', '$2y$10$4Z77ONwjOIA5JL9xWbSCWOyc8qBJvDpi8uapYDXbSYhykJowCfyqS', '2019-08-20 01:54:41'),
('mailurs.vj@gamil.com', '$2y$10$62kx8noz61JbZ9qnRRPXduAwczVgLRZ/yDHldPr0s3ghat9yiZbii', '2019-08-20 01:57:01'),
('hemalpandya92@gmail.com', '$2y$10$nP0jrZ16qPxVzY2pDGhPYOC4pTcVD6XSbzeEkOW.d6mRqFaQcDFNy', '2019-11-11 04:27:18'),
('shivom@yopmail.com', '$2y$10$d/j26bzh1LM4FedFZ.tdw.29uRHExdPaHzCouyeVp0/xOQWrchX1K', '2019-11-13 08:09:38'),
('mayankp@yopmail.com', '$2y$10$l6YxkQDXzkfG0KcVIWyHHu6R3B.8SGqf6asmxB8miX3Xi/Sm76H6C', '2019-11-13 08:55:17'),
('mrugesh@yopmail.com', '$2y$10$vr6lJxFchsmSGAjedb3.GemivrzWtnHpE3WmnZDedJNpBzlTdz3em', '2019-11-13 08:55:34'),
('hemal@yopmail.com', '$2y$10$L5f.2REJSL7Hwr/oGX0wyOLqTrk2/LC17CJj1xrbdmfc40CvlvjKO', '2019-11-13 09:04:47'),
('hemal@digiflux.io', '$2y$10$rX46c1Nf.XzXvbEoneJSTOCrcka/vFNwkCaizAARVfIS10CFsfFGO', '2019-11-13 09:05:46'),
('maulika@yopmail.com', '$2y$10$cLYPu07M85yBH/S8.mBNjudE36A8f4dirEV23i6UUuP6u1WpMG8/G', '2019-11-13 09:07:30');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int(10) UNSIGNED NOT NULL,
  `role_title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `role_description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `display_status` enum('1','0') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1',
  `deleted_status` enum('1','0') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `role_title`, `role_description`, `display_status`, `deleted_status`, `created_at`, `updated_at`) VALUES
(1, 'Administrator', 'Administrator Role', '1', '0', '2019-07-17 05:48:35', '2019-07-17 05:48:35'),
(2, 'Trainees', 'Trainees Role', '1', '0', '2019-07-17 05:48:35', '2019-07-17 05:48:35'),
(3, 'Hostel Incharge', 'Hostel Incharge Role', '1', '0', '2019-07-17 05:48:35', '2019-07-17 05:48:35'),
(4, 'Inventory Incharge', 'Inventory Incharge Role', '1', '0', '2019-07-17 05:48:35', '2019-07-17 05:48:35'),
(5, 'Trainee Incharge', 'Trainee Incharge Role', '1', '0', '2019-07-17 05:48:35', '2019-07-17 05:48:35');

-- --------------------------------------------------------

--
-- Table structure for table `roles_access`
--

CREATE TABLE `roles_access` (
  `role_access_id` int(10) UNSIGNED NOT NULL,
  `role_id` int(11) NOT NULL DEFAULT 0,
  `module_id` int(11) NOT NULL DEFAULT 0,
  `allow_view` enum('1','0') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `allow_add` enum('1','0') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `allow_edit` enum('1','0') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `allow_delete` enum('1','0') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles_access`
--

INSERT INTO `roles_access` (`role_access_id`, `role_id`, `module_id`, `allow_view`, `allow_add`, `allow_edit`, `allow_delete`, `created_at`, `updated_at`) VALUES
(1, 1, 14, '1', '0', '0', '0', NULL, NULL),
(2, 1, 13, '1', '0', '0', '0', NULL, NULL),
(3, 1, 17, '1', '0', '0', '0', NULL, NULL),
(4, 1, 12, '1', '0', '0', '0', NULL, NULL),
(5, 1, 11, '1', '0', '0', '0', NULL, NULL),
(6, 1, 19, '1', '0', '0', '0', NULL, NULL),
(7, 1, 20, '1', '0', '0', '0', NULL, NULL),
(8, 1, 10, '1', '0', '0', '0', NULL, NULL),
(9, 1, 16, '1', '0', '0', '0', NULL, NULL),
(10, 1, 9, '1', '0', '0', '0', NULL, NULL),
(11, 1, 8, '1', '0', '0', '0', NULL, NULL),
(12, 1, 7, '1', '0', '0', '0', NULL, NULL),
(13, 1, 6, '1', '0', '0', '0', NULL, NULL),
(14, 2, 9, '1', '0', '0', '0', NULL, NULL),
(15, 2, 6, '1', '0', '0', '0', NULL, NULL),
(16, 2, 3, '1', '0', '0', '0', NULL, NULL),
(17, 1, 5, '1', '0', '0', '0', NULL, NULL),
(18, 3, 14, '1', '0', '0', '0', NULL, NULL),
(19, 3, 13, '1', '0', '0', '0', NULL, NULL),
(20, 3, 1, '1', '0', '0', '0', NULL, NULL),
(21, 4, 12, '1', '0', '0', '0', NULL, NULL),
(22, 1, 4, '1', '0', '0', '0', NULL, NULL),
(23, 4, 11, '1', '0', '0', '0', NULL, NULL),
(24, 5, 10, '1', '0', '0', '0', NULL, NULL),
(25, 5, 9, '1', '0', '0', '0', NULL, NULL),
(26, 1, 3, '1', '0', '0', '0', NULL, NULL),
(27, 1, 2, '1', '0', '0', '0', NULL, NULL),
(28, 1, 1, '1', '0', '0', '0', NULL, NULL),
(29, 2, 1, '1', '0', '0', '0', NULL, NULL),
(30, 1, 18, '1', '0', '0', '0', NULL, NULL),
(31, 1, 15, '1', '0', '0', '0', NULL, NULL),
(32, 2, 10, '1', '0', '0', '0', NULL, NULL),
(33, 5, 20, '1', '0', '0', '0', NULL, NULL),
(34, 5, 19, '1', '0', '0', '0', NULL, NULL),
(35, 4, 17, '1', '0', '0', '0', NULL, NULL),
(36, 3, 18, '1', '0', '0', '0', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` int(10) UNSIGNED NOT NULL,
  `course_id` int(11) NOT NULL DEFAULT 0,
  `faculty_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `conducted_by` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `deleted_status` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `course_id`, `faculty_name`, `conducted_by`, `start_date`, `end_date`, `deleted_status`, `created_at`, `updated_at`) VALUES
(1, 1, 'DIGITAL SURVEYING', NULL, '2019-07-26', '2019-07-26', '0', '2019-07-22 01:27:35', '2019-07-23 06:50:01'),
(2, 2, 'Slab Track  Casting2', NULL, '2019-10-15', '2019-10-16', '0', '2019-08-08 03:14:46', '2019-10-14 09:18:15'),
(3, 3, 'Planning,Scheduling, Monitoring & Billing Process', 'Digiflux IT Solutions', '2019-08-23', '2019-08-23', '0', '2019-08-20 01:17:49', '2019-10-14 05:14:18'),
(4, 2, 'ssa', 'asas', '2019-10-31', '2019-10-31', '0', '2019-10-30 07:39:35', '2019-10-30 07:39:35'),
(5, 3, 'Digiflux Training Session', 'Digiflux Team', '2019-11-15', '2019-11-17', '0', '2019-11-13 08:08:41', '2019-11-13 08:08:41'),
(6, 1, 'Digiflux EOM Session', 'Digiflux Team', '2019-11-28', '2019-11-30', '0', '2019-11-13 08:55:00', '2019-11-13 08:55:00');

-- --------------------------------------------------------

--
-- Table structure for table `supplier`
--

CREATE TABLE `supplier` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `contact` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gst` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `display_status` enum('1','0') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1',
  `deleted_status` enum('1','0') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `supplier`
--

INSERT INTO `supplier` (`id`, `name`, `address`, `contact`, `gst`, `display_status`, `deleted_status`, `created_at`, `updated_at`) VALUES
(1, 'softek office products pvt ltd', NULL, NULL, NULL, '1', '0', '2019-07-17 05:53:33', '2019-07-17 05:53:33'),
(3, 'Disha Concepts Pvt Ltd', NULL, NULL, NULL, '1', '0', '2019-07-17 23:39:04', '2019-07-17 23:39:04'),
(4, 'Mehulendra corporation vadodara', NULL, NULL, NULL, '1', '0', '2019-07-17 23:57:24', '2019-07-17 23:57:24'),
(5, 'Shangar', NULL, NULL, NULL, '1', '0', '2019-07-18 00:37:59', '2019-07-18 00:37:59'),
(6, 'EdCIL', NULL, NULL, NULL, '1', '0', '2019-07-18 00:45:47', '2019-07-18 00:45:47'),
(7, 'ABC Corporation', NULL, NULL, NULL, '1', '0', '2019-07-26 04:22:16', '2019-07-26 04:22:16'),
(8, 'Netweb Technologies Ind. Pvt Ltd', NULL, NULL, NULL, '1', '0', '2019-07-29 01:43:06', '2019-07-29 01:43:06'),
(9, 'EDCIL House, 18A,Sector 16A, Noada (U.P.)', NULL, NULL, NULL, '1', '0', '2019-07-29 02:08:02', '2019-07-29 02:08:02'),
(10, 'Roma Network Pvt Ltd.', NULL, NULL, NULL, '1', '0', '2019-08-20 00:19:42', '2019-08-20 00:19:42'),
(11, 'Techno Commercial System', NULL, NULL, NULL, '1', '0', '2019-08-20 00:34:16', '2019-08-20 00:34:16'),
(12, 'Digiflux', NULL, NULL, NULL, '1', '0', '2019-08-23 10:36:16', '2019-08-23 10:36:16'),
(13, 'Mayank', NULL, NULL, NULL, '1', '0', '2019-11-11 10:24:43', '2019-11-11 10:24:43'),
(14, 'Mayank update', NULL, NULL, NULL, '1', '0', '2019-11-11 10:25:44', '2019-11-11 10:25:44');

-- --------------------------------------------------------

--
-- Table structure for table `trainee`
--

CREATE TABLE `trainee` (
  `trainee_id` bigint(20) UNSIGNED NOT NULL,
  `session_id` int(11) NOT NULL DEFAULT 0,
  `session_start_date` date DEFAULT NULL,
  `session_end_date` date DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `designation` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `department` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `employee_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `employee_level` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `joining_date` date DEFAULT NULL,
  `birth_date` date DEFAULT NULL,
  `attendence_confirm` int(11) NOT NULL DEFAULT 2,
  `preferred_date` date DEFAULT NULL,
  `contact_number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `hostel_accomodations` enum('1','0','2') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '2',
  `requested_meal` enum('1','0','2') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '2',
  `transport_request` enum('1','0','2') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '2',
  `special_request` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remarks` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `level` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `arrival_date` date DEFAULT NULL,
  `departure_date` date DEFAULT NULL,
  `transport_details` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `posting_station` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `participate_description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `excellent_description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gen_exce_certi` enum('1','0') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `gen_exce_certi_generated_by` int(11) NOT NULL DEFAULT 0,
  `gen_exce_certi_generated_date` date DEFAULT NULL,
  `certificate_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `excellent_certificate_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `last_updated_by` int(11) NOT NULL DEFAULT 0,
  `last_updated_by_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `trainee`
--

INSERT INTO `trainee` (`trainee_id`, `session_id`, `session_start_date`, `session_end_date`, `name`, `designation`, `department`, `employee_id`, `employee_level`, `joining_date`, `birth_date`, `attendence_confirm`, `preferred_date`, `contact_number`, `hostel_accomodations`, `requested_meal`, `transport_request`, `special_request`, `remarks`, `level`, `arrival_date`, `departure_date`, `transport_details`, `posting_station`, `email`, `password`, `participate_description`, `excellent_description`, `gen_exce_certi`, `gen_exce_certi_generated_by`, `gen_exce_certi_generated_date`, `certificate_id`, `excellent_certificate_id`, `status`, `created_by`, `last_updated_by`, `last_updated_by_name`, `created_at`, `updated_at`) VALUES
(1, 1, '2019-07-26', '2019-07-26', 'VINAY KUMAR', 'AE', NULL, NULL, NULL, '2019-07-03', '2007-01-31', 1, NULL, '8516897975', '0', '1', '0', NULL, NULL, NULL, NULL, NULL, NULL, 'brc', 'vinay2abb@gmail.com', '$2y$10$DdATzOHsoq9bveJL1Zt2TewwjjXZmg.FYpgXGDHsiIh1alPKATLnO', NULL, NULL, '0', 0, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2019-07-22 01:28:55', '2019-07-22 01:42:44'),
(4, 1, '2019-07-26', '2019-07-26', 'Shri. Keshav Moondra', NULL, NULL, NULL, NULL, NULL, NULL, 2, NULL, NULL, '2', '2', '2', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'apmcivadi1@nhsrcl.in', '$2y$10$bINAUIISaxIj8REnb6SugekXn0g9LGr1AA4awPxqvs5nEQlmzugOW', NULL, NULL, '0', 0, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2019-07-23 06:49:07', '2019-07-23 06:49:07'),
(5, 1, '2019-07-26', '2019-07-26', 'Mr Rachit Jain', NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, '2', '2', '2', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'mgrcivmum2@nhsrcl.in', '$2y$10$iuTo/k/PPLbdVKQ.qOM/8uREkVvhj6nDppQ9VkjX6a79vAcgI8Gta', NULL, NULL, '0', 0, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2019-07-23 06:51:39', '2019-07-23 06:51:39'),
(6, 1, '2019-07-26', '2019-07-26', 'Kumar Deepak Shrivastava', 'Manager', NULL, NULL, NULL, '2018-05-02', '1987-10-25', 1, NULL, '7227909594', '0', '1', '0', NULL, NULL, NULL, '2019-07-26', '2019-07-26', NULL, 'Surat', 'mgrciv1st@nhsrcl.in', '$2y$10$DBfSr13DEALj.jbpLhwvNekLy3jKOBemQUGBOYmfB3AjA/dBAfTYO', NULL, NULL, '0', 0, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2019-07-23 06:53:26', '2019-07-23 07:16:50'),
(7, 1, '2019-07-26', '2019-07-26', 'SH. KRISHAN SINGH', NULL, NULL, NULL, NULL, NULL, NULL, 2, NULL, NULL, '2', '2', '2', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'mgrcivmum4@nhsrcl.in', '$2y$10$x9k3dslHhsQ8sEg3TW.q..L3nZjA5OrnlyurZRi7HAG0aJMPGdfFS', NULL, NULL, '0', 0, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2019-07-23 06:55:16', '2019-07-23 06:55:16'),
(8, 1, '2019-07-26', '2019-07-26', 'BrajKishor Sharma', NULL, NULL, NULL, NULL, NULL, NULL, 2, NULL, NULL, '2', '2', '2', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'srmgrciv1.adi@nhsrcl.in', '$2y$10$U7qgThfhEcMVr1Jjt.Rjk.aD0zKGAFHOH4WbbpToi71p3EcjGpmSy', NULL, NULL, '0', 0, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2019-07-23 07:01:47', '2019-07-23 07:01:47'),
(9, 1, '2019-07-26', '2019-07-26', 'Mr. Ankush Dogra', NULL, NULL, NULL, NULL, NULL, NULL, 2, NULL, NULL, '2', '2', '2', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'mgrcivilnhsrcl@gmail.com', '$2y$10$Fv6qc4VGfvPz5CEDhq9NAeUXsI7/lc9nifCBAAnWQk6uXPuI/ali2', NULL, NULL, '0', 0, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2019-07-23 07:03:18', '2019-07-23 07:03:18'),
(10, 1, '2019-07-26', '2019-07-26', 'Md. Akram Khan', NULL, NULL, NULL, NULL, NULL, NULL, 2, NULL, NULL, '2', '2', '2', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'mgrciv3.st@nhsrcl.in', '$2y$10$gJoApDPdYdSwsQ4j/y7hyOy5grmPdCWvpuOeGK08PcrPmrWNI30zS', NULL, NULL, '0', 0, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2019-07-23 07:04:28', '2019-07-23 07:04:28'),
(11, 1, '2019-07-26', '2019-07-26', 'Mr. Mudit Rediwal', 'Sr. Executive Engineer (Civil)', NULL, NULL, NULL, '2017-11-15', '1993-11-17', 1, NULL, '8233576323', '2', '1', '1', NULL, NULL, NULL, '2019-07-26', '2019-07-26', NULL, 'Vadodara', 'rediwal.mudit43@gmail.com', '$2y$10$AiPtdg0PdaLp4/3J0s9JRO7hSlgNE1vLgs.AGlQSPfwIT8ZOniYt.', NULL, NULL, '0', 0, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2019-07-23 07:13:21', '2019-07-23 07:29:18'),
(22, 2, '2019-08-09', '2019-08-09', 'Raghvendra Pratap Singh', NULL, NULL, NULL, NULL, NULL, NULL, 2, NULL, NULL, '2', '2', '2', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'pmciv1mum@nhsrcl.in', '$2y$10$1zkADvT/EkshcGELz01izOGBYFrdTJpnIMSqGsnnRSz6PpYuD9Elu', NULL, NULL, '0', 0, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2019-08-08 03:19:01', '2019-08-08 03:19:01'),
(23, 2, '2019-08-09', '2019-08-09', 'Anand Singh Charan', NULL, NULL, NULL, NULL, NULL, NULL, 2, NULL, NULL, '2', '2', '2', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'mgrciviladi@nhsrcl.in', '$2y$10$fm/zzblrrzWVStlgj5nBbeb7DP8QkESqduwb5bNDAHDeM4cj.K6YS', NULL, NULL, '0', 0, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2019-08-08 03:20:20', '2019-08-08 03:20:20'),
(24, 2, '2019-08-09', '2019-08-09', 'Sanam Soni', NULL, NULL, NULL, NULL, NULL, NULL, 2, NULL, NULL, '2', '2', '2', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'sanamsoni91@gmail.com', '$2y$10$SDVMEeIznRhDQ0OwoztB0.rZsHHK8LYMnRKWarsUqbk8XUcnK75am', NULL, NULL, '0', 0, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2019-08-08 03:24:49', '2019-08-08 03:24:49'),
(25, 2, '2019-08-09', '2019-08-09', 'ARUN NAYAK', NULL, NULL, NULL, NULL, NULL, NULL, 2, NULL, NULL, '2', '2', '2', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'mgrcivmum1@nhsrcl.in', '$2y$10$uNzYAZPkPTH5oqVhxuL4G.0ICTCX5R2OvEq/d3q89nJJj2gRo26kC', NULL, NULL, '0', 0, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2019-08-08 03:26:02', '2019-08-08 03:26:02'),
(26, 2, '2019-08-09', '2019-08-09', 'Manjunatha G', NULL, NULL, NULL, NULL, NULL, NULL, 2, NULL, NULL, '2', '2', '2', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'mgrcivilbrc1@nhsrcl.in', '$2y$10$IftoKlOv29sykljL05qovuvIRiEwv4lsiEYHYpIsojqyUR0GYVvQK', NULL, NULL, '0', 0, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2019-08-08 03:28:27', '2019-08-08 03:28:27'),
(27, 2, '2019-08-09', '2019-08-09', 'Mr. Gaurav Srivastava', NULL, NULL, NULL, NULL, NULL, NULL, 2, NULL, NULL, '2', '2', '2', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'mgrbrc.nhsrcl@gmail.com', '$2y$10$D4sCE1lSzcVkaHm4f2aUZ.t.v8dI72YD6eMkk7t35JjcBZjDfgATG', NULL, NULL, '0', 0, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2019-08-08 03:28:53', '2019-08-08 03:28:53'),
(28, 2, '2019-08-09', '2019-08-09', 'himang Jain', 'Manager civil', NULL, NULL, NULL, '2018-06-08', '1990-11-09', 1, NULL, '9004485016', '0', '1', '1', NULL, NULL, NULL, '2019-08-09', '2019-08-09', 'Flight', 'Mumbai', 'mgrcivmum3@nhsrcl.in', '$2y$10$yH.8dV2OlwhX7zR.hJqW4..8urHFSZRGVW4h/2XLnTpkNioYnOK/.', NULL, NULL, '0', 0, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2019-08-08 03:31:02', '2019-08-08 19:27:07'),
(29, 2, '2019-08-09', '2019-08-09', 'Anuj Kumar verma', NULL, NULL, NULL, NULL, NULL, NULL, 2, NULL, NULL, '2', '2', '2', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'dycpmciv1.vapi@nhsrcl.in', '$2y$10$QDOn7G7.xVuVaGeEyTXjC.opu0ZhLnKxraVSSMG3ww38/T8Th.8em', NULL, NULL, '0', 0, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2019-08-08 03:35:06', '2019-08-08 03:35:06'),
(30, 2, '2019-08-09', '2019-08-09', 'Deepak Kulshrestha', 'Dy CPM (Civil)', NULL, NULL, NULL, NULL, NULL, 2, NULL, '9619138687', '2', '2', '2', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'dmrc.ngn@gmail.com', '$2y$10$/YiY5FWeUJtHjKUvINeeFO/kiaMy.h70EJpwELfF2vgciQ7r8UKj.', NULL, NULL, '0', 0, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2019-08-08 03:38:29', '2019-08-08 03:51:51'),
(31, 2, '2019-08-09', '2019-08-09', 'Rahul Mishra', 'Manager/ Track', NULL, NULL, NULL, NULL, '1986-03-25', 1, NULL, '7228939532', '0', '1', '0', NULL, NULL, NULL, NULL, NULL, NULL, 'Vapi', 'mishra.kant@gmail.com', '$2y$10$LxKPM8D/yV7r8D2CDa/CkuHq8H.qnv77T.FiQA0KQg5qyCXw3iy9C', NULL, NULL, '0', 0, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2019-08-08 03:43:01', '2019-08-08 08:33:09'),
(32, 2, '2019-08-09', '2019-08-09', 'Ketan Katariya', NULL, NULL, NULL, NULL, NULL, NULL, 2, NULL, NULL, '2', '2', '2', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'nhsrclciviladi@gmail.com', '$2y$10$F38FgEg7wkky3aIlkI5Xd.HGeC1uiy3ksL/0.pJsGMWy3I/.PP8ae', NULL, NULL, '0', 0, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2019-08-08 03:47:01', '2019-08-08 03:51:15'),
(33, 2, '2019-08-09', '2019-08-09', 'Mr. Dipak Garge', NULL, NULL, NULL, NULL, NULL, NULL, 2, NULL, NULL, '2', '2', '2', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'dgoffice92@gmail.com', '$2y$10$58rQpzCquGiKvAD27Ysf3eHOK5RnWsIJX51HM43C2hfNbY9jgQ4pW', NULL, NULL, '0', 0, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2019-08-08 03:49:38', '2019-08-08 03:49:38'),
(34, 2, '2019-08-09', '2019-08-09', 'Vineet Rajkumar', 'DEO', NULL, NULL, NULL, '2018-06-01', '1995-03-05', 1, NULL, '9724014152', '0', '1', '0', NULL, NULL, NULL, NULL, NULL, NULL, 'Vadodara', 'vineetrajkumar969@gmail.com', '$2y$10$hVdOtZiktH4sLIuDm2NQS.nA6e7ako8PmmPpOT5GIPKpWxcRFpV9G', NULL, NULL, '0', 0, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2019-08-08 03:50:54', '2019-08-08 04:00:53'),
(35, 2, '2019-08-09', '2019-08-09', 'RUPESH BONDRE', 'Executive civil', NULL, NULL, NULL, '2019-08-09', '1991-02-06', 1, NULL, '9630163184', '1', '1', '1', NULL, NULL, NULL, '2019-08-09', '2019-08-09', NULL, 'Mumbai', 'rupeshbondre624@gmail.com', '$2y$10$e9iQDto5slJ0uNssaqntN.lW1sp8ww83b57pYDxweMH3mE2ErTKyG', NULL, NULL, '0', 0, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2019-08-08 03:54:18', '2019-08-08 05:39:53'),
(36, 2, '2019-08-09', '2019-08-09', 'Testin', 'Consultant', NULL, NULL, NULL, NULL, NULL, 1, NULL, '989898988', '2', '1', '2', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'hemal@digiflux.io', '$2y$10$DQ9KFAZCsXUxJH4732Dj5uBc2AbuWPzwJjXdbPC/4UeZE.wMDSjf6', NULL, NULL, '0', 0, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2019-08-08 08:18:05', '2019-08-08 08:19:19'),
(37, 3, '2019-08-23', '2019-08-23', 'Gaurav Saraswat', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, '2', '2', '2', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'srmgrmech1adi@nhsrcl.in', '$2y$10$iVz2YtM9YRKpeX23cJGmdOdt9yXEuH/AuTEDZS7IIH3Zpu26bREMu', NULL, NULL, '0', 0, NULL, NULL, NULL, NULL, NULL, 6, 'Vinay', '2019-08-20 01:19:08', '2019-08-20 02:30:37'),
(38, 3, '2019-08-23', '2019-08-23', 'Kingshuk Sarkar', 'DGM (Systems)', NULL, NULL, NULL, '2018-04-02', '1978-02-12', 3, NULL, '9818461494', '0', '1', '0', NULL, NULL, NULL, NULL, NULL, NULL, 'Ahmedabad', 'dycpmelec1.adi@nhsrcl.in', '$2y$10$NUutR/axh4eLCCraByXD1e7PHtPfRgbYTClSfQICRnknHeEGDEpYi', NULL, NULL, '0', 0, NULL, '2', NULL, NULL, NULL, 1, 'Administrator Role', '2019-08-20 01:20:36', '2019-08-20 02:28:15'),
(39, 3, '2019-08-23', '2019-08-23', 'Brij Kishor Sharma', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, '2', '2', '2', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'srmciv1.adi@nhsrcl.in', '$2y$10$7Il.264rk7yuFDoWO4qppuXAhN6R42lJog9z14lvP2m3IIykCo1aO', NULL, NULL, '0', 0, NULL, NULL, NULL, NULL, NULL, 6, 'Vinay', '2019-08-20 01:21:29', '2019-08-22 06:21:00'),
(40, 3, '2019-08-23', '2019-08-23', 'S. Bhaskaran', NULL, NULL, NULL, NULL, NULL, NULL, 3, NULL, NULL, '2', '2', '2', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'bhaskarswr@gmail.com', '$2y$10$btcTLpx4KM30gJ9oG7VnMe6QX0F8RjCI3ONBBb0dBVG3WQpF.Qfne', NULL, NULL, '0', 0, NULL, '12', NULL, NULL, NULL, 1, 'Administrator Role', '2019-08-20 01:23:31', '2019-08-20 01:23:31'),
(41, 3, '2019-08-23', '2019-08-23', 'Santosh Kumar Patil', 'Senior Manager Electrical', NULL, NULL, NULL, '2018-01-15', NULL, 3, NULL, '7506455889', '1', '1', '1', 'provide vehicle for air port in morning and evening for railway station', NULL, NULL, '2019-08-23', '2019-08-23', 'provide vehicle for air port in morning and evening for railway station', 'Palghar', 'srmgrelec1mum@nhsrcl.in', '$2y$10$7NeAm6K9AOT5Xw5GyCffrOIQVR.qDRzFqezseA.VXzWTSF.kYvuly', NULL, NULL, '0', 0, NULL, '1', NULL, NULL, NULL, 1, 'Administrator Role', '2019-08-20 01:30:08', '2019-08-21 09:15:37'),
(42, 3, '2019-08-23', '2019-08-23', 'Rachit Jain', NULL, NULL, NULL, NULL, NULL, NULL, 3, NULL, NULL, '2', '2', '2', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'mgrcivmum2@nhsrcl.in', '$2y$10$nX2nk4qqz064xclTEqUpoebYy412btpA0teLWj1GyssAP8MLzp/ia', NULL, NULL, '0', 0, NULL, '4', NULL, NULL, NULL, 1, 'Administrator Role', '2019-08-20 01:31:06', '2019-08-20 01:31:06'),
(43, 3, '2019-08-23', '2019-08-23', 'Shyamal Biswas', NULL, NULL, NULL, NULL, NULL, NULL, 3, NULL, NULL, '2', '2', '2', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'dycpmsnt.st@nhsrcl.in', '$2y$10$FeuCauTm/BpnvHPkeJWOI.iwEJvUyOumwQ//ZBMSWB7CsDM/sDLPq', NULL, NULL, '0', 0, NULL, '5', NULL, NULL, NULL, 1, 'Administrator Role', '2019-08-20 01:31:58', '2019-08-20 01:31:58'),
(44, 3, '2019-08-23', '2019-08-23', 'Krishan Singh', 'Manager (Civil)', NULL, NULL, NULL, '2018-05-02', '1986-04-15', 3, NULL, '9816503163', '0', '2', '1', 'Cab pickup from Vadodara airport at 7:30am and in evening drop to Ahmedabad airport.', NULL, NULL, '2019-08-23', '2019-08-23', 'Cab', 'Mumbai', 'mgrcivmum4@nhsrcl.in', '$2y$10$4dtLFHA44Pd5FNp76enMjuik56/WyrCBkgAaqbH69EdvEGp7gwAK2', NULL, NULL, '0', 0, NULL, '6', NULL, NULL, NULL, 1, 'Administrator Role', '2019-08-20 01:33:22', '2019-08-21 23:47:54'),
(45, 3, '2019-08-23', '2019-08-23', 'Himang Jain', 'Manager', NULL, NULL, NULL, '2018-06-08', '1990-11-09', 3, NULL, '9004485016', '0', '1', '1', 'Cab required from airport in morning and to ahmedabad in evening', NULL, NULL, '2019-08-23', '2019-08-23', 'Cab required from airport in morning and to ahmedabad in evening', 'Mumbai', 'mgrcivmum3@nhsrcl.in', '$2y$10$2cjOHSj8w.06ksfYkiS5EetlsCODSoY1Pk49tns7vF6ztYpd0ypLu', NULL, NULL, '0', 0, NULL, '7', NULL, NULL, NULL, 1, 'Administrator Role', '2019-08-20 01:34:21', '2019-08-21 00:02:00'),
(46, 3, '2019-08-23', '2019-08-23', 'Deepinder Pal Singh', NULL, NULL, NULL, NULL, NULL, NULL, 3, NULL, NULL, '2', '2', '2', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'dycpmelect1.st@nhsrcl.in', '$2y$10$s2br/GBTjyF5kuBDUR34reyLP63fOWw6CWm4zgWy7G5ROOvJK98ny', NULL, NULL, '0', 0, NULL, '8', NULL, NULL, NULL, 1, 'Administrator Role', '2019-08-20 01:35:10', '2019-08-20 01:35:10'),
(47, 3, '2019-08-23', '2019-08-23', 'Ankush Dogra', NULL, NULL, NULL, NULL, NULL, NULL, 3, NULL, NULL, '2', '2', '2', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'mgrcivilnhsrcl@gmail.com', '$2y$10$lDanoIZFAZJGPlkKlWYRz.q1HUVnTeAGoII3Bpebqt8s/MqWhHRz2', NULL, NULL, '0', 0, NULL, '9', NULL, NULL, NULL, 1, 'Administrator Role', '2019-08-20 01:35:49', '2019-08-20 01:35:49'),
(48, 3, '2019-08-23', '2019-08-23', 'Trichanshu Kumar', NULL, NULL, NULL, NULL, NULL, NULL, 3, NULL, NULL, '2', '2', '2', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'mgrciv2.st@nhsrcl.in', '$2y$10$WqqCnWA5zi4qzd85pN.zFer4EKlbmj7mXpTppoa.wMIHZOrBDFek6', NULL, NULL, '0', 0, NULL, '10', NULL, NULL, NULL, 1, 'Administrator Role', '2019-08-20 01:36:33', '2019-08-20 01:36:33'),
(49, 3, '2019-08-23', '2019-08-23', 'Balwant Kumar', NULL, NULL, NULL, NULL, NULL, NULL, 3, NULL, NULL, '2', '2', '2', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'balwant_cd@yahoo.com', '$2y$10$sVVi5bK8I4HepCQ30z99z.sszR4xyYKnlVr3vJSG0f/JCJj.hA6P.', NULL, NULL, '0', 0, NULL, '11', NULL, NULL, NULL, 1, 'Administrator Role', '2019-08-20 01:37:19', '2019-08-20 01:37:19'),
(50, 3, '2019-08-23', '2019-08-23', 'Govindu Sivasankar', 'Senior Manager/RS(Design)', NULL, NULL, NULL, '2019-03-15', '1991-07-07', 3, NULL, '8826788004', '0', '1', '1', NULL, NULL, NULL, '2019-08-23', '2019-08-23', 'Flight arrival at 6:35AM to vadodara, departure by flight from vadodara at 20:20hrs on same day', 'New Delhi', 'srmgrrs2@nhsrcl.in', '$2y$10$rxT9IFPD9FzJrGPRV78tq.YnNAbdbT10pkN9B2b2wTIu1oRXLeE5e', NULL, NULL, '0', 0, NULL, '13', NULL, NULL, NULL, 1, 'Administrator Role', '2019-08-20 01:40:02', '2019-08-21 07:37:59'),
(51, 3, '2019-08-23', '2019-08-23', 'V.S.V. Srinivas', NULL, NULL, NULL, NULL, NULL, NULL, 3, NULL, NULL, '2', '2', '2', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'mgrelec2dli@nhsrcl.in', '$2y$10$dFqwdACoCPMl5kcDw.PYV.WqO/2sSyIkR2j.zmD5Lba1xRQlZ7LAK', NULL, NULL, '0', 0, NULL, '14', NULL, NULL, NULL, 1, 'Administrator Role', '2019-08-20 01:41:19', '2019-08-20 01:41:19'),
(52, 3, '2019-08-23', '2019-08-23', 'Rahul Pathak', NULL, NULL, NULL, NULL, NULL, NULL, 3, NULL, NULL, '2', '2', '2', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'rahulpathaknhsrcl@gamil.com', '$2y$10$yxT.BQB4enAVHbfsx.rH8uMgXGGzjFzcftOTsBzOWVnx4S74TX45W', NULL, NULL, '0', 0, NULL, '16', NULL, NULL, NULL, 1, 'Administrator Role', '2019-08-20 01:54:40', '2019-08-20 01:54:40'),
(53, 3, '2019-08-23', '2019-08-23', 'Vivek Joshi', NULL, NULL, NULL, NULL, NULL, NULL, 3, NULL, NULL, '2', '2', '2', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'mailurs.vj@gamil.com', '$2y$10$IwYbkZUPcCmTOwVGjF6LR.OiIaA5QA2axpbuHhxql0wITfCyfF1ra', NULL, NULL, '0', 0, NULL, '17', NULL, NULL, NULL, 1, 'Administrator Role', '2019-08-20 01:57:01', '2019-08-20 01:57:01'),
(54, 3, '2019-08-23', '2019-08-23', 'Vanshaj Kathuria', 'Senior Executive Engineer', NULL, NULL, NULL, '2019-02-12', '1992-12-29', 3, NULL, '7827767042', '0', '1', '0', NULL, NULL, NULL, NULL, NULL, NULL, 'Vadodara', 'vanshajcivil@gmail.com', '$2y$10$y7.f1XKoneP2rWQEj7gpHe3HnM3oMJXDfUi/Y04vvxdcFF5pfnxZG', NULL, NULL, '0', 0, NULL, '15', NULL, NULL, NULL, 1, 'Administrator Role', '2019-08-20 02:00:34', '2019-08-22 01:44:21'),
(55, 3, '2019-08-23', '2019-08-23', 'Ajay Kumar Singh', 'dy.CPM-PS&TL/OHE', NULL, NULL, NULL, NULL, NULL, 3, NULL, '9607013111', '2', '2', '2', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'dycpmelec1.brc@nhsrcl.in', '$2y$10$6MbY9rdQAO6phPQ7/Cfg9eUJwXiImb6.5TDUdIKmIFLpR8DJwiv1q', NULL, NULL, '0', 0, NULL, '3', NULL, NULL, NULL, 1, 'Administrator Role', '2019-08-20 02:07:18', '2019-08-20 02:42:04'),
(56, 3, '2019-08-23', '2019-08-23', 'Ipsita Tikader', 'Doc. Controller', NULL, NULL, NULL, '2018-04-02', '1987-02-25', 3, NULL, '8279446034', '0', '1', '0', NULL, NULL, NULL, NULL, NULL, NULL, 'Vadodara', 'ipsitaiikader@gmail.com', '$2y$10$BPDNOWNqQVXLj8rLNZjRfu2hGGY2gjoFPLFlhQC9CV.z6edeHZrwe', NULL, NULL, '0', 0, NULL, '18', NULL, NULL, NULL, 1, 'Administrator Role', '2019-08-21 05:33:53', '2019-08-21 06:29:09'),
(57, 3, '2019-08-23', '2019-08-23', 'Nikhil Chandra', 'Doc. Controller', NULL, NULL, NULL, '2018-04-02', '1987-02-25', 3, NULL, '', '0', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL, 'Vadodara', 'nikhilchandra@gmail.com', '$2y$10$BPDNOWNqQVXLj8rLNZjRfu2hGGY2gjoFPLFlhQC9CV.z6edeHZrwe', NULL, NULL, '0', 0, NULL, '19', NULL, NULL, NULL, 1, 'Administrator Role', '2019-08-21 05:33:53', '2019-08-21 06:29:09'),
(58, 3, '2019-08-23', '2019-08-23', 'Jatin Sehghal', 'Sr. Executive', NULL, NULL, NULL, '2018-04-02', '1987-02-25', 3, NULL, '', '0', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL, 'Vadodara', 'jatinsehghal@gmail.com', '$2y$10$BPDNOWNqQVXLj8rLNZjRfu2hGGY2gjoFPLFlhQC9CV.z6edeHZrwe', NULL, NULL, '0', 0, NULL, '20', NULL, NULL, NULL, 1, 'Administrator Role', '2019-08-21 05:33:53', '2019-08-21 06:29:09'),
(59, 3, '2019-08-23', '2019-08-23', 'Anupam Awasti', 'Dy.CPM  (Civil)', NULL, NULL, NULL, '2018-04-02', '1987-02-25', 3, NULL, '', '0', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL, 'Vadodara', 'anupamawasti@gmail.com', '$2y$10$BPDNOWNqQVXLj8rLNZjRfu2hGGY2gjoFPLFlhQC9CV.z6edeHZrwe', NULL, NULL, '0', 0, NULL, '21', NULL, NULL, NULL, 1, 'Administrator Role', '2019-08-21 05:33:53', '2019-08-21 06:29:09'),
(60, 3, '2019-08-23', '2019-08-23', 'Anup Khare', 'Sr Manager (civil)', NULL, NULL, NULL, '2018-04-02', '1987-02-25', 3, NULL, '', '0', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL, 'Vadodara', 'anupkhare@gmail.com', '$2y$10$BPDNOWNqQVXLj8rLNZjRfu2hGGY2gjoFPLFlhQC9CV.z6edeHZrwe', NULL, NULL, '0', 0, NULL, '22', NULL, NULL, NULL, 1, 'Administrator Role', '2019-08-21 05:33:53', '2019-08-21 06:29:09'),
(61, 2, '2019-10-15', '2019-10-16', 'Hemal', NULL, NULL, NULL, NULL, NULL, NULL, 2, NULL, NULL, '2', '2', '2', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'hemalpandya92@gmail.com', '$2y$10$r2Zu0kkPyVqDFSM.a4c6Mu5.f.Fgbzaff90OJNOWa6kh/4h2Sy0MG', NULL, NULL, '0', 0, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2019-10-14 09:18:24', '2019-10-14 09:18:24'),
(62, 2, '2019-10-15', '2019-10-16', 'Hemal', 'AAA', NULL, NULL, NULL, '2019-10-08', '1992-10-16', 1, NULL, '24213424', '0', '0', '1', 'adas', 'dsadasd', NULL, '2019-10-08', '2019-10-15', 'adasd', 'Vaodd', 'hemal@yopmail.com', '$2y$10$9qZ/6yLvRglus394Ez7o4u7i1xXEaso.rO1X1VZ2avzjKDsNXRGYy', NULL, NULL, '0', 0, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2019-10-14 09:21:36', '2019-10-14 09:24:38'),
(63, 4, '2019-10-31', '2019-10-31', 'hemalpandya92@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, 2, NULL, NULL, '2', '2', '2', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'hemalpandya92@gmail.com', '$2y$10$6..tW4WorRg9zihM6TvXI.3mQ8rEa4XGDiEiw1LxqvcVeQkcTYKLS', NULL, NULL, '0', 0, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2019-10-30 07:39:42', '2019-10-30 07:39:42'),
(64, 5, '2019-11-15', '2019-11-17', 'Mayank', 'Initial Trainee', NULL, NULL, NULL, '2019-11-14', '2019-11-06', 1, NULL, '91888888888888', '0', '0', '0', 'Special request', 'Special Remark', 'Supervisory', NULL, NULL, NULL, 'Baroda Posting Station', 'mayankp@yopmail.com', '$2y$10$1Tb3ksougFCXpWm64fsuuerHg3jN9E1rKxFCh4PGbz8.c0h5AD.e.', NULL, NULL, '0', 0, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2019-11-13 08:08:56', '2019-11-13 08:13:06'),
(65, 5, '2019-11-15', '2019-11-17', 'Mrugesh', NULL, NULL, NULL, NULL, NULL, NULL, 0, '2019-11-17', NULL, '2', '2', '2', NULL, NULL, 'No Supervisory', NULL, NULL, NULL, NULL, 'mrugesh@yopmail.com', '$2y$10$vCySc6N1LmlWgoOlqm8IS.KxcWYqxI7gJTwe8MAh6eLkJwPr/6AjK', NULL, NULL, '0', 0, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2019-11-13 08:09:16', '2019-11-13 08:11:39'),
(66, 5, '2019-11-15', '2019-11-17', 'Shivom', 'Trainee Designation', NULL, NULL, NULL, '2019-11-15', '2019-11-06', 1, NULL, '919898989898', '1', '0', '1', 'Special request to do some allotment of hostel', 'Need some external food', 'Executive and above', '2019-11-13', '2019-11-18', 'By Train', 'Vadodara Posting Station', 'shivom@yopmail.com', '$2y$10$VNRBdFwsKQ9sYF6Pkl5Bq.Pf8x1k/FJ8EsX5uOsSaKIR07RpLsrKS', NULL, NULL, '0', 0, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2019-11-13 08:09:37', '2019-11-13 08:11:16'),
(67, 6, '2019-11-28', '2019-11-30', 'Mayank', 'For Initial Training', NULL, NULL, NULL, '2019-11-29', '2019-11-14', 1, NULL, '918989898989', '1', '0', '0', 'Special request description', 'Remark Description', 'Supervisory', NULL, NULL, NULL, 'Vadodara Posting Station', 'mayankp@yopmail.com', '$2y$10$kDwxlBDr.xh7EGIT2r2FiewyxSa33U0Dprl1XNgWK69oa.O0BbWMq', NULL, NULL, '0', 0, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2019-11-13 08:55:17', '2019-11-13 08:58:50'),
(68, 6, '2019-11-28', '2019-11-30', 'Mrugesh', 'digiflux', NULL, NULL, NULL, '2019-11-14', '2019-11-01', 1, NULL, '917878787878', '1', '1', '0', 'fsdfsdfsfss fd sdfs f', 'sdfsdfsdfdsfsdsf ssdf sdfdsfsdf', 'Executive and above', NULL, NULL, NULL, 'Ahmedabad Posting Station', 'mrugesh@yopmail.com', '$2y$10$heQL3qeFDymF/kjZm8338uZrdwi8rddFhk4E3jbrcRj6ZjYHiXSdS', NULL, NULL, '0', 0, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2019-11-13 08:55:34', '2019-11-13 09:00:35'),
(69, 5, '2019-11-15', '2019-11-17', 'Hemal', NULL, NULL, NULL, NULL, NULL, NULL, 2, NULL, NULL, '2', '2', '2', NULL, NULL, 'Supervisory', NULL, NULL, NULL, NULL, 'hemal@yopmail.com', '$2y$10$37Uw0YQ2iUHjeaGCJV1xZ.17PD/yeYaPPobDEPdOK6cHgw8pUHVGK', NULL, NULL, '0', 0, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2019-11-13 09:04:47', '2019-11-13 09:04:47'),
(70, 6, '2019-11-15', '2019-11-17', 'Hemal', NULL, NULL, NULL, NULL, NULL, NULL, 2, NULL, NULL, '2', '2', '2', NULL, NULL, 'Executive and above', NULL, NULL, NULL, NULL, 'hemal@digiflux.io', '$2y$10$TxXMYItWmy2jpNPyGLahgOBlRLa7ovZIKa0lxcNcsEWoYlwNOjqyS', NULL, NULL, '0', 0, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2019-11-13 09:05:46', '2019-11-13 09:05:46'),
(71, 5, '2019-11-15', '2019-11-17', 'Maulika', 'Senior Training Session', NULL, NULL, NULL, '2019-11-29', '2019-11-01', 1, NULL, '918989898989', '1', '1', '1', 'Special request description', 'Remark description done', 'No Supervisory', '2019-11-26', '2019-11-30', 'By Train', 'Manjalpur Vadodara', 'maulika@yopmail.com', '$2y$10$g7ZRGDLWv04/pa553GOw.O.0HJwkuw2cCcGgQ.bBqs174oiXWtiM6', NULL, NULL, '0', 0, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2019-11-13 09:07:15', '2019-11-13 09:09:25'),
(72, 6, '2019-11-28', '2019-11-30', 'Maulika', NULL, NULL, NULL, NULL, NULL, NULL, 0, '2019-11-14', NULL, '2', '2', '2', NULL, NULL, 'Executive and above', NULL, NULL, NULL, NULL, 'maulika@yopmail.com', '$2y$10$K2T.We3kFb5L3CSL4Sa1N.J/NHXpLSxKR/0kydHWO.b0LnWfwoI/G', NULL, NULL, '0', 0, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2019-11-13 09:07:30', '2019-11-13 09:08:10');

-- --------------------------------------------------------

--
-- Table structure for table `trainee_activities`
--

CREATE TABLE `trainee_activities` (
  `trainee_activity_id` int(10) UNSIGNED NOT NULL,
  `item_id` int(11) DEFAULT NULL,
  `action` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `session_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `designation` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `joining_date` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `birth_date` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `preferred_date` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `contact_number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `attendence_confirm` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `hostel_accomodations` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `requested_meal` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `transport_request` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `special_request` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remarks` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `posting_station` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `total` int(11) NOT NULL DEFAULT 0,
  `created_by` int(11) NOT NULL DEFAULT 0,
  `created_user` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `trainee_activities`
--

INSERT INTO `trainee_activities` (`trainee_activity_id`, `item_id`, `action`, `name`, `session_id`, `designation`, `joining_date`, `birth_date`, `preferred_date`, `contact_number`, `attendence_confirm`, `hostel_accomodations`, `requested_meal`, `transport_request`, `special_request`, `remarks`, `posting_station`, `email`, `password`, `status`, `total`, `created_by`, `created_user`, `created_at`, `updated_at`) VALUES
(1, NULL, 'Added', 'VINAY KUMAR', '1', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'vinay2abb@gmail.com', '$2y$10$cn0yxBZ9DKhOh/GCjsp8FOaD4fxGU6tqyVY3/U5eVwmjzHLk6uPUi', NULL, 0, 6, NULL, '2019-07-22 01:29:28', '2019-07-22 01:29:28'),
(2, NULL, 'Updated', 'VINAY KUMAR', '1', 'AE', '2019-07-03', '2007-01-31', NULL, '8516897975', '1', '0', '1', '0', NULL, NULL, 'brc', 'vinay2abb@gmail.com', '$2y$10$DdATzOHsoq9bveJL1Zt2TewwjjXZmg.FYpgXGDHsiIh1alPKATLnO', NULL, 0, 7, NULL, '2019-07-22 01:42:44', '2019-07-22 01:42:44'),
(3, NULL, 'Added', 'hemal', '1', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'hemal@digiflux.io', '$2y$10$9dE/dcUeix8m9fd/Tz3dzu6FhpCGKW77tVHfib07Lkas9Wrt6FWQC', NULL, 0, 6, NULL, '2019-07-22 04:11:38', '2019-07-22 04:11:38'),
(4, NULL, 'Added', 'a da', '1', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'hemal@digiflux.io', '$2y$10$gWRfJew0OYWuKmDVqs9U/.znS.OcK/Whx56i5Zjaa5rZ7Cm5BxO2G', NULL, 0, 6, NULL, '2019-07-22 04:28:20', '2019-07-22 04:28:20'),
(5, NULL, 'Added', 'Shri. Keshav Moondra', '1', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'apmcivadi1@nhsrcl.in', '$2y$10$bINAUIISaxIj8REnb6SugekXn0g9LGr1AA4awPxqvs5nEQlmzugOW', NULL, 0, 6, NULL, '2019-07-23 06:49:23', '2019-07-23 06:49:23'),
(6, NULL, 'Added', 'Mr Rachit Jain', '1', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'mgrcivmum2@nhsrcl.in', '$2y$10$iuTo/k/PPLbdVKQ.qOM/8uREkVvhj6nDppQ9VkjX6a79vAcgI8Gta', NULL, 0, 6, NULL, '2019-07-23 06:51:58', '2019-07-23 06:51:58'),
(7, NULL, 'Added', 'Kumar Deepak Shrivastava', '1', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'mgrciv1st@nhsrcl.in', '$2y$10$I/jcOwHW3sDgUG/J4jiKyeAC7v6boFeoO6LImqt7zt4yxh0Iz90X2', NULL, 0, 6, NULL, '2019-07-23 06:53:47', '2019-07-23 06:53:47'),
(8, NULL, 'Added', 'SH. KRISHAN SINGH', '1', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'mgrcivmum4@nhsrcl.in', '$2y$10$x9k3dslHhsQ8sEg3TW.q..L3nZjA5OrnlyurZRi7HAG0aJMPGdfFS', NULL, 0, 6, NULL, '2019-07-23 06:55:37', '2019-07-23 06:55:37'),
(9, NULL, 'Added', 'BrajKishor Sharma', '1', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'srmgrciv1.adi@nhsrcl.in', '$2y$10$U7qgThfhEcMVr1Jjt.Rjk.aD0zKGAFHOH4WbbpToi71p3EcjGpmSy', NULL, 0, 6, NULL, '2019-07-23 07:02:03', '2019-07-23 07:02:03'),
(10, NULL, 'Added', 'Mr. Ankush Dogra', '1', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'mgrcivilnhsrcl@gmail.com', '$2y$10$Fv6qc4VGfvPz5CEDhq9NAeUXsI7/lc9nifCBAAnWQk6uXPuI/ali2', NULL, 0, 6, NULL, '2019-07-23 07:03:37', '2019-07-23 07:03:37'),
(11, NULL, 'Added', 'Md. Akram Khan', '1', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'mgrciv3.st@nhsrcl.in', '$2y$10$gJoApDPdYdSwsQ4j/y7hyOy5grmPdCWvpuOeGK08PcrPmrWNI30zS', NULL, 0, 6, NULL, '2019-07-23 07:04:49', '2019-07-23 07:04:49'),
(12, NULL, 'Updated', 'Kumar Deepak Shrivastava', '1', 'Manager', '2018-05-02', '1987-10-25', NULL, '7227909594', '1', '0', '1', '0', NULL, NULL, 'Surat', 'mgrciv1st@nhsrcl.in', '$2y$10$q1uxryJhVVOuVoKE8dow8O1p6XmMkZX/uzqm5bHhdCOoorwAodGny', NULL, 0, 11, NULL, '2019-07-23 07:10:25', '2019-07-23 07:10:25'),
(13, NULL, 'Updated', 'Kumar Deepak Shrivastava', '1', 'Manager', '2018-05-02', '1987-10-25', NULL, '7227909594', '1', '0', '1', '0', NULL, NULL, 'Surat', 'mgrciv1st@nhsrcl.in', '$2y$10$9i99tD9HUKVQ5Q52qkmgnOo71MLPnujSjkrecguzUETYOnq8RdHwy', NULL, 0, 11, NULL, '2019-07-23 07:12:48', '2019-07-23 07:12:48'),
(14, NULL, 'Added', 'Mr. Mudit Rediwal', '1', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'rediwal.mudit43@gmail.com', '$2y$10$N8Y7mWzDkV0XGj4Y3aIz5.SfV6KHMqffDd6q/Z4C2FC19yL4ZdSJu', NULL, 0, 6, NULL, '2019-07-23 07:13:30', '2019-07-23 07:13:30'),
(15, NULL, 'Updated', 'Kumar Deepak Shrivastava', '1', 'Manager', '2018-05-02', '1987-10-25', NULL, '7227909594', '1', '0', '1', '0', NULL, NULL, 'Surat', 'mgrciv1st@nhsrcl.in', '$2y$10$DBfSr13DEALj.jbpLhwvNekLy3jKOBemQUGBOYmfB3AjA/dBAfTYO', NULL, 0, 11, NULL, '2019-07-23 07:16:50', '2019-07-23 07:16:50'),
(16, NULL, 'Updated', 'Mr. Mudit Rediwal', '1', 'Sr. Executive Engineer (Civil)', '2017-11-15', '1993-11-17', NULL, '8233576323', '1', '2', '1', '1', NULL, NULL, 'Vadodara', 'rediwal.mudit43@gmail.com', '$2y$10$dNLoXHqYwqgXMaFrAXFi6.8zaG.mqGfUycd/Wr6636p/XrABJhsqC', NULL, 0, 16, NULL, '2019-07-23 07:27:58', '2019-07-23 07:27:58'),
(17, NULL, 'Updated', 'Mr. Mudit Rediwal', '1', 'Sr. Executive Engineer (Civil)', '2017-11-15', '1993-11-17', NULL, '8233576323', '1', '2', '1', '1', NULL, NULL, 'Vadodara', 'rediwal.mudit43@gmail.com', '$2y$10$AiPtdg0PdaLp4/3J0s9JRO7hSlgNE1vLgs.AGlQSPfwIT8ZOniYt.', NULL, 0, 16, NULL, '2019-07-23 07:29:18', '2019-07-23 07:29:18'),
(18, NULL, 'Added', 'test', '1', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'hemal@digiflux.io', '$2y$10$H/yDYTas84/0sflc0rQVF.SMSXHfVvqhpLkpr3Bu8PUgxDtaAdIem', NULL, 0, 6, NULL, '2019-07-24 04:43:32', '2019-07-24 04:43:32'),
(19, NULL, 'Added', 'hemal', '1', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'hemal@digiflux.io', '$2y$10$Z.31k63YgdJrKgm.7igRTuWAxaByjOrKUIL30G1qK2vXiM6vKCgUS', NULL, 0, 6, NULL, '2019-07-24 05:27:28', '2019-07-24 05:27:28'),
(20, NULL, 'Added', 'Hemal', '1', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'info@digiflux.io', '$2y$10$jJGA.oHrUecrPFy8RYmkeuCz8wj9CcZJQTrmkOzbc3PqOn84uPDgq', NULL, 0, 6, NULL, '2019-07-24 06:15:28', '2019-07-24 06:15:28'),
(21, NULL, 'Updated', 'Hemal', '1', 'Sr. Manager', '2019-07-10', '1998-02-11', NULL, '8989898989', '1', '1', '2', '0', NULL, NULL, NULL, 'info@digiflux.io', '$2y$10$ox4XjdaFEEWimI/oq/daWOytXhr/pG4e83r9eQ7YbMv58vt.9UkwG', NULL, 0, 20, NULL, '2019-07-24 06:17:54', '2019-07-24 06:17:54'),
(22, NULL, 'Updated', 'Hemal', '1', 'Sr. Manager', '2019-07-10', '1998-02-11', NULL, '8989898989', '1', '1', '2', '0', NULL, NULL, NULL, 'info@digiflux.io', '$2y$10$TeCM9QXXicxcxuKCDc8J5eQlqAKHFXtnNDuvYMCRwGFwC/F.NBjWi', NULL, 0, 20, NULL, '2019-07-24 07:03:09', '2019-07-24 07:03:09'),
(23, NULL, 'Added', 'Hemal', '1', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'hemal@digiflux.io', '$2y$10$VMQ4VsRvzYH5UbElbqMygupszIeh8SXRqKdAr.jynQ60Ah0sZvkEC', NULL, 0, 6, NULL, '2019-07-24 08:09:04', '2019-07-24 08:09:04'),
(24, NULL, 'Added', 'Hemal', '1', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'hemal@digiflux.io', '$2y$10$3nishUD9H1u02vhzzs.s9O.VuEs9QvMk8g9lmG6fdatCpQHmTUP/2', NULL, 0, 6, NULL, '2019-07-24 08:20:29', '2019-07-24 08:20:29'),
(25, NULL, 'Updated', 'Hemal', '1', 'hemalmasldm', NULL, NULL, NULL, '9797979797', '1', '2', '2', '2', NULL, NULL, NULL, 'hemal@digiflux.io', '$2y$10$Lx3TSexn978QVjbX0BMV2eeARmi/sn3ZTyLRP6kXEpkkFVHrptY/O', NULL, 0, 8, NULL, '2019-07-24 08:22:02', '2019-07-24 08:22:02'),
(26, NULL, 'Updated', 'Hemal', '1', 'hemalmasldm', NULL, NULL, NULL, '9797979797', '1', '1', '1', '1', NULL, NULL, NULL, 'hemal@digiflux.io', '$2y$10$VM3ZNjuxtKsINkRDZKbdhubwzL3XTSUuPpGmpxvi4beMFUyvITYLO', NULL, 0, 8, NULL, '2019-07-24 08:22:51', '2019-07-24 08:22:51'),
(27, NULL, 'Added', 'Hemal', '1', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'hemal@digiflux.io', '$2y$10$7gWhNPI4BFqCnA3EQKPe5.QQ3aWa3iO69MDSywdP/1uGS9QhUStZq', NULL, 0, 6, NULL, '2019-07-24 08:23:34', '2019-07-24 08:23:34'),
(28, NULL, 'Added', 'Hemal', '1', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'hemal@digiflux.io', '$2y$10$1bkx05e.8it4pJTFHxUnDud/KKMISUyxGiHQoYT1uICpsvsGPs0nK', NULL, 0, 6, NULL, '2019-07-24 08:25:25', '2019-07-24 08:25:25'),
(29, NULL, 'Updated', 'Hemal', '1', 'asdasd', NULL, NULL, NULL, '31231231', '1', '1', '1', '1', NULL, NULL, NULL, 'hemal@digiflux.io', '$2y$10$RVG0/2wlZx.xBsVUjHzhuedudMn8Jytz3iT6996roEhnECJj2hCYq', NULL, 0, 8, NULL, '2019-07-24 08:36:05', '2019-07-24 08:36:05'),
(30, NULL, 'Added', 'hemal', '1', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'hemal@digiflux.io', '$2y$10$0p1ymjNMqXkG23Hi1oXYb.c64gRrDMV6UgaTe30Aj5YguB9Eu/SG2', NULL, 0, 6, NULL, '2019-07-24 08:45:19', '2019-07-24 08:45:19'),
(31, NULL, 'Updated', 'hemal', '1', 'asdasd', NULL, NULL, NULL, '123123', '1', '2', '1', '1', NULL, NULL, NULL, 'hemal@digiflux.io', '$2y$10$ru16eEDUo5OJFbjy7WmaiOmsBsdBB4owbP9D9Arikufmn.7C4wj42', NULL, 0, 8, NULL, '2019-07-24 08:46:51', '2019-07-24 08:46:51'),
(32, NULL, 'Added', 'Hemal', '1', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'hemal@digiflux.io', '$2y$10$pYG6XaioIUO2MjiRw50PSeaDZsdDUxklg/p7wfK7FwBFHM67x/KU6', NULL, 0, 6, NULL, '2019-07-26 01:08:21', '2019-07-26 01:08:21'),
(33, NULL, 'Added', 'test', '1', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'mayankp@yopmail.com', '$2y$10$dMhIJD5ePvumSdHL3tDeNeqwuNa0mLIrNHmP6DTlkOFXgXnXTA.OW', NULL, 0, 6, NULL, '2019-07-26 01:48:42', '2019-07-26 01:48:42'),
(34, NULL, 'Added', 'Raghvendra Pratap Singh', '2', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'pmciv1mum@nhsrcl.in', '$2y$10$1zkADvT/EkshcGELz01izOGBYFrdTJpnIMSqGsnnRSz6PpYuD9Elu', NULL, 0, 6, NULL, '2019-08-08 03:19:01', '2019-08-08 03:19:01'),
(35, NULL, 'Added', 'Anand Singh Charan', '2', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'mgrciviladi@nhsrcl.in', '$2y$10$fm/zzblrrzWVStlgj5nBbeb7DP8QkESqduwb5bNDAHDeM4cj.K6YS', NULL, 0, 6, NULL, '2019-08-08 03:20:20', '2019-08-08 03:20:20'),
(36, NULL, 'Added', 'Sanam Soni', '2', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'sanamsoni91@gmail.com', '$2y$10$SDVMEeIznRhDQ0OwoztB0.rZsHHK8LYMnRKWarsUqbk8XUcnK75am', NULL, 0, 6, NULL, '2019-08-08 03:24:49', '2019-08-08 03:24:49'),
(37, NULL, 'Added', 'ARUN NAYAK', '2', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'mgrcivmum1@nhsrcl.in', '$2y$10$uNzYAZPkPTH5oqVhxuL4G.0ICTCX5R2OvEq/d3q89nJJj2gRo26kC', NULL, 0, 6, NULL, '2019-08-08 03:26:02', '2019-08-08 03:26:02'),
(38, NULL, 'Added', 'Manjunatha G', '2', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'mgrcivilbrc1@nhsrcl.in', '$2y$10$IftoKlOv29sykljL05qovuvIRiEwv4lsiEYHYpIsojqyUR0GYVvQK', NULL, 0, 6, NULL, '2019-08-08 03:28:27', '2019-08-08 03:28:27'),
(39, NULL, 'Added', 'Mr. Gaurav Srivastava', '2', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'mgrbrc.nhsrcl@gmail.com', '$2y$10$D4sCE1lSzcVkaHm4f2aUZ.t.v8dI72YD6eMkk7t35JjcBZjDfgATG', NULL, 0, 6, NULL, '2019-08-08 03:28:53', '2019-08-08 03:28:53'),
(40, NULL, 'Added', 'himang Jain', '2', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'mgrcivmum3@nhsrcl.in', '$2y$10$7MSv7SMw/0YKwUWkV.2RheKAuhZ5t6czfDyke6DxDuDaiLdraM5Di', NULL, 0, 6, NULL, '2019-08-08 03:31:02', '2019-08-08 03:31:02'),
(41, NULL, 'Added', 'Anuj Kumar verma', '2', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'dycpmciv1.vapi@nhsrcl.in', '$2y$10$QDOn7G7.xVuVaGeEyTXjC.opu0ZhLnKxraVSSMG3ww38/T8Th.8em', NULL, 0, 6, NULL, '2019-08-08 03:35:07', '2019-08-08 03:35:07'),
(42, NULL, 'Added', 'Deepak Kulshrestha', '2', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'dmrc.ngn@gmail.com', '$2y$10$pUMfhwpw8Lnz5dYc0OF5RuariglQQfjl/oh54TarO3VlSC8ovoYXm', NULL, 0, 6, NULL, '2019-08-08 03:38:29', '2019-08-08 03:38:29'),
(43, NULL, 'Added', 'Rahul Mishra', '2', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'mishra.kant@gmail.com', '$2y$10$NbRPEmkdDYyHWvdoQbWCtO3lSyBcKsYiQPqg.CO00ybv1GxhR1DOi', NULL, 0, 6, NULL, '2019-08-08 03:43:01', '2019-08-08 03:43:01'),
(44, NULL, 'Added', 'Ketan Katariya', '2', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'nhsrclciviladi@gmail.com', '$2y$10$0QxjoViCK/987V/ZWUS7g.EV6W1gLQa3XgcdZ5jIQAOQ.RoHcCCwm', NULL, 0, 6, NULL, '2019-08-08 03:47:01', '2019-08-08 03:47:01'),
(45, NULL, 'Added', 'Mr. Dipak Garge', '2', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'dgoffice92@gmail.com', '$2y$10$58rQpzCquGiKvAD27Ysf3eHOK5RnWsIJX51HM43C2hfNbY9jgQ4pW', NULL, 0, 6, NULL, '2019-08-08 03:49:38', '2019-08-08 03:49:38'),
(46, NULL, 'Added', 'Vineet Rajkumar', '2', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'vineetrajkumar969@gmail.com', '$2y$10$S3WTJlowGvleGqyHzldP9OxlEdSOCCwd.s4ooLyml07JRhPQtsJeW', NULL, 0, 6, NULL, '2019-08-08 03:50:54', '2019-08-08 03:50:54'),
(47, NULL, 'Updated', 'Ketan Katariya', '2', NULL, NULL, NULL, NULL, NULL, '0', '2', '2', '2', NULL, NULL, NULL, 'nhsrclciviladi@gmail.com', '$2y$10$/8PYTHF10Ur/oAHbqwWzBO..gLX/Jhw6jMvpxhirvFypg0h3NJn.O', NULL, 0, 32, NULL, '2019-08-08 03:50:57', '2019-08-08 03:50:57'),
(48, NULL, 'Updated', 'Ketan Katariya', '2', NULL, NULL, NULL, NULL, NULL, '0', '2', '2', '2', NULL, NULL, NULL, 'nhsrclciviladi@gmail.com', '$2y$10$F38FgEg7wkky3aIlkI5Xd.HGeC1uiy3ksL/0.pJsGMWy3I/.PP8ae', NULL, 0, 32, NULL, '2019-08-08 03:51:15', '2019-08-08 03:51:15'),
(49, NULL, 'Updated', 'Deepak Kulshrestha', '2', 'Dy CPM (Civil)', NULL, NULL, NULL, '9619138687', '1', '2', '2', '2', NULL, NULL, NULL, 'dmrc.ngn@gmail.com', '$2y$10$/YiY5FWeUJtHjKUvINeeFO/kiaMy.h70EJpwELfF2vgciQ7r8UKj.', NULL, 0, 30, NULL, '2019-08-08 03:51:51', '2019-08-08 03:51:51'),
(50, NULL, 'Added', 'RUPESH BONDRE', '2', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'rupeshbondre624@gmail.com', '$2y$10$WSHIjVx5hXAawZgTKDJrpeWdgvdh/AymhpeVJADu8PVquvdEYgOqO', NULL, 0, 6, NULL, '2019-08-08 03:54:19', '2019-08-08 03:54:19'),
(51, NULL, 'Updated', 'Vineet Rajkumar', '2', 'DEO', '2018-06-01', '1995-03-05', NULL, '9724014152', '1', '0', '1', '0', NULL, NULL, 'Vadodara', 'vineetrajkumar969@gmail.com', '$2y$10$hVdOtZiktH4sLIuDm2NQS.nA6e7ako8PmmPpOT5GIPKpWxcRFpV9G', NULL, 0, 34, NULL, '2019-08-08 04:00:53', '2019-08-08 04:00:53'),
(52, NULL, 'Updated', 'RUPESH BONDRE', '2', 'Executive civil', '2019-08-09', '1991-02-06', NULL, '9630163184', '1', '1', '1', '1', NULL, NULL, 'Mumbai', 'rupeshbondre624@gmail.com', '$2y$10$e9iQDto5slJ0uNssaqntN.lW1sp8ww83b57pYDxweMH3mE2ErTKyG', NULL, 0, 35, NULL, '2019-08-08 05:39:53', '2019-08-08 05:39:53'),
(53, NULL, 'Added', 'Testin', '2', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'hemal@digiflux.io', '$2y$10$7ja/GC2fh8V0nlueATSb1ehomQanDobypP2A5X3HEfyDCp23eoYce', NULL, 0, 6, NULL, '2019-08-08 08:18:05', '2019-08-08 08:18:05'),
(54, NULL, 'Updated', 'Testin', '2', 'Consultant', NULL, NULL, NULL, '989898988', '1', '2', '1', '2', NULL, NULL, NULL, 'hemal@digiflux.io', '$2y$10$DQ9KFAZCsXUxJH4732Dj5uBc2AbuWPzwJjXdbPC/4UeZE.wMDSjf6', NULL, 0, 8, NULL, '2019-08-08 08:19:19', '2019-08-08 08:19:19'),
(55, NULL, 'Updated', 'Rahul Mishra', '2', 'Manager/ Track', NULL, '1986-03-25', NULL, '7228939532', '1', '0', '1', '0', NULL, NULL, 'Vapi', 'mishra.kant@gmail.com', '$2y$10$LxKPM8D/yV7r8D2CDa/CkuHq8H.qnv77T.FiQA0KQg5qyCXw3iy9C', NULL, 0, 31, NULL, '2019-08-08 08:33:09', '2019-08-08 08:33:09'),
(56, NULL, 'Updated', 'himang Jain', '2', 'Manager civil', '2018-06-08', '1990-11-09', NULL, '9004485016', '1', '0', '1', '1', NULL, NULL, 'Mumbai', 'mgrcivmum3@nhsrcl.in', '$2y$10$yH.8dV2OlwhX7zR.hJqW4..8urHFSZRGVW4h/2XLnTpkNioYnOK/.', NULL, 0, 28, NULL, '2019-08-08 19:27:07', '2019-08-08 19:27:07'),
(57, NULL, 'Added', 'Gaurav Saraswat', '3', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'srmgrmech1adi@nhsrcl.in', '$2y$10$d5DgupLtPZDG9TxwnrD25OClQAfEh07xQR/4/.3AiiYAehDYl4n6a', NULL, 0, 6, NULL, '2019-08-20 01:19:08', '2019-08-20 01:19:08'),
(58, NULL, 'Added', 'Kingshuk Sarkar', '3', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'dycpmelec1.adi@nhsrcl.in', '$2y$10$5Kq6fkZWba1dKAB2Ya5opeeQTz0EP3OEuVB41prM9YFXQZ1JhxyT6', NULL, 0, 6, NULL, '2019-08-20 01:20:36', '2019-08-20 01:20:36'),
(59, NULL, 'Added', 'Braj Kishor Sharma', '3', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'srmciv1.adi@nhsrcl.in', '$2y$10$TakWoRL8D8eulRyRzNR7CehKp8pAXldJY5KTDmotWBVTrsG8gEioy', NULL, 0, 6, NULL, '2019-08-20 01:21:29', '2019-08-20 01:21:29'),
(60, NULL, 'Added', 'S Bhaskaran', '3', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'bhaskarswr@gmail.com', '$2y$10$btcTLpx4KM30gJ9oG7VnMe6QX0F8RjCI3ONBBb0dBVG3WQpF.Qfne', NULL, 0, 6, NULL, '2019-08-20 01:23:31', '2019-08-20 01:23:31'),
(61, NULL, 'Added', 'Santosh Kr Patil', '3', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'srmgrelec1mum@nhsrcl.in', '$2y$10$pEHTeOH1HxsrnCVQhU4uMOhG.gCgfK8dm872sFYmEl8aN1nlwPfCu', NULL, 0, 6, NULL, '2019-08-20 01:30:08', '2019-08-20 01:30:08'),
(62, NULL, 'Added', 'RACHIT JAIN', '3', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'mgrcivmum2@nhsrcl.in', '$2y$10$nX2nk4qqz064xclTEqUpoebYy412btpA0teLWj1GyssAP8MLzp/ia', NULL, 0, 6, NULL, '2019-08-20 01:31:06', '2019-08-20 01:31:06'),
(63, NULL, 'Added', 'Shyamal Biswas', '3', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'dycpmsnt.st@nhsrcl.in', '$2y$10$FeuCauTm/BpnvHPkeJWOI.iwEJvUyOumwQ//ZBMSWB7CsDM/sDLPq', NULL, 0, 6, NULL, '2019-08-20 01:31:58', '2019-08-20 01:31:58'),
(64, NULL, 'Added', 'KRISHAN SINGH', '3', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'mgrcivmum4@nhsrcl.in', '$2y$10$gNn35kvFi516fh9i0V9Ee.daw0ta4i2KJbqTNN2UnVHAg0L0PeDxG', NULL, 0, 6, NULL, '2019-08-20 01:33:22', '2019-08-20 01:33:22'),
(65, NULL, 'Added', 'Himang Jain', '3', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'mgrcivmum3@nhsrcl.in', '$2y$10$GkceFmo2hf/TMia/ytgwaOedXDVdlSarr6SIGtBGCg9yXa0wCTwk.', NULL, 0, 6, NULL, '2019-08-20 01:34:21', '2019-08-20 01:34:21'),
(66, NULL, 'Added', 'Deepinder Pal Singh', '3', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'dycpmelect1.st@nhsrcl.in', '$2y$10$s2br/GBTjyF5kuBDUR34reyLP63fOWw6CWm4zgWy7G5ROOvJK98ny', NULL, 0, 6, NULL, '2019-08-20 01:35:10', '2019-08-20 01:35:10'),
(67, NULL, 'Added', 'Mr. Ankush Dogra', '3', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'mgrcivilnhsrcl@gmail.com', '$2y$10$lDanoIZFAZJGPlkKlWYRz.q1HUVnTeAGoII3Bpebqt8s/MqWhHRz2', NULL, 0, 6, NULL, '2019-08-20 01:35:49', '2019-08-20 01:35:49'),
(68, NULL, 'Added', 'Trichanshu Kumar', '3', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'mgrciv2.st@nhsrcl.in', '$2y$10$WqqCnWA5zi4qzd85pN.zFer4EKlbmj7mXpTppoa.wMIHZOrBDFek6', NULL, 0, 6, NULL, '2019-08-20 01:36:33', '2019-08-20 01:36:33'),
(69, NULL, 'Added', 'Mr. Balwant Kumar', '3', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'balwant_cd@yahoo.com', '$2y$10$sVVi5bK8I4HepCQ30z99z.sszR4xyYKnlVr3vJSG0f/JCJj.hA6P.', NULL, 0, 6, NULL, '2019-08-20 01:37:19', '2019-08-20 01:37:19'),
(70, NULL, 'Added', 'Govindu Sivasankar', '3', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'srmgrrs2@nhsrcl.in', '$2y$10$z1zdzzrwE/gUsb8FCfuUwuOrwS0QGV1yXF5GR2029T2Crwubj1qaK', NULL, 0, 6, NULL, '2019-08-20 01:40:02', '2019-08-20 01:40:02'),
(71, NULL, 'Added', 'V S V Srinivas', '3', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'mgrelec2dli@nhsrcl.in', '$2y$10$dFqwdACoCPMl5kcDw.PYV.WqO/2sSyIkR2j.zmD5Lba1xRQlZ7LAK', NULL, 0, 6, NULL, '2019-08-20 01:41:19', '2019-08-20 01:41:19'),
(72, NULL, 'Added', 'Rahul Pathak', '3', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'rahulpathaknhsrcl@gamil.com', '$2y$10$yxT.BQB4enAVHbfsx.rH8uMgXGGzjFzcftOTsBzOWVnx4S74TX45W', NULL, 0, 6, NULL, '2019-08-20 01:54:41', '2019-08-20 01:54:41'),
(73, NULL, 'Added', 'Mr. Vivek Joshi', '3', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'mailurs.vj@gamil.com', '$2y$10$IwYbkZUPcCmTOwVGjF6LR.OiIaA5QA2axpbuHhxql0wITfCyfF1ra', NULL, 0, 6, NULL, '2019-08-20 01:57:01', '2019-08-20 01:57:01'),
(74, NULL, 'Added', 'Vansaj Kathuria', '3', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'vanshajcivil@gmail.com', '$2y$10$njhJUeZITuu97ZIA.pfs5ewj8XBE6nvemdZ19JiwhEz3Ol89MV9HO', NULL, 0, 6, NULL, '2019-08-20 02:00:34', '2019-08-20 02:00:34'),
(75, NULL, 'Added', 'Mr. Ajay Kumar Singh', '3', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'dycpmelec1.brc@nhsrcl.in', '$2y$10$21QlI6xapsONZSG26HybTO68BoJWoC.WZjdKS6e9lqwDH07vqMngS', NULL, 0, 6, NULL, '2019-08-20 02:07:18', '2019-08-20 02:07:18'),
(76, NULL, 'Updated', 'Kingshuk Sarkar', '3', 'DGM (Systems)', '2018-04-02', '1978-02-12', NULL, '9818461494', '1', '0', '1', '0', NULL, NULL, 'Ahmedabad', 'dycpmelec1.adi@nhsrcl.in', '$2y$10$NUutR/axh4eLCCraByXD1e7PHtPfRgbYTClSfQICRnknHeEGDEpYi', NULL, 0, 37, NULL, '2019-08-20 02:28:15', '2019-08-20 02:28:15'),
(77, NULL, 'Updated', 'Gaurav Saraswat', '3', NULL, NULL, NULL, NULL, NULL, '0', '2', '2', '2', NULL, NULL, NULL, 'srmgrmech1adi@nhsrcl.in', '$2y$10$iVz2YtM9YRKpeX23cJGmdOdt9yXEuH/AuTEDZS7IIH3Zpu26bREMu', NULL, 0, 36, NULL, '2019-08-20 02:30:37', '2019-08-20 02:30:37'),
(78, NULL, 'Updated', 'Mr. Ajay Kumar Singh', '3', 'dy.CPM-PS&TL/OHE', NULL, NULL, NULL, '9607013111', '1', '2', '2', '2', NULL, NULL, NULL, 'dycpmelec1.brc@nhsrcl.in', '$2y$10$6MbY9rdQAO6phPQ7/Cfg9eUJwXiImb6.5TDUdIKmIFLpR8DJwiv1q', NULL, 0, 50, NULL, '2019-08-20 02:42:04', '2019-08-20 02:42:04'),
(79, NULL, 'Updated', 'Himang Jain', '3', 'Manager', '2018-06-08', '1990-11-09', NULL, '9004485016', '1', '0', '1', '1', 'Cab required from airport in morning and to ahmedabad in evening', NULL, 'Mumbai', 'mgrcivmum3@nhsrcl.in', '$2y$10$2cjOHSj8w.06ksfYkiS5EetlsCODSoY1Pk49tns7vF6ztYpd0ypLu', NULL, 0, 28, NULL, '2019-08-21 00:02:00', '2019-08-21 00:02:00'),
(80, NULL, 'Added', 'Mr. Vivek Joshi', '3', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'mailurs.vj@gmail.com', '$2y$10$r0Bnmz/s.njvDyPFJAw2yOaAKxv.p81c19LWDokE2rr0LXmllqbgm', NULL, 0, 6, NULL, '2019-08-21 05:33:53', '2019-08-21 05:33:53'),
(81, NULL, 'Updated', 'Mr. Vivek Joshi', '3', 'Doc. Controller', '2018-04-02', '1987-02-25', NULL, '8279446034', '1', '0', '1', '0', NULL, NULL, 'Vadodara', 'mailurs.vj@gmail.com', '$2y$10$BPDNOWNqQVXLj8rLNZjRfu2hGGY2gjoFPLFlhQC9CV.z6edeHZrwe', NULL, 0, 51, NULL, '2019-08-21 06:29:09', '2019-08-21 06:29:09'),
(82, NULL, 'Updated', 'Govindu Sivasankar', '3', 'Senior Manager/RS(Design)', '2019-03-15', '1991-07-07', NULL, '8826788004', '1', '0', '1', '1', NULL, NULL, 'New Delhi', 'srmgrrs2@nhsrcl.in', '$2y$10$rxT9IFPD9FzJrGPRV78tq.YnNAbdbT10pkN9B2b2wTIu1oRXLeE5e', NULL, 0, 45, NULL, '2019-08-21 07:37:59', '2019-08-21 07:37:59'),
(83, NULL, 'Updated', 'Santosh Kr Patil', '3', 'Senior Manager Electrical', '2018-01-15', NULL, NULL, '7506455889', '1', '1', '1', '1', 'provide vehicle for air port in morning and evening for railway station', NULL, 'Palghar', 'srmgrelec1mum@nhsrcl.in', '$2y$10$7NeAm6K9AOT5Xw5GyCffrOIQVR.qDRzFqezseA.VXzWTSF.kYvuly', NULL, 0, 40, NULL, '2019-08-21 09:15:37', '2019-08-21 09:15:37'),
(84, NULL, 'Updated', 'KRISHAN SINGH', '3', 'Manager (Civil)', '2018-05-02', '1986-04-15', NULL, '9816503163', '1', '2', '2', '1', 'Cab pickup from Vadodara airport and in evening drop to Ahmedabad airport.', NULL, 'Mumbai', 'mgrcivmum4@nhsrcl.in', '$2y$10$l7dEWHTrVZ8.P4PLdIK/y.0ZqNKWRMmd/a2XYrq4.UJP1rzI.yl6W', NULL, 0, 12, NULL, '2019-08-21 23:45:21', '2019-08-21 23:45:21'),
(85, NULL, 'Updated', 'KRISHAN SINGH', '3', 'Manager (Civil)', '2018-05-02', '1986-04-15', NULL, '9816503163', '1', '0', '2', '1', 'Cab pickup from Vadodara airport and in evening drop to Ahmedabad airport.', NULL, 'Mumbai', 'mgrcivmum4@nhsrcl.in', '$2y$10$YOOH0.DhXABz8VkHN.O27u6gkvFgF4wZp90iYTvRbFQEFSqxqajeO', NULL, 0, 12, NULL, '2019-08-21 23:46:06', '2019-08-21 23:46:06'),
(86, NULL, 'Updated', 'KRISHAN SINGH', '3', 'Manager (Civil)', '2018-05-02', '1986-04-15', NULL, '9816503163', '1', '0', '2', '1', 'Cab pickup from Vadodara airport and in evening drop to Ahmedabad airport.', NULL, 'Mumbai', 'mgrcivmum4@nhsrcl.in', '$2y$10$2axmkzSv4yK3GzDQydmGU.jrIaDOfSmRSwYG3Wu3.0y0GsWuEjWYG', NULL, 0, 12, NULL, '2019-08-21 23:47:22', '2019-08-21 23:47:22'),
(87, NULL, 'Updated', 'KRISHAN SINGH', '3', 'Manager (Civil)', '2018-05-02', '1986-04-15', NULL, '9816503163', '1', '0', '2', '1', 'Cab pickup from Vadodara airport at 7:30am and in evening drop to Ahmedabad airport.', NULL, 'Mumbai', 'mgrcivmum4@nhsrcl.in', '$2y$10$4dtLFHA44Pd5FNp76enMjuik56/WyrCBkgAaqbH69EdvEGp7gwAK2', NULL, 0, 12, NULL, '2019-08-21 23:47:54', '2019-08-21 23:47:54'),
(88, NULL, 'Updated', 'Vansaj Kathuria', '3', 'Senior Executive Engineer', '2019-02-12', '1992-12-29', NULL, '7827767042', '1', '0', '1', '0', NULL, NULL, 'Vadodara', 'vanshajcivil@gmail.com', '$2y$10$y7.f1XKoneP2rWQEj7gpHe3HnM3oMJXDfUi/Y04vvxdcFF5pfnxZG', NULL, 0, 49, NULL, '2019-08-22 01:44:21', '2019-08-22 01:44:21'),
(89, NULL, 'Updated', 'Brij Kishor Sharma', '3', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'srmciv1.adi@nhsrcl.in', '$2y$10$7Il.264rk7yuFDoWO4qppuXAhN6R42lJog9z14lvP2m3IIykCo1aO', NULL, 0, 6, NULL, '2019-08-22 06:21:00', '2019-08-22 06:21:00'),
(90, NULL, 'Added', 'Hemal', '2', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'hemalpandya92@gmail.com', '$2y$10$r2Zu0kkPyVqDFSM.a4c6Mu5.f.Fgbzaff90OJNOWa6kh/4h2Sy0MG', NULL, 0, 1, NULL, '2019-10-14 09:18:25', '2019-10-14 09:18:25'),
(91, NULL, 'Added', 'Hemal', '2', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'hemal@yopmail.com', '$2y$10$j23l9Sv4/HQps8T4tR1YGeL.73NnI27PSxTTltn5LIhM/Eygcr8TK', NULL, 0, 1, NULL, '2019-10-14 09:21:36', '2019-10-14 09:21:36'),
(92, NULL, 'Added', 'hemalpandya92@gmail.com', '4', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'hemalpandya92@gmail.com', '$2y$10$6..tW4WorRg9zihM6TvXI.3mQ8rEa4XGDiEiw1LxqvcVeQkcTYKLS', NULL, 0, 1, NULL, '2019-10-30 07:39:43', '2019-10-30 07:39:43'),
(93, NULL, 'Updated', 'Shivom', '5', 'Trainee Designation', '2019-11-15', '2019-11-06', NULL, '919898989898', '1', '1', '0', '1', 'Special request to do some allotment of hostel', 'Need some external food', 'Vadodara Posting Station', 'shivom@yopmail.com', '$2y$10$VNRBdFwsKQ9sYF6Pkl5Bq.Pf8x1k/FJ8EsX5uOsSaKIR07RpLsrKS', NULL, 0, 54, NULL, '2019-11-13 08:11:16', '2019-11-13 08:11:16'),
(94, NULL, 'Updated', 'Mrugesh', '5', NULL, NULL, NULL, '2019-11-17', NULL, '0', '2', '2', '2', NULL, NULL, NULL, 'mrugesh@yopmail.com', '$2y$10$vCySc6N1LmlWgoOlqm8IS.KxcWYqxI7gJTwe8MAh6eLkJwPr/6AjK', NULL, 0, 53, NULL, '2019-11-13 08:11:39', '2019-11-13 08:11:39'),
(95, NULL, 'Updated', 'Mayank', '5', 'Initial Trainee', '2019-11-14', '2019-11-06', NULL, '91888888888888', '1', '0', '0', '0', 'Special request', 'Special Remark', 'Baroda Posting Station', 'mayankp@yopmail.com', '$2y$10$1Tb3ksougFCXpWm64fsuuerHg3jN9E1rKxFCh4PGbz8.c0h5AD.e.', NULL, 0, 21, NULL, '2019-11-13 08:13:06', '2019-11-13 08:13:06'),
(96, NULL, 'Updated', 'Mayank', '6', 'For Initial Training', '2019-11-29', '2019-11-14', NULL, '918989898989', '1', '0', '0', '0', 'Special request description', 'Remark Description', 'Vadodara Posting Station', 'mayankp@yopmail.com', '$2y$10$WkBULKfWEgxkkilc4yh7xeQtqdkuHyGVGZs9RVUg3GGEM7SlXJbK2', NULL, 0, 21, NULL, '2019-11-13 08:57:46', '2019-11-13 08:57:46'),
(97, NULL, 'Updated', 'Mayank', '6', 'For Initial Training', '2019-11-29', '2019-11-14', NULL, '918989898989', '1', '1', '0', '0', 'Special request description', 'Remark Description', 'Vadodara Posting Station', 'mayankp@yopmail.com', '$2y$10$kDwxlBDr.xh7EGIT2r2FiewyxSa33U0Dprl1XNgWK69oa.O0BbWMq', NULL, 0, 21, NULL, '2019-11-13 08:58:50', '2019-11-13 08:58:50'),
(98, NULL, 'Updated', 'Mrugesh', '6', NULL, NULL, NULL, '2019-11-14', NULL, '0', '2', '2', '2', NULL, NULL, NULL, 'mrugesh@yopmail.com', '$2y$10$4kwr1m0Qwhq.pkN/l7gtLepzly3byJtvMZ9s8xFgA5q3QBjFtZTe.', NULL, 0, 53, NULL, '2019-11-13 08:59:28', '2019-11-13 08:59:28'),
(99, NULL, 'Updated', 'Mrugesh', '6', 'digiflux', '2019-11-14', '2019-11-01', NULL, '917878787878', '1', '1', '1', '0', 'fsdfsdfsfss fd sdfs f', 'sdfsdfsdfdsfsdsf ssdf sdfdsfsdf', 'Ahmedabad Posting Station', 'mrugesh@yopmail.com', '$2y$10$heQL3qeFDymF/kjZm8338uZrdwi8rddFhk4E3jbrcRj6ZjYHiXSdS', NULL, 0, 53, NULL, '2019-11-13 09:00:35', '2019-11-13 09:00:35'),
(100, NULL, 'Updated', 'Maulika', '6', NULL, NULL, NULL, '2019-11-14', NULL, '0', '2', '2', '2', NULL, NULL, NULL, 'maulika@yopmail.com', '$2y$10$K2T.We3kFb5L3CSL4Sa1N.J/NHXpLSxKR/0kydHWO.b0LnWfwoI/G', NULL, 0, 55, NULL, '2019-11-13 09:08:10', '2019-11-13 09:08:10'),
(101, NULL, 'Updated', 'Maulika', '5', 'Senior Training Session', '2019-11-29', '2019-11-01', NULL, '918989898989', '1', '1', '1', '1', 'Special request description', 'Remark description done', 'Manjalpur Vadodara', 'maulika@yopmail.com', '$2y$10$g7ZRGDLWv04/pa553GOw.O.0HJwkuw2cCcGgQ.bBqs174oiXWtiM6', NULL, 0, 55, NULL, '2019-11-13 09:09:25', '2019-11-13 09:09:25');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role_id` int(11) NOT NULL DEFAULT 0,
  `contact` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mail_sent` int(11) NOT NULL DEFAULT 1,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `role_id`, `contact`, `mail_sent`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Administrator Role', 'admin@digiflux.io', 1, NULL, 1, NULL, '$2y$10$hU3vXpgmp6Szq/dtFtT3yOd7gG54KWF1f1RghOl5nfu0zZeSA58Fi', NULL, '2019-07-17 05:48:34', '2019-07-17 05:48:34'),
(2, 'Trainee Role', 'trainee@digiflux.io', 2, NULL, 1, NULL, '$2y$10$Z01mVfy9.fx72PRgpzV6luaU44CBILFRt3tWf87AdXq3uPXlDiLrW', NULL, '2019-07-17 05:48:34', '2019-07-17 05:48:34'),
(3, 'Hostel Incharge', 'hostel@digiflux.io', 3, NULL, 1, NULL, '$2y$10$xI3CRo9KCuZijznoXxL6Ve2mhak1YQpcCqJoLPAYZEEyB4JiPS7Wi', NULL, '2019-07-17 05:48:35', '2019-07-17 05:48:35'),
(4, 'Inventory Incharge', 'inventory@digiflux.io', 4, NULL, 1, NULL, '$2y$10$ZPdGVPF81Q3/ztbRXBAe0exauBvG/.l3duoe/Ru02I9EAt2SvCTF2', NULL, '2019-07-17 05:48:35', '2019-07-17 05:48:35'),
(5, 'Trainee Incharge', 'traineeadministrator@digiflux.io', 5, NULL, 1, NULL, '$2y$10$pSLt2GHXQUY.AUDe3WT.I.v/.ue22RmK.z6BRFjH/e7moOJdajAne', NULL, '2019-07-17 05:48:35', '2019-07-17 05:48:35'),
(6, 'Vinay', 'dchsrti.brc@nhsrcl.in', 1, NULL, 1, NULL, '$2y$10$sCNAEgDmXOgZvz6ljCtKYO1VP00sYVzEuqhRvG8TsbK1EBUJGLiTa', '92JBWFxt9mysFfMKNmE751JybECjW3iTrx5VxcMjzUmGSQ2vOpBAPJBC3BHY', '2019-07-17 05:49:17', '2019-07-17 05:49:17'),
(7, 'VINAY KUMAR', 'vinay2abb@gmail.com', 2, NULL, 1, NULL, '$2y$10$Z9j7slhkVn/8mWZxR3asFuLJ9U34PZ0U4tSUqidDVXNAy.DfqNa16', 'uhLLE5VTYunIdUVVeMc1LGT9ArpRpOk5iiHxcUTyV0uT99rZz0PCldL5hToy', '2019-07-22 01:28:55', '2019-07-22 01:31:37'),
(8, 'Hemal', 'hemal@digiflux.io', 2, NULL, 1, NULL, '$2y$10$TxXMYItWmy2jpNPyGLahgOBlRLa7ovZIKa0lxcNcsEWoYlwNOjqyS', 'IpIJo3ZSWilscdglmfCkvpXzcxgHExZE0nKTxWQeUsjnDCo4ONmnRYZF0CnI', '2019-07-22 04:11:22', '2019-11-13 09:05:46'),
(9, 'Shri. Keshav Moondra', 'apmcivadi1@nhsrcl.in', 2, NULL, 1, NULL, '$2y$10$g4J5n3VmU/4dBl0oJQ7BfuPYIm5SLfqTkdx2FsztlzbMUuI.har1i', 'S9mJ4RDkTsAT9nrJXHguHUCc6gBxTeF6zbSNXPFm0EDGhKJ1O9ClhHjkwIuW', '2019-07-23 06:49:07', '2019-07-23 06:52:39'),
(10, 'RACHIT JAIN', 'mgrcivmum2@nhsrcl.in', 2, NULL, 1, NULL, '$2y$10$ZJcsF440bk6j3tEluAEnKeBmzUfSuCrUXC8NNgFYQeZhQtg.8qJRq', 'YmhkIODJF2H4ff805UtgbaYutmXzEfYlWO8n7RL6Q04BPLrnrO5vm4e6CDDD', '2019-07-23 06:51:39', '2019-08-20 04:01:54'),
(11, 'Kumar Deepak Shrivastava', 'mgrciv1st@nhsrcl.in', 2, NULL, 1, NULL, '$2y$10$ovOdFRf23xvKvGzYRSs0C.6/WQUxuNpbAUyQNr4CmgsaGrM38ofHW', 'wjKW0Os8joUC7BsLqW3Cjb1WGAr3Vtl192eVsgAeLSxDuByyWMK5DznXodwr', '2019-07-23 06:53:26', '2019-07-23 06:55:05'),
(12, 'KRISHAN SINGH', 'mgrcivmum4@nhsrcl.in', 2, NULL, 1, NULL, '$2y$10$xEBdz2wG8fnsCX7caYEye.h8dgA0FHm.hD6MmhTB7SKujzLAUpyUC', 'tWGvSTeb4ypBpddqCHRPlchgBg3YJEBK0fMCNVqvhXKGYrndFHqqYURfrro0', '2019-07-23 06:55:16', '2019-08-21 23:42:51'),
(13, 'BrajKishor Sharma', 'srmgrciv1.adi@nhsrcl.in', 2, NULL, 1, NULL, '$2y$10$5IeZUMyBqKa47w3fQmtFaeKmHuGHn8rApQnJgcNFB9aj508VPcPFS', NULL, '2019-07-23 07:01:47', '2019-07-23 07:01:47'),
(14, 'Mr. Ankush Dogra', 'mgrcivilnhsrcl@gmail.com', 2, NULL, 1, NULL, '$2y$10$IXR43X4K.fDZIj31VUBrU.5YQbVZ/RaEvleCvjjQkt8IMlyUrv.NK', 'fp33kb7cXJcs0zSlILSzJHC1c0Mpqtjxvi1GmOprgH0WzpSL4x9HBKCOKrek', '2019-07-23 07:03:18', '2019-08-22 05:28:48'),
(15, 'Md. Akram Khan', 'mgrciv3.st@nhsrcl.in', 2, NULL, 1, NULL, '$2y$10$Kx8hLyiWHTqVZe0now5NN.DDeaeEcJpSwYN9JSHu.CrfRwtHJECjC', NULL, '2019-07-23 07:04:28', '2019-07-23 07:04:28'),
(16, 'Mr. Mudit Rediwal', 'rediwal.mudit43@gmail.com', 2, NULL, 1, NULL, '$2y$10$TeJHtCZihaNqykFLAijVSu3IbEB55VYJj9DmTVSwu1qKJ9pL8kJGq', 'oPZfALsfaN6B1SfzJgT9zSZABXHkaBLb8pPKQNAkyO2kmY5EGMANzUFZDxdZ', '2019-07-23 07:13:22', '2019-07-23 07:21:00'),
(19, 'hemalpandya92@gmail.com', 'hemalpandya92@gmail.com', 1, NULL, 1, NULL, '$2y$10$6..tW4WorRg9zihM6TvXI.3mQ8rEa4XGDiEiw1LxqvcVeQkcTYKLS', NULL, '2019-07-24 05:02:10', '2019-10-30 07:39:42'),
(20, 'Hemal', 'info@digiflux.io', 2, NULL, 1, NULL, '$2y$10$tKBFRFJMw70.HSDZynRSEOliBIu5xQTXw4ivBY5CDXKAS10gN97Ae', 'h2kWZvjxo3vJL03lxgoZEmr0DPNkjeOOWsgE4zgUx5lOqnl1xSjf30oPyKCX', '2019-07-24 06:15:27', '2019-07-24 06:17:05'),
(21, 'Mayank', 'mayankp@yopmail.com', 2, NULL, 1, NULL, '$2y$10$eA7GnpeR3uFimsSZEUimVOeDXL0vRiWsOXgSX9FGkV3e1K4iSX5NW', NULL, '2019-07-26 01:48:42', '2019-11-13 08:55:17'),
(22, 'Raghvendra Pratap Singh', 'pmciv1mum@nhsrcl.in', 2, NULL, 1, NULL, '$2y$10$2FHXEgY6h/YlZpfIqXxoUuatzi60iJr0ERrNkadZD.jQD941fKDJW', 'IUURAydbf45XyjI5tEzaOZK0ygr7HPZfazEaA9N4SOC6V8QFRGh9gKONR6a0', '2019-08-08 03:19:01', '2019-08-08 08:11:25'),
(23, 'Anand Singh Charan', 'mgrciviladi@nhsrcl.in', 2, NULL, 1, NULL, '$2y$10$W2Bsgs0mbYdRov13naczHOE1cOjwTQujQcPgYMvjnoWjfK4Kv0NS.', '9KhePMEHZzhVSmjWqW9MSdNyePOMmWy8Jo69ni2NjRCn7rEZlspHDvfiVrYw', '2019-08-08 03:20:20', '2019-08-08 06:05:52'),
(24, 'Sanam Soni', 'sanamsoni91@gmail.com', 2, NULL, 1, NULL, '$2y$10$0RhgjdHXrGFGzsuqJY.zROMmnD2/Ti./S/V9hETAKw6zhFf0WiG/a', NULL, '2019-08-08 03:24:49', '2019-08-08 03:24:49'),
(25, 'ARUN NAYAK', 'mgrcivmum1@nhsrcl.in', 2, NULL, 1, NULL, '$2y$10$BPuzMzrpxQt.aqWf/9ks6esxapaZIZjnUUQLTPdk4o.rr8eDFisu2', NULL, '2019-08-08 03:26:02', '2019-08-08 03:26:02'),
(26, 'Manjunatha G', 'mgrcivilbrc1@nhsrcl.in', 2, NULL, 1, NULL, '$2y$10$erqLNeTcR1tEKz1iaUkyBexNx8u7/oWzZeLO1T3gvT1UX/hHhX.Mu', 'EVf6qPxbNly1YqEBqtuP3MwwLX6bgN7dhGa97PQqXpz6VplHYPBeE2IPJc2p', '2019-08-08 03:28:27', '2019-08-08 11:33:58'),
(27, 'Mr. Gaurav Srivastava', 'mgrbrc.nhsrcl@gmail.com', 2, NULL, 1, NULL, '$2y$10$Y0QeCXRwdIazTgyjYTKn4eOfo/shDb.ih0OF4F3FuIawNxRDMPPZC', NULL, '2019-08-08 03:28:53', '2019-08-08 03:28:53'),
(28, 'Himang Jain', 'mgrcivmum3@nhsrcl.in', 2, NULL, 1, NULL, '$2y$10$ZE97fDXNwVn8sWEZR0HSVe3cpXznui5TNU/BqrPLNVzEpiGuEdoOO', 'Dn4yH4xNws6iHKBli92U1LWwN89rMgyLZLx5Gn3X76phxS33R0djDcdBdBEI', '2019-08-08 03:31:02', '2019-08-21 00:00:22'),
(29, 'Anuj Kumar verma', 'dycpmciv1.vapi@nhsrcl.in', 2, NULL, 1, NULL, '$2y$10$tti1dZywBsvFRptYV3nMqeXHbGI7RQsKYzegKVaSMJ324WV1y4OE.', NULL, '2019-08-08 03:35:06', '2019-08-08 03:35:06'),
(30, 'Deepak Kulshrestha', 'dmrc.ngn@gmail.com', 2, NULL, 1, NULL, '$2y$10$TaRinYm1f7Xza0v8hqsB8u6n1Im.uO3a1Pbie3wxAsugTK.gaV6Ci', 'mBvMibvzXXUgHglJjd5bFwxsV0MuxbOpeoqB2hOOJdBLbS0kFn5gm9aIek8j', '2019-08-08 03:38:29', '2019-08-08 03:49:02'),
(31, 'Rahul Mishra', 'mishra.kant@gmail.com', 2, NULL, 1, NULL, '$2y$10$LeVu1q.0RmayDoNw0gjjoeKV4Rlo0SX6sI9j8ooMe4533oO4rgKym', '0q9S69z3utieftjydisqOjH0TV6QZRXJ6KIyjaor3oBa4U3Sl0nk0SzT87OC', '2019-08-08 03:43:01', '2019-08-08 08:25:45'),
(32, 'Ketan Katariya', 'nhsrclciviladi@gmail.com', 2, NULL, 1, NULL, '$2y$10$.s7NLvs8d2RlZtOf/fY5DekUAxvD/1IKUwmXoQs//2yWJ3kRvB33q', 'CAc6HrASMxLkQ09und6OlpHciLUa4w4jxZedwuFfTC4I1vmksX05JDE9dWf4', '2019-08-08 03:47:01', '2019-08-08 03:49:52'),
(33, 'Mr. Dipak Garge', 'dgoffice92@gmail.com', 2, NULL, 1, NULL, '$2y$10$uzgO/br9AvyqhmNgXPDK3.dFDKHJGS3sVRg5fdQbDCyWA.wHJEeeK', NULL, '2019-08-08 03:49:38', '2019-08-08 03:49:38'),
(34, 'Vineet Rajkumar', 'vineetrajkumar969@gmail.com', 2, NULL, 1, NULL, '$2y$10$krxaFXevBpjSApxuVQhnaecJvw1WE7PClVnrIk4zNJ/A74bSV.ZkS', 'aMApL37RK2Y8Ljkfq1oBDr8fzdtWilMTjjT0dMMzbztl3W7QsZlSzjfANEiF', '2019-08-08 03:50:54', '2019-08-08 03:56:36'),
(35, 'RUPESH BONDRE', 'rupeshbondre624@gmail.com', 2, NULL, 1, NULL, '$2y$10$YMh7fBvyP04E5S/nQiWeSe13KUX.pb2EEkattolr0j348rgVo5ReS', 'rPrUBQ8Bl7elxNvb2M8fCbxlqd5xCble9hCPt9ODIgWWPJ2rppaqicMmGuyx', '2019-08-08 03:54:18', '2019-08-08 05:37:02'),
(36, 'Gaurav Saraswat', 'srmgrmech1adi@nhsrcl.in', 2, NULL, 1, NULL, '$2y$10$PC4FvroRAsZow3BMbgJn/u9qT6hYJxnGeNVQWJcvCsnkeCBxsEapK', 'U98HEhafe1IU1C1DCQVZfNV6od7t4Tut6wjnp55gwCjY4rLbundcxRXgnv9g', '2019-08-20 01:19:08', '2019-08-20 02:28:10'),
(37, 'Kingshuk Sarkar', 'dycpmelec1.adi@nhsrcl.in', 2, NULL, 1, NULL, '$2y$10$.DmK3216QP80sk.0uXTE9uQNi6IndZqTmil.rIsVOCZGtR.IFMT/u', 'EPd77oCMro2NpQRWxB6OorVg5CfkNjbBPPG2hpMjM5oYsYdmKIjmmKc7koGl', '2019-08-20 01:20:36', '2019-08-20 02:20:13'),
(38, 'Braj Kishor Sharma', 'srmciv1.adi@nhsrcl.in', 2, NULL, 1, NULL, '$2y$10$CEVDOPqsziNWsf6c./m4V.77BzAtuTx8D.N7ANppAo4JmMHrG/os6', NULL, '2019-08-20 01:21:29', '2019-08-20 01:21:29'),
(39, 'S Bhaskaran', 'bhaskarswr@gmail.com', 2, NULL, 1, NULL, '$2y$10$omjmhkKEHgA9BSj8Y3RwvesbG7gGmFVQcihRM/bHAczbJkbJ6irmy', NULL, '2019-08-20 01:23:31', '2019-08-20 01:23:31'),
(40, 'Santosh Kr Patil', 'srmgrelec1mum@nhsrcl.in', 2, NULL, 1, NULL, '$2y$10$EsJlNXRV4WX1Sw8WtNbE4Oz/nCsiU5l1QMNE/2/BC4RpuZBkBaqG6', 'rwsQVWj0wEv8uuDBLQaBEwVLVhh0KB9x1zjjqlZYTCrwIczW89eUis9KrHLl', '2019-08-20 01:30:08', '2019-08-21 09:12:37'),
(41, 'Shyamal Biswas', 'dycpmsnt.st@nhsrcl.in', 2, NULL, 1, NULL, '$2y$10$RMKJWrO.FFHsVInbhn362.g7fkYiKgkvgq1Ah2vGy3yaZGaPwCmM6', NULL, '2019-08-20 01:31:58', '2019-08-20 01:31:58'),
(42, 'Deepinder Pal Singh', 'dycpmelect1.st@nhsrcl.in', 2, NULL, 1, NULL, '$2y$10$9a4IZijgRSNuhL/0wDiwUejXG83BuW7D41Y1qcckhkJahHcu1A0/S', NULL, '2019-08-20 01:35:10', '2019-08-20 01:35:10'),
(43, 'Trichanshu Kumar', 'mgrciv2.st@nhsrcl.in', 2, NULL, 1, NULL, '$2y$10$zlCui6X0BiqcsJEzhjL9rOQ8QRtXuaqFY2UvGGx6ZDG7hPdkP/JZi', NULL, '2019-08-20 01:36:33', '2019-08-20 01:36:33'),
(44, 'Mr. Balwant Kumar', 'balwant_cd@yahoo.com', 2, NULL, 1, NULL, '$2y$10$fxPS7ZTn2OpvGG7tYSlsPueLjnHAzYPyVy5uBZIGeB8PtDPnftM06', NULL, '2019-08-20 01:37:19', '2019-08-20 01:37:19'),
(45, 'Govindu Sivasankar', 'srmgrrs2@nhsrcl.in', 2, NULL, 1, NULL, '$2y$10$n.LPEYBr7ejVZfZOn3BLiuEy75ZivAu7CdsG.KbsXeSLhY47y3gVC', 'kAUKfelLT81rWyifmJ2CifyciOPYOgNNQFXGGZDhAln6atEiFczGzSi57e0R', '2019-08-20 01:40:02', '2019-08-21 07:26:47'),
(46, 'V S V Srinivas', 'mgrelec2dli@nhsrcl.in', 2, NULL, 1, NULL, '$2y$10$O6OPR4odYCd4ySD1bN7oHu1qlWT1Tmn0anLXgEILIru9j.2fDT.u6', NULL, '2019-08-20 01:41:19', '2019-08-20 01:41:19'),
(47, 'Rahul Pathak', 'rahulpathaknhsrcl@gamil.com', 2, NULL, 1, NULL, '$2y$10$MMpb9C3JmEibLiAcuB1G1eNr3KhA/yLgJephBKOxHr56PtVGhhSY6', NULL, '2019-08-20 01:54:41', '2019-08-20 01:54:41'),
(48, 'Mr. Vivek Joshi', 'mailurs.vj@gamil.com', 2, NULL, 1, NULL, '$2y$10$GWq9CKoY1inl0xYi1TZNL.2wQ9R9vtxaWrTsTWq6YzAGyO9QUotMi', NULL, '2019-08-20 01:57:01', '2019-08-20 01:57:01'),
(49, 'Vansaj Kathuria', 'vanshajcivil@gmail.com', 2, NULL, 1, NULL, '$2y$10$XYJbWfYEhN/xxJYcgSHuBOoTvaUIeCAOxvPovvGlVwqGAN0H3AsVK', 'DKwlfVMfOnC75RrQLlRyyIa1CPzfBGV1mu37QWXA7q2zQxSTvIbma9oYwpmO', '2019-08-20 02:00:34', '2019-08-22 01:42:36'),
(50, 'Mr. Ajay Kumar Singh', 'dycpmelec1.brc@nhsrcl.in', 2, NULL, 1, NULL, '$2y$10$yuKQ9m31g0f3EB7wzf99bORkoLBFKLmmn4SlH2tCVJCArJxLapXJi', 'BzW0TYWMKORXAaChrhTGGOVQbOZYlR3lUF9LrLCZrzJWbAuFWyFiLvRYFiC1', '2019-08-20 02:07:18', '2019-08-20 02:39:43'),
(51, 'Mr. Vivek Joshi', 'mailurs.vj@gmail.com', 2, NULL, 1, NULL, '$2y$10$5veUCIt4amw.YYbzgx63N.t4UkIdCix2vXbCU3fzXnlaYcq6/W4ZS', 'wIrLEZ2wDQ6FTkPg8frFm8x8cTmmnieTrnv29vejot18PKDPwkwv6CWEwEZt', '2019-08-21 05:33:53', '2019-08-21 06:24:25'),
(52, 'Hemal', 'hemal@yopmail.com', 2, NULL, 1, NULL, '$2y$10$37Uw0YQ2iUHjeaGCJV1xZ.17PD/yeYaPPobDEPdOK6cHgw8pUHVGK', NULL, '2019-10-14 09:21:36', '2019-11-13 09:04:47'),
(53, 'Mrugesh', 'mrugesh@yopmail.com', 2, NULL, 1, NULL, '$2y$10$vTtWGT6ddrVX4hIHWJAceOvDfm0oHl5lVCm7/8VEiMiAjXM/dTC0.', NULL, '2019-11-13 08:09:16', '2019-11-13 08:55:34'),
(54, 'Shivom', 'shivom@yopmail.com', 2, NULL, 1, NULL, '$2y$10$Bhrcij1dgYcyTm7rFLHpuuJfI8v.UX76AFHG57O5hqnjEmjb/vn0m', NULL, '2019-11-13 08:09:38', '2019-11-13 08:09:38'),
(55, 'Maulika', 'maulika@yopmail.com', 2, NULL, 1, NULL, '$2y$10$nHyjkjsiA1bqZgsCfmMWH.hjwGfDZFSC6sL2Voj.ovqjB1k.wRKqq', NULL, '2019-11-13 09:07:15', '2019-11-13 09:07:30');

-- --------------------------------------------------------

--
-- Table structure for table `years`
--

CREATE TABLE `years` (
  `id` int(10) UNSIGNED NOT NULL,
  `year` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `display_status` enum('1','0') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1',
  `deleted_status` enum('1','0') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `years`
--

INSERT INTO `years` (`id`, `year`, `display_status`, `deleted_status`, `created_at`, `updated_at`) VALUES
(1, '2019', '1', '0', '2019-07-17 05:53:33', '2019-07-17 05:53:33'),
(2, NULL, '1', '0', '2019-07-17 06:07:48', '2019-07-17 06:07:48'),
(3, '2', '1', '0', '2019-07-29 03:09:08', '2019-07-29 03:09:08'),
(4, '2018', '1', '0', '2019-08-23 10:36:16', '2019-08-23 10:36:16'),
(5, '1987', '1', '0', '2019-11-11 10:24:43', '2019-11-11 10:24:43');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD UNIQUE KEY `cache_key_unique` (`key`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `certificates`
--
ALTER TABLE `certificates`
  ADD PRIMARY KEY (`certificate_id`);

--
-- Indexes for table `course`
--
ALTER TABLE `course`
  ADD PRIMARY KEY (`course_id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`feedback_id`);

--
-- Indexes for table `hostel`
--
ALTER TABLE `hostel`
  ADD PRIMARY KEY (`hostel_id`);

--
-- Indexes for table `hostel_room`
--
ALTER TABLE `hostel_room`
  ADD PRIMARY KEY (`hostel_room_id`);

--
-- Indexes for table `hostel_room_activity`
--
ALTER TABLE `hostel_room_activity`
  ADD PRIMARY KEY (`hostel_room_activity_id`);

--
-- Indexes for table `inches`
--
ALTER TABLE `inches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `inventories`
--
ALTER TABLE `inventories`
  ADD PRIMARY KEY (`inventory_id`);

--
-- Indexes for table `inventories_activity`
--
ALTER TABLE `inventories_activity`
  ADD PRIMARY KEY (`inventory_activity_id`);

--
-- Indexes for table `inventory_details`
--
ALTER TABLE `inventory_details`
  ADD PRIMARY KEY (`inventory_detail_id`);

--
-- Indexes for table `inventory_details_activity`
--
ALTER TABLE `inventory_details_activity`
  ADD PRIMARY KEY (`inventory_detail_activity_id`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `location`
--
ALTER TABLE `location`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `make`
--
ALTER TABLE `make`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `model`
--
ALTER TABLE `model`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles_access`
--
ALTER TABLE `roles_access`
  ADD PRIMARY KEY (`role_access_id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `supplier`
--
ALTER TABLE `supplier`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `trainee`
--
ALTER TABLE `trainee`
  ADD PRIMARY KEY (`trainee_id`);

--
-- Indexes for table `trainee_activities`
--
ALTER TABLE `trainee_activities`
  ADD PRIMARY KEY (`trainee_activity_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `years`
--
ALTER TABLE `years`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `certificates`
--
ALTER TABLE `certificates`
  MODIFY `certificate_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `course`
--
ALTER TABLE `course`
  MODIFY `course_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `feedback`
--
ALTER TABLE `feedback`
  MODIFY `feedback_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `hostel`
--
ALTER TABLE `hostel`
  MODIFY `hostel_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `hostel_room`
--
ALTER TABLE `hostel_room`
  MODIFY `hostel_room_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `hostel_room_activity`
--
ALTER TABLE `hostel_room_activity`
  MODIFY `hostel_room_activity_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `inches`
--
ALTER TABLE `inches`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `inventories`
--
ALTER TABLE `inventories`
  MODIFY `inventory_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `inventories_activity`
--
ALTER TABLE `inventories_activity`
  MODIFY `inventory_activity_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `inventory_details`
--
ALTER TABLE `inventory_details`
  MODIFY `inventory_detail_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=165;

--
-- AUTO_INCREMENT for table `inventory_details_activity`
--
ALTER TABLE `inventory_details_activity`
  MODIFY `inventory_detail_activity_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=568;

--
-- AUTO_INCREMENT for table `location`
--
ALTER TABLE `location`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `make`
--
ALTER TABLE `make`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT for table `model`
--
ALTER TABLE `model`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `roles_access`
--
ALTER TABLE `roles_access`
  MODIFY `role_access_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `sessions`
--
ALTER TABLE `sessions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `supplier`
--
ALTER TABLE `supplier`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `trainee`
--
ALTER TABLE `trainee`
  MODIFY `trainee_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=73;

--
-- AUTO_INCREMENT for table `trainee_activities`
--
ALTER TABLE `trainee_activities`
  MODIFY `trainee_activity_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=102;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT for table `years`
--
ALTER TABLE `years`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
