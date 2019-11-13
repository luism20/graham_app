-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Versión del servidor:         5.7.24 - MySQL Community Server (GPL)
-- SO del servidor:              Win64
-- HeidiSQL Versión:             10.2.0.5599
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Volcando estructura para tabla graham.cards
CREATE TABLE IF NOT EXISTS `cards` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `stripe_id` varchar(50) DEFAULT NULL,
  `user_id` int(11) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_cards_users` (`user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla graham.cards: 0 rows
/*!40000 ALTER TABLE `cards` DISABLE KEYS */;
/*!40000 ALTER TABLE `cards` ENABLE KEYS */;

-- Volcando estructura para tabla graham.configurations
CREATE TABLE IF NOT EXISTS `configurations` (
  `version` int(11) NOT NULL,
  `instructions` varchar(250) DEFAULT NULL,
  PRIMARY KEY (`version`),
  UNIQUE KEY `version` (`version`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla graham.configurations: 1 rows
/*!40000 ALTER TABLE `configurations` DISABLE KEYS */;
INSERT INTO `configurations` (`version`, `instructions`) VALUES
	(2019, 'instructions.gif');
/*!40000 ALTER TABLE `configurations` ENABLE KEYS */;

-- Volcando estructura para tabla graham.plans
CREATE TABLE IF NOT EXISTS `plans` (
  `id` varchar(50) NOT NULL DEFAULT '',
  `name` varchar(250) DEFAULT NULL,
  `amount` int(11) DEFAULT NULL,
  `interval` varchar(50) DEFAULT NULL,
  `description` text,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla graham.plans: 1 rows
/*!40000 ALTER TABLE `plans` DISABLE KEYS */;
INSERT INTO `plans` (`id`, `name`, `amount`, `interval`, `description`) VALUES
	('plan-5dc4469702e5f', 'Prueba', 23, 'month', 'prueba');
/*!40000 ALTER TABLE `plans` ENABLE KEYS */;

-- Volcando estructura para tabla graham.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `company` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `rol` int(10) unsigned NOT NULL,
  `stripe_id` varchar(50) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `plan_id` varchar(50) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `subscription_id` varchar(50) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `onboarding` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=167 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='1. SuperAdmin\r\n2. Admin';

-- Volcando datos para la tabla graham.users: ~2 rows (aproximadamente)
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` (`id`, `name`, `email`, `password`, `company`, `rol`, `stripe_id`, `plan_id`, `subscription_id`, `remember_token`, `onboarding`, `created_at`, `updated_at`) VALUES
	(165, 'Nelson Enrique Caraballo Ayala', 'ingnelsoncaraballo@gmail.com', '$2y$10$Bps.FIvpVby8KIxpSriuBuNr2DngUpVt2IoPLUhr1DG9C2gXun8Ju', 'hola', 1, '', '', '', NULL, NULL, '2019-10-18 17:54:05', '2019-11-06 15:42:59'),
	(166, 'Prueba', 'elecsis@elecsis.co', '$2y$10$I6WTqnanflIwxNK2oX7TDu5hu3HFEY0W2pjVjXAnb2BUqyFL7pFcu', 'My hosting', 0, 'cus_G8aXFptH8ppsqy', '', '', NULL, 'excel', '2019-11-06 10:37:44', '2019-11-06 18:19:40');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
