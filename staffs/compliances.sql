-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 27, 2023 at 10:59 AM
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
(5, 2023, '5.00', '5.00', '0.00', '10.00', 16, 2, 2, '2023-03-23 09:01:10', '2023-03-24 17:55:51'),
(6, 2023, '7.00', '5.00', '6.70', '30.70', 3, 2, 2, '2023-03-23 10:44:44', '2023-03-26 06:09:17'),
(7, 2023, '3.00', '5.00', '0.00', '6.00', 7, 2, 2, '2023-03-24 08:45:51', '2023-03-24 17:55:51'),
(8, 2022, '3.00', '5.00', '0.00', '0.00', 1, 2, 2, '2023-03-24 08:50:24', '2023-03-24 08:54:27'),
(9, 2022, '5.00', '4.00', '0.00', '0.00', 17, 2, 2, '2023-03-24 08:50:51', '2023-03-24 08:54:27'),
(10, 2023, '0.00', '2.00', '0.00', '0.00', 20, 2, 2, '2023-03-24 08:51:13', '2023-03-24 17:55:51'),
(11, 2023, '0.00', '3.00', '0.00', '0.00', 12, 2, 2, '2023-03-24 08:51:46', '2023-03-24 08:51:46'),
(12, 2023, '0.00', '3.00', '0.00', '0.00', 6, 2, 2, '2023-03-24 08:52:09', '2023-03-24 17:55:51'),
(13, 2023, '0.00', '3.00', '0.00', '0.00', 10, 2, 2, '2023-03-24 08:52:18', '2023-03-24 17:55:51'),
(14, 2023, '0.00', '3.00', '0.00', '0.00', 14, 2, 2, '2023-03-24 08:52:43', '2023-03-24 17:55:51'),
(15, 2023, '5.00', '0.00', '0.00', '10.00', 17, 2, 2, '2023-03-24 17:54:39', '2023-03-24 17:55:51'),
(16, 2023, '3.00', '0.00', '0.00', '6.00', 1, 2, 2, '2023-03-24 17:54:39', '2023-03-24 17:55:51');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `compliances`
--
ALTER TABLE `compliances`
  ADD PRIMARY KEY (`id`),
  ADD KEY `compliances_user_id_foreign` (`user_id`),
  ADD KEY `compliances_created_by_foreign` (`created_by`),
  ADD KEY `compliances_update_by_foreign` (`update_by`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `compliances`
--
ALTER TABLE `compliances`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `compliances`
--
ALTER TABLE `compliances`
  ADD CONSTRAINT `compliances_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `admins` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `compliances_update_by_foreign` FOREIGN KEY (`update_by`) REFERENCES `admins` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `compliances_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
