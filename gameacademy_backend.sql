-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 16, 2020 at 05:09 AM
-- Server version: 10.3.15-MariaDB
-- PHP Version: 7.3.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `gameacademy_backend`
--

-- --------------------------------------------------------

--
-- Table structure for table `game`
--

CREATE TABLE `game` (
  `game_id` int(50) NOT NULL,
  `game_name` varchar(100) NOT NULL,
  `time_start` date NOT NULL,
  `time_end` date NOT NULL,
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `game`
--

INSERT INTO `game` (`game_id`, `game_name`, `time_start`, `time_end`, `status`) VALUES
(1, 'Game A', '2020-09-01', '2020-11-30', 1),
(2, 'Game B', '2020-08-14', '2020-10-14', 1),
(3, 'Game C', '2020-11-01', '2020-11-30', 1),
(5, 'Game D', '2020-10-01', '2020-10-31', 1),
(6, 'Game E', '2020-10-15', '2020-12-15', 1);

-- --------------------------------------------------------

--
-- Table structure for table `level`
--

CREATE TABLE `level` (
  `gameLevel_id` int(50) NOT NULL,
  `game_id` int(50) NOT NULL,
  `level_name` varchar(100) NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `level`
--

INSERT INTO `level` (`gameLevel_id`, `game_id`, `level_name`, `description`) VALUES
(1, 1, 'Level 1', 'Beginner Level'),
(2, 1, 'Level 2', 'Intermediate Level'),
(5, 2, 'Level 1', 'Beginner Level'),
(6, 3, 'Level 1', 'Beginner Level'),
(7, 2, 'Level 4', 'Expert Level'),
(8, 5, 'Level 1', 'Beginner Level'),
(9, 5, 'Level 2', 'Intermediate Level'),
(10, 5, 'Level 3', 'Hard Level'),
(11, 6, 'Level 1', 'Beginner Level'),
(12, 6, 'Level 2', 'Intermediate Level'),
(13, 6, 'Level 3', 'Hard Level'),
(14, 6, 'Level 4', 'Expert Level');

-- --------------------------------------------------------

--
-- Table structure for table `score`
--

CREATE TABLE `score` (
  `user_id` int(50) NOT NULL,
  `gameLevel_id` int(50) NOT NULL,
  `score` int(100) NOT NULL,
  `time_submit` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `score`
--

INSERT INTO `score` (`user_id`, `gameLevel_id`, `score`, `time_submit`) VALUES
(1, 1, 90, '2020-10-16 02:16:28'),
(1, 1, 30, '2020-10-16 02:16:53'),
(1, 8, 80, '2020-10-16 02:34:20'),
(1, 11, 70, '2020-10-16 02:38:59'),
(1, 11, 90, '2020-10-16 02:39:11'),
(1, 12, 80, '2020-10-16 02:39:25'),
(3, 1, 100, '2020-10-16 02:41:27'),
(3, 11, 40, '2020-10-16 02:41:36'),
(3, 12, 80, '2020-10-16 02:41:49'),
(3, 8, 80, '2020-10-16 02:41:59'),
(3, 9, 87, '2020-10-16 02:42:12');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `token` varchar(255) NOT NULL,
  `username` varchar(50) NOT NULL,
  `status` tinyint(1) DEFAULT NULL,
  `level` enum('admin','user') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `email`, `password`, `token`, `username`, `status`, `level`) VALUES
(1, 'user@gmail.com', 'ee11cbb19052e40b07aac0ca060c23ee', 'd8b819cd56c4adfd0359255a3b192f0d', 'user', 1, 'user'),
(2, 'admin@gmail.com', '21232f297a57a5a743894a0e4a801fc3', 'f1797befcd8f4cf17ecc38ee501b9822', 'admin', 1, 'admin'),
(3, 'user2@gmail.com', '7e58d63b60197ceb55a1c487989a3720', '4b2327abb059765b7ffd77d3b5a6934c', 'user2', 1, 'user');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `game`
--
ALTER TABLE `game`
  ADD PRIMARY KEY (`game_id`);

--
-- Indexes for table `level`
--
ALTER TABLE `level`
  ADD PRIMARY KEY (`gameLevel_id`),
  ADD KEY `game_id` (`game_id`);

--
-- Indexes for table `score`
--
ALTER TABLE `score`
  ADD KEY `user_id` (`user_id`),
  ADD KEY `gameLevel_id` (`gameLevel_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `game`
--
ALTER TABLE `game`
  MODIFY `game_id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `level`
--
ALTER TABLE `level`
  MODIFY `gameLevel_id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `level`
--
ALTER TABLE `level`
  ADD CONSTRAINT `level_ibfk_1` FOREIGN KEY (`game_id`) REFERENCES `game` (`game_id`);

--
-- Constraints for table `score`
--
ALTER TABLE `score`
  ADD CONSTRAINT `score_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`),
  ADD CONSTRAINT `score_ibfk_2` FOREIGN KEY (`gameLevel_id`) REFERENCES `level` (`gameLevel_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
