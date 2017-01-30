-- phpMyAdmin SQL Dump
-- version 4.2.10.1
-- http://www.phpmyadmin.net
--
-- Хост: localhost
-- Время создания: Янв 20 2017 г., 23:17
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
-- DROP DATABASE `him`;
CREATE DATABASE IF NOT EXISTS `him` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `him`;

-- --------------------------------------------------------

--
-- Структура таблицы `address`
--

CREATE TABLE IF NOT EXISTS `address` (
`id` int(10) unsigned NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Адреса';

--
-- Очистить таблицу перед добавлением данных `address`
--

TRUNCATE TABLE `address`;
-- --------------------------------------------------------

--
-- Структура таблицы `auth_assignment`
--

CREATE TABLE IF NOT EXISTS `auth_assignment` (
  `item_name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `user_id` int(11) unsigned NOT NULL COMMENT 'Ссылка на id пользователя',
  `created_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Очистить таблицу перед добавлением данных `auth_assignment`
--

TRUNCATE TABLE `auth_assignment`;
--
-- Дамп данных таблицы `auth_assignment`
--

INSERT INTO `auth_assignment` (`item_name`, `user_id`, `created_at`) VALUES
('admin', 4, 1484418942);

-- --------------------------------------------------------

--
-- Структура таблицы `auth_item`
--

CREATE TABLE IF NOT EXISTS `auth_item` (
  `name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `type` int(11) NOT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `rule_name` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `data` text COLLATE utf8_unicode_ci,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Очистить таблицу перед добавлением данных `auth_item`
--

TRUNCATE TABLE `auth_item`;
--
-- Дамп данных таблицы `auth_item`
--

INSERT INTO `auth_item` (`name`, `type`, `description`, `rule_name`, `data`, `created_at`, `updated_at`) VALUES
('admin', 1, 'Administrator', NULL, NULL, 1484246714, 1484246714),
('createSupplier', 2, 'Can create the supplier', NULL, NULL, 1484415751, 1484415751),
('guest', 1, 'Guest', NULL, NULL, 1484246770, 1484246770),
('manager', 1, 'Manager', NULL, NULL, 1484246752, 1484246752);

-- --------------------------------------------------------

--
-- Структура таблицы `auth_item_child`
--

CREATE TABLE IF NOT EXISTS `auth_item_child` (
  `parent` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `child` varchar(64) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Очистить таблицу перед добавлением данных `auth_item_child`
--

TRUNCATE TABLE `auth_item_child`;
-- --------------------------------------------------------

--
-- Структура таблицы `auth_rule`
--

CREATE TABLE IF NOT EXISTS `auth_rule` (
  `name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `data` text COLLATE utf8_unicode_ci,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Очистить таблицу перед добавлением данных `auth_rule`
--

TRUNCATE TABLE `auth_rule`;
-- --------------------------------------------------------

--
-- Структура таблицы `catalogue`
--

CREATE TABLE IF NOT EXISTS `catalogue` (
`id` int(5) unsigned NOT NULL,
  `name` varchar(32) NOT NULL COMMENT 'Наименование каталога',
  `description` text COMMENT 'Описание'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Каталоги';

--
-- Очистить таблицу перед добавлением данных `catalogue`
--

TRUNCATE TABLE `catalogue`;
-- --------------------------------------------------------

--
-- Структура таблицы `category`
--

CREATE TABLE IF NOT EXISTS `category` (
`id` int(10) unsigned NOT NULL,
  `catalogue_id` int(5) unsigned NOT NULL COMMENT 'ИД каталога',
  `parent_id` int(10) unsigned DEFAULT NULL COMMENT 'Родительская категория',
  `name` varchar(128) NOT NULL COMMENT 'Наименование',
  `description` text COMMENT 'Описание',
  `meta_desc` varchar(128) NOT NULL COMMENT 'SEO описание',
  `meta_keys` varchar(128) NOT NULL COMMENT 'SEO ключевые слова'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Категории продукции';

--
-- Очистить таблицу перед добавлением данных `category`
--

TRUNCATE TABLE `category`;
-- --------------------------------------------------------

--
-- Структура таблицы `category_img`
--

CREATE TABLE IF NOT EXISTS `category_img` (
`id` int(10) unsigned NOT NULL,
  `category_id` int(10) unsigned NOT NULL COMMENT 'Идентификатор категории',
  `name` varchar(128) NOT NULL COMMENT 'Наименование файла изображения',
  `is_main` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'Признак главной фотографии',
  `date_add` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Дата создания',
  `date_upd` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT 'Дата обновления'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Картинки категорий';

--
-- Очистить таблицу перед добавлением данных `category_img`
--

TRUNCATE TABLE `category_img`;
-- --------------------------------------------------------

--
-- Структура таблицы `city`
--

CREATE TABLE IF NOT EXISTS `city` (
`id` int(11) unsigned NOT NULL,
  `region_id` int(10) unsigned NOT NULL COMMENT 'Код региона',
  `name` varchar(32) NOT NULL COMMENT 'Наименование города',
  `uri_name` varchar(32) NOT NULL COMMENT 'Наименование города для URL',
  `index` int(6) unsigned NOT NULL COMMENT 'Почтовый индекс',
  `latitude` decimal(11,8) DEFAULT NULL COMMENT 'Широта',
  `longitude` decimal(11,8) DEFAULT NULL COMMENT 'Долгота'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Города';

--
-- Очистить таблицу перед добавлением данных `city`
--

TRUNCATE TABLE `city`;
-- --------------------------------------------------------

--
-- Структура таблицы `feature`
--

CREATE TABLE IF NOT EXISTS `feature` (
`id` int(10) unsigned NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Характеристики';

--
-- Очистить таблицу перед добавлением данных `feature`
--

TRUNCATE TABLE `feature`;
-- --------------------------------------------------------

--
-- Структура таблицы `image`
--

CREATE TABLE IF NOT EXISTS `image` (
`id` int(10) unsigned NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Изображения';

--
-- Очистить таблицу перед добавлением данных `image`
--

TRUNCATE TABLE `image`;
-- --------------------------------------------------------

--
-- Структура таблицы `manufacturer`
--

CREATE TABLE IF NOT EXISTS `manufacturer` (
`id` int(10) unsigned NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Производители';

--
-- Очистить таблицу перед добавлением данных `manufacturer`
--

TRUNCATE TABLE `manufacturer`;
-- --------------------------------------------------------

--
-- Структура таблицы `migration`
--

CREATE TABLE IF NOT EXISTS `migration` (
  `version` varchar(180) NOT NULL,
  `apply_time` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Очистить таблицу перед добавлением данных `migration`
--

TRUNCATE TABLE `migration`;
--
-- Дамп данных таблицы `migration`
--

INSERT INTO `migration` (`version`, `apply_time`) VALUES
('m000000_000000_base', 1483878830),
('m130524_201442_init', 1483878840),
('m140506_102106_rbac_init', 1484244123);

-- --------------------------------------------------------

--
-- Структура таблицы `offer`
--

CREATE TABLE IF NOT EXISTS `offer` (
`id` int(10) unsigned NOT NULL,
  `product_id` int(10) unsigned NOT NULL COMMENT 'Идентификатор товара',
  `supplier_id` int(10) unsigned NOT NULL COMMENT 'Идентификатор поставщика'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Товарные предложения';

--
-- Очистить таблицу перед добавлением данных `offer`
--

TRUNCATE TABLE `offer`;
-- --------------------------------------------------------

--
-- Структура таблицы `product`
--

CREATE TABLE IF NOT EXISTS `product` (
`id` int(10) unsigned NOT NULL,
  `manufacturer_id` int(10) unsigned DEFAULT NULL COMMENT 'Идентификатор производителя'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Товары';

--
-- Очистить таблицу перед добавлением данных `product`
--

TRUNCATE TABLE `product`;
-- --------------------------------------------------------

--
-- Структура таблицы `product_img`
--

CREATE TABLE IF NOT EXISTS `product_img` (
`id` int(10) unsigned NOT NULL,
  `product_id` int(10) unsigned NOT NULL COMMENT 'Идентификатор товара',
  `name` varchar(128) NOT NULL COMMENT 'Наименование файла изображения',
  `is_main` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'Признак главной фотографии',
  `date_add` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Дата создания',
  `date_upd` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT 'Дата обновления'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Изображения товаров';

--
-- Очистить таблицу перед добавлением данных `product_img`
--

TRUNCATE TABLE `product_img`;
-- --------------------------------------------------------

--
-- Структура таблицы `region`
--

CREATE TABLE IF NOT EXISTS `region` (
`id` int(11) unsigned NOT NULL,
  `code` int(2) unsigned zerofill NOT NULL COMMENT 'Код региона',
  `name` varchar(64) NOT NULL COMMENT 'Название региона',
  `capital` varchar(32) NOT NULL COMMENT 'Столица',
  `district` varchar(32) NOT NULL COMMENT 'Округ'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Регионы';

--
-- Очистить таблицу перед добавлением данных `region`
--

TRUNCATE TABLE `region`;
-- --------------------------------------------------------

--
-- Структура таблицы `setting`
--

CREATE TABLE IF NOT EXISTS `setting` (
`id` int(10) unsigned NOT NULL,
  `param` varchar(64) NOT NULL COMMENT 'Наименование настройки',
  `value` varchar(128) NOT NULL COMMENT 'Значение настройки'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Настройки';

--
-- Очистить таблицу перед добавлением данных `setting`
--

TRUNCATE TABLE `setting`;
-- --------------------------------------------------------

--
-- Структура таблицы `supplier`
--

CREATE TABLE IF NOT EXISTS `supplier` (
`id` int(10) unsigned NOT NULL,
  `name` varchar(128) NOT NULL COMMENT 'Наименование поставщика',
  `description` text NOT NULL COMMENT 'Описание оставщика',
  `jur_address_id` int(11) unsigned DEFAULT NULL COMMENT 'Юридический адрес',
  `fact_address_id` int(11) unsigned DEFAULT NULL COMMENT 'Фактический адрес',
  `post_address_id` int(11) unsigned DEFAULT NULL COMMENT 'Почтовый адрес',
  `logo` varchar(128) DEFAULT NULL COMMENT 'Файл логотипа',
  `phone` varchar(16) DEFAULT NULL COMMENT 'Основной телефон',
  `site` varchar(64) DEFAULT NULL COMMENT 'WEB-сайт'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Поставщики';

--
-- Очистить таблицу перед добавлением данных `supplier`
--

TRUNCATE TABLE `supplier`;
-- --------------------------------------------------------

--
-- Структура таблицы `user`
--

CREATE TABLE IF NOT EXISTS `user` (
`id` int(11) NOT NULL,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `auth_key` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `password_hash` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password_reset_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` smallint(6) NOT NULL DEFAULT '10',
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Очистить таблицу перед добавлением данных `user`
--

TRUNCATE TABLE `user`;
--
-- Дамп данных таблицы `user`
--

INSERT INTO `user` (`id`, `username`, `auth_key`, `password_hash`, `password_reset_token`, `email`, `status`, `created_at`, `updated_at`) VALUES
(4, 'sasha', 'ra0CWLbdGaQbnb2rdPp5E0mDoms-pJmz', '$2y$13$i9G5Gs/PUFXs9wQvFFBl9emJG4AmGg7hz7urR3kOc1Gdlh4KHiOja', NULL, 'vir37@rambler.ru', 10, 1484418942, 1484418942);

-- --------------------------------------------------------

--
-- Структура таблицы `warehouse`
--

CREATE TABLE IF NOT EXISTS `warehouse` (
`id` int(10) unsigned NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Склады';

--
-- Очистить таблицу перед добавлением данных `warehouse`
--

TRUNCATE TABLE `warehouse`;
--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `address`
--
ALTER TABLE `address`
 ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `auth_assignment`
--
ALTER TABLE `auth_assignment`
 ADD PRIMARY KEY (`item_name`,`user_id`), ADD KEY `idx_user_id` (`user_id`);

--
-- Индексы таблицы `auth_item`
--
ALTER TABLE `auth_item`
 ADD PRIMARY KEY (`name`), ADD KEY `rule_name` (`rule_name`), ADD KEY `idx-auth_item-type` (`type`);

--
-- Индексы таблицы `auth_item_child`
--
ALTER TABLE `auth_item_child`
 ADD PRIMARY KEY (`parent`,`child`), ADD KEY `child` (`child`);

--
-- Индексы таблицы `auth_rule`
--
ALTER TABLE `auth_rule`
 ADD PRIMARY KEY (`name`);

--
-- Индексы таблицы `catalogue`
--
ALTER TABLE `catalogue`
 ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `category`
--
ALTER TABLE `category`
 ADD PRIMARY KEY (`id`), ADD KEY `name` (`name`), ADD KEY `catalogue_id` (`catalogue_id`);

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
-- Индексы таблицы `image`
--
ALTER TABLE `image`
 ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `manufacturer`
--
ALTER TABLE `manufacturer`
 ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `migration`
--
ALTER TABLE `migration`
 ADD PRIMARY KEY (`version`);

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
 ADD PRIMARY KEY (`id`), ADD KEY `param` (`param`);

--
-- Индексы таблицы `supplier`
--
ALTER TABLE `supplier`
 ADD PRIMARY KEY (`id`), ADD KEY `jur_address_id` (`jur_address_id`), ADD KEY `fact_address_id` (`fact_address_id`), ADD KEY `post_address_id` (`post_address_id`);

--
-- Индексы таблицы `user`
--
ALTER TABLE `user`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `username` (`username`), ADD UNIQUE KEY `email` (`email`), ADD UNIQUE KEY `password_reset_token` (`password_reset_token`);

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
-- AUTO_INCREMENT для таблицы `catalogue`
--
ALTER TABLE `catalogue`
MODIFY `id` int(5) unsigned NOT NULL AUTO_INCREMENT;
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
-- AUTO_INCREMENT для таблицы `image`
--
ALTER TABLE `image`
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
-- AUTO_INCREMENT для таблицы `user`
--
ALTER TABLE `user`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT для таблицы `warehouse`
--
ALTER TABLE `warehouse`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `auth_assignment`
--
ALTER TABLE `auth_assignment`
ADD CONSTRAINT `auth_assignment_ibfk_1` FOREIGN KEY (`item_name`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `auth_item`
--
ALTER TABLE `auth_item`
ADD CONSTRAINT `auth_item_ibfk_1` FOREIGN KEY (`rule_name`) REFERENCES `auth_rule` (`name`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `auth_item_child`
--
ALTER TABLE `auth_item_child`
ADD CONSTRAINT `auth_item_child_ibfk_1` FOREIGN KEY (`parent`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `auth_item_child_ibfk_2` FOREIGN KEY (`child`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `category`
--
ALTER TABLE `category`
ADD CONSTRAINT `category_ibfk_1` FOREIGN KEY (`catalogue_id`) REFERENCES `catalogue` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

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

--
-- Ограничения внешнего ключа таблицы `supplier`
--
ALTER TABLE `supplier`
ADD CONSTRAINT `supplier_ibfk_1` FOREIGN KEY (`jur_address_id`) REFERENCES `address` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `supplier_ibfk_2` FOREIGN KEY (`fact_address_id`) REFERENCES `address` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `supplier_ibfk_3` FOREIGN KEY (`post_address_id`) REFERENCES `address` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
