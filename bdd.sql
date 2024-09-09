-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : sam. 07 sep. 2024 à 13:45
-- Version du serveur : 8.0.31
-- Version de PHP : 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `mnsbuggywapp`
--

-- --------------------------------------------------------

--
-- Structure de la table `mns_user`
--

DROP TABLE IF EXISTS `mns_user`;
CREATE TABLE IF NOT EXISTS `mns_user` (
  `id` int NOT NULL AUTO_INCREMENT,
  `firstname` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `lastname` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `email` varchar(150) COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `isadmin` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `mns_user`
--

INSERT INTO `mns_user` (`id`, `firstname`, `lastname`, `email`, `password`, `isadmin`) VALUES
(1, 'User', 'USER', 'user@user.fr', 'azerty', 0),
(2, 'Jean', 'Dupont', 'jean.dupont@example.com', 'motdepasse123', 0),
(3, 'Marie', 'Martin', 'marie.martin@example.com', 'passsécurisé456', 0),
(4, 'Michel', 'Durand', 'michel.durand@example.com', 'passe789', 1),
(5, 'Émilie', 'Leroy', 'emilie.leroy@example.com', 'monmotdepasse', 0),
(6, 'Robert', 'Moreau', 'robert.moreau@example.com', 'passemorerobert', 0),
(7, 'John', 'DOE', 'john.doe@email.fr', 'azertyuiop', 0),
(12, 'Admin', 'ADMIN', 'admin@admin.fr', 'adminTracker123', 1);

-- --------------------------------------------------------

--
-- Structure de la table `ticket`
--

DROP TABLE IF EXISTS `ticket`;
CREATE TABLE IF NOT EXISTS `ticket` (
  `id` int NOT NULL AUTO_INCREMENT,
  `title` varchar(150) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `content` text COLLATE utf8mb4_general_ci,
  `createdat` datetime DEFAULT NULL,
  `openedat` datetime DEFAULT NULL,
  `closedat` datetime DEFAULT NULL,
  `type_id` int DEFAULT NULL,
  `user_id` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `type_id` (`type_id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `ticket`
--

INSERT INTO `ticket` (`id`, `title`, `content`, `createdat`, `openedat`, `closedat`, `type_id`, `user_id`) VALUES
(1, 'Erreur sur la page de connexion', 'La page de connexion affiche une erreur lors de la soumission du formulaire.', '2024-09-01 10:15:00', '2024-09-01 11:00:00', NULL, 1, 2),
(2, 'Ajouter un mode sombre', 'Ce serait bien d\'avoir un mode sombre pour l\'application.', '2024-08-25 09:45:00', NULL, NULL, 2, 3),
(3, 'Paiement non traité', 'J\'ai essayé de faire un paiement mais il a échoué.', '2024-09-03 14:30:00', NULL, NULL, 4, 4),
(4, 'L\'application plante', 'L\'application mobile plante quand j\'ouvre le tableau de bord.', '2024-09-04 08:50:00', NULL, NULL, 1, 5),
(5, 'Problème de mise à niveau d\'abonnement', 'Je n\'arrive pas à mettre à niveau mon abonnement.', '2024-09-05 16:10:00', NULL, NULL, 4, 6);

-- --------------------------------------------------------

--
-- Structure de la table `type`
--

DROP TABLE IF EXISTS `type`;
CREATE TABLE IF NOT EXISTS `type` (
  `id` int NOT NULL AUTO_INCREMENT,
  `label` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `color` varchar(7) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `type`
--

INSERT INTO `type` (`id`, `label`, `color`) VALUES
(1, 'Rapport de bug', '#FF0000'),
(2, 'Demande de fonctionnalité', '#00FF00'),
(3, 'Support technique', '#0000FF'),
(4, 'Problème de facturation', '#FFA500'),
(5, 'Demande générale', '#808080');

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `ticket`
--
ALTER TABLE `ticket`
  ADD CONSTRAINT `ticket_ibfk_1` FOREIGN KEY (`type_id`) REFERENCES `type` (`id`),
  ADD CONSTRAINT `ticket_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `mns_user` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
