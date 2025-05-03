-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 24, 2025 at 06:42 PM
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
-- Database: `gas_by_gas`
--

-- --------------------------------------------------------

--
-- Table structure for table `customer_request`
--

CREATE TABLE `customer_request` (
  `Req_ID` int(11) NOT NULL,
  `Name` varchar(40) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone_number` varchar(10) NOT NULL,
  `Outlate_Name` varchar(40) NOT NULL,
  `Outlate_id` varchar(50) NOT NULL,
  `type_of_gas` varchar(20) NOT NULL,
  `quantity` int(11) NOT NULL,
  `requested_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `customer_request`
--

INSERT INTO `customer_request` (`Req_ID`, `Name`, `email`, `phone_number`, `Outlate_Name`, `Outlate_id`, `type_of_gas`, `quantity`, `requested_date`) VALUES
(1, 'Udesh', 'errwwreerrewr', '0772953181', 'Hansana Kathaluwa', 'UHK001', '12.5KG', 5, '2025-01-28');

-- --------------------------------------------------------

--
-- Table structure for table `email_details`
--

CREATE TABLE `email_details` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `message` varchar(450) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `email_details`
--

INSERT INTO `email_details` (`id`, `name`, `email`, `subject`, `message`, `created_at`, `updated_at`) VALUES
(1, 'udesh', 'udeshkt10@gmail.com', 'sadd', 'dfreetertete', '2025-01-24 16:44:39', '2025-01-24 16:44:39');

-- --------------------------------------------------------

--
-- Table structure for table `gas_outlet_details`
--

CREATE TABLE `gas_outlet_details` (
  `id` int(11) NOT NULL,
  `outlet_id` varchar(50) NOT NULL,
  `outlet_name` varchar(255) NOT NULL,
  `phone_number` varchar(15) NOT NULL,
  `email` varchar(255) NOT NULL,
  `district` varchar(50) NOT NULL,
  `outlet_address` text NOT NULL,
  `full_gas_stock` int(11) NOT NULL DEFAULT 0,
  `gas_stock_2_3kg` varchar(40) NOT NULL DEFAULT '0',
  `gas_stock_5_0kg` varchar(40) NOT NULL DEFAULT '0',
  `gas_stock_12_5kg` varchar(40) NOT NULL DEFAULT '0',
  `gas_stock_37_5kg` varchar(40) NOT NULL DEFAULT '0',
  `stock_status` enum('in stock','out of stock') NOT NULL DEFAULT 'in stock',
  `record_date` date NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `gas_outlet_details`
--

INSERT INTO `gas_outlet_details` (`id`, `outlet_id`, `outlet_name`, `phone_number`, `email`, `district`, `outlet_address`, `full_gas_stock`, `gas_stock_2_3kg`, `gas_stock_5_0kg`, `gas_stock_12_5kg`, `gas_stock_37_5kg`, `stock_status`, `record_date`, `created_at`, `updated_at`) VALUES
(3, 'UHK', 'ewrwrwrerw', '0779235118', 'udeshkt10@gmail.com', 'Colombo', 'Near the walawwattha Kathaluwa,Ahangama.', 100, 'sss', 'ddddd', 'ss', 'sss', 'in stock', '2025-01-28', '2025-01-21 14:36:04', '2025-01-21 14:36:04');

-- --------------------------------------------------------

--
-- Table structure for table `gas_token_details`
--

CREATE TABLE `gas_token_details` (
  `id` int(11) NOT NULL,
  `outlet_id` varchar(50) NOT NULL,
  `outlet_name` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `phone_number` varchar(15) NOT NULL,
  `email` varchar(255) NOT NULL,
  `token` varchar(50) NOT NULL,
  `gas_type` varchar(50) NOT NULL,
  `quantity` int(10) NOT NULL,
  `Payment` varchar(40) NOT NULL,
  `token_status` enum('Active','Deactive') NOT NULL,
  `record_date` date NOT NULL,
  `expiry_date` date NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `gas_token_details`
--

INSERT INTO `gas_token_details` (`id`, `outlet_id`, `outlet_name`, `name`, `phone_number`, `email`, `token`, `gas_type`, `quantity`, `Payment`, `token_status`, `record_date`, `expiry_date`, `created_at`, `updated_at`) VALUES
(3, 'UHK001', 'Hansana Kathaluwa', 'udesh', '0772953181', 'udesh@gmail.com', 'HK001UHK', '12.5KG', 1, 'Rs.3800.00', 'Active', '2025-01-14', '2025-01-28', '2025-01-22 07:29:31', '2025-01-22 07:29:31'),
(4, 'DMR001', 'DarmaRathna Mathara', 'Wijedase karunasena', '0772934546', 'karunasena01@gmail.com', 'DRM20250219', '12.5KG', 3, 'Rs.11,400.00', 'Active', '2025-01-19', '2025-03-02', '2025-01-22 08:06:55', '2025-01-22 08:06:55'),
(5, 'UHK001', 'Hansana Kathaluwa', 'Kadaran Kondan', '0763136894', 'kk00003@gmail.com', 'UHK00CHAT', '2.3KG', 1, '3800', 'Active', '2025-01-28', '2025-01-21', '2025-01-22 15:03:25', '2025-01-23 07:47:57'),
(6, 'UHK001', 'Hansana Kathaluwa', '', '0763136894', 'udeshkt10@gmail.com', 'fdsffds', '12.5KG', 1, 'Rs.3800.00', 'Deactive', '2025-01-28', '2025-01-14', '2025-01-22 15:05:10', '2025-01-23 04:51:13'),
(7, 'UHK001', 'Hansana Kathluwa', '', '0763136894', 'udeshkt10@gmail.com', 'UHK00CHAT', '12.5KG', 0, 'Rs.3800.00', 'Deactive', '2025-01-31', '2025-01-14', '2025-01-22 15:06:58', '2025-01-23 04:51:13'),
(8, 'UHK001', 'Hansana Kathaluwa', 'Sanju', '0763136894', 'kk00003@gmail.com', 'UHK00CHAT', '2.3KG', 1, '3800', 'Active', '2025-01-28', '2025-01-21', '2025-01-22 19:32:51', '2025-01-23 07:49:39'),
(9, 'UHK001', 'Hansana Kathluwa', 'Chathura Dananjaya', '0763136894', 'udeshkt10@gmail.com', 'UHK00CHAT', '2.3KG', 1, 'Rs. 3800.00', 'Active', '2025-02-06', '2025-01-23', '2025-01-23 05:24:52', '2025-01-23 05:24:52'),
(10, 'UHK001', 'Hansana Kathluwa', 'Chathura Dananjaya', '0763136894', 'udeshkt10@gmail.com', 'UHK00CHAT', '2.3KG', 1, 'Rs. 3800.00', 'Active', '2025-02-06', '2025-01-23', '2025-01-23 05:24:59', '2025-01-23 05:24:59'),
(11, 'UHK001', 'Hansana Kathluwa', 'Chathura Dananjaya', '0763136894', 'udeshkt10@gmail.com', 'UHK00CHAT', '2.3KG', 1, 'Rs. 3800.00', 'Active', '2025-02-06', '2025-01-23', '2025-01-23 05:25:26', '2025-01-23 05:25:26'),
(12, 'erwerwr', 'Hansana Kathluwa', 'udesh', '0763136894', 'udeshkt10@gmail.com', 'UHK00CHAT', '2.3KG', 1, 'Rs. 3800.00', 'Active', '2025-01-28', '2025-01-29', '2025-01-23 05:29:52', '2025-01-23 05:29:52'),
(13, 'erwerwr', 'Hansana Kathluwa', 'udesh', '0763136894', 'udeshkt10@gmail.com', 'UHK00CHAT', '2.3KG', 1, 'Rs. 3800.00', 'Active', '2025-01-28', '2025-01-29', '2025-01-23 05:47:20', '2025-01-23 05:47:20'),
(14, 'UHK001', 'Hansana Kathluwa', 'udesh', '0763136894', 'udeshkt10@gmail.com', 'UHK00CHAT', '5.0KG', 1, 'Rs. 3800.00', 'Deactive', '2025-01-30', '2025-01-20', '2025-01-23 05:53:47', '2025-01-23 05:53:47'),
(15, 'UHK001', 'Hansana Kathluwa', 'udesh', '0763136894', 'udeshkt10@gmail.com', 'UHK00CHAT', '2.3KG', 1, 'Rs. 3800.00', 'Active', '2025-01-27', '2025-01-30', '2025-01-23 05:54:25', '2025-01-23 05:54:25'),
(16, 'UHK001', 'Hansana Kathaluwa', 'udesh', '0763136894', 'udeshkt10@gmail.com', 'UHK00CHAT', '2.3KG', 1, 'Rs. 3800.00', 'Deactive', '2025-01-20', '2025-01-19', '2025-01-23 05:55:16', '2025-01-23 05:55:16'),
(20, 'UHK001', 'Hansana Kathluwa', 'Pasindu Chamara', '0763136894', 'udeshkt10@gmail.com', 'UHK00CHAT', '2.3KG', 8, 'Rs. 3800.00', 'Active', '2025-01-29', '2025-01-21', '2025-01-23 11:23:14', '2025-01-23 11:23:14'),
(30, 'UHK001', 'Hansana Kathluwa', 'Pasindu Chamara', '0763136894', 'udeshkt10@gmail.com', 'UHK00CHAT', '2.3KG', 8, 'Rs. 3800.00', 'Active', '2025-01-29', '2025-01-21', '2025-01-23 12:30:37', '2025-01-23 12:30:37');

-- --------------------------------------------------------

--
-- Table structure for table `outlet_manager_regis`
--

CREATE TABLE `outlet_manager_regis` (
  `username` varchar(20) NOT NULL,
  `email` varchar(20) NOT NULL,
  `Password` varchar(10) NOT NULL,
  `confirmpassword` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `outlet_manager_regis`
--

INSERT INTO `outlet_manager_regis` (`username`, `email`, `Password`, `confirmpassword`) VALUES
('Kadaran Kondan', 'udeshkt10@gmail.com', 'udesh@1234', 'udesh@1234');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `customer_request`
--
ALTER TABLE `customer_request`
  ADD PRIMARY KEY (`Req_ID`);

--
-- Indexes for table `email_details`
--
ALTER TABLE `email_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `gas_outlet_details`
--
ALTER TABLE `gas_outlet_details`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `phone_number` (`phone_number`),
  ADD UNIQUE KEY `outlet_name` (`outlet_name`),
  ADD UNIQUE KEY `outlet_id` (`outlet_id`);

--
-- Indexes for table `gas_token_details`
--
ALTER TABLE `gas_token_details`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `customer_request`
--
ALTER TABLE `customer_request`
  MODIFY `Req_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `email_details`
--
ALTER TABLE `email_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `gas_outlet_details`
--
ALTER TABLE `gas_outlet_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `gas_token_details`
--
ALTER TABLE `gas_token_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=101;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
