-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 08 Apr 2025 pada 12.12
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
(3, 'r', 'hahaha', '123.00', 'bouquet_images/5axAx2iyd8TOiZ9Th4QHv9bpsJqCjm0IJx58ZyyT.jpg', '2025-03-13 09:05:16', '2025-03-16 10:31:19', 'Kertas'),
(4, 'zz', 'zzz', '44444.00', 'bouquet_images/GUp9slZKi160qJyMs8gvGus79EKLvS89zbsJSkHO.jpg', '2025-03-16 09:11:13', '2025-03-16 09:11:13', 'Bunga'),
(5, 'saya', 'bagsu', '123354.00', 'bouquet_images/J1TzwzotDSVbLBt9Kxe5G6lpCd3yJBWSfrQulM09.jpg', '2025-03-16 09:46:02', '2025-03-16 09:46:02', 'Bunga'),
(6, 'hhu', 'kjkj', '4444.00', 'bouquet_images/R1QoaUZi1zteqbf40SbfcGtXir2KrLmOPDorX3hA.jpg', '2025-03-16 10:25:20', '2025-03-16 10:29:16', 'Kertas'),
(7, 'fdd', 'fdgdf4', '454545.00', 'bouquet_images/OixCtiK41fdIBJ93fWL9rcuZYjwz6rfnkDQnn4xF.jpg', '2025-03-16 10:29:47', '2025-03-16 10:29:47', 'Bunga'),
(8, 's', 'd1', '22222.00', 'bouquet_images/hhkruBoP6F5mjnSysx3VC50LB1Ok1nTvbYgRSfug.jpg', '2025-04-08 01:06:48', '2025-04-08 01:07:01', 'Buket'),
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
(6, '2025_03_20_224532_create_transactions_table', 2);

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
  `status` enum('pending','confirmed','rejected','paid') DEFAULT 'pending',
  `delivery_method` varchar(20) NOT NULL DEFAULT 'Ambil Sendiri',
  `address` text DEFAULT NULL,
  `note` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `transactions`
--

INSERT INTO `transactions` (`id`, `created_at`, `updated_at`, `user_id`, `bouquet_id`, `shipping_cost`, `total_amount`, `total_payment`, `payment_method`, `status`, `delivery_method`, `address`, `note`) VALUES
(32, '2025-04-08 02:11:40', '2025-04-08 02:25:35', 3, 5, 0, '123354.00', 0, 'bank_transfer', 'paid', 'Ambil Sendiri', 'manahan', 'jhjgj'),
(33, '2025-04-08 02:11:40', '2025-04-08 02:11:40', 3, 4, 0, '44444.00', 0, 'bank_transfer', 'pending', 'Ambil Sendiri', 'manahan', 'jhjgj'),
(34, '2025-04-08 02:16:28', '2025-04-08 02:16:28', 3, 4, 0, '44444.00', 0, 'qris', 'pending', 'Ambil Sendiri', 'manahan', NULL),
(35, '2025-04-08 02:18:38', '2025-04-08 02:18:38', 3, 5, 0, '123354.00', 0, 'bank_transfer', 'pending', 'Ambil Sendiri', 'manahan', NULL),
(36, '2025-04-08 02:21:22', '2025-04-08 02:21:22', 3, 5, 0, '123354.00', 0, 'bank_transfer', 'pending', 'Ambil Sendiri', 'manahan', 'halow'),
(37, '2025-04-08 02:21:22', '2025-04-08 02:21:22', 3, 3, 0, '123.00', 0, 'bank_transfer', 'pending', 'Ambil Sendiri', 'manahan', 'halow'),
(38, '2025-04-08 02:34:16', '2025-04-08 02:34:16', 3, 5, 0, '123354.00', 0, 'bank_transfer', 'pending', 'Ambil Sendiri', 'manahan', 'halow'),
(39, '2025-04-08 02:34:50', '2025-04-08 02:34:50', 3, 5, 0, '123354.00', 0, 'bank_transfer', 'pending', 'Ambil Sendiri', 'keprabon', 'sss'),
(40, '2025-04-08 02:35:54', '2025-04-08 02:35:54', 3, 4, 0, '44444.00', 0, 'bank_transfer', 'pending', 'Ambil Sendiri', NULL, 'aa'),
(41, '2025-04-08 02:38:45', '2025-04-08 02:38:45', 3, 4, 0, '44444.00', 0, 'bank_transfer', 'pending', 'Ambil Sendiri', 'keprabon', 'aw'),
(42, '2025-04-08 02:45:11', '2025-04-08 02:45:11', 3, 4, 0, '44444.00', 0, 'bank_transfer', 'pending', 'Ambil Sendiri', 'gajahan', 'aa'),
(43, '2025-04-08 02:55:15', '2025-04-08 02:55:15', 3, 5, 0, '123354.00', 0, 'bank_transfer', 'pending', 'Ambil Sendiri', 'gajahan', 'xxx'),
(44, '2025-04-08 03:09:19', '2025-04-08 03:09:19', 3, 5, 0, '123354.00', 0, 'qris', 'pending', 'Ambil Sendiri', 'manahan', 'ddd');

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
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'tutut', 'tutut@gmail.com', NULL, '$2y$10$Tlub7Dk4dt14QVz93zjz8O2/gKQKN8WP4MGqH.igkJ0ocpXCtpxAq', NULL, '2025-03-16 11:21:28', '2025-03-16 11:21:28'),
(2, 'sta', 'k@gmail.com', NULL, '$2y$10$q31W77tgMjdFMUki0ntFnug1oX9YKoCzkVfU325UT0ahnu1PR5Dwu', NULL, '2025-03-16 12:28:03', '2025-03-16 12:28:03'),
(3, 'tutut', 'tututbagiawati@gmail.com', NULL, '$2y$10$Z0BQRMKgM66WqBWJJP9iO.Nuwqpjs06Rvu2BvyHjmO3WUmXLWI3a.', NULL, '2025-04-06 04:44:50', '2025-04-06 04:44:50');

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
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `transactions`
--
ALTER TABLE `transactions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `transactions`
--
ALTER TABLE `transactions`
  ADD CONSTRAINT `fk_bouquet` FOREIGN KEY (`bouquet_id`) REFERENCES `bouquets` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
