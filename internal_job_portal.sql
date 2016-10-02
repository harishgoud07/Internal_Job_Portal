-- phpMyAdmin SQL Dump
-- version 4.5.2
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Oct 02, 2016 at 01:58 PM
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
-- Table structure for table `ijp_employees_list`
--

DROP TABLE IF EXISTS `ijp_employees_list`;
CREATE TABLE IF NOT EXISTS `ijp_employees_list` (
  `eid` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `address` varchar(1000) NOT NULL,
  `email` varchar(255) NOT NULL,
  `emp_ref` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `user_role` enum('A','M','E','') NOT NULL,
  `image_path` varchar(500) NOT NULL,
  `cv_path` varchar(500) NOT NULL,
  `date_of_creation` datetime NOT NULL,
  `date_of_modification` datetime NOT NULL,
  PRIMARY KEY (`eid`),
  UNIQUE KEY `emp_ref` (`emp_ref`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ijp_employees_list`
--

INSERT INTO `ijp_employees_list` (`eid`, `name`, `address`, `email`, `emp_ref`, `password`, `user_role`, `image_path`, `cv_path`, `date_of_creation`, `date_of_modification`) VALUES
(1, 'test_admin', 'test_address', 'santhoshthoshthatipelli285@gmail.com', 'ijp_6969', '1234', 'A', '', '', '2016-09-22 00:00:00', '2016-09-22 00:00:00'),
(2, 'test_manager', 'test_man_address', 'santhoshthatipelli285@gmail.com', 'ijp_6970', '1234', 'M', '', '', '2016-09-22 00:00:00', '2016-09-15 00:00:00'),
(3, 'test_employee', 'test_emp_address', 'santhoshthatipelli285@gmail.com', 'ijp_6971', '1234', 'E', '', '', '2016-09-22 00:00:00', '2016-09-22 00:00:00'),
(4, 'test-regi', 'qwerty', 'santhoshthatipelli285@gmail.com', 'ijp_1234`', 'qwerty', 'M', 'C:\\wamp64\\www\\internal_job_portal\\application\\..\\upload\\user_images\\ijp_1234`_internal_job_portal.sql', 'C:\\wamp64\\www\\internal_job_portal\\application\\..\\upload\\user_cvs\\ijp_1234`_internal_job_portal.sql', '2016-09-26 23:02:19', '2016-09-26 23:02:19'),
(5, 'test', '12345', 'santhoshthatipelli285@gmail.com', 'ijp_1234', '12345', 'M', 'C:\\wamp64\\www\\internal_job_portal\\application\\..\\upload\\user_images\\ijp_1234_internal_job_portal.sql', 'C:\\wamp64\\www\\internal_job_portal\\application\\..\\upload\\user_cvs\\ijp_1234_internal_job_portal.sql', '2016-09-26 23:03:07', '2016-09-26 23:03:07'),
(6, 'santhosh', 'test', 'santhoshthatipelli285@gmail.com', '12345', 'test', 'M', 'C:\\wamp64\\www\\internal_job_portal\\application\\..\\upload\\user_images\\12345_internal_job_portal (2).sql', 'C:\\wamp64\\www\\internal_job_portal\\application\\..\\upload\\user_cvs\\12345_internal_job_portal.sql', '2016-09-27 21:57:37', '2016-09-27 21:57:37'),
(9, '12345', 'santhosh', 'santhoshthatipelli285@gmail.com', 'wertyu', 'santhos', 'M', 'C:\\wamp64\\www\\internal_job_portal\\application\\..\\upload\\user_images\\wertyu_ssc xerox.jpg', 'C:\\wamp64\\www\\internal_job_portal\\application\\..\\upload\\user_cvs\\wertyu_ssc xerox.jpg', '2016-09-27 21:59:57', '2016-09-27 21:59:57'),
(11, 'test', 'santhosh', 'santhoshthatipelli285@gmail.com', 'test4567', '1234', 'M', 'C:\\wamp64\\www\\internal_job_portal\\application\\..\\upload\\user_images\\test4567_ssc xerox.jpg', 'C:\\wamp64\\www\\internal_job_portal\\application\\..\\upload\\user_cvs\\test4567_ssc xerox.jpg', '2016-09-27 22:15:47', '2016-09-27 22:15:47'),
(14, 'test', 'santhosh', 'santhoshthatipelli285@gmail.com', 'test45677', 'santhosh', 'M', 'C:\\wamp64\\www\\internal_job_portal\\application\\..\\upload\\user_images\\test45677_ssc xerox.jpg', 'C:\\wamp64\\www\\internal_job_portal\\application\\..\\upload\\user_cvs\\test45677_ssc xerox.jpg', '2016-09-27 22:16:47', '2016-09-27 22:16:47'),
(17, 'test', 'santhosh', 'santhoshthatipelli285@gmail.com', 'test42343', 'santhosh', 'M', 'C:\\wamp64\\www\\internal_job_portal\\application\\..\\upload\\user_images\\test42343_ssc xerox.jpg', 'C:\\wamp64\\www\\internal_job_portal\\application\\..\\upload\\user_cvs\\test42343_ssc xerox.jpg', '2016-09-27 22:18:41', '2016-09-27 22:18:41');

-- --------------------------------------------------------

--
-- Table structure for table `ijp_employees_project_mapping`
--

DROP TABLE IF EXISTS `ijp_employees_project_mapping`;
CREATE TABLE IF NOT EXISTS `ijp_employees_project_mapping` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `project_id` int(11) NOT NULL,
  `eid` int(11) NOT NULL,
  `date_of_creation` datetime NOT NULL,
  `date_of_modification` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `eid` (`eid`),
  KEY `project_id` (`project_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ijp_employees_project_mapping`
--

INSERT INTO `ijp_employees_project_mapping` (`id`, `project_id`, `eid`, `date_of_creation`, `date_of_modification`) VALUES
(1, 1, 9, '2016-09-27 21:59:57', '2016-09-27 21:59:57'),
(2, 1, 11, '2016-09-27 22:15:47', '2016-09-27 22:15:47'),
(3, 1, 14, '2016-09-27 22:16:48', '2016-09-27 22:16:48'),
(4, 1, 17, '2016-09-27 22:18:41', '2016-09-27 22:18:41');

-- --------------------------------------------------------

--
-- Table structure for table `ijp_employee_cv_details`
--

DROP TABLE IF EXISTS `ijp_employee_cv_details`;
CREATE TABLE IF NOT EXISTS `ijp_employee_cv_details` (
  `cv_id` int(11) NOT NULL AUTO_INCREMENT,
  `eid` int(11) NOT NULL,
  `profile_pic_path` varchar(1000) NOT NULL,
  `cv_path` varchar(1000) NOT NULL,
  `date_of_creation` datetime NOT NULL,
  `date_of_modification` datetime NOT NULL,
  PRIMARY KEY (`cv_id`),
  KEY `eid` (`eid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `ijp_emp_manager_mapping`
--

DROP TABLE IF EXISTS `ijp_emp_manager_mapping`;
CREATE TABLE IF NOT EXISTS `ijp_emp_manager_mapping` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `eid` int(11) NOT NULL,
  `manager_id` int(11) NOT NULL,
  `date_of_creation` datetime NOT NULL,
  `date_of_modification` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `ijp_job_applied_emp_details`
--

DROP TABLE IF EXISTS `ijp_job_applied_emp_details`;
CREATE TABLE IF NOT EXISTS `ijp_job_applied_emp_details` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `eid` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `status` enum('A','D','P','V','R') NOT NULL,
  `date_of_creation` datetime NOT NULL,
  `date_of_modification` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ijp_job_applied_emp_details`
--

INSERT INTO `ijp_job_applied_emp_details` (`id`, `eid`, `post_id`, `status`, `date_of_creation`, `date_of_modification`) VALUES
(29, 3, 24, 'D', '2016-10-02 13:45:02', '2016-10-02 13:45:02'),
(30, 3, 22, 'D', '2016-10-02 13:50:45', '2016-10-02 13:50:45');

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
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ijp_job_posts`
--

INSERT INTO `ijp_job_posts` (`post_id`, `job_title`, `no_of_vacancies`, `job_description`, `job_skill_set`, `salary`, `experience`, `status`, `project_id`, `eid`, `posted_by`, `date_of_creation`, `date_of_modification`) VALUES
(1, '', 5, 'Hadoop developer', 'Map reduce,pig,java', '10lakh - 12lakh', '2yr - 5yr', 'A', 1, 1, 'A', '2016-09-23 09:22:24', '2016-09-23 00:00:00'),
(2, 'test', 12, 'Lead Automate testing', 'Selenium,Selenium,Selenium,Selenium', '100k - 200k', '3yr - 5yr', 'D', 2, 2, 'M', '2016-09-24 00:00:00', '2016-09-24 00:00:00'),
(3, '', 12, 'UI developer', 'HTML5,css3,NodeJs', '122000', '5yr', 'D', 1, 2, 'M', '2016-09-26 00:00:00', '2016-09-26 00:00:00'),
(4, '', 13, 'MySQL Admin', 'Replication,mysql ', '1234567', '10yr', 'D', 1, 2, 'M', '2016-09-26 00:00:00', '2016-09-26 00:00:00'),
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
(18, 'test', 2345, 'responsible for project management', NULL, '223445', '12', 'A', 2, 1, 'A', '2016-09-25 16:24:32', '2016-09-26 22:54:44'),
(19, 'test', 2345, 'for project managementtttttttttttttttttt', NULL, '223445', '12', 'D', 2, 1, 'A', '2016-09-25 16:24:58', '2016-09-25 16:38:57'),
(20, 'test-request', 12, 'test-request', 'Dallas Cowboys,Washington Redskins', '123345', '12', 'A', 2, 2, 'M', '2016-09-28 01:39:32', '2016-09-28 01:39:32'),
(21, '123456', 12, 'saaa', NULL, '1223', '12', 'D', 1, 2, 'M', '2016-09-28 02:04:18', '2016-09-28 02:04:18'),
(22, 'test', 12, 'test', 'Dallas Cowboys,Philadelphia Eagles', '12000', '12', 'A', 1, 1, 'A', '2016-09-28 22:58:46', '2016-09-28 22:58:46'),
(23, 'test-post', 12, 'testing', 'Dallas Cowboys', '120000', '12', 'P', 2, 2, 'M', '2016-09-28 23:02:11', '2016-09-28 23:02:11'),
(24, 'search engine optimization', 10, '123456', 'Dallas Cowboys,Washington Redskins', '1234', '12', 'A', 2, 2, 'M', '2016-10-01 02:56:37', '2016-10-01 02:56:37');

-- --------------------------------------------------------

--
-- Table structure for table `ijp_login_requests`
--

DROP TABLE IF EXISTS `ijp_login_requests`;
CREATE TABLE IF NOT EXISTS `ijp_login_requests` (
  `request_id` int(11) NOT NULL AUTO_INCREMENT,
  `eid` int(11) NOT NULL,
  `status` enum('P','A','D') NOT NULL,
  `mail_status` tinyint(4) NOT NULL DEFAULT '0',
  `date_of_creation` datetime NOT NULL,
  `date_of_modification` datetime NOT NULL,
  PRIMARY KEY (`request_id`),
  KEY `eid` (`eid`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ijp_login_requests`
--

INSERT INTO `ijp_login_requests` (`request_id`, `eid`, `status`, `mail_status`, `date_of_creation`, `date_of_modification`) VALUES
(1, 4, 'P', 0, '2016-09-26 23:02:20', '2016-09-26 23:02:20'),
(2, 5, 'P', 0, '2016-09-26 23:03:07', '2016-09-26 23:03:07'),
(3, 6, 'P', 0, '2016-09-27 21:57:37', '2016-09-27 21:57:37'),
(4, 9, 'D', 0, '2016-09-27 21:59:57', '2016-09-28 00:57:31'),
(5, 11, 'A', 0, '2016-09-27 22:15:47', '2016-09-28 00:50:56'),
(6, 14, 'A', 0, '2016-09-27 22:16:48', '2016-09-28 00:49:50'),
(7, 17, 'A', 0, '2016-09-27 22:18:41', '2016-09-28 00:49:21');

-- --------------------------------------------------------

--
-- Table structure for table `ijp_projects_list`
--

DROP TABLE IF EXISTS `ijp_projects_list`;
CREATE TABLE IF NOT EXISTS `ijp_projects_list` (
  `project_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(500) NOT NULL,
  `date_of_creation` datetime NOT NULL,
  `date_of_modification` datetime NOT NULL,
  PRIMARY KEY (`project_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ijp_projects_list`
--

INSERT INTO `ijp_projects_list` (`project_id`, `name`, `date_of_creation`, `date_of_modification`) VALUES
(1, 'Facebook Image Process', '2016-09-23 00:00:00', '2016-09-23 00:00:00'),
(2, 'Linked in file search', '2016-09-23 00:00:00', '2016-09-23 00:00:00');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `ijp_employees_project_mapping`
--
ALTER TABLE `ijp_employees_project_mapping`
  ADD CONSTRAINT `ijp_employees_project_mapping_ibfk_1` FOREIGN KEY (`project_id`) REFERENCES `ijp_projects_list` (`project_id`);

--
-- Constraints for table `ijp_job_posts`
--
ALTER TABLE `ijp_job_posts`
  ADD CONSTRAINT `ijp_job_posts_ibfk_1` FOREIGN KEY (`project_id`) REFERENCES `ijp_projects_list` (`project_id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
