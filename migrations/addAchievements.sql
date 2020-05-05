CREATE TABLE achievements (
    id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(100) NOT NULL ,
    user_id INT NOT NULL ,
    description VARCHAR(300),
    received_on DATE NOT NULL
);