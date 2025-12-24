-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 24, 2025 at 10:16 PM
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
-- Database: `taskstorage`
--

-- --------------------------------------------------------

--
-- Table structure for table `maintask`
--

CREATE TABLE `maintask` (
  `taskID` int(11) NOT NULL,
  `taskName` varchar(50) NOT NULL,
  `taskDesc` text NOT NULL,
  `taskDue` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `maintask`
--

INSERT INTO `maintask` (`taskID`, `taskName`, `taskDesc`, `taskDue`) VALUES
(1, 'Testing Task System', 'This is a Task meant to Test Systems and Functionality of Task Display', '2022-01-01'),
(2, 'TestDeletion', 'This task will be Deleted upon all subtasks Completion', '2100-01-01'),
(3, 'Fill The Gallery', 'Create 5 Images to replace the Placeholders', '2023-06-19');

-- --------------------------------------------------------

--
-- Table structure for table `subtask`
--

CREATE TABLE `subtask` (
  `subID` int(11) NOT NULL,
  `subTask` text NOT NULL,
  `subParent` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `subtask`
--

INSERT INTO `subtask` (`subID`, `subTask`, `subParent`) VALUES
(1, 'Click Check Box', 1),
(2, 'Look a Bear! Didja see it!?', 1),
(3, 'Finish Task', 1),
(4, 'Click Here', 2),
(5, 'Clock Here', 2),
(6, 'Tick Here', 2),
(7, 'Image One', 3),
(8, 'Image Two', 3),
(9, 'Image Three', 3),
(10, 'Image Four', 3),
(11, 'Image Five', 3);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `maintask`
--
ALTER TABLE `maintask`
  ADD PRIMARY KEY (`taskID`);

--
-- Indexes for table `subtask`
--
ALTER TABLE `subtask`
  ADD PRIMARY KEY (`subID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `maintask`
--
ALTER TABLE `maintask`
  MODIFY `taskID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `subtask`
--
ALTER TABLE `subtask`
  MODIFY `subID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
