DROP DATABASE IF EXISTS domotica;
CREATE DATABASE domotica;
USE domotica;

CREATE TABLE casa(
    id INT AUTO_INCREMENT PRIMARY KEY,
    descripcion VARCHAR(100) NOT NULL
);

CREATE TABLE sensor(
    mac CHAR(17) PRIMARY KEY,
    localizacion VARCHAR(50) NOT NULL,
    casa_id INT NOT NULL,
    CONSTRAINT fk_sensor_casa FOREIGN KEY (casa_id) REFERENCES casa(id)
);

CREATE TABLE usuario(
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(50) NOT NULL,
    apellido1 VARCHAR(50) NOT NULL,
    apellido2 VARCHAR(50), 
    email VARCHAR(256) NOT NULL UNIQUE,
    password CHAR(255) NOT NULL,
    casa_id INT NOT NULL,
    CONSTRAINT fk_usuario_casa FOREIGN KEY (casa_id) REFERENCES casa(id)
);

CREATE TABLE alerta(
    id INT AUTO_INCREMENT PRIMARY KEY,
    sensor_mac CHAR(17) NOT NULL,
    tiempo TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    CONSTRAINT fk_alerta_sensor FOREIGN KEY(sensor_mac) REFERENCES sensor(mac)
);

-- DATOS DE PRUEBA
INSERT INTO casa (descripcion) VALUES
('Casa familiar en el centro'),
('Chalet en las afueras');

INSERT INTO sensor (mac, localizacion, casa_id) VALUES
('AA:BB:CC:DD:EE:01', 'Salón', 1),
('AA:BB:CC:DD:EE:02', 'Cocina', 1),
('AA:BB:CC:DD:EE:03', 'Dormitorio', 1);


INSERT INTO sensor (mac, localizacion, casa_id) VALUES
('AA:BB:CC:DD:EE:04', 'Entrada', 2),
('AA:BB:CC:DD:EE:05', 'Garaje', 2),
('AA:BB:CC:DD:EE:06', 'Jardín', 2),
('AA:BB:CC:DD:EE:07', 'Salón', 2),
('AA:BB:CC:DD:EE:08', 'Dormitorio principal', 2);

INSERT INTO usuario (nombre, apellido1, apellido2, email, password, casa_id) VALUES
('Juan', 'Pérez', 'Gómez', 'juan.perez@email.com', '$2y$12$hFKv00haN8tmlhxYXqMNauOBadfPO/ZpB.kdAwQZwHAbFqVXeOyqG', 1), -- pass=abc123
('María', 'López', 'Sánchez', 'maria.lopez@email.com', '$2y$12$EtaxVx3IVXBmvn7jr.8ete9CnTBGJD2AoCHBe9adROE9bOvZekA4i', 1), -- pass=abc123
('Carlos', 'Ruiz', 'Martín', 'carlos.ruiz@email.com', '$2y$12$By6IaJmbY4uLSN/nDmEnMeosggQ77AFIjp2rg2MsUhtGRffigGQbG', 2); -- pass=abc123
