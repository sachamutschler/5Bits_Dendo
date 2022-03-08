-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : mar. 08 mars 2022 à 22:49
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
-- Base de données : `dendo`
--

-- --------------------------------------------------------

--
-- Structure de la table `carac_couleur`
--

DROP TABLE IF EXISTS `carac_couleur`;
CREATE TABLE IF NOT EXISTS `carac_couleur` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `couleur` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `carac_couleur`
--

INSERT INTO `carac_couleur` (`id`, `couleur`) VALUES
(1, 'Bleu'),
(2, 'Rouge'),
(3, 'Vert'),
(4, 'Noir'),
(5, 'Gris'),
(6, 'Violet'),
(7, 'Jaune'),
(8, 'Orange'),
(9, 'Gris'),
(10, 'Rose'),
(11, 'Blanc');

-- --------------------------------------------------------

--
-- Structure de la table `carac_matiere_cadre`
--

DROP TABLE IF EXISTS `carac_matiere_cadre`;
CREATE TABLE IF NOT EXISTS `carac_matiere_cadre` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `matiere` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `carac_matiere_cadre`
--

INSERT INTO `carac_matiere_cadre` (`id`, `matiere`) VALUES
(1, 'Aluminium'),
(2, 'Carbone');

-- --------------------------------------------------------

--
-- Structure de la table `carac_taille_cadre`
--

DROP TABLE IF EXISTS `carac_taille_cadre`;
CREATE TABLE IF NOT EXISTS `carac_taille_cadre` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `taille_cadre` varchar(3) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `carac_taille_cadre`
--

INSERT INTO `carac_taille_cadre` (`id`, `taille_cadre`) VALUES
(1, 'XS'),
(2, 'S'),
(3, 'M'),
(4, 'L'),
(5, 'XL');

-- --------------------------------------------------------

--
-- Structure de la table `carac_taille_roues`
--

DROP TABLE IF EXISTS `carac_taille_roues`;
CREATE TABLE IF NOT EXISTS `carac_taille_roues` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `taille_roues` tinyint(4) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `carac_taille_roues`
--

INSERT INTO `carac_taille_roues` (`id`, `taille_roues`) VALUES
(2, 12),
(3, 14),
(4, 16),
(5, 18),
(6, 20),
(7, 22),
(8, 24),
(9, 26),
(10, 28),
(11, 29);

-- --------------------------------------------------------

--
-- Structure de la table `categorie`
--

DROP TABLE IF EXISTS `categorie`;
CREATE TABLE IF NOT EXISTS `categorie` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom_categorie` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `categorie`
--

INSERT INTO `categorie` (`id`, `nom_categorie`) VALUES
(1, 'VTT'),
(2, 'Ville'),
(3, 'Route');

-- --------------------------------------------------------

--
-- Structure de la table `commande`
--

DROP TABLE IF EXISTS `commande`;
CREATE TABLE IF NOT EXISTS `commande` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `transporteur` varchar(255) DEFAULT NULL,
  `code_colis` varchar(255) DEFAULT NULL,
  `poids` int(4) DEFAULT NULL,
  `taille` int(3) DEFAULT NULL,
  `etat` varchar(25) DEFAULT NULL,
  `id_compte_client` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `commande_compte_client_idCompte_client_fk` (`id_compte_client`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `compte_client`
--

DROP TABLE IF EXISTS `compte_client`;
CREATE TABLE IF NOT EXISTS `compte_client` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `identifiant` varchar(255) NOT NULL,
  `mot_de_passe` varchar(255) NOT NULL,
  `nom_client` varchar(255) NOT NULL,
  `prenom` varchar(255) NOT NULL,
  `mail` varchar(255) NOT NULL,
  `telephone_port` varchar(25) NOT NULL,
  `telephone_fixe` varchar(25) DEFAULT NULL,
  `adresse_1` varchar(255) NOT NULL,
  `adresse_2` varchar(255) DEFAULT NULL,
  `ville` varchar(255) NOT NULL,
  `code_postal` varchar(60) NOT NULL,
  `pays` varchar(255) NOT NULL,
  `code_validation` varchar(255) DEFAULT NULL,
  `etat` varchar(255) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `ligne_commande`
--

DROP TABLE IF EXISTS `ligne_commande`;
CREATE TABLE IF NOT EXISTS `ligne_commande` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `quantite` int(4) DEFAULT NULL,
  `montant_unite` int(4) DEFAULT NULL,
  `montant_total` int(6) DEFAULT NULL,
  `reference_produit` varchar(255) DEFAULT NULL,
  `designation_produit` varchar(255) DEFAULT NULL,
  `id_commande` int(11) NOT NULL,
  `id_produit` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `ligne_commande_commande_idCommande_fk` (`id_commande`),
  KEY `ligne_commande_produit_idProduit_fk` (`id_produit`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `panier`
--

DROP TABLE IF EXISTS `panier`;
CREATE TABLE IF NOT EXISTS `panier` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `quantite` int(4) DEFAULT NULL,
  `id_produit` int(11) NOT NULL,
  `id_compte_client` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `panier_produit_idProduit_fk` (`id_produit`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `produit`
--

DROP TABLE IF EXISTS `produit`;
CREATE TABLE IF NOT EXISTS `produit` (
  `id_produit` int(11) NOT NULL AUTO_INCREMENT,
  `reference` varchar(255) DEFAULT NULL,
  `nom_produit` varchar(30) DEFAULT NULL,
  `designation` varchar(255) DEFAULT NULL,
  `poids` int(4) DEFAULT NULL,
  `stock` int(4) DEFAULT NULL,
  `prix` int(6) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `electrique` tinyint(1) NOT NULL DEFAULT '0',
  `reduction_produit` decimal(4,2) NOT NULL,
  `id_categorie` int(11) NOT NULL,
  `id_carac_couleur` int(11) NOT NULL,
  `id_carac_matiere_cadre` int(11) NOT NULL,
  `id_carac_taille_cadre` int(11) NOT NULL,
  `id_carac_taille_roues` int(11) NOT NULL,
  `accueil` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id_produit`),
  KEY `produit_categorie_idCategorie_fk` (`id_categorie`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `produit`
--

INSERT INTO `produit` (`id_produit`, `reference`, `nom_produit`, `designation`, `poids`, `stock`, `prix`, `image`, `electrique`, `reduction_produit`, `id_categorie`, `id_carac_couleur`, `id_carac_matiere_cadre`, `id_carac_taille_cadre`, `id_carac_taille_roues`, `accueil`) VALUES
(1, 'VEL_AL_ROU_ROS_24_L', 'Sakura ROSE L', 'Vélo de route Rose pour homme. 24 pouces, taille L.', 5, 82, 1200, 'VEL_AL_ROU_ROS_24_L', 0, '0.00', 3, 10, 1, 4, 8, 1),
(2, 'VEL_AL_ROU_ROS_20_M', 'Sakura ROSE M', 'Vélo de route Rose pour homme. 20 pouces, taille M.', 4, 154, 1090, 'VEL_AL_ROU_ROS_20_M', 0, '0.00', 3, 10, 1, 3, 6, 0),
(3, 'VEL_AL_ROU_ORA_28_M', 'Yumamoto ORANGE M', 'Vélo de route Orange pour homme et femme. 28 pouces, taille L.', 4, 154, 1290, 'VEL_AL_ROU_ORA_28_L', 0, '0.00', 3, 8, 1, 4, 10, 1),
(4, 'VEL_CA_ROU_NOI_26_M', 'Kyoto NOIR M', 'Vélo de route Noir pour homme et femme. 26 pouces, taille L.', 6, 114, 1290, 'VEL_CA_ROU_NOI_26_M', 0, '10.00', 3, 4, 2, 3, 9, 0),
(5, 'VEL_AL_ROU_JAU_12_XS', 'Osaka JAUNE XS', 'Vélo de route Jaune pour enfant. 12 pouces, taille XS.', 4, 331, 800, 'VEL_AL_ROU_JAU_12_XS', 0, '20.00', 3, 7, 1, 1, 2, 0),
(6, 'VEL_AL_ROU_JAU_18_S', 'Osaka JAUNE S', 'Vélo de route Jaune pour  femme ou enfant. 18 pouces, taille S.', 5, 54, 900, 'VEL_AL_ROU_JAU_18_S', 0, '15.00', 3, 7, 2, 2, 5, 0),
(7, 'VEL_AL_VIL_BLA_20_M', 'Hokkaido BLANC M', 'Vélo de ville blanc pour Femme. 20 pouces, taille M.', 14, 123, 790, 'VEL_AL_VIL_BLA_20_M', 0, '0.00', 2, 11, 1, 3, 6, 1),
(8, 'VEL_CA_VTT_GRI_24_L', 'Kobe GRIS L', 'Vélo tout terrain Gris pour homme. 24 pouces, taille L.', 10, 80, 1200, 'VEL_CA_VTT_GRI_24_L', 0, '20.00', 1, 5, 2, 4, 8, 0),
(9, 'VEL_CA_VTT_ROU_20_M', 'Kobe Rouge M', 'Vélo tout terrain Rouge pour femme. 20 pouces, taille M.', 9, 43, 1150, 'VEL_CA_VTT_ROU_20_M', 0, '10.00', 1, 2, 2, 3, 6, 0),
(10, 'VEL_AL_VTT_VER_12_XS', 'Okayama VERT XS', 'Vélo tout terrain Vert pour enfant. 12 pouces, taille XS.', 6, 155, 500, 'VEL_AL_VTT_VER_12_XS', 0, '20.00', 1, 3, 1, 1, 2, 0),
(11, 'VEL_AL_VTT_BLA_12_XS', 'Okayama BLANC XS', 'Vélo tout terrain Blanc pour enfant. 12 pouces, taille XS.', 6, 134, 500, 'VEL_AL_VTT_BLA_12_XS', 0, '20.00', 1, 11, 1, 1, 2, 0),
(12, 'VEL_CA_ROU_BLE_24_L', 'Honshu électrique BLEU L', 'Vélo Electrique de route Bleu pour homme et femme. 24 pouces, taille L.', 9, 23, 3090, 'VEL_CA_ROU_BLE_24_L', 1, '0.00', 3, 1, 2, 4, 8, 1);

-- --------------------------------------------------------

--
-- Structure de la table `promo`
--

DROP TABLE IF EXISTS `promo`;
CREATE TABLE IF NOT EXISTS `promo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(255) DEFAULT NULL,
  `reduction` tinyint(4) DEFAULT NULL,
  `date_debut` datetime DEFAULT NULL,
  `date_fin` datetime DEFAULT NULL,
  `montant_min` int(11) DEFAULT '0',
  `id_categorie` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `promo_produit_idProduit_fk` (`montant_min`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `promo`
--

INSERT INTO `promo` (`id`, `code`, `reduction`, `date_debut`, `date_fin`, `montant_min`, `id_categorie`) VALUES
(1, 'ROUTE10', 10, '2022-03-03 00:00:00', '2022-05-31 23:59:59', 1000, 3),
(2, 'ROUTE20', 20, '2022-03-03 00:00:00', '2022-05-31 23:59:59', 2000, 3),
(3, 'HAPPYMARCH', 15, '2022-03-01 00:00:00', '2022-03-31 23:59:59', 1500, NULL),
(4, 'DESTOCKAGE', 20, '2022-03-03 00:00:00', '2022-07-31 23:59:59', 5000, NULL),
(5, 'VILLE15', 15, '2022-03-03 00:00:00', '2022-05-31 23:59:59', 1000, 2);

-- --------------------------------------------------------

--
-- Structure de la table `taxonomie`
--

DROP TABLE IF EXISTS `taxonomie`;
CREATE TABLE IF NOT EXISTS `taxonomie` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom_taxonomie` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `taxonomie`
--

INSERT INTO `taxonomie` (`id`, `nom_taxonomie`) VALUES
(1, 'Homme'),
(2, 'Femme'),
(3, 'Enfant');

-- --------------------------------------------------------

--
-- Structure de la table `taxonomie_produit`
--

DROP TABLE IF EXISTS `taxonomie_produit`;
CREATE TABLE IF NOT EXISTS `taxonomie_produit` (
  `id_taxonomie` int(11) NOT NULL,
  `id_produit` int(11) NOT NULL,
  KEY `taxonomie_produit_produit_idProduit_fk` (`id_produit`),
  KEY `taxonomie_produit_taxonomie_idTaxonomie_fk` (`id_taxonomie`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `taxonomie_produit`
--

INSERT INTO `taxonomie_produit` (`id_taxonomie`, `id_produit`) VALUES
(1, 1),
(1, 3),
(2, 3),
(1, 2),
(1, 4),
(2, 4),
(3, 5),
(3, 6),
(2, 6),
(2, 7),
(1, 8),
(2, 9),
(3, 10),
(3, 11),
(1, 12),
(2, 12);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
