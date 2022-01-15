-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 15, 2022 at 09:54 PM
-- Server version: 10.4.19-MariaDB
-- PHP Version: 8.0.6

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
(1, 'newpharmacy123@gmail.com', 'New Pharmacy', 7.4818, 80.3609, 1, 'uploads/Evidence01.txt', 'declined', 0, '12\\2,Kandy road,Kurunegala', '012-1212123', 0),
(2, 'jayapharm99@gmail.com', 'Jaya Pharmacy', 6.03575, 80.2384, 0, 'uploads/Evidence02.docx', 'declined', 0, 'No.9,Akuressa Rd,Galle', '012-1212124', 0),
(3, 'lankapharmacy00@gmail.com', 'Lanka Pharmacy', 6.88842, 81.3439, 1, 'uploads/Evidence03.txt', 'approved', 1, 'No.7,Colombo Rd,Monaragala', '012-1212178', 0),
(4, 'unitedpharm23@yahoo.com', 'United Pharmacy', 6.98862, 81.0574, 1, 'uploads/Evidence04.txt', 'pending', 0, 'No.23,Bandarawela Rd,Badulla', '012-1911913', 0),
(5, 'lankapharmacy66@gmail.com', 'Lanka Pharmacy', 7.16491, 80.5694, 0, 'uploads/Evidence05.txt', 'pending', 0, 'No.78,Kandy Rd,Gampola', '099-1212998', 0),
(6, 'citypharmacy404@gmail.com', 'City Pharmacy', 7.33816, 80.9989, 1, 'uploads/Evidence06.txt', 'pending', 0, 'No.22,Badulla Rd,Mahiyanganaya', '099-1212001', 0),
(7, 'asiriph@gmil.com', 'Asiri Pharmacy', 7.23, 80, 1, 'uploads/Evidence07.txt', 'approved', 1, 'no 12, Jaya Mawatha, Colombo 7', '011 - 1234333', 0);

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
(2, 'SILOCIN 4', 'NP1403M', 'CAPSULES', 1200, 16, 1, 1, 0),
(3, 'SITALO  100', 'NP3863M', 'FILM COA', 920, 120, 1, 1, 0),
(4, 'PANADOL', 'NP3383M', 'CARDS', 539, 20, 0, 2, 0),
(5, 'SAMAHAN', 'R3214M', 'PACKET', 770, 15, 0, 1, 0),
(6, 'SUSTAGEN', 'NP2239M', 'TIN', 50, 2300, 0, 1, 0),
(7, 'URIMAX 0.4 mg', 'R2406M', 'TABLETS', 390, 8.5, 1, 3, 0),
(8, 'GEFTIWEL 250', 'NP2043M', 'TABLETS', 589, 4.75, 1, 1, 0),
(9, 'PANADOL', 'NP3383M', 'BOTTLE', 539, 20, 0, 1, 0),
(10, 'Paracitamol', 'pa123', '12', 1000, 10, 1, 1, 0);

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
(3, 'Asiri Pharmacy', '$2y$10$AEjqDR8/oItigkSIXBRutOYNq89mmUiZcl9DGGJrNUH6p.f2LEeZG', 'Asiri Pharmacy', '12345', 'no 12, Colombo', '011 - 1234333', 'asiri@gmil.com', 1.23, 80, 0, 1);

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
(1, 'SuperUser', '$2y$10$f1JH1D67Vai7q/IMgMWDjO9VwhCyyZDv30TxmjZ.vecm/CODAZHpW', 'Super User', '997852332V', 'no.1,Colomo 01,Sri Lanka', '012-0000000', 'superadmin01@gmail.com', 6.9378, 79.8437, 'super_admin', '1,2', 0),
(2, 'Tony', '$2y$10$8mL.0Wtkrp9oOCqgIfS0QuEqGrx4SMhxqL7yOczTFUL7Ols4FCOD2', 'Tony Stark', '993530328V', 'Avengers HeadQuarters, New York', '071-1266278', 'ironman00@gmail.com', 80.4239, 8.31559, 'customer', '1,2', 0),
(3, 'Steve', '$2y$10$rctFBzKAARnZCTzmveP8Fu5sB3M.Jq4PK880fsk.BjK3BcHJgIqyG', 'Steve Rogers', '997942332V', 'no.1,Jaya Mawatha', '070-3806687', 'captainamerica@gmail.com', 79.8939, 6.8719, 'customer', '1,2', 0),
(4, 'Thor', '$2y$10$wZbNP7c93Sm.cyveMWM1Fe7q0p6cjhlTwLnoplPDyP183vdl0qVv.', 'Thor Odinson', '991892354V', 'no.2,Kandy Rd,Kurunegala', '071-4290810', 'thorodinson@gmail.com', 80.4448, 7.41605, 'customer', '1,2', 0),
(5, 'Peter', '$2y$10$yr2bkLYWbi5q9gHLoXs3K.ySBPB0klSsLuad8pxW0FvgFtsQ0dA5.', 'Peter Parker', '990861552V', 'No.6,Nadun Uyana,Matara', '076-2675516', 'peterparker@gmail.com', 80.5763, 5.94935, 'customer', '2,1', 0),
(6, 'Natasha', '$2y$10$72fmKgPheRYhNB9LFn2z/urzUkoY/ZD2ShRJr5xhMYbe/Fb6Q547a', 'Natasha Romanoff', '807643552V', 'UOM', '077-3243554', 'blackwidow@gmail.com', 80, 1.23, 'customer', '2,1', 0),
(7, 'Clint', '$2y$10$l4/Dt8MHNsQUIzdFjbFkQOd.dXhEj.X7ZKbNIz6UC3pnavBC5WT7K', 'Clint Barton', '804534221V', 'UOM', '070-9876234', 'hawkeye@gmail.com', 81, 6.8, 'customer', '2,1', 0);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `itemtable`
--
ALTER TABLE `itemtable`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `mediatortable`
--
ALTER TABLE `mediatortable`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- AUTO_INCREMENT for table `offertable`
--
ALTER TABLE `offertable`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `ordertable`
--
ALTER TABLE `ordertable`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `pharmacytable`
--
ALTER TABLE `pharmacytable`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `prefilledformtable`
--
ALTER TABLE `prefilledformtable`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `usertable`
--
ALTER TABLE `usertable`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
