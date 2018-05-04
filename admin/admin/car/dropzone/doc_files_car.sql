-- phpMyAdmin SQL Dump
-- version 4.6.6
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: May 04, 2018 at 03:28 AM
-- Server version: 5.7.17-log
-- PHP Version: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `admin_web`
--

-- --------------------------------------------------------

--
-- Table structure for table `doc_files_car`
--

CREATE TABLE `doc_files_car` (
  `id` int(11) NOT NULL,
  `name_file` varchar(50) NOT NULL,
  `car_number` int(11) NOT NULL,
  `date_insurance` varchar(50) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `last_update` varchar(100) NOT NULL,
  `posted` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `doc_files_car`
--

INSERT INTO `doc_files_car` (`id`, `name_file`, `car_number`, `date_insurance`, `status`, `last_update`, `posted`) VALUES
(1, 'test.jpg', 15, '', 1, '', 'admin'),
(8, 'no1.jpg', 15, '', 1, '1525345197', ''),
(9, 'no1.jpg', 301, '2018-05-03', 1, '1525345943', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `doc_files_car`
--
ALTER TABLE `doc_files_car`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `doc_files_car`
--
ALTER TABLE `doc_files_car`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
