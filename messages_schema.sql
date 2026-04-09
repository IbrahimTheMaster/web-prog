USE `databaselesson`;

CREATE TABLE IF NOT EXISTS `messages` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `sender_name` varchar(100) NOT NULL,
  `sender_email` varchar(120) NOT NULL,
  `subject` varchar(150) NOT NULL,
  `message_body` text NOT NULL,
  `user_id` int(10) unsigned DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `idx_messages_created_at` (`created_at`),
  KEY `idx_messages_user_id` (`user_id`)
)
ENGINE = MYISAM
CHARACTER SET utf8 COLLATE utf8_general_ci;
