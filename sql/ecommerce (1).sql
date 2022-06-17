-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : ven. 17 juin 2022 à 13:50
-- Version du serveur : 5.7.36
-- Version de PHP : 7.4.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `ecommerce`
--

-- --------------------------------------------------------

--
-- Structure de la table `categorie`
--

DROP TABLE IF EXISTS `categorie`;
CREATE TABLE IF NOT EXISTS `categorie` (
  `id_categorie` int(11) NOT NULL AUTO_INCREMENT,
  `type_categorie` varchar(255) NOT NULL,
  PRIMARY KEY (`id_categorie`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `categorie`
--

INSERT INTO `categorie` (`id_categorie`, `type_categorie`) VALUES
(1, 'instrument'),
(2, 'accessoire table');

-- --------------------------------------------------------

--
-- Structure de la table `produits`
--

DROP TABLE IF EXISTS `produits`;
CREATE TABLE IF NOT EXISTS `produits` (
  `id_produit` int(11) NOT NULL AUTO_INCREMENT,
  `nom_produit` varchar(255) NOT NULL,
  `descripttion_produit` text NOT NULL,
  `prix_produit` float NOT NULL,
  `stock_produit` tinyint(1) NOT NULL,
  `date_depot` datetime NOT NULL,
  `image_produit` varchar(255) NOT NULL,
  `id_vendeur` int(11) NOT NULL,
  `id_categorie` int(11) NOT NULL,
  PRIMARY KEY (`id_produit`),
  KEY `id_vendeur` (`id_vendeur`),
  KEY `id_categorie` (`id_categorie`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `produits`
--

INSERT INTO `produits` (`id_produit`, `nom_produit`, `descripttion_produit`, `prix_produit`, `stock_produit`, `date_depot`, `image_produit`, `id_vendeur`, `id_categorie`) VALUES
(8, 'fourchette argent', 'La fourchette est un couvert de table ou un ustens', 2, 1, '2022-02-16 09:31:10', 'image/fourchette2.jpg', 2, 2),
(9, 'piano', 'Le piano est un instrument de musique polyphonique, Ã  clavier, de la famille des cordes frappÃ©es. Il se prÃ©sente sous deux formes :.          ', 25.25, 0, '2022-04-05 00:00:00', 'image/xavatar (2).png', 1, 1),
(20, 'voiture rtenaultrferref', '                        voiture      feffefe              ', 452.25, 0, '2022-04-12 00:00:00', 'image/author3.png', 2, 2),
(21, 'voiture gtgrgrgr', '                        voiture             rgrgrgrgrg       ', 652.25, 0, '2022-04-09 00:00:00', 'image/hotel-negresco.jpg', 2, 2),
(22, 'voiture', 'test', 325.25, 0, '2022-04-01 00:00:00', 'image/xavatar.png', 2, 1),
(23, 'voiture', 'test', 325.25, 0, '2022-04-01 00:00:00', 'image/xavatar.png', 2, 2),
(24, 'voiture', 'test', 325.25, 0, '2022-04-01 00:00:00', 'image/xavatar.png', 2, 1),
(25, 'voiture', 'test', 325.25, 0, '2022-04-01 00:00:00', 'image/xavatar.png', 2, 2),
(26, 'voiture', 'test', 325.25, 0, '2022-04-01 00:00:00', 'image/xavatar.png', 2, 2);

-- --------------------------------------------------------

--
-- Structure de la table `utilisateur`
--

DROP TABLE IF EXISTS `utilisateur`;
CREATE TABLE IF NOT EXISTS `utilisateur` (
  `id_users` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  PRIMARY KEY (`id_users`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `utilisateur`
--

INSERT INTO `utilisateur` (`id_users`, `email`, `password`) VALUES
(2, 'jean-pierre.calandri@gmail.com', 'gre');

-- --------------------------------------------------------

--
-- Structure de la table `vendeurs`
--

DROP TABLE IF EXISTS `vendeurs`;
CREATE TABLE IF NOT EXISTS `vendeurs` (
  `id_vendeur` int(11) NOT NULL AUTO_INCREMENT,
  `nom_vendeur` varchar(255) NOT NULL,
  `prenom_vendeur` varchar(255) NOT NULL,
  `tel_vendeur` varchar(255) NOT NULL,
  `mail_fournisseur` varchar(250) NOT NULL,
  PRIMARY KEY (`id_vendeur`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `vendeurs`
--

INSERT INTO `vendeurs` (`id_vendeur`, `nom_vendeur`, `prenom_vendeur`, `tel_vendeur`, `mail_fournisseur`) VALUES
(1, 'dupont', 'julien', '06 22 22 22 22', 'julien@gmail.com'),
(2, 'dufrene', 'marie', '06 11 11 11 11', 'marie.dufrene@gmail.com'),
(3, 'caland', 'flo', '06 00 11 20 10 00', 'flocala@gmail.com');

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `produits`
--
ALTER TABLE `produits`
  ADD CONSTRAINT `produits_ibfk_1` FOREIGN KEY (`id_categorie`) REFERENCES `categorie` (`id_categorie`),
  ADD CONSTRAINT `produits_ibfk_2` FOREIGN KEY (`id_vendeur`) REFERENCES `vendeurs` (`id_vendeur`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
