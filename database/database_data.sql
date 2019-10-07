-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Oct 07, 2019 at 10:19 AM
-- Server version: 5.7.23
-- PHP Version: 7.2.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `goTvSeries`
--

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
