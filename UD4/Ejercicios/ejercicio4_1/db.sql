CREATE DATABASE IF NOT EXISTS musica;
USE musica;

CREATE TABLE IF NOT EXISTS banda(
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    num_integrantes DECIMAL(2,0) NOT NULL,
    genero VARCHAR(50) NOT NULL,
    nacionalidad VARCHAR (50)
);

CREATE TABLE disco(
    id INT AUTO_INCREMENT PRIMARY KEY,
    titulo VARCHAR(100) NOT NULL,
    anho DECIMAL(4,0) NOT NULL,
    id_banda INT NOT NULL,
    CONSTRAINT fk_disco_banda FOREIGN KEY (id_banda) REFERENCES banda(id)
        ON DELETE RESTRICT ON UPDATE CASCADE
);

CREATE TABLE pista(
    id_disco INT,
    numero DECIMAL(2,0),
    titulo VARCHAR(100) NOT NULL,
    duracion DECIMAL(4,0),
    PRIMARY KEY (id_disco, numero),
    CONSTRAINT fk_pista_disco FOREIGN KEY (id_disco) REFERENCES disco(id)
        ON DELETE RESTRICT ON UPDATE CASCADE
);