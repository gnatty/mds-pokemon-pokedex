-- phpMyAdmin SQL Dump
-- version 4.6.6deb4
-- https://www.phpmyadmin.net/
--
-- Client :  localhost:3306
-- Généré le :  Mar 16 Janvier 2018 à 02:28
-- Version du serveur :  5.7.20-0ubuntu0.17.04.1
-- Version de PHP :  7.0.22-0ubuntu0.17.04.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `mds_pokemon`
--

-- --------------------------------------------------------

--
-- Structure de la table `admin_user`
--

CREATE TABLE `admin_user` (
  `aus_id` int(9) NOT NULL,
  `aus_username` varchar(50) NOT NULL,
  `aus_password` varchar(50) NOT NULL,
  `aus_role` varchar(50) NOT NULL DEFAULT 'visitor'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `pokemon`
--

CREATE TABLE `pokemon` (
  `pok_id` int(9) NOT NULL,
  `pok_name` varchar(200) NOT NULL,
  `pok_img` varchar(200) DEFAULT NULL,
  `pok_num` varchar(9) DEFAULT NULL,
  `pok_gender_male` float DEFAULT NULL,
  `pok_gender_female` float DEFAULT NULL,
  `pok_height` varchar(50) DEFAULT NULL,
  `pok_weight` varchar(50) DEFAULT NULL,
  `pok_ev_yield` varchar(200) DEFAULT NULL,
  `pok_catch_rate` varchar(200) DEFAULT NULL,
  `pok_base_happ` varchar(200) DEFAULT NULL,
  `pok_base_exp` varchar(200) DEFAULT NULL,
  `pok_growth_rate` varchar(200) DEFAULT NULL,
  `pok_egg_cycles` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `pokemon_evolution`
--

CREATE TABLE `pokemon_evolution` (
  `pev_id` int(9) NOT NULL,
  `pev_cur_pokemon` int(9) NOT NULL,
  `pev_next_pokemon` int(9) NOT NULL,
  `pev_lvl` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `pokemon_global_ability`
--

CREATE TABLE `pokemon_global_ability` (
  `pga_id` int(9) NOT NULL,
  `pga_name` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `pokemon_global_checkout`
--

CREATE TABLE `pokemon_global_checkout` (
  `pgc_id` int(9) NOT NULL,
  `pgc_name` varchar(200) NOT NULL,
  `pgc_state` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `pokemon_global_defense`
--

CREATE TABLE `pokemon_global_defense` (
  `pgd_id` int(9) NOT NULL,
  `pgd_name` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `pokemon_global_egg_group`
--

CREATE TABLE `pokemon_global_egg_group` (
  `pgeg_id` int(9) NOT NULL,
  `pgeg_name` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `pokemon_global_move`
--

CREATE TABLE `pokemon_global_move` (
  `pgm_id` int(9) NOT NULL,
  `pgm_name` varchar(200) NOT NULL,
  `pgm_type` varchar(200) NOT NULL,
  `pgm_cat` varchar(200) NOT NULL,
  `pgm_power` varchar(9) NOT NULL,
  `pgm_accuracy` int(9) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `pokemon_global_type`
--

CREATE TABLE `pokemon_global_type` (
  `pgt_id` int(9) NOT NULL,
  `pgt_name` int(9) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_german2_ci;

-- --------------------------------------------------------

--
-- Structure de la table `pokemon_stat_ability`
--

CREATE TABLE `pokemon_stat_ability` (
  `psa_id` int(9) NOT NULL,
  `psa_pokemon` int(9) NOT NULL,
  `psa_ability` int(9) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `pokemon_stat_base`
--

CREATE TABLE `pokemon_stat_base` (
  `psb_id` int(9) NOT NULL,
  `psb_pokemon` int(9) NOT NULL,
  `psb_name` varchar(200) NOT NULL,
  `psb_default` int(9) NOT NULL,
  `psb_min` int(9) NOT NULL,
  `psb_max` int(9) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `pokemon_stat_defense`
--

CREATE TABLE `pokemon_stat_defense` (
  `psd_id` int(9) NOT NULL,
  `psd_pokemon` int(9) NOT NULL,
  `psd_defense` int(9) NOT NULL,
  `psd_value` varchar(9) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `pokemon_stat_egg_group`
--

CREATE TABLE `pokemon_stat_egg_group` (
  `pseg_id` int(9) NOT NULL,
  `pseg_pokemon` int(9) NOT NULL,
  `pseg_egg_group` int(9) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `pokemon_stat_move`
--

CREATE TABLE `pokemon_stat_move` (
  `psm_id` int(9) NOT NULL,
  `psm_pokemon` int(9) NOT NULL,
  `psm_move` int(9) NOT NULL,
  `psm_lvl` int(9) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `pokemon_stat_type`
--

CREATE TABLE `pokemon_stat_type` (
  `pty_id` int(9) NOT NULL,
  `pty_pokemon` int(9) NOT NULL,
  `pty_type` int(9) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Index pour les tables exportées
--

--
-- Index pour la table `admin_user`
--
ALTER TABLE `admin_user`
  ADD PRIMARY KEY (`aus_id`),
  ADD UNIQUE KEY `aus_username` (`aus_username`);

--
-- Index pour la table `pokemon`
--
ALTER TABLE `pokemon`
  ADD PRIMARY KEY (`pok_id`),
  ADD UNIQUE KEY `pok_name` (`pok_name`);

--
-- Index pour la table `pokemon_evolution`
--
ALTER TABLE `pokemon_evolution`
  ADD PRIMARY KEY (`pev_id`);

--
-- Index pour la table `pokemon_global_ability`
--
ALTER TABLE `pokemon_global_ability`
  ADD PRIMARY KEY (`pga_id`);

--
-- Index pour la table `pokemon_global_checkout`
--
ALTER TABLE `pokemon_global_checkout`
  ADD PRIMARY KEY (`pgc_id`),
  ADD UNIQUE KEY `pch_name` (`pgc_name`);

--
-- Index pour la table `pokemon_global_defense`
--
ALTER TABLE `pokemon_global_defense`
  ADD PRIMARY KEY (`pgd_id`);

--
-- Index pour la table `pokemon_global_egg_group`
--
ALTER TABLE `pokemon_global_egg_group`
  ADD PRIMARY KEY (`pgeg_id`),
  ADD UNIQUE KEY `pgeg_name` (`pgeg_name`);

--
-- Index pour la table `pokemon_global_move`
--
ALTER TABLE `pokemon_global_move`
  ADD PRIMARY KEY (`pgm_id`),
  ADD UNIQUE KEY `pgm_name` (`pgm_name`);

--
-- Index pour la table `pokemon_global_type`
--
ALTER TABLE `pokemon_global_type`
  ADD PRIMARY KEY (`pgt_id`);

--
-- Index pour la table `pokemon_stat_ability`
--
ALTER TABLE `pokemon_stat_ability`
  ADD PRIMARY KEY (`psa_id`);

--
-- Index pour la table `pokemon_stat_base`
--
ALTER TABLE `pokemon_stat_base`
  ADD PRIMARY KEY (`psb_id`);

--
-- Index pour la table `pokemon_stat_defense`
--
ALTER TABLE `pokemon_stat_defense`
  ADD PRIMARY KEY (`psd_id`);

--
-- Index pour la table `pokemon_stat_egg_group`
--
ALTER TABLE `pokemon_stat_egg_group`
  ADD PRIMARY KEY (`pseg_id`);

--
-- Index pour la table `pokemon_stat_move`
--
ALTER TABLE `pokemon_stat_move`
  ADD PRIMARY KEY (`psm_id`);

--
-- Index pour la table `pokemon_stat_type`
--
ALTER TABLE `pokemon_stat_type`
  ADD PRIMARY KEY (`pty_id`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `admin_user`
--
ALTER TABLE `admin_user`
  MODIFY `aus_id` int(9) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `pokemon`
--
ALTER TABLE `pokemon`
  MODIFY `pok_id` int(9) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `pokemon_evolution`
--
ALTER TABLE `pokemon_evolution`
  MODIFY `pev_id` int(9) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `pokemon_global_ability`
--
ALTER TABLE `pokemon_global_ability`
  MODIFY `pga_id` int(9) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `pokemon_global_checkout`
--
ALTER TABLE `pokemon_global_checkout`
  MODIFY `pgc_id` int(9) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `pokemon_global_egg_group`
--
ALTER TABLE `pokemon_global_egg_group`
  MODIFY `pgeg_id` int(9) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `pokemon_global_move`
--
ALTER TABLE `pokemon_global_move`
  MODIFY `pgm_id` int(9) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `pokemon_global_type`
--
ALTER TABLE `pokemon_global_type`
  MODIFY `pgt_id` int(9) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `pokemon_stat_ability`
--
ALTER TABLE `pokemon_stat_ability`
  MODIFY `psa_id` int(9) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `pokemon_stat_base`
--
ALTER TABLE `pokemon_stat_base`
  MODIFY `psb_id` int(9) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `pokemon_stat_defense`
--
ALTER TABLE `pokemon_stat_defense`
  MODIFY `psd_id` int(9) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `pokemon_stat_egg_group`
--
ALTER TABLE `pokemon_stat_egg_group`
  MODIFY `pseg_id` int(9) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `pokemon_stat_move`
--
ALTER TABLE `pokemon_stat_move`
  MODIFY `psm_id` int(9) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `pokemon_stat_type`
--
ALTER TABLE `pokemon_stat_type`
  MODIFY `pty_id` int(9) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
