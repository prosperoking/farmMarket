-- phpMyAdmin SQL Dump
-- version 4.5.2
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Feb 25, 2016 at 03:10 PM
-- Server version: 5.6.16
-- PHP Version: 5.5.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `farmproduct`
--
CREATE DATABASE IF NOT EXISTS `farmproduct` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `farmproduct`;

-- --------------------------------------------------------

--
-- Table structure for table `carts`
--

CREATE TABLE IF NOT EXISTS `carts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `product_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `carts`
--

INSERT INTO `carts` (`id`, `product_id`, `user_id`, `quantity`) VALUES
(21, 2, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE IF NOT EXISTS `categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(30) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`) VALUES
(1, 'Vegetables'),
(2, 'Farm Input'),
(4, 'Live Stock'),
(5, 'Root and Tuber'),
(6, 'Fruits');

-- --------------------------------------------------------

--
-- Table structure for table `paymentmethods`
--

CREATE TABLE IF NOT EXISTS `paymentmethods` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `processingurl` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE IF NOT EXISTS `products` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `subcategory_id` int(11) NOT NULL,
  `availableqty` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `quantity` int(11) NOT NULL DEFAULT '0',
  `prize` int(11) NOT NULL,
  `title` varchar(30) NOT NULL,
  `description` text NOT NULL,
  `tags` text NOT NULL,
  `payementmethod_id` int(11) DEFAULT NULL,
  `image` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `user_id`, `category_id`, `subcategory_id`, `availableqty`, `quantity`, `prize`, `title`, `description`, `tags`, `payementmethod_id`, `image`) VALUES
(2, 2, 1, 1, 2, 10, 150, 'Get your fresh okoro', 'You get a clean freshly plucked okoro fruits for your delicacy. This is a 40gram basket full per quantity.', 'okoro,fresh vegetable,okoro soup,ingredients,heelo,ggh', NULL, '/uploads/subcat/1449758392_762298.jpg'),
(3, 1, 4, 4, 10, 10, 1100, 'Get crate of Nice Large Eggs', 'We at oke ultra modern farm provides you with eggs that are large and not more than 2 days after laying of the eggs. We ensure that you  get the value for your money. And guess what? you get 3 eggs for free when ever you buy 2 crates.\r\n\r\nYou may contact me if you have any question.', 'Cake,eggs,egg crate,egg stew,fried egg', NULL, '/uploads/subcat/1449587163_79132.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `recievedmessages`
--

CREATE TABLE IF NOT EXISTS `recievedmessages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sender` int(11) NOT NULL,
  `recipient` int(11) NOT NULL,
  `message` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `sentmessages`
--

CREATE TABLE IF NOT EXISTS `sentmessages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sender` int(11) NOT NULL,
  `recipient` int(11) NOT NULL,
  `message` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `subcategories`
--

CREATE TABLE IF NOT EXISTS `subcategories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category_id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `image` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `subcategories`
--

INSERT INTO `subcategories` (`id`, `category_id`, `name`, `image`) VALUES
(1, 1, 'Leaf Vegetable', '/uploads/subcat/1449576033_645965.jpg'),
(2, 1, 'Pod Vegetables', '/uploads/subcat/1449580321_771575.jpg'),
(3, 2, 'Fertilizer', '/uploads/subcat/1449582947_438537.png'),
(4, 4, 'Dairy', '/uploads/subcat/1449587163_79132.jpg'),
(5, 1, 'Root Vegetables', '/uploads/subcat/1449589654_414031.jpg'),
(6, 1, 'Flower and Bud Vegetables', '/uploads/subcat/1449593426_595794.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE IF NOT EXISTS `transactions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `product_id` int(11) NOT NULL,
  `amount` int(11) NOT NULL,
  `paymentstatus` tinyint(1) DEFAULT '0',
  `shippedstatus` int(11) NOT NULL DEFAULT '0',
  `shippinginfo` text NOT NULL,
  `completestatus` tinyint(1) NOT NULL DEFAULT '0',
  `buyerid` int(11) NOT NULL,
  `sellerid` int(11) NOT NULL,
  `duedate` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `usertype` tinyint(1) NOT NULL DEFAULT '0',
  `accstatus` tinyint(1) NOT NULL DEFAULT '1',
  `username` varchar(30) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  `firstname` varchar(30) NOT NULL,
  `lastname` varchar(30) NOT NULL,
  `othername` varchar(30) DEFAULT NULL,
  `imageprof` text NOT NULL,
  `phone` varchar(15) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `usertype`, `accstatus`, `username`, `password`, `email`, `firstname`, `lastname`, `othername`, `imageprof`, `phone`) VALUES
(1, 1, 1, 'root', '$2y$10$LTzbcMmJmCp3kVRNtniDMuieRgzb5eqvF3hJFnswSBmFUpyoHjpBu', 'prosperoking22@gmail.com', 'Prosperoking', 'nweze', 'obumneme', '/uploads/profimages/1449462599_724121.jpg', '07069711541'),
(2, 0, 1, 'edu247eggs', '$2y$10$wgGCb/INDYmrBKq2D7XpxeOnAzxjmgEqkBilu7q0jZgzaFRpdbdmW', 'billions85@yahoo.com', 'Chinedu', 'Nwadinigwe', 'Billiions', 'uploads/profimages/1449961792_782684.jpg', '07065592254');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
