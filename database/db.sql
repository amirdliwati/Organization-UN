-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jul 18, 2020 at 09:50 PM
-- Server version: 5.7.26
-- PHP Version: 7.3.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `barakatdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `addresses`
--

DROP TABLE IF EXISTS `addresses`;
CREATE TABLE IF NOT EXISTS `addresses` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `address` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='مكان دفتر العائلة';

--
-- Dumping data for table `addresses`
--

INSERT INTO `addresses` (`id`, `address`, `created_at`, `updated_at`) VALUES
(1, 'عين عسان', '2020-07-11 18:56:06', '2020-07-11 18:56:06'),
(2, 'تركان ', '2020-07-11 18:56:06', '2020-07-11 18:56:06'),
(3, 'المالكية', '2020-07-11 18:56:20', '2020-07-11 18:56:20'),
(4, 'نلعابور ', '2020-07-11 18:56:20', '2020-07-11 18:56:20'),
(5, 'ابو تبة', '2020-07-11 18:56:37', '2020-07-11 18:56:37'),
(6, 'الحميرة ', '2020-07-11 18:56:37', '2020-07-11 18:56:37'),
(7, 'الناصرية', '2020-07-11 18:56:55', '2020-07-11 18:56:55'),
(8, 'ابو صفيطة', '2020-07-11 18:56:55', '2020-07-11 18:56:55'),
(9, 'مزرعة الحتاني', '2020-07-11 18:57:11', '2020-07-11 18:57:11'),
(10, 'صدعايا', '2020-07-11 18:57:11', '2020-07-11 18:57:11');

-- --------------------------------------------------------

--
-- Table structure for table `childrens`
--

DROP TABLE IF EXISTS `childrens`;
CREATE TABLE IF NOT EXISTS `childrens` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `birth_date` date DEFAULT NULL,
  `gender` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `age_years` int(3) UNSIGNED DEFAULT NULL,
  `age_month` int(3) UNSIGNED DEFAULT NULL,
  `status_id` int(3) UNSIGNED DEFAULT NULL,
  `family_book_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `children_family_book` (`family_book_id`),
  KEY `children_status` (`status_id`)
) ENGINE=InnoDB AUTO_INCREMENT=61 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `childrens`
--

INSERT INTO `childrens` (`id`, `name`, `birth_date`, `gender`, `age_years`, `age_month`, `status_id`, `family_book_id`, `created_at`, `updated_at`) VALUES
(47, 'هيثم', '2020-07-15', 'ذكر', 0, 0, 1, 7, '2020-07-17 16:42:50', '2020-07-17 16:42:50'),
(48, 'هيثم2', '2013-01-15', 'ذكر', 7, 90, 1, 7, '2020-07-17 16:42:50', '2020-07-17 16:42:50'),
(49, 'هيثم3', '2010-01-15', 'أنثى', 10, 126, 1, 7, '2020-07-17 16:42:50', '2020-07-17 16:42:50'),
(50, 'هيثم', '2020-07-15', 'ذكر', 0, 0, 1, 7, '2020-07-17 16:42:50', '2020-07-17 16:42:50'),
(51, 'هيثم', '2020-07-15', 'أنثى', 0, 0, 1, 7, '2020-07-17 16:42:50', '2020-07-17 16:42:50'),
(52, 'أميرو1', '1936-01-12', 'ذكر', 84, 1014, 1, 5, '2020-07-17 16:43:23', '2020-07-17 16:43:23'),
(53, 'أميرو2', '2016-01-12', 'ذكر', 4, 54, 2, 5, '2020-07-17 16:43:23', '2020-07-17 16:43:23'),
(54, 'أميرو3', '2017-01-12', 'أنثى', 3, 42, 3, 5, '2020-07-17 16:43:23', '2020-07-17 16:43:23'),
(55, 'أمير4', '2007-02-12', 'ذكر', 13, 161, 1, 5, '2020-07-17 16:43:23', '2020-07-17 16:43:23'),
(56, 'أمير1', '2015-01-23', 'ذكر', 5, 66, 1, 4, '2020-07-17 16:43:46', '2020-07-17 16:43:46'),
(57, 'أمير2', '2010-01-29', 'ذكر', 10, 126, 2, 4, '2020-07-17 16:43:46', '2020-07-17 16:43:46'),
(58, 'أمير', '1991-01-27', 'ذكر', 29, 354, 1, 3, '2020-07-17 16:44:05', '2020-07-17 16:44:05'),
(59, 'أميرة', '2011-01-12', 'أنثى', 9, 114, 2, 3, '2020-07-17 16:44:05', '2020-07-17 16:44:05'),
(60, 'أمير', '1990-11-07', 'ذكر', 30, 356, 1, 3, '2020-07-17 16:44:05', '2020-07-17 16:44:05');

-- --------------------------------------------------------

--
-- Table structure for table `children_status`
--

DROP TABLE IF EXISTS `children_status`;
CREATE TABLE IF NOT EXISTS `children_status` (
  `id` int(3) UNSIGNED NOT NULL AUTO_INCREMENT,
  `status` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `children_status`
--

INSERT INTO `children_status` (`id`, `status`, `created_at`, `updated_at`) VALUES
(1, 'سليم', '2020-07-09 17:56:06', '2020-07-09 17:56:06'),
(2, 'معاق', '2020-07-09 17:56:06', '2020-07-09 17:56:06'),
(3, 'مصاب بامراض مزمنة', '2020-07-09 17:56:26', '2020-07-09 17:56:26');

-- --------------------------------------------------------

--
-- Table structure for table `children_status_notes`
--

DROP TABLE IF EXISTS `children_status_notes`;
CREATE TABLE IF NOT EXISTS `children_status_notes` (
  `id` int(3) UNSIGNED NOT NULL AUTO_INCREMENT,
  `children_id` bigint(20) UNSIGNED NOT NULL,
  `children_status_id` int(3) UNSIGNED NOT NULL,
  `notes` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `status_notes_children` (`children_id`),
  KEY `status_notes` (`children_status_id`)
) ENGINE=InnoDB AUTO_INCREMENT=58 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `children_status_notes`
--

INSERT INTO `children_status_notes` (`id`, `children_id`, `children_status_id`, `notes`, `created_at`, `updated_at`) VALUES
(44, 47, 1, 'سسسسسس', '2020-07-17 16:42:50', '2020-07-17 16:42:50'),
(45, 48, 1, 'سسسسسس', '2020-07-17 16:42:50', '2020-07-17 16:42:50'),
(46, 49, 1, 'سسسسسس', '2020-07-17 16:42:50', '2020-07-17 16:42:50'),
(47, 50, 1, 'سسسسسس', '2020-07-17 16:42:50', '2020-07-17 16:42:50'),
(48, 51, 1, 'سسسسسس', '2020-07-17 16:42:50', '2020-07-17 16:42:50'),
(49, 52, 1, 'سسسسسس', '2020-07-17 16:43:23', '2020-07-17 16:43:23'),
(50, 53, 2, 'لالالالالالالا', '2020-07-17 16:43:23', '2020-07-17 16:43:23'),
(51, 54, 3, 'مص', '2020-07-17 16:43:23', '2020-07-17 16:43:23'),
(52, 55, 1, 'سسسسسس', '2020-07-17 16:43:23', '2020-07-17 16:43:23'),
(53, 56, 1, 'سسسسسس', '2020-07-17 16:43:46', '2020-07-17 16:43:46'),
(54, 57, 2, 'لالالالالالالا', '2020-07-17 16:43:46', '2020-07-17 16:43:46'),
(55, 58, 1, 'سسسسسس', '2020-07-17 16:44:05', '2020-07-17 16:44:05'),
(56, 59, 2, 'لالالالالالالا', '2020-07-17 16:44:05', '2020-07-17 16:44:05'),
(57, 60, 1, 'سسسسسس', '2020-07-17 16:44:05', '2020-07-17 16:44:05');

-- --------------------------------------------------------

--
-- Table structure for table `family_books`
--

DROP TABLE IF EXISTS `family_books`;
CREATE TABLE IF NOT EXISTS `family_books` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `first_name` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_name` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `father_nqme` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `national_id` bigint(20) UNSIGNED DEFAULT NULL,
  `book_id` bigint(20) UNSIGNED DEFAULT NULL,
  `birth_date` date DEFAULT NULL,
  `age_years` int(3) UNSIGNED DEFAULT NULL,
  `gender_participant` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `husband_name` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `birth_date_husband` date DEFAULT NULL,
  `age_years_husband` int(3) UNSIGNED DEFAULT NULL,
  `marital_status_id` int(3) UNSIGNED NOT NULL,
  `residence_status_id` int(3) UNSIGNED DEFAULT NULL,
  `notes` text COLLATE utf8mb4_unicode_ci,
  `address_id` bigint(20) UNSIGNED DEFAULT NULL,
  `address_details` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mobile` bigint(20) UNSIGNED DEFAULT NULL,
  `phone` bigint(20) UNSIGNED DEFAULT NULL,
  `status_from_organization` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT 'مقبول' COMMENT 'ايقاف  مقبول   مرفوض',
  `status_from_organization_notes` text COLLATE utf8mb4_unicode_ci,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `projects_id` bigint(20) UNSIGNED DEFAULT '1',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `family_books_address` (`address_id`),
  KEY `husband_marital_status` (`marital_status_id`),
  KEY `family_books_residence_status` (`residence_status_id`),
  KEY `family_books_project` (`projects_id`),
  KEY `family_book_user` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `family_books`
--

INSERT INTO `family_books` (`id`, `first_name`, `last_name`, `father_nqme`, `national_id`, `book_id`, `birth_date`, `age_years`, `gender_participant`, `husband_name`, `birth_date_husband`, `age_years_husband`, `marital_status_id`, `residence_status_id`, `notes`, `address_id`, `address_details`, `mobile`, `phone`, `status_from_organization`, `status_from_organization_notes`, `user_id`, `projects_id`, `created_at`, `updated_at`) VALUES
(3, 'محمد', 'بركات', 'أمير', 55555555555, 5555555, '2002-01-12', 18, 'ذكر', '0', '1973-10-05', 47, 2, 2, 'أمير', 4, 'أمير', 9445822586, NULL, 'مقبول', 'تم الرفض', 1, 1, '2020-07-11 22:31:57', '2020-07-17 16:44:21'),
(4, 'محمد', 'مديسيس', 'أمير', 55555555555, 5555555, '2010-01-12', 10, 'ذكر', '0', '1990-05-04', 30, 2, 1, 'أمير', 2, 'أمير', 93335856558, NULL, 'مقبول', NULL, 1, 1, '2020-07-11 22:33:54', '2020-07-17 16:44:21'),
(5, 'أمير', 'أمير', 'أمير', 5555, 5456464, '1936-01-24', 84, 'ذكر', 'أمير د', '1980-01-01', 40, 2, 2, 'أميرأميرأميرأميرأميرأميرأميرأمير', 2, 'حلب سيف الدولة', 9332255668, 215501403, 'مقبول', 'hgfghfhf', 1, 1, '2020-07-11 22:36:37', '2020-07-17 16:44:21'),
(7, 'عبد الله', 'قاضي', 'هيثم', 123456789101, 5525869, '2006-02-15', 14, 'ذكر', 'عبود', '1947-01-17', 73, 1, 2, 'لا يوجد', 2, 'لا يوجد', 933066008, 215501403, 'مقبول', NULL, 5, 1, '2020-07-15 16:15:35', '2020-07-18 18:03:19');

-- --------------------------------------------------------

--
-- Table structure for table `logs`
--

DROP TABLE IF EXISTS `logs`;
CREATE TABLE IF NOT EXISTS `logs` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `operating_name` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `operating_code` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `logs_users` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `logs`
--

INSERT INTO `logs` (`id`, `title`, `operating_name`, `operating_code`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 'تعديل', 'تعديل', 'تعديل', 2, '2020-07-11 04:48:04', '2020-07-11 04:48:04'),
(2, 'اضفة دفتر عائلة جديد ', '6', 'أميرو أميرو', 1, '2020-07-11 22:51:30', '2020-07-11 22:51:30'),
(3, '  حذف دفتر عائلة  ', '2', 'أمير أمير', 1, '2020-07-12 10:43:15', '2020-07-12 10:43:15'),
(4, 'تعديل دفتر عائلة جديد ', '6', 'أميرو أميرو', 1, '2020-07-12 11:35:46', '2020-07-12 11:35:46'),
(5, '  حذف دفتر عائلة  ', '6', 'أميرو أميرو', 1, '2020-07-12 11:36:19', '2020-07-12 11:36:19'),
(6, 'تعديل دفتر عائلة جديد ', '5', 'أمير أمير', 1, '2020-07-12 11:37:44', '2020-07-12 11:37:44'),
(7, 'تعديل دفتر عائلة جديد ', '5', 'أمير أمير', 1, '2020-07-12 11:42:54', '2020-07-12 11:42:54'),
(8, '  تغيير حالة الدفتر إلى مقبول  ', '3', 'أمير أمير', 1, '2020-07-12 12:29:40', '2020-07-12 12:29:40'),
(9, '  تغيير حالة الدفتر إلى ايقاف  ', '3', 'أمير أمير', 1, '2020-07-12 12:29:46', '2020-07-12 12:29:46'),
(10, '  تغيير حالة الدفتر إلى مرفوض  ', '3', 'أمير أمير', 1, '2020-07-12 12:30:55', '2020-07-12 12:30:55'),
(11, '  تغيير حالة الدفتر إلى مرفوض  ', '4', 'أمير أمير', 1, '2020-07-12 13:47:30', '2020-07-12 13:47:30'),
(12, '  تغيير حالة الدفتر إلى ايقاف  ', '5', 'أمير أمير', 1, '2020-07-12 13:47:39', '2020-07-12 13:47:39'),
(13, 'تعديل دفتر عائلة جديد ', '5', 'أمير أمير', 1, '2020-07-12 22:15:43', '2020-07-12 22:15:43'),
(14, '  تغيير حالة الدفتر إلى مقبول  ', '3', 'أمير أمير', 1, '2020-07-13 02:31:35', '2020-07-13 02:31:35'),
(15, '  تغيير حالة الدفتر إلى مقبول  ', '4', 'أمير أمير', 1, '2020-07-13 10:03:13', '2020-07-13 10:03:13'),
(16, 'تعديل دفتر عائلة جديد ', '4', 'محمد مديسيس', 1, '2020-07-14 22:17:41', '2020-07-14 22:17:41'),
(17, 'تعديل دفتر عائلة جديد ', '5', 'أمير أمير', 1, '2020-07-14 22:17:57', '2020-07-14 22:17:57'),
(18, 'تعديل دفتر عائلة جديد ', '3', 'محمد بركات', 1, '2020-07-14 22:18:10', '2020-07-14 22:18:10'),
(19, 'اضافة دفتر عائلة جديد ', '7', 'عبد الله قاضي', 5, '2020-07-15 16:15:36', '2020-07-15 16:15:36'),
(20, '  تغيير حالة الدفتر إلى مقبول  ', '5', 'أمير أمير', 1, '2020-07-15 19:46:42', '2020-07-15 19:46:42'),
(21, 'تعديل دفتر عائلة جديد ', '5', 'أمير أمير', 1, '2020-07-15 22:10:26', '2020-07-15 22:10:26'),
(22, 'تعديل دفتر عائلة جديد ', '5', 'أمير أمير', 1, '2020-07-15 22:10:47', '2020-07-15 22:10:47'),
(23, 'تعديل دفتر عائلة جديد ', '7', 'عبد الله قاضي', 1, '2020-07-17 16:42:51', '2020-07-17 16:42:51'),
(24, 'تعديل دفتر عائلة جديد ', '5', 'أمير أمير', 1, '2020-07-17 16:43:23', '2020-07-17 16:43:23'),
(25, 'تعديل دفتر عائلة جديد ', '4', 'محمد مديسيس', 1, '2020-07-17 16:43:46', '2020-07-17 16:43:46'),
(26, 'تعديل دفتر عائلة جديد ', '3', 'محمد بركات', 1, '2020-07-17 16:44:05', '2020-07-17 16:44:05'),
(27, '  تغيير حالة الدفتر إلى ايقاف  ', '7', 'عبد الله قاضي', 1, '2020-07-18 18:03:04', '2020-07-18 18:03:04'),
(28, '  تغيير حالة الدفتر إلى مقبول  ', '7', 'عبد الله قاضي', 1, '2020-07-18 18:03:19', '2020-07-18 18:03:19');

-- --------------------------------------------------------

--
-- Table structure for table `marital_status`
--

DROP TABLE IF EXISTS `marital_status`;
CREATE TABLE IF NOT EXISTS `marital_status` (
  `id` int(3) UNSIGNED NOT NULL AUTO_INCREMENT,
  `status` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `marital_status`
--

INSERT INTO `marital_status` (`id`, `status`, `created_at`, `updated_at`) VALUES
(1, 'متزوج', '2020-07-09 18:05:58', '2020-07-09 18:05:58'),
(2, 'مطلق', '2020-07-09 18:05:58', '2020-07-09 18:05:58'),
(3, 'أرمل', '2020-07-09 18:06:05', '2020-07-09 18:06:05');

-- --------------------------------------------------------

--
-- Table structure for table `measuring_units`
--

DROP TABLE IF EXISTS `measuring_units`;
CREATE TABLE IF NOT EXISTS `measuring_units` (
  `id` int(3) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `measuring_units`
--

INSERT INTO `measuring_units` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'كرتونة', '2020-07-09 18:46:59', '2020-07-09 18:46:59'),
(2, 'كيس', '2020-07-09 18:46:59', '2020-07-09 18:46:59'),
(3, 'علبة', '2020-07-09 18:47:16', '2020-07-09 18:47:16'),
(4, 'عدد', '2020-07-09 19:47:45', '2020-07-09 19:47:45'),
(5, 'لتر', '2020-07-09 19:48:03', '2020-07-09 19:48:03');

-- --------------------------------------------------------

--
-- Table structure for table `organizations`
--

DROP TABLE IF EXISTS `organizations`;
CREATE TABLE IF NOT EXISTS `organizations` (
  `id` int(5) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `organizations`
--

INSERT INTO `organizations` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'منظمة WFP', '2020-07-12 00:26:40', '2020-07-12 00:26:40');

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

DROP TABLE IF EXISTS `permissions`;
CREATE TABLE IF NOT EXISTS `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` varchar(75) COLLATE utf8mb4_unicode_ci NOT NULL,
  `active` tinyint(1) NOT NULL,
  `content` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `title`, `active`, `content`, `created_at`, `updated_at`) VALUES
(1, 'ManagementUsers', 1, 'Management Users', '2020-07-09 16:58:11', '2020-07-09 16:58:11'),
(2, 'EntryForms', 1, 'Entry Forms', '2020-07-11 16:36:44', '2020-07-11 16:36:44'),
(3, 'Forms', 1, 'Forms', '2020-07-11 16:37:04', '2020-07-11 16:37:04'),
(4, 'Reports', 1, 'Reports', '2020-07-11 20:06:13', '2020-07-11 20:06:13');

-- --------------------------------------------------------

--
-- Table structure for table `projects`
--

DROP TABLE IF EXISTS `projects`;
CREATE TABLE IF NOT EXISTS `projects` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `organization_id` int(5) UNSIGNED NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `projects_organization` (`organization_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `projects`
--

INSERT INTO `projects` (`id`, `name`, `organization_id`, `created_at`, `updated_at`) VALUES
(1, 'إنشاء وحدات تربية الدجاج البياض ودعم سبل كسب العيش للأسر الضعيفة - المرحلة الثانية', 1, '2020-07-12 00:28:04', '2020-07-12 00:28:04');

-- --------------------------------------------------------

--
-- Table structure for table `receiving_aids`
--

DROP TABLE IF EXISTS `receiving_aids`;
CREATE TABLE IF NOT EXISTS `receiving_aids` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `date` date DEFAULT NULL,
  `serial_number` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `number` int(5) UNSIGNED NOT NULL,
  `employee_name` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `family_books_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `receiving_aid_family_books` (`family_books_id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT=' تفاصيل مذكرة استلام معونات';

--
-- Dumping data for table `receiving_aids`
--

INSERT INTO `receiving_aids` (`id`, `date`, `serial_number`, `number`, `employee_name`, `family_books_id`, `created_at`, `updated_at`) VALUES
(5, '2020-07-13', '3-7-1', 1, 'صالحة', 3, '2020-07-13 09:56:35', '2020-07-13 09:56:35'),
(6, '2020-07-22', '3-7-1', 2, 'احمد', 3, '2020-07-13 09:58:14', '2020-07-13 09:58:14'),
(7, '2020-07-13', '3-7-2', 3, 'احمد', 3, '2020-07-13 09:58:50', '2020-07-13 09:58:50'),
(8, '2020-07-13', '3-7-4', 4, 'احمد', 3, '2020-07-13 10:01:41', '2020-07-13 10:01:41'),
(9, '2020-07-13', '3-7-5', 5, 'احمد', 3, '2020-07-13 10:03:42', '2020-07-13 10:03:42'),
(10, '2020-07-13', '4-7-1', 1, 'صالحة', 4, '2020-07-13 10:03:42', '2020-07-13 21:35:24');

-- --------------------------------------------------------

--
-- Table structure for table `receiving_aid_details`
--

DROP TABLE IF EXISTS `receiving_aid_details`;
CREATE TABLE IF NOT EXISTS `receiving_aid_details` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `item` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `measuring_unit_id` int(3) UNSIGNED DEFAULT NULL,
  `quantity` int(3) UNSIGNED DEFAULT NULL,
  `receiving_aid_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `receiving_aid_measuring_unit` (`measuring_unit_id`),
  KEY `details_receiving_aid` (`receiving_aid_id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT=' تفاصيل مذكرة استلام معونات';

--
-- Dumping data for table `receiving_aid_details`
--

INSERT INTO `receiving_aid_details` (`id`, `item`, `measuring_unit_id`, `quantity`, `receiving_aid_id`, `created_at`, `updated_at`) VALUES
(6, 'كرتونة مواد غذائية WFPkkk', 1, 3, 6, '2020-07-13 09:58:14', '2020-07-13 09:58:14'),
(7, 'كرتونة مواد غذائية WFP', 1, 15, 7, '2020-07-13 09:58:50', '2020-07-13 09:58:50'),
(8, 'كرتونة مواد غذائية WFP', 1, 10, 8, '2020-07-13 10:01:41', '2020-07-13 10:01:41'),
(9, 'كرتونة مواد غذائية WFPkkk', 1, 17, 9, '2020-07-13 10:03:42', '2020-07-13 10:03:42'),
(11, 'كرتونة مواد غذائية WFP', 1, 5, 5, '2020-07-13 21:35:23', '2020-07-13 21:35:23'),
(12, 'رز (10 كيلو)', 3, 3, 5, '2020-07-13 21:35:23', '2020-07-13 21:35:23'),
(13, 'كرتونة مواد غذائية WFP', 1, 5, 10, '2020-07-13 21:35:24', '2020-07-13 21:35:24'),
(14, 'رز (10 كيلو)', 3, 3, 10, '2020-07-13 21:35:24', '2020-07-13 21:35:24');

-- --------------------------------------------------------

--
-- Table structure for table `receiving_scholarships`
--

DROP TABLE IF EXISTS `receiving_scholarships`;
CREATE TABLE IF NOT EXISTS `receiving_scholarships` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `date` date DEFAULT NULL,
  `serial_number` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `number` int(5) UNSIGNED NOT NULL,
  `employee_name` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `family_books_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `receiving_scholarship_family_books` (`family_books_id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT=' تفاصيل مذكرة استلام منحة';

--
-- Dumping data for table `receiving_scholarships`
--

INSERT INTO `receiving_scholarships` (`id`, `date`, `serial_number`, `number`, `employee_name`, `family_books_id`, `created_at`, `updated_at`) VALUES
(10, '2020-07-09', '3-7-1', 1, 'صالحة', 3, '2020-07-13 10:10:06', '2020-07-13 10:10:06'),
(11, '2020-07-09', '4-7-1', 1, 'صالحة', 4, '2020-07-13 10:10:06', '2020-07-13 10:10:06'),
(12, '2020-07-14', '3-7-2', 2, 'حمودة', 3, '2020-07-14 13:40:53', '2020-07-14 13:40:53'),
(13, '2020-07-14', '4-7-2', 2, 'حمودة', 4, '2020-07-14 13:40:53', '2020-07-14 13:40:53');

-- --------------------------------------------------------

--
-- Table structure for table `receiving_scholarship_details`
--

DROP TABLE IF EXISTS `receiving_scholarship_details`;
CREATE TABLE IF NOT EXISTS `receiving_scholarship_details` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `item` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `measuring_unit_id` int(3) UNSIGNED DEFAULT NULL,
  `quantity` int(3) UNSIGNED DEFAULT NULL,
  `receiving_scholarship_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `receiving_scholarship_measuring_unit` (`measuring_unit_id`) USING BTREE,
  KEY `details_receiving_scholarship` (`receiving_scholarship_id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT=' تفاصيل مذكرة استلام منحة';

--
-- Dumping data for table `receiving_scholarship_details`
--

INSERT INTO `receiving_scholarship_details` (`id`, `item`, `measuring_unit_id`, `quantity`, `receiving_scholarship_id`, `created_at`, `updated_at`) VALUES
(13, 'كرتونة مواد غذائية WFP', 5, 10, 10, '2020-07-13 21:29:38', '2020-07-13 21:29:38'),
(14, 'رز (10 كيلو)', 2, 2, 10, '2020-07-13 21:29:38', '2020-07-13 21:29:38'),
(15, 'كرتونة مواد غذائية WFP', 5, 10, 11, '2020-07-13 21:29:38', '2020-07-13 21:29:38'),
(16, 'رز (10 كيلو)', 2, 2, 11, '2020-07-13 21:29:38', '2020-07-13 21:29:38'),
(25, 'كرتونة مواد غذائية WFPkkkjhghfj', 1, 3, 12, '2020-07-14 13:50:12', '2020-07-14 13:50:12'),
(26, 'رز (15 كيلو)', 2, 2, 12, '2020-07-14 13:50:13', '2020-07-14 13:50:13'),
(27, 'طحين (15 كيلو)', 2, 1, 12, '2020-07-14 13:50:13', '2020-07-14 13:50:13'),
(28, 'كرتونة مواد غذائية WFPkkkjhghfj', 1, 3, 13, '2020-07-14 13:50:13', '2020-07-14 13:50:13'),
(29, 'رز (15 كيلو)', 2, 2, 13, '2020-07-14 13:50:13', '2020-07-14 13:50:13'),
(30, 'طحين (15 كيلو)', 2, 1, 13, '2020-07-14 13:50:13', '2020-07-14 13:50:13');

-- --------------------------------------------------------

--
-- Table structure for table `residence_status`
--

DROP TABLE IF EXISTS `residence_status`;
CREATE TABLE IF NOT EXISTS `residence_status` (
  `id` int(3) UNSIGNED NOT NULL AUTO_INCREMENT,
  `status` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `residence_status`
--

INSERT INTO `residence_status` (`id`, `status`, `created_at`, `updated_at`) VALUES
(1, 'لاجئ', '2020-07-09 18:28:00', '2020-07-09 18:28:00'),
(2, 'عائد', '2020-07-09 18:28:00', '2020-07-09 18:28:00'),
(3, 'نازح', '2020-07-09 18:28:11', '2020-07-09 18:28:11'),
(4, 'مقيم', '2020-07-09 18:30:18', '2020-07-09 18:30:18');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

DROP TABLE IF EXISTS `roles`;
CREATE TABLE IF NOT EXISTS `roles` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` varchar(75) COLLATE utf8mb4_unicode_ci NOT NULL,
  `active` tinyint(1) NOT NULL,
  `content` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `title`, `active`, `content`, `created_at`, `updated_at`) VALUES
(1, 'admin_role', 1, 'everything', '2020-04-22 18:30:00', '2020-04-22 18:30:00'),
(2, 'users_role', 1, 'Users permissions', '2020-04-22 18:30:00', '2020-04-22 18:30:00');

-- --------------------------------------------------------

--
-- Table structure for table `role_permissions`
--

DROP TABLE IF EXISTS `role_permissions`;
CREATE TABLE IF NOT EXISTS `role_permissions` (
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`role_id`,`permission_id`),
  KEY `perm_FK` (`permission_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `role_permissions`
--

INSERT INTO `role_permissions` (`role_id`, `permission_id`, `created_at`, `updated_at`) VALUES
(1, 1, '2020-07-11 00:04:56', '2020-07-11 00:04:56'),
(1, 2, '2020-07-11 16:37:28', '2020-07-11 16:37:28'),
(1, 3, '2020-07-11 16:37:28', '2020-07-11 16:37:28'),
(1, 4, '2020-07-11 20:06:25', '2020-07-11 20:06:25'),
(2, 2, '2020-07-11 16:37:40', '2020-07-11 16:37:40');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `role_id` bigint(20) UNSIGNED DEFAULT '2',
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mobile` bigint(20) UNSIGNED DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_login` datetime DEFAULT NULL,
  `status` tinyint(1) UNSIGNED DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `user_role_FK` (`role_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `role_id`, `name`, `mobile`, `email`, `email_verified_at`, `password`, `remember_token`, `last_login`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 'محمد بركات', NULL, 'admin@barakat.com', '2020-04-06 21:00:00', '$2y$10$UjqkW/hpmRK6RwmGPM6n8eFqSK2.bwTDttjJUfRGrMvesEhwKzNE2', NULL, NULL, 1, '2020-04-06 21:00:00', '2020-07-11 00:21:44'),
(2, 2, 'أمير', NULL, 'amir@barakat.com', '2020-04-06 21:00:00', '$2y$10$7sTaWYLTY/3AJy3rP4Hc9.XhFcHyvl9ezc1UCuiyO9j7QccHh5RJi', NULL, NULL, 1, '2020-04-06 21:00:00', '2020-07-11 00:37:51'),
(5, 2, 'محمود', 933322558, 'mm@mm.mm', NULL, '$2y$10$UjqkW/hpmRK6RwmGPM6n8eFqSK2.bwTDttjJUfRGrMvesEhwKzNE2', NULL, NULL, 0, '2020-07-10 22:13:02', '2020-07-14 12:13:43');

-- --------------------------------------------------------

--
-- Table structure for table `visits`
--

DROP TABLE IF EXISTS `visits`;
CREATE TABLE IF NOT EXISTS `visits` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `date` date DEFAULT NULL,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fodder` int(3) DEFAULT NULL COMMENT 'المشرب',
  `chicken` int(3) DEFAULT NULL,
  `status` varchar(15) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'good - Mediocre - bad',
  `breeding` varchar(15) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'مكان الدجاج',
  `eggs` int(3) DEFAULT NULL,
  `household` varchar(5) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `selling` varchar(5) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `selling_price` double DEFAULT NULL,
  `quantity_feed` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'كمية العلف',
  `advise` text COLLATE utf8mb4_unicode_ci,
  `notes` text COLLATE utf8mb4_unicode_ci,
  `family_books_id` bigint(20) UNSIGNED DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `visits_user` (`user_id`),
  KEY `visits_family_books` (`family_books_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `visits`
--

INSERT INTO `visits` (`id`, `date`, `name`, `fodder`, `chicken`, `status`, `breeding`, `eggs`, `household`, `selling`, `selling_price`, `quantity_feed`, `advise`, `notes`, `family_books_id`, `user_id`, `created_at`, `updated_at`) VALUES
(1, '2020-07-15', 'حمادة الأحمد', 1, 10, 'good', 'good', 15, '-', NULL, NULL, '10', 'لا يوجد', 'لا يوجد', 7, 5, '2020-07-15 16:17:41', '2020-07-15 16:17:41');

-- --------------------------------------------------------

--
-- Table structure for table `wives`
--

DROP TABLE IF EXISTS `wives`;
CREATE TABLE IF NOT EXISTS `wives` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `birth_date` date DEFAULT NULL,
  `age_years` int(3) UNSIGNED DEFAULT NULL,
  `family_book_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `wife_family_book` (`family_book_id`)
) ENGINE=InnoDB AUTO_INCREMENT=38 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `wives`
--

INSERT INTO `wives` (`id`, `name`, `birth_date`, `age_years`, `family_book_id`, `created_at`, `updated_at`) VALUES
(31, 'سناء', '2014-01-15', 6, 7, '2020-07-17 16:42:49', '2020-07-17 16:44:21'),
(32, 'سناء2', '2009-02-15', 11, 7, '2020-07-17 16:42:49', '2020-07-17 16:44:21'),
(33, 'أميروة1', '2020-07-12', 0, 5, '2020-07-17 16:43:23', '2020-07-17 16:44:21'),
(34, 'أميروة2', '2020-07-12', 0, 5, '2020-07-17 16:43:23', '2020-07-17 16:44:21'),
(35, 'أميرة', '1948-07-23', 72, 5, '2020-07-17 16:43:23', '2020-07-17 17:05:27'),
(36, 'أميرة', '2020-07-23', 0, 4, '2020-07-17 16:43:45', '2020-07-17 16:44:21'),
(37, 'أمير', '2020-07-12', 0, 3, '2020-07-17 16:44:05', '2020-07-17 16:44:21');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `childrens`
--
ALTER TABLE `childrens`
  ADD CONSTRAINT `children_family_book` FOREIGN KEY (`family_book_id`) REFERENCES `family_books` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `children_status` FOREIGN KEY (`status_id`) REFERENCES `children_status` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `children_status_notes`
--
ALTER TABLE `children_status_notes`
  ADD CONSTRAINT `status_notes` FOREIGN KEY (`children_status_id`) REFERENCES `children_status` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `status_notes_children` FOREIGN KEY (`children_id`) REFERENCES `childrens` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `family_books`
--
ALTER TABLE `family_books`
  ADD CONSTRAINT `family_book_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `family_books_address` FOREIGN KEY (`address_id`) REFERENCES `addresses` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `family_books_project` FOREIGN KEY (`projects_id`) REFERENCES `projects` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `family_books_residence_status` FOREIGN KEY (`residence_status_id`) REFERENCES `residence_status` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `husband_marital_status` FOREIGN KEY (`marital_status_id`) REFERENCES `marital_status` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `logs`
--
ALTER TABLE `logs`
  ADD CONSTRAINT `logs_users` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `projects`
--
ALTER TABLE `projects`
  ADD CONSTRAINT `projects_organization` FOREIGN KEY (`organization_id`) REFERENCES `organizations` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `receiving_aids`
--
ALTER TABLE `receiving_aids`
  ADD CONSTRAINT `receiving_aid_family_books` FOREIGN KEY (`family_books_id`) REFERENCES `family_books` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `receiving_aid_details`
--
ALTER TABLE `receiving_aid_details`
  ADD CONSTRAINT `details_receiving_aid` FOREIGN KEY (`receiving_aid_id`) REFERENCES `receiving_aids` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `receiving_aid_measuring_unit` FOREIGN KEY (`measuring_unit_id`) REFERENCES `measuring_units` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `receiving_scholarships`
--
ALTER TABLE `receiving_scholarships`
  ADD CONSTRAINT `receiving_scholarship_family_books` FOREIGN KEY (`family_books_id`) REFERENCES `family_books` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `receiving_scholarship_details`
--
ALTER TABLE `receiving_scholarship_details`
  ADD CONSTRAINT `details_receiving_scholarship` FOREIGN KEY (`receiving_scholarship_id`) REFERENCES `receiving_scholarships` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `receiving_scholarship_measuring_unit` FOREIGN KEY (`measuring_unit_id`) REFERENCES `measuring_units` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `role_permissions`
--
ALTER TABLE `role_permissions`
  ADD CONSTRAINT `perm_FK` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE NO ACTION,
  ADD CONSTRAINT `roles_FK` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE NO ACTION;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `user_role_FK` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE NO ACTION;

--
-- Constraints for table `visits`
--
ALTER TABLE `visits`
  ADD CONSTRAINT `visits_family_books` FOREIGN KEY (`family_books_id`) REFERENCES `family_books` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `visits_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `wives`
--
ALTER TABLE `wives`
  ADD CONSTRAINT `wife_family_book` FOREIGN KEY (`family_book_id`) REFERENCES `family_books` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
