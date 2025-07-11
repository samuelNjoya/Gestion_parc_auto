-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : ven. 11 juil. 2025 à 06:24
-- Version du serveur : 10.4.32-MariaDB
-- Version de PHP : 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `parc_auto`
--

-- --------------------------------------------------------

--
-- Structure de la table `affectation-vehecule`
--

CREATE TABLE `affectation-vehecule` (
  `id` int(11) NOT NULL,
  `conducteur_id` tinyint(11) NOT NULL,
  `vehicule_id` tinyint(11) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `date_debut` date NOT NULL,
  `date_fin` date NOT NULL,
  `statut` tinyint(4) NOT NULL DEFAULT 1 COMMENT '0:inactive;1:active',
  `is_delete` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0:no,1:yes',
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created_at` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `affectation-vehecule`
--

INSERT INTO `affectation-vehecule` (`id`, `conducteur_id`, `vehicule_id`, `description`, `date_debut`, `date_fin`, `statut`, `is_delete`, `updated_at`, `created_at`) VALUES
(1, 9, 3, 'pour une mission professionnelle', '2025-05-28', '2025-06-06', 1, 0, '2025-05-28 01:00:37', '2025-05-21'),
(2, 15, 4, 'pour une visite', '2025-06-30', '2025-08-16', 1, 0, '2025-07-10 18:31:31', '2025-05-27');

-- --------------------------------------------------------

--
-- Structure de la table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `conso_carburant`
--

CREATE TABLE `conso_carburant` (
  `id` int(11) NOT NULL,
  `created_by_id` tinyint(4) NOT NULL,
  `vehicule_id` int(11) NOT NULL,
  `date_conso` date NOT NULL,
  `quantite_conso` int(11) NOT NULL,
  `cout_conso` decimal(10,0) NOT NULL,
  `kilometrage_plein` int(11) NOT NULL,
  `note` varchar(255) DEFAULT NULL,
  `fournisseur_id` int(11) NOT NULL,
  `is_delete` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0:no,1:yes',
  `updated_at` datetime NOT NULL,
  `created_at` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `conso_carburant`
--

INSERT INTO `conso_carburant` (`id`, `created_by_id`, `vehicule_id`, `date_conso`, `quantite_conso`, `cout_conso`, `kilometrage_plein`, `note`, `fournisseur_id`, `is_delete`, `updated_at`, `created_at`) VALUES
(1, 1, 2, '2025-05-02', 12, 29000, 95000, '', 14, 0, '2025-05-25 22:18:42', '2025-05-17'),
(2, 1, 1, '2024-06-06', 28, 9855, 25500, '', 6, 0, '2025-05-28 10:28:00', '2025-05-17'),
(3, 8, 2, '2025-04-05', 24, 150000, 15000, '', 14, 0, '2025-05-28 09:54:02', '2025-05-19'),
(4, 1, 3, '2025-03-26', 15, 23000, 85000, '', 14, 0, '2025-05-28 09:38:28', '2025-05-26'),
(5, 1, 5, '2025-02-05', 15, 30000, 50000, '', 14, 0, '2025-05-28 09:51:32', '2025-05-28'),
(6, 3, 3, '2025-05-30', 12, 35000, 500000, '', 14, 0, '2025-05-30 21:28:18', '2025-05-30'),
(7, 1, 5, '2025-02-12', 12, 150000, 150000, '', 14, 0, '2025-07-10 20:17:36', '2025-05-31'),
(8, 1, 2, '2025-07-10', 18, 28950, 200000, '', 14, 0, '2025-07-10 19:58:33', '2025-07-10'),
(9, 1, 4, '2025-07-10', 28, 250000, 100020, '', 14, 0, '2025-07-10 20:01:19', '2025-07-10'),
(10, 1, 3, '2025-04-10', 14, 15000, 12000, '', 14, 0, '2025-07-10 20:16:33', '2025-07-10'),
(11, 1, 5, '2025-06-12', 150, 1458000, 100000, '', 14, 0, '2025-07-10 20:15:47', '2025-07-10');

-- --------------------------------------------------------

--
-- Structure de la table `document_vehicule`
--

CREATE TABLE `document_vehicule` (
  `id` int(11) NOT NULL,
  `vehicule_id` tinyint(4) NOT NULL,
  `created_by_id` int(11) NOT NULL,
  `type` varchar(255) NOT NULL,
  `date_derniere_mise_ajour` date DEFAULT NULL,
  `date_expiration` date DEFAULT NULL,
  `pdf_scan` varchar(255) DEFAULT NULL,
  `statut` int(11) NOT NULL DEFAULT 1 COMMENT '1:valide,0:expirer',
  `is_delete` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0:no,1:yes',
  `created_at` datetime NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `document_vehicule`
--

INSERT INTO `document_vehicule` (`id`, `vehicule_id`, `created_by_id`, `type`, `date_derniere_mise_ajour`, `date_expiration`, `pdf_scan`, `statut`, `is_delete`, `created_at`, `updated_at`) VALUES
(1, 2, 0, 'certificat d\'immatriculation', '2025-04-10', '2025-06-15', NULL, 1, 0, '2025-05-19 16:12:32', '2025-07-10 18:55:45'),
(2, 1, 0, 'carte_Grise', '2025-05-08', '2025-05-25', NULL, 1, 1, '2025-05-19 16:16:54', '2025-05-19 18:34:14'),
(3, 2, 0, 'certificat conformite', '2025-05-06', '2025-06-06', '20250519073357rgxhwkktbzastd62xiaw.pdf', 1, 0, '2025-05-19 16:35:14', '2025-07-10 18:51:34'),
(4, 2, 0, 'assurance automobile', '2025-05-01', '2025-05-06', NULL, 1, 0, '2025-05-19 16:43:53', '2025-07-10 18:54:47'),
(5, 1, 0, 'controle technique', '2025-05-30', '2025-06-30', NULL, 1, 0, '2025-05-19 16:47:45', '2025-07-10 18:51:11'),
(6, 2, 0, 'certificat conformite', '2025-05-24', '2025-07-24', '20250519050725kmprdouvvwne0goj8rok.pdf', 1, 0, '2025-05-19 17:07:25', '2025-07-10 18:50:23'),
(7, 5, 1, 'carte Grise', '2025-07-10', '2025-07-26', NULL, 1, 0, '2025-07-10 19:43:00', '2025-07-10 18:50:49');

-- --------------------------------------------------------

--
-- Structure de la table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `intervention_technique`
--

CREATE TABLE `intervention_technique` (
  `id` int(11) NOT NULL,
  `vehicule_id` int(11) NOT NULL,
  `created_by_id` int(11) DEFAULT NULL,
  `type` varchar(255) NOT NULL,
  `titre` varchar(255) NOT NULL,
  `date` date NOT NULL,
  `cout` decimal(10,0) NOT NULL,
  `description` varchar(255) NOT NULL,
  `kilometrage` int(250) NOT NULL,
  `fournisseur_id` tinyint(4) NOT NULL,
  `prochaine_date` date DEFAULT NULL,
  `frequence` varchar(255) DEFAULT NULL,
  `duree_imobilisation` int(11) DEFAULT NULL,
  `is_delete` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0:no,1:yes',
  `updated_at` datetime NOT NULL,
  `created_at` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `intervention_technique`
--

INSERT INTO `intervention_technique` (`id`, `vehicule_id`, `created_by_id`, `type`, `titre`, `date`, `cout`, `description`, `kilometrage`, `fournisseur_id`, `prochaine_date`, `frequence`, `duree_imobilisation`, `is_delete`, `updated_at`, `created_at`) VALUES
(1, 1, 18, 'entretien', 'mm', '2025-04-30', 12000, '', 14, 6, '2025-07-12', 'chaque moi', NULL, 0, '2025-05-28 02:36:37', '2025-05-21'),
(2, 2, NULL, 'maintenance', 'videnge', '2025-05-20', 15000, '', 15000, 6, NULL, '', 20, 0, '2025-05-21 09:41:22', '2025-05-21'),
(3, 1, NULL, 'maintenance', 'controle', '2025-05-26', 10000, '', 75000, 10, NULL, '', 15, 0, '2025-05-26 19:27:26', '2025-05-26'),
(4, 3, NULL, 'maintenance', 'controle panne', '2025-05-28', 13000, 'une panne technique', 96000, 10, NULL, '', 5, 0, '2025-05-28 14:35:41', '2025-05-28'),
(5, 1, 1, 'entretien', 'contole videnge', '2025-07-09', 50000, '', 100000, 10, '2025-07-12', '', NULL, 0, '2025-07-09 21:54:29', '2025-07-09'),
(6, 4, 17, 'entretien', 'contole videnge du vehicule', '2025-07-09', 15000, '', 100000, 10, '2025-07-12', 'tous les mois', NULL, 0, '2025-07-09 22:54:58', '2025-07-09');

-- --------------------------------------------------------

--
-- Structure de la table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1);

-- --------------------------------------------------------

--
-- Structure de la table `panne`
--

CREATE TABLE `panne` (
  `id` int(11) NOT NULL,
  `conducteur_id` tinyint(4) DEFAULT NULL,
  `affectation_id` tinyint(4) NOT NULL,
  `type` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `date_panne` date DEFAULT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `localisation` varchar(255) NOT NULL,
  `statut` tinyint(4) NOT NULL DEFAULT 1 COMMENT '1:attente,0:resolut',
  `kilometrage_panne` int(11) NOT NULL,
  `is_delete` tinyint(4) DEFAULT 0 COMMENT '0:no,1:yes',
  `created_at` datetime NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `panne`
--

INSERT INTO `panne` (`id`, `conducteur_id`, `affectation_id`, `type`, `description`, `date_panne`, `photo`, `localisation`, `statut`, `kilometrage_panne`, `is_delete`, `created_at`, `updated_at`) VALUES
(1, 9, 3, 'ent', '', '2025-06-12', NULL, 'dr', 1, 1000000, 0, '2025-06-12 12:35:16', '2025-06-12 16:46:47'),
(2, 9, 3, 'ze', 'le loisir des enfants', '2025-06-12', NULL, 'fgh', 1, 100000, 0, '2025-06-12 12:47:55', '2025-06-12 16:50:30'),
(3, 15, 4, 'main', 'le loisir des enfants', '2025-06-12', '20250612010406wvm4jfrhg2nuwc6pruhd.jpg', 'gop', 1, 10000, 0, '2025-06-12 13:04:06', '2025-06-12 16:47:03'),
(4, 9, 3, 'de', 'fff', '2025-06-05', NULL, 'ghj', 1, 100000, 0, '2025-06-14 08:36:05', '2025-06-14 08:37:57'),
(5, 9, 3, 'panne1', '', '2025-06-28', '20250614084834ssfsbxtqzmmt5urlsgam.png', 'B\'ssadi', 0, 100000, 0, '2025-06-14 08:48:34', '2025-07-10 19:50:28'),
(6, 11, 5, 'panne2', 'ddddddd', '2025-06-08', NULL, 'Akwa rue Arno', 1, 100000, 0, '2025-06-14 11:36:51', '2025-06-14 10:36:51');

-- --------------------------------------------------------

--
-- Structure de la table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `piece`
--

CREATE TABLE `piece` (
  `id` int(11) NOT NULL,
  `intervention_id` tinyint(4) NOT NULL,
  `nom` varchar(255) NOT NULL,
  `reference` varchar(255) NOT NULL,
  `date_installation` date NOT NULL,
  `date_expiration` date DEFAULT NULL,
  `cout_unitaire` decimal(10,0) NOT NULL,
  `quantite` int(11) DEFAULT NULL,
  `kilometrage_installation` bigint(20) DEFAULT NULL,
  `duree_vie` varchar(250) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `statut` tinyint(4) NOT NULL DEFAULT 1 COMMENT '1:actif,0:inactif',
  `is_delete` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0:no,1:yes',
  `created_at` datetime NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `piece`
--

INSERT INTO `piece` (`id`, `intervention_id`, `nom`, `reference`, `date_installation`, `date_expiration`, `cout_unitaire`, `quantite`, `kilometrage_installation`, `duree_vie`, `description`, `statut`, `is_delete`, `created_at`, `updated_at`) VALUES
(1, 2, 'roues', 'ert', '2025-06-06', '2025-06-21', 3000, 3, 20000, '2', '', 1, 0, '2025-06-06 15:21:51', '2025-06-06 20:09:20'),
(2, 4, 'roues', 'ER30-26', '2025-06-06', '2025-06-20', 1200, 2, 11000, '11', '', 1, 0, '2025-06-06 16:59:00', '2025-06-08 23:45:58'),
(3, 4, 'caisse', 'CRE', '2025-06-08', '2025-06-29', 1200, 2, 10000, '12', '', 1, 0, '2025-06-07 23:01:43', '2025-06-08 23:45:54'),
(4, 3, 'Nkono', 'CRE', '2025-06-08', '2025-06-12', 1200, 1, 22, '22', '', 1, 0, '2025-06-07 23:19:12', '2025-06-08 21:13:40'),
(5, 5, 'repa', 'erf', '2025-06-08', '2025-06-08', 500, 1, 12000, '12', '', 1, 0, '2025-06-07 23:31:18', '2025-06-07 23:59:41'),
(6, 2, 'hj', 'ty', '2025-07-08', '2025-07-31', 1800, 1, 100000000, '11', '', 1, 0, '2025-07-02 19:14:18', '2025-07-02 18:14:18');

-- --------------------------------------------------------

--
-- Structure de la table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('rrUANta7XyLaH9WuNgtdYs9d5Jghw9llHa7zE36p', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:140.0) Gecko/20100101 Firefox/140.0', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiYkZjWTlZMXJyZ1RZMGJBOE9mSjdFeW56OUZiRmVHNVRETHdscmxtbCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mzc6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9wYW5lbC9kYXNoYm9hcmQiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX1zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aToxO30=', 1752180641),
('Xs7JNDtSB97YyYNQU1U7EPa5PWCCnlWOyeciZtpJ', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:140.0) Gecko/20100101 Firefox/140.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiTWpUeWNGcGswdkxSNFp4UFRrV1pmMHQ2OGtxbFlDV3hVRHZBZUJDQSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODA4MCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1752204891);

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `created_by_id` tinyint(4) DEFAULT NULL,
  `nom` varchar(255) NOT NULL,
  `prenom` varchar(255) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `date_naiss` date DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `telephone` varchar(255) DEFAULT NULL,
  `num_permis` varchar(255) DEFAULT NULL,
  `type_permis` char(2) DEFAULT NULL,
  `date_exp_permis` date DEFAULT NULL,
  `formation` varchar(255) DEFAULT NULL,
  `profile_pic` varchar(255) DEFAULT NULL,
  `role` tinyint(4) NOT NULL COMMENT '1:admin,\r\n2:gestionnaire,\r\n3:comptable,\r\n4:conducteur,\r\n5:fournisseur',
  `statut` tinyint(11) NOT NULL DEFAULT 1 COMMENT '0:inactive,1:active',
  `is_delete` tinyint(11) NOT NULL DEFAULT 0 COMMENT '0:no,1:yes',
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `created_by_id`, `nom`, `prenom`, `email`, `email_verified_at`, `password`, `date_naiss`, `address`, `telephone`, `num_permis`, `type_permis`, `date_exp_permis`, `formation`, `profile_pic`, `role`, `statut`, `is_delete`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, NULL, 'admin', NULL, 'admin@gmail.com', NULL, '$2y$12$QA/mIX41oS727QXwgYhgxOqxVahMCaqVmLw4L9ypAqZ1u1P7No86.', NULL, '', '', NULL, NULL, NULL, NULL, '20250525100929brxagxeh5xubfogyy7qc.jpg', 1, 1, 0, '9F22eKEbZYVDvNlcYsdkKCMVvOMTQDkXdvpuiO8wlS2TlVrl6gok7qKBeY9l', '2025-05-16 02:12:51', '2025-05-25 21:09:29'),
(2, 1, 'Njoya', 'samuel', 'ad5@gmail.com', NULL, '$2y$12$ZKV7ec3qBfc81doqRjt/eek.PRvmBYvKkbgf2wlRTwbz8L83JPxti', '2025-05-08', 'frt', '690373513', NULL, NULL, NULL, NULL, NULL, 2, 1, 0, 'd4XMaFJKw9nTN6xWTxV1jMqkRoEi6bnz2CpwshxFmlQ72luDFlY0HFkkZqlM', '2025-05-13 19:22:45', '2025-05-13 19:22:45'),
(3, 1, 'Fifen', 'carelle', 'njoya@gmail.com', NULL, '$2y$12$HkiovZIugkyp/yI8kfeQHukoUjpumWV3sh7k6DZWAPyR.QsTbeZAi', '2025-06-08', 'Akwa', '6547869321', NULL, NULL, NULL, NULL, '20250514115122qorkttfgkuab0jh8d2mb.jpg', 2, 1, 0, 'HqVumxRqU7CBVTVdnuJQ3ZH0l82JMpdoiSTUfXIJGQFhyCkpOuZrlDFil3js', '2025-05-13 19:32:13', '2025-05-31 11:50:45'),
(4, 1, 'Fifen', 'samuel', 'carelles@gmail.com', NULL, '$2y$12$cleiu2kaPPrLMvsyIk/KMevs3ogOL.p.qlI86fe/xSSPEUFYYregm', '2025-05-04', 'rrrrrh47', '14477', NULL, NULL, NULL, NULL, NULL, 2, 1, 1, NULL, '2025-05-13 19:38:48', '2025-05-14 10:33:59'),
(5, 1, 'Njoya', 'carelle', 'florinda1@gmail.com', NULL, '$2y$12$zjTrn0bV1.efwzJf2sFr4eef1/k6963xQLdiZcnYl/zyjfeOT1Kei', '2025-05-03', 'akwa nord', '692256987', NULL, NULL, NULL, NULL, '20250514115046gyw30vwikdr3argt8qny.jpg', 2, 1, 0, NULL, '2025-05-13 20:27:29', '2025-05-14 10:50:46'),
(6, 1, 'Garage AutoPlus', 'garage de reparation', 'y@gmail.com', NULL, NULL, NULL, 'akwa nord valui', '692256987', NULL, NULL, NULL, NULL, NULL, 5, 1, 0, NULL, '2025-05-14 13:36:27', '2025-07-10 19:07:17'),
(7, 1, 'matrix', 'gims', 'matrix@gmail.com', NULL, '$2y$12$BcwqU8YYhcqY3b1xZItrFuR6qx90q40RB7V8J8qLZH3AvCSWqOjAi', '2025-05-09', 'Bepanda boulagerie la paix', '690345897', NULL, NULL, NULL, NULL, '20250515053739zw2w9nbjumbbwt5ldcew.jpg', 2, 1, 0, 'ADlOfTkjO06t7GccP1WW5PpfZ4xjPX7WXHgJs9mMZEh1kQdhOuyYbUvi4XNM', '2025-05-15 16:37:38', '2025-05-19 01:59:36'),
(8, 1, 'Njoya', 'monir', 'cardel@gmail.com', NULL, '$2y$12$8ldENl4wfg/HySbOdFo12u9iRA2gRl2HbUoxa2cyCpbQDnZb5q3MG', '2025-05-08', 'akwa nord', '+237690373513', 'huy', 'B', '2025-05-05', NULL, '20250516024825748gpazaujsvwubukgxz.jpg', 4, 1, 0, 'jETwv89x3P7GpRXNKOHJfCnp3Sb6idEp3SC0XCHy6S9aYGYwIvHV1kfsjOHw', '2025-05-16 01:48:25', '2025-05-19 17:38:29'),
(9, 1, 'Njikam', 'Nestor', 'Samuel12@gmail.com', NULL, '$2y$12$e2rL9o0Ke7e30Jum8AZvQewHiszelzaqmYSMevES0Te7H4zHnT5mG', '1996-05-12', '', '665457899', '14256658', '', '2026-05-12', NULL, NULL, 4, 1, 0, 'gqvukB052qz1HeneVcS2jEfsO8xzqxEaiDNcNYboyqSTMjRC9nUUdzS6kLwv', '2025-05-21 11:41:04', '2025-05-21 11:41:04'),
(10, 1, 'Speedy', 'Reparateur rapide', 'Samuelz12@gmail.com', NULL, NULL, NULL, '', '692256987', NULL, NULL, NULL, NULL, NULL, 5, 1, 0, NULL, '2025-05-21 11:42:41', '2025-07-10 19:18:58'),
(11, 1, 'Mr A', 'santos', 'MrA62@gmail.com', NULL, '$2y$12$pa/I3qsq2knRki18LAa1/.ItroorGpJpLsUe3NTonKATBRRPstZtm', '2025-05-07', 'Bepanda boulagerie la paix', '665457899', '14AE', 'D', '2026-05-22', NULL, NULL, 4, 1, 0, NULL, '2025-05-23 13:59:59', '2025-05-23 13:59:59'),
(12, 1, 'Dépannage Express', 'Depanage', 'express@gmail.com', NULL, NULL, NULL, 'Douala Rail', '', NULL, NULL, NULL, NULL, NULL, 5, 1, 0, NULL, '2025-05-24 21:00:02', '2025-07-10 19:47:56'),
(13, 1, 'TechAuto', 'Equipements', 'Equipements@gmail.com', NULL, NULL, NULL, '', '', NULL, NULL, NULL, NULL, NULL, 5, 1, 0, NULL, '2025-05-24 21:01:52', '2025-05-24 21:01:52'),
(14, 1, 'Station Shell', 'Douala', 'stations@gmail.com', NULL, NULL, NULL, 'Douala', '', NULL, NULL, NULL, NULL, NULL, 5, 1, 0, NULL, '2025-05-25 04:50:31', '2025-05-25 04:50:31'),
(15, 1, 'Nkono', 'morel', 'Nkono@gmail.com', NULL, '$2y$12$vnFit1S/tOBJ.kaLct9xguXZmRx0fK4H9Yl0RIW.MgL9AETOlBkQW', '1996-06-12', 'Doula B\'ssadi', '679693214', 'B987654321', 'C', '2025-05-24', NULL, NULL, 4, 1, 0, 'vkU1504pl6N0k1c4eEOZHcmbte1TTpOdBcBTYiIXAL7RM1DG3wGeS1X6Sg7G', '2025-05-26 11:40:38', '2025-05-26 11:43:23'),
(16, 1, 'Mr Compta', 'one', 'compta@gmail.com', NULL, '$2y$12$2MJ8You.HkYj4DplMNEZlOm6/FG7dxPM9LDMEfuRL2FTlWgs00YDe', '1986-05-07', 'Douala', '697257621', NULL, NULL, NULL, NULL, NULL, 3, 1, 0, 'aAYQHLaWSC0F2rEPo1rjrLOpbStMstx8JzFIfC5Ph2h2PvjouxMrrDpxVWPa', '2025-05-28 12:23:44', '2025-05-28 12:23:44'),
(17, 1, 'JOSUE', 'NELSON', 'josuenelson0@gmail.com', NULL, '$2y$12$iw/zdseEEXVkOXLMzRUG4Obk71cl3szXahjXBLRj.H/1naL02eN4S', '2000-07-09', 'Bonaberi', '', NULL, NULL, NULL, NULL, NULL, 2, 1, 0, 'hctnRTux4xRRDHgBMtxd0g8MGKW252oIwqtnVVQfeLlmswLlqqkkGD9ytP1v', '2025-07-09 21:36:15', '2025-07-09 21:36:15'),
(18, 1, 'NDAM', 'samuel', 'samuelnjoyarvt@gmail.com', NULL, '$2y$12$8yTMyIcu.I0M2CcF0KQtLeknab.osHTSXqG5bQ9q8K5HKaHw3LUDS', '2025-07-02', '', '', NULL, NULL, NULL, NULL, NULL, 2, 1, 0, NULL, '2025-07-09 21:41:45', '2025-07-09 21:41:45');

-- --------------------------------------------------------

--
-- Structure de la table `vehicule`
--

CREATE TABLE `vehicule` (
  `id` int(11) NOT NULL,
  `created_by_id` tinyint(4) NOT NULL,
  `immatriculation` varchar(255) NOT NULL,
  `marque` varchar(255) DEFAULT NULL,
  `modele` varchar(255) NOT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `kilometrage` int(255) NOT NULL,
  `type_carburant` varchar(255) DEFAULT NULL,
  `date_achat` date NOT NULL,
  `statut` tinyint(4) NOT NULL DEFAULT 1 COMMENT '1:active, 0:inactive',
  `departement` varchar(255) DEFAULT NULL,
  `is_delete` tinyint(4) DEFAULT 0 COMMENT '0:no, 1:yes',
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `vehicule`
--

INSERT INTO `vehicule` (`id`, `created_by_id`, `immatriculation`, `marque`, `modele`, `photo`, `kilometrage`, `type_carburant`, `date_achat`, `statut`, `departement`, `is_delete`, `updated_at`, `created_at`) VALUES
(1, 1, 'LT-456-CA', 'Renault', 'CLIO', '20250524091645jqfjtfteygwjp59gs4ke.jpeg', 95000, 'essence', '2019-04-12', 1, 'technique', 0, '2025-05-29 21:35:05', '2025-05-15 15:53:58'),
(2, 1, 'LT-145-AB', 'Toyota', 'fg', '202505160703112upusjafqrretvcomcyv.jpeg', 130, 'essence', '2019-04-12', 1, 'financier', 0, '2025-05-29 21:35:23', '2025-05-15 15:54:39'),
(3, 1, 'LT-456-CD', 'Peugeot', '208', '20250519115832syfu3ax1ke8z3m8qklhv.pdf', 170, 'electrique', '2023-03-15', 1, 'technique', 0, '2025-05-29 21:35:32', '2025-05-15 16:39:42'),
(4, 1, 'LT-123-AB', 'Toyota', 'Corolla', '20250524090948xtflkchceyepckbifmkt.jpeg', 85000, 'diesel', '2025-05-12', 1, 'technique', 0, '2025-05-29 21:35:42', '2025-05-24 21:09:48'),
(5, 1, 'LT-321-GH', 'Volkswagen', 'GOLF', '202505240914261sn3b0tpeyxdudwu9naj.jpeg', 25000, 'hybride', '2023-05-12', 1, 'financier', 0, '2025-05-29 21:35:51', '2025-05-24 21:14:26'),
(6, 1, 'LT-145-FG', 'Toyota', 'Corola', '20250530032812zhxsnjuwnhknandicrdx.jpg', 15000, 'electrique', '2023-05-12', 1, 'financier', 0, '2025-07-09 20:51:09', '2025-05-30 03:28:12');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `affectation-vehecule`
--
ALTER TABLE `affectation-vehecule`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Index pour la table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Index pour la table `conso_carburant`
--
ALTER TABLE `conso_carburant`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `document_vehicule`
--
ALTER TABLE `document_vehicule`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Index pour la table `intervention_technique`
--
ALTER TABLE `intervention_technique`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Index pour la table `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `panne`
--
ALTER TABLE `panne`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Index pour la table `piece`
--
ALTER TABLE `piece`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Index pour la table `vehicule`
--
ALTER TABLE `vehicule`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `affectation-vehecule`
--
ALTER TABLE `affectation-vehecule`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `conso_carburant`
--
ALTER TABLE `conso_carburant`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT pour la table `document_vehicule`
--
ALTER TABLE `document_vehicule`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT pour la table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `intervention_technique`
--
ALTER TABLE `intervention_technique`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT pour la table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `panne`
--
ALTER TABLE `panne`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT pour la table `piece`
--
ALTER TABLE `piece`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT pour la table `vehicule`
--
ALTER TABLE `vehicule`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
