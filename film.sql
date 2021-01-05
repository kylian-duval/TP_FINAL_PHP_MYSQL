-- phpMyAdmin SQL Dump
-- version 4.9.7
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost
-- Généré le : sam. 19 déc. 2020 à 00:33
-- Version du serveur :  10.1.47-MariaDB-0+deb9u1
-- Version de PHP : 7.0.33-0+deb9u10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `film`
--

-- --------------------------------------------------------

--
-- Structure de la table `contact`
--

CREATE TABLE `contact` (
  `id_Contact` int(11) NOT NULL,
  `nom` varchar(50) NOT NULL,
  `prénom` varchar(50) NOT NULL,
  `mail` varchar(50) NOT NULL,
  `message` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `film`
--

CREATE TABLE `film` (
  `id_film` int(11) NOT NULL,
  `nom` varchar(50) NOT NULL,
  `imgSource` text NOT NULL,
  `auteur` varchar(50) NOT NULL,
  `nb_vote` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `film`
--

INSERT INTO `film` (`id_film`, `nom`, `imgSource`, `auteur`, `nb_vote`) VALUES
(8, 'fast and farious 8', 'film/fast and farious 8.jpg', 'Gary Scott Thompson', 0),
(4, 'taxi 4', 'film/taxi 4.jpg', 'Luc Besson', 0),
(5, 'tuche 1', 'film/tuche 1.jpg', 'Olivier Baroux', 0),
(10, 'retour vers le future 2', 'film/jpg.jpg', 'Robert Zemeckis', 0);

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `identifiant` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `vote` varchar(3) NOT NULL,
  `ADMIN` varchar(5) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id_user`, `identifiant`, `password`, `vote`, `ADMIN`) VALUES
(36, 'kiki', 'kiki', 'non', 'true'),
(37, 'admin', 'admin', 'non', 'true'),
(39, 'loux', 'root', 'non', 'true');

-- --------------------------------------------------------

--
-- Structure de la table `vote`
--

CREATE TABLE `vote` (
  `id_vote` int(11) NOT NULL,
  `id_user` varchar(50) NOT NULL,
  `id_film` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `vote`
--

INSERT INTO `vote` (`id_vote`, `id_user`, `id_film`) VALUES
(20, '37', 3),
(19, '36', 3),
(18, '36', 3),
(17, '37', 3),
(16, '37', 3),
(15, '37', 3),
(14, '37', 3),
(13, '37', 3),
(12, '37', 3),
(11, '37', 3);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `contact`
--
ALTER TABLE `contact`
  ADD PRIMARY KEY (`id_Contact`);

--
-- Index pour la table `film`
--
ALTER TABLE `film`
  ADD PRIMARY KEY (`id_film`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- Index pour la table `vote`
--
ALTER TABLE `vote`
  ADD PRIMARY KEY (`id_vote`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `contact`
--
ALTER TABLE `contact`
  MODIFY `id_Contact` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `film`
--
ALTER TABLE `film`
  MODIFY `id_film` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT pour la table `vote`
--
ALTER TABLE `vote`
  MODIFY `id_vote` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
