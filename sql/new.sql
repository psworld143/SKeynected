-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 01, 2024 at 06:51 PM
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
-- Database: `skeynected`
--

-- --------------------------------------------------------

--
-- Table structure for table `barangays`
--

CREATE TABLE `barangays` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `barangays`
--

INSERT INTO `barangays` (`id`, `name`) VALUES
(1, 'Acmonan'),
(2, 'Bololmala'),
(3, 'Bunao'),
(4, 'Cebuano'),
(5, 'Crossing Rubber'),
(6, 'Kablon'),
(7, 'Kalkam'),
(8, 'Linan');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `middlename` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `account_type` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `profile` varchar(255) NOT NULL,
  `created_at` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `firstname`, `middlename`, `lastname`, `username`, `password`, `account_type`, `email`, `profile`, `created_at`) VALUES
(1, 'Kristian Jay', 'Capuz', 'Paculanan', 'kristian', '$2y$10$vG7oxpNThkb0F/emKr9W9uBbxpdCZ/FOUfP0CKq78.aDFLAOhXwsa', 'admin', '', '', '2024-10-01 07:05:33'),
(2, 'Harvey', 'A', 'Pajayao', 'harvey', '$2y$10$A5HWo.pW.iuWvh3rjcacv.2K5v9Au86J3X5bzYhIO85T1PCIWJBU2', 'skchairman', '', '', '2024-10-01 07:09:31');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `barangays`
--
ALTER TABLE `barangays`
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
-- AUTO_INCREMENT for table `barangays`
--
ALTER TABLE `barangays`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
