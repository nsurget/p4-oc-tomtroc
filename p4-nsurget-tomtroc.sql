-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3307
-- Généré le : mer. 10 déc. 2025 à 14:26
-- Version du serveur : 10.11.2-MariaDB-1:10.11.2+maria~ubu2204
-- Version de PHP : 8.1.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `p4-nsurget-tomtroc`
--

-- --------------------------------------------------------

--
-- Structure de la table `authors`
--

CREATE TABLE `authors` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `authors`
--

INSERT INTO `authors` (`id`, `name`) VALUES
(3, 'Arthur Conan Doyle'),
(2, 'J.J.R Tolkien'),
(1, 'Victor Hugo');

-- --------------------------------------------------------

--
-- Structure de la table `books`
--

CREATE TABLE `books` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `availability` varchar(255) NOT NULL DEFAULT 'unavailable',
  `url_image` varchar(255) DEFAULT NULL,
  `author_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `books`
--

INSERT INTO `books` (`id`, `title`, `description`, `availability`, `url_image`, `author_id`, `user_id`, `created_at`) VALUES
(2, 'Le Seigneur des Anneaux : La Communauté de l\'Anneau', 'Le début du voyage de Frodon pour détruire l\'Anneau Unique. test', 'available', NULL, 2, 1, '2025-11-07 09:12:06'),
(5, 'Le Chien des Baskerville', 'Une sombre malédiction semble frapper la famille Baskerville, résidant dans l\'ancien manoir familial, isolé au cœur d\'une lande désolée. La légende raconte qu\'à l\'apparition d\'un monstrueux chien-démon, la mort n\'est pas loin. Le mystérieux et soudain décès de Sir Charles Baskerville, ainsi que les cris sinistres s\'élevant parfois du marais de Grimpen, semblent confirmer cette terrifiante tradition. À peine arrivé de Londres, en provenance du Canada, Sir Henry Baskerville, l\'unique successeur de Sir Charles, reçoit une lettre anonyme l\'avertissant : \"Pour votre propre sécurité et santé mentale, restez loin de la lande.\"', 'available', NULL, 3, 1, '2025-12-10 11:38:51');

-- --------------------------------------------------------

--
-- Structure de la table `discussions`
--

CREATE TABLE `discussions` (
  `id` int(11) NOT NULL,
  `user_1_id` int(11) NOT NULL,
  `user_2_id` int(11) NOT NULL,
  `new_messages_count_user_1` int(11) NOT NULL DEFAULT 0,
  `new_messages_count_user_2` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `discussions`
--

INSERT INTO `discussions` (`id`, `user_1_id`, `user_2_id`, `new_messages_count_user_1`, `new_messages_count_user_2`) VALUES
(9, 1, 7, 2, 0);

-- --------------------------------------------------------

--
-- Structure de la table `messages`
--

CREATE TABLE `messages` (
  `id` int(11) NOT NULL,
  `discussion_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `content` text NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `messages`
--

INSERT INTO `messages` (`id`, `discussion_id`, `user_id`, `content`, `created_at`) VALUES
(31, 9, 7, 'Bonjour nsurget', '2025-12-10 14:22:00'),
(32, 9, 7, 'Le Chien des Baskerville est toujours disponible ?', '2025-12-10 14:22:24');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `pseudo` varchar(100) NOT NULL,
  `profil_picture` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `email`, `password`, `pseudo`, `profil_picture`, `created_at`) VALUES
(1, 'ncsrgt@gmail.com', '$2y$10$zb4Q311W04PcwTpm7ljVWuaJNMirWyG9iTE2/eRwo8bHafXrnBNeG', 'nsurget', NULL, '2025-11-07 12:39:43'),
(7, 'tom@tom.tom', '$2y$10$rIJs3Ha5FgAvJMi2nFtb/OuIngAkzwViVmE1wJfEPl6rOE.M.Ts1O', 'Tom', NULL, '2025-12-10 13:36:27');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `authors`
--
ALTER TABLE `authors`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Index pour la table `books`
--
ALTER TABLE `books`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_book_author` (`author_id`),
  ADD KEY `fk_book_user` (`user_id`);

--
-- Index pour la table `discussions`
--
ALTER TABLE `discussions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_discussion_user_1` (`user_1_id`),
  ADD KEY `fk_discussion_user_2` (`user_2_id`);

--
-- Index pour la table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_message_discussion` (`discussion_id`),
  ADD KEY `fk_message_user` (`user_id`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `pseudo` (`pseudo`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `authors`
--
ALTER TABLE `authors`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `books`
--
ALTER TABLE `books`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `discussions`
--
ALTER TABLE `discussions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT pour la table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `books`
--
ALTER TABLE `books`
  ADD CONSTRAINT `fk_book_author` FOREIGN KEY (`author_id`) REFERENCES `authors` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_book_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `discussions`
--
ALTER TABLE `discussions`
  ADD CONSTRAINT `fk_discussion_user_1` FOREIGN KEY (`user_1_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `fk_discussion_user_2` FOREIGN KEY (`user_2_id`) REFERENCES `users` (`id`);

--
-- Contraintes pour la table `messages`
--
ALTER TABLE `messages`
  ADD CONSTRAINT `fk_message_discussion` FOREIGN KEY (`discussion_id`) REFERENCES `discussions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_message_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
