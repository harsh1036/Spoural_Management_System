-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 19, 2025 at 05:49 PM
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
-- Database: `spoural`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`username`, `password`) VALUES
('admin', 'admin123');

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` int(11) NOT NULL,
  `admin_id` varchar(100) NOT NULL,
  `admin_name` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `admin_id`, `admin_name`, `password`) VALUES
(1, 'd24ce101', 'abc', '123');

-- --------------------------------------------------------

--
-- Table structure for table `departments`
--

CREATE TABLE `departments` (
  `id` int(50) NOT NULL,
  `dept_id` int(50) NOT NULL,
  `dept_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `departments`
--

INSERT INTO `departments` (`id`, `dept_id`, `dept_name`) VALUES
(1, 1, 'CSPIT-CE'),
(2, 2, 'CSPIT-IT'),
(3, 3, 'Depstar-CE'),
(4, 4, 'Depstar-IT');

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `id` int(11) NOT NULL,
  `event_name` varchar(255) NOT NULL,
  `event_type` enum('Sports','Cultural') NOT NULL,
  `min_participants` int(50) NOT NULL,
  `max_participants` int(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`id`, `event_name`, `event_type`, `min_participants`, `max_participants`) VALUES
(1, 'Cricket', 'Sports', 15, 15),
(2, 'Badminton', 'Sports', 10, 15),
(3, 'Garba', 'Cultural', 10, 20),
(4, 'Fashion Show', 'Cultural', 5, 10),
(7, 'Football', 'Sports', 15, 15);

-- --------------------------------------------------------

--
-- Table structure for table `participants`
--

CREATE TABLE `participants` (
  `id` int(50) NOT NULL,
  `student_id` varchar(50) NOT NULL,
  `dept_id` int(50) NOT NULL,
  `event_id` int(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `participants`
--

INSERT INTO `participants` (`id`, `student_id`, `dept_id`, `event_id`) VALUES
(1, '12ce001', 1, 4),
(2, '12ce002', 1, 4),
(3, '12ce003', 1, 4),
(4, '12ce004', 1, 4),
(5, '12ce005', 1, 4),
(6, '12ce006', 1, 4),
(7, '12ce007', 1, 4),
(8, '12ce008', 1, 4),
(9, '12ce009', 1, 4),
(11, '12ce011', 1, 4);

-- --------------------------------------------------------

--
-- Table structure for table `ulsc`
--

CREATE TABLE `ulsc` (
  `id` int(11) NOT NULL,
  `ulsc_id` varchar(50) NOT NULL,
  `ulsc_name` varchar(100) NOT NULL,
  `dept_id` int(50) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ulsc`
--

INSERT INTO `ulsc` (`id`, `ulsc_id`, `ulsc_name`, `dept_id`, `password`) VALUES
(3, '23ce94', 'jay', 1, 'znqf3NYv8P'),
(4, 'd24ce155', 'hitarth', 1, '$2y$10$AmWaOAcN1K8lfyCYfmJrb.umW1gYtxSnrgh655jMCyxfI2wM79tsC'),
(5, 'd24it150', 'harsh', 2, '$2y$10$AmWaOAcN1K8lfyCYfmJrb.umW1gYtxSnrgh655jMCyxfI2wM79tsC'),
(6, '23DCE001', 'Raj', 3, '$2y$10$hp5iPC6W1ono4DFlwQdrfOL6LPVMzGXYlC422CUm74yKfx3zT0pvG');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `departments`
--
ALTER TABLE `departments`
  ADD PRIMARY KEY (`dept_id`);

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `participants`
--
ALTER TABLE `participants`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ulsc`
--
ALTER TABLE `ulsc`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `ulsc_id` (`ulsc_id`),
  ADD KEY `fk_ulsc_department` (`dept_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `departments`
--
ALTER TABLE `departments`
  MODIFY `dept_id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `participants`
--
ALTER TABLE `participants`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `ulsc`
--
ALTER TABLE `ulsc`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `ulsc`
--
ALTER TABLE `ulsc`
  ADD CONSTRAINT `fk_ulsc_department` FOREIGN KEY (`dept_id`) REFERENCES `departments` (`dept_id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
