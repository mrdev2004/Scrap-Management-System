-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 01, 2025 at 07:37 PM
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
-- Database: `project`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`) VALUES
(1, 'iamadmin', 'admin1234');

-- --------------------------------------------------------

--
-- Table structure for table `buyer_payments`
--

CREATE TABLE `buyer_payments` (
  `id` int(11) NOT NULL,
  `scrap_type` varchar(255) DEFAULT NULL,
  `recycled_output` varchar(255) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `total_price` decimal(10,2) DEFAULT NULL,
  `payment_id` varchar(255) DEFAULT NULL,
  `payment_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `buyer_payments`
--

INSERT INTO `buyer_payments` (`id`, `scrap_type`, `recycled_output`, `quantity`, `total_price`, `payment_id`, `payment_date`) VALUES
(1, 'Plastic', '700 Bottles', 1, 50.00, 'pay_QD2VNmW7wpUYdF', '2025-03-31 03:15:04'),
(2, 'Plastic', '700 Bottles', 1, 50.00, 'pay_QD2abmtZqkAsyq', '2025-03-31 03:20:02'),
(3, 'Plastic', '700 Bottles', 1, 50.00, 'pay_QD2iCsyDceix4n', '2025-03-31 03:27:13'),
(4, 'Plastic', '700 Bottles', 14, 700.00, 'pay_QD2lTyAm6sn4Dr', '2025-03-31 03:30:19'),
(5, 'E-scrap', '100 Recycled Circuits', 1, 100.00, 'pay_QD3Yjp4l2S5Kru', '2025-03-31 04:16:59'),
(6, 'Metal', '30 Metal Rods', 5, 400.00, 'pay_QDQYprqOq4qwZE', '2025-04-01 02:47:01');

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

CREATE TABLE `feedback` (
  `id` int(11) NOT NULL,
  `username` varchar(20) NOT NULL,
  `rating` varchar(20) NOT NULL,
  `message` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `feedback`
--

INSERT INTO `feedback` (`id`, `username`, `rating`, `message`) VALUES
(20, 'bhumi', 'Good', 'better'),
(21, 'nikita', 'Mediocre', 'good experience\r\n');

-- --------------------------------------------------------

--
-- Table structure for table `recycled_scrap`
--

CREATE TABLE `recycled_scrap` (
  `id` int(11) NOT NULL,
  `scrap_type` enum('E-scrap','Plastic','Cable','Construction','Metal','Office') NOT NULL,
  `weight` int(11) NOT NULL,
  `recycled_output` varchar(255) NOT NULL,
  `recycle_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `recycled_scrap`
--

INSERT INTO `recycled_scrap` (`id`, `scrap_type`, `weight`, `recycled_output`, `recycle_date`, `image`) VALUES
(10, 'Metal', 10, '30 Metal Rods', '2025-03-29 18:27:05', ''),
(12, 'E-scrap', 200, '100 Recycled Circuits', '2025-03-31 02:41:55', ''),
(13, 'Plastic', 370, '650 Bottles', '2025-03-31 02:52:39', '');

-- --------------------------------------------------------

--
-- Table structure for table `register`
--

CREATE TABLE `register` (
  `id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `cpassword` varchar(255) NOT NULL,
  `user_type` enum('Buyer','Seller') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `register`
--

INSERT INTO `register` (`id`, `username`, `email`, `password`, `cpassword`, `user_type`) VALUES
(2, 'nikita', 'nikita@gmail.com', '456325', '', 'Buyer'),
(6, 'bhumi', 'bhumi1@gmail.com', 'asdfgh', '', 'Seller'),
(7, 'denisha', 'denisha@gmail.com', 'denisha', '', 'Seller'),
(8, 'sagar', 'sagar@gmail.com', '123456', '', 'Seller'),
(9, 'kirti', 'kirti@gmail.com', '123456', '', 'Seller'),
(10, 'varun', 'varun@gmail.com', '123456', '', 'Seller'),
(11, 'dipu', 'dipu@gmail.com', '789456', '', 'Seller'),
(12, 'vansh', 'vansh@gmail.com', '124578', '', 'Seller'),
(15, 'dev123', 'dev123@gmail.com', 'dev123', '', 'Buyer'),
(16, 'deval', 'deval123@gmail.com', 'deval123', '', 'Seller'),
(17, 'renny', 'renny11@gmail.com', 'renny123', '', 'Seller'),
(18, 'ram', 'ram123@gmail.com', 'ram123', '', 'Seller'),
(19, 'raman', 'raman123@gmail.com', 'raman123', '', 'Seller'),
(20, 'niranka', 'niranka@gmail.com', 'nik123', '', 'Seller'),
(21, 'smit ', 'smit@gmail.com', '789456', '', 'Seller'),
(23, 'smit ', 'smit12@gmail.com', '456123', '', 'Buyer'),
(24, 'manu', 'manu@gmail.com', 'manu12', '', 'Seller'),
(25, 'manu1', 'manu1@gmail.com', 'manu123', '', 'Buyer');

-- --------------------------------------------------------

--
-- Table structure for table `scrap_payments`
--

CREATE TABLE `scrap_payments` (
  `id` int(11) NOT NULL,
  `payment_id` varchar(50) NOT NULL,
  `scrap_type` enum('E-scrap','Plastic','Cable','Construction','Metal','Office') NOT NULL,
  `weight` int(11) NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `username` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `contact` varchar(15) NOT NULL,
  `address` text NOT NULL,
  `payment_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `scrap_payments`
--

INSERT INTO `scrap_payments` (`id`, `payment_id`, `scrap_type`, `weight`, `amount`, `username`, `email`, `contact`, `address`, `payment_date`) VALUES
(1, 'pay123', 'Metal', 130, 1000.00, 'dev', 'dev123@gmail.com', '9898452100', 'ahmedabad', '0000-00-00 00:00:00'),
(2, 'pay_QCVRVinMpPHbkx', 'E-scrap', 200, 2000.00, 'sagar', 'sagar@gmail.com', '8780472358', 'surat', '2025-03-29 18:54:32'),
(3, 'pay_QD1rIq2ip8b3Xv', 'Plastic', 120, 1000.00, 'renny', 'renny16@gmail.com', '8780472358', 'surat', '2025-03-31 11:37:07'),
(4, 'pay_QD27CFWTuZbdYF', 'Plastic', 120, 1000.00, 'deval', 'deval123@gmail.com', '8780472358', 'surat', '2025-03-31 11:52:16'),
(5, 'pay_QDO8GujM5kojlK', 'Plastic', 220, 2000.00, 'manu', 'manu@gmail.com', '8780472358', 'bhuj', '2025-04-01 09:24:26'),
(6, 'pay_QDOEIV5zgmUZRm', 'Cable', 100, 1000.00, 'manu', 'manu@gmail.com', '8780472358', 'bhuj', '2025-04-01 09:30:15');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `buyer_payments`
--
ALTER TABLE `buyer_payments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `recycled_scrap`
--
ALTER TABLE `recycled_scrap`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `register`
--
ALTER TABLE `register`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `scrap_payments`
--
ALTER TABLE `scrap_payments`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `buyer_payments`
--
ALTER TABLE `buyer_payments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `feedback`
--
ALTER TABLE `feedback`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `recycled_scrap`
--
ALTER TABLE `recycled_scrap`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `register`
--
ALTER TABLE `register`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `scrap_payments`
--
ALTER TABLE `scrap_payments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
