-- phpMyAdmin SQL Dump
-- version 4.0.10.6
-- http://www.phpmyadmin.net
--
-- Хост: 127.0.0.1:3306
-- Время создания: Авг 05 2015 г., 14:02
-- Версия сервера: 5.5.41-log
-- Версия PHP: 5.3.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- База данных: `m1`
--
CREATE DATABASE IF NOT EXISTS `m1` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `m1`;

-- --------------------------------------------------------

--
-- Структура таблицы `category`
--

CREATE TABLE IF NOT EXISTS `category` (
  `id_category` int(11) NOT NULL AUTO_INCREMENT,
  `name_category` varchar(20) NOT NULL,
  PRIMARY KEY (`id_category`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=36 ;

--
-- Дамп данных таблицы `category`
--

INSERT INTO `category` (`id_category`, `name_category`) VALUES
(29, 'Планшеты'),
(30, 'Mp3 плееры'),
(31, 'Персональные компьют'),
(32, 'Ноутбуки'),
(33, 'Apple TV'),
(34, 'Аксессуары'),
(35, 'Мобильные телефоны');

-- --------------------------------------------------------

--
-- Структура таблицы `color_slv`
--

CREATE TABLE IF NOT EXISTS `color_slv` (
  `id_color_slv` int(11) NOT NULL AUTO_INCREMENT,
  `name_color_slv` varchar(20) NOT NULL,
  PRIMARY KEY (`id_color_slv`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Дамп данных таблицы `color_slv`
--

INSERT INTO `color_slv` (`id_color_slv`, `name_color_slv`) VALUES
(1, 'Белый'),
(2, 'Черный'),
(3, 'Серый'),
(4, 'Красный');

-- --------------------------------------------------------

--
-- Структура таблицы `tovar`
--

CREATE TABLE IF NOT EXISTS `tovar` (
  `id_tovar` int(11) NOT NULL AUTO_INCREMENT,
  `name_tovar` varchar(20) DEFAULT NULL,
  `articul_tovar` varchar(20) DEFAULT NULL,
  `option_tovar` tinyint(1) DEFAULT NULL,
  `f_k_color_tovar` int(11) NOT NULL,
  `razmer_tovar` varchar(20) DEFAULT NULL,
  `ves_tovar` float DEFAULT NULL,
  `f_k_category` int(11) DEFAULT NULL,
  `cena_tovar` float DEFAULT NULL,
  PRIMARY KEY (`id_tovar`),
  KEY `f_k_category` (`f_k_category`),
  KEY `f_k_color_tovar` (`f_k_color_tovar`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=15 ;

--
-- Дамп данных таблицы `tovar`
--

INSERT INTO `tovar` (`id_tovar`, `name_tovar`, `articul_tovar`, `option_tovar`, `f_k_color_tovar`, `razmer_tovar`, `ves_tovar`, `f_k_category`, `cena_tovar`) VALUES
(8, 'Apple Thunderbolt Di', '42787825', 1, 1, '1280*1245*90', 9, 29, 11),
(9, 'Apple iMac 27''', '42787825', 0, 2, '1280*1245*90', 9, 30, 11),
(10, 'iPhone 5s Gold', '42787825', 0, 2, '1280*1245*90', 9, 31, 11),
(11, 'iPad Air Wi-Fi + Cel', '42787825', 0, 2, '1280*1245*90', 9, 32, 11),
(12, 'Apple iPod nano 7G 1', '42787825', 0, 2, '1280*1245*90', 9, 33, 11),
(13, 'Роутер Wi-Fi Apple A', '42787825', 0, 2, '1280*1245*90', 9, 34, 11),
(14, 'Роутер Wi-Fi Apple A', '42787825', 0, 2, '1280*1245*90', 9, 35, 11);

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `tovar`
--
ALTER TABLE `tovar`
  ADD CONSTRAINT `tovar_ibfk_1` FOREIGN KEY (`f_k_category`) REFERENCES `category` (`id_category`),
  ADD CONSTRAINT `tovar_ibfk_2` FOREIGN KEY (`f_k_color_tovar`) REFERENCES `color_slv` (`id_color_slv`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
