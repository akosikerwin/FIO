-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 13, 2025 at 10:39 AM
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
-- Database: `lakandula_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `content` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `user_id`, `content`, `created_at`) VALUES
(1, 16, 'ang angas ko talaga', '2025-01-13 07:42:22'),
(2, 16, 'pogi ni kerwin ', '2025-01-13 07:44:47'),
(3, 16, 'ang lupit ko talaga', '2025-01-13 08:42:39'),
(4, 16, 'nag lupit ko talaga', '2025-01-13 08:42:51'),
(5, 16, 'zak love fio', '2025-01-13 08:46:32'),
(6, 16, 'hey you', '2025-01-13 08:50:27'),
(8, 18, 'AKO SI FIONA', '2025-01-13 09:24:48'),
(9, 18, 'ADELYN SECOND NAME KO', '2025-01-13 09:25:00'),
(10, 18, 'MARTINEZ SURNAME KO', '2025-01-13 09:25:36'),
(11, 18, 'MARUPOK AKO', '2025-01-13 09:25:45');

-- --------------------------------------------------------

--
-- Table structure for table `signup`
--

CREATE TABLE `signup` (
  `id` int(11) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `firstname` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `dob` date NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `signup`
--

INSERT INTO `signup` (`id`, `lastname`, `firstname`, `email`, `dob`, `password`, `created_at`) VALUES
(1, 'brinas', 'kerwin', 'kerwinbrinas@gmail.com', '2002-03-18', '$2y$10$JFglhGOj8iOpR7yKkep4oeNe7SuuWuI.I7r8aAPjexKfjtyhXcZ4S', '2025-01-09 08:13:28'),
(2, 'brinas', 'Rodolfo', 'ker@gmail.com', '1993-02-25', '$2y$10$L/xhcTP8KbJVjMsXfELKqOHlNLHqz7D4DvV1uzw2VXgqGoyfIIeAy', '2025-01-09 08:19:26'),
(3, 'Reyes', 'Fiona', 'hugoboss@gmail.com', '2004-06-17', '$2y$10$JS/6h6LlxCRn8NBheCzO0.0U1Wl06VnzMRaxhbqvC9ZC4U9ywYfKa', '2025-01-09 08:45:16'),
(5, 'merabueno', 'dayan', 'dayang@gmail.com', '2009-12-02', '$2y$10$ojW5WklZJvYna3h..eJH3.hKsb6IX6bRhZdT8w37E/ykmHtYaKAEq', '2025-01-09 09:23:40'),
(6, 'ricamara', 'lanz', 'lanz@gmail.com', '2005-06-25', '$2y$10$V6QlomBPF0pW.iaFUkIzuO7cIn6rayvgRViwO3NujGZC626vB9o0W', '2025-01-09 10:06:17'),
(7, 'Martinez', 'Fiona', 'fiona@gmail.com', '2003-07-17', '$2y$10$XxDr5oSySLZHu/XgjXqCPOQHPE8rAvJdUdfpyAb8miPK9j0yYqxRi', '2025-01-10 08:59:17'),
(8, 'Ricamara', 'Lanz', 'Ashlee@gmail.com', '2003-07-17', '$2y$10$Lt3Lpav9yIhPzsMdW6ecJ.eiitmwTdOTEDnk/pqKLugAVELwIjRTm', '2025-01-10 09:02:03'),
(9, 'ricamara', 'lanz', 'brinas@gmail.com', '5788-12-04', '$2y$10$jfOeof6IOk0dgqX88CjB1.9X2/7Uu.7tY/Ms8SYMgPyIhTB5XNuoe', '2025-01-10 09:04:54'),
(14, 'Martinez', 'Fiona', 'Adelyn@gmail.com', '2002-03-18', '$2y$10$Gf1D8I0pjW.Dlh4bQ6wfxuP5xq3Wo6Fysb6NNZUYXK20sYF6xdl.6', '2025-01-13 05:47:18'),
(15, 'Martinez', 'Fiona', 'Kerwin@gmail.com', '2002-03-18', '$2y$10$Du8jTFxk3XqP82Z44MePU.lIau3yqcrsdqWGfaYtHgG5ZQ7vCoUo.', '2025-01-13 06:10:47'),
(16, 'Briñas', 'John Kerwin', 'john@gmail.com', '2002-03-18', '$2y$10$nvbRKSgfLEKjQmT51f37B.VH5hRhJy9lZfLRJCT3t8SmSZ3gxPEBC', '2025-01-13 07:41:15'),
(18, 'MARTINEZ', 'FIONA', 'lagdan@gmail.com', '2002-03-18', '$2y$10$Ilts095lqgflyHoUTuHOBu03QzORUraew04rhtLnpSpTu0dSBIxuy', '2025-01-13 09:23:44');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `signup`
--
ALTER TABLE `signup`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `signup`
--
ALTER TABLE `signup`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `posts`
--
ALTER TABLE `posts`
  ADD CONSTRAINT `posts_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `signup` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
