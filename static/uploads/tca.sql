-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jun 14, 2025 at 02:39 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

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
  `status` enum('new','old') NOT NULL,
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
  `city` varchar(100) DEFAULT NULL,
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
  `admission_status` enum('for_verification','approved') DEFAULT 'for_verification'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admission_form`
--

INSERT INTO `admission_form` (`id`, `lrn`, `firstname`, `middlename`, `lastname`, `status`, `gender`, `grade_level`, `profile_picture`, `birthday`, `religion`, `place_of_birth`, `age`, `residential_address`, `region`, `province`, `city`, `barangay`, `father_name`, `father_occupation`, `father_contact`, `mother_name`, `mother_occupation`, `mother_contact`, `guardian_name`, `guardian_occupation`, `guardian_contact`, `admission_status`) VALUES
(1, '100000000011', 'Leo', 'G.', 'Fernandez', 'new', 'male', 'Grade 7', 'uploads/leo.jpg', '2012-08-20', 'Catholic', 'Makati', 13, '56 Buendia Street', 'NCR', 'Metro Manila', 'Makati', 'Barangay San Antonio', 'Roberto Fernandez', 'Technician', '09171230011', 'Grace Fernandez', 'Office Clerk', '09181230011', 'Mario Fernandez', 'Freelancer', '09191230011', 'for_verification'),
(2, '100000000012', 'Isabella', 'M.', 'Torralba', 'old', 'female', 'Grade 10', 'uploads/isabella.jpg', '2009-11-05', 'Christian', 'Quezon City', 15, '789 Mindanao Ave', 'NCR', 'Metro Manila', 'Quezon City', 'Barangay Bahay Toro', 'Martin Torralba', 'Driver', '09171230012', 'Sandra Torralba', 'Cook', '09181230012', 'Rica Torralba', 'Teacher', '09191230012', 'approved'),
(3, '100000000013', 'Enzo', 'L.', 'Manalo', 'new', 'male', 'Grade 8', 'uploads/enzo.jpg', '2011-01-17', 'Roman Catholic', 'Manila', 13, '32 España Blvd', 'NCR', 'Metro Manila', 'Manila', 'Barangay Sampaloc', 'Eric Manalo', 'Barber', '09171230013', 'Rowena Manalo', 'Laundry Worker', '09181230013', 'Liza Manalo', 'Housekeeper', '09191230013', 'approved'),
(4, '100000000014', 'Chloe', 'T.', 'Navarro', 'old', 'female', 'Grade 9', 'uploads/chloe.jpg', '2010-03-12', 'Christian', 'Pasig', 14, '123 C. Raymundo Ave', 'NCR', 'Metro Manila', 'Pasig', 'Barangay Rosario', 'Dennis Navarro', 'Security Guard', '09171230014', 'Tricia Navarro', 'Call Center Agent', '09181230014', 'May Navarro', 'Nurse', '09191230014', 'for_verification'),
(5, '100000000015', 'Nathan', 'B.', 'Garcia', 'new', 'male', 'Grade 7', 'uploads/nathan.jpg', '2012-09-25', 'Born Again', 'Caloocan', 12, '100 Gen. Tinio Street', 'NCR', 'Metro Manila', 'Caloocan', 'Barangay 176', 'Alfred Garcia', 'Mechanic', '09171230015', 'Gina Garcia', 'Seamstress', '09181230015', 'Tito Garcia', 'Teacher', '09191230015', 'for_verification'),
(6, '100000000016', 'Hannah', 'D.', 'Diaz', 'old', 'female', 'Grade 11', 'uploads/hannah.jpg', '2008-04-19', 'Catholic', 'Taguig', 16, '76 McKinley Road', 'NCR', 'Metro Manila', 'Taguig', 'Barangay Pinagsama', 'Francis Diaz', 'Plumber', '09171230016', 'Lorna Diaz', 'Nanny', '09181230016', 'Paula Diaz', 'Technician', '09191230016', 'approved'),
(7, '100000000017', 'Jared', 'S.', 'Delgado', 'new', 'male', 'Grade 8', 'uploads/jared.jpg', '2011-06-30', 'Christian', 'Mandaluyong', 13, '15 Shaw Blvd', 'NCR', 'Metro Manila', 'Mandaluyong', 'Barangay Highway Hills', 'Victor Delgado', 'Welder', '09171230017', 'Mira Delgado', 'Grocery Clerk', '09181230017', 'Rona Delgado', 'Nurse', '09191230017', 'for_verification'),
(8, '100000000018', 'Camille', 'V.', 'Agustin', 'old', 'female', 'Grade 12', 'uploads/camille.jpg', '2007-08-03', 'Catholic', 'Pasay', 17, '60 Tramo Street', 'NCR', 'Metro Manila', 'Pasay', 'Barangay 33', 'Mario Agustin', 'Painter', '09171230018', 'Fely Agustin', 'Market Vendor', '09181230018', 'Celeste Agustin', 'Cashier', '09191230018', 'approved'),
(9, '100000000019', 'Zachary', 'N.', 'Bautista', 'new', 'male', 'Grade 7', 'uploads/zachary.jpg', '2012-10-22', 'Catholic', 'Makati', 12, '88 Kalayaan Avenue', 'NCR', 'Metro Manila', 'Makati', 'Barangay Pio Del Pilar', 'Ronald Bautista', 'Driver', '09171230019', 'Vivian Bautista', 'Dishwasher', '09181230019', 'Maricel Bautista', 'Cashier', '09191230019', 'for_verification'),
(10, '100000000020', 'Bea', 'O.', 'Salazar', 'old', 'female', 'Grade 10', 'uploads/bea.jpg', '2009-12-11', 'Iglesia ni Cristo', 'Quezon City', 15, '199 Commonwealth Ave', 'NCR', 'Metro Manila', 'Quezon City', 'Barangay Holy Spirit', 'Julius Salazar', 'Warehouseman', '09171230020', 'Elaine Salazar', 'Clerk', '09181230020', 'Ruby Salazar', 'Supervisor', '09191230020', 'approved');

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
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `acc_type`, `username`, `email`, `password`, `first_name`, `last_name`, `gender`, `birthdate`, `phone_number`, `address`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'stephani.admin', 'stephani.candado@example.com', '$2y$10$KEek95Y7gfl.7WplR9kPI.jOp2mGx/daQXe4zjOITFv7DkgpHdJX.', 'Stephani', 'Candado', 'female', '1990-03-15', '09170000001', '101 Admin Ave, Cityville', '2025-06-13 16:58:26', '2025-06-13 16:58:26'),
(2, 'teacher', 'stephany.teacher', 'stephany.gandula@example.com', '$2y$10$KEek95Y7gfl.7WplR9kPI.jOp2mGx/daQXe4zjOITFv7DkgpHdJX.', 'Stephany', 'Gandula', 'female', '1988-06-22', '09170000002', '102 Teacher St, Cityville', '2025-06-13 16:58:26', '2025-06-13 16:58:26'),
(3, 'parent', 'cj.parent', 'cj.escalora@example.com', '$2y$10$KEek95Y7gfl.7WplR9kPI.jOp2mGx/daQXe4zjOITFv7DkgpHdJX.', 'CJ', 'Escalora', 'male', '1982-11-05', '09170000003', '103 Parent Rd, Cityville', '2025-06-13 16:58:26', '2025-06-13 16:58:26'),
(4, 'student', 'dave.student', 'dave.bergania@example.com', '$2y$10$KEek95Y7gfl.7WplR9kPI.jOp2mGx/daQXe4zjOITFv7DkgpHdJX.', 'Dave', 'Bergania', 'male', '2008-09-12', '09170000004', '104 Student Blvd, Cityville', '2025-06-13 16:58:26', '2025-06-13 16:58:26');

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
