-- phpMyAdmin SQL Dump
-- version 4.0.4
-- http://www.phpmyadmin.net
--
-- Client: localhost
-- Généré le: Sam 12 Octobre 2013 à 20:55
-- Version du serveur: 5.6.12-log
-- Version de PHP: 5.4.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données: `pespo_db2`
--
CREATE DATABASE IF NOT EXISTS `pespo_db2` DEFAULT CHARACTER SET utf8 COLLATE utf8_bin;
USE `pespo_db2`;

-- --------------------------------------------------------

--
-- Structure de la table `appartient`
--

CREATE TABLE IF NOT EXISTS `appartient` (
  `id_jeu` smallint(5) unsigned NOT NULL,
  `id_univers` tinyint(3) unsigned NOT NULL,
  `id_appartient` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id_appartient`),
  KEY `id_jeu` (`id_jeu`,`id_univers`),
  KEY `id_univers` (`id_univers`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=18 ;

--
-- Contenu de la table `appartient`
--

INSERT INTO `appartient` (`id_jeu`, `id_univers`, `id_appartient`) VALUES
(1, 1, 1),
(1, 2, 2),
(11, 3, 3),
(12, 4, 4),
(12, 5, 5),
(13, 1, 6),
(15, 6, 7),
(16, 1, 8),
(16, 7, 9),
(17, 8, 10),
(18, 9, 11),
(20, 10, 12),
(20, 11, 13),
(21, 10, 14),
(21, 11, 15),
(22, 1, 16),
(22, 12, 17);

-- --------------------------------------------------------

--
-- Structure de la table `console`
--

CREATE TABLE IF NOT EXISTS `console` (
  `id_console` tinyint(3) unsigned NOT NULL AUTO_INCREMENT,
  `nom` varchar(50) COLLATE utf8_bin NOT NULL,
  `date_sortie` year(4) NOT NULL,
  `portabilite` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id_console`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=3 ;

--
-- Contenu de la table `console`
--

INSERT INTO `console` (`id_console`, `nom`, `date_sortie`, `portabilite`) VALUES
(1, 'Wii', 2006, 0),
(2, 'PlayStation 3', 2007, 0);

-- --------------------------------------------------------

--
-- Structure de la table `developpe`
--

CREATE TABLE IF NOT EXISTS `developpe` (
  `id_developpeur` tinyint(3) unsigned NOT NULL,
  `id_jeu` smallint(5) unsigned NOT NULL,
  `id_developpe` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id_developpe`),
  KEY `id_developpeur` (`id_developpeur`,`id_jeu`),
  KEY `id_jeu` (`id_jeu`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=21 ;

--
-- Contenu de la table `developpe`
--

INSERT INTO `developpe` (`id_developpeur`, `id_jeu`, `id_developpe`) VALUES
(1, 1, 1),
(1, 13, 11),
(1, 16, 14),
(1, 17, 15),
(3, 10, 8),
(3, 19, 17),
(4, 11, 9),
(5, 12, 10),
(6, 14, 12),
(7, 15, 13),
(8, 18, 16),
(9, 20, 18),
(9, 21, 19),
(10, 22, 20);

-- --------------------------------------------------------

--
-- Structure de la table `developpeur`
--

CREATE TABLE IF NOT EXISTS `developpeur` (
  `id_developpeur` tinyint(3) unsigned NOT NULL AUTO_INCREMENT,
  `nom` varchar(50) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`id_developpeur`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=11 ;

--
-- Contenu de la table `developpeur`
--

INSERT INTO `developpeur` (`id_developpeur`, `nom`) VALUES
(1, 'Nintendo'),
(2, 'Clover Studio'),
(3, 'Platinum Games'),
(4, 'Intelligent Systems'),
(5, 'Retro Studios'),
(6, 'Monolith Software'),
(7, 'Ubisoft France'),
(8, 'Treasure'),
(9, 'Square Enix'),
(10, 'Sora Ltd.');

-- --------------------------------------------------------

--
-- Structure de la table `edite`
--

CREATE TABLE IF NOT EXISTS `edite` (
  `id_editeur` tinyint(3) unsigned NOT NULL,
  `id_jeu` smallint(6) unsigned NOT NULL,
  `id_edite` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id_edite`),
  KEY `id_editeur` (`id_editeur`,`id_jeu`),
  KEY `id_jeu` (`id_jeu`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=19 ;

--
-- Contenu de la table `edite`
--

INSERT INTO `edite` (`id_editeur`, `id_jeu`, `id_edite`) VALUES
(1, 1, 1),
(1, 11, 7),
(1, 12, 8),
(1, 13, 9),
(1, 14, 10),
(1, 16, 12),
(1, 17, 13),
(1, 18, 14),
(1, 22, 18),
(3, 10, 6),
(3, 19, 15),
(4, 15, 11),
(5, 20, 16),
(5, 21, 17);

-- --------------------------------------------------------

--
-- Structure de la table `editeur`
--

CREATE TABLE IF NOT EXISTS `editeur` (
  `id_editeur` tinyint(3) unsigned NOT NULL AUTO_INCREMENT,
  `nom` varchar(50) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`id_editeur`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=6 ;

--
-- Contenu de la table `editeur`
--

INSERT INTO `editeur` (`id_editeur`, `nom`) VALUES
(1, 'Nintendo'),
(2, 'Capcom'),
(3, 'Sega'),
(4, 'Ubisoft'),
(5, 'Square Enix');

-- --------------------------------------------------------

--
-- Structure de la table `est`
--

CREATE TABLE IF NOT EXISTS `est` (
  `id_jeu` smallint(5) unsigned NOT NULL,
  `id_genre` tinyint(3) unsigned NOT NULL,
  `id_est` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id_est`),
  KEY `id_jeu` (`id_jeu`,`id_genre`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=21 ;

--
-- Contenu de la table `est`
--

INSERT INTO `est` (`id_jeu`, `id_genre`, `id_est`) VALUES
(1, 1, 1),
(1, 2, 2),
(10, 2, 6),
(11, 16, 7),
(12, 1, 8),
(13, 1, 9),
(14, 8, 10),
(15, 1, 11),
(16, 2, 12),
(16, 5, 13),
(17, 2, 14),
(17, 3, 15),
(18, 2, 16),
(19, 2, 17),
(20, 8, 18),
(21, 8, 19),
(22, 4, 20);

-- --------------------------------------------------------

--
-- Structure de la table `genre`
--

CREATE TABLE IF NOT EXISTS `genre` (
  `id_genre` tinyint(3) unsigned NOT NULL AUTO_INCREMENT,
  `nom` varchar(50) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`id_genre`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=17 ;

--
-- Contenu de la table `genre`
--

INSERT INTO `genre` (`id_genre`, `nom`) VALUES
(1, 'Plates-formes'),
(2, 'Action'),
(3, 'Aventure'),
(4, 'Combat'),
(5, 'Course'),
(6, 'Divers'),
(7, 'FPS'),
(8, 'Jeu de rôles'),
(9, 'Musique'),
(10, 'Party games'),
(11, 'Réflexion'),
(12, 'Shoot''em up'),
(13, 'Simulation'),
(14, 'Sport'),
(15, 'Stratégie'),
(16, 'Jeu de rôles tactique');

-- --------------------------------------------------------

--
-- Structure de la table `jeu`
--

CREATE TABLE IF NOT EXISTS `jeu` (
  `id_jeu` smallint(6) unsigned NOT NULL AUTO_INCREMENT,
  `nom` varchar(50) COLLATE utf8_bin NOT NULL,
  `id_console` tinyint(3) unsigned NOT NULL,
  `id_personne` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `boite` tinyint(1) NOT NULL DEFAULT '1',
  `manuel` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id_jeu`),
  KEY `id_console` (`id_console`),
  KEY `id_personne` (`id_personne`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=23 ;

--
-- Contenu de la table `jeu`
--

INSERT INTO `jeu` (`id_jeu`, `nom`, `id_console`, `id_personne`, `boite`, `manuel`) VALUES
(1, 'Super Mario Galaxy', 1, 0, 1, 1),
(10, 'MadWorld', 1, 0, 1, 1),
(11, 'Fire Emblem : Radiant Dawn', 1, 0, 1, 1),
(12, 'Donkey Kong Country Returns', 1, 0, 1, 1),
(13, 'New Super Mario Bros. Wii', 1, 0, 1, 1),
(14, 'Xenoblade Chronicles', 1, 0, 1, 1),
(15, 'Rayman Origins', 1, 0, 1, 1),
(16, 'Mario Kart Wii', 1, 0, 1, 1),
(17, 'The Legend of Zelda : Skyward Sword', 1, 0, 1, 1),
(18, 'Sin and Punishment : Successor of the Skies', 1, 0, 1, 1),
(19, 'Vanquish', 2, 0, 1, 1),
(20, 'Final Fantasy XIII', 2, 0, 1, 1),
(21, 'Final Fantasy XIII-2', 2, 0, 1, 1),
(22, 'Super Smash Bros. Brawl', 1, 0, 0, 0);

-- --------------------------------------------------------

--
-- Structure de la table `personne`
--

CREATE TABLE IF NOT EXISTS `personne` (
  `id_personne` tinyint(3) unsigned NOT NULL AUTO_INCREMENT,
  `nom` varchar(50) COLLATE utf8_bin NOT NULL,
  `prenom` varchar(50) COLLATE utf8_bin NOT NULL,
  `telephone` int(10) unsigned DEFAULT NULL,
  `email` varchar(100) COLLATE utf8_bin DEFAULT NULL,
  `surnom` varchar(50) COLLATE utf8_bin DEFAULT NULL,
  PRIMARY KEY (`id_personne`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=3 ;

--
-- Contenu de la table `personne`
--

INSERT INTO `personne` (`id_personne`, `nom`, `prenom`, `telephone`, `email`, `surnom`) VALUES
(1, 'Albespy', 'Guillaume', 665394035, 'guillaume@albespy.fr', 'Pepsi'),
(2, 'Aubert', 'Julien', NULL, 'ju.aubert87@gmail.com', 'Bebert');

-- --------------------------------------------------------

--
-- Structure de la table `univers`
--

CREATE TABLE IF NOT EXISTS `univers` (
  `id_univers` tinyint(3) unsigned NOT NULL AUTO_INCREMENT,
  `nom` varchar(50) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`id_univers`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=13 ;

--
-- Contenu de la table `univers`
--

INSERT INTO `univers` (`id_univers`, `nom`) VALUES
(1, 'Mario'),
(2, 'Super Mario Galaxy'),
(3, 'Fire Emblem'),
(4, 'Donkey Kong Country'),
(5, 'Donkey Kong'),
(6, 'Rayman'),
(7, 'Mario Kart'),
(8, 'Zelda'),
(9, 'Sin and Punishment'),
(10, 'Fabula Nova Crystallis'),
(11, 'Final Fantasy'),
(12, 'Super Smash Bros.');

--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `developpe`
--
ALTER TABLE `developpe`
  ADD CONSTRAINT `developpe_ibfk_1` FOREIGN KEY (`id_jeu`) REFERENCES `jeu` (`id_jeu`),
  ADD CONSTRAINT `developpe_ibfk_2` FOREIGN KEY (`id_developpeur`) REFERENCES `developpeur` (`id_developpeur`);

--
-- Contraintes pour la table `edite`
--
ALTER TABLE `edite`
  ADD CONSTRAINT `edite_ibfk_1` FOREIGN KEY (`id_editeur`) REFERENCES `editeur` (`id_editeur`),
  ADD CONSTRAINT `edite_ibfk_2` FOREIGN KEY (`id_jeu`) REFERENCES `jeu` (`id_jeu`);

--
-- Contraintes pour la table `jeu`
--
ALTER TABLE `jeu`
  ADD CONSTRAINT `jeu_ibfk_1` FOREIGN KEY (`id_console`) REFERENCES `console` (`id_console`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
