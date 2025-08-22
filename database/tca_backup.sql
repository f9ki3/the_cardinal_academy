-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Aug 20, 2025 at 07:06 PM
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
(2, '120912091212', 'Juan', 'Dave', 'Dela Cruz', 'Old Student', 'male', 'Grade 3', '', '2017-02-12', 'Roman Catholic', 'Marilao, Bulacan', 7, 'Loma de Gato, Marilao, Bulacan, Central Luzon', NULL, NULL, NULL, NULL, 'Michael Alcaraz', 'N/A', 'N/A', 'Rosario Alacaraz', 'N/A', 'N/A', 'Rosario Alacaraz', 'N/A', '09120912091', 'enrolled', 'Q782454', '0', 'floterina@gmail.com', 'N/A', '2025-07-14 08:38:15', NULL, 1, 0, 0, 0, 1),
(3, '78129878129', 'Mary', 'Madrid', 'Espinosa', 'Old Student', 'male', 'Grade 7', '', '2000-02-22', 'Hindu', 'Bocaue, Bulacan', 12, 'Bundukan, Bocaue, Bulacan, Central Luzon', 'Central Luzon', 'Bulacan', 'Bocaue', 'Bundukan', 'Reynaldo Madrid', 'Businessman', '09120912091', 'Janella Madrid', 'N/A', 'N/A', 'Reynaldo Madrid', 'Businessman', '09120912091', 'enrolled', 'Q653061', '0', 'mary@gmail.com', 'N/A', '2025-07-07 16:26:03', NULL, 0, 0, 0, 0, 0),
(4, '782178217821', 'John', 'Mikers', 'Moore', 'Old Student', 'male', 'Grade 3', '', '2018-02-22', 'Roman Catholic', 'Marilao, Bulacan', 8, 'Loma de Gato, Marilao, Bulacan, Central Luzon', NULL, NULL, NULL, NULL, 'Reynaldo Madrid', 'Businessman', 'N/A', 'Janella Madrid', 'N/A', 'N/A', 'Reynaldo Madrid', 'Businessman', '09120912091', 'enrolled', 'Q503233', '0', 'floterina@gmail.com', 'N/A', '2025-07-07 19:02:39', NULL, 0, 0, 0, 0, 0),
(6, '556677889900', 'Mark', 'Joseph', 'Reyes', 'Old Student', 'male', 'Grade 4', '', '2015-03-10', 'Iglesia ni Cristo', 'Baliwag, Bulacan', 9, 'Poblacion, Baliwag, Bulacan', 'Central Luzon', 'Bulacan', 'Baliwag', 'Poblacion', 'Jose Reyes', 'Technician', '09178881235', 'Luz Reyes', 'Vendor', '09178883457', 'Luz Reyes', 'Vendor', '09178883457', 'enrolled', 'Q789123', '0', 'mark.reyes@email.com', 'N/A', '2025-07-08 18:42:50', NULL, 0, 0, 0, 0, 0),
(12, '221133445599', 'Liam', 'David', 'Cruz', 'New Student', 'male', 'Grade 4', '', '2014-05-12', 'Catholic', 'Malolos, Bulacan', 10, 'outer-space-mars-milky-way-123', NULL, NULL, NULL, NULL, 'Carlos Cruz', 'Driver', '09178881241', 'Emma Cruz', 'Vendor', '09178883463', 'Carlos Cruz', 'Driver', '09178881241', 'enrolled', 'Q998877', '09952970623', 'liam.cruz@email.com', 'N/A', '2025-07-07 19:10:06', NULL, 0, 0, 0, 0, 0),
(13, '991122334455', 'Isabella', 'Faye', 'Navarro', 'Old Student', 'female', 'Grade 5', '', '2013-03-08', 'Catholic', 'San Rafael, Bulacan', 11, 'Poblacion, San Rafael, Bulacan', 'Central Luzon', 'Bulacan', 'San Rafael', 'Poblacion', 'Dennis Navarro', 'Salesman', '09178881242', 'Clarisse Navarro', 'Clerk', '09178883464', 'Clarisse Navarro', 'Clerk', '09178883464', 'enrolled', 'Q556677', '0', 'isabella.navarro@email.com', 'N/A', '2025-07-07 16:26:39', NULL, 0, 0, 0, 0, 0),
(18, '112299887766', 'James', 'Oliver', 'Villanueva', 'Old Student', 'male', 'Grade 7', '', '2011-09-01', 'Catholic', 'Calumpit, Bulacan', 13, 'outer-space-mars-milky-way-123', NULL, NULL, NULL, NULL, 'Danilo Villanueva', 'Foremans', '09178881247', 'Evelyn Villanueva', 'Housewife', '09178883469', 'Danilo Villanueva', 'Foreman', '09178881247', 'enrolled', 'Q778866', '09952970623', 'james.villanueva@email.com', 'N/A', '2025-07-08 04:47:52', NULL, 0, 0, 0, 0, 0),
(35, '1234567890011', 'Nathan', 'Paul', 'Velasco', 'new', 'male', 'Grade 11', NULL, '2007-04-10', 'Catholic', 'Iloilo City', 17, '123 Main St', NULL, NULL, NULL, NULL, 'Marvin Velasco', 'Technician', '09171111222', 'Jenny Velasco', 'Teacher', '09172222333', 'Jenny Velasco', 'Teacher', '09172222333', 'enrolled', 'Q2025011', '09173333444', 'nathan.v@example.com', 'fb.com/nathan.v', '2025-07-08 18:52:35', NULL, 0, 0, 0, 0, 0),
(36, '1234567890012', 'Bianca', 'Rose', 'Torres', 'new', 'female', 'Grade 12', NULL, '2006-11-21', 'Catholic', 'Roxas City', 18, '456 Lopez Ave', 'Region VI', 'Capiz', 'Roxas City', 'Barangay B', 'Robert Torres', 'Driver', '09224445566', 'Linda Torres', 'Vendor', '09335556677', 'Tito Torres', 'Baker', '09446667788', 'enrolled', 'Q2025012', '09174444555', 'bianca.t@example.com', 'fb.com/bianca.t', '2025-07-10 03:20:15', 'HUMSS', 0, 0, 0, 0, 0),
(37, '1234567890013', 'Cedric', 'Jose', 'Villanueva', 'returnee', 'male', 'Grade 11', NULL, '2007-03-15', 'Christian', 'Bacolod', 17, '789 Mabini St', 'Region VI', 'Negros Occidental', 'Bacolod City', 'Barangay C', 'Joel Villanueva', 'Mechanic', '09551112233', 'Melody Villanueva', 'Cashier', '09662223344', NULL, NULL, NULL, 'pending', 'Q2025013', '09175555666', 'cedric.v@example.com', 'fb.com/cedric.v', '2025-07-08 18:50:20', 'TVL', 0, 0, 0, 0, 0),
(38, '1234567890014', 'Danica', 'Faith', 'Alvarez', 'new', 'female', 'Grade 12', NULL, '2006-08-08', 'Iglesia', 'Dagupan', 18, '101 Rizal St', 'Region I', 'Pangasinan', 'Dagupan City', 'Barangay D', 'Arnold Alvarez', 'Fisherman', '09176666777', 'Elena Alvarez', 'Housewife', '09287777888', 'Auntie Alvarez', 'Seamstress', '09398888999', 'pending', 'Q2025014', '09179990000', 'danica.a@example.com', 'fb.com/danica.a', '2025-07-08 18:50:20', 'ABM', 0, 0, 0, 0, 0),
(39, '1234567890015', 'Erickson', 'James', 'Ramirez', 'new', 'male', 'Grade 11', NULL, '2007-07-19', 'Born Again', 'Antipolo', 17, '23 Sunrise Dr', 'Region IV-A', 'Rizal', 'Antipolo City', 'Barangay E', 'Antonio Ramirez', 'Electrician', '09229991122', 'Sheila Ramirez', 'Cook', '09330002233', NULL, NULL, NULL, 'pending', 'Q2025015', '09174441122', 'erickson.r@example.com', 'fb.com/erickson.r', '2025-07-08 18:50:20', 'GAS', 0, 0, 0, 0, 0),
(40, '1234567890016', 'Fiona', 'Mae', 'Ignacio', 'returnee', 'female', 'Grade 12', NULL, '2006-12-12', 'Catholic', 'Lucena', 18, '17 Garden Lane', 'Region IV-A', 'Quezon', 'Lucena City', 'Barangay F', 'Daniel Ignacio', 'Driver', '09443334455', 'Irene Ignacio', 'Saleslady', '09554445566', 'Tita Ignacio', 'Teacher', '09665556677', 'pending', 'Q2025016', '09173337788', 'fiona.i@example.com', 'fb.com/fiona.i', '2025-07-08 18:50:20', 'STEM', 0, 0, 0, 0, 0),
(41, '1234567890017', 'Gavin', 'Luke', 'Santiago', 'new', 'male', 'Grade 11', NULL, '2007-01-20', 'Christian', 'Taguig', 17, '202 Taguig Rd', 'NCR', 'Metro Manila', 'Taguig', 'Barangay G', 'Jorge Santiago', 'Security Guard', '09336667788', 'Maribel Santiago', 'Vendor', '09447778899', NULL, NULL, NULL, 'enrolled', 'Q2025017', '09172229911', 'gavin.s@example.com', 'fb.com/gavin.s', '2025-07-15 12:28:37', 'ICT', 0, 0, 0, 0, 0),
(42, '1234567890018', 'Hazel', 'Lyn', 'Padilla', 'new', 'female', 'Grade 12', NULL, '2006-02-17', 'Christian', 'San Juan', 18, '98 Greenhill Rd', 'NCR', 'Metro Manila', 'San Juan', 'Barangay H', 'Patrick Padilla', 'Engineer', '09180001122', 'Julie Padilla', 'Teacher', '09291112233', 'Tito Padilla', 'Clerk', '09302223344', 'pending', 'Q2025018', '09183334455', 'hazel.p@example.com', 'fb.com/hazel.p', '2025-07-08 18:50:20', 'HUMSS', 0, 0, 0, 0, 0),
(43, '1234567890019', 'Ian', NULL, 'Domingo', 'new', 'male', 'Grade 11', NULL, '2007-06-01', 'Christian', 'Makati', 17, '150 Makati Ave', 'NCR', 'Metro Manila', 'Makati', 'Barangay I', 'Romeo Domingo', 'Janitor', '09225556677', 'Alicia Domingo', 'Housekeeper', '09336667788', 'Uncle Domingo', 'Plumber', '09447778899', 'pending', 'Q2025019', '09179991122', 'ian.d@example.com', 'fb.com/ian.d', '2025-07-08 18:50:20', 'TVL', 0, 0, 0, 0, 0),
(44, '1234567890020', 'Jasmine', 'Hope', 'Navarro', 'new', 'female', 'Grade 12', NULL, '2006-05-23', 'Catholic', 'Naga City', 18, '84 Mabolo St', 'Region V', 'Camarines Sur', 'Naga City', 'Barangay J', 'Marco Navarro', 'Technician', '09173335566', 'Rowena Navarro', 'Nurse', '09284446677', NULL, NULL, NULL, 'pending', 'Q2025020', '09170005566', 'jasmine.n@example.com', 'fb.com/jasmine.n', '2025-07-08 18:50:20', 'STEM', 0, 0, 0, 0, 0),
(45, '1234567890021', 'Kenneth', 'Noel', 'Ortiz', 'returnee', 'male', 'Grade 11', NULL, '2007-08-16', 'Catholic', 'Tuguegarao', 17, '12 Ortigas Rd', 'Region II', 'Cagayan', 'Tuguegarao City', 'Barangay K', 'Nelson Ortiz', 'Farmer', '09178889900', 'Mila Ortiz', 'Cashier', '09289990011', NULL, NULL, NULL, 'pending', 'Q2025021', '09176667788', 'kenneth.o@example.com', 'fb.com/kenneth.o', '2025-07-08 18:50:20', 'GAS', 0, 0, 0, 0, 0),
(46, '1234567890022', 'Lara', 'Joyce', 'Castro', 'new', 'female', 'Grade 12', NULL, '2006-03-30', 'Born Again', 'Calamba', 18, '404 Hillside Dr', 'Region IV-A', 'Laguna', 'Calamba', 'Barangay L', 'Victor Castro', 'Factory Worker', '09227778899', 'Bea Castro', 'Vendor', '09338889900', 'Lola Castro', 'Retired', '09449990011', 'pending', 'Q2025022', '09174445566', 'lara.c@example.com', 'fb.com/lara.c', '2025-07-08 18:50:20', 'ABM', 0, 0, 0, 0, 0),
(47, '1234567890023', 'Mico', 'Jared', 'Flores', 'new', 'male', 'Grade 11', NULL, '2007-10-11', 'Christian', 'Malolos', 17, '10 Flores St', 'Region III', 'Bulacan', 'Malolos', 'Barangay M', 'Alfredo Flores', 'Salesman', '09171112233', 'Diana Flores', 'Seamstress', '09282223344', NULL, NULL, NULL, 'pending', 'Q2025023', '09173334455', 'mico.f@example.com', 'fb.com/mico.f', '2025-07-08 18:50:20', 'STEM', 0, 0, 0, 0, 0),
(48, '1234567890024', 'Nina', 'Celeste', 'Yap', 'new', 'female', 'Grade 12', NULL, '2006-09-27', 'Catholic', 'Ormoc', 18, '99 Baybay St', 'Region VIII', 'Leyte', 'Ormoc City', 'Barangay N', 'Edwin Yap', 'Policeman', '09172223344', 'Cynthia Yap', 'Cook', '09283334455', 'Tita Yap', 'Teacher', '09394445566', 'pending', 'Q2025024', '09170001111', 'nina.y@example.com', 'fb.com/nina.y', '2025-07-08 18:50:20', 'HUMSS', 0, 0, 0, 0, 0),
(49, '1234567890025', 'Oscar', 'Leon', 'De Guzman', 'new', 'male', 'Grade 11', NULL, '2007-11-09', 'Muslim', 'Cotabato', 17, '36 Mindanao Ave', 'BARMM', 'Maguindanao', 'Cotabato City', 'Barangay O', 'Rashid De Guzman', 'Fisherman', '09229990022', 'Fatima De Guzman', 'Housewife', '09330001133', NULL, NULL, NULL, 'pending', 'Q2025025', '09179992233', 'oscar.d@example.com', 'fb.com/oscar.d', '2025-07-08 18:50:20', 'TVL', 0, 0, 0, 0, 0),
(50, '1234567890026', 'Phoebe', 'Elise', 'Salazar', 'returnee', 'female', 'Grade 12', NULL, '2006-01-03', 'Christian', 'Sorsogon', 18, '7 Coastal Rd', 'Region V', 'Sorsogon', 'Sorsogon City', 'Barangay P', 'Reynaldo Salazar', 'Tricycle Driver', '09221114455', 'Amelia Salazar', 'Vendor', '09332225566', 'Tita Salazar', 'Cashier', '09443336677', 'pending', 'Q2025026', '09170007788', 'phoebe.s@example.com', 'fb.com/phoebe.s', '2025-07-08 18:50:20', 'ABM', 0, 0, 0, 0, 0),
(51, '1234567890027', 'Quentin', 'Kyle', 'Fabian', 'new', 'male', 'Grade 11', NULL, '2007-12-06', 'Catholic', 'Butuan', 17, '2 Sunset Blvd', 'Region XIII', 'Agusan del Norte', 'Butuan City', 'Barangay Q', 'Benedict Fabian', 'Mechanic', '09225556677', 'Isabel Fabian', 'Laundry Woman', '09336667788', NULL, NULL, NULL, 'pending', 'Q2025027', '09179998888', 'quentin.f@example.com', 'fb.com/quentin.f', '2025-07-08 18:50:20', 'ICT', 0, 0, 0, 0, 0),
(52, '1234567890028', 'Rochelle', 'Hope', 'Manalo', 'new', 'female', 'Grade 12', NULL, '2006-07-18', 'Christian', 'Tarlac', 18, '5 Lakeview St', 'Region III', 'Tarlac', 'Tarlac City', 'Barangay R', 'Eric Manalo', 'Technician', '09179997766', 'Carmen Manalo', 'Vendor', '09288886655', NULL, NULL, NULL, 'pending', 'Q2025028', '09174443322', 'rochelle.m@example.com', 'fb.com/rochelle.m', '2025-07-08 18:50:20', 'STEM', 0, 0, 0, 0, 0),
(53, '1234567890029', 'Sean', 'Rey', 'Buenaventura', 'new', 'male', 'Grade 11', NULL, '2007-04-04', 'Catholic', 'Bataan', 17, '12 Sunflower St', 'Region III', 'Bataan', 'Balanga', 'Barangay S', 'Arturo Buenaventura', 'Welder', '09278889911', 'Louisa Buenaventura', 'Cashier', '09389990022', 'Tito Buenaventura', 'Seaman', '09490001133', 'pending', 'Q2025029', '09176665544', 'sean.b@example.com', 'fb.com/sean.b', '2025-07-08 18:50:20', 'GAS', 0, 0, 0, 0, 0),
(54, '1234567890030', 'Trisha', 'Nina', 'Reyes', 'returnee', 'female', 'Grade 12', NULL, '2006-10-29', 'Catholic', 'Legazpi', 18, '88 Sunrise Blvd', 'Region V', 'Albay', 'Legazpi City', 'Barangay T', 'Dario Reyes', 'Farmer', '09223334455', 'Beth Reyes', 'Housewife', '09334445566', 'Tita Reyes', 'Midwife', '09445556677', 'pending', 'Q2025030', '09179993322', 'trisha.r@example.com', 'fb.com/trisha.r', '2025-07-08 18:50:20', 'ABM', 0, 0, 0, 0, 0),
(55, '1234567890031', 'Ulysses', 'John', 'Domingo', 'new', 'male', 'Grade 11', NULL, '2007-03-12', 'Catholic', 'Cavite City', 17, '23 Mabuhay St', 'Region IV-A', 'Cavite', 'Cavite City', 'Barangay U', 'Eduardo Domingo', 'Driver', '09180001234', 'Mira Domingo', 'Housewife', '09290001234', NULL, NULL, NULL, 'enrolled', 'Q2025031', '09175553322', 'ulysses.d@example.com', 'fb.com/ulysses.d', '2025-07-12 06:42:48', 'STEM', 0, 0, 0, 0, 0),
(56, '1234567890032', 'Vanessa', 'Grace', 'Tuazon', 'new', 'female', 'Grade 12', NULL, '2006-05-01', 'Iglesia', 'Quezon City', 18, '11 Mabini St', 'NCR', 'Metro Manila', 'Quezon City', 'Barangay V', 'Roberto Tuazon', 'Technician', '09281112233', 'Clarissa Tuazon', 'Vendor', '09392223344', 'Tita Tuazon', 'Nurse', '09403334455', 'enrolled', 'Q2025032', '09174445577', 'vanessa.t@example.com', 'fb.com/vanessa.t', '2025-07-12 08:19:42', 'ABM', 0, 0, 0, 0, 0),
(57, '1234567890033', 'Warren', 'Paul', 'Lozano', 'returnee', 'male', 'Grade 11', NULL, '2007-06-14', 'Christian', 'Iligan City', 17, '4 Kalayaan Rd', 'Region X', 'Lanao del Norte', 'Iligan City', 'Barangay W', 'Jose Lozano', 'Welder', '09179994433', 'Angela Lozano', 'Cook', '09289995544', NULL, NULL, NULL, 'enrolled', 'Q2025033', '09173332211', 'warren.l@example.com', 'fb.com/warren.l', '2025-07-14 08:38:46', 'TVL', 0, 0, 0, 0, 0),
(58, '1234567890034', 'Xyra', 'Belle', 'Rodriguez', 'new', 'female', 'Grade 12', NULL, '2006-07-08', 'Catholic', 'Binan', 18, '43 Palma St', 'Region IV-A', 'Laguna', 'Biñan City', 'Barangay X', 'Andres Rodriguez', 'Engineer', '09172221111', 'Martha Rodriguez', 'Cashier', '09283334455', NULL, NULL, NULL, 'for_review', 'Q2025034', '09176665555', 'xyra.r@example.com', 'fb.com/xyra.r', '2025-07-12 08:15:42', 'GAS', 0, 0, 0, 0, 0),
(59, '1234567890035', 'Yves', 'Miguel', 'Vergara', 'new', 'male', 'Grade 11', NULL, '2007-09-21', 'Catholic', 'Olongapo', 17, '88 Rivera Rd', 'Region III', 'Zambales', 'Olongapo City', 'Barangay Y', 'Gregorio Vergara', 'Fisherman', '09220002211', 'Cynthia Vergara', 'Vendor', '09331113322', 'Uncle Vergara', 'Farmer', '09442224433', 'enrolled', 'Q2025035', '09174443311', 'yves.v@example.com', 'fb.com/yves.v', '2025-07-12 18:36:25', 'STEM', 0, 0, 0, 0, 0),
(60, '1234567890036', 'Zaira', 'Hope', 'Mercado', 'new', 'female', 'Grade 12', NULL, '2006-04-25', 'Christian', 'Tuguegarao', 18, '9 Bautista St', 'Region II', 'Cagayan', 'Tuguegarao City', 'Barangay Z', 'Hector Mercado', 'Tricycle Driver', '09175559988', 'Joan Mercado', 'Cashier', '09286667755', 'Lola Mercado', 'Retired', '09397778844', 'enrolled', 'Q2025036', '09179992200', 'zaira.m@example.com', 'fb.com/zaira.m', '2025-07-12 19:48:23', 'HUMSS', 0, 0, 0, 0, 0),
(61, '1234567890037', 'Alvin', 'Noel', 'Fernandez', 'new', 'male', 'Grade 11', NULL, '2007-08-04', 'Born Again', 'San Pedro', 17, '35 Malaya St', 'Region IV-A', 'Laguna', 'San Pedro City', 'Barangay AA', 'Tomas Fernandez', 'Plumber', '09178884411', 'Teresa Fernandez', 'Saleslady', '09289995522', 'Tito Fernandez', 'Technician', '09391116633', 'enrolled', 'Q2025037', '09172221100', 'alvin.f@example.com', 'fb.com/alvin.f', '2025-07-10 03:20:34', 'ICT', 0, 0, 0, 0, 0),
(62, '1234567890038', 'Brianna', 'Kate', 'Del Mundo', 'returnee', 'female', 'Grade 12', NULL, '2006-10-13', 'Catholic', 'Laoag', 18, '24 Ilocos Rd', 'Region I', 'Ilocos Norte', 'Laoag City', 'Barangay BB', 'Oscar Del Mundo', 'Janitor', '09179994455', 'Gloria Del Mundo', 'Cook', '09281115566', 'Tita Del Mundo', 'Cashier', '09382226677', 'enrolled', 'Q2025038', '09179990001', 'brianna.d@example.com', 'fb.com/brianna.d', '2025-07-12 19:47:19', 'ABM', 0, 0, 0, 0, 0),
(63, '1234567890039', 'Caleb', 'Josue', 'Lim', 'new', 'male', 'Grade 11', NULL, '2007-12-05', 'Christian', 'Puerto Princesa', 17, '16 Mango St', 'MIMAROPA', 'Palawan', 'Puerto Princesa', 'Barangay CC', 'Benjamin Lim', 'Boatman', '09224445511', 'Raquel Lim', 'Vendor', '09335556622', NULL, NULL, NULL, 'enrolled', 'Q2025039', '09175558800', 'caleb.l@example.com', 'fb.com/caleb.l', '2025-07-13 05:26:00', 'GAS', 0, 0, 0, 0, 0),
(64, '1234567890040', 'Daniella', 'Rae', 'Gonzaga', 'new', 'female', 'Grade 12', NULL, '2006-11-16', 'Iglesia', 'Bayombong', 18, '5 Hillside Rd', 'Region II', 'Nueva Vizcaya', 'Bayombong', 'Barangay DD', 'Arturo Gonzaga', 'Mechanic', '09225556677', 'Cristina Gonzaga', 'Clerk', '09336667788', 'Lola Gonzaga', 'Retired', '09447778899', 'enrolled', 'Q2025040', '09171112233', 'daniella.g@example.com', 'fb.com/daniella.g', '2025-07-12 19:47:34', 'STEM', 0, 0, 0, 0, 0),
(65, '1234567890041', 'Ezekiel', 'John', 'Agustin', 'returnee', 'male', 'Grade 11', NULL, '2007-01-28', 'Muslim', 'Cotabato', 17, '12 Mindanao Blvd', 'BARMM', 'Maguindanao', 'Cotabato City', 'Barangay EE', 'Samir Agustin', 'Fisherman', '09224447788', 'Fatima Agustin', 'Vendor', '09335558899', NULL, NULL, NULL, 'for_review', 'Q2025041', '09176665544', 'ezekiel.a@example.com', 'fb.com/ezekiel.a', '2025-07-13 05:23:34', 'TVL', 0, 0, 0, 0, 0),
(66, '1234567890042', 'Faith', 'Louise', 'Bernardo', 'new', 'female', 'Grade 12', NULL, '2006-02-14', 'Catholic', 'Tarlac City', 18, '33 Katipunan St', 'Region III', 'Tarlac', 'Tarlac City', 'Barangay FF', 'Carlos Bernardo', 'Carpenter', '09178886677', 'Nora Bernardo', 'Cashier', '09289997788', 'Tita Bernardo', 'Teacher', '09390008899', 'for_review', 'Q2025042', '09178889900', 'faith.b@example.com', 'fb.com/faith.b', '2025-07-13 05:23:52', 'HUMSS', 0, 0, 0, 0, 0),
(67, '1234567890043', 'Gideon', 'Luis', 'Reynoso', 'new', 'male', 'Grade 11', NULL, '2007-06-30', 'Christian', 'Tagum', 17, '76 Banana Ave', 'Region XI', 'Davao del Norte', 'Tagum City', 'Barangay GG', 'Luis Reynoso', 'Electrician', '09227778888', 'Rosa Reynoso', 'Vendor', '09338889999', NULL, NULL, NULL, 'for_review', 'Q2025043', '09170001122', 'gideon.r@example.com', 'fb.com/gideon.r', '2025-07-13 05:27:20', 'STEM', 0, 0, 0, 0, 0),
(68, '1234567890044', 'Hannah', 'Joy', 'Dela Vega', 'new', 'female', 'Grade 12', NULL, '2006-12-01', 'Catholic', 'General Santos', 18, '10 Tuna Blvd', 'Region XII', 'South Cotabato', 'General Santos', 'Barangay HH', 'Romeo Dela Vega', 'Fisherman', '09173334455', 'Agnes Dela Vega', 'Seamstress', '09284445566', NULL, NULL, NULL, 'approved', 'Q2025044', '09172221133', 'hannah.d@example.com', 'fb.com/hannah.d', '2025-07-13 05:36:17', 'GAS', 0, 0, 0, 0, 0),
(69, '1234567890045', 'Ivan', 'Rey', 'Carpio', 'returnee', 'male', 'Grade 11', NULL, '2007-04-02', 'Born Again', 'Calapan', 17, '12 Island View', 'MIMAROPA', 'Oriental Mindoro', 'Calapan City', 'Barangay II', 'Miguel Carpio', 'Technician', '09174445566', 'Rosa Carpio', 'Housewife', '09285556677', 'Tito Carpio', 'Electrician', '09396667788', 'pending', 'Q2025045', '09176668899', 'ivan.c@example.com', 'fb.com/ivan.c', '2025-07-08 19:26:54', 'ABM', 0, 0, 0, 0, 0),
(70, '', 'Maceo Cael', 'Lingamen', 'escalora', 'Old Student', 'male', 'Nursery', '', '2025-06-14', 'Roman Catholic', 'Joni Villanueva General Hospital', 4, 'Santa Rosa I, Marilao, Bulacan, Central Luzon, B3 L2 Mary grace subd.', 'Central Luzon', 'Bulacan', 'Marilao', 'Santa Rosa I', 'Cj Escalora', 'warehouse man', '09924866376', 'Jennisa Mae Lingamen', 'n/a', '09683725546', 'Stephanie Gale V. Candado', 'Housewife', '09683725546', 'enrolled', 'Q327858', '09092075700', 'escalora.cj28@gmail.com', NULL, '2025-07-12 08:10:27', NULL, 0, 0, 0, 0, 0),
(74, '000000000001', 'Cristy', NULL, 'Tan', 'Old Student', 'female', 'Grade 2', '', '2025-07-13', 'Catholic', 'Laguna', 7, 'Cadoldolan, Sibalom, Antique, Western Visayas, Patubig, Marilao, Bulacan', NULL, NULL, NULL, NULL, NULL, NULL, '09324163453', NULL, NULL, '09365541152', 'Sian Candado', 'N/A', '09764532163', 'for_review', 'Q183222', '09135959565', 'candadostephaniegalev.pdm@gmail.com', NULL, '2025-07-15 18:44:50', NULL, 1, 0, 0, 1, 0),
(80, '248191116540', 'nik', 'Azcueta', 'Escalora', 'Old Student', 'male', 'Grade 11', '', '2025-07-16', 'Roman Catholic', 'Caloocan City', 16, 'Bambang, Bulacan, Bulacan, Central Luzon, 0437 Gavino Rd.', 'Central Luzon', 'Bulacan', 'Bulacan', 'Bambang', 'cj escalora', 'N/A', '09102536751', 'step gandula', 'N/A', '09924866376', 'step candado', 'N/A', '09092075700', 'enrolled', 'Q031673', '09092075700', 'juliusbergania367@gmail.com', NULL, '2025-07-16 01:48:50', 'STEM', 0, 0, 0, 0, 0);

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
(26, 31, 'Core 3', 'General Mathematics', '8:00 AM-9:00 AM', 'Leoncia Ala', '101');

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
  `discount_value` double DEFAULT NULL,
  `birth_cert` tinyint(1) DEFAULT 0,
  `report_card` tinyint(1) DEFAULT 0,
  `good_moral` tinyint(1) DEFAULT 0,
  `id_pic` tinyint(1) DEFAULT 0,
  `esc_cert` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `enroll_form`
--

INSERT INTO `enroll_form` (`id`, `lrn`, `firstname`, `middlename`, `lastname`, `status`, `gender`, `grade_level`, `profile_picture`, `birthday`, `religion`, `place_of_birth`, `age`, `residential_address`, `region`, `province`, `municipal`, `barangay`, `father_name`, `father_occupation`, `father_contact`, `mother_name`, `mother_occupation`, `mother_contact`, `guardian_name`, `guardian_occupation`, `guardian_contact`, `admission_status`, `que_code`, `email`, `facebook`, `admission_date`, `payment_plan`, `downpayment`, `tuition_fee`, `miscellaneous`, `discount_type`, `discount`, `discount_value`, `birth_cert`, `report_card`, `good_moral`, `id_pic`, `esc_cert`) VALUES
(2, '120912091212', 'Juan', 'Dave', 'Dela Cruz', 'Old Student', 'male', 'Grade 3', '', '2017-02-12', 'Roman Catholic', '0', 7, 'Loma de Gato, Marilao, Bulacan, Central Luzon', 'Central Luzon', 'Bulacan', 'Marilao', 'Loma de Gato', 'Michael Alcaraz', 'N/A', 'N/A', 'Rosario Alacaraz', 'N/A', 'N/A', 'Rosario Alacaraz', 'N/A', '09120912091', 'approved', 'Q782454', 'floterina@gmail.com', 'N/A', '2025-06-22 11:15:59', 'Semestral', 2500, 24200.75, 15635.25, '', 0, 0, 0, 0, 0, 0, 0),
(3, '78129878129', 'Mary', 'Madrid', 'Espinosa', 'Old Student', 'male', 'Grade 7', '', '2000-02-22', 'Hindu', '0', 12, 'Bundukan, Bocaue, Bulacan, Central Luzon', 'Central Luzon', 'Bulacan', 'Bocaue', 'Bundukan', 'Reynaldo Madrid', 'Businessman', '09120912091', 'Janella Madrid', 'N/A', 'N/A', 'Reynaldo Madrid', 'Businessman', '09120912091', 'approved', 'Q653061', 'mary@gmail.com', 'N/A', '2025-06-22 11:19:52', 'Semestral', 2500, 29118, 15635.25, '', 0, 0, 0, 0, 0, 0, 0),
(4, '782178217821', 'John', 'Mikers', 'Moore', 'Old Student', 'male', 'Grade 3', '', '2018-02-22', 'Roman Catholic', '0', 8, 'Loma de Gato, Marilao, Bulacan, Central Luzon', 'Central Luzon', 'Bulacan', 'Marilao', 'Loma de Gato', 'Reynaldo Madrid', 'Businessman', 'N/A', 'Janella Madrid', 'N/A', 'N/A', 'Reynaldo Madrid', 'Businessman', '09120912091', 'approved', 'Q503233', 'floterina@gmail.com', 'N/A', '2025-06-22 11:43:05', 'Semestral', 2500, 24200.75, 15635.25, '', 0, 0, 0, 0, 0, 0, 0),
(6, '556677889900', 'Mark', 'Joseph', 'Reyes', 'Old Student', 'male', 'Grade 4', '', '2015-03-10', 'Iglesia ni Cristo', '0', 9, 'Poblacion, Baliwag, Bulacan', 'Central Luzon', 'Bulacan', 'Baliwag', 'Poblacion', 'Jose Reyes', 'Technician', '09178881235', 'Luz Reyes', 'Vendor', '09178883457', 'Luz Reyes', 'Vendor', '09178883457', 'approved', 'Q789123', 'mark.reyes@email.com', 'N/A', '2025-06-25 09:37:04', 'Semestral', 2500, 24752.75, 15635.25, '', 0, 0, 0, 0, 0, 0, 0),
(7, '112233445566', 'Sophia', 'Mae', 'Santos', 'New Student', 'female', 'Grade 2', '', '2017-11-05', 'Christian', '0', 7, 'Tabang, Guiguinto, Bulacan', 'Central Luzon', 'Bulacan', 'Guiguinto', 'Tabang', 'Mario Santos', 'Mechanic', '09178881236', 'Julia Santos', 'Teacher', '09178883458', 'Mario Santos', 'Mechanic', '09178881236', 'approved', 'Q456789', 'sophia.santos@email.com', 'N/A', '2025-06-24 10:49:32', 'Quarterly', 2500, 24200.75, 15635.25, '', 0, 0, 0, 0, 0, 0, 0),
(8, '998877665544', 'Daniel', 'Lee', 'Tan', 'Old Student', 'male', 'Grade 6', '', '2013-06-25', 'Buddhist', '0', 11, 'Tikay, Malolos, Bulacan', 'Central Luzon', 'Bulacan', 'Malolos', 'Tikay', 'Edward Tan', 'Engineer', '09178881237', 'Maria Tan', 'Nurse', '09178883459', 'Maria Tan', 'Nurse', '09266800704', 'approved', 'Q678901', 'daniel.tan@email.com', 'N/A', '2025-06-22 11:49:53', 'Quarterly', 2500, 24752.75, 15635.25, '', 0, 0, 0, 0, 0, 0, 0),
(11, '445566778899', 'Chloe', 'Anne', 'Perez', 'Old Student', 'female', 'Grade 2', '', '2016-09-09', 'Catholic', '0', 8, 'Calvario, Meycauayan, Bulacan', 'Central Luzon', 'Bulacan', 'Meycauayan', 'Calvario', 'Jonathan Perez', 'Electrician', '09178881240', 'Melanie Perez', 'Housewife', '09178883462', 'Melanie Perez', 'Housewife', '09178883462', 'approved', 'Q112233', 'chloe.perez@email.com', 'N/A', '2025-06-25 09:38:37', 'Semestral', 2500, 24200.75, 15635.25, '', 0, 0, 0, 0, 0, 0, 0),
(12, '221133445599', 'Liam', 'David', 'Cruz', 'New Student', 'male', 'Grade 4', '', '2014-05-12', 'Catholic', '0', 10, 'San Vicente, Malolos, Bulacan', 'Central Luzon', 'Bulacan', 'Malolos', 'San Vicente', 'Carlos Cruz', 'Driver', '09178881241', 'Emma Cruz', 'Vendor', '09178883463', 'Carlos Cruz', 'Driver', '09178881241', 'approved', 'Q998877', 'liam.cruz@email.com', 'N/A', '2025-07-04 02:54:21', 'Semestral', 2500, 24752.75, 15635.25, '', 0, 0, 0, 0, 0, 0, 0),
(13, '991122334455', 'Isabella', 'Faye', 'Navarro', 'Old Student', 'female', 'Grade 5', '', '2013-03-08', 'Catholic', '0', 11, 'Poblacion, San Rafael, Bulacan', 'Central Luzon', 'Bulacan', 'San Rafael', 'Poblacion', 'Dennis Navarro', 'Salesman', '09178881242', 'Clarisse Navarro', 'Clerk', '09178883464', 'Clarisse Navarro', 'Clerk', '09178883464', 'approved', 'Q556677', 'isabella.navarro@email.com', 'N/A', '2025-06-25 09:37:50', 'Semestral', 2500, 24752.75, 15635.25, '', 0, 0, 0, 0, 0, 0, 0),
(14, '889977665544', 'Noah', 'Enzo', 'Domingo', 'New Student', 'male', 'Grade 3', '', '2016-11-20', 'INC', '0', 8, 'Borol 2nd, Balagtas, Bulacan', 'Central Luzon', 'Bulacan', 'Balagtas', 'Borol 2nd', 'Mario Domingo', 'Technician', '09178881243', 'Ellen Domingo', 'N/A', '09178883465', 'Mario Domingo', 'Technician', '09178881243', 'approved', 'Q443322', 'noah.domingo@email.com', 'N/A', '2025-07-05 11:55:07', 'Semestral', 2500, 24200.75, 15635.25, '', 0, 0, 0, 0, 0, 0, 0),
(15, '778899112233', 'Ava', 'Joy', 'Flores', 'Old Student', 'female', 'Grade 6', '', '2012-08-10', 'Catholic', '0', 12, 'Longos, Pulilan, Bulacan', 'Central Luzon', 'Bulacan', 'Pulilan', 'Longos', 'Erwin Flores', 'Driver', '09178881244', 'Linda Flores', 'Teacher', '09178883466', 'Linda Flores', 'Teacher', '09266800704', 'approved', 'Q334455', 'ava.flores@email.com', 'N/A', '2025-06-22 11:43:53', 'Semestral', 2500, 24752.75, 15635.25, '', 0, 0, 0, 0, 0, 0, 0),
(16, '998866554433', 'Ethan', 'Kyle', 'De Guzman', 'New Student', 'male', 'Grade 2', '', '2018-04-22', 'Christian', '0', 7, 'San Pedro, Hagonoy, Bulacan', 'Central Luzon', 'Bulacan', 'Hagonoy', 'San Pedro', 'George De Guzman', 'Fisherman', '09178881245', 'Rowena De Guzman', 'Vendor', '09178883467', 'Rowena De Guzman', 'Vendor', '09178883467', 'approved', 'Q223344', 'ethan.guzman@email.com', 'N/A', '2025-06-25 09:38:52', 'Semestral', 2500, 24200.75, 15635.25, '', 0, 0, 0, 0, 0, 0, 0),
(17, '223344556677', 'Mia', 'Jade', 'Salazar', 'Old Student', 'female', 'Grade 1', '', '2019-02-17', 'Catholic', '0', 6, 'Pag-asa, Obando, Bulacan', 'Central Luzon', 'Bulacan', 'Obando', 'Pag-asa', 'Francis Salazar', 'Carpenter', '09178881246', 'Juliet Salazar', 'Seamstress', '09178883468', 'Juliet Salazar', 'Seamstress', '09178883468', 'approved', 'Q556699', 'mia.salazar@email.com', 'N/A', '2025-06-25 09:38:01', 'Semestral', 2500, 24200.75, 15635.25, '', 0, 0, 0, 0, 0, 0, 0),
(18, '112299887766', 'James', 'Oliver', 'Villanueva', 'Old Student', 'male', 'Grade 7', '', '2011-09-01', 'Catholic', '0', 13, NULL, NULL, NULL, NULL, NULL, 'Danilo Villanueva', 'Foremans', '09178881247', 'Evelyn Villanueva', 'Housewife', '09178883469', 'Danilo Villanueva', 'Foreman', '09178881247', 'approved', 'Q778866', 'james.villanueva@email.com', 'N/A', '2025-07-07 02:36:49', 'Quarterly', 2500, 29118, 15635.25, '', 0, 0, 0, 0, 0, 0, 0),
(35, '1234567890011', 'Nathan', 'Paul', 'Velasco', 'new', 'male', 'Grade 11', NULL, '2007-04-10', 'Catholic', '0', 17, '123 Main St', NULL, NULL, NULL, NULL, 'Marvin Velasco', 'Technician', '09171111222', 'Jenny Velasco', 'Teacher', '09172222333', 'Jenny Velasco', 'Teacher', '09172222333', 'approved', 'Q2025011', 'nathan.v@example.com', 'fb.com/nathan.v', '2025-07-09 02:52:35', 'Semestral', 2500, 0, 6980, '', 0, 0, 0, 0, 0, 0, 0),
(36, '1234567890012', 'Bianca', 'Rose', 'Torres', 'new', 'female', 'Grade 12', NULL, '2006-11-21', 'Catholic', '0', 18, '456 Lopez Ave', 'Region VI', 'Capiz', 'Roxas City', 'Barangay B', 'Robert Torres', 'Driver', '09224445566', 'Linda Torres', 'Vendor', '09335556677', 'Tito Torres', 'Baker', '09446667788', 'approved', 'Q2025012', 'bianca.t@example.com', 'fb.com/bianca.t', '2025-07-10 11:20:15', 'Quarterly', 2500, 0, 6980, '', 0, 0, 0, 0, 0, 0, 0),
(41, '1234567890017', 'Gavin', 'Luke', 'Santiago', 'new', 'male', 'Grade 11', NULL, '2007-01-20', 'Christian', '0', 17, '202 Taguig Rd', 'NCR', 'Metro Manila', 'Taguig', 'Barangay G', 'Jorge Santiago', 'Security Guard', '09336667788', 'Maribel Santiago', 'Vendor', '09447778899', NULL, NULL, NULL, 'approved', 'Q2025017', 'gavin.s@example.com', 'fb.com/gavin.s', '2025-07-15 12:28:37', 'Monthly', 2500, 0, 6980, '', 0, 50, 0, 0, 0, 0, 0),
(55, '1234567890031', 'Ulysses', 'John', 'Domingo', 'new', 'male', 'Grade 11', NULL, '2007-03-12', 'Catholic', '0', 17, '23 Mabuhay St', 'Region IV-A', 'Cavite', 'Cavite City', 'Barangay U', 'Eduardo Domingo', 'Driver', '09180001234', 'Mira Domingo', 'Housewife', '09290001234', NULL, NULL, NULL, 'approved', 'Q2025031', 'ulysses.d@example.com', 'fb.com/ulysses.d', '2025-07-12 06:42:48', 'Monthly', 2500, 0, 6980, '', 0, 0, 0, 0, 0, 0, 0),
(56, '1234567890032', 'Vanessa', 'Grace', 'Tuazon', 'new', 'female', 'Grade 12', NULL, '2006-05-01', 'Iglesia', '0', 18, '11 Mabini St', 'NCR', 'Metro Manila', 'Quezon City', 'Barangay V', 'Roberto Tuazon', 'Technician', '09281112233', 'Clarissa Tuazon', 'Vendor', '09392223344', 'Tita Tuazon', 'Nurse', '09403334455', 'approved', 'Q2025032', 'vanessa.t@example.com', 'fb.com/vanessa.t', '2025-07-12 08:19:42', 'Annual', 2500, 0, 6980, '', 0, 0, 0, 0, 0, 0, 0),
(57, '1234567890033', 'Warren', 'Paul', 'Lozano', 'returnee', 'male', 'Grade 11', NULL, '2007-06-14', 'Christian', '0', 17, '4 Kalayaan Rd', 'Region X', 'Lanao del Norte', 'Iligan City', 'Barangay W', 'Jose Lozano', 'Welder', '09179994433', 'Angela Lozano', 'Cook', '09289995544', NULL, NULL, NULL, 'for_review', 'Q2025033', 'warren.l@example.com', 'fb.com/warren.l', '2025-07-14 08:38:46', 'Semestral', 2500, 0, 6980, '', 0, 0, 0, 0, 0, 0, 0),
(59, '1234567890035', 'Yves', 'Miguel', 'Vergara', 'new', 'male', 'Grade 11', NULL, '2007-09-21', 'Catholic', '0', 17, '88 Rivera Rd', 'Region III', 'Zambales', 'Olongapo City', 'Barangay Y', 'Gregorio Vergara', 'Fisherman', '09220002211', 'Cynthia Vergara', 'Vendor', '09331113322', 'Uncle Vergara', 'Farmer', '09442224433', 'approved', 'Q2025035', 'yves.v@example.com', 'fb.com/yves.v', '2025-07-12 18:36:25', 'Monthly', 2500, 0, 6980, '', 0, 0, 0, 0, 0, 0, 0),
(60, '1234567890036', 'Zaira', 'Hope', 'Mercado', 'new', 'female', 'Grade 12', NULL, '2006-04-25', 'Christian', '0', 18, '9 Bautista St', 'Region II', 'Cagayan', 'Tuguegarao City', 'Barangay Z', 'Hector Mercado', 'Tricycle Driver', '09175559988', 'Joan Mercado', 'Cashier', '09286667755', 'Lola Mercado', 'Retired', '09397778844', 'approved', 'Q2025036', 'zaira.m@example.com', 'fb.com/zaira.m', '2025-07-12 19:48:23', 'Monthly', 2500, 0, 6980, '', 0, 0, 0, 0, 0, 0, 0),
(61, '1234567890037', 'Alvin', 'Noel', 'Fernandez', 'new', 'male', 'Grade 11', NULL, '2007-08-04', 'Born Again', '0', 17, '35 Malaya St', 'Region IV-A', 'Laguna', 'San Pedro City', 'Barangay AA', 'Tomas Fernandez', 'Plumber', '09178884411', 'Teresa Fernandez', 'Saleslady', '09289995522', 'Tito Fernandez', 'Technician', '09391116633', 'approved', 'Q2025037', 'alvin.f@example.com', 'fb.com/alvin.f', '2025-07-10 11:20:34', 'Monthly', 2500, 0, 6980, '', 0, 0, 0, 0, 0, 0, 0),
(62, '1234567890038', 'Brianna', 'Kate', 'Del Mundo', 'returnee', 'female', 'Grade 12', NULL, '2006-10-13', 'Catholic', '0', 18, '24 Ilocos Rd', 'Region I', 'Ilocos Norte', 'Laoag City', 'Barangay BB', 'Oscar Del Mundo', 'Janitor', '09179994455', 'Gloria Del Mundo', 'Cook', '09281115566', 'Tita Del Mundo', 'Cashier', '09382226677', 'approved', 'Q2025038', 'brianna.d@example.com', 'fb.com/brianna.d', '2025-07-12 19:47:19', 'Quarterly', 2500, 0, 6980, '', 0, 0, 0, 0, 0, 0, 0),
(63, '1234567890039', 'Caleb', 'Josue', 'Lim', 'new', 'male', 'Grade 11', NULL, '2007-12-05', 'Christian', '0', 17, '16 Mango St', 'MIMAROPA', 'Palawan', 'Puerto Princesa', 'Barangay CC', 'Benjamin Lim', 'Boatman', '09224445511', 'Raquel Lim', 'Vendor', '09335556622', NULL, NULL, NULL, 'approved', 'Q2025039', 'caleb.l@example.com', 'fb.com/caleb.l', '2025-07-13 05:26:00', 'Quarterly', 2500, 0, 6980, '', 0, 0, 0, 0, 0, 0, 0),
(64, '1234567890040', 'Daniella', 'Rae', 'Gonzaga', 'new', 'female', 'Grade 12', NULL, '2006-11-16', 'Iglesia', '0', 18, '5 Hillside Rd', 'Region II', 'Nueva Vizcaya', 'Bayombong', 'Barangay DD', 'Arturo Gonzaga', 'Mechanic', '09225556677', 'Cristina Gonzaga', 'Clerk', '09336667788', 'Lola Gonzaga', 'Retired', '09447778899', 'approved', 'Q2025040', 'daniella.g@example.com', 'fb.com/daniella.g', '2025-07-12 19:47:34', 'Semestral', 2500, 0, 6980, '', 0, 0, 0, 0, 0, 0, 0),
(70, '', 'Maceo Cael', 'Lingamen', 'escalora', 'Old Student', 'male', 'Nursery', '', '2025-06-14', 'Roman Catholic', '0', 4, 'Santa Rosa I, Marilao, Bulacan, Central Luzon, B3 L2 Mary grace subd.', 'Central Luzon', 'Bulacan', 'Marilao', 'Santa Rosa I', 'Cj Escalora', 'warehouse man', '09924866376', 'Jennisa Mae Lingamen', 'n/a', '09683725546', 'Stephanie Gale V. Candado', 'Housewife', '09683725546', 'approved', 'Q327858', 'escalora.cj28@gmail.com', NULL, '2025-07-12 08:10:27', 'Annual', 2500, 0, 6980, '', 0, 0, 0, 0, 0, 0, 0),
(80, '248191116540', 'nik', 'Azcueta', 'Escalora', 'Old Student', 'male', 'Grade 11', '', '2025-07-16', 'Roman Catholic', '0', 16, 'Bambang, Bulacan, Bulacan, Central Luzon, 0437 Gavino Rd.', 'Central Luzon', 'Bulacan', 'Bulacan', 'Bambang', 'cj escalora', 'N/A', '09102536751', 'step gandula', 'N/A', '09924866376', 'step candado', 'N/A', '09092075700', 'for_review', 'Q031673', 'juliusbergania367@gmail.com', NULL, '2025-07-16 01:48:50', 'Monthly', 2500, 0, 6980, '', 0, 0, 0, 0, 0, 0, 0);

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
(77, 19, 'Maceo Cael', 'Escalora', 'Male'),
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
  `registar_id` int(11) NOT NULL,
  `date` datetime DEFAULT current_timestamp(),
  `invoice_number` double NOT NULL,
  `reference_number` bigint(20) DEFAULT NULL,
  `transaction_fee` decimal(10,2) DEFAULT 0.00
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `payment`
--

INSERT INTO `payment` (`id`, `amount`, `payment`, `change`, `payment_type`, `proof`, `student_id`, `registar_id`, `date`, `invoice_number`, `reference_number`, `transaction_fee`) VALUES
(10, 775.55555555556, 800, 24.444444444440023, 'Cash', '', 34, 1, '2025-07-10 21:28:07', 3751440, 2975583815, 0.00),
(11, 775.55555555556, 800, 24.444444444440023, 'Cash', '', 34, 1, '2025-07-10 21:34:55', 8388351, 9946615128, 0.00),
(12, 775.55555555556, 800, 24.444444444440023, 'Cash', '', 34, 1, '2025-07-10 21:35:18', 5335291, 9016664113, 0.00),
(13, 775.55555555556, 800, 24.444444444440023, 'Cash', '', 34, 1, '2025-07-10 21:36:13', 1978460, 5532746423, 0.00),
(14, 775.55555555556, 800, 24.444444444440023, 'Cash', '', 34, 1, '2025-07-10 21:38:37', 2496776, 7368867897, 0.00),
(15, 775.55555555556, 1000, 224.44444444444002, 'Cash', '', 34, 1, '2025-07-10 21:41:18', 4828914, 8844958759, 0.00),
(18, 775.55555555556, 800, 24.444444444440023, 'Cash', '', 34, 1, '2025-07-10 21:43:51', 6585607, 9893143461, 0.00),
(19, 775.55555555556, 1000, 224.44444444444002, 'Cash', '', 34, 1, '2025-07-10 21:46:14', 4128074, 4259904907, 0.00),
(20, 775.55555555556, 800, 24.444444444440023, 'Cash', '', 34, 1, '2025-07-14 21:58:08', 7816147, 2487759482, 0.00),
(21, 1745, 2000, 255, 'Cash', '', 33, 1, '2025-07-13 22:13:08', 7798493, 7376478570, 0.00),
(22, 1745, 2000, 255, 'Cash', '', 33, 1, '2025-07-14 22:16:20', 3117094, 1645791749, 0.00),
(23, 1745, 2000, 255, 'Cash', '', 33, 1, '2025-07-14 22:16:31', 3321041, 1418996291, 0.00),
(24, 1745, 2000, 255, 'Cash', '', 33, 1, '2025-07-10 22:16:41', 8023013, 3790960142, 0.00),
(25, 19918, 20000, 82, 'Cash', '', 30, 1, '2025-07-15 03:05:58', 7657981, 4791217879, 0.00),
(26, 19918, 20000, 82, 'Cash', '', 30, 1, '2025-07-11 03:06:42', 3377055, 1275491926, 0.00),
(27, 19918, 20000, 82, 'Cash', '', 24, 1, '2025-07-11 03:59:36', 6376480, 5360319084, 0.00),
(28, 19918, 20000, 82, 'Cash', '', 24, 1, '2025-07-14 03:59:52', 2105422, 9123001795, 0.00),
(29, 19918, 20000, 82, 'Cash', '', 23, 1, '2025-07-11 04:30:12', 1044730, 6450032138, 0.00),
(30, 20194, 21000, 806, 'Cash', '', 29, 1, '2025-07-14 05:05:30', 7164943, 7039519230, 0.00),
(31, 20194, 21000, 791, 'GCash', '', 29, 1, '2025-07-07 05:12:30', 1058692, 56547812, 15.00),
(32, 9959, 10000, 41, 'Cash', '', 17, 1, '2025-07-11 05:13:40', 3560790, 6169998003, 0.00),
(33, 9959, 10000, 41, 'Cash', '', 17, 1, '2025-07-11 05:14:19', 2085043, 4013662264, 0.00),
(34, 10097, 11000, 903, 'Cash', '', 13, 1, '2025-07-11 05:20:14', 4020765, 1073648282, 0.00),
(35, 10097, 11000, 888, 'GCash', '', 13, 1, '2025-07-11 05:21:07', 1938231, 59912612, 15.00),
(36, 775.55555555556, 775.56, 0.00444444443996872, 'Cash', '', 55, 1, '2025-07-13 05:23:05', 3479336, 7093497606, 0.00),
(37, 775.55555555556, 800, 24.444444444440023, 'Cash', '', 35, 1, '2025-07-14 06:08:56', 7496864, 3747229411, 0.00),
(38, 775.55555555556, 1000, 224.44444444444002, 'Cash', '', 59, 1, '2025-07-19 05:31:25', 1248536, 3567646985, 0.00),
(39, 775.55555555556, 1000, 224.44444444444002, 'Cash', '', 59, 1, '2025-07-19 05:32:12', 4565969, 7629954295, 0.00),
(40, 775.55555555556, 1000, 224.44444444444002, 'Cash', '', 59, 1, '2025-07-19 05:32:32', 1958509, 1228570783, 0.00),
(41, 6980, 7000, 20, 'Cash', '', 36, 1, '2025-08-18 10:49:42', 5455761, 5500563505, 0.00),
(42, 775.55555555556, 1000, 224.44444444444002, 'Cash', '', 52, 1, '2025-08-20 16:35:47', 2973539, 1165822356, 0.00);

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
  `enrolled` int(11) NOT NULL,
  `school_year` varchar(20) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sections`
--

INSERT INTO `sections` (`section_id`, `section_name`, `grade_level`, `teacher_id`, `room`, `strand`, `capacity`, `enrolled`, `school_year`, `created_at`) VALUES
(15, 'Pelican', 'Kinder Garten', 38, '100', 'N/A', 20, 0, '2025-2026', '2025-07-12 15:36:54'),
(16, 'Heron', 'Kinder Garten', 38, '100', 'N/A', 20, 0, '2025-2026', '2025-07-12 15:37:14'),
(17, 'Diamond', 'Grade 1', 39, '101', 'N/A', 20, 0, '2025-2026', '2025-07-12 15:38:12'),
(18, 'Emerald', 'Grade 1', 39, '101', 'N/A', 20, 0, '2025-2026', '2025-07-12 15:39:06'),
(19, 'Moonstone', 'Grade 1', 39, '101', 'N/A', 20, 0, '2025-2026', '2025-07-12 15:39:32'),
(20, 'Topaz', 'Grade 2', 44, '102', 'N/A', 20, 0, '2025-2026', '2025-07-12 15:49:48'),
(21, 'Amethyst', 'Grade 2', 44, '102', 'N/A', 20, 0, '2025-2026', '2025-07-12 15:50:07'),
(22, 'Beryl', 'Grade 3', 45, '103', 'N/A', 25, 0, '2025-2026', '2025-07-12 15:51:43'),
(23, 'Pearl', 'Grade 3', 45, '103', 'N/A', 25, 0, '2025-2026', '2025-07-12 15:52:01'),
(24, 'Garnet', 'Grade 5', 41, '105', 'N/A', 20, 0, '2025-2026', '2025-07-12 15:54:58'),
(25, 'Ruby', 'Grade 8', 51, '108', 'N/A', 30, 0, '2025-2026', '2025-07-12 16:06:43'),
(26, 'Quartz', 'Grade 8', 51, '108', 'N/A', 30, 0, '2025-2026', '2025-07-12 16:07:01'),
(27, 'Alexandrite', 'Grade 9', 51, '109', 'N/A', 30, 0, '2025-2026', '2025-07-12 16:07:21'),
(28, 'Aquamarine', 'Grade 10', 51, '110', 'N/A', 30, 0, '2025-2026', '2025-07-12 16:08:11'),
(29, 'Zircon', 'Grade 10', 51, '110', 'N/A', 30, 0, '2025-2026', '2025-07-12 16:09:19'),
(30, 'ABM 11', 'Grade 11', 42, '111', 'ABM (Accountancy, Business and Management)', 30, 0, '2025-2026', '2025-07-12 16:10:06'),
(31, 'HUMSS 11', 'Grade 11', 42, '111', 'HUMMS (Humanities and Social Sciences)', 30, 0, '2025-2026', '2025-07-12 16:10:25'),
(32, 'STEM 11', 'Grade 11', 42, '111', 'STEM (Science, Technology, Engineering and Mathematics)', 30, 0, '2025-2026', '2025-07-12 16:10:52'),
(33, 'ABM 12 - Feldspar', 'Grade 12', 43, '112', 'ABM (Accountancy, Business and Management)', 30, 0, '2025-2026', '2025-07-12 16:11:17'),
(34, 'HUMSS 12', 'Grade 12', 43, '112', 'HUMMS (Humanities and Social Sciences)', 30, 0, '2025-2026', '2025-07-12 16:11:38'),
(35, 'STEM 12 - Sardonyx', 'Grade 12', 43, '112', 'STEM (Science, Technology, Engineering and Mathematics)', 30, 0, '2025-2026', '2025-07-12 16:12:11');

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
(36, 'student', 'maceo cael_escalora.student', 'escalora.cj28@gmail.com', '$2y$10$kzp7yp/OuMV1sqdleON9y.uFSUOMNymvmBAdEKCLDZ3EZDeKDBmNi', 'Maceo Cael', 'Escalora', 'male', '2025-06-14', '', 'Santa Rosa I, Marilao, Bulacan, Central Luzon, B3 L2 Mary grace subd.', '2025-07-12 08:10:27', '2025-07-16 00:19:25', 'dummy.jpg', NULL, 70, 'active', NULL, 19),
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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=81;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `master_list`
--
ALTER TABLE `master_list`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=80;

--
-- AUTO_INCREMENT for table `payment`
--
ALTER TABLE `payment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `sections`
--
ALTER TABLE `sections`
  MODIFY `section_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

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
