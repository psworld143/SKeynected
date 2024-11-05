-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 05, 2024 at 07:10 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.0.28

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
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` int(11) NOT NULL,
  `firstname` varchar(100) NOT NULL,
  `lastname` varchar(100) NOT NULL,
  `middlename` varchar(100) DEFAULT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(50) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `firstname`, `lastname`, `middlename`, `username`, `email`, `password`, `role`, `created_at`) VALUES
(8, 'test', 'test', 'test', 'admin', 'test@gmail.com', '$2y$10$A4LoYe1YXvDdCDKrkvEvre..eFkwpVR6e.je3p3lCjEUWpczM3/3i', 'admin', '2024-10-16 02:36:24'),
(16, 'Hannah', 'Hannah', 'Hannah', 'hannah_admin', 'hannahadmin@gmail.com', '$2y$10$mw8K8maGv6f22MHhyGTt7eOzNZGHuiXvLe5S18WMx4ua59KCgs3FO', 'admin', '2024-11-05 06:09:15');

-- --------------------------------------------------------

--
-- Table structure for table `barangays`
--

CREATE TABLE `barangays` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `barangay_image_path` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `barangays`
--

INSERT INTO `barangays` (`id`, `name`, `barangay_image_path`) VALUES
(1, 'Acmonan', ''),
(2, 'Bololmala', ''),
(3, 'Bunao', ''),
(4, 'Cebuano', ''),
(5, 'Crossing Rubber', ''),
(6, 'Kablon', ''),
(7, 'Kalkam', ''),
(8, 'Linan', ''),
(9, 'Barangay haha', ''),
(10, 'qkweoad', 'wp10117165-macos-dark-wallpapers.png'),
(11, 'Test Barangay', '456092376_3829581300702293_359530944713219398_n.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `disbursements`
--

CREATE TABLE `disbursements` (
  `disbursement_id` int(11) NOT NULL,
  `project_id` int(11) DEFAULT NULL,
  `barangay_id` int(11) DEFAULT NULL,
  `amount_disbursed` decimal(10,2) DEFAULT NULL,
  `date_disbursed` date DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `liquidation`
--

CREATE TABLE `liquidation` (
  `id` int(11) NOT NULL,
  `material_id` int(11) NOT NULL,
  `project_id` int(11) NOT NULL,
  `material_name` varchar(255) NOT NULL,
  `quantity` int(11) NOT NULL CHECK (`quantity` >= 0),
  `amount` decimal(10,2) NOT NULL CHECK (`amount` >= 0),
  `or_number` varchar(100) DEFAULT NULL,
  `or_image_path` varchar(255) DEFAULT NULL,
  `status` varchar(150) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `barangay_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `materials`
--

CREATE TABLE `materials` (
  `material_id` int(11) NOT NULL,
  `project_id` int(11) DEFAULT NULL,
  `material_name` text NOT NULL,
  `quantity` text NOT NULL,
  `amount` text NOT NULL,
  `total` decimal(10,2) GENERATED ALWAYS AS (cast(regexp_replace(`amount`,'[^0-9.]','') as decimal(10,0)) * cast(regexp_replace(`quantity`,'[^0-9.]','') as decimal(10,0))) STORED,
  `or_number` varchar(150) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `projects`
--

CREATE TABLE `projects` (
  `project_id` int(11) NOT NULL,
  `project_name` varchar(255) NOT NULL,
  `project_code` varchar(50) NOT NULL,
  `project_description` text NOT NULL,
  `project_duration` int(11) NOT NULL,
  `status` varchar(50) DEFAULT NULL,
  `hearing_schedule` date DEFAULT NULL,
  `selected_project_name` varchar(255) DEFAULT NULL,
  `specific_job` varchar(255) NOT NULL,
  `operations` varchar(255) NOT NULL,
  `total_cost` decimal(10,2) DEFAULT 0.00,
  `proposal_file_path` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `materials` text DEFAULT NULL,
  `barangay_id` int(11) DEFAULT NULL,
  `sk_member_id` int(11) DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `status_description` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `project_progress`
--

CREATE TABLE `project_progress` (
  `progress_id` int(11) NOT NULL,
  `project_id` int(11) DEFAULT NULL,
  `progress_percentage` int(11) NOT NULL,
  `progress_description` text DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `purok`
--

CREATE TABLE `purok` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `barangay_id` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `purok`
--

INSERT INTO `purok` (`id`, `name`, `barangay_id`, `created_at`, `updated_at`) VALUES
(1, 'Purok A', 1, '2024-10-04 03:20:57', '2024-10-04 03:20:57'),
(2, 'Purok B', 1, '2024-10-04 03:20:57', '2024-10-04 03:20:57'),
(3, 'Purok C', 1, '2024-10-04 03:20:57', '2024-10-04 03:20:57');

-- --------------------------------------------------------

--
-- Table structure for table `sk_members`
--

CREATE TABLE `sk_members` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `username` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `role` varchar(50) NOT NULL,
  `position` varchar(255) DEFAULT NULL,
  `age` int(11) NOT NULL,
  `gender` enum('Male','Female','Other') NOT NULL,
  `civil_status` varchar(50) DEFAULT NULL,
  `birth_date` date DEFAULT NULL,
  `contact` varchar(15) DEFAULT NULL,
  `term` varchar(9) DEFAULT NULL,
  `status` enum('Active','Inactive') DEFAULT 'Active',
  `barangay_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sk_members`
--

INSERT INTO `sk_members` (`id`, `name`, `username`, `email`, `password`, `role`, `position`, `age`, `gender`, `civil_status`, `birth_date`, `contact`, `term`, `status`, `barangay_id`) VALUES
(37, 'Hannah', 'hannah123', 'hannah@gmail.com', '$2y$10$8bdeMHyNzHI4xJdQwwfvBevelMvGGqi7PqeWBcMAc.hZdaByQBVlG', 'skchairman', 'SK Chairman', 0, 'Male', NULL, NULL, NULL, NULL, 'Active', 11),
(38, 'Hannah Secretary', 'hannah_sec', 'hannah123@gmail.com', '$2y$10$RGWwGd34wrTBLXyqrdCaC.lTemgN0HK15mTdugbFiijNlvdu3RKEC', 'sksecretary', 'SK Secretary', 0, 'Male', NULL, NULL, NULL, NULL, 'Active', 11);

-- --------------------------------------------------------

--
-- Table structure for table `survey_responses`
--

CREATE TABLE `survey_responses` (
  `response_id` int(11) NOT NULL,
  `barangay_id` int(11) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `middlename` varchar(255) DEFAULT NULL,
  `address` text NOT NULL,
  `sex` enum('male','female','other') NOT NULL,
  `age` int(11) NOT NULL,
  `dob` date NOT NULL,
  `school_youth` enum('yes','no') NOT NULL,
  `age_classification` varchar(255) NOT NULL,
  `civil_status` enum('single','married','widowed','separated','divorced') NOT NULL,
  `phoneno` varchar(15) DEFAULT NULL,
  `place_of_birth` varchar(255) NOT NULL,
  `religion` varchar(255) NOT NULL,
  `ethnicity` enum('tagalog','bisaya','ilocano','bicolano','waray','pangasinense','kapampangan','maranao','maguindanao','tausug','other') DEFAULT NULL,
  `fbname` varchar(255) DEFAULT NULL,
  `youth_classification` enum('in-school','out-school','postgrad') NOT NULL,
  `gender_pref` enum('girl','boy','other') NOT NULL,
  `educational_attainment` enum('pre-school','elementary','7th-grade','high-school','1st-year-college','2nd-year-college','3rd-year-college','4th-year-college','vocational','bachelor-degree','master-degree','doctoral-degree') NOT NULL,
  `tech_voc` varchar(255) DEFAULT NULL,
  `still_studying` enum('yes','no') NOT NULL,
  `grade_level_if_studying` enum('N/A','grade-1','grade-2','grade-3','grade-4','grade-5','grade-6','1st-year-college','2nd-year-college','3rd-year-college','4th-year-college') NOT NULL,
  `if_no_studying` varchar(255) DEFAULT NULL,
  `disability` varchar(255) DEFAULT NULL,
  `disability_spec` varchar(255) DEFAULT NULL,
  `have_any_child` varchar(255) DEFAULT NULL,
  `registered_voter` enum('yes','no') NOT NULL,
  `have_involvement` enum('yes','no') NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `youth_image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tasks`
--

CREATE TABLE `tasks` (
  `id` int(11) NOT NULL,
  `project_id` int(11) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `status` enum('pending','in_progress','completed') DEFAULT NULL,
  `createdAt` timestamp NOT NULL DEFAULT current_timestamp(),
  `updatedAt` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `updates`
--

CREATE TABLE `updates` (
  `id` int(11) NOT NULL,
  `project_id` int(11) DEFAULT NULL,
  `task_id` int(11) DEFAULT NULL,
  `message` text DEFAULT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `barangays`
--
ALTER TABLE `barangays`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `disbursements`
--
ALTER TABLE `disbursements`
  ADD PRIMARY KEY (`disbursement_id`),
  ADD KEY `project_id` (`project_id`),
  ADD KEY `barangay_id` (`barangay_id`);

--
-- Indexes for table `liquidation`
--
ALTER TABLE `liquidation`
  ADD PRIMARY KEY (`id`),
  ADD KEY `material_id` (`material_id`),
  ADD KEY `project_id` (`project_id`),
  ADD KEY `barangay_id` (`barangay_id`);

--
-- Indexes for table `materials`
--
ALTER TABLE `materials`
  ADD PRIMARY KEY (`material_id`),
  ADD KEY `project_id` (`project_id`);

--
-- Indexes for table `projects`
--
ALTER TABLE `projects`
  ADD PRIMARY KEY (`project_id`),
  ADD UNIQUE KEY `project_code` (`project_code`),
  ADD KEY `barangay_id` (`barangay_id`),
  ADD KEY `fk_sk_member` (`sk_member_id`);

--
-- Indexes for table `project_progress`
--
ALTER TABLE `project_progress`
  ADD PRIMARY KEY (`progress_id`),
  ADD KEY `project_id` (`project_id`);

--
-- Indexes for table `purok`
--
ALTER TABLE `purok`
  ADD PRIMARY KEY (`id`),
  ADD KEY `barangay_id` (`barangay_id`);

--
-- Indexes for table `sk_members`
--
ALTER TABLE `sk_members`
  ADD PRIMARY KEY (`id`),
  ADD KEY `barangay_id` (`barangay_id`);

--
-- Indexes for table `survey_responses`
--
ALTER TABLE `survey_responses`
  ADD PRIMARY KEY (`response_id`),
  ADD KEY `barangay_id` (`barangay_id`);

--
-- Indexes for table `tasks`
--
ALTER TABLE `tasks`
  ADD PRIMARY KEY (`id`),
  ADD KEY `project_id` (`project_id`);

--
-- Indexes for table `updates`
--
ALTER TABLE `updates`
  ADD PRIMARY KEY (`id`),
  ADD KEY `project_id` (`project_id`),
  ADD KEY `task_id` (`task_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `barangays`
--
ALTER TABLE `barangays`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `disbursements`
--
ALTER TABLE `disbursements`
  MODIFY `disbursement_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `liquidation`
--
ALTER TABLE `liquidation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `materials`
--
ALTER TABLE `materials`
  MODIFY `material_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `projects`
--
ALTER TABLE `projects`
  MODIFY `project_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `project_progress`
--
ALTER TABLE `project_progress`
  MODIFY `progress_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `purok`
--
ALTER TABLE `purok`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `sk_members`
--
ALTER TABLE `sk_members`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `survey_responses`
--
ALTER TABLE `survey_responses`
  MODIFY `response_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `tasks`
--
ALTER TABLE `tasks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `updates`
--
ALTER TABLE `updates`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `disbursements`
--
ALTER TABLE `disbursements`
  ADD CONSTRAINT `disbursements_ibfk_1` FOREIGN KEY (`project_id`) REFERENCES `projects` (`project_id`),
  ADD CONSTRAINT `disbursements_ibfk_2` FOREIGN KEY (`barangay_id`) REFERENCES `barangays` (`id`);

--
-- Constraints for table `liquidation`
--
ALTER TABLE `liquidation`
  ADD CONSTRAINT `liquidation_ibfk_1` FOREIGN KEY (`material_id`) REFERENCES `materials` (`material_id`),
  ADD CONSTRAINT `liquidation_ibfk_2` FOREIGN KEY (`project_id`) REFERENCES `projects` (`project_id`),
  ADD CONSTRAINT `liquidation_ibfk_3` FOREIGN KEY (`barangay_id`) REFERENCES `barangays` (`id`);

--
-- Constraints for table `materials`
--
ALTER TABLE `materials`
  ADD CONSTRAINT `materials_ibfk_1` FOREIGN KEY (`project_id`) REFERENCES `projects` (`project_id`) ON DELETE CASCADE;

--
-- Constraints for table `projects`
--
ALTER TABLE `projects`
  ADD CONSTRAINT `fk_sk_member` FOREIGN KEY (`sk_member_id`) REFERENCES `sk_members` (`id`),
  ADD CONSTRAINT `projects_ibfk_1` FOREIGN KEY (`barangay_id`) REFERENCES `barangays` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `project_progress`
--
ALTER TABLE `project_progress`
  ADD CONSTRAINT `project_progress_ibfk_1` FOREIGN KEY (`project_id`) REFERENCES `projects` (`project_id`) ON DELETE CASCADE;

--
-- Constraints for table `purok`
--
ALTER TABLE `purok`
  ADD CONSTRAINT `purok_ibfk_1` FOREIGN KEY (`barangay_id`) REFERENCES `barangays` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `sk_members`
--
ALTER TABLE `sk_members`
  ADD CONSTRAINT `sk_members_ibfk_1` FOREIGN KEY (`barangay_id`) REFERENCES `barangays` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `survey_responses`
--
ALTER TABLE `survey_responses`
  ADD CONSTRAINT `survey_responses_ibfk_1` FOREIGN KEY (`barangay_id`) REFERENCES `barangays` (`id`);

--
-- Constraints for table `tasks`
--
ALTER TABLE `tasks`
  ADD CONSTRAINT `tasks_ibfk_1` FOREIGN KEY (`project_id`) REFERENCES `projects` (`project_id`);

--
-- Constraints for table `updates`
--
ALTER TABLE `updates`
  ADD CONSTRAINT `updates_ibfk_1` FOREIGN KEY (`project_id`) REFERENCES `projects` (`project_id`),
  ADD CONSTRAINT `updates_ibfk_2` FOREIGN KEY (`task_id`) REFERENCES `tasks` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
