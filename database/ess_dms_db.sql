-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jun 05, 2024 at 11:38 AM
-- Server version: 10.4.10-MariaDB
-- PHP Version: 7.3.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ess_dms_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `album_list`
--

DROP TABLE IF EXISTS `album_list`;
CREATE TABLE IF NOT EXISTS `album_list` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` text NOT NULL,
  `user_id` int(30) NOT NULL,
  `delete_f` tinyint(1) NOT NULL DEFAULT 0,
  `date_created` datetime NOT NULL DEFAULT current_timestamp(),
  `date_updated` datetime DEFAULT NULL ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=55 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `album_list`
--

INSERT INTO `album_list` (`id`, `name`, `user_id`, `delete_f`, `date_created`, `date_updated`) VALUES
(53, 'ESS Daycare', 1, 0, '2024-06-02 23:09:38', NULL),
(54, 'ESS Developers', 1, 0, '2024-06-03 00:19:42', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `assignment_list`
--

DROP TABLE IF EXISTS `assignment_list`;
CREATE TABLE IF NOT EXISTS `assignment_list` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `child_id` int(11) NOT NULL,
  `caregiver_id` int(11) NOT NULL,
  `rooms_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `child_id` (`child_id`),
  KEY `caregiver_id` (`caregiver_id`),
  KEY `rooms_id` (`rooms_id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `assignment_list`
--

INSERT INTO `assignment_list` (`id`, `child_id`, `caregiver_id`, `rooms_id`) VALUES
(6, 5, 4, 3),
(7, 8, 4, 3);

-- --------------------------------------------------------

--
-- Table structure for table `babysitter_details`
--

DROP TABLE IF EXISTS `babysitter_details`;
CREATE TABLE IF NOT EXISTS `babysitter_details` (
  `babysitter_id` int(30) NOT NULL,
  `meta_field` text NOT NULL,
  `meta_value` text NOT NULL,
  KEY `babysitter_id` (`babysitter_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `babysitter_details`
--

INSERT INTO `babysitter_details` (`babysitter_id`, `meta_field`, `meta_value`) VALUES
(1, 'firstname', 'Temesgen'),
(1, 'middlename', 'asse'),
(1, 'lastname', 'shiferaw'),
(1, 'gender', 'Male'),
(1, 'email', 'temaau8@gmail.com'),
(1, 'contact', '0922556467'),
(1, 'address', 'addis abab'),
(1, 'skills', 'mnkebakeb'),
(1, 'years_experience', '3'),
(1, 'achievement', ''),
(1, 'other', ''),
(1, 'firstname', 'Temesgen'),
(1, 'middlename', 'asse'),
(1, 'lastname', 'shiferaw'),
(1, 'gender', 'Male'),
(1, 'email', 'temaau8@gmail.com'),
(1, 'contact', '0922556467'),
(1, 'address', 'addis abab'),
(1, 'skills', 'mnkebakeb'),
(1, 'years_experience', '3'),
(1, 'achievement', ''),
(1, 'other', ''),
(2, 'firstname', 'desta'),
(2, 'middlename', 'worash'),
(2, 'lastname', 'kasa'),
(2, 'gender', 'Female'),
(2, 'email', 'desta@gmail.com'),
(2, 'contact', '0922556467'),
(2, 'address', 'h'),
(2, 'skills', 'adsf'),
(2, 'years_experience', '3'),
(2, 'achievement', ''),
(2, 'other', ''),
(2, 'firstname', 'desta'),
(2, 'middlename', 'worash'),
(2, 'lastname', 'kasa'),
(2, 'gender', 'Female'),
(2, 'email', 'desta@gmail.com'),
(2, 'contact', '0922556467'),
(2, 'address', 'h'),
(2, 'skills', 'adsf'),
(2, 'years_experience', '3'),
(2, 'achievement', ''),
(2, 'other', ''),
(2, 'firstname', 'desta'),
(2, 'middlename', 'worash'),
(2, 'lastname', 'kasa'),
(2, 'gender', 'Female'),
(2, 'email', 'desta@gmail.com'),
(2, 'contact', '0922556467'),
(2, 'address', 'h'),
(2, 'skills', 'adsf'),
(2, 'years_experience', '3'),
(2, 'achievement', ''),
(2, 'other', ''),
(1, 'firstname', 'Temesgen'),
(1, 'middlename', 'asse'),
(1, 'lastname', 'shiferaw'),
(1, 'gender', 'Male'),
(1, 'email', 'temaau8@gmail.com'),
(1, 'contact', '0922556467'),
(1, 'address', 'addis abab'),
(1, 'skills', 'mnkebakeb'),
(1, 'years_experience', '3'),
(1, 'achievement', ''),
(1, 'other', ''),
(1, 'firstname', 'Temesgen'),
(1, 'middlename', 'asse'),
(1, 'lastname', 'shiferaw'),
(1, 'gender', 'Male'),
(1, 'email', 'temaau8@gmail.com'),
(1, 'contact', '0922556467'),
(1, 'address', 'addis abab'),
(1, 'skills', 'mnkebakeb'),
(1, 'years_experience', '3'),
(1, 'achievement', ''),
(1, 'other', ''),
(2, 'firstname', 'desta'),
(2, 'middlename', 'worash'),
(2, 'lastname', 'kasa'),
(2, 'gender', 'Female'),
(2, 'email', 'desta@gmail.com'),
(2, 'contact', '0922556467'),
(2, 'address', 'h'),
(2, 'skills', 'adsf'),
(2, 'years_experience', '3'),
(2, 'achievement', ''),
(2, 'other', ''),
(2, 'firstname', 'desta'),
(2, 'middlename', 'worash'),
(2, 'lastname', 'kasa'),
(2, 'gender', 'Female'),
(2, 'email', 'desta@gmail.com'),
(2, 'contact', '0922556467'),
(2, 'address', 'h'),
(2, 'skills', 'adsf'),
(2, 'years_experience', '3'),
(2, 'achievement', ''),
(2, 'other', ''),
(1, 'firstname', 'Temesgen'),
(1, 'middlename', 'asse'),
(1, 'lastname', 'shiferaw'),
(1, 'gender', 'Male'),
(1, 'email', 'temaau8@gmail.com'),
(1, 'contact', '0922556467'),
(1, 'address', 'addis abab'),
(1, 'skills', 'mnkebakeb'),
(1, 'years_experience', '3'),
(1, 'achievement', ''),
(1, 'other', ''),
(1, 'firstname', 'Temesgen'),
(1, 'middlename', 'asse'),
(1, 'lastname', 'shiferaw'),
(1, 'gender', 'Male'),
(1, 'email', 'temaau8@gmail.com'),
(1, 'contact', '0922556467'),
(1, 'address', 'addis abab'),
(1, 'skills', 'mnkebakeb'),
(1, 'years_experience', '3'),
(1, 'achievement', ''),
(1, 'other', ''),
(2, 'firstname', 'desta'),
(2, 'middlename', 'worash'),
(2, 'lastname', 'kasa'),
(2, 'gender', 'Female'),
(2, 'email', 'desta@gmail.com'),
(2, 'contact', '0922556467'),
(2, 'address', 'h'),
(2, 'skills', 'adsf'),
(2, 'years_experience', '3'),
(2, 'achievement', ''),
(2, 'other', ''),
(1, 'firstname', 'Temesgen'),
(1, 'middlename', 'asse'),
(1, 'lastname', 'shiferaw'),
(1, 'gender', 'Male'),
(1, 'email', 'temaau8@gmail.com'),
(1, 'contact', '0922556467'),
(1, 'address', 'addis abab'),
(1, 'skills', 'mnkebakeb'),
(1, 'years_experience', '3'),
(1, 'achievement', ''),
(1, 'other', ''),
(2, 'firstname', 'desta'),
(2, 'middlename', 'worash'),
(2, 'lastname', 'kasa'),
(2, 'gender', 'Female'),
(2, 'email', 'desta@gmail.com'),
(2, 'contact', '0922556467'),
(2, 'address', 'h'),
(2, 'skills', 'adsf'),
(2, 'years_experience', '3'),
(2, 'achievement', ''),
(2, 'other', ''),
(1, 'firstname', 'Temesgen'),
(1, 'middlename', 'asse'),
(1, 'lastname', 'shiferaw'),
(1, 'gender', 'Male'),
(1, 'email', 'temaau8@gmail.com'),
(1, 'contact', '0922556467'),
(1, 'address', 'addis abab'),
(1, 'skills', 'mnkebakeb'),
(1, 'years_experience', '3'),
(1, 'achievement', ''),
(1, 'other', ''),
(2, 'firstname', 'desta'),
(2, 'middlename', 'worash'),
(2, 'lastname', 'kasa'),
(2, 'gender', 'Female'),
(2, 'email', 'desta@gmail.com'),
(2, 'contact', '0922556467'),
(2, 'address', 'h'),
(2, 'skills', 'adsf'),
(2, 'years_experience', '3'),
(2, 'achievement', ''),
(2, 'other', ''),
(1, 'firstname', 'Temesgen'),
(1, 'middlename', 'asse'),
(1, 'lastname', 'shiferaw'),
(1, 'gender', 'Male'),
(1, 'email', 'temaau8@gmail.com'),
(1, 'contact', '0922556467'),
(1, 'address', 'addis abab'),
(1, 'skills', 'mnkebakeb'),
(1, 'years_experience', '3'),
(1, 'achievement', ''),
(1, 'other', ''),
(1, 'firstname', 'Temesgen'),
(1, 'middlename', 'asse'),
(1, 'lastname', 'shiferaw'),
(1, 'gender', 'Male'),
(1, 'email', 'temaau8@gmail.com'),
(1, 'contact', '0922556467'),
(1, 'address', 'addis abab'),
(1, 'skills', 'mnkebakeb'),
(1, 'years_experience', '3'),
(1, 'achievement', ''),
(1, 'other', ''),
(1, 'firstname', 'Temesgen'),
(1, 'middlename', 'asse'),
(1, 'lastname', 'shiferaw'),
(1, 'gender', 'Male'),
(1, 'email', 'temaau8@gmail.com'),
(1, 'contact', '0922556467'),
(1, 'address', 'addis abab'),
(1, 'skills', 'mnkebakeb'),
(1, 'years_experience', '3'),
(1, 'achievement', ''),
(1, 'other', ''),
(1, 'firstname', 'Temesgen'),
(1, 'middlename', 'asse'),
(1, 'lastname', 'shiferaw'),
(1, 'gender', 'Male'),
(1, 'email', 'temaau8@gmail.com'),
(1, 'contact', '0922556467'),
(1, 'address', 'addis abab'),
(1, 'skills', 'mnkebakeb'),
(1, 'years_experience', '3'),
(1, 'achievement', ''),
(1, 'other', ''),
(1, 'firstname', 'Temesgen'),
(1, 'middlename', 'asse'),
(1, 'lastname', 'shiferaw'),
(1, 'gender', 'Male'),
(1, 'email', 'temaau8@gmail.com'),
(1, 'contact', '0922556467'),
(1, 'address', 'addis abab'),
(1, 'skills', 'mnkebakeb'),
(1, 'years_experience', '3'),
(1, 'achievement', ''),
(1, 'other', ''),
(1, 'firstname', 'Temesgen'),
(1, 'middlename', 'asse'),
(1, 'lastname', 'shiferaw'),
(1, 'gender', 'Male'),
(1, 'email', 'temaau8@gmail.com'),
(1, 'contact', '0922556467'),
(1, 'address', 'addis abab'),
(1, 'skills', 'mnkebakeb'),
(1, 'years_experience', '3'),
(1, 'achievement', ''),
(1, 'other', ''),
(2, 'firstname', 'desta'),
(2, 'middlename', 'worash'),
(2, 'lastname', 'kasa'),
(2, 'gender', 'Female'),
(2, 'email', 'desta@gmail.com'),
(2, 'contact', '0922556467'),
(2, 'address', 'h'),
(2, 'skills', 'adsf'),
(2, 'years_experience', '3'),
(2, 'achievement', ''),
(2, 'other', ''),
(2, 'firstname', 'desta'),
(2, 'middlename', 'worash'),
(2, 'lastname', 'kasa'),
(2, 'gender', 'Female'),
(2, 'email', 'desta@gmail.com'),
(2, 'contact', '0922556467'),
(2, 'address', 'h'),
(2, 'skills', 'adsf'),
(2, 'years_experience', '3'),
(2, 'achievement', ''),
(2, 'other', ''),
(1, 'firstname', 'Temesgen'),
(1, 'middlename', 'asse'),
(1, 'lastname', 'shiferaw'),
(1, 'gender', 'Male'),
(1, 'email', 'temaau8@gmail.com'),
(1, 'contact', '0922556467'),
(1, 'address', 'addis abab'),
(1, 'skills', 'mnkebakeb'),
(1, 'years_experience', '3'),
(1, 'achievement', ''),
(1, 'other', ''),
(1, 'firstname', 'Temesgen'),
(1, 'middlename', 'asse'),
(1, 'lastname', 'shiferaw'),
(1, 'gender', 'Male'),
(1, 'email', 'temaau8@gmail.com'),
(1, 'contact', '0922556467'),
(1, 'address', 'addis abab'),
(1, 'skills', 'mnkebakeb'),
(1, 'years_experience', '3'),
(1, 'achievement', ''),
(1, 'other', ''),
(1, 'firstname', 'Temesgen'),
(1, 'middlename', 'asse'),
(1, 'lastname', 'shiferaw'),
(1, 'gender', 'Male'),
(1, 'email', 'temaau8@gmail.com'),
(1, 'contact', '0922556467'),
(1, 'address', 'addis abab'),
(1, 'skills', 'mnkebakeb'),
(1, 'years_experience', '3'),
(1, 'achievement', ''),
(1, 'other', ''),
(2, 'firstname', 'desta'),
(2, 'middlename', 'worash'),
(2, 'lastname', 'kasa'),
(2, 'gender', 'Female'),
(2, 'email', 'desta@gmail.com'),
(2, 'contact', '0922556467'),
(2, 'address', 'h'),
(2, 'skills', 'adsf'),
(2, 'years_experience', '3'),
(2, 'achievement', ''),
(2, 'other', ''),
(1, 'firstname', 'Temesgen'),
(1, 'middlename', 'asse'),
(1, 'lastname', 'shiferaw'),
(1, 'gender', 'Male'),
(1, 'email', 'temaau8@gmail.com'),
(1, 'contact', '0922556467'),
(1, 'address', 'addis abab'),
(1, 'skills', 'mnkebakeb'),
(1, 'years_experience', '3'),
(1, 'achievement', ''),
(1, 'other', ''),
(1, 'firstname', 'Temesgen'),
(1, 'middlename', 'asse'),
(1, 'lastname', 'shiferaw'),
(1, 'gender', 'Male'),
(1, 'email', 'temaau8@gmail.com'),
(1, 'contact', '0922556467'),
(1, 'address', 'addis abab'),
(1, 'skills', 'mnkebakeb'),
(1, 'years_experience', '3'),
(1, 'achievement', ''),
(1, 'other', ''),
(2, 'firstname', 'desta'),
(2, 'middlename', 'worash'),
(2, 'lastname', 'kasa'),
(2, 'gender', 'Female'),
(2, 'email', 'desta@gmail.com'),
(2, 'contact', '0922556467'),
(2, 'address', 'h'),
(2, 'skills', 'adsf'),
(2, 'years_experience', '3'),
(2, 'achievement', ''),
(2, 'other', ''),
(1, 'firstname', 'Temesgen'),
(1, 'middlename', 'asse'),
(1, 'lastname', 'shiferaw'),
(1, 'gender', 'Male'),
(1, 'email', 'temaau8@gmail.com'),
(1, 'contact', '0922556467'),
(1, 'address', 'addis abab'),
(1, 'skills', 'mnkebakeb'),
(1, 'years_experience', '3'),
(1, 'achievement', ''),
(1, 'other', ''),
(1, 'firstname', 'Temesgen'),
(1, 'middlename', 'asse'),
(1, 'lastname', 'shiferaw'),
(1, 'gender', 'Male'),
(1, 'email', 'temaau8@gmail.com'),
(1, 'contact', '0922556467'),
(1, 'address', 'addis abab'),
(1, 'skills', 'mnkebakeb'),
(1, 'years_experience', '3'),
(1, 'achievement', ''),
(1, 'other', ''),
(1, 'firstname', 'Temesgen'),
(1, 'middlename', 'asse'),
(1, 'lastname', 'shiferaw'),
(1, 'gender', 'Male'),
(1, 'email', 'temaau8@gmail.com'),
(1, 'contact', '0922556467'),
(1, 'address', 'addis abab'),
(1, 'skills', 'mnkebakeb'),
(1, 'years_experience', '3'),
(1, 'achievement', ''),
(1, 'other', ''),
(1, 'firstname', 'Temesgen'),
(1, 'middlename', 'asse'),
(1, 'lastname', 'shiferaw'),
(1, 'gender', 'Male'),
(1, 'email', 'temaau8@gmail.com'),
(1, 'contact', '0922556467'),
(1, 'address', 'addis abab'),
(1, 'skills', 'mnkebakeb'),
(1, 'years_experience', '3'),
(1, 'achievement', ''),
(1, 'other', ''),
(2, 'firstname', 'desta'),
(2, 'middlename', 'worash'),
(2, 'lastname', 'kasa'),
(2, 'gender', 'Female'),
(2, 'email', 'desta@gmail.com'),
(2, 'contact', '0922556467'),
(2, 'address', 'h'),
(2, 'skills', 'adsf'),
(2, 'years_experience', '3'),
(2, 'achievement', ''),
(2, 'other', ''),
(1, 'firstname', 'Temesgen'),
(1, 'middlename', 'asse'),
(1, 'lastname', 'shiferaw'),
(1, 'gender', 'Male'),
(1, 'email', 'temaau8@gmail.com'),
(1, 'contact', '0922556467'),
(1, 'address', 'addis abab'),
(1, 'skills', 'mnkebakeb'),
(1, 'years_experience', '3'),
(1, 'achievement', ''),
(1, 'other', ''),
(1, 'firstname', 'Temesgen'),
(1, 'middlename', 'asse'),
(1, 'lastname', 'shiferaw'),
(1, 'gender', 'Male'),
(1, 'email', 'temaau8@gmail.com'),
(1, 'contact', '0922556467'),
(1, 'address', 'addis abab'),
(1, 'skills', 'mnkebakeb'),
(1, 'years_experience', '3'),
(1, 'achievement', ''),
(1, 'other', ''),
(1, 'firstname', 'Temesgen'),
(1, 'middlename', 'asse'),
(1, 'lastname', 'shiferaw'),
(1, 'gender', 'Male'),
(1, 'email', 'temaau8@gmail.com'),
(1, 'contact', '0922556467'),
(1, 'address', 'addis abab'),
(1, 'skills', 'mnkebakeb'),
(1, 'years_experience', '3'),
(1, 'achievement', ''),
(1, 'other', ''),
(1, 'firstname', 'Temesgen'),
(1, 'middlename', 'asse'),
(1, 'lastname', 'shiferaw'),
(1, 'gender', 'Male'),
(1, 'email', 'temaau8@gmail.com'),
(1, 'contact', '0922556467'),
(1, 'address', 'addis abab'),
(1, 'skills', 'mnkebakeb'),
(1, 'years_experience', '3'),
(1, 'achievement', ''),
(1, 'other', ''),
(1, 'firstname', 'Temesgen'),
(1, 'middlename', 'asse'),
(1, 'lastname', 'shiferaw'),
(1, 'gender', 'Male'),
(1, 'email', 'temaau8@gmail.com'),
(1, 'contact', '0922556467'),
(1, 'address', 'addis abab'),
(1, 'skills', 'mnkebakeb'),
(1, 'years_experience', '3'),
(1, 'achievement', ''),
(1, 'other', ''),
(1, 'firstname', 'Temesgen'),
(1, 'middlename', 'asse'),
(1, 'lastname', 'shiferaw'),
(1, 'gender', 'Male'),
(1, 'email', 'temaau8@gmail.com'),
(1, 'contact', '0922556467'),
(1, 'address', 'addis abab'),
(1, 'skills', 'mnkebakeb'),
(1, 'years_experience', '3'),
(1, 'achievement', ''),
(1, 'other', ''),
(1, 'firstname', 'Temesgen'),
(1, 'middlename', 'asse'),
(1, 'lastname', 'shiferaw'),
(1, 'gender', 'Male'),
(1, 'email', 'temaau8@gmail.com'),
(1, 'contact', '0922556467'),
(1, 'address', 'addis abab'),
(1, 'skills', 'mnkebakeb'),
(1, 'years_experience', '3'),
(1, 'achievement', ''),
(1, 'other', ''),
(1, 'firstname', 'Temesgen'),
(1, 'middlename', 'asse'),
(1, 'lastname', 'shiferaw'),
(1, 'gender', 'Male'),
(1, 'email', 'temaau8@gmail.com'),
(1, 'contact', '0922556467'),
(1, 'address', 'addis abab'),
(1, 'skills', 'mnkebakeb'),
(1, 'years_experience', '3'),
(1, 'achievement', ''),
(1, 'other', ''),
(1, 'firstname', 'Temesgen'),
(1, 'middlename', 'asse'),
(1, 'lastname', 'shiferaw'),
(1, 'gender', 'Male'),
(1, 'email', 'temaau8@gmail.com'),
(1, 'contact', '0922556467'),
(1, 'address', 'addis abab'),
(1, 'skills', 'mnkebakeb'),
(1, 'years_experience', '3'),
(1, 'achievement', ''),
(1, 'other', ''),
(1, 'firstname', 'Temesgen'),
(1, 'middlename', 'asse'),
(1, 'lastname', 'shiferaw'),
(1, 'gender', 'Male'),
(1, 'email', 'temaau8@gmail.com'),
(1, 'contact', '0922556467'),
(1, 'address', 'addis abab'),
(1, 'skills', 'mnkebakeb'),
(1, 'years_experience', '3'),
(1, 'achievement', ''),
(1, 'other', ''),
(1, 'firstname', 'Temesgen'),
(1, 'middlename', 'asse'),
(1, 'lastname', 'shiferaw'),
(1, 'gender', 'Male'),
(1, 'email', 'temaau8@gmail.com'),
(1, 'contact', '0922556467'),
(1, 'address', 'addis abab'),
(1, 'skills', 'mnkebakeb'),
(1, 'years_experience', '3'),
(1, 'achievement', ''),
(1, 'other', ''),
(1, 'firstname', 'Temesgen'),
(1, 'middlename', 'asse'),
(1, 'lastname', 'shiferaw'),
(1, 'gender', 'Male'),
(1, 'email', 'temaau8@gmail.com'),
(1, 'contact', '0922556467'),
(1, 'address', 'addis abab'),
(1, 'skills', 'mnkebakeb'),
(1, 'years_experience', '3'),
(1, 'achievement', ''),
(1, 'other', ''),
(2, 'firstname', 'desta'),
(2, 'middlename', 'worash'),
(2, 'lastname', 'kasa'),
(2, 'gender', 'Female'),
(2, 'email', 'desta@gmail.com'),
(2, 'contact', '0922556467'),
(2, 'address', 'h'),
(2, 'skills', 'adsf'),
(2, 'years_experience', '3'),
(2, 'achievement', ''),
(2, 'other', ''),
(1, 'firstname', 'Temesgen'),
(1, 'middlename', 'asse'),
(1, 'lastname', 'shiferaw'),
(1, 'gender', 'Male'),
(1, 'email', 'temaau8@gmail.com'),
(1, 'contact', '0922556467'),
(1, 'address', 'addis abab'),
(1, 'skills', 'mnkebakeb'),
(1, 'years_experience', '3'),
(1, 'achievement', ''),
(1, 'other', ''),
(1, 'firstname', 'Temesgen'),
(1, 'middlename', 'asse'),
(1, 'lastname', 'shiferaw'),
(1, 'gender', 'Male'),
(1, 'email', 'temaau8@gmail.com'),
(1, 'contact', '0922556467'),
(1, 'address', 'addis abab'),
(1, 'skills', 'mnkebakeb'),
(1, 'years_experience', '3'),
(1, 'achievement', ''),
(1, 'other', ''),
(2, 'firstname', 'desta'),
(2, 'middlename', 'worash'),
(2, 'lastname', 'kasa'),
(2, 'gender', 'Female'),
(2, 'email', 'desta@gmail.com'),
(2, 'contact', '0922556467'),
(2, 'address', 'h'),
(2, 'skills', 'adsf'),
(2, 'years_experience', '3'),
(2, 'achievement', ''),
(2, 'other', '');

-- --------------------------------------------------------

--
-- Table structure for table `babysitter_list`
--

DROP TABLE IF EXISTS `babysitter_list`;
CREATE TABLE IF NOT EXISTS `babysitter_list` (
  `id` int(30) NOT NULL AUTO_INCREMENT,
  `code` varchar(50) NOT NULL DEFAULT '50',
  `fullname` text NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `date_created` datetime NOT NULL DEFAULT current_timestamp(),
  `date_updated` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `bs_image` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `babysitter_list`
--

INSERT INTO `babysitter_list` (`id`, `code`, `fullname`, `status`, `date_created`, `date_updated`, `bs_image`) VALUES
(1, 'BS-2024050001', 'Temesgen asse shiferaw', 1, '2024-05-17 05:55:31', '2024-06-04 07:17:16', 'uploads/babysitters/babysitter-1.png?v=1717510636'),
(2, 'BS-2024050002', 'desta worash kasa', 1, '2024-05-17 05:56:35', '2024-06-04 07:17:32', 'uploads/babysitters/babysitter-2.png?v=1717510652');

-- --------------------------------------------------------

--
-- Table structure for table `child_meals`
--

DROP TABLE IF EXISTS `child_meals`;
CREATE TABLE IF NOT EXISTS `child_meals` (
  `meal_id` int(11) NOT NULL AUTO_INCREMENT,
  `child_id` int(11) NOT NULL,
  `parent_id` int(11) NOT NULL,
  `meal_type` varchar(50) NOT NULL,
  `meal_date` varchar(30) NOT NULL,
  `food_items` varchar(50) NOT NULL,
  `note` text DEFAULT NULL,
  `description` text NOT NULL,
  `meal_time` varchar(30) NOT NULL,
  PRIMARY KEY (`meal_id`),
  KEY `child_id` (`child_id`),
  KEY `parent_id` (`parent_id`)
) ENGINE=InnoDB AUTO_INCREMENT=53 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `child_meals`
--

INSERT INTO `child_meals` (`meal_id`, `child_id`, `parent_id`, `meal_type`, `meal_date`, `food_items`, `note`, `description`, `meal_time`) VALUES
(52, 5, 6, 'Break Fast', '2024-05-29', 'burger', 'make it yammy', ' hg', '04:03');

-- --------------------------------------------------------

--
-- Table structure for table `enrollment_details`
--

DROP TABLE IF EXISTS `enrollment_details`;
CREATE TABLE IF NOT EXISTS `enrollment_details` (
  `enrollment_id` int(30) NOT NULL,
  `meta_field` text NOT NULL,
  `meta_value` text NOT NULL,
  KEY `enrollment_id` (`enrollment_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `enrollment_details`
--

INSERT INTO `enrollment_details` (`enrollment_id`, `meta_field`, `meta_value`) VALUES
(5, 'parent_id', '6'),
(5, 'child_firstname', 'maramawit sister'),
(5, 'child_middlename', 'melaku'),
(5, 'child_lastname', 'kasa'),
(5, 'gender', 'Male'),
(5, 'allergy', 'no'),
(5, 'child_dob', '2024-05-29'),
(5, 'allergy_description', ''),
(5, 'parent_firstname', 'malaku'),
(5, 'parent_middlename', 'kasa'),
(5, 'parent_lastname', 'kasa'),
(5, 'parent_contact', '0922556467'),
(5, 'parent_email', 'temaau8@gmail.com'),
(5, 'department', 'it'),
(5, 'address', 'awer'),
(5, 'child_fullname', 'maramawit sister melaku kasa'),
(5, 'parent_fullname', 'malaku kasa kasa'),
(5, 'BCfile', ''),
(5, 'VCfile', ''),
(8, 'parent_id', '8'),
(8, 'child_firstname', 'Helen'),
(8, 'child_middlename', 'Wondeson'),
(8, 'child_lastname', 'Assefa'),
(8, 'gender', 'Male'),
(8, 'allergy', 'yes'),
(8, 'child_dob', '2024-06-04'),
(8, 'allergy_description', 'she has alergy when she eat checkolet'),
(8, 'parent_firstname', 'wondeson'),
(8, 'parent_middlename', 'assefa'),
(8, 'parent_lastname', 'GF'),
(8, 'parent_contact', '0922556467'),
(8, 'parent_email', 'temaau8@gmail.com'),
(8, 'department', 'it'),
(8, 'address', ''),
(8, 'child_fullname', 'Helen Wondeson Assefa'),
(8, 'parent_fullname', 'wondeson assefa GF'),
(8, 'BCfile', 'instructions_for_use.pdf'),
(8, 'VCfile', '');

-- --------------------------------------------------------

--
-- Table structure for table `enrollment_list`
--

DROP TABLE IF EXISTS `enrollment_list`;
CREATE TABLE IF NOT EXISTS `enrollment_list` (
  `id` int(30) NOT NULL AUTO_INCREMENT,
  `code` varchar(50) NOT NULL,
  `child_fullname` text NOT NULL,
  `parent_fullname` text NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0,
  `date_created` datetime NOT NULL DEFAULT current_timestamp(),
  `date_updated` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `parent_id` int(11) NOT NULL,
  `astatus` tinyint(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`),
  KEY `parent_id` (`parent_id`),
  KEY `parent_id_2` (`parent_id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `enrollment_list`
--

INSERT INTO `enrollment_list` (`id`, `code`, `child_fullname`, `parent_fullname`, `status`, `date_created`, `date_updated`, `parent_id`, `astatus`) VALUES
(5, 'GDR-2024050001', 'maramawit sister melaku kasa', 'malaku kasa kasa', 1, '2024-05-29 02:03:23', '2024-06-04 23:25:32', 6, 0),
(8, 'ZLX-2024060001', 'Helen Wondeson Assefa', 'wondeson assefa GF', 1, '2024-06-04 23:24:35', '2024-06-04 23:25:21', 8, 0);

-- --------------------------------------------------------

--
-- Table structure for table `health_list`
--

DROP TABLE IF EXISTS `health_list`;
CREATE TABLE IF NOT EXISTS `health_list` (
  `health_id` int(11) NOT NULL AUTO_INCREMENT,
  `caregiver_id` int(11) NOT NULL,
  `child_id` int(11) NOT NULL,
  `date_of_recorded` varchar(10) NOT NULL,
  `iliness` varchar(50) NOT NULL,
  `symptoms` varchar(50) NOT NULL,
  `temperature` int(11) NOT NULL,
  `weight_of_child` int(11) NOT NULL,
  `parent_id` int(11) NOT NULL,
  `description` text NOT NULL,
  PRIMARY KEY (`health_id`),
  KEY `child_id` (`child_id`),
  KEY `caregiver_id` (`caregiver_id`),
  KEY `parent_id` (`parent_id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `health_list`
--

INSERT INTO `health_list` (`health_id`, `caregiver_id`, `child_id`, `date_of_recorded`, `iliness`, `symptoms`, `temperature`, `weight_of_child`, `parent_id`, `description`) VALUES
(7, 4, 5, '2024-05-29', 'headk', 'high feber', 45, 15, 6, '   she was ');

-- --------------------------------------------------------

--
-- Table structure for table `images`
--

DROP TABLE IF EXISTS `images`;
CREATE TABLE IF NOT EXISTS `images` (
  `id` int(30) NOT NULL AUTO_INCREMENT,
  `album_id` int(30) NOT NULL,
  `original_name` text NOT NULL,
  `path_name` text NOT NULL,
  `delete_f` tinyint(1) NOT NULL DEFAULT 0,
  `user_id` int(30) NOT NULL,
  `date_created` datetime NOT NULL DEFAULT current_timestamp(),
  `date_updated` datetime DEFAULT NULL ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=179 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `images`
--

INSERT INTO `images` (`id`, `album_id`, `original_name`, `path_name`, `delete_f`, `user_id`, `date_created`, `date_updated`) VALUES
(171, 53, 'Room.jpg', 'uploads/user_1/album_53/1717396920.jpg', 0, 1, '2024-06-02 23:42:01', '2024-06-03 01:36:15'),
(172, 53, 'room.jpg', 'uploads/user_1/album_53/1717396920_1.jpg', 0, 1, '2024-06-02 23:42:01', '2024-06-03 01:35:48'),
(173, 53, 'Room.jpg', 'uploads/user_1/album_53/1717396920_2.jpg', 0, 1, '2024-06-02 23:42:01', '2024-06-03 01:35:33'),
(174, 54, 'photo_2024-06-03_00-22-35.jpg', 'uploads/user_1/album_54/1717399320.jpg', 0, 1, '2024-06-03 00:22:55', NULL),
(175, 54, 'photo_2024-06-03_00-22-31.jpg', 'uploads/user_1/album_54/1717399320_1.jpg', 0, 1, '2024-06-03 00:22:55', NULL),
(176, 54, 'photo_2024-06-03_00-22-27.jpg', 'uploads/user_1/album_54/1717399320_2.jpg', 0, 1, '2024-06-03 00:22:55', NULL),
(177, 54, 'photo_2024-06-03_00-22-22.jpg', 'uploads/user_1/album_54/1717399320_3.jpg', 0, 1, '2024-06-03 00:22:55', NULL),
(178, 54, 'photo_2024-06-03_00-22-12.jpg', 'uploads/user_1/album_54/1717399320_4.jpg', 0, 1, '2024-06-03 00:22:55', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

DROP TABLE IF EXISTS `messages`;
CREATE TABLE IF NOT EXISTS `messages` (
  `msg_id` int(11) NOT NULL AUTO_INCREMENT,
  `incoming_msg_id` int(255) NOT NULL,
  `outgoing_msg_id` int(255) NOT NULL,
  `msg` varchar(1000) NOT NULL,
  PRIMARY KEY (`msg_id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`msg_id`, `incoming_msg_id`, `outgoing_msg_id`, `msg`) VALUES
(6, 1164773732, 909843110, 'zds'),
(7, 1164773732, 909843110, 'hi temesgen'),
(9, 1164773732, 1010797590, 'hgfgh'),
(10, 1010797590, 1164773732, 'hjghg'),
(11, 1010797590, 1437699571, 'asfsd'),
(12, 915380658, 1437699571, 'hi'),
(13, 1437699571, 915380658, 'hi'),
(14, 1010797590, 909843110, 'hgf'),
(15, 1010797590, 1164773732, 'fhfgh'),
(16, 1010797590, 915380658, 'hi'),
(17, 909843110, 1010797590, 'hi'),
(18, 1010797590, 1164773732, 'dkfjkdffd');

-- --------------------------------------------------------

--
-- Table structure for table `rooms`
--

DROP TABLE IF EXISTS `rooms`;
CREATE TABLE IF NOT EXISTS `rooms` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `rooms_name` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `rooms`
--

INSERT INTO `rooms` (`id`, `rooms_name`) VALUES
(3, 'room '),
(4, 'room two');

-- --------------------------------------------------------

--
-- Table structure for table `service_list`
--

DROP TABLE IF EXISTS `service_list`;
CREATE TABLE IF NOT EXISTS `service_list` (
  `id` int(30) NOT NULL AUTO_INCREMENT,
  `name` text NOT NULL,
  `description` text NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `date_created` datetime NOT NULL DEFAULT current_timestamp(),
  `date_updated` datetime DEFAULT NULL ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `service_list`
--

INSERT INTO `service_list` (`id`, `name`, `description`, `status`, `date_created`, `date_updated`) VALUES
(1, ' Exciting News! ESS Organization Is Opening a Daycare Soon! ', '&lt;p style=&quot;text-align: justify; &quot;&gt;&lt;b style=&quot;font-family: &amp;quot;Comic Sans MS&amp;quot;; font-size: 18px; color: rgb(0, 0, 0);&quot;&gt;&lt;i&gt;&lt;span style=&quot;font-family: &amp;quot;Times New Roman&amp;quot;; font-size: 18px;&quot;&gt;Dear Parents and Guardians,&amp;nbsp;&lt;/span&gt;&lt;/i&gt;&lt;/b&gt;&lt;/p&gt;&lt;p style=&quot;text-align: justify; &quot;&gt;&lt;span style=&quot;color: rgb(0, 0, 0); font-family: &amp;quot;Times New Roman&amp;quot;; font-size: 18px;&quot;&gt;we are thrilled to share some wonderful news with all of you! After much anticipation and careful planning, we are excited to announce that ESS Organization will be opening its very own daycare facility in the near future! As an organization deeply committed to providing comprehensive support to our community, we understand the importance of reliable childcare services. We have listened attentively to the needs and concerns of our parents, and we are delighted to take this significant step forward in addressing them.&lt;/span&gt;&lt;/p&gt;', 1, '2021-12-14 10:02:00', '2024-06-04 23:08:36');

-- --------------------------------------------------------

--
-- Table structure for table `system_info`
--

DROP TABLE IF EXISTS `system_info`;
CREATE TABLE IF NOT EXISTS `system_info` (
  `id` int(30) NOT NULL AUTO_INCREMENT,
  `meta_field` text NOT NULL,
  `meta_value` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `system_info`
--

INSERT INTO `system_info` (`id`, `meta_field`, `meta_value`) VALUES
(1, 'name', 'ESS DayCare Management System'),
(6, 'short_name', 'ESS-DMS'),
(11, 'logo', 'uploads/logo-1717394771.png'),
(13, 'user_avatar', 'uploads/user_avatar.jpg'),
(14, 'cover', 'uploads/cover-1717398455.png'),
(15, 'content', 'Array'),
(16, 'email', 'ess@gmail.com.com'),
(17, 'contact', '+251(011)111-7787 '),
(18, 'from_time', '11:00'),
(19, 'to_time', '21:30'),
(20, 'address', 'General Wingate Street.\r\nAddis Ababa, Ethiopia ');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_attendance`
--

DROP TABLE IF EXISTS `tbl_attendance`;
CREATE TABLE IF NOT EXISTS `tbl_attendance` (
  `attendance_id` int(11) NOT NULL AUTO_INCREMENT,
  `child_id` int(11) NOT NULL,
  `attendance_status` enum('Present','Absent') NOT NULL,
  `attendance_date` date NOT NULL,
  `caregiver_id` int(11) NOT NULL,
  `parent_id` int(11) NOT NULL,
  PRIMARY KEY (`attendance_id`),
  KEY `child_id` (`child_id`),
  KEY `caregiver_id` (`caregiver_id`),
  KEY `tbl_attendance_ibfk_3` (`parent_id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_attendance`
--

INSERT INTO `tbl_attendance` (`attendance_id`, `child_id`, `attendance_status`, `attendance_date`, `caregiver_id`, `parent_id`) VALUES
(8, 5, 'Present', '2024-05-29', 4, 6),
(9, 5, 'Present', '2024-06-03', 4, 6),
(10, 5, 'Absent', '2024-06-04', 4, 6);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(50) NOT NULL AUTO_INCREMENT,
  `unique_id` int(255) NOT NULL,
  `firstname` varchar(250) NOT NULL,
  `middlename` text DEFAULT NULL,
  `lastname` varchar(250) NOT NULL,
  `username` text NOT NULL,
  `password` text NOT NULL,
  `avatar` text DEFAULT NULL,
  `last_login` datetime DEFAULT NULL,
  `type` tinyint(1) NOT NULL DEFAULT 0,
  `status` int(1) NOT NULL DEFAULT 1 COMMENT '0=not verified, 1 = verified',
  `date_added` datetime NOT NULL DEFAULT current_timestamp(),
  `date_updated` datetime DEFAULT NULL ON UPDATE current_timestamp(),
  `status1` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `unique_id`, `firstname`, `middlename`, `lastname`, `username`, `password`, `avatar`, `last_login`, `type`, `status`, `date_added`, `date_updated`, `status1`) VALUES
(1, 909843110, 'Adminstrator', NULL, 'Admin', 'admin', '0192023a7bbd73250516f069df18b500', 'uploads/avatar-1.png?v=1717510735', NULL, 1, 1, '2021-01-20 14:02:37', '2024-06-04 23:26:54', 'Offline now'),
(3, 915380658, 'desta', NULL, 'worash', 'desta', 'b2e7247ec64e0f7840538698b5146ab8', 'uploads/avatar-3.png?v=1717412451', NULL, 2, 1, '2021-12-14 15:46:25', '2024-06-03 04:00:51', 'Offline now'),
(4, 1164773732, 'temesgen', NULL, 'assefa', 'tem', '1ba857050fb952f2cf6ae7c55468ba62', 'uploads/avatar-4.png?v=1717510699', NULL, 2, 1, '2024-05-01 14:28:08', '2024-06-04 23:52:04', 'Active now'),
(5, 1437699571, 'super ', NULL, 'administrator', 'super administrator', '19664760e63ec2aaf9c49fd237283e17', 'uploads/avatar-5.png?v=1717510781', NULL, 0, 1, '2024-05-12 01:53:09', '2024-06-04 07:20:30', 'Offline now'),
(6, 323501968, 'malaku ', NULL, 'kasa', 'melaku', 'ffa0eddc7f349bde8b539b289ef2b04f', 'uploads/avatar-6.png?v=1717412472', NULL, 3, 1, '2024-05-16 01:45:00', '2024-06-03 05:21:01', 'Offline now'),
(7, 1622860273, 'sintayehu', NULL, 'sintayehu', 'sintayehu', 'fb12585fa3a30b618fb0a1c5685946da', 'uploads/avatar-7.png?v=1717510684', NULL, 3, 1, '2024-05-20 00:18:49', '2024-06-04 07:18:04', 'Offline now'),
(8, 1010797590, 'Wonde', NULL, 'Assefa', 'wonde', '6fcdca4df8a2340ab3effed0dbc01941', 'uploads/avatar-8.png?v=1717510722', NULL, 3, 1, '2024-05-26 08:28:34', '2024-06-04 23:25:04', 'Offline now');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `assignment_list`
--
ALTER TABLE `assignment_list`
  ADD CONSTRAINT `assignment_list_ibfk_1` FOREIGN KEY (`child_id`) REFERENCES `enrollment_list` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `assignment_list_ibfk_2` FOREIGN KEY (`caregiver_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `assignment_list_ibfk_3` FOREIGN KEY (`rooms_id`) REFERENCES `rooms` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `babysitter_details`
--
ALTER TABLE `babysitter_details`
  ADD CONSTRAINT `babysitter_details_ibfk_1` FOREIGN KEY (`babysitter_id`) REFERENCES `babysitter_list` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `child_meals`
--
ALTER TABLE `child_meals`
  ADD CONSTRAINT `child_meals_ibfk_1` FOREIGN KEY (`child_id`) REFERENCES `enrollment_list` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `child_meals_ibfk_2` FOREIGN KEY (`parent_id`) REFERENCES `enrollment_list` (`parent_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `enrollment_details`
--
ALTER TABLE `enrollment_details`
  ADD CONSTRAINT `enrollment_details_ibfk_1` FOREIGN KEY (`enrollment_id`) REFERENCES `enrollment_list` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `enrollment_list`
--
ALTER TABLE `enrollment_list`
  ADD CONSTRAINT `enrollment_list_ibfk_1` FOREIGN KEY (`parent_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `health_list`
--
ALTER TABLE `health_list`
  ADD CONSTRAINT `health_list_ibfk_1` FOREIGN KEY (`child_id`) REFERENCES `enrollment_list` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `health_list_ibfk_2` FOREIGN KEY (`caregiver_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `health_list_ibfk_3` FOREIGN KEY (`parent_id`) REFERENCES `enrollment_list` (`parent_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tbl_attendance`
--
ALTER TABLE `tbl_attendance`
  ADD CONSTRAINT `tbl_attendance_ibfk_1` FOREIGN KEY (`child_id`) REFERENCES `enrollment_list` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tbl_attendance_ibfk_2` FOREIGN KEY (`caregiver_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tbl_attendance_ibfk_3` FOREIGN KEY (`parent_id`) REFERENCES `enrollment_list` (`parent_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
