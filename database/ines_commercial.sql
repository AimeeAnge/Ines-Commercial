-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 06, 2026 at 02:49 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ines_commercial`
--

-- --------------------------------------------------------

--
-- Table structure for table `announcements`
--

CREATE TABLE `announcements` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `date` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `announcements`
--

INSERT INTO `announcements` (`id`, `title`, `content`, `date`) VALUES
(1, 'Welcome to INES PRO!', 'We are excited to launch the official student commerce platform. Start trading today!', '2026-03-06 14:35:46'),
(2, 'Upcoming Student Bazaar', 'Join us next Friday at the main hall for the monthly student bazaar and exhibition.', '2026-03-06 14:35:46'),
(3, 'Security Update', 'Please ensure you use strong passwords and never share your login credentials.', '2026-03-06 14:35:46');

-- --------------------------------------------------------

--
-- Table structure for table `cart_items`
--

CREATE TABLE `cart_items` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) DEFAULT 1,
  `added_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cart_items`
--

INSERT INTO `cart_items` (`id`, `user_id`, `product_id`, `quantity`, `added_at`) VALUES
(1, 2, 1, 1, '2026-03-06 12:39:24');

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id` int(11) NOT NULL,
  `sender_id` int(11) DEFAULT NULL,
  `receiver_id` int(11) DEFAULT NULL,
  `subject` varchar(255) DEFAULT NULL,
  `content` text NOT NULL,
  `timestamp` datetime DEFAULT current_timestamp(),
  `status` varchar(50) DEFAULT 'Pending',
  `type` varchar(50) DEFAULT 'Message'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`id`, `sender_id`, `receiver_id`, `subject`, `content`, `timestamp`, `status`, `type`) VALUES
(1, 3, 1, 'Sell', 'I would like to sell my Books', '2026-03-06 15:20:28', 'Read', 'Request');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `total_price` decimal(10,2) NOT NULL,
  `status` varchar(50) DEFAULT 'Pending',
  `notes` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `total_price`, `status`, `notes`, `created_at`) VALUES
(1, 3, 465000.00, 'Pending', '', '2026-03-06 13:15:58'),
(2, 3, 465000.00, 'Approved', '', '2026-03-06 13:23:22'),
(3, 3, 25000.00, 'Pending', '', '2026-03-06 13:23:40');

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `product_name` varchar(255) DEFAULT NULL,
  `quantity` int(11) NOT NULL,
  `price` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`id`, `order_id`, `product_id`, `product_name`, `quantity`, `price`) VALUES
(1, 2, 1, 'Student Laptop', 1, 450000.00),
(2, 2, 3, 'Campus Hoodie', 1, 15000.00),
(3, 3, 2, 'Scientific Calculator', 1, 25000.00);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `price` decimal(10,2) NOT NULL,
  `stock_quantity` int(11) DEFAULT 0,
  `category` varchar(100) DEFAULT NULL,
  `image_url` varchar(2083) DEFAULT NULL,
  `image_path` varchar(500) DEFAULT NULL,
  `seller_id` int(11) DEFAULT NULL,
  `status` varchar(50) DEFAULT 'Published',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `description`, `price`, `stock_quantity`, `category`, `image_url`, `image_path`, `seller_id`, `status`, `created_at`) VALUES
(1, 'Student Laptop', 'High performance laptop for engineering students', 450000.00, 5, 'Electronics', 'https://picsum.photos/seed/laptop/400/400', NULL, NULL, 'Published', '2026-03-06 12:35:46'),
(2, 'Scientific Calculator', 'Advanced FX-991EX for math and science', 25000.00, 20, 'Stationery', 'https://picsum.photos/seed/calc/400/400', NULL, NULL, 'Published', '2026-03-06 12:35:46'),
(3, 'Campus Hoodie', 'Official INES University branded hoodie', 15000.00, 50, 'Apparel', 'https://picsum.photos/seed/hoodie/400/400', NULL, NULL, 'Published', '2026-03-06 12:35:46'),
(5, 'Desk Lamp', 'LED desk lamp with adjustable brightness', 8000.00, 10, 'Electronics', 'https://picsum.photos/seed/lamp/400/400', NULL, NULL, 'Published', '2026-03-06 12:35:46'),
(6, 'Notebook Set', 'Pack of 5 high-quality A4 notebooks', 5000.00, 100, 'Stationery', 'https://picsum.photos/seed/notebook/400/400', NULL, NULL, 'Published', '2026-03-06 12:35:46'),
(7, 'Shoes', 'Good addidas shoes in excellent condition', 20000.00, 1, 'Addidas', '', 'assets/uploads/products/prod_69aad53c7ffe5.jpg', 3, 'Published', '2026-03-06 13:43:00');

-- --------------------------------------------------------

--
-- Table structure for table `product_requests`
--

CREATE TABLE `product_requests` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `category` varchar(100) DEFAULT NULL,
  `image_path` varchar(500) DEFAULT NULL,
  `status` varchar(50) DEFAULT 'Pending',
  `admin_note` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product_requests`
--

INSERT INTO `product_requests` (`id`, `user_id`, `product_name`, `description`, `price`, `category`, `image_path`, `status`, `admin_note`, `created_at`) VALUES
(1, 3, 'Shoes', 'Good addidas shoes in excellent condition', 20000.00, 'Addidas', 'assets/uploads/products/prod_69aad53c7ffe5.jpg', 'Approved', NULL, '2026-03-06 13:23:08');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(50) DEFAULT 'Student',
  `status` varchar(50) DEFAULT 'Active',
  `avatar_url` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `role`, `status`, `avatar_url`, `created_at`) VALUES
(2, 'Alice Student', 'student@ines.com', '$2y$10$gGGix2z4MTBsxPuH4icsguL8KqVxNxyFftvTxAjtpjAxWgsiJOKuu', 'Student', 'Active', 'https://i.pravatar.cc/150?u=alice', '2026-03-06 12:35:46'),
(3, 'Angel Aimee', 'aimeeange09@gmail.com', '$2y$10$/ugHeL1ufz71qGflW1ZdveiM.HtLgBZ8qmioq656AVNQ8GD.svB6G', 'Admin', 'Active', 'https://ui-avatars.com/api/?name=Angel+Aimee&background=random', '2026-03-06 13:15:23'),
(5, 'Johnathan Miller', 'john.m@ines.com', '$2y$10$hOGo0VlJulFYj1QEuMboT.7m8yVJjOBln.yPbMUiwMshltfexxDh2', 'Admin', 'Active', 'https://i.pravatar.cc/150?u=john', '2026-03-06 13:42:44');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `announcements`
--
ALTER TABLE `announcements`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cart_items`
--
ALTER TABLE `cart_items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_requests`
--
ALTER TABLE `product_requests`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `announcements`
--
ALTER TABLE `announcements`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `cart_items`
--
ALTER TABLE `cart_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `product_requests`
--
ALTER TABLE `product_requests`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
