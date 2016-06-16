-- phpMyAdmin SQL Dump
-- version 4.5.2
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Mar 14 Juin 2016 à 09:19
-- Version du serveur :  5.7.9
-- Version de PHP :  7.0.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `stagel3`
--

-- --------------------------------------------------------

--
-- Structure de la table `admin`
--

DROP TABLE IF EXISTS `admin`;
CREATE TABLE IF NOT EXISTS `admin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `username_canonical` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email_canonical` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `enabled` tinyint(1) NOT NULL,
  `salt` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `last_login` datetime DEFAULT NULL,
  `locked` tinyint(1) NOT NULL,
  `expired` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL,
  `confirmation_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `password_requested_at` datetime DEFAULT NULL,
  `roles` longtext COLLATE utf8_unicode_ci NOT NULL COMMENT '(DC2Type:array)',
  `credentials_expired` tinyint(1) NOT NULL,
  `credentials_expire_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_880E0D7692FC23A8` (`username_canonical`),
  UNIQUE KEY `UNIQ_880E0D76A0D96FBF` (`email_canonical`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `categorie`
--

DROP TABLE IF EXISTS `categorie`;
CREATE TABLE IF NOT EXISTS `categorie` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `libelle` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `categorie`
--

INSERT INTO `categorie` (`id`, `libelle`, `description`) VALUES
(1, 'Service à la personne', 'catégorie du service à la personne'),
(2, 'Aide Ménagère', 'Catégorie pour les aides en tous genre'),
(3, 'Cours Particulier', 'Catégorie pour les cours particuliers ');

-- --------------------------------------------------------

--
-- Structure de la table `conversation`
--

DROP TABLE IF EXISTS `conversation`;
CREATE TABLE IF NOT EXISTS `conversation` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `Inscrit_id1` int(11) DEFAULT NULL,
  `Inscrit_id2` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_8A8E26E9429F6250` (`Inscrit_id1`),
  KEY `IDX_8A8E26E9DB9633EA` (`Inscrit_id2`)
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `discute`
--

DROP TABLE IF EXISTS `discute`;
CREATE TABLE IF NOT EXISTS `discute` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `evaluation`
--

DROP TABLE IF EXISTS `evaluation`;
CREATE TABLE IF NOT EXISTS `evaluation` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `note` int(11) NOT NULL,
  `commentaire` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `Inscrit_id_notant` int(11) DEFAULT NULL,
  `Inscrit_id_note` int(11) DEFAULT NULL,
  `Service_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_1323A5753BC8F9FB` (`Inscrit_id_notant`),
  KEY `IDX_1323A5757EA95BD` (`Inscrit_id_note`),
  KEY `IDX_1323A575A201AA36` (`Service_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `inscrit`
--

DROP TABLE IF EXISTS `inscrit`;
CREATE TABLE IF NOT EXISTS `inscrit` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `username_canonical` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email_canonical` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `enabled` tinyint(1) NOT NULL,
  `salt` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `last_login` datetime DEFAULT NULL,
  `locked` tinyint(1) NOT NULL,
  `expired` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL,
  `confirmation_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `password_requested_at` datetime DEFAULT NULL,
  `roles` longtext COLLATE utf8_unicode_ci NOT NULL COMMENT '(DC2Type:array)',
  `credentials_expired` tinyint(1) NOT NULL,
  `credentials_expire_at` datetime DEFAULT NULL,
  `nom` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `prenom` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `date_de_naissance` date DEFAULT NULL,
  `adresse` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_5DC29AF992FC23A8` (`username_canonical`),
  UNIQUE KEY `UNIQ_5DC29AF9A0D96FBF` (`email_canonical`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `inscrit`
--

INSERT INTO `inscrit` (`id`, `username`, `username_canonical`, `email`, `email_canonical`, `enabled`, `salt`, `password`, `last_login`, `locked`, `expired`, `expires_at`, `confirmation_token`, `password_requested_at`, `roles`, `credentials_expired`, `credentials_expire_at`, `nom`, `prenom`, `date_de_naissance`, `adresse`) VALUES
(4, 'johnDoe', 'johndoe', 'jdoe@gmail.com', 'jdoe@gmail.com', 1, 'hkclzp2eklk40k0ko8kk4kc40ogcss8', '$2y$13$hkclzp2eklk40k0ko8kk4epTSD.wedtceXvcRXM8sszbnRw5ng/tC', '2016-06-12 22:30:51', 0, 0, NULL, NULL, NULL, 'a:0:{}', 0, NULL, NULL, NULL, NULL, NULL),
(5, 'janneDoe', 'jannedoe', 'jadoe@gmail.com', 'jadoe@gmail.com', 1, '3lp5vxa4dc84kgok4goskkkkg0sgw04', '$2y$13$3lp5vxa4dc84kgok4goskeTFP.xGfxJx6BgDsXZ4xK1qfDskNkmoG', '2016-06-09 13:39:42', 0, 0, NULL, NULL, NULL, 'a:0:{}', 0, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `message`
--

DROP TABLE IF EXISTS `message`;
CREATE TABLE IF NOT EXISTS `message` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `contenu` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `Conversation_id` int(11) DEFAULT NULL,
  `Inscrit_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_B6BD307F81693D08` (`Conversation_id`),
  KEY `IDX_B6BD307F22904C3E` (`Inscrit_id`)
) ENGINE=InnoDB AUTO_INCREMENT=50 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `reponse`
--

DROP TABLE IF EXISTS `reponse`;
CREATE TABLE IF NOT EXISTS `reponse` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `dateRendezVous` date DEFAULT NULL,
  `etat` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `Inscrit_id` int(11) DEFAULT NULL,
  `Service_id` int(11) DEFAULT NULL,
  `Conversation_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_5FB6DEC781693D08` (`Conversation_id`),
  KEY `IDX_5FB6DEC722904C3E` (`Inscrit_id`),
  KEY `IDX_5FB6DEC7A201AA36` (`Service_id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `service`
--

DROP TABLE IF EXISTS `service`;
CREATE TABLE IF NOT EXISTS `service` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `titre` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `debut` date NOT NULL,
  `fin` date NOT NULL,
  `type` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `lieu` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `distance` double NOT NULL,
  `Inscrit_id` int(11) DEFAULT NULL,
  `SousCategorie_id` int(11) DEFAULT NULL,
  `adresse` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_E19D9AD222904C3E` (`Inscrit_id`),
  KEY `IDX_E19D9AD2AD7F8665` (`SousCategorie_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `sous_categorie`
--

DROP TABLE IF EXISTS `sous_categorie`;
CREATE TABLE IF NOT EXISTS `sous_categorie` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `libelle` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `Categorie_id` int(11) DEFAULT NULL,
  `icone` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_52743D7BA4D60759` (`libelle`),
  KEY `IDX_52743D7BA4C43CD5` (`Categorie_id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `sous_categorie`
--

INSERT INTO `sous_categorie` (`id`, `libelle`, `description`, `Categorie_id`, `icone`) VALUES
(8, 'Babysitting', 'pour les services de babysitting', 1, 'babysitting.png'),
(9, 'Activité Enfant', 'services d''activité pour les enfants', 1, 'activiteEnfant.png'),
(10, 'Repassage', 'service de repassage de vetements', 2, 'repassage.png'),
(11, 'Vaisselle', 'services de vaisselle', 2, 'vaisselle.png'),
(12, 'Maths', 'Cours de maths', 3, 'math.png'),
(13, 'Français', 'cours de français', 3, 'francais.png');

-- --------------------------------------------------------

--
-- Structure de la table `suggestion_categorie`
--

DROP TABLE IF EXISTS `suggestion_categorie`;
CREATE TABLE IF NOT EXISTS `suggestion_categorie` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `libelle` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `Inscrit_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_EDFB1536A4D60759` (`libelle`),
  KEY `IDX_EDFB153622904C3E` (`Inscrit_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `conversation`
--
ALTER TABLE `conversation`
  ADD CONSTRAINT `FK_8A8E26E9429F6250` FOREIGN KEY (`Inscrit_id1`) REFERENCES `inscrit` (`id`),
  ADD CONSTRAINT `FK_8A8E26E9DB9633EA` FOREIGN KEY (`Inscrit_id2`) REFERENCES `inscrit` (`id`);

--
-- Contraintes pour la table `evaluation`
--
ALTER TABLE `evaluation`
  ADD CONSTRAINT `FK_1323A5753BC8F9FB` FOREIGN KEY (`Inscrit_id_notant`) REFERENCES `inscrit` (`id`),
  ADD CONSTRAINT `FK_1323A5757EA95BD` FOREIGN KEY (`Inscrit_id_note`) REFERENCES `inscrit` (`id`),
  ADD CONSTRAINT `FK_1323A575A201AA36` FOREIGN KEY (`Service_id`) REFERENCES `service` (`id`);

--
-- Contraintes pour la table `message`
--
ALTER TABLE `message`
  ADD CONSTRAINT `FK_B6BD307F22904C3E` FOREIGN KEY (`Inscrit_id`) REFERENCES `inscrit` (`id`),
  ADD CONSTRAINT `FK_B6BD307F81693D08` FOREIGN KEY (`Conversation_id`) REFERENCES `conversation` (`id`);

--
-- Contraintes pour la table `reponse`
--
ALTER TABLE `reponse`
  ADD CONSTRAINT `FK_5FB6DEC722904C3E` FOREIGN KEY (`Inscrit_id`) REFERENCES `inscrit` (`id`),
  ADD CONSTRAINT `FK_5FB6DEC781693D08` FOREIGN KEY (`Conversation_id`) REFERENCES `conversation` (`id`),
  ADD CONSTRAINT `FK_5FB6DEC7A201AA36` FOREIGN KEY (`Service_id`) REFERENCES `service` (`id`);

--
-- Contraintes pour la table `service`
--
ALTER TABLE `service`
  ADD CONSTRAINT `FK_E19D9AD222904C3E` FOREIGN KEY (`Inscrit_id`) REFERENCES `inscrit` (`id`),
  ADD CONSTRAINT `FK_E19D9AD2AD7F8665` FOREIGN KEY (`SousCategorie_id`) REFERENCES `sous_categorie` (`id`);

--
-- Contraintes pour la table `sous_categorie`
--
ALTER TABLE `sous_categorie`
  ADD CONSTRAINT `FK_52743D7BA4C43CD5` FOREIGN KEY (`Categorie_id`) REFERENCES `categorie` (`id`);

--
-- Contraintes pour la table `suggestion_categorie`
--
ALTER TABLE `suggestion_categorie`
  ADD CONSTRAINT `FK_EDFB153622904C3E` FOREIGN KEY (`Inscrit_id`) REFERENCES `inscrit` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
