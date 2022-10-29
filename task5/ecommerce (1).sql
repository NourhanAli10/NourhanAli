-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 29, 2022 at 07:14 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.0.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ecommerce`
--

-- --------------------------------------------------------

--
-- Table structure for table `addresses`
--

CREATE TABLE `addresses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `street` text NOT NULL,
  `building` varchar(64) NOT NULL,
  `floor` tinyint(125) NOT NULL,
  `flat` bigint(20) NOT NULL,
  `notes` mediumtext DEFAULT NULL,
  `type` varchar(30) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `region_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `addresses`
--

INSERT INTO `addresses` (`id`, `street`, `building`, `floor`, `flat`, `notes`, `type`, `created_at`, `updated_at`, `user_id`, `region_id`) VALUES
(1, 'Abbas El Akad Street ', '5', 6, 7, NULL, 'home', '2022-10-25 22:59:12', NULL, 37, 2),
(2, 'Abd elsalam Araf street', '10', 9, 15, NULL, 'work', '2022-10-25 22:59:12', NULL, 35, 1),
(3, ' el nail street', '4', 2, 2, NULL, '', '2022-10-25 22:59:43', NULL, 36, 3);

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(32) NOT NULL,
  `email` varchar(64) NOT NULL,
  `password` varchar(128) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `verification_code` int(6) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `brands`
--

CREATE TABLE `brands` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name_ar` varchar(32) NOT NULL,
  `name_en` varchar(32) NOT NULL,
  `image` varchar(64) DEFAULT 'default.jpg',
  `status` tinyint(1) DEFAULT 1 COMMENT '1=>ACTIVE , 0=>BLOCKED',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `brands`
--

INSERT INTO `brands` (`id`, `name_ar`, `name_en`, `image`, `status`, `created_at`, `updated_at`) VALUES
(1, 'نوكيا', 'Nokia', 'nokia-logo-RCH7N4.jpg', 1, '2022-10-19 18:24:16', '2022-10-23 20:23:59'),
(2, 'سامسونج', 'samsung', 'Samsung.jpg', 1, '2022-10-19 18:24:16', '2022-10-23 20:18:48'),
(3, 'اوبو', 'oppo', 'oppo.jpg', 1, '2022-10-19 18:24:45', '2022-10-23 20:19:05'),
(4, 'أبل', 'Apple', 'apple.jpg', 1, '2022-10-19 18:24:45', '2022-10-23 20:19:19'),
(5, 'تولو', 'TOLO', 'Tolo(1).jpg', 1, '2022-10-22 19:03:11', '2022-10-23 20:20:37'),
(6, 'ديل', 'dell', 'dell.jpg', 1, '2022-10-22 19:34:39', '2022-10-23 20:21:11'),
(7, 'اتش بي', 'HP', 'hp.jpg', 1, '2022-10-22 19:34:51', '2022-10-23 20:21:56'),
(8, 'أل جى', 'LG', 'Color-LG-Logo.jpg', 1, '2022-10-22 20:27:44', '2022-10-23 20:23:00');

-- --------------------------------------------------------

--
-- Table structure for table `carts`
--

CREATE TABLE `carts` (
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `value` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name_ar` varchar(32) NOT NULL,
  `name_en` varchar(32) NOT NULL,
  `image` varchar(64) DEFAULT 'default.jpg',
  `status` tinyint(1) DEFAULT 1 COMMENT '1=>ACTIVE , 0=>BLOCKED',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name_ar`, `name_en`, `image`, `status`, `created_at`, `updated_at`) VALUES
(1, 'إلكترونيات', 'electronics', 'default.jpg', 1, '2022-10-19 09:44:58', NULL),
(2, 'موضة و أزياء', 'fashion', 'default.jpg', 1, '2022-10-19 09:46:10', NULL),
(3, 'العاب', 'toys&games', 'default.jpg', 1, '2022-10-19 09:46:10', NULL),
(4, 'سوبر ماركت', 'supermarket', 'default.jpg', 1, '2022-10-19 09:47:21', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `cities`
--

CREATE TABLE `cities` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name_ar` varchar(20) NOT NULL,
  `name_en` varchar(20) NOT NULL,
  `status` tinyint(1) DEFAULT 1 COMMENT '1=> active\r\n0=>blocked',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cities`
--

INSERT INTO `cities` (`id`, `name_ar`, `name_en`, `status`, `created_at`, `updated_at`) VALUES
(1, 'الاسكندرية', 'Alexandria', 1, '2022-10-25 22:54:51', NULL),
(2, 'القاهرة', 'cairo', 1, '2022-10-25 22:54:51', NULL),
(3, 'بورسعيد', 'port said', 1, '2022-10-25 22:55:17', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `coupons`
--

CREATE TABLE `coupons` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `code` int(5) NOT NULL,
  `max_usage_count` int(11) NOT NULL,
  `max_usage_count_per_user` int(11) NOT NULL,
  `mini_order_price` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1 COMMENT '1=>available\r\n0=>not available',
  `discount` int(11) NOT NULL,
  `discount_type` int(11) NOT NULL,
  `start_at` datetime NOT NULL,
  `end_at` datetime NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  `max_discount_value` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `fav`
--

CREATE TABLE `fav` (
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `offers`
--

CREATE TABLE `offers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title_en` text NOT NULL,
  `title_ar` text NOT NULL,
  `image` varchar(64) DEFAULT NULL,
  `discount` decimal(5,2) DEFAULT NULL,
  `discount_type` varchar(30) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1 COMMENT '1=>active\r\n0=>blocked',
  `start_at` timestamp NULL DEFAULT NULL,
  `end_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  `description_ar` mediumtext DEFAULT NULL,
  `description_en` mediumtext DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `offers_products`
--

CREATE TABLE `offers_products` (
  `offer_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `price_after_discount` decimal(10,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `number` bigint(20) NOT NULL,
  `payment_method` varchar(20) DEFAULT NULL,
  `total_price` decimal(8,2) NOT NULL,
  `notes` text DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1 COMMENT '1=> active\r\n0=>not active',
  `delivered_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  `coupon_id` bigint(20) UNSIGNED DEFAULT NULL,
  `address_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `number`, `payment_method`, `total_price`, `notes`, `status`, `delivered_at`, `created_at`, `updated_at`, `coupon_id`, `address_id`) VALUES
(3, 1, 'credit card', '2500.00', NULL, 1, NULL, '2022-10-25 23:01:03', NULL, NULL, 1),
(4, 2, 'cash', '10000.00', NULL, 1, '2022-10-25 23:01:56', '2022-10-25 23:01:18', '2022-10-25 23:01:56', NULL, 2),
(5, 3, 'cash', '3500.00', NULL, 1, NULL, '2022-10-25 23:01:40', NULL, NULL, 2);

-- --------------------------------------------------------

--
-- Table structure for table `orders_products`
--

CREATE TABLE `orders_products` (
  `order_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `quantity` tinyint(4) NOT NULL,
  `price` decimal(10,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `orders_products`
--

INSERT INTO `orders_products` (`order_id`, `product_id`, `quantity`, `price`) VALUES
(3, 16, 2, '37500'),
(3, 18, 3, '6990'),
(3, 19, 3, '37500'),
(3, 23, 1, '6690'),
(4, 16, 1, '6990'),
(4, 18, 3, '20000'),
(5, 16, 3, '37500'),
(5, 19, 1, '6990'),
(5, 23, 1, '6990');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name_ar` varchar(512) NOT NULL,
  `name_en` varchar(512) NOT NULL,
  `details_ar` text NOT NULL,
  `details_en` text NOT NULL,
  `price` decimal(8,2) NOT NULL,
  `code` int(5) NOT NULL,
  `quantity` smallint(3) NOT NULL DEFAULT 1,
  `status` tinyint(1) NOT NULL DEFAULT 1 COMMENT '0=> not available \r\n1=>available',
  `image` varchar(64) NOT NULL,
  `subcategory_id` bigint(20) UNSIGNED DEFAULT NULL,
  `brand_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name_ar`, `name_en`, `details_ar`, `details_en`, `price`, `code`, `quantity`, `status`, `image`, `subcategory_id`, `brand_id`, `created_at`, `updated_at`) VALUES
(15, 'لعبة توصيل حلقات مرنة للاطفال من تولو - 5 حلقات\r\n', 'Tolo Baby Links Rattle and Teether\r\n', 'حول هذه السلعة\r\nتساعد اللعبة على تحسين التنسيق بين حركات اليد والعين\r\nمناسبة وآمنة للطفل خلال مرحلة التسنين\r\nتساعد الطفل على تعلم الألوان والأشكال\r\nتحسن اللعبة من المهارات اليدوية لدى الطفل خلال السنوات الأولى\r\nمجموعة من خمس حلقات ملونة\r\nيمكن تركيب الحلقات في لعبة طفلك المفضلة أو السرير المتنقل أو كرسي الأطفال', 'About this item\r\nEasy to use\r\nIt provides endless hours of fun and entertainment\r\nIt is good to improve imagination and creativity\r\nPerfect for developing kid\'s imagination and manual dexterity\r\nIt helps improving motor skills, hand-eye coordination\r\nPerfect for developing kid\'s imagination and manual dexterity', '99.00', 5552, 0, 1, 'games.jpg', 20, 5, '2022-10-22 19:05:11', '2022-10-27 19:06:19'),
(16, 'موبايل سامسونج جالاكسي A13 بشريحتين اتصال (سعة تخزين 64 جيجابايت/ 4 جيجابايت رام) - لون اسود\r\n', 'Samsung A13 4GB Ram, 64GB - Black\r\n', 'سامسونج جالاكسي\r\nال تي اي\r\nذاكرة الوصول العشوائي: 4 جيجابايت\r\nاللون: أسود\r\nشريحتين', 'About this item\r\nsamsung Galaxy\r\nLTE\r\nRAM: 4GB\r\ncolor: Black\r\nDual SIM', '4800.00', 553641, 20, 1, 'samsung.jpg', 13, 2, '2022-10-22 19:07:44', NULL),
(17, '', '2022 Apple MacBook Pro laptop with M2 chip: 13-inch Retina display, 8GB RAM, 256GB SSD storage, Touch Bar, backlit keyboard, FaceTime HD camera. Works with iPhone and iPad; Space Grey', '', 'About this item\r\nUP TO 20 HOURS OF BATTERY LIFEGo all day and into the night, thanks to the power-efficient performance of the Apple M2 chip.\r\nSUSTAINED PERFORMANCEThanks to its active cooling system, the 13-inch MacBook Pro can sustain pro levels of performance, so you can run CPU- and GPU-intensive tasks for hours on end.\r\nBRILLIANT DISPLAYThe 13.3-inch Retina display features 500 nits of brightness and P3 wide colour for vibrant images and incredible detail.\r\nHD CAMERA AND STUDIO-QUALITY MICSLook sharp and sound great with a FaceTime HD camera and three-mic array.\r\nVERSATILE CONNECTIVITYTwo Thunderbolt ports let you connect and power high-speed accessories.', '37500.00', 5632, 5, 1, 'applelab.jpg', 17, 4, '2022-10-22 19:30:30', NULL),
(18, '', 'SAMSUNG 870 QVO SATA III SSD 1TB 2.5\" Internal Solid State Hard Drive, Upgrade Desktop PC or Laptop Memory and Storage for IT Pros, Creators, Everyday Users, MZ-77Q1T0B', '', 'GO BIG, DO MORE: The 870 QVO is Samsung\'s latest 2nd generation QLC SSD with up to 8TB of storage capacity\r\nENHANCED IN EVERY WAY: With an expanded, SATA interface limit of 560/530 MB/s sequential speeds, the 870 QVO improves random access speed and sustained performance\r\nBOOST CAPACITY: The 870 QVO is available in 1, 2, 4 and 8TB\r\nRELIABLE AND SUSTAINABLE: The capacity of the 8TB 870 QVO increases reliability up to 2,880 TBW using a refined ECC algorithm for stable performance\r\nUPGRADE WITH EASE: Upgrading to 870 QVO is now easier than ever for anyone with a desktop PC or laptop that supports a standard 2.5 inch SATA form factor.SAMSUNG MAGICIAN SOFTWARE: Manage your drive and enhance its performance with tools that keep up with the latest updates and monitor the drive\'s health and status.FLASH MEMORY BRAND: All firmware and components, including Samsung\'s world renowned DRAM and NAND, are produced in house, allowing end to end integration for quality you can trust', '5000.00', 2563, 3, 1, 'samsunglap.jpg', 17, 2, '2022-10-22 19:31:56', NULL),
(19, 'شاشة سامسونج 32 بوصة - اللون اسود', 'Samsung 32 Inch HD Smart LED TV with Built-in Receiver, Black - UA32T5300AUXEG', '', 'About this item\r\nBrand: SamsungCategory Type:Color: BlackRemote Control: YesScreen Size: 32 inchesHD formats: HDResolution: 1366x768Type: LEDHDTV: YesModel Number: UA32T5300AUXEG\r\nSmart Hub and Single Device Remote (Feature availability may vary in different regions. Check availability before use.) All you need to discover thousands of different content in one place is a single remote control that you can use to control your digital set-top box, game console, apps or even live TV\r\nWatch the amazing details HDR technology High Dynamic Range (HDR) technology heightens the expression of brightness in your TV so you can enjoy a rich range of colors and visual detail, even in the darkest scenes.\r\nRealistic colors that put you in the heart of the action PurColor technology makes you feel part of the action of the content you\'re watching by enabling your TV to express a wide range of colors to optimize picture performance. And then the viewer gets an amazing experience that makes him in the midst of the action', '3990.00', 5362, 6, 1, 'samtv.jpg', 14, 2, '2022-10-22 19:33:40', NULL),
(20, '', 'Dell Vostro 3510 laptop - 11th Intel core i7-1165G7, 8GB RAM, 512GB PCIe NVMe M.2 SSD, Nvidia GeForce MX350 GDDR5 Graphics, 15.6\" FHD (1920 x 1080) Anti-glare LED Narrow Border, Ubuntu - Carbon Black', '', 'About this item\r\nDell Vostro 3510 laptop - 11th Intel core i7-1165G7, 8GB RAM, 512GB PCIe NVMe M.2 SSD, Nvidia GeForce MX350 GDDR5 Graphics, 15.6\" FHD (1920 x 1080) Anti-glare LED Narrow Border, Ubuntu - Carbon Black', '17800.00', 53624, 3, 1, 'delllap.jpg', 17, 6, '2022-10-22 19:36:21', NULL),
(21, '', 'HP Envy X360 13-bf0013dx 2-in-1 - 12th Intel Core i7-1250U 10-Cores, 8GB RAM, 512GB SSD, Intel Iris X Graphics, 13.3\" FHD 1920X1200 WUXGA IPS Touch, FingerPrint, Backlit KB, Windows 11, Natural Silver', '', 'About this item\r\nHP Envy X360 13-bf0013dx 2-in-1 - 12th Intel Core i7-1250U 10-Cores, 8GB RAM, 512GB SSD, Intel Iris X Graphics, 13.3\" FHD 1920X1200 WUXGA IPS Touch, FingerPrint, Backlit KB, Windows 11, Natural Silver\r\nGraphics: Intel Iris Xe Graphics\r\nKeyboard: Full-size keyboard, backlight, natural silver\r\nDisplay: 13.3 inch diagonal, WUXGA (1920 x 1200), multi-touch, IPS, edge-to-edge glass, microedge, Corning Gorilla Glass NBT', '2400.00', 523689, 3, 0, 'hplap.jpg', 17, 7, '2022-10-22 19:39:07', '2022-10-25 15:20:08'),
(22, '', 'Apple Macbook Air 2020 Model, (13-Inch, Apple M1 chip with 8-core CPU and 7-core GPU, 8GB, 256GB, MGN93), Eng-KB, Silver', '', 'About this item\r\nOne touch is enough to lock and unlock your MacBook Air\r\nEnjoy absolute comfort from A to Z. In addition to typing at your leisure, with the pre programmed shortcuts on this keyboard you can instantly access the features you use the most\r\nThe M1 chip carries our most advanced image signal processor so you always look great on your FaceTime video calls. The three built in mics miss nothing, whether you\'re on a call, dictating a note, or asking Siri what the weather is like\r\nThe MacBook Air knows how to automatically adjust the white point of the screen according to the ambient color temperature, so it is more comfortable to look at\r\nmacOS Big Sur was developed to harness the potential of the M1 chip and transform the Mac', '27000.00', 58971, 1, 1, 'applemac.jpg', 17, 4, '2022-10-22 19:39:07', '2022-10-25 14:32:13'),
(23, 'موبايل اوبو a95  ', 'OPPO A95-6.43in 128GB/8GB Dual SIM 4G Mobile Phone -Glowing Rainbow Silver', '', 'About this item\r\nBrand: OPPO\r\nType- Mobile Phone\r\nColour -Glowing Rainbow Silver\r\nHygienic packaging', '6000.00', 25364, 5, 1, 'oppo.jpg', 13, 3, '2022-10-22 20:24:39', '2022-10-25 23:05:39'),
(24, '', 'OPPO A76 (Glowing Blue, 6GB RAM, 128 Storage) with No Cost EMI/Additional Exchange Offers', '', 'About this item\r\n16.66 cm (6.56 inch) HD+ Display\r\n6 GB RAM | 128 GB ROM | Expandable Upto 256 GB\r\n13MP + 2MP | 8MP Front Camera\r\n5000 mAh Battery Long lasting Battery\r\nQualcomm Snapdragon 680 Processor', '6000.00', 111235, 5, 1, 'oppo76.jpg', 13, 3, '2022-10-22 20:26:34', '2022-10-24 23:16:51'),
(25, '', 'LG LED Smart TV 43 inch LM6370 Series Full HD HDR Smart LED TV - 43LM6370PVA', '', 'About this item\r\nClean Minimalist Design A thin TV designed to look elegant from any angle, giving you less TV and more picture. You no longer need a separate digital receiver with your TV. With a built in receiver, so less space is required, less power is used and only one remote control is needed to control your TV.\r\nMore Clarity, More Details Full HD image resolution gives a clearer picture with superb quality. It\'s more pixels on the screen creates images that are crisper and capable of showing more details than standard HD. Quad core processor reduces noise and upscales low resolution images. Enjoy striking images with enhanced depth and color contrast through Dynamic Color Enhancer. Active HDR adjusts brightness to enhance color, reveal every tiny detail, and bring lifelike clarity to every image. So all your favorite movies and shows will be more vivid and vibrant from beginning to end.\r\nLG ThinQ AI Resolution 1920x1080\r\nActive HDR', '5500.00', 89753, 6, 1, 'LG.jpg', 14, 8, '2022-10-22 20:29:09', '2022-10-25 14:32:26'),
(26, 'موبايل سامسونج', 'mobile samsung A50', 'االالالاتل', 'gffghhghghg', '5500.00', 12345, 5, 1, '2H8LtnMRqJPvUSR6Bb95wF0jOtnpOskzc36rgbjD.jpg', 20, 4, '2022-10-28 16:43:21', '2022-10-28 19:40:19');

-- --------------------------------------------------------

--
-- Table structure for table `products_specs`
--

CREATE TABLE `products_specs` (
  `spec_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `value_en` decimal(8,2) NOT NULL,
  `value_ar` decimal(8,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Stand-in structure for view `product_details`
-- (See below for the actual view)
--
CREATE TABLE `product_details` (
`id` bigint(20) unsigned
,`name_ar` varchar(512)
,`name_en` varchar(512)
,`details_ar` text
,`details_en` text
,`price` decimal(8,2)
,`code` int(5)
,`quantity` smallint(3)
,`status` tinyint(1)
,`image` varchar(64)
,`subcategory_id` bigint(20) unsigned
,`brand_id` bigint(20) unsigned
,`created_at` timestamp
,`updated_at` timestamp
,`subcategory_name_en` varchar(32)
,`brand_name_en` varchar(32)
,`category_id` bigint(20) unsigned
,`category_name_en` varchar(32)
);

-- --------------------------------------------------------

--
-- Table structure for table `regions`
--

CREATE TABLE `regions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name_ar` varchar(32) NOT NULL,
  `name_en` varchar(32) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1 COMMENT '1=>active\r\n0=>blocked',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  `city_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `regions`
--

INSERT INTO `regions` (`id`, `name_ar`, `name_en`, `status`, `created_at`, `updated_at`, `city_id`) VALUES
(1, 'جليم', 'Gleem', 1, '2022-10-25 22:56:31', NULL, 1),
(2, 'مدينة نصر', 'madinet nasr', 1, '2022-10-25 22:56:31', NULL, 2),
(3, 'بور فؤاد', 'port fouad', 1, '2022-10-25 22:57:27', NULL, 3);

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `comment` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  `rate` tinyint(1) DEFAULT NULL CHECK (`rate` >= 0 and `rate` <= 5)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `reviews`
--

INSERT INTO `reviews` (`product_id`, `user_id`, `comment`, `created_at`, `updated_at`, `rate`) VALUES
(16, 35, 'not good not bad', '2022-10-29 02:02:45', NULL, 2),
(19, 36, 'good', '2022-10-29 01:34:42', NULL, 5),
(19, 37, 'good quality ', '2022-10-29 01:34:27', NULL, 3),
(26, 35, 'bad', '2022-10-29 02:02:45', NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `specs`
--

CREATE TABLE `specs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name_ar` varchar(512) NOT NULL,
  `name_en` varchar(512) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `subcategories`
--

CREATE TABLE `subcategories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name_ar` varchar(32) NOT NULL,
  `name_en` varchar(32) NOT NULL,
  `image` varchar(64) DEFAULT 'default.jpg',
  `status` tinyint(1) DEFAULT 1 COMMENT '1=>ACTIVE , 0=>BLOCKED',
  `category_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `subcategories`
--

INSERT INTO `subcategories` (`id`, `name_ar`, `name_en`, `image`, `status`, `category_id`, `created_at`, `updated_at`) VALUES
(13, 'الموبايلات', 'mobiles', 'default.jpg', 1, 1, '2022-10-22 18:49:10', NULL),
(14, 'تلفزيونات', 'tv', 'default.jpg', 1, 1, '2022-10-22 18:49:41', NULL),
(15, 'الاحذية', 'shoes', 'default.jpg', 1, 2, '2022-10-22 18:50:21', NULL),
(16, 'جبنة', 'cheese', 'default.jpg', 1, 4, '2022-10-22 18:50:58', NULL),
(17, 'لابتوبات', 'laptops', 'default.jpg', 1, 1, '2022-10-22 18:57:34', NULL),
(18, 'ساعات', 'watches', 'default.jpg', 1, 2, '2022-10-22 18:57:50', NULL),
(19, 'نضارات', 'glasses', 'default.jpg', 1, 2, '2022-10-22 18:58:01', NULL),
(20, 'العاب الاطفال', 'baby toy', 'default.jpg', 1, 3, '2022-10-22 18:58:32', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `first_name` varchar(32) NOT NULL,
  `last_name` varchar(32) NOT NULL,
  `email` varchar(64) NOT NULL,
  `phone` varchar(11) NOT NULL,
  `password` varchar(128) NOT NULL,
  `gender` enum('m','f') NOT NULL COMMENT 'm-> male\r\nf-> female',
  `image` varchar(64) NOT NULL DEFAULT 'default.jpg',
  `verification_code` int(6) DEFAULT NULL,
  `status` tinyint(1) DEFAULT 1 COMMENT '1=>ACTIVE , 0=>BLOCKED',
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `email`, `phone`, `password`, `gender`, `image`, `verification_code`, `status`, `email_verified_at`, `created_at`, `updated_at`) VALUES
(35, 'nour', 'ali ', 'nouranonann249@gmail.com', '01203104470', '$2y$10$Z3mtZ9ooXfYajsPOWW4jbekokAlsXPf/Js7GjpA4yGSSUdaqnxxl.', 'f', 'default.jpg', 468548, 1, '2022-10-24 22:46:24', '2022-10-22 12:09:21', '2022-10-29 04:53:36'),
(36, 'nehal', 'ali', 'nouranta@gmail.com', '01286777921', '$2y$10$Q9DvU0jWhnb/kkl7Xw7zTO7NaUEAJx3TLNnJrqN23NuzxMPeZvOgC', 'f', 'default.jpg', 268534, 1, NULL, '2022-10-22 12:37:20', '2022-10-22 12:52:01'),
(37, 'ahmed', 'ali', 'nouranona@gmail.com', '01254545454', '$2y$10$LIBdlsl.H02DhRAirp5kaeQuhNQEyDFjEbwN5EWWhUyE2jatWnkLG', 'm', 'default.jpg', 116685, 1, '2022-10-22 23:11:05', '2022-10-22 23:10:50', '2022-10-22 23:11:05');

-- --------------------------------------------------------

--
-- Structure for view `product_details`
--
DROP TABLE IF EXISTS `product_details`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `product_details`  AS   (select `products`.`id` AS `id`,`products`.`name_ar` AS `name_ar`,`products`.`name_en` AS `name_en`,`products`.`details_ar` AS `details_ar`,`products`.`details_en` AS `details_en`,`products`.`price` AS `price`,`products`.`code` AS `code`,`products`.`quantity` AS `quantity`,`products`.`status` AS `status`,`products`.`image` AS `image`,`products`.`subcategory_id` AS `subcategory_id`,`products`.`brand_id` AS `brand_id`,`products`.`created_at` AS `created_at`,`products`.`updated_at` AS `updated_at`,`subcategories`.`name_en` AS `subcategory_name_en`,`brands`.`name_en` AS `brand_name_en`,`categories`.`id` AS `category_id`,`categories`.`name_en` AS `category_name_en` from (((`products` left join `brands` on(`brands`.`id` = `products`.`brand_id`)) left join `subcategories` on(`subcategories`.`id` = `products`.`subcategory_id`)) left join `categories` on(`categories`.`id` = `subcategories`.`category_id`)))  ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `addresses`
--
ALTER TABLE `addresses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `region_id` (`region_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `brands`
--
ALTER TABLE `brands`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `carts`
--
ALTER TABLE `carts`
  ADD PRIMARY KEY (`user_id`,`product_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cities`
--
ALTER TABLE `cities`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `coupons`
--
ALTER TABLE `coupons`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `code` (`code`);

--
-- Indexes for table `fav`
--
ALTER TABLE `fav`
  ADD PRIMARY KEY (`product_id`,`user_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `offers`
--
ALTER TABLE `offers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `offers_products`
--
ALTER TABLE `offers_products`
  ADD PRIMARY KEY (`offer_id`,`product_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `number` (`number`),
  ADD KEY `address_id` (`address_id`),
  ADD KEY `coupon_id` (`coupon_id`);

--
-- Indexes for table `orders_products`
--
ALTER TABLE `orders_products`
  ADD PRIMARY KEY (`order_id`,`product_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `code` (`code`),
  ADD KEY `brand_id` (`brand_id`),
  ADD KEY `subcategory_id` (`subcategory_id`);

--
-- Indexes for table `products_specs`
--
ALTER TABLE `products_specs`
  ADD PRIMARY KEY (`spec_id`,`product_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `regions`
--
ALTER TABLE `regions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `city_id` (`city_id`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`product_id`,`user_id`),
  ADD KEY `users_reviews_fk` (`user_id`);

--
-- Indexes for table `specs`
--
ALTER TABLE `specs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subcategories`
--
ALTER TABLE `subcategories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `categories_id` (`category_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `phone` (`phone`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `addresses`
--
ALTER TABLE `addresses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `brands`
--
ALTER TABLE `brands`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `cities`
--
ALTER TABLE `cities`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `coupons`
--
ALTER TABLE `coupons`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `offers`
--
ALTER TABLE `offers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `regions`
--
ALTER TABLE `regions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `specs`
--
ALTER TABLE `specs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `subcategories`
--
ALTER TABLE `subcategories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `addresses`
--
ALTER TABLE `addresses`
  ADD CONSTRAINT `addresses_ibfk_1` FOREIGN KEY (`region_id`) REFERENCES `regions` (`id`),
  ADD CONSTRAINT `addresses_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `carts`
--
ALTER TABLE `carts`
  ADD CONSTRAINT `carts_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`),
  ADD CONSTRAINT `carts_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `fav`
--
ALTER TABLE `fav`
  ADD CONSTRAINT `fav_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`),
  ADD CONSTRAINT `fav_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `offers_products`
--
ALTER TABLE `offers_products`
  ADD CONSTRAINT `offers_products_ibfk_1` FOREIGN KEY (`offer_id`) REFERENCES `offers` (`id`),
  ADD CONSTRAINT `offers_products_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`);

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`address_id`) REFERENCES `addresses` (`id`),
  ADD CONSTRAINT `orders_ibfk_2` FOREIGN KEY (`coupon_id`) REFERENCES `coupons` (`id`);

--
-- Constraints for table `orders_products`
--
ALTER TABLE `orders_products`
  ADD CONSTRAINT `orders_products_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`),
  ADD CONSTRAINT `orders_products_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`);

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`brand_id`) REFERENCES `brands` (`id`),
  ADD CONSTRAINT `products_ibfk_2` FOREIGN KEY (`subcategory_id`) REFERENCES `subcategories` (`id`);

--
-- Constraints for table `products_specs`
--
ALTER TABLE `products_specs`
  ADD CONSTRAINT `products_specs_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`),
  ADD CONSTRAINT `products_specs_ibfk_2` FOREIGN KEY (`spec_id`) REFERENCES `specs` (`id`);

--
-- Constraints for table `regions`
--
ALTER TABLE `regions`
  ADD CONSTRAINT `regions_ibfk_1` FOREIGN KEY (`city_id`) REFERENCES `cities` (`id`);

--
-- Constraints for table `reviews`
--
ALTER TABLE `reviews`
  ADD CONSTRAINT `products_reviews_fk` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`),
  ADD CONSTRAINT `users_reviews_fk` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `subcategories`
--
ALTER TABLE `subcategories`
  ADD CONSTRAINT `subcategories_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
