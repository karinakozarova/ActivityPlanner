DROP TABLE IF EXISTS water_goals;

CREATE TABLE `water_goals` (
     `id` int(11) NOT NULL AUTO_INCREMENT,
     `user_id` int(11) NOT NULL,
     `cups` int(11) NOT NULL,
     PRIMARY KEY (`id`)
)