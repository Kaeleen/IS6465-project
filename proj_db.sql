-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Oct 28, 2021 at 09:35 PM
-- Server version: 8.0.21
-- PHP Version: 7.3.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `proj_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

DROP TABLE IF EXISTS `admin`;
CREATE TABLE IF NOT EXISTS `admin` (
  `admin_id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '123',
  PRIMARY KEY (`admin_id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_id`, `name`, `password`) VALUES
(1, 'f', '123'),
(2, 'admin', '123');

-- --------------------------------------------------------

--
-- Table structure for table `advisor`
--

DROP TABLE IF EXISTS `advisor`;
CREATE TABLE IF NOT EXISTS `advisor` (
  `advisor_id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '123',
  PRIMARY KEY (`advisor_id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `advisor`
--

INSERT INTO `advisor` (`advisor_id`, `name`, `password`) VALUES
(1, 'Oliver Wilson', '123'),
(2, 'Peter Park', '123'),
(3, 'Alexander Clark', '123'),
(5, 'Isabella Green', '123'),
(6, 'James Carter', '123'),
(7, 'Lewis Michael', '123'),
(8, 'Cristin Wu', '123');

-- --------------------------------------------------------

--
-- Table structure for table `course`
--

DROP TABLE IF EXISTS `course`;
CREATE TABLE IF NOT EXISTS `course` (
  `course_id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `credit` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `quota` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `semester` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `year` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `open_for_enrollment` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `department_id` int DEFAULT NULL,
  `prereq_id` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `description` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  PRIMARY KEY (`course_id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `course`
--

INSERT INTO `course` (`course_id`, `name`, `credit`, `quota`, `semester`, `year`, `open_for_enrollment`, `department_id`, `prereq_id`, `description`) VALUES
(1, 'Machine Learning ', '4', '30', 'Fall', '2021', '', 1, '1,2', NULL),
(2, 'Advanced algorithums', '4', '15', 'Fall', '2021', '', 1, '4', NULL),
(3, 'Algorithums', '3', '40', 'Fall', '2020', NULL, 1, '', NULL),
(4, 'Data Science and Big Data', '3', '30', 'Summer', '2020', '', 2, '3', NULL),
(5, 'Information Technology ', '3', '5', 'Spring', '2019', '', 2, '2', NULL),
(7, 'Intro to comp programming', '3', '5', 'Spring', '2019', '', 1, '', NULL),
(8, 'Accounting Fundamentals', '4', '20', 'Fall', '2021', '', 3, '', NULL),
(9, 'Intro to Architecture', '3', '25', 'Fall', '2021', '', 4, '', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `department`
--

DROP TABLE IF EXISTS `department`;
CREATE TABLE IF NOT EXISTS `department` (
  `department_id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `collage` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  PRIMARY KEY (`department_id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `department`
--

INSERT INTO `department` (`department_id`, `name`, `collage`) VALUES
(1, 'School of Computing ', NULL),
(2, 'Business School', NULL),
(3, 'School of Accounting', NULL),
(4, 'School of Architecture', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `enrollment`
--

DROP TABLE IF EXISTS `enrollment`;
CREATE TABLE IF NOT EXISTS `enrollment` (
  `enroll_id` int NOT NULL AUTO_INCREMENT,
  `student_id` int DEFAULT NULL,
  `course_id` int DEFAULT NULL,
  `grade` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `date_enrolled` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `date_dropped` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `year` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  PRIMARY KEY (`enroll_id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `enrollment`
--

INSERT INTO `enrollment` (`enroll_id`, `student_id`, `course_id`, `grade`, `date_enrolled`, `date_dropped`, `year`) VALUES
(1, 1, 13, '3', '2021-3-27', '2021-6-27', '2021'),
(2, 1, 9, NULL, '2021-10-27', NULL, '2021');

-- --------------------------------------------------------

--
-- Table structure for table `faculty`
--

DROP TABLE IF EXISTS `faculty`;
CREATE TABLE IF NOT EXISTS `faculty` (
  `faculty_id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  PRIMARY KEY (`faculty_id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `faculty`
--

INSERT INTO `faculty` (`faculty_id`, `name`, `password`) VALUES
(1, 'Aria', NULL),
(3, 'Lucas', NULL),
(4, 'Layla', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `prereq`
--

DROP TABLE IF EXISTS `prereq`;
CREATE TABLE IF NOT EXISTS `prereq` (
  `prereq_id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `prereq_name` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `credit` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  PRIMARY KEY (`prereq_id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `prereq`
--

INSERT INTO `prereq` (`prereq_id`, `prereq_name`, `credit`) VALUES
(1, 'Algorithums', '3'),
(2, 'Intro to comp programming', '3'),
(3, 'Mathematics', '4'),
(4, 'Writing', '3');

-- --------------------------------------------------------

--
-- Table structure for table `program`
--

DROP TABLE IF EXISTS `program`;
CREATE TABLE IF NOT EXISTS `program` (
  `program_id` int NOT NULL AUTO_INCREMENT,
  `type` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `program_name` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  PRIMARY KEY (`program_id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `program`
--

INSERT INTO `program` (`program_id`, `type`, `program_name`) VALUES
(1, 'MS', 'MS in Computer Science'),
(2, 'MS', 'MS in Information Systems'),
(3, 'MS', 'MS in Finance'),
(4, 'BS', 'BS in Information Systems'),
(6, 'BS', 'BS in Architecture'),
(7, 'MS', 'MS in Physics'),
(8, 'BS', 'BS in Biology'),
(9, 'BS', 'BS in Mathematics'),
(10, 'BS', 'BS in Geology'),
(11, 'MS', 'MS in Business Analysis');

-- --------------------------------------------------------

--
-- Table structure for table `session`
--

DROP TABLE IF EXISTS `session`;
CREATE TABLE IF NOT EXISTS `session` (
  `session_id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `s_days` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `s_time` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `course_id` int DEFAULT NULL,
  `advisor_id` int DEFAULT NULL,
  `location` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  PRIMARY KEY (`session_id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `session`
--

INSERT INTO `session` (`session_id`, `s_days`, `s_time`, `course_id`, `advisor_id`, `location`) VALUES
(1, 'Tuesday and Wednesday', '2-4pm', 1, 1, 'WEB 123'),
(2, 'Monday and Thursday', '2-4pm', 1, 2, 'WEB 456'),
(3, 'Tuesday', '6-10pm', 4, 3, 'SFEBB 123'),
(5, 'Monday', '1-5pm', 4, 3, 'SFEBB 503'),
(6, 'Thursday and Monday', '9-11am', 2, 4, 'ABC 102'),
(7, 'Friday', '1-3pm', 3, 5, 'ABC 698'),
(8, 'Thursday', '4-6pm', 5, 3, 'XYZ 201'),
(9, 'Monday', '7-9am', 6, 6, 'XYZ 207'),
(10, 'Tuesday', '1-3pm', 7, 7, 'WD 103'),
(11, 'Friday', '8-10am', 8, 8, 'WD 605');

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

DROP TABLE IF EXISTS `student`;
CREATE TABLE IF NOT EXISTS `student` (
  `student_id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `email` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `address` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '123',
  `program` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `tel` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  PRIMARY KEY (`student_id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`student_id`, `name`, `email`, `address`, `password`, `program`, `tel`) VALUES
(1, 'Fu', NULL, NULL, '123', 'MS in Computer Science', '5183013605'),
(2, 'Lee', NULL, NULL, '123', 'MS in Information Systems ', '6548512648'),
(3, 'Jacob', NULL, NULL, '123', 'MS in Information Systems ', '5312465124'),
(4, 'Zoey Wilson', NULL, NULL, '123', 'MS in Information Systems ', '4548878965'),
(7, 'William Davis', NULL, NULL, '123', 'MS in Computer Science', '8016245973'),
(8, 'Sophia', NULL, NULL, '123', 'MS in Finance', '3215456215'),
(9, 'Emma', NULL, NULL, '123', 'BS in Information Systems', '5621254125');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
