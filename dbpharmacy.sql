-- phpMyAdmin SQL Dump
-- version 4.9.11
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Apr 18, 2023 at 05:45 PM
-- Server version: 8.0.32-cll-lve
-- PHP Version: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `gqddcaqv_atest`
--

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

CREATE TABLE `employee` (
  `id` int NOT NULL,
  `Name` longtext NOT NULL,
  `Email` longtext NOT NULL,
  `Date_joined` date NOT NULL,
  `Salary` float NOT NULL,
  `Shifts` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `id` int NOT NULL,
  `email` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `expires_at` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tblmedicine`
--

CREATE TABLE `tblmedicine` (
  `DrugID` int NOT NULL,
  `drug_image_id` int NOT NULL,
  `drugName` varchar(255) NOT NULL,
  `scientificName` varchar(255) NOT NULL,
  `drugDosage` int NOT NULL,
  `drugCategory` varchar(255) NOT NULL,
  `storageTemperature` int NOT NULL,
  `no_of_unit_in_package` int NOT NULL,
  `manufacturer` varchar(255) NOT NULL,
  `unitPrice` float NOT NULL,
  `storageLocation` varchar(255) NOT NULL,
  `status` char(1) NOT NULL DEFAULT 'T'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tblmedicine`
--

INSERT INTO `tblmedicine` (`DrugID`, `drug_image_id`, `drugName`, `scientificName`, `drugDosage`, `drugCategory`, `storageTemperature`, `no_of_unit_in_package`, `manufacturer`, `unitPrice`, `storageLocation`, `status`) VALUES
(1, 1, 'LORATADINE', 'LORATADINE', 10, 'ANTIHISTAMINES & ANTIALLERGICS', 30, 30, 'PHARMANIAGA', 10, 'ROOM', 'T'),
(2, 2, 'LEVOCETIRIZINE', 'LEVOCETIRIZINE', 5, 'ANTIHISTAMINES & ANTIALLERGICS', 30, 30, 'GLENMARK', 30, 'ROOM', 'T'),
(3, 3, 'PANADOL', 'PANADOL', 650, 'ANALGESICS AND ANTIPYRETICS', 30, 50, 'PHARMANIAGA', 30, 'ROOM', 'T');

-- --------------------------------------------------------

--
-- Table structure for table `tblmedicine_image`
--

CREATE TABLE `tblmedicine_image` (
  `drug_image_id` int NOT NULL,
  `image_path` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tblmedicine_image`
--

INSERT INTO `tblmedicine_image` (`drug_image_id`, `image_path`) VALUES
(1, 'LORA10MGcopy26-11-22_10_20_39.png'),
(2, 'levocetirizine26-11-22_10_21_50.jpg'),
(3, '6d273b1b421dfde3c925719adcb6831226-11-22_10_22_29.jpeg');

-- --------------------------------------------------------

--
-- Table structure for table `tblpurchase_invoice`
--

CREATE TABLE `tblpurchase_invoice` (
  `purchaseInvoiceID` int NOT NULL,
  `purchaseDate` datetime NOT NULL,
  `drugID` longtext NOT NULL,
  `drugBatchNo` longtext NOT NULL,
  `drugQty` longtext NOT NULL,
  `drugPrice` longtext NOT NULL,
  `tax` varchar(255) NOT NULL,
  `totalAmount` float NOT NULL,
  `paymentType` enum('Cash') NOT NULL,
  `discount` int NOT NULL,
  `paidAmount` float NOT NULL,
  `remainingAmount` float NOT NULL,
  `refundedItem` longtext,
  `refundedBatchNo` longtext,
  `refundedDrugQty` longtext,
  `refundedDrugPrice` longtext,
  `refundedTax` longtext,
  `refundedDateTime` longtext
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tblpurchase_invoice`
--

INSERT INTO `tblpurchase_invoice` (`purchaseInvoiceID`, `purchaseDate`, `drugID`, `drugBatchNo`, `drugQty`, `drugPrice`, `tax`, `totalAmount`, `paymentType`, `discount`, `paidAmount`, `remainingAmount`, `refundedItem`, `refundedBatchNo`, `refundedDrugQty`, `refundedDrugPrice`, `refundedTax`, `refundedDateTime`) VALUES
(1, '2022-11-26 23:47:04', 'PANADOL', 'PANA1', '6', '30', '6:10.80', 190.8, 'Cash', 0, 200, 9.2, '', '', '', '', '', NULL),
(2, '2022-11-26 23:47:15', 'LORATADINE:LORATADINE:LEVOCETIRIZINE', 'LORA1:LORA2:LEVO1', '10:2:3', '10:10:30', '6:12.60', 222.6, 'Cash', 0, 250, 27.4, 'LORATADINE:LEVOCETIRIZINE:LORATADINE', 'LORA1:LEVO1:LORA2', '10:3:2', '10:30:10', '6:12.6', '2023-01-16 11:42:18|2023-01-16 11:42:18|2023-01-16 11:50:29'),
(3, '2022-11-26 23:47:46', 'LEVOCETIRIZINE', 'LEVO1', '6', '30', '6:10.80', 190.8, 'Cash', 0, 200, 9.2, '', '', '', '', '', NULL),
(4, '2022-11-26 23:47:53', 'LEVOCETIRIZINE:LORATADINE:LORATADINE:PANADOL', 'LEVO1:LORA1:LORA2:PANA1', '1:0:2:1', '30:10:10:30', '6:4.80', 84.8, 'Cash', 0, 90, 5.2, '', '', '', '', '', NULL),
(5, '2022-11-27 00:01:58', 'LORATADINE:LORATADINE', 'LORA1:LORA2', '0:1', '10:10', '6:0.60', 10.6, 'Cash', 0, 11, 0.4, '', '', '', '', '', NULL),
(6, '2022-11-27 00:05:25', 'LEVOCETIRIZINE', 'LEVO1', '1', '30', '6:1.80', 31.8, 'Cash', 0, 32, 0.2, NULL, NULL, NULL, NULL, NULL, NULL),
(7, '2022-11-27 00:06:31', 'PANADOL', 'PANA1', '1', '30', '6:1.80', 31.8, 'Cash', 0, 32, 0.2, '', '', '', '', '', NULL),
(8, '2022-11-27 00:06:51', 'PANADOL', 'PANA1', '1', '30', '6:1.80', 31.8, 'Cash', 0, 50, 18.2, '', '', '', '', '', NULL),
(9, '2022-11-27 01:05:10', 'LORATADINE:LORATADINE', 'LORA1:LORA2', '0:5', '10:10', '6:3.00', 53, 'Cash', 0, 55, 2, 'LORATADINE', 'LORA2', '5', '10', '6:3', '2023-01-16 11:51:46'),
(10, '2022-11-29 00:24:44', 'LORATADINE:LORATADINE', 'LORA1:LORA2', '0:5', '10:10', '6:3.00', 53, 'Cash', 0, 55, 2, 'LORATADINE', 'LORA2', '5', '10', '6:3', '2023-01-16 11:32:11'),
(11, '2022-11-29 00:31:35', 'LEVOCETIRIZINE', 'LEVO1', '1', '30', '6:1.80', 31.8, 'Cash', 0, 32, 0.2, '', '', '', '', '', NULL),
(12, '2022-11-29 00:35:26', 'LORATADINE:LORATADINE:LEVOCETIRIZINE', 'LORA1:LORA2:LEVO1', '0:2:3', '10:10:30', '6:6.60', 116.6, 'Cash', 0, 120, 3.4, '', '', '', '', '', NULL),
(13, '2022-11-29 00:40:43', 'LEVOCETIRIZINE:LORATADINE:LORATADINE', 'LEVO1:LORA1:LORA2', '3:0:4', '30:10:10', '6:7.80', 137.8, 'Cash', 0, 140, 2.2, '', '', '', '', '', NULL),
(14, '2023-01-16 11:25:26', 'LORATADINE:LORATADINE', 'LORA1:LORA2', '0:1', '10:10', '6:0.60', 10.6, 'Cash', 0, 11, 0.4, NULL, NULL, NULL, NULL, NULL, NULL),
(15, '2023-01-16 14:05:28', 'LORATADINE:LEVOCETIRIZINE', 'LORA1:LEVO1', '1:1', '10:30', '6:2.40', 42.4, 'Cash', 0, 50, 7.6, 'LEVOCETIRIZINE', 'LEVO1', '1', '30', '6:1.8', '2023-01-16 14:12:16');

-- --------------------------------------------------------

--
-- Table structure for table `tblstored_drug`
--

CREATE TABLE `tblstored_drug` (
  `batchNo` longtext NOT NULL,
  `DrugID` int NOT NULL,
  `manufacturerDate` date NOT NULL,
  `expiryDate` date NOT NULL,
  `quantity` int NOT NULL,
  `entryDate` datetime NOT NULL,
  `status` char(1) NOT NULL DEFAULT 'T'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tblstored_drug`
--

INSERT INTO `tblstored_drug` (`batchNo`, `DrugID`, `manufacturerDate`, `expiryDate`, `quantity`, `entryDate`, `status`) VALUES
('LEVO1', 2, '2022-11-26', '2022-12-01', 89, '2022-11-26 22:23:52', 'T'),
('LORA1', 1, '2022-11-26', '2023-01-01', 29, '2022-11-26 22:24:20', 'T'),
('PANA1', 3, '2022-11-26', '2022-12-09', 0, '2022-11-26 22:24:34', 'T'),
('LORA2', 1, '2022-11-26', '2023-04-01', 104, '2022-11-26 22:25:07', 'T');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `roleid` int NOT NULL DEFAULT '2',
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `date_joined` date DEFAULT NULL,
  `salary` float DEFAULT NULL,
  `shifts` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `verification_code` varchar(255) NOT NULL,
  `is_verified` int NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `email`, `password`, `roleid`, `name`, `date_joined`, `salary`, `shifts`, `verification_code`, `is_verified`) VALUES
(1, 'xachapuridze.amiko@gmail.com', '378ea2dcb4364fd0a626c6a1901c7860', 1, NULL, NULL, NULL, NULL, '', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `employee`
--
ALTER TABLE `employee`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblmedicine`
--
ALTER TABLE `tblmedicine`
  ADD UNIQUE KEY `DrugID` (`DrugID`);

--
-- Indexes for table `tblmedicine_image`
--
ALTER TABLE `tblmedicine_image`
  ADD PRIMARY KEY (`drug_image_id`);

--
-- Indexes for table `tblpurchase_invoice`
--
ALTER TABLE `tblpurchase_invoice`
  ADD PRIMARY KEY (`purchaseInvoiceID`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `password_resets`
--
ALTER TABLE `password_resets`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
