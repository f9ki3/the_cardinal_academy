-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jun 25, 2025 at 05:41 AM
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
-- Database: `tca`
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
  `email` varchar(255) DEFAULT NULL,
  `facebook` varchar(255) DEFAULT NULL,
  `admission_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admission_form`
--

INSERT INTO `admission_form` (`id`, `lrn`, `firstname`, `middlename`, `lastname`, `status`, `gender`, `grade_level`, `profile_picture`, `birthday`, `religion`, `place_of_birth`, `age`, `residential_address`, `region`, `province`, `municipal`, `barangay`, `father_name`, `father_occupation`, `father_contact`, `mother_name`, `mother_occupation`, `mother_contact`, `guardian_name`, `guardian_occupation`, `guardian_contact`, `admission_status`, `que_code`, `email`, `facebook`, `admission_date`) VALUES
(2, '120912091212', 'Juan', 'Dave', 'Dela Cruz', 'Old Student', 'male', 'Grade 3', '', '2017-02-12', 'Roman Catholic', 'Marilao, Bulacan', 7, 'Loma de Gato, Marilao, Bulacan, Central Luzon', 'Central Luzon', 'Bulacan', 'Marilao', 'Loma de Gato', 'Michael Alcaraz', 'N/A', 'N/A', 'Rosario Alacaraz', 'N/A', 'N/A', 'Rosario Alacaraz', 'N/A', '09120912091', 'enrolled', 'Q782454', 'floterina@gmail.com', 'N/A', '2025-06-22 03:15:59'),
(3, '78129878129', 'Mary', 'Madrid', 'Espinosa', 'Old Student', 'male', 'Grade 7', '', '2000-02-22', 'Hindu', 'Bocaue, Bulacan', 12, 'Bundukan, Bocaue, Bulacan, Central Luzon', 'Central Luzon', 'Bulacan', 'Bocaue', 'Bundukan', 'Reynaldo Madrid', 'Businessman', '09120912091', 'Janella Madrid', 'N/A', 'N/A', 'Reynaldo Madrid', 'Businessman', '09120912091', 'enrolled', 'Q653061', 'mary@gmail.com', 'N/A', '2025-06-22 03:19:52'),
(4, '782178217821', 'John', 'Mikers', 'Moore', 'Old Student', 'male', 'Grade 3', '', '2018-02-22', 'Roman Catholic', 'Marilao, Bulacan', 8, 'Loma de Gato, Marilao, Bulacan, Central Luzon', 'Central Luzon', 'Bulacan', 'Marilao', 'Loma de Gato', 'Reynaldo Madrid', 'Businessman', 'N/A', 'Janella Madrid', 'N/A', 'N/A', 'Reynaldo Madrid', 'Businessman', '09120912091', 'enrolled', 'Q503233', 'floterina@gmail.com', 'N/A', '2025-06-22 03:43:05'),
(5, '889912341234', 'Anna', 'Grace', 'Lopez', 'New Student', 'female', 'Grade 1', '', '2019-08-15', 'Catholic', 'San Jose del Monte, Bulacan', 6, 'Tungkong Mangga, SJDM, Bulacan', 'Central Luzon', 'Bulacan', 'SJDM', 'Tungkong Mangga', 'Carlos Lopez', 'Driver', '09178881234', 'Martha Lopez', 'Housewife', '09178883456', 'Carlos Lopez', 'Driver', '09178881234', 'pending', 'Q234562', 'anna.lopez@email.com', 'N/A', '2025-06-16 00:00:00'),
(6, '556677889900', 'Mark', 'Joseph', 'Reyes', 'Old Student', 'male', 'Grade 4', '', '2015-03-10', 'Iglesia ni Cristo', 'Baliwag, Bulacan', 9, 'Poblacion, Baliwag, Bulacan', 'Central Luzon', 'Bulacan', 'Baliwag', 'Poblacion', 'Jose Reyes', 'Technician', '09178881235', 'Luz Reyes', 'Vendor', '09178883457', 'Luz Reyes', 'Vendor', '09178883457', 'enrolled', 'Q789123', 'mark.reyes@email.com', 'N/A', '2025-06-25 01:37:04'),
(7, '112233445566', 'Sophia', 'Mae', 'Santos', 'New Student', 'female', 'Grade 2', '', '2017-11-05', 'Christian', 'Guiguinto, Bulacan', 7, 'Tabang, Guiguinto, Bulacan', 'Central Luzon', 'Bulacan', 'Guiguinto', 'Tabang', 'Mario Santos', 'Mechanic', '09178881236', 'Julia Santos', 'Teacher', '09178883458', 'Mario Santos', 'Mechanic', '09178881236', 'enrolled', 'Q456789', 'sophia.santos@email.com', 'N/A', '2025-06-24 02:49:32'),
(8, '998877665544', 'Daniel', 'Lee', 'Tan', 'Old Student', 'male', 'Grade 6', '', '2013-06-25', 'Buddhist', 'Malolos, Bulacan', 11, 'Tikay, Malolos, Bulacan', 'Central Luzon', 'Bulacan', 'Malolos', 'Tikay', 'Edward Tan', 'Engineer', '09178881237', 'Maria Tan', 'Nurse', '09178883459', 'Maria Tan', 'Nurse', '09178883459', 'enrolled', 'Q678901', 'daniel.tan@email.com', 'N/A', '2025-06-22 03:49:53'),
(9, '334455667788', 'Ella', 'Rose', 'Garcia', 'Old Student', 'female', 'Grade 5', '', '2014-12-01', 'Catholic', 'Plaridel, Bulacan', 10, 'Banga I, Plaridel, Bulacan', 'Central Luzon', 'Bulacan', 'Plaridel', 'Banga I', 'Roberto Garcia', 'Salesman', '09178881238', 'Elena Garcia', 'Housewife', '09178883460', 'Roberto Garcia', 'Salesman', '09178881238', 'pending', 'Q123987', 'ella.garcia@email.com', 'N/A', '2025-06-16 00:20:00'),
(10, '667788990011', 'Lucas', 'Andrei', 'Rivera', 'New Student', 'male', 'Grade 1', '', '2020-01-18', 'Christian', 'Angat, Bulacan', 5, 'Sta. Cruz, Angat, Bulacan', 'Central Luzon', 'Bulacan', 'Angat', 'Sta. Cruz', 'Arturo Rivera', 'Farmer', '09178881239', 'Divina Rivera', 'Housewife', '09178883461', 'Divina Rivera', 'Housewife', '09178883461', 'pending', 'Q990011', 'lucas.rivera@email.com', 'N/A', '2025-06-16 00:25:00'),
(11, '445566778899', 'Chloe', 'Anne', 'Perez', 'Old Student', 'female', 'Grade 2', '', '2016-09-09', 'Catholic', 'Meycauayan, Bulacan', 8, 'Calvario, Meycauayan, Bulacan', 'Central Luzon', 'Bulacan', 'Meycauayan', 'Calvario', 'Jonathan Perez', 'Electrician', '09178881240', 'Melanie Perez', 'Housewife', '09178883462', 'Melanie Perez', 'Housewife', '09178883462', 'enrolled', 'Q112233', 'chloe.perez@email.com', 'N/A', '2025-06-25 01:38:37'),
(12, '221133445599', 'Liam', 'David', 'Cruz', 'New Student', 'male', 'Grade 4', '', '2014-05-12', 'Catholic', 'Malolos, Bulacan', 10, 'San Vicente, Malolos, Bulacan', 'Central Luzon', 'Bulacan', 'Malolos', 'San Vicente', 'Carlos Cruz', 'Driver', '09178881241', 'Emma Cruz', 'Vendor', '09178883463', 'Carlos Cruz', 'Driver', '09178881241', 'pending', 'Q998877', 'liam.cruz@email.com', 'N/A', '2025-06-16 06:31:57'),
(13, '991122334455', 'Isabella', 'Faye', 'Navarro', 'Old Student', 'female', 'Grade 5', '', '2013-03-08', 'Catholic', 'San Rafael, Bulacan', 11, 'Poblacion, San Rafael, Bulacan', 'Central Luzon', 'Bulacan', 'San Rafael', 'Poblacion', 'Dennis Navarro', 'Salesman', '09178881242', 'Clarisse Navarro', 'Clerk', '09178883464', 'Clarisse Navarro', 'Clerk', '09178883464', 'enrolled', 'Q556677', 'isabella.navarro@email.com', 'N/A', '2025-06-25 01:37:50'),
(14, '889977665544', 'Noah', 'Enzo', 'Domingo', 'New Student', 'male', 'Grade 3', '', '2016-11-20', 'INC', 'Balagtas, Bulacan', 8, 'Borol 2nd, Balagtas, Bulacan', 'Central Luzon', 'Bulacan', 'Balagtas', 'Borol 2nd', 'Mario Domingo', 'Technician', '09178881243', 'Ellen Domingo', 'N/A', '09178883465', 'Mario Domingo', 'Technician', '09178881243', 'approved', 'Q443322', 'noah.domingo@email.com', 'N/A', '2025-06-22 04:33:33'),
(15, '778899112233', 'Ava', 'Joy', 'Flores', 'Old Student', 'female', 'Grade 6', '', '2012-08-10', 'Catholic', 'Pulilan, Bulacan', 12, 'Longos, Pulilan, Bulacan', 'Central Luzon', 'Bulacan', 'Pulilan', 'Longos', 'Erwin Flores', 'Driver', '09178881244', 'Linda Flores', 'Teacher', '09178883466', 'Linda Flores', 'Teacher', '09178883466', 'enrolled', 'Q334455', 'ava.flores@email.com', 'N/A', '2025-06-22 03:43:53'),
(16, '998866554433', 'Ethan', 'Kyle', 'De Guzman', 'New Student', 'male', 'Grade 2', '', '2018-04-22', 'Christian', 'Hagonoy, Bulacan', 7, 'San Pedro, Hagonoy, Bulacan', 'Central Luzon', 'Bulacan', 'Hagonoy', 'San Pedro', 'George De Guzman', 'Fisherman', '09178881245', 'Rowena De Guzman', 'Vendor', '09178883467', 'Rowena De Guzman', 'Vendor', '09178883467', 'enrolled', 'Q223344', 'ethan.guzman@email.com', 'N/A', '2025-06-25 01:38:52'),
(17, '223344556677', 'Mia', 'Jade', 'Salazar', 'Old Student', 'female', 'Grade 1', '', '2019-02-17', 'Catholic', 'Obando, Bulacan', 6, 'Pag-asa, Obando, Bulacan', 'Central Luzon', 'Bulacan', 'Obando', 'Pag-asa', 'Francis Salazar', 'Carpenter', '09178881246', 'Juliet Salazar', 'Seamstress', '09178883468', 'Juliet Salazar', 'Seamstress', '09178883468', 'enrolled', 'Q556699', 'mia.salazar@email.com', 'N/A', '2025-06-25 01:38:01'),
(18, '112299887766', 'James', 'Oliver', 'Villanueva', 'Old Student', 'male', 'Grade 7', '', '2011-09-01', 'Catholic', 'Calumpit, Bulacan', 13, 'Pio, Calumpit, Bulacan', 'Central Luzon', 'Bulacan', 'Calumpit', 'Pio', 'Danilo Villanueva', 'Foreman', '09178881247', 'Evelyn Villanueva', 'Housewife', '09178883469', 'Danilo Villanueva', 'Foreman', '09178881247', 'approved', 'Q778866', 'james.villanueva@email.com', 'N/A', '2025-06-22 04:34:10'),
(19, '334466778899', 'Grace', 'Nicole', 'Dimaculangan', 'New Student', 'female', 'Grade 1', '', '2020-05-30', 'Catholic', 'Norzagaray, Bulacan', 5, 'Bigte, Norzagaray, Bulacan', 'Central Luzon', 'Bulacan', 'Norzagaray', 'Bigte', 'Rene Dimaculangan', 'Driver', '09178881248', 'Carla Dimaculangan', 'Vendor', '09178883470', 'Carla Dimaculangan', 'Vendor', '09178883470', 'approved', 'Q667788', 'grace.dima@email.com', 'N/A', '2025-06-25 01:36:51');

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
(7, '2025-06-18', '18:08:01', '18:09:21', 2, 4),
(8, '2025-06-18', '18:10:54', '18:11:15', 2, 12),
(10, '2025-06-18', '18:15:40', '18:16:15', 2, 13),
(11, '2025-06-22', '18:30:10', '18:31:27', 2, 4),
(12, '2025-06-22', '18:30:21', '18:31:13', 2, 12),
(13, '2025-06-22', '18:30:39', '18:30:58', 2, 13);

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
(6, 5, 'Applied 1', 'Research in Daily Life 1', '10:30 AM - 12:00 PM', 'Sarah Labati', '301');

-- --------------------------------------------------------

--
-- Table structure for table `enroll_form`
--

CREATE TABLE `enroll_form` (
  `id` int(11) NOT NULL,
  `lrn` varchar(20) DEFAULT NULL,
  `firstname` varchar(100) DEFAULT NULL,
  `middlename` varchar(100) DEFAULT NULL,
  `lastname` varchar(100) DEFAULT NULL,
  `status` varchar(50) DEFAULT NULL,
  `gender` varchar(10) DEFAULT NULL,
  `grade_level` varchar(20) DEFAULT NULL,
  `profile_picture` varchar(255) DEFAULT NULL,
  `birthday` date DEFAULT NULL,
  `religion` varchar(100) DEFAULT NULL,
  `place_of_birth` varchar(255) DEFAULT NULL,
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
  `admission_status` varchar(50) DEFAULT NULL,
  `que_code` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `facebook` varchar(100) DEFAULT NULL,
  `admission_date` datetime DEFAULT current_timestamp(),
  `payment_plan` varchar(50) DEFAULT NULL,
  `downpayment` double DEFAULT NULL,
  `tuition_fee` double DEFAULT NULL,
  `miscellaneous` double DEFAULT NULL,
  `discount_type` varchar(100) DEFAULT NULL,
  `discount` double DEFAULT NULL,
  `discount_value` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `enroll_form`
--

INSERT INTO `enroll_form` (`id`, `lrn`, `firstname`, `middlename`, `lastname`, `status`, `gender`, `grade_level`, `profile_picture`, `birthday`, `religion`, `place_of_birth`, `age`, `residential_address`, `region`, `province`, `municipal`, `barangay`, `father_name`, `father_occupation`, `father_contact`, `mother_name`, `mother_occupation`, `mother_contact`, `guardian_name`, `guardian_occupation`, `guardian_contact`, `admission_status`, `que_code`, `email`, `facebook`, `admission_date`, `payment_plan`, `downpayment`, `tuition_fee`, `miscellaneous`, `discount_type`, `discount`, `discount_value`) VALUES
(2, '120912091212', 'Juan', 'Dave', 'Dela Cruz', 'Old Student', 'male', 'Grade 3', '', '2017-02-12', 'Roman Catholic', '0', 7, 'Loma de Gato, Marilao, Bulacan, Central Luzon', 'Central Luzon', 'Bulacan', 'Marilao', 'Loma de Gato', 'Michael Alcaraz', 'N/A', 'N/A', 'Rosario Alacaraz', 'N/A', 'N/A', 'Rosario Alacaraz', 'N/A', '09120912091', 'approved', 'Q782454', 'floterina@gmail.com', 'N/A', '2025-06-22 11:15:59', 'Semestral', 2500, 24200.75, 15635.25, '', 0, 0),
(3, '78129878129', 'Mary', 'Madrid', 'Espinosa', 'Old Student', 'male', 'Grade 7', '', '2000-02-22', 'Hindu', '0', 12, 'Bundukan, Bocaue, Bulacan, Central Luzon', 'Central Luzon', 'Bulacan', 'Bocaue', 'Bundukan', 'Reynaldo Madrid', 'Businessman', '09120912091', 'Janella Madrid', 'N/A', 'N/A', 'Reynaldo Madrid', 'Businessman', '09120912091', 'approved', 'Q653061', 'mary@gmail.com', 'N/A', '2025-06-22 11:19:52', 'Semestral', 2500, 29118, 15635.25, '', 0, 0),
(4, '782178217821', 'John', 'Mikers', 'Moore', 'Old Student', 'male', 'Grade 3', '', '2018-02-22', 'Roman Catholic', '0', 8, 'Loma de Gato, Marilao, Bulacan, Central Luzon', 'Central Luzon', 'Bulacan', 'Marilao', 'Loma de Gato', 'Reynaldo Madrid', 'Businessman', 'N/A', 'Janella Madrid', 'N/A', 'N/A', 'Reynaldo Madrid', 'Businessman', '09120912091', 'approved', 'Q503233', 'floterina@gmail.com', 'N/A', '2025-06-22 11:43:05', 'Semestral', 2500, 24200.75, 15635.25, '', 0, 0),
(6, '556677889900', 'Mark', 'Joseph', 'Reyes', 'Old Student', 'male', 'Grade 4', '', '2015-03-10', 'Iglesia ni Cristo', '0', 9, 'Poblacion, Baliwag, Bulacan', 'Central Luzon', 'Bulacan', 'Baliwag', 'Poblacion', 'Jose Reyes', 'Technician', '09178881235', 'Luz Reyes', 'Vendor', '09178883457', 'Luz Reyes', 'Vendor', '09178883457', 'approved', 'Q789123', 'mark.reyes@email.com', 'N/A', '2025-06-25 09:37:04', 'Semestral', 2500, 24752.75, 15635.25, '', 0, 0),
(7, '112233445566', 'Sophia', 'Mae', 'Santos', 'New Student', 'female', 'Grade 2', '', '2017-11-05', 'Christian', '0', 7, 'Tabang, Guiguinto, Bulacan', 'Central Luzon', 'Bulacan', 'Guiguinto', 'Tabang', 'Mario Santos', 'Mechanic', '09178881236', 'Julia Santos', 'Teacher', '09178883458', 'Mario Santos', 'Mechanic', '09178881236', 'approved', 'Q456789', 'sophia.santos@email.com', 'N/A', '2025-06-24 10:49:32', 'Quarterly', 2500, 24200.75, 15635.25, '', 0, 0),
(8, '998877665544', 'Daniel', 'Lee', 'Tan', 'Old Student', 'male', 'Grade 6', '', '2013-06-25', 'Buddhist', '0', 11, 'Tikay, Malolos, Bulacan', 'Central Luzon', 'Bulacan', 'Malolos', 'Tikay', 'Edward Tan', 'Engineer', '09178881237', 'Maria Tan', 'Nurse', '09178883459', 'Maria Tan', 'Nurse', '09178883459', 'approved', 'Q678901', 'daniel.tan@email.com', 'N/A', '2025-06-22 11:49:53', 'Quarterly', 2500, 24752.75, 15635.25, '', 0, 0),
(11, '445566778899', 'Chloe', 'Anne', 'Perez', 'Old Student', 'female', 'Grade 2', '', '2016-09-09', 'Catholic', '0', 8, 'Calvario, Meycauayan, Bulacan', 'Central Luzon', 'Bulacan', 'Meycauayan', 'Calvario', 'Jonathan Perez', 'Electrician', '09178881240', 'Melanie Perez', 'Housewife', '09178883462', 'Melanie Perez', 'Housewife', '09178883462', 'approved', 'Q112233', 'chloe.perez@email.com', 'N/A', '2025-06-25 09:38:37', 'Semestral', 2500, 24200.75, 15635.25, '', 0, 0),
(13, '991122334455', 'Isabella', 'Faye', 'Navarro', 'Old Student', 'female', 'Grade 5', '', '2013-03-08', 'Catholic', '0', 11, 'Poblacion, San Rafael, Bulacan', 'Central Luzon', 'Bulacan', 'San Rafael', 'Poblacion', 'Dennis Navarro', 'Salesman', '09178881242', 'Clarisse Navarro', 'Clerk', '09178883464', 'Clarisse Navarro', 'Clerk', '09178883464', 'approved', 'Q556677', 'isabella.navarro@email.com', 'N/A', '2025-06-25 09:37:50', 'Semestral', 2500, 24752.75, 15635.25, '', 0, 0),
(15, '778899112233', 'Ava', 'Joy', 'Flores', 'Old Student', 'female', 'Grade 6', '', '2012-08-10', 'Catholic', '0', 12, 'Longos, Pulilan, Bulacan', 'Central Luzon', 'Bulacan', 'Pulilan', 'Longos', 'Erwin Flores', 'Driver', '09178881244', 'Linda Flores', 'Teacher', '09178883466', 'Linda Flores', 'Teacher', '09178883466', 'approved', 'Q334455', 'ava.flores@email.com', 'N/A', '2025-06-22 11:43:53', 'Semestral', 2500, 24752.75, 15635.25, '', 0, 0),
(16, '998866554433', 'Ethan', 'Kyle', 'De Guzman', 'New Student', 'male', 'Grade 2', '', '2018-04-22', 'Christian', '0', 7, 'San Pedro, Hagonoy, Bulacan', 'Central Luzon', 'Bulacan', 'Hagonoy', 'San Pedro', 'George De Guzman', 'Fisherman', '09178881245', 'Rowena De Guzman', 'Vendor', '09178883467', 'Rowena De Guzman', 'Vendor', '09178883467', 'approved', 'Q223344', 'ethan.guzman@email.com', 'N/A', '2025-06-25 09:38:52', 'Semestral', 2500, 24200.75, 15635.25, '', 0, 0),
(17, '223344556677', 'Mia', 'Jade', 'Salazar', 'Old Student', 'female', 'Grade 1', '', '2019-02-17', 'Catholic', '0', 6, 'Pag-asa, Obando, Bulacan', 'Central Luzon', 'Bulacan', 'Obando', 'Pag-asa', 'Francis Salazar', 'Carpenter', '09178881246', 'Juliet Salazar', 'Seamstress', '09178883468', 'Juliet Salazar', 'Seamstress', '09178883468', 'approved', 'Q556699', 'mia.salazar@email.com', 'N/A', '2025-06-25 09:38:01', 'Semestral', 2500, 24200.75, 15635.25, '', 0, 0);

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
(18, 5, 'Dave', 'Bergania', 'Male'),
(20, 5, 'Mary', 'Espinosa', 'Female'),
(21, 5, 'Sophia', 'Santos', 'Female');

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE `payment` (
  `id` int(11) NOT NULL,
  `balance` decimal(10,2) NOT NULL,
  `payment_amount` decimal(10,2) NOT NULL,
  `discounts` decimal(10,2) DEFAULT 0.00,
  `payment_type` varchar(50) NOT NULL,
  `proof` varchar(255) DEFAULT NULL,
  `student_id` int(11) NOT NULL,
  `registar_id` int(11) NOT NULL,
  `date` datetime DEFAULT current_timestamp()
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
  `school_year` varchar(20) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sections`
--

INSERT INTO `sections` (`section_id`, `section_name`, `grade_level`, `teacher_id`, `room`, `strand`, `capacity`, `school_year`, `created_at`) VALUES
(5, 'Ametyst', 'Grade 11', 2, '100', 'GAS (General Academic Strand)', 30, '2025-2026', '2025-06-24 10:19:46'),
(7, 'Sapphire', 'Grade 12', 16, '102', 'GAS (General Academic Strand)', 50, '2025-2026', '2025-06-24 11:31:19');

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
(17, 'Spec 4', 'Displine and Ideas in the Social Science', 'Grade 11', 1),
(18, 'Spec 5', 'Philippine Politics and Governance', 'Grade 11', 1),
(20, 'Lang', 'Language', 'Grade 1', 1),
(21, 'RL', 'Read and Literacy', 'Grade 1', 1),
(22, 'Fil', 'Filipino', 'Grade 1', 1),
(23, 'Math', 'Mathematics', 'Grade 1', 1),
(24, 'Scie', 'Science', 'Grade 1', 1),
(25, 'MK', 'Makabansa', 'Grade 1', 1),
(26, 'GMRC', 'Good Manner and Right Conduct', 'Grade 1', 1),
(27, 'MAPEH', 'Music Arts - Physical Education and Health', 'Grade 1', 1),
(28, 'AR', 'Araling Panlipunan', 'Grade 1', 1),
(29, 'EPP', 'Edukasyong Pantahanan at Pangkabuhayan', 'Grade 1', 1);

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
(1, 'Nursery (with books)', 22341.00, 16359.00, 38700.00),
(2, 'Kinder (with books)', 24283.75, 16359.00, 40642.75),
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
(1, 'admin', 'stephani.admin', 'stephani.candado@example.com', '$2y$10$KEek95Y7gfl.7WplR9kPI.jOp2mGx/daQXe4zjOITFv7DkgpHdJX.', 'Stephani', 'Candado', 'female', '1990-03-15', '09170000001', '101 Admin Ave, Cityville', '2025-06-13 16:58:26', '2025-06-16 11:08:44', 'dummy.png', NULL, 0, 'active', NULL, 0),
(2, 'teacher', 'stephany.teacher', 'stephany.gandula@example.com', '$2y$10$KEek95Y7gfl.7WplR9kPI.jOp2mGx/daQXe4zjOITFv7DkgpHdJX.', 'Stephany', 'Gandula', 'female', '1988-06-22', '09170000002', '102 Teacher St, Cityville', '2025-06-13 16:58:26', '2025-06-24 15:46:42', 'user_2_1750571232.jpeg', NULL, 0, 'active', 'Earth and Life Science', 0),
(3, 'parent', 'cj.parent', 'cj.escalora@example.com', '$2y$10$KEek95Y7gfl.7WplR9kPI.jOp2mGx/daQXe4zjOITFv7DkgpHdJX.', 'CJ', 'Escalora', 'male', '1982-11-05', '09170000003', '103 Parent Rd, Cityville', '2025-06-13 16:58:26', '2025-06-16 11:08:49', 'dummy.png', NULL, 0, 'active', NULL, 0),
(4, 'student', 'dave.student', 'dave.bergania@example.com', '$2y$10$KEek95Y7gfl.7WplR9kPI.jOp2mGx/daQXe4zjOITFv7DkgpHdJX.', 'Dave', 'Bergania', 'male', '2008-09-12', '09170000004', '104 Student Blvd, Cityville', '2025-06-13 16:58:26', '2025-06-25 01:42:18', 'user_4_1750571065.jpeg', 1224955173, 0, 'active', NULL, 5),
(9, 'student', 'juan_dela cruz.student', 'floterina@gmail.com', '$2y$10$OzMw33GKYHDce/7lG/JejejRtr0u4uuNd7TMc2dwWavhJLgwBEHoO', 'Juan', 'Dela Cruz', 'male', '2017-02-12', 'N/A', 'Loma de Gato, Marilao, Bulacan, Central Luzon', '2025-06-22 03:15:59', '2025-06-22 03:15:59', 'dummy.png', NULL, 2, 'active', NULL, 0),
(10, 'student', 'mary_espinosa.student', 'mary@gmail.com', '$2y$10$sHr9GU2ss3aao42JdpYBAeC8f3.tHIDS4oI2hY6/4nuBF1ZlvDlPa', 'Mary', 'Espinosa', 'female', '2000-02-22', 'N/A', 'Bundukan, Bocaue, Bulacan, Central Luzon', '2025-06-22 03:19:52', '2025-06-25 01:42:36', 'dummy.png', NULL, 3, 'active', NULL, 5),
(12, 'student', 'ava_flores.student', 'ava.flores@email.com', '$2y$10$Rk9RsPBzi7Tl5W0ipMR9Re/Ym8UzrmHTYhIX22ekpiEAvp3tuGb3i', 'Ava', 'Flores', 'female', '2012-08-10', 'N/A', 'Longos, Pulilan, Bulacan', '2025-06-22 03:43:53', '2025-06-25 01:42:43', 'dummy.png', 1224955174, 15, 'active', NULL, 5),
(13, 'student', 'daniel_tan.student', 'daniel.tan@email.com', '$2y$10$Yt5ZH.lgNtQA57Ys92IM1uUP76aeHWlMmnC0OfvHrvxsgO90sca/q', 'Daniel', 'Tan', 'male', '2013-06-25', 'N/A', 'Tikay, Malolos, Bulacan', '2025-06-22 03:49:53', '2025-06-22 08:07:43', 'dummy.png', 1224955175, 8, 'active', NULL, 0),
(16, 'teacher', 'juan.student', 'juan@gmail.com', '$2y$10$LFUQuDoRXM6N9CIqSDxJBekKb/1iMID/UPBAQlYpLK4GvP/0vLrnm', 'Juan', 'Dela Cruz', 'male', '2000-02-24', '091208129821', 'Marilao, Bulacan', '2025-06-22 06:13:32', '2025-06-24 15:46:51', '../static/uploads/user_68579f0cc7232.jpeg', NULL, 0, 'active', 'Contemporary Philippine Arts from the Filipino Region', 0),
(17, 'student', 'sophia_santos.student', 'sophia.santos@email.com', '$2y$10$651WILFBo3236x48Z2lepejcfMdKf2s.9i/OiWW6qGd3yRBrxjtPS', 'Sophia', 'Santos', 'female', '2017-11-05', 'N/A', 'Tabang, Guiguinto, Bulacan', '2025-06-24 02:49:33', '2025-06-25 01:43:17', 'dummy.png', NULL, 7, 'active', NULL, 5),
(20, 'teacher', 'sarah.teacher', 'sarah@gmail.com', '$2y$10$CZ1LMCUyzSy1JjRf6iIms.q6KO8B7m/O8T9Fb7gizzTG/O6MMAr/2', 'Sarah', 'Labati', 'male', '2000-02-24', '09120912091', 'Marilao, Bulacan', '2025-06-24 13:42:53', '2025-06-24 17:42:53', 'dummy.jpg', NULL, 0, 'active', 'General Mathematics', 0),
(21, 'student', 'isabella_navarro.student', 'isabella.navarro@email.com', '$2y$10$yZ/m1QREMDYg2ZUW/PmHhe4AbtCMNe2.P.bBsdSZVJOzmbZK/KI2i', 'Isabella', 'Navarro', 'female', '2013-03-08', 'N/A', 'Poblacion, San Rafael, Bulacan', '2025-06-25 01:37:50', '2025-06-25 01:43:26', 'dummy.png', NULL, 13, 'active', NULL, 7),
(22, 'student', 'mia_salazar.student', 'mia.salazar@email.com', '$2y$10$vYoAj4ApyumEBqYMxD0OhOijyRIrK6qgVf9xfmt6YomYL6X4nC3Z6', 'Mia', 'Salazar', 'female', '2019-02-17', 'N/A', 'Pag-asa, Obando, Bulacan', '2025-06-25 01:38:01', '2025-06-25 01:43:28', 'dummy.png', NULL, 17, 'active', NULL, 7),
(23, 'student', 'chloe_perez.student', 'chloe.perez@email.com', '$2y$10$YlqqMHKXHEn4R5C21NjHa.SjRIW4WxYLgGIVhQj8mmBskyNnQ75M2', 'Chloe', 'Perez', 'female', '2016-09-09', 'N/A', 'Calvario, Meycauayan, Bulacan', '2025-06-25 01:38:37', '2025-06-25 01:43:30', 'dummy.png', NULL, 11, 'active', NULL, 7),
(24, 'student', 'ethan_de guzman.student', 'ethan.guzman@email.com', '$2y$10$DB0gVJBYB0bI/.4A25sqxO3yCu9CxziD8NZlansOmmuh8n3KNmauy', 'Ethan', 'De Guzman', 'male', '2018-04-22', 'N/A', 'San Pedro, Hagonoy, Bulacan', '2025-06-25 01:38:52', '2025-06-25 01:43:34', 'dummy.png', NULL, 16, 'active', NULL, 7),
(25, 'teacher', 'mac_gilbert.teacher', 'gilbert@gmail.com', '$2y$10$h2s2xF3zTchST47JuAbuVu4A4jGRA1v90k4q9xfRMbkPttXNr8Es2', 'Mac Gilbert', 'Jabat', 'male', '2000-04-24', '09120912091', 'Marilao, Bulacan', '2025-06-25 02:30:51', '2025-06-25 02:30:51', 'dummy.jpg', NULL, 0, 'active', 'Core 4 - Earth and Life Science', NULL),
(26, 'teacher', 'mika.teacher', 'mika@gmail.com', '$2y$10$c2nQwH6VM2mJszrOnNw5LuVLB1ACRLQ.LdK/KojmayF6PAzkNwbgK', 'Mika', 'Salamanca', 'female', '2000-03-25', '09876778677', 'Sta. Maria, Bulacan', '2025-06-25 02:31:49', '2025-06-25 02:31:49', 'dummy.jpg', NULL, 0, 'active', 'Core 8 - Understanding Culture, Society, and Politics', NULL),
(27, 'teacher', 'alexander.teacher', 'alexander@gmail.com', '$2y$10$o1iK.pL4kQbIILTKF9vo4usGUCDV74EJ1RgFqMR8L0ZhVA3G6cfPO', 'Alexander', 'Dele Cruz', 'male', '2000-09-21', '09126512651', 'Meycuayan, Bulacan', '2025-06-25 02:33:07', '2025-06-25 02:33:07', 'dummy.jpg', NULL, 0, 'active', 'Applied 1 - Research in Daily Life 1', NULL);

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
-- Indexes for table `enroll_form`
--
ALTER TABLE `enroll_form`
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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `attendance`
--
ALTER TABLE `attendance`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `class_schedule`
--
ALTER TABLE `class_schedule`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `master_list`
--
ALTER TABLE `master_list`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `payment`
--
ALTER TABLE `payment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sections`
--
ALTER TABLE `sections`
  MODIFY `section_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `subjects`
--
ALTER TABLE `subjects`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `tuition_fees`
--
ALTER TABLE `tuition_fees`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

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