-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : dim. 05 sep. 2021 à 11:42
-- Version du serveur : 10.4.20-MariaDB
-- Version de PHP : 8.0.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `lacarte`
--

-- --------------------------------------------------------

--
-- Structure de la table `categorie`
--

CREATE TABLE `categorie` (
  `id` int(11) NOT NULL,
  `nom` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `categorie`
--

INSERT INTO `categorie` (`id`, `nom`, `image`, `updated_at`) VALUES
(1, 'Entrées', 'gourmet-5619887_1920.jpg', '2021-09-01 21:33:01'),
(2, 'Salades', 'caesar-salad-1629534_1920.jpg', '2021-09-01 21:34:29'),
(3, 'Pâtes', 'pasta-2776645_1920.jpg', '2021-09-01 21:35:50'),
(4, 'Risttos', 'risotto-1126412_1920.jpg', '2021-09-01 21:36:26'),
(5, 'Pizza', 'pizza-386717_1920.jpg', '2021-09-01 21:37:03');

-- --------------------------------------------------------

--
-- Structure de la table `doctrine_migration_versions`
--

CREATE TABLE `doctrine_migration_versions` (
  `version` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `executed_at` datetime DEFAULT NULL,
  `execution_time` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `doctrine_migration_versions`
--

INSERT INTO `doctrine_migration_versions` (`version`, `executed_at`, `execution_time`) VALUES
('DoctrineMigrations\\Version20210901061929', '2021-09-01 08:19:37', 255),
('DoctrineMigrations\\Version20210901065540', '2021-09-01 08:55:47', 40),
('DoctrineMigrations\\Version20210901070037', '2021-09-01 09:00:40', 34),
('DoctrineMigrations\\Version20210901185826', '2021-09-01 20:58:39', 134);

-- --------------------------------------------------------

--
-- Structure de la table `gallerie`
--

CREATE TABLE `gallerie` (
  `id` int(11) NOT NULL,
  `image` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `update_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `gallerie`
--

INSERT INTO `gallerie` (`id`, `image`, `update_at`) VALUES
(3, 'pizza-3010062_1920.jpg', NULL),
(4, 'dough-943245_1920.jpg', NULL),
(5, 'pizza-329523_1920.jpg', NULL),
(6, 'sleep-2243286_1920.jpg', NULL),
(7, 'food-2121826_1920.jpg', NULL),
(8, 'spaghetti-237907_1920.jpg', NULL),
(9, 'spaghetti-1987454_1920.jpg', NULL),
(10, 'pizza-5275191_1920.jpg', NULL),
(11, 'pizza-oven-2537308_1920.jpg', NULL),
(12, 'pizza-744405_1920.jpg', NULL),
(13, 'risotto-6568385_1920.jpg', NULL),
(14, 'salad-1672505_1920.jpg', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `menu`
--

CREATE TABLE `menu` (
  `id` int(11) NOT NULL,
  `categorie_id` int(11) DEFAULT NULL,
  `nom` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `allergene` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `prix` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `menu`
--

INSERT INTO `menu` (`id`, `categorie_id`, `nom`, `image`, `description`, `allergene`, `prix`, `updated_at`) VALUES
(1, 5, 'Margarita', 'pizza-5275191_1920.jpg', 'basilic / mozzarella / sauce tomate', 'Glutten', '1.00', '2021-09-01 21:38:39'),
(2, 3, 'Lasagne', 'lasagne-1178514_1920.jpg', 'béchamel / Bolognaise / mozzarella / parmesan', 'lait', '12.90', '2021-09-01 21:52:04'),
(3, 3, 'Spaghetti alla bolognaise', 'spaghetti-1987454_1920.jpg', 'sauce tomate / viande de boeuf hachée  / mijotée', NULL, '12.50', '2021-09-01 21:53:32'),
(4, 3, 'Penne vegetariano', 'sleep-2243286_1920.jpg', 'légumes du marché / sauce tomate', NULL, '10.50', '2021-09-01 21:54:25'),
(5, 3, 'Spaghetti frutti di mare', 'pasta-2436229_1920.jpg', 'calamars / Crevettes / Moules / Palourdes / tomates cerises', NULL, '15.00', '2021-09-01 21:55:28'),
(6, 3, 'Penne aux truffes', 'pasta-2776645_1920.jpg', 'champignons / crème de truffe noir', NULL, '15.00', '2021-09-01 22:11:33'),
(7, 3, 'Tagliatelles au saumon', 'tagliatelle-1970588_1920.jpg', 'ciboulette / crème fraîche / Saumon / Épinards', NULL, '12.90', '2021-09-01 21:59:44'),
(8, 4, 'Risotto aux crevettes', 'rice-6319050_1920.jpg', 'Riz / Asperges vertes / Oignons / Crevettes', NULL, '14.00', '2021-09-01 22:12:08'),
(9, 4, 'Risotto aux fruits de mer', 'risotto-6568385_1920.jpg', 'Fruits de mer / Riz /  crevettes décortiquées / Oignons  / Tomates', NULL, '14.00', '2021-09-01 22:06:58'),
(10, 4, 'Ristto au chévre', 'risotto-1126412_1920.jpg', 'Riz / Tomates frais / Chèvre', 'lait', '14.00', '2021-09-01 22:09:34');

-- --------------------------------------------------------

--
-- Structure de la table `reservation`
--

CREATE TABLE `reservation` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `nom` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `prenom` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `telephone` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date` date NOT NULL,
  `nombre_de_personnes` int(11) NOT NULL,
  `message` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `heure` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `reservation`
--

INSERT INTO `reservation` (`id`, `user_id`, `nom`, `prenom`, `email`, `telephone`, `date`, `nombre_de_personnes`, `message`, `heure`) VALUES
(3, NULL, 'toto', 'toto', 'lyna@gmail.com', '012345678', '2021-09-24', 2, 'bfvfv', '1'),
(4, NULL, 'toto', 'toto', 'lyna@gmail.com', '012345678', '2021-09-24', 2, 'bfvfv', '1'),
(5, NULL, 'toto', 'toto', 'lyna@gmail.com', '012345678', '2021-09-24', 2, 'bfvfv', '1'),
(8, NULL, 'bacha', 'nona', 'lyna@gmail.com', '012345678', '2021-09-13', 2, 'coucou', '1'),
(9, NULL, 'bacha', 'nona', 'lyna@gmail.com', '012345678', '2021-09-13', 2, 'coucou', '1'),
(10, NULL, 'bacha', 'nona', 'lyna@gmail.com', '012345678', '2021-09-13', 2, 'coucou', '1');

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `email` varchar(180) COLLATE utf8mb4_unicode_ci NOT NULL,
  `roles` longtext COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '(DC2Type:json)',
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nom` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `prenom` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `email`, `roles`, `password`, `nom`, `prenom`) VALUES
(1, 'lyna@gmail.com', '[]', '$argon2id$v=19$m=65536,t=4,p=1$U3hBa2lnOUM0d3ZockkvRw$AG1RqfaK0r6tWKIvzwomQH1bt21RsqPbO2kVq/cFSq0', 'Bacha', 'Lyna'),
(2, 'lydia@gmail.com', '[\"ROLE_ADMIN\"]', '$argon2id$v=19$m=65536,t=4,p=1$SHNGb1V2ejlVMXFUbzhoRg$IXEdWkqohOi78vvNeg+/u+BloKkAC9jRaq45A6fJ4HU', 'Bacha', 'Lydia'),
(5, 'toto@g', '[]', '$argon2id$v=19$m=65536,t=4,p=1$d3JVUjBhbkt2UXY4am1KRw$0dehFNlWZllgY7UMmse74+L8p5dt05J1b6nBvmdGzVE', 'totot', 'toto');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `categorie`
--
ALTER TABLE `categorie`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `doctrine_migration_versions`
--
ALTER TABLE `doctrine_migration_versions`
  ADD PRIMARY KEY (`version`);

--
-- Index pour la table `gallerie`
--
ALTER TABLE `gallerie`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_7D053A93BCF5E72D` (`categorie_id`);

--
-- Index pour la table `reservation`
--
ALTER TABLE `reservation`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_42C84955A76ED395` (`user_id`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_8D93D649E7927C74` (`email`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `categorie`
--
ALTER TABLE `categorie`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `gallerie`
--
ALTER TABLE `gallerie`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT pour la table `menu`
--
ALTER TABLE `menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT pour la table `reservation`
--
ALTER TABLE `reservation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `menu`
--
ALTER TABLE `menu`
  ADD CONSTRAINT `FK_7D053A93BCF5E72D` FOREIGN KEY (`categorie_id`) REFERENCES `categorie` (`id`);

--
-- Contraintes pour la table `reservation`
--
ALTER TABLE `reservation`
  ADD CONSTRAINT `FK_42C84955A76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
