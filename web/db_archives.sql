-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost:3306
-- Generation Time: Apr 20, 2016 at 03:35 PM
-- Server version: 5.5.47-0ubuntu0.14.04.1
-- PHP Version: 5.5.9-1ubuntu4.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `db_archives`
--

-- --------------------------------------------------------

--
-- Table structure for table `Archive`
--

CREATE TABLE IF NOT EXISTS `Archive` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `objetclassement_id` int(11) DEFAULT NULL,
  `exercice_id` int(11) DEFAULT NULL,
  `service_id` int(11) DEFAULT NULL,
  `categoriearchive_id` int(11) DEFAULT NULL,
  `dateArchive` date NOT NULL,
  `contenu` longtext COLLATE utf8_unicode_ci NOT NULL,
  `ref` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `loginCreate` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `loginUpdate` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `loginDelete` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `datecreate` datetime DEFAULT NULL,
  `dateupdate` datetime DEFAULT NULL,
  `datedelete` datetime DEFAULT NULL,
  `estsupprimer` tinyint(1) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `objetconservation_id` int(11) DEFAULT NULL,
  `niveaualerte_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_1A4164003499749D` (`objetclassement_id`),
  KEY `IDX_1A41640089D40298` (`exercice_id`),
  KEY `IDX_1A416400ED5CA9E6` (`service_id`),
  KEY `IDX_1A416400C995B745` (`categoriearchive_id`),
  KEY `IDX_1A416400A76ED395` (`user_id`),
  KEY `IDX_1A416400366FFC91` (`objetconservation_id`),
  KEY `IDX_1A416400BB5D23FA` (`niveaualerte_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=8 ;

--
-- Dumping data for table `Archive`
--

INSERT INTO `Archive` (`id`, `objetclassement_id`, `exercice_id`, `service_id`, `categoriearchive_id`, `dateArchive`, `contenu`, `ref`, `loginCreate`, `loginUpdate`, `loginDelete`, `datecreate`, `dateupdate`, `datedelete`, `estsupprimer`, `user_id`, `objetconservation_id`, `niveaualerte_id`) VALUES
(1, 1, 7, 1, 4, '2016-04-14', 'OIUUJLIUHUGYRFYJGUTR', 'KUTR', 'admin', NULL, NULL, '2016-04-16 18:35:48', '2016-04-16 18:35:40', NULL, 0, NULL, 1, NULL),
(2, 1, 7, 1, 4, '2016-04-14', 'OIUUJLIUHUGYRFYJGUTR', 'KUTR', 'admin', NULL, NULL, '2016-04-16 18:35:52', '2016-04-16 18:35:52', NULL, 0, NULL, 1, NULL),
(6, 1, 7, 2, 4, '2016-04-16', 'hjghjgjhgjh', 'ghkghgkhjghj', 'admin', NULL, NULL, '2016-04-17 10:12:03', '2016-04-17 10:12:03', NULL, 0, 1, 1, NULL),
(7, 4, 7, 8, 1, '2016-04-17', 'ergergre', 'sdvdf', 'admin', 'admin', NULL, '2016-04-17 11:16:51', '2016-04-17 11:31:24', NULL, 0, 1, 1, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `bz_user`
--

CREATE TABLE IF NOT EXISTS `bz_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `service_id` int(11) DEFAULT NULL,
  `profil_id` int(11) DEFAULT NULL,
  `image_id` int(11) DEFAULT NULL,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `username_canonical` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email_canonical` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `enabled` tinyint(1) NOT NULL,
  `salt` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `last_login` datetime DEFAULT NULL,
  `locked` tinyint(1) NOT NULL,
  `expired` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL,
  `confirmation_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `password_requested_at` datetime DEFAULT NULL,
  `roles` longtext COLLATE utf8_unicode_ci NOT NULL COMMENT '(DC2Type:array)',
  `credentials_expired` tinyint(1) NOT NULL,
  `credentials_expire_at` datetime DEFAULT NULL,
  `user_gender` varchar(1) COLLATE utf8_unicode_ci DEFAULT NULL,
  `user_firstName` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `user_lastName` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `user_phone` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `user_mobile` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `user_fax` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `user_company` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `user_isconnect` varchar(1) COLLATE utf8_unicode_ci DEFAULT NULL,
  `user_createdate` datetime NOT NULL,
  `user_updatedate` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_3D68FD5A92FC23A8` (`username_canonical`),
  UNIQUE KEY `UNIQ_3D68FD5AA0D96FBF` (`email_canonical`),
  UNIQUE KEY `UNIQ_3D68FD5A3DA5256D` (`image_id`),
  KEY `IDX_3D68FD5AED5CA9E6` (`service_id`),
  KEY `IDX_3D68FD5A275ED078` (`profil_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=4 ;

--
-- Dumping data for table `bz_user`
--

INSERT INTO `bz_user` (`id`, `service_id`, `profil_id`, `image_id`, `username`, `username_canonical`, `email`, `email_canonical`, `enabled`, `salt`, `password`, `last_login`, `locked`, `expired`, `expires_at`, `confirmation_token`, `password_requested_at`, `roles`, `credentials_expired`, `credentials_expire_at`, `user_gender`, `user_firstName`, `user_lastName`, `user_phone`, `user_mobile`, `user_fax`, `user_company`, `user_isconnect`, `user_createdate`, `user_updatedate`) VALUES
(1, 1, 1, NULL, 'admin', 'admin', 'fvemile2012@gmail.com', 'fvemile2012@gmail.com', 1, '91k232oakgsgs00g4kgsw0ow4cws4g8', 'xxRgQ47M6ul8jBAfPl3xDjB8QYIYn87fx1eTnMuMTsgnWrGwkpnnZHvYosJFzeg4SgfSryFe1YONmpAJIAVlPQ==', '2016-04-20 12:23:08', 0, 0, NULL, NULL, NULL, 'a:1:{i:0;s:10:"ROLE_ADMIN";}', 0, NULL, 'M', 'FADONOUGBO', 'Emile', NULL, '+229 89 52 41 45', NULL, 'CONTRELEC', '0', '2016-04-13 10:01:12', '2016-04-20 12:24:29'),
(2, 2, 1, NULL, 'martine', 'martine', 'martine@gmail.com', 'martine@gmail.com', 1, 'oyqzku88s8gs4osg4g8wsgcogos0kcc', 'QF6OyFOnk8POmLqpYlrBJSYujywikcHUTtDlbR9MSwSCPsGdFKzAQ/qvYoSM3IdNs0r+/5GUSbG6L5TOxyEdzA==', '2016-04-20 10:33:33', 0, 0, NULL, NULL, NULL, 'a:1:{i:0;s:10:"ROLE_ADMIN";}', 0, NULL, 'F', 'FADONOUGBO', 'Martine', NULL, '97 01 71 19', NULL, 'CONTRELEC', '0', '2016-04-17 10:03:48', '2016-04-20 12:18:05'),
(3, 3, 2, NULL, 'toto', 'toto', 'toto@yahoo.fr', 'toto@yahoo.fr', 1, '15j2pb452k80ksswcgcgokg00wco0gk', 'LfM2IdM57aIBQKgsEkNsiwywQm6e/OzN9OHoVn8Zubp7rYhjO+B5LOlsMtIDJ1hNrhfNpvTnNWOJfc7NdRvmZA==', '2016-04-20 12:18:12', 0, 0, NULL, NULL, NULL, 'a:1:{i:0;s:8:"ROLE_DIR";}', 0, NULL, 'M', 'ANTONY', 'Toto', NULL, '97 01 71 19', NULL, 'CONTRELEC', '0', '2016-04-17 10:05:13', '2016-04-20 12:22:46');

-- --------------------------------------------------------

--
-- Table structure for table `CategorieArchive`
--

CREATE TABLE IF NOT EXISTS `CategorieArchive` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `libelle` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `loginCreate` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `loginUpdate` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `loginDelete` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `datecreate` datetime DEFAULT NULL,
  `dateupdate` datetime DEFAULT NULL,
  `datedelete` datetime DEFAULT NULL,
  `estsupprimer` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=8 ;

--
-- Dumping data for table `CategorieArchive`
--

INSERT INTO `CategorieArchive` (`id`, `libelle`, `loginCreate`, `loginUpdate`, `loginDelete`, `datecreate`, `dateupdate`, `datedelete`, `estsupprimer`) VALUES
(1, 'Communications', 'admin', NULL, NULL, '2016-04-13 10:59:19', '2016-04-13 10:59:19', NULL, 0),
(2, 'Lettre administratif', 'admin', NULL, NULL, '2016-04-13 11:00:07', '2016-04-13 11:00:07', NULL, 0),
(3, 'Ressources humaines', 'admin', NULL, NULL, '2016-04-13 11:00:20', '2016-04-13 11:00:20', NULL, 0),
(4, 'Facture, devis et bordereau', 'admin', NULL, NULL, '2016-04-13 11:01:00', '2016-04-13 11:01:00', NULL, 0),
(5, 'Clientèle', 'admin', NULL, NULL, '2016-04-13 11:01:11', '2016-04-13 11:01:11', NULL, 0),
(6, 'Juridique', 'admin', NULL, NULL, '2016-04-13 11:01:23', '2016-04-13 11:01:23', NULL, 0),
(7, 'Autre', 'admin', NULL, NULL, '2016-04-13 11:01:41', '2016-04-13 11:01:41', NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `DocumentArchive`
--

CREATE TABLE IF NOT EXISTS `DocumentArchive` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `archive_id` int(11) NOT NULL,
  `image_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_D5D50C7B3DA5256D` (`image_id`),
  KEY `IDX_D5D50C7B2956195F` (`archive_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=6 ;

--
-- Dumping data for table `DocumentArchive`
--

INSERT INTO `DocumentArchive` (`id`, `archive_id`, `image_id`) VALUES
(4, 7, 4),
(5, 7, 5);

-- --------------------------------------------------------

--
-- Table structure for table `Emetteur`
--

CREATE TABLE IF NOT EXISTS `Emetteur` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `message_id` int(11) DEFAULT NULL,
  `datepersist` datetime DEFAULT NULL,
  `datedelete` datetime DEFAULT NULL,
  `estdelete` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_FC574580537A1329` (`message_id`),
  KEY `IDX_FC574580A76ED395` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=13 ;

--
-- Dumping data for table `Emetteur`
--

INSERT INTO `Emetteur` (`id`, `user_id`, `message_id`, `datepersist`, `datedelete`, `estdelete`) VALUES
(1, 1, 1, '2016-04-17 12:16:11', NULL, 0),
(2, 1, 2, '2016-04-17 12:16:28', NULL, 0),
(3, 2, 3, '2016-04-20 09:31:42', NULL, 0),
(4, 2, 4, '2016-04-20 09:51:58', NULL, 0),
(5, 2, 5, '2016-04-20 09:52:19', NULL, 0),
(6, 2, 6, '2016-04-20 09:55:05', NULL, 0),
(7, 2, 7, '2016-04-20 09:56:21', NULL, 0),
(8, 1, 8, '2016-04-20 10:33:11', NULL, 0),
(9, 1, 9, '2016-04-20 10:33:20', NULL, 0),
(10, 2, 10, '2016-04-20 10:33:55', NULL, 0),
(11, 1, 11, '2016-04-20 10:40:24', NULL, 0),
(12, 2, 12, '2016-04-20 10:40:39', NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `Exercice`
--

CREATE TABLE IF NOT EXISTS `Exercice` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `annee` int(11) DEFAULT NULL,
  `loginCreate` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `loginUpdate` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `loginDelete` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `datecreate` datetime DEFAULT NULL,
  `dateupdate` datetime DEFAULT NULL,
  `datedelete` datetime DEFAULT NULL,
  `estsupprimer` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=22 ;

--
-- Dumping data for table `Exercice`
--

INSERT INTO `Exercice` (`id`, `annee`, `loginCreate`, `loginUpdate`, `loginDelete`, `datecreate`, `dateupdate`, `datedelete`, `estsupprimer`) VALUES
(1, 2010, 'admin', NULL, NULL, '2016-04-13 11:33:23', '2016-04-13 11:33:23', NULL, 0),
(2, 2011, 'admin', NULL, NULL, '2016-04-13 11:33:27', '2016-04-13 11:33:27', NULL, 0),
(3, 2012, 'admin', NULL, NULL, '2016-04-13 11:33:31', '2016-04-13 11:33:31', NULL, 0),
(4, 2013, 'admin', NULL, NULL, '2016-04-13 11:33:36', '2016-04-13 11:33:36', NULL, 0),
(5, 2014, 'admin', NULL, NULL, '2016-04-13 11:33:40', '2016-04-13 11:33:40', NULL, 0),
(6, 2015, 'admin', NULL, NULL, '2016-04-13 11:33:43', '2016-04-13 11:33:43', NULL, 0),
(7, 2016, 'admin', NULL, NULL, '2016-04-13 11:33:45', '2016-04-13 11:33:45', NULL, 0),
(8, 2017, 'admin', NULL, NULL, '2016-04-13 11:33:49', '2016-04-13 11:33:49', NULL, 0),
(9, 2018, 'admin', NULL, NULL, '2016-04-13 11:33:51', '2016-04-13 11:33:51', NULL, 0),
(10, 2019, 'admin', NULL, NULL, '2016-04-13 11:33:54', '2016-04-13 11:33:53', NULL, 0),
(11, 2020, 'admin', NULL, NULL, '2016-04-13 11:33:57', '2016-04-13 11:33:57', NULL, 0),
(12, 2021, 'admin', NULL, NULL, '2016-04-13 11:33:59', '2016-04-13 11:33:59', NULL, 0),
(13, 2022, 'admin', NULL, NULL, '2016-04-13 11:34:02', '2016-04-13 11:34:02', NULL, 0),
(14, 2023, 'admin', NULL, NULL, '2016-04-13 11:34:04', '2016-04-13 11:34:04', NULL, 0),
(15, 2024, 'admin', NULL, NULL, '2016-04-13 11:34:07', '2016-04-13 11:34:07', NULL, 0),
(16, 2025, 'admin', NULL, NULL, '2016-04-13 11:34:09', '2016-04-13 11:34:09', NULL, 0),
(17, 2026, 'admin', NULL, NULL, '2016-04-13 11:34:12', '2016-04-13 11:34:12', NULL, 0),
(18, 2027, 'admin', NULL, NULL, '2016-04-13 11:34:14', '2016-04-13 11:34:14', NULL, 0),
(19, 2028, 'admin', NULL, NULL, '2016-04-13 11:34:16', '2016-04-13 11:34:16', NULL, 0),
(20, 2029, 'admin', NULL, NULL, '2016-04-13 11:34:18', '2016-04-13 11:34:18', NULL, 0),
(21, 2030, 'admin', NULL, NULL, '2016-04-13 11:34:22', '2016-04-13 11:34:21', NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `FileRequete`
--

CREATE TABLE IF NOT EXISTS `FileRequete` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `url` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `alt` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `dateEnregistrement` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=3 ;

--
-- Dumping data for table `FileRequete`
--

INSERT INTO `FileRequete` (`id`, `url`, `alt`, `dateEnregistrement`) VALUES
(2, 'jpeg', '4.jpg', '2016-04-17 12:16:28');

-- --------------------------------------------------------

--
-- Table structure for table `Image`
--

CREATE TABLE IF NOT EXISTS `Image` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `url` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `alt` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `dateconn` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=6 ;

--
-- Dumping data for table `Image`
--

INSERT INTO `Image` (`id`, `url`, `alt`, `dateconn`) VALUES
(4, 'pdf', 'a1002f_3_4.pdf', '2016-04-17 11:17:05'),
(5, 'pdf', 'a1002f_2.pdf', '2016-04-17 11:17:15');

-- --------------------------------------------------------

--
-- Table structure for table `Message`
--

CREATE TABLE IF NOT EXISTS `Message` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `filerequete_id` int(11) DEFAULT NULL,
  `emetteur_id` int(11) DEFAULT NULL,
  `dateEnvoi` datetime NOT NULL,
  `objet` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `messageEnvoi` longtext COLLATE utf8_unicode_ci,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_790009E3DB684A24` (`filerequete_id`),
  UNIQUE KEY `UNIQ_790009E379E92E8C` (`emetteur_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=13 ;

--
-- Dumping data for table `Message`
--

INSERT INTO `Message` (`id`, `filerequete_id`, `emetteur_id`, `dateEnvoi`, `objet`, `messageEnvoi`) VALUES
(1, NULL, 1, '2016-04-17 12:16:11', 'kljhkhkhkhlk', 'lkhlkhlkhhjk'),
(2, 2, 2, '2016-04-17 12:16:28', 'kjhkhjkhk', 'jkhkhkj'),
(3, NULL, 3, '2016-04-20 09:31:41', 'demande de divorce', 'en tout cas auuuuuuu'),
(4, NULL, 4, '2016-04-20 09:51:58', 'discussion', 'tu est là.............'),
(5, NULL, 5, '2016-04-20 09:52:19', 'discussion', 'ok'),
(6, NULL, 6, '2016-04-20 09:55:05', 'discussion', 'en bon ?'),
(7, NULL, 7, '2016-04-20 09:56:21', 'discussion', 'aloooo'),
(8, NULL, 8, '2016-04-20 10:33:11', 'discussion', 'oui inh je suis là'),
(9, NULL, 9, '2016-04-20 10:33:20', 'discussion', 'ou bien ?'),
(10, NULL, 10, '2016-04-20 10:33:55', 'discussion', 'en tout ka ...........'),
(11, NULL, 11, '2016-04-20 10:40:24', 'discussion', 'oui la'),
(12, NULL, 12, '2016-04-20 10:40:39', 'discussion', 'xa peut aller');

-- --------------------------------------------------------

--
-- Table structure for table `NiveauAlerte`
--

CREATE TABLE IF NOT EXISTS `NiveauAlerte` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `libelle` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `loginCreate` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `loginUpdate` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `loginDelete` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `datecreate` datetime DEFAULT NULL,
  `dateupdate` datetime DEFAULT NULL,
  `datedelete` datetime DEFAULT NULL,
  `estsupprimer` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=6 ;

--
-- Dumping data for table `NiveauAlerte`
--

INSERT INTO `NiveauAlerte` (`id`, `libelle`, `loginCreate`, `loginUpdate`, `loginDelete`, `datecreate`, `dateupdate`, `datedelete`, `estsupprimer`) VALUES
(1, 'Faible', 'admin', NULL, NULL, '2016-04-13 11:31:17', '2016-04-13 11:31:17', NULL, 0),
(2, 'Elevé', 'admin', NULL, NULL, '2016-04-13 11:31:24', '2016-04-13 11:31:24', NULL, 0),
(3, 'Moyen', 'admin', NULL, NULL, '2016-04-13 11:31:32', '2016-04-13 11:31:32', NULL, 0),
(4, 'Très élevé', 'admin', NULL, NULL, '2016-04-13 11:31:40', '2016-04-13 11:31:40', NULL, 0),
(5, 'Confidentiel', 'admin', NULL, NULL, '2016-04-13 11:31:49', '2016-04-13 11:31:48', NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `ObjetClassement`
--

CREATE TABLE IF NOT EXISTS `ObjetClassement` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ref` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8_unicode_ci NOT NULL,
  `loginCreate` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `loginUpdate` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `loginDelete` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `datecreate` datetime DEFAULT NULL,
  `dateupdate` datetime DEFAULT NULL,
  `datedelete` datetime DEFAULT NULL,
  `estsupprimer` tinyint(1) NOT NULL,
  `lieustockage` varchar(75) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=5 ;

--
-- Dumping data for table `ObjetClassement`
--

INSERT INTO `ObjetClassement` (`id`, `ref`, `description`, `loginCreate`, `loginUpdate`, `loginDelete`, `datecreate`, `dateupdate`, `datedelete`, `estsupprimer`, `lieustockage`) VALUES
(1, '0145', 'Magasin de la Direction Générale', 'admin', 'admin', NULL, '2016-04-13 10:28:51', '2016-04-13 10:31:16', NULL, 0, 'Magasin'),
(2, '021', 'Bureau du Service Comptabilité', 'admin', NULL, NULL, '2016-04-13 10:29:33', '2016-04-13 10:29:32', NULL, 0, 'Bureau'),
(3, '022', 'Bureau du Service Ressources Humaines', 'admin', NULL, 'admin', '2016-04-13 10:29:50', '2016-04-13 10:56:30', '2016-04-13 10:56:30', 1, 'Bureau'),
(4, '325', 'Cave', 'admin', NULL, NULL, '2016-04-13 10:30:13', '2016-04-13 10:30:13', NULL, 0, 'Cave');

-- --------------------------------------------------------

--
-- Table structure for table `ObjetConservation`
--

CREATE TABLE IF NOT EXISTS `ObjetConservation` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `libelle` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `loginCreate` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `loginUpdate` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `loginDelete` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `datecreate` datetime DEFAULT NULL,
  `dateupdate` datetime DEFAULT NULL,
  `datedelete` datetime DEFAULT NULL,
  `estsupprimer` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=6 ;

--
-- Dumping data for table `ObjetConservation`
--

INSERT INTO `ObjetConservation` (`id`, `libelle`, `loginCreate`, `loginUpdate`, `loginDelete`, `datecreate`, `dateupdate`, `datedelete`, `estsupprimer`) VALUES
(1, 'Boîte d''archive', 'admin', NULL, NULL, '2016-04-13 10:55:05', '2016-04-13 10:55:05', NULL, 0),
(2, 'Chemise', 'admin', 'admin', NULL, '2016-04-13 10:55:20', '2016-04-13 10:55:20', NULL, 0),
(3, 'Chrono', 'admin', NULL, 'admin', '2016-04-13 10:55:25', '2016-04-13 10:55:25', '0000-00-00 00:00:00', 0),
(4, 'Carton', 'admin', NULL, NULL, '2016-04-13 10:55:31', '2016-04-13 10:55:31', NULL, 0),
(5, 'Autre', 'admin', NULL, NULL, '2016-04-13 10:55:35', '2016-04-13 10:55:35', NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `Profil`
--

CREATE TABLE IF NOT EXISTS `Profil` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `libelle` varchar(80) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=4 ;

--
-- Dumping data for table `Profil`
--

INSERT INTO `Profil` (`id`, `code`, `libelle`) VALUES
(1, 'ROLE_ADMIN', 'Administrateur'),
(2, 'ROLE_DIR', 'Directeur Général'),
(3, 'ROLE_USER', 'Membre');

-- --------------------------------------------------------

--
-- Table structure for table `Recepteur`
--

CREATE TABLE IF NOT EXISTS `Recepteur` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `message_id` int(11) DEFAULT NULL,
  `datepersist` datetime DEFAULT NULL,
  `datedelete` datetime DEFAULT NULL,
  `estdelete` tinyint(1) DEFAULT NULL,
  `dateLu` datetime DEFAULT NULL,
  `estLu` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_7F11587CA76ED395` (`user_id`),
  KEY `IDX_7F11587C537A1329` (`message_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=13 ;

--
-- Dumping data for table `Recepteur`
--

INSERT INTO `Recepteur` (`id`, `user_id`, `message_id`, `datepersist`, `datedelete`, `estdelete`, `dateLu`, `estLu`) VALUES
(1, 3, 1, '2016-04-17 12:16:11', NULL, 0, NULL, 0),
(2, 2, 2, '2016-04-17 12:16:28', NULL, 0, '2016-04-17 12:20:38', 1),
(3, 1, 3, '2016-04-20 09:31:42', NULL, 0, NULL, 0),
(4, 1, 4, '2016-04-20 09:51:58', NULL, 0, NULL, 0),
(5, 3, 5, '2016-04-20 09:52:19', NULL, 0, NULL, 0),
(6, 3, 6, '2016-04-20 09:55:05', NULL, 0, NULL, 0),
(7, 3, 7, '2016-04-20 09:56:21', NULL, 0, NULL, 0),
(8, 2, 8, '2016-04-20 10:33:11', NULL, 0, NULL, 0),
(9, 2, 9, '2016-04-20 10:33:20', NULL, 0, NULL, 0),
(10, 1, 10, '2016-04-20 10:33:55', NULL, 0, NULL, 0),
(11, 2, 11, '2016-04-20 10:40:24', NULL, 0, NULL, 0),
(12, 1, 12, '2016-04-20 10:40:39', NULL, 0, NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `Service`
--

CREATE TABLE IF NOT EXISTS `Service` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `denomination` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `sigle` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `loginCreate` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `loginUpdate` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `loginDelete` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `datecreate` datetime DEFAULT NULL,
  `dateupdate` datetime DEFAULT NULL,
  `datedelete` datetime DEFAULT NULL,
  `estsupprimer` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=10 ;

--
-- Dumping data for table `Service`
--

INSERT INTO `Service` (`id`, `denomination`, `sigle`, `loginCreate`, `loginUpdate`, `loginDelete`, `datecreate`, `dateupdate`, `datedelete`, `estsupprimer`) VALUES
(1, 'DIRECTION GENERALE', 'DIR', 'admin', NULL, NULL, '2016-04-13 10:01:12', '2016-04-13 10:01:12', NULL, 0),
(2, 'DRH', 'Direction ', 'admin', NULL, NULL, '2016-04-13 11:39:39', '2016-04-13 11:39:39', NULL, 0),
(3, 'DAF', 'Direction ', 'admin', NULL, NULL, '2016-04-13 11:40:03', '2016-04-13 11:40:03', NULL, 0),
(4, 'SRH', 'Service de', 'admin', NULL, NULL, '2016-04-13 11:40:24', '2016-04-13 11:40:24', NULL, 0),
(5, 'SMAC', 'Service Ma', 'admin', NULL, NULL, '2016-04-13 11:40:45', '2016-04-13 11:40:45', NULL, 0),
(6, 'SI', 'Service In', 'admin', NULL, NULL, '2016-04-13 11:40:56', '2016-04-13 11:40:56', NULL, 0),
(7, 'SCF', 'Service Co', 'admin', NULL, NULL, '2016-04-13 11:41:22', '2016-04-13 11:41:22', NULL, 0),
(8, 'SA', 'Service Se', 'admin', NULL, NULL, '2016-04-13 11:41:50', '2016-04-13 11:41:50', NULL, 0),
(9, 'SA', 'Secrétaria', 'admin', NULL, NULL, '2016-04-13 11:42:25', '2016-04-13 11:42:25', NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `VisibiliteArchive`
--

CREATE TABLE IF NOT EXISTS `VisibiliteArchive` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `archive_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `estlu` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_EB5D6C682956195F` (`archive_id`),
  KEY `IDX_EB5D6C68A76ED395` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=15 ;

--
-- Dumping data for table `VisibiliteArchive`
--

INSERT INTO `VisibiliteArchive` (`id`, `archive_id`, `user_id`, `estlu`) VALUES
(11, 6, 3, 0),
(14, 7, 3, 0);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `Archive`
--
ALTER TABLE `Archive`
  ADD CONSTRAINT `FK_1A4164003499749D` FOREIGN KEY (`objetclassement_id`) REFERENCES `ObjetClassement` (`id`),
  ADD CONSTRAINT `FK_1A416400366FFC91` FOREIGN KEY (`objetconservation_id`) REFERENCES `ObjetConservation` (`id`),
  ADD CONSTRAINT `FK_1A41640089D40298` FOREIGN KEY (`exercice_id`) REFERENCES `Exercice` (`id`),
  ADD CONSTRAINT `FK_1A416400A76ED395` FOREIGN KEY (`user_id`) REFERENCES `bz_user` (`id`),
  ADD CONSTRAINT `FK_1A416400BB5D23FA` FOREIGN KEY (`niveaualerte_id`) REFERENCES `NiveauAlerte` (`id`),
  ADD CONSTRAINT `FK_1A416400C995B745` FOREIGN KEY (`categoriearchive_id`) REFERENCES `CategorieArchive` (`id`),
  ADD CONSTRAINT `FK_1A416400ED5CA9E6` FOREIGN KEY (`service_id`) REFERENCES `Service` (`id`);

--
-- Constraints for table `bz_user`
--
ALTER TABLE `bz_user`
  ADD CONSTRAINT `FK_3D68FD5A275ED078` FOREIGN KEY (`profil_id`) REFERENCES `Profil` (`id`),
  ADD CONSTRAINT `FK_3D68FD5A3DA5256D` FOREIGN KEY (`image_id`) REFERENCES `Image` (`id`),
  ADD CONSTRAINT `FK_3D68FD5AED5CA9E6` FOREIGN KEY (`service_id`) REFERENCES `Service` (`id`);

--
-- Constraints for table `DocumentArchive`
--
ALTER TABLE `DocumentArchive`
  ADD CONSTRAINT `FK_D5D50C7B2956195F` FOREIGN KEY (`archive_id`) REFERENCES `Archive` (`id`),
  ADD CONSTRAINT `FK_D5D50C7B3DA5256D` FOREIGN KEY (`image_id`) REFERENCES `Image` (`id`);

--
-- Constraints for table `Emetteur`
--
ALTER TABLE `Emetteur`
  ADD CONSTRAINT `FK_FC574580537A1329` FOREIGN KEY (`message_id`) REFERENCES `Message` (`id`),
  ADD CONSTRAINT `FK_FC574580A76ED395` FOREIGN KEY (`user_id`) REFERENCES `bz_user` (`id`);

--
-- Constraints for table `Message`
--
ALTER TABLE `Message`
  ADD CONSTRAINT `FK_790009E379E92E8C` FOREIGN KEY (`emetteur_id`) REFERENCES `Emetteur` (`id`),
  ADD CONSTRAINT `FK_790009E3DB684A24` FOREIGN KEY (`filerequete_id`) REFERENCES `FileRequete` (`id`);

--
-- Constraints for table `Recepteur`
--
ALTER TABLE `Recepteur`
  ADD CONSTRAINT `FK_7F11587C537A1329` FOREIGN KEY (`message_id`) REFERENCES `Message` (`id`),
  ADD CONSTRAINT `FK_7F11587CA76ED395` FOREIGN KEY (`user_id`) REFERENCES `bz_user` (`id`);

--
-- Constraints for table `VisibiliteArchive`
--
ALTER TABLE `VisibiliteArchive`
  ADD CONSTRAINT `FK_EB5D6C682956195F` FOREIGN KEY (`archive_id`) REFERENCES `Archive` (`id`),
  ADD CONSTRAINT `FK_EB5D6C68A76ED395` FOREIGN KEY (`user_id`) REFERENCES `bz_user` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
