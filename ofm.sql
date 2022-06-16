-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 16, 2022 at 08:54 PM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 7.4.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ofm`
--

-- --------------------------------------------------------

--
-- Table structure for table `deliveries`
--

CREATE TABLE `deliveries` (
  `delivery_id` int(100) NOT NULL,
  `delivery_person_id` int(100) DEFAULT NULL,
  `order_id` int(100) NOT NULL,
  `delivery_status` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `deliveries`
--

INSERT INTO `deliveries` (`delivery_id`, `delivery_person_id`, `order_id`, `delivery_status`) VALUES
(1, 3, 1, 'confirmed'),
(2, 3, 2, 'confirmed'),
(3, 3, 3, 'confirmed'),
(4, 3, 5, 'rejected'),
(5, 3, 6, 'confirmed'),
(6, 3, 10, 'accepted'),
(7, 3, 11, 'assigned'),
(8, 3, 12, 'confirmed'),
(9, NULL, 14, 'unassigned');

-- --------------------------------------------------------

--
-- Table structure for table `delivery_persons`
--

CREATE TABLE `delivery_persons` (
  `id` int(100) NOT NULL,
  `user_id` int(100) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `shop_id` int(100) NOT NULL,
  `is_deleted` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `delivery_persons`
--

INSERT INTO `delivery_persons` (`id`, `user_id`, `first_name`, `last_name`, `shop_id`, `is_deleted`) VALUES
(1, 3, 'Dinuka', 'Nuwan', 1, 0),
(2, 8, 'Deshan', 'Wickramasinghe', 1, 0),
(3, 3, 'Dinuka', 'Nuwan', 5, 0);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` int(100) NOT NULL,
  `order_type` varchar(50) DEFAULT NULL,
  `user_id` int(100) NOT NULL,
  `shop_id` int(100) NOT NULL,
  `delivery_id` int(100) DEFAULT NULL,
  `total_price` int(100) NOT NULL,
  `order_status` varchar(50) NOT NULL,
  `rating` int(11) DEFAULT NULL,
  `visibility` varchar(10) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `order_type`, `user_id`, `shop_id`, `delivery_id`, `total_price`, `order_status`, `rating`, `visibility`) VALUES
(1, NULL, 7, 1, 1, 450, 'closed', NULL, 'hidden'),
(3, NULL, 2, 1, 3, 200, 'cancelled', NULL, 'hidden'),
(2, NULL, 7, 1, 2, 350, 'closed', NULL, 'hidden'),
(4, NULL, 8, 3, 0, 555, 'closed', NULL, 'hidden'),
(5, NULL, 8, 1, 4, 335, 'closed', NULL, 'hidden'),
(7, NULL, 8, 1, 0, 535, 'cancelled', NULL, 'hidden'),
(6, NULL, 8, 1, 5, 370, 'cancelled', NULL, 'hidden'),
(8, NULL, 8, 1, 0, 850, 'cancelled', NULL, 'hidden'),
(9, NULL, 8, 1, 0, 533, 'pending', NULL, 'visible'),
(10, NULL, 8, 5, 6, 310, 'ondelivery', NULL, 'visible'),
(11, NULL, 8, 1, 7, 610, 'assigned', NULL, 'visible'),
(12, NULL, 10, 1, 8, 475, 'cancelled', NULL, 'hidden'),
(13, NULL, 1, 1, 0, 469, 'cancelled', NULL, 'hidden'),
(14, NULL, 1, 1, 0, 1263, 'unassigned', NULL, 'visible');

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `order_id` int(100) NOT NULL,
  `order_item_id` int(100) NOT NULL,
  `shop_item_id` int(100) NOT NULL,
  `shop_item_name` varchar(100) NOT NULL,
  `quantity` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`order_id`, `order_item_id`, `shop_item_id`, `shop_item_name`, `quantity`) VALUES
(1, 1, 1, 'Carrot', 1),
(1, 2, 2, 'Potatoes', 1),
(2, 3, 1, 'Carrot', 1),
(2, 4, 2, 'Potatoes', 0.5),
(3, 5, 2, 'Potatoes', 1),
(4, 6, 3, 'Bombay Onions', 1),
(4, 7, 19, 'Carrot', 1),
(5, 8, 2, 'Potatoes', 1),
(5, 9, 3, 'Bombay Onions', 0.5),
(6, 10, 2, 'Potatoes', 0.5),
(6, 11, 3, 'Bombay Onions', 1),
(7, 12, 2, 'Potatoes', 2),
(7, 13, 3, 'Bombay Onions', 0.5),
(8, 14, 2, 'Potatoes', 1),
(8, 15, 1, 'Carrot', 0.5),
(8, 16, 7, 'Pumkin', 0.5),
(8, 17, 11, 'Tomatoes', 0.25),
(8, 18, 4, 'Green Chillies', 0.25),
(8, 19, 8, 'Green Beans', 1),
(9, 20, 3, 'Bombay Onions', 1),
(9, 21, 2, 'Potatoes', 1),
(9, 22, 1, 'Carrot', 0.25),
(10, 23, 20, 'Carrot', 0.5),
(10, 24, 21, 'Gereen Beans', 0.25),
(10, 25, 22, 'Capsicum', 0.5),
(11, 26, 5, 'Cabbage', 0.5),
(11, 27, 6, 'Bell Pepper', 0.25),
(11, 28, 9, 'Beat Root', 0.25),
(11, 29, 17, 'Salad Leaves', 0.25),
(11, 30, 8, 'Green Beans', 0.5),
(11, 31, 7, 'Pumkin', 0.25),
(12, 32, 4, 'Green Chillies', 0.25),
(12, 33, 1, 'Carrot', 0.5),
(12, 34, 3, 'Bombay Onions', 1),
(13, 35, 1, 'Carrot', 0.5),
(13, 36, 8, 'Green Beans', 0.25),
(13, 37, 3, 'Bombay Onions', 1),
(14, 38, 1, 'Carrot', 0.25),
(14, 39, 6, 'Bell Pepper', 0.5),
(14, 40, 17, 'Salad Leaves', 2);

-- --------------------------------------------------------

--
-- Table structure for table `requests`
--

CREATE TABLE `requests` (
  `request_id` int(100) NOT NULL,
  `shop_id` int(100) NOT NULL,
  `shop_name` varchar(100) NOT NULL,
  `user_id` int(100) NOT NULL,
  `status` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `requests`
--

INSERT INTO `requests` (`request_id`, `shop_id`, `shop_name`, `user_id`, `status`) VALUES
(1, 1, 'ABC Food City', 3, 'accepted'),
(2, 1, 'ABC Food City', 3, 'accepted'),
(3, 1, 'ABC Food City', 8, 'accepted'),
(4, 5, 'ABC Food City', 3, 'accepted'),
(5, 5, 'ABC Food City', 3, 'rejected');

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `review_id` int(100) NOT NULL,
  `custoemr_id` int(100) NOT NULL,
  `shop_id` int(100) NOT NULL,
  `status` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `shops`
--

CREATE TABLE `shops` (
  `shop_id` int(100) NOT NULL,
  `shop_name` varchar(100) NOT NULL,
  `address` varchar(100) NOT NULL,
  `district` varchar(50) NOT NULL,
  `close_town` varchar(50) NOT NULL,
  `mobile_no` varchar(50) DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  `image` varchar(100) DEFAULT NULL,
  `description` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `shops`
--

INSERT INTO `shops` (`shop_id`, `shop_name`, `address`, `district`, `close_town`, `mobile_no`, `user_id`, `image`, `description`) VALUES
(1, 'One Stop Vegetable Stores', '36/9, New Lane, Makuluwa, Galle.', 'Galle', 'Galle-City', '0769057267', 1, '202212174725ABC Stores.jpg', 'Fresh vegetables'),
(2, 'Galle Vegetable Store', 'No.50, Vegetable Market, Galle. ', 'Galle', 'Galle-City', '0772880694', 4, '2022121105946Galle Vegetable Store.jpg', ''),
(3, 'Harvest Home', 'No.51, Vegetable Market, Galle. ', 'Galle', 'Galle-City', '0774521475', 5, '202212111620One Stop Vegetable Store.jpg', ''),
(5, 'Grower’s Paradise', 'No.52, Vegetable Market, Galle.', 'Galle', 'Galle-City', '0712564567', 9, '2022313153451Grower’s Paradise.jpg', 'A paradise of fresh vegetables');

-- --------------------------------------------------------

--
-- Table structure for table `shop_items`
--

CREATE TABLE `shop_items` (
  `item_id` int(100) NOT NULL,
  `item_name` varchar(50) NOT NULL,
  `unit_price` double NOT NULL,
  `quantity` float NOT NULL,
  `is_available` varchar(50) NOT NULL,
  `shop_id` int(100) NOT NULL,
  `image` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `shop_items`
--

INSERT INTO `shop_items` (`item_id`, `item_name`, `unit_price`, `quantity`, `is_available`, `shop_id`, `image`) VALUES
(1, 'Carrot', 250, 21.75, 'in stock', 1, '202212183617.jpeg'),
(2, 'Potatoes', 200, 17.25, 'in stock', 1, '202212184111.jpeg'),
(3, 'Bombay Onions', 270, 19.5, 'in stock', 1, '20221219921.jpeg'),
(4, 'Green Chillies', 320, 19.75, 'in stock', 1, '20221219107.jpeg'),
(5, 'Cabbage', 290, 24.5, 'in stock', 1, '202212191150.jpeg'),
(6, 'Bell Pepper', 320, 14.25, 'in stock', 1, '202212191329.jpeg'),
(7, 'Pumkin', 190, 19.75, 'in stock', 1, '202212191557.jpeg'),
(8, 'Green Beans', 295, 24.5, 'in stock', 1, '202212191732.jpeg'),
(9, 'Beat Root', 240, 24.75, 'in stock', 1, '20221219196.jpeg'),
(10, 'Raddish', 200, 15, 'in stock', 1, '202212192028.jpeg'),
(11, 'Tomatoes', 220, 15, 'in stock', 1, '202212192241.jpeg'),
(12, 'Cauliflower', 1190, 25, 'in stock', 1, '202212192613.jpeg'),
(13, 'Garlic', 650, 20, 'in stock', 1, '202212192818.jpeg'),
(14, 'Green Cucumber', 630, 15, 'in stock', 1, '20221219361.jpeg'),
(15, 'Leaks', 650, 20, 'in stock', 1, '202212193721.jpeg'),
(16, 'Red Chillies', 200, 15, 'in stock', 1, '2022121123426.jpeg'),
(17, 'Salad Leaves', 520, 7.75, 'in stock', 1, '2022121143757.jpeg'),
(18, 'Bitter Guard', 370, 25, 'in stock', 1, '2022121144936.jpeg'),
(19, 'Carrot', 285, 1, 'in stock', 3, '202212115369.'),
(20, 'Carrot', 285, 24.5, 'in stock', 5, '202231316832.jpeg'),
(21, 'Gereen Beans', 290, 19.75, 'in stock', 5, '202231316924.jpeg'),
(22, 'Capsicum', 190, 19.5, 'in stock', 5, '2022313161023.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(100) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `address` varchar(100) NOT NULL,
  `district` varchar(50) NOT NULL,
  `close_town` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `mobile_no` varchar(10) NOT NULL,
  `registered_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `last_login` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `acc_type` varchar(50) NOT NULL,
  `shop_id` varchar(50) NOT NULL,
  `image` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `first_name`, `last_name`, `address`, `district`, `close_town`, `email`, `password`, `mobile_no`, `registered_date`, `last_login`, `acc_type`, `shop_id`, `image`) VALUES
(1, 'Deshan', 'Lakshitha', '36/9, New Lane, Makuluwa, Galle.', 'Galle', 'Galle-City', 'deshanlakshithawickramasinghe@gmail.com', '$2y$10$btcrtiYDy0u/LVwXbrdX3O/kzm41luQgu53Gt0ETAzq0GUgSrftv2', '0769057267', '2022-05-18 06:10:34', '0000-00-00 00:00:00', 'seller', '1', ''),
(2, 'Jalitha', 'Kalsara', 'Godamaga, Talpe.', 'Galle', 'Galle-City', 'jalitha@gmail.com', '$2y$10$tMwEh3zO55oyGygmMKscQO/HEpUDMdnLtySf7gvJidPnV/R5VrpoO', '0774144558', '2022-01-21 14:00:12', '0000-00-00 00:00:00', 'customer', '', ''),
(3, 'Dinuka', 'Nuwan', 'No.20, Udugama Road, Makuluwa, Galle.', 'Galle', 'Galle-City', 'dinuka@gmail.com', '$2y$10$.Nf.CiqxY9daFHRNp1GEf.BW5g5at/v1geSF4WGFGLY4E0khK1mmG', '0719618085', '2022-01-21 10:15:40', '0000-00-00 00:00:00', 'delivery_person', '', ''),
(4, 'Kasun', 'Isuranga', 'Baddegama Road, Hikkaduwa', 'Galle', 'Hikkaduwa', 'kasun@gmail.com', '$2y$10$6cNvLd1QD0re6bGMTo5Tu.bQcPBNqeJPaCmJf0Xjox0nx8EcGa8IC', '0772880694', '2022-01-21 09:59:46', '0000-00-00 00:00:00', 'seller', '2', ''),
(5, 'Seller', 'One', 'No.24, Galle Road, Baddegama.', 'Galle', 'Baddegama', 'sellerone@gmail.com', '$2y$10$7m.kkOeuDmaBjRPcQNu3.e0SMU1xmf8zocdkgTs4QXIjiOvvB/uAe', '0774521475', '2022-01-21 10:06:20', '0000-00-00 00:00:00', 'seller', '3', ''),
(6, 'Seller', 'Two', 'No.40, Pedlar Street, Fort, Galle.', 'Galle', 'Galle-City', 'sellertwo@gmail.com', '$2y$10$XFTDLBaxxz93KAqNDV9BgORvrYNCmHF3KSrMti.9UmrxSLn5PYFFu', '0712569588', '2022-03-13 15:22:14', '0000-00-00 00:00:00', 'customer', '', ''),
(7, 'Ayesh', 'Vininda', 'Walipatha, Galle.', 'Galle', 'Galle-City', 'ayesh@gmail.com', '$2y$10$Kt5ZNp2GP0/l7JCjB.pN.u21D.li8HQblUDWehv/.RJ8DjeV82dIC', '0771234567', '2022-01-21 10:32:05', '0000-00-00 00:00:00', 'customer', '', ''),
(8, 'Deshan', 'Wickramasinghe', 'Udugama, Galle.', 'Galle', 'Galle-City', 'deshan@gmail.com', '$2y$10$YRSbgH.OCA5JWlTMUuutje8Cdd6/WZkx5Y2EK0Ie0Fs6a8E6KlyjS', '0774144586', '2022-02-02 10:39:28', '0000-00-00 00:00:00', 'delivery_person', '', ''),
(9, 'Seller', 'Three', 'Baddegama Road, Beligaha Junction, Galle', 'Galle', 'Galle-City', 'sellerthree@gmail.com', '$2y$10$z5JDy8u7LhaAAFGaQX24teFIy6M0p/ITsfnYIlOl16HG7wdjS3WzC', '0712564567', '2022-03-13 14:34:51', '0000-00-00 00:00:00', 'seller', '5', ''),
(10, 'Angelo', 'Mathews', 'No.52, Lotus Street, Colombo 3', 'Colombo', 'Colombo Fort', 'angelo@gmail.com', '$2y$10$q.2/hGYOe415xmX6VghS5OVWnS0Ux6Rl/3wKaMwhJl9GmmeRGgmUi', '0774526369', '2022-05-16 17:38:51', '0000-00-00 00:00:00', 'customer', '', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `deliveries`
--
ALTER TABLE `deliveries`
  ADD PRIMARY KEY (`delivery_id`);

--
-- Indexes for table `delivery_persons`
--
ALTER TABLE `delivery_persons`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `orders_fk0` (`user_id`),
  ADD KEY `orders_fk1` (`shop_id`),
  ADD KEY `orders_fk2` (`delivery_id`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`order_item_id`),
  ADD KEY `order_items_fk0` (`shop_item_id`);

--
-- Indexes for table `requests`
--
ALTER TABLE `requests`
  ADD PRIMARY KEY (`request_id`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`review_id`),
  ADD KEY `reviews_fk0` (`custoemr_id`),
  ADD KEY `reviews_fk1` (`shop_id`);

--
-- Indexes for table `shops`
--
ALTER TABLE `shops`
  ADD PRIMARY KEY (`shop_id`),
  ADD KEY `shops_fk0` (`user_id`);

--
-- Indexes for table `shop_items`
--
ALTER TABLE `shop_items`
  ADD PRIMARY KEY (`item_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `deliveries`
--
ALTER TABLE `deliveries`
  MODIFY `delivery_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `delivery_persons`
--
ALTER TABLE `delivery_persons`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `order_item_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `requests`
--
ALTER TABLE `requests`
  MODIFY `request_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `review_id` int(100) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `shops`
--
ALTER TABLE `shops`
  MODIFY `shop_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `shop_items`
--
ALTER TABLE `shop_items`
  MODIFY `item_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `order_items_fk0` FOREIGN KEY (`shop_item_id`) REFERENCES `shop_items` (`item_id`);

--
-- Constraints for table `reviews`
--
ALTER TABLE `reviews`
  ADD CONSTRAINT `reviews_fk0` FOREIGN KEY (`custoemr_id`) REFERENCES `users` (`user_id`),
  ADD CONSTRAINT `reviews_fk1` FOREIGN KEY (`shop_id`) REFERENCES `shops` (`shop_id`);

--
-- Constraints for table `shops`
--
ALTER TABLE `shops`
  ADD CONSTRAINT `shops_fk0` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
