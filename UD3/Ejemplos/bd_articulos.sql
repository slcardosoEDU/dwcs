CREATE DATABASE IF NOT EXISTS articulos;

USE articulos;

CREATE TABLE articulo(
    cod_articulo INT AUTO_INCREMENT PRIMARY KEY,
    titulo VARCHAR(100) NOT NULL,
    fecha DATE
);

--Carga de datos
INSERT INTO `articulo` (`cod_articulo`, `titulo`, `fecha`) VALUES (NULL, 'Boli rojo', '2024-12-09');
INSERT INTO `articulo` (`cod_articulo`, `titulo`, `fecha`) VALUES (NULL, 'Boli azul', '2024-12-07');
INSERT INTO `articulo` (`cod_articulo`, `titulo`, `fecha`) VALUES (NULL, 'Boli negro', '2024-12-06');