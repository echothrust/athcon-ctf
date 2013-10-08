-- phpMyAdmin SQL Dump
-- version 3.4.3.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Apr 27, 2012 at 10:38 PM
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
-- Dumping data for table `hint`
--

INSERT INTO `hint` (`id`, `title`, `usertype`, `category`, `message`) VALUES
(1, 'Other participants are not part of the contest', 'both', 'rule', 'Dont abuse or attack administrators or hackers.'),
(2, 'Don''t abuse the systems you will monitor.', 'admin', 'rule', 'Keep in mind that as an administrator you have certain responsibilities. If you are found to abuse your own systems by fellow admins you will be disqualified.'),
(3, 'Play fare... its just for fun!', 'both', 'rule', 'Play fare,don''t try to cheat your way around the system, don''t mess with other participants (hackers/admins alike).'),
(4, 'Reports are your main source for points', 'admin', 'note', 'Use the <a href="http://athcon.ctf/report.php">report</a> to file an abuse report and get score points. Note however that only one report per attacker counts, although the system will not stop you from sending more than one. Extra reports reduce your score.'),
(5, 'You are not allowed to take part on the attacks', 'admin', 'rule', 'As an admin you are not supposed to attack the systems.'),
(6, 'Systems not part of the contest', 'hacker', 'rule', 'The systems athcon.ctf host along with the gateway system (all IP''s ending with .254) are not part of the CTF. '),
(7, 'No DoS attacks', 'hacker', 'rule', 'Don''t DoS the systems, if you need concurrency keep it into sane numbers.'),
(8, 'All your packets count', 'hacker', 'rule', 'The packets reaching the systems of the contest, count on your score. However keep in mind that only valid packets provide you with upwards scoring. This means that you need to be very careful of your approach to the systems you are about to attack.'),
(9, 'Admins have their tools', 'hacker', 'rule', 'Admins have their IDS and log monitoring tools but you have a wide range of IP spaces to play with. The following ranges will come handy when you get reported :)\r\n\r\n10.165.0.0/24\r\n10.166.0.0/24\r\n10.167.0.0/24\r\n10.168.0.0/24\r\n10.169.0.0/24\r\n10.170.0.0/24\r\n'),
(10, 'Don''t switch mac''s', 'hacker', 'rule', 'Administrators can''t see your mac through their tools (no mac address ever reaches admins). The only reason we need you to keep a "steady" mac is so that we can accredit you with points.\r\n'),
(11, 'Blacklisted IP''s stay this way', 'hacker', 'rule', 'Blacklisted IP''s will stay this way for the entire run of the CTF. It is left as exercise to you to "detect" this and switch.'),
(12, 'AcmeSec Systems', 'admin', 'note', 'The systems that will help you get the bad guys are <a href="http://ids.acmesec.fake/echofish">Echofish</a>, <a href="http://ids.acmesec.fake/base/">BASE</a>,<a href="http://ids.acmesec.fake:3000/">Snorby</a>.\r\n\r\nFurthermore, your account will also work on the following AcmeSec systems www.acmesec.fake, pbx.acmesec.fake, mail.acmesec.fake, lamp.acmesec.fake, oamp.acmesec.fake, solaris11.acmesec.fake.'),
(13, 'When you get reported, you get blocked', 'hacker', 'note', 'When you get reported (you should see the report appear into the above table), your ip gets blocked. In such a case you need to change your IP. '),
(14, 'You already have the first clue...', 'hacker', 'note', 'You got IP, <b>DNS</b> and Gateway, you may not realize it but the first clue is already in your grasp. Zone transfers are a go.'),
(15, 'There are achievements you have to claim your self', 'hacker', 'note', 'There are achievements which cannot be implemented automatically, but rather you have to claim them your self. Once you found a hidden "easter egg", follow the instructions and place the secret code into the <a href="claim.php" title="Manual Achievement Claim">claim script</a>.'),
(16, 'Easter eggs to claim your achievements', 'hacker', 'note', 'Special text files located in the services'' running-user home directory will be used to claim our special achievements. For example: within apache user''s homedir (e.g. /var/www) exists an easter_egg.txt file that contains a code which proves you gained elevated access to the web server. Same applies for all game achievements, so when you gain access somewhere take time to look around before moving on.'),
(17, 'Reset your Snorby password!!!', 'admin', 'note', 'The <a href="http://ids.acmesec.fake:3000/snorby">Snorby</a> installation requires that you reset your password first. Your login is the nickname you registered @acmesec.fake (ex test@acmesec.fake).\r\n\r\nYou can visit the <a href="http://www.acmesec.fake/webmail/">corporate webmail</a> to login with your registered credentials.'),
(18, 'Scoreboard', 'both', 'note', 'The scores that appear on this are not the only view. Visit the <a href="/scores.php" alt="Scores">Scores</a> page for a cleaner look.');

--
-- Dumping data for table `treasures`
--

INSERT INTO `treasures` (`id`, `name`, `description`, `points`, `category`, `csum`, `appears`, `effects`, `code`) VALUES
(1, 'Got reported by an administrator', 'An administrator got you red handed...', -50.00, 'hacker', '', 0, 'users_id', ''),
(2, 'Bullseye!', 'You just nailed down a hacker!', 100.00, 'admin', '', 0, 'users_id', ''),
(3, 'You just nailed an already nailed nail', 'Your abuse was valid but a fellow admin came first.', 25.00, 'admin', '', 0, 'users_id', ''),
(4, 'You broke into the web server', 'You managed to brake into the web.acmesec.fake as the user Apache is running.', 250.00, 'hacker', '', 1, 'users_id', 'eaede316df97fd11f0734ec067d99c00'),
(5, 'You broke into the root user of the MySQL on dbserv.acmesec.fake', 'You found the root password for the mysql Service on dbserv.acmesec.fake. \r\n\r\nKeep it up!!!', 500.00, 'hacker', '', 0, 'users_id', 'f8baaefe2c34d4af1d638bab4aec8a45'),
(7, 'You broke into root shell on dbserv.acmesec.fake', 'You broke into root shell on dbserv.acmesec.fake', 700.00, 'hacker', '', 0, 'users_id', '88087283be2ba672b865a3d6ef03a919'),
(8, 'You broke into the mailserver as admin', 'You gained administrative account access to AcmeSec''s corporate mailserver.', 500.00, 'hacker', '', 0, 'users_id', '706faa7355588993a022839546c190dc'),
(9, 'You broke into the mailserver as root', 'You gained root access on AcmeSec''s mailserver, now you control their emails.', 6666.00, 'hacker', '', 0, 'users_id', 'f1c110204367550045e99516a6c95d9e'),
(10, '/var/www/@pbx.acmesec.fake', '', 333.00, 'hacker', '', 0, 'users_id', 'd30dc4fc2adb6576de5a5f7195575ede'),
(11, '/root@pbx.acmesec.fake', '', 123213.00, 'hacker', '', 0, 'users_id', '00b0857cdc20e74814d130e1f32aaac4'),
(12, '/var/lib/asterisk@pbx.acmesec.fake', '', 12.00, 'hacker', '', 0, 'users_id', 'a9a63e0ea013a39e019bf3e095c241f6'),
(13, 'mailbox access to admin@acmesec.fake', 'mailbox access to admin@acmesec.fake', 150.00, 'hacker', '', 0, 'users_id', '06bc03678f58242291cf337c041820ea'),
(14, 'You discovered the http://www.acmesec.fake/webmail/', '', 100.00, 'hacker', '', 0, 'users_id', '2a5f3383363c37916992f7410bb82408'),
(15, 'You discovered the http://www.acmesec.fake/crm/', '', 100.00, 'hacker', '', 0, 'users_id', 'bcf2a18a7574afcabfa6b80e2d8b5ca6'),
(16, 'You discovered the http://www.acmesec.fake/fengoffice/', '', 100.00, 'hacker', '', 0, 'users_id', '448830c349aa0d789f4c61fa99f76fa1'),
(17, 'Close... but no cookies for you', 'You submitted an invalid report. Try better next time.', -50.00, 'admin', '', 0, 'users_id', ''),
(18, '/var/www/html/joomla@lamp.acmesec.fake', 'You found the joomla installation!', 0.00, 'hacker', '', 0, 'users_id', '4d7345b3bb70c94eba8064910edb9d5b'),
(19, '/var/www/html/phpBB@lamp.acmesec.fake', '', 0.00, 'hacker', '', 0, 'users_id', '3ad244e09b6cca4063884d8163f3a6c3'),
(20, '/var/www/html/phpcollab@lamp.acmesec.fake', 'You found the CMS installation!', 0.00, 'hacker', '', 0, 'users_id', '87c53bce2aa855cb9821477b51ecee76'),
(21, '/var/www/html/pixie@lamp.acmesec.fake', 'You found the Pixie installation', 0.00, 'hacker', '', 0, 'users_id', 'be2f4ecdb9342362c2459681fbd02828'),
(22, '/var/www/html/wordpress@lamp.acmesec.fake', 'You found the wordpress installation', 0.00, 'hacker', '', 0, 'users_id', 'd1a680a11018d059468595a6dd228ea8'),
(23, 'mysqlserver@lamp.acmesec.fake', 'You granted root privileges on lamp''s db', 0.00, 'hacker', '', 0, 'users_id', 'FIX ME-Create Egg'),
(24, '/root@oamp.acmsec.fake', 'You, root on oamp! ', 0.00, 'hacker', '', 0, 'users_id', '8d39b2f91aca6724f190926733a67158'),
(25, '/root@solaris11.acmsec.fake', 'You, root on LAB''s solaris ', 0.00, 'hacker', '', 0, 'users_id', '5becd7a2677003da0fc043840247419f'),
(26, 'mysqlserver@oamp.acmesec.fake', 'You granted root privileges on oamp''s myslq! Not an easy achievement!', 0.00, 'hacker', '', 0, 'users_id', 'FIX ME-Create Egg'),
(27, '/root@lamp.acmsec.fake', 'You, root on lamp!', 0.00, 'hacker', '', 0, 'users_id', '5fbc1b1620179f4af1b00f5fdf061fb5'),
(28, '/root@openhoneyd.acmesec.fake', 'You ate all the honey! Nothing but a jar now!', 0.00, 'hacker', '', 0, 'users_id', 'e00dfdd4c7e31736861dc71e5f096903'),
(29, 'You discovered the acmesec.fake zone key', 'You discovered the acmesec.fake zone key', 150.00, 'hacker', '', 0, 'users_id', '9fa56f398672e4720dfa806b4cf6e1fc'),
(30, 'NFS Share on freeNAS', '', 100.00, 'hacker', '', 0, 'users_id', '49bc86dbbe5eb02e7982f42c52cc158a'),
(31, 'SMB on FreeNAS Discovery', '', 123.00, 'hacker', '', 0, 'users_id', 'caea544a88b4cb2ebaac14a5b3a7a237'),
(32, 'Apple Share FreeNAS ', '', 12.00, 'hacker', '', 0, 'users_id', 'edc88ecd14fdbaba4f6dcb2cbdce8e20'),
(33, 'Hidden treasure on admins drupal page.', '', 0.00, 'hacker', '', 0, 'users_id', '2efa59bc32486f5ebd0d4812bfe2471d'),
(34, 'zencart@oamp.acmesec.fake admin page', 'You discovered the /acmesec directory within ZenCart (/var/ww/htdocs/zen-cart-v150-full-release-12302011/acmesec/easter_egg.txt)', 100.00, 'hacker', '', 0, 'users_id', 'FIX ME-Create File'),
(35, '/home/oracle/@orcl.acmesec.fake', '', 21.00, 'hacker', '', 0, 'users_id', 'FIXME');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
