-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Sep 15, 2019 at 04:00 PM
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
-- Dumping data for table `users`
--

INSERT INTO `users` (`usr_id`, `usr_pseudo`, `usr_email`, `password`, `usr_firstname`, `usr_lastname`) VALUES
(2, 'test', 'de', '$2y$10$e1cJjk7g67CjTPgAHdwZQuzmb9pvzcDRs5GBYhN3CkLnBbXU1T6s2', 'de', 'de');
