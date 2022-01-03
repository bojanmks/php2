-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 04, 2021 at 03:15 PM
-- Server version: 10.4.18-MariaDB
-- PHP Version: 8.0.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mobishoptpo`
--

-- --------------------------------------------------------

--
-- Table structure for table `author_socials`
--

CREATE TABLE `author_socials` (
  `id` int(11) NOT NULL,
  `icon` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `href` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `color` varchar(30) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `author_socials`
--

INSERT INTO `author_socials` (`id`, `icon`, `href`, `color`) VALUES
(1, 'fab fa-facebook', 'https://www.facebook.com/bojan.maksimovic.908', '#3d6eff'),
(2, 'fab fa-instagram', 'https://www.instagram.com/bojanm___/', '#ff24f8'),
(3, 'fab fa-twitter', 'https://twitter.com/bojanm_', '#17e4ff');

-- --------------------------------------------------------

--
-- Table structure for table `brands`
--

CREATE TABLE `brands` (
  `id` int(11) NOT NULL,
  `name` varchar(30) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `brands`
--

INSERT INTO `brands` (`id`, `name`) VALUES
(1, 'Apple'),
(2, 'Honor'),
(3, 'Huawei'),
(4, 'Samsung');

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `phone_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `contact_messages`
--

CREATE TABLE `contact_messages` (
  `message_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `message` varchar(500) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `contact_messages`
--

INSERT INTO `contact_messages` (`message_id`, `user_id`, `name`, `email`, `message`) VALUES
(31, NULL, 'Bojan Maksimović', 'bojan.maxim075@gmail.com', 'aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa'),
(39, 5, 'Bojan Maksimović', 'bojan.maxim075@gmail.com', 'aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa'),
(43, 5, 'Bojan Maksimović', 'bojan.maxim075@gmail.com', 'ccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccc'),
(44, NULL, 'Bojan Maksimović', 'korisnik3@gmail.com', '333333333333333333333333333333333333333333333333333333333333333333333333333333333333333333333333333333333333333333333333333333');

-- --------------------------------------------------------

--
-- Table structure for table `footer_links`
--

CREATE TABLE `footer_links` (
  `id` int(11) NOT NULL,
  `icon` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `href` varchar(100) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `footer_links`
--

INSERT INTO `footer_links` (`id`, `icon`, `href`) VALUES
(1, 'fab fa-facebook', 'https://www.facebook.com/bojan.maksimovic.908'),
(2, 'fab fa-instagram', 'https://www.instagram.com/bojanm___/'),
(3, 'fab fa-twitter', 'https://twitter.com/bojanm_'),
(4, 'fas fa-file-pdf', 'assets/documentation/documentation.pdf');

-- --------------------------------------------------------

--
-- Table structure for table `link_categories`
--

CREATE TABLE `link_categories` (
  `lc_id` int(11) NOT NULL,
  `name` varchar(30) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `link_categories`
--

INSERT INTO `link_categories` (`lc_id`, `name`) VALUES
(1, 'nav'),
(2, 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `operating_systems`
--

CREATE TABLE `operating_systems` (
  `id` int(11) NOT NULL,
  `name` varchar(20) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `operating_systems`
--

INSERT INTO `operating_systems` (`id`, `name`) VALUES
(1, 'Android'),
(2, 'iOS');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `total_price` float NOT NULL,
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `address` varchar(100) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `user_id`, `total_price`, `name`, `address`) VALUES
(1, 4, 12900, 'Pera Peric', 'Dimitrija Tucovica 154A'),
(4, 1, 3920, 'Bojan Maksimovic', 'Cingrijina 13'),
(5, NULL, 4850, 'Bojan Maksimovic', 'Ljubljanska 11');

-- --------------------------------------------------------

--
-- Table structure for table `order_details`
--

CREATE TABLE `order_details` (
  `od_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `phone_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `order_details`
--

INSERT INTO `order_details` (`od_id`, `order_id`, `phone_id`, `quantity`) VALUES
(1, 1, 5, 9),
(2, 1, 2, 4),
(3, 1, 3, 1),
(9, 4, 6, 2),
(10, 4, 4, 5),
(11, 4, 17, 3),
(12, 5, 1, 3),
(13, 5, 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `page_links`
--

CREATE TABLE `page_links` (
  `id` int(11) NOT NULL,
  `page_name` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `href` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `link_category` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `page_links`
--

INSERT INTO `page_links` (`id`, `page_name`, `href`, `link_category`) VALUES
(1, 'Home', 'home', 1),
(2, 'Phones', 'phones', 1),
(3, 'Contact', 'contact', 1),
(4, 'Author', 'author', 1),
(6, 'Page stats', 'page-stats', 2),
(7, 'Logins (24h)', 'logins', 2),
(8, 'Users', 'users', 2),
(9, 'Phones', 'phones', 2),
(10, 'Brands', 'brands', 2),
(11, 'Operating systems', 'operating-systems', 2),
(12, 'Orders', 'orders', 2),
(13, 'Messages', 'messages', 2);

-- --------------------------------------------------------

--
-- Table structure for table `phones`
--

CREATE TABLE `phones` (
  `id` int(11) NOT NULL,
  `name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `image` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `image_small` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `os` int(11) NOT NULL,
  `brand` int(11) NOT NULL,
  `price` float NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `phones`
--

INSERT INTO `phones` (`id`, `name`, `image`, `image_small`, `os`, `brand`, `price`, `active`) VALUES
(1, 'APPLE iPhone XS 512GB Silver MT9M2SE/A', 'iPhone_XS_512GB_Silver.png', 'small_iPhone_XS_512GB_Silver.png', 2, 1, 1500, 1),
(2, 'HONOR 10 64GB Phantom Green 7800429', 'HONOR_10_64GB_Phantom_Green.png', 'small_HONOR_10_64GB_Phantom_Green.png', 1, 2, 350, 1),
(3, 'APPLE iPhone 11 Pro Max 256GB Space gray', 'iPhone_11_Pro_Max_256GB_Space_gray.png', 'small_iPhone_11_Pro_Max_256GB_Space_gray.png', 2, 1, 1600, 1),
(4, 'HUAWEI P30 Lite 256GB Breathing Crystal', 'HUAWEI_P30_Lite_256GB_Breathing_Crystal.png', 'small_HUAWEI_P30_Lite_256GB_Breathing_Crystal.png', 1, 3, 350, 1),
(5, 'APPLE iPhone 12 64GB Blue', 'iPhone_12_64GB_Blue.png', 'small_iPhone_12_64GB_Blue.png', 2, 1, 1100, 1),
(6, 'HUAWEI Y5p 32GB Midnight Black', 'HUAWEI_Y5p_32GB_Midnight_black.png', 'small_HUAWEI_Y5p_32GB_Midnight_black.png', 1, 3, 110, 1),
(7, 'HONOR 8A 32GB Black 51093WGU', 'HONOR_8A_32GB_Black.png', 'small_HONOR_8A_32GB_Black.png', 1, 2, 140, 1),
(8, 'SAMSUNG GALAXY Z FLIP 256GB Mirror Black SM-F700FZ', 'SAMSUNG_GALAXY_Z_FLIP_256GB_Mirror_black.png', 'small_SAMSUNG_GALAXY_Z_FLIP_256GB_Mirror_black.png', 1, 4, 1200, 1),
(9, 'SAMSUNG GALAXY A20s 32GB Blue SM-A207FZBDEUF', 'SAMSUNG_GALAXY_A20s_32GB_Blue.png', 'small_SAMSUNG_GALAXY_A20s_32GB_Blue.png', 1, 4, 200, 1),
(10, 'APPLE iPhone 11 Pro Max 64GB Green MWHH2SE/A', 'iPhone_11_Pro_Max_64GB_Green.png', 'small_iPhone_11_Pro_Max_64GB_Green.png', 2, 1, 1350, 1),
(11, 'HONOR 9A 64GB Black', 'HONOR_9A_64GB_Black.png', 'small_HONOR_9A_64GB_Black.png', 1, 2, 170, 1),
(12, 'HONOR 20 128GB Midnight black 51093VCM', 'HONOR_20_128GB_Midnight_black.png', 'small_HONOR_20_128GB_Midnight_black.png', 1, 2, 400, 1),
(13, 'HUAWEI Y6p 64GB Emerald Green', 'HUAWEI_Y6p_64GB_Emerald_Green.png', 'small_HUAWEI_Y6p_64GB_Emerald_Green.png', 1, 3, 190, 1),
(14, 'HUAWEI P40 Pro 256GB Black', 'HUAWEI_P40_Pro_256GB_Black.png', 'small_HUAWEI_P40_Pro_256GB_Black.png', 1, 3, 1200, 1),
(15, 'SAMSUNG GALAXY A20e 32GB DS Orange SM-A202FZODSEE', 'SAMSUNG_GALAXY_A20e_32GB_DS_Orange.png', 'small_SAMSUNG_GALAXY_A20e_32GB_DS_Orange.png', 1, 4, 410, 1),
(16, 'SAMSUNG GALAXY A21s 32GB Blue SM-A217FZBNEUF', 'SAMSUNG_GALAXY_A21s_32GB_Blue.png', 'small_SAMSUNG_GALAXY_A21s_32GB_Blue.png', 1, 4, 200, 1),
(17, 'APPLE iPhone SE 128GB Red', 'iPhone_SE_128GB_Red.png', 'small_iPhone_SE_128GB_Red.png', 2, 1, 650, 1),
(18, 'APPLE iPhone 11 Pro Max 256GB Gold', 'iPhone_11_Pro_Max_256GB_Gold.png', 'small_iPhone_11_Pro_Max_256GB_Gold.png', 2, 1, 1600, 1),
(19, 'HUAWEI P30 Lite 256GB Midnight Black', 'HUAWEI_P30_Lite_256GB_Midnight_Black.png', 'small_HUAWEI_P30_Lite_256GB_Midnight_Black.png', 1, 3, 350, 1),
(20, 'SAMSUNG GALAXY S20 Ultra Cloud White', 'SAMSUNG_GALAXY_S20_Ultra_Cloud_White.png', 'small_SAMSUNG_GALAXY_S20_Ultra_Cloud_White.png', 1, 4, 1400, 1),
(21, 'HUAWEI P Smart (2021) 128GB Blush Gold', 'HUAWEI_P_Smart_(2021)_128GB_Blush_gold.png', 'small_HUAWEI_P_Smart_(2021)_128GB_Blush_gold.png', 1, 3, 240, 1),
(22, 'HONOR 7S 16GB Black 51094ABU', 'HONOR_7S_16GB_Black.png', 'small_HONOR_7S_16GB_Black.png', 1, 2, 90, 1),
(23, 'SAMSUNG GALAXY NOTE 20 Mystic Grey SM-N980FZAGEUF', 'SAMSUNG_GALAXY_NOTE_20_Mystic_Grey.png', 'small_SAMSUNG_GALAXY_NOTE_20_Mystic_Grey.png', 1, 4, 1100, 1),
(24, 'HONOR 9S 32GB Black', 'HONOR_9S_32GB_Black.png', 'small_HONOR_9S_32GB_Black.png', 1, 2, 100, 1);

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `role_id` int(11) NOT NULL,
  `role_name` varchar(50) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`role_id`, `role_name`) VALUES
(1, 'admin'),
(2, 'regular');

-- --------------------------------------------------------

--
-- Table structure for table `slider_images`
--

CREATE TABLE `slider_images` (
  `id` int(11) NOT NULL,
  `href` varchar(100) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `slider_images`
--

INSERT INTO `slider_images` (`id`, `href`) VALUES
(1, 'slide1.jpg'),
(2, 'slide2.jpg'),
(3, 'slide3.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `role` int(11) NOT NULL,
  `active` tinyint(4) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `role`, `active`) VALUES
(1, 'korisnik1', 'korisnik1@gmail.com', 'da349d45d3359d9b3b3d6a97c53f4928', 2, 1),
(2, 'korisnik2', 'korisnik2@gmail.com', 'da349d45d3359d9b3b3d6a97c53f4928', 2, 1),
(4, 'boki200075', 'bojan.maxim075@gmail.com', '12a27bef421230c7690c31587d653a61', 2, 1),
(5, 'admin', 'admin@gmail.com', '61cc0e405f4b518d264c089ac8b642ef', 1, 1),
(6, 'korisnik3', 'korisnik3@gmail.com', 'da349d45d3359d9b3b3d6a97c53f4928', 1, 1),
(7, 'korisnik4', 'korisnik4@gmail.com', 'da349d45d3359d9b3b3d6a97c53f4928', 2, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `author_socials`
--
ALTER TABLE `author_socials`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `brands`
--
ALTER TABLE `brands`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`),
  ADD KEY `id` (`id`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `phone_id` (`phone_id`);

--
-- Indexes for table `contact_messages`
--
ALTER TABLE `contact_messages`
  ADD PRIMARY KEY (`message_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `footer_links`
--
ALTER TABLE `footer_links`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `link_categories`
--
ALTER TABLE `link_categories`
  ADD PRIMARY KEY (`lc_id`);

--
-- Indexes for table `operating_systems`
--
ALTER TABLE `operating_systems`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`),
  ADD KEY `id` (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `order_details`
--
ALTER TABLE `order_details`
  ADD PRIMARY KEY (`od_id`),
  ADD KEY `order_id` (`order_id`),
  ADD KEY `phone_id` (`phone_id`);

--
-- Indexes for table `page_links`
--
ALTER TABLE `page_links`
  ADD PRIMARY KEY (`id`),
  ADD KEY `page_category` (`link_category`);

--
-- Indexes for table `phones`
--
ALTER TABLE `phones`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`),
  ADD KEY `os` (`os`),
  ADD KEY `brand` (`brand`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`role_id`);

--
-- Indexes for table `slider_images`
--
ALTER TABLE `slider_images`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `role` (`role`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `author_socials`
--
ALTER TABLE `author_socials`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `brands`
--
ALTER TABLE `brands`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `contact_messages`
--
ALTER TABLE `contact_messages`
  MODIFY `message_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `footer_links`
--
ALTER TABLE `footer_links`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `link_categories`
--
ALTER TABLE `link_categories`
  MODIFY `lc_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `operating_systems`
--
ALTER TABLE `operating_systems`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `order_details`
--
ALTER TABLE `order_details`
  MODIFY `od_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `page_links`
--
ALTER TABLE `page_links`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `phones`
--
ALTER TABLE `phones`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `role_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `slider_images`
--
ALTER TABLE `slider_images`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `cart_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `contact_messages`
--
ALTER TABLE `contact_messages`
  ADD CONSTRAINT `contact_messages_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `order_details`
--
ALTER TABLE `order_details`
  ADD CONSTRAINT `order_details_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`order_id`);

--
-- Constraints for table `page_links`
--
ALTER TABLE `page_links`
  ADD CONSTRAINT `page_links_ibfk_1` FOREIGN KEY (`link_category`) REFERENCES `link_categories` (`lc_id`);

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`role`) REFERENCES `roles` (`role_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
