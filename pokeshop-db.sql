-- Création de la base de données
CREATE DATABASE IF NOT EXISTS pokemon_store;
USE pokemon_store;

DROP TABLE IF EXISTS carte;
DROP TABLE IF EXISTS extension;
DROP TABLE IF EXISTS serie;

-- Table pour les séries de cartes Pokémon
CREATE TABLE IF NOT EXISTS serie (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(255) NOT NULL,
    slug VARCHAR(255) NOT NULL UNIQUE,
    image VARCHAR(255)
);

-- Table pour les extensions de cartes Pokémon
CREATE TABLE IF NOT EXISTS extension (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(255) NOT NULL,
    slug VARCHAR(255) NOT NULL UNIQUE,
    nb_cartes INT NOT NULL,
    nb_cartes_secretes INT NOT NULL,
    date_sortie DATE,
    serie_id INT,
    FOREIGN KEY (serie_id) REFERENCES serie(id)
);

-- Création de la table carte avec le numéro de carte et la référence à l'extension
CREATE TABLE IF NOT EXISTS carte (
    id INT AUTO_INCREMENT PRIMARY KEY,
    numero_carte INT NOT NULL,
    nom VARCHAR(255) NOT NULL,
    image VARCHAR(255),
    slug VARCHAR(255) NOT NULL,
    prix DECIMAL(10, 2) NOT NULL,
    stock INT NOT NULL DEFAULT 0,
    extension_id INT,
    FOREIGN KEY (extension_id) REFERENCES extension(id)
);

-- Créer une série
INSERT INTO serie (nom, slug, image)
VALUES
    ('Écarlate et Violet', 'EV', 'EV/LogoEV.png'),
    ('Épée et Bouclier', 'EB', 'EB/LogoEB.png');

-- Créer trois extensions
INSERT INTO extension (nom, slug, date_sortie, nb_cartes, nb_cartes_secretes, serie_id)
VALUES
    ('151', 'MEW', '2023-09-22', 207, 42, 1),
    ('Destinées de Paldea', 'PAF', '2024-01-26', 245, 154, 1),
    ('Faille Paradoxe', 'PAR', '2023-11-03', 266, 84, 1),
    ('Zénith Suprême', 'CRZ', '2023-01-20', 230, 71, 2),
    ('Tempête Argentée', 'SIT', '2022-11-11', 245, 50, 2),
    ('Pokémon GO', 'PGO', '2022-07-01', 88, 10, 2);


-- Remplir la base de donnée
INSERT INTO carte (nom, image, prix, stock, numero_carte, extension_id, slug)
VALUES
    ('Bulbizarre', 'EV/MEW/EV_MEW_1.jpg', 1.99, 10, 1, 1, 'MEW_001'),
    ('Chenipan', 'EV/MEW/EV_MEW_10.jpg', 1.99, 20, 10, 1, 'MEW_010'),
    ('Voltorbe', 'EV/MEW/EV_MEW_100.jpg', 1.99, 30, 100, 1, 'MEW_100'),
    ('Électrode', 'EV/MEW/EV_MEW_101.jpg', 1.99, 15, 101, 1, 'MEW_101'),
    ('Noeunoeuf', 'EV/MEW/EV_MEW_102.jpg', 1.99, 20, 102, 1, 'MEW_102'),
    
    ('Pomdepik', 'EV/PAF/EV_PAF_1.jpg', 1.99, 20, 1, 2, 'PAF_001'),
    ('Maganon', 'EV/PAF/EV_PAF_10.jpg', 1.99, 20, 10, 2, 'PAF_010'),
    ('Blizzi', 'EV/PAF/EV_PAF_100.jpg', 1.99, 20, 100, 2, 'PAF_100'),
    ('Blizzaroi', 'EV/PAF/EV_PAF_101.jpg', 1.99, 20, 101, 2, 'PAF_101'),
    ('Olivini', 'EV/PAF/EV_PAF_102.jpg', 1.99, 20, 102, 2, 'PAF_102'),
    
    ('Arakdo', 'EV/PAR/EV_PAR_001.jpg', 19.99, 10, 1, 3, 'PAR_001'),
    ('Maskadra', 'EV/PAR/EV_PAR_002.jpg', 1.99, 10, 2, 3, 'PAR_002'),
    ('Momartik EX', 'EV/PAR/EV_PAR_003.jpg', 19.99, 5, 3, 3, 'PAR_003'),
    ('Feuillajou', 'EV/PAR/EV_PAR_004.jpg', 5.99, 20, 4, 3, 'PAR_004'),
    ('Feuilloutan', 'EV/PAR/EV_PAR_005.jpg', 1.99, 20, 5, 3, 'PAR_005'),
    
    ('Mystherbe', 'EB/CRZ/EB_CRZ_001.jpg', 1.99, 20, 1, 4, 'CRZ_001'),
    ('Ortide', 'EB/CRZ/EB_CRZ_002.jpg', 2.99, 10, 2, 4, 'CRZ_002'),
    ('Joliflor', 'EB/CRZ/EB_CRZ_003.jpg', 0.99, 50, 3, 4, 'CRZ_003'),
    
    ('Mimitoss', 'EB/SIT/EB_SIT_001.jpg', 1.99, 40, 1, 5, 'SIT_001'),
    ('Aéromite', 'EB/SIT/EB_SIT_002.jpg', 2.99, 10, 2, 5, 'SIT_002'),
    ('Mimigal', 'EB/SIT/EB_SIT_003.jpg', 1.99, 10, 3, 5, 'SIT_003'),
    
    ('Bulbizarre', 'EB/PGO/EB_PGO_001.jpg', 3.99, 10, 1, 6, 'PGO_001'),
    ('Herbizarre', 'EB/PGO/EB_PGO_002.jpg', 3.99, 10, 2, 6, 'PGO_002'),
    ('Florizarre', 'EB/PGO/EB_PGO_003.jpg', 3.99, 10, 3, 6, 'PGO_003');
