-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : lun. 26 août 2024 à 16:41
-- Version du serveur : 10.4.32-MariaDB
-- Version de PHP : 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `bd_djassa`
--

-- --------------------------------------------------------

--
-- Structure de la table `t_info`
--

CREATE TABLE `t_info` (
  `id` int(11) NOT NULL,
  `info` varchar(225) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `t_info`
--

INSERT INTO `t_info` (`id`, `info`) VALUES
(1, ' LeDJASSA vous offre 50% lors d\'un achat de plus 50.000 fcfa. N\'hésitez pas, profiter car la vie est courte!!!'),
(2, ' LeDJASSA vous offre 50% lors d\'un achat de plus 50.000 fcfa. N\'hésitez pas, profiter car la vie est courte!!!');

-- --------------------------------------------------------

--
-- Structure de la table `t_produit`
--

CREATE TABLE `t_produit` (
  `id` int(11) NOT NULL,
  `nom` varchar(200) NOT NULL,
  `photo` blob NOT NULL,
  `prix` int(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `t_produit`
--

INSERT INTO `t_produit` (`id`, `nom`, `photo`, `prix`) VALUES
(7, 'CARGO TRELLI ned', 0x707264312e6a7067, 25000),
(8, 'CARGO GRIS HOT2', 0x707264322e6a7067, 20000),
(9, 'CARGO MARRON', 0x707264332e6a7067, 16000);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `t_info`
--
ALTER TABLE `t_info`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `t_produit`
--
ALTER TABLE `t_produit`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `t_info`
--
ALTER TABLE `t_info`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `t_produit`
--
ALTER TABLE `t_produit`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
