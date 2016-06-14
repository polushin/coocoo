-- --------------------------------------------------------
-- Хост:                         127.0.0.1
-- Версия сервера:               5.5.44-0+deb8u1 - (Debian)
-- ОС Сервера:                   debian-linux-gnu
-- HeidiSQL Версия:              9.2.0.4947
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Дамп структуры базы данных coocoo
CREATE DATABASE IF NOT EXISTS `coocoo` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `coocoo`;


-- Дамп структуры для таблица coocoo.comments
CREATE TABLE IF NOT EXISTS `comments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `post_id` int(11) NOT NULL DEFAULT '0',
  `user_id` int(11) NOT NULL DEFAULT '0',
  `content` varchar(200) NOT NULL DEFAULT '',
  `created` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `post_id` (`post_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- Дамп данных таблицы coocoo.comments: ~0 rows (приблизительно)
DELETE FROM `comments`;
/*!40000 ALTER TABLE `comments` DISABLE KEYS */;
INSERT INTO `comments` (`id`, `post_id`, `user_id`, `content`, `created`) VALUES
	(1, 11, 0, 'Суперземля... что это такое', '2015-12-12 23:04:14'),
	(2, 11, 1, 'Да уж... там холодно и темно', '2015-12-12 23:05:36'),
	(3, 1, 1, 'What is this? My translator could not eat it.', '2015-12-12 23:10:47');
/*!40000 ALTER TABLE `comments` ENABLE KEYS */;


-- Дамп структуры для таблица coocoo.posts
CREATE TABLE IF NOT EXISTS `posts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL DEFAULT '0',
  `title` varchar(100) NOT NULL DEFAULT '',
  `content` text NOT NULL,
  `created` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;

-- Дамп данных таблицы coocoo.posts: ~3 rows (приблизительно)
DELETE FROM `posts`;
/*!40000 ALTER TABLE `posts` DISABLE KEYS */;
INSERT INTO `posts` (`id`, `user_id`, `title`, `content`, `created`) VALUES
	(1, 1, 'First Blog Post', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ut, tenetur natus doloremque laborum quos iste ipsum rerum obcaecati impedit odit illo dolorum ab tempora nihil dicta earum fugiat. Temporibus, voluptatibus.Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ut, tenetur natus doloremque laborum quos iste ipsum rerum obcaecati impedit odit illo dolorum ab tempora nihil dicta earum fugiat. Temporibus, voluptatibus.Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ut, tenetur natus doloremque laborum quos iste ipsum rerum obcaecati impedit odit illo dolorum ab tempora nihil dicta earum fugiat. Temporibus, voluptatibus.', '2015-12-10 10:00:00'),
	(11, 2, 'Обнаружено небесное тело, которое может оказаться суперземлей', 'Шведские и мексиканские астрономы заподозрили, что на дальних окраинах Солнечной системы существуют суперземли.\r\nПо мнению ученых, обнаруженное ими небесное тело может оказаться самым удаленным из известных объектов в Солнечной системе. Имеющиеся у ученых данные пока не позволяют точно определить его размеры и удаленность от Земли, сообщает lenta.ru.\r\n\r\nК своему открытию ученые пришли при помощи наблюдений на обсерваторииALMA (Atacama Large Millimeter / submillimeter Array). Потенциальную суперземлю астрономы наблюдали дважды: в июле 2014 и мае 2015 годов.\r\n\r\nУченые выдвигают три гипотезы природы небесного тела (при этом склоняются к первой). Первое предположение: обнаруженный объект является суперземлей, которая примерно в два раза крупнее Земли и удалена от Солнца на расстояние 300 астрономических единиц.\r\nВторая гипотеза заключается в том, что небесное тело является карликовой планетой, находящейся на расстоянии около ста астрономических единиц от Земли. Это дальше, чем карликовая планета Седна, но ближе, чем V774104.\r\n\r\nТретья - необычный объект есть коричневый карлик, расположенный на расстоянии 20 тысяч астрономических единиц от Земли. Ученые собираются продолжить исследования необычного небесного тела, а их гипотезы пока не получили признания астрономического сообщества.', '2015-12-12 22:45:21');
/*!40000 ALTER TABLE `posts` ENABLE KEYS */;


-- Дамп структуры для таблица coocoo.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(100) NOT NULL DEFAULT '',
  `password` varchar(100) NOT NULL DEFAULT '',
  `firstname` varchar(100) NOT NULL DEFAULT '',
  `lastname` varchar(100) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- Дамп данных таблицы coocoo.users: ~2 rows (приблизительно)
DELETE FROM `users`;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` (`id`, `email`, `password`, `firstname`, `lastname`) VALUES
	(1, 'alexander@fiction.com', 'd9d1b168eac8f197e0576b56cfc23ece', 'Alexander', 'Vasiliev'),
	(2, 'ivan@fiction.com', 'd9d1b168eac8f197e0576b56cfc23ece', 'Ivan', 'Petrov');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
