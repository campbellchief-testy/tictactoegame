-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Sep 07, 2016 at 10:33 PM
-- Server version: 10.1.13-MariaDB
-- PHP Version: 5.6.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tictactoe`
--

-- --------------------------------------------------------

--
-- Table structure for table `summary`
--

CREATE TABLE `summary` (
  `id` int(11) NOT NULL,
  `date_game` int(11) NOT NULL,
  `p1_name` varchar(50) NOT NULL,
  `p2_name` varchar(50) NOT NULL,
  `winner_name` varchar(50) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `summary`
--

INSERT INTO `summary` (`id`, `date_game`, `p1_name`, `p2_name`, `winner_name`) VALUES
(1, 0, 'Bob', 'Jim', 'Jim'),
(2, 1473277941, 'A', 'B', 'B'),
(3, 1473278978, '''James''', '''Jones''', '''Jones'''),
(4, 1473279008, '''Jimmy''', '''Bobby''', '''Jimmy'''),
(5, 1473279046, '''A''', '''B''', '''A'''),
(6, 1473279269, '''A''', '''B''', '''A'''),
(7, 1473279317, '''A''', '''B''', '''A'''),
(8, 1473279448, '''A''', '''B''', '''B'''),
(9, 1473279461, '''A''', '''B''', '''A'''),
(10, 1473279483, '''X''', '''Y''', '''X'''),
(11, 1473279509, '''X''', '''O''', '''O'''),
(12, 1473279540, '''X''', '''A''', '''X'''),
(13, 1473280014, '''L''', '''C''', '''C''');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `summary`
--
ALTER TABLE `summary`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `summary`
--
ALTER TABLE `summary`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
