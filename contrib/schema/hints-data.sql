-- phpMyAdmin SQL Dump
-- version 3.3.9.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Apr 19, 2012 at 04:04 PM
-- Server version: 5.1.54
-- PHP Version: 5.2.17

SET FOREIGN_KEY_CHECKS=0;
SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `athcon`
--

--
-- Dumping data for table `hint`
--

INSERT INTO `hint` (`id`, `title`, `usertype`, `category`, `message`) VALUES
(1, 'Other participants are not part of the contest', 'both', 'rule', 'Dont abuse or attack administrators or hackers.'),
(2, 'Don''t abuse the systems you will monitor.', 'admin', 'rule', 'Keep in mind that as an administrator you have certain responsibilities. If you are found to abuse your own systems by fellow admins you will be disqualified.'),
(3, 'Play fare... its just for fun!', 'both', 'rule', 'Play fare,don''t try to cheat your way around the system, don''t mess with other participants (hackers/admins alike).'),
(4, 'Reports are your main source for points', 'admin', 'rule', 'Use the <a href="http://athcon.ctf/report.php">report</a> to file an abuse report and get score points. Note however that only one report per attacker counts, although the system will not stop you from sending more than one. Extra reports reduce your score.'),
(5, 'You are not allowed to take part on the attacks', 'admin', 'rule', 'As an admin you are not supposed to attack the systems.'),
(6, 'Systems not part of the contest', 'hacker', 'rule', 'The systems athcon.ctf host along with the gateway system (all IP''s ending with .254) are not part of the CTF. '),
(7, 'No DoS attacks', 'hacker', 'rule', 'Don''t DoS the systems, if you need concurrency keep it into sane numbers.'),
(8, 'All your packets count', 'hacker', 'rule', 'The packets reaching the systems of the contest, count on your score. However keep in mind that only valid packets provide you with upwards scoring. This means that you need to be very careful of your approach to the systems you are about to attack.'),
(9, 'Admins have their tools', 'hacker', 'rule', 'Admins have their IDS and log monitoring tools but you have a wide range of IP spaces to play with. The following ranges will come handy when you get reported :)\r\n\r\n10.165.0.0/24\r\n10.166.0.0/24\r\n10.167.0.0/24\r\n10.168.0.0/24\r\n10.169.0.0/24\r\n10.170.0.0/24\r\n'),
(10, 'Don''t switch mac''s', 'hacker', 'rule', 'Administrators can''t see your mac through their tools (no mac address ever reaches admins). The only reason we need you to keep a "steady" mac is so that we can accredit you with points.\r\n'),
(11, 'Blacklisted IP''s stay this way', 'hacker', 'rule', 'Blacklisted IP''s will stay this way for the entire run of the CTF. It is left as exercise to you to "detect" this and switch.'),
(12, 'AcmeSec Systems', 'admin', 'note', 'The systems that will help you get the bad guys are <a href="http://ids.acmesec.fake/echofish">Echofish</a>, <a href="http://ids.acmesec.fake/base/">BASE</a>,<a href="http://ids.acmesec.fake:3000/">Snorby</a>.\r\n\r\nFurthermore, your account will also work on the following AcmeSec systems www.acmesec.fake, pbx.acmesec.fake, mail.acmesec.fake, lamp.acmesec.fake, oamp.acmesec.fake, solaris11.acmesec.fake.');
SET FOREIGN_KEY_CHECKS=1;
