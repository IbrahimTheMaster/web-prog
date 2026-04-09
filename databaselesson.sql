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
