CREATE TABLE User(
    id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    user varchar(255) NOT NULL,
    password varchar(255) NOT NULL,
    type varchar(255) NOT NULL
);
create table Post (
    id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    content TEXT NOT NULL,
    datetime varchar(255) NOT NULL,
    user varchar(255) NOT NULL,
    userType varchar(255) NOT NULL
);

