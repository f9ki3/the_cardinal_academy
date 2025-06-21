-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jun 21, 2025 at 04:28 AM
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
(2, '120912091212', 'Juan', 'Dave', 'Dela Cruz', 'Old Student', 'male', 'Grade 3', '', '2017-02-12', 'Roman Catholic', 'Marilao, Bulacan', 7, 'Loma de Gato, Marilao, Bulacan, Central Luzon', 'Central Luzon', 'Bulacan', 'Marilao', 'Loma de Gato', 'Michael Alcaraz', 'N/A', 'N/A', 'Rosario Alacaraz', 'N/A', 'N/A', 'Rosario Alacaraz', 'N/A', '09120912091', 'for_review', 'Q782454', 'floterina@gmail.com', 'N/A', '2025-06-15 22:07:19'),
(3, '78129878129', 'Mary', 'Madrid', 'Espinosa', 'Old Student', 'male', 'Grade 7', '', '2000-02-22', 'Hindu', 'Bocaue, Bulacan', 12, 'Bundukan, Bocaue, Bulacan, Central Luzon', 'Central Luzon', 'Bulacan', 'Bocaue', 'Bundukan', 'Reynaldo Madrid', 'Businessman', '09120912091', 'Janella Madrid', 'N/A', 'N/A', 'Reynaldo Madrid', 'Businessman', '09120912091', 'approved', 'Q653061', 'mary@gmail.com', 'N/A', '2025-06-21 01:08:08'),
(4, '782178217821', 'John', 'Mikers', 'Moore', 'Old Student', 'male', 'Grade 3', '', '2018-02-22', 'Roman Catholic', 'Marilao, Bulacan', 8, 'Loma de Gato, Marilao, Bulacan, Central Luzon', 'Central Luzon', 'Bulacan', 'Marilao', 'Loma de Gato', 'Reynaldo Madrid', 'Businessman', 'N/A', 'Janella Madrid', 'N/A', 'N/A', 'Reynaldo Madrid', 'Businessman', '09120912091', 'approved', 'Q503233', 'floterina@gmail.com', 'N/A', '2025-06-15 22:15:00'),
(5, '889912341234', 'Anna', 'Grace', 'Lopez', 'New Student', 'female', 'Grade 1', '', '2019-08-15', 'Catholic', 'San Jose del Monte, Bulacan', 6, 'Tungkong Mangga, SJDM, Bulacan', 'Central Luzon', 'Bulacan', 'SJDM', 'Tungkong Mangga', 'Carlos Lopez', 'Driver', '09178881234', 'Martha Lopez', 'Housewife', '09178883456', 'Carlos Lopez', 'Driver', '09178881234', 'pending', 'Q234562', 'anna.lopez@email.com', 'N/A', '2025-06-16 00:00:00'),
(6, '556677889900', 'Mark', 'Joseph', 'Reyes', 'Old Student', 'male', 'Grade 4', '', '2015-03-10', 'Iglesia ni Cristo', 'Baliwag, Bulacan', 9, 'Poblacion, Baliwag, Bulacan', 'Central Luzon', 'Bulacan', 'Baliwag', 'Poblacion', 'Jose Reyes', 'Technician', '09178881235', 'Luz Reyes', 'Vendor', '09178883457', 'Luz Reyes', 'Vendor', '09178883457', 'approved', 'Q789123', 'mark.reyes@email.com', 'N/A', '2025-06-17 17:02:02'),
(7, '112233445566', 'Sophia', 'Mae', 'Santos', 'New Student', 'female', 'Grade 2', '', '2017-11-05', 'Christian', 'Guiguinto, Bulacan', 7, 'Tabang, Guiguinto, Bulacan', 'Central Luzon', 'Bulacan', 'Guiguinto', 'Tabang', 'Mario Santos', 'Mechanic', '09178881236', 'Julia Santos', 'Teacher', '09178883458', 'Mario Santos', 'Mechanic', '09178881236', 'for_review', 'Q456789', 'sophia.santos@email.com', 'N/A', '2025-06-16 00:10:00'),
(8, '998877665544', 'Daniel', 'Lee', 'Tan', 'Old Student', 'male', 'Grade 6', '', '2013-06-25', 'Buddhist', 'Malolos, Bulacan', 11, 'Tikay, Malolos, Bulacan', 'Central Luzon', 'Bulacan', 'Malolos', 'Tikay', 'Edward Tan', 'Engineer', '09178881237', 'Maria Tan', 'Nurse', '09178883459', 'Maria Tan', 'Nurse', '09178883459', 'approved', 'Q678901', 'daniel.tan@email.com', 'N/A', '2025-06-16 00:15:00'),
(9, '334455667788', 'Ella', 'Rose', 'Garcia', 'Old Student', 'female', 'Grade 5', '', '2014-12-01', 'Catholic', 'Plaridel, Bulacan', 10, 'Banga I, Plaridel, Bulacan', 'Central Luzon', 'Bulacan', 'Plaridel', 'Banga I', 'Roberto Garcia', 'Salesman', '09178881238', 'Elena Garcia', 'Housewife', '09178883460', 'Roberto Garcia', 'Salesman', '09178881238', 'pending', 'Q123987', 'ella.garcia@email.com', 'N/A', '2025-06-16 00:20:00'),
(10, '667788990011', 'Lucas', 'Andrei', 'Rivera', 'New Student', 'male', 'Grade 1', '', '2020-01-18', 'Christian', 'Angat, Bulacan', 5, 'Sta. Cruz, Angat, Bulacan', 'Central Luzon', 'Bulacan', 'Angat', 'Sta. Cruz', 'Arturo Rivera', 'Farmer', '09178881239', 'Divina Rivera', 'Housewife', '09178883461', 'Divina Rivera', 'Housewife', '09178883461', 'pending', 'Q990011', 'lucas.rivera@email.com', 'N/A', '2025-06-16 00:25:00'),
(11, '445566778899', 'Chloe', 'Anne', 'Perez', 'Old Student', 'female', 'Grade 2', '', '2016-09-09', 'Catholic', 'Meycauayan, Bulacan', 8, 'Calvario, Meycauayan, Bulacan', 'Central Luzon', 'Bulacan', 'Meycauayan', 'Calvario', 'Jonathan Perez', 'Electrician', '09178881240', 'Melanie Perez', 'Housewife', '09178883462', 'Melanie Perez', 'Housewife', '09178883462', 'pending', 'Q112233', 'chloe.perez@email.com', 'N/A', '2025-06-16 00:30:00'),
(12, '221133445599', 'Liam', 'David', 'Cruz', 'New Student', 'male', 'Grade 4', '', '2014-05-12', 'Catholic', 'Malolos, Bulacan', 10, 'San Vicente, Malolos, Bulacan', 'Central Luzon', 'Bulacan', 'Malolos', 'San Vicente', 'Carlos Cruz', 'Driver', '09178881241', 'Emma Cruz', 'Vendor', '09178883463', 'Carlos Cruz', 'Driver', '09178881241', 'pending', 'Q998877', 'liam.cruz@email.com', 'N/A', '2025-06-16 06:31:57'),
(13, '991122334455', 'Isabella', 'Faye', 'Navarro', 'Old Student', 'female', 'Grade 5', '', '2013-03-08', 'Catholic', 'San Rafael, Bulacan', 11, 'Poblacion, San Rafael, Bulacan', 'Central Luzon', 'Bulacan', 'San Rafael', 'Poblacion', 'Dennis Navarro', 'Salesman', '09178881242', 'Clarisse Navarro', 'Clerk', '09178883464', 'Clarisse Navarro', 'Clerk', '09178883464', 'pending', 'Q556677', 'isabella.navarro@email.com', 'N/A', '2025-06-16 06:32:00'),
(14, '889977665544', 'Noah', 'Enzo', 'Domingo', 'New Student', 'male', 'Grade 3', '', '2016-11-20', 'INC', 'Balagtas, Bulacan', 8, 'Borol 2nd, Balagtas, Bulacan', 'Central Luzon', 'Bulacan', 'Balagtas', 'Borol 2nd', 'Mario Domingo', 'Technician', '09178881243', 'Ellen Domingo', 'N/A', '09178883465', 'Mario Domingo', 'Technician', '09178881243', 'pending', 'Q443322', 'noah.domingo@email.com', 'N/A', '2025-06-16 06:32:04'),
(15, '778899112233', 'Ava', 'Joy', 'Flores', 'Old Student', 'female', 'Grade 6', '', '2012-08-10', 'Catholic', 'Pulilan, Bulacan', 12, 'Longos, Pulilan, Bulacan', 'Central Luzon', 'Bulacan', 'Pulilan', 'Longos', 'Erwin Flores', 'Driver', '09178881244', 'Linda Flores', 'Teacher', '09178883466', 'Linda Flores', 'Teacher', '09178883466', 'pending', 'Q334455', 'ava.flores@email.com', 'N/A', '2025-06-16 06:32:07'),
(16, '998866554433', 'Ethan', 'Kyle', 'De Guzman', 'New Student', 'male', 'Grade 2', '', '2018-04-22', 'Christian', 'Hagonoy, Bulacan', 7, 'San Pedro, Hagonoy, Bulacan', 'Central Luzon', 'Bulacan', 'Hagonoy', 'San Pedro', 'George De Guzman', 'Fisherman', '09178881245', 'Rowena De Guzman', 'Vendor', '09178883467', 'Rowena De Guzman', 'Vendor', '09178883467', 'pending', 'Q223344', 'ethan.guzman@email.com', 'N/A', '2025-06-16 00:55:00'),
(17, '223344556677', 'Mia', 'Jade', 'Salazar', 'Old Student', 'female', 'Grade 1', '', '2019-02-17', 'Catholic', 'Obando, Bulacan', 6, 'Pag-asa, Obando, Bulacan', 'Central Luzon', 'Bulacan', 'Obando', 'Pag-asa', 'Francis Salazar', 'Carpenter', '09178881246', 'Juliet Salazar', 'Seamstress', '09178883468', 'Juliet Salazar', 'Seamstress', '09178883468', 'pending', 'Q556699', 'mia.salazar@email.com', 'N/A', '2025-06-16 01:00:00'),
(18, '112299887766', 'James', 'Oliver', 'Villanueva', 'Old Student', 'male', 'Grade 7', '', '2011-09-01', 'Catholic', 'Calumpit, Bulacan', 13, 'Pio, Calumpit, Bulacan', 'Central Luzon', 'Bulacan', 'Calumpit', 'Pio', 'Danilo Villanueva', 'Foreman', '09178881247', 'Evelyn Villanueva', 'Housewife', '09178883469', 'Danilo Villanueva', 'Foreman', '09178881247', 'pending', 'Q778866', 'james.villanueva@email.com', 'N/A', '2025-06-16 06:32:11'),
(19, '334466778899', 'Grace', 'Nicole', 'Dimaculangan', 'New Student', 'female', 'Grade 1', '', '2020-05-30', 'Catholic', 'Norzagaray, Bulacan', 5, 'Bigte, Norzagaray, Bulacan', 'Central Luzon', 'Bulacan', 'Norzagaray', 'Bigte', 'Rene Dimaculangan', 'Driver', '09178881248', 'Carla Dimaculangan', 'Vendor', '09178883470', 'Carla Dimaculangan', 'Vendor', '09178883470', 'approved', 'Q667788', 'grace.dima@email.com', 'N/A', '2025-06-21 01:19:19');

-- --------------------------------------------------------

--
-- Table structure for table `enroll`
--

CREATE TABLE `enroll` (
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
  `admission_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `payment_plan` varchar(100) DEFAULT NULL,
  `downpayment` decimal(10,2) DEFAULT 0.00,
  `tuition_fee` decimal(10,2) DEFAULT 0.00,
  `miscellaneous` decimal(10,2) DEFAULT 0.00
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `Sections`
--

CREATE TABLE `Sections` (
  `id` int(11) NOT NULL,
  `section_name` varchar(100) NOT NULL,
  `grade_level` varchar(50) NOT NULL,
  `adviser` varchar(100) DEFAULT NULL,
  `capacity` int(11) DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `Teachers`
--

CREATE TABLE `Teachers` (
  `id` int(11) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
  `profile` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `acc_type`, `username`, `email`, `password`, `first_name`, `last_name`, `gender`, `birthdate`, `phone_number`, `address`, `created_at`, `updated_at`, `profile`) VALUES
(1, 'admin', 'stephani.admin', 'stephani.candado@example.com', '$2y$10$KEek95Y7gfl.7WplR9kPI.jOp2mGx/daQXe4zjOITFv7DkgpHdJX.', 'Stephani', 'Candado', 'female', '1990-03-15', '09170000001', '101 Admin Ave, Cityville', '2025-06-13 16:58:26', '2025-06-16 11:08:44', 'dummy.png'),
(2, 'teacher', 'stephany.teacher', 'stephany.gandula@example.com', '$2y$10$KEek95Y7gfl.7WplR9kPI.jOp2mGx/daQXe4zjOITFv7DkgpHdJX.', 'Stephany', 'Gandula', 'female', '1988-06-22', '09170000002', '102 Teacher St, Cityville', '2025-06-13 16:58:26', '2025-06-16 11:08:47', 'dummy.png'),
(3, 'parent', 'cj.parent', 'cj.escalora@example.com', '$2y$10$KEek95Y7gfl.7WplR9kPI.jOp2mGx/daQXe4zjOITFv7DkgpHdJX.', 'CJ', 'Escalora', 'male', '1982-11-05', '09170000003', '103 Parent Rd, Cityville', '2025-06-13 16:58:26', '2025-06-16 11:08:49', 'dummy.png'),
(4, 'student', 'dave.student', 'dave.bergania@example.com', '$2y$10$KEek95Y7gfl.7WplR9kPI.jOp2mGx/daQXe4zjOITFv7DkgpHdJX.', 'Dave', 'Bergania', 'male', '2008-09-12', '09170000004', '104 Student Blvd, Cityville', '2025-06-13 16:58:26', '2025-06-16 11:08:51', 'dummy.png');

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
-- Indexes for table `Sections`
--
ALTER TABLE `Sections`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `Teachers`
--
ALTER TABLE `Teachers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

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
-- AUTO_INCREMENT for table `Sections`
--
ALTER TABLE `Sections`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `Teachers`
--
ALTER TABLE `Teachers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tuition_fees`
--
ALTER TABLE `tuition_fees`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
