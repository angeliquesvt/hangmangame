-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  lun. 15 jan. 2018 à 01:32
-- Version du serveur :  5.7.19
-- Version de PHP :  5.6.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `11602981pendu`
--

-- --------------------------------------------------------

--
-- Structure de la table `dictionnaire`
--

DROP TABLE IF EXISTS `dictionnaire`;
CREATE TABLE IF NOT EXISTS `dictionnaire` (
  `id_dictionnaire` int(11) NOT NULL AUTO_INCREMENT,
  `mot` varchar(50) NOT NULL DEFAULT '0',
  `id_theme` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id_dictionnaire`),
  KEY `FK_dictionnaire_theme` (`id_theme`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `dictionnaire`
--

INSERT INTO `dictionnaire` (`id_dictionnaire`, `mot`, `id_theme`) VALUES
(3, 'batmobile', 1),
(4, 'sabrelaser', 2),
(5, 'wayne', 1),
(6, 'pingouin', 1),
(7, 'catwoman', 1),
(8, 'force', 2),
(9, 'jedi', 2),
(10, 'yoda', 2),
(11, 'joker', 1),
(12, 'gotham', 1),
(13, 'padawan', 2),
(14, 'darkvador', 2);

-- --------------------------------------------------------

--
-- Structure de la table `score`
--

DROP TABLE IF EXISTS `score`;
CREATE TABLE IF NOT EXISTS `score` (
  `id_score` int(11) NOT NULL AUTO_INCREMENT,
  `id_utilisateur` int(11) NOT NULL DEFAULT '0',
  `score` int(11) NOT NULL DEFAULT '0',
  `id_dictionnaire` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id_score`),
  KEY `FK_score_utilisateur` (`id_utilisateur`),
  KEY `FK_score_dictionnaire` (`id_dictionnaire`)
) ENGINE=InnoDB AUTO_INCREMENT=36 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `score`
--

INSERT INTO `score` (`id_score`, `id_utilisateur`, `score`, `id_dictionnaire`) VALUES
(6, 1, 2000, 6),
(7, 1, 2500, 6),
(8, 2, 4000, 6),
(9, 1, 2100, 6),
(10, 1, 1700, 6),
(11, 1, 3200, 6),
(12, 1, 2400, 6),
(13, 1, 2000, 6),
(14, 1, 2000, 6),
(15, 1, 2000, 6),
(16, 1, 2000, 6),
(17, 1, 2000, 6),
(18, 1, 2000, 6),
(19, 1, 2000, 6),
(20, 1, 2000, 6),
(21, 1, 2000, 6),
(22, 1, 2000, 6),
(23, 1, 2000, 6),
(24, 1, 2000, 6),
(25, 1, 2000, 6),
(26, 1, 2000, 6),
(27, 1, 2000, 6),
(28, 1, 2000, 6),
(29, 1, 2000, 6),
(30, 1, 2000, 6),
(31, 1, 2100, 3),
(32, 1, 49200, 9),
(33, 1, 8300, 5),
(34, 1, 6700, 4),
(35, 1, 4200, 14);

-- --------------------------------------------------------

--
-- Structure de la table `theme`
--

DROP TABLE IF EXISTS `theme`;
CREATE TABLE IF NOT EXISTS `theme` (
  `id_theme` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(50) NOT NULL DEFAULT '0',
  `commentaire` varchar(140) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id_theme`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `theme`
--

INSERT INTO `theme` (`id_theme`, `nom`, `commentaire`) VALUES
(1, 'Batman', 'Ce thème correspond à Batman'),
(2, 'Starwars', 'Starwars est le plus fort');

-- --------------------------------------------------------

--
-- Structure de la table `utilisateur`
--

DROP TABLE IF EXISTS `utilisateur`;
CREATE TABLE IF NOT EXISTS `utilisateur` (
  `id_utilisateur` int(11) NOT NULL AUTO_INCREMENT,
  `login` varchar(50) NOT NULL DEFAULT '0',
  `password` varchar(50) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id_utilisateur`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `utilisateur`
--

INSERT INTO `utilisateur` (`id_utilisateur`, `login`, `password`) VALUES
(1, 'admin', 'root'),
(2, 'Angelique', 'pass');

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `dictionnaire`
--
ALTER TABLE `dictionnaire`
  ADD CONSTRAINT `FK_dictionnaire_theme` FOREIGN KEY (`id_theme`) REFERENCES `theme` (`id_theme`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `score`
--
ALTER TABLE `score`
  ADD CONSTRAINT `FK_score_dictionnaire` FOREIGN KEY (`id_dictionnaire`) REFERENCES `dictionnaire` (`id_dictionnaire`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_score_utilisateur` FOREIGN KEY (`id_utilisateur`) REFERENCES `utilisateur` (`id_utilisateur`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
