-- CREATE DATABASE IF NOT EXISTS videoteca;

USE desarrollo;

CREATE TABLE IF NOT EXISTS videojuegos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(255) NOT NULL,
    plataforma VARCHAR(100) NOT NULL,
    anio_lanzamiento INT NOT NULL,
    genero VARCHAR(100)
);
-- Datos base.
INSERT INTO videojuegos (nombre, plataforma, anio_lanzamiento, genero) VALUES
('The Legend of Zelda: Breath of the Wild', 'Nintendo Switch', 2017, 'Aventura'),
('God of War', 'PlayStation 4', 2018, 'Acción'),
('Red Dead Redemption 2', 'Xbox One', 2018, 'Aventura'),
('Minecraft', 'PC', 2011, 'Sandbox'),
('Fortnite', 'PC', 2017, 'Battle Royale'),
('The Witcher 3: Wild Hunt', 'PC', 2015, 'RPG'),
('Horizon Zero Dawn', 'PlayStation 4', 2017, 'Aventura'),
('Among Us', 'PC', 2018, 'Multijugador'),
('Super Mario Odyssey', 'Nintendo Switch', 2017, 'Plataformas'),
('Apex Legends', 'PC', 2019, 'Battle Royale'),
('Cyberpunk 2077', 'PC', 2020, 'RPG'),
('Call of Duty: Warzone', 'PC', 2020, 'Shooter'),
('Final Fantasy VII Remake', 'PlayStation 4', 2020, 'RPG'),
('Ghost of Tsushima', 'PlayStation 4', 2020, 'Acción'),
('Genshin Impact', 'PC', 2020, 'RPG'),
('Animal Crossing: New Horizons', 'Nintendo Switch', 2020, 'Simulación'),
('Assassin’s Creed Valhalla', 'Xbox Series X', 2020, 'Aventura'),
('FIFA 21', 'PlayStation 4', 2020, 'Deportes'),
('NBA 2K21', 'PlayStation 4', 2020, 'Deportes'),
('Resident Evil Village', 'PC', 2021, 'Terror'),
('Far Cry 6', 'PC', 2021, 'Acción'),
('Ratchet & Clank: Rift Apart', 'PlayStation 5', 2021, 'Plataformas'),
('Halo Infinite', 'Xbox Series X', 2021, 'Shooter'),
('It Takes Two', 'PC', 2021, 'Multijugador'),
('Returnal', 'PlayStation 5', 2021, 'Acción'),
('Forza Horizon 5', 'Xbox Series X', 2021, 'Carreras'),
('Deathloop', 'PlayStation 5', 2021, 'Acción'),
('Metroid Dread', 'Nintendo Switch', 2021, 'Aventura'),
('Tales of Arise', 'PC', 2021, 'RPG'),
('Battlefield 2042', 'PC', 2021, 'Shooter');