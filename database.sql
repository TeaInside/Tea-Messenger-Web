-- Adminer 4.3.1 MySQL dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

DROP TABLE IF EXISTS `groups_chat`;
CREATE TABLE `groups_chat` (
  `group_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `group_name` varchar(255) NOT NULL,
  `group_description` varchar(255) NOT NULL,
  `group_photo` varchar(255) NOT NULL,
  `creator` bigint(20) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`group_id`),
  KEY `group_name` (`group_name`),
  KEY `creator` (`creator`),
  CONSTRAINT `groups_chat_ibfk_2` FOREIGN KEY (`creator`) REFERENCES `users` (`user_id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


DROP TABLE IF EXISTS `group_admins`;
CREATE TABLE `group_admins` (
  `group_id` bigint(20) NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `can_restrict_member` tinyint(1) NOT NULL DEFAULT '1',
  `can_pin_message` tinyint(1) NOT NULL DEFAULT '1',
  `can_delete_message` tinyint(1) NOT NULL DEFAULT '1',
  `can_promote_member` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  KEY `group_id` (`group_id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `group_admins_ibfk_3` FOREIGN KEY (`group_id`) REFERENCES `groups_chat` (`group_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `group_admins_ibfk_4` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


DROP TABLE IF EXISTS `group_members`;
CREATE TABLE `group_members` (
  `group_id` bigint(20) NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `joined_at` datetime NOT NULL,
  KEY `group_id` (`group_id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `group_members_ibfk_3` FOREIGN KEY (`group_id`) REFERENCES `groups_chat` (`group_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `group_members_ibfk_4` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


DROP TABLE IF EXISTS `group_messages`;
CREATE TABLE `group_messages` (
  `message_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `group_id` bigint(20) NOT NULL,
  `user_id` bigint(20) DEFAULT NULL,
  `type` enum('text','photo') NOT NULL,
  `reply_to_message_id` bigint(20) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`message_id`),
  KEY `group_id` (`group_id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `group_messages_ibfk_3` FOREIGN KEY (`group_id`) REFERENCES `groups_chat` (`group_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `group_messages_ibfk_5` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


DROP TABLE IF EXISTS `private_messages`;
CREATE TABLE `private_messages` (
  `message_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `sender` bigint(20) DEFAULT NULL,
  `receiver` bigint(20) DEFAULT NULL,
  `type` enum('text','photo') NOT NULL,
  `is_read` tinyint(1) NOT NULL DEFAULT '0',
  `reply_to_message_id` bigint(20) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`message_id`),
  KEY `sender` (`sender`),
  KEY `receiver` (`receiver`),
  KEY `reply_to_message_id` (`reply_to_message_id`),
  CONSTRAINT `private_messages_ibfk_4` FOREIGN KEY (`sender`) REFERENCES `users` (`user_id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `private_messages_ibfk_5` FOREIGN KEY (`receiver`) REFERENCES `users` (`user_id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `private_messages_ibfk_7` FOREIGN KEY (`reply_to_message_id`) REFERENCES `private_messages` (`message_id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


DROP TABLE IF EXISTS `private_messages_data`;
CREATE TABLE `private_messages_data` (
  `message_id` bigint(20) NOT NULL,
  `text` text NOT NULL,
  `file` varchar(255) DEFAULT NULL,
  KEY `message_id` (`message_id`),
  CONSTRAINT `private_messages_data_ibfk_2` FOREIGN KEY (`message_id`) REFERENCES `private_messages` (`message_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


DROP TABLE IF EXISTS `sessions`;
CREATE TABLE `sessions` (
  `user_id` bigint(20) NOT NULL,
  `session_id` varchar(1024) NOT NULL,
  `key` varchar(1024) NOT NULL,
  `user_agent` varchar(255) DEFAULT NULL,
  `remote_addr` varchar(255) DEFAULT NULL,
  `expired_at` datetime NOT NULL,
  `created_at` datetime NOT NULL,
  KEY `user_id` (`user_id`),
  CONSTRAINT `sessions_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `user_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `verified` enum('true','false') NOT NULL DEFAULT 'false',
  `status` enum('banned','active') NOT NULL DEFAULT 'active',
  `registered_at` datetime NOT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


DROP TABLE IF EXISTS `users_info`;
CREATE TABLE `users_info` (
  `user_id` bigint(20) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) DEFAULT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `bio` bigint(20) DEFAULT NULL,
  KEY `user_id` (`user_id`),
  KEY `bio` (`bio`),
  CONSTRAINT `users_info_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`),
  CONSTRAINT `users_info_ibfk_2` FOREIGN KEY (`bio`) REFERENCES `users` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


DROP TABLE IF EXISTS `verification`;
CREATE TABLE `verification` (
  `user_id` bigint(20) NOT NULL,
  `token` varchar(255) NOT NULL,
  `expired_at` datetime NOT NULL,
  KEY `user_id` (`user_id`),
  CONSTRAINT `verification_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


-- 2017-12-30 07:49:23
