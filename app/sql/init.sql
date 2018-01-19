CREATE DATABASE nursinghome CHARACTER SET utf8 COLLATE utf8_general_ci;

USE nursinghome;

CREATE TABLE roles
(
    id INT UNSIGNED NOT NULL PRIMARY KEY,
    libelle VARCHAR(20)
);

CREATE TABLE persons
(
	id INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    email VARCHAR(255) NOT NULL,
	code VARCHAR(30) NOT NULL,
    lastname VARCHAR(30) NOT NULL,
    firstname VARCHAR(30) NOT NULL, 
    role INT UNSIGNED NOT NULL,
    CONSTRAINT roleconstraint FOREIGN KEY (role) REFERENCES roles(id) ON DELETE CASCADE
);

CREATE TABLE services
(
	id INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    floor INT(30) NOT NULL,
    name VARCHAR(30) NOT NULL
);

CREATE TABLE roomtypes
(
	id INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(30) NOT NULL
);

CREATE TABLE rooms
(
	id INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
	service_id INT UNSIGNED NOT NULL,
    type_id INT UNSIGNED  NOT NULL,
    name VARCHAR(30) NOT NULL,
    CONSTRAINT serviceconstraint FOREIGN KEY (service_id) REFERENCES services(id) ON DELETE CASCADE,
    CONSTRAINT typeconstraint FOREIGN KEY (type_id) REFERENCES roomtypes(id) ON DELETE CASCADE 
);


CREATE TABLE tasks
(
	id INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100),
    description VARCHAR(255)
);

CREATE TABLE executedtask
(
	id_person INT UNSIGNED NOT NULL ,
    id_room INT UNSIGNED NOT NULL ,
    expirationdate DATE NOT NULL ,
    did BOOLEAN NOT NULL, 
    id_task INT UNSIGNED NOT NULL ,
    PRIMARY KEY(id_person,id_room,id_task),
    CONSTRAINT persontask FOREIGN KEY (id_person) REFERENCES persons(id) ON DELETE CASCADE,
    CONSTRAINT roomtask FOREIGN KEY (id_room) REFERENCES rooms(id) ON DELETE CASCADE,
    CONSTRAINT task FOREIGN KEY (id_task) REFERENCES tasks(id) ON DELETE CASCADE
);

INSERT INTO tasks(name,description)
VALUES
('laver les vitres','blablablablabla');

INSERT INTO roles(id,libelle)
VALUES
(0,'cadre_sante'),
(1,'aide_soignante');

INSERT INTO persons(email,code,lastname,firstname,role)
VALUES
('assiya.hsaini@edu.esiee.fr','password','hsaini','assiya',0);

INSERT INTO services(floor,name)
VALUES
(0,'blabla');

INSERT INTO roomtypes(name)
VALUES
('salle_commune'),
('chambre');

INSERT INTO rooms(service_id,type_id)
VALUES
('salle_commune'),
('chambre');


