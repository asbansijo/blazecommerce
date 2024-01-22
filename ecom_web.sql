-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 14, 2023 at 08:43 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ecom_web`
--

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `Id` int(11) NOT NULL,
  `category_name` varchar(120) NOT NULL,
  `category_image` varchar(250) NOT NULL,
  `category_status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`Id`, `category_name`, `category_image`, `category_status`) VALUES
(1, 'Mobiles', '../images/65681d50ceb06.png', 1),
(2, 'Electronics', '../images/65681fb97be6e.jpg', 1),
(3, 'Laptops', '../images/65681d8e32cfa.png', 1),
(4, 'Tablet', '../images/65681da37c5a3.png', 1),
(5, 'Computers', '../images/65681db69bb6a.png', 1),
(6, 'Furniture', '../images/6568205aec9b2.png', 1),
(7, 'Fashion', '../images/65681dd66eca2.png', 1),
(8, 'Footwears', '../images/65681e939598a.png', 1),
(9, 'Appliances', '../images/6568227e9d582.png', 1);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `product_id` int(11) NOT NULL,
  `category_id` varchar(20) NOT NULL,
  `product_title` varchar(200) NOT NULL,
  `product_description` varchar(250) NOT NULL,
  `product_price` varchar(20) NOT NULL,
  `product_img` varchar(250) NOT NULL,
  `product_details` varchar(250) NOT NULL,
  `offers` varchar(10) NOT NULL,
  `rating` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`product_id`, `category_id`, `product_title`, `product_description`, `product_price`, `product_img`, `product_details`, `offers`, `rating`) VALUES
(1, '1', 'iphone 13', 'Apple iphone 13 128GB', 'Rs. 69,000', 'apple12.png', 'Specification', '', ''),
(2, '2', 'Airpods', 'Apple Airpods (Black)', 'Rs. 32,000', '../images/6568231ded21d.png', 'Specification', '', ''),
(3, '7', 'T-shirt full sleeve', 'Blazing T-shirts, Blue, Full sleeve', 'Rs. 1,200', '../images/656823711e75c.png', '100% cotton', '', ''),
(4, '8', 'Nike Air max', 'Nike Air max, sports shoe, Blue', 'Rs.  2,999', '../images/656823c51ec41.png', 'Details', '', ''),
(5, '2', 'Airpods max', 'Apple Airpods max (smoky silver)', 'Rs. 45,000', '../images/6568259dbe506.png', 'Specification', '', ''),
(6, '6', 'sofa', 'premium sofa', 'Rs. 12,000', '../images/6568260f188ad.png', 'Details', '', ''),
(7, '5', 'MacMini', 'Apple MacMini', 'Rs. 80,999', '../images/65683e21eff22.png', 'Specification', '', ''),
(8, '3', 'Macbook Pro M2', 'Apple MacBook pro M2 (matt Black)', 'Rs. 1,70,000', '../images/65683e845adf3.png', 'Specification', '', ''),
(9, '9', 'Samsung curve tv', 'Samsung curve tv UHD 32 inch', 'Rs. 22,000', '../images/656850ff4586e.png', 'Details', '', ''),
(10, '9', 'Haier Fridge 300L', 'Haier Fridge 300L, Silver Door', 'Rs. 81,999', '../images/656851a05bc57.png', 'Details', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `mobile` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `user_type` varchar(200) NOT NULL DEFAULT 'user',
  `otp` int(50) NOT NULL,
  `verification` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `mobile`, `email`, `user_type`, `otp`, `verification`) VALUES
(1, 'sijo', 2147483647, 'asban.sijo@gmail.com', 'user', 948020, ''),
(2, 'as', 2147483647, 'sasijothoma22@gmail.com', 'user', 490771, ''),
(3, 'siva', 2147483647, 'mailtoshiva84@gmail.com', 'user', 821049, '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
