-- phpMyAdmin SQL Dump
-- version 4.2.10.1
-- http://www.phpmyadmin.net
--
-- Хост: localhost
-- Время создания: Мар 12 2017 г., 20:46
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

CREATE TABLE IF NOT EXISTS `address` (
`id` int(10) unsigned NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Адреса';

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

-- --------------------------------------------------------

--
-- Структура таблицы `catalogue`
--

CREATE TABLE IF NOT EXISTS `catalogue` (
`id` int(5) unsigned NOT NULL,
  `name` varchar(32) NOT NULL COMMENT 'Наименование каталога',
  `description` text COMMENT 'Описание'
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COMMENT='Каталоги';

--
-- Дамп данных таблицы `catalogue`
--

INSERT INTO `catalogue` (`id`, `name`, `description`) VALUES
(1, 'Технический каталог', 'самый первый каталог. для теста'),
(2, 'Интуитивный каталог', 'Интуитивно понятный каталог продукции');

-- --------------------------------------------------------

--
-- Структура таблицы `category`
--

CREATE TABLE IF NOT EXISTS `category` (
`id` int(10) unsigned NOT NULL,
  `list_position` int(11) unsigned DEFAULT NULL COMMENT 'Позиция категории в списке',
  `catalogue_id` int(5) unsigned NOT NULL COMMENT 'ИД каталога',
  `parent_id` int(10) unsigned DEFAULT NULL COMMENT 'Родительская категория',
  `name` varchar(128) NOT NULL COMMENT 'Наименование',
  `description` text COMMENT 'Описание',
  `meta_desc` varchar(128) NOT NULL COMMENT 'SEO описание',
  `meta_keys` varchar(128) NOT NULL COMMENT 'SEO ключевые слова'
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COMMENT='Категории продукции';

--
-- Дамп данных таблицы `category`
--

INSERT INTO `category` (`id`, `list_position`, `catalogue_id`, `parent_id`, `name`, `description`, `meta_desc`, `meta_keys`) VALUES
(1, 1, 1, 3, 'Эпоксидные смолы', '<p><span class="ql-size-large">Э</span>поксидная смола – продукт синтетического происхождения, получаемый в результате поликонденсации эпихлоргидрина в сочетании с фенолами. Данный материал отличается универсальностью, что определяет широкую сферу его использования: из всех видов смол только эпоксидная используется так часто при производстве материалов композитного состава. Высокая востребованность продукции данного вида неслучайна, так как именно эпоксидная смола дает лучшие результаты по прочности и иным качественным параметрам, сохраняя привлекательную цену и доступность.</p>', 'Эпоксидная смола', 'смола,эпоксидная'),
(2, 2, 1, NULL, 'Отвердители', 'Отвердитель – соединение особого вида, вводимое в небольших дозах в отделочные и строительные материалы, а также в эпоксидную смолу.\r\nТакие соединения предназначены для перевода основного материала в твердую форму. В случае с эпоксидной смолой отвердители используются для полимеризации, при этом процесс перевода пластичной смолы в твердое состояние может происходить как с нагревом смеси, так и без него.\r\nРазличные типы отвердителей могут состоять из разнообразных соединений: амины, ангидриды, перекись бензоила, кислоты разного типа.', 'Отвердители', 'отвердитель'),
(3, 3, 1, NULL, 'Добавки и катализаторы', 'В роли добавок и катализаторов для эпоксидных смол выступают вещества, добавляемые в малых дозах эпоксидную смолу с отвердителем, что стимулирует ускорение протекающих реакций.\r\nТочная дозировка добавок определяется потребностью в конечных свойствах, которыми будет обладать конечный продукт.\r\nПрименение ускорителей оправдано при значительных объемах выполняемых работ и небольших сроках на их проведение. Равно как при использовании в составе долготвердеющей эпоксидной смолы.\r\n ', 'добавки и отвердители', 'добавки, отвердители'),
(4, 4, 1, 3, 'Алкофен (DMP-30) в Казани', 'Алкофен входит в группу добавок и катализаторов для эпоксидных смол и выступает в качестве компонента для изготовления композитной стеклопластиковой арматуры. С его помощью осуществляется ускорение полимеризации связующего агента, благодаря чему процесс производства армирующих материалов получил промышленный масштаб. При отсутствии ускорителя и температурного воздействия на процесс полимеризация эпоксидной смолы занимала бы несколько часов.\r\n\r\nПо внешнему виду Алкофен – однородная прозрачная жидкость вязкой структуры, может иметь несколько оттенков (от светлого до темно-янтарного). В отвердителе отсутствуют посторонние включения и примеси.', 'алкофен', 'алкофен'),
(5, 5, 1, NULL, 'Ровинг (стекловолокно)', 'Ровинг представляет собой изделие стекловолоконного типа в виде тонкой нити c не скручивающимися между собой волокнами.\r\n\r\nДля лучшей пропитки изделия полиэфирными, эпоксидными и другими видами смол в его состав включаются замасливатели. Для удобства транспортировки и дальнейшего использования материал наматывается на бобины, обтягиваемые герметично прилегаемой пленкой.\r\n\r\nВ результате производственных процессов ровинг становится прочным материалом с отличными физико-механическими качествами. Лежащее в основе стекло наделяет материал невосприимчивостью к коррозии, а также воздействию других химвеществ, материал отличается легким весом, термоустойчивостью, проявляет свойства диэлектрика.', 'Ровинг (стекловолокно)', 'стекловолокно'),
(6, 1, 2, NULL, 'Все для производства', 'Тестовая категория интуитивного каталога', 'Все для производства', 'для производства, '),
(10, 2, 2, NULL, 'тест', 'тест изображений', 'тест', 'тест');

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
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COMMENT='Картинки категорий';

--
-- Дамп данных таблицы `category_img`
--

INSERT INTO `category_img` (`id`, `category_id`, `name`, `is_main`, `date_add`, `date_upd`) VALUES
(3, 1, '1c17b5ca1274670b3804754f0dc1e7a9_1.jpg', 1, 0x323031372d30332d30322032303a33303a3336, 0x323031372d30332d30322032303a33303a3433),
(4, 1, '1c17b5ca1274670b3804754f0dc1e7a9_2.jpg', 0, 0x323031372d30332d30322032303a33323a3031, 0x323031372d30332d30322032303a33323a3031);

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

-- --------------------------------------------------------

--
-- Структура таблицы `feature`
--

CREATE TABLE IF NOT EXISTS `feature` (
`id` int(10) unsigned NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Характеристики';

-- --------------------------------------------------------

--
-- Структура таблицы `image`
--

CREATE TABLE IF NOT EXISTS `image` (
`id` int(10) unsigned NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Изображения';

-- --------------------------------------------------------

--
-- Структура таблицы `manufacturer`
--

CREATE TABLE IF NOT EXISTS `manufacturer` (
`id` int(10) unsigned NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Производители';

-- --------------------------------------------------------

--
-- Структура таблицы `migration`
--

CREATE TABLE IF NOT EXISTS `migration` (
  `version` varchar(180) NOT NULL,
  `apply_time` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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

-- --------------------------------------------------------

--
-- Структура таблицы `product`
--

CREATE TABLE IF NOT EXISTS `product` (
`id` int(10) unsigned NOT NULL,
  `manufacturer_id` int(10) unsigned DEFAULT NULL COMMENT 'Идентификатор производителя'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Товары';

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

-- --------------------------------------------------------

--
-- Структура таблицы `setting`
--

CREATE TABLE IF NOT EXISTS `setting` (
`id` int(10) unsigned NOT NULL,
  `param` varchar(64) NOT NULL COMMENT 'Наименование настройки',
  `value` varchar(128) NOT NULL COMMENT 'Значение настройки'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Настройки';

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
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `uq_pos_catalogue_idx` (`list_position`,`catalogue_id`) COMMENT 'Позиция в каталоге уникальна', ADD KEY `name` (`name`), ADD KEY `catalogue_id` (`catalogue_id`), ADD KEY `parent_id` (`parent_id`), ADD KEY `list_position` (`list_position`);

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
MODIFY `id` int(5) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT для таблицы `category`
--
ALTER TABLE `category`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT для таблицы `category_img`
--
ALTER TABLE `category_img`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
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
ADD CONSTRAINT `category_ibfk_1` FOREIGN KEY (`catalogue_id`) REFERENCES `catalogue` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `category_ibfk_2` FOREIGN KEY (`parent_id`) REFERENCES `category` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

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
