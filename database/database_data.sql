-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Nov 02, 2019 at 04:49 PM
-- Server version: 5.7.23
-- PHP Version: 7.2.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `goTvSeries`
--
CREATE DATABASE IF NOT EXISTS `goTvSeries` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `goTvSeries`;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`cae_id`, `cae_id_tmdb`, `cae_label`) VALUES
(1, 10759, 'Action et Aventure'),
(2, 16, 'Animation'),
(3, 35, 'Comédie'),
(4, 80, 'Crime'),
(5, 99, 'Documentaire'),
(6, 18, 'Drame'),
(7, 10751, 'Famille'),
(8, 10762, 'Enfant'),
(9, 9648, 'Mystère'),
(10, 10763, 'Actualités'),
(11, 10764, 'Histoire vraie'),
(12, 10765, 'Sci-Fi & Fantaisie'),
(13, 10766, 'Opéra'),
(14, 10767, 'Discours'),
(15, 10768, 'Guerre & Politique'),
(16, 37, 'Western');

--
-- Dumping data for table `platforms`
--

INSERT INTO `platforms` (`plm_id`) VALUES
(1);

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`roe_id`, `roe_name`, `roe_description`) VALUES
(1, 'admin', 'Administrateur'),
(2, 'expert', 'Expert'),
(3, 'free_user', 'Utilisateur'),
(4, 'premium_user', 'Utilisateur Prémium');

--
-- Dumping data for table `subscriptions`
--

INSERT INTO `subscriptions` (`sun_id`, `sun_name`, `sun_price`) VALUES
(1, 'premium', 0.9900000095);

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`usr_id`, `usr_pseudo`, `usr_email`, `password`, `usr_firstname`, `usr_lastname`, `usr_roe_id`, `usr_sun_id`, `usr_activ`) VALUES
(2, 'test', 'de', '$2y$10$e1cJjk7g67CjTPgAHdwZQuzmb9pvzcDRs5GBYhN3CkLnBbXU1T6s2', 'de', 'de', 2, NULL, 0),
(53, 'audrey31', 'test@test.com', '$2y$10$A1PSBBJcQoWwuzWJd7K.1.3R4IgXMFW/ka4TXOirwWWK/FSWp7P0W', 'Audrey', 'Nunes', 1, NULL, 1);
