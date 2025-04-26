-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 26 Apr 2025 pada 10.49
-- Versi server: 10.4.27-MariaDB
-- Versi PHP: 8.0.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `florist`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `bouquets`
--

CREATE TABLE `bouquets` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `price` decimal(10,2) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `category` enum('Bunga','Buket','Kertas') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `bouquets`
--

INSERT INTO `bouquets` (`id`, `name`, `description`, `price`, `image`, `created_at`, `updated_at`, `category`) VALUES
(3, 'r', 'tutut', '123.00', 'bouquet_images/5axAx2iyd8TOiZ9Th4QHv9bpsJqCjm0IJx58ZyyT.jpg', '2025-03-13 09:05:16', '2025-04-11 00:23:29', 'Kertas'),
(5, 'saya', 'bagsu', '123354.00', 'bouquet_images/J1TzwzotDSVbLBt9Kxe5G6lpCd3yJBWSfrQulM09.jpg', '2025-03-16 09:46:02', '2025-03-16 09:46:02', 'Bunga'),
(6, 'hhu', 'kjkj', '4444.00', 'bouquet_images/R1QoaUZi1zteqbf40SbfcGtXir2KrLmOPDorX3hA.jpg', '2025-03-16 10:25:20', '2025-03-16 10:29:16', 'Kertas'),
(7, 'fdd', 'fdgdf4', '454545.00', 'bouquet_images/OixCtiK41fdIBJ93fWL9rcuZYjwz6rfnkDQnn4xF.jpg', '2025-03-16 10:29:47', '2025-03-16 10:29:47', 'Bunga'),
(9, 'ff', 'ddd', '333.00', 'bouquet_images/fhMNNVGN7TlWiez3D4TUKpi98ykKM4yiEe0UXs6Q.jpg', '2025-04-08 01:45:16', '2025-04-08 01:45:21', 'Kertas');

-- --------------------------------------------------------

--
-- Struktur dari tabel `failed_jobs`
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
-- Struktur dari tabel `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2025_03_13_111035_create_bouquets_table', 1),
(6, '2025_03_20_224532_create_transactions_table', 2),
(8, '2025_04_17_131751_add_subtotal_to_transaction_items_table', 3),
(9, '2025_04_17_141336_add_pickup_date_to_transactions_table', 4),
(10, '2025_04_17_173103_add_delivery_fields_to_transactions_table', 5),
(11, '2025_04_17_184118_update_status_enum_in_transactions_table', 6),
(12, '2025_04_17_194000_add_role_to_users_table', 7);

-- --------------------------------------------------------

--
-- Struktur dari tabel `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `personal_access_tokens`
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
-- Struktur dari tabel `transactions`
--

CREATE TABLE `transactions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `bouquet_id` int(11) NOT NULL DEFAULT 3,
  `shipping_cost` int(11) DEFAULT 0,
  `total_amount` decimal(10,2) NOT NULL DEFAULT 0.00,
  `total_payment` int(11) DEFAULT 0,
  `payment_method` varchar(50) NOT NULL,
  `status` enum('Pending','Waiting Verification','Paid','Shipped','Success') DEFAULT 'Pending',
  `delivery_method` varchar(20) NOT NULL DEFAULT 'Ambil Sendiri',
  `address` text DEFAULT NULL,
  `note` text DEFAULT NULL,
  `pickup_date` date DEFAULT NULL,
  `pickup_time` time DEFAULT NULL,
  `delivery_date` date DEFAULT NULL,
  `delivery_time` time DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `transactions`
--

INSERT INTO `transactions` (`id`, `created_at`, `updated_at`, `user_id`, `bouquet_id`, `shipping_cost`, `total_amount`, `total_payment`, `payment_method`, `status`, `delivery_method`, `address`, `note`, `pickup_date`, `pickup_time`, `delivery_date`, `delivery_time`) VALUES
(147, '2025-04-17 06:51:13', '2025-04-17 06:51:13', 3, 3, 11754, '127921.00', 139675, 'bank_transfer', 'Pending', 'delivery', 'manahan', 'halowww', NULL, NULL, NULL, NULL),
(148, '2025-04-17 06:52:36', '2025-04-17 06:52:36', 3, 3, 11754, '246708.00', 258462, 'qris', 'Pending', 'delivery', 'manahan', 'mm', NULL, NULL, NULL, NULL),
(149, '2025-04-17 07:54:19', '2025-04-17 07:54:19', 3, 3, 11754, '701499.00', 713253, 'bank_transfer', 'Pending', 'delivery', 'manahan', 'mm', NULL, NULL, NULL, NULL),
(150, '2025-04-17 07:57:29', '2025-04-17 07:57:29', 3, 3, 11754, '123477.00', 135231, 'qris', 'Pending', 'delivery', 'manahan', 'mm', NULL, NULL, NULL, NULL),
(151, '2025-04-17 10:35:50', '2025-04-17 10:35:50', 3, 3, 11754, '4567.00', 16321, 'bank_transfer', 'Pending', 'delivery', 'manahan', 'nn', NULL, NULL, NULL, NULL),
(152, '2025-04-17 10:45:11', '2025-04-17 10:45:11', 3, 3, 11754, '123600.00', 135354, 'qris', 'Pending', 'delivery', 'manahan', 'xxccc', NULL, NULL, NULL, NULL),
(153, '2025-04-17 10:49:36', '2025-04-17 10:49:36', 3, 3, 10450, '4567.00', 15017, 'bank_transfer', 'Pending', 'delivery', 'keprabon', 'mna', NULL, NULL, NULL, NULL),
(154, '2025-04-17 10:54:33', '2025-04-17 10:54:33', 3, 3, 11754, '123477.00', 135231, 'bank_transfer', 'Pending', 'delivery', 'manahan', 'ccc', NULL, NULL, NULL, NULL),
(155, '2025-04-17 10:58:44', '2025-04-17 10:58:44', 3, 3, 11754, '127798.00', 139552, 'qris', 'Pending', 'delivery', 'manahan', 'nz', NULL, NULL, '2025-04-19', '00:00:00'),
(156, '2025-04-17 11:03:22', '2025-04-17 11:03:22', 3, 3, 11754, '4567.00', 16321, 'qris', 'Pending', 'delivery', 'manahan', 'klo', NULL, NULL, '2025-04-19', '01:04:00'),
(157, '2025-04-17 11:05:51', '2025-04-17 11:05:51', 3, 3, 10450, '577899.00', 588349, 'bank_transfer', 'Pending', 'delivery', 'keprabon', 'mana', NULL, NULL, '2025-04-19', '01:09:00'),
(158, '2025-04-17 11:14:51', '2025-04-17 11:14:51', 3, 3, 11754, '458989.00', 470743, 'bank_transfer', 'Pending', 'delivery', 'manahan', 'maa', '2025-05-02', '01:14:00', '2025-04-19', '01:14:00'),
(159, '2025-04-17 11:15:52', '2025-04-17 11:15:52', 3, 3, 0, '127798.00', 127798, 'bank_transfer', 'Pending', 'pickup', NULL, 'mk', '2025-05-02', '13:15:00', NULL, NULL),
(160, '2025-04-17 11:18:52', '2025-04-17 11:18:52', 3, 3, 11754, '13332.00', 25086, 'bank_transfer', 'Pending', 'delivery', 'manahan', 'haloww', NULL, NULL, '2025-04-26', '13:20:00'),
(161, '2025-04-17 11:26:00', '2025-04-17 11:26:00', 3, 3, 0, '4900.00', 4900, 'bank_transfer', 'Pending', 'pickup', NULL, 'manaa', '2025-05-01', '01:27:00', NULL, NULL),
(162, '2025-04-17 11:28:57', '2025-04-17 11:28:57', 3, 3, 11754, '123477.00', 135231, 'qris', 'Pending', 'delivery', 'manahan', 'kalo', NULL, NULL, '2025-04-19', '01:31:00'),
(163, '2025-04-17 11:31:34', '2025-04-17 11:31:34', 3, 3, 10450, '454878.00', 465328, 'qris', 'Pending', 'delivery', 'keprabon', 'aaaaaa', NULL, NULL, '2025-04-19', '13:33:00'),
(164, '2025-04-17 11:43:51', '2025-04-17 11:43:51', 3, 3, 11754, '582343.00', 594097, 'bank_transfer', 'Success', 'delivery', 'manahan', 'mm', NULL, NULL, '2025-04-26', '13:43:00'),
(165, '2025-04-17 11:49:12', '2025-04-17 11:49:12', 3, 3, 11754, '456.00', 12210, 'bank_transfer', 'Success', 'delivery', 'manahan', 'gmna yaa', NULL, NULL, '2025-04-24', '13:48:00'),
(166, '2025-04-17 12:05:19', '2025-04-17 12:05:19', 3, 3, 11754, '4444.00', 16198, 'bank_transfer', 'Success', 'delivery', 'manahan', 'zzz', NULL, NULL, '2025-04-26', '05:05:00'),
(167, '2025-04-17 12:10:51', '2025-04-17 12:10:51', 3, 3, 11754, '4444.00', 16198, 'bank_transfer', 'Success', 'delivery', 'manahan', 'dmn', NULL, NULL, '2025-04-19', '02:14:00');

-- --------------------------------------------------------

--
-- Struktur dari tabel `transaction_items`
--

CREATE TABLE `transaction_items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `transaction_id` bigint(20) UNSIGNED NOT NULL,
  `bouquet_id` bigint(20) UNSIGNED NOT NULL,
  `quantity` int(11) NOT NULL,
  `subtotal` decimal(15,2) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `transaction_items`
--

INSERT INTO `transaction_items` (`id`, `transaction_id`, `bouquet_id`, `quantity`, `subtotal`, `price`, `created_at`, `updated_at`) VALUES
(8, 147, 5, 1, '123354.00', '123354.00', '2025-04-17 06:51:13', '2025-04-17 06:51:13'),
(9, 147, 3, 1, '123.00', '123.00', '2025-04-17 06:51:13', '2025-04-17 06:51:13'),
(10, 147, 6, 1, '4444.00', '4444.00', '2025-04-17 06:51:13', '2025-04-17 06:51:13'),
(11, 148, 5, 2, '246708.00', '123354.00', '2025-04-17 06:52:36', '2025-04-17 06:52:36'),
(12, 149, 7, 1, '454545.00', '454545.00', '2025-04-17 07:54:19', '2025-04-17 07:54:19'),
(13, 149, 3, 2, '246.00', '123.00', '2025-04-17 07:54:19', '2025-04-17 07:54:19'),
(14, 149, 5, 2, '246708.00', '123354.00', '2025-04-17 07:54:19', '2025-04-17 07:54:19'),
(15, 150, 5, 1, '123354.00', '123354.00', '2025-04-17 07:57:29', '2025-04-17 07:57:29'),
(16, 150, 3, 1, '123.00', '123.00', '2025-04-17 07:57:29', '2025-04-17 07:57:29'),
(17, 151, 3, 1, '123.00', '123.00', '2025-04-17 10:35:50', '2025-04-17 10:35:50'),
(18, 151, 6, 1, '4444.00', '4444.00', '2025-04-17 10:35:50', '2025-04-17 10:35:50'),
(19, 152, 3, 2, '246.00', '123.00', '2025-04-17 10:45:11', '2025-04-17 10:45:11'),
(20, 152, 5, 1, '123354.00', '123354.00', '2025-04-17 10:45:11', '2025-04-17 10:45:11'),
(21, 153, 3, 1, '123.00', '123.00', '2025-04-17 10:49:36', '2025-04-17 10:49:36'),
(22, 153, 6, 1, '4444.00', '4444.00', '2025-04-17 10:49:36', '2025-04-17 10:49:36'),
(23, 154, 3, 1, '123.00', '123.00', '2025-04-17 10:54:33', '2025-04-17 10:54:33'),
(24, 154, 5, 1, '123354.00', '123354.00', '2025-04-17 10:54:33', '2025-04-17 10:54:33'),
(25, 155, 6, 1, '4444.00', '4444.00', '2025-04-17 10:58:44', '2025-04-17 10:58:44'),
(26, 155, 5, 1, '123354.00', '123354.00', '2025-04-17 10:58:44', '2025-04-17 10:58:44'),
(27, 156, 3, 1, '123.00', '123.00', '2025-04-17 11:03:22', '2025-04-17 11:03:22'),
(28, 156, 6, 1, '4444.00', '4444.00', '2025-04-17 11:03:22', '2025-04-17 11:03:22'),
(29, 157, 5, 1, '123354.00', '123354.00', '2025-04-17 11:05:51', '2025-04-17 11:05:51'),
(30, 157, 7, 1, '454545.00', '454545.00', '2025-04-17 11:05:51', '2025-04-17 11:05:51'),
(31, 158, 6, 1, '4444.00', '4444.00', '2025-04-17 11:14:51', '2025-04-17 11:14:51'),
(32, 158, 7, 1, '454545.00', '454545.00', '2025-04-17 11:14:51', '2025-04-17 11:14:51'),
(33, 159, 5, 1, '123354.00', '123354.00', '2025-04-17 11:15:52', '2025-04-17 11:15:52'),
(34, 159, 6, 1, '4444.00', '4444.00', '2025-04-17 11:15:52', '2025-04-17 11:15:52'),
(35, 160, 6, 3, '13332.00', '4444.00', '2025-04-17 11:18:52', '2025-04-17 11:18:52'),
(36, 161, 6, 1, '4444.00', '4444.00', '2025-04-17 11:26:00', '2025-04-17 11:26:00'),
(37, 161, 9, 1, '333.00', '333.00', '2025-04-17 11:26:00', '2025-04-17 11:26:00'),
(38, 161, 3, 1, '123.00', '123.00', '2025-04-17 11:26:00', '2025-04-17 11:26:00'),
(39, 162, 3, 1, '123.00', '123.00', '2025-04-17 11:28:57', '2025-04-17 11:28:57'),
(40, 162, 5, 1, '123354.00', '123354.00', '2025-04-17 11:28:57', '2025-04-17 11:28:57'),
(41, 163, 9, 1, '333.00', '333.00', '2025-04-17 11:31:34', '2025-04-17 11:31:34'),
(42, 163, 7, 1, '454545.00', '454545.00', '2025-04-17 11:31:34', '2025-04-17 11:31:34'),
(43, 164, 6, 1, '4444.00', '4444.00', '2025-04-17 11:43:51', '2025-04-17 11:43:51'),
(44, 164, 5, 1, '123354.00', '123354.00', '2025-04-17 11:43:51', '2025-04-17 11:43:51'),
(45, 164, 7, 1, '454545.00', '454545.00', '2025-04-17 11:43:51', '2025-04-17 11:43:51'),
(46, 165, 9, 1, '333.00', '333.00', '2025-04-17 11:49:12', '2025-04-17 11:49:12'),
(47, 165, 3, 1, '123.00', '123.00', '2025-04-17 11:49:12', '2025-04-17 11:49:12'),
(48, 166, 6, 1, '4444.00', '4444.00', '2025-04-17 12:05:19', '2025-04-17 12:05:19'),
(49, 167, 6, 1, '4444.00', '4444.00', '2025-04-17 12:10:51', '2025-04-17 12:10:51');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `role` varchar(255) NOT NULL DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `role`) VALUES
(1, 'tutut', 'tutut@gmail.com', NULL, '$2y$10$Tlub7Dk4dt14QVz93zjz8O2/gKQKN8WP4MGqH.igkJ0ocpXCtpxAq', NULL, '2025-03-16 11:21:28', '2025-03-16 11:21:28', 'user'),
(2, 'sta', 'k@gmail.com', NULL, '$2y$10$q31W77tgMjdFMUki0ntFnug1oX9YKoCzkVfU325UT0ahnu1PR5Dwu', NULL, '2025-03-16 12:28:03', '2025-03-16 12:28:03', 'user'),
(3, 'tutut', 'tututbagiawati@gmail.com', NULL, '$2y$10$Z0BQRMKgM66WqBWJJP9iO.Nuwqpjs06Rvu2BvyHjmO3WUmXLWI3a.', NULL, '2025-04-06 04:44:50', '2025-04-06 04:44:50', 'user'),
(4, '', 'admin@florist.com', NULL, '123456', NULL, NULL, NULL, 'admin');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `bouquets`
--
ALTER TABLE `bouquets`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indeks untuk tabel `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `password_resets`
--
ALTER TABLE `password_resets`
  ADD PRIMARY KEY (`email`);

--
-- Indeks untuk tabel `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indeks untuk tabel `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_bouquet` (`bouquet_id`);

--
-- Indeks untuk tabel `transaction_items`
--
ALTER TABLE `transaction_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `transaction_items_transaction_id_foreign` (`transaction_id`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `bouquets`
--
ALTER TABLE `bouquets`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT untuk tabel `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `transactions`
--
ALTER TABLE `transactions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=168;

--
-- AUTO_INCREMENT untuk tabel `transaction_items`
--
ALTER TABLE `transaction_items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `transactions`
--
ALTER TABLE `transactions`
  ADD CONSTRAINT `fk_bouquet` FOREIGN KEY (`bouquet_id`) REFERENCES `bouquets` (`id`);

--
-- Ketidakleluasaan untuk tabel `transaction_items`
--
ALTER TABLE `transaction_items`
  ADD CONSTRAINT `transaction_items_transaction_id_foreign` FOREIGN KEY (`transaction_id`) REFERENCES `transactions` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
