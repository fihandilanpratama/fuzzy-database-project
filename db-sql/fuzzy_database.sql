-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jun 04, 2021 at 09:17 AM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 7.4.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `fuzzy_database`
--

-- --------------------------------------------------------

--
-- Table structure for table `films`
--

CREATE TABLE `films` (
  `id_film` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `writer` varchar(100) NOT NULL,
  `genre` varchar(100) NOT NULL,
  `rating` float NOT NULL,
  `rilis` int(4) NOT NULL,
  `duration` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `films`
--

INSERT INTO `films` (`id_film`, `name`, `writer`, `genre`, `rating`, `rilis`, `duration`) VALUES
(1, 'In Time', 'Andrew Niccol', 'Action, Sci-Fi, Thriller', 6.7, 2011, 109),
(2, 'who am i', 'jantje friese', 'crime, drama, thriller', 7.5, 2014, 102),
(3, 'hacker', 'akan sateyev', 'crime, drama, thriller', 6.2, 2016, 95),
(5, 'the phone call', 'mat kirkby', 'short, drama', 7.3, 2013, 22),
(6, 'pearl harbour', 'randall wallace', 'action, drama, history', 6.2, 2001, 183);

-- --------------------------------------------------------

--
-- Table structure for table `smartphones`
--

CREATE TABLE `smartphones` (
  `id_smartphone` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `screen_size` float NOT NULL,
  `os` varchar(30) NOT NULL,
  `ram` int(11) NOT NULL,
  `rom` int(11) NOT NULL,
  `battrey_capacity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `smartphones`
--

INSERT INTO `smartphones` (`id_smartphone`, `name`, `screen_size`, `os`, `ram`, `rom`, `battrey_capacity`) VALUES
(3, 'Xiaomi Redmi 9T', 6.53, 'Android 10', 4, 64, 6000),
(4, 'Xiaomi Redmi 9T', 6.53, 'Android 10', 6, 128, 6000),
(5, 'Realmi C21', 6.5, 'Android 10', 3, 32, 5000),
(6, 'Realmi C21', 6.5, 'Android 10', 4, 54, 5000),
(7, 'Samsung Galaxy M02', 6.5, 'Android 10', 2, 32, 5000),
(8, 'OPPO Reno 2F', 6.5, 'Android 9', 8, 128, 4000);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `films`
--
ALTER TABLE `films`
  ADD PRIMARY KEY (`id_film`);

--
-- Indexes for table `smartphones`
--
ALTER TABLE `smartphones`
  ADD PRIMARY KEY (`id_smartphone`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `films`
--
ALTER TABLE `films`
  MODIFY `id_film` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `smartphones`
--
ALTER TABLE `smartphones`
  MODIFY `id_smartphone` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
