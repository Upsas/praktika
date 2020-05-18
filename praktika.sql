-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 18, 2020 at 01:08 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `praktika`
--

-- --------------------------------------------------------

--
-- Table structure for table `duomenys`
--

CREATE TABLE `duomenys` (
  `id` int(11) NOT NULL,
  `site` varchar(30) NOT NULL,
  `alexa_ranks` int(20) NOT NULL,
  `visitors` int(30) NOT NULL,
  `data_created` timestamp NOT NULL DEFAULT current_timestamp(),
  `data_updated` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `duomenys`
--

INSERT INTO `duomenys` (`id`, `site`, `alexa_ranks`, `visitors`, `data_created`, `data_updated`) VALUES
(434, 'tv3.lt', 32763, 3466, '2020-05-12 13:33:05', '2020-05-13 13:59:03'),
(435, 'delfi.lt', 3748, 3000000, '2020-05-12 13:33:05', '2020-05-13 10:03:07'),
(437, '15min.lt', 8307, 120000, '2020-05-13 10:08:44', '2020-05-13 10:10:15'),
(438, 'lrtyas.lt', 10260, 8000, '2020-05-13 10:08:44', '2020-05-13 10:08:44'),
(440, 'lrt.lt', 18392, 5289, '2020-05-13 10:10:03', '2020-05-13 13:57:53');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `duomenys`
--
ALTER TABLE `duomenys`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `duomenys`
--
ALTER TABLE `duomenys`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=441;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
