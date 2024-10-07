-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 18, 2024 at 05:14 PM
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
-- Database: `prodb`
--

-- --------------------------------------------------------

--
-- Table structure for table `adminlogin`
--

CREATE TABLE `adminlogin` (
  `admin_id` int(10) NOT NULL,
  `password` varchar(200) NOT NULL,
  `Email` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `adminlogin`
--

INSERT INTO `adminlogin` (`admin_id`, `password`, `Email`) VALUES
(0, '$2y$10$JT2Noc4qiA8c7GwLJWngne6/e/ZpErv231QR63L.WE/c2rubClwbC', 'admin@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `fare`
--

CREATE TABLE `fare` (
  `fare_id` int(11) NOT NULL,
  `no_of_stations` int(11) DEFAULT NULL,
  `fare` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `fare`
--

INSERT INTO `fare` (`fare_id`, `no_of_stations`, `fare`) VALUES
(1, 5, 100.00),
(2, 10, 135.00),
(3, 15, 150.00),
(4, 20, 185.00),
(5, 25, 270.00),
(6, 30, 355.00);

-- --------------------------------------------------------

--
-- Table structure for table `group_table`
--

CREATE TABLE `group_table` (
  `group_id` int(11) NOT NULL,
  `Group_name` varchar(255) NOT NULL,
  `no_of_members` int(11) DEFAULT NULL,
  `source_id` int(11) DEFAULT 1,
  `destination_id` int(11) DEFAULT NULL,
  `fare_id` int(11) DEFAULT NULL,
  `createddate` date DEFAULT current_timestamp(),
  `approveddate` date DEFAULT NULL,
  `status` enum('approved','pending','rejected') DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `group_table`
--

INSERT INTO `group_table` (`group_id`, `Group_name`, `no_of_members`, `source_id`, `destination_id`, `fare_id`, `createddate`, `approveddate`, `status`) VALUES
(32, 'dsdsda', 1, 1, 2, NULL, NULL, NULL, 'pending'),
(33, 'dsdsda', 1, 1, 2, NULL, NULL, NULL, 'pending'),
(34, 'Chengalpattu', 1, 1, 28, NULL, NULL, NULL, 'pending'),
(35, 'thiruvallur', 1, 1, 49, NULL, '2024-02-18', NULL, 'pending');

-- --------------------------------------------------------

--
-- Table structure for table `personal`
--

CREATE TABLE `personal` (
  `stud_deptno` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `stud_name` varchar(255) NOT NULL,
  `dept_name` varchar(255) NOT NULL,
  `phone` varchar(15) DEFAULT NULL,
  `dob` date DEFAULT NULL,
  `location` varchar(255) DEFAULT NULL,
  `gender` enum('Male','Female','Others') DEFAULT NULL,
  `group_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `personal`
--

INSERT INTO `personal` (`stud_deptno`, `email`, `password`, `stud_name`, `dept_name`, `phone`, `dob`, `location`, `gender`, `group_id`) VALUES
('108', 'db@g.com', '$2y$10$RVN3hDAU/m8K2hHZJeL9aOofz2G37wQKezeM/tj7JRQz.gazz5iPy', 'darren', 'computer science', '278973899488378', '2024-02-14', 'japan', 'Male', 33),
('146', 'john@gmail.com', '$2y$10$fvqsYwMBbAnZE357R3xtYeKyur30poXm1Kwz1mbCnJvrkk6eOSPaC', 'john', 'computer', '0000000000', '2024-02-18', 'thiruvalllur', 'Male', 35),
('21-ucs-108', 'dar@gmail.com', '$2y$10$4Jyq6Y33o4qgjduki7HzBOjFaYHyRr1CIbgjeJKGCCwLQ.oBpNwnO', 'darren', 'computer', '00000000', '2024-02-06', 'chennai', 'Male', NULL),
('21-ucs-110', 'sudha@gmail.com', '$2y$10$sIxI9f7e6aBZFA9zJIl1feejUeH3u2vRDWSkLXu.MqvRTDIxP2ysW', 'sudha', 'computer', '000000000', '2024-03-09', 'chennai', 'Male', 34),
('21-ucs-152', 'karthik@gmail.com', '$2y$10$Ny.JMudXigUPR2EZrhFMV.DMwZ7uFGrbWH/g2qbGQhY0l0hzVoEJ.', 'kartthik', 'Computer Science', '00000000000000', '2024-02-18', 'arakkonam', 'Male', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `station`
--

CREATE TABLE `station` (
  `station_id` int(11) NOT NULL,
  `station_name` varchar(255) NOT NULL,
  `direction` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `station`
--

INSERT INTO `station` (`station_id`, `station_name`, `direction`) VALUES
(1, 'Nungambakkam (NBK)', 'source'),
(2, 'Chennai Chetpat (MSC)\n', 'common'),
(3, 'Chennai Egmore (MS)', 'common'),
(4, 'Chennai Park (MPK)', 'common'),
(5, 'Chennai Fort (MSF)', 'east'),
(6, 'Chennai Beach (MSB)', 'east'),
(7, 'Kodambakam (MKK)', 'west'),
(8, 'Mambalam (MBM)', 'west'),
(9, 'Saidapet (SP)', 'west'),
(10, 'Guindy (GDY)', 'west'),
(11, 'St Thomas Mount (STM)', 'west'),
(12, 'Palavanthangal (PZA)', 'west'),
(13, 'Minambakkam (MN)', 'west'),
(14, 'Trisulam (TLM)', 'west'),
(15, 'Pallavaram (PV)', 'west'),
(16, 'Chromepet (CMP)', 'west'),
(17, 'Tambaram Sanatorium (TBMS)', 'west'),
(18, 'Tambaram (TBM)', 'west'),
(19, 'Perungulattur (PRGL)', 'west'),
(20, 'Vandalur (VDR)', 'west'),
(21, 'Urappakkam (UPM)', 'west'),
(22, 'Guduvancheri (GI)', 'west'),
(23, 'Potheri Halt (POTI)', 'west'),
(24, 'Kattangulattur (CTM)', 'west'),
(25, 'Maraimalai Nagar (MMNK)', 'west'),
(26, 'Singaperumal Koil (SKL)', 'west'),
(27, 'Paranur (PWU)', 'west'),
(28, 'Chengalpattu (CGL)', 'west'),
(29, 'Chennai Moore Market Complex (MMCC)', 'north'),
(30, 'Basin Bridge Junction(BBQ)', 'north'),
(31, 'Vyasarpadi Jeeva(VJM)', 'north'),
(32, 'Perambur(PER)', 'north'),
(33, 'Perambur Carriage Works(PCW)', 'north'),
(34, 'Perambur Locomotive Works(PEW)', 'north'),
(35, 'Villivakkam(VLK)', 'north'),
(36, 'Korattur(KOTR)', 'north'),
(37, 'Pattaravakkam(PVM)', 'north'),
(38, 'Ambattur(ABU)', 'north'),
(39, 'Tirumullaivayil(TMVL)', 'north'),
(40, 'Annanur(ANNR)', 'north'),
(41, 'Avadi(AVD)', 'north'),
(42, 'Hindu College(HC)', 'north'),
(43, 'Pattabiram(PAB)', 'north'),
(44, 'Nemilicherry Halt(NEC)', 'north'),
(45, 'Tiruninravur(TI)', 'north'),
(46, 'Veppampattu(VEU)', 'north'),
(47, 'Sevvapet Road(SVR)', 'north'),
(48, 'Putlur Halt(PTLR)', 'north'),
(49, 'Tiruvallur(TRL)', 'north'),
(50, 'Egattur Halt(EGT)', 'north'),
(51, 'Kadambattur(KBT)', 'north'),
(52, 'Senji Panambakkam(SPAM)', 'north'),
(53, 'Manavur(MAF)', 'north'),
(54, 'Tiruvalangadu(TO)', 'north'),
(55, 'Mosur(MSU)', 'north'),
(56, 'Puliyamangalam(PLMG)', 'north'),
(57, 'Arakkonam Junction(AJJ)', 'north');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `fare`
--
ALTER TABLE `fare`
  ADD PRIMARY KEY (`fare_id`);

--
-- Indexes for table `group_table`
--
ALTER TABLE `group_table`
  ADD PRIMARY KEY (`group_id`),
  ADD KEY `fare_id` (`fare_id`),
  ADD KEY `source_id` (`source_id`),
  ADD KEY `destination_id` (`destination_id`);

--
-- Indexes for table `personal`
--
ALTER TABLE `personal`
  ADD PRIMARY KEY (`stud_deptno`),
  ADD KEY `group_id` (`group_id`);

--
-- Indexes for table `station`
--
ALTER TABLE `station`
  ADD PRIMARY KEY (`station_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `fare`
--
ALTER TABLE `fare`
  MODIFY `fare_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `group_table`
--
ALTER TABLE `group_table`
  MODIFY `group_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `station`
--
ALTER TABLE `station`
  MODIFY `station_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `group_table`
--
ALTER TABLE `group_table`
  ADD CONSTRAINT `group_table_ibfk_1` FOREIGN KEY (`fare_id`) REFERENCES `fare` (`fare_id`),
  ADD CONSTRAINT `group_table_ibfk_2` FOREIGN KEY (`source_id`) REFERENCES `station` (`station_id`),
  ADD CONSTRAINT `group_table_ibfk_3` FOREIGN KEY (`destination_id`) REFERENCES `station` (`station_id`);

--
-- Constraints for table `personal`
--
ALTER TABLE `personal`
  ADD CONSTRAINT `personal_ibfk_1` FOREIGN KEY (`group_id`) REFERENCES `group_table` (`group_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
