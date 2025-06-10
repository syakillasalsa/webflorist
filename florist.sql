-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 26, 2025 at 03:23 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

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
-- Table structure for table `bouquets`
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
-- Dumping data for table `bouquets`
--

INSERT INTO `bouquets` (`id`, `name`, `description`, `price`, `image`, `created_at`, `updated_at`, `category`) VALUES
(3, 'Red Rose', 'Red Rose is a classic red flower that symbolizes love, courage, and romance. With its slender stem and luxurious petals, it makes a perfect gift for a partner or as a decoration for special occasions.', 8000.00, 'bouquet_images/1.png', '2025-03-13 09:05:16', '2025-05-11 11:44:02', 'Bunga'),
(10, 'White Rose', 'White Rose symbolizes sincerity, purity, and hope. With its soft petals and elegant appearance, it is an ideal choice for wedding gifts, graduations, or meaningful and sacred moments.', 8000.00, 'bouquet_images/whiterosecanva.png', '2025-04-17 07:31:18', '2025-05-11 11:37:52', 'Bunga'),
(11, 'Pink Rose', 'Pink Rose represents gentleness, affection, and gratitude. Its pastel tone and sweet petals make it a lovely way to express care and tender love.', 10000.00, 'bouquet_images/pinkrosecanva.png', '2025-04-17 07:33:14', '2025-05-11 11:35:59', 'Bunga'),
(15, 'Cosmos Orange', 'Cosmos Orange is a bright orange flower that symbolizes energy, joy, and warmth. With its simple yet charming shape, it’s perfect for rustic-themed wedding décor or thanksgiving celebrations.', 8000.00, 'bouquet_images/3.png', '2025-04-17 07:34:36', '2025-05-11 11:45:15', 'Bunga'),
(16, 'Chamomile', 'Chamomile is a tiny white flower with a yellow center, symbolizing calm and comfort. It offers a natural and peaceful vibe, making it a great accent for wildflower or rustic bouquets.', 7000.00, 'bouquet_images/chamomile.png', '2025-04-17 07:34:56', '2025-05-11 11:57:31', 'Bunga'),
(17, 'Lavender', 'Lavender is a purple flower well-known for its soothing fragrance and symbolism of peace and serenity. Its graceful appearance makes it a perfect choice for weddings, graduations, or thoughtful gifts on special days.', 10000.00, 'bouquet_images/2.png', '2025-04-17 07:36:36', '2025-05-11 11:44:22', 'Bunga'),
(18, 'Orchid', 'Orchid exudes elegance, luxury, and uniqueness. With its exotic shape and refined look, it’s ideal as a sophisticated gift.', 10000.00, 'bouquet_images/orchid.png', '2025-04-17 07:37:06', '2025-05-11 11:57:51', 'Bunga'),
(19, 'Pink Tulip', 'Pink Tulip symbolizes gentle love and happiness. With its simple yet iconic shape, this flower is perfect as a springtime gift or to brighten up any cheerful occasion.', 8000.00, 'bouquet_images/tulip.png', '2025-04-17 07:38:41', '2025-05-11 11:58:29', 'Bunga'),
(20, 'Yellow Billy Ball', 'Yellow Billy Ball is a unique flower with small, round, bright yellow blooms that represent joy and creativity. It’s an ideal accent to enhance floral arrangements with a playful and modern touch.', 8000.00, 'bouquet_images/kuning.png', '2025-04-17 07:39:09', '2025-05-11 11:58:57', 'Bunga'),
(22, 'Garbera Daisy', 'Gerbera Daisy is a vibrant flower known for its bold colors and joyful vibe. Its large, bright petals make it a perfect choice to liven up any space or celebration.', 10000.00, 'bouquet_images/ungu.png', '2025-04-17 07:41:53', '2025-05-11 11:59:36', 'Bunga'),
(23, 'Blue Silk Hydrangea', 'Blue Silk Hydrangea is a stunning artificial bloom that symbolizes sincerity and peace. With its full and soft petals, it makes a luxurious centerpiece in bouquets.', 8000.00, 'bouquet_images/biru.png', '2025-04-17 07:42:23', '2025-05-11 12:00:24', 'Bunga'),
(24, 'Sunflower', 'Sunflower is a bright, cheerful bloom that stands for happiness, optimism, and positive energy. Its large yellow petals bring warmth and joy to any floral arrangement.', 10000.00, 'bouquet_images/sun.png', '2025-04-17 07:43:53', '2025-05-11 11:58:11', 'Bunga'),
(25, 'Bouquet 1', 'A classic and stunning red bouquet featuring red roses and dried flowers, creating a romantic and elegant vibe. Perfect for anniversaries, proposals, or passionate love moments.', 300000.00, 'bouquet_images/1744909388_b5.png', '2025-04-17 07:44:25', '2025-04-17 11:15:05', 'Buket'),
(26, 'Bouquet 2', 'A charming bouquet with a soft mix of pink roses and white chamomile, offering a sense of affection and gratitude. Ideal for birthdays, graduations, or a thoughtful surprise gift.', 250000.00, 'bouquet_images/1744907980_s1.png', '2025-04-17 07:52:17', '2025-04-17 11:15:22', 'Buket'),
(27, 'Bouquet 3', 'A graceful blend of pastel peach and purple tones, giving off a soft and feminine aura. Great for bridesmaid gifts, baby showers, or other sweet celebrations.', 300000.00, 'bouquet_images/1744908038_s2.png', '2025-04-17 07:52:54', '2025-04-17 11:14:40', 'Buket'),
(30, 'Bouquet 4', 'A cheerful bouquet dominated by orange cosmos, yellow billy balls, and garberas. The perfect gift to brighten someone’s day or celebrate a joyful occasion.', 250000.00, 'bouquet_images/1744908123_buket1.png', '2025-04-17 09:18:12', '2025-04-17 11:23:56', 'Buket'),
(31, 'Bouquet 5 (Heart Box)', 'A heart-shaped box arrangement with a vibrant mix of orange and white flowers. Romantic and elegant perfect for Valentine’s Day, anniversaries, or heartfelt surprises.', 175000.00, 'bouquet_images/1744908322_b6.png', '2025-04-17 09:19:12', '2025-04-17 11:22:06', 'Buket'),
(33, 'Bouquet 6 (Purple Box)', 'A luxurious box bouquet featuring purple and pastel pink blooms. Stylish and sweet Ideal for birthdays, graduations, or thoughtful appreciation gifts.', 150000.00, 'bouquet_images/1744908337_buket2.png', '2025-04-17 09:24:38', '2025-04-17 11:22:24', 'Buket'),
(34, 'Bouquet 7 (Pink Table)', 'A modern table arrangement with a soft pink color palette. Perfect for table decoration, Mother’s Day, or a special moment with loved ones.', 450000.00, 'bouquet_images/1744908406_s3.png', '2025-04-17 09:25:03', '2025-04-17 11:22:41', 'Buket'),
(35, 'Bouquet 8 (White & Blue Table)', 'A deluxe bouquet showcasing white and pastel blue flowers, delivering a calm and classy impression. Perfect for formal events, party décor, or wedding gifts.', 450000.00, 'bouquet_images/1744908427_s4.png', '2025-04-17 09:47:07', '2025-04-17 11:33:07', 'Buket'),
(36, 'Bouquet 9 (Blue & Pink)', 'An elegant mix of blue hydrangeas, pink tulips, and peach blooms. Fresh and graceful great for grand openings, indoor events, or weddings.', 500000.00, 'bouquet_images/1744908826_s.jpg', '2025-04-17 09:53:46', '2025-04-17 11:33:22', 'Buket'),
(37, 'Pallete 1', 'Shades of warm beige, brown, and cream—perfect for a natural, earthy bouquet with a cozy, elegant touch.', 5000.00, 'bouquet_images/1744908946_1.jpg', '2025-04-17 09:55:46', '2025-04-17 11:28:52', 'Kertas'),
(38, 'Pallete 2', 'A romantic mix of pink tones that add sweetness and charm—ideal for expressing love or affection.', 5000.00, 'bouquet_images/1744908966_2.jpg', '2025-04-17 09:56:06', '2025-04-17 11:29:12', 'Kertas'),
(39, 'Pallete 3', 'Fresh aqua and turquoise hues that bring a cool, refreshing vibe—great for modern and cheerful bouquets.', 5000.00, 'bouquet_images/1744908985_3.jpg', '2025-04-17 09:56:25', '2025-04-17 11:29:30', 'Kertas'),
(40, 'Pallete 4', 'Monochrome tones of black, grey, and white—sleek and classy, perfect for a bold and contemporary look.', 5000.00, 'bouquet_images/1744909990_4.jpg', '2025-04-17 10:13:10', '2025-04-17 11:29:53', 'Kertas'),
(41, 'Pallete 5', 'Soft and lively greens that evoke freshness and nature—ideal for a botanical or rustic bouquet.', 5000.00, 'bouquet_images/1744910018_5.jpg', '2025-04-17 10:13:38', '2025-04-17 11:30:14', 'Kertas');

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
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
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
-- Table structure for table `transactions`
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
-- Dumping data for table `transactions`
--

INSERT INTO `transactions` (`id`, `created_at`, `updated_at`, `user_id`, `bouquet_id`, `shipping_cost`, `total_amount`, `total_payment`, `payment_method`, `status`, `delivery_method`, `address`, `note`, `pickup_date`, `pickup_time`, `delivery_date`, `delivery_time`) VALUES
(172, '2025-04-30 01:40:15', '2025-04-30 01:40:15', 4, 3, 10450, 450000.00, 460450, 'bank_transfer', 'Success', 'delivery', 'keprabon, surakarta', 'halow', NULL, NULL, '2025-04-30', '03:40:00'),
(173, '2025-04-30 03:50:02', '2025-04-30 03:50:02', 3, 3, 10450, 27000.00, 37450, 'bank_transfer', 'Success', 'delivery', 'keprabon, surakarta', NULL, '2025-04-30', '05:49:00', '2025-04-30', '05:49:00'),
(174, '2025-04-30 04:08:09', '2025-04-30 04:08:09', 3, 3, 0, 10000.00, 10000, 'bank_transfer', 'Success', 'pickup', NULL, NULL, '2025-04-30', '06:08:00', NULL, NULL),
(175, '2025-05-06 02:50:08', '2025-05-06 02:50:08', 4, 3, 11754, 8000.00, 19754, 'bank_transfer', 'Success', 'delivery', 'manahan', 'cccc', NULL, NULL, '2025-05-06', '16:49:00'),
(176, '2025-05-06 03:46:52', '2025-05-06 03:46:52', 5, 3, 15000, 455000.00, 470000, 'bank_transfer', 'Success', 'delivery', 'jl kenanga no 256', 'pliss add \"thank you\"', NULL, NULL, '2025-05-24', '20:33:00'),
(177, '2025-05-15 04:38:13', '2025-05-15 04:38:13', 3, 3, 0, 7000.00, 7000, 'pay_in_store', 'Success', 'pickup', NULL, 'm', '2025-05-16', '18:37:00', NULL, NULL),
(178, '2025-05-18 04:41:15', '2025-05-18 04:41:15', 3, 3, 10000, 313000.00, 323000, 'bank_transfer', 'Success', 'delivery', 'Jl Mahesosuro, Gajahan, Pasar Kliwon, Surakarta', 'greeting card : \'congratulation on your graduation!! i\'m soo happy for you.\'', NULL, NULL, '2025-05-20', '19:40:00'),
(179, '2025-05-18 05:42:01', '2025-05-18 05:42:01', 3, 3, 10000, 313000.00, 323000, 'bank_transfer', 'Success', 'delivery', 'Jl Mahesuro,Gajahan,Pasar Kliwon,Surakarta', 'greeting card : \'congratulations on your graduation!!im soo happy for you.\'', NULL, NULL, '2025-05-20', '19:40:00');

-- --------------------------------------------------------

--
-- Table structure for table `transaction_items`
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
-- Dumping data for table `transaction_items`
--

INSERT INTO `transaction_items` (`id`, `transaction_id`, `bouquet_id`, `quantity`, `subtotal`, `price`, `created_at`, `updated_at`) VALUES
(56, 172, 35, 1, 450000.00, 450000.00, '2025-04-30 01:40:15', '2025-04-30 01:40:15'),
(57, 173, 11, 2, 20000.00, 10000.00, '2025-04-30 03:50:02', '2025-04-30 03:50:02'),
(58, 173, 16, 1, 7000.00, 7000.00, '2025-04-30 03:50:02', '2025-04-30 03:50:02'),
(59, 174, 11, 1, 10000.00, 10000.00, '2025-04-30 04:08:09', '2025-04-30 04:08:09'),
(60, 175, 10, 1, 8000.00, 8000.00, '2025-05-06 02:50:08', '2025-05-06 02:50:08'),
(61, 176, 35, 1, 450000.00, 450000.00, '2025-05-06 03:46:52', '2025-05-06 03:46:52'),
(62, 176, 41, 1, 5000.00, 5000.00, '2025-05-06 03:46:52', '2025-05-06 03:46:52'),
(63, 177, 16, 1, 7000.00, 7000.00, '2025-05-15 04:38:13', '2025-05-15 04:38:13'),
(64, 178, 3, 1, 8000.00, 8000.00, '2025-05-18 04:41:15', '2025-05-18 04:41:15'),
(65, 178, 27, 1, 300000.00, 300000.00, '2025-05-18 04:41:15', '2025-05-18 04:41:15'),
(66, 178, 38, 1, 5000.00, 5000.00, '2025-05-18 04:41:15', '2025-05-18 04:41:15'),
(67, 179, 3, 1, 8000.00, 8000.00, '2025-05-18 05:42:01', '2025-05-18 05:42:01'),
(68, 179, 27, 1, 300000.00, 300000.00, '2025-05-18 05:42:01', '2025-05-18 05:42:01'),
(69, 179, 38, 1, 5000.00, 5000.00, '2025-05-18 05:42:01', '2025-05-18 05:42:01');

-- --------------------------------------------------------

--
-- Table structure for table `users`
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
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `role`) VALUES
(1, 'tutut', 'tutut@gmail.com', NULL, '$2y$10$Tlub7Dk4dt14QVz93zjz8O2/gKQKN8WP4MGqH.igkJ0ocpXCtpxAq', NULL, '2025-03-16 11:21:28', '2025-03-16 11:21:28', 'user'),
(2, 'sta', 'k@gmail.com', NULL, '$2y$10$q31W77tgMjdFMUki0ntFnug1oX9YKoCzkVfU325UT0ahnu1PR5Dwu', NULL, '2025-03-16 12:28:03', '2025-03-16 12:28:03', 'user'),
(3, 'tutut', 'tututbagiawati@gmail.com', NULL, '$2y$10$Z0BQRMKgM66WqBWJJP9iO.Nuwqpjs06Rvu2BvyHjmO3WUmXLWI3a.', NULL, '2025-04-06 04:44:50', '2025-04-06 04:44:50', 'user'),
(4, '', 'admin@florist.com', NULL, '$2y$10$7BmFz..j7dMo8nKBPzjtVuY12bUTgCIPr3k9OA4jrAUwCg5csGb1G', NULL, NULL, '2025-04-30 00:25:05', 'admin'),
(5, 'syakilla', 'syakillasalsa7@gmail.com', NULL, '$2y$10$W6pK1pAjXlds92vap7TfBezOC70PwqP292/kKOu1NcD60DlLNTRYa', NULL, '2025-05-06 00:59:32', '2025-05-06 00:59:32', 'user');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bouquets`
--
ALTER TABLE `bouquets`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_bouquet` (`bouquet_id`);

--
-- Indexes for table `transaction_items`
--
ALTER TABLE `transaction_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `transaction_items_transaction_id_foreign` (`transaction_id`);

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
-- AUTO_INCREMENT for table `bouquets`
--
ALTER TABLE `bouquets`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=180;

--
-- AUTO_INCREMENT for table `transaction_items`
--
ALTER TABLE `transaction_items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=70;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `transaction_items`
--
ALTER TABLE `transaction_items`
  ADD CONSTRAINT `transaction_items_transaction_id_foreign` FOREIGN KEY (`transaction_id`) REFERENCES `transactions` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
