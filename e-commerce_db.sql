-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Nov 29, 2023 at 06:32 AM
-- Server version: 8.0.31
-- PHP Version: 8.0.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `e-commerce_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

DROP TABLE IF EXISTS `customers`;
CREATE TABLE IF NOT EXISTS `customers` (
  `customer_id` int NOT NULL AUTO_INCREMENT,
  `fname` varchar(10) NOT NULL,
  `lname` varchar(10) NOT NULL,
  `email` varchar(30) NOT NULL,
  `password` varchar(15) NOT NULL,
  `gender` varchar(7) NOT NULL,
  `DOB` varchar(20) NOT NULL,
  `country` varchar(20) NOT NULL,
  `city` varchar(20) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `address` varchar(40) NOT NULL,
  PRIMARY KEY (`customer_id`),
  UNIQUE KEY `unique_column` (`email`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`customer_id`, `fname`, `lname`, `email`, `password`, `gender`, `DOB`, `country`, `city`, `phone`, `address`) VALUES
(1, 'Jane', 'Doe', 'jane@gmail.com', '$2y$10$CQ.qS5Hb', 'Female', '2004-07-18', 'Kenya', 'Nairobi', '0702567783', '483-20303'),
(2, 'Jane', 'Wanjohi', 'jan@gmail.com', '$2y$10$gxyiKkjk', 'male', '2023-11-18', 'Kenya', 'Nairobi', '0114403621', '483-20303'),
(3, 'Alex', 'Wanjohi', 'alexwanjohi55@gmail.com', '$2y$10$m8U7do7I', 'male', '2002-08-23', 'Kenya', 'Nairobi', '0702567783', '483-20303');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

DROP TABLE IF EXISTS `orders`;
CREATE TABLE IF NOT EXISTS `orders` (
  `order_id` int NOT NULL AUTO_INCREMENT,
  `customer_id` int NOT NULL,
  `total_price` float NOT NULL,
  `order_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`order_id`)
) ENGINE=MyISAM AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `customer_id`, `total_price`, `order_date`) VALUES
(1, 1, 45000, '2023-11-25 18:28:15'),
(2, 1, 45000, '2023-11-25 18:45:36'),
(3, 1, 45000, '2023-11-25 18:47:23'),
(4, 1, 45000, '2023-11-25 18:54:22'),
(5, 1, 0, '2023-11-25 19:17:46'),
(6, 1, 20000, '2023-11-25 19:23:24'),
(7, 1, 73000, '2023-11-25 20:46:38'),
(8, 1, 57000, '2023-11-25 20:47:37'),
(9, 1, 33000, '2023-11-26 10:05:23'),
(10, 1, 33000, '2023-11-26 10:10:36'),
(11, 1, 100000, '2023-11-26 19:01:37'),
(12, 1, 19000, '2023-11-26 21:10:39'),
(13, 1, 25000, '2023-11-26 21:20:58'),
(14, 1, 19000, '2023-11-26 22:12:50'),
(15, 1, 45000, '2023-11-27 08:20:47'),
(16, 1, 26000, '2023-11-27 08:24:17');

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

DROP TABLE IF EXISTS `order_items`;
CREATE TABLE IF NOT EXISTS `order_items` (
  `order_id` int NOT NULL,
  `pid` int NOT NULL,
  `pquantity` int NOT NULL,
  `price` decimal(10,0) NOT NULL,
  PRIMARY KEY (`order_id`,`pid`),
  KEY `fk_oder_items` (`pid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`order_id`, `pid`, `pquantity`, `price`) VALUES
(0, 6, 1, '20000'),
(0, 12, 1, '45000'),
(4, 9, 1, '45000'),
(5, 3, 1, '45'),
(6, 6, 1, '20000'),
(7, 7, 1, '40000'),
(7, 13, 1, '33000'),
(8, 8, 1, '32000'),
(8, 1, 1, '25000'),
(9, 13, 1, '33000'),
(10, 13, 1, '33000'),
(11, 4, 1, '26000'),
(11, 5, 1, '30000'),
(11, 1, 1, '25000'),
(11, 3, 1, '19000'),
(12, 3, 1, '19000'),
(13, 1, 1, '25000'),
(14, 3, 1, '19000'),
(15, 3, 1, '19000'),
(15, 4, 1, '26000'),
(16, 4, 1, '26000');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

DROP TABLE IF EXISTS `products`;
CREATE TABLE IF NOT EXISTS `products` (
  `pid` int NOT NULL AUTO_INCREMENT,
  `pname` varchar(15) NOT NULL,
  `pdescription` text NOT NULL,
  `pprice` varchar(6) NOT NULL,
  `pimage` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `pdiscount` varchar(6) DEFAULT NULL,
  PRIMARY KEY (`pid`)
) ENGINE=MyISAM AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`pid`, `pname`, `pdescription`, `pprice`, `pimage`, `pdiscount`) VALUES
(1, 'Dell E5500', '8GB RAM 512GB SSD 2.9GHz with backlit keyboard', '25000', 'images/Dell_E5500.jpg', '27000'),
(3, 'Lenovo T440', 'Refurbished, intel core i5, 8gb RAM 128GB SSD', '19000', 'images/Lenovo_T440.jpg', '22000'),
(4, 'HP EliteBook', '840 REFURBISHED, GEN 1 intel core i5 14', '26000', 'images/1(0).jpg', '30000'),
(16, 'mouse', 'refurbished intel core i5 8GB RAM 500GB hdd 14\" 2.5GHz', '30000', 'images/Hp_Elitebook.jpg', '34999');

-- --------------------------------------------------------

--
-- Table structure for table `shipments`
--

DROP TABLE IF EXISTS `shipments`;
CREATE TABLE IF NOT EXISTS `shipments` (
  `shipment_id` int NOT NULL AUTO_INCREMENT,
  `fname` varchar(10) NOT NULL,
  `lname` varchar(10) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `county` varchar(15) NOT NULL,
  `pickup_station` varchar(30) NOT NULL,
  `payment_method` varchar(10) NOT NULL,
  `postal_code` varchar(15) NOT NULL,
  `order_id` int NOT NULL,
  PRIMARY KEY (`shipment_id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `shipments`
--

INSERT INTO `shipments` (`shipment_id`, `fname`, `lname`, `phone`, `county`, `pickup_station`, `payment_method`, `postal_code`, `order_id`) VALUES
(6, 'Jane', 'kamau', '0114403621', 'nyeri', 'edf', '', '345', 14),
(8, 'Jane', 'Doe', '0702567783', 'embu', 'othaya', 'cash on de', '345', 16);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
