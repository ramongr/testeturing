-- phpMyAdmin SQL Dump
-- version 4.0.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jan 09, 2014 at 05:40 PM
-- Server version: 5.6.12-log
-- PHP Version: 5.4.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `turing`
--
CREATE DATABASE IF NOT EXISTS `turing` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `turing`;

-- --------------------------------------------------------

--
-- Table structure for table `fix_perg`
--

CREATE TABLE IF NOT EXISTS `fix_perg` (
  `id_fix_perg` int(11) NOT NULL AUTO_INCREMENT,
  `fix_perg` varchar(256) NOT NULL,
  PRIMARY KEY (`id_fix_perg`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

-- --------------------------------------------------------

--
-- Table structure for table `jogo`
--

CREATE TABLE IF NOT EXISTS `jogo` (
  `id_jogo` int(11) NOT NULL AUTO_INCREMENT,
  `n_resp` int(11) DEFAULT NULL,
  `ganhou` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_jogo`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=17 ;

-- --------------------------------------------------------

--
-- Table structure for table `perguntas`
--

CREATE TABLE IF NOT EXISTS `perguntas` (
  `id_perg` int(11) NOT NULL AUTO_INCREMENT,
  `id_jogo` int(11) NOT NULL,
  `id_resp` int(11) DEFAULT NULL,
  `perg` varchar(256) NOT NULL,
  `sala_a` int(11) NOT NULL,
  `sala_b` int(11) NOT NULL,
  PRIMARY KEY (`id_perg`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=18 ;

-- --------------------------------------------------------

--
-- Table structure for table `respostas`
--

CREATE TABLE IF NOT EXISTS `respostas` (
  `id_resp` int(11) NOT NULL AUTO_INCREMENT,
  `id_jogo` int(11) NOT NULL,
  `resp` varchar(1024) DEFAULT NULL,
  `resp_bot` varchar(1024) DEFAULT NULL,
  PRIMARY KEY (`id_resp`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
