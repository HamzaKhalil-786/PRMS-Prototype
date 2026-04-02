-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 17, 2025 at 03:57 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.0.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hospital_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `patients`
--

CREATE TABLE `patients` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `age` int(11) NOT NULL,
  `residence` varchar(255) NOT NULL,
  `disease` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `patients`
--

INSERT INTO `patients` (`id`, `name`, `age`, `residence`, `disease`, `created_at`) VALUES
(1, 'Ali Khan', 30, 'Lahore', 'Flu', '2025-03-17 02:56:18'),
(2, 'Sara Ahmed', 25, 'Karachi', 'Cough', '2025-03-17 02:56:18'),
(3, 'Hamza Iqbal', 40, 'Islamabad', 'Diabetes', '2025-03-17 02:56:18'),
(4, 'Ayesha Raza', 35, 'Rawalpindi', 'Hypertension', '2025-03-17 02:56:18'),
(5, 'Zain Malik', 28, 'Faisalabad', 'Asthma', '2025-03-17 02:56:18'),
(6, 'Noor Fatima', 22, 'Multan', 'Fever', '2025-03-17 02:56:18'),
(7, 'Usman Tariq', 45, 'Peshawar', 'Heart Disease', '2025-03-17 02:56:18'),
(8, 'Hira Shah', 33, 'Quetta', 'Migraine', '2025-03-17 02:56:18'),
(9, 'Bilal Aslam', 27, 'Sialkot', 'Skin Allergy', '2025-03-17 02:56:18'),
(10, 'Sadia Javed', 31, 'Gujranwala', 'Thyroid Issue', '2025-03-17 02:56:18'),
(11, 'Tariq Mehmood', 50, 'Hyderabad', 'Arthritis', '2025-03-17 02:56:18'),
(12, 'Mehwish Ali', 29, 'Bahawalpur', 'Sinus Infection', '2025-03-17 02:56:18'),
(13, 'Farhan Anwar', 37, 'Sargodha', 'Bronchitis', '2025-03-17 02:56:18'),
(14, 'Laiba Khan', 23, 'Okara', 'Food Poisoning', '2025-03-17 02:56:18'),
(15, 'Danish Qureshi', 41, 'Abbottabad', 'High Blood Pressure', '2025-03-17 02:56:18');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','operator') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `role`) VALUES
(1, 'admin', '202cb962ac59075b964b07152d234b70', 'admin'),
(2, 'ali', '202cb962ac59075b964b07152d234b70', 'operator');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `patients`
--
ALTER TABLE `patients`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `patients`
--
ALTER TABLE `patients`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
