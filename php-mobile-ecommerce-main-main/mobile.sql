-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 22, 2022 at 01:47 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mobile`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `admin_id` int(3) NOT NULL,
  `admin_name` varchar(255) NOT NULL,
  `admin_email` varchar(255) NOT NULL,
  `admin_password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`admin_id`, `admin_name`, `admin_email`, `admin_password`) VALUES
(25, 'yousef', 'yousef@ymail.com', 'Yousef@123');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `category_id` int(3) NOT NULL,
  `category_name` varchar(255) NOT NULL,
  `category_img` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`category_id`, `category_name`, `category_img`) VALUES
(1, 'Mobile', 'mobile.png'),
(2, 'Tablet', 'tablet.png '),
(3, 'Accessories', 'accessories.png');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` int(3) NOT NULL,
  `user_id` int(3) NOT NULL,
  `prodcut_id` int(3) NOT NULL,
  `comment_content` text NOT NULL,
  `comment_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `user_id`, `prodcut_id`, `comment_content`, `comment_date`) VALUES
(60, 11, 45, 'nice', '2022-05-22'),
(61, 11, 45, 'nice', '2022-05-22'),
(62, 11, 45, 'nice', '2022-05-22'),
(63, 11, 46, 'nice', '2022-05-22'),
(64, 11, 47, 'nice', '2022-05-22'),
(65, 11, 47, 'GOOOD', '2022-05-22'),
(66, 11, 47, 'nice', '2022-05-22');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `order_status` varchar(255) DEFAULT NULL,
  `order_total_amount` int(11) NOT NULL,
  `order_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `product_quantity` int(40) NOT NULL,
  `phone_number` int(11) NOT NULL,
  `order_address` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `product_id` int(3) NOT NULL,
  `product_name` varchar(1000) NOT NULL,
  `product_description` text NOT NULL,
  `product_m_img` text NOT NULL,
  `product_price` varchar(255) NOT NULL,
  `product_featured` varchar(255) NOT NULL,
  `product_quantity` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `product_tags` varchar(255) NOT NULL,
  `product_sizes` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`product_id`, `product_name`, `product_description`, `product_m_img`, `product_price`, `product_featured`, `product_quantity`, `category_id`, `product_tags`, `product_sizes`) VALUES
(45, 'iphone 10', 'iphone', 'iphone.png', '200', 'iphone', 1, 1, 'phone', '25,30,35,40'),
(46, 'Samsung Galaxy 11', '', 'SamsungGalaxy11.png', '300', '25,30,35,40', 1, 1, 'phone', '25,30,35,40'),
(47, 'iPad Mini', 'iPad Mini', 'ipadmini.png', '100', 'iPad Mini', 2, 2, 'tablet', '25,30,35,40'),
(48, 'ipad 3', 'ipad 3', 'ipad3.png', '300', 'ipad 3', 5, 2, 'tablet', '25,30,35,40'),
(50, 'earphones', 'Xiaomi Buds 3T Pro\r\n', 'earphones.png', 'earphones', '', 0, 3, '', ''),
(51, 'Charger', 'Mi 20W Charger (Type-C)\r\n', 'Charger.png', '15', '', 0, 3, '', ''),
(54, 'earphones', 'earphones', 'images/G1mTois9telephone.png', '20', '', 0, 1, '', '');

-- --------------------------------------------------------

--
-- Table structure for table `subcategory`
--

CREATE TABLE `subcategory` (
  `subcategory_id` int(11) NOT NULL,
  `subcategory_name` varchar(255) NOT NULL,
  `category_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(3) NOT NULL,
  `user_img` text NOT NULL,
  `user_name` varchar(255) NOT NULL,
  `user_email` varchar(255) NOT NULL,
  `user_password` varchar(255) NOT NULL,
  `user_address` varchar(255) NOT NULL,
  `user_phone` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `user_img`, `user_name`, `user_email`, `user_password`, `user_address`, `user_phone`) VALUES
(11, 'IMG-62894169827d7-me3-removebg-preview.png', 'yousef fayiz alhindawi', 'yousefalhindawi@gmail.com', 'Yousef@123', 'Jordan ', 2147483647),
(14, 'IMG-6289f17eb7242-me3-removebg-preview.png', 'yousef alhindawi', 'eng.yousefalhindawi@gmail.com', 'Yousef@123', 'jordan', 2147483647);

-- --------------------------------------------------------

--
-- Table structure for table `users_cart`
--

CREATE TABLE `users_cart` (
  `user_cart_id` int(3) NOT NULL,
  `user_id` int(3) NOT NULL,
  `product_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `sub_total` varchar(255) NOT NULL,
  `Product_image` varchar(255) NOT NULL,
  `Product_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users_cart`
--

INSERT INTO `users_cart` (`user_cart_id`, `user_id`, `product_id`, `order_id`, `quantity`, `sub_total`, `Product_image`, `Product_name`) VALUES
(4, 11, 46, 0, 1, '300', 'SamsungGalaxy11.png', 'Samsung Galaxy 11'),
(13, 14, 51, 0, 1, '15', 'Charger.png', 'Charger'),
(14, 14, 45, 0, 1, '200', 'iphone.png', 'iphone 10'),
(15, 14, 51, 0, 1, '15', 'Charger.png', 'Charger'),
(16, 14, 45, 0, 1, '200', 'iphone.png', 'iphone 10'),
(17, 14, 46, 0, 1, '300', 'SamsungGalaxy11.png', 'Samsung Galaxy 11'),
(18, 14, 47, 0, 1, '100', 'ipadmini.png', 'iPad Mini'),
(19, 11, 48, 0, 1, '300', 'ipad3.png', 'ipad 3');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`admin_id`),
  ADD UNIQUE KEY `admin_email` (`admin_email`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `users_id` (`user_id`),
  ADD KEY `products_id` (`prodcut_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_id`),
  ADD KEY `products_ibfk_1` (`category_id`);

--
-- Indexes for table `subcategory`
--
ALTER TABLE `subcategory`
  ADD PRIMARY KEY (`subcategory_id`),
  ADD KEY `category_id` (`category_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `user_email` (`user_email`);

--
-- Indexes for table `users_cart`
--
ALTER TABLE `users_cart`
  ADD PRIMARY KEY (`user_cart_id`),
  ADD KEY `user_cart_id` (`user_id`),
  ADD KEY `product_cart_id` (`product_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `admin_id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `category_id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=67;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `product_id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT for table `subcategory`
--
ALTER TABLE `subcategory`
  MODIFY `subcategory_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `users_cart`
--
ALTER TABLE `users_cart`
  MODIFY `user_cart_id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `products_id` FOREIGN KEY (`prodcut_id`) REFERENCES `products` (`product_id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `users_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `categories` (`category_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `subcategory`
--
ALTER TABLE `subcategory`
  ADD CONSTRAINT `subcategory_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `categories` (`category_id`);

--
-- Constraints for table `users_cart`
--
ALTER TABLE `users_cart`
  ADD CONSTRAINT `product_cart_id` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `user_cart_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
