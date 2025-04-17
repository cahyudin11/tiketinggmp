-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 17, 2025 at 05:57 PM
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
-- Database: `tiketinggmp`
--

-- --------------------------------------------------------

--
-- Table structure for table `barang`
--

CREATE TABLE `barang` (
  `id` int(11) NOT NULL,
  `nama_barang` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `barang`
--

INSERT INTO `barang` (`id`, `nama_barang`) VALUES
(16, 'MIKROTIK RB750 R2'),
(17, 'SSD VGEN'),
(18, 'KABEL PRINTER'),
(19, 'LAPTOP HP TOUCHSREEN'),
(20, 'LAPTOP ASUS VIBOBOOK 14 INC'),
(21, 'LAPTOP HP 14 BIASA'),
(22, 'KABEL USB EXTENDER'),
(23, 'MONITOR SAMSUNG 19 INC'),
(24, 'MONITOR LG 19 INC'),
(25, 'CPU PENTIUM GOLD G6405 RAM DDR4 8 GB SSD 256 SATA PSU 550 WAT CORSAIR CASE MSI'),
(26, 'CPU PENTIUM GOLD G6405 RAM DDR4 4 GB SSD 256 SATA PSU 550 WAT CORSAIR CASE MSI'),
(27, 'KEYBOARD MK120 SET');

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `divisi`
--

CREATE TABLE `divisi` (
  `id` int(11) NOT NULL,
  `nama_divisi` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `divisi`
--

INSERT INTO `divisi` (`id`, `nama_divisi`) VALUES
(1, 'HRD'),
(2, 'IT'),
(4, 'PURCHASING'),
(7, 'ACCOUNTING');

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
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
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
(3, '0001_01_01_000002_create_jobs_table', 1);

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
-- Table structure for table `peminjaman`
--

CREATE TABLE `peminjaman` (
  `id` int(11) NOT NULL,
  `barang_id_peminjaman` varchar(25) NOT NULL,
  `dari` date NOT NULL,
  `sampai` date NOT NULL,
  `nama` varchar(25) NOT NULL,
  `tanggal` date NOT NULL,
  `kontak` varchar(25) NOT NULL,
  `kode_tiket` varchar(25) NOT NULL,
  `divisi_id` varchar(25) NOT NULL,
  `status` enum('menunggu antrian','dalam peminjaman','dikembalikan','ditolak') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `peminjaman`
--

INSERT INTO `peminjaman` (`id`, `barang_id_peminjaman`, `dari`, `sampai`, `nama`, `tanggal`, `kontak`, `kode_tiket`, `divisi_id`, `status`) VALUES
(14, '17', '2025-04-17', '2025-04-18', 'cahyudin', '2025-04-17', '089654963859', 'TKT-68009B38B1D59-NtDT5', '2', 'dikembalikan'),
(15, '19', '2025-04-17', '2025-04-18', 'cahyudin', '2025-04-17', '089654963859', 'TKT-6800B1275D9C9-Ug72F', '2', 'ditolak');

-- --------------------------------------------------------

--
-- Table structure for table `permintaan`
--

CREATE TABLE `permintaan` (
  `id` int(11) NOT NULL,
  `kode_tiket` varchar(25) NOT NULL,
  `tanggal` date NOT NULL,
  `nama` varchar(25) NOT NULL,
  `divisi_id` varchar(25) NOT NULL,
  `barang_id` varchar(25) NOT NULL,
  `keterangan` text NOT NULL,
  `quantity` int(25) NOT NULL,
  `kontak` varchar(25) NOT NULL,
  `status` enum('menunggu antrian','sedang diajukan','barang datang','proses pemasangan','selesai') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `permintaan`
--

INSERT INTO `permintaan` (`id`, `kode_tiket`, `tanggal`, `nama`, `divisi_id`, `barang_id`, `keterangan`, `quantity`, `kontak`, `status`) VALUES
(2, 'TKT-67FF2F85D3405-RpJ04', '2025-04-16', 'cahyudin', '2', '16', 'asas', 1, '089654963859', 'selesai'),
(5, 'TKT-67FF68F51475A-zKBRd', '2025-04-16', 'kusti', '1', '16', 'asas', 1, '089654963859', 'menunggu antrian'),
(6, 'TKT-67FF7BD7247CE-8E6Gy', '2025-04-16', 'kusti', '1', '16', 'asas', 1, '089654963859', 'menunggu antrian'),
(7, 'TKT-67FF7D4C31243-PAW8j', '2025-04-16', 'kusti', '1', '16', 'asas', 1, '089654963859', 'menunggu antrian'),
(8, 'TKT-67FF81255012C-ngeOH', '2025-04-16', 'kusti', '1', '16', 'asas', 1, '089654963859', 'menunggu antrian'),
(9, 'TKT-67FF8176D14DB-LLrWh', '2025-04-16', 'kusti', '1', '16', 'asas', 1, '089654963859', 'menunggu antrian'),
(11, 'TKT-680078B1B62A9-ybL7M', '2025-04-17', 'cahyudin', '2', '16', 'asas', 1, '089654963859', 'sedang diajukan'),
(12, 'TKT-6800791728EAF-K4MY8', '2025-04-17', 'cahyudin', '2', '18', 'asas', 1, '089654963859', 'sedang diajukan'),
(13, 'TKT-680079CAC528D-7SCuo', '2025-04-17', 'cahyudin', '2', '16', 'asasas', 1, '089654963859', 'sedang diajukan'),
(15, 'TKT-6800D3A17C489-RvvQ4', '2025-04-17', 'kusti', '2', '22', 'untuk pa dadang', 1, '089654963859', 'selesai'),
(16, 'TKT-6800D42BC00D8-yjO1k', '2025-04-17', 'rifky', '7', '17', 'komputer saya lag pisan', 1, '081224059415', 'selesai'),
(17, 'TKT-68010584BE805-0sLYt', '2025-04-17', 'cahyudin', '2', '17', 'untuk saya', 1, '089654963859', 'sedang diajukan');

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
('4VxN8o2uXTAsn67bb5J5TSRYyAtsXuLQFXub83d9', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/135.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoib0JhTHBuM3ZRNnhkNTZHR0pQZ2VmMHdVOFRrY0dabk94bDhhcG9TTCI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MTp7aTowO3M6MTY6InNob3dfZG9rdW1lbnRhc2kiO31zOjM6Im5ldyI7YTowOnt9fXM6MTY6InNob3dfZG9rdW1lbnRhc2kiO2I6MTtzOjk6Il9wcmV2aW91cyI7YToxOntzOjM6InVybCI7czoyMToiaHR0cDovLzEyNy4wLjAuMTo4MDAwIjt9fQ==', 1744905384);

-- --------------------------------------------------------

--
-- Table structure for table `tiket`
--

CREATE TABLE `tiket` (
  `id` int(11) NOT NULL,
  `kode_tiket` varchar(25) NOT NULL,
  `tanggal` date NOT NULL,
  `nama` varchar(25) NOT NULL,
  `divisi_id` varchar(25) NOT NULL,
  `detail` text NOT NULL,
  `kontak` varchar(25) NOT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `status` set('menunggu antrian','ditolak','sedang dikerjakan','selesai') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tiket`
--

INSERT INTO `tiket` (`id`, `kode_tiket`, `tanggal`, `nama`, `divisi_id`, `detail`, `kontak`, `photo`, `status`) VALUES
(36, 'TKT-67F9C6F2D6ED0-m7Eit', '2025-04-12', 'cahyudin', '2', 'asasasasasasa', '089654963859', NULL, 'ditolak'),
(37, 'TKT-67F9C75B31BD5-JvzIm', '2025-04-12', 'cahyudin', '2', 'eror pada printer', '089654963859', NULL, 'sedang dikerjakan'),
(38, 'TKT-67F9C8846F3D3-jBgQQ', '2025-04-12', 'cahyudin', '2', 'eror printer', '089654963859', NULL, 'menunggu antrian'),
(39, 'TKT-67F9ED5C86C55-eBWkD', '2025-04-12', 'VANIA', '4', 'printer eror', '081316575369', NULL, 'menunggu antrian'),
(40, 'TKT-67F9ED98C6E85-xkmfr', '2025-04-12', 'maya', '4', 'ing printer eror', '087827121703', NULL, 'menunggu antrian'),
(41, 'TKT-67FF2E8C183AF-P6ZLv', '2025-04-16', 'kusti', '1', 'asasasas', '089654963859', NULL, 'selesai'),
(42, 'TKT-67FF4C569D816-fi0dM', '2025-04-16', 'kusti', '4', 'eror printer', '089654963859', NULL, 'menunggu antrian'),
(45, 'TKT-67FF671B90525-2atrS', '2025-04-16', 'cahyudin', '1', 'asasas', '089654963859', NULL, 'selesai'),
(46, 'TKT-67FF68E308088-xXOjw', '2025-04-16', 'kusti', '1', 'asasas', '089654963859', NULL, 'selesai'),
(47, 'TKT-67FF6BAC9B076-EAQGU', '2025-04-16', 'kusti', '1', 'asas', '089654963859', NULL, 'selesai'),
(48, 'TKT-67FF6E392D1A5-TcDlU', '2025-04-16', 'kusti', '1', 'asasa', '089654963859', NULL, 'menunggu antrian'),
(49, 'TKT-67FF72BA75A0F-xMPST', '2025-04-16', 'asasas', '1', 'asas', '089654963859', NULL, 'menunggu antrian'),
(50, 'TKT-67FF766D9123D-TSGMH', '2025-04-16', 'kusti', '1', 'asasa', '089654963859', NULL, 'menunggu antrian'),
(51, 'TKT-67FF7E6E41637-kDqBy', '2025-04-16', 'kusti', '1', 'asasas', '089654963859', NULL, 'menunggu antrian'),
(52, 'TKT-67FF7ECAA0194-zjSuO', '2025-04-16', 'kusti', '2', 'asasas', '089654963859', NULL, 'menunggu antrian'),
(53, 'TKT-67FF7FE915B86-z7v4c', '2025-04-16', 'kusti', '1', 'asasas', '089654963859', NULL, 'menunggu antrian'),
(54, 'TKT-67FF81997ABE7-8po8r', '2025-04-16', 'cahyudin', '1', 'asasasas', '089654963859', NULL, 'menunggu antrian'),
(55, 'TKT-680075BDD0A8C-anRu1', '2025-04-17', 'cahyudin', '1', 'tes perbaikan', '089654963859', NULL, 'menunggu antrian'),
(56, 'TKT-68007926CB0AD-RwdQe', '2025-04-17', 'kusti', '2', 'sasasas', '089654963859', NULL, 'menunggu antrian'),
(57, 'TKT-680079BC65E3F-ibysq', '2025-04-17', 'kusti', '1', 'asasasas', '089654963859', NULL, 'menunggu antrian'),
(58, 'TKT-6800D5264474D-J2Anh', '2025-04-17', 'kusti', '4', 'eror printer', '089654963859', NULL, 'sedang dikerjakan');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `foto` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `foto`) VALUES
(1, 'IT Yudi', 'yudi@gmail.com', NULL, '$2y$12$IRyuyBd6RHoMWy7M3caSUO841S2AGuGrTOHEB7N.1TcESYcx5Otfa', NULL, '2025-04-17 07:09:01', '2025-04-17 08:55:45', '1744905345.png');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `barang`
--
ALTER TABLE `barang`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `divisi`
--
ALTER TABLE `divisi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

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
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `peminjaman`
--
ALTER TABLE `peminjaman`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `permintaan`
--
ALTER TABLE `permintaan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `tiket`
--
ALTER TABLE `tiket`
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
-- AUTO_INCREMENT for table `barang`
--
ALTER TABLE `barang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `divisi`
--
ALTER TABLE `divisi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `peminjaman`
--
ALTER TABLE `peminjaman`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `permintaan`
--
ALTER TABLE `permintaan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `tiket`
--
ALTER TABLE `tiket`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
