-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: May 03, 2024 at 03:13 PM
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
-- Database: `FilmBibliotheek`
--

-- --------------------------------------------------------
--
-- Dumping data for table `UserListsLines`
--

INSERT INTO `UserListsLines` (`id`, `UserId`, `FilmId`, `rating`, `ListTypesId`) VALUES
(5, 1, 3, 0.0, 1),
(6, 1, 4, 2.0, 2),
(7, 1, 5, 7.0, 3),
(8, 1, 6, 4.5, 4),
(9, 1, 7, 0.0, 1),
(10, 1, 8, 5.5, 2),
(11, 1, 9, 2.5, 3),
(12, 1, 10, 6.0, 4),
(13, 1, 11, 0.0, 1),
(14, 1, 12, 1.0, 2),
(15, 1, 13, 3.5, 3),
(16, 1, 14, 10.0, 4),
(17, 1, 15, 0.0, 1),
(18, 1, 16, 6.5, 2),
(19, 1, 17, 8.0, 3),
(20, 1, 18, 3.0, 4),
(21, 1, 19, 0.0, 1),
(22, 1, 20, 2.0, 2),
(23, 1, 21, 7.5, 3),
(24, 1, 22, 1.0, 4),
(25, 1, 23, 0.0, 1),
(26, 1, 24, 7.0, 2),
(27, 1, 25, 0.0, 3),
(28, 1, 26, 6.5, 4),
(29, 1, 27, 0.0, 1),
(30, 1, 28, 8.5, 2),
(31, 1, 29, 2.5, 3),
(32, 1, 30, 4.0, 4),
(33, 1, 31, 0.0, 1),
(34, 1, 32, 1.0, 2),
(35, 1, 33, 3.5, 3),
(36, 1, 34, 10.0, 4),
(37, 1, 35, 0.0, 1),
(38, 1, 36, 7.5, 2),
(39, 1, 37, 5.0, 3),
(40, 1, 38, 8.5, 4),
(41, 1, 39, 0.0, 1),
(42, 1, 40, 1.5, 2),
(43, 1, 41, 2.0, 3),
(44, 1, 42, 9.5, 4),
(45, 2, 3, 0.0, 1),
(46, 2, 4, 4.5, 2),
(47, 2, 5, 6.5, 3),
(48, 2, 6, 3.0, 4),
(49, 2, 7, 0.0, 1),
(50, 2, 8, 1.0, 2),
(51, 2, 9, 2.5, 3),
(52, 2, 10, 0.0, 4),
(53, 2, 11, 0.0, 1),
(54, 2, 12, 5.5, 2),
(55, 2, 13, 7.0, 3),
(56, 2, 14, 2.5, 4),
(57, 2, 15, 0.0, 1),
(58, 2, 16, 6.0, 2),
(59, 2, 17, 3.5, 3),
(60, 2, 18, 4.5, 4),
(61, 2, 19, 0.0, 1),
(62, 2, 20, 5.0, 2),
(63, 2, 21, 0.0, 3),
(64, 2, 22, 1.0, 4),
(65, 2, 23, 0.0, 1),
(66, 2, 24, 7.5, 2),
(67, 2, 25, 4.0, 3),
(68, 2, 26, 8.5, 4);

COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
