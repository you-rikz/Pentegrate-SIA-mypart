-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 22, 2022 at 05:12 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pdc10_classes`
--

-- --------------------------------------------------------

--
-- Table structure for table `classes`
--

CREATE TABLE `classes` (
  `class_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `class_code` varchar(255) NOT NULL,
  `teacher_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `classes`
--

INSERT INTO `classes` (`class_id`, `name`, `description`, `class_code`, `teacher_id`) VALUES
(15, 'Advanced Information Management', 'pl/sql', 'AIM', 7),
(16, 'Professional Domain Course 1', 'mustache', 'PDC10', 5),
(17, 'Professional Domain Course 2', 'stylesheets', 'PDC20', 8),
(18, 'Object Oriented Programming', 'classes', 'OOP', 6);

-- --------------------------------------------------------

--
-- Table structure for table `class_rosters`
--

CREATE TABLE `class_rosters` (
  `roster_id` int(11) NOT NULL,
  `class_code` varchar(255) NOT NULL,
  `student_number` varchar(255) NOT NULL,
  `enrolled_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `class_rosters`
--

INSERT INTO `class_rosters` (`roster_id`, `class_code`, `student_number`, `enrolled_at`) VALUES
(20, 'PDC10', '14-0072-264', '2022-10-22 15:12:10'),
(21, 'PDC10', '18-2039-123', '2022-10-22 15:12:13'),
(22, 'PDC10', '18-0239-654', '2022-10-22 15:12:17'),
(23, 'PDC10', '14-3948-340', '2022-10-22 15:12:20'),
(24, 'OOP', '18-2039-123', '2022-10-22 15:12:24'),
(25, 'OOP', '14-3948-340', '2022-10-22 15:12:27'),
(26, 'AIM', '14-0072-264', '2022-10-22 15:12:30'),
(27, 'PDC20', '18-0239-654', '2022-10-22 15:12:35');

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `student_id` int(11) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `student_number` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `contact_number` varchar(255) NOT NULL,
  `program` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`student_id`, `first_name`, `last_name`, `student_number`, `email`, `contact_number`, `program`) VALUES
(50, 'Micoh', 'Yabut', '14-0072-264', 'yabut.micohjomarie@auf.edu.ph', '09123455678', 'BSIT'),
(51, 'Arnold', 'Leem', '18-2039-123', 'leem.arnold@auf.edu.ph', '09123849212', 'BSMT'),
(52, 'Kane', 'Castil', '18-0239-654', 'castil.kane@auf.edu.ph', '09348599833', 'BSAS'),
(53, 'Russ', 'Ronsil', '14-3948-340', 'ronsil.russ@auf.edu.ph', '09897874562', 'BSPT');

-- --------------------------------------------------------

--
-- Table structure for table `teachers`
--

CREATE TABLE `teachers` (
  `teacher_id` int(11) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `contact_number` varchar(255) NOT NULL,
  `employee_number` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `teachers`
--

INSERT INTO `teachers` (`teacher_id`, `first_name`, `last_name`, `email`, `contact_number`, `employee_number`) VALUES
(5, 'Romack', 'Natividad', 'natividad.romack@auf.edu.ph', '09123948298', '1602-333023'),
(6, 'Jonilo', 'Mababa', 'mababa.jonilo@auf.edu.ph', '09887543634', '1802-344023'),
(7, 'Adriane', 'Castro', 'castro.adriane@auf.edu.ph', '09128394875', '1799-948572'),
(8, 'Fernand', 'Layug', 'layug.fernand@auf.edu.ph', '09123849758', '2006-859684');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `classes`
--
ALTER TABLE `classes`
  ADD PRIMARY KEY (`class_id`),
  ADD KEY `code` (`class_code`),
  ADD KEY `teacher_id` (`teacher_id`);

--
-- Indexes for table `class_rosters`
--
ALTER TABLE `class_rosters`
  ADD PRIMARY KEY (`roster_id`),
  ADD KEY `class_code` (`class_code`),
  ADD KEY `student_number` (`student_number`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`student_id`),
  ADD KEY `student_number` (`student_number`);

--
-- Indexes for table `teachers`
--
ALTER TABLE `teachers`
  ADD PRIMARY KEY (`teacher_id`),
  ADD KEY `id` (`teacher_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `classes`
--
ALTER TABLE `classes`
  MODIFY `class_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `class_rosters`
--
ALTER TABLE `class_rosters`
  MODIFY `roster_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `student_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT for table `teachers`
--
ALTER TABLE `teachers`
  MODIFY `teacher_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `classes`
--
ALTER TABLE `classes`
  ADD CONSTRAINT `classes_ibfk_1` FOREIGN KEY (`teacher_id`) REFERENCES `teachers` (`teacher_id`);

--
-- Constraints for table `class_rosters`
--
ALTER TABLE `class_rosters`
  ADD CONSTRAINT `class_rosters_ibfk_1` FOREIGN KEY (`student_number`) REFERENCES `students` (`student_number`),
  ADD CONSTRAINT `class_rosters_ibfk_2` FOREIGN KEY (`class_code`) REFERENCES `classes` (`class_code`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
