-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Client: localhost
-- Généré le: Ven 17 Janvier 2014 à 11:32
-- Version du serveur: 5.5.24-log
-- Version de PHP: 5.4.3

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données: `projet_annuel`
--

-- --------------------------------------------------------

--
-- Structure de la table `boite`
--

CREATE TABLE IF NOT EXISTS `boite` (
  `ID_BOI` bigint(4) NOT NULL AUTO_INCREMENT,
  `ID_USE` bigint(4) NOT NULL,
  `TITRE_BOI` varchar(128) DEFAULT NULL,
  `CONTENU_BOI` varchar(500) DEFAULT NULL,
  `DATE_NEW_BOI` datetime DEFAULT NULL,
  `DATE_MODIF_BOI` datetime DEFAULT NULL,
  `ETAT_B` smallint(6) DEFAULT NULL,
  PRIMARY KEY (`ID_BOI`),
  KEY `I_FK_BOITE_UTILISATEUR` (`ID_USE`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `categorie`
--

CREATE TABLE IF NOT EXISTS `categorie` (
  `ID_CAT` int(11) NOT NULL AUTO_INCREMENT,
  `LIBELE_CAT` varchar(128) DEFAULT NULL,
  PRIMARY KEY (`ID_CAT`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `commentaire`
--

CREATE TABLE IF NOT EXISTS `commentaire` (
  `ID_COM` bigint(4) NOT NULL AUTO_INCREMENT,
  `ID_NEWS` bigint(4) NOT NULL,
  `ID_USE` bigint(4) NOT NULL,
  `COMMENTAIRE` char(255) DEFAULT NULL,
  `DATE_NEW_COM` datetime DEFAULT NULL,
  `DATE_MODIF_COM` datetime DEFAULT NULL,
  `ETAT_COM` smallint(6) DEFAULT NULL,
  PRIMARY KEY (`ID_COM`),
  KEY `I_FK_COMMENTAIRE_NEWS` (`ID_NEWS`),
  KEY `I_FK_COMMENTAIRE_UTILISATEUR` (`ID_USE`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `evenement`
--

CREATE TABLE IF NOT EXISTS `evenement` (
  `ID_EVENT` bigint(4) NOT NULL AUTO_INCREMENT,
  `ID_NEWS` bigint(4) NOT NULL,
  `LIBELE_EVENT` varchar(128) DEFAULT NULL,
  `DATE_EVENT` datetime DEFAULT NULL,
  PRIMARY KEY (`ID_EVENT`),
  KEY `I_FK_EVENEMENT_NEWS` (`ID_NEWS`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `genre_use`
--

CREATE TABLE IF NOT EXISTS `genre_use` (
  `ID_GENRE_USE` int(11) NOT NULL AUTO_INCREMENT,
  `LIBEL_GENRE_USE` char(32) DEFAULT NULL,
  PRIMARY KEY (`ID_GENRE_USE`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `inscrire`
--

CREATE TABLE IF NOT EXISTS `inscrire` (
  `ID_EVENT` bigint(4) NOT NULL AUTO_INCREMENT,
  `ID_USE` bigint(4) NOT NULL,
  PRIMARY KEY (`ID_EVENT`,`ID_USE`),
  KEY `I_FK_INSCRIRE_EVENEMENT` (`ID_EVENT`),
  KEY `I_FK_INSCRIRE_UTILISATEUR` (`ID_USE`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `mail`
--

CREATE TABLE IF NOT EXISTS `mail` (
  `ID_MAIL` bigint(4) NOT NULL AUTO_INCREMENT,
  `ID_USE` bigint(4) NOT NULL,
  `CONTENU_MAIL` varchar(500) DEFAULT NULL,
  `DATE_MAIL` datetime DEFAULT NULL,
  PRIMARY KEY (`ID_MAIL`),
  KEY `I_FK_MAIL_UTILISATEUR` (`ID_USE`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `news`
--

CREATE TABLE IF NOT EXISTS `news` (
  `ID_NEWS` bigint(4) NOT NULL AUTO_INCREMENT,
  `ID_CAT` int(11) NOT NULL,
  `ID_USE` bigint(4) NOT NULL,
  `TITRE_NEWS` varchar(128) DEFAULT NULL,
  `CONTENU_LONG_NEWS` varchar(500) DEFAULT NULL,
  `CONTENU_COUT_NEWS` varchar(255) DEFAULT NULL,
  `DATE_AJOUT_NEWS` datetime DEFAULT NULL,
  `DATE_MODIF_NEWS` datetime DEFAULT NULL,
  `ETAT_NEWS` smallint(6) DEFAULT NULL,
  `DOSSIER_IMAGE` varchar(128) DEFAULT NULL,
  `DOSSIER_NEWS` varchar(128) DEFAULT NULL,
  PRIMARY KEY (`ID_NEWS`),
  KEY `I_FK_NEWS_CATEGORIE` (`ID_CAT`),
  KEY `I_FK_NEWS_UTILISATEUR` (`ID_USE`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `utilisateur`
--

CREATE TABLE IF NOT EXISTS `utilisateur` (
  `ID_USE` bigint(4) NOT NULL AUTO_INCREMENT,
  `ID_GENRE_USE` int(11) NOT NULL,
  `NOM_USE` char(32) DEFAULT NULL,
  `PRENOM_USE` char(32) DEFAULT NULL,
  `EMAIL_USE` varchar(128) DEFAULT NULL,
  `PSEUDO_USE` char(32) DEFAULT NULL,
  `PASSWORD_USE` char(32) DEFAULT NULL,
  `DATE_NEW_USE` datetime DEFAULT NULL,
  `DATE_MODIF_USE` datetime DEFAULT NULL,
  `ETAT_USE` smallint(6) DEFAULT NULL,
  `VALIDE_CGU_USE` smallint(6) DEFAULT NULL,
  PRIMARY KEY (`ID_USE`),
  KEY `I_FK_UTILISATEUR_GENRE_USE` (`ID_GENRE_USE`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `visite`
--

CREATE TABLE IF NOT EXISTS `visite` (
  `ID_VIS` bigint(4) NOT NULL AUTO_INCREMENT,
  `ID_USE` bigint(4) NOT NULL,
  `DATE_VIS` datetime DEFAULT NULL,
  `IP_VIS` char(32) DEFAULT NULL,
  PRIMARY KEY (`ID_VIS`),
  KEY `I_FK_VISITE_UTILISATEUR` (`ID_USE`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `boite`
--
ALTER TABLE `boite`
  ADD CONSTRAINT `boite_ibfk_1` FOREIGN KEY (`ID_USE`) REFERENCES `utilisateur` (`ID_USE`);

--
-- Contraintes pour la table `commentaire`
--
ALTER TABLE `commentaire`
  ADD CONSTRAINT `commentaire_ibfk_1` FOREIGN KEY (`ID_NEWS`) REFERENCES `news` (`ID_NEWS`),
  ADD CONSTRAINT `commentaire_ibfk_2` FOREIGN KEY (`ID_USE`) REFERENCES `utilisateur` (`ID_USE`);

--
-- Contraintes pour la table `evenement`
--
ALTER TABLE `evenement`
  ADD CONSTRAINT `evenement_ibfk_1` FOREIGN KEY (`ID_NEWS`) REFERENCES `news` (`ID_NEWS`);

--
-- Contraintes pour la table `inscrire`
--
ALTER TABLE `inscrire`
  ADD CONSTRAINT `inscrire_ibfk_1` FOREIGN KEY (`ID_EVENT`) REFERENCES `evenement` (`ID_EVENT`),
  ADD CONSTRAINT `inscrire_ibfk_2` FOREIGN KEY (`ID_USE`) REFERENCES `utilisateur` (`ID_USE`);

--
-- Contraintes pour la table `mail`
--
ALTER TABLE `mail`
  ADD CONSTRAINT `mail_ibfk_1` FOREIGN KEY (`ID_USE`) REFERENCES `utilisateur` (`ID_USE`);

--
-- Contraintes pour la table `news`
--
ALTER TABLE `news`
  ADD CONSTRAINT `news_ibfk_1` FOREIGN KEY (`ID_CAT`) REFERENCES `categorie` (`ID_CAT`),
  ADD CONSTRAINT `news_ibfk_2` FOREIGN KEY (`ID_USE`) REFERENCES `utilisateur` (`ID_USE`);

--
-- Contraintes pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  ADD CONSTRAINT `utilisateur_ibfk_1` FOREIGN KEY (`ID_GENRE_USE`) REFERENCES `genre_use` (`ID_GENRE_USE`);

--
-- Contraintes pour la table `visite`
--
ALTER TABLE `visite`
  ADD CONSTRAINT `visite_ibfk_1` FOREIGN KEY (`ID_USE`) REFERENCES `utilisateur` (`ID_USE`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
