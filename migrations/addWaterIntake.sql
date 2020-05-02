DROP TABLE IF EXISTS water_intake;

CREATE TABLE `water_intake` (
     `id` int(11) NOT NULL AUTO_INCREMENT,
     `user_id` int(11) NOT NULL,
     `cups` int(11) NOT NULL DEFAULT '0',
     `date` date NOT NULL,
     PRIMARY KEY (`id`)
);