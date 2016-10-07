-- phpMyAdmin SQL Dump
-- version 4.5.2
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Oct 07, 2016 at 11:20 PM
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
  `key_skills` text,
  `password` varchar(255) NOT NULL,
  `user_role` enum('A','M','E','') NOT NULL,
  `image_path` varchar(500) NOT NULL,
  `cv_path` varchar(500) NOT NULL,
  `date_of_creation` datetime NOT NULL,
  `date_of_modification` datetime NOT NULL,
  PRIMARY KEY (`eid`),
  UNIQUE KEY `emp_ref` (`emp_ref`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ijp_employees_list`
--

INSERT INTO `ijp_employees_list` (`eid`, `name`, `address`, `email`, `emp_ref`, `key_skills`, `password`, `user_role`, `image_path`, `cv_path`, `date_of_creation`, `date_of_modification`) VALUES
(1, 'test_admin', 'test_address', 'santhoshthoshthatipelli285@gmail.com', 'ijp_100', 'Objective C', '81dc9bdb52d04dc20036dbd8313ed055', 'A', '', '', '2016-09-22 00:00:00', '2016-10-08 04:24:45'),
(18, 'Test Manager', 'Street no:12', 'test@test.com', 'ijp_101', 'Objective C,C#,Derby', '81dc9bdb52d04dc20036dbd8313ed055', 'M', '\\upload\\user_images\\ijp_101_baby-boy-pics-22.jpg', '\\upload\\user_cvs\\ijp_101_4 chapter.pdf', '2016-10-08 04:19:24', '2016-10-08 04:19:24'),
(19, 'Test Manager 2', 'street no:12', 'test12@test.com', 'ijp_102', 'JSP,Apache', '81dc9bdb52d04dc20036dbd8313ed055', 'M', '\\upload\\user_images\\ijp_102_6c1f75d6b530c054242934137f4ef771.jpg', '\\upload\\user_cvs\\ijp_102_PrestaShop Installation Assistant.pdf', '2016-10-08 04:23:42', '2016-10-08 04:23:42'),
(20, 'Test Employee ', 'Street no:12', 'test3@test.com', 'ijp_103', 'Objective C,JavaScript,Bootstrap', '81dc9bdb52d04dc20036dbd8313ed055', 'E', '\\upload\\user_images\\ijp_103_164175-284x425-baby-boy.jpg', '\\upload\\user_cvs\\ijp_103_Rubik''s Cube 3x3 Solution Guide.pdf', '2016-10-08 04:28:46', '2016-10-08 04:28:46'),
(21, 'Test Employee', 'Street N0:1', 'tesst123@test.com', 'ijp_104', 'XML,Struts,Spark', '81dc9bdb52d04dc20036dbd8313ed055', 'E', '\\upload\\user_images\\ijp_104_6c1f75d6b530c054242934137f4ef771.jpg', '\\upload\\user_cvs\\ijp_104_PrestaShop Installation Assistant.pdf', '2016-10-08 04:33:07', '2016-10-08 04:33:07'),
(22, 'Test Employee - 2', 'Street No:123', 'test@test.com', 'ijp_105', 'JavaScript,Apache,Android', '81dc9bdb52d04dc20036dbd8313ed055', 'E', '\\upload\\user_images\\ijp_105_164175-284x425-baby-boy.jpg', '\\upload\\user_cvs\\ijp_105_Rubik''s Cube 3x3 Solution Guide.pdf', '2016-10-08 04:35:57', '2016-10-08 04:35:57');

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
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ijp_employees_project_mapping`
--

INSERT INTO `ijp_employees_project_mapping` (`id`, `project_id`, `eid`, `date_of_creation`, `date_of_modification`) VALUES
(5, 1, 18, '2016-10-08 04:19:24', '2016-10-08 04:19:24'),
(6, 2, 19, '2016-10-08 04:23:42', '2016-10-08 04:23:42'),
(7, 2, 20, '2016-10-08 04:28:46', '2016-10-08 04:28:46'),
(8, 2, 21, '2016-10-08 04:33:07', '2016-10-08 04:33:07'),
(9, 1, 22, '2016-10-08 04:35:57', '2016-10-08 04:35:57');

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
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ijp_emp_manager_mapping`
--

INSERT INTO `ijp_emp_manager_mapping` (`id`, `eid`, `manager_id`, `date_of_creation`, `date_of_modification`) VALUES
(1, 21, 19, '2016-10-08 04:33:07', '2016-10-08 04:33:07'),
(2, 22, 18, '2016-10-08 04:35:57', '2016-10-08 04:35:57');

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
) ENGINE=InnoDB AUTO_INCREMENT=41 DEFAULT CHARSET=utf8;

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
  `job_location` varchar(55) DEFAULT NULL,
  `last_date_for_applicants` datetime NOT NULL,
  `status` enum('P','A','D','') NOT NULL,
  `project_id` int(11) NOT NULL,
  `eid` int(11) NOT NULL,
  `posted_by` varchar(5) NOT NULL,
  `date_of_creation` datetime NOT NULL,
  `date_of_modification` datetime NOT NULL,
  PRIMARY KEY (`post_id`),
  KEY `manager_id` (`eid`),
  KEY `project_id` (`project_id`)
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ijp_job_posts`
--

INSERT INTO `ijp_job_posts` (`post_id`, `job_title`, `no_of_vacancies`, `job_description`, `job_skill_set`, `salary`, `experience`, `job_location`, `last_date_for_applicants`, `status`, `project_id`, `eid`, `posted_by`, `date_of_creation`, `date_of_modification`) VALUES
(31, 'Test Admin Post', 1, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry''s standard dummy text ever since the 1500s, when an unknown printer took a galley', 'JavaScript,Servlets,Spark', '12000', '3', 'San Francisco', '2016-10-31 04:38:55', 'A', 1, 1, 'A', '2016-10-08 04:41:53', '2016-10-08 04:41:53'),
(32, 'Test Manager Post', 3, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry''s standard dummy text ever since the 1500s, when an unknown printer took a galley', 'Objective C,Servlets,C#', '123456', '5', 'Chicago', '2016-10-08 04:42:46', 'P', 1, 18, 'M', '2016-10-08 04:44:09', '2016-10-08 04:44:09'),
(33, 'Test Manager Post -2', 1, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry''s standard dummy text ever since the 1500s, when an unknown printer took a galley', 'XML,Struts,AJAX', '123446', '2', 'Los Angeles', '2016-10-08 04:44:18', 'P', 1, 18, 'M', '2016-10-08 04:45:50', '2016-10-08 04:45:50');

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
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ijp_login_requests`
--

INSERT INTO `ijp_login_requests` (`request_id`, `eid`, `status`, `mail_status`, `date_of_creation`, `date_of_modification`) VALUES
(8, 18, 'A', 0, '2016-10-08 04:19:24', '2016-10-08 04:36:55'),
(9, 19, 'P', 0, '2016-10-08 04:23:42', '2016-10-08 04:36:38'),
(10, 20, 'P', 0, '2016-10-08 04:28:46', '2016-10-08 04:28:46'),
(11, 21, 'P', 0, '2016-10-08 04:33:07', '2016-10-08 04:33:07'),
(12, 22, 'A', 0, '2016-10-08 04:35:57', '2016-10-08 04:46:45');

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
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ijp_projects_list`
--

INSERT INTO `ijp_projects_list` (`project_id`, `name`, `date_of_creation`, `date_of_modification`) VALUES
(1, 'Facebook', '2016-09-23 00:00:00', '2016-09-23 00:00:00'),
(2, 'Linked In', '2016-09-23 00:00:00', '2016-09-23 00:00:00'),
(3, 'Twitter', '2016-10-08 00:00:00', '2016-10-08 00:00:00');

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
SET GLOBAL sql_mode = '';