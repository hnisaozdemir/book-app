-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Anamakine: 127.0.0.1
-- Üretim Zamanı: 03 Haz 2025, 09:33:43
-- Sunucu sürümü: 10.4.32-MariaDB
-- PHP Sürümü: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Veritabanı: `book_app`
--

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `carts`
--

CREATE TABLE `carts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `quantity` int(11) NOT NULL DEFAULT 1,
  `added_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Tablo döküm verisi `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '2025_05_15_175756_create_products_table', 1),
(3, '2025_05_15_175757_create_carts_table', 1),
(4, '2025_05_15_175758_create_orders_table', 1),
(5, '2025_05_15_175759_create_order_items_table', 1),
(6, '2025_05_19_143003_add_remember_token_to_users_table', 1),
(7, '2025_05_21_150750_add_address_to_users_table', 1),
(8, '2025_05_24_111205_add_state_to_order_items_table', 1),
(9, '2025_05_26_102709_update_products_table_modify_columns', 2);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `orders`
--

CREATE TABLE `orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `total_price` decimal(10,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Tablo döküm verisi `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `total_price`, `created_at`, `updated_at`) VALUES
(1, 10, 333.00, '2025-05-26 07:16:53', '2025-05-26 07:16:53'),
(2, 11, 175.00, '2025-05-27 15:09:27', '2025-05-27 15:09:27'),
(3, 11, 123.00, '2025-05-27 18:23:16', '2025-05-27 15:22:16'),
(4, 11, 32423.00, '2025-05-27 15:24:06', '2025-05-27 15:24:06'),
(5, 11, 21.00, '2025-05-27 15:26:53', '2025-05-27 15:26:53'),
(6, 11, 1312.00, '2025-05-27 15:56:52', '2025-05-27 15:56:52'),
(7, 11, 12321.00, '2025-05-27 16:15:36', '2025-05-27 16:15:36'),
(8, 11, 312.00, '2025-05-27 17:55:42', '2025-05-27 17:55:42'),
(9, 11, 2.00, '2025-05-28 04:23:13', '2025-05-28 04:23:13'),
(10, 11, 2.00, '2025-05-29 11:17:27', '2025-05-29 11:17:27');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `order_items`
--

CREATE TABLE `order_items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `state` tinyint(3) UNSIGNED NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Tablo döküm verisi `order_items`
--

INSERT INTO `order_items` (`id`, `order_id`, `product_id`, `quantity`, `price`, `state`) VALUES
(1, 1, 2, 1, 333.00, 3),
(2, 2, 4, 1, 21.00, 2),
(3, 2, 3, 1, 23.00, 2),
(4, 2, 5, 1, 131.00, 1),
(5, 3, 6, 1, 123.00, 2),
(6, 4, 1, 1, 32423.00, 1),
(7, 5, 7, 1, 21.00, 3),
(8, 6, 8, 1, 1312.00, 1),
(9, 7, 10, 1, 12321.00, 1),
(10, 8, 11, 1, 312.00, 1),
(11, 9, 19, 1, 2.00, 1),
(12, 10, 16, 1, 2.00, 3);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `author` varchar(255) DEFAULT NULL,
  `type` varchar(255) DEFAULT NULL,
  `publication_year` year(4) DEFAULT NULL,
  `page_count` int(11) DEFAULT NULL,
  `price` decimal(10,2) NOT NULL,
  `is_sold` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `image` longblob DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Tablo döküm verisi `products`
--

INSERT INTO `products` (`id`, `name`, `description`, `author`, `type`, `publication_year`, `page_count`, `price`, `is_sold`, `created_at`, `updated_at`, `image`) VALUES
(1, 'qeq', 'rwerwe', NULL, NULL, NULL, NULL, 32423.00, 1, '2025-05-26 05:01:42', '2025-05-27 15:24:06', 0x696d616765732f313734383234363530322e706e67),
(2, 'qeq', 'asdasd', NULL, NULL, NULL, NULL, 333.00, 1, '2025-05-26 07:15:09', '2025-05-26 07:16:53', 0x696d616765732f313734383235343530392e706e67),
(3, 'wqeq', 'fasdas', NULL, NULL, NULL, NULL, 23.00, 1, '2025-05-26 07:34:40', '2025-05-27 15:09:28', 0x696d616765732f313734383235353638302e706e67),
(4, 'qweqwe', 'fsfsf', 'qweqe', 'qe4234', '2023', 213, 21.00, 1, '2025-05-26 08:00:01', '2025-05-27 15:09:28', 0x696d616765732f313734383235373230312e706e67),
(5, 'fs', 'sdsf', 'sfsfs', 'qe41', '2022', 123, 131.00, 1, '2025-05-26 08:16:42', '2025-05-27 15:09:28', 0x696d616765732f313734383235383230322e706e67),
(6, 'rwer', 'asdsada', 'qweqe', 'dasd', '2025', 132, 123.00, 1, '2025-05-26 09:29:24', '2025-05-27 15:22:16', 0x696d616765732f313734383236323536342e706e67),
(7, 'Suç ve Ceza - Fyodor Dostoyevski', 'bfbdfb', 'ddgdfgd', 'sdfsf', '2022', 124, 21.00, 1, '2025-05-27 15:26:09', '2025-05-27 15:26:53', 0x696d616765732f313734383337303336392e706e67),
(8, 'qeq', '1dasdasd', 'ddgdfgd', 'sdfsf', '2022', 123, 1312.00, 1, '2025-05-27 15:41:30', '2025-05-27 15:56:52', 0x73746f726167652f696d616765732f6f726634636f6653483938694344414f484f4357524c717541564a51743171594a424b47706c4f4a2e706e67),
(10, 'rwr', 'qweq', 'werw', '24', '2023', 432, 12321.00, 1, '2025-05-27 16:09:10', '2025-05-27 16:15:36', 0x73746f726167652f696d616765732f335166346c5a4a614955694c5075383650317856785657356330686977714c7842315155424463702e706e67),
(11, '32', '13', 'ddgdfgd', '123', '2022', 13, 312.00, 1, '2025-05-27 17:40:33', '2025-05-27 17:55:43', 0x696d616765732f313734383337383433322e706e67),
(16, '2', '2', '2', '2', '2022', 2, 2.00, 1, '2025-05-28 04:12:44', '2025-05-29 11:17:27', 0x696d616765732f313734383431363336342e706e67),
(19, '2', '2', '2', '2', '2022', 2, 2.00, 1, '2025-05-28 04:18:34', '2025-05-28 04:23:13', 0x696d616765732f313734383431363731342e706e67),
(22, 'Kürk Mantolu Madonna', 'Aradaki bütün bağlar, ruhlar beraber olmadıktan sonra, ne ifade ederler? Senelerden beri hiç kimseye bir tek kelime söylemedim. Hâlbuki konuşmaya ne kadar muhtacım. Her şeyi içinde boğmaya mecbur olmak, diri diri mezara kapanmaktan başka nedir?', 'Sabahattin Ali', 'Dram', '2022', 254, 60.00, 0, '2025-06-03 04:15:36', '2025-06-03 04:15:36', 0x696d616765732f313734383933343933362e6a7067),
(23, 'Atomik Alışkanlıklar', 'Atomik Alışkanlıklar size alışkanlıklarınızdan zarar değil, fayda göreceğiniz şekilde hayatınızı yeniden tasarlamayı öğretecek.Hedefleriniz ne olursa olsun, Atomik Alışkanlıklar size her geçen gün %1 daha iyiye gitmeniz için etkisi kanıtlanmış bir çerçeve sunuyor.', 'James Clear', 'Kişisel Gelişim', '2021', 356, 250.00, 0, '2025-06-03 04:17:34', '2025-06-03 04:17:34', 0x696d616765732f313734383933353035342e6a7067),
(24, 'Martin Eden', 'Martin Eden, Jack London’ın yarı otobiyografik romanıdır ve yazar olmaya çalışan genç işçi Martin Eden’i konu almaktadır. 20. yüzyılın başlarında Oakland’da yaşayan Martin Eden, bir burjuva ailesinden olan Ruth Morse’a âşıktır ve işçi sınıfının yaşam şartlarından kurtularak elit kesim arasına girmeye çalışmaktadır.', 'Jack London', 'Dram', '2020', 520, 100.00, 0, '2025-06-03 04:19:06', '2025-06-03 04:19:06', 0x696d616765732f313734383933353134362e706e67),
(25, 'Ben Kirke', 'Ben, Helios’un kızı, Aiaie Cadısı Kirke. Hayatım boyunca trajedinin beni bulmasını bekledim. Bulacağından hiç kuşkum yoktu çünkü başkalarının hak ettiğimi düşündüğünden daha fazla arzum, isyanım ve gücüm vardı, yıldırımları üstüne çekecek şeylerdi bunlar. Ve bir gün, artık bu dünyaya dayanamayacağım, diye düşündüm.Bunun üzerine denizin derinliklerindeki kadim bir tanrı seslendi: Öyleyse çocuğum, başka bir dünya yap.', 'Madeline Miller', 'Mitoloji', '2019', 401, 190.00, 0, '2025-06-03 04:20:42', '2025-06-03 04:20:42', 0x696d616765732f313734383933353234322e6a7067),
(26, 'Bir İdam Mahkumunun Son Günü', 'Bir İdam Mahkumunun Son Günü kitabı, Romantizmin temsilcilerinden olan Fransız şair, romancı ve oyun yazarı Victor Hugo tarafından henüz 26 yaşındayken kaleme alınmıştır ve 1829 yılında yayımlanmıştır. Yazar eserinde kamu vicdanını etkilemeyi ve idam cezasına karşı bir protesto hareketi başlatmayı amaçlamıştır. Eser yazıldığı dönemde büyük ses getirmiş ve idam cezasının kaldırılması için tartışılmaların başlamasına neden olmuştur.', 'Victor Hugo', 'Dram', '2024', 80, 50.00, 0, '2025-06-03 04:22:11', '2025-06-03 04:22:11', 0x696d616765732f313734383933353333302e6a7067),
(27, 'Çalıkuşu', 'Romancı, oyun yazarı İstanbul´da doğdu. Çanakkale Lisesinde okudu. yüksek öğrenimini tamamladıktan sonra Bursa ve İstanbul Liselerinde edebiyat, felsefe, pedagoji öğretmenliği ve müdürlük görevlerinde bulundu. Milli Eğitim Müfettişliği, Paris Kültür Ateşeliği yaptı. UNESCO´da Türkiye´yi temsil etti. Romanları, hikayeleri, tiyatro eserlerinin yanı sıra çeşitli çevirileri de vardır.', 'Reşat Nuri Güntekin', 'Dram', '2018', 205, 200.00, 0, '2025-06-03 04:23:29', '2025-06-03 04:23:29', 0x696d616765732f313734383933353430392e6a7067);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('user','admin') NOT NULL DEFAULT 'user',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `address` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Tablo döküm verisi `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `role`, `created_at`, `updated_at`, `remember_token`, `address`) VALUES
(7, 'Test admin', 'admin@example.com', '$2y$12$2CNbfO50czUPKbOjBnlpP.jF6sxv.cYFCqg6HOK/dGiGcwWCQzzR2', 'admin', '2025-05-26 07:11:35', '2025-05-26 07:11:35', 'c8Xi9SdrRHoNPkSEhNrba1K4jjAFNvCGwFnFHENbw2dKz2TD83wNplOaHy0O', NULL),
(8, 'Admin Two', 'admin2@example.com', '$2y$12$QwlziKCQVcPgCafU9/02SejcsnfgGaZDl0IXaTmSUunXpzQaVSD3O', 'admin', '2025-05-26 07:11:36', '2025-05-26 07:11:36', NULL, NULL),
(9, 'Admin Three', 'admin3@example.com', '$2y$12$L/EdYLfapgSYabG9cfeSIuYeaZdutgiZZ.UuWUac3pAcTLEGlPHy2', 'admin', '2025-05-26 07:11:36', '2025-05-26 07:11:36', NULL, NULL),
(10, 'Test user', 'user@example.com', '$2y$12$1kaSS8bGKUTCk5qA/vjrRut28.p0SY5UhUCDGGkBUJkkYA9UGDVNq', 'user', '2025-05-26 07:11:36', '2025-05-26 07:16:40', 'maFdGZY9DWnsHwfDaXPXDtMGmq4vPWwgZC5viwuNKbYeHKjKs7ygyEN52FsW', 'dsasdad'),
(11, 'nagihan üstün', 'nagi@gmail.com', '$2y$12$fF9sJHkn17TwBfruSHubheQhngfrjcMAWlKnS8xfSO38CvORsL54.', 'user', '2025-05-27 15:03:30', '2025-05-27 15:09:18', NULL, 'eojffkdsnfklndf');

--
-- Dökümü yapılmış tablolar için indeksler
--

--
-- Tablo için indeksler `carts`
--
ALTER TABLE `carts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `carts_user_id_foreign` (`user_id`),
  ADD KEY `carts_product_id_foreign` (`product_id`);

--
-- Tablo için indeksler `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `orders_user_id_foreign` (`user_id`);

--
-- Tablo için indeksler `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_items_order_id_foreign` (`order_id`),
  ADD KEY `order_items_product_id_foreign` (`product_id`);

--
-- Tablo için indeksler `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Dökümü yapılmış tablolar için AUTO_INCREMENT değeri
--

--
-- Tablo için AUTO_INCREMENT değeri `carts`
--
ALTER TABLE `carts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- Tablo için AUTO_INCREMENT değeri `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Tablo için AUTO_INCREMENT değeri `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Tablo için AUTO_INCREMENT değeri `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Tablo için AUTO_INCREMENT değeri `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- Tablo için AUTO_INCREMENT değeri `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Dökümü yapılmış tablolar için kısıtlamalar
--

--
-- Tablo kısıtlamaları `carts`
--
ALTER TABLE `carts`
  ADD CONSTRAINT `carts_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `carts_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Tablo kısıtlamaları `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Tablo kısıtlamaları `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `order_items_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `order_items_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
