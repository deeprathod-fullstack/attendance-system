-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 20, 2022 at 04:43 PM
-- Server version: 10.4.13-MariaDB
-- PHP Version: 7.2.32

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `attendance`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `email`, `password`) VALUES
(1, 'admin@admin.com', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `attendence`
--

CREATE TABLE `attendence` (
  `id` int(11) NOT NULL,
  `roll_no` int(11) NOT NULL,
  `is_present` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0 default , 1 present , -1 = absent',
  `today_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `attendence`
--

INSERT INTO `attendence` (`id`, `roll_no`, `is_present`, `today_date`) VALUES
(65, 1, -1, '2022-08-20'),
(66, 2, -1, '2022-08-20'),
(67, 1, 1, '2022-08-21'),
(68, 2, -1, '2022-08-21');

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

CREATE TABLE `feedback` (
  `id` int(50) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `phone` varchar(50) NOT NULL,
  `message` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE `student` (
  `s_id` int(11) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`s_id`, `first_name`, `last_name`, `email`, `password`, `image`) VALUES
(1, 'raj', 'asdasd a sasfa asaf asf', 'x@g.c', '0', '1660994158-460841.jpg'),
(2, 'byiyiyii', 'b', 'Admin1@Gmail.Com', '0', '1660994785-478947.jpg'),
(22, 'q', 'w', 'e@g.c', 'r', '1660842112-219492.jpg'),
(23, 'v', 'v', 'x@g.c', 'x', '1660823773-439014.jpg'),
(24, 'a', 'a', '', '0', ''),
(25, 'b', 'b', '', '0', ''),
(26, 'raj', 'rachchh', 'r@g.c', '1', '1660823676-455598.jpg'),
(27, 'v', 'v', 'x@g.c', 'x', '1660823773-439014.jpg'),
(28, 'a', 'a', '', '0', ''),
(29, 'b', 'b', '', '0', ''),
(30, 'raj', 'rachchh', 'r@g.c', '1', '1660823676-455598.jpg'),
(31, 'v', 'v', 'x@g.c', 'x', '1660823773-439014.jpg'),
(32, 'a', 'a', '', '0', ''),
(33, 'b', 'b', '', '0', ''),
(34, 'raj', 'rachchh', 'r@g.c', '1', '1660823676-455598.jpg'),
(35, 'v', 'v', 'x@g.c', 'x', '1660823773-439014.jpg'),
(36, 'a', 'a', 'x@g.c', '0', '1660841016-481893.jpg'),
(37, 'uuu', 'a', 'c@g.c', 'd', '1660843261-228750.jpg'),
(38, 's', 's', 'Admin1@Gmail.Com', 's', '1660844048-166718.jpg'),
(39, 'a', 'a', 'Admin1@Gmail.Com', 'a', '1660844410-274028.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `teacher`
--

CREATE TABLE `teacher` (
  `t_id` int(11) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `teacher`
--

INSERT INTO `teacher` (`t_id`, `first_name`, `last_name`, `email`, `password`, `image`) VALUES
(30, 'a', 'a', 'Admin1@Gmail.Com', 'a', '1660927860-235118.jpg'),
(31, 'a', 'a', 'Admin1@Gmail.Com', 'a', '1660927860-235118.jpg'),
(33, 'a', 'a', 'Admin1@Gmail.Com', 'a', '1660927860-235118.jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `attendence`
--
ALTER TABLE `attendence`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`s_id`);

--
-- Indexes for table `teacher`
--
ALTER TABLE `teacher`
  ADD PRIMARY KEY (`t_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `attendence`
--
ALTER TABLE `attendence`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=69;

--
-- AUTO_INCREMENT for table `feedback`
--
ALTER TABLE `feedback`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `student`
--
ALTER TABLE `student`
  MODIFY `s_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `teacher`
--
ALTER TABLE `teacher`
  MODIFY `t_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
