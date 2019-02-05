/*!40101 SET @OLD_CHARACTER_SET_CLIENT = @@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS = @@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS = 0 */;
/*!40101 SET @OLD_SQL_MODE = @@SQL_MODE, SQL_MODE = 'NO_AUTO_VALUE_ON_ZERO' */;


-- Dumping database structure for testTask2
CREATE DATABASE IF NOT EXISTS `testTask2` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `testTask2`;

-- Dumping structure for table testTask2.city
CREATE TABLE IF NOT EXISTS `city`
(
  `id`       int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name`     varchar(255)     NOT NULL,
  `district` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_city_district` (`district`),
  CONSTRAINT `fk_city_district` FOREIGN KEY (`district`) REFERENCES `district` (`id`)
) ENGINE = InnoDB
  AUTO_INCREMENT = 10
  DEFAULT CHARSET = utf8;

-- Dumping data for table testTask2.city: ~9 rows (approximately)
/*!40000 ALTER TABLE `city`
  DISABLE KEYS */;
INSERT INTO `city` (`id`, `name`, `district`)
VALUES (1, 'Жлобин', 1),
       (2, 'Рогачев', 1),
       (3, 'Мозырь', 1),
       (4, 'Жодино', 2),
       (5, 'Молодечно', 2),
       (6, 'Полоцк', 6),
       (7, 'Дисна', 6),
       (8, 'Лида', 4),
       (9, 'Новогрудок', 4);
/*!40000 ALTER TABLE `city`
  ENABLE KEYS */;

-- Dumping structure for table testTask2.client
CREATE TABLE IF NOT EXISTS `client`
(
  `id`              int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name`            varchar(255)     NOT NULL,
  `passport_number` varchar(255)     NOT NULL,
  `sex`             char(1)          NOT NULL,
  `city`            int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_client_city` (`city`),
  CONSTRAINT `fk_client_city` FOREIGN KEY (`city`) REFERENCES `city` (`id`)
) ENGINE = InnoDB
  AUTO_INCREMENT = 4
  DEFAULT CHARSET = utf8;

-- Dumping data for table testTask2.client: ~3 rows (approximately)
/*!40000 ALTER TABLE `client`
  DISABLE KEYS */;
INSERT INTO `client` (`id`, `name`, `passport_number`, `sex`, `city`)
VALUES (1, 'Игорь', '123123123', 'м', 4),
       (2, 'Дима', '321321321', 'м', 5),
       (3, 'Валентина', '111111111', 'ж', 3);
/*!40000 ALTER TABLE `client`
  ENABLE KEYS */;

-- Dumping structure for table testTask2.client_visit
CREATE TABLE IF NOT EXISTS `client_visit`
(
  `id`         int(10) unsigned NOT NULL AUTO_INCREMENT,
  `visit_date` timestamp        NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `client`     int(10) unsigned NOT NULL,
  `city`       int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_client_visit_client` (`client`),
  KEY `fk_client_visit_city` (`city`),
  KEY `visit_date` (`visit_date`),
  CONSTRAINT `fk_client_visit_city` FOREIGN KEY (`city`) REFERENCES `city` (`id`),
  CONSTRAINT `fk_client_visit_client` FOREIGN KEY (`client`) REFERENCES `client` (`id`)
) ENGINE = InnoDB
  AUTO_INCREMENT = 9
  DEFAULT CHARSET = utf8;

-- Dumping data for table testTask2.client_visit: ~8 rows (approximately)
/*!40000 ALTER TABLE `client_visit`
  DISABLE KEYS */;
INSERT INTO `client_visit` (`id`, `visit_date`, `client`, `city`)
VALUES (1, '2019-02-04 13:42:54', 1, 8),
       (2, '2019-02-04 13:31:16', 1, 1),
       (3, '2015-02-03 06:09:01', 1, 3),
       (4, '2014-02-03 07:26:58', 2, 4),
       (5, '2016-03-01 18:34:09', 3, 8),
       (6, '2017-02-04 08:41:37', 2, 5),
       (7, '2018-12-01 18:57:13', 3, 7),
       (8, '2017-02-04 01:42:33', 2, 1);
/*!40000 ALTER TABLE `client_visit`
  ENABLE KEYS */;

-- Dumping structure for table testTask2.district
CREATE TABLE IF NOT EXISTS `district`
(
  `id`   int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255)     NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE = InnoDB
  AUTO_INCREMENT = 7
  DEFAULT CHARSET = utf8;

-- Dumping data for table testTask2.district: ~6 rows (approximately)
/*!40000 ALTER TABLE `district`
  DISABLE KEYS */;
INSERT INTO `district` (`id`, `name`)
VALUES (1, 'Гомельский'),
       (2, 'Минский'),
       (3, 'Могилевский'),
       (4, 'Гродненский'),
       (5, 'Брестский'),
       (6, 'Витебский');
/*!40000 ALTER TABLE `district`
  ENABLE KEYS */;

/*!40101 SET SQL_MODE = IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS = IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT = @OLD_CHARACTER_SET_CLIENT */;