-- phpMyAdmin SQL Dump
-- version 4.6.6
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Apr 26, 2018 at 09:18 AM
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
-- Table structure for table `web_employee_department`
--

CREATE TABLE `web_employee_department` (
  `id` int(6) NOT NULL,
  `topic_th` varchar(100) NOT NULL,
  `topic_en` varchar(100) NOT NULL,
  `topic_cn` varchar(100) NOT NULL,
  `admin_company` int(10) NOT NULL,
  `commission` int(20) NOT NULL DEFAULT '0',
  `post_date` varchar(100) NOT NULL,
  `update_date` varchar(100) NOT NULL,
  `posted` varchar(100) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `web_employee_department`
--

INSERT INTO `web_employee_department` (`id`, `topic_th`, `topic_en`, `topic_cn`, `admin_company`, `commission`, `post_date`, `update_date`, `posted`, `status`) VALUES
(1, 'ฝ่ายจัดรถ', 'Car management', '汽车管理', 1, 20, '1524734186', '1524734186', '', 1),
(2, 'โปรแกรมเมอร์', 'Programmer', '程序员', 1, 20, '1524733157', '1524733157', '', 1),
(3, 'บัญชี', 'Accounting', '会计部门', 1, 20, '1524733145', '1524733145', '', 1),
(4, 'โรงแรม', 'Hotel', '旅馆', 1, 21, '1524733520', '1524733520', '', 1),
(5, 'คอลล์ เซ็นเตอร์', 'Call center', '呼叫中心', 1, 19, '1524733538', '1524733538', '', 1),
(6, 'change_status_department', 'test05', 'change_status_department', 1, 0, '1524720001', '1524720008', '', 0),
(7, 'test04', 'test04', 'test04', 1, 0, '1524720058', '1524720065', '', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `web_employee_department`
--
ALTER TABLE `web_employee_department`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `web_employee_department`
--
ALTER TABLE `web_employee_department`
  MODIFY `id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
