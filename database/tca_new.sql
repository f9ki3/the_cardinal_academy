-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Sep 03, 2025 at 06:48 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tca1`
--

-- --------------------------------------------------------

--
-- Table structure for table `admission_form`
--

CREATE TABLE `admission_form` (
  `id` int(11) NOT NULL,
  `lrn` varchar(20) NOT NULL,
  `firstname` varchar(50) NOT NULL,
  `middlename` varchar(50) DEFAULT NULL,
  `lastname` varchar(50) NOT NULL,
  `status` varchar(255) NOT NULL,
  `gender` enum('male','female') NOT NULL,
  `grade_level` varchar(20) NOT NULL,
  `profile_picture` varchar(255) DEFAULT NULL,
  `birthday` date NOT NULL,
  `religion` varchar(50) DEFAULT NULL,
  `place_of_birth` varchar(100) DEFAULT NULL,
  `age` int(11) DEFAULT NULL,
  `residential_address` varchar(255) DEFAULT NULL,
  `region` varchar(100) DEFAULT NULL,
  `province` varchar(100) DEFAULT NULL,
  `municipal` varchar(100) DEFAULT NULL,
  `barangay` varchar(100) DEFAULT NULL,
  `father_name` varchar(100) DEFAULT NULL,
  `father_occupation` varchar(100) DEFAULT NULL,
  `father_contact` varchar(20) DEFAULT NULL,
  `mother_name` varchar(100) DEFAULT NULL,
  `mother_occupation` varchar(100) DEFAULT NULL,
  `mother_contact` varchar(20) DEFAULT NULL,
  `guardian_name` varchar(100) DEFAULT NULL,
  `guardian_occupation` varchar(100) DEFAULT NULL,
  `guardian_contact` varchar(20) DEFAULT NULL,
  `admission_status` varchar(255) DEFAULT 'for_verification',
  `que_code` varchar(50) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `facebook` varchar(255) DEFAULT NULL,
  `admission_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `strand` varchar(100) DEFAULT NULL,
  `birth_cert` tinyint(1) DEFAULT 0,
  `report_card` tinyint(1) DEFAULT 0,
  `good_moral` tinyint(1) DEFAULT 0,
  `id_pic` tinyint(1) DEFAULT 0,
  `esc_cert` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admission_form`
--

INSERT INTO `admission_form` (`id`, `lrn`, `firstname`, `middlename`, `lastname`, `status`, `gender`, `grade_level`, `profile_picture`, `birthday`, `religion`, `place_of_birth`, `age`, `residential_address`, `region`, `province`, `municipal`, `barangay`, `father_name`, `father_occupation`, `father_contact`, `mother_name`, `mother_occupation`, `mother_contact`, `guardian_name`, `guardian_occupation`, `guardian_contact`, `admission_status`, `que_code`, `phone`, `email`, `facebook`, `admission_date`, `strand`, `birth_cert`, `report_card`, `good_moral`, `id_pic`, `esc_cert`) VALUES
(88, '20250002', 'Ana', 'Lopez', 'Reyes', 'active', 'female', 'Kinder', NULL, '2018-07-22', 'Christian', 'Cebu City', 6, '456 Example St.', 'Region VII', 'Cebu', 'Cebu City', 'Mabolo', 'Mario Reyes', 'Fisherman', '09221234561', 'Celia Reyes', 'Teacher', '09221234562', NULL, NULL, NULL, 'pending', NULL, '09221234560', 'ana.reyes@example.com', 'fb.com/ana.reyes', '2025-08-22 20:16:32', NULL, 1, 1, 1, 1, 0),
(89, '20250003', 'Mark', 'Villanueva', 'Santos', 'active', 'male', 'Grade 1', NULL, '2017-03-15', 'Catholic', 'Davao', 7, '789 Test Rd.', 'Region XI', 'Davao del Sur', 'Davao City', 'Buhangin', 'Jose Santos', 'Farmer', '09333456781', 'Lorna Santos', 'Nurse', '09333456782', NULL, NULL, NULL, 'pending', NULL, '09333456780', 'mark.santos@example.com', 'fb.com/mark.santos', '2025-08-22 20:16:34', NULL, 1, 0, 1, 1, 1),
(90, '20250004', 'Ella', 'Garcia', 'Mendoza', 'active', 'female', 'Grade 2', NULL, '2016-01-05', 'Catholic', 'Bacolod', 8, '321 Test Ave.', 'Region VI', 'Negros Occidental', 'Bacolod City', 'Tangub', 'Ramon Mendoza', 'Engineer', '09444567891', 'Luisa Mendoza', 'Housewife', '09444567892', NULL, NULL, NULL, 'approved', NULL, '09444567890', 'ella.mendoza@example.com', 'fb.com/ella.mendoza', '2025-09-01 16:30:31', NULL, 1, 1, 1, 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `announcement`
--

CREATE TABLE `announcement` (
  `id` int(11) NOT NULL,
  `heading` text DEFAULT NULL,
  `paragraph` text DEFAULT NULL,
  `visible` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `announcement`
--

INSERT INTO `announcement` (`id`, `heading`, `paragraph`, `visible`) VALUES
(1, 'Welcome to school year 2025-2026!', 'Start of classes on June 26, 2025. Enjoy your first day Cardinalians! ', 1);

-- --------------------------------------------------------

--
-- Table structure for table `attendance`
--

CREATE TABLE `attendance` (
  `id` int(11) NOT NULL,
  `date` date NOT NULL,
  `time_in` time DEFAULT NULL,
  `time_out` time DEFAULT NULL,
  `teacher_id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `attendance`
--

INSERT INTO `attendance` (`id`, `date`, `time_in`, `time_out`, `teacher_id`, `student_id`) VALUES
(25, '2025-07-07', '20:51:43', '20:52:08', 40, 12),
(26, '2025-07-07', '20:51:54', '20:52:01', 40, 13),
(27, '2025-07-08', '21:08:08', '21:08:33', 40, 12),
(28, '2025-07-08', '21:08:28', '21:08:37', 40, 13),
(29, '2025-07-09', '21:09:53', '21:10:01', 40, 12),
(30, '2025-07-09', '21:09:55', '21:10:04', 40, 13),
(31, '2025-07-10', '21:12:51', '21:13:03', 40, 12),
(32, '2025-07-10', '21:12:56', '21:13:12', 40, 13),
(33, '2025-07-11', '21:18:28', '21:18:34', 40, 12),
(34, '2025-07-11', '21:18:30', '21:18:37', 40, 13),
(35, '2025-07-01', '21:19:27', '21:19:33', 40, 12),
(36, '2025-07-01', '21:19:29', '21:19:35', 40, 13),
(37, '2025-07-15', '00:58:00', '00:58:09', 40, 12),
(38, '2025-07-15', '00:58:05', '00:58:12', 40, 13),
(39, '2025-07-16', '07:22:14', '07:22:22', 40, 58),
(40, '2025-07-16', '07:40:35', '07:40:39', 40, 57),
(41, '2025-07-16', '08:06:33', '08:06:43', 40, 56),
(42, '2025-07-16', '10:15:07', '10:15:49', 40, 59);

-- --------------------------------------------------------

--
-- Table structure for table `class_schedule`
--

CREATE TABLE `class_schedule` (
  `id` int(11) NOT NULL,
  `section_id` int(11) NOT NULL,
  `subject_code` varchar(20) NOT NULL,
  `description` varchar(255) NOT NULL,
  `time` varchar(100) NOT NULL,
  `teacher` varchar(100) NOT NULL,
  `room` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `class_schedule`
--

INSERT INTO `class_schedule` (`id`, `section_id`, `subject_code`, `description`, `time`, `teacher`, `room`) VALUES
(3, 5, 'Core 9', '21st Century Literature from the Philippines and the World', '7:00 AM - 8:30 AM', 'Stephany Gandula', '301'),
(4, 5, 'Spec 4', 'Displine and Ideas in the Social Science', '8:30 AM - 9:30 AM ', 'Mika Salamanca', '304'),
(5, 5, 'Core 4', 'Earth and Life Science', '9:30 AM - 10:30 AM', 'Mac Gilbert Jabat', '304'),
(6, 5, 'Applied 1', 'Research in Daily Life 1', '10:30 AM - 12:00 PM', 'Sarah Labati', '301'),
(7, 10, 'Core 9', '21st Century Literature from the Philippines and the World', '8:00 AM - 9:00 AM', 'Stephany Gandula', '304'),
(8, 10, 'Core 4', 'Earth and Life Science', '9:00 AM - 10:00 PM', 'Mac Gilbert Jabat', '304'),
(9, 10, 'Applied 3', 'English for Academic and Professional Purposes', '10:00 AM - 11:00 AM', 'Stephany Gandula', '304'),
(10, 10, 'Core 3', 'General Mathematics', '11:00 AM -12:00PM', 'Juan Dela Cruz', '301'),
(11, 11, 'Spec 4', 'Displine and Ideas in the Social Science', '08:00 AM - 09:00 AM', 'Juan Dela Cruz', '304'),
(12, 11, 'Core 9', '21st Century Literature from the Philippines and the World', '9:00 AM - 10:00 PM', 'Sarah Labati', '301'),
(13, 13, 'Core 9', '21st Century Literature from the Philippines and the World', '08:00 AM - 09:00 AM', 'Stephany Gandula', '303'),
(14, 13, 'Core 7', 'Contemporary Philippine Arts from the Filipino Region', '09:00 AM - 10:00AM', 'Juan Dela Cruz', '303'),
(15, 13, 'Spec 2', 'Introduction to World Religion and Belief System', '10:00 AM - 11:00 AM', 'Stephany Gandula', '303'),
(16, 13, 'Spec 5', 'Philippine Politics and Governance', '11:00 AM -12:00PM', 'Mac Gilbert Jabat', '303'),
(17, 14, 'AR', 'Araling Panlipunan', '7:00 AM - 8:00 AM', 'Stephany Gandula', '111'),
(18, 14, 'Core 4', 'Earth and Life Science', '7:00 AM - 8:00 AM', 'Stephany Gandula', '111'),
(19, 14, 'GMRC', 'Good Manner and Right Conduct', '7:00 AM - 8:00 AM', 'Stephany Gandula', '111'),
(20, 13, 'Core 1', 'Oral Communication', '1:00PM - 2:00PM', 'Stephany Gandula', '301'),
(22, 17, 'Fil', 'Filipino', '9:30 AM - 10:30 AM', 'Roshane Mauricio', '101'),
(23, 17, 'MK', 'Makabansa', '10:30 AM - 11:40 AM', 'Roshane Mauricio', '101'),
(24, 17, 'Math', 'Mathematics', '8:00 AM - 9:00 AM', 'Roshane Mauricio', '101'),
(25, 19, 'Fil', 'Filipino', '10:30 AM - 11:40 AM', 'Karl Cedrick Talusig', '101'),
(26, 31, 'Core 3', 'General Mathematics', '8:00 AM-9:00 AM', 'Leoncia Ala', '101'),
(28, 27, 'EPP', 'Edukasyong Pantahanan at Pangkabuhayan', '04:34 PM – 04:37 PM', 'Ann Nicole De Lara', '101'),
(29, 28, 'Applied 4', 'Empowering Technology', '08:00 AM – 09:00 AM', 'Roshane Mauricio', '101');

-- --------------------------------------------------------

--
-- Table structure for table `master_list`
--

CREATE TABLE `master_list` (
  `id` int(11) NOT NULL,
  `section_id` int(11) NOT NULL,
  `firstname` varchar(100) NOT NULL,
  `lastname` varchar(100) NOT NULL,
  `gender` enum('Male','Female') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `master_list`
--

INSERT INTO `master_list` (`id`, `section_id`, `firstname`, `lastname`, `gender`) VALUES
(11, 7, 'Chloe', 'Perez', 'Female'),
(12, 7, 'Ethan', 'De Guzman', 'Male'),
(13, 7, 'Isabella', 'Navarro', 'Female'),
(14, 7, 'Mia', 'Salazar', 'Female'),
(16, 5, 'Ava', 'Flores', 'Female'),
(17, 5, 'Daniel', 'Tan', 'Male'),
(20, 5, 'Mary', 'Espinosa', 'Female'),
(21, 5, 'Sophia', 'Santos', 'Female'),
(22, 5, 'Dave', 'Bergania', 'Male'),
(23, 10, 'Ava', 'Flores', 'Female'),
(24, 10, 'Chloe', 'Perez', 'Female'),
(25, 10, 'Daniel', 'Tan', 'Male'),
(26, 10, 'Dave', 'Bergania', 'Male'),
(27, 10, 'Ethan', 'De Guzman', 'Male'),
(28, 10, 'Isabella', 'Navarro', 'Female'),
(29, 10, 'Juan', 'Dela Cruz', 'Male'),
(30, 10, 'Mary', 'Espinosa', 'Female'),
(32, 11, 'Ava', 'Flores', 'Female'),
(33, 11, 'Chloe', 'Perez', 'Female'),
(34, 11, 'Isabella', 'Navarro', 'Female'),
(35, 11, 'Dave', 'Bergania', 'Male'),
(36, 12, 'Chloe', 'Perez', 'Female'),
(37, 12, 'Ethan', 'De Guzman', 'Male'),
(38, 12, 'Mia', 'Salazar', 'Female'),
(39, 12, 'Sophia', 'Santos', 'Female'),
(40, 12, 'Daniel', 'Tan', 'Male'),
(41, 13, 'Ava', 'Flores', 'Female'),
(42, 13, 'Chloe', 'Perez', 'Female'),
(43, 13, 'Daniel', 'Tan', 'Male'),
(45, 13, 'Isabella', 'Navarro', 'Female'),
(47, 13, 'Mary', 'Espinosa', 'Female'),
(48, 13, 'Mia', 'Salazar', 'Female'),
(51, 13, 'Sophia', 'Santos', 'Female'),
(52, 13, 'Ethan', 'De Guzman', 'Male'),
(53, 13, 'Liam', 'Cruz', 'Male'),
(54, 13, 'Matthew Sebastian', 'De Guzman', 'Male'),
(55, 14, 'Maceo Cael', 'escalora', 'Male'),
(56, 17, 'Ethan', 'De Guzman', 'Male'),
(57, 17, 'Ava', 'Flores', 'Female'),
(58, 17, 'Bianca', 'Torres', 'Female'),
(59, 17, 'Chloe', 'Perez', 'Female'),
(60, 17, 'Daniel', 'Tan', 'Male'),
(61, 17, 'Isabella', 'Navarro', 'Female'),
(62, 17, 'James', 'Villanueva', 'Male'),
(64, 17, 'Maceo Cael', 'escalora', 'Male'),
(65, 17, 'Mary', 'Espinosa', 'Female'),
(66, 17, 'Matthew Sebastian', 'De Guzman', 'Male'),
(67, 17, 'Mia', 'Salazar', 'Female'),
(68, 17, 'Nathan', 'Velasco', 'Male'),
(69, 17, 'Noah', 'Domingo', 'Male'),
(70, 17, 'Sophia', 'Santos', 'Female'),
(71, 17, 'Ulysses', 'Domingo', 'Male'),
(72, 17, 'Vanessa', 'Tuazon', 'Female'),
(73, 17, 'Yves', 'Vergara', 'Male'),
(74, 17, 'Daniella', 'Gonzaga', 'Female'),
(75, 17, 'Brianna', 'Del Mundo', 'Female'),
(78, 31, 'nik', 'Escalora', 'Male'),
(79, 31, 'Daniella', 'Gonzaga', 'Female');

-- --------------------------------------------------------

--
-- Table structure for table `notification`
--

CREATE TABLE `notification` (
  `id` int(11) NOT NULL,
  `acc_type` varchar(100) NOT NULL,
  `message` varchar(1000) NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `notification`
--

INSERT INTO `notification` (`id`, `acc_type`, `message`, `date`) VALUES
(11, 'parent', 'Parent-Teacher Conference is scheduled on July 22, 2025. Please confirm your attendance.', '2025-07-01 09:00:00'),
(12, 'parent', 'The school will host a Family Day event on August 3, 2025. Everyone is invited!', '2025-07-03 14:30:00'),
(13, 'parent', 'A new message from your child\'s adviser is available in the portal.', '2025-07-05 10:15:00'),
(14, 'parent', 'Monthly academic performance reports have been uploaded.', '2025-07-07 08:45:00'),
(15, 'parent', 'Reminder: Settlement of tuition fees is due on July 30, 2025.', '2025-07-09 16:20:00'),
(16, 'parent', 'You are invited to join the virtual orientation for new parents this Friday.', '2025-07-10 13:10:00'),
(17, 'parent', 'A medical bulletin has been released regarding campus health protocols.', '2025-07-11 11:00:00'),
(18, 'parent', 'Please check your inbox for the July school newsletter.', '2025-07-12 07:55:00'),
(19, 'parent', 'Field trip consent forms must be submitted before July 20, 2025.', '2025-07-13 15:30:00'),
(20, 'parent', 'Your child has received a commendation for outstanding behavior this week.', '2025-07-14 17:45:00'),
(0, 'student', '📢 Reminder: Midterm Exams will begin on Monday, July 22, 2025. Please check your exam schedule and bring your valid school ID. Good luck!\r\n', '2025-07-15 19:20:58'),
(0, 'student', '📢 Announcement: All classes are suspended tomorrow, July 16, 2025, due to inclement weather. Stay safe and monitor further announcements.\r\n', '2025-07-15 19:21:17'),
(0, 'student', '📢 Reminder: Starting next week, all students are required to wear their complete school uniform, including ID, on all class days. Thank you!\r\n', '2025-07-15 19:21:26'),
(0, 'student', '📚 Heads Up: All borrowed library books must be returned on or before July 25, 2025 to avoid penalties. Settle your accounts early!\r\n', '2025-07-15 19:21:32'),
(0, 'student', '🌿 Join Us: The Student Council invites all students to a Clean-Up Drive this Saturday, July 20, 2025 at 7:00 AM. Community service hours will be credited.\r\n', '2025-07-15 19:21:38'),
(0, 'teacher', '📢 Reminder: All subject teachers must submit midterm grades on or before Friday, July 19, 2025. Kindly upload your grades to the grading portal.\r\n', '2025-07-15 19:22:18'),
(0, 'teacher', '📢 Announcement: There will be a General Faculty Meeting on Wednesday, July 17, 2025 at 3:00 PM in the AV Hall. Attendance is mandatory.\r\n', '2025-07-15 19:22:26'),
(0, 'student', '👀 Heads Up: Class observations for the 1st semester will start next week. Kindly check your email for your assigned schedule and observer.\r\n', '2025-07-15 19:22:32'),
(0, 'teacher', '📝 Reminder: Please submit your updated Weekly Lesson Plans for Weeks 5-8 to the Academic Coordinator by Monday, July 15, 2025.\r\n', '2025-07-15 19:23:08');

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE `payment` (
  `id` int(11) NOT NULL,
  `amount` double NOT NULL,
  `payment` double NOT NULL,
  `change` double NOT NULL,
  `payment_type` varchar(50) NOT NULL,
  `proof` varchar(255) DEFAULT NULL,
  `student_id` int(11) NOT NULL,
  `date` datetime DEFAULT current_timestamp(),
  `invoice_number` double NOT NULL,
  `reference_number` bigint(20) DEFAULT NULL,
  `transaction_fee` decimal(10,2) DEFAULT 0.00
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sections`
--

CREATE TABLE `sections` (
  `section_id` int(11) NOT NULL,
  `section_name` varchar(100) NOT NULL,
  `grade_level` varchar(20) NOT NULL,
  `teacher_id` int(11) NOT NULL,
  `room` varchar(50) DEFAULT NULL,
  `strand` varchar(1000) DEFAULT NULL,
  `capacity` int(11) NOT NULL,
  `enrolled` int(11) NOT NULL DEFAULT 0,
  `school_year` varchar(20) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sections`
--

INSERT INTO `sections` (`section_id`, `section_name`, `grade_level`, `teacher_id`, `room`, `strand`, `capacity`, `enrolled`, `school_year`, `created_at`) VALUES
(15, 'Pelican', 'Nursery', 38, '100', 'N/A', 20, 0, '2025-2026', '2025-07-12 15:36:54'),
(16, 'Heron', 'Nursery', 38, '100', 'N/A', 20, 0, '2025-2026', '2025-07-12 15:37:14'),
(17, 'Diamond', 'Nursery', 39, '101', 'N/A', 20, 0, '2025-2026', '2025-07-12 15:38:12'),
(18, 'Emerald', 'Nursery', 39, '101', 'N/A', 20, 0, '2025-2026', '2025-07-12 15:39:06'),
(19, 'Moonstone', 'Grade 1', 39, '101', 'N/A', 20, 0, '2025-2026', '2025-07-12 15:39:32'),
(20, 'Topaz', 'Grade 2', 44, '102', 'N/A', 20, 0, '2025-2026', '2025-07-12 15:49:48'),
(21, 'Amethyst', 'Grade 2', 44, '102', 'N/A', 20, 0, '2025-2026', '2025-07-12 15:50:07'),
(22, 'Beryl', 'Grade 3', 45, '103', 'N/A', 25, 0, '2025-2026', '2025-07-12 15:51:43'),
(23, 'Pearl', 'Grade 3', 45, '103', 'N/A', 25, 0, '2025-2026', '2025-07-12 15:52:01'),
(24, 'Garnet', 'Grade 5', 41, '105', 'N/A', 20, 1, '2025-2026', '2025-07-12 15:54:58'),
(25, 'Ruby', 'Grade 8', 51, '108', 'N/A', 30, 0, '2025-2026', '2025-07-12 16:06:43'),
(26, 'Quartz', 'Grade 8', 51, '108', 'N/A', 30, 1, '2025-2026', '2025-07-12 16:07:01'),
(27, 'Alexandrite', 'Grade 9', 51, '109', 'N/A', 30, 2, '2025-2026', '2025-07-12 16:07:21'),
(28, 'Aquamarine', 'Grade 10', 51, '110', 'N/A', 30, 2, '2025-2027', '2025-07-12 16:08:11'),
(29, 'Zircon', 'Grade 10', 51, '110', 'N/A', 30, 0, '2025-2026', '2025-07-12 16:09:19'),
(30, 'ABM 11', 'Grade 11', 42, '111', 'ABM (Accountancy, Business and Management)', 30, 1, '2025-2026', '2025-07-12 16:10:06'),
(31, 'HUMSS 11', 'Grade 11', 42, '111', 'HUMMS (Humanities and Social Sciences)', 30, 0, '2025-2026', '2025-07-12 16:10:25'),
(32, 'STEM 11', 'Grade 11', 42, '111', 'STEM (Science, Technology, Engineering and Mathematics)', 30, 0, '2025-2026', '2025-07-12 16:10:52'),
(33, 'ABM 12 - Feldspar', 'Grade 12', 43, '112', 'ABM (Accountancy, Business and Management)', 30, 5, '2025-2026', '2025-07-12 16:11:17'),
(34, 'HUMSS 12', 'Grade 12', 43, '112', 'HUMMS (Humanities and Social Sciences)', 30, 1, '2025-2026', '2025-07-12 16:11:38'),
(35, 'STEM 12 - Sardonyx', 'Grade 12', 43, '112', 'STEM (Science, Technology, Engineering and Mathematics)', 30, 0, '2025-2026', '2025-07-12 16:12:11'),
(36, 'Malakas', 'Grade 4', 42, '303', 'N/A', 20, 0, '2025-2026', '2025-08-22 20:26:18'),
(37, 'Mabait', 'Grade 6', 45, '303', 'N/A', 100, 0, '2025-2026', '2025-08-22 20:29:49');

-- --------------------------------------------------------

--
-- Table structure for table `student_information`
--

CREATE TABLE `student_information` (
  `id` int(11) NOT NULL,
  `student_number` varchar(100) NOT NULL,
  `lrn` varchar(20) NOT NULL,
  `firstname` varchar(50) NOT NULL,
  `middlename` varchar(50) DEFAULT NULL,
  `lastname` varchar(50) NOT NULL,
  `status` varchar(255) NOT NULL,
  `gender` enum('male','female') NOT NULL,
  `grade_level` varchar(20) NOT NULL,
  `profile_picture` varchar(255) DEFAULT NULL,
  `birthday` date NOT NULL,
  `religion` varchar(50) DEFAULT NULL,
  `place_of_birth` varchar(100) DEFAULT NULL,
  `age` int(11) DEFAULT NULL,
  `residential_address` varchar(255) DEFAULT NULL,
  `region` varchar(100) DEFAULT NULL,
  `province` varchar(100) DEFAULT NULL,
  `municipal` varchar(100) DEFAULT NULL,
  `barangay` varchar(100) DEFAULT NULL,
  `father_name` varchar(100) DEFAULT NULL,
  `father_occupation` varchar(100) DEFAULT NULL,
  `father_contact` varchar(20) DEFAULT NULL,
  `mother_name` varchar(100) DEFAULT NULL,
  `mother_occupation` varchar(100) DEFAULT NULL,
  `mother_contact` varchar(20) DEFAULT NULL,
  `guardian_name` varchar(100) DEFAULT NULL,
  `guardian_occupation` varchar(100) DEFAULT NULL,
  `guardian_contact` varchar(20) DEFAULT NULL,
  `admission_status` varchar(255) DEFAULT 'for_verification',
  `que_code` varchar(50) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `facebook` varchar(255) DEFAULT NULL,
  `admission_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `strand` varchar(100) DEFAULT NULL,
  `birth_cert` tinyint(1) DEFAULT 0,
  `report_card` tinyint(1) DEFAULT 0,
  `good_moral` tinyint(1) DEFAULT 0,
  `id_pic` tinyint(1) DEFAULT 0,
  `esc_cert` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `student_information`
--

INSERT INTO `student_information` (`id`, `student_number`, `lrn`, `firstname`, `middlename`, `lastname`, `status`, `gender`, `grade_level`, `profile_picture`, `birthday`, `religion`, `place_of_birth`, `age`, `residential_address`, `region`, `province`, `municipal`, `barangay`, `father_name`, `father_occupation`, `father_contact`, `mother_name`, `mother_occupation`, `mother_contact`, `guardian_name`, `guardian_occupation`, `guardian_contact`, `admission_status`, `que_code`, `phone`, `email`, `facebook`, `admission_date`, `strand`, `birth_cert`, `report_card`, `good_moral`, `id_pic`, `esc_cert`) VALUES
(20, '2025-55142', '20250018', 'Hannah', 'Aquino', 'Santos', 'active', 'female', 'Grade 12', NULL, '2006-07-15', 'Christian', 'Pangasinan', 18, '56 Ramos St.', NULL, NULL, NULL, NULL, 'Victor Santos', 'Engineer', '09170008881', 'Angela Santos', 'Housewife', '09170008882', NULL, NULL, NULL, 'approved', NULL, '09170008880', 'hannah.santos@example.com', 'fb.com/hannah.santos', '2025-08-22 20:55:16', NULL, 1, 1, 1, 1, 1),
(21, '2025-32783', '20250017', 'Gabriel', 'Diaz', 'Fernandez', 'active', 'male', 'Grade 12', NULL, '2006-03-10', 'Catholic', 'Batangas', 18, '34 P. Burgos St.', 'Region IV-A', 'Batangas', 'Batangas City', 'Poblacion', 'Romeo Fernandez', 'Fisherman', '09170007771', 'Isabel Fernandez', 'Vendor', '09170007772', NULL, NULL, NULL, 'approved', NULL, '09170007770', 'gabriel.fernandez@example.com', 'fb.com/gabriel.fernandez', '2025-08-22 20:56:35', 'HUMSS', 1, 1, 1, 1, 0),
(22, '2025-95762', '20250011', 'Adrian', 'Santos', 'Villamor', 'active', 'male', 'Grade 9', NULL, '2009-02-14', 'Catholic', 'Cavite', 15, '12 Mabini St.', NULL, NULL, NULL, NULL, 'Carlos Villamor', 'Driver', '09170001111', 'Liza Villamor', 'Vendor', '09170001112', NULL, NULL, NULL, 'approved', NULL, '09170001110', 'adrian.villamor@example.com', 'fb.com/adrian.villamor', '2025-08-23 04:41:57', NULL, 1, 1, 1, 1, 1),
(23, '2025-99810', '20250012', 'Bianca', 'Lopez', 'Navarro', 'active', 'female', 'Grade 9', NULL, '2009-09-21', 'Christian', 'Taguig', 15, '45 Bayani Rd.', 'NCR', 'Metro Manila', 'Taguig', 'Western Bicutan', 'Mario Navarro', 'Engineer', '09170002221', 'Celia Navarro', 'Housewife', '09170002222', NULL, NULL, NULL, 'approved', NULL, '09170002220', 'bianca.navarro@example.com', 'fb.com/bianca.navarro', '2025-08-23 08:36:24', NULL, 1, 1, 0, 1, 0),
(24, '2025-03938', '20250014', 'Danica', 'Garcia', 'Torres', 'active', 'female', 'Grade 10', NULL, '2008-12-08', 'Christian', 'Laguna', 16, '23 Calamba Rd.', 'Region IV-A', 'Laguna', 'San Pablo', 'Sto. Angel', 'Antonio Torres', 'Farmer', '09170004441', 'Lourdes Torres', 'Teacher', '09170004442', NULL, NULL, NULL, 'approved', NULL, '09170004440', 'danica.torres@example.com', 'fb.com/danica.torres', '2025-08-24 04:37:24', NULL, 1, 0, 1, 1, 0),
(25, '2025-45561', '20250013', 'Christian', 'Mendoza', 'Ramos', 'active', 'male', 'Grade 10', NULL, '2008-04-30', 'Catholic', 'Baguio', 16, '67 Session Rd.', 'CAR', 'Benguet', 'Baguio City', 'Loakan', 'Rafael Ramos', 'Carpenter', '09170003331', 'Alma Ramos', 'Nurse', '09170003332', NULL, NULL, NULL, 'approved', NULL, '09170003330', 'christian.ramos@example.com', 'fb.com/christian.ramos', '2025-08-24 13:32:47', NULL, 1, 1, 1, 0, 1),
(26, '2025-68933', '20250010', 'Lea', 'Aquino', 'Santiago', 'active', 'female', 'Grade 8', NULL, '2010-06-30', 'Catholic', 'Quezon', 14, '951 Test St.', NULL, NULL, NULL, NULL, 'Pedro Santiago', 'Carpenter', '09101234561', 'Maria Santiago', 'Nurse', '09101234562', NULL, NULL, NULL, 'approved', NULL, '09101234560', 'lea.santiago@example.com', 'fb.com/lea.santiago', '2025-08-24 13:57:54', NULL, 1, 1, 1, 1, 1),
(27, '2025-07422', '20250007', 'David', 'Flores', 'Bautista', 'active', 'male', 'Grade 5', NULL, '2013-04-03', 'Christian', 'Iloilo', 11, '159 Test Lane', 'Region VI', 'Iloilo', 'Iloilo City', 'Jaro', 'Paulo Bautista', 'Teacher', '09777891231', 'Linda Bautista', 'Vendor', '09777891232', NULL, NULL, NULL, 'approved', NULL, '09777891230', 'david.bautista@example.com', 'fb.com/david.bautista', '2025-08-31 13:23:38', NULL, 1, 1, 0, 1, 0),
(28, '2025-08605', '20250019', 'Ivan', 'Lopez', 'Cruz', 'active', 'male', 'Grade 12', NULL, '2006-01-28', 'Catholic', 'Nueva Ecija', 18, '12 Del Pilar St.', 'Region III', 'Nueva Ecija', 'Cabanatuan', 'Sampaloc', 'Francisco Cruz', 'Farmer', '09170009991', 'Gloria Cruz', 'Teacher', '09170009992', NULL, NULL, NULL, 'approved', NULL, '09170009990', 'ivan.cruz@example.com', 'fb.com/ivan.cruz', '2025-08-31 13:23:57', 'STEM', 1, 1, 0, 1, 0),
(29, '2025-55480', '20250009', 'James', 'Diaz', 'Fernandez', 'active', 'male', 'Grade 7', NULL, '2011-08-17', 'Christian', 'Pampanga', 13, '852 Example St.', 'Region III', 'Pampanga', 'San Fernando', 'Dolores', 'Arturo Fernandez', 'Driver', '09999123451', 'Cecilia Fernandez', 'Vendor', '09999123452', NULL, NULL, NULL, 'approved', NULL, '09999123450', 'james.fernandez@example.com', 'fb.com/james.fernandez', '2025-09-01 14:17:16', NULL, 1, 1, 1, 0, 0),
(30, '2025-03743', '20250020', 'Jasmine', 'Ramos', 'Gonzales', 'active', 'female', 'Grade 12', NULL, '2006-09-09', 'Christian', 'Ilocos Norte', 18, '78 Luna St.', 'Region I', 'Ilocos Norte', 'Laoag', 'Barangay 1', 'Alfredo Gonzales', 'Driver', '09170101011', 'Marites Gonzales', 'Vendor', '09170101012', NULL, NULL, NULL, 'approved', NULL, '09170101010', 'jasmine.gonzales@example.com', 'fb.com/jasmine.gonzales', '2025-09-01 16:30:44', 'ABM', 1, 1, 1, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `student_tuition`
--

CREATE TABLE `student_tuition` (
  `id` int(11) NOT NULL,
  `student_number` varchar(20) NOT NULL,
  `payment_plan` varchar(200) NOT NULL,
  `enrolled_section` varchar(50) NOT NULL,
  `registration_fee` decimal(10,2) NOT NULL DEFAULT 0.00,
  `tuition_fee` decimal(10,2) NOT NULL DEFAULT 0.00,
  `miscellaneous` decimal(10,2) NOT NULL DEFAULT 0.00,
  `uniform` decimal(10,2) NOT NULL DEFAULT 0.00,
  `uniform_cart` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`uniform_cart`)),
  `discount_type` enum('percent','fixed','') DEFAULT '',
  `discount_value` decimal(10,2) NOT NULL DEFAULT 0.00,
  `discount_amount` decimal(10,2) NOT NULL DEFAULT 0.00,
  `downpayment` decimal(10,2) NOT NULL DEFAULT 0.00,
  `enrolled_date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `student_tuition`
--

INSERT INTO `student_tuition` (`id`, `student_number`, `payment_plan`, `enrolled_section`, `registration_fee`, `tuition_fee`, `miscellaneous`, `uniform`, `uniform_cart`, `discount_type`, `discount_value`, `discount_amount`, `downpayment`, `enrolled_date`) VALUES
(17, '2025-55142', 'Quarterly', '33', 2500.00, 0.00, 6980.00, 1920.00, '[{\"name\":\"Grade 11 to 12 - Top - Long Sleeves\",\"quantity\":3,\"total\":1920,\"gender\":\"Male\",\"size\":\"XL\"}]', '', 0.00, 0.00, 1000.00, '2025-08-22 22:55:47'),
(18, '2025-56945', 'Quarterly', '33', 2500.00, 0.00, 6980.00, 1920.00, '[{\"name\":\"Grade 11 to 12 - Top - Long Sleeves\",\"quantity\":3,\"total\":1920,\"gender\":\"Male\",\"size\":\"XL\"}]', '', 0.00, 0.00, 1000.00, '2025-08-22 22:56:07'),
(19, '2025-02870', 'Quarterly', '33', 2500.00, 0.00, 6980.00, 1920.00, '[{\"name\":\"Grade 11 to 12 - Top - Long Sleeves\",\"quantity\":3,\"total\":1920,\"gender\":\"Male\",\"size\":\"XL\"}]', '', 0.00, 0.00, 1000.00, '2025-08-22 22:56:17'),
(20, '2025-32783', 'Semestral', '34', 2500.00, 0.00, 6980.00, 640.00, '[{\"name\":\"Grade 11 to 12 - Top - Long Sleeves\",\"quantity\":1,\"total\":640,\"gender\":\"Male\",\"size\":\"XL\"}]', '', 0.00, 0.00, 0.00, '2025-08-22 22:56:56'),
(21, '2025-95762', 'Quarterly', '27', 2500.00, 29118.00, 15635.25, 550.00, '[{\"name\":\"Grade 1 to 6 - Top - Polo Jacket\",\"quantity\":1,\"total\":550,\"gender\":\"Male\",\"size\":\"XL\"}]', '', 0.00, 0.00, 0.00, '2025-08-23 09:46:53'),
(22, '2025-99810', 'Quarterly', '27', 2500.00, 29118.00, 15635.25, 1190.00, '[{\"name\":\"Grade 1 to 6 - Top - Polo Jacket\",\"quantity\":1,\"total\":550,\"gender\":\"Male\",\"size\":\"XL\"},{\"name\":\"Grade 11 to 12 - Top - Long Sleeves\",\"quantity\":1,\"total\":640,\"gender\":\"Male\",\"size\":\"XS\"}]', 'percent', 10.00, 4594.33, 0.00, '2025-08-23 10:37:02'),
(23, '2025-03938', 'Monthly', '28', 2500.00, 29545.75, 15635.25, 550.00, '[{\"name\":\"Grade 1 to 6 - Top - Polo Jacket\",\"quantity\":1,\"total\":550,\"gender\":\"Male\",\"size\":\"S\"}]', 'percent', 100.00, 45731.00, 0.00, '2025-08-24 06:40:11'),
(24, '2025-45561', 'Semestral', '28', 2500.00, 29545.75, 15635.25, 1170.00, '[{\"name\":\"Grade 1 to 6 - Top - Polo Jacket\",\"quantity\":1,\"total\":550,\"gender\":\"Male\",\"size\":\"XL\"},{\"name\":\"Grade 7 to 10 - Top - Polo Barong\",\"quantity\":1,\"total\":620,\"gender\":\"Male\",\"size\":\"L\"}]', '', 0.00, 0.00, 0.00, '2025-08-24 15:34:43'),
(25, '2025-68933', 'Semestral', '26', 2500.00, 29118.00, 15635.25, 1600.00, '[{\"name\":\"Grade 1 to 6 - Top - Polo Jacket\",\"quantity\":1,\"total\":550,\"gender\":\"Male\",\"size\":\"XL\"},{\"name\":\"Grade 7 to 10 - Top - Polo Barong\",\"quantity\":1,\"total\":620,\"gender\":\"Male\",\"size\":\"XL\"},{\"name\":\"Nursery to Kinder - Top - Polo Jacket with Lining\",\"quantity\":1,\"total\":430,\"gender\":\"Male\",\"size\":\"XS\"}]', '', 0.00, 0.00, 0.00, '2025-08-24 15:58:11'),
(26, '2025-07422', 'Semestral', '24', 2500.00, 24752.75, 15635.25, 1720.00, '[{\"name\":\"Grade 1 to 6 - Top - Polo Jacket\",\"quantity\":1,\"total\":550,\"gender\":\"Male\",\"size\":\"S\"},{\"name\":\"Grade 1 to 6 - Top - Polo Jacket\",\"quantity\":1,\"total\":550,\"gender\":\"Male\",\"size\":\"M\"},{\"name\":\"Grade 7 to 10 - Top - Polo Barong\",\"quantity\":1,\"total\":620,\"gender\":\"Male\",\"size\":\"XL\"}]', '', 0.00, 0.00, 1000.00, '2025-08-31 15:25:29'),
(27, '2025-08605', 'Quarterly', '33', 2500.00, 0.00, 6980.00, 860.00, '[{\"name\":\"Nursery to Kinder - Top - Polo Jacket with Lining\",\"quantity\":1,\"total\":430,\"gender\":\"Male\",\"size\":\"S\"},{\"name\":\"Nursery to Kinder - Top - Polo Jacket with Lining\",\"quantity\":1,\"total\":430,\"gender\":\"Male\",\"size\":\"XS\"}]', '', 0.00, 0.00, 0.00, '2025-09-01 12:55:40'),
(28, '2025-55480', 'Quarterly', '', 2500.00, 29118.00, 15635.25, 550.00, '[{\"name\":\"Grade 1 to 6 - Top - Polo Jacket\",\"quantity\":1,\"total\":550,\"gender\":\"Male\",\"size\":\"S\"}]', '', 0.00, 0.00, 0.00, '2025-09-01 18:29:44'),
(29, '2025-90689', 'Semestral', '', 2500.00, 29118.00, 15635.25, 550.00, '[{\"name\":\"Grade 1 to 6 - Top - Polo Jacket\",\"quantity\":1,\"total\":550,\"gender\":\"Male\",\"size\":\"S\"}]', '', 0.00, 0.00, 100.00, '2025-09-01 18:30:03'),
(30, '2025-03743', 'Quarterly', '33', 2500.00, 0.00, 6980.00, 550.00, '[{\"name\":\"Grade 1 to 6 - Top - Polo Jacket\",\"quantity\":1,\"total\":550,\"gender\":\"Male\",\"size\":\"S\"}]', '', 0.00, 0.00, 0.00, '2025-09-01 18:31:22');

-- --------------------------------------------------------

--
-- Table structure for table `subjects`
--

CREATE TABLE `subjects` (
  `id` int(11) NOT NULL,
  `subject_code` varchar(20) NOT NULL,
  `description` varchar(255) NOT NULL,
  `grade_level` varchar(10) NOT NULL,
  `hours` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `subjects`
--

INSERT INTO `subjects` (`id`, `subject_code`, `description`, `grade_level`, `hours`) VALUES
(1, 'Core 1', 'Oral Communication', 'Grade 11', 1),
(2, 'Core 3', 'General Mathematics', 'Grade 11', 1),
(3, 'Core 4', 'Earth and Life Science', 'Grade 11', 1),
(4, 'Core 6', 'Komunikasyon at Pananaliksik sa Wika at Kulturang Pilipino', 'Grade 11', 1),
(5, 'Core 7', 'Contemporary Philippine Arts from the Filipino Region', 'Grade 11', 1),
(6, 'Core 8', 'Understanding Culture, Society, and Politics', 'Grade 11', 1),
(7, 'Core 15A', 'Physical Education and Health', 'Grade 11', 1),
(8, 'Applied 3', 'English for Academic and Professional Purposes', 'Grade 11', 1),
(9, 'Applied 4', 'Empowering Technology', 'Grade 11', 1),
(10, 'Core 2', 'Reading and Writing Skills', 'Grade 11', 1),
(11, 'Core 9', '21st Century Literature from the Philippines and the World', 'Grade 11', 1),
(12, 'Core 10', 'Statistics and Probability', 'Grade 11', 1),
(13, 'Core 12', 'Pagbasa at Pagsusuri ng Ibat-ibang Teksto Tungo sa Pananaliksik', 'Grade 11', 1),
(14, 'Core 15B', 'Physical Education and Health', 'Grade 11', 1),
(15, 'Applied 1', 'Research in Daily Life 1', 'Grade 11', 1),
(16, 'Spec 2', 'Introduction to World Religion and Belief System', 'Grade 11', 1),
(17, 'Spec 4', 'Discipline and Ideas in the Social Science', 'Grade 11', 1),
(18, 'Spec 5', 'Philippine Politics and Governance', 'Grade 11', 1),
(20, 'Lang', 'Language', 'Grade 1', 1),
(21, 'RL', 'Read and Literacy', 'Grade 1', 1),
(22, 'Fil', 'Filipino', 'Grade 1', 1),
(23, 'Math', 'Mathematics', 'Grade 1', 1),
(24, 'Scie', 'Science', 'Grade 1', 1),
(25, 'MK', 'Makabansa', 'Grade 1', 1),
(26, 'GMRC', 'Good Manner and Right Conduct', 'Grade 1', 1),
(27, 'MAPEH', 'Music Arts - Physical Education and Health', 'Grade 1', 1),
(28, 'AP', 'Araling Panlipunan', 'Grade 10', 1),
(29, 'EPP', 'Edukasyong Pantahanan at Pangkabuhayan', 'Grade 1', 1),
(30, 'TLE', 'Technology and Livelihood Education', 'Grade 10', 1),
(31, 'ICT', 'Information and Communication Technology', 'Grade 10', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tuition_fees`
--

CREATE TABLE `tuition_fees` (
  `id` int(11) NOT NULL,
  `grade_level` varchar(50) NOT NULL,
  `tuition_fee` decimal(10,2) NOT NULL DEFAULT 0.00,
  `miscellaneous` decimal(10,2) NOT NULL DEFAULT 0.00,
  `total` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tuition_fees`
--

INSERT INTO `tuition_fees` (`id`, `grade_level`, `tuition_fee`, `miscellaneous`, `total`) VALUES
(1, 'Nursery', 22341.00, 16359.00, 38700.00),
(2, 'Kinder', 24283.75, 16359.00, 40642.75),
(3, 'Grade 1', 24200.75, 15635.25, 39836.00),
(4, 'Grade 2', 24200.75, 15635.25, 39836.00),
(5, 'Grade 3', 24200.75, 15635.25, 39836.00),
(6, 'Grade 4', 24752.75, 15635.25, 40388.00),
(7, 'Grade 5', 24752.75, 15635.25, 40388.00),
(8, 'Grade 6', 24752.75, 15635.25, 40388.00),
(9, 'Grade 7', 29118.00, 15635.25, 44753.25),
(10, 'Grade 8', 29118.00, 15635.25, 44753.25),
(11, 'Grade 9', 29118.00, 15635.25, 44753.25),
(12, 'Grade 10', 29545.75, 15635.25, 45181.00),
(13, 'Grade 11', 0.00, 6980.00, 6980.00),
(14, 'Grade 12', 0.00, 6980.00, 6980.00);

-- --------------------------------------------------------

--
-- Table structure for table `uniforms`
--

CREATE TABLE `uniforms` (
  `id` int(11) NOT NULL,
  `grade_level` varchar(50) NOT NULL,
  `gender` enum('Male','Female','Unisex') NOT NULL,
  `classification` varchar(50) NOT NULL,
  `type` varchar(50) NOT NULL,
  `size` varchar(20) NOT NULL,
  `price` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `uniforms`
--

INSERT INTO `uniforms` (`id`, `grade_level`, `gender`, `classification`, `type`, `size`, `price`) VALUES
(40, 'Nursery to Kinder', 'Male', 'Top', 'Polo Jacket with Lining', 'XS', 430.00),
(41, 'Nursery to Kinder', 'Male', 'Top', 'Polo Jacket with Lining', 'S', 430.00),
(42, 'Nursery to Kinder', 'Male', 'Top', 'Polo Jacket with Lining', 'M', 475.00),
(43, 'Nursery to Kinder', 'Male', 'Top', 'Polo Jacket with Lining', 'L', 520.00),
(44, 'Nursery to Kinder', 'Male', 'Top', 'Polo Jacket with Lining', 'XL', 550.00),
(45, 'Grade 1 to 6', 'Male', 'Top', 'Polo Jacket', 'XS', 550.00),
(46, 'Grade 1 to 6', 'Male', 'Top', 'Polo Jacket', 'S', 550.00),
(47, 'Grade 1 to 6', 'Male', 'Top', 'Polo Jacket', 'M', 550.00),
(48, 'Grade 1 to 6', 'Male', 'Top', 'Polo Jacket', 'L', 550.00),
(49, 'Grade 1 to 6', 'Male', 'Top', 'Polo Jacket', 'XL', 550.00),
(51, 'Grade 7 to 10', 'Male', 'Top', 'Polo Barong', 'XS', 620.00),
(52, 'Grade 7 to 10', 'Male', 'Top', 'Polo Barong', 'S', 620.00),
(53, 'Grade 7 to 10', 'Male', 'Top', 'Polo Barong', 'M', 620.00),
(54, 'Grade 7 to 10', 'Male', 'Top', 'Polo Barong', 'L', 620.00),
(55, 'Grade 7 to 10', 'Male', 'Top', 'Polo Barong', 'XL', 620.00),
(56, 'Grade 11 to 12', 'Male', 'Top', 'Long Sleeves', 'XS', 640.00),
(57, 'Grade 11 to 12', 'Male', 'Top', 'Long Sleeves', 'S', 640.00),
(58, 'Grade 11 to 12', 'Male', 'Top', 'Long Sleeves', 'M', 640.00),
(59, 'Grade 11 to 12', 'Male', 'Top', 'Long Sleeves', 'L', 640.00),
(60, 'Grade 11 to 12', 'Male', 'Top', 'Long Sleeves', 'XL', 640.00);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `acc_type` enum('admin','teacher','parent','student') NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `gender` enum('male','female','other') DEFAULT NULL,
  `birthdate` date DEFAULT NULL,
  `phone_number` varchar(20) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `profile` varchar(255) NOT NULL,
  `rfid` int(100) DEFAULT NULL,
  `enroll_id` int(11) NOT NULL,
  `acc_status` varchar(100) NOT NULL DEFAULT 'active',
  `subject` varchar(1000) DEFAULT NULL,
  `section_id` int(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `acc_type`, `username`, `email`, `password`, `first_name`, `last_name`, `gender`, `birthdate`, `phone_number`, `address`, `created_at`, `updated_at`, `profile`, `rfid`, `enroll_id`, `acc_status`, `subject`, `section_id`) VALUES
(1, 'admin', 'stephani.admin', 'stephani.candado@example.com', '$2y$10$KEek95Y7gfl.7WplR9kPI.jOp2mGx/daQXe4zjOITFv7DkgpHdJX.', 'Stephani', 'Candado', 'female', '1990-03-15', '09170000001', '101 Admin Ave, Cityville', '2025-06-13 16:58:26', '2025-07-14 09:10:20', 'dummy.jpg', NULL, 0, 'active', NULL, 0),
(3, 'parent', 'cj.parent', 'cj.escalora@example.com', '$2y$10$KEek95Y7gfl.7WplR9kPI.jOp2mGx/daQXe4zjOITFv7DkgpHdJX.', 'CJ', 'Escalora', 'male', '1982-11-05', '09170000003', '103 Parent Rd, Cityville', '2025-06-13 16:58:26', '2025-07-15 06:05:16', 'dummy.jpg', NULL, 0, 'active', NULL, 0),
(10, 'student', 'mary_espinosa.student', 'mary@gmail.com', '$2y$10$J0C2NhUoyekINLMnI6CguuYuHO04Jrusb0x1Xrj//lDVTk95bfLAK', 'Mary', 'Espinosa', 'female', '2000-02-22', 'N/A', 'Bundukan, Bocaue, Bulacan, Central Luzon', '2025-06-22 03:19:52', '2025-07-23 10:19:41', 'dummy.jpg', NULL, 3, 'active', NULL, 17),
(12, 'student', 'ava_flores.student', 'ava.flores@email.com', '$2y$10$Rk9RsPBzi7Tl5W0ipMR9Re/Ym8UzrmHTYhIX22ekpiEAvp3tuGb3i', 'Ava', 'Flores', 'female', '2012-08-10', 'N/A', 'Longos, Pulilan, Bulacan', '2025-06-22 03:43:53', '2025-07-15 18:56:45', 'dummy.jpg', 1224955174, 15, 'active', NULL, 17),
(13, 'student', 'daniel_tan.student', 'daniel.tan@email.com', '$2y$10$Yt5ZH.lgNtQA57Ys92IM1uUP76aeHWlMmnC0OfvHrvxsgO90sca/q', 'Daniel', 'Tan', 'male', '2013-06-25', 'N/A', 'Tikay, Malolos, Bulacan', '2025-06-22 03:49:53', '2025-07-15 18:56:45', 'dummy.jpg', 1224955175, 8, 'active', NULL, 17),
(17, 'student', 'sophia_santos.student', 'sophia.santos@email.com', '$2y$10$KEek95Y7gfl.7WplR9kPI.jOp2mGx/daQXe4zjOITFv7DkgpHdJX.', 'Sophia', 'Santos', 'female', '2017-11-05', 'N/A', 'Tabang, Guiguinto, Bulacan', '2025-06-24 02:49:33', '2025-07-15 18:56:45', 'dummy.jpg', NULL, 7, 'active', NULL, 17),
(21, 'student', 'isabella_navarro.student', 'isabella.navarro@email.com', '$2y$10$yZ/m1QREMDYg2ZUW/PmHhe4AbtCMNe2.P.bBsdSZVJOzmbZK/KI2i', 'Isabella', 'Navarro', 'female', '2013-03-08', 'N/A', 'Poblacion, San Rafael, Bulacan', '2025-06-25 01:37:50', '2025-07-15 18:56:45', 'dummy.jpg', NULL, 13, 'active', NULL, 17),
(22, 'student', 'mia_salazar.student', 'mia.salazar@email.com', '$2y$10$vYoAj4ApyumEBqYMxD0OhOijyRIrK6qgVf9xfmt6YomYL6X4nC3Z6', 'Mia', 'Salazar', 'female', '2019-02-17', 'N/A', 'Pag-asa, Obando, Bulacan', '2025-06-25 01:38:01', '2025-07-15 18:56:45', 'dummy.jpg', NULL, 17, 'active', NULL, 17),
(23, 'student', 'chloe_perez.student', 'floterina@gmail.com', '$2y$10$YlqqMHKXHEn4R5C21NjHa.SjRIW4WxYLgGIVhQj8mmBskyNnQ75M2', 'Chloe', 'Perez', 'female', '2016-09-09', 'N/A', 'Calvario, Meycauayan, Bulacan', '2025-06-25 01:38:37', '2025-07-15 18:56:45', 'dummy.jpg', NULL, 11, 'active', NULL, 17),
(24, 'student', 'ethan_de guzman.student', 'ethan.guzman@email.com', '$2y$10$DB0gVJBYB0bI/.4A25sqxO3yCu9CxziD8NZlansOmmuh8n3KNmauy', 'Ethan', 'De Guzman', 'male', '2018-04-22', 'N/A', 'San Pedro, Hagonoy, Bulacan', '2025-06-25 01:38:52', '2025-07-15 18:56:45', 'dummy.jpg', NULL, 16, 'active', NULL, 17),
(29, 'student', 'liam_cruz.student', 'liam.cruz@email.com', '$2y$10$3HOkXhZsZ9kExFqixs3m5erACjzIfyht17T/8doDQ4xZlibL/gcjS', 'Liam', 'Cruz', 'male', '2014-05-12', 'N/A', 'San Vicente, Malolos, Bulacan', '2025-07-03 18:54:21', '2025-08-20 08:48:27', 'dummy.jpg', NULL, 12, 'active', NULL, NULL),
(30, 'student', 'noah_domingo.student', 'noah.domingo@email.com', '$2y$10$cb2ozimttNchSqW0yq7G5OuliBgMofPmgd8FHuAXmVqFTkFyFsXWG', 'Noah', 'Domingo', 'male', '2016-11-20', 'N/A', 'Borol 2nd, Balagtas, Bulacan', '2025-07-05 03:55:07', '2025-08-09 02:59:20', 'dummy.jpg', NULL, 14, 'active', NULL, 17),
(31, 'student', 'james_villanueva.student', 'james.villanueva@email.com', '$2y$10$Rt4IbaC4OeBRPXmf6KyNkOkA5VhLg3u0wcE3Y5M6EFDuHauN/VKJC', 'James', 'Villanueva', 'male', '2011-09-01', 'N/A', '', '2025-07-06 18:36:49', '2025-07-15 18:56:45', 'dummy.jpg', NULL, 18, 'active', NULL, 17),
(32, 'student', 'nathan_velasco.student', 'nathan.v@example.com', '$2y$10$YEIXYD8KAOz/1zTXj1BuRuaDvxupZVkGTniHzbNBpp4tqiqMDtybO', 'Nathan', 'Velasco', 'male', '2007-04-10', 'fb.com/nathan.v', '123 Main St', '2025-07-08 18:52:35', '2025-07-15 18:56:45', 'dummy.jpg', NULL, 35, 'active', NULL, 17),
(33, 'student', 'bianca_torres.student', 'bianca.t@example.com', '$2y$10$0dOlACpaEczDVCxTBe92dOxkfAx0eNPb.j4/R1Y4bexn/nQCdF3/e', 'Bianca', 'Torres', 'female', '2006-11-21', 'fb.com/bianca.t', '456 Lopez Ave', '2025-07-10 03:20:15', '2025-07-15 18:56:45', 'dummy.jpg', NULL, 36, 'active', NULL, 17),
(34, 'student', 'alvin_fernandez.student', 'galecandado@gmail.com', '$2y$10$YTl8vDJDcyPc5hk6Hvwl8.nKtrPvILrJ0pxfYtPS8ZgWSx0thdIE2', 'Matthew Sebastian', 'De Guzman', 'male', '2017-09-19', '', 'Loma de Gato, Marilao, Bulacan, Central Luzon, Block 15 Lot 28 Phase 1 Green Forbes Residences', '2025-07-10 03:20:34', '2025-07-15 18:56:45', 'dummy.jpg', NULL, 61, 'active', NULL, 17),
(35, 'student', 'ulysses_domingo.student', 'ulysses.d@example.com', '$2y$10$csCzr57WPRGCjmnKpSXgj.jYGuCU3pGoQFBlmorZLA1NPyTTuei3O', 'Ulysses', 'Domingo', 'male', '2007-03-12', 'fb.com/ulysses.d', '23 Mabuhay St', '2025-07-12 06:42:48', '2025-07-15 18:56:45', 'dummy.jpg', NULL, 55, 'active', NULL, 17),
(36, 'student', 'maceo cael_escalora.student', 'escalora.cj28@gmail.com', '$2y$10$kzp7yp/OuMV1sqdleON9y.uFSUOMNymvmBAdEKCLDZ3EZDeKDBmNi', 'Maceo Cael', 'Escalora', 'male', '2025-06-14', '', 'Santa Rosa I, Marilao, Bulacan, Central Luzon, B3 L2 Mary grace subd.', '2025-07-12 08:10:27', '2025-08-22 15:02:44', 'dummy.jpg', NULL, 70, 'active', NULL, NULL),
(37, 'student', 'vanessa_tuazon.student', 'vanessa.t@example.com', '$2y$10$XaIJVj5Hgy8I7JyrGnWPdOzaz5XnWObSFM8Iy8EnzzIYZhxdoHVXO', 'Vanessa', 'Tuazon', 'female', '2006-05-01', 'fb.com/vanessa.t', '11 Mabini St', '2025-07-12 08:19:42', '2025-07-15 18:56:45', 'dummy.jpg', NULL, 56, 'active', NULL, 17),
(38, 'teacher', 'tan.teacher', 'tan@gmail.com', '$2y$10$uh2Usb5yLsmVFXtSkjtBH.hx9fWOM04QR6/Q0aS3hdMGRxMOoMyZa', 'Niña Francesca', 'Tan', 'female', '2000-07-12', '', 'Meycauayan, Bulacan', '2025-07-12 15:14:03', '2025-07-15 20:58:29', 'user_38_1752483132.png', NULL, 0, 'active', 'Oral Communication', NULL),
(39, 'teacher', 'mauricio.teacher', 'mauricio@gmail.com', '$2y$10$KEek95Y7gfl.7WplR9kPI.jOp2mGx/daQXe4zjOITFv7DkgpHdJX.', 'Roshane', 'Mauricio', 'female', '2000-07-12', '', 'Meycauayan, Bulacan', '2025-07-12 15:17:57', '2025-07-14 08:45:28', 'dummy.jpg', NULL, 0, 'active', 'MK - Makabansa', NULL),
(40, 'teacher', 'stephany.teacher', 'stephany.admin@gmail.com', '$2y$10$KEek95Y7gfl.7WplR9kPI.jOp2mGx/daQXe4zjOITFv7DkgpHdJX.', 'Stephany', 'Gandula', 'female', '2025-07-12', '', 'Marilao, Bulacan', '2025-07-12 15:20:06', '2025-07-14 08:57:11', 'user_68727d26318ef.jpg', NULL, 0, 'active', 'Core 1 - Oral Communication', NULL),
(41, 'teacher', 'delara.teacher', 'delara@gmail.com', '$2y$10$nVP5lPueFtnhvkP5xOv2K.g3I4j.XQGa1.VIQwDC7c2bn2ynPnnc2', 'Ann Nicole', 'De Lara', 'female', '2025-07-12', '', 'Meycauayan, Bulacan', '2025-07-12 15:22:45', '2025-07-12 15:22:45', 'dummy.jpg', NULL, 0, 'active', 'RL - Read and Literacy', NULL),
(42, 'teacher', 'mancenido.teacher', 'mancenido@gmail.com', '$2y$10$XCe5y6sBwNBjeSODwMv9XO4gSrqvsIhsyZ6Z9kyrH/MAJr0AKWeHK', 'Kim', 'Mancenido', 'female', '2025-07-12', '', 'Meycauayan, Bulacan', '2025-07-12 15:24:43', '2025-07-12 15:24:43', 'dummy.jpg', NULL, 0, 'active', 'Core 1 - Oral Communication', NULL),
(43, 'teacher', 'agliam.teacher', 'agliam@gmail.com', '$2y$10$m/50Jsjk.R2dxqoiBP0PKOKfTDNoPB7V6wbrKd8Ji0gro9RZcYvbO', 'Rosilyn', 'Agliam', 'female', '2025-07-12', '', 'Meycauayan, Bulacan', '2025-07-12 15:29:20', '2025-07-12 15:29:20', 'dummy.jpg', NULL, 0, 'active', 'Applied 1 - Research in Daily Life 1', NULL),
(44, 'teacher', 'delmundo.teacher', 'delmundo@gmail.com', '$2y$10$lgW5SlOLXWrUkUAT58eGRugFkA16TctHxhlEOuBIP59PBtAogXWa6', 'Anna Lie', 'Del Mundo', 'female', '2025-07-12', '', 'Meycauayan, Bulacan', '2025-07-12 15:49:19', '2025-07-12 15:49:19', 'dummy.jpg', NULL, 0, 'active', 'Fil - Filipino', NULL),
(45, 'teacher', 'velasco.teacher', 'velasco@gmail.com', '$2y$10$FtNJH3xy9TV4IF0xEWb0E.PsG3XEQr09HQCwbNyq0UGTyImjj4..i', 'Ria', 'Velasco', 'female', '2025-07-12', '', 'Meycauayan, Bulacan', '2025-07-12 15:51:08', '2025-07-12 15:51:08', 'dummy.jpg', NULL, 0, 'active', 'Scie - Science', NULL),
(46, 'teacher', 'ala.teacher', 'ala@gmail.com', '$2y$10$8NCV3TQqMKAJhsOCCGZN6evutqpiYVGFV4cm/Qyrbgq.OBtzbJSyO', 'Leoncia', 'Ala', 'female', '2025-07-12', '', 'Meycauayan, Bulacan', '2025-07-12 15:53:04', '2025-07-12 15:53:04', 'dummy.jpg', NULL, 0, 'active', 'Fil - Filipino', NULL),
(47, 'teacher', 'talusig.teacher', 'talusig@gmail.com', '$2y$10$wtQUiR485dsFXIGcE8g9uu.gdvLYtOcKUhqt56frg4sJ0nnQakwKi', 'Karl Cedrick', 'Talusig', 'male', '2025-07-12', '', 'Meycauayan, Bulacan', '2025-07-12 15:56:22', '2025-07-12 15:56:22', 'dummy.jpg', NULL, 0, 'active', 'GMRC - Good Manner and Right Conduct', NULL),
(48, 'teacher', 'pahugot.teacher', 'pahugot@gmail.com', '$2y$10$j6A7E8QccEbd0CBjUdIhVuWePvK8V4o7zhlFgP4OZltLpLGHZ75qm', 'Ellie Ann Joy', 'Pahugot', 'female', '2025-07-12', '', 'Meycauayan, Bulacan', '2025-07-12 15:59:39', '2025-07-12 15:59:39', 'dummy.jpg', NULL, 0, 'active', 'MAPEH - Music Arts - Physical Education and Health', NULL),
(49, 'teacher', 'martinico.teacher', 'martinico@gmail.com', '$2y$10$c2HJmtwL157JnFUTPVVL8u42bD0JgXYXFkAGCX/zSFm4vZZFvGuIa', 'Jocelyn', 'Martinico', 'female', '2025-07-13', '', 'Meycauayan, Bulacan', '2025-07-12 16:00:40', '2025-07-12 16:00:40', 'dummy.jpg', NULL, 0, 'active', 'Lang - Language', NULL),
(50, 'teacher', 'delarosa.teacher', 'delarosa@gmail.com', '$2y$10$lSnylbvhr2AAyhTXfen2KucerTtndo4pkeZtDOV6ceOlLpdhEZYUC', 'Merck Justin', 'Dela Rosa', 'male', '2025-07-13', '', 'Meycauayan, Bulacan', '2025-07-12 16:02:08', '2025-07-12 16:02:08', 'dummy.jpg', NULL, 0, 'active', 'Math - Mathematics', NULL),
(51, 'teacher', 'navarro.teacher', 'navarro@gmail.com', '$2y$10$i/foiZYtbpHwQprQ2EUndOiUJ4g1GKkW9CxhU9JkxkdcEeUq3CxGa', 'Mark Edrian', 'Navarro', 'male', '2025-07-13', '', 'Meycauayan, Bulacan', '2025-07-12 16:05:30', '2025-07-12 16:05:30', 'dummy.jpg', NULL, 0, 'active', 'AP - Araling Panlipunan', NULL),
(52, 'student', 'yves_vergara.student', 'yves.v@example.com', '$2y$10$mYW3Zbj0qyQeaDS7pX4yjuvjVgtmb/BlZhftXvBG.XV2r1s.aXbW2', 'Yves', 'Vergara', 'male', '2007-09-21', 'fb.com/yves.v', '88 Rivera Rd', '2025-07-12 18:36:26', '2025-07-15 18:56:45', 'dummy.jpg', NULL, 59, 'active', NULL, 17),
(53, 'student', 'brianna_del mundo.student', 'brianna.d@example.com', '$2y$10$leKt.bcHCCPV7RnRiWD6K.nJdiDcdh6FBzXBe18.DBEXuDlzQO/A.', 'Brianna', 'Del Mundo', 'female', '2006-10-13', 'fb.com/brianna.d', '24 Ilocos Rd', '2025-07-12 19:47:19', '2025-07-15 18:56:45', 'dummy.jpg', NULL, 62, 'active', NULL, 17),
(54, 'student', 'daniella_gonzaga.student', 'daniella.g@example.com', '$2y$10$iNWAdONUMMOzU7H/ZROv5OV9kL9cB1/8xXAlSflVs5p8GTlsCkvD2', 'Daniella', 'Gonzaga', 'female', '2006-11-16', 'fb.com/daniella.g', '5 Hillside Rd', '2025-07-12 19:47:34', '2025-07-16 02:05:20', 'dummy.jpg', NULL, 64, 'active', NULL, 31),
(55, 'student', 'zaira_mercado.student', 'zaira.m@example.com', '$2y$10$/U0SXvHdigE9m7xlxFBUkuFfxahyyiAKYy4Gdpz6KFhkW71t.Usoa', 'Zaira', 'Mercado', 'female', '2006-04-25', 'fb.com/zaira.m', '9 Bautista St', '2025-07-12 19:48:23', '2025-07-15 18:56:45', 'dummy.jpg', NULL, 60, 'active', NULL, NULL),
(56, 'student', 'caleb_lim.student', 'caleb.l@example.com', '$2y$10$mTazEx./ndKFyslQrKJ0G.Yw27Wnix4gqZJfOejjwO4viV4svFKnK', 'Caleb', 'Lim', 'male', '2007-12-05', 'fb.com/caleb.l', '16 Mango St', '2025-07-13 05:26:00', '2025-07-16 00:06:12', 'dummy.jpg', 1189264005, 63, 'active', NULL, NULL),
(57, 'student', 'warren_lozano.student', 'warren.l@example.com', '$2y$10$wBoA21DHed69.h.vnmSew.HE5IKBUFkl0vl2qrJqJ2s9N172zHjc2', 'Warren', 'Lozano', 'male', '2007-06-14', 'fb.com/warren.l', '4 Kalayaan Rd', '2025-07-14 08:38:46', '2025-07-15 23:40:06', 'dummy.jpg', 1190446453, 57, 'active', NULL, NULL),
(58, 'student', 'gavin_santiago.student', 'gavin.s@example.com', '$2y$10$YOIKk1azhEDjoWp6fFrUA.Gi5TKuubor7vwnmRu3BdB6eLeBHHNwO', 'Gavin', 'Santiago', 'male', '2007-01-20', 'fb.com/gavin.s', '202 Taguig Rd', '2025-07-15 12:28:37', '2025-07-15 23:21:08', 'dummy.png', 1226073813, 41, 'active', NULL, NULL),
(59, 'student', 'nik_escalora.student', 'juliusbergania367@gmail.com', '$2y$10$Xt.KvpWodbZR0Bmd/eGVs.bfyrinXy7KTGH8mJd/dj8kAgLJW7XS2', 'nik', 'Escalora', 'male', '2025-07-16', '', 'Bambang, Bulacan, Bulacan, Central Luzon, 0437 Gavino Rd.', '2025-07-16 01:48:50', '2025-08-14 16:20:41', 'dummy.png', 1190562885, 80, 'active', NULL, 31);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admission_form`
--
ALTER TABLE `admission_form`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `lrn` (`lrn`);

--
-- Indexes for table `announcement`
--
ALTER TABLE `announcement`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `attendance`
--
ALTER TABLE `attendance`
  ADD PRIMARY KEY (`id`),
  ADD KEY `teacher_id` (`teacher_id`),
  ADD KEY `student_id` (`student_id`);

--
-- Indexes for table `class_schedule`
--
ALTER TABLE `class_schedule`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `master_list`
--
ALTER TABLE `master_list`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sections`
--
ALTER TABLE `sections`
  ADD PRIMARY KEY (`section_id`);

--
-- Indexes for table `student_information`
--
ALTER TABLE `student_information`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `lrn` (`lrn`),
  ADD KEY `student_information_ibfk_1` (`student_number`);

--
-- Indexes for table `student_tuition`
--
ALTER TABLE `student_tuition`
  ADD PRIMARY KEY (`id`),
  ADD KEY `student_number` (`student_number`);

--
-- Indexes for table `subjects`
--
ALTER TABLE `subjects`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tuition_fees`
--
ALTER TABLE `tuition_fees`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `uniforms`
--
ALTER TABLE `uniforms`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admission_form`
--
ALTER TABLE `admission_form`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=107;

--
-- AUTO_INCREMENT for table `announcement`
--
ALTER TABLE `announcement`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `attendance`
--
ALTER TABLE `attendance`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `class_schedule`
--
ALTER TABLE `class_schedule`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `master_list`
--
ALTER TABLE `master_list`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=80;

--
-- AUTO_INCREMENT for table `payment`
--
ALTER TABLE `payment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sections`
--
ALTER TABLE `sections`
  MODIFY `section_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `student_information`
--
ALTER TABLE `student_information`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `student_tuition`
--
ALTER TABLE `student_tuition`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `subjects`
--
ALTER TABLE `subjects`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `tuition_fees`
--
ALTER TABLE `tuition_fees`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `uniforms`
--
ALTER TABLE `uniforms`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `attendance`
--
ALTER TABLE `attendance`
  ADD CONSTRAINT `attendance_ibfk_1` FOREIGN KEY (`teacher_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `attendance_ibfk_2` FOREIGN KEY (`student_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;