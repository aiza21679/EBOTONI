-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 10, 2025 at 02:26 PM
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
-- Database: `eboto_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `Admin_ID` int(11) NOT NULL,
  `Name` varchar(100) NOT NULL,
  `Email` varchar(100) NOT NULL,
  `Password` varchar(100) NOT NULL,
  `last_login_at` date DEFAULT curdate()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`Admin_ID`, `Name`, `Email`, `Password`, `last_login_at`) VALUES
(123456789, 'Gamaliel Valcorza', 'admin123@gmail.com', '240be518fabd2724ddb6f04eeb1da5967448d7e831c08c8fa822809f74c720a9', '2025-11-10');

-- --------------------------------------------------------

--
-- Table structure for table `candidate`
--

CREATE TABLE `candidate` (
  `Candidate_ID` int(11) NOT NULL,
  `Student_ID` int(11) DEFAULT NULL,
  `Org_ID` int(11) DEFAULT NULL,
  `Platform` text DEFAULT NULL,
  `Position_ID` int(11) DEFAULT NULL,
  `status` enum('active','inactive') DEFAULT 'active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `election`
--

CREATE TABLE `election` (
  `Election_ID` int(11) NOT NULL,
  `Title` varchar(100) NOT NULL,
  `Start_Date` datetime NOT NULL,
  `End_Date` datetime NOT NULL,
  `Status` enum('Upcoming','Ongoing','Ended') DEFAULT 'Upcoming',
  `published_at` datetime DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `position`
--

CREATE TABLE `position` (
  `Position_ID` int(11) NOT NULL,
  `Position_Name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `position`
--

INSERT INTO `position` (`Position_ID`, `Position_Name`) VALUES
(1, 'President'),
(2, 'Vice President'),
(3, 'Secretary'),
(4, 'Treasurer'),
(5, 'Auditor'),
(6, 'Public Relations Officer'),
(7, 'Tech Lead'),
(8, 'Board Member');

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE `student` (
  `Student_ID` int(11) NOT NULL,
  `Name` varchar(100) NOT NULL,
  `Email` varchar(100) NOT NULL,
  `Password` varchar(255) NOT NULL,
  `Course` varchar(50) NOT NULL,
  `Year_Level` int(1) NOT NULL,
  `status` enum('Active','Pending','Inactive') DEFAULT 'Pending',
  `profile_photo_url` varchar(255) DEFAULT NULL,
  `last_login_at` date DEFAULT curdate()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`Student_ID`, `Name`, `Email`, `Password`, `Course`, `Year_Level`, `status`, `profile_photo_url`, `last_login_at`) VALUES
(2023301655, 'Lars Manayaga', 'larsmanayaga@gmail.com', '$2y$10$drBT6.z8bbE/nOjoaqlcYuCVbJDRgaf/dzRcX47wpsXau/vf7MP.e', 'Information Technology', 3, 'Active', '../assests/default-avatar.jpg', '2025-11-07');

-- --------------------------------------------------------

--
-- Table structure for table `student_organization`
--

CREATE TABLE `student_organization` (
  `Org_ID` int(11) NOT NULL,
  `Org_Name` varchar(100) NOT NULL,
  `Description` text DEFAULT NULL,
  `Email` varchar(255) DEFAULT NULL,
  `Password` varchar(255) DEFAULT NULL,
  `Logo_Url` varchar(255) DEFAULT NULL,
  `Registered_At` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `student_organization`
--

INSERT INTO `student_organization` (`Org_ID`, `Org_Name`, `Description`, `Email`, `Password`, `Logo_Url`, `Registered_At`) VALUES
(2, 'Information Technology', 'Department Of Information Technology', 'it@gmail.com', '$2y$10$siWSDEBatkZ8tBHCz8vsquHwV.v5dSwTy4UrfWq4hTdRkUuGTkpNG', '../admin/soce.png', '2025-11-01 21:03:00'),
(3, 'Naval Architecture and Marine Engineering', 'Department of NAME', 'name@gmail.com', '$2y$10$fDXZat6H8pYW17gczUkm4eJvzKweW5VcGCWFA0r/DjHTwmP0KjZlu', '../admin/name.jpg', '2025-11-03 15:42:29'),
(4, 'The Cache', 'The Cache Publication', 'cache@gmail.com', '$2y$10$pv.iFlfJI.tgAcacwG/9deUMORjTQV2Io5Qi8aWI3nIARWtdjcS0C', '../admin/tc.jpg', '2025-11-03 22:20:45'),
(5, 'Technology Communication Management', 'Department of TCM', 'tcm@gmail.com', '$2y$10$o//cTvKL.S87E9Pa06imFOs7vqsxO5Je0jbzSZYc5DwpHhzLYmaPi', '../admin/tcm.jpg', '2025-11-03 22:22:34'),
(6, 'Energy Systems and Management', 'Department of ESM', 'esm@gmail.com', '$2y$10$KOnhdL/bIISGhT4iqZ0EnOyNUzDLioGrNdXXj1pgnvTulyvSyXKzO', '../admin/esm.jpg', '2025-11-03 22:24:33'),
(7, 'Manufacturing Engineering Technology', 'Department of MET', 'met@gmail.com', '$2y$10$X0gFGaXFiv5wRbZeFUXs5uYoiU8XXtWHS75dI2IZfSKq09HDeYxoe', '../admin/met.jpg', '2025-11-03 22:26:14'),
(8, 'University Student Government', 'USG - USTP JASAAN', 'usg@gmail.com', '$2y$10$Rg1C7AeZHUd1peHk3LJyfeEI.f8Iu3cnc.8oTHAl6.fCg/VsC9MCW', '../admin/usg.jpg', '2025-11-03 22:29:33');

-- --------------------------------------------------------

--
-- Table structure for table `student_organization_members`
--

CREATE TABLE `student_organization_members` (
  `id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `org_id` int(11) NOT NULL,
  `joined_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `student_organization_members`
--

INSERT INTO `student_organization_members` (`id`, `student_id`, `org_id`, `joined_at`) VALUES
(71, 2023301655, 2, '2025-11-09 11:22:27'),
(72, 2023301655, 8, '2025-11-09 11:22:27'),
(73, 2023301655, 4, '2025-11-09 11:22:27');

-- --------------------------------------------------------

--
-- Table structure for table `vote`
--

CREATE TABLE `vote` (
  `Vote_ID` int(11) NOT NULL,
  `Student_ID` int(11) DEFAULT NULL,
  `Election_ID` int(11) DEFAULT NULL,
  `Candidate_ID` int(11) DEFAULT NULL,
  `Timestamp` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`Admin_ID`),
  ADD UNIQUE KEY `Email` (`Email`);

--
-- Indexes for table `candidate`
--
ALTER TABLE `candidate`
  ADD PRIMARY KEY (`Candidate_ID`),
  ADD KEY `Student_ID` (`Student_ID`),
  ADD KEY `Org_ID` (`Org_ID`),
  ADD KEY `fk_candidate_position` (`Position_ID`);

--
-- Indexes for table `election`
--
ALTER TABLE `election`
  ADD PRIMARY KEY (`Election_ID`),
  ADD KEY `created_by` (`created_by`);

--
-- Indexes for table `position`
--
ALTER TABLE `position`
  ADD PRIMARY KEY (`Position_ID`);

--
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`Student_ID`);

--
-- Indexes for table `student_organization`
--
ALTER TABLE `student_organization`
  ADD PRIMARY KEY (`Org_ID`);

--
-- Indexes for table `student_organization_members`
--
ALTER TABLE `student_organization_members`
  ADD PRIMARY KEY (`id`),
  ADD KEY `student_id` (`student_id`),
  ADD KEY `org_id` (`org_id`);

--
-- Indexes for table `vote`
--
ALTER TABLE `vote`
  ADD PRIMARY KEY (`Vote_ID`),
  ADD KEY `Student_ID` (`Student_ID`),
  ADD KEY `Election_ID` (`Election_ID`),
  ADD KEY `Candidate_ID` (`Candidate_ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `candidate`
--
ALTER TABLE `candidate`
  MODIFY `Candidate_ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `election`
--
ALTER TABLE `election`
  MODIFY `Election_ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `position`
--
ALTER TABLE `position`
  MODIFY `Position_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `student_organization`
--
ALTER TABLE `student_organization`
  MODIFY `Org_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `student_organization_members`
--
ALTER TABLE `student_organization_members`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=74;

--
-- AUTO_INCREMENT for table `vote`
--
ALTER TABLE `vote`
  MODIFY `Vote_ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `candidate`
--
ALTER TABLE `candidate`
  ADD CONSTRAINT `candidate_ibfk_1` FOREIGN KEY (`Student_ID`) REFERENCES `student` (`Student_ID`),
  ADD CONSTRAINT `candidate_ibfk_2` FOREIGN KEY (`Org_ID`) REFERENCES `student_organization` (`Org_ID`),
  ADD CONSTRAINT `fk_candidate_position` FOREIGN KEY (`Position_ID`) REFERENCES `position` (`Position_ID`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `election`
--
ALTER TABLE `election`
  ADD CONSTRAINT `election_ibfk_1` FOREIGN KEY (`created_by`) REFERENCES `admin` (`Admin_ID`);

--
-- Constraints for table `student_organization_members`
--
ALTER TABLE `student_organization_members`
  ADD CONSTRAINT `student_organization_members_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `student` (`Student_ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `student_organization_members_ibfk_2` FOREIGN KEY (`org_id`) REFERENCES `student_organization` (`Org_ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `vote`
--
ALTER TABLE `vote`
  ADD CONSTRAINT `vote_ibfk_1` FOREIGN KEY (`Student_ID`) REFERENCES `student` (`Student_ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `vote_ibfk_2` FOREIGN KEY (`Election_ID`) REFERENCES `election` (`Election_ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `vote_ibfk_3` FOREIGN KEY (`Candidate_ID`) REFERENCES `candidate` (`Candidate_ID`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
