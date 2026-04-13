CREATE DATABASE `databaselesson`
CHARACTER SET utf8 COLLATE utf8_general_ci;

USE `databaselesson`;

CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `first_name` varchar(45) NOT NULL default '',
  `last_name` varchar(45) NOT NULL default '',
  `user_name` varchar(12) NOT NULL default '',
  `password` varchar(40) NOT NULL default '',
  PRIMARY KEY  (`id`)
)
ENGINE = MYISAM
CHARACTER SET utf8 COLLATE utf8_general_ci;

INSERT INTO `users` (`id`,`first_name`,`last_name`,`user_name`,`password`) VALUES 
 (1,'FirstName_1','LastName_1','Login1',sha1('login1')),
 (2,'FirstName_2','LastName_2','Login2',sha1('login2')),
 (3,'FirstName_3','LastName_3','Login3',sha1('login3')),
 (4,'FirstName_4','LastName_4','Login4',sha1('login4')),
 (5,'FirstName_5','LastName_5','Login5',sha1('login5')),
 (6,'FirstName_6','LastName_6','Login6',sha1('login6')),
 (7,'FirstName_7','LastName_7','Login7',sha1('login7')),
 (8,'FirstName_8','LastName_8','Login8',sha1('login8')),
 (9,'FirstName_9','LastName_9','Login9',sha1('login9')),
 (10,'FirstName_10','LastName_10','Login10',sha1('login10')),
 (11,'FirstName_11','LastName_11','Login11',sha1('login11')),
 (12,'FirstName_12','LastName_12','Login12',sha1('login12'));

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

CREATE TABLE IF NOT EXISTS `city_places` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `place_name` varchar(120) NOT NULL,
  `district` varchar(80) NOT NULL,
  `category` varchar(60) NOT NULL,
  `ticket_price` decimal(10,2) NOT NULL DEFAULT 0.00,
  PRIMARY KEY (`id`)
)
ENGINE = MYISAM
CHARACTER SET utf8 COLLATE utf8_general_ci;

INSERT INTO `city_places` (`id`, `place_name`, `district`, `category`, `ticket_price`) VALUES
 (1, 'Parliament Visitor Center', 'District V', 'Museum', 12.00),
 (2, 'River Promenade Tour', 'District XI', 'Tour', 9.50),
 (3, 'City Art Hall', 'District VI', 'Gallery', 7.00)
ON DUPLICATE KEY UPDATE
 `place_name` = VALUES(`place_name`),
 `district` = VALUES(`district`),
 `category` = VALUES(`category`),
 `ticket_price` = VALUES(`ticket_price`);

CREATE TABLE IF NOT EXISTS `image_uploads` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `file_name` varchar(190) NOT NULL,
  `uploaded_by` varchar(60) NOT NULL,
  `uploaded_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `idx_image_uploads_uploaded_at` (`uploaded_at`)
)
ENGINE = MYISAM
CHARACTER SET utf8 COLLATE utf8_general_ci;
