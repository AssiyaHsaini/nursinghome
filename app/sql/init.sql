CREATE DATABASE nursinghome CHARACTER SET utf8 COLLATE utf8_general_ci;

USE nursinghome;

CREATE TABLE person
(
	id INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
	code VARCHAR(30) NOT NULL,
    lastname VARCHAR(30) NOT NULL,
    firstname VARCHAR(30) NOT NULL,
    role VARCHAR(30) NOT NULL,
    CONSTRAINT roleconstraint FOREIGN KEY (role) REFERENCES role(libelle)   
);

CREATE TABLE role
(
    id INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    libelle VARCHAR(20),
    date_creation DATETIME
);

CREATE TABLE room
(
	id INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
	service VARCHAR(30) NOT NULL,
    type VARCHAR(30) NOT NULL,
    CONSTRAINT serviceconstraint FOREIGN KEY (service) REFERENCES service(floor),
    CONSTRAINT typeconstraint FOREIGN KEY (type) REFERENCES roomtype(name)   
);

CREATE TABLE service
(
	id INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    floor INT(30)
);

CREATE TABLE roomtype
(
	id INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    name INT(30)
);
CREATE TABLE task
(
	id INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100),
    description VARCHAR(255)
);

CREATE TABLE executedtask
(
	id_person INT UNSIGNED NOT NULL ,
    id_room INT NOT NULL,
    expirationdate DATE NOT NULL,
    did BOOLEAN NOT NULL, 
    id_task INT UNSIGNED NOT NULL,
    CONSTRAINT persontask FOREIGN KEY (id_person) REFERENCES person(id),
    CONSTRAINT roomtask FOREIGN KEY (id_room) REFERENCES room(id)
    CONSTRAINT task FOREIGN KEY (id_task) REFERENCES task(id)
);



