-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 08, 2026 at 12:05 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `suratinout`
--

-- --------------------------------------------------------

--
-- Table structure for table `log`
--

CREATE TABLE `log` (
  `id` int(11) NOT NULL,
  `id_user` int(11) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `type` enum('add','edt','dlt','apv') DEFAULT 'add',
  `create_date` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `log`
--

INSERT INTO `log` (`id`, `id_user`, `description`, `type`, `create_date`) VALUES
(6, NULL, 'Masuk ke sistem', 'apv', '2025-07-19 17:20:51'),
(11, NULL, 'Telah merubah data <b>\"Logo\"</b>', 'edt', '2025-07-19 17:24:13'),
(12, NULL, 'Telah merubah data <b>\"SEO\"</b>', 'edt', '2025-07-19 17:24:20'),
(15, 6, 'Masuk ke sistem', 'apv', '2025-07-19 17:26:53'),
(16, NULL, 'Keluar dari sistem', 'apv', '2025-07-19 17:34:19'),
(19, 6, 'Masuk ke sistem', 'apv', '2025-07-19 17:35:10'),
(20, 6, 'Telah merubah profil', 'edt', '2025-07-19 17:35:35'),
(21, 6, 'Keluar dari sistem', 'apv', '2025-07-19 17:35:45'),
(29, 8, 'Masuk ke sistem via QR Login', 'apv', '2026-04-08 16:57:22'),
(31, NULL, 'Keluar dari sistem', 'apv', '2026-04-08 16:59:38'),
(34, NULL, 'Keluar dari sistem', 'apv', '2026-04-08 17:00:16'),
(35, 8, 'Masuk ke sistem via QR Login', 'apv', '2026-04-08 17:00:19'),
(36, 8, 'Menghapus data <b>\"Admin\"</b> dengan code <b>\"\"</b>', 'dlt', '2026-04-08 17:00:39'),
(37, 8, 'Menambahkan data <b>\"admin\"</b> baru', 'add', '2026-04-08 17:00:50'),
(38, 8, 'Telah merubah data <b>\"SEO\"</b>', 'edt', '2026-04-08 17:02:17');

-- --------------------------------------------------------

--
-- Table structure for table `setting`
--

CREATE TABLE `setting` (
  `id_setting` int(20) UNSIGNED NOT NULL,
  `logo` varchar(199) DEFAULT NULL,
  `icon` varchar(199) DEFAULT NULL,
  `logo_white` varchar(200) DEFAULT NULL,
  `icon_white` varchar(200) DEFAULT NULL,
  `meta_title` varchar(255) DEFAULT NULL,
  `meta_keyword` text DEFAULT NULL,
  `meta_description` text DEFAULT NULL,
  `meta_author` text DEFAULT NULL,
  `meta_address` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `setting`
--

INSERT INTO `setting` (`id_setting`, `logo`, `icon`, `logo_white`, `icon_white`, `meta_title`, `meta_keyword`, `meta_description`, `meta_author`, `meta_address`, `created_at`, `updated_at`) VALUES
(1, '687b724d5fad7.png', '687b3545a8b03.png', 'logo_white.png', 'icon_white.png', 'Data Arsip', 'Arsip,arsip2', 'Lorem ipsum dolor sit, amet consectetur adipisicing elit. Reiciendis animi doloribus consequatur molestiae amet ad, veritatis unde odio modi, suscipit voluptates facilis inventore laboriosam eius quasi, sapiente architecto quas molestias.', '-', 'Jl. Cek Cek', '2025-04-19 02:47:15', '2025-04-20 09:37:55');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `code` varchar(200) DEFAULT NULL,
  `name` varchar(200) DEFAULT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL,
  `image` varchar(200) DEFAULT NULL,
  `role` enum('admin','petugas') NOT NULL,
  `status` enum('Y','N') DEFAULT 'Y',
  `reason` text DEFAULT NULL,
  `block_by` int(11) DEFAULT NULL,
  `block_date` datetime DEFAULT NULL,
  `create_by` int(11) DEFAULT NULL,
  `create_date` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `code`, `name`, `username`, `password`, `image`, `role`, `status`, `reason`, `block_by`, `block_date`, `create_by`, `create_date`) VALUES
(6, 'PT20250719142437', 'Petugas Pertama', 'petugas1', '5994471abb01112afcc18159f6cc74b4f511b99806da59b3caf5a9c173cacfc5', '687b484e840c7.jpg', 'petugas', 'Y', '', NULL, NULL, NULL, '2025-07-19 14:24:37'),
(8, 'AD20260408164810', 'agnez mo', 'admin2', '5994471abb01112afcc18159f6cc74b4f511b99806da59b3caf5a9c173cacfc5', NULL, 'admin', 'Y', NULL, NULL, NULL, NULL, '2026-04-08 16:48:10'),
(9, 'AD20260408170050', 'admin', 'admin', '5994471abb01112afcc18159f6cc74b4f511b99806da59b3caf5a9c173cacfc5', NULL, 'admin', 'Y', NULL, NULL, NULL, 8, '2026-04-08 17:00:50');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `log`
--
ALTER TABLE `log`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_user` (`id_user`);

--
-- Indexes for table `setting`
--
ALTER TABLE `setting`
  ADD PRIMARY KEY (`id_setting`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `create_by` (`create_by`),
  ADD KEY `block_by` (`block_by`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `log`
--
ALTER TABLE `log`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `setting`
--
ALTER TABLE `setting`
  MODIFY `id_setting` int(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `log`
--
ALTER TABLE `log`
  ADD CONSTRAINT `log_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`create_by`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `users_ibfk_2` FOREIGN KEY (`block_by`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
