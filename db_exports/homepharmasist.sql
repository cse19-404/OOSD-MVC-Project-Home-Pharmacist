-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 20, 2022 at 12:31 PM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.0.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `homepharmasist`
--

-- --------------------------------------------------------

--
-- Table structure for table `applicationtable`
--

CREATE TABLE `applicationtable` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `pharmacy_name` varchar(255) NOT NULL,
  `latitude` float NOT NULL,
  `longitude` float NOT NULL,
  `delivery_supported` tinyint(1) NOT NULL DEFAULT 0,
  `documents` varchar(255) NOT NULL,
  `application_status` varchar(255) NOT NULL DEFAULT 'pending',
  `acc_created` tinyint(1) NOT NULL DEFAULT 0,
  `address` varchar(255) NOT NULL,
  `contact_no` varchar(30) NOT NULL,
  `deleted` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `applicationtable`
--

INSERT INTO `applicationtable` (`id`, `email`, `pharmacy_name`, `latitude`, `longitude`, `delivery_supported`, `documents`, `application_status`, `acc_created`, `address`, `contact_no`, `deleted`) VALUES
(1, 'newpharmacy123@gmail.com', 'New Pharmacy', 7.4818, 80.3609, 1, 'uploads/Evidence01.txt', 'approved', 1, '12\\2,Kandy road,Kurunegala', '012-1212123', 0),
(2, 'jayapharm99@gmail.com', 'Jaya Pharmacy', 6.03575, 80.2384, 0, 'uploads/Evidence02.docx', 'approved', 1, 'No.9,Akuressa Rd,Galle', '012-1212124', 0),
(3, 'lankapharmacy00@gmail.com', 'Lanka Pharmacy', 6.88842, 81.3439, 1, 'uploads/Evidence03.txt', 'approved', 1, 'No.7,Colombo Rd,Monaragala', '012-1212178', 0),
(4, 'unitedpharm23@yahoo.com', 'United Pharmacy', 6.98862, 81.0574, 1, 'uploads/Evidence04.txt', 'approved', 1, 'No.23,Bandarawela Rd,Badulla', '012-1911913', 0),
(5, 'lankapharmacy66@gmail.com', 'Lanka Pharmacy', 7.16491, 80.5694, 0, 'uploads/Evidence05.txt', 'approved', 1, 'No.78,Kandy Rd,Gampola', '099-1212998', 0),
(6, 'citypharmacy404@gmail.com', 'City Pharmacy', 7.33816, 80.9989, 1, 'uploads/Evidence06.txt', 'approved', 1, 'No.22,Badulla Rd,Mahiyanganaya', '099-1212001', 0),
(7, 'asiriph@gmil.com', 'Asiri Pharmacy', 7.23, 80, 1, 'uploads/Evidence07.txt', 'approved', 1, 'no 12, Jaya Mawatha, Colombo 7', '011 - 1234333', 0),
(8, 'chameepharm@gmail.cpm', 'Chamee Pharmacy', 8.32225, 80.4026, 1, 'uploads/chamee_evidence.txt', 'pending', 0, 'Maithripala Senanayake Mawatha, Anuradhapura', '025-2234733', 0),
(9, 'suwasewanapharm@gmail.com', 'Suwasewana Pharmacy', 7.26222, 80.5928, 1, 'uploads/suwasewana_evidence.txt', 'approved', 1, 'N0 534, Peradeniya Rd, Kandy', '0812634405', 0),
(10, 'unionpharm@gmail.com', 'Union Pharmacy', 6.03649, 80.2166, 0, 'uploads/unionpharm_evidence.txt', 'approved', 1, 'No 200, Dikwalla Rd, Galle', '091-2245455', 0),
(11, 'libertypharm@gmail.com', 'Liberty Pharmacy', 6.91141, 79.8836, 0, 'uploads/libertypharm_evidence.txt', 'approved', 1, 'No 24, Borella Road, Colombo', '011-3422233', 0),
(12, 'luxmypharm@gmail.com', 'Luxmy Pharmacy', 9.66564, 80.0266, 1, 'uploads/luxmypharm_evidence.txt', 'approved', 0, 'no 234, Hospital Road, Jaffna', '021-2333400', 0),
(13, 'citymedicals@gmail.com', 'City Medicals', 6.79416, 79.9519, 1, 'uploads/citymedicals_evidence.txt', 'approved', 1, 'No 23, Kesbawa Road, Colombo', '011-1233363', 0);

-- --------------------------------------------------------

--
-- Table structure for table `itemtable`
--

CREATE TABLE `itemtable` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `code` varchar(255) NOT NULL,
  `quantity_unit` varchar(255) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price_per_unit_quantity` float NOT NULL,
  `prescription_needed` tinyint(1) NOT NULL,
  `pharmacy_id` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `itemtable`
--

INSERT INTO `itemtable` (`id`, `name`, `code`, `quantity_unit`, `quantity`, `price_per_unit_quantity`, `prescription_needed`, `pharmacy_id`, `status`) VALUES
(1, 'KLODIC', 'R3475M', 'TABLETS', 1350, 1000, 1, 1, 0),
(2, 'SILOCIN 4', 'NP1403M', 'CAPSULES', 1200, 16, 1, 2, 0),
(3, 'SITALO  100', 'NP3863M', 'FILM COA', 920, 120, 1, 1, 0),
(4, 'PANADOL', 'NP3383M', 'CARDS', 539, 20, 0, 2, 0),
(5, 'SAMAHAN', 'R3214M', 'PACKET', 770, 15, 0, 1, 0),
(6, 'SUSTAGEN', 'NP2239M', 'TIN', 50, 2300, 0, 1, 0),
(7, 'URIMAX 0.4 mg', 'R2406M', 'TABLETS', 390, 8.5, 1, 3, 0),
(8, 'GEFTIWEL 250', 'NP2043M', 'TABLETS', 589, 4.75, 1, 1, 0),
(9, 'PANADOL', 'NP3383M', 'BOTTLE', 539, 20, 0, 3, 0),
(11, 'Atarax 25mg', '23e', 'TABLETS', 560, 220.25, 1, 2, 0),
(12, 'Alprax 0.25', 'NP3383Z', 'TABLETS', 600, 100, 0, 3, 0),
(13, 'Pantop 40', 'NP223R', 'TABLETS', 700, 10.5, 1, 1, 0),
(14, 'Sinarest', 'NP140K', 'BOTTLE', 250, 560, 1, 4, 0),
(15, 'Diazepam', 'NP20R', 'CAPSULES', 145, 10.25, 1, 3, 0),
(16, 'Hydrocortisone', 'NP290T', 'TABLETS', 350, 220, 0, 3, 0),
(17, 'Phenobarbital', 'NP22Y', 'TABLETS', 500, 113.5, 0, 1, 0),
(18, 'Pyrantel', 'NP200P', 'CARDS', 123, 564, 1, 2, 0),
(19, 'Benzylpenicillin', 'NP289T', 'PACKET', 340, 230, 0, 4, 0),
(20, 'Nitrofurantoin', 'NP208U', 'BOTTLE', 260, 360, 1, 3, 0),
(21, 'Siddhalepa', 'TH908P', 'TUBES', 450, 55, 0, 1, 0),
(22, 'Pyrazinamide', 'YU908I', 'FILM COA', 620, 22.3, 0, 4, 0),
(23, 'Flucytosine', 'NP2090I', 'TUBES', 234, 999.5, 0, 2, 0);

-- --------------------------------------------------------

--
-- Table structure for table `mediatortable`
--

CREATE TABLE `mediatortable` (
  `id` int(11) NOT NULL,
  `sender_username` varchar(255) NOT NULL,
  `receiver_username` varchar(255) NOT NULL,
  `message_type` varchar(255) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `message` varchar(255) NOT NULL,
  `message_ref_id` int(255) NOT NULL,
  `is_read` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `mediatortable`
--

INSERT INTO `mediatortable` (`id`, `sender_username`, `receiver_username`, `message_type`, `subject`, `message`, `message_ref_id`, `is_read`) VALUES
(58, 'Thor', 'Lanka Pharmacy', 'order', 'New Order', 'A new Order is made by &quot;Thor Odinson&quot; at your pharamcy on 2022-01-20 at 04:10:12pm. You can view new order details and accept the order now.', 12, 0),
(59, 'New Pharmacy', 'All-Users', 'seasonal offer', 'Seasonal Offer Added', 'New Seasonal Offer was added by &quot;New Pharmacy&quot; on 2022-01-20 at 04:24:55pm.', 13, 0),
(60, 'New Pharmacy', 'All-Users', 'seasonal offer', 'Seasonal Offer Added', 'New Seasonal Offer was added by &quot;New Pharmacy&quot; on 2022-01-20 at 04:27:48pm.', 14, 0),
(61, 'Lanka Pharmacy', 'All-Users', 'seasonal offer', 'Seasonal Offer Added', 'New Seasonal Offer was added by &quot;Lanka Pharmacy&quot; on 2022-01-20 at 04:29:42pm.', 15, 0),
(62, 'Asiri Pharmacy', 'All-Users', 'seasonal offer', 'Seasonal Offer Added', 'New Seasonal Offer was added by &quot;Asiri Pharmacy&quot; on 2022-01-20 at 04:33:01pm.', 16, 0),
(63, 'Tony', 'New Pharmacy', 'order', 'New Order', 'A new Order is made by &quot;Tony Stark&quot; at your pharamcy on 2022-01-20 at 04:37:14pm. You can view new order details and accept the order now.', 13, 0),
(64, 'Tony', 'Lanka Pharmacy', 'order', 'New Order', 'A new Order is made by &quot;Tony Stark&quot; at your pharamcy on 2022-01-20 at 04:38:43pm. You can view new order details and accept the order now.', 14, 0),
(65, 'New Pharmacy', 'Tony', 'order', 'Order Accepted', 'The Order you made at &quot;New Pharmacy&quot; has been accepted. Your order was confirmed on 2022-01-20 at 04:44:17pm.', 13, 0),
(66, 'Lanka Pharmacy', 'Tony', 'prefilled form', 'Pre-Filled Form Recieved', 'Pre-Filled Form was sent by &quot;Lanka Pharmacy&quot; on 2022-01-20 at 04:49:21pm for the prescription you sent on 2022-01-20.', 21, 0);

-- --------------------------------------------------------

--
-- Table structure for table `offertable`
--

CREATE TABLE `offertable` (
  `id` int(11) NOT NULL,
  `pharmacy_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `status` tinyint(1) NOT NULL,
  `isexpired` tinyint(1) NOT NULL,
  `bannerdocument` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `offertable`
--

INSERT INTO `offertable` (`id`, `pharmacy_id`, `name`, `description`, `start_date`, `end_date`, `status`, `isexpired`, `bannerdocument`) VALUES
(13, 1, 'PULSE25', '25% discount on your orders', '2022-01-20', '2022-01-30', 0, 0, 'uploads/25offer-banner.jpg'),
(14, 1, 'New Year Special', 'Get 70% discount on Health and Wellness products', '2022-01-21', '2022-01-31', 0, 0, 'uploads/medicines-offers.jpg'),
(15, 2, '2022 Special', 'Get 20% discounts on your orders', '2022-01-21', '2022-01-28', 0, 0, 'uploads/Medicine-Order-Online.jpg'),
(16, 3, 'Allopathy Offer', 'Get up to 20 to 25% discount on all Allopathy medicines', '2022-01-19', '2022-01-25', 0, 0, 'uploads/maxresdefault.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `ordertable`
--

CREATE TABLE `ordertable` (
  `id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `pharmacy_id` int(11) NOT NULL,
  `receiver_name` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `mobile_number` varchar(255) NOT NULL,
  `no_of_items` varchar(255) NOT NULL,
  `items` varchar(255) NOT NULL,
  `unit_prices` varchar(255) NOT NULL,
  `quantities` varchar(255) NOT NULL,
  `prescription` varchar(255) NOT NULL,
  `total` int(11) NOT NULL,
  `status` varchar(255) NOT NULL,
  `closed` tinyint(4) NOT NULL DEFAULT 0,
  `deleted` tinyint(1) NOT NULL DEFAULT 0,
  `seen` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ordertable`
--

INSERT INTO `ordertable` (`id`, `customer_id`, `pharmacy_id`, `receiver_name`, `address`, `mobile_number`, `no_of_items`, `items`, `unit_prices`, `quantities`, `prescription`, `total`, `status`, `closed`, `deleted`, `seen`) VALUES
(12, 4, 2, 'Thor Odinson', 'no.2,Kandy Rd,Kurunegala', '071-4290810', '1', '4', '20', '2', '', 40, 'new', 0, 0, 0),
(13, 2, 1, 'Pepper Potts', 'No 2,Nuwaraeliya road, Thalawakelle', '071-1266245', '3', '5,17,6', '15,113.5,2300', '12,25,1', '', 5318, 'seen', 0, 0, 0),
(14, 2, 2, 'Tony Stark', 'No 2,Nuwaraeliya road, Thalawakelle', '071-1266278', '2', '4,23', '20,999.5', '12,5', '', 5238, 'new', 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `pharmacytable`
--

CREATE TABLE `pharmacytable` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `License_no` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `contact_number` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `latitude` float NOT NULL,
  `longitude` float NOT NULL,
  `delivery_supported` tinyint(1) NOT NULL,
  `is_closed` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pharmacytable`
--

INSERT INTO `pharmacytable` (`id`, `username`, `password`, `name`, `License_no`, `address`, `contact_number`, `email`, `latitude`, `longitude`, `delivery_supported`, `is_closed`) VALUES
(1, 'New Pharmacy', '$2y$10$SUkO0oGEyWXL7CPHyIH4V.mfXEpxSUJJGif6qbtn64OUtNVdfn/rO', 'New Pharmacy', '1234E', '12\\2,Kandy road,Kurunegala', '012-1212123', 'newpharmacy123@gmail.com', 7.4818, 80.3609, 1, 0),
(2, 'Lanka Pharmacy', '$2y$10$i6uod78BtGhd.qZvN5nO/./wwBbn/6C42HRCNOC6xkXejax.IDU4W', 'Lanka Pharmacy', 'abcd', 'No.7,Colombo Rd,Monaragala', '012-1212178', 'lankapharmacy00@gmail.com', 6.88842, 81.3439, 1, 0),
(3, 'Asiri Pharmacy', '$2y$10$AEjqDR8/oItigkSIXBRutOYNq89mmUiZcl9DGGJrNUH6p.f2LEeZG', 'Asiri Pharmacy', '12345', 'no 12, Colombo', '011 - 1234333', 'asiri@gmil.com', 1.23, 80, 0, 0),
(4, 'Jaya Pharmacy', '$2y$10$SeYq9T0tDTatxZJJ2rHkL.HlKmqMt8K7ScPO1ywOKLXgYGgpu6hge', 'Jaya Pharmacy', '119119R', 'No.9,Akuressa Rd,Galle', '012-1212124', 'jayapharm99@gmail.com', 6.03575, 80.2384, 0, 0),
(5, 'United Pharmacy', '$2y$10$HyCXLJ8KZo2tUIDiSBaMS.oFV8Fta73iXoxWkTCp7a/NtIwqmBkAy', 'United Pharmacy', '1234G', 'No.23,Bandarawela Rd,Badulla', '012-1911913', 'unitedpharm23@yahoo.com', 6.98862, 81.0574, 1, 0),
(6, 'Lanka Pharm', '$2y$10$PG44kJYSKARnxXW2FZcHIujXLOmJ8lkUbuadj3W0ZWjrplgAbLc2e', 'Lanka Pharmacy', '245GL', 'No.78,Kandy Rd,Gampola', '099-1212998', 'lankapharmacy66@gmail.com', 7.16491, 80.5694, 0, 0),
(7, 'City Pharmacy', '$2y$10$qRt0Qixkhkoj2vV6T0vOFOubMR0tcXoBzTnf1EtY0zTlsEXxqqTUO', 'City Pharmacy', '567CK', 'No.22,Badulla Rd,Mahiyanganaya', '099-1212001', 'citypharmacy404@gmail.com', 7.33816, 80.9989, 1, 0),
(8, 'Suwasewana Pharmacy', '$2y$10$.sFhXwh9.g5ixS2g/xutCedaa4PtGp4hOd4EQ9NFFc0afO0yrVIBO', 'Suwasewana Pharmacy', '356CG', 'N0 534, Peradeniya Rd, Kandy', '0812634405', 'suwasewanapharm@gmail.com', 7.26222, 80.5928, 1, 0),
(9, 'Union Pharmacy', '$2y$10$nQX8gqpgC3uWH30DnMnlLuRD7FqYet01v0K4aI4azVh3SeChMic3S', 'Union Pharmacy', '267C', 'No 200, Dikwalla Rd, Galle', '091-2245455', 'unionpharm@gmail.com', 6.03649, 80.2166, 0, 0),
(10, 'Liberty Pharmacy', '$2y$10$vx2JhNpNmgIa8JywjLCxeO2GKyhS9bB0Lr/IAv2T.VI.a2uksLIcq', 'Liberty Pharmacy', '6789L', 'No 24, Borella Road, Colombo', '011-3422233', 'libertypharm@gmail.com', 6.91141, 79.8836, 0, 0),
(11, 'City Medicals', '$2y$10$71KV1b47SMYlDFPqaBUyEOd5VnlvlazhpkFee5DKpmFVPad7BE9bC', 'City Medicals', '2345B', 'No 23, Kesbawa Road, Colombo', '011-1233363', 'citymedicals@gmail.com', 6.79416, 79.9519, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `prefilledformtable`
--

CREATE TABLE `prefilledformtable` (
  `id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `pharmacy_id` int(11) NOT NULL,
  `no_of_all_item` int(255) DEFAULT NULL,
  `no_of_items` varchar(255) DEFAULT NULL,
  `itemIds` varchar(255) DEFAULT NULL,
  `quantities` varchar(255) DEFAULT NULL,
  `prescription` varchar(255) NOT NULL,
  `deleted` tinyint(1) DEFAULT 0,
  `form_sent` tinyint(1) DEFAULT 0,
  `seen` tinyint(1) NOT NULL DEFAULT 0,
  `sent_date` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `prefilledformtable`
--

INSERT INTO `prefilledformtable` (`id`, `customer_id`, `pharmacy_id`, `no_of_all_item`, `no_of_items`, `itemIds`, `quantities`, `prescription`, `deleted`, `form_sent`, `seen`, `sent_date`) VALUES
(19, 4, 1, NULL, NULL, NULL, NULL, 'uploads/prescriptions/prescription01.txt', 0, 0, 0, '2022-01-20'),
(20, 2, 1, NULL, NULL, NULL, NULL, 'uploads/prescriptions/prescription.jpg', 0, 0, 0, '2022-01-20'),
(21, 2, 2, 3, '3', '11,18,4', '21,12,20', 'uploads/prescriptions/prescription_legible_roj_17jan24.jpg', 0, 1, 0, '2022-01-20');

-- --------------------------------------------------------

--
-- Table structure for table `usertable`
--

CREATE TABLE `usertable` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `nic` varchar(20) NOT NULL,
  `address` varchar(255) NOT NULL,
  `mobile_number` varchar(20) NOT NULL,
  `email` varchar(255) NOT NULL,
  `longitude` float NOT NULL,
  `latitude` float NOT NULL,
  `role` varchar(255) NOT NULL DEFAULT 'customer',
  `nearbypharmacies` varchar(500) NOT NULL,
  `is_closed` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `usertable`
--

INSERT INTO `usertable` (`id`, `username`, `password`, `name`, `nic`, `address`, `mobile_number`, `email`, `longitude`, `latitude`, `role`, `nearbypharmacies`, `is_closed`) VALUES
(1, 'superuser', '$2y$10$SUaVPNUh/v7iGFQNiGN4RO6P4WTL1FjI2.RhSGuyhQRjHPCwXutz.', 'Super User', '997852332V', 'no.1,Colomo 01,Sri Lanka', '012-0000000', 'superadmin01@gmail.com', 6.9378, 79.8437, 'super_admin', '1,7,8,6,10,5,11,2,9,4', 0),
(2, 'Tony', '$2y$10$8mL.0Wtkrp9oOCqgIfS0QuEqGrx4SMhxqL7yOczTFUL7Ols4FCOD2', 'Tony Stark', '993530328V', 'No 2,Nuwaraeliya road, Thalawakelle', '071-1266278', 'ironman00@gmail.com', 80.4239, 8.31559, 'customer', '1,8,7,6,5,10,11,2,4,9', 0),
(3, 'Steve', '$2y$10$rctFBzKAARnZCTzmveP8Fu5sB3M.Jq4PK880fsk.BjK3BcHJgIqyG', 'Steve Rogers', '997942332V', 'no.1,Jaya Mawatha', '070-3806687', 'captainamerica@gmail.com', 79.8939, 6.8719, 'customer', '10,11,6,1,8,9,4,5,7,2', 0),
(4, 'Thor', '$2y$10$wZbNP7c93Sm.cyveMWM1Fe7q0p6cjhlTwLnoplPDyP183vdl0qVv.', 'Thor Odinson', '991892354V', 'no.2,Kandy Rd,Kurunegala', '071-4290810', 'thorodinson@gmail.com', 80.4448, 7.41605, 'customer', '1,8,6,7,5,10,11,2,4,9', 0),
(5, 'Peter', '$2y$10$yr2bkLYWbi5q9gHLoXs3K.ySBPB0klSsLuad8pxW0FvgFtsQ0dA5.', 'Peter Parker', '990861552V', 'No.6,Nadun Uyana,Matara', '076-2675516', 'peterparker@gmail.com', 80.5763, 5.94935, 'customer', '4,9,11,5,10,2,6,8,7,1', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `applicationtable`
--
ALTER TABLE `applicationtable`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `itemtable`
--
ALTER TABLE `itemtable`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mediatortable`
--
ALTER TABLE `mediatortable`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `offertable`
--
ALTER TABLE `offertable`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ordertable`
--
ALTER TABLE `ordertable`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pharmacytable`
--
ALTER TABLE `pharmacytable`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `prefilledformtable`
--
ALTER TABLE `prefilledformtable`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `usertable`
--
ALTER TABLE `usertable`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `applicationtable`
--
ALTER TABLE `applicationtable`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `itemtable`
--
ALTER TABLE `itemtable`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `mediatortable`
--
ALTER TABLE `mediatortable`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=67;

--
-- AUTO_INCREMENT for table `offertable`
--
ALTER TABLE `offertable`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `ordertable`
--
ALTER TABLE `ordertable`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `pharmacytable`
--
ALTER TABLE `pharmacytable`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `prefilledformtable`
--
ALTER TABLE `prefilledformtable`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `usertable`
--
ALTER TABLE `usertable`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
