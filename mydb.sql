-- phpMyAdmin SQL Dump
-- version 4.4.1.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Apr 18, 2015 at 04:14 AM
-- Server version: 5.6.12
-- PHP Version: 5.5.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `mydb`
--

-- --------------------------------------------------------

--
-- Table structure for table `Customers`
--

CREATE TABLE IF NOT EXISTS `Customers` (
  `customer_id` int(11) NOT NULL,
  `name` varchar(60) NOT NULL,
  `email` varchar(60) NOT NULL,
  `password` varchar(60) NOT NULL,
  `phone` varchar(45) DEFAULT NULL,
  `membership_id` int(11) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `Customers`
--

INSERT INTO `Customers` (`customer_id`, `name`, `email`, `password`, `phone`, `membership_id`) VALUES
(1, 'admin', 'admin@admin.com', '21232f297a57a5a743894a0e4a801fc3', '0000000000', 2),
(3, 'Tuo Lei', 'leituo56@gmail.com', '', '5105796938', 1),
(4, 'aaa', 'leituo100@gmail.com', '0b4e7a0e5fe84ad35fb5f95b9ceeac79', NULL, NULL),
(5, 'bbb', 'bbb@bbb.com', '875f26fdb1cecf20ceb4ca028263dec6', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `Deliveries`
--

CREATE TABLE IF NOT EXISTS `Deliveries` (
  `delivery_id` int(11) NOT NULL,
  `address` varchar(100) NOT NULL,
  `phone` varchar(45) DEFAULT NULL,
  `delivery_boy_id` int(11) DEFAULT NULL,
  `status` varchar(45) DEFAULT NULL,
  `zip_code` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `Deliveries`
--

INSERT INTO `Deliveries` (`delivery_id`, `address`, `phone`, `delivery_boy_id`, `status`, `zip_code`) VALUES
(9, 'IRS Dept', '1233211132', 1, 'assigned', NULL),
(10, '400 S 13th St', '4123132421', 2, 'assigned', NULL),
(11, '123 Road', '4232131423', 2, 'assigned', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `DeliveryBoys`
--

CREATE TABLE IF NOT EXISTS `DeliveryBoys` (
  `delivery_boy_id` int(11) NOT NULL,
  `name` varchar(45) DEFAULT NULL,
  `phone` varchar(45) DEFAULT NULL,
  `zip_code` int(11) DEFAULT NULL,
  `restaurant_id` int(11) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `DeliveryBoys`
--

INSERT INTO `DeliveryBoys` (`delivery_boy_id`, `name`, `phone`, `zip_code`, `restaurant_id`) VALUES
(1, 'Jim', '1233211132', 95112, 1),
(2, 'Tuo Lei', '5105796938', 95112, 1);

-- --------------------------------------------------------

--
-- Table structure for table `Items`
--

CREATE TABLE IF NOT EXISTS `Items` (
  `item_id` int(11) NOT NULL,
  `name` varchar(45) NOT NULL,
  `price` decimal(9,2) NOT NULL,
  `category` varchar(45) DEFAULT NULL,
  `restaurant_id` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `Items`
--

INSERT INTO `Items` (`item_id`, `name`, `price`, `category`, `restaurant_id`) VALUES
(1, '&#27833;&#27900;&#38754;', '8.99', 'entry', 3),
(2, '&#32905;&#22841;&#39309;', '3.99', 'entry', 3),
(3, '&#21487;&#20048;', '1.99', 'drink', 3),
(4, 'Double Double', '6.99', 'entry', 1),
(5, 'Cheese Burger', '5.99', 'entry', 1),
(6, 'Franch Fries', '1.99', 'sides', 1),
(7, 'Coke', '1.59', 'drink', 1),
(8, 'Famous Bowl', '5.69', 'entry', 2),
(9, 'Sprite', '1.99', 'drink', 2),
(10, 'Fried Chicken', '2.99', 'entry', 2);

-- --------------------------------------------------------

--
-- Table structure for table `Memberships`
--

CREATE TABLE IF NOT EXISTS `Memberships` (
  `membership_id` int(11) NOT NULL,
  `name` varchar(45) NOT NULL,
  `amount` decimal(9,2) NOT NULL,
  `discount` float DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `Memberships`
--

INSERT INTO `Memberships` (`membership_id`, `name`, `amount`, `discount`) VALUES
(1, 'silver', '50.00', 0.05),
(2, 'gold', '100.00', 0.1);

-- --------------------------------------------------------

--
-- Table structure for table `Orders`
--

CREATE TABLE IF NOT EXISTS `Orders` (
  `order_id` int(11) NOT NULL,
  `restaurant_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `raw_price` decimal(9,2) DEFAULT NULL,
  `real_price` decimal(9,2) DEFAULT NULL,
  `is_dine_in` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `Orders`
--

INSERT INTO `Orders` (`order_id`, `restaurant_id`, `customer_id`, `raw_price`, `real_price`, `is_dine_in`, `created_at`) VALUES
(1, 3, 1, '10.20', '12.11', 1, '2015-04-11 22:10:00'),
(4, 3, 1, '46.92', '51.61', 1, '2015-04-12 02:01:06'),
(5, 3, 1, '5.97', '6.57', 1, '2015-04-12 05:09:28'),
(6, 1, 1, '10.57', '11.63', 1, '2015-04-12 05:35:27'),
(7, 3, 1, '22.94', '25.23', 1, '2015-04-14 23:13:38'),
(8, 3, 1, '14.97', '16.47', 1, '2015-04-17 20:23:02'),
(9, 2, 1, '4.98', '5.98', 1, '2015-04-17 20:30:31'),
(10, 2, 1, '10.67', '12.80', 1, '2015-04-18 03:49:01'),
(11, 1, 5, '9.57', '10.53', 1, '2015-04-18 03:51:19');

-- --------------------------------------------------------

--
-- Table structure for table `Order_Item`
--

CREATE TABLE IF NOT EXISTS `Order_Item` (
  `order_id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `qty` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `Order_Item`
--

INSERT INTO `Order_Item` (`order_id`, `item_id`, `qty`) VALUES
(1, 2, 1),
(1, 3, 2),
(4, 1, 3),
(4, 2, 5),
(5, 3, 3),
(6, 4, 1),
(6, 6, 1),
(6, 7, 1),
(7, 1, 1),
(7, 2, 2),
(7, 3, 3),
(8, 1, 1),
(8, 2, 1),
(8, 3, 1),
(9, 9, 1),
(9, 10, 1),
(10, 8, 1),
(10, 9, 1),
(10, 10, 1),
(11, 5, 1),
(11, 6, 1),
(11, 7, 1);

-- --------------------------------------------------------

--
-- Table structure for table `Restaurants`
--

CREATE TABLE IF NOT EXISTS `Restaurants` (
  `restaurant_id` int(11) NOT NULL,
  `name` varchar(45) NOT NULL,
  `address` varchar(45) DEFAULT NULL,
  `phone` varchar(45) DEFAULT NULL,
  `description` varchar(45) DEFAULT NULL,
  `sales_tax_rate` float DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `Restaurants`
--

INSERT INTO `Restaurants` (`restaurant_id`, `name`, `address`, `phone`, `description`, `sales_tax_rate`) VALUES
(1, 'In and Out', '1234 abc st, San Jose, CA, 95112', '1234567890', 'burgers', 0.1),
(2, 'KFC', '1123 xyz st, San Jose, CA, 95112', '1242345231', 'burgers', 0.2),
(3, '&#19977;&#22909;&#25289;&#38754;', '&#22823;&#21326;', '1234132132', '', 0.1),
(4, 'Aloha', 'NO address', '1233211132', '', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `Customers`
--
ALTER TABLE `Customers`
  ADD PRIMARY KEY (`customer_id`),
  ADD UNIQUE KEY `email_UNIQUE` (`email`),
  ADD KEY `membership_id_idx` (`membership_id`);

--
-- Indexes for table `Deliveries`
--
ALTER TABLE `Deliveries`
  ADD PRIMARY KEY (`delivery_id`),
  ADD KEY `delievery_boy_id_idx` (`delivery_boy_id`);

--
-- Indexes for table `DeliveryBoys`
--
ALTER TABLE `DeliveryBoys`
  ADD PRIMARY KEY (`delivery_boy_id`),
  ADD KEY `restaurant_id_idx` (`restaurant_id`);

--
-- Indexes for table `Items`
--
ALTER TABLE `Items`
  ADD PRIMARY KEY (`item_id`),
  ADD KEY `restaurant_id_idx` (`restaurant_id`);

--
-- Indexes for table `Memberships`
--
ALTER TABLE `Memberships`
  ADD PRIMARY KEY (`membership_id`);

--
-- Indexes for table `Orders`
--
ALTER TABLE `Orders`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `fk_Orders_Restaurants1_idx` (`restaurant_id`),
  ADD KEY `fk_Orders_Customers1_idx` (`customer_id`);

--
-- Indexes for table `Order_Item`
--
ALTER TABLE `Order_Item`
  ADD PRIMARY KEY (`order_id`,`item_id`),
  ADD KEY `fk_Orders_has_Items_Items1_idx` (`item_id`),
  ADD KEY `fk_Orders_has_Items_Orders1_idx` (`order_id`);

--
-- Indexes for table `Restaurants`
--
ALTER TABLE `Restaurants`
  ADD PRIMARY KEY (`restaurant_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `Customers`
--
ALTER TABLE `Customers`
  MODIFY `customer_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `DeliveryBoys`
--
ALTER TABLE `DeliveryBoys`
  MODIFY `delivery_boy_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `Items`
--
ALTER TABLE `Items`
  MODIFY `item_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `Memberships`
--
ALTER TABLE `Memberships`
  MODIFY `membership_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `Orders`
--
ALTER TABLE `Orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `Restaurants`
--
ALTER TABLE `Restaurants`
  MODIFY `restaurant_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `Customers`
--
ALTER TABLE `Customers`
  ADD CONSTRAINT `membership_id` FOREIGN KEY (`membership_id`) REFERENCES `Memberships` (`membership_id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `Deliveries`
--
ALTER TABLE `Deliveries`
  ADD CONSTRAINT `delievery_boy_id` FOREIGN KEY (`delivery_boy_id`) REFERENCES `DeliveryBoys` (`delivery_boy_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Deliveries_Orders1` FOREIGN KEY (`delivery_id`) REFERENCES `Orders` (`order_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `DeliveryBoys`
--
ALTER TABLE `DeliveryBoys`
  ADD CONSTRAINT `fk_delivery_restaurants` FOREIGN KEY (`restaurant_id`) REFERENCES `Restaurants` (`restaurant_id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `Items`
--
ALTER TABLE `Items`
  ADD CONSTRAINT `restaurant_id` FOREIGN KEY (`restaurant_id`) REFERENCES `Restaurants` (`restaurant_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `Orders`
--
ALTER TABLE `Orders`
  ADD CONSTRAINT `fk_Orders_Customers1` FOREIGN KEY (`customer_id`) REFERENCES `Customers` (`customer_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Orders_Restaurants1` FOREIGN KEY (`restaurant_id`) REFERENCES `Restaurants` (`restaurant_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `Order_Item`
--
ALTER TABLE `Order_Item`
  ADD CONSTRAINT `fk_Orders_has_Items_Items1` FOREIGN KEY (`item_id`) REFERENCES `Items` (`item_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Orders_has_Items_Orders1` FOREIGN KEY (`order_id`) REFERENCES `Orders` (`order_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
