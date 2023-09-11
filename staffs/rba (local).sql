-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 04, 2023 at 10:57 PM
-- Server version: 10.4.19-MariaDB
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
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `addresses`
--

INSERT INTO `addresses` (`id`, `title`, `address`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 'Office', 'GISOZI', 16, '2023-04-02 19:25:37', '2023-04-02 19:25:37');

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `blocked` tinyint(1) NOT NULL DEFAULT 0,
  `role_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `name`, `email`, `username`, `email_verified_at`, `password`, `blocked`, `role_id`, `user_id`, `remember_token`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'Patrick ISHIMWE', 'test@example.com', 'patrick.ishimwe', '2023-02-04 04:22:19', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 0, 2, NULL, 'SXWeqF7gq0', NULL, '2023-02-04 04:22:19', '2023-02-04 04:22:19'),
(2, 'BYAMUNGU Lewis', 'byamungulewis@gmail.com', 'bmglewis@gmail.com', '2023-02-04 04:22:19', '$2y$10$0m94JP4m3ODWpzn2ayzdWeJKTAXdlX77m2jGNVDkcXO7PV7L6eh8O', 0, 2, NULL, '6q9azoDpYvxcVNNGwO47KnYOQiI1gt6tvJdPLu4EHzK8SRqtFGiKq6kJXyQ6', NULL, '2023-02-04 04:22:19', '2023-02-04 04:25:36'),
(3, 'NDIKUMANA Eric', 'ndikumana@gmail.com', 'eric.ndikumana', '2023-02-04 04:22:19', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 0, 2, NULL, 'CQ1SjIAkJ3', NULL, '2023-02-04 04:22:19', '2023-02-04 04:22:19'),
(15, 'UMWIZAWASE Fanny', 'umwizawase@gmail.com', NULL, NULL, '$2y$10$xB0u7oOyZ6c0YUuHwHgKOuJdncWFrkvr/FDVPiHSE8QtXA1KvvL6q', 0, 3, 14, NULL, NULL, '2023-04-02 12:44:51', '2023-04-02 12:49:00');

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
(3, 3, 12, '2023-02-04 09:27:29', '2023-02-04 09:27:29'),
(5, 16, 2, '2023-04-02 19:25:15', '2023-04-02 19:25:15'),
(6, 16, 4, '2023-04-02 19:25:15', '2023-04-02 19:25:15');

-- --------------------------------------------------------

--
-- Table structure for table `authentication_log`
--

CREATE TABLE `authentication_log` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `authenticatable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `authenticatable_id` bigint(20) UNSIGNED NOT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
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
(144, 'App\\Models\\User', 3, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/111.0.0.0 Safari/537.36 Edg/111.0.1661.44', '2023-03-23 04:14:56', 1, NULL, 0, NULL),
(145, 'App\\Models\\Admin', 2, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/111.0.0.0 Safari/537.36', '2023-03-24 08:44:15', 1, NULL, 0, NULL),
(146, 'App\\Models\\Admin', 2, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/111.0.0.0 Safari/537.36', '2023-03-24 17:43:49', 1, NULL, 0, NULL),
(147, 'App\\Models\\Admin', 2, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/111.0.0.0 Safari/537.36', '2023-03-25 02:59:07', 1, NULL, 0, NULL),
(148, 'App\\Models\\User', 3, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/110.0.0.0 Safari/537.36 OPR/96.0.0.0', '2023-03-25 03:16:24', 1, NULL, 0, NULL),
(149, 'App\\Models\\Admin', 2, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/111.0.0.0 Safari/537.36', '2023-03-25 09:03:45', 1, NULL, 0, NULL),
(150, 'App\\Models\\Admin', 2, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/111.0.0.0 Safari/537.36', '2023-03-25 15:04:16', 1, NULL, 0, NULL),
(151, 'App\\Models\\Admin', 13, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/110.0.0.0 Safari/537.36 OPR/96.0.0.0', '2023-03-25 15:15:15', 0, NULL, 0, NULL),
(152, 'App\\Models\\Admin', 13, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/110.0.0.0 Safari/537.36 OPR/96.0.0.0', '2023-03-25 15:15:21', 0, NULL, 0, NULL),
(153, 'App\\Models\\Admin', 13, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/110.0.0.0 Safari/537.36 OPR/96.0.0.0', '2023-03-25 15:15:32', 0, NULL, 0, NULL),
(154, 'App\\Models\\Admin', 13, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/110.0.0.0 Safari/537.36 OPR/96.0.0.0', '2023-03-25 15:18:45', 0, NULL, 0, NULL),
(155, 'App\\Models\\User', 3, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/110.0.0.0 Safari/537.36 OPR/96.0.0.0', '2023-03-25 15:22:32', 1, '2023-03-25 15:26:48', 0, NULL),
(156, 'App\\Models\\Admin', 13, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/110.0.0.0 Safari/537.36 OPR/96.0.0.0', '2023-03-25 15:27:00', 0, NULL, 0, NULL),
(157, 'App\\Models\\Admin', 13, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/110.0.0.0 Safari/537.36 OPR/96.0.0.0', '2023-03-25 15:29:14', 0, NULL, 0, NULL),
(158, 'App\\Models\\Admin', 13, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/110.0.0.0 Safari/537.36 OPR/96.0.0.0', '2023-03-25 15:29:32', 0, NULL, 0, NULL),
(159, 'App\\Models\\Admin', 2, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/110.0.0.0 Safari/537.36 OPR/96.0.0.0', '2023-03-25 15:29:51', 1, '2023-03-25 15:29:56', 0, NULL),
(160, 'App\\Models\\User', 16, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/110.0.0.0 Safari/537.36 OPR/96.0.0.0', '2023-03-25 15:30:13', 1, '2023-03-25 15:33:37', 0, NULL),
(161, 'App\\Models\\User', 16, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/110.0.0.0 Safari/537.36 OPR/96.0.0.0', '2023-03-25 15:33:54', 0, NULL, 0, NULL),
(162, 'App\\Models\\User', 16, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/110.0.0.0 Safari/537.36 OPR/96.0.0.0', '2023-03-25 15:34:00', 1, '2023-03-25 15:34:04', 0, NULL),
(163, 'App\\Models\\User', 15, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/110.0.0.0 Safari/537.36 OPR/96.0.0.0', '2023-03-25 15:34:21', 0, NULL, 0, NULL),
(164, 'App\\Models\\User', 15, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/110.0.0.0 Safari/537.36 OPR/96.0.0.0', '2023-03-25 15:34:27', 1, NULL, 0, NULL),
(165, 'App\\Models\\Admin', 2, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/111.0.0.0 Safari/537.36', '2023-03-26 03:21:25', 1, NULL, 0, NULL),
(166, 'App\\Models\\User', 3, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/110.0.0.0 Safari/537.36 OPR/96.0.0.0', '2023-03-26 04:07:05', 1, '2023-03-26 04:07:15', 0, NULL),
(167, 'App\\Models\\User', 3, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/110.0.0.0 Safari/537.36 OPR/96.0.0.0', '2023-03-26 04:07:47', 1, '2023-03-26 04:08:07', 0, NULL),
(168, 'App\\Models\\User', 3, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/110.0.0.0 Safari/537.36 OPR/96.0.0.0', '2023-03-26 04:08:35', 1, '2023-03-26 04:08:40', 0, NULL),
(169, 'App\\Models\\User', 3, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/110.0.0.0 Safari/537.36 OPR/96.0.0.0', '2023-03-26 04:09:40', 1, '2023-03-26 04:09:46', 0, NULL),
(170, 'App\\Models\\User', 3, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/110.0.0.0 Safari/537.36 OPR/96.0.0.0', '2023-03-26 04:10:38', 1, '2023-03-26 04:10:43', 0, NULL),
(171, 'App\\Models\\User', 3, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/110.0.0.0 Safari/537.36 OPR/96.0.0.0', '2023-03-26 04:11:07', 1, '2023-03-26 04:11:13', 0, NULL),
(172, 'App\\Models\\User', 3, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/110.0.0.0 Safari/537.36 OPR/96.0.0.0', '2023-03-26 04:14:51', 1, NULL, 0, NULL),
(173, 'App\\Models\\User', 3, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/110.0.0.0 Safari/537.36 OPR/96.0.0.0', '2023-03-26 04:15:35', 1, '2023-03-26 04:15:43', 0, NULL),
(174, 'App\\Models\\User', 3, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/110.0.0.0 Safari/537.36 OPR/96.0.0.0', '2023-03-26 04:16:47', 0, NULL, 0, NULL),
(175, 'App\\Models\\User', 3, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/110.0.0.0 Safari/537.36 OPR/96.0.0.0', '2023-03-26 04:18:56', 1, '2023-03-26 04:19:02', 0, NULL),
(176, 'App\\Models\\User', 3, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/110.0.0.0 Safari/537.36 OPR/96.0.0.0', '2023-03-26 04:20:29', 1, '2023-03-26 04:20:29', 0, NULL),
(177, 'App\\Models\\User', 3, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/110.0.0.0 Safari/537.36 OPR/96.0.0.0', '2023-03-26 04:21:15', 1, '2023-03-26 04:21:15', 0, NULL),
(178, 'App\\Models\\User', 3, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/110.0.0.0 Safari/537.36 OPR/96.0.0.0', '2023-03-26 04:21:23', 1, '2023-03-26 04:21:23', 0, NULL),
(179, 'App\\Models\\User', 3, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/110.0.0.0 Safari/537.36 OPR/96.0.0.0', '2023-03-26 04:21:53', 1, '2023-03-26 04:21:53', 0, NULL),
(180, 'App\\Models\\User', 3, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/110.0.0.0 Safari/537.36 OPR/96.0.0.0', '2023-03-26 04:22:19', 1, '2023-03-26 04:22:24', 0, NULL),
(181, 'App\\Models\\User', 3, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/110.0.0.0 Safari/537.36 OPR/96.0.0.0', '2023-03-26 04:23:43', 1, '2023-03-26 04:23:47', 0, NULL),
(182, 'App\\Models\\User', 3, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/110.0.0.0 Safari/537.36 OPR/96.0.0.0', '2023-03-26 04:24:16', 1, '2023-03-26 04:24:16', 0, NULL),
(183, 'App\\Models\\User', 22, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/110.0.0.0 Safari/537.36 OPR/96.0.0.0', '2023-03-26 04:28:57', 1, '2023-03-26 06:08:46', 0, NULL),
(184, 'App\\Models\\User', 3, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/110.0.0.0 Safari/537.36 OPR/96.0.0.0', '2023-03-26 06:08:49', 1, NULL, 0, NULL),
(185, 'App\\Models\\Admin', 2, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/111.0.0.0 Safari/537.36', '2023-03-26 09:17:53', 1, NULL, 0, NULL),
(186, 'App\\Models\\Admin', 2, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/111.0.0.0 Safari/537.36', '2023-03-26 13:46:50', 1, NULL, 0, NULL),
(187, 'App\\Models\\User', 3, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/110.0.0.0 Safari/537.36 OPR/96.0.0.0', '2023-03-26 14:44:46', 1, NULL, 0, NULL),
(188, 'App\\Models\\Admin', 2, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/111.0.0.0 Safari/537.36', '2023-03-27 03:43:19', 1, NULL, 0, NULL),
(189, 'App\\Models\\User', 3, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/110.0.0.0 Safari/537.36 OPR/96.0.0.0', '2023-03-27 03:44:26', 1, NULL, 0, NULL),
(190, 'App\\Models\\Admin', 2, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/111.0.0.0 Safari/537.36', '2023-03-27 05:24:57', 1, NULL, 0, NULL),
(191, 'App\\Models\\Admin', 2, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/111.0.0.0 Safari/537.36', '2023-03-27 05:25:14', 1, NULL, 0, NULL),
(192, 'App\\Models\\Admin', 2, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/111.0.0.0 Safari/537.36', '2023-03-27 14:04:14', 1, '2023-03-27 15:30:17', 0, NULL),
(193, 'App\\Models\\Admin', 2, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/110.0.0.0 Safari/537.36 OPR/96.0.0.0', '2023-03-27 15:40:21', 0, NULL, 0, NULL),
(194, 'App\\Models\\Admin', 2, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/111.0.0.0 Safari/537.36', '2023-03-27 15:50:25', 1, NULL, 0, NULL),
(195, 'App\\Models\\Admin', 2, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/111.0.0.0 Safari/537.36', '2023-03-28 06:19:22', 1, '2023-03-28 07:46:21', 0, NULL),
(196, 'App\\Models\\Admin', 2, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/111.0.0.0 Safari/537.36', '2023-03-28 10:21:10', 1, NULL, 0, NULL),
(197, 'App\\Models\\Admin', 2, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/111.0.0.0 Safari/537.36', '2023-03-28 15:26:47', 1, NULL, 0, NULL),
(198, 'App\\Models\\User', 3, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/110.0.0.0 Safari/537.36 OPR/96.0.0.0', '2023-03-28 15:32:27', 1, NULL, 0, NULL),
(199, 'App\\Models\\Admin', 2, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/111.0.0.0 Safari/537.36', '2023-03-29 09:01:34', 1, NULL, 0, NULL),
(200, 'App\\Models\\Admin', 2, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/111.0.0.0 Safari/537.36', '2023-03-29 09:01:38', 1, NULL, 0, NULL),
(201, 'App\\Models\\Admin', 2, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/111.0.0.0 Safari/537.36', '2023-03-29 14:47:21', 1, NULL, 0, NULL),
(202, 'App\\Models\\User', 3, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/110.0.0.0 Safari/537.36 OPR/96.0.0.0', '2023-03-29 18:01:52', 1, NULL, 0, NULL),
(203, 'App\\Models\\Admin', 2, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/111.0.0.0 Safari/537.36', '2023-03-30 07:01:01', 1, NULL, 0, NULL),
(204, 'App\\Models\\User', 3, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/110.0.0.0 Safari/537.36 OPR/96.0.0.0', '2023-03-30 07:01:58', 1, NULL, 0, NULL),
(205, 'App\\Models\\Admin', 2, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/111.0.0.0 Safari/537.36', '2023-03-31 05:20:43', 1, NULL, 0, NULL),
(206, 'App\\Models\\User', 3, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/110.0.0.0 Safari/537.36 OPR/96.0.0.0', '2023-03-31 05:43:44', 1, NULL, 0, NULL),
(207, 'App\\Models\\Admin', 2, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/111.0.0.0 Safari/537.36', '2023-03-31 15:11:14', 1, NULL, 0, NULL),
(208, 'App\\Models\\Admin', 2, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/111.0.0.0 Safari/537.36', '2023-04-01 04:39:30', 1, NULL, 0, NULL),
(209, 'App\\Models\\User', 3, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/110.0.0.0 Safari/537.36 OPR/96.0.0.0', '2023-04-01 05:48:37', 1, NULL, 0, NULL),
(210, 'App\\Models\\Admin', 13, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/111.0.0.0 Safari/537.36 Edg/111.0.1661.54', '2023-04-01 05:49:49', 0, NULL, 0, NULL),
(211, 'App\\Models\\Admin', 13, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/111.0.0.0 Safari/537.36 Edg/111.0.1661.54', '2023-04-01 05:49:57', 0, NULL, 0, NULL),
(212, 'App\\Models\\Admin', 13, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/111.0.0.0 Safari/537.36 Edg/111.0.1661.54', '2023-04-01 05:51:05', 0, NULL, 0, NULL),
(213, 'App\\Models\\User', 17, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/111.0.0.0 Safari/537.36 Edg/111.0.1661.54', '2023-04-01 05:51:52', 1, NULL, 0, NULL),
(214, 'App\\Models\\Admin', 2, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/111.0.0.0 Safari/537.36', '2023-04-01 11:31:06', 1, NULL, 0, NULL),
(215, 'App\\Models\\Admin', 2, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/111.0.0.0 Safari/537.36', '2023-04-01 15:41:11', 1, NULL, 0, NULL),
(216, 'App\\Models\\User', 3, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/110.0.0.0 Safari/537.36 OPR/96.0.0.0', '2023-04-01 15:43:49', 1, NULL, 0, NULL),
(217, 'App\\Models\\Admin', 2, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/111.0.0.0 Safari/537.36', '2023-04-02 05:07:33', 1, NULL, 0, NULL),
(218, 'App\\Models\\Admin', 2, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/111.0.0.0 Safari/537.36', '2023-04-02 12:01:32', 1, NULL, 0, NULL),
(219, 'App\\Models\\User', 14, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/110.0.0.0 Safari/537.36 OPR/96.0.0.0', '2023-04-02 12:44:03', 1, '2023-04-02 12:48:07', 0, NULL),
(220, 'App\\Models\\Admin', 15, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/110.0.0.0 Safari/537.36 OPR/96.0.0.0', '2023-04-02 12:48:17', 1, '2023-04-02 12:49:00', 0, NULL),
(221, 'App\\Models\\Admin', 15, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/110.0.0.0 Safari/537.36 OPR/96.0.0.0', '2023-04-02 12:49:13', 1, NULL, 0, NULL),
(222, 'App\\Models\\Admin', 2, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/111.0.0.0 Safari/537.36', '2023-04-02 16:52:33', 1, '2023-04-02 20:14:08', 0, NULL),
(223, 'App\\Models\\User', 16, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/111.0.0.0 Safari/537.36 Edg/111.0.1661.54', '2023-04-02 18:09:04', 0, NULL, 0, NULL),
(224, 'App\\Models\\User', 16, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/111.0.0.0 Safari/537.36 Edg/111.0.1661.54', '2023-04-02 18:09:34', 0, NULL, 0, NULL),
(225, 'App\\Models\\User', 16, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/110.0.0.0 Safari/537.36 OPR/96.0.0.0', '2023-04-02 19:09:37', 1, '2023-04-02 19:09:37', 0, NULL),
(226, 'App\\Models\\User', 16, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/110.0.0.0 Safari/537.36 OPR/96.0.0.0', '2023-04-02 19:11:10', 1, '2023-04-02 19:54:57', 0, NULL),
(227, 'App\\Models\\User', 16, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/110.0.0.0 Safari/537.36 OPR/96.0.0.0', '2023-04-02 19:55:18', 1, '2023-04-02 20:06:57', 0, NULL),
(228, 'App\\Models\\User', 16, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/110.0.0.0 Safari/537.36 OPR/96.0.0.0', '2023-04-02 20:07:14', 1, '2023-04-02 20:07:41', 0, NULL),
(229, 'App\\Models\\User', 12, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/110.0.0.0 Safari/537.36 OPR/96.0.0.0', '2023-04-02 20:11:23', 1, '2023-04-02 20:11:37', 0, NULL),
(230, 'App\\Models\\Admin', 2, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/111.0.0.0 Safari/537.36', '2023-04-02 20:32:44', 1, NULL, 0, NULL),
(231, 'App\\Models\\Admin', 2, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/111.0.0.0 Safari/537.36', '2023-04-03 06:12:08', 1, NULL, 0, NULL),
(232, 'App\\Models\\Admin', 2, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/111.0.0.0 Safari/537.36', '2023-04-03 12:36:51', 1, NULL, 0, NULL),
(233, 'App\\Models\\User', 3, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/111.0.0.0 Safari/537.36 OPR/97.0.0.0', '2023-04-03 13:04:55', 1, '2023-04-03 13:04:55', 0, NULL),
(234, 'App\\Models\\User', 3, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/111.0.0.0 Safari/537.36 OPR/97.0.0.0', '2023-04-03 13:05:31', 1, NULL, 0, NULL),
(235, 'App\\Models\\User', 3, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/111.0.0.0 Safari/537.36 OPR/97.0.0.0', '2023-04-03 15:37:14', 1, NULL, 0, NULL),
(236, 'App\\Models\\Admin', 2, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/111.0.0.0 Safari/537.36', '2023-04-03 15:38:42', 1, NULL, 0, NULL),
(237, 'App\\Models\\Admin', 2, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/111.0.0.0 Safari/537.36', '2023-04-03 17:35:56', 1, NULL, 0, NULL);
INSERT INTO `authentication_log` (`id`, `authenticatable_type`, `authenticatable_id`, `ip_address`, `user_agent`, `login_at`, `login_successful`, `logout_at`, `cleared_by_user`, `location`) VALUES
(238, 'App\\Models\\User', 3, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/111.0.0.0 Safari/537.36 OPR/97.0.0.0', '2023-04-03 17:51:33', 1, NULL, 0, NULL),
(239, 'App\\Models\\Admin', 2, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/111.0.0.0 Safari/537.36', '2023-04-04 04:33:20', 1, NULL, 0, NULL),
(240, 'App\\Models\\Admin', 2, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/111.0.0.0 Safari/537.36', '2023-04-04 05:32:48', 1, NULL, 0, NULL),
(241, 'App\\Models\\Admin', 2, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/111.0.0.0 Safari/537.36', '2023-04-04 05:36:15', 1, NULL, 0, NULL),
(242, 'App\\Models\\Admin', 2, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/111.0.0.0 Safari/537.36', '2023-04-04 05:37:26', 1, NULL, 0, NULL),
(243, 'App\\Models\\User', 3, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/111.0.0.0 Safari/537.36 OPR/97.0.0.0', '2023-04-04 05:37:44', 1, NULL, 0, NULL),
(244, 'App\\Models\\Admin', 2, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/111.0.0.0 Safari/537.36', '2023-04-04 10:45:38', 1, NULL, 0, NULL);

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
  `status` enum('1','2','3','4') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
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
(1, 1, 15, 0, 0, '3', 2023, '2.30', '2023-04-06', 5084610, '2023-03-01 09:20:47', '2023-04-04 05:52:06'),
(2, 1, 12, 0, 0, '3', 2023, '2.30', '2023-04-06', 3176723, '2023-03-01 09:20:47', '2023-04-04 05:52:06'),
(3, 1, 16, 0, 0, '3', 2023, '2.30', '2023-04-06', 9957878, '2023-03-01 09:20:47', '2023-04-04 05:52:06'),
(4, 3, 1, 0, 0, '3', 2023, '3.00', '2023-03-23', 8121639, '2023-03-13 08:58:44', '2023-03-23 05:50:38'),
(5, 3, 12, 0, 0, '3', 2023, '3.00', '2023-03-23', 7804318, '2023-03-13 08:58:44', '2023-03-23 05:50:38'),
(6, 3, 16, 0, 0, '3', 2023, '3.00', '2023-03-23', 3975551, '2023-03-13 08:58:44', '2023-03-23 05:50:38'),
(7, 3, 17, 0, 0, '3', 2023, '3.00', '2023-03-23', 3807363, '2023-03-13 16:13:52', '2023-03-23 05:50:39'),
(8, 3, 7, 0, 0, '3', 2023, '3.00', '2023-03-23', 5520690, '2023-03-13 16:28:19', '2023-03-23 05:50:39'),
(9, 1, 17, 1, 1, '2', 2023, '2.30', '2023-04-06', 4783378, '2023-03-13 16:48:28', '2023-04-04 05:52:06'),
(10, 4, 16, 1, 1, '2', 2023, NULL, '2023-03-25', 4251711, '2023-03-22 09:12:03', '2023-03-24 17:55:51'),
(11, 3, 3, 0, 0, '3', 2023, '3.00', '2023-03-23', 8663225, '2023-03-23 05:42:00', '2023-03-23 05:50:39'),
(12, 2, 3, 0, 0, '3', 2023, '2.00', NULL, NULL, '2023-03-23 05:53:06', '2023-03-23 05:53:06'),
(13, 4, 3, 0, 0, '4', 2023, '2.00', '2023-03-25', 6009194, '2023-03-23 08:37:25', '2023-03-26 06:09:17'),
(14, 4, 17, 0, 0, '3', 2023, NULL, '2023-03-25', 4972305, '2023-03-24 08:53:47', '2023-03-24 17:55:51'),
(15, 4, 1, 0, 0, '3', 2023, NULL, '2023-03-25', 6364318, '2023-03-24 08:54:14', '2023-03-24 17:55:51'),
(16, 4, 20, 0, 0, '3', 2023, NULL, '2023-03-25', 8141191, '2023-03-24 08:54:14', '2023-03-24 17:55:51'),
(17, 4, 6, 0, 0, '3', 2023, NULL, '2023-03-25', 9859331, '2023-03-24 08:54:14', '2023-03-24 17:55:51'),
(19, 4, 7, 0, 0, '3', 2023, NULL, '2023-03-25', 8866904, '2023-03-24 08:54:14', '2023-03-24 17:55:51'),
(20, 4, 14, 0, 0, '3', 2023, NULL, '2023-03-25', 7621778, '2023-03-24 08:54:14', '2023-03-24 17:55:51'),
(23, 1, 3, 0, 0, '3', 2023, '2.30', '2023-04-06', 6927149, '2023-04-02 05:42:25', '2023-04-04 05:52:06'),
(24, 5, 23, 0, 0, '3', 2023, NULL, NULL, NULL, '2023-04-02 05:44:52', '2023-04-02 05:44:52'),
(25, 5, 17, 0, 0, '3', 2023, NULL, NULL, NULL, '2023-04-02 05:44:52', '2023-04-02 05:44:52'),
(26, 5, 3, 0, 0, '3', 2023, NULL, NULL, NULL, '2023-04-02 05:44:52', '2023-04-02 05:44:52');

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
  `total_credits` decimal(8,2) NOT NULL DEFAULT 0.00,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `created_by` bigint(20) UNSIGNED NOT NULL,
  `update_by` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `compliances`
--

INSERT INTO `compliances` (`id`, `year`, `cle_credits`, `meeting_credits`, `extra_credits`, `total_credits`, `user_id`, `created_by`, `update_by`, `created_at`, `updated_at`) VALUES
(5, 2023, '5.30', '5.00', '0.00', '15.30', 16, 2, 2, '2023-03-23 09:01:10', '2023-04-04 05:52:06'),
(6, 2023, '9.30', '5.00', '6.70', '40.00', 3, 2, 2, '2023-03-23 10:44:44', '2023-04-04 05:52:06'),
(7, 2023, '3.00', '5.00', '0.00', '6.00', 7, 2, 2, '2023-03-24 08:45:51', '2023-03-24 17:55:51'),
(8, 2022, '3.00', '5.00', '0.00', '0.00', 1, 2, 2, '2023-03-24 08:50:24', '2023-03-24 08:54:27'),
(9, 2022, '5.00', '4.00', '0.00', '0.00', 17, 2, 2, '2023-03-24 08:50:51', '2023-03-24 08:54:27'),
(10, 2023, '0.00', '2.00', '0.00', '0.00', 20, 2, 2, '2023-03-24 08:51:13', '2023-03-24 17:55:51'),
(11, 2023, '5.30', '3.00', '0.00', '5.30', 12, 2, 2, '2023-03-24 08:51:46', '2023-04-04 05:52:06'),
(12, 2023, '0.00', '3.00', '0.00', '0.00', 6, 2, 2, '2023-03-24 08:52:09', '2023-03-24 17:55:51'),
(13, 2023, '0.00', '3.00', '0.00', '0.00', 10, 2, 2, '2023-03-24 08:52:18', '2023-03-24 17:55:51'),
(14, 2023, '0.00', '3.00', '0.00', '0.00', 14, 2, 2, '2023-03-24 08:52:43', '2023-03-24 17:55:51'),
(15, 2023, '5.30', '0.00', '0.00', '15.30', 17, 2, 2, '2023-03-24 17:54:39', '2023-04-04 05:52:06'),
(16, 2023, '3.00', '0.00', '0.00', '6.00', 1, 2, 2, '2023-03-24 17:54:39', '2023-03-24 17:55:51'),
(17, 2023, '2.30', '0.00', '0.00', '2.30', 15, 2, 2, '2023-04-04 05:52:06', '2023-04-04 05:52:06');

-- --------------------------------------------------------

--
-- Table structure for table `contribute_advocates`
--

CREATE TABLE `contribute_advocates` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `amount` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `transction_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `reference_no` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `transction_date` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
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
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `start_period` date NOT NULL,
  `end_period` date NOT NULL,
  `deadline` date NOT NULL,
  `amount` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `percentage` decimal(8,2) NOT NULL,
  `concern` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
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
  `p_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `p_email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `p_phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `p_advocate` int(11) DEFAULT NULL,
  `d_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `d_email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `d_phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `d_advocate` int(11) DEFAULT NULL,
  `case_number` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `case_type` enum('1','2','3') COLLATE utf8mb4_unicode_ci NOT NULL,
  `complaint` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sammary` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `case_status` enum('OPEN','CLOSED') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'OPEN',
  `authority` enum('BATONIER','DISCIPLINARY COMMITEE') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'BATONIER',
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
(4, 'Byamungu', 'byamungulewis@gmail.com', '0785436135', NULL, 'Akimana Olivie', 'www.byamungulewis@gmail.com', NULL, 17, 'DC/4/2023', '1', 'Just compaint', 'Just compaint Just compaint Just compaint', 'OPEN', 'BATONIER', 2, '2023-03-21 10:51:28', '2023-03-21 10:51:28'),
(5, 'Muhire', 'muhire@gmail.com', '0786536667', NULL, 'Sugira Yves', 'sugira@gmail.com', NULL, 6, 'DC/5/2023', '1', 'Just compaint Just compaint', 'Just compaint Just compaint Just compaintJust compaint', 'OPEN', 'BATONIER', 2, '2023-03-26 03:30:01', '2023-03-25 22:00:00'),
(6, 'Akimana Olivie', 'www.byamungulewis@gmail.com', NULL, 17, 'Ntwari Lebon', 'ntwarilebon09@gmail.com', NULL, 16, 'DC/6/2023', '3', 'Test Discipline', 'Test Discipline Test Discipline', 'OPEN', 'BATONIER', 2, '2023-03-26 10:54:06', '2023-03-26 10:54:06');

-- --------------------------------------------------------

--
-- Table structure for table `discipline_participants`
--

CREATE TABLE `discipline_participants` (
  `table_id` bigint(20) UNSIGNED NOT NULL,
  `discipline_case` bigint(20) NOT NULL,
  `advocate` bigint(20) NOT NULL,
  `role` enum('Plaintiff','Defendant') COLLATE utf8mb4_unicode_ci NOT NULL,
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
(5, 4, 17, 'Plaintiff', '2023-03-21 10:51:28', '2023-03-21 10:51:28'),
(6, 5, 6, 'Plaintiff', '2023-03-26 03:30:01', '2023-03-25 22:00:00'),
(7, 6, 17, 'Plaintiff', '2023-03-26 10:54:06', '2023-03-26 10:54:06'),
(8, 6, 16, 'Defendant', '2023-03-26 10:54:06', '2023-03-26 10:54:06');

-- --------------------------------------------------------

--
-- Table structure for table `discipline_reports`
--

CREATE TABLE `discipline_reports` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `comments` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `attachements` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `sitting_id` bigint(20) UNSIGNED NOT NULL,
  `discipline_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `discipline_reports`
--

INSERT INTO `discipline_reports` (`id`, `comments`, `attachements`, `user_id`, `sitting_id`, `discipline_id`, `created_at`, `updated_at`) VALUES
(1, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.', '193008-130405-CoverPage.docx,193008-vouchers (2).pdf,193008-Feedback march 23 (1).docx', 3, 1, 1, '2023-03-26 17:30:08', '2023-03-26 17:30:08');

-- --------------------------------------------------------

--
-- Table structure for table `discipline_sittings`
--

CREATE TABLE `discipline_sittings` (
  `sitting_id` bigint(20) UNSIGNED NOT NULL,
  `category` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sittingDay` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'NONE',
  `sittingTime` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'NONE',
  `sittingVenue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'NONE',
  `discipline_case` bigint(20) UNSIGNED NOT NULL,
  `decisionCategory` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `targetedAdvocate` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `comment` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `attach_file` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `scheduledBy` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `discipline_sittings`
--

INSERT INTO `discipline_sittings` (`sitting_id`, `category`, `sittingDay`, `sittingTime`, `sittingVenue`, `discipline_case`, `decisionCategory`, `targetedAdvocate`, `comment`, `attach_file`, `scheduledBy`, `created_at`, `updated_at`) VALUES
(1, 'Hearing by BATONIER', '2023-03-14', '17:05', 'Online', 1, 'Suspended Advocate', '3', 'We choose to suspend you', '', 2, NULL, '2023-04-02 07:46:55'),
(2, 'Hearing by BATONIER', '2023-03-29', '02:57', 'Online', 2, NULL, NULL, NULL, NULL, 2, NULL, '2023-03-25 20:54:24'),
(3, '', 'NONE', 'NONE', 'NONE', 3, NULL, NULL, NULL, NULL, 2, NULL, NULL),
(4, 'Hearing by BATONIER', '2023-03-29', '01:53', 'Online', 4, 'Referral to discipline commitee', 'N/A', '$attachmentsPaths $attachmentsPaths $attachmentsPaths $attachmentsPaths', '083819-Hope this.pdf,083819-mycv.pdf,083819-ADEPR Church Narrative Report 2022 - FINAL PRINT .pdf', 2, '2023-03-21 10:51:28', '2023-03-27 06:38:19'),
(5, '', 'NONE', 'NONE', 'NONE', 5, NULL, NULL, NULL, NULL, 2, '2023-03-26 03:30:01', '2023-03-26 03:30:01'),
(6, '', 'NONE', 'NONE', 'NONE', 6, NULL, NULL, NULL, NULL, 2, '2023-03-26 10:54:06', '2023-03-26 10:54:06');

-- --------------------------------------------------------

--
-- Table structure for table `extra_cles`
--

CREATE TABLE `extra_cles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `closing_date` date NOT NULL,
  `category` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
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
(7, 'second', '2023-03-24', 'CLE', 30, '2.01', 3, 2023, '2023-03-23 11:08:28', '2023-03-23 11:08:28'),
(8, 'test', '2023-03-24', 'Lecture', 20, '1.34', 3, 2023, '2023-03-24 17:45:33', '2023-03-24 17:45:33'),
(9, 'helo', '2023-03-31', 'CLE', 30, '2.01', 3, 2023, '2023-03-24 17:47:39', '2023-03-24 17:47:39');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
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
(1, 1, 1, '3.00', 2, 2023, '2023-03-14 08:20:14', '2023-03-24 08:51:37'),
(2, 3, 1, '3.00', 2, 2023, '2023-03-14 08:20:14', '2023-03-23 08:31:46'),
(3, 6, 1, '3.00', 2, 2023, '2023-03-14 08:20:14', '2023-03-24 08:52:09'),
(4, 7, 1, '3.00', 1, 2023, '2023-03-14 08:20:14', '2023-03-24 08:52:28'),
(5, 10, 1, '3.00', 2, 2023, '2023-03-14 08:20:14', '2023-03-24 08:52:18'),
(6, 12, 1, '3.00', 2, 2023, '2023-03-14 08:20:14', '2023-03-24 08:51:46'),
(7, 14, 1, '3.00', 2, 2023, '2023-03-14 08:20:14', '2023-03-24 08:52:43'),
(8, 16, 1, '3.00', 2, 2023, '2023-03-14 08:20:14', '2023-03-24 08:51:59'),
(9, 17, 1, '2.00', 2, 2023, '2023-03-14 08:20:14', '2023-03-14 08:20:50'),
(10, 3, 2, '2.00', 2, 2023, '2023-03-23 07:36:10', '2023-03-24 18:03:50'),
(11, 7, 2, '2.00', 2, 2023, '2023-03-23 07:36:56', '2023-03-24 08:45:51'),
(12, 1, 2, '2.00', 2, 2023, '2023-03-24 08:50:06', '2023-03-24 08:50:24'),
(13, 16, 2, '2.00', 2, 2023, '2023-03-24 08:50:40', '2023-03-24 08:51:03'),
(14, 17, 2, '2.00', 2, 2023, '2023-03-24 08:50:40', '2023-03-24 08:50:51'),
(15, 20, 2, '2.00', 2, 2023, '2023-03-24 08:50:40', '2023-03-24 08:51:13');

-- --------------------------------------------------------

--
-- Table structure for table `lawscategories`
--

CREATE TABLE `lawscategories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
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
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
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
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date` date NOT NULL,
  `start` time NOT NULL,
  `end` time NOT NULL,
  `venue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `credits` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `concern` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
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
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
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
(56, '2023_03_23_054654_create_compliances_table', 31),
(57, '2023_03_26_172929_create_discipline_reports_table', 32),
(58, '2023_03_28_195105_create_probonocategories_table', 33),
(59, '2023_03_29_05045_create_probonos_table', 34),
(60, '2023_03_30_735114_create_probono_files_table', 34),
(61, '2023_03_30_912859_create_probono_devs_table', 34),
(62, '2023_03_31_090751_create_probono_participants_table', 34);

-- --------------------------------------------------------

--
-- Table structure for table `model_has_permissions`
--

CREATE TABLE `model_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `model_has_roles`
--

CREATE TABLE `model_has_roles` (
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
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
  `tin` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` enum('Lawfirm','Other') COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `blocked` tinyint(1) NOT NULL DEFAULT 0,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
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
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
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
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `phonenumbers`
--

INSERT INTO `phonenumbers` (`id`, `name`, `phone`, `user_id`, `created_at`, `updated_at`) VALUES
(25, 'mobile', '0788672799', 2, '2023-02-04 08:42:36', '2023-02-04 08:42:36'),
(31, 'mobile', '0789888976', 8, '2023-02-04 09:50:12', '2023-02-04 09:50:12'),
(32, 'mobile', '0778883333', 9, '2023-02-06 10:31:32', '2023-02-06 10:31:32'),
(38, 'mobile', '0785533688', 6, '2023-02-08 07:53:39', '2023-02-08 07:53:39'),
(39, 'mobile', '0786633555', 11, '2023-02-08 07:56:41', '2023-02-08 07:56:41'),
(47, 'mobile', '0799900000', 10, '2023-02-08 08:53:07', '2023-02-08 08:53:07'),
(56, 'mobile', '0788663635', 7, '2023-02-08 10:00:04', '2023-02-08 10:00:04'),
(61, 'mobile', '0788773322', 4, '2023-02-10 15:33:05', '2023-02-10 15:33:05'),
(65, 'mobile', '0788776666', 14, '2023-02-11 05:43:49', '2023-02-11 05:43:49'),
(71, 'mobile', '0785436135', 17, '2023-03-13 03:14:26', '2023-03-13 03:14:26'),
(79, 'mobile', '7854666777', 21, '2023-03-14 09:59:36', '2023-03-14 09:59:36'),
(80, 'mobile', '0788672782', 13, '2023-03-16 13:31:42', '2023-03-16 13:31:42'),
(81, 'mobile', '0733227322', 5, '2023-03-21 11:23:16', '2023-03-21 11:23:16'),
(83, 'mobile', '0787766678', 15, '2023-03-22 08:44:52', '2023-03-22 08:44:52'),
(85, 'mobile', '0786663552', 22, '2023-03-26 04:28:11', '2023-03-26 04:28:11'),
(94, 'mobile', '0785436135', 1, '2023-04-02 17:50:45', '2023-04-02 17:50:45'),
(95, 'mobile', '0788672782', 16, '2023-04-02 17:52:00', '2023-04-02 17:52:00'),
(97, 'mobile', '0782185745', 12, '2023-04-02 20:01:38', '2023-04-02 20:01:38'),
(98, 'mobile', '0780003888', 3, '2023-04-02 20:01:53', '2023-04-02 20:01:53'),
(99, 'mobile', '0786635555', 23, '2023-04-02 20:02:04', '2023-04-02 20:02:04'),
(100, 'mobile', '0783555522', 24, '2023-04-02 20:02:15', '2023-04-02 20:02:15'),
(101, 'mobile', '7854361352', 20, '2023-04-02 20:02:25', '2023-04-02 20:02:25'),
(102, 'mobile', '0733227322', 25, '2023-04-03 06:14:16', '2023-04-03 06:14:16');

-- --------------------------------------------------------

--
-- Table structure for table `probonocategories`
--

CREATE TABLE `probonocategories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `probonocategories`
--

INSERT INTO `probonocategories` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Case Against RBA', NULL, NULL),
(2, 'Lagal Aid to Genaral Public', NULL, NULL),
(3, 'Minors', NULL, NULL),
(4, 'Supreme Court', NULL, NULL),
(5, 'Count', NULL, NULL),
(6, 'Prosecutor', NULL, NULL),
(7, 'Police', NULL, NULL),
(8, 'Prison', NULL, NULL),
(9, 'Others', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `probonos`
--

CREATE TABLE `probonos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `fname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `gender` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `age` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `referral_case_no` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jurisdiction` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `court` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `case_nature` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `probono_files` int(11) NOT NULL DEFAULT 0,
  `probono_devs` int(11) NOT NULL DEFAULT 0,
  `hearing_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `category` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `referrel` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `court_dessision` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `comments` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` enum('OPEN','WON','LOST','TRANSACTED') COLLATE utf8mb4_unicode_ci NOT NULL,
  `register` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `probonos`
--

INSERT INTO `probonos` (`id`, `fname`, `lname`, `gender`, `age`, `phone`, `referral_case_no`, `jurisdiction`, `court`, `case_nature`, `probono_files`, `probono_devs`, `hearing_date`, `category`, `referrel`, `court_dessision`, `comments`, `status`, `register`, `created_at`, `updated_at`) VALUES
(1, 'Aisha', 'Mukarugina', 'Female', '30', '0785533688', 'RC/23/2023-DH', 'Testing', 'Rwanda court', 'Civil', 0, 0, '2023-04-04 22:00:00', 'Minors', 'Lewis Testing', NULL, NULL, 'OPEN', 2, '2023-03-31 07:44:16', '2023-03-31 07:44:16'),
(2, 'Ukwishaka', 'shemsah', 'Female', '23', '0785533688', 'RC/23/2023-DHAW', 'Testing 1', 'Rwanda court 1', 'Civil', 2, 2, '2023-04-01 10:50:37', 'Police', 'Mousa ramadani', NULL, 'Case lost   Case lost Case lost Case lost Case lost', 'LOST', 2, '2023-03-31 07:56:23', '2023-04-01 08:50:37'),
(3, 'First_T', 'last', 'Male', '41', '0786633555', 'RC/23/2023-DHAW', 'Testing3', 'Rwanda court 2', 'Civil', 1, 0, '2023-04-01 08:04:40', 'Count', 'Mousa ramadani', NULL, NULL, 'OPEN', 2, '2023-03-31 17:40:17', '2023-04-01 06:04:40');

-- --------------------------------------------------------

--
-- Table structure for table `probono_devs`
--

CREATE TABLE `probono_devs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `status` enum('OPEN','WON','LOST','TRANSACTED') COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `narration` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `attach_file` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `reaction` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `reportedBy` int(11) DEFAULT NULL,
  `reporter_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `probono_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `probono_devs`
--

INSERT INTO `probono_devs` (`id`, `status`, `title`, `narration`, `attach_file`, `reaction`, `reportedBy`, `reporter_name`, `probono_id`, `created_at`, `updated_at`) VALUES
(2, 'OPEN', 'Gusaba ubusobanuro', 'Gusaba ubusobanuro Gusaba ubusobanuro Gusaba ubusobanuro', '074257-vouchers (15).pdf', NULL, NULL, 'BYAMUNGU Lewis', 2, '2023-04-01 05:42:57', '2023-04-01 05:42:57'),
(3, 'WON', 'testing EventTitle', 'testing EventTitle testing EventTitle testing EventTitle testing EventTitle', NULL, NULL, 17, 'Akimana Olivie', 2, '2023-04-01 06:11:44', '2023-04-01 06:11:44');

-- --------------------------------------------------------

--
-- Table structure for table `probono_files`
--

CREATE TABLE `probono_files` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `case_title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `case_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `case_file` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `probono_id` bigint(20) UNSIGNED NOT NULL,
  `register` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `probono_files`
--

INSERT INTO `probono_files` (`id`, `case_title`, `case_type`, `case_file`, `probono_id`, `register`, `created_at`, `updated_at`) VALUES
(1, 'File 1', 'Assignation', '080440-vouchers (14).pdf', 3, 2, '2023-04-01 06:04:40', '2023-04-01 06:04:40'),
(2, 'File 1', 'Assignation', '080458-vouchers (10).pdf', 2, 2, '2023-04-01 06:04:58', '2023-04-01 06:04:58'),
(3, 'Test File', 'Icyemezo', '080516-HR MANUEL FINAL.pdf', 2, 2, '2023-04-01 06:05:16', '2023-04-01 06:05:16');

-- --------------------------------------------------------

--
-- Table structure for table `probono_participants`
--

CREATE TABLE `probono_participants` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `probono_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `probono_participants`
--

INSERT INTO `probono_participants` (`id`, `user_id`, `probono_id`, `created_at`, `updated_at`) VALUES
(1, 24, 1, '2023-03-31 07:44:16', '2023-03-31 07:44:16'),
(2, 17, 2, '2023-03-31 18:30:41', '2023-03-31 18:42:29'),
(3, 16, 2, '2023-04-01 05:16:34', '2023-04-01 05:16:34');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
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
  `social` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `link` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
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
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `category` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `venue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `credits` decimal(8,2) NOT NULL,
  `price` decimal(8,2) NOT NULL,
  `starton` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `endon` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `early_deadline` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `late_deadline` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `rate` decimal(8,2) NOT NULL,
  `seats` int(11) NOT NULL,
  `confirm` int(11) NOT NULL DEFAULT 0,
  `booking` int(11) NOT NULL DEFAULT 0,
  `publish` enum('0','1') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
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
(4, 'Last Test', 'Publication', 'online', '2.00', '100.00', '2023-03-22', '2023-03-31', '2023-03-22', '2023-03-22 12:00', '10.00', 100, 1, 1, '1', 2, '2023-03-22 09:09:04', '2023-03-22 09:13:01'),
(5, 'Training Credit', 'Publication', 'online', '2.00', '100.00', '2023-04-02', '2023-04-05', '2023-04-02', '2023-04-03 13:00', '10.00', 12, 0, 0, '1', 2, '2023-04-02 05:44:30', '2023-04-02 05:44:30');

-- --------------------------------------------------------

--
-- Table structure for table `training_materials`
--

CREATE TABLE `training_materials` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `file` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `register` bigint(20) UNSIGNED NOT NULL,
  `training_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `training_materials`
--

INSERT INTO `training_materials` (`id`, `title`, `file`, `register`, `training_id`, `created_at`, `updated_at`) VALUES
(1, 'Test', '075114-MY_ID.pdf', 2, 1, '2023-04-04 05:51:14', '2023-04-04 05:51:14');

-- --------------------------------------------------------

--
-- Table structure for table `training_topics`
--

CREATE TABLE `training_topics` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `topic` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `startAt` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `endAt` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `trainer` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `register` bigint(20) UNSIGNED NOT NULL,
  `training_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `training_topics`
--

INSERT INTO `training_topics` (`id`, `topic`, `startAt`, `endAt`, `trainer`, `register`, `training_id`, `created_at`, `updated_at`) VALUES
(1, 'test', '13:00', '14:00', 'Lewis', 2, 1, '2023-04-04 05:50:54', '2023-04-04 05:50:54');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `district` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gender` enum('Male','Female') COLLATE utf8mb4_unicode_ci NOT NULL,
  `marital` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `photo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `diplome` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `regNumber` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('1','2','3','4') COLLATE utf8mb4_unicode_ci NOT NULL,
  `practicing` enum('1','2','3','4','5','6') COLLATE utf8mb4_unicode_ci NOT NULL,
  `category` enum('Advocate','Staff') COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date` date NOT NULL,
  `blocked` tinyint(1) NOT NULL DEFAULT 0,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `district`, `gender`, `marital`, `photo`, `diplome`, `username`, `email_verified_at`, `regNumber`, `status`, `practicing`, `category`, `password`, `date`, `blocked`, `remember_token`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'BYAMUNGU Lewis', 'byamungulewis@gmail.com', 'Rubavu', 'Male', '2', '103530-avatar-3.jpg', '063037-uuuu.jpg', NULL, NULL, '001/T/2023', '1', '5', 'Advocate', '$2y$10$K3vW9duPFWwgWyACXg93.Oy3T6v/j8dG4iuDCBsuf6gAn126mX4Qu', '2023-02-04', 0, NULL, NULL, '2023-02-04 04:30:37', '2023-04-02 18:02:52'),
(2, 'UWIZEWE Jean d\'Amour', 'uwizelogick2015@gmail.com', 'Kirehe', 'Male', '2', '101812-uuuu (2).jpg', '070842-signature.jpeg', NULL, NULL, '006/S/2023', '2', '2', 'Advocate', '$2y$10$9x8ROxUJHCTFVDa39jRp9.H/FXf28aKOymPWrqNrqbLYh7ASjEw0O', '2023-02-03', 1, NULL, '2023-02-08 06:24:16', '2023-02-04 05:07:15', '2023-02-08 06:24:16'),
(3, 'Aliane NIYONASENZE', 'alianeniyo03@gmail.com', 'Rwamagana', 'Female', '1', '103705-2.png', NULL, NULL, NULL, '003/T/2023', '1', '2', 'Advocate', '$2y$10$TcqWXvjwSMogrfKpXyFx3.r1dgEd08Q62OsDRTAzGErrmIPzTlkfO', '2023-02-03', 0, NULL, NULL, '2023-02-04 08:37:05', '2023-04-03 13:05:23'),
(4, 'UWIZEYE Julliene', 'uwizeye@gmail.com', 'Gicumbi', 'Female', '4', '103815-4.png', '104756-4.png', NULL, NULL, '004/T/2023', '1', '4', 'Advocate', '$2y$10$EKiBu1Q.Ljr9FZojkwvj3.dZ3chig3LYnTa.TJ34Z/6t.OI0nwbzG', '2023-02-10', 1, NULL, NULL, '2023-02-04 08:38:15', '2023-04-02 12:55:17'),
(5, 'NDAGIJIMANA Enock', 'ndagijimanaenock11@gmail.com', 'Kamonyi', 'Female', '3', '103916-7.png', NULL, NULL, NULL, '005/T/2023', '1', '3', 'Advocate', '$2y$10$osmgsc1xQJ5iGN2V7gKLBOTt38CBedOFvnnWLoTs.kgD.RwgHu2wu', '2023-01-30', 0, NULL, NULL, '2023-02-04 08:39:16', '2023-03-21 11:23:16'),
(6, 'Sugira Yves', 'sugira@gmail.com', 'Kayonza', 'Male', '4', '104036-9.png', NULL, NULL, NULL, '006/T/2023', '1', '3', 'Advocate', '$2y$10$l95eOBWN.2dF.8GKELROQuT6Qqj1puQ3iwnS4.BmrEy53dXNTxe6K', '2023-02-04', 0, NULL, NULL, '2023-02-04 08:40:36', '2023-04-02 20:03:46'),
(7, 'UMUTESI Deborah', 'umutesi@gmail.com', 'Muhanga', 'Male', '2', '104716-avatar-1.jpg', NULL, NULL, NULL, '007/T/2023', '1', '3', 'Advocate', '$2y$10$vCFo6jEDxyMZVwR.46bh7.V4FbnYWaf1lcjl1i7ABo1XTeikDREWW', '2023-02-03', 0, NULL, NULL, '2023-02-04 08:47:16', '2023-04-02 20:04:29'),
(8, 'MUHIRE Kevin', 'Kevin@gmail.com', 'Karongi', 'Female', '2', '115011-1.png', NULL, NULL, NULL, '008/T/2023', '1', '3', 'Advocate', '$2y$10$8OwJmOMW5ApgoIGjqmbvVO5idHfJ6Zq0nR.03UtW64DC24RPl/btO', '2023-02-04', 0, NULL, NULL, '2023-02-04 09:50:12', '2023-02-08 06:25:27'),
(9, 'Tessting', 'test@gmail.com', 'Gakenke', 'Female', '2', '123132-2.png', NULL, NULL, NULL, '009/T/2023', '1', '2', 'Advocate', '$2y$10$Os8.0HP.K5zyACb3Y.C2he98V9O7ZbWd2VZFnQvLi.KkjZYyJ/pdK', '2023-01-31', 1, NULL, '2023-02-06 10:31:42', '2023-02-06 10:31:32', '2023-02-06 10:31:42'),
(10, 'Umukozi liza', 'test@test.com', 'Musanze', 'Male', '4', '082342-6.png', '104638-6.png', NULL, NULL, '009/T/2023', '1', '3', 'Advocate', '$2y$10$EwJIntZEIr4KhSkCeJY1X.LXMWE5fjdgNMrbm0sXYPqt4rODwhAO.', '2023-02-02', 0, NULL, NULL, '2023-02-08 06:23:42', '2023-04-02 20:04:10'),
(11, 'Test Active user', 'test21@test.com', 'Bugesera', 'Female', '4', '095641-6.png', NULL, NULL, NULL, '009/S/2023', '2', '2', 'Advocate', '$2y$10$r4f5jgWuXJHin.LXET245efbJpEhJ1Jsx8cFN0y9IXdWAltJ/UqJm', '2023-02-07', 1, NULL, '2023-02-08 07:57:23', '2023-02-08 07:56:41', '2023-02-08 07:57:23'),
(12, 'Ndikumana Eric', 'ndikumanaeric001@gmail.com', 'Gakenke', 'Male', '4', NULL, NULL, NULL, NULL, '009/S/2023', '2', '2', 'Advocate', '$2y$10$ggGyekbYMBMEXvSGpOKsm.K9rJ/6SJ7.WUN6SMwR16/CeVm8xGata', '2023-02-08', 0, NULL, NULL, '2023-02-08 09:47:54', '2023-04-02 20:11:37'),
(13, 'Test Number', 'testnumber@test.com', 'Muhanga', 'Male', '3', NULL, NULL, NULL, NULL, '0010/T/2023', '1', '3', 'Advocate', '$2y$10$gT16G4Pg5cO.eR/oaKqrD.cQIpKgCqc7O5Yj.TN/HrB76K2YiHRD6', '2023-02-08', 0, NULL, NULL, '2023-02-08 09:50:20', '2023-02-10 15:35:02'),
(14, 'UMWIZAWASE Fanny', 'umwizawase@gmail.com', 'Karongi', 'Female', '1', '174004-avatar-5.jpg', NULL, NULL, NULL, '011/S/2023', '2', '3', 'Advocate', '$2y$10$4UD7FGgQKnswdIpauT0cp.S/vIOFkfHan4HVvcedh4WjRg5to.XL.', '2023-02-08', 0, NULL, NULL, '2023-02-10 15:40:04', '2023-04-02 20:04:49'),
(15, 'Lewis Test bmg', 'lewis@gmail.com', 'Ngoma', 'Male', '3', '081029-3.png', NULL, NULL, NULL, '012/S/2023', '2', '3', 'Advocate', '$2y$10$qtU6mL7EBtzJiog1chaJDOpmdL7I4SV0u4F4aMFI30T.Qz5tVdANO', '2023-02-15', 0, NULL, NULL, '2023-02-15 06:09:48', '2023-03-25 15:32:11'),
(16, 'Ntwari Lebon', 'ntwarilebon09@gmail.com', 'Kirehe', 'Male', '1', '121303-5.png', NULL, NULL, NULL, '013/T/2023', '1', '2', 'Advocate', '$2y$10$sgDh651BFIWwlW/BEJKBl.qqUWXSoVbYkHCRU5XooxywAcm1UYaNy', '2023-02-15', 0, NULL, NULL, '2023-02-15 10:13:03', '2023-04-02 20:07:41'),
(17, 'Akimana Olivie', 'www.byamungulewis@gmail.com', 'Muhanga', 'Male', '1', '051425-DSC_0866.JPG', NULL, NULL, NULL, '014/T/2023', '1', '5', 'Advocate', '$2y$10$OO9CWAz0lIhikp05g2MljeWbQoaensUrh2vDW22.npfX.VFhwtWxa', '2023-03-13', 1, NULL, NULL, '2023-03-13 03:14:26', '2023-04-02 18:02:54'),
(20, 'Intern user', 'intern@user.com', 'Musanze', 'Male', '3', NULL, NULL, NULL, NULL, '015/S/2023', '2', '3', 'Advocate', '$2y$10$0tueuE.tLJgooMrPODBf8u95iZPkmeXjdqZO.oJgWXFHrPto52ENu', '2023-03-13', 0, NULL, NULL, '2023-03-14 09:58:38', '2023-04-02 20:02:25'),
(21, 'Intern user2', 'intern2@user.com', 'Gisagara', 'Male', '2', NULL, NULL, NULL, NULL, '016/S/2023', '2', '3', 'Advocate', '$2y$10$8f2SWppC1uq7Wq18ROthv.aycVZeCzN/5R.0q5pi/jIVKnsynqZMi', '2023-03-13', 0, NULL, NULL, '2023-03-14 09:59:36', '2023-03-14 09:59:36'),
(22, 'Strong Password', 'stronger@gmail.com', 'Gatsibo', 'Female', '3', NULL, NULL, NULL, NULL, '017/T/2023', '1', '3', 'Advocate', '$2y$10$CHNa8QOkart7wcOIFSxv/.ci22q04cg1XVUBrueFg2XzJHtqjpxhy', '2023-03-21', 0, NULL, NULL, '2023-03-26 04:28:11', '2023-04-02 20:03:22'),
(23, 'Abimana Nuru', 'abimana@gmail.com', 'Ngoma', 'Female', '1', NULL, NULL, NULL, NULL, '18/T/2023', '1', '3', 'Advocate', '$2y$10$veMU6tOWsrpwDrvWb8uX5u/WOrt7xZLnSgpWiFap22Z8fxNA01TUC', '2023-03-28', 0, NULL, NULL, '2023-03-29 15:29:14', '2023-04-02 20:02:04'),
(24, 'Francais regis', 'regis@gmail.com', 'Ngororero', 'Male', '2', NULL, NULL, NULL, NULL, '19/S/2023', '2', '3', 'Advocate', '$2y$10$Sz.g1SlAQHP.Q.qpB4cusOr1z1umQs3P2A6VwzeS9yuRrG/uaHk9i', '2023-03-29', 0, NULL, NULL, '2023-03-29 15:30:21', '2023-04-02 20:02:15'),
(25, 'jules karangwa', 'julius.kayonga@kadvocat-law.co.rw', 'Ngororero', 'Male', '4', NULL, NULL, NULL, NULL, '20/T/2023', '1', '5', 'Advocate', '$2y$10$po9gTW6M0sal/3G17xF9.utBmtwu.1rsUwFTDVDvIk6hi776Zk8vi', '2023-04-03', 0, NULL, NULL, '2023-04-03 06:14:16', '2023-04-03 06:14:16');

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
-- Indexes for table `discipline_reports`
--
ALTER TABLE `discipline_reports`
  ADD PRIMARY KEY (`id`),
  ADD KEY `discipline_reports_user_id_foreign` (`user_id`),
  ADD KEY `discipline_reports_discipline_id_foreign` (`discipline_id`),
  ADD KEY `discipline_reports_sitting_id_foreign` (`sitting_id`);

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
-- Indexes for table `probonocategories`
--
ALTER TABLE `probonocategories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `probonocategories_name_unique` (`name`);

--
-- Indexes for table `probonos`
--
ALTER TABLE `probonos`
  ADD PRIMARY KEY (`id`),
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
-- Indexes for table `probono_participants`
--
ALTER TABLE `probono_participants`
  ADD PRIMARY KEY (`id`),
  ADD KEY `probono_participants_user_id_foreign` (`user_id`),
  ADD KEY `probono_participants_probono_id_foreign` (`probono_id`);

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
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `areas`
--
ALTER TABLE `areas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `authentication_log`
--
ALTER TABLE `authentication_log`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=245;

--
-- AUTO_INCREMENT for table `bookings`
--
ALTER TABLE `bookings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `compliances`
--
ALTER TABLE `compliances`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

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
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `discipline_participants`
--
ALTER TABLE `discipline_participants`
  MODIFY `table_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `discipline_reports`
--
ALTER TABLE `discipline_reports`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `discipline_sittings`
--
ALTER TABLE `discipline_sittings`
  MODIFY `sitting_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `extra_cles`
--
ALTER TABLE `extra_cles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `invitation`
--
ALTER TABLE `invitation`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

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
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;

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
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=103;

--
-- AUTO_INCREMENT for table `probonocategories`
--
ALTER TABLE `probonocategories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `probonos`
--
ALTER TABLE `probonos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `probono_devs`
--
ALTER TABLE `probono_devs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `probono_files`
--
ALTER TABLE `probono_files`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `probono_participants`
--
ALTER TABLE `probono_participants`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

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
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `training_materials`
--
ALTER TABLE `training_materials`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `training_topics`
--
ALTER TABLE `training_topics`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

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
-- Constraints for table `discipline_reports`
--
ALTER TABLE `discipline_reports`
  ADD CONSTRAINT `discipline_reports_discipline_id_foreign` FOREIGN KEY (`discipline_id`) REFERENCES `discipline` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `discipline_reports_sitting_id_foreign` FOREIGN KEY (`sitting_id`) REFERENCES `discipline_sittings` (`sitting_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `discipline_reports_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

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
-- Constraints for table `probono_participants`
--
ALTER TABLE `probono_participants`
  ADD CONSTRAINT `probono_participants_probono_id_foreign` FOREIGN KEY (`probono_id`) REFERENCES `probonos` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `probono_participants_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `socials`
--
ALTER TABLE `socials`
  ADD CONSTRAINT `socials_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
