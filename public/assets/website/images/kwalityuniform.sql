-- phpMyAdmin SQL Dump
-- version 5.2.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jul 17, 2026 at 04:24 PM
-- Server version: 10.11.14-MariaDB-0ubuntu0.24.04.1
-- PHP Version: 8.3.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `kwalityuniform`
--

-- --------------------------------------------------------

--
-- Table structure for table `activity_log`
--

CREATE TABLE `activity_log` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `log_name` varchar(255) DEFAULT NULL,
  `description` text NOT NULL,
  `subject_type` varchar(255) DEFAULT NULL,
  `subject_id` varchar(191) DEFAULT NULL,
  `event` varchar(255) DEFAULT NULL,
  `causer_type` varchar(255) DEFAULT NULL,
  `causer_id` varchar(191) DEFAULT NULL,
  `attribute_changes` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`attribute_changes`)),
  `properties` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`properties`)),
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `activity_log`
--

INSERT INTO `activity_log` (`id`, `log_name`, `description`, `subject_type`, `subject_id`, `event`, `causer_type`, `causer_id`, `attribute_changes`, `properties`, `created_at`, `updated_at`) VALUES
(1, 'Permission', 'created', 'App\\Models\\RolePermission\\Permission', '1', 'created', NULL, NULL, '{\"attributes\": {\"name\": \"role.view\", \"parent_id\": null, \"group_name\": \"User Management\", \"guard_name\": \"web\", \"role_category\": \"admin\", \"permission_name\": \"View Roles\"}}', '[]', '2026-07-11 07:47:00', '2026-07-11 07:47:00'),
(2, 'Permission', 'created', 'App\\Models\\RolePermission\\Permission', '2', 'created', NULL, NULL, '{\"attributes\": {\"name\": \"role.create\", \"parent_id\": 1, \"group_name\": \"User Management\", \"guard_name\": \"web\", \"role_category\": \"admin\", \"permission_name\": \"Create Role\"}}', '[]', '2026-07-11 07:47:00', '2026-07-11 07:47:00'),
(3, 'Permission', 'created', 'App\\Models\\RolePermission\\Permission', '3', 'created', NULL, NULL, '{\"attributes\": {\"name\": \"role.edit\", \"parent_id\": 1, \"group_name\": \"User Management\", \"guard_name\": \"web\", \"role_category\": \"admin\", \"permission_name\": \"Edit Role\"}}', '[]', '2026-07-11 07:47:00', '2026-07-11 07:47:00'),
(4, 'Permission', 'created', 'App\\Models\\RolePermission\\Permission', '4', 'created', NULL, NULL, '{\"attributes\": {\"name\": \"role.delete\", \"parent_id\": 1, \"group_name\": \"User Management\", \"guard_name\": \"web\", \"role_category\": \"admin\", \"permission_name\": \"Delete Role\"}}', '[]', '2026-07-11 07:47:00', '2026-07-11 07:47:00'),
(5, 'Permission', 'created', 'App\\Models\\RolePermission\\Permission', '5', 'created', NULL, NULL, '{\"attributes\": {\"name\": \"admin.view\", \"parent_id\": null, \"group_name\": \"User Management\", \"guard_name\": \"web\", \"role_category\": \"admin\", \"permission_name\": \"View Admins\"}}', '[]', '2026-07-11 07:47:00', '2026-07-11 07:47:00'),
(6, 'Permission', 'created', 'App\\Models\\RolePermission\\Permission', '6', 'created', NULL, NULL, '{\"attributes\": {\"name\": \"admin.create\", \"parent_id\": 5, \"group_name\": \"User Management\", \"guard_name\": \"web\", \"role_category\": \"admin\", \"permission_name\": \"Create Admin\"}}', '[]', '2026-07-11 07:47:00', '2026-07-11 07:47:00'),
(7, 'Permission', 'created', 'App\\Models\\RolePermission\\Permission', '7', 'created', NULL, NULL, '{\"attributes\": {\"name\": \"admin.edit\", \"parent_id\": 5, \"group_name\": \"User Management\", \"guard_name\": \"web\", \"role_category\": \"admin\", \"permission_name\": \"Edit Admin\"}}', '[]', '2026-07-11 07:47:00', '2026-07-11 07:47:00'),
(8, 'Permission', 'created', 'App\\Models\\RolePermission\\Permission', '8', 'created', NULL, NULL, '{\"attributes\": {\"name\": \"admin.delete\", \"parent_id\": 5, \"group_name\": \"User Management\", \"guard_name\": \"web\", \"role_category\": \"admin\", \"permission_name\": \"Delete Admin\"}}', '[]', '2026-07-11 07:47:00', '2026-07-11 07:47:00'),
(9, 'Permission', 'created', 'App\\Models\\RolePermission\\Permission', '9', 'created', NULL, NULL, '{\"attributes\": {\"name\": \"user.view\", \"parent_id\": null, \"group_name\": \"User Management\", \"guard_name\": \"web\", \"role_category\": \"admin\", \"permission_name\": \"View User Status Report\"}}', '[]', '2026-07-11 07:47:00', '2026-07-11 07:47:00'),
(10, 'Permission', 'created', 'App\\Models\\RolePermission\\Permission', '10', 'created', NULL, NULL, '{\"attributes\": {\"name\": \"user.edit\", \"parent_id\": null, \"group_name\": \"User Management\", \"guard_name\": \"web\", \"role_category\": \"admin\", \"permission_name\": \"Manage User Status\"}}', '[]', '2026-07-11 07:47:00', '2026-07-11 07:47:00'),
(11, 'Permission', 'created', 'App\\Models\\RolePermission\\Permission', '11', 'created', NULL, NULL, '{\"attributes\": {\"name\": \"parent.view\", \"parent_id\": null, \"group_name\": \"Parent Management\", \"guard_name\": \"web\", \"role_category\": \"school\", \"permission_name\": \"View Parents\"}}', '[]', '2026-07-11 07:47:00', '2026-07-11 07:47:00'),
(12, 'Permission', 'created', 'App\\Models\\RolePermission\\Permission', '12', 'created', NULL, NULL, '{\"attributes\": {\"name\": \"parent.create\", \"parent_id\": 11, \"group_name\": \"Parent Management\", \"guard_name\": \"web\", \"role_category\": \"school\", \"permission_name\": \"Create Parent\"}}', '[]', '2026-07-11 07:47:00', '2026-07-11 07:47:00'),
(13, 'Permission', 'created', 'App\\Models\\RolePermission\\Permission', '13', 'created', NULL, NULL, '{\"attributes\": {\"name\": \"parent.edit\", \"parent_id\": 11, \"group_name\": \"Parent Management\", \"guard_name\": \"web\", \"role_category\": \"school\", \"permission_name\": \"Edit Parent\"}}', '[]', '2026-07-11 07:47:00', '2026-07-11 07:47:00'),
(14, 'Permission', 'created', 'App\\Models\\RolePermission\\Permission', '14', 'created', NULL, NULL, '{\"attributes\": {\"name\": \"parent.delete\", \"parent_id\": 11, \"group_name\": \"Parent Management\", \"guard_name\": \"web\", \"role_category\": \"school\", \"permission_name\": \"Delete Parent\"}}', '[]', '2026-07-11 07:47:00', '2026-07-11 07:47:00'),
(15, 'Permission', 'created', 'App\\Models\\RolePermission\\Permission', '15', 'created', NULL, NULL, '{\"attributes\": {\"name\": \"school.view\", \"parent_id\": null, \"group_name\": \"School Management\", \"guard_name\": \"web\", \"role_category\": \"school\", \"permission_name\": \"View Schools\"}}', '[]', '2026-07-11 07:47:00', '2026-07-11 07:47:00'),
(16, 'Permission', 'created', 'App\\Models\\RolePermission\\Permission', '16', 'created', NULL, NULL, '{\"attributes\": {\"name\": \"school.create\", \"parent_id\": 15, \"group_name\": \"School Management\", \"guard_name\": \"web\", \"role_category\": \"school\", \"permission_name\": \"Create School\"}}', '[]', '2026-07-11 07:47:00', '2026-07-11 07:47:00'),
(17, 'Permission', 'created', 'App\\Models\\RolePermission\\Permission', '17', 'created', NULL, NULL, '{\"attributes\": {\"name\": \"school.edit\", \"parent_id\": 15, \"group_name\": \"School Management\", \"guard_name\": \"web\", \"role_category\": \"school\", \"permission_name\": \"Edit School\"}}', '[]', '2026-07-11 07:47:00', '2026-07-11 07:47:00'),
(18, 'Permission', 'created', 'App\\Models\\RolePermission\\Permission', '18', 'created', NULL, NULL, '{\"attributes\": {\"name\": \"school.delete\", \"parent_id\": 15, \"group_name\": \"School Management\", \"guard_name\": \"web\", \"role_category\": \"school\", \"permission_name\": \"Delete School\"}}', '[]', '2026-07-11 07:47:00', '2026-07-11 07:47:00'),
(19, 'Permission', 'created', 'App\\Models\\RolePermission\\Permission', '19', 'created', NULL, NULL, '{\"attributes\": {\"name\": \"school_standard.view\", \"parent_id\": null, \"group_name\": \"School Management\", \"guard_name\": \"web\", \"role_category\": \"school\", \"permission_name\": \"View School Standards\"}}', '[]', '2026-07-11 07:47:00', '2026-07-11 07:47:00'),
(20, 'Permission', 'created', 'App\\Models\\RolePermission\\Permission', '20', 'created', NULL, NULL, '{\"attributes\": {\"name\": \"school_standard.create\", \"parent_id\": null, \"group_name\": \"School Management\", \"guard_name\": \"web\", \"role_category\": \"school\", \"permission_name\": \"Create School Standard\"}}', '[]', '2026-07-11 07:47:00', '2026-07-11 07:47:00'),
(21, 'Permission', 'created', 'App\\Models\\RolePermission\\Permission', '21', 'created', NULL, NULL, '{\"attributes\": {\"name\": \"school_standard.edit\", \"parent_id\": null, \"group_name\": \"School Management\", \"guard_name\": \"web\", \"role_category\": \"school\", \"permission_name\": \"Edit School Standard\"}}', '[]', '2026-07-11 07:47:00', '2026-07-11 07:47:00'),
(22, 'Permission', 'created', 'App\\Models\\RolePermission\\Permission', '22', 'created', NULL, NULL, '{\"attributes\": {\"name\": \"school_standard.delete\", \"parent_id\": null, \"group_name\": \"School Management\", \"guard_name\": \"web\", \"role_category\": \"school\", \"permission_name\": \"Delete School Standard\"}}', '[]', '2026-07-11 07:47:00', '2026-07-11 07:47:00'),
(23, 'Permission', 'created', 'App\\Models\\RolePermission\\Permission', '23', 'created', NULL, NULL, '{\"attributes\": {\"name\": \"school_section.view\", \"parent_id\": null, \"group_name\": \"School Management\", \"guard_name\": \"web\", \"role_category\": \"school\", \"permission_name\": \"View School Sections\"}}', '[]', '2026-07-11 07:47:00', '2026-07-11 07:47:00'),
(24, 'Permission', 'created', 'App\\Models\\RolePermission\\Permission', '24', 'created', NULL, NULL, '{\"attributes\": {\"name\": \"school_section.create\", \"parent_id\": null, \"group_name\": \"School Management\", \"guard_name\": \"web\", \"role_category\": \"school\", \"permission_name\": \"Create School Section\"}}', '[]', '2026-07-11 07:47:00', '2026-07-11 07:47:00'),
(25, 'Permission', 'created', 'App\\Models\\RolePermission\\Permission', '25', 'created', NULL, NULL, '{\"attributes\": {\"name\": \"school_section.delete\", \"parent_id\": null, \"group_name\": \"School Management\", \"guard_name\": \"web\", \"role_category\": \"school\", \"permission_name\": \"Delete School Section\"}}', '[]', '2026-07-11 07:47:00', '2026-07-11 07:47:00'),
(26, 'Permission', 'created', 'App\\Models\\RolePermission\\Permission', '26', 'created', NULL, NULL, '{\"attributes\": {\"name\": \"product_assignment.view\", \"parent_id\": null, \"group_name\": \"School Management\", \"guard_name\": \"web\", \"role_category\": \"school\", \"permission_name\": \"View Product Assignments\"}}', '[]', '2026-07-11 07:47:00', '2026-07-11 07:47:00'),
(27, 'Permission', 'created', 'App\\Models\\RolePermission\\Permission', '27', 'created', NULL, NULL, '{\"attributes\": {\"name\": \"product_assignment.create\", \"parent_id\": null, \"group_name\": \"School Management\", \"guard_name\": \"web\", \"role_category\": \"school\", \"permission_name\": \"Create Product Assignment\"}}', '[]', '2026-07-11 07:47:00', '2026-07-11 07:47:00'),
(28, 'Permission', 'created', 'App\\Models\\RolePermission\\Permission', '28', 'created', NULL, NULL, '{\"attributes\": {\"name\": \"product_assignment.delete\", \"parent_id\": null, \"group_name\": \"School Management\", \"guard_name\": \"web\", \"role_category\": \"school\", \"permission_name\": \"Delete Product Assignment\"}}', '[]', '2026-07-11 07:47:00', '2026-07-11 07:47:00'),
(29, 'Permission', 'created', 'App\\Models\\RolePermission\\Permission', '29', 'created', NULL, NULL, '{\"attributes\": {\"name\": \"school_board.view\", \"parent_id\": null, \"group_name\": \"School Board Management\", \"guard_name\": \"web\", \"role_category\": \"admin\", \"permission_name\": \"View School Boards\"}}', '[]', '2026-07-11 07:47:00', '2026-07-11 07:47:00'),
(30, 'Permission', 'created', 'App\\Models\\RolePermission\\Permission', '30', 'created', NULL, NULL, '{\"attributes\": {\"name\": \"school_board.create\", \"parent_id\": null, \"group_name\": \"School Board Management\", \"guard_name\": \"web\", \"role_category\": \"admin\", \"permission_name\": \"Create School Board\"}}', '[]', '2026-07-11 07:47:00', '2026-07-11 07:47:00'),
(31, 'Permission', 'created', 'App\\Models\\RolePermission\\Permission', '31', 'created', NULL, NULL, '{\"attributes\": {\"name\": \"school_board.edit\", \"parent_id\": null, \"group_name\": \"School Board Management\", \"guard_name\": \"web\", \"role_category\": \"admin\", \"permission_name\": \"Edit School Board\"}}', '[]', '2026-07-11 07:47:00', '2026-07-11 07:47:00'),
(32, 'Permission', 'created', 'App\\Models\\RolePermission\\Permission', '32', 'created', NULL, NULL, '{\"attributes\": {\"name\": \"school_board.delete\", \"parent_id\": null, \"group_name\": \"School Board Management\", \"guard_name\": \"web\", \"role_category\": \"admin\", \"permission_name\": \"Delete School Board\"}}', '[]', '2026-07-11 07:47:00', '2026-07-11 07:47:00'),
(33, 'Permission', 'created', 'App\\Models\\RolePermission\\Permission', '33', 'created', NULL, NULL, '{\"attributes\": {\"name\": \"product.view\", \"parent_id\": null, \"group_name\": \"Core Product Mgmt\", \"guard_name\": \"web\", \"role_category\": null, \"permission_name\": \"View Products\"}}', '[]', '2026-07-11 07:47:00', '2026-07-11 07:47:00'),
(34, 'Permission', 'created', 'App\\Models\\RolePermission\\Permission', '34', 'created', NULL, NULL, '{\"attributes\": {\"name\": \"product.create\", \"parent_id\": 33, \"group_name\": \"Core Product Mgmt\", \"guard_name\": \"web\", \"role_category\": null, \"permission_name\": \"Create Product\"}}', '[]', '2026-07-11 07:47:00', '2026-07-11 07:47:00'),
(35, 'Permission', 'created', 'App\\Models\\RolePermission\\Permission', '35', 'created', NULL, NULL, '{\"attributes\": {\"name\": \"product.edit\", \"parent_id\": 33, \"group_name\": \"Core Product Mgmt\", \"guard_name\": \"web\", \"role_category\": null, \"permission_name\": \"Edit Product\"}}', '[]', '2026-07-11 07:47:00', '2026-07-11 07:47:00'),
(36, 'Permission', 'created', 'App\\Models\\RolePermission\\Permission', '36', 'created', NULL, NULL, '{\"attributes\": {\"name\": \"product.delete\", \"parent_id\": 33, \"group_name\": \"Core Product Mgmt\", \"guard_name\": \"web\", \"role_category\": null, \"permission_name\": \"Delete Product\"}}', '[]', '2026-07-11 07:47:00', '2026-07-11 07:47:00'),
(37, 'Permission', 'created', 'App\\Models\\RolePermission\\Permission', '37', 'created', NULL, NULL, '{\"attributes\": {\"name\": \"category.view\", \"parent_id\": null, \"group_name\": \"Category Management\", \"guard_name\": \"web\", \"role_category\": \"admin\", \"permission_name\": \"View Categories\"}}', '[]', '2026-07-11 07:47:00', '2026-07-11 07:47:00'),
(38, 'Permission', 'created', 'App\\Models\\RolePermission\\Permission', '38', 'created', NULL, NULL, '{\"attributes\": {\"name\": \"category.create\", \"parent_id\": 37, \"group_name\": \"Category Management\", \"guard_name\": \"web\", \"role_category\": \"admin\", \"permission_name\": \"Create Category\"}}', '[]', '2026-07-11 07:47:00', '2026-07-11 07:47:00'),
(39, 'Permission', 'created', 'App\\Models\\RolePermission\\Permission', '39', 'created', NULL, NULL, '{\"attributes\": {\"name\": \"category.edit\", \"parent_id\": 37, \"group_name\": \"Category Management\", \"guard_name\": \"web\", \"role_category\": \"admin\", \"permission_name\": \"Edit Category\"}}', '[]', '2026-07-11 07:47:00', '2026-07-11 07:47:00'),
(40, 'Permission', 'created', 'App\\Models\\RolePermission\\Permission', '40', 'created', NULL, NULL, '{\"attributes\": {\"name\": \"category.delete\", \"parent_id\": 37, \"group_name\": \"Category Management\", \"guard_name\": \"web\", \"role_category\": \"admin\", \"permission_name\": \"Delete Category\"}}', '[]', '2026-07-11 07:47:00', '2026-07-11 07:47:00'),
(41, 'Permission', 'created', 'App\\Models\\RolePermission\\Permission', '41', 'created', NULL, NULL, '{\"attributes\": {\"name\": \"size.view\", \"parent_id\": null, \"group_name\": \"Size Management\", \"guard_name\": \"web\", \"role_category\": \"admin\", \"permission_name\": \"View Sizes\"}}', '[]', '2026-07-11 07:47:00', '2026-07-11 07:47:00'),
(42, 'Permission', 'created', 'App\\Models\\RolePermission\\Permission', '42', 'created', NULL, NULL, '{\"attributes\": {\"name\": \"size.create\", \"parent_id\": 41, \"group_name\": \"Size Management\", \"guard_name\": \"web\", \"role_category\": \"admin\", \"permission_name\": \"Create Size\"}}', '[]', '2026-07-11 07:47:00', '2026-07-11 07:47:00'),
(43, 'Permission', 'created', 'App\\Models\\RolePermission\\Permission', '43', 'created', NULL, NULL, '{\"attributes\": {\"name\": \"size.edit\", \"parent_id\": 41, \"group_name\": \"Size Management\", \"guard_name\": \"web\", \"role_category\": \"admin\", \"permission_name\": \"Edit Size\"}}', '[]', '2026-07-11 07:47:00', '2026-07-11 07:47:00'),
(44, 'Permission', 'created', 'App\\Models\\RolePermission\\Permission', '44', 'created', NULL, NULL, '{\"attributes\": {\"name\": \"size.delete\", \"parent_id\": 41, \"group_name\": \"Size Management\", \"guard_name\": \"web\", \"role_category\": \"admin\", \"permission_name\": \"Delete Size\"}}', '[]', '2026-07-11 07:47:00', '2026-07-11 07:47:00'),
(45, 'Permission', 'created', 'App\\Models\\RolePermission\\Permission', '45', 'created', NULL, NULL, '{\"attributes\": {\"name\": \"color.view\", \"parent_id\": null, \"group_name\": \"Color Management\", \"guard_name\": \"web\", \"role_category\": \"admin\", \"permission_name\": \"View Colors\"}}', '[]', '2026-07-11 07:47:00', '2026-07-11 07:47:00'),
(46, 'Permission', 'created', 'App\\Models\\RolePermission\\Permission', '46', 'created', NULL, NULL, '{\"attributes\": {\"name\": \"color.create\", \"parent_id\": 45, \"group_name\": \"Color Management\", \"guard_name\": \"web\", \"role_category\": \"admin\", \"permission_name\": \"Create Color\"}}', '[]', '2026-07-11 07:47:00', '2026-07-11 07:47:00'),
(47, 'Permission', 'created', 'App\\Models\\RolePermission\\Permission', '47', 'created', NULL, NULL, '{\"attributes\": {\"name\": \"color.edit\", \"parent_id\": 45, \"group_name\": \"Color Management\", \"guard_name\": \"web\", \"role_category\": \"admin\", \"permission_name\": \"Edit Color\"}}', '[]', '2026-07-11 07:47:00', '2026-07-11 07:47:00'),
(48, 'Permission', 'created', 'App\\Models\\RolePermission\\Permission', '48', 'created', NULL, NULL, '{\"attributes\": {\"name\": \"color.delete\", \"parent_id\": 45, \"group_name\": \"Color Management\", \"guard_name\": \"web\", \"role_category\": \"admin\", \"permission_name\": \"Delete Color\"}}', '[]', '2026-07-11 07:47:00', '2026-07-11 07:47:00'),
(49, 'Permission', 'created', 'App\\Models\\RolePermission\\Permission', '49', 'created', NULL, NULL, '{\"attributes\": {\"name\": \"stock_view\", \"parent_id\": null, \"group_name\": \"Stock Management\", \"guard_name\": \"web\", \"role_category\": \"vendor\", \"permission_name\": \"View Stock Levels\"}}', '[]', '2026-07-11 07:47:00', '2026-07-11 07:47:00'),
(50, 'Permission', 'created', 'App\\Models\\RolePermission\\Permission', '50', 'created', NULL, NULL, '{\"attributes\": {\"name\": \"stock_adjust\", \"parent_id\": null, \"group_name\": \"Stock Management\", \"guard_name\": \"web\", \"role_category\": \"vendor\", \"permission_name\": \"Adjust Stock\"}}', '[]', '2026-07-11 07:47:00', '2026-07-11 07:47:00'),
(51, 'Permission', 'created', 'App\\Models\\RolePermission\\Permission', '51', 'created', NULL, NULL, '{\"attributes\": {\"name\": \"stock_history_view\", \"parent_id\": null, \"group_name\": \"Stock Management\", \"guard_name\": \"web\", \"role_category\": \"vendor\", \"permission_name\": \"View Stock History\"}}', '[]', '2026-07-11 07:47:00', '2026-07-11 07:47:00'),
(52, 'Permission', 'created', 'App\\Models\\RolePermission\\Permission', '52', 'created', NULL, NULL, '{\"attributes\": {\"name\": \"product.stock_update\", \"parent_id\": null, \"group_name\": \"Stock Management\", \"guard_name\": \"web\", \"role_category\": \"vendor\", \"permission_name\": \"Update Product Stock\"}}', '[]', '2026-07-11 07:47:00', '2026-07-11 07:47:00'),
(53, 'Permission', 'created', 'App\\Models\\RolePermission\\Permission', '53', 'created', NULL, NULL, '{\"attributes\": {\"name\": \"product_approval_view\", \"parent_id\": null, \"group_name\": \"Product Approval\", \"guard_name\": \"web\", \"role_category\": \"school\", \"permission_name\": \"View Approval Queue\"}}', '[]', '2026-07-11 07:47:00', '2026-07-11 07:47:00'),
(54, 'Permission', 'created', 'App\\Models\\RolePermission\\Permission', '54', 'created', NULL, NULL, '{\"attributes\": {\"name\": \"product_approval_action\", \"parent_id\": null, \"group_name\": \"Product Approval\", \"guard_name\": \"web\", \"role_category\": \"school\", \"permission_name\": \"Perform Approval Actions\"}}', '[]', '2026-07-11 07:47:00', '2026-07-11 07:47:00'),
(55, 'Permission', 'created', 'App\\Models\\RolePermission\\Permission', '55', 'created', NULL, NULL, '{\"attributes\": {\"name\": \"school.product.approve\", \"parent_id\": null, \"group_name\": \"Product Approval\", \"guard_name\": \"web\", \"role_category\": \"school\", \"permission_name\": \"Approve Products\"}}', '[]', '2026-07-11 07:47:00', '2026-07-11 07:47:00'),
(56, 'Permission', 'created', 'App\\Models\\RolePermission\\Permission', '56', 'created', NULL, NULL, '{\"attributes\": {\"name\": \"school.product.report\", \"parent_id\": null, \"group_name\": \"Product Approval\", \"guard_name\": \"web\", \"role_category\": \"school\", \"permission_name\": \"View Approved Products Report\"}}', '[]', '2026-07-11 07:47:00', '2026-07-11 07:47:00'),
(57, 'Permission', 'created', 'App\\Models\\RolePermission\\Permission', '57', 'created', NULL, NULL, '{\"attributes\": {\"name\": \"vendor.view\", \"parent_id\": null, \"group_name\": \"Vendor Management\", \"guard_name\": \"web\", \"role_category\": \"vendor\", \"permission_name\": \"View Vendors\"}}', '[]', '2026-07-11 07:47:00', '2026-07-11 07:47:00'),
(58, 'Permission', 'created', 'App\\Models\\RolePermission\\Permission', '58', 'created', NULL, NULL, '{\"attributes\": {\"name\": \"vendor.create\", \"parent_id\": null, \"group_name\": \"Vendor Management\", \"guard_name\": \"web\", \"role_category\": \"vendor\", \"permission_name\": \"Create Vendor\"}}', '[]', '2026-07-11 07:47:00', '2026-07-11 07:47:00'),
(59, 'Permission', 'created', 'App\\Models\\RolePermission\\Permission', '59', 'created', NULL, NULL, '{\"attributes\": {\"name\": \"vendor.edit\", \"parent_id\": null, \"group_name\": \"Vendor Management\", \"guard_name\": \"web\", \"role_category\": \"vendor\", \"permission_name\": \"Edit Vendor\"}}', '[]', '2026-07-11 07:47:00', '2026-07-11 07:47:00'),
(60, 'Permission', 'created', 'App\\Models\\RolePermission\\Permission', '60', 'created', NULL, NULL, '{\"attributes\": {\"name\": \"vendor.delete\", \"parent_id\": null, \"group_name\": \"Vendor Management\", \"guard_name\": \"web\", \"role_category\": \"vendor\", \"permission_name\": \"Delete Vendor\"}}', '[]', '2026-07-11 07:47:00', '2026-07-11 07:47:00'),
(61, 'Permission', 'created', 'App\\Models\\RolePermission\\Permission', '61', 'created', NULL, NULL, '{\"attributes\": {\"name\": \"partnership.view\", \"parent_id\": null, \"group_name\": \"Partnership Management\", \"guard_name\": \"web\", \"role_category\": \"vendor\", \"permission_name\": \"View Partnership Requests\"}}', '[]', '2026-07-11 07:47:00', '2026-07-11 07:47:00'),
(62, 'Permission', 'created', 'App\\Models\\RolePermission\\Permission', '62', 'created', NULL, NULL, '{\"attributes\": {\"name\": \"partnership.approve\", \"parent_id\": null, \"group_name\": \"Partnership Management\", \"guard_name\": \"web\", \"role_category\": \"vendor\", \"permission_name\": \"Approve Partnership Request\"}}', '[]', '2026-07-11 07:47:00', '2026-07-11 07:47:00'),
(63, 'Permission', 'created', 'App\\Models\\RolePermission\\Permission', '63', 'created', NULL, NULL, '{\"attributes\": {\"name\": \"partnership.reject\", \"parent_id\": null, \"group_name\": \"Partnership Management\", \"guard_name\": \"web\", \"role_category\": \"vendor\", \"permission_name\": \"Reject Partnership Request\"}}', '[]', '2026-07-11 07:47:00', '2026-07-11 07:47:00'),
(64, 'Permission', 'created', 'App\\Models\\RolePermission\\Permission', '64', 'created', NULL, NULL, '{\"attributes\": {\"name\": \"audit.view\", \"parent_id\": null, \"group_name\": \"System Management\", \"guard_name\": \"web\", \"role_category\": \"admin\", \"permission_name\": \"View Audit Reports\"}}', '[]', '2026-07-11 07:47:00', '2026-07-11 07:47:00'),
(65, 'Permission', 'created', 'App\\Models\\RolePermission\\Permission', '65', 'created', NULL, NULL, '{\"attributes\": {\"name\": \"global_settings.view\", \"parent_id\": null, \"group_name\": \"System Management\", \"guard_name\": \"web\", \"role_category\": \"admin\", \"permission_name\": \"View Global Settings\"}}', '[]', '2026-07-11 07:47:00', '2026-07-11 07:47:00'),
(66, 'Permission', 'created', 'App\\Models\\RolePermission\\Permission', '66', 'created', NULL, NULL, '{\"attributes\": {\"name\": \"global_settings.edit\", \"parent_id\": null, \"group_name\": \"System Management\", \"guard_name\": \"web\", \"role_category\": \"admin\", \"permission_name\": \"Edit Global Settings\"}}', '[]', '2026-07-11 07:47:00', '2026-07-11 07:47:00'),
(67, 'User', 'created', 'App\\Models\\User', '1', 'created', NULL, NULL, '{\"attributes\": {\"name\": \"Super Admin\", \"email\": \"rudershtiwari8@gmail.com\", \"phone\": \"9999999999\", \"avatar\": null, \"image_id\": null, \"logo_url\": null, \"password\": \"$2y$12$z/fgcEczq7hdul2GFGeq7eAyuxt5cwNsWnORyXqxHKq3nar9gO/l6\", \"username\": null, \"is_active\": 1}}', '[]', '2026-07-11 07:47:00', '2026-07-11 07:47:00'),
(68, 'NotificationTemplate', 'created', 'App\\Models\\NotificationTemplate', '1', 'created', NULL, NULL, '{\"attributes\": {\"key\": \"product_approved\", \"icon\": \"ti-circle-check-filled\", \"type\": \"success\", \"title\": \"Product Approved\", \"message\": \"Congratulations! Your product \\\"{product_name}\\\" has been approved and is now available for customers.\", \"channels\": \"[\\\"database\\\",\\\"broadcast\\\",\\\"mail\\\"]\", \"created_by\": null, \"updated_by\": null}}', '[]', '2026-07-11 07:47:00', '2026-07-11 07:47:00'),
(69, 'NotificationTemplate', 'created', 'App\\Models\\NotificationTemplate', '2', 'created', NULL, NULL, '{\"attributes\": {\"key\": \"product_rejected\", \"icon\": \"ti-circle-x-filled\", \"type\": \"danger\", \"title\": \"Product Rejected\", \"message\": \"Your product \\\"{product_name}\\\" was rejected. Reason: {admin_message}\", \"channels\": \"[\\\"database\\\",\\\"broadcast\\\",\\\"mail\\\"]\", \"created_by\": null, \"updated_by\": null}}', '[]', '2026-07-11 07:47:00', '2026-07-11 07:47:00'),
(70, 'NotificationTemplate', 'created', 'App\\Models\\NotificationTemplate', '3', 'created', NULL, NULL, '{\"attributes\": {\"key\": \"product_status_updated\", \"icon\": \"ti-refresh\", \"type\": \"info\", \"title\": \"Product Status Updated\", \"message\": \"The status of your product \\\"{product_name}\\\" has been changed to {status}. {admin_message}\", \"channels\": \"[\\\"database\\\",\\\"broadcast\\\",\\\"mail\\\"]\", \"created_by\": null, \"updated_by\": null}}', '[]', '2026-07-11 07:47:00', '2026-07-11 07:47:00'),
(71, 'NotificationTemplate', 'created', 'App\\Models\\NotificationTemplate', '4', 'created', NULL, NULL, '{\"attributes\": {\"key\": \"product_resubmitted\", \"icon\": \"ti-refresh-alert\", \"type\": \"warning\", \"title\": \"Product Resubmitted\", \"message\": \"Your product \\\"{product_name}\\\" has been resubmitted for approval.\", \"channels\": \"[\\\"database\\\",\\\"broadcast\\\"]\", \"created_by\": null, \"updated_by\": null}}', '[]', '2026-07-11 07:47:00', '2026-07-11 07:47:00'),
(72, 'NotificationTemplate', 'created', 'App\\Models\\NotificationTemplate', '5', 'created', NULL, NULL, '{\"attributes\": {\"key\": \"product_approval_request\", \"icon\": \"ti-clock-hour-4\", \"type\": \"info\", \"title\": \"New Product Awaiting Approval\", \"message\": \"A new product \\\"{product_name}\\\" has been submitted by {vendor_name} and is awaiting approval.\", \"channels\": \"[\\\"database\\\",\\\"broadcast\\\"]\", \"created_by\": null, \"updated_by\": null}}', '[]', '2026-07-11 07:47:00', '2026-07-11 07:47:00'),
(73, 'NotificationTemplate', 'created', 'App\\Models\\NotificationTemplate', '6', 'created', NULL, NULL, '{\"attributes\": {\"key\": \"low_stock\", \"icon\": \"ti-alert-triangle\", \"type\": \"warning\", \"title\": \"Low Stock Alert\", \"message\": \"Product \\\"{product_name}\\\" stock is below the minimum threshold.\", \"channels\": \"[\\\"database\\\",\\\"broadcast\\\"]\", \"created_by\": null, \"updated_by\": null}}', '[]', '2026-07-11 07:47:00', '2026-07-11 07:47:00'),
(74, 'NotificationTemplate', 'created', 'App\\Models\\NotificationTemplate', '7', 'created', NULL, NULL, '{\"attributes\": {\"key\": \"out_of_stock\", \"icon\": \"ti-package-off\", \"type\": \"danger\", \"title\": \"Out of Stock\", \"message\": \"Product \\\"{product_name}\\\" is currently out of stock.\", \"channels\": \"[\\\"database\\\",\\\"broadcast\\\",\\\"mail\\\"]\", \"created_by\": null, \"updated_by\": null}}', '[]', '2026-07-11 07:47:00', '2026-07-11 07:47:00'),
(75, 'NotificationTemplate', 'created', 'App\\Models\\NotificationTemplate', '8', 'created', NULL, NULL, '{\"attributes\": {\"key\": \"school_product_approved\", \"icon\": \"ti-school\", \"type\": \"success\", \"title\": \"School Product Approval\", \"message\": \"School \\\"{school_name}\\\" has approved product \\\"{product_name}\\\" (Code: {product_code}) for their official catalogue.\", \"channels\": \"[\\\"database\\\",\\\"broadcast\\\",\\\"mail\\\"]\", \"created_by\": null, \"updated_by\": null}}', '[]', '2026-07-11 07:47:00', '2026-07-11 07:47:00'),
(76, 'NotificationTemplate', 'created', 'App\\Models\\NotificationTemplate', '9', 'created', NULL, NULL, '{\"attributes\": {\"key\": \"stock_replenished\", \"icon\": \"ti-package\", \"type\": \"success\", \"title\": \"Stock Replenished\", \"message\": \"Inventory has been replenished for \\\"{product_name}\\\".\", \"channels\": \"[\\\"database\\\",\\\"broadcast\\\"]\", \"created_by\": null, \"updated_by\": null}}', '[]', '2026-07-11 07:47:00', '2026-07-11 07:47:00'),
(77, 'Size', 'created', 'App\\Models\\SuperAdmin\\Size', 'dd6e89d2-1f60-48a5-9b77-24b97d94c79e', 'created', NULL, NULL, '{\"attributes\": {\"size_id\": \"dd6e89d2-1f60-48a5-9b77-24b97d94c79e\", \"is_active\": true, \"size_name\": \"XS\", \"created_by\": 1, \"sort_order\": 1, \"updated_by\": 1, \"display_name\": \"Extra Small\"}}', '[]', '2026-07-11 07:47:00', '2026-07-11 07:47:00'),
(78, 'Size', 'created', 'App\\Models\\SuperAdmin\\Size', '82798aab-47e5-4131-bd77-0c9fc77b56cc', 'created', NULL, NULL, '{\"attributes\": {\"size_id\": \"82798aab-47e5-4131-bd77-0c9fc77b56cc\", \"is_active\": true, \"size_name\": \"S\", \"created_by\": 1, \"sort_order\": 2, \"updated_by\": 1, \"display_name\": \"Small\"}}', '[]', '2026-07-11 07:47:00', '2026-07-11 07:47:00'),
(79, 'Size', 'created', 'App\\Models\\SuperAdmin\\Size', '2f0131f6-0d3b-4f3f-a5b0-bcfcd234f385', 'created', NULL, NULL, '{\"attributes\": {\"size_id\": \"2f0131f6-0d3b-4f3f-a5b0-bcfcd234f385\", \"is_active\": true, \"size_name\": \"M\", \"created_by\": 1, \"sort_order\": 3, \"updated_by\": 1, \"display_name\": \"Medium\"}}', '[]', '2026-07-11 07:47:00', '2026-07-11 07:47:00'),
(80, 'Size', 'created', 'App\\Models\\SuperAdmin\\Size', 'b7643563-8ffc-4d43-9901-13e7a296aad5', 'created', NULL, NULL, '{\"attributes\": {\"size_id\": \"b7643563-8ffc-4d43-9901-13e7a296aad5\", \"is_active\": true, \"size_name\": \"L\", \"created_by\": 1, \"sort_order\": 4, \"updated_by\": 1, \"display_name\": \"Large\"}}', '[]', '2026-07-11 07:47:00', '2026-07-11 07:47:00'),
(81, 'Size', 'created', 'App\\Models\\SuperAdmin\\Size', '5a5313ea-2a12-40e5-a20e-e1fe6d161bf5', 'created', NULL, NULL, '{\"attributes\": {\"size_id\": \"5a5313ea-2a12-40e5-a20e-e1fe6d161bf5\", \"is_active\": true, \"size_name\": \"XL\", \"created_by\": 1, \"sort_order\": 5, \"updated_by\": 1, \"display_name\": \"Extra Large\"}}', '[]', '2026-07-11 07:47:00', '2026-07-11 07:47:00'),
(82, 'Size', 'created', 'App\\Models\\SuperAdmin\\Size', 'e60c2dd3-6cef-44f4-b69e-6bece0e931c0', 'created', NULL, NULL, '{\"attributes\": {\"size_id\": \"e60c2dd3-6cef-44f4-b69e-6bece0e931c0\", \"is_active\": true, \"size_name\": \"XXL\", \"created_by\": 1, \"sort_order\": 6, \"updated_by\": 1, \"display_name\": \"Double Extra Large\"}}', '[]', '2026-07-11 07:47:00', '2026-07-11 07:47:00'),
(83, 'Size', 'created', 'App\\Models\\SuperAdmin\\Size', 'fc28d5a5-73c8-4ba2-826f-1eab0a379def', 'created', NULL, NULL, '{\"attributes\": {\"size_id\": \"fc28d5a5-73c8-4ba2-826f-1eab0a379def\", \"is_active\": true, \"size_name\": \"28\", \"created_by\": 1, \"sort_order\": 7, \"updated_by\": 1, \"display_name\": \"Size 28\"}}', '[]', '2026-07-11 07:47:00', '2026-07-11 07:47:00'),
(84, 'Size', 'created', 'App\\Models\\SuperAdmin\\Size', '7086bc82-c901-428d-8eb7-3c160aacf60b', 'created', NULL, NULL, '{\"attributes\": {\"size_id\": \"7086bc82-c901-428d-8eb7-3c160aacf60b\", \"is_active\": true, \"size_name\": \"30\", \"created_by\": 1, \"sort_order\": 8, \"updated_by\": 1, \"display_name\": \"Size 30\"}}', '[]', '2026-07-11 07:47:00', '2026-07-11 07:47:00'),
(85, 'Size', 'created', 'App\\Models\\SuperAdmin\\Size', '9ae6ec5d-b355-4810-b94f-0c0e7c240f4a', 'created', NULL, NULL, '{\"attributes\": {\"size_id\": \"9ae6ec5d-b355-4810-b94f-0c0e7c240f4a\", \"is_active\": true, \"size_name\": \"32\", \"created_by\": 1, \"sort_order\": 9, \"updated_by\": 1, \"display_name\": \"Size 32\"}}', '[]', '2026-07-11 07:47:00', '2026-07-11 07:47:00'),
(86, 'Size', 'created', 'App\\Models\\SuperAdmin\\Size', '225e6f92-63ed-4322-a79c-7d31acddafca', 'created', NULL, NULL, '{\"attributes\": {\"size_id\": \"225e6f92-63ed-4322-a79c-7d31acddafca\", \"is_active\": true, \"size_name\": \"34\", \"created_by\": 1, \"sort_order\": 10, \"updated_by\": 1, \"display_name\": \"Size 34\"}}', '[]', '2026-07-11 07:47:00', '2026-07-11 07:47:00'),
(87, 'Size', 'created', 'App\\Models\\SuperAdmin\\Size', 'bdad252d-c5f6-41e3-b7cb-ca7964fda0be', 'created', NULL, NULL, '{\"attributes\": {\"size_id\": \"bdad252d-c5f6-41e3-b7cb-ca7964fda0be\", \"is_active\": true, \"size_name\": \"36\", \"created_by\": 1, \"sort_order\": 11, \"updated_by\": 1, \"display_name\": \"Size 36\"}}', '[]', '2026-07-11 07:47:00', '2026-07-11 07:47:00'),
(88, 'Size', 'created', 'App\\Models\\SuperAdmin\\Size', '31a00ff2-c2c0-436d-a1c0-4771af923e14', 'created', NULL, NULL, '{\"attributes\": {\"size_id\": \"31a00ff2-c2c0-436d-a1c0-4771af923e14\", \"is_active\": true, \"size_name\": \"38\", \"created_by\": 1, \"sort_order\": 12, \"updated_by\": 1, \"display_name\": \"Size 38\"}}', '[]', '2026-07-11 07:47:00', '2026-07-11 07:47:00'),
(89, 'Size', 'created', 'App\\Models\\SuperAdmin\\Size', '97ee9c8b-4cff-42db-b88e-b36f65568a2a', 'created', NULL, NULL, '{\"attributes\": {\"size_id\": \"97ee9c8b-4cff-42db-b88e-b36f65568a2a\", \"is_active\": true, \"size_name\": \"40\", \"created_by\": 1, \"sort_order\": 13, \"updated_by\": 1, \"display_name\": \"Size 40\"}}', '[]', '2026-07-11 07:47:00', '2026-07-11 07:47:00'),
(90, 'Size', 'created', 'App\\Models\\SuperAdmin\\Size', '5385f17d-7d72-4196-8d56-13dc60cedc77', 'created', NULL, NULL, '{\"attributes\": {\"size_id\": \"5385f17d-7d72-4196-8d56-13dc60cedc77\", \"is_active\": true, \"size_name\": \"42\", \"created_by\": 1, \"sort_order\": 14, \"updated_by\": 1, \"display_name\": \"Size 42\"}}', '[]', '2026-07-11 07:47:00', '2026-07-11 07:47:00'),
(91, 'Color', 'created', 'App\\Models\\SuperAdmin\\Color', 'dc87b5b5-81a1-423b-9d3f-9657937319a3', 'created', NULL, NULL, '{\"attributes\": {\"color_id\": \"dc87b5b5-81a1-423b-9d3f-9657937319a3\", \"hex_code\": \"#FF0000\", \"is_active\": true, \"color_name\": \"Red\", \"created_by\": 1, \"updated_by\": 1}}', '[]', '2026-07-11 07:47:00', '2026-07-11 07:47:00'),
(92, 'Color', 'created', 'App\\Models\\SuperAdmin\\Color', '7106aa1e-0e56-40b8-9707-702d68263617', 'created', NULL, NULL, '{\"attributes\": {\"color_id\": \"7106aa1e-0e56-40b8-9707-702d68263617\", \"hex_code\": \"#0000FF\", \"is_active\": true, \"color_name\": \"Blue\", \"created_by\": 1, \"updated_by\": 1}}', '[]', '2026-07-11 07:47:00', '2026-07-11 07:47:00'),
(93, 'Color', 'created', 'App\\Models\\SuperAdmin\\Color', '01733d6a-2406-4b2a-9dd3-6ae3ad83e0e4', 'created', NULL, NULL, '{\"attributes\": {\"color_id\": \"01733d6a-2406-4b2a-9dd3-6ae3ad83e0e4\", \"hex_code\": \"#00FF00\", \"is_active\": true, \"color_name\": \"Green\", \"created_by\": 1, \"updated_by\": 1}}', '[]', '2026-07-11 07:47:00', '2026-07-11 07:47:00'),
(94, 'Color', 'created', 'App\\Models\\SuperAdmin\\Color', '3596ffe0-7324-4c2d-bfd6-50756181b998', 'created', NULL, NULL, '{\"attributes\": {\"color_id\": \"3596ffe0-7324-4c2d-bfd6-50756181b998\", \"hex_code\": \"#000000\", \"is_active\": true, \"color_name\": \"Black\", \"created_by\": 1, \"updated_by\": 1}}', '[]', '2026-07-11 07:47:00', '2026-07-11 07:47:00'),
(95, 'Color', 'created', 'App\\Models\\SuperAdmin\\Color', '451cc020-0a11-4f4d-86f7-33fc73ac43c3', 'created', NULL, NULL, '{\"attributes\": {\"color_id\": \"451cc020-0a11-4f4d-86f7-33fc73ac43c3\", \"hex_code\": \"#FFFFFF\", \"is_active\": true, \"color_name\": \"White\", \"created_by\": 1, \"updated_by\": 1}}', '[]', '2026-07-11 07:47:00', '2026-07-11 07:47:00'),
(96, 'Color', 'created', 'App\\Models\\SuperAdmin\\Color', '56051ca8-1afc-4bc9-a56f-989e207cbcbb', 'created', NULL, NULL, '{\"attributes\": {\"color_id\": \"56051ca8-1afc-4bc9-a56f-989e207cbcbb\", \"hex_code\": \"#FFFF00\", \"is_active\": true, \"color_name\": \"Yellow\", \"created_by\": 1, \"updated_by\": 1}}', '[]', '2026-07-11 07:47:00', '2026-07-11 07:47:00'),
(97, 'Color', 'created', 'App\\Models\\SuperAdmin\\Color', '8ba13404-03c2-4f6f-8681-76dcf65fd308', 'created', NULL, NULL, '{\"attributes\": {\"color_id\": \"8ba13404-03c2-4f6f-8681-76dcf65fd308\", \"hex_code\": \"#808080\", \"is_active\": true, \"color_name\": \"Grey\", \"created_by\": 1, \"updated_by\": 1}}', '[]', '2026-07-11 07:47:00', '2026-07-11 07:47:00'),
(98, 'Color', 'created', 'App\\Models\\SuperAdmin\\Color', 'ac898440-7005-49c9-b87f-7da60e3f74d5', 'created', NULL, NULL, '{\"attributes\": {\"color_id\": \"ac898440-7005-49c9-b87f-7da60e3f74d5\", \"hex_code\": \"#000080\", \"is_active\": true, \"color_name\": \"Navy Blue\", \"created_by\": 1, \"updated_by\": 1}}', '[]', '2026-07-11 07:47:00', '2026-07-11 07:47:00'),
(99, 'Color', 'created', 'App\\Models\\SuperAdmin\\Color', 'd834d5f1-b515-4441-802c-ee9c5335aa14', 'created', NULL, NULL, '{\"attributes\": {\"color_id\": \"d834d5f1-b515-4441-802c-ee9c5335aa14\", \"hex_code\": \"#800000\", \"is_active\": true, \"color_name\": \"Maroon\", \"created_by\": 1, \"updated_by\": 1}}', '[]', '2026-07-11 07:47:00', '2026-07-11 07:47:00'),
(100, 'Color', 'created', 'App\\Models\\SuperAdmin\\Color', '4f4b1d74-ae72-488e-8fe7-72b2a5598d7e', 'created', NULL, NULL, '{\"attributes\": {\"color_id\": \"4f4b1d74-ae72-488e-8fe7-72b2a5598d7e\", \"hex_code\": \"#87CEEB\", \"is_active\": true, \"color_name\": \"Sky Blue\", \"created_by\": 1, \"updated_by\": 1}}', '[]', '2026-07-11 07:47:00', '2026-07-11 07:47:00'),
(101, 'Color', 'created', 'App\\Models\\SuperAdmin\\Color', '702a7f74-78e5-42fc-8fe3-80f5572171a5', 'created', NULL, NULL, '{\"attributes\": {\"color_id\": \"702a7f74-78e5-42fc-8fe3-80f5572171a5\", \"hex_code\": \"#F0E68C\", \"is_active\": true, \"color_name\": \"Khaki\", \"created_by\": 1, \"updated_by\": 1}}', '[]', '2026-07-11 07:47:00', '2026-07-11 07:47:00'),
(102, 'ParentCategory', 'created', 'App\\Models\\SuperAdmin\\ParentCategory', 'f9dc9a0a-03b1-41b7-8307-0aafffc0e70b', 'created', NULL, NULL, '{\"attributes\": {\"name\": \"Uniform\", \"is_active\": true, \"parent_id\": \"f9dc9a0a-03b1-41b7-8307-0aafffc0e70b\", \"created_by\": 1, \"updated_by\": null}}', '[]', '2026-07-11 07:47:00', '2026-07-11 07:47:00'),
(103, 'Category', 'created', 'App\\Models\\SuperAdmin\\Category', '407e25aa-0667-46c7-b552-ac3d08f48f77', 'created', NULL, NULL, '{\"attributes\": {\"is_active\": true, \"parent_id\": \"f9dc9a0a-03b1-41b7-8307-0aafffc0e70b\", \"created_by\": 1, \"updated_by\": null, \"category_id\": \"407e25aa-0667-46c7-b552-ac3d08f48f77\", \"category_name\": \"Shirt\", \"requires_size\": true}}', '[]', '2026-07-11 07:47:00', '2026-07-11 07:47:00'),
(104, 'Category', 'created', 'App\\Models\\SuperAdmin\\Category', '75404121-6a0e-417c-b86a-881f931738ba', 'created', NULL, NULL, '{\"attributes\": {\"is_active\": true, \"parent_id\": \"f9dc9a0a-03b1-41b7-8307-0aafffc0e70b\", \"created_by\": 1, \"updated_by\": null, \"category_id\": \"75404121-6a0e-417c-b86a-881f931738ba\", \"category_name\": \"Trouser\", \"requires_size\": true}}', '[]', '2026-07-11 07:47:00', '2026-07-11 07:47:00'),
(105, 'Category', 'created', 'App\\Models\\SuperAdmin\\Category', '4c9545e4-9d93-4cfd-89c3-2fdb72f77986', 'created', NULL, NULL, '{\"attributes\": {\"is_active\": true, \"parent_id\": \"f9dc9a0a-03b1-41b7-8307-0aafffc0e70b\", \"created_by\": 1, \"updated_by\": null, \"category_id\": \"4c9545e4-9d93-4cfd-89c3-2fdb72f77986\", \"category_name\": \"Skirt\", \"requires_size\": true}}', '[]', '2026-07-11 07:47:00', '2026-07-11 07:47:00'),
(106, 'Category', 'created', 'App\\Models\\SuperAdmin\\Category', 'cc5a5f4a-fb4e-4e0e-9f79-7658aeff770a', 'created', NULL, NULL, '{\"attributes\": {\"is_active\": true, \"parent_id\": \"f9dc9a0a-03b1-41b7-8307-0aafffc0e70b\", \"created_by\": 1, \"updated_by\": null, \"category_id\": \"cc5a5f4a-fb4e-4e0e-9f79-7658aeff770a\", \"category_name\": \"Blazer\", \"requires_size\": true}}', '[]', '2026-07-11 07:47:00', '2026-07-11 07:47:00'),
(107, 'ParentCategory', 'created', 'App\\Models\\SuperAdmin\\ParentCategory', '1fb11227-ea7a-45e1-a1ea-f818cfe03a90', 'created', NULL, NULL, '{\"attributes\": {\"name\": \"Stationery\", \"is_active\": true, \"parent_id\": \"1fb11227-ea7a-45e1-a1ea-f818cfe03a90\", \"created_by\": 1, \"updated_by\": null}}', '[]', '2026-07-11 07:47:00', '2026-07-11 07:47:00'),
(108, 'Category', 'created', 'App\\Models\\SuperAdmin\\Category', '77529e24-de45-4b4c-b2a2-ec5484051dfe', 'created', NULL, NULL, '{\"attributes\": {\"is_active\": true, \"parent_id\": \"1fb11227-ea7a-45e1-a1ea-f818cfe03a90\", \"created_by\": 1, \"updated_by\": null, \"category_id\": \"77529e24-de45-4b4c-b2a2-ec5484051dfe\", \"category_name\": \"Notebook\", \"requires_size\": false}}', '[]', '2026-07-11 07:47:00', '2026-07-11 07:47:00'),
(109, 'Category', 'created', 'App\\Models\\SuperAdmin\\Category', 'a31fdc23-1229-4273-9dee-bbfe83b21de6', 'created', NULL, NULL, '{\"attributes\": {\"is_active\": true, \"parent_id\": \"1fb11227-ea7a-45e1-a1ea-f818cfe03a90\", \"created_by\": 1, \"updated_by\": null, \"category_id\": \"a31fdc23-1229-4273-9dee-bbfe83b21de6\", \"category_name\": \"Pen\", \"requires_size\": false}}', '[]', '2026-07-11 07:47:00', '2026-07-11 07:47:00'),
(110, 'ParentCategory', 'created', 'App\\Models\\SuperAdmin\\ParentCategory', '66820cd2-97d5-4195-8340-996e09241925', 'created', NULL, NULL, '{\"attributes\": {\"name\": \"Accessory\", \"is_active\": true, \"parent_id\": \"66820cd2-97d5-4195-8340-996e09241925\", \"created_by\": 1, \"updated_by\": null}}', '[]', '2026-07-11 07:47:00', '2026-07-11 07:47:00'),
(111, 'Category', 'created', 'App\\Models\\SuperAdmin\\Category', 'a0a772a3-a3bf-47f3-87ce-b83a30a5e5dc', 'created', NULL, NULL, '{\"attributes\": {\"is_active\": true, \"parent_id\": \"66820cd2-97d5-4195-8340-996e09241925\", \"created_by\": 1, \"updated_by\": null, \"category_id\": \"a0a772a3-a3bf-47f3-87ce-b83a30a5e5dc\", \"category_name\": \"Bag\", \"requires_size\": false}}', '[]', '2026-07-11 07:47:00', '2026-07-11 07:47:00'),
(112, 'Category', 'created', 'App\\Models\\SuperAdmin\\Category', 'b7e2a67e-5587-457f-9806-2dfd7dab33b1', 'created', NULL, NULL, '{\"attributes\": {\"is_active\": true, \"parent_id\": \"66820cd2-97d5-4195-8340-996e09241925\", \"created_by\": 1, \"updated_by\": null, \"category_id\": \"b7e2a67e-5587-457f-9806-2dfd7dab33b1\", \"category_name\": \"Belt\", \"requires_size\": true}}', '[]', '2026-07-11 07:47:00', '2026-07-11 07:47:00'),
(113, 'ParentCategory', 'created', 'App\\Models\\SuperAdmin\\ParentCategory', '0d08216d-61bf-4565-b985-1818045603d3', 'created', NULL, NULL, '{\"attributes\": {\"name\": \"Footwear\", \"is_active\": true, \"parent_id\": \"0d08216d-61bf-4565-b985-1818045603d3\", \"created_by\": 1, \"updated_by\": null}}', '[]', '2026-07-11 07:47:00', '2026-07-11 07:47:00'),
(114, 'Category', 'created', 'App\\Models\\SuperAdmin\\Category', 'ed35efa5-5cb0-4fd2-8cde-4efaae3be06d', 'created', NULL, NULL, '{\"attributes\": {\"is_active\": true, \"parent_id\": \"0d08216d-61bf-4565-b985-1818045603d3\", \"created_by\": 1, \"updated_by\": null, \"category_id\": \"ed35efa5-5cb0-4fd2-8cde-4efaae3be06d\", \"category_name\": \"Shoes\", \"requires_size\": true}}', '[]', '2026-07-11 07:47:00', '2026-07-11 07:47:00'),
(115, 'Category', 'created', 'App\\Models\\SuperAdmin\\Category', '439caf6e-510f-44a4-b73b-62857ba89ecf', 'created', NULL, NULL, '{\"attributes\": {\"is_active\": true, \"parent_id\": \"0d08216d-61bf-4565-b985-1818045603d3\", \"created_by\": 1, \"updated_by\": null, \"category_id\": \"439caf6e-510f-44a4-b73b-62857ba89ecf\", \"category_name\": \"Socks\", \"requires_size\": true}}', '[]', '2026-07-11 07:47:00', '2026-07-11 07:47:00'),
(116, 'User', 'created', 'App\\Models\\User', '2', 'created', NULL, NULL, '{\"attributes\":{\"name\":\"Pavnish Tiwari\",\"username\":null,\"email\":\"pavnish@gmail.com\",\"avatar\":null,\"logo_url\":null,\"phone\":null,\"password\":\"$2y$12$TE4pl.WKxNwaIcaJ.IngfeC7Sp\\/tdxxurv5pSz8wMDxURQrmZn3M6\",\"is_active\":1,\"image_id\":null}}', '[]', '2026-07-11 19:42:24', '2026-07-11 19:42:24'),
(117, 'WebUser', 'created', 'App\\Models\\WebUser', '1', 'created', NULL, NULL, '{\"attributes\":{\"user_id\":2,\"address\":\"KOHRANV KUKUWAR PATTI PRATAPGARH\",\"city\":\"Pratapgarh\",\"state\":\"Uttar Pradesh\",\"zip_code\":\"230135\",\"alternate_phone\":null,\"gender\":\"Male\",\"date_of_birth\":\"2026-07-12\",\"national_id\":null,\"emergency_contact_name\":null,\"emergency_contact_phone\":null,\"emergency_contact_relationship\":null,\"notes\":null}}', '[]', '2026-07-11 19:42:24', '2026-07-11 19:42:24'),
(118, 'User', 'created', 'App\\Models\\User', '3', 'created', NULL, NULL, '{\"attributes\":{\"name\":\"AJAY KUMAR SHARMA\",\"username\":null,\"email\":\"ajaykr.1891@gmail.com\",\"avatar\":null,\"logo_url\":null,\"phone\":null,\"password\":\"$2y$12$tNJTQIqUbcvMS1pv57IInetIJ5fLDFvfcOhWLEwCaUF8gMrfYUugi\",\"is_active\":1,\"image_id\":null}}', '[]', '2026-07-11 19:51:05', '2026-07-11 19:51:05'),
(119, 'WebUser', 'created', 'App\\Models\\WebUser', '2', 'created', NULL, NULL, '{\"attributes\":{\"user_id\":3,\"address\":\"Dadri\",\"city\":\"Greater noida\",\"state\":\"Uttar Pradesh\",\"zip_code\":\"201310\",\"alternate_phone\":\"727277711\",\"gender\":\"Male\",\"date_of_birth\":\"2026-07-12\",\"national_id\":null,\"emergency_contact_name\":\"AJAY KUMAR SHARMA\",\"emergency_contact_phone\":\"8288811991\",\"emergency_contact_relationship\":null,\"notes\":null}}', '[]', '2026-07-11 19:51:05', '2026-07-11 19:51:05'),
(120, 'User', 'created', 'App\\Models\\User', '4', 'created', 'App\\Models\\User', '1', '{\"attributes\":{\"name\":\"Abc\",\"username\":null,\"email\":\"ajay.inkubis@gmail.com\",\"avatar\":null,\"logo_url\":null,\"phone\":\"7277711891\",\"password\":null,\"is_active\":1,\"image_id\":null}}', '[]', '2026-07-12 04:29:36', '2026-07-12 04:29:36'),
(121, 'Vendor', 'created', 'App\\Models\\SuperAdmin\\Vendor', 'c1f2bfd1-c4c8-4bd7-8add-67be3e47edca', 'created', 'App\\Models\\User', '1', '{\"attributes\":{\"user_id\":4,\"business_name\":\"Abc\",\"owner_name\":\"Ajay\",\"email\":\"ajay.inkubis@gmail.com\",\"phone\":\"7277711891\",\"address\":\"GREATER Noida\",\"city\":\"Greater Noida\",\"state\":\"Up\",\"pincode\":\"23207\",\"gstin\":null,\"pan_number\":null,\"bank_account_no\":null,\"ifsc_code\":null,\"commission_rate\":\"0.00\",\"status\":\"pending\",\"logo_url\":null,\"is_active\":\"1\",\"created_by\":1,\"updated_by\":1,\"image_id\":null}}', '[]', '2026-07-12 04:29:36', '2026-07-12 04:29:36'),
(122, 'Vendor', 'updated', 'App\\Models\\SuperAdmin\\Vendor', 'c1f2bfd1-c4c8-4bd7-8add-67be3e47edca', 'updated', 'App\\Models\\User', '1', '{\"attributes\":{\"status\":\"approved\"},\"old\":{\"status\":\"pending\"}}', '[]', '2026-07-12 04:30:57', '2026-07-12 04:30:57'),
(123, 'User', 'created', 'App\\Models\\User', '5', 'created', 'App\\Models\\User', '1', '{\"attributes\":{\"name\":\"A2M TRADERS\",\"username\":null,\"email\":\"akshit.a2mtraders@gmail.com\",\"avatar\":null,\"logo_url\":null,\"phone\":\"8750095254\",\"password\":null,\"is_active\":1,\"image_id\":null}}', '[]', '2026-07-12 17:27:41', '2026-07-12 17:27:41'),
(124, 'Vendor', 'created', 'App\\Models\\SuperAdmin\\Vendor', '567dc24f-0b63-4fe3-a2a6-d4fdee507dc3', 'created', 'App\\Models\\User', '1', '{\"attributes\":{\"user_id\":5,\"business_name\":\"A2M TRADERS\",\"owner_name\":\"Akshit\",\"email\":\"akshit.a2mtraders@gmail.com\",\"phone\":\"8750095254\",\"address\":\"A2M Traders, Niyader ganj\",\"city\":\"Dadri\",\"state\":\"Uttar Pradesh\",\"pincode\":\"203207\",\"gstin\":\"09BXGPG1377Q1ZU\",\"pan_number\":\"BXGPG1377Q\",\"bank_account_no\":null,\"ifsc_code\":null,\"commission_rate\":\"0.00\",\"status\":\"pending\",\"logo_url\":null,\"is_active\":\"1\",\"created_by\":1,\"updated_by\":1,\"image_id\":null}}', '[]', '2026-07-12 17:27:41', '2026-07-12 17:27:41'),
(125, 'User', 'updated', 'App\\Models\\User', '1', 'updated', NULL, NULL, '{\"attributes\":{\"password\":\"$2y$12$s..JyAjfqNfy00Iq802FeeMo7xBBx4dkOIV.BeDvylAymF3gT.VZC\"},\"old\":{\"password\":\"$2y$12$z\\/fgcEczq7hdul2GFGeq7eAyuxt5cwNsWnORyXqxHKq3nar9gO\\/l6\"}}', '[]', '2026-07-13 16:13:22', '2026-07-13 16:13:22'),
(126, 'Vendor', 'updated', 'App\\Models\\SuperAdmin\\Vendor', '567dc24f-0b63-4fe3-a2a6-d4fdee507dc3', 'updated', 'App\\Models\\User', '1', '{\"attributes\":{\"status\":\"approved\"},\"old\":{\"status\":\"pending\"}}', '[]', '2026-07-13 16:17:20', '2026-07-13 16:17:20'),
(127, 'User', 'created', 'App\\Models\\User', '8', 'created', 'App\\Models\\User', '1', '{\"attributes\":{\"name\":\"TEST1\",\"username\":null,\"email\":\"ergoyalakshit@gmail.com\",\"avatar\":null,\"logo_url\":null,\"phone\":\"8077526201\",\"password\":null,\"is_active\":1,\"image_id\":null}}', '[]', '2026-07-13 16:19:58', '2026-07-13 16:19:58');
INSERT INTO `activity_log` (`id`, `log_name`, `description`, `subject_type`, `subject_id`, `event`, `causer_type`, `causer_id`, `attribute_changes`, `properties`, `created_at`, `updated_at`) VALUES
(128, 'Vendor', 'created', 'App\\Models\\SuperAdmin\\Vendor', '2143c59f-4521-40e8-a2de-054d89dcde64', 'created', 'App\\Models\\User', '1', '{\"attributes\":{\"user_id\":8,\"business_name\":\"TEST1\",\"owner_name\":\"TEWST\",\"email\":\"ergoyalakshit@gmail.com\",\"phone\":\"8077526201\",\"address\":\"TESTR\",\"city\":\"TEST\",\"state\":\"TWDRF\",\"pincode\":\"203207\",\"gstin\":\"09BXGPG1377Q1ZU\",\"pan_number\":\"BXGPG1377Q\",\"bank_account_no\":null,\"ifsc_code\":null,\"commission_rate\":\"0.00\",\"status\":\"pending\",\"logo_url\":null,\"is_active\":\"1\",\"created_by\":1,\"updated_by\":1,\"image_id\":null}}', '[]', '2026-07-13 16:19:58', '2026-07-13 16:19:58'),
(129, 'User', 'updated', 'App\\Models\\User', '8', 'updated', NULL, NULL, '{\"attributes\":{\"username\":\"Test1\",\"password\":\"$2y$12$yokw5N0Y3ui\\/DRb0d.uYiuLTnT3ujmKvcgiGG9Gxnzor4DZ0PqUp2\"},\"old\":{\"username\":null,\"password\":null}}', '[]', '2026-07-13 16:21:42', '2026-07-13 16:21:42'),
(130, 'Role', 'updated', 'App\\Models\\RolePermission\\Role', '4', 'updated', 'App\\Models\\User', '1', '{\"attributes\":{\"role_category\":\"vendor\"},\"old\":{\"role_category\":null}}', '[]', '2026-07-13 16:23:54', '2026-07-13 16:23:54'),
(131, 'Product', 'created', 'App\\Models\\SuperAdmin\\Product', '87b20b5f-4515-4904-b065-0480b9c088b9', 'created', 'App\\Models\\User', '8', '{\"attributes\":{\"product_id\":\"87b20b5f-4515-4904-b065-0480b9c088b9\",\"vendor_id\":\"2143c59f-4521-40e8-a2de-054d89dcde64\",\"category_id\":\"407e25aa-0667-46c7-b552-ac3d08f48f77\",\"product_code\":\"MHPS-SHIRT-FS\",\"product_name\":\"MHPS SENIOR SHIRTS\",\"slug\":\"mhps-shirt-fs\",\"meta_title\":null,\"meta_description\":null,\"meta_keywords\":null,\"description\":null,\"fabric_composition\":null,\"gender_type\":\"unisex\",\"approval_status\":\"pending\",\"approved_by\":null,\"approved_at\":null,\"rejected_by\":null,\"rejected_at\":null,\"rejection_reason\":null,\"is_active\":true,\"created_by\":8,\"updated_by\":8,\"deleted_by\":null}}', '[]', '2026-07-13 16:53:39', '2026-07-13 16:53:39'),
(132, 'ProductVariant', 'created', 'App\\Models\\SuperAdmin\\ProductVariant', '2a6440f7-7651-4dc4-ab94-9cee391d6e94', 'created', 'App\\Models\\User', '8', '{\"attributes\":{\"variant_id\":\"2a6440f7-7651-4dc4-ab94-9cee391d6e94\",\"product_id\":\"87b20b5f-4515-4904-b065-0480b9c088b9\",\"sku\":\"MHPSSHFS28\",\"size_id\":\"fc28d5a5-73c8-4ba2-826f-1eab0a379def\",\"color_id\":null,\"mrp\":\"100.00\",\"selling_price\":\"90.00\",\"stock_qty\":10,\"low_stock_alert\":5,\"low_stock_notified_at\":null,\"barcode\":null,\"is_active\":true,\"created_by\":8,\"updated_by\":8,\"deleted_by\":null}}', '[]', '2026-07-13 16:53:39', '2026-07-13 16:53:39'),
(137, 'Product', 'updated', 'App\\Models\\SuperAdmin\\Product', '87b20b5f-4515-4904-b065-0480b9c088b9', 'updated', 'App\\Models\\User', '1', '{\"attributes\":{\"vendor_id\":\"567dc24f-0b63-4fe3-a2a6-d4fdee507dc3\",\"updated_by\":1},\"old\":{\"vendor_id\":\"2143c59f-4521-40e8-a2de-054d89dcde64\",\"updated_by\":8}}', '[]', '2026-07-13 16:57:17', '2026-07-13 16:57:17'),
(139, 'ParentCategory', 'created', 'App\\Models\\SuperAdmin\\ParentCategory', '362db172-e371-4f72-b168-3a6ea0062a99', 'created', 'App\\Models\\User', '1', '{\"attributes\":{\"parent_id\":\"362db172-e371-4f72-b168-3a6ea0062a99\",\"name\":\"UNIFORMS\",\"is_active\":true,\"created_by\":1,\"updated_by\":1}}', '[]', '2026-07-13 17:04:26', '2026-07-13 17:04:26'),
(142, 'Product', 'updated', 'App\\Models\\SuperAdmin\\Product', '87b20b5f-4515-4904-b065-0480b9c088b9', 'updated', 'App\\Models\\User', '1', '{\"attributes\":{\"approval_status\":\"approved\"},\"old\":{\"approval_status\":\"pending\"}}', '[]', '2026-07-13 17:31:33', '2026-07-13 17:31:33'),
(143, 'Product', 'updated', 'App\\Models\\SuperAdmin\\Product', '87b20b5f-4515-4904-b065-0480b9c088b9', 'updated', 'App\\Models\\User', '1', '{\"attributes\":{\"approval_status\":\"pending\"},\"old\":{\"approval_status\":\"approved\"}}', '[]', '2026-07-13 17:36:21', '2026-07-13 17:36:21'),
(144, 'Product', 'updated', 'App\\Models\\SuperAdmin\\Product', '87b20b5f-4515-4904-b065-0480b9c088b9', 'updated', 'App\\Models\\User', '1', '{\"attributes\":{\"approval_status\":\"approved\"},\"old\":{\"approval_status\":\"pending\"}}', '[]', '2026-07-13 17:36:38', '2026-07-13 17:36:38'),
(145, 'User', 'created', 'App\\Models\\User', '13', 'created', 'App\\Models\\User', '1', '{\"attributes\":{\"name\":\"Uniform\",\"username\":null,\"email\":\"digiwaretechno@gmail.com\",\"avatar\":null,\"logo_url\":null,\"phone\":\"8130224328\",\"password\":null,\"is_active\":1,\"image_id\":null}}', '[]', '2026-07-14 17:05:12', '2026-07-14 17:05:12'),
(146, 'Vendor', 'created', 'App\\Models\\SuperAdmin\\Vendor', 'dde3bca1-90ca-4afd-9061-63ebd4a9be76', 'created', 'App\\Models\\User', '1', '{\"attributes\":{\"user_id\":13,\"business_name\":\"Uniform\",\"owner_name\":\"Ajay\",\"email\":\"digiwaretechno@gmail.com\",\"phone\":\"8130224328\",\"address\":\"GRE\",\"city\":\"Greater noida\",\"state\":\"Uttar Pradesh\",\"pincode\":\"201310\",\"gstin\":null,\"pan_number\":null,\"bank_account_no\":null,\"ifsc_code\":null,\"commission_rate\":\"0.00\",\"status\":\"approved\",\"logo_url\":null,\"is_active\":\"1\",\"created_by\":1,\"updated_by\":1,\"image_id\":null}}', '[]', '2026-07-14 17:05:12', '2026-07-14 17:05:12'),
(147, 'User', 'updated', 'App\\Models\\User', '13', 'updated', NULL, NULL, '{\"attributes\":{\"username\":\"ajaykr.1891\",\"password\":\"$2y$12$6RjH8V.OqqUe4mblnu3E1.7h7sJ5fl0M5he4u2q\\/JQO5gATDU0IbG\"},\"old\":{\"username\":null,\"password\":null}}', '[]', '2026-07-14 17:07:08', '2026-07-14 17:07:08');

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `carts`
--

CREATE TABLE `carts` (
  `cart_id` char(36) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `school_id` char(36) DEFAULT NULL,
  `session_id` varchar(255) DEFAULT NULL,
  `status` enum('active','converted','abandoned','completed') NOT NULL DEFAULT 'active',
  `converted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `carts`
--

INSERT INTO `carts` (`cart_id`, `user_id`, `school_id`, `session_id`, `status`, `converted_at`, `created_at`, `updated_at`) VALUES
('0782ec1a-138d-4374-adcb-481401a8b12f', NULL, NULL, 'tv1o4IZL5FoaaBZuur13WFRsqEUYB3DYpzXjfFws', 'active', NULL, '2026-07-17 01:56:31', '2026-07-17 01:56:31'),
('0783e42c-2574-4636-afa1-5307b4f9cc30', 3, NULL, 'LNIjMCQKTznMMR8kuqvyzTKWtfHjyEEZkpK3bKuX', 'active', NULL, '2026-07-11 19:51:10', '2026-07-11 19:51:10'),
('17b52560-bbcf-404e-883a-92a9afd6ede6', NULL, NULL, 'VLIh72XtETC37i6HaKtLtkwU9y44my52DqHmBgiA', 'active', NULL, '2026-07-12 04:27:29', '2026-07-12 04:27:29'),
('19c1b9b0-61ad-45be-922c-84be775a8acb', NULL, NULL, 'sWLystUOZFgQWFnEu4vqpNXjlTlNNgge55jh901N', 'active', NULL, '2026-07-13 16:05:39', '2026-07-13 16:05:39'),
('23625806-713a-4ab3-ad5f-4180cd00fa13', 2, NULL, 'JLvrJ5uXDHU7JUYB1rYnp2FR2ETGGeW9aOFLWxzq', 'active', NULL, '2026-07-11 19:42:28', '2026-07-11 19:42:28'),
('2723e817-89bc-433c-a31e-23c72a00faf2', NULL, NULL, 'JTcEuMgFAmHDYEEf3RFNeC6S9edYpTJlkxHSZ0PE', 'active', NULL, '2026-07-11 19:23:47', '2026-07-11 19:23:47'),
('2819a32f-f304-4a40-8556-bb6d94f7e4d8', 8, NULL, 'd3qW13ARUZ0cTFChFhWY2momp6asPlkWLTgxHWnx', 'active', NULL, '2026-07-13 17:08:49', '2026-07-13 17:08:49'),
('2a3f7295-5067-4c89-991e-1f0c651d55d3', NULL, NULL, '1gd1RUAVal3LJT6g67NetcGNP843hPzv2bHqAIFI', 'active', NULL, '2026-07-13 04:53:36', '2026-07-13 04:53:36'),
('2c8d7c2c-6b59-45a7-bfc3-c3661c9f7a05', NULL, NULL, 'tkbQg5mrX2PLCXrBvF2qs1XkQjX0mzj2jwCwgaEO', 'active', NULL, '2026-07-13 16:59:44', '2026-07-13 16:59:44'),
('2d3cde2a-5c51-4d36-bcbe-ce9c77c56784', NULL, NULL, 'Q6tlEQnFJoPknHMoeSUa26ZgwXKAiWAhnRJdxesB', 'active', NULL, '2026-07-14 19:15:10', '2026-07-14 19:15:10'),
('40243f5f-3faa-4c30-a170-3fb7468e8bd7', NULL, NULL, '6GG81OXek3sATkNvH3w8OMGuZF4lM3TEYibNIJp8', 'active', NULL, '2026-07-13 16:23:06', '2026-07-13 16:23:06'),
('43e564f1-8f0e-4fc5-932b-976dd2b582ca', NULL, NULL, 'ugE6TFGEAjHbvDJjbMeEMlfyuPSam34tGHQK4QxI', 'active', NULL, '2026-07-14 15:00:13', '2026-07-14 15:00:13'),
('542a7e0f-1a4c-401b-88b3-f1755e969c8b', NULL, NULL, 'N4bHUUTMTa90JDdHRKupsJQ6GVeR6p9N6U1mVkX6', 'active', NULL, '2026-07-15 02:29:50', '2026-07-15 02:29:50'),
('5a9edb7e-ba88-4de4-b23b-ed8ba6b0f87b', 1, NULL, 'ddmYNwJ9RNXc6LAIvA6FgXMfq4XUoox0dyZDcJOw', 'active', NULL, '2026-07-13 17:32:41', '2026-07-13 17:32:41'),
('5c7ef258-f763-4719-b1e9-afca2e4123d4', NULL, NULL, 'KB38QZfv131XASue0bV9xa1e63bNhh8FQ3uxxcuu', 'active', NULL, '2026-07-13 15:00:24', '2026-07-13 15:00:24'),
('7bc442c2-78c0-4fa4-95d2-d89682f1c60d', NULL, NULL, 'LT93xtNDpOzOdSgg9FAwTWYWzEmq3NYRvteY1Q63', 'active', NULL, '2026-07-16 03:07:55', '2026-07-16 03:07:55'),
('8e52ef02-7d3f-4752-9299-828443b81f56', NULL, NULL, 'Wd4nz9fYYiO9vUVG9PGYCrmyyq0f16VWQzpLxrRa', 'active', NULL, '2026-07-15 11:18:03', '2026-07-15 11:18:03'),
('97c9cca9-714b-48af-adb9-eced22e0f21c', NULL, NULL, '4Z6zOF9LgmtG1mWa7wKRNyM0mBpDTGfojUbT6zCx', 'active', NULL, '2026-07-13 03:55:18', '2026-07-13 03:55:18'),
('a21c723c-ac75-4028-b31a-b1b31c7c1a4a', NULL, NULL, 'ePribd3wtrpYS1jR5XjQCnhBT7cCN9VoCtlJpU3K', 'active', NULL, '2026-07-12 17:14:07', '2026-07-12 17:14:07'),
('a21fe319-f5e0-4ad0-b3f9-916081a3a28e', NULL, NULL, 'eEmggyzOpbM2eFrKeCY5aJAWtefHRApHOuZwBOiA', 'active', NULL, '2026-07-13 03:47:24', '2026-07-13 03:47:24'),
('a249ed0d-cb91-4745-a79a-2f02f19eb206', NULL, NULL, 'edxRnMcfBGBdfDStuAr4t3uK8uWAczRnAsCg3P6q', 'active', NULL, '2026-07-11 19:20:10', '2026-07-11 19:20:10'),
('ba068a4c-9eb5-472b-9403-d45d47c7fb39', NULL, NULL, 'o5uhq3a6bC4AqfcCNlHrXU4DTnm1Xr8jwimOxhTA', 'active', NULL, '2026-07-13 15:13:09', '2026-07-13 15:13:09'),
('c661fc5b-41d2-4651-be2a-61a1fcba968b', NULL, NULL, 'OUqtK6DpO9630OQyWIkAlGY7VWCrEiDdYBCDvDMH', 'active', NULL, '2026-07-11 19:38:41', '2026-07-11 19:38:41'),
('c6bb649a-c5c9-46a8-ac81-40b5bc7d5246', NULL, NULL, 'wVdryzE0Y2ekj2SPN884Cd6mrRT9KcB92y09a7oQ', 'active', NULL, '2026-07-13 16:22:02', '2026-07-13 16:22:02'),
('c9c96f17-b6ef-476a-a2c8-a900122aebf7', NULL, NULL, 'JPYJFDfBNfnbol0Lo8NjnfFhECOoTgduqMQTQO8e', 'active', NULL, '2026-07-12 04:31:19', '2026-07-12 04:31:19'),
('d5f58f3e-168c-458e-8ab4-a15121773512', NULL, NULL, 'kfrNcpIuQmJt6LhqixeOTjhHFoCq9EGcroxv95bc', 'active', NULL, '2026-07-17 03:01:52', '2026-07-17 03:01:52'),
('d6ddde5c-39b6-4a22-af26-332801666080', NULL, NULL, 'ZMaoPVSPhAPFGbAjLxIT0s8I9EXUZNJdNkixF0he', 'active', NULL, '2026-07-14 17:03:07', '2026-07-14 17:03:07'),
('dee3fd3b-84bd-4d3d-bbd4-bbed787d070e', NULL, NULL, 'baGlGS1sYGqF6JB5N9prgKJrb3v3BVEGAFjv7PxM', 'active', NULL, '2026-07-11 19:47:05', '2026-07-11 19:47:05'),
('e2b3f32a-5ca7-463a-bfb3-ec06fc00ca35', NULL, NULL, 'F3vMaq7FwxB8zhJl0yVRvQydWDOxCSb4j0P3GsM8', 'active', NULL, '2026-07-13 12:14:53', '2026-07-13 12:14:53'),
('e535e2e4-b993-41a2-b019-744fc6c3d409', NULL, NULL, 'SLBZAjg3LamR4WrTzHMLV73145ayeEyscKint9Wd', 'active', NULL, '2026-07-11 19:49:49', '2026-07-11 19:49:49'),
('e9f37e5a-65cc-491b-9aea-48ea787a04ed', NULL, NULL, 'TGrHhXflP2ktIYQGFr0ZcCy68tgvTyi4sqCMLHGf', 'active', NULL, '2026-07-17 03:02:11', '2026-07-17 03:02:11'),
('ee53d3f0-2a99-4493-b3bd-44fe82180677', NULL, NULL, 'yHsgwL6TX39DWq5wc55zObozuYKCrkNDx6xIL9c1', 'active', NULL, '2026-07-12 13:58:23', '2026-07-12 13:58:23'),
('f2b12dd1-edad-484f-8300-2edee2a4478e', NULL, NULL, '568UL2TXI6bjsxLoq9ezax9n5SWxOsIo7gjqORjU', 'active', NULL, '2026-07-12 17:09:23', '2026-07-12 17:09:23');

-- --------------------------------------------------------

--
-- Table structure for table `cart_items`
--

CREATE TABLE `cart_items` (
  `cart_item_id` char(36) NOT NULL,
  `cart_id` char(36) NOT NULL,
  `product_id` char(36) NOT NULL,
  `variant_id` char(36) DEFAULT NULL,
  `vendor_id` char(36) DEFAULT NULL,
  `quantity` int(10) UNSIGNED NOT NULL DEFAULT 1,
  `unit_price` decimal(10,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `category_id` char(36) NOT NULL,
  `parent_id` char(36) DEFAULT NULL,
  `category_name` varchar(80) NOT NULL,
  `requires_size` tinyint(1) NOT NULL DEFAULT 1,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_by` bigint(20) UNSIGNED DEFAULT NULL,
  `updated_by` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`category_id`, `parent_id`, `category_name`, `requires_size`, `is_active`, `created_by`, `updated_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
('407e25aa-0667-46c7-b552-ac3d08f48f77', 'f9dc9a0a-03b1-41b7-8307-0aafffc0e70b', 'Shirt', 1, 1, 1, NULL, '2026-07-11 07:47:00', '2026-07-11 07:47:00', NULL),
('439caf6e-510f-44a4-b73b-62857ba89ecf', '0d08216d-61bf-4565-b985-1818045603d3', 'Socks', 1, 1, 1, NULL, '2026-07-11 07:47:00', '2026-07-11 07:47:00', NULL),
('4c9545e4-9d93-4cfd-89c3-2fdb72f77986', 'f9dc9a0a-03b1-41b7-8307-0aafffc0e70b', 'Skirt', 1, 1, 1, NULL, '2026-07-11 07:47:00', '2026-07-11 07:47:00', NULL),
('75404121-6a0e-417c-b86a-881f931738ba', 'f9dc9a0a-03b1-41b7-8307-0aafffc0e70b', 'Trouser', 1, 1, 1, NULL, '2026-07-11 07:47:00', '2026-07-11 07:47:00', NULL),
('77529e24-de45-4b4c-b2a2-ec5484051dfe', '1fb11227-ea7a-45e1-a1ea-f818cfe03a90', 'Notebook', 0, 1, 1, NULL, '2026-07-11 07:47:00', '2026-07-11 07:47:00', NULL),
('a0a772a3-a3bf-47f3-87ce-b83a30a5e5dc', '66820cd2-97d5-4195-8340-996e09241925', 'Bag', 0, 1, 1, NULL, '2026-07-11 07:47:00', '2026-07-11 07:47:00', NULL),
('a31fdc23-1229-4273-9dee-bbfe83b21de6', '1fb11227-ea7a-45e1-a1ea-f818cfe03a90', 'Pen', 0, 1, 1, NULL, '2026-07-11 07:47:00', '2026-07-11 07:47:00', NULL),
('b7e2a67e-5587-457f-9806-2dfd7dab33b1', '66820cd2-97d5-4195-8340-996e09241925', 'Belt', 1, 1, 1, NULL, '2026-07-11 07:47:00', '2026-07-11 07:47:00', NULL),
('cc5a5f4a-fb4e-4e0e-9f79-7658aeff770a', 'f9dc9a0a-03b1-41b7-8307-0aafffc0e70b', 'Blazer', 1, 1, 1, NULL, '2026-07-11 07:47:00', '2026-07-11 07:47:00', NULL),
('ed35efa5-5cb0-4fd2-8cde-4efaae3be06d', '0d08216d-61bf-4565-b985-1818045603d3', 'Shoes', 1, 1, 1, NULL, '2026-07-11 07:47:00', '2026-07-11 07:47:00', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `colors`
--

CREATE TABLE `colors` (
  `color_id` char(36) NOT NULL,
  `color_name` varchar(40) NOT NULL,
  `hex_code` varchar(10) DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_by` bigint(20) UNSIGNED NOT NULL,
  `updated_by` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `colors`
--

INSERT INTO `colors` (`color_id`, `color_name`, `hex_code`, `is_active`, `created_by`, `updated_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
('01733d6a-2406-4b2a-9dd3-6ae3ad83e0e4', 'Green', '#00FF00', 1, 1, 1, '2026-07-11 07:47:00', '2026-07-11 07:47:00', NULL),
('3596ffe0-7324-4c2d-bfd6-50756181b998', 'Black', '#000000', 1, 1, 1, '2026-07-11 07:47:00', '2026-07-11 07:47:00', NULL),
('451cc020-0a11-4f4d-86f7-33fc73ac43c3', 'White', '#FFFFFF', 1, 1, 1, '2026-07-11 07:47:00', '2026-07-11 07:47:00', NULL),
('4f4b1d74-ae72-488e-8fe7-72b2a5598d7e', 'Sky Blue', '#87CEEB', 1, 1, 1, '2026-07-11 07:47:00', '2026-07-11 07:47:00', NULL),
('56051ca8-1afc-4bc9-a56f-989e207cbcbb', 'Yellow', '#FFFF00', 1, 1, 1, '2026-07-11 07:47:00', '2026-07-11 07:47:00', NULL),
('702a7f74-78e5-42fc-8fe3-80f5572171a5', 'Khaki', '#F0E68C', 1, 1, 1, '2026-07-11 07:47:00', '2026-07-11 07:47:00', NULL),
('7106aa1e-0e56-40b8-9707-702d68263617', 'Blue', '#0000FF', 1, 1, 1, '2026-07-11 07:47:00', '2026-07-11 07:47:00', NULL),
('8ba13404-03c2-4f6f-8681-76dcf65fd308', 'Grey', '#808080', 1, 1, 1, '2026-07-11 07:47:00', '2026-07-11 07:47:00', NULL),
('ac898440-7005-49c9-b87f-7da60e3f74d5', 'Navy Blue', '#000080', 1, 1, 1, '2026-07-11 07:47:00', '2026-07-11 07:47:00', NULL),
('d834d5f1-b515-4441-802c-ee9c5335aa14', 'Maroon', '#800000', 1, 1, 1, '2026-07-11 07:47:00', '2026-07-11 07:47:00', NULL),
('dc87b5b5-81a1-423b-9d3f-9657937319a3', 'Red', '#FF0000', 1, 1, 1, '2026-07-11 07:47:00', '2026-07-11 07:47:00', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `contact_messages`
--

CREATE TABLE `contact_messages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `full_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `subject` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `contact_messages`
--

INSERT INTO `contact_messages` (`id`, `full_name`, `email`, `phone`, `subject`, `message`, `created_at`, `updated_at`) VALUES
(1, 'RUDRESH TIWARI', 'rudershtiwari947@gmail.com', '7379066737', 'My all Databese Truncated ...Today ..Please Help ,My All Project Databse is Truncated...', 'My all Databese Truncated ...Today ..Please Help ,My All Project Databse is Truncated...', '2026-07-11 19:43:24', '2026-07-11 19:43:24');

-- --------------------------------------------------------

--
-- Table structure for table `coupons`
--

CREATE TABLE `coupons` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `code` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `discount_type` enum('fixed','percentage') NOT NULL,
  `discount_value` decimal(10,2) NOT NULL,
  `minimum_order_amount` decimal(10,2) NOT NULL DEFAULT 0.00,
  `maximum_discount_amount` decimal(10,2) DEFAULT NULL,
  `usage_limit` int(10) UNSIGNED DEFAULT NULL,
  `usage_per_user` int(10) UNSIGNED NOT NULL DEFAULT 1,
  `starts_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `coupon_usages`
--

CREATE TABLE `coupon_usages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `coupon_id` bigint(20) UNSIGNED NOT NULL,
  `order_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `discount_amount` decimal(10,2) NOT NULL,
  `used_at` timestamp NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `couriers`
--

CREATE TABLE `couriers` (
  `id` char(36) NOT NULL,
  `name` varchar(255) NOT NULL,
  `api_integration_key` varchar(255) DEFAULT NULL,
  `contact_person` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `email_logs`
--

CREATE TABLE `email_logs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `template_key` varchar(255) NOT NULL,
  `recipient` varchar(255) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `status` enum('success','failed') NOT NULL,
  `error_message` longtext DEFAULT NULL,
  `sent_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `email_templates`
--

CREATE TABLE `email_templates` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `template_key` varchar(255) NOT NULL,
  `template_name` varchar(255) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `body` longtext NOT NULL,
  `available_placeholders` text DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `email_templates`
--

INSERT INTO `email_templates` (`id`, `template_key`, `template_name`, `subject`, `body`, `available_placeholders`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 'welcome_registration', 'Welcome Registration', '🎉 Welcome to eSchoolKart', '\n\n<h2>🎉 Welcome to eSchoolKart</h2>\n\n<p>Hello <strong>{user_name}</strong>,</p>\n\n<p>\nThank you for registering with eSchoolKart.\n</p>\n\n<p>\nYour account has been created successfully and you are now ready to access our School Uniform ERP platform.\n</p>\n\n<p>\nWith eSchoolKart, you can:\n</p>\n\n<ul>\n    <li>Manage Uniform Orders</li>\n    <li>Track Inventory</li>\n    <li>Manage Schools & Students</li>\n    <li>Monitor Payments</li>\n    <li>Generate Reports</li>\n</ul>\n\n<p>\nClick the button below to access your account:\n</p>\n\n<p>\n{login_button}\n</p>\n\n<p>\nThank you for choosing eSchoolKart.\n</p>\n\n<p>\nBest Regards,<br>\n<strong>eSchoolKart Team</strong>\n</p>\n\n', 'user_name,login_button', 1, '2026-07-11 07:46:51', '2026-07-11 07:46:51'),
(2, 'otp_verification', 'OTP Verification', '🔐 Verify Your Email Address', '\n\n<h2>🔐 Email Verification</h2>\n\n<p>Hello <strong>{user_name}</strong>,</p>\n\n<p>\nUse the following One-Time Password (OTP) to verify your email address:\n</p>\n\n<div style=\"\nbackground:#f3f4f6;\npadding:20px;\ntext-align:center;\nfont-size:32px;\nfont-weight:bold;\nletter-spacing:8px;\nborder-radius:8px;\nmargin:20px 0;\n\">\n{otp}\n</div>\n\n<p>\nThis OTP will expire in <strong>{expiry_minutes} minutes</strong>.\n</p>\n\n<p>\nIf you did not request this verification, please ignore this email.\n</p>\n\n<p>\nThank you,<br>\n<strong>eSchoolKart Team</strong>\n</p>\n\n', 'user_name,otp,expiry_minutes', 1, '2026-07-11 07:46:51', '2026-07-11 07:46:51'),
(3, 'forgot_password', 'Forgot Password', '🔑 Reset Your Password', '\n\n<h2>🔑 Password Reset Request</h2>\n\n<p>Hello <strong>{user_name}</strong>,</p>\n\n<p>\nWe received a request to reset the password associated with your eSchoolKart account.\n</p>\n\n<p>\nTo continue, click the button below:\n</p>\n\n<p>\n{reset_button}\n</p>\n\n<p>\nThis password reset link will expire on <strong>{expiry_date}</strong>.\n</p>\n\n<p>\nIf you did not request a password reset, no further action is required.\n</p>\n\n<p>\nFor your security, never share your account credentials with anyone.\n</p>\n\n<p>\nRegards,<br>\n<strong>eSchoolKart Team</strong>\n</p>\n\n', 'user_name,reset_button,expiry_date', 1, '2026-07-11 07:46:51', '2026-07-11 07:46:51'),
(4, 'vendor_registration', 'Vendor Registration Congratulations', '🎉 Congratulations, {business_name}! Your vendor account is ready', '\n\n<h2>🎉 Congratulations, {business_name}!</h2>\n\n<p>Dear <strong>{owner_name}</strong>,</p>\n\n<p>\nYour vendor account has been successfully registered with eSchoolKart. We are thrilled to welcome you to our school uniform and supplier platform.\n</p>\n\n<p>\nHere are the details of your registration:\n</p>\n\n<ul>\n    <li><strong>Business Name:</strong> {business_name}</li>\n    <li><strong>Owner Name:</strong> {owner_name}</li>\n    <li><strong>Status:</strong> {status}</li>\n</ul>\n\n<p>\nYou can now manage your vendor profile, track orders, and collaborate with schools through the eSchoolKart dashboard.\n</p>\n\n<p>\n{login_button}\n</p>\n\n<p>\nIf you need any help, feel free to reach out to our support team.\n</p>\n\n<p>\nWarm regards,<br>\n<strong>eSchoolKart Team</strong>\n</p>\n\n', 'business_name,owner_name,status,login_button', 1, '2026-07-11 07:46:51', '2026-07-11 07:46:51'),
(5, 'school_registration', 'School Registration Congratulations', '🎉 Welcome {school_name} to eSchoolKart!', '\n                <h2>🎉 Welcome to eSchoolKart!</h2>\n                <p>Dear <strong>{principal_name}</strong>,</p>\n                <p>\n                Your school <strong>{school_name}</strong> has been successfully registered with eSchoolKart. We are excited to have you on board.\n                </p>\n                <p>\n                Registration Details:\n                </p>\n                <ul>\n                <li><strong>School Name:</strong> {school_name}</li>\n                <li><strong>Principal Name:</strong> {principal_name}</li>\n                <li><strong>Status:</strong> {status}</li>\n                </ul>\n                <p>\n                You can now manage your school profile, uniforms, and student orders through the eSchoolKart dashboard.\n                </p>\n                <p>\n                {login_button}\n                </p>\n                <p>\n                If you have any questions, please feel free to contact our support team.\n                </p>\n                <p>\n                Best Regards,<br>\n                <strong>eSchoolKart Team</strong>\n                </p>\n                ', 'school_name,principal_name,status,login_button', 1, '2026-07-11 07:46:52', '2026-07-11 07:46:52'),
(6, 'product_approval_request', 'Product Approval Request', '🔔 Action Required: New Product Approval Request - {product_name}', '\n<h2>Product Approval Request</h2>\n<p>Hello Admin,</p>\n<p>A new product has been submitted for approval by <strong>{vendor_name}</strong>.</p>\n<p><strong>Product Details:</strong></p>\n<ul>\n    <li><strong>Name:</strong> {product_name}</li>\n    <li><strong>Code:</strong> {product_code}</li>\n    <li><strong>Category:</strong> {category_name}</li>\n</ul>\n<p>Please log in to the admin dashboard to review and approve/reject this product.</p>\n<p>{view_button}</p>\n<p>Best Regards,<br><strong>QualityUniform Team</strong></p>\n', 'product_name,product_code,vendor_name,category_name,view_button', 1, '2026-07-11 07:46:53', '2026-07-11 07:46:53'),
(7, 'product_status_updated', 'Product Status Updated', 'Update: Your Product {product_name} has been {status}', '\n<h2>Product Status Update</h2>\n<p>Dear {vendor_name},</p>\n<p>The status of your product <strong>{product_name}</strong> ({product_code}) has been updated to: <strong>{status}</strong>.</p>\n<p><strong>Message from Admin:</strong> {admin_message}</p>\n<p>Log in to your dashboard to view more details.</p>\n<p>{view_button}</p>\n<p>Best Regards,<br><strong>QualityUniform Team</strong></p>\n', 'product_name,product_code,vendor_name,status,admin_message,view_button', 1, '2026-07-11 07:46:53', '2026-07-11 07:46:53'),
(8, 'partnership_request_admin', 'School Partnership Admin Notification', '🔔 New School Partnership Request: {school_name}', '\n                    <h2>🔔 New School Partnership Request</h2>\n                    <p>A new institution has applied to become an official partner.</p>\n                    <div style=\"background: #f8fafc; padding: 20px; border-radius: 8px; border: 1px solid #e2e8f0;\">\n                        <p><strong>School Name:</strong> {school_name}</p>\n                        <p><strong>Contact Person:</strong> {contact_person}</p>\n                        <p><strong>Email:</strong> {email}</p>\n                        <p><strong>Phone:</strong> {phone}</p>\n                    </div>\n                    <p>Please review the application in the admin dashboard to proceed with onboarding.</p>\n                    <p>Best Regards,<br><strong>System Notification</strong></p>\n                ', 'school_name,contact_person,email,phone', 1, '2026-07-11 07:46:56', '2026-07-11 07:46:56'),
(9, 'partnership_request_user', 'School Partnership User Confirmation', '🤝 Thank you for your partnership interest, {school_name}!', '\n                    <h2>🤝 Partnership Request Received</h2>\n                    <p>Hello <strong>{contact_person}</strong>,</p>\n                    <p>Thank you for reaching out to eSchoolKart. We have received your request to register <strong>{school_name}</strong> as an official partner institution.</p>\n                    <p>Our Institutional Onboarding Team is reviewing your details. A partnership manager will contact you within 24 hours to schedule a virtual portal demo and garment sample validation.</p>\n                    <p>We look forward to bringing a seamless uniform shopping experience to your students and parents.</p>\n                    <p>Best Regards,<br><strong>eSchoolKart Team</strong></p>\n                ', 'school_name,contact_person', 1, '2026-07-11 07:46:56', '2026-07-11 07:46:56'),
(10, 'vendor_request_admin', 'Vendor Application Admin Notification', '📦 New Vendor Application: {company_name}', '\n                    <h2>📦 New Vendor Application</h2>\n                    <p>A new supplier has applied to join the eSchoolKart marketplace.</p>\n                    <div style=\"background: #f8fafc; padding: 20px; border-radius: 8px; border: 1px solid #e2e8f0;\">\n                        <p><strong>Company Name:</strong> {company_name}</p>\n                        <p><strong>Product Category:</strong> {category}</p>\n                        <p><strong>Email:</strong> {email}</p>\n                        <p><strong>GSTIN:</strong> {gstin}</p>\n                    </div>\n                    <p>Please verify the GST credentials and company profile in the admin dashboard.</p>\n                    <p>Best Regards,<br><strong>System Notification</strong></p>\n                ', 'company_name,category,email,gstin', 1, '2026-07-11 07:46:56', '2026-07-11 07:46:56'),
(11, 'vendor_request_user', 'Vendor Application User Confirmation', '📦 Application Received: {company_name}', '\n                    <h2>📦 Vendor Application Received</h2>\n                    <p>Hello,</p>\n                    <p>Thank you for applying to become an authorized supplier on eSchoolKart. We have received your application for <strong>{company_name}</strong>.</p>\n                    <p>Our Merchant Desk is currently reviewing your tax status and GST credentials. You can expect an update regarding your application status within 2 business days.</p>\n                    <p>If you have any questions in the meantime, please feel free to reply to this email.</p>\n                    <p>Best Regards,<br><strong>eSchoolKart Team</strong></p>\n                ', 'company_name', 1, '2026-07-11 07:46:56', '2026-07-11 07:46:56'),
(12, 'welcome_parent', 'Welcome Parent', '🎉 Welcome to eSchoolKart, {user_name}!', '\r\n                    <h2>🎉 Welcome to eSchoolKart!</h2>\r\n                    <p>Hello <strong>{user_name}</strong>,</p>\r\n                    <p>Thank you for registering with eSchoolKart. We are excited to have you join our community!</p>\r\n                    <p>You can now easily browse and order school uniforms for your children, track your orders, and manage your wishlist all in one place.</p>\r\n                    <p><strong>Get started now:</strong><br>\r\n                    {login_button}</p>\r\n                    <p>If you have any questions, feel free to contact our support team.</p>\r\n                    <p>Best Regards,<br><strong>eSchoolKart Team</strong></p>\r\n                ', 'user_name,login_button', 1, '2026-07-11 07:47:00', '2026-07-11 07:47:00'),
(13, 'order_confirmed_user', 'Order Confirmation (User)', '📦 Order Confirmed! Your order #{order_number} is placed', '\r\n                    <h2>📦 Order Confirmed!</h2>\r\n                    <p>Hello <strong>{user_name}</strong>,</p>\r\n                    <p>Great news! Your order <strong>#{order_number}</strong> has been successfully placed.</p>\r\n                    <p><strong>Order Summary:</strong><br>\r\n                    Total Amount: <strong>₹{total_amount}</strong></p>\r\n                    <p>We have attached the invoice for your order to this email.</p>\r\n                    <p>You can track your order status through your dashboard.</p>\r\n                    <p>Thank you for shopping with us!<br><strong>eSchoolKart Team</strong></p>\r\n                ', 'user_name,order_number,total_amount', 1, '2026-07-11 07:47:00', '2026-07-11 07:47:00'),
(14, 'order_confirmed_school', 'Order Confirmation (School)', '🔔 New Order Notification for School: #{order_number}', '\r\n                    <h2>🔔 New Order Received</h2>\r\n                    <p>Dear <strong>{school_name}</strong>,</p>\r\n                    <p>A new order <strong>#{order_number}</strong> has been placed by <strong>{user_name}</strong>.</p>\r\n                    <p><strong>Order Details:</strong><br>\r\n                    Total Amount: <strong>₹{total_amount}</strong></p>\r\n                    <p>Please review the order and proceed with the necessary approvals/coordination.</p>\r\n                    <p>The detailed invoice is attached to this email.</p>\r\n                    <p>Best Regards,<br><strong>eSchoolKart Team</strong></p>\r\n                ', 'school_name,order_number,user_name,total_amount', 1, '2026-07-11 07:47:00', '2026-07-11 07:47:00'),
(15, 'order_confirmed_vendor', 'Order Confirmation (Vendor)', '🚚 New Order for Fulfillment: #{order_number}', '\r\n                    <h2>🚚 New Order for Fulfillment</h2>\r\n                    <p>Dear <strong>{vendor_name}</strong>,</p>\r\n                    <p>You have a new order to fulfill: <strong>#{order_number}</strong>.</p>\r\n                    <p><strong>Customer:</strong> {user_name}<br>\r\n                    <strong>Total Order Value:</strong> ₹{total_amount}</p>\r\n                    <p>Please check your vendor dashboard to see the items assigned to you and start the fulfillment process.</p>\r\n                    <p>The full order invoice is attached for your reference.</p>\r\n                    <p>Best Regards,<br><strong>eSchoolKart Team</strong></p>\r\n                ', 'vendor_name,order_number,user_name,total_amount', 1, '2026-07-11 07:47:00', '2026-07-11 07:47:00');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` varchar(255) NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `failed_jobs`
--

INSERT INTO `failed_jobs` (`id`, `uuid`, `connection`, `queue`, `payload`, `exception`, `failed_at`) VALUES
(1, '0dfd6fb8-ccb5-485d-b8ff-0a6fedb0a222', 'database', 'default', '{\"uuid\":\"0dfd6fb8-ccb5-485d-b8ff-0a6fedb0a222\",\"displayName\":\"App\\\\Notifications\\\\SystemNotification\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"deleteWhenMissingModels\":false,\"data\":{\"commandName\":\"Illuminate\\\\Notifications\\\\SendQueuedNotifications\",\"command\":\"O:48:\\\"Illuminate\\\\Notifications\\\\SendQueuedNotifications\\\":3:{s:11:\\\"notifiables\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:15:\\\"App\\\\Models\\\\User\\\";s:2:\\\"id\\\";a:1:{i:0;i:1;}s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}s:12:\\\"notification\\\";O:36:\\\"App\\\\Notifications\\\\SystemNotification\\\":3:{s:7:\\\"\\u0000*\\u0000data\\\";a:6:{s:3:\\\"key\\\";s:16:\\\"product_approved\\\";s:5:\\\"title\\\";s:16:\\\"Product Approved\\\";s:7:\\\"message\\\";s:98:\\\"Congratulations! Your product \\\"Demo Product\\\" has been approved and is now available for customers.\\\";s:4:\\\"type\\\";s:7:\\\"success\\\";s:3:\\\"url\\\";s:39:\\\"http:\\/\\/uniform.eschoolkart.com\\/products\\\";s:10:\\\"created_at\\\";O:25:\\\"Illuminate\\\\Support\\\\Carbon\\\":3:{s:4:\\\"date\\\";s:26:\\\"2026-07-11 19:23:24.763002\\\";s:13:\\\"timezone_type\\\";i:3;s:8:\\\"timezone\\\";s:3:\\\"UTC\\\";}}s:11:\\\"\\u0000*\\u0000channels\\\";a:3:{i:0;s:8:\\\"database\\\";i:1;s:9:\\\"broadcast\\\";i:2;s:4:\\\"mail\\\";}s:2:\\\"id\\\";s:36:\\\"94867739-01a4-4ef5-8316-1e3c08876171\\\";}s:8:\\\"channels\\\";a:1:{i:0;s:4:\\\"mail\\\";}}\",\"batchId\":null},\"createdAt\":1783797804,\"delay\":null}', 'Symfony\\Component\\Mailer\\Exception\\UnexpectedResponseException: Expected response code \"250\" but got code \"550\", with message \"550 mailbox unavailable\". in /var/www/kwalityuniform/vendor/symfony/mailer/Transport/Smtp/SmtpTransport.php:331\nStack trace:\n#0 /var/www/kwalityuniform/vendor/symfony/mailer/Transport/Smtp/SmtpTransport.php(187): Symfony\\Component\\Mailer\\Transport\\Smtp\\SmtpTransport->assertResponseCode()\n#1 /var/www/kwalityuniform/vendor/symfony/mailer/Transport/Smtp/EsmtpTransport.php(150): Symfony\\Component\\Mailer\\Transport\\Smtp\\SmtpTransport->executeCommand()\n#2 /var/www/kwalityuniform/vendor/symfony/mailer/Transport/Smtp/SmtpTransport.php(252): Symfony\\Component\\Mailer\\Transport\\Smtp\\EsmtpTransport->executeCommand()\n#3 /var/www/kwalityuniform/vendor/symfony/mailer/Transport/Smtp/SmtpTransport.php(204): Symfony\\Component\\Mailer\\Transport\\Smtp\\SmtpTransport->doMailFromCommand()\n#4 /var/www/kwalityuniform/vendor/symfony/mailer/Transport/AbstractTransport.php(69): Symfony\\Component\\Mailer\\Transport\\Smtp\\SmtpTransport->doSend()\n#5 /var/www/kwalityuniform/vendor/symfony/mailer/Transport/Smtp/SmtpTransport.php(138): Symfony\\Component\\Mailer\\Transport\\AbstractTransport->send()\n#6 /var/www/kwalityuniform/vendor/laravel/framework/src/Illuminate/Mail/Mailer.php(584): Symfony\\Component\\Mailer\\Transport\\Smtp\\SmtpTransport->send()\n#7 /var/www/kwalityuniform/vendor/laravel/framework/src/Illuminate/Mail/Mailer.php(331): Illuminate\\Mail\\Mailer->sendSymfonyMessage()\n#8 /var/www/kwalityuniform/vendor/laravel/framework/src/Illuminate/Notifications/Channels/MailChannel.php(66): Illuminate\\Mail\\Mailer->send()\n#9 /var/www/kwalityuniform/vendor/laravel/framework/src/Illuminate/Notifications/NotificationSender.php(165): Illuminate\\Notifications\\Channels\\MailChannel->send()\n#10 /var/www/kwalityuniform/vendor/laravel/framework/src/Illuminate/Notifications/NotificationSender.php(120): Illuminate\\Notifications\\NotificationSender->sendToNotifiable()\n#11 /var/www/kwalityuniform/vendor/laravel/framework/src/Illuminate/Support/Traits/Localizable.php(19): Illuminate\\Notifications\\NotificationSender->{closure:Illuminate\\Notifications\\NotificationSender::sendNow():115}()\n#12 /var/www/kwalityuniform/vendor/laravel/framework/src/Illuminate/Notifications/NotificationSender.php(115): Illuminate\\Notifications\\NotificationSender->withLocale()\n#13 /var/www/kwalityuniform/vendor/laravel/framework/src/Illuminate/Notifications/ChannelManager.php(61): Illuminate\\Notifications\\NotificationSender->sendNow()\n#14 /var/www/kwalityuniform/vendor/laravel/framework/src/Illuminate/Notifications/SendQueuedNotifications.php(130): Illuminate\\Notifications\\ChannelManager->sendNow()\n#15 /var/www/kwalityuniform/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(36): Illuminate\\Notifications\\SendQueuedNotifications->handle()\n#16 /var/www/kwalityuniform/vendor/laravel/framework/src/Illuminate/Container/Util.php(43): Illuminate\\Container\\BoundMethod::{closure:Illuminate\\Container\\BoundMethod::call():35}()\n#17 /var/www/kwalityuniform/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(96): Illuminate\\Container\\Util::unwrapIfClosure()\n#18 /var/www/kwalityuniform/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(35): Illuminate\\Container\\BoundMethod::callBoundMethod()\n#19 /var/www/kwalityuniform/vendor/laravel/framework/src/Illuminate/Container/Container.php(799): Illuminate\\Container\\BoundMethod::call()\n#20 /var/www/kwalityuniform/vendor/laravel/framework/src/Illuminate/Bus/Dispatcher.php(136): Illuminate\\Container\\Container->call()\n#21 /var/www/kwalityuniform/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php(180): Illuminate\\Bus\\Dispatcher->{closure:Illuminate\\Bus\\Dispatcher::dispatchNow():133}()\n#22 /var/www/kwalityuniform/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php(137): Illuminate\\Pipeline\\Pipeline->{closure:Illuminate\\Pipeline\\Pipeline::prepareDestination():178}()\n#23 /var/www/kwalityuniform/vendor/laravel/framework/src/Illuminate/Bus/Dispatcher.php(140): Illuminate\\Pipeline\\Pipeline->then()\n#24 /var/www/kwalityuniform/vendor/laravel/framework/src/Illuminate/Queue/CallQueuedHandler.php(153): Illuminate\\Bus\\Dispatcher->dispatchNow()\n#25 /var/www/kwalityuniform/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php(180): Illuminate\\Queue\\CallQueuedHandler->{closure:Illuminate\\Queue\\CallQueuedHandler::dispatchThroughMiddleware():146}()\n#26 /var/www/kwalityuniform/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php(137): Illuminate\\Pipeline\\Pipeline->{closure:Illuminate\\Pipeline\\Pipeline::prepareDestination():178}()\n#27 /var/www/kwalityuniform/vendor/laravel/framework/src/Illuminate/Queue/CallQueuedHandler.php(146): Illuminate\\Pipeline\\Pipeline->then()\n#28 /var/www/kwalityuniform/vendor/laravel/framework/src/Illuminate/Queue/CallQueuedHandler.php(84): Illuminate\\Queue\\CallQueuedHandler->dispatchThroughMiddleware()\n#29 /var/www/kwalityuniform/vendor/laravel/framework/src/Illuminate/Queue/Jobs/Job.php(102): Illuminate\\Queue\\CallQueuedHandler->call()\n#30 /var/www/kwalityuniform/vendor/laravel/framework/src/Illuminate/Queue/Worker.php(553): Illuminate\\Queue\\Jobs\\Job->fire()\n#31 /var/www/kwalityuniform/vendor/laravel/framework/src/Illuminate/Queue/Worker.php(499): Illuminate\\Queue\\Worker->process()\n#32 /var/www/kwalityuniform/vendor/laravel/framework/src/Illuminate/Queue/Worker.php(245): Illuminate\\Queue\\Worker->runJob()\n#33 /var/www/kwalityuniform/vendor/laravel/framework/src/Illuminate/Queue/Console/WorkCommand.php(149): Illuminate\\Queue\\Worker->daemon()\n#34 /var/www/kwalityuniform/vendor/laravel/framework/src/Illuminate/Queue/Console/WorkCommand.php(132): Illuminate\\Queue\\Console\\WorkCommand->runWorker()\n#35 /var/www/kwalityuniform/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(36): Illuminate\\Queue\\Console\\WorkCommand->handle()\n#36 /var/www/kwalityuniform/vendor/laravel/framework/src/Illuminate/Container/Util.php(43): Illuminate\\Container\\BoundMethod::{closure:Illuminate\\Container\\BoundMethod::call():35}()\n#37 /var/www/kwalityuniform/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(96): Illuminate\\Container\\Util::unwrapIfClosure()\n#38 /var/www/kwalityuniform/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(35): Illuminate\\Container\\BoundMethod::callBoundMethod()\n#39 /var/www/kwalityuniform/vendor/laravel/framework/src/Illuminate/Container/Container.php(799): Illuminate\\Container\\BoundMethod::call()\n#40 /var/www/kwalityuniform/vendor/laravel/framework/src/Illuminate/Console/Command.php(280): Illuminate\\Container\\Container->call()\n#41 /var/www/kwalityuniform/vendor/symfony/console/Command/Command.php(284): Illuminate\\Console\\Command->execute()\n#42 /var/www/kwalityuniform/vendor/laravel/framework/src/Illuminate/Console/Command.php(249): Symfony\\Component\\Console\\Command\\Command->run()\n#43 /var/www/kwalityuniform/vendor/symfony/console/Application.php(1144): Illuminate\\Console\\Command->run()\n#44 /var/www/kwalityuniform/vendor/symfony/console/Application.php(379): Symfony\\Component\\Console\\Application->doRunCommand()\n#45 /var/www/kwalityuniform/vendor/symfony/console/Application.php(218): Symfony\\Component\\Console\\Application->doRun()\n#46 /var/www/kwalityuniform/vendor/laravel/framework/src/Illuminate/Foundation/Console/Kernel.php(198): Symfony\\Component\\Console\\Application->run()\n#47 /var/www/kwalityuniform/vendor/laravel/framework/src/Illuminate/Foundation/Application.php(1235): Illuminate\\Foundation\\Console\\Kernel->handle()\n#48 /var/www/kwalityuniform/artisan(16): Illuminate\\Foundation\\Application->handleCommand()\n#49 {main}', '2026-07-11 19:32:37'),
(2, '5db6042e-3e98-453c-824e-c82bf28ada3e', 'database', 'default', '{\"uuid\":\"5db6042e-3e98-453c-824e-c82bf28ada3e\",\"displayName\":\"App\\\\Notifications\\\\SystemNotification\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"deleteWhenMissingModels\":false,\"data\":{\"commandName\":\"Illuminate\\\\Notifications\\\\SendQueuedNotifications\",\"command\":\"O:48:\\\"Illuminate\\\\Notifications\\\\SendQueuedNotifications\\\":3:{s:11:\\\"notifiables\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:15:\\\"App\\\\Models\\\\User\\\";s:2:\\\"id\\\";a:1:{i:0;i:1;}s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}s:12:\\\"notification\\\";O:36:\\\"App\\\\Notifications\\\\SystemNotification\\\":3:{s:7:\\\"\\u0000*\\u0000data\\\";a:6:{s:3:\\\"key\\\";s:16:\\\"product_approved\\\";s:5:\\\"title\\\";s:16:\\\"Product Approved\\\";s:7:\\\"message\\\";s:98:\\\"Congratulations! Your product \\\"Demo Product\\\" has been approved and is now available for customers.\\\";s:4:\\\"type\\\";s:7:\\\"success\\\";s:3:\\\"url\\\";s:39:\\\"http:\\/\\/uniform.eschoolkart.com\\/products\\\";s:10:\\\"created_at\\\";O:25:\\\"Illuminate\\\\Support\\\\Carbon\\\":3:{s:4:\\\"date\\\";s:26:\\\"2026-07-11 19:24:14.051907\\\";s:13:\\\"timezone_type\\\";i:3;s:8:\\\"timezone\\\";s:3:\\\"UTC\\\";}}s:11:\\\"\\u0000*\\u0000channels\\\";a:3:{i:0;s:8:\\\"database\\\";i:1;s:9:\\\"broadcast\\\";i:2;s:4:\\\"mail\\\";}s:2:\\\"id\\\";s:36:\\\"beca08d1-50cd-43a0-bd6f-2e8a715266bf\\\";}s:8:\\\"channels\\\";a:1:{i:0;s:4:\\\"mail\\\";}}\",\"batchId\":null},\"createdAt\":1783797854,\"delay\":null}', 'Symfony\\Component\\Mailer\\Exception\\UnexpectedResponseException: Expected response code \"250\" but got code \"550\", with message \"550 mailbox unavailable\". in /var/www/kwalityuniform/vendor/symfony/mailer/Transport/Smtp/SmtpTransport.php:331\nStack trace:\n#0 /var/www/kwalityuniform/vendor/symfony/mailer/Transport/Smtp/SmtpTransport.php(187): Symfony\\Component\\Mailer\\Transport\\Smtp\\SmtpTransport->assertResponseCode()\n#1 /var/www/kwalityuniform/vendor/symfony/mailer/Transport/Smtp/EsmtpTransport.php(150): Symfony\\Component\\Mailer\\Transport\\Smtp\\SmtpTransport->executeCommand()\n#2 /var/www/kwalityuniform/vendor/symfony/mailer/Transport/Smtp/SmtpTransport.php(252): Symfony\\Component\\Mailer\\Transport\\Smtp\\EsmtpTransport->executeCommand()\n#3 /var/www/kwalityuniform/vendor/symfony/mailer/Transport/Smtp/SmtpTransport.php(204): Symfony\\Component\\Mailer\\Transport\\Smtp\\SmtpTransport->doMailFromCommand()\n#4 /var/www/kwalityuniform/vendor/symfony/mailer/Transport/AbstractTransport.php(69): Symfony\\Component\\Mailer\\Transport\\Smtp\\SmtpTransport->doSend()\n#5 /var/www/kwalityuniform/vendor/symfony/mailer/Transport/Smtp/SmtpTransport.php(138): Symfony\\Component\\Mailer\\Transport\\AbstractTransport->send()\n#6 /var/www/kwalityuniform/vendor/laravel/framework/src/Illuminate/Mail/Mailer.php(584): Symfony\\Component\\Mailer\\Transport\\Smtp\\SmtpTransport->send()\n#7 /var/www/kwalityuniform/vendor/laravel/framework/src/Illuminate/Mail/Mailer.php(331): Illuminate\\Mail\\Mailer->sendSymfonyMessage()\n#8 /var/www/kwalityuniform/vendor/laravel/framework/src/Illuminate/Notifications/Channels/MailChannel.php(66): Illuminate\\Mail\\Mailer->send()\n#9 /var/www/kwalityuniform/vendor/laravel/framework/src/Illuminate/Notifications/NotificationSender.php(165): Illuminate\\Notifications\\Channels\\MailChannel->send()\n#10 /var/www/kwalityuniform/vendor/laravel/framework/src/Illuminate/Notifications/NotificationSender.php(120): Illuminate\\Notifications\\NotificationSender->sendToNotifiable()\n#11 /var/www/kwalityuniform/vendor/laravel/framework/src/Illuminate/Support/Traits/Localizable.php(19): Illuminate\\Notifications\\NotificationSender->{closure:Illuminate\\Notifications\\NotificationSender::sendNow():115}()\n#12 /var/www/kwalityuniform/vendor/laravel/framework/src/Illuminate/Notifications/NotificationSender.php(115): Illuminate\\Notifications\\NotificationSender->withLocale()\n#13 /var/www/kwalityuniform/vendor/laravel/framework/src/Illuminate/Notifications/ChannelManager.php(61): Illuminate\\Notifications\\NotificationSender->sendNow()\n#14 /var/www/kwalityuniform/vendor/laravel/framework/src/Illuminate/Notifications/SendQueuedNotifications.php(130): Illuminate\\Notifications\\ChannelManager->sendNow()\n#15 /var/www/kwalityuniform/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(36): Illuminate\\Notifications\\SendQueuedNotifications->handle()\n#16 /var/www/kwalityuniform/vendor/laravel/framework/src/Illuminate/Container/Util.php(43): Illuminate\\Container\\BoundMethod::{closure:Illuminate\\Container\\BoundMethod::call():35}()\n#17 /var/www/kwalityuniform/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(96): Illuminate\\Container\\Util::unwrapIfClosure()\n#18 /var/www/kwalityuniform/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(35): Illuminate\\Container\\BoundMethod::callBoundMethod()\n#19 /var/www/kwalityuniform/vendor/laravel/framework/src/Illuminate/Container/Container.php(799): Illuminate\\Container\\BoundMethod::call()\n#20 /var/www/kwalityuniform/vendor/laravel/framework/src/Illuminate/Bus/Dispatcher.php(136): Illuminate\\Container\\Container->call()\n#21 /var/www/kwalityuniform/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php(180): Illuminate\\Bus\\Dispatcher->{closure:Illuminate\\Bus\\Dispatcher::dispatchNow():133}()\n#22 /var/www/kwalityuniform/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php(137): Illuminate\\Pipeline\\Pipeline->{closure:Illuminate\\Pipeline\\Pipeline::prepareDestination():178}()\n#23 /var/www/kwalityuniform/vendor/laravel/framework/src/Illuminate/Bus/Dispatcher.php(140): Illuminate\\Pipeline\\Pipeline->then()\n#24 /var/www/kwalityuniform/vendor/laravel/framework/src/Illuminate/Queue/CallQueuedHandler.php(153): Illuminate\\Bus\\Dispatcher->dispatchNow()\n#25 /var/www/kwalityuniform/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php(180): Illuminate\\Queue\\CallQueuedHandler->{closure:Illuminate\\Queue\\CallQueuedHandler::dispatchThroughMiddleware():146}()\n#26 /var/www/kwalityuniform/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php(137): Illuminate\\Pipeline\\Pipeline->{closure:Illuminate\\Pipeline\\Pipeline::prepareDestination():178}()\n#27 /var/www/kwalityuniform/vendor/laravel/framework/src/Illuminate/Queue/CallQueuedHandler.php(146): Illuminate\\Pipeline\\Pipeline->then()\n#28 /var/www/kwalityuniform/vendor/laravel/framework/src/Illuminate/Queue/CallQueuedHandler.php(84): Illuminate\\Queue\\CallQueuedHandler->dispatchThroughMiddleware()\n#29 /var/www/kwalityuniform/vendor/laravel/framework/src/Illuminate/Queue/Jobs/Job.php(102): Illuminate\\Queue\\CallQueuedHandler->call()\n#30 /var/www/kwalityuniform/vendor/laravel/framework/src/Illuminate/Queue/Worker.php(553): Illuminate\\Queue\\Jobs\\Job->fire()\n#31 /var/www/kwalityuniform/vendor/laravel/framework/src/Illuminate/Queue/Worker.php(499): Illuminate\\Queue\\Worker->process()\n#32 /var/www/kwalityuniform/vendor/laravel/framework/src/Illuminate/Queue/Worker.php(245): Illuminate\\Queue\\Worker->runJob()\n#33 /var/www/kwalityuniform/vendor/laravel/framework/src/Illuminate/Queue/Console/WorkCommand.php(149): Illuminate\\Queue\\Worker->daemon()\n#34 /var/www/kwalityuniform/vendor/laravel/framework/src/Illuminate/Queue/Console/WorkCommand.php(132): Illuminate\\Queue\\Console\\WorkCommand->runWorker()\n#35 /var/www/kwalityuniform/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(36): Illuminate\\Queue\\Console\\WorkCommand->handle()\n#36 /var/www/kwalityuniform/vendor/laravel/framework/src/Illuminate/Container/Util.php(43): Illuminate\\Container\\BoundMethod::{closure:Illuminate\\Container\\BoundMethod::call():35}()\n#37 /var/www/kwalityuniform/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(96): Illuminate\\Container\\Util::unwrapIfClosure()\n#38 /var/www/kwalityuniform/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(35): Illuminate\\Container\\BoundMethod::callBoundMethod()\n#39 /var/www/kwalityuniform/vendor/laravel/framework/src/Illuminate/Container/Container.php(799): Illuminate\\Container\\BoundMethod::call()\n#40 /var/www/kwalityuniform/vendor/laravel/framework/src/Illuminate/Console/Command.php(280): Illuminate\\Container\\Container->call()\n#41 /var/www/kwalityuniform/vendor/symfony/console/Command/Command.php(284): Illuminate\\Console\\Command->execute()\n#42 /var/www/kwalityuniform/vendor/laravel/framework/src/Illuminate/Console/Command.php(249): Symfony\\Component\\Console\\Command\\Command->run()\n#43 /var/www/kwalityuniform/vendor/symfony/console/Application.php(1144): Illuminate\\Console\\Command->run()\n#44 /var/www/kwalityuniform/vendor/symfony/console/Application.php(379): Symfony\\Component\\Console\\Application->doRunCommand()\n#45 /var/www/kwalityuniform/vendor/symfony/console/Application.php(218): Symfony\\Component\\Console\\Application->doRun()\n#46 /var/www/kwalityuniform/vendor/laravel/framework/src/Illuminate/Foundation/Console/Kernel.php(198): Symfony\\Component\\Console\\Application->run()\n#47 /var/www/kwalityuniform/vendor/laravel/framework/src/Illuminate/Foundation/Application.php(1235): Illuminate\\Foundation\\Console\\Kernel->handle()\n#48 /var/www/kwalityuniform/artisan(16): Illuminate\\Foundation\\Application->handleCommand()\n#49 {main}', '2026-07-11 19:32:37'),
(3, 'b1eeb30d-6d83-4c2d-ab8c-be3c076c4344', 'database', 'default', '{\"uuid\":\"b1eeb30d-6d83-4c2d-ab8c-be3c076c4344\",\"displayName\":\"App\\\\Notifications\\\\SystemNotification\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"deleteWhenMissingModels\":false,\"data\":{\"commandName\":\"Illuminate\\\\Notifications\\\\SendQueuedNotifications\",\"command\":\"O:48:\\\"Illuminate\\\\Notifications\\\\SendQueuedNotifications\\\":3:{s:11:\\\"notifiables\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:15:\\\"App\\\\Models\\\\User\\\";s:2:\\\"id\\\";a:1:{i:0;i:1;}s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}s:12:\\\"notification\\\";O:36:\\\"App\\\\Notifications\\\\SystemNotification\\\":3:{s:7:\\\"\\u0000*\\u0000data\\\";a:6:{s:3:\\\"key\\\";s:16:\\\"product_approved\\\";s:5:\\\"title\\\";s:16:\\\"Product Approved\\\";s:7:\\\"message\\\";s:98:\\\"Congratulations! Your product \\\"Demo Product\\\" has been approved and is now available for customers.\\\";s:4:\\\"type\\\";s:7:\\\"success\\\";s:3:\\\"url\\\";s:39:\\\"http:\\/\\/uniform.eschoolkart.com\\/products\\\";s:10:\\\"created_at\\\";O:25:\\\"Illuminate\\\\Support\\\\Carbon\\\":3:{s:4:\\\"date\\\";s:26:\\\"2026-07-11 19:24:25.532368\\\";s:13:\\\"timezone_type\\\";i:3;s:8:\\\"timezone\\\";s:3:\\\"UTC\\\";}}s:11:\\\"\\u0000*\\u0000channels\\\";a:3:{i:0;s:8:\\\"database\\\";i:1;s:9:\\\"broadcast\\\";i:2;s:4:\\\"mail\\\";}s:2:\\\"id\\\";s:36:\\\"e2e3cd86-f544-440c-bf37-6291e2dd26b5\\\";}s:8:\\\"channels\\\";a:1:{i:0;s:4:\\\"mail\\\";}}\",\"batchId\":null},\"createdAt\":1783797865,\"delay\":null}', 'Symfony\\Component\\Mailer\\Exception\\UnexpectedResponseException: Expected response code \"250\" but got code \"550\", with message \"550 mailbox unavailable\". in /var/www/kwalityuniform/vendor/symfony/mailer/Transport/Smtp/SmtpTransport.php:331\nStack trace:\n#0 /var/www/kwalityuniform/vendor/symfony/mailer/Transport/Smtp/SmtpTransport.php(187): Symfony\\Component\\Mailer\\Transport\\Smtp\\SmtpTransport->assertResponseCode()\n#1 /var/www/kwalityuniform/vendor/symfony/mailer/Transport/Smtp/EsmtpTransport.php(150): Symfony\\Component\\Mailer\\Transport\\Smtp\\SmtpTransport->executeCommand()\n#2 /var/www/kwalityuniform/vendor/symfony/mailer/Transport/Smtp/SmtpTransport.php(252): Symfony\\Component\\Mailer\\Transport\\Smtp\\EsmtpTransport->executeCommand()\n#3 /var/www/kwalityuniform/vendor/symfony/mailer/Transport/Smtp/SmtpTransport.php(204): Symfony\\Component\\Mailer\\Transport\\Smtp\\SmtpTransport->doMailFromCommand()\n#4 /var/www/kwalityuniform/vendor/symfony/mailer/Transport/AbstractTransport.php(69): Symfony\\Component\\Mailer\\Transport\\Smtp\\SmtpTransport->doSend()\n#5 /var/www/kwalityuniform/vendor/symfony/mailer/Transport/Smtp/SmtpTransport.php(138): Symfony\\Component\\Mailer\\Transport\\AbstractTransport->send()\n#6 /var/www/kwalityuniform/vendor/laravel/framework/src/Illuminate/Mail/Mailer.php(584): Symfony\\Component\\Mailer\\Transport\\Smtp\\SmtpTransport->send()\n#7 /var/www/kwalityuniform/vendor/laravel/framework/src/Illuminate/Mail/Mailer.php(331): Illuminate\\Mail\\Mailer->sendSymfonyMessage()\n#8 /var/www/kwalityuniform/vendor/laravel/framework/src/Illuminate/Notifications/Channels/MailChannel.php(66): Illuminate\\Mail\\Mailer->send()\n#9 /var/www/kwalityuniform/vendor/laravel/framework/src/Illuminate/Notifications/NotificationSender.php(165): Illuminate\\Notifications\\Channels\\MailChannel->send()\n#10 /var/www/kwalityuniform/vendor/laravel/framework/src/Illuminate/Notifications/NotificationSender.php(120): Illuminate\\Notifications\\NotificationSender->sendToNotifiable()\n#11 /var/www/kwalityuniform/vendor/laravel/framework/src/Illuminate/Support/Traits/Localizable.php(19): Illuminate\\Notifications\\NotificationSender->{closure:Illuminate\\Notifications\\NotificationSender::sendNow():115}()\n#12 /var/www/kwalityuniform/vendor/laravel/framework/src/Illuminate/Notifications/NotificationSender.php(115): Illuminate\\Notifications\\NotificationSender->withLocale()\n#13 /var/www/kwalityuniform/vendor/laravel/framework/src/Illuminate/Notifications/ChannelManager.php(61): Illuminate\\Notifications\\NotificationSender->sendNow()\n#14 /var/www/kwalityuniform/vendor/laravel/framework/src/Illuminate/Notifications/SendQueuedNotifications.php(130): Illuminate\\Notifications\\ChannelManager->sendNow()\n#15 /var/www/kwalityuniform/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(36): Illuminate\\Notifications\\SendQueuedNotifications->handle()\n#16 /var/www/kwalityuniform/vendor/laravel/framework/src/Illuminate/Container/Util.php(43): Illuminate\\Container\\BoundMethod::{closure:Illuminate\\Container\\BoundMethod::call():35}()\n#17 /var/www/kwalityuniform/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(96): Illuminate\\Container\\Util::unwrapIfClosure()\n#18 /var/www/kwalityuniform/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(35): Illuminate\\Container\\BoundMethod::callBoundMethod()\n#19 /var/www/kwalityuniform/vendor/laravel/framework/src/Illuminate/Container/Container.php(799): Illuminate\\Container\\BoundMethod::call()\n#20 /var/www/kwalityuniform/vendor/laravel/framework/src/Illuminate/Bus/Dispatcher.php(136): Illuminate\\Container\\Container->call()\n#21 /var/www/kwalityuniform/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php(180): Illuminate\\Bus\\Dispatcher->{closure:Illuminate\\Bus\\Dispatcher::dispatchNow():133}()\n#22 /var/www/kwalityuniform/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php(137): Illuminate\\Pipeline\\Pipeline->{closure:Illuminate\\Pipeline\\Pipeline::prepareDestination():178}()\n#23 /var/www/kwalityuniform/vendor/laravel/framework/src/Illuminate/Bus/Dispatcher.php(140): Illuminate\\Pipeline\\Pipeline->then()\n#24 /var/www/kwalityuniform/vendor/laravel/framework/src/Illuminate/Queue/CallQueuedHandler.php(153): Illuminate\\Bus\\Dispatcher->dispatchNow()\n#25 /var/www/kwalityuniform/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php(180): Illuminate\\Queue\\CallQueuedHandler->{closure:Illuminate\\Queue\\CallQueuedHandler::dispatchThroughMiddleware():146}()\n#26 /var/www/kwalityuniform/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php(137): Illuminate\\Pipeline\\Pipeline->{closure:Illuminate\\Pipeline\\Pipeline::prepareDestination():178}()\n#27 /var/www/kwalityuniform/vendor/laravel/framework/src/Illuminate/Queue/CallQueuedHandler.php(146): Illuminate\\Pipeline\\Pipeline->then()\n#28 /var/www/kwalityuniform/vendor/laravel/framework/src/Illuminate/Queue/CallQueuedHandler.php(84): Illuminate\\Queue\\CallQueuedHandler->dispatchThroughMiddleware()\n#29 /var/www/kwalityuniform/vendor/laravel/framework/src/Illuminate/Queue/Jobs/Job.php(102): Illuminate\\Queue\\CallQueuedHandler->call()\n#30 /var/www/kwalityuniform/vendor/laravel/framework/src/Illuminate/Queue/Worker.php(553): Illuminate\\Queue\\Jobs\\Job->fire()\n#31 /var/www/kwalityuniform/vendor/laravel/framework/src/Illuminate/Queue/Worker.php(499): Illuminate\\Queue\\Worker->process()\n#32 /var/www/kwalityuniform/vendor/laravel/framework/src/Illuminate/Queue/Worker.php(245): Illuminate\\Queue\\Worker->runJob()\n#33 /var/www/kwalityuniform/vendor/laravel/framework/src/Illuminate/Queue/Console/WorkCommand.php(149): Illuminate\\Queue\\Worker->daemon()\n#34 /var/www/kwalityuniform/vendor/laravel/framework/src/Illuminate/Queue/Console/WorkCommand.php(132): Illuminate\\Queue\\Console\\WorkCommand->runWorker()\n#35 /var/www/kwalityuniform/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(36): Illuminate\\Queue\\Console\\WorkCommand->handle()\n#36 /var/www/kwalityuniform/vendor/laravel/framework/src/Illuminate/Container/Util.php(43): Illuminate\\Container\\BoundMethod::{closure:Illuminate\\Container\\BoundMethod::call():35}()\n#37 /var/www/kwalityuniform/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(96): Illuminate\\Container\\Util::unwrapIfClosure()\n#38 /var/www/kwalityuniform/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(35): Illuminate\\Container\\BoundMethod::callBoundMethod()\n#39 /var/www/kwalityuniform/vendor/laravel/framework/src/Illuminate/Container/Container.php(799): Illuminate\\Container\\BoundMethod::call()\n#40 /var/www/kwalityuniform/vendor/laravel/framework/src/Illuminate/Console/Command.php(280): Illuminate\\Container\\Container->call()\n#41 /var/www/kwalityuniform/vendor/symfony/console/Command/Command.php(284): Illuminate\\Console\\Command->execute()\n#42 /var/www/kwalityuniform/vendor/laravel/framework/src/Illuminate/Console/Command.php(249): Symfony\\Component\\Console\\Command\\Command->run()\n#43 /var/www/kwalityuniform/vendor/symfony/console/Application.php(1144): Illuminate\\Console\\Command->run()\n#44 /var/www/kwalityuniform/vendor/symfony/console/Application.php(379): Symfony\\Component\\Console\\Application->doRunCommand()\n#45 /var/www/kwalityuniform/vendor/symfony/console/Application.php(218): Symfony\\Component\\Console\\Application->doRun()\n#46 /var/www/kwalityuniform/vendor/laravel/framework/src/Illuminate/Foundation/Console/Kernel.php(198): Symfony\\Component\\Console\\Application->run()\n#47 /var/www/kwalityuniform/vendor/laravel/framework/src/Illuminate/Foundation/Application.php(1235): Illuminate\\Foundation\\Console\\Kernel->handle()\n#48 /var/www/kwalityuniform/artisan(16): Illuminate\\Foundation\\Application->handleCommand()\n#49 {main}', '2026-07-11 19:32:38'),
(4, '759da820-1ff4-46bb-b3da-8ba840678eec', 'database', 'default', '{\"uuid\":\"759da820-1ff4-46bb-b3da-8ba840678eec\",\"displayName\":\"App\\\\Notifications\\\\SystemNotification\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"deleteWhenMissingModels\":false,\"data\":{\"commandName\":\"Illuminate\\\\Notifications\\\\SendQueuedNotifications\",\"command\":\"O:48:\\\"Illuminate\\\\Notifications\\\\SendQueuedNotifications\\\":3:{s:11:\\\"notifiables\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:15:\\\"App\\\\Models\\\\User\\\";s:2:\\\"id\\\";a:1:{i:0;i:1;}s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}s:12:\\\"notification\\\";O:36:\\\"App\\\\Notifications\\\\SystemNotification\\\":3:{s:7:\\\"\\u0000*\\u0000data\\\";a:6:{s:3:\\\"key\\\";s:16:\\\"product_approved\\\";s:5:\\\"title\\\";s:16:\\\"Product Approved\\\";s:7:\\\"message\\\";s:98:\\\"Congratulations! Your product \\\"Demo Product\\\" has been approved and is now available for customers.\\\";s:4:\\\"type\\\";s:7:\\\"success\\\";s:3:\\\"url\\\";s:39:\\\"http:\\/\\/uniform.eschoolkart.com\\/products\\\";s:10:\\\"created_at\\\";O:25:\\\"Illuminate\\\\Support\\\\Carbon\\\":3:{s:4:\\\"date\\\";s:26:\\\"2026-07-11 19:27:10.105038\\\";s:13:\\\"timezone_type\\\";i:3;s:8:\\\"timezone\\\";s:3:\\\"UTC\\\";}}s:11:\\\"\\u0000*\\u0000channels\\\";a:3:{i:0;s:8:\\\"database\\\";i:1;s:9:\\\"broadcast\\\";i:2;s:4:\\\"mail\\\";}s:2:\\\"id\\\";s:36:\\\"9c6ecf2c-7acb-46dc-8987-4639d55a6fc5\\\";}s:8:\\\"channels\\\";a:1:{i:0;s:4:\\\"mail\\\";}}\",\"batchId\":null},\"createdAt\":1783798030,\"delay\":null}', 'Symfony\\Component\\Mailer\\Exception\\UnexpectedResponseException: Expected response code \"250\" but got code \"550\", with message \"550 mailbox unavailable\". in /var/www/kwalityuniform/vendor/symfony/mailer/Transport/Smtp/SmtpTransport.php:331\nStack trace:\n#0 /var/www/kwalityuniform/vendor/symfony/mailer/Transport/Smtp/SmtpTransport.php(187): Symfony\\Component\\Mailer\\Transport\\Smtp\\SmtpTransport->assertResponseCode()\n#1 /var/www/kwalityuniform/vendor/symfony/mailer/Transport/Smtp/EsmtpTransport.php(150): Symfony\\Component\\Mailer\\Transport\\Smtp\\SmtpTransport->executeCommand()\n#2 /var/www/kwalityuniform/vendor/symfony/mailer/Transport/Smtp/SmtpTransport.php(252): Symfony\\Component\\Mailer\\Transport\\Smtp\\EsmtpTransport->executeCommand()\n#3 /var/www/kwalityuniform/vendor/symfony/mailer/Transport/Smtp/SmtpTransport.php(204): Symfony\\Component\\Mailer\\Transport\\Smtp\\SmtpTransport->doMailFromCommand()\n#4 /var/www/kwalityuniform/vendor/symfony/mailer/Transport/AbstractTransport.php(69): Symfony\\Component\\Mailer\\Transport\\Smtp\\SmtpTransport->doSend()\n#5 /var/www/kwalityuniform/vendor/symfony/mailer/Transport/Smtp/SmtpTransport.php(138): Symfony\\Component\\Mailer\\Transport\\AbstractTransport->send()\n#6 /var/www/kwalityuniform/vendor/laravel/framework/src/Illuminate/Mail/Mailer.php(584): Symfony\\Component\\Mailer\\Transport\\Smtp\\SmtpTransport->send()\n#7 /var/www/kwalityuniform/vendor/laravel/framework/src/Illuminate/Mail/Mailer.php(331): Illuminate\\Mail\\Mailer->sendSymfonyMessage()\n#8 /var/www/kwalityuniform/vendor/laravel/framework/src/Illuminate/Notifications/Channels/MailChannel.php(66): Illuminate\\Mail\\Mailer->send()\n#9 /var/www/kwalityuniform/vendor/laravel/framework/src/Illuminate/Notifications/NotificationSender.php(165): Illuminate\\Notifications\\Channels\\MailChannel->send()\n#10 /var/www/kwalityuniform/vendor/laravel/framework/src/Illuminate/Notifications/NotificationSender.php(120): Illuminate\\Notifications\\NotificationSender->sendToNotifiable()\n#11 /var/www/kwalityuniform/vendor/laravel/framework/src/Illuminate/Support/Traits/Localizable.php(19): Illuminate\\Notifications\\NotificationSender->{closure:Illuminate\\Notifications\\NotificationSender::sendNow():115}()\n#12 /var/www/kwalityuniform/vendor/laravel/framework/src/Illuminate/Notifications/NotificationSender.php(115): Illuminate\\Notifications\\NotificationSender->withLocale()\n#13 /var/www/kwalityuniform/vendor/laravel/framework/src/Illuminate/Notifications/ChannelManager.php(61): Illuminate\\Notifications\\NotificationSender->sendNow()\n#14 /var/www/kwalityuniform/vendor/laravel/framework/src/Illuminate/Notifications/SendQueuedNotifications.php(130): Illuminate\\Notifications\\ChannelManager->sendNow()\n#15 /var/www/kwalityuniform/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(36): Illuminate\\Notifications\\SendQueuedNotifications->handle()\n#16 /var/www/kwalityuniform/vendor/laravel/framework/src/Illuminate/Container/Util.php(43): Illuminate\\Container\\BoundMethod::{closure:Illuminate\\Container\\BoundMethod::call():35}()\n#17 /var/www/kwalityuniform/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(96): Illuminate\\Container\\Util::unwrapIfClosure()\n#18 /var/www/kwalityuniform/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(35): Illuminate\\Container\\BoundMethod::callBoundMethod()\n#19 /var/www/kwalityuniform/vendor/laravel/framework/src/Illuminate/Container/Container.php(799): Illuminate\\Container\\BoundMethod::call()\n#20 /var/www/kwalityuniform/vendor/laravel/framework/src/Illuminate/Bus/Dispatcher.php(136): Illuminate\\Container\\Container->call()\n#21 /var/www/kwalityuniform/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php(180): Illuminate\\Bus\\Dispatcher->{closure:Illuminate\\Bus\\Dispatcher::dispatchNow():133}()\n#22 /var/www/kwalityuniform/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php(137): Illuminate\\Pipeline\\Pipeline->{closure:Illuminate\\Pipeline\\Pipeline::prepareDestination():178}()\n#23 /var/www/kwalityuniform/vendor/laravel/framework/src/Illuminate/Bus/Dispatcher.php(140): Illuminate\\Pipeline\\Pipeline->then()\n#24 /var/www/kwalityuniform/vendor/laravel/framework/src/Illuminate/Queue/CallQueuedHandler.php(153): Illuminate\\Bus\\Dispatcher->dispatchNow()\n#25 /var/www/kwalityuniform/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php(180): Illuminate\\Queue\\CallQueuedHandler->{closure:Illuminate\\Queue\\CallQueuedHandler::dispatchThroughMiddleware():146}()\n#26 /var/www/kwalityuniform/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php(137): Illuminate\\Pipeline\\Pipeline->{closure:Illuminate\\Pipeline\\Pipeline::prepareDestination():178}()\n#27 /var/www/kwalityuniform/vendor/laravel/framework/src/Illuminate/Queue/CallQueuedHandler.php(146): Illuminate\\Pipeline\\Pipeline->then()\n#28 /var/www/kwalityuniform/vendor/laravel/framework/src/Illuminate/Queue/CallQueuedHandler.php(84): Illuminate\\Queue\\CallQueuedHandler->dispatchThroughMiddleware()\n#29 /var/www/kwalityuniform/vendor/laravel/framework/src/Illuminate/Queue/Jobs/Job.php(102): Illuminate\\Queue\\CallQueuedHandler->call()\n#30 /var/www/kwalityuniform/vendor/laravel/framework/src/Illuminate/Queue/Worker.php(553): Illuminate\\Queue\\Jobs\\Job->fire()\n#31 /var/www/kwalityuniform/vendor/laravel/framework/src/Illuminate/Queue/Worker.php(499): Illuminate\\Queue\\Worker->process()\n#32 /var/www/kwalityuniform/vendor/laravel/framework/src/Illuminate/Queue/Worker.php(245): Illuminate\\Queue\\Worker->runJob()\n#33 /var/www/kwalityuniform/vendor/laravel/framework/src/Illuminate/Queue/Console/WorkCommand.php(149): Illuminate\\Queue\\Worker->daemon()\n#34 /var/www/kwalityuniform/vendor/laravel/framework/src/Illuminate/Queue/Console/WorkCommand.php(132): Illuminate\\Queue\\Console\\WorkCommand->runWorker()\n#35 /var/www/kwalityuniform/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(36): Illuminate\\Queue\\Console\\WorkCommand->handle()\n#36 /var/www/kwalityuniform/vendor/laravel/framework/src/Illuminate/Container/Util.php(43): Illuminate\\Container\\BoundMethod::{closure:Illuminate\\Container\\BoundMethod::call():35}()\n#37 /var/www/kwalityuniform/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(96): Illuminate\\Container\\Util::unwrapIfClosure()\n#38 /var/www/kwalityuniform/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(35): Illuminate\\Container\\BoundMethod::callBoundMethod()\n#39 /var/www/kwalityuniform/vendor/laravel/framework/src/Illuminate/Container/Container.php(799): Illuminate\\Container\\BoundMethod::call()\n#40 /var/www/kwalityuniform/vendor/laravel/framework/src/Illuminate/Console/Command.php(280): Illuminate\\Container\\Container->call()\n#41 /var/www/kwalityuniform/vendor/symfony/console/Command/Command.php(284): Illuminate\\Console\\Command->execute()\n#42 /var/www/kwalityuniform/vendor/laravel/framework/src/Illuminate/Console/Command.php(249): Symfony\\Component\\Console\\Command\\Command->run()\n#43 /var/www/kwalityuniform/vendor/symfony/console/Application.php(1144): Illuminate\\Console\\Command->run()\n#44 /var/www/kwalityuniform/vendor/symfony/console/Application.php(379): Symfony\\Component\\Console\\Application->doRunCommand()\n#45 /var/www/kwalityuniform/vendor/symfony/console/Application.php(218): Symfony\\Component\\Console\\Application->doRun()\n#46 /var/www/kwalityuniform/vendor/laravel/framework/src/Illuminate/Foundation/Console/Kernel.php(198): Symfony\\Component\\Console\\Application->run()\n#47 /var/www/kwalityuniform/vendor/laravel/framework/src/Illuminate/Foundation/Application.php(1235): Illuminate\\Foundation\\Console\\Kernel->handle()\n#48 /var/www/kwalityuniform/artisan(16): Illuminate\\Foundation\\Application->handleCommand()\n#49 {main}', '2026-07-11 19:32:38'),
(5, '62a1cdf9-a2c8-4f26-b8d1-e2010ec25416', 'database', 'default', '{\"uuid\":\"62a1cdf9-a2c8-4f26-b8d1-e2010ec25416\",\"displayName\":\"App\\\\Notifications\\\\SystemNotification\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"deleteWhenMissingModels\":false,\"data\":{\"commandName\":\"Illuminate\\\\Notifications\\\\SendQueuedNotifications\",\"command\":\"O:48:\\\"Illuminate\\\\Notifications\\\\SendQueuedNotifications\\\":3:{s:11:\\\"notifiables\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:15:\\\"App\\\\Models\\\\User\\\";s:2:\\\"id\\\";a:1:{i:0;i:1;}s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}s:12:\\\"notification\\\";O:36:\\\"App\\\\Notifications\\\\SystemNotification\\\":3:{s:7:\\\"\\u0000*\\u0000data\\\";a:6:{s:3:\\\"key\\\";s:16:\\\"product_approved\\\";s:5:\\\"title\\\";s:16:\\\"Product Approved\\\";s:7:\\\"message\\\";s:98:\\\"Congratulations! Your product \\\"Demo Product\\\" has been approved and is now available for customers.\\\";s:4:\\\"type\\\";s:7:\\\"success\\\";s:3:\\\"url\\\";s:39:\\\"http:\\/\\/uniform.eschoolkart.com\\/products\\\";s:10:\\\"created_at\\\";O:25:\\\"Illuminate\\\\Support\\\\Carbon\\\":3:{s:4:\\\"date\\\";s:26:\\\"2026-07-11 19:27:54.817785\\\";s:13:\\\"timezone_type\\\";i:3;s:8:\\\"timezone\\\";s:3:\\\"UTC\\\";}}s:11:\\\"\\u0000*\\u0000channels\\\";a:3:{i:0;s:8:\\\"database\\\";i:1;s:9:\\\"broadcast\\\";i:2;s:4:\\\"mail\\\";}s:2:\\\"id\\\";s:36:\\\"9e468d8e-4103-4266-9e26-58c2b9074ac3\\\";}s:8:\\\"channels\\\";a:1:{i:0;s:4:\\\"mail\\\";}}\",\"batchId\":null},\"createdAt\":1783798074,\"delay\":null}', 'Symfony\\Component\\Mailer\\Exception\\UnexpectedResponseException: Expected response code \"250\" but got code \"550\", with message \"550 mailbox unavailable\". in /var/www/kwalityuniform/vendor/symfony/mailer/Transport/Smtp/SmtpTransport.php:331\nStack trace:\n#0 /var/www/kwalityuniform/vendor/symfony/mailer/Transport/Smtp/SmtpTransport.php(187): Symfony\\Component\\Mailer\\Transport\\Smtp\\SmtpTransport->assertResponseCode()\n#1 /var/www/kwalityuniform/vendor/symfony/mailer/Transport/Smtp/EsmtpTransport.php(150): Symfony\\Component\\Mailer\\Transport\\Smtp\\SmtpTransport->executeCommand()\n#2 /var/www/kwalityuniform/vendor/symfony/mailer/Transport/Smtp/SmtpTransport.php(252): Symfony\\Component\\Mailer\\Transport\\Smtp\\EsmtpTransport->executeCommand()\n#3 /var/www/kwalityuniform/vendor/symfony/mailer/Transport/Smtp/SmtpTransport.php(204): Symfony\\Component\\Mailer\\Transport\\Smtp\\SmtpTransport->doMailFromCommand()\n#4 /var/www/kwalityuniform/vendor/symfony/mailer/Transport/AbstractTransport.php(69): Symfony\\Component\\Mailer\\Transport\\Smtp\\SmtpTransport->doSend()\n#5 /var/www/kwalityuniform/vendor/symfony/mailer/Transport/Smtp/SmtpTransport.php(138): Symfony\\Component\\Mailer\\Transport\\AbstractTransport->send()\n#6 /var/www/kwalityuniform/vendor/laravel/framework/src/Illuminate/Mail/Mailer.php(584): Symfony\\Component\\Mailer\\Transport\\Smtp\\SmtpTransport->send()\n#7 /var/www/kwalityuniform/vendor/laravel/framework/src/Illuminate/Mail/Mailer.php(331): Illuminate\\Mail\\Mailer->sendSymfonyMessage()\n#8 /var/www/kwalityuniform/vendor/laravel/framework/src/Illuminate/Notifications/Channels/MailChannel.php(66): Illuminate\\Mail\\Mailer->send()\n#9 /var/www/kwalityuniform/vendor/laravel/framework/src/Illuminate/Notifications/NotificationSender.php(165): Illuminate\\Notifications\\Channels\\MailChannel->send()\n#10 /var/www/kwalityuniform/vendor/laravel/framework/src/Illuminate/Notifications/NotificationSender.php(120): Illuminate\\Notifications\\NotificationSender->sendToNotifiable()\n#11 /var/www/kwalityuniform/vendor/laravel/framework/src/Illuminate/Support/Traits/Localizable.php(19): Illuminate\\Notifications\\NotificationSender->{closure:Illuminate\\Notifications\\NotificationSender::sendNow():115}()\n#12 /var/www/kwalityuniform/vendor/laravel/framework/src/Illuminate/Notifications/NotificationSender.php(115): Illuminate\\Notifications\\NotificationSender->withLocale()\n#13 /var/www/kwalityuniform/vendor/laravel/framework/src/Illuminate/Notifications/ChannelManager.php(61): Illuminate\\Notifications\\NotificationSender->sendNow()\n#14 /var/www/kwalityuniform/vendor/laravel/framework/src/Illuminate/Notifications/SendQueuedNotifications.php(130): Illuminate\\Notifications\\ChannelManager->sendNow()\n#15 /var/www/kwalityuniform/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(36): Illuminate\\Notifications\\SendQueuedNotifications->handle()\n#16 /var/www/kwalityuniform/vendor/laravel/framework/src/Illuminate/Container/Util.php(43): Illuminate\\Container\\BoundMethod::{closure:Illuminate\\Container\\BoundMethod::call():35}()\n#17 /var/www/kwalityuniform/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(96): Illuminate\\Container\\Util::unwrapIfClosure()\n#18 /var/www/kwalityuniform/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(35): Illuminate\\Container\\BoundMethod::callBoundMethod()\n#19 /var/www/kwalityuniform/vendor/laravel/framework/src/Illuminate/Container/Container.php(799): Illuminate\\Container\\BoundMethod::call()\n#20 /var/www/kwalityuniform/vendor/laravel/framework/src/Illuminate/Bus/Dispatcher.php(136): Illuminate\\Container\\Container->call()\n#21 /var/www/kwalityuniform/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php(180): Illuminate\\Bus\\Dispatcher->{closure:Illuminate\\Bus\\Dispatcher::dispatchNow():133}()\n#22 /var/www/kwalityuniform/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php(137): Illuminate\\Pipeline\\Pipeline->{closure:Illuminate\\Pipeline\\Pipeline::prepareDestination():178}()\n#23 /var/www/kwalityuniform/vendor/laravel/framework/src/Illuminate/Bus/Dispatcher.php(140): Illuminate\\Pipeline\\Pipeline->then()\n#24 /var/www/kwalityuniform/vendor/laravel/framework/src/Illuminate/Queue/CallQueuedHandler.php(153): Illuminate\\Bus\\Dispatcher->dispatchNow()\n#25 /var/www/kwalityuniform/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php(180): Illuminate\\Queue\\CallQueuedHandler->{closure:Illuminate\\Queue\\CallQueuedHandler::dispatchThroughMiddleware():146}()\n#26 /var/www/kwalityuniform/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php(137): Illuminate\\Pipeline\\Pipeline->{closure:Illuminate\\Pipeline\\Pipeline::prepareDestination():178}()\n#27 /var/www/kwalityuniform/vendor/laravel/framework/src/Illuminate/Queue/CallQueuedHandler.php(146): Illuminate\\Pipeline\\Pipeline->then()\n#28 /var/www/kwalityuniform/vendor/laravel/framework/src/Illuminate/Queue/CallQueuedHandler.php(84): Illuminate\\Queue\\CallQueuedHandler->dispatchThroughMiddleware()\n#29 /var/www/kwalityuniform/vendor/laravel/framework/src/Illuminate/Queue/Jobs/Job.php(102): Illuminate\\Queue\\CallQueuedHandler->call()\n#30 /var/www/kwalityuniform/vendor/laravel/framework/src/Illuminate/Queue/Worker.php(553): Illuminate\\Queue\\Jobs\\Job->fire()\n#31 /var/www/kwalityuniform/vendor/laravel/framework/src/Illuminate/Queue/Worker.php(499): Illuminate\\Queue\\Worker->process()\n#32 /var/www/kwalityuniform/vendor/laravel/framework/src/Illuminate/Queue/Worker.php(245): Illuminate\\Queue\\Worker->runJob()\n#33 /var/www/kwalityuniform/vendor/laravel/framework/src/Illuminate/Queue/Console/WorkCommand.php(149): Illuminate\\Queue\\Worker->daemon()\n#34 /var/www/kwalityuniform/vendor/laravel/framework/src/Illuminate/Queue/Console/WorkCommand.php(132): Illuminate\\Queue\\Console\\WorkCommand->runWorker()\n#35 /var/www/kwalityuniform/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(36): Illuminate\\Queue\\Console\\WorkCommand->handle()\n#36 /var/www/kwalityuniform/vendor/laravel/framework/src/Illuminate/Container/Util.php(43): Illuminate\\Container\\BoundMethod::{closure:Illuminate\\Container\\BoundMethod::call():35}()\n#37 /var/www/kwalityuniform/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(96): Illuminate\\Container\\Util::unwrapIfClosure()\n#38 /var/www/kwalityuniform/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(35): Illuminate\\Container\\BoundMethod::callBoundMethod()\n#39 /var/www/kwalityuniform/vendor/laravel/framework/src/Illuminate/Container/Container.php(799): Illuminate\\Container\\BoundMethod::call()\n#40 /var/www/kwalityuniform/vendor/laravel/framework/src/Illuminate/Console/Command.php(280): Illuminate\\Container\\Container->call()\n#41 /var/www/kwalityuniform/vendor/symfony/console/Command/Command.php(284): Illuminate\\Console\\Command->execute()\n#42 /var/www/kwalityuniform/vendor/laravel/framework/src/Illuminate/Console/Command.php(249): Symfony\\Component\\Console\\Command\\Command->run()\n#43 /var/www/kwalityuniform/vendor/symfony/console/Application.php(1144): Illuminate\\Console\\Command->run()\n#44 /var/www/kwalityuniform/vendor/symfony/console/Application.php(379): Symfony\\Component\\Console\\Application->doRunCommand()\n#45 /var/www/kwalityuniform/vendor/symfony/console/Application.php(218): Symfony\\Component\\Console\\Application->doRun()\n#46 /var/www/kwalityuniform/vendor/laravel/framework/src/Illuminate/Foundation/Console/Kernel.php(198): Symfony\\Component\\Console\\Application->run()\n#47 /var/www/kwalityuniform/vendor/laravel/framework/src/Illuminate/Foundation/Application.php(1235): Illuminate\\Foundation\\Console\\Kernel->handle()\n#48 /var/www/kwalityuniform/artisan(16): Illuminate\\Foundation\\Application->handleCommand()\n#49 {main}', '2026-07-11 19:32:39');
INSERT INTO `failed_jobs` (`id`, `uuid`, `connection`, `queue`, `payload`, `exception`, `failed_at`) VALUES
(6, '4b7f78ec-0074-414a-9920-dadf6432348d', 'database', 'default', '{\"uuid\":\"4b7f78ec-0074-414a-9920-dadf6432348d\",\"displayName\":\"App\\\\Notifications\\\\SystemNotification\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"deleteWhenMissingModels\":false,\"data\":{\"commandName\":\"Illuminate\\\\Notifications\\\\SendQueuedNotifications\",\"command\":\"O:48:\\\"Illuminate\\\\Notifications\\\\SendQueuedNotifications\\\":3:{s:11:\\\"notifiables\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:15:\\\"App\\\\Models\\\\User\\\";s:2:\\\"id\\\";a:1:{i:0;i:1;}s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}s:12:\\\"notification\\\";O:36:\\\"App\\\\Notifications\\\\SystemNotification\\\":3:{s:7:\\\"\\u0000*\\u0000data\\\";a:6:{s:3:\\\"key\\\";s:16:\\\"product_approved\\\";s:5:\\\"title\\\";s:16:\\\"Product Approved\\\";s:7:\\\"message\\\";s:98:\\\"Congratulations! Your product \\\"Demo Product\\\" has been approved and is now available for customers.\\\";s:4:\\\"type\\\";s:7:\\\"success\\\";s:3:\\\"url\\\";s:39:\\\"http:\\/\\/uniform.eschoolkart.com\\/products\\\";s:10:\\\"created_at\\\";O:25:\\\"Illuminate\\\\Support\\\\Carbon\\\":3:{s:4:\\\"date\\\";s:26:\\\"2026-07-11 19:28:49.826552\\\";s:13:\\\"timezone_type\\\";i:3;s:8:\\\"timezone\\\";s:3:\\\"UTC\\\";}}s:11:\\\"\\u0000*\\u0000channels\\\";a:3:{i:0;s:8:\\\"database\\\";i:1;s:9:\\\"broadcast\\\";i:2;s:4:\\\"mail\\\";}s:2:\\\"id\\\";s:36:\\\"4b7d80e8-8e05-4a08-8f6e-4ae55af75ec6\\\";}s:8:\\\"channels\\\";a:1:{i:0;s:4:\\\"mail\\\";}}\",\"batchId\":null},\"createdAt\":1783798129,\"delay\":null}', 'Symfony\\Component\\Mailer\\Exception\\UnexpectedResponseException: Expected response code \"250\" but got code \"550\", with message \"550 mailbox unavailable\". in /var/www/kwalityuniform/vendor/symfony/mailer/Transport/Smtp/SmtpTransport.php:331\nStack trace:\n#0 /var/www/kwalityuniform/vendor/symfony/mailer/Transport/Smtp/SmtpTransport.php(187): Symfony\\Component\\Mailer\\Transport\\Smtp\\SmtpTransport->assertResponseCode()\n#1 /var/www/kwalityuniform/vendor/symfony/mailer/Transport/Smtp/EsmtpTransport.php(150): Symfony\\Component\\Mailer\\Transport\\Smtp\\SmtpTransport->executeCommand()\n#2 /var/www/kwalityuniform/vendor/symfony/mailer/Transport/Smtp/SmtpTransport.php(252): Symfony\\Component\\Mailer\\Transport\\Smtp\\EsmtpTransport->executeCommand()\n#3 /var/www/kwalityuniform/vendor/symfony/mailer/Transport/Smtp/SmtpTransport.php(204): Symfony\\Component\\Mailer\\Transport\\Smtp\\SmtpTransport->doMailFromCommand()\n#4 /var/www/kwalityuniform/vendor/symfony/mailer/Transport/AbstractTransport.php(69): Symfony\\Component\\Mailer\\Transport\\Smtp\\SmtpTransport->doSend()\n#5 /var/www/kwalityuniform/vendor/symfony/mailer/Transport/Smtp/SmtpTransport.php(138): Symfony\\Component\\Mailer\\Transport\\AbstractTransport->send()\n#6 /var/www/kwalityuniform/vendor/laravel/framework/src/Illuminate/Mail/Mailer.php(584): Symfony\\Component\\Mailer\\Transport\\Smtp\\SmtpTransport->send()\n#7 /var/www/kwalityuniform/vendor/laravel/framework/src/Illuminate/Mail/Mailer.php(331): Illuminate\\Mail\\Mailer->sendSymfonyMessage()\n#8 /var/www/kwalityuniform/vendor/laravel/framework/src/Illuminate/Notifications/Channels/MailChannel.php(66): Illuminate\\Mail\\Mailer->send()\n#9 /var/www/kwalityuniform/vendor/laravel/framework/src/Illuminate/Notifications/NotificationSender.php(165): Illuminate\\Notifications\\Channels\\MailChannel->send()\n#10 /var/www/kwalityuniform/vendor/laravel/framework/src/Illuminate/Notifications/NotificationSender.php(120): Illuminate\\Notifications\\NotificationSender->sendToNotifiable()\n#11 /var/www/kwalityuniform/vendor/laravel/framework/src/Illuminate/Support/Traits/Localizable.php(19): Illuminate\\Notifications\\NotificationSender->{closure:Illuminate\\Notifications\\NotificationSender::sendNow():115}()\n#12 /var/www/kwalityuniform/vendor/laravel/framework/src/Illuminate/Notifications/NotificationSender.php(115): Illuminate\\Notifications\\NotificationSender->withLocale()\n#13 /var/www/kwalityuniform/vendor/laravel/framework/src/Illuminate/Notifications/ChannelManager.php(61): Illuminate\\Notifications\\NotificationSender->sendNow()\n#14 /var/www/kwalityuniform/vendor/laravel/framework/src/Illuminate/Notifications/SendQueuedNotifications.php(130): Illuminate\\Notifications\\ChannelManager->sendNow()\n#15 /var/www/kwalityuniform/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(36): Illuminate\\Notifications\\SendQueuedNotifications->handle()\n#16 /var/www/kwalityuniform/vendor/laravel/framework/src/Illuminate/Container/Util.php(43): Illuminate\\Container\\BoundMethod::{closure:Illuminate\\Container\\BoundMethod::call():35}()\n#17 /var/www/kwalityuniform/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(96): Illuminate\\Container\\Util::unwrapIfClosure()\n#18 /var/www/kwalityuniform/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(35): Illuminate\\Container\\BoundMethod::callBoundMethod()\n#19 /var/www/kwalityuniform/vendor/laravel/framework/src/Illuminate/Container/Container.php(799): Illuminate\\Container\\BoundMethod::call()\n#20 /var/www/kwalityuniform/vendor/laravel/framework/src/Illuminate/Bus/Dispatcher.php(136): Illuminate\\Container\\Container->call()\n#21 /var/www/kwalityuniform/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php(180): Illuminate\\Bus\\Dispatcher->{closure:Illuminate\\Bus\\Dispatcher::dispatchNow():133}()\n#22 /var/www/kwalityuniform/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php(137): Illuminate\\Pipeline\\Pipeline->{closure:Illuminate\\Pipeline\\Pipeline::prepareDestination():178}()\n#23 /var/www/kwalityuniform/vendor/laravel/framework/src/Illuminate/Bus/Dispatcher.php(140): Illuminate\\Pipeline\\Pipeline->then()\n#24 /var/www/kwalityuniform/vendor/laravel/framework/src/Illuminate/Queue/CallQueuedHandler.php(153): Illuminate\\Bus\\Dispatcher->dispatchNow()\n#25 /var/www/kwalityuniform/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php(180): Illuminate\\Queue\\CallQueuedHandler->{closure:Illuminate\\Queue\\CallQueuedHandler::dispatchThroughMiddleware():146}()\n#26 /var/www/kwalityuniform/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php(137): Illuminate\\Pipeline\\Pipeline->{closure:Illuminate\\Pipeline\\Pipeline::prepareDestination():178}()\n#27 /var/www/kwalityuniform/vendor/laravel/framework/src/Illuminate/Queue/CallQueuedHandler.php(146): Illuminate\\Pipeline\\Pipeline->then()\n#28 /var/www/kwalityuniform/vendor/laravel/framework/src/Illuminate/Queue/CallQueuedHandler.php(84): Illuminate\\Queue\\CallQueuedHandler->dispatchThroughMiddleware()\n#29 /var/www/kwalityuniform/vendor/laravel/framework/src/Illuminate/Queue/Jobs/Job.php(102): Illuminate\\Queue\\CallQueuedHandler->call()\n#30 /var/www/kwalityuniform/vendor/laravel/framework/src/Illuminate/Queue/Worker.php(553): Illuminate\\Queue\\Jobs\\Job->fire()\n#31 /var/www/kwalityuniform/vendor/laravel/framework/src/Illuminate/Queue/Worker.php(499): Illuminate\\Queue\\Worker->process()\n#32 /var/www/kwalityuniform/vendor/laravel/framework/src/Illuminate/Queue/Worker.php(245): Illuminate\\Queue\\Worker->runJob()\n#33 /var/www/kwalityuniform/vendor/laravel/framework/src/Illuminate/Queue/Console/WorkCommand.php(149): Illuminate\\Queue\\Worker->daemon()\n#34 /var/www/kwalityuniform/vendor/laravel/framework/src/Illuminate/Queue/Console/WorkCommand.php(132): Illuminate\\Queue\\Console\\WorkCommand->runWorker()\n#35 /var/www/kwalityuniform/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(36): Illuminate\\Queue\\Console\\WorkCommand->handle()\n#36 /var/www/kwalityuniform/vendor/laravel/framework/src/Illuminate/Container/Util.php(43): Illuminate\\Container\\BoundMethod::{closure:Illuminate\\Container\\BoundMethod::call():35}()\n#37 /var/www/kwalityuniform/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(96): Illuminate\\Container\\Util::unwrapIfClosure()\n#38 /var/www/kwalityuniform/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(35): Illuminate\\Container\\BoundMethod::callBoundMethod()\n#39 /var/www/kwalityuniform/vendor/laravel/framework/src/Illuminate/Container/Container.php(799): Illuminate\\Container\\BoundMethod::call()\n#40 /var/www/kwalityuniform/vendor/laravel/framework/src/Illuminate/Console/Command.php(280): Illuminate\\Container\\Container->call()\n#41 /var/www/kwalityuniform/vendor/symfony/console/Command/Command.php(284): Illuminate\\Console\\Command->execute()\n#42 /var/www/kwalityuniform/vendor/laravel/framework/src/Illuminate/Console/Command.php(249): Symfony\\Component\\Console\\Command\\Command->run()\n#43 /var/www/kwalityuniform/vendor/symfony/console/Application.php(1144): Illuminate\\Console\\Command->run()\n#44 /var/www/kwalityuniform/vendor/symfony/console/Application.php(379): Symfony\\Component\\Console\\Application->doRunCommand()\n#45 /var/www/kwalityuniform/vendor/symfony/console/Application.php(218): Symfony\\Component\\Console\\Application->doRun()\n#46 /var/www/kwalityuniform/vendor/laravel/framework/src/Illuminate/Foundation/Console/Kernel.php(198): Symfony\\Component\\Console\\Application->run()\n#47 /var/www/kwalityuniform/vendor/laravel/framework/src/Illuminate/Foundation/Application.php(1235): Illuminate\\Foundation\\Console\\Kernel->handle()\n#48 /var/www/kwalityuniform/artisan(16): Illuminate\\Foundation\\Application->handleCommand()\n#49 {main}', '2026-07-11 19:32:39'),
(7, '1e9c85a9-f1da-4aa0-aea4-eaad715b524c', 'database', 'default', '{\"uuid\":\"1e9c85a9-f1da-4aa0-aea4-eaad715b524c\",\"displayName\":\"App\\\\Notifications\\\\SystemNotification\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"deleteWhenMissingModels\":false,\"data\":{\"commandName\":\"Illuminate\\\\Notifications\\\\SendQueuedNotifications\",\"command\":\"O:48:\\\"Illuminate\\\\Notifications\\\\SendQueuedNotifications\\\":3:{s:11:\\\"notifiables\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:15:\\\"App\\\\Models\\\\User\\\";s:2:\\\"id\\\";a:1:{i:0;i:1;}s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}s:12:\\\"notification\\\";O:36:\\\"App\\\\Notifications\\\\SystemNotification\\\":3:{s:7:\\\"\\u0000*\\u0000data\\\";a:6:{s:3:\\\"key\\\";s:16:\\\"product_approved\\\";s:5:\\\"title\\\";s:16:\\\"Product Approved\\\";s:7:\\\"message\\\";s:98:\\\"Congratulations! Your product \\\"Demo Product\\\" has been approved and is now available for customers.\\\";s:4:\\\"type\\\";s:7:\\\"success\\\";s:3:\\\"url\\\";s:39:\\\"http:\\/\\/uniform.eschoolkart.com\\/products\\\";s:10:\\\"created_at\\\";O:25:\\\"Illuminate\\\\Support\\\\Carbon\\\":3:{s:4:\\\"date\\\";s:26:\\\"2026-07-11 19:34:49.657336\\\";s:13:\\\"timezone_type\\\";i:3;s:8:\\\"timezone\\\";s:3:\\\"UTC\\\";}}s:11:\\\"\\u0000*\\u0000channels\\\";a:3:{i:0;s:8:\\\"database\\\";i:1;s:9:\\\"broadcast\\\";i:2;s:4:\\\"mail\\\";}s:2:\\\"id\\\";s:36:\\\"9b1c574e-6212-4c9f-a5ce-c11f5e91b8ea\\\";}s:8:\\\"channels\\\";a:1:{i:0;s:4:\\\"mail\\\";}}\",\"batchId\":null},\"createdAt\":1783798489,\"delay\":null}', 'Symfony\\Component\\Mailer\\Exception\\UnexpectedResponseException: Expected response code \"250\" but got code \"550\", with message \"550 mailbox unavailable\". in /var/www/kwalityuniform/vendor/symfony/mailer/Transport/Smtp/SmtpTransport.php:331\nStack trace:\n#0 /var/www/kwalityuniform/vendor/symfony/mailer/Transport/Smtp/SmtpTransport.php(187): Symfony\\Component\\Mailer\\Transport\\Smtp\\SmtpTransport->assertResponseCode()\n#1 /var/www/kwalityuniform/vendor/symfony/mailer/Transport/Smtp/EsmtpTransport.php(150): Symfony\\Component\\Mailer\\Transport\\Smtp\\SmtpTransport->executeCommand()\n#2 /var/www/kwalityuniform/vendor/symfony/mailer/Transport/Smtp/SmtpTransport.php(252): Symfony\\Component\\Mailer\\Transport\\Smtp\\EsmtpTransport->executeCommand()\n#3 /var/www/kwalityuniform/vendor/symfony/mailer/Transport/Smtp/SmtpTransport.php(204): Symfony\\Component\\Mailer\\Transport\\Smtp\\SmtpTransport->doMailFromCommand()\n#4 /var/www/kwalityuniform/vendor/symfony/mailer/Transport/AbstractTransport.php(69): Symfony\\Component\\Mailer\\Transport\\Smtp\\SmtpTransport->doSend()\n#5 /var/www/kwalityuniform/vendor/symfony/mailer/Transport/Smtp/SmtpTransport.php(138): Symfony\\Component\\Mailer\\Transport\\AbstractTransport->send()\n#6 /var/www/kwalityuniform/vendor/laravel/framework/src/Illuminate/Mail/Mailer.php(584): Symfony\\Component\\Mailer\\Transport\\Smtp\\SmtpTransport->send()\n#7 /var/www/kwalityuniform/vendor/laravel/framework/src/Illuminate/Mail/Mailer.php(331): Illuminate\\Mail\\Mailer->sendSymfonyMessage()\n#8 /var/www/kwalityuniform/vendor/laravel/framework/src/Illuminate/Notifications/Channels/MailChannel.php(66): Illuminate\\Mail\\Mailer->send()\n#9 /var/www/kwalityuniform/vendor/laravel/framework/src/Illuminate/Notifications/NotificationSender.php(165): Illuminate\\Notifications\\Channels\\MailChannel->send()\n#10 /var/www/kwalityuniform/vendor/laravel/framework/src/Illuminate/Notifications/NotificationSender.php(120): Illuminate\\Notifications\\NotificationSender->sendToNotifiable()\n#11 /var/www/kwalityuniform/vendor/laravel/framework/src/Illuminate/Support/Traits/Localizable.php(19): Illuminate\\Notifications\\NotificationSender->{closure:Illuminate\\Notifications\\NotificationSender::sendNow():115}()\n#12 /var/www/kwalityuniform/vendor/laravel/framework/src/Illuminate/Notifications/NotificationSender.php(115): Illuminate\\Notifications\\NotificationSender->withLocale()\n#13 /var/www/kwalityuniform/vendor/laravel/framework/src/Illuminate/Notifications/ChannelManager.php(61): Illuminate\\Notifications\\NotificationSender->sendNow()\n#14 /var/www/kwalityuniform/vendor/laravel/framework/src/Illuminate/Notifications/SendQueuedNotifications.php(130): Illuminate\\Notifications\\ChannelManager->sendNow()\n#15 /var/www/kwalityuniform/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(36): Illuminate\\Notifications\\SendQueuedNotifications->handle()\n#16 /var/www/kwalityuniform/vendor/laravel/framework/src/Illuminate/Container/Util.php(43): Illuminate\\Container\\BoundMethod::{closure:Illuminate\\Container\\BoundMethod::call():35}()\n#17 /var/www/kwalityuniform/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(96): Illuminate\\Container\\Util::unwrapIfClosure()\n#18 /var/www/kwalityuniform/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(35): Illuminate\\Container\\BoundMethod::callBoundMethod()\n#19 /var/www/kwalityuniform/vendor/laravel/framework/src/Illuminate/Container/Container.php(799): Illuminate\\Container\\BoundMethod::call()\n#20 /var/www/kwalityuniform/vendor/laravel/framework/src/Illuminate/Bus/Dispatcher.php(136): Illuminate\\Container\\Container->call()\n#21 /var/www/kwalityuniform/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php(180): Illuminate\\Bus\\Dispatcher->{closure:Illuminate\\Bus\\Dispatcher::dispatchNow():133}()\n#22 /var/www/kwalityuniform/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php(137): Illuminate\\Pipeline\\Pipeline->{closure:Illuminate\\Pipeline\\Pipeline::prepareDestination():178}()\n#23 /var/www/kwalityuniform/vendor/laravel/framework/src/Illuminate/Bus/Dispatcher.php(140): Illuminate\\Pipeline\\Pipeline->then()\n#24 /var/www/kwalityuniform/vendor/laravel/framework/src/Illuminate/Queue/CallQueuedHandler.php(153): Illuminate\\Bus\\Dispatcher->dispatchNow()\n#25 /var/www/kwalityuniform/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php(180): Illuminate\\Queue\\CallQueuedHandler->{closure:Illuminate\\Queue\\CallQueuedHandler::dispatchThroughMiddleware():146}()\n#26 /var/www/kwalityuniform/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php(137): Illuminate\\Pipeline\\Pipeline->{closure:Illuminate\\Pipeline\\Pipeline::prepareDestination():178}()\n#27 /var/www/kwalityuniform/vendor/laravel/framework/src/Illuminate/Queue/CallQueuedHandler.php(146): Illuminate\\Pipeline\\Pipeline->then()\n#28 /var/www/kwalityuniform/vendor/laravel/framework/src/Illuminate/Queue/CallQueuedHandler.php(84): Illuminate\\Queue\\CallQueuedHandler->dispatchThroughMiddleware()\n#29 /var/www/kwalityuniform/vendor/laravel/framework/src/Illuminate/Queue/Jobs/Job.php(102): Illuminate\\Queue\\CallQueuedHandler->call()\n#30 /var/www/kwalityuniform/vendor/laravel/framework/src/Illuminate/Queue/Worker.php(553): Illuminate\\Queue\\Jobs\\Job->fire()\n#31 /var/www/kwalityuniform/vendor/laravel/framework/src/Illuminate/Queue/Worker.php(499): Illuminate\\Queue\\Worker->process()\n#32 /var/www/kwalityuniform/vendor/laravel/framework/src/Illuminate/Queue/Worker.php(245): Illuminate\\Queue\\Worker->runJob()\n#33 /var/www/kwalityuniform/vendor/laravel/framework/src/Illuminate/Queue/Console/WorkCommand.php(149): Illuminate\\Queue\\Worker->daemon()\n#34 /var/www/kwalityuniform/vendor/laravel/framework/src/Illuminate/Queue/Console/WorkCommand.php(132): Illuminate\\Queue\\Console\\WorkCommand->runWorker()\n#35 /var/www/kwalityuniform/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(36): Illuminate\\Queue\\Console\\WorkCommand->handle()\n#36 /var/www/kwalityuniform/vendor/laravel/framework/src/Illuminate/Container/Util.php(43): Illuminate\\Container\\BoundMethod::{closure:Illuminate\\Container\\BoundMethod::call():35}()\n#37 /var/www/kwalityuniform/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(96): Illuminate\\Container\\Util::unwrapIfClosure()\n#38 /var/www/kwalityuniform/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(35): Illuminate\\Container\\BoundMethod::callBoundMethod()\n#39 /var/www/kwalityuniform/vendor/laravel/framework/src/Illuminate/Container/Container.php(799): Illuminate\\Container\\BoundMethod::call()\n#40 /var/www/kwalityuniform/vendor/laravel/framework/src/Illuminate/Console/Command.php(280): Illuminate\\Container\\Container->call()\n#41 /var/www/kwalityuniform/vendor/symfony/console/Command/Command.php(284): Illuminate\\Console\\Command->execute()\n#42 /var/www/kwalityuniform/vendor/laravel/framework/src/Illuminate/Console/Command.php(249): Symfony\\Component\\Console\\Command\\Command->run()\n#43 /var/www/kwalityuniform/vendor/symfony/console/Application.php(1144): Illuminate\\Console\\Command->run()\n#44 /var/www/kwalityuniform/vendor/symfony/console/Application.php(379): Symfony\\Component\\Console\\Application->doRunCommand()\n#45 /var/www/kwalityuniform/vendor/symfony/console/Application.php(218): Symfony\\Component\\Console\\Application->doRun()\n#46 /var/www/kwalityuniform/vendor/laravel/framework/src/Illuminate/Foundation/Console/Kernel.php(198): Symfony\\Component\\Console\\Application->run()\n#47 /var/www/kwalityuniform/vendor/laravel/framework/src/Illuminate/Foundation/Application.php(1235): Illuminate\\Foundation\\Console\\Kernel->handle()\n#48 /var/www/kwalityuniform/artisan(16): Illuminate\\Foundation\\Application->handleCommand()\n#49 {main}', '2026-07-11 19:34:53'),
(8, '04c07848-a95a-4b23-84c3-5ba115c963f4', 'database', 'default', '{\"uuid\":\"04c07848-a95a-4b23-84c3-5ba115c963f4\",\"displayName\":\"App\\\\Notifications\\\\SystemNotification\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"deleteWhenMissingModels\":false,\"data\":{\"commandName\":\"Illuminate\\\\Notifications\\\\SendQueuedNotifications\",\"command\":\"O:48:\\\"Illuminate\\\\Notifications\\\\SendQueuedNotifications\\\":3:{s:11:\\\"notifiables\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:15:\\\"App\\\\Models\\\\User\\\";s:2:\\\"id\\\";a:1:{i:0;i:1;}s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}s:12:\\\"notification\\\";O:36:\\\"App\\\\Notifications\\\\SystemNotification\\\":3:{s:7:\\\"\\u0000*\\u0000data\\\";a:6:{s:3:\\\"key\\\";s:16:\\\"product_approved\\\";s:5:\\\"title\\\";s:16:\\\"Product Approved\\\";s:7:\\\"message\\\";s:98:\\\"Congratulations! Your product \\\"Demo Product\\\" has been approved and is now available for customers.\\\";s:4:\\\"type\\\";s:7:\\\"success\\\";s:3:\\\"url\\\";s:39:\\\"http:\\/\\/uniform.eschoolkart.com\\/products\\\";s:10:\\\"created_at\\\";O:25:\\\"Illuminate\\\\Support\\\\Carbon\\\":3:{s:4:\\\"date\\\";s:26:\\\"2026-07-11 19:34:57.716085\\\";s:13:\\\"timezone_type\\\";i:3;s:8:\\\"timezone\\\";s:3:\\\"UTC\\\";}}s:11:\\\"\\u0000*\\u0000channels\\\";a:3:{i:0;s:8:\\\"database\\\";i:1;s:9:\\\"broadcast\\\";i:2;s:4:\\\"mail\\\";}s:2:\\\"id\\\";s:36:\\\"dcb87286-5864-40b7-8a7a-eea66cac9d97\\\";}s:8:\\\"channels\\\";a:1:{i:0;s:4:\\\"mail\\\";}}\",\"batchId\":null},\"createdAt\":1783798497,\"delay\":null}', 'Symfony\\Component\\Mailer\\Exception\\UnexpectedResponseException: Expected response code \"250\" but got code \"550\", with message \"550 mailbox unavailable\". in /var/www/kwalityuniform/vendor/symfony/mailer/Transport/Smtp/SmtpTransport.php:331\nStack trace:\n#0 /var/www/kwalityuniform/vendor/symfony/mailer/Transport/Smtp/SmtpTransport.php(187): Symfony\\Component\\Mailer\\Transport\\Smtp\\SmtpTransport->assertResponseCode()\n#1 /var/www/kwalityuniform/vendor/symfony/mailer/Transport/Smtp/EsmtpTransport.php(150): Symfony\\Component\\Mailer\\Transport\\Smtp\\SmtpTransport->executeCommand()\n#2 /var/www/kwalityuniform/vendor/symfony/mailer/Transport/Smtp/SmtpTransport.php(252): Symfony\\Component\\Mailer\\Transport\\Smtp\\EsmtpTransport->executeCommand()\n#3 /var/www/kwalityuniform/vendor/symfony/mailer/Transport/Smtp/SmtpTransport.php(204): Symfony\\Component\\Mailer\\Transport\\Smtp\\SmtpTransport->doMailFromCommand()\n#4 /var/www/kwalityuniform/vendor/symfony/mailer/Transport/AbstractTransport.php(69): Symfony\\Component\\Mailer\\Transport\\Smtp\\SmtpTransport->doSend()\n#5 /var/www/kwalityuniform/vendor/symfony/mailer/Transport/Smtp/SmtpTransport.php(138): Symfony\\Component\\Mailer\\Transport\\AbstractTransport->send()\n#6 /var/www/kwalityuniform/vendor/laravel/framework/src/Illuminate/Mail/Mailer.php(584): Symfony\\Component\\Mailer\\Transport\\Smtp\\SmtpTransport->send()\n#7 /var/www/kwalityuniform/vendor/laravel/framework/src/Illuminate/Mail/Mailer.php(331): Illuminate\\Mail\\Mailer->sendSymfonyMessage()\n#8 /var/www/kwalityuniform/vendor/laravel/framework/src/Illuminate/Notifications/Channels/MailChannel.php(66): Illuminate\\Mail\\Mailer->send()\n#9 /var/www/kwalityuniform/vendor/laravel/framework/src/Illuminate/Notifications/NotificationSender.php(165): Illuminate\\Notifications\\Channels\\MailChannel->send()\n#10 /var/www/kwalityuniform/vendor/laravel/framework/src/Illuminate/Notifications/NotificationSender.php(120): Illuminate\\Notifications\\NotificationSender->sendToNotifiable()\n#11 /var/www/kwalityuniform/vendor/laravel/framework/src/Illuminate/Support/Traits/Localizable.php(19): Illuminate\\Notifications\\NotificationSender->{closure:Illuminate\\Notifications\\NotificationSender::sendNow():115}()\n#12 /var/www/kwalityuniform/vendor/laravel/framework/src/Illuminate/Notifications/NotificationSender.php(115): Illuminate\\Notifications\\NotificationSender->withLocale()\n#13 /var/www/kwalityuniform/vendor/laravel/framework/src/Illuminate/Notifications/ChannelManager.php(61): Illuminate\\Notifications\\NotificationSender->sendNow()\n#14 /var/www/kwalityuniform/vendor/laravel/framework/src/Illuminate/Notifications/SendQueuedNotifications.php(130): Illuminate\\Notifications\\ChannelManager->sendNow()\n#15 /var/www/kwalityuniform/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(36): Illuminate\\Notifications\\SendQueuedNotifications->handle()\n#16 /var/www/kwalityuniform/vendor/laravel/framework/src/Illuminate/Container/Util.php(43): Illuminate\\Container\\BoundMethod::{closure:Illuminate\\Container\\BoundMethod::call():35}()\n#17 /var/www/kwalityuniform/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(96): Illuminate\\Container\\Util::unwrapIfClosure()\n#18 /var/www/kwalityuniform/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(35): Illuminate\\Container\\BoundMethod::callBoundMethod()\n#19 /var/www/kwalityuniform/vendor/laravel/framework/src/Illuminate/Container/Container.php(799): Illuminate\\Container\\BoundMethod::call()\n#20 /var/www/kwalityuniform/vendor/laravel/framework/src/Illuminate/Bus/Dispatcher.php(136): Illuminate\\Container\\Container->call()\n#21 /var/www/kwalityuniform/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php(180): Illuminate\\Bus\\Dispatcher->{closure:Illuminate\\Bus\\Dispatcher::dispatchNow():133}()\n#22 /var/www/kwalityuniform/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php(137): Illuminate\\Pipeline\\Pipeline->{closure:Illuminate\\Pipeline\\Pipeline::prepareDestination():178}()\n#23 /var/www/kwalityuniform/vendor/laravel/framework/src/Illuminate/Bus/Dispatcher.php(140): Illuminate\\Pipeline\\Pipeline->then()\n#24 /var/www/kwalityuniform/vendor/laravel/framework/src/Illuminate/Queue/CallQueuedHandler.php(153): Illuminate\\Bus\\Dispatcher->dispatchNow()\n#25 /var/www/kwalityuniform/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php(180): Illuminate\\Queue\\CallQueuedHandler->{closure:Illuminate\\Queue\\CallQueuedHandler::dispatchThroughMiddleware():146}()\n#26 /var/www/kwalityuniform/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php(137): Illuminate\\Pipeline\\Pipeline->{closure:Illuminate\\Pipeline\\Pipeline::prepareDestination():178}()\n#27 /var/www/kwalityuniform/vendor/laravel/framework/src/Illuminate/Queue/CallQueuedHandler.php(146): Illuminate\\Pipeline\\Pipeline->then()\n#28 /var/www/kwalityuniform/vendor/laravel/framework/src/Illuminate/Queue/CallQueuedHandler.php(84): Illuminate\\Queue\\CallQueuedHandler->dispatchThroughMiddleware()\n#29 /var/www/kwalityuniform/vendor/laravel/framework/src/Illuminate/Queue/Jobs/Job.php(102): Illuminate\\Queue\\CallQueuedHandler->call()\n#30 /var/www/kwalityuniform/vendor/laravel/framework/src/Illuminate/Queue/Worker.php(553): Illuminate\\Queue\\Jobs\\Job->fire()\n#31 /var/www/kwalityuniform/vendor/laravel/framework/src/Illuminate/Queue/Worker.php(499): Illuminate\\Queue\\Worker->process()\n#32 /var/www/kwalityuniform/vendor/laravel/framework/src/Illuminate/Queue/Worker.php(245): Illuminate\\Queue\\Worker->runJob()\n#33 /var/www/kwalityuniform/vendor/laravel/framework/src/Illuminate/Queue/Console/WorkCommand.php(149): Illuminate\\Queue\\Worker->daemon()\n#34 /var/www/kwalityuniform/vendor/laravel/framework/src/Illuminate/Queue/Console/WorkCommand.php(132): Illuminate\\Queue\\Console\\WorkCommand->runWorker()\n#35 /var/www/kwalityuniform/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(36): Illuminate\\Queue\\Console\\WorkCommand->handle()\n#36 /var/www/kwalityuniform/vendor/laravel/framework/src/Illuminate/Container/Util.php(43): Illuminate\\Container\\BoundMethod::{closure:Illuminate\\Container\\BoundMethod::call():35}()\n#37 /var/www/kwalityuniform/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(96): Illuminate\\Container\\Util::unwrapIfClosure()\n#38 /var/www/kwalityuniform/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(35): Illuminate\\Container\\BoundMethod::callBoundMethod()\n#39 /var/www/kwalityuniform/vendor/laravel/framework/src/Illuminate/Container/Container.php(799): Illuminate\\Container\\BoundMethod::call()\n#40 /var/www/kwalityuniform/vendor/laravel/framework/src/Illuminate/Console/Command.php(280): Illuminate\\Container\\Container->call()\n#41 /var/www/kwalityuniform/vendor/symfony/console/Command/Command.php(284): Illuminate\\Console\\Command->execute()\n#42 /var/www/kwalityuniform/vendor/laravel/framework/src/Illuminate/Console/Command.php(249): Symfony\\Component\\Console\\Command\\Command->run()\n#43 /var/www/kwalityuniform/vendor/symfony/console/Application.php(1144): Illuminate\\Console\\Command->run()\n#44 /var/www/kwalityuniform/vendor/symfony/console/Application.php(379): Symfony\\Component\\Console\\Application->doRunCommand()\n#45 /var/www/kwalityuniform/vendor/symfony/console/Application.php(218): Symfony\\Component\\Console\\Application->doRun()\n#46 /var/www/kwalityuniform/vendor/laravel/framework/src/Illuminate/Foundation/Console/Kernel.php(198): Symfony\\Component\\Console\\Application->run()\n#47 /var/www/kwalityuniform/vendor/laravel/framework/src/Illuminate/Foundation/Application.php(1235): Illuminate\\Foundation\\Console\\Kernel->handle()\n#48 /var/www/kwalityuniform/artisan(16): Illuminate\\Foundation\\Application->handleCommand()\n#49 {main}', '2026-07-11 19:34:59'),
(9, 'becc4c50-84f1-4cc0-a0f1-f925009d66b2', 'database', 'default', '{\"uuid\":\"becc4c50-84f1-4cc0-a0f1-f925009d66b2\",\"displayName\":\"App\\\\Notifications\\\\SystemNotification\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"deleteWhenMissingModels\":false,\"data\":{\"commandName\":\"Illuminate\\\\Notifications\\\\SendQueuedNotifications\",\"command\":\"O:48:\\\"Illuminate\\\\Notifications\\\\SendQueuedNotifications\\\":3:{s:11:\\\"notifiables\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:15:\\\"App\\\\Models\\\\User\\\";s:2:\\\"id\\\";a:1:{i:0;i:1;}s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}s:12:\\\"notification\\\";O:36:\\\"App\\\\Notifications\\\\SystemNotification\\\":3:{s:7:\\\"\\u0000*\\u0000data\\\";a:6:{s:3:\\\"key\\\";s:16:\\\"product_approved\\\";s:5:\\\"title\\\";s:16:\\\"Product Approved\\\";s:7:\\\"message\\\";s:98:\\\"Congratulations! Your product \\\"Demo Product\\\" has been approved and is now available for customers.\\\";s:4:\\\"type\\\";s:7:\\\"success\\\";s:3:\\\"url\\\";s:39:\\\"http:\\/\\/uniform.eschoolkart.com\\/products\\\";s:10:\\\"created_at\\\";O:25:\\\"Illuminate\\\\Support\\\\Carbon\\\":3:{s:4:\\\"date\\\";s:26:\\\"2026-07-11 19:37:31.481890\\\";s:13:\\\"timezone_type\\\";i:3;s:8:\\\"timezone\\\";s:3:\\\"UTC\\\";}}s:11:\\\"\\u0000*\\u0000channels\\\";a:3:{i:0;s:8:\\\"database\\\";i:1;s:9:\\\"broadcast\\\";i:2;s:4:\\\"mail\\\";}s:2:\\\"id\\\";s:36:\\\"81194c40-60be-4e8a-823c-a9b586961914\\\";}s:8:\\\"channels\\\";a:1:{i:0;s:4:\\\"mail\\\";}}\",\"batchId\":null},\"createdAt\":1783798651,\"delay\":null}', 'Symfony\\Component\\Mailer\\Exception\\UnexpectedResponseException: Expected response code \"250\" but got code \"550\", with message \"550 mailbox unavailable\". in /var/www/kwalityuniform/vendor/symfony/mailer/Transport/Smtp/SmtpTransport.php:331\nStack trace:\n#0 /var/www/kwalityuniform/vendor/symfony/mailer/Transport/Smtp/SmtpTransport.php(187): Symfony\\Component\\Mailer\\Transport\\Smtp\\SmtpTransport->assertResponseCode()\n#1 /var/www/kwalityuniform/vendor/symfony/mailer/Transport/Smtp/EsmtpTransport.php(150): Symfony\\Component\\Mailer\\Transport\\Smtp\\SmtpTransport->executeCommand()\n#2 /var/www/kwalityuniform/vendor/symfony/mailer/Transport/Smtp/SmtpTransport.php(252): Symfony\\Component\\Mailer\\Transport\\Smtp\\EsmtpTransport->executeCommand()\n#3 /var/www/kwalityuniform/vendor/symfony/mailer/Transport/Smtp/SmtpTransport.php(204): Symfony\\Component\\Mailer\\Transport\\Smtp\\SmtpTransport->doMailFromCommand()\n#4 /var/www/kwalityuniform/vendor/symfony/mailer/Transport/AbstractTransport.php(69): Symfony\\Component\\Mailer\\Transport\\Smtp\\SmtpTransport->doSend()\n#5 /var/www/kwalityuniform/vendor/symfony/mailer/Transport/Smtp/SmtpTransport.php(138): Symfony\\Component\\Mailer\\Transport\\AbstractTransport->send()\n#6 /var/www/kwalityuniform/vendor/laravel/framework/src/Illuminate/Mail/Mailer.php(584): Symfony\\Component\\Mailer\\Transport\\Smtp\\SmtpTransport->send()\n#7 /var/www/kwalityuniform/vendor/laravel/framework/src/Illuminate/Mail/Mailer.php(331): Illuminate\\Mail\\Mailer->sendSymfonyMessage()\n#8 /var/www/kwalityuniform/vendor/laravel/framework/src/Illuminate/Notifications/Channels/MailChannel.php(66): Illuminate\\Mail\\Mailer->send()\n#9 /var/www/kwalityuniform/vendor/laravel/framework/src/Illuminate/Notifications/NotificationSender.php(165): Illuminate\\Notifications\\Channels\\MailChannel->send()\n#10 /var/www/kwalityuniform/vendor/laravel/framework/src/Illuminate/Notifications/NotificationSender.php(120): Illuminate\\Notifications\\NotificationSender->sendToNotifiable()\n#11 /var/www/kwalityuniform/vendor/laravel/framework/src/Illuminate/Support/Traits/Localizable.php(19): Illuminate\\Notifications\\NotificationSender->{closure:Illuminate\\Notifications\\NotificationSender::sendNow():115}()\n#12 /var/www/kwalityuniform/vendor/laravel/framework/src/Illuminate/Notifications/NotificationSender.php(115): Illuminate\\Notifications\\NotificationSender->withLocale()\n#13 /var/www/kwalityuniform/vendor/laravel/framework/src/Illuminate/Notifications/ChannelManager.php(61): Illuminate\\Notifications\\NotificationSender->sendNow()\n#14 /var/www/kwalityuniform/vendor/laravel/framework/src/Illuminate/Notifications/SendQueuedNotifications.php(130): Illuminate\\Notifications\\ChannelManager->sendNow()\n#15 /var/www/kwalityuniform/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(36): Illuminate\\Notifications\\SendQueuedNotifications->handle()\n#16 /var/www/kwalityuniform/vendor/laravel/framework/src/Illuminate/Container/Util.php(43): Illuminate\\Container\\BoundMethod::{closure:Illuminate\\Container\\BoundMethod::call():35}()\n#17 /var/www/kwalityuniform/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(96): Illuminate\\Container\\Util::unwrapIfClosure()\n#18 /var/www/kwalityuniform/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(35): Illuminate\\Container\\BoundMethod::callBoundMethod()\n#19 /var/www/kwalityuniform/vendor/laravel/framework/src/Illuminate/Container/Container.php(799): Illuminate\\Container\\BoundMethod::call()\n#20 /var/www/kwalityuniform/vendor/laravel/framework/src/Illuminate/Bus/Dispatcher.php(136): Illuminate\\Container\\Container->call()\n#21 /var/www/kwalityuniform/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php(180): Illuminate\\Bus\\Dispatcher->{closure:Illuminate\\Bus\\Dispatcher::dispatchNow():133}()\n#22 /var/www/kwalityuniform/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php(137): Illuminate\\Pipeline\\Pipeline->{closure:Illuminate\\Pipeline\\Pipeline::prepareDestination():178}()\n#23 /var/www/kwalityuniform/vendor/laravel/framework/src/Illuminate/Bus/Dispatcher.php(140): Illuminate\\Pipeline\\Pipeline->then()\n#24 /var/www/kwalityuniform/vendor/laravel/framework/src/Illuminate/Queue/CallQueuedHandler.php(153): Illuminate\\Bus\\Dispatcher->dispatchNow()\n#25 /var/www/kwalityuniform/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php(180): Illuminate\\Queue\\CallQueuedHandler->{closure:Illuminate\\Queue\\CallQueuedHandler::dispatchThroughMiddleware():146}()\n#26 /var/www/kwalityuniform/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php(137): Illuminate\\Pipeline\\Pipeline->{closure:Illuminate\\Pipeline\\Pipeline::prepareDestination():178}()\n#27 /var/www/kwalityuniform/vendor/laravel/framework/src/Illuminate/Queue/CallQueuedHandler.php(146): Illuminate\\Pipeline\\Pipeline->then()\n#28 /var/www/kwalityuniform/vendor/laravel/framework/src/Illuminate/Queue/CallQueuedHandler.php(84): Illuminate\\Queue\\CallQueuedHandler->dispatchThroughMiddleware()\n#29 /var/www/kwalityuniform/vendor/laravel/framework/src/Illuminate/Queue/Jobs/Job.php(102): Illuminate\\Queue\\CallQueuedHandler->call()\n#30 /var/www/kwalityuniform/vendor/laravel/framework/src/Illuminate/Queue/Worker.php(553): Illuminate\\Queue\\Jobs\\Job->fire()\n#31 /var/www/kwalityuniform/vendor/laravel/framework/src/Illuminate/Queue/Worker.php(499): Illuminate\\Queue\\Worker->process()\n#32 /var/www/kwalityuniform/vendor/laravel/framework/src/Illuminate/Queue/Worker.php(245): Illuminate\\Queue\\Worker->runJob()\n#33 /var/www/kwalityuniform/vendor/laravel/framework/src/Illuminate/Queue/Console/WorkCommand.php(149): Illuminate\\Queue\\Worker->daemon()\n#34 /var/www/kwalityuniform/vendor/laravel/framework/src/Illuminate/Queue/Console/WorkCommand.php(132): Illuminate\\Queue\\Console\\WorkCommand->runWorker()\n#35 /var/www/kwalityuniform/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(36): Illuminate\\Queue\\Console\\WorkCommand->handle()\n#36 /var/www/kwalityuniform/vendor/laravel/framework/src/Illuminate/Container/Util.php(43): Illuminate\\Container\\BoundMethod::{closure:Illuminate\\Container\\BoundMethod::call():35}()\n#37 /var/www/kwalityuniform/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(96): Illuminate\\Container\\Util::unwrapIfClosure()\n#38 /var/www/kwalityuniform/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(35): Illuminate\\Container\\BoundMethod::callBoundMethod()\n#39 /var/www/kwalityuniform/vendor/laravel/framework/src/Illuminate/Container/Container.php(799): Illuminate\\Container\\BoundMethod::call()\n#40 /var/www/kwalityuniform/vendor/laravel/framework/src/Illuminate/Console/Command.php(280): Illuminate\\Container\\Container->call()\n#41 /var/www/kwalityuniform/vendor/symfony/console/Command/Command.php(284): Illuminate\\Console\\Command->execute()\n#42 /var/www/kwalityuniform/vendor/laravel/framework/src/Illuminate/Console/Command.php(249): Symfony\\Component\\Console\\Command\\Command->run()\n#43 /var/www/kwalityuniform/vendor/symfony/console/Application.php(1144): Illuminate\\Console\\Command->run()\n#44 /var/www/kwalityuniform/vendor/symfony/console/Application.php(379): Symfony\\Component\\Console\\Application->doRunCommand()\n#45 /var/www/kwalityuniform/vendor/symfony/console/Application.php(218): Symfony\\Component\\Console\\Application->doRun()\n#46 /var/www/kwalityuniform/vendor/laravel/framework/src/Illuminate/Foundation/Console/Kernel.php(198): Symfony\\Component\\Console\\Application->run()\n#47 /var/www/kwalityuniform/vendor/laravel/framework/src/Illuminate/Foundation/Application.php(1235): Illuminate\\Foundation\\Console\\Kernel->handle()\n#48 /var/www/kwalityuniform/artisan(16): Illuminate\\Foundation\\Application->handleCommand()\n#49 {main}', '2026-07-11 19:37:34'),
(10, '32cad9b4-c42c-4fa0-95c5-67043acf2619', 'database', 'default', '{\"uuid\":\"32cad9b4-c42c-4fa0-95c5-67043acf2619\",\"displayName\":\"App\\\\Notifications\\\\SystemNotification\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"deleteWhenMissingModels\":false,\"data\":{\"commandName\":\"Illuminate\\\\Notifications\\\\SendQueuedNotifications\",\"command\":\"O:48:\\\"Illuminate\\\\Notifications\\\\SendQueuedNotifications\\\":3:{s:11:\\\"notifiables\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:15:\\\"App\\\\Models\\\\User\\\";s:2:\\\"id\\\";a:1:{i:0;i:1;}s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}s:12:\\\"notification\\\";O:36:\\\"App\\\\Notifications\\\\SystemNotification\\\":3:{s:7:\\\"\\u0000*\\u0000data\\\";a:6:{s:3:\\\"key\\\";s:16:\\\"product_approved\\\";s:5:\\\"title\\\";s:16:\\\"Product Approved\\\";s:7:\\\"message\\\";s:98:\\\"Congratulations! Your product \\\"Demo Product\\\" has been approved and is now available for customers.\\\";s:4:\\\"type\\\";s:7:\\\"success\\\";s:3:\\\"url\\\";s:39:\\\"http:\\/\\/uniform.eschoolkart.com\\/products\\\";s:10:\\\"created_at\\\";O:25:\\\"Illuminate\\\\Support\\\\Carbon\\\":3:{s:4:\\\"date\\\";s:26:\\\"2026-07-11 19:37:42.525566\\\";s:13:\\\"timezone_type\\\";i:3;s:8:\\\"timezone\\\";s:3:\\\"UTC\\\";}}s:11:\\\"\\u0000*\\u0000channels\\\";a:3:{i:0;s:8:\\\"database\\\";i:1;s:9:\\\"broadcast\\\";i:2;s:4:\\\"mail\\\";}s:2:\\\"id\\\";s:36:\\\"eaab1078-6eac-4114-8bc4-e5f0035f5aed\\\";}s:8:\\\"channels\\\";a:1:{i:0;s:4:\\\"mail\\\";}}\",\"batchId\":null},\"createdAt\":1783798662,\"delay\":null}', 'Symfony\\Component\\Mailer\\Exception\\UnexpectedResponseException: Expected response code \"250\" but got code \"550\", with message \"550 mailbox unavailable\". in /var/www/kwalityuniform/vendor/symfony/mailer/Transport/Smtp/SmtpTransport.php:331\nStack trace:\n#0 /var/www/kwalityuniform/vendor/symfony/mailer/Transport/Smtp/SmtpTransport.php(187): Symfony\\Component\\Mailer\\Transport\\Smtp\\SmtpTransport->assertResponseCode()\n#1 /var/www/kwalityuniform/vendor/symfony/mailer/Transport/Smtp/EsmtpTransport.php(150): Symfony\\Component\\Mailer\\Transport\\Smtp\\SmtpTransport->executeCommand()\n#2 /var/www/kwalityuniform/vendor/symfony/mailer/Transport/Smtp/SmtpTransport.php(252): Symfony\\Component\\Mailer\\Transport\\Smtp\\EsmtpTransport->executeCommand()\n#3 /var/www/kwalityuniform/vendor/symfony/mailer/Transport/Smtp/SmtpTransport.php(204): Symfony\\Component\\Mailer\\Transport\\Smtp\\SmtpTransport->doMailFromCommand()\n#4 /var/www/kwalityuniform/vendor/symfony/mailer/Transport/AbstractTransport.php(69): Symfony\\Component\\Mailer\\Transport\\Smtp\\SmtpTransport->doSend()\n#5 /var/www/kwalityuniform/vendor/symfony/mailer/Transport/Smtp/SmtpTransport.php(138): Symfony\\Component\\Mailer\\Transport\\AbstractTransport->send()\n#6 /var/www/kwalityuniform/vendor/laravel/framework/src/Illuminate/Mail/Mailer.php(584): Symfony\\Component\\Mailer\\Transport\\Smtp\\SmtpTransport->send()\n#7 /var/www/kwalityuniform/vendor/laravel/framework/src/Illuminate/Mail/Mailer.php(331): Illuminate\\Mail\\Mailer->sendSymfonyMessage()\n#8 /var/www/kwalityuniform/vendor/laravel/framework/src/Illuminate/Notifications/Channels/MailChannel.php(66): Illuminate\\Mail\\Mailer->send()\n#9 /var/www/kwalityuniform/vendor/laravel/framework/src/Illuminate/Notifications/NotificationSender.php(165): Illuminate\\Notifications\\Channels\\MailChannel->send()\n#10 /var/www/kwalityuniform/vendor/laravel/framework/src/Illuminate/Notifications/NotificationSender.php(120): Illuminate\\Notifications\\NotificationSender->sendToNotifiable()\n#11 /var/www/kwalityuniform/vendor/laravel/framework/src/Illuminate/Support/Traits/Localizable.php(19): Illuminate\\Notifications\\NotificationSender->{closure:Illuminate\\Notifications\\NotificationSender::sendNow():115}()\n#12 /var/www/kwalityuniform/vendor/laravel/framework/src/Illuminate/Notifications/NotificationSender.php(115): Illuminate\\Notifications\\NotificationSender->withLocale()\n#13 /var/www/kwalityuniform/vendor/laravel/framework/src/Illuminate/Notifications/ChannelManager.php(61): Illuminate\\Notifications\\NotificationSender->sendNow()\n#14 /var/www/kwalityuniform/vendor/laravel/framework/src/Illuminate/Notifications/SendQueuedNotifications.php(130): Illuminate\\Notifications\\ChannelManager->sendNow()\n#15 /var/www/kwalityuniform/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(36): Illuminate\\Notifications\\SendQueuedNotifications->handle()\n#16 /var/www/kwalityuniform/vendor/laravel/framework/src/Illuminate/Container/Util.php(43): Illuminate\\Container\\BoundMethod::{closure:Illuminate\\Container\\BoundMethod::call():35}()\n#17 /var/www/kwalityuniform/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(96): Illuminate\\Container\\Util::unwrapIfClosure()\n#18 /var/www/kwalityuniform/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(35): Illuminate\\Container\\BoundMethod::callBoundMethod()\n#19 /var/www/kwalityuniform/vendor/laravel/framework/src/Illuminate/Container/Container.php(799): Illuminate\\Container\\BoundMethod::call()\n#20 /var/www/kwalityuniform/vendor/laravel/framework/src/Illuminate/Bus/Dispatcher.php(136): Illuminate\\Container\\Container->call()\n#21 /var/www/kwalityuniform/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php(180): Illuminate\\Bus\\Dispatcher->{closure:Illuminate\\Bus\\Dispatcher::dispatchNow():133}()\n#22 /var/www/kwalityuniform/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php(137): Illuminate\\Pipeline\\Pipeline->{closure:Illuminate\\Pipeline\\Pipeline::prepareDestination():178}()\n#23 /var/www/kwalityuniform/vendor/laravel/framework/src/Illuminate/Bus/Dispatcher.php(140): Illuminate\\Pipeline\\Pipeline->then()\n#24 /var/www/kwalityuniform/vendor/laravel/framework/src/Illuminate/Queue/CallQueuedHandler.php(153): Illuminate\\Bus\\Dispatcher->dispatchNow()\n#25 /var/www/kwalityuniform/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php(180): Illuminate\\Queue\\CallQueuedHandler->{closure:Illuminate\\Queue\\CallQueuedHandler::dispatchThroughMiddleware():146}()\n#26 /var/www/kwalityuniform/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php(137): Illuminate\\Pipeline\\Pipeline->{closure:Illuminate\\Pipeline\\Pipeline::prepareDestination():178}()\n#27 /var/www/kwalityuniform/vendor/laravel/framework/src/Illuminate/Queue/CallQueuedHandler.php(146): Illuminate\\Pipeline\\Pipeline->then()\n#28 /var/www/kwalityuniform/vendor/laravel/framework/src/Illuminate/Queue/CallQueuedHandler.php(84): Illuminate\\Queue\\CallQueuedHandler->dispatchThroughMiddleware()\n#29 /var/www/kwalityuniform/vendor/laravel/framework/src/Illuminate/Queue/Jobs/Job.php(102): Illuminate\\Queue\\CallQueuedHandler->call()\n#30 /var/www/kwalityuniform/vendor/laravel/framework/src/Illuminate/Queue/Worker.php(553): Illuminate\\Queue\\Jobs\\Job->fire()\n#31 /var/www/kwalityuniform/vendor/laravel/framework/src/Illuminate/Queue/Worker.php(499): Illuminate\\Queue\\Worker->process()\n#32 /var/www/kwalityuniform/vendor/laravel/framework/src/Illuminate/Queue/Worker.php(245): Illuminate\\Queue\\Worker->runJob()\n#33 /var/www/kwalityuniform/vendor/laravel/framework/src/Illuminate/Queue/Console/WorkCommand.php(149): Illuminate\\Queue\\Worker->daemon()\n#34 /var/www/kwalityuniform/vendor/laravel/framework/src/Illuminate/Queue/Console/WorkCommand.php(132): Illuminate\\Queue\\Console\\WorkCommand->runWorker()\n#35 /var/www/kwalityuniform/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(36): Illuminate\\Queue\\Console\\WorkCommand->handle()\n#36 /var/www/kwalityuniform/vendor/laravel/framework/src/Illuminate/Container/Util.php(43): Illuminate\\Container\\BoundMethod::{closure:Illuminate\\Container\\BoundMethod::call():35}()\n#37 /var/www/kwalityuniform/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(96): Illuminate\\Container\\Util::unwrapIfClosure()\n#38 /var/www/kwalityuniform/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(35): Illuminate\\Container\\BoundMethod::callBoundMethod()\n#39 /var/www/kwalityuniform/vendor/laravel/framework/src/Illuminate/Container/Container.php(799): Illuminate\\Container\\BoundMethod::call()\n#40 /var/www/kwalityuniform/vendor/laravel/framework/src/Illuminate/Console/Command.php(280): Illuminate\\Container\\Container->call()\n#41 /var/www/kwalityuniform/vendor/symfony/console/Command/Command.php(284): Illuminate\\Console\\Command->execute()\n#42 /var/www/kwalityuniform/vendor/laravel/framework/src/Illuminate/Console/Command.php(249): Symfony\\Component\\Console\\Command\\Command->run()\n#43 /var/www/kwalityuniform/vendor/symfony/console/Application.php(1144): Illuminate\\Console\\Command->run()\n#44 /var/www/kwalityuniform/vendor/symfony/console/Application.php(379): Symfony\\Component\\Console\\Application->doRunCommand()\n#45 /var/www/kwalityuniform/vendor/symfony/console/Application.php(218): Symfony\\Component\\Console\\Application->doRun()\n#46 /var/www/kwalityuniform/vendor/laravel/framework/src/Illuminate/Foundation/Console/Kernel.php(198): Symfony\\Component\\Console\\Application->run()\n#47 /var/www/kwalityuniform/vendor/laravel/framework/src/Illuminate/Foundation/Application.php(1235): Illuminate\\Foundation\\Console\\Kernel->handle()\n#48 /var/www/kwalityuniform/artisan(16): Illuminate\\Foundation\\Application->handleCommand()\n#49 {main}', '2026-07-11 19:37:44');

-- --------------------------------------------------------

--
-- Table structure for table `files`
--

CREATE TABLE `files` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `file_name` varchar(255) NOT NULL,
  `file_path` varchar(255) NOT NULL,
  `disk` varchar(255) NOT NULL DEFAULT 'public',
  `mime_type` varchar(255) DEFAULT NULL,
  `file_size` bigint(20) UNSIGNED DEFAULT NULL,
  `extension` varchar(20) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `global_settings`
--

CREATE TABLE `global_settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `key` varchar(255) NOT NULL,
  `value` text DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `global_settings`
--

INSERT INTO `global_settings` (`id`, `key`, `value`, `description`, `created_at`, `updated_at`) VALUES
(1, 'auto_increment_sku', '1', NULL, '2026-07-13 17:05:50', '2026-07-13 17:05:50'),
(2, 'sku_prefix', 'PROD-', NULL, '2026-07-13 17:05:50', '2026-07-13 17:05:50');

-- --------------------------------------------------------

--
-- Table structure for table `invoices`
--

CREATE TABLE `invoices` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_id` bigint(20) UNSIGNED NOT NULL,
  `invoice_number` varchar(255) NOT NULL,
  `invoice_file` varchar(255) DEFAULT NULL,
  `generated_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` smallint(5) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `mail_settings`
--

CREATE TABLE `mail_settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `mail_mailer` varchar(255) NOT NULL DEFAULT 'smtp',
  `mail_host` varchar(255) NOT NULL,
  `mail_port` varchar(255) NOT NULL,
  `mail_username` varchar(255) NOT NULL,
  `mail_password` text NOT NULL,
  `mail_encryption` varchar(255) DEFAULT NULL,
  `mail_from_address` varchar(255) NOT NULL,
  `mail_from_name` varchar(255) NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
(40, '2026_06_28_060000_create_school_standards_table', 1),
(41, '2026_06_28_060100_create_school_classes_table', 1),
(42, '2026_06_28_065942_create_school_product_class_approvals_table', 1),
(43, '2026_06_28_072243_create_school_sections_table', 1),
(44, '2026_06_28_072304_create_product_assignments_table', 1),
(45, '2026_06_28_130506_create_school_types_table', 1),
(46, '2026_06_28_130907_add_school_type_id_to_schools_table', 1),
(47, '2026_06_28_145159_add_board_to_schools_table', 1),
(48, '2026_06_28_150016_create_school_boards_table', 1),
(49, '2026_06_28_150115_add_school_board_id_to_schools_table', 1),
(50, '2026_06_28_180253_add_image_id_to_users_vendors_schools_tables', 1),
(51, '2026_07_01_000000_create_delivery_system_tables', 1),
(52, '2026_07_03_183652_seed_partnership_email_templates', 1),
(53, '2026_07_03_183922_create_school_partnership_requests_table', 1),
(54, '2026_07_03_183952_create_vendor_partnership_requests_table', 1),
(55, '2026_07_03_184657_add_document_to_partnership_requests', 1),
(56, '2026_07_04_192601_add_details_to_partnership_requests_table', 1),
(57, '2026_07_05_063451_create_carts_table', 1),
(58, '2026_07_05_063459_create_cart_items_table', 1),
(59, '2026_07_05_063515_create_wishlists_table', 1),
(60, '2026_07_05_063524_create_wishlist_items_table', 1),
(61, '2026_07_05_063534_create_orders_table', 1),
(62, '2026_07_05_063542_create_order_items_table', 1),
(63, '2026_07_05_063551_create_order_addresses_table', 1),
(64, '2026_07_05_063600_create_order_status_histories_table', 1),
(65, '2026_07_05_063609_create_payments_table', 1),
(66, '2026_07_05_063627_create_shipment_tracking_histories_table', 1),
(67, '2026_07_05_063636_create_coupons_table', 1),
(68, '2026_07_05_063643_create_coupon_usages_table', 1),
(69, '2026_07_05_063654_create_return_policies_table', 1),
(70, '2026_07_05_063703_create_return_reasons_table', 1),
(71, '2026_07_05_063710_create_returns_table', 1),
(72, '2026_07_05_063718_create_return_items_table', 1),
(73, '2026_07_05_063726_create_return_item_images_table', 1),
(74, '2026_07_05_063734_create_refunds_table', 1),
(75, '2026_07_05_063747_create_store_credits_table', 1),
(76, '2026_07_05_063755_create_return_shipments_table', 1),
(77, '2026_07_05_063804_create_product_reviews_table', 1),
(78, '2026_07_05_063812_create_order_notes_table', 1),
(79, '2026_07_05_063820_create_invoices_table', 1),
(80, '2026_07_06_000000_add_role_category_and_parent_to_permissions_table', 1),
(81, '2026_07_06_000001_add_role_category_to_roles_table', 1),
(82, '2026_07_06_000002_seed_permission_role_categories', 1),
(83, '2026_07_06_192355_create_school_product_standard_approvals_table', 1),
(84, '2026_07_07_164637_create_delivery_system_tables', 1),
(85, '2026_07_07_164922_add_delivery_fields_to_orders_table', 1),
(86, '2026_07_07_172202_make_user_id_nullable_in_carts_table', 1),
(87, '2026_07_09_164458_create_user_recently_viewed_table', 1),
(88, '2026_07_10_200505_create_contact_messages_table', 1),
(89, '2026_07_11_165421_create_order_product_snapshots_table', 2),
(90, '2026_07_11_175825_add_vendor_id_to_shipments_table', 2);

-- --------------------------------------------------------

--
-- Table structure for table `model_has_permissions`
--

CREATE TABLE `model_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `model_has_roles`
--

CREATE TABLE `model_has_roles` (
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `model_has_roles`
--

INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
(1, 'App\\Models\\User', 1),
(4, 'App\\Models\\User', 4),
(4, 'App\\Models\\User', 5),
(4, 'App\\Models\\User', 8),
(4, 'App\\Models\\User', 13),
(5, 'App\\Models\\User', 2),
(5, 'App\\Models\\User', 3);

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` char(36) NOT NULL,
  `type` varchar(255) NOT NULL,
  `notifiable_type` varchar(255) NOT NULL,
  `notifiable_id` bigint(20) UNSIGNED NOT NULL,
  `data` text NOT NULL,
  `read_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`id`, `type`, `notifiable_type`, `notifiable_id`, `data`, `read_at`, `created_at`, `updated_at`) VALUES
('03ea9b35-4190-43ba-8f9f-f1a10e22898b', 'App\\Notifications\\ProductStatusUpdatedNotification', 'App\\Models\\User', 5, '{\"product_id\":\"87b20b5f-4515-4904-b065-0480b9c088b9\",\"product_name\":\"MHPS SENIOR SHIRTS\",\"status\":\"pending\",\"message\":\"Your product MHPS SENIOR SHIRTS has been pending\",\"url\":\"http:\\/\\/uniform.eschoolkart.com\\/eschoolkart\\/products\"}', NULL, '2026-07-13 17:36:25', '2026-07-13 17:36:25'),
('354dd5e9-b806-4871-b873-55a77c9f901f', 'App\\Notifications\\SystemNotification', 'App\\Models\\User', 1, '{\"key\":\"product_approval_request\",\"title\":\"New Product Awaiting Approval\",\"message\":\"A new product \\\"MHPS SENIOR SHIRTS\\\" has been submitted by TEST1 and is awaiting approval.\",\"type\":\"info\",\"url\":\"http:\\/\\/uniform.eschoolkart.com\\/eschoolkart\\/products\\/show\\/87b20b5f-4515-4904-b065-0480b9c088b9\",\"created_at\":\"2026-07-13T16:53:39.482756Z\"}', NULL, '2026-07-13 16:53:43', '2026-07-13 16:53:43'),
('445f8288-647c-4f28-b81a-a2554445d9e9', 'App\\Notifications\\ProductStatusUpdatedNotification', 'App\\Models\\User', 5, '{\"product_id\":\"87b20b5f-4515-4904-b065-0480b9c088b9\",\"product_name\":\"MHPS SENIOR SHIRTS\",\"status\":\"approved\",\"message\":\"Your product MHPS SENIOR SHIRTS has been approved\",\"url\":\"http:\\/\\/uniform.eschoolkart.com\\/eschoolkart\\/products\"}', NULL, '2026-07-13 17:31:38', '2026-07-13 17:31:38'),
('4b7d80e8-8e05-4a08-8f6e-4ae55af75ec6', 'App\\Notifications\\SystemNotification', 'App\\Models\\User', 1, '{\"key\":\"product_approved\",\"title\":\"Product Approved\",\"message\":\"Congratulations! Your product \\\"Demo Product\\\" has been approved and is now available for customers.\",\"type\":\"success\",\"url\":\"http:\\/\\/uniform.eschoolkart.com\\/products\",\"created_at\":\"2026-07-11T19:28:49.826552Z\"}', NULL, '2026-07-11 19:32:39', '2026-07-11 19:32:39'),
('81194c40-60be-4e8a-823c-a9b586961914', 'App\\Notifications\\SystemNotification', 'App\\Models\\User', 1, '{\"key\":\"product_approved\",\"title\":\"Product Approved\",\"message\":\"Congratulations! Your product \\\"Demo Product\\\" has been approved and is now available for customers.\",\"type\":\"success\",\"url\":\"http:\\/\\/uniform.eschoolkart.com\\/products\",\"created_at\":\"2026-07-11T19:37:31.481890Z\"}', NULL, '2026-07-11 19:37:33', '2026-07-11 19:37:33'),
('94867739-01a4-4ef5-8316-1e3c08876171', 'App\\Notifications\\SystemNotification', 'App\\Models\\User', 1, '{\"key\":\"product_approved\",\"title\":\"Product Approved\",\"message\":\"Congratulations! Your product \\\"Demo Product\\\" has been approved and is now available for customers.\",\"type\":\"success\",\"url\":\"http:\\/\\/uniform.eschoolkart.com\\/products\",\"created_at\":\"2026-07-11T19:23:24.763002Z\"}', NULL, '2026-07-11 19:32:35', '2026-07-11 19:32:35'),
('9b1c574e-6212-4c9f-a5ce-c11f5e91b8ea', 'App\\Notifications\\SystemNotification', 'App\\Models\\User', 1, '{\"key\":\"product_approved\",\"title\":\"Product Approved\",\"message\":\"Congratulations! Your product \\\"Demo Product\\\" has been approved and is now available for customers.\",\"type\":\"success\",\"url\":\"http:\\/\\/uniform.eschoolkart.com\\/products\",\"created_at\":\"2026-07-11T19:34:49.657336Z\"}', NULL, '2026-07-11 19:34:51', '2026-07-11 19:34:51'),
('9c6ecf2c-7acb-46dc-8987-4639d55a6fc5', 'App\\Notifications\\SystemNotification', 'App\\Models\\User', 1, '{\"key\":\"product_approved\",\"title\":\"Product Approved\",\"message\":\"Congratulations! Your product \\\"Demo Product\\\" has been approved and is now available for customers.\",\"type\":\"success\",\"url\":\"http:\\/\\/uniform.eschoolkart.com\\/products\",\"created_at\":\"2026-07-11T19:27:10.105038Z\"}', NULL, '2026-07-11 19:32:38', '2026-07-11 19:32:38'),
('9e468d8e-4103-4266-9e26-58c2b9074ac3', 'App\\Notifications\\SystemNotification', 'App\\Models\\User', 1, '{\"key\":\"product_approved\",\"title\":\"Product Approved\",\"message\":\"Congratulations! Your product \\\"Demo Product\\\" has been approved and is now available for customers.\",\"type\":\"success\",\"url\":\"http:\\/\\/uniform.eschoolkart.com\\/products\",\"created_at\":\"2026-07-11T19:27:54.817785Z\"}', NULL, '2026-07-11 19:32:38', '2026-07-11 19:32:38'),
('beca08d1-50cd-43a0-bd6f-2e8a715266bf', 'App\\Notifications\\SystemNotification', 'App\\Models\\User', 1, '{\"key\":\"product_approved\",\"title\":\"Product Approved\",\"message\":\"Congratulations! Your product \\\"Demo Product\\\" has been approved and is now available for customers.\",\"type\":\"success\",\"url\":\"http:\\/\\/uniform.eschoolkart.com\\/products\",\"created_at\":\"2026-07-11T19:24:14.051907Z\"}', NULL, '2026-07-11 19:32:37', '2026-07-11 19:32:37'),
('dcb87286-5864-40b7-8a7a-eea66cac9d97', 'App\\Notifications\\SystemNotification', 'App\\Models\\User', 1, '{\"key\":\"product_approved\",\"title\":\"Product Approved\",\"message\":\"Congratulations! Your product \\\"Demo Product\\\" has been approved and is now available for customers.\",\"type\":\"success\",\"url\":\"http:\\/\\/uniform.eschoolkart.com\\/products\",\"created_at\":\"2026-07-11T19:34:57.716085Z\"}', NULL, '2026-07-11 19:34:57', '2026-07-11 19:34:57'),
('e2e3cd86-f544-440c-bf37-6291e2dd26b5', 'App\\Notifications\\SystemNotification', 'App\\Models\\User', 1, '{\"key\":\"product_approved\",\"title\":\"Product Approved\",\"message\":\"Congratulations! Your product \\\"Demo Product\\\" has been approved and is now available for customers.\",\"type\":\"success\",\"url\":\"http:\\/\\/uniform.eschoolkart.com\\/products\",\"created_at\":\"2026-07-11T19:24:25.532368Z\"}', NULL, '2026-07-11 19:32:37', '2026-07-11 19:32:37'),
('eaab1078-6eac-4114-8bc4-e5f0035f5aed', 'App\\Notifications\\SystemNotification', 'App\\Models\\User', 1, '{\"key\":\"product_approved\",\"title\":\"Product Approved\",\"message\":\"Congratulations! Your product \\\"Demo Product\\\" has been approved and is now available for customers.\",\"type\":\"success\",\"url\":\"http:\\/\\/uniform.eschoolkart.com\\/products\",\"created_at\":\"2026-07-11T19:37:42.525566Z\"}', NULL, '2026-07-11 19:37:43', '2026-07-11 19:37:43'),
('f3623ac1-9313-495a-8b97-7bac6a35afe3', 'App\\Notifications\\ProductStatusUpdatedNotification', 'App\\Models\\User', 5, '{\"product_id\":\"87b20b5f-4515-4904-b065-0480b9c088b9\",\"product_name\":\"MHPS SENIOR SHIRTS\",\"status\":\"approved\",\"message\":\"Your product MHPS SENIOR SHIRTS has been approved\",\"url\":\"http:\\/\\/uniform.eschoolkart.com\\/eschoolkart\\/products\"}', NULL, '2026-07-13 17:36:43', '2026-07-13 17:36:43');

-- --------------------------------------------------------

--
-- Table structure for table `notification_templates`
--

CREATE TABLE `notification_templates` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `key` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `type` varchar(255) NOT NULL DEFAULT 'info',
  `icon` varchar(255) DEFAULT NULL,
  `channels` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`channels`)),
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_by` bigint(20) UNSIGNED DEFAULT NULL,
  `updated_by` bigint(20) UNSIGNED DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `notification_templates`
--

INSERT INTO `notification_templates` (`id`, `key`, `title`, `message`, `type`, `icon`, `channels`, `is_active`, `created_by`, `updated_by`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'product_approved', 'Product Approved', 'Congratulations! Your product \"{product_name}\" has been approved and is now available for customers.', 'success', 'ti-circle-check-filled', '\"[\\\"database\\\",\\\"broadcast\\\",\\\"mail\\\"]\"', 1, NULL, NULL, NULL, '2026-07-11 07:47:00', '2026-07-11 07:47:00'),
(2, 'product_rejected', 'Product Rejected', 'Your product \"{product_name}\" was rejected. Reason: {admin_message}', 'danger', 'ti-circle-x-filled', '\"[\\\"database\\\",\\\"broadcast\\\",\\\"mail\\\"]\"', 1, NULL, NULL, NULL, '2026-07-11 07:47:00', '2026-07-11 07:47:00'),
(3, 'product_status_updated', 'Product Status Updated', 'The status of your product \"{product_name}\" has been changed to {status}. {admin_message}', 'info', 'ti-refresh', '\"[\\\"database\\\",\\\"broadcast\\\",\\\"mail\\\"]\"', 1, NULL, NULL, NULL, '2026-07-11 07:47:00', '2026-07-11 07:47:00'),
(4, 'product_resubmitted', 'Product Resubmitted', 'Your product \"{product_name}\" has been resubmitted for approval.', 'warning', 'ti-refresh-alert', '\"[\\\"database\\\",\\\"broadcast\\\"]\"', 1, NULL, NULL, NULL, '2026-07-11 07:47:00', '2026-07-11 07:47:00'),
(5, 'product_approval_request', 'New Product Awaiting Approval', 'A new product \"{product_name}\" has been submitted by {vendor_name} and is awaiting approval.', 'info', 'ti-clock-hour-4', '\"[\\\"database\\\",\\\"broadcast\\\"]\"', 1, NULL, NULL, NULL, '2026-07-11 07:47:00', '2026-07-11 07:47:00'),
(6, 'low_stock', 'Low Stock Alert', 'Product \"{product_name}\" stock is below the minimum threshold.', 'warning', 'ti-alert-triangle', '\"[\\\"database\\\",\\\"broadcast\\\"]\"', 1, NULL, NULL, NULL, '2026-07-11 07:47:00', '2026-07-11 07:47:00'),
(7, 'out_of_stock', 'Out of Stock', 'Product \"{product_name}\" is currently out of stock.', 'danger', 'ti-package-off', '\"[\\\"database\\\",\\\"broadcast\\\",\\\"mail\\\"]\"', 1, NULL, NULL, NULL, '2026-07-11 07:47:00', '2026-07-11 07:47:00'),
(8, 'school_product_approved', 'School Product Approval', 'School \"{school_name}\" has approved product \"{product_name}\" (Code: {product_code}) for their official catalogue.', 'success', 'ti-school', '\"[\\\"database\\\",\\\"broadcast\\\",\\\"mail\\\"]\"', 1, NULL, NULL, NULL, '2026-07-11 07:47:00', '2026-07-11 07:47:00'),
(9, 'stock_replenished', 'Stock Replenished', 'Inventory has been replenished for \"{product_name}\".', 'success', 'ti-package', '\"[\\\"database\\\",\\\"broadcast\\\"]\"', 1, NULL, NULL, NULL, '2026-07-11 07:47:00', '2026-07-11 07:47:00');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_number` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `school_id` char(36) DEFAULT NULL,
  `vendor_id` char(36) DEFAULT NULL,
  `cart_id` char(36) DEFAULT NULL,
  `status` enum('pending','confirmed','processing','packed','shipped','delivered','cancelled','returned','refunded') NOT NULL DEFAULT 'pending',
  `delivery_type` varchar(255) NOT NULL DEFAULT 'school_delivery',
  `payment_status` enum('pending','paid','failed','refunded') NOT NULL DEFAULT 'pending',
  `subtotal` decimal(10,2) NOT NULL,
  `discount_amount` decimal(10,2) NOT NULL DEFAULT 0.00,
  `tax_amount` decimal(10,2) NOT NULL DEFAULT 0.00,
  `shipping_charge` decimal(10,2) NOT NULL DEFAULT 0.00,
  `grand_total` decimal(10,2) NOT NULL,
  `customer_note` text DEFAULT NULL,
  `placed_at` timestamp NULL DEFAULT NULL,
  `delivered_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `order_addresses`
--

CREATE TABLE `order_addresses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_id` bigint(20) UNSIGNED NOT NULL,
  `type` enum('billing','shipping') NOT NULL,
  `full_name` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `address_line1` varchar(255) NOT NULL,
  `address_line2` varchar(255) DEFAULT NULL,
  `city` varchar(255) NOT NULL,
  `state` varchar(255) NOT NULL,
  `postal_code` varchar(255) NOT NULL,
  `country` varchar(255) NOT NULL DEFAULT 'India',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` char(36) NOT NULL,
  `variant_id` char(36) DEFAULT NULL,
  `vendor_id` char(36) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `sku` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `unit_price` decimal(10,2) NOT NULL,
  `quantity` int(10) UNSIGNED NOT NULL,
  `discount_amount` decimal(10,2) NOT NULL DEFAULT 0.00,
  `tax_amount` decimal(10,2) NOT NULL DEFAULT 0.00,
  `line_total` decimal(10,2) NOT NULL,
  `returned_quantity` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `order_notes`
--

CREATE TABLE `order_notes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `type` enum('customer','vendor','admin','system') NOT NULL,
  `note` text NOT NULL,
  `is_visible_to_customer` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `order_product_snapshots`
--

CREATE TABLE `order_product_snapshots` (
  `snapshot_id` char(36) NOT NULL,
  `order_item_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` char(36) DEFAULT NULL,
  `vendor_id` char(36) NOT NULL,
  `category_name` varchar(255) DEFAULT NULL,
  `brand_name` varchar(255) DEFAULT NULL,
  `product_name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `sku` varchar(255) DEFAULT NULL,
  `gender` varchar(255) DEFAULT NULL,
  `material` varchar(255) DEFAULT NULL,
  `specifications` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`specifications`)),
  `selling_price` decimal(10,2) NOT NULL,
  `original_price` decimal(10,2) DEFAULT NULL,
  `discount_amount` decimal(10,2) NOT NULL DEFAULT 0.00,
  `tax_amount` decimal(10,2) NOT NULL DEFAULT 0.00,
  `size_name` varchar(255) DEFAULT NULL,
  `color_name` varchar(255) DEFAULT NULL,
  `variant_details` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`variant_details`)),
  `thumbnail_url` varchar(255) DEFAULT NULL,
  `image_urls` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`image_urls`)),
  `school_name` varchar(255) DEFAULT NULL,
  `delivery_info` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`delivery_info`)),
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `order_status_histories`
--

CREATE TABLE `order_status_histories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_id` bigint(20) UNSIGNED NOT NULL,
  `status` varchar(255) NOT NULL,
  `remarks` text DEFAULT NULL,
  `changed_by` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `parent_categories`
--

CREATE TABLE `parent_categories` (
  `parent_id` char(36) NOT NULL,
  `name` varchar(80) NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_by` bigint(20) UNSIGNED DEFAULT NULL,
  `updated_by` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `parent_categories`
--

INSERT INTO `parent_categories` (`parent_id`, `name`, `is_active`, `created_by`, `updated_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
('0d08216d-61bf-4565-b985-1818045603d3', 'Footwear', 1, 1, NULL, '2026-07-11 07:47:00', '2026-07-11 07:47:00', NULL),
('1fb11227-ea7a-45e1-a1ea-f818cfe03a90', 'Stationery', 1, 1, NULL, '2026-07-11 07:47:00', '2026-07-11 07:47:00', NULL),
('362db172-e371-4f72-b168-3a6ea0062a99', 'UNIFORMS', 1, 1, 1, '2026-07-13 17:04:26', '2026-07-13 17:04:26', NULL),
('66820cd2-97d5-4195-8340-996e09241925', 'Accessory', 1, 1, NULL, '2026-07-11 07:47:00', '2026-07-11 07:47:00', NULL),
('f9dc9a0a-03b1-41b7-8307-0aafffc0e70b', 'Uniform', 1, 1, NULL, '2026-07-11 07:47:00', '2026-07-11 07:47:00', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `payment_method` enum('razorpay','cod','upi','card','net_banking','wallet') NOT NULL,
  `status` enum('pending','processing','success','failed','cancelled','refunded','partially_refunded') NOT NULL DEFAULT 'pending',
  `amount` decimal(10,2) NOT NULL,
  `currency` varchar(5) NOT NULL DEFAULT 'INR',
  `transaction_id` varchar(255) DEFAULT NULL,
  `gateway_order_id` varchar(255) DEFAULT NULL,
  `gateway_payment_id` varchar(255) DEFAULT NULL,
  `gateway_signature` varchar(255) DEFAULT NULL,
  `gateway_response` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`gateway_response`)),
  `paid_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `permission_name` varchar(255) NOT NULL,
  `group_name` varchar(100) DEFAULT NULL,
  `role_category` varchar(255) DEFAULT NULL,
  `parent_id` bigint(20) UNSIGNED DEFAULT NULL,
  `guard_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `permission_name`, `group_name`, `role_category`, `parent_id`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'role.view', 'View Roles', 'User Management', 'admin', NULL, 'web', '2026-07-11 07:47:00', '2026-07-11 07:47:00'),
(2, 'role.create', 'Create Role', 'User Management', 'admin', 1, 'web', '2026-07-11 07:47:00', '2026-07-11 07:47:00'),
(3, 'role.edit', 'Edit Role', 'User Management', 'admin', 1, 'web', '2026-07-11 07:47:00', '2026-07-11 07:47:00'),
(4, 'role.delete', 'Delete Role', 'User Management', 'admin', 1, 'web', '2026-07-11 07:47:00', '2026-07-11 07:47:00'),
(5, 'admin.view', 'View Admins', 'User Management', 'admin', NULL, 'web', '2026-07-11 07:47:00', '2026-07-11 07:47:00'),
(6, 'admin.create', 'Create Admin', 'User Management', 'admin', 5, 'web', '2026-07-11 07:47:00', '2026-07-11 07:47:00'),
(7, 'admin.edit', 'Edit Admin', 'User Management', 'admin', 5, 'web', '2026-07-11 07:47:00', '2026-07-11 07:47:00'),
(8, 'admin.delete', 'Delete Admin', 'User Management', 'admin', 5, 'web', '2026-07-11 07:47:00', '2026-07-11 07:47:00'),
(9, 'user.view', 'View User Status Report', 'User Management', 'admin', NULL, 'web', '2026-07-11 07:47:00', '2026-07-11 07:47:00'),
(10, 'user.edit', 'Manage User Status', 'User Management', 'admin', NULL, 'web', '2026-07-11 07:47:00', '2026-07-11 07:47:00'),
(11, 'parent.view', 'View Parents', 'Parent Management', 'school', NULL, 'web', '2026-07-11 07:47:00', '2026-07-11 07:47:00'),
(12, 'parent.create', 'Create Parent', 'Parent Management', 'school', 11, 'web', '2026-07-11 07:47:00', '2026-07-11 07:47:00'),
(13, 'parent.edit', 'Edit Parent', 'Parent Management', 'school', 11, 'web', '2026-07-11 07:47:00', '2026-07-11 07:47:00'),
(14, 'parent.delete', 'Delete Parent', 'Parent Management', 'school', 11, 'web', '2026-07-11 07:47:00', '2026-07-11 07:47:00'),
(15, 'school.view', 'View Schools', 'School Management', 'school', NULL, 'web', '2026-07-11 07:47:00', '2026-07-11 07:47:00'),
(16, 'school.create', 'Create School', 'School Management', 'school', 15, 'web', '2026-07-11 07:47:00', '2026-07-11 07:47:00'),
(17, 'school.edit', 'Edit School', 'School Management', 'school', 15, 'web', '2026-07-11 07:47:00', '2026-07-11 07:47:00'),
(18, 'school.delete', 'Delete School', 'School Management', 'school', 15, 'web', '2026-07-11 07:47:00', '2026-07-11 07:47:00'),
(19, 'school_standard.view', 'View School Standards', 'School Management', 'school', NULL, 'web', '2026-07-11 07:47:00', '2026-07-11 07:47:00'),
(20, 'school_standard.create', 'Create School Standard', 'School Management', 'school', NULL, 'web', '2026-07-11 07:47:00', '2026-07-11 07:47:00'),
(21, 'school_standard.edit', 'Edit School Standard', 'School Management', 'school', NULL, 'web', '2026-07-11 07:47:00', '2026-07-11 07:47:00'),
(22, 'school_standard.delete', 'Delete School Standard', 'School Management', 'school', NULL, 'web', '2026-07-11 07:47:00', '2026-07-11 07:47:00'),
(23, 'school_section.view', 'View School Sections', 'School Management', 'school', NULL, 'web', '2026-07-11 07:47:00', '2026-07-11 07:47:00'),
(24, 'school_section.create', 'Create School Section', 'School Management', 'school', NULL, 'web', '2026-07-11 07:47:00', '2026-07-11 07:47:00'),
(25, 'school_section.delete', 'Delete School Section', 'School Management', 'school', NULL, 'web', '2026-07-11 07:47:00', '2026-07-11 07:47:00'),
(26, 'product_assignment.view', 'View Product Assignments', 'School Management', 'school', NULL, 'web', '2026-07-11 07:47:00', '2026-07-11 07:47:00'),
(27, 'product_assignment.create', 'Create Product Assignment', 'School Management', 'school', NULL, 'web', '2026-07-11 07:47:00', '2026-07-11 07:47:00'),
(28, 'product_assignment.delete', 'Delete Product Assignment', 'School Management', 'school', NULL, 'web', '2026-07-11 07:47:00', '2026-07-11 07:47:00'),
(29, 'school_board.view', 'View School Boards', 'School Board Management', 'admin', NULL, 'web', '2026-07-11 07:47:00', '2026-07-11 07:47:00'),
(30, 'school_board.create', 'Create School Board', 'School Board Management', 'admin', NULL, 'web', '2026-07-11 07:47:00', '2026-07-11 07:47:00'),
(31, 'school_board.edit', 'Edit School Board', 'School Board Management', 'admin', NULL, 'web', '2026-07-11 07:47:00', '2026-07-11 07:47:00'),
(32, 'school_board.delete', 'Delete School Board', 'School Board Management', 'admin', NULL, 'web', '2026-07-11 07:47:00', '2026-07-11 07:47:00'),
(33, 'product.view', 'View Products', 'Core Product Mgmt', NULL, NULL, 'web', '2026-07-11 07:47:00', '2026-07-11 07:47:00'),
(34, 'product.create', 'Create Product', 'Core Product Mgmt', NULL, 33, 'web', '2026-07-11 07:47:00', '2026-07-11 07:47:00'),
(35, 'product.edit', 'Edit Product', 'Core Product Mgmt', NULL, 33, 'web', '2026-07-11 07:47:00', '2026-07-11 07:47:00'),
(36, 'product.delete', 'Delete Product', 'Core Product Mgmt', NULL, 33, 'web', '2026-07-11 07:47:00', '2026-07-11 07:47:00'),
(37, 'category.view', 'View Categories', 'Category Management', 'admin', NULL, 'web', '2026-07-11 07:47:00', '2026-07-11 07:47:00'),
(38, 'category.create', 'Create Category', 'Category Management', 'admin', 37, 'web', '2026-07-11 07:47:00', '2026-07-11 07:47:00'),
(39, 'category.edit', 'Edit Category', 'Category Management', 'admin', 37, 'web', '2026-07-11 07:47:00', '2026-07-11 07:47:00'),
(40, 'category.delete', 'Delete Category', 'Category Management', 'admin', 37, 'web', '2026-07-11 07:47:00', '2026-07-11 07:47:00'),
(41, 'size.view', 'View Sizes', 'Size Management', 'admin', NULL, 'web', '2026-07-11 07:47:00', '2026-07-11 07:47:00'),
(42, 'size.create', 'Create Size', 'Size Management', 'admin', 41, 'web', '2026-07-11 07:47:00', '2026-07-11 07:47:00'),
(43, 'size.edit', 'Edit Size', 'Size Management', 'admin', 41, 'web', '2026-07-11 07:47:00', '2026-07-11 07:47:00'),
(44, 'size.delete', 'Delete Size', 'Size Management', 'admin', 41, 'web', '2026-07-11 07:47:00', '2026-07-11 07:47:00'),
(45, 'color.view', 'View Colors', 'Color Management', 'admin', NULL, 'web', '2026-07-11 07:47:00', '2026-07-11 07:47:00'),
(46, 'color.create', 'Create Color', 'Color Management', 'admin', 45, 'web', '2026-07-11 07:47:00', '2026-07-11 07:47:00'),
(47, 'color.edit', 'Edit Color', 'Color Management', 'admin', 45, 'web', '2026-07-11 07:47:00', '2026-07-11 07:47:00'),
(48, 'color.delete', 'Delete Color', 'Color Management', 'admin', 45, 'web', '2026-07-11 07:47:00', '2026-07-11 07:47:00'),
(49, 'stock_view', 'View Stock Levels', 'Stock Management', 'vendor', NULL, 'web', '2026-07-11 07:47:00', '2026-07-11 07:47:00'),
(50, 'stock_adjust', 'Adjust Stock', 'Stock Management', 'vendor', NULL, 'web', '2026-07-11 07:47:00', '2026-07-11 07:47:00'),
(51, 'stock_history_view', 'View Stock History', 'Stock Management', 'vendor', NULL, 'web', '2026-07-11 07:47:00', '2026-07-11 07:47:00'),
(52, 'product.stock_update', 'Update Product Stock', 'Stock Management', 'vendor', NULL, 'web', '2026-07-11 07:47:00', '2026-07-11 07:47:00'),
(53, 'product_approval_view', 'View Approval Queue', 'Product Approval', 'school', NULL, 'web', '2026-07-11 07:47:00', '2026-07-11 07:47:00'),
(54, 'product_approval_action', 'Perform Approval Actions', 'Product Approval', 'school', NULL, 'web', '2026-07-11 07:47:00', '2026-07-11 07:47:00'),
(55, 'school.product.approve', 'Approve Products', 'Product Approval', 'school', NULL, 'web', '2026-07-11 07:47:00', '2026-07-11 07:47:00'),
(56, 'school.product.report', 'View Approved Products Report', 'Product Approval', 'school', NULL, 'web', '2026-07-11 07:47:00', '2026-07-11 07:47:00'),
(57, 'vendor.view', 'View Vendors', 'Vendor Management', 'vendor', NULL, 'web', '2026-07-11 07:47:00', '2026-07-11 07:47:00'),
(58, 'vendor.create', 'Create Vendor', 'Vendor Management', 'vendor', NULL, 'web', '2026-07-11 07:47:00', '2026-07-11 07:47:00'),
(59, 'vendor.edit', 'Edit Vendor', 'Vendor Management', 'vendor', NULL, 'web', '2026-07-11 07:47:00', '2026-07-11 07:47:00'),
(60, 'vendor.delete', 'Delete Vendor', 'Vendor Management', 'vendor', NULL, 'web', '2026-07-11 07:47:00', '2026-07-11 07:47:00'),
(61, 'partnership.view', 'View Partnership Requests', 'Partnership Management', 'vendor', NULL, 'web', '2026-07-11 07:47:00', '2026-07-11 07:47:00'),
(62, 'partnership.approve', 'Approve Partnership Request', 'Partnership Management', 'vendor', NULL, 'web', '2026-07-11 07:47:00', '2026-07-11 07:47:00'),
(63, 'partnership.reject', 'Reject Partnership Request', 'Partnership Management', 'vendor', NULL, 'web', '2026-07-11 07:47:00', '2026-07-11 07:47:00'),
(64, 'audit.view', 'View Audit Reports', 'System Management', 'admin', NULL, 'web', '2026-07-11 07:47:00', '2026-07-11 07:47:00'),
(65, 'global_settings.view', 'View Global Settings', 'System Management', 'admin', NULL, 'web', '2026-07-11 07:47:00', '2026-07-11 07:47:00'),
(66, 'global_settings.edit', 'Edit Global Settings', 'System Management', 'admin', NULL, 'web', '2026-07-11 07:47:00', '2026-07-11 07:47:00');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `product_id` char(36) NOT NULL,
  `vendor_id` char(36) NOT NULL,
  `category_id` char(36) NOT NULL,
  `product_code` varchar(50) NOT NULL,
  `product_name` varchar(200) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `meta_title` varchar(255) DEFAULT NULL,
  `meta_description` text DEFAULT NULL,
  `meta_keywords` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `fabric_composition` varchar(255) DEFAULT NULL,
  `gender_type` enum('boys','girls','unisex') NOT NULL,
  `approval_status` enum('pending','approved','rejected') NOT NULL DEFAULT 'pending',
  `approved_by` bigint(20) UNSIGNED DEFAULT NULL,
  `approved_at` timestamp NULL DEFAULT NULL,
  `rejected_by` bigint(20) UNSIGNED DEFAULT NULL,
  `rejected_at` timestamp NULL DEFAULT NULL,
  `rejection_reason` text DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_by` bigint(20) UNSIGNED NOT NULL,
  `updated_by` bigint(20) UNSIGNED NOT NULL,
  `deleted_by` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`product_id`, `vendor_id`, `category_id`, `product_code`, `product_name`, `slug`, `meta_title`, `meta_description`, `meta_keywords`, `description`, `fabric_composition`, `gender_type`, `approval_status`, `approved_by`, `approved_at`, `rejected_by`, `rejected_at`, `rejection_reason`, `is_active`, `created_by`, `updated_by`, `deleted_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
('87b20b5f-4515-4904-b065-0480b9c088b9', '567dc24f-0b63-4fe3-a2a6-d4fdee507dc3', '407e25aa-0667-46c7-b552-ac3d08f48f77', 'MHPS-SHIRT-FS', 'MHPS SENIOR SHIRTS', 'mhps-shirt-fs', NULL, NULL, NULL, NULL, NULL, 'unisex', 'approved', NULL, NULL, NULL, NULL, NULL, 1, 8, 1, NULL, '2026-07-13 16:53:39', '2026-07-13 17:36:38', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `product_approval_histories`
--

CREATE TABLE `product_approval_histories` (
  `history_id` char(36) NOT NULL,
  `product_id` char(36) NOT NULL,
  `action_type` enum('approved','rejected','resubmitted','status_changed') NOT NULL,
  `old_status` varchar(255) DEFAULT NULL,
  `new_status` varchar(255) NOT NULL,
  `remarks` text DEFAULT NULL,
  `performed_by` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `product_assignments`
--

CREATE TABLE `product_assignments` (
  `id` char(36) NOT NULL,
  `product_id` char(36) NOT NULL,
  `assignment_type` enum('standard','section') NOT NULL,
  `standard_id` char(36) DEFAULT NULL,
  `section_id` char(36) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `product_images`
--

CREATE TABLE `product_images` (
  `product_image_id` char(36) NOT NULL,
  `product_id` char(36) NOT NULL,
  `file_id` bigint(20) UNSIGNED NOT NULL,
  `sort_order` int(11) NOT NULL DEFAULT 0,
  `is_primary` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `product_reviews`
--

CREATE TABLE `product_reviews` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` char(36) NOT NULL,
  `order_item_id` bigint(20) UNSIGNED DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `rating` tinyint(4) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `review` text DEFAULT NULL,
  `verified_purchase` tinyint(1) NOT NULL DEFAULT 1,
  `is_approved` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `product_variants`
--

CREATE TABLE `product_variants` (
  `variant_id` char(36) NOT NULL,
  `product_id` char(36) NOT NULL,
  `sku` varchar(60) NOT NULL,
  `size_id` char(36) DEFAULT NULL,
  `color_id` char(36) DEFAULT NULL,
  `mrp` decimal(10,2) NOT NULL,
  `selling_price` decimal(10,2) NOT NULL,
  `stock_qty` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `low_stock_alert` int(10) UNSIGNED NOT NULL DEFAULT 5,
  `low_stock_notified_at` timestamp NULL DEFAULT NULL,
  `barcode` varchar(60) DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_by` bigint(20) UNSIGNED NOT NULL,
  `updated_by` bigint(20) UNSIGNED NOT NULL,
  `deleted_by` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_variants`
--

INSERT INTO `product_variants` (`variant_id`, `product_id`, `sku`, `size_id`, `color_id`, `mrp`, `selling_price`, `stock_qty`, `low_stock_alert`, `low_stock_notified_at`, `barcode`, `is_active`, `created_by`, `updated_by`, `deleted_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
('2a6440f7-7651-4dc4-ab94-9cee391d6e94', '87b20b5f-4515-4904-b065-0480b9c088b9', 'MHPSSHFS28', 'fc28d5a5-73c8-4ba2-826f-1eab0a379def', NULL, 100.00, 90.00, 10, 5, NULL, NULL, 1, 8, 8, NULL, '2026-07-13 16:53:39', '2026-07-13 17:36:38', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `refunds`
--

CREATE TABLE `refunds` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `return_id` bigint(20) UNSIGNED NOT NULL,
  `payment_id` bigint(20) UNSIGNED DEFAULT NULL,
  `amount` decimal(10,2) NOT NULL,
  `status` enum('pending','processing','completed','failed') NOT NULL DEFAULT 'pending',
  `gateway_reference` varchar(255) DEFAULT NULL,
  `processed_at` timestamp NULL DEFAULT NULL,
  `failure_reason` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `returns`
--

CREATE TABLE `returns` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `return_number` varchar(255) NOT NULL,
  `order_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `vendor_id` char(36) DEFAULT NULL,
  `return_type` enum('refund','exchange','store_credit') NOT NULL,
  `status` enum('requested','approved','rejected','pickup_scheduled','picked_up','received','inspecting','completed','cancelled') NOT NULL DEFAULT 'requested',
  `customer_note` text DEFAULT NULL,
  `admin_note` text DEFAULT NULL,
  `requested_at` timestamp NULL DEFAULT NULL,
  `approved_at` timestamp NULL DEFAULT NULL,
  `completed_at` timestamp NULL DEFAULT NULL,
  `handled_by` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `return_items`
--

CREATE TABLE `return_items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `return_id` bigint(20) UNSIGNED NOT NULL,
  `order_item_id` bigint(20) UNSIGNED NOT NULL,
  `return_reason_id` bigint(20) UNSIGNED NOT NULL,
  `quantity` int(10) UNSIGNED NOT NULL,
  `customer_comment` text DEFAULT NULL,
  `condition` enum('new','used','damaged','defective') DEFAULT NULL,
  `inspection_status` enum('pending','approved','rejected') NOT NULL DEFAULT 'pending',
  `inspection_note` text DEFAULT NULL,
  `exchange_variant_id` char(36) DEFAULT NULL,
  `refund_amount` decimal(10,2) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `return_item_images`
--

CREATE TABLE `return_item_images` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `return_item_id` bigint(20) UNSIGNED NOT NULL,
  `image` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `return_policies`
--

CREATE TABLE `return_policies` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `school_id` char(36) DEFAULT NULL,
  `category_id` char(36) DEFAULT NULL,
  `return_window_days` int(10) UNSIGNED NOT NULL DEFAULT 7,
  `allow_return` tinyint(1) NOT NULL DEFAULT 1,
  `allow_exchange` tinyint(1) NOT NULL DEFAULT 1,
  `allow_store_credit` tinyint(1) NOT NULL DEFAULT 1,
  `require_original_tags` tinyint(1) NOT NULL DEFAULT 1,
  `require_unworn` tinyint(1) NOT NULL DEFAULT 1,
  `restocking_fee` decimal(10,2) NOT NULL DEFAULT 0.00,
  `is_final_sale` tinyint(1) NOT NULL DEFAULT 0,
  `description` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `return_reasons`
--

CREATE TABLE `return_reasons` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `reason` varchar(255) NOT NULL,
  `require_comment` tinyint(1) NOT NULL DEFAULT 0,
  `require_photo` tinyint(1) NOT NULL DEFAULT 0,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `sort_order` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `return_shipments`
--

CREATE TABLE `return_shipments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `return_id` bigint(20) UNSIGNED NOT NULL,
  `courier_name` varchar(255) DEFAULT NULL,
  `tracking_number` varchar(255) DEFAULT NULL,
  `tracking_url` varchar(255) DEFAULT NULL,
  `status` enum('pending','picked_up','in_transit','delivered') NOT NULL DEFAULT 'pending',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `role_category` varchar(255) DEFAULT NULL,
  `guard_name` varchar(255) NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `role_category`, `guard_name`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'super-admin', NULL, 'web', NULL, '2026-07-11 07:46:59', '2026-07-11 07:46:59'),
(2, 'admin', NULL, 'web', NULL, '2026-07-11 07:46:59', '2026-07-11 07:46:59'),
(3, 'school', NULL, 'web', NULL, '2026-07-11 07:46:59', '2026-07-11 07:46:59'),
(4, 'vendor', 'vendor', 'web', NULL, '2026-07-11 07:46:59', '2026-07-13 16:23:54'),
(5, 'parent', NULL, 'web', NULL, '2026-07-11 07:46:59', '2026-07-11 07:46:59');

-- --------------------------------------------------------

--
-- Table structure for table `role_has_permissions`
--

CREATE TABLE `role_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `role_has_permissions`
--

INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES
(33, 4),
(34, 4),
(35, 4),
(36, 4),
(49, 4),
(50, 4),
(51, 4),
(52, 4),
(57, 4),
(58, 4),
(59, 4),
(60, 4),
(61, 4),
(62, 4),
(63, 4);

-- --------------------------------------------------------

--
-- Table structure for table `schools`
--

CREATE TABLE `schools` (
  `school_id` char(36) NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `school_name` varchar(200) NOT NULL,
  `principal_name` varchar(100) NOT NULL,
  `email` varchar(150) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `address` text NOT NULL,
  `city` varchar(80) NOT NULL,
  `state` varchar(80) NOT NULL,
  `pincode` varchar(10) NOT NULL,
  `affiliation_no` varchar(30) DEFAULT NULL,
  `logo_url` varchar(255) DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_by` bigint(20) UNSIGNED DEFAULT NULL,
  `updated_by` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `school_type_id` bigint(20) UNSIGNED DEFAULT NULL,
  `school_board_id` bigint(20) UNSIGNED DEFAULT NULL,
  `image_id` bigint(20) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `school_boards`
--

CREATE TABLE `school_boards` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `school_boards`
--

INSERT INTO `school_boards` (`id`, `name`, `description`, `created_at`, `updated_at`) VALUES
(1, 'CBSE', NULL, '2026-07-14 15:06:38', '2026-07-14 15:06:38');

-- --------------------------------------------------------

--
-- Table structure for table `school_classes`
--

CREATE TABLE `school_classes` (
  `id` char(36) NOT NULL,
  `school_id` char(36) NOT NULL,
  `standard_id` char(36) NOT NULL,
  `class_name` varchar(255) NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_by` bigint(20) UNSIGNED DEFAULT NULL,
  `updated_by` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `school_distributions`
--

CREATE TABLE `school_distributions` (
  `id` char(36) NOT NULL,
  `shipment_id` char(36) NOT NULL,
  `school_id` char(36) NOT NULL,
  `received_at` timestamp NULL DEFAULT NULL,
  `received_by` bigint(20) UNSIGNED DEFAULT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'received',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `school_partnership_requests`
--

CREATE TABLE `school_partnership_requests` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `school_name` varchar(255) NOT NULL,
  `contact_person` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `address` varchar(255) DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `state` varchar(255) DEFAULT NULL,
  `pincode` varchar(255) DEFAULT NULL,
  `document_path` varchar(255) DEFAULT NULL,
  `status` enum('pending','approved','rejected') NOT NULL DEFAULT 'pending',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `school_product_approvals`
--

CREATE TABLE `school_product_approvals` (
  `school_product_approval_id` char(36) NOT NULL,
  `school_id` char(36) NOT NULL,
  `product_id` char(36) NOT NULL,
  `status` enum('pending','approved','rejected') NOT NULL DEFAULT 'pending',
  `rejection_reason` text DEFAULT NULL,
  `actioned_by` bigint(20) UNSIGNED NOT NULL,
  `actioned_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `school_product_class_approvals`
--

CREATE TABLE `school_product_class_approvals` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `school_product_approval_id` char(36) NOT NULL,
  `class_id` char(36) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `school_product_standard_approvals`
--

CREATE TABLE `school_product_standard_approvals` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `school_product_approval_id` char(36) NOT NULL,
  `standard_id` char(36) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `school_sections`
--

CREATE TABLE `school_sections` (
  `id` char(36) NOT NULL,
  `school_id` char(36) NOT NULL,
  `standard_id` char(36) NOT NULL,
  `section_name` varchar(255) NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_by` bigint(20) UNSIGNED DEFAULT NULL,
  `updated_by` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `school_standards`
--

CREATE TABLE `school_standards` (
  `id` char(36) NOT NULL,
  `school_id` char(36) NOT NULL,
  `standard_name` varchar(255) NOT NULL,
  `sort_order` int(11) NOT NULL DEFAULT 0,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_by` bigint(20) UNSIGNED DEFAULT NULL,
  `updated_by` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `school_types`
--

CREATE TABLE `school_types` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `type_name` varchar(255) NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('BAdqeJp0hnhpqYV2jpCLWQzglQGZyvPdCoJNtX4t', NULL, '103.240.233.69', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', 'eyJfdG9rZW4iOiJUdEFsRmowSElhM29LdzY3Q09UUThyOFRPaUxyN3dwejYydGpDSGR6IiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHBzOlwvXC9lc2Nob29sa2FydC5jb20iLCJyb3V0ZSI6ImdlbmVyYXRlZDo6MDh1WXU5eWh3UTBvZnJ4ZiJ9LCJfZmxhc2giOnsib2xkIjpbXSwibmV3IjpbXX19', 1784305422),
('kfrNcpIuQmJt6LhqixeOTjhHFoCq9EGcroxv95bc', NULL, '162.158.106.155', 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Mobile Safari/537.36', 'eyJfdG9rZW4iOiI5eXpqR05XRzZ2TDlqZW9ISXhmSFJUU0xXb1k1TXhpd2hMcU96c3RIIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cL3VuaWZvcm0uZXNjaG9vbGthcnQuY29tXC93aXNobGlzdFwvY291bnQiLCJyb3V0ZSI6bnVsbH0sIl9mbGFzaCI6eyJvbGQiOltdLCJuZXciOltdfX0=', 1784257338),
('TGrHhXflP2ktIYQGFr0ZcCy68tgvTyi4sqCMLHGf', NULL, '172.70.143.166', 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Mobile Safari/537.36', 'eyJfdG9rZW4iOiJ3RmY4d0Q2bWhFaHk4UloxM1ZWUEZibWxQTlhZSFRsOTlCS1hpZnlVIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cL3VuaWZvcm0uZXNjaG9vbGthcnQuY29tXC9jYXJ0XC9jb3VudCIsInJvdXRlIjpudWxsfSwiX2ZsYXNoIjp7Im9sZCI6W10sIm5ldyI6W119fQ==', 1784257331),
('xLxSOwyYXOZaQiNMtzXBwngmfrVRxJ2koFG7PJ1w', 1, '104.23.166.107', 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Mobile Safari/537.36', 'eyJfdG9rZW4iOiJidVk5aWVCOUl6YkJKeHdKRTFmVkZiZFdQTlJpQnE4WUFZTVgyeXhLIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cL3VuaWZvcm0uZXNjaG9vbGthcnQuY29tXC9lc2Nob29sa2FydFwvZGFzaGJvYXJkIiwicm91dGUiOiJkYXNoYm9hcmQifSwiX2ZsYXNoIjp7Im9sZCI6W10sIm5ldyI6W119LCJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI6MX0=', 1784253919);

-- --------------------------------------------------------

--
-- Table structure for table `shipments`
--

CREATE TABLE `shipments` (
  `id` char(36) NOT NULL,
  `vendor_id` char(36) DEFAULT NULL,
  `tracking_number` varchar(255) DEFAULT NULL,
  `courier_id` char(36) DEFAULT NULL,
  `shipment_type` varchar(255) NOT NULL,
  `origin_address_id` char(36) DEFAULT NULL,
  `destination_address_id` char(36) DEFAULT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'packed',
  `shipped_at` timestamp NULL DEFAULT NULL,
  `delivered_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `shipment_items`
--

CREATE TABLE `shipment_items` (
  `id` char(36) NOT NULL,
  `shipment_id` char(36) NOT NULL,
  `order_item_id` bigint(20) UNSIGNED NOT NULL,
  `quantity_shipped` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `shipment_tracking_histories`
--

CREATE TABLE `shipment_tracking_histories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `shipment_id` char(36) NOT NULL,
  `status` varchar(255) NOT NULL,
  `location` varchar(255) DEFAULT NULL,
  `remarks` text DEFAULT NULL,
  `tracked_at` timestamp NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `shipping_addresses`
--

CREATE TABLE `shipping_addresses` (
  `id` char(36) NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `address_line1` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `state` varchar(255) NOT NULL,
  `zip_code` varchar(255) NOT NULL,
  `country` varchar(255) NOT NULL DEFAULT 'India',
  `is_default` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sizes`
--

CREATE TABLE `sizes` (
  `size_id` char(36) NOT NULL,
  `size_name` varchar(20) NOT NULL,
  `display_name` varchar(30) NOT NULL,
  `sort_order` int(11) NOT NULL DEFAULT 0,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_by` bigint(20) UNSIGNED NOT NULL,
  `updated_by` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sizes`
--

INSERT INTO `sizes` (`size_id`, `size_name`, `display_name`, `sort_order`, `is_active`, `created_by`, `updated_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
('225e6f92-63ed-4322-a79c-7d31acddafca', '34', 'Size 34', 10, 1, 1, 1, '2026-07-11 07:47:00', '2026-07-11 07:47:00', NULL),
('2f0131f6-0d3b-4f3f-a5b0-bcfcd234f385', 'M', 'Medium', 3, 1, 1, 1, '2026-07-11 07:47:00', '2026-07-11 07:47:00', NULL),
('31a00ff2-c2c0-436d-a1c0-4771af923e14', '38', 'Size 38', 12, 1, 1, 1, '2026-07-11 07:47:00', '2026-07-11 07:47:00', NULL),
('5385f17d-7d72-4196-8d56-13dc60cedc77', '42', 'Size 42', 14, 1, 1, 1, '2026-07-11 07:47:00', '2026-07-11 07:47:00', NULL),
('5a5313ea-2a12-40e5-a20e-e1fe6d161bf5', 'XL', 'Extra Large', 5, 1, 1, 1, '2026-07-11 07:47:00', '2026-07-11 07:47:00', NULL),
('7086bc82-c901-428d-8eb7-3c160aacf60b', '30', 'Size 30', 8, 1, 1, 1, '2026-07-11 07:47:00', '2026-07-11 07:47:00', NULL),
('82798aab-47e5-4131-bd77-0c9fc77b56cc', 'S', 'Small', 2, 1, 1, 1, '2026-07-11 07:47:00', '2026-07-11 07:47:00', NULL),
('97ee9c8b-4cff-42db-b88e-b36f65568a2a', '40', 'Size 40', 13, 1, 1, 1, '2026-07-11 07:47:00', '2026-07-11 07:47:00', NULL),
('9ae6ec5d-b355-4810-b94f-0c0e7c240f4a', '32', 'Size 32', 9, 1, 1, 1, '2026-07-11 07:47:00', '2026-07-11 07:47:00', NULL),
('b7643563-8ffc-4d43-9901-13e7a296aad5', 'L', 'Large', 4, 1, 1, 1, '2026-07-11 07:47:00', '2026-07-11 07:47:00', NULL),
('bdad252d-c5f6-41e3-b7cb-ca7964fda0be', '36', 'Size 36', 11, 1, 1, 1, '2026-07-11 07:47:00', '2026-07-11 07:47:00', NULL),
('dd6e89d2-1f60-48a5-9b77-24b97d94c79e', 'XS', 'Extra Small', 1, 1, 1, 1, '2026-07-11 07:47:00', '2026-07-11 07:47:00', NULL),
('e60c2dd3-6cef-44f4-b69e-6bece0e931c0', 'XXL', 'Double Extra Large', 6, 1, 1, 1, '2026-07-11 07:47:00', '2026-07-11 07:47:00', NULL),
('fc28d5a5-73c8-4ba2-826f-1eab0a379def', '28', 'Size 28', 7, 1, 1, 1, '2026-07-11 07:47:00', '2026-07-11 07:47:00', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `stock_adjustments`
--

CREATE TABLE `stock_adjustments` (
  `adjustment_id` char(36) NOT NULL,
  `variant_id` char(36) NOT NULL,
  `old_stock` int(11) NOT NULL,
  `added_quantity` int(11) NOT NULL,
  `new_stock` int(11) NOT NULL,
  `remarks` text DEFAULT NULL,
  `created_by` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `store_credits`
--

CREATE TABLE `store_credits` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `return_id` bigint(20) UNSIGNED DEFAULT NULL,
  `transaction_type` enum('credit','debit') NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `balance` decimal(10,2) NOT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `student_distributions`
--

CREATE TABLE `student_distributions` (
  `id` char(36) NOT NULL,
  `order_item_id` bigint(20) UNSIGNED NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'pending_pickup',
  `delivered_at` timestamp NULL DEFAULT NULL,
  `collected_by` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(150) NOT NULL,
  `avatar` varchar(255) DEFAULT NULL,
  `username` varchar(50) DEFAULT NULL,
  `email` varchar(150) DEFAULT NULL,
  `phone` varchar(15) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `phone_verified_at` timestamp NULL DEFAULT NULL,
  `last_login_at` timestamp NULL DEFAULT NULL,
  `last_login_ip` varchar(45) DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `image_id` bigint(20) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `avatar`, `username`, `email`, `phone`, `password`, `is_active`, `email_verified_at`, `phone_verified_at`, `last_login_at`, `last_login_ip`, `remember_token`, `created_at`, `updated_at`, `deleted_at`, `image_id`) VALUES
(1, 'Super Admin', NULL, NULL, 'rudershtiwari8@gmail.com', '9999999999', '$2y$12$s..JyAjfqNfy00Iq802FeeMo7xBBx4dkOIV.BeDvylAymF3gT.VZC', 1, '2026-07-11 07:47:00', '2026-07-11 07:47:00', NULL, NULL, 'oysdExg2ovEO2pxyJPJ93aj3DL5peljaTc0BHgpor2AHQq7V7wFDMN25vw7H', '2026-07-11 07:47:00', '2026-07-13 16:13:22', NULL, NULL),
(2, 'Pavnish Tiwari', NULL, NULL, 'pavnish@gmail.com', NULL, '$2y$12$TE4pl.WKxNwaIcaJ.IngfeC7Sp/tdxxurv5pSz8wMDxURQrmZn3M6', 1, NULL, NULL, NULL, NULL, NULL, '2026-07-11 19:42:24', '2026-07-11 19:42:24', NULL, NULL),
(3, 'AJAY KUMAR SHARMA', NULL, NULL, 'ajaykr.1891@gmail.com', NULL, '$2y$12$tNJTQIqUbcvMS1pv57IInetIJ5fLDFvfcOhWLEwCaUF8gMrfYUugi', 1, NULL, NULL, NULL, NULL, NULL, '2026-07-11 19:51:05', '2026-07-11 19:51:05', NULL, NULL),
(4, 'Abc', NULL, NULL, 'ajay.inkubis@gmail.com', '7277711891', NULL, 1, NULL, NULL, NULL, NULL, NULL, '2026-07-12 04:29:36', '2026-07-12 04:29:36', NULL, NULL),
(5, 'A2M TRADERS', NULL, NULL, 'akshit.a2mtraders@gmail.com', '8750095254', NULL, 1, NULL, NULL, NULL, NULL, NULL, '2026-07-12 17:27:41', '2026-07-12 17:27:41', NULL, NULL),
(8, 'TEST1', NULL, 'Test1', 'ergoyalakshit@gmail.com', '8077526201', '$2y$12$yokw5N0Y3ui/DRb0d.uYiuLTnT3ujmKvcgiGG9Gxnzor4DZ0PqUp2', 1, NULL, NULL, NULL, NULL, 'yvAMCNxkKTRj56XrF8VbkY4CPQQtTclegQoMulzJi5z1MS9eGrrfK9ZCF8Wa', '2026-07-13 16:19:58', '2026-07-13 16:21:42', NULL, NULL),
(13, 'Uniform', NULL, 'ajaykr.1891', 'digiwaretechno@gmail.com', '8130224328', '$2y$12$6RjH8V.OqqUe4mblnu3E1.7h7sJ5fl0M5he4u2q/JQO5gATDU0IbG', 1, NULL, NULL, NULL, NULL, NULL, '2026-07-14 17:05:12', '2026-07-14 17:07:08', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user_otps`
--

CREATE TABLE `user_otps` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `type` enum('email','sms') NOT NULL,
  `otp` varchar(6) NOT NULL,
  `expires_at` timestamp NOT NULL,
  `verified_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user_recently_viewed`
--

CREATE TABLE `user_recently_viewed` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `vendors`
--

CREATE TABLE `vendors` (
  `vendor_id` char(36) NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `business_name` varchar(150) NOT NULL,
  `owner_name` varchar(100) NOT NULL,
  `email` varchar(150) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `address` text NOT NULL,
  `city` varchar(80) NOT NULL,
  `state` varchar(80) NOT NULL,
  `pincode` varchar(10) NOT NULL,
  `gstin` varchar(20) DEFAULT NULL,
  `pan_number` varchar(15) DEFAULT NULL,
  `bank_account_no` varchar(255) DEFAULT NULL,
  `ifsc_code` varchar(15) DEFAULT NULL,
  `commission_rate` decimal(5,2) NOT NULL DEFAULT 0.00,
  `status` enum('pending','approved','suspended') NOT NULL DEFAULT 'pending',
  `is_active` enum('1','0') NOT NULL DEFAULT '0',
  `logo_url` varchar(255) DEFAULT NULL,
  `created_by` bigint(20) NOT NULL,
  `updated_by` bigint(20) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `image_id` bigint(20) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `vendors`
--

INSERT INTO `vendors` (`vendor_id`, `user_id`, `business_name`, `owner_name`, `email`, `phone`, `address`, `city`, `state`, `pincode`, `gstin`, `pan_number`, `bank_account_no`, `ifsc_code`, `commission_rate`, `status`, `is_active`, `logo_url`, `created_by`, `updated_by`, `created_at`, `updated_at`, `deleted_at`, `image_id`) VALUES
('2143c59f-4521-40e8-a2de-054d89dcde64', 8, 'TEST1', 'TEWST', 'ergoyalakshit@gmail.com', '8077526201', 'TESTR', 'TEST', 'TWDRF', '203207', '09BXGPG1377Q1ZU', 'BXGPG1377Q', NULL, NULL, 0.00, 'pending', '1', NULL, 1, 1, '2026-07-13 16:19:58', '2026-07-13 16:19:58', NULL, NULL),
('567dc24f-0b63-4fe3-a2a6-d4fdee507dc3', 5, 'A2M TRADERS', 'Akshit', 'akshit.a2mtraders@gmail.com', '8750095254', 'A2M Traders, Niyader ganj', 'Dadri', 'Uttar Pradesh', '203207', '09BXGPG1377Q1ZU', 'BXGPG1377Q', NULL, NULL, 0.00, 'approved', '1', NULL, 1, 1, '2026-07-12 17:27:41', '2026-07-13 16:17:20', NULL, NULL),
('c1f2bfd1-c4c8-4bd7-8add-67be3e47edca', 4, 'Abc', 'Ajay', 'ajay.inkubis@gmail.com', '7277711891', 'GREATER Noida', 'Greater Noida', 'Up', '23207', NULL, NULL, NULL, NULL, 0.00, 'approved', '1', NULL, 1, 1, '2026-07-12 04:29:36', '2026-07-12 04:30:57', NULL, NULL),
('dde3bca1-90ca-4afd-9061-63ebd4a9be76', 13, 'Uniform', 'Ajay', 'digiwaretechno@gmail.com', '8130224328', 'GRE', 'Greater noida', 'Uttar Pradesh', '201310', NULL, NULL, NULL, NULL, 0.00, 'approved', '1', NULL, 1, 1, '2026-07-14 17:05:12', '2026-07-14 17:05:12', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `vendor_partnership_requests`
--

CREATE TABLE `vendor_partnership_requests` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `company_name` varchar(255) NOT NULL,
  `category` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `gstin` varchar(255) NOT NULL,
  `address` varchar(255) DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `state` varchar(255) DEFAULT NULL,
  `pincode` varchar(255) DEFAULT NULL,
  `pan_number` varchar(255) DEFAULT NULL,
  `bank_account_no` varchar(255) DEFAULT NULL,
  `ifsc_code` varchar(255) DEFAULT NULL,
  `document_path` varchar(255) DEFAULT NULL,
  `status` enum('pending','approved','rejected') NOT NULL DEFAULT 'pending',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `web_users`
--

CREATE TABLE `web_users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `address` varchar(255) DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `state` varchar(255) DEFAULT NULL,
  `zip_code` varchar(255) DEFAULT NULL,
  `alternate_phone` varchar(255) DEFAULT NULL,
  `gender` varchar(255) DEFAULT NULL,
  `date_of_birth` date DEFAULT NULL,
  `national_id` varchar(255) DEFAULT NULL,
  `emergency_contact_name` varchar(255) DEFAULT NULL,
  `emergency_contact_phone` varchar(255) DEFAULT NULL,
  `emergency_contact_relationship` varchar(255) DEFAULT NULL,
  `notes` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `web_users`
--

INSERT INTO `web_users` (`id`, `user_id`, `address`, `city`, `state`, `zip_code`, `alternate_phone`, `gender`, `date_of_birth`, `national_id`, `emergency_contact_name`, `emergency_contact_phone`, `emergency_contact_relationship`, `notes`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 2, 'KOHRANV KUKUWAR PATTI PRATAPGARH', 'Pratapgarh', 'Uttar Pradesh', '230135', NULL, 'Male', '2026-07-12', NULL, NULL, NULL, NULL, NULL, '2026-07-11 19:42:24', '2026-07-11 19:42:24', NULL),
(2, 3, 'Dadri', 'Greater noida', 'Uttar Pradesh', '201310', '727277711', 'Male', '2026-07-12', NULL, 'AJAY KUMAR SHARMA', '8288811991', NULL, NULL, '2026-07-11 19:51:05', '2026-07-11 19:51:05', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `wishlists`
--

CREATE TABLE `wishlists` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `wishlist_items`
--

CREATE TABLE `wishlist_items` (
  `wishlist_item_id` char(36) NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` char(36) NOT NULL,
  `variant_id` char(36) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `activity_log`
--
ALTER TABLE `activity_log`
  ADD PRIMARY KEY (`id`),
  ADD KEY `subject` (`subject_type`,`subject_id`),
  ADD KEY `causer` (`causer_type`,`causer_id`),
  ADD KEY `activity_log_log_name_index` (`log_name`);

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`),
  ADD KEY `cache_expiration_index` (`expiration`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`),
  ADD KEY `cache_locks_expiration_index` (`expiration`);

--
-- Indexes for table `carts`
--
ALTER TABLE `carts`
  ADD PRIMARY KEY (`cart_id`),
  ADD KEY `carts_school_id_foreign` (`school_id`),
  ADD KEY `carts_user_id_status_index` (`user_id`,`status`),
  ADD KEY `carts_session_id_index` (`session_id`);

--
-- Indexes for table `cart_items`
--
ALTER TABLE `cart_items`
  ADD PRIMARY KEY (`cart_item_id`),
  ADD UNIQUE KEY `cart_items_cart_id_variant_id_unique` (`cart_id`,`variant_id`),
  ADD KEY `cart_items_product_id_foreign` (`product_id`),
  ADD KEY `cart_items_variant_id_foreign` (`variant_id`),
  ADD KEY `cart_items_vendor_id_foreign` (`vendor_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`category_id`),
  ADD UNIQUE KEY `categories_category_name_unique` (`category_name`),
  ADD KEY `categories_parent_id_foreign` (`parent_id`);

--
-- Indexes for table `colors`
--
ALTER TABLE `colors`
  ADD PRIMARY KEY (`color_id`),
  ADD UNIQUE KEY `colors_color_name_unique` (`color_name`),
  ADD KEY `colors_created_by_foreign` (`created_by`),
  ADD KEY `colors_updated_by_foreign` (`updated_by`);

--
-- Indexes for table `contact_messages`
--
ALTER TABLE `contact_messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `coupons`
--
ALTER TABLE `coupons`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `coupons_code_unique` (`code`);

--
-- Indexes for table `coupon_usages`
--
ALTER TABLE `coupon_usages`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `coupon_usages_coupon_id_order_id_unique` (`coupon_id`,`order_id`),
  ADD KEY `coupon_usages_order_id_foreign` (`order_id`),
  ADD KEY `coupon_usages_user_id_foreign` (`user_id`);

--
-- Indexes for table `couriers`
--
ALTER TABLE `couriers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `email_logs`
--
ALTER TABLE `email_logs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `email_templates`
--
ALTER TABLE `email_templates`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email_templates_template_key_unique` (`template_key`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`),
  ADD KEY `failed_jobs_connection_queue_failed_at_index` (`connection`,`queue`,`failed_at`);

--
-- Indexes for table `files`
--
ALTER TABLE `files`
  ADD PRIMARY KEY (`id`),
  ADD KEY `files_file_path_index` (`file_path`),
  ADD KEY `files_disk_index` (`disk`);

--
-- Indexes for table `global_settings`
--
ALTER TABLE `global_settings`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `global_settings_key_unique` (`key`);

--
-- Indexes for table `invoices`
--
ALTER TABLE `invoices`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `invoices_invoice_number_unique` (`invoice_number`),
  ADD KEY `invoices_order_id_foreign` (`order_id`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mail_settings`
--
ALTER TABLE `mail_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  ADD KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  ADD KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `notifications_notifiable_type_notifiable_id_index` (`notifiable_type`,`notifiable_id`);

--
-- Indexes for table `notification_templates`
--
ALTER TABLE `notification_templates`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `notification_templates_key_unique` (`key`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `orders_order_number_unique` (`order_number`),
  ADD KEY `orders_school_id_foreign` (`school_id`),
  ADD KEY `orders_vendor_id_foreign` (`vendor_id`),
  ADD KEY `orders_cart_id_foreign` (`cart_id`),
  ADD KEY `orders_user_id_status_index` (`user_id`,`status`);

--
-- Indexes for table `order_addresses`
--
ALTER TABLE `order_addresses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_addresses_order_id_foreign` (`order_id`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_items_order_id_foreign` (`order_id`),
  ADD KEY `order_items_product_id_foreign` (`product_id`),
  ADD KEY `order_items_variant_id_foreign` (`variant_id`),
  ADD KEY `order_items_vendor_id_foreign` (`vendor_id`);

--
-- Indexes for table `order_notes`
--
ALTER TABLE `order_notes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_notes_order_id_foreign` (`order_id`),
  ADD KEY `order_notes_user_id_foreign` (`user_id`);

--
-- Indexes for table `order_product_snapshots`
--
ALTER TABLE `order_product_snapshots`
  ADD PRIMARY KEY (`snapshot_id`),
  ADD KEY `order_product_snapshots_order_item_id_foreign` (`order_item_id`),
  ADD KEY `order_product_snapshots_product_id_foreign` (`product_id`);

--
-- Indexes for table `order_status_histories`
--
ALTER TABLE `order_status_histories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_status_histories_order_id_foreign` (`order_id`),
  ADD KEY `order_status_histories_changed_by_foreign` (`changed_by`);

--
-- Indexes for table `parent_categories`
--
ALTER TABLE `parent_categories`
  ADD PRIMARY KEY (`parent_id`),
  ADD UNIQUE KEY `parent_categories_name_unique` (`name`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `payments_user_id_foreign` (`user_id`),
  ADD KEY `payments_order_id_status_index` (`order_id`,`status`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`),
  ADD KEY `permissions_parent_id_foreign` (`parent_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_id`),
  ADD UNIQUE KEY `products_product_code_unique` (`product_code`),
  ADD UNIQUE KEY `products_slug_unique` (`slug`),
  ADD KEY `products_vendor_id_foreign` (`vendor_id`),
  ADD KEY `products_category_id_foreign` (`category_id`),
  ADD KEY `products_created_by_foreign` (`created_by`),
  ADD KEY `products_updated_by_foreign` (`updated_by`),
  ADD KEY `products_deleted_by_foreign` (`deleted_by`),
  ADD KEY `products_approved_by_foreign` (`approved_by`),
  ADD KEY `products_rejected_by_foreign` (`rejected_by`);

--
-- Indexes for table `product_approval_histories`
--
ALTER TABLE `product_approval_histories`
  ADD PRIMARY KEY (`history_id`),
  ADD KEY `product_approval_histories_product_id_foreign` (`product_id`),
  ADD KEY `product_approval_histories_performed_by_foreign` (`performed_by`);

--
-- Indexes for table `product_assignments`
--
ALTER TABLE `product_assignments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_assignments_assignment_type_index` (`assignment_type`),
  ADD KEY `product_assignments_product_id_assignment_type_index` (`product_id`,`assignment_type`),
  ADD KEY `product_assignments_standard_id_index` (`standard_id`),
  ADD KEY `product_assignments_section_id_index` (`section_id`);

--
-- Indexes for table `product_images`
--
ALTER TABLE `product_images`
  ADD PRIMARY KEY (`product_image_id`),
  ADD KEY `product_images_product_id_foreign` (`product_id`),
  ADD KEY `product_images_file_id_foreign` (`file_id`);

--
-- Indexes for table `product_reviews`
--
ALTER TABLE `product_reviews`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_reviews_order_item_id_foreign` (`order_item_id`),
  ADD KEY `product_reviews_user_id_foreign` (`user_id`),
  ADD KEY `product_reviews_product_id_rating_index` (`product_id`,`rating`);

--
-- Indexes for table `product_variants`
--
ALTER TABLE `product_variants`
  ADD PRIMARY KEY (`variant_id`),
  ADD UNIQUE KEY `product_variants_sku_unique` (`sku`),
  ADD UNIQUE KEY `uq_variant_combination` (`product_id`,`size_id`,`color_id`),
  ADD UNIQUE KEY `product_variants_barcode_unique` (`barcode`),
  ADD KEY `product_variants_size_id_foreign` (`size_id`),
  ADD KEY `product_variants_color_id_foreign` (`color_id`),
  ADD KEY `product_variants_created_by_foreign` (`created_by`),
  ADD KEY `product_variants_updated_by_foreign` (`updated_by`),
  ADD KEY `product_variants_deleted_by_foreign` (`deleted_by`);

--
-- Indexes for table `refunds`
--
ALTER TABLE `refunds`
  ADD PRIMARY KEY (`id`),
  ADD KEY `refunds_return_id_foreign` (`return_id`),
  ADD KEY `refunds_payment_id_foreign` (`payment_id`);

--
-- Indexes for table `returns`
--
ALTER TABLE `returns`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `returns_return_number_unique` (`return_number`),
  ADD KEY `returns_user_id_foreign` (`user_id`),
  ADD KEY `returns_vendor_id_foreign` (`vendor_id`),
  ADD KEY `returns_handled_by_foreign` (`handled_by`),
  ADD KEY `returns_order_id_status_index` (`order_id`,`status`);

--
-- Indexes for table `return_items`
--
ALTER TABLE `return_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `return_items_return_id_foreign` (`return_id`),
  ADD KEY `return_items_order_item_id_foreign` (`order_item_id`),
  ADD KEY `return_items_return_reason_id_foreign` (`return_reason_id`),
  ADD KEY `return_items_exchange_variant_id_foreign` (`exchange_variant_id`);

--
-- Indexes for table `return_item_images`
--
ALTER TABLE `return_item_images`
  ADD PRIMARY KEY (`id`),
  ADD KEY `return_item_images_return_item_id_foreign` (`return_item_id`);

--
-- Indexes for table `return_policies`
--
ALTER TABLE `return_policies`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uq_return_policy_school_category` (`school_id`,`category_id`),
  ADD KEY `return_policies_category_id_foreign` (`category_id`);

--
-- Indexes for table `return_reasons`
--
ALTER TABLE `return_reasons`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `return_shipments`
--
ALTER TABLE `return_shipments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `return_shipments_return_id_foreign` (`return_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indexes for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `role_has_permissions_role_id_foreign` (`role_id`);

--
-- Indexes for table `schools`
--
ALTER TABLE `schools`
  ADD PRIMARY KEY (`school_id`),
  ADD UNIQUE KEY `schools_user_id_unique` (`user_id`),
  ADD UNIQUE KEY `schools_school_name_unique` (`school_name`),
  ADD UNIQUE KEY `schools_email_unique` (`email`),
  ADD KEY `schools_created_by_foreign` (`created_by`),
  ADD KEY `schools_updated_by_foreign` (`updated_by`),
  ADD KEY `schools_school_name_index` (`school_name`),
  ADD KEY `schools_city_index` (`city`),
  ADD KEY `schools_state_index` (`state`),
  ADD KEY `schools_is_active_index` (`is_active`),
  ADD KEY `schools_school_type_id_foreign` (`school_type_id`),
  ADD KEY `schools_school_board_id_foreign` (`school_board_id`),
  ADD KEY `schools_image_id_foreign` (`image_id`);

--
-- Indexes for table `school_boards`
--
ALTER TABLE `school_boards`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `school_boards_name_unique` (`name`);

--
-- Indexes for table `school_classes`
--
ALTER TABLE `school_classes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `school_classes_school_id_foreign` (`school_id`),
  ADD KEY `school_classes_standard_id_foreign` (`standard_id`),
  ADD KEY `school_classes_created_by_foreign` (`created_by`),
  ADD KEY `school_classes_updated_by_foreign` (`updated_by`);

--
-- Indexes for table `school_distributions`
--
ALTER TABLE `school_distributions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `school_distributions_shipment_id_foreign` (`shipment_id`),
  ADD KEY `school_distributions_school_id_foreign` (`school_id`),
  ADD KEY `school_distributions_received_by_foreign` (`received_by`);

--
-- Indexes for table `school_partnership_requests`
--
ALTER TABLE `school_partnership_requests`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `school_product_approvals`
--
ALTER TABLE `school_product_approvals`
  ADD PRIMARY KEY (`school_product_approval_id`),
  ADD UNIQUE KEY `uq_school_product` (`school_id`,`product_id`),
  ADD KEY `school_product_approvals_product_id_foreign` (`product_id`),
  ADD KEY `school_product_approvals_actioned_by_foreign` (`actioned_by`);

--
-- Indexes for table `school_product_class_approvals`
--
ALTER TABLE `school_product_class_approvals`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_spca_approval` (`school_product_approval_id`),
  ADD KEY `school_product_class_approvals_class_id_foreign` (`class_id`);

--
-- Indexes for table `school_product_standard_approvals`
--
ALTER TABLE `school_product_standard_approvals`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_spsa_approval` (`school_product_approval_id`),
  ADD KEY `fk_spsa_standard` (`standard_id`);

--
-- Indexes for table `school_sections`
--
ALTER TABLE `school_sections`
  ADD PRIMARY KEY (`id`),
  ADD KEY `school_sections_standard_id_foreign` (`standard_id`),
  ADD KEY `school_sections_created_by_foreign` (`created_by`),
  ADD KEY `school_sections_updated_by_foreign` (`updated_by`),
  ADD KEY `school_sections_school_id_standard_id_index` (`school_id`,`standard_id`);

--
-- Indexes for table `school_standards`
--
ALTER TABLE `school_standards`
  ADD PRIMARY KEY (`id`),
  ADD KEY `school_standards_school_id_foreign` (`school_id`),
  ADD KEY `school_standards_created_by_foreign` (`created_by`),
  ADD KEY `school_standards_updated_by_foreign` (`updated_by`);

--
-- Indexes for table `school_types`
--
ALTER TABLE `school_types`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `school_types_type_name_unique` (`type_name`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `shipments`
--
ALTER TABLE `shipments`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `shipments_tracking_number_unique` (`tracking_number`),
  ADD KEY `shipments_courier_id_foreign` (`courier_id`),
  ADD KEY `shipments_tracking_number_index` (`tracking_number`),
  ADD KEY `shipments_vendor_id_foreign` (`vendor_id`);

--
-- Indexes for table `shipment_items`
--
ALTER TABLE `shipment_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `shipment_items_shipment_id_foreign` (`shipment_id`),
  ADD KEY `shipment_items_order_item_id_foreign` (`order_item_id`);

--
-- Indexes for table `shipment_tracking_histories`
--
ALTER TABLE `shipment_tracking_histories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `shipment_tracking_histories_shipment_id_foreign` (`shipment_id`);

--
-- Indexes for table `shipping_addresses`
--
ALTER TABLE `shipping_addresses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `shipping_addresses_user_id_foreign` (`user_id`);

--
-- Indexes for table `sizes`
--
ALTER TABLE `sizes`
  ADD PRIMARY KEY (`size_id`),
  ADD UNIQUE KEY `sizes_size_name_unique` (`size_name`),
  ADD KEY `sizes_created_by_foreign` (`created_by`),
  ADD KEY `sizes_updated_by_foreign` (`updated_by`);

--
-- Indexes for table `stock_adjustments`
--
ALTER TABLE `stock_adjustments`
  ADD PRIMARY KEY (`adjustment_id`),
  ADD KEY `stock_adjustments_variant_id_foreign` (`variant_id`),
  ADD KEY `stock_adjustments_created_by_foreign` (`created_by`);

--
-- Indexes for table `store_credits`
--
ALTER TABLE `store_credits`
  ADD PRIMARY KEY (`id`),
  ADD KEY `store_credits_user_id_foreign` (`user_id`),
  ADD KEY `store_credits_return_id_foreign` (`return_id`);

--
-- Indexes for table `student_distributions`
--
ALTER TABLE `student_distributions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `student_distributions_order_item_id_foreign` (`order_item_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD UNIQUE KEY `users_phone_unique` (`phone`),
  ADD UNIQUE KEY `users_username_unique` (`username`),
  ADD KEY `users_image_id_foreign` (`image_id`);

--
-- Indexes for table `user_otps`
--
ALTER TABLE `user_otps`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_otps_user_id_foreign` (`user_id`);

--
-- Indexes for table `user_recently_viewed`
--
ALTER TABLE `user_recently_viewed`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_recently_viewed_user_id_product_id_index` (`user_id`,`product_id`);

--
-- Indexes for table `vendors`
--
ALTER TABLE `vendors`
  ADD PRIMARY KEY (`vendor_id`),
  ADD UNIQUE KEY `vendors_user_id_unique` (`user_id`),
  ADD UNIQUE KEY `vendors_business_name_unique` (`business_name`),
  ADD UNIQUE KEY `vendors_email_unique` (`email`),
  ADD KEY `vendors_image_id_foreign` (`image_id`);

--
-- Indexes for table `vendor_partnership_requests`
--
ALTER TABLE `vendor_partnership_requests`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `web_users`
--
ALTER TABLE `web_users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `web_users_user_id_foreign` (`user_id`);

--
-- Indexes for table `wishlists`
--
ALTER TABLE `wishlists`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `wishlists_user_id_unique` (`user_id`);

--
-- Indexes for table `wishlist_items`
--
ALTER TABLE `wishlist_items`
  ADD PRIMARY KEY (`wishlist_item_id`),
  ADD UNIQUE KEY `wishlist_items_user_id_variant_id_unique` (`user_id`,`variant_id`),
  ADD KEY `wishlist_items_product_id_foreign` (`product_id`),
  ADD KEY `wishlist_items_variant_id_foreign` (`variant_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `activity_log`
--
ALTER TABLE `activity_log`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=148;

--
-- AUTO_INCREMENT for table `contact_messages`
--
ALTER TABLE `contact_messages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `coupons`
--
ALTER TABLE `coupons`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `coupon_usages`
--
ALTER TABLE `coupon_usages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `email_logs`
--
ALTER TABLE `email_logs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `email_templates`
--
ALTER TABLE `email_templates`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `files`
--
ALTER TABLE `files`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `global_settings`
--
ALTER TABLE `global_settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `invoices`
--
ALTER TABLE `invoices`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;

--
-- AUTO_INCREMENT for table `mail_settings`
--
ALTER TABLE `mail_settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=91;

--
-- AUTO_INCREMENT for table `notification_templates`
--
ALTER TABLE `notification_templates`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `order_addresses`
--
ALTER TABLE `order_addresses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `order_notes`
--
ALTER TABLE `order_notes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `order_status_histories`
--
ALTER TABLE `order_status_histories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=67;

--
-- AUTO_INCREMENT for table `product_reviews`
--
ALTER TABLE `product_reviews`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `refunds`
--
ALTER TABLE `refunds`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `returns`
--
ALTER TABLE `returns`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `return_items`
--
ALTER TABLE `return_items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `return_item_images`
--
ALTER TABLE `return_item_images`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `return_policies`
--
ALTER TABLE `return_policies`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `return_reasons`
--
ALTER TABLE `return_reasons`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `return_shipments`
--
ALTER TABLE `return_shipments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `school_boards`
--
ALTER TABLE `school_boards`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `school_partnership_requests`
--
ALTER TABLE `school_partnership_requests`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `school_product_class_approvals`
--
ALTER TABLE `school_product_class_approvals`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `school_product_standard_approvals`
--
ALTER TABLE `school_product_standard_approvals`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `school_types`
--
ALTER TABLE `school_types`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `shipment_tracking_histories`
--
ALTER TABLE `shipment_tracking_histories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `store_credits`
--
ALTER TABLE `store_credits`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `user_otps`
--
ALTER TABLE `user_otps`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user_recently_viewed`
--
ALTER TABLE `user_recently_viewed`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `vendor_partnership_requests`
--
ALTER TABLE `vendor_partnership_requests`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `web_users`
--
ALTER TABLE `web_users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `wishlists`
--
ALTER TABLE `wishlists`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

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
  ADD CONSTRAINT `categories_parent_id_foreign` FOREIGN KEY (`parent_id`) REFERENCES `parent_categories` (`parent_id`) ON DELETE SET NULL;

--
-- Constraints for table `colors`
--
ALTER TABLE `colors`
  ADD CONSTRAINT `colors_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `colors_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`);

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
  ADD CONSTRAINT `product_assignments_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `product_assignments_section_id_foreign` FOREIGN KEY (`section_id`) REFERENCES `school_sections` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `product_assignments_standard_id_foreign` FOREIGN KEY (`standard_id`) REFERENCES `school_standards` (`id`) ON DELETE CASCADE;

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
  ADD CONSTRAINT `return_items_return_reason_id_foreign` FOREIGN KEY (`return_reason_id`) REFERENCES `return_reasons` (`id`);

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
  ADD CONSTRAINT `schools_school_board_id_foreign` FOREIGN KEY (`school_board_id`) REFERENCES `school_boards` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `schools_school_type_id_foreign` FOREIGN KEY (`school_type_id`) REFERENCES `school_types` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `schools_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `schools_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `school_classes`
--
ALTER TABLE `school_classes`
  ADD CONSTRAINT `school_classes_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `school_classes_school_id_foreign` FOREIGN KEY (`school_id`) REFERENCES `schools` (`school_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `school_classes_standard_id_foreign` FOREIGN KEY (`standard_id`) REFERENCES `school_standards` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `school_classes_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`) ON DELETE SET NULL;

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
  ADD CONSTRAINT `fk_spca_approval` FOREIGN KEY (`school_product_approval_id`) REFERENCES `school_product_approvals` (`school_product_approval_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `school_product_class_approvals_class_id_foreign` FOREIGN KEY (`class_id`) REFERENCES `school_classes` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `school_product_standard_approvals`
--
ALTER TABLE `school_product_standard_approvals`
  ADD CONSTRAINT `fk_spsa_approval` FOREIGN KEY (`school_product_approval_id`) REFERENCES `school_product_approvals` (`school_product_approval_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_spsa_standard` FOREIGN KEY (`standard_id`) REFERENCES `school_standards` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `school_sections`
--
ALTER TABLE `school_sections`
  ADD CONSTRAINT `school_sections_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `school_sections_school_id_foreign` FOREIGN KEY (`school_id`) REFERENCES `schools` (`school_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `school_sections_standard_id_foreign` FOREIGN KEY (`standard_id`) REFERENCES `school_standards` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `school_sections_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `school_standards`
--
ALTER TABLE `school_standards`
  ADD CONSTRAINT `school_standards_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `school_standards_school_id_foreign` FOREIGN KEY (`school_id`) REFERENCES `schools` (`school_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `school_standards_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`) ON DELETE SET NULL;

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
  ADD CONSTRAINT `sizes_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`);

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
