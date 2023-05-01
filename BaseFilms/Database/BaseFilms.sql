-- phpMyAdmin SQL Dump
-- version 5.1.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: May 01, 2023 at 10:36 AM
-- Server version: 5.7.24
-- PHP Version: 8.0.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `projet`
--

-- --------------------------------------------------------

--
-- Table structure for table `vc_films`
--

CREATE TABLE `vc_films` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `titre` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `synopsis` text NOT NULL,
  `note` int(11) DEFAULT NULL,
  `fav` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `vc_utilisateurs`
--

CREATE TABLE `vc_utilisateurs` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `mail` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `inscr_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `vc_utilisateurs`
--

INSERT INTO `vc_utilisateurs` (`id`, `username`, `mail`, `password`, `inscr_date`) VALUES
(5, 'admin', 'vcanu95@gmail.com', '$2y$10$8EleMsZH833DLUts5iKBpOIbibX/PBomlAV1aznZdb3tEeTn.w7bi', '2022-12-03 22:05:03'),
(14, 'test', 'test@gmail.com', '$2y$10$znHJZMAY1v8mBaDiVCbTj.xkwvK9W6TaUj/QIOaRly4k6uO/EaLja', '2023-04-11 20:51:39');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `vc_films`
--
ALTER TABLE `vc_films`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `vc_utilisateurs`
--
ALTER TABLE `vc_utilisateurs`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `vc_films`
--
ALTER TABLE `vc_films`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `vc_utilisateurs`
--
ALTER TABLE `vc_utilisateurs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `vc_films`
--
ALTER TABLE `vc_films`
  ADD CONSTRAINT `vc_films_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `vc_utilisateurs` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
