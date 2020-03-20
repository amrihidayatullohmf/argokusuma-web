-- phpMyAdmin SQL Dump
-- version 4.3.12
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Apr 30, 2016 at 02:05 PM
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

--
-- Dumping data for table `mf_admin`
--

INSERT INTO `mf_admin` (`id`, `username`, `password`, `group`, `is_active`, `is_delete`, `created_date`, `modified_date`) VALUES
(1, 'admin', 'e1c8fecaff0fe8ba3b700cdaca63a4a4e5426dffab75c5cb87601e256044d43c7fa4a9d396e567f7acc0683cb0a3b331fffe9b2cc82420ce631f50033efec7eee1c8fecaff0fe8ba3b700cdaca63a4a4e5426dffab75c5cb87601e256044d43c', 1, 1, 0, '2016-02-15 00:00:00', '2016-04-30 11:02:30'),
(2, 'fanani', '75ed9e390260be1805e6b51729b7fed0a24fe0741f7a7f574c60cc6c90a0784bbd7e2d5ac0bc4d22532ffc302a792970dcd7f11cb37ffd50e79a4910ca81c49175ed9e390260be1805e6b51729b7fed0a24fe0741f7a7f574c60cc6c90a0784b', 2, 0, 1, '2016-04-30 17:42:56', '2016-04-30 11:05:54'),
(3, 'editor', '6cadbe7425f779a2409f618345dac088ccf6ba32f44c551cc856a7fce23b7db1d384e30619a33c1d439e8667a60c3f96559621e2715f98e3efd173af29b605206cadbe7425f779a2409f618345dac088ccf6ba32f44c551cc856a7fce23b7db1', 3, 1, 0, '2016-04-30 20:57:12', '2016-04-30 13:57:33');

--
-- Dumping data for table `mf_admin_access`
--

INSERT INTO `mf_admin_access` (`id`, `controller`, `method`, `groups`) VALUES
(1, 'admin', 'index', '2'),
(2, 'admin', 'add', '2'),
(3, 'dashboard', 'index', '2,3'),
(4, 'admin', 'addprocess', '2'),
(5, 'admin', 'edit', '2'),
(6, 'admin', 'editprocess', '2'),
(7, 'admin', 'delete', '2');

--
-- Dumping data for table `mf_admin_group`
--

INSERT INTO `mf_admin_group` (`id`, `name`) VALUES
(1, 'super admin'),
(2, 'admin'),
(3, 'editor');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
