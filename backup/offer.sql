-- phpMyAdmin SQL Dump
-- version 4.2.10.1
-- http://www.phpmyadmin.net
--
-- Хост: localhost
-- Время создания: Июл 25 2017 г., 22:58
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
-- Структура таблицы `offer`
--

CREATE TABLE IF NOT EXISTS `offer` (
`id` int(11) unsigned NOT NULL,
  `product_id` int(10) unsigned NOT NULL COMMENT 'ID товара',
  `supplier_id` int(10) unsigned NOT NULL COMMENT 'ID поставщика',
  `warehouse_id` int(11) unsigned NOT NULL COMMENT 'ID склада',
  `update_dt` datetime NOT NULL COMMENT 'Дата последнего обновления',
  `price` decimal(11,2) NOT NULL COMMENT 'Цена',
  `uom_count` decimal(11,3) unsigned NOT NULL COMMENT 'Количество единиц измерения',
  `uom_id` int(5) unsigned DEFAULT NULL COMMENT 'Единица измерения'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Цены на товары';

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `product_price`
--
ALTER TABLE `offer`
 ADD PRIMARY KEY (`id`), ADD KEY `product_id` (`product_id`), ADD KEY `supplier_id` (`supplier_id`), ADD KEY `warehouse_id` (`warehouse_id`), ADD KEY `uom_id` (`uom_id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `product_price`
--
ALTER TABLE `offer`
MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT;
--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `product_price`
--
ALTER TABLE `offer`
ADD CONSTRAINT `offer_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`) ON UPDATE CASCADE,
ADD CONSTRAINT `offer_ibfk_2` FOREIGN KEY (`supplier_id`) REFERENCES `supplier` (`id`) ON UPDATE CASCADE,
ADD CONSTRAINT `offer_ibfk_3` FOREIGN KEY (`warehouse_id`) REFERENCES `warehouse` (`id`) ON UPDATE CASCADE,
ADD CONSTRAINT `offer_ibfk_4` FOREIGN KEY (`uom_id`) REFERENCES `uom` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
