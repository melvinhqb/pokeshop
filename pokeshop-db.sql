-- Création de la base de données
CREATE DATABASE IF NOT EXISTS pokemon_store;
USE pokemon_store;

DROP TABLE IF EXISTS extension;
DROP TABLE IF EXISTS carte;

-- Table pour les extensions de cartes Pokémon
CREATE TABLE IF NOT EXISTS extension (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(255) NOT NULL,
    slug VARCHAR(255) NOT NULL UNIQUE,
    serie VARCHAR(255) NOT NULL,
    nb_cartes INT NOT NULL,
    nb_cartes_secretes INT NOT NULL,
    date_sortie DATE
);

-- Création de la table carte avec le numéro de carte et la référence à l'extension
CREATE TABLE IF NOT EXISTS carte (
    id INT AUTO_INCREMENT PRIMARY KEY,
    numero_carte INT NOT NULL,
    nom VARCHAR(255) NOT NULL,
    image VARCHAR(255),
    prix DECIMAL(10, 2) NOT NULL,
    stock INT NOT NULL DEFAULT 0,
    extension_id INT,
    FOREIGN KEY (extension_id) REFERENCES extension(id)
);

-- Créer trois extensions
INSERT INTO extension (nom, serie, slug, date_sortie, nb_cartes, nb_cartes_secretes)
VALUES
    ('151', 'Écarlate et Violet', 'MEW', '2023-09-22', 207, 42),
    ('Destinées de Paldea', 'Écarlate et Violet', 'PAF', '2024-01-26', 245, 154),
    ('Faille Paradoxe', 'Écarlate et Violet', 'PAR', '2023-11-03', 266, 84);

-- Remplir la base de donnée
INSERT INTO carte (nom, image, prix, stock, numero_carte, extension_id)
VALUES
    ('Bulbizarre', 'EV_MEW_1.jpg', 1.99, 10, 1, 1),
    ('Chenipan', 'EV_MEW_10.jpg', 1.99, 20, 10, 1),
    ('Voltorbe', 'EV_MEW_100.jpg', 1.99, 30, 100, 1),
    ('Électrode', 'EV_MEW_101.jpg', 1.99, 15, 101, 1),
    ('Noeunoeuf', 'EV_MEW_102.jpg', 1.99, 20, 102, 1),
    
    ('Pomdepik', 'EV_PAF_1.jpg', 1.99, 20, 1, 2),
    ('Maganon', 'EV_PAF_10.jpg', 1.99, 20, 10, 2),
    ('Blizzi', 'EV_PAF_100.jpg', 1.99, 20, 100, 2),
    ('Blizzaroi', 'EV_PAF_101.jpg', 1.99, 20, 101, 2),
    ('Olivini', 'EV_PAF_102.jpg', 1.99, 20, 102, 2),
    
    ('Arakdo', 'EV_PAR_001.jpg', 19.99, 10, 1, 3),
    ('Maskadra', 'EV_PAR_002.jpg', 1.99, 10, 2, 3),
    ('Momartik EX', 'EV_PAR_003.jpg', 19.99, 5, 3, 3),
    ('Feuillajou', 'EV_PAR_004.jpg', 5.99, 20, 4, 3),
    ('Feuilloutan', 'EV_PAR_005.jpg', 1.99, 20, 5, 3);
