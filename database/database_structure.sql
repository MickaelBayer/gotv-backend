-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Sep 15, 2019 at 03:55 PM
-- Server version: 5.7.23
-- PHP Version: 7.2.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `goTvSeries`
--
CREATE DATABASE IF NOT EXISTS `goTvSeries` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `goTvSeries`;

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
  `usr_lastname` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`usr_id`),
  ADD UNIQUE KEY `users_id_uindex` (`usr_id`),
  ADD UNIQUE KEY `users_usr_email_uindex` (`usr_email`),
  ADD UNIQUE KEY `users_usr_pseudo_uindex` (`usr_pseudo`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `usr_id` int(11) NOT NULL AUTO_INCREMENT;
