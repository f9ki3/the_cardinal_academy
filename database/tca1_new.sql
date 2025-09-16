-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Sep 16, 2025 at 02:08 PM
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
(131, '20250001', 'Juan', 'Santos', 'Dela Cruz', 'New Student', 'male', 'Grade 11', NULL, '2008-03-15', 'Catholic', 'Marilao, Bulacan', 17, 'Blk 1 Lot 2 Marilao', 'Region III', 'Bulacan', 'Marilao', 'Abangan Norte', 'Pedro Dela Cruz', 'Driver', '09171234567', 'Maria Dela Cruz', 'Vendor', '09182345678', 'Jose Dela Cruz', 'Farmer', '09183456789', 'pending', 'Q837492', '09191234567', 'juan.dc@example.com', 'fb.com/juan.dc', '2025-09-06 03:57:20', 'STEM', 0, 0, 0, 0, 0),
(132, '20250002', 'Maria', 'Lopez', 'Santos', 'New Student', 'female', 'Grade 12', NULL, '2007-06-20', 'Iglesia ni Cristo', 'Meycauayan, Bulacan', 18, 'Phase 2 Meycauayan', 'Region III', 'Bulacan', 'Meycauayan', 'Bahay Pare', 'Rogelio Santos', 'Engineer', '09271234567', 'Lucia Santos', 'Teacher', '09282345678', 'Ana Santos', 'Nurse', '09283456789', 'pending', 'Q594203', '09291234567', 'maria.santos@example.com', 'fb.com/maria.santos', '2025-09-06 03:57:20', 'ABM', 0, 0, 0, 0, 0),
(133, '20250003', 'Jose', 'Reyes', 'Cruz', 'New Student', 'male', 'Grade 11', NULL, '2008-01-10', 'Catholic', 'Marilao, Bulacan', 17, 'Sitio Marilao Proper', 'Region III', 'Bulacan', 'Marilao', 'Ibayo', 'Carlos Cruz', 'Carpenter', '09371234567', 'Elena Cruz', 'Housewife', '09382345678', 'Manuel Cruz', 'Security Guard', '09383456789', 'pending', 'Q102948', '09391234567', 'jose.cruz@example.com', 'fb.com/jose.cruz', '2025-09-06 03:57:20', 'HUMSS', 0, 0, 0, 0, 0),
(134, '20250004', 'Ana', 'Garcia', 'Lopez', 'New Student', 'female', 'Grade 12', NULL, '2007-09-05', 'Catholic', 'Meycauayan, Bulacan', 18, 'Meycauayan Bayan', 'Region III', 'Bulacan', 'Meycauayan', 'Camalig', 'Julio Lopez', 'Driver', '09471234567', 'Teresa Lopez', 'Clerk', '09482345678', 'Mario Lopez', 'Technician', '09483456789', 'pending', 'Q675421', '09491234567', 'ana.lopez@example.com', 'fb.com/ana.lopez', '2025-09-06 03:57:20', 'TVL-ICT', 0, 0, 0, 0, 0),
(135, '20250005', 'Mark', 'Villanueva', 'Ramos', 'New Student', 'male', 'Grade 11', NULL, '2008-02-12', 'Born Again', 'Marilao, Bulacan', 17, 'St. Michael St. Marilao', 'Region III', 'Bulacan', 'Marilao', 'Patubig', 'Nestor Ramos', 'Plumber', '09571234567', 'Alicia Ramos', 'Vendor', '09582345678', 'Leo Ramos', 'Farmer', '09583456789', 'pending', 'Q498562', '09591234567', 'mark.ramos@example.com', 'fb.com/mark.ramos', '2025-09-06 03:57:20', 'STEM', 0, 0, 0, 0, 0),
(136, '20250006', 'Sofia', 'Martinez', 'Reyes', 'New Student', 'female', 'Grade 11', NULL, '2008-04-25', 'Catholic', 'Meycauayan, Bulacan', 17, 'Blk 8 Meycauayan Heights', 'Region III', 'Bulacan', 'Meycauayan', 'Saluysoy', 'Armando Reyes', 'Electrician', '09671234567', 'Dolores Reyes', 'Nurse', '09682345678', 'Celia Reyes', 'Teacher', '09683456789', 'pending', 'Q853920', '09691234567', 'sofia.reyes@example.com', 'fb.com/sofia.reyes', '2025-09-06 03:57:20', 'ABM', 0, 0, 0, 0, 0),
(137, '20250007', 'Paolo', 'Cruz', 'Mendoza', 'New Student', 'male', 'Grade 12', NULL, '2007-07-30', 'Catholic', 'Marilao, Bulacan', 18, 'Phase 4 Marilao Heights', 'Region III', 'Bulacan', 'Marilao', 'Prenza', 'Ernesto Mendoza', 'Mechanic', '09771234567', 'Luz Mendoza', 'Vendor', '09782345678', 'Jaime Mendoza', 'Farmer', '09783456789', 'pending', 'Q139482', '09791234567', 'paolo.mendoza@example.com', 'fb.com/paolo.mendoza', '2025-09-06 03:57:20', 'GAS', 0, 0, 0, 0, 0),
(138, '20250008', 'Ella', 'Torres', 'Navarro', 'New Student', 'female', 'Grade 11', NULL, '2008-11-18', 'Catholic', 'Meycauayan, Bulacan', 16, 'Blk 10 Meycauayan West', 'Region III', 'Bulacan', 'Meycauayan', 'Pantoc', 'Ricardo Navarro', 'Driver', '09871234567', 'Clara Navarro', 'Nurse', '09882345678', 'Rosa Navarro', 'Vendor', '09883456789', 'pending', 'Q742095', '09891234567', 'ella.navarro@example.com', 'fb.com/ella.navarro', '2025-09-06 03:57:20', 'HUMSS', 0, 0, 0, 0, 0),
(139, '20250009', 'Daniel', 'Flores', 'Gutierrez', 'New Student', 'male', 'Grade 12', NULL, '2007-05-22', 'Catholic', 'Marilao, Bulacan', 18, 'Sitio Gutierrez Marilao', 'Region III', 'Bulacan', 'Marilao', 'Saog', 'Eduardo Gutierrez', 'Technician', '09971234567', 'Rosa Gutierrez', 'Vendor', '09982345678', 'Mario Gutierrez', 'Farmer', '09983456789', 'pending', 'Q529381', '09991234567', 'daniel.gutierrez@example.com', 'fb.com/daniel.gutierrez', '2025-09-06 03:57:20', 'TVL-HE', 0, 0, 0, 0, 0),
(140, '20250010', 'Lea', 'Aquino', 'Castro', 'New Student', 'female', 'Grade 11', NULL, '2008-08-14', 'Iglesia ni Cristo', 'Meycauayan, Bulacan', 17, 'Purok 5 Meycauayan', 'Region III', 'Bulacan', 'Meycauayan', 'Pajo', 'Felipe Castro', 'Engineer', '09101234567', 'Lourdes Castro', 'Nurse', '09102345678', 'Cesar Castro', 'Technician', '09103456789', 'pending', 'Q604817', '09104567890', 'lea.castro@example.com', 'fb.com/lea.castro', '2025-09-06 03:57:20', 'STEM', 0, 0, 0, 0, 0),
(151, '202509060101', 'Miguel', 'Santos', 'Reyes', 'New Student', 'male', 'Grade 2', NULL, '2016-02-15', 'Catholic', 'Marilao, Bulacan', 9, 'Blk 3 Lot 12 Marilao', 'Region III', 'Bulacan', 'Marilao', 'Abangan Norte', 'Carlos Reyes', 'Driver', '09171230001', 'Elena Reyes', 'Vendor', '09181230001', 'Jose Reyes', 'Technician', '09191230001', 'pending', 'Q482391', '09161230001', 'miguel.reyes@example.com', 'fb.com/miguel.reyes', '2025-09-06 03:57:20', '', 0, 0, 0, 0, 0),
(152, '202509060102', 'Isabella', 'Lopez', 'Cruz', 'New Student', 'female', 'Grade 2', NULL, '2016-04-20', 'Iglesia ni Cristo', 'Meycauayan, Bulacan', 9, 'Phase 1 Meycauayan', 'Region III', 'Bulacan', 'Meycauayan', 'Bahay Pare', 'Rogelio Cruz', 'Engineer', '09171230002', 'Lucia Cruz', 'Teacher', '09181230002', 'Ana Cruz', 'Nurse', '09191230002', 'pending', 'Q573820', '09161230002', 'isabella.cruz@example.com', 'fb.com/isabella.cruz', '2025-09-06 03:57:20', '', 0, 0, 0, 0, 0),
(153, '202509060103', 'Joshua', 'Villanueva', 'Garcia', 'New Student', 'male', 'Grade 2', NULL, '2016-05-10', 'Catholic', 'Marilao, Bulacan', 9, 'Sitio Proper Marilao', 'Region III', 'Bulacan', 'Marilao', 'Ibayo', 'Nestor Garcia', 'Plumber', '09171230003', 'Alicia Garcia', 'Vendor', '09181230003', 'Leo Garcia', 'Farmer', '09191230003', 'pending', 'Q928374', '09161230003', 'joshua.garcia@example.com', 'fb.com/joshua.garcia', '2025-09-06 03:57:20', '', 0, 0, 0, 0, 0),
(154, '202509060104', 'Sophia', 'Martinez', 'Lopez', 'New Student', 'female', 'Grade 2', NULL, '2016-07-25', 'Catholic', 'Meycauayan, Bulacan', 8, 'Meycauayan Bayan', 'Region III', 'Bulacan', 'Meycauayan', 'Camalig', 'Julio Lopez', 'Driver', '09171230004', 'Teresa Lopez', 'Clerk', '09181230004', 'Mario Lopez', 'Technician', '09191230004', 'pending', 'Q374829', '09161230004', 'sophia.lopez@example.com', 'fb.com/sophia.lopez', '2025-09-06 03:57:20', '', 0, 0, 0, 0, 0),
(155, '202509060105', 'Adrian', 'Flores', 'Mendoza', 'New Student', 'male', 'Grade 2', NULL, '2016-08-18', 'Born Again', 'Marilao, Bulacan', 8, 'St. Michael St. Marilao', 'Region III', 'Bulacan', 'Marilao', 'Patubig', 'Ernesto Mendoza', 'Mechanic', '09171230005', 'Luz Mendoza', 'Vendor', '09181230005', 'Jaime Mendoza', 'Farmer', '09191230005', 'pending', 'Q647283', '09161230005', 'adrian.mendoza@example.com', 'fb.com/adrian.mendoza', '2025-09-06 03:57:20', '', 0, 0, 0, 0, 0),
(156, '202509060106', 'Camille', 'Torres', 'Ramos', 'New Student', 'female', 'Grade 2', NULL, '2016-09-02', 'Catholic', 'Meycauayan, Bulacan', 8, 'Blk 8 Meycauayan Heights', 'Region III', 'Bulacan', 'Meycauayan', 'Saluysoy', 'Armando Ramos', 'Electrician', '09171230006', 'Dolores Ramos', 'Nurse', '09181230006', 'Celia Ramos', 'Teacher', '09191230006', 'pending', 'Q582930', '09161230006', 'camille.ramos@example.com', 'fb.com/camille.ramos', '2025-09-06 03:57:20', '', 0, 0, 0, 0, 0),
(157, '202509060107', 'Nathan', 'Reyes', 'Gutierrez', 'New Student', 'male', 'Grade 2', NULL, '2016-10-11', 'Catholic', 'Marilao, Bulacan', 8, 'Phase 4 Marilao Heights', 'Region III', 'Bulacan', 'Marilao', 'Prenza', 'Eduardo Gutierrez', 'Technician', '09171230007', 'Rosa Gutierrez', 'Vendor', '09181230007', 'Mario Gutierrez', 'Farmer', '09191230007', 'pending', 'Q920384', '09161230007', 'nathan.gutierrez@example.com', 'fb.com/nathan.gutierrez', '2025-09-06 03:57:20', '', 0, 0, 0, 0, 0),
(158, '202509060108', 'Chloe', 'Aquino', 'Castro', 'New Student', 'female', 'Grade 2', NULL, '2016-11-09', 'Iglesia ni Cristo', 'Meycauayan, Bulacan', 8, 'Blk 10 Meycauayan West', 'Region III', 'Bulacan', 'Meycauayan', 'Pantoc', 'Felipe Castro', 'Engineer', '09171230008', 'Lourdes Castro', 'Nurse', '09181230008', 'Cesar Castro', 'Technician', '09191230008', 'pending', 'Q183746', '09161230008', 'chloe.castro@example.com', 'fb.com/chloe.castro', '2025-09-06 03:57:20', '', 0, 0, 0, 0, 0),
(159, '202509060109', 'Samuel', 'Gutierrez', 'Villanueva', 'New Student', 'male', 'Grade 2', NULL, '2016-12-22', 'Catholic', 'Marilao, Bulacan', 8, 'Sitio Proper Gutierrez', 'Region III', 'Bulacan', 'Marilao', 'Saog', 'Ricardo Villanueva', 'Technician', '09171230009', 'Clara Villanueva', 'Vendor', '09181230009', 'Rosa Villanueva', 'Vendor', '09191230009', 'pending', 'Q746281', '09161230009', 'samuel.villanueva@example.com', 'fb.com/samuel.villanueva', '2025-09-06 03:57:20', '', 0, 0, 0, 0, 0),
(160, '202509060110', 'Hannah', 'Dela Cruz', 'Navarro', 'New Student', 'female', 'Grade 2', NULL, '2016-03-30', 'Catholic', 'Meycauayan, Bulacan', 9, 'Purok 5 Meycauayan', 'Region III', 'Bulacan', 'Meycauayan', 'Pajo', 'Pedro Navarro', 'Driver', '09171230010', 'Maria Navarro', 'Nurse', '09181230010', 'Jose Navarro', 'Farmer', '09191230010', 'pending', 'Q564738', '09161230010', 'hannah.navarro@example.com', 'fb.com/hannah.navarro', '2025-09-06 03:57:20', '', 0, 0, 0, 0, 0),
(161, '202509060301', 'Miguel', 'Lopez', 'Cruz', 'New Student', 'male', 'Grade 3', NULL, '2015-05-12', 'Catholic', 'Marilao, Bulacan', 9, 'Blk 2 Lot 7 Marilao', 'Region III', 'Bulacan', 'Marilao', 'Ibayo', 'Rogelio Cruz', 'Mechanic', '0917012345', 'Ana Cruz', 'Teacher', '0917023456', 'Mario Cruz', 'Farmer', '0917034567', 'pending', 'Q928374', '0917045678', 'miguel.cruz@example.com', 'fb.com/miguel.cruz', '2025-09-06 03:57:20', '', 0, 0, 0, 0, 0),
(162, '202509060302', 'Andrea', 'Gomez', 'Reyes', 'New Student', 'female', 'Grade 3', NULL, '2015-08-20', 'Catholic', 'Meycauayan, Bulacan', 9, 'Blk 15 Lot 3 Meycauayan', 'Region III', 'Bulacan', 'Meycauayan', 'Pajo', 'Roberto Reyes', 'Driver', '0917056789', 'Liza Reyes', 'Vendor', '0917067890', 'Jose Reyes', 'Carpenter', '0917078901', 'pending', 'Q734829', '0917089012', 'andrea.reyes@example.com', 'fb.com/andrea.reyes', '2025-09-06 03:57:20', '', 0, 0, 0, 0, 0),
(163, '202509060303', 'Carlo', 'Diaz', 'Torres', 'New Student', 'male', 'Grade 3', NULL, '2015-01-18', 'Iglesia ni Cristo', 'Marilao, Bulacan', 9, 'Blk 22 Lot 9 Marilao', 'Region III', 'Bulacan', 'Marilao', 'Prenza', 'Danilo Torres', 'Technician', '0917090123', 'Maria Torres', 'Nurse', '0917101234', 'Emilio Torres', 'Clerk', '0917112345', 'pending', 'Q183746', '0917123456', 'carlo.torres@example.com', 'fb.com/carlo.torres', '2025-09-06 03:57:20', '', 0, 0, 0, 0, 0),
(164, '202509060304', 'Isabella', 'Ramos', 'Fernandez', 'New Student', 'female', 'Grade 3', NULL, '2015-03-14', 'Catholic', 'Meycauayan, Bulacan', 9, 'Blk 5 Lot 11 Meycauayan', 'Region III', 'Bulacan', 'Meycauayan', 'Camalig', 'Ramon Fernandez', 'Salesman', '0917134567', 'Elena Fernandez', 'Housewife', '0917145678', 'Victor Fernandez', 'Farmer', '0917156789', 'pending', 'Q657483', '0917167890', 'isabella.fernandez@example.com', 'fb.com/isabella.fernandez', '2025-09-06 03:57:20', '', 0, 0, 0, 0, 0),
(165, '202509060305', 'Joshua', 'Castro', 'Mendoza', 'New Student', 'male', 'Grade 3', NULL, '2015-09-25', 'Born Again', 'Marilao, Bulacan', 9, 'Blk 17 Lot 6 Marilao', 'Region III', 'Bulacan', 'Marilao', 'Lias', 'Eduardo Mendoza', 'Engineer', '0917178901', 'Grace Mendoza', 'Teacher', '0917189012', 'Josefina Mendoza', 'Nurse', '0917190123', 'pending', 'Q293847', '0917201234', 'joshua.mendoza@example.com', 'fb.com/joshua.mendoza', '2025-09-06 03:57:20', '', 0, 0, 0, 0, 0),
(166, '202509060306', 'Sofia', 'Villanueva', 'Garcia', 'New Student', 'female', 'Grade 3', NULL, '2015-06-09', 'Catholic', 'Meycauayan, Bulacan', 9, 'Blk 4 Lot 2 Meycauayan', 'Region III', 'Bulacan', 'Meycauayan', 'Bahay Pare', 'Fernando Garcia', 'Carpenter', '0917212345', 'Teresa Garcia', 'Vendor', '0917223456', 'Antonio Garcia', 'Driver', '0917234567', 'pending', 'Q847362', '0917245678', 'sofia.garcia@example.com', 'fb.com/sofia.garcia', '2025-09-06 03:57:20', '', 0, 0, 0, 0, 0),
(167, '202509060307', 'Nathan', 'Flores', 'Dela Cruz', 'New Student', 'male', 'Grade 3', NULL, '2015-04-30', 'INC', 'Marilao, Bulacan', 9, 'Blk 13 Lot 10 Marilao', 'Region III', 'Bulacan', 'Marilao', 'Abangan', 'Alfredo Dela Cruz', 'Technician', '0917256789', 'Cynthia Dela Cruz', 'Teacher', '0917267890', 'Ricardo Dela Cruz', 'Salesman', '0917278901', 'pending', 'Q394857', '0917289012', 'nathan.delacruz@example.com', 'fb.com/nathan.delacruz', '2025-09-06 03:57:20', '', 0, 0, 0, 0, 0),
(168, '202509060308', 'Elena', 'Gonzales', 'Santos', 'New Student', 'female', 'Grade 3', NULL, '2015-02-10', 'Catholic', 'Meycauayan, Bulacan', 9, 'Blk 10 Lot 12 Meycauayan', 'Region III', 'Bulacan', 'Meycauayan', 'Poblacion', 'Benjamin Santos', 'Mechanic', '0917290123', 'Rosa Santos', 'Nurse', '0917301234', 'Pedro Santos', 'Vendor', '0917312345', 'pending', 'Q574839', '0917323456', 'elena.santos@example.com', 'fb.com/elena.santos', '2025-09-06 03:57:20', '', 0, 0, 0, 0, 0),
(169, '202509060309', 'David', 'Santiago', 'Aquino', 'New Student', 'male', 'Grade 3', NULL, '2015-11-03', 'Catholic', 'Marilao, Bulacan', 9, 'Blk 21 Lot 8 Marilao', 'Region III', 'Bulacan', 'Marilao', 'Patubig', 'Oscar Aquino', 'Driver', '0917334567', 'Lourdes Aquino', 'Vendor', '0917345678', 'Romeo Aquino', 'Teacher', '0917356789', 'pending', 'Q847193', '0917367890', 'david.aquino@example.com', 'fb.com/david.aquino', '2025-09-06 03:57:20', '', 0, 0, 0, 0, 0),
(170, '202509060310', 'Camille', 'Morales', 'Lopez', 'New Student', 'female', 'Grade 3', NULL, '2015-12-15', 'Catholic', 'Meycauayan, Bulacan', 9, 'Blk 9 Lot 15 Meycauayan', 'Region III', 'Bulacan', 'Meycauayan', 'Bagbaguin', 'Gilbert Lopez', 'Engineer', '0917378901', 'Claudia Lopez', 'Teacher', '0917389012', 'Andres Lopez', 'Farmer', '0917390123', 'pending', 'Q918374', '0917401234', 'camille.lopez@example.com', 'fb.com/camille.lopez', '2025-09-06 03:57:20', '', 0, 0, 0, 0, 0),
(171, '202509060111', 'Liam', 'Cruz', 'Santos', 'New Student', 'male', 'Grade 1', NULL, '2017-06-22', 'Catholic', 'Marilao, Bulacan', 7, 'Blk 12 Lot 3 Marilao', 'Region III', 'Bulacan', 'Marilao', 'Ibayo', 'Victor Santos', 'Driver', '0917412345', 'Mila Santos', 'Vendor', '0917423456', 'Pablo Santos', 'Carpenter', '0917434567', 'pending', 'Q623947', '0917445678', 'liam.santos@example.com', 'fb.com/liam.santos', '2025-09-06 03:57:20', '', 0, 0, 0, 0, 0),
(172, '202509060112', 'Sophia', 'Lopez', 'Garcia', 'New Student', 'female', 'Grade 1', NULL, '2017-09-10', 'Catholic', 'Meycauayan, Bulacan', 7, 'Blk 7 Lot 5 Meycauayan', 'Region III', 'Bulacan', 'Meycauayan', 'Poblacion', 'Mario Garcia', 'Engineer', '0917456789', 'Angela Garcia', 'Nurse', '0917467890', 'Roberto Garcia', 'Farmer', '0917478901', 'pending', 'Q284739', '0917489012', 'sophia.garcia@example.com', 'fb.com/sophia.garcia', '2025-09-06 03:57:20', '', 0, 0, 0, 0, 0),
(173, '202509060113', 'Ethan', 'Reyes', 'Mendoza', 'New Student', 'male', 'Grade 1', NULL, '2017-03-05', 'Catholic', 'Marilao, Bulacan', 7, 'Blk 18 Lot 6 Marilao', 'Region III', 'Bulacan', 'Marilao', 'Prenza', 'Carlos Mendoza', 'Driver', '0917490123', 'Jocelyn Mendoza', 'Teacher', '0917501234', 'Francisco Mendoza', 'Mechanic', '0917512345', 'pending', 'Q918273', '0917523456', 'ethan.mendoza@example.com', 'fb.com/ethan.mendoza', '2025-09-06 03:57:20', '', 0, 0, 0, 0, 0),
(174, '202509060114', 'Chloe', 'Diaz', 'Torres', 'New Student', 'female', 'Grade 1', NULL, '2017-12-19', 'INC', 'Meycauayan, Bulacan', 7, 'Blk 16 Lot 8 Meycauayan', 'Region III', 'Bulacan', 'Meycauayan', 'Camalig', 'Ramon Torres', 'Technician', '0917534567', 'Liza Torres', 'Housewife', '0917545678', 'Manuel Torres', 'Vendor', '0917556789', 'pending', 'Q374829', '0917567890', 'chloe.torres@example.com', 'fb.com/chloe.torres', '2025-09-06 03:57:20', '', 0, 0, 0, 0, 0),
(175, '202509060115', 'Daniel', 'Morales', 'Cruz', 'New Student', 'male', 'Grade 1', NULL, '2017-07-25', 'Catholic', 'Marilao, Bulacan', 7, 'Blk 19 Lot 2 Marilao', 'Region III', 'Bulacan', 'Marilao', 'Poblacion II', 'Jose Cruz', 'Salesman', '0917578901', 'Cecilia Cruz', 'Vendor', '0917589012', 'Miguel Cruz', 'Carpenter', '0917590123', 'pending', 'Q657482', '0917601234', 'daniel.cruz@example.com', 'fb.com/daniel.cruz', '2025-09-06 03:57:20', '', 0, 0, 0, 0, 0),
(176, '202509060116', 'Isabelle', 'Fernandez', 'Aquino', 'New Student', 'female', 'Grade 1', NULL, '2017-01-14', 'Born Again', 'Meycauayan, Bulacan', 7, 'Blk 4 Lot 9 Meycauayan', 'Region III', 'Bulacan', 'Meycauayan', 'Bagbaguin', 'Eduardo Aquino', 'Driver', '0917612345', 'Gloria Aquino', 'Nurse', '0917623456', 'Fernando Aquino', 'Farmer', '0917634567', 'pending', 'Q847362', '0917645678', 'isabelle.aquino@example.com', 'fb.com/isabelle.aquino', '2025-09-06 03:57:20', '', 0, 0, 0, 0, 0),
(177, '202509060117', 'Noah', 'Villanueva', 'Ramos', 'New Student', 'male', 'Grade 1', NULL, '2017-05-30', 'Catholic', 'Marilao, Bulacan', 7, 'Blk 21 Lot 11 Marilao', 'Region III', 'Bulacan', 'Marilao', 'Ibayo', 'Renato Ramos', 'Engineer', '0917656789', 'Elena Ramos', 'Teacher', '0917667890', 'Oscar Ramos', 'Vendor', '0917678901', 'pending', 'Q293847', '0917689012', 'noah.ramos@example.com', 'fb.com/noah.ramos', '2025-09-06 03:57:20', '', 0, 0, 0, 0, 0),
(178, '202509060118', 'Alexa', 'Flores', 'Villanueva', 'New Student', 'female', 'Grade 1', NULL, '2017-11-02', 'INC', 'Meycauayan, Bulacan', 7, 'Blk 9 Lot 13 Meycauayan', 'Region III', 'Bulacan', 'Meycauayan', 'Pajo', 'Mario Villanueva', 'Technician', '0917690123', 'Cristina Villanueva', 'Vendor', '0917701234', 'Alfredo Villanueva', 'Driver', '0917712345', 'pending', 'Q384756', '0917723456', 'alexa.villanueva@example.com', 'fb.com/alexa.villanueva', '2025-09-06 03:57:20', '', 0, 0, 0, 0, 0),
(179, '202509060119', 'Lucas', 'Gomez', 'Morales', 'New Student', 'male', 'Grade 1', NULL, '2017-04-07', 'Catholic', 'Marilao, Bulacan', 7, 'Blk 22 Lot 4 Marilao', 'Region III', 'Bulacan', 'Marilao', 'Lias', 'Pedro Morales', 'Carpenter', '0917734567', 'Josefina Morales', 'Housewife', '0917745678', 'Antonio Morales', 'Vendor', '0917756789', 'pending', 'Q918374', '0917767890', 'lucas.morales@example.com', 'fb.com/lucas.morales', '2025-09-06 03:57:20', '', 0, 0, 0, 0, 0),
(180, '202509060120', 'Hannah', 'Santiago', 'Reyes', 'New Student', 'female', 'Grade 1', NULL, '2017-10-28', 'Catholic', 'Meycauayan, Bulacan', 7, 'Blk 11 Lot 7 Meycauayan', 'Region III', 'Bulacan', 'Meycauayan', 'Camalig', 'Rogelio Reyes', 'Mechanic', '0917778901', 'Amelia Reyes', 'Nurse', '0917789012', 'Carlos Reyes', 'Vendor', '0917790123', 'pending', 'Q564738', '0917801234', 'hannah.reyes@example.com', 'fb.com/hannah.reyes', '2025-09-06 03:57:20', '', 0, 0, 0, 0, 0),
(181, '202509060401', 'Julian', 'Santos', 'Ramirez', 'New Student', 'male', 'Grade 4', NULL, '2014-05-18', 'Catholic', 'Marilao, Bulacan', 10, 'Blk 5 Lot 8 Marilao', 'Region III', 'Bulacan', 'Marilao', 'Poblacion I', 'Manuel Ramirez', 'Driver', '0917812345', 'Cristina Ramirez', 'Vendor', '0917823456', 'Eduardo Ramirez', 'Mechanic', '0917834567', 'pending', 'Q726493', '0917845678', 'julian.ramirez@example.com', 'fb.com/julian.ramirez', '2025-09-06 03:57:20', '', 0, 0, 0, 0, 0),
(182, '202509060402', 'Samantha', 'Reyes', 'Torres', 'New Student', 'female', 'Grade 4', NULL, '2014-08-02', 'Catholic', 'Meycauayan, Bulacan', 10, 'Blk 22 Lot 3 Meycauayan', 'Region III', 'Bulacan', 'Meycauayan', 'Camalig', 'Roberto Torres', 'Engineer', '0917856789', 'Marites Torres', 'Teacher', '0917867890', 'Rogelio Torres', 'Farmer', '0917878901', 'pending', 'Q918374', '0917889012', 'samantha.torres@example.com', 'fb.com/samantha.torres', '2025-09-06 03:57:20', '', 0, 0, 0, 0, 0),
(183, '202509060403', 'Adrian', 'Lopez', 'Cruz', 'New Student', 'male', 'Grade 4', NULL, '2014-01-20', 'INC', 'Marilao, Bulacan', 10, 'Blk 12 Lot 14 Marilao', 'Region III', 'Bulacan', 'Marilao', 'Prenza II', 'Antonio Cruz', 'Technician', '0917890123', 'Lorena Cruz', 'Vendor', '0917901234', 'Miguel Cruz', 'Driver', '0917912345', 'pending', 'Q384726', '0917923456', 'adrian.cruz@example.com', 'fb.com/adrian.cruz', '2025-09-06 03:57:20', '', 0, 0, 0, 0, 0),
(184, '202509060404', 'Bianca', 'Flores', 'Santos', 'New Student', 'female', 'Grade 4', NULL, '2014-03-14', 'Catholic', 'Meycauayan, Bulacan', 10, 'Blk 8 Lot 9 Meycauayan', 'Region III', 'Bulacan', 'Meycauayan', 'Bagbaguin', 'Pedro Santos', 'Carpenter', '0917934567', 'Maria Santos', 'Nurse', '0917945678', 'Ramon Santos', 'Farmer', '0917956789', 'pending', 'Q657482', '0917967890', 'bianca.santos@example.com', 'fb.com/bianca.santos', '2025-09-06 03:57:20', '', 0, 0, 0, 0, 0),
(185, '202509060405', 'Lucas', 'Villanueva', 'Fernandez', 'New Student', 'male', 'Grade 4', NULL, '2014-06-09', 'Catholic', 'Marilao, Bulacan', 10, 'Blk 17 Lot 2 Marilao', 'Region III', 'Bulacan', 'Marilao', 'Abangan', 'Oscar Fernandez', 'Mechanic', '0917978901', 'Celia Fernandez', 'Teacher', '0917989012', 'Andres Fernandez', 'Vendor', '0917990123', 'pending', 'Q283947', '0918001234', 'lucas.fernandez@example.com', 'fb.com/lucas.fernandez', '2025-09-06 03:57:20', '', 0, 0, 0, 0, 0),
(186, '202509060406', 'Alexa', 'Morales', 'Aquino', 'New Student', 'female', 'Grade 4', NULL, '2014-11-22', 'Born Again', 'Meycauayan, Bulacan', 10, 'Blk 10 Lot 6 Meycauayan', 'Region III', 'Bulacan', 'Meycauayan', 'Poblacion', 'Ramon Aquino', 'Engineer', '0918012345', 'Carla Aquino', 'Housewife', '0918023456', 'Manuel Aquino', 'Driver', '0918034567', 'pending', 'Q918273', '0918045678', 'alexa.aquino@example.com', 'fb.com/alexa.aquino', '2025-09-06 03:57:20', '', 0, 0, 0, 0, 0),
(187, '202509060407', 'Nathan', 'Garcia', 'Mendoza', 'New Student', 'male', 'Grade 4', NULL, '2014-07-01', 'Catholic', 'Marilao, Bulacan', 10, 'Blk 6 Lot 12 Marilao', 'Region III', 'Bulacan', 'Marilao', 'Lias', 'Armando Mendoza', 'Technician', '0918056789', 'Diana Mendoza', 'Vendor', '0918067890', 'Jose Mendoza', 'Carpenter', '0918078901', 'pending', 'Q726481', '0918089012', 'nathan.mendoza@example.com', 'fb.com/nathan.mendoza', '2025-09-06 03:57:20', '', 0, 0, 0, 0, 0),
(188, '202509060408', 'Sophia', 'Santiago', 'Gomez', 'New Student', 'female', 'Grade 4', NULL, '2014-10-15', 'INC', 'Meycauayan, Bulacan', 10, 'Blk 4 Lot 11 Meycauayan', 'Region III', 'Bulacan', 'Meycauayan', 'Camalig', 'Renato Gomez', 'Driver', '0918090123', 'Gloria Gomez', 'Vendor', '0918101234', 'Roberto Gomez', 'Farmer', '0918112345', 'pending', 'Q394857', '0918123456', 'sophia.gomez@example.com', 'fb.com/sophia.gomez', '2025-09-06 03:57:20', '', 0, 0, 0, 0, 0),
(189, '202509060409', 'Gabriel', 'Diaz', 'Lopez', 'New Student', 'male', 'Grade 4', NULL, '2014-02-26', 'Catholic', 'Marilao, Bulacan', 10, 'Blk 13 Lot 3 Marilao', 'Region III', 'Bulacan', 'Marilao', 'Ibayo', 'Mario Lopez', 'Salesman', '0918134567', 'Elena Lopez', 'Teacher', '0918145678', 'Antonio Lopez', 'Mechanic', '0918156789', 'pending', 'Q574839', '0918167890', 'gabriel.lopez@example.com', 'fb.com/gabriel.lopez', '2025-09-06 03:57:20', '', 0, 0, 0, 0, 0),
(190, '202509060410', 'Hannah', 'Cruz', 'Reyes', 'New Student', 'female', 'Grade 4', NULL, '2014-12-05', 'Catholic', 'Meycauayan, Bulacan', 10, 'Blk 15 Lot 5 Meycauayan', 'Region III', 'Bulacan', 'Meycauayan', 'Poblacion II', 'Rogelio Reyes', 'Engineer', '0918178901', 'Carmela Reyes', 'Nurse', '0918189012', 'Ricardo Reyes', 'Vendor', '0918190123', 'pending', 'Q918374', '0918201234', 'hannah.reyes@example.com', 'fb.com/hannah.reyes', '2025-09-06 03:57:20', '', 0, 0, 0, 0, 0),
(191, '202509060501', 'Diego', 'Santos', 'Villanueva', 'New Student', 'male', 'Grade 5', NULL, '2013-07-14', 'Catholic', 'Marilao, Bulacan', 11, 'Blk 2 Lot 9 Marilao', 'Region III', 'Bulacan', 'Marilao', 'Prenza I', 'Fernando Villanueva', 'Driver', '0918212345', 'Cynthia Villanueva', 'Vendor', '0918223456', 'Oscar Villanueva', 'Mechanic', '0918234567', 'pending', 'Q726482', '0918245678', 'diego.villanueva@example.com', 'fb.com/diego.villanueva', '2025-09-06 03:57:20', '', 0, 0, 0, 0, 0),
(192, '202509060502', 'Clarisse', 'Reyes', 'Morales', 'New Student', 'female', 'Grade 5', NULL, '2013-11-09', 'INC', 'Meycauayan, Bulacan', 11, 'Blk 7 Lot 14 Meycauayan', 'Region III', 'Bulacan', 'Meycauayan', 'Bagbaguin', 'Pedro Morales', 'Engineer', '0918256789', 'Rosalinda Morales', 'Housewife', '0918267890', 'Danilo Morales', 'Carpenter', '0918278901', 'pending', 'Q283947', '0918289012', 'clarisse.morales@example.com', 'fb.com/clarisse.morales', '2025-09-06 03:57:20', '', 0, 0, 0, 0, 0),
(193, '202509060503', 'Martin', 'Lopez', 'Cruz', 'New Student', 'male', 'Grade 5', NULL, '2013-03-17', 'Catholic', 'Marilao, Bulacan', 11, 'Blk 18 Lot 6 Marilao', 'Region III', 'Bulacan', 'Marilao', 'Ibayo', 'Antonio Cruz', 'Technician', '0918290123', 'Maricel Cruz', 'Vendor', '0918301234', 'Miguel Cruz', 'Driver', '0918312345', 'pending', 'Q918273', '0918323456', 'martin.cruz@example.com', 'fb.com/martin.cruz', '2025-09-06 03:57:20', '', 0, 0, 0, 0, 0),
(194, '202509060504', 'Angela', 'Santos', 'Fernandez', 'New Student', 'female', 'Grade 5', NULL, '2013-05-30', 'Catholic', 'Meycauayan, Bulacan', 11, 'Blk 21 Lot 8 Meycauayan', 'Region III', 'Bulacan', 'Meycauayan', 'Camalig', 'Oscar Fernandez', 'Engineer', '0918334567', 'Lourdes Fernandez', 'Nurse', '0918345678', 'Roberto Fernandez', 'Vendor', '0918356789', 'pending', 'Q657483', '0918367890', 'angela.fernandez@example.com', 'fb.com/angela.fernandez', '2025-09-06 03:57:20', '', 0, 0, 0, 0, 0),
(195, '202509060505', 'Patrick', 'Villanueva', 'Garcia', 'New Student', 'male', 'Grade 5', NULL, '2013-09-28', 'Born Again', 'Marilao, Bulacan', 11, 'Blk 5 Lot 10 Marilao', 'Region III', 'Bulacan', 'Marilao', 'Lias', 'Ramon Garcia', 'Driver', '0918378901', 'Claudia Garcia', 'Teacher', '0918389012', 'Jose Garcia', 'Mechanic', '0918390123', 'pending', 'Q394857', '0918401234', 'patrick.garcia@example.com', 'fb.com/patrick.garcia', '2025-09-06 03:57:20', '', 0, 0, 0, 0, 0),
(196, '202509060506', 'Elaine', 'Gomez', 'Aquino', 'New Student', 'female', 'Grade 5', NULL, '2013-02-04', 'Catholic', 'Meycauayan, Bulacan', 11, 'Blk 14 Lot 3 Meycauayan', 'Region III', 'Bulacan', 'Meycauayan', 'Poblacion I', 'Eduardo Aquino', 'Technician', '0918412345', 'Celia Aquino', 'Vendor', '0918423456', 'Miguel Aquino', 'Driver', '0918434567', 'pending', 'Q574839', '0918445678', 'elaine.aquino@example.com', 'fb.com/elaine.aquino', '2025-09-06 03:57:20', '', 0, 0, 0, 0, 0),
(197, '202509060507', 'Francis', 'Diaz', 'Reyes', 'New Student', 'male', 'Grade 5', NULL, '2013-06-16', 'INC', 'Marilao, Bulacan', 11, 'Blk 16 Lot 12 Marilao', 'Region III', 'Bulacan', 'Marilao', 'Abangan', 'Mario Reyes', 'Salesman', '0918456789', 'Teresa Reyes', 'Teacher', '0918467890', 'Alberto Reyes', 'Vendor', '0918478901', 'pending', 'Q726481', '0918489012', 'francis.reyes@example.com', 'fb.com/francis.reyes', '2025-09-06 03:57:20', '', 0, 0, 0, 0, 0),
(198, '202509060508', 'Kyla', 'Flores', 'Santiago', 'New Student', 'female', 'Grade 5', NULL, '2013-10-11', 'Catholic', 'Meycauayan, Bulacan', 11, 'Blk 19 Lot 5 Meycauayan', 'Region III', 'Bulacan', 'Meycauayan', 'Bagbaguin', 'Jose Santiago', 'Mechanic', '0918490123', 'Amelia Santiago', 'Nurse', '0918501234', 'Victor Santiago', 'Farmer', '0918512345', 'pending', 'Q283947', '0918523456', 'kyla.santiago@example.com', 'fb.com/kyla.santiago', '2025-09-06 03:57:20', '', 0, 0, 0, 0, 0),
(199, '202509060509', 'Xavier', 'Santos', 'Lopez', 'New Student', 'male', 'Grade 5', NULL, '2013-01-25', 'Catholic', 'Marilao, Bulacan', 11, 'Blk 11 Lot 2 Marilao', 'Region III', 'Bulacan', 'Marilao', 'Prenza III', 'Rogelio Lopez', 'Driver', '0918534567', 'Amelia Lopez', 'Vendor', '0918545678', 'Pedro Lopez', 'Mechanic', '0918556789', 'pending', 'Q918374', '0918567890', 'xavier.lopez@example.com', 'fb.com/xavier.lopez', '2025-09-06 03:57:20', '', 0, 0, 0, 0, 0),
(200, '202509060510', 'Patricia', 'Ramos', 'Diaz', 'New Student', 'female', 'Grade 5', NULL, '2013-12-07', 'Born Again', 'Meycauayan, Bulacan', 11, 'Blk 8 Lot 7 Meycauayan', 'Region III', 'Bulacan', 'Meycauayan', 'Camalig', 'Oscar Diaz', 'Engineer', '0918578901', 'Gloria Diaz', 'Teacher', '0918589012', 'Manuel Diaz', 'Vendor', '0918590123', 'pending', 'Q847362', '0918601234', 'patricia.diaz@example.com', 'fb.com/patricia.diaz', '2025-09-06 03:57:20', '', 0, 0, 0, 0, 0),
(201, '124589637451', 'Miguel', 'Santos', 'Reyes', 'New Student', 'male', 'Grade 6', NULL, '2013-02-14', 'Catholic', 'Marilao, Bulacan', 12, 'Blk 5 Lot 8 Marilao', 'Region III', 'Bulacan', 'Marilao', 'Abangan Norte', 'Ramon Reyes', 'Driver', '09171112222', 'Lucia Reyes', 'Vendor', '09172223333', 'Jose Reyes', 'Technician', '09173334444', 'pending', 'Q781234', '09174445555', 'miguel.reyes@example.com', 'fb.com/miguel.reyes', '2025-09-06 03:57:20', NULL, 0, 0, 0, 0, 0),
(202, '845961237458', 'Angela', 'Lopez', 'Cruz', 'New Student', 'female', 'Grade 6', NULL, '2013-05-20', 'Catholic', 'Meycauayan, Bulacan', 12, 'Phase 3 Meycauayan', 'Region III', 'Bulacan', 'Meycauayan', 'Bahay Pare', 'Mario Cruz', 'Engineer', '09271112222', 'Teresita Cruz', 'Teacher', '09272223333', 'Pedro Cruz', 'Farmer', '09273334444', 'pending', 'Q459871', '09274445555', 'angela.cruz@example.com', 'fb.com/angela.cruz', '2025-09-06 03:57:20', NULL, 0, 0, 0, 0, 0),
(203, '784596321459', 'Joshua', 'Garcia', 'Mendoza', 'New Student', 'male', 'Grade 6', NULL, '2013-09-11', 'Born Again', 'Marilao, Bulacan', 12, 'St. Michael St.', 'Region III', 'Bulacan', 'Marilao', 'Patubig', 'Nestor Mendoza', 'Plumber', '09371112222', 'Alicia Mendoza', 'Vendor', '09372223333', 'Leo Mendoza', 'Farmer', '09373334444', 'pending', 'Q129384', '09374445555', 'joshua.mendoza@example.com', 'fb.com/joshua.mendoza', '2025-09-06 03:57:20', NULL, 0, 0, 0, 0, 0),
(204, '963254178459', 'Samantha', 'Villanueva', 'Ramos', 'New Student', 'female', 'Grade 6', NULL, '2013-12-25', 'Catholic', 'Meycauayan, Bulacan', 11, 'Meycauayan Heights', 'Region III', 'Bulacan', 'Meycauayan', 'Camalig', 'Armando Ramos', 'Clerk', '09471112222', 'Dolores Ramos', 'Nurse', '09472223333', 'Celia Ramos', 'Teacher', '09473334444', 'pending', 'Q983421', '09474445555', 'samantha.ramos@example.com', 'fb.com/samantha.ramos', '2025-09-06 03:57:20', NULL, 0, 0, 0, 0, 0),
(205, '745896321457', 'Nathan', 'Martinez', 'Cruz', 'New Student', 'male', 'Grade 6', NULL, '2013-06-03', 'Iglesia ni Cristo', 'Marilao, Bulacan', 12, 'Sitio Proper Marilao', 'Region III', 'Bulacan', 'Marilao', 'Ibayo', 'Carlos Cruz', 'Carpenter', '09571112222', 'Elena Cruz', 'Housewife', '09572223333', 'Manuel Cruz', 'Security Guard', '09573334444', 'pending', 'Q648392', '09574445555', 'nathan.cruz@example.com', 'fb.com/nathan.cruz', '2025-09-06 03:57:20', NULL, 0, 0, 0, 0, 0),
(206, '125896374589', 'Isabella', 'Flores', 'Gutierrez', 'New Student', 'female', 'Grade 6', NULL, '2013-10-19', 'Catholic', 'Meycauayan, Bulacan', 11, 'Meycauayan Bayan', 'Region III', 'Bulacan', 'Meycauayan', 'Saluysoy', 'Julio Gutierrez', 'Driver', '09671112222', 'Teresa Gutierrez', 'Vendor', '09672223333', 'Mario Gutierrez', 'Technician', '09673334444', 'pending', 'Q238971', '09674445555', 'isabella.gutierrez@example.com', 'fb.com/isabella.gutierrez', '2025-09-06 03:57:20', NULL, 0, 0, 0, 0, 0),
(207, '895642317854', 'Diego', 'Torres', 'Navarro', 'New Student', 'male', 'Grade 6', NULL, '2013-03-28', 'Catholic', 'Marilao, Bulacan', 12, 'Phase 4 Marilao Heights', 'Region III', 'Bulacan', 'Marilao', 'Prenza', 'Ernesto Navarro', 'Mechanic', '09771112222', 'Luz Navarro', 'Vendor', '09772223333', 'Jaime Navarro', 'Farmer', '09773334444', 'pending', 'Q472910', '09774445555', 'diego.navarro@example.com', 'fb.com/diego.navarro', '2025-09-06 03:57:20', NULL, 0, 0, 0, 0, 0),
(208, '326547189654', 'Camille', 'Aquino', 'Castro', 'New Student', 'female', 'Grade 6', NULL, '2013-07-07', 'Born Again', 'Meycauayan, Bulacan', 11, 'Purok 5 Meycauayan', 'Region III', 'Bulacan', 'Meycauayan', 'Pantoc', 'Felipe Castro', 'Engineer', '09871112222', 'Lourdes Castro', 'Nurse', '09872223333', 'Cesar Castro', 'Technician', '09873334444', 'pending', 'Q582749', '09874445555', 'camille.castro@example.com', 'fb.com/camille.castro', '2025-09-06 03:57:20', NULL, 0, 0, 0, 0, 0),
(209, '451289637458', 'Adrian', 'Santos', 'Villanueva', 'New Student', 'male', 'Grade 6', NULL, '2013-04-15', 'Catholic', 'Marilao, Bulacan', 12, 'Blk 8 Marilao West', 'Region III', 'Bulacan', 'Marilao', 'Saog', 'Eduardo Villanueva', 'Technician', '09971112222', 'Rosa Villanueva', 'Vendor', '09972223333', 'Mario Villanueva', 'Farmer', '09973334444', 'pending', 'Q761092', '09974445555', 'adrian.villanueva@example.com', 'fb.com/adrian.villanueva', '2025-09-06 03:57:20', NULL, 0, 0, 0, 0, 0),
(210, '852369741258', 'Clarisse', 'Reyes', 'Martinez', 'New Student', 'female', 'Grade 6', NULL, '2013-01-23', 'Catholic', 'Meycauayan, Bulacan', 12, 'Blk 3 Meycauayan West', 'Region III', 'Bulacan', 'Meycauayan', 'Pajo', 'Ricardo Martinez', 'Driver', '09101112222', 'Clara Martinez', 'Nurse', '09102223333', 'Rosa Martinez', 'Vendor', '09103334444', 'pending', 'Q194827', '09104445555', 'clarisse.martinez@example.com', 'fb.com/clarisse.martinez', '2025-09-06 03:57:20', NULL, 0, 0, 0, 0, 0),
(211, '745896321478', 'Patrick', 'Dela Cruz', 'Santos', 'New Student', 'male', 'Grade 7', NULL, '2012-09-19', 'Catholic', 'Marilao, Bulacan', 13, 'Blk 9 Lot 2 Marilao', 'Region III', 'Bulacan', 'Marilao', 'Abangan Norte', 'Pedro Santos', 'Driver', '09175551234', 'Maria Santos', 'Vendor', '09176662345', 'Jose Santos', 'Farmer', '09177773456', 'pending', 'Q739201', '09178884567', 'patrick.santos@example.com', 'fb.com/patrick.santos', '2025-09-06 03:57:20', NULL, 0, 0, 0, 0, 0),
(212, '963258741236', 'Hannah', 'Lopez', 'Reyes', 'New Student', 'female', 'Grade 7', NULL, '2012-05-10', 'Iglesia ni Cristo', 'Meycauayan, Bulacan', 13, 'Phase 2 Meycauayan', 'Region III', 'Bulacan', 'Meycauayan', 'Bahay Pare', 'Rogelio Reyes', 'Engineer', '09275551234', 'Lucia Reyes', 'Teacher', '09276662345', 'Ana Reyes', 'Nurse', '09277773456', 'pending', 'Q194762', '09278884567', 'hannah.reyes@example.com', 'fb.com/hannah.reyes', '2025-09-06 03:57:20', NULL, 0, 0, 0, 0, 0),
(213, '784512369874', 'Gabriel', 'Reyes', 'Cruz', 'New Student', 'male', 'Grade 7', NULL, '2012-03-05', 'Catholic', 'Marilao, Bulacan', 13, 'Sitio Proper Marilao', 'Region III', 'Bulacan', 'Marilao', 'Ibayo', 'Carlos Cruz', 'Carpenter', '09375551234', 'Elena Cruz', 'Housewife', '09376662345', 'Manuel Cruz', 'Security Guard', '09377773456', 'pending', 'Q562893', '09378884567', 'gabriel.cruz@example.com', 'fb.com/gabriel.cruz', '2025-09-06 03:57:20', NULL, 0, 0, 0, 0, 0),
(214, '852147963258', 'Alyssa', 'Garcia', 'Lopez', 'New Student', 'female', 'Grade 7', NULL, '2012-07-18', 'Born Again', 'Meycauayan, Bulacan', 13, 'Meycauayan Bayan', 'Region III', 'Bulacan', 'Meycauayan', 'Camalig', 'Julio Lopez', 'Driver', '09475551234', 'Teresa Lopez', 'Clerk', '09476662345', 'Mario Lopez', 'Technician', '09477773456', 'pending', 'Q827491', '09478884567', 'alyssa.lopez@example.com', 'fb.com/alyssa.lopez', '2025-09-06 03:57:20', NULL, 0, 0, 0, 0, 0),
(215, '963258741258', 'Kevin', 'Villanueva', 'Ramos', 'New Student', 'male', 'Grade 7', NULL, '2012-11-30', 'Catholic', 'Marilao, Bulacan', 13, 'St. Michael St. Marilao', 'Region III', 'Bulacan', 'Marilao', 'Patubig', 'Nestor Ramos', 'Plumber', '09575551234', 'Alicia Ramos', 'Vendor', '09576662345', 'Leo Ramos', 'Farmer', '09577773456', 'pending', 'Q562718', '09578884567', 'kevin.ramos@example.com', 'fb.com/kevin.ramos', '2025-09-06 03:57:20', NULL, 0, 0, 0, 0, 0),
(216, '147852369741', 'Chloe', 'Martinez', 'Reyes', 'New Student', 'female', 'Grade 7', NULL, '2012-06-22', 'Catholic', 'Meycauayan, Bulacan', 13, 'Blk 10 Meycauayan Heights', 'Region III', 'Bulacan', 'Meycauayan', 'Saluysoy', 'Armando Reyes', 'Electrician', '09675551234', 'Dolores Reyes', 'Nurse', '09676662345', 'Celia Reyes', 'Teacher', '09677773456', 'pending', 'Q910283', '09678884567', 'chloe.reyes@example.com', 'fb.com/chloe.reyes', '2025-09-06 03:57:20', NULL, 0, 0, 0, 0, 0),
(217, '789654123789', 'Ethan', 'Cruz', 'Mendoza', 'New Student', 'male', 'Grade 7', NULL, '2012-08-14', 'Catholic', 'Marilao, Bulacan', 13, 'Phase 4 Marilao', 'Region III', 'Bulacan', 'Marilao', 'Prenza', 'Ernesto Mendoza', 'Mechanic', '09775551234', 'Luz Mendoza', 'Vendor', '09776662345', 'Jaime Mendoza', 'Farmer', '09777773456', 'pending', 'Q293817', '09778884567', 'ethan.mendoza@example.com', 'fb.com/ethan.mendoza', '2025-09-06 03:57:20', NULL, 0, 0, 0, 0, 0),
(218, '321456987123', 'Sophia', 'Torres', 'Navarro', 'New Student', 'female', 'Grade 7', NULL, '2012-01-27', 'Catholic', 'Meycauayan, Bulacan', 13, 'Blk 7 Meycauayan West', 'Region III', 'Bulacan', 'Meycauayan', 'Pantoc', 'Ricardo Navarro', 'Driver', '09875551234', 'Clara Navarro', 'Nurse', '09876662345', 'Rosa Navarro', 'Vendor', '09877773456', 'pending', 'Q839201', '09878884567', 'sophia.navarro@example.com', 'fb.com/sophia.navarro', '2025-09-06 03:57:20', NULL, 0, 0, 0, 0, 0),
(219, '987654321478', 'Christian', 'Flores', 'Gutierrez', 'New Student', 'male', 'Grade 7', NULL, '2012-04-08', 'Iglesia ni Cristo', 'Marilao, Bulacan', 13, 'Sitio Gutierrez Marilao', 'Region III', 'Bulacan', 'Marilao', 'Saog', 'Eduardo Gutierrez', 'Technician', '09975551234', 'Rosa Gutierrez', 'Vendor', '09976662345', 'Mario Gutierrez', 'Farmer', '09977773456', 'pending', 'Q674829', '09978884567', 'christian.gutierrez@example.com', 'fb.com/christian.gutierrez', '2025-09-06 03:57:20', NULL, 0, 0, 0, 0, 0),
(220, '741852963147', 'Jasmine', 'Aquino', 'Castro', 'New Student', 'female', 'Grade 7', NULL, '2012-02-03', 'Catholic', 'Meycauayan, Bulacan', 13, 'Blk 2 Meycauayan Proper', 'Region III', 'Bulacan', 'Meycauayan', 'Pajo', 'Felipe Castro', 'Engineer', '09105551234', 'Lourdes Castro', 'Nurse', '09106662345', 'Cesar Castro', 'Technician', '09107773456', 'pending', 'Q918273', '09108884567', 'jasmine.castro@example.com', 'fb.com/jasmine.castro', '2025-09-06 03:57:20', NULL, 0, 0, 0, 0, 0),
(221, '202500000111', 'Joshua', 'Santos', 'Reyes', 'New Student', 'male', 'Grade 8', NULL, '2011-05-12', 'Catholic', 'Marilao, Bulacan', 13, 'Blk 5 Lot 9 Marilao', 'Region III', 'Bulacan', 'Marilao', 'Abangan Norte', 'Antonio Reyes', 'Driver', '09171230001', 'Maria Reyes', 'Vendor', '09182340001', 'Pedro Reyes', 'Farmer', '09183450001', 'pending', 'Q823476', '09194560001', 'joshua.reyes@example.com', 'fb.com/joshua.reyes', '2025-09-06 03:58:16', NULL, 0, 0, 0, 0, 0),
(222, '202500000112', 'Ella', 'Lopez', 'Cruz', 'New Student', 'female', 'Grade 8', NULL, '2011-08-20', 'Iglesia ni Cristo', 'Meycauayan, Bulacan', 13, 'Phase 1 Meycauayan', 'Region III', 'Bulacan', 'Meycauayan', 'Bahay Pare', 'Rogelio Cruz', 'Technician', '09271230002', 'Lucia Cruz', 'Teacher', '09282340002', 'Ana Cruz', 'Nurse', '09283450002', 'pending', 'Q934571', '09294560002', 'ella.cruz@example.com', 'fb.com/ella.cruz', '2025-09-06 03:58:16', NULL, 0, 0, 0, 0, 0),
(223, '202500000113', 'Mark', 'Villanueva', 'Torres', 'New Student', 'male', 'Grade 8', NULL, '2011-02-18', 'Catholic', 'Marilao, Bulacan', 13, 'Sitio Marilao Proper', 'Region III', 'Bulacan', 'Marilao', 'Ibayo', 'Carlos Torres', 'Carpenter', '09371230003', 'Elena Torres', 'Housewife', '09382340003', 'Manuel Torres', 'Security Guard', '09383450003', 'pending', 'Q128934', '09394560003', 'mark.torres@example.com', 'fb.com/mark.torres', '2025-09-06 03:58:16', NULL, 0, 0, 0, 0, 0),
(224, '202500000114', 'Sofia', 'Garcia', 'Navarro', 'New Student', 'female', 'Grade 8', NULL, '2011-11-05', 'Born Again', 'Meycauayan, Bulacan', 12, 'Meycauayan Bayan', 'Region III', 'Bulacan', 'Meycauayan', 'Camalig', 'Julio Navarro', 'Driver', '09471230004', 'Teresa Navarro', 'Clerk', '09482340004', 'Mario Navarro', 'Technician', '09483450004', 'pending', 'Q572819', '09494560004', 'sofia.navarro@example.com', 'fb.com/sofia.navarro', '2025-09-06 03:58:16', NULL, 0, 0, 0, 0, 0),
(225, '202500000115', 'Daniel', 'Ramos', 'Mendoza', 'New Student', 'male', 'Grade 8', NULL, '2011-09-28', 'Catholic', 'Marilao, Bulacan', 12, 'St. Michael St. Marilao', 'Region III', 'Bulacan', 'Marilao', 'Patubig', 'Nestor Mendoza', 'Plumber', '09571230005', 'Alicia Mendoza', 'Vendor', '09582340005', 'Leo Mendoza', 'Farmer', '09583450005', 'pending', 'Q459128', '09594560005', 'daniel.mendoza@example.com', 'fb.com/daniel.mendoza', '2025-09-06 03:58:16', NULL, 0, 0, 0, 0, 0),
(226, '202500000116', 'Lea', 'Castro', 'Gutierrez', 'New Student', 'female', 'Grade 9', NULL, '2010-07-14', 'Catholic', 'Meycauayan, Bulacan', 14, 'Blk 8 Meycauayan Heights', 'Region III', 'Bulacan', 'Meycauayan', 'Saluysoy', 'Armando Gutierrez', 'Electrician', '09671230006', 'Dolores Gutierrez', 'Nurse', '09682340006', 'Celia Gutierrez', 'Teacher', '09683450006', 'pending', 'Q371902', '09694560006', 'lea.gutierrez@example.com', 'fb.com/lea.gutierrez', '2025-09-06 03:58:16', NULL, 0, 0, 0, 0, 0),
(227, '202500000117', 'Paolo', 'Aquino', 'Santos', 'New Student', 'male', 'Grade 9', NULL, '2010-03-22', 'Catholic', 'Marilao, Bulacan', 14, 'Phase 4 Marilao Heights', 'Region III', 'Bulacan', 'Marilao', 'Prenza', 'Ernesto Santos', 'Mechanic', '09771230007', 'Luz Santos', 'Vendor', '09782340007', 'Jaime Santos', 'Farmer', '09783450007', 'pending', 'Q903472', '09794560007', 'paolo.santos@example.com', 'fb.com/paolo.santos', '2025-09-06 03:58:16', NULL, 0, 0, 0, 0, 0),
(228, '202500000118', 'Angela', 'Martinez', 'Ramos', 'New Student', 'female', 'Grade 9', NULL, '2010-01-30', 'Iglesia ni Cristo', 'Meycauayan, Bulacan', 14, 'Blk 10 Meycauayan West', 'Region III', 'Bulacan', 'Meycauayan', 'Pantoc', 'Ricardo Ramos', 'Driver', '09871230008', 'Clara Ramos', 'Nurse', '09882340008', 'Rosa Ramos', 'Vendor', '09883450008', 'pending', 'Q604218', '09894560008', 'angela.ramos@example.com', 'fb.com/angela.ramos', '2025-09-06 03:58:16', NULL, 0, 0, 0, 0, 0),
(229, '202500000119', 'Christian', 'Flores', 'Lopez', 'New Student', 'male', 'Grade 9', NULL, '2010-04-18', 'Catholic', 'Marilao, Bulacan', 14, 'Sitio Gutierrez Marilao', 'Region III', 'Bulacan', 'Marilao', 'Saog', 'Eduardo Lopez', 'Technician', '09971230009', 'Rosa Lopez', 'Vendor', '09982340009', 'Mario Lopez', 'Farmer', '09983450009', 'pending', 'Q218945', '09994560009', 'christian.lopez@example.com', 'fb.com/christian.lopez', '2025-09-06 03:58:16', NULL, 0, 0, 0, 0, 0),
(230, '202500000120', 'Hannah', 'Torres', 'Villanueva', 'New Student', 'female', 'Grade 9', NULL, '2010-06-08', 'Born Again', 'Meycauayan, Bulacan', 14, 'Purok 5 Meycauayan', 'Region III', 'Bulacan', 'Meycauayan', 'Pajo', 'Felipe Villanueva', 'Engineer', '09101230010', 'Lourdes Villanueva', 'Nurse', '09102340010', 'Cesar Villanueva', 'Technician', '09103450010', 'pending', 'Q719053', '09104560010', 'hannah.villanueva@example.com', 'fb.com/hannah.villanueva', '2025-09-06 03:58:16', NULL, 0, 0, 0, 0, 0),
(231, '202500000201', 'Miguel', 'Lopez', 'Santos', 'New Student', 'male', 'Grade 9', NULL, '2010-02-15', 'Catholic', 'Marilao, Bulacan', 14, 'Blk 1 Lot 3 Marilao', 'Region III', 'Bulacan', 'Marilao', 'Ibayo', 'Rogelio Santos', 'Driver', '09171110001', 'Lucia Santos', 'Vendor', '09182220001', 'Pedro Santos', 'Farmer', '09183330001', 'pending', 'Q482910', '09194440001', 'miguel.santos@example.com', 'fb.com/miguel.santos', '2025-09-06 03:59:17', NULL, 0, 0, 0, 0, 0),
(232, '202500000202', 'Andrea', 'Cruz', 'Reyes', 'New Student', 'female', 'Grade 9', NULL, '2010-06-12', 'Iglesia ni Cristo', 'Meycauayan, Bulacan', 14, 'Phase 3 Meycauayan', 'Region III', 'Bulacan', 'Meycauayan', 'Bahay Pare', 'Antonio Reyes', 'Technician', '09271110002', 'Maria Reyes', 'Teacher', '09282220002', 'Jose Reyes', 'Carpenter', '09283330002', 'pending', 'Q583029', '09294440002', 'andrea.reyes@example.com', 'fb.com/andrea.reyes', '2025-09-06 03:59:17', NULL, 0, 0, 0, 0, 0),
(233, '202500000203', 'Jerome', 'Villanueva', 'Cruz', 'New Student', 'male', 'Grade 9', NULL, '2010-09-25', 'Catholic', 'Marilao, Bulacan', 14, 'Blk 7 Lot 8 Prenza', 'Region III', 'Bulacan', 'Marilao', 'Prenza', 'Carlos Cruz', 'Mechanic', '09371110003', 'Elena Cruz', 'Housewife', '09382220003', 'Mario Cruz', 'Security Guard', '09383330003', 'pending', 'Q692143', '09394440003', 'jerome.cruz@example.com', 'fb.com/jerome.cruz', '2025-09-06 03:59:17', NULL, 0, 0, 0, 0, 0),
(234, '202500000204', 'Bianca', 'Garcia', 'Lopez', 'New Student', 'female', 'Grade 9', NULL, '2010-11-10', 'Born Again', 'Meycauayan, Bulacan', 14, 'Blk 10 Camalig', 'Region III', 'Bulacan', 'Meycauayan', 'Camalig', 'Nestor Lopez', 'Driver', '09471110004', 'Teresa Lopez', 'Clerk', '09482220004', 'Mario Lopez', 'Technician', '09483330004', 'pending', 'Q781092', '09494440004', 'bianca.lopez@example.com', 'fb.com/bianca.lopez', '2025-09-06 03:59:17', NULL, 0, 0, 0, 0, 0),
(235, '202500000205', 'Rafael', 'Torres', 'Gutierrez', 'New Student', 'male', 'Grade 9', NULL, '2010-08-03', 'Catholic', 'Marilao, Bulacan', 14, 'Sitio Gutierrez Saog', 'Region III', 'Bulacan', 'Marilao', 'Saog', 'Eduardo Gutierrez', 'Technician', '09571110005', 'Rosa Gutierrez', 'Vendor', '09582220005', 'Manuel Gutierrez', 'Farmer', '09583330005', 'pending', 'Q319284', '09594440005', 'rafael.gutierrez@example.com', 'fb.com/rafael.gutierrez', '2025-09-06 03:59:17', NULL, 0, 0, 0, 0, 0),
(236, '202500000206', 'Camille', 'Aquino', 'Navarro', 'New Student', 'female', 'Grade 9', NULL, '2010-04-14', 'Catholic', 'Meycauayan, Bulacan', 14, 'Blk 2 Pantoc Meycauayan', 'Region III', 'Bulacan', 'Meycauayan', 'Pantoc', 'Ricardo Navarro', 'Driver', '09671110006', 'Clara Navarro', 'Nurse', '09682220006', 'Jose Navarro', 'Farmer', '09683330006', 'pending', 'Q920384', '09694440006', 'camille.navarro@example.com', 'fb.com/camille.navarro', '2025-09-06 03:59:17', NULL, 0, 0, 0, 0, 0),
(237, '202500000207', 'Angelo', 'Santos', 'Martinez', 'New Student', 'male', 'Grade 9', NULL, '2010-03-18', 'Catholic', 'Marilao, Bulacan', 14, 'Blk 6 Ibayo Marilao', 'Region III', 'Bulacan', 'Marilao', 'Ibayo', 'Rogelio Martinez', 'Plumber', '09771110007', 'Dolores Martinez', 'Nurse', '09782220007', 'Leo Martinez', 'Carpenter', '09783330007', 'pending', 'Q182739', '09794440007', 'angelo.martinez@example.com', 'fb.com/angelo.martinez', '2025-09-06 03:59:17', NULL, 0, 0, 0, 0, 0),
(238, '202500000208', 'Clarisse', 'Villanueva', 'Torres', 'New Student', 'female', 'Grade 9', NULL, '2010-01-22', 'Iglesia ni Cristo', 'Meycauayan, Bulacan', 14, 'Purok 3 Meycauayan', 'Region III', 'Bulacan', 'Meycauayan', 'Pajo', 'Felipe Torres', 'Engineer', '09871110008', 'Lourdes Torres', 'Nurse', '09882220008', 'Cesar Torres', 'Technician', '09883330008', 'pending', 'Q273819', '09894440008', 'clarisse.torres@example.com', 'fb.com/clarisse.torres', '2025-09-06 03:59:17', NULL, 0, 0, 0, 0, 0),
(239, '202500000209', 'Nathan', 'Flores', 'Ramos', 'New Student', 'male', 'Grade 9', NULL, '2010-05-11', 'Born Again', 'Marilao, Bulacan', 14, 'Blk 9 Patubig', 'Region III', 'Bulacan', 'Marilao', 'Patubig', 'Armando Ramos', 'Technician', '09971110009', 'Dolores Ramos', 'Vendor', '09982220009', 'Mario Ramos', 'Driver', '09983330009', 'pending', 'Q918273', '09994440009', 'nathan.ramos@example.com', 'fb.com/nathan.ramos', '2025-09-06 03:59:17', NULL, 0, 0, 0, 0, 0),
(240, '202500000210', 'Isabella', 'Castro', 'Villanueva', 'New Student', 'female', 'Grade 9', NULL, '2010-12-19', 'Catholic', 'Meycauayan, Bulacan', 13, 'Blk 11 Meycauayan West', 'Region III', 'Bulacan', 'Meycauayan', 'Bahay Pare', 'Antonio Villanueva', 'Technician', '09101110010', 'Maria Villanueva', 'Teacher', '09102220010', 'Jose Villanueva', 'Farmer', '09103330010', 'pending', 'Q384920', '09104440010', 'isabella.villanueva@example.com', 'fb.com/isabella.villanueva', '2025-09-06 03:59:17', NULL, 0, 0, 0, 0, 0),
(241, '202500000211', 'Jasper', 'Lopez', 'Santos', 'New Student', 'male', 'Grade 10', NULL, '2009-01-15', 'Catholic', 'Marilao, Bulacan', 15, 'Blk 4 Lot 6 Marilao', 'Region III', 'Bulacan', 'Marilao', 'Ibayo', 'Rogelio Santos', 'Driver', '09171120011', 'Lucia Santos', 'Vendor', '09182220011', 'Pedro Santos', 'Farmer', '09183330011', 'pending', 'Q574829', '09194440011', 'jasper.santos@example.com', 'fb.com/jasper.santos', '2025-09-06 03:59:17', NULL, 0, 0, 0, 0, 0),
(242, '202500000212', 'Althea', 'Cruz', 'Reyes', 'New Student', 'female', 'Grade 10', NULL, '2009-04-20', 'Catholic', 'Meycauayan, Bulacan', 15, 'Blk 12 Meycauayan Heights', 'Region III', 'Bulacan', 'Meycauayan', 'Bahay Pare', 'Antonio Reyes', 'Technician', '09271120012', 'Maria Reyes', 'Teacher', '09282220012', 'Jose Reyes', 'Carpenter', '09283330012', 'pending', 'Q918203', '09294440012', 'althea.reyes@example.com', 'fb.com/althea.reyes', '2025-09-06 03:59:17', NULL, 0, 0, 0, 0, 0),
(243, '202500000213', 'Lawrence', 'Villanueva', 'Cruz', 'New Student', 'male', 'Grade 10', NULL, '2009-10-09', 'Born Again', 'Marilao, Bulacan', 15, 'Blk 2 Prenza', 'Region III', 'Bulacan', 'Marilao', 'Prenza', 'Carlos Cruz', 'Mechanic', '09371120013', 'Elena Cruz', 'Housewife', '09382220013', 'Mario Cruz', 'Security Guard', '09383330013', 'pending', 'Q203984', '09394440013', 'lawrence.cruz@example.com', 'fb.com/lawrence.cruz', '2025-09-06 03:59:17', NULL, 0, 0, 0, 0, 0);
INSERT INTO `admission_form` (`id`, `lrn`, `firstname`, `middlename`, `lastname`, `status`, `gender`, `grade_level`, `profile_picture`, `birthday`, `religion`, `place_of_birth`, `age`, `residential_address`, `region`, `province`, `municipal`, `barangay`, `father_name`, `father_occupation`, `father_contact`, `mother_name`, `mother_occupation`, `mother_contact`, `guardian_name`, `guardian_occupation`, `guardian_contact`, `admission_status`, `que_code`, `phone`, `email`, `facebook`, `admission_date`, `strand`, `birth_cert`, `report_card`, `good_moral`, `id_pic`, `esc_cert`) VALUES
(244, '202500000214', 'Sophia', 'Garcia', 'Lopez', 'New Student', 'female', 'Grade 10', NULL, '2009-07-18', 'Iglesia ni Cristo', 'Meycauayan, Bulacan', 15, 'Blk 8 Camalig', 'Region III', 'Bulacan', 'Meycauayan', 'Camalig', 'Nestor Lopez', 'Driver', '09471120014', 'Teresa Lopez', 'Clerk', '09482220014', 'Mario Lopez', 'Technician', '09483330014', 'pending', 'Q938102', '09494440014', 'sophia.lopez@example.com', 'fb.com/sophia.lopez', '2025-09-06 03:59:17', NULL, 0, 0, 0, 0, 0),
(245, '202500000215', 'Gabriel', 'Torres', 'Gutierrez', 'New Student', 'male', 'Grade 10', NULL, '2009-03-12', 'Catholic', 'Marilao, Bulacan', 15, 'Sitio Gutierrez Saog', 'Region III', 'Bulacan', 'Marilao', 'Saog', 'Eduardo Gutierrez', 'Technician', '09571120015', 'Rosa Gutierrez', 'Vendor', '09582220015', 'Manuel Gutierrez', 'Farmer', '09583330015', 'pending', 'Q120398', '09594440015', 'gabriel.gutierrez@example.com', 'fb.com/gabriel.gutierrez', '2025-09-06 03:59:17', NULL, 0, 0, 0, 0, 0),
(246, '202500000216', 'Chloe', 'Aquino', 'Navarro', 'New Student', 'female', 'Grade 10', NULL, '2009-11-25', 'Catholic', 'Meycauayan, Bulacan', 15, 'Blk 9 Pantoc', 'Region III', 'Bulacan', 'Meycauayan', 'Pantoc', 'Ricardo Navarro', 'Driver', '09671120016', 'Clara Navarro', 'Nurse', '09682220016', 'Jose Navarro', 'Farmer', '09683330016', 'pending', 'Q830291', '09694440016', 'chloe.navarro@example.com', 'fb.com/chloe.navarro', '2025-09-06 03:59:17', NULL, 0, 0, 0, 0, 0),
(248, '202500000218', 'Janelle', 'Villanueva', 'Torres', 'New Student', 'female', 'Grade 10', NULL, '2009-08-07', 'Born Again', 'Meycauayan, Bulacan', 15, 'Purok 4 Pajo', 'Region III', 'Bulacan', 'Meycauayan', 'Pajo', 'Felipe Torres', 'Engineer', '09871120018', 'Lourdes Torres', 'Nurse', '09882220018', 'Cesar Torres', 'Technician', '09883330018', 'approved', 'Q192837', '09894440018', 'janelle.torres@example.com', 'floterina@gmail.com', '2025-09-06 04:07:13', NULL, 0, 0, 0, 0, 0),
(249, '202500000219', 'Kyle', 'Flores', 'Ramos', 'New Student', 'male', 'Grade 10', NULL, '2009-02-03', 'Iglesia ni Cristo', 'Marilao, Bulacan', 15, 'Blk 13 Patubig', 'Region III', 'Bulacan', 'Marilao', 'Patubig', 'Armando Ramos', 'Technician', '09971120019', 'Dolores Ramos', 'Vendor', '09982220019', 'Mario Ramos', 'Driver', '09983330019', 'pending', 'Q283910', '09994440019', 'floterina@gmail.com', 'floterina@gmail.com', '2025-09-06 04:08:10', NULL, 0, 0, 0, 0, 0),
(250, '202500000220', 'Bea', 'Castro', 'Villanueva', 'New Student', 'female', 'Grade 10', NULL, '2009-09-09', 'Catholic', 'Meycauayan, Bulacan', 15, 'Blk 6 Meycauayan West', 'Region III', 'Bulacan', 'Meycauayan', 'Bahay Pare', 'Antonio Villanueva', 'Technician', '09101120020', 'Maria Villanueva', 'Teacher', '09102220020', 'Jose Villanueva', 'Farmer', '09103330020', 'for_review', 'Q384759', '09104440020', 'floterina@gmail.com', 'fb.com/bea.villanueva', '2025-09-06 04:05:59', NULL, 0, 0, 0, 0, 0),
(251, '000000000001', 'Rodriquez', 'macaraeg', 'Alfred', 'Old Student', 'male', 'Grade 8', '', '2005-02-20', 'Christian', 'Marilao Bulacan', 18, 'Poblacion, Plaridel, Bulacan, Central Luzon, ', 'Central Luzon', 'Bulacan', 'Plaridel', 'Poblacion', 'Victor Santos', 'Engineer', '09324163453', 'Angela Santos', 'Housewife', '09170008882', 'Sian Candado', 'N/A', '09764532163', 'pending', 'Q033704', '09170008880', 'floterina@gmail.com', NULL, '2025-09-06 04:29:46', NULL, 0, 0, 0, 0, 0),
(253, '87812212', 'test', 'test', 'Will', 'New Student', 'male', 'Grade 2', '', '2005-02-24', 'Christian', 'Marilao Bulacan', 12, 'Santa Fe, Tagbina, Surigao Del Sur, Caraga, ', 'Caraga', 'Surigao Del Sur', 'Tagbina', 'Santa Fe', 'Victor Santos', 'Engineer', '09170008881', 'Angela Santos', 'Housewife', '09170008882', 'Sian Candado', 'N/A', '09764532163', 'pending', 'Q900975', '09135959565', 'hannah.santos@example.com', NULL, '2025-09-06 04:32:32', NULL, 0, 0, 0, 0, 0),
(254, '', 'Doe', 'Macaraeg', 'John', 'New Student', 'male', 'Nursery', '', '2020-02-02', 'Christian', 'test', 4, 'Santa Cruz, Veruela, Agusan Del Sur, Caraga, ', 'Caraga', 'Agusan Del Sur', 'Veruela', 'Santa Cruz', 'Victor Santos', 'Engineer', '09324163453', 'Angela Santos', 'Housewife', '09365541152', 'Sian Candado', 'N/A', '09764532163', 'for_review', 'Q341838', '09135959565', 'john@gmail.com', NULL, '2025-09-06 06:22:30', NULL, 0, 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `admission_old`
--

CREATE TABLE `admission_old` (
  `id` int(11) NOT NULL,
  `grade_level` varchar(50) NOT NULL,
  `strand` varchar(100) NOT NULL,
  `gender` enum('Male','Female') NOT NULL,
  `student_id` varchar(20) NOT NULL,
  `que_code` varchar(100) NOT NULL,
  `admission_status` varchar(100) NOT NULL DEFAULT 'pending',
  `last_name` varchar(100) NOT NULL,
  `first_name` varchar(100) NOT NULL,
  `middle_name` varchar(100) DEFAULT NULL,
  `birth_date` date NOT NULL,
  `birth_place` varchar(255) NOT NULL,
  `age` int(11) NOT NULL,
  `religion` varchar(100) NOT NULL,
  `guardian_phone` varchar(11) NOT NULL,
  `email` varchar(150) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
-- Table structure for table `assignments`
--

CREATE TABLE `assignments` (
  `assignment_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `instructions` text NOT NULL,
  `points` int(11) NOT NULL,
  `due_date` date NOT NULL,
  `due_time` time NOT NULL,
  `teacher_id` int(11) DEFAULT NULL,
  `course_id` int(11) DEFAULT NULL,
  `attachment` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `accept` varchar(1) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `assignments`
--

INSERT INTO `assignments` (`assignment_id`, `title`, `instructions`, `points`, `due_date`, `due_time`, `teacher_id`, `course_id`, `attachment`, `created_at`, `accept`) VALUES
(7, 'test', 'test', 100, '2025-09-18', '23:59:00', 40, 20, '', '2025-09-16 11:32:39', '1'),
(8, 'test', 'test', 100, '2025-09-17', '11:59:00', 40, 24, '', '2025-09-16 12:01:47', '1');

-- --------------------------------------------------------

--
-- Table structure for table `assignment_submissions`
--

CREATE TABLE `assignment_submissions` (
  `submission_id` int(11) NOT NULL,
  `student_id` int(11) DEFAULT NULL,
  `assignment_id` int(11) DEFAULT NULL,
  `submission_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `file_path` varchar(255) DEFAULT NULL,
  `file_url` varchar(255) DEFAULT NULL,
  `grade` int(11) DEFAULT NULL,
  `feedback` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `attendance`
--

CREATE TABLE `attendance` (
  `id` int(11) NOT NULL,
  `date` date NOT NULL,
  `time_in` time DEFAULT NULL,
  `course_id` int(11) NOT NULL,
  `rfid` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `first_name` varchar(100) NOT NULL,
  `last_name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `attendance`
--

INSERT INTO `attendance` (`id`, `date`, `time_in`, `course_id`, `rfid`, `user_id`, `first_name`, `last_name`) VALUES
(57, '2025-09-15', '18:34:45', 25, 1224955175, 13, 'Daniel', 'Tan'),
(58, '2025-09-15', '18:35:10', 25, 1224955174, 12, 'Ava', 'Flores'),
(59, '2025-09-16', '01:32:09', 20, 1224955175, 13, 'Daniel', 'Tan');

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
-- Table structure for table `courses`
--

CREATE TABLE `courses` (
  `id` int(11) NOT NULL,
  `teacher_id` int(11) NOT NULL,
  `course_name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `day` enum('Everyday','Monday','Tuesday','Wednesday','Thursday','Friday','Saturday','Sunday') NOT NULL,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL,
  `section` varchar(100) NOT NULL,
  `subject` varchar(100) NOT NULL,
  `room` varchar(50) NOT NULL,
  `cover_photo` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `status` varchar(100) NOT NULL DEFAULT 'active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`id`, `teacher_id`, `course_name`, `description`, `day`, `start_time`, `end_time`, `section`, `subject`, `room`, `cover_photo`, `created_at`, `updated_at`, `status`) VALUES
(16, 40, 'Filipino 1', 'Pag-aaral ng wikang Filipino at panitikan para sa elementarya', 'Monday', '08:00:00', '09:00:00', 'Grade 1-A', 'Filipino', 'Room 101', '1757440819_68c06b3368c26.jpg', '2025-09-09 16:50:30', '2025-09-15 18:08:35', 'active'),
(17, 40, 'English 1', 'Basic English communication skills for elementary pupils', 'Monday', '09:00:00', '10:00:00', 'Grade 1-A', 'English', 'Room 101', '1757440796_68c06b1ca2b90.jpg', '2025-09-09 16:50:30', '2025-09-09 18:02:47', 'active'),
(18, 40, 'Mathematics 1', 'Basic arithmetic: addition, subtraction, multiplication, division', 'Tuesday', '08:00:00', '09:00:00', 'Grade 1-A', 'Mathematics', 'Room 101', '1757440221_68c068dddb5a2.jpg', '2025-09-09 16:50:30', '2025-09-09 17:50:21', 'active'),
(19, 40, 'Araling Panlipunan 1', 'Pag-aaral tungkol sa kasaysayan, heograpiya at kultura', 'Tuesday', '09:10:00', '10:10:00', 'Grade 1-A', 'Araling Panlipunan', 'Room 101', '1757440786_68c06b12b2113.jpg', '2025-09-09 16:50:30', '2025-09-09 17:59:46', 'active'),
(20, 40, 'Science 1', 'Introduction to natural and physical sciences for children', 'Wednesday', '08:00:00', '09:00:00', 'Grade 1-A', 'Science', 'Room 101', '1757440776_68c06b08c728c.jpg', '2025-09-09 16:50:30', '2025-09-09 17:59:36', 'active'),
(21, 40, 'Edukasyon sa Pagpapakatao (EsP) 1', 'Pagpapahalaga, tamang asal at wastong gawi', 'Wednesday', '09:10:00', '10:10:00', 'Grade 1-A', 'EsP', 'Room 101', '1757440765_68c06afd441c2.jpg', '2025-09-09 16:50:30', '2025-09-09 17:59:25', 'active'),
(22, 40, 'MAPEH 1', 'Music, Arts, Physical Education, and Health integration', 'Thursday', '08:00:00', '09:00:00', 'Grade 1-A', 'MAPEH', 'Room 102', '1757440654_68c06a8e3d51c.jpg', '2025-09-09 16:50:30', '2025-09-09 17:57:34', 'active'),
(23, 40, 'Music 1', 'Learning basic rhythm, singing, and instruments', 'Thursday', '09:10:00', '10:10:00', 'Grade 1-A', 'Music', 'Room 102', '1757440257_68c06901ddd75.jpg', '2025-09-09 16:50:30', '2025-09-09 17:50:57', 'active'),
(24, 40, 'Arts 1', 'Exploring creativity through drawing, coloring, and crafts', 'Friday', '08:00:00', '09:00:00', 'Grade 1-A', 'Arts', 'Room 102', '1757440185_68c068b9ce30f.jpg', '2025-09-09 16:50:30', '2025-09-09 17:49:45', 'active'),
(25, 40, 'Physical Education 1', 'Basic exercises, games, and fitness for children', 'Tuesday', '10:00:00', '11:00:00', 'Grade 1-A', 'Physical Education', 'Gymnasium', '1757440156_68c0689c9e487.jpg', '2025-09-09 16:50:30', '2025-09-10 08:27:41', 'active');

-- --------------------------------------------------------

--
-- Table structure for table `course_students`
--

CREATE TABLE `course_students` (
  `id` int(11) NOT NULL,
  `course_id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `joined_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `course_students`
--

INSERT INTO `course_students` (`id`, `course_id`, `student_id`, `joined_at`) VALUES
(38, 13, 59, '2025-09-09 15:25:54'),
(39, 11, 59, '2025-09-09 16:33:46'),
(41, 24, 59, '2025-09-09 17:15:10'),
(42, 23, 59, '2025-09-09 17:15:20'),
(43, 20, 59, '2025-09-09 18:28:56'),
(44, 20, 36, '2025-09-09 18:29:04'),
(45, 20, 10, '2025-09-09 18:29:04'),
(46, 20, 34, '2025-09-09 18:29:04'),
(47, 20, 17, '2025-09-09 18:29:04'),
(48, 20, 35, '2025-09-09 18:29:04'),
(51, 16, 59, '2025-09-10 04:23:28'),
(52, 20, 13, '2025-09-15 17:33:29'),
(53, 25, 32, '2025-09-15 18:19:20'),
(55, 25, 35, '2025-09-15 18:19:20'),
(56, 25, 37, '2025-09-15 18:19:20'),
(57, 25, 52, '2025-09-15 18:19:20'),
(58, 25, 55, '2025-09-15 18:19:20'),
(59, 24, 13, '2025-09-16 12:01:30');

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
  `payment` double NOT NULL,
  `payment_type` varchar(50) NOT NULL,
  `tuition_id` int(11) NOT NULL,
  `date` datetime DEFAULT current_timestamp(),
  `invoice_number` double NOT NULL,
  `reference_number` bigint(20) DEFAULT NULL,
  `transaction_fee` decimal(10,2) DEFAULT 0.00
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `payment`
--

INSERT INTO `payment` (`id`, `payment`, `payment_type`, `tuition_id`, `date`, `invoice_number`, `reference_number`, `transaction_fee`) VALUES
(58, 100, 'Cash', 33, '2025-09-06 01:09:57', 8103224, 1128463787, 0.00),
(59, 1000, 'Cash', 38, '2025-09-16 02:40:19', 1836395, 5377908823, 0.00);

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` int(11) NOT NULL,
  `course_id` int(11) NOT NULL,
  `teacher_id` int(11) NOT NULL,
  `title` varchar(150) NOT NULL,
  `description` text NOT NULL,
  `video_link` varchar(255) DEFAULT NULL,
  `attachment` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `course_id`, `teacher_id`, `title`, `description`, `video_link`, `attachment`, `created_at`) VALUES
(29, 13, 40, 'Sylabus', '<h3><strong>Sylabus:</strong></h3><p>&nbsp;</p><p>Welcome guys to english subjects. Hope we learn a lot with this subject</p>', NULL, NULL, '2025-09-09 16:29:17'),
(37, 16, 40, 'Kahulugan ng Wika', '<h1><strong>Lesson 1: Kahulugan ng Wika</strong></h1><p>Ang wika ay hindi lamang isang paraan ng komunikasyon, kundi isa ring pagkakakilanlan ng isang bansa. Sa pamamagitan ng wika, naipapahayag natin ang ating saloobin, damdamin, at kultura. Ano para sa iyo ang kahalagahan ng Filipino bilang ating pambansang wika?</p>', NULL, NULL, '2025-09-10 04:17:06'),
(38, 16, 40, 'Panitikan ng Pilipinas', '<h1><strong>Lesson 2: Panitikan ng Pilipinas</strong></h1><p>&nbsp;</p><p>Ang panitikan ay salamin ng lipunan. Mula sa epiko, alamat, pabula, hanggang sa modernong tula at maikling kuwento, ipinapakita nito ang ating kasaysayan at karanasan. Anong akdang pampanitikan ang paborito mo at bakit?</p>', NULL, NULL, '2025-09-10 04:18:04'),
(45, 20, 40, 'Lesson 1: The Scientific Method', '<h1>Lesson 1: The Scientific Method</h1><p>&nbsp;</p><p><strong>Overview:</strong><br>Learn how scientists explore the world using observation, hypothesis, experimentation, and analysis.</p><p><strong>Objectives:</strong></p><ul><li>Understand the steps of the scientific method</li><li>Practice forming hypotheses and drawing conclusions</li></ul>', NULL, '[\"file_68c8520cdfc1d.png\"]', '2025-09-15 17:51:08'),
(46, 20, 40, 'Lesson 2: Earth\'s Layers', '<h1>Lesson 2: Earth\'s Layers</h1><p>&nbsp;</p><p><strong>Overview:</strong><br>Explore the structure of the Earth—crust, mantle, outer core, and inner core.</p><p><strong>Objectives:</strong></p><ul><li>Identify Earth\'s layers and their characteristics</li><li>Understand how tectonic plates move</li></ul>', NULL, NULL, '2025-09-15 17:51:54'),
(47, 20, 40, 'Lesson 3: States of Matter', '<h1>Lesson 3: States of Matter</h1><p>&nbsp;</p><p><strong>Overview:</strong><br>Discover the 3 main states of matter: solid, liquid, and gas — and how they change with temperature.</p><p><strong>Objectives:</strong></p><ul><li>Define each state of matter</li><li>Describe melting, freezing, condensation, and evaporation</li></ul>', NULL, '[\"file_68c8526644613.png\"]', '2025-09-15 17:52:38');

-- --------------------------------------------------------

--
-- Table structure for table `scholastic_records`
--

CREATE TABLE `scholastic_records` (
  `id` int(11) NOT NULL,
  `student_number` varchar(50) NOT NULL,
  `school` varchar(255) NOT NULL,
  `district` varchar(255) NOT NULL,
  `division` varchar(255) NOT NULL,
  `region` varchar(255) NOT NULL,
  `school_id` varchar(50) NOT NULL,
  `classified_grade` varchar(50) NOT NULL,
  `section` varchar(50) NOT NULL,
  `school_year` varchar(20) NOT NULL,
  `adviser_name` varchar(255) NOT NULL,
  `general_average` decimal(5,2) NOT NULL,
  `scholastic_json` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`scholastic_json`)),
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `scholastic_records`
--

INSERT INTO `scholastic_records` (`id`, `student_number`, `school`, `district`, `division`, `region`, `school_id`, `classified_grade`, `section`, `school_year`, `adviser_name`, `general_average`, `scholastic_json`, `created_at`) VALUES
(1, '2025-86795', 'asasas', 'asas', 'asasas', 'asasas', '1212', '12', '1', '2025-2026', '12122', 12.00, '[{\"subject\":\"12\",\"q1\":12,\"q2\":12,\"q3\":21,\"q4\":21,\"final_rating\":12,\"remarks\":\"Passed\"}]', '2025-09-04 08:20:54'),
(2, '2025-86795', '12', '21', '21', '21', '12', '12', '21', '2025-2026', '12', 12.00, '[{\"subject\":\"12\",\"q1\":12,\"q2\":21,\"q3\":21,\"q4\":12,\"final_rating\":21,\"remarks\":\"Passed\"}]', '2025-09-04 09:06:15'),
(3, '2025-86795', '12', '12', '12', '12', '123', '12', '12', '2025-2026', '21', 12.00, '[{\"subject\":\"12\",\"q1\":12,\"q2\":21,\"q3\":21,\"q4\":21,\"final_rating\":12,\"remarks\":\"Passed\"}]', '2025-09-04 09:08:54'),
(4, '2025-86795', '123', '123', '312', '123', '123', '312', '123', '2025-2026', '132', 12.00, '[{\"subject\":\"Math\",\"q1\":89,\"q2\":78,\"q3\":78,\"q4\":87,\"final_rating\":95,\"remarks\":\"Passed\"},{\"subject\":\"English\",\"q1\":85,\"q2\":90,\"q3\":89,\"q4\":90,\"final_rating\":95,\"remarks\":\"Passed\"}]', '2025-09-04 10:50:45'),
(5, '2025-54422', 'Prenza Elementary', 'Marilao', 'Bulacan', 'Central Luzon', '1212', '90', 'Amythist', '2025-2026', 'Juan Dela Cruz', 95.00, '[{\"subject\":\"Mathematics\",\"q1\":82,\"q2\":85,\"q3\":87,\"q4\":90,\"final_rating\":95,\"remarks\":\"Passed\"},{\"subject\":\"English\",\"q1\":83,\"q2\":83,\"q3\":81,\"q4\":85,\"final_rating\":86,\"remarks\":\"Passed\"}]', '2025-09-05 16:47:18');

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
(19, 'Moonstone', 'Grade 1', 39, '101', 'N/A', 20, 2, '2025-2026', '2025-07-12 15:39:32'),
(20, 'Topaz', 'Grade 2', 44, '102', 'N/A', 20, 0, '2025-2026', '2025-07-12 15:49:48'),
(21, 'Amethyst', 'Grade 2', 44, '102', 'N/A', 20, 2, '2025-2026', '2025-07-12 15:50:07'),
(22, 'Beryl', 'Grade 3', 45, '103', 'N/A', 25, 0, '2025-2026', '2025-07-12 15:51:43'),
(23, 'Pearl', 'Grade 3', 45, '103', 'N/A', 25, 0, '2025-2026', '2025-07-12 15:52:01'),
(24, 'Garnet', 'Grade 5', 41, '105', 'N/A', 20, 1, '2025-2026', '2025-07-12 15:54:58'),
(25, 'Ruby', 'Grade 8', 51, '108', 'N/A', 30, 0, '2025-2026', '2025-07-12 16:06:43'),
(26, 'Quartz', 'Grade 8', 51, '108', 'N/A', 30, 1, '2025-2026', '2025-07-12 16:07:01'),
(27, 'Alexandrite', 'Grade 9', 51, '109', 'N/A', 30, 2, '2025-2026', '2025-07-12 16:07:21'),
(28, 'Aquamarine', 'Grade 10', 51, '110', 'N/A', 30, 2, '2025-2027', '2025-07-12 16:08:11'),
(29, 'Zircon', 'Grade 10', 51, '110', 'N/A', 30, 3, '2025-2026', '2025-07-12 16:09:19'),
(30, 'ABM 11', 'Grade 11', 42, '111', 'ABM (Accountancy, Business and Management)', 30, 1, '2025-2026', '2025-07-12 16:10:06'),
(31, 'HUMSS 11', 'Grade 11', 42, '111', 'HUMMS (Humanities and Social Sciences)', 30, 0, '2025-2026', '2025-07-12 16:10:25'),
(32, 'STEM 11', 'Grade 11', 42, '111', 'STEM (Science, Technology, Engineering and Mathematics)', 30, 0, '2025-2026', '2025-07-12 16:10:52'),
(33, 'ABM 12 - Feldspar', 'Grade 12', 43, '112', 'ABM (Accountancy, Business and Management)', 30, 5, '2025-2026', '2025-07-12 16:11:17'),
(34, 'HUMSS 12', 'Grade 12', 43, '112', 'HUMMS (Humanities and Social Sciences)', 30, 1, '2025-2026', '2025-07-12 16:11:38'),
(35, 'STEM 12 - Sardonyx', 'Grade 12', 43, '112', 'STEM (Science, Technology, Engineering and Mathematics)', 30, 0, '2025-2026', '2025-07-12 16:12:11'),
(36, 'Malakas', 'Grade 4', 42, '303', 'N/A', 20, 0, '2025-2026', '2025-08-22 20:26:18'),
(37, 'Mabait', 'Grade 6', 45, '303', 'N/A', 100, 1, '2025-2026', '2025-08-22 20:29:49');

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
(45, '2025-98740', '2025010000217', 'Marcus', 'Santos', 'Martinez', 'New Student', 'male', 'Grade 10', NULL, '2009-05-28', 'Catholic', 'Marilao, Bulacan', 15, 'Blk 3 Ibayo', NULL, NULL, NULL, NULL, 'Rogelio Martinez', 'Plumber', '09771120017', 'Dolores Martinez', 'Nurse', '09782220017', 'Leo Martinez', 'Carpenter', '09783330017', 'approved', 'Q485920', '09794440017', 'floterina@gmail.com', 'fb.com/marcus.martinez', '2025-09-06 12:00:58', NULL, 1, 1, 1, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `student_tuition`
--

CREATE TABLE `student_tuition` (
  `id` int(11) NOT NULL,
  `account_number` varchar(50) NOT NULL,
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

INSERT INTO `student_tuition` (`id`, `account_number`, `student_number`, `payment_plan`, `enrolled_section`, `registration_fee`, `tuition_fee`, `miscellaneous`, `uniform`, `uniform_cart`, `discount_type`, `discount_value`, `discount_amount`, `downpayment`, `enrolled_date`) VALUES
(33, '02696982', '2025-54422', 'Quarterly', '19', 2500.00, 1000.00, 15635.25, 550.00, '[{\"name\":\"Grade 1 to 6 - Top - Polo Jacket\",\"quantity\":1,\"total\":550,\"gender\":\"Male\",\"size\":\"XL\"}]', '', 0.00, 0.00, 0.00, '2025-09-05 18:14:04'),
(34, '15487830', '2025-71572', 'Semestral', '21', 2500.00, 24200.75, 15635.25, 550.00, '[{\"name\":\"Grade 1 to 6 - Top - Polo Jacket\",\"quantity\":1,\"total\":550,\"gender\":\"Male\",\"size\":\"S\"}]', '', 0.00, 0.00, 0.00, '2025-09-06 05:23:52'),
(35, '30148729', '2025-29635', 'Semestral', '37', 2500.00, 24752.75, 15635.25, 550.00, '[{\"name\":\"Grade 1 to 6 - Top - Polo Jacket\",\"quantity\":1,\"total\":550,\"gender\":\"Male\",\"size\":\"XL\"}]', '', 0.00, 0.00, 0.00, '2025-09-06 06:13:32'),
(36, '26153372', '2025-98740', 'Quarterly', '29', 2500.00, 29545.75, 15635.25, 620.00, '[{\"name\":\"Grade 7 to 10 - Top - Polo Barong\",\"quantity\":1,\"total\":620,\"gender\":\"Male\",\"size\":\"XL\"}]', '', 0.00, 0.00, 0.00, '2025-09-06 13:57:27'),
(37, '75958230', '2025-28756', 'Monthly', '29', 2500.00, 29545.75, 15635.25, 430.00, '[{\"name\":\"Nursery to Kinder - Top - Polo Jacket with Lining\",\"quantity\":1,\"total\":430,\"gender\":\"Male\",\"size\":\"XS\"}]', '', 0.00, 0.00, 0.00, '2025-09-06 21:12:00'),
(38, '13768129', '2025-98740', 'Monthly', '29', 2500.00, 29545.75, 15635.25, 430.00, '[{\"name\":\"Nursery to Kinder - Top - Polo Jacket with Lining\",\"quantity\":1,\"total\":430,\"gender\":\"Male\",\"size\":\"XS\"}]', '', 0.00, 0.00, 0.00, '2025-09-06 21:13:49');

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
  `acc_status` varchar(100) NOT NULL DEFAULT 'active',
  `subject` varchar(1000) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `acc_type`, `username`, `email`, `password`, `first_name`, `last_name`, `gender`, `birthdate`, `phone_number`, `address`, `created_at`, `updated_at`, `profile`, `rfid`, `acc_status`, `subject`) VALUES
(1, 'admin', 'stephani.admin', 'stephani.candado@example.com', '$2y$10$KEek95Y7gfl.7WplR9kPI.jOp2mGx/daQXe4zjOITFv7DkgpHdJX.', 'Stephani', 'Candado', 'female', '1990-03-15', '09170000001', '101 Admin Ave, Cityville', '2025-06-13 16:58:26', '2025-07-14 09:10:20', 'dummy.jpg', NULL, 'active', NULL),
(3, 'parent', 'cj.parent', 'cj.escalora@example.com', '$2y$10$KEek95Y7gfl.7WplR9kPI.jOp2mGx/daQXe4zjOITFv7DkgpHdJX.', 'CJ', 'Escalora', 'male', '1982-11-05', '09170000003', '103 Parent Rd, Cityville', '2025-06-13 16:58:26', '2025-07-15 06:05:16', 'dummy.jpg', NULL, 'active', NULL),
(10, 'student', 'mary_espinosa.student', 'mary@gmail.com', '$2y$10$KEek95Y7gfl.7WplR9kPI.jOp2mGx/daQXe4zjOITFv7DkgpHdJX.', 'Mary', 'Espinosa', 'female', '2000-02-22', 'N/A', 'Bundukan, Bocaue, Bulacan, Central Luzon', '2025-06-22 03:19:52', '2025-09-15 10:47:21', '1757500769_68c1556178674.png', NULL, 'active', NULL),
(12, 'student', 'ava_flores.student', 'ava.flores@email.com', '$2y$10$Rk9RsPBzi7Tl5W0ipMR9Re/Ym8UzrmHTYhIX22ekpiEAvp3tuGb3i', 'Ava', 'Flores', 'female', '2012-08-10', 'N/A', 'Longos, Pulilan, Bulacan', '2025-06-22 03:43:53', '2025-07-15 18:56:45', 'dummy.jpg', 1224955174, 'active', NULL),
(13, 'student', 'daniel_tan.student', 'daniel.tan@email.com', '$2y$10$KEek95Y7gfl.7WplR9kPI.jOp2mGx/daQXe4zjOITFv7DkgpHdJX.', 'Daniel', 'Tan', 'male', '2013-06-25', 'N/A', 'Tikay, Malolos, Bulacan', '2025-06-22 03:49:53', '2025-09-15 17:32:51', 'dummy.jpg', 1224955175, 'active', NULL),
(17, 'student', 'sophia_santos.student', 'sophia.santos@email.com', '$2y$10$KEek95Y7gfl.7WplR9kPI.jOp2mGx/daQXe4zjOITFv7DkgpHdJX.', 'Sophia', 'Santos', 'female', '2017-11-05', 'N/A', 'Tabang, Guiguinto, Bulacan', '2025-06-24 02:49:33', '2025-07-15 18:56:45', 'dummy.jpg', NULL, 'active', NULL),
(21, 'student', 'isabella_navarro.student', 'isabella.navarro@email.com', '$2y$10$yZ/m1QREMDYg2ZUW/PmHhe4AbtCMNe2.P.bBsdSZVJOzmbZK/KI2i', 'Isabella', 'Navarro', 'female', '2013-03-08', 'N/A', 'Poblacion, San Rafael, Bulacan', '2025-06-25 01:37:50', '2025-07-15 18:56:45', 'dummy.jpg', NULL, 'active', NULL),
(22, 'student', 'mia_salazar.student', 'mia.salazar@email.com', '$2y$10$vYoAj4ApyumEBqYMxD0OhOijyRIrK6qgVf9xfmt6YomYL6X4nC3Z6', 'Mia', 'Salazar', 'female', '2019-02-17', 'N/A', 'Pag-asa, Obando, Bulacan', '2025-06-25 01:38:01', '2025-07-15 18:56:45', 'dummy.jpg', NULL, 'active', NULL),
(23, 'student', 'chloe_perez.student', 'floterina@gmail.com', '$2y$10$YlqqMHKXHEn4R5C21NjHa.SjRIW4WxYLgGIVhQj8mmBskyNnQ75M2', 'Chloe', 'Perez', 'female', '2016-09-09', 'N/A', 'Calvario, Meycauayan, Bulacan', '2025-06-25 01:38:37', '2025-07-15 18:56:45', 'dummy.jpg', NULL, 'active', NULL),
(24, 'student', 'ethan_de guzman.student', 'ethan.guzman@email.com', '$2y$10$DB0gVJBYB0bI/.4A25sqxO3yCu9CxziD8NZlansOmmuh8n3KNmauy', 'Ethan', 'De Guzman', 'male', '2018-04-22', 'N/A', 'San Pedro, Hagonoy, Bulacan', '2025-06-25 01:38:52', '2025-07-15 18:56:45', 'dummy.jpg', NULL, 'active', NULL),
(29, 'student', 'liam_cruz.student', 'liam.cruz@email.com', '$2y$10$3HOkXhZsZ9kExFqixs3m5erACjzIfyht17T/8doDQ4xZlibL/gcjS', 'Liam', 'Cruz', 'male', '2014-05-12', 'N/A', 'San Vicente, Malolos, Bulacan', '2025-07-03 18:54:21', '2025-08-20 08:48:27', 'dummy.jpg', NULL, 'active', NULL),
(30, 'student', 'noah_domingo.student', 'noah.domingo@email.com', '$2y$10$cb2ozimttNchSqW0yq7G5OuliBgMofPmgd8FHuAXmVqFTkFyFsXWG', 'Noah', 'Domingo', 'male', '2016-11-20', 'N/A', 'Borol 2nd, Balagtas, Bulacan', '2025-07-05 03:55:07', '2025-08-09 02:59:20', 'dummy.jpg', NULL, 'active', NULL),
(31, 'student', 'james_villanueva.student', 'james.villanueva@email.com', '$2y$10$Rt4IbaC4OeBRPXmf6KyNkOkA5VhLg3u0wcE3Y5M6EFDuHauN/VKJC', 'James', 'Villanueva', 'male', '2011-09-01', 'N/A', '', '2025-07-06 18:36:49', '2025-07-15 18:56:45', 'dummy.jpg', NULL, 'active', NULL),
(32, 'student', 'nathan_velasco.student', 'nathan.v@example.com', '$2y$10$YEIXYD8KAOz/1zTXj1BuRuaDvxupZVkGTniHzbNBpp4tqiqMDtybO', 'Nathan', 'Velasco', 'male', '2007-04-10', 'fb.com/nathan.v', '123 Main St', '2025-07-08 18:52:35', '2025-07-15 18:56:45', 'dummy.jpg', NULL, 'active', NULL),
(33, 'student', 'bianca_torres.student', 'bianca.t@example.com', '$2y$10$0dOlACpaEczDVCxTBe92dOxkfAx0eNPb.j4/R1Y4bexn/nQCdF3/e', 'Bianca', 'Torres', 'female', '2006-11-21', 'fb.com/bianca.t', '456 Lopez Ave', '2025-07-10 03:20:15', '2025-07-15 18:56:45', 'dummy.jpg', NULL, 'active', NULL),
(34, 'student', 'alvin_fernandez.student', 'galecandado@gmail.com', '$2y$10$YTl8vDJDcyPc5hk6Hvwl8.nKtrPvILrJ0pxfYtPS8ZgWSx0thdIE2', 'Matthew Sebastian', 'De Guzman', 'male', '2017-09-19', '', 'Loma de Gato, Marilao, Bulacan, Central Luzon, Block 15 Lot 28 Phase 1 Green Forbes Residences', '2025-07-10 03:20:34', '2025-07-15 18:56:45', 'dummy.jpg', NULL, 'active', NULL),
(35, 'student', 'ulysses_domingo.student', 'ulysses.d@example.com', '$2y$10$csCzr57WPRGCjmnKpSXgj.jYGuCU3pGoQFBlmorZLA1NPyTTuei3O', 'Ulysses', 'Domingo', 'male', '2007-03-12', 'fb.com/ulysses.d', '23 Mabuhay St', '2025-07-12 06:42:48', '2025-07-15 18:56:45', 'dummy.jpg', NULL, 'active', NULL),
(36, 'student', 'maceo cael_escalora.student', 'escalora.cj28@gmail.com', '$2y$10$kzp7yp/OuMV1sqdleON9y.uFSUOMNymvmBAdEKCLDZ3EZDeKDBmNi', 'Maceo Cael', 'Escalora', 'male', '2025-06-14', '', 'Santa Rosa I, Marilao, Bulacan, Central Luzon, B3 L2 Mary grace subd.', '2025-07-12 08:10:27', '2025-08-22 15:02:44', 'dummy.jpg', NULL, 'active', NULL),
(37, 'student', 'vanessa_tuazon.student', 'vanessa.t@example.com', '$2y$10$XaIJVj5Hgy8I7JyrGnWPdOzaz5XnWObSFM8Iy8EnzzIYZhxdoHVXO', 'Vanessa', 'Tuazon', 'female', '2006-05-01', 'fb.com/vanessa.t', '11 Mabini St', '2025-07-12 08:19:42', '2025-07-15 18:56:45', 'dummy.jpg', NULL, 'active', NULL),
(38, 'teacher', 'tan.teacher', 'tan@gmail.com', '$2y$10$uh2Usb5yLsmVFXtSkjtBH.hx9fWOM04QR6/Q0aS3hdMGRxMOoMyZa', 'Niña Francesca', 'Tan', 'female', '2000-07-12', '', 'Meycauayan, Bulacan', '2025-07-12 15:14:03', '2025-07-15 20:58:29', 'user_38_1752483132.png', NULL, 'active', 'Oral Communication'),
(39, 'teacher', 'mauricio.teacher', 'mauricio@gmail.com', '$2y$10$KEek95Y7gfl.7WplR9kPI.jOp2mGx/daQXe4zjOITFv7DkgpHdJX.', 'Roshane', 'Mauricio', 'female', '2000-07-12', '', 'Meycauayan, Bulacan', '2025-07-12 15:17:57', '2025-07-14 08:45:28', 'dummy.jpg', NULL, 'active', 'MK - Makabansa'),
(40, 'teacher', 'stephany.teacher', 'stephany.teacher@gmail.com', '$2y$10$KEek95Y7gfl.7WplR9kPI.jOp2mGx/daQXe4zjOITFv7DkgpHdJX.', 'Juan', 'Dela Cruz', 'female', '2025-07-12', '09122021211', 'Marilao, Bulacan', '2025-07-12 15:20:06', '2025-09-16 06:09:01', '1757496680_68c14568295bd.png', NULL, 'active', 'Core 1 - Oral Communication'),
(41, 'teacher', 'delara.teacher', 'delara@gmail.com', '$2y$10$nVP5lPueFtnhvkP5xOv2K.g3I4j.XQGa1.VIQwDC7c2bn2ynPnnc2', 'Ann Nicole', 'De Lara', 'female', '2025-07-12', '', 'Meycauayan, Bulacan', '2025-07-12 15:22:45', '2025-07-12 15:22:45', 'dummy.jpg', NULL, 'active', 'RL - Read and Literacy'),
(42, 'teacher', 'mancenido.teacher', 'mancenido@gmail.com', '$2y$10$XCe5y6sBwNBjeSODwMv9XO4gSrqvsIhsyZ6Z9kyrH/MAJr0AKWeHK', 'Kim', 'Mancenido', 'female', '2025-07-12', '', 'Meycauayan, Bulacan', '2025-07-12 15:24:43', '2025-07-12 15:24:43', 'dummy.jpg', NULL, 'active', 'Core 1 - Oral Communication'),
(43, 'teacher', 'agliam.teacher', 'agliam@gmail.com', '$2y$10$m/50Jsjk.R2dxqoiBP0PKOKfTDNoPB7V6wbrKd8Ji0gro9RZcYvbO', 'Rosilyn', 'Agliam', 'female', '2025-07-12', '', 'Meycauayan, Bulacan', '2025-07-12 15:29:20', '2025-07-12 15:29:20', 'dummy.jpg', NULL, 'active', 'Applied 1 - Research in Daily Life 1'),
(44, 'teacher', 'delmundo.teacher', 'delmundo@gmail.com', '$2y$10$lgW5SlOLXWrUkUAT58eGRugFkA16TctHxhlEOuBIP59PBtAogXWa6', 'Anna Lie', 'Del Mundo', 'female', '2025-07-12', '', 'Meycauayan, Bulacan', '2025-07-12 15:49:19', '2025-07-12 15:49:19', 'dummy.jpg', NULL, 'active', 'Fil - Filipino'),
(45, 'teacher', 'velasco.teacher', 'velasco@gmail.com', '$2y$10$FtNJH3xy9TV4IF0xEWb0E.PsG3XEQr09HQCwbNyq0UGTyImjj4..i', 'Ria', 'Velasco', 'female', '2025-07-12', '', 'Meycauayan, Bulacan', '2025-07-12 15:51:08', '2025-07-12 15:51:08', 'dummy.jpg', NULL, 'active', 'Scie - Science'),
(46, 'teacher', 'ala.teacher', 'ala@gmail.com', '$2y$10$8NCV3TQqMKAJhsOCCGZN6evutqpiYVGFV4cm/Qyrbgq.OBtzbJSyO', 'Leoncia', 'Ala', 'female', '2025-07-12', '', 'Meycauayan, Bulacan', '2025-07-12 15:53:04', '2025-07-12 15:53:04', 'dummy.jpg', NULL, 'active', 'Fil - Filipino'),
(47, 'teacher', 'talusig.teacher', 'talusig@gmail.com', '$2y$10$wtQUiR485dsFXIGcE8g9uu.gdvLYtOcKUhqt56frg4sJ0nnQakwKi', 'Karl Cedrick', 'Talusig', 'male', '2025-07-12', '', 'Meycauayan, Bulacan', '2025-07-12 15:56:22', '2025-07-12 15:56:22', 'dummy.jpg', NULL, 'active', 'GMRC - Good Manner and Right Conduct'),
(48, 'teacher', 'pahugot.teacher', 'pahugot@gmail.com', '$2y$10$j6A7E8QccEbd0CBjUdIhVuWePvK8V4o7zhlFgP4OZltLpLGHZ75qm', 'Ellie Ann Joy', 'Pahugot', 'female', '2025-07-12', '', 'Meycauayan, Bulacan', '2025-07-12 15:59:39', '2025-07-12 15:59:39', 'dummy.jpg', NULL, 'active', 'MAPEH - Music Arts - Physical Education and Health'),
(49, 'teacher', 'martinico.teacher', 'martinico@gmail.com', '$2y$10$c2HJmtwL157JnFUTPVVL8u42bD0JgXYXFkAGCX/zSFm4vZZFvGuIa', 'Jocelyn', 'Martinico', 'female', '2025-07-13', '', 'Meycauayan, Bulacan', '2025-07-12 16:00:40', '2025-07-12 16:00:40', 'dummy.jpg', NULL, 'active', 'Lang - Language'),
(50, 'teacher', 'delarosa.teacher', 'delarosa@gmail.com', '$2y$10$lSnylbvhr2AAyhTXfen2KucerTtndo4pkeZtDOV6ceOlLpdhEZYUC', 'Merck Justin', 'Dela Rosa', 'male', '2025-07-13', '', 'Meycauayan, Bulacan', '2025-07-12 16:02:08', '2025-07-12 16:02:08', 'dummy.jpg', NULL, 'active', 'Math - Mathematics'),
(51, 'teacher', 'navarro.teacher', 'navarro@gmail.com', '$2y$10$i/foiZYtbpHwQprQ2EUndOiUJ4g1GKkW9CxhU9JkxkdcEeUq3CxGa', 'Mark Edrian', 'Navarro', 'male', '2025-07-13', '', 'Meycauayan, Bulacan', '2025-07-12 16:05:30', '2025-07-12 16:05:30', 'dummy.jpg', NULL, 'active', 'AP - Araling Panlipunan'),
(52, 'student', 'yves_vergara.student', 'yves.v@example.com', '$2y$10$mYW3Zbj0qyQeaDS7pX4yjuvjVgtmb/BlZhftXvBG.XV2r1s.aXbW2', 'Yves', 'Vergara', 'male', '2007-09-21', 'fb.com/yves.v', '88 Rivera Rd', '2025-07-12 18:36:26', '2025-07-15 18:56:45', 'dummy.jpg', NULL, 'active', NULL),
(53, 'student', 'brianna_del mundo.student', 'brianna.d@example.com', '$2y$10$leKt.bcHCCPV7RnRiWD6K.nJdiDcdh6FBzXBe18.DBEXuDlzQO/A.', 'Brianna', 'Del Mundo', 'female', '2006-10-13', 'fb.com/brianna.d', '24 Ilocos Rd', '2025-07-12 19:47:19', '2025-07-15 18:56:45', 'dummy.jpg', NULL, 'active', NULL),
(54, 'student', 'daniella_gonzaga.student', 'daniella.g@example.com', '$2y$10$iNWAdONUMMOzU7H/ZROv5OV9kL9cB1/8xXAlSflVs5p8GTlsCkvD2', 'Daniella', 'Gonzaga', 'female', '2006-11-16', 'fb.com/daniella.g', '5 Hillside Rd', '2025-07-12 19:47:34', '2025-07-16 02:05:20', 'dummy.jpg', NULL, 'active', NULL),
(55, 'student', 'zaira_mercado.student', 'zaira.m@example.com', '$2y$10$/U0SXvHdigE9m7xlxFBUkuFfxahyyiAKYy4Gdpz6KFhkW71t.Usoa', 'Zaira', 'Mercado', 'female', '2006-04-25', 'fb.com/zaira.m', '9 Bautista St', '2025-07-12 19:48:23', '2025-07-15 18:56:45', 'dummy.jpg', NULL, 'active', NULL),
(56, 'student', 'caleb_lim.student', 'caleb.l@example.com', '$2y$10$mTazEx./ndKFyslQrKJ0G.Yw27Wnix4gqZJfOejjwO4viV4svFKnK', 'Caleb', 'Lim', 'male', '2007-12-05', 'fb.com/caleb.l', '16 Mango St', '2025-07-13 05:26:00', '2025-07-16 00:06:12', 'dummy.jpg', 1189264005, 'active', NULL),
(57, 'student', 'warren_lozano.student', 'warren.l@example.com', '$2y$10$wBoA21DHed69.h.vnmSew.HE5IKBUFkl0vl2qrJqJ2s9N172zHjc2', 'Warren', 'Lozano', 'male', '2007-06-14', 'fb.com/warren.l', '4 Kalayaan Rd', '2025-07-14 08:38:46', '2025-07-15 23:40:06', 'dummy.jpg', 1190446453, 'active', NULL),
(58, 'student', 'gavin_santiago.student', 'gavin.s@example.com', '$2y$10$YOIKk1azhEDjoWp6fFrUA.Gi5TKuubor7vwnmRu3BdB6eLeBHHNwO', 'Gavin', 'Santiago', 'male', '2007-01-20', 'fb.com/gavin.s', '202 Taguig Rd', '2025-07-15 12:28:37', '2025-07-15 23:21:08', 'dummy.png', 1226073813, 'active', NULL),
(59, 'student', 'nik_escalora.student', 'juliusbergania367@gmail.com', '$2y$10$KEek95Y7gfl.7WplR9kPI.jOp2mGx/daQXe4zjOITFv7DkgpHdJX.', 'nik', 'Escalora', 'male', '2025-07-16', '', 'Bambang, Bulacan, Bulacan, Central Luzon, 0437 Gavino Rd.', '2025-07-16 01:48:50', '2025-09-09 15:27:37', '', 1190562885, 'active', NULL);

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
-- Indexes for table `admission_old`
--
ALTER TABLE `admission_old`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `student_id` (`student_id`);

--
-- Indexes for table `announcement`
--
ALTER TABLE `announcement`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `assignments`
--
ALTER TABLE `assignments`
  ADD PRIMARY KEY (`assignment_id`);

--
-- Indexes for table `assignment_submissions`
--
ALTER TABLE `assignment_submissions`
  ADD PRIMARY KEY (`submission_id`);

--
-- Indexes for table `attendance`
--
ALTER TABLE `attendance`
  ADD PRIMARY KEY (`id`),
  ADD KEY `teacher_id` (`course_id`),
  ADD KEY `student_id` (`rfid`);

--
-- Indexes for table `class_schedule`
--
ALTER TABLE `class_schedule`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `course_students`
--
ALTER TABLE `course_students`
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
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `scholastic_records`
--
ALTER TABLE `scholastic_records`
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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=261;

--
-- AUTO_INCREMENT for table `admission_old`
--
ALTER TABLE `admission_old`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `announcement`
--
ALTER TABLE `announcement`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `assignments`
--
ALTER TABLE `assignments`
  MODIFY `assignment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `assignment_submissions`
--
ALTER TABLE `assignment_submissions`
  MODIFY `submission_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `attendance`
--
ALTER TABLE `attendance`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;

--
-- AUTO_INCREMENT for table `class_schedule`
--
ALTER TABLE `class_schedule`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `courses`
--
ALTER TABLE `courses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `course_students`
--
ALTER TABLE `course_students`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;

--
-- AUTO_INCREMENT for table `master_list`
--
ALTER TABLE `master_list`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=80;

--
-- AUTO_INCREMENT for table `payment`
--
ALTER TABLE `payment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT for table `scholastic_records`
--
ALTER TABLE `scholastic_records`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `sections`
--
ALTER TABLE `sections`
  MODIFY `section_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `student_information`
--
ALTER TABLE `student_information`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT for table `student_tuition`
--
ALTER TABLE `student_tuition`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

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
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
