-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 27, 2023 at 09:39 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `drinkityasin`
--

-- --------------------------------------------------------

--
-- Table structure for table `drinkingredients`
--

CREATE TABLE `drinkingredients` (
  `ingredient_id` int(11) NOT NULL,
  `drink_id` int(11) DEFAULT NULL,
  `amount` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `drinkingredients`
--

INSERT INTO `drinkingredients` (`ingredient_id`, `drink_id`, `amount`) VALUES
(1, 8, '1.00'),
(2, 8, '2.00'),
(3, 8, '1.00'),
(4, 9, '3.00'),
(5, 10, '3.00'),
(6, 11, '2.00'),
(7, 11, '1.00'),
(8, 11, '2.00'),
(12, 13, '1.00'),
(13, 13, '4.00'),
(14, 13, '2.00'),
(15, 14, '1.00'),
(16, 14, '2.00'),
(17, 14, '3.00'),
(23, 4, '1.00'),
(24, 4, '2.00'),
(25, 4, '1.00'),
(26, 7, '1.00'),
(27, 7, '2.00'),
(28, 8, '1.00'),
(29, 9, '1.00'),
(30, 10, '1.00'),
(31, 11, '2.00'),
(33, 13, '1.00'),
(34, 13, '2.00'),
(35, 13, '3.00'),
(36, 14, '2.00'),
(37, 14, '2.00'),
(38, 14, '1.00'),
(42, 16, '1.00'),
(43, 16, '2.00'),
(44, 17, '1.00'),
(45, 17, '2.00'),
(46, 18, '1.00'),
(47, 18, '1.00'),
(48, 18, '2.00'),
(49, 19, '2.00'),
(50, 19, '1.00'),
(51, 19, '3.00'),
(52, 20, '2.00'),
(53, 20, '3.00'),
(54, 20, '1.00'),
(55, 21, '3.00'),
(56, 21, '2.00'),
(57, 21, '1.00'),
(61, 23, '2.00'),
(62, 23, '1.00'),
(63, 23, '2.00'),
(64, 24, '1.00'),
(65, 24, '2.00'),
(66, 25, '1.00'),
(67, 25, '2.00'),
(68, 25, '3.00'),
(69, 26, '2.00'),
(70, 26, '3.00'),
(71, 26, '2.00'),
(72, 27, '3.00'),
(73, 27, '2.00'),
(74, 27, '2.00'),
(75, 28, '3.00'),
(76, 28, '1.00'),
(77, 28, '1.00'),
(78, 29, '2.00'),
(79, 29, '1.00'),
(80, 29, '3.00');

-- --------------------------------------------------------

--
-- Table structure for table `drinks`
--

CREATE TABLE `drinks` (
  `drink_id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `category` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `rating` decimal(3,2) DEFAULT NULL,
  `serving_size` int(11) DEFAULT NULL,
  `image_url` varchar(255) DEFAULT NULL,
  `hyvaksytty` tinyint(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `drinks`
--

INSERT INTO `drinks` (`drink_id`, `name`, `category`, `description`, `rating`, `serving_size`, `image_url`, `hyvaksytty`) VALUES
(1, 'polankka', 'sd', 'saklandi', NULL, NULL, NULL, 0),
(4, 'porankadgfg', 'dd', 'dfd', NULL, NULL, NULL, 0),
(7, 'polankkax', 'sd', 'rrrt', NULL, NULL, NULL, 1),
(8, 'porankaz', 'sd', 'srrr', NULL, NULL, NULL, 1),
(9, 'porankazfg', 'sd', 'srrr', NULL, NULL, NULL, 1),
(10, 'porankazfg', 'sd', 'srrr', NULL, NULL, NULL, 1),
(11, 'kemal sde', 'sd', 'ksjd', NULL, NULL, NULL, 1),
(13, 'ayjamal', 'kst', 'bamusiz', NULL, NULL, NULL, 1),
(14, 'polankkakk', 'sd', 'kgu', NULL, NULL, NULL, 1),
(16, 'monika', 'sd', 'mksjuta', '0.00', 0, '', 0),
(17, 'mxmm', 'sd', 'kxmkmx', '0.00', 0, '', 0),
(18, 'koyuncu', 'sms', 'kdkjsd', '0.00', 0, '', 0),
(19, 'ahiska', 'turk', 'orta asia', '0.00', 0, '', 0),
(20, 'kazak', 'turk', 'ortaasua', '0.00', 0, '', 0),
(21, 'uygur', 'turk', 'ortaasia', '0.00', 0, '', 0),
(23, 'kigiz', 'turk', 'ortasia', '0.00', 0, '', 0),
(24, 'mutar', 'kskd', 'kandan adem yahshi', '0.00', 0, '', 0),
(25, 'paris', 'firanch', 'captal city', '0.00', 0, '', 0),
(26, 'london', 'eurp', 'big city', '0.00', 0, '', 0),
(27, 'istanbul', 'turk', 'big city in the turkey', '0.00', 0, '', 0),
(28, 'ankara', 'aisa', 'captal city in turkey', '0.00', 0, '', 0),
(29, 'tampere', 'fin', 'second city in the suomi', '0.00', 0, '', 0);

-- --------------------------------------------------------

--
-- Table structure for table `ingredients`
--

CREATE TABLE `ingredients` (
  `ingredient_id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `category` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ingredients`
--

INSERT INTO `ingredients` (`ingredient_id`, `name`, `category`, `description`) VALUES
(1, 'birad', NULL, NULL),
(2, 'vodka', NULL, NULL),
(3, 'koiy', NULL, NULL),
(4, 'hg', NULL, NULL),
(5, 'yasin', NULL, NULL),
(6, 'vodkas', NULL, NULL),
(7, 'dkkd', NULL, NULL),
(8, 'gfd', NULL, NULL),
(12, 'kurban', NULL, NULL),
(13, 'isa', NULL, NULL),
(14, 'ayjamal', NULL, NULL),
(15, 'rekip', NULL, NULL),
(16, 'kamal', NULL, NULL),
(17, 'eli', NULL, NULL),
(23, 'rizvangul', NULL, NULL),
(24, 'rukyem', NULL, NULL),
(25, 'kort', NULL, NULL),
(26, 'kurbanjan', NULL, NULL),
(27, 'mamutjan', NULL, NULL),
(28, 'ksk', NULL, NULL),
(29, 'vodkakk', NULL, NULL),
(30, 'kit', NULL, NULL),
(31, 'kotka', NULL, NULL),
(33, 'potka', NULL, NULL),
(34, 'yotka', NULL, NULL),
(35, 'votka', NULL, NULL),
(36, 'lotka', NULL, NULL),
(37, 'dotka', NULL, NULL),
(38, 'ankara', NULL, NULL),
(42, 'qotka', NULL, NULL),
(43, 'izbasr', NULL, NULL),
(44, 'monika', NULL, NULL),
(45, 'xorta', NULL, NULL),
(46, 'ahiska', NULL, NULL),
(47, 'kazak', NULL, NULL),
(48, 'kirgz', NULL, NULL),
(49, 'paris', NULL, NULL),
(50, 'london', NULL, NULL),
(51, 'moscow', NULL, NULL),
(52, 'beijing', NULL, NULL),
(53, 'shanghai', NULL, NULL),
(54, 'shenzhen', NULL, NULL),
(55, 'new yourk', NULL, NULL),
(56, 'hanoi', NULL, NULL),
(57, 'hongkong', NULL, NULL),
(61, 'foshan', NULL, NULL),
(62, 'urumqi', NULL, NULL),
(63, 'kashgar', NULL, NULL),
(64, 'istanbul', NULL, NULL),
(65, 'koit', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `username` int(11) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(50) DEFAULT NULL,
  `role` tinyint(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`username`, `password`, `email`, `role`) VALUES
(1, 'yasin ', 'sd', 0),
(2, 'yasinjjan', 'sd', 0),
(3, 'yasiiin', 'sd', 0),
(4, 'molitof', 'sd', 0),
(5, 'yasin sahyars', 'sd', 0),
(6, 'polankkaaa', 'sd', 0),
(7, 'kkkdh', 'sd', 0),
(8, 'kamal', 'sd', 0),
(9, 'isa', 'sd', 0),
(10, 'emer', 'sd', 0),
(11, 'tunyaz', 'sd', 0),
(12, 'ayjamal', 'dd', 0),
(13, 'bilkiz', 'dd', 0),
(14, 'zohregul', 'dd', 0),
(15, 'osman', 'sd', 0),
(16, 'kurban', 'sd', 0),
(17, 'kutyar', 'dd', 0),
(18, '$2y$10$z/7JAjzXQOyJaE4yku4uYO54Quit5I1hlfwVYJpjX9mLhuaBpK1tq', '', 0),
(19, '$2y$10$8q70LawlWtkTF36.YOqIiu0YqWXdgTzb6IQBgVuLbHNQJMz5gvUbK', '', 0),
(20, '$2y$10$6M72tadyUCJbr90iZylf9e9ojbDe79M/pVPeM2mLOxaoeu2sgHWfS', 'urumci@yahoo.com', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `drinkingredients`
--
ALTER TABLE `drinkingredients`
  ADD PRIMARY KEY (`ingredient_id`),
  ADD KEY `drinkingredients_ibfk_1` (`drink_id`);

--
-- Indexes for table `drinks`
--
ALTER TABLE `drinks`
  ADD PRIMARY KEY (`drink_id`);

--
-- Indexes for table `ingredients`
--
ALTER TABLE `ingredients`
  ADD PRIMARY KEY (`ingredient_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `drinkingredients`
--
ALTER TABLE `drinkingredients`
  MODIFY `ingredient_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=81;

--
-- AUTO_INCREMENT for table `drinks`
--
ALTER TABLE `drinks`
  MODIFY `drink_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `ingredients`
--
ALTER TABLE `ingredients`
  MODIFY `ingredient_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=66;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `username` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `drinkingredients`
--
ALTER TABLE `drinkingredients`
  ADD CONSTRAINT `drinkingredients_ibfk_1` FOREIGN KEY (`drink_id`) REFERENCES `drinks` (`drink_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `ingredients`
--
ALTER TABLE `ingredients`
  ADD CONSTRAINT `ingredients_ibfk_1` FOREIGN KEY (`ingredient_id`) REFERENCES `drinkingredients` (`ingredient_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
