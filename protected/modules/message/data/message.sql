CREATE TABLE `messages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sender_id` int(11) NOT NULL,
  `receiver_id` int(11) NOT NULL,
  `subject` varchar(256) NOT NULL DEFAULT '',
  `body` text,
  `is_read` enum('0','1') NOT NULL DEFAULT '0',
  `deleted_by` enum('sender','receiver') DEFAULT NULL,
  `created_at` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sender` (`sender_id`),
  KEY `receiver` (`receiver_id`),
  CONSTRAINT `sender` FOREIGN KEY (`sender_id`) REFERENCES `tbl_user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `receiver` FOREIGN KEY (`receiver_id`) REFERENCES `tbl_user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
