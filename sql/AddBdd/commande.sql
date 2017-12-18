-- Adminer 4.3.1 MySQL dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

DROP TABLE IF EXISTS `commande`;
CREATE TABLE `commande` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(80) NOT NULL,
  `prenom` varchar(80) NOT NULL,
  `mail` varchar(80) NOT NULL,
  `livraison` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `token` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `commande` (`id`, `nom`, `prenom`, `mail`, `livraison`, `token`) VALUES
(1,	'test',	'test',	'zfzfzfz',	'0000-00-00 00:00:00',	NULL),
(2,	'test',	'test',	'zfzfzfz',	'0000-00-00 00:00:00',	'5a3253c040411');

-- 2017-12-14 10:43:27
