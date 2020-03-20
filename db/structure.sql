-- phpMyAdmin SQL Dump
-- version 4.3.12
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Apr 30, 2016 at 02:04 PM
-- Server version: 5.6.23
-- PHP Version: 5.4.32

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `webframe`
--

-- --------------------------------------------------------

--
-- Table structure for table `mf_admin`
--

CREATE TABLE IF NOT EXISTS `mf_admin` (
  `id` smallint(5) NOT NULL,
  `username` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(192) COLLATE utf8_unicode_ci NOT NULL,
  `group` tinyint(2) NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '0',
  `is_delete` tinyint(1) NOT NULL DEFAULT '0',
  `created_date` datetime NOT NULL,
  `modified_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `mf_admin_access`
--

CREATE TABLE IF NOT EXISTS `mf_admin_access` (
  `id` int(10) NOT NULL,
  `controller` varchar(75) COLLATE utf8_unicode_ci NOT NULL,
  `method` varchar(75) COLLATE utf8_unicode_ci NOT NULL,
  `groups` varchar(100) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `mf_admin_group`
--

CREATE TABLE IF NOT EXISTS `mf_admin_group` (
  `id` tinyint(2) NOT NULL,
  `name` varchar(15) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `mf_admin_logs`
--

CREATE TABLE IF NOT EXISTS `mf_admin_logs` (
  `user_id` int(10) NOT NULL DEFAULT '0',
  `ip_address` varchar(45) NOT NULL DEFAULT '0',
  `controller` varchar(45) NOT NULL DEFAULT '0',
  `function` varchar(45) NOT NULL DEFAULT '0',
  `referrer` text,
  `browser` varchar(55) NOT NULL,
  `version` varchar(25) NOT NULL,
  `mobile` varchar(100) NOT NULL,
  `refid` varchar(155) NOT NULL,
  `raw_data` text,
  `created_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `mf_logs`
--

CREATE TABLE IF NOT EXISTS `mf_logs` (
  `user_id` int(10) NOT NULL DEFAULT '0',
  `session` varchar(32) NOT NULL,
  `ip_address` varchar(45) NOT NULL DEFAULT '0',
  `controller` varchar(45) NOT NULL DEFAULT '0',
  `function` varchar(45) NOT NULL DEFAULT '0',
  `referrer` text,
  `browser` varchar(55) NOT NULL,
  `version` varchar(25) NOT NULL,
  `mobile` varchar(100) NOT NULL,
  `refid` varchar(155) NOT NULL,
  `raw_data` text,
  `created_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `timestamp` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `mf_sessions`
--

CREATE TABLE IF NOT EXISTS `mf_sessions` (
  `id` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
  `ip_address` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `timestamp` bigint(20) NOT NULL DEFAULT '0',
  `data` text COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `mf_user`
--

CREATE TABLE IF NOT EXISTS `mf_user` (
  `id` int(11) NOT NULL,
  `uid` varchar(8) NOT NULL,
  `username` varchar(128) DEFAULT NULL,
  `fullname` varchar(128) DEFAULT NULL,
  `first_name` varchar(25) DEFAULT NULL,
  `last_name` varchar(55) DEFAULT NULL,
  `birthdate` date DEFAULT '0000-00-00',
  `gender` varchar(1) DEFAULT NULL,
  `email_provider` varchar(128) DEFAULT NULL,
  `email` varchar(128) DEFAULT NULL,
  `phone` varchar(25) DEFAULT NULL,
  `user_type` tinyint(1) NOT NULL DEFAULT '1' COMMENT '0 => kontestan, 1 => voter',
  `refid` varchar(155) NOT NULL,
  `created_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `is_block` tinyint(1) NOT NULL DEFAULT '0',
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `modified_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `alamat` varchar(155) DEFAULT NULL,
  `noid` varchar(45) DEFAULT NULL,
  `avatar` varchar(100) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `mf_user_auth`
--

CREATE TABLE IF NOT EXISTS `mf_user_auth` (
  `user_id` int(11) NOT NULL,
  `provider` varchar(35) NOT NULL,
  `provider_uid` varchar(64) NOT NULL,
  `token` varchar(512) NOT NULL COMMENT 'jika email, isinya adalah username',
  `secret` varchar(256) DEFAULT NULL,
  `primary` tinyint(1) NOT NULL DEFAULT '0',
  `confirm` tinyint(1) NOT NULL DEFAULT '0',
  `created_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `modified_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `mf_admin`
--
ALTER TABLE `mf_admin`
  ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `ADMIN_USERNAME` (`username`);

--
-- Indexes for table `mf_admin_access`
--
ALTER TABLE `mf_admin_access`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mf_admin_group`
--
ALTER TABLE `mf_admin_group`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mf_sessions`
--
ALTER TABLE `mf_sessions`
  ADD KEY `mf_sessions_timestamp` (`timestamp`);

--
-- Indexes for table `mf_user`
--
ALTER TABLE `mf_user`
  ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `UID` (`uid`);

--
-- Indexes for table `mf_user_auth`
--
ALTER TABLE `mf_user_auth`
  ADD UNIQUE KEY `USER_AUTH` (`provider`,`provider_uid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `mf_admin`
--
ALTER TABLE `mf_admin`
  MODIFY `id` smallint(5) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `mf_admin_access`
--
ALTER TABLE `mf_admin_access`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `mf_admin_group`
--
ALTER TABLE `mf_admin_group`
  MODIFY `id` tinyint(2) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `mf_user`
--
ALTER TABLE `mf_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
