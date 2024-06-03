CREATE DATABASE hw1;
USE hw1;

CREATE TABLE piatti (
  id INTEGER PRIMARY KEY AUTO_INCREMENT,
  nome VARCHAR(255),
  img_url VARCHAR(255),
  tipologia VARCHAR(255),
  descrizione TEXT,
  prezzo VARCHAR(255)
) ENGINE=InnoDB;

CREATE TABLE preferiti (
  id INTEGER PRIMARY KEY AUTO_INCREMENT,
  username VARCHAR(16),
  piatto_id INTEGER,
  nome_piatto VARCHAR(255),
  img_url VARCHAR(255),
  descrizione TEXT,
  prezzo VARCHAR(255)
) ENGINE=InnoDB;

CREATE TABLE prenotazioni (
  id INTEGER PRIMARY KEY AUTO_INCREMENT,
  username VARCHAR(16),
  nome VARCHAR(255),
  cognome VARCHAR(255),
  data DATE,
  ora TIME,
  info TEXT
) ENGINE=InnoDB;

CREATE TABLE recensioni (
  id INTEGER PRIMARY KEY AUTO_INCREMENT,
  username VARCHAR(16),
  immagine VARCHAR(255),
  recensione TEXT,
  data DATE DEFAULT current_timestamp(),
  rating INTEGER
) ENGINE=InnoDB;

CREATE TABLE users (
  id INTEGER PRIMARY KEY AUTO_INCREMENT,
  immagine VARCHAR(255),
  username VARCHAR(16) UNIQUE,
  password VARCHAR(255),
  email VARCHAR(255) UNIQUE,
  name VARCHAR(255),
  surname VARCHAR(255)
) ENGINE=InnoDB;