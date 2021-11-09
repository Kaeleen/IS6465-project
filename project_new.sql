-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Nov 09, 2021 at 07:59 PM
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
-- Database: `project_new`
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
(1, 'admin', '123'),
(2, 'h', '123');

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
  `course_name` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `credit` float(10,2) DEFAULT NULL,
  `semester` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `year` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `open_for_enrollment` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `department_id` int DEFAULT NULL,
  `prereq_id` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `description` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  PRIMARY KEY (`course_id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `course`
--

INSERT INTO `course` (`course_id`, `course_name`, `credit`, `semester`, `year`, `open_for_enrollment`, `department_id`, `prereq_id`, `description`) VALUES
(1, 'Machine Learning ', 4.00, 'Fall', '2021', '', 1, '1,2', NULL),
(2, 'Advanced algorithums', 4.00, 'Fall', '2021', '', 1, '4', NULL),
(3, 'Algorithums', 3.00, 'Fall', '2020', NULL, 1, '', NULL),
(4, 'Data Science and Big Data', 2.00, 'Summer', '2020', '', 2, '3', NULL),
(5, 'Information Technology ', 3.00, 'Spring', '2019', '', 2, '2', NULL),
(7, 'Intro to comp programming', 3.00, 'Spring', '2019', '', 1, '', NULL),
(8, 'Accounting Fundamentals', 4.00, 'Fall', '2021', '', 3, '', NULL),
(9, 'Intro to Architecture', 3.00, 'Fall', '2021', '', 4, '', NULL),
(10, 'test', 4.00, 'Fall', '2020', '', 0, '1', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `department`
--

DROP TABLE IF EXISTS `department`;
CREATE TABLE IF NOT EXISTS `department` (
  `department_id` int NOT NULL AUTO_INCREMENT,
  `department_name` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `collage` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  PRIMARY KEY (`department_id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `department`
--

INSERT INTO `department` (`department_id`, `department_name`, `collage`) VALUES
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
  `enrollment_id` int NOT NULL AUTO_INCREMENT,
  `student_id` int NOT NULL,
  `course_id` int NOT NULL,
  `session_id` int NOT NULL,
  `grade` float(10,2) DEFAULT NULL,
  `date_enrolled` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `date_dropped` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  PRIMARY KEY (`enrollment_id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `enrollment`
--

INSERT INTO `enrollment` (`enrollment_id`, `student_id`, `course_id`, `session_id`, `grade`, `date_enrolled`, `date_dropped`) VALUES
(1, 1, 1, 2, 3.50, '2021-08-07', NULL),
(2, 1, 2, 6, NULL, '2021-08-15', NULL),
(3, 1, 4, 5, 3.20, '2020-04-20', NULL),
(4, 1, 5, 8, 3.50, '2019-01-07', NULL),
(5, 1, 7, 10, 3.20, '2019-01-07', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `faculty`
--

DROP TABLE IF EXISTS `faculty`;
CREATE TABLE IF NOT EXISTS `faculty` (
  `faculty_id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `course_id` int DEFAULT NULL,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  PRIMARY KEY (`faculty_id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `faculty`
--

INSERT INTO `faculty` (`faculty_id`, `course_id`, `name`, `password`) VALUES
(1, 2, 'Aria', NULL),
(2, 2, 'Lucas', NULL),
(3, 5, 'Layla', NULL),
(4, 7, 'Mary', NULL);

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
  `session_name` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `s_days` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `s_time` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `quota` int DEFAULT NULL,
  `course_id` int DEFAULT NULL,
  `advisor_id` int DEFAULT NULL,
  `location` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  PRIMARY KEY (`session_id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `session`
--

INSERT INTO `session` (`session_id`, `session_name`, `s_days`, `s_time`, `quota`, `course_id`, `advisor_id`, `location`) VALUES
(1, 'session1', 'Tuesday and Wednesday', '2-4pm', 10, 1, 1, 'WEB 123'),
(2, 'session2', 'Monday and Thursday', '2-4pm', 10, 1, 2, 'WEB 456'),
(3, 'session3', 'Tuesday', '6-10pm', 5, 4, 3, 'SFEBB 123'),
(5, 'session4', 'Monday', '1-5pm', 5, 4, 3, 'SFEBB 503'),
(6, 'session5', 'Thursday and Monday', '9-11am', 30, 2, 4, 'ABC 102'),
(7, 'session6', 'Friday', '1-3pm', 20, 3, 5, 'ABC 698'),
(8, 'session7', 'Thursday', '4-6pm', 15, 5, 3, 'XYZ 201'),
(9, 'session8', 'Monday', '7-9am', 20, 6, 6, 'XYZ 207'),
(10, 'session9', 'Tuesday', '1-3pm', 10, 7, 7, 'WD 103'),
(11, 'session10', 'Friday', '8-10am', 25, 8, 8, 'WD 605');

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
  `program_id` int DEFAULT NULL,
  `tel` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `dob` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  PRIMARY KEY (`student_id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`student_id`, `name`, `email`, `address`, `password`, `program_id`, `tel`, `dob`) VALUES
(1, 'Fu', 'kaeleen1211@gmail.com', '1520 6th ABC Street', '123', 1, '5183013605', '12/11/1995'),
(2, 'Lee', 'lee.david@outlook.com', '200 S 600 E', '123', 2, '6548512648', '08/26/1996'),
(3, 'Jacob', 'jacob@outlook.com', NULL, '123', 10, '5312465124', '03/17/1995'),
(4, 'Zoey Wilson', NULL, NULL, '123', 3, '4548878965', '02/15/1992'),
(7, 'William Davis', NULL, NULL, '123', 4, '8016245973', NULL),
(8, 'Sophia', NULL, NULL, '123', 5, '3215456215', NULL),
(9, 'Emma', NULL, NULL, '123', 6, '5621254125', NULL);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
