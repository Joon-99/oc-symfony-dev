-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 08, 2025 at 10:01 PM
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
-- Database: `tomtroc`
--

-- --------------------------------------------------------

--
-- Table structure for table `authors`
--

CREATE TABLE `authors` (
  `id` int(11) NOT NULL,
  `first_name` varchar(255) DEFAULT NULL,
  `last_name` varchar(255) DEFAULT NULL,
  `pen_name` varchar(255) DEFAULT NULL,
  `biography` text DEFAULT NULL,
  `valid` int(11) NOT NULL DEFAULT 1,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

--
-- Dumping data for table `authors`
--

INSERT INTO `authors` (`id`, `first_name`, `last_name`, `pen_name`, `biography`, `valid`, `created_at`, `updated_at`) VALUES
(1, NULL, NULL, 'Alabaster', NULL, 1, '2025-04-07 02:17:29', '2025-04-07 02:17:29'),
(2, 'Nathan', 'Williams', NULL, NULL, 1, '2025-04-07 02:17:29', '2025-04-07 02:17:29'),
(3, 'Beth', 'Kempton', NULL, NULL, 1, '2025-04-07 02:17:29', '2025-04-07 02:17:29'),
(4, 'Rupi', 'Kaur', NULL, NULL, 1, '2025-04-07 02:17:29', '2025-04-07 02:17:29'),
(5, 'Justin', 'Rossow', NULL, NULL, 1, '2025-04-14 05:50:06', '2025-04-14 05:50:06');

-- --------------------------------------------------------

--
-- Table structure for table `books`
--

CREATE TABLE `books` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `author_id` int(11) NOT NULL,
  `owner_id` int(11) NOT NULL,
  `cover_img_id` int(11) DEFAULT NULL,
  `available` tinyint(1) NOT NULL DEFAULT 1,
  `valid` int(11) NOT NULL DEFAULT 1,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

--
-- Dumping data for table `books`
--

INSERT INTO `books` (`id`, `title`, `description`, `author_id`, `owner_id`, `cover_img_id`, `available`, `valid`, `created_at`, `updated_at`) VALUES
(1, 'Esther', NULL, 1, 2, 1, 1, 1, '2025-04-07 02:25:39', '2025-04-07 03:36:39'),
(2, 'The Kinfolk Table', 'J\'ai récemment plongé dans les pages de \'The Kinfolk Table\' et j\'ai été enchanté par cette œuvre captivante. Ce livre va bien au-delà d\'une simple collection de recettes ; il célèbre l\'art de partager des moments authentiques autour de la table.<br><br> Les photographies magnifiques et le ton chaleureux captivent dès le départ, transportant le lecteur dans un voyage à travers des recettes et des histoires qui mettent en avant la beauté de la simplicité et de la convivialité.<br><br> Chaque page est une invitation à ralentir, à savourer et à créer des souvenirs durables avec les êtres chers.<br><br> \'The Kinfolk Table\' incarne parfaitement l\'esprit de la cuisine et de la camaraderie, et il est certain que ce livre trouvera une place spéciale dans le cœur de tout amoureux de la cuisine et des rencontres inspirantes.', 2, 3, 2, 1, 1, '2025-04-07 02:25:39', '2025-04-14 11:32:15'),
(3, 'Wabi Sabi', NULL, 3, 4, 3, 1, 1, '2025-04-07 02:25:39', '2025-04-07 03:37:21'),
(4, 'Milk & honey', NULL, 4, 5, 4, 1, 1, '2025-04-07 02:25:39', '2025-04-07 03:37:24'),
(5, 'Delight!', NULL, 5, 6, 5, 1, 1, '2025-04-14 06:03:27', '2025-04-14 06:03:27');

-- --------------------------------------------------------

--
-- Table structure for table `files`
--

CREATE TABLE `files` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `mime_type` varchar(255) DEFAULT NULL,
  `file_path` varchar(255) DEFAULT NULL,
  `valid` int(11) NOT NULL DEFAULT 1,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

--
-- Dumping data for table `files`
--

INSERT INTO `files` (`id`, `user_id`, `title`, `mime_type`, `file_path`, `valid`, `created_at`, `updated_at`) VALUES
(1, NULL, 'Esther', 'image/jpeg', 'esther.jpg', 1, '2025-04-07 03:24:34', '2025-04-14 09:02:50'),
(2, NULL, 'The Kinfolk Table', 'image/jpeg', 'the-kinfolk-table.jpg', 1, '2025-04-07 03:24:34', '2025-04-14 09:03:04'),
(3, NULL, 'Wabi Sabi', 'image/jpeg', 'wabi-sabi.jpg', 1, '2025-04-07 03:24:34', '2025-04-14 09:03:11'),
(4, NULL, 'Milk & honey', 'image/jpeg', 'milk-honey.jpg', 1, '2025-04-07 03:24:34', '2025-04-14 09:03:16'),
(5, NULL, 'delight', 'image/jpeg', 'delight.jfif', 1, '2025-04-14 06:02:58', '2025-04-14 09:03:23'),
(6, 3, 'nathalire', 'image/jpeg', 'nathalire.jfif', 1, '2025-04-14 11:51:50', '2025-04-14 11:51:50'),
(7, NULL, 'anonymous user profile image', 'image/png', 'anonymous-user.png', 1, '2025-04-22 11:49:10', '2025-04-22 11:49:10');

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id` int(11) NOT NULL,
  `sender_id` int(11) NOT NULL,
  `receiver_id` int(11) NOT NULL,
  `content` text NOT NULL,
  `valid` int(11) NOT NULL DEFAULT 1,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password_hash` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `profile_img_id` int(11) DEFAULT NULL,
  `valid` int(11) NOT NULL DEFAULT 1,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password_hash`, `email`, `profile_img_id`, `valid`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'admin', 'admin@admin.com', NULL, 1, '2025-04-07 02:12:17', '2025-04-07 02:12:17'),
(2, 'CamilleClubLit', 'camilleclublit', 'test@test.com', NULL, 1, '2025-04-07 02:12:17', '2025-04-07 02:12:17'),
(3, 'Nathalire', 'nathalire', 'test@test.com', 6, 1, '2025-04-07 02:12:17', '2025-04-14 11:57:39'),
(4, 'Alexlecture', 'alexlecture', 'test@test.com', NULL, 1, '2025-04-07 02:12:17', '2025-04-07 02:12:17'),
(5, 'Hugo1990_12', 'hugo1990_12', 'test@test.com', NULL, 1, '2025-04-07 02:12:17', '2025-04-07 02:12:17'),
(6, 'juju1432', '$2y$10$HgFz.0Ql0p4oOvkXbU4Di.ZgeXueqvbIlYQ5ovU/8wJGR6ylJTf62', 'juju@juju.com', NULL, 1, '2025-04-14 05:57:59', '2025-05-02 09:03:12'),
(7, 'test', '$2y$10$CTQOvLDfL4vrJl1rVJsJbeBV6EK0IAJpf9/PeGkGoNDG8Ysq.Zk4q', 'testing@testing.com', 7, 1, '2025-04-21 20:36:46', '2025-05-02 08:44:36'),
(8, 'test2', '$2y$10$4bBQTFq81Y8I9Mhs7hzDVOiUTc1PjqVoqMjO2GK777RF0nMtH5ANa', 'testing2@testing.com', NULL, 1, '2025-04-21 22:30:43', '2025-04-21 22:30:43'),
(9, 'test3', '$2y$10$AG9xhVZB28e/d0H83uZrWeFwJW87Tokuu4DHIokIuKajC65GIXfBm', 'testing3@testing.com', NULL, 1, '2025-04-22 13:13:17', '2025-04-22 13:13:17');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `authors`
--
ALTER TABLE `authors`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `books`
--
ALTER TABLE `books`
  ADD PRIMARY KEY (`id`),
  ADD KEY `author` (`author_id`),
  ADD KEY `owner` (`owner_id`),
  ADD KEY `cover_img_id` (`cover_img_id`);

--
-- Indexes for table `files`
--
ALTER TABLE `files`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sender_id` (`sender_id`),
  ADD KEY `receiver_id` (`receiver_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_users_files` (`profile_img_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `authors`
--
ALTER TABLE `authors`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `books`
--
ALTER TABLE `books`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `files`
--
ALTER TABLE `files`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `books`
--
ALTER TABLE `books`
  ADD CONSTRAINT `books_ibfk_1` FOREIGN KEY (`author_id`) REFERENCES `authors` (`id`),
  ADD CONSTRAINT `books_ibfk_2` FOREIGN KEY (`owner_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `books_ibfk_3` FOREIGN KEY (`cover_img_id`) REFERENCES `files` (`id`);

--
-- Constraints for table `files`
--
ALTER TABLE `files`
  ADD CONSTRAINT `files_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `messages`
--
ALTER TABLE `messages`
  ADD CONSTRAINT `messages_ibfk_1` FOREIGN KEY (`sender_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `messages_ibfk_2` FOREIGN KEY (`receiver_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `fk_users_files` FOREIGN KEY (`profile_img_id`) REFERENCES `files` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
