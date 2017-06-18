-- phpMyAdmin SQL Dump
-- version 4.2.10.1
-- http://www.phpmyadmin.net
--
-- Хост: localhost
-- Время создания: Июн 18 2017 г., 22:30
-- Версия сервера: 5.6.21-log
-- Версия PHP: 5.6.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- База данных: `terainvest_him`
--

-- --------------------------------------------------------

--
-- Структура таблицы `address`
--

CREATE TABLE IF NOT EXISTS `address` (
`id` int(11) unsigned NOT NULL,
  `region_id` int(11) unsigned DEFAULT NULL COMMENT 'Код региона',
  `index` int(6) unsigned NOT NULL COMMENT 'Индекс',
  `settlement` varchar(64) NOT NULL COMMENT 'Населённый пункт',
  `street` varchar(64) NOT NULL COMMENT 'Улица',
  `house` varchar(10) NOT NULL COMMENT 'Дом',
  `corp` varchar(10) DEFAULT NULL COMMENT 'Корпус',
  `apartment` int(10) DEFAULT NULL COMMENT 'Офис/квартира'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Адреса';

-- --------------------------------------------------------

--
-- Структура таблицы `contact`
--

CREATE TABLE IF NOT EXISTS `contact` (
`id` int(11) unsigned NOT NULL,
  `create_dt` datetime NOT NULL COMMENT 'Дата создания',
  `update_dt` datetime NOT NULL COMMENT 'Дата обновления',
  `FIO` varchar(150) NOT NULL COMMENT 'ФИО',
  `phones` varchar(64) NOT NULL COMMENT 'Телефоны',
  `emails` varchar(255) NOT NULL COMMENT 'Адреса электронной почты'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Контактные лица';

-- --------------------------------------------------------

--
-- Структура таблицы `contact_links`
--

CREATE TABLE IF NOT EXISTS `contact_links` (
`id` int(11) unsigned NOT NULL,
  `object_type` int(3) unsigned NOT NULL COMMENT 'Тип объекта',
  `object_id` int(11) unsigned NOT NULL COMMENT 'ID объекта',
  `contact_id` int(11) unsigned NOT NULL COMMENT 'ID контакта'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `supplier`
--

CREATE TABLE IF NOT EXISTS `supplier` (
`id` int(10) unsigned NOT NULL,
  `create_dt` datetime NOT NULL COMMENT 'Дата создания',
  `update_dt` datetime NOT NULL COMMENT 'Дата обновления',
  `name` varchar(128) NOT NULL COMMENT 'Наименование поставщика',
  `description` text NOT NULL COMMENT 'Описание оставщика',
  `INN` varchar(12) NOT NULL COMMENT 'ИНН',
  `OGRN` varchar(13) NOT NULL COMMENT 'ОГРН',
  `jur_address_id` int(11) unsigned DEFAULT NULL COMMENT 'Юридический адрес',
  `fact_address_id` int(11) unsigned DEFAULT NULL COMMENT 'Фактический адрес',
  `post_address_id` int(11) unsigned DEFAULT NULL COMMENT 'Почтовый адрес',
  `logo` varchar(128) DEFAULT NULL COMMENT 'Файл логотипа',
  `phone` varchar(16) DEFAULT NULL COMMENT 'Основной телефон',
  `email` varchar(128) NOT NULL COMMENT 'Адрес электронной почты',
  `site` varchar(64) DEFAULT NULL COMMENT 'WEB-сайт',
  `note` text NOT NULL COMMENT 'Примечание'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Поставщики';

-- --------------------------------------------------------

--
-- Структура таблицы `warehouse`
--

CREATE TABLE IF NOT EXISTS `warehouse` (
`id` int(11) unsigned NOT NULL,
  `create_dt` datetime NOT NULL COMMENT 'Дата создания',
  `update_dt` datetime NOT NULL COMMENT 'Дата обновления',
  `supplier_id` int(11) unsigned NOT NULL COMMENT 'ID поставщика',
  `address_id` int(11) unsigned DEFAULT NULL COMMENT 'ID адреса',
  `work_hours` varchar(255) NOT NULL COMMENT 'Режим работы',
  `note` text NOT NULL COMMENT 'Примечание'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Склады';

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `address`
--
ALTER TABLE `address`
 ADD PRIMARY KEY (`id`), ADD KEY `region_id` (`region_id`), ADD KEY `settlement` (`settlement`);

--
-- Индексы таблицы `contact`
--
ALTER TABLE `contact`
 ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `contact_links`
--
ALTER TABLE `contact_links`
 ADD PRIMARY KEY (`id`), ADD KEY `object_type` (`object_type`), ADD KEY `object_id` (`object_id`), ADD KEY `contact_id` (`contact_id`);

--
-- Индексы таблицы `supplier`
--
ALTER TABLE `supplier`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `INN` (`INN`), ADD KEY `jur_address_id` (`jur_address_id`), ADD KEY `fact_address_id` (`fact_address_id`), ADD KEY `post_address_id` (`post_address_id`);

--
-- Индексы таблицы `warehouse`
--
ALTER TABLE `warehouse`
 ADD PRIMARY KEY (`id`), ADD KEY `supplier_id` (`supplier_id`), ADD KEY `address_id` (`address_id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `address`
--
ALTER TABLE `address`
MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT для таблицы `contact`
--
ALTER TABLE `contact`
MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT для таблицы `contact_links`
--
ALTER TABLE `contact_links`
MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT для таблицы `supplier`
--
ALTER TABLE `supplier`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT для таблицы `warehouse`
--
ALTER TABLE `warehouse`
MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT;
--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `address`
--
ALTER TABLE `address`
ADD CONSTRAINT `address_ibfk_1` FOREIGN KEY (`region_id`) REFERENCES `region` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `contact_links`
--
ALTER TABLE `contact_links`
ADD CONSTRAINT `contact_links_ibfk_1` FOREIGN KEY (`contact_id`) REFERENCES `contact` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `supplier`
--
ALTER TABLE `supplier`
ADD CONSTRAINT `supplier_ibfk_1` FOREIGN KEY (`jur_address_id`) REFERENCES `address` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
ADD CONSTRAINT `supplier_ibfk_2` FOREIGN KEY (`fact_address_id`) REFERENCES `address` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
ADD CONSTRAINT `supplier_ibfk_3` FOREIGN KEY (`post_address_id`) REFERENCES `address` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `warehouse`
--
ALTER TABLE `warehouse`
ADD CONSTRAINT `warehouse_ibfk_1` FOREIGN KEY (`supplier_id`) REFERENCES `supplier` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `warehouse_ibfk_2` FOREIGN KEY (`address_id`) REFERENCES `address` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
