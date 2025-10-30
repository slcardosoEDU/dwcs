CREATE DATABASE IF NOT EXISTS e_335;
USE e_335;
CREATE TABLE IF NOT EXISTS PRODUCTO(
    id_producto INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(20) NOT NULL,
    descripcion VARCHAR(255),
    precio DECIMAL(6,2)
);

CREATE TABLE IF NOT EXISTS CARRITO(
    id_carrito INT AUTO_INCREMENT PRIMARY KEY  
);

CREATE TABLE IF NOT EXISTS CARRITO_PRODUCTO(
    id_carrito INT,
    id_producto INT,
    PRIMARY KEY(id_carrito,id_producto),
    FOREIGN KEY(id_carrito) REFERENCES CARRITO(id_carrito) ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY(id_producto) REFERENCES PRODUCTO(id_producto) ON DELETE CASCADE ON UPDATE CASCADE
);

INSERT INTO PRODUCTO (nombre, descripcion, precio) VALUES
('Laptop', 'Portátil con 16GB RAM y 512GB SSD', 899.99),
('Smartphone', 'Teléfono móvil de última generación con cámara de 108MP', 749.50),
('Auriculares', 'Auriculares inalámbricos con cancelación de ruido', 199.99),
('Teclado', 'Teclado mecánico RGB para gaming', 129.99),
('Monitor', 'Monitor de 27 pulgadas con resolución 4K', 349.99),
('Mouse', 'Ratón óptico inalámbrico ergonómico', 59.99),
('Impresora', 'Impresora multifuncional con conexión Wi-Fi', 149.99),
('Disco Duro', 'Disco duro externo de 1TB USB 3.0', 89.99),
('Cámara', 'Cámara digital compacta con lente de 24MP', 599.99),
('Altavoz', 'Altavoz Bluetooth portátil resistente al agua', 79.99);