-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 06, 2025 at 02:11 PM
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
-- Database: `sia_enrollment_system`
--

-- --------------------------------------------------------

--
-- Table structure for table `applicants`
--

CREATE TABLE `applicants` (
  `id` int(11) NOT NULL,
  `applicant_type` enum('Freshmen','Transferee','','') NOT NULL,
  `desired_course` int(11) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `middlename` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `suffix` varchar(20) NOT NULL,
  `address` text NOT NULL,
  `email` varchar(255) NOT NULL,
  `mobile_no` varchar(15) NOT NULL,
  `gender` enum('Male','Female','','') NOT NULL,
  `nationality` varchar(255) NOT NULL,
  `dob` date NOT NULL,
  `transferee_yr_level` enum('1st','2nd','3rd','4th') NOT NULL,
  `transferee_prv_school` varchar(255) NOT NULL,
  `transferee_prv_course` varchar(255) NOT NULL,
  `shs_school` varchar(255) NOT NULL,
  `year_graduated` year(4) NOT NULL,
  `strand` varchar(255) NOT NULL,
  `sy` int(11) NOT NULL,
  `semester` enum('1st','2nd','','') NOT NULL,
  `status` enum('Pending','Processing','To Enroll','') NOT NULL DEFAULT 'Pending',
  `register_at` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `applicants`
--

INSERT INTO `applicants` (`id`, `applicant_type`, `desired_course`, `firstname`, `middlename`, `lastname`, `suffix`, `address`, `email`, `mobile_no`, `gender`, `nationality`, `dob`, `transferee_yr_level`, `transferee_prv_school`, `transferee_prv_course`, `shs_school`, `year_graduated`, `strand`, `sy`, `semester`, `status`, `register_at`) VALUES
(1, 'Freshmen', 2, 'Hans Andrei', 'Ang', 'Diaz', '', 'Blk 1 Lot 1 Wano Kuni Ph 3 Trece Martires Cavite', 'hansNigga@gmail.com', '09123456789', 'Male', 'Filipino', '2005-06-20', '', '', '', '4th Watch Maranatha Christian Academy of Makati', '2023', 'GAS', 1, '1st', 'Pending', '2025-08-06'),
(2, 'Freshmen', 2, 'Bernard', 'Nathaniel Pate', 'Hansen', 'Jr', 'Eveniet adipisicing', 'wicike@mailinator.com', '09123456789', 'Male', 'Filipino', '2005-07-20', '', '', '', '4th Watch Maranatha Christian Academy of Makati', '2023', 'GAS', 1, '1st', 'Pending', '2025-08-06');

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE `courses` (
  `id` int(11) NOT NULL,
  `department_id` int(11) NOT NULL,
  `course_code` varchar(50) NOT NULL,
  `course_name` varchar(255) NOT NULL,
  `course_description` text NOT NULL,
  `status` enum('Active','Archived','Inactive','') NOT NULL DEFAULT 'Active',
  `created_at` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`id`, `department_id`, `course_code`, `course_name`, `course_description`, `status`, `created_at`) VALUES
(2, 2, 'BSIT', 'Bs Information Technology', 'w', 'Active', '2025-08-06'),
(3, 2, 'BSCS', 'Bs In Computer Science', 'w', 'Active', '2025-08-06');

-- --------------------------------------------------------

--
-- Table structure for table `departments`
--

CREATE TABLE `departments` (
  `id` int(11) NOT NULL,
  `department_name` varchar(255) NOT NULL,
  `department_code` varchar(20) NOT NULL,
  `department_description` text NOT NULL,
  `status` enum('Active','Archived','') NOT NULL DEFAULT 'Active',
  `added_at` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `departments`
--

INSERT INTO `departments` (`id`, `department_name`, `department_code`, `department_description`, `status`, `added_at`) VALUES
(2, 'Computer Studies Department', 'CSD', 'w', 'Active', '2025-08-06');

-- --------------------------------------------------------

--
-- Table structure for table `school_year`
--

CREATE TABLE `school_year` (
  `id` int(11) NOT NULL,
  `SY` varchar(25) NOT NULL,
  `status` enum('Active','Inactive','','') NOT NULL DEFAULT 'Inactive'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `school_year`
--

INSERT INTO `school_year` (`id`, `SY`, `status`) VALUES
(1, '2025-2026', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `semesters`
--

CREATE TABLE `semesters` (
  `id` int(11) NOT NULL,
  `SY` int(11) NOT NULL,
  `semester` enum('1st','2nd','','') NOT NULL,
  `status` enum('Active','Inactive','','') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `semesters`
--

INSERT INTO `semesters` (`id`, `SY`, `semester`, `status`) VALUES
(1, 1, '1st', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `subjects`
--

CREATE TABLE `subjects` (
  `id` int(11) NOT NULL,
  `course_id` int(11) NOT NULL,
  `subject_code` varchar(50) NOT NULL,
  `subject_name` varchar(255) NOT NULL,
  `pre_requisite` varchar(255) NOT NULL,
  `lab_units` decimal(10,2) NOT NULL,
  `lec_units` decimal(10,2) NOT NULL,
  `total_units` decimal(10,2) NOT NULL,
  `type` set('Lab','Lec','','') NOT NULL,
  `year_lvl` enum('1','2','3','4') NOT NULL,
  `semester` enum('1','2','','') NOT NULL,
  `status` enum('Active','Inactive','','') NOT NULL DEFAULT 'Active',
  `added_at` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `subjects`
--

INSERT INTO `subjects` (`id`, `course_id`, `subject_code`, `subject_name`, `pre_requisite`, `lab_units`, `lec_units`, `total_units`, `type`, `year_lvl`, `semester`, `status`, `added_at`) VALUES
(1, 2, 'IT 101', 'Computer Programming 1', '', 3.00, 1.00, 4.00, 'Lab,Lec', '1', '1', 'Active', '2025-08-06'),
(2, 3, 'CS 101', 'Introduction To Programming', '', 2.00, 1.00, 3.00, 'Lab,Lec', '1', '1', 'Active', '2025-08-06'),
(3, 2, 'IT 201', 'Computer Programming 2', 'IT 101', 3.00, 1.00, 4.00, 'Lab,Lec', '2', '1', 'Active', '2025-08-06'),
(4, 2, 'IT 103', 'Networking 1', '', 3.00, 1.00, 4.00, 'Lab,Lec', '1', '2', 'Active', '2025-08-06'),
(5, 2, 'IT 204', 'Networking 2', 'IT 103', 3.00, 1.00, 4.00, 'Lab,Lec', '2', '2', 'Active', '2025-08-06');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('Admin','Staff','Student','Applicant') NOT NULL DEFAULT 'Applicant',
  `status` enum('Active','Inactive','','') NOT NULL DEFAULT 'Active',
  `profile_img` text NOT NULL DEFAULT 'default.png',
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `role`, `status`, `profile_img`, `created_at`) VALUES
(3, 'wew', '$2y$10$ePEf1wqTd6s35hZaR09p/uMyKu80wXaaPOSqH0NJ4PAvD1oQ3VIf6', 'Applicant', 'Active', 'default.png', '2025-07-18 15:32:43'),
(4, 'admin', '$2y$10$TYywsHUHUJCyZvK/pc1fFOajA8yB5QIfQ0GL/bp3jGKb00eMPmNRm', 'Admin', 'Active', 'default.png', '2025-07-21 11:36:52');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `applicants`
--
ALTER TABLE `applicants`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_applicant_sy_id` (`sy`);

--
-- Indexes for table `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `courses_ibfk_1` (`department_id`);

--
-- Indexes for table `departments`
--
ALTER TABLE `departments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `school_year`
--
ALTER TABLE `school_year`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `semesters`
--
ALTER TABLE `semesters`
  ADD PRIMARY KEY (`id`),
  ADD KEY `SY` (`SY`);

--
-- Indexes for table `subjects`
--
ALTER TABLE `subjects`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_subject_course_id` (`course_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `applicants`
--
ALTER TABLE `applicants`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `courses`
--
ALTER TABLE `courses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `departments`
--
ALTER TABLE `departments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `school_year`
--
ALTER TABLE `school_year`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `semesters`
--
ALTER TABLE `semesters`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `subjects`
--
ALTER TABLE `subjects`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `applicants`
--
ALTER TABLE `applicants`
  ADD CONSTRAINT `fk_applicant_sy_id` FOREIGN KEY (`sy`) REFERENCES `school_year` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `courses`
--
ALTER TABLE `courses`
  ADD CONSTRAINT `courses_ibfk_1` FOREIGN KEY (`department_id`) REFERENCES `departments` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `semesters`
--
ALTER TABLE `semesters`
  ADD CONSTRAINT `semesters_ibfk_1` FOREIGN KEY (`SY`) REFERENCES `school_year` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `subjects`
--
ALTER TABLE `subjects`
  ADD CONSTRAINT `fk_subject_course_id` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
