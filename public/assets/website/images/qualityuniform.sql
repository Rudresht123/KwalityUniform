-- phpMyAdmin SQL Dump
-- version 5.2.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jul 17, 2026 at 04:21 AM
-- Server version: 8.4.7
-- PHP Version: 8.3.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `qualityuniform`
--

-- --------------------------------------------------------

--
-- Table structure for table `activity_log`
--

DROP TABLE IF EXISTS `activity_log`;
CREATE TABLE IF NOT EXISTS `activity_log` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `log_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `subject_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `subject_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `event` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `causer_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `causer_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `attribute_changes` json DEFAULT NULL,
  `properties` json DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `subject` (`subject_type`,`subject_id`),
  KEY `causer` (`causer_type`,`causer_id`),
  KEY `activity_log_log_name_index` (`log_name`)
) ENGINE=InnoDB AUTO_INCREMENT=77 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `activity_log`
--

INSERT INTO `activity_log` (`id`, `log_name`, `description`, `subject_type`, `subject_id`, `event`, `causer_type`, `causer_id`, `attribute_changes`, `properties`, `created_at`, `updated_at`) VALUES
(1, 'Permission', 'created', 'App\\Models\\RolePermission\\Permission', '1', 'created', NULL, NULL, '{\"attributes\": {\"name\": \"role.view\", \"parent_id\": null, \"group_name\": \"User Management\", \"guard_name\": \"web\", \"role_category\": \"admin\", \"permission_name\": \"View Roles\"}}', '[]', '2026-07-16 21:37:20', '2026-07-16 21:37:20'),
(2, 'Permission', 'created', 'App\\Models\\RolePermission\\Permission', '2', 'created', NULL, NULL, '{\"attributes\": {\"name\": \"role.create\", \"parent_id\": 1, \"group_name\": \"User Management\", \"guard_name\": \"web\", \"role_category\": \"admin\", \"permission_name\": \"Create Role\"}}', '[]', '2026-07-16 21:37:20', '2026-07-16 21:37:20'),
(3, 'Permission', 'created', 'App\\Models\\RolePermission\\Permission', '3', 'created', NULL, NULL, '{\"attributes\": {\"name\": \"role.edit\", \"parent_id\": 1, \"group_name\": \"User Management\", \"guard_name\": \"web\", \"role_category\": \"admin\", \"permission_name\": \"Edit Role\"}}', '[]', '2026-07-16 21:37:20', '2026-07-16 21:37:20'),
(4, 'Permission', 'created', 'App\\Models\\RolePermission\\Permission', '4', 'created', NULL, NULL, '{\"attributes\": {\"name\": \"role.delete\", \"parent_id\": 1, \"group_name\": \"User Management\", \"guard_name\": \"web\", \"role_category\": \"admin\", \"permission_name\": \"Delete Role\"}}', '[]', '2026-07-16 21:37:20', '2026-07-16 21:37:20'),
(5, 'Permission', 'created', 'App\\Models\\RolePermission\\Permission', '5', 'created', NULL, NULL, '{\"attributes\": {\"name\": \"admin.view\", \"parent_id\": null, \"group_name\": \"User Management\", \"guard_name\": \"web\", \"role_category\": \"admin\", \"permission_name\": \"View Admins\"}}', '[]', '2026-07-16 21:37:20', '2026-07-16 21:37:20'),
(6, 'Permission', 'created', 'App\\Models\\RolePermission\\Permission', '6', 'created', NULL, NULL, '{\"attributes\": {\"name\": \"admin.create\", \"parent_id\": 5, \"group_name\": \"User Management\", \"guard_name\": \"web\", \"role_category\": \"admin\", \"permission_name\": \"Create Admin\"}}', '[]', '2026-07-16 21:37:20', '2026-07-16 21:37:20'),
(7, 'Permission', 'created', 'App\\Models\\RolePermission\\Permission', '7', 'created', NULL, NULL, '{\"attributes\": {\"name\": \"admin.edit\", \"parent_id\": 5, \"group_name\": \"User Management\", \"guard_name\": \"web\", \"role_category\": \"admin\", \"permission_name\": \"Edit Admin\"}}', '[]', '2026-07-16 21:37:20', '2026-07-16 21:37:20'),
(8, 'Permission', 'created', 'App\\Models\\RolePermission\\Permission', '8', 'created', NULL, NULL, '{\"attributes\": {\"name\": \"admin.delete\", \"parent_id\": 5, \"group_name\": \"User Management\", \"guard_name\": \"web\", \"role_category\": \"admin\", \"permission_name\": \"Delete Admin\"}}', '[]', '2026-07-16 21:37:20', '2026-07-16 21:37:20'),
(9, 'Permission', 'created', 'App\\Models\\RolePermission\\Permission', '9', 'created', NULL, NULL, '{\"attributes\": {\"name\": \"user.view\", \"parent_id\": null, \"group_name\": \"User Management\", \"guard_name\": \"web\", \"role_category\": \"admin\", \"permission_name\": \"View User Status Report\"}}', '[]', '2026-07-16 21:37:20', '2026-07-16 21:37:20'),
(10, 'Permission', 'created', 'App\\Models\\RolePermission\\Permission', '10', 'created', NULL, NULL, '{\"attributes\": {\"name\": \"user.edit\", \"parent_id\": null, \"group_name\": \"User Management\", \"guard_name\": \"web\", \"role_category\": \"admin\", \"permission_name\": \"Manage User Status\"}}', '[]', '2026-07-16 21:37:20', '2026-07-16 21:37:20'),
(11, 'Permission', 'created', 'App\\Models\\RolePermission\\Permission', '11', 'created', NULL, NULL, '{\"attributes\": {\"name\": \"parent.view\", \"parent_id\": null, \"group_name\": \"Parent Management\", \"guard_name\": \"web\", \"role_category\": \"school\", \"permission_name\": \"View Parents\"}}', '[]', '2026-07-16 21:37:20', '2026-07-16 21:37:20'),
(12, 'Permission', 'created', 'App\\Models\\RolePermission\\Permission', '12', 'created', NULL, NULL, '{\"attributes\": {\"name\": \"parent.create\", \"parent_id\": 11, \"group_name\": \"Parent Management\", \"guard_name\": \"web\", \"role_category\": \"school\", \"permission_name\": \"Create Parent\"}}', '[]', '2026-07-16 21:37:20', '2026-07-16 21:37:20'),
(13, 'Permission', 'created', 'App\\Models\\RolePermission\\Permission', '13', 'created', NULL, NULL, '{\"attributes\": {\"name\": \"parent.edit\", \"parent_id\": 11, \"group_name\": \"Parent Management\", \"guard_name\": \"web\", \"role_category\": \"school\", \"permission_name\": \"Edit Parent\"}}', '[]', '2026-07-16 21:37:20', '2026-07-16 21:37:20'),
(14, 'Permission', 'created', 'App\\Models\\RolePermission\\Permission', '14', 'created', NULL, NULL, '{\"attributes\": {\"name\": \"parent.delete\", \"parent_id\": 11, \"group_name\": \"Parent Management\", \"guard_name\": \"web\", \"role_category\": \"school\", \"permission_name\": \"Delete Parent\"}}', '[]', '2026-07-16 21:37:20', '2026-07-16 21:37:20'),
(15, 'Permission', 'created', 'App\\Models\\RolePermission\\Permission', '15', 'created', NULL, NULL, '{\"attributes\": {\"name\": \"school.view\", \"parent_id\": null, \"group_name\": \"School Management\", \"guard_name\": \"web\", \"role_category\": \"admin\", \"permission_name\": \"View Schools\"}}', '[]', '2026-07-16 21:37:20', '2026-07-16 21:37:20'),
(16, 'Permission', 'created', 'App\\Models\\RolePermission\\Permission', '16', 'created', NULL, NULL, '{\"attributes\": {\"name\": \"school.create\", \"parent_id\": 15, \"group_name\": \"School Management\", \"guard_name\": \"web\", \"role_category\": \"admin\", \"permission_name\": \"Create School\"}}', '[]', '2026-07-16 21:37:20', '2026-07-16 21:37:20'),
(17, 'Permission', 'created', 'App\\Models\\RolePermission\\Permission', '17', 'created', NULL, NULL, '{\"attributes\": {\"name\": \"school.edit\", \"parent_id\": 15, \"group_name\": \"School Management\", \"guard_name\": \"web\", \"role_category\": \"admin\", \"permission_name\": \"Edit School\"}}', '[]', '2026-07-16 21:37:20', '2026-07-16 21:37:20'),
(18, 'Permission', 'created', 'App\\Models\\RolePermission\\Permission', '18', 'created', NULL, NULL, '{\"attributes\": {\"name\": \"school.delete\", \"parent_id\": 15, \"group_name\": \"School Management\", \"guard_name\": \"web\", \"role_category\": \"admin\", \"permission_name\": \"Delete School\"}}', '[]', '2026-07-16 21:37:20', '2026-07-16 21:37:20'),
(19, 'Permission', 'created', 'App\\Models\\RolePermission\\Permission', '19', 'created', NULL, NULL, '{\"attributes\": {\"name\": \"product_assignment.view\", \"parent_id\": null, \"group_name\": \"School Management\", \"guard_name\": \"web\", \"role_category\": \"admin\", \"permission_name\": \"View Product Assignments\"}}', '[]', '2026-07-16 21:37:20', '2026-07-16 21:37:20'),
(20, 'Permission', 'created', 'App\\Models\\RolePermission\\Permission', '20', 'created', NULL, NULL, '{\"attributes\": {\"name\": \"product_assignment.create\", \"parent_id\": null, \"group_name\": \"School Management\", \"guard_name\": \"web\", \"role_category\": \"admin\", \"permission_name\": \"Create Product Assignment\"}}', '[]', '2026-07-16 21:37:20', '2026-07-16 21:37:20'),
(21, 'Permission', 'created', 'App\\Models\\RolePermission\\Permission', '21', 'created', NULL, NULL, '{\"attributes\": {\"name\": \"product_assignment.delete\", \"parent_id\": null, \"group_name\": \"School Management\", \"guard_name\": \"web\", \"role_category\": \"admin\", \"permission_name\": \"Delete Product Assignment\"}}', '[]', '2026-07-16 21:37:20', '2026-07-16 21:37:20'),
(22, 'Permission', 'created', 'App\\Models\\RolePermission\\Permission', '22', 'created', NULL, NULL, '{\"attributes\": {\"name\": \"school_board.view\", \"parent_id\": null, \"group_name\": \"School Board Management\", \"guard_name\": \"web\", \"role_category\": \"admin\", \"permission_name\": \"View School Boards\"}}', '[]', '2026-07-16 21:37:20', '2026-07-16 21:37:20'),
(23, 'Permission', 'created', 'App\\Models\\RolePermission\\Permission', '23', 'created', NULL, NULL, '{\"attributes\": {\"name\": \"school_board.create\", \"parent_id\": null, \"group_name\": \"School Board Management\", \"guard_name\": \"web\", \"role_category\": \"admin\", \"permission_name\": \"Create School Board\"}}', '[]', '2026-07-16 21:37:20', '2026-07-16 21:37:20'),
(24, 'Permission', 'created', 'App\\Models\\RolePermission\\Permission', '24', 'created', NULL, NULL, '{\"attributes\": {\"name\": \"school_board.edit\", \"parent_id\": null, \"group_name\": \"School Board Management\", \"guard_name\": \"web\", \"role_category\": \"admin\", \"permission_name\": \"Edit School Board\"}}', '[]', '2026-07-16 21:37:20', '2026-07-16 21:37:20'),
(25, 'Permission', 'created', 'App\\Models\\RolePermission\\Permission', '25', 'created', NULL, NULL, '{\"attributes\": {\"name\": \"school_board.delete\", \"parent_id\": null, \"group_name\": \"School Board Management\", \"guard_name\": \"web\", \"role_category\": \"admin\", \"permission_name\": \"Delete School Board\"}}', '[]', '2026-07-16 21:37:20', '2026-07-16 21:37:20'),
(26, 'Permission', 'created', 'App\\Models\\RolePermission\\Permission', '26', 'created', NULL, NULL, '{\"attributes\": {\"name\": \"product.view\", \"parent_id\": null, \"group_name\": \"Core Product Mgmt\", \"guard_name\": \"web\", \"role_category\": null, \"permission_name\": \"View Products\"}}', '[]', '2026-07-16 21:37:20', '2026-07-16 21:37:20'),
(27, 'Permission', 'created', 'App\\Models\\RolePermission\\Permission', '27', 'created', NULL, NULL, '{\"attributes\": {\"name\": \"product.create\", \"parent_id\": 26, \"group_name\": \"Core Product Mgmt\", \"guard_name\": \"web\", \"role_category\": null, \"permission_name\": \"Create Product\"}}', '[]', '2026-07-16 21:37:20', '2026-07-16 21:37:20'),
(28, 'Permission', 'created', 'App\\Models\\RolePermission\\Permission', '28', 'created', NULL, NULL, '{\"attributes\": {\"name\": \"product.edit\", \"parent_id\": 26, \"group_name\": \"Core Product Mgmt\", \"guard_name\": \"web\", \"role_category\": null, \"permission_name\": \"Edit Product\"}}', '[]', '2026-07-16 21:37:20', '2026-07-16 21:37:20'),
(29, 'Permission', 'created', 'App\\Models\\RolePermission\\Permission', '29', 'created', NULL, NULL, '{\"attributes\": {\"name\": \"product.delete\", \"parent_id\": 26, \"group_name\": \"Core Product Mgmt\", \"guard_name\": \"web\", \"role_category\": null, \"permission_name\": \"Delete Product\"}}', '[]', '2026-07-16 21:37:20', '2026-07-16 21:37:20'),
(30, 'Permission', 'created', 'App\\Models\\RolePermission\\Permission', '30', 'created', NULL, NULL, '{\"attributes\": {\"name\": \"category.view\", \"parent_id\": null, \"group_name\": \"Product Attributes\", \"guard_name\": \"web\", \"role_category\": \"vendor\", \"permission_name\": \"View Categories\"}}', '[]', '2026-07-16 21:37:20', '2026-07-16 21:37:20'),
(31, 'Permission', 'created', 'App\\Models\\RolePermission\\Permission', '31', 'created', NULL, NULL, '{\"attributes\": {\"name\": \"category.create\", \"parent_id\": 30, \"group_name\": \"Product Attributes\", \"guard_name\": \"web\", \"role_category\": \"vendor\", \"permission_name\": \"Create Category\"}}', '[]', '2026-07-16 21:37:20', '2026-07-16 21:37:20'),
(32, 'Permission', 'created', 'App\\Models\\RolePermission\\Permission', '32', 'created', NULL, NULL, '{\"attributes\": {\"name\": \"category.edit\", \"parent_id\": 30, \"group_name\": \"Product Attributes\", \"guard_name\": \"web\", \"role_category\": \"vendor\", \"permission_name\": \"Edit Category\"}}', '[]', '2026-07-16 21:37:20', '2026-07-16 21:37:20'),
(33, 'Permission', 'created', 'App\\Models\\RolePermission\\Permission', '33', 'created', NULL, NULL, '{\"attributes\": {\"name\": \"category.delete\", \"parent_id\": 30, \"group_name\": \"Product Attributes\", \"guard_name\": \"web\", \"role_category\": \"vendor\", \"permission_name\": \"Delete Category\"}}', '[]', '2026-07-16 21:37:20', '2026-07-16 21:37:20'),
(34, 'Permission', 'created', 'App\\Models\\RolePermission\\Permission', '34', 'created', NULL, NULL, '{\"attributes\": {\"name\": \"parent-category.view\", \"parent_id\": null, \"group_name\": \"Product Attributes\", \"guard_name\": \"web\", \"role_category\": \"vendor\", \"permission_name\": \"View Parent Categories\"}}', '[]', '2026-07-16 21:37:20', '2026-07-16 21:37:20'),
(35, 'Permission', 'created', 'App\\Models\\RolePermission\\Permission', '35', 'created', NULL, NULL, '{\"attributes\": {\"name\": \"parent-category.create\", \"parent_id\": 34, \"group_name\": \"Product Attributes\", \"guard_name\": \"web\", \"role_category\": \"vendor\", \"permission_name\": \"Create Parent Category\"}}', '[]', '2026-07-16 21:37:20', '2026-07-16 21:37:20'),
(36, 'Permission', 'created', 'App\\Models\\RolePermission\\Permission', '36', 'created', NULL, NULL, '{\"attributes\": {\"name\": \"parent-category.edit\", \"parent_id\": 34, \"group_name\": \"Product Attributes\", \"guard_name\": \"web\", \"role_category\": \"vendor\", \"permission_name\": \"Edit Parent Category\"}}', '[]', '2026-07-16 21:37:20', '2026-07-16 21:37:20'),
(37, 'Permission', 'created', 'App\\Models\\RolePermission\\Permission', '37', 'created', NULL, NULL, '{\"attributes\": {\"name\": \"parent-category.delete\", \"parent_id\": 34, \"group_name\": \"Product Attributes\", \"guard_name\": \"web\", \"role_category\": \"vendor\", \"permission_name\": \"Delete Parent Category\"}}', '[]', '2026-07-16 21:37:20', '2026-07-16 21:37:20'),
(38, 'Permission', 'created', 'App\\Models\\RolePermission\\Permission', '38', 'created', NULL, NULL, '{\"attributes\": {\"name\": \"size.view\", \"parent_id\": null, \"group_name\": \"Product Attributes\", \"guard_name\": \"web\", \"role_category\": \"vendor\", \"permission_name\": \"View Sizes\"}}', '[]', '2026-07-16 21:37:20', '2026-07-16 21:37:20'),
(39, 'Permission', 'created', 'App\\Models\\RolePermission\\Permission', '39', 'created', NULL, NULL, '{\"attributes\": {\"name\": \"size.create\", \"parent_id\": 38, \"group_name\": \"Product Attributes\", \"guard_name\": \"web\", \"role_category\": \"vendor\", \"permission_name\": \"Create Size\"}}', '[]', '2026-07-16 21:37:20', '2026-07-16 21:37:20'),
(40, 'Permission', 'created', 'App\\Models\\RolePermission\\Permission', '40', 'created', NULL, NULL, '{\"attributes\": {\"name\": \"size.edit\", \"parent_id\": 38, \"group_name\": \"Product Attributes\", \"guard_name\": \"web\", \"role_category\": \"vendor\", \"permission_name\": \"Edit Size\"}}', '[]', '2026-07-16 21:37:20', '2026-07-16 21:37:20'),
(41, 'Permission', 'created', 'App\\Models\\RolePermission\\Permission', '41', 'created', NULL, NULL, '{\"attributes\": {\"name\": \"size.delete\", \"parent_id\": 38, \"group_name\": \"Product Attributes\", \"guard_name\": \"web\", \"role_category\": \"vendor\", \"permission_name\": \"Delete Size\"}}', '[]', '2026-07-16 21:37:20', '2026-07-16 21:37:20'),
(42, 'Permission', 'created', 'App\\Models\\RolePermission\\Permission', '42', 'created', NULL, NULL, '{\"attributes\": {\"name\": \"color.view\", \"parent_id\": null, \"group_name\": \"Product Attributes\", \"guard_name\": \"web\", \"role_category\": \"vendor\", \"permission_name\": \"View Colors\"}}', '[]', '2026-07-16 21:37:20', '2026-07-16 21:37:20'),
(43, 'Permission', 'created', 'App\\Models\\RolePermission\\Permission', '43', 'created', NULL, NULL, '{\"attributes\": {\"name\": \"color.create\", \"parent_id\": 42, \"group_name\": \"Product Attributes\", \"guard_name\": \"web\", \"role_category\": \"vendor\", \"permission_name\": \"Create Color\"}}', '[]', '2026-07-16 21:37:20', '2026-07-16 21:37:20'),
(44, 'Permission', 'created', 'App\\Models\\RolePermission\\Permission', '44', 'created', NULL, NULL, '{\"attributes\": {\"name\": \"color.edit\", \"parent_id\": 42, \"group_name\": \"Product Attributes\", \"guard_name\": \"web\", \"role_category\": \"vendor\", \"permission_name\": \"Edit Color\"}}', '[]', '2026-07-16 21:37:20', '2026-07-16 21:37:20'),
(45, 'Permission', 'created', 'App\\Models\\RolePermission\\Permission', '45', 'created', NULL, NULL, '{\"attributes\": {\"name\": \"color.delete\", \"parent_id\": 42, \"group_name\": \"Product Attributes\", \"guard_name\": \"web\", \"role_category\": \"vendor\", \"permission_name\": \"Delete Color\"}}', '[]', '2026-07-16 21:37:20', '2026-07-16 21:37:20'),
(46, 'Permission', 'created', 'App\\Models\\RolePermission\\Permission', '46', 'created', NULL, NULL, '{\"attributes\": {\"name\": \"stock_view\", \"parent_id\": null, \"group_name\": \"Stock Management\", \"guard_name\": \"web\", \"role_category\": \"vendor\", \"permission_name\": \"View Stock Levels\"}}', '[]', '2026-07-16 21:37:20', '2026-07-16 21:37:20'),
(47, 'Permission', 'created', 'App\\Models\\RolePermission\\Permission', '47', 'created', NULL, NULL, '{\"attributes\": {\"name\": \"stock_adjust\", \"parent_id\": null, \"group_name\": \"Stock Management\", \"guard_name\": \"web\", \"role_category\": \"vendor\", \"permission_name\": \"Adjust Stock\"}}', '[]', '2026-07-16 21:37:20', '2026-07-16 21:37:20'),
(48, 'Permission', 'created', 'App\\Models\\RolePermission\\Permission', '48', 'created', NULL, NULL, '{\"attributes\": {\"name\": \"stock_history_view\", \"parent_id\": null, \"group_name\": \"Stock Management\", \"guard_name\": \"web\", \"role_category\": \"vendor\", \"permission_name\": \"View Stock History\"}}', '[]', '2026-07-16 21:37:20', '2026-07-16 21:37:20'),
(49, 'Permission', 'created', 'App\\Models\\RolePermission\\Permission', '49', 'created', NULL, NULL, '{\"attributes\": {\"name\": \"vendor.stock.history.report\", \"parent_id\": null, \"group_name\": \"Stock Management\", \"guard_name\": \"web\", \"role_category\": \"vendor\", \"permission_name\": \"View Stock History Report\"}}', '[]', '2026-07-16 21:37:20', '2026-07-16 21:37:20'),
(50, 'Permission', 'created', 'App\\Models\\RolePermission\\Permission', '50', 'created', NULL, NULL, '{\"attributes\": {\"name\": \"product.stock_update\", \"parent_id\": null, \"group_name\": \"Stock Management\", \"guard_name\": \"web\", \"role_category\": \"vendor\", \"permission_name\": \"Update Product Stock\"}}', '[]', '2026-07-16 21:37:20', '2026-07-16 21:37:20'),
(51, 'Permission', 'created', 'App\\Models\\RolePermission\\Permission', '51', 'created', NULL, NULL, '{\"attributes\": {\"name\": \"vendor.fulfillment.view\", \"parent_id\": null, \"group_name\": \"Order Fulfillment\", \"guard_name\": \"web\", \"role_category\": \"vendor\", \"permission_name\": \"View Order Fulfillment Hub\"}}', '[]', '2026-07-16 21:37:20', '2026-07-16 21:37:20'),
(52, 'Permission', 'created', 'App\\Models\\RolePermission\\Permission', '52', 'created', NULL, NULL, '{\"attributes\": {\"name\": \"vendor.fulfillment.ship\", \"parent_id\": null, \"group_name\": \"Order Fulfillment\", \"guard_name\": \"web\", \"role_category\": \"vendor\", \"permission_name\": \"Ship Orders\"}}', '[]', '2026-07-16 21:37:20', '2026-07-16 21:37:20'),
(53, 'Permission', 'created', 'App\\Models\\RolePermission\\Permission', '53', 'created', NULL, NULL, '{\"attributes\": {\"name\": \"product_approval_view\", \"parent_id\": null, \"group_name\": \"Product Approval\", \"guard_name\": \"web\", \"role_category\": \"school\", \"permission_name\": \"View Approval Queue\"}}', '[]', '2026-07-16 21:37:20', '2026-07-16 21:37:20'),
(54, 'Permission', 'created', 'App\\Models\\RolePermission\\Permission', '54', 'created', NULL, NULL, '{\"attributes\": {\"name\": \"product_approval_action\", \"parent_id\": null, \"group_name\": \"Product Approval\", \"guard_name\": \"web\", \"role_category\": \"school\", \"permission_name\": \"Perform Approval Actions\"}}', '[]', '2026-07-16 21:37:20', '2026-07-16 21:37:20'),
(55, 'Permission', 'created', 'App\\Models\\RolePermission\\Permission', '55', 'created', NULL, NULL, '{\"attributes\": {\"name\": \"school.product.approve\", \"parent_id\": null, \"group_name\": \"Product Approval\", \"guard_name\": \"web\", \"role_category\": \"school\", \"permission_name\": \"Approve Products\"}}', '[]', '2026-07-16 21:37:20', '2026-07-16 21:37:20'),
(56, 'Permission', 'created', 'App\\Models\\RolePermission\\Permission', '56', 'created', NULL, NULL, '{\"attributes\": {\"name\": \"school.product.report\", \"parent_id\": null, \"group_name\": \"Product Approval\", \"guard_name\": \"web\", \"role_category\": \"school\", \"permission_name\": \"View Approved Products Report\"}}', '[]', '2026-07-16 21:37:20', '2026-07-16 21:37:20'),
(57, 'Permission', 'created', 'App\\Models\\RolePermission\\Permission', '57', 'created', NULL, NULL, '{\"attributes\": {\"name\": \"vendor.view\", \"parent_id\": null, \"group_name\": \"Vendor Management\", \"guard_name\": \"web\", \"role_category\": \"admin\", \"permission_name\": \"View Vendors\"}}', '[]', '2026-07-16 21:37:20', '2026-07-16 21:37:20'),
(58, 'Permission', 'created', 'App\\Models\\RolePermission\\Permission', '58', 'created', NULL, NULL, '{\"attributes\": {\"name\": \"vendor.create\", \"parent_id\": null, \"group_name\": \"Vendor Management\", \"guard_name\": \"web\", \"role_category\": \"admin\", \"permission_name\": \"Create Vendor\"}}', '[]', '2026-07-16 21:37:20', '2026-07-16 21:37:20'),
(59, 'Permission', 'created', 'App\\Models\\RolePermission\\Permission', '59', 'created', NULL, NULL, '{\"attributes\": {\"name\": \"vendor.edit\", \"parent_id\": null, \"group_name\": \"Vendor Management\", \"guard_name\": \"web\", \"role_category\": \"admin\", \"permission_name\": \"Edit Vendor\"}}', '[]', '2026-07-16 21:37:20', '2026-07-16 21:37:20'),
(60, 'Permission', 'created', 'App\\Models\\RolePermission\\Permission', '60', 'created', NULL, NULL, '{\"attributes\": {\"name\": \"vendor.delete\", \"parent_id\": null, \"group_name\": \"Vendor Management\", \"guard_name\": \"web\", \"role_category\": \"admin\", \"permission_name\": \"Delete Vendor\"}}', '[]', '2026-07-16 21:37:20', '2026-07-16 21:37:20'),
(61, 'Permission', 'created', 'App\\Models\\RolePermission\\Permission', '61', 'created', NULL, NULL, '{\"attributes\": {\"name\": \"partnership.view\", \"parent_id\": null, \"group_name\": \"Partnership Management\", \"guard_name\": \"web\", \"role_category\": \"admin\", \"permission_name\": \"View Partnership Requests\"}}', '[]', '2026-07-16 21:37:20', '2026-07-16 21:37:20'),
(62, 'Permission', 'created', 'App\\Models\\RolePermission\\Permission', '62', 'created', NULL, NULL, '{\"attributes\": {\"name\": \"partnership.approve\", \"parent_id\": null, \"group_name\": \"Partnership Management\", \"guard_name\": \"web\", \"role_category\": \"admin\", \"permission_name\": \"Approve Partnership Request\"}}', '[]', '2026-07-16 21:37:20', '2026-07-16 21:37:20'),
(63, 'Permission', 'created', 'App\\Models\\RolePermission\\Permission', '63', 'created', NULL, NULL, '{\"attributes\": {\"name\": \"partnership.reject\", \"parent_id\": null, \"group_name\": \"Partnership Management\", \"guard_name\": \"web\", \"role_category\": \"admin\", \"permission_name\": \"Reject Partnership Request\"}}', '[]', '2026-07-16 21:37:20', '2026-07-16 21:37:20'),
(64, 'Permission', 'created', 'App\\Models\\RolePermission\\Permission', '64', 'created', NULL, NULL, '{\"attributes\": {\"name\": \"audit.view\", \"parent_id\": null, \"group_name\": \"System Management\", \"guard_name\": \"web\", \"role_category\": \"admin\", \"permission_name\": \"View Audit Reports\"}}', '[]', '2026-07-16 21:37:20', '2026-07-16 21:37:20'),
(65, 'Permission', 'created', 'App\\Models\\RolePermission\\Permission', '65', 'created', NULL, NULL, '{\"attributes\": {\"name\": \"global_settings.view\", \"parent_id\": null, \"group_name\": \"System Management\", \"guard_name\": \"web\", \"role_category\": \"admin\", \"permission_name\": \"View Global Settings\"}}', '[]', '2026-07-16 21:37:20', '2026-07-16 21:37:20'),
(66, 'Permission', 'created', 'App\\Models\\RolePermission\\Permission', '66', 'created', NULL, NULL, '{\"attributes\": {\"name\": \"global_settings.edit\", \"parent_id\": null, \"group_name\": \"System Management\", \"guard_name\": \"web\", \"role_category\": \"admin\", \"permission_name\": \"Edit Global Settings\"}}', '[]', '2026-07-16 21:37:20', '2026-07-16 21:37:20'),
(67, 'User', 'created', 'App\\Models\\User', '1', 'created', NULL, NULL, '{\"attributes\": {\"name\": \"Super Admin\", \"email\": \"rudershtiwari8@gmail.com\", \"phone\": \"9999999999\", \"avatar\": null, \"image_id\": null, \"logo_url\": null, \"password\": \"$2y$12$mUhJ78YKIdyMgblY65j/kuX6KbGZShRBn4De9Y4KSGYfDi8Da4022\", \"username\": null, \"is_active\": 1}}', '[]', '2026-07-16 21:37:21', '2026-07-16 21:37:21'),
(68, 'NotificationTemplate', 'created', 'App\\Models\\NotificationTemplate', '1', 'created', NULL, NULL, '{\"attributes\": {\"key\": \"product_approved\", \"icon\": \"ti-circle-check-filled\", \"type\": \"success\", \"title\": \"Product Approved\", \"message\": \"Congratulations! Your product \\\"{product_name}\\\" has been approved and is now available for customers.\", \"channels\": \"[\\\"database\\\",\\\"broadcast\\\",\\\"mail\\\"]\", \"created_by\": null, \"updated_by\": null}}', '[]', '2026-07-16 21:37:21', '2026-07-16 21:37:21'),
(69, 'NotificationTemplate', 'created', 'App\\Models\\NotificationTemplate', '2', 'created', NULL, NULL, '{\"attributes\": {\"key\": \"product_rejected\", \"icon\": \"ti-circle-x-filled\", \"type\": \"danger\", \"title\": \"Product Rejected\", \"message\": \"Your product \\\"{product_name}\\\" was rejected. Reason: {admin_message}\", \"channels\": \"[\\\"database\\\",\\\"broadcast\\\",\\\"mail\\\"]\", \"created_by\": null, \"updated_by\": null}}', '[]', '2026-07-16 21:37:21', '2026-07-16 21:37:21'),
(70, 'NotificationTemplate', 'created', 'App\\Models\\NotificationTemplate', '3', 'created', NULL, NULL, '{\"attributes\": {\"key\": \"product_status_updated\", \"icon\": \"ti-refresh\", \"type\": \"info\", \"title\": \"Product Status Updated\", \"message\": \"The status of your product \\\"{product_name}\\\" has been changed to {status}. {admin_message}\", \"channels\": \"[\\\"database\\\",\\\"broadcast\\\",\\\"mail\\\"]\", \"created_by\": null, \"updated_by\": null}}', '[]', '2026-07-16 21:37:21', '2026-07-16 21:37:21'),
(71, 'NotificationTemplate', 'created', 'App\\Models\\NotificationTemplate', '4', 'created', NULL, NULL, '{\"attributes\": {\"key\": \"product_resubmitted\", \"icon\": \"ti-refresh-alert\", \"type\": \"warning\", \"title\": \"Product Resubmitted\", \"message\": \"Your product \\\"{product_name}\\\" has been resubmitted for approval.\", \"channels\": \"[\\\"database\\\",\\\"broadcast\\\"]\", \"created_by\": null, \"updated_by\": null}}', '[]', '2026-07-16 21:37:21', '2026-07-16 21:37:21'),
(72, 'NotificationTemplate', 'created', 'App\\Models\\NotificationTemplate', '5', 'created', NULL, NULL, '{\"attributes\": {\"key\": \"product_approval_request\", \"icon\": \"ti-clock-hour-4\", \"type\": \"info\", \"title\": \"New Product Awaiting Approval\", \"message\": \"A new product \\\"{product_name}\\\" has been submitted by {vendor_name} and is awaiting approval.\", \"channels\": \"[\\\"database\\\",\\\"broadcast\\\"]\", \"created_by\": null, \"updated_by\": null}}', '[]', '2026-07-16 21:37:21', '2026-07-16 21:37:21'),
(73, 'NotificationTemplate', 'created', 'App\\Models\\NotificationTemplate', '6', 'created', NULL, NULL, '{\"attributes\": {\"key\": \"low_stock\", \"icon\": \"ti-alert-triangle\", \"type\": \"warning\", \"title\": \"Low Stock Alert\", \"message\": \"Product \\\"{product_name}\\\" stock is below the minimum threshold.\", \"channels\": \"[\\\"database\\\",\\\"broadcast\\\"]\", \"created_by\": null, \"updated_by\": null}}', '[]', '2026-07-16 21:37:21', '2026-07-16 21:37:21'),
(74, 'NotificationTemplate', 'created', 'App\\Models\\NotificationTemplate', '7', 'created', NULL, NULL, '{\"attributes\": {\"key\": \"out_of_stock\", \"icon\": \"ti-package-off\", \"type\": \"danger\", \"title\": \"Out of Stock\", \"message\": \"Product \\\"{product_name}\\\" is currently out of stock.\", \"channels\": \"[\\\"database\\\",\\\"broadcast\\\",\\\"mail\\\"]\", \"created_by\": null, \"updated_by\": null}}', '[]', '2026-07-16 21:37:21', '2026-07-16 21:37:21'),
(75, 'NotificationTemplate', 'created', 'App\\Models\\NotificationTemplate', '8', 'created', NULL, NULL, '{\"attributes\": {\"key\": \"school_product_approved\", \"icon\": \"ti-school\", \"type\": \"success\", \"title\": \"School Product Approval\", \"message\": \"School \\\"{school_name}\\\" has approved product \\\"{product_name}\\\" (Code: {product_code}) for their official catalogue.\", \"channels\": \"[\\\"database\\\",\\\"broadcast\\\",\\\"mail\\\"]\", \"created_by\": null, \"updated_by\": null}}', '[]', '2026-07-16 21:37:21', '2026-07-16 21:37:21'),
(76, 'NotificationTemplate', 'created', 'App\\Models\\NotificationTemplate', '9', 'created', NULL, NULL, '{\"attributes\": {\"key\": \"stock_replenished\", \"icon\": \"ti-package\", \"type\": \"success\", \"title\": \"Stock Replenished\", \"message\": \"Inventory has been replenished for \\\"{product_name}\\\".\", \"channels\": \"[\\\"database\\\",\\\"broadcast\\\"]\", \"created_by\": null, \"updated_by\": null}}', '[]', '2026-07-16 21:37:21', '2026-07-16 21:37:21');

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

DROP TABLE IF EXISTS `cache`;
CREATE TABLE IF NOT EXISTS `cache` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` bigint NOT NULL,
  PRIMARY KEY (`key`),
  KEY `cache_expiration_index` (`expiration`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

DROP TABLE IF EXISTS `cache_locks`;
CREATE TABLE IF NOT EXISTS `cache_locks` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` bigint NOT NULL,
  PRIMARY KEY (`key`),
  KEY `cache_locks_expiration_index` (`expiration`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `carts`
--

DROP TABLE IF EXISTS `carts`;
CREATE TABLE IF NOT EXISTS `carts` (
  `cart_id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `school_id` char(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `session_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` enum('active','converted','abandoned','completed') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'active',
  `converted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`cart_id`),
  KEY `carts_school_id_foreign` (`school_id`),
  KEY `carts_user_id_status_index` (`user_id`,`status`),
  KEY `carts_session_id_index` (`session_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `carts`
--

INSERT INTO `carts` (`cart_id`, `user_id`, `school_id`, `session_id`, `status`, `converted_at`, `created_at`, `updated_at`) VALUES
('a19cb035-008e-4be6-a694-ddd627ffa000', NULL, NULL, 'Rm6inL9xulBiMzVvIjXDtpP1b5JROqkT7nyKnWpO', 'active', NULL, '2026-07-16 21:39:10', '2026-07-16 21:39:10');

-- --------------------------------------------------------

--
-- Table structure for table `cart_items`
--

DROP TABLE IF EXISTS `cart_items`;
CREATE TABLE IF NOT EXISTS `cart_items` (
  `cart_item_id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cart_id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `variant_id` char(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `vendor_id` char(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `quantity` int UNSIGNED NOT NULL DEFAULT '1',
  `unit_price` decimal(10,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`cart_item_id`),
  UNIQUE KEY `cart_items_cart_id_variant_id_unique` (`cart_id`,`variant_id`),
  KEY `cart_items_product_id_foreign` (`product_id`),
  KEY `cart_items_variant_id_foreign` (`variant_id`),
  KEY `cart_items_vendor_id_foreign` (`vendor_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

DROP TABLE IF EXISTS `categories`;
CREATE TABLE IF NOT EXISTS `categories` (
  `category_id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `vendor_id` char(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `parent_id` char(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `category_name` varchar(80) COLLATE utf8mb4_unicode_ci NOT NULL,
  `requires_size` tinyint(1) NOT NULL DEFAULT '1',
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_by` bigint UNSIGNED DEFAULT NULL,
  `updated_by` bigint UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`category_id`),
  KEY `categories_parent_id_foreign` (`parent_id`),
  KEY `categories_vendor_id_index` (`vendor_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `colors`
--

DROP TABLE IF EXISTS `colors`;
CREATE TABLE IF NOT EXISTS `colors` (
  `color_id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `vendor_id` char(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `color_name` varchar(40) COLLATE utf8mb4_unicode_ci NOT NULL,
  `hex_code` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_by` bigint UNSIGNED NOT NULL,
  `updated_by` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`color_id`),
  KEY `colors_created_by_foreign` (`created_by`),
  KEY `colors_updated_by_foreign` (`updated_by`),
  KEY `colors_vendor_id_index` (`vendor_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `contact_messages`
--

DROP TABLE IF EXISTS `contact_messages`;
CREATE TABLE IF NOT EXISTS `contact_messages` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `full_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `subject` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `message` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `coupons`
--

DROP TABLE IF EXISTS `coupons`;
CREATE TABLE IF NOT EXISTS `coupons` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `discount_type` enum('fixed','percentage') COLLATE utf8mb4_unicode_ci NOT NULL,
  `discount_value` decimal(10,2) NOT NULL,
  `minimum_order_amount` decimal(10,2) NOT NULL DEFAULT '0.00',
  `maximum_discount_amount` decimal(10,2) DEFAULT NULL,
  `usage_limit` int UNSIGNED DEFAULT NULL,
  `usage_per_user` int UNSIGNED NOT NULL DEFAULT '1',
  `starts_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `coupons_code_unique` (`code`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `coupon_usages`
--

DROP TABLE IF EXISTS `coupon_usages`;
CREATE TABLE IF NOT EXISTS `coupon_usages` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `coupon_id` bigint UNSIGNED NOT NULL,
  `order_id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `discount_amount` decimal(10,2) NOT NULL,
  `used_at` timestamp NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `coupon_usages_coupon_id_order_id_unique` (`coupon_id`,`order_id`),
  KEY `coupon_usages_order_id_foreign` (`order_id`),
  KEY `coupon_usages_user_id_foreign` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `couriers`
--

DROP TABLE IF EXISTS `couriers`;
CREATE TABLE IF NOT EXISTS `couriers` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `api_integration_key` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `contact_person` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `email_logs`
--

DROP TABLE IF EXISTS `email_logs`;
CREATE TABLE IF NOT EXISTS `email_logs` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `template_key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `recipient` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `subject` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('success','failed') COLLATE utf8mb4_unicode_ci NOT NULL,
  `error_message` longtext COLLATE utf8mb4_unicode_ci,
  `sent_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `email_templates`
--

DROP TABLE IF EXISTS `email_templates`;
CREATE TABLE IF NOT EXISTS `email_templates` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `template_key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `template_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `subject` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `body` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `available_placeholders` text COLLATE utf8mb4_unicode_ci,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email_templates_template_key_unique` (`template_key`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `email_templates`
--

INSERT INTO `email_templates` (`id`, `template_key`, `template_name`, `subject`, `body`, `available_placeholders`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 'welcome_registration', 'Welcome Registration', '🎉 Welcome to eSchoolKart', '\n\n<h2>🎉 Welcome to eSchoolKart</h2>\n\n<p>Hello <strong>{user_name}</strong>,</p>\n\n<p>\nThank you for registering with eSchoolKart.\n</p>\n\n<p>\nYour account has been created successfully and you are now ready to access our School Uniform ERP platform.\n</p>\n\n<p>\nWith eSchoolKart, you can:\n</p>\n\n<ul>\n    <li>Manage Uniform Orders</li>\n    <li>Track Inventory</li>\n    <li>Manage Schools & Students</li>\n    <li>Monitor Payments</li>\n    <li>Generate Reports</li>\n</ul>\n\n<p>\nClick the button below to access your account:\n</p>\n\n<p>\n{login_button}\n</p>\n\n<p>\nThank you for choosing eSchoolKart.\n</p>\n\n<p>\nBest Regards,<br>\n<strong>eSchoolKart Team</strong>\n</p>\n\n', 'user_name,login_button', 1, '2026-07-16 21:36:00', '2026-07-16 21:36:00'),
(2, 'otp_verification', 'OTP Verification', '🔐 Verify Your Email Address', '\n\n<h2>🔐 Email Verification</h2>\n\n<p>Hello <strong>{user_name}</strong>,</p>\n\n<p>\nUse the following One-Time Password (OTP) to verify your email address:\n</p>\n\n<div style=\"\nbackground:#f3f4f6;\npadding:20px;\ntext-align:center;\nfont-size:32px;\nfont-weight:bold;\nletter-spacing:8px;\nborder-radius:8px;\nmargin:20px 0;\n\">\n{otp}\n</div>\n\n<p>\nThis OTP will expire in <strong>{expiry_minutes} minutes</strong>.\n</p>\n\n<p>\nIf you did not request this verification, please ignore this email.\n</p>\n\n<p>\nThank you,<br>\n<strong>eSchoolKart Team</strong>\n</p>\n\n', 'user_name,otp,expiry_minutes', 1, '2026-07-16 21:36:00', '2026-07-16 21:36:00'),
(3, 'forgot_password', 'Forgot Password', '🔑 Reset Your Password', '\n\n<h2>🔑 Password Reset Request</h2>\n\n<p>Hello <strong>{user_name}</strong>,</p>\n\n<p>\nWe received a request to reset the password associated with your eSchoolKart account.\n</p>\n\n<p>\nTo continue, click the button below:\n</p>\n\n<p>\n{reset_button}\n</p>\n\n<p>\nThis password reset link will expire on <strong>{expiry_date}</strong>.\n</p>\n\n<p>\nIf you did not request a password reset, no further action is required.\n</p>\n\n<p>\nFor your security, never share your account credentials with anyone.\n</p>\n\n<p>\nRegards,<br>\n<strong>eSchoolKart Team</strong>\n</p>\n\n', 'user_name,reset_button,expiry_date', 1, '2026-07-16 21:36:00', '2026-07-16 21:36:00'),
(4, 'vendor_registration', 'Vendor Registration Congratulations', '🎉 Congratulations, {business_name}! Your vendor account is ready', '\n\n<h2>🎉 Congratulations, {business_name}!</h2>\n\n<p>Dear <strong>{owner_name}</strong>,</p>\n\n<p>\nYour vendor account has been successfully registered with eSchoolKart. We are thrilled to welcome you to our school uniform and supplier platform.\n</p>\n\n<p>\nHere are the details of your registration:\n</p>\n\n<ul>\n    <li><strong>Business Name:</strong> {business_name}</li>\n    <li><strong>Owner Name:</strong> {owner_name}</li>\n    <li><strong>Status:</strong> {status}</li>\n</ul>\n\n<p>\nYou can now manage your vendor profile, track orders, and collaborate with schools through the eSchoolKart dashboard.\n</p>\n\n<p>\n{login_button}\n</p>\n\n<p>\nIf you need any help, feel free to reach out to our support team.\n</p>\n\n<p>\nWarm regards,<br>\n<strong>eSchoolKart Team</strong>\n</p>\n\n', 'business_name,owner_name,status,login_button', 1, '2026-07-16 21:36:00', '2026-07-16 21:36:00'),
(5, 'school_registration', 'School Registration Congratulations', '🎉 Welcome {school_name} to eSchoolKart!', '\n                <h2>🎉 Welcome to eSchoolKart!</h2>\n                <p>Dear <strong>{principal_name}</strong>,</p>\n                <p>\n                Your school <strong>{school_name}</strong> has been successfully registered with eSchoolKart. We are excited to have you on board.\n                </p>\n                <p>\n                Registration Details:\n                </p>\n                <ul>\n                <li><strong>School Name:</strong> {school_name}</li>\n                <li><strong>Principal Name:</strong> {principal_name}</li>\n                <li><strong>Status:</strong> {status}</li>\n                </ul>\n                <p>\n                You can now manage your school profile, uniforms, and student orders through the eSchoolKart dashboard.\n                </p>\n                <p>\n                {login_button}\n                </p>\n                <p>\n                If you have any questions, please feel free to contact our support team.\n                </p>\n                <p>\n                Best Regards,<br>\n                <strong>eSchoolKart Team</strong>\n                </p>\n                ', 'school_name,principal_name,status,login_button', 1, '2026-07-16 21:36:01', '2026-07-16 21:36:01'),
(6, 'product_approval_request', 'Product Approval Request', '🔔 Action Required: New Product Approval Request - {product_name}', '\n<h2>Product Approval Request</h2>\n<p>Hello Admin,</p>\n<p>A new product has been submitted for approval by <strong>{vendor_name}</strong>.</p>\n<p><strong>Product Details:</strong></p>\n<ul>\n    <li><strong>Name:</strong> {product_name}</li>\n    <li><strong>Code:</strong> {product_code}</li>\n    <li><strong>Category:</strong> {category_name}</li>\n</ul>\n<p>Please log in to the admin dashboard to review and approve/reject this product.</p>\n<p>{view_button}</p>\n<p>Best Regards,<br><strong>QualityUniform Team</strong></p>\n', 'product_name,product_code,vendor_name,category_name,view_button', 1, '2026-07-16 21:36:02', '2026-07-16 21:36:02'),
(7, 'product_status_updated', 'Product Status Updated', 'Update: Your Product {product_name} has been {status}', '\n<h2>Product Status Update</h2>\n<p>Dear {vendor_name},</p>\n<p>The status of your product <strong>{product_name}</strong> ({product_code}) has been updated to: <strong>{status}</strong>.</p>\n<p><strong>Message from Admin:</strong> {admin_message}</p>\n<p>Log in to your dashboard to view more details.</p>\n<p>{view_button}</p>\n<p>Best Regards,<br><strong>QualityUniform Team</strong></p>\n', 'product_name,product_code,vendor_name,status,admin_message,view_button', 1, '2026-07-16 21:36:02', '2026-07-16 21:36:02'),
(8, 'partnership_request_admin', 'School Partnership Admin Notification', '🔔 New School Partnership Request: {school_name}', '\n                    <h2>🔔 New School Partnership Request</h2>\n                    <p>A new institution has applied to become an official partner.</p>\n                    <div style=\"background: #f8fafc; padding: 20px; border-radius: 8px; border: 1px solid #e2e8f0;\">\n                        <p><strong>School Name:</strong> {school_name}</p>\n                        <p><strong>Contact Person:</strong> {contact_person}</p>\n                        <p><strong>Email:</strong> {email}</p>\n                        <p><strong>Phone:</strong> {phone}</p>\n                    </div>\n                    <p>Please review the application in the admin dashboard to proceed with onboarding.</p>\n                    <p>Best Regards,<br><strong>System Notification</strong></p>\n                ', 'school_name,contact_person,email,phone', 1, '2026-07-16 21:36:05', '2026-07-16 21:36:05'),
(9, 'partnership_request_user', 'School Partnership User Confirmation', '🤝 Thank you for your partnership interest, {school_name}!', '\n                    <h2>🤝 Partnership Request Received</h2>\n                    <p>Hello <strong>{contact_person}</strong>,</p>\n                    <p>Thank you for reaching out to eSchoolKart. We have received your request to register <strong>{school_name}</strong> as an official partner institution.</p>\n                    <p>Our Institutional Onboarding Team is reviewing your details. A partnership manager will contact you within 24 hours to schedule a virtual portal demo and garment sample validation.</p>\n                    <p>We look forward to bringing a seamless uniform shopping experience to your students and parents.</p>\n                    <p>Best Regards,<br><strong>eSchoolKart Team</strong></p>\n                ', 'school_name,contact_person', 1, '2026-07-16 21:36:05', '2026-07-16 21:36:05'),
(10, 'vendor_request_admin', 'Vendor Application Admin Notification', '📦 New Vendor Application: {company_name}', '\n                    <h2>📦 New Vendor Application</h2>\n                    <p>A new supplier has applied to join the eSchoolKart marketplace.</p>\n                    <div style=\"background: #f8fafc; padding: 20px; border-radius: 8px; border: 1px solid #e2e8f0;\">\n                        <p><strong>Company Name:</strong> {company_name}</p>\n                        <p><strong>Product Category:</strong> {category}</p>\n                        <p><strong>Email:</strong> {email}</p>\n                        <p><strong>GSTIN:</strong> {gstin}</p>\n                    </div>\n                    <p>Please verify the GST credentials and company profile in the admin dashboard.</p>\n                    <p>Best Regards,<br><strong>System Notification</strong></p>\n                ', 'company_name,category,email,gstin', 1, '2026-07-16 21:36:05', '2026-07-16 21:36:05'),
(11, 'vendor_request_user', 'Vendor Application User Confirmation', '📦 Application Received: {company_name}', '\n                    <h2>📦 Vendor Application Received</h2>\n                    <p>Hello,</p>\n                    <p>Thank you for applying to become an authorized supplier on eSchoolKart. We have received your application for <strong>{company_name}</strong>.</p>\n                    <p>Our Merchant Desk is currently reviewing your tax status and GST credentials. You can expect an update regarding your application status within 2 business days.</p>\n                    <p>If you have any questions in the meantime, please feel free to reply to this email.</p>\n                    <p>Best Regards,<br><strong>eSchoolKart Team</strong></p>\n                ', 'company_name', 1, '2026-07-16 21:36:05', '2026-07-16 21:36:05'),
(12, 'welcome_parent', 'Welcome Parent', '🎉 Welcome to eSchoolKart, {user_name}!', '\r\n                    <h2>🎉 Welcome to eSchoolKart!</h2>\r\n                    <p>Hello <strong>{user_name}</strong>,</p>\r\n                    <p>Thank you for registering with eSchoolKart. We are excited to have you join our community!</p>\r\n                    <p>You can now easily browse and order school uniforms for your children, track your orders, and manage your wishlist all in one place.</p>\r\n                    <p><strong>Get started now:</strong><br>\r\n                    {login_button}</p>\r\n                    <p>If you have any questions, feel free to contact our support team.</p>\r\n                    <p>Best Regards,<br><strong>eSchoolKart Team</strong></p>\r\n                ', 'user_name,login_button', 1, '2026-07-16 21:37:21', '2026-07-16 21:37:21'),
(13, 'order_confirmed_user', 'Order Confirmation (User)', '📦 Order Confirmed! Your order #{order_number} is placed', '\r\n                    <h2>📦 Order Confirmed!</h2>\r\n                    <p>Hello <strong>{user_name}</strong>,</p>\r\n                    <p>Great news! Your order <strong>#{order_number}</strong> has been successfully placed.</p>\r\n                    <p><strong>Order Summary:</strong><br>\r\n                    Total Amount: <strong>₹{total_amount}</strong></p>\r\n                    <p>We have attached the invoice for your order to this email.</p>\r\n                    <p>You can track your order status through your dashboard.</p>\r\n                    <p>Thank you for shopping with us!<br><strong>eSchoolKart Team</strong></p>\r\n                ', 'user_name,order_number,total_amount', 1, '2026-07-16 21:37:21', '2026-07-16 21:37:21'),
(14, 'order_confirmed_school', 'Order Confirmation (School)', '🔔 New Order Notification for School: #{order_number}', '\r\n                    <h2>🔔 New Order Received</h2>\r\n                    <p>Dear <strong>{school_name}</strong>,</p>\r\n                    <p>A new order <strong>#{order_number}</strong> has been placed by <strong>{user_name}</strong>.</p>\r\n                    <p><strong>Order Details:</strong><br>\r\n                    Total Amount: <strong>₹{total_amount}</strong></p>\r\n                    <p>Please review the order and proceed with the necessary approvals/coordination.</p>\r\n                    <p>The detailed invoice is attached to this email.</p>\r\n                    <p>Best Regards,<br><strong>eSchoolKart Team</strong></p>\r\n                ', 'school_name,order_number,user_name,total_amount', 1, '2026-07-16 21:37:21', '2026-07-16 21:37:21'),
(15, 'order_confirmed_vendor', 'Order Confirmation (Vendor)', '🚚 New Order for Fulfillment: #{order_number}', '\r\n                    <h2>🚚 New Order for Fulfillment</h2>\r\n                    <p>Dear <strong>{vendor_name}</strong>,</p>\r\n                    <p>You have a new order to fulfill: <strong>#{order_number}</strong>.</p>\r\n                    <p><strong>Customer:</strong> {user_name}<br>\r\n                    <strong>Total Order Value:</strong> ₹{total_amount}</p>\r\n                    <p>Please check your vendor dashboard to see the items assigned to you and start the fulfillment process.</p>\r\n                    <p>The full order invoice is attached for your reference.</p>\r\n                    <p>Best Regards,<br><strong>eSchoolKart Team</strong></p>\r\n                ', 'vendor_name,order_number,user_name,total_amount', 1, '2026-07-16 21:37:21', '2026-07-16 21:37:21');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
CREATE TABLE IF NOT EXISTS `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`),
  KEY `failed_jobs_connection_queue_failed_at_index` (`connection`,`queue`,`failed_at`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `files`
--

DROP TABLE IF EXISTS `files`;
CREATE TABLE IF NOT EXISTS `files` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `file_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `file_path` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `disk` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'public',
  `mime_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `file_size` bigint UNSIGNED DEFAULT NULL,
  `extension` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `files_file_path_index` (`file_path`),
  KEY `files_disk_index` (`disk`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `global_settings`
--

DROP TABLE IF EXISTS `global_settings`;
CREATE TABLE IF NOT EXISTS `global_settings` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` text COLLATE utf8mb4_unicode_ci,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `global_settings_key_unique` (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `invoices`
--

DROP TABLE IF EXISTS `invoices`;
CREATE TABLE IF NOT EXISTS `invoices` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `order_id` bigint UNSIGNED NOT NULL,
  `invoice_number` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `invoice_file` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `generated_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `invoices_invoice_number_unique` (`invoice_number`),
  KEY `invoices_order_id_foreign` (`order_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

DROP TABLE IF EXISTS `jobs`;
CREATE TABLE IF NOT EXISTS `jobs` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` smallint UNSIGNED NOT NULL,
  `reserved_at` int UNSIGNED DEFAULT NULL,
  `available_at` int UNSIGNED NOT NULL,
  `created_at` int UNSIGNED NOT NULL,
  PRIMARY KEY (`id`),
  KEY `jobs_queue_index` (`queue`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

DROP TABLE IF EXISTS `job_batches`;
CREATE TABLE IF NOT EXISTS `job_batches` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int NOT NULL,
  `pending_jobs` int NOT NULL,
  `failed_jobs` int NOT NULL,
  `failed_job_ids` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext COLLATE utf8mb4_unicode_ci,
  `cancelled_at` int DEFAULT NULL,
  `created_at` int NOT NULL,
  `finished_at` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `mail_settings`
--

DROP TABLE IF EXISTS `mail_settings`;
CREATE TABLE IF NOT EXISTS `mail_settings` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `mail_mailer` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'smtp',
  `mail_host` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mail_port` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mail_username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mail_password` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `mail_encryption` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mail_from_address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mail_from_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=86 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2026_06_06_051222_create_files_table', 1),
(5, '2026_06_06_131618_create_email_templates_table', 1),
(6, '2026_06_06_131627_create_mail_settings_table', 1),
(7, '2026_06_06_131632_create_email_logs_table', 1),
(8, '2026_06_06_133057_seed_default_email_templates', 1),
(9, '2026_06_11_174657_create_vendors_table', 1),
(10, '2026_06_12_000000_alter_vendors_bank_account_no_length', 1),
(11, '2026_06_13_072526_schools', 1),
(12, '2026_06_13_073741_create_user_otps_table', 1),
(13, '2026_06_13_094318_create_permission_tables', 1),
(14, '2026_06_13_110000_seed_school_email_template', 1),
(15, '2026_06_14_071406_add_username_to_users_table', 1),
(16, '2026_06_14_074459_create_activity_log_table', 1),
(17, '2026_06_14_075808_change_activity_log_ids_to_uuid_compatible', 1),
(18, '2026_06_14_092528_add_avatar_to_users_table', 1),
(19, '2026_06_14_122135_create_categories_table', 1),
(20, '2026_06_14_131206_create_parent_categories_table', 1),
(21, '2026_06_14_131323_update_categories_table_for_dynamic_parents', 1),
(22, '2026_06_16_024030_create_sizes_table', 1),
(23, '2026_06_16_024031_create_colors_table', 1),
(24, '2026_06_16_030800_create_products_table', 1),
(25, '2026_06_16_031741_seed_product_email_templates', 1),
(26, '2026_06_16_031742_create_notifications_table', 1),
(27, '2026_06_17_175716_create_product_variants_table', 1),
(28, '2026_06_17_181408_add_image_url_to_products_table', 1),
(29, '2026_06_17_181749_create_product_images_table', 1),
(30, '2026_06_17_181750_remove_image_url_from_products_table', 1),
(31, '2026_06_21_165555_create_notification_templates_table', 1),
(32, '2026_06_23_185423_add_approval_tracking_to_products_table', 1),
(33, '2026_06_23_185423_create_product_approval_histories_table', 1),
(34, '2026_06_23_192139_add_notification_tracking_to_product_variants_table', 1),
(35, '2026_06_23_192139_create_stock_adjustments_table', 1),
(36, '2026_06_25_181257_create_school_product_approvals_table', 1),
(37, '2026_06_27_174956_add_seo_fields_to_products_table', 1),
(38, '2026_06_27_180415_create_global_settings_table', 1),
(39, '2026_06_28_000000_create_web_users_table', 1),
(40, '2026_06_28_065942_create_school_product_class_approvals_table', 1),
(41, '2026_06_28_072304_create_product_assignments_table', 1),
(42, '2026_06_28_130506_create_school_types_table', 1),
(43, '2026_06_28_130907_add_school_type_id_to_schools_table', 1),
(44, '2026_06_28_180253_add_image_id_to_users_vendors_schools_tables', 1),
(45, '2026_07_01_000000_create_delivery_system_tables', 1),
(46, '2026_07_03_183652_seed_partnership_email_templates', 1),
(47, '2026_07_03_183922_create_school_partnership_requests_table', 1),
(48, '2026_07_03_183952_create_vendor_partnership_requests_table', 1),
(49, '2026_07_03_184657_add_document_to_partnership_requests', 1),
(50, '2026_07_04_192601_add_details_to_partnership_requests_table', 1),
(51, '2026_07_05_063451_create_carts_table', 1),
(52, '2026_07_05_063459_create_cart_items_table', 1),
(53, '2026_07_05_063515_create_wishlists_table', 1),
(54, '2026_07_05_063524_create_wishlist_items_table', 1),
(55, '2026_07_05_063534_create_orders_table', 1),
(56, '2026_07_05_063542_create_order_items_table', 1),
(57, '2026_07_05_063551_create_order_addresses_table', 1),
(58, '2026_07_05_063600_create_order_status_histories_table', 1),
(59, '2026_07_05_063609_create_payments_table', 1),
(60, '2026_07_05_063627_create_shipment_tracking_histories_table', 1),
(61, '2026_07_05_063636_create_coupons_table', 1),
(62, '2026_07_05_063643_create_coupon_usages_table', 1),
(63, '2026_07_05_063654_create_return_policies_table', 1),
(64, '2026_07_05_063703_create_return_reasons_table', 1),
(65, '2026_07_05_063710_create_returns_table', 1),
(66, '2026_07_05_063718_create_return_items_table', 1),
(67, '2026_07_05_063726_create_return_item_images_table', 1),
(68, '2026_07_05_063734_create_refunds_table', 1),
(69, '2026_07_05_063747_create_store_credits_table', 1),
(70, '2026_07_05_063755_create_return_shipments_table', 1),
(71, '2026_07_05_063804_create_product_reviews_table', 1),
(72, '2026_07_05_063812_create_order_notes_table', 1),
(73, '2026_07_05_063820_create_invoices_table', 1),
(74, '2026_07_06_000000_add_role_category_and_parent_to_permissions_table', 1),
(75, '2026_07_06_000001_add_role_category_to_roles_table', 1),
(76, '2026_07_06_000002_seed_permission_role_categories', 1),
(77, '2026_07_07_164637_create_delivery_system_tables', 1),
(78, '2026_07_07_164922_add_delivery_fields_to_orders_table', 1),
(79, '2026_07_07_172202_make_user_id_nullable_in_carts_table', 1),
(80, '2026_07_09_164458_create_user_recently_viewed_table', 1),
(81, '2026_07_10_200505_create_contact_messages_table', 1),
(82, '2026_07_11_165421_create_order_product_snapshots_table', 1),
(83, '2026_07_11_175825_add_vendor_id_to_shipments_table', 1),
(84, '2026_07_13_175946_add_vendor_id_to_attribute_tables', 1),
(85, '2026_07_14_201115_add_vendor_price_to_product_variants_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `model_has_permissions`
--

DROP TABLE IF EXISTS `model_has_permissions`;
CREATE TABLE IF NOT EXISTS `model_has_permissions` (
  `permission_id` bigint UNSIGNED NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint UNSIGNED NOT NULL,
  PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `model_has_roles`
--

DROP TABLE IF EXISTS `model_has_roles`;
CREATE TABLE IF NOT EXISTS `model_has_roles` (
  `role_id` bigint UNSIGNED NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint UNSIGNED NOT NULL,
  PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `model_has_roles`
--

INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
(1, 'App\\Models\\User', 1);

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

DROP TABLE IF EXISTS `notifications`;
CREATE TABLE IF NOT EXISTS `notifications` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `notifiable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `notifiable_id` bigint UNSIGNED NOT NULL,
  `data` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `read_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `notifications_notifiable_type_notifiable_id_index` (`notifiable_type`,`notifiable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `notification_templates`
--

DROP TABLE IF EXISTS `notification_templates`;
CREATE TABLE IF NOT EXISTS `notification_templates` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `message` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'info',
  `icon` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `channels` json DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_by` bigint UNSIGNED DEFAULT NULL,
  `updated_by` bigint UNSIGNED DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `notification_templates_key_unique` (`key`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `notification_templates`
--

INSERT INTO `notification_templates` (`id`, `key`, `title`, `message`, `type`, `icon`, `channels`, `is_active`, `created_by`, `updated_by`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'product_approved', 'Product Approved', 'Congratulations! Your product \"{product_name}\" has been approved and is now available for customers.', 'success', 'ti-circle-check-filled', '\"[\\\"database\\\",\\\"broadcast\\\",\\\"mail\\\"]\"', 1, NULL, NULL, NULL, '2026-07-16 21:37:21', '2026-07-16 21:37:21'),
(2, 'product_rejected', 'Product Rejected', 'Your product \"{product_name}\" was rejected. Reason: {admin_message}', 'danger', 'ti-circle-x-filled', '\"[\\\"database\\\",\\\"broadcast\\\",\\\"mail\\\"]\"', 1, NULL, NULL, NULL, '2026-07-16 21:37:21', '2026-07-16 21:37:21'),
(3, 'product_status_updated', 'Product Status Updated', 'The status of your product \"{product_name}\" has been changed to {status}. {admin_message}', 'info', 'ti-refresh', '\"[\\\"database\\\",\\\"broadcast\\\",\\\"mail\\\"]\"', 1, NULL, NULL, NULL, '2026-07-16 21:37:21', '2026-07-16 21:37:21'),
(4, 'product_resubmitted', 'Product Resubmitted', 'Your product \"{product_name}\" has been resubmitted for approval.', 'warning', 'ti-refresh-alert', '\"[\\\"database\\\",\\\"broadcast\\\"]\"', 1, NULL, NULL, NULL, '2026-07-16 21:37:21', '2026-07-16 21:37:21'),
(5, 'product_approval_request', 'New Product Awaiting Approval', 'A new product \"{product_name}\" has been submitted by {vendor_name} and is awaiting approval.', 'info', 'ti-clock-hour-4', '\"[\\\"database\\\",\\\"broadcast\\\"]\"', 1, NULL, NULL, NULL, '2026-07-16 21:37:21', '2026-07-16 21:37:21'),
(6, 'low_stock', 'Low Stock Alert', 'Product \"{product_name}\" stock is below the minimum threshold.', 'warning', 'ti-alert-triangle', '\"[\\\"database\\\",\\\"broadcast\\\"]\"', 1, NULL, NULL, NULL, '2026-07-16 21:37:21', '2026-07-16 21:37:21'),
(7, 'out_of_stock', 'Out of Stock', 'Product \"{product_name}\" is currently out of stock.', 'danger', 'ti-package-off', '\"[\\\"database\\\",\\\"broadcast\\\",\\\"mail\\\"]\"', 1, NULL, NULL, NULL, '2026-07-16 21:37:21', '2026-07-16 21:37:21'),
(8, 'school_product_approved', 'School Product Approval', 'School \"{school_name}\" has approved product \"{product_name}\" (Code: {product_code}) for their official catalogue.', 'success', 'ti-school', '\"[\\\"database\\\",\\\"broadcast\\\",\\\"mail\\\"]\"', 1, NULL, NULL, NULL, '2026-07-16 21:37:21', '2026-07-16 21:37:21'),
(9, 'stock_replenished', 'Stock Replenished', 'Inventory has been replenished for \"{product_name}\".', 'success', 'ti-package', '\"[\\\"database\\\",\\\"broadcast\\\"]\"', 1, NULL, NULL, NULL, '2026-07-16 21:37:21', '2026-07-16 21:37:21');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

DROP TABLE IF EXISTS `orders`;
CREATE TABLE IF NOT EXISTS `orders` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `order_number` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `school_id` char(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `vendor_id` char(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cart_id` char(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` enum('pending','confirmed','processing','packed','shipped','delivered','cancelled','returned','refunded') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `delivery_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'school_delivery',
  `payment_status` enum('pending','paid','failed','refunded') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `subtotal` decimal(10,2) NOT NULL,
  `discount_amount` decimal(10,2) NOT NULL DEFAULT '0.00',
  `tax_amount` decimal(10,2) NOT NULL DEFAULT '0.00',
  `shipping_charge` decimal(10,2) NOT NULL DEFAULT '0.00',
  `grand_total` decimal(10,2) NOT NULL,
  `customer_note` text COLLATE utf8mb4_unicode_ci,
  `placed_at` timestamp NULL DEFAULT NULL,
  `delivered_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `orders_order_number_unique` (`order_number`),
  KEY `orders_school_id_foreign` (`school_id`),
  KEY `orders_vendor_id_foreign` (`vendor_id`),
  KEY `orders_cart_id_foreign` (`cart_id`),
  KEY `orders_user_id_status_index` (`user_id`,`status`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `order_addresses`
--

DROP TABLE IF EXISTS `order_addresses`;
CREATE TABLE IF NOT EXISTS `order_addresses` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `order_id` bigint UNSIGNED NOT NULL,
  `type` enum('billing','shipping') COLLATE utf8mb4_unicode_ci NOT NULL,
  `full_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address_line1` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address_line2` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `city` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `state` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `postal_code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `country` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'India',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `order_addresses_order_id_foreign` (`order_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

DROP TABLE IF EXISTS `order_items`;
CREATE TABLE IF NOT EXISTS `order_items` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `order_id` bigint UNSIGNED NOT NULL,
  `product_id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `variant_id` char(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `vendor_id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sku` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `unit_price` decimal(10,2) NOT NULL,
  `quantity` int UNSIGNED NOT NULL,
  `discount_amount` decimal(10,2) NOT NULL DEFAULT '0.00',
  `tax_amount` decimal(10,2) NOT NULL DEFAULT '0.00',
  `line_total` decimal(10,2) NOT NULL,
  `returned_quantity` int UNSIGNED NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `order_items_order_id_foreign` (`order_id`),
  KEY `order_items_product_id_foreign` (`product_id`),
  KEY `order_items_variant_id_foreign` (`variant_id`),
  KEY `order_items_vendor_id_foreign` (`vendor_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `order_notes`
--

DROP TABLE IF EXISTS `order_notes`;
CREATE TABLE IF NOT EXISTS `order_notes` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `order_id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `type` enum('customer','vendor','admin','system') COLLATE utf8mb4_unicode_ci NOT NULL,
  `note` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_visible_to_customer` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `order_notes_order_id_foreign` (`order_id`),
  KEY `order_notes_user_id_foreign` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `order_product_snapshots`
--

DROP TABLE IF EXISTS `order_product_snapshots`;
CREATE TABLE IF NOT EXISTS `order_product_snapshots` (
  `snapshot_id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `order_item_id` bigint UNSIGNED NOT NULL,
  `product_id` char(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `vendor_id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `category_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `brand_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `product_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `sku` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gender` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `material` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `specifications` json DEFAULT NULL,
  `selling_price` decimal(10,2) NOT NULL,
  `original_price` decimal(10,2) DEFAULT NULL,
  `discount_amount` decimal(10,2) NOT NULL DEFAULT '0.00',
  `tax_amount` decimal(10,2) NOT NULL DEFAULT '0.00',
  `size_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `color_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `variant_details` json DEFAULT NULL,
  `thumbnail_url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image_urls` json DEFAULT NULL,
  `school_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `delivery_info` json DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`snapshot_id`),
  KEY `order_product_snapshots_order_item_id_foreign` (`order_item_id`),
  KEY `order_product_snapshots_product_id_foreign` (`product_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `order_status_histories`
--

DROP TABLE IF EXISTS `order_status_histories`;
CREATE TABLE IF NOT EXISTS `order_status_histories` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `order_id` bigint UNSIGNED NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remarks` text COLLATE utf8mb4_unicode_ci,
  `changed_by` bigint UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `order_status_histories_order_id_foreign` (`order_id`),
  KEY `order_status_histories_changed_by_foreign` (`changed_by`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `parent_categories`
--

DROP TABLE IF EXISTS `parent_categories`;
CREATE TABLE IF NOT EXISTS `parent_categories` (
  `parent_id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `vendor_id` char(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(80) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_by` bigint UNSIGNED DEFAULT NULL,
  `updated_by` bigint UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`parent_id`),
  KEY `parent_categories_vendor_id_index` (`vendor_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

DROP TABLE IF EXISTS `password_reset_tokens`;
CREATE TABLE IF NOT EXISTS `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

DROP TABLE IF EXISTS `payments`;
CREATE TABLE IF NOT EXISTS `payments` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `order_id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `payment_method` enum('razorpay','cod','upi','card','net_banking','wallet') COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('pending','processing','success','failed','cancelled','refunded','partially_refunded') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `amount` decimal(10,2) NOT NULL,
  `currency` varchar(5) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'INR',
  `transaction_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gateway_order_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gateway_payment_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gateway_signature` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gateway_response` json DEFAULT NULL,
  `paid_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `payments_user_id_foreign` (`user_id`),
  KEY `payments_order_id_status_index` (`order_id`,`status`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

DROP TABLE IF EXISTS `permissions`;
CREATE TABLE IF NOT EXISTS `permissions` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `permission_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `group_name` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `role_category` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `parent_id` bigint UNSIGNED DEFAULT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`),
  KEY `permissions_parent_id_foreign` (`parent_id`)
) ENGINE=InnoDB AUTO_INCREMENT=67 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `permission_name`, `group_name`, `role_category`, `parent_id`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'role.view', 'View Roles', 'User Management', 'admin', NULL, 'web', '2026-07-16 21:37:20', '2026-07-16 21:37:20'),
(2, 'role.create', 'Create Role', 'User Management', 'admin', 1, 'web', '2026-07-16 21:37:20', '2026-07-16 21:37:20'),
(3, 'role.edit', 'Edit Role', 'User Management', 'admin', 1, 'web', '2026-07-16 21:37:20', '2026-07-16 21:37:20'),
(4, 'role.delete', 'Delete Role', 'User Management', 'admin', 1, 'web', '2026-07-16 21:37:20', '2026-07-16 21:37:20'),
(5, 'admin.view', 'View Admins', 'User Management', 'admin', NULL, 'web', '2026-07-16 21:37:20', '2026-07-16 21:37:20'),
(6, 'admin.create', 'Create Admin', 'User Management', 'admin', 5, 'web', '2026-07-16 21:37:20', '2026-07-16 21:37:20'),
(7, 'admin.edit', 'Edit Admin', 'User Management', 'admin', 5, 'web', '2026-07-16 21:37:20', '2026-07-16 21:37:20'),
(8, 'admin.delete', 'Delete Admin', 'User Management', 'admin', 5, 'web', '2026-07-16 21:37:20', '2026-07-16 21:37:20'),
(9, 'user.view', 'View User Status Report', 'User Management', 'admin', NULL, 'web', '2026-07-16 21:37:20', '2026-07-16 21:37:20'),
(10, 'user.edit', 'Manage User Status', 'User Management', 'admin', NULL, 'web', '2026-07-16 21:37:20', '2026-07-16 21:37:20'),
(11, 'parent.view', 'View Parents', 'Parent Management', 'school', NULL, 'web', '2026-07-16 21:37:20', '2026-07-16 21:37:20'),
(12, 'parent.create', 'Create Parent', 'Parent Management', 'school', 11, 'web', '2026-07-16 21:37:20', '2026-07-16 21:37:20'),
(13, 'parent.edit', 'Edit Parent', 'Parent Management', 'school', 11, 'web', '2026-07-16 21:37:20', '2026-07-16 21:37:20'),
(14, 'parent.delete', 'Delete Parent', 'Parent Management', 'school', 11, 'web', '2026-07-16 21:37:20', '2026-07-16 21:37:20'),
(15, 'school.view', 'View Schools', 'School Management', 'admin', NULL, 'web', '2026-07-16 21:37:20', '2026-07-16 21:37:20'),
(16, 'school.create', 'Create School', 'School Management', 'admin', 15, 'web', '2026-07-16 21:37:20', '2026-07-16 21:37:20'),
(17, 'school.edit', 'Edit School', 'School Management', 'admin', 15, 'web', '2026-07-16 21:37:20', '2026-07-16 21:37:20'),
(18, 'school.delete', 'Delete School', 'School Management', 'admin', 15, 'web', '2026-07-16 21:37:20', '2026-07-16 21:37:20'),
(19, 'product_assignment.view', 'View Product Assignments', 'School Management', 'admin', NULL, 'web', '2026-07-16 21:37:20', '2026-07-16 21:37:20'),
(20, 'product_assignment.create', 'Create Product Assignment', 'School Management', 'admin', NULL, 'web', '2026-07-16 21:37:20', '2026-07-16 21:37:20'),
(21, 'product_assignment.delete', 'Delete Product Assignment', 'School Management', 'admin', NULL, 'web', '2026-07-16 21:37:20', '2026-07-16 21:37:20'),
(22, 'school_board.view', 'View School Boards', 'School Board Management', 'admin', NULL, 'web', '2026-07-16 21:37:20', '2026-07-16 21:37:20'),
(23, 'school_board.create', 'Create School Board', 'School Board Management', 'admin', NULL, 'web', '2026-07-16 21:37:20', '2026-07-16 21:37:20'),
(24, 'school_board.edit', 'Edit School Board', 'School Board Management', 'admin', NULL, 'web', '2026-07-16 21:37:20', '2026-07-16 21:37:20'),
(25, 'school_board.delete', 'Delete School Board', 'School Board Management', 'admin', NULL, 'web', '2026-07-16 21:37:20', '2026-07-16 21:37:20'),
(26, 'product.view', 'View Products', 'Core Product Mgmt', NULL, NULL, 'web', '2026-07-16 21:37:20', '2026-07-16 21:37:20'),
(27, 'product.create', 'Create Product', 'Core Product Mgmt', NULL, 26, 'web', '2026-07-16 21:37:20', '2026-07-16 21:37:20'),
(28, 'product.edit', 'Edit Product', 'Core Product Mgmt', NULL, 26, 'web', '2026-07-16 21:37:20', '2026-07-16 21:37:20'),
(29, 'product.delete', 'Delete Product', 'Core Product Mgmt', NULL, 26, 'web', '2026-07-16 21:37:20', '2026-07-16 21:37:20'),
(30, 'category.view', 'View Categories', 'Product Attributes', 'vendor', NULL, 'web', '2026-07-16 21:37:20', '2026-07-16 21:37:20'),
(31, 'category.create', 'Create Category', 'Product Attributes', 'vendor', 30, 'web', '2026-07-16 21:37:20', '2026-07-16 21:37:20'),
(32, 'category.edit', 'Edit Category', 'Product Attributes', 'vendor', 30, 'web', '2026-07-16 21:37:20', '2026-07-16 21:37:20'),
(33, 'category.delete', 'Delete Category', 'Product Attributes', 'vendor', 30, 'web', '2026-07-16 21:37:20', '2026-07-16 21:37:20'),
(34, 'parent-category.view', 'View Parent Categories', 'Product Attributes', 'vendor', NULL, 'web', '2026-07-16 21:37:20', '2026-07-16 21:37:20'),
(35, 'parent-category.create', 'Create Parent Category', 'Product Attributes', 'vendor', 34, 'web', '2026-07-16 21:37:20', '2026-07-16 21:37:20'),
(36, 'parent-category.edit', 'Edit Parent Category', 'Product Attributes', 'vendor', 34, 'web', '2026-07-16 21:37:20', '2026-07-16 21:37:20'),
(37, 'parent-category.delete', 'Delete Parent Category', 'Product Attributes', 'vendor', 34, 'web', '2026-07-16 21:37:20', '2026-07-16 21:37:20'),
(38, 'size.view', 'View Sizes', 'Product Attributes', 'vendor', NULL, 'web', '2026-07-16 21:37:20', '2026-07-16 21:37:20'),
(39, 'size.create', 'Create Size', 'Product Attributes', 'vendor', 38, 'web', '2026-07-16 21:37:20', '2026-07-16 21:37:20'),
(40, 'size.edit', 'Edit Size', 'Product Attributes', 'vendor', 38, 'web', '2026-07-16 21:37:20', '2026-07-16 21:37:20'),
(41, 'size.delete', 'Delete Size', 'Product Attributes', 'vendor', 38, 'web', '2026-07-16 21:37:20', '2026-07-16 21:37:20'),
(42, 'color.view', 'View Colors', 'Product Attributes', 'vendor', NULL, 'web', '2026-07-16 21:37:20', '2026-07-16 21:37:20'),
(43, 'color.create', 'Create Color', 'Product Attributes', 'vendor', 42, 'web', '2026-07-16 21:37:20', '2026-07-16 21:37:20'),
(44, 'color.edit', 'Edit Color', 'Product Attributes', 'vendor', 42, 'web', '2026-07-16 21:37:20', '2026-07-16 21:37:20'),
(45, 'color.delete', 'Delete Color', 'Product Attributes', 'vendor', 42, 'web', '2026-07-16 21:37:20', '2026-07-16 21:37:20'),
(46, 'stock_view', 'View Stock Levels', 'Stock Management', 'vendor', NULL, 'web', '2026-07-16 21:37:20', '2026-07-16 21:37:20'),
(47, 'stock_adjust', 'Adjust Stock', 'Stock Management', 'vendor', NULL, 'web', '2026-07-16 21:37:20', '2026-07-16 21:37:20'),
(48, 'stock_history_view', 'View Stock History', 'Stock Management', 'vendor', NULL, 'web', '2026-07-16 21:37:20', '2026-07-16 21:37:20'),
(49, 'vendor.stock.history.report', 'View Stock History Report', 'Stock Management', 'vendor', NULL, 'web', '2026-07-16 21:37:20', '2026-07-16 21:37:20'),
(50, 'product.stock_update', 'Update Product Stock', 'Stock Management', 'vendor', NULL, 'web', '2026-07-16 21:37:20', '2026-07-16 21:37:20'),
(51, 'vendor.fulfillment.view', 'View Order Fulfillment Hub', 'Order Fulfillment', 'vendor', NULL, 'web', '2026-07-16 21:37:20', '2026-07-16 21:37:20'),
(52, 'vendor.fulfillment.ship', 'Ship Orders', 'Order Fulfillment', 'vendor', NULL, 'web', '2026-07-16 21:37:20', '2026-07-16 21:37:20'),
(53, 'product_approval_view', 'View Approval Queue', 'Product Approval', 'school', NULL, 'web', '2026-07-16 21:37:20', '2026-07-16 21:37:20'),
(54, 'product_approval_action', 'Perform Approval Actions', 'Product Approval', 'school', NULL, 'web', '2026-07-16 21:37:20', '2026-07-16 21:37:20'),
(55, 'school.product.approve', 'Approve Products', 'Product Approval', 'school', NULL, 'web', '2026-07-16 21:37:20', '2026-07-16 21:37:20'),
(56, 'school.product.report', 'View Approved Products Report', 'Product Approval', 'school', NULL, 'web', '2026-07-16 21:37:20', '2026-07-16 21:37:20'),
(57, 'vendor.view', 'View Vendors', 'Vendor Management', 'admin', NULL, 'web', '2026-07-16 21:37:20', '2026-07-16 21:37:20'),
(58, 'vendor.create', 'Create Vendor', 'Vendor Management', 'admin', NULL, 'web', '2026-07-16 21:37:20', '2026-07-16 21:37:20'),
(59, 'vendor.edit', 'Edit Vendor', 'Vendor Management', 'admin', NULL, 'web', '2026-07-16 21:37:20', '2026-07-16 21:37:20'),
(60, 'vendor.delete', 'Delete Vendor', 'Vendor Management', 'admin', NULL, 'web', '2026-07-16 21:37:20', '2026-07-16 21:37:20'),
(61, 'partnership.view', 'View Partnership Requests', 'Partnership Management', 'admin', NULL, 'web', '2026-07-16 21:37:20', '2026-07-16 21:37:20'),
(62, 'partnership.approve', 'Approve Partnership Request', 'Partnership Management', 'admin', NULL, 'web', '2026-07-16 21:37:20', '2026-07-16 21:37:20'),
(63, 'partnership.reject', 'Reject Partnership Request', 'Partnership Management', 'admin', NULL, 'web', '2026-07-16 21:37:20', '2026-07-16 21:37:20'),
(64, 'audit.view', 'View Audit Reports', 'System Management', 'admin', NULL, 'web', '2026-07-16 21:37:20', '2026-07-16 21:37:20'),
(65, 'global_settings.view', 'View Global Settings', 'System Management', 'admin', NULL, 'web', '2026-07-16 21:37:20', '2026-07-16 21:37:20'),
(66, 'global_settings.edit', 'Edit Global Settings', 'System Management', 'admin', NULL, 'web', '2026-07-16 21:37:20', '2026-07-16 21:37:20');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

DROP TABLE IF EXISTS `products`;
CREATE TABLE IF NOT EXISTS `products` (
  `product_id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `vendor_id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `category_id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_code` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_name` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `meta_title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_description` text COLLATE utf8mb4_unicode_ci,
  `meta_keywords` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `fabric_composition` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gender_type` enum('boys','girls','unisex') COLLATE utf8mb4_unicode_ci NOT NULL,
  `approval_status` enum('pending','approved','rejected') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `approved_by` bigint UNSIGNED DEFAULT NULL,
  `approved_at` timestamp NULL DEFAULT NULL,
  `rejected_by` bigint UNSIGNED DEFAULT NULL,
  `rejected_at` timestamp NULL DEFAULT NULL,
  `rejection_reason` text COLLATE utf8mb4_unicode_ci,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_by` bigint UNSIGNED NOT NULL,
  `updated_by` bigint UNSIGNED NOT NULL,
  `deleted_by` bigint UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`product_id`),
  UNIQUE KEY `products_product_code_unique` (`product_code`),
  UNIQUE KEY `products_slug_unique` (`slug`),
  KEY `products_vendor_id_foreign` (`vendor_id`),
  KEY `products_category_id_foreign` (`category_id`),
  KEY `products_created_by_foreign` (`created_by`),
  KEY `products_updated_by_foreign` (`updated_by`),
  KEY `products_deleted_by_foreign` (`deleted_by`),
  KEY `products_approved_by_foreign` (`approved_by`),
  KEY `products_rejected_by_foreign` (`rejected_by`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `product_approval_histories`
--

DROP TABLE IF EXISTS `product_approval_histories`;
CREATE TABLE IF NOT EXISTS `product_approval_histories` (
  `history_id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `action_type` enum('approved','rejected','resubmitted','status_changed') COLLATE utf8mb4_unicode_ci NOT NULL,
  `old_status` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `new_status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remarks` text COLLATE utf8mb4_unicode_ci,
  `performed_by` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`history_id`),
  KEY `product_approval_histories_product_id_foreign` (`product_id`),
  KEY `product_approval_histories_performed_by_foreign` (`performed_by`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `product_assignments`
--

DROP TABLE IF EXISTS `product_assignments`;
CREATE TABLE IF NOT EXISTS `product_assignments` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `assignment_type` enum('standard','section') COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `product_assignments_assignment_type_index` (`assignment_type`),
  KEY `product_assignments_product_id_assignment_type_index` (`product_id`,`assignment_type`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `product_images`
--

DROP TABLE IF EXISTS `product_images`;
CREATE TABLE IF NOT EXISTS `product_images` (
  `product_image_id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `file_id` bigint UNSIGNED NOT NULL,
  `sort_order` int NOT NULL DEFAULT '0',
  `is_primary` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`product_image_id`),
  KEY `product_images_product_id_foreign` (`product_id`),
  KEY `product_images_file_id_foreign` (`file_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `product_reviews`
--

DROP TABLE IF EXISTS `product_reviews`;
CREATE TABLE IF NOT EXISTS `product_reviews` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `product_id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `order_item_id` bigint UNSIGNED DEFAULT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `rating` tinyint NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `review` text COLLATE utf8mb4_unicode_ci,
  `verified_purchase` tinyint(1) NOT NULL DEFAULT '1',
  `is_approved` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `product_reviews_order_item_id_foreign` (`order_item_id`),
  KEY `product_reviews_user_id_foreign` (`user_id`),
  KEY `product_reviews_product_id_rating_index` (`product_id`,`rating`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `product_variants`
--

DROP TABLE IF EXISTS `product_variants`;
CREATE TABLE IF NOT EXISTS `product_variants` (
  `variant_id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sku` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL,
  `size_id` char(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `color_id` char(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mrp` decimal(10,2) NOT NULL,
  `selling_price` decimal(10,2) NOT NULL,
  `vendor_price` decimal(10,2) NOT NULL DEFAULT '0.00',
  `stock_qty` int UNSIGNED NOT NULL DEFAULT '0',
  `low_stock_alert` int UNSIGNED NOT NULL DEFAULT '5',
  `low_stock_notified_at` timestamp NULL DEFAULT NULL,
  `barcode` varchar(60) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_by` bigint UNSIGNED NOT NULL,
  `updated_by` bigint UNSIGNED NOT NULL,
  `deleted_by` bigint UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`variant_id`),
  UNIQUE KEY `product_variants_sku_unique` (`sku`),
  UNIQUE KEY `uq_variant_combination` (`product_id`,`size_id`,`color_id`),
  UNIQUE KEY `product_variants_barcode_unique` (`barcode`),
  KEY `product_variants_size_id_foreign` (`size_id`),
  KEY `product_variants_color_id_foreign` (`color_id`),
  KEY `product_variants_created_by_foreign` (`created_by`),
  KEY `product_variants_updated_by_foreign` (`updated_by`),
  KEY `product_variants_deleted_by_foreign` (`deleted_by`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `refunds`
--

DROP TABLE IF EXISTS `refunds`;
CREATE TABLE IF NOT EXISTS `refunds` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `return_id` bigint UNSIGNED NOT NULL,
  `payment_id` bigint UNSIGNED DEFAULT NULL,
  `amount` decimal(10,2) NOT NULL,
  `status` enum('pending','processing','completed','failed') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `gateway_reference` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `processed_at` timestamp NULL DEFAULT NULL,
  `failure_reason` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `refunds_return_id_foreign` (`return_id`),
  KEY `refunds_payment_id_foreign` (`payment_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `returns`
--

DROP TABLE IF EXISTS `returns`;
CREATE TABLE IF NOT EXISTS `returns` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `return_number` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `order_id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `vendor_id` char(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `return_type` enum('refund','exchange','store_credit') COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('requested','approved','rejected','pickup_scheduled','picked_up','received','inspecting','completed','cancelled') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'requested',
  `customer_note` text COLLATE utf8mb4_unicode_ci,
  `admin_note` text COLLATE utf8mb4_unicode_ci,
  `requested_at` timestamp NULL DEFAULT NULL,
  `approved_at` timestamp NULL DEFAULT NULL,
  `completed_at` timestamp NULL DEFAULT NULL,
  `handled_by` bigint UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `returns_return_number_unique` (`return_number`),
  KEY `returns_user_id_foreign` (`user_id`),
  KEY `returns_vendor_id_foreign` (`vendor_id`),
  KEY `returns_handled_by_foreign` (`handled_by`),
  KEY `returns_order_id_status_index` (`order_id`,`status`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `return_items`
--

DROP TABLE IF EXISTS `return_items`;
CREATE TABLE IF NOT EXISTS `return_items` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `return_id` bigint UNSIGNED NOT NULL,
  `order_item_id` bigint UNSIGNED NOT NULL,
  `return_reason_id` bigint UNSIGNED NOT NULL,
  `quantity` int UNSIGNED NOT NULL,
  `customer_comment` text COLLATE utf8mb4_unicode_ci,
  `condition` enum('new','used','damaged','defective') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `inspection_status` enum('pending','approved','rejected') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `inspection_note` text COLLATE utf8mb4_unicode_ci,
  `exchange_variant_id` char(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `refund_amount` decimal(10,2) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `return_items_return_id_foreign` (`return_id`),
  KEY `return_items_order_item_id_foreign` (`order_item_id`),
  KEY `return_items_return_reason_id_foreign` (`return_reason_id`),
  KEY `return_items_exchange_variant_id_foreign` (`exchange_variant_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `return_item_images`
--

DROP TABLE IF EXISTS `return_item_images`;
CREATE TABLE IF NOT EXISTS `return_item_images` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `return_item_id` bigint UNSIGNED NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `return_item_images_return_item_id_foreign` (`return_item_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `return_policies`
--

DROP TABLE IF EXISTS `return_policies`;
CREATE TABLE IF NOT EXISTS `return_policies` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `school_id` char(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `category_id` char(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `return_window_days` int UNSIGNED NOT NULL DEFAULT '7',
  `allow_return` tinyint(1) NOT NULL DEFAULT '1',
  `allow_exchange` tinyint(1) NOT NULL DEFAULT '1',
  `allow_store_credit` tinyint(1) NOT NULL DEFAULT '1',
  `require_original_tags` tinyint(1) NOT NULL DEFAULT '1',
  `require_unworn` tinyint(1) NOT NULL DEFAULT '1',
  `restocking_fee` decimal(10,2) NOT NULL DEFAULT '0.00',
  `is_final_sale` tinyint(1) NOT NULL DEFAULT '0',
  `description` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uq_return_policy_school_category` (`school_id`,`category_id`),
  KEY `return_policies_category_id_foreign` (`category_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `return_reasons`
--

DROP TABLE IF EXISTS `return_reasons`;
CREATE TABLE IF NOT EXISTS `return_reasons` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `reason` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `require_comment` tinyint(1) NOT NULL DEFAULT '0',
  `require_photo` tinyint(1) NOT NULL DEFAULT '0',
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `sort_order` int UNSIGNED NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `return_shipments`
--

DROP TABLE IF EXISTS `return_shipments`;
CREATE TABLE IF NOT EXISTS `return_shipments` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `return_id` bigint UNSIGNED NOT NULL,
  `courier_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tracking_number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tracking_url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` enum('pending','picked_up','in_transit','delivered') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `return_shipments_return_id_foreign` (`return_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

DROP TABLE IF EXISTS `roles`;
CREATE TABLE IF NOT EXISTS `roles` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role_category` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `roles_name_guard_name_unique` (`name`,`guard_name`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `role_category`, `guard_name`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'super-admin', NULL, 'web', NULL, '2026-07-16 21:37:20', '2026-07-16 21:37:20'),
(2, 'admin', NULL, 'web', NULL, '2026-07-16 21:37:20', '2026-07-16 21:37:20'),
(3, 'school', NULL, 'web', NULL, '2026-07-16 21:37:20', '2026-07-16 21:37:20'),
(4, 'vendor', NULL, 'web', NULL, '2026-07-16 21:37:20', '2026-07-16 21:37:20'),
(5, 'parent', NULL, 'web', NULL, '2026-07-16 21:37:20', '2026-07-16 21:37:20');

-- --------------------------------------------------------

--
-- Table structure for table `role_has_permissions`
--

DROP TABLE IF EXISTS `role_has_permissions`;
CREATE TABLE IF NOT EXISTS `role_has_permissions` (
  `permission_id` bigint UNSIGNED NOT NULL,
  `role_id` bigint UNSIGNED NOT NULL,
  PRIMARY KEY (`permission_id`,`role_id`),
  KEY `role_has_permissions_role_id_foreign` (`role_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `schools`
--

DROP TABLE IF EXISTS `schools`;
CREATE TABLE IF NOT EXISTS `schools` (
  `school_id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `school_name` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `principal_name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `city` varchar(80) COLLATE utf8mb4_unicode_ci NOT NULL,
  `state` varchar(80) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pincode` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `affiliation_no` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `logo_url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_by` bigint UNSIGNED DEFAULT NULL,
  `updated_by` bigint UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `school_type_id` bigint UNSIGNED DEFAULT NULL,
  `image_id` bigint UNSIGNED DEFAULT NULL,
  PRIMARY KEY (`school_id`),
  UNIQUE KEY `schools_user_id_unique` (`user_id`),
  UNIQUE KEY `schools_school_name_unique` (`school_name`),
  UNIQUE KEY `schools_email_unique` (`email`),
  KEY `schools_created_by_foreign` (`created_by`),
  KEY `schools_updated_by_foreign` (`updated_by`),
  KEY `schools_school_name_index` (`school_name`),
  KEY `schools_city_index` (`city`),
  KEY `schools_state_index` (`state`),
  KEY `schools_is_active_index` (`is_active`),
  KEY `schools_school_type_id_foreign` (`school_type_id`),
  KEY `schools_image_id_foreign` (`image_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `school_distributions`
--

DROP TABLE IF EXISTS `school_distributions`;
CREATE TABLE IF NOT EXISTS `school_distributions` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `shipment_id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `school_id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `received_at` timestamp NULL DEFAULT NULL,
  `received_by` bigint UNSIGNED DEFAULT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'received',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `school_distributions_shipment_id_foreign` (`shipment_id`),
  KEY `school_distributions_school_id_foreign` (`school_id`),
  KEY `school_distributions_received_by_foreign` (`received_by`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `school_partnership_requests`
--

DROP TABLE IF EXISTS `school_partnership_requests`;
CREATE TABLE IF NOT EXISTS `school_partnership_requests` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `school_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `contact_person` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `city` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `state` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pincode` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `document_path` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` enum('pending','approved','rejected') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `school_product_approvals`
--

DROP TABLE IF EXISTS `school_product_approvals`;
CREATE TABLE IF NOT EXISTS `school_product_approvals` (
  `school_product_approval_id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `school_id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('pending','approved','rejected') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `rejection_reason` text COLLATE utf8mb4_unicode_ci,
  `actioned_by` bigint UNSIGNED NOT NULL,
  `actioned_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`school_product_approval_id`),
  UNIQUE KEY `uq_school_product` (`school_id`,`product_id`),
  KEY `school_product_approvals_product_id_foreign` (`product_id`),
  KEY `school_product_approvals_actioned_by_foreign` (`actioned_by`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `school_product_class_approvals`
--

DROP TABLE IF EXISTS `school_product_class_approvals`;
CREATE TABLE IF NOT EXISTS `school_product_class_approvals` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `school_product_approval_id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_spca_approval` (`school_product_approval_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `school_types`
--

DROP TABLE IF EXISTS `school_types`;
CREATE TABLE IF NOT EXISTS `school_types` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `type_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `school_types_type_name_unique` (`type_name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

DROP TABLE IF EXISTS `sessions`;
CREATE TABLE IF NOT EXISTS `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sessions_user_id_index` (`user_id`),
  KEY `sessions_last_activity_index` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('Rm6inL9xulBiMzVvIjXDtpP1b5JROqkT7nyKnWpO', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', 'eyJfdG9rZW4iOiJrZ21XeU4xVVlYcExnZmlYeU55Q0NlQzk5enNtZmdzWHJEc1pMSU9IIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cL2xvY2FsaG9zdDo4MDAwXC93aXNobGlzdFwvY291bnQiLCJyb3V0ZSI6ImdlbmVyYXRlZDo6MkpxUGtnUllxYWdjMU9pVyJ9LCJfZmxhc2giOnsib2xkIjpbXSwibmV3IjpbXX19', 1784257763);

-- --------------------------------------------------------

--
-- Table structure for table `shipments`
--

DROP TABLE IF EXISTS `shipments`;
CREATE TABLE IF NOT EXISTS `shipments` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `vendor_id` char(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tracking_number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `courier_id` char(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `shipment_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `origin_address_id` char(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `destination_address_id` char(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'packed',
  `shipped_at` timestamp NULL DEFAULT NULL,
  `delivered_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `shipments_tracking_number_unique` (`tracking_number`),
  KEY `shipments_courier_id_foreign` (`courier_id`),
  KEY `shipments_tracking_number_index` (`tracking_number`),
  KEY `shipments_vendor_id_foreign` (`vendor_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `shipment_items`
--

DROP TABLE IF EXISTS `shipment_items`;
CREATE TABLE IF NOT EXISTS `shipment_items` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `shipment_id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `order_item_id` bigint UNSIGNED NOT NULL,
  `quantity_shipped` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `shipment_items_shipment_id_foreign` (`shipment_id`),
  KEY `shipment_items_order_item_id_foreign` (`order_item_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `shipment_tracking_histories`
--

DROP TABLE IF EXISTS `shipment_tracking_histories`;
CREATE TABLE IF NOT EXISTS `shipment_tracking_histories` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `shipment_id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `location` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remarks` text COLLATE utf8mb4_unicode_ci,
  `tracked_at` timestamp NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `shipment_tracking_histories_shipment_id_foreign` (`shipment_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `shipping_addresses`
--

DROP TABLE IF EXISTS `shipping_addresses`;
CREATE TABLE IF NOT EXISTS `shipping_addresses` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `address_line1` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `city` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `state` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `zip_code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `country` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'India',
  `is_default` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `shipping_addresses_user_id_foreign` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sizes`
--

DROP TABLE IF EXISTS `sizes`;
CREATE TABLE IF NOT EXISTS `sizes` (
  `size_id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `vendor_id` char(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `size_name` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `display_name` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sort_order` int NOT NULL DEFAULT '0',
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_by` bigint UNSIGNED NOT NULL,
  `updated_by` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`size_id`),
  KEY `sizes_created_by_foreign` (`created_by`),
  KEY `sizes_updated_by_foreign` (`updated_by`),
  KEY `sizes_vendor_id_index` (`vendor_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `stock_adjustments`
--

DROP TABLE IF EXISTS `stock_adjustments`;
CREATE TABLE IF NOT EXISTS `stock_adjustments` (
  `adjustment_id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `variant_id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `old_stock` int NOT NULL,
  `added_quantity` int NOT NULL,
  `new_stock` int NOT NULL,
  `remarks` text COLLATE utf8mb4_unicode_ci,
  `created_by` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`adjustment_id`),
  KEY `stock_adjustments_variant_id_foreign` (`variant_id`),
  KEY `stock_adjustments_created_by_foreign` (`created_by`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `store_credits`
--

DROP TABLE IF EXISTS `store_credits`;
CREATE TABLE IF NOT EXISTS `store_credits` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` bigint UNSIGNED NOT NULL,
  `return_id` bigint UNSIGNED DEFAULT NULL,
  `transaction_type` enum('credit','debit') COLLATE utf8mb4_unicode_ci NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `balance` decimal(10,2) NOT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `store_credits_user_id_foreign` (`user_id`),
  KEY `store_credits_return_id_foreign` (`return_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `student_distributions`
--

DROP TABLE IF EXISTS `student_distributions`;
CREATE TABLE IF NOT EXISTS `student_distributions` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `order_item_id` bigint UNSIGNED NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending_pickup',
  `delivered_at` timestamp NULL DEFAULT NULL,
  `collected_by` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `student_distributions_order_item_id_foreign` (`order_item_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `avatar` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `username` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(15) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `phone_verified_at` timestamp NULL DEFAULT NULL,
  `last_login_at` timestamp NULL DEFAULT NULL,
  `last_login_ip` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `image_id` bigint UNSIGNED DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`),
  UNIQUE KEY `users_phone_unique` (`phone`),
  UNIQUE KEY `users_username_unique` (`username`),
  KEY `users_image_id_foreign` (`image_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `avatar`, `username`, `email`, `phone`, `password`, `is_active`, `email_verified_at`, `phone_verified_at`, `last_login_at`, `last_login_ip`, `remember_token`, `created_at`, `updated_at`, `deleted_at`, `image_id`) VALUES
(1, 'Super Admin', NULL, NULL, 'rudershtiwari8@gmail.com', '9999999999', '$2y$12$mUhJ78YKIdyMgblY65j/kuX6KbGZShRBn4De9Y4KSGYfDi8Da4022', 1, '2026-07-16 21:37:21', '2026-07-16 21:37:21', NULL, NULL, NULL, '2026-07-16 21:37:21', '2026-07-16 21:37:21', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user_otps`
--

DROP TABLE IF EXISTS `user_otps`;
CREATE TABLE IF NOT EXISTS `user_otps` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` bigint UNSIGNED NOT NULL,
  `type` enum('email','sms') COLLATE utf8mb4_unicode_ci NOT NULL,
  `otp` varchar(6) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expires_at` timestamp NOT NULL,
  `verified_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_otps_user_id_foreign` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user_recently_viewed`
--

DROP TABLE IF EXISTS `user_recently_viewed`;
CREATE TABLE IF NOT EXISTS `user_recently_viewed` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` bigint UNSIGNED NOT NULL,
  `product_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_recently_viewed_user_id_product_id_index` (`user_id`,`product_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `vendors`
--

DROP TABLE IF EXISTS `vendors`;
CREATE TABLE IF NOT EXISTS `vendors` (
  `vendor_id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `business_name` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner_name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `city` varchar(80) COLLATE utf8mb4_unicode_ci NOT NULL,
  `state` varchar(80) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pincode` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `gstin` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pan_number` varchar(15) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bank_account_no` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ifsc_code` varchar(15) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `commission_rate` decimal(5,2) NOT NULL DEFAULT '0.00',
  `status` enum('pending','approved','suspended') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `is_active` enum('1','0') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `logo_url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_by` bigint NOT NULL,
  `updated_by` bigint NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `image_id` bigint UNSIGNED DEFAULT NULL,
  PRIMARY KEY (`vendor_id`),
  UNIQUE KEY `vendors_user_id_unique` (`user_id`),
  UNIQUE KEY `vendors_business_name_unique` (`business_name`),
  UNIQUE KEY `vendors_email_unique` (`email`),
  KEY `vendors_image_id_foreign` (`image_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `vendor_partnership_requests`
--

DROP TABLE IF EXISTS `vendor_partnership_requests`;
CREATE TABLE IF NOT EXISTS `vendor_partnership_requests` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `company_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `category` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `gstin` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `city` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `state` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pincode` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pan_number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bank_account_no` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ifsc_code` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `document_path` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` enum('pending','approved','rejected') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `web_users`
--

DROP TABLE IF EXISTS `web_users`;
CREATE TABLE IF NOT EXISTS `web_users` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` bigint UNSIGNED NOT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `city` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `state` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `zip_code` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `alternate_phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gender` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date_of_birth` date DEFAULT NULL,
  `national_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `emergency_contact_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `emergency_contact_phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `emergency_contact_relationship` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `notes` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `web_users_user_id_foreign` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `wishlists`
--

DROP TABLE IF EXISTS `wishlists`;
CREATE TABLE IF NOT EXISTS `wishlists` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `wishlists_user_id_unique` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `wishlist_items`
--

DROP TABLE IF EXISTS `wishlist_items`;
CREATE TABLE IF NOT EXISTS `wishlist_items` (
  `wishlist_item_id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `product_id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `variant_id` char(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`wishlist_item_id`),
  UNIQUE KEY `wishlist_items_user_id_variant_id_unique` (`user_id`,`variant_id`),
  KEY `wishlist_items_product_id_foreign` (`product_id`),
  KEY `wishlist_items_variant_id_foreign` (`variant_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `carts`
--
ALTER TABLE `carts`
  ADD CONSTRAINT `carts_school_id_foreign` FOREIGN KEY (`school_id`) REFERENCES `schools` (`school_id`) ON DELETE SET NULL,
  ADD CONSTRAINT `carts_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `cart_items`
--
ALTER TABLE `cart_items`
  ADD CONSTRAINT `cart_items_cart_id_foreign` FOREIGN KEY (`cart_id`) REFERENCES `carts` (`cart_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `cart_items_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `cart_items_variant_id_foreign` FOREIGN KEY (`variant_id`) REFERENCES `product_variants` (`variant_id`) ON DELETE SET NULL,
  ADD CONSTRAINT `cart_items_vendor_id_foreign` FOREIGN KEY (`vendor_id`) REFERENCES `vendors` (`vendor_id`) ON DELETE SET NULL;

--
-- Constraints for table `categories`
--
ALTER TABLE `categories`
  ADD CONSTRAINT `categories_parent_id_foreign` FOREIGN KEY (`parent_id`) REFERENCES `parent_categories` (`parent_id`) ON DELETE SET NULL,
  ADD CONSTRAINT `categories_vendor_id_foreign` FOREIGN KEY (`vendor_id`) REFERENCES `vendors` (`vendor_id`) ON DELETE CASCADE;

--
-- Constraints for table `colors`
--
ALTER TABLE `colors`
  ADD CONSTRAINT `colors_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `colors_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `colors_vendor_id_foreign` FOREIGN KEY (`vendor_id`) REFERENCES `vendors` (`vendor_id`) ON DELETE CASCADE;

--
-- Constraints for table `coupon_usages`
--
ALTER TABLE `coupon_usages`
  ADD CONSTRAINT `coupon_usages_coupon_id_foreign` FOREIGN KEY (`coupon_id`) REFERENCES `coupons` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `coupon_usages_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `coupon_usages_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `invoices`
--
ALTER TABLE `invoices`
  ADD CONSTRAINT `invoices_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_cart_id_foreign` FOREIGN KEY (`cart_id`) REFERENCES `carts` (`cart_id`) ON DELETE SET NULL,
  ADD CONSTRAINT `orders_school_id_foreign` FOREIGN KEY (`school_id`) REFERENCES `schools` (`school_id`) ON DELETE SET NULL,
  ADD CONSTRAINT `orders_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `orders_vendor_id_foreign` FOREIGN KEY (`vendor_id`) REFERENCES `vendors` (`vendor_id`) ON DELETE SET NULL;

--
-- Constraints for table `order_addresses`
--
ALTER TABLE `order_addresses`
  ADD CONSTRAINT `order_addresses_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `order_items_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `order_items_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `order_items_variant_id_foreign` FOREIGN KEY (`variant_id`) REFERENCES `product_variants` (`variant_id`) ON DELETE SET NULL,
  ADD CONSTRAINT `order_items_vendor_id_foreign` FOREIGN KEY (`vendor_id`) REFERENCES `vendors` (`vendor_id`) ON DELETE CASCADE;

--
-- Constraints for table `order_notes`
--
ALTER TABLE `order_notes`
  ADD CONSTRAINT `order_notes_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `order_notes_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `order_product_snapshots`
--
ALTER TABLE `order_product_snapshots`
  ADD CONSTRAINT `order_product_snapshots_order_item_id_foreign` FOREIGN KEY (`order_item_id`) REFERENCES `order_items` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `order_product_snapshots_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`) ON DELETE SET NULL;

--
-- Constraints for table `order_status_histories`
--
ALTER TABLE `order_status_histories`
  ADD CONSTRAINT `order_status_histories_changed_by_foreign` FOREIGN KEY (`changed_by`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `order_status_histories_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `parent_categories`
--
ALTER TABLE `parent_categories`
  ADD CONSTRAINT `parent_categories_vendor_id_foreign` FOREIGN KEY (`vendor_id`) REFERENCES `vendors` (`vendor_id`) ON DELETE CASCADE;

--
-- Constraints for table `payments`
--
ALTER TABLE `payments`
  ADD CONSTRAINT `payments_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `payments_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `permissions`
--
ALTER TABLE `permissions`
  ADD CONSTRAINT `permissions_parent_id_foreign` FOREIGN KEY (`parent_id`) REFERENCES `permissions` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_approved_by_foreign` FOREIGN KEY (`approved_by`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `products_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`category_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `products_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `products_deleted_by_foreign` FOREIGN KEY (`deleted_by`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `products_rejected_by_foreign` FOREIGN KEY (`rejected_by`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `products_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `products_vendor_id_foreign` FOREIGN KEY (`vendor_id`) REFERENCES `vendors` (`vendor_id`) ON DELETE CASCADE;

--
-- Constraints for table `product_approval_histories`
--
ALTER TABLE `product_approval_histories`
  ADD CONSTRAINT `product_approval_histories_performed_by_foreign` FOREIGN KEY (`performed_by`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `product_approval_histories_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`) ON DELETE CASCADE;

--
-- Constraints for table `product_assignments`
--
ALTER TABLE `product_assignments`
  ADD CONSTRAINT `product_assignments_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`) ON DELETE CASCADE;

--
-- Constraints for table `product_images`
--
ALTER TABLE `product_images`
  ADD CONSTRAINT `product_images_file_id_foreign` FOREIGN KEY (`file_id`) REFERENCES `files` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `product_images_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`) ON DELETE CASCADE;

--
-- Constraints for table `product_reviews`
--
ALTER TABLE `product_reviews`
  ADD CONSTRAINT `product_reviews_order_item_id_foreign` FOREIGN KEY (`order_item_id`) REFERENCES `order_items` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `product_reviews_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `product_reviews_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `product_variants`
--
ALTER TABLE `product_variants`
  ADD CONSTRAINT `product_variants_color_id_foreign` FOREIGN KEY (`color_id`) REFERENCES `colors` (`color_id`) ON DELETE SET NULL,
  ADD CONSTRAINT `product_variants_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `product_variants_deleted_by_foreign` FOREIGN KEY (`deleted_by`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `product_variants_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `product_variants_size_id_foreign` FOREIGN KEY (`size_id`) REFERENCES `sizes` (`size_id`) ON DELETE SET NULL,
  ADD CONSTRAINT `product_variants_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`);

--
-- Constraints for table `refunds`
--
ALTER TABLE `refunds`
  ADD CONSTRAINT `refunds_payment_id_foreign` FOREIGN KEY (`payment_id`) REFERENCES `payments` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `refunds_return_id_foreign` FOREIGN KEY (`return_id`) REFERENCES `returns` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `returns`
--
ALTER TABLE `returns`
  ADD CONSTRAINT `returns_handled_by_foreign` FOREIGN KEY (`handled_by`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `returns_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `returns_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `returns_vendor_id_foreign` FOREIGN KEY (`vendor_id`) REFERENCES `vendors` (`vendor_id`) ON DELETE SET NULL;

--
-- Constraints for table `return_items`
--
ALTER TABLE `return_items`
  ADD CONSTRAINT `return_items_exchange_variant_id_foreign` FOREIGN KEY (`exchange_variant_id`) REFERENCES `product_variants` (`variant_id`) ON DELETE SET NULL,
  ADD CONSTRAINT `return_items_order_item_id_foreign` FOREIGN KEY (`order_item_id`) REFERENCES `order_items` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `return_items_return_id_foreign` FOREIGN KEY (`return_id`) REFERENCES `returns` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `return_items_return_reason_id_foreign` FOREIGN KEY (`return_reason_id`) REFERENCES `return_reasons` (`id`) ON DELETE RESTRICT;

--
-- Constraints for table `return_item_images`
--
ALTER TABLE `return_item_images`
  ADD CONSTRAINT `return_item_images_return_item_id_foreign` FOREIGN KEY (`return_item_id`) REFERENCES `return_items` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `return_policies`
--
ALTER TABLE `return_policies`
  ADD CONSTRAINT `return_policies_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`category_id`) ON DELETE SET NULL,
  ADD CONSTRAINT `return_policies_school_id_foreign` FOREIGN KEY (`school_id`) REFERENCES `schools` (`school_id`) ON DELETE SET NULL;

--
-- Constraints for table `return_shipments`
--
ALTER TABLE `return_shipments`
  ADD CONSTRAINT `return_shipments_return_id_foreign` FOREIGN KEY (`return_id`) REFERENCES `returns` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `schools`
--
ALTER TABLE `schools`
  ADD CONSTRAINT `schools_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `schools_image_id_foreign` FOREIGN KEY (`image_id`) REFERENCES `files` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `schools_school_type_id_foreign` FOREIGN KEY (`school_type_id`) REFERENCES `school_types` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `schools_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `schools_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `school_distributions`
--
ALTER TABLE `school_distributions`
  ADD CONSTRAINT `school_distributions_received_by_foreign` FOREIGN KEY (`received_by`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `school_distributions_school_id_foreign` FOREIGN KEY (`school_id`) REFERENCES `schools` (`school_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `school_distributions_shipment_id_foreign` FOREIGN KEY (`shipment_id`) REFERENCES `shipments` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `school_product_approvals`
--
ALTER TABLE `school_product_approvals`
  ADD CONSTRAINT `school_product_approvals_actioned_by_foreign` FOREIGN KEY (`actioned_by`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `school_product_approvals_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `school_product_approvals_school_id_foreign` FOREIGN KEY (`school_id`) REFERENCES `schools` (`school_id`) ON DELETE CASCADE;

--
-- Constraints for table `school_product_class_approvals`
--
ALTER TABLE `school_product_class_approvals`
  ADD CONSTRAINT `fk_spca_approval` FOREIGN KEY (`school_product_approval_id`) REFERENCES `school_product_approvals` (`school_product_approval_id`) ON DELETE CASCADE;

--
-- Constraints for table `shipments`
--
ALTER TABLE `shipments`
  ADD CONSTRAINT `shipments_courier_id_foreign` FOREIGN KEY (`courier_id`) REFERENCES `couriers` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `shipments_vendor_id_foreign` FOREIGN KEY (`vendor_id`) REFERENCES `vendors` (`vendor_id`) ON DELETE SET NULL;

--
-- Constraints for table `shipment_items`
--
ALTER TABLE `shipment_items`
  ADD CONSTRAINT `shipment_items_order_item_id_foreign` FOREIGN KEY (`order_item_id`) REFERENCES `order_items` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `shipment_items_shipment_id_foreign` FOREIGN KEY (`shipment_id`) REFERENCES `shipments` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `shipment_tracking_histories`
--
ALTER TABLE `shipment_tracking_histories`
  ADD CONSTRAINT `shipment_tracking_histories_shipment_id_foreign` FOREIGN KEY (`shipment_id`) REFERENCES `shipments` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `shipping_addresses`
--
ALTER TABLE `shipping_addresses`
  ADD CONSTRAINT `shipping_addresses_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `sizes`
--
ALTER TABLE `sizes`
  ADD CONSTRAINT `sizes_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `sizes_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `sizes_vendor_id_foreign` FOREIGN KEY (`vendor_id`) REFERENCES `vendors` (`vendor_id`) ON DELETE CASCADE;

--
-- Constraints for table `stock_adjustments`
--
ALTER TABLE `stock_adjustments`
  ADD CONSTRAINT `stock_adjustments_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `stock_adjustments_variant_id_foreign` FOREIGN KEY (`variant_id`) REFERENCES `product_variants` (`variant_id`) ON DELETE CASCADE;

--
-- Constraints for table `store_credits`
--
ALTER TABLE `store_credits`
  ADD CONSTRAINT `store_credits_return_id_foreign` FOREIGN KEY (`return_id`) REFERENCES `returns` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `store_credits_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `student_distributions`
--
ALTER TABLE `student_distributions`
  ADD CONSTRAINT `student_distributions_order_item_id_foreign` FOREIGN KEY (`order_item_id`) REFERENCES `order_items` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_image_id_foreign` FOREIGN KEY (`image_id`) REFERENCES `files` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `user_otps`
--
ALTER TABLE `user_otps`
  ADD CONSTRAINT `user_otps_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `user_recently_viewed`
--
ALTER TABLE `user_recently_viewed`
  ADD CONSTRAINT `user_recently_viewed_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `vendors`
--
ALTER TABLE `vendors`
  ADD CONSTRAINT `vendors_image_id_foreign` FOREIGN KEY (`image_id`) REFERENCES `files` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `vendors_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `web_users`
--
ALTER TABLE `web_users`
  ADD CONSTRAINT `web_users_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `wishlists`
--
ALTER TABLE `wishlists`
  ADD CONSTRAINT `wishlists_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `wishlist_items`
--
ALTER TABLE `wishlist_items`
  ADD CONSTRAINT `wishlist_items_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `wishlist_items_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `wishlist_items_variant_id_foreign` FOREIGN KEY (`variant_id`) REFERENCES `product_variants` (`variant_id`) ON DELETE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
