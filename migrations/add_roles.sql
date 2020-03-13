ALTER TABLE `accounts` ADD `role_id` INT NULL AFTER `user_id`;

CREATE TABLE roles (
    id int NOT NULL AUTO_INCREMENT PRIMARY KEY,
    role varchar(255) NOT NULL,
    description varchar(255)
);

INSERT INTO roles(role) VALUES("coach");
INSERT INTO roles(role) VALUES("athlete");