-- phpMyAdmin SQL Dump
-- version 4.5.2
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Ven 01 Juillet 2016 à 13:39
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

--
-- Contenu de la table `categorie`
--

INSERT INTO `categorie` (`id`, `libelle`, `description`) VALUES
(1, 'Service à la personne', 'catégorie du service à la personne'),
(2, 'Aide Ménagère', 'Catégorie pour les aides en tous genre'),
(3, 'Cours Particulier', 'Catégorie pour les cours particuliers ');

--
-- Contenu de la table `conversation`
--

INSERT INTO `conversation` (`id`, `Inscrit_id1`, `Inscrit_id2`) VALUES
(1, 4, 5),
(2, 5, 4),
(3, 4, 5),
(4, 5, 4);

--
-- Contenu de la table `evaluation`
--

INSERT INTO `evaluation` (`id`, `note`, `commentaire`, `Inscrit_id_notant`, `Inscrit_id_note`, `Reponse_id`) VALUES
(1, 3, 'sympa', 5, 4, 1),
(2, 5, 'génial', 4, 5, 1),
(3, 5, 'très gentil', 4, 5, 3),
(4, 5, 'Vaisselle nickel', 5, 4, 3),
(5, 5, 'travailleur ', 5, 4, 4),
(6, 5, 'très pédagogue ', 4, 5, 4);

--
-- Contenu de la table `inscrit`
--

INSERT INTO `inscrit` (`id`, `username`, `username_canonical`, `email`, `email_canonical`, `enabled`, `salt`, `password`, `last_login`, `locked`, `expired`, `expires_at`, `confirmation_token`, `password_requested_at`, `roles`, `credentials_expired`, `credentials_expire_at`, `nom`, `prenom`, `date_de_naissance`, `adresse`) VALUES
(4, 'johnDoe', 'johndoe', 'jdoe@gmail.com', 'jdoe@gmail.com', 1, 'hkclzp2eklk40k0ko8kk4kc40ogcss8', '$2y$13$hkclzp2eklk40k0ko8kk4epTSD.wedtceXvcRXM8sszbnRw5ng/tC', '2016-06-29 11:32:32', 0, 0, NULL, NULL, NULL, 'a:0:{}', 0, NULL, NULL, NULL, NULL, NULL),
(5, 'janneDoe', 'jannedoe', 'jadoe@gmail.com', 'jadoe@gmail.com', 1, '3lp5vxa4dc84kgok4goskkkkg0sgw04', '$2y$13$3lp5vxa4dc84kgok4goskeTFP.xGfxJx6BgDsXZ4xK1qfDskNkmoG', '2016-06-22 09:53:05', 0, 0, NULL, NULL, NULL, 'a:0:{}', 0, NULL, 'Doe', 'Janne', '2016-06-17', '1 Rue de vendome, 45100 Orléans, France');

--
-- Contenu de la table `message`
--

INSERT INTO `message` (`id`, `contenu`, `Conversation_id`, `Inscrit_id`) VALUES
(1, 'test', 1, 5),
(2, 'ok ça marche', 1, 4),
(3, 'Bonjour je suis intéressé par des cours de français', 2, 4),
(4, 'j''aimerais votre aide', 3, 5),
(5, 'Je chercher quelqu''un pour m''aider pour les rattrapage du bac ', 4, 4);

--
-- Contenu de la table `reponse`
--

INSERT INTO `reponse` (`id`, `dateRendezVous`, `etat`, `Inscrit_id`, `Service_id`, `Conversation_id`) VALUES
(1, '2016-06-19', 'cloture', 5, 9, 1),
(2, '2016-06-20', 'notation', 4, 8, 2),
(3, '2016-06-27', 'cloture', 5, 10, 3),
(4, '2016-06-28', 'cloture', 4, 8, 4);

--
-- Contenu de la table `service`
--

INSERT INTO `service` (`id`, `titre`, `description`, `debut`, `fin`, `type`, `lieu`, `distance`, `Inscrit_id`, `SousCategorie_id`, `adresse`, `departement`) VALUES
(8, 'Cours de Français Lycée', 'Je propose des cours de français niveau seconde/première', '2016-06-10', '2016-06-30', 'propose', '48.86106148517996,2.352928159525618', 2, 5, 13, '41P Rue Saint-Martin, 75004 Paris, France', 'Paris'),
(9, 'Garde d''enfant', 'je me propose de garder des enfants', '2016-06-19', '2016-06-25', 'propose', '47.91146370044639,1.9076386000961065', 2, 4, 8, '5 Rue Philippe le Bel, 45000 Orléans, France', 'Loiret'),
(10, 'Aide repassage', 'Je peut vous aider dans votre repassage', '2016-06-24', '2016-06-27', 'propose', '47.8450372,1.9396829', 2, 4, 10, '31a Rue de Saint-Amand, 45100 Orléans, France', 'Loiret');

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

--
-- Contenu de la table `suggestion_categorie`
--

INSERT INTO `suggestion_categorie` (`id`, `libelle`, `description`, `Inscrit_id`, `categorie`) VALUES
(1, 'bricolage', 'test', 5, NULL),
(2, 'pattate dans la gueulle', 't''as bien compris', 5, '0'),
(3, 'azfzefezf', 'erferfergerrtnh', 5, 'Aide Ménagère');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
