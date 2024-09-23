-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 23, 2024 at 10:00 PM
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
-- Database: `project`
--

-- --------------------------------------------------------

--
-- Table structure for table `tasks`
--

CREATE TABLE `tasks` (
  `id` int(20) NOT NULL,
  `title` varchar(30) NOT NULL,
  `list_id` int(20) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `status` enum('Pending','In Progress','Completed','') NOT NULL,
  `owner` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tasks`
--

INSERT INTO `tasks` (`id`, `title`, `list_id`, `created_at`, `status`, `owner`) VALUES
(31, 'web', 24, '2024-09-23 11:05:40', 'Pending', ''),
(32, 'θεματα', 25, '2024-09-23 11:05:46', 'Pending', ''),
(39, 'Σεπτεμβριου', 28, '2024-09-23 11:19:01', 'Pending', ''),
(42, 'εξεταστικηTEST', 28, '2024-09-23 11:31:02', 'Pending', ''),
(51, 'aasadafa', 28, '2024-09-23 12:25:07', 'Pending', ''),
(52, 'asdasd', 28, '2024-09-23 12:25:19', 'Pending', ''),
(54, 'aaaaa', 28, '2024-09-23 16:23:30', 'Pending', ''),
(57, 'web2', 24, '2024-09-23 17:08:14', 'Pending', ''),
(59, 'ergasies', 30, '2024-09-23 19:44:30', 'Pending', ''),
(60, 'ergasia b', 31, '2024-09-23 19:45:47', 'Pending', ''),
(61, 'ergasia b2', 32, '2024-09-23 19:48:09', 'Pending', ''),
(62, 'ergasia1', 33, '2024-09-23 19:49:26', 'Pending', ''),
(63, 'ergasia vasili', 34, '2024-09-23 19:54:12', 'Pending', '');

-- --------------------------------------------------------

--
-- Table structure for table `task_lists`
--

CREATE TABLE `task_lists` (
  `id` int(15) NOT NULL,
  `title` varchar(30) NOT NULL,
  `owner` varchar(30) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `task_lists`
--

INSERT INTO `task_lists` (`id`, `title`, `owner`, `created_at`) VALUES
(24, 'Τεχνολογιες Διαδυκτιου', 'default_owner', '2024-09-23 11:05:40'),
(25, 'ΣΥΑ', 'default_owner', '2024-09-23 11:05:46'),
(28, 'εξεταστικη ', 'default_owner', '2024-09-23 11:19:01'),
(30, 'lista', 'root', '2024-09-23 19:44:30'),
(31, 'baseis', 'root', '2024-09-23 19:45:47'),
(32, 'baseis', 'root', '2024-09-23 19:48:09'),
(33, 'prwth lista', 'root', '2024-09-23 19:49:26'),
(34, 'vasilis', 'root', '2024-09-23 19:54:12');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(128) NOT NULL,
  `lastName` varchar(128) NOT NULL,
  `username` varchar(128) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password_hash` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `lastName`, `username`, `email`, `password_hash`) VALUES
(21, 'Onoma', 'epwnymo', 'username', 'email@emai.gr', '$2y$10$rVGKIDfX6LG3SP1Uaigg5OB3Mag4A3ItbRDaJA3edK33Qu3.XFK2W'),
(22, 'onoma1', 'epo1', 'username', 'emailuser@wer.gr', '$2y$10$O2WLVEBu6LDqQ420qXkQDe9a3ElnvaVm.9NeEBCYIuDfH5lvEpEa2'),
(23, 'aaaa', 'aaaa', 'aaaaaa', 'aaaa@aaaa.gr', '$2y$10$jt/2Y/pioZFWFXf6gtdQSuNZQfue/sujphDLwH5Nw4ZL9iRjy5Ah.'),
(25, 'qweqwe', 'qweqwe', 'wearess', 'weare@we.gr', '$2y$10$Px7UfOWQ1xan0DhqDCgiReD1jyqqIlWrTiAxuRZXFklnFsbrYPan2'),
(26, 'qweqwe', 'qweqe', 'asdasd', 'konslygkouris@gmail.com', '$2y$10$XxlN3/Z9JH3KrXuZWriAX.moDB2aL1r/.WSLDFhtipfRwa5zxt.Ze'),
(28, 'kostas11', 'lygkou11', 'kostasly', 'ly@kostas.gr', '$2y$10$huAxbfeR8GDeo9W1yh10e.TGhh0gDk0OnpArDBwNqavfta5H6Df3y'),
(35, 'name', 'last', 'blakas123123', 'user@name.grq', '$2y$10$Nm/G16vDGX4tU3aVdGn8ROFrazLOfxviO5KCf6CBpUsIRwEuLO092'),
(36, 'Kostas', 'Lygkouris', 'kostas1', 'kostas@gmail.com', '$2y$10$UG8ok14itnPqyxBx5ew0SuH9uTfmtOZ./f7rFjF1d7/5N/8aUtt.S'),
(37, 'vasilis', 'kleisouras', 'vasilis1', 'vasil@asds.gr', '$2y$10$KxR1dJeUcWwVmv8a7v8ZZuNBeLRPR7QJrR.OVBWDudugQu4ytRmm2');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tasks`
--
ALTER TABLE `tasks`
  ADD PRIMARY KEY (`id`),
  ADD KEY `list_id` (`list_id`) USING BTREE;

--
-- Indexes for table `task_lists`
--
ALTER TABLE `task_lists`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tasks`
--
ALTER TABLE `tasks`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;

--
-- AUTO_INCREMENT for table `task_lists`
--
ALTER TABLE `task_lists`
  MODIFY `id` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
