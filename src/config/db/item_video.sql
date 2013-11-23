CREATE TABLE `SITE_DB`.`item_video` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `item_id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `description` text,
  `video` varchar(5) NOT NULL DEFAULT '',
  `thumbnail` varchar(5) NOT NULL DEFAULT '',
  `screendump` varchar(5) NOT NULL DEFAULT '',
  `poster` varchar(5) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`),
  KEY `item_id` (`item_id`),
  CONSTRAINT `item_video_ibfk_1` FOREIGN KEY (`item_id`) REFERENCES `items` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;