-- phpMyAdmin SQL Dump
-- version 4.5.2
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Sep 25, 2016 at 11:09 AM
-- Server version: 5.7.9
-- PHP Version: 5.6.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `internal_job_portal`
--

-- --------------------------------------------------------

--
-- Table structure for table `ijp_job_posts`
--

DROP TABLE IF EXISTS `ijp_job_posts`;
CREATE TABLE IF NOT EXISTS `ijp_job_posts` (
  `post_id` int(11) NOT NULL AUTO_INCREMENT,
  `job_title` varchar(255) NOT NULL,
  `no_of_vacancies` int(6) NOT NULL,
  `job_description` varchar(1000) DEFAULT NULL,
  `job_skill_set` varchar(1000) DEFAULT NULL,
  `salary` varchar(255) DEFAULT NULL,
  `experience` varchar(255) DEFAULT NULL,
  `status` enum('P','A','D','') NOT NULL,
  `project_id` int(11) NOT NULL,
  `eid` int(11) NOT NULL,
  `posted_by` varchar(5) NOT NULL,
  `date_of_creation` datetime NOT NULL,
  `date_of_modification` datetime NOT NULL,
  PRIMARY KEY (`post_id`),
  KEY `manager_id` (`eid`),
  KEY `project_id` (`project_id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ijp_job_posts`
--

INSERT INTO `ijp_job_posts` (`post_id`, `job_title`, `no_of_vacancies`, `job_description`, `job_skill_set`, `salary`, `experience`, `status`, `project_id`, `eid`, `posted_by`, `date_of_creation`, `date_of_modification`) VALUES
(1, '', 5, 'Hadoop developer', 'Map reduce,pig,java', '10lakh - 12lakh', '2yr - 5yr', 'A', 1, 1, 'A', '2016-09-23 09:22:24', '2016-09-23 00:00:00'),
(2, 'test', 12, 'Lead Automate testing', 'Selenium,Selenium,Selenium,Selenium', '100k - 200k', '3yr - 5yr', 'A', 2, 2, 'M', '2016-09-24 00:00:00', '2016-09-24 00:00:00'),
(3, '', 12, 'UI developer', 'HTML5,css3,NodeJs', '122000', '5yr', 'P', 1, 2, 'M', '2016-09-26 00:00:00', '2016-09-26 00:00:00'),
(4, '', 13, 'MySQL Admin', 'Replication,mysql ', '1234567', '10yr', 'P', 1, 2, 'M', '2016-09-26 00:00:00', '2016-09-26 00:00:00'),
(6, '', 42344345, '1234545', 'Array', '123456', '12', 'P', 1, 42344345, 'A', '2016-09-25 12:44:53', '2016-09-25 12:44:53'),
(7, '', 42344345, '1234545', 'Array', '123456', '12', 'P', 1, 42344345, 'A', '2016-09-25 12:45:14', '2016-09-25 12:45:14'),
(8, '', 344, 'jjgjgk', 'a:2:{i:0;s:14:"Dallas Cowboys";i:1;s:15:"New York Giants";}', '23467', '12', 'P', 2, 1, 'A', '2016-09-25 12:52:22', '2016-09-25 12:52:22'),
(9, '', 12, 'fdfsdf', 'Dallas Cowboys,Atlanta Falcons', '12345', '12', 'P', 2, 1, 'A', '2016-09-25 13:15:27', '2016-09-25 13:15:27'),
(10, 'qwerty', 12, 'fdfsdf', 'Dallas Cowboys,Atlanta Falcons', '12345', '12', 'P', 2, 1, 'A', '2016-09-25 13:16:44', '2016-09-25 13:16:44'),
(11, 'tester', 12, 'automate testing', 'Dallas Cowboys,Philadelphia Eagles', '12222', '12', 'A', 1, 1, 'A', '2016-09-25 15:58:40', '2016-09-25 15:58:40'),
(12, 'deployment', 1, 'responsiable for deployment and develop deployment scripts', 'Minnesota Vikings', '122222', '12', 'A', 2, 1, 'A', '2016-09-25 16:01:51', '2016-09-25 16:01:51'),
(13, 'deployment', 1, 'responsiable for deployment and develop deployment scripts', 'Minnesota Vikings', '122222', '12', 'A', 2, 1, 'A', '2016-09-25 16:01:52', '2016-09-25 16:01:52'),
(14, 'deployment', 1, 'responsiable for deployment and develop deployment scripts', 'Minnesota Vikings', '122222', '12', 'A', 2, 1, 'A', '2016-09-25 16:01:54', '2016-09-25 16:01:54'),
(15, 'UI desinger', 12, 'Design a good designs as per latest standards', 'Atlanta Falcons', '123456', '12', 'A', 1, 1, 'A', '2016-09-25 16:04:57', '2016-09-25 16:04:57'),
(16, 'test', 2345, 'responsible for project management', NULL, '223445', '12', 'A', 2, 1, 'A', '2016-09-25 16:06:51', '2016-09-25 16:06:51'),
(17, 'test', 2345, 'responsible for project management', NULL, '223445', '12', 'A', 2, 1, 'A', '2016-09-25 16:24:11', '2016-09-25 16:24:11'),
(18, 'test', 2345, 'rrrrrrrrrrrrrrrrrresponsible for project management', NULL, '223445', '12', 'A', 2, 1, 'A', '2016-09-25 16:24:32', '2016-09-25 16:24:32'),
(19, 'test', 2345, 'for project managementtttttttttttttttttt', NULL, '223445', '12', 'A', 2, 1, 'A', '2016-09-25 16:24:58', '2016-09-25 16:38:57');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `ijp_job_posts`
--
ALTER TABLE `ijp_job_posts`
  ADD CONSTRAINT `ijp_job_posts_ibfk_1` FOREIGN KEY (`project_id`) REFERENCES `ijp_projects_list` (`project_id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
