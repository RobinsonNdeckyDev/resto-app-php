-- Création de la BDD
CREATE DATABASE IF NOT EXISTS `sen_recettes`;
USE `sen_recettes`;

-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
-- Hôte : 127.0.0.1
-- Généré le : dim. 13 oct. 2024 à 17:30
-- Version du serveur : 10.4.32-MariaDB
-- Version de PHP : 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

-- Base de données : `sen_recettes`

-- Structure de la table `comments`
CREATE TABLE `comments` (
  `comment_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `comment` text NOT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `created_by` int(11) DEFAULT NULL,
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_by` int(11) DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci COMMENT='Table des commentaires';

-- Structure de la table `recipes`
CREATE TABLE `recipes` (
  `recipe_id` int(11) NOT NULL,
  `title` varchar(128) NOT NULL,
  `recipe` text NOT NULL,
  `author` varchar(255) NOT NULL,
  `is_enabled` tinyint(1) NOT NULL,
  `image_path` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `created_by` int(11) DEFAULT NULL,
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_by` int(11) DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci COMMENT='Table des recettes';

-- Déchargement des données de la table `recipes`
INSERT INTO `recipes` (`recipe_id`, `title`, `recipe`, `author`, `is_enabled`, `image_path`, `created_at`, `created_by`, `updated_at`, `updated_by`, `deleted_at`, `deleted_by`) VALUES
(1, 'Cassoulet', 'Le cassoulet est une spécialité régionale du Languedoc...', 'mickael.andrieu@exemple.com', 1, NULL, '2024-10-13 00:42:30', NULL, '2024-10-13 00:42:30', NULL, NULL, NULL),
(2, 'Couscous', 'Le couscous est d\'une part une semoule...', 'mickael.andrieu@exemple.com', 0, NULL, '2024-10-13 00:42:30', NULL, '2024-10-13 00:42:30', NULL, NULL, NULL),
(3, 'Escalope milanaise', 'L\'escalope à la milanaise...', 'mathieu.nebra@exemple.com', 1, NULL, '2024-10-13 00:42:30', NULL, '2024-10-13 00:42:30', NULL, NULL, NULL),
(4, 'Salade Romaine', 'La salade César est une recette de cuisine...', 'laurene.castor@exemple.com', 0, NULL, '2024-10-13 00:42:30', NULL, '2024-10-13 00:42:30', NULL, NULL, NULL);

-- Structure de la table `users`
CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `prenom` varchar(64) NOT NULL,
  `nom` varchar(64) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `age` int(11) NOT NULL,
  `image_path` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `created_by` int(11) DEFAULT NULL,
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_by` int(11) DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci COMMENT='Table des utilisateurs';

-- Déchargement des données de la table `users`
INSERT INTO `users` (`user_id`, `prenom`, `nom`, `email`, `password`, `age`, `image_path`, `created_at`, `created_by`, `updated_at`, `updated_by`, `deleted_at`, `deleted_by`) VALUES
(1, 'Mickaël', 'Andrieu', 'mickael.andrieu@exemple.com', 'devine', 34, NULL, '2024-10-13 00:42:30', NULL, '2024-10-13 00:42:30', NULL, NULL, NULL),
(2, 'Mathieu', 'Nebra', 'mathieu.nebra@exemple.com', 'MiamMiam', 34, NULL, '2024-10-13 00:42:30', NULL, '2024-10-13 00:42:30', NULL, NULL, NULL),
(3, 'Laurène', 'Castor', 'laurene.castor@exemple.com', 'laCasto28', 28, NULL, '2024-10-13 00:42:30', NULL, '2024-10-13 00:42:30', NULL, NULL, NULL);

-- Index pour les tables déchargées
ALTER TABLE `comments` ADD PRIMARY KEY (`comment_id`);
ALTER TABLE `recipes` ADD PRIMARY KEY (`recipe_id`);
ALTER TABLE `users` ADD PRIMARY KEY (`user_id`);

-- AUTO_INCREMENT pour les tables déchargées
ALTER TABLE `comments` MODIFY `comment_id` int(11) NOT NULL AUTO_INCREMENT;
ALTER TABLE `recipes` MODIFY `recipe_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
ALTER TABLE `users` MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

COMMIT;
