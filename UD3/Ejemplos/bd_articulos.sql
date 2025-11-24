DROP DATABASE articulos;
CREATE DATABASE IF NOT EXISTS articulos;

USE articulos;

CREATE TABLE articulo(
    cod_articulo INT AUTO_INCREMENT PRIMARY KEY,
    titulo VARCHAR(100) NOT NULL,
    fecha DATE
);

CREATE TABLE resena(
    cod_resena INT AUTO_INCREMENT PRIMARY KEY,
    cod_articulo INT NOT NULL,
    descripcion VARCHAR(256) NOT NULL,
    fecha_hora DATETIME,
    CONSTRAINT fk_resena_articulo FOREIGN KEY (cod_articulo) REFERENCES articulo(cod_articulo)

);

--Carga de datos
INSERT INTO `articulo` (`cod_articulo`, `titulo`, `fecha`) VALUES (NULL, 'Boli rojo', '2024-07-09');
INSERT INTO `articulo` (`cod_articulo`, `titulo`, `fecha`) VALUES (NULL, 'Boli azul', '2025-10-07');
INSERT INTO `articulo` (`cod_articulo`, `titulo`, `fecha`) VALUES (NULL, 'Calculadora', '2024-11-06');
INSERT INTO `articulo` (`cod_articulo`, `titulo`, `fecha`) VALUES (NULL, 'Goma de borrar', '2025-12-06');
INSERT INTO `articulo` (`cod_articulo`, `titulo`, `fecha`) VALUES (NULL, 'Folios', '2025-12-06');