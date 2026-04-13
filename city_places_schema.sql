USE `databaselesson`;

CREATE TABLE IF NOT EXISTS `city_places` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `place_name` varchar(120) NOT NULL,
  `district` varchar(80) NOT NULL,
  `category` varchar(60) NOT NULL,
  `ticket_price` decimal(10,2) NOT NULL DEFAULT 0.00,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `idx_city_places_district` (`district`),
  KEY `idx_city_places_category` (`category`)
)
ENGINE = MYISAM
CHARACTER SET utf8 COLLATE utf8_general_ci;

INSERT INTO `city_places` (`id`, `place_name`, `district`, `category`, `ticket_price`, `created_at`) VALUES
 (1, 'Parliament Visitor Center', 'District V', 'Museum', 12.00, NOW()),
 (2, 'River Promenade Tour', 'District XI', 'Tour', 9.50, NOW()),
 (3, 'City Art Hall', 'District VI', 'Gallery', 7.00, NOW()),
 (4, 'Castle Hill Walk', 'District I', 'Tour', 0.00, NOW()),
 (5, 'Central Market Hall', 'District IX', 'Market', 3.00, NOW())
ON DUPLICATE KEY UPDATE
 `place_name` = VALUES(`place_name`),
 `district` = VALUES(`district`),
 `category` = VALUES(`category`),
 `ticket_price` = VALUES(`ticket_price`);
