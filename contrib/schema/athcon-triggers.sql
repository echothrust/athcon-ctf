-- phpMyAdmin SQL Dump
-- version 3.3.9.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Apr 11, 2012 at 01:17 AM
-- Server version: 5.1.54
-- PHP Version: 5.2.17

SET FOREIGN_KEY_CHECKS=0;
SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;


DROP TRIGGER IF EXISTS `populate_arpdat`;


DELIMITER //
CREATE TRIGGER `populate_arpdat` AFTER INSERT ON `tcpdump`
 FOR EACH ROW BEGIN
  REPLACE INTO arpdat (mac,ip) values (NEW.srchw,NEW.srcip);
  UPDATE users SET total_packets=total_packets+1,traffic=traffic+NEW.size WHERE mac=NEW.srchw AND category='hacker';
  IF NEW.dstip IN (inet_aton('172.0.0.2'), inet_aton('172.0.0.3'),inet_aton('172.0.0.4'),inet_aton('172.0.0.5'),inet_aton('192.0.0.2'), inet_aton('192.0.0.3'),inet_aton('192.0.0.4'),inet_aton('192.0.0.5'),inet_aton('192.0.0.6'),inet_aton('192.0.0.60'))	THEN
	UPDATE users SET valid_packets=valid_packets+1 WHERE mac=NEW.srchw AND category='hacker';
  END IF;
END












//

DELIMITER ;


SET FOREIGN_KEY_CHECKS=1;
