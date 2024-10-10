-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 10, 2024 at 03:45 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `astra_lending_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `borrowers`
--

CREATE TABLE `borrowers` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `name` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `lenders`
--

CREATE TABLE `lenders` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `lenders`
--

INSERT INTO `lenders` (`id`, `email`, `password`) VALUES
(7, 'lender@example.com', '$2y$10$X.IxI6.nvu53Taxg3CGkMugcVWaLYKE/9Sgiro0W8L/p.YAJtgEVq');

-- --------------------------------------------------------

--
-- Table structure for table `loan_applications`
--

CREATE TABLE `loan_applications` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `phone` varchar(50) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `amount` decimal(10,2) DEFAULT NULL,
  `interest_rate` decimal(5,2) DEFAULT NULL,
  `total_amount` decimal(10,2) DEFAULT NULL,
  `status` varchar(50) DEFAULT NULL,
  `confirmation_token` varchar(64) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `reset_token` varchar(255) DEFAULT NULL,
  `reset_expiry` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `loan_applications`
--

INSERT INTO `loan_applications` (`id`, `name`, `email`, `phone`, `address`, `amount`, `interest_rate`, `total_amount`, `status`, `confirmation_token`, `password`, `reset_token`, `reset_expiry`) VALUES
(11, 'Lloyd Jacky Mendoza Mirasol', 'uzziah.lord.10@gmail.com', '09232843882', '136 Puelay Caranglaan District', 10000.00, 15.00, 1500.00, 'Approved', 'cc5db446fd63e604a1dfdc07be46acafffb2ae1da85af4d4b8f5b60bef810f0f', '$2y$10$Qmaq72z17xFqeh02PzEyRO/vwY/QPKanPboLjSptalt6ZrRRNB62m', NULL, NULL),
(12, 'Kiko Salinas Bro', 'likasuya.10@gmail.com', '09123456789', '150 Mangaldan', 15000.00, 12.00, 1800.00, 'Approved', '4c56678e0a67f21eaa880a172458eda1c528d8d3f7f39cd8bd19ad372eb8516a', '$2y$10$ka3hz2ixkUW..Hijl/eAEO9SsySwNSCjyyvhqAbHNgJIwHkDdvQBK', NULL, NULL),
(13, 'Teo Foo', 'mirasol.llydjcky@gmail.com', '0923645898', 'Bonuan Dagupan', 50000.00, 12.00, 6000.00, 'Approved', '51d71dac459f6e02a91f8696386c64bb018fe4d4fb8dc240285968acd8db4974', '$2y$10$Cqi1tB.payoi39HG.kv7t.tDKUrOxV1mhccBZc20KUJCHyt8zouLO', NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `borrowers`
--
ALTER TABLE `borrowers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `lenders`
--
ALTER TABLE `lenders`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `loan_applications`
--
ALTER TABLE `loan_applications`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `borrowers`
--
ALTER TABLE `borrowers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `lenders`
--
ALTER TABLE `lenders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `loan_applications`
--
ALTER TABLE `loan_applications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
