-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 23, 2023 at 04:34 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `rba`
--

-- --------------------------------------------------------

--
-- Table structure for table `addresses`
--

CREATE TABLE `addresses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `username` varchar(255) DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `blocked` tinyint(1) NOT NULL DEFAULT 0,
  `role_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `name`, `email`, `username`, `email_verified_at`, `password`, `blocked`, `role_id`, `user_id`, `remember_token`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'Patrick ISHIMWE', 'test@example.com', 'patrick.ishimwe', '2023-02-04 04:22:19', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 0, 2, NULL, 'SXWeqF7gq0', NULL, '2023-02-04 04:22:19', '2023-02-04 04:22:19'),
(2, 'BYAMUNGU Lewis', 'byamungulewis@gmail.com', 'bmglewis@gmail.com', '2023-02-04 04:22:19', '$2y$10$0m94JP4m3ODWpzn2ayzdWeJKTAXdlX77m2jGNVDkcXO7PV7L6eh8O', 0, 2, NULL, '2fOmn736WIgusJkVLy9p7VT9Jqg3BnpjFW8seJoWbf8GgVFcvYcupouQdjKv', NULL, '2023-02-04 04:22:19', '2023-02-04 04:25:36'),
(3, 'NDIKUMANA Eric', 'ndikumana@gmail.com', 'eric.ndikumana', '2023-02-04 04:22:19', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 0, 2, NULL, 'CQ1SjIAkJ3', NULL, '2023-02-04 04:22:19', '2023-02-04 04:22:19'),
(13, 'Akimana Olivie', 'www.byamungulewis@gmail.com', NULL, NULL, '$2y$10$8CAKp2vydohh0eky81z59.l.ywNZPIDKcv4jBD2OugA4JMbQUnmsm', 0, 2, 17, NULL, NULL, '2023-03-19 15:30:50', '2023-03-22 07:20:27');

-- --------------------------------------------------------

--
-- Table structure for table `areas`
--

CREATE TABLE `areas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `lawscategory_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `areas`
--

INSERT INTO `areas` (`id`, `user_id`, `lawscategory_id`, `created_at`, `updated_at`) VALUES
(1, 1, 1, '2023-02-04 05:21:29', '2023-02-04 05:21:29'),
(2, 2, 1, '2023-02-04 05:22:38', '2023-02-04 05:22:38'),
(3, 3, 12, '2023-02-04 09:27:29', '2023-02-04 09:27:29');

-- --------------------------------------------------------

--
-- Table structure for table `authentication_log`
--

CREATE TABLE `authentication_log` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `authenticatable_type` varchar(255) NOT NULL,
  `authenticatable_id` bigint(20) UNSIGNED NOT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `login_at` timestamp NULL DEFAULT NULL,
  `login_successful` tinyint(1) NOT NULL DEFAULT 0,
  `logout_at` timestamp NULL DEFAULT NULL,
  `cleared_by_user` tinyint(1) NOT NULL DEFAULT 0,
  `location` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`location`))
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `authentication_log`
--

INSERT INTO `authentication_log` (`id`, `authenticatable_type`, `authenticatable_id`, `ip_address`, `user_agent`, `login_at`, `login_successful`, `logout_at`, `cleared_by_user`, `location`) VALUES
(1, 'App\\Models\\Admin', 2, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/109.0.0.0 Safari/537.36', '2023-02-04 04:25:11', 1, '2023-02-04 04:25:36', 0, NULL),
(2, 'App\\Models\\Admin', 2, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/109.0.0.0 Safari/537.36', '2023-02-04 04:25:49', 1, '2023-02-04 05:13:12', 0, NULL),
(3, 'App\\Models\\Admin', 2, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/108.0.0.0 Safari/537.36 OPR/94.0.0.0', '2023-02-04 05:11:06', 1, NULL, 0, NULL),
(4, 'App\\Models\\Admin', 2, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/109.0.0.0 Safari/537.36', '2023-02-04 05:13:40', 0, NULL, 0, NULL),
(5, 'App\\Models\\Admin', 2, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/109.0.0.0 Safari/537.36', '2023-02-04 05:13:51', 0, NULL, 0, NULL),
(6, 'App\\Models\\Admin', 2, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/109.0.0.0 Safari/537.36', '2023-02-04 05:14:56', 0, NULL, 0, NULL),
(7, 'App\\Models\\User', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/109.0.0.0 Safari/537.36', '2023-02-04 05:20:29', 1, '2023-02-04 05:21:41', 0, NULL),
(8, 'App\\Models\\User', 2, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/109.0.0.0 Safari/537.36', '2023-02-04 05:22:00', 1, '2023-02-04 05:22:45', 0, NULL),
(9, 'App\\Models\\Admin', 2, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/109.0.0.0 Safari/537.36', '2023-02-04 06:44:51', 1, '2023-02-04 09:26:08', 0, NULL),
(10, 'App\\Models\\User', 3, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/109.0.0.0 Safari/537.36', '2023-02-04 09:26:36', 1, '2023-02-04 09:26:52', 0, NULL),
(11, 'App\\Models\\User', 3, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/109.0.0.0 Safari/537.36', '2023-02-04 09:26:59', 1, NULL, 0, NULL),
(12, 'App\\Models\\Admin', 2, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/108.0.0.0 Safari/537.36 OPR/94.0.0.0', '2023-02-04 09:47:24', 1, NULL, 0, NULL),
(13, 'App\\Models\\Admin', 2, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/108.0.0.0 Safari/537.36 OPR/94.0.0.0', '2023-02-05 10:08:40', 1, NULL, 0, NULL),
(14, 'App\\Models\\Admin', 2, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/109.0.0.0 Safari/537.36', '2023-02-05 14:03:41', 1, '2023-02-05 18:10:29', 0, NULL),
(15, 'App\\Models\\User', 3, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/109.0.0.0 Safari/537.36', '2023-02-05 18:10:46', 0, NULL, 0, NULL),
(16, 'App\\Models\\User', 3, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/109.0.0.0 Safari/537.36', '2023-02-05 18:10:53', 1, NULL, 0, NULL),
(17, 'App\\Models\\Admin', 2, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/108.0.0.0 Safari/537.36 OPR/94.0.0.0', '2023-02-05 18:11:56', 1, NULL, 0, NULL),
(18, 'App\\Models\\Admin', 2, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/109.0.0.0 Safari/537.36', '2023-02-06 05:11:32', 1, NULL, 0, NULL),
(19, 'App\\Models\\User', 3, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/108.0.0.0 Safari/537.36 OPR/94.0.0.0', '2023-02-06 05:14:38', 1, NULL, 0, NULL),
(20, 'App\\Models\\Admin', 2, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/109.0.0.0 Safari/537.36', '2023-02-06 09:46:01', 1, NULL, 0, NULL),
(21, 'App\\Models\\Admin', 2, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/109.0.0.0 Safari/537.36', '2023-02-07 06:27:12', 1, NULL, 0, NULL),
(22, 'App\\Models\\Admin', 2, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/109.0.0.0 Safari/537.36', '2023-02-07 15:46:13', 1, NULL, 0, NULL),
(23, 'App\\Models\\Admin', 2, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/109.0.0.0 Safari/537.36', '2023-02-08 01:31:08', 1, NULL, 0, NULL),
(24, 'App\\Models\\Admin', 2, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/109.0.0.0 Safari/537.36', '2023-02-08 07:28:17', 1, NULL, 0, NULL),
(25, 'App\\Models\\Admin', 2, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/109.0.0.0 Safari/537.36', '2023-02-08 16:23:23', 1, NULL, 0, NULL),
(26, 'App\\Models\\Admin', 2, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/110.0.0.0 Safari/537.36', '2023-02-09 04:59:22', 1, NULL, 0, NULL),
(27, 'App\\Models\\Admin', 3, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/108.0.0.0 Safari/537.36 OPR/94.0.0.0', '2023-02-09 09:28:43', 0, NULL, 0, NULL),
(28, 'App\\Models\\Admin', 2, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/108.0.0.0 Safari/537.36 OPR/94.0.0.0', '2023-02-09 09:28:54', 1, '2023-02-09 09:43:47', 0, NULL),
(29, 'App\\Models\\User', 3, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/108.0.0.0 Safari/537.36 OPR/94.0.0.0', '2023-02-09 09:44:21', 0, NULL, 0, NULL),
(30, 'App\\Models\\User', 3, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/108.0.0.0 Safari/537.36 OPR/94.0.0.0', '2023-02-09 09:44:26', 1, NULL, 0, NULL),
(31, 'App\\Models\\User', 3, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/108.0.0.0 Safari/537.36 OPR/94.0.0.0', '2023-02-09 16:29:03', 1, NULL, 0, NULL),
(32, 'App\\Models\\User', 3, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/108.0.0.0 Safari/537.36 OPR/94.0.0.0', '2023-02-10 02:15:34', 1, '2023-02-10 03:08:41', 0, NULL),
(33, 'App\\Models\\User', 3, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/108.0.0.0 Safari/537.36 OPR/94.0.0.0', '2023-02-10 04:55:26', 1, '2023-02-10 04:56:05', 0, NULL),
(34, 'App\\Models\\Admin', 2, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/108.0.0.0 Safari/537.36 OPR/94.0.0.0', '2023-02-10 04:56:12', 1, NULL, 0, NULL),
(35, 'App\\Models\\Admin', 2, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/110.0.0.0 Safari/537.36', '2023-02-10 06:32:31', 1, NULL, 0, NULL),
(36, 'App\\Models\\Admin', 2, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/110.0.0.0 Safari/537.36', '2023-02-10 15:25:21', 1, NULL, 0, NULL),
(37, 'App\\Models\\User', 3, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/110.0.0.0 Safari/537.36', '2023-02-11 05:11:07', 1, '2023-02-11 05:43:06', 0, NULL),
(38, 'App\\Models\\Admin', 2, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/109.0.0.0 Safari/537.36 OPR/95.0.0.0', '2023-02-11 05:32:09', 1, NULL, 0, NULL),
(39, 'App\\Models\\User', 14, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/110.0.0.0 Safari/537.36', '2023-02-11 05:44:00', 1, '2023-02-11 06:03:25', 0, NULL),
(40, 'App\\Models\\User', 3, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/110.0.0.0 Safari/537.36', '2023-02-11 06:03:32', 1, '2023-02-11 09:19:48', 0, NULL),
(41, 'App\\Models\\User', 14, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/110.0.0.0 Safari/537.36', '2023-02-11 09:20:01', 1, '2023-02-11 12:08:49', 0, NULL),
(42, 'App\\Models\\Admin', 2, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/109.0.0.0 Safari/537.36 OPR/95.0.0.0', '2023-02-11 11:47:38', 1, NULL, 0, NULL),
(43, 'App\\Models\\Admin', 2, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/110.0.0.0 Safari/537.36', '2023-02-13 04:57:14', 1, NULL, 0, NULL),
(44, 'App\\Models\\User', 3, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/109.0.0.0 Safari/537.36 OPR/95.0.0.0', '2023-02-13 11:40:32', 1, NULL, 0, NULL),
(45, 'App\\Models\\Admin', 2, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/110.0.0.0 Safari/537.36', '2023-02-14 07:10:14', 1, NULL, 0, NULL),
(46, 'App\\Models\\Admin', 2, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/109.0.0.0 Safari/537.36', '2023-02-14 15:58:24', 1, NULL, 0, NULL),
(47, 'App\\Models\\Admin', 2, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/110.0.0.0 Safari/537.36', '2023-02-15 05:44:56', 0, NULL, 0, NULL),
(48, 'App\\Models\\Admin', 2, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/110.0.0.0 Safari/537.36', '2023-02-15 05:45:03', 1, NULL, 0, NULL),
(49, 'App\\Models\\Admin', 2, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/110.0.0.0 Safari/537.36', '2023-02-15 10:11:18', 1, NULL, 0, NULL),
(50, 'App\\Models\\Admin', 2, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/110.0.0.0 Safari/537.36', '2023-02-15 10:54:39', 1, NULL, 0, NULL),
(51, 'App\\Models\\Admin', 2, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/110.0.0.0 Safari/537.36', '2023-02-16 04:27:52', 1, NULL, 0, NULL),
(52, 'App\\Models\\User', 3, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/109.0.0.0 Safari/537.36 OPR/95.0.0.0', '2023-02-16 08:24:07', 1, '2023-02-16 08:24:23', 0, NULL),
(53, 'App\\Models\\Admin', 2, '127.0.0.1', 'Mozilla/5.0 (Linux; Android 6.0; Nexus 5 Build/MRA58N) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/110.0.0.0 Mobile Safari/537.36', '2023-02-16 14:16:42', 1, '2023-02-16 14:18:24', 0, NULL),
(54, 'App\\Models\\Admin', 2, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/110.0.0.0 Safari/537.36', '2023-02-17 04:07:45', 1, NULL, 0, NULL),
(55, 'App\\Models\\User', 3, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/109.0.0.0 Safari/537.36 OPR/95.0.0.0', '2023-02-17 04:08:37', 1, NULL, 0, NULL),
(56, 'App\\Models\\Admin', 2, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/110.0.0.0 Safari/537.36', '2023-02-17 16:02:50', 1, NULL, 0, NULL),
(57, 'App\\Models\\Admin', 2, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/110.0.0.0 Safari/537.36', '2023-02-18 05:11:48', 1, '2023-02-18 11:49:41', 0, NULL),
(58, 'App\\Models\\Admin', 2, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/110.0.0.0 Safari/537.36', '2023-02-21 13:06:20', 1, NULL, 0, NULL),
(59, 'App\\Models\\Admin', 2, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/110.0.0.0 Safari/537.36', '2023-02-22 04:28:56', 1, NULL, 0, NULL),
(60, 'App\\Models\\User', 3, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/109.0.0.0 Safari/537.36 OPR/95.0.0.0', '2023-02-22 06:02:58', 1, NULL, 0, NULL),
(61, 'App\\Models\\Admin', 2, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/110.0.0.0 Safari/537.36', '2023-02-22 11:25:43', 1, NULL, 0, NULL),
(62, 'App\\Models\\Admin', 2, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/110.0.0.0 Safari/537.36', '2023-02-22 16:31:47', 1, NULL, 0, NULL),
(63, 'App\\Models\\User', 3, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/109.0.0.0 Safari/537.36 OPR/95.0.0.0', '2023-02-22 17:44:10', 1, NULL, 0, NULL),
(64, 'App\\Models\\Admin', 2, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/110.0.0.0 Safari/537.36', '2023-02-23 02:36:24', 1, NULL, 0, NULL),
(65, 'App\\Models\\User', 3, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/109.0.0.0 Safari/537.36 OPR/95.0.0.0', '2023-02-23 02:39:01', 1, NULL, 0, NULL),
(66, 'App\\Models\\User', 16, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/109.0.0.0 Safari/537.36', '2023-02-23 02:43:34', 1, '2023-02-23 02:43:54', 0, NULL),
(67, 'App\\Models\\User', 16, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/109.0.0.0 Safari/537.36', '2023-02-23 02:44:16', 1, NULL, 0, NULL),
(68, 'App\\Models\\User', 7, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/110.0.0.0 Safari/537.36 Edg/110.0.1587.50', '2023-02-23 04:47:15', 1, NULL, 0, NULL),
(69, 'App\\Models\\Admin', 2, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/110.0.0.0 Safari/537.36', '2023-02-23 08:03:27', 1, NULL, 0, NULL),
(70, 'App\\Models\\Admin', 2, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/110.0.0.0 Safari/537.36', '2023-02-23 10:18:47', 1, NULL, 0, NULL),
(71, 'App\\Models\\User', 3, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/109.0.0.0 Safari/537.36 OPR/95.0.0.0', '2023-02-23 12:16:30', 1, NULL, 0, NULL),
(72, 'App\\Models\\User', 3, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/109.0.0.0 Safari/537.36 OPR/95.0.0.0', '2023-02-24 05:35:32', 1, NULL, 0, NULL),
(73, 'App\\Models\\User', 7, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/110.0.0.0 Safari/537.36 Edg/110.0.1587.50', '2023-02-24 05:35:51', 1, NULL, 0, NULL),
(74, 'App\\Models\\User', 16, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/109.0.0.0 Safari/537.36', '2023-02-24 05:36:32', 1, NULL, 0, NULL),
(75, 'App\\Models\\Admin', 2, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/110.0.0.0 Safari/537.36', '2023-02-24 05:37:39', 1, '2023-02-24 07:10:02', 0, NULL),
(76, 'App\\Models\\User', 14, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/110.0.0.0 Safari/537.36', '2023-02-24 06:53:14', 1, '2023-02-24 07:10:02', 0, NULL),
(77, 'App\\Models\\Admin', 2, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/110.0.0.0 Safari/537.36', '2023-02-24 07:17:33', 1, '2023-02-24 11:45:07', 0, NULL),
(78, 'App\\Models\\Admin', 2, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/110.0.0.0 Safari/537.36', '2023-02-24 12:39:00', 1, NULL, 0, NULL),
(79, 'App\\Models\\User', 3, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/109.0.0.0 Safari/537.36 OPR/95.0.0.0', '2023-02-24 13:46:19', 1, NULL, 0, NULL),
(80, 'App\\Models\\Admin', 2, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/110.0.0.0 Safari/537.36', '2023-02-24 17:55:09', 1, NULL, 0, NULL),
(81, 'App\\Models\\Admin', 2, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/110.0.0.0 Safari/537.36', '2023-02-25 04:18:52', 1, '2023-02-25 07:55:02', 0, NULL),
(82, 'App\\Models\\Admin', 2, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/110.0.0.0 Safari/537.36', '2023-02-25 07:58:55', 1, NULL, 0, NULL),
(83, 'App\\Models\\Admin', 2, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/110.0.0.0 Safari/537.36', '2023-02-26 15:42:12', 1, '2023-02-26 16:56:13', 0, NULL),
(84, 'App\\Models\\Admin', 2, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/110.0.0.0 Safari/537.36', '2023-02-26 16:56:25', 1, '2023-02-26 16:59:19', 0, NULL),
(85, 'App\\Models\\Admin', 2, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/110.0.0.0 Safari/537.36', '2023-02-27 04:17:31', 1, NULL, 0, NULL),
(86, 'App\\Models\\Admin', 2, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/110.0.0.0 Safari/537.36', '2023-02-28 05:22:58', 1, NULL, 0, NULL),
(87, 'App\\Models\\Admin', 2, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/110.0.0.0 Safari/537.36', '2023-02-28 09:39:10', 1, NULL, 0, NULL),
(88, 'App\\Models\\Admin', 2, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/110.0.0.0 Safari/537.36', '2023-03-01 04:39:27', 1, NULL, 0, NULL),
(89, 'App\\Models\\Admin', 2, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/111.0.0.0 Safari/537.36', '2023-03-13 03:12:04', 1, NULL, 0, NULL),
(90, 'App\\Models\\User', 17, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/110.0.0.0 Safari/537.36 Edg/110.0.1587.69', '2023-03-13 11:41:28', 1, '2023-03-13 11:42:14', 0, NULL),
(91, 'App\\Models\\User', 17, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/110.0.0.0 Safari/537.36 Edg/110.0.1587.69', '2023-03-13 11:42:23', 1, NULL, 0, NULL),
(92, 'App\\Models\\Admin', 2, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/111.0.0.0 Safari/537.36', '2023-03-13 16:11:08', 1, NULL, 0, NULL),
(93, 'App\\Models\\User', 17, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/110.0.0.0 Safari/537.36 Edg/110.0.1587.69', '2023-03-13 16:12:30', 1, NULL, 0, NULL),
(94, 'App\\Models\\Admin', 2, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/111.0.0.0 Safari/537.36', '2023-03-13 17:49:45', 0, '2023-03-13 17:50:43', 0, NULL),
(95, 'App\\Models\\User', 12, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/111.0.0.0 Safari/537.36', '2023-03-13 17:50:15', 1, '2023-03-13 17:50:43', 0, NULL),
(96, 'App\\Models\\Admin', 2, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/111.0.0.0 Safari/537.36', '2023-03-13 17:51:01', 1, NULL, 0, NULL),
(97, 'App\\Models\\Admin', 2, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/111.0.0.0 Safari/537.36', '2023-03-14 06:54:00', 1, NULL, 0, NULL),
(98, 'App\\Models\\User', 17, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/110.0.0.0 Safari/537.36 Edg/110.0.1587.69', '2023-03-14 07:45:12', 1, NULL, 0, NULL),
(99, 'App\\Models\\Admin', 2, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/111.0.0.0 Safari/537.36', '2023-03-16 13:15:42', 1, NULL, 0, NULL),
(100, 'App\\Models\\Admin', 2, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/111.0.0.0 Safari/537.36', '2023-03-18 12:41:27', 1, '2023-03-18 15:08:58', 0, NULL),
(101, 'App\\Models\\User', 3, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/111.0.0.0 Safari/537.36', '2023-03-18 15:09:10', 0, NULL, 0, NULL),
(102, 'App\\Models\\User', 3, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/111.0.0.0 Safari/537.36', '2023-03-18 15:09:15', 1, '2023-03-18 15:09:30', 0, NULL),
(103, 'App\\Models\\Admin', 2, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/111.0.0.0 Safari/537.36', '2023-03-18 15:09:37', 1, '2023-03-18 07:24:30', 0, NULL),
(104, 'App\\Models\\Admin', 5, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/111.0.0.0 Safari/537.36', '2023-03-18 15:10:44', 1, '2023-03-18 15:11:37', 0, NULL),
(105, 'App\\Models\\Admin', 5, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/111.0.0.0 Safari/537.36', '2023-03-18 15:11:45', 1, NULL, 0, NULL),
(106, 'App\\Models\\Admin', 2, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/111.0.0.0 Safari/537.36', '2023-03-18 07:10:50', 1, NULL, 0, NULL),
(107, 'App\\Models\\Admin', 2, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/111.0.0.0 Safari/537.36', '2023-03-18 07:12:42', 0, NULL, 0, NULL),
(108, 'App\\Models\\Admin', 2, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/111.0.0.0 Safari/537.36', '2023-03-18 07:12:56', 1, NULL, 0, NULL),
(109, 'App\\Models\\User', 6, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/111.0.0.0 Safari/537.36', '2023-03-18 07:22:55', 0, NULL, 0, NULL),
(110, 'App\\Models\\User', 6, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/111.0.0.0 Safari/537.36', '2023-03-18 07:23:01', 1, '2023-03-18 07:23:42', 0, NULL),
(111, 'App\\Models\\User', 6, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/111.0.0.0 Safari/537.36', '2023-03-18 07:24:16', 0, NULL, 0, NULL),
(112, 'App\\Models\\User', 6, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/111.0.0.0 Safari/537.36', '2023-03-18 07:24:22', 1, '2023-03-18 07:24:30', 0, NULL),
(113, 'App\\Models\\User', 6, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/111.0.0.0 Safari/537.36 Edg/111.0.1661.41', '2023-03-18 07:24:56', 1, '2023-03-18 09:36:32', 0, NULL),
(114, 'App\\Models\\Admin', 2, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/111.0.0.0 Safari/537.36', '2023-03-18 07:25:51', 1, NULL, 0, NULL),
(115, 'App\\Models\\Admin', 6, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/111.0.0.0 Safari/537.36 Edg/111.0.1661.41', '2023-03-18 09:36:40', 1, '2023-03-18 09:37:00', 0, NULL),
(116, 'App\\Models\\Admin', 2, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/111.0.0.0 Safari/537.36', '2023-03-18 15:16:36', 1, NULL, 0, NULL),
(117, 'App\\Models\\Admin', 2, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/111.0.0.0 Safari/537.36', '2023-03-18 18:05:03', 1, NULL, 0, NULL),
(118, 'App\\Models\\Admin', 2, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/111.0.0.0 Safari/537.36', '2023-03-18 18:06:18', 1, NULL, 0, NULL),
(119, 'App\\Models\\Admin', 2, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/111.0.0.0 Safari/537.36', '2023-03-18 18:08:38', 1, '2023-03-18 18:25:33', 0, NULL),
(120, 'App\\Models\\Admin', 2, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/111.0.0.0 Safari/537.36', '2023-03-18 18:25:52', 1, '2023-03-18 20:39:56', 0, NULL),
(121, 'App\\Models\\Admin', 2, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/111.0.0.0 Safari/537.36', '2023-03-19 05:01:03', 1, NULL, 0, NULL),
(122, 'App\\Models\\User', 17, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/110.0.0.0 Safari/537.36 OPR/96.0.0.0', '2023-03-19 05:47:41', 1, NULL, 0, NULL),
(123, 'App\\Models\\Admin', 2, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/111.0.0.0 Safari/537.36', '2023-03-19 13:56:54', 1, NULL, 0, NULL),
(124, 'App\\Models\\Admin', 2, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/111.0.0.0 Safari/537.36', '2023-03-20 04:58:52', 1, '2023-03-20 06:37:27', 0, NULL),
(125, 'App\\Models\\Admin', 13, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/110.0.0.0 Safari/537.36 OPR/96.0.0.0', '2023-03-20 05:17:55', 1, '2023-03-20 05:18:21', 0, NULL),
(126, 'App\\Models\\Admin', 13, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/110.0.0.0 Safari/537.36 OPR/96.0.0.0', '2023-03-20 05:18:38', 1, '2023-03-20 05:20:37', 0, NULL),
(127, 'App\\Models\\Admin', 2, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/111.0.0.0 Safari/537.36', '2023-03-20 17:20:52', 1, '2023-03-20 17:22:51', 0, NULL),
(128, 'App\\Models\\User', 3, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/111.0.0.0 Safari/537.36', '2023-03-20 17:23:00', 0, NULL, 0, NULL),
(129, 'App\\Models\\User', 3, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/111.0.0.0 Safari/537.36', '2023-03-20 17:23:09', 0, NULL, 0, NULL),
(130, 'App\\Models\\User', 3, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/111.0.0.0 Safari/537.36', '2023-03-20 17:23:18', 0, NULL, 0, NULL),
(131, 'App\\Models\\User', 3, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/111.0.0.0 Safari/537.36', '2023-03-20 17:23:23', 0, NULL, 0, NULL),
(132, 'App\\Models\\User', 3, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/111.0.0.0 Safari/537.36', '2023-03-20 17:23:28', 1, '2023-03-20 17:30:49', 0, NULL),
(133, 'App\\Models\\Admin', 2, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/111.0.0.0 Safari/537.36', '2023-03-20 17:30:54', 1, '2023-03-20 17:56:10', 0, NULL),
(134, 'App\\Models\\User', 3, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/111.0.0.0 Safari/537.36', '2023-03-20 17:56:15', 1, NULL, 0, NULL),
(135, 'App\\Models\\Admin', 2, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/111.0.0.0 Safari/537.36', '2023-03-21 08:53:55', 1, NULL, 0, NULL),
(136, 'App\\Models\\Admin', 2, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/111.0.0.0 Safari/537.36', '2023-03-22 07:19:34', 1, NULL, 0, NULL),
(137, 'App\\Models\\Admin', 2, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/111.0.0.0 Safari/537.36', '2023-03-22 08:44:00', 1, '2023-03-22 08:45:02', 0, NULL),
(138, 'App\\Models\\Admin', 2, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/111.0.0.0 Safari/537.36', '2023-03-22 09:01:20', 1, NULL, 0, NULL),
(139, 'App\\Models\\User', 16, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/110.0.0.0 Safari/537.36 OPR/96.0.0.0', '2023-03-22 09:11:21', 0, NULL, 0, NULL),
(140, 'App\\Models\\User', 16, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/110.0.0.0 Safari/537.36 OPR/96.0.0.0', '2023-03-22 09:11:28', 1, NULL, 0, NULL),
(141, 'App\\Models\\Admin', 2, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/111.0.0.0 Safari/537.36', '2023-03-23 03:29:39', 1, NULL, 0, NULL),
(142, 'App\\Models\\Admin', 2, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/111.0.0.0 Safari/537.36', '2023-03-23 03:36:20', 1, '2023-03-23 03:36:28', 0, NULL),
(143, 'App\\Models\\Admin', 2, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/111.0.0.0 Safari/537.36', '2023-03-23 03:43:18', 1, NULL, 0, NULL),
(144, 'App\\Models\\User', 3, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/111.0.0.0 Safari/537.36 Edg/111.0.1661.44', '2023-03-23 04:14:56', 1, NULL, 0, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `bookings`
--

CREATE TABLE `bookings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `training` bigint(20) UNSIGNED NOT NULL,
  `advocate` bigint(20) UNSIGNED NOT NULL,
  `booked` tinyint(1) NOT NULL DEFAULT 0,
  `confirm` tinyint(1) NOT NULL DEFAULT 0,
  `status` enum('1','2','3','4') DEFAULT NULL,
  `yearInBar` int(11) NOT NULL,
  `cumulatedCredit` decimal(8,2) DEFAULT NULL,
  `attendanceDay` date DEFAULT NULL,
  `voucherNumber` bigint(20) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `bookings`
--

INSERT INTO `bookings` (`id`, `training`, `advocate`, `booked`, `confirm`, `status`, `yearInBar`, `cumulatedCredit`, `attendanceDay`, `voucherNumber`, `created_at`, `updated_at`) VALUES
(1, 1, 15, 0, 0, '3', 2023, '2.00', '2023-03-14', 6430028, '2023-03-01 09:20:47', '2023-03-13 18:30:42'),
(2, 1, 12, 0, 0, '3', 2023, '2.00', '2023-03-14', 5407053, '2023-03-01 09:20:47', '2023-03-13 18:30:42'),
(3, 1, 16, 0, 0, '3', 2023, '2.00', '2023-03-14', 6042928, '2023-03-01 09:20:47', '2023-03-13 18:30:42'),
(4, 3, 1, 0, 0, '3', 2023, '3.00', '2023-03-23', 8121639, '2023-03-13 08:58:44', '2023-03-23 05:50:38'),
(5, 3, 12, 0, 0, '3', 2023, '3.00', '2023-03-23', 7804318, '2023-03-13 08:58:44', '2023-03-23 05:50:38'),
(6, 3, 16, 0, 0, '3', 2023, '3.00', '2023-03-23', 3975551, '2023-03-13 08:58:44', '2023-03-23 05:50:38'),
(7, 3, 17, 0, 0, '3', 2023, '3.00', '2023-03-23', 3807363, '2023-03-13 16:13:52', '2023-03-23 05:50:39'),
(8, 3, 7, 0, 0, '3', 2023, '3.00', '2023-03-23', 5520690, '2023-03-13 16:28:19', '2023-03-23 05:50:39'),
(9, 1, 17, 1, 1, '2', 2023, '2.00', '2023-03-14', 7673894, '2023-03-13 16:48:28', '2023-03-13 18:30:42'),
(10, 4, 16, 1, 1, '2', 2023, '2.00', '2023-03-24', 1973954, '2023-03-22 09:12:03', '2023-03-23 11:09:49'),
(11, 3, 3, 0, 0, '3', 2023, '3.00', '2023-03-23', 8663225, '2023-03-23 05:42:00', '2023-03-23 05:50:39'),
(12, 2, 3, 0, 0, '3', 2023, '2.00', NULL, NULL, '2023-03-23 05:53:06', '2023-03-23 05:53:06'),
(13, 4, 3, 0, 0, '3', 2023, '2.00', '2023-03-24', 4799026, '2023-03-23 08:37:25', '2023-03-23 11:09:49');

-- --------------------------------------------------------

--
-- Table structure for table `compliances`
--

CREATE TABLE `compliances` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `year` int(11) NOT NULL,
  `cle_credits` decimal(8,2) DEFAULT 0.00,
  `meeting_credits` decimal(8,2) DEFAULT 0.00,
  `extra_credits` decimal(8,2) DEFAULT 0.00,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `created_by` bigint(20) UNSIGNED NOT NULL,
  `update_by` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `compliances`
--

INSERT INTO `compliances` (`id`, `year`, `cle_credits`, `meeting_credits`, `extra_credits`, `user_id`, `created_by`, `update_by`, `created_at`, `updated_at`) VALUES
(5, 2023, '7.00', '0.00', '0.00', 16, 2, 2, '2023-03-23 09:01:10', '2023-03-23 11:09:49'),
(6, 2023, '7.00', '5.00', '3.35', 3, 2, 2, '2023-03-23 10:44:44', '2023-03-23 11:09:49');

-- --------------------------------------------------------

--
-- Table structure for table `contribute_advocates`
--

CREATE TABLE `contribute_advocates` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `amount` varchar(255) NOT NULL,
  `transction_type` varchar(255) NOT NULL,
  `reference_no` varchar(255) NOT NULL,
  `transction_date` varchar(255) NOT NULL,
  `advocate` bigint(20) UNSIGNED NOT NULL,
  `contribution` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `contribute_advocates`
--

INSERT INTO `contribute_advocates` (`id`, `amount`, `transction_type`, `reference_no`, `transction_date`, `advocate`, `contribution`, `created_at`, `updated_at`) VALUES
(1, '7000000', 'REFUND', 'U7677HHHHk', '2023-03-02', 7, 1, '2023-03-01 12:27:56', '2023-03-01 12:27:56');

-- --------------------------------------------------------

--
-- Table structure for table `contributions`
--

CREATE TABLE `contributions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `start_period` date NOT NULL,
  `end_period` date NOT NULL,
  `deadline` date NOT NULL,
  `amount` varchar(255) NOT NULL,
  `percentage` decimal(8,2) NOT NULL,
  `concern` varchar(255) NOT NULL,
  `yearInBar` int(11) NOT NULL,
  `createdBy` bigint(20) UNSIGNED NOT NULL,
  `updateby` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `contributions`
--

INSERT INTO `contributions` (`id`, `name`, `start_period`, `end_period`, `deadline`, `amount`, `percentage`, `concern`, `yearInBar`, `createdBy`, `updateby`, `created_at`, `updated_at`) VALUES
(1, 'Contribution 2023', '2023-02-01', '2023-01-31', '2023-03-25', '7,000,000', '20.30', '1,2', 2023, 2, NULL, '2023-03-01 06:47:57', '2023-03-01 06:47:57');

-- --------------------------------------------------------

--
-- Table structure for table `discipline`
--

CREATE TABLE `discipline` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `p_name` varchar(255) DEFAULT NULL,
  `p_email` varchar(255) DEFAULT NULL,
  `p_phone` varchar(255) DEFAULT NULL,
  `p_advocate` int(11) DEFAULT NULL,
  `d_name` varchar(255) DEFAULT NULL,
  `d_email` varchar(255) DEFAULT NULL,
  `d_phone` varchar(255) DEFAULT NULL,
  `d_advocate` int(11) DEFAULT NULL,
  `case_number` varchar(255) NOT NULL,
  `case_type` enum('1','2','3') NOT NULL,
  `complaint` varchar(255) NOT NULL,
  `sammary` longtext NOT NULL,
  `case_status` enum('OPEN','CLOSED') NOT NULL DEFAULT 'OPEN',
  `authority` enum('BATONIER','DISCIPLINARY COMMITEE') NOT NULL DEFAULT 'BATONIER',
  `register` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `discipline`
--

INSERT INTO `discipline` (`id`, `p_name`, `p_email`, `p_phone`, `p_advocate`, `d_name`, `d_email`, `d_phone`, `d_advocate`, `case_number`, `case_type`, `complaint`, `sammary`, `case_status`, `authority`, `register`, `created_at`, `updated_at`) VALUES
(1, 'BYAMUNGU Lewis', 'byamungulewis@gmail.com', '0785436135', NULL, 'Aliane NIYONASENZE', 'alianeniyo03@gmail.com', NULL, 3, 'DC/1/2023', '1', 'Test New CaSHH', 'attach_file attach_file attach_file attach_file', 'OPEN', 'BATONIER', 2, '2023-03-13 10:28:57', '2023-03-13 10:28:57'),
(2, 'UMWIZAWASE Fanny', 'umwizawase@gmail.com', NULL, 14, 'Lewis Test', 'newuser@gmail.com', '0784666777', NULL, 'DC/2/2023', '2', 'Test New CaSHH', 'Baramfata Ibintu Byinshi', 'OPEN', 'BATONIER', 2, '2023-03-13 10:29:50', '2023-03-13 10:29:50'),
(3, 'Sugira Yves', 'sugira@gmail.com', NULL, 6, 'Akimana Olivie', 'www.byamungulewis@gmail.com', NULL, 17, 'DC/3/2023', '3', 'Case ikomeye', 'Case ikomeye Case ikomeye Case ikomeyeCase ikomeyeCase ikomeyeCase ikomeye', 'OPEN', 'BATONIER', 2, '2023-03-13 10:30:25', '2023-03-13 10:30:25'),
(4, 'Byamungu', 'byamungulewis@gmail.com', '0785436135', NULL, 'Akimana Olivie', 'www.byamungulewis@gmail.com', NULL, 17, 'DC/4/2023', '1', 'Just compaint', 'Just compaint Just compaint Just compaint', 'OPEN', 'BATONIER', 2, '2023-03-21 10:51:28', '2023-03-21 10:51:28');

-- --------------------------------------------------------

--
-- Table structure for table `discipline_participants`
--

CREATE TABLE `discipline_participants` (
  `table_id` bigint(20) UNSIGNED NOT NULL,
  `discipline_case` bigint(20) NOT NULL,
  `advocate` bigint(20) NOT NULL,
  `role` enum('Plaintiff','Defendant') NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `discipline_participants`
--

INSERT INTO `discipline_participants` (`table_id`, `discipline_case`, `advocate`, `role`, `created_at`, `updated_at`) VALUES
(1, 1, 3, 'Plaintiff', '2023-03-13 10:28:57', '2023-03-13 10:28:57'),
(2, 2, 14, 'Defendant', '2023-03-13 10:29:50', '2023-03-13 10:29:50'),
(3, 3, 6, 'Plaintiff', '2023-03-13 10:30:25', '2023-03-13 10:30:25'),
(4, 3, 17, 'Defendant', '2023-03-13 10:30:25', '2023-03-13 10:30:25'),
(5, 4, 17, 'Plaintiff', '2023-03-21 10:51:28', '2023-03-21 10:51:28');

-- --------------------------------------------------------

--
-- Table structure for table `discipline_sittings`
--

CREATE TABLE `discipline_sittings` (
  `sitting_id` bigint(20) UNSIGNED NOT NULL,
  `category` varchar(255) NOT NULL,
  `sittingDay` varchar(255) NOT NULL DEFAULT 'NONE',
  `sittingTime` varchar(255) NOT NULL DEFAULT 'NONE',
  `sittingVenue` varchar(255) NOT NULL DEFAULT 'NONE',
  `discipline_case` bigint(20) UNSIGNED NOT NULL,
  `decisionCategory` varchar(255) DEFAULT NULL,
  `targetedAdvocate` varchar(255) DEFAULT NULL,
  `comment` longtext DEFAULT NULL,
  `attach_file` varchar(255) DEFAULT NULL,
  `scheduledBy` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `discipline_sittings`
--

INSERT INTO `discipline_sittings` (`sitting_id`, `category`, `sittingDay`, `sittingTime`, `sittingVenue`, `discipline_case`, `decisionCategory`, `targetedAdvocate`, `comment`, `attach_file`, `scheduledBy`, `created_at`, `updated_at`) VALUES
(1, 'Hearing by BATONIER', '2023-03-14', '17:05', 'Online', 1, 'Referral to discipline commitee', 'Aliane NIYONASENZE', 'Here Some Things', '130405-CoverPage.docx', 2, NULL, '2023-03-13 11:04:06'),
(2, '', 'NONE', 'NONE', 'NONE', 2, NULL, NULL, NULL, NULL, 2, NULL, NULL),
(3, '', 'NONE', 'NONE', 'NONE', 3, NULL, NULL, NULL, NULL, 2, NULL, NULL),
(4, '', 'NONE', 'NONE', 'NONE', 4, NULL, NULL, NULL, NULL, 2, '2023-03-21 10:51:28', '2023-03-21 10:51:28');

-- --------------------------------------------------------

--
-- Table structure for table `extra_cles`
--

CREATE TABLE `extra_cles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `closing_date` date NOT NULL,
  `category` varchar(255) NOT NULL,
  `hours` int(11) NOT NULL,
  `credits` decimal(8,2) NOT NULL,
  `advocate` bigint(20) UNSIGNED NOT NULL,
  `yearInBar` int(11) NOT NULL DEFAULT 2023,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `extra_cles`
--

INSERT INTO `extra_cles` (`id`, `title`, `closing_date`, `category`, `hours`, `credits`, `advocate`, `yearInBar`, `created_at`, `updated_at`) VALUES
(1, 'Meeting OSIR', '2023-03-13', 'Publication', 30, '2.01', 17, 2023, '2023-03-14 07:00:00', '2023-03-14 07:00:00'),
(2, 'Others', '2023-03-07', 'CLE', 26, '1.74', 17, 2023, '2023-03-14 07:02:17', '2023-03-14 07:02:17'),
(6, 'extra train', '2023-03-24', 'CLE', 20, '1.34', 3, 2023, '2023-03-23 11:08:02', '2023-03-23 11:08:02'),
(7, 'second', '2023-03-24', 'CLE', 30, '2.01', 3, 2023, '2023-03-23 11:08:28', '2023-03-23 11:08:28');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `invitation`
--

CREATE TABLE `invitation` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `meeting_id` int(11) NOT NULL,
  `credit` decimal(8,2) NOT NULL DEFAULT 0.00,
  `status` int(11) NOT NULL,
  `yearInBar` int(11) NOT NULL DEFAULT 2023,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `invitation`
--

INSERT INTO `invitation` (`id`, `user_id`, `meeting_id`, `credit`, `status`, `yearInBar`, `created_at`, `updated_at`) VALUES
(1, 1, 1, '0.00', 1, 2023, '2023-03-14 08:20:14', '2023-03-14 08:20:14'),
(2, 3, 1, '3.00', 2, 2023, '2023-03-14 08:20:14', '2023-03-23 08:31:46'),
(3, 6, 1, '0.00', 1, 2023, '2023-03-14 08:20:14', '2023-03-14 08:20:14'),
(4, 7, 1, '0.00', 1, 2023, '2023-03-14 08:20:14', '2023-03-14 08:20:14'),
(5, 10, 1, '0.00', 1, 2023, '2023-03-14 08:20:14', '2023-03-14 08:20:14'),
(6, 12, 1, '0.00', 1, 2023, '2023-03-14 08:20:14', '2023-03-14 08:20:14'),
(7, 14, 1, '0.00', 1, 2023, '2023-03-14 08:20:14', '2023-03-14 08:20:14'),
(8, 16, 1, '0.00', 1, 2023, '2023-03-14 08:20:14', '2023-03-14 08:20:14'),
(9, 17, 1, '2.00', 2, 2023, '2023-03-14 08:20:14', '2023-03-14 08:20:50'),
(10, 3, 2, '2.00', 2, 2023, '2023-03-23 07:36:10', '2023-03-23 11:09:07'),
(11, 7, 2, '0.00', 1, 2023, '2023-03-23 07:36:56', '2023-03-23 07:36:56');

-- --------------------------------------------------------

--
-- Table structure for table `lawscategories`
--

CREATE TABLE `lawscategories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `lawscategories`
--

INSERT INTO `lawscategories` (`id`, `title`, `description`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'Administrative law', NULL, NULL, '2023-02-04 04:22:21', '2023-02-04 04:22:21'),
(2, 'Admiralty (or maritime) law', NULL, NULL, '2023-02-04 04:22:21', '2023-02-04 04:22:21'),
(3, 'Advertising law', NULL, NULL, '2023-02-04 04:22:21', '2023-02-04 04:22:21'),
(4, 'Agency law', NULL, NULL, '2023-02-04 04:22:21', '2023-02-04 04:22:21'),
(5, 'Alcohol law', NULL, NULL, '2023-02-04 04:22:21', '2023-02-04 04:22:21'),
(6, 'Alternative dispute resolution', NULL, NULL, '2023-02-04 04:22:21', '2023-02-04 04:22:21'),
(7, 'Animal law', NULL, NULL, '2023-02-04 04:22:21', '2023-02-04 04:22:21'),
(8, 'Antitrust law (or competition law)', NULL, NULL, '2023-02-04 04:22:21', '2023-02-04 04:22:21'),
(9, 'Appellate practice', NULL, NULL, '2023-02-04 04:22:21', '2023-02-04 04:22:21'),
(10, 'Art law (or art and culture law)', NULL, NULL, '2023-02-04 04:22:21', '2023-02-04 04:22:21'),
(11, 'Aviation law', NULL, NULL, '2023-02-04 04:22:21', '2023-02-04 04:22:21'),
(12, 'Banking law', NULL, NULL, '2023-02-04 04:22:21', '2023-02-04 04:22:21'),
(13, 'Bankruptcy law(creditor debtor rights,insolvency reorganization)', NULL, NULL, '2023-02-04 04:22:21', '2023-02-04 04:22:21'),
(14, 'Bioethics', NULL, NULL, '2023-02-04 04:22:21', '2023-02-04 04:22:21'),
(15, 'Business law (or commercial law); also commercial litigation', NULL, NULL, '2023-02-04 04:22:21', '2023-02-04 04:22:21'),
(16, 'Business organizations law (or companies law)', NULL, NULL, '2023-02-04 04:22:21', '2023-02-04 04:22:21'),
(17, 'Civil law or common law', NULL, NULL, '2023-02-04 04:22:21', '2023-02-04 04:22:21'),
(18, 'Class action litigation/Mass tort litigation', NULL, NULL, '2023-02-04 04:22:21', '2023-02-04 04:22:21'),
(19, 'Communications law', NULL, NULL, '2023-02-04 04:22:21', '2023-02-04 04:22:21'),
(20, 'Computer law', NULL, NULL, '2023-02-04 04:22:21', '2023-02-04 04:22:21'),
(21, 'Conflict of law (or private international law)', NULL, NULL, '2023-02-04 04:22:21', '2023-02-04 04:22:21'),
(22, 'Constitutional law', NULL, NULL, '2023-02-04 04:22:21', '2023-02-04 04:22:21'),
(23, 'Construction law', NULL, NULL, '2023-02-04 04:22:21', '2023-02-04 04:22:21'),
(24, 'Consumer law', NULL, NULL, '2023-02-04 04:22:21', '2023-02-04 04:22:21'),
(25, 'Contract law', NULL, NULL, '2023-02-04 04:22:21', '2023-02-04 04:22:21'),
(26, 'Copyright law', NULL, NULL, '2023-02-04 04:22:21', '2023-02-04 04:22:21'),
(27, 'Corporate law (or company law)\", \"Corporate compliance law', NULL, NULL, '2023-02-04 04:22:21', '2023-02-04 04:22:21'),
(28, 'Corporate governance law', NULL, NULL, '2023-02-04 04:22:21', '2023-02-04 04:22:21'),
(29, 'Criminal law', NULL, NULL, '2023-02-04 04:22:21', '2023-02-04 04:22:21'),
(30, 'Cryptography law', NULL, NULL, '2023-02-04 04:22:21', '2023-02-04 04:22:21'),
(31, 'Cultural property law', NULL, NULL, '2023-02-04 04:22:21', '2023-02-04 04:22:21'),
(32, 'Custom law', NULL, NULL, '2023-02-04 04:22:21', '2023-02-04 04:22:21'),
(33, 'Cyber law', NULL, NULL, '2023-02-04 04:22:21', '2023-02-04 04:22:21'),
(34, 'Defamation', NULL, NULL, '2023-02-04 04:22:21', '2023-02-04 04:22:21'),
(35, 'Derivatives and futures law', NULL, NULL, '2023-02-04 04:22:21', '2023-02-04 04:22:21'),
(36, 'Drug control law', NULL, NULL, '2023-02-04 04:22:21', '2023-02-04 04:22:21'),
(37, 'Elder law', NULL, NULL, '2023-02-04 04:22:21', '2023-02-04 04:22:21'),
(38, 'Employee benefits law', NULL, NULL, '2023-02-04 04:22:21', '2023-02-04 04:22:21'),
(39, 'Employment law', NULL, NULL, '2023-02-04 04:22:21', '2023-02-04 04:22:21'),
(40, 'Energy law', NULL, NULL, '2023-02-04 04:22:21', '2023-02-04 04:22:21'),
(41, 'Entertainment law', NULL, NULL, '2023-02-04 04:22:21', '2023-02-04 04:22:21'),
(42, 'Environmental law', NULL, NULL, '2023-02-04 04:22:21', '2023-02-04 04:22:21'),
(43, 'Equipment finance law', NULL, NULL, '2023-02-04 04:22:21', '2023-02-04 04:22:21'),
(44, 'Evidence', NULL, NULL, '2023-02-04 04:22:21', '2023-02-04 04:22:21'),
(45, 'Family law', NULL, NULL, '2023-02-04 04:22:21', '2023-02-04 04:22:21'),
(46, 'FDA law', NULL, NULL, '2023-02-04 04:22:21', '2023-02-04 04:22:21'),
(47, 'Financial services regulation law', NULL, NULL, '2023-02-04 04:22:21', '2023-02-04 04:22:21'),
(48, 'Firearm law', NULL, NULL, '2023-02-04 04:22:21', '2023-02-04 04:22:21'),
(49, 'Food law', NULL, NULL, '2023-02-04 04:22:21', '2023-02-04 04:22:21'),
(50, 'Franchise law', NULL, NULL, '2023-02-04 04:22:21', '2023-02-04 04:22:21'),
(51, 'Gaming law', NULL, NULL, '2023-02-04 04:22:21', '2023-02-04 04:22:21'),
(52, 'Health law', NULL, NULL, '2023-02-04 04:22:21', '2023-02-04 04:22:21'),
(53, 'Health and safety law', NULL, NULL, '2023-02-04 04:22:21', '2023-02-04 04:22:21'),
(54, 'Health care law', NULL, NULL, '2023-02-04 04:22:21', '2023-02-04 04:22:21'),
(55, 'Immigration law', NULL, NULL, '2023-02-04 04:22:21', '2023-02-04 04:22:21'),
(56, 'Insurance law', NULL, NULL, '2023-02-04 04:22:21', '2023-02-04 04:22:21'),
(57, 'Intellectual property law', NULL, NULL, '2023-02-04 04:22:21', '2023-02-04 04:22:21'),
(58, 'International law', NULL, NULL, '2023-02-04 04:22:21', '2023-02-04 04:22:21'),
(59, 'International trade and finance law', NULL, NULL, '2023-02-04 04:22:21', '2023-02-04 04:22:21'),
(60, 'Internet law', NULL, NULL, '2023-02-04 04:22:21', '2023-02-04 04:22:21'),
(61, 'Labour law (or Labor law)', NULL, NULL, '2023-02-04 04:22:21', '2023-02-04 04:22:21'),
(62, 'Land use & zoning law', NULL, NULL, '2023-02-04 04:22:21', '2023-02-04 04:22:21'),
(63, 'Litigation', NULL, NULL, '2023-02-04 04:22:21', '2023-02-04 04:22:21'),
(64, 'Martial law', NULL, NULL, '2023-02-04 04:22:21', '2023-02-04 04:22:21'),
(65, 'Media law', NULL, NULL, '2023-02-04 04:22:21', '2023-02-04 04:22:21'),
(66, 'Mergers & acquisitions law', NULL, NULL, '2023-02-04 04:22:21', '2023-02-04 04:22:21'),
(67, 'Military law', NULL, NULL, '2023-02-04 04:22:21', '2023-02-04 04:22:21'),
(68, 'Mining law', NULL, NULL, '2023-02-04 04:22:21', '2023-02-04 04:22:21'),
(69, 'Juvenile law', NULL, NULL, '2023-02-04 04:22:21', '2023-02-04 04:22:21'),
(70, 'Music law', NULL, NULL, '2023-02-04 04:22:21', '2023-02-04 04:22:21'),
(71, 'Mutual funds law', NULL, NULL, '2023-02-04 04:22:21', '2023-02-04 04:22:21'),
(72, 'Nationality law', NULL, NULL, '2023-02-04 04:22:21', '2023-02-04 04:22:21'),
(73, 'Native American law', NULL, NULL, '2023-02-04 04:22:21', '2023-02-04 04:22:21'),
(74, 'Obscenity law', NULL, NULL, '2023-02-04 04:22:21', '2023-02-04 04:22:21'),
(75, 'Oil & gas law', NULL, NULL, '2023-02-04 04:22:21', '2023-02-04 04:22:21'),
(76, 'Parliamentary law', NULL, NULL, '2023-02-04 04:22:21', '2023-02-04 04:22:21'),
(77, 'Patent law', NULL, NULL, '2023-02-04 04:22:21', '2023-02-04 04:22:21'),
(78, 'Poverty law', NULL, NULL, '2023-02-04 04:22:21', '2023-02-04 04:22:21'),
(79, 'Privacy law', NULL, NULL, '2023-02-04 04:22:21', '2023-02-04 04:22:21'),
(80, 'Private equity law', NULL, NULL, '2023-02-04 04:22:21', '2023-02-04 04:22:21'),
(81, 'Private funds law / Hedge funds law', NULL, NULL, '2023-02-04 04:22:21', '2023-02-04 04:22:21'),
(82, 'Procedural law', NULL, NULL, '2023-02-04 04:22:21', '2023-02-04 04:22:21'),
(83, 'Product liability litigationProperty law', NULL, NULL, '2023-02-04 04:22:21', '2023-02-04 04:22:21'),
(84, 'Public health law', NULL, NULL, '2023-02-04 04:22:21', '2023-02-04 04:22:21'),
(85, 'Public International Law', NULL, NULL, '2023-02-04 04:22:21', '2023-02-04 04:22:21'),
(86, 'Railroad law', NULL, NULL, '2023-02-04 04:22:21', '2023-02-04 04:22:21'),
(87, 'Real estate law', NULL, NULL, '2023-02-04 04:22:21', '2023-02-04 04:22:21'),
(88, 'Securities law / Capital markets law', NULL, NULL, '2023-02-04 04:22:21', '2023-02-04 04:22:21'),
(89, 'Social Security', NULL, NULL, '2023-02-04 04:22:21', '2023-02-04 04:22:21'),
(90, 'Disability law', NULL, NULL, '2023-02-04 04:22:21', '2023-02-04 04:22:21'),
(91, 'Space law', NULL, NULL, '2023-02-04 04:22:21', '2023-02-04 04:22:21'),
(92, 'Sports law', NULL, NULL, '2023-02-04 04:22:21', '2023-02-04 04:22:21'),
(93, 'Statutory law', NULL, NULL, '2023-02-04 04:22:21', '2023-02-04 04:22:21'),
(94, 'Tax law', NULL, NULL, '2023-02-04 04:22:21', '2023-02-04 04:22:21'),
(95, 'Technology law', NULL, NULL, '2023-02-04 04:22:21', '2023-02-04 04:22:21'),
(96, 'Timber law', NULL, NULL, '2023-02-04 04:22:21', '2023-02-04 04:22:21'),
(97, 'Tort law', NULL, NULL, '2023-02-04 04:22:21', '2023-02-04 04:22:21'),
(98, 'Trademark law', NULL, NULL, '2023-02-04 04:22:21', '2023-02-04 04:22:21'),
(99, 'Transport law / Transportation law', NULL, NULL, '2023-02-04 04:22:21', '2023-02-04 04:22:21'),
(100, 'Trusts & estates law', NULL, NULL, '2023-02-04 04:22:21', '2023-02-04 04:22:21'),
(101, 'Utilities Regulation Venture capital law', NULL, NULL, '2023-02-04 04:22:21', '2023-02-04 04:22:21'),
(102, 'Water law', NULL, NULL, '2023-02-04 04:22:21', '2023-02-04 04:22:21');

-- --------------------------------------------------------

--
-- Table structure for table `maritals`
--

CREATE TABLE `maritals` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `maritals`
--

INSERT INTO `maritals` (`id`, `title`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'Single', NULL, '2023-02-04 04:22:21', '2023-02-04 04:22:21'),
(2, 'Married', NULL, '2023-02-04 04:22:21', '2023-02-04 04:22:21'),
(3, 'Divorced', NULL, '2023-02-04 04:22:21', '2023-02-04 04:22:21'),
(4, 'Separated', NULL, '2023-02-04 04:22:21', '2023-02-04 04:22:21'),
(5, 'Widowed', NULL, '2023-02-04 04:22:21', '2023-02-04 04:22:21'),
(6, 'Catholic Nun', NULL, '2023-02-04 04:22:21', '2023-02-04 04:22:21'),
(7, 'Catholic Priest', NULL, '2023-02-04 04:22:21', '2023-02-04 04:22:21');

-- --------------------------------------------------------

--
-- Table structure for table `meetings`
--

CREATE TABLE `meetings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `date` date NOT NULL,
  `start` time NOT NULL,
  `end` time NOT NULL,
  `venue` varchar(255) NOT NULL,
  `credits` varchar(255) NOT NULL,
  `concern` varchar(255) DEFAULT NULL,
  `published` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `meetings`
--

INSERT INTO `meetings` (`id`, `title`, `date`, `start`, `end`, `venue`, `credits`, `concern`, `published`, `created_at`, `updated_at`) VALUES
(1, 'Meeting Test', '2023-03-15', '00:00:00', '14:00:00', 'Online', '3', '1,2', 1, '2023-03-14 08:20:14', '2023-03-23 08:31:14'),
(2, 'Urubuga rugari', '2023-03-24', '12:00:00', '14:00:00', 'Online', '2', '1,3,2', 1, '2023-03-23 07:16:00', '2023-03-23 07:36:10');

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
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2023_01_10_122950_create_admins_table', 1),
(6, '2023_01_11_002722_create_maritals_table', 1),
(7, '2023_01_11_003130_create_lawscategories_table', 1),
(8, '2023_01_11_003547_create_organizations_table', 1),
(9, '2023_01_11_004949_create_addresses_table', 1),
(10, '2023_01_11_005412_create_socials_table', 1),
(11, '2023_01_11_005629_create_phonenumbers_table', 1),
(12, '2023_01_11_005909_create_areas_table', 1),
(13, '2023_01_15_175951_create_permission_tables', 1),
(14, '2023_01_15_180553_create_meetings_table', 1),
(15, '2023_01_15_190701_create_authentication_log_table', 1),
(16, '2023_01_22_140817_create_discipline_table', 1),
(17, '2023_01_22_142701_create_discipline_participants_table', 1),
(18, '2023_01_22_142730_create_discipline_sittings_table', 1),
(19, '2023_01_23_113656_create_invitation', 1),
(20, '2023_02_02_110500_create_probonos_table', 1),
(21, '2023_02_02_135114_create_probono_files_table', 1),
(22, '2023_02_06_092859_create_probono_devs_table', 2),
(23, '2023_02_07_104044_create_trainings_table', 3),
(24, '2023_02_08_133540_create_training_topics_table', 4),
(25, '2023_02_08_140152_create_training_topics_table', 5),
(26, '2023_02_09_091058_create_training_materials_table', 6),
(27, '2023_02_09_135848_create_bookings_table', 7),
(28, '2023_02_10_040726_create_bookings_table', 8),
(29, '2023_02_10_041143_create_bookings_table', 9),
(30, '2023_02_13_105045_create_probonos_table', 10),
(31, '2023_02_13_092859_create_probono_devs_table', 11),
(32, '2023_02_13_135114_create_probono_files_table', 11),
(33, '2023_02_18_072643_create_contributions_table', 12),
(34, '2023_02_18_172643_create_contributions_table', 13),
(35, '2023_02_18_041143_create_bookings_table', 14),
(36, '2023_02_19_041143_create_bookings_table', 15),
(37, '2023_02_22_041143_create_bookings_table', 16),
(38, '2023_02_22_091058_create_training_materials_table', 17),
(39, '2023_02_22_140152_create_training_topics_table', 17),
(40, '2023_02_23_041143_create_bookings_table', 18),
(41, '2023_02_24_941143_create_bookings_table', 19),
(42, '2023_02_28_172643_create_contributions_table', 20),
(43, '2023_03_01_090643_create_contribute_advocates_table', 21),
(44, '2023_03_01_490643_create_contribute_advocates_table', 22),
(45, '2023_03_10_180553_create_meetings_table', 23),
(46, '2023_03_13_105045_create_probonos_table', 24),
(47, '2023_03_13_713656_create_invitation', 24),
(48, '2023_03_13_735114_create_probono_files_table', 25),
(49, '2023_03_13_812859_create_probono_devs_table', 25),
(50, '2023_03_22_142730_create_discipline_sittings_table', 26),
(51, '2023_03_22_342730_create_discipline_sittings_table', 27),
(52, '2023_03_13_912859_create_probono_devs_table', 28),
(53, '2023_03_13_211023_create_extra_cles_table', 29),
(54, '2023_03_13_211223_create_extra_cles_table', 30),
(55, '2023_01_10_175951_create_permission_tables', 31),
(56, '2023_03_23_054654_create_compliances_table', 31);

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
(3, 'App\\Models\\User', 17);

-- --------------------------------------------------------

--
-- Table structure for table `organizations`
--

CREATE TABLE `organizations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tin` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `type` enum('Lawfirm','Other') NOT NULL,
  `address` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `blocked` tinyint(1) NOT NULL DEFAULT 0,
  `remember_token` varchar(100) DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `organizations`
--

INSERT INTO `organizations` (`id`, `tin`, `name`, `type`, `address`, `phone`, `email`, `password`, `blocked`, `remember_token`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, '1022888', 'Test Org', 'Lawfirm', 'Rutsiro Village', '0786662225', 'testorg@gmail.com', '$2y$10$SvyrVN7o4u/DTEAW7BRiheyAzIJc6VGAHV9Ddbagb/RGeFv.uWpQa', 0, NULL, NULL, '2023-02-13 05:19:25', '2023-02-13 06:44:29'),
(2, '102283883', 'Organisation', 'Other', 'Rwampara', '0787335522', 'org2@gmail.com', '$2y$10$aMEEr2.XpCGJlc0mkraxduzrb5iDlDrQM6KIz7TecWNp4MuEg3j2a', 0, NULL, NULL, '2023-02-13 05:20:12', '2023-02-13 05:58:23');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `guard_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `phonenumbers`
--

CREATE TABLE `phonenumbers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `phonenumbers`
--

INSERT INTO `phonenumbers` (`id`, `name`, `phone`, `user_id`, `created_at`, `updated_at`) VALUES
(25, 'mobile', '0788672799', 2, '2023-02-04 08:42:36', '2023-02-04 08:42:36'),
(30, 'mobile', '0780003888', 3, '2023-02-04 09:25:55', '2023-02-04 09:25:55'),
(31, 'mobile', '0789888976', 8, '2023-02-04 09:50:12', '2023-02-04 09:50:12'),
(32, 'mobile', '0778883333', 9, '2023-02-06 10:31:32', '2023-02-06 10:31:32'),
(38, 'mobile', '0785533688', 6, '2023-02-08 07:53:39', '2023-02-08 07:53:39'),
(39, 'mobile', '0786633555', 11, '2023-02-08 07:56:41', '2023-02-08 07:56:41'),
(47, 'mobile', '0799900000', 10, '2023-02-08 08:53:07', '2023-02-08 08:53:07'),
(56, 'mobile', '0788663635', 7, '2023-02-08 10:00:04', '2023-02-08 10:00:04'),
(61, 'mobile', '0788773322', 4, '2023-02-10 15:33:05', '2023-02-10 15:33:05'),
(65, 'mobile', '0788776666', 14, '2023-02-11 05:43:49', '2023-02-11 05:43:49'),
(71, 'mobile', '0785436135', 17, '2023-03-13 03:14:26', '2023-03-13 03:14:26'),
(75, 'mobile', '0785436135', 1, '2023-03-13 03:18:44', '2023-03-13 03:18:44'),
(78, 'mobile', '7854361352', 20, '2023-03-14 09:58:38', '2023-03-14 09:58:38'),
(79, 'mobile', '7854666777', 21, '2023-03-14 09:59:36', '2023-03-14 09:59:36'),
(80, 'mobile', '0788672782', 13, '2023-03-16 13:31:42', '2023-03-16 13:31:42'),
(81, 'mobile', '0733227322', 5, '2023-03-21 11:23:16', '2023-03-21 11:23:16'),
(82, 'mobile', '0782185745', 12, '2023-03-21 11:24:06', '2023-03-21 11:24:06'),
(83, 'mobile', '0787766678', 15, '2023-03-22 08:44:52', '2023-03-22 08:44:52'),
(84, 'mobile', '0788672782', 16, '2023-03-22 09:10:46', '2023-03-22 09:10:46');

-- --------------------------------------------------------

--
-- Table structure for table `probonos`
--

CREATE TABLE `probonos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `fname` varchar(255) NOT NULL,
  `lname` varchar(255) NOT NULL,
  `gender` varchar(255) NOT NULL,
  `age` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `referral_case_no` varchar(255) NOT NULL,
  `jurisdiction` varchar(255) NOT NULL,
  `court` varchar(255) NOT NULL,
  `case_nature` varchar(255) NOT NULL,
  `probono_files` int(11) NOT NULL DEFAULT 0,
  `probono_devs` int(11) NOT NULL DEFAULT 0,
  `hearing_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `category` varchar(255) NOT NULL,
  `referrel` varchar(255) NOT NULL,
  `status` enum('OPEN','WON','LOST','TRANSACTED') NOT NULL,
  `advocate` bigint(20) UNSIGNED DEFAULT NULL,
  `register` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `probonos`
--

INSERT INTO `probonos` (`id`, `fname`, `lname`, `gender`, `age`, `phone`, `referral_case_no`, `jurisdiction`, `court`, `case_nature`, `probono_files`, `probono_devs`, `hearing_date`, `category`, `referrel`, `status`, `advocate`, `register`, `created_at`, `updated_at`) VALUES
(1, 'Ndikumana', 'Eric', 'Male', '23', '0785436135', 'RCSSJJ CASSSHH', 'Jurdia', 'Court Test', 'Civil', 0, 2, '2023-03-13 14:04:56', 'Legal Aid to General Public', 'Mbonyumutwa', 'OPEN', 17, 2, '2023-03-13 11:40:17', '2023-03-13 12:04:56');

-- --------------------------------------------------------

--
-- Table structure for table `probono_devs`
--

CREATE TABLE `probono_devs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `status` enum('OPEN','WON','LOST','TRANSACTED') NOT NULL,
  `title` varchar(255) NOT NULL,
  `narration` text NOT NULL,
  `attach_file` varchar(255) DEFAULT NULL,
  `reaction` varchar(255) DEFAULT NULL,
  `probono_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `probono_devs`
--

INSERT INTO `probono_devs` (`id`, `status`, `title`, `narration`, `attach_file`, `reaction`, `probono_id`, `created_at`, `updated_at`) VALUES
(1, 'OPEN', 'Onather Commit', 'Cupcake ipsum dolor sit amet. Halvah cheesecake chocolate bar gummi bears cupcake. Pie macaroon bear claw. Soufflé I love candy canes I love cotton candy I love.', '140456-proof_year1.pdf', 'Halvah cheesecake chocolate bar gummi bears cupcake. Pie macaroon bear claw. Soufflé I love candy canes I love cotton candy I love.', 1, '2023-03-13 12:04:56', '2023-03-13 12:36:23');

-- --------------------------------------------------------

--
-- Table structure for table `probono_files`
--

CREATE TABLE `probono_files` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `case_title` varchar(255) NOT NULL,
  `case_type` varchar(255) NOT NULL,
  `case_file` varchar(255) NOT NULL,
  `probono_id` bigint(20) UNSIGNED NOT NULL,
  `register` bigint(20) UNSIGNED NOT NULL,
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
  `guard_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(2, 'Administrator', 'web', '2023-03-18 12:43:25', '2023-03-19 05:02:42'),
(3, 'Legal Aid', 'web', '2023-03-18 12:44:02', '2023-03-18 12:44:02'),
(4, 'Professional development', 'web', '2023-03-18 12:45:06', '2023-03-18 12:45:06'),
(5, 'Accountant', 'web', '2023-03-18 12:46:17', '2023-03-18 12:46:17');

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
(7, 2),
(7, 4),
(7, 5),
(51, 2),
(51, 3),
(51, 4),
(51, 5),
(53, 2),
(53, 3),
(53, 4),
(55, 2),
(55, 3),
(55, 4),
(57, 2),
(57, 3),
(57, 4),
(57, 5),
(59, 2),
(59, 4),
(61, 2),
(61, 4),
(63, 2),
(63, 5),
(65, 2),
(65, 4);

-- --------------------------------------------------------

--
-- Table structure for table `socials`
--

CREATE TABLE `socials` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `social` varchar(255) NOT NULL,
  `link` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `trainings`
--

CREATE TABLE `trainings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `category` varchar(255) NOT NULL,
  `venue` varchar(255) NOT NULL,
  `credits` decimal(8,2) NOT NULL,
  `price` decimal(8,2) NOT NULL,
  `starton` varchar(255) NOT NULL,
  `endon` varchar(255) NOT NULL,
  `early_deadline` varchar(255) NOT NULL,
  `late_deadline` varchar(255) NOT NULL,
  `rate` decimal(8,2) NOT NULL,
  `seats` int(11) NOT NULL,
  `confirm` int(11) NOT NULL DEFAULT 0,
  `booking` int(11) NOT NULL DEFAULT 0,
  `publish` enum('0','1') NOT NULL DEFAULT '0',
  `register` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `trainings`
--

INSERT INTO `trainings` (`id`, `title`, `category`, `venue`, `credits`, `price`, `starton`, `endon`, `early_deadline`, `late_deadline`, `rate`, `seats`, `confirm`, `booking`, `publish`, `register`, `created_at`, `updated_at`) VALUES
(1, 'Law Governing Foundation', 'Publication', 'Online', '2.30', '20.00', '2023-02-24', '2023-03-11', '2023-03-22', '2023-03-30 12:00', '10.00', 50, 2, 4, '1', 2, '2023-02-23 02:40:06', '2023-03-13 16:49:37'),
(2, 'Test 2', 'CLE', 'Online', '2.00', '100.00', '2023-02-24', '2023-03-11', '2023-02-16', '2023-02-24 12:00', '10.00', 50, 0, 1, '1', 2, '2023-02-24 08:49:37', '2023-02-24 08:50:51'),
(3, 'Test 3', 'Legal Workshop', 'Online', '3.00', '20.00', '2023-03-03', '2023-03-11', '2023-02-17', '2023-02-23 12:00', '20.00', 300, 0, 0, '0', 2, '2023-02-24 08:50:32', '2023-02-24 08:50:32'),
(4, 'Last Test', 'Publication', 'online', '2.00', '100.00', '2023-03-22', '2023-03-31', '2023-03-22', '2023-03-22 12:00', '10.00', 100, 1, 1, '1', 2, '2023-03-22 09:09:04', '2023-03-22 09:13:01');

-- --------------------------------------------------------

--
-- Table structure for table `training_materials`
--

CREATE TABLE `training_materials` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `file` varchar(255) NOT NULL,
  `register` bigint(20) UNSIGNED NOT NULL,
  `training_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `training_topics`
--

CREATE TABLE `training_topics` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `topic` varchar(255) NOT NULL,
  `startAt` varchar(255) NOT NULL,
  `endAt` varchar(255) NOT NULL,
  `trainer` varchar(255) NOT NULL,
  `register` bigint(20) UNSIGNED NOT NULL,
  `training_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `district` varchar(255) DEFAULT NULL,
  `gender` enum('Male','Female') NOT NULL,
  `marital` varchar(255) NOT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `diplome` varchar(255) DEFAULT NULL,
  `username` varchar(255) DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `regNumber` varchar(255) NOT NULL,
  `status` enum('1','2','3','4') NOT NULL,
  `practicing` enum('1','2','3','4','5','6') NOT NULL,
  `category` enum('Advocate','Staff') NOT NULL,
  `password` varchar(255) NOT NULL,
  `date` date NOT NULL,
  `blocked` tinyint(1) NOT NULL DEFAULT 0,
  `remember_token` varchar(100) DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `district`, `gender`, `marital`, `photo`, `diplome`, `username`, `email_verified_at`, `regNumber`, `status`, `practicing`, `category`, `password`, `date`, `blocked`, `remember_token`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'BYAMUNGU Lewis', 'byamungulewis@gmail.com', 'Rubavu', 'Male', '2', '103530-avatar-3.jpg', '063037-uuuu.jpg', NULL, NULL, '001/T/2023', '1', '2', 'Advocate', '$2y$10$uGZuhtnUpIL3KrWMaSx.zuTFKbXNIJe3KvVRCNz9xG69ZFb1ZarGW', '2023-02-04', 0, NULL, NULL, '2023-02-04 04:30:37', '2023-03-13 03:18:44'),
(2, 'UWIZEWE Jean d\'Amour', 'uwizelogick2015@gmail.com', 'Kirehe', 'Male', '2', '101812-uuuu (2).jpg', '070842-signature.jpeg', NULL, NULL, '006/S/2023', '2', '2', 'Advocate', '$2y$10$9x8ROxUJHCTFVDa39jRp9.H/FXf28aKOymPWrqNrqbLYh7ASjEw0O', '2023-02-03', 1, NULL, '2023-02-08 06:24:16', '2023-02-04 05:07:15', '2023-02-08 06:24:16'),
(3, 'Aliane NIYONASENZE', 'alianeniyo03@gmail.com', 'Rwamagana', 'Female', '1', '103705-2.png', NULL, NULL, NULL, '003/T/2023', '1', '2', 'Advocate', '$2y$10$TcqWXvjwSMogrfKpXyFx3.r1dgEd08Q62OsDRTAzGErrmIPzTlkfO', '2023-02-03', 0, NULL, NULL, '2023-02-04 08:37:05', '2023-02-10 06:42:58'),
(4, 'UWIZEYE Julliene', 'uwizeye@gmail.com', 'Gicumbi', 'Female', '4', '103815-4.png', '104756-4.png', NULL, NULL, '004/T/2023', '1', '5', 'Advocate', '$2y$10$EKiBu1Q.Ljr9FZojkwvj3.dZ3chig3LYnTa.TJ34Z/6t.OI0nwbzG', '2023-02-10', 1, NULL, NULL, '2023-02-04 08:38:15', '2023-02-10 15:33:05'),
(5, 'NDAGIJIMANA Enock', 'ndagijimanaenock11@gmail.com', 'Kamonyi', 'Female', '3', '103916-7.png', NULL, NULL, NULL, '005/T/2023', '1', '3', 'Advocate', '$2y$10$osmgsc1xQJ5iGN2V7gKLBOTt38CBedOFvnnWLoTs.kgD.RwgHu2wu', '2023-01-30', 0, NULL, NULL, '2023-02-04 08:39:16', '2023-03-21 11:23:16'),
(6, 'Sugira Yves', 'sugira@gmail.com', 'Kayonza', 'Male', '4', '104036-9.png', NULL, NULL, NULL, '006/T/2023', '1', '2', 'Advocate', '$2y$10$l95eOBWN.2dF.8GKELROQuT6Qqj1puQ3iwnS4.BmrEy53dXNTxe6K', '2023-02-04', 0, NULL, NULL, '2023-02-04 08:40:36', '2023-02-08 07:53:39'),
(7, 'UMUTESI Deborah', 'umutesi@gmail.com', 'Muhanga', 'Male', '2', '104716-avatar-1.jpg', NULL, NULL, NULL, '007/T/2023', '1', '2', 'Advocate', '$2y$10$vCFo6jEDxyMZVwR.46bh7.V4FbnYWaf1lcjl1i7ABo1XTeikDREWW', '2023-02-03', 0, NULL, NULL, '2023-02-04 08:47:16', '2023-02-08 09:52:38'),
(8, 'MUHIRE Kevin', 'Kevin@gmail.com', 'Karongi', 'Female', '2', '115011-1.png', NULL, NULL, NULL, '008/T/2023', '1', '3', 'Advocate', '$2y$10$8OwJmOMW5ApgoIGjqmbvVO5idHfJ6Zq0nR.03UtW64DC24RPl/btO', '2023-02-04', 0, NULL, NULL, '2023-02-04 09:50:12', '2023-02-08 06:25:27'),
(9, 'Tessting', 'test@gmail.com', 'Gakenke', 'Female', '2', '123132-2.png', NULL, NULL, NULL, '009/T/2023', '1', '2', 'Advocate', '$2y$10$Os8.0HP.K5zyACb3Y.C2he98V9O7ZbWd2VZFnQvLi.KkjZYyJ/pdK', '2023-01-31', 1, NULL, '2023-02-06 10:31:42', '2023-02-06 10:31:32', '2023-02-06 10:31:42'),
(10, 'Umukozi liza', 'test@test.com', 'Musanze', 'Male', '4', '082342-6.png', '104638-6.png', NULL, NULL, '009/T/2023', '1', '2', 'Advocate', '$2y$10$EwJIntZEIr4KhSkCeJY1X.LXMWE5fjdgNMrbm0sXYPqt4rODwhAO.', '2023-02-02', 0, NULL, NULL, '2023-02-08 06:23:42', '2023-02-08 08:53:07'),
(11, 'Test Active user', 'test21@test.com', 'Bugesera', 'Female', '4', '095641-6.png', NULL, NULL, NULL, '009/S/2023', '2', '2', 'Advocate', '$2y$10$r4f5jgWuXJHin.LXET245efbJpEhJ1Jsx8cFN0y9IXdWAltJ/UqJm', '2023-02-07', 1, NULL, '2023-02-08 07:57:23', '2023-02-08 07:56:41', '2023-02-08 07:57:23'),
(12, 'Ndikumana Eric', 'ndikumanaeric001@gmail.com', 'Gakenke', 'Male', '4', NULL, NULL, NULL, NULL, '009/S/2023', '2', '4', 'Advocate', '$2y$10$WGos436dmZTILo8cxmwQXeHInKUP/ocGzCCypWuiXqwA/7TMRj8WC', '2023-02-08', 0, NULL, NULL, '2023-02-08 09:47:54', '2023-03-21 11:22:54'),
(13, 'Test Number', 'testnumber@test.com', 'Muhanga', 'Male', '3', NULL, NULL, NULL, NULL, '0010/T/2023', '1', '3', 'Advocate', '$2y$10$gT16G4Pg5cO.eR/oaKqrD.cQIpKgCqc7O5Yj.TN/HrB76K2YiHRD6', '2023-02-08', 0, NULL, NULL, '2023-02-08 09:50:20', '2023-02-10 15:35:02'),
(14, 'UMWIZAWASE Fanny', 'umwizawase@gmail.com', 'Karongi', 'Female', '1', '174004-avatar-5.jpg', NULL, NULL, NULL, '011/S/2023', '2', '2', 'Advocate', '$2y$10$pCufGmJd0CWUJG4Ukj9CyuUknX0uuEr4gy6Lj66fTajgxGTJK80Ea', '2023-02-08', 0, NULL, NULL, '2023-02-10 15:40:04', '2023-02-11 05:43:49'),
(15, 'Lewis Test bmg', 'lewis@gmail.com', 'Ngoma', 'Male', '3', '081029-3.png', NULL, NULL, NULL, '012/S/2023', '2', '3', 'Advocate', '$2y$10$tx2mjoa9hxLc.KxtIxNmTOtvJVvezzgS4JmLOtShBTuXY52JkJfnm', '2023-02-15', 0, NULL, NULL, '2023-02-15 06:09:48', '2023-03-22 08:44:52'),
(16, 'Ntwari Lebon', 'ntwarilebon09@gmail.com', 'Kirehe', 'Male', '1', '121303-5.png', NULL, NULL, NULL, '013/T/2023', '1', '2', 'Advocate', '$2y$10$321ZYd12dkwPNnVljdasxez348qAKXI47cfKey/edj7nbf6ALzM9S', '2023-02-15', 0, NULL, NULL, '2023-02-15 10:13:03', '2023-02-23 02:43:54'),
(17, 'Akimana Olivie', 'www.byamungulewis@gmail.com', 'Muhanga', 'Male', '1', '051425-DSC_0866.JPG', NULL, NULL, NULL, '014/T/2023', '1', '2', 'Advocate', '$2y$10$4f2SZifybvlqV6qARbaulO7a4akq3deZWM4zh.r6YPZ.KmTfRSowi', '2023-03-13', 0, NULL, NULL, '2023-03-13 03:14:26', '2023-03-13 11:42:14'),
(20, 'Intern user', 'intern@user.com', 'Musanze', 'Male', '3', NULL, NULL, NULL, NULL, '015/S/2023', '2', '2', 'Advocate', '$2y$10$0tueuE.tLJgooMrPODBf8u95iZPkmeXjdqZO.oJgWXFHrPto52ENu', '2023-03-13', 0, NULL, NULL, '2023-03-14 09:58:38', '2023-03-14 09:58:38'),
(21, 'Intern user2', 'intern2@user.com', 'Gisagara', 'Male', '2', NULL, NULL, NULL, NULL, '016/S/2023', '2', '3', 'Advocate', '$2y$10$8f2SWppC1uq7Wq18ROthv.aycVZeCzN/5R.0q5pi/jIVKnsynqZMi', '2023-03-13', 0, NULL, NULL, '2023-03-14 09:59:36', '2023-03-14 09:59:36');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `addresses`
--
ALTER TABLE `addresses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `addresses_user_id_foreign` (`user_id`);

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `admins_email_unique` (`email`),
  ADD UNIQUE KEY `admins_username_unique` (`username`);

--
-- Indexes for table `areas`
--
ALTER TABLE `areas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `areas_lawscategory_id_foreign` (`lawscategory_id`),
  ADD KEY `areas_user_id_foreign` (`user_id`);

--
-- Indexes for table `authentication_log`
--
ALTER TABLE `authentication_log`
  ADD PRIMARY KEY (`id`),
  ADD KEY `authentication_log_authenticatable_type_authenticatable_id_index` (`authenticatable_type`,`authenticatable_id`);

--
-- Indexes for table `bookings`
--
ALTER TABLE `bookings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `bookings_training_foreign` (`training`),
  ADD KEY `bookings_advocate_foreign` (`advocate`);

--
-- Indexes for table `compliances`
--
ALTER TABLE `compliances`
  ADD PRIMARY KEY (`id`),
  ADD KEY `compliances_user_id_foreign` (`user_id`),
  ADD KEY `compliances_created_by_foreign` (`created_by`),
  ADD KEY `compliances_update_by_foreign` (`update_by`);

--
-- Indexes for table `contribute_advocates`
--
ALTER TABLE `contribute_advocates`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `contribute_advocates_reference_no_unique` (`reference_no`),
  ADD KEY `contribute_advocates_advocate_foreign` (`advocate`),
  ADD KEY `contribute_advocates_contribution_foreign` (`contribution`);

--
-- Indexes for table `contributions`
--
ALTER TABLE `contributions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `contributions_createdby_foreign` (`createdBy`),
  ADD KEY `contributions_updateby_foreign` (`updateby`);

--
-- Indexes for table `discipline`
--
ALTER TABLE `discipline`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `discipline_participants`
--
ALTER TABLE `discipline_participants`
  ADD PRIMARY KEY (`table_id`);

--
-- Indexes for table `discipline_sittings`
--
ALTER TABLE `discipline_sittings`
  ADD PRIMARY KEY (`sitting_id`),
  ADD KEY `discipline_sittings_discipline_case_foreign` (`discipline_case`),
  ADD KEY `discipline_sittings_scheduledby_foreign` (`scheduledBy`);

--
-- Indexes for table `extra_cles`
--
ALTER TABLE `extra_cles`
  ADD PRIMARY KEY (`id`),
  ADD KEY `extra_cles_advocate_foreign` (`advocate`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `invitation`
--
ALTER TABLE `invitation`
  ADD PRIMARY KEY (`id`),
  ADD KEY `invitation_user_id_foreign` (`user_id`);

--
-- Indexes for table `lawscategories`
--
ALTER TABLE `lawscategories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `maritals`
--
ALTER TABLE `maritals`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `meetings`
--
ALTER TABLE `meetings`
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
-- Indexes for table `organizations`
--
ALTER TABLE `organizations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `phonenumbers`
--
ALTER TABLE `phonenumbers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `phonenumbers_user_id_foreign` (`user_id`);

--
-- Indexes for table `probonos`
--
ALTER TABLE `probonos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `probonos_advocate_foreign` (`advocate`),
  ADD KEY `probonos_register_foreign` (`register`);

--
-- Indexes for table `probono_devs`
--
ALTER TABLE `probono_devs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `probono_devs_probono_id_foreign` (`probono_id`);

--
-- Indexes for table `probono_files`
--
ALTER TABLE `probono_files`
  ADD PRIMARY KEY (`id`),
  ADD KEY `probono_files_probono_id_foreign` (`probono_id`),
  ADD KEY `probono_files_register_foreign` (`register`);

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
-- Indexes for table `socials`
--
ALTER TABLE `socials`
  ADD PRIMARY KEY (`id`),
  ADD KEY `socials_user_id_foreign` (`user_id`);

--
-- Indexes for table `trainings`
--
ALTER TABLE `trainings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `trainings_register_foreign` (`register`);

--
-- Indexes for table `training_materials`
--
ALTER TABLE `training_materials`
  ADD PRIMARY KEY (`id`),
  ADD KEY `training_materials_training_id_foreign` (`training_id`),
  ADD KEY `training_materials_register_foreign` (`register`);

--
-- Indexes for table `training_topics`
--
ALTER TABLE `training_topics`
  ADD PRIMARY KEY (`id`),
  ADD KEY `training_topics_training_id_foreign` (`training_id`),
  ADD KEY `training_topics_register_foreign` (`register`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_username_unique` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `addresses`
--
ALTER TABLE `addresses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `areas`
--
ALTER TABLE `areas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `authentication_log`
--
ALTER TABLE `authentication_log`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=145;

--
-- AUTO_INCREMENT for table `bookings`
--
ALTER TABLE `bookings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `compliances`
--
ALTER TABLE `compliances`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `contribute_advocates`
--
ALTER TABLE `contribute_advocates`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `contributions`
--
ALTER TABLE `contributions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `discipline`
--
ALTER TABLE `discipline`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `discipline_participants`
--
ALTER TABLE `discipline_participants`
  MODIFY `table_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `discipline_sittings`
--
ALTER TABLE `discipline_sittings`
  MODIFY `sitting_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `extra_cles`
--
ALTER TABLE `extra_cles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `invitation`
--
ALTER TABLE `invitation`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `lawscategories`
--
ALTER TABLE `lawscategories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=103;

--
-- AUTO_INCREMENT for table `maritals`
--
ALTER TABLE `maritals`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `meetings`
--
ALTER TABLE `meetings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- AUTO_INCREMENT for table `organizations`
--
ALTER TABLE `organizations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `phonenumbers`
--
ALTER TABLE `phonenumbers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=85;

--
-- AUTO_INCREMENT for table `probonos`
--
ALTER TABLE `probonos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `probono_devs`
--
ALTER TABLE `probono_devs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `probono_files`
--
ALTER TABLE `probono_files`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `socials`
--
ALTER TABLE `socials`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `trainings`
--
ALTER TABLE `trainings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `training_materials`
--
ALTER TABLE `training_materials`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `training_topics`
--
ALTER TABLE `training_topics`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `addresses`
--
ALTER TABLE `addresses`
  ADD CONSTRAINT `addresses_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `areas`
--
ALTER TABLE `areas`
  ADD CONSTRAINT `areas_lawscategory_id_foreign` FOREIGN KEY (`lawscategory_id`) REFERENCES `lawscategories` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `areas_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `bookings`
--
ALTER TABLE `bookings`
  ADD CONSTRAINT `bookings_advocate_foreign` FOREIGN KEY (`advocate`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `bookings_training_foreign` FOREIGN KEY (`training`) REFERENCES `trainings` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `compliances`
--
ALTER TABLE `compliances`
  ADD CONSTRAINT `compliances_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `admins` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `compliances_update_by_foreign` FOREIGN KEY (`update_by`) REFERENCES `admins` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `compliances_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `contribute_advocates`
--
ALTER TABLE `contribute_advocates`
  ADD CONSTRAINT `contribute_advocates_advocate_foreign` FOREIGN KEY (`advocate`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `contribute_advocates_contribution_foreign` FOREIGN KEY (`contribution`) REFERENCES `contributions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `contributions`
--
ALTER TABLE `contributions`
  ADD CONSTRAINT `contributions_createdby_foreign` FOREIGN KEY (`createdBy`) REFERENCES `admins` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `contributions_updateby_foreign` FOREIGN KEY (`updateby`) REFERENCES `admins` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `discipline_sittings`
--
ALTER TABLE `discipline_sittings`
  ADD CONSTRAINT `discipline_sittings_discipline_case_foreign` FOREIGN KEY (`discipline_case`) REFERENCES `discipline` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `discipline_sittings_scheduledby_foreign` FOREIGN KEY (`scheduledBy`) REFERENCES `admins` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `extra_cles`
--
ALTER TABLE `extra_cles`
  ADD CONSTRAINT `extra_cles_advocate_foreign` FOREIGN KEY (`advocate`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `invitation`
--
ALTER TABLE `invitation`
  ADD CONSTRAINT `invitation_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

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
-- Constraints for table `phonenumbers`
--
ALTER TABLE `phonenumbers`
  ADD CONSTRAINT `phonenumbers_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `probonos`
--
ALTER TABLE `probonos`
  ADD CONSTRAINT `probonos_advocate_foreign` FOREIGN KEY (`advocate`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `probonos_register_foreign` FOREIGN KEY (`register`) REFERENCES `admins` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `probono_devs`
--
ALTER TABLE `probono_devs`
  ADD CONSTRAINT `probono_devs_probono_id_foreign` FOREIGN KEY (`probono_id`) REFERENCES `probonos` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `probono_files`
--
ALTER TABLE `probono_files`
  ADD CONSTRAINT `probono_files_probono_id_foreign` FOREIGN KEY (`probono_id`) REFERENCES `probonos` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `probono_files_register_foreign` FOREIGN KEY (`register`) REFERENCES `admins` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `socials`
--
ALTER TABLE `socials`
  ADD CONSTRAINT `socials_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `trainings`
--
ALTER TABLE `trainings`
  ADD CONSTRAINT `trainings_register_foreign` FOREIGN KEY (`register`) REFERENCES `admins` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `training_materials`
--
ALTER TABLE `training_materials`
  ADD CONSTRAINT `training_materials_register_foreign` FOREIGN KEY (`register`) REFERENCES `admins` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `training_materials_training_id_foreign` FOREIGN KEY (`training_id`) REFERENCES `trainings` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `training_topics`
--
ALTER TABLE `training_topics`
  ADD CONSTRAINT `training_topics_register_foreign` FOREIGN KEY (`register`) REFERENCES `admins` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `training_topics_training_id_foreign` FOREIGN KEY (`training_id`) REFERENCES `trainings` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
