-- phpMyAdmin SQL Dump
-- version 4.1.4
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Sam 19 Décembre 2020 à 16:46
-- Version du serveur :  5.6.15-log
-- Version de PHP :  5.4.24

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données :  `film`
--

-- --------------------------------------------------------

--
-- Structure de la table `contact`
--

CREATE TABLE IF NOT EXISTS `contact` (
  `id_Contact` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(50) NOT NULL,
  `prénom` varchar(50) NOT NULL,
  `mail` varchar(50) NOT NULL,
  `message` text NOT NULL,
  PRIMARY KEY (`id_Contact`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 AUTO_INCREMENT=4 ;

-- --------------------------------------------------------

--
-- Structure de la table `film`
--

CREATE TABLE IF NOT EXISTS `film` (
  `id_film` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(50) NOT NULL,
  `imgSource` text NOT NULL,
  `auteur` varchar(50) NOT NULL,
  `nb_vote` int(11) NOT NULL,
  PRIMARY KEY (`id_film`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Contenu de la table `film`
--

INSERT INTO `film` (`id_film`, `nom`, `imgSource`, `auteur`, `nb_vote`) VALUES
(3, 'test', 'https://i.pinimg.com/originals/c5/2f/c9/c52fc99b6fecac8e6bc20a8ccc83a7e1.jpg', 'kiki', 9);

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id_user` int(11) NOT NULL AUTO_INCREMENT,
  `identifiant` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `vote` varchar(3) NOT NULL,
  `ADMIN` varchar(5) NOT NULL,
  PRIMARY KEY (`id_user`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=39 ;

--
-- Contenu de la table `user`
--

INSERT INTO `user` (`id_user`, `identifiant`, `password`, `vote`, `ADMIN`) VALUES
(36, 'kiki', 'kiki', 'oui', 'true'),
(37, 'admin', 'admin', 'oui', 'true');

-- --------------------------------------------------------

--
-- Structure de la table `vote`
--

CREATE TABLE IF NOT EXISTS `vote` (
  `id_vote` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` varchar(50) NOT NULL,
  `id_film` int(11) NOT NULL,
  PRIMARY KEY (`id_vote`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=21 ;

--
-- Contenu de la table `vote`
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

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
