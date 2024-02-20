-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 20, 2024 at 09:22 AM
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
-- Database: `db_mn`
--

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `product_code` int(11) NOT NULL,
  `shop_code` varchar(6) NOT NULL,
  `product_name` varchar(100) DEFAULT NULL,
  `unit_of_measure` varchar(20) DEFAULT NULL,
  `selling_price` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`product_code`, `shop_code`, `product_name`, `unit_of_measure`, `selling_price`) VALUES
(1, 'SC65d4', 'ผ้าดิบ', 'เมตร', '50.00');

-- --------------------------------------------------------

--
-- Table structure for table `railway_data`
--

CREATE TABLE `railway_data` (
  `code` int(11) NOT NULL,
  `car_number` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `railway_data`
--

INSERT INTO `railway_data` (`code`, `car_number`) VALUES
(1, 'car1');

-- --------------------------------------------------------

--
-- Table structure for table `register`
--

CREATE TABLE `register` (
  `user_id` varchar(5) NOT NULL,
  `firstname` varchar(30) NOT NULL,
  `lastname` varchar(30) NOT NULL,
  `email` varchar(30) NOT NULL,
  `password` varchar(20) NOT NULL,
  `phone` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `register`
--

INSERT INTO `register` (`user_id`, `firstname`, `lastname`, `email`, `password`, `phone`) VALUES
('00001', '', '', '', '', ''),
('00002', '', '', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `route_data`
--

CREATE TABLE `route_data` (
  `sequence_number` int(11) NOT NULL,
  `place_code` varchar(6) DEFAULT NULL,
  `time` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `route_data`
--

INSERT INTO `route_data` (`sequence_number`, `place_code`, `time`) VALUES
(4, 'ban199', '10:00'),
(6, 'ban199', '12:00'),
(7, '1', '10:00'),
(8, 'ban199', '12:00');

-- --------------------------------------------------------

--
-- Table structure for table `shops`
--

CREATE TABLE `shops` (
  `shop_code` varchar(6) NOT NULL,
  `shop_name` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `shops`
--

INSERT INTO `shops` (`shop_code`, `shop_name`) VALUES
('SC65d4', 'ป้าแก้ว');

-- --------------------------------------------------------

--
-- Table structure for table `tourist_places`
--

CREATE TABLE `tourist_places` (
  `place_code` varchar(6) NOT NULL,
  `place_name` varchar(100) DEFAULT NULL,
  `latitude` decimal(10,6) DEFAULT NULL,
  `longitude` decimal(10,6) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tourist_places`
--

INSERT INTO `tourist_places` (`place_code`, `place_name`, `latitude`, `longitude`) VALUES
('1', 'bandum', '19.992012', '99.860264'),
('ban199', 'ban', '19.995843', '99.835688'),
('ว1999', 'วัดร่องเสือเต้น', '19.923251', '99.839061');

-- --------------------------------------------------------

--
-- Table structure for table `tourist_spots`
--

CREATE TABLE `tourist_spots` (
  `code` int(11) NOT NULL,
  `spot_name` varchar(100) DEFAULT NULL,
  `latitude` decimal(10,6) DEFAULT NULL,
  `longitude` decimal(10,6) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_code`),
  ADD KEY `shop_code` (`shop_code`);

--
-- Indexes for table `railway_data`
--
ALTER TABLE `railway_data`
  ADD PRIMARY KEY (`code`);

--
-- Indexes for table `route_data`
--
ALTER TABLE `route_data`
  ADD PRIMARY KEY (`sequence_number`),
  ADD KEY `place_code` (`place_code`);

--
-- Indexes for table `shops`
--
ALTER TABLE `shops`
  ADD PRIMARY KEY (`shop_code`);

--
-- Indexes for table `tourist_places`
--
ALTER TABLE `tourist_places`
  ADD PRIMARY KEY (`place_code`);

--
-- Indexes for table `tourist_spots`
--
ALTER TABLE `tourist_spots`
  ADD PRIMARY KEY (`code`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `route_data`
--
ALTER TABLE `route_data`
  MODIFY `sequence_number` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`shop_code`) REFERENCES `shops` (`shop_code`);

--
-- Constraints for table `route_data`
--
ALTER TABLE `route_data`
  ADD CONSTRAINT `route_data_ibfk_1` FOREIGN KEY (`place_code`) REFERENCES `tourist_places` (`place_code`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
