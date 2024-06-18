-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 18, 2024 at 06:29 PM
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
-- Database: `db_scholarship`
--

-- --------------------------------------------------------

--
-- Table structure for table `application_info`
--

CREATE TABLE `application_info` (
  `application_id` int(11) NOT NULL,
  `application_type` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `parent_guardian_id` int(11) NOT NULL,
  `applicant_gwa` int(11) NOT NULL,
  `applicant_school` int(11) NOT NULL,
  `applicant_level` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `father_info`
--

CREATE TABLE `father_info` (
  `father_id` int(11) NOT NULL,
  `father_name` varchar(50) NOT NULL,
  `father_address` varchar(50) NOT NULL,
  `father_contact` varchar(12) NOT NULL,
  `father_occupation` varchar(50) NOT NULL,
  `father_waddress` varchar(50) NOT NULL,
  `father_age` varchar(50) NOT NULL,
  `father_citizenship` varchar(50) NOT NULL,
  `father_religion` varchar(50) NOT NULL,
  `father_bdate` date NOT NULL,
  `parent_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `guardian_info`
--

CREATE TABLE `guardian_info` (
  `guardian_id` int(11) NOT NULL,
  `guardian_name` varchar(50) NOT NULL,
  `applicant_relation` varchar(50) NOT NULL,
  `guardian_address` varchar(50) NOT NULL,
  `guardian_residency` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `mother_info`
--

CREATE TABLE `mother_info` (
  `mother_id` int(11) NOT NULL,
  `mother_name` varchar(50) NOT NULL,
  `mother_address` varchar(50) NOT NULL,
  `mother_occupation` varchar(50) NOT NULL,
  `mother_waddress` varchar(50) NOT NULL,
  `mother_age` varchar(50) NOT NULL,
  `mother_citizenship` varchar(50) NOT NULL,
  `mother_religion` varchar(50) NOT NULL,
  `mother_bdate` date NOT NULL,
  `parent_id` int(11) NOT NULL,
  `mother_contact` varchar(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `parent_guardian_info`
--

CREATE TABLE `parent_guardian_info` (
  `parent_guardian_id` int(11) NOT NULL,
  `father_id` int(11) NOT NULL,
  `mother_id` int(11) NOT NULL,
  `guardian_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `password_resets`
--

INSERT INTO `password_resets` (`email`, `token`, `created_at`) VALUES
('percybunag.gg@gmail.com', 'b616c6ab8f850f43b641e1625e3d3637c439c3fa35975b2d15fa871e98c36cc590a70cc0ec9b50600f104ad5e296a1835b6b', '2024-06-14 12:57:49'),
('percybunag.gg@gmail.com', '4ad986734e5982719cce1b2db17ae07b6bdea9f18e204315cd6f4df41e4b36f9979b33c574961051fc48a7d70e665aa4cd25', '2024-06-14 12:58:17'),
('percybunag.gg@gmail.com', 'aa330220a62ec39b07f9e1a9722d902da0f4688c58abcba36cb865889fe7eebcc28afcd03e976a9aa6c6426db7dca7dbfdfb', '2024-06-14 12:59:03');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `middle_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `unit_floor_street` varchar(50) NOT NULL,
  `barangay` varchar(50) NOT NULL,
  `contact_no` varchar(15) NOT NULL,
  `email_address` varchar(50) NOT NULL,
  `bdate` date NOT NULL,
  `password` varchar(18) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `first_name`, `middle_name`, `last_name`, `gender`, `unit_floor_street`, `barangay`, `contact_no`, `email_address`, `bdate`, `password`) VALUES
(1, 'Percy', 'Sebastian', 'Bunag', 'Male', 'Gen. Yengco St.', 'Bayan Luma V', '09277714442', 'percybunag.gg@gmail.com', '1998-06-06', 'nigga'),
(2, 'John Michael', 'Arnedo', 'Irenea', 'male', '1234', 'Bayan Luma', '+1234567890', 'jmirenea@gmail.com', '1998-01-01', '1234'),
(3, 'Emmhan Russell', 'D.', 'Bantolin', 'male', '1234', 'Bayan Luma', '+1234567890', 'emmhanbantolin@gmail.com', '1998-01-01', '1234'),
(4, 'Dindo', 'Dawal', 'Dominguez', 'male', '1234', 'Bayan Luma', '+1234567890', 'dindodawaldominguez@gmail.com', '1998-01-01', '1234'),
(5, 'Giullian Marco', 'Cabrera', 'Dominguez', 'male', '1234', 'Bayan Luma', '09245678129', 'dawalism@gmail.com', '1998-01-01', '1234'),
(6, 'Nigga', 'Nigga', 'Nigga', 'male', '1234', 'Bayan Luma', '09245678129', 'nigga@gmail.com', '1998-01-01', '1234'),
(7, 'Emmanyakis', 'Nigga', 'Nigga', 'male', '123', 'Medicion II-A', '09245678129', 'emmanyakis@gmaill.com', '1998-01-01', '1234'),
(8, 'Emmanyakis', 'Nigga', 'Nigga', 'male', '123', 'Medicion II-A', '09245678129', 'emmanyakis@gmaill.com', '1998-01-01', '1234'),
(9, 'John', 'Paul', 'Doe', 'male', '1234 Main St.', 'Medicion I-A', '09277714442', 'Johndoe@gmail.com', '2001-01-01', 'Password'),
(10, 'Giullian Marco', 'Labas', 'Tite', 'Male', '1234 Main St.', 'Palico I', '09277714442', 'dawallabastite@gmail.com', '0000-00-00', '1234'),
(11, 'Percy', 'Sebastian', 'Bunag', 'Male', '94 Gen. Yengco St.', 'Pag-Asa II', '09277714442', 'percybunag@gmail.com', '1998-06-06', '1234');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `application_info`
--
ALTER TABLE `application_info`
  ADD PRIMARY KEY (`application_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `parent_guardian_id` (`parent_guardian_id`);

--
-- Indexes for table `father_info`
--
ALTER TABLE `father_info`
  ADD PRIMARY KEY (`father_id`);

--
-- Indexes for table `guardian_info`
--
ALTER TABLE `guardian_info`
  ADD PRIMARY KEY (`guardian_id`);

--
-- Indexes for table `mother_info`
--
ALTER TABLE `mother_info`
  ADD PRIMARY KEY (`mother_id`);

--
-- Indexes for table `parent_guardian_info`
--
ALTER TABLE `parent_guardian_info`
  ADD PRIMARY KEY (`parent_guardian_id`),
  ADD KEY `father_id` (`father_id`),
  ADD KEY `guardian_id` (`guardian_id`),
  ADD KEY `mother_id` (`mother_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `application_info`
--
ALTER TABLE `application_info`
  MODIFY `application_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `father_info`
--
ALTER TABLE `father_info`
  MODIFY `father_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `guardian_info`
--
ALTER TABLE `guardian_info`
  MODIFY `guardian_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `application_info`
--
ALTER TABLE `application_info`
  ADD CONSTRAINT `application_info_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`),
  ADD CONSTRAINT `application_info_ibfk_2` FOREIGN KEY (`parent_guardian_id`) REFERENCES `parent_guardian_info` (`parent_guardian_id`);

--
-- Constraints for table `parent_guardian_info`
--
ALTER TABLE `parent_guardian_info`
  ADD CONSTRAINT `parent_guardian_info_ibfk_1` FOREIGN KEY (`father_id`) REFERENCES `father_info` (`father_id`),
  ADD CONSTRAINT `parent_guardian_info_ibfk_2` FOREIGN KEY (`guardian_id`) REFERENCES `guardian_info` (`guardian_id`),
  ADD CONSTRAINT `parent_guardian_info_ibfk_3` FOREIGN KEY (`mother_id`) REFERENCES `mother_info` (`mother_id`),
  ADD CONSTRAINT `parent_guardian_info_ibfk_4` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
