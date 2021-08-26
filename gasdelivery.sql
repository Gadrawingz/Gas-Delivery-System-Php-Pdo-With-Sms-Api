-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 30, 2021 at 04:00 PM
-- Server version: 10.4.13-MariaDB
-- PHP Version: 7.4.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `gasdelivery`
--

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `cust_id` int(10) NOT NULL,
  `cust_names` varchar(100) NOT NULL,
  `username` varchar(60) NOT NULL,
  `phone_number` varchar(14) NOT NULL,
  `address` varchar(100) NOT NULL,
  `pin_number` int(5) NOT NULL,
  `balance` int(10) NOT NULL DEFAULT 30000
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`cust_id`, `cust_names`, `username`, `phone_number`, `address`, `pin_number`, `balance`) VALUES
(1, 'Mukamana Kevine', 'Kevine', '0786593026', 'RUHANGO', 4290, 30000),
(2, 'Ahsafuari', 'Dag', '0784557411', 'NYANZA', 2020, 30000),
(3, 'Iradukunda Jules', 'jules', '0786593026', 'NYANZA', 8616, 30000),
(4, 'Mukamana Kevine', 'DIDI', '0786593026', 'NYAMAGABE', 1113, 30000),
(5, 'Patric', 'patric', '0786441086', 'HUYE', 7564, 30000),
(6, 'yayu', 'yayu', '0786593026', 'NYARUGURU', 1111, 30000),
(7, 'kabebe', 'kabebe', '0786593026', 'NYAMAGABE', 3758, 30000),
(8, 'kubwimana andre', 'andre', '0786593026', 'KIREHE', 5555, 30000);

-- --------------------------------------------------------

--
-- Table structure for table `gas_store`
--

CREATE TABLE `gas_store` (
  `g_id` int(10) NOT NULL,
  `gas_quantity` int(10) NOT NULL,
  `comment` text NOT NULL,
  `cust_id` int(10) NOT NULL,
  `agent_id` int(10) NOT NULL,
  `status` varchar(30) NOT NULL DEFAULT 'Unpaid',
  `date_submitted` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `gas_store`
--

INSERT INTO `gas_store` (`g_id`, `gas_quantity`, `comment`, `cust_id`, `agent_id`, `status`, `date_submitted`) VALUES
(1, 12, 'tukohereje gaz', 1, 1, 'Paid', '2021-03-18 12:47:19'),
(2, 12, 'sdfghjk', 2, 1, 'Paid', '2021-03-18 16:14:39'),
(3, 12, 'WOHEREREJWE GAZ', 4, 1, 'Unpaid', '2021-03-18 16:40:08'),
(4, 12, 'h', 5, 1, 'Paid', '2021-03-18 17:19:59'),
(5, 12, 'urayibona', 6, 1, 'Unpaid', '2021-03-29 16:57:12'),
(6, 6, 'urayibona', 7, 1, 'Unpaid', '2021-03-30 08:28:16'),
(7, 6, 'urayibona', 8, 1, 'Unpaid', '2021-03-30 08:41:23');

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `payment_id` int(10) NOT NULL,
  `cust_id` int(10) NOT NULL,
  `gas_store_id` int(11) DEFAULT NULL,
  `amount` int(10) NOT NULL,
  `agent_id` int(10) NOT NULL,
  `payment_date` datetime NOT NULL,
  `reference` varchar(255) DEFAULT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'PENDING'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`payment_id`, `cust_id`, `gas_store_id`, `amount`, `agent_id`, `payment_date`, `reference`, `status`) VALUES
(1, 1, 1, 5, 1, '2021-03-18 11:52:09', '45aa0787-c7b2-4fe5-bf7c-ed41a8d21e8b', 'SUCCESS'),
(4, 5, 4, 5, 1, '2021-03-18 16:23:53', 'bfa0f282-4035-4155-92cf-f79772877ed9', 'SUCCESS'),
(5, 2, 2, 5, 1, '2021-03-30 05:05:49', 'e75212c7-61bb-4a90-935c-ed9742ac5310', 'SUCCESS');

-- --------------------------------------------------------

--
-- Table structure for table `station_agent`
--

CREATE TABLE `station_agent` (
  `agent_id` int(10) NOT NULL,
  `agent_names` varchar(60) NOT NULL,
  `username` varchar(60) NOT NULL,
  `phone_number` varchar(14) NOT NULL,
  `address` varchar(90) NOT NULL,
  `password` varchar(60) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `station_agent`
--

INSERT INTO `station_agent` (`agent_id`, `agent_names`, `username`, `phone_number`, `address`, `password`, `status`) VALUES
(1, 'Umutoni Diane', 'Diane', '0786593026', 'KAMONYI', '123', 1),
(2, 'Gad', 'G', '2345tyhgfdjnde', 'NYAMAGABE', '124567', 1),
(3, 'benjamin', 'benjamin', '07862309', 'GASABO', '12345', 1);

-- --------------------------------------------------------

--
-- Table structure for table `station_manager`
--

CREATE TABLE `station_manager` (
  `m_id` int(10) NOT NULL,
  `username` varchar(60) NOT NULL,
  `email` varchar(90) NOT NULL,
  `password` varchar(60) NOT NULL,
  `phone_number` varchar(14) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `station_manager`
--

INSERT INTO `station_manager` (`m_id`, `username`, `email`, `password`, `phone_number`) VALUES
(1, 'STATION', 'station@gmail.com', '12345', '0786230962');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`cust_id`);

--
-- Indexes for table `gas_store`
--
ALTER TABLE `gas_store`
  ADD PRIMARY KEY (`g_id`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`payment_id`),
  ADD KEY `gas_store_id` (`gas_store_id`);

--
-- Indexes for table `station_agent`
--
ALTER TABLE `station_agent`
  ADD PRIMARY KEY (`agent_id`);

--
-- Indexes for table `station_manager`
--
ALTER TABLE `station_manager`
  ADD PRIMARY KEY (`m_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `cust_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `gas_store`
--
ALTER TABLE `gas_store`
  MODIFY `g_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `payment_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `station_agent`
--
ALTER TABLE `station_agent`
  MODIFY `agent_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `station_manager`
--
ALTER TABLE `station_manager`
  MODIFY `m_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
