-- MySQL dump 10.13  Distrib 8.0.41, for Win64 (x86_64)
--
-- Host: localhost    Database: phoneshop1
-- ------------------------------------------------------
-- Server version	5.5.5-10.4.32-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `cache`
--

DROP TABLE IF EXISTS `cache`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` bigint(20) NOT NULL,
  PRIMARY KEY (`key`),
  KEY `cache_expiration_index` (`expiration`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cache`
--

LOCK TABLES `cache` WRITE;
/*!40000 ALTER TABLE `cache` DISABLE KEYS */;
/*!40000 ALTER TABLE `cache` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cache_locks`
--

DROP TABLE IF EXISTS `cache_locks`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` bigint(20) NOT NULL,
  PRIMARY KEY (`key`),
  KEY `cache_locks_expiration_index` (`expiration`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cache_locks`
--

LOCK TABLES `cache_locks` WRITE;
/*!40000 ALTER TABLE `cache_locks` DISABLE KEYS */;
/*!40000 ALTER TABLE `cache_locks` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `categories`
--

DROP TABLE IF EXISTS `categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `categories` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `categories_slug_unique` (`slug`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categories`
--

LOCK TABLES `categories` WRITE;
/*!40000 ALTER TABLE `categories` DISABLE KEYS */;
INSERT INTO `categories` VALUES (1,'iPhone','iphone','Điện thoại Apple iPhone - Hệ điều hành iOS cao cấp','2026-04-27 18:14:08','2026-04-27 18:14:08'),(2,'Samsung','samsung','Điện thoại Samsung Galaxy - Công nghệ màn hình AMOLED hàng đầu','2026-04-27 18:14:08','2026-04-27 18:14:08'),(3,'Xiaomi','xiaomi','Điện thoại Xiaomi - Hiệu năng cao, giá hợp lý','2026-04-27 18:14:08','2026-04-27 18:14:08'),(4,'OPPO','oppo','Điện thoại OPPO - Camera selfie ấn tượng','2026-04-27 18:14:08','2026-04-27 18:14:08'),(5,'Vivo','vivo','Điện thoại Vivo - Thiết kế thời trang, camera AI','2026-04-27 18:14:08','2026-04-27 18:14:08'),(6,'Realme','realme','Điện thoại Realme - Hiệu năng mạnh mẽ, giá sinh viên','2026-04-27 18:14:08','2026-04-27 18:14:08');
/*!40000 ALTER TABLE `categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `failed_jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `failed_jobs`
--

LOCK TABLES `failed_jobs` WRITE;
/*!40000 ALTER TABLE `failed_jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `failed_jobs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `job_batches`
--

DROP TABLE IF EXISTS `job_batches`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
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
  `finished_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `job_batches`
--

LOCK TABLES `job_batches` WRITE;
/*!40000 ALTER TABLE `job_batches` DISABLE KEYS */;
/*!40000 ALTER TABLE `job_batches` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jobs`
--

DROP TABLE IF EXISTS `jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` smallint(5) unsigned NOT NULL,
  `reserved_at` int(10) unsigned DEFAULT NULL,
  `available_at` int(10) unsigned NOT NULL,
  `created_at` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `jobs_queue_index` (`queue`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jobs`
--

LOCK TABLES `jobs` WRITE;
/*!40000 ALTER TABLE `jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `jobs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'0001_01_01_000000_create_users_table',1),(2,'0001_01_01_000001_create_cache_table',1),(3,'0001_01_01_000002_create_jobs_table',1),(4,'2024_01_01_000010_create_categories_table',1),(5,'2024_01_01_000011_create_products_table',1),(6,'2024_01_01_000012_create_orders_table',1),(7,'2024_01_01_000013_create_order_items_table',1);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `order_items`
--

DROP TABLE IF EXISTS `order_items`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `order_items` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `order_id` bigint(20) unsigned NOT NULL,
  `product_id` bigint(20) unsigned NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` decimal(15,0) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `order_items_order_id_foreign` (`order_id`),
  KEY `order_items_product_id_foreign` (`product_id`),
  CONSTRAINT `order_items_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE,
  CONSTRAINT `order_items_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `order_items`
--

LOCK TABLES `order_items` WRITE;
/*!40000 ALTER TABLE `order_items` DISABLE KEYS */;
/*!40000 ALTER TABLE `order_items` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `orders`
--

DROP TABLE IF EXISTS `orders`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `orders` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned NOT NULL,
  `customer_name` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `address` text NOT NULL,
  `note` text DEFAULT NULL,
  `total_price` decimal(15,0) NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'pending',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `orders_user_id_foreign` (`user_id`),
  CONSTRAINT `orders_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `orders`
--

LOCK TABLES `orders` WRITE;
/*!40000 ALTER TABLE `orders` DISABLE KEYS */;
/*!40000 ALTER TABLE `orders` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_reset_tokens`
--

DROP TABLE IF EXISTS `password_reset_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_reset_tokens`
--

LOCK TABLES `password_reset_tokens` WRITE;
/*!40000 ALTER TABLE `password_reset_tokens` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_reset_tokens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `products`
--

DROP TABLE IF EXISTS `products`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `products` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `category_id` bigint(20) unsigned NOT NULL,
  `name` varchar(255) NOT NULL,
  `brand` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `price` decimal(15,0) NOT NULL,
  `quantity` int(11) NOT NULL DEFAULT 0,
  `description` text DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `screen` varchar(255) DEFAULT NULL,
  `ram` varchar(255) DEFAULT NULL,
  `storage` varchar(255) DEFAULT NULL,
  `camera` varchar(255) DEFAULT NULL,
  `battery` varchar(255) DEFAULT NULL,
  `operating_system` varchar(255) DEFAULT NULL,
  `is_featured` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `products_slug_unique` (`slug`),
  KEY `products_category_id_foreign` (`category_id`),
  CONSTRAINT `products_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `products`
--

LOCK TABLES `products` WRITE;
/*!40000 ALTER TABLE `products` DISABLE KEYS */;
INSERT INTO `products` VALUES (1,1,'iPhone 15 Pro Max 256GB','Apple','iphone-15-pro-max-256gb-5628',34990000,25,'iPhone 15 Pro Max với chip A17 Pro mạnh mẽ nhất từ trước đến nay, màn hình Super Retina XDR 6.7 inch, hệ thống camera Pro với khả năng quay 4K ProRes. Thiết kế titan nhẹ và bền, cổng USB-C hỗ trợ USB 3.','https://images.unsplash.com/photo-1695048133142-1a20484d2569?auto=format&fit=crop&w=800&q=85','6.7 inch Super Retina XDR OLED, 120Hz ProMotion','8GB','256GB','48MP Main + 12MP Ultrawide + 12MP 5x Telephoto','4422mAh, sạc MagSafe 15W','iOS 17',1,'2026-04-27 18:14:08','2026-04-27 18:14:33'),(2,1,'iPhone 15 128GB','Apple','iphone-15-128gb-8585',22990000,30,'iPhone 15 với chip A16 Bionic, màn hình Dynamic Island 6.1 inch, camera 48MP chụp ảnh sắc nét. Cổng USB-C tiện lợi, sạc nhanh hơn.','https://images.unsplash.com/photo-1630569261946-6a9c6c574049?auto=format&fit=crop&w=800&q=85','6.1 inch Super Retina XDR OLED','6GB','128GB','48MP Main + 12MP Ultrawide','3877mAh','iOS 17',1,'2026-04-27 18:14:08','2026-04-27 18:14:33'),(3,1,'iPhone 14 128GB','Apple','iphone-14-128gb-8321',17490000,20,'iPhone 14 với chip A15 Bionic mạnh mẽ, camera 12MP cải tiến với chế độ Action Mode, phát hiện va chạm và SOS khẩn cấp qua vệ tinh.','https://images.unsplash.com/photo-1601784551446-20c9e07cdbdb?auto=format&fit=crop&w=800&q=85','6.1 inch Super Retina XDR OLED','6GB','128GB','12MP Main + 12MP Ultrawide','3279mAh','iOS 17',0,'2026-04-27 18:14:08','2026-04-27 18:14:33'),(4,2,'Samsung Galaxy S24 Ultra 256GB','Samsung','samsung-galaxy-s24-ultra-256gb-8123',31990000,15,'Galaxy S24 Ultra với bút S Pen tích hợp, chip Snapdragon 8 Gen 3, màn hình Dynamic AMOLED 2X 6.8 inch, camera 200MP siêu zoom 10x quang học.','https://images.unsplash.com/photo-1610945415295-d9bbf067e59c?auto=format&fit=crop&w=800&q=85','6.8 inch Dynamic AMOLED 2X, 120Hz','12GB','256GB','200MP + 12MP + 50MP + 10MP','5000mAh, sạc 45W','Android 14, One UI 6.1',1,'2026-04-27 18:14:08','2026-04-27 18:14:33'),(5,2,'Samsung Galaxy A55 5G 256GB','Samsung','samsung-galaxy-a55-5g-256gb-6219',10490000,35,'Galaxy A55 5G với chip Exynos 1480, màn hình Super AMOLED 6.6 inch, camera 50MP OIS, pin 5000mAh sạc nhanh 45W. Thiết kế đẹp, vỏ nhôm premium.','https://images.unsplash.com/photo-1598327105854-c8674faddf79?auto=format&fit=crop&w=800&q=85','6.6 inch Super AMOLED, 120Hz','8GB','256GB','50MP OIS + 12MP + 5MP','5000mAh, sạc 45W','Android 14, One UI 6.1',1,'2026-04-27 18:14:08','2026-04-27 18:14:33'),(6,2,'Samsung Galaxy S23 FE 128GB','Samsung','samsung-galaxy-s23-fe-128gb-5683',9990000,22,'Galaxy S23 FE Fan Edition - phiên bản giá rẻ hơn của S23, vẫn trang bị chip Exynos 2200, camera 50MP, màn hình AMOLED 120Hz.','https://images.unsplash.com/photo-1580910051074-3eb694886505?auto=format&fit=crop&w=800&q=85','6.4 inch Dynamic AMOLED 2X, 120Hz','8GB','128GB','50MP OIS + 12MP + 8MP','4500mAh, sạc 25W','Android 14, One UI 6.1',0,'2026-04-27 18:14:08','2026-04-27 18:14:33'),(7,3,'Xiaomi 14 Ultra 512GB','Xiaomi','xiaomi-14-ultra-512gb-3382',29990000,10,'Xiaomi 14 Ultra với hệ thống camera Leica, chip Snapdragon 8 Gen 3, màn hình AMOLED 6.73 inch 120Hz. Camera chính 50MP với ống kính biến tiêu 1-inch.','https://images.unsplash.com/photo-1574944985070-8f3ebc6b79d2?auto=format&fit=crop&w=800&q=85','6.73 inch AMOLED, 120Hz','16GB','512GB','50MP Leica + 50MP + 50MP + 50MP','5000mAh, sạc 90W','Android 14, MIUI 15',1,'2026-04-27 18:14:08','2026-04-27 18:14:33'),(8,3,'Xiaomi Redmi Note 13 Pro 256GB','Xiaomi','xiaomi-redmi-note-13-pro-256gb-2958',7490000,40,'Redmi Note 13 Pro với camera 200MP đỉnh cao phân khúc tầm trung, chip Snapdragon 7s Gen 2, màn hình AMOLED 6.67 inch 120Hz, pin 5100mAh sạc 67W.','https://images.unsplash.com/photo-1511707171634-5f897ff02aa9?auto=format&fit=crop&w=800&q=85','6.67 inch AMOLED, 120Hz','8GB','256GB','200MP + 8MP + 2MP','5100mAh, sạc 67W','Android 13, MIUI 14',0,'2026-04-27 18:14:08','2026-04-27 18:14:33'),(9,4,'OPPO Find X7 Ultra 256GB','OPPO','oppo-find-x7-ultra-256gb-3809',27990000,8,'OPPO Find X7 Ultra với hệ thống camera Hasselblad, chip Dimensity 9300, màn hình AMOLED 6.82 inch, sạc nhanh 100W và sạc không dây 50W.','https://images.unsplash.com/photo-1596742578443-7682ef5251cd?auto=format&fit=crop&w=800&q=85','6.82 inch AMOLED 4K, 120Hz','16GB','256GB','50MP + 50MP + 50MP + 64MP Periscope','5000mAh, sạc 100W','Android 14, ColorOS 14',1,'2026-04-27 18:14:08','2026-04-27 18:14:33'),(10,4,'OPPO Reno 11 5G 256GB','OPPO','oppo-reno-11-5g-256gb-2815',10990000,28,'OPPO Reno 11 5G với thiết kế mỏng nhẹ, chip MediaTek Dimensity 7050, camera 50MP OIS, pin 4800mAh sạc siêu nhanh 67W.','https://images.unsplash.com/photo-1565849904461-04a58ad377e0?auto=format&fit=crop&w=800&q=85','6.7 inch AMOLED, 120Hz','8GB','256GB','50MP OIS + 8MP + 2MP','4800mAh, sạc 67W','Android 14, ColorOS 14',0,'2026-04-27 18:14:08','2026-04-27 18:14:33'),(11,5,'Vivo X100 Pro 256GB','Vivo','vivo-x100-pro-256gb-8886',25990000,12,'Vivo X100 Pro với hệ thống camera Zeiss, chip Dimensity 9300, màn hình LTPO AMOLED 6.78 inch, sạc nhanh V2 chip 100W.','https://images.unsplash.com/photo-1510557880182-3d4d3cba35a5?auto=format&fit=crop&w=800&q=85','6.78 inch LTPO AMOLED, 120Hz','12GB','256GB','50MP Zeiss + 50MP + 64MP Periscope','5400mAh, sạc 100W','Android 14, Funtouch OS 14',1,'2026-04-27 18:14:08','2026-04-27 18:14:33'),(12,6,'Realme GT 5 Pro 512GB','Realme','realme-gt-5-pro-512gb-2178',16990000,18,'Realme GT 5 Pro flagship với chip Snapdragon 8 Gen 3, màn hình LTPO AMOLED 6.78 inch, camera 50MP Sony IMX890, sạc siêu nhanh 100W.','https://images.unsplash.com/photo-1592750475338-74b7b21085ab?auto=format&fit=crop&w=800&q=85','6.78 inch LTPO AMOLED, 144Hz','16GB','512GB','50MP Sony + 50MP Periscope + 8MP','5400mAh, sạc 100W','Android 14, Realme UI 5.0',0,'2026-04-27 18:14:08','2026-04-27 18:14:33'),(13,6,'Realme C67 4G 128GB','Realme','realme-c67-4g-128gb-9592',4490000,50,'Realme C67 - điện thoại tầm trung thấp giá rẻ phù hợp sinh viên. Chip Snapdragon 685, màn hình IPS LCD 6.72 inch 90Hz, camera 108MP, pin 5000mAh sạc 33W.','https://images.unsplash.com/photo-1551006917-3b4c078c47c9?auto=format&fit=crop&w=800&q=85','6.72 inch IPS LCD, 90Hz','6GB','128GB','108MP + 2MP','5000mAh, sạc 33W','Android 13, Realme UI R Edition',0,'2026-04-27 18:14:08','2026-04-27 18:14:33');
/*!40000 ALTER TABLE `products` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sessions`
--

DROP TABLE IF EXISTS `sessions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) unsigned DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sessions_user_id_index` (`user_id`),
  KEY `sessions_last_activity_index` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sessions`
--

LOCK TABLES `sessions` WRITE;
/*!40000 ALTER TABLE `sessions` DISABLE KEYS */;
/*!40000 ALTER TABLE `sessions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(255) NOT NULL DEFAULT 'user',
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'Admin PhoneShop','admin@phoneshop.vn',NULL,'$2y$12$Jwatv5pbZi0RfCtZMU0q/e2PxyyLNXNtsbAInrGWCr/WJpOyeJRcK','admin',NULL,'2026-04-27 18:14:06','2026-04-27 18:14:06'),(2,'Nguyễn Văn An','user@phoneshop.vn',NULL,'$2y$12$lX0tE5gIYI.Wxxc.1GuWluGL6QjewMRa.RDChNCpZI/WycuKrWQ.q','user',NULL,'2026-04-27 18:14:07','2026-04-27 18:14:07'),(3,'Trần Thị Bình','binh@example.com',NULL,'$2y$12$.kX9vobCO2QmtlgQdfkw8umHYO.aEEVGD43yfI.FQcBG0z7Fai9cy','user',NULL,'2026-04-27 18:14:07','2026-04-27 18:14:07'),(4,'Lê Văn Cường','cuong@example.com',NULL,'$2y$12$eW0Wrh1Hk/k9zuu05/0DGO22Dbuh.WkMTidbm.ss4TPJMKQSQg8Ry','user',NULL,'2026-04-27 18:14:07','2026-04-27 18:14:07'),(5,'Phạm Thị Dung','dung@example.com',NULL,'$2y$12$S7Xhz3a/lsWFq18yRqJJ1Ong/v7Dp3aknsUFlU1Euk9g4BIZxqdRe','user',NULL,'2026-04-27 18:14:08','2026-04-27 18:14:08');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2026-04-28  9:02:19
