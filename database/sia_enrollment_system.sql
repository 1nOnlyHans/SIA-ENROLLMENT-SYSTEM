-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 11, 2025 at 01:26 PM
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
  `semester` int(11) NOT NULL,
  `status` enum('Pending','Evaluated','Rejected') NOT NULL DEFAULT 'Pending',
  `register_at` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `applicants`
--

INSERT INTO `applicants` (`id`, `applicant_type`, `desired_course`, `firstname`, `middlename`, `lastname`, `suffix`, `address`, `email`, `mobile_no`, `gender`, `nationality`, `dob`, `transferee_yr_level`, `transferee_prv_school`, `transferee_prv_course`, `shs_school`, `year_graduated`, `strand`, `sy`, `semester`, `status`, `register_at`) VALUES
(1, 'Transferee', 2, 'Hans Andrei', 'Ang', 'Diaz', '', 'Blk 1 Lot 1 Wano Kuni Ph 3 Trece Martires Cavite', 'hansNigga@gmail.com', '09123456789', 'Male', 'Filipino', '2005-06-20', '2nd', 'Sti College Dasma', 'BSBA', 'Gateway Integrated School of Science &amp; Technology, Inc.', '2023', 'GAS', 1, 1, 'Evaluated', '2025-08-11'),
(2, 'Freshmen', 2, 'Killua', '', 'Zoldyck', '', 'BLK 1 LOT 1 TITE HOMES', 'killua@gmail.com', '09123456789', 'Male', 'Filipino', '2006-06-05', '', '', '', 'National College of Science and Technology', '2024', 'HUMSS', 1, 1, 'Evaluated', '2025-08-11'),
(3, 'Transferee', 2, 'Gon', '', 'Freecs', '', 'BLK 1 LOT 1', 'gon@gmail.com', '09123456789', 'Male', 'Filipino', '2003-06-07', '2nd', 'Sti Dasmarinas', 'BSBA', 'Access Computer and Technical College-Camarin Campus', '2018', 'TVL', 1, 1, 'Evaluated', '2025-08-11');

-- --------------------------------------------------------

--
-- Table structure for table `applicant_credited_subjects`
--

CREATE TABLE `applicant_credited_subjects` (
  `id` int(11) NOT NULL,
  `applicant_id` int(11) NOT NULL,
  `subject_id` int(11) NOT NULL,
  `evaluation_id` int(11) NOT NULL,
  `credit_status` enum('Credited','Not Credited') NOT NULL DEFAULT 'Credited',
  `credited_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `applicant_credited_subjects`
--

INSERT INTO `applicant_credited_subjects` (`id`, `applicant_id`, `subject_id`, `evaluation_id`, `credit_status`, `credited_at`) VALUES
(1, 1, 2, 1, 'Credited', '2025-08-11 16:54:15'),
(2, 1, 3, 1, 'Credited', '2025-08-11 16:56:06');

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
(2, 2, 'BSIT', 'Bs In Information Technology', 'test', 'Active', '2025-08-11');

-- --------------------------------------------------------

--
-- Table structure for table `curriculum`
--

CREATE TABLE `curriculum` (
  `id` int(11) NOT NULL,
  `course_id` int(11) NOT NULL,
  `curriculum_name` varchar(255) NOT NULL,
  `sy` int(11) NOT NULL,
  `created_at` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `curriculum`
--

INSERT INTO `curriculum` (`id`, `course_id`, `curriculum_name`, `sy`, `created_at`) VALUES
(1, 2, 'BSIT 2025', 1, '2025-08-11'),
(2, 2, 'BSIT', 1, '2025-08-11');

-- --------------------------------------------------------

--
-- Table structure for table `curriculum_subjects`
--

CREATE TABLE `curriculum_subjects` (
  `id` int(11) NOT NULL,
  `curriculum_id` int(11) NOT NULL,
  `subject_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `curriculum_subjects`
--

INSERT INTO `curriculum_subjects` (`id`, `curriculum_id`, `subject_id`) VALUES
(1, 1, 1),
(2, 1, 2),
(3, 1, 3),
(4, 1, 4),
(5, 1, 5),
(6, 1, 6),
(7, 1, 7),
(8, 1, 8),
(9, 1, 9),
(10, 1, 10),
(11, 1, 11),
(12, 1, 12),
(13, 1, 13),
(14, 1, 14),
(15, 2, 1),
(16, 2, 2),
(17, 2, 3),
(18, 2, 4),
(19, 2, 5),
(20, 2, 6),
(21, 2, 7),
(22, 2, 8),
(23, 2, 9),
(24, 2, 10),
(25, 2, 11),
(26, 2, 12),
(27, 2, 13),
(28, 2, 14);

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
(2, 'Computer Studies Department', 'CSD', 'test', 'Active', '2025-08-11');

-- --------------------------------------------------------

--
-- Table structure for table `documents_type`
--

CREATE TABLE `documents_type` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `required_for` enum('Freshmen','Transferee','All','') NOT NULL DEFAULT 'All'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `documents_type`
--

INSERT INTO `documents_type` (`id`, `name`, `required_for`) VALUES
(1, '2x2 Picture', 'All'),
(2, '1x1 Picture', 'All'),
(3, 'Form 137/Report Card', 'All'),
(4, 'Good Moral', 'All'),
(5, 'TOR', 'Transferee');

-- --------------------------------------------------------

--
-- Table structure for table `evaluations`
--

CREATE TABLE `evaluations` (
  `id` int(11) NOT NULL,
  `applicant_id` int(11) NOT NULL,
  `evaluator_id` int(11) NOT NULL,
  `status` enum('Pass','Fail') NOT NULL,
  `remarks` text NOT NULL,
  `remarks_note` text NOT NULL,
  `evaluated_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `evaluations`
--

INSERT INTO `evaluations` (`id`, `applicant_id`, `evaluator_id`, `status`, `remarks`, `remarks_note`, `evaluated_at`) VALUES
(1, 1, 5, 'Pass', 'Complete Documents and Approved for Enrollment', '', '2025-08-11 13:32:04'),
(2, 2, 5, 'Pass', 'Complete Documents and Approved for Enrollment', '', '2025-08-11 16:24:12'),
(3, 3, 5, 'Pass', 'Complete Documents and Approved for Enrollment', '', '2025-08-11 16:24:20');

-- --------------------------------------------------------

--
-- Table structure for table `evaluation_documents`
--

CREATE TABLE `evaluation_documents` (
  `id` int(11) NOT NULL,
  `evaluation_id` int(11) NOT NULL,
  `document_type_id` int(11) NOT NULL,
  `status` enum('Present','Missing','Invalid','') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `evaluation_documents`
--

INSERT INTO `evaluation_documents` (`id`, `evaluation_id`, `document_type_id`, `status`) VALUES
(1, 1, 1, 'Present'),
(2, 1, 2, 'Present'),
(3, 1, 3, 'Present'),
(4, 1, 4, 'Present'),
(5, 2, 1, 'Present'),
(6, 2, 2, 'Present'),
(7, 2, 3, 'Present'),
(8, 2, 4, 'Present'),
(9, 2, 5, 'Present'),
(10, 1, 1, 'Present'),
(11, 1, 2, 'Present'),
(12, 1, 3, 'Present'),
(13, 1, 4, 'Present'),
(14, 1, 5, 'Present'),
(15, 2, 1, 'Present'),
(16, 2, 2, 'Present'),
(17, 2, 3, 'Present'),
(18, 2, 4, 'Present'),
(19, 3, 1, 'Present'),
(20, 3, 2, 'Present'),
(21, 3, 3, 'Present'),
(22, 3, 4, 'Present'),
(23, 3, 5, 'Present');

-- --------------------------------------------------------

--
-- Table structure for table `schedules`
--

CREATE TABLE `schedules` (
  `id` int(11) NOT NULL,
  `section_id` int(11) NOT NULL,
  `subject_id` int(11) NOT NULL,
  `type` enum('Lab','Lec','','') NOT NULL,
  `instructor` varchar(255) NOT NULL,
  `days` set('M','T','W','TH','F','S','SU') NOT NULL,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL,
  `room` varchar(255) NOT NULL,
  `current_enrolled` int(11) NOT NULL DEFAULT 0,
  `maximum_slot` int(11) NOT NULL DEFAULT 40
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `schedules`
--

INSERT INTO `schedules` (`id`, `section_id`, `subject_id`, `type`, `instructor`, `days`, `start_time`, `end_time`, `room`, `current_enrolled`, `maximum_slot`) VALUES
(1, 1, 2, 'Lec', 'Instructor', 'M,W,F', '13:08:00', '13:15:00', '1309', 0, 40),
(2, 1, 3, 'Lec', 'Instructor', 'T', '18:08:00', '18:10:00', '1309', 0, 40),
(3, 1, 4, 'Lec', 'Instructor', 'W', '19:08:00', '19:15:00', '1309', 0, 40),
(4, 1, 1, 'Lab', 'Instructor', 'TH', '19:08:00', '19:15:00', '1309', 0, 40),
(5, 1, 1, 'Lec', 'Instructor', 'TH', '19:08:00', '19:14:00', '1309', 0, 40),
(6, 1, 5, 'Lab', 'Instructor', 'S', '18:10:00', '18:12:00', '1309', 0, 40),
(7, 1, 5, 'Lec', 'Instructor', 'S', '18:14:00', '18:17:00', '1309', 0, 40),
(8, 1, 6, 'Lec', 'Instructor', 'S', '18:18:00', '18:19:00', '1309', 0, 40),
(9, 1, 7, 'Lec', 'Instructor', 'SU', '18:20:00', '18:26:00', '1309', 0, 40),
(10, 1, 8, 'Lec', 'Instructor', 'SU', '18:27:00', '18:33:00', '1309', 0, 40),
(11, 2, 2, 'Lec', 'Instructor', 'M', '18:11:00', '18:12:00', '1309', 0, 40),
(12, 2, 3, 'Lec', 'Instructor', 'T', '18:11:00', '18:12:00', '1309', 0, 40),
(13, 2, 4, 'Lec', 'Instructor', 'W', '18:11:00', '18:12:00', '1309', 0, 40),
(14, 2, 1, 'Lab', 'Instructor', 'W', '18:11:00', '18:12:00', '1309', 0, 40),
(15, 2, 1, 'Lec', 'Instructor', 'TH', '18:11:00', '18:12:00', '1309', 0, 40),
(16, 2, 5, 'Lab', 'Instructor', 'TH', '18:11:00', '18:12:00', '1309', 0, 40),
(17, 2, 5, 'Lec', 'Instructor', 'F', '18:11:00', '18:12:00', '1309', 0, 40),
(18, 2, 6, 'Lec', 'Instructor', 'S', '18:11:00', '18:12:00', '1309', 0, 40),
(19, 2, 7, 'Lec', 'Instructor', 'TH', '18:11:00', '18:12:00', '1309', 0, 40),
(20, 2, 8, 'Lec', 'Instructor', 'SU', '18:11:00', '18:12:00', '1309', 0, 40);

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
-- Table structure for table `sections`
--

CREATE TABLE `sections` (
  `id` int(11) NOT NULL,
  `course_id` int(11) NOT NULL,
  `year_level` varchar(30) NOT NULL,
  `semester` enum('1','2','','') NOT NULL DEFAULT '1',
  `section` varchar(255) NOT NULL,
  `type` enum('Morning','Afternoon','Evening','') NOT NULL,
  `current_slot` int(11) NOT NULL DEFAULT 0,
  `maximum_slot` int(11) NOT NULL DEFAULT 40,
  `status` enum('Open','Full','','') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sections`
--

INSERT INTO `sections` (`id`, `course_id`, `year_level`, `semester`, `section`, `type`, `current_slot`, `maximum_slot`, `status`) VALUES
(1, 2, '1', '1', 'BSIT 11M1', 'Morning', 0, 40, 'Open'),
(2, 2, '1', '1', 'BSIT 11A1', 'Afternoon', 0, 40, 'Open');

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
  `subject_code` varchar(50) NOT NULL,
  `subject_name` varchar(255) NOT NULL,
  `pre_requisite` text NOT NULL,
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

INSERT INTO `subjects` (`id`, `subject_code`, `subject_name`, `pre_requisite`, `lab_units`, `lec_units`, `total_units`, `type`, `year_lvl`, `semester`, `status`, `added_at`) VALUES
(1, 'IT 101', 'Computer Programming 1', '', 2.00, 1.00, 3.00, 'Lab,Lec', '1', '1', 'Active', '2025-08-11'),
(2, 'GE 003C', 'Mathematics In The Modern World', '', 0.00, 3.00, 3.00, 'Lec', '1', '1', 'Active', '2025-08-11'),
(3, 'GE 007', 'Contemporary World', '', 0.00, 3.00, 3.00, 'Lec', '1', '1', 'Active', '2025-08-11'),
(4, 'GELEC 004-IT', 'Living In The It Era', '', 0.00, 3.00, 3.00, 'Lec', '1', '1', 'Active', '2025-08-11'),
(5, 'IT 102', 'Introduction To Computing', '', 2.00, 1.00, 3.00, 'Lab,Lec', '1', '1', 'Active', '2025-08-11'),
(6, 'NCST 001', 'Nation Builders Ncst Culture 1', '', 0.00, 3.00, 3.00, 'Lec', '1', '1', 'Active', '2025-08-11'),
(7, 'NSTP 001', 'National Service Training Program', '', 0.00, 3.00, 3.00, 'Lec', '1', '1', 'Active', '2025-08-11'),
(8, 'PATHFIT 1', 'Physical Activities Towards Health  Fitness', '', 0.00, 3.00, 3.00, 'Lec', '1', '1', 'Active', '2025-08-11'),
(9, 'GE 004', 'Understanding The Self', '', 0.00, 3.00, 3.00, 'Lec', '1', '2', 'Active', '2025-08-11'),
(10, 'GE 008', 'Art Appreciation', '', 0.00, 3.00, 3.00, 'Lec', '1', '2', 'Active', '2025-08-11'),
(11, 'GELEC 012-IT', 'Reading Visual Art', '', 0.00, 3.00, 3.00, 'Lec', '1', '2', 'Active', '2025-08-11'),
(12, 'IT 103', 'Computer Programming 2', 'IT 101', 2.00, 1.00, 3.00, 'Lab,Lec', '1', '2', 'Active', '2025-08-11'),
(13, 'IT 104', 'Web System Technologies 1', 'IT 101,IT 102', 2.00, 1.00, 3.00, 'Lab,Lec', '1', '2', 'Active', '2025-08-11'),
(14, 'IT 105', 'Discrete Structures', '', 0.00, 3.00, 3.00, 'Lec', '1', '2', 'Active', '2025-08-11');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('Admin','Registrar','Student','Applicant','Cashier','Staff') NOT NULL DEFAULT 'Applicant',
  `status` enum('Active','Inactive','','') NOT NULL DEFAULT 'Active',
  `profile_img` text NOT NULL DEFAULT 'default.png',
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `role`, `status`, `profile_img`, `created_at`) VALUES
(3, 'wew', '$2y$10$ePEf1wqTd6s35hZaR09p/uMyKu80wXaaPOSqH0NJ4PAvD1oQ3VIf6', 'Applicant', 'Active', 'default.png', '2025-07-18 15:32:43'),
(4, 'admin', '$2y$10$TYywsHUHUJCyZvK/pc1fFOajA8yB5QIfQ0GL/bp3jGKb00eMPmNRm', 'Admin', 'Active', 'default.png', '2025-07-21 11:36:52'),
(5, 'registrar', '$2y$10$ax6BKodaNJTq3oERoWBKPeRLs59G.pigCglmVBhvSh5YHg3gFLUYy', 'Registrar', 'Active', 'default.png', '2025-08-08 17:00:33'),
(6, 'staff', '$2y$10$nyb3cgQUgEK6XPBhrIUp1url//da/WH9NQLMk6.9TNV4NKe28InZm', 'Staff', 'Active', 'default.png', '2025-08-10 13:31:45');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `applicants`
--
ALTER TABLE `applicants`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_applicant_sy_id` (`sy`),
  ADD KEY `fk_applicant_sem_id` (`semester`);

--
-- Indexes for table `applicant_credited_subjects`
--
ALTER TABLE `applicant_credited_subjects`
  ADD PRIMARY KEY (`id`),
  ADD KEY `applicant_id` (`applicant_id`),
  ADD KEY `subject_id` (`subject_id`),
  ADD KEY `evaluation_id` (`evaluation_id`);

--
-- Indexes for table `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `courses_ibfk_1` (`department_id`);

--
-- Indexes for table `curriculum`
--
ALTER TABLE `curriculum`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_curr_course_id` (`course_id`),
  ADD KEY `fk_curr_sy_id` (`sy`);

--
-- Indexes for table `curriculum_subjects`
--
ALTER TABLE `curriculum_subjects`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_curriculumID` (`curriculum_id`),
  ADD KEY `fk_currSubjectID` (`subject_id`);

--
-- Indexes for table `departments`
--
ALTER TABLE `departments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `documents_type`
--
ALTER TABLE `documents_type`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `evaluations`
--
ALTER TABLE `evaluations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_eval_applicant_id` (`applicant_id`),
  ADD KEY `fk_evaluator` (`evaluator_id`);

--
-- Indexes for table `evaluation_documents`
--
ALTER TABLE `evaluation_documents`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_eval_id` (`evaluation_id`),
  ADD KEY `fk_docs_id` (`document_type_id`);

--
-- Indexes for table `schedules`
--
ALTER TABLE `schedules`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `school_year`
--
ALTER TABLE `school_year`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sections`
--
ALTER TABLE `sections`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_section_course_id` (`course_id`);

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
  ADD PRIMARY KEY (`id`);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `applicant_credited_subjects`
--
ALTER TABLE `applicant_credited_subjects`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `courses`
--
ALTER TABLE `courses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `curriculum`
--
ALTER TABLE `curriculum`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `curriculum_subjects`
--
ALTER TABLE `curriculum_subjects`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `departments`
--
ALTER TABLE `departments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `documents_type`
--
ALTER TABLE `documents_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `evaluations`
--
ALTER TABLE `evaluations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `evaluation_documents`
--
ALTER TABLE `evaluation_documents`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `schedules`
--
ALTER TABLE `schedules`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `school_year`
--
ALTER TABLE `school_year`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `sections`
--
ALTER TABLE `sections`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `semesters`
--
ALTER TABLE `semesters`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `subjects`
--
ALTER TABLE `subjects`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `applicants`
--
ALTER TABLE `applicants`
  ADD CONSTRAINT `fk_applicant_sem_id` FOREIGN KEY (`semester`) REFERENCES `semesters` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_applicant_sy_id` FOREIGN KEY (`sy`) REFERENCES `school_year` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `applicant_credited_subjects`
--
ALTER TABLE `applicant_credited_subjects`
  ADD CONSTRAINT `applicant_credited_subjects_ibfk_1` FOREIGN KEY (`applicant_id`) REFERENCES `applicants` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `applicant_credited_subjects_ibfk_2` FOREIGN KEY (`subject_id`) REFERENCES `subjects` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `applicant_credited_subjects_ibfk_3` FOREIGN KEY (`evaluation_id`) REFERENCES `evaluations` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `courses`
--
ALTER TABLE `courses`
  ADD CONSTRAINT `courses_ibfk_1` FOREIGN KEY (`department_id`) REFERENCES `departments` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `curriculum`
--
ALTER TABLE `curriculum`
  ADD CONSTRAINT `fk_curr_course_id` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_curr_sy_id` FOREIGN KEY (`sy`) REFERENCES `school_year` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `curriculum_subjects`
--
ALTER TABLE `curriculum_subjects`
  ADD CONSTRAINT `fk_currSubjectID` FOREIGN KEY (`subject_id`) REFERENCES `subjects` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_curriculumID` FOREIGN KEY (`curriculum_id`) REFERENCES `curriculum` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `evaluations`
--
ALTER TABLE `evaluations`
  ADD CONSTRAINT `fk_eval_applicant_id` FOREIGN KEY (`applicant_id`) REFERENCES `applicants` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_evaluator` FOREIGN KEY (`evaluator_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `evaluation_documents`
--
ALTER TABLE `evaluation_documents`
  ADD CONSTRAINT `fk_docs_id` FOREIGN KEY (`document_type_id`) REFERENCES `documents_type` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_eval_id` FOREIGN KEY (`evaluation_id`) REFERENCES `evaluations` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `sections`
--
ALTER TABLE `sections`
  ADD CONSTRAINT `fk_section_course_id` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `semesters`
--
ALTER TABLE `semesters`
  ADD CONSTRAINT `semesters_ibfk_1` FOREIGN KEY (`SY`) REFERENCES `school_year` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
