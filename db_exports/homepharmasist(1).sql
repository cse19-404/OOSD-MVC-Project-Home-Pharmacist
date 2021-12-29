-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 29, 2021 at 11:29 PM
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
(2, 'jayapharm99@gmail.com', 'Jaya Pharmacy', 6.03575, 80.2384, 0, 'uploads/Evidence02.docx', 'declined', 0, 'No.9,Akuressa Rd,Galle', '012-1212124', 0),
(3, 'lankapharmacy00@gmail.com', 'Lanka Pharmacy', 6.88842, 81.3439, 1, 'uploads/Evidence03.txt', 'approved', 1, 'No.7,Colombo Rd,Monaragala', '012-1212178', 0),
(4, 'unitedpharm23@yahoo.com', 'United Pharmacy', 6.98862, 81.0574, 1, 'uploads/Evidence04.txt', 'approved', 0, 'No.23,Bandarawela Rd,Badulla', '012-1911913', 0),
(5, 'lankapharmacy66@gmail.com', 'Lanka Pharmacy', 7.16491, 80.5694, 0, 'uploads/Evidence05.txt', 'pending', 0, 'No.78,Kandy Rd,Gampola', '099-1212998', 0),
(6, 'citypharmacy404@gmail.com', ' City Pharmacy', 7.33816, 80.9989, 1, 'uploads/Evidence06.txt', 'pending', 0, 'No.22,Badulla Rd,Mahiyanganaya', '099-1212001', 0),
(7, 'asiri@gmil.com', 'Asiri Pharmacy', 1.23, 80, 1, 'uploads/Evidence07.txt', 'approved', 1, 'no 12, Colombo', '011 - 1234333', 0);

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
(1, 'KLODIC', 'R3475M', 'TABLETS', 1350, 1000, 1, 1, 1),
(2, 'SILOCIN 4', 'NP1403M', 'CAPSULES', 1200, 16, 1, 1, 0),
(3, 'SITALO  100', 'NP3863M', 'FILM COA', 920, 120, 1, 1, 0),
(4, 'PANADOL', 'NP3383M', 'CARDS', 539, 20, 0, 1, 0),
(5, 'SAMAHAN', 'R3214M', 'PACKET', 770, 15, 0, 1, 0),
(6, 'SUSTAGEN', 'NP2239M', 'TIN', 50, 2300, 0, 1, 0),
(7, 'URIMAX 0.4 mg', 'R2406M', 'TABLETS', 390, 8.5, 1, 1, 0),
(8, 'GEFTIWEL 250', 'NP2043M', 'TABLETS', 589, 4.75, 1, 1, 0),
(9, 'PANADOL', 'NP3383M', 'BOTTLE', 539, 20, 0, 1, 0);

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
  `delivery_supported` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pharmacytable`
--

INSERT INTO `pharmacytable` (`id`, `username`, `password`, `name`, `License_no`, `address`, `contact_number`, `email`, `latitude`, `longitude`, `delivery_supported`) VALUES
(1, 'New Pharmacy', '$2y$10$SUkO0oGEyWXL7CPHyIH4V.mfXEpxSUJJGif6qbtn64OUtNVdfn/rO', 'New Pharmacy', '1234E', '12\\2,Kandy road,Kurunegala', '012-1212123', 'newpharmacy123@gmail.com', 7.4818, 80.3609, 1),
(2, 'Lanka Pharmacy', '$2y$10$i6uod78BtGhd.qZvN5nO/./wwBbn/6C42HRCNOC6xkXejax.IDU4W', 'Lanka Pharmacy', 'abcd', 'No.7,Colombo Rd,Monaragala', '012-1212178', 'lankapharmacy00@gmail.com', 6.88842, 81.3439, 1),
(3, 'Asiri Pharmacy', '$2y$10$AEjqDR8/oItigkSIXBRutOYNq89mmUiZcl9DGGJrNUH6p.f2LEeZG', 'Asiri Pharmacy', '12345', 'no 12, Colombo', '011 - 1234333', 'asiri@gmil.com', 1.23, 80, 1);

-- --------------------------------------------------------

--
-- Table structure for table `prefilledformtable`
--

CREATE TABLE `prefilledformtable` (
  `id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `pharmacy_id` int(11) NOT NULL,
  `no_of_items` varchar(255) NOT NULL,
  `items` varchar(255) NOT NULL,
  `unit_prices` varchar(255) NOT NULL,
  `quantities` varchar(255) NOT NULL,
  `prescription` varchar(255) NOT NULL,
  `total` double NOT NULL
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
  `nearbypharmacies` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `usertable`
--

INSERT INTO `usertable` (`id`, `username`, `password`, `name`, `nic`, `address`, `mobile_number`, `email`, `longitude`, `latitude`, `role`, `nearbypharmacies`) VALUES
(0, 'ron', '$2y$10$l4/Dt8MHNsQUIzdFjbFkQOd.dXhEj.X7ZKbNIz6UC3pnavBC5WT7K', 'Ron', '2345', 'UOM', '12345', 'ron@gmail.com', 81, 6.8, 'customer', 'Lanka Pharmacy,New Pharmacy,Asiri Pharmacy'),
(1, 'superuser01', '$2y$10$f1JH1D67Vai7q/IMgMWDjO9VwhCyyZDv30TxmjZ.vecm/CODAZHpW', 'Super Admin', '199900000000', 'no.1,Colomo 01,Sri Lanka', '012-0000000', 'superadmin01@gmail.com', 6.9378, 79.8437, 'super_admin', 'New Pharmacy,Lanka Pharmacy,Asiri Pharmacy'),
(2, 'banula', '$2y$10$xWVGeKlw4pC4TmtXp4J86e457.sqnVd.hzfJXTbqo3.ir30kYjgiu', 'Banula Kumarage', '993530328V', 'Airport Rd,Anuradapura', '071-1266278', 'banulakumarage@gmail.com', 80.4239, 8.31559, 'customer', 'New Pharmacy,Lanka Pharmacy,Asiri Pharmacy'),
(3, 'dakshina', '$2y$10$F/dex3eX4np3lc7j522TmuYJCjTJZd50gx3EKAw04ex0JVQdq4R1C', 'Dakshina Ranmal', '199933012565', 'no.1,Gunanandapura,Talawakelle', '070-3806687', 'dakshinaranmal1999@gmail.com', 79.8939, 6.8719, 'customer', 'New Pharmacy,Lanka Pharmacy,Asiri Pharmacy'),
(4, 'piumini', '$2y$10$/CS2A85.SPE40w5wNGLPaO9LPA2ctY71pj424ukxCHUEcdY2ClSHy', 'Piumini Kaveesha', '199974905080', 'no.2,Kandy Rd,Kurunegala', '071-4290810', 'piumini95kaveesha@gmail.com', 80.4448, 7.41605, 'customer', 'New Pharmacy,Lanka Pharmacy,Asiri Pharmacy'),
(5, 'hiruna', '$2y$10$s11uElEwGwXaEh/SHa/xeOgYFW4HACXV9ZJhrc.XxVy4GfmpfDa4i', 'Hiruna Hansaka', '990861552V', 'No.6,Nadun Uyana,Matara', '076-2675516', 'hirunahans@gmail.com', 80.5763, 5.94935, 'customer', 'Lanka Pharmacy,New Pharmacy,Asiri Pharmacy'),
(6, 'harry', '$2y$10$72fmKgPheRYhNB9LFn2z/urzUkoY/ZD2ShRJr5xhMYbe/Fb6Q547a', 'Harry', '12345', 'UOM', '12345', 'harry@gmail.com', 80, 1.23, 'customer', 'Asiri Pharmacy,Lanka Pharmacy,New Pharmacy');

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `pharmacytable`
--
ALTER TABLE `pharmacytable`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `prefilledformtable`
--
ALTER TABLE `prefilledformtable`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `usertable`
--
ALTER TABLE `usertable`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
