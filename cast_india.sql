-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 13, 2023 at 05:52 AM
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
-- Database: `cast_india`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_tbl`
--

CREATE TABLE `admin_tbl` (
  `admin_id` int(11) UNSIGNED NOT NULL,
  `first_name` varchar(32) NOT NULL,
  `last_name` varchar(32) NOT NULL,
  `photo` varchar(200) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `role` varchar(255) NOT NULL COMMENT 'admin or trainer',
  `access_code` text NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0 COMMENT '0=pending,1=confirm',
  `notify` tinyint(1) NOT NULL DEFAULT 0 COMMENT 'Confirm notified by email',
  `created` datetime NOT NULL,
  `modified` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `last_login` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `admin_tbl`
--

INSERT INTO `admin_tbl` (`admin_id`, `first_name`, `last_name`, `photo`, `email`, `password`, `role`, `access_code`, `status`, `notify`, `created`, `modified`, `last_login`) VALUES
(1, 'admin', 'admin', '', 'admin@gmail.com', '$2y$10$XxHvIOhQp22DTXg3rPHKju8324jx8xf1PlPySDGZWjpEN.LIiMfam', 'admin', 'LTq6Ua1thlKDGzpbqPHNdYkFeowdOI8t', 1, 1, '2021-08-12 04:18:06', '2023-05-13 03:51:42', '2023-05-13 09:21:42');

-- --------------------------------------------------------

--
-- Table structure for table `auth_token`
--

CREATE TABLE `auth_token` (
  `token_id` int(11) UNSIGNED NOT NULL,
  `token_code` varchar(30) NOT NULL,
  `user_id` int(11) UNSIGNED NOT NULL DEFAULT 0,
  `created_on` datetime NOT NULL,
  `expire_on` datetime NOT NULL,
  `is_active` int(11) NOT NULL,
  `is_deleted` int(11) NOT NULL,
  `last_login` datetime NOT NULL DEFAULT current_timestamp(),
  `ip` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `auth_token`
--

INSERT INTO `auth_token` (`token_id`, `token_code`, `user_id`, `created_on`, `expire_on`, `is_active`, `is_deleted`, `last_login`, `ip`) VALUES
(1, 'be8dcb51af8857dd', 1, '2023-05-12 08:34:37', '2023-05-12 14:34:37', 0, 0, '2023-05-12 08:34:37', ''),
(2, 'e359df807aa099bf', 1, '2023-05-12 08:42:35', '2023-05-12 14:42:35', 0, 0, '2023-05-12 08:42:35', ''),
(3, 'a76b20c6fa9266ee', 1, '2023-05-12 21:13:19', '2023-05-13 04:58:14', 0, 0, '2023-05-12 21:13:19', ''),
(4, '03f0714623cab97b', 1, '2023-05-12 23:01:27', '2023-05-13 05:01:59', 0, 0, '2023-05-12 23:01:27', ''),
(5, '672d8f4dc04eae02', 2, '2023-05-13 08:03:31', '2023-05-13 15:15:55', 0, 0, '2023-05-13 08:03:31', ''),
(6, '3e3af7d55422b320', 1, '2023-05-13 09:21:05', '2023-05-13 15:21:12', 0, 0, '2023-05-13 09:21:05', '');

-- --------------------------------------------------------

--
-- Table structure for table `auth_token_admin`
--

CREATE TABLE `auth_token_admin` (
  `token_id` int(11) UNSIGNED NOT NULL,
  `token_code` varchar(30) NOT NULL,
  `admin_id` int(11) UNSIGNED NOT NULL DEFAULT 0,
  `created_on` datetime NOT NULL,
  `expire_on` datetime NOT NULL,
  `is_active` int(11) NOT NULL,
  `is_deleted` int(11) NOT NULL,
  `last_login` datetime NOT NULL DEFAULT current_timestamp(),
  `ip` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `auth_token_admin`
--

INSERT INTO `auth_token_admin` (`token_id`, `token_code`, `admin_id`, `created_on`, `expire_on`, `is_active`, `is_deleted`, `last_login`, `ip`) VALUES
(1, 'ed5319b2f3e714c4', 1, '2023-05-12 09:05:58', '2023-05-12 15:05:58', 0, 0, '2023-05-12 09:05:58', '::1'),
(2, 'fa0dcb691137e006', 1, '2023-05-12 09:09:52', '2023-05-12 15:09:52', 0, 0, '2023-05-12 09:09:52', '::1'),
(3, 'f598c7489056c0ee', 1, '2023-05-12 23:03:01', '2023-05-13 06:58:30', 0, 0, '2023-05-12 23:03:01', '::1'),
(4, 'affa6064e09ca8a0', 1, '2023-05-13 08:04:46', '2023-05-13 15:12:43', 0, 0, '2023-05-13 08:04:46', '::1'),
(5, '2fed9e41169ecf37', 1, '2023-05-13 09:14:56', '2023-05-13 15:15:06', 0, 0, '2023-05-13 09:14:56', '::1'),
(6, '3882ff6a81e351c3', 1, '2023-05-13 09:21:42', '2023-05-13 15:21:49', 0, 0, '2023-05-13 09:21:42', '::1');

-- --------------------------------------------------------

--
-- Table structure for table `job_list_tbl`
--

CREATE TABLE `job_list_tbl` (
  `job_id` int(255) NOT NULL,
  `job_title` varchar(255) NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `job_list_tbl`
--

INSERT INTO `job_list_tbl` (`job_id`, `job_title`, `created_date`) VALUES
(1, 'Web Development', '2023-05-13 02:39:13'),
(2, 'Frontend Developer', '2023-05-13 02:39:13'),
(3, 'Backend Developer', '2023-05-13 02:39:13'),
(4, 'Flutter Developer', '2023-05-13 02:39:13'),
(5, 'Java Developer', '2023-05-13 02:39:13');

-- --------------------------------------------------------

--
-- Table structure for table `usersjob_mapping_tbl`
--

CREATE TABLE `usersjob_mapping_tbl` (
  `id` int(255) NOT NULL,
  `user_id` int(255) NOT NULL,
  `job_id` int(255) NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `usersjob_mapping_tbl`
--

INSERT INTO `usersjob_mapping_tbl` (`id`, `user_id`, `job_id`, `created_date`) VALUES
(1, 1, 1, '2023-05-13 02:42:04'),
(2, 1, 2, '2023-05-13 02:42:04'),
(4, 2, 1, '2023-05-13 02:42:04'),
(5, 2, 2, '2023-05-13 02:42:04'),
(6, 2, 4, '2023-05-13 02:42:04');

-- --------------------------------------------------------

--
-- Table structure for table `users_detail`
--

CREATE TABLE `users_detail` (
  `id` int(255) NOT NULL,
  `user_id` int(100) NOT NULL,
  `address` varchar(10000) NOT NULL,
  `dob` date NOT NULL DEFAULT current_timestamp(),
  `profile_pic` varchar(255) NOT NULL,
  `pic_code` int(6) NOT NULL,
  `city` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users_detail`
--

INSERT INTO `users_detail` (`id`, `user_id`, `address`, `dob`, `profile_pic`, `pic_code`, `city`) VALUES
(1, 1, 'indore', '2023-05-12', '645e750a9d77e_1683911946.png', 450215, 'Indore'),
(2, 2, 'indore', '2023-05-13', '', 12345, 'Indore');

-- --------------------------------------------------------

--
-- Table structure for table `users_services`
--

CREATE TABLE `users_services` (
  `id` int(100) NOT NULL,
  `user_id` int(100) NOT NULL,
  `service_name` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users_services`
--

INSERT INTO `users_services` (`id`, `user_id`, `service_name`) VALUES
(1, 1, 'test'),
(2, 2, 'TEST');

-- --------------------------------------------------------

--
-- Table structure for table `users_table`
--

CREATE TABLE `users_table` (
  `user_id` int(100) NOT NULL,
  `user_name` varchar(100) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `mobile_number` varchar(15) NOT NULL,
  `access_token` varchar(255) NOT NULL,
  `isActive` tinyint(10) NOT NULL DEFAULT 0,
  `isDeleted` tinyint(10) NOT NULL DEFAULT 0,
  `createdAt` timestamp NOT NULL DEFAULT current_timestamp(),
  `updatedAt` timestamp NOT NULL DEFAULT current_timestamp(),
  `last_login` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users_table`
--

INSERT INTO `users_table` (`user_id`, `user_name`, `email`, `password`, `mobile_number`, `access_token`, `isActive`, `isDeleted`, `createdAt`, `updatedAt`, `last_login`) VALUES
(1, 'Test', 'ac@gmail.com', '$2y$10$XxHvIOhQp22DTXg3rPHKju8324jx8xf1PlPySDGZWjpEN.LIiMfam', '7788996633', 'l8j1VVxNwfQs2ccHKdnWVMxzguIXwo23', 0, 0, '2023-05-12 03:02:54', '2023-05-12 03:02:54', '2023-05-13 03:51:05'),
(2, 'Demo', 'demo@gmail.com', '$2y$10$pon0RKFBTzqkESDnDTtBku1aJ0PmlpqQPYgy9O2TVXumCzKmdW/9e', '8877965474', 'YEoB3nxCA9WsZ1hP5nHpor4ZIRRv7JUp', 0, 0, '2023-05-13 02:33:17', '2023-05-13 02:33:17', '2023-05-13 02:33:30');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_tbl`
--
ALTER TABLE `admin_tbl`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `auth_token`
--
ALTER TABLE `auth_token`
  ADD PRIMARY KEY (`token_id`);

--
-- Indexes for table `auth_token_admin`
--
ALTER TABLE `auth_token_admin`
  ADD PRIMARY KEY (`token_id`);

--
-- Indexes for table `job_list_tbl`
--
ALTER TABLE `job_list_tbl`
  ADD PRIMARY KEY (`job_id`);

--
-- Indexes for table `usersjob_mapping_tbl`
--
ALTER TABLE `usersjob_mapping_tbl`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users_detail`
--
ALTER TABLE `users_detail`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users_services`
--
ALTER TABLE `users_services`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users_table`
--
ALTER TABLE `users_table`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_tbl`
--
ALTER TABLE `admin_tbl`
  MODIFY `admin_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `auth_token`
--
ALTER TABLE `auth_token`
  MODIFY `token_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `auth_token_admin`
--
ALTER TABLE `auth_token_admin`
  MODIFY `token_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `job_list_tbl`
--
ALTER TABLE `job_list_tbl`
  MODIFY `job_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `usersjob_mapping_tbl`
--
ALTER TABLE `usersjob_mapping_tbl`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `users_detail`
--
ALTER TABLE `users_detail`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users_services`
--
ALTER TABLE `users_services`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users_table`
--
ALTER TABLE `users_table`
  MODIFY `user_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
