DROP TABLE IF EXISTS `archive`;
CREATE TABLE IF NOT EXISTS `archive` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `host` bigint(20) unsigned NOT NULL,
  `facility` bigint(20) DEFAULT NULL,
  `priority` bigint(20) DEFAULT NULL,
  `level` bigint(20) DEFAULT NULL,
  `program` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `pid` bigint(20) DEFAULT NULL,
  `tag` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `msg` text COLLATE utf8_unicode_ci,
  `received_ts` datetime DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `host_index_idx` (`host`),
  KEY `facility_index_idx` (`facility`),
  KEY `level_index_idx` (`level`),
  KEY `program_index_idx` (`program`),
  KEY `msg_index_idx` (`msg`(255))
) ENGINE=FEDERATED  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci CONNECTION='mysql://athcon:athcon@172.16.11.50/echofish/archive';

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `nickname` varchar(255) COLLATE utf8_unicode_ci NOT NULL UNIQUE,
  `team` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `category` VARCHAR(10) NOT NULL DEFAULT 'admin',
  `passwd` VARCHAR(255) NOT NULL DEFAULT 'password',
  `mac` varchar(18) COLLATE utf8_unicode_ci NOT NULL UNIQUE,
  `signature` text  NOT NULL,
  `created` int default 0,
  `total_packets` BIGINT NOT NULL DEFAULT 0,
  `valid_packets` BIGINT NOT NULL DEFAULT 0,
  `invalidated_packets` BIGINT NOT NULL DEFAULT 0,
  TS TIMESTAMP
) ENGINE=FEDERATED  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci CONNECTION='mysql://athcon:athcon@172.16.11.50/athcon/users';