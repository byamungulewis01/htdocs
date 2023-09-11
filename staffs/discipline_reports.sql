-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 27, 2023 at 10:43 AM
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

--
-- Indexes for dumped tables
--

--
-- Indexes for table `discipline_reports`
--
ALTER TABLE `discipline_reports`
  ADD PRIMARY KEY (`id`),
  ADD KEY `discipline_reports_user_id_foreign` (`user_id`),
  ADD KEY `discipline_reports_discipline_id_foreign` (`discipline_id`),
  ADD KEY `discipline_reports_sitting_id_foreign` (`sitting_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `discipline_reports`
--
ALTER TABLE `discipline_reports`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `discipline_reports`
--
ALTER TABLE `discipline_reports`
  ADD CONSTRAINT `discipline_reports_discipline_id_foreign` FOREIGN KEY (`discipline_id`) REFERENCES `discipline` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `discipline_reports_sitting_id_foreign` FOREIGN KEY (`sitting_id`) REFERENCES `discipline_sittings` (`sitting_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `discipline_reports_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
