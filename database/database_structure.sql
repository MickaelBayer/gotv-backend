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

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `cae_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `evt_id` int(11) NOT NULL,
  `evt_plm_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `platforms`
--

CREATE TABLE `platforms` (
  `plm_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `roe_id` int(11) NOT NULL,
  `roe_name` text NOT NULL,
  `roe_description` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `series`
--

CREATE TABLE `series` (
  `see_id` int(11) NOT NULL,
  `see_cae_id` int(11) DEFAULT NULL,
  `see_plm_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `subscriptions`
--

CREATE TABLE `subscriptions` (
  `sun_id` int(11) NOT NULL,
  `sun_name` text,
  `sun_price` float(100,10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `usr_id` int(11) NOT NULL,
  `usr_pseudo` varchar(100) NOT NULL,
  `usr_email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `usr_firstname` varchar(100) NOT NULL,
  `usr_lastname` varchar(100) NOT NULL,
  `usr_roe_id` int(11) DEFAULT NULL,
  `usr_sun_id` int(11) DEFAULT NULL,
  `usr_activ` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `votes`
--

CREATE TABLE `votes` (
  `voe_id` int(11) NOT NULL,
  `voe_usr_id` int(11) NOT NULL,
  `voe_see_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`cae_id`),
  ADD UNIQUE KEY `categories_cae_id_uindex` (`cae_id`);

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`evt_id`),
  ADD UNIQUE KEY `events_evt_id_uindex` (`evt_id`),
  ADD KEY `events_platforms_plm_id_fk` (`evt_plm_id`);

--
-- Indexes for table `platforms`
--
ALTER TABLE `platforms`
  ADD PRIMARY KEY (`plm_id`),
  ADD UNIQUE KEY `platforms_plm_id_uindex` (`plm_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`roe_id`),
  ADD UNIQUE KEY `roles_roe_id_uindex` (`roe_id`);

--
-- Indexes for table `series`
--
ALTER TABLE `series`
  ADD PRIMARY KEY (`see_id`),
  ADD UNIQUE KEY `series_see_id_uindex` (`see_id`),
  ADD KEY `series_categories_cae_id_fk` (`see_cae_id`),
  ADD KEY `series_platforms_plm_id_fk` (`see_plm_id`);

--
-- Indexes for table `subscriptions`
--
ALTER TABLE `subscriptions`
  ADD PRIMARY KEY (`sun_id`),
  ADD UNIQUE KEY `subscriptions_sun_id_uindex` (`sun_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`usr_id`),
  ADD UNIQUE KEY `users_id_uindex` (`usr_id`),
  ADD UNIQUE KEY `users_usr_email_uindex` (`usr_email`),
  ADD UNIQUE KEY `users_usr_pseudo_uindex` (`usr_pseudo`),
  ADD KEY `users_roles_roe_id_fk` (`usr_roe_id`),
  ADD KEY `users_subscriptions_sun_id_fk` (`usr_sun_id`);

--
-- Indexes for table `votes`
--
ALTER TABLE `votes`
  ADD PRIMARY KEY (`voe_id`),
  ADD UNIQUE KEY `votes_voe_id_uindex` (`voe_id`),
  ADD KEY `votes_users_usr_id_fk` (`voe_usr_id`),
  ADD KEY `votes_series_see_id_fk` (`voe_see_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `cae_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `evt_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `platforms`
--
ALTER TABLE `platforms`
  MODIFY `plm_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `roe_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `series`
--
ALTER TABLE `series`
  MODIFY `see_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `subscriptions`
--
ALTER TABLE `subscriptions`
  MODIFY `sun_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `usr_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `events`
--
ALTER TABLE `events`
  ADD CONSTRAINT `events_platforms_plm_id_fk` FOREIGN KEY (`evt_plm_id`) REFERENCES `platforms` (`plm_id`);

--
-- Constraints for table `series`
--
ALTER TABLE `series`
  ADD CONSTRAINT `series_categories_cae_id_fk` FOREIGN KEY (`see_cae_id`) REFERENCES `categories` (`cae_id`),
  ADD CONSTRAINT `series_platforms_plm_id_fk` FOREIGN KEY (`see_plm_id`) REFERENCES `platforms` (`plm_id`);

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_roles_roe_id_fk` FOREIGN KEY (`usr_roe_id`) REFERENCES `roles` (`roe_id`),
  ADD CONSTRAINT `users_subscriptions_sun_id_fk` FOREIGN KEY (`usr_sun_id`) REFERENCES `subscriptions` (`sun_id`);

--
-- Constraints for table `votes`
--
ALTER TABLE `votes`
  ADD CONSTRAINT `votes_series_see_id_fk` FOREIGN KEY (`voe_see_id`) REFERENCES `series` (`see_id`),
  ADD CONSTRAINT `votes_users_usr_id_fk` FOREIGN KEY (`voe_usr_id`) REFERENCES `users` (`usr_id`);
