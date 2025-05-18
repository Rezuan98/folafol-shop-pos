-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 18, 2025 at 04:01 PM
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
-- Database: `folafol`
--

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
-- Table structure for table `ingredients`
--

CREATE TABLE `ingredients` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `current_stock` decimal(10,2) NOT NULL,
  `unit` varchar(10) NOT NULL,
  `minimum_stock` decimal(10,2) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `ingredients`
--

INSERT INTO `ingredients` (`id`, `name`, `description`, `current_stock`, `unit`, `minimum_stock`, `image`, `created_at`, `updated_at`) VALUES
(1, 'sugar', 'yft', 6.00, 'kg', 2.00, NULL, '2025-05-10 14:13:33', '2025-05-10 14:13:33'),
(2, 'malta', 'gfjg', 10.90, 'kg', 10.00, 'ingredients/flW5aNrx0FZFuDdm2d1MirZeXxjo9PqD4PwLi9vw.jpg', '2025-05-11 12:42:48', '2025-05-11 12:45:45');

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
-- Table structure for table `juices`
--

CREATE TABLE `juices` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `price_small` decimal(10,2) DEFAULT NULL,
  `price_medium` decimal(10,2) DEFAULT NULL,
  `price_large` decimal(10,2) DEFAULT NULL,
  `is_available` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `juices`
--

INSERT INTO `juices` (`id`, `name`, `description`, `image`, `price_small`, `price_medium`, `price_large`, `is_available`, `created_at`, `updated_at`) VALUES
(1, 'Lemonade', 'this is a very popular and healthy juice in summer', 'juices/dAzJj6qFSuTQS8nfpr1mz91x3AXu544d9SoPNP0B.jpg', 50.00, 70.00, 90.00, 0, '2025-05-09 12:41:45', '2025-05-09 12:43:40'),
(2, 'Orange Juice', 'it tastes good', 'juices/euNN7CbZO9bEjpeCMLnzLoXvlStGBBKWK2SJI2GW.jpg', 60.00, 90.00, 120.00, 0, '2025-05-09 12:44:33', '2025-05-09 14:16:36'),
(3, 'Special  Papaya Juice', 'this is very energy boosting juice', 'juices/RZyTNc2dgsOeiiFVri1g0UYgijQoKSAEdzIqTHUd.jpg', 100.00, 130.00, 150.00, 0, '2025-05-09 12:45:45', '2025-05-09 16:05:37'),
(4, 'Special Mango Juice', 'its a very healthy juice', 'juices/JlyhNMYi61aAYgaAyEdXs06DEPBXSYwHmtdd08Ym.jpg', 70.00, 100.00, 130.00, 1, '2025-05-09 12:47:01', '2025-05-09 12:47:01'),
(5, 'malta juice', 'this is very tasty', 'juices/BETUhq5V7k0I5tgkutzprHklKRRPDpT1mXkFYQ2j.jpg', 70.00, 90.00, 120.00, 1, '2025-05-09 13:17:01', '2025-05-09 13:17:01'),
(6, 'Strawberry Juice', 'jeflskbfkjd', 'juices/B4l1MLrPy1UZ2ByoyRK0NwAIbrVhwCjR1frGw7PW.jpg', 80.00, NULL, 110.00, 1, '2025-05-12 10:17:17', '2025-05-12 10:37:06'),
(7, 'Papaya Milkshake', 'ljhehgfsdjklk', 'juices/Df1Wzq6djFNYsinTYayCU9fwV1CoBFcanY6xnO7n.jpg', 80.00, NULL, 120.00, 1, '2025-05-12 10:19:29', '2025-05-12 10:43:46'),
(8, 'Doi chira', 'wriflhej', 'juices/ZyjWJFhnY1l1sPhvuf8paViF5oGdAAij8uRC45ZT.jpg', NULL, 100.00, NULL, 1, '2025-05-12 10:40:30', '2025-05-12 10:40:43'),
(9, 'watermelon milkshake', 'dwjdnlc;m,', 'juices/JvNTbSNpfh10aJ0JB482IRtqnjwzW756GFTpmn89.jpg', 80.00, 100.00, 120.00, 1, '2025-05-12 12:38:23', '2025-05-12 12:39:40');

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
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2025_05_09_181302_create_juices_table', 1),
(5, '2025_05_09_185725_create_orders_table', 2),
(6, '2025_05_09_185749_create_order_items_table', 2),
(7, '2025_05_09_211435_add_order_name_to_orders_table', 3),
(8, '2025_05_10_181743_create_ingredients_table', 4),
(9, '2025_05_10_181816_create_stock_adjustments_table', 4);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_number` varchar(255) NOT NULL,
  `order_name` varchar(255) DEFAULT NULL,
  `subtotal` decimal(10,2) NOT NULL,
  `discount` decimal(10,2) NOT NULL DEFAULT 0.00,
  `total` decimal(10,2) NOT NULL,
  `payment_method` varchar(255) NOT NULL DEFAULT 'Cash',
  `status` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `order_number`, `order_name`, `subtotal`, `discount`, `total`, `payment_method`, `status`, `created_at`, `updated_at`) VALUES
(3, 'ORD-000003', 'folafol-1', 100.00, 0.00, 100.00, 'Cash', 'Completed', '2025-05-09 15:35:23', '2025-05-09 15:35:23'),
(4, 'ORD-000004', 'folafol-2', 820.00, 0.00, 820.00, 'Cash', 'Completed', '2025-05-09 15:38:52', '2025-05-09 15:38:52'),
(5, 'ORD-000005', 'folafol-3', 150.00, 0.00, 150.00, 'Cash', 'Completed', '2025-05-09 15:50:02', '2025-05-09 15:50:02'),
(6, 'ORD-000006', 'folafol-4', 220.00, 0.00, 220.00, 'Cash', 'Completed', '2025-05-09 16:03:10', '2025-05-09 16:03:10'),
(7, 'ORD-000007', 'folafol-5', 370.00, 0.00, 370.00, 'Cash', 'Completed', '2025-05-09 16:04:06', '2025-05-09 16:04:06'),
(8, 'ORD-000008', 'folafol-6', 120.00, 0.00, 120.00, 'Cash', 'Completed', '2025-05-09 16:05:59', '2025-05-09 16:05:59'),
(18, 'ORD-000009', 'folafol-7', 90.00, 0.00, 90.00, 'Cash', 'Completed', '2025-05-11 12:07:40', '2025-05-11 12:07:40'),
(19, 'ORD-000019', 'folafol-8', 100.00, 0.00, 100.00, 'Cash', 'Completed', '2025-05-12 10:41:37', '2025-05-12 10:41:37'),
(20, 'ORD-000020', 'folafol-9', 70.00, 0.00, 70.00, 'Cash', 'Completed', '2025-05-16 04:33:24', '2025-05-16 04:33:24'),
(21, 'ORD-000021', 'folafol-10', 110.00, 0.00, 110.00, 'bkash', 'Completed', '2025-05-16 06:24:30', '2025-05-16 06:24:30'),
(22, 'ORD-000022', 'folafol-11', 90.00, 0.00, 90.00, 'nagad', 'Completed', '2025-05-17 12:30:02', '2025-05-17 12:30:02');

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_id` bigint(20) UNSIGNED NOT NULL,
  `juice_id` bigint(20) UNSIGNED NOT NULL,
  `juice_name` varchar(255) NOT NULL,
  `size` varchar(255) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `quantity` int(11) NOT NULL,
  `total` decimal(10,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`id`, `order_id`, `juice_id`, `juice_name`, `size`, `price`, `quantity`, `total`, `created_at`, `updated_at`) VALUES
(4, 3, 4, 'Special Mango Juice', 'medium', 100.00, 1, 100.00, '2025-05-09 15:35:23', '2025-05-09 15:35:23'),
(5, 4, 5, 'malta juice', 'small', 70.00, 1, 70.00, '2025-05-09 15:38:52', '2025-05-09 15:38:52'),
(6, 4, 3, 'Special  Papaya Juice', 'large', 150.00, 5, 750.00, '2025-05-09 15:38:52', '2025-05-09 15:38:52'),
(7, 5, 3, 'Special  Papaya Juice', 'large', 150.00, 1, 150.00, '2025-05-09 15:50:02', '2025-05-09 15:50:02'),
(8, 6, 4, 'Special Mango Juice', 'medium', 100.00, 1, 100.00, '2025-05-09 16:03:10', '2025-05-09 16:03:10'),
(9, 6, 5, 'malta juice', 'large', 120.00, 1, 120.00, '2025-05-09 16:03:10', '2025-05-09 16:03:10'),
(10, 7, 4, 'Special Mango Juice', 'medium', 100.00, 1, 100.00, '2025-05-09 16:04:06', '2025-05-09 16:04:06'),
(11, 7, 5, 'malta juice', 'large', 120.00, 1, 120.00, '2025-05-09 16:04:06', '2025-05-09 16:04:06'),
(12, 7, 3, 'Special  Papaya Juice', 'large', 150.00, 1, 150.00, '2025-05-09 16:04:06', '2025-05-09 16:04:06'),
(13, 8, 5, 'malta juice', 'large', 120.00, 1, 120.00, '2025-05-09 16:05:59', '2025-05-09 16:05:59'),
(14, 18, 5, 'malta juice', 'medium', 90.00, 1, 90.00, '2025-05-11 12:07:40', '2025-05-11 12:07:40'),
(15, 19, 8, 'Doi chira', 'medium', 100.00, 1, 100.00, '2025-05-12 10:41:37', '2025-05-12 10:41:37'),
(16, 20, 4, 'Special Mango Juice', 'small', 70.00, 1, 70.00, '2025-05-16 04:33:24', '2025-05-16 04:33:24'),
(17, 21, 6, 'Strawberry Juice', 'large', 110.00, 1, 110.00, '2025-05-16 06:24:30', '2025-05-16 06:24:30'),
(18, 22, 5, 'malta juice', 'medium', 90.00, 1, 90.00, '2025-05-17 12:30:02', '2025-05-17 12:30:02');

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
('1YjH5kBRNkORN0dDMbJngVT3CAN3ZQftt7myLnK7', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/136.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoia2xJbmF4c2VONXZvVGRlVzFrQ3BXbWJXT1Z5SUNaZExmRWFOclpiNSI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJuZXciO2E6MDp7fXM6Mzoib2xkIjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NTc6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9hZG1pbi9yZXBvcnRzL2RhaWx5P2RhdGU9MjAyNS0wNS0xNyI7fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjE7fQ==', 1747509294),
('HIEhPqoYwI3O28xILcXYfDL1nZqlxfYc81G810n7', 2, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/136.0.0.0 Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiZDJGOW5kTHNKRVJORVBrV2Z6Mkd2T1djQ2kxQTd6ZDFGYTNqYlY4dSI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czozOiJ1cmwiO2E6MDp7fXM6OToiX3ByZXZpb3VzIjthOjE6e3M6MzoidXJsIjtzOjIxOiJodHRwOi8vMTI3LjAuMC4xOjgwMDAiO31zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aToyO30=', 1747249188),
('qHuCXN5LGAQnTadEgw6LHXxCehhM68VqLZ70FB5S', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/136.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiemF5TWFsNWVxVFZxRVRPYkV0YXdzeDBlVFp0ZFFiRGtPQWk5QUlEaCI7czozOiJ1cmwiO2E6MTp7czo4OiJpbnRlbmRlZCI7czoyMToiaHR0cDovLzEyNy4wLjAuMTo4MDAwIjt9czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mjc6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9sb2dpbiI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1747454947),
('qZNbtlqoqO8lVgSmV1i4MG1C45hLsY5WSj1xqHif', 2, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/136.0.0.0 Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiV2dQdFhUMUxpWXp1MHJUbVdrbFM3UUpCb0FGd2dGTGowZVFsY0hCciI7czozOiJ1cmwiO2E6MDp7fXM6OToiX3ByZXZpb3VzIjthOjE6e3M6MzoidXJsIjtzOjMxOiJodHRwOi8vMTI3LjAuMC4xOjgwMDAvYWRtaW4vcG9zIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6Mjt9', 1747398270);

-- --------------------------------------------------------

--
-- Table structure for table `stock_adjustments`
--

CREATE TABLE `stock_adjustments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `ingredient_id` bigint(20) UNSIGNED NOT NULL,
  `quantity` decimal(10,2) NOT NULL,
  `type` varchar(255) NOT NULL,
  `notes` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `stock_adjustments`
--

INSERT INTO `stock_adjustments` (`id`, `ingredient_id`, `quantity`, `type`, `notes`, `created_at`, `updated_at`) VALUES
(1, 2, 5.00, 'in', NULL, '2025-05-11 12:43:50', '2025-05-11 12:43:50'),
(2, 2, -2.00, 'out', NULL, '2025-05-11 12:44:42', '2025-05-11 12:44:42'),
(3, 2, -0.10, 'wastage', NULL, '2025-05-11 12:45:13', '2025-05-11 12:45:13'),
(4, 2, 3.00, 'adjustment', NULL, '2025-05-11 12:45:45', '2025-05-11 12:45:45');

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
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Rezuan Ahmmed', 'rezuanahmmeds@gmail.com', NULL, '$2y$12$Ohktkp.ev5siF.1Un5JvlOVS37SRWDykvLDw7cDNo/wKSnqFIltja', NULL, '2025-05-13 13:44:03', '2025-05-13 13:44:03'),
(2, 'gd', 'admin@gmail.com', NULL, '$2y$12$lx6L9JsZRfcvkuj5e1j5DeUmgg1mT1LMRsh3bWIXQfCnSwY6HCNhG', NULL, '2025-05-14 12:01:36', '2025-05-14 12:01:36');

--
-- Indexes for dumped tables
--

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
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `ingredients`
--
ALTER TABLE `ingredients`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `juices`
--
ALTER TABLE `juices`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `orders_order_number_unique` (`order_number`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_items_order_id_foreign` (`order_id`),
  ADD KEY `order_items_juice_id_foreign` (`juice_id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `stock_adjustments`
--
ALTER TABLE `stock_adjustments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `stock_adjustments_ingredient_id_foreign` (`ingredient_id`);

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
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ingredients`
--
ALTER TABLE `ingredients`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `juices`
--
ALTER TABLE `juices`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `stock_adjustments`
--
ALTER TABLE `stock_adjustments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `order_items_juice_id_foreign` FOREIGN KEY (`juice_id`) REFERENCES `juices` (`id`),
  ADD CONSTRAINT `order_items_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `stock_adjustments`
--
ALTER TABLE `stock_adjustments`
  ADD CONSTRAINT `stock_adjustments_ingredient_id_foreign` FOREIGN KEY (`ingredient_id`) REFERENCES `ingredients` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
