-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Nov 25, 2019 at 07:00 PM
-- Server version: 5.7.23
-- PHP Version: 7.2.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `goTvSeries`
--

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`cae_id`, `cae_id_tmdb`, `cae_label`) VALUES
(12, 12, 'Aventure'),
(14, 14, 'Fantastique'),
(16, 16, 'Animation'),
(18, 18, 'Drame'),
(27, 27, 'Horreur'),
(28, 28, 'Action'),
(35, 35, 'Comédie'),
(36, 36, 'Histoire'),
(37, 37, 'Western'),
(53, 53, 'Thriller'),
(80, 80, 'Crime'),
(99, 99, 'Documentaire'),
(878, 878, 'Science-Fiction'),
(9648, 9648, 'Mystère'),
(10402, 10402, 'Musique'),
(10749, 10749, 'Romance'),
(10751, 10751, 'Familial'),
(10752, 10752, 'Guerre'),
(10759, 10759, 'Action et Aventure'),
(10762, 10762, 'Enfant'),
(10763, 10763, 'Actualités'),
(10764, 10764, 'Histoire vraie'),
(10765, 10765, 'Sci-Fi & Fantaisie'),
(10766, 10766, 'Opéra'),
(10767, 10767, 'Discours'),
(10768, 10768, 'Guerre & Politique'),
(10770, 10770, 'Téléfilm');

--
-- Dumping data for table `platforms`
--

INSERT INTO `platforms` (`plm_id`) VALUES
(1);

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`roe_id`, `roe_name`, `roe_description`, `roe_coef`) VALUES
(1, 'admin', 'Administrateur', 1),
(2, 'expert', 'Expert', 3),
(3, 'free_user', 'Utilisateur', 1),
(4, 'premium_user', 'Utilisateur Prémium', 1);

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
