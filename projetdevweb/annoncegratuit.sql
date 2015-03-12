-- phpMyAdmin SQL Dump
-- version 3.4.9
-- http://www.phpmyadmin.net
--
-- Host: sql.olympe-network.com
-- Generation Time: Apr 05, 2012 at 04:50 AM
-- Server version: 5.5.15
-- PHP Version: 5.3.9-1

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `171155_jannonce`
--

-- --------------------------------------------------------

--
-- Table structure for table `departement`
--

CREATE TABLE IF NOT EXISTS `departement` (
  `id_dept` int(11) NOT NULL AUTO_INCREMENT,
  `nom_dept` varchar(50) NOT NULL,
  `id_region` int(11) NOT NULL,
  PRIMARY KEY (`id_dept`),
  KEY `id_region` (`id_region`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=977 ;

--
-- Dumping data for table `departement`
--

INSERT INTO `departement` (`id_dept`, `nom_dept`, `id_region`) VALUES
(1, 'Ain', 22),
(2, 'Aisne', 19),
(3, 'Allier', 3),
(4, 'Alpes-de-Haute-Provence', 21),
(5, 'Hautes-Alpes', 21),
(6, 'Alpes-Maritimes', 21),
(7, 'Ardèche', 22),
(8, 'Ardennes', 8),
(9, 'Ariège', 16),
(10, 'Aube', 8),
(11, 'Aude', 13),
(12, 'Aveyron', 16),
(13, 'Bouches-du-Rhône', 21),
(14, 'Calvados', 4),
(15, 'Cantal', 3),
(16, 'Charente', 20),
(17, 'Charente-Maritime', 20),
(18, 'Cher', 7),
(19, 'Corrèze', 14),
(20, 'Corse', 9),
(21, 'Côte-d''Or', 5),
(22, 'Côtes-d''Armor', 6),
(23, 'Creuse', 14),
(24, 'Dordogne', 2),
(25, 'Doubs', 10),
(26, 'Drôme', 22),
(27, 'Eure', 11),
(28, 'Eure-et-Loir', 7),
(29, 'Finistère', 6),
(30, 'Gard', 13),
(31, 'Haute-Garonne', 16),
(32, 'Gers', 16),
(33, 'Gironde', 2),
(34, 'Hérault', 13),
(35, 'Ille-et-Vilaine', 6),
(36, 'Indre', 7),
(37, 'Indre-et-Loire', 7),
(38, 'Isère', 22),
(39, 'Jura', 10),
(40, 'Landes', 2),
(41, 'Loir-et-Cher', 7),
(42, 'Loire', 22),
(43, 'Haute-Loire', 3),
(44, 'Loire-Atlantique', 18),
(45, 'Loiret', 7),
(46, 'Lot', 16),
(47, 'Lot-et-Garonne', 2),
(48, 'Lozère', 13),
(49, 'Maine-et-Loire', 18),
(50, 'Manche', 4),
(51, 'Marne', 8),
(52, 'Haute-Marne', 8),
(53, 'Mayenne', 18),
(54, 'Meurthe-et-Moselle', 15),
(55, 'Meuse', 15),
(56, 'Morbihan', 6),
(57, 'Moselle', 15),
(58, 'Nièvre', 5),
(59, 'Nord', 17),
(60, 'Oise', 19),
(61, 'Orne', 4),
(62, 'Pas-de-Calais', 17),
(63, 'Puy-de-Dôme', 3),
(64, 'Pyrénées-Atlantiques', 2),
(65, 'Hautes-Pyrénées', 16),
(66, 'Pyrénées-Orientales', 13),
(67, 'Bas-Rhin', 1),
(68, 'Haut-Rhin', 1),
(69, 'Rhône', 22),
(70, 'Haute-Saône', 10),
(71, 'Saône-et-Loire', 5),
(72, 'Sarthe', 18),
(73, 'Savoie', 22),
(74, 'Haute-Savoie', 22),
(75, 'Paris', 12),
(76, 'Seine-Maritime', 11),
(77, 'Seine-et-Marne', 12),
(78, 'Yvelines', 12),
(79, 'Deux-Sèvres', 20),
(80, 'Somme', 19),
(81, 'Tarn', 16),
(82, 'Tarn-et-Garonne', 16),
(83, 'Var', 21),
(84, 'Vaucluse', 21),
(85, 'Vendée', 18),
(86, 'Vienne', 20),
(87, 'Haute-Vienne', 14),
(88, 'Vosges', 15),
(89, 'Yonne', 5),
(90, 'Territoire de Belfort', 10),
(91, 'Essonne', 12),
(92, 'Hauts-de-Seine', 12),
(93, 'Seine-Saint-Denis', 12),
(94, 'Val-de-Marne', 12),
(95, 'Val-d''Oise', 12),
(971, 'Guadeloupe', 23),
(972, 'Martinique', 24),
(973, 'Guyane', 25),
(974, 'La Réunion', 26),
(976, 'Mayotte', 27);

-- --------------------------------------------------------

--
-- Table structure for table `immobilier`
--

CREATE TABLE IF NOT EXISTS `immobilier` (
  `id_annonce` int(11) NOT NULL AUTO_INCREMENT,
  `surface` int(11) DEFAULT NULL,
  `nbPieces` int(11) DEFAULT NULL,
  `classe_energie` varchar(25) DEFAULT NULL,
  `ges` varchar(25) DEFAULT NULL,
  `prix` int(11) DEFAULT NULL,
  `titre` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `id_utilisateur` int(11) NOT NULL,
  `id_type` int(11) NOT NULL,
  `id_dept` int(11) DEFAULT NULL,
  `id_region` int(11) NOT NULL,
  `photo1` text,
  `date_offre` date NOT NULL,
  `time_offre` time NOT NULL,
  PRIMARY KEY (`id_annonce`),
  KEY `id_utilisateur` (`id_utilisateur`),
  KEY `id_type` (`id_type`),
  KEY `id_departement` (`id_dept`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `immobilier`
--

INSERT INTO `immobilier` (`id_annonce`, `surface`, `nbPieces`, `classe_energie`, `ges`, `prix`, `titre`, `description`, `id_utilisateur`, `id_type`, `id_dept`, `id_region`, `photo1`, `date_offre`, `time_offre`) VALUES
(1, NULL, NULL, NULL, NULL, 900000, 'Mansion exotique', 'Je vend mon mansion exotique', 1, 4, 87, 14, 'http://annoncegratuit.olympe-network.com/protected/uploads/images/mkab/mkab_2a7f45de2cbb33295ae858164dd9848f.jpeg', '2012-04-04', '02:06:12'),
(2, NULL, NULL, NULL, NULL, 2500, 'Maison en bois', 'Je loue mon maison en bois 2500euros/mois', 1, 5, 91, 12, 'http://annoncegratuit.olympe-network.com/protected/uploads/images/mkab/mkab_a7dbaf38387d8ffd2cd6c9df1816b694.jpeg', '2012-04-04', '02:07:45'),
(5, NULL, NULL, NULL, NULL, 99, 'Macbook Air pas chere', 'Soyez tres precis', 3, 5, 0, 12, 'http://annoncegratuit.olympe-network.com/protected/uploads/images/sofiane/sofiane_a8a7799a466aed31afbc68844daa3aff.jpeg', '2012-04-05', '01:46:25');

-- --------------------------------------------------------

--
-- Table structure for table `multimedia`
--

CREATE TABLE IF NOT EXISTS `multimedia` (
  `id_annonce` int(11) NOT NULL AUTO_INCREMENT,
  `prix` int(11) NOT NULL,
  `titre` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `id_utilisateur` int(11) NOT NULL,
  `id_type` int(11) NOT NULL,
  `id_dept` int(11) DEFAULT NULL,
  `id_region` int(11) NOT NULL,
  `photo1` text,
  `date_offre` date NOT NULL,
  `time_offre` time NOT NULL,
  PRIMARY KEY (`id_annonce`),
  KEY `id_utilisateur` (`id_utilisateur`),
  KEY `id_region` (`id_region`),
  KEY `id_type` (`id_type`),
  KEY `id_dept` (`id_dept`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `multimedia`
--

INSERT INTO `multimedia` (`id_annonce`, `prix`, `titre`, `description`, `id_utilisateur`, `id_type`, `id_dept`, `id_region`, `photo1`, `date_offre`, `time_offre`) VALUES
(1, 500, 'Portable Toshiba', 'Vends Portable toshiba NEUF 500 E', 1, 7, 95, 12, 'http://annoncegratuit.olympe-network.com/protected/uploads/images/mkab/mkab_5ab78c1b74f98cd30c39cef2edd9e07d.jpeg', '2012-04-03', '22:55:41'),
(2, 200, 'iPhone 4GS', 'Je vends mon iphone 4gs. presque comme neuf. tres peu utiliser. veuillez me contacter', 1, 10, 75, 12, 'http://annoncegratuit.olympe-network.com/protected/uploads/images/mkab/mkab_4d93528a9b5b1589c61f4d2eb6b07fdb.jpeg', '2012-04-03', '22:58:22'),
(4, 60, 'ps3 avec mannette', 'Je vend mon ps3 avec manette neuf a 60 euro. pas vole du tout.', 1, 8, 75, 12, 'http://annoncegratuit.olympe-network.com/protected/uploads/images/mkab/mkab_d47c2ffbdb1d3161097298cb657062b4.jpeg', '2012-04-04', '02:23:34'),
(5, 600, 'Macbook Air pas chere', 'Je vends mon Macbook air en tres bon etat (sans chargeur). Je l''ai achete en janvier 2012 donc c''est toujours tres recent.\r\n\r\nContactez moi pour plus d''information.', 3, 7, 93, 12, 'http://annoncegratuit.olympe-network.com/protected/uploads/images/sofiane/sofiane_8d791f9cc89534a24aba08e61afbb0e3.jpeg', '2012-04-05', '00:55:28');

-- --------------------------------------------------------

--
-- Table structure for table `region`
--

CREATE TABLE IF NOT EXISTS `region` (
  `id_region` int(11) NOT NULL AUTO_INCREMENT,
  `nom_region` varchar(50) NOT NULL,
  PRIMARY KEY (`id_region`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=28 ;

--
-- Dumping data for table `region`
--

INSERT INTO `region` (`id_region`, `nom_region`) VALUES
(1, 'Alsace'),
(2, 'Aquitaine'),
(3, 'Auvergne'),
(4, 'Basse-Normandie'),
(5, 'Bourgogne'),
(6, 'Bretagne'),
(7, 'Centre'),
(8, 'Champagne-Ardenne'),
(9, 'Corse'),
(10, 'Franche-Comté'),
(11, 'Haute-Normandie'),
(12, 'Ile-de-France'),
(13, 'Languedoc-Roussillon'),
(14, 'Limousin'),
(15, 'Lorraine'),
(16, 'Midi-Pyrénées'),
(17, 'Nord-Pas-de-Calais'),
(18, 'Pays de la Loire'),
(19, 'Picardie'),
(20, 'Poitou-Charentes'),
(21, 'Provence-Alpes-Côte d''Azur'),
(22, 'Rhône-Alpes'),
(23, 'Guadeloupe'),
(24, 'Guyane'),
(25, 'Martinique'),
(26, 'La Réunion'),
(27, 'Mayotte');

-- --------------------------------------------------------

--
-- Table structure for table `type`
--

CREATE TABLE IF NOT EXISTS `type` (
  `id_type` int(11) NOT NULL AUTO_INCREMENT,
  `nom_type` varchar(50) NOT NULL,
  PRIMARY KEY (`id_type`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `type`
--

INSERT INTO `type` (`id_type`, `nom_type`) VALUES
(1, 'Voiture'),
(2, 'Moto'),
(3, 'Utilitaire'),
(4, 'Vente'),
(5, 'Location'),
(6, 'Colocation'),
(7, 'Informatique'),
(8, 'ConsolesJeux'),
(9, 'ImageSon'),
(10, 'Telephonie');

-- --------------------------------------------------------

--
-- Table structure for table `utilisateur`
--

CREATE TABLE IF NOT EXISTS `utilisateur` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(50) NOT NULL,
  `passwd` varchar(255) NOT NULL,
  `telephone` varchar(20) DEFAULT NULL,
  `mail` varchar(50) NOT NULL,
  `type_util` varchar(20) NOT NULL,
  `status` varchar(20) NOT NULL,
  `activationkey` varchar(100) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `mail` (`mail`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `utilisateur`
--

INSERT INTO `utilisateur` (`id`, `nom`, `passwd`, `telephone`, `mail`, `type_util`, `status`, `activationkey`) VALUES
(1, 'mkab', 'ed02457b5c41d964dbd2f2a609d63fe1bb7528dbe55e1abf5b52c249cd735797', '0111111111', 'joelmkab@hotmail.fr', 'professionnel', 'activated', ''),
(3, 'sofiane', '85f4717813d2428e1d30a18f8ae18240a777fc9f4b5b3e31cbc864975cf058a6', '0555555555', 'kabirfor@yahoo.com', 'particulier', 'activated', '');

-- --------------------------------------------------------

--
-- Table structure for table `vehicule`
--

CREATE TABLE IF NOT EXISTS `vehicule` (
  `id_annonce` int(11) NOT NULL,
  `annee_modele` int(11) NOT NULL,
  `kilometrage` int(11) NOT NULL,
  `energie_vehicule` varchar(25) DEFAULT NULL,
  `boite_vehicule` varchar(25) DEFAULT NULL,
  `cylindre_vehicule` int(11) DEFAULT NULL,
  `prix` int(11) NOT NULL,
  `titre` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `id_utilisateur` int(11) NOT NULL,
  `id_type` int(11) NOT NULL,
  `id_dept` int(11) DEFAULT NULL,
  `id_region` int(11) NOT NULL,
  `photo1` text,
  `date_offre` date NOT NULL,
  `time_offre` time NOT NULL,
  PRIMARY KEY (`id_annonce`),
  KEY `id_utilisateur` (`id_utilisateur`),
  KEY `id_type` (`id_type`),
  KEY `id_region` (`id_region`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `departement`
--
ALTER TABLE `departement`
  ADD CONSTRAINT `departement_ibfk_1` FOREIGN KEY (`id_region`) REFERENCES `region` (`id_region`) ON UPDATE CASCADE;

--
-- Constraints for table `multimedia`
--
ALTER TABLE `multimedia`
  ADD CONSTRAINT `multimedia_ibfk_1` FOREIGN KEY (`id_utilisateur`) REFERENCES `utilisateur` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `multimedia_ibfk_2` FOREIGN KEY (`id_region`) REFERENCES `region` (`id_region`) ON UPDATE CASCADE,
  ADD CONSTRAINT `multimedia_ibfk_3` FOREIGN KEY (`id_type`) REFERENCES `type` (`id_type`) ON UPDATE CASCADE,
  ADD CONSTRAINT `multimedia_ibfk_4` FOREIGN KEY (`id_dept`) REFERENCES `departement` (`id_dept`) ON UPDATE CASCADE;

--
-- Constraints for table `vehicule`
--
ALTER TABLE `vehicule`
  ADD CONSTRAINT `vehicule_ibfk_3` FOREIGN KEY (`id_type`) REFERENCES `type` (`id_type`) ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
