-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 24, 2022 at 12:30 PM
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
-- Database: `test`
--

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(100) NOT NULL,
  `product_name` varchar(255) DEFAULT NULL,
  `product_price` double(10,2) DEFAULT NULL,
  `product_desccription` text DEFAULT NULL,
  `product_image` text DEFAULT NULL,
  `created_date` timestamp NULL DEFAULT current_timestamp(),
  `is_deleted` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `product_name`, `product_price`, `product_desccription`, `product_image`, `created_date`, `is_deleted`) VALUES
(22, 'book', 1225.00, 'tile', '[\"http:\\/\\/localhost\\/datatable\\/assets\\/product\\/20220924121601797.jpg\"]', '2022-09-24 09:56:51', 0),
(23, 'book 5', 48.00, 'tile 2', '[\"http:\\/\\/localhost\\/datatable\\/assets\\/product\\/20220924121618291.jpg\",\"http:\\/\\/localhost\\/datatable\\/assets\\/product\\/20220924121618688.jpg\"]', '2022-09-24 10:16:18', 0),
(24, 'book 3', 47.00, 'tile 8', '[\"http:\\/\\/localhost\\/datatable\\/assets\\/product\\/20220924121656213.jpg\",\"http:\\/\\/localhost\\/datatable\\/assets\\/product\\/20220924121656573.jpg\"]', '2022-09-24 10:16:56', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
