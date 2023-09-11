-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 29, 2023 at 10:49 PM
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

--
-- Indexes for dumped tables
--

--
-- Indexes for table `probonocategories`
--
ALTER TABLE `probonocategories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `probonocategories_name_unique` (`name`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `probonocategories`
--
ALTER TABLE `probonocategories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
