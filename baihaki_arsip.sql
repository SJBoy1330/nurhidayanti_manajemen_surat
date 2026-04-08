-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 19, 2025 at 12:37 PM
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
-- Database: `joki_baihaki_arsip`
--

-- --------------------------------------------------------

--
-- Table structure for table `arsip`
--

CREATE TABLE `arsip` (
  `id` int(11) NOT NULL,
  `id_box_arsip` int(11) DEFAULT NULL,
  `id_location` int(11) DEFAULT NULL,
  `id_category` int(11) DEFAULT NULL,
  `code` varchar(100) DEFAULT NULL,
  `name` varchar(200) DEFAULT NULL,
  `file` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `create_by` int(11) DEFAULT NULL,
  `create_date` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `arsip`
--

INSERT INTO `arsip` (`id`, `id_box_arsip`, `id_location`, `id_category`, `code`, `name`, `file`, `description`, `create_by`, `create_date`) VALUES
(9, 4, 3, 3, 'AR20250719163550', 'Arsip 12', '687b68b8835be.pdf', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Nisi dolores maxime eum rem velit consequatur, saepe totam. Itaque eos sapiente nostrum quo obcaecati quam fuga dolorum. Fuga aut dolorem exercitationem.', 1, '2025-07-19 16:35:50'),
(10, 5, 2, 2, 'AR20250719163718', 'Time Frame Villa', '687b674e5569c.pdf', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Nisi dolores maxime eum rem velit consequatur, saepe totam. Itaque eos sapiente nostrum quo obcaecati quam fuga dolorum. Fuga aut dolorem exercitationem.\r\nLorem ipsum dolor sit amet consectetur adipisicing elit. Nisi dolores maxime eum rem velit consequatur, saepe totam. Itaque eos sapiente nostrum quo obcaecati quam fuga dolorum. Fuga aut dolorem exercitationem.\r\nLorem ipsum dolor sit amet consectetur adipisicing elit. Nisi dolores maxime eum rem velit consequatur, saepe totam. Itaque eos sapiente nostrum quo obcaecati quam fuga dolorum. Fuga aut dolorem exercitationem.\r\nLorem ipsum dolor sit amet consectetur adipisicing elit. Nisi dolores maxime eum rem velit consequatur, saepe totam. Itaque eos sapiente nostrum quo obcaecati quam fuga dolorum. Fuga aut dolorem exercitationem.', 1, '2025-07-19 16:37:18');

-- --------------------------------------------------------

--
-- Table structure for table `box_arsip`
--

CREATE TABLE `box_arsip` (
  `id` int(11) NOT NULL,
  `code` varchar(20) NOT NULL,
  `name` varchar(100) NOT NULL,
  `create_by` int(11) DEFAULT NULL,
  `create_date` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `box_arsip`
--

INSERT INTO `box_arsip` (`id`, `code`, `name`, `create_by`, `create_date`) VALUES
(4, '001', 'Box 01', 1, '2025-07-19 14:51:18'),
(5, '002', 'Box 02', 1, '2025-07-19 14:51:34');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `code` varchar(100) DEFAULT NULL,
  `name` varchar(200) DEFAULT NULL,
  `create_by` int(11) DEFAULT NULL,
  `create_date` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `code`, `name`, `create_by`, `create_date`) VALUES
(2, 'CT20250719150344', 'Kategori 1', 1, '2025-07-19 15:03:44'),
(3, 'CT20250719150525', 'Kategori 2', 1, '2025-07-19 15:05:25');

-- --------------------------------------------------------

--
-- Table structure for table `location`
--

CREATE TABLE `location` (
  `id` int(11) NOT NULL,
  `code` varchar(100) DEFAULT NULL,
  `name` varchar(200) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `create_by` int(11) DEFAULT NULL,
  `create_date` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `location`
--

INSERT INTO `location` (`id`, `code`, `name`, `address`, `create_by`, `create_date`) VALUES
(1, 'MLG', 'Malang', 'Jl. Malang No.01 Sebelah sana', 1, '2025-07-19 15:03:09'),
(2, 'SBY', 'Surabaya', 'Jl. Surabaya No 10 Sebelah sana', 1, '2025-07-19 15:03:18'),
(3, 'JKT', 'Jakarta', 'Jl. Jakarta No 4 Sebelah sana', 1, '2025-07-19 15:03:26');

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
(1, 1, 'Menambahkan data <b>\"Box Arsip\"</b> baru', 'add', '2025-07-19 17:20:13'),
(2, 1, 'Merubah data <b>\"Box Arsip\"</b> dengan code <b>\"003\"</b>', 'edt', '2025-07-19 17:20:21'),
(3, 1, 'Menghapus data <b>\"Box Arsip\"</b> dengan code <b>\"003\"</b>', 'dlt', '2025-07-19 17:20:25'),
(4, 1, 'Menonaktifkan data <b>\"Petugas\"</b> dengan code <b>\"PT20250719142437\"</b>', 'apv', '2025-07-19 17:20:41'),
(5, 1, 'Keluar dari sistem', 'apv', '2025-07-19 17:20:46'),
(6, NULL, 'Masuk ke sistem', 'apv', '2025-07-19 17:20:51'),
(7, 1, 'Telah merubah profil', 'edt', '2025-07-19 17:21:36'),
(8, 1, 'Keluar dari sistem', 'apv', '2025-07-19 17:22:11'),
(9, 1, 'Masuk ke sistem', 'apv', '2025-07-19 17:22:32'),
(10, 1, 'Mengaktifkan data <b>\"Petugas\"</b> dengan code <b>\"PT20250719142437\"</b>', 'apv', '2025-07-19 17:22:43'),
(11, NULL, 'Telah merubah data <b>\"Logo\"</b>', 'edt', '2025-07-19 17:24:13'),
(12, NULL, 'Telah merubah data <b>\"SEO\"</b>', 'edt', '2025-07-19 17:24:20'),
(13, 1, 'Telah merubah data <b>\"SEO\"</b>', 'edt', '2025-07-19 17:24:52'),
(14, 1, 'Keluar dari sistem', 'apv', '2025-07-19 17:26:46'),
(15, 6, 'Masuk ke sistem', 'apv', '2025-07-19 17:26:53'),
(16, NULL, 'Keluar dari sistem', 'apv', '2025-07-19 17:34:19'),
(17, 1, 'Masuk ke sistem', 'apv', '2025-07-19 17:34:30'),
(18, 1, 'Keluar dari sistem', 'apv', '2025-07-19 17:34:36'),
(19, 6, 'Masuk ke sistem', 'apv', '2025-07-19 17:35:10'),
(20, 6, 'Telah merubah profil', 'edt', '2025-07-19 17:35:35'),
(21, 6, 'Keluar dari sistem', 'apv', '2025-07-19 17:35:45'),
(22, 1, 'Masuk ke sistem', 'apv', '2025-07-19 17:35:51'),
(23, 1, 'Telah merubah profil', 'edt', '2025-07-19 17:36:06');

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
(1, '687b724d5fad7.png', '687b3545a8b03.png', 'logo_white.png', 'icon_white.png', 'Data Arsip', 'Arsip,arsip2', 'Lorem ipsum dolor sit, amet consectetur adipisicing elit. Reiciendis animi doloribus consequatur molestiae amet ad, veritatis unde odio modi, suscipit voluptates facilis inventore laboriosam eius quasi, sapiente architecto quas molestias.', 'Baihaki', 'Jl. Danau Sebelah Rumah Saya RT. Korupsi RW. Kolusi', '2025-04-19 02:47:15', '2025-04-20 09:37:55');

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
(1, NULL, 'Admin Segalanya', 'admin', '5994471abb01112afcc18159f6cc74b4f511b99806da59b3caf5a9c173cacfc5', '687b3564387fe.jpg', 'admin', 'Y', NULL, NULL, NULL, NULL, '2025-07-19 10:56:03'),
(6, 'PT20250719142437', 'Petugas Pertama', 'petugas1', '5994471abb01112afcc18159f6cc74b4f511b99806da59b3caf5a9c173cacfc5', '687b484e840c7.jpg', 'petugas', 'Y', '', NULL, NULL, 1, '2025-07-19 14:24:37');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `arsip`
--
ALTER TABLE `arsip`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_location` (`id_location`),
  ADD KEY `id_category` (`id_category`),
  ADD KEY `id_box_arsip` (`id_box_arsip`),
  ADD KEY `create_by` (`create_by`);

--
-- Indexes for table `box_arsip`
--
ALTER TABLE `box_arsip`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `kode_box_arsip` (`code`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`),
  ADD KEY `create_by` (`create_by`);

--
-- Indexes for table `location`
--
ALTER TABLE `location`
  ADD PRIMARY KEY (`id`),
  ADD KEY `create_by` (`create_by`);

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
-- AUTO_INCREMENT for table `arsip`
--
ALTER TABLE `arsip`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `box_arsip`
--
ALTER TABLE `box_arsip`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `location`
--
ALTER TABLE `location`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `log`
--
ALTER TABLE `log`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `setting`
--
ALTER TABLE `setting`
  MODIFY `id_setting` int(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `arsip`
--
ALTER TABLE `arsip`
  ADD CONSTRAINT `arsip_ibfk_1` FOREIGN KEY (`id_location`) REFERENCES `location` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `arsip_ibfk_2` FOREIGN KEY (`id_category`) REFERENCES `category` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `arsip_ibfk_3` FOREIGN KEY (`id_box_arsip`) REFERENCES `box_arsip` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `arsip_ibfk_4` FOREIGN KEY (`create_by`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `category`
--
ALTER TABLE `category`
  ADD CONSTRAINT `category_ibfk_1` FOREIGN KEY (`create_by`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `location`
--
ALTER TABLE `location`
  ADD CONSTRAINT `location_ibfk_1` FOREIGN KEY (`create_by`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

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
