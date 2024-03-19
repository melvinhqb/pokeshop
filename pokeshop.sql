-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : mar. 19 mars 2024 à 14:10
-- Version du serveur : 10.4.32-MariaDB
-- Version de PHP : 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `pokeshop`
--

-- --------------------------------------------------------

--
-- Structure de la table `cards`
--

CREATE TABLE `cards` (
  `id` int(11) NOT NULL,
  `num_collection` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `slug` varchar(255) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `stock` int(11) NOT NULL DEFAULT 0,
  `extension_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `cards`
--

INSERT INTO `cards` (`id`, `num_collection`, `name`, `image`, `slug`, `price`, `stock`, `extension_id`) VALUES
(1, 1, 'Bulbizarre', 'EV/MEW/EV_MEW_1.jpg', 'MEW_001', 1.99, 10, 1),
(2, 10, 'Chenipan', 'EV/MEW/EV_MEW_10.jpg', 'MEW_010', 1.99, 20, 1),
(3, 100, 'Voltorbe', 'EV/MEW/EV_MEW_100.jpg', 'MEW_100', 1.99, 30, 1),
(4, 101, 'Électrode', 'EV/MEW/EV_MEW_101.jpg', 'MEW_101', 1.99, 15, 1),
(5, 102, 'Noeunoeuf', 'EV/MEW/EV_MEW_102.jpg', 'MEW_102', 1.99, 20, 1),
(6, 1, 'Pomdepik', 'EV/PAF/EV_PAF_1.jpg', 'PAF_001', 1.99, 20, 2),
(7, 10, 'Maganon', 'EV/PAF/EV_PAF_10.jpg', 'PAF_010', 1.99, 20, 2),
(8, 100, 'Blizzi', 'EV/PAF/EV_PAF_100.jpg', 'PAF_100', 1.99, 20, 2),
(9, 101, 'Blizzaroi', 'EV/PAF/EV_PAF_101.jpg', 'PAF_101', 1.99, 20, 2),
(10, 102, 'Olivini', 'EV/PAF/EV_PAF_102.jpg', 'PAF_102', 1.99, 20, 2),
(11, 1, 'Arakdo', 'EV/PAR/EV_PAR_001.jpg', 'PAR_001', 19.99, 10, 3),
(12, 2, 'Maskadra', 'EV/PAR/EV_PAR_002.jpg', 'PAR_002', 1.99, 10, 3),
(13, 3, 'Momartik EX', 'EV/PAR/EV_PAR_003.jpg', 'PAR_003', 19.99, 5, 3),
(14, 4, 'Feuillajou', 'EV/PAR/EV_PAR_004.jpg', 'PAR_004', 5.99, 20, 3),
(15, 5, 'Feuilloutan', 'EV/PAR/EV_PAR_005.jpg', 'PAR_005', 1.99, 20, 3),
(16, 1, 'Mystherbe', 'EB/CRZ/EB_CRZ_001.jpg', 'CRZ_001', 1.99, 20, 4),
(17, 2, 'Ortide', 'EB/CRZ/EB_CRZ_002.jpg', 'CRZ_002', 2.99, 10, 4),
(18, 3, 'Joliflor', 'EB/CRZ/EB_CRZ_003.jpg', 'CRZ_003', 0.99, 50, 4),
(19, 1, 'Mimitoss', 'EB/SIT/EB_SIT_001.jpg', 'SIT_001', 1.99, 40, 5),
(20, 2, 'Aéromite', 'EB/SIT/EB_SIT_002.jpg', 'SIT_002', 2.99, 10, 5),
(21, 3, 'Mimigal', 'EB/SIT/EB_SIT_003.jpg', 'SIT_003', 1.99, 10, 5),
(22, 1, 'Bulbizarre', 'EB/PGO/EB_PGO_001.jpg', 'PGO_001', 3.99, 10, 6),
(23, 2, 'Herbizarre', 'EB/PGO/EB_PGO_002.jpg', 'PGO_002', 3.99, 10, 6),
(24, 3, 'Florizarre', 'EB/PGO/EB_PGO_003.jpg', 'PGO_003', 3.99, 10, 6);

-- --------------------------------------------------------

--
-- Structure de la table `extensions`
--

CREATE TABLE `extensions` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `nb_cards` int(11) NOT NULL,
  `nb_secret_cards` int(11) NOT NULL,
  `release_date` date DEFAULT NULL,
  `series_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `extensions`
--

INSERT INTO `extensions` (`id`, `name`, `slug`, `nb_cards`, `nb_secret_cards`, `release_date`, `series_id`) VALUES
(1, '151', 'MEW', 207, 42, '2023-09-22', 1),
(2, 'Destinées de Paldea', 'PAF', 245, 154, '2024-01-26', 1),
(3, 'Faille Paradoxe', 'PAR', 266, 84, '2023-11-03', 1),
(4, 'Zénith Suprême', 'CRZ', 230, 71, '2023-01-20', 2),
(5, 'Tempête Argentée', 'SIT', 245, 50, '2022-11-11', 2),
(6, 'Pokémon GO', 'PGO', 88, 10, '2022-07-01', 2);

-- --------------------------------------------------------

--
-- Structure de la table `series`
--

CREATE TABLE `series` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `image` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `series`
--

INSERT INTO `series` (`id`, `name`, `slug`, `image`) VALUES
(1, 'Écarlate et Violet', 'EV', 'EV/LogoEV.png'),
(2, 'Épée et Bouclier', 'EB', 'EB/LogoEB.png'),
(3, 'Soleil et Lune', 'SL', 'SL/LogoSL.png'),
(4, 'XY', 'XY', 'EB/LogoXY.png'),
(5, 'Noir et Blanc', 'NB', 'NB/LogoNB.png');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `cards`
--
ALTER TABLE `cards`
  ADD PRIMARY KEY (`id`),
  ADD KEY `extension_id` (`extension_id`);

--
-- Index pour la table `extensions`
--
ALTER TABLE `extensions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `slug` (`slug`),
  ADD KEY `serie_id` (`series_id`);

--
-- Index pour la table `series`
--
ALTER TABLE `series`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `slug` (`slug`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `cards`
--
ALTER TABLE `cards`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT pour la table `extensions`
--
ALTER TABLE `extensions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT pour la table `series`
--
ALTER TABLE `series`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `cards`
--
ALTER TABLE `cards`
  ADD CONSTRAINT `cards_ibfk_1` FOREIGN KEY (`extension_id`) REFERENCES `extensions` (`id`);

--
-- Contraintes pour la table `extensions`
--
ALTER TABLE `extensions`
  ADD CONSTRAINT `extensions_ibfk_1` FOREIGN KEY (`series_id`) REFERENCES `series` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
