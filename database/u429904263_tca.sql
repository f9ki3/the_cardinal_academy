-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Feb 15, 2026 at 08:35 PM
-- Server version: 11.8.3-MariaDB-log
-- PHP Version: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `u429904263_tca`
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
(101, '', 'Juan Miguel', 'Santos', 'Cruz', 'New Student', 'male', 'Nursery', '', '2021-03-12', 'Islam', 'Meycauayan City, Bulacan', 4, '0028 Mabini Street, Grace Park Subdivision, Brgy. Pantoc, Meycauayan, Bulacan', 'Central Luzon', 'Bulacan', 'City of Meycauayan', 'Pantoc', 'Roberto Cruz', 'Construction Supervisor', '09123456001', 'Maria Elena Santos', 'Housewife', '09123456002', 'Maria Elena Santos', 'Housewife', '09123456002', 'pending', 'Q501201', '09123456001', 'juanmiguel.cruz@gmail.com', NULL, '2026-01-26 09:16:19', NULL, 0, 0, 0, 0, 0),
(102, '', 'Angela Marie', 'Flores', 'Dela Rosa', 'New Student', 'female', 'Nursery', '', '2021-06-21', 'Islam', 'Meycauayan City, Bulacan', 4, 'Unit 5, Rivera Compound, Brgy. Malhacan, Meycauayan, Bulacan', 'Central Luzon', 'Bulacan', 'City of Meycauayan', 'Malhacan', 'Dennis Dela Rosa', 'Delivery Driver', '09123456003', 'Lorna Flores', 'Vendor', '09123456004', 'Dennis Dela Rosa', 'Delivery Driver', '09123456003', 'pending', 'Q501202', '09123456003', 'angelamarie.delarosa@gmail.com', NULL, '2026-01-26 09:16:21', NULL, 0, 0, 0, 0, 0),
(103, '', 'Mark Anthony', 'Villanueva', 'Reyes', 'New Student', 'male', 'Nursery', '', '2021-09-09', 'Islam', 'Meycauayan City, Bulacan', 4, 'Block 9 Lot 4, Santo Niño St., Villa Mercedes Subd., Brgy. Camalig, Meycauayan, Bulacan', 'Central Luzon', 'Bulacan', 'City of Meycauayan', 'Camalig', 'Allan Reyes', 'Machine Operator', '09123456005', 'Jennifer Villanueva', 'Office Clerk', '09123456006', 'Eduardo Reyes', 'Security Guard', '09123456007', 'pending', 'Q501203', '09123456005', 'markanthony.reyes@gmail.com', NULL, '2026-01-26 09:16:23', NULL, 0, 0, 0, 0, 0),
(104, '', 'Princess Joy', 'Lim', 'Garcia', 'New Student', 'female', 'Nursery', '', '2021-01-30', 'Islam', 'Meycauayan City, Bulacan', 4, '14 Ilang-Ilang St., Brgy. Langka, Meycauayan, Bulacan', 'Central Luzon', 'Bulacan', 'City of Meycauayan', 'Langka', 'Eduardo Garcia', 'Small Business Owner', '09123456008', 'May Lim', 'Store Cashier', '09123456009', 'May Lim', 'Store Cashier', '09123456009', 'pending', 'Q501204', '09123456008', 'princessjoy.garcia@gmail.com', NULL, '2026-01-26 09:16:25', NULL, 0, 0, 0, 0, 0),
(105, '', 'Joshua Paul', 'Aquino', 'Mendoza', 'New Student', 'male', 'Nursery', '', '2021-11-18', 'Islam', 'Meycauayan City, Bulacan', 4, 'Phase 2 Lot 11, Greenfields Subd., Brgy. Iba, Meycauayan, Bulacan', 'Central Luzon', 'Bulacan', 'City of Meycauayan', 'Iba', 'Henry Mendoza', 'Warehouse Supervisor', '09123456010', 'Rose Aquino', 'Online Seller', '09123456011', 'Henry Mendoza', 'Warehouse Supervisor', '09123456010', 'pending', 'Q501205', '09123456010', 'joshuapaul.mendoza@gmail.com', NULL, '2026-01-26 09:16:35', NULL, 0, 0, 0, 0, 0),
(106, '', 'Alyssa Nicole', 'Gomez', 'Velasco', 'New Student', 'female', 'Nursery', '', '2021-04-07', 'Islam', 'Meycauayan City, Bulacan', 4, 'Blk 5 Lot 9, Villa Elena Subd., Brgy. Pantoc, Meycauayan, Bulacan', 'Central Luzon', 'Bulacan', 'City of Meycauayan', 'Pantoc', 'Leo Velasco', 'Electrician', '09123456012', 'Gina Velasco', 'Beautician', '09123456013', 'Gina Velasco', 'Beautician', '09123456013', 'pending', 'Q501206', '09123456012', 'alyssanicole.velasco@gmail.com', NULL, '2026-01-26 09:16:38', NULL, 0, 0, 0, 0, 0),
(107, '', 'John Matthew', 'Reyes', 'Alonzo', 'New Student', 'male', 'Nursery', '', '2021-05-14', 'Islam', 'Meycauayan City, Bulacan', 4, '22 Bonifacio St., Brgy. Langka, Meycauayan, Bulacan', 'Central Luzon', 'Bulacan', 'City of Meycauayan', 'Langka', 'Wilson Alonzo', 'Auto Mechanic', '09123456101', 'Marites Alonzo', 'Housewife', '09123456102', 'Wilson Alonzo', 'Auto Mechanic', '09123456101', 'pending', 'Q601301', '09123456101', 'johnmatthew.alonzo@gmail.com', NULL, '2026-01-26 09:16:40', NULL, 0, 0, 0, 0, 0),
(108, '', 'Bea Louise', 'Navarro', 'Santiago', 'New Student', 'female', 'Nursery', '', '2021-08-02', 'Islam', 'Meycauayan City, Bulacan', 4, 'Unit 10, San Jose Compound, Brgy. Malhacan, Meycauayan, Bulacan', 'Central Luzon', 'Bulacan', 'City of Meycauayan', 'Malhacan', 'Paolo Santiago', 'Sales Agent', '09123456103', 'Cristina Santiago', 'Online Seller', '09123456104', 'Cristina Santiago', 'Online Seller', '09123456104', 'approved', 'Q601302', '09123456103', 'bealouise.santiago@gmail.com', NULL, '2026-01-01 16:05:18', NULL, 0, 0, 0, 0, 0),
(112, '00000000000', 'Bryan Louie', 'Flores', 'Lacsamana', 'New Student', 'male', 'Nursery', '', '2020-09-07', 'Christian', 'Meycauayan City, Bulacan', 5, '34 Bonifacio St., Brgy. Iba, Meycauayan, Bulacan', NULL, NULL, NULL, NULL, 'Dennis Lacsamana', 'Warehouse Staff', '09123456203', 'Mercy Lacsamana', 'Sari-Sari Store Owner', '09123456204', 'Mercy Lacsamana', 'Sari-Sari Store Owner', '09123456204', 'pending', 'Q701402', '09123456203', 'bryanlouie.lacsamana@gmail.com', NULL, '2026-01-26 09:17:05', 'N/A', 1, 1, 1, 1, 1),
(113, '', 'Faith Nicole', 'Ramos', 'Manalo', 'New Student', 'female', 'Nursery', '', '2020-01-22', 'Born Again', 'Meycauayan City, Bulacan', 5, '48 Pacheco St., Brgy. Saluysoy, Meycauayan, Bulacan', 'Central Luzon', 'Bulacan', 'City of Meycauayan', 'Saluysoy', 'Allan Manalo', 'Forklift Operator', '09123456205', 'Cherry Manalo', 'Office Clerk', '09123456206', 'Cherry Manalo', 'Office Clerk', '09123456206', 'pending', 'Q701403', '09123456205', 'faithnicole.manalo@gmail.com', NULL, '2026-01-26 09:17:03', NULL, 0, 0, 0, 0, 0),
(114, '', 'John Steven', 'Cruz', 'Nobleza', 'New Student', 'male', 'Nursery', '', '2020-07-30', 'Roman Catholic', 'Meycauayan City, Bulacan', 5, '3 Zamora St., Brgy. Pandayan, Meycauayan, Bulacan', 'Central Luzon', 'Bulacan', 'City of Meycauayan', 'Pandayan', 'Victor Nobleza', 'Security Guard', '09123456207', 'Arlene Nobleza', 'Laundry Attendant', '09123456208', 'Arlene Nobleza', 'Laundry Attendant', '09123456208', 'pending', 'Q701404', '09123456207', 'johnsteven.nobleza@gmail.com', NULL, '2026-01-26 09:17:02', NULL, 0, 0, 0, 0, 0),
(115, '00000000000', 'Patrick Ryan', 'Tan', 'Ong', 'New Student', 'male', 'Nursery', '', '2020-11-11', 'Islam', 'Meycauayan City, Bulacan', 5, '20 Rizal St., Brgy. Camalig, Meycauayan, Bulacan', NULL, NULL, NULL, NULL, 'Richard Ong', 'Electronics Technician', '09123456209', 'Susan Ong', 'Bookkeeper', '09123456210', 'Susan Ong', 'Bookkeeper', '09123456210', 'pending', 'Q701405', '09123456209', 'patrickryan.ong@gmail.com', NULL, '2026-01-26 09:16:58', 'N/A', 1, 1, 1, 1, 1),
(120, '00000000000', 'Anne Christine', 'Bautista', 'Tolentino', 'New Student', 'female', 'Nursery', '', '2020-12-01', 'Roman Catholic', 'Meycauayan City, Bulacan', 5, '65 Zamora St., Brgy. Pandayan, Meycauayan, Bulacan', NULL, NULL, NULL, NULL, 'Dennis Tolentino', 'Factory Technician', '09123456219', 'Ruby Tolentino', 'HR Assistant', '09123456220', 'Ruby Tolentino', 'HR Assistant', '09123456220', 'approved', 'Q701410', '09123456219', 'annechristine.tolentino@gmail.com', NULL, '2026-01-01 16:34:51', 'N/A', 1, 1, 1, 1, 1),
(121, '', 'Daniel Joseph', 'Navarro', 'Bautista', 'New Student', 'male', 'Kinder', '', '2020-03-12', 'Catholic', 'Meycauayan, Bulacan', 5, '23 Sampaguita St., Brgy. Perez, Meycauayan, Bulacan', 'Central Luzon', 'Bulacan', 'City of Meycauayan', 'Perez', 'Leo Bautista', 'Construction Worker', '09170000001', 'Karen Navarro', 'Housewife', '09170000002', 'Karen Navarro', 'Housewife', '09170000002', 'pending', 'QK2001', '09170000001', 'daniel.bautista@gmail.com', NULL, '2026-01-10 05:01:53', NULL, 0, 0, 0, 0, 0),
(122, '', 'Samantha Lee', 'Chua', 'Tan', 'New Student', 'female', 'Kinder', '', '2020-07-05', 'Christian', 'Meycauayan, Bulacan', 5, 'Blk 3 Lot 8, Golden Acres Subd., Brgy. Calvario, Meycauayan, Bulacan', 'Central Luzon', 'Bulacan', 'City of Meycauayan', 'Calvario', 'Michael Tan', 'Business Owner', '09170000003', 'Vivian Chua', 'Accountant', '09170000004', 'Vivian Chua', 'Accountant', '09170000004', 'pending', 'QK2002', '09170000003', 'samantha.tan@gmail.com', NULL, '2026-01-10 05:02:00', NULL, 0, 0, 0, 0, 0),
(123, '', 'Christian Paolo', 'Ramirez', 'Torres', 'New Student', 'male', 'Kinder', '', '2020-01-28', 'Catholic', 'Meycauayan, Bulacan', 5, '45 Rizal Ave., Brgy. Sto. Niño, Meycauayan, Bulacan', 'Central Luzon', 'Bulacan', 'City of Meycauayan', 'Sto. Niño', 'Noel Torres', 'Driver', '09170000005', 'Liza Ramirez', 'Sales Clerk', '09170000006', 'Noel Torres', 'Driver', '09170000005', 'pending', 'QK2003', '09170000005', 'christian.torres@gmail.com', NULL, '2026-01-10 05:02:05', NULL, 0, 0, 0, 0, 0),
(124, '', 'Janelle Faith', 'Castillo', 'Soriano', 'New Student', 'female', 'Kinder', '', '2020-09-14', 'Born Again', 'Meycauayan, Bulacan', 5, 'Unit 2, Mabuhay Compound, Brgy. Hulo, Meycauayan, Bulacan', 'Central Luzon', 'Bulacan', 'City of Meycauayan', 'Hulo', 'Ramon Soriano', 'Factory Worker', '09170000007', 'Ruby Castillo', 'Housewife', '09170000008', 'Ruby Castillo', 'Housewife', '09170000008', 'pending', 'QK2004', '09170000007', 'janelle.soriano@gmail.com', NULL, '2026-01-10 05:02:09', NULL, 0, 0, 0, 0, 0),
(125, '', 'Kyle Andrew', 'Mercado', 'Pineda', 'New Student', 'male', 'Kinder', '', '2020-05-03', 'Catholic', 'Meycauayan, Bulacan', 5, '67 Dahlia St., Brgy. Saluysoy, Meycauayan, Bulacan', 'Central Luzon', 'Bulacan', 'City of Meycauayan', 'Saluysoy', 'Edwin Pineda', 'Tricycle Driver', '09170000009', 'Teresa Mercado', 'Vendor', '09170000010', 'Teresa Mercado', 'Vendor', '09170000010', 'pending', 'QK2005', '09170000009', 'kyle.pineda@gmail.com', NULL, '2026-01-10 05:02:15', NULL, 0, 0, 0, 0, 0),
(126, '', 'Ronald James', 'Peña', 'Herrera', 'New Student', 'male', 'Kinder', '', '2020-02-20', 'Catholic', 'Meycauayan, Bulacan', 5, '35 Narra St., Brgy. Perez, Meycauayan, Bulacan', 'Central Luzon', 'Bulacan', 'City of Meycauayan', 'Perez', 'Luis Herrera', 'Security Guard', '09170000011', 'Sonia Herrera', 'Housewife', '09170000012', 'Luis Herrera', 'Security Guard', '09170000011', 'pending', 'QK2006', '09170000011', 'ronald.herrera@gmail.com', NULL, '2026-01-10 05:02:21', NULL, 0, 0, 0, 0, 0),
(127, '', 'Faith Nicole', 'Delos Reyes', 'Ramos', 'New Student', 'female', 'Kinder', '', '2020-11-08', 'Christian', 'Meycauayan, Bulacan', 5, 'Phase 2 Lot 4, Evergreen Subd., Brgy. Calvario, Meycauayan, Bulacan', 'Central Luzon', 'Bulacan', 'City of Meycauayan', 'Calvario', 'Marvin Ramos', 'Warehouse Staff', '09170000013', 'Angelica Ramos', 'Housewife', '09170000014', 'Angelica Ramos', 'Housewife', '09170000014', 'pending', 'QK2007', '09170000013', 'faith.ramos@gmail.com', NULL, '2026-01-10 05:02:26', NULL, 0, 0, 0, 0, 0),
(128, '', 'Kenneth Louis', 'Valdez', 'Dizon', 'New Student', 'male', 'Kinder', '', '2020-06-17', 'Catholic', 'Meycauayan, Bulacan', 5, '14 Maligaya St., Brgy. Sto. Niño, Meycauayan, Bulacan', 'Central Luzon', 'Bulacan', 'City of Meycauayan', 'Sto. Niño', 'Oscar Dizon', 'Mechanic', '09170000015', 'Miriam Dizon', 'Housewife', '09170000016', 'Oscar Dizon', 'Mechanic', '09170000015', 'pending', 'QK2008', '09170000015', 'kenneth.dizon@gmail.com', NULL, '2026-01-10 05:02:30', NULL, 0, 0, 0, 0, 0),
(129, '', 'Patricia Anne', 'Macapagal', 'Flores', 'New Student', 'female', 'Kinder', '', '2020-04-25', 'Catholic', 'Meycauayan, Bulacan', 5, 'Unit 3, San Antonio Compound, Brgy. Hulo, Meycauayan, Bulacan', 'Central Luzon', 'Bulacan', 'City of Meycauayan', 'Hulo', 'Joel Flores', 'Electrician', '09170000017', 'Sonia Flores', 'Housewife', '09170000018', 'Sonia Flores', 'Housewife', '09170000018', 'pending', 'QK2009', '09170000017', 'patricia.flores@gmail.com', NULL, '2026-01-10 05:02:33', NULL, 0, 0, 0, 0, 0),
(130, '', 'Bryan Matthew', 'Salazar', 'Cabrera', 'New Student', 'male', 'Kinder', '', '2020-08-30', 'Catholic', 'Meycauayan, Bulacan', 5, '59 Rosal St., Brgy. Saluysoy, Meycauayan, Bulacan', 'Central Luzon', 'Bulacan', 'City of Meycauayan', 'Saluysoy', 'Rico Cabrera', 'Factory Worker', '09170000019', 'Evelyn Cabrera', 'Housewife', '09170000020', 'Rico Cabrera', 'Factory Worker', '09170000019', 'pending', 'QK2010', '09170000019', 'bryan.cabrera@gmail.com', NULL, '2026-01-10 05:02:39', NULL, 0, 0, 0, 0, 0),
(131, '', 'John Paul', 'Cruz', 'Abad', 'New Student', 'male', 'Kinder', '', '2020-10-11', 'Catholic', 'Meycauayan, Bulacan', 5, '35 Pacheco St., Brgy. Saluysoy, Meycauayan, Bulacan', 'Central Luzon', 'Bulacan', 'City of Meycauayan', 'Saluysoy', 'Roger Abad', 'Vendor', '09170000021', 'Nancy Abad', 'Housewife', '09170000022', 'Nancy Abad', 'Housewife', '09170000022', 'pending', 'QK2011', '09170000021', 'john.abad@gmail.com', NULL, '2026-01-10 05:02:48', NULL, 0, 0, 0, 0, 0),
(132, '', 'Trisha Mae', 'Ramos', 'Balagtas', 'New Student', 'female', 'Kinder', '', '2020-12-02', 'Catholic', 'Meycauayan, Bulacan', 5, '15 Zamora St., Brgy. Pandayan, Meycauayan, Bulacan', 'Central Luzon', 'Bulacan', 'City of Meycauayan', 'Pandayan', 'Manny Balagtas', 'Driver', '09170000023', 'Teresa Balagtas', 'Housewife', '09170000024', 'Teresa Balagtas', 'Housewife', '09170000024', 'pending', 'QK2012', '09170000023', 'trisha.balagtas@gmail.com', NULL, '2026-01-10 05:02:54', NULL, 0, 0, 0, 0, 0),
(133, '', 'Mark Vincent', 'Flores', 'Cruz', 'New Student', 'male', 'Kinder', '', '2020-06-06', 'Catholic', 'Meycauayan, Bulacan', 5, '44 Rizal St., Brgy. Camalig, Meycauayan, Bulacan', 'Central Luzon', 'Bulacan', 'City of Meycauayan', 'Camalig', 'Joel Cruz', 'Carpenter', '09170000025', 'Liza Cruz', 'Housewife', '09170000026', 'Liza Cruz', 'Housewife', '09170000026', 'pending', 'QK2013', '09170000025', 'mark.cruz@gmail.com', NULL, '2026-01-10 05:02:58', NULL, 0, 0, 0, 0, 0),
(134, '', 'Princess Anne', 'Cruz', 'Delos Santos', 'New Student', 'female', 'Kinder', '', '2020-03-18', 'Catholic', 'Meycauayan, Bulacan', 5, '6 Mabini St., Brgy. Malhacan, Meycauayan, Bulacan', 'Central Luzon', 'Bulacan', 'City of Meycauayan', 'Malhacan', 'Jun Delos Santos', 'Factory Worker', '09170000027', 'Alma Delos Santos', 'Housewife', '09170000028', 'Alma Delos Santos', 'Housewife', '09170000028', 'pending', 'QK2014', '09170000027', 'princess.santos@gmail.com', NULL, '2026-01-10 05:03:04', NULL, 0, 0, 0, 0, 0),
(135, '', 'Nathaniel John', 'Santos', 'Espino', 'New Student', 'male', 'Kinder', '', '2020-01-09', 'Christian', 'Meycauayan, Bulacan', 5, '22 Luna St., Brgy. Perez, Meycauayan, Bulacan', 'Central Luzon', 'Bulacan', 'City of Meycauayan', 'Perez', 'Ramon Espino', 'Vendor', '09170000029', 'Cecilia Espino', 'Housewife', '09170000030', 'Cecilia Espino', 'Housewife', '09170000030', 'pending', 'QK2015', '09170000029', 'nathaniel.espino@gmail.com', NULL, '2026-01-10 05:03:10', NULL, 0, 0, 0, 0, 0),
(136, '', 'Lovely Joy', 'Cruz', 'Fernandez', 'New Student', 'female', 'Kinder', '', '2020-09-01', 'Catholic', 'Meycauayan, Bulacan', 5, '59 Bonifacio St., Brgy. Iba, Meycauayan, Bulacan', 'Central Luzon', 'Bulacan', 'City of Meycauayan', 'Iba', 'Ramon Fernandez', 'Driver', '09170000031', 'Jocelyn Fernandez', 'Housewife', '09170000032', 'Jocelyn Fernandez', 'Housewife', '09170000032', 'pending', 'QK2016', '09170000031', 'lovely.fernandez@gmail.com', NULL, '2026-01-10 05:03:14', NULL, 0, 0, 0, 0, 0),
(137, '', 'Bryan Keith', 'Ramos', 'Gamboa', 'New Student', 'male', 'Kinder', '', '2020-04-04', 'Catholic', 'Meycauayan, Bulacan', 5, '17 Pacheco St., Brgy. Saluysoy, Meycauayan, Bulacan', 'Central Luzon', 'Bulacan', 'City of Meycauayan', 'Saluysoy', 'Ben Gamboa', 'Construction Worker', '09170000033', 'Sheila Gamboa', 'Housewife', '09170000034', 'Sheila Gamboa', 'Housewife', '09170000034', 'pending', 'QK2017', '09170000033', 'bryan.gamboa@gmail.com', NULL, '2026-01-10 05:03:18', NULL, 0, 0, 0, 0, 0),
(138, '', 'Alyssa Mae', 'Flores', 'Herrera', 'New Student', 'female', 'Kinder', '', '2020-05-19', 'Catholic', 'Meycauayan, Bulacan', 5, '40 Zamora St., Brgy. Pandayan, Meycauayan, Bulacan', 'Central Luzon', 'Bulacan', 'City of Meycauayan', 'Pandayan', 'Victor Herrera', 'Technician', '09170000035', 'Maribel Herrera', 'Housewife', '09170000036', 'Maribel Herrera', 'Housewife', '09170000036', 'pending', 'QK2018', '09170000035', 'alyssa.herrera@gmail.com', NULL, '2026-01-10 05:03:22', NULL, 0, 0, 0, 0, 0),
(139, '', 'Sean Matthew', 'Cruz', 'Ibarra', 'New Student', 'male', 'Kinder', '', '2020-07-22', 'Christian', 'Meycauayan, Bulacan', 5, '28 Rizal St., Brgy. Camalig, Meycauayan, Bulacan', 'Central Luzon', 'Bulacan', 'City of Meycauayan', 'Camalig', 'Leo Ibarra', 'Delivery Rider', '09170000037', 'Grace Ibarra', 'Housewife', '09170000038', 'Grace Ibarra', 'Housewife', '09170000038', 'pending', 'QK2019', '09170000037', 'sean.ibarra@gmail.com', NULL, '2026-01-10 05:03:45', NULL, 0, 0, 0, 0, 0),
(140, '', 'Carl Joshua', 'Santos', 'Joven', 'New Student', 'male', 'Kinder', '', '2020-02-14', 'Catholic', 'Meycauayan, Bulacan', 5, '63 Mabini St., Brgy. Malhacan, Meycauayan, Bulacan', 'Central Luzon', 'Bulacan', 'City of Meycauayan', 'Malhacan', 'Mark Joven', 'Machine Operator', '09170000039', 'Susan Joven', 'Housewife', '09170000040', 'Susan Joven', 'Housewife', '09170000040', 'pending', 'QK2020', '09170000039', 'carl.joven@gmail.com', NULL, '2026-01-10 05:03:49', NULL, 0, 0, 0, 0, 0),
(151, '40085808011', 'Alyssa Kate', 'Cruz', 'Pascual', 'New Student', 'female', 'Grade 1', '', '2018-06-11', 'Catholic', 'Meycauayan, Bulacan', 6, '5 Rizal St., Brgy. Camalig, Meycauayan, Bulacan', 'Central Luzon', 'Bulacan', 'City of Meycauayan', 'Camalig', 'Dennis Pascual', 'Driver', '09181110022', 'Maribel Pascual', 'Housewife', '09181110023', 'Maribel Pascual', 'Housewife', '09181110023', 'approved', 'QG3011', '09181110022', 'alyssa.pascual@gmail.com', NULL, '2026-01-26 14:08:52', NULL, 0, 0, 0, 0, 0),
(171, '51234567011', 'Joshua Mark', 'Reyes', 'Castro', 'New Student', 'male', 'Grade 2', '', '2018-06-15', 'Roman Catholic', 'Meycauayan City, Bulacan', 7, '12 Mabini St., Brgy. Malhacan, Meycauayan, Bulacan', 'Central Luzon', 'Bulacan', 'City of Meycauayan', 'Malhacan', 'Rolando Castro', 'Welder', '09170000021', 'Maria Castro', 'Housewife', '09170000022', 'Maria Castro', 'Housewife', '09170000022', 'pending', 'Q171001', '09170000021', 'j.castro@gmail.com', NULL, '2026-01-10 09:00:00', NULL, 0, 0, 0, 0, 0),
(172, '51234567012', 'Ella Marie', 'Santos', 'Delos Reyes', 'New Student', 'female', 'Grade 2', '', '2018-06-15', 'Roman Catholic', 'Meycauayan City, Bulacan', 7, '21 Rizal St., Brgy. Camalig, Meycauayan, Bulacan', 'Central Luzon', 'Bulacan', 'City of Meycauayan', 'Camalig', 'Antonio Delos Reyes', 'Painter', '09170000023', 'Grace Delos Reyes', 'Manicurist', '09170000024', 'Grace Delos Reyes', 'Manicurist', '09170000024', 'pending', 'Q172001', '09170000023', 'e.delosreyes@gmail.com', NULL, '2026-01-10 09:00:00', NULL, 0, 0, 0, 0, 0),
(173, '51234567013', 'Mark Anthony', 'Lopez', 'Villanueva', 'New Student', 'male', 'Grade 2', '', '2018-06-15', 'Roman Catholic', 'Meycauayan City, Bulacan', 7, '33 Pacheco St., Brgy. Saluysoy, Meycauayan, Bulacan', 'Central Luzon', 'Bulacan', 'City of Meycauayan', 'Saluysoy', 'Joel Villanueva', 'Carpenter', '09170000025', 'Liza Villanueva', 'Vendor', '09170000026', 'Liza Villanueva', 'Vendor', '09170000026', 'pending', 'Q173001', '09170000025', 'm.villanueva@gmail.com', NULL, '2026-01-10 09:00:00', NULL, 0, 0, 0, 0, 0),
(174, '51234567014', 'Alyssa Joy', 'Cruz', 'Morales', 'New Student', 'female', 'Grade 2', '', '2018-06-15', 'Roman Catholic', 'Meycauayan City, Bulacan', 7, '50 Zamora St., Brgy. Pandayan, Meycauayan, Bulacan', 'Central Luzon', 'Bulacan', 'City of Meycauayan', 'Pandayan', 'Ricky Morales', 'Janitor', '09170000027', 'Jenny Morales', 'Housekeeper', '09170000028', 'Jenny Morales', 'Housekeeper', '09170000028', 'pending', 'Q174001', '09170000027', 'a.morales@gmail.com', NULL, '2026-01-10 09:00:00', NULL, 0, 0, 0, 0, 0),
(175, '51234567015', 'Nathan Kyle', 'Santos', 'Perez', 'New Student', 'male', 'Grade 2', '', '2018-06-15', 'Roman Catholic', 'Meycauayan City, Bulacan', 7, '8 Luna St., Brgy. Perez, Meycauayan, Bulacan', 'Central Luzon', 'Bulacan', 'City of Meycauayan', 'Perez', 'Edgar Perez', 'Messenger', '09170000029', 'Rosalie Perez', 'Cashier', '09170000030', 'Rosalie Perez', 'Cashier', '09170000030', 'pending', 'Q175001', '09170000029', 'n.perez@gmail.com', NULL, '2026-01-10 09:00:00', NULL, 0, 0, 0, 0, 0),
(176, '51234567016', 'Princess Anne', 'Garcia', 'Aquino', 'New Student', 'female', 'Grade 2', '', '2018-06-15', 'Roman Catholic', 'Meycauayan City, Bulacan', 7, '77 Bonifacio St., Brgy. Iba, Meycauayan, Bulacan', 'Central Luzon', 'Bulacan', 'City of Meycauayan', 'Iba', 'Ramon Aquino', 'Security Guard', '09170000031', 'Linda Aquino', 'Vendor', '09170000032', 'Linda Aquino', 'Vendor', '09170000032', 'pending', 'Q176001', '09170000031', 'p.aquino@gmail.com', NULL, '2026-01-10 09:00:00', NULL, 0, 0, 0, 0, 0),
(177, '51234567017', 'Christian Paul', 'Reyes', 'Lim', 'New Student', 'male', 'Grade 2', '', '2018-06-15', 'Roman Catholic', 'Meycauayan City, Bulacan', 7, '61 Mabini St., Brgy. Malhacan, Meycauayan, Bulacan', 'Central Luzon', 'Bulacan', 'City of Meycauayan', 'Malhacan', 'Steven Lim', 'Technician', '09170000033', 'Anna Lim', 'Office Staff', '09170000034', 'Anna Lim', 'Office Staff', '09170000034', 'pending', 'Q177001', '09170000033', 'c.lim@gmail.com', NULL, '2026-01-10 09:00:00', NULL, 0, 0, 0, 0, 0),
(178, '51234567018', 'Faith Nicole', 'Ramos', 'Bautista', 'New Student', 'female', 'Grade 2', '', '2018-06-15', 'Roman Catholic', 'Meycauayan City, Bulacan', 7, '19 Zamora St., Brgy. Pandayan, Meycauayan, Bulacan', 'Central Luzon', 'Bulacan', 'City of Meycauayan', 'Pandayan', 'Ronald Bautista', 'Driver', '09170000035', 'Marilyn Bautista', 'Housewife', '09170000036', 'Marilyn Bautista', 'Housewife', '09170000036', 'pending', 'Q178001', '09170000035', 'f.bautista@gmail.com', NULL, '2026-01-10 09:00:00', NULL, 0, 0, 0, 0, 0),
(179, '51234567019', 'Ethan James', 'Cruz', 'Domingo', 'New Student', 'male', 'Grade 2', '', '2018-06-15', 'Roman Catholic', 'Meycauayan City, Bulacan', 7, '70 Rizal St., Brgy. Camalig, Meycauayan, Bulacan', 'Central Luzon', 'Bulacan', 'City of Meycauayan', 'Camalig', 'Leo Domingo', 'Plumber', '09170000037', 'Melissa Domingo', 'Vendor', '09170000038', 'Melissa Domingo', 'Vendor', '09170000038', 'pending', 'Q179001', '09170000037', 'e.domingo@gmail.com', NULL, '2026-01-10 09:00:00', NULL, 0, 0, 0, 0, 0),
(180, '51234567020', 'Bianca Rose', 'Santos', 'Alvarez', 'New Student', 'female', 'Grade 2', '', '2018-06-15', 'Roman Catholic', 'Meycauayan City, Bulacan', 7, '25 Pacheco St., Brgy. Saluysoy, Meycauayan, Bulacan', 'Central Luzon', 'Bulacan', 'City of Meycauayan', 'Saluysoy', 'Marco Alvarez', 'Warehouse Helper', '09170000039', 'Janet Alvarez', 'Factory Worker', '09170000040', 'Janet Alvarez', 'Factory Worker', '09170000040', 'pending', 'Q180001', '09170000039', 'b.alvarez@gmail.com', NULL, '2026-01-10 09:00:00', NULL, 0, 0, 0, 0, 0),
(191, '61234567011', 'Earl Dominic', 'Cruz', 'Santiago', 'New Student', 'male', 'Grade 3', '', '2017-06-15', 'Roman Catholic', 'Meycauayan City, Bulacan', 8, '44 Diamond St., Brgy. Saluysoy, Meycauayan, Bulacan', 'Central Luzon', 'Bulacan', 'City of Meycauayan', 'Saluysoy', 'Oscar Santiago', 'Mechanic', '09180000022', 'Myrna Santiago', 'Vendor', '09180000023', 'Myrna Santiago', 'Vendor', '09180000023', 'pending', 'Q191001', '09180000022', 'e.santiago@gmail.com', NULL, '2026-01-10 10:00:00', NULL, 0, 0, 0, 0, 0),
(192, '61234567012', 'Anne Christine', 'Bautista', 'Tiamson', 'New Student', 'female', 'Grade 3', '', '2017-06-15', 'Roman Catholic', 'Meycauayan City, Bulacan', 8, '29 Sapphire St., Brgy. Pandayan, Meycauayan, Bulacan', 'Central Luzon', 'Bulacan', 'City of Meycauayan', 'Pandayan', 'Dennis Tiamson', 'Electrician', '09180000024', 'Ruby Tiamson', 'Office Staff', '09180000025', 'Ruby Tiamson', 'Office Staff', '09180000025', 'pending', 'Q192001', '09180000024', 'a.tiamson@gmail.com', NULL, '2026-01-10 10:00:00', NULL, 0, 0, 0, 0, 0),
(193, '61234567013', 'Joshua Mark', 'Ramos', 'Umali', 'New Student', 'male', 'Grade 3', '', '2017-06-15', 'Roman Catholic', 'Meycauayan City, Bulacan', 8, '58 Topaz St., Brgy. Camalig, Meycauayan, Bulacan', 'Central Luzon', 'Bulacan', 'City of Meycauayan', 'Camalig', 'Ben Umali', 'Warehouse Staff', '09180000026', 'Lorna Umali', 'Housewife', '09180000027', 'Lorna Umali', 'Housewife', '09180000027', 'pending', 'Q193001', '09180000026', 'j.umali@gmail.com', NULL, '2026-01-10 10:00:00', NULL, 0, 0, 0, 0, 0),
(194, '61234567014', 'Bianca Kate', 'Cruz', 'Villaseñor', 'New Student', 'female', 'Grade 3', '', '2017-06-15', 'Roman Catholic', 'Meycauayan City, Bulacan', 8, '7 Opal St., Brgy. Malhacan, Meycauayan, Bulacan', 'Central Luzon', 'Bulacan', 'City of Meycauayan', 'Malhacan', 'Eric Villaseñor', 'Painter', '09180000028', 'Joy Villaseñor', 'Vendor', '09180000029', 'Joy Villaseñor', 'Vendor', '09180000029', 'pending', 'Q194001', '09180000028', 'b.villasenor@gmail.com', NULL, '2026-01-10 10:00:00', NULL, 0, 0, 0, 0, 0),
(195, '61234567015', 'Paul Jeremiah', 'Flores', 'Yabut', 'New Student', 'male', 'Grade 3', '', '2017-06-15', 'Roman Catholic', 'Meycauayan City, Bulacan', 8, '83 Garnet St., Brgy. Perez, Meycauayan, Bulacan', 'Central Luzon', 'Bulacan', 'City of Meycauayan', 'Perez', 'Noel Yabut', 'Delivery Rider', '09180000030', 'Gina Yabut', 'Cashier', '09180000031', 'Gina Yabut', 'Cashier', '09180000031', 'pending', 'Q195001', '09180000030', 'p.yabut@gmail.com', NULL, '2026-01-10 10:00:00', NULL, 0, 0, 0, 0, 0),
(196, '61234567016', 'Kim Nicole', 'Santos', 'Zulueta', 'New Student', 'female', 'Grade 3', '', '2017-06-15', 'Roman Catholic', 'Meycauayan City, Bulacan', 8, '13 Amethyst St., Brgy. Iba, Meycauayan, Bulacan', 'Central Luzon', 'Bulacan', 'City of Meycauayan', 'Iba', 'Carlo Zulueta', 'IT Support', '09180000032', 'Marissa Zulueta', 'Office Clerk', '09180000033', 'Marissa Zulueta', 'Office Clerk', '09180000033', 'pending', 'Q196001', '09180000032', 'k.zulueta@gmail.com', NULL, '2026-01-10 10:00:00', NULL, 0, 0, 0, 0, 0),
(197, '61234567017', 'Mark John', 'Cruz', 'Alonzo', 'New Student', 'male', 'Grade 3', '', '2017-06-15', 'Roman Catholic', 'Meycauayan City, Bulacan', 8, '12 Pacheco St., Brgy. Saluysoy, Meycauayan, Bulacan', 'Central Luzon', 'Bulacan', 'City of Meycauayan', 'Saluysoy', 'Roberto Alonzo', 'Warehouse Supervisor', '09180000034', 'Teresa Alonzo', 'Housewife', '09180000035', 'Teresa Alonzo', 'Housewife', '09180000035', 'pending', 'Q197001', '09180000034', 'm.alonzo@gmail.com', NULL, '2026-01-10 10:00:00', NULL, 0, 0, 0, 0, 0),
(198, '61234567018', 'Anne Marie', 'Ramos', 'Bautista', 'New Student', 'female', 'Grade 3', '', '2017-06-15', 'Roman Catholic', 'Meycauayan City, Bulacan', 8, '8 Zamora St., Brgy. Pandayan, Meycauayan, Bulacan', 'Central Luzon', 'Bulacan', 'City of Meycauayan', 'Pandayan', 'Edwin Bautista', 'Truck Helper', '09180000036', 'Lorna Bautista', 'Vendor', '09180000037', 'Lorna Bautista', 'Vendor', '09180000037', 'pending', 'Q198001', '09180000036', 'a.bautista@gmail.com', NULL, '2026-01-10 10:00:00', NULL, 0, 0, 0, 0, 0),
(199, '61234567019', 'John Michael', 'Flores', 'Castillo', 'New Student', 'male', 'Grade 3', '', '2017-06-15', 'Roman Catholic', 'Meycauayan City, Bulacan', 8, '21 Rizal St., Brgy. Camalig, Meycauayan, Bulacan', 'Central Luzon', 'Bulacan', 'City of Meycauayan', 'Camalig', 'Noel Castillo', 'Carpenter', '09180000038', 'Marissa Castillo', 'Vendor', '09180000039', 'Marissa Castillo', 'Vendor', '09180000039', 'pending', 'Q199001', '09180000038', 'j.castillo@gmail.com', NULL, '2026-01-10 10:00:00', NULL, 0, 0, 0, 0, 0),
(200, '61234567020', 'Faith Joy', 'Cruz', 'Dizon', 'New Student', 'female', 'Grade 3', '', '2017-06-15', 'Roman Catholic', 'Meycauayan City, Bulacan', 8, '33 Mabini St., Brgy. Malhacan, Meycauayan, Bulacan', 'Central Luzon', 'Bulacan', 'City of Meycauayan', 'Malhacan', 'Ariel Dizon', 'Machine Operator', '09180000040', 'Gina Dizon', 'Factory Worker', '09180000041', 'Gina Dizon', 'Factory Worker', '09180000041', 'pending', 'Q200001', '09180000040', 'f.dizon@gmail.com', NULL, '2026-01-10 10:00:00', NULL, 0, 0, 0, 0, 0),
(211, '400858070311', 'Sean Matthew', 'Flores', 'Ibarra', 'New Student', 'male', 'Grade 4', '', '2015-04-14', 'Roman Catholic', 'Meycauayan City, Bulacan', 9, '62 Lapis St., Brgy. Camalig, Meycauayan, Bulacan', 'Central Luzon', 'Bulacan', 'City of Meycauayan', 'Camalig', 'Leo Ibarra', 'Machine Operator', '09123456731', 'Grace Ibarra', 'Housewife', '09123456732', 'Grace Ibarra', 'Housewife', '09123456732', 'pending', 'Q401211', '09123456733', 'sean.ibarra@gmail.com', NULL, '2025-12-17 02:02:42', NULL, 0, 0, 0, 0, 0),
(212, '400858070312', 'Carl Joshua', 'Cruz', 'Jalandoni', 'New Student', 'male', 'Grade 4', '', '2015-06-19', 'Roman Catholic', 'Meycauayan City, Bulacan', 9, '5 Quartz St., Brgy. Malhacan, Meycauayan, Bulacan', 'Central Luzon', 'Bulacan', 'City of Meycauayan', 'Malhacan', 'Mark Jalandoni', 'Forklift Operator', '09123456734', 'Susan Jalandoni', 'Factory Worker', '09123456735', 'Susan Jalandoni', 'Factory Worker', '09123456735', 'pending', 'Q401212', '09123456736', 'carl.jalandoni@gmail.com', NULL, '2025-12-17 02:02:42', NULL, 0, 0, 0, 0, 0),
(213, '400858070313', 'Denise Claire', 'Ramos', 'Kalaw', 'New Student', 'female', 'Grade 4', '', '2016-03-07', 'Roman Catholic', 'Meycauayan City, Bulacan', 9, '49 Beryl St., Brgy. Perez, Meycauayan, Bulacan', 'Central Luzon', 'Bulacan', 'City of Meycauayan', 'Perez', 'Joel Kalaw', 'Maintenance Worker', '09123456737', 'Lani Kalaw', 'Vendor', '09123456738', 'Lani Kalaw', 'Vendor', '09123456738', 'pending', 'Q401213', '09123456739', 'denise.kalaw@gmail.com', NULL, '2025-12-17 02:02:42', NULL, 0, 0, 0, 0, 0),
(214, '400858070314', 'Bryan Louie', 'Santos', 'Lising', 'New Student', 'male', 'Grade 4', '', '2015-10-11', 'Roman Catholic', 'Meycauayan City, Bulacan', 9, '22 Onyx St., Brgy. Iba, Meycauayan, Bulacan', 'Central Luzon', 'Bulacan', 'City of Meycauayan', 'Iba', 'Dennis Lising', 'Tricycle Driver', '09123456740', 'Mercy Lising', 'Sari-sari Store Owner', '09123456741', 'Mercy Lising', 'Sari-sari Store Owner', '09123456741', 'pending', 'Q401214', '09123456742', 'bryan.lising@gmail.com', NULL, '2025-12-17 02:02:42', NULL, 0, 0, 0, 0, 0),
(215, '400858070315', 'Faith Nicole', 'Cruz', 'Manrique', 'New Student', 'female', 'Grade 4', '', '2016-02-18', 'Roman Catholic', 'Meycauayan City, Bulacan', 9, '10 Coral St., Brgy. Saluysoy, Meycauayan, Bulacan', 'Central Luzon', 'Bulacan', 'City of Meycauayan', 'Saluysoy', 'Allan Manrique', 'Delivery Driver', '09123456743', 'Cherry Manrique', 'Online Seller', '09123456744', 'Cherry Manrique', 'Online Seller', '09123456744', 'pending', 'Q401215', '09123456745', 'faith.manrique@gmail.com', NULL, '2025-12-17 02:02:42', NULL, 0, 0, 0, 0, 0),
(216, '400858070316', 'John Steven', 'Flores', 'Nobleza', 'New Student', 'male', 'Grade 4', '', '2015-05-26', 'Roman Catholic', 'Meycauayan City, Bulacan', 9, '65 Amber St., Brgy. Pandayan, Meycauayan, Bulacan', 'Central Luzon', 'Bulacan', 'City of Meycauayan', 'Pandayan', 'Victor Nobleza', 'Warehouse Staff', '09123456746', 'Arlene Nobleza', 'Housewife', '09123456747', 'Arlene Nobleza', 'Housewife', '09123456747', 'pending', 'Q401216', '09123456748', 'john.nobleza@gmail.com', NULL, '2025-12-17 02:02:42', NULL, 0, 0, 0, 0, 0),
(217, '400858070317', 'Kevin Michael', 'Tan', 'Ong', 'New Student', 'male', 'Grade 4', '', '2015-09-03', 'Roman Catholic', 'Meycauayan City, Bulacan', 9, '90 Jade St., Brgy. Camalig, Meycauayan, Bulacan', 'Central Luzon', 'Bulacan', 'City of Meycauayan', 'Camalig', 'Richard Ong', 'Business Owner', '09123456749', 'Susan Ong', 'Account Clerk', '09123456750', 'Susan Ong', 'Account Clerk', '09123456750', 'pending', 'Q401217', '09123456751', 'kevin.ong@gmail.com', NULL, '2025-12-17 02:02:42', NULL, 0, 0, 0, 0, 0),
(218, '400858070318', 'Mikaela Faith', 'Cruz', 'Palarca', 'New Student', 'female', 'Grade 4', '', '2016-04-01', 'Roman Catholic', 'Meycauayan City, Bulacan', 9, '16 Crystal St., Brgy. Malhacan, Meycauayan, Bulacan', 'Central Luzon', 'Bulacan', 'City of Meycauayan', 'Malhacan', 'Joel Palarca', 'Machine Operator', '09123456752', 'Teresa Palarca', 'Factory Worker', '09123456753', 'Teresa Palarca', 'Factory Worker', '09123456753', 'pending', 'Q401218', '09123456754', 'mikaela.palarca@gmail.com', NULL, '2025-12-17 02:02:42', NULL, 0, 0, 0, 0, 0),
(219, '400858070319', 'Ivan Stephen', 'Ramos', 'Quejada', 'New Student', 'male', 'Grade 4', '', '2015-07-17', 'Roman Catholic', 'Meycauayan City, Bulacan', 9, '71 Pearl St., Brgy. Perez, Meycauayan, Bulacan', 'Central Luzon', 'Bulacan', 'City of Meycauayan', 'Perez', 'Nestor Quejada', 'Construction Foreman', '09123456755', 'Gina Quejada', 'Vendor', '09123456756', 'Gina Quejada', 'Vendor', '09123456756', 'pending', 'Q401219', '09123456757', 'ivan.quejada@gmail.com', NULL, '2025-12-17 02:02:42', NULL, 0, 0, 0, 0, 0),
(220, '400858070320', 'Princess Joy', 'Flores', 'Relucio', 'New Student', 'female', 'Grade 4', '', '2016-01-09', 'Roman Catholic', 'Meycauayan City, Bulacan', 9, '3 Ruby St., Brgy. Iba, Meycauayan, Bulacan', 'Central Luzon', 'Bulacan', 'City of Meycauayan', 'Iba', 'Rey Relucio', 'Painter', '09123456758', 'Mila Relucio', 'Housewife', '09123456759', 'Mila Relucio', 'Housewife', '09123456759', 'pending', 'Q401220', '09123456760', 'princess.relucio@gmail.com', NULL, '2025-12-17 02:02:42', NULL, 0, 0, 0, 0, 0),
(221, '40123456001', 'Angela Mae', 'Go', 'Yu', 'New Student', 'female', 'Grade 5', '', '2014-03-12', 'Roman Catholic', 'Meycauayan City, Bulacan', 10, '26 Jade St., Brgy. Perez, Meycauayan, Bulacan', NULL, NULL, NULL, NULL, 'Henry Yu', 'Business Owner', '09123456001', 'Lily Yu', 'Office Clerk', '09123456002', 'Lily Yu', 'Office Clerk', '09123456002', 'pending', 'Q402201', '09123456003', 'angela.yu@gmail.com', NULL, '2026-01-26 07:15:43', 'N/A', 1, 1, 1, 1, 1),
(231, '40123456011', 'Daniel James', 'Cruz', 'Lopez', 'New Student', 'male', 'Grade 5', '', '2014-03-10', 'Roman Catholic', 'Meycauayan City, Bulacan', 10, '15 Pearl St., Brgy. Perez, Meycauayan, Bulacan', 'Central Luzon', 'Bulacan', 'City of Meycauayan', 'Perez', 'Marco Lopez', 'Painter', '09123456031', 'Riza Lopez', 'Vendor', '09123456032', 'Riza Lopez', 'Vendor', '09123456032', 'pending', 'Q402211', '09123456033', 'daniel.lopez@gmail.com', NULL, '2025-12-17 02:02:42', NULL, 0, 0, 0, 0, 0),
(232, '40123456012', 'Bianca Rose', 'Flores', 'Santos', 'New Student', 'female', 'Grade 5', '', '2014-10-02', 'Roman Catholic', 'Meycauayan City, Bulacan', 10, '9 Quartz St., Brgy. Iba, Meycauayan, Bulacan', 'Central Luzon', 'Bulacan', 'City of Meycauayan', 'Iba', 'Oscar Santos', 'Security Guard', '09123456034', 'Myrna Santos', 'Laundry Attendant', '09123456035', 'Myrna Santos', 'Laundry Attendant', '09123456035', 'pending', 'Q402212', '09123456036', 'bianca.santos@gmail.com', NULL, '2025-12-17 02:02:42', NULL, 0, 0, 0, 0, 0),
(233, '40123456013', 'Joshua Mark', 'Ramos', 'Tejada', 'New Student', 'male', 'Grade 5', '', '2014-01-18', 'Roman Catholic', 'Meycauayan City, Bulacan', 10, '33 Garnet St., Brgy. Saluysoy, Meycauayan, Bulacan', 'Central Luzon', 'Bulacan', 'City of Meycauayan', 'Saluysoy', 'Ronnie Tejada', 'Driver', '09123456037', 'Celia Tejada', 'Vendor', '09123456038', 'Celia Tejada', 'Vendor', '09123456038', 'pending', 'Q402213', '09123456039', 'joshua.tejada@gmail.com', NULL, '2025-12-17 02:02:42', NULL, 0, 0, 0, 0, 0),
(234, '40123456014', 'Hannah Grace', 'Bautista', 'Domingo', 'New Student', 'female', 'Grade 5', '', '2014-06-21', 'Roman Catholic', 'Meycauayan City, Bulacan', 10, '18 Opal St., Brgy. Malhacan, Meycauayan, Bulacan', 'Central Luzon', 'Bulacan', 'City of Meycauayan', 'Malhacan', 'Joel Domingo', 'Technician', '09123456040', 'Cynthia Domingo', 'Office Aide', '09123456041', 'Cynthia Domingo', 'Office Aide', '09123456041', 'pending', 'Q402214', '09123456042', 'hannah.domingo@gmail.com', NULL, '2025-12-17 02:02:42', NULL, 0, 0, 0, 0, 0),
(235, '40123456015', 'Kevin John', 'Tan', 'Uy', 'New Student', 'male', 'Grade 5', '', '2014-09-09', 'Roman Catholic', 'Meycauayan City, Bulacan', 10, '27 Jade St., Brgy. Camalig, Meycauayan, Bulacan', 'Central Luzon', 'Bulacan', 'City of Meycauayan', 'Camalig', 'Henry Uy', 'Store Manager', '09123456043', 'Lily Uy', 'Cashier', '09123456044', 'Lily Uy', 'Cashier', '09123456044', 'pending', 'Q402215', '09123456045', 'kevin.uy@gmail.com', NULL, '2025-12-17 02:02:42', NULL, 0, 0, 0, 0, 0),
(236, '40123456016', 'Sophia Anne', 'Cruz', 'Torres', 'New Student', 'female', 'Grade 5', '', '2014-12-05', 'Roman Catholic', 'Meycauayan City, Bulacan', 10, '61 Ruby St., Brgy. Iba, Meycauayan, Bulacan', 'Central Luzon', 'Bulacan', 'City of Meycauayan', 'Iba', 'Eric Torres', 'Electrician', '09123456046', 'Vilma Torres', 'Housewife', '09123456047', 'Vilma Torres', 'Housewife', '09123456047', 'pending', 'Q402216', '09123456048', 'sophia.torres@gmail.com', NULL, '2025-12-17 02:02:42', NULL, 0, 0, 0, 0, 0),
(237, '40123456017', 'Ethan Paul', 'Flores', 'Cabrera', 'New Student', 'male', 'Grade 5', '', '2014-08-23', 'Roman Catholic', 'Meycauayan City, Bulacan', 10, '12 Crystal St., Brgy. Perez, Meycauayan, Bulacan', 'Central Luzon', 'Bulacan', 'City of Meycauayan', 'Perez', 'Rico Cabrera', 'Driver', '09123456049', 'Evelyn Cabrera', 'Vendor', '09123456050', 'Evelyn Cabrera', 'Vendor', '09123456050', 'pending', 'Q402217', '09123456051', 'ethan.cabrera@gmail.com', NULL, '2025-12-17 02:02:42', NULL, 0, 0, 0, 0, 0),
(238, '40123456018', 'Faith Joy', 'Cruz', 'Dizon', 'New Student', 'female', 'Grade 5', '', '2014-02-11', 'Roman Catholic', 'Meycauayan City, Bulacan', 10, '39 Topaz St., Brgy. Pandayan, Meycauayan, Bulacan', 'Central Luzon', 'Bulacan', 'City of Meycauayan', 'Pandayan', 'Ariel Dizon', 'Maintenance Worker', '09123456052', 'Gina Dizon', 'Factory Worker', '09123456053', 'Gina Dizon', 'Factory Worker', '09123456053', 'pending', 'Q402218', '09123456054', 'faith.dizon@gmail.com', NULL, '2025-12-17 02:02:42', NULL, 0, 0, 0, 0, 0),
(239, '40123456019', 'Miguel Aaron', 'Ramos', 'Torres', 'New Student', 'male', 'Grade 5', '', '2014-05-30', 'Roman Catholic', 'Meycauayan City, Bulacan', 10, '44 Beryl St., Brgy. Saluysoy, Meycauayan, Bulacan', 'Central Luzon', 'Bulacan', 'City of Meycauayan', 'Saluysoy', 'Eric Torres', 'Driver', '09123456055', 'Vilma Torres', 'Housewife', '09123456056', 'Vilma Torres', 'Housewife', '09123456056', 'pending', 'Q402219', '09123456057', 'miguel.torres@gmail.com', NULL, '2025-12-17 02:02:42', NULL, 0, 0, 0, 0, 0),
(240, '40123456020', 'Princess Mae', 'Cruz', 'Navarro', 'New Student', 'female', 'Grade 5', '', '2014-07-07', 'Roman Catholic', 'Meycauayan City, Bulacan', 10, '51 Citrine St., Brgy. Camalig, Meycauayan, Bulacan', 'Central Luzon', 'Bulacan', 'City of Meycauayan', 'Camalig', 'Joel Navarro', 'Warehouse Clerk', '09123456058', 'Teresa Navarro', 'Vendor', '09123456059', 'Teresa Navarro', 'Vendor', '09123456059', 'pending', 'Q402220', '09123456060', 'princess.navarro@gmail.com', NULL, '2025-12-17 02:02:42', NULL, 0, 0, 0, 0, 0),
(252, '40123456252', 'John Kenneth', 'Mendoza', 'Perez', 'New Student', 'male', 'Grade 6', '', '2013-04-01', 'Roman Catholic', 'Meycauayan City, Bulacan', 11, '70 Coral St., Brgy. Pandayan, Meycauayan, Bulacan', 'Central Luzon', 'Bulacan', 'City of Meycauayan', 'Pandayan', 'Alvin Perez', 'Maintenance Staff', '09123456274', 'Lorna Perez', 'Housewife', '09123456275', 'Lorna Perez', 'Housewife', '09123456275', 'pending', 'Q406252', '09123456276', 'john.perez@gmail.com', NULL, '2025-12-17 02:02:42', NULL, 0, 0, 0, 0, 0),
(253, '40123456253', 'Bea Nicole', 'Ramos', 'Quintos', 'New Student', 'female', 'Grade 6', '', '2013-06-19', 'Roman Catholic', 'Meycauayan City, Bulacan', 11, '16 Amber St., Brgy. Camalig, Meycauayan, Bulacan', 'Central Luzon', 'Bulacan', 'City of Meycauayan', 'Camalig', 'Daniel Quintos', 'Warehouse Checker', '09123456277', 'Alma Quintos', 'Vendor', '09123456278', 'Alma Quintos', 'Vendor', '09123456278', 'pending', 'Q406253', '09123456279', 'bea.quintos@gmail.com', NULL, '2025-12-17 02:02:42', NULL, 0, 0, 0, 0, 0),
(254, '40123456254', 'Miguel Aaron', 'Cruz', 'Rodriguez', 'New Student', 'male', 'Grade 6', '', '2013-09-28', 'Roman Catholic', 'Meycauayan City, Bulacan', 11, '47 Obsidian St., Brgy. Malhacan, Meycauayan, Bulacan', 'Central Luzon', 'Bulacan', 'City of Meycauayan', 'Malhacan', 'Noel Rodriguez', 'Forklift Operator', '09123456280', 'Teresa Rodriguez', 'Housewife', '09123456281', 'Teresa Rodriguez', 'Housewife', '09123456281', 'pending', 'Q406254', '09123456282', 'miguel.rodriguez@gmail.com', NULL, '2025-12-17 02:02:42', NULL, 0, 0, 0, 0, 0),
(255, '40123456255', 'Princess Mae', 'Bautista', 'Samson', 'New Student', 'female', 'Grade 6', '', '2013-12-12', 'Roman Catholic', 'Meycauayan City, Bulacan', 11, '9 Peridot St., Brgy. Perez, Meycauayan, Bulacan', 'Central Luzon', 'Bulacan', 'City of Meycauayan', 'Perez', 'Eric Samson', 'Electrician', '09123456283', 'Vilma Samson', 'Housewife', '09123456284', 'Vilma Samson', 'Housewife', '09123456284', 'pending', 'Q406255', '09123456285', 'princess.samson@gmail.com', NULL, '2025-12-17 02:02:42', NULL, 0, 0, 0, 0, 0),
(256, '40123456256', 'Vincent Paul', 'Flores', 'Torres', 'New Student', 'male', 'Grade 6', '', '2013-05-16', 'Roman Catholic', 'Meycauayan City, Bulacan', 11, '34 Zircon St., Brgy. Iba, Meycauayan, Bulacan', 'Central Luzon', 'Bulacan', 'City of Meycauayan', 'Iba', 'Oscar Torres', 'Warehouse Supervisor', '09123456286', 'Myrna Torres', 'Office Aide', '09123456287', 'Myrna Torres', 'Office Aide', '09123456287', 'pending', 'Q406256', '09123456288', 'vincent.torres@gmail.com', NULL, '2025-12-17 02:02:42', NULL, 0, 0, 0, 0, 0),
(257, '40123456257', 'Carlo James', 'Cruz', 'Uson', 'New Student', 'male', 'Grade 6', '', '2013-07-03', 'Roman Catholic', 'Meycauayan City, Bulacan', 11, '12 Jade St., Brgy. Saluysoy, Meycauayan, Bulacan', 'Central Luzon', 'Bulacan', 'City of Meycauayan', 'Saluysoy', 'Joel Uson', 'Delivery Driver', '09123456289', 'Rowena Uson', 'Vendor', '09123456290', 'Rowena Uson', 'Vendor', '09123456290', 'pending', 'Q406257', '09123456291', 'carlo.uson@gmail.com', NULL, '2025-12-17 02:02:42', NULL, 0, 0, 0, 0, 0),
(258, '40123456258', 'Kyla Anne', 'Santos', 'Valdez', 'New Student', 'female', 'Grade 6', '', '2013-01-29', 'Roman Catholic', 'Meycauayan City, Bulacan', 11, '55 Crystal St., Brgy. Pandayan, Meycauayan, Bulacan', 'Central Luzon', 'Bulacan', 'City of Meycauayan', 'Pandayan', 'Dennis Valdez', 'Truck Driver', '09123456292', 'Ruby Valdez', 'Housewife', '09123456293', 'Ruby Valdez', 'Housewife', '09123456293', 'pending', 'Q406258', '09123456294', 'kyla.valdez@gmail.com', NULL, '2025-12-17 02:02:42', NULL, 0, 0, 0, 0, 0),
(259, '40123456259', 'Ethan John', 'Lim', 'Wilson', 'New Student', 'male', 'Grade 6', '', '2013-10-19', 'Roman Catholic', 'Meycauayan City, Bulacan', 11, '91 Pearl St., Brgy. Camalig, Meycauayan, Bulacan', 'Central Luzon', 'Bulacan', 'City of Meycauayan', 'Camalig', 'Richard Wilson', 'Production Supervisor', '09123456295', 'Susan Wilson', 'Office Clerk', '09123456296', 'Susan Wilson', 'Office Clerk', '09123456296', 'pending', 'Q406259', '09123456297', 'ethan.wilson@gmail.com', NULL, '2025-12-17 02:02:42', NULL, 0, 0, 0, 0, 0),
(260, '40123456260', 'Bryan Keith', 'Cruz', 'Xandres', 'New Student', 'male', 'Grade 6', '', '2013-08-07', 'Roman Catholic', 'Meycauayan City, Bulacan', 11, '18 Ivory St., Brgy. Malhacan, Meycauayan, Bulacan', 'Central Luzon', 'Bulacan', 'City of Meycauayan', 'Malhacan', 'Manny Xandres', 'Warehouse Staff', '09123456298', 'Liza Xandres', 'Housewife', '09123456299', 'Liza Xandres', 'Housewife', '09123456299', 'pending', 'Q406260', '09123456300', 'bryan.xandres@gmail.com', NULL, '2025-12-17 02:02:42', NULL, 0, 0, 0, 0, 0),
(271, '40134568011', 'Kyle Patrick', 'Ramos', 'Estrella', 'New Student', 'male', 'Grade 7', '', '2012-05-14', 'Roman Catholic', 'Meycauayan City, Bulacan', 13, '19 Topaz St., Brgy. Camalig, Meycauayan, Bulacan', 'Central Luzon', 'Bulacan', 'City of Meycauayan', 'Camalig', 'Victor Estrella', 'Electrical Technician', '09145678031', 'Arlene Estrella', 'Office Staff', '09145678032', 'Arlene Estrella', 'Office Staff', '09145678032', 'pending', 'Q407271', '09145678033', 'kyle.estrella@gmail.com', NULL, '2025-12-17 02:05:10', NULL, 0, 0, 0, 0, 0),
(272, '40134568012', 'Anne Kristine', 'Cruz', 'Fernandez', 'New Student', 'female', 'Grade 7', '', '2012-07-22', 'Roman Catholic', 'Meycauayan City, Bulacan', 12, '64 Pearl St., Brgy. Malhacan, Meycauayan, Bulacan', 'Central Luzon', 'Bulacan', 'City of Meycauayan', 'Malhacan', 'Ramon Fernandez', 'Security Officer', '09145678034', 'Jocelyn Fernandez', 'Housewife', '09145678035', 'Jocelyn Fernandez', 'Housewife', '09145678035', 'pending', 'Q407272', '09145678036', 'anne.fernandez@gmail.com', NULL, '2025-12-17 02:05:10', NULL, 0, 0, 0, 0, 0),
(273, '40134568013', 'Ryan Louis', 'Bautista', 'Gonzales', 'New Student', 'male', 'Grade 7', '', '2012-09-29', 'Roman Catholic', 'Meycauayan City, Bulacan', 12, '27 Opal St., Brgy. Perez, Meycauayan, Bulacan', 'Central Luzon', 'Bulacan', 'City of Meycauayan', 'Perez', 'Eric Gonzales', 'Warehouse Supervisor', '09145678037', 'Helen Gonzales', 'Storekeeper', '09145678038', 'Helen Gonzales', 'Storekeeper', '09145678038', 'pending', 'Q407273', '09145678039', 'ryan.gonzales@gmail.com', NULL, '2025-12-17 02:05:10', NULL, 0, 0, 0, 0, 0),
(274, '40134568014', 'Sofia Mae', 'Mercado', 'Hernandez', 'New Student', 'female', 'Grade 7', '', '2012-01-17', 'Roman Catholic', 'Meycauayan City, Bulacan', 13, '6 Amethyst St., Brgy. Iba, Meycauayan, Bulacan', 'Central Luzon', 'Bulacan', 'City of Meycauayan', 'Iba', 'Carlo Hernandez', 'Quality Inspector', '09145678040', 'Diana Hernandez', 'Office Aide', '09145678041', 'Diana Hernandez', 'Office Aide', '09145678041', 'pending', 'Q407274', '09145678042', 'sofia.hernandez@gmail.com', NULL, '2025-12-17 02:05:10', NULL, 0, 0, 0, 0, 0),
(275, '40134568015', 'Bryan Mark', 'Flores', 'Ignacio', 'New Student', 'male', 'Grade 7', '', '2012-06-02', 'Roman Catholic', 'Meycauayan City, Bulacan', 12, '73 Garnet St., Brgy. Saluysoy, Meycauayan, Bulacan', 'Central Luzon', 'Bulacan', 'City of Meycauayan', 'Saluysoy', 'Dennis Ignacio', 'Forklift Operator', '09145678043', 'Lani Ignacio', 'Housewife', '09145678044', 'Lani Ignacio', 'Housewife', '09145678044', 'pending', 'Q407275', '09145678045', 'bryan.ignacio@gmail.com', NULL, '2025-12-17 02:05:10', NULL, 0, 0, 0, 0, 0),
(276, '40134568016', 'Mark Anthony', 'Cruz', 'Jacinto', 'New Student', 'male', 'Grade 7', '', '2012-10-08', 'Roman Catholic', 'Meycauayan City, Bulacan', 12, '14 Tourmaline St., Brgy. Pandayan, Meycauayan, Bulacan', 'Central Luzon', 'Bulacan', 'City of Meycauayan', 'Pandayan', 'Ronald Jacinto', 'Maintenance Technician', '09145678046', 'Cecilia Jacinto', 'Office Clerk', '09145678047', 'Cecilia Jacinto', 'Office Clerk', '09145678047', 'pending', 'Q407276', '09145678048', 'mark.jacinto@gmail.com', NULL, '2025-12-17 02:05:10', NULL, 0, 0, 0, 0, 0),
(277, '40134568017', 'Lovely Anne', 'Reyes', 'Kintanar', 'New Student', 'female', 'Grade 7', '', '2012-03-25', 'Roman Catholic', 'Meycauayan City, Bulacan', 13, '39 Citrine St., Brgy. Camalig, Meycauayan, Bulacan', 'Central Luzon', 'Bulacan', 'City of Meycauayan', 'Camalig', 'Joel Kintanar', 'Production Supervisor', '09145678049', 'Maria Kintanar', 'Office Staff', '09145678050', 'Maria Kintanar', 'Office Staff', '09145678050', 'pending', 'Q407277', '09145678051', 'lovely.kintanar@gmail.com', NULL, '2025-12-17 02:05:10', NULL, 0, 0, 0, 0, 0),
(278, '40134568018', 'Paul Jeremiah', 'Santos', 'Lorenzo', 'New Student', 'male', 'Grade 7', '', '2012-11-19', 'Roman Catholic', 'Meycauayan City, Bulacan', 12, '52 Lapis St., Brgy. Malhacan, Meycauayan, Bulacan', 'Central Luzon', 'Bulacan', 'City of Meycauayan', 'Malhacan', 'Victor Lorenzo', 'Logistics Planner', '09145678052', 'Grace Lorenzo', 'HR Assistant', '09145678053', 'Grace Lorenzo', 'HR Assistant', '09145678053', 'pending', 'Q407278', '09145678054', 'paul.lorenzo@gmail.com', NULL, '2025-12-17 02:05:10', NULL, 0, 0, 0, 0, 0),
(279, '40134568019', 'Hannah Faith', 'Dizon', 'Morales', 'New Student', 'female', 'Grade 7', '', '2012-04-06', 'Roman Catholic', 'Meycauayan City, Bulacan', 13, '8 Quartz St., Brgy. Perez, Meycauayan, Bulacan', 'Central Luzon', 'Bulacan', 'City of Meycauayan', 'Perez', 'Ariel Morales', 'Warehouse Checker', '09145678055', 'Nilda Morales', 'Housewife', '09145678056', 'Nilda Morales', 'Housewife', '09145678056', 'pending', 'Q407279', '09145678057', 'hannah.morales@gmail.com', NULL, '2025-12-17 02:05:10', NULL, 0, 0, 0, 0, 0),
(280, '40134568020', 'Jayson Louie', 'Cruz', 'Navarro', 'New Student', 'male', 'Grade 7', '', '2012-08-30', 'Roman Catholic', 'Meycauayan City, Bulacan', 12, '61 Beryl St., Brgy. Iba, Meycauayan, Bulacan', 'Central Luzon', 'Bulacan', 'City of Meycauayan', 'Iba', 'Ben Navarro', 'Store Supervisor', '09145678058', 'Marissa Navarro', 'Cashier', '09145678059', 'Marissa Navarro', 'Cashier', '09145678059', 'pending', 'Q407280', '09145678060', 'jayson.navarro@gmail.com', NULL, '2025-12-17 02:05:10', NULL, 0, 0, 0, 0, 0),
(291, '40145678011', 'Ethan James', 'Garcia', 'Ulep', 'New Student', 'male', 'Grade 8', '', '2011-05-19', 'Roman Catholic', 'Meycauayan City, Bulacan', 14, '22 Coral St., Brgy. Perez, Meycauayan, Bulacan', 'Central Luzon', 'Bulacan', 'City of Meycauayan', 'Perez', 'Victor Ulep', 'Plant Supervisor', '09156789031', 'Nancy Ulep', 'Office Clerk', '09156789032', 'Nancy Ulep', 'Office Clerk', '09156789032', 'pending', 'Q408291', '09156789033', 'ethan.ulep@gmail.com', NULL, '2025-12-17 02:08:00', NULL, 0, 0, 0, 0, 0);
INSERT INTO `admission_form` (`id`, `lrn`, `firstname`, `middlename`, `lastname`, `status`, `gender`, `grade_level`, `profile_picture`, `birthday`, `religion`, `place_of_birth`, `age`, `residential_address`, `region`, `province`, `municipal`, `barangay`, `father_name`, `father_occupation`, `father_contact`, `mother_name`, `mother_occupation`, `mother_contact`, `guardian_name`, `guardian_occupation`, `guardian_contact`, `admission_status`, `que_code`, `phone`, `email`, `facebook`, `admission_date`, `strand`, `birth_cert`, `report_card`, `good_moral`, `id_pic`, `esc_cert`) VALUES
(292, '40145678012', 'Denise Faith', 'Cruz', 'Valmonte', 'New Student', 'female', 'Grade 8', '', '2011-07-01', 'Roman Catholic', 'Meycauayan City, Bulacan', 13, '8 Amber St., Brgy. Iba, Meycauayan, Bulacan', 'Central Luzon', 'Bulacan', 'City of Meycauayan', 'Iba', 'Allan Valmonte', 'Maintenance Supervisor', '09156789034', 'Teresa Valmonte', 'Office Staff', '09156789035', 'Teresa Valmonte', 'Office Staff', '09156789035', 'pending', 'Q408292', '09156789036', 'denise.valmonte@gmail.com', NULL, '2025-12-17 02:08:00', NULL, 0, 0, 0, 0, 0),
(293, '40145678013', 'Kevin Louie', 'Lim', 'Wong', 'New Student', 'male', 'Grade 8', '', '2011-03-11', 'Roman Catholic', 'Meycauayan City, Bulacan', 14, '95 Pearl St., Brgy. Saluysoy, Meycauayan, Bulacan', 'Central Luzon', 'Bulacan', 'City of Meycauayan', 'Saluysoy', 'Richard Wong', 'Import Coordinator', '09156789037', 'Susan Wong', 'Accounting Staff', '09156789038', 'Susan Wong', 'Accounting Staff', '09156789038', 'pending', 'Q408293', '09156789039', 'kevin.wong@gmail.com', NULL, '2025-12-17 02:08:00', NULL, 0, 0, 0, 0, 0),
(294, '40145678014', 'Angelica Mae', 'Go', 'Yap', 'New Student', 'female', 'Grade 8', '', '2011-10-23', 'Roman Catholic', 'Meycauayan City, Bulacan', 13, '31 Jade St., Brgy. Camalig, Meycauayan, Bulacan', 'Central Luzon', 'Bulacan', 'City of Meycauayan', 'Camalig', 'Henry Yap', 'Trading Supervisor', '09156789040', 'Liza Yap', 'Sales Coordinator', '09156789041', 'Liza Yap', 'Sales Coordinator', '09156789041', 'pending', 'Q408294', '09156789042', 'angelica.yap@gmail.com', NULL, '2025-12-17 02:08:00', NULL, 0, 0, 0, 0, 0),
(295, '40145678015', 'Jayson Paul', 'Cruz', 'Zamora', 'New Student', 'male', 'Grade 8', '', '2011-01-09', 'Roman Catholic', 'Meycauayan City, Bulacan', 14, '69 Crystal St., Brgy. Malhacan, Meycauayan, Bulacan', 'Central Luzon', 'Bulacan', 'City of Meycauayan', 'Malhacan', 'Eric Zamora', 'Operations Lead', '09156789043', 'Lorna Zamora', 'Office Clerk', '09156789044', 'Lorna Zamora', 'Office Clerk', '09156789044', 'pending', 'Q408295', '09156789045', 'jayson.zamora@gmail.com', NULL, '2025-12-17 02:08:00', NULL, 0, 0, 0, 0, 0),
(296, '40145678016', 'Nicole Anne', 'Rosales', 'Aquino', 'New Student', 'female', 'Grade 8', '', '2011-04-28', 'Roman Catholic', 'Meycauayan City, Bulacan', 14, '5 Diamond St., Brgy. Perez, Meycauayan, Bulacan', 'Central Luzon', 'Bulacan', 'City of Meycauayan', 'Perez', 'Dante Aquino', 'Warehouse Manager', '09156789046', 'Maribel Aquino', 'Office Staff', '09156789047', 'Maribel Aquino', 'Office Staff', '09156789047', 'pending', 'Q408296', '09156789048', 'nicole.aquino@gmail.com', NULL, '2025-12-17 02:08:00', NULL, 0, 0, 0, 0, 0),
(297, '40145678017', 'Carlo Miguel', 'Navarro', 'Briones', 'New Student', 'male', 'Grade 8', '', '2011-06-16', 'Roman Catholic', 'Meycauayan City, Bulacan', 13, '42 Emerald St., Brgy. Iba, Meycauayan, Bulacan', 'Central Luzon', 'Bulacan', 'City of Meycauayan', 'Iba', 'Manny Briones', 'Production Supervisor', '09156789049', 'Teresa Briones', 'Office Clerk', '09156789050', 'Teresa Briones', 'Office Clerk', '09156789050', 'pending', 'Q408297', '09156789051', 'carlo.briones@gmail.com', NULL, '2025-12-17 02:08:00', NULL, 0, 0, 0, 0, 0),
(298, '40145678018', 'Faith Joy', 'Cruz', 'Casiño', 'New Student', 'female', 'Grade 8', '', '2011-09-03', 'Roman Catholic', 'Meycauayan City, Bulacan', 13, '11 Sapphire St., Brgy. Saluysoy, Meycauayan, Bulacan', 'Central Luzon', 'Bulacan', 'City of Meycauayan', 'Saluysoy', 'Joel Casiño', 'Warehouse Checker', '09156789052', 'Grace Casiño', 'Housewife', '09156789053', 'Grace Casiño', 'Housewife', '09156789053', 'pending', 'Q408298', '09156789054', 'faith.casino@gmail.com', NULL, '2025-12-17 02:08:00', NULL, 0, 0, 0, 0, 0),
(299, '40145678019', 'John Steven', 'Flores', 'Delos Reyes', 'New Student', 'male', 'Grade 8', '', '2011-02-25', 'Roman Catholic', 'Meycauayan City, Bulacan', 14, '88 Ruby St., Brgy. Pandayan, Meycauayan, Bulacan', 'Central Luzon', 'Bulacan', 'City of Meycauayan', 'Pandayan', 'Noel Delos Reyes', 'Logistics Assistant', '09156789055', 'Mercy Delos Reyes', 'Accounting Aide', '09156789056', 'Mercy Delos Reyes', 'Accounting Aide', '09156789056', 'pending', 'Q408299', '09156789057', 'john.delosreyes@gmail.com', NULL, '2025-12-17 02:08:00', NULL, 0, 0, 0, 0, 0),
(300, '40145678020', 'Julius', 'Garcia', 'Bergania', 'New Student', 'male', 'Grade 8', '', '2011-07-07', 'Roman Catholic', 'Meycauayan City, Bulacan', 13, '21 Ruby St., Brgy. Pandayan, Meycauayan, Bulacan', 'Central Luzon', 'Bulacan', 'City of Meycauayan', 'Pandayan', 'Noel Bergania', 'Logistics Assistant', '09156789058', 'Mercy Bergania', 'Accounting Aide', '09156789059', 'Mercy Bergania', 'Accounting Aide', '09156789059', 'pending', 'Q408300', '09156789060', 'davebergania@gmail.com', NULL, '2026-01-12 14:15:15', NULL, 0, 0, 0, 0, 0),
(311, '40090000011', 'Nathaniel John', 'Flores', 'Kasilag', 'New Student', 'male', 'Grade 9', '', '2011-06-15', 'Roman Catholic', 'Meycauayan City, Bulacan', 14, '48 Amethyst St., Brgy. Saluysoy, Meycauayan, Bulacan', 'Central Luzon', 'Bulacan', 'City of Meycauayan', 'Saluysoy', 'Edwin Kasilag', 'Factory Worker', '09171230031', 'Mercy Kasilag', 'Vendor', '09171230032', 'Mercy Kasilag', 'Vendor', '09171230032', 'pending', 'Q930311', '09171230033', 'nathaniel.kasilag@gmail.com', NULL, '2026-01-15 02:37:03', NULL, 0, 0, 0, 0, 0),
(312, '40090000012', 'Rachelle Mae', 'Dizon', 'Lazaro', 'New Student', 'female', 'Grade 9', '', '2011-06-15', 'Roman Catholic', 'Meycauayan City, Bulacan', 14, '14 Beryl St., Brgy. Pandayan, Meycauayan, Bulacan', 'Central Luzon', 'Bulacan', 'City of Meycauayan', 'Pandayan', 'Paul Lazaro', 'Sales Representative', '09171230034', 'Linda Lazaro', 'Housewife', '09171230035', 'Linda Lazaro', 'Housewife', '09171230035', 'pending', 'Q930312', '09171230036', 'rachelle.lazaro@gmail.com', NULL, '2026-01-15 02:37:03', NULL, 0, 0, 0, 0, 0),
(313, '40090000013', 'Jared Luke', 'Cruz', 'Manabat', 'New Student', 'male', 'Grade 9', '', '2011-06-15', 'Roman Catholic', 'Meycauayan City, Bulacan', 14, '32 Citrine St., Brgy. Camalig, Meycauayan, Bulacan', 'Central Luzon', 'Bulacan', 'City of Meycauayan', 'Camalig', 'Oscar Manabat', 'Machine Technician', '09171230037', 'Beth Manabat', 'Office Assistant', '09171230038', 'Beth Manabat', 'Office Assistant', '09171230038', 'pending', 'Q930313', '09171230039', 'jared.manabat@gmail.com', NULL, '2026-01-15 02:37:03', NULL, 0, 0, 0, 0, 0),
(314, '40090000014', 'Kyla Faith', 'Santos', 'Neri', 'New Student', 'female', 'Grade 9', '', '2011-06-15', 'Roman Catholic', 'Meycauayan City, Bulacan', 14, '9 Peridot St., Brgy. Malhacan, Meycauayan, Bulacan', 'Central Luzon', 'Bulacan', 'City of Meycauayan', 'Malhacan', 'Dennis Neri', 'Warehouse Supervisor', '09171230040', 'Marissa Neri', 'Housewife', '09171230041', 'Marissa Neri', 'Housewife', '09171230041', 'pending', 'Q930314', '09171230042', 'kyla.neri@gmail.com', NULL, '2026-01-15 02:37:03', NULL, 0, 0, 0, 0, 0),
(315, '40090000015', 'Elijah Mark', 'Reyes', 'Ocampo', 'New Student', 'male', 'Grade 9', '', '2011-06-15', 'Roman Catholic', 'Meycauayan City, Bulacan', 14, '55 Garnet St., Brgy. Perez, Meycauayan, Bulacan', 'Central Luzon', 'Bulacan', 'City of Meycauayan', 'Perez', 'Manny Ocampo', 'Security Guard', '09171230043', 'Grace Ocampo', 'Canteen Staff', '09171230044', 'Grace Ocampo', 'Canteen Staff', '09171230044', 'pending', 'Q930315', '09171230045', 'elijah.ocampo@gmail.com', NULL, '2026-01-15 02:37:03', NULL, 0, 0, 0, 0, 0),
(316, '40090000016', 'Kim Danielle', 'Flores', 'Padua', 'New Student', 'female', 'Grade 9', '', '2011-06-15', 'Roman Catholic', 'Meycauayan City, Bulacan', 14, '7 Zircon St., Brgy. Iba, Meycauayan, Bulacan', 'Central Luzon', 'Bulacan', 'City of Meycauayan', 'Iba', 'Joel Padua', 'Painter', '09171230046', 'Cherry Padua', 'Online Seller', '09171230047', 'Cherry Padua', 'Online Seller', '09171230047', 'pending', 'Q930316', '09171230048', 'kim.padua@gmail.com', NULL, '2026-01-15 02:37:03', NULL, 0, 0, 0, 0, 0),
(317, '40090000017', 'Paolo Miguel', 'Cruz', 'Quiazon', 'New Student', 'male', 'Grade 9', '', '2011-06-15', 'Roman Catholic', 'Meycauayan City, Bulacan', 14, '73 Onyx St., Brgy. Saluysoy, Meycauayan, Bulacan', 'Central Luzon', 'Bulacan', 'City of Meycauayan', 'Saluysoy', 'Rey Quiazon', 'Welder', '09171230049', 'Lourdes Quiazon', 'Housewife', '09171230050', 'Lourdes Quiazon', 'Housewife', '09171230050', 'pending', 'Q930317', '09171230051', 'paolo.quiazon@gmail.com', NULL, '2026-01-15 02:37:03', NULL, 0, 0, 0, 0, 0),
(318, '40090000018', 'Stephanie Joy', 'De Vera', 'Ramos', 'New Student', 'female', 'Grade 9', '', '2011-06-15', 'Roman Catholic', 'Meycauayan City, Bulacan', 14, '18 Tourmaline St., Brgy. Pandayan, Meycauayan, Bulacan', 'Central Luzon', 'Bulacan', 'City of Meycauayan', 'Pandayan', 'Alex Ramos', 'Auto Mechanic', '09171230052', 'Gina Ramos', 'Dressmaker', '09171230053', 'Gina Ramos', 'Dressmaker', '09171230053', 'pending', 'Q930318', '09171230054', 'stephanie.ramos@gmail.com', NULL, '2026-01-15 02:37:03', NULL, 0, 0, 0, 0, 0),
(319, '40090000019', 'Vincent Paul', 'Perez', 'Salonga', 'New Student', 'male', 'Grade 9', '', '2011-06-15', 'Roman Catholic', 'Meycauayan City, Bulacan', 14, '40 Obsidian St., Brgy. Camalig, Meycauayan, Bulacan', 'Central Luzon', 'Bulacan', 'City of Meycauayan', 'Camalig', 'Nestor Salonga', 'Forklift Operator', '09171230055', 'Cathy Salonga', 'Office Clerk', '09171230056', 'Cathy Salonga', 'Office Clerk', '09171230056', 'pending', 'Q930319', '09171230057', 'vincent.salonga@gmail.com', NULL, '2026-01-15 02:37:03', NULL, 0, 0, 0, 0, 0),
(320, '40090000020', 'Princess Anne', 'Cruz', 'Tabora', 'New Student', 'female', 'Grade 9', '', '2011-06-15', 'Roman Catholic', 'Meycauayan City, Bulacan', 14, '60 Lapis St., Brgy. Malhacan, Meycauayan, Bulacan', 'Central Luzon', 'Bulacan', 'City of Meycauayan', 'Malhacan', 'Ronnie Tabora', 'Truck Helper', '09171230058', 'Mila Tabora', 'Housewife', '09171230059', 'Mila Tabora', 'Housewife', '09171230059', 'pending', 'Q930320', '09171230060', 'princess.tabora@gmail.com', NULL, '2026-01-15 02:37:03', NULL, 0, 0, 0, 0, 0),
(333, '40100000033', 'Daniel Paul', 'Cruz', 'Baluyot', 'New Student', 'male', 'Grade 10', '', '2010-06-15', 'Roman Catholic', 'Meycauayan City, Bulacan', 15, '91 Emerald St., Brgy. Perez, Meycauayan, Bulacan', 'Central Luzon', 'Bulacan', 'City of Meycauayan', 'Perez', 'Roger Baluyot', 'Construction Foreman', '09181230037', 'Alma Baluyot', 'Housewife', '09181230038', 'Alma Baluyot', 'Housewife', '09181230038', 'pending', 'Q10333', '09181230039', 'daniel.baluyot@gmail.com', NULL, '2026-01-15 02:43:39', NULL, 0, 0, 0, 0, 0),
(334, '40100000034', 'Arianne Hope', 'Flores', 'Dimaculangan', 'New Student', 'female', 'Grade 10', '', '2010-06-15', 'Roman Catholic', 'Meycauayan City, Bulacan', 15, '4 Ruby St., Brgy. Iba, Meycauayan, Bulacan', 'Central Luzon', 'Bulacan', 'City of Meycauayan', 'Iba', 'Leo Dimaculangan', 'Maintenance Staff', '09181230040', 'Nita Dimaculangan', 'Vendor', '09181230041', 'Nita Dimaculangan', 'Vendor', '09181230041', 'pending', 'Q10334', '09181230042', 'arianne.dimaculangan@gmail.com', NULL, '2026-01-15 02:43:39', NULL, 0, 0, 0, 0, 0),
(335, '40100000035', 'John Rey', 'Navarro', 'Evangelista', 'New Student', 'male', 'Grade 10', '', '2010-06-15', 'Roman Catholic', 'Meycauayan City, Bulacan', 15, '77 Pearl St., Brgy. Saluysoy, Meycauayan, Bulacan', 'Central Luzon', 'Bulacan', 'City of Meycauayan', 'Saluysoy', 'Allan Evangelista', 'Forklift Operator', '09181230043', 'Lorna Evangelista', 'Housewife', '09181230044', 'Lorna Evangelista', 'Housewife', '09181230044', 'pending', 'Q10335', '09181230045', 'johnrey.evangelista@gmail.com', NULL, '2026-01-15 02:43:39', NULL, 0, 0, 0, 0, 0),
(336, '40100000036', 'Melissa Anne', 'Santos', 'Fajardo', 'New Student', 'female', 'Grade 10', '', '2010-06-15', 'Roman Catholic', 'Meycauayan City, Bulacan', 15, '39 Sapphire St., Brgy. Pandayan, Meycauayan, Bulacan', 'Central Luzon', 'Bulacan', 'City of Meycauayan', 'Pandayan', 'Dino Fajardo', 'Service Crew', '09181230046', 'Joy Fajardo', 'Housewife', '09181230047', 'Joy Fajardo', 'Housewife', '09181230047', 'pending', 'Q10336', '09181230048', 'melissa.fajardo@gmail.com', NULL, '2026-01-15 02:43:39', NULL, 0, 0, 0, 0, 0),
(337, '40100000037', 'Bryan Keith', 'Cruz', 'Galvez', 'New Student', 'male', 'Grade 10', '', '2010-06-15', 'Roman Catholic', 'Meycauayan City, Bulacan', 15, '12 Diamond St., Brgy. Camalig, Meycauayan, Bulacan', 'Central Luzon', 'Bulacan', 'City of Meycauayan', 'Camalig', 'Romy Galvez', 'Machine Technician', '09181230049', 'Ellen Galvez', 'Office Clerk', '09181230050', 'Ellen Galvez', 'Office Clerk', '09181230050', 'pending', 'Q10337', '09181230051', 'bryan.galvez@gmail.com', NULL, '2026-01-15 02:43:39', NULL, 0, 0, 0, 0, 0),
(338, '40100000038', 'Lovely Grace', 'Ramos', 'Hizon', 'New Student', 'female', 'Grade 10', '', '2010-06-15', 'Roman Catholic', 'Meycauayan City, Bulacan', 15, '66 Topaz St., Brgy. Malhacan, Meycauayan, Bulacan', 'Central Luzon', 'Bulacan', 'City of Meycauayan', 'Malhacan', 'Jun Hizon', 'Security Personnel', '09181230052', 'Ruby Hizon', 'Laundry Shop Owner', '09181230053', 'Ruby Hizon', 'Laundry Shop Owner', '09181230053', 'pending', 'Q10338', '09181230054', 'lovely.hizon@gmail.com', NULL, '2026-01-15 02:43:39', NULL, 0, 0, 0, 0, 0),
(339, '40100000039', 'Michael Sean', 'Bautista', 'Isip', 'New Student', 'male', 'Grade 10', '', '2010-06-15', 'Roman Catholic', 'Meycauayan City, Bulacan', 15, '21 Opal St., Brgy. Perez, Meycauayan, Bulacan', 'Central Luzon', 'Bulacan', 'City of Meycauayan', 'Perez', 'Carlo Isip', 'Warehouse Loader', '09181230055', 'Mila Isip', 'Housewife', '09181230056', 'Mila Isip', 'Housewife', '09181230056', 'pending', 'Q10339', '09181230057', 'michael.isip@gmail.com', NULL, '2026-01-15 02:43:39', NULL, 0, 0, 0, 0, 0),
(340, '40100000040', 'Angela Rose', 'Cruz', 'Jimeno', 'New Student', 'female', 'Grade 10', '', '2010-06-15', 'Roman Catholic', 'Meycauayan City, Bulacan', 15, '5 Quartz St., Brgy. Iba, Meycauayan, Bulacan', 'Central Luzon', 'Bulacan', 'City of Meycauayan', 'Iba', 'Mark Jimeno', 'Technician', '09181230058', 'Clarissa Jimeno', 'Housewife', '09181230059', 'Clarissa Jimeno', 'Housewife', '09181230059', 'pending', 'Q10340', '09181230060', 'angela.jimeno@gmail.com', NULL, '2026-01-15 02:43:39', NULL, 0, 0, 0, 0, 0),
(341, '40000000341', 'Adrian Miguel', 'Santos', 'Dela Cruz', 'New Student', 'male', 'Grade 11', '', '2008-03-14', 'Roman Catholic', 'Meycauayan City, Bulacan', 16, '12 Mabini St., Grace Park Subd., Brgy. Pantoc, Meycauayan, Bulacan', 'Central Luzon', 'Bulacan', 'City of Meycauayan', 'Pantoc', 'Max Dela Cruz', 'Construction Worker', '09170000341', 'Vian Dela Cruz', 'Housewife', '09170000342', 'Vian Dela Cruz', 'Housewife', '09170000342', 'pending', 'Q341', '09170000341', 'adrian341@gmail.com', NULL, '2025-06-01 08:00:00', NULL, 0, 0, 0, 0, 0),
(342, '40000000342', 'Alyssa Mae', 'Flores', 'Ramirez', 'New Student', 'female', 'Grade 11', '', '2009-01-22', 'Roman Catholic', 'Meycauayan City, Bulacan', 16, 'Unit 4, Rivera Compound, Brgy. Malhacan, Meycauayan, Bulacan', 'Central Luzon', 'Bulacan', 'City of Meycauayan', 'Malhacan', 'Eric Ramirez', 'Delivery Driver', '09170000343', 'Lorna Ramirez', 'Vendor', '09170000344', 'Eric Ramirez', 'Delivery Driver', '09170000343', 'pending', 'Q342', '09170000342', 'alyssa342@gmail.com', NULL, '2025-06-01 08:00:00', NULL, 0, 0, 0, 0, 0),
(343, '40000000343', 'John Carlo', 'Reyes', 'Mendoza', 'New Student', 'male', 'Grade 11', '', '2008-07-10', 'Roman Catholic', 'Meycauayan City, Bulacan', 17, 'Blk 6 Lot 8, Villa Mercedes Subd., Brgy. Camalig, Meycauayan, Bulacan', 'Central Luzon', 'Bulacan', 'City of Meycauayan', 'Camalig', 'Patrick Mendoza', 'Machine Operator', '09170000345', 'Sheila Mendoza', 'Office Clerk', '09170000346', 'Mario Mendoza', 'Security Guard', '09170000347', 'pending', 'Q343', '09170000343', 'john343@gmail.com', NULL, '2025-06-01 08:00:00', NULL, 0, 0, 0, 0, 0),
(344, '40000000344', 'Princess Joy', 'Cruz', 'Bautista', 'New Student', 'female', 'Grade 11', '', '2009-02-05', 'Roman Catholic', 'Meycauayan City, Bulacan', 16, '18 Ilang-Ilang St., Brgy. Langka, Meycauayan, Bulacan', 'Central Luzon', 'Bulacan', 'City of Meycauayan', 'Langka', 'Ronnie Bautista', 'Electrician', '09170000348', 'Maribel Bautista', 'Housewife', '09170000349', 'Maribel Bautista', 'Housewife', '09170000349', 'pending', 'Q344', '09170000344', 'princess344@gmail.com', NULL, '2025-06-01 08:00:00', NULL, 0, 0, 0, 0, 0),
(345, '40000000345', 'Kyle Andrew', 'Villanueva', 'Santos', 'New Student', 'male', 'Grade 11', '', '2008-11-19', 'Roman Catholic', 'Meycauayan City, Bulacan', 16, 'Phase 1 Lot 11, Greenfields Subd., Brgy. Iba, Meycauayan, Bulacan', 'Central Luzon', 'Bulacan', 'City of Meycauayan', 'Iba', 'Joel Santos', 'Salesman', '09170000350', 'Cherry Santos', 'Housewife', '09170000351', 'Joel Santos', 'Salesman', '09170000350', 'pending', 'Q345', '09170000345', 'kyle345@gmail.com', NULL, '2025-06-01 08:00:00', NULL, 0, 0, 0, 0, 0),
(346, '40000000346', 'Joshua Mark', 'Panganiban', 'Serrano', 'New Student', 'male', 'Grade 11', '', '2008-05-08', 'Roman Catholic', 'Meycauayan City, Bulacan', 17, '18 Birch St., Brgy. Saluysoy, Meycauayan, Bulacan', 'Central Luzon', 'Bulacan', 'City of Meycauayan', 'Saluysoy', 'Alvin Serrano', 'Forklift Operator', '09170000352', 'Myrna Serrano', 'Vendor', '09170000353', 'Myrna Serrano', 'Vendor', '09170000353', 'pending', 'Q346', '09170000346', 'joshua346@gmail.com', NULL, '2025-06-01 08:00:00', NULL, 0, 0, 0, 0, 0),
(347, '40000000347', 'Rhea Camille', 'Nicolas', 'Galang', 'New Student', 'female', 'Grade 11', '', '2009-04-12', 'Roman Catholic', 'Meycauayan City, Bulacan', 16, '40 Cherry St., Brgy. Pandayan, Meycauayan, Bulacan', 'Central Luzon', 'Bulacan', 'City of Meycauayan', 'Pandayan', 'Mario Galang', 'Tricycle Driver', '09170000354', 'Josie Galang', 'Housewife', '09170000355', 'Josie Galang', 'Housewife', '09170000355', 'pending', 'Q347', '09170000347', 'rhea347@gmail.com', NULL, '2025-06-01 08:00:00', NULL, 0, 0, 0, 0, 0),
(348, '40000000348', 'Aaron Paul', 'Bonifacio', 'Jimenez', 'New Student', 'male', 'Grade 11', '', '2008-09-01', 'Roman Catholic', 'Meycauayan City, Bulacan', 16, '59 Peach St., Brgy. Camalig, Meycauayan, Bulacan', 'Central Luzon', 'Bulacan', 'City of Meycauayan', 'Camalig', 'Dante Jimenez', 'Warehouse Staff', '09170000356', 'Celia Jimenez', 'Housewife', '09170000357', 'Celia Jimenez', 'Housewife', '09170000357', 'pending', 'Q348', '09170000348', 'aaron348@gmail.com', NULL, '2025-06-01 08:00:00', NULL, 0, 0, 0, 0, 0),
(349, '40000000349', 'Denise Claire', 'Robles', 'Suarez', 'New Student', 'female', 'Grade 11', '', '2009-06-16', 'Roman Catholic', 'Meycauayan City, Bulacan', 15, '27 Apple St., Brgy. Malhacan, Meycauayan, Bulacan', 'Central Luzon', 'Bulacan', 'City of Meycauayan', 'Malhacan', 'Leo Suarez', 'Security Guard', '09170000358', 'Fe Suarez', 'Housewife', '09170000359', 'Fe Suarez', 'Housewife', '09170000359', 'pending', 'Q349', '09170000349', 'denise349@gmail.com', NULL, '2025-06-01 08:00:00', NULL, 0, 0, 0, 0, 0),
(350, '40000000350', 'Vincent Kyle', 'Zamora', 'Ignacio', 'New Student', 'male', 'Grade 11', '', '2008-12-30', 'Roman Catholic', 'Meycauayan City, Bulacan', 16, '84 Grape St., Brgy. Perez, Meycauayan, Bulacan', 'Central Luzon', 'Bulacan', 'City of Meycauayan', 'Perez', 'Percy Ignacio', 'Auto Mechanic', '09170000360', 'Arlene Ignacio', 'Housewife', '09170000361', 'Arlene Ignacio', 'Housewife', '09170000361', 'pending', 'Q350', '09170000350', 'vincent350@gmail.com', NULL, '2025-06-01 08:00:00', NULL, 0, 0, 0, 0, 0),
(351, '40000000351', 'Jerome Alex', 'Cruz', 'Villaflor', 'New Student', 'male', 'Grade 11', '', '2008-04-21', 'Roman Catholic', 'Meycauayan City, Bulacan', 17, '25 Mahogany St., Brgy. Perez, Meycauayan, Bulacan', 'Central Luzon', 'Bulacan', 'City of Meycauayan', 'Perez', 'Leo Villaflor', 'Factory Worker', '09170000362', 'Fe Villaflor', 'Housewife', '09170000363', 'Fe Villaflor', 'Housewife', '09170000363', 'pending', 'Q351', '09170000351', 'jerome351@gmail.com', NULL, '2025-06-01 08:00:00', NULL, 0, 0, 0, 0, 0),
(352, '40000000352', 'Hannah Mae', 'Bautista', 'Lagman', 'New Student', 'female', 'Grade 11', '', '2009-02-18', 'Roman Catholic', 'Meycauayan City, Bulacan', 16, '10 Narra St., Brgy. Iba, Meycauayan, Bulacan', 'Central Luzon', 'Bulacan', 'City of Meycauayan', 'Iba', 'Eric Lagman', 'Company Driver', '09170000364', 'Remy Lagman', 'Housewife', '09170000365', 'Remy Lagman', 'Housewife', '09170000365', 'pending', 'Q352', '09170000352', 'hannah352@gmail.com', NULL, '2025-06-01 08:00:00', NULL, 0, 0, 0, 0, 0),
(353, '40000000353', 'Carl Vincent', 'Navarro', 'Dacumos', 'New Student', 'male', 'Grade 11', '', '2008-10-07', 'Roman Catholic', 'Meycauayan City, Bulacan', 16, '37 Rosal St., Brgy. Saluysoy, Meycauayan, Bulacan', 'Central Luzon', 'Bulacan', 'City of Meycauayan', 'Saluysoy', 'Rudy Dacumos', 'Machine Operator', '09170000366', 'Lanie Dacumos', 'Vendor', '09170000367', 'Lanie Dacumos', 'Vendor', '09170000367', 'pending', 'Q353', '09170000353', 'carl353@gmail.com', NULL, '2025-06-01 08:00:00', NULL, 0, 0, 0, 0, 0),
(354, '40000000354', 'Princess Joy', 'Castillo', 'Roldan', 'New Student', 'female', 'Grade 11', '', '2009-01-29', 'Roman Catholic', 'Meycauayan City, Bulacan', 16, '61 Luna St., Brgy. Pandayan, Meycauayan, Bulacan', 'Central Luzon', 'Bulacan', 'City of Meycauayan', 'Pandayan', 'Rene Roldan', 'Construction Worker', '09170000368', 'Imelda Roldan', 'Housewife', '09170000369', 'Imelda Roldan', 'Housewife', '09170000369', 'pending', 'Q354', '09170000354', 'princess354@gmail.com', NULL, '2025-06-01 08:00:00', NULL, 0, 0, 0, 0, 0),
(355, '40000000355', 'Kyle Andrew', 'Torres', 'Malabanan', 'New Student', 'male', 'Grade 11', '', '2008-06-03', 'Roman Catholic', 'Meycauayan City, Bulacan', 17, '7 Jade St., Brgy. Camalig, Meycauayan, Bulacan', 'Central Luzon', 'Bulacan', 'City of Meycauayan', 'Camalig', 'Ben Malabanan', 'Welder', '09170000370', 'Sheila Malabanan', 'Housewife', '09170000371', 'Sheila Malabanan', 'Housewife', '09170000371', 'pending', 'Q355', '09170000355', 'kyle355@gmail.com', NULL, '2025-06-01 08:00:00', NULL, 0, 0, 0, 0, 0),
(356, '40000000356', 'Faith Nicole', 'Mendoza', 'Hilario', 'New Student', 'female', 'Grade 11', '', '2009-05-14', 'Roman Catholic', 'Meycauayan City, Bulacan', 16, '48 Pearl St., Brgy. Malhacan, Meycauayan, Bulacan', 'Central Luzon', 'Bulacan', 'City of Meycauayan', 'Malhacan', 'Joel Hilario', 'Forklift Operator', '09170000372', 'Cherry Hilario', 'Housewife', '09170000373', 'Cherry Hilario', 'Housewife', '09170000373', 'pending', 'Q356', '09170000356', 'faith356@gmail.com', NULL, '2025-06-01 08:00:00', NULL, 0, 0, 0, 0, 0),
(357, '40000000357', 'Sean Matthew', 'Diaz', 'Sorilla', 'New Student', 'male', 'Grade 11', '', '2008-08-26', 'Roman Catholic', 'Meycauayan City, Bulacan', 16, '82 Diamond St., Brgy. Perez, Meycauayan, Bulacan', 'Central Luzon', 'Bulacan', 'City of Meycauayan', 'Perez', 'Manny Sorilla', 'Security Guard', '09170000374', 'Rina Sorilla', 'Vendor', '09170000375', 'Rina Sorilla', 'Vendor', '09170000375', 'pending', 'Q357', '09170000357', 'sean357@gmail.com', NULL, '2025-06-01 08:00:00', NULL, 0, 0, 0, 0, 0),
(358, '40000000358', 'Trina Louise', 'Mercado', 'Austria', 'New Student', 'female', 'Grade 11', '', '2009-03-09', 'Roman Catholic', 'Meycauayan City, Bulacan', 16, '3 Gold St., Brgy. Iba, Meycauayan, Bulacan', 'Central Luzon', 'Bulacan', 'City of Meycauayan', 'Iba', 'Vic Austria', 'Sales Representative', '09170000376', 'Cathy Austria', 'Office Clerk', '09170000377', 'Cathy Austria', 'Office Clerk', '09170000377', 'pending', 'Q358', '09170000358', 'trina358@gmail.com', NULL, '2025-06-01 08:00:00', NULL, 0, 0, 0, 0, 0),
(359, '40000000359', 'Patrick John', 'Santos', 'Malonzo', 'New Student', 'male', 'Grade 11', '', '2008-12-02', 'Roman Catholic', 'Meycauayan City, Bulacan', 16, '69 Silver St., Brgy. Saluysoy, Meycauayan, Bulacan', 'Central Luzon', 'Bulacan', 'City of Meycauayan', 'Saluysoy', 'Alex Malonzo', 'Truck Driver', '09170000378', 'Donna Malonzo', 'Housewife', '09170000379', 'Donna Malonzo', 'Housewife', '09170000379', 'pending', 'Q359', '09170000359', 'patrick359@gmail.com', NULL, '2025-06-01 08:00:00', NULL, 0, 0, 0, 0, 0),
(360, '40000000360', 'Angel Mae', 'Cruz', 'Balingit', 'New Student', 'female', 'Grade 11', '', '2009-07-17', 'Roman Catholic', 'Meycauayan City, Bulacan', 15, '11 Bronze St., Brgy. Pandayan, Meycauayan, Bulacan', 'Central Luzon', 'Bulacan', 'City of Meycauayan', 'Pandayan', 'Ricky Balingit', 'Warehouse Staff', '09170000380', 'Rowena Balingit', 'Housewife', '09170000381', 'Rowena Balingit', 'Housewife', '09170000381', 'pending', 'Q360', '09170000360', 'angel360@gmail.com', NULL, '2025-06-01 08:00:00', NULL, 0, 0, 0, 0, 0),
(361, '40000000361', 'Daniel Joseph', 'Garcia', 'Navarro', 'New Student', 'male', 'Grade 12', '', '2007-03-11', 'Roman Catholic', 'Meycauayan City, Bulacan', 18, '27 Sampaguita St., Brgy. Perez, Meycauayan, Bulacan', 'Central Luzon', 'Bulacan', 'City of Meycauayan', 'Perez', 'Marco Navarro', 'Delivery Driver', '09180000361', 'Evelyn Navarro', 'Housewife', '09180000362', 'Evelyn Navarro', 'Housewife', '09180000362', 'pending', 'Q361', '09180000361', 'daniel361@gmail.com', NULL, '2025-06-01 08:00:00', NULL, 0, 0, 0, 0, 0),
(362, '40000000362', 'Samantha Lee', 'Lim', 'Tan', 'New Student', 'female', 'Grade 12', '', '2007-06-19', 'Roman Catholic', 'Meycauayan City, Bulacan', 17, 'Blk 3 Lot 6, Golden Acres Subd., Brgy. Calvario, Meycauayan, Bulacan', 'Central Luzon', 'Bulacan', 'City of Meycauayan', 'Calvario', 'Victor Tan', 'Business Owner', '09180000363', 'Helen Tan', 'Office Clerk', '09180000364', 'Helen Tan', 'Office Clerk', '09180000364', 'pending', 'Q362', '09180000362', 'samantha362@gmail.com', NULL, '2025-06-01 08:00:00', NULL, 0, 0, 0, 0, 0),
(363, '40000000363', 'Christian Paolo', 'Aquino', 'Torres', 'New Student', 'male', 'Grade 12', '', '2007-01-27', 'Roman Catholic', 'Meycauayan City, Bulacan', 18, '44 Rizal Ave., Brgy. Sto. Niño, Meycauayan, Bulacan', 'Central Luzon', 'Bulacan', 'City of Meycauayan', 'Sto. Niño', 'Ben Torres', 'Electrician', '09180000365', 'Alma Torres', 'Housewife', '09180000366', 'Ben Torres', 'Electrician', '09180000365', 'pending', 'Q363', '09180000363', 'christian363@gmail.com', NULL, '2025-06-01 08:00:00', NULL, 0, 0, 0, 0, 0),
(364, '40000000364', 'Janelle Faith', 'Ramos', 'Soriano', 'New Student', 'female', 'Grade 12', '', '2007-09-08', 'Roman Catholic', 'Meycauayan City, Bulacan', 17, 'Unit 7, Mabuhay Compound, Brgy. Hulo, Meycauayan, Bulacan', 'Central Luzon', 'Bulacan', 'City of Meycauayan', 'Hulo', 'Dennis Soriano', 'Factory Worker', '09180000367', 'Ruby Soriano', 'Vendor', '09180000368', 'Ruby Soriano', 'Vendor', '09180000368', 'pending', 'Q364', '09180000364', 'janelle364@gmail.com', NULL, '2025-06-01 08:00:00', NULL, 0, 0, 0, 0, 0),
(365, '40000000365', 'Mark Anthony', 'Cruz', 'Pineda', 'New Student', 'male', 'Grade 12', '', '2006-11-14', 'Roman Catholic', 'Meycauayan City, Bulacan', 18, '61 Dahlia St., Brgy. Saluysoy, Meycauayan, Bulacan', 'Central Luzon', 'Bulacan', 'City of Meycauayan', 'Saluysoy', 'Edwin Pineda', 'Machine Operator', '09180000369', 'Teresa Pineda', 'Housewife', '09180000370', 'Edwin Pineda', 'Machine Operator', '09180000369', 'pending', 'Q365', '09180000365', 'mark365@gmail.com', NULL, '2025-06-01 08:00:00', NULL, 0, 0, 0, 0, 0),
(366, '40000000366', 'Hannah Joy', 'Bautista', 'Arellano', 'New Student', 'female', 'Grade 12', '', '2007-05-03', 'Roman Catholic', 'Meycauayan City, Bulacan', 18, '11 Lemon St., Brgy. Iba, Meycauayan, Bulacan', 'Central Luzon', 'Bulacan', 'City of Meycauayan', 'Iba', 'Roy Arellano', 'Forklift Operator', '09180000371', 'Mila Arellano', 'Housewife', '09180000372', 'Mila Arellano', 'Housewife', '09180000372', 'pending', 'Q366', '09180000366', 'hannah366@gmail.com', NULL, '2025-06-01 08:00:00', NULL, 0, 0, 0, 0, 0),
(367, '40000000367', 'Ivan Stephen', 'Calderon', 'Domingo', 'New Student', 'male', 'Grade 12', '', '2006-08-21', 'Roman Catholic', 'Meycauayan City, Bulacan', 18, '68 Orange St., Brgy. Saluysoy, Meycauayan, Bulacan', 'Central Luzon', 'Bulacan', 'City of Meycauayan', 'Saluysoy', 'Jun Domingo', 'Tricycle Driver', '09180000373', 'Cherry Domingo', 'Vendor', '09180000374', 'Cherry Domingo', 'Vendor', '09180000374', 'pending', 'Q367', '09180000367', 'ivan367@gmail.com', NULL, '2025-06-01 08:00:00', NULL, 0, 0, 0, 0, 0),
(368, '40000000368', 'Krystal Anne', 'Velarde', 'Figueroa', 'New Student', 'female', 'Grade 12', '', '2007-12-10', 'Roman Catholic', 'Meycauayan City, Bulacan', 17, '23 Lime St., Brgy. Pandayan, Meycauayan, Bulacan', 'Central Luzon', 'Bulacan', 'City of Meycauayan', 'Pandayan', 'Simon Figueroa', 'Salesman', '09180000375', 'May Figueroa', 'Housewife', '09180000376', 'May Figueroa', 'Housewife', '09180000376', 'pending', 'Q368', '09180000368', 'krystal368@gmail.com', NULL, '2025-06-01 08:00:00', NULL, 0, 0, 0, 0, 0),
(369, '40000000369', 'Albert Francis', 'Yu', 'Tiongson', 'New Student', 'male', 'Grade 12', '', '2006-02-16', 'Roman Catholic', 'Meycauayan City, Bulacan', 19, '95 Kiwi St., Brgy. Camalig, Meycauayan, Bulacan', 'Central Luzon', 'Bulacan', 'City of Meycauayan', 'Camalig', 'Peter Tiongson', 'Businessman', '09180000377', 'Lily Tiongson', 'Housewife', '09180000378', 'Lily Tiongson', 'Housewife', '09180000378', 'pending', 'Q369', '09180000369', 'albert369@gmail.com', NULL, '2025-06-01 08:00:00', NULL, 0, 0, 0, 0, 0),
(370, '40000000370', 'Janine Grace', 'Ibarra', 'Ramos', 'New Student', 'female', 'Grade 12', '', '2007-07-25', 'Roman Catholic', 'Meycauayan City, Bulacan', 17, '30 Melon St., Brgy. Malhacan, Meycauayan, Bulacan', 'Central Luzon', 'Bulacan', 'City of Meycauayan', 'Malhacan', 'Fred Ramos', 'Warehouse Staff', '09180000379', 'Lorna Ramos', 'Housewife', '09180000380', 'Lorna Ramos', 'Housewife', '09180000380', 'pending', 'Q370', '09180000370', 'janine370@gmail.com', NULL, '2025-06-01 08:00:00', NULL, 0, 0, 0, 0, 0),
(371, '40000000371', 'John Paul', 'Rivera', 'Pacheco', 'New Student', 'male', 'Grade 12', '', '2006-10-06', 'Roman Catholic', 'Meycauayan City, Bulacan', 18, '14 Rosal St., Brgy. Saluysoy, Meycauayan, Bulacan', 'Central Luzon', 'Bulacan', 'City of Meycauayan', 'Saluysoy', 'Dennis Pacheco', 'Driver', '09180000381', 'Lorna Pacheco', 'Housewife', '09180000382', 'Lorna Pacheco', 'Housewife', '09180000382', 'pending', 'Q371', '09180000371', 'john371@gmail.com', NULL, '2025-06-01 08:00:00', NULL, 0, 0, 0, 0, 0),
(372, '40000000372', 'Alyssa Mae', 'Cruz', 'Magpantay', 'New Student', 'female', 'Grade 12', '', '2007-04-12', 'Roman Catholic', 'Meycauayan City, Bulacan', 18, '27 Narra St., Brgy. Pandayan, Meycauayan, Bulacan', 'Central Luzon', 'Bulacan', 'City of Meycauayan', 'Pandayan', 'Rommel Magpantay', 'Technician', '09180000383', 'Gina Magpantay', 'Housewife', '09180000384', 'Gina Magpantay', 'Housewife', '09180000384', 'pending', 'Q372', '09180000372', 'alyssa372@gmail.com', NULL, '2025-06-01 08:00:00', NULL, 0, 0, 0, 0, 0),
(373, '40000000373', 'Christian Kyle', 'Reyes', 'Baldonado', 'New Student', 'male', 'Grade 12', '', '2006-06-18', 'Roman Catholic', 'Meycauayan City, Bulacan', 18, '6 Mabini St., Brgy. Camalig, Meycauayan, Bulacan', 'Central Luzon', 'Bulacan', 'City of Meycauayan', 'Camalig', 'Joel Baldonado', 'Painter', '09180000385', 'Mercy Baldonado', 'Housewife', '09180000386', 'Mercy Baldonado', 'Housewife', '09180000386', 'pending', 'Q373', '09180000373', 'christian373@gmail.com', NULL, '2025-06-01 08:00:00', NULL, 0, 0, 0, 0, 0),
(374, '40000000374', 'Trisha Anne', 'Dela Rosa', 'Aguas', 'New Student', 'female', 'Grade 12', '', '2007-09-29', 'Roman Catholic', 'Meycauayan City, Bulacan', 17, '88 Acacia St., Brgy. Malhacan, Meycauayan, Bulacan', 'Central Luzon', 'Bulacan', 'City of Meycauayan', 'Malhacan', 'Noel Aguas', 'Maintenance Staff', '09180000387', 'Vivian Aguas', 'Housewife', '09180000388', 'Vivian Aguas', 'Housewife', '09180000388', 'pending', 'Q374', '09180000374', 'trisha374@gmail.com', NULL, '2025-06-01 08:00:00', NULL, 0, 0, 0, 0, 0),
(375, '40000000375', 'Bryan James', 'Santiago', 'De Mesa', 'New Student', 'male', 'Grade 12', '', '2006-01-05', 'Roman Catholic', 'Meycauayan City, Bulacan', 19, '33 Sampaguita St., Brgy. Perez, Meycauayan, Bulacan', 'Central Luzon', 'Bulacan', 'City of Meycauayan', 'Perez', 'Arnold De Mesa', 'Carpenter', '09180000389', 'Liza De Mesa', 'Housewife', '09180000390', 'Liza De Mesa', 'Housewife', '09180000390', 'pending', 'Q375', '09180000375', 'bryan375@gmail.com', NULL, '2025-06-01 08:00:00', NULL, 0, 0, 0, 0, 0),
(376, '40000000376', 'Andrea Faith', 'Lopez', 'Marquez', 'New Student', 'female', 'Grade 12', '', '2007-11-17', 'Roman Catholic', 'Meycauayan City, Bulacan', 17, '9 Gumamela St., Brgy. Iba, Meycauayan, Bulacan', 'Central Luzon', 'Bulacan', 'City of Meycauayan', 'Iba', 'Rey Marquez', 'Sales Clerk', '09180000391', 'Rochelle Marquez', 'Housewife', '09180000392', 'Rochelle Marquez', 'Housewife', '09180000392', 'pending', 'Q376', '09180000376', 'andrea376@gmail.com', NULL, '2025-06-01 08:00:00', NULL, 0, 0, 0, 0, 0),
(377, '40000000377', 'Mark Vincent', 'Aquino', 'Lacsamana', 'New Student', 'male', 'Grade 12', '', '2006-03-30', 'Roman Catholic', 'Meycauayan City, Bulacan', 18, '41 Rosal St., Brgy. Saluysoy, Meycauayan, Bulacan', 'Central Luzon', 'Bulacan', 'City of Meycauayan', 'Saluysoy', 'Tony Lacsamana', 'Mechanic', '09180000393', 'Jenny Lacsamana', 'Housewife', '09180000394', 'Jenny Lacsamana', 'Housewife', '09180000394', 'pending', 'Q377', '09180000377', 'mark377@gmail.com', NULL, '2025-06-01 08:00:00', NULL, 0, 0, 0, 0, 0),
(378, '40000000378', 'Nicole Joy', 'Ramos', 'Cordero', 'New Student', 'female', 'Grade 12', '', '2007-02-22', 'Roman Catholic', 'Meycauayan City, Bulacan', 18, '72 Orchid St., Brgy. Pandayan, Meycauayan, Bulacan', 'Central Luzon', 'Bulacan', 'City of Meycauayan', 'Pandayan', 'Jun Cordero', 'Factory Worker', '09180000395', 'Leah Cordero', 'Housewife', '09180000396', 'Leah Cordero', 'Housewife', '09180000396', 'pending', 'Q378', '09180000378', 'nicole378@gmail.com', NULL, '2025-06-01 08:00:00', NULL, 0, 0, 0, 0, 0),
(379, '40000000379', 'Joshua Neil', 'Garcia', 'Punzalan', 'New Student', 'male', 'Grade 12', '', '2006-07-14', 'Roman Catholic', 'Meycauayan City, Bulacan', 18, '19 Rizal Ave., Brgy. Camalig, Meycauayan, Bulacan', 'Central Luzon', 'Bulacan', 'City of Meycauayan', 'Camalig', 'Arvin Punzalan', 'Delivery Rider', '09180000397', 'Grace Punzalan', 'Housewife', '09180000398', 'Grace Punzalan', 'Housewife', '09180000398', 'pending', 'Q379', '09180000379', 'joshua379@gmail.com', NULL, '2025-06-01 08:00:00', NULL, 0, 0, 0, 0, 0),
(380, '40000000380', 'Maureen Claire', 'Flores', 'Valerio', 'New Student', 'female', 'Grade 12', '', '2007-05-26', 'Roman Catholic', 'Meycauayan City, Bulacan', 18, '54 Ilang-ilang St., Brgy. Malhacan, Meycauayan, Bulacan', 'Central Luzon', 'Bulacan', 'City of Meycauayan', 'Malhacan', 'Dan Valerio', 'Warehouse Checker', '09180000399', 'Mila Valerio', 'Housewife', '09180000400', 'Mila Valerio', 'Housewife', '09180000400', 'pending', 'Q380', '09180000380', 'maureen380@gmail.com', NULL, '2025-06-01 08:00:00', NULL, 0, 0, 0, 0, 0),
(414, '00000000000', 'MC', 'Apelido', 'Escalora', 'New Student', 'male', 'Kinder', '', '2021-06-14', 'Catholic', 'Marilao, Bulacan', 4, 'Santa Rosa I, Marilao, Bulacan, Central Luzon,', NULL, NULL, NULL, NULL, 'Arnold Padilla', 'Sales Executive', '09178234915', 'Daniela Trujillo', 'Human Resources Officer', '09123456715', 'Sonia  Padilla', 'House Wife', '09178234915', 'for_review', 'Q411752', '09123456789', 'siyetot898@coswz.com', NULL, '2026-01-26 00:10:31', 'N/A', 1, 1, 1, 1, 1),
(420, '', 'test', 'test', 'test', 'New Student', 'male', 'Nursery', '', '2020-02-22', 'Confucianism', 'Batangas City', 5, 'Binalan, Aparri, Cagayan, Cagayan Valley, ', 'Cagayan Valley', 'Cagayan', 'Aparri', 'Binalan', '', '', '', '', '', '', 'Fyke Lleva', 'Fyke Lleva', '99952970623', 'pending', 'Q666433', '09123456789', 'floterina@gmail.com', NULL, '2026-02-09 20:26:41', NULL, 0, 0, 0, 0, 0),
(421, '', 'Fyke', '', 'Lleva', 'New Student', 'male', 'Grade 3', '', '2020-02-22', 'Jehovah&#039;s Witnesses', 'Boliney|ABR', 5, 'Concepcion, Cabiao, Nueva Ecija, Central Luzon, ', 'Central Luzon', 'Nueva Ecija', 'Cabiao', 'Concepcion', '', '', '', '', '', '', 'test', 'test', '09120912091', 'pending', 'Q729328', '09123456789', 'floterina@gmail.com', NULL, '2026-02-09 20:46:05', NULL, 0, 0, 0, 0, 0),
(422, '', 'Enrico Joseph Drei', 'Tante', 'Acuña', 'New Student', 'male', 'Grade 1', '', '2018-11-24', 'Born Again Christian', 'Meycauayan|BUL', 7, 'Libtong, City of Meycauayan, Bulacan, Central Luzon, ', 'Central Luzon', 'Bulacan', 'City of Meycauayan', 'Libtong', 'Eries Joseph Acuna', 'Merchandiser', '09519581286', 'Ma Lorie Ann Tante', 'Team Leader', '09946512369', 'Ma Lorie Ann Tante', '', '09946512369', 'pending', 'Q708008', '09123456789', 'mlatante0614@gmail.com', NULL, '2026-02-15 06:24:19', NULL, 0, 0, 0, 0, 0);

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

--
-- Dumping data for table `admission_old`
--

INSERT INTO `admission_old` (`id`, `grade_level`, `strand`, `gender`, `student_id`, `que_code`, `admission_status`, `last_name`, `first_name`, `middle_name`, `birth_date`, `birth_place`, `age`, `religion`, `guardian_phone`, `email`, `created_at`) VALUES
(24, 'Grade 2', 'N/A', 'Female', '2026-62962', 'Q071491', 'approved', 'Velasco', 'Alyssa Mae', 'Romero', '2018-04-15', 'Quezon City, Metro Manila', 7, 'Roman Catholic', '09178234915', 'davebergania367@gmail.com', '2026-01-28 20:40:33');

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
(1, 'Welcome to school year 2025-2026!', 'Start of classes on June 26, 2025. Enjoy your first day Cardinalians! ', 1),
(0, 'Announcement', 'Enrollment Ongoing', 0),
(0, 'test', 'test', 0);

-- --------------------------------------------------------

--
-- Table structure for table `announcements`
--

CREATE TABLE `announcements` (
  `id` int(11) NOT NULL,
  `acc_type` varchar(100) NOT NULL,
  `message` varchar(1000) NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `announcements`
--

INSERT INTO `announcements` (`id`, `acc_type`, `message`, `date`) VALUES
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
(25, 'teacher', 'Parent-Teacher Conference is scheduled on July 22, 2025. Attendance is mandatory for all parents.', '2025-07-01 09:00:00'),
(26, 'teacher', 'The school will host a Family Day event on August 15, 2025. Please join us for fun activities and learning.', '2025-07-03 14:30:00'),
(27, 'teacher', 'A new message from your child\'s adviser is available regarding academic performance.', '2025-07-05 10:15:00'),
(28, 'teacher', 'Monthly academic performance reports have been uploaded. Please check your parent portal.', '2025-07-07 08:45:00'),
(29, 'teacher', 'Reminder: Settlement of tuition fees is due on July 20, 2025. Kindly ensure timely payment.', '2025-07-09 16:20:00'),
(30, 'teacher', 'You are invited to join the virtual orientation for the new school year on July 18, 2025.', '2025-07-10 13:10:00'),
(31, 'teacher', 'A medical bulletin has been released regarding campus health and safety. Please read carefully.', '2025-07-11 11:00:00'),
(32, 'teacher', 'Please check your inbox for the July school newsletter containing updates and important notices.', '2025-07-12 07:55:00'),
(33, 'teacher', 'Field trip consent forms must be submitted before July 20, 2025. Ensure your child is registered.', '2025-07-13 15:30:00'),
(34, 'student', 'Welcome back to the new school year! Orientation will be held on July 15, 2025.', '2025-07-01 08:00:00'),
(35, 'student', 'Reminder: Submit your summer reading assignments by July 18, 2025.', '2025-07-02 09:30:00'),
(36, 'student', 'The library will have extended hours during exam week starting July 20, 2025.', '2025-07-03 10:00:00'),
(37, 'student', 'School ID distribution will be on July 17, 2025. Make sure to collect yours.', '2025-07-04 11:15:00'),
(38, 'student', 'Sports tryouts for basketball and volleyball will begin on July 19, 2025.', '2025-07-05 13:00:00'),
(39, 'student', 'Submit your laboratory safety forms before July 20, 2025.', '2025-07-06 14:20:00'),
(40, 'student', 'Join the student council meeting on July 21, 2025 at 3:00 PM in the auditorium.', '2025-07-07 15:10:00'),
(41, 'student', 'Art club registration is open until July 22, 2025. Sign up in the student portal.', '2025-07-08 09:45:00'),
(42, 'student', 'Reminder: School ID photos will be taken on July 23, 2025. Be in proper uniform.', '2025-07-09 08:30:00'),
(51, 'student', 'Your child has received a commendation for outstanding behavior this week.', '2025-10-12 18:58:17'),
(52, 'parent', 'Your child has received a commendation for outstanding behavior this week.', '2025-10-12 18:58:48'),
(54, 'student', 'test test test', '2025-11-29 20:17:43'),
(55, 'student', 'TEST', '2026-01-29 09:52:17');

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
  `accept` varchar(1) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `assignments`
--

INSERT INTO `assignments` (`assignment_id`, `title`, `instructions`, `points`, `due_date`, `due_time`, `teacher_id`, `course_id`, `attachment`, `created_at`, `accept`) VALUES
(39, 'test', 'test', 50, '2025-12-31', '14:00:00', 40, 25, 'assignment_69456570c92ca.docx', '2025-12-19 14:47:12', '0'),
(40, 'cap2', 'capstone', 10, '2026-01-31', '00:00:00', 40, 42, NULL, '2026-01-29 01:43:16', '0'),
(41, 'test', 'test', 100, '2026-02-03', '00:00:00', 40, 42, NULL, '2026-02-02 01:27:32', '1');

-- --------------------------------------------------------

--
-- Table structure for table `assignment_submissions`
--

CREATE TABLE `assignment_submissions` (
  `submission_id` int(11) NOT NULL,
  `student_id` int(11) DEFAULT NULL,
  `assignment_id` int(11) DEFAULT NULL,
  `submission_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `file_path` text DEFAULT NULL,
  `file_url` varchar(255) DEFAULT NULL,
  `grade` int(11) DEFAULT NULL,
  `feedback` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `assignment_submissions`
--

INSERT INTO `assignment_submissions` (`submission_id`, `student_id`, `assignment_id`, `submission_date`, `file_path`, `file_url`, `grade`, `feedback`) VALUES
(65, 265, 40, '2026-01-29 01:46:04', '[\"1769651164_AAA.png\"]', NULL, NULL, NULL),
(66, 267, 41, '2026-02-02 01:29:20', NULL, 'https://acadesys.site/student/view_assignment.php?id=41&course_id=42', 89, 'good job pasado');

-- --------------------------------------------------------

--
-- Table structure for table `attendance`
--

CREATE TABLE `attendance` (
  `id` int(11) NOT NULL,
  `parent_id` int(11) NOT NULL,
  `date` date NOT NULL,
  `time_in` time DEFAULT NULL,
  `course_id` int(11) NOT NULL,
  `rfid` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `first_name` varchar(100) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `status` enum('present','absent') NOT NULL DEFAULT 'present'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `attendance`
--

INSERT INTO `attendance` (`id`, `parent_id`, `date`, `time_in`, `course_id`, `rfid`, `user_id`, `first_name`, `last_name`, `status`) VALUES
(104, 3, '2025-12-17', '15:14:31', 33, 1603483088, 102, 'Noah', 'Ramos', 'present'),
(105, 3, '2026-01-28', '21:00:44', 40, 33332, 182, 'Aaron Joseph', 'Ramos', 'present'),
(106, 3, '2026-01-29', '02:55:20', 40, 33332, 182, 'Aaron Joseph', 'Ramos', 'present'),
(107, 3, '2026-01-29', '09:40:58', 42, 1189156229, 265, 'nick', 'azcueta', 'present'),
(108, 268, '2026-02-02', '08:34:40', 23, 1190247381, 267, 'Andrew Paul', 'Wilson', 'present'),
(123, 0, '2026-02-16', '04:27:46', 40, 88889, 238, 'Camille Joy', 'Alcantara', 'present'),
(124, 0, '2026-02-16', '04:28:03', 40, 88882, 232, 'Adrian Lee', 'Chua', 'present'),
(125, 0, '2026-02-16', '04:28:14', 40, 77771, 220, 'Bianca Louise', 'De Leon', 'present'),
(126, 0, '2026-02-16', '04:28:23', 40, 10004, 254, 'Bryan Keith', 'Enriquez', 'present'),
(127, 0, '2026-02-16', '08:28:34', 40, 12411, 179, 'Bryan Paul', 'Enriquez', 'present');

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
(26, 31, 'Core 3', 'General Mathematics', '8:00 AM-9:00 AM', 'Leoncia Ala', '101'),
(35, 27, 'eng', 'English', '08:00 AM – 09:00 AM', 'Niña Francesca Tan', '301'),
(36, 27, 'Fil', 'Filipino', '09:00 AM – 10:00 AM', 'Ann Nicole De Lara', '301'),
(37, 27, 'Math', 'Mathematics', '10:00 AM – 11:00 AM', 'Ann Nicole De Lara', '301'),
(38, 27, 'Scie', 'Science', '11:00 AM – 12:00 PM', 'Rosilyn Agliam', '301'),
(39, 27, 'AP', 'Araling Panlipunan', '01:00 PM – 02:00 PM', 'Ria Velasco', '301'),
(53, 21, 'Fil', 'Filipino', '11:00 AM – 12:00 PM', 'Anna Lie Del Mundo', '102'),
(54, 21, 'Eng', 'English', '01:00 PM – 02:00 PM', 'Anna Lie Del Mundo', '102'),
(55, 21, 'Math', 'Mathematics', '02:00 PM – 03:00 PM', 'Anna Lie Del Mundo', '102'),
(57, 21, 'GMRC', 'Good Manner and Right Conduct', '04:30 PM – 05:30 PM', 'Anna Lie Del Mundo', '102'),
(58, 20, 'Fil', 'Filipino', '05:30 AM – 06:30 AM', 'Anna Lie Del Mundo', '102'),
(59, 20, 'Eng', 'English', '06:30 AM – 07:30 AM', 'Ann Nicole De Lara', '102'),
(60, 20, 'Math', 'Mathematics', '08:00 AM – 09:00 AM', 'Anna Lie Del Mundo', '102'),
(61, 20, 'MK', 'Makabansa', '09:00 AM – 10:00 AM', 'Anna Lie Del Mundo', '102'),
(62, 20, 'GMRC', 'Good Manner and Right Conduct', '10:00 AM – 11:00 AM', 'Anna Lie Del Mundo', '102'),
(63, 21, 'MK', 'Makabansa', '03:30 PM – 04:30 PM', 'Anna Lie Del Mundo', '102'),
(67, 49, 'LLC', 'Literacy, Language, and Communication', '06:30 AM – 07:30 AM', 'Jocelyn Martinico', '201'),
(68, 49, 'SED', 'Socio-Emotional Development', '07:30 AM – 08:30 AM', 'Jocelyn Martinico', '201'),
(69, 49, 'ValD', 'Values Development', '09:00 AM – 10:00 AM', 'Jocelyn Martinico', '201'),
(70, 49, 'PHMD', 'Physical Health and Motor Development', '10:00 AM – 11:00 AM', 'Jocelyn Martinico', '201'),
(71, 49, 'ACD', 'Aesthetic / Creative Development', '11:00 AM – 12:00 PM', 'Jocelyn Martinico', '201'),
(72, 49, 'CogDev', 'Cognitive Devoelopment', '01:00 PM – 02:00 PM', 'Jocelyn Martinico', '201'),
(73, 50, 'LLC', 'Literacy, Language, and Communication', '06:30 AM – 07:30 AM', 'Mark Edrian Navarro', '202'),
(74, 50, 'SED', 'Socio-Emotional Development', '07:30 AM – 08:30 AM', 'Mark Edrian Navarro', '202'),
(75, 50, 'ValD', 'Values Development', '09:00 AM – 10:00 AM', 'Mark Edrian Navarro', '202'),
(76, 50, 'PHMD', 'Physical Health and Motor Development', '10:00 AM – 11:00 AM', 'Mark Edrian Navarro', '202'),
(77, 50, 'ACD', 'Aesthetic / Creative Development', '11:00 AM – 12:00 PM', 'Mark Edrian Navarro', '202'),
(78, 50, 'CogDev', 'Cognitive Devoelopmen', '01:00 PM – 02:00 PM', 'Mark Edrian Navarro', '202'),
(79, 22, 'Fil', 'Filipino', '05:00 AM – 07:00 AM', 'Ria Velasco', '103'),
(80, 22, 'Eng', 'English', '06:00 PM – 07:00 PM', 'Ria Velasco', '103'),
(81, 22, 'Math', 'Mathematics', '07:30 AM – 08:30 PM', 'Ria Velasco', '103'),
(82, 22, 'MK', 'Makabansa', '08:30 AM – 09:30 AM', 'Ria Velasco', '103'),
(83, 22, 'GMRC', 'Good Manner and Right Conduct', '10:00 AM – 11:00 AM', 'Ria Velasco', '103'),
(87, 36, 'Fil', 'Filipino', '08:00 AM – 09:00 AM', 'Kim Mancenido', '303'),
(88, 36, 'Eng', 'English', '09:00 AM – 10:00 AM', 'Kim Mancenido', '303'),
(89, 36, 'Scie', 'Science', '10:00 AM – 11:00 AM', 'Kim Mancenido', '303'),
(90, 36, 'Math', 'Mathematics', '11:00 AM – 12:00 PM', 'Kim Mancenido', '303'),
(91, 36, 'AP', 'Music Arts - Physical Education and Health', '01:00 PM – 02:00 PM', 'Kim Mancenido', '303'),
(92, 36, 'MAPEH', 'Araling Panlipunan', '02:00 PM – 03:00 PM', 'Kim Mancenido', '303'),
(93, 36, 'EPP', 'Edukasyong Pantahanan at Pangkabuhayan', '03:30 PM – 04:30 PM', 'Kim Mancenido', '303'),
(94, 36, 'GMRC', 'Good Manner and Right Conduct', '04:30 PM – 05:30 PM', 'Kim Mancenido', '303'),
(95, 24, 'Fil', 'Filipino', '08:00 AM – 09:00 AM', 'Rosilyn Agliam', '105'),
(96, 24, 'Eng', 'English', '09:00 AM – 10:00 AM', 'Rosilyn Agliam', '105'),
(97, 24, 'Scie', 'Science', '10:00 AM – 11:00 PM', 'Rosilyn Agliam', '105'),
(98, 24, 'Math', 'Mathematics', '11:00 AM – 12:00 PM', 'Rosilyn Agliam', '105'),
(99, 24, 'AP', 'Music Arts - Physical Education and Health', '01:00 PM – 02:00 PM', 'Rosilyn Agliam', '105'),
(100, 24, 'MAPEH', 'Araling Panlipunan', '02:00 PM – 03:00 PM', 'Rosilyn Agliam', '105'),
(101, 24, 'EPP', 'Edukasyong Pantahanan at Pangkabuhayan', '03:30 PM – 04:30 PM', 'Rosilyn Agliam', '105'),
(102, 24, 'GMRC', 'Good Manner and Right Conduct', '04:30 PM – 5:30 PM', 'Rosilyn Agliam', '105'),
(103, 37, 'Fil', 'Filipino', '08:00 AM – 09:00 AM', 'Leoncia Ala', '303'),
(104, 37, 'Eng', 'English', '09:00 AM – 10:00 AM', 'Leoncia Ala', '303'),
(105, 37, 'Scie', 'Science', '10:00 AM – 11:00 AM', 'Leoncia Ala', '303'),
(106, 37, 'Math', 'Mathematics', '11:00 AM – 12:00 PM', 'Leoncia Ala', '303'),
(107, 37, 'AP', 'Music Arts - Physical Education and Health', '01:00 PM – 02:00 PM', 'Leoncia Ala', '303'),
(108, 37, 'MAPEH', 'Araling Panlipunan', '02:00 PM – 03:00 PM', 'Leoncia Ala', '303'),
(109, 37, 'TLE', 'Technology and Livelihood Education', '03:30 PM – 04:30 PM', 'Leoncia Ala', '303'),
(110, 37, 'ESP', 'Edukasyon sa Pagpapakatao', '04:30 PM – 5:30 PM', 'Leoncia Ala', '303'),
(111, 52, 'Fil', 'Filipino', '08:00 AM – 09:05 AM', 'Ellie Ann Joy Pahugot', '107'),
(112, 52, 'Eng', 'English', '09:00 AM – 10:00 AM', 'Ellie Ann Joy Pahugot', '107'),
(113, 52, 'Scie', 'Science', '10:00 AM – 11:00 AM', 'Ellie Ann Joy Pahugot', '107'),
(114, 52, 'Math', 'Mathematics', '11:00 AM – 12:00 PM', 'Ellie Ann Joy Pahugot', '107'),
(115, 52, 'AP', 'Music Arts - Physical Education and Health', '01:00 PM – 02:00 PM', 'Ellie Ann Joy Pahugot', '107'),
(116, 52, 'MAPEH', 'Araling Panlipunan', '02:00 PM – 03:00 PM', 'Ellie Ann Joy Pahugot', '107'),
(117, 52, 'TLE', 'Technology and Livelihood Education', '03:30 PM – 04:30 PM', 'Ellie Ann Joy Pahugot', '107'),
(118, 52, 'ValD', 'Values Development', '04:30 PM – 5:30 PM', 'Ellie Ann Joy Pahugot', '107'),
(119, 25, 'Fil', 'Filipino', '08:00 AM – 09:00 AM', 'Leoncia Ala', '108'),
(120, 25, 'Eng', 'English', '09:00 AM – 10:00 AM', 'Leoncia Ala', '108'),
(121, 25, 'Scie', 'Science', '10:00 AM – 11:00 PM', 'Leoncia Ala', '108'),
(122, 25, 'Math', 'Mathematics', '11:00 AM – 12:00 AM', 'Leoncia Ala', '108'),
(123, 25, 'AP', 'Music Arts - Physical Education and Health', '01:00 PM – 02:00 PM', 'Leoncia Ala', '108'),
(124, 25, 'MAPEH', 'Araling Panlipunan', '02:00 PM – 03:00 PM', 'Leoncia Ala', '108'),
(125, 25, 'TLE', 'Technology and Livelihood Education', '03:30 AM – 04:30 AM', 'Leoncia Ala', '108'),
(126, 25, 'ValD', 'Values Development', '04:30 PM – 5:30 PM', 'Leoncia Ala', '108'),
(127, 26, 'Fil', 'Filipino', '08:00 AM – 09:00 AM', 'Leoncia Ala', '108'),
(128, 26, 'Eng', 'English', '09:00 AM – 10:00 AM', 'Leoncia Ala', '108'),
(129, 26, 'Scie', 'Science', '10:00 AM – 11:00 PM', 'Leoncia Ala', '108'),
(130, 26, 'Math', 'Mathematics', '11:00 AM – 12:00 AM', 'Leoncia Ala', '108'),
(131, 26, 'AP', 'Music Arts - Physical Education and Health', '01:00 PM – 02:00 PM', 'Leoncia Ala', '108'),
(132, 26, 'MAPEH', 'Araling Panlipunan', '02:00 PM – 03:00 PM', 'Leoncia Ala', '108'),
(133, 26, 'TLE', 'Technology and Livelihood Education', '03:30 AM – 04:30 AM', 'Leoncia Ala', '108'),
(134, 26, 'ValD', 'Values Development', '04:30 AM – 5:30 PM', 'Leoncia Ala', '108'),
(148, 19, 'MK', 'Makabansa', '06:30 AM – 07:30 AM', 'Stephany Gandula', '101'),
(149, 19, 'Math', 'Mathematics', '07:30 AM – 08:30 AM', 'Stephany Gandula', '101'),
(150, 19, 'Eng', 'English', '09:30 AM – 10:30 AM', 'Stephany Gandula', '101'),
(151, 19, 'Fil', 'Filipino', '11:00 AM – 12:00 PM', 'Stephany Gandula', '101'),
(152, 19, 'Scie', 'Science', '01:00 PM – 02:00 PM', 'Stephany Gandula', '101'),
(153, 53, 'MK', 'Makabansa', '06:30 AM – 07:30 AM', 'Stephany Gandula', '101'),
(154, 53, 'Math', 'Mathematics', '07:30 AM – 08:30 AM', 'Stephany Gandula', '101'),
(155, 53, 'Eng', 'English', '09:30 AM – 10:30 AM', 'Stephany Gandula', '101'),
(156, 53, 'Fil', 'Filipino', '11:00 AM – 12:00 PM', 'Stephany Gandula', '101'),
(157, 53, 'Scie', 'Science', '01:00 PM – 02:00 PM', 'Stephany Gandula', '101');

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE `courses` (
  `id` int(11) NOT NULL,
  `teacher_id` int(11) NOT NULL,
  `joined_id` int(11) NOT NULL,
  `course_name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `day` enum('Everyday','Monday','Tuesday','Wednesday','Thursday','Friday','Saturday','Sunday') NOT NULL,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL,
  `grade_level` text NOT NULL,
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

INSERT INTO `courses` (`id`, `teacher_id`, `joined_id`, `course_name`, `description`, `day`, `start_time`, `end_time`, `grade_level`, `section`, `subject`, `room`, `cover_photo`, `created_at`, `updated_at`, `status`) VALUES
(16, 40, 12432415, 'Filipino 1', 'Pag-aaral ng wikang Filipino at panitikan para sa elementarya', 'Monday', '08:00:00', '09:00:00', '', 'Grade 1-A', 'Filipino', 'Room 101', '1757440819_68c06b3368c26.jpg', '2025-09-09 16:50:30', '2025-09-30 22:07:21', 'inactive'),
(17, 40, 12432415, 'English 1', 'Basic English communication skills for elementary pupils', 'Monday', '09:00:00', '10:00:00', '', 'Grade 1-A', 'English', 'Room 101', '1757440796_68c06b1ca2b90.jpg', '2025-09-09 16:50:30', '2025-09-30 22:07:16', 'active'),
(18, 40, 12432416, 'Mathematics 1', 'Basic arithmetic: addition, subtraction, multiplication, division', 'Tuesday', '08:00:00', '09:00:00', '', 'Grade 1-A', 'Mathematics', 'Room 101', '1757440221_68c068dddb5a2.jpg', '2025-09-09 16:50:30', '2025-09-30 22:06:54', 'active'),
(19, 40, 12432415, 'Araling Panlipunan 1', 'Pag-aaral tungkol sa kasaysayan, heograpiya at kultura', 'Tuesday', '09:10:00', '10:10:00', '', 'Grade 1-A', 'Araling Panlipunan', 'Room 101', '1757440786_68c06b12b2113.jpg', '2025-09-09 16:50:30', '2025-09-30 22:06:47', 'active'),
(20, 40, 12432416, 'Science 1', 'Introduction to natural and physical sciences for children', 'Saturday', '08:00:00', '09:00:00', '', 'Grade 1-A', 'Science', 'Room 101', '1757440776_68c06b08c728c.jpg', '2025-09-09 16:50:30', '2025-09-30 22:06:43', 'active'),
(21, 40, 12432417, 'Edukasyon sa Pagpapakatao (EsP) 1', 'Pagpapahalaga, tamang asal at wastong gawi', 'Wednesday', '09:10:00', '10:10:00', '', 'Grade 1-A', 'EsP', 'Room 101', '1757440765_68c06afd441c2.jpg', '2025-09-09 16:50:30', '2025-09-30 22:06:30', 'active'),
(22, 40, 12432418, 'MAPEH 1', 'Music, Arts, Physical Education, and Health integration', 'Thursday', '08:00:00', '09:00:00', '', 'Grade 1-A', 'MAPEH', 'Room 102', '1757440654_68c06a8e3d51c.jpg', '2025-09-09 16:50:30', '2025-09-30 22:06:14', 'active'),
(23, 40, 12432419, 'Music 1', 'Learning basic rhythm, singing, and instruments', 'Thursday', '09:10:00', '10:10:00', '', 'Grade 1-A', 'Music', 'Room 102', '1757440257_68c06901ddd75.jpg', '2025-09-09 16:50:30', '2025-09-30 22:06:22', 'active'),
(24, 40, 12432420, 'Arts 1', 'Exploring creativity through drawing, coloring, and crafts', 'Friday', '08:00:00', '09:00:00', '', 'Grade 1-A', 'Arts', 'Room 102', '1757440185_68c068b9ce30f.jpg', '2025-09-09 16:50:30', '2025-09-30 22:06:07', 'active'),
(25, 40, 12432421, 'Physical Education 1', 'Basic exercises, games, and fitness for children', 'Tuesday', '10:00:00', '11:00:00', '', 'Grade 1-A', 'Physical Education', 'Gymnasium', '1757440156_68c0689c9e487.jpg', '2025-09-09 16:50:30', '2025-09-30 22:06:00', 'active'),
(27, 41, 12432422, 'test', 'test', 'Monday', '09:00:00', '22:00:00', '', 'TEST', 'MATH', 'TEST', '1758796910_6464eed4-e4b4-42fb-a27f-f481b14affe6.jpeg', '2025-09-25 10:41:50', '2025-09-25 10:41:50', 'active'),
(28, 41, 17874277, 'Science123', 'bata', 'Monday', '07:34:00', '22:34:00', '', 'fyke_1', 'Science123', '200001', NULL, '2025-09-25 10:43:27', '2025-09-25 10:43:27', 'active'),
(31, 39, 26303257, 'English 1 - Moonstone', 'English for grade 1', 'Monday', '08:00:00', '09:00:00', '', 'Moonstone', 'English', '101', NULL, '2025-10-09 17:41:58', '2025-10-09 17:41:58', 'active'),
(32, 39, 73565266, 'Filipino 1 - Moonstone', 'Filipino for grade 1', 'Everyday', '09:00:00', '10:00:00', '', 'Moonstone', 'Filipino', '101', NULL, '2025-10-09 17:43:03', '2025-10-09 17:44:15', 'active'),
(33, 39, 56408706, 'Science 1 - Moonstone', 'Science for grade 1', 'Everyday', '10:00:00', '11:00:00', '', 'Moonstone', 'Science', '101', NULL, '2025-10-09 17:43:55', '2025-10-09 17:44:54', 'active'),
(34, 39, 27772923, 'Makabansa 1 - Moonstone', 'Makabansa subject for grade 1', 'Everyday', '13:00:00', '14:00:00', '', 'Moonstone', 'Mathematics', '101', NULL, '2025-10-09 17:46:23', '2025-10-09 17:46:23', 'active'),
(35, 39, 19062700, 'Mathematics 1 - Moonstone', 'Mathematics for grade 1', 'Everyday', '14:00:00', '15:00:00', '', 'Moonstone', 'Mathematics', '101', NULL, '2025-10-09 17:47:20', '2025-10-19 04:59:35', 'inactive'),
(37, 46, 18214557, 'English', '', 'Everyday', '17:23:00', '20:23:00', '', 'grade-1 mabini', 'English', '101', NULL, '2025-10-22 07:23:59', '2025-10-22 07:23:59', 'active'),
(38, 39, 73368716, 'Mathermatics', 'Mathermatics for grade 1', 'Everyday', '09:29:00', '11:00:00', 'Grade 11', 'Moonstone', 'Mathermatics', 'Room 101', NULL, '2025-11-29 06:02:54', '2026-01-28 18:58:52', 'active'),
(39, 51, 91167406, 'test', 'test', 'Tuesday', '22:35:00', '23:35:00', 'Kinder 1', '', 'Science', 'NE201', NULL, '2025-12-06 07:35:09', '2025-12-06 07:35:09', 'active'),
(40, 39, 84762861, 'P.E 1', 'Physical Education for Grade 1', 'Everyday', '07:00:00', '12:00:00', 'Grade 10', 'Moonstone', 'Physical Education', '202', NULL, '2026-01-24 10:00:30', '2026-01-28 18:58:23', 'active'),
(41, 40, 19165743, 'Makabansa 1', '', 'Everyday', '06:30:00', '07:30:00', 'Grade 1', '', 'Makabansa', '101', NULL, '2026-01-26 16:10:46', '2026-01-26 16:20:43', 'active'),
(42, 40, 94466784, 'Filipino 1', '', 'Everyday', '11:00:00', '12:00:00', 'Kinder 1', '', 'Filipino', '101', NULL, '2026-01-28 20:29:49', '2026-02-06 14:20:55', 'inactive');

-- --------------------------------------------------------

--
-- Table structure for table `course_students`
--

CREATE TABLE `course_students` (
  `id` int(11) NOT NULL,
  `course_id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `joined_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `q1` decimal(10,0) NOT NULL DEFAULT 0,
  `q2` decimal(10,0) NOT NULL DEFAULT 0,
  `q3` decimal(10,0) NOT NULL DEFAULT 0,
  `q4` decimal(10,0) NOT NULL DEFAULT 0,
  `status` text NOT NULL DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `course_students`
--

INSERT INTO `course_students` (`id`, `course_id`, `student_id`, `joined_at`, `q1`, `q2`, `q3`, `q4`, `status`) VALUES
(117, 38, 102, '2025-12-04 10:32:09', 80, 80, 90, 80, 'approved'),
(118, 39, 156, '2025-12-06 07:35:34', 0, 0, 0, 0, 'approved'),
(120, 34, 102, '2025-12-16 21:43:40', 0, 0, 0, 0, 'pending'),
(121, 33, 102, '2025-12-17 07:01:46', 0, 0, 0, 0, 'pending'),
(122, 25, 102, '2025-12-19 14:45:57', 80, 80, 80, 80, 'pending'),
(123, 31, 102, '2026-01-19 02:24:34', 90, 89, 91, 90, 'pending'),
(124, 38, 190, '2026-01-24 09:30:20', 0, 0, 0, 0, 'pending'),
(125, 40, 182, '2026-01-24 10:01:50', 75, 74, 75, 75, 'approved'),
(137, 41, 168, '2026-01-26 16:11:16', 80, 80, 80, 80, 'approved'),
(138, 41, 167, '2026-01-26 16:11:32', 80, 80, 80, 80, 'pending'),
(139, 41, 166, '2026-01-26 16:11:44', 80, 90, 89, 88, 'pending'),
(140, 41, 165, '2026-01-26 16:11:53', 86, 88, 83, 82, 'pending'),
(141, 41, 164, '2026-01-26 16:12:05', 84, 81, 82, 81, 'pending'),
(142, 41, 163, '2026-01-26 16:12:15', 85, 83, 82, 81, 'pending'),
(143, 41, 162, '2026-01-26 16:12:30', 81, 85, 84, 83, 'pending'),
(144, 41, 161, '2026-01-26 16:12:39', 82, 83, 85, 86, 'pending'),
(145, 41, 160, '2026-01-26 16:12:48', 85, 89, 87, 88, 'pending'),
(146, 41, 159, '2026-01-26 16:13:33', 88, 87, 89, 90, 'pending'),
(147, 18, 168, '2026-01-26 16:34:15', 80, 80, 80, 80, 'approved'),
(148, 18, 167, '2026-01-26 16:34:25', 85, 87, 88, 90, 'pending'),
(149, 18, 166, '2026-01-26 16:34:48', 80, 80, 80, 98, 'pending'),
(150, 18, 165, '2026-01-26 16:34:55', 83, 78, 87, 88, 'pending'),
(151, 18, 164, '2026-01-26 16:35:05', 87, 88, 86, 84, 'pending'),
(152, 18, 163, '2026-01-26 16:35:13', 0, 0, 0, 0, 'pending'),
(153, 18, 162, '2026-01-26 16:35:25', 0, 0, 0, 0, 'pending'),
(154, 18, 161, '2026-01-26 16:38:18', 0, 0, 0, 0, 'pending'),
(155, 18, 160, '2026-01-26 16:38:26', 0, 0, 0, 0, 'pending'),
(156, 18, 159, '2026-01-26 16:38:37', 0, 0, 0, 0, 'pending'),
(157, 17, 168, '2026-01-28 20:25:47', 90, 90, 90, 90, 'approved'),
(158, 17, 167, '2026-01-28 20:26:05', 0, 0, 0, 0, 'pending'),
(159, 17, 166, '2026-01-28 20:26:16', 0, 0, 0, 0, 'pending'),
(160, 17, 165, '2026-01-28 20:26:25', 0, 0, 0, 0, 'pending'),
(161, 17, 164, '2026-01-28 20:26:35', 0, 0, 0, 0, 'pending'),
(162, 17, 163, '2026-01-28 20:26:56', 0, 0, 0, 0, 'pending'),
(163, 17, 162, '2026-01-28 20:27:10', 0, 0, 0, 0, 'pending'),
(164, 17, 161, '2026-01-28 20:27:29', 0, 0, 0, 0, 'pending'),
(165, 17, 160, '2026-01-28 20:27:40', 0, 0, 0, 0, 'pending'),
(166, 17, 159, '2026-01-28 20:27:53', 0, 0, 0, 0, 'pending'),
(167, 42, 168, '2026-01-28 20:31:04', 87, 88, 89, 90, 'approved'),
(168, 20, 168, '2026-01-28 20:32:36', 89, 89, 90, 92, 'approved'),
(169, 42, 265, '2026-01-29 01:37:50', 0, 0, 0, 0, 'pending'),
(170, 42, 267, '2026-02-02 01:26:47', 91, 93, 98, 96, 'approved'),
(171, 23, 267, '2026-02-02 01:34:25', 90, 97, 98, 91, 'approved'),
(172, 41, 267, '2026-02-02 01:40:57', 75, 75, 60, 70, 'approved'),
(173, 42, 182, '2026-02-06 09:56:10', 0, 0, 0, 0, 'pending'),
(174, 41, 182, '2026-02-06 17:43:52', 90, 92, 93, 94, 'pending'),
(175, 18, 182, '2026-02-06 17:43:59', 97, 96, 95, 94, 'pending'),
(176, 19, 182, '2026-02-06 17:44:05', 95, 94, 93, 92, 'pending'),
(177, 17, 182, '2026-02-06 17:44:26', 98, 95, 96, 94, 'pending'),
(178, 20, 182, '2026-02-06 17:45:04', 93, 92, 91, 90, 'pending'),
(179, 41, 155, '2026-02-06 17:48:13', 92, 93, 94, 95, 'approved'),
(180, 18, 155, '2026-02-06 17:48:20', 91, 92, 91, 90, 'approved'),
(181, 19, 155, '2026-02-06 17:48:24', 95, 94, 93, 92, 'approved'),
(182, 20, 155, '2026-02-06 17:48:31', 93, 92, 90, 91, 'approved'),
(183, 17, 155, '2026-02-06 17:49:14', 98, 97, 96, 95, 'approved'),
(184, 17, 232, '2026-02-07 03:04:37', 95, 96, 97, 98, 'pending'),
(185, 18, 232, '2026-02-07 03:05:37', 91, 92, 93, 92, 'pending'),
(186, 19, 232, '2026-02-07 03:05:53', 96, 95, 94, 95, 'pending'),
(187, 20, 232, '2026-02-07 03:06:07', 96, 97, 98, 98, 'pending'),
(188, 22, 232, '2026-02-07 03:06:33', 96, 95, 96, 94, 'pending'),
(189, 40, 155, '2026-02-14 23:50:00', 0, 0, 0, 0, 'pending'),
(190, 40, 232, '2026-02-14 23:50:00', 0, 0, 0, 0, 'pending'),
(191, 40, 160, '2026-02-14 23:50:01', 0, 0, 0, 0, 'pending'),
(192, 40, 236, '2026-02-14 23:50:37', 0, 0, 0, 0, 'pending'),
(193, 40, 212, '2026-02-14 23:50:37', 0, 0, 0, 0, 'pending'),
(194, 40, 201, '2026-02-14 23:50:37', 0, 0, 0, 0, 'pending'),
(195, 40, 168, '2026-02-14 23:50:37', 0, 0, 0, 0, 'pending'),
(196, 40, 210, '2026-02-14 23:50:38', 0, 0, 0, 0, 'pending'),
(197, 40, 248, '2026-02-14 23:50:38', 0, 0, 0, 0, 'pending'),
(198, 40, 267, '2026-02-14 23:50:38', 0, 0, 0, 0, 'pending'),
(199, 40, 178, '2026-02-14 23:50:39', 0, 0, 0, 0, 'pending'),
(200, 40, 255, '2026-02-14 23:50:39', 0, 0, 0, 0, 'pending'),
(201, 40, 166, '2026-02-14 23:50:39', 0, 0, 0, 0, 'pending'),
(202, 40, 240, '2026-02-14 23:50:39', 0, 0, 0, 0, 'pending'),
(203, 40, 251, '2026-02-14 23:50:40', 0, 0, 0, 0, 'pending'),
(204, 40, 220, '2026-02-14 23:50:40', 0, 0, 0, 0, 'pending'),
(206, 40, 254, '2026-02-14 23:50:41', 0, 0, 0, 0, 'pending'),
(207, 40, 179, '2026-02-14 23:50:41', 0, 0, 0, 0, 'pending'),
(208, 40, 238, '2026-02-14 23:50:42', 0, 0, 0, 0, 'pending'),
(209, 40, 177, '2026-02-14 23:50:42', 0, 0, 0, 0, 'pending'),
(210, 40, 195, '2026-02-14 23:50:42', 0, 0, 0, 0, 'pending'),
(211, 40, 262, '2026-02-14 23:50:42', 0, 0, 0, 0, 'pending'),
(212, 40, 263, '2026-02-14 23:50:42', 0, 0, 0, 0, 'pending');

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

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` char(36) NOT NULL DEFAULT uuid(),
  `user_id` char(36) NOT NULL,
  `message` text NOT NULL,
  `link` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`id`, `user_id`, `message`, `link`, `created_at`) VALUES
('01c41c70-b2e9-11f0-b062-c97b0bc6c277', '1', 'New admission: Fyke test Lleva (Grade: Grade 2, LRN: )', 'admission_old.php', '2025-10-27 03:57:07'),
('0223cdcc-b2e9-11f0-b062-c97b0bc6c277', '138', 'New admission: Fyke test Lleva (Grade: Grade 2, LRN: )', 'admission_old.php', '2025-10-27 03:57:08'),
('06d07826-dae8-11f0-b537-696eec52d845', '1', 'New admission: Hannah Grace Bautista Domingo for grade Grade 3 level', 'admission.php', '2025-12-17 01:30:53'),
('06d0890d-dae8-11f0-b537-696eec52d845', '141', 'New admission: Hannah Grace Bautista Domingo for grade Grade 3 level', 'admission.php', '2025-12-17 01:30:53'),
('06d09653-dae8-11f0-b537-696eec52d845', '143', 'New admission: Hannah Grace Bautista Domingo for grade Grade 3 level', 'admission.php', '2025-12-17 01:30:53'),
('070c2782-a5cd-11f0-b062-c97b0bc6c277', '3', '70714702 pay this amount for their tuition.', 'view_invoice.php?invoice_id=4599178&tuition_id=43', '2025-10-10 11:34:05'),
('078cd84d-da7a-11f0-b537-696eec52d845', '1', 'New admission: Joshua Paul Aquino Mendoza for grade Nursery level', 'admission.php', '2025-12-16 12:23:29'),
('078cea54-da7a-11f0-b537-696eec52d845', '141', 'New admission: Joshua Paul Aquino Mendoza for grade Nursery level', 'admission.php', '2025-12-16 12:23:29'),
('078cfb3d-da7a-11f0-b537-696eec52d845', '143', 'New admission: Joshua Paul Aquino Mendoza for grade Nursery level', 'admission.php', '2025-12-16 12:23:29'),
('0847f901-db18-11f0-b537-696eec52d845', '3', 'Noah Ramos time in at 03:14 PM for the subject Science 1 - Moonstone.', 'attendance.php', '2025-12-17 15:14:31'),
('0908e43e-dadd-11f0-b537-696eec52d845', '1', 'New admission: Kenneth Louis Valdez Dizon for grade Grade 2 level', 'admission.php', '2025-12-17 00:12:12'),
('0908f8d4-dadd-11f0-b537-696eec52d845', '141', 'New admission: Kenneth Louis Valdez Dizon for grade Grade 2 level', 'admission.php', '2025-12-17 00:12:12'),
('0909090d-dadd-11f0-b537-696eec52d845', '143', 'New admission: Kenneth Louis Valdez Dizon for grade Grade 2 level', 'admission.php', '2025-12-17 00:12:12'),
('092eb516-d02d-11f0-b062-c97b0bc6c277', '149', 'New health record added for student number 2025-83331', 'view_medical_detail.php?medical_id=MED-0017&student_id=2025-83331', '2025-12-03 17:47:09'),
('093f1e68-daff-11f0-b537-696eec52d845', '1', 'New admission: Paul Vincent Gomez Manabat for grade Grade 6 level', 'admission.php', '2025-12-17 04:15:35'),
('093f3af8-daff-11f0-b537-696eec52d845', '141', 'New admission: Paul Vincent Gomez Manabat for grade Grade 6 level', 'admission.php', '2025-12-17 04:15:35'),
('093f540f-daff-11f0-b537-696eec52d845', '143', 'New admission: Paul Vincent Gomez Manabat for grade Grade 6 level', 'admission.php', '2025-12-17 04:15:35'),
('09cf7e6a-da77-11f0-b537-696eec52d845', '1', 'New admission: Angela Marie Flores Dela Rosa for grade Nursery level', 'admission.php', '2025-12-16 12:02:04'),
('09cff1b5-da77-11f0-b537-696eec52d845', '141', 'New admission: Angela Marie Flores Dela Rosa for grade Nursery level', 'admission.php', '2025-12-16 12:02:04'),
('09d01672-da77-11f0-b537-696eec52d845', '143', 'New admission: Angela Marie Flores Dela Rosa for grade Nursery level', 'admission.php', '2025-12-16 12:02:04'),
('0a328c51-aca7-11f0-b062-c97b0bc6c277', '100', 'Stephany Gandula posted a new assignment in Makabansa 1: test', 'view_assignment.php?id=36&course_id=36', '2025-10-19 12:49:47'),
('0a32a6d1-aca7-11f0-b062-c97b0bc6c277', '103', 'Stephany Gandula posted a new assignment in Makabansa 1: test', 'view_assignment.php?id=36&course_id=36', '2025-10-19 12:49:47'),
('0a32b736-aca7-11f0-b062-c97b0bc6c277', '132', 'Stephany Gandula posted a new assignment in Makabansa 1: test', 'view_assignment.php?id=36&course_id=36', '2025-10-19 12:49:47'),
('0a32c5f1-aca7-11f0-b062-c97b0bc6c277', '130', 'Stephany Gandula posted a new assignment in Makabansa 1: test', 'view_assignment.php?id=36&course_id=36', '2025-10-19 12:49:47'),
('0a32d394-aca7-11f0-b062-c97b0bc6c277', '101', 'Stephany Gandula posted a new assignment in Makabansa 1: test', 'view_assignment.php?id=36&course_id=36', '2025-10-19 12:49:47'),
('0a32e565-aca7-11f0-b062-c97b0bc6c277', '129', 'Stephany Gandula posted a new assignment in Makabansa 1: test', 'view_assignment.php?id=36&course_id=36', '2025-10-19 12:49:47'),
('0a32f3ac-aca7-11f0-b062-c97b0bc6c277', '105', 'Stephany Gandula posted a new assignment in Makabansa 1: test', 'view_assignment.php?id=36&course_id=36', '2025-10-19 12:49:47'),
('0b460a74-f903-11f0-95c8-a29b24e0f83a', '1', 'New admission: TESSTTT TESSTTT TESSTTT for grade Grade 1 level', 'admission.php', '2026-01-24 08:59:51'),
('0b462038-f903-11f0-95c8-a29b24e0f83a', '141', 'New admission: TESSTTT TESSTTT TESSTTT for grade Grade 1 level', 'admission.php', '2026-01-24 08:59:51'),
('0b4634fe-f903-11f0-95c8-a29b24e0f83a', '143', 'New admission: TESSTTT TESSTTT TESSTTT for grade Grade 1 level', 'admission.php', '2026-01-24 08:59:51'),
('0c3b6cc7-cf50-11f0-b062-c97b0bc6c277', '149', 'New disciplinary record added for student number 2025-83331', 'view_disciplinary_detail.php?disciplinary_id=DISC-6989&student_id=2025-83331', '2025-12-02 15:25:15'),
('0e422ca4-cd1f-11f0-b062-c97b0bc6c277', '3', 'New disciplinary record added for student number 2025-13705', 'view_disciplinary_detail.php?disciplinary_id=DISC-9334&student_id=2025-13705', '2025-11-29 20:29:31'),
('0ea9ae49-a435-11f0-b062-c97b0bc6c277', '35', 'Stephany Gandula posted a new lesson titled:Cardiovascular Fitness: Boost Your Heart Health', 'view_post.php?post_id=67', '2025-10-08 18:53:41'),
('0eeafcfd-0866-11f1-8195-20c372f05cfe', '102', 'Your parent (CJ) has successfully linked their account to you.', 'dashboard.php', '2026-02-12 22:56:25'),
('0f2cde6b-a435-11f0-b062-c97b0bc6c277', '37', 'Stephany Gandula posted a new lesson titled:Cardiovascular Fitness: Boost Your Heart Health', 'view_post.php?post_id=67', '2025-10-08 18:53:41'),
('0f63cf4c-a435-11f0-b062-c97b0bc6c277', '52', 'Stephany Gandula posted a new lesson titled:Cardiovascular Fitness: Boost Your Heart Health', 'view_post.php?post_id=67', '2025-10-08 18:53:41'),
('0f9116c6-a435-11f0-b062-c97b0bc6c277', '55', 'Stephany Gandula posted a new lesson titled:Cardiovascular Fitness: Boost Your Heart Health', 'view_post.php?post_id=67', '2025-10-08 18:53:41'),
('0fcf94fe-a435-11f0-b062-c97b0bc6c277', '10', 'Stephany Gandula posted a new lesson titled:Cardiovascular Fitness: Boost Your Heart Health', 'view_post.php?post_id=67', '2025-10-08 18:53:41'),
('1049e67d-a435-11f0-b062-c97b0bc6c277', '92', 'Stephany Gandula posted a new lesson titled:Cardiovascular Fitness: Boost Your Heart Health', 'view_post.php?post_id=67', '2025-10-08 18:53:41'),
('10b75773-a435-11f0-b062-c97b0bc6c277', '99', 'Stephany Gandula posted a new lesson titled:Cardiovascular Fitness: Boost Your Heart Health', 'view_post.php?post_id=67', '2025-10-08 18:53:41'),
('11ffc444-a43f-11f0-b062-c97b0bc6c277', '40', '  submitted an assignment', 'view_assignment.php?course_id=20&id=24', '2025-10-08 12:05:24'),
('166da4c9-dae3-11f0-b537-696eec52d845', '1', 'New admission: Stephen Mark Torres Lopez for grade Grade 3 level', 'admission.php', '2025-12-17 00:55:31'),
('166db900-dae3-11f0-b537-696eec52d845', '141', 'New admission: Stephen Mark Torres Lopez for grade Grade 3 level', 'admission.php', '2025-12-17 00:55:31'),
('166e0986-dae3-11f0-b537-696eec52d845', '143', 'New admission: Stephen Mark Torres Lopez for grade Grade 3 level', 'admission.php', '2025-12-17 00:55:31'),
('176c3088-a54a-11f0-b062-c97b0bc6c277', '3', 'New health record added for student number 2025-52404', 'view_student_medical.php?student_id=2025-52404', '2025-10-10 03:56:48'),
('17b862f0-d167-11f0-b062-c97b0bc6c277', '1', 'New admission: Frederic Navarro Carney for grade Grade 5 level', 'admission.php', '2025-12-04 23:15:15'),
('17b87575-d167-11f0-b062-c97b0bc6c277', '141', 'New admission: Frederic Navarro Carney for grade Grade 5 level', 'admission.php', '2025-12-04 23:15:15'),
('17b884f7-d167-11f0-b062-c97b0bc6c277', '143', 'New admission: Frederic Navarro Carney for grade Grade 5 level', 'admission.php', '2025-12-04 23:15:15'),
('17e4a20a-d500-11f0-b062-c97b0bc6c277', '1', 'New admission: Mary  Sarah for grade Grade 11 level', 'admission.php', '2025-12-09 13:08:02'),
('18042dc5-d500-11f0-b062-c97b0bc6c277', '141', 'New admission: Mary  Sarah for grade Grade 11 level', 'admission.php', '2025-12-09 13:08:02'),
('1825671d-d500-11f0-b062-c97b0bc6c277', '143', 'New admission: Mary  Sarah for grade Grade 11 level', 'admission.php', '2025-12-09 13:08:03'),
('1b08adbd-a459-11f0-b062-c97b0bc6c277', '40', 'Mary Espinosa submitted an assignment \"Assignment Title: Personal Fitness Log\" for \"Physical Education 1\"', 'view_assignment.php?course_id=25&id=32', '2025-10-08 15:11:46'),
('1bb425c3-da73-11f0-b537-696eec52d845', '1', 'New admission: Rick Macaraeg Dela Cruz for grade Kinder level', 'admission.php', '2025-12-16 11:33:56'),
('1bb43a70-da73-11f0-b537-696eec52d845', '141', 'New admission: Rick Macaraeg Dela Cruz for grade Kinder level', 'admission.php', '2025-12-16 11:33:56'),
('1bb44a31-da73-11f0-b537-696eec52d845', '143', 'New admission: Rick Macaraeg Dela Cruz for grade Kinder level', 'admission.php', '2025-12-16 11:33:56'),
('1bb73b9f-da73-11f0-b537-696eec52d845', '1', 'New admission: Rick Macaraeg Dela Cruz for grade Kinder level', 'admission.php', '2025-12-16 11:33:56'),
('1bb750d1-da73-11f0-b537-696eec52d845', '141', 'New admission: Rick Macaraeg Dela Cruz for grade Kinder level', 'admission.php', '2025-12-16 11:33:56'),
('1bb763ef-da73-11f0-b537-696eec52d845', '143', 'New admission: Rick Macaraeg Dela Cruz for grade Kinder level', 'admission.php', '2025-12-16 11:33:56'),
('1ebf60af-ce7e-11f0-b062-c97b0bc6c277', '145', 'New health record added for student number 2025-33315', 'view_medical_detail.php?medical_id=MED-0015&student_id=2025-33315', '2025-12-01 14:22:32'),
('20ee94f8-f90b-11f0-95c8-a29b24e0f83a', '1', 'New admission: CJ Marker Escalora for grade Grade 2 level', 'admission.php', '2026-01-24 09:57:44'),
('20eeae2e-f90b-11f0-95c8-a29b24e0f83a', '141', 'New admission: CJ Marker Escalora for grade Grade 2 level', 'admission.php', '2026-01-24 09:57:44'),
('20eec86e-f90b-11f0-95c8-a29b24e0f83a', '143', 'New admission: CJ Marker Escalora for grade Grade 2 level', 'admission.php', '2026-01-24 09:57:44'),
('212015a6-d4fc-11f0-b062-c97b0bc6c277', '1', 'New admission: Rick Baptist Dulay for grade Grade 2 level', 'admission.php', '2025-12-09 12:39:40'),
('21c869c6-d4fc-11f0-b062-c97b0bc6c277', '141', 'New admission: Rick Baptist Dulay for grade Grade 2 level', 'admission.php', '2025-12-09 12:39:41'),
('21f46be4-a5e9-11f0-b062-c97b0bc6c277', '3', 'Kyle Ramos time in at 10:55 PM for the subject Mathematics 1 - Moonstone.', 'attendance.php', '2025-10-10 22:55:16'),
('2244f5fa-a75b-11f0-b062-c97b0bc6c277', '3', 'Noah Ramos time in at 07:03 PM for the subject Mathematics 1 - Moonstone.', 'attendance.php', '2025-10-12 19:03:50'),
('22aee5d5-d4fc-11f0-b062-c97b0bc6c277', '143', 'New admission: Rick Baptist Dulay for grade Grade 2 level', 'admission.php', '2025-12-09 12:39:42'),
('23060dbb-a463-11f0-b062-c97b0bc6c277', '40', 'Mary Espinosa submitted an assignment \"Parts of a Plant\" for \"Science 1\"', 'view_assignment.php?course_id=20&id=24', '2025-10-08 16:23:34'),
('24356a79-fcb5-11f0-95c8-a29b24e0f83a', '102', 'AcadeSys posted new public announcement: TEST', 'announcement.php', '2026-01-29 09:52:17'),
('24356d96-fcb5-11f0-95c8-a29b24e0f83a', '152', 'AcadeSys posted new public announcement: TEST', 'announcement.php', '2026-01-29 09:52:17'),
('24356e13-fcb5-11f0-95c8-a29b24e0f83a', '153', 'AcadeSys posted new public announcement: TEST', 'announcement.php', '2026-01-29 09:52:17'),
('24356e5d-fcb5-11f0-95c8-a29b24e0f83a', '154', 'AcadeSys posted new public announcement: TEST', 'announcement.php', '2026-01-29 09:52:17'),
('24356ea2-fcb5-11f0-95c8-a29b24e0f83a', '155', 'AcadeSys posted new public announcement: TEST', 'announcement.php', '2026-01-29 09:52:17'),
('24356ef1-fcb5-11f0-95c8-a29b24e0f83a', '156', 'AcadeSys posted new public announcement: TEST', 'announcement.php', '2026-01-29 09:52:17'),
('24356f40-fcb5-11f0-95c8-a29b24e0f83a', '158', 'AcadeSys posted new public announcement: TEST', 'announcement.php', '2026-01-29 09:52:17'),
('24356f8d-fcb5-11f0-95c8-a29b24e0f83a', '159', 'AcadeSys posted new public announcement: TEST', 'announcement.php', '2026-01-29 09:52:17'),
('243570a0-fcb5-11f0-95c8-a29b24e0f83a', '160', 'AcadeSys posted new public announcement: TEST', 'announcement.php', '2026-01-29 09:52:17'),
('243570e7-fcb5-11f0-95c8-a29b24e0f83a', '161', 'AcadeSys posted new public announcement: TEST', 'announcement.php', '2026-01-29 09:52:17'),
('2435712c-fcb5-11f0-95c8-a29b24e0f83a', '162', 'AcadeSys posted new public announcement: TEST', 'announcement.php', '2026-01-29 09:52:17'),
('24357166-fcb5-11f0-95c8-a29b24e0f83a', '163', 'AcadeSys posted new public announcement: TEST', 'announcement.php', '2026-01-29 09:52:17'),
('24357197-fcb5-11f0-95c8-a29b24e0f83a', '164', 'AcadeSys posted new public announcement: TEST', 'announcement.php', '2026-01-29 09:52:17'),
('243571cb-fcb5-11f0-95c8-a29b24e0f83a', '165', 'AcadeSys posted new public announcement: TEST', 'announcement.php', '2026-01-29 09:52:17'),
('243571fa-fcb5-11f0-95c8-a29b24e0f83a', '166', 'AcadeSys posted new public announcement: TEST', 'announcement.php', '2026-01-29 09:52:17'),
('2435723f-fcb5-11f0-95c8-a29b24e0f83a', '167', 'AcadeSys posted new public announcement: TEST', 'announcement.php', '2026-01-29 09:52:17'),
('2435728d-fcb5-11f0-95c8-a29b24e0f83a', '168', 'AcadeSys posted new public announcement: TEST', 'announcement.php', '2026-01-29 09:52:17'),
('24357304-fcb5-11f0-95c8-a29b24e0f83a', '169', 'AcadeSys posted new public announcement: TEST', 'announcement.php', '2026-01-29 09:52:17'),
('24357350-fcb5-11f0-95c8-a29b24e0f83a', '170', 'AcadeSys posted new public announcement: TEST', 'announcement.php', '2026-01-29 09:52:17'),
('2435739b-fcb5-11f0-95c8-a29b24e0f83a', '171', 'AcadeSys posted new public announcement: TEST', 'announcement.php', '2026-01-29 09:52:17'),
('243573ec-fcb5-11f0-95c8-a29b24e0f83a', '172', 'AcadeSys posted new public announcement: TEST', 'announcement.php', '2026-01-29 09:52:17'),
('24357446-fcb5-11f0-95c8-a29b24e0f83a', '173', 'AcadeSys posted new public announcement: TEST', 'announcement.php', '2026-01-29 09:52:17'),
('24357492-fcb5-11f0-95c8-a29b24e0f83a', '174', 'AcadeSys posted new public announcement: TEST', 'announcement.php', '2026-01-29 09:52:17'),
('243574e7-fcb5-11f0-95c8-a29b24e0f83a', '175', 'AcadeSys posted new public announcement: TEST', 'announcement.php', '2026-01-29 09:52:17'),
('24357534-fcb5-11f0-95c8-a29b24e0f83a', '176', 'AcadeSys posted new public announcement: TEST', 'announcement.php', '2026-01-29 09:52:17'),
('2435758f-fcb5-11f0-95c8-a29b24e0f83a', '177', 'AcadeSys posted new public announcement: TEST', 'announcement.php', '2026-01-29 09:52:17'),
('2437cf75-fcb5-11f0-95c8-a29b24e0f83a', '178', 'AcadeSys posted new public announcement: TEST', 'announcement.php', '2026-01-29 09:52:17'),
('2437d02e-fcb5-11f0-95c8-a29b24e0f83a', '179', 'AcadeSys posted new public announcement: TEST', 'announcement.php', '2026-01-29 09:52:17'),
('2437d068-fcb5-11f0-95c8-a29b24e0f83a', '180', 'AcadeSys posted new public announcement: TEST', 'announcement.php', '2026-01-29 09:52:17'),
('2437d09a-fcb5-11f0-95c8-a29b24e0f83a', '181', 'AcadeSys posted new public announcement: TEST', 'announcement.php', '2026-01-29 09:52:17'),
('2437d0d1-fcb5-11f0-95c8-a29b24e0f83a', '182', 'AcadeSys posted new public announcement: TEST', 'announcement.php', '2026-01-29 09:52:17'),
('2437d108-fcb5-11f0-95c8-a29b24e0f83a', '183', 'AcadeSys posted new public announcement: TEST', 'announcement.php', '2026-01-29 09:52:17'),
('2437d256-fcb5-11f0-95c8-a29b24e0f83a', '184', 'AcadeSys posted new public announcement: TEST', 'announcement.php', '2026-01-29 09:52:17'),
('2437d2a4-fcb5-11f0-95c8-a29b24e0f83a', '190', 'AcadeSys posted new public announcement: TEST', 'announcement.php', '2026-01-29 09:52:17'),
('2437d2f2-fcb5-11f0-95c8-a29b24e0f83a', '191', 'AcadeSys posted new public announcement: TEST', 'announcement.php', '2026-01-29 09:52:17'),
('2437d45c-fcb5-11f0-95c8-a29b24e0f83a', '192', 'AcadeSys posted new public announcement: TEST', 'announcement.php', '2026-01-29 09:52:17'),
('2437d4c1-fcb5-11f0-95c8-a29b24e0f83a', '193', 'AcadeSys posted new public announcement: TEST', 'announcement.php', '2026-01-29 09:52:17'),
('2437d51c-fcb5-11f0-95c8-a29b24e0f83a', '194', 'AcadeSys posted new public announcement: TEST', 'announcement.php', '2026-01-29 09:52:17'),
('2437d578-fcb5-11f0-95c8-a29b24e0f83a', '195', 'AcadeSys posted new public announcement: TEST', 'announcement.php', '2026-01-29 09:52:17'),
('2437d5d5-fcb5-11f0-95c8-a29b24e0f83a', '196', 'AcadeSys posted new public announcement: TEST', 'announcement.php', '2026-01-29 09:52:17'),
('2437d634-fcb5-11f0-95c8-a29b24e0f83a', '197', 'AcadeSys posted new public announcement: TEST', 'announcement.php', '2026-01-29 09:52:17'),
('2437d686-fcb5-11f0-95c8-a29b24e0f83a', '198', 'AcadeSys posted new public announcement: TEST', 'announcement.php', '2026-01-29 09:52:17'),
('2437d719-fcb5-11f0-95c8-a29b24e0f83a', '199', 'AcadeSys posted new public announcement: TEST', 'announcement.php', '2026-01-29 09:52:17'),
('2437d750-fcb5-11f0-95c8-a29b24e0f83a', '200', 'AcadeSys posted new public announcement: TEST', 'announcement.php', '2026-01-29 09:52:17'),
('2437d7a5-fcb5-11f0-95c8-a29b24e0f83a', '201', 'AcadeSys posted new public announcement: TEST', 'announcement.php', '2026-01-29 09:52:17'),
('2437d7db-fcb5-11f0-95c8-a29b24e0f83a', '202', 'AcadeSys posted new public announcement: TEST', 'announcement.php', '2026-01-29 09:52:17'),
('2437d811-fcb5-11f0-95c8-a29b24e0f83a', '203', 'AcadeSys posted new public announcement: TEST', 'announcement.php', '2026-01-29 09:52:17'),
('2437d849-fcb5-11f0-95c8-a29b24e0f83a', '204', 'AcadeSys posted new public announcement: TEST', 'announcement.php', '2026-01-29 09:52:17'),
('2437d87e-fcb5-11f0-95c8-a29b24e0f83a', '205', 'AcadeSys posted new public announcement: TEST', 'announcement.php', '2026-01-29 09:52:17'),
('2437d8b3-fcb5-11f0-95c8-a29b24e0f83a', '206', 'AcadeSys posted new public announcement: TEST', 'announcement.php', '2026-01-29 09:52:17'),
('2437d8e7-fcb5-11f0-95c8-a29b24e0f83a', '207', 'AcadeSys posted new public announcement: TEST', 'announcement.php', '2026-01-29 09:52:17'),
('2437d91b-fcb5-11f0-95c8-a29b24e0f83a', '208', 'AcadeSys posted new public announcement: TEST', 'announcement.php', '2026-01-29 09:52:17'),
('2437d953-fcb5-11f0-95c8-a29b24e0f83a', '209', 'AcadeSys posted new public announcement: TEST', 'announcement.php', '2026-01-29 09:52:17'),
('2437d9ab-fcb5-11f0-95c8-a29b24e0f83a', '210', 'AcadeSys posted new public announcement: TEST', 'announcement.php', '2026-01-29 09:52:17'),
('2437d9e1-fcb5-11f0-95c8-a29b24e0f83a', '211', 'AcadeSys posted new public announcement: TEST', 'announcement.php', '2026-01-29 09:52:17'),
('2437da17-fcb5-11f0-95c8-a29b24e0f83a', '212', 'AcadeSys posted new public announcement: TEST', 'announcement.php', '2026-01-29 09:52:17'),
('2437da4e-fcb5-11f0-95c8-a29b24e0f83a', '213', 'AcadeSys posted new public announcement: TEST', 'announcement.php', '2026-01-29 09:52:17'),
('2437da80-fcb5-11f0-95c8-a29b24e0f83a', '214', 'AcadeSys posted new public announcement: TEST', 'announcement.php', '2026-01-29 09:52:17'),
('2437dab3-fcb5-11f0-95c8-a29b24e0f83a', '215', 'AcadeSys posted new public announcement: TEST', 'announcement.php', '2026-01-29 09:52:17'),
('2437dae7-fcb5-11f0-95c8-a29b24e0f83a', '216', 'AcadeSys posted new public announcement: TEST', 'announcement.php', '2026-01-29 09:52:17'),
('2437db1d-fcb5-11f0-95c8-a29b24e0f83a', '217', 'AcadeSys posted new public announcement: TEST', 'announcement.php', '2026-01-29 09:52:17'),
('2437db50-fcb5-11f0-95c8-a29b24e0f83a', '218', 'AcadeSys posted new public announcement: TEST', 'announcement.php', '2026-01-29 09:52:17'),
('2437db96-fcb5-11f0-95c8-a29b24e0f83a', '219', 'AcadeSys posted new public announcement: TEST', 'announcement.php', '2026-01-29 09:52:17'),
('2437dbcb-fcb5-11f0-95c8-a29b24e0f83a', '220', 'AcadeSys posted new public announcement: TEST', 'announcement.php', '2026-01-29 09:52:17'),
('2437dc02-fcb5-11f0-95c8-a29b24e0f83a', '221', 'AcadeSys posted new public announcement: TEST', 'announcement.php', '2026-01-29 09:52:17'),
('2437dc33-fcb5-11f0-95c8-a29b24e0f83a', '222', 'AcadeSys posted new public announcement: TEST', 'announcement.php', '2026-01-29 09:52:17'),
('2437dc66-fcb5-11f0-95c8-a29b24e0f83a', '223', 'AcadeSys posted new public announcement: TEST', 'announcement.php', '2026-01-29 09:52:17'),
('2437dc9a-fcb5-11f0-95c8-a29b24e0f83a', '224', 'AcadeSys posted new public announcement: TEST', 'announcement.php', '2026-01-29 09:52:17'),
('2437dcd0-fcb5-11f0-95c8-a29b24e0f83a', '225', 'AcadeSys posted new public announcement: TEST', 'announcement.php', '2026-01-29 09:52:17'),
('243a5ea7-fcb5-11f0-95c8-a29b24e0f83a', '226', 'AcadeSys posted new public announcement: TEST', 'announcement.php', '2026-01-29 09:52:17'),
('243a5f88-fcb5-11f0-95c8-a29b24e0f83a', '227', 'AcadeSys posted new public announcement: TEST', 'announcement.php', '2026-01-29 09:52:17'),
('243a6032-fcb5-11f0-95c8-a29b24e0f83a', '228', 'AcadeSys posted new public announcement: TEST', 'announcement.php', '2026-01-29 09:52:17'),
('243a6087-fcb5-11f0-95c8-a29b24e0f83a', '229', 'AcadeSys posted new public announcement: TEST', 'announcement.php', '2026-01-29 09:52:17'),
('243a60d9-fcb5-11f0-95c8-a29b24e0f83a', '230', 'AcadeSys posted new public announcement: TEST', 'announcement.php', '2026-01-29 09:52:17'),
('243a6134-fcb5-11f0-95c8-a29b24e0f83a', '231', 'AcadeSys posted new public announcement: TEST', 'announcement.php', '2026-01-29 09:52:17'),
('243a6193-fcb5-11f0-95c8-a29b24e0f83a', '232', 'AcadeSys posted new public announcement: TEST', 'announcement.php', '2026-01-29 09:52:17'),
('243a61ea-fcb5-11f0-95c8-a29b24e0f83a', '234', 'AcadeSys posted new public announcement: TEST', 'announcement.php', '2026-01-29 09:52:17'),
('243a623f-fcb5-11f0-95c8-a29b24e0f83a', '235', 'AcadeSys posted new public announcement: TEST', 'announcement.php', '2026-01-29 09:52:17'),
('243a6295-fcb5-11f0-95c8-a29b24e0f83a', '236', 'AcadeSys posted new public announcement: TEST', 'announcement.php', '2026-01-29 09:52:17'),
('243a62ec-fcb5-11f0-95c8-a29b24e0f83a', '237', 'AcadeSys posted new public announcement: TEST', 'announcement.php', '2026-01-29 09:52:17'),
('243a6370-fcb5-11f0-95c8-a29b24e0f83a', '238', 'AcadeSys posted new public announcement: TEST', 'announcement.php', '2026-01-29 09:52:17'),
('243a63c7-fcb5-11f0-95c8-a29b24e0f83a', '239', 'AcadeSys posted new public announcement: TEST', 'announcement.php', '2026-01-29 09:52:17'),
('243a6418-fcb5-11f0-95c8-a29b24e0f83a', '240', 'AcadeSys posted new public announcement: TEST', 'announcement.php', '2026-01-29 09:52:17'),
('243a646d-fcb5-11f0-95c8-a29b24e0f83a', '241', 'AcadeSys posted new public announcement: TEST', 'announcement.php', '2026-01-29 09:52:17'),
('243a64bd-fcb5-11f0-95c8-a29b24e0f83a', '242', 'AcadeSys posted new public announcement: TEST', 'announcement.php', '2026-01-29 09:52:17'),
('243a6515-fcb5-11f0-95c8-a29b24e0f83a', '243', 'AcadeSys posted new public announcement: TEST', 'announcement.php', '2026-01-29 09:52:17'),
('243a656e-fcb5-11f0-95c8-a29b24e0f83a', '244', 'AcadeSys posted new public announcement: TEST', 'announcement.php', '2026-01-29 09:52:17'),
('243a65ca-fcb5-11f0-95c8-a29b24e0f83a', '245', 'AcadeSys posted new public announcement: TEST', 'announcement.php', '2026-01-29 09:52:17'),
('243a660b-fcb5-11f0-95c8-a29b24e0f83a', '246', 'AcadeSys posted new public announcement: TEST', 'announcement.php', '2026-01-29 09:52:17'),
('243a6661-fcb5-11f0-95c8-a29b24e0f83a', '247', 'AcadeSys posted new public announcement: TEST', 'announcement.php', '2026-01-29 09:52:17'),
('243a6696-fcb5-11f0-95c8-a29b24e0f83a', '248', 'AcadeSys posted new public announcement: TEST', 'announcement.php', '2026-01-29 09:52:17'),
('243a66d1-fcb5-11f0-95c8-a29b24e0f83a', '249', 'AcadeSys posted new public announcement: TEST', 'announcement.php', '2026-01-29 09:52:17'),
('243a6706-fcb5-11f0-95c8-a29b24e0f83a', '250', 'AcadeSys posted new public announcement: TEST', 'announcement.php', '2026-01-29 09:52:17'),
('243a673b-fcb5-11f0-95c8-a29b24e0f83a', '251', 'AcadeSys posted new public announcement: TEST', 'announcement.php', '2026-01-29 09:52:17'),
('243a676e-fcb5-11f0-95c8-a29b24e0f83a', '252', 'AcadeSys posted new public announcement: TEST', 'announcement.php', '2026-01-29 09:52:17'),
('243a67a5-fcb5-11f0-95c8-a29b24e0f83a', '253', 'AcadeSys posted new public announcement: TEST', 'announcement.php', '2026-01-29 09:52:17'),
('243a67d5-fcb5-11f0-95c8-a29b24e0f83a', '254', 'AcadeSys posted new public announcement: TEST', 'announcement.php', '2026-01-29 09:52:17'),
('243a6808-fcb5-11f0-95c8-a29b24e0f83a', '255', 'AcadeSys posted new public announcement: TEST', 'announcement.php', '2026-01-29 09:52:17'),
('243a685a-fcb5-11f0-95c8-a29b24e0f83a', '256', 'AcadeSys posted new public announcement: TEST', 'announcement.php', '2026-01-29 09:52:17'),
('243a6890-fcb5-11f0-95c8-a29b24e0f83a', '257', 'AcadeSys posted new public announcement: TEST', 'announcement.php', '2026-01-29 09:52:17'),
('243a68c1-fcb5-11f0-95c8-a29b24e0f83a', '258', 'AcadeSys posted new public announcement: TEST', 'announcement.php', '2026-01-29 09:52:17'),
('243a68fe-fcb5-11f0-95c8-a29b24e0f83a', '259', 'AcadeSys posted new public announcement: TEST', 'announcement.php', '2026-01-29 09:52:17'),
('243a6931-fcb5-11f0-95c8-a29b24e0f83a', '260', 'AcadeSys posted new public announcement: TEST', 'announcement.php', '2026-01-29 09:52:17'),
('243a6967-fcb5-11f0-95c8-a29b24e0f83a', '261', 'AcadeSys posted new public announcement: TEST', 'announcement.php', '2026-01-29 09:52:17'),
('243a6999-fcb5-11f0-95c8-a29b24e0f83a', '262', 'AcadeSys posted new public announcement: TEST', 'announcement.php', '2026-01-29 09:52:17'),
('243a69cd-fcb5-11f0-95c8-a29b24e0f83a', '263', 'AcadeSys posted new public announcement: TEST', 'announcement.php', '2026-01-29 09:52:17'),
('243a6a0f-fcb5-11f0-95c8-a29b24e0f83a', '265', 'AcadeSys posted new public announcement: TEST', 'announcement.php', '2026-01-29 09:52:17'),
('29c569e0-a689-11f0-b062-c97b0bc6c277', '3', 'Dave Bergania time in at 06:00 PM for the subject Mathematics 1 - Moonstone.', 'attendance.php', '2025-10-11 18:00:48'),
('2a3dee8a-a555-11f0-b062-c97b0bc6c277', '3', 'ass', 'announcement.php', '2025-10-10 05:16:04'),
('2a3df4cf-a555-11f0-b062-c97b0bc6c277', '38', 'ass', 'announcement.php', '2025-10-10 05:16:04'),
('2a3df56a-a555-11f0-b062-c97b0bc6c277', '39', 'ass', 'announcement.php', '2025-10-10 05:16:04'),
('2a3df6a4-a555-11f0-b062-c97b0bc6c277', '40', 'ass', 'announcement.php', '2025-10-10 05:16:04'),
('2a3df6fa-a555-11f0-b062-c97b0bc6c277', '41', 'ass', 'announcement.php', '2025-10-10 05:16:04'),
('2a3df752-a555-11f0-b062-c97b0bc6c277', '42', 'ass', 'announcement.php', '2025-10-10 05:16:04'),
('2a3df7a2-a555-11f0-b062-c97b0bc6c277', '43', 'ass', 'announcement.php', '2025-10-10 05:16:04'),
('2a3df7eb-a555-11f0-b062-c97b0bc6c277', '44', 'ass', 'announcement.php', '2025-10-10 05:16:04'),
('2a3df834-a555-11f0-b062-c97b0bc6c277', '45', 'ass', 'announcement.php', '2025-10-10 05:16:04'),
('2a3df87f-a555-11f0-b062-c97b0bc6c277', '46', 'ass', 'announcement.php', '2025-10-10 05:16:04'),
('2a3df8ce-a555-11f0-b062-c97b0bc6c277', '47', 'ass', 'announcement.php', '2025-10-10 05:16:04'),
('2a3df913-a555-11f0-b062-c97b0bc6c277', '48', 'ass', 'announcement.php', '2025-10-10 05:16:04'),
('2a3df97d-a555-11f0-b062-c97b0bc6c277', '49', 'ass', 'announcement.php', '2025-10-10 05:16:04'),
('2a3df9be-a555-11f0-b062-c97b0bc6c277', '50', 'ass', 'announcement.php', '2025-10-10 05:16:04'),
('2a3dfa05-a555-11f0-b062-c97b0bc6c277', '51', 'ass', 'announcement.php', '2025-10-10 05:16:04'),
('2a3dfacb-a555-11f0-b062-c97b0bc6c277', '88', 'ass', 'announcement.php', '2025-10-10 05:16:04'),
('2a3dfb17-a555-11f0-b062-c97b0bc6c277', '100', 'ass', 'announcement.php', '2025-10-10 05:16:04'),
('2a3dfb63-a555-11f0-b062-c97b0bc6c277', '101', 'ass', 'announcement.php', '2025-10-10 05:16:04'),
('2a3dfbb2-a555-11f0-b062-c97b0bc6c277', '102', 'ass', 'announcement.php', '2025-10-10 05:16:04'),
('2a3dfbf9-a555-11f0-b062-c97b0bc6c277', '103', 'ass', 'announcement.php', '2025-10-10 05:16:04'),
('2a3dfc47-a555-11f0-b062-c97b0bc6c277', '104', 'ass', 'announcement.php', '2025-10-10 05:16:04'),
('2b480b4d-a760-11f0-b062-c97b0bc6c277', '101', 'Stephany Gandula posted a new assignment in Mathematics 1 - Moonstone: Assessment 2: Shapes numbers', 'view_assignment.php?id=35&course_id=35', '2025-10-12 19:39:53'),
('2b4abe47-a760-11f0-b062-c97b0bc6c277', '103', 'Stephany Gandula posted a new assignment in Mathematics 1 - Moonstone: Assessment 2: Shapes numbers', 'view_assignment.php?id=35&course_id=35', '2025-10-12 19:39:53'),
('2b4ba79d-a760-11f0-b062-c97b0bc6c277', '104', 'Stephany Gandula posted a new assignment in Mathematics 1 - Moonstone: Assessment 2: Shapes numbers', 'view_assignment.php?id=35&course_id=35', '2025-10-12 19:39:53'),
('2b4bb8ae-a760-11f0-b062-c97b0bc6c277', '102', 'Stephany Gandula posted a new assignment in Mathematics 1 - Moonstone: Assessment 2: Shapes numbers', 'view_assignment.php?id=35&course_id=35', '2025-10-12 19:39:53'),
('2b4c04a0-a760-11f0-b062-c97b0bc6c277', '105', 'Stephany Gandula posted a new assignment in Mathematics 1 - Moonstone: Assessment 2: Shapes numbers', 'view_assignment.php?id=35&course_id=35', '2025-10-12 19:39:53'),
('2b4cbb07-a760-11f0-b062-c97b0bc6c277', '132', 'Stephany Gandula posted a new assignment in Mathematics 1 - Moonstone: Assessment 2: Shapes numbers', 'view_assignment.php?id=35&course_id=35', '2025-10-12 19:39:53'),
('2b82b99f-db17-11f0-b537-696eec52d845', '3', 'Noah Ramos time in at 03:08 PM for the subject Science 1 - Moonstone.', 'attendance.php', '2025-12-17 15:08:20'),
('2bfc923f-dafb-11f0-b537-696eec52d845', '1', 'New admission: Aaron Joseph Tejada Ramos for grade Grade 5 level', 'admission.php', '2025-12-17 03:47:55'),
('2bfcaa71-dafb-11f0-b537-696eec52d845', '141', 'New admission: Aaron Joseph Tejada Ramos for grade Grade 5 level', 'admission.php', '2025-12-17 03:47:55'),
('2bfcd19a-dafb-11f0-b537-696eec52d845', '143', 'New admission: Aaron Joseph Tejada Ramos for grade Grade 5 level', 'admission.php', '2025-12-17 03:47:55'),
('2c27945c-a521-11f0-b062-c97b0bc6c277', '3', 'Mary Espinosa time in at 11:03 PM for the subject Physical Education 1.', 'attendance.php', '2025-10-09 23:03:54'),
('2d37ee2a-daf8-11f0-b537-696eec52d845', '1', 'New admission: Carlo Miguel Reyes Yabut for grade Grade 4 level', 'admission.php', '2025-12-17 03:26:29'),
('2d37ffc7-daf8-11f0-b537-696eec52d845', '141', 'New admission: Carlo Miguel Reyes Yabut for grade Grade 4 level', 'admission.php', '2025-12-17 03:26:29'),
('2d380e0b-daf8-11f0-b537-696eec52d845', '143', 'New admission: Carlo Miguel Reyes Yabut for grade Grade 4 level', 'admission.php', '2025-12-17 03:26:29'),
('2d8daec3-a5ea-11f0-b062-c97b0bc6c277', '3', 'AcadeSys posted new public announcement: lest test', 'announcement.php', '2025-10-10 23:02:44'),
('2d8dba71-a5ea-11f0-b062-c97b0bc6c277', '88', 'AcadeSys posted new public announcement: lest test', 'announcement.php', '2025-10-10 23:02:44'),
('2edd60f5-a450-11f0-b062-c97b0bc6c277', '59', 'Your submission for \"Parts of a Plant\" has been graded.', NULL, '2025-10-08 14:07:53'),
('2f00ff3f-dadf-11f0-b537-696eec52d845', '1', 'New admission: Patricia Anne Macapagal Flores for grade Grade 2 level', 'admission.php', '2025-12-17 00:27:34'),
('2f0112bc-dadf-11f0-b537-696eec52d845', '141', 'New admission: Patricia Anne Macapagal Flores for grade Grade 2 level', 'admission.php', '2025-12-17 00:27:34'),
('2f0123e7-dadf-11f0-b537-696eec52d845', '143', 'New admission: Patricia Anne Macapagal Flores for grade Grade 2 level', 'admission.php', '2025-12-17 00:27:34'),
('3157c96f-daf7-11f0-b537-696eec52d845', '1', 'New admission: Rhea Camille Ortiz Navarro for grade Grade 4 level', 'admission.php', '2025-12-17 03:19:26'),
('3157df8f-daf7-11f0-b537-696eec52d845', '141', 'New admission: Rhea Camille Ortiz Navarro for grade Grade 4 level', 'admission.php', '2025-12-17 03:19:26'),
('3157f36e-daf7-11f0-b537-696eec52d845', '143', 'New admission: Rhea Camille Ortiz Navarro for grade Grade 4 level', 'admission.php', '2025-12-17 03:19:26'),
('317390cc-a459-11f0-b062-c97b0bc6c277', '10', 'Stephany Gandula graded your assignment: Assignment Title: Personal Fitness Log', 'view_assignment.php?id=32&course_id=25', '2025-10-08 23:12:21'),
('3205610a-a75b-11f0-b062-c97b0bc6c277', '3', 'Kyle Ramos time in at 07:04 PM for the subject Mathematics 1 - Moonstone.', 'attendance.php', '2025-10-12 19:04:17'),
('331bdb86-da80-11f0-b537-696eec52d845', '1', 'New admission: Trisha Anne Gomez Padilla for grade Grade 1 level', 'admission.php', '2025-12-16 13:07:39'),
('331beeea-da80-11f0-b537-696eec52d845', '141', 'New admission: Trisha Anne Gomez Padilla for grade Grade 1 level', 'admission.php', '2025-12-16 13:07:39'),
('331bfd27-da80-11f0-b537-696eec52d845', '143', 'New admission: Trisha Anne Gomez Padilla for grade Grade 1 level', 'admission.php', '2025-12-16 13:07:39'),
('336c85bb-0867-11f1-8195-20c372f05cfe', '102', 'Your parent (CJ) has successfully linked their account to you.', 'dashboard.php', '2026-02-12 23:04:36'),
('33e54af783b7c11dc092545b534f4490', '10', '  graded your assignment &quot;Parts of a Plant&quot;', 'view_assignment.php?id=24', '2025-10-08 14:44:33'),
('374fa8ad-aca7-11f0-b062-c97b0bc6c277', '100', 'Stephany Gandula posted a new assignment in Makabansa 1: test', 'view_assignment.php?id=37&course_id=36', '2025-10-19 12:51:03'),
('37505182-aca7-11f0-b062-c97b0bc6c277', '103', 'Stephany Gandula posted a new assignment in Makabansa 1: test', 'view_assignment.php?id=37&course_id=36', '2025-10-19 12:51:03'),
('37506431-aca7-11f0-b062-c97b0bc6c277', '132', 'Stephany Gandula posted a new assignment in Makabansa 1: test', 'view_assignment.php?id=37&course_id=36', '2025-10-19 12:51:03'),
('375076b3-aca7-11f0-b062-c97b0bc6c277', '130', 'Stephany Gandula posted a new assignment in Makabansa 1: test', 'view_assignment.php?id=37&course_id=36', '2025-10-19 12:51:03'),
('37508589-aca7-11f0-b062-c97b0bc6c277', '101', 'Stephany Gandula posted a new assignment in Makabansa 1: test', 'view_assignment.php?id=37&course_id=36', '2025-10-19 12:51:03'),
('3750949a-aca7-11f0-b062-c97b0bc6c277', '129', 'Stephany Gandula posted a new assignment in Makabansa 1: test', 'view_assignment.php?id=37&course_id=36', '2025-10-19 12:51:03'),
('37514002-aca7-11f0-b062-c97b0bc6c277', '105', 'Stephany Gandula posted a new assignment in Makabansa 1: test', 'view_assignment.php?id=37&course_id=36', '2025-10-19 12:51:03'),
('3756d08e-da78-11f0-b537-696eec52d845', '1', 'New admission: Angela Marie Flores Dela Rosa for grade Nursery level', 'admission.php', '2025-12-16 12:10:30'),
('3756e028-da78-11f0-b537-696eec52d845', '141', 'New admission: Angela Marie Flores Dela Rosa for grade Nursery level', 'admission.php', '2025-12-16 12:10:30'),
('3756ed5d-da78-11f0-b537-696eec52d845', '143', 'New admission: Angela Marie Flores Dela Rosa for grade Nursery level', 'admission.php', '2025-12-16 12:10:30'),
('380ffb25-a75b-11f0-b062-c97b0bc6c277', '3', 'Dave Bergania time in at 07:04 PM for the subject Mathematics 1 - Moonstone.', 'attendance.php', '2025-10-12 19:04:27'),
('3ae962f6-a75d-11f0-b062-c97b0bc6c277', '3', 'New health record added for student number 2025-83698', 'view_medical_detail.php?medical_id=MED-0014&student_id=2025-83698', '2025-10-12 19:18:51'),
('3c366656-da7c-11f0-b537-696eec52d845', '1', 'New admission: Janelle Faith Castillo Soriano for grade Kinder level', 'admission.php', '2025-12-16 12:39:16'),
('3c368150-da7c-11f0-b537-696eec52d845', '141', 'New admission: Janelle Faith Castillo Soriano for grade Kinder level', 'admission.php', '2025-12-16 12:39:16'),
('3c36933b-da7c-11f0-b537-696eec52d845', '143', 'New admission: Janelle Faith Castillo Soriano for grade Kinder level', 'admission.php', '2025-12-16 12:39:16'),
('3d01c23b-a463-11f0-b062-c97b0bc6c277', '10', 'Stephany Gandula graded your assignment: Parts of a Plant', 'view_assignment.php?id=24&course_id=20', '2025-10-09 00:24:15'),
('3d9d706f-da76-11f0-b537-696eec52d845', '1', 'New admission: Juan Miguel Santos Cruz for grade Nursery level', 'admission.php', '2025-12-16 11:56:22'),
('3d9d9300-da76-11f0-b537-696eec52d845', '141', 'New admission: Juan Miguel Santos Cruz for grade Nursery level', 'admission.php', '2025-12-16 11:56:22'),
('3d9dad45-da76-11f0-b537-696eec52d845', '143', 'New admission: Juan Miguel Santos Cruz for grade Nursery level', 'admission.php', '2025-12-16 11:56:22'),
('3e625233-a457-11f0-b062-c97b0bc6c277', '10', 'Stephany Gandula graded your assignment: Parts of a Plant', 'view_assignment.php?id=24&course_id=20', '2025-10-08 22:58:24'),
('3f1d5b2a-a53a-11f0-b062-c97b0bc6c277', '3', 'Kyle Ramos time in at 02:03 AM for the subject Mathematics 1 - Moonstone.', 'attendance.php', '2025-10-10 02:03:23'),
('402afe4b-ffd3-11f0-95c8-a29b24e0f83a', '1', 'New admission: Julouise Garcia De Guzman for grade Grade 1 level', 'admission.php', '2026-02-02 01:05:22'),
('402bac89-ffd3-11f0-95c8-a29b24e0f83a', '141', 'New admission: Julouise Garcia De Guzman for grade Grade 1 level', 'admission.php', '2026-02-02 01:05:22'),
('402bc080-ffd3-11f0-95c8-a29b24e0f83a', '143', 'New admission: Julouise Garcia De Guzman for grade Grade 1 level', 'admission.php', '2026-02-02 01:05:22'),
('40a5ef17-a760-11f0-b062-c97b0bc6c277', '39', 'Dela Cruiz Juan submitted an assignment \"Assessment 2: Shapes numbers\" for \"Mathematics 1 - Moonstone\"', 'view_assignment.php?course_id=35&id=35', '2025-10-12 11:40:29'),
('461f9bc9-fcb4-11f0-95c8-a29b24e0f83a', '40', 'nick azcueta submitted an assignment \"cap2\" for \"Filipino 1\"', 'view_assignment.php?course_id=42&id=40', '2026-01-29 01:46:04'),
('46ed6068-a50d-11f0-b062-c97b0bc6c277', '3', 'Mary Espinosa time in at 08:41 PM for the subject Physical Education 1.', 'attendance.php', '2025-10-09 20:41:28'),
('474977c7-db72-11f0-b537-696eec52d845', '1', 'New admission: Roberta Baptist Bicaru for grade Grade 11 level', 'admission.php', '2025-12-17 18:00:31'),
('4765c355-db72-11f0-b537-696eec52d845', '141', 'New admission: Roberta Baptist Bicaru for grade Grade 11 level', 'admission.php', '2025-12-17 18:00:31'),
('477ee641-db72-11f0-b537-696eec52d845', '143', 'New admission: Roberta Baptist Bicaru for grade Grade 11 level', 'admission.php', '2025-12-17 18:00:32'),
('49ab4cc8-cf4f-11f0-b062-c97b0bc6c277', '149', 'Rafael Gutierrez time in at 03:19 PM for the subject Physical Education 1.', 'attendance.php', '2025-12-02 15:19:49'),
('4cd5adef-db0c-11f0-b537-696eec52d845', '1', 'New admission: John Marker Dela Cruz for grade Nursery level', 'admission.php', '2025-12-17 05:50:32'),
('4cd5c3b4-db0c-11f0-b537-696eec52d845', '141', 'New admission: John Marker Dela Cruz for grade Nursery level', 'admission.php', '2025-12-17 05:50:32'),
('4cd5d64b-db0c-11f0-b537-696eec52d845', '143', 'New admission: John Marker Dela Cruz for grade Nursery level', 'admission.php', '2025-12-17 05:50:32'),
('4dda3cef-d556-11f0-b062-c97b0bc6c277', '1', 'New admission: Leo Santos Trujillo for grade Kinder Garten level', 'admission_old.php', '2025-12-09 23:25:09'),
('4dda513b-d556-11f0-b062-c97b0bc6c277', '141', 'New admission: Leo Santos Trujillo for grade Kinder Garten level', 'admission_old.php', '2025-12-09 23:25:09'),
('4dda6124-d556-11f0-b062-c97b0bc6c277', '143', 'New admission: Leo Santos Trujillo for grade Kinder Garten level', 'admission_old.php', '2025-12-09 23:25:09'),
('4e5d6707-dac7-11f0-b537-696eec52d845', '3', 'Noah Ramos time in at 05:36 AM for the subject Mathermatics.', 'attendance.php', '2025-12-17 05:36:39'),
('4f3ea265-a53a-11f0-b062-c97b0bc6c277', '3', 'Hannah Reyes time in at 02:03 AM for the subject Mathematics 1 - Moonstone.', 'attendance.php', '2025-10-10 02:03:50'),
('501b0c92-af19-11f0-b062-c97b0bc6c277', '102', 'Leoncia Ala posted a new assignment in English: Alphabet', 'view_assignment.php?id=38&course_id=37', '2025-10-22 15:32:50'),
('5194d766-c010-11f0-b062-c97b0bc6c277', '1', 'New admission: julius Garcia bergania for grade Grade 1 level', 'admission.php', '2025-11-12 21:41:16'),
('51954424-c010-11f0-b062-c97b0bc6c277', '138', 'New admission: julius Garcia bergania for grade Grade 1 level', 'admission.php', '2025-11-12 21:41:16'),
('522002db-dac8-11f0-b537-696eec52d845', '3', 'Noah Ramos time in at 05:43 AM for the subject Makabansa 1 - Moonstone.', 'attendance.php', '2025-12-17 05:43:55'),
('54af42d2-da7b-11f0-b537-696eec52d845', '1', 'New admission: Samantha Lee Chua Tan for grade Kinder level', 'admission.php', '2025-12-16 12:32:48'),
('54af5b7b-da7b-11f0-b537-696eec52d845', '141', 'New admission: Samantha Lee Chua Tan for grade Kinder level', 'admission.php', '2025-12-16 12:32:48'),
('54af7333-da7b-11f0-b537-696eec52d845', '143', 'New admission: Samantha Lee Chua Tan for grade Kinder level', 'admission.php', '2025-12-16 12:32:48'),
('54dc0cf7-af19-11f0-b062-c97b0bc6c277', '3', 'Noah Ramos time in at 03:32 PM for the subject English.', 'attendance.php', '2025-10-22 15:32:58'),
('550035fb-d479-11f0-b062-c97b0bc6c277', '1', 'New admission: Saira Gutierrez Boone for grade Grade 9 level', 'admission_old.php', '2025-12-08 21:03:23'),
('55007f64-d479-11f0-b062-c97b0bc6c277', '141', 'New admission: Saira Gutierrez Boone for grade Grade 9 level', 'admission_old.php', '2025-12-08 21:03:23'),
('550090f2-d479-11f0-b062-c97b0bc6c277', '143', 'New admission: Saira Gutierrez Boone for grade Grade 9 level', 'admission_old.php', '2025-12-08 21:03:23'),
('5536df39-a449-11f0-b062-c97b0bc6c277', '40', 'Mary Espinosa submitted \"Parts of a Plant\" for \"Science 1\"', 'view_assignment.php?course_id=20&id=24', '2025-10-08 13:18:51'),
('55d29053-a9ff-11f0-b062-c97b0bc6c277', '3', 'Dave Bergania time in at 03:44 AM for the subject English 1.', 'attendance.php', '2025-10-16 03:44:17'),
('577a644a-da7f-11f0-b537-696eec52d845', '1', 'New admission: Bea Louise Santiago Navarro for grade Grade 1 level', 'admission.php', '2025-12-16 13:01:31'),
('577a8a55-da7f-11f0-b537-696eec52d845', '141', 'New admission: Bea Louise Santiago Navarro for grade Grade 1 level', 'admission.php', '2025-12-16 13:01:31'),
('577aa2f1-da7f-11f0-b537-696eec52d845', '143', 'New admission: Bea Louise Santiago Navarro for grade Grade 1 level', 'admission.php', '2025-12-16 13:01:31'),
('57895752-ffd7-11f0-95c8-a29b24e0f83a', '268', 'Andrew Paul Wilson time in at 09:34 AM for the subject Music 1.', 'attendance.php', '2026-02-02 09:34:40'),
('5865ac01-a43c-11f0-b062-c97b0bc6c277', '40', '  submitted an assignment', 'view_assignment.php?course_id=25&id=29', '2025-10-08 11:45:53'),
('5883625d-ffd6-11f0-95c8-a29b24e0f83a', '168', 'Stephany Gandula posted a new assignment in Filipino 1: test', 'view_assignment.php?id=41&course_id=42', '2026-02-02 09:27:32'),
('58837b3f-ffd6-11f0-95c8-a29b24e0f83a', '265', 'Stephany Gandula posted a new assignment in Filipino 1: test', 'view_assignment.php?id=41&course_id=42', '2026-02-02 09:27:32'),
('58838cba-ffd6-11f0-95c8-a29b24e0f83a', '267', 'Stephany Gandula posted a new assignment in Filipino 1: test', 'view_assignment.php?id=41&course_id=42', '2026-02-02 09:27:32'),
('59479d99-a688-11f0-b062-c97b0bc6c277', '3', 'Account number : 95897288 pay this amount for their tuition.', 'view_invoice.php?invoice_id=3666607&tuition_id=46', '2025-10-11 17:54:59'),
('594c7646-fcb6-11f0-95c8-a29b24e0f83a', '3', 'Account number : 58238767 pay this amount for their tuition.', 'view_invoice.php?invoice_id=3827905&tuition_id=187', '2026-01-29 10:00:56'),
('5aac8845-a760-11f0-b062-c97b0bc6c277', '132', 'Stephany Gandula graded your assignment: Assessment 2: Shapes numbers', 'view_assignment.php?id=35&course_id=35', '2025-10-12 19:41:12'),
('5aef666c-05f8-11f1-95c8-a29b24e0f83a', '1', 'New admission: Fyke  Lleva for grade Grade 3 level', 'admission.php', '2026-02-09 20:46:06'),
('5b17bb58-05f8-11f1-95c8-a29b24e0f83a', '141', 'New admission: Fyke  Lleva for grade Grade 3 level', 'admission.php', '2026-02-09 20:46:06'),
('5b4631f1-05f8-11f1-95c8-a29b24e0f83a', '143', 'New admission: Fyke  Lleva for grade Grade 3 level', 'admission.php', '2026-02-09 20:46:06'),
('5b90738b-fc49-11f0-95c8-a29b24e0f83a', '3', 'Aaron Joseph Ramos time in at 09:00 PM for the subject eng 10.', 'attendance.php', '2026-01-28 21:00:44'),
('5ba0db11-a75a-11f0-b062-c97b0bc6c277', '100', 'AcadeSys posted new public announcement: Your child has received a commendation for outstan', 'announcement.php', '2025-10-12 18:58:17'),
('5ba0de1c-a75a-11f0-b062-c97b0bc6c277', '101', 'AcadeSys posted new public announcement: Your child has received a commendation for outstan', 'announcement.php', '2025-10-12 18:58:17'),
('5ba0de89-a75a-11f0-b062-c97b0bc6c277', '102', 'AcadeSys posted new public announcement: Your child has received a commendation for outstan', 'announcement.php', '2025-10-12 18:58:17'),
('5ba0ded4-a75a-11f0-b062-c97b0bc6c277', '103', 'AcadeSys posted new public announcement: Your child has received a commendation for outstan', 'announcement.php', '2025-10-12 18:58:17'),
('5ba0df2a-a75a-11f0-b062-c97b0bc6c277', '104', 'AcadeSys posted new public announcement: Your child has received a commendation for outstan', 'announcement.php', '2025-10-12 18:58:17'),
('5ba0e035-a75a-11f0-b062-c97b0bc6c277', '105', 'AcadeSys posted new public announcement: Your child has received a commendation for outstan', 'announcement.php', '2025-10-12 18:58:17'),
('5ba0e086-a75a-11f0-b062-c97b0bc6c277', '129', 'AcadeSys posted new public announcement: Your child has received a commendation for outstan', 'announcement.php', '2025-10-12 18:58:17'),
('5ba0e0d7-a75a-11f0-b062-c97b0bc6c277', '130', 'AcadeSys posted new public announcement: Your child has received a commendation for outstan', 'announcement.php', '2025-10-12 18:58:17'),
('5bf041d0-a53a-11f0-b062-c97b0bc6c277', '3', 'Noah Ramos time in at 02:04 AM for the subject Mathematics 1 - Moonstone.', 'attendance.php', '2025-10-10 02:04:11'),
('5c746a71-d010-11f0-b062-c97b0bc6c277', '1', 'New admission: Stephanie Gale  Candado for grade Grade 12 level', 'admission.php', '2025-12-03 06:21:53'),
('5c74842a-d010-11f0-b062-c97b0bc6c277', '141', 'New admission: Stephanie Gale  Candado for grade Grade 12 level', 'admission.php', '2025-12-03 06:21:53'),
('5c749490-d010-11f0-b062-c97b0bc6c277', '143', 'New admission: Stephanie Gale  Candado for grade Grade 12 level', 'admission.php', '2025-12-03 06:21:53'),
('5d737f29-cf50-11f0-b062-c97b0bc6c277', '149', 'Account number : 10522024 pay this amount for their tuition.', 'view_invoice.php?invoice_id=1095078&tuition_id=56', '2025-12-02 15:27:32'),
('5daccfda-da5f-11f0-b537-696eec52d845', '1', 'New admission: Brian Macaraeg Dulay for grade Grade 8 level', 'admission.php', '2025-12-16 09:12:37'),
('5dbeffcd-a450-11f0-b062-c97b0bc6c277', '40', 'Mary Espinosa submitted an assignment \"Parts of a Plant\" for \"Science 1\"', 'view_assignment.php?course_id=20&id=24', '2025-10-08 14:09:12'),
('5dcc0bc6-da5f-11f0-b537-696eec52d845', '141', 'New admission: Brian Macaraeg Dulay for grade Grade 8 level', 'admission.php', '2025-12-16 09:12:37'),
('5de1e07e-03d1-11f1-95c8-a29b24e0f83a', '3', 'Account number : 09566377 pay this amount for their tuition.', 'view_invoice.php?invoice_id=7714499&tuition_id=101', '2026-02-07 11:01:58'),
('5de9e62b-da5f-11f0-b537-696eec52d845', '143', 'New admission: Brian Macaraeg Dulay for grade Grade 8 level', 'admission.php', '2025-12-16 09:12:38'),
('5e14f306-da5f-11f0-b537-696eec52d845', '1', 'New admission: Brian Macaraeg Dulay for grade Grade 8 level', 'admission.php', '2025-12-16 09:12:38'),
('5e53d3cd-da5f-11f0-b537-696eec52d845', '141', 'New admission: Brian Macaraeg Dulay for grade Grade 8 level', 'admission.php', '2025-12-16 09:12:38'),
('5e920744-da5f-11f0-b537-696eec52d845', '143', 'New admission: Brian Macaraeg Dulay for grade Grade 8 level', 'admission.php', '2025-12-16 09:12:39'),
('5f05dfa4-a456-11f0-b062-c97b0bc6c277', '59', 'Stephany Gandula graded your assignment: Parts of a Plant', 'view_assignment.php?status=1&id=24', '2025-10-08 22:52:09'),
('5fcbee14-dadc-11f0-b537-696eec52d845', '1', 'New admission: Faith Nicole Delos Reyes Ramos for grade Grade 2 level', 'admission.php', '2025-12-17 00:07:28'),
('5fcc027a-dadc-11f0-b537-696eec52d845', '141', 'New admission: Faith Nicole Delos Reyes Ramos for grade Grade 2 level', 'admission.php', '2025-12-17 00:07:28'),
('5fcc1227-dadc-11f0-b537-696eec52d845', '143', 'New admission: Faith Nicole Delos Reyes Ramos for grade Grade 2 level', 'admission.php', '2025-12-17 00:07:28'),
('61311b91-a66e-11f0-b062-c97b0bc6c277', '3', 'Noah Ramos time in at 02:49 PM for the subject Mathematics 1 - Moonstone.', 'attendance.php', '2025-10-11 14:49:05'),
('65d6c90e-e72b-11f0-a16d-c32e9a7c9fa7', '1', 'New admission: test test test for grade Nursery level', 'admission.php', '2026-01-01 16:03:22'),
('65d6db4d-e72b-11f0-a16d-c32e9a7c9fa7', '141', 'New admission: test test test for grade Nursery level', 'admission.php', '2026-01-01 16:03:22'),
('65d6eb07-e72b-11f0-a16d-c32e9a7c9fa7', '143', 'New admission: test test test for grade Nursery level', 'admission.php', '2026-01-01 16:03:22'),
('66a6b35f-a54a-11f0-b062-c97b0bc6c277', '3', 'New health record added for student number 2025-52404', 'view_medical_detail.php?medical_id=MED-0010&student_id=2025-52404', '2025-10-10 03:59:01'),
('6791bda3-a690-11f0-b062-c97b0bc6c277', '103', 'Stephany Gandula posted a new lesson titled: rets', 'view_post.php?post_id=76&course_id=32', '2025-10-11 18:52:39'),
('6810e86c-cd1d-11f0-b062-c97b0bc6c277', '100', 'AcadeSys posted new public announcement: test test test', 'announcement.php', '2025-11-29 20:17:43'),
('6810eb3a-cd1d-11f0-b062-c97b0bc6c277', '101', 'AcadeSys posted new public announcement: test test test', 'announcement.php', '2025-11-29 20:17:43'),
('6810ebb5-cd1d-11f0-b062-c97b0bc6c277', '102', 'AcadeSys posted new public announcement: test test test', 'announcement.php', '2025-11-29 20:17:43'),
('6810ebf4-cd1d-11f0-b062-c97b0bc6c277', '103', 'AcadeSys posted new public announcement: test test test', 'announcement.php', '2025-11-29 20:17:43');
INSERT INTO `notifications` (`id`, `user_id`, `message`, `link`, `created_at`) VALUES
('6810ec27-cd1d-11f0-b062-c97b0bc6c277', '104', 'AcadeSys posted new public announcement: test test test', 'announcement.php', '2025-11-29 20:17:43'),
('6810ec8c-cd1d-11f0-b062-c97b0bc6c277', '105', 'AcadeSys posted new public announcement: test test test', 'announcement.php', '2025-11-29 20:17:43'),
('6810ecc4-cd1d-11f0-b062-c97b0bc6c277', '129', 'AcadeSys posted new public announcement: test test test', 'announcement.php', '2025-11-29 20:17:43'),
('6810ecf6-cd1d-11f0-b062-c97b0bc6c277', '130', 'AcadeSys posted new public announcement: test test test', 'announcement.php', '2025-11-29 20:17:43'),
('6810ed2c-cd1d-11f0-b062-c97b0bc6c277', '132', 'AcadeSys posted new public announcement: test test test', 'announcement.php', '2025-11-29 20:17:43'),
('6810ed7c-cd1d-11f0-b062-c97b0bc6c277', '140', 'AcadeSys posted new public announcement: test test test', 'announcement.php', '2025-11-29 20:17:43'),
('685a0da8-da73-11f0-b537-696eec52d845', '1', 'New admission: Davanee Gutierrez Trujillo for grade Kinder level', 'admission.php', '2025-12-16 11:36:05'),
('685a1cfb-da73-11f0-b537-696eec52d845', '141', 'New admission: Davanee Gutierrez Trujillo for grade Kinder level', 'admission.php', '2025-12-16 11:36:05'),
('685a2b60-da73-11f0-b537-696eec52d845', '143', 'New admission: Davanee Gutierrez Trujillo for grade Kinder level', 'admission.php', '2025-12-16 11:36:05'),
('6937e565-ffdc-11f0-95c8-a29b24e0f83a', '268', 'New Check Up record added for student number 2026-33670 by Michelle, Aguilar.', 'view_medical_detail.php?medical_id=MED-0029&student_id=2026-33670', '2026-02-02 10:10:57'),
('6aa4082b-ce78-11f0-b062-c97b0bc6c277', '1', 'New admission: Matthew  Ca for grade Nursery level', 'admission.php', '2025-12-01 05:41:42'),
('6aa421ae-ce78-11f0-b062-c97b0bc6c277', '138', 'New admission: Matthew  Ca for grade Nursery level', 'admission.php', '2025-12-01 05:41:42'),
('6aa4b155-ce78-11f0-b062-c97b0bc6c277', '141', 'New admission: Matthew  Ca for grade Nursery level', 'admission.php', '2025-12-01 05:41:42'),
('6aa4c44c-ce78-11f0-b062-c97b0bc6c277', '143', 'New admission: Matthew  Ca for grade Nursery level', 'admission.php', '2025-12-01 05:41:42'),
('6b2ee2ae-ffd6-11f0-95c8-a29b24e0f83a', '168', 'Stephany Gandula posted a new lesson titled: test', 'view_post.php?post_id=81&course_id=42', '2026-02-02 09:28:03'),
('6b2efc75-ffd6-11f0-95c8-a29b24e0f83a', '265', 'Stephany Gandula posted a new lesson titled: test', 'view_post.php?post_id=81&course_id=42', '2026-02-02 09:28:03'),
('6b2f0b40-ffd6-11f0-95c8-a29b24e0f83a', '267', 'Stephany Gandula posted a new lesson titled: test', 'view_post.php?post_id=81&course_id=42', '2026-02-02 09:28:03'),
('6ba1930d-a436-11f0-b062-c97b0bc6c277', '35', 'Stephany Gandula posted a new assignment in Physical Education 1: asass', 'view_assignment.php?id=30&course_id=25', '2025-10-08 19:03:26'),
('6babc082-a436-11f0-b062-c97b0bc6c277', '37', 'Stephany Gandula posted a new assignment in Physical Education 1: asass', 'view_assignment.php?id=30&course_id=25', '2025-10-08 19:03:26'),
('6bb6e774-a436-11f0-b062-c97b0bc6c277', '52', 'Stephany Gandula posted a new assignment in Physical Education 1: asass', 'view_assignment.php?id=30&course_id=25', '2025-10-08 19:03:26'),
('6bc8c85b-a436-11f0-b062-c97b0bc6c277', '55', 'Stephany Gandula posted a new assignment in Physical Education 1: asass', 'view_assignment.php?id=30&course_id=25', '2025-10-08 19:03:26'),
('6bd08bfd-a43f-11f0-b062-c97b0bc6c277', '40', 'Mary Espinosa submitted an assignment', 'view_assignment.php?course_id=20&id=24', '2025-10-08 12:07:54'),
('6bd2632c-a436-11f0-b062-c97b0bc6c277', '10', 'Stephany Gandula posted a new assignment in Physical Education 1: asass', 'view_assignment.php?id=30&course_id=25', '2025-10-08 19:03:26'),
('6bdc5f67-a436-11f0-b062-c97b0bc6c277', '92', 'Stephany Gandula posted a new assignment in Physical Education 1: asass', 'view_assignment.php?id=30&course_id=25', '2025-10-08 19:03:26'),
('6be64803-a436-11f0-b062-c97b0bc6c277', '99', 'Stephany Gandula posted a new assignment in Physical Education 1: asass', 'view_assignment.php?id=30&course_id=25', '2025-10-08 19:03:26'),
('6d76fcc5-d17a-11f0-b062-c97b0bc6c277', '1', 'New admission: Molly Villanueva Holman for grade Grade 11 level', 'admission.php', '2025-12-05 01:33:40'),
('6d771ca2-d17a-11f0-b062-c97b0bc6c277', '141', 'New admission: Molly Villanueva Holman for grade Grade 11 level', 'admission.php', '2025-12-05 01:33:40'),
('6d772d92-d17a-11f0-b062-c97b0bc6c277', '143', 'New admission: Molly Villanueva Holman for grade Grade 11 level', 'admission.php', '2025-12-05 01:33:40'),
('6df50eb6-a75a-11f0-b062-c97b0bc6c277', '3', 'AcadeSys posted new public announcement: Your child has received a commendation for outstan', 'announcement.php', '2025-10-12 18:58:48'),
('6df511a2-a75a-11f0-b062-c97b0bc6c277', '88', 'AcadeSys posted new public announcement: Your child has received a commendation for outstan', 'announcement.php', '2025-10-12 18:58:48'),
('6df51235-a75a-11f0-b062-c97b0bc6c277', '131', 'AcadeSys posted new public announcement: Your child has received a commendation for outstan', 'announcement.php', '2025-10-12 18:58:48'),
('6fd947b5-a762-11f0-b062-c97b0bc6c277', '3', 'Account number : 95897288 pay this amount for their tuition.', 'view_invoice.php?invoice_id=2035338&tuition_id=46', '2025-10-12 19:56:07'),
('71fbc751-a434-11f0-b062-c97b0bc6c277', '35', 'Stephany Gandula posted a new lesson', 'view_post.php?post_id=66', '2025-10-08 18:49:18'),
('7221cda0-a434-11f0-b062-c97b0bc6c277', '37', 'Stephany Gandula posted a new lesson', 'view_post.php?post_id=66', '2025-10-08 18:49:18'),
('723a696b-a434-11f0-b062-c97b0bc6c277', '52', 'Stephany Gandula posted a new lesson', 'view_post.php?post_id=66', '2025-10-08 18:49:18'),
('72685272-a434-11f0-b062-c97b0bc6c277', '55', 'Stephany Gandula posted a new lesson', 'view_post.php?post_id=66', '2025-10-08 18:49:18'),
('727dd79c-a434-11f0-b062-c97b0bc6c277', '10', 'Stephany Gandula posted a new lesson', 'view_post.php?post_id=66', '2025-10-08 18:49:18'),
('72a88b38-a434-11f0-b062-c97b0bc6c277', '92', 'Stephany Gandula posted a new lesson', 'view_post.php?post_id=66', '2025-10-08 18:49:18'),
('72c70d87-a434-11f0-b062-c97b0bc6c277', '99', 'Stephany Gandula posted a new lesson', 'view_post.php?post_id=66', '2025-10-08 18:49:18'),
('72de7000-0aa7-11f1-8195-20c372f05cfe', '3', 'Noah Ramos time in at 03:49 AM for the subject P.E 1.', 'attendance.php', '2026-02-15 19:49:27'),
('73389a35-cf99-11f0-b062-c97b0bc6c277', '1', 'New admission: Leo Santos Trujillo for grade Nursery level', 'admission.php', '2025-12-02 16:10:41'),
('7338b593-cf99-11f0-b062-c97b0bc6c277', '141', 'New admission: Leo Santos Trujillo for grade Nursery level', 'admission.php', '2025-12-02 16:10:41'),
('7338d80a-cf99-11f0-b062-c97b0bc6c277', '143', 'New admission: Leo Santos Trujillo for grade Nursery level', 'admission.php', '2025-12-02 16:10:41'),
('733fcbef-dafa-11f0-b537-696eec52d845', '1', 'New admission: Kevin Andre Cruz Villamor for grade Grade 5 level', 'admission.php', '2025-12-17 03:42:45'),
('733fe072-dafa-11f0-b537-696eec52d845', '141', 'New admission: Kevin Andre Cruz Villamor for grade Grade 5 level', 'admission.php', '2025-12-17 03:42:45'),
('733ff41d-dafa-11f0-b537-696eec52d845', '143', 'New admission: Kevin Andre Cruz Villamor for grade Grade 5 level', 'admission.php', '2025-12-17 03:42:45'),
('760685c8-d179-11f0-b062-c97b0bc6c277', '1', 'New admission: Saira Gutierrez Boone for grade Grade 7 level', 'admission.php', '2025-12-05 01:26:44'),
('76069dcc-d179-11f0-b062-c97b0bc6c277', '141', 'New admission: Saira Gutierrez Boone for grade Grade 7 level', 'admission.php', '2025-12-05 01:26:44'),
('7606af7d-d179-11f0-b062-c97b0bc6c277', '143', 'New admission: Saira Gutierrez Boone for grade Grade 7 level', 'admission.php', '2025-12-05 01:26:44'),
('761b5b3d-dafd-11f0-b537-696eec52d845', '1', 'New admission: Joshua Mark Flores Abad for grade Grade 5 level', 'admission.php', '2025-12-17 04:04:19'),
('761b707b-dafd-11f0-b537-696eec52d845', '141', 'New admission: Joshua Mark Flores Abad for grade Grade 5 level', 'admission.php', '2025-12-17 04:04:19'),
('761b8441-dafd-11f0-b537-696eec52d845', '143', 'New admission: Joshua Mark Flores Abad for grade Grade 5 level', 'admission.php', '2025-12-17 04:04:19'),
('763b65ed-da72-11f0-b537-696eec52d845', '1', 'New admission: Brian Macaraeg Dulay for grade Grade 2 level', 'admission.php', '2025-12-16 11:29:19'),
('7654ca5e-da72-11f0-b537-696eec52d845', '1', 'New admission: Brian Macaraeg Dulay for grade Grade 2 level', 'admission.php', '2025-12-16 11:29:19'),
('767c53ea-da72-11f0-b537-696eec52d845', '141', 'New admission: Brian Macaraeg Dulay for grade Grade 2 level', 'admission.php', '2025-12-16 11:29:19'),
('76bec197-da72-11f0-b537-696eec52d845', '143', 'New admission: Brian Macaraeg Dulay for grade Grade 2 level', 'admission.php', '2025-12-16 11:29:20'),
('76c95b47-da72-11f0-b537-696eec52d845', '141', 'New admission: Brian Macaraeg Dulay for grade Grade 2 level', 'admission.php', '2025-12-16 11:29:20'),
('7700b0f3-cda0-11f0-b062-c97b0bc6c277', '3', 'julius bergania time in at 11:55 AM for the subject Physical Education 1.', 'attendance.php', '2025-11-30 11:55:52'),
('77072a2c-da72-11f0-b537-696eec52d845', '143', 'New admission: Brian Macaraeg Dulay for grade Grade 2 level', 'admission.php', '2025-12-16 11:29:20'),
('7709a7c5-a450-11f0-b062-c97b0bc6c277', '10', 'Your submission for \"Parts of a Plant\" has been graded.', NULL, '2025-10-08 14:09:54'),
('78f8f87d-daec-11f0-b537-696eec52d845', '1', 'New admission: Adrian Paul Cruz Evangelista for grade Grade 3 level', 'admission.php', '2025-12-17 02:02:42'),
('78f90d61-daec-11f0-b537-696eec52d845', '141', 'New admission: Adrian Paul Cruz Evangelista for grade Grade 3 level', 'admission.php', '2025-12-17 02:02:42'),
('78f91dea-daec-11f0-b537-696eec52d845', '143', 'New admission: Adrian Paul Cruz Evangelista for grade Grade 3 level', 'admission.php', '2025-12-17 02:02:42'),
('7b559b49-a5e9-11f0-b062-c97b0bc6c277', '3', 'Account number : 90928148 pay this amount for their tuition.', 'view_invoice.php?invoice_id=8549660&tuition_id=44', '2025-10-10 22:57:46'),
('7c3886f2-da79-11f0-b537-696eec52d845', '1', 'New admission: Princess Joy Lim Garcia for grade Nursery level', 'admission.php', '2025-12-16 12:19:35'),
('7c389bc7-da79-11f0-b537-696eec52d845', '141', 'New admission: Princess Joy Lim Garcia for grade Nursery level', 'admission.php', '2025-12-16 12:19:35'),
('7c38adc4-da79-11f0-b537-696eec52d845', '143', 'New admission: Princess Joy Lim Garcia for grade Nursery level', 'admission.php', '2025-12-16 12:19:35'),
('7c45e842-a555-11f0-b062-c97b0bc6c277', '3', 'AcadeSys posted new public announcement: test announcement', 'announcement.php', '2025-10-10 05:18:21'),
('7c45ecc9-a555-11f0-b062-c97b0bc6c277', '38', 'AcadeSys posted new public announcement: test announcement', 'announcement.php', '2025-10-10 05:18:21'),
('7c45ed45-a555-11f0-b062-c97b0bc6c277', '39', 'AcadeSys posted new public announcement: test announcement', 'announcement.php', '2025-10-10 05:18:21'),
('7c45f006-a555-11f0-b062-c97b0bc6c277', '40', 'AcadeSys posted new public announcement: test announcement', 'announcement.php', '2025-10-10 05:18:21'),
('7c45f045-a555-11f0-b062-c97b0bc6c277', '41', 'AcadeSys posted new public announcement: test announcement', 'announcement.php', '2025-10-10 05:18:21'),
('7c45f07f-a555-11f0-b062-c97b0bc6c277', '42', 'AcadeSys posted new public announcement: test announcement', 'announcement.php', '2025-10-10 05:18:21'),
('7c45f0ae-a555-11f0-b062-c97b0bc6c277', '43', 'AcadeSys posted new public announcement: test announcement', 'announcement.php', '2025-10-10 05:18:21'),
('7c45f0e0-a555-11f0-b062-c97b0bc6c277', '44', 'AcadeSys posted new public announcement: test announcement', 'announcement.php', '2025-10-10 05:18:21'),
('7c45f10e-a555-11f0-b062-c97b0bc6c277', '45', 'AcadeSys posted new public announcement: test announcement', 'announcement.php', '2025-10-10 05:18:21'),
('7c45f13f-a555-11f0-b062-c97b0bc6c277', '46', 'AcadeSys posted new public announcement: test announcement', 'announcement.php', '2025-10-10 05:18:21'),
('7c45f3d1-a555-11f0-b062-c97b0bc6c277', '47', 'AcadeSys posted new public announcement: test announcement', 'announcement.php', '2025-10-10 05:18:21'),
('7c45f407-a555-11f0-b062-c97b0bc6c277', '48', 'AcadeSys posted new public announcement: test announcement', 'announcement.php', '2025-10-10 05:18:21'),
('7c45f44f-a555-11f0-b062-c97b0bc6c277', '49', 'AcadeSys posted new public announcement: test announcement', 'announcement.php', '2025-10-10 05:18:21'),
('7c45f47a-a555-11f0-b062-c97b0bc6c277', '50', 'AcadeSys posted new public announcement: test announcement', 'announcement.php', '2025-10-10 05:18:21'),
('7c45f4ac-a555-11f0-b062-c97b0bc6c277', '51', 'AcadeSys posted new public announcement: test announcement', 'announcement.php', '2025-10-10 05:18:21'),
('7c45f4d9-a555-11f0-b062-c97b0bc6c277', '88', 'AcadeSys posted new public announcement: test announcement', 'announcement.php', '2025-10-10 05:18:21'),
('7c45f505-a555-11f0-b062-c97b0bc6c277', '100', 'AcadeSys posted new public announcement: test announcement', 'announcement.php', '2025-10-10 05:18:21'),
('7c45f577-a555-11f0-b062-c97b0bc6c277', '101', 'AcadeSys posted new public announcement: test announcement', 'announcement.php', '2025-10-10 05:18:21'),
('7c4659ee-a555-11f0-b062-c97b0bc6c277', '102', 'AcadeSys posted new public announcement: test announcement', 'announcement.php', '2025-10-10 05:18:21'),
('7c465ae4-a555-11f0-b062-c97b0bc6c277', '103', 'AcadeSys posted new public announcement: test announcement', 'announcement.php', '2025-10-10 05:18:21'),
('7c465b45-a555-11f0-b062-c97b0bc6c277', '104', 'AcadeSys posted new public announcement: test announcement', 'announcement.php', '2025-10-10 05:18:21'),
('7cabce25-ffdc-11f0-95c8-a29b24e0f83a', '268', 'New Request Medicine record added for student number 2026-33670 by Michelle, Aguilar.', 'view_medical_detail.php?medical_id=MED-0030&student_id=2026-33670', '2026-02-02 10:11:29'),
('7d503904-cb41-11f0-b062-c97b0bc6c277', '46', 'Noah Ramos submitted an assignment \"Alphabet\" for \"English\"', 'view_assignment.php?course_id=37&id=38', '2025-11-27 03:30:58'),
('7d742d0b-cb3e-11f0-b062-c97b0bc6c277', '100', 'AcadeSys posted new public announcement: dsgdv', 'announcement.php', '2025-11-27 11:09:30'),
('7d742e37-cb3e-11f0-b062-c97b0bc6c277', '101', 'AcadeSys posted new public announcement: dsgdv', 'announcement.php', '2025-11-27 11:09:30'),
('7d742ede-cb3e-11f0-b062-c97b0bc6c277', '102', 'AcadeSys posted new public announcement: dsgdv', 'announcement.php', '2025-11-27 11:09:30'),
('7d742f16-cb3e-11f0-b062-c97b0bc6c277', '103', 'AcadeSys posted new public announcement: dsgdv', 'announcement.php', '2025-11-27 11:09:30'),
('7d742f4c-cb3e-11f0-b062-c97b0bc6c277', '104', 'AcadeSys posted new public announcement: dsgdv', 'announcement.php', '2025-11-27 11:09:30'),
('7d742fa4-cb3e-11f0-b062-c97b0bc6c277', '105', 'AcadeSys posted new public announcement: dsgdv', 'announcement.php', '2025-11-27 11:09:30'),
('7d74303c-cb3e-11f0-b062-c97b0bc6c277', '129', 'AcadeSys posted new public announcement: dsgdv', 'announcement.php', '2025-11-27 11:09:30'),
('7d743079-cb3e-11f0-b062-c97b0bc6c277', '130', 'AcadeSys posted new public announcement: dsgdv', 'announcement.php', '2025-11-27 11:09:30'),
('7d7430b3-cb3e-11f0-b062-c97b0bc6c277', '132', 'AcadeSys posted new public announcement: dsgdv', 'announcement.php', '2025-11-27 11:09:30'),
('7d743103-cb3e-11f0-b062-c97b0bc6c277', '140', 'AcadeSys posted new public announcement: dsgdv', 'announcement.php', '2025-11-27 11:09:30'),
('7d7a92ae-a456-11f0-b062-c97b0bc6c277', '59', 'Stephany Gandula graded your assignment', 'view_assignment.php?status=1&id=24', '2025-10-08 22:53:00'),
('7df64832-db16-11f0-b537-696eec52d845', '3', 'Noah Ramos time in at 03:03 PM for the subject Science 1 - Moonstone.', 'attendance.php', '2025-12-17 15:03:29'),
('7e481860-db17-11f0-b537-696eec52d845', '3', 'Noah Ramos time in at 03:10 PM for the subject Science 1 - Moonstone.', 'attendance.php', '2025-12-17 15:10:39'),
('7e7b026d-daf7-11f0-b537-696eec52d845', '1', 'New admission: Vincent Paul Soriano Balagtas for grade Grade 4 level', 'admission.php', '2025-12-17 03:21:36'),
('7e7b18f2-daf7-11f0-b537-696eec52d845', '141', 'New admission: Vincent Paul Soriano Balagtas for grade Grade 4 level', 'admission.php', '2025-12-17 03:21:36'),
('7e7b2e86-daf7-11f0-b537-696eec52d845', '143', 'New admission: Vincent Paul Soriano Balagtas for grade Grade 4 level', 'admission.php', '2025-12-17 03:21:36'),
('80ee9d643b15887a232c27ef947f5c8c', '10', '  graded your assignment &quot;Parts of a Plant&quot;', 'view_assignment.php?id=24', '2025-10-08 14:13:47'),
('818e9af5-a555-11f0-b062-c97b0bc6c277', '3', 'AcadeSys posted new public announcement: test parents', 'announcement.php', '2025-10-10 05:18:30'),
('818e9d63-a555-11f0-b062-c97b0bc6c277', '38', 'AcadeSys posted new public announcement: test parents', 'announcement.php', '2025-10-10 05:18:30'),
('818e9db6-a555-11f0-b062-c97b0bc6c277', '39', 'AcadeSys posted new public announcement: test parents', 'announcement.php', '2025-10-10 05:18:30'),
('818e9e94-a555-11f0-b062-c97b0bc6c277', '40', 'AcadeSys posted new public announcement: test parents', 'announcement.php', '2025-10-10 05:18:30'),
('818e9ec9-a555-11f0-b062-c97b0bc6c277', '41', 'AcadeSys posted new public announcement: test parents', 'announcement.php', '2025-10-10 05:18:30'),
('818e9f01-a555-11f0-b062-c97b0bc6c277', '42', 'AcadeSys posted new public announcement: test parents', 'announcement.php', '2025-10-10 05:18:30'),
('818e9f34-a555-11f0-b062-c97b0bc6c277', '43', 'AcadeSys posted new public announcement: test parents', 'announcement.php', '2025-10-10 05:18:30'),
('818e9f63-a555-11f0-b062-c97b0bc6c277', '44', 'AcadeSys posted new public announcement: test parents', 'announcement.php', '2025-10-10 05:18:30'),
('818e9f91-a555-11f0-b062-c97b0bc6c277', '45', 'AcadeSys posted new public announcement: test parents', 'announcement.php', '2025-10-10 05:18:30'),
('818e9fc0-a555-11f0-b062-c97b0bc6c277', '46', 'AcadeSys posted new public announcement: test parents', 'announcement.php', '2025-10-10 05:18:30'),
('818e9ff1-a555-11f0-b062-c97b0bc6c277', '47', 'AcadeSys posted new public announcement: test parents', 'announcement.php', '2025-10-10 05:18:30'),
('818ea021-a555-11f0-b062-c97b0bc6c277', '48', 'AcadeSys posted new public announcement: test parents', 'announcement.php', '2025-10-10 05:18:30'),
('818ea069-a555-11f0-b062-c97b0bc6c277', '49', 'AcadeSys posted new public announcement: test parents', 'announcement.php', '2025-10-10 05:18:30'),
('818ea097-a555-11f0-b062-c97b0bc6c277', '50', 'AcadeSys posted new public announcement: test parents', 'announcement.php', '2025-10-10 05:18:30'),
('818ea0c9-a555-11f0-b062-c97b0bc6c277', '51', 'AcadeSys posted new public announcement: test parents', 'announcement.php', '2025-10-10 05:18:30'),
('818ea0fa-a555-11f0-b062-c97b0bc6c277', '88', 'AcadeSys posted new public announcement: test parents', 'announcement.php', '2025-10-10 05:18:30'),
('818ea129-a555-11f0-b062-c97b0bc6c277', '100', 'AcadeSys posted new public announcement: test parents', 'announcement.php', '2025-10-10 05:18:30'),
('818ea158-a555-11f0-b062-c97b0bc6c277', '101', 'AcadeSys posted new public announcement: test parents', 'announcement.php', '2025-10-10 05:18:30'),
('818ea18d-a555-11f0-b062-c97b0bc6c277', '102', 'AcadeSys posted new public announcement: test parents', 'announcement.php', '2025-10-10 05:18:30'),
('818ea1bf-a555-11f0-b062-c97b0bc6c277', '103', 'AcadeSys posted new public announcement: test parents', 'announcement.php', '2025-10-10 05:18:30'),
('818ea240-a555-11f0-b062-c97b0bc6c277', '104', 'AcadeSys posted new public announcement: test parents', 'announcement.php', '2025-10-10 05:18:30'),
('81fd6fe5-da5f-11f0-b537-696eec52d845', '1', 'New admission: Fyke Baptist Dulay for grade Grade 11 level', 'admission.php', '2025-12-16 09:13:38'),
('822d87f5-da5f-11f0-b537-696eec52d845', '141', 'New admission: Fyke Baptist Dulay for grade Grade 11 level', 'admission.php', '2025-12-16 09:13:38'),
('824e5de4-d11e-11f0-b062-c97b0bc6c277', '1', 'New admission: Franklin Garcia Maddox for grade Grade 2 level', 'admission.php', '2025-12-04 14:35:41'),
('824e70e7-d11e-11f0-b062-c97b0bc6c277', '141', 'New admission: Franklin Garcia Maddox for grade Grade 2 level', 'admission.php', '2025-12-04 14:35:41'),
('824e7ecd-d11e-11f0-b062-c97b0bc6c277', '143', 'New admission: Franklin Garcia Maddox for grade Grade 2 level', 'admission.php', '2025-12-04 14:35:41'),
('8251d492-da5f-11f0-b537-696eec52d845', '1', 'New admission: Fyke Baptist Dulay for grade Grade 11 level', 'admission.php', '2025-12-16 09:13:39'),
('825d713c-da5f-11f0-b537-696eec52d845', '143', 'New admission: Fyke Baptist Dulay for grade Grade 11 level', 'admission.php', '2025-12-16 09:13:39'),
('82916ce7-da5f-11f0-b537-696eec52d845', '141', 'New admission: Fyke Baptist Dulay for grade Grade 11 level', 'admission.php', '2025-12-16 09:13:39'),
('82bed1e7-da7e-11f0-b537-696eec52d845', '1', 'New admission: John Carlo Fajardo Alonzo for grade Grade 1 level', 'admission.php', '2025-12-16 12:55:34'),
('82bee8b3-da7e-11f0-b537-696eec52d845', '141', 'New admission: John Carlo Fajardo Alonzo for grade Grade 1 level', 'admission.php', '2025-12-16 12:55:34'),
('82befa91-da7e-11f0-b537-696eec52d845', '143', 'New admission: John Carlo Fajardo Alonzo for grade Grade 1 level', 'admission.php', '2025-12-16 12:55:34'),
('82ce0454-da5f-11f0-b537-696eec52d845', '143', 'New admission: Fyke Baptist Dulay for grade Grade 11 level', 'admission.php', '2025-12-16 09:13:39'),
('835beabf-f902-11f0-95c8-a29b24e0f83a', '1', 'New admission: MC Apelido Escalora for grade Kinder level', 'admission.php', '2026-01-24 08:56:03'),
('835c06d5-f902-11f0-95c8-a29b24e0f83a', '141', 'New admission: MC Apelido Escalora for grade Kinder level', 'admission.php', '2026-01-24 08:56:03'),
('835c1dac-f902-11f0-95c8-a29b24e0f83a', '143', 'New admission: MC Apelido Escalora for grade Kinder level', 'admission.php', '2026-01-24 08:56:03'),
('83b27be9-cdf4-11f0-b062-c97b0bc6c277', '3', 'Account number : 32620770 pay this amount for their tuition.', 'view_invoice.php?invoice_id=8105792&tuition_id=54', '2025-11-30 21:57:31'),
('84326962-db6d-11f0-b537-696eec52d845', '1', 'New admission: Brian Macaraeg Dulay for grade Kinder level', 'admission.php', '2025-12-17 17:26:26'),
('845f64b6-db6d-11f0-b537-696eec52d845', '141', 'New admission: Brian Macaraeg Dulay for grade Kinder level', 'admission.php', '2025-12-17 17:26:26'),
('848c6ce6-db6d-11f0-b537-696eec52d845', '143', 'New admission: Brian Macaraeg Dulay for grade Kinder level', 'admission.php', '2025-12-17 17:26:27'),
('85537e2a-da75-11f0-b537-696eec52d845', '1', 'New admission: Lorenzo Miguel Rivera Pascual for grade Nursery level', 'admission.php', '2025-12-16 11:51:13'),
('855397b1-da75-11f0-b537-696eec52d845', '141', 'New admission: Lorenzo Miguel Rivera Pascual for grade Nursery level', 'admission.php', '2025-12-16 11:51:13'),
('8553aa23-da75-11f0-b537-696eec52d845', '143', 'New admission: Lorenzo Miguel Rivera Pascual for grade Nursery level', 'admission.php', '2025-12-16 11:51:13'),
('865b83a7-da57-11f0-b537-696eec52d845', '1', 'New admission: Rick Macaraeg Dulay for grade Grade 4 level', 'admission.php', '2025-12-16 08:16:29'),
('868be122-da57-11f0-b537-696eec52d845', '141', 'New admission: Rick Macaraeg Dulay for grade Grade 4 level', 'admission.php', '2025-12-16 08:16:30'),
('86bb940e-da57-11f0-b537-696eec52d845', '143', 'New admission: Rick Macaraeg Dulay for grade Grade 4 level', 'admission.php', '2025-12-16 08:16:30'),
('8714e9ee-b2e7-11f0-b062-c97b0bc6c277', '1', 'Student admission', 'admission_old.php', '2025-10-27 03:46:32'),
('87781866-b2e7-11f0-b062-c97b0bc6c277', '138', 'Student admission', 'admission_old.php', '2025-10-27 03:46:32'),
('88934aac-a690-11f0-b062-c97b0bc6c277', '103', 'Stephany Gandula posted a new lesson titled: asass', 'view_post.php?post_id=77&course_id=32', '2025-10-11 18:53:34'),
('8b3998f4-dadb-11f0-b537-696eec52d845', '1', 'New admission: Ronald James Herrera Peña for grade Grade 2 level', 'admission.php', '2025-12-17 00:01:31'),
('8b39b2e7-dadb-11f0-b537-696eec52d845', '141', 'New admission: Ronald James Herrera Peña for grade Grade 2 level', 'admission.php', '2025-12-17 00:01:31'),
('8b39c65d-dadb-11f0-b537-696eec52d845', '143', 'New admission: Ronald James Herrera Peña for grade Grade 2 level', 'admission.php', '2025-12-17 00:01:31'),
('8b677b6a-fcb6-11f0-95c8-a29b24e0f83a', '3', 'Account number : 58238767 pay this amount for their tuition.', 'view_invoice.php?invoice_id=9531807&tuition_id=187', '2026-01-29 10:02:20'),
('8dd00505-db6f-11f0-b537-696eec52d845', '1', 'New admission: Johnny Macaraeg Cash for grade Grade 4 level', 'admission.php', '2025-12-17 17:41:01'),
('8df1dde0-db6f-11f0-b537-696eec52d845', '141', 'New admission: Johnny Macaraeg Cash for grade Grade 4 level', 'admission.php', '2025-12-17 17:41:01'),
('8e0d29c9-db6f-11f0-b537-696eec52d845', '143', 'New admission: Johnny Macaraeg Cash for grade Grade 4 level', 'admission.php', '2025-12-17 17:41:01'),
('8fb2563a-fcb3-11f0-95c8-a29b24e0f83a', '3', 'nick azcueta time in at 09:40 AM for the subject Filipino 1.', 'attendance.php', '2026-01-29 09:40:58'),
('911a86d3-a43c-11f0-b062-c97b0bc6c277', '40', '  submitted an assignment', 'view_assignment.php?course_id=25&id=30', '2025-10-08 11:47:28'),
('91e77da8-a449-11f0-b062-c97b0bc6c277', '40', 'Mary Espinosa submitted an assignment \"Parts of a Plant\" for \"Science 1\"', 'view_assignment.php?course_id=20&id=24', '2025-10-08 13:20:33'),
('92073477-ce7d-11f0-b062-c97b0bc6c277', '145', 'Account number : 83439754 pay this amount for their tuition.', 'view_invoice.php?invoice_id=4647700&tuition_id=55', '2025-12-01 14:18:36'),
('92b05b9b-a539-11f0-b062-c97b0bc6c277', '3', 'Liam Santos time in at 01:58 AM for the subject Mathematics 1 - Moonstone.', 'attendance.php', '2025-10-10 01:58:34'),
('92f37382-dadf-11f0-b537-696eec52d845', '1', 'New admission: Bryan Matthew Salazar Cabrera for grade Grade 2 level', 'admission.php', '2025-12-17 00:30:22'),
('92f389c6-dadf-11f0-b537-696eec52d845', '141', 'New admission: Bryan Matthew Salazar Cabrera for grade Grade 2 level', 'admission.php', '2025-12-17 00:30:22'),
('92f39b55-dadf-11f0-b537-696eec52d845', '143', 'New admission: Bryan Matthew Salazar Cabrera for grade Grade 2 level', 'admission.php', '2025-12-17 00:30:22'),
('9457785a-ffdc-11f0-95c8-a29b24e0f83a', '268', 'New Clinic Visit record added for student number 2026-33670 by Michelle, Aguilar.', 'view_medical_detail.php?medical_id=MED-0031&student_id=2026-33670', '2026-02-02 10:12:09'),
('949cd13a-ffdc-11f0-95c8-a29b24e0f83a', '268', 'New Clinic Visit record added for student number 2026-33670 by Michelle, Aguilar.', 'view_medical_detail.php?medical_id=MED-0032&student_id=2026-33670', '2026-02-02 10:12:09'),
('959daa7a-a54b-11f0-b062-c97b0bc6c277', '3', 'New disciplinary record added for student number 2025-19974', 'view_disciplinary_detail.php?disciplinary_id=DISC-7584&student_id=2025-19974', '2025-10-10 04:07:29'),
('9600fee5-a459-11f0-b062-c97b0bc6c277', '35', 'Stephany Gandula posted a new lesson titled: Fundamentals of Physical Fitness: Cardio & Strength Training', 'view_post.php?post_id=69&course_id=25', '2025-10-08 23:15:10'),
('961ee847-a459-11f0-b062-c97b0bc6c277', '37', 'Stephany Gandula posted a new lesson titled: Fundamentals of Physical Fitness: Cardio & Strength Training', 'view_post.php?post_id=69&course_id=25', '2025-10-08 23:15:10'),
('963e2194-a459-11f0-b062-c97b0bc6c277', '52', 'Stephany Gandula posted a new lesson titled: Fundamentals of Physical Fitness: Cardio & Strength Training', 'view_post.php?post_id=69&course_id=25', '2025-10-08 23:15:10'),
('9657a444-d276-11f0-b062-c97b0bc6c277', '3', 'New disciplinary record added for student number 2025-13565', 'view_disciplinary_detail.php?disciplinary_id=DISC-0887&student_id=2025-13565', '2025-12-06 15:38:41'),
('965d2d95-a459-11f0-b062-c97b0bc6c277', '55', 'Stephany Gandula posted a new lesson titled: Fundamentals of Physical Fitness: Cardio & Strength Training', 'view_post.php?post_id=69&course_id=25', '2025-10-08 23:15:10'),
('96a80a5f-a459-11f0-b062-c97b0bc6c277', '10', 'Stephany Gandula posted a new lesson titled: Fundamentals of Physical Fitness: Cardio & Strength Training', 'view_post.php?post_id=69&course_id=25', '2025-10-08 23:15:10'),
('9726218d-a459-11f0-b062-c97b0bc6c277', '92', 'Stephany Gandula posted a new lesson titled: Fundamentals of Physical Fitness: Cardio & Strength Training', 'view_post.php?post_id=69&course_id=25', '2025-10-08 23:15:10'),
('973dfc48-a459-11f0-b062-c97b0bc6c277', '99', 'Stephany Gandula posted a new lesson titled: Fundamentals of Physical Fitness: Cardio & Strength Training', 'view_post.php?post_id=69&course_id=25', '2025-10-08 23:15:10'),
('978cb05f-a538-11f0-b062-c97b0bc6c277', '101', 'Roshane Mauricio posted a new assignment in Mathematics 1 - Moonstone: Assessment 1: Counting Numbers', 'view_assignment.php?id=33&course_id=35', '2025-10-10 01:51:32'),
('97de1aff-fc89-11f0-95c8-a29b24e0f83a', '1', 'New admission: Alyssa Mae Romero Velasco for grade Grade 2 level', 'admission_old.php', '2026-01-28 20:40:33'),
('97de3ab9-fc89-11f0-95c8-a29b24e0f83a', '141', 'New admission: Alyssa Mae Romero Velasco for grade Grade 2 level', 'admission_old.php', '2026-01-28 20:40:33'),
('97de50ae-fc89-11f0-95c8-a29b24e0f83a', '143', 'New admission: Alyssa Mae Romero Velasco for grade Grade 2 level', 'admission_old.php', '2026-01-28 20:40:33'),
('9806ca0b-a538-11f0-b062-c97b0bc6c277', '103', 'Roshane Mauricio posted a new assignment in Mathematics 1 - Moonstone: Assessment 1: Counting Numbers', 'view_assignment.php?id=33&course_id=35', '2025-10-10 01:51:32'),
('9895406e-a538-11f0-b062-c97b0bc6c277', '104', 'Roshane Mauricio posted a new assignment in Mathematics 1 - Moonstone: Assessment 1: Counting Numbers', 'view_assignment.php?id=33&course_id=35', '2025-10-10 01:51:32'),
('98c9b59f-a538-11f0-b062-c97b0bc6c277', '102', 'Roshane Mauricio posted a new assignment in Mathematics 1 - Moonstone: Assessment 1: Counting Numbers', 'view_assignment.php?id=33&course_id=35', '2025-10-10 01:51:32'),
('98e3619b-a5cd-11f0-b062-c97b0bc6c277', '3', 'Account number : 70714702 pay this amount for their tuition.', 'view_invoice.php?invoice_id=6610252&tuition_id=43', '2025-10-10 19:38:09'),
('98e441c1-ffd6-11f0-95c8-a29b24e0f83a', '40', 'Andrew Paul Wilson submitted an assignment \"test\" for \"Filipino 1\"', 'view_assignment.php?course_id=42&id=41', '2026-02-02 01:29:20'),
('9a5c1b6e-fcb8-11f0-95c8-a29b24e0f83a', '3', 'New Check Up record added for student number 2026-12877 by Michelle, Aguilar.', 'view_medical_detail.php?medical_id=MED-0028&student_id=2026-12877', '2026-01-29 10:17:04'),
('9aa326c5-dce9-11f0-b537-696eec52d845', '102', 'Stephany Gandula posted a new assignment in Physical Education 1: test', 'view_assignment.php?id=39&course_id=25', '2025-12-19 22:47:12'),
('9bbbe431-a75d-11f0-b062-c97b0bc6c277', '3', 'New disciplinary record added for student number 2025-71431', 'view_disciplinary_detail.php?disciplinary_id=DISC-5986&student_id=2025-71431', '2025-10-12 19:21:33'),
('9c515c42-0865-11f1-8195-20c372f05cfe', '102', 'A parent account has been successfully linked to you.', 'student_dashboard.php', '2026-02-12 22:53:13'),
('9cdae0b6-da78-11f0-b537-696eec52d845', '1', 'New admission: Mark Anthony Villanueva Reyes for grade Kinder level', 'admission.php', '2025-12-16 12:13:21'),
('9cdb030d-da78-11f0-b537-696eec52d845', '141', 'New admission: Mark Anthony Villanueva Reyes for grade Kinder level', 'admission.php', '2025-12-16 12:13:21'),
('9cdb1abd-da78-11f0-b537-696eec52d845', '143', 'New admission: Mark Anthony Villanueva Reyes for grade Kinder level', 'admission.php', '2025-12-16 12:13:21'),
('9f4135fc-a438-11f0-b062-c97b0bc6c277', '35', 'Stephany Gandula posted a new assignment in Physical Education 1: asasas', 'view_assignment.php?id=31&course_id=25', '2025-10-08 19:19:12'),
('9f8ab66f-a438-11f0-b062-c97b0bc6c277', '37', 'Stephany Gandula posted a new assignment in Physical Education 1: asasas', 'view_assignment.php?id=31&course_id=25', '2025-10-08 19:19:12'),
('9f9a46a7-d4fa-11f0-b062-c97b0bc6c277', '1', 'New admission: Rick Macaraeg Dulay for grade Nursery level', 'admission.php', '2025-12-09 12:28:53'),
('9fabb2ac-a438-11f0-b062-c97b0bc6c277', '52', 'Stephany Gandula posted a new assignment in Physical Education 1: asasas', 'view_assignment.php?id=31&course_id=25', '2025-10-08 19:19:12'),
('9fcb7453-a438-11f0-b062-c97b0bc6c277', '55', 'Stephany Gandula posted a new assignment in Physical Education 1: asasas', 'view_assignment.php?id=31&course_id=25', '2025-10-08 19:19:12'),
('9fe193cb-d4fa-11f0-b062-c97b0bc6c277', '141', 'New admission: Rick Macaraeg Dulay for grade Nursery level', 'admission.php', '2025-12-09 12:28:53'),
('9fea0d8b-a438-11f0-b062-c97b0bc6c277', '10', 'Stephany Gandula posted a new assignment in Physical Education 1: asasas', 'view_assignment.php?id=31&course_id=25', '2025-10-08 19:19:12'),
('a007d8c8-a438-11f0-b062-c97b0bc6c277', '92', 'Stephany Gandula posted a new assignment in Physical Education 1: asasas', 'view_assignment.php?id=31&course_id=25', '2025-10-08 19:19:12'),
('a0240504-a438-11f0-b062-c97b0bc6c277', '99', 'Stephany Gandula posted a new assignment in Physical Education 1: asasas', 'view_assignment.php?id=31&course_id=25', '2025-10-08 19:19:12'),
('a03381e0-d4fa-11f0-b062-c97b0bc6c277', '143', 'New admission: Rick Macaraeg Dulay for grade Nursery level', 'admission.php', '2025-12-09 12:28:54'),
('a149ee3d-a54c-11f0-b062-c97b0bc6c277', '3', 'New disciplinary record added for student number 2025-19974', 'view_disciplinary_detail.php?disciplinary_id=DISC-8402&student_id=2025-19974', '2025-10-10 04:14:58'),
('a3bcc8f0-8b87-467f-a2b7-3e2ddaa9aed6', '10', '  graded your assignment \"Parts of a Plant\"', 'view_assignment.php?id=24', '2025-10-08 14:46:00'),
('a447289a-d0ff-11f0-b062-c97b0bc6c277', '1', 'New admission: Leo Santos Trujillo for grade Nursery level', 'admission.php', '2025-12-04 10:54:43'),
('a447404c-d0ff-11f0-b062-c97b0bc6c277', '141', 'New admission: Leo Santos Trujillo for grade Nursery level', 'admission.php', '2025-12-04 10:54:43'),
('a4475706-d0ff-11f0-b062-c97b0bc6c277', '143', 'New admission: Leo Santos Trujillo for grade Nursery level', 'admission.php', '2025-12-04 10:54:43'),
('a47335d0-da7c-11f0-b537-696eec52d845', '1', 'New admission: Kyle Andrew Mercado Pineda for grade Kinder level', 'admission.php', '2025-12-16 12:42:11'),
('a47345c5-da7c-11f0-b537-696eec52d845', '141', 'New admission: Kyle Andrew Mercado Pineda for grade Kinder level', 'admission.php', '2025-12-16 12:42:11'),
('a473521a-da7c-11f0-b537-696eec52d845', '143', 'New admission: Kyle Andrew Mercado Pineda for grade Kinder level', 'admission.php', '2025-12-16 12:42:11'),
('a5153d7c-05f5-11f1-95c8-a29b24e0f83a', '1', 'New admission: test test test for grade Nursery level', 'admission.php', '2026-02-09 20:26:41'),
('a53e64ee-05f5-11f1-95c8-a29b24e0f83a', '141', 'New admission: test test test for grade Nursery level', 'admission.php', '2026-02-09 20:26:42'),
('a56920d9-05f5-11f1-95c8-a29b24e0f83a', '143', 'New admission: test test test for grade Nursery level', 'admission.php', '2026-02-09 20:26:42'),
('a90cefac-aca4-11f0-b062-c97b0bc6c277', '39', 'Dave Bergania submitted an assignment \"Assessment 1: Counting Numbers\" for \"Mathematics 1 - Moonstone\"', 'view_assignment.php?course_id=35&id=33', '2025-10-19 04:32:45'),
('aa40e35b-a54d-11f0-b062-c97b0bc6c277', '3', 'New health record added for student number 2025-19974', 'view_medical_detail.php?medical_id=MED-0012&student_id=2025-19974', '2025-10-10 04:22:23'),
('aa93fa75-cb37-11f0-b062-c97b0bc6c277', '46', 'Noah Ramos submitted an assignment \"Alphabet\" for \"English\"', 'view_assignment.php?course_id=37&id=38', '2025-11-27 02:20:39'),
('ad6c45e1-a690-11f0-b062-c97b0bc6c277', '103', 'Stephany Gandula posted a new assignment in Filipino 1 - Moonstone: pangungusap', 'view_assignment.php?id=34&course_id=32', '2025-10-11 18:54:36'),
('ae0e1f7a-a439-11f0-b062-c97b0bc6c277', '35', 'Stephany Gandula posted a new lesson titled: as', 'view_post.php?post_id=68&course_id=25', '2025-10-08 19:26:46'),
('ae4c6786-a439-11f0-b062-c97b0bc6c277', '37', 'Stephany Gandula posted a new lesson titled: as', 'view_post.php?post_id=68&course_id=25', '2025-10-08 19:26:46'),
('ae98e44a-a439-11f0-b062-c97b0bc6c277', '52', 'Stephany Gandula posted a new lesson titled: as', 'view_post.php?post_id=68&course_id=25', '2025-10-08 19:26:46'),
('aec0a0f5-a439-11f0-b062-c97b0bc6c277', '55', 'Stephany Gandula posted a new lesson titled: as', 'view_post.php?post_id=68&course_id=25', '2025-10-08 19:26:46'),
('af05da5a-dac7-11f0-b537-696eec52d845', '3', 'Noah Ramos time in at 05:39 AM for the subject Mathermatics.', 'attendance.php', '2025-12-17 05:39:21'),
('af0992e5-a439-11f0-b062-c97b0bc6c277', '10', 'Stephany Gandula posted a new lesson titled: as', 'view_post.php?post_id=68&course_id=25', '2025-10-08 19:26:46'),
('af43f24a-a439-11f0-b062-c97b0bc6c277', '92', 'Stephany Gandula posted a new lesson titled: as', 'view_post.php?post_id=68&course_id=25', '2025-10-08 19:26:46'),
('af8414d9-a439-11f0-b062-c97b0bc6c277', '99', 'Stephany Gandula posted a new lesson titled: as', 'view_post.php?post_id=68&course_id=25', '2025-10-08 19:26:46'),
('aff5667d-a538-11f0-b062-c97b0bc6c277', '101', 'Roshane Mauricio posted a new lesson titled: Lesson 2: Comparing Numbers', 'view_post.php?post_id=71&course_id=35', '2025-10-10 01:52:13'),
('b0156887-a538-11f0-b062-c97b0bc6c277', '103', 'Roshane Mauricio posted a new lesson titled: Lesson 2: Comparing Numbers', 'view_post.php?post_id=71&course_id=35', '2025-10-10 01:52:13'),
('b01edf08-cb41-11f0-b062-c97b0bc6c277', '46', 'Noah Ramos submitted an assignment \"Alphabet\" for \"English\"', 'view_assignment.php?course_id=37&id=38', '2025-11-27 03:32:23'),
('b0358961-a538-11f0-b062-c97b0bc6c277', '104', 'Roshane Mauricio posted a new lesson titled: Lesson 2: Comparing Numbers', 'view_post.php?post_id=71&course_id=35', '2025-10-10 01:52:13'),
('b05595d8-a538-11f0-b062-c97b0bc6c277', '102', 'Roshane Mauricio posted a new lesson titled: Lesson 2: Comparing Numbers', 'view_post.php?post_id=71&course_id=35', '2025-10-10 01:52:13'),
('b194be8d-a43e-11f0-b062-c97b0bc6c277', '40', '  submitted an assignment', 'view_assignment.php?course_id=25&id=31', '2025-10-08 12:02:42'),
('b381d6fc-aca4-11f0-b062-c97b0bc6c277', '39', 'Dave Bergania submitted an assignment \"Assessment 1: Counting Numbers\" for \"Mathematics 1 - Moonstone\"', 'view_assignment.php?course_id=35&id=33', '2025-10-19 04:33:03'),
('b46fef1c-0389-11f1-95c8-a29b24e0f83a', '3', 'Account number : 21478301 pay this amount for their tuition.', 'view_invoice.php?invoice_id=7392884&tuition_id=63', '2026-02-07 02:28:59'),
('b48aaf98-fcb9-11f0-95c8-a29b24e0f83a', '3', 'New disciplinary record added for student number 2026-12877', 'view_disciplinary_detail.php?disciplinary_id=DISC-0928&student_id=2026-12877', '2026-01-29 10:24:57'),
('b521e0cb-a688-11f0-b062-c97b0bc6c277', '3', 'Noah Ramos time in at 05:57 PM for the subject Mathematics 1 - Moonstone.', 'attendance.php', '2025-10-11 17:57:33'),
('b59ce6f7-daf5-11f0-b537-696eec52d845', '1', 'New admission: Sophia Mae Tolentino Jimenez for grade Grade 3 level', 'admission.php', '2025-12-17 03:08:49'),
('b59d0416-daf5-11f0-b537-696eec52d845', '141', 'New admission: Sophia Mae Tolentino Jimenez for grade Grade 3 level', 'admission.php', '2025-12-17 03:08:49'),
('b59d707b-daf5-11f0-b537-696eec52d845', '143', 'New admission: Sophia Mae Tolentino Jimenez for grade Grade 3 level', 'admission.php', '2025-12-17 03:08:49'),
('b67af6ee-da55-11f0-b537-696eec52d845', '1', 'New admission: Brian Macaraeg Dulay for grade Grade 1 level', 'admission.php', '2025-12-16 08:03:31'),
('b6887a9c-da7b-11f0-b537-696eec52d845', '1', 'New admission: Christian Paolo Ramirez Torres for grade Kinder level', 'admission.php', '2025-12-16 12:35:32'),
('b6888b8e-da7b-11f0-b537-696eec52d845', '141', 'New admission: Christian Paolo Ramirez Torres for grade Kinder level', 'admission.php', '2025-12-16 12:35:32'),
('b6889871-da7b-11f0-b537-696eec52d845', '143', 'New admission: Christian Paolo Ramirez Torres for grade Kinder level', 'admission.php', '2025-12-16 12:35:32'),
('b6a31747-d55a-11f0-b062-c97b0bc6c277', '1', 'New admission: Leo Santos Trujillo for grade Kinder level', 'admission_old.php', '2025-12-09 23:56:43'),
('b6bc4a4c-d55a-11f0-b062-c97b0bc6c277', '141', 'New admission: Leo Santos Trujillo for grade Kinder level', 'admission_old.php', '2025-12-09 23:56:43'),
('b6be7a1a-da55-11f0-b537-696eec52d845', '141', 'New admission: Brian Macaraeg Dulay for grade Grade 1 level', 'admission.php', '2025-12-16 08:03:32'),
('b6d84859-d55a-11f0-b062-c97b0bc6c277', '143', 'New admission: Leo Santos Trujillo for grade Kinder level', 'admission_old.php', '2025-12-09 23:56:43'),
('b6fec058-da55-11f0-b537-696eec52d845', '143', 'New admission: Brian Macaraeg Dulay for grade Grade 1 level', 'admission.php', '2025-12-16 08:03:32'),
('b70fc19e-da7d-11f0-b537-696eec52d845', '1', 'New admission: Alyssa Mae Romero Velasco for grade Grade 1 level', 'admission.php', '2025-12-16 12:49:52'),
('b70fe12a-da7d-11f0-b537-696eec52d845', '141', 'New admission: Alyssa Mae Romero Velasco for grade Grade 1 level', 'admission.php', '2025-12-16 12:49:52'),
('b70ffd35-da7d-11f0-b537-696eec52d845', '143', 'New admission: Alyssa Mae Romero Velasco for grade Grade 1 level', 'admission.php', '2025-12-16 12:49:52'),
('b8d6b708-a5e6-11f0-b062-c97b0bc6c277', '3', 'Hannah Reyes time in at 10:37 PM for the subject Mathematics 1 - Moonstone.', 'attendance.php', '2025-10-10 22:38:00'),
('bd857438-0866-11f1-8195-20c372f05cfe', '102', 'Your parent (CJ) has successfully linked their account to you.', 'dashboard.php', '2026-02-12 23:01:18'),
('bf761c2c-d568-11f0-b062-c97b0bc6c277', '3', 'New Clinic Visit record added for student number 2025-13565 by Stephanie, Candado.', 'view_medical_detail.php?medical_id=MED-0027&student_id=2025-13565', '2025-12-10 09:37:11'),
('bfe9588c-daf7-11f0-b537-696eec52d845', '1', 'New admission: Danielle Rose Magsaysay Estrella for grade Grade 4 level', 'admission.php', '2025-12-17 03:23:26'),
('bfe96aef-daf7-11f0-b537-696eec52d845', '141', 'New admission: Danielle Rose Magsaysay Estrella for grade Grade 4 level', 'admission.php', '2025-12-17 03:23:26'),
('bfe97c5d-daf7-11f0-b537-696eec52d845', '143', 'New admission: Danielle Rose Magsaysay Estrella for grade Grade 4 level', 'admission.php', '2025-12-17 03:23:26'),
('c116d6f2-cd1d-11f0-b062-c97b0bc6c277', '46', 'Noah Ramos submitted an assignment \"Alphabet\" for \"English\"', 'view_assignment.php?course_id=37&id=38', '2025-11-29 12:20:12'),
('c33e692f-a54b-11f0-b062-c97b0bc6c277', '3', 'New disciplinary record added for student number 2025-19974', 'view_disciplinary_detail.php?disciplinary_id=DISC-8938&student_id=2025-19974', '2025-10-10 04:08:46'),
('c44cf711-a54a-11f0-b062-c97b0bc6c277', '3', 'New disciplinary record added for student number 2025-52404', 'view_student_disciplinary_detail.php?disciplinary_id=DISC-2288&student_id=2025-52404', '2025-10-10 04:01:38'),
('c4cb970b-a538-11f0-b062-c97b0bc6c277', '101', 'Roshane Mauricio posted a new lesson titled: Lesson 3: Addition within 10', 'view_post.php?post_id=72&course_id=35', '2025-10-10 01:52:48'),
('c4e35c05-a538-11f0-b062-c97b0bc6c277', '103', 'Roshane Mauricio posted a new lesson titled: Lesson 3: Addition within 10', 'view_post.php?post_id=72&course_id=35', '2025-10-10 01:52:48'),
('c4fad7af-a538-11f0-b062-c97b0bc6c277', '104', 'Roshane Mauricio posted a new lesson titled: Lesson 3: Addition within 10', 'view_post.php?post_id=72&course_id=35', '2025-10-10 01:52:48'),
('c5135d64-a538-11f0-b062-c97b0bc6c277', '102', 'Roshane Mauricio posted a new lesson titled: Lesson 3: Addition within 10', 'view_post.php?post_id=72&course_id=35', '2025-10-10 01:52:48'),
('c60a8cdf-a555-11f0-b062-c97b0bc6c277', '100', 'AcadeSys posted new public announcement: This is announcemnet for students', 'announcement.php', '2025-10-10 05:20:25'),
('c60a904c-a555-11f0-b062-c97b0bc6c277', '101', 'AcadeSys posted new public announcement: This is announcemnet for students', 'announcement.php', '2025-10-10 05:20:25'),
('c60a90bd-a555-11f0-b062-c97b0bc6c277', '102', 'AcadeSys posted new public announcement: This is announcemnet for students', 'announcement.php', '2025-10-10 05:20:25'),
('c60b3444-a555-11f0-b062-c97b0bc6c277', '103', 'AcadeSys posted new public announcement: This is announcemnet for students', 'announcement.php', '2025-10-10 05:20:25'),
('c60b352f-a555-11f0-b062-c97b0bc6c277', '104', 'AcadeSys posted new public announcement: This is announcemnet for students', 'announcement.php', '2025-10-10 05:20:25'),
('c69ce9a7-d428-11f0-b062-c97b0bc6c277', '1', 'New admission: test1 test1 test1 for grade Grade 11 level', 'admission.php', '2025-12-08 11:26:44'),
('c69d019b-d428-11f0-b062-c97b0bc6c277', '141', 'New admission: test1 test1 test1 for grade Grade 11 level', 'admission.php', '2025-12-08 11:26:44'),
('c69d1656-d428-11f0-b062-c97b0bc6c277', '143', 'New admission: test1 test1 test1 for grade Grade 11 level', 'admission.php', '2025-12-08 11:26:44'),
('c95318d2-a66d-11f0-b062-c97b0bc6c277', '3', 'Dave Bergania time in at 02:44 PM for the subject Mathematics 1 - Moonstone.', 'attendance.php', '2025-10-11 14:44:50'),
('c9b2afa6-da7f-11f0-b537-696eec52d845', '1', 'New admission: Michael Vincent Uy Ong for grade Grade 1 level', 'admission.php', '2025-12-16 13:04:42'),
('c9b2ec61-da7f-11f0-b537-696eec52d845', '141', 'New admission: Michael Vincent Uy Ong for grade Grade 1 level', 'admission.php', '2025-12-16 13:04:42'),
('c9b319bb-da7f-11f0-b537-696eec52d845', '143', 'New admission: Michael Vincent Uy Ong for grade Grade 1 level', 'admission.php', '2025-12-16 13:04:42'),
('c9c9831c-cd1d-11f0-b062-c97b0bc6c277', '46', 'Noah Ramos submitted an assignment \"Alphabet\" for \"English\"', 'view_assignment.php?course_id=37&id=38', '2025-11-29 12:20:27'),
('cb0a9f3b-cf4f-11f0-b062-c97b0bc6c277', '149', 'New health record added for student number 2025-83331', 'view_medical_detail.php?medical_id=MED-0016&student_id=2025-83331', '2025-12-02 15:23:26'),
('cd4c5883-daf6-11f0-b537-696eec52d845', '1', 'New admission: Elijah Nathan Reyes Aquino for grade Grade 4 level', 'admission.php', '2025-12-17 03:16:38'),
('cd4c6769-daf6-11f0-b537-696eec52d845', '141', 'New admission: Elijah Nathan Reyes Aquino for grade Grade 4 level', 'admission.php', '2025-12-17 03:16:38'),
('cd4c74a9-daf6-11f0-b537-696eec52d845', '143', 'New admission: Elijah Nathan Reyes Aquino for grade Grade 4 level', 'admission.php', '2025-12-17 03:16:38'),
('cd7d4843-a43f-11f0-b062-c97b0bc6c277', '40', 'Mary Espinosa submitted an assignment', 'view_assignment.php?course_id=20&id=24', '2025-10-08 12:10:38'),
('cd88ebae-a433-11f0-b062-c97b0bc6c277', '35', 'Stephany Gandula posted a new lesson', 'view_post.php?post_id=64', '2025-10-08 18:44:42'),
('cdaad630-a690-11f0-b062-c97b0bc6c277', '39', 'Dave Bergania submitted an assignment \"pangungusap\" for \"Filipino 1 - Moonstone\"', 'view_assignment.php?course_id=32&id=34', '2025-10-11 10:55:30'),
('cdb9e7d6-a433-11f0-b062-c97b0bc6c277', '37', 'Stephany Gandula posted a new lesson', 'view_post.php?post_id=64', '2025-10-08 18:44:42'),
('cdf6d6d3-a433-11f0-b062-c97b0bc6c277', '52', 'Stephany Gandula posted a new lesson', 'view_post.php?post_id=64', '2025-10-08 18:44:42'),
('ce479311-a433-11f0-b062-c97b0bc6c277', '55', 'Stephany Gandula posted a new lesson', 'view_post.php?post_id=64', '2025-10-08 18:44:42'),
('ce73678a-a433-11f0-b062-c97b0bc6c277', '10', 'Stephany Gandula posted a new lesson', 'view_post.php?post_id=64', '2025-10-08 18:44:42'),
('ce80b868-a53e-11f0-b062-c97b0bc6c277', '39', 'Hannah Reyes submitted an assignment \"Assessment 1: Counting Numbers\" for \"Mathematics 1 - Moonstone\"', 'view_assignment.php?course_id=35&id=33', '2025-10-09 18:36:01'),
('ceb39ef7-a433-11f0-b062-c97b0bc6c277', '92', 'Stephany Gandula posted a new lesson', 'view_post.php?post_id=64', '2025-10-08 18:44:42'),
('cee1c861-a433-11f0-b062-c97b0bc6c277', '99', 'Stephany Gandula posted a new lesson', 'view_post.php?post_id=64', '2025-10-08 18:44:42'),
('cfeae78d-a54d-11f0-b062-c97b0bc6c277', '3', 'New disciplinary record added for student number 2025-52404', 'view_disciplinary_detail.php?disciplinary_id=DISC-8990&student_id=2025-52404', '2025-10-10 04:23:26'),
('d091386c-ce74-11f0-b062-c97b0bc6c277', '1', 'New admission: Ken123 Generoso123 Hernal13 for grade Nursery level', 'admission.php', '2025-12-01 05:15:55'),
('d0914dce-ce74-11f0-b062-c97b0bc6c277', '138', 'New admission: Ken123 Generoso123 Hernal13 for grade Nursery level', 'admission.php', '2025-12-01 05:15:55'),
('d09161a4-ce74-11f0-b062-c97b0bc6c277', '141', 'New admission: Ken123 Generoso123 Hernal13 for grade Nursery level', 'admission.php', '2025-12-01 05:15:55'),
('d0917012-ce74-11f0-b062-c97b0bc6c277', '143', 'New admission: Ken123 Generoso123 Hernal13 for grade Nursery level', 'admission.php', '2025-12-01 05:15:55'),
('d15c50c0-a688-11f0-b062-c97b0bc6c277', '3', 'Kyle Ramos time in at 05:58 PM for the subject Mathematics 1 - Moonstone.', 'attendance.php', '2025-10-11 17:58:20'),
('d168a2d9-dae0-11f0-b537-696eec52d845', '1', 'New admission: Nicole Andrea Perez Manalo for grade Grade 3 level', 'admission.php', '2025-12-17 00:39:16'),
('d168b31a-dae0-11f0-b537-696eec52d845', '141', 'New admission: Nicole Andrea Perez Manalo for grade Grade 3 level', 'admission.php', '2025-12-17 00:39:16'),
('d168bff0-dae0-11f0-b537-696eec52d845', '143', 'New admission: Nicole Andrea Perez Manalo for grade Grade 3 level', 'admission.php', '2025-12-17 00:39:16'),
('d3386355-a555-11f0-b062-c97b0bc6c277', '3', 'AcadeSys posted new public announcement: test for parents', 'announcement.php', '2025-10-10 05:20:47'),
('d3386733-a555-11f0-b062-c97b0bc6c277', '88', 'AcadeSys posted new public announcement: test for parents', 'announcement.php', '2025-10-10 05:20:47'),
('d368e867-a75a-11f0-b062-c97b0bc6c277', '3', 'Account number : 95897288 pay this amount for their tuition.', 'view_invoice.php?invoice_id=4024247&tuition_id=46', '2025-10-12 19:01:38');
INSERT INTO `notifications` (`id`, `user_id`, `message`, `link`, `created_at`) VALUES
('d4a52dba-a456-11f0-b062-c97b0bc6c277', '59', 'Stephany Gandula graded your assignment', 'view_assignment.php?status=1&id=24', '2025-10-08 22:55:26'),
('d53d7837-dafa-11f0-b537-696eec52d845', '1', 'New admission: Julia Anne Santos Mercado for grade Grade 5 level', 'admission.php', '2025-12-17 03:45:30'),
('d53d889e-dafa-11f0-b537-696eec52d845', '141', 'New admission: Julia Anne Santos Mercado for grade Grade 5 level', 'admission.php', '2025-12-17 03:45:30'),
('d53e1082-dafa-11f0-b537-696eec52d845', '143', 'New admission: Julia Anne Santos Mercado for grade Grade 5 level', 'admission.php', '2025-12-17 03:45:30'),
('d54db6af-a538-11f0-b062-c97b0bc6c277', '101', 'Roshane Mauricio posted a new lesson titled: Lesson 4: Subtraction within 10', 'view_post.php?post_id=73&course_id=35', '2025-10-10 01:53:16'),
('d5616b8a-a538-11f0-b062-c97b0bc6c277', '103', 'Roshane Mauricio posted a new lesson titled: Lesson 4: Subtraction within 10', 'view_post.php?post_id=73&course_id=35', '2025-10-10 01:53:16'),
('d5747b78-a538-11f0-b062-c97b0bc6c277', '104', 'Roshane Mauricio posted a new lesson titled: Lesson 4: Subtraction within 10', 'view_post.php?post_id=73&course_id=35', '2025-10-10 01:53:16'),
('d5884e79-a538-11f0-b062-c97b0bc6c277', '102', 'Roshane Mauricio posted a new lesson titled: Lesson 4: Subtraction within 10', 'view_post.php?post_id=73&course_id=35', '2025-10-10 01:53:16'),
('d5f80326-a54c-11f0-b062-c97b0bc6c277', '3', 'New health record added for student number 2025-52404', 'view_medical_detail.php?medical_id=MED-0011&student_id=2025-52404', '2025-10-10 04:16:27'),
('d7bceb3e-a688-11f0-b062-c97b0bc6c277', '3', 'Dave Bergania time in at 05:58 PM for the subject Mathematics 1 - Moonstone.', 'attendance.php', '2025-10-11 17:58:31'),
('d9a6b13e-a450-11f0-b062-c97b0bc6c277', '40', 'Mary Espinosa submitted an assignment \"Parts of a Plant\" for \"Science 1\"', 'view_assignment.php?course_id=20&id=24', '2025-10-08 14:12:40'),
('db95774d-dafd-11f0-b537-696eec52d845', '1', 'New admission: Kyla Mae Villarin Del Rosario for grade Grade 6 level', 'admission.php', '2025-12-17 04:07:09'),
('db958ab4-dafd-11f0-b537-696eec52d845', '141', 'New admission: Kyla Mae Villarin Del Rosario for grade Grade 6 level', 'admission.php', '2025-12-17 04:07:09'),
('db959df8-dafd-11f0-b537-696eec52d845', '143', 'New admission: Kyla Mae Villarin Del Rosario for grade Grade 6 level', 'admission.php', '2025-12-17 04:07:09'),
('dc106557-a670-11f0-b062-c97b0bc6c277', '3', 'Noah Ramos time in at 03:06 PM for the subject Mathematics 1 - Moonstone.', 'attendance.php', '2025-10-11 15:06:50'),
('dc7cacaf-f902-11f0-95c8-a29b24e0f83a', '1', 'New admission: tesst tesst tesst for grade Grade 1 level', 'admission.php', '2026-01-24 08:58:33'),
('dc7cc4d1-f902-11f0-95c8-a29b24e0f83a', '141', 'New admission: tesst tesst tesst for grade Grade 1 level', 'admission.php', '2026-01-24 08:58:33'),
('dc7cda51-f902-11f0-95c8-a29b24e0f83a', '143', 'New admission: tesst tesst tesst for grade Grade 1 level', 'admission.php', '2026-01-24 08:58:33'),
('dff50157-da54-11f0-b537-696eec52d845', '1', 'New admission: Brian Macaraeg Dulay for grade Nursery level', 'admission.php', '2025-12-16 07:57:31'),
('e00b6541-d569-11f0-b062-c97b0bc6c277', '1', 'New admission: Davanee  De Ocampo for grade Nursery level', 'admission.php', '2025-12-10 01:45:15'),
('e00b7ea7-d569-11f0-b062-c97b0bc6c277', '141', 'New admission: Davanee  De Ocampo for grade Nursery level', 'admission.php', '2025-12-10 01:45:15'),
('e00b9617-d569-11f0-b062-c97b0bc6c277', '143', 'New admission: Davanee  De Ocampo for grade Nursery level', 'admission.php', '2025-12-10 01:45:15'),
('e030142e-da54-11f0-b537-696eec52d845', '141', 'New admission: Brian Macaraeg Dulay for grade Nursery level', 'admission.php', '2025-12-16 07:57:32'),
('e069f489-da54-11f0-b537-696eec52d845', '143', 'New admission: Brian Macaraeg Dulay for grade Nursery level', 'admission.php', '2025-12-16 07:57:32'),
('e09c1669-db6e-11f0-b537-696eec52d845', '1', 'New admission: Mang Kanor Macaraeg Ricardo for grade Grade 2 level', 'admission.php', '2025-12-17 17:36:10'),
('e0b59548-db6e-11f0-b537-696eec52d845', '141', 'New admission: Mang Kanor Macaraeg Ricardo for grade Grade 2 level', 'admission.php', '2025-12-17 17:36:11'),
('e0cf8415-db6e-11f0-b537-696eec52d845', '143', 'New admission: Mang Kanor Macaraeg Ricardo for grade Grade 2 level', 'admission.php', '2025-12-17 17:36:11'),
('e1a72885-fcab-11f0-95c8-a29b24e0f83a', '1', 'New admission: nick escalora azcueta for grade Nursery level', 'admission.php', '2026-01-29 00:46:00'),
('e1a747b6-fcab-11f0-95c8-a29b24e0f83a', '141', 'New admission: nick escalora azcueta for grade Nursery level', 'admission.php', '2026-01-29 00:46:00'),
('e1a760dd-fcab-11f0-95c8-a29b24e0f83a', '143', 'New admission: nick escalora azcueta for grade Nursery level', 'admission.php', '2026-01-29 00:46:00'),
('e1a850d0-fcb3-11f0-95c8-a29b24e0f83a', '168', 'Stephany Gandula posted a new assignment in Filipino 1: cap2', 'view_assignment.php?id=40&course_id=42', '2026-01-29 09:43:16'),
('e1a86911-fcb3-11f0-95c8-a29b24e0f83a', '265', 'Stephany Gandula posted a new assignment in Filipino 1: cap2', 'view_assignment.php?id=40&course_id=42', '2026-01-29 09:43:16'),
('e22418ac-a456-11f0-b062-c97b0bc6c277', '10', 'Stephany Gandula graded your assignment', 'view_assignment.php?status=1&id=24', '2025-10-08 22:55:49'),
('e25017d4-b2e6-11f0-b062-c97b0bc6c277', '1', 'Student admission', 'admission_old.php', '2025-10-27 03:41:55'),
('e2741f2d-b2e6-11f0-b062-c97b0bc6c277', '138', 'Student admission', 'admission_old.php', '2025-10-27 03:41:55'),
('e4fdd17c-b2e9-11f0-b062-c97b0bc6c277', '1', 'New admission: Fyke test Lleva for grade Grade 3 level)', 'admission.php', '2025-10-27 04:03:28'),
('e5455900-fc7a-11f0-95c8-a29b24e0f83a', '3', 'Aaron Joseph Ramos time in at 02:55 AM for the subject eng 10.', 'attendance.php', '2026-01-29 02:55:20'),
('e55dbd2c-b2e9-11f0-b062-c97b0bc6c277', '138', 'New admission: Fyke test Lleva for grade Grade 3 level)', 'admission.php', '2025-10-27 04:03:29'),
('e56bdd74-da7a-11f0-b537-696eec52d845', '1', 'New admission: Daniel Joseph Navarro Bautista for grade Kinder level', 'admission.php', '2025-12-16 12:29:41'),
('e56bf508-da7a-11f0-b537-696eec52d845', '141', 'New admission: Daniel Joseph Navarro Bautista for grade Kinder level', 'admission.php', '2025-12-16 12:29:41'),
('e56c038a-da7a-11f0-b537-696eec52d845', '143', 'New admission: Daniel Joseph Navarro Bautista for grade Kinder level', 'admission.php', '2025-12-16 12:29:41'),
('e5ea5609-dafc-11f0-b537-696eec52d845', '1', 'New admission: Marian Louise Dizon Ponce for grade Grade 5 level', 'admission.php', '2025-12-17 04:00:17'),
('e5ea6c16-dafc-11f0-b537-696eec52d845', '141', 'New admission: Marian Louise Dizon Ponce for grade Grade 5 level', 'admission.php', '2025-12-17 04:00:17'),
('e5ea7f78-dafc-11f0-b537-696eec52d845', '143', 'New admission: Marian Louise Dizon Ponce for grade Grade 5 level', 'admission.php', '2025-12-17 04:00:17'),
('e8683a62-ffd6-11f0-95c8-a29b24e0f83a', '267', 'Stephany Gandula graded your assignment: test', 'view_assignment.php?id=41&course_id=42', '2026-02-02 09:31:33'),
('e8da5c87-a538-11f0-b062-c97b0bc6c277', '101', 'Roshane Mauricio posted a new lesson titled: Lesson 5: Identifying Shapes', 'view_post.php?post_id=74&course_id=35', '2025-10-10 01:53:48'),
('e8f38241-a538-11f0-b062-c97b0bc6c277', '103', 'Roshane Mauricio posted a new lesson titled: Lesson 5: Identifying Shapes', 'view_post.php?post_id=74&course_id=35', '2025-10-10 01:53:48'),
('e90e39ce-a538-11f0-b062-c97b0bc6c277', '104', 'Roshane Mauricio posted a new lesson titled: Lesson 5: Identifying Shapes', 'view_post.php?post_id=74&course_id=35', '2025-10-10 01:53:48'),
('e92cbd77-a538-11f0-b062-c97b0bc6c277', '102', 'Roshane Mauricio posted a new lesson titled: Lesson 5: Identifying Shapes', 'view_post.php?post_id=74&course_id=35', '2025-10-10 01:53:48'),
('eb4a031c-ffdc-11f0-95c8-a29b24e0f83a', '268', 'New disciplinary record added for student number 2026-33670', 'view_disciplinary_detail.php?disciplinary_id=DISC-5417&student_id=2026-33670', '2026-02-02 10:14:35'),
('eea66a5a-a555-11f0-b062-c97b0bc6c277', '38', 'AcadeSys posted new public announcement: test', 'announcement.php', '2025-10-10 05:21:34'),
('eea66eb6-a555-11f0-b062-c97b0bc6c277', '39', 'AcadeSys posted new public announcement: test', 'announcement.php', '2025-10-10 05:21:34'),
('eea6702b-a555-11f0-b062-c97b0bc6c277', '40', 'AcadeSys posted new public announcement: test', 'announcement.php', '2025-10-10 05:21:34'),
('eea67085-a555-11f0-b062-c97b0bc6c277', '41', 'AcadeSys posted new public announcement: test', 'announcement.php', '2025-10-10 05:21:34'),
('eea670d1-a555-11f0-b062-c97b0bc6c277', '42', 'AcadeSys posted new public announcement: test', 'announcement.php', '2025-10-10 05:21:34'),
('eea67128-a555-11f0-b062-c97b0bc6c277', '43', 'AcadeSys posted new public announcement: test', 'announcement.php', '2025-10-10 05:21:34'),
('eea67175-a555-11f0-b062-c97b0bc6c277', '44', 'AcadeSys posted new public announcement: test', 'announcement.php', '2025-10-10 05:21:34'),
('eea671c4-a555-11f0-b062-c97b0bc6c277', '45', 'AcadeSys posted new public announcement: test', 'announcement.php', '2025-10-10 05:21:34'),
('eea67218-a555-11f0-b062-c97b0bc6c277', '46', 'AcadeSys posted new public announcement: test', 'announcement.php', '2025-10-10 05:21:34'),
('eea6726b-a555-11f0-b062-c97b0bc6c277', '47', 'AcadeSys posted new public announcement: test', 'announcement.php', '2025-10-10 05:21:34'),
('eea672b7-a555-11f0-b062-c97b0bc6c277', '48', 'AcadeSys posted new public announcement: test', 'announcement.php', '2025-10-10 05:21:34'),
('eea67331-a555-11f0-b062-c97b0bc6c277', '49', 'AcadeSys posted new public announcement: test', 'announcement.php', '2025-10-10 05:21:34'),
('eea67384-a555-11f0-b062-c97b0bc6c277', '50', 'AcadeSys posted new public announcement: test', 'announcement.php', '2025-10-10 05:21:34'),
('eea673dd-a555-11f0-b062-c97b0bc6c277', '51', 'AcadeSys posted new public announcement: test', 'announcement.php', '2025-10-10 05:21:34'),
('ef221ed4-cb44-11f0-b062-c97b0bc6c277', '102', 'Leoncia Ala posted a new lesson titled: test', 'view_post.php?post_id=79&course_id=37', '2025-11-27 11:55:37'),
('f2f43302-a5e9-11f0-b062-c97b0bc6c277', '3', 'New health record added for student number 2025-83698', 'view_medical_detail.php?medical_id=MED-0013&student_id=2025-83698', '2025-10-10 23:01:06'),
('f3a75bec-a456-11f0-b062-c97b0bc6c277', '10', 'Stephany Gandula graded your assignment: Parts of a Plant', 'view_assignment.php?status=1&id=24', '2025-10-08 22:56:18'),
('f602c296-a54d-11f0-b062-c97b0bc6c277', '3', 'New disciplinary record added for student number 2025-52404', 'view_disciplinary_detail.php?disciplinary_id=DISC-3663&student_id=2025-52404', '2025-10-10 04:24:30'),
('f63196d8-0a36-11f1-8195-20c372f05cfe', '1', 'New admission: Enrico Joseph Drei Tante Acuña for grade Grade 1 level', 'admission.php', '2026-02-15 06:24:20'),
('f631b936-0a36-11f1-8195-20c372f05cfe', '141', 'New admission: Enrico Joseph Drei Tante Acuña for grade Grade 1 level', 'admission.php', '2026-02-15 06:24:20'),
('f631cc47-0a36-11f1-8195-20c372f05cfe', '143', 'New admission: Enrico Joseph Drei Tante Acuña for grade Grade 1 level', 'admission.php', '2026-02-15 06:24:20'),
('f7fdf55f-a458-11f0-b062-c97b0bc6c277', '35', 'Stephany Gandula posted a new assignment in Physical Education 1: Assignment Title: Personal Fitness Log', 'view_assignment.php?id=32&course_id=25', '2025-10-08 23:10:45'),
('f85b8526-a458-11f0-b062-c97b0bc6c277', '37', 'Stephany Gandula posted a new assignment in Physical Education 1: Assignment Title: Personal Fitness Log', 'view_assignment.php?id=32&course_id=25', '2025-10-08 23:10:45'),
('f8b82019-a458-11f0-b062-c97b0bc6c277', '52', 'Stephany Gandula posted a new assignment in Physical Education 1: Assignment Title: Personal Fitness Log', 'view_assignment.php?id=32&course_id=25', '2025-10-08 23:10:45'),
('f8f87342-a458-11f0-b062-c97b0bc6c277', '55', 'Stephany Gandula posted a new assignment in Physical Education 1: Assignment Title: Personal Fitness Log', 'view_assignment.php?id=32&course_id=25', '2025-10-08 23:10:45'),
('f9565a5d-a458-11f0-b062-c97b0bc6c277', '10', 'Stephany Gandula posted a new assignment in Physical Education 1: Assignment Title: Personal Fitness Log', 'view_assignment.php?id=32&course_id=25', '2025-10-08 23:10:45'),
('f9890d87-a455-11f0-b062-c97b0bc6c277', '10', 'Stephany Gandula graded your assignment', 'view_assignment.php?status=1&id=24', '2025-10-08 22:49:19'),
('f9b37594-a458-11f0-b062-c97b0bc6c277', '92', 'Stephany Gandula posted a new assignment in Physical Education 1: Assignment Title: Personal Fitness Log', 'view_assignment.php?id=32&course_id=25', '2025-10-08 23:10:45'),
('fa1249bb-a458-11f0-b062-c97b0bc6c277', '99', 'Stephany Gandula posted a new assignment in Physical Education 1: Assignment Title: Personal Fitness Log', 'view_assignment.php?id=32&course_id=25', '2025-10-08 23:10:45'),
('fb45ac30-a54b-11f0-b062-c97b0bc6c277', '3', 'New disciplinary record added for student number 2025-19974', 'view_disciplinary_detail.php?disciplinary_id=DISC-0295&student_id=2025-19974', '2025-10-10 04:10:20'),
('fdf3af58-d179-11f0-b062-c97b0bc6c277', '1', 'New admission: Adelaide Ramos Warren for grade Grade 9 level', 'admission.php', '2025-12-05 01:30:33'),
('fdf3c421-d179-11f0-b062-c97b0bc6c277', '141', 'New admission: Adelaide Ramos Warren for grade Grade 9 level', 'admission.php', '2025-12-05 01:30:33'),
('fdf3d464-d179-11f0-b062-c97b0bc6c277', '143', 'New admission: Adelaide Ramos Warren for grade Grade 9 level', 'admission.php', '2025-12-05 01:30:33'),
('fe70ce10-a54a-11f0-b062-c97b0bc6c277', '3', 'New disciplinary record added for student number 2025-52404', 'view_disciplinary_detail.php?disciplinary_id=DISC-1294&student_id=2025-52404', '2025-10-10 04:03:16'),
('ff980ce3-a5ee-11f0-b062-c97b0bc6c277', '3', 'Swagger Arnodl time in at 11:37 PM for the subject Mathematics 1 - Moonstone.', 'attendance.php', '2025-10-10 23:37:15');

-- --------------------------------------------------------

--
-- Table structure for table `parent_attendance`
--

CREATE TABLE `parent_attendance` (
  `id` int(11) NOT NULL,
  `date` date NOT NULL,
  `time_in` time NOT NULL,
  `course_name` varchar(255) NOT NULL,
  `rfid` varchar(100) NOT NULL,
  `user_id` int(11) NOT NULL,
  `first_name` varchar(100) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `parent_id` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `parent_attendance`
--

INSERT INTO `parent_attendance` (`id`, `date`, `time_in`, `course_name`, `rfid`, `user_id`, `first_name`, `last_name`, `parent_id`) VALUES
(8, '2025-10-10', '02:04:11', 'Mathematics 1 - Moonstone', '17218722', 102, 'Noah', 'Ramos', 0),
(13, '2025-10-11', '14:49:05', 'Mathematics 1 - Moonstone', '17218722', 102, 'Noah', 'Ramos', 3),
(23, '2025-10-22', '15:32:58', 'English', '0067082781', 102, 'Noah', 'Ramos', 3),
(24, '2025-11-20', '19:55:43', 'Filipino 1 - Moonstone', '1603483088', 102, 'Noah', 'Ramos', 0),
(25, '2025-11-20', '19:58:09', 'Filipino 1 - Moonstone', '1603483088', 102, 'Noah', 'Ramos', 0),
(26, '2025-11-20', '20:11:59', 'Filipino 1 - Moonstone', '1603483088', 102, 'Noah', 'Ramos', 0),
(27, '2025-11-20', '20:56:08', 'Filipino 1 - Moonstone', '1603483088', 102, 'Noah', 'Ramos', 0),
(28, '2025-11-20', '20:58:42', 'Filipino 1 - Moonstone', '1603483088', 102, 'Noah', 'Ramos', 0),
(29, '2025-11-20', '21:01:22', 'Filipino 1 - Moonstone', '1603483088', 102, 'Noah', 'Ramos', 0),
(30, '2025-11-27', '10:27:26', 'English', '1603483088', 102, 'Noah', 'Ramos', 0),
(33, '2025-12-17', '05:27:59', 'Mathermatics', '1603483088', 102, 'Noah', 'Ramos', 0),
(34, '2025-12-17', '05:30:55', 'Mathermatics', '1603483088', 102, 'Noah', 'Ramos', 0),
(35, '2025-12-17', '05:34:34', 'Mathermatics', '1603483088', 102, 'Noah', 'Ramos', 0),
(36, '2025-12-17', '05:36:39', 'Mathermatics', '1603483088', 102, 'Noah', 'Ramos', 3),
(37, '2025-12-17', '05:39:21', 'Mathermatics', '1603483088', 102, 'Noah', 'Ramos', 3),
(38, '2025-12-17', '05:43:55', 'Makabansa 1 - Moonstone', '1603483088', 102, 'Noah', 'Ramos', 3),
(39, '2025-12-17', '15:03:29', 'Science 1 - Moonstone', '1603483088', 102, 'Noah', 'Ramos', 3),
(40, '2025-12-17', '15:08:20', 'Science 1 - Moonstone', '1603483088', 102, 'Noah', 'Ramos', 3),
(41, '2025-12-17', '15:10:39', 'Science 1 - Moonstone', '1603483088', 102, 'Noah', 'Ramos', 3),
(42, '2025-12-17', '15:14:31', 'Science 1 - Moonstone', '1603483088', 102, 'Noah', 'Ramos', 3),
(43, '2026-01-28', '21:00:44', 'eng 10', '33332', 182, 'Aaron Joseph', 'Ramos', 3),
(44, '2026-01-29', '02:55:20', 'eng 10', '33332', 182, 'Aaron Joseph', 'Ramos', 3),
(45, '2026-01-29', '09:40:58', 'Filipino 1', '1189156229', 265, 'nick', 'azcueta', 3),
(46, '2026-02-02', '09:34:40', 'Music 1', '1190247381', 267, 'Andrew Paul', 'Wilson', 268),
(47, '2026-02-16', '03:47:55', 'P.E 1', '88889', 238, 'Camille Joy', 'Alcantara', 0),
(48, '2026-02-16', '03:48:25', 'P.E 1', '44449', 198, 'Rhea Camille', 'Navarro', 0),
(49, '2026-02-16', '03:49:26', 'P.E 1', '1603483088', 102, 'Noah', 'Ramos', 3),
(50, '2026-02-16', '03:55:25', 'P.E 1', '123456', 263, 'CJ', 'Escalora', 0),
(51, '2026-02-16', '04:11:26', 'P.E 1', '10004', 254, 'Bryan Keith', 'Enriquez', 0),
(52, '2026-02-16', '04:11:37', 'P.E 1', '77771', 220, 'Bianca Louise', 'De Leon', 0),
(53, '2026-02-16', '04:17:00', 'P.E 1', '88882', 232, 'Adrian Lee', 'Chua', 0),
(54, '2026-02-16', '04:17:10', 'P.E 1', '12411', 179, 'Bryan Paul', 'Enriquez', 0),
(55, '2026-02-16', '04:17:23', 'P.E 1', '22222', 160, 'Adrian Paul', 'Evangelista', 0),
(56, '2026-02-16', '04:25:17', 'P.E 1', '88889', 238, 'Camille Joy', 'Alcantara', 0),
(57, '2026-02-16', '04:25:27', 'P.E 1', '88882', 232, 'Adrian Lee', 'Chua', 0),
(58, '2026-02-16', '04:25:37', 'P.E 1', '77771', 220, 'Bianca Louise', 'De Leon', 0),
(59, '2026-02-16', '04:25:46', 'P.E 1', '10004', 254, 'Bryan Keith', 'Enriquez', 0),
(60, '2026-02-16', '04:25:54', 'P.E 1', '12411', 179, 'Bryan Paul', 'Enriquez', 0),
(61, '2026-02-16', '04:27:46', 'P.E 1', '88889', 238, 'Camille Joy', 'Alcantara', 0),
(62, '2026-02-16', '04:28:03', 'P.E 1', '88882', 232, 'Adrian Lee', 'Chua', 0),
(63, '2026-02-16', '04:28:14', 'P.E 1', '77771', 220, 'Bianca Louise', 'De Leon', 0),
(64, '2026-02-16', '04:28:23', 'P.E 1', '10004', 254, 'Bryan Keith', 'Enriquez', 0),
(65, '2026-02-16', '04:28:34', 'P.E 1', '12411', 179, 'Bryan Paul', 'Enriquez', 0);

-- --------------------------------------------------------

--
-- Table structure for table `parent_link`
--

CREATE TABLE `parent_link` (
  `id` int(11) NOT NULL,
  `parent_id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `parent_link`
--

INSERT INTO `parent_link` (`id`, `parent_id`, `student_id`) VALUES
(20, 3, 155),
(22, 3, 182),
(24, 268, 267),
(28, 3, 102);

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
(59, 1000, 'Cash', 38, '2025-09-16 02:40:19', 1836395, 5377908823, 0.00),
(60, 2000, 'Cash', 43, '2025-10-10 10:44:16', 4754191, 3718187061, 0.00),
(61, 2000, 'Cash', 43, '2025-10-10 11:30:30', 4563571, 7757190777, 0.00),
(62, 2000, 'Cash', 43, '2025-10-10 11:34:06', 4599178, 6020003286, 0.00),
(63, 1000, 'Cash', 43, '2025-10-10 19:38:10', 6610252, 8149094355, 0.00),
(64, 12500, 'Cash', 44, '2025-10-10 22:57:46', 8549660, 3900323234, 0.00),
(65, 2000, 'Cash', 46, '2025-10-11 17:54:59', 3666607, 4531241698, 0.00),
(66, 3000, 'Cash', 46, '2025-10-12 19:01:38', 4024247, 7850835928, 0.00),
(67, 19752.75, 'Cash', 46, '2025-10-12 19:56:07', 2035338, 7561490126, 0.00),
(68, 10000, 'Cash', 54, '2025-11-30 21:57:31', 8105792, 9846907032, 0.00),
(69, 1500, 'Cash', 55, '2025-12-01 14:18:36', 4647700, 1474376742, 0.00),
(70, 10000, 'GCash', 56, '2025-12-02 15:27:32', 1095078, 578645567, 15.00),
(71, 30000, 'Cash', 57, '2025-12-03 01:51:43', 1657263, 1484329997, 0.00),
(72, 7000, 'Cash', 57, '2025-12-03 01:51:58', 8962706, 6938042059, 0.00),
(73, 700, 'Cash', 57, '2025-12-03 01:52:33', 3012669, 3543175075, 0.00),
(74, 1000, 'Cash', 73, '2025-12-21 10:58:41', 6007422, 6847743974, 0.00),
(75, 5000, 'Cash', 109, '2026-01-24 17:15:29', 6863477, 1403908416, 0.00),
(76, 38000, 'Cash', 86, '2026-01-29 05:23:11', 2128667, 7255041178, 0.00),
(77, 20000, 'Cash', 187, '2026-01-29 10:00:56', 3827905, 5455616820, 0.00),
(78, 10000, 'Cash', 187, '2026-01-29 10:02:20', 9531807, 5222957339, 0.00),
(79, 1000, 'Cash', 63, '2026-02-07 02:28:59', 7392884, 4794903400, 0.00),
(80, 2500, 'GCash', 101, '2026-02-07 11:01:58', 7714499, 1234567897998, 15.00),
(81, 10334, 'Cash', 198, '2026-02-14 04:11:04', 1329025, 8055583465, 0.00);

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
(47, 20, 40, 'Lesson 3: States of Matter', '<h1>Lesson 3: States of Matter</h1><p>&nbsp;</p><p><strong>Overview:</strong><br>Discover the 3 main states of matter: solid, liquid, and gas — and how they change with temperature.</p><p><strong>Objectives:</strong></p><ul><li>Define each state of matter</li><li>Describe melting, freezing, condensation, and evaporation</li></ul>', NULL, '[\"file_68c8526644613.png\"]', '2025-09-15 17:52:38'),
(49, 26, 40, 'sa', '<p>twe</p>', NULL, '[\"file_68cafd4608348.pdf\"]', '2025-09-17 18:26:14'),
(50, 26, 40, 'asas', '<p>asas</p>', NULL, '[\"file_68caff681946d.pptx\"]', '2025-09-17 18:35:20'),
(51, 28, 41, 'chucky favorite word', '<p>chucky smashing</p>', 'https://www.youtube.com/watch?v=nXUQxgQHX8E', '[\"file_68d51fe40c475.jpg\"]', '2025-09-25 10:56:36'),
(53, 17, 40, 'asasas', '<p>saasassas</p>', NULL, NULL, '2025-10-06 17:29:55'),
(64, 25, 40, 'Building Strength and Endurance: The Power of Physical Activity', '<p><strong>Description:</strong><br>In today\'s Physical Education lesson, we focus on improving our overall fitness through a combination of strength, flexibility, and cardiovascular exercises. Students will participate in warm-up routines, learn proper techniques for basic exercises, and engage in fun, interactive activities that promote teamwork and healthy competition. The goal is to enhance physical health, build endurance, and develop lifelong habits for an active lifestyle.</p><p>If you want, I can also make <strong>3-5 alternative versions</strong> you can post throughout the week for PE lessons. Do you want me to do that?</p>', NULL, NULL, '2025-10-08 10:44:37'),
(65, 25, 40, 'Flexibility and Mobility: Stretching for a Healthier Body', '<p><strong>Description:</strong><br>Today’s Physical Education lesson focuses on improving flexibility and joint mobility. Students will practice dynamic and static stretching exercises, learn proper techniques to prevent injuries, and understand the importance of warming up and cooling down. This lesson helps enhance overall body movement, improves posture, and prepares the body for more intense physical activities. Remember: consistent stretching leads to better performance and reduces the risk of strains!</p>', NULL, NULL, '2025-10-08 10:49:00'),
(70, 35, 39, 'Lesson 1: Counting Numbers 1–20', '<h3><strong>Lesson 1: Counting Numbers 1–20</strong></h3><p><strong>Objective:</strong><br>Students will be able to count numbers from 1 to 20 and match quantities with their corresponding numerals.</p><p><strong>Overview:</strong><br>This lesson introduces students to basic counting using everyday objects. They learn to say numbers in order and recognize their written forms.</p><p><strong>Materials:</strong><br>Counting blocks, pictures of fruits or toys, number cards (1–20)</p><p><strong>Activities:</strong></p><ol><li><strong>Warm-up:</strong> Sing a counting song (“One, Two, Buckle My Shoe”).</li><li><strong>Discussion:</strong> Show objects and count them together aloud.</li><li><strong>Practice:</strong> Give students groups of objects to count and match with number cards.</li><li><strong>Writing Exercise:</strong> Write numbers 1–20 on paper.</li></ol><p><strong>Values Integration:</strong><br>Patience and focus while counting carefully.</p>', NULL, NULL, '2025-10-09 17:49:31'),
(71, 35, 39, 'Lesson 2: Comparing Numbers', '<h3><strong>Lesson 2: Comparing Numbers</strong></h3><p><strong>Objective:</strong><br>Students will be able to compare numbers and identify which is greater, less, or equal.</p><p><strong>Overview:</strong><br>Learners understand the concept of “more,” “less,” and “equal” using visual examples.</p><p><strong>Materials:</strong><br>Picture cards of fruits, number flashcards, “&gt;” “&lt;” “=” symbols</p><p><strong>Activities:</strong></p><ol><li>Show 3 apples and 5 bananas—ask which group has more.</li><li>Introduce comparison signs using simple gestures (e.g., “&gt;” looks like a hungry mouth).</li><li>Have students compare pairs of numbers (4 and 7, 9 and 2).</li></ol><p><strong>Assessment:</strong><br>Worksheet: Fill in the correct sign (&gt;, &lt;, =) between two numbers.</p><p><strong>Values Integration:</strong><br>Fairness — understanding equality.</p>', NULL, NULL, '2025-10-09 17:52:12'),
(72, 35, 39, 'Lesson 3: Addition within 10', '<h3><strong>Lesson 3: Addition within 10</strong></h3><p><strong>Objective:</strong><br>Students will be able to add numbers with sums up to 10.</p><p><strong>Overview:</strong><br>Addition is introduced as combining groups together.</p><p><strong>Materials:</strong><br>Counters, small toys, flashcards, whiteboard</p><p><strong>Activities:</strong></p><ol><li>Tell a story: “You have 3 apples, and your friend gives you 2 more. How many apples do you have?”</li><li>Use counters to model each equation.</li><li>Practice writing number sentences (3 + 2 = 5).</li></ol><p><strong>Assessment:</strong><br>Short quiz: Solve 5 + 3, 4 + 1, 2 + 6.</p>', NULL, NULL, '2025-10-09 17:52:48'),
(73, 35, 39, 'Lesson 4: Subtraction within 10', '<h3><strong>Lesson 4: Subtraction within 10</strong></h3><p><strong>Objective:</strong><br>Students will subtract numbers within 10 using real objects.</p><p><strong>Overview:</strong><br>Subtraction is introduced as “taking away” from a group.</p><p><strong>Materials:</strong><br>Toys, pictures, counters</p><p><strong>Activities:</strong></p><ol><li>Story: “You had 5 candies. You ate 2. How many are left?”</li><li>Act it out using objects.</li><li>Write subtraction equations (5 - 2 = 3).</li></ol><p><strong>Assessment:</strong><br>Worksheet: Draw and solve simple subtraction problems.</p><p><strong>Values Integration:</strong><br>Honesty — always count what’s left correctly.</p>', NULL, NULL, '2025-10-09 17:53:15'),
(74, 35, 39, 'Lesson 5: Identifying Shapes', '<h3><strong>Lesson 5: Identifying Shapes</strong></h3><p><strong>Objective:</strong><br>Students will identify and name basic 2D shapes: circle, triangle, square, rectangle.</p><p><strong>Overview:</strong><br>Students explore common shapes found in their surroundings.</p><p><strong>Materials:</strong><br>Shape cutouts, flashcards, colored papers</p><p><strong>Activities:</strong></p><ol><li>Show shape flashcards and say their names.</li><li>Shape hunt around the classroom or home.</li><li>Draw and color each shape.</li></ol><p><strong>Assessment:</strong><br>Match shapes to their names in a worksheet.</p><p><strong>Values Integration:</strong><br>Appreciation of order and design.</p>', NULL, NULL, '2025-10-09 17:53:48'),
(76, 32, 39, 'rets', '<p>asasa</p>', NULL, '[\"file_68ea36f726498.doc\"]', '2025-10-11 10:52:39'),
(77, 32, 39, 'asass', '<p>asasasa</p>', NULL, '[\"file_68ea372e8155e.jpg\",\"file_68ea372e81796.jpg\",\"file_68ea372e819dc.jpg\",\"file_68ea372e81b79.jpg\"]', '2025-10-11 10:53:34'),
(78, 36, 39, 'test', '<p>Watch this and make an essay</p>', 'https://youtu.be/8NO77aXYpfU?si=8WN_tNcpaoSBnFZY', '[\"file_68f46c67cc0dc.docx\"]', '2025-10-19 04:43:19'),
(79, 37, 46, 'test', '<p>test</p>', NULL, '[\"file_6927cbb9d30f9.png\"]', '2025-11-27 03:55:37'),
(81, 42, 40, 'test', '<p>test</p>', NULL, '[\"file_697ffda36e072.png\"]', '2026-02-02 01:28:03');

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
(19, '2025-13565', 'San Juan South Elementary School', '4th', 'San Fernando City', '3', '107197', 'Grade 1', 'Sunflower', '2025-2026', 'Monica Cruz', 80.00, '[{\"subject\":\"Language\",\"q1\":89,\"q2\":87,\"q3\":90,\"q4\":92,\"final_rating\":89.5,\"remarks\":\"Passed\"},{\"subject\":\"Reading and Literacy\",\"q1\":84,\"q2\":86,\"q3\":84,\"q4\":87,\"final_rating\":84.5,\"remarks\":\"Passed\"},{\"subject\":\"Mathematics\",\"q1\":86,\"q2\":87,\"q3\":88,\"q4\":90,\"final_rating\":87.5,\"remarks\":\"Passed\"},{\"subject\":\"Makabansa\",\"q1\":86,\"q2\":83,\"q3\":87,\"q4\":89,\"final_rating\":86,\"remarks\":\"Passed\"},{\"subject\":\"GMRC\",\"q1\":87,\"q2\":87,\"q3\":89,\"q4\":90,\"final_rating\":89,\"remarks\":\"Passed\"}]', '2025-12-09 17:34:12'),
(20, '2025-13565', 'San Juan South Elementary School', 'n/a', 'San Fernando City', '3', '107197', 'Grade 2', 'Eagle', '2025-2026', 'Clarissa Messes', 87.68, '[{\"subject\":\"Filipino\",\"q1\":89,\"q2\":87,\"q3\":90,\"q4\":92,\"final_rating\":89.5,\"remarks\":\"Passed\"},{\"subject\":\"English\",\"q1\":84,\"q2\":86,\"q3\":84,\"q4\":87,\"final_rating\":84.5,\"remarks\":\"Passed\"},{\"subject\":\"Mathematics\",\"q1\":86,\"q2\":87,\"q3\":88,\"q4\":90,\"final_rating\":87.5,\"remarks\":\"Passed\"},{\"subject\":\"Makabansa\",\"q1\":86,\"q2\":83,\"q3\":87,\"q4\":89,\"final_rating\":86,\"remarks\":\"Passed\"},{\"subject\":\"GMRC\",\"q1\":87,\"q2\":87,\"q3\":89,\"q4\":90,\"final_rating\":89,\"remarks\":\"Passed\"}]', '2025-12-06 04:47:25'),
(21, '2025-13565', 'San Juan South Elementary School', 'n/a', 'San Fernando City', '3', '107197', 'Grade 3', 'Masipag', '2025-2026', 'Clarissa Messes', 89.00, '[{\"subject\":\"Filipino\",\"q1\":89,\"q2\":87,\"q3\":90,\"q4\":92,\"final_rating\":89.5,\"remarks\":\"Passed\"},{\"subject\":\"English\",\"q1\":84,\"q2\":86,\"q3\":84,\"q4\":87,\"final_rating\":84.5,\"remarks\":\"Passed\"},{\"subject\":\"Science\",\"q1\":85,\"q2\":87,\"q3\":87,\"q4\":90,\"final_rating\":88,\"remarks\":\"Passed\"},{\"subject\":\"Mathematics\",\"q1\":86,\"q2\":87,\"q3\":88,\"q4\":90,\"final_rating\":87.5,\"remarks\":\"Passed\"},{\"subject\":\"Makabansa\",\"q1\":86,\"q2\":83,\"q3\":87,\"q4\":89,\"final_rating\":86,\"remarks\":\"Passed\"},{\"subject\":\"GMRC\",\"q1\":87,\"q2\":87,\"q3\":89,\"q4\":90,\"final_rating\":89,\"remarks\":\"Passed\"}]', '2025-12-06 04:47:25'),
(22, '2025-13565', 'San Juan South Elementary School', 'n/a', 'San Fernando City', '3', '107197', 'Grade 4', 'Honesty', '2025-2026', 'Christian Amorsolo', 84.68, '[{\"subject\":\"Filipino\",\"q1\":89,\"q2\":87,\"q3\":90,\"q4\":92,\"final_rating\":89.5,\"remarks\":\"Passed\"},{\"subject\":\"English\",\"q1\":84,\"q2\":86,\"q3\":84,\"q4\":87,\"final_rating\":84.5,\"remarks\":\"Passed\"},{\"subject\":\"Science\",\"q1\":85,\"q2\":87,\"q3\":87,\"q4\":90,\"final_rating\":88,\"remarks\":\"Passed\"},{\"subject\":\"Mathematics\",\"q1\":86,\"q2\":87,\"q3\":88,\"q4\":90,\"final_rating\":87.5,\"remarks\":\"Passed\"},{\"subject\":\"AP\",\"q1\":86,\"q2\":83,\"q3\":87,\"q4\":89,\"final_rating\":86,\"remarks\":\"Passed\"},{\"subject\":\"MAPEH\",\"q1\":87,\"q2\":88,\"q3\":88,\"q4\":89,\"final_rating\":88.5,\"remarks\":\"Passed\"},{\"subject\":\"EPP\",\"q1\":88,\"q2\":87,\"q3\":89,\"q4\":90,\"final_rating\":88.5,\"remarks\":\"Passed\"},{\"subject\":\"GMRC\",\"q1\":87,\"q2\":87,\"q3\":89,\"q4\":90,\"final_rating\":89,\"remarks\":\"Passed\"}]', '2025-12-06 06:47:25'),
(23, '2025-13565', 'San Juan South Elementary School', 'n/a', 'San Fernando City', '3', '107197', 'Grade 5', 'Diamond', '2025-2026', 'Criselda Devilieres', 87.68, '[{\"subject\":\"Filipino\",\"q1\":89,\"q2\":87,\"q3\":90,\"q4\":92,\"final_rating\":89.5,\"remarks\":\"Passed\"},{\"subject\":\"English\",\"q1\":84,\"q2\":86,\"q3\":84,\"q4\":87,\"final_rating\":84.5,\"remarks\":\"Passed\"},{\"subject\":\"Science\",\"q1\":85,\"q2\":87,\"q3\":87,\"q4\":90,\"final_rating\":88,\"remarks\":\"Passed\"},{\"subject\":\"Mathematics\",\"q1\":86,\"q2\":87,\"q3\":88,\"q4\":90,\"final_rating\":87.5,\"remarks\":\"Passed\"},{\"subject\":\"AP\",\"q1\":86,\"q2\":83,\"q3\":87,\"q4\":89,\"final_rating\":86,\"remarks\":\"Passed\"},{\"subject\":\"MAPEH\",\"q1\":87,\"q2\":88,\"q3\":88,\"q4\":89,\"final_rating\":88.5,\"remarks\":\"Passed\"},{\"subject\":\"EPP\",\"q1\":88,\"q2\":87,\"q3\":89,\"q4\":90,\"final_rating\":88.5,\"remarks\":\"Passed\"},{\"subject\":\"GMRC\",\"q1\":87,\"q2\":87,\"q3\":89,\"q4\":90,\"final_rating\":89,\"remarks\":\"Passed\"}]', '2025-12-06 06:47:25'),
(24, '2025-13565', 'San Juan South Elementary School', 'n/a', 'San Fernando City', '3', '107197', 'Grade 6', 'Bonifacio', '2025-2026', 'Rosales Mediola', 86.00, '[{\"subject\":\"Filipino\",\"q1\":86,\"q2\":87,\"q3\":87,\"q4\":90,\"final_rating\":86,\"remarks\":\"Passed\"},{\"subject\":\"English\",\"q1\":82,\"q2\":84,\"q3\":87,\"q4\":90,\"final_rating\":86,\"remarks\":\"Passed\"},{\"subject\":\"Science\",\"q1\":87,\"q2\":88,\"q3\":90,\"q4\":92,\"final_rating\":89,\"remarks\":\"Passed\"},{\"subject\":\"Mathematics\",\"q1\":85,\"q2\":87,\"q3\":90,\"q4\":91,\"final_rating\":87,\"remarks\":\"Passed\"},{\"subject\":\"AP\",\"q1\":82,\"q2\":83,\"q3\":86,\"q4\":90,\"final_rating\":85,\"remarks\":\"Passed\"},{\"subject\":\"MAPEH\",\"q1\":84,\"q2\":85,\"q3\":85,\"q4\":88,\"final_rating\":85,\"remarks\":\"Passed\"},{\"subject\":\"TLE\",\"q1\":86,\"q2\":86,\"q3\":88,\"q4\":90,\"final_rating\":85,\"remarks\":\"Passed\"},{\"subject\":\"ESP\",\"q1\":84,\"q2\":86,\"q3\":87,\"q4\":90,\"final_rating\":86,\"remarks\":\"Passed\"}]', '2025-12-06 00:12:46'),
(25, '2025-13565', 'San Fernando West Integrated High School', 'San Fernando West District', 'City Schools Division of San Fernando', '3', '500138', 'Grade 7', 'Integrity', '2025-2026', 'Rodolfo Amorsolo', 85.60, '[{\"subject\":\"Filipino\",\"q1\":80,\"q2\":85,\"q3\":87,\"q4\":90,\"final_rating\":85.5,\"remarks\":\"Passed\"},{\"subject\":\"English\",\"q1\":83,\"q2\":84,\"q3\":86,\"q4\":91,\"final_rating\":86,\"remarks\":\"Passed\"},{\"subject\":\"Science\",\"q1\":82,\"q2\":84,\"q3\":86,\"q4\":93,\"final_rating\":86.25,\"remarks\":\"Passed\"},{\"subject\":\"Mathematics\",\"q1\":81,\"q2\":85,\"q3\":86,\"q4\":90,\"final_rating\":86,\"remarks\":\"Passed\"},{\"subject\":\"AP\",\"q1\":82,\"q2\":84,\"q3\":85,\"q4\":90,\"final_rating\":85,\"remarks\":\"Passed\"},{\"subject\":\"MAPEH\",\"q1\":82,\"q2\":85,\"q3\":85,\"q4\":87,\"final_rating\":84,\"remarks\":\"Passed\"},{\"subject\":\"TLE\",\"q1\":83,\"q2\":84,\"q3\":84,\"q4\":86,\"final_rating\":83,\"remarks\":\"Passed\"},{\"subject\":\"Values Ed\",\"q1\":84,\"q2\":83,\"q3\":86,\"q4\":87,\"final_rating\":85,\"remarks\":\"Passed\"}]', '2025-12-06 00:00:08'),
(26, '2025-13565', 'San Fernando West Integrated High School', 'San Fernando West District', 'City Schools Division of San Fernando', '3', '500138', 'Grade 8', 'Integrity', '2025-2026', 'Rolando Aloma', 84.54, '[{\"subject\":\"Filipino\",\"q1\":80,\"q2\":85,\"q3\":87,\"q4\":90,\"final_rating\":85.5,\"remarks\":\"Passed\"},{\"subject\":\"English\",\"q1\":83,\"q2\":84,\"q3\":86,\"q4\":91,\"final_rating\":86,\"remarks\":\"Passed\"},{\"subject\":\"Science\",\"q1\":82,\"q2\":84,\"q3\":86,\"q4\":93,\"final_rating\":86.25,\"remarks\":\"Passed\"},{\"subject\":\"Mathematics\",\"q1\":81,\"q2\":85,\"q3\":86,\"q4\":90,\"final_rating\":86,\"remarks\":\"Passed\"},{\"subject\":\"AP\",\"q1\":82,\"q2\":84,\"q3\":85,\"q4\":90,\"final_rating\":85,\"remarks\":\"Passed\"},{\"subject\":\"MAPEH\",\"q1\":82,\"q2\":85,\"q3\":85,\"q4\":87,\"final_rating\":84,\"remarks\":\"Passed\"},{\"subject\":\"TLE\",\"q1\":83,\"q2\":84,\"q3\":84,\"q4\":86,\"final_rating\":83,\"remarks\":\"Passed\"},{\"subject\":\"Values Ed\",\"q1\":84,\"q2\":83,\"q3\":86,\"q4\":87,\"final_rating\":85,\"remarks\":\"Passed\"}]', '2025-12-06 00:00:08'),
(27, '2025-13565', 'San Fernando West Integrated High School', 'San Fernando West District', 'City Schools Division of San Fernando', '3', '500138', 'Grade 9', 'Integrity', '2025-2026', 'Rosalinda Amaro', 88.50, '[{\"subject\":\"Filipino\",\"q1\":80,\"q2\":85,\"q3\":87,\"q4\":90,\"final_rating\":85.5,\"remarks\":\"Passed\"},{\"subject\":\"English\",\"q1\":83,\"q2\":84,\"q3\":86,\"q4\":91,\"final_rating\":86,\"remarks\":\"Passed\"},{\"subject\":\"Science\",\"q1\":82,\"q2\":84,\"q3\":86,\"q4\":93,\"final_rating\":86.25,\"remarks\":\"Passed\"},{\"subject\":\"Mathematics\",\"q1\":81,\"q2\":85,\"q3\":86,\"q4\":90,\"final_rating\":86,\"remarks\":\"Passed\"},{\"subject\":\"AP\",\"q1\":82,\"q2\":84,\"q3\":85,\"q4\":90,\"final_rating\":85,\"remarks\":\"Passed\"},{\"subject\":\"MAPEH\",\"q1\":82,\"q2\":85,\"q3\":85,\"q4\":87,\"final_rating\":84,\"remarks\":\"Passed\"},{\"subject\":\"TLE\",\"q1\":83,\"q2\":84,\"q3\":84,\"q4\":86,\"final_rating\":83,\"remarks\":\"Passed\"},{\"subject\":\"Values Ed\",\"q1\":84,\"q2\":83,\"q3\":86,\"q4\":87,\"final_rating\":85,\"remarks\":\"Passed\"}]', '2025-12-06 00:00:08'),
(28, '2025-13565', 'San Fernando West Integrated High School', 'San Fernando West District', 'City Schools Division of San Fernando', '3', '500138', 'Grade 10', 'Integrity', '2025-2026', 'Romano Amorsolo', 87.00, '[{\"subject\":\"Filipino\",\"q1\":80,\"q2\":85,\"q3\":87,\"q4\":90,\"final_rating\":85.5,\"remarks\":\"Passed\"},{\"subject\":\"English\",\"q1\":83,\"q2\":84,\"q3\":86,\"q4\":91,\"final_rating\":86,\"remarks\":\"Passed\"},{\"subject\":\"Science\",\"q1\":82,\"q2\":84,\"q3\":86,\"q4\":93,\"final_rating\":86.25,\"remarks\":\"Passed\"},{\"subject\":\"Mathematics\",\"q1\":81,\"q2\":85,\"q3\":86,\"q4\":90,\"final_rating\":86,\"remarks\":\"Passed\"},{\"subject\":\"AP\",\"q1\":82,\"q2\":84,\"q3\":85,\"q4\":90,\"final_rating\":85,\"remarks\":\"Passed\"},{\"subject\":\"MAPEH\",\"q1\":82,\"q2\":85,\"q3\":85,\"q4\":87,\"final_rating\":84,\"remarks\":\"Passed\"},{\"subject\":\"TLE\",\"q1\":83,\"q2\":84,\"q3\":84,\"q4\":86,\"final_rating\":83,\"remarks\":\"Passed\"},{\"subject\":\"Values Ed\",\"q1\":84,\"q2\":83,\"q3\":86,\"q4\":87,\"final_rating\":85,\"remarks\":\"Passed\"}]', '2025-12-06 00:00:08'),
(29, '2025-00231', 'The Cardinal Academy Inc.', '4', 'Bulacan', '3', '400858', 'Nursery', 'Diamond', '2025-2026', 'Torvalds Linus', 89.87, '[{\"subject\":\"LLC\",\"q1\":86,\"q2\":86,\"q3\":87,\"q4\":86,\"final_rating\":86.5,\"remarks\":\"Passed\"},{\"subject\":\"SED\",\"q1\":87,\"q2\":87,\"q3\":87,\"q4\":87,\"final_rating\":87,\"remarks\":\"Passed\"},{\"subject\":\"Values Development\",\"q1\":90,\"q2\":91,\"q3\":90,\"q4\":90,\"final_rating\":90.25,\"remarks\":\"Passed\"},{\"subject\":\"PHMD\",\"q1\":86,\"q2\":87,\"q3\":88,\"q4\":89,\"final_rating\":87.5,\"remarks\":\"Passed\"},{\"subject\":\"Aesthetic/Creative Development\",\"q1\":90,\"q2\":90,\"q3\":90,\"q4\":90,\"final_rating\":90,\"remarks\":\"Passed\"},{\"subject\":\"Cognitive Development\",\"q1\":89,\"q2\":89,\"q3\":89,\"q4\":89,\"final_rating\":89,\"remarks\":\"Passed\"}]', '2025-12-09 23:19:06'),
(30, '2026-38818', 'The Cardinal Academy Inc.', '4th', 'Bulacan', '3', '400858', 'Grade 3', 'Beryl', '2025-2026', 'Ria Velasco', 75.00, '[{\"subject\":\"eng 10\",\"q1\":75,\"q2\":74,\"q3\":76,\"q4\":75,\"final_rating\":75,\"remarks\":\"Pass\"}]', '2026-01-28 17:40:35'),
(31, '2026-62962', 'The Cardinal Academy Inc.', '4th', 'Bulacan', '3', '400858', 'Grade 1', 'Moonstone', '2025-2026', 'Stephany Gandula', 85.50, '[{\"subject\":\"Makabansa 1\",\"q1\":80,\"q2\":80,\"q3\":80,\"q4\":80,\"final_rating\":80,\"remarks\":\"Pass\"},{\"subject\":\"Mathematics 1\",\"q1\":80,\"q2\":80,\"q3\":80,\"q4\":80,\"final_rating\":80,\"remarks\":\"Pass\"},{\"subject\":\"English 1\",\"q1\":90,\"q2\":90,\"q3\":90,\"q4\":90,\"final_rating\":90,\"remarks\":\"Pass\"},{\"subject\":\"Filipino 1\",\"q1\":87,\"q2\":88,\"q3\":89,\"q4\":90,\"final_rating\":88.5,\"remarks\":\"Pass\"},{\"subject\":\"Science 1\",\"q1\":89,\"q2\":89,\"q3\":90,\"q4\":92,\"final_rating\":90,\"remarks\":\"Pass\"}]', '2026-01-28 20:34:20'),
(32, '2026-33670', 'The Cardinal Academy Inc.', '4th', 'Bulacan', '3', '400858', 'Grade 1', 'Moonstone', '2025-2026', 'Stephany Gandula', 86.17, '[{\"subject\":\"Filipino 1\",\"q1\":91,\"q2\":93,\"q3\":98,\"q4\":96,\"final_rating\":94.5,\"remarks\":\"Pass\"},{\"subject\":\"Music 1\",\"q1\":90,\"q2\":97,\"q3\":98,\"q4\":91,\"final_rating\":94,\"remarks\":\"Pass\"},{\"subject\":\"Makabansa 1\",\"q1\":75,\"q2\":75,\"q3\":60,\"q4\":70,\"final_rating\":70,\"remarks\":\"Fail\"}]', '2026-02-04 10:23:42'),
(33, '2025-71474', 'The Cardinal Academy Inc.', '4th', 'Bulacan', '3', '400858', 'Grade 9', 'Alexandrite', '2025-2026', 'Mark Edrian Navarro', 93.20, '[{\"subject\":\"Makabansa 1\",\"q1\":92,\"q2\":93,\"q3\":94,\"q4\":95,\"final_rating\":93.5,\"remarks\":\"Pass\"},{\"subject\":\"Mathematics 1\",\"q1\":91,\"q2\":92,\"q3\":91,\"q4\":90,\"final_rating\":91,\"remarks\":\"Pass\"},{\"subject\":\"Araling Panlipunan 1\",\"q1\":95,\"q2\":94,\"q3\":93,\"q4\":92,\"final_rating\":93.5,\"remarks\":\"Pass\"},{\"subject\":\"Science 1\",\"q1\":93,\"q2\":92,\"q3\":90,\"q4\":91,\"final_rating\":91.5,\"remarks\":\"Pass\"},{\"subject\":\"English 1\",\"q1\":98,\"q2\":97,\"q3\":96,\"q4\":95,\"final_rating\":96.5,\"remarks\":\"Pass\"}]', '2026-02-06 18:02:01'),
(34, '2025-11100', 'TEST', 'TEST', 'TSE', 'TEST', '323242', 'TSTE', 'TES', '2026-2027', 'TEST', 1.00, '[]', '2026-02-06 18:12:10');

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
(19, 'Moonstone', 'Grade 1', 40, '101', 'N/A', 20, 12, '2025-2026', '2025-07-12 15:39:32'),
(20, 'Topaz', 'Grade 2', 44, '102', 'N/A', 20, 0, '2025-2026', '2025-07-12 15:49:48'),
(21, 'Amethyst', 'Grade 2', 44, '102', 'N/A', 20, 12, '2025-2026', '2025-07-12 15:50:07'),
(22, 'Beryl', 'Grade 3', 45, '103', 'N/A', 25, 10, '2025-2026', '2025-07-12 15:51:43'),
(23, 'Pearl', 'Grade 3', 45, '103', 'N/A', 25, 0, '2025-2026', '2025-07-12 15:52:01'),
(24, 'Garnet', 'Grade 5', 49, '105', 'N/A', 20, 10, '2025-2026', '2025-07-12 15:54:58'),
(25, 'Ruby', 'Grade 8', 51, '108', 'N/A', 30, 0, '2025-2026', '2025-07-12 16:06:43'),
(26, 'Quartz', 'Grade 8', 51, '108', 'N/A', 30, 13, '2025-2026', '2025-07-12 16:07:01'),
(27, 'Alexandrite', 'Grade 9', 51, '109', 'N/A', 30, 18, '2025-2026', '2025-07-12 16:07:21'),
(28, 'Aquamarine', 'Grade 10', 40, '110', 'N/A', 30, 10, '2025-2026', '2025-07-12 16:08:11'),
(29, 'Zircon', 'Grade 10', 40, '110', 'N/A', 30, 2, '2025-2026', '2025-07-12 16:09:19'),
(30, 'ABM 11', 'Grade 11', 42, '111', 'ABM (Accountancy, Business and Management)', 30, 0, '2025-2026', '2025-07-12 16:10:06'),
(31, 'HUMSS 11', 'Grade 11', 42, '111', 'HUMMS (Humanities and Social Sciences)', 30, 0, '2025-2026', '2025-07-12 16:10:25'),
(32, 'STEM 11', 'Grade 11', 42, '111', 'STEM (Science, Technology, Engineering and Mathematics)', 30, 1, '2025-2026', '2025-07-12 16:10:52'),
(33, 'ABM 12 - Feldspar', 'Grade 12', 43, '112', 'ABM (Accountancy, Business and Management)', 30, 0, '2025-2026', '2025-07-12 16:11:17'),
(34, 'HUMSS 12', 'Grade 12', 43, '112', 'HUMMS (Humanities and Social Sciences)', 30, 0, '2025-2026', '2025-07-12 16:11:38'),
(35, 'STEM 12 - Sardonyx', 'Grade 12', 43, '112', 'STEM (Science, Technology, Engineering and Mathematics)', 30, 0, '2025-2026', '2025-07-12 16:12:11'),
(36, 'Malakas', 'Grade 4', 42, '303', 'N/A', 20, 11, '2025-2026', '2025-08-22 20:26:18'),
(37, 'Mabait', 'Grade 6', 45, '303', 'N/A', 20, 10, '2025-2026', '2025-08-22 20:29:49'),
(45, 'Bonifacio', 'Kinder', 40, '102', 'N/A', 20, 2, '2025-2026', '2025-12-09 23:45:27'),
(46, 'Rizal', 'Kinder', 47, '105', 'N/A', 20, 0, '2025-2026', '2026-01-17 03:51:47'),
(49, 'Diamond', 'Nursery', 49, '201', 'N/A', 20, 4, '2025-2026', '2026-01-24 03:31:26'),
(50, 'Emerald', 'Nursery', 51, '202', 'N/A', 20, 0, '2025-2026', '2026-01-24 03:33:17'),
(52, 'Sapphire', 'Grade 7', 48, '107', 'N/A', 20, 10, '2025-2026', '2026-01-26 08:53:37'),
(53, 'Moonstone', 'Grade 1', 40, '101', 'N/A', 20, 19, '2026-2027', '2025-07-12 15:39:32'),
(54, 'Topaz', 'Grade 2', 44, '102', 'N/A', 20, 0, '2026-2027', '2025-07-12 15:49:48'),
(55, 'Amethyst', 'Grade 2', 44, '102', 'N/A', 20, 12, '2026-2027', '2025-07-12 15:50:07'),
(56, 'Beryl', 'Grade 3', 45, '103', 'N/A', 25, 10, '2026-2027', '2025-07-12 15:51:43'),
(57, 'Pearl', 'Grade 3', 45, '103', 'N/A', 25, 0, '2026-2027', '2025-07-12 15:52:01'),
(58, 'Garnet', 'Grade 5', 49, '105', 'N/A', 20, 10, '2026-2027', '2025-07-12 15:54:58'),
(59, 'Ruby', 'Grade 8', 51, '108', 'N/A', 30, 0, '2026-2027', '2025-07-12 16:06:43'),
(60, 'Quartz', 'Grade 8', 51, '108', 'N/A', 30, 13, '2026-2027', '2025-07-12 16:07:01'),
(61, 'Alexandrite', 'Grade 9', 51, '109', 'N/A', 30, 18, '2026-2027', '2025-07-12 16:07:21'),
(62, 'Aquamarine', 'Grade 10', 40, '110', 'N/A', 30, 10, '2026-2027', '2025-07-12 16:08:11'),
(63, 'Zircon', 'Grade 10', 40, '110', 'N/A', 30, 2, '2026-2027', '2025-07-12 16:09:19'),
(64, 'ABM 11', 'Grade 11', 42, '111', 'ABM (Accountancy, Business and Management)', 30, 0, '2026-2027', '2025-07-12 16:10:06'),
(65, 'HUMSS 11', 'Grade 11', 42, '111', 'HUMMS (Humanities and Social Sciences)', 30, 0, '2026-2027', '2025-07-12 16:10:25'),
(66, 'STEM 11', 'Grade 11', 42, '111', 'STEM (Science, Technology, Engineering and Mathematics)', 30, 1, '2026-2027', '2025-07-12 16:10:52'),
(67, 'ABM 12 - Feldspar', 'Grade 12', 43, '112', 'ABM (Accountancy, Business and Management)', 30, 0, '2026-2027', '2025-07-12 16:11:17'),
(68, 'HUMSS 12', 'Grade 12', 43, '112', 'HUMMS (Humanities and Social Sciences)', 30, 0, '2026-2027', '2025-07-12 16:11:38'),
(69, 'STEM 12 - Sardonyx', 'Grade 12', 43, '112', 'STEM (Science, Technology, Engineering and Mathematics)', 30, 0, '2026-2027', '2025-07-12 16:12:11'),
(70, 'Malakas', 'Grade 4', 42, '303', 'N/A', 20, 11, '2026-2027', '2025-08-22 20:26:18'),
(71, 'Mabait', 'Grade 6', 45, '303', 'N/A', 20, 10, '2026-2027', '2025-08-22 20:29:49'),
(72, 'Moonstone', 'Grade 1', 48, '101', 'N/A', 20, 2, '2026-2027', '2025-12-09 11:29:58'),
(73, 'Topaz', 'Grade 2', 41, '101', 'N/A', 20, 0, '2026-2027', '2025-12-09 22:09:47'),
(74, 'Newton', 'Kinder', 45, '105', 'N/A', 20, 0, '2026-2027', '2025-12-09 23:27:50'),
(75, 'Newton', 'Kinder', 43, '105', 'N/A', 20, 0, '2026-2027', '2025-12-09 23:29:19'),
(76, 'Newton', 'Kinder', 39, '105', 'N/A', 20, 0, '2026-2027', '2025-12-09 23:30:04'),
(77, 'test', 'Nursery', 38, '105', 'N/A', 20, 1, '2026-2027', '2025-12-09 23:31:18'),
(78, 'Bonifacio', 'Kinder', 40, '102', 'N/A', 20, 2, '2026-2027', '2025-12-09 23:45:27'),
(79, 'Rizal', 'Kinder', 47, '105', 'N/A', 20, 0, '2026-2027', '2026-01-17 03:51:47'),
(80, 'Diamond', 'Nursery', 49, '201', 'N/A', 20, 10, '2026-2027', '2026-01-24 03:31:26'),
(81, 'Emerald', 'Nursery', 51, '202', 'N/A', 20, 0, '2026-2027', '2026-01-24 03:33:17'),
(82, 'Sapphire', 'Grade 7', 48, '107', 'N/A', 20, 10, '2026-2027', '2026-01-26 08:53:37');

-- --------------------------------------------------------

--
-- Table structure for table `student_disciplinary_records`
--

CREATE TABLE `student_disciplinary_records` (
  `id` int(11) NOT NULL,
  `disciplinary_id` varchar(50) NOT NULL,
  `student_id` varchar(50) NOT NULL,
  `incident_date` date NOT NULL,
  `incident_location` varchar(255) NOT NULL,
  `incident_description` text NOT NULL,
  `violation_type` varchar(100) NOT NULL,
  `disciplinary_action` varchar(100) NOT NULL,
  `witnesses` text DEFAULT NULL,
  `remarks` text DEFAULT NULL,
  `disciplinary_incharge` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `student_disciplinary_records`
--

INSERT INTO `student_disciplinary_records` (`id`, `disciplinary_id`, `student_id`, `incident_date`, `incident_location`, `incident_description`, `violation_type`, `disciplinary_action`, `witnesses`, `remarks`, `disciplinary_incharge`, `created_at`) VALUES
(2, 'DISC-3186', '2025-52404', '2025-10-09', 'asasa', 'sasas', 'Bullying', 'Suspension', 'asas', 'asas', '', '2025-10-07 18:18:01'),
(3, 'DISC-3646', '2025-52404', '2025-10-07', 'asas', 'asa', 'Disrespect', 'Detention', 'sasas', 'asas', '', '2025-10-07 18:20:42'),
(11, 'DISC-3663', '2025-52404', '2025-10-10', 'adas', 'adsda', 'Bullying', 'Suspension', 'adad', 'ad', '', '2025-10-09 20:24:29'),
(15, 'DISC-0887', '2025-13565', '2025-12-06', 'test', 'test', 'Property Damage', 'Suspension', 'None', 'None', '', '2025-12-06 07:38:41'),
(16, 'DISC-0928', '2026-12877', '2026-01-29', 'test', 'tset', 'Tardiness', 'Warning', 'n/a', 'n/a', '', '2026-01-29 02:24:57'),
(17, 'DISC-5417', '2026-33670', '2026-02-02', 'canteen', 'nanapak', 'Bullying', 'Warning', 'maam step', 'biogesic', '', '2026-02-02 02:14:35'),
(19, 'DISC-4920', '152', '2026-02-15', 'Classroom', 'test', 'Bullying', 'Warning', 'test', 'test', 'Stephanie, Candado', '2026-02-14 23:28:07'),
(20, 'DISC-6412', '152', '2026-02-15', 'Classroom', 'test', 'Bullying', 'Warning', 'tesdt', 'twst', 'Stephanie, Candado', '2026-02-14 23:36:40'),
(21, 'DISC-2983', '152', '2026-02-15', 'Classroom', 'test', 'Bullying', 'Warning', 'test', 'test', 'Stephanie, Candado', '2026-02-14 23:39:06'),
(22, 'DISC-0694', '2025-00231', '2026-02-15', 'Classroom', 'test', 'Bullying', 'Detention', 'test', 'test', '', '2026-02-14 23:39:34'),
(23, 'DISC-4626', '2025-00231', '2026-02-15', 'Classroom', 'test', 'Disrespect', 'Warning', 'test', 'test', 'Stephanie, Candado', '2026-02-14 23:41:26');

-- --------------------------------------------------------

--
-- Table structure for table `student_health_records`
--

CREATE TABLE `student_health_records` (
  `id` int(11) NOT NULL,
  `medical_id` varchar(50) DEFAULT NULL,
  `student_id` varchar(50) DEFAULT NULL,
  `height` float DEFAULT NULL,
  `weight` float DEFAULT NULL,
  `blood_pressure` varchar(20) DEFAULT NULL,
  `temperature` float DEFAULT NULL,
  `pulse` int(11) DEFAULT NULL,
  `respiration` int(11) DEFAULT NULL,
  `allergies` text DEFAULT NULL,
  `medications` text DEFAULT NULL,
  `conditions` text DEFAULT NULL,
  `recent_illness` text DEFAULT NULL,
  `hospitalizations` text DEFAULT NULL,
  `vision` text DEFAULT NULL,
  `hearing` text DEFAULT NULL,
  `dental` text DEFAULT NULL,
  `activity` int(11) DEFAULT NULL,
  `sleep` int(11) DEFAULT NULL,
  `diet` text DEFAULT NULL,
  `mental_health` text DEFAULT NULL,
  `notes` text DEFAULT NULL,
  `general_note` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `types` varchar(100) NOT NULL DEFAULT 'check_up',
  `medecine_request` text NOT NULL,
  `medecine_used` text NOT NULL,
  `medecine_qty` int(11) DEFAULT NULL,
  `reasons` text NOT NULL,
  `sent_home` text NOT NULL DEFAULT '0',
  `nurse` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `student_health_records`
--

INSERT INTO `student_health_records` (`id`, `medical_id`, `student_id`, `height`, `weight`, `blood_pressure`, `temperature`, `pulse`, `respiration`, `allergies`, `medications`, `conditions`, `recent_illness`, `hospitalizations`, `vision`, `hearing`, `dental`, `activity`, `sleep`, `diet`, `mental_health`, `notes`, `general_note`, `created_at`, `types`, `medecine_request`, `medecine_used`, `medecine_qty`, `reasons`, `sent_home`, `nurse`) VALUES
(14, 'MED-0006', '2025-52404', 132, 35, '120/30', 35, 80, 30, 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', '0', 56, 8, 'N/A', 'N/A', 'N/A', 'N/A', '2025-10-09 19:45:08', 'check_up', '', '', NULL, '', '0', ''),
(15, 'MED-0007', '2025-52404', 90, 32, '110/20', 35, 90, 25, 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', '0', 0, 0, 'N/A', 'N/A', 'N/A', 'N/A', '2025-10-09 19:46:51', 'check_up', '', '', NULL, '', '0', ''),
(34, 'MED-0008', '2025-52404', NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '', '', '', '', '', NULL, NULL, '', '', '', 'test', '2025-12-09 11:41:15', 'Request Medicine', 'Medicol', 'Flu', NULL, '', '0', 'Unknown Nurse'),
(35, 'MED-0009', '2025-52404', NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '', '', '', '', '', NULL, NULL, '', '', '', 'test', '2025-12-09 11:45:47', 'Request Medicine', 'test', 'test', NULL, '', '0', 'Unknown Nurse'),
(36, 'MED-0010', '2025-00231', NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '', '', '', '', '', NULL, NULL, '', '', '', 'test', '2025-12-09 11:49:48', 'Clinic Visit', '', '', NULL, 'test', '0', 'Unknown Nurse'),
(37, 'MED-0011', '2025-52404', NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '', '', '', '', '', NULL, NULL, '', '', '', 'test', '2025-12-09 11:57:04', 'Request Medicine', 'test', 'test', NULL, '', '0', 'Unknown Nurse'),
(38, 'MED-0012', '2025-52404', NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '', '', '', '', '', NULL, NULL, '', '', '', 'test', '2025-12-09 11:57:44', 'Clinic Visit', '', '', NULL, 'test', '0', 'Unknown Nurse'),
(39, 'MED-0013', '2025-52404', NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '', '', '', '', '', NULL, NULL, '', '', '', 'test', '2025-12-09 11:57:45', 'Clinic Visit', '', '', NULL, 'test', '0', 'Unknown Nurse'),
(40, 'MED-0014', '2025-52404', NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '', '', '', '', '', NULL, NULL, '', '', '', 'test', '2025-12-09 11:59:27', 'Request Medicine', 'test', 'test', NULL, '', '0', 'Unknown Nurse'),
(41, 'MED-0015', '2025-52404', NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '', '', '', '', '', NULL, NULL, '', '', '', 'test', '2025-12-09 12:00:59', 'Request Medicine', 'test', 'test', NULL, '', '0', 'Stephanie, Candado'),
(42, 'MED-0016', '2025-52404', NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '', '', '', '', '', NULL, NULL, '', '', '', 'test', '2025-12-09 12:01:18', 'Clinic Visit', '', '', NULL, 'test', '0', 'Stephanie, Candado'),
(43, 'MED-0017', '2025-52404', 167, 55, '110/70', 35, 78, 20, 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', NULL, 5, 'N/A', 'N/A', '', 'Pass', '2025-12-09 12:05:22', 'Check Up', '', '', NULL, '', '0', 'Stephanie, Candado'),
(44, 'MED-0018', '2025-52404', 167, 89, '110/70', 35, 80, 25, 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', NULL, 8, 'N/A', 'N/A', '', 'N/A', '2025-12-09 13:44:15', 'Check Up', '', '', NULL, '', '0', 'Michelle, Aguilar'),
(45, 'MED-0019', '2025-52404', NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '', '', '', '', '', NULL, NULL, '', '', '', 'N/A', '2025-12-09 13:44:41', 'Request Medicine', 'Medicol', 'Used for headache', NULL, '', '0', 'Michelle, Aguilar'),
(46, 'MED-0020', '2025-52404', NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '', '', '', '', '', NULL, NULL, '', '', '', 'N/A', '2025-12-09 13:45:00', 'Clinic Visit', '', '', NULL, 'For checking', '0', 'Michelle, Aguilar'),
(47, 'MED-0021', '2025-52404', NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '', '', '', '', '', NULL, NULL, '', '', '', 'N/A', '2025-12-09 13:48:26', 'Request Medicine', 'Medicol', 'Headache', NULL, '', '0', 'Michelle, Aguilar'),
(48, 'MED-0022', '2025-52404', NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '', '', '', '', '', NULL, NULL, '', '', '', 'N/A', '2025-12-09 13:48:44', 'Clinic Visit', '', '', NULL, 'For check ups', '0', 'Michelle, Aguilar'),
(49, 'MED-0023', '2025-52404', 176, 80, '110/80', 35, 80, 25, 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', NULL, 8, 'N/A', 'N/A', '', 'N/A', '2025-12-09 13:49:29', 'Check Up', '', '', NULL, '', '0', 'Michelle, Aguilar'),
(50, 'MED-0024', '2025-52404', 176, 80, '110/80', 35, 80, 25, 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', NULL, 8, 'N/A', 'N/A', '', 'N/A', '2025-12-09 13:53:03', 'Check Up', '', '', NULL, '', '0', 'Michelle, Aguilar'),
(51, 'MED-0025', '2025-52404', NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '', '', '', '', '', NULL, NULL, '', '', '', 'N/A', '2025-12-09 13:53:29', 'Request Medicine', 'Medicol', 'for headache ', NULL, '', '0', 'Michelle, Aguilar'),
(52, 'MED-0026', '2025-52404', NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '', '', '', '', '', NULL, NULL, '', '', '', 'N/A', '2025-12-09 13:53:58', 'Clinic Visit', '', '', NULL, 'For followup of medecines', '0', 'Michelle, Aguilar'),
(53, 'MED-0027', '2025-13565', NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '', '', '', '', '', NULL, NULL, '', '', '', 'test', '2025-12-10 01:37:11', 'Clinic Visit', '', '', NULL, 'test', '0', 'Stephanie, Candado'),
(54, 'MED-0028', '2026-12877', 156, 33, '100/60', 37, 81, 18, 'n/a', 'n/a', 'n/a', 'n/a', 'n/a', 'n/a', 'n/a', 'n/a', NULL, NULL, 'n/a', 'n/a', '', 'n/a', '2026-01-29 02:17:04', 'Check Up', '', '', NULL, '', '0', 'Michelle, Aguilar'),
(55, 'MED-0029', '2026-33670', 50, 55, '80/100', 36, 75, 19, 'seafood', 'n/a', 'n/a', 'n/a', 'n/a', 'astigmatism', 'n/a', 'n/a', NULL, NULL, 'n/a', 'n/a', '', 'uminom ng tubig', '2026-02-02 02:10:57', 'Check Up', '', '', NULL, '', '0', 'Michelle, Aguilar'),
(56, 'MED-0030', '2026-33670', NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '', '', '', '', '', NULL, NULL, '', '', '', 'biogesic', '2026-02-02 02:11:29', 'Request Medicine', 'biogesic', 'biogesic', NULL, '', '0', 'Michelle, Aguilar'),
(57, 'MED-0031', '2026-33670', NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '', '', '', '', '', NULL, NULL, '', '', '', 'biogesic', '2026-02-02 02:12:09', 'Clinic Visit', '', '', NULL, 'headache', '0', 'Michelle, Aguilar'),
(58, 'MED-0032', '2026-33670', NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '', '', '', '', '', NULL, NULL, '', '', '', 'biogesic', '2026-02-02 02:12:09', 'Clinic Visit', '', '', NULL, 'headache', '0', 'Michelle, Aguilar'),
(60, 'MED-0034', '2025-00231', NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '', '', '', '', '', NULL, NULL, '', '', '', 'Need to rest due to flu', '2026-02-14 22:32:23', 'Request Medicine', 'Ibuprofen', 'for flu', 5, '', '0', 'Stephanie, Candado'),
(61, 'MED-0035', '2025-00231', NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '', '', '', '', '', NULL, NULL, '', '', '', 'N/A', '2026-02-14 22:38:12', 'Request Medicine', 'Pain Reliever', 'for pain', 1, '', '1', 'Stephanie, Candado'),
(66, 'MED-0036', '2025-00231', NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '', '', '', '', '', NULL, NULL, '', '', '', 'test', '2026-02-14 23:06:06', 'Request Medicine', 'Ibuprofen', 'for flu', 5, '', 'yes', 'Stephanie, Candado'),
(67, 'MED-0037', '2025-00231', NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '', '', '', '', '', NULL, NULL, '', '', '', 'test', '2026-02-14 23:12:01', 'Clinic Visit', '', '', 0, 'test', 'no', 'Stephanie, Candado');

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
(49, '2025-52404', '202509060117', 'Noah', 'Villanueva', 'Ramos', 'New Student', 'male', 'Grade 1', NULL, '2017-05-30', 'Catholic', 'Marilao, Bulacan', 7, 'Blk 21 Lot 11 Marilao', 'Region III', 'Bulacan', 'Marilao', 'Ibayo', 'Renato Ramos', 'Engineer', '0917656789', 'Elena Ramos', 'Teacher', '0917667890', 'Oscar Ramos', 'Vendor', '0917678901', 'approved', 'Q293847', '0917689012', 'floterina@gmail.com', 'fb.com/noah.ramos', '2025-10-11 10:12:30', NULL, 0, 0, 0, 0, 0),
(79, '2025-00231', 'N/A', 'Leo', 'Santos', 'Trujillo', 'New Student', 'male', 'Kinder', '', '2019-11-04', 'Catholic', 'Quezon City, Metro Manila', 4, 'Lawa, City of Meycauayan, Bulacan, Central Luzon,', 'Central Luzon', 'Bulacan', 'City of Meycauayan', 'Lawa', 'Marco Trujillo', 'Doctor', '09178234915', 'Daniela Trujillo', 'Nurse', '09178234915', 'Daniela Trujillo', 'N/a', '09178234915', 'approved', 'Q405425', '09178234915', 'danitrjllo23@gmail.com', NULL, '2026-01-26 16:08:13', NULL, 1, 1, 1, 1, 0),
(80, '2025-11100', '400858070030', 'Franklin', 'Garcia', 'Maddox', 'New Student', 'male', 'Grade 2', '', '2016-03-04', 'Catholic', 'Dagupan City, Pangasinan', 7, 'Bahay Pare, City of Meycauayan, Bulacan, Central Luzon,', 'Central Luzon', 'Bulacan', 'City of Meycauayan', 'Bahay Pare', 'George Maddox', 'Electrical Engineer', '09178234916', 'Sabrina Maddox', 'Civil Engineer', '09178234916', 'Sabrina Maddox', 'N/a', '09178234916', 'approved', 'Q119789', '09178234916', 'sabmaddox11@gmail.com', NULL, '2025-12-09 22:39:56', NULL, 1, 1, 1, 1, 0),
(81, '2025-68549', '400858070031', 'Frederic', 'Navarro', 'Carney', 'New Student', 'male', 'Grade 5', '', '2013-07-22', 'Catholic', 'Iloilo City, Iloilo', 11, 'Banga, City of Meycauayan, Bulacan, Central Luzon,', 'Central Luzon', 'Bulacan', 'City of Meycauayan', 'Banga', 'Julian Carney', 'Pilot', '09178234917', 'Meredith Carney', 'House Wife', '09178234917', 'Sandra Carney', 'N/a', '09178234917', 'approved', 'Q994405', '09178234917', 'sandrac90@gmail.com', NULL, '2025-12-09 22:41:05', NULL, 1, 1, 1, 1, 0),
(82, '2025-71474', '400858070034', 'Adelaide', 'Ramos', 'Warren', 'New Student', 'female', 'Grade 9', '', '2008-09-30', 'Catholic', 'Cebu City, Cebu', 15, 'Malhacan, City of Meycauayan, Bulacan, Central Luzon, ', 'Central Luzon', 'Bulacan', 'City of Meycauayan', 'Malhacan', 'Timothy Warren', 'Police', '09178234919', 'Cecile Warren', 'Stewardess', '09178234919', 'Eliza Warren', 'N/a', '09178234919', 'approved', 'Q860288', '09178234919', 'elizawarren59@gmail.com', NULL, '2025-12-05 21:54:07', NULL, 0, 0, 0, 0, 0),
(83, '2025-13565', '400858070035', 'Molly', 'Villanueva', 'Holman', 'New Student', 'male', 'Grade 11', '', '2006-05-14', 'Catholic', 'San Fernando City, La Union', 17, 'Pantoc, City of Meycauayan, Bulacan, Central Luzon,', 'Central Luzon', 'Bulacan', 'City of Meycauayan', 'Pantoc', 'Patrick Holman', 'MedTech', '09178234920', 'Geneva Holman', 'Nurse', '09178234920', 'Olivia Holman', 'N/a', '09178234920', 'approved', 'Q334279', '09178234920', 'oliviah29@gmail.com', NULL, '2025-12-09 22:42:35', NULL, 1, 1, 1, 1, 0),
(84, '2025-73069', '400858070033', 'Saira', 'Gutierrez', 'Boone', 'New Student', 'female', 'Grade 7', '', '2011-01-09', 'Catholic', 'Davao City, Davao del Sur', 12, 'Camalig, City of Meycauayan, Bulacan, Central Luzon, ', 'Central Luzon', 'Bulacan', 'City of Meycauayan', 'Camalig', 'Elliot Boone', 'Lawyer', '09178234918', 'Farah Boone', 'House Wife', '09178234918', 'Farah Boone', 'N/a', '09178234918', 'approved', 'Q869100', '09178234918', 'farahboone12@gmail.com', NULL, '2025-12-05 21:54:22', NULL, 0, 0, 0, 0, 0),
(85, '2025-63156', '128712121212123', 'Rick', 'Macaraeg', 'Dulay', 'New Student', 'male', 'Nursery', '', '2020-02-22', 'Catholic', 'Davao City, Davao Del Sur', 5, 'Nangka, Libona, Bukidnon, Northern Mindanao,', NULL, NULL, NULL, NULL, 'Miranda Macaraeg', 'N/A', '09120912091', 'Julia Marii', 'N/A', '09120912091', 'Julia Marii', 'N/A', '09123456789', 'approved', 'Q028121', '09123456733', 'rickandmorty0224@gmail.com', NULL, '2025-12-09 23:41:11', NULL, 1, 1, 1, 1, 1),
(86, '2025-00674', '400858070029', 'Davanee', NULL, 'De Ocampo', 'New Student', 'female', 'Nursery', '', '2019-02-10', 'Christian', 'Marilao, Bulacan', 6, 'Prenza II, Marilao, Bulacan, Central Luzon,', NULL, NULL, NULL, NULL, 'Ken Benedict De Ocampo', 'N/A', '09090090909', 'Stephany Gandula', 'N/A', '00000000000', 'Nora Gandula', 'N/A', '09123456789', 'approved', 'Q607812', '09123456789', 'ncgandula@gmail.com', NULL, '2025-12-10 11:42:22', NULL, 1, 1, 1, 1, 1),
(88, '2025-18633', '627182121', 'John', 'Marker', 'Dela Cruz', 'New Student', 'male', 'Nursery', '', '2021-02-12', 'Catholic', 'Marilao, Bulacan', 4, 'Batia, Bocaue, Bulacan, Central Luzon,', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Sonia  Padilla', 'House Wife', '09123456715', 'approved', 'Q542061', '09120912091', 'floterina@gmail.com', NULL, '2025-12-17 06:05:27', NULL, 1, 1, 1, 1, 1),
(89, '2025-92581', '00000000000', 'Brian', 'Macaraeg', 'Dulay', 'New Student', 'male', 'Kinder', '', '2021-02-22', 'Catholic', 'Davao City, Davao Del Sur', 4, 'Tambulig Buton, Tabuan-Lasa, Basilan, BARMM,', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Julia Marii', NULL, '09123456789', 'approved', 'Q551718', '09123456789', 'admin1@barangay.com', NULL, '2025-12-17 17:31:56', 'N/A', 1, 1, 1, 1, 1),
(92, '2026-02462', '40085808010', 'Sophia Mae', 'Tolentino', 'Jimenez', 'New Student', 'female', 'Grade 1', '', '2018-10-05', 'Christian', 'Meycauayan, Bulacan', 6, 'Blk 1 Lot 5, Villa Teresa Subd., Brgy. Camalig, Meycauayan, Bulacan', NULL, NULL, NULL, NULL, 'Carlo Jimenez', 'Sales Agent', '09181110020', 'Marissa Jimenez', 'Housewife', '09181110021', 'Marissa Jimenez', 'Housewife', '09181110021', 'approved', 'QG3010', '09181110020', 'sophia.jimenez@gmail.com', NULL, '2026-01-24 05:13:04', 'N/A', 1, 1, 1, 1, 1),
(93, '2026-37633', '40085808009', 'Adrian Paul', 'Cruz', 'Evangelista', 'New Student', 'male', 'Grade 1', '', '2018-02-14', 'Catholic', 'Meycauayan, Bulacan', 6, '92 Ilang-Ilang St., Brgy. Iba, Meycauayan, Bulacan', NULL, NULL, NULL, NULL, 'Benjie Evangelista', 'Financial Analyst', '09181110018', 'Lourdes Evangelista', 'Quality Analyst', '09181110019', 'Benjie Evangelista', 'Financial Analyst', '09181110018', 'approved', 'QG3009', '09181110018', 'adrian.evangelista@gmail.com', NULL, '2026-01-24 05:16:07', 'N/A', 1, 1, 1, 1, 1),
(94, '2026-02678', '40085808008', 'Hannah Grace', 'Bautista', 'Domingo', 'New Student', 'female', 'Grade 1', '', '2018-07-30', 'Catholic', 'Meycauayan, Bulacan', 6, 'Unit 11, Riverside Compound, Brgy. Malhacan, Meycauayan, Bulacan', 'Central Luzon', 'Bulacan', 'City of Meycauayan', 'Malhacan', 'Joel Domingo', 'Pilot', '09181110016', 'Cynthia Domingo', 'Office Staff', '09181110017', 'Cynthia Domingo', 'Office Staff', '09181110017', 'approved', 'QG3008', '09181110016', 'hannah.domingo@gmail.com', NULL, '2026-01-24 05:12:41', NULL, 0, 0, 0, 0, 0),
(95, '2026-06420', '40085808007', 'Stephen Mark', 'Torres', 'Lopez', 'New Student', 'male', 'Grade 1', '', '2018-03-08', 'Catholic', 'Meycauayan, Bulacan', 6, '19 P. Burgos St., Brgy. Langka, Meycauayan, Bulacan', 'Central Luzon', 'Bulacan', 'City of Meycauayan', 'Langka', 'Arthur Lopez', 'Carpenter', '09181110014', 'Janet Lopez', 'Housewife', '09181110015', 'Arthur Lopez', 'Carpenter', '09181110014', 'approved', 'QG3007', '09181110014', 'stephen.lopez@gmail.com', NULL, '2026-01-24 05:12:39', NULL, 0, 0, 0, 0, 0),
(96, '2026-52670', '40085808006', 'Nicole Andrea', 'Perez', 'Manalo', 'New Student', 'female', 'Grade 1', '', '2018-05-26', 'Christian', 'Meycauayan, Bulacan', 6, 'Blk 8 Lot 3, Golden Fields Subd., Brgy. Pantoc, Meycauayan, Bulacan', 'Central Luzon', 'Bulacan', 'City of Meycauayan', 'Pantoc', 'Samuel Manalo', 'Factory Worker', '09181110012', 'Liza Manalo', 'Housewife', '09181110013', 'Liza Manalo', 'Housewife', '09181110013', 'approved', 'QG3006', '09181110012', 'nicole.manalo@gmail.com', NULL, '2026-01-24 05:12:31', NULL, 0, 0, 0, 0, 0),
(98, '2026-31371', '40085808144', 'Michael Vincent', 'Uy', 'Ong', 'New Student', 'male', 'Grade 1', '', '2018-01-17', 'Catholic', 'Meycauayan, Bulacan', 6, '88 Orchid St., Brgy. Iba, Meycauayan, Bulacan', 'Central Luzon', 'Bulacan', 'City of Meycauayan', 'Iba', 'Patrick Ong', 'Business Owner', '09181110007', 'Helen Uy', 'Accountant', '09181110008', 'Patrick Ong', 'Business Owner', '09181110007', 'approved', 'QG3004', '09181110007', 'michael.ong@gmail.com', NULL, '2026-01-24 05:12:09', NULL, 0, 0, 0, 0, 0),
(99, '2026-74343', '40085808143', 'Bea Louise', 'Santiago', 'Navarro', 'New Student', 'female', 'Grade 1', '', '2018-06-21', 'Christian', 'Meycauayan, Bulacan', 6, 'Unit 7, San Jose Compound, Brgy. Malhacan, Meycauayan, Bulacan', 'Central Luzon', 'Bulacan', 'City of Meycauayan', 'Malhacan', 'Paolo Navarro', 'Warehouse Staff', '09181110005', 'Cristina Santiago', 'Office Clerk', '09181110006', 'Cristina Santiago', 'Office Clerk', '09181110006', 'approved', 'QG3003', '09181110005', 'bea.navarro@gmail.com', NULL, '2026-01-24 05:12:03', NULL, 0, 0, 0, 0, 0),
(100, '2026-35813', '40085808142', 'John Carlo', 'Fajardo', 'Alonzo', 'New Student', 'male', 'Grade 1', '', '2018-02-09', 'Catholic', 'Meycauayan, Bulacan', 6, '19 Bonifacio St., Brgy. Langka, Meycauayan, Bulacan', 'Central Luzon', 'Bulacan', 'City of Meycauayan', 'Langka', 'Wilson Alonzo', 'Driver', '09181110003', 'Marites Fajardo', 'Vendor', '09181110004', 'Wilson Alonzo', 'Driver', '09181110003', 'approved', 'QG3002', '09181110003', 'john.alonzo@gmail.com', NULL, '2026-01-24 05:11:59', NULL, 0, 0, 0, 0, 0),
(101, '2026-62962', '40085808141', 'Alyssa Mae', 'Romero', 'Velasco', 'New Student', 'female', 'Grade 1', '', '2018-04-15', 'Catholic', 'Meycauayan, Bulacan', 6, 'Blk 6 Lot 10, Villa Elena Subd., Brgy. Pantoc, Meycauayan, Bulacan', 'Central Luzon', 'Bulacan', 'City of Meycauayan', 'Pantoc', 'Victor Velasco', 'Electrician', '09181110001', 'Gina Romero', 'Housewife', '09181110002', 'Gina Romero', 'Housewife', '09181110002', 'approved', 'QG3001', '09181110001', 'alyssa.velasco@gmail.com', NULL, '2026-01-24 05:11:52', NULL, 0, 0, 0, 0, 0),
(102, '2026-16480', '40085808020', 'Kim Nicole', 'Santos', 'Zulueta', 'New Student', 'female', 'Grade 1', '', '2018-07-18', 'Christian', 'Meycauayan, Bulacan', 6, '26 Bonifacio St., Brgy. Iba, Meycauayan, Bulacan', 'Central Luzon', 'Bulacan', 'City of Meycauayan', 'Iba', 'Carlo Zulueta', 'Sales Executive', '09181110040', 'Marissa Zulueta', 'Housewife', '09181110041', 'Marissa Zulueta', 'Housewife', '09181110041', 'approved', 'QG3020', '09181110040', 'kim.zulueta@gmail.com', NULL, '2026-01-24 05:09:04', NULL, 0, 0, 0, 0, 0),
(103, '2026-04491', '51234567010', 'Daniel Ryan', 'Flores', 'Ortega', 'New Student', 'male', 'Grade 2', '', '2018-06-15', 'Roman Catholic', 'Meycauayan City, Bulacan', 7, '60 Zamora St., Brgy. Pandayan, Meycauayan, Bulacan', NULL, NULL, NULL, NULL, 'Rey Ortega', 'Tricycle Driver', '09170000019', 'Cherry Ortega', 'Vendor', '09170000020', 'Cherry Ortega', 'Vendor', '09170000020', 'approved', 'Q170001', '09170000019', 'd.ortega@gmail.com', NULL, '2026-01-24 06:46:15', 'N/A', 1, 1, 1, 1, 1),
(104, '2026-30794', '51234567009', 'Princess Mae', 'Ramos', 'Navarro', 'New Student', 'female', 'Grade 2', '', '2018-06-15', 'Roman Catholic', 'Meycauayan City, Bulacan', 7, '24 Pacheco St., Brgy. Saluysoy, Meycauayan, Bulacan', 'Central Luzon', 'Bulacan', 'City of Meycauayan', 'Saluysoy', 'Joel Navarro', 'Maintenance Staff', '09170000017', 'Teresa Navarro', 'Laundry Worker', '09170000018', 'Teresa Navarro', 'Laundry Worker', '09170000018', 'approved', 'Q169001', '09170000017', 'p.navarro@gmail.com', NULL, '2026-01-24 06:45:21', NULL, 0, 0, 0, 0, 0),
(105, '2026-13017', '51234567008', 'John Steven', 'Cruz', 'Mendoza', 'New Student', 'male', 'Grade 2', '', '2018-06-15', 'Roman Catholic', 'Meycauayan City, Bulacan', 7, '9 Bonifacio St., Brgy. Iba, Meycauayan, Bulacan', 'Central Luzon', 'Bulacan', 'City of Meycauayan', 'Iba', 'Eric Mendoza', 'Forklift Operator', '09170000015', 'Lorna Mendoza', 'Store Assistant', '09170000016', 'Lorna Mendoza', 'Store Assistant', '09170000016', 'approved', 'Q168001', '09170000015', 'j.mendoza@gmail.com', NULL, '2026-01-24 06:45:16', NULL, 0, 0, 0, 0, 0),
(106, '2026-51379', '51234567007', 'Nicole Faith', 'Santos', 'Lopez', 'New Student', 'female', 'Grade 2', '', '2018-06-15', 'Roman Catholic', 'Meycauayan City, Bulacan', 7, '18 Luna St., Brgy. Perez, Meycauayan, Bulacan', NULL, NULL, NULL, NULL, 'Ricardo Lopez', 'Delivery Rider', '09170000013', 'Alma Lopez', 'Housewife', '09170000014', 'Alma Lopez', 'Housewife', '09170000014', 'approved', 'Q167001', '09170000013', 'n.lopez@gmail.com', NULL, '2026-01-24 08:03:16', 'N/A', 1, 1, 1, 1, 1),
(107, '2026-81685', '51234567006', 'Patrick Louie', 'Cruz', 'Jimenez', 'New Student', 'male', 'Grade 2', '', '2018-06-15', 'Roman Catholic', 'Meycauayan City, Bulacan', 7, '55 Mabini St., Brgy. Malhacan, Meycauayan, Bulacan', 'Central Luzon', 'Bulacan', 'City of Meycauayan', 'Malhacan', 'Ben Jimenez', 'Machine Operator', '09170000011', 'Rowena Jimenez', 'Factory Worker', '09170000012', 'Rowena Jimenez', 'Factory Worker', '09170000012', 'approved', 'Q166001', '09170000011', 'p.jimenez@gmail.com', NULL, '2026-01-24 06:45:06', NULL, 0, 0, 0, 0, 0),
(108, '2026-89672', '51234567005', 'Kevin Mark', 'Flores', 'Ilagan', 'New Student', 'male', 'Grade 2', '', '2018-06-15', 'Roman Catholic', 'Meycauayan City, Bulacan', 7, '10 Rizal St., Brgy. Camalig, Meycauayan, Bulacan', 'Central Luzon', 'Bulacan', 'City of Meycauayan', 'Camalig', 'Ramon Ilagan', 'Warehouse Staff', '09170000009', 'Joy Ilagan', 'Saleslady', '09170000010', 'Joy Ilagan', 'Saleslady', '09170000010', 'approved', 'Q165001', '09170000009', 'k.ilagan@gmail.com', NULL, '2026-01-24 06:44:59', NULL, 0, 0, 0, 0, 0),
(109, '2026-23241', '51234567004', 'Sofia Anne', 'Ramos', 'Hernandez', 'New Student', 'female', 'Grade 2', '', '2018-06-15', 'Roman Catholic', 'Meycauayan City, Bulacan', 7, '41 Zamora St., Brgy. Pandayan, Meycauayan, Bulacan', NULL, NULL, NULL, NULL, 'Joel Hernandez', 'Security Guard', '09170000007', 'Diana Hernandez', 'Seamstress', '09170000008', 'Diana Hernandez', 'Seamstress', '09170000008', 'approved', 'Q164001', '09170000007', 's.hernandez@gmail.com', NULL, '2026-01-24 08:08:53', 'N/A', 1, 1, 1, 1, 1),
(110, '2026-55310', '51234567003', 'Carlo James', 'Cruz', 'Garcia', 'New Student', 'male', 'Grade 2', '', '2018-06-15', 'Roman Catholic', 'Meycauayan City, Bulacan', 7, '29 Pacheco St., Brgy. Saluysoy, Meycauayan, Bulacan', NULL, NULL, NULL, NULL, 'Allan Garcia', 'Electrician', '09170000005', 'Mercy Garcia', 'Office Clerk', '09170000006', 'Mercy Garcia', 'Office Clerk', '09170000006', 'approved', 'Q163001', '09170000005', 'c.garcia@gmail.com', NULL, '2026-01-24 08:10:38', 'N/A', 1, 1, 1, 1, 1),
(111, '2026-15333', '51234567002', 'Angela Mae', 'Mendoza', 'Flores', 'New Student', 'female', 'Grade 2', '', '2018-06-15', 'Roman Catholic', 'Meycauayan City, Bulacan', 7, '6 Bonifacio St., Brgy. Iba, Meycauayan, Bulacan', NULL, NULL, NULL, NULL, 'Victor Flores', 'Driver', '09170000003', 'Lani Flores', 'Vendor', '09170000004', 'Lani Flores', 'Vendor', '09170000004', 'approved', 'Q162001', '09170000003', 'a.flores@gmail.com', NULL, '2026-01-24 08:12:23', 'N/A', 1, 1, 1, 1, 1),
(112, '2026-18613', '51234567001', 'Bryan Paul', 'Santos', 'Enriquez', 'New Student', 'male', 'Grade 2', '', '2018-06-15', 'Roman Catholic', 'Meycauayan City, Bulacan', 7, '14 Luna St., Brgy. Perez, Meycauayan, Bulacan', NULL, NULL, NULL, NULL, 'Dennis Enriquez', 'Construction Worker', '09170000001', 'Susan Enriquez', 'Housekeeper', '09170000002', 'Susan Enriquez', 'Housekeeper', '09170000002', 'approved', 'Q161001', '09170000001', 'b.enriquez@gmail.com', NULL, '2026-01-24 08:14:02', 'N/A', 1, 1, 1, 1, 1),
(118, '2026-68003', '61234567010', 'Joshua Mark', 'Flores', 'Abad', 'New Student', 'male', 'Grade 3', '', '2017-06-15', 'Roman Catholic', 'Meycauayan City, Bulacan', 8, 'Blk 4 Lot 18, Villa Mercedes Subd., Brgy. Camalig, Meycauayan, Bulacan', NULL, NULL, NULL, NULL, 'Nestor Abad', 'Welder', '09180000020', 'Mercy Abad', 'Housewife', '09180000021', 'Nestor Abad', 'Welder', '09180000020', 'approved', 'Q190001', '09180000020', 'j.abad@gmail.com', NULL, '2026-01-24 08:29:54', 'N/A', 1, 1, 1, 1, 1),
(119, '2026-22943', '61234567009', 'Marian Louise', 'Dizon', 'Ponce', 'New Student', 'female', 'Grade 3', '', '2017-06-15', 'Roman Catholic', 'Meycauayan City, Bulacan', 8, '58 Gumamela St., Brgy. Iba, Meycauayan, Bulacan', NULL, NULL, NULL, NULL, 'Jun Ponce', 'Tricycle Driver', '09180000018', 'Elsa Ponce', 'Vendor', '09180000019', 'Elsa Ponce', 'Vendor', '09180000019', 'approved', 'Q189001', '09180000018', 'm.ponce@gmail.com', NULL, '2026-01-24 08:33:20', 'N/A', 1, 1, 1, 1, 1),
(120, '2026-38818', '61234567008', 'Aaron Joseph', 'Tejada', 'Ramos', 'New Student', 'male', 'Grade 3', '', '2017-06-15', 'Roman Catholic', 'Meycauayan City, Bulacan', 8, 'Unit 13, Villa Paz Compound, Brgy. Malhacan, Meycauayan, Bulacan', NULL, NULL, NULL, NULL, 'Ronnie Ramos', 'Warehouse Helper', '09180000015', 'Celia Ramos', 'Laundry Worker', '09180000016', 'Mario Ramos', 'Security Guard', '09180000017', 'approved', 'Q188001', '09180000015', 'a.ramos@gmail.com', NULL, '2026-01-24 08:36:18', 'N/A', 1, 1, 1, 1, 1),
(121, '2026-93730', '61234567007', 'Julia Anne', 'Santos', 'Mercado', 'New Student', 'female', 'Grade 3', '', '2017-06-15', 'Roman Catholic', 'Meycauayan City, Bulacan', 8, '32 Bonifacio St., Brgy. Langka, Meycauayan, Bulacan', NULL, NULL, NULL, NULL, 'Oscar Mercado', 'Delivery Driver', '09180000013', 'Vilma Mercado', 'Vendor', '09180000014', 'Oscar Mercado', 'Delivery Driver', '09180000013', 'approved', 'Q187001', '09180000013', 'j.mercado@gmail.com', NULL, '2026-01-24 08:39:38', 'N/A', 1, 1, 1, 1, 1),
(122, '2026-45440', '61234567006', 'Kevin Andre', 'Cruz', 'Villamor', 'New Student', 'male', 'Grade 3', '', '2017-06-15', 'Roman Catholic', 'Meycauayan City, Bulacan', 8, 'Blk 10 Lot 6, San Isidro Subd., Brgy. Pantoc, Meycauayan, Bulacan', NULL, NULL, NULL, NULL, 'Leo Villamor', 'Technician', '09180000011', 'Rosemarie Villamor', 'Housewife', '09180000012', 'Rosemarie Villamor', 'Housewife', '09180000012', 'approved', 'Q186001', '09180000011', 'k.villamor@gmail.com', NULL, '2026-01-24 08:52:43', 'N/A', 1, 1, 1, 1, 1),
(123, '2026-07337', '61234567005', 'Sophia Mae', 'Tolentino', 'Jimenez', 'New Student', 'female', 'Grade 3', '', '2017-06-15', 'Roman Catholic', 'Meycauayan City, Bulacan', 8, 'Blk 1 Lot 3, Villa Teresa Subd., Brgy. Camalig, Meycauayan, Bulacan', NULL, NULL, NULL, NULL, 'Carlo Jimenez', 'Sales Agent', '09180000009', 'Marissa Tolentino', 'Office Staff', '09180000010', 'Marissa Tolentino', 'Office Staff', '09180000010', 'approved', 'Q185001', '09180000009', 's.jimenez@gmail.com', NULL, '2026-01-24 08:54:43', 'N/A', 1, 1, 1, 1, 1),
(128, '2026-03458', '40100000021', 'Renz Mark', 'Cordero', 'Alonzo', 'New Student', 'male', 'Grade 10', '', '2010-06-15', 'Roman Catholic', 'Meycauayan City, Bulacan', 15, '29 Narra St., Brgy. Perez, Meycauayan, Bulacan', NULL, NULL, NULL, NULL, 'Nelson Alonzo', 'Machine Operator', '09181230001', 'Clarissa Cordero', 'Sales Clerk', '09181230002', 'Clarissa Cordero', 'Sales Clerk', '09181230002', 'approved', 'Q10321', '09181230003', 'renz.alonzo10@gmail.com', NULL, '2026-01-24 09:04:49', 'N/A', 1, 1, 0, 1, 1),
(129, '2026-68200', '400858070310', 'Shaina Pearl', 'Cruz', 'Natividad', 'New Student', 'female', 'Grade 4', '', '2016-01-28', 'Roman Catholic', 'Meycauayan City, Bulacan', 9, '69 Rosal St., Brgy. Saluysoy, Meycauayan, Bulacan', NULL, NULL, NULL, NULL, 'Albert Natividad', 'Forklift Operator', '09123456728', 'Veronica Natividad', 'Sales Lady', '09123456729', 'Veronica Natividad', 'Sales Lady', '09123456729', 'approved', 'Q401210', '09123456730', 'shaina.natividad@gmail.com', NULL, '2026-01-24 09:19:44', 'N/A', 1, 1, 1, 1, 1),
(130, '2026-32358', '40100000023', 'Dominic Paolo', 'Reyes', 'Javier', 'New Student', 'male', 'Grade 10', '', '2010-06-15', 'Roman Catholic', 'Meycauayan City, Bulacan', 15, '66 Rosal St., Brgy. Sto. Niño, Meycauayan, Bulacan', NULL, NULL, NULL, NULL, 'Albert Javier', 'Delivery Rider', '09181230007', 'Rowena Reyes', 'Vendor', '09181230008', 'Albert Javier', 'Delivery Rider', '09181230007', 'approved', 'Q10323', '09181230009', 'dominic.javier@gmail.com', NULL, '2026-01-24 09:21:51', 'N/A', 1, 1, 1, 1, 1),
(131, '2026-30420', '400858070309', 'Ian Christopher', 'De Leon', 'Razon', 'New Student', 'male', 'Grade 4', '', '2015-12-05', 'Roman Catholic', 'Meycauayan City, Bulacan', 10, 'Unit 8, San Roque Compound, Brgy. Hulo, Meycauayan, Bulacan', 'Central Luzon', 'Bulacan', 'City of Meycauayan', 'Hulo', 'Henry Razon', 'Delivery Rider', '09123456725', 'Brenda Razon', 'Laundry Shop Owner', '09123456726', 'Henry Razon', 'Delivery Rider', '09123456725', 'approved', 'Q401209', '09123456727', 'ian.razon@gmail.com', NULL, '2026-01-24 09:13:09', NULL, 0, 0, 0, 0, 0),
(132, '2026-10550', '400858070308', 'Clarisse Jean', 'Sy', 'Morado', 'New Student', 'female', 'Grade 4', '', '2015-09-30', 'Roman Catholic', 'Meycauayan City, Bulacan', 9, '102 Orchid St., Brgy. Sto. Niño, Meycauayan, Bulacan', 'Central Luzon', 'Bulacan', 'City of Meycauayan', 'Sto. Niño', 'Alex Morado', 'Sales Manager', '09123456722', 'Linda Morado', 'Office Staff', '09123456723', 'Linda Morado', 'Office Staff', '09123456723', 'approved', 'Q401208', '09123456724', 'clarisse.morado@gmail.com', NULL, '2026-01-24 09:13:04', NULL, 0, 0, 0, 0, 0),
(133, '2026-91967', '400858070307', 'Paul Vincent', 'Gomez', 'Manabat', 'New Student', 'male', 'Grade 4', '', '2016-02-10', 'Roman Catholic', 'Meycauayan City, Bulacan', 9, 'Phase 2 Lot 9, Greenfields Subd., Brgy. Calvario, Meycauayan, Bulacan', 'Central Luzon', 'Bulacan', 'City of Meycauayan', 'Calvario', 'Arnold Manabat', 'Warehouse Supervisor', '09123456719', 'Teresa Manabat', 'Housewife', '09123456720', 'Arnold Manabat', 'Warehouse Supervisor', '09123456719', 'approved', 'Q401207', '09123456721', 'paul.manabat@gmail.com', NULL, '2026-01-24 09:12:52', NULL, 0, 0, 0, 0, 0),
(134, '2026-27406', '400858070306', 'Kyla Mae', 'Villarin', 'Del Rosario', 'New Student', 'female', 'Grade 4', '', '2015-07-22', 'Roman Catholic', 'Meycauayan City, Bulacan', 9, '21 Narra St., Brgy. Perez, Meycauayan, Bulacan', NULL, NULL, NULL, NULL, 'Rodel Del Rosario', 'Security Guard', '09123456716', 'Jocelyn Del Rosario', 'Vendor', '09123456717', 'Jocelyn Del Rosario', 'Vendor', '09123456717', 'approved', 'Q401206', '09123456718', 'kyla.delrosario@gmail.com', NULL, '2026-01-25 23:25:52', 'N/A', 1, 1, 1, 1, 1),
(135, '2026-97012', '400858070305', 'Carlo Miguel', 'Reyes', 'Yabut', 'New Student', 'male', 'Grade 4', '', '2015-03-18', 'Roman Catholic', 'Meycauayan City, Bulacan', 9, '73 Camia St., Brgy. Saluysoy, Meycauayan, Bulacan', NULL, NULL, NULL, NULL, 'Tito Yabut', 'Mechanic', '09123456713', 'Nancy Reyes', 'Store Clerk', '09123456714', 'Tito Yabut', 'Mechanic', '09123456713', 'approved', 'Q401205', '09123456715', 'carlo.yabut@gmail.com', NULL, '2026-01-25 23:43:10', 'N/A', 1, 1, 1, 1, 1),
(136, '2026-52486', '400858070304', 'Danielle Rose', 'Magsaysay', 'Estrella', 'New Student', 'female', 'Grade 4', '', '2015-11-09', 'Roman Catholic', 'Meycauayan City, Bulacan', 10, 'Unit 4, Mabini Compound, Brgy. Hulo, Meycauayan, Bulacan', 'Central Luzon', 'Bulacan', 'City of Meycauayan', 'Hulo', 'Paulo Estrella', 'Office Clerk', '09123456710', 'Irene Magsaysay', 'Teacher', '09123456711', 'Irene Magsaysay', 'Teacher', '09123456711', 'approved', 'Q401204', '09123456712', 'danielle.estrella@gmail.com', NULL, '2026-01-24 09:12:38', NULL, 0, 0, 0, 0, 0),
(137, '2026-81599', '400858070303', 'Vincent Paul', 'Soriano', 'Balagtas', 'New Student', 'male', 'Grade 4', '', '2016-01-15', 'Roman Catholic', 'Meycauayan City, Bulacan', 9, '41 Rizal St., Brgy. Sto. Niño, Meycauayan, Bulacan', NULL, NULL, NULL, NULL, 'Rey Balagtas', 'Construction Worker', '09123456707', 'Alma Soriano', 'Seamstress', '09123456708', 'Rey Balagtas', 'Construction Worker', '09123456707', 'approved', 'Q401203', '09123456709', 'vincent.balagtas@gmail.com', NULL, '2026-01-25 23:52:03', 'N/A', 1, 1, 1, 1, 1),
(138, '2026-97370', '400858070302', 'Rhea Camille', 'Ortiz', 'Navarro', 'New Student', 'female', 'Grade 4', '', '2015-08-21', 'Roman Catholic', 'Meycauayan City, Bulacan', 9, 'Phase 3 Lot 9, Green Meadows Subd., Brgy. Calvario, Meycauayan, Bulacan', 'Central Luzon', 'Bulacan', 'City of Meycauayan', 'Calvario', 'Manny Navarro', 'Driver', '09123456704', 'Lourdes Ortiz', 'Housekeeper', '09123456705', 'Lourdes Ortiz', 'Housekeeper', '09123456705', 'approved', 'Q401202', '09123456706', 'rhea.navarro@gmail.com', NULL, '2026-01-24 09:12:30', NULL, 0, 0, 0, 0, 0),
(139, '2026-52304', '400858070301', 'Elijah Nathan', 'Reyes', 'Aquino', 'New Student', 'male', 'Grade 4', '', '2015-06-12', 'Roman Catholic', 'Meycauayan City, Bulacan', 9, '22 Sampaguita St., Brgy. Perez, Meycauayan, Bulacan', NULL, NULL, NULL, NULL, 'Daniel Aquino', 'Electrician', '09123456701', 'Cherry Reyes', 'Vendor', '09123456702', 'Daniel Aquino', 'Electrician', '09123456701', 'approved', 'Q401201', '09123456703', 'elijah.aquino@gmail.com', NULL, '2026-01-25 23:55:34', 'N/A', 1, 1, 1, 1, 1),
(143, '2026-01457', '40123456010', 'Alyssa Kate', 'Mendoza', 'Herrera', 'New Student', 'female', 'Grade 5', '', '2014-04-15', 'Roman Catholic', 'Meycauayan City, Bulacan', 10, '20 Citrine St., Brgy. Pandayan, Meycauayan, Bulacan', 'Central Luzon', 'Bulacan', 'City of Meycauayan', 'Pandayan', 'Victor Herrera', 'Factory Supervisor', '09123456028', 'Maribel Herrera', 'Housewife', '09123456029', 'Maribel Herrera', 'Housewife', '09123456029', 'approved', 'Q402210', '09123456030', 'alyssa.herrera@gmail.com', NULL, '2026-01-26 06:19:07', NULL, 0, 0, 0, 0, 0),
(144, '2026-16121', '40123456009', 'Patrick Ryan', 'Cruz', 'Guevarra', 'New Student', 'male', 'Grade 5', '', '2014-07-29', 'Roman Catholic', 'Meycauayan City, Bulacan', 10, '53 Tourmaline St., Brgy. Saluysoy, Meycauayan, Bulacan', NULL, NULL, NULL, NULL, 'Ben Guevarra', 'Truck Driver', '09123456025', 'Sheila Guevarra', 'Online Seller', '09123456026', 'Sheila Guevarra', 'Online Seller', '09123456026', 'approved', 'Q402209', '09123456027', 'patrick.guevarra@gmail.com', NULL, '2026-01-26 06:39:02', 'N/A', 1, 1, 1, 1, 1),
(145, '2026-15821', '40123456008', 'Lovely Joy', 'Santos', 'Floresca', 'New Student', 'female', 'Grade 5', '', '2014-02-06', 'Roman Catholic', 'Meycauayan City, Bulacan', 10, '8 Amethyst St., Brgy. Iba, Meycauayan, Bulacan', NULL, NULL, NULL, NULL, 'Allan Floresca', 'Sales Agent', '09123456022', 'Rina Floresca', 'Office Staff', '09123456023', 'Rina Floresca', 'Office Staff', '09123456023', 'approved', 'Q402208', '09123456024', 'lovely.floresca@gmail.com', NULL, '2026-01-26 06:40:13', 'N/A', 1, 1, 1, 1, 1),
(146, '2026-11035', '40123456007', 'Nathaniel John', 'Ramos', 'Espiritu', 'New Student', 'male', 'Grade 5', '', '2014-09-18', 'Roman Catholic', 'Meycauayan City, Bulacan', 10, '74 Garnet St., Brgy. Perez, Meycauayan, Bulacan', NULL, NULL, NULL, NULL, 'Ramon Espiritu', 'Electrician', '09123456019', 'Cecilia Espiritu', 'Housewife', '09123456020', 'Cecilia Espiritu', 'Housewife', '09123456020', 'approved', 'Q402207', '09123456021', 'nathaniel.espiritu@gmail.com', NULL, '2026-01-26 06:41:07', 'N/A', 1, 1, 1, 1, 1),
(147, '2026-46344', '40123456006', 'Princess Anne', 'Cruz', 'Dela Peña', 'New Student', 'female', 'Grade 5', '', '2014-11-21', 'Roman Catholic', 'Meycauayan City, Bulacan', 10, '11 Opal St., Brgy. Malhacan, Meycauayan, Bulacan', NULL, NULL, NULL, NULL, 'Jun Dela Peña', 'Forklift Operator', '09123456016', 'Alma Dela Peña', 'Vendor', '09123456017', 'Alma Dela Peña', 'Vendor', '09123456017', 'approved', 'Q402206', '09123456018', 'princess.delapena@gmail.com', NULL, '2026-01-26 06:48:51', 'N/A', 1, 1, 1, 1, 1),
(148, '2026-56283', '40123456005', 'Mark Vincent', 'Bautista', 'Caluag', 'New Student', 'male', 'Grade 5', '', '2014-06-03', 'Roman Catholic', 'Meycauayan City, Bulacan', 10, '36 Topaz St., Brgy. Camalig, Meycauayan, Bulacan', NULL, NULL, NULL, NULL, 'Eric Caluag', 'Warehouse Staff', '09123456013', 'Lorna Caluag', 'Housewife', '09123456014', 'Lorna Caluag', 'Housewife', '09123456014', 'approved', 'Q402205', '09123456015', 'mark.caluag@gmail.com', NULL, '2026-01-26 06:51:02', 'N/A', 1, 1, 1, 1, 1),
(149, '2026-60434', '40123456004', 'Trisha Mae', 'Flores', 'Benitez', 'New Student', 'female', 'Grade 5', '', '2014-08-14', 'Roman Catholic', 'Meycauayan City, Bulacan', 10, '28 Sapphire St., Brgy. Pandayan, Meycauayan, Bulacan', NULL, NULL, NULL, NULL, 'Dan Benitez', 'Machine Operator', '09123456010', 'Mercy Benitez', 'Factory Worker', '09123456011', 'Mercy Benitez', 'Factory Worker', '09123456011', 'approved', 'Q402204', '09123456012', 'trisha.benitez@gmail.com', NULL, '2026-01-26 06:55:54', 'N/A', 1, 1, 1, 1, 1),
(150, '2026-84029', '40123456003', 'John Paul', 'Cruz', 'Abella', 'New Student', 'male', 'Grade 5', '', '2014-01-27', 'Roman Catholic', 'Meycauayan City, Bulacan', 10, '4 Diamond St., Brgy. Saluysoy, Meycauayan, Bulacan', NULL, NULL, NULL, NULL, 'Roger Abella', 'Delivery Driver', '09123456007', 'Nancy Abella', 'Housewife', '09123456008', 'Nancy Abella', 'Housewife', '09123456008', 'approved', 'Q402203', '09123456009', 'john.abella@gmail.com', NULL, '2026-01-26 06:57:05', 'N/A', 1, 1, 1, 1, 1),
(151, '2026-24269', '40123456002', 'Janelle Faith', 'Ramos', 'Zarate', 'New Student', 'female', 'Grade 5', '', '2014-05-09', 'Roman Catholic', 'Meycauayan City, Bulacan', 10, '67 Ruby St., Brgy. Iba, Meycauayan, Bulacan', NULL, NULL, NULL, NULL, 'Arnel Zarate', 'Construction Worker', '09123456004', 'Gina Zarate', 'Vendor', '09123456005', 'Gina Zarate', 'Vendor', '09123456005', 'approved', 'Q402202', '09123456006', 'janelle.zarate@gmail.com', NULL, '2026-01-26 06:59:09', 'N/A', 1, 1, 1, 1, 1),
(152, '2026-30551', '40123456251', 'Andrea Joy', 'Flores', 'Orellana', 'New Student', 'female', 'Grade 6', '', '2013-11-05', 'Roman Catholic', 'Meycauayan City, Bulacan', 11, '25 Onyx St., Brgy. Saluysoy, Meycauayan, Bulacan', NULL, NULL, NULL, NULL, 'Rey Orellana', 'Delivery Rider', '09123456271', 'Cherry Orellana', 'Online Seller', '09123456272', 'Cherry Orellana', 'Online Seller', '09123456272', 'approved', 'Q406251', '09123456273', 'andrea.orellana@gmail.com', NULL, '2026-01-26 07:52:16', 'N/A', 1, 1, 1, 1, 1),
(153, '2026-45481', '40123456250', 'Kevin Bryan', 'Tan', 'Lim', 'New Student', 'male', 'Grade 6', '', '2013-08-26', 'Roman Catholic', 'Meycauayan City, Bulacan', 11, '88 Jade St., Brgy. Malhacan, Meycauayan, Bulacan', NULL, NULL, NULL, NULL, 'Richard Lim', 'Store Supervisor', '09123456268', 'Jenny Lim', 'Cashier', '09123456269', 'Jenny Lim', 'Cashier', '09123456269', 'approved', 'Q406250', '09123456270', 'kevin.lim@gmail.com', NULL, '2026-01-26 07:56:37', 'N/A', 1, 1, 1, 1, 1),
(154, '2026-60149', '40123456249', 'Alyssa Faith', 'Diaz', 'Navarro', 'New Student', 'female', 'Grade 6', '', '2013-03-17', 'Roman Catholic', 'Meycauayan City, Bulacan', 11, '5 Mango St., Brgy. Camalig, Meycauayan, Bulacan', NULL, NULL, NULL, NULL, 'Carlos Navarro', 'Sales Driver', '09123456265', 'Imelda Navarro', 'Housewife', '09123456266', 'Imelda Navarro', 'Housewife', '09123456266', 'approved', 'Q406249', '09123456267', 'alyssa.navarro@gmail.com', NULL, '2026-01-26 08:00:13', 'N/A', 1, 1, 1, 1, 1),
(155, '2026-28474', '40123456248', 'Daniel Joseph', 'Perez', 'Villanueva', 'New Student', 'male', 'Grade 6', '', '2013-10-08', 'Roman Catholic', 'Meycauayan City, Bulacan', 11, '22 Luna St., Brgy. Pandayan, Meycauayan, Bulacan', NULL, NULL, NULL, NULL, 'Leo Villanueva', 'Truck Helper', '09123456262', 'Rowena Villanueva', 'Laundry Aide', '09123456263', 'Rowena Villanueva', 'Laundry Aide', '09123456263', 'approved', 'Q406248', '09123456264', 'daniel.villanueva@gmail.com', NULL, '2026-01-26 08:02:04', 'N/A', 1, 1, 1, 1, 1),
(156, '2026-27756', '40123456247', 'Princess Mae', 'Fernandez', 'Castillo', 'New Student', 'female', 'Grade 6', '', '2013-05-30', 'Roman Catholic', 'Meycauayan City, Bulacan', 11, '61 Rosal St., Brgy. Saluysoy, Meycauayan, Bulacan', NULL, NULL, NULL, NULL, 'Antonio Castillo', 'Forklift Operator', '09123456259', 'Lourdes Castillo', 'Vendor', '09123456260', 'Lourdes Castillo', 'Vendor', '09123456260', 'approved', 'Q406247', '09123456261', 'princess.castillo@gmail.com', NULL, '2026-01-26 08:09:06', 'N/A', 1, 1, 1, 1, 1),
(157, '2026-22353', '40123456246', 'Mark Anthony', 'Aquino', 'Bautista', 'New Student', 'male', 'Grade 6', '', '2013-01-23', 'Roman Catholic', 'Meycauayan City, Bulacan', 11, '17 Narra St., Brgy. Iba, Meycauayan, Bulacan', NULL, NULL, NULL, NULL, 'Nestor Bautista', 'Welder', '09123456256', 'Cecilia Bautista', 'Housewife', '09123456257', 'Cecilia Bautista', 'Housewife', '09123456257', 'approved', 'Q406246', '09123456258', 'mark.bautista@gmail.com', NULL, '2026-01-26 08:12:32', 'N/A', 1, 1, 1, 1, 1),
(158, '2026-01328', '40123456244', 'Ian Christopher', 'De Leon', 'Razon', 'New Student', 'male', 'Grade 6', '', '2013-09-09', 'Roman Catholic', 'Meycauayan City, Bulacan', 11, 'Unit 6, San Roque Compound, Brgy. Hulo, Meycauayan, Bulacan', NULL, NULL, NULL, NULL, 'Henry Razon', 'Security Guard', '09123456250', 'Brenda De Leon', 'Housewife', '09123456251', 'Henry Razon', 'Security Guard', '09123456250', 'approved', 'Q406244', '09123456252', 'ian.razon@gmail.com', NULL, '2026-01-26 08:14:35', 'N/A', 1, 1, 1, 1, 1),
(159, '2026-79170', '40123456241', 'Kyla Mae', 'Villarin', 'Del Rosario', 'New Student', 'female', 'Grade 6', '', '2013-04-18', 'Roman Catholic', 'Meycauayan City, Bulacan', 11, '18 Narra St., Brgy. Perez, Meycauayan, Bulacan', NULL, NULL, NULL, NULL, 'Rodel Del Rosario', 'Driver', '09123456241', 'Jocelyn Villarin', 'Housewife', '09123456242', 'Jocelyn Villarin', 'Housewife', '09123456242', 'approved', 'Q406241', '09123456243', 'kyla.delrosario@gmail.com', NULL, '2026-01-26 08:16:58', 'N/A', 1, 1, 1, 1, 1),
(160, '2026-13541', '40123456243', 'Clarisse Jean', 'Sy', 'Morado', 'New Student', 'female', 'Grade 6', '', '2013-02-11', 'Roman Catholic', 'Meycauayan City, Bulacan', 11, '99 Orchid St., Brgy. Sto. Niño, Meycauayan, Bulacan', NULL, NULL, NULL, NULL, 'Alex Morado', 'Sales Supervisor', '09123456247', 'Linda Sy', 'Office Clerk', '09123456248', 'Linda Sy', 'Office Clerk', '09123456248', 'approved', 'Q406243', '09123456249', 'clarisse.morado@gmail.com', NULL, '2026-01-26 08:19:03', 'N/A', 1, 1, 1, 1, 1),
(161, '2026-94929', '40123456242', 'Paul Vincent', 'Gomez', 'Manabat', 'New Student', 'male', 'Grade 6', '', '2013-06-02', 'Roman Catholic', 'Meycauayan City, Bulacan', 11, 'Phase 2 Lot 6, Greenfields Subd., Brgy. Calvario, Meycauayan, Bulacan', NULL, NULL, NULL, NULL, 'Arnold Manabat', 'Construction Foreman', '09123456244', 'Teresa Gomez', 'Vendor', '09123456245', 'Arnold Manabat', 'Construction Foreman', '09123456244', 'approved', 'Q406242', '09123456246', 'paul.manabat@gmail.com', NULL, '2026-01-26 08:19:53', 'N/A', 1, 1, 1, 1, 1),
(162, '2026-06530', '40134568010', 'Bianca Louise', 'Torres', 'De Leon', 'New Student', 'female', 'Grade 7', '', '2012-12-05', 'Roman Catholic', 'Meycauayan City, Bulacan', 12, '29 Diamond St., Brgy. Camalig, Meycauayan, Bulacan', NULL, NULL, NULL, NULL, 'Victor De Leon', 'Logistics Coordinator', '09145678028', 'Ana De Leon', 'Accounting Clerk', '09145678029', 'Ana De Leon', 'Accounting Clerk', '09145678029', 'approved', 'Q407270', '09145678030', 'bianca.deleon@gmail.com', NULL, '2026-01-26 09:41:19', 'N/A', 1, 1, 1, 1, 1),
(163, '2026-42132', '40134568009', 'John Lloyd', 'Molina', 'Alvarez', 'New Student', 'male', 'Grade 7', '', '2012-02-09', 'Roman Catholic', 'Meycauayan City, Bulacan', 13, '56 Sapphire St., Brgy. Pandayan, Meycauayan, Bulacan', NULL, NULL, NULL, NULL, 'Rene Alvarez', 'Maintenance Supervisor', '09145678025', 'Corazon Alvarez', 'Office Aide', '09145678026', 'Corazon Alvarez', 'Office Aide', '09145678026', 'approved', 'Q407269', '09145678027', 'john.alvarez@gmail.com', NULL, '2026-01-26 09:43:00', 'N/A', 1, 1, 1, 1, 1),
(164, '2026-65975', '40134568008', 'Hannah Rose', 'Salazar', 'Ortega', 'New Student', 'female', 'Grade 7', '', '2012-08-11', 'Roman Catholic', 'Meycauayan City, Bulacan', 12, '7 Pearl St., Brgy. Saluysoy, Meycauayan, Bulacan', NULL, NULL, NULL, NULL, 'Oscar Ortega', 'Tricycle Driver', '09145678022', 'Vilma Ortega', 'Vendor', '09145678023', 'Vilma Ortega', 'Vendor', '09145678023', 'approved', 'Q407268', '09145678024', 'hannah.ortega@gmail.com', NULL, '2026-01-26 09:45:09', 'N/A', 1, 1, 1, 1, 0),
(165, '2026-39854', '40134568007', 'Kyle Vincent', 'Mercado', 'Pineda', 'New Student', 'male', 'Grade 7', '', '2012-04-27', 'Roman Catholic', 'Meycauayan City, Bulacan', 13, '41 Ruby St., Brgy. Iba, Meycauayan, Bulacan', NULL, NULL, NULL, NULL, 'Jun Pineda', 'Machine Operator', '09145678019', 'Marites Pineda', 'Housewife', '09145678020', 'Marites Pineda', 'Housewife', '09145678020', 'approved', 'Q407267', '09145678021', 'kyle.pineda@gmail.com', NULL, '2026-01-26 09:46:17', 'N/A', 1, 1, 1, 1, 0),
(166, '2026-82498', '40134568006', 'Sophia Anne', 'Herrera', 'Dizon', 'New Student', 'female', 'Grade 7', '', '2012-10-03', 'Roman Catholic', 'Meycauayan City, Bulacan', 12, '19 Emerald St., Brgy. Perez, Meycauayan, Bulacan', NULL, NULL, NULL, NULL, 'Allan Dizon', 'Forklift Operator', '09145678016', 'Grace Dizon', 'Housewife', '09145678017', 'Grace Dizon', 'Housewife', '09145678017', 'approved', 'Q407266', '09145678018', 'sophia.dizon@gmail.com', NULL, '2026-01-26 09:48:30', 'N/A', 1, 1, 1, 1, 0),
(167, '2026-99171', '40134568005', 'Noah Lucas', 'Cruz', 'Sevilla', 'New Student', 'male', 'Grade 7', '', '2012-07-15', 'Roman Catholic', 'Meycauayan City, Bulacan', 12, 'Blk 5 Lot 7, Villa Teresa Subd., Brgy. Camalig, Meycauayan, Bulacan', NULL, NULL, NULL, NULL, 'Marco Sevilla', 'Civil Engineer', '09145678013', 'Pia Cruz', 'Office Clerk', '09145678014', 'Marco Sevilla', 'Civil Engineer', '09145678013', 'approved', 'Q407265', '09145678015', 'noah.sevilla@gmail.com', NULL, '2026-01-26 09:49:14', 'N/A', 1, 1, 1, 1, 0),
(168, '2026-79611', '40134568004', 'Francine Ella', 'Perez', 'Gatchalian', 'New Student', 'female', 'Grade 7', '', '2012-01-21', 'Roman Catholic', 'Meycauayan City, Bulacan', 13, '82 Ilang-Ilang St., Brgy. Iba, Meycauayan, Bulacan', NULL, NULL, NULL, NULL, 'Samuel Gatchalian', 'Warehouse Supervisor', '09145678010', 'Rina Perez', 'Store Cashier', '09145678011', 'Rina Perez', 'Store Cashier', '09145678011', 'approved', 'Q407264', '09145678012', 'francine.gatchalian@gmail.com', NULL, '2026-01-26 09:49:58', 'N/A', 1, 1, 1, 1, 0),
(169, '2026-49576', '40134568003', 'Earl John', 'Bautista', 'Sagun', 'New Student', 'male', 'Grade 7', '', '2012-09-12', 'Roman Catholic', 'Meycauayan City, Bulacan', 12, 'Unit 10, Riverside Compound, Brgy. Malhacan, Meycauayan, Bulacan', NULL, NULL, NULL, NULL, 'Dennis Sagun', 'Delivery Driver', '09145678007', 'Myrna Bautista', 'Housekeeper', '09145678008', 'Dennis Sagun', 'Delivery Driver', '09145678007', 'approved', 'Q407263', '09145678009', 'earl.sagun@gmail.com', NULL, '2026-01-26 09:51:21', 'N/A', 1, 1, 1, 1, 0),
(170, '2026-21013', '40134568002', 'Krisha Ann', 'Ramos', 'Villaseñor', 'New Student', 'female', 'Grade 7', '', '2012-06-07', 'Roman Catholic', 'Meycauayan City, Bulacan', 12, '35 P. Burgos St., Brgy. Langka, Meycauayan, Bulacan', NULL, NULL, NULL, NULL, 'Lito Villaseñor', 'Factory Technician', '09145678004', 'Fe Ramos', 'Office Staff', '09145678005', 'Fe Ramos', 'Office Staff', '09145678005', 'approved', 'Q407262', '09145678006', 'krisha.villasenor@gmail.com', NULL, '2026-01-26 09:52:32', 'N/A', 1, 1, 1, 1, 0),
(171, '2026-16637', '40134568001', 'Jerome Patrick', 'Mendoza', 'Catapang', 'New Student', 'male', 'Grade 7', '', '2012-03-18', 'Roman Catholic', 'Meycauayan City, Bulacan', 13, 'Blk 7 Lot 4, Golden Acres Subd., Brgy. Pantoc, Meycauayan, Bulacan', NULL, NULL, NULL, NULL, 'Victor Catapang', 'Construction Foreman', '09145678001', 'Alice Mendoza', 'Housewife', '09145678002', 'Victor Catapang', 'Construction Foreman', '09145678001', 'approved', 'Q407261', '09145678003', 'jerome.catapang@gmail.com', NULL, '2026-01-26 09:55:24', 'N/A', 1, 1, 1, 1, 0),
(173, '2026-04231', '40145678010', 'Maria Angelica', 'Razon', 'Padilla', 'New Student', 'female', 'Grade 8', '', '2011-12-10', 'Roman Catholic', 'Meycauayan City, Bulacan', 13, '10 Orchid St., Brgy. Pandayan, Meycauayan, Bulacan', NULL, NULL, NULL, NULL, 'Ruel Padilla', 'Operations Supervisor', '09156789028', 'Lorna Padilla', 'Office Aide', '09156789029', 'Lorna Padilla', 'Office Aide', '09156789029', 'approved', 'Q408290', '09156789030', 'angelica.padilla@gmail.com', NULL, '2026-01-26 11:55:31', 'N/A', 1, 1, 1, 1, 0),
(174, '2026-30964', '40145678009', 'Adrian Lee', 'Ong', 'Chua', 'New Student', 'male', 'Grade 8', '', '2011-08-27', 'Roman Catholic', 'Meycauayan City, Bulacan', 13, '91 Lotus St., Brgy. Saluysoy, Meycauayan, Bulacan', NULL, NULL, NULL, NULL, 'Henry Chua', 'Business Owner', '09156789025', 'Susan Chua', 'Bookkeeper', '09156789026', 'Susan Chua', 'Bookkeeper', '09156789026', 'approved', 'Q408289', '09156789027', 'adrian.chua@gmail.com', NULL, '2026-01-26 11:56:35', 'N/A', 1, 1, 1, 1, 0),
(175, '2026-99883', '40145678008', 'Paolo Miguel', 'Gutierrez', 'Velasco', 'New Student', 'male', 'Grade 8', '', '2011-02-16', 'Roman Catholic', 'Meycauayan City, Bulacan', 14, '72 Bronze St., Brgy. Iba, Meycauayan, Bulacan', NULL, NULL, NULL, NULL, 'Ben Velasco', 'Machine Technician', '09156789022', 'Linda Velasco', 'Office Staff', '09156789023', 'Linda Velasco', 'Office Staff', '09156789023', 'approved', 'Q408288', '09156789024', 'paolo.velasco@gmail.com', NULL, '2026-01-26 12:06:22', 'N/A', 1, 1, 1, 1, 0),
(176, '2026-14990', '40145678007', 'Trisha Mae', 'Castro', 'Soriano', 'New Student', 'female', 'Grade 8', '', '2011-06-08', 'Roman Catholic', 'Meycauayan City, Bulacan', 13, '14 Silver St., Brgy. Perez, Meycauayan, Bulacan', NULL, NULL, NULL, NULL, 'Ariel Soriano', 'Security Guard', '09156789019', 'Nena Soriano', 'Vendor', '09156789020', 'Nena Soriano', 'Vendor', '09156789020', 'approved', 'Q408287', '09156789021', 'trisha.soriano@gmail.com', NULL, '2026-01-26 12:07:35', 'N/A', 1, 1, 1, 1, 0),
(177, '2026-25323', '40145678006', 'Ryan Joseph', 'Pascual', 'Romero', 'New Student', 'male', 'Grade 8', '', '2011-11-02', 'Roman Catholic', 'Meycauayan City, Bulacan', 13, '63 Gold St., Brgy. Malhacan, Meycauayan, Bulacan', NULL, NULL, NULL, NULL, 'Edgar Romero', 'Delivery Supervisor', '09156789016', 'Helen Romero', 'Sales Clerk', '09156789017', 'Helen Romero', 'Sales Clerk', '09156789017', 'approved', 'Q408286', '09156789018', 'ryan.romero@gmail.com', NULL, '2026-01-26 12:08:22', 'N/A', 1, 1, 1, 1, 0),
(178, '2026-98241', '40145678005', 'Aira Mae', 'Santos', 'Palomares', 'New Student', 'female', 'Grade 8', '', '2011-03-21', 'Roman Catholic', 'Meycauayan City, Bulacan', 14, '71 Camia St., Brgy. Saluysoy, Meycauayan, Bulacan', NULL, NULL, NULL, NULL, 'Edwin Palomares', 'Production Operator', '09156789013', 'Nora Santos', 'Housewife', '09156789014', 'Nora Santos', 'Housewife', '09156789014', 'approved', 'Q408285', '09156789015', 'aira.palomares@gmail.com', NULL, '2026-01-26 12:09:25', 'N/A', 1, 1, 1, 1, 0),
(179, '2026-00512', '40145678004', 'John Matthew', 'Velasquez', 'Ison', 'New Student', 'male', 'Grade 8', '', '2011-09-14', 'Roman Catholic', 'Meycauayan City, Bulacan', 13, 'Unit 1, Mabuhay Compound, Brgy. Hulo, Meycauayan, Bulacan', NULL, NULL, NULL, NULL, 'Patrick Ison', 'Forklift Operator', '09156789010', 'Melissa Velasquez', 'Office Clerk', '09156789011', 'Patrick Ison', 'Forklift Operator', '09156789010', 'approved', 'Q408284', '09156789012', 'john.ison@gmail.com', NULL, '2026-01-26 12:10:52', 'N/A', 1, 1, 1, 1, 0),
(180, '2026-68993', '40145678003', 'Camille Joy', 'Cruz', 'Alcantara', 'New Student', 'female', 'Grade 8', '', '2011-01-30', 'Roman Catholic', 'Meycauayan City, Bulacan', 14, '60 Rizal Ave., Brgy. Sto. Niño, Meycauayan, Bulacan', NULL, NULL, NULL, NULL, 'Roland Alcantara', 'Electrical Foreman', '09156789007', 'Teresa Cruz', 'Housewife', '09156789008', 'Teresa Cruz', 'Housewife', '09156789008', 'approved', 'Q408283', '09156789009', 'camille.alcantara@gmail.com', NULL, '2026-01-26 12:13:15', 'N/A', 1, 1, 1, 1, 0),
(181, '2026-85865', '40145678002', 'Ethan Paul', 'Rivera', 'Bernal', 'New Student', 'male', 'Grade 8', '', '2011-07-18', 'Roman Catholic', 'Meycauayan City, Bulacan', 13, 'Phase 1 Lot 12, Evergreen Subd., Brgy. Calvario, Meycauayan, Bulacan', NULL, NULL, NULL, NULL, 'Leo Bernal', 'Warehouse Supervisor', '09156789004', 'Donna Rivera', 'Accounting Clerk', '09156789005', 'Leo Bernal', 'Warehouse Supervisor', '09156789004', 'approved', 'Q408282', '09156789006', 'ethan.bernal@gmail.com', NULL, '2026-01-26 12:21:14', 'N/A', 1, 1, 1, 1, 0),
(182, '2026-10963', '40145678001', 'Bianca Denise', 'Mateo', 'Lorenzo', 'New Student', 'female', 'Grade 8', '', '2011-04-12', 'Roman Catholic', 'Meycauayan City, Bulacan', 14, '27 Sampaguita St., Brgy. Perez, Meycauayan, Bulacan', NULL, NULL, NULL, NULL, 'Jonas Lorenzo', 'Mechanical Technician', '09156789001', 'Arlene Mateo', 'Office Staff', '09156789002', 'Arlene Mateo', 'Office Staff', '09156789002', 'approved', 'Q408281', '09156789003', 'bianca.lorenzo@gmail.com', NULL, '2026-01-26 12:21:55', 'N/A', 1, 1, 1, 1, 0),
(183, '2026-78381', '40090000010', 'Francis Mark', 'Abad', 'Tolentino', 'New Student', 'male', 'Grade 9', '', '2011-06-15', 'Roman Catholic', 'Meycauayan City, Bulacan', 14, '66 Acacia St., Brgy. Saluysoy, Meycauayan, Bulacan', NULL, NULL, NULL, NULL, 'Dennis Tolentino', 'Driver', '09171230028', 'Lani Tolentino', 'Sari-sari Store Owner', '09171230029', 'Lani Tolentino', 'Sari-sari Store Owner', '09171230029', 'approved', 'Q930310', '09171230030', 'francis.tolentino@gmail.com', NULL, '2026-01-26 12:35:25', 'N/A', 1, 1, 1, 1, 0),
(184, '2026-38813', '40090000009', 'Stephanie Ann', 'Fajardo', 'Yumul', 'New Student', 'female', 'Grade 9', '', '2011-06-15', 'Roman Catholic', 'Meycauayan City, Bulacan', 14, '8 Rosewood St., Brgy. Iba, Meycauayan, Bulacan', NULL, NULL, NULL, NULL, 'Roderick Yumul', 'Tricycle Driver', '09171230025', 'Mila Yumul', 'Laundry Service', '09171230026', 'Mila Yumul', 'Laundry Service', '09171230026', 'approved', 'Q930309', '09171230027', 'stephanie.yumul@gmail.com', NULL, '2026-01-26 12:36:33', 'N/A', 1, 1, 1, 1, 0),
(185, '2026-12855', '40090000008', 'Kenneth Paul', 'Evangelista', 'Manalo', 'New Student', 'male', 'Grade 9', '', '2011-06-15', 'Roman Catholic', 'Meycauayan City, Bulacan', 14, '49 Sunflower St., Brgy. Perez, Meycauayan, Bulacan', NULL, NULL, NULL, NULL, 'Joel Manalo', 'Warehouse Staff', '09171230022', 'Rose Manalo', 'Housewife', '09171230023', 'Rose Manalo', 'Housewife', '09171230023', 'approved', 'Q930308', '09171230024', 'kenneth.manalo@gmail.com', NULL, '2026-01-26 12:37:13', 'N/A', 1, 1, 1, 1, 0),
(186, '2026-46142', '40090000007', 'Nicole Joy', 'Beltran', 'Aquino', 'New Student', 'female', 'Grade 9', '', '2011-06-15', 'Roman Catholic', 'Meycauayan City, Bulacan', 14, '37 Daisy St., Brgy. Malhacan, Meycauayan, Bulacan', NULL, NULL, NULL, NULL, 'Danilo Aquino', 'Forklift Operator', '09171230019', 'Mercy Aquino', 'Cashier', '09171230020', 'Mercy Aquino', 'Cashier', '09171230020', 'approved', 'Q930307', '09171230021', 'nicole.aquino@gmail.com', NULL, '2026-01-26 12:37:52', 'N/A', 1, 1, 1, 1, 0),
(187, '2026-02783', '40090000006', 'Jerome Alex', 'Santiago', 'Flores', 'New Student', 'male', 'Grade 9', '', '2011-06-15', 'Roman Catholic', 'Meycauayan City, Bulacan', 14, '24 Tulip St., Brgy. Camalig, Meycauayan, Bulacan', NULL, NULL, NULL, NULL, 'Nelson Flores', 'Electrician', '09171230016', 'Gina Flores', 'Tailor', '09171230017', 'Gina Flores', 'Tailor', '09171230017', 'approved', 'Q930306', '09171230018', 'jerome.flores@gmail.com', NULL, '2026-01-26 12:38:32', 'N/A', 1, 1, 1, 1, 0),
(188, '2026-04886', '40090000005', 'Renz Mark', 'Cordero', 'Alonzo', 'New Student', 'male', 'Grade 9', '', '2011-06-15', 'Roman Catholic', 'Meycauayan City, Bulacan', 14, 'Block 9 Lot 4, Santo Niño St., Villa Mercedes Subd., Brgy. Camalig, Meycauayan, Bulacan', NULL, NULL, NULL, NULL, 'Nelson Alonzo', 'Machine Operator', '09171230013', 'Clarissa Cordero', 'Saleslady', '09171230014', 'Clarissa Cordero', 'Saleslady', '09171230014', 'approved', 'Q930305', '09171230015', 'renz.alonzo@gmail.com', NULL, '2026-01-26 13:11:34', 'N/A', 1, 1, 1, 1, 0),
(189, '2026-96232', '40090000004', 'Jayson Lee', 'Tan', 'Co', 'New Student', 'male', 'Grade 9', '', '2011-06-15', 'Roman Catholic', 'Meycauayan City, Bulacan', 14, 'Phase 1 Lot 5, Evergreen Subd., Brgy. Calvario, Meycauayan, Bulacan', NULL, NULL, NULL, NULL, 'Wilson Co', 'Business Owner', '09171230010', 'Maribel Tan', 'Accountant', '09171230011', 'Wilson Co', 'Business Owner', '09171230010', 'approved', 'Q930304', '09171230012', 'jayson.co@gmail.com', NULL, '2026-01-26 13:12:18', 'N/A', 1, 1, 1, 1, 0);
INSERT INTO `student_information` (`id`, `student_number`, `lrn`, `firstname`, `middlename`, `lastname`, `status`, `gender`, `grade_level`, `profile_picture`, `birthday`, `religion`, `place_of_birth`, `age`, `residential_address`, `region`, `province`, `municipal`, `barangay`, `father_name`, `father_occupation`, `father_contact`, `mother_name`, `mother_occupation`, `mother_contact`, `guardian_name`, `guardian_occupation`, `guardian_contact`, `admission_status`, `que_code`, `phone`, `email`, `facebook`, `admission_date`, `strand`, `birth_cert`, `report_card`, `good_moral`, `id_pic`, `esc_cert`) VALUES
(190, '2026-62215', '40090000003', 'Andrew Kyle', 'Morales', 'San Juan', 'New Student', 'male', 'Grade 9', '', '2011-06-15', 'Roman Catholic', 'Meycauayan City, Bulacan', 14, 'Unit 8, Villa Paz Compound, Brgy. Malhacan, Meycauayan, Bulacan', NULL, NULL, NULL, NULL, 'Jaime San Juan', 'Security Guard', '09171230007', 'Teresa Morales', 'Housewife', '09171230008', 'Jaime San Juan', 'Security Guard', '09171230007', 'approved', 'Q930303', '09171230009', 'andrew.sanjuan@gmail.com', NULL, '2026-01-26 13:13:12', 'N/A', 1, 1, 1, 1, 0),
(191, '2026-85324', '40090000001', 'Lorenzo Miguel', 'Rivera', 'Pascual', 'New Student', 'male', 'Grade 9', '', '2011-06-15', 'Roman Catholic', 'Meycauayan City, Bulacan', 14, 'Blk 12 Lot 9, San Isidro Subd., Brgy. Pantoc, Meycauayan, Bulacan', NULL, NULL, NULL, NULL, 'Noel Pascual', 'Construction Worker', '09171230001', 'Angelica Rivera', 'Vendor', '09171230002', 'Noel Pascual', 'Construction Worker', '09171230001', 'approved', 'Q930301', '09171230003', 'lorenzo.pascual@gmail.com', NULL, '2026-01-26 13:13:53', 'N/A', 1, 1, 1, 1, 0),
(192, '2026-99202', '40090000002', 'Denise Carmela', 'Alvarado', 'Fermin', 'New Student', 'female', 'Grade 9', '', '2011-06-15', 'Roman Catholic', 'Meycauayan City, Bulacan', 14, '42 Bonifacio St., Brgy. Langka, Meycauayan, Bulacan', NULL, NULL, NULL, NULL, 'Marvin Fermin', 'Delivery Driver', '09171230004', 'Rochelle Alvarado', 'Office Clerk', '09171230005', 'Rochelle Alvarado', 'Office Clerk', '09171230005', 'approved', 'Q930302', '09171230006', 'denise.fermin@gmail.com', NULL, '2026-01-26 13:14:32', 'N/A', 1, 1, 1, 1, 0),
(193, '2026-03228', '40100000032', 'Bianca Kate', 'Pineda', 'Yanga', 'New Student', 'female', 'Grade 10', '', '2010-06-15', 'Roman Catholic', 'Meycauayan City, Bulacan', 15, '28 Mango St., Brgy. Malhacan, Meycauayan, Bulacan', NULL, NULL, NULL, NULL, 'Nelson Yanga', 'Warehouse Checker', '09181230034', 'Josie Yanga', 'Housewife', '09181230035', 'Josie Yanga', 'Housewife', '09181230035', 'approved', 'Q10332', '09181230036', 'bianca.yanga@gmail.com', NULL, '2026-01-26 13:24:43', 'N/A', 1, 1, 1, 1, 0),
(194, '2026-94009', '40100000031', 'John Carlo', 'Romero', 'Tadeo', 'New Student', 'male', 'Grade 10', '', '2010-06-15', 'Roman Catholic', 'Meycauayan City, Bulacan', 15, '56 Lotus St., Brgy. Camalig, Meycauayan, Bulacan', NULL, NULL, NULL, NULL, 'Ronnie Tadeo', 'Auto Mechanic', '09181230031', 'Grace Tadeo', 'Office Staff', '09181230032', 'Grace Tadeo', 'Office Staff', '09181230032', 'approved', 'Q10331', '09181230033', 'johncarlo.tadeo@gmail.com', NULL, '2026-01-26 13:25:56', 'N/A', 1, 1, 1, 1, 0),
(195, '2026-57197', '40100000030', 'Mikaela Faith', 'Lorenzo', 'Abad', 'New Student', 'female', 'Grade 10', '', '2010-06-15', 'Roman Catholic', 'Meycauayan City, Bulacan', 15, '6 Maple St., Brgy. Iba, Meycauayan, Bulacan', NULL, NULL, NULL, NULL, 'Noel Abad', 'Delivery Driver', '09181230028', 'Rina Abad', 'Online Seller', '09181230029', 'Rina Abad', 'Online Seller', '09181230029', 'approved', 'Q10330', '09181230030', 'mikaela.abad@gmail.com', NULL, '2026-01-26 13:26:37', 'N/A', 1, 1, 1, 1, 0),
(196, '2026-12726', '40100000029', 'Bryan Keith', 'Morales', 'Enriquez', 'New Student', 'male', 'Grade 10', '', '2010-06-15', 'Roman Catholic', 'Meycauayan City, Bulacan', 15, '73 Oak St., Brgy. Perez, Meycauayan, Bulacan', NULL, NULL, NULL, NULL, 'Dan Enriquez', 'Factory Worker', '09181230025', 'Liza Enriquez', 'Vendor', '09181230026', 'Liza Enriquez', 'Vendor', '09181230026', 'approved', 'Q10329', '09181230027', 'bryan.enriquez@gmail.com', NULL, '2026-01-26 13:27:23', 'N/A', 1, 1, 1, 1, 0),
(197, '2026-95652', '40100000028', 'Angelica Mae', 'Reyes', 'Macapagal', 'New Student', 'female', 'Grade 10', '', '2010-06-15', 'Roman Catholic', 'Meycauayan City, Bulacan', 15, '51 Palm St., Brgy. Malhacan, Meycauayan, Bulacan', NULL, NULL, NULL, NULL, 'Tony Macapagal', 'Forklift Operator', '09181230022', 'Ruby Macapagal', 'Cashier', '09181230023', 'Ruby Macapagal', 'Cashier', '09181230023', 'approved', 'Q10328', '09181230024', 'angelica.macapagal@gmail.com', NULL, '2026-01-26 13:28:01', 'N/A', 1, 1, 1, 1, 0),
(198, '2026-67994', '40100000027', 'Marco Luis', 'Cabrera', 'Luna', 'New Student', 'male', 'Grade 10', '', '2010-06-15', 'Roman Catholic', 'Meycauayan City, Bulacan', 15, '32 Cedar St., Brgy. Camalig, Meycauayan, Bulacan', NULL, NULL, NULL, NULL, 'Fidel Luna', 'Truck Driver', '09181230019', 'Elsa Luna', 'Housewife', '09181230020', 'Elsa Luna', 'Housewife', '09181230020', 'approved', 'Q10327', '09181230021', 'marco.luna@gmail.com', NULL, '2026-01-26 13:28:36', 'N/A', 1, 1, 1, 1, 0),
(199, '2026-66213', '40100000026', 'Patricia Hope', 'Cruz', 'Valdez', 'New Student', 'female', 'Grade 10', '', '2010-06-15', 'Roman Catholic', 'Meycauayan City, Bulacan', 15, '15 Pine St., Brgy. Pandayan, Meycauayan, Bulacan', NULL, NULL, NULL, NULL, 'Arman Valdez', 'Warehouse Staff', '09181230016', 'Nora Valdez', 'Housewife', '09181230017', 'Nora Valdez', 'Housewife', '09181230017', 'approved', 'Q10326', '09181230018', 'patricia.valdez@gmail.com', NULL, '2026-01-26 13:29:27', 'N/A', 1, 1, 1, 1, 0),
(200, '2026-42492', '40100000025', 'Nathaniel John', 'Manalo', 'Espiritu', 'New Student', 'male', 'Grade 10', '', '2010-06-15', 'Roman Catholic', 'Meycauayan City, Bulacan', 15, '84 Camia St., Brgy. Saluysoy, Meycauayan, Bulacan', NULL, NULL, NULL, NULL, 'Benjamin Espiritu', 'Electrician', '09181230013', 'Corazon Manalo', 'Housewife', '09181230014', 'Corazon Manalo', 'Housewife', '09181230014', 'approved', 'Q10325', '09181230015', 'nathaniel.espiritu@gmail.com', NULL, '2026-01-26 13:30:09', 'N/A', 1, 1, 1, 0, 0),
(201, '2026-91546', '40100000024', 'Trina Louise', 'Cruz', 'Hidalgo', 'New Student', 'female', 'Grade 10', '', '2010-06-15', 'Roman Catholic', 'Meycauayan City, Bulacan', 15, 'Unit 12, San Roque Compound, Brgy. Hulo, Meycauayan, Bulacan', NULL, NULL, NULL, NULL, 'Roberto Hidalgo', 'Security Guard', '09181230010', 'Melanie Cruz', 'Office Aide', '09181230011', 'Melanie Cruz', 'Office Aide', '09181230011', 'approved', 'Q10324', '09181230012', 'trina.hidalgo@gmail.com', NULL, '2026-01-26 13:30:54', 'N/A', 1, 1, 1, 1, 0),
(202, '2026-23038', '40100000022', 'Chelsea Mae', 'Santos', 'Matibag', 'New Student', 'female', 'Grade 10', '', '2010-06-15', 'Roman Catholic', 'Meycauayan City, Bulacan', 15, 'Phase 2 Lot 15, Greenfields Subd., Brgy. Calvario, Meycauayan, Bulacan', NULL, NULL, NULL, NULL, 'Rogelio Matibag', 'Construction Worker', '09181230004', 'Imelda Santos', 'Housewife', '09181230005', 'Imelda Santos', 'Housewife', '09181230005', 'approved', 'Q10322', '09181230006', 'chelsea.matibag@gmail.com', NULL, '2026-01-26 13:36:02', 'N/A', 1, 1, 1, 1, 0),
(203, '2026-10513', '400858070150', 'CJ', 'Marker', 'Escalora', 'New Student', 'male', 'Grade 2', '', '2019-02-22', 'test', 'Marilao', 6, 'Calantipay, Baliuag, Bulacan, Central Luzon,', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Clarissa Cordero', 'Sales Clerk', '09123456715', 'Sonia  Padilla', 'House Wife', '09181230002', 'approved', 'Q806342', '09123456789', 'floterina@gmail.com', NULL, '2026-01-28 12:14:20', 'N/A', 1, 1, 1, 1, 0),
(204, '2026-69187', '40085808019', 'Earl Dominic', 'Flores', 'Yabut', 'New Student', 'male', 'Grade 1', '', '2018-02-25', 'Catholic', 'Meycauayan, Bulacan', 6, '11 Luna St., Brgy. Perez, Meycauayan, Bulacan', NULL, NULL, NULL, NULL, 'Noel Yabut', 'Delivery Driver', '09181110038', 'Gina Yabut', 'Housewife', '09181110039', 'Gina Yabut', 'Housewife', '09181110039', 'approved', 'QG3019', '09181110038', 'earl.yabut@gmail.com', NULL, '2026-01-26 14:42:46', 'N/A', 1, 1, 1, 1, 0),
(205, '2026-12877', '00000000001', 'nick', 'escalora', 'azcueta', 'New Student', 'male', 'Nursery', '', '2021-12-26', 'catholic', 'manila', 4, 'Lias, Marilao, Bulacan, Central Luzon,', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'cecile escalora', 'nurse', '09092075700', 'cecile escalora', 'nurse', '09092075700', 'approved', 'Q797412', '09123456789', 'nogip76240@gamening.com', NULL, '2026-01-29 00:52:33', 'N/A', 1, 1, 0, 1, 1),
(206, '2026-17755', '104912001610', 'Julouise', 'Garcia', 'De Guzman', 'New Student', 'male', 'Grade 1', '', '2019-06-28', 'catholic', 'manila hospital', 6, 'Santa Rosa I, Marilao, Bulacan, Central Luzon,', NULL, NULL, NULL, NULL, 'Gericho De Guzman', 'Data Analyst', '09092075700', 'Gale De Guzman', 'Housewife', '09924866376', 'Gale De Guzman', 'Housewife', '09924866376', 'approved', 'Q321215', '09123456789', 'xelof91749@ixunbo.com', NULL, '2026-02-02 01:07:54', 'N/A', 1, 1, 1, 1, 1),
(207, '2026-33670', '40085808018', 'Andrew Paul', 'Lim', 'Wilson', 'New Student', 'male', 'Grade 1', '', '2018-12-12', 'Christian', 'Meycauayan, Bulacan', 6, '52 Mabini St., Brgy. Malhacan, Meycauayan, Bulacan', NULL, NULL, NULL, NULL, 'Richard Wilson', 'IT Technician', '09181110036', 'Susan Wilson', 'Office Staff', '09181110037', 'Susan Wilson', 'Office Staff', '09181110037', 'approved', 'QG3018', '09181110036', 'andrew.wilson@gmail.com', NULL, '2026-01-31 15:07:53', 'N/A', 1, 1, 1, 1, 0),
(210, '2026-11186', '40085808017', 'Kyla Anne', 'Cruz', 'Valdez', 'New Student', 'female', 'Grade 1', '', '2018-09-28', 'Catholic', 'Meycauayan, Bulacan', 6, '19 Rizal St., Brgy. Camalig, Meycauayan, Bulacan', 'Central Luzon', 'Bulacan', 'City of Meycauayan', 'Camalig', 'Ben Valdez', 'Machine Operator', '09181110034', 'Teresa Valdez', 'Housewife', '09181110035', 'Teresa Valdez', 'Housewife', '09181110035', 'approved', 'QG3017', '09181110034', 'kyla.valdez@gmail.com', NULL, '2026-01-26 14:41:32', NULL, 0, 0, 0, 0, 0),
(211, '2026-93506', '40085808016', 'Kevin Michael', 'Tan', 'Uy', 'New Student', 'male', 'Grade 1', '', '2018-05-07', 'Catholic', 'Meycauayan, Bulacan', 6, '7 Zamora St., Brgy. Pandayan, Meycauayan, Bulacan', 'Central Luzon', 'Bulacan', 'City of Meycauayan', 'Pandayan', 'Henry Uy', 'Sales Manager', '09181110032', 'Lily Uy', 'Housewife', '09181110033', 'Lily Uy', 'Housewife', '09181110033', 'approved', 'QG3016', '09181110032', 'kevin.uy@gmail.com', NULL, '2026-01-26 14:41:30', NULL, 0, 0, 0, 0, 0),
(212, '2026-26115', '40085808015', 'Miguel Aaron', 'Ramos', 'Torres', 'New Student', 'male', 'Grade 1', '', '2018-11-03', 'Christian', 'Meycauayan, Bulacan', 6, '31 Pacheco St., Brgy. Saluysoy, Meycauayan, Bulacan', 'Central Luzon', 'Bulacan', 'City of Meycauayan', 'Saluysoy', 'Eric Torres', 'Construction Worker', '09181110030', 'Vilma Torres', 'Housewife', '09181110031', 'Vilma Torres', 'Housewife', '09181110031', 'approved', 'QG3015', '09181110030', 'miguel.torres@gmail.com', NULL, '2026-01-26 14:41:25', NULL, 0, 0, 0, 0, 0),
(215, '2026-24920', '40085808014', 'Bianca Joy', 'Flores', 'Santos', 'New Student', 'female', 'Grade 1', '', '2018-08-16', 'Catholic', 'Meycauayan, Bulacan', 6, '47 Bonifacio St., Brgy. Iba, Meycauayan, Bulacan', NULL, NULL, NULL, NULL, 'Oscar Santos', 'Security Guard', '09181110028', 'Myrna Santos', 'Housewife', '09181110029', 'Myrna Santos', 'Housewife', '09181110029', 'approved', 'QG3014', '09181110028', 'bianca.santos@gmail.com', NULL, '2026-02-11 18:04:48', 'N/A', 1, 1, 1, 1, 0),
(216, '2026-32660', '40085808013', 'Ethan John', 'Cruz', 'Ramos', 'New Student', 'male', 'Grade 1', '', '2018-04-02', 'Catholic', 'Meycauayan, Bulacan', 6, '13 Luna St., Brgy. Perez, Meycauayan, Bulacan', 'Central Luzon', 'Bulacan', 'City of Meycauayan', 'Perez', 'Noel Ramos', 'Maintenance Staff', '09181110026', 'Gina Ramos', 'Housewife', '09181110027', 'Gina Ramos', 'Housewife', '09181110027', 'approved', 'QG3013', '09181110026', 'ethan.ramos@gmail.com', NULL, '2026-01-26 14:09:04', NULL, 0, 0, 0, 0, 0),
(217, '2026-72104', '40085808012', 'Joshua Mark', 'Santos', 'Quevedo', 'New Student', 'male', 'Grade 1', '', '2018-01-19', 'Christian', 'Meycauayan, Bulacan', 6, '38 Mabini St., Brgy. Malhacan, Meycauayan, Bulacan', 'Central Luzon', 'Bulacan', 'City of Meycauayan', 'Malhacan', 'Nestor Quevedo', 'Warehouse Supervisor', '09181110024', 'Ruby Quevedo', 'Housewife', '09181110025', 'Ruby Quevedo', 'Housewife', '09181110025', 'approved', 'QG3012', '09181110024', 'joshua.quevedo@gmail.com', NULL, '2026-01-26 14:08:54', NULL, 0, 0, 0, 0, 0);

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
  `enrolled_date` datetime NOT NULL DEFAULT current_timestamp(),
  `payment_total` decimal(12,2) NOT NULL DEFAULT 0.00,
  `interest` decimal(12,2) NOT NULL DEFAULT 0.00,
  `program_type` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `student_tuition`
--

INSERT INTO `student_tuition` (`id`, `account_number`, `student_number`, `payment_plan`, `enrolled_section`, `registration_fee`, `tuition_fee`, `miscellaneous`, `uniform`, `uniform_cart`, `discount_type`, `discount_value`, `discount_amount`, `downpayment`, `enrolled_date`, `payment_total`, `interest`, `program_type`) VALUES
(43, '70714702', '2025-52404', 'Semestral', '19', 2500.00, 24200.75, 15635.25, 550.00, '[{\"name\":\"Grade 1 to 6 - Top - Polo Jacket\",\"quantity\":1,\"total\":550,\"gender\":\"Male\",\"size\":\"S\"}]', '', 0.00, 0.00, 0.00, '2025-10-06 22:24:22', 0.00, 0.00, NULL),
(60, '43586724', '2025-00231', 'Semestral', '17', 2500.00, 22341.00, 16359.00, 550.00, '[{\"name\":\"Grade 1 to 6 - Top - Polo Jacket\",\"quantity\":1,\"total\":550,\"gender\":\"Male\",\"size\":\"S\"}]', '', 0.00, 0.00, 11000.00, '2025-12-04 19:08:56', 0.00, 0.00, NULL),
(61, '86823945', '2025-11100', 'Quarterly', '21', 2500.00, 24200.75, 15635.25, 550.00, '[{\"name\":\"Grade 1 to 6 - Top - Polo Jacket\",\"quantity\":1,\"total\":550,\"gender\":\"Male\",\"size\":\"S\"}]', '', 0.00, 0.00, 10000.00, '2025-12-06 07:01:36', 0.00, 0.00, NULL),
(62, '48867334', '2025-68549', 'Semestral', '24', 2500.00, 24752.75, 15635.25, 550.00, '[{\"name\":\"Grade 1 to 6 - Top - Polo Jacket\",\"quantity\":1,\"total\":550,\"gender\":\"Male\",\"size\":\"L\"}]', '', 0.00, 0.00, 5000.00, '2025-12-06 07:21:31', 0.00, 0.00, NULL),
(63, '21478301', '2025-71474', 'Monthly', '27', 2500.00, 29118.00, 15635.25, 620.00, '[{\"name\":\"Grade 7 to 10 - Top - Polo Barong\",\"quantity\":1,\"total\":620,\"gender\":\"Male\",\"size\":\"M\"}]', '', 0.00, 0.00, 3000.00, '2025-12-06 07:26:34', 0.00, 0.00, NULL),
(64, '59836772', '2025-13565', 'Semestral', '32', 2500.00, 0.00, 6980.00, 640.00, '[{\"name\":\"Grade 11 to 12 - Top - Long Sleeves\",\"quantity\":1,\"total\":640,\"gender\":\"Male\",\"size\":\"XL\"}]', '', 0.00, 0.00, 0.00, '2025-12-06 07:31:21', 0.00, 0.00, NULL),
(65, '44895437', '2025-73069', 'Semestral', '0', 2500.00, 29118.00, 15635.25, 0.00, '[]', 'percent', 5.00, 2237.66, 1000.00, '2025-12-06 15:15:57', 0.00, 0.00, NULL),
(66, '75100906', '', 'Quarterly', '26', 2500.00, 29118.00, 15635.25, 550.00, '[{\"name\":\"Grade 1 to 6 - Top - Polo Jacket\",\"quantity\":1,\"total\":550,\"gender\":\"Male\",\"size\":\"S\"}]', '', 0.00, 0.00, 1000.00, '2025-12-09 01:43:10', 0.00, 0.00, NULL),
(67, '08792149', '', 'Monthly', '26', 2500.00, 29118.00, 15635.25, 550.00, '[{\"name\":\"Grade 1 to 6 - Top - Polo Jacket\",\"quantity\":1,\"total\":550,\"gender\":\"Male\",\"size\":\"S\"}]', '', 0.00, 0.00, 0.00, '2025-12-09 01:51:41', 0.00, 0.00, NULL),
(68, '61894517', '2025-73069', 'Quarterly', '26', 2500.00, 29118.00, 15635.25, 1100.00, '[{\"name\":\"Grade 1 to 6 - Top - Polo Jacket\",\"quantity\":2,\"total\":1100,\"gender\":\"Male\",\"size\":\"S\"}]', '', 0.00, 0.00, 1000.00, '2025-12-09 01:56:34', 0.00, 0.00, NULL),
(69, '81908893', '2025-73069', 'Semestral', '27', 2500.00, 29118.00, 15635.25, 550.00, '[{\"name\":\"Grade 1 to 6 - Top - Polo Jacket\",\"quantity\":1,\"total\":550,\"gender\":\"Male\",\"size\":\"S\"}]', '', 0.00, 0.00, 0.00, '2025-12-09 05:11:55', 0.00, 0.00, NULL),
(70, '00704554', '2025-73069', 'Semestral', '27', 2500.00, 29118.00, 15635.25, 550.00, '[{\"name\":\"Grade 1 to 6 - Top - Polo Jacket\",\"quantity\":1,\"total\":550,\"gender\":\"Male\",\"size\":\"S\"}]', '', 0.00, 0.00, 0.00, '2025-12-09 05:11:56', 0.00, 0.00, NULL),
(71, '91267070', '2025-63156', 'Semestral', '17', 2500.00, 22341.00, 16359.00, 550.00, '[{\"name\":\"Grade 1 to 6 - Top - . Polo Jacket\",\"quantity\":1,\"total\":550,\"gender\":\"Male\",\"size\":\"S\"}]', '', 0.00, 0.00, 0.00, '2025-12-10 08:09:14', 0.00, 0.00, NULL),
(72, '03537103', '2025-00231', 'Semestral', '45', 2500.00, 24283.75, 16359.00, 550.00, '[{\"name\":\"Grade 1 to 6 - Top - Polo Jacket\",\"quantity\":1,\"total\":550,\"gender\":\"Male\",\"size\":\"S\"}]', '', 0.00, 0.00, 0.00, '2025-12-10 08:10:42', 0.00, 0.00, NULL),
(73, '03741482', '2025-00674', 'Semestral', '18', 2500.00, 22341.00, 16359.00, 0.00, 'null', '', 0.00, 0.00, 500.00, '2025-12-16 10:17:21', 0.00, 0.00, NULL),
(74, '60155790', '2025-65859', 'Semestral', '19', 2500.00, 24200.75, 15635.25, 550.00, '[{\"name\":\"Grade 1 to 6 - Top - . Polo Jacket\",\"quantity\":1,\"total\":550,\"gender\":\"Male\",\"size\":\"S\"}]', '', 0.00, 0.00, 0.00, '2025-12-17 14:04:28', 0.00, 0.00, NULL),
(75, '82314952', '2025-18633', 'Quarterly', '17', 2500.00, 22341.00, 16359.00, 1100.00, '[{\"name\":\"Grade 1 to 6 - Top - . Polo Jacket\",\"quantity\":2,\"total\":1100,\"gender\":\"Male\",\"size\":\"S\"}]', '', 0.00, 0.00, 5000.00, '2025-12-17 14:37:41', 0.00, 0.00, NULL),
(76, '63422081', '2025-92581', 'Semestral', '45', 2500.00, 24283.75, 16359.00, 0.00, 'null', '', 0.00, 0.00, 0.00, '2025-12-18 01:32:10', 0.00, 0.00, NULL),
(77, '71691236', '2026-02462', 'Semestral', '19', 2500.00, 24200.75, 15635.25, 550.00, '[{\"name\":\"Grade 1 to 6 - Top - . Polo Jacket\",\"quantity\":1,\"total\":550,\"gender\":\"Male\",\"size\":\"XL\"}]', '', 0.00, 0.00, 0.00, '2026-01-24 13:14:15', 0.00, 0.00, NULL),
(78, '50248839', '2026-37633', 'Annual', '19', 2500.00, 24200.75, 15635.25, 1100.00, '[{\"name\":\"Grade 1 to 6 - Top - . Polo Jacket\",\"quantity\":1,\"total\":550,\"gender\":\"Male\",\"size\":\"XL\"},{\"name\":\"Grade 1 to 6 - Top - . Polo Jacket\",\"quantity\":1,\"total\":550,\"gender\":\"Male\",\"size\":\"S\"}]', '', 0.00, 0.00, 1000.00, '2026-01-24 13:16:29', 0.00, 0.00, NULL),
(79, '65066982', '2026-02678', 'Semestral', '19', 2500.00, 24200.75, 15635.25, 1100.00, '[{\"name\":\"Grade 1 to 6 - Top - . Polo Jacket\",\"quantity\":1,\"total\":550,\"gender\":\"Male\",\"size\":\"XL\"},{\"name\":\"Grade 1 to 6 - Top - . Polo Jacket\",\"quantity\":1,\"total\":550,\"gender\":\"Male\",\"size\":\"L\"}]', '', 0.00, 0.00, 3000.00, '2026-01-24 13:18:33', 0.00, 0.00, NULL),
(80, '84786985', '2026-06420', 'Quarterly', '19', 2500.00, 24200.75, 15635.25, 1100.00, '[{\"name\":\"Grade 1 to 6 - Top - . Polo Jacket\",\"quantity\":1,\"total\":550,\"gender\":\"Male\",\"size\":\"L\"},{\"name\":\"Grade 1 to 6 - Top - . Polo Jacket\",\"quantity\":1,\"total\":550,\"gender\":\"Male\",\"size\":\"XS\"}]', '', 0.00, 0.00, 1500.00, '2026-01-24 13:19:55', 0.00, 0.00, NULL),
(81, '72510694', '2026-52670', 'Annual', '19', 2500.00, 24200.75, 15635.25, 550.00, '[{\"name\":\"Grade 1 to 6 - Top - . Polo Jacket\",\"quantity\":1,\"total\":550,\"gender\":\"Male\",\"size\":\"S\"}]', '', 0.00, 0.00, 0.00, '2026-01-24 13:22:18', 0.00, 0.00, NULL),
(82, '38990619', '2026-30598', 'Semestral', '19', 2500.00, 24200.75, 15635.25, 1100.00, '[{\"name\":\"Grade 1 to 6 - Top - . Polo Jacket\",\"quantity\":1,\"total\":550,\"gender\":\"Male\",\"size\":\"S\"},{\"name\":\"Grade 1 to 6 - Top - . Polo Jacket\",\"quantity\":1,\"total\":550,\"gender\":\"Male\",\"size\":\"XS\"}]', '', 0.00, 0.00, 2500.00, '2026-01-24 13:23:39', 0.00, 0.00, NULL),
(83, '68534719', '2026-31371', 'Annual', '19', 2500.00, 24200.75, 15635.25, 550.00, '[{\"name\":\"Grade 1 to 6 - Top - . Polo Jacket\",\"quantity\":1,\"total\":550,\"gender\":\"Male\",\"size\":\"XL\"}]', '', 0.00, 0.00, 3000.00, '2026-01-24 13:26:17', 0.00, 0.00, NULL),
(84, '82438405', '2026-74343', 'Semestral', '19', 2500.00, 24200.75, 15635.25, 550.00, '[{\"name\":\"Grade 1 to 6 - Top - . Polo Jacket\",\"quantity\":1,\"total\":550,\"gender\":\"Male\",\"size\":\"S\"}]', '', 0.00, 0.00, 0.00, '2026-01-24 13:28:19', 0.00, 0.00, NULL),
(85, '82763807', '2026-35813', 'Annual', '19', 2500.00, 24200.75, 15635.25, 550.00, '[{\"name\":\"Grade 1 to 6 - Top - . Polo Jacket\",\"quantity\":1,\"total\":550,\"gender\":\"Male\",\"size\":\"XL\"}]', '', 0.00, 0.00, 1500.00, '2026-01-24 13:41:18', 0.00, 0.00, NULL),
(86, '27326940', '2026-62962', 'Annual', '19', 2500.00, 24200.75, 15635.25, 550.00, '[{\"name\":\"Grade 1 to 6 - Top - . Polo Jacket\",\"quantity\":1,\"total\":550,\"gender\":\"Male\",\"size\":\"XS\"}]', '', 0.00, 0.00, 1000.00, '2026-01-24 13:42:19', 0.00, 0.00, NULL),
(87, '68856227', '2026-16480', 'Semestral', '19', 2500.00, 24200.75, 15635.25, 550.00, '[{\"name\":\"Grade 1 to 6 - Top - . Polo Jacket\",\"quantity\":1,\"total\":550,\"gender\":\"Male\",\"size\":\"XL\"}]', '', 0.00, 0.00, 5000.00, '2026-01-24 13:43:27', 0.00, 0.00, NULL),
(88, '91099116', '2026-04491', 'Annual', '21', 2500.00, 24200.75, 15635.25, 0.00, 'null', '', 0.00, 0.00, 0.00, '2026-01-24 14:49:32', 0.00, 0.00, NULL),
(89, '19485149', '2026-30794', 'Annual', '21', 2500.00, 24200.75, 15635.25, 550.00, '[{\"name\":\"Grade 1 to 6 - Top - . Polo Jacket\",\"quantity\":1,\"total\":550,\"gender\":\"Male\",\"size\":\"XL\"}]', '', 0.00, 0.00, 0.00, '2026-01-24 15:55:59', 0.00, 0.00, NULL),
(90, '15597991', '2026-13017', 'Annual', '21', 2500.00, 24200.75, 15635.25, 550.00, '[{\"name\":\"Grade 1 to 6 - Top - . Polo Jacket\",\"quantity\":1,\"total\":550,\"gender\":\"Male\",\"size\":\"XL\"}]', '', 0.00, 0.00, 0.00, '2026-01-24 16:01:23', 0.00, 0.00, NULL),
(91, '40342955', '2026-51379', 'Annual', '21', 2500.00, 24200.75, 15635.25, 550.00, '[{\"name\":\"Grade 1 to 6 - Top - . Polo Jacket\",\"quantity\":1,\"total\":550,\"gender\":\"Male\",\"size\":\"L\"}]', '', 0.00, 0.00, 0.00, '2026-01-24 16:03:33', 0.00, 0.00, NULL),
(92, '44594444', '2026-81685', 'Annual', '21', 2500.00, 24200.75, 15635.25, 550.00, '[{\"name\":\"Grade 1 to 6 - Top - . Polo Jacket\",\"quantity\":1,\"total\":550,\"gender\":\"Male\",\"size\":\"XL\"}]', '', 0.00, 0.00, 0.00, '2026-01-24 16:06:30', 0.00, 0.00, NULL),
(93, '82414177', '2026-89672', 'Annual', '21', 2500.00, 24200.75, 15635.25, 550.00, '[{\"name\":\"Grade 1 to 6 - Top - . Polo Jacket\",\"quantity\":1,\"total\":550,\"gender\":\"Male\",\"size\":\"S\"}]', '', 0.00, 0.00, 0.00, '2026-01-24 16:07:37', 0.00, 0.00, NULL),
(94, '60256704', '2026-23241', 'Annual', '21', 2500.00, 24200.75, 15635.25, 550.00, '[{\"name\":\"Grade 1 to 6 - Top - . Polo Jacket\",\"quantity\":1,\"total\":550,\"gender\":\"Male\",\"size\":\"S\"}]', '', 0.00, 0.00, 0.00, '2026-01-24 16:09:15', 0.00, 0.00, NULL),
(95, '86018334', '2026-55310', 'Annual', '21', 2500.00, 24200.75, 15635.25, 550.00, '[{\"name\":\"Grade 1 to 6 - Top - . Polo Jacket\",\"quantity\":1,\"total\":550,\"gender\":\"Male\",\"size\":\"S\"}]', '', 0.00, 0.00, 0.00, '2026-01-24 16:10:59', 0.00, 0.00, NULL),
(96, '89616345', '2026-15333', 'Annual', '21', 2500.00, 24200.75, 15635.25, 550.00, '[{\"name\":\"Grade 1 to 6 - Top - . Polo Jacket\",\"quantity\":1,\"total\":550,\"gender\":\"Male\",\"size\":\"XL\"}]', '', 0.00, 0.00, 0.00, '2026-01-24 16:12:44', 0.00, 0.00, NULL),
(97, '44831152', '2026-18613', 'Annual', '21', 2500.00, 24200.75, 15635.25, 0.00, 'null', '', 0.00, 0.00, 1500.00, '2026-01-24 16:14:21', 0.00, 0.00, NULL),
(98, '23322286', '2025-92581', 'Semestral', '44', 2500.00, 22341.00, 16359.00, 0.00, 'null', '', 0.00, 0.00, 0.00, '2026-01-24 16:30:22', 0.00, 0.00, NULL),
(99, '82372249', '2026-68003', 'Annual', '22', 2500.00, 24200.75, 15635.25, 550.00, '[{\"name\":\"Grade 1 to 6 - Top - . Polo Jacket\",\"quantity\":1,\"total\":550,\"gender\":\"Male\",\"size\":\"XL\"}]', '', 0.00, 0.00, 1000.00, '2026-01-24 16:31:13', 0.00, 0.00, NULL),
(100, '86043691', '2026-22943', 'Annual', '22', 2500.00, 24200.75, 15635.25, 550.00, '[{\"name\":\"Grade 1 to 6 - Top - . Polo Jacket\",\"quantity\":1,\"total\":550,\"gender\":\"Male\",\"size\":\"XL\"}]', '', 0.00, 0.00, 0.00, '2026-01-24 16:34:58', 0.00, 0.00, NULL),
(101, '09566377', '2026-38818', 'Annual', '22', 2500.00, 24200.75, 15635.25, 0.00, 'null', '', 0.00, 0.00, 0.00, '2026-01-24 16:36:31', 0.00, 0.00, NULL),
(102, '47316716', '2026-93730', 'Annual', '22', 2500.00, 24200.75, 15635.25, 550.00, '[{\"name\":\"Grade 1 to 6 - Top - . Polo Jacket\",\"quantity\":1,\"total\":550,\"gender\":\"Male\",\"size\":\"S\"}]', '', 0.00, 0.00, 0.00, '2026-01-24 16:40:04', 0.00, 0.00, NULL),
(103, '36566247', '2026-45440', 'Annual', '22', 2500.00, 24200.75, 15635.25, 550.00, '[{\"name\":\"Grade 1 to 6 - Top - . Polo Jacket\",\"quantity\":1,\"total\":550,\"gender\":\"Male\",\"size\":\"XL\"}]', '', 0.00, 0.00, 0.00, '2026-01-24 16:53:35', 0.00, 0.00, NULL),
(104, '78369060', '2026-07337', 'Annual', '22', 2500.00, 24200.75, 15635.25, 0.00, 'null', '', 0.00, 0.00, 0.00, '2026-01-24 16:54:52', 0.00, 0.00, NULL),
(105, '67946082', '2026-95897', 'Annual', '22', 2500.00, 24200.75, 15635.25, 0.00, 'null', '', 0.00, 0.00, 0.00, '2026-01-24 17:00:50', 0.00, 0.00, NULL),
(106, '51812440', '2026-16226', 'Annual', '22', 2500.00, 24200.75, 15635.25, 550.00, '[{\"name\":\"Grade 1 to 6 - Top - . Polo Jacket\",\"quantity\":1,\"total\":550,\"gender\":\"Male\",\"size\":\"XL\"}]', '', 0.00, 0.00, 0.00, '2026-01-24 17:02:13', 0.00, 0.00, NULL),
(107, '66900455', '2026-76128', 'Quarterly', '22', 2500.00, 24200.75, 15635.25, 550.00, '[{\"name\":\"Grade 1 to 6 - Top - . Polo Jacket\",\"quantity\":1,\"total\":550,\"gender\":\"Male\",\"size\":\"XL\"}]', '', 0.00, 0.00, 1000.00, '2026-01-24 17:03:21', 0.00, 0.00, NULL),
(108, '43605632', '2026-45826', 'Semestral', '22', 2500.00, 24200.75, 15635.25, 550.00, '[{\"name\":\"Grade 1 to 6 - Top - . Polo Jacket\",\"quantity\":1,\"total\":550,\"gender\":\"Male\",\"size\":\"XL\"}]', '', 0.00, 0.00, 1500.00, '2026-01-24 17:05:16', 0.00, 0.00, NULL),
(109, '05535711', '2026-03458', 'Monthly', '29', 2500.00, 29545.75, 15635.25, 640.00, '[{\"name\":\"Grade 11 to 12 - Top - . Long Sleeves\",\"quantity\":1,\"total\":640,\"gender\":\"Male\",\"size\":\"XL\"}]', '', 0.00, 0.00, 2500.00, '2026-01-24 17:10:40', 0.00, 0.00, NULL),
(110, '77294884', '2026-68200', 'Annual', '36', 2500.00, 24752.75, 15635.25, 0.00, 'null', '', 0.00, 0.00, 0.00, '2026-01-24 17:20:02', 0.00, 0.00, NULL),
(111, '58643905', '2026-70917', 'Annual', '36', 2500.00, 24752.75, 15635.25, 0.00, 'null', '', 0.00, 0.00, 0.00, '2026-01-24 17:20:04', 0.00, 0.00, NULL),
(112, '39569331', '2026-32358', 'Annual', '29', 2500.00, 29545.75, 15635.25, 0.00, 'null', '', 0.00, 0.00, 0.00, '2026-01-24 17:22:12', 0.00, 0.00, NULL),
(113, '87670301', '2026-30420', 'Semestral', '36', 2500.00, 24752.75, 15635.25, 550.00, '[{\"name\":\"Grade 1 to 6 - Top - . Polo Jacket\",\"quantity\":1,\"total\":550,\"gender\":\"Male\",\"size\":\"S\"}]', '', 0.00, 0.00, 0.00, '2026-01-26 06:43:20', 0.00, 0.00, NULL),
(114, '13287509', '2026-10550', 'Annual', '36', 2500.00, 24752.75, 15635.25, 0.00, 'null', '', 0.00, 0.00, 0.00, '2026-01-26 06:46:39', 0.00, 0.00, NULL),
(115, '60367599', '2026-91967', 'Semestral', '36', 2500.00, 24752.75, 15635.25, 550.00, '[{\"name\":\"Grade 1 to 6 - Top - . Polo Jacket\",\"quantity\":1,\"total\":550,\"gender\":\"Male\",\"size\":\"XL\"}]', '', 0.00, 0.00, 1000.00, '2026-01-26 07:21:38', 0.00, 0.00, NULL),
(116, '79422286', '2026-27406', 'Annual', '36', 2500.00, 24752.75, 15635.25, 550.00, '[{\"name\":\"Grade 1 to 6 - Top - . Polo Jacket\",\"quantity\":1,\"total\":550,\"gender\":\"Male\",\"size\":\"XL\"}]', '', 0.00, 0.00, 0.00, '2026-01-26 07:26:17', 0.00, 0.00, NULL),
(117, '53309672', '2026-97012', 'Annual', '36', 2500.00, 24752.75, 15635.25, 550.00, '[{\"name\":\"Grade 1 to 6 - Top - . Polo Jacket\",\"quantity\":1,\"total\":550,\"gender\":\"Male\",\"size\":\"XL\"}]', '', 0.00, 0.00, 0.00, '2026-01-26 07:43:23', 0.00, 0.00, NULL),
(118, '99261678', '2026-52486', 'Annual', '36', 2500.00, 24752.75, 15635.25, 0.00, 'null', '', 0.00, 0.00, 0.00, '2026-01-26 07:51:20', 0.00, 0.00, NULL),
(119, '19769904', '2026-81599', 'Annual', '36', 2500.00, 24752.75, 15635.25, 550.00, '[{\"name\":\"Grade 1 to 6 - Top - . Polo Jacket\",\"quantity\":1,\"total\":550,\"gender\":\"Male\",\"size\":\"XL\"}]', '', 0.00, 0.00, 0.00, '2026-01-26 07:52:15', 0.00, 0.00, NULL),
(120, '69442124', '2026-97370', 'Quarterly', '36', 2500.00, 24752.75, 15635.25, 550.00, '[{\"name\":\"Grade 1 to 6 - Top - . Polo Jacket\",\"quantity\":1,\"total\":550,\"gender\":\"Male\",\"size\":\"XL\"}]', '', 0.00, 0.00, 0.00, '2026-01-26 07:54:58', 0.00, 0.00, NULL),
(121, '64787065', '2026-52304', 'Semestral', '36', 2500.00, 24752.75, 15635.25, 550.00, '[{\"name\":\"Grade 1 to 6 - Top - . Polo Jacket\",\"quantity\":1,\"total\":550,\"gender\":\"Male\",\"size\":\"XL\"}]', '', 0.00, 0.00, 0.00, '2026-01-26 07:56:15', 0.00, 0.00, NULL),
(122, '59954927', '2025-92581', 'Annual', '49', 2500.00, 22341.00, 16359.00, 0.00, 'null', '', 0.00, 0.00, 0.00, '2026-01-26 13:51:18', 0.00, 0.00, NULL),
(123, '99614897', '2025-92581', 'Annual', '49', 2500.00, 22341.00, 16359.00, 550.00, '[{\"name\":\"Grade 1 to 6 - Top - . Polo Jacket\",\"quantity\":1,\"total\":550,\"gender\":\"Male\",\"size\":\"L\"}]', '', 0.00, 0.00, 0.00, '2026-01-26 13:54:23', 0.00, 0.00, NULL),
(124, '66979562', '2025-92581', 'Semestral', '49', 2500.00, 22341.00, 16359.00, 550.00, '[{\"name\":\"Grade 1 to 6 - Top - . Polo Jacket\",\"quantity\":1,\"total\":550,\"gender\":\"Male\",\"size\":\"XL\"}]', '', 0.00, 0.00, 0.00, '2026-01-26 13:55:21', 0.00, 0.00, NULL),
(125, '92663399', '2026-01457', 'Annual', '24', 2500.00, 24752.75, 15635.25, 0.00, 'null', '', 0.00, 0.00, 0.00, '2026-01-26 14:21:36', 0.00, 0.00, NULL),
(126, '00251750', '2026-16121', 'Annual', '24', 2500.00, 24752.75, 15635.25, 550.00, '[{\"name\":\"Grade 1 to 6 - Top - . Polo Jacket\",\"quantity\":1,\"total\":550,\"gender\":\"Male\",\"size\":\"XL\"}]', '', 0.00, 0.00, 1000.00, '2026-01-26 14:39:16', 0.00, 0.00, NULL),
(127, '38532217', '2026-15821', 'Semestral', '24', 2500.00, 24752.75, 15635.25, 550.00, '[{\"name\":\"Grade 1 to 6 - Top - . Polo Jacket\",\"quantity\":1,\"total\":550,\"gender\":\"Male\",\"size\":\"XL\"}]', '', 0.00, 0.00, 2000.00, '2026-01-26 14:40:30', 0.00, 0.00, NULL),
(128, '46211993', '2026-11035', 'Quarterly', '24', 2500.00, 24752.75, 15635.25, 550.00, '[{\"name\":\"Grade 1 to 6 - Top - . Polo Jacket\",\"quantity\":1,\"total\":550,\"gender\":\"Male\",\"size\":\"XL\"}]', '', 0.00, 0.00, 1500.00, '2026-01-26 14:41:27', 0.00, 0.00, NULL),
(129, '69578600', '2026-46344', 'Semestral', '24', 2500.00, 24752.75, 15635.25, 0.00, 'null', '', 0.00, 0.00, 0.00, '2026-01-26 14:49:00', 0.00, 0.00, NULL),
(130, '06830064', '2026-56283', 'Annual', '24', 2500.00, 24752.75, 15635.25, 0.00, 'null', '', 0.00, 0.00, 0.00, '2026-01-26 14:51:14', 0.00, 0.00, NULL),
(131, '78352769', '2026-60434', 'Semestral', '24', 2500.00, 24752.75, 15635.25, 550.00, '[{\"name\":\"Grade 1 to 6 - Top - . Polo Jacket\",\"quantity\":1,\"total\":550,\"gender\":\"Male\",\"size\":\"S\"}]', '', 0.00, 0.00, 0.00, '2026-01-26 14:56:16', 0.00, 0.00, NULL),
(132, '75431550', '2026-84029', 'Semestral', '24', 2500.00, 24752.75, 15635.25, 550.00, '[{\"name\":\"Grade 1 to 6 - Top - . Polo Jacket\",\"quantity\":1,\"total\":550,\"gender\":\"Male\",\"size\":\"XL\"}]', '', 0.00, 0.00, 0.00, '2026-01-26 14:57:17', 0.00, 0.00, NULL),
(133, '17471750', '2026-24269', 'Annual', '24', 2500.00, 24752.75, 15635.25, 550.00, '[{\"name\":\"Grade 1 to 6 - Top - . Polo Jacket\",\"quantity\":1,\"total\":550,\"gender\":\"Male\",\"size\":\"XL\"}]', '', 0.00, 0.00, 0.00, '2026-01-26 14:59:19', 0.00, 0.00, NULL),
(134, '80957183', '2026-30551', 'Annual', '37', 2500.00, 24752.75, 15635.25, 550.00, '[{\"name\":\"Grade 1 to 6 - Top - . Polo Jacket\",\"quantity\":1,\"total\":550,\"gender\":\"Male\",\"size\":\"XL\"}]', '', 0.00, 0.00, 0.00, '2026-01-26 15:55:36', 0.00, 0.00, NULL),
(135, '65090314', '2026-45481', 'Quarterly', '37', 2500.00, 24752.75, 15635.25, 550.00, '[{\"name\":\"Grade 1 to 6 - Top - . Polo Jacket\",\"quantity\":1,\"total\":550,\"gender\":\"Male\",\"size\":\"XL\"}]', '', 0.00, 0.00, 10000.00, '2026-01-26 15:56:58', 0.00, 0.00, NULL),
(136, '81933037', '2026-60149', 'Annual', '37', 2500.00, 24752.75, 15635.25, 550.00, '[{\"name\":\"Grade 1 to 6 - Top - . Polo Jacket\",\"quantity\":1,\"total\":550,\"gender\":\"Male\",\"size\":\"S\"}]', '', 0.00, 0.00, 1000.00, '2026-01-26 16:00:32', 0.00, 0.00, NULL),
(137, '83423090', '2026-28474', 'Semestral', '37', 2500.00, 24752.75, 15635.25, 1100.00, '[{\"name\":\"Grade 1 to 6 - Top - . Polo Jacket\",\"quantity\":1,\"total\":550,\"gender\":\"Male\",\"size\":\"XL\"},{\"name\":\"Grade 1 to 6 - Top - . Polo Jacket\",\"quantity\":1,\"total\":550,\"gender\":\"Male\",\"size\":\"M\"}]', '', 0.00, 0.00, 2100.00, '2026-01-26 16:02:36', 0.00, 0.00, NULL),
(138, '46188730', '2026-27756', 'Semestral', '37', 2500.00, 24752.75, 15635.25, 550.00, '[{\"name\":\"Grade 1 to 6 - Top - . Polo Jacket\",\"quantity\":1,\"total\":550,\"gender\":\"Male\",\"size\":\"XL\"}]', '', 0.00, 0.00, 2000.00, '2026-01-26 16:09:21', 0.00, 0.00, NULL),
(139, '91178555', '2026-22353', 'Annual', '37', 2500.00, 24752.75, 15635.25, 550.00, '[{\"name\":\"Grade 1 to 6 - Top - . Polo Jacket\",\"quantity\":1,\"total\":550,\"gender\":\"Male\",\"size\":\"S\"}]', '', 0.00, 0.00, 0.00, '2026-01-26 16:13:33', 0.00, 0.00, NULL),
(140, '92997256', '2026-01328', 'Quarterly', '37', 2500.00, 24752.75, 15635.25, 550.00, '[{\"name\":\"Grade 1 to 6 - Top - . Polo Jacket\",\"quantity\":1,\"total\":550,\"gender\":\"Male\",\"size\":\"XL\"}]', 'fixed', 200.00, 200.00, 1000.00, '2026-01-26 16:15:37', 0.00, 0.00, NULL),
(141, '28356840', '2026-79170', 'Quarterly', '37', 2500.00, 24752.75, 15635.25, 550.00, '[{\"name\":\"Grade 1 to 6 - Top - . Polo Jacket\",\"quantity\":1,\"total\":550,\"gender\":\"Male\",\"size\":\"S\"}]', '', 0.00, 0.00, 0.00, '2026-01-26 16:17:09', 0.00, 0.00, NULL),
(142, '93058000', '2026-13541', 'Semestral', '37', 2500.00, 24752.75, 15635.25, 550.00, '[{\"name\":\"Grade 1 to 6 - Top - . Polo Jacket\",\"quantity\":1,\"total\":550,\"gender\":\"Male\",\"size\":\"S\"}]', '', 0.00, 0.00, 0.00, '2026-01-26 16:19:15', 0.00, 0.00, NULL),
(143, '80459755', '2026-94929', 'Annual', '37', 2500.00, 24752.75, 15635.25, 1190.00, '[{\"name\":\"Grade 1 to 6 - Top - . Polo Jacket\",\"quantity\":1,\"total\":550,\"gender\":\"Male\",\"size\":\"XL\"},{\"name\":\"Grade 11 to 12 - Top - . Long Sleeves\",\"quantity\":1,\"total\":640,\"gender\":\"Male\",\"size\":\"M\"}]', '', 0.00, 0.00, 30000.00, '2026-01-26 16:20:18', 0.00, 0.00, NULL),
(144, '48139337', '2026-06530', 'Annual', '52', 2500.00, 29118.00, 15635.25, 550.00, '[{\"name\":\"Grade 1 to 6 - Top - . Polo Jacket\",\"quantity\":1,\"total\":550,\"gender\":\"Male\",\"size\":\"XL\"}]', '', 0.00, 0.00, 0.00, '2026-01-26 17:41:35', 0.00, 0.00, NULL),
(145, '09970230', '2026-42132', 'Annual', '52', 2500.00, 29118.00, 15635.25, 550.00, '[{\"name\":\"Grade 1 to 6 - Top - . Polo Jacket\",\"quantity\":1,\"total\":550,\"gender\":\"Male\",\"size\":\"XL\"}]', '', 0.00, 0.00, 4000.00, '2026-01-26 17:43:24', 0.00, 0.00, NULL),
(146, '99838023', '2026-65975', 'Semestral', '52', 2500.00, 29118.00, 15635.25, 1100.00, '[{\"name\":\"Grade 1 to 6 - Top - . Polo Jacket\",\"quantity\":2,\"total\":1100,\"gender\":\"Male\",\"size\":\"S\"}]', '', 0.00, 0.00, 1500.00, '2026-01-26 17:45:40', 0.00, 0.00, NULL),
(147, '10298961', '2026-39854', 'Annual', '52', 2500.00, 29118.00, 15635.25, 1100.00, '[{\"name\":\"Grade 1 to 6 - Top - . Polo Jacket\",\"quantity\":2,\"total\":1100,\"gender\":\"Male\",\"size\":\"XL\"}]', '', 0.00, 0.00, 0.00, '2026-01-26 17:46:34', 0.00, 0.00, NULL),
(148, '29135437', '2026-82498', 'Annual', '52', 2500.00, 29118.00, 15635.25, 1100.00, '[{\"name\":\"Grade 1 to 6 - Top - . Polo Jacket\",\"quantity\":2,\"total\":1100,\"gender\":\"Male\",\"size\":\"XL\"}]', '', 0.00, 0.00, 0.00, '2026-01-26 17:48:41', 0.00, 0.00, NULL),
(149, '21089339', '2026-99171', 'Monthly', '52', 2500.00, 29118.00, 15635.25, 550.00, '[{\"name\":\"Grade 1 to 6 - Top - . Polo Jacket\",\"quantity\":1,\"total\":550,\"gender\":\"Male\",\"size\":\"XL\"}]', '', 0.00, 0.00, 0.00, '2026-01-26 17:49:25', 0.00, 0.00, NULL),
(150, '00832916', '2026-79611', 'Semestral', '52', 2500.00, 29118.00, 15635.25, 550.00, '[{\"name\":\"Grade 1 to 6 - Top - . Polo Jacket\",\"quantity\":1,\"total\":550,\"gender\":\"Male\",\"size\":\"XL\"}]', '', 0.00, 0.00, 0.00, '2026-01-26 17:50:13', 0.00, 0.00, NULL),
(151, '84499994', '2026-49576', 'Annual', '52', 2500.00, 29118.00, 15635.25, 1100.00, '[{\"name\":\"Grade 1 to 6 - Top - . Polo Jacket\",\"quantity\":2,\"total\":1100,\"gender\":\"Male\",\"size\":\"M\"}]', '', 0.00, 0.00, 0.00, '2026-01-26 17:51:35', 0.00, 0.00, NULL),
(152, '49797981', '2026-21013', 'Annual', '52', 2500.00, 29118.00, 15635.25, 1240.00, '[{\"name\":\"Grade 7 to 10 - Top - . Polo Barong\",\"quantity\":2,\"total\":1240,\"gender\":\"Male\",\"size\":\"XL\"}]', '', 0.00, 0.00, 0.00, '2026-01-26 17:52:47', 0.00, 0.00, NULL),
(153, '10329946', '2026-16637', 'Annual', '52', 2500.00, 29118.00, 15635.25, 1240.00, '[{\"name\":\"Grade 7 to 10 - Top - . Polo Barong\",\"quantity\":2,\"total\":1240,\"gender\":\"Male\",\"size\":\"L\"}]', '', 0.00, 0.00, 0.00, '2026-01-26 17:55:41', 0.00, 0.00, NULL),
(154, '80839153', '2025-92581', 'Annual', '49', 2500.00, 22341.00, 16359.00, 0.00, 'null', '', 0.00, 0.00, 0.00, '2026-01-26 19:35:25', 0.00, 0.00, NULL),
(155, '32699896', '2026-04231', 'Annual', '26', 2500.00, 29118.00, 15635.25, 620.00, '[{\"name\":\"Grade 7 to 10 - Top - . Polo Barong\",\"quantity\":1,\"total\":620,\"gender\":\"Male\",\"size\":\"S\"}]', '', 0.00, 0.00, 0.00, '2026-01-26 19:55:50', 0.00, 0.00, NULL),
(156, '02195485', '2026-30964', 'Annual', '26', 2500.00, 29118.00, 15635.25, 620.00, '[{\"name\":\"Grade 7 to 10 - Top - . Polo Barong\",\"quantity\":1,\"total\":620,\"gender\":\"Male\",\"size\":\"XL\"}]', '', 0.00, 0.00, 0.00, '2026-01-26 19:56:50', 0.00, 0.00, NULL),
(157, '11170632', '2026-99883', 'Annual', '26', 2500.00, 29118.00, 15635.25, 640.00, '[{\"name\":\"Grade 11 to 12 - Top - . Long Sleeves\",\"quantity\":1,\"total\":640,\"gender\":\"Male\",\"size\":\"XS\"}]', '', 0.00, 0.00, 0.00, '2026-01-26 20:06:37', 0.00, 0.00, NULL),
(158, '67824762', '2026-14990', 'Semestral', '26', 2500.00, 29118.00, 15635.25, 1280.00, '[{\"name\":\"Grade 11 to 12 - Top - . Long Sleeves\",\"quantity\":2,\"total\":1280,\"gender\":\"Male\",\"size\":\"L\"}]', '', 0.00, 0.00, 0.00, '2026-01-26 20:07:48', 0.00, 0.00, NULL),
(159, '66939741', '2026-25323', 'Annual', '26', 2500.00, 29118.00, 15635.25, 1280.00, '[{\"name\":\"Grade 11 to 12 - Top - . Long Sleeves\",\"quantity\":2,\"total\":1280,\"gender\":\"Male\",\"size\":\"L\"}]', '', 0.00, 0.00, 0.00, '2026-01-26 20:08:35', 0.00, 0.00, NULL),
(160, '31668101', '2026-98241', 'Semestral', '26', 2500.00, 29118.00, 15635.25, 1240.00, '[{\"name\":\"Grade 7 to 10 - Top - . Polo Barong\",\"quantity\":2,\"total\":1240,\"gender\":\"Male\",\"size\":\"XS\"}]', '', 0.00, 0.00, 0.00, '2026-01-26 20:09:46', 0.00, 0.00, NULL),
(161, '83540623', '2026-00512', 'Annual', '26', 2500.00, 29118.00, 15635.25, 1280.00, '[{\"name\":\"Grade 11 to 12 - Top - . Long Sleeves\",\"quantity\":2,\"total\":1280,\"gender\":\"Male\",\"size\":\"M\"}]', '', 0.00, 0.00, 0.00, '2026-01-26 20:11:10', 0.00, 0.00, NULL),
(162, '18458501', '2026-68993', 'Annual', '26', 2500.00, 29118.00, 15635.25, 0.00, 'null', '', 0.00, 0.00, 0.00, '2026-01-26 20:20:28', 0.00, 0.00, NULL),
(163, '77302662', '2026-85865', 'Semestral', '26', 2500.00, 29118.00, 15635.25, 620.00, '[{\"name\":\"Grade 7 to 10 - Top - . Polo Barong\",\"quantity\":1,\"total\":620,\"gender\":\"Male\",\"size\":\"L\"}]', '', 0.00, 0.00, 0.00, '2026-01-26 20:21:27', 0.00, 0.00, NULL),
(164, '11691709', '2026-10963', 'Semestral', '26', 2500.00, 29118.00, 15635.25, 1240.00, '[{\"name\":\"Grade 7 to 10 - Top - . Polo Barong\",\"quantity\":2,\"total\":1240,\"gender\":\"Male\",\"size\":\"M\"}]', '', 0.00, 0.00, 0.00, '2026-01-26 20:22:09', 0.00, 0.00, NULL),
(165, '02890845', '2026-78381', 'Annual', '27', 2500.00, 29118.00, 15635.25, 620.00, '[{\"name\":\"Grade 7 to 10 - Top - . Polo Barong\",\"quantity\":1,\"total\":620,\"gender\":\"Male\",\"size\":\"XL\"}]', '', 0.00, 0.00, 0.00, '2026-01-26 20:35:45', 0.00, 0.00, NULL),
(166, '15415578', '2026-38813', 'Annual', '27', 2500.00, 29118.00, 15635.25, 620.00, '[{\"name\":\"Grade 7 to 10 - Top - . Polo Barong\",\"quantity\":1,\"total\":620,\"gender\":\"Male\",\"size\":\"M\"}]', '', 0.00, 0.00, 0.00, '2026-01-26 20:36:46', 0.00, 0.00, NULL),
(167, '71298016', '2026-12855', 'Semestral', '27', 2500.00, 29118.00, 15635.25, 620.00, '[{\"name\":\"Grade 7 to 10 - Top - . Polo Barong\",\"quantity\":1,\"total\":620,\"gender\":\"Male\",\"size\":\"XS\"}]', '', 0.00, 0.00, 0.00, '2026-01-26 20:37:28', 0.00, 0.00, NULL),
(168, '35671289', '2026-46142', 'Annual', '27', 2500.00, 29118.00, 15635.25, 620.00, '[{\"name\":\"Grade 7 to 10 - Top - . Polo Barong\",\"quantity\":1,\"total\":620,\"gender\":\"Male\",\"size\":\"XS\"}]', '', 0.00, 0.00, 0.00, '2026-01-26 20:38:07', 0.00, 0.00, NULL),
(169, '31711042', '2026-02783', 'Annual', '27', 2500.00, 29118.00, 15635.25, 1240.00, '[{\"name\":\"Grade 7 to 10 - Top - . Polo Barong\",\"quantity\":2,\"total\":1240,\"gender\":\"Male\",\"size\":\"XS\"}]', '', 0.00, 0.00, 0.00, '2026-01-26 20:38:46', 0.00, 0.00, NULL),
(170, '09038973', '2026-04886', 'Annual', '27', 2500.00, 29118.00, 15635.25, 0.00, 'null', '', 0.00, 0.00, 0.00, '2026-01-26 21:11:43', 0.00, 0.00, NULL),
(171, '59033415', '2026-96232', 'Semestral', '27', 2500.00, 29118.00, 15635.25, 1240.00, '[{\"name\":\"Grade 7 to 10 - Top - . Polo Barong\",\"quantity\":2,\"total\":1240,\"gender\":\"Male\",\"size\":\"S\"}]', '', 0.00, 0.00, 0.00, '2026-01-26 21:12:34', 0.00, 0.00, NULL),
(172, '47446233', '2026-62215', 'Quarterly', '27', 2500.00, 29118.00, 15635.25, 620.00, '[{\"name\":\"Grade 7 to 10 - Top - . Polo Barong\",\"quantity\":1,\"total\":620,\"gender\":\"Male\",\"size\":\"XL\"}]', '', 0.00, 0.00, 0.00, '2026-01-26 21:13:26', 0.00, 0.00, NULL),
(173, '61040770', '2026-85324', 'Annual', '27', 2500.00, 29118.00, 15635.25, 620.00, '[{\"name\":\"Grade 7 to 10 - Top - . Polo Barong\",\"quantity\":1,\"total\":620,\"gender\":\"Male\",\"size\":\"L\"}]', '', 0.00, 0.00, 0.00, '2026-01-26 21:14:05', 0.00, 0.00, NULL),
(174, '52431794', '2026-99202', 'Semestral', '27', 2500.00, 29118.00, 15635.25, 620.00, '[{\"name\":\"Grade 7 to 10 - Top - . Polo Barong\",\"quantity\":1,\"total\":620,\"gender\":\"Male\",\"size\":\"M\"}]', '', 0.00, 0.00, 0.00, '2026-01-26 21:14:51', 0.00, 0.00, NULL),
(175, '76361005', '2026-03228', 'Annual', '28', 2500.00, 29545.75, 15635.25, 620.00, '[{\"name\":\"Grade 7 to 10 - Top - . Polo Barong\",\"quantity\":1,\"total\":620,\"gender\":\"Male\",\"size\":\"S\"}]', '', 0.00, 0.00, 0.00, '2026-01-26 21:25:00', 0.00, 0.00, NULL),
(176, '71549294', '2026-94009', 'Annual', '28', 2500.00, 29545.75, 15635.25, 620.00, '[{\"name\":\"Grade 7 to 10 - Top - . Polo Barong\",\"quantity\":1,\"total\":620,\"gender\":\"Male\",\"size\":\"XL\"}]', '', 0.00, 0.00, 0.00, '2026-01-26 21:26:08', 0.00, 0.00, NULL),
(177, '00196015', '2026-57197', 'Monthly', '28', 2500.00, 29545.75, 15635.25, 620.00, '[{\"name\":\"Grade 7 to 10 - Top - . Polo Barong\",\"quantity\":1,\"total\":620,\"gender\":\"Male\",\"size\":\"XS\"}]', '', 0.00, 0.00, 0.00, '2026-01-26 21:26:55', 0.00, 0.00, NULL),
(178, '11052792', '2026-12726', 'Semestral', '28', 2500.00, 29545.75, 15635.25, 620.00, '[{\"name\":\"Grade 7 to 10 - Top - . Polo Barong\",\"quantity\":1,\"total\":620,\"gender\":\"Male\",\"size\":\"S\"}]', '', 0.00, 0.00, 0.00, '2026-01-26 21:27:35', 0.00, 0.00, NULL),
(179, '16988589', '2026-95652', 'Quarterly', '28', 2500.00, 29545.75, 15635.25, 620.00, '[{\"name\":\"Grade 7 to 10 - Top - . Polo Barong\",\"quantity\":1,\"total\":620,\"gender\":\"Male\",\"size\":\"M\"}]', '', 0.00, 0.00, 0.00, '2026-01-26 21:28:13', 0.00, 0.00, NULL),
(180, '46366241', '2026-67994', 'Annual', '28', 2500.00, 29545.75, 15635.25, 620.00, '[{\"name\":\"Grade 7 to 10 - Top - . Polo Barong\",\"quantity\":1,\"total\":620,\"gender\":\"Male\",\"size\":\"S\"}]', '', 0.00, 0.00, 0.00, '2026-01-26 21:28:50', 0.00, 0.00, NULL),
(181, '34343701', '2026-66213', 'Quarterly', '28', 2500.00, 29545.75, 15635.25, 620.00, '[{\"name\":\"Grade 7 to 10 - Top - . Polo Barong\",\"quantity\":1,\"total\":620,\"gender\":\"Male\",\"size\":\"M\"}]', '', 0.00, 0.00, 0.00, '2026-01-26 21:29:39', 0.00, 0.00, NULL),
(182, '60930373', '2026-42492', 'Annual', '28', 2500.00, 29545.75, 15635.25, 620.00, '[{\"name\":\"Grade 7 to 10 - Top - . Polo Barong\",\"quantity\":1,\"total\":620,\"gender\":\"Male\",\"size\":\"M\"}]', '', 0.00, 0.00, 0.00, '2026-01-26 21:30:21', 0.00, 0.00, NULL),
(183, '75751966', '2026-91546', 'Semestral', '28', 2500.00, 29545.75, 15635.25, 620.00, '[{\"name\":\"Grade 7 to 10 - Top - . Polo Barong\",\"quantity\":1,\"total\":620,\"gender\":\"Male\",\"size\":\"XS\"}]', '', 0.00, 0.00, 0.00, '2026-01-26 21:31:05', 0.00, 0.00, NULL),
(184, '78249769', '2026-23038', 'Annual', '28', 2500.00, 29545.75, 15635.25, 620.00, '[{\"name\":\"Grade 7 to 10 - Top - . Polo Barong\",\"quantity\":1,\"total\":620,\"gender\":\"Male\",\"size\":\"XL\"}]', '', 0.00, 0.00, 0.00, '2026-01-26 21:36:12', 0.00, 0.00, NULL),
(185, '52784972', '2026-10513', 'Semestral', '21', 2500.00, 24200.75, 15635.25, 550.00, '[{\"name\":\"Grade 1 to 6 - Top - . Polo Jacket\",\"quantity\":1,\"total\":550,\"gender\":\"Male\",\"size\":\"XL\"}]', '', 0.00, 0.00, 0.00, '2026-01-28 20:15:11', 0.00, 0.00, NULL),
(186, '51489783', '2026-69187', 'Semestral', '72', 2500.00, 24200.75, 15635.25, 0.00, 'null', '', 0.00, 0.00, 0.00, '2026-01-29 06:00:54', 0.00, 0.00, NULL),
(187, '58238767', '2026-12877', 'Quarterly', '80', 2500.00, 22341.00, 16359.00, 860.00, '[{\"name\":\"Nursery to Kinder - Top - . Polo Jacket with Lining\",\"quantity\":1,\"total\":430,\"gender\":\"Male\",\"size\":\"S\"},{\"name\":\"Nursery to Kinder - Top - . Polo Jacket with Lining\",\"quantity\":1,\"total\":430,\"gender\":\"Male\",\"size\":\"XS\"}]', '', 0.00, 0.00, 2500.00, '2026-01-29 09:13:01', 0.00, 0.00, NULL),
(188, '04853694', '2026-17755', 'Annual', '53', 2500.00, 24200.75, 15635.25, 550.00, '[{\"name\":\"Grade 1 to 6 - Top - . Polo Jacket\",\"quantity\":1,\"total\":550,\"gender\":\"Male\",\"size\":\"S\"}]', '', 0.00, 0.00, 2500.00, '2026-02-02 09:12:35', 0.00, 0.00, NULL),
(189, '47250099', '2026-33670', 'Annual', '53', 2500.00, 24200.75, 15635.25, 0.00, 'null', 'percent', 5.00, 1991.80, 0.00, '2026-02-02 09:13:54', 0.00, 0.00, NULL),
(190, '89774955', '2025-92581', 'Annual', '80', 2500.00, 22341.00, 16359.00, 550.00, '[{\"name\":\"Grade 1 to 6 - Top - . Polo Jacket\",\"quantity\":1,\"total\":550,\"gender\":\"Male\",\"size\":\"XL\"}]', 'fixed', 0.00, 0.00, 2500.00, '2026-02-04 16:28:24', 0.00, 0.00, NULL),
(191, '00136177', '2025-92581', 'Annual', '80', 2500.00, 22341.00, 16359.00, 0.00, 'null', '', 0.00, 0.00, 0.00, '2026-02-04 17:11:50', 0.00, 0.00, NULL),
(192, '76177576', '2026-29702', 'Annual', '80', 2500.00, 22341.00, 16359.00, 0.00, 'null', '', 0.00, 0.00, 0.00, '2026-02-04 17:11:50', 0.00, 0.00, NULL),
(193, '90079772', '2026-93717', 'Annual', '80', 2500.00, 22341.00, 16359.00, 0.00, 'null', '', 0.00, 0.00, 0.00, '2026-02-04 17:11:51', 0.00, 0.00, NULL),
(194, '71995794', '2026-92299', 'Annual', '80', 2500.00, 22341.00, 16359.00, 0.00, 'null', '', 0.00, 0.00, 0.00, '2026-02-04 17:11:51', 0.00, 0.00, NULL),
(195, '48092070', '2026-11186', 'Annual', '53', 2500.00, 24200.75, 15635.25, 0.00, 'null', '', 0.00, 0.00, 0.00, '2026-02-04 17:12:17', 0.00, 0.00, NULL),
(196, '17578400', '2026-93506', 'Annual', '53', 2500.00, 24200.75, 15635.25, 0.00, 'null', '', 0.00, 0.00, 0.00, '2026-02-04 17:15:04', 0.00, 0.00, NULL),
(197, '04343737', '2026-26115', 'Annual', '53', 2500.00, 24200.75, 15635.25, 550.00, '[{\"name\":\"Grade 1 to 6 - Top - . Polo Jacket\",\"quantity\":1,\"total\":550,\"gender\":\"Male\",\"size\":\"XL\"}]', 'percent', 2.00, 807.72, 2500.00, '2026-02-07 10:51:35', 0.00, 0.00, NULL),
(198, '69472593', '2026-24920', 'Quarterly', '53', 2500.00, 24200.75, 15635.25, 550.00, '[{\"name\":\"Grade 1 to 6 - Top - . Polo Jacket\",\"quantity\":1,\"total\":550,\"gender\":\"Male\",\"size\":\"S\"}]', '', 0.00, 0.00, 0.00, '2026-02-14 03:34:01', 41336.00, 1500.00, NULL),
(199, '68252982', '2026-32660', 'Quarterly', '53', 2500.00, 24200.75, 15635.25, 0.00, '[]', 'percent', 10.00, 3983.60, 0.00, '2026-02-14 04:14:42', 38915.92, 1500.00, NULL),
(200, '68451407', '2026-72104', 'Quarterly', '72', 2500.00, 24200.75, 15635.25, 0.00, '[]', 'percent', 10.00, 4133.60, 0.00, '2026-02-14 05:00:22', 37202.40, 1500.00, 'Loyalty Voucher');

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
(21, 'RL', 'Read and Literacy', 'Grade 1', 2),
(22, 'Fil', 'Filipino', 'Grade 1', 1),
(23, 'Math', 'Mathematics', 'Grade 1', 1),
(24, 'Scie', 'Science', 'Grade 1', 1),
(25, 'MK', 'Makabansa', 'Grade 1', 1),
(26, 'GMRC', 'Good Manner and Right Conduct', 'Grade 1', 1),
(27, 'MAPEH', 'Music Arts - Physical Education and Health', 'Grade 1', 1),
(28, 'AP', 'Araling Panlipunan', 'Grade 10', 1),
(29, 'EPP', 'Edukasyong Pantahanan at Pangkabuhayan', 'Grade 1', 1),
(30, 'TLE', 'Technology and Livelihood Education', 'Grade 10', 1),
(31, 'ICT', 'Information and Communication Technology', 'Grade 10', 1),
(32, 'Eng', 'English', 'Grade 1', 1),
(34, 'Langa', 'Language', 'Kinder Gar', 1),
(36, 'LLC', 'Literacy, Language, and Communication', 'Nursery', 1),
(37, 'SED', 'Socio-Emotional Development', 'Nursery', 1),
(38, 'ValD', 'Values Development', 'Nursery', 1),
(39, 'PHMD', 'Physical Health and Motor Development', 'Nursery', 1),
(40, 'ACD', 'Aesthetic / Creative Development', 'Nursery', 1),
(41, 'CogDev', 'Cognitive Devoelopment', 'Nursery', 1),
(42, 'ESP', 'Edukasyon sa Pagpapakatao', 'Grade 6', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tuition_fees`
--

CREATE TABLE `tuition_fees` (
  `id` int(11) NOT NULL,
  `grade_level` varchar(50) NOT NULL,
  `tuition_fee` decimal(10,2) NOT NULL DEFAULT 0.00,
  `miscellaneous` decimal(10,2) NOT NULL DEFAULT 0.00,
  `total` decimal(10,2) NOT NULL,
  `scheme` text CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tuition_fees`
--

INSERT INTO `tuition_fees` (`id`, `grade_level`, `tuition_fee`, `miscellaneous`, `total`, `scheme`) VALUES
(1, 'Nursery', 22341.00, 16359.00, 38700.00, '{\n  \"tuition\": 22341.00,\n  \"miscellaneous\": 16359.00,\n  \"cash_total\": 38700.00,\n  \"payment_totals\": {\n    \"annual\": 38700.00,\n    \"semestral\": 39700.00,\n    \"quarterly\": 40200.00,\n    \"monthly\": 40700.50\n  }\n}\n'),
(2, 'Kinder', 24283.75, 16359.00, 40642.75, '{\n  \"tuition\": 24283.75,\n  \"miscellaneous\": 16359.00,\n  \"cash_total\": 40642.75,\n  \"payment_totals\": {\n    \"annual\": 40642.75,\n    \"semestral\": 41643.00,\n    \"quarterly\": 42143.00,\n    \"monthly\": 42644.50\n  }\n}\n'),
(3, 'Grade 1', 24200.75, 15635.25, 39836.00, '{\n  \"tuition\": 24200.75,\n  \"miscellaneous\": 15635.25,\n  \"cash_total\": 39836.00,\n  \"payment_totals\": {\n    \"annual\": 39836.00,\n    \"semestral\": 40836.00,\n    \"quarterly\": 41336.00,\n    \"monthly\": 41836.75\n  }\n}\n'),
(4, 'Grade 2', 24200.75, 15635.25, 39836.00, '{\n  \"tuition\": 24200.75,\n  \"miscellaneous\": 15635.25,\n  \"cash_total\": 39836.00,\n  \"payment_totals\": {\n    \"annual\": 39836.00,\n    \"semestral\": 40836.00,\n    \"quarterly\": 41336.00,\n    \"monthly\": 41836.75\n  }\n}\n'),
(5, 'Grade 3', 24200.75, 15635.25, 39836.00, '{\n  \"tuition\": 24200.75,\n  \"miscellaneous\": 15635.25,\n  \"cash_total\": 39836.00,\n  \"payment_totals\": {\n    \"annual\": 39836.00,\n    \"semestral\": 40836.00,\n    \"quarterly\": 41336.00,\n    \"monthly\": 41836.75\n  }\n}\n'),
(6, 'Grade 4', 24752.75, 15635.25, 40388.00, '{\n  \"tuition\": 24752.75,\n  \"miscellaneous\": 15635.25,\n  \"cash_total\": 40388.00,\n  \"payment_totals\": {\n    \"annual\": 40388.00,\n    \"semestral\": 41388.00,\n    \"quarterly\": 41888.00,\n    \"monthly\": 42385.75\n  }\n}\n'),
(7, 'Grade 5', 24752.75, 15635.25, 40388.00, '{\n  \"tuition\": 24752.75,\n  \"miscellaneous\": 15635.25,\n  \"cash_total\": 40388.00,\n  \"payment_totals\": {\n    \"annual\": 40388.00,\n    \"semestral\": 41388.00,\n    \"quarterly\": 41888.00,\n    \"monthly\": 42385.75\n  }\n}\n'),
(8, 'Grade 6', 24752.75, 15635.25, 40388.00, '{\n  \"tuition\": 24752.75,\n  \"miscellaneous\": 15635.25,\n  \"cash_total\": 40388.00,\n  \"payment_totals\": {\n    \"annual\": 40388.00,\n    \"semestral\": 41388.00,\n    \"quarterly\": 41888.00,\n    \"monthly\": 42385.75\n  }\n}\n'),
(9, 'Grade 7', 29118.00, 15635.25, 44753.25, '{\n  \"tuition\": 29118.00,\n  \"miscellaneous\": 15635.25,\n  \"cash_total\": 44753.25,\n  \"payment_totals\": {\n    \"annual\": 44753.25,\n    \"semestral\": 45753.50,\n    \"quarterly\": 46254.00,\n    \"monthly\": 46755.25\n  }\n}\n'),
(10, 'Grade 8', 29118.00, 15635.25, 44753.25, '{\n  \"tuition\": 29118.00,\n  \"miscellaneous\": 15635.25,\n  \"cash_total\": 44753.25,\n  \"payment_totals\": {\n    \"annual\": 44753.25,\n    \"semestral\": 45753.50,\n    \"quarterly\": 46254.00,\n    \"monthly\": 46755.25\n  }\n}\n'),
(11, 'Grade 9', 29118.00, 15635.25, 44753.25, '{\n  \"tuition\": 29118.00,\n  \"miscellaneous\": 15635.25,\n  \"cash_total\": 44753.25,\n  \"payment_totals\": {\n    \"annual\": 44753.25,\n    \"semestral\": 45753.50,\n    \"quarterly\": 46254.00,\n    \"monthly\": 46755.25\n  }\n}\n'),
(12, 'Grade 10', 29545.75, 15635.25, 45181.00, '{\n  \"tuition\": 29545.75,\n  \"miscellaneous\": 15635.25,\n  \"cash_total\": 45181.00,\n  \"payment_totals\": {\n    \"annual\": 45181.00,\n    \"semestral\": 46181.00,\n    \"quarterly\": 46681.00,\n    \"monthly\": 47182.75\n  }\n}'),
(13, 'Grade 11', 0.00, 6980.00, 6980.00, '{\n  \"tuition\": 9930.00,\n  \"miscellaneous\": 6980.00,\n  \"cash_total\": 16910.00,\n  \"payment_totals\": {\n    \"semestral\": 16910.00,\n    \"monthly\": 17910.00\n  }\n}\n'),
(14, 'Grade 12', 0.00, 6980.00, 6980.00, '{\n  \"tuition\": 9930.00,\n  \"miscellaneous\": 6980.00,\n  \"cash_total\": 16910.00,\n  \"payment_totals\": {\n    \"semestral\": 16910.00,\n    \"monthly\": 17910.00\n  }\n}\n');

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
  `student_number` varchar(100) NOT NULL,
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
  `subject` varchar(1000) DEFAULT NULL,
  `role` varchar(100) DEFAULT NULL,
  `notification` int(11) NOT NULL DEFAULT 0,
  `agree` int(11) NOT NULL DEFAULT 0,
  `authentication` text NOT NULL DEFAULT 'False'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `student_number`, `acc_type`, `username`, `email`, `password`, `first_name`, `last_name`, `gender`, `birthdate`, `phone_number`, `address`, `created_at`, `updated_at`, `profile`, `rfid`, `acc_status`, `subject`, `role`, `notification`, `agree`, `authentication`) VALUES
(1, '', 'admin', 'stephani.admin', 'stephani.candado@example.com', '$2y$10$g/GNJXptLs3DD6dFPswRKOOBtCN/fF9ghhlvYmef0oAEBCJC7r./i', 'Stephanie', 'Candado', 'female', '1990-03-15', '09170000001', '101 Admin Ave, Cityville', '2025-06-13 16:58:26', '2026-02-15 06:24:20', '1764641521_692e4af11da68.jpg', NULL, 'active', NULL, 'Administrator', 1, 0, 'False'),
(3, '', 'parent', 'cj.parent', 'floterina@gmail.com', '$2y$10$sMWkRDvbBDHXw7m7PwfHLOeU/Gi9EaipHdnJE2V7hnZvw9JqIxHZa', 'CJ', 'Escalora', 'male', '1982-11-05', '09952970623', '103 Parent Rd, Cityville', '2025-06-13 16:58:26', '2026-02-15 19:49:32', '1760115564_68e93b6c59bf5.jpg', NULL, 'active', NULL, NULL, 1, 0, 'False'),
(38, '', 'teacher', 'tan.teacher', 'tan@gmail.com', '$2y$10$uh2Usb5yLsmVFXtSkjtBH.hx9fWOM04QR6/Q0aS3hdMGRxMOoMyZa', 'Niña Francesca', 'Tan', 'female', '2000-07-12', '', 'Meycauayan, Bulacan', '2025-07-12 15:14:03', '2025-10-09 21:21:34', 'user_38_1752483132.png', NULL, 'active', 'Oral Communication', NULL, 4, 0, 'False'),
(39, '', 'teacher', 'mauricio.teacher', 'torvalds32@gmail.com', '$2y$10$9H5SRUb3b.lj2YfW/c984u82WOGjxRzAf5m03WPaCR2h09DRYBPLi', 'Torvalds', 'Linus', 'female', '2000-07-12', '09120921091', 'Meycauayan, Bulacan', '2025-07-12 15:17:57', '2025-12-16 20:50:33', '1763578035_691e10b3064b6.png', NULL, 'active', 'MK - Makabansa', NULL, 0, 0, 'False'),
(40, '', 'teacher', 'stephany.teacher', 'stephany.teacher@gmail.com', '$2y$10$0HuIJJjj9C6AADPPqtAmyOynhxo4k0Hm3lzo.6fG.nFW3n53s6eXO', 'Stephany', 'Gandula', 'female', '2025-07-12', '09122021211', 'Marilao, Bulacan', '2025-07-12 15:20:06', '2026-02-02 01:30:42', '1757496680_68c14568295bd.png', NULL, 'active', 'Core 1 - Oral Communication', NULL, 0, 0, 'False'),
(41, '', 'teacher', 'delara.teacher', 'delara@gmail.com', '$2y$10$nVP5lPueFtnhvkP5xOv2K.g3I4j.XQGa1.VIQwDC7c2bn2ynPnnc2', 'Ann Nicole', 'De Lara', 'female', '2025-07-12', '', 'Meycauayan, Bulacan', '2025-07-12 15:22:45', '2025-10-09 21:21:34', 'dummy.jpg', NULL, 'active', 'RL - Read and Literacy', NULL, 4, 0, 'False'),
(42, '', 'teacher', 'mancenido.teacher', 'mancenido@gmail.com', '$2y$10$yIVS6RF.CPyGuz0h5z2q7Oe3jvtDSYDRCL7A2aSeL7HTJtExopzT.', 'Kim', 'Mancenido', 'female', '2025-07-12', '', 'Meycauayan, Bulacan', '2025-07-12 15:24:43', '2026-02-06 07:10:05', 'dummy.jpg', NULL, 'active', 'Core 1 - Oral Communication', NULL, 4, 0, 'False'),
(43, '', 'teacher', 'agliam.teacher', 'agliam@gmail.com', '$2y$10$m/50Jsjk.R2dxqoiBP0PKOKfTDNoPB7V6wbrKd8Ji0gro9RZcYvbO', 'Rosilyn', 'Agliam', 'female', '2025-07-12', '', 'Meycauayan, Bulacan', '2025-07-12 15:29:20', '2025-10-09 21:21:34', 'dummy.jpg', NULL, 'active', 'Applied 1 - Research in Daily Life 1', NULL, 4, 0, 'False'),
(44, '', 'teacher', 'delmundo.teacher', 'delmundo@gmail.com', '$2y$10$lgW5SlOLXWrUkUAT58eGRugFkA16TctHxhlEOuBIP59PBtAogXWa6', 'Anna Lie', 'Del Mundo', 'female', '2025-07-12', '', 'Meycauayan, Bulacan', '2025-07-12 15:49:19', '2025-10-09 21:21:34', 'dummy.jpg', NULL, 'active', 'Fil - Filipino', NULL, 4, 0, 'False'),
(45, '', 'teacher', 'velasco.teacher', 'velasco@gmail.com', '$2y$10$FtNJH3xy9TV4IF0xEWb0E.PsG3XEQr09HQCwbNyq0UGTyImjj4..i', 'Ria', 'Velasco', 'female', '2025-07-12', '', 'Meycauayan, Bulacan', '2025-07-12 15:51:08', '2025-10-09 21:21:34', 'dummy.jpg', NULL, 'active', 'Scie - Science', NULL, 4, 0, 'False'),
(46, '', 'teacher', 'ala.teacher', 'ala@gmail.com', '$2y$10$h0UmS37zkA/LhmzdPo0hV.mJKyk9ed2hIaiDrcEV4JBpfMF/3t3mm', 'Leoncia', 'Ala', 'female', '2025-07-12', '', 'Meycauayan, Bulacan', '2025-07-12 15:53:04', '2025-11-29 12:20:27', 'dummy.jpg', NULL, 'active', 'Fil - Filipino', NULL, 4, 0, 'False'),
(47, '', 'teacher', 'talusig.teacher', 'talusig@gmail.com', '$2y$10$wtQUiR485dsFXIGcE8g9uu.gdvLYtOcKUhqt56frg4sJ0nnQakwKi', 'Karl Cedrick', 'Talusig', 'male', '2025-07-12', '', 'Meycauayan, Bulacan', '2025-07-12 15:56:22', '2025-10-09 21:21:34', 'dummy.jpg', NULL, 'active', 'GMRC - Good Manner and Right Conduct', NULL, 4, 0, 'False'),
(48, '', 'teacher', 'pahugot.teacher', 'pahugot@gmail.com', '$2y$10$j6A7E8QccEbd0CBjUdIhVuWePvK8V4o7zhlFgP4OZltLpLGHZ75qm', 'Ellie Ann Joy', 'Pahugot', 'female', '2025-07-12', '', 'Meycauayan, Bulacan', '2025-07-12 15:59:39', '2025-10-09 21:21:34', 'dummy.jpg', NULL, 'active', 'MAPEH - Music Arts - Physical Education and Health', NULL, 4, 0, 'False'),
(49, '', 'teacher', 'martinico.teacher', 'martinico@gmail.com', '$2y$10$c2HJmtwL157JnFUTPVVL8u42bD0JgXYXFkAGCX/zSFm4vZZFvGuIa', 'Jocelyn', 'Martinico', 'female', '2025-07-13', '', 'Meycauayan, Bulacan', '2025-07-12 16:00:40', '2025-10-09 21:21:34', 'dummy.jpg', NULL, 'active', 'Oral Communication', NULL, 4, 0, 'False'),
(50, '', 'teacher', 'delarosa.teacher', 'delarosa@gmail.com', '$2y$10$ANTnWXECyuz8IeMsOaZnuOObJ.tIJ6YlxRFJDUY/M6RCrujRLelOO', 'Merck Justin', 'Dela Rosa', 'male', '2025-07-13', '', 'Meycauayan, Bulacan', '2025-07-12 16:02:08', '2025-11-26 13:49:56', 'dummy.jpg', NULL, 'active', 'Oral Communication', NULL, 0, 0, 'False'),
(51, '', 'teacher', 'navarro.teacher', 'navarro@gmail.com', '$2y$10$8FYQh.l5WkpGikCOxbC0Ou0oPwIRZgcWPaSF8YVpg2XdqZ.ND8Xf.', 'Mark Edrian', 'Navarro', 'male', '2025-07-13', '', 'Meycauayan, Bulacan', '2025-07-12 16:05:30', '2025-12-06 07:34:12', 'dummy.jpg', NULL, 'active', 'Oral Communication', NULL, 0, 0, 'False'),
(102, '2025-52404', 'student', 'noah.ramos.student', 'galecandado@gmail.com', '$2y$10$yKu9MplwbE2UUkVG/Sl1beJ8r3GCO/wsVOrwlbWyyKNE9AWDd1Vaq', 'Noah', 'Ramos', 'male', '2017-05-30', '0917689012', 'Blk 21 Lot 11 Marilao', '2025-10-09 17:31:25', '2026-02-12 23:04:51', 'dummy.jpg', 1603483088, 'active', NULL, NULL, 0, 0, 'False'),
(133, '', '', 'john.doe834.registar', 'sample@Gmail.com', '$2y$10$UR39Zgz9zeDMEkKnDeJzYe3cnjj9PmsUukW.19g/3sTRvPf0gR8ri', 'John', 'DOe', NULL, NULL, '09120912091', NULL, '2025-10-26 23:02:51', '2025-10-26 23:02:51', 'dummy.jpg', NULL, 'active', NULL, NULL, 0, 0, 'False'),
(137, '', 'admin', 'michelle.aguilar311.admin', 'michelle@gmail.com', '$2y$10$rnigt3xcKqE4eNzLU.i.VeoXq5d1y15ElxAXa0yygYMO4BPjp2Iqe', 'Michelle', 'Aguilar', NULL, NULL, '09989887897', NULL, '2025-10-26 23:40:39', '2026-01-29 02:14:42', 'dummy.jpg', NULL, 'active', NULL, 'School Nurse', 0, 0, 'False'),
(141, '', 'admin', 'mhack.jabat129.admin', 'mhack.jabat@gmail.com', '$2y$10$lgD0zXDJTPjQCs1pwaZXcepQCosZtu/etcERGX/LH1MJWWNG49ona', 'Mhack', 'Jabat', '', NULL, '09123456789', '', '2025-11-26 13:21:24', '2026-02-15 06:24:20', 'dummy.jpg', NULL, 'active', NULL, 'Assistant Principal', 83, 0, 'False'),
(143, '', 'admin', 'annazel.marcos830.admin', 'annazel.marcos@gmail.com', '$2y$10$vIi/zQBYGSFnjc9jWORq5e/odt4ZkfXpn5AQDoWnjQfqH..Kr3kNK', 'Anna Zel', 'Marcos', NULL, NULL, '09123456789', '', '2025-11-26 13:42:24', '2026-02-15 06:24:20', 'dummy.jpg', NULL, 'active', NULL, 'Registrar', 3, 0, 'False'),
(146, '', 'admin', 'matthew.candado114.admin', 'candadogale@gmail.com', '$2y$10$TbWpfBVX3AyZIXD.aQN6/.it0wILFCWSiHAU8H0x1ye6jmzssgDgO', 'Matthew', 'Candado', '', NULL, '09683725546', '', '2025-12-02 02:13:38', '2025-12-02 02:15:49', 'dummy.jpg', NULL, 'active', NULL, 'Guidance', 0, 0, 'False'),
(147, '', 'admin', 'dave.bergania478.admin', 'davebergania367@gmail.com', '$2y$10$hJ7S.26em9AY2Rzye/KD7e3PJgK/0i3NhJZGD0hgjh83b88US8waO', 'Dave', 'Bergania', '', NULL, '09683725546', '', '2025-12-02 02:26:57', '2025-12-02 02:28:05', 'dummy.jpg', NULL, 'active', NULL, 'Accounting', 0, 0, 'False'),
(152, '2025-00231', 'student', 'leo.trujillo.student', 'danitrjllo23@gmail.com', '$2y$10$fikdOtfr2WeSEanoLnFX3u2.vk6Atsfm5E6gMUTzur0KHQBsyLuqO', 'Leo', 'Trujillo', 'male', '2019-11-04', '09178234915', 'Lawa, City of Meycauayan, Bulacan, Central Luzon,', '2025-12-04 11:10:18', '2026-01-29 01:52:17', 'dummy.jpg', 1190562885, 'active', NULL, NULL, 1, 0, 'False'),
(153, '2025-11100', 'student', 'franklin.maddox.student', 'sabmaddox11@gmail.com', '$2y$10$c3DwD3X3zeVQaoptMpUMZOMtXIrkMNyF5xQQgdnCU9cMJ8s8wPco6', 'Franklin', 'Maddox', 'male', '2016-03-04', '09178234916', 'Bahay Pare, City of Meycauayan, Bulacan, Central Luzon,', '2025-12-05 23:02:13', '2026-01-29 01:52:17', 'dummy.jpg', 1225095941, 'active', NULL, NULL, 1, 0, 'False'),
(154, '2025-68549', 'student', 'frederic.carney.student', 'sandrac90@gmail.com', '$2y$10$vAfXTPSuD1RtQCBMZrCG8.ZWxFmucB.nrScwCAsEvaClRP1mpI/Iu', 'Frederic', 'Carney', 'male', '2013-07-22', '09178234917', 'Banga, City of Meycauayan, Bulacan, Central Luzon,', '2025-12-05 23:21:48', '2026-01-29 01:52:17', 'dummy.jpg', 1189789925, 'active', NULL, NULL, 1, 0, 'False'),
(155, '2025-71474', 'student', 'adelaide.warren.student', 'elizawarren59@gmail.com', '$2y$10$tAKR9UnyEdrurPqHFYW.BOc3/ezNGmfh7bNh1T9lvVkqLO.dRzvD2', 'Adelaide', 'Warren', 'female', '2008-09-30', '09178234919', 'Malhacan, City of Meycauayan, Bulacan, Central Luzon, ', '2025-12-05 23:26:45', '2026-02-06 17:47:59', 'dummy.jpg', 1225894181, 'active', NULL, NULL, 1, 0, 'False'),
(156, '2025-13565', 'student', 'molly.holman.student', 'oliviah29@gmail.com', '$2y$10$SY1aMJcqPvn2LBb2zhS.geGHt5Jl4EENrDDCsYPqF4/LUfi3x4GJe', 'Molly', 'Holman', 'male', '2006-05-14', '09178234920', 'Pantoc, City of Meycauayan, Bulacan, Central Luzon,', '2025-12-05 23:31:33', '2026-01-29 01:52:17', 'dummy.jpg', 67082781, 'active', NULL, NULL, 1, 0, 'False'),
(157, '', 'parent', 'daniela.trujillo278.parent', 'danitrjllo23@gmail.com', '$2y$10$o6Z.0/MgD/ZQNw0hrkF8t.PK5Rjcy5OGrgUu1DMfMG8VQDeybGn4O', 'Daniela', 'Trujillo', NULL, NULL, '09178234915', NULL, '2025-12-09 22:35:19', '2025-12-09 22:35:19', 'dummy.jpg', NULL, 'active', NULL, NULL, 0, 0, 'False'),
(158, '2025-18633', 'student', 'john.dela cruz.student', 'floterina@gmail.com', '$2y$10$SBojz.n/7inWtSg.z/kEjO01BXMBoGp9sTugOZ4blfcJ213ukm3tC', 'John', 'Dela Cruz', 'male', '2021-02-12', '09120912091', 'Batia, Bocaue, Bulacan, Central Luzon,', '2025-12-17 06:38:57', '2026-01-29 01:52:17', 'dummy.jpg', 2147483647, 'active', NULL, NULL, 1, 0, 'False'),
(159, '2026-02462', 'student', 'sophia mae.jimenez.student', 'sophia.jimenez@gmail.com', '$2y$10$YKv0XwbwdBpYtyb7QcVdeeKf/kYF3jOGJO2kdPY3Iz.pd5bTdmJaK', 'Sophia Mae', 'Jimenez', 'female', '2018-10-05', '09181110020', 'Blk 1 Lot 5, Villa Teresa Subd., Brgy. Camalig, Meycauayan, Bulacan', '2026-01-24 05:15:17', '2026-01-29 01:52:17', 'dummy.jpg', 11111, 'active', NULL, NULL, 1, 0, 'False'),
(160, '2026-37633', 'student', 'adrian paul.evangelista.student', 'adrian.evangelista@gmail.com', '$2y$10$uyMpdn/HQEiW8VXtOBVN3e/igFkuIi7X6QEx3N2aMS3kIc9/AtDNC', 'Adrian Paul', 'Evangelista', 'male', '2018-02-14', '09181110018', '92 Ilang-Ilang St., Brgy. Iba, Meycauayan, Bulacan', '2026-01-24 05:17:03', '2026-01-29 01:52:17', 'dummy.jpg', 22222, 'active', NULL, NULL, 1, 0, 'False'),
(161, '2026-02678', 'student', 'hannah grace.domingo.student', 'hannah.domingo@gmail.com', '$2y$10$RhcxbtBqIpZjHscZrepxUOz2cq/NAIsakDtCf1UlOvmIbaScK5cra', 'Hannah Grace', 'Domingo', 'female', '2018-07-30', '09181110016', 'Unit 11, Riverside Compound, Brgy. Malhacan, Meycauayan, Bulacan', '2026-01-24 05:18:57', '2026-01-29 01:52:17', 'dummy.jpg', 33333, 'active', NULL, NULL, 1, 0, 'False'),
(162, '2026-06420', 'student', 'stephen mark.lopez.student', 'stephen.lopez@gmail.com', '$2y$10$NmPt9CXJZf4woyo6Pkx8EOOdMJnQbuvctdtG5wcSTCplw5hx5XjsG', 'Stephen Mark', 'Lopez', 'male', '2018-03-08', '09181110014', '19 P. Burgos St., Brgy. Langka, Meycauayan, Bulacan', '2026-01-24 05:20:06', '2026-01-29 01:52:17', 'dummy.jpg', 44444, 'active', NULL, NULL, 1, 0, 'False'),
(163, '2026-52670', 'student', 'nicole andrea.manalo.student', 'nicole.manalo@gmail.com', '$2y$10$1sfYvLgmCg5yQezP696Es.TjNiY7vhcQXYBok8A7MfQDGLrVg.iT.', 'Nicole Andrea', 'Manalo', 'female', '2018-05-26', '09181110012', 'Blk 8 Lot 3, Golden Fields Subd., Brgy. Pantoc, Meycauayan, Bulacan', '2026-01-24 05:22:28', '2026-01-29 01:52:17', 'dummy.jpg', 55555, 'active', NULL, NULL, 1, 0, 'False'),
(164, '2026-30598', 'student', 'trisha anne.padilla.student', 'trisha.padilla@gmail.com', '$2y$10$AE0hE10JX0cXCmmk3492Sexp38JYPYD/v87c35RpmcvWqrHq60GEu', 'Trisha Anne', 'Padilla', 'female', '2018-09-11', '09181110009', 'Blk 2 Lot 14, Villa Mercedes Subd., Brgy. Camalig, Meycauayan, Bulacan', '2026-01-24 05:23:47', '2026-01-29 01:52:17', 'dummy.jpg', 66666, 'active', NULL, NULL, 1, 0, 'False'),
(165, '2026-31371', 'student', 'michael vincent.ong.student', 'michael.ong@gmail.com', '$2y$10$jJD0KFGHKwSDVr5xkS.pUOS0fQ1x24Aak47fqRrtBwfCW1OqyUo4W', 'Michael Vincent', 'Ong', 'male', '2018-01-17', '09181110007', '88 Orchid St., Brgy. Iba, Meycauayan, Bulacan', '2026-01-24 05:26:27', '2026-01-29 01:52:17', 'dummy.jpg', 77777, 'active', NULL, NULL, 1, 0, 'False'),
(166, '2026-74343', 'student', 'bea louise.navarro.student', 'bea.navarro@gmail.com', '$2y$10$gCeV.MrbiGmTAQ5zCPnAXO892HaNcmTIX9qPzZBeyLlGvNqWUhHUq', 'Bea Louise', 'Navarro', 'female', '2018-06-21', '09181110005', 'Unit 7, San Jose Compound, Brgy. Malhacan, Meycauayan, Bulacan', '2026-01-24 05:28:30', '2026-01-29 01:52:17', 'dummy.jpg', 88888, 'active', NULL, NULL, 1, 0, 'False'),
(167, '2026-35813', 'student', 'john carlo.alonzo.student', 'john.alonzo@gmail.com', '$2y$10$clYYPXbagQ7vhWXcGZXW.OS7sdIx/bTH5UZSTo8lFRO199Hgux0R6', 'John Carlo', 'Alonzo', 'male', '2018-02-09', '09181110003', '19 Bonifacio St., Brgy. Langka, Meycauayan, Bulacan', '2026-01-24 05:41:26', '2026-01-29 01:52:17', 'dummy.jpg', 99999, 'active', NULL, NULL, 1, 0, 'False'),
(168, '2026-62962', 'student', 'alyssa mae.velasco.student', 'alyssa.velasco@gmail.com', '$2y$10$52jYON2CYZnKiB0vylSUgOo7oZ67XLVMhffi49F7GBAk7fOw59hzG', 'Alyssa Mae', 'Velasco', 'female', '2018-04-15', '09181110001', 'Blk 6 Lot 10, Villa Elena Subd., Brgy. Pantoc, Meycauayan, Bulacan', '2026-01-24 05:42:36', '2026-02-02 01:28:03', 'dummy.jpg', 12111, 'active', NULL, NULL, 4, 0, 'False'),
(169, '2026-16480', 'student', 'kim nicole.zulueta.student', 'kim.zulueta@gmail.com', '$2y$10$IVIUAFL3sSmcYXhsDGT/kew1FFtAqPjx3bnvHaNFiJ2vMeVoi3/56', 'Kim Nicole', 'Zulueta', 'female', '2018-07-18', '09181110040', '26 Bonifacio St., Brgy. Iba, Meycauayan, Bulacan', '2026-01-24 05:43:53', '2026-01-29 01:52:17', 'dummy.jpg', 13111, 'active', NULL, NULL, 1, 0, 'False'),
(170, '2026-04491', 'student', 'daniel ryan.ortega.student', 'd.ortega@gmail.com', '$2y$10$yNrQgTBrXIfnJia7pDVdyeFRy1UHTmg6NEz0FLQ9u6ACY6DjE34GW', 'Daniel Ryan', 'Ortega', 'male', '2018-06-15', '09170000019', '60 Zamora St., Brgy. Pandayan, Meycauayan, Bulacan', '2026-01-24 06:50:00', '2026-01-29 01:52:17', 'dummy.jpg', 14111, 'active', NULL, NULL, 1, 0, 'False'),
(171, '2026-30794', 'student', 'princess mae.navarro.student', 'p.navarro@gmail.com', '$2y$10$1SUV1X2K2GtiMZAX04fTGOtu0MA/W5ghtuvR/.F91tEodPCUoUSAS', 'Princess Mae', 'Navarro', 'female', '2018-06-15', '09170000017', '24 Pacheco St., Brgy. Saluysoy, Meycauayan, Bulacan', '2026-01-24 07:58:09', '2026-01-29 01:52:17', 'dummy.jpg', 15111, 'active', NULL, NULL, 1, 0, 'False'),
(172, '2026-13017', 'student', 'john steven.mendoza.student', 'j.mendoza@gmail.com', '$2y$10$fxkF07yM8SsgxxDPJzFPMexxnhSt2NlMYUy/SrhpApLVBc5u.uioS', 'John Steven', 'Mendoza', 'male', '2018-06-15', '09170000015', '9 Bonifacio St., Brgy. Iba, Meycauayan, Bulacan', '2026-01-24 08:01:34', '2026-01-29 01:52:17', 'dummy.jpg', 16111, 'active', NULL, NULL, 1, 0, 'False'),
(173, '2026-51379', 'student', 'nicole faith.lopez.student', 'n.lopez@gmail.com', '$2y$10$gwShyTLmAZz7GbSPXaMtxeb8Gs0TAVG8PCiz8IWVUD5bCcWzBkrxu', 'Nicole Faith', 'Lopez', 'female', '2018-06-15', '09170000013', '18 Luna St., Brgy. Perez, Meycauayan, Bulacan', '2026-01-24 08:04:47', '2026-01-29 01:52:17', 'dummy.jpg', 17111, 'active', NULL, NULL, 1, 0, 'False'),
(174, '2026-81685', 'student', 'patrick louie.jimenez.student', 'p.jimenez@gmail.com', '$2y$10$cee3Q2Uh3DzWfFFLHT2/GOeIEhBWwmBQw3ODQ9IBAaCkoE6M.G6Q.', 'Patrick Louie', 'Jimenez', 'male', '2018-06-15', '09170000011', '55 Mabini St., Brgy. Malhacan, Meycauayan, Bulacan', '2026-01-24 08:06:42', '2026-01-29 01:52:17', 'dummy.jpg', 18111, 'active', NULL, NULL, 1, 0, 'False'),
(175, '2026-89672', 'student', 'kevin mark.ilagan.student', 'k.ilagan@gmail.com', '$2y$10$ws/K5Iuko7bVWFFuakBZKupS4r0/P89cLEok81Wmf4MExqa0mVnFm', 'Kevin Mark', 'Ilagan', 'male', '2018-06-15', '09170000009', '10 Rizal St., Brgy. Camalig, Meycauayan, Bulacan', '2026-01-24 08:07:55', '2026-01-29 01:52:17', 'dummy.jpg', 19111, 'active', NULL, NULL, 1, 0, 'False'),
(176, '2026-23241', 'student', 'sofia anne.hernandez.student', 's.hernandez@gmail.com', '$2y$10$fLhBovTMeu.iM./7oSIbauB4lJJoS0XzVQihYo.s1cQjBKHKwaX3O', 'Sofia Anne', 'Hernandez', 'female', '2018-06-15', '09170000007', '41 Zamora St., Brgy. Pandayan, Meycauayan, Bulacan', '2026-01-24 08:09:34', '2026-01-29 01:52:17', 'dummy.jpg', 12011, 'active', NULL, NULL, 1, 0, 'False'),
(177, '2026-55310', 'student', 'carlo james.garcia.student', 'c.garcia@gmail.com', '$2y$10$Myf/5HqsMPL4YYga4teSWe2SPLdPuL5JWP2rTJQKZMTT1IZt.k8xS', 'Carlo James', 'Garcia', 'male', '2018-06-15', '09170000005', '29 Pacheco St., Brgy. Saluysoy, Meycauayan, Bulacan', '2026-01-24 08:11:28', '2026-01-29 01:52:17', 'dummy.jpg', 12211, 'active', NULL, NULL, 1, 0, 'False'),
(178, '2026-15333', 'student', 'angela mae.flores.student', 'a.flores@gmail.com', '$2y$10$IACRBpdQvCH/rlOLwZBf1eDMTZEfRJfKZdeOehHfLf4ICV3teFcAe', 'Angela Mae', 'Flores', 'female', '2018-06-15', '09170000003', '6 Bonifacio St., Brgy. Iba, Meycauayan, Bulacan', '2026-01-24 08:12:54', '2026-01-29 01:52:17', 'dummy.jpg', 12311, 'active', NULL, NULL, 1, 0, 'False'),
(179, '2026-18613', 'student', 'bryan paul.enriquez.student', 'b.enriquez@gmail.com', '$2y$10$6eRtpfLf/cuBw.ihlXjx4OIDRArcLZpcjIt.9bXp9E08Coi7DE5ha', 'Bryan Paul', 'Enriquez', 'male', '2018-06-15', '09170000001', '14 Luna St., Brgy. Perez, Meycauayan, Bulacan', '2026-01-24 08:14:33', '2026-01-29 01:52:17', 'dummy.jpg', 12411, 'active', NULL, NULL, 1, 0, 'False'),
(180, '2026-68003', 'student', 'joshua mark.abad.student', 'j.abad@gmail.com', '$2y$10$Zsq/EakquGiXhTR81Nkd0OlbyrKPzJUd.ZdjQM.ONqaSCN.XQ//mm', 'Joshua Mark', 'Abad', 'male', '2017-06-15', '09180000020', 'Blk 4 Lot 18, Villa Mercedes Subd., Brgy. Camalig, Meycauayan, Bulacan', '2026-01-24 08:32:46', '2026-01-29 01:52:17', 'dummy.jpg', 31111, 'active', NULL, NULL, 1, 0, 'False'),
(181, '2026-22943', 'student', 'marian louise.ponce.student', 'm.ponce@gmail.com', '$2y$10$RyKGtFieMbcaKSLKHn6Ee.6ec61rx.yW3bgxi1PnBJahSeyB9OKeW', 'Marian Louise', 'Ponce', 'female', '2017-06-15', '09180000018', '58 Gumamela St., Brgy. Iba, Meycauayan, Bulacan', '2026-01-24 08:35:17', '2026-01-29 01:52:17', 'dummy.jpg', 33331, 'active', NULL, NULL, 1, 0, 'False'),
(182, '2026-38818', 'student', 'aaron joseph.ramos.student', 'a.ramos@gmail.com', '$2y$10$uaDm6WR6P7zcx8O9/qeTjeg5DL0JuHe1Rgj521rtJe5muFsUI0/Mq', 'Aaron Joseph', 'Ramos', 'male', '2017-06-15', '09180000015', 'Unit 13, Villa Paz Compound, Brgy. Malhacan, Meycauayan, Bulacan', '2026-01-24 08:37:23', '2026-02-06 17:43:14', 'dummy.jpg', 33332, 'active', NULL, NULL, 1, 0, 'False'),
(183, '2026-93730', 'student', 'julia anne.mercado.student', 'j.mercado@gmail.com', '$2y$10$TjSPrEo9RNdokXDLCZedh.ux34AAsuyXdltuP7FUy5rLvo4qDg7MK', 'Julia Anne', 'Mercado', 'female', '2017-06-15', '09180000013', '32 Bonifacio St., Brgy. Langka, Meycauayan, Bulacan', '2026-01-24 08:42:43', '2026-01-29 01:52:17', 'dummy.jpg', 33334, 'active', NULL, NULL, 1, 0, 'False'),
(184, '2026-45440', 'student', 'kevin andre.villamor.student', 'k.villamor@gmail.com', '$2y$10$CeGul6S6HlSJzpUYrnU2RekMjWFv9uOrdIzQx00Utq/u/XWpOVzpy', 'Kevin Andre', 'Villamor', 'male', '2017-06-15', '09180000011', 'Blk 10 Lot 6, San Isidro Subd., Brgy. Pantoc, Meycauayan, Bulacan', '2026-01-24 08:54:02', '2026-01-29 01:52:17', 'dummy.jpg', 33335, 'active', NULL, NULL, 1, 0, 'False'),
(190, '2026-32358', 'student', 'dominic paolo.javier.student', 'siyetot898@coswz.com', '$2y$10$bjLGrilREfLEIm7uYPygceMDhl/krwWmV0TgoM/kpQSIR3qVW9vZK', 'Dominic Paolo', 'Javier', 'male', '2010-06-15', '09181230009', '66 Rosal St., Brgy. Sto. Niño, Meycauayan, Bulacan', '2026-01-24 09:22:38', '2026-01-29 01:52:17', 'dummy.jpg', 2147483647, 'active', NULL, NULL, 1, 0, 'True'),
(191, '2026-30420', 'student', 'ian christopher.razon.student', 'ian.razon@gmail.com', '$2y$10$9Jt.sNnU1VESgAItWLYCcOjZbyUAuQsODUR9fnWxgl6/hmdKWVytq', 'Ian Christopher', 'Razon', 'male', '2015-12-05', '09123456727', 'Unit 8, San Roque Compound, Brgy. Hulo, Meycauayan, Bulacan', '2026-01-25 22:44:32', '2026-01-29 01:52:17', 'dummy.jpg', 44441, 'active', NULL, NULL, 1, 0, 'False'),
(192, '2026-10550', 'student', 'clarisse jean.morado.student', 'clarisse.morado@gmail.com', '$2y$10$9Jt.sNnU1VESgAItWLYCcOjZbyUAuQsODUR9fnWxgl6/hmdKWVytq', 'Clarisse Jean', 'Morado', 'female', '2015-09-30', '09123456724', '102 Orchid St., Brgy. Sto. Niño, Meycauayan, Bulacan', '2026-01-25 22:46:52', '2026-01-29 01:52:17', 'dummy.jpg', 44442, 'active', NULL, NULL, 1, 0, 'False'),
(193, '2026-91967', 'student', 'paul vincent.manabat.student', 'paul.manabat@gmail.com', '$2y$10$W1MKtHC6mnEcoh5RRF1fne.nIPzGOcpsScJEUu.xZ9lQ9UHijR3o.', 'Paul Vincent', 'Manabat', 'male', '2016-02-10', '09123456721', 'Phase 2 Lot 9, Greenfields Subd., Brgy. Calvario, Meycauayan, Bulacan', '2026-01-25 23:21:45', '2026-01-29 01:52:17', 'dummy.jpg', 44443, 'active', NULL, NULL, 1, 0, 'False'),
(194, '2026-27406', 'student', 'kyla mae.del rosario.student', 'kyla.delrosario@gmail.com', '$2y$10$VxDkqrXiruIbcxfOPA.2m.fl79qFzzgA6zxuM0SkMTFrCKeIDjWwm', 'Kyla Mae', 'Del Rosario', 'female', '2015-07-22', '09123456718', '21 Narra St., Brgy. Perez, Meycauayan, Bulacan', '2026-01-25 23:26:44', '2026-01-29 01:52:17', 'dummy.jpg', 44445, 'active', NULL, NULL, 1, 0, 'False'),
(195, '2026-97012', 'student', 'carlo miguel.yabut.student', 'carlo.yabut@gmail.com', '$2y$10$1EKij0V7UIDi.xWa5C5ciOzKjrF7/2zHXQrkJ8R7G4ofpjx0PBLl2', 'Carlo Miguel', 'Yabut', 'male', '2015-03-18', '09123456715', '73 Camia St., Brgy. Saluysoy, Meycauayan, Bulacan', '2026-01-25 23:43:31', '2026-01-29 01:52:17', 'dummy.jpg', 44446, 'active', NULL, NULL, 1, 0, 'False'),
(196, '2026-52486', 'student', 'danielle rose.estrella.student', 'danielle.estrella@gmail.com', '$2y$10$I17m0Kqar.7CZCi0KWMf1elqVX7f7eMaQh5MJwHgAZW50gb0sFV.a', 'Danielle Rose', 'Estrella', 'female', '2015-11-09', '09123456712', 'Unit 4, Mabini Compound, Brgy. Hulo, Meycauayan, Bulacan', '2026-01-25 23:51:27', '2026-01-29 01:52:17', 'dummy.jpg', 44447, 'active', NULL, NULL, 1, 0, 'False'),
(197, '2026-81599', 'student', 'vincent paul.balagtas.student', 'vincent.balagtas@gmail.com', '$2y$10$v8hfvyuOMRYMwfZbt0Qo.ej1.fZETD1aaBre4Mrn9hIbSCFxGYEtS', 'Vincent Paul', 'Balagtas', 'male', '2016-01-15', '09123456709', '41 Rizal St., Brgy. Sto. Niño, Meycauayan, Bulacan', '2026-01-25 23:54:14', '2026-01-29 01:52:17', 'dummy.jpg', 44448, 'active', NULL, NULL, 1, 0, 'False'),
(198, '2026-97370', 'student', 'rhea camille.navarro.student', 'rhea.navarro@gmail.com', '$2y$10$prUrlc23u642fwicrtwBDOgbH/XvqEN.uy4TYRv6jMNFaMYJNn9t6', 'Rhea Camille', 'Navarro', 'female', '2015-08-21', '09123456706', 'Phase 3 Lot 9, Green Meadows Subd., Brgy. Calvario, Meycauayan, Bulacan', '2026-01-25 23:55:12', '2026-01-29 01:52:17', 'dummy.jpg', 44449, 'active', NULL, NULL, 1, 0, 'False'),
(199, '2026-52304', 'student', 'elijah nathan.aquino.student', 'elijah.aquino@gmail.com', '$2y$10$YXvrREAbV5j26lm2aJxvsOydtLta20A5LJqYnB8GG.j7KZzy.Vsie', 'Elijah Nathan', 'Aquino', 'male', '2015-06-12', '09123456703', '22 Sampaguita St., Brgy. Perez, Meycauayan, Bulacan', '2026-01-25 23:56:27', '2026-01-29 01:52:17', 'dummy.jpg', 44450, 'active', NULL, NULL, 1, 0, 'False'),
(200, '2025-92581', 'student', 'brian.dulay.student', 'admin1@barangay.com', '$2y$10$PESiAtDF50Nh/CEOC3RRIuWV5GFggsuzx7.v6LPiVDxueCS2H5ekO', 'Brian', 'Dulay', 'male', '2021-02-22', '09123456789', 'Tambulig Buton, Tabuan-Lasa, Basilan, BARMM,', '2026-01-26 05:51:44', '2026-01-29 01:52:17', 'dummy.jpg', 0, 'active', NULL, NULL, 1, 0, 'False'),
(201, '2026-01457', 'student', 'alyssa kate.herrera.student', 'alyssa.herrera@gmail.com', '$2y$10$ACMK9zfVI0/kTRWQLNurtuVrPdmFnp1LQyVnjTrSsbC8Qyn7yT0k2', 'Alyssa Kate', 'Herrera', 'female', '2014-04-15', '09123456030', '20 Citrine St., Brgy. Pandayan, Meycauayan, Bulacan', '2026-01-26 06:22:11', '2026-01-29 01:52:17', 'dummy.jpg', 55551, 'active', NULL, NULL, 1, 0, 'False'),
(202, '2026-16121', 'student', 'patrick ryan.guevarra.student', 'patrick.guevarra@gmail.com', '$2y$10$oBsdK.FU2maoNxg9Ns0jEuFau2UbR8jlCVcZB0r1MvMxhAUSolRwO', 'Patrick Ryan', 'Guevarra', 'male', '2014-07-29', '09123456027', '53 Tourmaline St., Brgy. Saluysoy, Meycauayan, Bulacan', '2026-01-26 06:39:25', '2026-01-29 01:52:17', 'dummy.jpg', 55552, 'active', NULL, NULL, 1, 0, 'False'),
(203, '2026-15821', 'student', 'lovely joy.floresca.student', 'lovely.floresca@gmail.com', '$2y$10$/s4.6722D1ueYZ4huLsOGOsnw50ag4a1BP4LY69tudWyBPeO56IuK', 'Lovely Joy', 'Floresca', 'female', '2014-02-06', '09123456024', '8 Amethyst St., Brgy. Iba, Meycauayan, Bulacan', '2026-01-26 06:40:39', '2026-01-29 01:52:17', 'dummy.jpg', 55553, 'active', NULL, NULL, 1, 0, 'False'),
(204, '2026-11035', 'student', 'nathaniel john.espiritu.student', 'nathaniel.espiritu@gmail.com', '$2y$10$T73aKUnd4XjEZjqkRBNYFuGL7Bhi4yGPQztRYFJ5.s/IIKm.B1q6i', 'Nathaniel John', 'Espiritu', 'male', '2014-09-18', '09123456021', '74 Garnet St., Brgy. Perez, Meycauayan, Bulacan', '2026-01-26 06:41:37', '2026-01-29 01:52:17', 'dummy.jpg', 55554, 'active', NULL, NULL, 1, 0, 'False'),
(205, '2026-46344', 'student', 'princess anne.dela peña.student', 'princess.delapena@gmail.com', '$2y$10$40WSUMAiJZjapNqDWsQLLOnr2RftFbwcvxxO8fD/hcAXuVuyAzVia', 'Princess Anne', 'Dela Peña', 'female', '2014-11-21', '09123456018', '11 Opal St., Brgy. Malhacan, Meycauayan, Bulacan', '2026-01-26 06:49:16', '2026-01-29 01:52:17', 'dummy.jpg', 55556, 'active', NULL, NULL, 1, 0, 'False'),
(206, '2026-56283', 'student', 'mark vincent.caluag.student', 'mark.caluag@gmail.com', '$2y$10$ut/tlIvs1rwSXgm6QaRe3eL/ahFb.XTPIxOjY2Ax5R5hek453Ci0O', 'Mark Vincent', 'Caluag', 'male', '2014-06-03', '09123456015', '36 Topaz St., Brgy. Camalig, Meycauayan, Bulacan', '2026-01-26 06:51:28', '2026-01-29 01:52:17', 'dummy.jpg', 55557, 'active', NULL, NULL, 1, 0, 'False'),
(207, '2026-60434', 'student', 'trisha mae.benitez.student', 'trisha.benitez@gmail.com', '$2y$10$5zdyYqVp3BUm9xSyPKoerORISpkULpQ6gJu0HUEa.yjjPybNUnXxK', 'Trisha Mae', 'Benitez', 'female', '2014-08-14', '09123456012', '28 Sapphire St., Brgy. Pandayan, Meycauayan, Bulacan', '2026-01-26 06:56:24', '2026-01-29 01:52:17', 'dummy.jpg', 55558, 'active', NULL, NULL, 1, 0, 'False'),
(208, '2026-84029', 'student', 'john paul.abella.student', 'john.abella@gmail.com', '$2y$10$B.Bt/mpZVNLy1QZt5LdrqOJ4nbrHznvE8gg7r41wWPB7VKdYHqg6i', 'John Paul', 'Abella', 'male', '2014-01-27', '09123456009', '4 Diamond St., Brgy. Saluysoy, Meycauayan, Bulacan', '2026-01-26 06:57:23', '2026-01-29 01:52:17', 'dummy.jpg', 55559, 'active', NULL, NULL, 1, 0, 'False'),
(209, '2026-24269', 'student', 'janelle faith.zarate.student', 'janelle.zarate@gmail.com', '$2y$10$z.JwC5xurSCerh7dnDiibOpGwZ08whLAhYe8xcnXRKCBW8hP.oQv.', 'Janelle Faith', 'Zarate', 'female', '2014-05-09', '09123456006', '67 Ruby St., Brgy. Iba, Meycauayan, Bulacan', '2026-01-26 06:59:27', '2026-01-29 01:52:17', 'dummy.jpg', 55560, 'active', NULL, NULL, 1, 0, 'False'),
(210, '2026-30551', 'student', 'andrea joy.orellana.student', 'andrea.orellana@gmail.com', '$2y$10$uMclbu8wI52kwY.92cP6wuwJp0VIF5L3daxnORh8BiL8MhZURDSDe', 'Andrea Joy', 'Orellana', 'female', '2013-11-05', '09123456273', '25 Onyx St., Brgy. Saluysoy, Meycauayan, Bulacan', '2026-01-26 07:55:50', '2026-01-29 01:52:17', 'dummy.jpg', 66661, 'active', NULL, NULL, 1, 0, 'False'),
(211, '2026-45481', 'student', 'kevin bryan.lim.student', 'kevin.lim@gmail.com', '$2y$10$OfZNcGhF6DsEIb3nVfsFaexZTcV1OgHgGQaWiLTkD99tQNXzg3U2W', 'Kevin Bryan', 'Lim', 'male', '2013-08-26', '09123456270', '88 Jade St., Brgy. Malhacan, Meycauayan, Bulacan', '2026-01-26 07:57:07', '2026-01-29 01:52:17', 'dummy.jpg', 66662, 'active', NULL, NULL, 1, 0, 'False'),
(212, '2026-60149', 'student', 'alyssa faith.navarro.student', 'alyssa.navarro@gmail.com', '$2y$10$m2cy0cIGmCPlzabfdgwMe.bnMSvUyiqJb.Yzlxw0p7.T6aXUi7t8u', 'Alyssa Faith', 'Navarro', 'female', '2013-03-17', '09123456267', '5 Mango St., Brgy. Camalig, Meycauayan, Bulacan', '2026-01-26 08:00:44', '2026-01-29 01:52:17', 'dummy.jpg', 66663, 'active', NULL, NULL, 1, 0, 'False'),
(213, '2026-28474', 'student', 'daniel joseph.villanueva.student', 'daniel.villanueva@gmail.com', '$2y$10$kxOcQHNmoQeVUT.PQxCMquavvn24JkjTUKKZ3yjVzkjCKXB06SG4q', 'Daniel Joseph', 'Villanueva', 'male', '2013-10-08', '09123456264', '22 Luna St., Brgy. Pandayan, Meycauayan, Bulacan', '2026-01-26 08:02:46', '2026-01-29 01:52:17', 'dummy.jpg', 66664, 'active', NULL, NULL, 1, 0, 'False'),
(214, '2026-27756', 'student', 'princess mae.castillo.student', 'princess.castillo@gmail.com', '$2y$10$vePWSKSTYVdDsoa6cQBl3uCDru2/x1h3wOaL6ZM.CkO8iBayFLUeK', 'Princess Mae', 'Castillo', 'female', '2013-05-30', '09123456261', '61 Rosal St., Brgy. Saluysoy, Meycauayan, Bulacan', '2026-01-26 08:09:30', '2026-01-29 01:52:17', 'dummy.jpg', 66665, 'active', NULL, NULL, 1, 0, 'False'),
(215, '2026-22353', 'student', 'mark anthony.bautista.student', 'mark.bautista@gmail.com', '$2y$10$UQ4HT7PI74GxBJTi5u15cu9qSP0y3LnKEGBo8M2xL3VY0NL/e9z/W', 'Mark Anthony', 'Bautista', 'male', '2013-01-23', '09123456258', '17 Narra St., Brgy. Iba, Meycauayan, Bulacan', '2026-01-26 08:14:13', '2026-01-29 01:52:17', 'dummy.jpg', 66667, 'active', NULL, NULL, 1, 0, 'False'),
(216, '2026-01328', 'student', 'ian christopher.razon.student1', 'ian.razon@gmail.com', '$2y$10$5zqfgimfrXPlnrgh0n467uxXTUQ1VvGuV.kEEkai0G2ZB3zvDrxei', 'Ian Christopher', 'Razon', 'male', '2013-09-09', '09123456252', 'Unit 6, San Roque Compound, Brgy. Hulo, Meycauayan, Bulacan', '2026-01-26 08:15:47', '2026-01-29 01:52:17', 'dummy.jpg', 66668, 'active', NULL, NULL, 1, 0, 'False'),
(217, '2026-79170', 'student', 'kyla mae.del rosario.student1', 'kyla.delrosario@gmail.com', '$2y$10$YEn6QaHyvBhtADgIWvUOOu0hKPfn7v/VHE5wjcFN.dmAPhqOuXfJK', 'Kyla Mae', 'Del Rosario', 'female', '2013-04-18', '09123456243', '18 Narra St., Brgy. Perez, Meycauayan, Bulacan', '2026-01-26 08:17:19', '2026-01-29 01:52:17', 'dummy.jpg', 66669, 'active', NULL, NULL, 1, 0, 'False'),
(218, '2026-13541', 'student', 'clarisse jean.morado.student1', 'clarisse.morado@gmail.com', '$2y$10$svhdOfgLi974tVa29E0FFuMifkc2awm0RKHB7kQYCF2RNJ63Ilc92', 'Clarisse Jean', 'Morado', 'female', '2013-02-11', '09123456249', '99 Orchid St., Brgy. Sto. Niño, Meycauayan, Bulacan', '2026-01-26 08:19:27', '2026-01-29 01:52:17', 'dummy.jpg', 66610, 'active', NULL, NULL, 1, 0, 'False'),
(219, '2026-94929', 'student', 'paul vincent.manabat.student1', 'paul.manabat@gmail.com', '$2y$10$X.JgY89aac17DmAGBqKnduIn6yKcYWD7XPd65IiGXPipimSVKZOVK', 'Paul Vincent', 'Manabat', 'male', '2013-06-02', '09123456246', 'Phase 2 Lot 6, Greenfields Subd., Brgy. Calvario, Meycauayan, Bulacan', '2026-01-26 08:20:33', '2026-01-29 01:52:17', 'dummy.jpg', 666611, 'active', NULL, NULL, 1, 0, 'False'),
(220, '2026-06530', 'student', 'bianca louise.de leon.student', 'bianca.deleon@gmail.com', '$2y$10$p4UwVx7nP.X3aNpSKPYFQ.RlGSOfJcBg8LRMkHAUqhnMdHA6.Ov82', 'Bianca Louise', 'De Leon', 'female', '2012-12-05', '09145678030', '29 Diamond St., Brgy. Camalig, Meycauayan, Bulacan', '2026-01-26 09:41:44', '2026-01-29 01:52:17', 'dummy.jpg', 77771, 'active', NULL, NULL, 1, 0, 'False'),
(221, '2026-42132', 'student', 'john lloyd.alvarez.student', 'john.alvarez@gmail.com', '$2y$10$8wNaansEA8cHbkZfeq6MLu3XUo8FbCsMQeBog9uwCAFNMCXaX1wmG', 'John Lloyd', 'Alvarez', 'male', '2012-02-09', '09145678027', '56 Sapphire St., Brgy. Pandayan, Meycauayan, Bulacan', '2026-01-26 09:44:31', '2026-01-29 01:52:17', 'dummy.jpg', 77772, 'active', NULL, NULL, 1, 0, 'False'),
(222, '2026-65975', 'student', 'hannah rose.ortega.student', 'hannah.ortega@gmail.com', '$2y$10$wCCPTFHWClQO/YV2HrGwfeAOUUUiQ3hGZNl0ECSmT9prOj1c2dB76', 'Hannah Rose', 'Ortega', 'female', '2012-08-11', '09145678024', '7 Pearl St., Brgy. Saluysoy, Meycauayan, Bulacan', '2026-01-26 09:45:49', '2026-01-29 01:52:17', 'dummy.jpg', 77773, 'active', NULL, NULL, 1, 0, 'False'),
(223, '2026-39854', 'student', 'kyle vincent.pineda.student', 'kyle.pineda@gmail.com', '$2y$10$ge65.mxyN.4B9BJc85xDDeIQ9Dois6edQs5S4zpZOnxkQLxITTP6K', 'Kyle Vincent', 'Pineda', 'male', '2012-04-27', '09145678021', '41 Ruby St., Brgy. Iba, Meycauayan, Bulacan', '2026-01-26 09:46:42', '2026-01-29 01:52:17', 'dummy.jpg', 77774, 'active', NULL, NULL, 1, 0, 'False'),
(224, '2026-82498', 'student', 'sophia anne.dizon.student', 'sophia.dizon@gmail.com', '$2y$10$mTkVP84yyd6vc4L1xzXfm.UV3VTouVQa3xuVrZiRWtJpVY4dHXyb6', 'Sophia Anne', 'Dizon', 'female', '2012-10-03', '09145678018', '19 Emerald St., Brgy. Perez, Meycauayan, Bulacan', '2026-01-26 09:48:50', '2026-01-29 01:52:17', 'dummy.jpg', 77775, 'active', NULL, NULL, 1, 0, 'False'),
(225, '2026-99171', 'student', 'noah lucas.sevilla.student', 'noah.sevilla@gmail.com', '$2y$10$vo8TRbxUvrhcwo1wTjOlsuIgiQRvned4eamXkV4.UGaUIkAAiyg1u', 'Noah Lucas', 'Sevilla', 'male', '2012-07-15', '09145678015', 'Blk 5 Lot 7, Villa Teresa Subd., Brgy. Camalig, Meycauayan, Bulacan', '2026-01-26 09:49:34', '2026-01-29 01:52:17', 'dummy.jpg', 77776, 'active', NULL, NULL, 1, 0, 'False'),
(226, '2026-79611', 'student', 'francine ella.gatchalian.student', 'francine.gatchalian@gmail.com', '$2y$10$Fv2dFXD.120GZi7eWlfsN.QXJuAR6iAITzdD6Pa/naHo7OrRrEGLu', 'Francine Ella', 'Gatchalian', 'female', '2012-01-21', '09145678012', '82 Ilang-Ilang St., Brgy. Iba, Meycauayan, Bulacan', '2026-01-26 09:50:35', '2026-01-29 01:52:17', 'dummy.jpg', 77778, 'active', NULL, NULL, 1, 0, 'False'),
(227, '2026-49576', 'student', 'earl john.sagun.student', 'earl.sagun@gmail.com', '$2y$10$3iCeRsBcvm7je6Iaa6.xbuumrDH07mosa1LtS6S2ukU7fs85UcAyy', 'Earl John', 'Sagun', 'male', '2012-09-12', '09145678009', 'Unit 10, Riverside Compound, Brgy. Malhacan, Meycauayan, Bulacan', '2026-01-26 09:51:52', '2026-01-29 01:52:17', 'dummy.jpg', 77779, 'active', NULL, NULL, 1, 0, 'False'),
(228, '2026-21013', 'student', 'krisha ann.villaseñor.student', 'krisha.villasenor@gmail.com', '$2y$10$tFn6wgskrfSA7M8BPzpI2OrxyCvy1p8xLpfMMFFxR8x4rYCmRkPKC', 'Krisha Ann', 'Villaseñor', 'female', '2012-06-07', '09145678006', '35 P. Burgos St., Brgy. Langka, Meycauayan, Bulacan', '2026-01-26 09:53:21', '2026-01-29 01:52:17', 'dummy.jpg', 77710, 'active', NULL, NULL, 1, 0, 'False'),
(229, '2026-16637', 'student', 'jerome patrick.catapang.student', 'jerome.catapang@gmail.com', '$2y$10$OP3WDBkSSZmetUrAObdnXeVNCiGF8R2y6KlGIpj9OFQLcmQaYhLtW', 'Jerome Patrick', 'Catapang', 'male', '2012-03-18', '09145678003', 'Blk 7 Lot 4, Golden Acres Subd., Brgy. Pantoc, Meycauayan, Bulacan', '2026-01-26 09:55:53', '2026-01-29 01:52:17', 'dummy.jpg', 77711, 'active', NULL, NULL, 1, 0, 'False'),
(230, '2025-92581', 'student', 'brian.dulay.student1', 'admin1@barangay.com', '$2y$10$bOWgzABbHA8EcMiy9VtNJe484RtTtKdE9eQ3acaUI3DnXkbev.ijW', 'Brian', 'Dulay', 'male', '2021-02-22', '09123456789', 'Tambulig Buton, Tabuan-Lasa, Basilan, BARMM,', '2026-01-26 11:35:51', '2026-01-29 01:52:17', 'dummy.jpg', 2147483647, 'active', NULL, NULL, 1, 0, 'False'),
(231, '2026-04231', 'student', 'maria angelica.padilla.student', 'angelica.padilla@gmail.com', '$2y$10$8PmgFoy1a0K/hP3m4ATMJuivuWOdcGylFvp0EUddfTz7XpD2jisnK', 'Maria Angelica', 'Padilla', 'female', '2011-12-10', '09156789030', '10 Orchid St., Brgy. Pandayan, Meycauayan, Bulacan', '2026-01-26 11:56:01', '2026-01-29 01:52:17', 'dummy.jpg', 88881, 'active', NULL, NULL, 1, 0, 'False'),
(232, '2026-30964', 'student', 'adrian lee.chua.student', 'adrian.chua@gmail.com', '$2y$10$ZlRz/YJio.eHl7X6wZe.yO2XVI9/9FFUS5Bt6Q1hQCkWubMteUMe.', 'Adrian Lee', 'Chua', 'male', '2011-08-27', '09156789027', '91 Lotus St., Brgy. Saluysoy, Meycauayan, Bulacan', '2026-01-26 11:57:11', '2026-01-29 01:52:17', 'dummy.jpg', 88882, 'active', NULL, NULL, 1, 0, 'False'),
(234, '2026-14990', 'student', 'trisha mae.soriano.student', 'trisha.soriano@gmail.com', '$2y$10$.of93i3aaC45YXdQu4zjIe5Tkf7/pgCiGP8j0z16zUD11aeqAjpUy', 'Trisha Mae', 'Soriano', 'female', '2011-06-08', '09156789021', '14 Silver St., Brgy. Perez, Meycauayan, Bulacan', '2026-01-26 12:07:58', '2026-01-29 01:52:17', 'dummy.jpg', 88884, 'active', NULL, NULL, 1, 0, 'False'),
(235, '2026-25323', 'student', 'ryan joseph.romero.student', 'ryan.romero@gmail.com', '$2y$10$POHk23h4anEjLIb6lu7eeugvrxcj6YoMaW1McsLml90Xi1h2n/Utu', 'Ryan Joseph', 'Romero', 'male', '2011-11-02', '09156789018', '63 Gold St., Brgy. Malhacan, Meycauayan, Bulacan', '2026-01-26 12:08:45', '2026-01-29 01:52:17', 'dummy.jpg', 88885, 'active', NULL, NULL, 1, 0, 'False'),
(236, '2026-98241', 'student', 'aira mae.palomares.student', 'aira.palomares@gmail.com', '$2y$10$DS3qdh/kkzAtxrmlxCGmEebbolzqoCHjBV3poB/9EsOa7gBxLme8.', 'Aira Mae', 'Palomares', 'female', '2011-03-21', '09156789015', '71 Camia St., Brgy. Saluysoy, Meycauayan, Bulacan', '2026-01-26 12:09:56', '2026-01-29 01:52:17', 'dummy.jpg', 88886, 'active', NULL, NULL, 1, 0, 'False'),
(237, '2026-00512', 'student', 'john matthew.ison.student', 'john.ison@gmail.com', '$2y$10$4c..pv/ntotMC6FC/13PcOMm37z6jbFXuNTRZQWhJ9pvFkfGs/lm.', 'John Matthew', 'Ison', 'male', '2011-09-14', '09156789012', 'Unit 1, Mabuhay Compound, Brgy. Hulo, Meycauayan, Bulacan', '2026-01-26 12:11:35', '2026-01-29 01:52:17', 'dummy.jpg', 88887, 'active', NULL, NULL, 1, 0, 'False'),
(238, '2026-68993', 'student', 'camille joy.alcantara.student', 'camille.alcantara@gmail.com', '$2y$10$YkwctXQtJeUVpoBAHvTJWOOL4xO15IdkLxIzVVfVwvGjfSBPB3a5S', 'Camille Joy', 'Alcantara', 'female', '2011-01-30', '09156789009', '60 Rizal Ave., Brgy. Sto. Niño, Meycauayan, Bulacan', '2026-01-26 12:20:50', '2026-01-29 01:52:17', 'dummy.jpg', 88889, 'active', NULL, NULL, 1, 0, 'False'),
(239, '2026-85865', 'student', 'ethan paul.bernal.student', 'ethan.bernal@gmail.com', '$2y$10$Ez9P6Wq1T7zHQoQa.UMjBueJI52FL/j49I5YC0ZfoohtYTvtso5WG', 'Ethan Paul', 'Bernal', 'male', '2011-07-18', '09156789006', 'Phase 1 Lot 12, Evergreen Subd., Brgy. Calvario, Meycauayan, Bulacan', '2026-01-26 12:21:40', '2026-01-29 01:52:17', 'dummy.jpg', 88810, 'active', NULL, NULL, 1, 0, 'False'),
(240, '2026-10963', 'student', 'bianca denise.lorenzo.student', 'bianca.lorenzo@gmail.com', '$2y$10$w53g1F3HjOgIyZW0L/AA2ek6lz1vp6Gjhc0BtAWP/r2.hLX3K/xu2', 'Bianca Denise', 'Lorenzo', 'female', '2011-04-12', '09156789003', '27 Sampaguita St., Brgy. Perez, Meycauayan, Bulacan', '2026-01-26 12:22:19', '2026-01-29 01:52:17', 'dummy.jpg', 88811, 'active', NULL, NULL, 1, 0, 'False'),
(241, '2026-78381', 'student', 'francis mark.tolentino.student', 'francis.tolentino@gmail.com', '$2y$10$/aYcrvKops4D04aXZPntjuzMld7PkZgbtF78oWZjRU6OIDa9diNLC', 'Francis Mark', 'Tolentino', 'male', '2011-06-15', '09171230030', '66 Acacia St., Brgy. Saluysoy, Meycauayan, Bulacan', '2026-01-26 12:36:01', '2026-01-29 01:52:17', 'dummy.jpg', 999991, 'active', NULL, NULL, 1, 0, 'False'),
(242, '2026-38813', 'student', 'stephanie ann.yumul.student', 'stephanie.yumul@gmail.com', '$2y$10$8bQ2V.sxmXcqd6wxWhVvq.fvFn/qhOUh2OBHwV4zMb0mpgngSdpq2', 'Stephanie Ann', 'Yumul', 'female', '2011-06-15', '09171230027', '8 Rosewood St., Brgy. Iba, Meycauayan, Bulacan', '2026-01-26 12:36:55', '2026-01-29 01:52:17', 'dummy.jpg', 999992, 'active', NULL, NULL, 1, 0, 'False'),
(243, '2026-12855', 'student', 'kenneth paul.manalo.student', 'kenneth.manalo@gmail.com', '$2y$10$38beSjySagiQceznhQFPyeP62UqhxfjwlDs1ddLSZhcWV3vBkDCDa', 'Kenneth Paul', 'Manalo', 'male', '2011-06-15', '09171230024', '49 Sunflower St., Brgy. Perez, Meycauayan, Bulacan', '2026-01-26 12:37:36', '2026-01-29 01:52:17', 'dummy.jpg', 999993, 'active', NULL, NULL, 1, 0, 'False'),
(244, '2026-46142', 'student', 'nicole joy.aquino.student', 'nicole.aquino@gmail.com', '$2y$10$0nZqn6dil7S8vmqiFRfmwOplK8bm1eQ3PlgOK3OKbVsW5SeGP80rO', 'Nicole Joy', 'Aquino', 'female', '2011-06-15', '09171230021', '37 Daisy St., Brgy. Malhacan, Meycauayan, Bulacan', '2026-01-26 12:38:17', '2026-01-29 01:52:17', 'dummy.jpg', 999994, 'active', NULL, NULL, 1, 0, 'False'),
(245, '2026-02783', 'student', 'jerome alex.flores.student', 'jerome.flores@gmail.com', '$2y$10$SgJ/qUa9xO54aTLAm0QArek5sadrPeLlh1SoonP/YNFr/R6amUm5.', 'Jerome Alex', 'Flores', 'male', '2011-06-15', '09171230018', '24 Tulip St., Brgy. Camalig, Meycauayan, Bulacan', '2026-01-26 12:38:57', '2026-01-29 01:52:17', 'dummy.jpg', 999995, 'active', NULL, NULL, 1, 0, 'False'),
(246, '2026-04886', 'student', 'renz mark.alonzo.student', 'renz.alonzo@gmail.com', '$2y$10$pcN7lLRXHEv2eS.svTg5Huz10Uumjsh9bdSjp23VzHGVFWTBwUn0q', 'Renz Mark', 'Alonzo', 'male', '2011-06-15', '09171230015', 'Block 9 Lot 4, Santo Niño St., Villa Mercedes Subd., Brgy. Camalig, Meycauayan, Bulacan', '2026-01-26 13:12:01', '2026-01-29 01:52:17', 'dummy.jpg', 999996, 'active', NULL, NULL, 1, 0, 'False'),
(247, '2026-96232', 'student', 'jayson lee.co.student', 'jayson.co@gmail.com', '$2y$10$rEDNjv/V1UTWP3L9CMOqFuUrLhSrQvJRfG5DayTYm2ZMrbIu9NUxm', 'Jayson Lee', 'Co', 'male', '2011-06-15', '09171230012', 'Phase 1 Lot 5, Evergreen Subd., Brgy. Calvario, Meycauayan, Bulacan', '2026-01-26 13:12:49', '2026-01-29 01:52:17', 'dummy.jpg', 999997, 'active', NULL, NULL, 1, 0, 'False'),
(248, '2026-62215', 'student', 'andrew kyle.san juan.student', 'andrew.sanjuan@gmail.com', '$2y$10$IaSMTgnw84uPQelA.s.l.uGoyylphniDOiy8MH3AbPO7W4opu3O.i', 'Andrew Kyle', 'San Juan', 'male', '2011-06-15', '09171230009', 'Unit 8, Villa Paz Compound, Brgy. Malhacan, Meycauayan, Bulacan', '2026-01-26 13:13:36', '2026-01-29 01:52:17', 'dummy.jpg', 999998, 'active', NULL, NULL, 1, 0, 'False'),
(249, '2026-85324', 'student', 'lorenzo miguel.pascual.student', 'lorenzo.pascual@gmail.com', '$2y$10$eqRqzBAcBvDZjeyqsd7K9.kZCgkj7s2cpyS6xKA/fR4.WeYIxL8G.', 'Lorenzo Miguel', 'Pascual', 'male', '2011-06-15', '09171230003', 'Blk 12 Lot 9, San Isidro Subd., Brgy. Pantoc, Meycauayan, Bulacan', '2026-01-26 13:14:14', '2026-01-29 01:52:17', 'dummy.jpg', 999999, 'active', NULL, NULL, 1, 0, 'False'),
(250, '2026-99202', 'student', 'denise carmela.fermin.student', 'denise.fermin@gmail.com', '$2y$10$BokS56wW1BD2i.JdFfBF9uafeqCnEjEYFTf/jg4SMrTnKbffBflLO', 'Denise Carmela', 'Fermin', 'female', '2011-06-15', '09171230006', '42 Bonifacio St., Brgy. Langka, Meycauayan, Bulacan', '2026-01-26 13:15:04', '2026-01-29 01:52:17', 'dummy.jpg', 999910, 'active', NULL, NULL, 1, 0, 'False'),
(251, '2026-03228', 'student', 'bianca kate.yanga.student', 'bianca.yanga@gmail.com', '$2y$10$htLTS6RM75pGSjqIxQMIbeb8vpHAcgWfNTvluz6ZtfpvtfycwKmJa', 'Bianca Kate', 'Yanga', 'female', '2010-06-15', '09181230036', '28 Mango St., Brgy. Malhacan, Meycauayan, Bulacan', '2026-01-26 13:25:16', '2026-01-29 01:52:17', 'dummy.jpg', 10001, 'active', NULL, NULL, 1, 0, 'False'),
(252, '2026-94009', 'student', 'john carlo.tadeo.student', 'johncarlo.tadeo@gmail.com', '$2y$10$gJCkQg/qDr30rEitBFuSQemptrGegqpYLD.2gpuF4.g3h0hR20itW', 'John Carlo', 'Tadeo', 'male', '2010-06-15', '09181230033', '56 Lotus St., Brgy. Camalig, Meycauayan, Bulacan', '2026-01-26 13:26:21', '2026-01-29 01:52:17', 'dummy.jpg', 10002, 'active', NULL, NULL, 1, 0, 'False'),
(253, '2026-57197', 'student', 'mikaela faith.abad.student', 'mikaela.abad@gmail.com', '$2y$10$VU2Y.BqKWnN4BBTZqmLmT.aRu4Ht3tUdNV8j0BSVEaX3YG3w4jN56', 'Mikaela Faith', 'Abad', 'female', '2010-06-15', '09181230030', '6 Maple St., Brgy. Iba, Meycauayan, Bulacan', '2026-01-26 13:27:06', '2026-01-29 01:52:17', 'dummy.jpg', 10003, 'active', NULL, NULL, 1, 0, 'False'),
(254, '2026-12726', 'student', 'bryan keith.enriquez.student', 'bryan.enriquez@gmail.com', '$2y$10$uA1lLZFiZxgPW7KOefsP8.0Jws6DLTX8zKFrq0tBurUggeUnkYTPa', 'Bryan Keith', 'Enriquez', 'male', '2010-06-15', '09181230027', '73 Oak St., Brgy. Perez, Meycauayan, Bulacan', '2026-01-26 13:27:43', '2026-01-29 01:52:17', 'dummy.jpg', 10004, 'active', NULL, NULL, 1, 0, 'False'),
(255, '2026-95652', 'student', 'angelica mae.macapagal.student', 'angelica.macapagal@gmail.com', '$2y$10$1MestKWZj2Qg5KJkk2Llhuej40jNCGquo3/tmMnHErFZPoNnJzo/a', 'Angelica Mae', 'Macapagal', 'female', '2010-06-15', '09181230024', '51 Palm St., Brgy. Malhacan, Meycauayan, Bulacan', '2026-01-26 13:28:21', '2026-01-29 01:52:17', 'dummy.jpg', 10005, 'active', NULL, NULL, 1, 0, 'False'),
(256, '2026-67994', 'student', 'marco luis.luna.student', 'marco.luna@gmail.com', '$2y$10$On9KsjSMmPEXNsio3ECb4O6cfbbIi2zmzCd3Is1yVMqKdvDSk7C.O', 'Marco Luis', 'Luna', 'male', '2010-06-15', '09181230021', '32 Cedar St., Brgy. Camalig, Meycauayan, Bulacan', '2026-01-26 13:29:07', '2026-01-29 01:52:17', 'dummy.jpg', 10006, 'active', NULL, NULL, 1, 0, 'False'),
(257, '2026-67994', 'student', 'marco luis.luna.student1', 'marco.luna@gmail.com', '$2y$10$HLhdDfvLdjp5pROT82Oy9.e3C4/O7aU5CaQRt7aNIrZ3lramnoofK', 'Marco Luis', 'Luna', 'male', '2010-06-15', '09181230021', '32 Cedar St., Brgy. Camalig, Meycauayan, Bulacan', '2026-01-26 13:29:12', '2026-01-29 01:52:17', 'dummy.jpg', 10007, 'active', NULL, NULL, 1, 0, 'False'),
(258, '2026-66213', 'student', 'patricia hope.valdez.student', 'patricia.valdez@gmail.com', '$2y$10$6HrqfybOt7B4ZkRgPaJfpu3ETUONPhmKYnsNWa43E9T3oZkzgocw6', 'Patricia Hope', 'Valdez', 'female', '2010-06-15', '09181230018', '15 Pine St., Brgy. Pandayan, Meycauayan, Bulacan', '2026-01-26 13:29:49', '2026-02-04 04:18:00', 'dummy.jpg', 10008, 'active', NULL, NULL, 1, 0, 'False'),
(259, '2026-42492', 'student', 'nathaniel john.espiritu.student1', 'nathaniel.espiritu@gmail.com', '$2y$10$GLpuOMt.a51B1.fTW7pIuerieyOvLXYuNhDgjcD7rQlVoSoA7Z8FS', 'Nathaniel John', 'Espiritu', 'male', '2010-06-15', '09181230015', '84 Camia St., Brgy. Saluysoy, Meycauayan, Bulacan', '2026-01-26 13:30:35', '2026-01-29 01:52:17', 'dummy.jpg', 10009, 'active', NULL, NULL, 1, 0, 'False'),
(260, '2026-91546', 'student', 'trina louise.hidalgo.student', 'trina.hidalgo@gmail.com', '$2y$10$M/iu33.RwfB/ZYYTEikxcOo1Lse9a7Mcrp0cqCAKJJVZKyoprENTO', 'Trina Louise', 'Hidalgo', 'female', '2010-06-15', '09181230012', 'Unit 12, San Roque Compound, Brgy. Hulo, Meycauayan, Bulacan', '2026-01-26 13:31:17', '2026-01-29 01:52:17', 'dummy.jpg', 10010, 'active', NULL, NULL, 1, 0, 'False'),
(261, '2026-91546', 'student', 'trina louise.hidalgo.student1', 'trina.hidalgo@gmail.com', '$2y$10$Xb0vPmPkq45Wvm6nOYoKkuq772UyD8mBV4wobps.nqlnBAXCEelJa', 'Trina Louise', 'Hidalgo', 'female', '2010-06-15', '09181230012', 'Unit 12, San Roque Compound, Brgy. Hulo, Meycauayan, Bulacan', '2026-01-26 13:35:44', '2026-01-29 01:52:17', 'dummy.jpg', 10011, 'active', NULL, NULL, 1, 0, 'False'),
(262, '2026-23038', 'student', 'chelsea mae.matibag.student', 'chelsea.matibag@gmail.com', '$2y$10$RVp8nkjnwDjT3e79i.fu2uL4hNc1WXWNIOMcYwSfKdZqEgy2tI582', 'Chelsea Mae', 'Matibag', 'female', '2010-06-15', '09181230006', 'Phase 2 Lot 15, Greenfields Subd., Brgy. Calvario, Meycauayan, Bulacan', '2026-01-26 13:36:21', '2026-01-29 01:52:17', 'dummy.jpg', 10012, 'active', NULL, NULL, 1, 0, 'False'),
(263, '2026-10513', 'student', 'cj.escalora.student', 'floterina@gmail.com', '$2y$10$XW061xh9UCMBlqFYPCHjoO4zl4geqKnLb73JKLMgEtpKPGAb9v4F.', 'CJ', 'Escalora', 'male', '2019-02-22', '09123456789', 'Calantipay, Baliuag, Bulacan, Central Luzon,', '2026-01-28 12:16:26', '2026-01-29 01:52:17', 'dummy.jpg', 123456, 'active', NULL, NULL, 1, 0, 'False'),
(264, '', 'parent', 'stephanie.candado662.parent', 'galecandado@gmail.com', '$2y$10$IJNWibKSuQB81AvLQGUBEuEV11W9n0ffRcK6unT9RLnhgCQoEaO1m', 'Stephanie', 'Candado', NULL, NULL, '09683725546', NULL, '2026-01-28 12:19:42', '2026-02-04 04:25:14', 'dummy.jpg', NULL, 'active', NULL, NULL, 0, 0, 'False'),
(265, '2026-12877', 'student', 'nick.azcueta.student', 'gatape5660@okexbit.com', '$2y$10$KfbVInWUIA/SVPl3LNLgrOWNTpokqstHY1xSQDjzHM8R.yz.c.A6q', 'nick', 'azcueta', 'male', '2021-12-26', '09123456789', 'Lias, Marilao, Bulacan, Central Luzon,', '2026-01-29 01:14:46', '2026-02-02 01:28:03', 'dummy.jpg', 1189156229, 'active', NULL, NULL, 2, 0, 'False'),
(266, '', 'parent', 'gavin.azcueta131.parent', 'nogip76240@gamening.com', '$2y$10$7K6ZDn/MKOOyfcWZEBQx0ODna74tFrcAwdZhpUjX0IcItXhnJV382', 'Gavin', 'azcueta', '', '2000-08-05', '09092075700', '', '2026-01-29 01:30:35', '2026-01-29 01:33:09', 'dummy.jpg', NULL, 'active', NULL, NULL, 0, 0, 'True'),
(267, '2026-33670', 'student', 'andrew paul.wilson.student', 'xelof91749@ixunbo.com', '$2y$10$mJ.GlzwbAsZDRhAD.vugG.uufKyn.sOsx.wih/qfLH814541NwJ3S', 'Andrew Paul', 'Wilson', 'male', '2018-12-12', '09181110036', '52 Mabini St., Brgy. Malhacan, Meycauayan, Bulacan', '2026-02-02 01:15:42', '2026-02-02 01:32:21', 'dummy.jpg', 1190247381, 'active', NULL, NULL, 0, 0, 'False'),
(268, '', 'parent', 'gale.deguzman421.parent', 'xelof91749@ixunbo.com', '$2y$10$Dd9v9.amu7Qyh7hsOJlqqerMutPmfZVlp4it0yNdYoZwGkL8atKca', 'Gale', 'De Guzman', NULL, NULL, '09924866376', NULL, '2026-02-02 01:17:03', '2026-02-02 02:15:14', 'dummy.jpg', NULL, 'active', NULL, NULL, 0, 0, 'False'),
(269, '2026-93506', 'student', 'kevin michael.uy.student', 'kevin.uy@gmail.com', '$2y$10$e/JvmLRFdI4gam09y9.CQODn8MEj6FhUhoRgB1UDjAiCl3UC0j9UW', 'Kevin Michael', 'Uy', 'male', '2018-05-07', '09181110032', '7 Zamora St., Brgy. Pandayan, Meycauayan, Bulacan', '2026-02-04 09:15:11', '2026-02-04 09:15:11', 'dummy.jpg', 122121212, 'active', NULL, NULL, 0, 0, 'False'),
(270, '', 'parent', 'rolly.gandula841.parent', 'rollybgandula@gmail.com', '$2y$10$VvmQcwfneanKngW44/YwIu/mtytGbRoVFolL03StFRSpEc6mcw2Yq', 'Rolly', 'Gandula', NULL, NULL, '09924188040', NULL, '2026-02-04 09:30:18', '2026-02-04 09:30:18', 'dummy.jpg', NULL, 'active', NULL, NULL, 0, 0, 'False'),
(271, '', 'admin', 'rolly.gandula428.admin', 'rollybgandula@gmail.com', '$2y$10$YyA1X8.8FVnRbdFdvrFfY.rwDjT7aqRMd4j1bJjeLquF2iA3midOG', 'Rolly', 'Gandula', NULL, NULL, '09924188040', NULL, '2026-02-04 10:31:43', '2026-02-05 17:18:01', 'dummy.jpg', NULL, 'active', NULL, 'Guidance', 0, 0, 'False');
INSERT INTO `users` (`user_id`, `student_number`, `acc_type`, `username`, `email`, `password`, `first_name`, `last_name`, `gender`, `birthdate`, `phone_number`, `address`, `created_at`, `updated_at`, `profile`, `rfid`, `acc_status`, `subject`, `role`, `notification`, `agree`, `authentication`) VALUES
(272, '2026-26115', 'student', 'miguel aaron.torres.student', 'miguel.torres@gmail.com', '$2y$10$ZSJMMtGfUJg5FZHNuPXH9uaJKv8BIEUYK14UZWYd8.YLApFdrnbsG', 'Miguel Aaron', 'Torres', 'male', '2018-11-03', '09181110030', '31 Pacheco St., Brgy. Saluysoy, Meycauayan, Bulacan', '2026-02-07 02:57:43', '2026-02-07 02:57:43', 'dummy.jpg', 121212, 'active', NULL, NULL, 0, 0, 'False');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admission_form`
--
ALTER TABLE `admission_form`
  ADD PRIMARY KEY (`id`);
ALTER TABLE `admission_form` ADD FULLTEXT KEY `lrn_2` (`lrn`);

--
-- Indexes for table `admission_old`
--
ALTER TABLE `admission_old`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `student_id` (`student_id`);

--
-- Indexes for table `announcements`
--
ALTER TABLE `announcements`
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
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `parent_attendance`
--
ALTER TABLE `parent_attendance`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `parent_link`
--
ALTER TABLE `parent_link`
  ADD PRIMARY KEY (`id`),
  ADD KEY `parent_id` (`parent_id`),
  ADD KEY `student_id` (`student_id`);

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
-- Indexes for table `student_disciplinary_records`
--
ALTER TABLE `student_disciplinary_records`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `disciplinary_id` (`disciplinary_id`);

--
-- Indexes for table `student_health_records`
--
ALTER TABLE `student_health_records`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `medical_id` (`medical_id`);

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
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admission_form`
--
ALTER TABLE `admission_form`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=423;

--
-- AUTO_INCREMENT for table `admission_old`
--
ALTER TABLE `admission_old`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `announcements`
--
ALTER TABLE `announcements`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT for table `assignments`
--
ALTER TABLE `assignments`
  MODIFY `assignment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `assignment_submissions`
--
ALTER TABLE `assignment_submissions`
  MODIFY `submission_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=67;

--
-- AUTO_INCREMENT for table `attendance`
--
ALTER TABLE `attendance`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=128;

--
-- AUTO_INCREMENT for table `class_schedule`
--
ALTER TABLE `class_schedule`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=158;

--
-- AUTO_INCREMENT for table `courses`
--
ALTER TABLE `courses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `course_students`
--
ALTER TABLE `course_students`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=213;

--
-- AUTO_INCREMENT for table `master_list`
--
ALTER TABLE `master_list`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=81;

--
-- AUTO_INCREMENT for table `parent_attendance`
--
ALTER TABLE `parent_attendance`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=66;

--
-- AUTO_INCREMENT for table `parent_link`
--
ALTER TABLE `parent_link`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `payment`
--
ALTER TABLE `payment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=82;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=82;

--
-- AUTO_INCREMENT for table `scholastic_records`
--
ALTER TABLE `scholastic_records`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `sections`
--
ALTER TABLE `sections`
  MODIFY `section_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=83;

--
-- AUTO_INCREMENT for table `student_disciplinary_records`
--
ALTER TABLE `student_disciplinary_records`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `student_health_records`
--
ALTER TABLE `student_health_records`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=68;

--
-- AUTO_INCREMENT for table `student_information`
--
ALTER TABLE `student_information`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=218;

--
-- AUTO_INCREMENT for table `student_tuition`
--
ALTER TABLE `student_tuition`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=201;

--
-- AUTO_INCREMENT for table `subjects`
--
ALTER TABLE `subjects`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

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
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=273;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `parent_link`
--
ALTER TABLE `parent_link`
  ADD CONSTRAINT `parent_link_ibfk_1` FOREIGN KEY (`parent_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `parent_link_ibfk_2` FOREIGN KEY (`student_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
