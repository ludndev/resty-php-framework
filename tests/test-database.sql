-- --------------------------------------------------------
-- Hôte :                        127.0.0.1
-- Version du serveur:           5.7.17 - MySQL Community Server (GPL)
-- SE du serveur:                Win32
-- HeidiSQL Version:             10.1.0.5464
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Listage de la structure de la base pour testing
DROP DATABASE IF EXISTS `testing`;
CREATE DATABASE IF NOT EXISTS `testing` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `testing`;

-- Listage de la structure de la table testing. products
DROP TABLE IF EXISTS `products`;
CREATE TABLE IF NOT EXISTS `products` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `price` float NOT NULL DEFAULT '0',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

-- Listage des données de la table testing.products : ~10 rows (environ)
/*!40000 ALTER TABLE `products` DISABLE KEYS */;
INSERT INTO `products` (`id`, `name`, `price`, `created_at`) VALUES
	(1, 'lehner', 9.96, '2019-10-03 10:31:00'),
	(2, 'donnelly', 9.46, '2019-10-03 10:31:00'),
	(3, 'zboncak', 5.27, '2019-10-03 10:31:00'),
	(4, 'cummerata', 5.81, '2019-10-03 10:31:01'),
	(5, 'rippin', 8.73, '2019-10-03 10:31:01'),
	(6, 'sanford', 3.1, '2019-10-03 10:31:01'),
	(7, 'lang', 5.27, '2019-10-03 10:31:01'),
	(8, 'lebsack', 3.79, '2019-10-03 10:31:01'),
	(9, 'west', 5.01, '2019-10-03 10:31:01'),
	(10, 'wintheiser', 3.33, '2019-10-03 10:31:01');
/*!40000 ALTER TABLE `products` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
