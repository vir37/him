-- phpMyAdmin SQL Dump
-- version 4.2.8.1
-- http://www.phpmyadmin.net
--
-- Хост: localhost
-- Время создания: Янв 11 2017 г., 20:23
-- Версия сервера: 5.6.21-log
-- Версия PHP: 5.4.45

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- База данных: `him`
--
CREATE DATABASE IF NOT EXISTS `him` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `him`;

-- --------------------------------------------------------

--
-- Структура таблицы `address`
--

DROP TABLE IF EXISTS `address`;
CREATE TABLE IF NOT EXISTS `address` (
`id` int(10) unsigned NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Адреса';

-- --------------------------------------------------------

--
-- Структура таблицы `category`
--

DROP TABLE IF EXISTS `category`;
CREATE TABLE IF NOT EXISTS `category` (
`id` int(10) unsigned NOT NULL,
  `parent_id` int(10) unsigned DEFAULT NULL COMMENT 'Родительская категория',
  `name` varchar(128) NOT NULL COMMENT 'Наименование',
  `description` text COMMENT 'Описание',
  `meta_desc` varchar(128) NOT NULL COMMENT 'SEO описание',
  `meta_keys` varchar(128) NOT NULL COMMENT 'SEO ключевые слова'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Категории продукции';

-- --------------------------------------------------------

--
-- Структура таблицы `category_img`
--

DROP TABLE IF EXISTS `category_img`;
CREATE TABLE IF NOT EXISTS `category_img` (
`id` int(10) unsigned NOT NULL,
  `category_id` int(10) unsigned NOT NULL COMMENT 'Идентификатор категории',
  `name` varchar(128) NOT NULL COMMENT 'Наименование файла изображения',
  `is_main` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'Признак главной фотографии',
  `date_add` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Дата создания',
  `date_upd` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT 'Дата обновления'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Картинки категорий';

-- --------------------------------------------------------

--
-- Структура таблицы `city`
--

DROP TABLE IF EXISTS `city`;
CREATE TABLE IF NOT EXISTS `city` (
`id` int(11) unsigned NOT NULL,
  `region_id` int(10) unsigned NOT NULL COMMENT 'Код региона',
  `name` varchar(32) NOT NULL COMMENT 'Наименование города',
  `uri_name` varchar(32) NOT NULL COMMENT 'Наименование города для URL',
  `index` int(6) unsigned NOT NULL COMMENT 'Почтовый индекс',
  `latitude` decimal(11,8) DEFAULT NULL COMMENT 'Широта',
  `longitude` decimal(11,8) DEFAULT NULL COMMENT 'Долгота'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Города';

-- --------------------------------------------------------

--
-- Структура таблицы `feature`
--

DROP TABLE IF EXISTS `feature`;
CREATE TABLE IF NOT EXISTS `feature` (
`id` int(10) unsigned NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Характеристики';

-- --------------------------------------------------------

--
-- Структура таблицы `manufacturer`
--

DROP TABLE IF EXISTS `manufacturer`;
CREATE TABLE IF NOT EXISTS `manufacturer` (
`id` int(10) unsigned NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Производители';

-- --------------------------------------------------------

--
-- Структура таблицы `offer`
--

DROP TABLE IF EXISTS `offer`;
CREATE TABLE IF NOT EXISTS `offer` (
`id` int(10) unsigned NOT NULL,
  `product_id` int(10) unsigned NOT NULL COMMENT 'Идентификатор товара',
  `supplier_id` int(10) unsigned NOT NULL COMMENT 'Идентификатор поставщика'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Товарные предложения';

-- --------------------------------------------------------

--
-- Структура таблицы `product`
--

DROP TABLE IF EXISTS `product`;
CREATE TABLE IF NOT EXISTS `product` (
`id` int(10) unsigned NOT NULL,
  `manufacturer_id` int(10) unsigned DEFAULT NULL COMMENT 'Идентификатор производителя'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Товары';

-- --------------------------------------------------------

--
-- Структура таблицы `product_img`
--

DROP TABLE IF EXISTS `product_img`;
CREATE TABLE IF NOT EXISTS `product_img` (
`id` int(10) unsigned NOT NULL,
  `product_id` int(10) unsigned NOT NULL COMMENT 'Идентификатор товара',
  `name` varchar(128) NOT NULL COMMENT 'Наименование файла изображения',
  `is_main` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'Признак главной фотографии',
  `date_add` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Дата создания',
  `date_upd` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT 'Дата обновления'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Изображения товаров';

-- --------------------------------------------------------

--
-- Структура таблицы `region`
--

DROP TABLE IF EXISTS `region`;
CREATE TABLE IF NOT EXISTS `region` (
`id` int(11) unsigned NOT NULL,
  `code` int(2) unsigned zerofill NOT NULL COMMENT 'Код региона',
  `name` varchar(64) NOT NULL COMMENT 'Название региона',
  `capital` varchar(32) NOT NULL COMMENT 'Столица',
  `district` varchar(32) NOT NULL COMMENT 'Округ'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Регионы';

-- --------------------------------------------------------

--
-- Структура таблицы `setting`
--

DROP TABLE IF EXISTS `setting`;
CREATE TABLE IF NOT EXISTS `setting` (
`id` int(10) unsigned NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Настройки';

-- --------------------------------------------------------

--
-- Структура таблицы `supplier`
--

DROP TABLE IF EXISTS `supplier`;
CREATE TABLE IF NOT EXISTS `supplier` (
`id` int(10) unsigned NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Поставщики';

-- --------------------------------------------------------

--
-- Структура таблицы `warehouse`
--

DROP TABLE IF EXISTS `warehouse`;
CREATE TABLE IF NOT EXISTS `warehouse` (
`id` int(10) unsigned NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Склады';

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `address`
--
ALTER TABLE `address`
 ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `category`
--
ALTER TABLE `category`
 ADD PRIMARY KEY (`id`), ADD KEY `name` (`name`);

--
-- Индексы таблицы `category_img`
--
ALTER TABLE `category_img`
 ADD PRIMARY KEY (`id`), ADD KEY `category_id` (`category_id`);

--
-- Индексы таблицы `city`
--
ALTER TABLE `city`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `index` (`index`), ADD KEY `name` (`name`);

--
-- Индексы таблицы `feature`
--
ALTER TABLE `feature`
 ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `manufacturer`
--
ALTER TABLE `manufacturer`
 ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `offer`
--
ALTER TABLE `offer`
 ADD PRIMARY KEY (`id`), ADD KEY `product_id` (`product_id`), ADD KEY `supplier_id` (`supplier_id`);

--
-- Индексы таблицы `product`
--
ALTER TABLE `product`
 ADD PRIMARY KEY (`id`), ADD KEY `manufacturer_id` (`manufacturer_id`);

--
-- Индексы таблицы `product_img`
--
ALTER TABLE `product_img`
 ADD PRIMARY KEY (`id`), ADD KEY `product_id` (`product_id`);

--
-- Индексы таблицы `region`
--
ALTER TABLE `region`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `code` (`code`);

--
-- Индексы таблицы `setting`
--
ALTER TABLE `setting`
 ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `supplier`
--
ALTER TABLE `supplier`
 ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `warehouse`
--
ALTER TABLE `warehouse`
 ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `address`
--
ALTER TABLE `address`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT для таблицы `category`
--
ALTER TABLE `category`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT для таблицы `category_img`
--
ALTER TABLE `category_img`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT для таблицы `city`
--
ALTER TABLE `city`
MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT для таблицы `feature`
--
ALTER TABLE `feature`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT для таблицы `manufacturer`
--
ALTER TABLE `manufacturer`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT для таблицы `offer`
--
ALTER TABLE `offer`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT для таблицы `product`
--
ALTER TABLE `product`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT для таблицы `product_img`
--
ALTER TABLE `product_img`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT для таблицы `region`
--
ALTER TABLE `region`
MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT для таблицы `setting`
--
ALTER TABLE `setting`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT для таблицы `supplier`
--
ALTER TABLE `supplier`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT для таблицы `warehouse`
--
ALTER TABLE `warehouse`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `category_img`
--
ALTER TABLE `category_img`
ADD CONSTRAINT `category_img_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `offer`
--
ALTER TABLE `offer`
ADD CONSTRAINT `offer_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `offer_ibfk_2` FOREIGN KEY (`supplier_id`) REFERENCES `supplier` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `product`
--
ALTER TABLE `product`
ADD CONSTRAINT `product_ibfk_1` FOREIGN KEY (`manufacturer_id`) REFERENCES `manufacturer` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `product_img`
--
ALTER TABLE `product_img`
ADD CONSTRAINT `product_img_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
