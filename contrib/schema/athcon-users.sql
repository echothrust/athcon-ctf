-- phpMyAdmin SQL Dump
-- version 3.4.3.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Apr 25, 2012 at 10:49 AM
-- Server version: 5.1.54
-- PHP Version: 5.2.17

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `athcon`
--

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `nickname`, `team`, `category`, `passwd`, `mac`, `signature`, `total_packets`, `valid_packets`, `TS`) VALUES
(1, 'hacker1', 'teamA', 'hacker', '', '00:0c:29:a6:ff:15', '', 294, 294, '2012-04-22 15:19:08'),
(2, 'kokkinos-windows', 'kokkinos', 'hacker', 'kokkinos', 'e0:2a:82:fc:20:2d', 'mpetsos', 585356, 582038, '2012-04-24 15:52:23'),
(3, 'pantelis', 'pantelis', 'admin', '', '00:1f:3c:17:7d:ea', 'dakskdkas', 0, 0, '2012-04-19 20:30:18'),
(4, 'magas', 'kokkinos', 'hacker', '', '00:19:d2:1a:27:bf', '', 65593, 58942, '2012-04-22 19:24:44'),
(5, 'databus', 'r00thell', 'hacker', 'skata', '00:22:43:05:67:a3', '', 1021715, 1004413, '2012-04-24 18:49:54'),
(9, 'test-windows', 'test', 'hacker', 'test', '98:4b:e1:a6:80:80', '', 64877, 64877, '2012-04-24 16:03:41'),
(10, 'test-bt', 'test', 'hacker', 'test', '00:0c:29:73:3a:fb', '', 0, 0, '2012-04-23 21:57:32');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
