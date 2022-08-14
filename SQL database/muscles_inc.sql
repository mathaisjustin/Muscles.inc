-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 22, 2022 at 05:09 PM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.1.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `muscles.inc`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_admin`
--

CREATE TABLE `tbl_admin` (
  `id` int(10) NOT NULL,
  `full_name` varchar(100) CHARACTER SET utf8mb4 NOT NULL,
  `username` varchar(100) CHARACTER SET utf8mb4 NOT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_admin`
--

INSERT INTO `tbl_admin` (`id`, `full_name`, `username`, `password`) VALUES
(1, 'Administator', 'admin', '21232f297a57a5a743894a0e4a801fc3');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_car`
--

CREATE TABLE `tbl_car` (
  `id` int(10) NOT NULL,
  `title` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `image_name` varchar(255) NOT NULL,
  `category_id` int(11) NOT NULL,
  `featured` varchar(10) NOT NULL,
  `active` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_car`
--

INSERT INTO `tbl_car` (`id`, `title`, `description`, `price`, `image_name`, `category_id`, `featured`, `active`) VALUES
(9, 'Chevrolet Chevelle', 'American Muscle', '62612.00', 'Car_Name_412.jfif', 17, 'Yes', 'Yes'),
(11, 'Chevrolet Camaro', 'American Muscle', '25000.00', 'Car_Name_249.jpg', 17, 'Yes', 'Yes'),
(12, 'Dodge Dart', 'American Muscle', '20000.00', 'Car_Name_932.jfif', 18, 'Yes', 'Yes'),
(13, 'Dodge Challenger', 'American Muscle', '31295.00', 'Car_Name_460.jfif', 18, 'Yes', 'Yes'),
(14, 'Dodge Coronet', 'American Muscle', '27500.00', 'Car_Name_968.jfif', 18, 'Yes', 'Yes'),
(15, 'Dodge Super Bee', 'American Muscle', '30000.00', 'Car_Name_244.jfif', 18, 'Yes', 'Yes'),
(16, 'Ford Falcon GT', 'American Muscle', '1030000.00', 'Car_Name_694.jfif', 19, 'Yes', 'Yes'),
(17, 'Ford Galaxie', 'American Muscle', '253000.00', 'Car_Name_650.jfif', 19, 'Yes', 'Yes'),
(18, 'Ford Mustang', 'American Muscle', '28000.00', 'Car_Name_84.jfif', 19, 'Yes', 'Yes'),
(19, 'Ford Torino', 'American Muscle', '36326.00', 'Car_Name_971.jfif', 19, 'Yes', 'Yes'),
(20, 'Ford XB Falcon', 'American Muscle', '21534.00', 'Car_Name_203.jfif', 19, 'Yes', 'Yes'),
(21, 'Mercury Cyclone', 'American Muscle', '40786.00', 'Car_Name_616.jfif', 17, 'Yes', 'Yes'),
(22, 'Mercury Cyclone Spoiler II', 'American Muscle', '39000.00', 'Car_Name_234.jfif', 20, 'Yes', 'Yes'),
(23, 'Mercury Comet', 'American Muscle', '36500.00', 'Car_Name_174.jfif', 20, 'Yes', 'Yes'),
(24, 'Oldsmobile Cutlass', 'American Muscle', '6996.00', 'Car_Name_84.jfif', 17, 'Yes', 'Yes'),
(25, 'Oldsmobile Hurst', 'American Muscle', '41379.00', 'Car_Name_7.jfif', 21, 'Yes', 'Yes'),
(26, 'Oldsmobile 4 4 2', 'American Muscle', '57254.00', 'Car_Name_425.jfif', 21, 'Yes', 'Yes'),
(27, 'Oldsmobile 88', 'American Muscle', '31125.00', 'Car_Name_516.jfif', 21, 'Yes', 'Yes'),
(28, 'Plymouth Barracuda', 'American Muscle', '21000.00', 'Car_Name_21.jfif', 22, 'Yes', 'Yes'),
(29, 'Plymouth Fury', 'American Muscle', '32218.00', 'Car_Name_821.jfif', 22, 'Yes', 'Yes'),
(30, 'Plymouth GTX', 'American Muscle', '59307.00', 'Car_Name_814.jfif', 22, 'Yes', 'Yes'),
(31, 'Plymouth Superbird', 'American Muscle', '210120.00', 'Car_Name_765.jfif', 22, 'Yes', 'Yes'),
(32, 'Pontiac Firebird', 'American Muscle', '55625.00', 'Car_Name_368.jfif', 23, 'Yes', 'Yes'),
(33, 'Pontiac Tempest', 'American Muscle', '18700.00', 'Car_Name_836.jfif', 23, 'Yes', 'Yes'),
(34, 'Saleen S 281', 'American Muscle', '47249.00', 'Car_Name_922.jfif', 24, 'Yes', 'Yes'),
(35, 'Saleen 302 Series', 'American Muscle', '225000.00', 'Car_Name_578.jfif', 24, 'Yes', 'Yes');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_category`
--

CREATE TABLE `tbl_category` (
  `id` int(10) NOT NULL,
  `title` varchar(100) NOT NULL,
  `image_name` varchar(255) NOT NULL,
  `featured` varchar(10) NOT NULL,
  `active` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_category`
--

INSERT INTO `tbl_category` (`id`, `title`, `image_name`, `featured`, `active`) VALUES
(17, 'Chevrolet', 'Car_Category_707.png', 'yes', 'yes'),
(18, 'Dodge', 'Car_Category_197.png', 'yes', 'yes'),
(19, 'Ford', 'Car_Category_830.png', 'yes', 'yes'),
(20, 'Mercury', 'Car_Category_342.png', 'yes', 'yes'),
(21, 'Oldsmobile', 'Car_Category_546.png', 'yes', 'yes'),
(22, 'Plymouth', 'Car_Category_539.png', 'yes', 'yes'),
(23, 'Pontiac', 'Car_Category_368.png', 'yes', 'yes'),
(24, 'Saleen', 'Car_Category_565.png', 'yes', 'yes');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_order`
--

CREATE TABLE `tbl_order` (
  `id` int(10) NOT NULL,
  `car` varchar(150) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `qty` int(11) NOT NULL,
  `total` decimal(10,2) NOT NULL,
  `order_date` datetime NOT NULL,
  `status` varchar(50) NOT NULL,
  `customer_name` varchar(150) NOT NULL,
  `customer_contact` varchar(20) NOT NULL,
  `customer_email` varchar(150) NOT NULL,
  `customer_address` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_order`
--

INSERT INTO `tbl_order` (`id`, `car`, `price`, `qty`, `total`, `order_date`, `status`, `customer_name`, `customer_contact`, `customer_email`, `customer_address`) VALUES
(3, 'Chevrolet Camaro', '25000.00', 1, '25000.00', '2022-03-08 07:12:38', 'Delivered', 'wCgSW60RV9', '0735145791', 'fjwbv@ygqv.com', 'xGO2CYON8y'),
(4, 'Chevrolet Camaro', '25000.00', 1, '25000.00', '2022-03-24 05:18:08', 'Ordered', 'MAKYi0mPBt', '9084537799', 'rjgje@rnrf.com', '0jSATnSTEN');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_car`
--
ALTER TABLE `tbl_car`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_category`
--
ALTER TABLE `tbl_category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_order`
--
ALTER TABLE `tbl_order`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_car`
--
ALTER TABLE `tbl_car`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `tbl_category`
--
ALTER TABLE `tbl_category`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `tbl_order`
--
ALTER TABLE `tbl_order`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
