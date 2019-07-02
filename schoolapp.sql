-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 02, 2019 at 07:36 PM
-- Server version: 10.3.15-MariaDB
-- PHP Version: 7.3.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `schoolapp`
--

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2018_05_29_081348_create_verify_users_table', 1),
(4, '2019_06_16_075207_create_students_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `id` int(11) NOT NULL,
  `studname` varchar(30) NOT NULL,
  `dob` date NOT NULL,
  `class` int(2) NOT NULL,
  `gender` varchar(10) NOT NULL COMMENT '1=male, 0=female',
  `status` varchar(20) NOT NULL COMMENT 'sponsered or unsponsered',
  `district` varchar(35) NOT NULL,
  `state` varchar(50) NOT NULL,
  `donor` varchar(30) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`id`, `studname`, `dob`, `class`, `gender`, `status`, `district`, `state`, `donor`, `created_at`, `updated_at`) VALUES
(2, 'Amit Kumar', '2011-05-06', 10, 'Male', 'Unsponsered', 'Thane', 'Maharashtra', 'Ajay Rane', '2019-07-02 09:23:07', '2019-06-30 03:07:09'),
(3, 'Amit Jaiwal', '2012-12-23', 9, 'Male', 'Sponsered', 'Thane', 'Kerala', 'Maitali Chitre', '2019-07-02 09:23:27', '2019-06-30 03:03:40'),
(4, 'Rahul Pandey', '2013-12-12', 8, 'Male', 'Unsponsered', 'Thane', 'Gujarat', 'Ashish Triwedi', '2019-07-02 09:23:35', '2019-06-30 10:57:27'),
(5, 'Smriti Rane', '2008-05-08', 10, 'Female', 'Sponsered', 'Thane', 'Maharashtra', 'Amit Rahane', '2019-07-02 09:22:30', '2019-06-30 10:57:27'),
(6, 'Angelica Ramos', '2011-02-26', 10, 'Female', 'Sponsered', 'Kota', 'Rajasthan', 'Caesar Vance	', '2019-07-02 09:33:06', '2019-07-02 09:26:42'),
(7, 'Brenden Wagner	', '2014-02-22', 5, 'Male', 'Sponsered', 'Maharashtra', 'Pune', 'Ashton Cox	', '2019-07-02 09:26:42', '2019-07-02 09:26:42'),
(8, 'Charde Marshall', '2009-06-05', 11, 'Male', 'Sponsered', 'Kochin', 'Tamil Nadu', 'Garrett Winters', '2019-07-02 09:32:11', '2019-07-02 09:32:11'),
(9, 'Donna Snider', '2009-08-29', 10, 'Male', 'Unsponsered', 'Mumbai', 'Maharashtra', 'Fiona Green', '2019-07-02 09:32:11', '2019-07-02 09:32:11'),
(10, 'Hermione Butler', '2015-01-31', 2, 'Female', 'Unsponsered', 'Hubli', 'Kolkata', 'Jena Gaines	', '2019-07-02 09:33:24', '2019-07-02 09:32:11'),
(11, 'Jenette Caldwell	', '2010-12-23', 10, 'Male', 'Sponsered', 'Noida', 'Delhi', 'Howard Hatfield	', '2019-07-02 09:32:11', '2019-07-02 09:32:11'),
(12, 'Christina Milan', '2013-12-01', 8, 'Male', 'Unsponsered', 'Delhi', 'Gurgaon', 'Paul Sandy', '2019-07-02 09:36:30', '2019-07-02 09:36:30'),
(13, 'Siddhesh Patel', '2014-02-28', 4, 'Male', 'Sponserd', 'Maharashtra', 'Pune', 'Michael Silva	', '2019-07-02 09:36:30', '2019-07-02 09:36:30');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `verified` tinyint(1) NOT NULL DEFAULT 0,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `verify_users`
--

CREATE TABLE `verify_users` (
  `user_id` int(11) NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `verify_users`
--

INSERT INTO `verify_users` (`user_id`, `token`, `created_at`, `updated_at`) VALUES
(1, 'c33cae393e9da70a9657a846dfe214acdf513a11', '2019-06-14 07:35:23', '2019-06-14 07:35:23'),
(2, 'c5c2ad41f7428ca8fcdac11a8af7094c73947383', '2019-06-14 07:39:13', '2019-06-14 07:39:13');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
