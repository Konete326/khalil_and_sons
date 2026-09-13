-- MariaDB dump 10.19  Distrib 10.4.32-MariaDB, for Win64 (AMD64)
--
-- Host: localhost    Database: khalil_and_sons
-- ------------------------------------------------------
-- Server version	10.4.32-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
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
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL,
  PRIMARY KEY (`key`),
  KEY `cache_expiration_index` (`expiration`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cache`
--

LOCK TABLES `cache` WRITE;
/*!40000 ALTER TABLE `cache` DISABLE KEYS */;
INSERT INTO `cache` VALUES ('laravel-cache-tripo_sim_1d46fd30a216','a:2:{s:10:\"created_at\";i:1789337730;s:4:\"step\";i:1;}',1789341330),('laravel-cache-tripo_sim_3444d4da1565','a:2:{s:10:\"created_at\";i:1789339320;s:4:\"step\";i:3;}',1789342925),('laravel-cache-tripo_sim_868a979288fe','a:2:{s:10:\"created_at\";i:1789337696;s:4:\"step\";i:1;}',1789341296);
/*!40000 ALTER TABLE `cache` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cache_locks`
--

DROP TABLE IF EXISTS `cache_locks`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL,
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
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `categories` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `image_path` varchar(255) DEFAULT NULL,
  `sort_order` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `categories_slug_unique` (`slug`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categories`
--

LOCK TABLES `categories` WRITE;
/*!40000 ALTER TABLE `categories` DISABLE KEYS */;
INSERT INTO `categories` VALUES (1,'Bridal Suites','bridal-suites','Generational wedding sets crafted in royal 22K gold with precious stones and heirloom polki.','/assets/categories/bridal-suites.jpg',1,'2026-09-13 15:09:05','2026-09-13 15:09:05'),(2,'Chokers & Necklaces','chokers-necklaces','Intricate Mughal gulubands, regal collars, and hand-carved filigree neckwear.','/assets/categories/chokers.jpg',2,'2026-09-13 15:09:05','2026-09-13 15:09:05'),(3,'Bangles & Kadas','bangles-kadas','Solid 22K hallmark-certified traditional kadas, bridal bangles, and pacchi work pairs.','/assets/categories/kadas.jpg',3,'2026-09-13 15:09:05','2026-09-13 15:09:05'),(4,'Polki Rings','polki-rings','Bespoke uncut diamond solitaires and heritage cocktail rings with enamel meenakari.','/assets/categories/rings.jpg',4,'2026-09-13 15:09:05','2026-09-13 15:09:05'),(5,'Heritage Jhumkas','heritage-jhumkas','Classic Karachi Sarafa chandeliers, multi-tier gold jhumkis, and pearl drop earrings.','/assets/categories/jhumkas.jpg',5,'2026-09-13 15:09:05','2026-09-13 15:09:05');
/*!40000 ALTER TABLE `categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `currencies`
--

DROP TABLE IF EXISTS `currencies`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `currencies` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `code` char(3) NOT NULL,
  `name` varchar(255) NOT NULL,
  `symbol` varchar(5) NOT NULL,
  `exchange_rate_to_pkr` decimal(10,4) NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `currencies_code_unique` (`code`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `currencies`
--

LOCK TABLES `currencies` WRITE;
/*!40000 ALTER TABLE `currencies` DISABLE KEYS */;
INSERT INTO `currencies` VALUES (1,'PKR','Pakistani Rupee','Rs',1.0000,1,'2026-09-13 15:09:05','2026-09-13 15:09:05'),(2,'USD','US Dollar','$',278.5000,1,'2026-09-13 15:09:05','2026-09-13 15:09:05'),(3,'AED','UAE Dirham','AED',75.8500,1,'2026-09-13 15:09:05','2026-09-13 15:09:05'),(4,'SAR','Saudi Riyal','SAR',74.2500,1,'2026-09-13 15:09:05','2026-09-13 15:09:05'),(5,'GBP','British Pound','£',365.2000,1,'2026-09-13 15:09:05','2026-09-13 15:09:05');
/*!40000 ALTER TABLE `currencies` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `custom_orders`
--

DROP TABLE IF EXISTS `custom_orders`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `custom_orders` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `tracking_code` varchar(255) NOT NULL,
  `customer_name` varchar(255) NOT NULL,
  `customer_phone` varchar(255) NOT NULL,
  `customer_email` varchar(255) DEFAULT NULL,
  `original_image_path` varchar(255) NOT NULL,
  `model_3d_url` varchar(255) DEFAULT NULL,
  `karat` varchar(255) NOT NULL,
  `target_weight_grams` decimal(8,3) DEFAULT NULL,
  `estimated_budget` decimal(12,2) NOT NULL,
  `provides_own_gold` tinyint(1) NOT NULL DEFAULT 0,
  `customer_gold_weight` decimal(8,3) DEFAULT NULL,
  `design_token_paid` decimal(10,2) NOT NULL DEFAULT 0.00,
  `payment_status` enum('pending','slip_uploaded','verified','rejected') NOT NULL DEFAULT 'pending',
  `manufacturing_status` enum('inquiry','in_workshop','ready_for_dispatch','completed') NOT NULL DEFAULT 'inquiry',
  `payment_slip_path` varchar(255) DEFAULT NULL,
  `notes` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `custom_orders_tracking_code_unique` (`tracking_code`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `custom_orders`
--

LOCK TABLES `custom_orders` WRITE;
/*!40000 ALTER TABLE `custom_orders` DISABLE KEYS */;
INSERT INTO `custom_orders` VALUES (2,'KS-ORD-LZ12K5','Mrs. Farzana Tariq','+92 321 8291024','farzana@example.com','/assets/products/choker-ruby-01.jpg','/assets/models/bridal-choker.glb','22K',30.500,1100000.00,0,0.000,0.00,'pending','inquiry',NULL,'Custom Saddar bridal suite matching wedding lehenga.','2026-09-13 17:14:57','2026-09-13 17:14:57'),(3,'KS-ORD-LJ7PLF','Mrs. Farzana Tariq','+92 321 8291024','farzana@example.com','/assets/products/choker-ruby-01.jpg','/assets/models/bridal-choker.glb','22K',30.500,1100000.00,0,0.000,0.00,'slip_uploaded','inquiry','/assets/slips/slip_KS-ORD-LJ7PLF_1789337731.jpg','Custom Saddar bridal suite matching wedding lehenga.','2026-09-13 17:15:30','2026-09-13 17:15:31'),(4,'KS-ADMIN-TEST','Farhan Akhtar (Karachi)','03001234567','farhan@example.com','/assets/images/bridal_choker.jpg',NULL,'22K',18.500,450000.00,0,NULL,0.00,'verified','ready_for_dispatch','/assets/slips/test_sample_slip.jpg',NULL,'2026-09-13 17:26:06','2026-09-13 17:27:19');
/*!40000 ALTER TABLE `custom_orders` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
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
-- Table structure for table `gold_rates`
--

DROP TABLE IF EXISTS `gold_rates`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `gold_rates` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `karat` varchar(20) NOT NULL,
  `rate_per_gram` decimal(10,2) NOT NULL,
  `rate_per_tola` decimal(10,2) NOT NULL,
  `effective_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `gold_rates`
--

LOCK TABLES `gold_rates` WRITE;
/*!40000 ALTER TABLE `gold_rates` DISABLE KEYS */;
INSERT INTO `gold_rates` VALUES (1,'24K',24434.58,285000.00,'2026-09-13 17:27:17',1,'2026-09-13 15:09:05','2026-09-13 17:27:17'),(2,'22K',35365.66,412498.01,'2026-09-13 17:10:28',1,'2026-09-13 15:09:05','2026-09-13 17:10:30'),(3,'21K',33758.13,393748.10,'2026-09-13 17:10:28',1,'2026-09-13 15:09:05','2026-09-13 17:10:30'),(4,'18K',28935.54,337498.37,'2026-09-13 17:10:28',1,'2026-09-13 15:09:05','2026-09-13 17:10:30'),(5,'SILVER',568.51,6631.04,'2026-09-13 17:10:28',1,'2026-09-13 17:10:31','2026-09-13 17:10:31');
/*!40000 ALTER TABLE `gold_rates` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `job_batches`
--

DROP TABLE IF EXISTS `job_batches`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
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
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) unsigned NOT NULL,
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
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'0001_01_01_000000_create_users_table',1),(2,'0001_01_01_000001_create_cache_table',1),(3,'0001_01_01_000002_create_jobs_table',1),(4,'2026_09_14_000001_create_gold_rates_table',1),(5,'2026_09_14_000002_create_categories_table',1),(6,'2026_09_14_000003_create_products_table',1),(7,'2026_09_14_000004_create_custom_orders_table',1),(8,'2026_09_14_000005_create_payment_methods_table',1),(9,'2026_09_14_000006_create_currencies_table',1),(10,'2026_09_14_000007_update_gold_rates_table_for_silver',2),(11,'2026_09_14_000008_add_is_admin_and_phone_to_users_table',3);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_reset_tokens`
--

DROP TABLE IF EXISTS `password_reset_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
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
-- Table structure for table `payment_methods`
--

DROP TABLE IF EXISTS `payment_methods`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `payment_methods` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `type` enum('raast','bank_transfer','wise','swift') NOT NULL,
  `title` varchar(255) NOT NULL,
  `account_name` varchar(255) NOT NULL,
  `account_number` varchar(255) NOT NULL,
  `iban` varchar(255) DEFAULT NULL,
  `swift_code` varchar(255) DEFAULT NULL,
  `bank_name` varchar(255) NOT NULL,
  `instructions` text DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `payment_methods`
--

LOCK TABLES `payment_methods` WRITE;
/*!40000 ALTER TABLE `payment_methods` DISABLE KEYS */;
INSERT INTO `payment_methods` VALUES (1,'raast','Raast Instant P2M Settlement','Khalil & Sons Jewellers Saddar','03008241991','PK54MEZN0001020304050607',NULL,'Meezan Bank Limited','State Bank instant settlement with zero transaction charges.',1,'2026-09-13 15:09:05','2026-09-13 17:26:53'),(2,'bank_transfer','Meezan Bank Corporate Account','Khalil & Sons Jewellers PVT LTD','01020304050607','PK54MEZN0001020304050607',NULL,'Meezan Bank Limited (Saddar Flagship Branch)','Transfer to corporate account. Upload digital deposit slip or internet banking receipt.',1,'2026-09-13 15:09:05','2026-09-13 15:09:05'),(3,'swift','Overseas Telegraphic Transfer (SWIFT)','Khalil & Sons Jewellers Private Limited','01020304050607','PK54MEZN0001020304050607','MEZNPKKA','Meezan Bank Limited (Karachi Main)','Direct overseas wire transfer. Ensure beneficiary name and IBAN match exactly.',1,'2026-09-13 15:09:05','2026-09-13 15:09:05'),(4,'wise','Wise International Remittance','Khalil & Sons Atelier','WISE-KS-91024','BE68539007547034',NULL,'Wise Europe SA','For overseas patrons in UK, US, and GCC. Transfer via Wise app with real-time rate.',1,'2026-09-13 15:09:05','2026-09-13 15:09:05');
/*!40000 ALTER TABLE `payment_methods` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `products`
--

DROP TABLE IF EXISTS `products`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `products` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `category_id` bigint(20) unsigned NOT NULL,
  `title` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `karat` varchar(255) NOT NULL,
  `gross_weight_grams` decimal(8,3) NOT NULL,
  `net_gold_weight_grams` decimal(8,3) NOT NULL,
  `making_charges` decimal(10,2) NOT NULL,
  `gemstone_cost` decimal(10,2) NOT NULL DEFAULT 0.00,
  `stone_description` text DEFAULT NULL,
  `images` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`images`)),
  `model_3d_url` varchar(255) DEFAULT NULL,
  `is_featured` tinyint(1) NOT NULL DEFAULT 0,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `products_slug_unique` (`slug`),
  KEY `products_category_id_foreign` (`category_id`),
  CONSTRAINT `products_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `products`
--

LOCK TABLES `products` WRITE;
/*!40000 ALTER TABLE `products` DISABLE KEYS */;
INSERT INTO `products` VALUES (1,1,'Royal Mughal Choker Set 22K with Burmese Rubies','royal-mughal-choker-set-22k-burmese-rubies','22K',85.500,72.200,95000.00,185000.00,'Certified unheated pigeon-blood Burmese rubies and natural Basra seed pearls.','[\"\\/assets\\/products\\/choker-ruby-01.jpg\",\"\\/assets\\/products\\/choker-ruby-02.jpg\"]',NULL,1,1,'2026-09-13 15:09:05','2026-09-13 15:09:05'),(2,3,'Zeenat Uncut Polki Bridal Kada 22K','zeenat-uncut-polki-bridal-kada-22k','22K',54.250,46.800,68000.00,142000.00,'Syndicate uncut polki diamonds set in 24K gold foil with green meenakari back.','[\"\\/assets\\/products\\/kada-polki-01.jpg\"]',NULL,1,1,'2026-09-13 15:09:05','2026-09-13 15:09:05'),(3,5,'Noor-ul-Ain 22K Filigree Chandbali Jhumkas','noor-ul-ain-22k-filigree-chandbali-jhumkas','22K',32.400,30.100,42000.00,35000.00,'Hand-chiseled Karachi filigree drops with natural South Sea baroque pearls.','[\"\\/assets\\/products\\/jhumka-01.jpg\"]',NULL,1,1,'2026-09-13 15:09:05','2026-09-13 15:09:05'),(4,2,'Shahi Kundan Guluband 21K','shahi-kundan-guluband-21k','21K',64.800,58.500,75000.00,92000.00,'Traditional Mughal Jadau setting with brilliant cut polki and emerald drops.','[\"\\/assets\\/products\\/guluband-01.jpg\"]',NULL,1,1,'2026-09-13 15:09:05','2026-09-13 15:09:05'),(5,4,'Koh-i-Noor Royal Polki Cocktail Ring 22K','koh-i-noor-royal-polki-cocktail-ring-22k','22K',18.200,14.900,28000.00,65000.00,'Solitaire uncut diamond polki surrounded by Burmese ruby cabochons.','[\"\\/assets\\/products\\/ring-polki-01.jpg\"]',NULL,1,1,'2026-09-13 15:09:05','2026-09-13 15:09:05'),(6,3,'Dastkari 22K Solid Gold Sada Kada Pair','dastkari-22k-solid-gold-sada-kada-pair','22K',48.500,48.500,48500.00,0.00,'Plain 22K hallmark gold without stones. Hand-chiseled Karachi filigree finish.','[\"\\/assets\\/products\\/kada-plain-01.jpg\"]',NULL,1,1,'2026-09-13 16:26:42','2026-09-13 16:26:42');
/*!40000 ALTER TABLE `products` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `is_admin` tinyint(1) NOT NULL DEFAULT 0,
  `phone` varchar(255) DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'Khalil Ahmed (Master Proprietor)','admin@khaliljewellers.pk',1,'03008241991','2026-09-13 17:44:19','$2y$12$l6fuF0POiwvz78AvX6fjgOJrAat4hkGoHXo/8KYqdhXyJ4j2TepuO',NULL,'2026-09-13 17:20:45','2026-09-13 17:44:19'),(2,'Store Administrator','admin@gmail.com',1,'03008241991','2026-09-13 17:44:18','$2y$12$6ITesvFZOxacZaiMOmyDquQy.vGh8a4K4sgn1hpj3VEJvOYrOjU9O',NULL,'2026-09-13 17:44:18','2026-09-13 17:44:18'),(4,'Farah Naz (Patron)','patron.test@example.com',0,'03009988776',NULL,'$2y$12$hwlyIU38xUs6lxTNO86dq.FAg5N8Jbro0oWPOiJ7ANdj5vJUKM.sK',NULL,'2026-09-13 17:47:15','2026-09-13 17:47:15');
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

-- Dump completed on 2026-09-14  4:00:50
-- MariaDB dump 10.19  Distrib 10.4.32-MariaDB, for Win64 (AMD64)
--
-- Host: localhost    Database: khalil_and_sons
-- ------------------------------------------------------
-- Server version	10.4.32-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `sessions`
--

DROP TABLE IF EXISTS `sessions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
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
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2026-09-14  4:00:49
