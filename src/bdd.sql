DROP DATABASE IF EXISTS projetwebdevsemestre2;

CREATE DATABASE projetwebdevsemestre2;

CREATE TABLE products(
     EAN BIGINT(13) NOT NULL,
     name VARCHAR(255) NOT NULL,
     id_color INT NOT NULL,
     id_collection INT NOT NULL,
     seize TINYINT NOT NULL,
     quantity INT NOT NULL,
     unitPrice FLOAT NOT NULL,
     unitPriceDiscount FLOAT,
     PRIMARY KEY (EAN)
);

CREATE TABLE colors(
    id INT AUTO_INCREMENT NOT NULL,
    name VARCHAR(100) NOT NULL,
    PRIMARY KEY (id)
);

CREATE TABLE collection(
    id INT AUTO_INCREMENT NOT NULL,
    id_brand INT NOT NULL,
    PRIMARY KEY (id)
);

CREATE TABLE brands(
    id INT AUTO_INCREMENT NOT NULL,
    name VARCHAR(255) NOT NULL,
    PRIMARY KEY (id)
);

CREATE TABLE orders(
    id INT AUTO_INCREMENT NOT NULL,
    id_products VARCHAR(255) NOT NULL,
    quantities VARCHAR(255) NOT NULL,
    id_customer INT NOT NULL,
    status TINYINT NOT NULL,
    PRIMARY KEY (id)
);

CREATE TABLE users(
    id INT AUTO_INCREMENT NOT NULL,
    name VARCHAR(255) NOT NULL,
    surname VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    password TEXT NOT NULL,
    isAdmin BOOL,
    isEmploye BOOL,
    PRIMARY KEY (id)
);

CREATE TABLE about(
    general_terms LONGTEXT,
    timetable TEXT
);