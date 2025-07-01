-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Апр 18 2021 г., 00:54
-- Версия сервера: 5.7.25
-- Версия PHP: 5.6.38

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `om`
--

-- --------------------------------------------------------

--
-- Структура таблицы `om_2checkout`
--

CREATE TABLE `om_2checkout` (
  `id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `om_ad`
--

CREATE TABLE `om_ad` (
  `id` int(11) NOT NULL,
  `good_id` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `code` text NOT NULL,
  `adcategory_id` int(11) NOT NULL,
  `position` int(11) NOT NULL DEFAULT '0',
  `showcode` tinyint(4) NOT NULL DEFAULT '1'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `om_ad`
--

INSERT INTO `om_ad` (`id`, `good_id`, `title`, `code`, `adcategory_id`, `position`, `showcode`) VALUES
(1, 'cisco', 'Прозрачная png-картинка 300px', '<a href=\"%reflink%\" target=\"_top\" title=\"Обучающий курс Сиськи по-русски или 11 простых шагов по сетевым технологиям Cisco на русском языке\"><img alt=\"Обучающий курс Сиськи по-русски или 11 простых шагов по сетевым технологиям Cisco на русском языке\" border=\"0px\" height=\"387px\" src=\"http://rolar.ru/cisco/images/ccna-book300.png\" title=\"Обучающий курс Сиськи по-русски или 11 простых шагов по сетевым технологиям Cisco на русском языке\" width=\"300px\"></a>', 3, 1, 1),
(2, 'cisco', 'Прозрачная png-картинка 600px', '<a href=\"%reflink%\" target=\"_top\" title=\"Обучающий курс Сиськи по-русски или 11 простых шагов по сетевым технологиям Cisco на русском языке\"><img alt=\"Обучающий курс Сиськи по-русски или 11 простых шагов по сетевым технологиям Cisco на русском языке\" border=\"0px\" height=\"774px\" src=\"http://rolar.ru/cisco/images/ccna-book600.png\" title=\"Обучающий курс Сиськи по-русски или 11 простых шагов по сетевым технологиям Cisco на русском языке\" width=\"600px\"></a>', 3, 2, 1),
(3, 'cisco', 'Прозрачная png-картинка 910px', '<a href=\"%reflink%\" target=\"_top\" title=\"Обучающий курс Сиськи по-русски или 11 простых шагов по сетевым технологиям Cisco на русском языке\"><img alt=\"Обучающий курс Сиськи по-русски или 11 простых шагов по сетевым технологиям Cisco на русском языке с бонусами и гарантией\" border=\"0px\" height=\"683px\" src=\"http://rolar.ru/cisco/images/ccna_all.png\" title=\"Обучающий курс Сиськи по-русски или 11 простых шагов по сетевым технологиям Cisco на русском языке с бонусами и гарантией\" width=\"910px\"></a>', 3, 3, 1),
(4, 'comp', 'Прозрачная png-картинка1 600px', '<a href=\"%reflink%\" target=\"_top\" title=\"Как стать уверенным пользователем ПК за 13 часов?\"><img alt=\"Как стать уверенным пользователем ПК за 13 часов?\" border=\"0px\" height=\"705px\" src=\"http://rolar.ru/comp/images/3dbox1.png\" title=\"Как стать уверенным пользователем ПК за 13 часов?\" width=\"600px\"></a>', 4, 4, 1),
(5, 'comp', 'Прозрачная png-картинка2 600px', '<a href=\"%reflink%\" target=\"_top\" title=\"Как стать уверенным пользователем ПК за 13 часов?\"><img alt=\"Как стать уверенным пользователем ПК за 13 часов?\" border=\"0px\" height=\"764px\" src=\"http://rolar.ru/comp/images/3dbox2.png\" title=\"Как стать уверенным пользователем ПК за 13 часов?\" width=\"600px\"></a>', 4, 5, 1),
(6, 'comp', 'Прозрачная png-картинка 400px', '<a href=\"%reflink%\" target=\"_top\" title=\"Как стать уверенным пользователем ПК за 13 часов?\"><img alt=\"Как стать уверенным пользователем ПК за 13 часов?\" border=\"0px\" height=\"470px\" src=\"http://rolar.ru/comp/images/small3dbox.png\" title=\"Как стать уверенным пользователем ПК за 13 часов?\" width=\"400px\"></a>', 4, 6, 1),
(7, 'om2nulled', 'jpg-картинка 555px белый фон', '<a href=\"%reflink%\" target=\"_top\" title=\"Скрипт Order Master 2 для приёма оплаты на сайте\"><img alt=\"Скрипт Order Master 2 для приёма оплаты на сайте\" border=\"0px\" height=\"555px\" src=\"http://rolar.ru/images/partner_products/aleksandr_dolgu/order_master2/order_master2nulled.jpg\" title=\"Скрипт Order Master 2 для приёма оплаты на сайте\" width=\"555px\"></a>', 5, 1, 1),
(8, 'soft1', 'Прозрачная png-картинка 300px', '<a href=\"%reflink%\" target=\"_top\" title=\"Универсальный сборник программ для Windows\"><img alt=\"Универсальный сборник программ для Windows\" border=\"0px\" height=\"384px\" src=\"http://rolar.ru/images/goods/soft1/soft1_300.png\" title=\"Универсальный сборник программ для Windows\" width=\"300px\"></a>', 6, 1, 1),
(9, 'soft1', 'Прозрачная png-картинка 600px', '<a href=\"%reflink%\" target=\"_top\" title=\"Универсальный сборник программ для Windows\"><img alt=\"Универсальный сборник программ для Windows\" border=\"0px\" height=\"767px\" src=\"http://rolar.ru/images/goods/soft1/soft1_600.png\" title=\"Универсальный сборник программ для Windows\" width=\"600px\"></a>', 6, 2, 1),
(10, 'soft1', 'Прозрачная png-картинка 743px', '<a href=\"%reflink%\" target=\"_top\" title=\"Универсальный сборник программ для Windows\"><img alt=\"Универсальный сборник программ для Windows\" border=\"0px\" height=\"950px\" src=\"http://rolar.ru/images/goods/soft1/soft1.png\" title=\"Универсальный сборник программ для Windows\" width=\"743px\"></a>', 6, 3, 1),
(11, 'soft2', 'Прозрачная png-картинка 300px', '<a href=\"%reflink%\" target=\"_top\" title=\"Сборник новейших универсальных программ\"><img alt=\"Сборник новейших универсальных программ\" border=\"0px\" height=\"383px\" src=\"http://rolar.ru/images/goods/soft2/soft2_300.png\" title=\"Сборник новейших универсальных программ\" width=\"300px\"></a>', 6, 4, 1),
(12, 'soft2', 'Прозрачная png-картинка 600px', '<a href=\"%reflink%\" target=\"_top\" title=\"Сборник новейших универсальных программ\"><img alt=\"Сборник новейших универсальных программ\" border=\"0px\" height=\"766px\" src=\"http://rolar.ru/images/goods/soft2/soft2_600.png\" title=\"Сборник новейших универсальных программ\" width=\"600px\"></a>', 6, 5, 1),
(13, 'soft2', 'Прозрачная png-картинка 744px', '<a href=\"%reflink%\" target=\"_top\" title=\"Сборник новейших универсальных программ\"><img alt=\"Сборник новейших универсальных программ\" border=\"0px\" height=\"950px\" src=\"http://rolar.ru/images/goods/soft2/soft2.png\" title=\"Сборник новейших универсальных программ\" width=\"744px\"></a>', 6, 6, 1);

-- --------------------------------------------------------

--
-- Структура таблицы `om_ad_category`
--

CREATE TABLE `om_ad_category` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `om_ad_category`
--

INSERT INTO `om_ad_category` (`id`, `title`, `description`) VALUES
(1, 'Текстовые объявления', 'Текстовые объявления'),
(2, 'Баннеры', 'Баннеры для рекламы на сайтах'),
(3, 'cisco', 'Материалы для курса \"Сиськи по русски или 11 простых шагов по сетевым технологиям Cisco на русском языке\"'),
(4, 'comp', 'Материалы для курса \"Как научиться работать на компьютере? Как стать уверенным пользователем ПК за 13 часов?\"'),
(5, 'om2nulled', 'Материалы для скрипта \"Order Master 2 (nulled)\"'),
(6, 'soft', 'Рекламные материалы для сборников программ.');

-- --------------------------------------------------------

--
-- Структура таблицы `om_affstats`
--

CREATE TABLE `om_affstats` (
  `id` int(11) NOT NULL,
  `partner_id` varchar(50) NOT NULL DEFAULT '',
  `komis` float NOT NULL DEFAULT '0',
  `prefid` varchar(50) NOT NULL DEFAULT '',
  `pkomis` float NOT NULL DEFAULT '0',
  `date` int(11) NOT NULL DEFAULT '0',
  `good_id` varchar(50) NOT NULL DEFAULT '',
  `kanal` varchar(255) NOT NULL DEFAULT 'default'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `om_anew`
--

CREATE TABLE `om_anew` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `createTime` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `om_area`
--

CREATE TABLE `om_area` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `active` tinyint(4) NOT NULL DEFAULT '1'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `om_area_item`
--

CREATE TABLE `om_area_item` (
  `id` int(11) NOT NULL,
  `area_id` int(11) NOT NULL,
  `area_section_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `icon` varchar(255) NOT NULL,
  `uploadDate` int(11) NOT NULL,
  `filename` varchar(255) NOT NULL,
  `position` int(11) NOT NULL,
  `size` varchar(40) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `om_area_paylist`
--

CREATE TABLE `om_area_paylist` (
  `id` int(11) NOT NULL,
  `area_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `srok` int(11) NOT NULL,
  `price` float NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `om_area_section`
--

CREATE TABLE `om_area_section` (
  `id` int(11) NOT NULL,
  `area_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `position` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `om_area_user`
--

CREATE TABLE `om_area_user` (
  `id` int(11) NOT NULL,
  `area_id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `lastLogin` int(11) NOT NULL,
  `createDate` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `payTill` int(11) NOT NULL,
  `totalDays` int(11) NOT NULL,
  `email` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `om_article`
--

CREATE TABLE `om_article` (
  `id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `position` int(11) NOT NULL,
  `createTime` int(11) NOT NULL,
  `updateTime` int(11) NOT NULL,
  `visible` tinyint(4) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `om_article`
--

INSERT INTO `om_article` (`id`, `category_id`, `title`, `content`, `position`, `createTime`, `updateTime`, `visible`) VALUES
(1, 1, 'Не получена ссылка на скачивание продукта', '<p>\r\n	1. Если Вы оплатили цифровой продукт &quot;в ручном режиме&rdquo;, то сообщите об успешной оплате на адрес&nbsp;<a href=\"mailto:support@rolar.ru?subject=%D0%9F%D1%80%D0%BE%D0%B8%D0%B7%D0%B2%D0%B5%D0%B4%D0%B5%D0%BD%D0%B0%20%D0%BE%D0%BF%D0%BB%D0%B0%D1%82%D0%B0%20%D0%B2%D1%80%D1%83%D1%87%D0%BD%D1%83%D1%8E&amp;body=%D0%91%D1%8B%D0%BB%D0%B0%20%D0%BF%D1%80%D0%BE%D0%B8%D0%B7%D0%B2%D0%B5%D0%B4%D0%B5%D0%BD%D0%B0%20%D0%BE%D0%BF%D0%BB%D0%B0%D1%82%D0%B0%20%D0%B2%D1%80%D1%83%D1%87%D0%BD%D1%83%D1%8E.\">support@rolar.ru</a> и Вам в ближайшее время будет отправлена ссылка на скачивание.</p>\r\n<p>\r\n	&nbsp;</p>\r\n<p>\r\n	2. Если во время оплаты проводились технические работы на сайте магазина, то, возможно, ваш платеж не был учтён в системе приёма платежей. Напишите письмо на адрес&nbsp;<a href=\"mailto:support@rolar.ru?subject=%D0%9F%D1%80%D0%BE%D0%B8%D0%B7%D0%B2%D0%B5%D0%B4%D0%B5%D0%BD%D0%B0%20%D0%BE%D0%BF%D0%BB%D0%B0%D1%82%D0%B0%20%D0%B2%D1%80%D1%83%D1%87%D0%BD%D1%83%D1%8E&amp;body=%D0%91%D1%8B%D0%BB%D0%B0%20%D0%BF%D1%80%D0%BE%D0%B8%D0%B7%D0%B2%D0%B5%D0%B4%D0%B5%D0%BD%D0%B0%20%D0%BE%D0%BF%D0%BB%D0%B0%D1%82%D0%B0%20%D0%B2%D1%80%D1%83%D1%87%D0%BD%D1%83%D1%8E.\">support@rolar.ru</a>, и укажите № заказа и адрес вашей электронной почты.</p>\r\n', 1, 1497542662, 1497542848, 1);

-- --------------------------------------------------------

--
-- Структура таблицы `om_article_category`
--

CREATE TABLE `om_article_category` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `position` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `om_article_category`
--

INSERT INTO `om_article_category` (`id`, `title`, `description`, `position`) VALUES
(1, 'Вопросы', 'Ответы на частые вопросы', 0);

-- --------------------------------------------------------

--
-- Структура таблицы `om_author`
--

CREATE TABLE `om_author` (
  `id` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `uname` varchar(255) NOT NULL,
  `total` float NOT NULL DEFAULT '0',
  `paid` float NOT NULL DEFAULT '0',
  `purse` varchar(255) NOT NULL,
  `kind` varchar(10) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `om_author`
--

INSERT INTO `om_author` (`id`, `password`, `email`, `uname`, `total`, `paid`, `purse`, `kind`) VALUES
('Elina', '1107982', 'yelf-a.com@mail.ru', 'Elina', 0, 0, 'R409046948335', 'wmr'),
('rolar', 'WjNMOLcMkSCjS2Ay76DK', 'admin@rolar.ru', 'admin@rolar.ru', 0, 0, 'R121012546658', 'wmr'),
('qyqfr', 'romiPw1Vi', 'qyqfrqb9r11@lenta.ru', 'Евгений', 0, 0, '', 'wmr');

-- --------------------------------------------------------

--
-- Структура таблицы `om_bill`
--

CREATE TABLE `om_bill` (
  `id` bigint(20) NOT NULL,
  `createDate` int(11) NOT NULL,
  `sum` float NOT NULL,
  `valuta` varchar(3) NOT NULL,
  `usdkurs` float NOT NULL,
  `eurkurs` float NOT NULL,
  `uahkurs` float NOT NULL,
  `cupon` varchar(255) NOT NULL DEFAULT '',
  `payDate` int(11) NOT NULL,
  `status_id` varchar(20) NOT NULL,
  `email` varchar(255) NOT NULL,
  `amail` varchar(255) NOT NULL DEFAULT '',
  `uname` varchar(255) NOT NULL,
  `surname` varchar(255) NOT NULL DEFAULT '',
  `otchestvo` varchar(255) NOT NULL DEFAULT '',
  `strana` varchar(255) NOT NULL DEFAULT '',
  `region` varchar(255) NOT NULL DEFAULT '',
  `gorod` varchar(255) NOT NULL DEFAULT '',
  `postindex` varchar(30) NOT NULL DEFAULT '',
  `address` varchar(255) NOT NULL DEFAULT '',
  `phone` varchar(255) NOT NULL,
  `ip` varchar(100) NOT NULL,
  `way` varchar(255) NOT NULL,
  `postNumber` varchar(255) NOT NULL,
  `kind` varchar(255) NOT NULL,
  `orderCount` int(11) NOT NULL,
  `notifySent` int(11) NOT NULL,
  `rur` float NOT NULL,
  `lastDate` int(11) NOT NULL DEFAULT '0',
  `comment` varchar(255) NOT NULL DEFAULT '',
  `purse` varchar(255) DEFAULT NULL,
  `affpaid` tinyint(4) DEFAULT '0',
  `curier` tinyint(4) DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `om_bill`
--

INSERT INTO `om_bill` (`id`, `createDate`, `sum`, `valuta`, `usdkurs`, `eurkurs`, `uahkurs`, `cupon`, `payDate`, `status_id`, `email`, `amail`, `uname`, `surname`, `otchestvo`, `strana`, `region`, `gorod`, `postindex`, `address`, `phone`, `ip`, `way`, `postNumber`, `kind`, `orderCount`, `notifySent`, `rur`, `lastDate`, `comment`, `purse`, `affpaid`, `curier`) VALUES
(1, 1499450305, 99, 'rur', 62.19, 71.02, 2.39, '', 1499450380, 'approved', 'paexvestor@gmail.com', '', 'Артем', '', '', '', '', '', '', '', 'нет', '85.115.248.209', 'WebMoney R', '', 'ebook', 1, 0, 99, 1499450381, '', 'R248693955970', 1, NULL),
(2, 1500255708, 99, 'rur', 61.68, 70.41, 2.37, '', 0, 'waiting', 'cherniu.dmitriu23@gmail.com', '', 'Дмитрий', '', '', '', '', '', '', '', 'нет', '188.114.23.204', 'Яндекс.Деньги', '', 'ebook', 1, 2, 99, 1500989832, '', NULL, NULL, NULL),
(3, 1501704713, 59.4, 'rur', 62.4, 73.84, 2.41, 'ordermaster2', 1501705020, 'approved', 'strong.lapshin@mail.ru', '', 'Артем', '', '', '', '', '', '', '', 'нет', '188.226.220.27', 'РобоКасса', '', 'ebook', 1, 0, 59.4, 1501705020, '', '', 1, NULL),
(4, 1501922476, 59.4, 'rur', 62.14, 73.84, 2.4, 'ordermaster2', 0, 'waiting', 'hotc1@mail.ru', '', 'Али', '', '', '', '', '', '', '', 'нет', '46.16.229.127', 'WebMoney R', '', 'ebook', 1, 2, 59.4, 1501922486, '', NULL, NULL, NULL),
(5, 1501960595, 59.4, 'rur', 62.14, 73.84, 2.4, 'ordermaster2', 1501961106, 'approved', 'hotc1@mail.ru', '', 'Али', '', '', '', '', '', '', '', 'нет', '46.16.229.127', 'WebMoney R', '', 'ebook', 1, 0, 59.4, 1501961106, '', 'R131677241266', 1, NULL),
(6, 1502103706, 99, 'rur', 61.86, 72.97, 2.4, '', 0, 'waiting', 'alekseyy-chimiris@ro.ru', 'alekseyy-chimiris@ro.ru', 'gfhfc', '', '', '', '', '', '', '', 'нет', '77.122.249.117', 'Payeer', '', 'ebook', 1, 2, 99, 1502820062, '', NULL, NULL, NULL),
(7, 1502174157, 59.4, 'rur', 61.86, 72.97, 2.4, 'ordermaster2', 0, 'waiting', 'alekseyy-chimiris@ro.ru', 'chimir@bk.ru', 'gfhfc', '', '', '', '', '', '', '', 'нет', '77.122.249.117', 'SpryPay', '', 'ebook', 1, 2, 59.4, 1502436729, '', NULL, NULL, NULL),
(8, 1502179231, 59.4, 'rur', 61.86, 72.97, 2.4, 'ordermaster2', 0, 'waiting', 'alekseyy-chimiris@ro.ru', 'chimir@bk.ru', 'Алексей', '', '', '', '', '', '', '', 'нет', '77.122.249.117', 'WebMoney U', '', 'ebook', 1, 2, 59.4, 1502179242, '', NULL, NULL, NULL),
(9, 1502179781, 59.4, 'rur', 61.86, 72.97, 2.4, 'ordermaster2', 1502179820, 'approved', 'alekseyy-chimiris@ro.ru', 'krotkrot34@gmail.com', 'Алексей', '', '', '', '', '', '', '', 'нет', '77.122.249.117', 'WebMoney R', '', 'ebook', 1, 0, 59.4, 1502179820, '', 'R953533350128', 1, NULL),
(10, 1502503312, 99, 'rur', 61.99, 72.87, 2.41, '', 0, 'waiting', 'horsekaper@gmail.com', '', 'andrey', '', '', '', '', '', '', '', 'нет', '46.175.165.37', 'LiqPay', '', 'ebook', 1, 2, 99, 1502503343, '', NULL, NULL, NULL),
(11, 1502504050, 59.4, 'rur', 61.99, 72.87, 2.41, 'ordermaster2', 0, 'waiting', 'horsekaper@gmail.com', '', 'andrey', '', '', '', '', '', '', '', 'нет', '46.175.165.37', 'Z-Payment', '', 'ebook', 1, 2, 59.4, 1502504123, '', NULL, NULL, NULL),
(12, 1502508864, 99, 'rur', 61.99, 72.87, 2.41, '', 0, 'waiting', 'horsekaper@gmail.com', '', 'andrey', '', '', '', '', '', '', '', 'нет', '46.175.165.37', 'Z-Payment', '', 'ebook', 1, 2, 99, 1502508964, '', NULL, NULL, NULL),
(13, 1502511997, 99, 'rur', 61.99, 72.87, 2.41, '', 0, 'waiting', 'horsekaper@gmail.com', '', 'andrey', '', '', '', '', '', '', '', 'нет', '46.175.165.37', 'ROBOKASSA', '', 'ebook', 1, 2, 99, 1502512182, '', NULL, NULL, NULL),
(14, 1502526063, 99, 'rur', 61.99, 72.87, 2.41, '', 0, 'waiting', 'horsekaper@gmail.com', '', 'andrey', '', '', '', '', '', '', '', 'нет', '46.175.165.37', 'ROBOKASSA', '', 'ebook', 1, 2, 99, 1502532497, '', NULL, NULL, NULL),
(15, 1502570093, 59.4, 'rur', 61.99, 72.87, 2.41, 'ordermaster2', 1502570180, 'approved', 'horsekaper@gmail.com', '', 'andrey', '', '', '', '', '', '', '', 'нет', '46.175.165.37', 'WebMoney R', '', 'ebook', 1, 0, 59.4, 1502570181, '', 'R347224163153', 1, NULL),
(16, 1502730588, 99, 'rur', 61.59, 72.78, 2.4, '', 0, 'waiting', 'horsekaper@gmail.com', '', 'andrey', '', '', '', '', '', '', '', 'нет', '46.175.165.37', 'SpryPay', '', 'ebook', 1, 1, 99, 1502993386, '', NULL, NULL, NULL),
(17, 1502732171, 275, 'rur', 61.59, 72.78, 2.4, '', 0, 'waiting', 'horsekaper@gmail.com', '', 'andrey', '', '', '', '', '', '', '', 'нет', '46.175.165.37', 'ROBOKASSA', '', 'ebook', 1, 1, 275, 1502732254, '', NULL, NULL, NULL),
(18, 1502998054, 275, 'rur', 61.03, 71.74, 2.39, '', 0, 'waiting', 'sds@fff.ru', '', '1', '', '', '', '', '', '', '', 'нет', '151.249.147.117', 'Яндекс.Деньги', '', 'ebook', 1, 1, 275, 1502998694, '', NULL, NULL, NULL),
(19, 1503129635, 59.4, 'rur', 61.14, 71.81, 2.4, 'ordermaster2', 1503129789, 'approved', 'kilsvich@ukr.net', '', 'Николай', '', '', '', '', '', '', '', 'нет', '188.166.33.163', 'WebMoney R', '', 'ebook', 1, 0, 59.4, 1503129789, '', 'R284275509452', 1, NULL),
(20, 1503140642, 59.4, 'rur', 61.14, 71.81, 2.4, 'ordermaster2', 0, 'waiting', 'amirus@mail.ru', '', 'Руслан', '', '', '', '', '', '', '', 'нет', '151.249.147.117', 'Яндекс.Деньги', '', 'ebook', 1, 0, 59.4, 1503141523, '', NULL, NULL, NULL),
(21, 1503347676, 99, 'rur', 60.92, 71.51, 2.39, '', 0, 'waiting', 'dfg@dfg.er', '', 'fgdff', '', '', '', '', '', '', '', 'нет', '127.0.0.1', 'Z-Payment', '', 'ebook', 1, 0, 99, 0, '', NULL, NULL, NULL),
(22, 1514407115, 475, 'rur', 60.92, 71.51, 2.39, '', 0, 'waiting', 'rolar@rolar.ru', '', '34', '', '', '', '', '', '', '', 'нет', '127.0.0.1', '', '', 'ebook', 1, 0, 475, 0, '', NULL, NULL, NULL),
(23, 1514408541, 475, 'rur', 60.92, 71.51, 2.39, '', 0, 'waiting', 'dfg@dfg.er', '', '345', '', '', '', '', '', '', '', 'нет', '127.0.0.1', '', '', 'ebook', 1, 0, 475, 0, '', NULL, NULL, NULL),
(24, 1516773871, 99, 'rur', 60.92, 71.51, 2.39, '', 0, 'waiting', 'admin@test.ru', '', 'admin', '', '', '', '', '', '', '', 'нет', '127.0.0.1', 'Яндекс.Деньги', '', 'ebook', 1, 0, 99, 0, '', NULL, NULL, NULL),
(25, 1516788613, 1, 'rur', 60.92, 71.51, 2.39, '', 0, 'waiting', 'admin@rolar.ru', '', 'rolar', '', '', '', '', '', '', '', 'нет', '127.0.0.1', 'Яндекс.Деньги', '', 'ebook', 1, 0, 1, 0, '', NULL, NULL, NULL),
(26, 1532180916, 1, 'rur', 60.92, 71.51, 2.39, '', 0, 'waiting', 'rolar@list.ru', '', 'rolar', '', '', '', '', '', '', '', 'нет', '127.0.0.1', 'Яндекс.Деньги (через сайт)', '', 'ebook', 1, 0, 1, 0, '', NULL, NULL, NULL),
(27, 1532198732, 99, 'rur', 60.92, 71.51, 2.39, '', 0, 'waiting', 'rolar@list.ru', '', 'rolar', '', '', '', '', '', '', '', 'нет', '127.0.0.1', 'Яндекс.Касса', '', 'ebook', 1, 0, 99, 0, '', NULL, NULL, NULL),
(28, 1532242697, 1, 'rur', 60.92, 71.51, 2.39, '', 0, 'waiting', 'rolar@list.ru', '', 'rolar', '', '', '', '', '', '', '', 'нет', '127.0.0.1', 'Payeer', '', 'ebook', 1, 0, 1, 0, '', NULL, NULL, NULL),
(29, 1544542739, 1753, 'rur', 60.92, 71.51, 2.39, '', 0, 'cancelled', 'rolar@list.ru', '', 'artur', '', '', '', '', '', '', '', 'нет', '127.0.0.1', 'Сбербанк Online (вручную)', '', 'ebook', 1, 3, 1753, 0, '', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `om_black`
--

CREATE TABLE `om_black` (
  `id` int(11) NOT NULL,
  `createDate` int(11) NOT NULL,
  `ip` varchar(100) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `comment` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `om_category`
--

CREATE TABLE `om_category` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `visible` tinyint(4) NOT NULL DEFAULT '1',
  `position` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `om_category`
--

INSERT INTO `om_category` (`id`, `title`, `description`, `visible`, `position`) VALUES
(1, 'Цифровые товары', 'Цифровые товары на сайте http://rolar.ru, доступные для скачивания по специальной ссылке', 1, 1),
(2, 'Бизнес Молодость', 'Образовательные курсы и информационные продукты от компании Бизнес Молодость.', 1, 2);

-- --------------------------------------------------------

--
-- Структура таблицы `om_click`
--

CREATE TABLE `om_click` (
  `id` bigint(20) NOT NULL,
  `good_id` varchar(100) NOT NULL,
  `partner_id` varchar(100) NOT NULL,
  `date` int(11) NOT NULL,
  `page` varchar(255) NOT NULL,
  `ip` varchar(70) NOT NULL,
  `referer` varchar(255) NOT NULL,
  `channel` varchar(255) NOT NULL DEFAULT 'default'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `om_click`
--

INSERT INTO `om_click` (`id`, `good_id`, `partner_id`, `date`, `page`, `ip`, `referer`, `channel`) VALUES
(1, 'comp', 'elina', 1468219624, 'p', '95.105.72.78', 'http://rolar.ru/om/aff/links/ad/id/comp', 'default');

-- --------------------------------------------------------

--
-- Структура таблицы `om_client`
--

CREATE TABLE `om_client` (
  `id` int(11) NOT NULL,
  `good_id` varchar(50) NOT NULL DEFAULT '',
  `uname` varchar(250) NOT NULL DEFAULT '',
  `email` varchar(250) NOT NULL DEFAULT '',
  `amail` varchar(250) NOT NULL DEFAULT '',
  `date` int(11) NOT NULL DEFAULT '0',
  `subscribe` tinyint(4) NOT NULL DEFAULT '1',
  `bill_id` bigint(20) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `om_client`
--

INSERT INTO `om_client` (`id`, `good_id`, `uname`, `email`, `amail`, `date`, `subscribe`, `bill_id`) VALUES
(1, 'om2nulled', 'Артем', 'paexvestor@gmail.com', '', 1499450380, 1, 0),
(2, 'om2nulled', 'Артем', 'strong.lapshin@mail.ru', '', 1501705020, 1, 0),
(3, 'om2nulled', 'Али', 'hotc1@mail.ru', '', 1501961106, 1, 0),
(4, 'om2nulled', 'Алексей', 'alekseyy-chimiris@ro.ru', '', 1502179820, 1, 0),
(5, 'om2nulled', 'andrey', 'horsekaper@gmail.com', '', 1502570180, 1, 0),
(6, 'om2nulled', 'Николай', 'kilsvich@ukr.net', '', 1503129789, 1, 0);

-- --------------------------------------------------------

--
-- Структура таблицы `om_cupon`
--

CREATE TABLE `om_cupon` (
  `id` bigint(20) NOT NULL,
  `code` varchar(255) NOT NULL,
  `sum` float NOT NULL,
  `kind_id` varchar(5) NOT NULL,
  `startDate` int(11) NOT NULL,
  `stopDate` int(11) NOT NULL,
  `komis` tinyint(4) NOT NULL,
  `title` varchar(255) NOT NULL,
  `good_id` text NOT NULL,
  `selfDelete` tinyint(4) NOT NULL,
  `category_id` int(11) NOT NULL,
  `client_good_id` text
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `om_cupon`
--

INSERT INTO `om_cupon` (`id`, `code`, `sum`, `kind_id`, `startDate`, `stopDate`, `komis`, `title`, `good_id`, `selfDelete`, `category_id`, `client_good_id`) VALUES
(1, 'response', 50, 'perc', 1464728400, 1577826000, 1, 'Для тех, кто написал и прислал отзыв', 'cisco', 0, 1, ''),
(2, 'ordermaster2', 40, 'perc', 1497646800, 1529182800, 0, 'Для первых 10 покупателей скрипта Order Master 2 nulled', 'om2nulled', 0, 1, '');

-- --------------------------------------------------------

--
-- Структура таблицы `om_cupon_category`
--

CREATE TABLE `om_cupon_category` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `createDate` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `om_cupon_category`
--

INSERT INTO `om_cupon_category` (`id`, `title`, `createDate`) VALUES
(1, 'Цифровые товары', 1466439218);

-- --------------------------------------------------------

--
-- Структура таблицы `om_good`
--

CREATE TABLE `om_good` (
  `id` varchar(100) NOT NULL,
  `category_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `image` varchar(255) NOT NULL,
  `catalog_on` tinyint(4) NOT NULL,
  `position` int(11) DEFAULT NULL,
  `price` float NOT NULL,
  `currency` varchar(3) NOT NULL,
  `kind` varchar(5) NOT NULL,
  `affOn` tinyint(4) NOT NULL,
  `affLink` varchar(255) NOT NULL,
  `affKomis` float DEFAULT NULL,
  `affKomisType` varchar(5) NOT NULL,
  `affPkomis` float DEFAULT NULL,
  `affPkomisType` varchar(5) NOT NULL,
  `affShow` tinyint(4) NOT NULL,
  `used` tinyint(4) NOT NULL,
  `disabledWays` text NOT NULL,
  `securebook` tinyint(4) NOT NULL,
  `getUrl` varchar(255) NOT NULL,
  `dlink` varchar(255) NOT NULL,
  `author_id` varchar(255) NOT NULL,
  `cartOn` tinyint(4) NOT NULL,
  `cartGoods` varchar(255) NOT NULL,
  `cartMinus` float DEFAULT NULL,
  `upsellOn` tinyint(4) NOT NULL,
  `upsellGood` varchar(255) NOT NULL DEFAULT '',
  `upsellText` text NOT NULL,
  `tupsellOn` tinyint(4) NOT NULL,
  `tupsellGood` varchar(255) NOT NULL DEFAULT '',
  `tupsellText` text NOT NULL,
  `csellOn` tinyint(4) NOT NULL,
  `csellGood` varchar(255) NOT NULL DEFAULT '',
  `csellText` text NOT NULL,
  `cartText` text NOT NULL,
  `ads` text NOT NULL,
  `nalozhOn` tinyint(4) NOT NULL DEFAULT '0',
  `authorKomis` float NOT NULL DEFAULT '0',
  `letterSubject` varchar(255) NOT NULL,
  `letterText` text NOT NULL,
  `letterType` varchar(10) NOT NULL,
  `affOrder` tinyint(4) NOT NULL DEFAULT '0',
  `aukind` varchar(10) DEFAULT NULL,
  `kurier` varchar(10) DEFAULT NULL,
  `kurstrany` varchar(255) DEFAULT NULL,
  `kurgorod` varchar(255) DEFAULT NULL,
  `needid` varchar(100) DEFAULT NULL,
  `sendid` varchar(100) DEFAULT NULL,
  `comtitle` varchar(100) DEFAULT NULL,
  `comvalues` varchar(100) DEFAULT NULL,
  `csell2g` varchar(100) DEFAULT NULL,
  `csell3g` varchar(100) DEFAULT NULL,
  `csell2` varchar(255) DEFAULT NULL,
  `csell3` varchar(255) DEFAULT NULL,
  `csellOk` varchar(255) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `om_good`
--

INSERT INTO `om_good` (`id`, `category_id`, `title`, `description`, `image`, `catalog_on`, `position`, `price`, `currency`, `kind`, `affOn`, `affLink`, `affKomis`, `affKomisType`, `affPkomis`, `affPkomisType`, `affShow`, `used`, `disabledWays`, `securebook`, `getUrl`, `dlink`, `author_id`, `cartOn`, `cartGoods`, `cartMinus`, `upsellOn`, `upsellGood`, `upsellText`, `tupsellOn`, `tupsellGood`, `tupsellText`, `csellOn`, `csellGood`, `csellText`, `cartText`, `ads`, `nalozhOn`, `authorKomis`, `letterSubject`, `letterText`, `letterType`, `affOrder`, `aukind`, `kurier`, `kurstrany`, `kurgorod`, `needid`, `sendid`, `comtitle`, `comvalues`, `csell2g`, `csell3g`, `csell2`, `csell3`, `csellOk`) VALUES
('cisco', 1, '\"Сиськи по-русски\" или 11 простых шагов по сетевым технологиям CISCO на русском языке', 'Обучающий материал по сетевым технологиям CISCO CCNA Exploration v4.0 часть 1 для подготовки и сдачи сертификационных экзаменов, полный перевод на русский язык, дополнительные бонусы: лабораторные работы, экзаменационные тесты и правильные ответы, программы-эмуляторы, книги по Cisco на русском языке, презентации для инструкторов, прошивки IOS и пр. секретные бонусы', 'http://rolar.ru/cisco/images/ccna-book300.png', 1, 1, 1753, 'rur', 'ebook', 1, 'http://rolar.ru/cisco/index.php', 50, 'perc', 25, 'perc', 1, 1, '', 0, '', 'http://rolar.ru/cisco/download.php', 'rolar', 1, 'comp,om2nulled,soft1,soft2,realvk,realdirect,realinstagram,realadwords', 20, 0, 'cisco', '', 0, 'cisco', '', 0, 'cisco', '', '<strong style=\"color:#cc0000;\">Выгодное предложение!</strong> Приобретите курс <strong style=\"color:#003399;\">\"Сиськи по-русски\" или 11 простых шагов по сетевым технологиям CISCO на русском языке</strong> со скидкой <strong style=\"color:#cc0000;\">20%</strong>.<br>Нажмите на кнопку <strong style=\"color:#3399cc;\">Добавить в корзину</strong>.', '', 0, 0, '%name%, Ваша ссылка для скачивания товара', 'Здравствуйте, %name%.\r\n\r\nВаша ссылка для скачивания \"%good_title%\":\r\n%dlink%\r\n\r\nПостарайтесь скачать все файлы в течение 3-х суток.\r\n\r\nВсего доброго.\r\n\r\n--\r\n%site_title%\r\n%site_url%', 'plain', 0, 'price', '0', '', '', '', '', '', NULL, 'cisco', 'cisco', '', '', ''),
('comp', 1, 'Как стать уверенным пользователем ПК за 13 часов?', 'Обучающие уроки по работе на компьютере позволят Вам легко и быстро освоить компьютер и стать уверенным пользователем.', 'http://rolar.ru/comp/images/small3dbox.png', 1, 2, 980, 'rur', 'ebook', 1, 'http://rolar.ru/comp/index.php', 50, 'perc', 25, 'perc', 1, 1, '', 0, '', 'http://rolar.ru/comp/oplata.html', 'rolar', 1, 'soft1,soft2,cisco', 20, 1, 'soft1', '<div class=\"one_cart_item\">\r\n<h1>Универсальный сборник программ для Windows за <span style=\"color:#cc0000;\">150 рублей</span>!</h1>\r\n<div class=\"cart_descr\"><br>\r\n<p><img src=\"http://rolar.ru/om/images/cart/soft1.jpg\"></p>\r\n<p>Цена:<span class=\"cart_old_price\">275.00 р.</span><br>\r\nДля Вас:<span class=\"cart_price\">150.00 р.</span></p>\r\n<p>Нажмите на кнопку <strong style=\"color:#3399cc;\">Добавить к заказу</strong>.</p>\r\n</div>\r\n</div>', 1, 'soft2', '<div class=\"one_cart_item\">\r\n<h1>Сборник новейших универсальных программ за <span style=\"color:#cc0000;\">200 рублей</span>!</h1>\r\n<div class=\"cart_descr\"><br>\r\n<p><img src=\"http://rolar.ru/om/images/cart/soft2.jpg\"></p>\r\n<p>Цена:<span class=\"cart_old_price\">375.00 р.</span><br>\r\nДля Вас:<span class=\"cart_price\">200.00 р.</span></p>\r\n<p>Нажмите на кнопку <strong style=\"color:#3399cc;\">Добавить к заказу</strong>.</p>\r\n</div>\r\n</div>', 0, 'cisco', '', '<strong style=\"color:#cc0000;\">Выгодное предложение!</strong> Приобретите курс <strong style=\"color:#003399;\">Как стать уверенным пользователем ПК за 13 часов?</strong> со скидкой <strong style=\"color:#cc0000;\">20%</strong>.<br>Нажмите на кнопку <strong style=\"color:#3399cc;\">Добавить в корзину</strong>.', '', 1, 0, '%name%, Ваша ссылка для скачивания товара', 'Здравствуйте, %name%.\r\n\r\nВаша ссылка для скачивания \"%good_title%\":\r\n%dlink%\r\n\r\nПостарайтесь скачать все файлы в течение 3-х суток.\r\n\r\nВсего доброго.\r\n\r\n--\r\n%site_title%\r\n%site_url%', 'plain', 0, 'price', '0', '', '', '', '', '', NULL, 'cisco', 'cisco', '', '', ''),
('secret', 1, 'Доступ в секретный раздел', 'Доступ в секретный раздел на сайте http://rolar.ru', 'http://rolar.ru/images/secret/zamok.png', 1, 3, 1, 'rur', 'ebook', 0, '', 0, 'fixed', 0, 'fixed', 0, 1, '', 0, '', 'http://rolar.ru/secret.php', 'rolar', 0, '', NULL, 0, 'cisco', '', 0, 'cisco', '', 0, 'cisco', '', '', '', 0, 0, '%good_title%', 'Здравствуйте, %name%.\r\n\r\nБлагодарю за подписку на сайте http://rolar.ru.\r\n\r\nВам предоставлен доступ к секретному разделу сайта:\r\n%dlink%\r\n\r\nКод доступа: dTWc627k\r\n\r\nЖелаю успехов и всего наилучшего.\r\n\r\n--\r\nС уважением, Артур Абзалов\r\n%site_title%\r\n%site_url%', 'plain', 0, 'price', '0', '', '', '', '', '', NULL, 'cisco', 'cisco', '', '', ''),
('om2nulled', 1, 'Скрипт Order Master 2 (nulled)', 'Занулённая версия скрипта Order Master 2.00 от 17.09.2015 для приёма платёжей и подключения платёжных систем на сайте, имеет открытый исходный код, не привязан к домену и не требует лицензии. В его исправной работе и функциональности Вы можете убедиться прямо сейчас на этом сайте.', 'http://rolar.ru/images/partner_products/aleksandr_dolgu/order_master2/order_master2nulled.jpg', 1, 4, 99, 'rur', 'ebook', 1, 'http://rolar.ru/view_partner_product.php?id=259', 40, 'fixed', 20, 'fixed', 1, 1, '', 0, '', 'https://cloud.mail.ru/public/Jbgv/gEQVPSGUf', '', 1, 'cisco,comp,soft1,soft2,realvk,realdirect,realinstagram,realadwords', 20, 0, 'cisco', '', 0, 'cisco', '', 0, 'cisco', '', '<strong style=\"color:#cc0000;\">Выгодное предложение!</strong> Приобретите скрипт <strong style=\"color:#003399;\">Order Master 2 (nulled)</strong> со скидкой <strong style=\"color:#cc0000;\">20%</strong>.', '', 0, 0, '%name%, Ваша ссылка для скачивания товара', 'Здравствуйте, %name%.\r\n\r\nВаша ссылка для скачивания продукта \"%good_title%\" с сервиса Облако.Mail.ru:\r\n%dlink%\r\n\r\nИмя файла: order_master2_nulled.rar\r\nРазмер файла 568 Мб\r\n\r\nПостарайтесь скачать этот файл в течение 3-х суток.\r\n\r\nВсего наилучшего.\r\n\r\n--\r\n%site_title%\r\n%site_url%', 'plain', 0, 'price', '0', '', '', '', '', '', NULL, 'cisco', 'cisco', '', '', ''),
('realvk', 2, 'Реальный Вконтакте', '<p>Видеокурс <strong>&laquo;Реальный Вконтакте&raquo;</strong> от <a href=\"http://rolar.ru/partner_products.php?partner=13\" target=\"_blank\" title=\"Бизнес Молодость\">БМ</a> позволит Вам узнать и применить все передовые и реально работающие инструменты продаж в своём бизнесе.</p>\r\n<p>Из курса <strong>&laquo;Реальный Вконтакте&raquo;</strong> Вы узнаете:</p>\r\n<ul>\r\n  <li>как быстро протестировать нишу и получить первых клиентов за 2 дня,</li>\r\n  <li>с чего начать продвижение <a href=\"http://rolar.ru/link.php?id=262\" target=\"_blank\" title=\"Социальная сеть Вконтакте\">Вконтакте</a>, какой тип сообщества выбрать,</li>\r\n  <li>как привлечь клиентов с минимальными вложениями, если ваш бюджет ограничен 3-5 тысячами рублей,</li>\r\n  <li>как привлечь &laquo;разогретых&raquo; клиентов на сайт, которые уже готовы купить,</li>\r\n  <li>как получить клики по 45 копеек и клиентов по 100 рублей,</li>\r\n  <li>как бесплатно и быстро набрать в сообщество 1000 человек.</li>\r\n</ul>\r\n<p>Приобретайте видеокурс <strong>&laquo;Реальный Вконтакте&raquo;</strong> прямо сейчас и применяйте полученные знания в качестве отличного рекламного инструмента для вашего бизнеса!</p>', 'http://rolar.ru/images/partner_products/biznes_molodost/realnyi_vkontakte2016/realnyi_vkontakte.jpg', 1, 5, 475, 'rur', 'ebook', 0, '', 0, 'fixed', 0, 'fixed', 1, 1, '', 0, '', 'http://rolar.ru/download_link.php?id=278', '', 1, 'realadwords,realdirect,realinstagram', 20, 0, 'cisco', '', 0, 'cisco', '', 0, 'cisco', '', '<strong style=\"color:#cc0000;\">Выгодное предложение!</strong> Приобретите курс <strong style=\"color:#003399;\">Реальный Вконтакте</strong> со скидкой <strong style=\"color:#cc0000;\">20%</strong>.<br>Нажмите на кнопку <strong style=\"color:#3399cc;\">Добавить в корзину</strong>.', '', 0, 0, '%name%, Ваша ссылка для скачивания товара', 'Здравствуйте, %name%.\r\n\r\nВаша ссылка для скачивания \"%good_title%\":\r\n%dlink%\r\n\r\nПостарайтесь скачать все файлы в течение 3-х суток.\r\n\r\nВсего доброго.\r\n\r\n--\r\n%site_title%\r\n%site_url%', 'plain', 0, 'price', '0', '', '', '', '', '', NULL, 'cisco', 'cisco', '', '', ''),
('realdirect', 2, 'Реальный Директ', '<p>Курс <strong>&laquo;Реальный директ&raquo;</strong> от <a href=\"http://rolar.ru/partner_products.php?partner=13\" target=\"_blank\" title=\"Бизнес Молодость\">БМ</a> содержит ультра-передовые технологии по созданию мощного и управляемого потока клиентов из Интернета. Курс содержит 75 уроков и практических заданий, которые можно протестировать и проделать в любой нише на примере любого бизнеса.</p>\r\n<p>Курс состоит из 10 модулей и содержит в себе следующее:</p>\r\n<ol>\r\n	<li>оценка своего уровня и постановка цели,</li>\r\n	<li>конкурентная разведка, определение стратегии лидеров и своих позиций,</li>\r\n	<li>сбор базовой семантики,</li>\r\n	<li>парсинг ключевых слов и мультипликация,</li>\r\n	<li>чистка, минусация и кросс-минусация,</li>\r\n	<li>написание объявлений, настройка кампании, подключение Яндекс.Метрики и Google Analytics,</li>\r\n	<li>расширенные и тонкие настройки кампании, модерация,</li>\r\n	<li>великая РСЯ &ndash; бесконечный поток заявок,</li>\r\n	<li>подключение авто-брокера, управление ставками и запуск трафика,</li>\r\n	<li>глубокая аналитика и анализ полученных результатов Яндекс.Метрика и Google Analytics.</li>\r\n</ol>\r\n<p>В результате применения новых знаний из курса Вы получите управляемый, измеримый, окупаемый, масштабируемый и бесконечный поток клиентов. Эти знания позволят Вам снизить стоимость лида, увеличить эффективность объявлений, увеличить посещаемость, прояснить любые непонятные стороны сервиса <a href=\"http://rolar.ru/link.php?id=414\" target=\"_blank\" title=\"Яндекс.Директ\">Яндекс.Директ</a>, увидеть и посчитать окупаемость вложений в течение времени.</p>\r\n<p>Приобретайте курс <strong>&laquo;Реальный директ&raquo;</strong>, применяйте самые последние технологии в вашем бизнесе и наслаждайтесь полученными результатами!</p>', 'http://rolar.ru/images/partner_products/biznes_molodost/realnyi_direkt2015/realnyi_direkt.png', 1, 6, 475, 'rur', 'ebook', 0, '', 0, 'fixed', 0, 'fixed', 0, 1, '', 0, '', 'http://rolar.ru/download_link.php?id=279', '', 1, 'realadwords,realinstagram,realvk', 20, 0, 'cisco', '', 0, 'cisco', '', 0, 'cisco', '', '<strong style=\"color:#cc0000;\">Выгодное предложение!</strong> Приобретите курс <strong style=\"color:#003399;\">Реальный Директ</strong> со скидкой <strong style=\"color:#cc0000;\">20%</strong>.<br>Нажмите на кнопку <strong style=\"color:#3399cc;\">Добавить в корзину</strong>.', '', 0, 0, '%name%, Ваша ссылка для скачивания товара', 'Здравствуйте, %name%.\r\n\r\nВаша ссылка для скачивания \"%good_title%\":\r\n%dlink%\r\n\r\nПостарайтесь скачать все файлы в течение 3-х суток.\r\n\r\nВсего доброго.\r\n\r\n--\r\n%site_title%\r\n%site_url%', 'plain', 0, 'price', '0', '', '', '', '', '', NULL, 'cisco', 'cisco', '', '', ''),
('realinstagram', 2, 'Реальный Инстаграм', '<p>Сегодня сервис <a href=\"http://rolar.ru/link.php?id=417\" target=\"_blank\" title=\"Instagram\">Инстаграм</a> &ndash; полноценный источник дохода и мощный рекламный канал, который требует внимания, знаний и некоторых вложений.</p>\r\n<p>Но как быть, если Вы ещё мало знакомы или только-только узнали об <a href=\"http://rolar.ru/link.php?id=417\" target=\"_blank\" title=\"Instagram\">Инстаграм</a>? И чтобы освоить этот сервис, быть в нём не только как &laquo;рыба в воде&raquo;, но и начать продавать, привлекать новых подписчиков, строить свой бизнес, вам в помощь придёт курс <strong>&laquo;Реальный Иснтаграм&raquo;</strong> от <a href=\"http://rolar.ru/partner_products.php?partner=13\" target=\"_blank\" title=\"Бизнес Молодость\">БМ</a>.</p>\r\n<p>Курс состоит из 8 модулей:</p>\r\n<ol>\r\n  <li>Оформление аккаунта и подготовка к приёму трафика</li>\r\n  <li>Создание контента и разработка плана его размещения</li>\r\n  <li>Привлечение целевой аудитории массфоловингом и хэштегами</li>\r\n  <li>Запуск рекламы: официальной, в пабликах, посевом</li>\r\n  <li>Сотрудничество с блогерами и знаменитостями</li>\r\n  <li>Внедрение дополнительных механик привлечения клиентов</li>\r\n  <li>Разработка маркетинг-плана и запуск отдела продаж</li>\r\n  <li>Поиск и работа с подрядчиком</li>\r\n</ol>\r\n<p>Приобретайте курс <strong>&laquo;Реальный Инстаграм&raquo;</strong> прямо сейчас, смотрите и применяйте полученные знания в своём деле!</p>', 'http://rolar.ru/images/partner_products/biznes_molodost/realnyi_instagram2016/realnyi_instagram.jpg', 1, 7, 475, 'rur', 'ebook', 0, '', 0, 'fixed', 0, 'fixed', 0, 1, '', 0, '', 'http://rolar.ru/download_link.php?id=280', '', 1, 'realadwords,realdirect,realvk', 20, 0, 'cisco', '', 0, 'cisco', '', 0, 'cisco', '', '<strong style=\"color:#cc0000;\">Выгодное предложение!</strong> Приобретите курс <strong style=\"color:#003399;\">Реальный Инстаграм</strong> со скидкой <strong style=\"color:#cc0000;\">20%</strong>.<br>Нажмите на кнопку <strong style=\"color:#3399cc;\">Добавить в корзину</strong>.', '', 0, 0, '%name%, Ваша ссылка для скачивания товара', 'Здравствуйте, %name%.\r\n\r\nВаша ссылка для скачивания \"%good_title%\":\r\n%dlink%\r\n\r\nПостарайтесь скачать все файлы в течение 3-х суток.\r\n\r\nВсего доброго.\r\n\r\n--\r\n%site_title%\r\n%site_url%', 'plain', 0, 'price', '0', '', '', '', '', '', NULL, 'cisco', 'cisco', '', '', ''),
('realadwords', 2, 'Реальный Google AdWords', '<p>Чтобы познакомиться с сервисом <a href=\"http://rolar.ru/link.php?id=418\" target=\"_blank\" title=\"Google AdWords\">AdWords</a> и освоить основные принципы настройки рекламной кампании достаточно приобрести и просмотреть видеокурс <strong>&laquo;Реальный Google AdWords&raquo;</strong> от <a href=\"http://rolar.ru/partner_products.php?partner=13\" target=\"_blank\" title=\"Бизнес Молодость\">БМ</a>. Этот курс позволит Вам по шагам пройти путь от регистрации аккаунта до внедрения автономного конвейера продаж. Этот путь включает следующие шаги:</p>\r\n<ul>\r\n	<li>основы <a href=\"http://rolar.ru/link.php?id=418\" target=\"_blank\" title=\"Google AdWords\">Google AdWords</a>,</li>\r\n	<li class=\"bold\">поисковая реклама, сбор семантического ядра,</li>\r\n	<li>поисковая реклама, создание объявлений,</li>\r\n	<li class=\"bold\">поисковая реклама, настройка кампаний,</li>\r\n	<li>реклама в КМС, настройка таргетинга,</li>\r\n	<li class=\"bold\">реклама в КМС, создание и настройка объявлений,</li>\r\n	<li>аналитика рекламный кампаний,</li>\r\n	<li class=\"bold\">автоматизация рекламы,</li>\r\n	<li>менеджмент и управление.</li>\r\n</ul>\r\n<p>В итоге, только благодаря внедрению рекламы в <a href=\"http://rolar.ru/link.php?id=418\" target=\"_blank\" title=\"Google AdWords\">Google Adwords</a> Вы получите новый основной источник целевого трафика, обращений, кликов и новых клиентов.</p>\r\n<p>Приобретайте курс <strong>&laquo;Реальный Google AdWords&raquo;</strong> прямо сейчас, учитесь базовым основам и новейшим технологиям интернет-рекламы и продвижения, и получайте постоянный поток клиентов на продукты вашего бизнеса!</p>', 'http://rolar/images/partner_products/biznes_molodost/realnyi_google_adwords2016/realnyi_google_adwords2.jpg', 1, 8, 475, 'rur', 'ebook', 0, '', 0, 'fixed', 0, 'fixed', 0, 1, '', 0, '', 'http://rolar.ru/download_link.php?id=281', '', 1, 'realdirect,realinstagram,realvk', 20, 0, 'cisco', '', 0, 'cisco', '', 0, 'cisco', '', '<strong style=\"color:#cc0000;\">Выгодное предложение!</strong> Приобретите курс <strong style=\"color:#003399;\">Реальный Google AdWords</strong> со скидкой <strong style=\"color:#cc0000;\">20%</strong>.<br>Нажмите на кнопку <strong style=\"color:#3399cc;\">Добавить в корзину</strong>.', '', 0, 0, '%name%, Ваша ссылка для скачивания товара', 'Здравствуйте, %name%.\r\n\r\nВаша ссылка для скачивания \"%good_title%\":\r\n%dlink%\r\n\r\nПостарайтесь скачать все файлы в течение 3-х суток.\r\n\r\nВсего доброго.\r\n\r\n--\r\n%site_title%\r\n%site_url%', 'plain', 0, 'price', '0', '', '', '', '', '', NULL, 'cisco', 'cisco', '', '', ''),
('soft1', 1, 'Универсальный сборник программ для Windows', '<p>Чтобы избавить пользователей ПК от лишних проблем с выбором оптимальных программ для удобной и комфортной работы на ПК и техническими моментами по их установке и настройке был собран <strong>Универсальный сборник программ</strong> для ОС Windows.</p>\r\n<p>Благодаря этой сборке Вы экономите время на поиск, установку и настройку программного обеспечения. После автоматической установки программ Вы сможете продуктивно, полноценно и комфортно работать на компьютере, не отвлекаясь на регистрацию, активацию, настройку и устранение ошибок, борьбу за оптимальное быстродействие.</p>\r\n<p><strong>Преимущества использования сборника программ:</strong></p>\r\n<ol>\r\n  <li>Автоматическая установка</li>\r\n  <li>Всплывающие подсказки</li>\r\n  <li>Минимальный набор</li>\r\n  <li>Долгий срок</li>\r\n  <li>Качественная работа</li>\r\n  <li>Аппаратная совместимость</li>\r\n  <li>Оптимальный размер</li>\r\n</ol>\r\n<p>Приобретая <strong>Сборник программ</strong>, Вам не нужно обращаться за помощью к специалистам для переустановки и настройки программного обеспечения. Достаточно скачать сборник программ один раз и пользоваться им всегда в любое удобное время, на любом компьютере или ноутбуке, где установлена операционная система Windows.</p>\r\n<p>Приобретайте этот сборник программ прямо сейчас.</p>', 'http://rolar.ru/images/goods/soft1/soft1_580.png', 1, 9, 275, 'rur', 'ebook', 1, 'http://rolar.ru/view_product.php?id=282', 50, 'fixed', 20, 'fixed', 1, 1, '', 0, '', 'http://rolar.ru/download_link.php?id=282', 'qyqfr', 1, 'soft2,comp,cisco', 20, 1, 'soft2', '<div class=\"one_cart_item\">\r\n<h1>Сборник новейших универсальных программ за <span style=\"color:#cc0000;\">200 рублей</span>!</h1>\r\n<div class=\"cart_descr\"><br>\r\n<p><img src=\"http://rolar.ru/om/images/cart/soft2.jpg\"></p>\r\n<p>Цена:<span class=\"cart_old_price\">375.00 р.</span><br>\r\nДля Вас:<span class=\"cart_price\">200.00 р.</span></p>\r\n<p>Нажмите на кнопку <strong style=\"color:#3399cc;\">Добавить к заказу</strong>.</p>\r\n</div>\r\n</div>', 0, 'comp', '<div class=\"one_cart_item\">\r\n<h1>Как стать уверенным пользователем ПК за 13 часов?</h1>\r\n<div class=\"cart_descr\"><br>\r\n<p><img src=\"http://rolar.ru/om/images/cart/comp.jpg\"></p>\r\n<p>Цена:<span class=\"cart_old_price\">980.00 р.</span><br>\r\nДля Вас:<span class=\"cart_price\">490.00 р.</span></p>\r\n<p>Нажмите на кнопку <strong style=\"color:#3399cc;\">Добавить к заказу</strong>.</p>\r\n</div>\r\n</div>', 0, 'cisco', '', '<strong style=\"color:#cc0000;\">Выгодное предложение!</strong> Приобретите <strong style=\"color:#003399;\">Универсальный сборник программ для Windows</strong> со скидкой <strong style=\"color:#cc0000;\">20%</strong>.<br>Нажмите на кнопку <strong style=\"color:#3399cc;\">Добавить в корзину</strong>.', '', 0, 50, '%name%, Ваша ссылка для скачивания товара', 'Здравствуйте, %name%.\r\n\r\nВаша ссылка для скачивания \"%good_title%\":\r\n%dlink%\r\n\r\nПостарайтесь скачать все файлы в течение 3-х суток.\r\n\r\nВсего доброго.\r\n\r\n--\r\n%site_title%\r\n%site_url%', 'plain', 0, 'total', '0', '', '', '', '', '', NULL, 'cisco', 'cisco', '', '', ''),
('soft2', 1, 'Сборник новейших универсальных программ', '<p><strong>Сборник новейших программ</strong> позволит вам:</p>\r\n<ul>\r\n	<li class=\"bold\">съэкономить время на переустановку и обновление ПО - скачать и автоматически установить новые программы не составит более 30 минут,</li>\r\n	<li>избежать ошибок и сбоев при установке &quot;сырых бета-версий&quot; программ - все программы из сборника многократно протестированы на различных устройствах,</li>\r\n	<li class=\"bold\">избежать скачивания возможных мошеннических и вредоносных программ - все программы проверены самыми передовыми антивирусными программами и не содержат вирусов,</li>\r\n	<li>пользоваться этим сборником программ в дальнейшем на любых компьютерах, ноутбуках с ОС Windows - Вы сможете самостоятельно без помощи специалистов устанавливать любые необходимые программы на любые совместимые устройства,</li>\r\n	<li class=\"bold\">эффективно пользоваться самыми последними, передовыми программами для Windows на текущий момент - Вы непременно это заметите во время плодотворной и творческой работы и домашних развлечений за компьютером.</li>\r\n</ul>\r\n<p>Приобретайте этот <strong>Сборник</strong> прямо сейчас, пока все необходимые программы актуальны на текущий момент. Не упустите шанс. Действуйте прямо сейчас!</p>', 'http://rolar.ru/images/goods/soft2/soft2-2.png', 1, 10, 325, 'rur', 'ebook', 1, 'http://rolar.ru/view_product.php?id=283', 100, 'fixed', 50, 'fixed', 1, 1, '', 0, '', 'http://rolar.ru/download_link.php?id=283', 'qyqfr', 1, 'soft1,comp,cisco', 20, 1, 'soft1', '<div class=\"one_cart_item\">\r\n<h1>Универсальный сборник программ для Windows за <span style=\"color:#cc0000;\">150 рублей</span>!</h1>\r\n<div class=\"cart_descr\"><br>\r\n<p><img src=\"http://rolar.ru/om/images/cart/soft1.jpg\"></p>\r\n<p>Цена:<span class=\"cart_old_price\">275.00 р.</span><br>\r\nДля Вас:<span class=\"cart_price\">150.00 р.</span></p>\r\n<p>Нажмите на кнопку <strong style=\"color:#3399cc;\">Добавить к заказу</strong>.</p>\r\n</div>\r\n</div>', 0, 'comp', '<div class=\"one_cart_item\">\r\n<h1>Как стать уверенным пользователем ПК за 13 часов?</h1>\r\n<div class=\"cart_descr\"><br>\r\n<p><img src=\"http://rolar.ru/om/images/cart/comp.jpg\"></p>\r\n<p>Цена:<span class=\"cart_old_price\">980.00 р.</span><br>\r\nДля Вас:<span class=\"cart_price\">490.00 р.</span></p>\r\n<p>Нажмите на кнопку <strong style=\"color:#3399cc;\">Добавить к заказу</strong>.</p>\r\n</div>\r\n</div>', 0, 'cisco', '', '<strong style=\"color:#cc0000;\">Выгодное предложение!</strong> Приобретите <strong style=\"color:#003399;\">Сборник новейших универсальных программ</strong> со скидкой <strong style=\"color:#cc0000;\">20%</strong>.<br>Нажмите на кнопку <strong style=\"color:#3399cc;\">Добавить в корзину</strong>.', '', 0, 50, '%name%, Ваша ссылка для скачивания товара', 'Здравствуйте, %name%.\r\n\r\nВаша ссылка для скачивания \"%good_title%\":\r\n%dlink%\r\n\r\nПостарайтесь скачать все файлы в течение 3-х суток.\r\n\r\nВсего доброго.\r\n\r\n--\r\n%site_title%\r\n%site_url%', 'plain', 0, 'total', '0', '', '', '', '', '', NULL, 'cisco', 'cisco', '', '', '');

-- --------------------------------------------------------

--
-- Структура таблицы `om_good_group`
--

CREATE TABLE `om_good_group` (
  `id` int(11) NOT NULL,
  `group_id` int(11) NOT NULL,
  `good_id` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `om_good_group`
--

INSERT INTO `om_good_group` (`id`, `group_id`, `good_id`) VALUES
(1, 1, 'cisco'),
(2, 1, 'comp'),
(3, 1, 'om2nulled'),
(4, 1, 'soft1'),
(5, 1, 'soft2'),
(6, 2, 'realvk'),
(7, 2, 'realdirect'),
(8, 2, 'realinstagram'),
(9, 2, 'realadwords');

-- --------------------------------------------------------

--
-- Структура таблицы `om_letter`
--

CREATE TABLE `om_letter` (
  `id` varchar(100) NOT NULL,
  `description` varchar(255) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `type` varchar(10) NOT NULL,
  `lon` tinyint(4) NOT NULL DEFAULT '1'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `om_letter`
--

INSERT INTO `om_letter` (`id`, `description`, `subject`, `message`, `type`, `lon`) VALUES
('admin_disk', 'Для Админа о заказе физического товара', 'Счёт за физический товар(ы) оплачен', 'Здравствуйте.\r\n\r\nСчёт №%bill_id%, включающий физические товары - оплачен, теперь необходимо отправить товар покупателю.\r\n\r\nСтатус счёта:\r\n%status_link%\r\n\r\nСсылка на счёт в Панели Администратора:\r\n%admin_link%\r\n\r\nID товаров:\r\n%good_id%\r\n\r\nДанные для доставки:\r\n\r\nФамилия: %surname%\r\nИмя: %uname%\r\nОтчество: %otchestvo%\r\n\r\nСтрана: %strana%\r\nОбласть/Край: %region%\r\nПочтовый индекс: %postindex%\r\nГород: %gorod%\r\nАдрес: %address%\r\nТелефон: %phone%\r\nКомментарий к заказу: %comment%\r\n\r\n----------------------------\r\n\r\nДанные об этом счёте:\r\n\r\nСумма (с учётом скидки если есть): %sum%\r\nСумма в рублях: %rur% руб.\r\n\r\nE-mail покупателя: %email%\r\nАльтернативный E-mail покупателя: %amail%\r\nКупон скидки: %kupon%\r\n\r\nКомиссионных партнёрам (всего): %komis% руб.\r\nАвторское вознаграждение: %akomis% руб.\r\n\r\nСпособ оплаты: %way%\r\n\r\nP.S. Если партнёрам положены комиссионные, то они зачислены и им отправлены соответствующие уведомления\r\n\r\nP.P.S. Для гарантии проверяйте эти сведения, войдя в Панель Управления.\r\n\r\n--\r\nСистема Order Master 2', 'plain', 1),
('admin_ebook', 'Для Админа уведомление об оплате', 'Счёт оплачен', 'Здравствуйте.\r\n\r\nСчёт №%bill_id% оплачен и товар(ы) отправлен(ы) покупателю.\r\n\r\nСтатус счёта:\r\n%status_link%\r\n\r\nСсылка на счёт в Панели Администратора:\r\n%admin_link%\r\n\r\nДанные об этом счёте:\r\n\r\nID товара(ов):\r\n%good_id%\r\n\r\nСумма (с учётом скидки если есть): %sum%\r\nСумма в рублях: %rur% руб.\r\n\r\nИмя покупателя: %uname%\r\nE-mail покупателя: %email%\r\nАльтернативный E-mail покупателя: %amail%\r\nТелефон: %phone%\r\nКупон скидки: %kupon%\r\n\r\n%orders%\r\n\r\nКомиссионных партнёрам (всего): %komis% руб.\r\nАвторское вознаграждение: %akomis% руб.\r\n\r\nСпособ оплаты: %way%\r\n\r\nP.S. Если партнёрам положены комиссионные, то они зачислены и им отправлены соответствующие уведомления\r\n\r\nP.P.S. Для гарантии проверяйте эти сведения, войдя в Панель Администратора.\r\n\r\n--\r\nСистема Order Master 2', 'plain', 1),
('admin_forgot_link', 'Запрос на восстановление пароля администратора', '[Order Master 2] - Ваша ссылка для восстановления пароля', 'Здравствуйте, %name%!\r\n\r\nВы запросили восстановление пароля для доступа к панели администратора.\r\n\r\nВаш Логин: %username%\r\nВремя запроса: %time%\r\nЗапрошено с IP: %ip%\r\n\r\nДля получения нового пароля, нажмите на следующую ссылку:\r\n%link%\r\n\r\nВам будет сгенерирован новый пароль и выслан на e-mail.\r\nСменить его сможет только администратор - в разделе \"Операторы\".', 'plain', 1),
('admin_forgot_pass', 'Новый пароль администратора', '[Order Master 2] - Новый пароль', 'Здравствуйте, %name%!\r\n\r\nДля Вашей учётной записи сгенерирован новый пароль.\r\n\r\nДанные для входа:\r\n\r\nЛогин: %username%\r\nПароль: %password%\r\n\r\nВход в аккаунт:\r\n%bu%admin/login', 'plain', 1),
('admin_kurier_confirmed', 'Администратору уведомление о заказе курьером', 'Подтверждён заказ №%bill_id% курьерской доставкой', 'Здравствуйте.\r\n\r\nОформлен и подтверждён заказ №%bill_id% курьерской с такими данными:\r\n\r\nСумма: %sum%\r\nКупон скидки (если есть): %cupon%\r\n\r\nE-mail: %email%\r\nДругой e-mail: %amail%\r\nТелефон: %phone%\r\nIP: %ip%\r\n\r\nКомментарий к заказу: %comment%\r\n\r\n===============================\r\n Содержимое заказа\r\n===============================\r\n\r\n%orders%\r\n===============================\r\n\r\nАдрес доставки:\r\n\r\nФамилия: %surname%\r\nИмя: %uname%\r\nОтчество: %otchestvo%\r\n\r\nСтрана: %strana%\r\nОбласть/регион: %region%\r\nГород: %gorod%\r\nАдрес: %address%\r\nПочтовый индекс: %postindex%\r\n\r\nДанный заказ подтверждён.\r\n\r\nСсылка на отслеживание статуса:\r\n%status_link%\r\n\r\nСсылка для просмотра счёта в Панели Администратора:\r\n%admin_link%\r\n\r\nВсего наилучшего.\r\n---\r\n[Отправлено системой Order Master 2]', 'plain', 1),
('admin_kurier_notconfirmed', 'Администратору уведомление о НЕПОДТВЕРЖДЁННОМ заказе курьером', 'Оформлен, но не подтверждён ещё заказ №%bill_id% курьером', 'Здравствуйте.\r\n\r\nОформлен (но не подтверждён ещё) заказ №%bill_id% КУРЬЕРОМ с такими данными:\r\n\r\nСумма: %sum%\r\nКупон скидки (если есть): %cupon%\r\n\r\nE-mail: %email%\r\nДругой e-mail: %amail%\r\nТелефон: %phone%\r\nIP: %ip%\r\n\r\nКомментарий к заказу: %comment%\r\n\r\n===============================\r\n Содержимое заказа\r\n===============================\r\n\r\n%orders%\r\n===============================\r\n\r\nАдрес доставки:\r\n\r\nФамилия: %surname%\r\nИмя: %uname%\r\nОтчество: %otchestvo%\r\n\r\nСтрана: %strana%\r\nОбласть/регион: %region%\r\nГород: %gorod%\r\nАдрес: %address%\r\nПочтовый индекс: %postindex%\r\n\r\nДанный заказ ещё не подтверждён - требует подтверждения оператором или заказчиком по ссылке (если включено письмо).\r\n\r\nСсылка на отслеживание статуса:\r\n%status_link%\r\n\r\nСсылка для просмотра счёта в Панели Администратора:\r\n%admin_link%\r\n\r\nВсего наилучшего.\r\n---\r\n[Отправлено системой Order Master 2]', 'plain', 0),
('admin_nalozh_confirmed', 'Администратору уведомление о заказе наложенным платежом', 'Оформлен заказ №%bill_id% наложенным платежом', 'Здравствуйте.\r\n\r\nОформлен заказ №%bill_id% наложенным платежом с такими данными:\r\n\r\nСумма: %sum%\r\nКупон скидки (если есть): %cupon%\r\n\r\nE-mail: %email%\r\nДругой e-mail: %amail%\r\nТелефон: %phone%\r\nIP: %ip%\r\n\r\nКомментарий к заказу: %comment%\r\n\r\n===============================\r\n Содержимое заказа\r\n===============================\r\n\r\n%orders%\r\n===============================\r\n\r\nАдрес доставки:\r\n\r\nФамилия: %surname%\r\nИмя: %uname%\r\nОтчество: %otchestvo%\r\n\r\nСтрана: %strana%\r\nОбласть/регион: %region%\r\nГород: %gorod%\r\nАдрес: %address%\r\nПочтовый индекс: %postindex%\r\n\r\nДанный заказ подтверждён.\r\n\r\nСсылка на отслеживание статуса:\r\n%status_link%\r\n\r\nСсылка для просмотра счёта в Панели Администратора:\r\n%admin_link%\r\n\r\nВсего наилучшего.\r\n---\r\n[Отправлено системой Order Master 2]', 'plain', 1),
('admin_nalozh_cross', 'Админу, когда добавился заказ к счёту (кроссел)', 'К счёту %bill_id% добавлен заказ номер %order_id%', 'Здравствуйте.\r\n\r\nПользователь воспользовался специальным предложением после заказа наложенным платежом.\r\n\r\nК счёту %bill_id% добавлен заказ на один товар:\r\n\r\nID товара: %good_id%\r\nНазвание товара: %good_title%\r\nНомер заказа: %order_id%\r\n\r\nСсылка на статус заказа:\r\n%status_link%\r\n\r\nПросмотреть в панели администратора данный счёт:\r\n%admin_link%\r\n\r\nВсего наилучшего.\r\n\r\n---\r\nСистема Order Master 2', 'plain', 1),
('admin_nalozh_notconfirmed', 'Администратору уведомление о НЕПОДТВЕРЖДЁННОМ заказе наложенным платежом', 'Оформлен, но не подтверждён ещё заказ №%bill_id% наложенным платежом', 'Здравствуйте.\r\n\r\nОформлен (но не подтверждён ещё) заказ №%bill_id% наложенным платежом с такими данными:\r\n\r\nСумма: %sum%\r\nКупон скидки (если есть): %cupon%\r\n\r\nE-mail: %email%\r\nДругой e-mail: %amail%\r\nТелефон: %phone%\r\nIP: %ip%\r\n\r\nКомментарий к заказу: %comment%\r\n\r\n===============================\r\n Содержимое заказа\r\n===============================\r\n\r\n%orders%\r\n===============================\r\n\r\nАдрес доставки:\r\n\r\nФамилия: %surname%\r\nИмя: %uname%\r\nОтчество: %otchestvo%\r\n\r\nСтрана: %strana%\r\nОбласть/регион: %region%\r\nГород: %gorod%\r\nАдрес: %address%\r\nПочтовый индекс: %postindex%\r\n\r\nДанный заказ ещё не подтверждён - требует подтверждения оператором или заказчиком по ссылке (если включено письмо).\r\n\r\nСсылка на отслеживание статуса:\r\n%status_link%\r\n\r\nСсылка для просмотра счёта в Панели Администратора:\r\n%admin_link%\r\n\r\nВсего наилучшего.\r\n---\r\n[Отправлено системой Order Master 2]', 'plain', 0),
('admin_nalozh_ok', 'Подтверждён наложенный платёж', 'Подтверждён наложенный платёж по счёту %bill_id%', 'Это системное уведомление от Order Master 2.\r\n\r\nПо счёту №%bill_id% наложенным платежом отмечено подтверждение оплаты заказа.\r\n\r\nСумма: %sum%\r\n\r\nE-mail: %email%\r\nДругой e-mail: %amail%\r\nТелефон: %phone%\r\nIP: %ip%\r\n\r\nКомментарий к заказу: %comment%\r\n\r\nАдрес доставки:\r\n\r\nФамилия: %surname%\r\nИмя: %uname%\r\nОтчество: %otchestvo%\r\n\r\nСтрана: %strana%\r\nОбласть/регион: %region%\r\nГород: %gorod%\r\nАдрес: %address%\r\nПочтовый индекс: %postindex%\r\n\r\nСсылка на отслеживание статуса:\r\n%status_link%\r\n\r\nСсылка для просмотра счёта в Панели Администратора:\r\n%admin_link%\r\n\r\nВсего наилучшего.\r\n\r\n---\r\n[Отправлено системой Order Master 2]', 'plain', 1),
('admin_notify_paid', 'Уведомление о совершении платежа вручную', 'Пользователь сообщает о совершении платежа вручную', 'Здравствуйте.\r\n\r\nПользователь сообщате, что счёт №%bill_id% был оплачен вручную.\r\n\r\nСумма: %sum%\r\nСпособ: %way%\r\n\r\n===============================================\r\n Текст сообщения от пользователя\r\n===============================================\r\n\r\n%message%\r\n\r\n===============================================\r\n\r\nСсылка на отслеживание статуса:\r\n%status_link%\r\n\r\nСсылка для просмотра счёта в Панели Администратора:\r\n%admin_link%\r\n\r\nПроверьте действительно поступления оплаты и после этого отметьте счёт как оплаченный.\r\n\r\nВсего наилучшего.\r\n---\r\n[Отправлено системой Order Master 2]', 'plain', 1),
('admin_odno', 'Админу заказ с одностраничника', 'Новый заказ товара %good_id%', 'Уведомление о новом заказе с одностраничника.\r\n\r\nИмя: %uname%\r\nТелефон: %phone%\r\n\r\nТовар: %good_id%\r\nСумма: %sum% %valuta%\r\n\r\nIP: %ip%\r\n\r\n--\r\nСистема Order Master 2', 'plain', 1),
('affreg', 'После регистрации в партнёрской программе', '%name%, Вы зарегистрировались в партнёрской программе', 'Здравствуйте, %name%!\r\n\r\nВы зарегистрированы в партнёрской программе.\r\n\r\nВаши данные для входа в аккаунт:\r\n\r\nЛогин: %partner_id%\r\nПароль: %password%\r\n\r\nВход в аккаунт здесь:\r\n%bu%aff/login\r\n\r\n\r\nP.S. Если Вы получили письмо по ошибке, пожалуйста, просто проигнорируйте его.\r\n--\r\n%site_title%\r\n%site_url%', 'plain', 1),
('aff_notify', 'Уведомление партнёру о начислении комиссионных', '%name%, Вам начислены комиссионные за участие в партнёрской программе', 'Здравствуйте, %name%!\r\n\r\nПо Вашей партнёрской ссылке была совершена продажа и Вам зачислены комиссионные.\r\n\r\nНазвание товара: \"%good_title%\"\r\n\r\nE-mail покупателя: %client_mail%\r\nНомер счёта: %bill_id%\r\n\r\nВаше вознаграждение: %komis% руб.\r\n\r\nВойти в Ваш партнёрский аккаунт для просмотра статистики Вы можете здесь:\r\n\r\n%bu%aff/login\r\n\r\nВаш логин: %refid%\r\n\r\nКомиссионные для следующих продаж этого товара: %newkomis%\r\n\r\nКомиссионные будут выплачены Вам в срок, установленный автором. О выплате комиссионных Вы получите отдельное уведомление.\r\n\r\n--\r\nP.S. Вы получили это письмо, так как являетесь участником партнёрской программы сайта:\r\n\r\n%site_title%\r\n%site_url%', 'plain', 1),
('aff_payout', 'Уведомление о выплате комиссионных', '%name%, Вам выплачены комиссионные!', 'Здравствуйте, %name%!\r\n\r\nВы являетесь участником партнёрской программы сайта:\r\n%site_url%\r\n\r\nВаш RefID: %refid%\r\n\r\nВам выплачены комиссионные в размере: %sum% руб.\r\n\r\nСпособ выплаты: %way%\r\nВыплачено на счёт: %purse%\r\n\r\nВсего наилучшего.\r\n\r\n---\r\n%site_title%\r\n%site_url%', 'plain', 1),
('area_data', 'Письмо с данными для доступа к Закрытой Зоне', '%name%, Ваши данные для доступа к Закрытой Зоне', 'Здравствуйте, %name%.\r\n\r\nВ данном письме находятся данные для доступа к Закрытой Зоне \"%title%\".\r\n\r\nЛогин: %username%\r\nПароль: %password%\r\n\r\nСсылка для входа:\r\n%area_link%\r\n\r\nВсего наилучшего.\r\n---\r\n%site_title%\r\n%site_url%', 'plain', 1),
('area_long', 'Пользователь продлил закрытую зону', 'Вы продлили доступ к Закрытой Зоне', 'Здравствуйте.\r\n\r\nВы продлили доступ к Закрытой зоне.\r\nТеперь она действует до %till% (для обновления информации - войдите заново в Закрытую Зону)\r\n\r\nВаши данные для входа:\r\nЛогин: %username%\r\nПароль: %password%\r\n\r\nСсылка:\r\n%bu%area\r\n\r\nВсего наилучшего.', 'plain', 1),
('author_payout', 'Уведомление о выплате авторского вознаграждения', '%name%, Вам выплачено авторское вознаграждение', 'Здравствуйте, %name%!\r\n\r\nВаш ID автора: %id%\r\n\r\nВам выплачено авторское вознаграждение в размере: %sum% руб.\r\n\r\nСпособ выплаты: %way%\r\nВыплачено на счёт: %purse%\r\n\r\nВсего наилучшего.\r\n\r\n---\r\n%site_title%\r\n%site_url%', 'plain', 1),
('author_sell', 'Для автора - уведомление о совершении продажи', '%name%, совершена продажа Вашего продукта', 'Здравствуйте, %name%!\r\n\r\nСовершена продажа Вашего продукта и Вам начислено авторское вознаграждение.\r\n\r\nНазвание товара: \"%good_title%\"\r\n\r\nСумма, оплаченная за товар: %sum%.\r\nВаше вознаграждение: %komis% руб.\r\n\r\nНомер счёта: %bill_id%\r\nНомер заказа: %order_id%\r\n\r\n==========================================\r\n Данные покупателя\r\n==========================================\r\n\r\n Email: %cmail%\r\n \r\n Фамилия: %surname%\r\n Имя: %cname%\r\n Отчество: %otchestvo%\r\n\r\n Страна: %strana%\r\n Область/регион: %region%\r\n Город: %gorod%\r\n Почтовый индекс: %postindex%\r\n Адрес: %address%\r\n\r\n Телефон: %phone%\r\n\r\n==========================================\r\n\r\nВойти в Ваш авторский аккаунт для просмотра статистики Вы можете здесь:\r\n\r\n%bu%author/\r\n\r\nВаш логин: %login%\r\n\r\nВознаграждение будет выплачено Вам в срок, установленный администратором. О выплате вознаграждения Вы получите отдельное уведомление.\r\n\r\nВсего наилучшего!\r\n--\r\n%site_title%\r\n%site_url%', 'plain', 1),
('bill_error', 'Ошибка при оплате несуществующего или оплаченного счёта', 'Возможно произошла ошибка при оплате счёта', 'Здравствуйте.\r\n\r\nВозможно произошла ошибка при оплате счёта %bill_id%.\r\n\r\nПричина: %error%\r\n\r\nПроверьте поступления средств по данному счёту и при необходимости сделайте ручное зачисление.\r\n\r\nМожет быть это и не ошибка, а всего лишь повторное оповещение от платёжной системы - но рекомендуется проверить разделы \"Счета\" и \"Клиенты\" - всё ли в порядке по данному счёту.\r\n\r\n--\r\nСистема Order Master 2\r\n\r\n', 'plain', 1),
('bill_new', 'Выписан новый счёт (письмо пользователю)', 'Вы выписали новый счёт', 'Здравствуйте.\r\n\r\nВы выписали новый счёт:\r\n\r\nНомер счёта: %bill_id%\r\nСумма: %sum%\r\n\r\nПостоянная ссылка для отслеживания состояния Вашего заказа:\r\n%status_link%\r\n\r\nP.S. Если Вам письмо пришло по ошибке - просто проигнорируйте его, при необходимости - свяжитесь с администрацией сайта самостоятельно.\r\n---\r\n%site_title%\r\n%site_url%', 'plain', 0),
('bill_notify_1', 'Первое напоминание о неоплаченном счёте', 'У вас имеется неоплаченный счёт', 'Здравствуйте.\r\n\r\nВы ранее оформляли заказ №%bill_id%, но оплата за него пока что не поступала.\r\n\r\nПожалуйста, просмотрите информацию о выписанном счёте и при необходимости - произведите оплату.\r\n\r\nИнформация:\r\n\r\nСчёт выписан: %date%\r\nСумма: %sum%\r\n\r\nСсылка на оплату: %pay_link%\r\n\r\nПостоянная ссылка для отслеживания состояния Вашего заказа:\r\n%status_link%\r\n\r\nВсего Вам наилучшего.\r\n\r\n---\r\n%site_title%\r\n%site_url%\r\n\r\nОтказаться от получения напоминаний:\r\n%unsub%', 'plain', 1),
('bill_notify_2', 'Второе напоминание о неоплаченном счёте', 'У вас имеется неоплаченный счёт', 'Здравствуйте.\r\n\r\nВы ранее оформляли заказ №%bill_id%, но оплата за него пока что не поступала.\r\n\r\nПожалуйста, просмотрите информацию о выписанном счёте и при необходимости - произведите оплату.\r\n\r\nИнформация:\r\n\r\nСчёт выписан: %date%\r\nСумма: %sum%\r\n\r\nСсылка на оплату: %pay_link%\r\n\r\nПостоянная ссылка для отслеживания состояния Вашего заказа:\r\n%status_link%\r\n\r\nВсего Вам наилучшего.\r\n\r\n---\r\n%site_title%\r\n%site_url%\r\n\r\nОтказаться от получения напоминаний:\r\n%unsub%', 'plain', 1),
('forgot_pass', 'Восстановление пароля в партнёрской программе', '%name%, Ваш пароль к партнёрской программе', 'Здравствуйте, %name%!\r\n\r\nВы запросили восстановление пароля к партнёрской программе.\r\n\r\nВаши данные:\r\n\r\nЛогин (RefID): %partner_id%\r\nПароль: %password%\r\n\r\nВход в аккаунт:\r\n%bu%aff/default/login\r\n\r\nP.S. Если Вы получили данное письмо по ошибке, пожалуйста, проигнорируйте его или свяжитесь с администратором.\r\n\r\n--\r\n%site_title%\r\n%site_url%\r\n', 'plain', 1),
('good_default_letter', 'Письмо по умолчанию - при добавлении нового товара', '%name%, Ваша ссылка для скачивания товара', 'Здравствуйте, %name%.\r\n\r\nВаша ссылка для скачивания \"%good_title%\":\r\n%dlink%\r\n\r\nПостарайтесь скачать все файлы в течение 3-х суток.\r\n\r\nВсего доброго.\r\n\r\n--\r\n%site_title%\r\n%site_url%', 'plain', 1),
('kurier_confirm', 'Письмо с ссылкой подтверждения заказа курьером', 'Подтверждение заказа курьерской доставкой', 'Здравствуйте.\r\n\r\nВы оформили заказ курьерской доставкой:\r\n\r\nНомер счёта: %bill_id%\r\nСумма: %sum%\r\n\r\nЧтобы подтвердить данный заказ, следует перейти по ссылке:\r\n%nalozh_link%\r\n\r\nВНИМАНИЕ! Подтверждайте только в том случае, если Вы обязуетесь оплатить заказ, когда он будет доставлен Вам курьером. В противном случае - не нажимайте на ссылку и просто удалите данное письмо.\r\n\r\nПостоянная ссылка для отслеживания состояния Вашего заказа:\r\n%status_link%\r\n\r\nP.S. Если Вам письмо пришло по ошибке - просто проигнорируйте его, при необходимости - свяжитесь с администрацией сайта самостоятельно.\r\n---\r\n%site_title%\r\n%site_url%', 'plain', 1),
('kurier_confirmed', 'Заказ с курьерской доставкой подтверждён', 'Ваш заказ курьерской доставкой подтверждён', 'Здравствуйте, %name%.\r\n\r\nВаш заказ курьерской доставкой успешно подтверждён.\r\nДоставка произойдёт в ближайшее время - в сроки, установленные продавцом.\r\n\r\nНомер счёта: %bill_id%\r\n\r\nПостоянная ссылка для отслеживания состояния Вашего заказа:\r\n%status_link%\r\n\r\n---\r\n%site_title%\r\n%site_url%', 'plain', 1),
('mobile', 'Для Администратора на мобильный', 'PAID', 'Oplachen %bill_id% ID %good_id% Summa %cena% %valuta% refid \'%refid%\' email: %email%', 'plain', 1),
('nalozh_after', 'Клиенту после поступления денег от наложенного платежа', '%name%, Ваша оплата (по наложенному платежу) получена', 'Здравствуйте, %name%!\r\n\r\nВы ранее заказывали товар с оплатой наложенным платежом (при получении на почте):\r\n\r\n\"%good_title%\"\r\n\r\nЭто письмо просто уведомляет Вас о том, что оплата успешно получена продавцом и зачислена.\r\n\r\nСпасибо.\r\n\r\nP.S. Данное письмо носит информационный характер, отвечать на него не нужно.\r\n\r\n--\r\n%site_title%\r\n%site_url%', 'plain', 1),
('nalozh_confirm', 'Письмо с ссылкой подтверждения наложенного платежа', 'Подтверждение заказа наложенным платежом', 'Здравствуйте.\r\n\r\nВы оформили заказ наложенным платежом:\r\n\r\nНомер счёта: %bill_id%\r\nСумма: %sum%\r\n\r\nЧтобы подтвердить данный заказ, следует перейти по ссылке:\r\n%nalozh_link%\r\n\r\nВНИМАНИЕ! Подтверждайте только в том случае, если Вы обязуетесь выкупить заказ, когда он прийдёт по почте. В противном случае - не нажимайте на ссылку и просто удалите данное письмо.\r\n\r\nПостоянная ссылка для отслеживания состояния Вашего заказа:\r\n%status_link%\r\n\r\nP.S. Если Вам письмо пришло по ошибке - просто проигнорируйте его, при необходимости - свяжитесь с администрацией сайта самостоятельно.\r\n---\r\n%site_title%\r\n%site_url%', 'plain', 1),
('nalozh_confirmed', 'Заказ наложенным платежом подтверждён', 'Ваш заказ наложенным платежом подтверждён', 'Здравствуйте, %name%.\r\n\r\nВаш заказ наложенным платежом успешно подтверждён.\r\nОтправка произойдёт в ближайшее время - в сроки, установленные продавцом.\r\n\r\nНомер счёта: %bill_id%\r\n\r\nПостоянная ссылка для отслеживания состояния Вашего заказа:\r\n%status_link%\r\n\r\n---\r\n%site_title%\r\n%site_url%', 'plain', 1),
('paff_notify', 'Уведомление партнёру 2-го уровня', '%name%, Вам начислены комиссионные 2-го уровня за участие в партнёрской программе', 'Здравствуйте, %name%!\r\n\r\nЗарегистрированный по Вашей партнёрской ссылке партнёр, привлёк покупателя. Совершена продажа и Вам зачислены комиссионные 2-го уровня.\r\n\r\nНазвание товара: \"%good_title%\"\r\n\r\nЛогин приведённого Вами партнёра: %prefid%\r\n\r\nВаше вознаграждение: %komis% руб.\r\n\r\nВойти в Ваш партнёрский аккаунт для просмотра статистики Вы можете здесь:\r\n\r\n%bu%aff/login\r\n\r\nВаш логин: %refid%\r\n\r\nКомиссионные будут выплачены Вам в срок, установленный автором. О выплате комиссионных Вы получите отдельное уведомление.\r\n\r\n--\r\nP.S. Вы получили это письмо, так как являетесь участником партнёрской программы сайта:\r\n\r\n%site_title%\r\n%site_url%', 'plain', 1),
('rass_default', 'По умолчанию при выполнении рассылки', '%name%, важная новость', 'Здравствуйте, %name%.\r\n\r\n\r\n\r\n\r\n\r\nВсего наилучшего!\r\n--\r\n%site_title%\r\n%site_url%\r\n\r\nОтказаться от получения сообщений на e-mail (безвозвратно):\r\n%unsub%\r\n', 'plain', 1),
('sent_nalozh', 'Пользователю отправлен заказ наложенным платежом', '%name%, Ваш заказ наложенным платежом отправлен', 'Здравствуйте, %name%.\r\n\r\nСделанный Вами заказ №%bill_id% отправлен наложенным платежом.\r\n\r\nНомер почтового отправления: %number%\r\n\r\nС помощью этого номера - на сайте Почты России Вы можете отследить путь данной посылки:\r\nhttp://russianpost.ru/rp/servise/ru/home/postuslug/trackingpo\r\n\r\nОбычно срок доставки посылок по России составляет 2-3 недели и зависит от расстояния, на которое идёт отправка.\r\n\r\nПосле того, как посылка поступит в Ваш город - Вам следует выкупить её в Вашем почтовом отделении.\r\n\r\nПостоянная ссылка с состоянием Вашего заказа:\r\n%status_link%\r\n\r\nВсего наилучшего.\r\n\r\n---\r\n%site_title%\r\n%site_url%', 'plain', 1),
('sent_prepaid', 'Отправлен предоплаченный физический товар', '%name%, Вам отправлена посылка с Вашим заказом', 'Здравствуйте, %name%.\r\n\r\nВаш заказ №%bill_id% был отправлен по почте.\r\n\r\nНомер почтового отправления: %number%\r\n\r\nС помощью этого номера - на сайте Почты России Вы можете отследить путь данной посылки:\r\nhttp://russianpost.ru/rp/servise/ru/home/postuslug/trackingpo\r\n\r\nОбычно срок доставки посылок по России составляет 2-3 недели - и зависит от расстояния, на которое идёт отправка.\r\n\r\nПостоянная ссылка с состоянием Вашего заказа:\r\n%status_link%\r\n\r\nВсего наилучшего.\r\n\r\n---\r\n%site_title%\r\n%site_url%', 'plain', 1),
('staff_answer', 'Служба поддержки добавила новый ответ', '%name%, добавлен новый ответ службы поддержки на Ваш запрос', '====================================================\r\n Не отвечайте на это письмо, так как оно отправлено автоматически.\r\n Пожалуйста, пройдите по ссылке, указанной в письме.\r\n====================================================\r\n\r\nЗдравствуйте, %name%.\r\n\r\nК отправленному Вами запросу добавлен новый ответ от Службы Поддержки.\r\n\r\nДанные тикета:\r\nID: %id%\r\nТема запроса: %subject%\r\nПросмотреть: %link%\r\n\r\nПо этой ссылке Вы также можете задать новый вопрос или же закрыть тикет.\r\n\r\nВсего наилучшего.\r\n\r\n---\r\n%site_title%\r\n%site_url%', 'plain', 1),
('staff_new_ticket', 'Пользователю, когда он создал новый тикет', 'Вы отправили новый запрос в службу поддержки. Номер тикета: %id%', '====================================================\r\nНе отвечайте на это письмо, так как оно отправлено автоматически.\r\n====================================================\r\n\r\nЗдравствуйте.\r\n\r\nВами был отправлен новый запрос в Службу Поддержки\r\n\r\nДанные тикета:\r\nID: %id%\r\nТема запроса: %subject%\r\n\r\nОтвет будет Вам выслан в срок примерно 1-3 рабочих дней. После ответа на Ваш запрос - Вы получите отдельное уведомление.\r\n\r\nТакже в любое время Вы можете просмотреть свой тикет по ID здесь:\r\n%site_url%/support/\r\n\r\nВсего Вам наилучшего!\r\n\r\nP.S. Если Вам письмо пришло по ошибке - просто проигнорируйте его, при необходимости - свяжитесь с владельцем сайта самостоятельно.\r\n\r\n---\r\n%site_title%\r\n%site_url%', 'plain', 1);

-- --------------------------------------------------------

--
-- Структура таблицы `om_log`
--

CREATE TABLE `om_log` (
  `id` bigint(20) NOT NULL,
  `date` int(11) DEFAULT NULL,
  `action` varchar(100) DEFAULT NULL,
  `user` varchar(100) DEFAULT NULL,
  `comment` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `om_log`
--

INSERT INTO `om_log` (`id`, `date`, `action`, `user`, `comment`) VALUES
(1, 1396959175, 'login', '1', 'Выполнен вход в админ-панель с логином admin IP-адрес 127.0.0.1'),
(2, 1497524302, 'login', '1', 'Выполнен вход в админ-панель с логином admin IP-адрес 145.255.3.80'),
(3, 1497542415, 'login', '1', 'Выполнен вход в админ-панель с логином admin IP-адрес 145.255.3.80'),
(4, 1497629076, 'login', '1', 'Выполнен вход в админ-панель с логином admin IP-адрес 136.169.134.213'),
(5, 1497646443, 'login', '1', 'Выполнен вход в админ-панель с логином admin IP-адрес 136.169.134.213'),
(6, 1497726125, 'login', '1', 'Выполнен вход в админ-панель с логином admin IP-адрес 136.169.134.213'),
(7, 1497778184, 'login', '1', 'Выполнен вход в админ-панель с логином admin IP-адрес 136.169.134.213'),
(8, 1497991978, 'login', '1', 'Выполнен вход в админ-панель с логином admin IP-адрес 136.169.134.213'),
(9, 1498578629, 'login', '1', 'Выполнен вход в админ-панель с логином admin IP-адрес 136.169.134.213'),
(10, 1499450321, 'newchange', NULL, 'Изменён счёт №1 - предыдущий статус \"Ожидание оплаты\", текущий статус \"Ожидание оплаты\"'),
(11, 1499450321, 'newchange', NULL, 'Изменён счёт №1 - предыдущий статус \"Ожидание оплаты\", текущий статус \"Ожидание оплаты\"'),
(12, 1499450327, 'newchange', NULL, 'Изменён счёт №1 - предыдущий статус \"Ожидание оплаты\", текущий статус \"Ожидание оплаты\"'),
(13, 1499450327, 'newchange', NULL, 'Изменён счёт №1 - предыдущий статус \"Ожидание оплаты\", текущий статус \"Ожидание оплаты\"'),
(14, 1499450380, 'newpay', NULL, 'Получено оповещение о зачислении счёта #1 на сумму 99.00 платёжная система rur кошелёк R248693955970'),
(15, 1499450380, 'newchange', NULL, 'Изменён счёт №1 - предыдущий статус \"Ожидание оплаты\", текущий статус \"Оплачен и отправлен\"'),
(16, 1499450380, 'newchange', NULL, 'Изменён счёт №1 - предыдущий статус \"Ожидание оплаты\", текущий статус \"Оплачен и отправлен\"'),
(17, 1499450380, 'newclient', NULL, 'Добавлен новый клиент №1 для товара \"om2nulled\" \r\nИмя клиента: \"Артем\"\r\nE-mail: paexvestor@gmail.com\r\nСчёт: 0'),
(18, 1499450381, 'sendgood', NULL, 'Отправлен товар покупателю paexvestor@gmail.com с именем \"Артем\"\r\nТема письма: \"Артем, Ваша ссылка для скачивания товара\"\r\nТекст письма: Здравствуйте, Артем.\r\n\r\nВаша ссылка для скачивания продукта \"Скрипт Order Master 2 (nulled)\" с сервиса Облако.Mail.ru:\r\nhttp://rolar.ru/internet_link.php?id=259\r\n\r\nИмя файла: order_master2_nulled.rar\r\nРазмер файла 568 Мб\r\n\r\nПостарайтесь скачать этот файл в течение 3-х суток.\r\n\r\nВсего наилучшего.\r\n\r\n--\r\nПерсональный сайт Артура Абзалова\r\nhttp://rolar.ru/\r\n'),
(19, 1499450381, 'newchange', NULL, 'Изменён счёт №1 - предыдущий статус \"Ожидание оплаты\", текущий статус \"Оплачен и отправлен\"'),
(20, 1499450381, 'newchange', NULL, 'Изменён счёт №1 - предыдущий статус \"Ожидание оплаты\", текущий статус \"Оплачен и отправлен\"'),
(21, 1499531960, 'login', '1', 'Выполнен вход в админ-панель с логином admin IP-адрес 136.169.206.59'),
(22, 1499771530, 'login', '1', 'Выполнен вход в админ-панель с логином admin IP-адрес 195.239.71.146'),
(23, 1499772220, 'login', '1', 'Выполнен вход в админ-панель с логином admin IP-адрес 195.239.71.146'),
(24, 1500255792, 'newchange', NULL, 'Изменён счёт №2 - предыдущий статус \"Ожидание оплаты\", текущий статус \"Ожидание оплаты\"'),
(25, 1500255792, 'newchange', NULL, 'Изменён счёт №2 - предыдущий статус \"Ожидание оплаты\", текущий статус \"Ожидание оплаты\"'),
(26, 1500517802, 'newchange', NULL, 'Изменён счёт №2 - предыдущий статус \"Ожидание оплаты\", текущий статус \"Ожидание оплаты\"'),
(27, 1500949202, 'newchange', NULL, 'Изменён счёт №2 - предыдущий статус \"Ожидание оплаты\", текущий статус \"Ожидание оплаты\"'),
(28, 1500989832, 'newchange', NULL, 'Изменён счёт №2 - предыдущий статус \"Ожидание оплаты\", текущий статус \"Ожидание оплаты\"'),
(29, 1500989832, 'newchange', NULL, 'Изменён счёт №2 - предыдущий статус \"Ожидание оплаты\", текущий статус \"Ожидание оплаты\"'),
(30, 1501704744, 'newchange', NULL, 'Изменён счёт №3 - предыдущий статус \"Ожидание оплаты\", текущий статус \"Ожидание оплаты\"'),
(31, 1501704744, 'newchange', NULL, 'Изменён счёт №3 - предыдущий статус \"Ожидание оплаты\", текущий статус \"Ожидание оплаты\"'),
(32, 1501704772, 'newchange', NULL, 'Изменён счёт №3 - предыдущий статус \"Ожидание оплаты\", текущий статус \"Ожидание оплаты\"'),
(33, 1501704772, 'newchange', NULL, 'Изменён счёт №3 - предыдущий статус \"Ожидание оплаты\", текущий статус \"Ожидание оплаты\"'),
(34, 1501704815, 'newchange', NULL, 'Изменён счёт №3 - предыдущий статус \"Ожидание оплаты\", текущий статус \"Ожидание оплаты\"'),
(35, 1501704815, 'newchange', NULL, 'Изменён счёт №3 - предыдущий статус \"Ожидание оплаты\", текущий статус \"Ожидание оплаты\"'),
(36, 1501704841, 'newchange', NULL, 'Изменён счёт №3 - предыдущий статус \"Ожидание оплаты\", текущий статус \"Ожидание оплаты\"'),
(37, 1501704841, 'newchange', NULL, 'Изменён счёт №3 - предыдущий статус \"Ожидание оплаты\", текущий статус \"Ожидание оплаты\"'),
(38, 1501704985, 'newchange', NULL, 'Изменён счёт №3 - предыдущий статус \"Ожидание оплаты\", текущий статус \"Ожидание оплаты\"'),
(39, 1501704985, 'newchange', NULL, 'Изменён счёт №3 - предыдущий статус \"Ожидание оплаты\", текущий статус \"Ожидание оплаты\"'),
(40, 1501705020, 'newpay', NULL, 'Получено оповещение о зачислении счёта #3 на сумму 59.400000 платёжная система rur кошелёк '),
(41, 1501705020, 'newchange', NULL, 'Изменён счёт №3 - предыдущий статус \"Ожидание оплаты\", текущий статус \"Оплачен и отправлен\"'),
(42, 1501705020, 'newchange', NULL, 'Изменён счёт №3 - предыдущий статус \"Ожидание оплаты\", текущий статус \"Оплачен и отправлен\"'),
(43, 1501705020, 'newclient', NULL, 'Добавлен новый клиент №2 для товара \"om2nulled\" \r\nИмя клиента: \"Артем\"\r\nE-mail: strong.lapshin@mail.ru\r\nСчёт: 0'),
(44, 1501705020, 'sendgood', NULL, 'Отправлен товар покупателю strong.lapshin@mail.ru с именем \"Артем\"\r\nТема письма: \"Артем, Ваша ссылка для скачивания товара\"\r\nТекст письма: Здравствуйте, Артем.\r\n\r\nВаша ссылка для скачивания продукта \"Скрипт Order Master 2 (nulled)\" с сервиса Облако.Mail.ru:\r\nhttps://cloud.mail.ru/public/Jbgv/gEQVPSGUf\r\n\r\nИмя файла: order_master2_nulled.rar\r\nРазмер файла 568 Мб\r\n\r\nПостарайтесь скачать этот файл в течение 3-х суток.\r\n\r\nВсего наилучшего.\r\n\r\n--\r\nПерсональный сайт Артура Абзалова\r\nhttp://rolar.ru/\r\n'),
(45, 1501705020, 'newchange', NULL, 'Изменён счёт №3 - предыдущий статус \"Ожидание оплаты\", текущий статус \"Оплачен и отправлен\"'),
(46, 1501705020, 'newchange', NULL, 'Изменён счёт №3 - предыдущий статус \"Ожидание оплаты\", текущий статус \"Оплачен и отправлен\"'),
(47, 1501877275, 'login', '1', 'Выполнен вход в админ-панель с логином admin IP-адрес 46.191.158.148'),
(48, 1501922486, 'newchange', NULL, 'Изменён счёт №4 - предыдущий статус \"Ожидание оплаты\", текущий статус \"Ожидание оплаты\"'),
(49, 1501922486, 'newchange', NULL, 'Изменён счёт №4 - предыдущий статус \"Ожидание оплаты\", текущий статус \"Ожидание оплаты\"'),
(50, 1501960617, 'newchange', NULL, 'Изменён счёт №5 - предыдущий статус \"Ожидание оплаты\", текущий статус \"Ожидание оплаты\"'),
(51, 1501960617, 'newchange', NULL, 'Изменён счёт №5 - предыдущий статус \"Ожидание оплаты\", текущий статус \"Ожидание оплаты\"'),
(52, 1501961106, 'newpay', NULL, 'Получено оповещение о зачислении счёта #5 на сумму 59.40 платёжная система rur кошелёк R131677241266'),
(53, 1501961106, 'newchange', NULL, 'Изменён счёт №5 - предыдущий статус \"Ожидание оплаты\", текущий статус \"Оплачен и отправлен\"'),
(54, 1501961106, 'newchange', NULL, 'Изменён счёт №5 - предыдущий статус \"Ожидание оплаты\", текущий статус \"Оплачен и отправлен\"'),
(55, 1501961106, 'newclient', NULL, 'Добавлен новый клиент №3 для товара \"om2nulled\" \r\nИмя клиента: \"Али\"\r\nE-mail: hotc1@mail.ru\r\nСчёт: 0'),
(56, 1501961106, 'sendgood', NULL, 'Отправлен товар покупателю hotc1@mail.ru с именем \"Али\"\r\nТема письма: \"Али, Ваша ссылка для скачивания товара\"\r\nТекст письма: Здравствуйте, Али.\r\n\r\nВаша ссылка для скачивания продукта \"Скрипт Order Master 2 (nulled)\" с сервиса Облако.Mail.ru:\r\nhttps://cloud.mail.ru/public/Jbgv/gEQVPSGUf\r\n\r\nИмя файла: order_master2_nulled.rar\r\nРазмер файла 568 Мб\r\n\r\nПостарайтесь скачать этот файл в течение 3-х суток.\r\n\r\nВсего наилучшего.\r\n\r\n--\r\nПерсональный сайт Артура Абзалова\r\nhttp://rolar.ru/\r\n'),
(57, 1501961106, 'newchange', NULL, 'Изменён счёт №5 - предыдущий статус \"Ожидание оплаты\", текущий статус \"Оплачен и отправлен\"'),
(58, 1501961106, 'newchange', NULL, 'Изменён счёт №5 - предыдущий статус \"Ожидание оплаты\", текущий статус \"Оплачен и отправлен\"'),
(59, 1502088633, 'login', '1', 'Выполнен вход в админ-панель с логином admin IP-адрес 94.41.243.189'),
(60, 1502103789, 'newchange', NULL, 'Изменён счёт №6 - предыдущий статус \"Ожидание оплаты\", текущий статус \"Ожидание оплаты\"'),
(61, 1502103789, 'newchange', NULL, 'Изменён счёт №6 - предыдущий статус \"Ожидание оплаты\", текущий статус \"Ожидание оплаты\"'),
(62, 1502103836, 'newchange', NULL, 'Изменён счёт №6 - предыдущий статус \"Ожидание оплаты\", текущий статус \"Ожидание оплаты\"'),
(63, 1502103836, 'newchange', NULL, 'Изменён счёт №6 - предыдущий статус \"Ожидание оплаты\", текущий статус \"Ожидание оплаты\"'),
(64, 1502103860, 'newchange', NULL, 'Изменён счёт №6 - предыдущий статус \"Ожидание оплаты\", текущий статус \"Ожидание оплаты\"'),
(65, 1502103860, 'newchange', NULL, 'Изменён счёт №6 - предыдущий статус \"Ожидание оплаты\", текущий статус \"Ожидание оплаты\"'),
(66, 1502103875, 'newchange', NULL, 'Изменён счёт №6 - предыдущий статус \"Ожидание оплаты\", текущий статус \"Ожидание оплаты\"'),
(67, 1502103875, 'newchange', NULL, 'Изменён счёт №6 - предыдущий статус \"Ожидание оплаты\", текущий статус \"Ожидание оплаты\"'),
(68, 1502103881, 'newchange', NULL, 'Изменён счёт №6 - предыдущий статус \"Ожидание оплаты\", текущий статус \"Ожидание оплаты\"'),
(69, 1502103881, 'newchange', NULL, 'Изменён счёт №6 - предыдущий статус \"Ожидание оплаты\", текущий статус \"Ожидание оплаты\"'),
(70, 1502103899, 'newchange', NULL, 'Изменён счёт №6 - предыдущий статус \"Ожидание оплаты\", текущий статус \"Ожидание оплаты\"'),
(71, 1502103899, 'newchange', NULL, 'Изменён счёт №6 - предыдущий статус \"Ожидание оплаты\", текущий статус \"Ожидание оплаты\"'),
(72, 1502174168, 'newchange', NULL, 'Изменён счёт №7 - предыдущий статус \"Ожидание оплаты\", текущий статус \"Ожидание оплаты\"'),
(73, 1502174168, 'newchange', NULL, 'Изменён счёт №7 - предыдущий статус \"Ожидание оплаты\", текущий статус \"Ожидание оплаты\"'),
(74, 1502179242, 'newchange', NULL, 'Изменён счёт №8 - предыдущий статус \"Ожидание оплаты\", текущий статус \"Ожидание оплаты\"'),
(75, 1502179242, 'newchange', NULL, 'Изменён счёт №8 - предыдущий статус \"Ожидание оплаты\", текущий статус \"Ожидание оплаты\"'),
(76, 1502179786, 'newchange', NULL, 'Изменён счёт №9 - предыдущий статус \"Ожидание оплаты\", текущий статус \"Ожидание оплаты\"'),
(77, 1502179786, 'newchange', NULL, 'Изменён счёт №9 - предыдущий статус \"Ожидание оплаты\", текущий статус \"Ожидание оплаты\"'),
(78, 1502179820, 'newpay', NULL, 'Получено оповещение о зачислении счёта #9 на сумму 59.40 платёжная система rur кошелёк R953533350128'),
(79, 1502179820, 'newchange', NULL, 'Изменён счёт №9 - предыдущий статус \"Ожидание оплаты\", текущий статус \"Оплачен и отправлен\"'),
(80, 1502179820, 'newchange', NULL, 'Изменён счёт №9 - предыдущий статус \"Ожидание оплаты\", текущий статус \"Оплачен и отправлен\"'),
(81, 1502179820, 'newclient', NULL, 'Добавлен новый клиент №4 для товара \"om2nulled\" \r\nИмя клиента: \"Алексей\"\r\nE-mail: alekseyy-chimiris@ro.ru\r\nСчёт: 0'),
(82, 1502179820, 'sendgood', NULL, 'Отправлен товар покупателю alekseyy-chimiris@ro.ru с именем \"Алексей\"\r\nТема письма: \"Алексей, Ваша ссылка для скачивания товара\"\r\nТекст письма: Здравствуйте, Алексей.\r\n\r\nВаша ссылка для скачивания продукта \"Скрипт Order Master 2 (nulled)\" с сервиса Облако.Mail.ru:\r\nhttps://cloud.mail.ru/public/Jbgv/gEQVPSGUf\r\n\r\nИмя файла: order_master2_nulled.rar\r\nРазмер файла 568 Мб\r\n\r\nПостарайтесь скачать этот файл в течение 3-х суток.\r\n\r\nВсего наилучшего.\r\n\r\n--\r\nПерсональный сайт Артура Абзалова\r\nhttp://rolar.ru/\r\n'),
(83, 1502179820, 'newchange', NULL, 'Изменён счёт №9 - предыдущий статус \"Ожидание оплаты\", текущий статус \"Оплачен и отправлен\"'),
(84, 1502179820, 'newchange', NULL, 'Изменён счёт №9 - предыдущий статус \"Ожидание оплаты\", текущий статус \"Оплачен и отправлен\"'),
(85, 1502183402, 'newchange', NULL, 'Изменён счёт №4 - предыдущий статус \"Ожидание оплаты\", текущий статус \"Ожидание оплаты\"'),
(86, 1502221886, 'login', '1', 'Выполнен вход в админ-панель с логином admin IP-адрес 94.41.243.189'),
(87, 1502365802, 'newchange', NULL, 'Изменён счёт №6 - предыдущий статус \"Ожидание оплаты\", текущий статус \"Ожидание оплаты\"'),
(88, 1502433602, 'newchange', NULL, 'Изменён счёт №7 - предыдущий статус \"Ожидание оплаты\", текущий статус \"Ожидание оплаты\"'),
(89, 1502436693, 'newchange', NULL, 'Изменён счёт №7 - предыдущий статус \"Ожидание оплаты\", текущий статус \"Ожидание оплаты\"'),
(90, 1502436693, 'newchange', NULL, 'Изменён счёт №7 - предыдущий статус \"Ожидание оплаты\", текущий статус \"Ожидание оплаты\"'),
(91, 1502436711, 'newchange', NULL, 'Изменён счёт №7 - предыдущий статус \"Ожидание оплаты\", текущий статус \"Ожидание оплаты\"'),
(92, 1502436711, 'newchange', NULL, 'Изменён счёт №7 - предыдущий статус \"Ожидание оплаты\", текущий статус \"Ожидание оплаты\"'),
(93, 1502436729, 'newchange', NULL, 'Изменён счёт №7 - предыдущий статус \"Ожидание оплаты\", текущий статус \"Ожидание оплаты\"'),
(94, 1502436729, 'newchange', NULL, 'Изменён счёт №7 - предыдущий статус \"Ожидание оплаты\", текущий статус \"Ожидание оплаты\"'),
(95, 1502441402, 'newchange', NULL, 'Изменён счёт №8 - предыдущий статус \"Ожидание оплаты\", текущий статус \"Ожидание оплаты\"'),
(96, 1502479152, 'login', '1', 'Выполнен вход в админ-панель с логином admin IP-адрес 94.41.243.189'),
(97, 1502503343, 'newchange', NULL, 'Изменён счёт №10 - предыдущий статус \"Ожидание оплаты\", текущий статус \"Ожидание оплаты\"'),
(98, 1502503343, 'newchange', NULL, 'Изменён счёт №10 - предыдущий статус \"Ожидание оплаты\", текущий статус \"Ожидание оплаты\"'),
(99, 1502504095, 'newchange', NULL, 'Изменён счёт №11 - предыдущий статус \"Ожидание оплаты\", текущий статус \"Ожидание оплаты\"'),
(100, 1502504095, 'newchange', NULL, 'Изменён счёт №11 - предыдущий статус \"Ожидание оплаты\", текущий статус \"Ожидание оплаты\"'),
(101, 1502504123, 'newchange', NULL, 'Изменён счёт №11 - предыдущий статус \"Ожидание оплаты\", текущий статус \"Ожидание оплаты\"'),
(102, 1502504123, 'newchange', NULL, 'Изменён счёт №11 - предыдущий статус \"Ожидание оплаты\", текущий статус \"Ожидание оплаты\"'),
(103, 1502508900, 'newchange', NULL, 'Изменён счёт №12 - предыдущий статус \"Ожидание оплаты\", текущий статус \"Ожидание оплаты\"'),
(104, 1502508900, 'newchange', NULL, 'Изменён счёт №12 - предыдущий статус \"Ожидание оплаты\", текущий статус \"Ожидание оплаты\"'),
(105, 1502508964, 'newchange', NULL, 'Изменён счёт №12 - предыдущий статус \"Ожидание оплаты\", текущий статус \"Ожидание оплаты\"'),
(106, 1502508964, 'newchange', NULL, 'Изменён счёт №12 - предыдущий статус \"Ожидание оплаты\", текущий статус \"Ожидание оплаты\"'),
(107, 1502512079, 'newchange', NULL, 'Изменён счёт №13 - предыдущий статус \"Ожидание оплаты\", текущий статус \"Ожидание оплаты\"'),
(108, 1502512079, 'newchange', NULL, 'Изменён счёт №13 - предыдущий статус \"Ожидание оплаты\", текущий статус \"Ожидание оплаты\"'),
(109, 1502512182, 'newchange', NULL, 'Изменён счёт №13 - предыдущий статус \"Ожидание оплаты\", текущий статус \"Ожидание оплаты\"'),
(110, 1502512182, 'newchange', NULL, 'Изменён счёт №13 - предыдущий статус \"Ожидание оплаты\", текущий статус \"Ожидание оплаты\"'),
(111, 1502526120, 'newchange', NULL, 'Изменён счёт №14 - предыдущий статус \"Ожидание оплаты\", текущий статус \"Ожидание оплаты\"'),
(112, 1502526120, 'newchange', NULL, 'Изменён счёт №14 - предыдущий статус \"Ожидание оплаты\", текущий статус \"Ожидание оплаты\"'),
(113, 1502526156, 'newchange', NULL, 'Изменён счёт №14 - предыдущий статус \"Ожидание оплаты\", текущий статус \"Ожидание оплаты\"'),
(114, 1502526156, 'newchange', NULL, 'Изменён счёт №14 - предыдущий статус \"Ожидание оплаты\", текущий статус \"Ожидание оплаты\"'),
(115, 1502529166, 'newchange', NULL, 'Изменён счёт №14 - предыдущий статус \"Ожидание оплаты\", текущий статус \"Ожидание оплаты\"'),
(116, 1502529166, 'newchange', NULL, 'Изменён счёт №14 - предыдущий статус \"Ожидание оплаты\", текущий статус \"Ожидание оплаты\"'),
(117, 1502529430, 'newchange', NULL, 'Изменён счёт №14 - предыдущий статус \"Ожидание оплаты\", текущий статус \"Ожидание оплаты\"'),
(118, 1502529430, 'newchange', NULL, 'Изменён счёт №14 - предыдущий статус \"Ожидание оплаты\", текущий статус \"Ожидание оплаты\"'),
(119, 1502529472, 'newchange', NULL, 'Изменён счёт №14 - предыдущий статус \"Ожидание оплаты\", текущий статус \"Ожидание оплаты\"'),
(120, 1502529472, 'newchange', NULL, 'Изменён счёт №14 - предыдущий статус \"Ожидание оплаты\", текущий статус \"Ожидание оплаты\"'),
(121, 1502529508, 'newchange', NULL, 'Изменён счёт №14 - предыдущий статус \"Ожидание оплаты\", текущий статус \"Ожидание оплаты\"'),
(122, 1502529508, 'newchange', NULL, 'Изменён счёт №14 - предыдущий статус \"Ожидание оплаты\", текущий статус \"Ожидание оплаты\"'),
(123, 1502529547, 'newchange', NULL, 'Изменён счёт №14 - предыдущий статус \"Ожидание оплаты\", текущий статус \"Ожидание оплаты\"'),
(124, 1502529547, 'newchange', NULL, 'Изменён счёт №14 - предыдущий статус \"Ожидание оплаты\", текущий статус \"Ожидание оплаты\"'),
(125, 1502529666, 'newchange', NULL, 'Изменён счёт №14 - предыдущий статус \"Ожидание оплаты\", текущий статус \"Ожидание оплаты\"'),
(126, 1502529666, 'newchange', NULL, 'Изменён счёт №14 - предыдущий статус \"Ожидание оплаты\", текущий статус \"Ожидание оплаты\"'),
(127, 1502529706, 'newchange', NULL, 'Изменён счёт №14 - предыдущий статус \"Ожидание оплаты\", текущий статус \"Ожидание оплаты\"'),
(128, 1502529706, 'newchange', NULL, 'Изменён счёт №14 - предыдущий статус \"Ожидание оплаты\", текущий статус \"Ожидание оплаты\"'),
(129, 1502532497, 'newchange', NULL, 'Изменён счёт №14 - предыдущий статус \"Ожидание оплаты\", текущий статус \"Ожидание оплаты\"'),
(130, 1502532497, 'newchange', NULL, 'Изменён счёт №14 - предыдущий статус \"Ожидание оплаты\", текущий статус \"Ожидание оплаты\"'),
(131, 1502570100, 'newchange', NULL, 'Изменён счёт №15 - предыдущий статус \"Ожидание оплаты\", текущий статус \"Ожидание оплаты\"'),
(132, 1502570100, 'newchange', NULL, 'Изменён счёт №15 - предыдущий статус \"Ожидание оплаты\", текущий статус \"Ожидание оплаты\"'),
(133, 1502570180, 'newpay', NULL, 'Получено оповещение о зачислении счёта #15 на сумму 59.40 платёжная система rur кошелёк R347224163153'),
(134, 1502570180, 'newchange', NULL, 'Изменён счёт №15 - предыдущий статус \"Ожидание оплаты\", текущий статус \"Оплачен и отправлен\"'),
(135, 1502570180, 'newchange', NULL, 'Изменён счёт №15 - предыдущий статус \"Ожидание оплаты\", текущий статус \"Оплачен и отправлен\"'),
(136, 1502570180, 'newclient', NULL, 'Добавлен новый клиент №5 для товара \"om2nulled\" \r\nИмя клиента: \"andrey\"\r\nE-mail: horsekaper@gmail.com\r\nСчёт: 0'),
(137, 1502570181, 'sendgood', NULL, 'Отправлен товар покупателю horsekaper@gmail.com с именем \"andrey\"\r\nТема письма: \"andrey, Ваша ссылка для скачивания товара\"\r\nТекст письма: Здравствуйте, andrey.\r\n\r\nВаша ссылка для скачивания продукта \"Скрипт Order Master 2 (nulled)\" с сервиса Облако.Mail.ru:\r\nhttps://cloud.mail.ru/public/Jbgv/gEQVPSGUf\r\n\r\nИмя файла: order_master2_nulled.rar\r\nРазмер файла 568 Мб\r\n\r\nПостарайтесь скачать этот файл в течение 3-х суток.\r\n\r\nВсего наилучшего.\r\n\r\n--\r\nПерсональный сайт Артура Абзалова\r\nhttp://rolar.ru/\r\n'),
(138, 1502570181, 'newchange', NULL, 'Изменён счёт №15 - предыдущий статус \"Ожидание оплаты\", текущий статус \"Оплачен и отправлен\"'),
(139, 1502570181, 'newchange', NULL, 'Изменён счёт №15 - предыдущий статус \"Ожидание оплаты\", текущий статус \"Оплачен и отправлен\"'),
(140, 1502614311, 'login', '1', 'Выполнен вход в админ-панель с логином admin IP-адрес 94.41.243.189'),
(141, 1502616001, 'newchange', NULL, 'Изменён счёт №4 - предыдущий статус \"Ожидание оплаты\", текущий статус \"Ожидание оплаты\"'),
(142, 1502625582, 'login', '1', 'Выполнен вход в админ-панель с логином admin IP-адрес 94.41.243.189'),
(143, 1502632276, 'login', '1', 'Выполнен вход в админ-панель с логином admin IP-адрес 94.41.243.189'),
(144, 1502642673, 'login', '1', 'Выполнен вход в админ-панель с логином admin IP-адрес 94.41.243.189'),
(145, 1502730655, 'newchange', NULL, 'Изменён счёт №16 - предыдущий статус \"Ожидание оплаты\", текущий статус \"Ожидание оплаты\"'),
(146, 1502730655, 'newchange', NULL, 'Изменён счёт №16 - предыдущий статус \"Ожидание оплаты\", текущий статус \"Ожидание оплаты\"'),
(147, 1502732193, 'newchange', NULL, 'Изменён счёт №17 - предыдущий статус \"Ожидание оплаты\", текущий статус \"Ожидание оплаты\"'),
(148, 1502732193, 'newchange', NULL, 'Изменён счёт №17 - предыдущий статус \"Ожидание оплаты\", текущий статус \"Ожидание оплаты\"'),
(149, 1502732254, 'newchange', NULL, 'Изменён счёт №17 - предыдущий статус \"Ожидание оплаты\", текущий статус \"Ожидание оплаты\"'),
(150, 1502732254, 'newchange', NULL, 'Изменён счёт №17 - предыдущий статус \"Ожидание оплаты\", текущий статус \"Ожидание оплаты\"'),
(151, 1502764802, 'newchange', NULL, 'Изменён счёт №10 - предыдущий статус \"Ожидание оплаты\", текущий статус \"Ожидание оплаты\"'),
(152, 1502764802, 'newchange', NULL, 'Изменён счёт №11 - предыдущий статус \"Ожидание оплаты\", текущий статус \"Ожидание оплаты\"'),
(153, 1502768402, 'newchange', NULL, 'Изменён счёт №12 - предыдущий статус \"Ожидание оплаты\", текущий статус \"Ожидание оплаты\"'),
(154, 1502772602, 'newchange', NULL, 'Изменён счёт №13 - предыдущий статус \"Ожидание оплаты\", текущий статус \"Ожидание оплаты\"'),
(155, 1502788202, 'newchange', NULL, 'Изменён счёт №14 - предыдущий статус \"Ожидание оплаты\", текущий статус \"Ожидание оплаты\"'),
(156, 1502796001, 'newchange', NULL, 'Изменён счёт №6 - предыдущий статус \"Ожидание оплаты\", текущий статус \"Ожидание оплаты\"'),
(157, 1502801289, 'login', '1', 'Выполнен вход в админ-панель с логином admin IP-адрес 195.239.71.218'),
(158, 1502820062, 'newchange', NULL, 'Изменён счёт №6 - предыдущий статус \"Ожидание оплаты\", текущий статус \"Ожидание оплаты\"'),
(159, 1502820062, 'newchange', NULL, 'Изменён счёт №6 - предыдущий статус \"Ожидание оплаты\", текущий статус \"Ожидание оплаты\"'),
(160, 1502867895, 'login', '1', 'Выполнен вход в админ-панель с логином admin IP-адрес 94.41.243.189'),
(161, 1502868601, 'newchange', NULL, 'Изменён счёт №7 - предыдущий статус \"Ожидание оплаты\", текущий статус \"Ожидание оплаты\"'),
(162, 1502872201, 'newchange', NULL, 'Изменён счёт №8 - предыдущий статус \"Ожидание оплаты\", текущий статус \"Ожидание оплаты\"'),
(163, 1502904793, 'login', '1', 'Выполнен вход в админ-панель с логином admin IP-адрес 94.41.243.189'),
(164, 1502919257, 'login', '1', 'Выполнен вход в админ-панель с логином admin IP-адрес 94.41.243.189'),
(165, 1502992802, 'newchange', NULL, 'Изменён счёт №16 - предыдущий статус \"Ожидание оплаты\", текущий статус \"Ожидание оплаты\"'),
(166, 1502992802, 'newchange', NULL, 'Изменён счёт №17 - предыдущий статус \"Ожидание оплаты\", текущий статус \"Ожидание оплаты\"'),
(167, 1502993386, 'newchange', NULL, 'Изменён счёт №16 - предыдущий статус \"Ожидание оплаты\", текущий статус \"Ожидание оплаты\"'),
(168, 1502993386, 'newchange', NULL, 'Изменён счёт №16 - предыдущий статус \"Ожидание оплаты\", текущий статус \"Ожидание оплаты\"'),
(169, 1502998666, 'newchange', NULL, 'Изменён счёт №18 - предыдущий статус \"Ожидание оплаты\", текущий статус \"Ожидание оплаты\"'),
(170, 1502998666, 'newchange', NULL, 'Изменён счёт №18 - предыдущий статус \"Ожидание оплаты\", текущий статус \"Ожидание оплаты\"'),
(171, 1502998694, 'newchange', NULL, 'Изменён счёт №18 - предыдущий статус \"Ожидание оплаты\", текущий статус \"Ожидание оплаты\"'),
(172, 1502998694, 'newchange', NULL, 'Изменён счёт №18 - предыдущий статус \"Ожидание оплаты\", текущий статус \"Ожидание оплаты\"'),
(173, 1502999639, 'login', '1', 'Выполнен вход в админ-панель с логином admin IP-адрес 94.41.243.189'),
(174, 1503127097, 'login', '1', 'Выполнен вход в админ-панель с логином admin IP-адрес 195.239.71.218'),
(175, 1503129682, 'newchange', NULL, 'Изменён счёт №19 - предыдущий статус \"Ожидание оплаты\", текущий статус \"Ожидание оплаты\"'),
(176, 1503129682, 'newchange', NULL, 'Изменён счёт №19 - предыдущий статус \"Ожидание оплаты\", текущий статус \"Ожидание оплаты\"'),
(177, 1503129789, 'newpay', NULL, 'Получено оповещение о зачислении счёта #19 на сумму 59.40 платёжная система rur кошелёк R284275509452'),
(178, 1503129789, 'newchange', NULL, 'Изменён счёт №19 - предыдущий статус \"Ожидание оплаты\", текущий статус \"Оплачен и отправлен\"'),
(179, 1503129789, 'newchange', NULL, 'Изменён счёт №19 - предыдущий статус \"Ожидание оплаты\", текущий статус \"Оплачен и отправлен\"'),
(180, 1503129789, 'newclient', NULL, 'Добавлен новый клиент №6 для товара \"om2nulled\" \r\nИмя клиента: \"Николай\"\r\nE-mail: kilsvich@ukr.net\r\nСчёт: 0'),
(181, 1503129789, 'sendgood', NULL, 'Отправлен товар покупателю kilsvich@ukr.net с именем \"Николай\"\r\nТема письма: \"Николай, Ваша ссылка для скачивания товара\"\r\nТекст письма: Здравствуйте, Николай.\r\n\r\nВаша ссылка для скачивания продукта \"Скрипт Order Master 2 (nulled)\" с сервиса Облако.Mail.ru:\r\nhttps://cloud.mail.ru/public/Jbgv/gEQVPSGUf\r\n\r\nИмя файла: order_master2_nulled.rar\r\nРазмер файла 568 Мб\r\n\r\nПостарайтесь скачать этот файл в течение 3-х суток.\r\n\r\nВсего наилучшего.\r\n\r\n--\r\nПерсональный сайт Артура Абзалова\r\nhttp://rolar.ru/\r\n'),
(182, 1503129789, 'newchange', NULL, 'Изменён счёт №19 - предыдущий статус \"Ожидание оплаты\", текущий статус \"Оплачен и отправлен\"'),
(183, 1503129789, 'newchange', NULL, 'Изменён счёт №19 - предыдущий статус \"Ожидание оплаты\", текущий статус \"Оплачен и отправлен\"'),
(184, 1503137574, 'login', '1', 'Выполнен вход в админ-панель с логином admin IP-адрес 195.239.71.218'),
(185, 1503140819, 'newchange', NULL, 'Изменён счёт №20 - предыдущий статус \"Ожидание оплаты\", текущий статус \"Ожидание оплаты\"'),
(186, 1503140819, 'newchange', NULL, 'Изменён счёт №20 - предыдущий статус \"Ожидание оплаты\", текущий статус \"Ожидание оплаты\"'),
(187, 1503140916, 'newchange', NULL, 'Изменён счёт №20 - предыдущий статус \"Ожидание оплаты\", текущий статус \"Ожидание оплаты\"'),
(188, 1503140916, 'newchange', NULL, 'Изменён счёт №20 - предыдущий статус \"Ожидание оплаты\", текущий статус \"Ожидание оплаты\"'),
(189, 1503140922, 'newchange', NULL, 'Изменён счёт №20 - предыдущий статус \"Ожидание оплаты\", текущий статус \"Ожидание оплаты\"'),
(190, 1503140922, 'newchange', NULL, 'Изменён счёт №20 - предыдущий статус \"Ожидание оплаты\", текущий статус \"Ожидание оплаты\"'),
(191, 1503140933, 'newchange', NULL, 'Изменён счёт №20 - предыдущий статус \"Ожидание оплаты\", текущий статус \"Ожидание оплаты\"'),
(192, 1503140933, 'newchange', NULL, 'Изменён счёт №20 - предыдущий статус \"Ожидание оплаты\", текущий статус \"Ожидание оплаты\"'),
(193, 1503141032, 'newchange', NULL, 'Изменён счёт №20 - предыдущий статус \"Ожидание оплаты\", текущий статус \"Ожидание оплаты\"'),
(194, 1503141032, 'newchange', NULL, 'Изменён счёт №20 - предыдущий статус \"Ожидание оплаты\", текущий статус \"Ожидание оплаты\"'),
(195, 1503141045, 'newchange', NULL, 'Изменён счёт №20 - предыдущий статус \"Ожидание оплаты\", текущий статус \"Ожидание оплаты\"'),
(196, 1503141045, 'newchange', NULL, 'Изменён счёт №20 - предыдущий статус \"Ожидание оплаты\", текущий статус \"Ожидание оплаты\"'),
(197, 1503141070, 'newchange', NULL, 'Изменён счёт №20 - предыдущий статус \"Ожидание оплаты\", текущий статус \"Ожидание оплаты\"'),
(198, 1503141070, 'newchange', NULL, 'Изменён счёт №20 - предыдущий статус \"Ожидание оплаты\", текущий статус \"Ожидание оплаты\"'),
(199, 1503141194, 'newchange', NULL, 'Изменён счёт №20 - предыдущий статус \"Ожидание оплаты\", текущий статус \"Ожидание оплаты\"'),
(200, 1503141194, 'newchange', NULL, 'Изменён счёт №20 - предыдущий статус \"Ожидание оплаты\", текущий статус \"Ожидание оплаты\"'),
(201, 1503141252, 'newchange', NULL, 'Изменён счёт №20 - предыдущий статус \"Ожидание оплаты\", текущий статус \"Ожидание оплаты\"'),
(202, 1503141252, 'newchange', NULL, 'Изменён счёт №20 - предыдущий статус \"Ожидание оплаты\", текущий статус \"Ожидание оплаты\"'),
(203, 1503141266, 'newchange', NULL, 'Изменён счёт №20 - предыдущий статус \"Ожидание оплаты\", текущий статус \"Ожидание оплаты\"'),
(204, 1503141266, 'newchange', NULL, 'Изменён счёт №20 - предыдущий статус \"Ожидание оплаты\", текущий статус \"Ожидание оплаты\"'),
(205, 1503141348, 'newchange', NULL, 'Изменён счёт №20 - предыдущий статус \"Ожидание оплаты\", текущий статус \"Ожидание оплаты\"'),
(206, 1503141348, 'newchange', NULL, 'Изменён счёт №20 - предыдущий статус \"Ожидание оплаты\", текущий статус \"Ожидание оплаты\"'),
(207, 1503141523, 'newchange', NULL, 'Изменён счёт №20 - предыдущий статус \"Ожидание оплаты\", текущий статус \"Ожидание оплаты\"'),
(208, 1503141523, 'newchange', NULL, 'Изменён счёт №20 - предыдущий статус \"Ожидание оплаты\", текущий статус \"Ожидание оплаты\"'),
(209, 1503195001, 'newchange', NULL, 'Изменён счёт №10 - предыдущий статус \"Ожидание оплаты\", текущий статус \"Ожидание оплаты\"'),
(210, 1503198602, 'newchange', NULL, 'Изменён счёт №11 - предыдущий статус \"Ожидание оплаты\", текущий статус \"Ожидание оплаты\"'),
(211, 1503202802, 'newchange', NULL, 'Изменён счёт №12 - предыдущий статус \"Ожидание оплаты\", текущий статус \"Ожидание оплаты\"'),
(212, 1503206402, 'newchange', NULL, 'Изменён счёт №13 - предыдущий статус \"Ожидание оплаты\", текущий статус \"Ожидание оплаты\"'),
(213, 1503213476, 'login', '1', 'Выполнен вход в админ-панель с логином admin IP-адрес 94.41.243.189'),
(214, 1503218402, 'newchange', NULL, 'Изменён счёт №14 - предыдущий статус \"Ожидание оплаты\", текущий статус \"Ожидание оплаты\"'),
(215, 1503239866, 'login', '1', 'Выполнен вход в админ-панель с логином admin IP-адрес 94.41.243.189'),
(216, 1503260402, 'newchange', NULL, 'Изменён счёт №18 - предыдущий статус \"Ожидание оплаты\", текущий статус \"Ожидание оплаты\"'),
(217, 1503305548, 'login', '1', 'Выполнен вход в админ-панель с логином admin IP-адрес 94.41.243.189'),
(218, 1503322972, 'login', '1', 'Выполнен вход в админ-панель с логином admin IP-адрес 94.41.243.189'),
(219, 1503342446, 'login', '1', 'Выполнен вход в админ-панель с логином admin IP-адрес 94.41.243.189');

-- --------------------------------------------------------

--
-- Структура таблицы `om_lookup`
--

CREATE TABLE `om_lookup` (
  `id` int(11) NOT NULL,
  `name` varchar(128) NOT NULL,
  `code` varchar(100) NOT NULL,
  `type` varchar(128) NOT NULL,
  `position` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `om_lookup`
--

INSERT INTO `om_lookup` (`id`, `name`, `code`, `type`, `position`) VALUES
(1, 'Низкая', '1', 'TicketPriority', 1),
(2, 'Обычная', '2', 'TicketPriority', 2),
(3, 'Высокая', '3', 'TicketPriority', 3),
(4, 'Очень высокая', '4', 'TicketPriority', 4),
(5, 'Открыт', '1', 'TicketStatus', 1),
(6, 'Ждём ответ пользователя', '2', 'TicketStatus', 2),
(7, 'Закрыт', '3', 'TicketStatus', 3),
(8, '#000080', '1', 'TicketPColor', 1),
(9, '#000000', '2', 'TicketPColor', 2),
(10, '#FF6600', '3', 'TicketPColor', 3),
(11, '#CC0000', '4', 'TicketPColor', 4),
(12, '#00AA00', '1', 'TicketSColor', 1),
(13, '#6600FF', '2', 'TicketSColor', 2),
(14, '#440000', '3', 'TicketSColor', 3),
(15, 'Нет', '0', 'Visible', 1),
(16, 'Да', '1', 'Visible', 2),
(19, 'Первому партнёру', '0', 'AffType', 1),
(20, 'Последнему партнёру', '1', 'AffType', 2),
(21, 'Физический', 'disk', 'GoodKind', 2),
(22, 'Электронный', 'ebook', 'GoodKind', 1),
(23, 'Закрытая Зона', 'area', 'GoodKind', 3),
(24, 'Webmoney Z', 'wmz', 'Purse', 1),
(25, 'Webmoney R', 'wmr', 'Purse', 2),
(26, 'RBK Money', 'rbkmoney', 'Purse', 3),
(27, 'Яндекс.Деньги', 'yandex', 'Purse', 4),
(28, 'Z-Payment', 'zpayment', 'Purse', 5),
(29, 'Ожидание оплаты', 'waiting', 'Status', 0),
(30, 'Оплачен и отправлен', 'approved', 'Status', 0),
(31, 'Оплачен, но не отправлен', 'processing', 'Status', 0),
(32, 'Отправлен по предоплате', 'sent', 'Status', 0),
(33, 'Наложенный платёж - не подтверждён', 'nalozh', 'Status', 0),
(34, 'Наложенный платёж - ожидает отправки', 'nalozh_confirmed', 'Status', 0),
(35, 'Заказ наложенным платежом отправлен', 'nalozh_sent', 'Status', 0),
(36, 'Наложенный платёж получен', 'nalozh_ok', 'Status', 0),
(37, 'Возврат заказа', 'nalozh_back', 'Status', 0),
(38, 'Отменён', 'cancelled', 'Status', 0),
(40, 'В валюте товара', 'fixed', 'CuponKind', 1),
(41, 'В % от стоимости товара', 'perc', 'CuponKind', 2),
(42, 'Начислять', '1', 'CuponKomis', 1),
(43, 'Не начислять', '0', 'CuponKomis', 2),
(44, 'в валюте товара', 'fixed', 'KomisType', 1),
(45, 'в % от общей суммы (с учётом скидки)', 'perc', 'KomisType', 2),
(46, 'Рубли', 'rur', 'Valuta', 1),
(47, 'Доллары', 'usd', 'Valuta', 2),
(48, 'Евро', 'eur', 'Valuta', 3),
(49, 'Гривни', 'uah', 'Valuta', 4),
(50, 'Доллары', 'usd', 'Robox', 2),
(51, 'Рубли', 'rur', 'Robox', 1),
(52, 'Обычный текст', 'plain', 'Letter', 1),
(53, 'HTML-формат', 'html', 'Letter', 2),
(54, 'Выслан товар', 'sendgood', 'log', 1),
(55, 'Новый клиент', 'newclient', 'log', 2),
(56, 'Новый партнёр', 'newpartner', 'log', 3),
(57, 'Новый заказ', 'neworder', 'log', 4),
(58, 'Оповещение от платёжной системы', 'newpay', 'log', 5),
(59, 'Использован пин-код', 'pin', 'log', 6),
(60, 'Изменение статуса заказа', 'newchange', 'log', 7),
(61, 'Начисление партнёру', 'partner', 'log', 8),
(62, 'Начисление автору', 'author', 'log', 9),
(63, 'Выплачено партнёру', 'paypartner', 'log', 10),
(64, 'Выплачено автору', 'payauthor', 'log', 11),
(65, 'Новая рассылка в очереди', 'newrass', 'log', 12),
(66, 'Отправлены письма из очереди', 'sendmail', 'log', 13),
(67, 'Авторизация в админ-панели', 'login', 'log', 14),
(68, 'За оплаченный заказ', '0', 'KomisOrder', 0),
(69, 'За подтверждённый наложенный платёж', '1', 'KomisOrder', 1);

-- --------------------------------------------------------

--
-- Структура таблицы `om_odno`
--

CREATE TABLE `om_odno` (
  `id` int(11) NOT NULL,
  `good_id` varchar(100) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `dost` varchar(50) DEFAULT NULL,
  `phone` varchar(50) DEFAULT NULL,
  `price` int(11) DEFAULT NULL,
  `oldprice` int(11) DEFAULT NULL,
  `otz1` text,
  `otz2` text,
  `otz3` text,
  `otz4` text,
  `otz5` text,
  `otz6` text,
  `vkgroup` varchar(100) DEFAULT NULL,
  `footer` text,
  `video` varchar(255) DEFAULT NULL,
  `height` int(11) DEFAULT NULL,
  `width` int(11) DEFAULT NULL,
  `zag1` varchar(255) DEFAULT NULL,
  `content` text,
  `block1` varchar(255) DEFAULT NULL,
  `block1data` text,
  `block2` varchar(255) DEFAULT NULL,
  `block2data` text,
  `block3` varchar(255) DEFAULT NULL,
  `block3data` text,
  `preorder` varchar(255) DEFAULT NULL,
  `currency` varchar(40) DEFAULT NULL,
  `imgcount` int(11) DEFAULT NULL,
  `visible` tinyint(4) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `om_order`
--

CREATE TABLE `om_order` (
  `id` bigint(20) NOT NULL,
  `bill_id` bigint(20) NOT NULL,
  `good_id` varchar(255) NOT NULL,
  `createDate` int(11) NOT NULL,
  `cena` float NOT NULL,
  `valuta` varchar(255) NOT NULL,
  `partner_id` varchar(255) NOT NULL,
  `payDate` int(11) NOT NULL DEFAULT '0',
  `status_id` varchar(50) NOT NULL DEFAULT '',
  `country` varchar(255) NOT NULL,
  `kanal` varchar(255) NOT NULL DEFAULT 'default'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `om_order`
--

INSERT INTO `om_order` (`id`, `bill_id`, `good_id`, `createDate`, `cena`, `valuta`, `partner_id`, `payDate`, `status_id`, `country`, `kanal`) VALUES
(1, 1, 'om2nulled', 1499450305, 99, 'rur', '', 1499450380, 'approved', '', 'default'),
(2, 2, 'om2nulled', 1500255708, 99, 'rur', '', 0, 'waiting', '', 'default'),
(3, 3, 'om2nulled', 1501704713, 59.4, 'rur', '', 1501705020, 'approved', '', 'default'),
(4, 4, 'om2nulled', 1501922476, 59.4, 'rur', '', 0, 'waiting', '', 'default'),
(5, 5, 'om2nulled', 1501960595, 59.4, 'rur', '', 1501961106, 'approved', '', 'default'),
(6, 6, 'om2nulled', 1502103706, 99, 'rur', '', 0, 'waiting', '', 'default'),
(7, 7, 'om2nulled', 1502174157, 59.4, 'rur', '', 0, 'waiting', '', 'default'),
(8, 8, 'om2nulled', 1502179231, 59.4, 'rur', '', 0, 'waiting', '', 'default'),
(9, 9, 'om2nulled', 1502179781, 59.4, 'rur', '', 1502179820, 'approved', '', 'default'),
(10, 10, 'om2nulled', 1502503312, 99, 'rur', '', 0, 'waiting', '', 'default'),
(11, 11, 'om2nulled', 1502504050, 59.4, 'rur', '', 0, 'waiting', '', 'default'),
(12, 12, 'om2nulled', 1502508864, 99, 'rur', '', 0, 'waiting', '', 'default'),
(13, 13, 'om2nulled', 1502511997, 99, 'rur', '', 0, 'waiting', '', 'default'),
(14, 14, 'om2nulled', 1502526063, 99, 'rur', '', 0, 'waiting', '', 'default'),
(15, 15, 'om2nulled', 1502570093, 59.4, 'rur', '', 1502570180, 'approved', '', 'default'),
(16, 16, 'om2nulled', 1502730588, 99, 'rur', '', 0, 'waiting', '', 'default'),
(17, 17, 'soft1', 1502732171, 275, 'rur', '', 0, 'waiting', '', 'default'),
(18, 18, 'soft1', 1502998054, 275, 'rur', '', 0, 'waiting', '', 'default'),
(19, 19, 'om2nulled', 1503129635, 59.4, 'rur', '', 1503129789, 'approved', '', 'default'),
(20, 20, 'om2nulled', 1503140642, 59.4, 'rur', '', 0, 'waiting', '', 'default'),
(21, 21, 'om2nulled', 1503347676, 99, 'rur', '', 0, 'waiting', '', 'default'),
(22, 22, 'realadwords', 1514407115, 475, 'rur', '', 0, 'waiting', '', 'default'),
(23, 23, 'realdirect', 1514408541, 475, 'rur', '', 0, 'waiting', '', 'default'),
(24, 24, 'om2nulled', 1516773871, 99, 'rur', '', 0, 'waiting', '', 'default'),
(25, 25, 'secret', 1516788613, 1, 'rur', '', 0, 'waiting', '', 'default'),
(26, 26, 'secret', 1532180916, 1, 'rur', '', 0, 'waiting', '', 'default'),
(27, 27, 'om2nulled', 1532198732, 99, 'rur', '', 0, 'waiting', '', 'default'),
(28, 28, 'secret', 1532242697, 1, 'rur', '', 0, 'waiting', '', 'default'),
(29, 29, 'cisco', 1544542739, 1753, 'rur', '', 0, 'waiting', '', 'default');

-- --------------------------------------------------------

--
-- Структура таблицы `om_page`
--

CREATE TABLE `om_page` (
  `id` int(11) NOT NULL,
  `psevdo` varchar(100) NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `visible` tinyint(4) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `om_partner`
--

CREATE TABLE `om_partner` (
  `id` varchar(100) NOT NULL,
  `firstName` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(100) NOT NULL,
  `wmz` varchar(13) NOT NULL,
  `wmr` varchar(13) NOT NULL,
  `rbkmoney` varchar(100) NOT NULL DEFAULT '',
  `yandex` varchar(20) NOT NULL,
  `zpayment` varchar(14) NOT NULL,
  `country` varchar(255) NOT NULL,
  `maillist` varchar(30) NOT NULL,
  `from` varchar(255) NOT NULL,
  `parent_id` varchar(100) NOT NULL,
  `createTime` int(11) NOT NULL,
  `trusted` tinyint(4) NOT NULL,
  `city` varchar(255) NOT NULL,
  `url` varchar(255) NOT NULL,
  `aboutProject` varchar(255) NOT NULL,
  `total` float NOT NULL,
  `paid` float NOT NULL,
  `updateTime` int(11) NOT NULL,
  `ip` varchar(100) NOT NULL,
  `sub` tinyint(4) NOT NULL DEFAULT '1',
  `way` varchar(255) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `om_partner`
--

INSERT INTO `om_partner` (`id`, `firstName`, `email`, `password`, `wmz`, `wmr`, `rbkmoney`, `yandex`, `zpayment`, `country`, `maillist`, `from`, `parent_id`, `createTime`, `trusted`, `city`, `url`, `aboutProject`, `total`, `paid`, `updateTime`, `ip`, `sub`, `way`) VALUES
('rolar', 'Артур', 'rolar@list.ru', 'rolar&AAV', '', 'R121012546658', '', '', '', '', '', '', '', 1467660132, 1, 'Ufa', 'http://rolar.ru', '', 0, 0, 1467660132, '127.0.0.1', 1, ''),
('elina', 'Elina', 'yelf-a.com@mail.ru', '1107982', '', 'R409046948335', '', '', '', '', '', '', '', 1467660132, 1, 'Ufa', 'http://elz-art.ru', '', 0, 0, 1467660132, '89.189.145.22', 1, '');

-- --------------------------------------------------------

--
-- Структура таблицы `om_partner_auto`
--

CREATE TABLE `om_partner_auto` (
  `id` int(11) NOT NULL,
  `good_id` varchar(255) NOT NULL,
  `count` float NOT NULL,
  `komis` int(11) NOT NULL,
  `komis_type` varchar(5) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `om_partner_personal`
--

CREATE TABLE `om_partner_personal` (
  `id` int(11) NOT NULL,
  `partner_id` varchar(255) NOT NULL,
  `good_id` varchar(255) NOT NULL,
  `komis` float NOT NULL,
  `komis_type_id` varchar(5) NOT NULL,
  `auto` tinyint(4) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `om_payout`
--

CREATE TABLE `om_payout` (
  `id` int(11) NOT NULL,
  `kind` varchar(10) DEFAULT NULL,
  `date` int(11) DEFAULT NULL,
  `theid` varchar(255) DEFAULT NULL,
  `way` varchar(255) DEFAULT NULL,
  `sum` float DEFAULT NULL,
  `valuta` varchar(10) DEFAULT NULL,
  `rekv` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `om_pin`
--

CREATE TABLE `om_pin` (
  `id` bigint(20) NOT NULL,
  `added` varchar(255) DEFAULT NULL,
  `pincat_id` int(11) NOT NULL,
  `code` text,
  `used` tinyint(4) NOT NULL DEFAULT '0',
  `email` varchar(255) DEFAULT NULL,
  `good_id` varchar(100) DEFAULT NULL,
  `client_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `om_pincat`
--

CREATE TABLE `om_pincat` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `comment` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `om_plink`
--

CREATE TABLE `om_plink` (
  `id` varchar(255) NOT NULL,
  `plink` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `om_queue`
--

CREATE TABLE `om_queue` (
  `id` bigint(20) NOT NULL,
  `email` varchar(255) NOT NULL,
  `format` varchar(10) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `body` text NOT NULL,
  `priority` tinyint(4) DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `om_rass`
--

CREATE TABLE `om_rass` (
  `id` int(11) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `good_id` varchar(100) DEFAULT NULL,
  `active` tinyint(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `om_rass_letter`
--

CREATE TABLE `om_rass_letter` (
  `id` int(11) NOT NULL,
  `rass_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `hours` int(11) NOT NULL,
  `comment` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `om_rass_sub`
--

CREATE TABLE `om_rass_sub` (
  `id` bigint(20) NOT NULL,
  `rass_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `letter_id` int(11) NOT NULL,
  `date` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `om_rass_user`
--

CREATE TABLE `om_rass_user` (
  `id` int(11) NOT NULL,
  `rass_id` int(11) NOT NULL,
  `uname` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `sub` tinyint(4) NOT NULL DEFAULT '1',
  `date` int(11) DEFAULT NULL,
  `unsubdate` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `om_s`
--

CREATE TABLE `om_s` (
  `id` bigint(20) NOT NULL,
  `date` int(11) DEFAULT NULL,
  `sb` varchar(100) DEFAULT NULL,
  `clicks` bigint(20) DEFAULT NULL,
  `p_id` varchar(100) DEFAULT NULL,
  `good_id` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `om_s`
--

INSERT INTO `om_s` (`id`, `date`, `sb`, `clicks`, `p_id`, `good_id`) VALUES
(1, 20170820, 'default', 1, 'rolar', 'soft2'),
(2, 20170821, 'default', 1, 'rolar', 'om2nulled');

-- --------------------------------------------------------

--
-- Структура таблицы `om_session`
--

CREATE TABLE `om_session` (
  `id` char(32) NOT NULL,
  `expire` int(11) DEFAULT NULL,
  `data` text
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `om_session`
--

INSERT INTO `om_session` (`id`, `expire`, `data`) VALUES
('obqc78eq7emt0vk2g02dvdfr66', 1598989405, '');

-- --------------------------------------------------------

--
-- Структура таблицы `om_settings`
--

CREATE TABLE `om_settings` (
  `id` varchar(255) NOT NULL,
  `value` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `om_settings`
--

INSERT INTO `om_settings` (`id`, `value`) VALUES
('adminAffPerPage', '25'),
('adminEmail', 'admin@rolar.ru'),
('adminName', 'Артур'),
('adminPage', '30'),
('adminPgAd', '30'),
('adminPgAffnew', '30'),
('adminPgAreaFile', '30'),
('adminPgAreaUser', '30'),
('adminPgBill', '30'),
('adminPgClick', '50'),
('adminPgClient', '30'),
('adminPgCupon', '30'),
('adminPgGood', '30'),
('adminPgOrder', '30'),
('adminPgPayout', '30'),
('affAbout', '0'),
('affAllTrusted', '0'),
('affCity', '1'),
('affCountry', '0'),
('affFrom', '0'),
('affIp', '1'),
('affLast', '1'),
('affLink', ''),
('affMaillist', '0'),
('affMin', '10'),
('affNewsOn', '1'),
('affRbk', '0'),
('affShared', '1'),
('affUrl', '1'),
('affWmr', '1'),
('affWmz', '0'),
('affYandex', '0'),
('affZpayment', '0'),
('anewPerPage', '3'),
('areaPerPage', '20'),
('catalogOn', '1'),
('catalogPerPage', '5'),
('checkBlack', '1'),
('copyEmail', ''),
('cronKurs', '1503345602'),
('cronKursRate', '1440'),
('cronLast', '1503346802'),
('cronNotify', '1503343801'),
('cronRass', '1503346202'),
('cronWord', ''),
('crossLimit', '20'),
('dv', 'rur'),
('firstWay', '0'),
('kursAuto', '1'),
('kursAutoMul', '1.03'),
('kursEur', '71.51'),
('kursUah', '2.39'),
('kursUsd', '60.92'),
('logauthor', '1'),
('loglogin', '1'),
('logon', '1'),
('lognewchange', '1'),
('lognewclient', '1'),
('lognewpartner', '1'),
('lognewpay', '1'),
('logneworder', '1'),
('lognewrass', '1'),
('logpartner', '1'),
('logpayauthor', '1'),
('logpaypartner', '1'),
('logpin', '1'),
('logsendgood', '1'),
('logsendmail', '1'),
('mailHost', 'smtp.beget.com'),
('mailInterval', '20'),
('mailLimit', '50'),
('mailPassword', '324shOOPe'),
('mailPort', '2525'),
('mailType', 'phpmailer'),
('mailUsername', 'info@rolar.ru'),
('mobile', ''),
('nalozhCountries', 'Россия,Украина,Беларусь,Казахстан'),
('nalozhEmail', '1'),
('nalozhManual', '1'),
('notifyFirst', '3'),
('notifyInterval', '60'),
('notifyLimit', '10'),
('notifyOn', '1'),
('notifySecond', '8'),
('pay2checkoutId', '102945013'),
('pay2checkoutKey', 'YTkxZGVmZDktN2ZkMC00NjJjLWIyOWYtNGQxMDAwZjNjZTkz'),
('pay2checkoutOn', '0'),
('payInterkassaId', '576a6f763c1eafc55c8b4567'),
('payInterkassaKey', 'bWNI2SmLM2EUklFM'),
('payInterkassaOn', '1'),
('payLiqpayId', 'i41239661553'),
('payLiqpayKey', 'CKTWoOS3rcvheTDtJAPpgH1J1XDa1zSfOI0mqqhk'),
('payLiqpayOn', '1'),
('payLiqpayPhone', '79872504631'),
('payOnpayId', 'rolar_ru'),
('payOnpayKey', '5OXPW617TYV'),
('payOnpayOn', '0'),
('payPayeerId', '191033119'),
('payPayeerKey', 'Kd3s6kpE2dsYnc0XhG'),
('payPayeerOn', '1'),
('payPayonlineId', ''),
('payPayonlineKey', ''),
('payPayonlineOn', '0'),
('payPaypalEmail', 'rolar@list.ru'),
('payPaypalKey', 'fsockopen'),
('payPaypalOn', '0'),
('payPosId', ''),
('payPosKey', ''),
('payPosOn', ''),
('payQiwiId', ''),
('payQiwiOn', '0'),
('payQiwiPass', ''),
('payRbkmoneyId', ''),
('payRbkmoneyKey', ''),
('payRbkmoneyOn', '0'),
('payRoboxLogin', 'rolaraav'),
('payRoboxOn', '1'),
('payRoboxPass1', 'C7yHk9kZwP7DjtTH4n7R'),
('payRoboxPass2', 'IP4zzypow3zvy0G3Je6A'),
('payRoboxValuta', 'rur'),
('paySmsCost', '1'),
('paySmsId', '20246'),
('paySmsKey', 'Gks4Ew9a7'),
('paySmsOn', '1'),
('paySmsUrl', 'http://bank.smscoin.com/language/russian/bank/'),
('paySprypayId', '224494'),
('paySprypayKey', 'beee398e623b4eb80e3eed09f2a0c457'),
('paySprypayOn', '1'),
('payW1Id', ''),
('payW1Key', ''),
('payW1On', '0'),
('payWebmoneyKey', 'Gw73fHx2'),
('payWebmoneyOn', '1'),
('payWme', 'E262191568884'),
('payWmr', 'R121012546658'),
('payWmu', 'U313293774166'),
('payWmz', 'Z402751813120'),
('payYandexAccount', '410011123840928'),
('payYandexKey', 'eOWqbAJK2ehk1YMpIr9ljBS8'),
('payYandexOn', '1'),
('payZpaymentId', '20514'),
('payZpaymentKey', 'mLBqSx7TykxeZ4yP3JN527JFhNIDp1k5'),
('payZpaymentOn', '1'),
('phoneDisk', '1'),
('phoneEbook', '0'),
('securebookUrl', 'http://rolar.ru/sbkey/request.php?email=*email*&alias=*id*&pass=мой_ключ&licenseCount=1'),
('siteName', 'Персональный сайт Артура Абзалова'),
('siteUrl', 'http://rolar.ru/'),
('staffAutoClose', '1'),
('staffBaseCategoryPage', '20'),
('staffBaseOn', '1'),
('staffBasePagination', '30'),
('staffFullAccess', '1'),
('staffOn', '1'),
('staffPagination', '30'),
('staffReverse', '1'),
('staffUploadExt', 'bmp, gif, jpg, jpeg, png, zip, rar, csv, doc, docx, xls, xlsx, ppt, pps, txt, rtf, pdf, djv, djvu, psd'),
('staffUploadMax', '10240'),
('staffUploadOn', '1'),
('supportLetter', '0'),
('sysEmail', 'info@rolar.ru'),
('usualCartOn', '1'),
('payYandexkassaOn', '0'),
('payYandexkassaShopId', ''),
('payYandexkassaShopPassword', ''),
('payYandexkassaScId', '');

-- --------------------------------------------------------

--
-- Структура таблицы `om_shorten`
--

CREATE TABLE `om_shorten` (
  `id` bigint(20) NOT NULL,
  `partner_id` varchar(100) NOT NULL,
  `description` varchar(50) NOT NULL,
  `url` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `om_special`
--

CREATE TABLE `om_special` (
  `id` int(11) NOT NULL,
  `good_id` varchar(100) DEFAULT NULL,
  `newgood_id` varchar(100) DEFAULT NULL,
  `sum` float DEFAULT NULL,
  `valuta` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `om_special`
--

INSERT INTO `om_special` (`id`, `good_id`, `newgood_id`, `sum`, `valuta`) VALUES
(1, 'comp', 'soft1', 150, 'rur'),
(2, 'comp', 'soft2', 200, 'rur'),
(3, 'soft2', 'soft1', 150, 'rur'),
(4, 'soft1', 'soft2', 200, 'rur');

-- --------------------------------------------------------

--
-- Структура таблицы `om_staff`
--

CREATE TABLE `om_staff` (
  `id` int(11) NOT NULL,
  `firstName` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `lastLogin` int(11) NOT NULL DEFAULT '0',
  `lastLoginIp` varchar(100) NOT NULL DEFAULT '127.0.0.1'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `om_staff`
--

INSERT INTO `om_staff` (`id`, `firstName`, `email`, `username`, `password`, `lastLogin`, `lastLoginIp`) VALUES
(1, 'Артур', 'admin@rolar.ru', 'admin', '5dfcb88fff38ca10abecedbf1b389afb', 1544546012, '127.0.0.1');

-- --------------------------------------------------------

--
-- Структура таблицы `om_staff_access`
--

CREATE TABLE `om_staff_access` (
  `id` int(11) NOT NULL,
  `bill` varchar(255) NOT NULL,
  `order` varchar(255) NOT NULL,
  `partner` varchar(255) NOT NULL,
  `client` varchar(255) NOT NULL,
  `ad` varchar(255) NOT NULL,
  `black` varchar(255) NOT NULL,
  `area` varchar(255) NOT NULL,
  `area_files` varchar(255) NOT NULL,
  `payout` varchar(255) NOT NULL,
  `support` varchar(255) NOT NULL,
  `cupon` varchar(255) NOT NULL,
  `affnew` varchar(255) NOT NULL,
  `rass` varchar(255) NOT NULL,
  `country` varchar(255) NOT NULL,
  `departaments` varchar(255) NOT NULL,
  `stat` varchar(255) NOT NULL,
  `good` varchar(255) NOT NULL,
  `category` varchar(255) NOT NULL,
  `main` varchar(255) NOT NULL,
  `knowbase` varchar(255) NOT NULL,
  `form` varchar(255) NOT NULL,
  `log` varchar(255) NOT NULL,
  `odno` varchar(255) NOT NULL,
  `pages` varchar(255) NOT NULL,
  `payhistory` varchar(255) NOT NULL,
  `pincat` varchar(255) NOT NULL,
  `pin` varchar(255) NOT NULL,
  `special` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `om_staff_access`
--

INSERT INTO `om_staff_access` (`id`, `bill`, `order`, `partner`, `client`, `ad`, `black`, `area`, `area_files`, `payout`, `support`, `cupon`, `affnew`, `rass`, `country`, `departaments`, `stat`, `good`, `category`, `main`, `knowbase`, `form`, `log`, `odno`, `pages`, `payhistory`, `pincat`, `pin`, `special`) VALUES
(0, 'index,view', 'index', '', 'index,view', '', 'index,view,create,delete', '', '', '', 'index,tickets,view,update', '', '', '', 'Россия,Украина', '', '', '', '', '', '', '', '', '', '', '', '', '', '');

-- --------------------------------------------------------

--
-- Структура таблицы `om_ticket`
--

CREATE TABLE `om_ticket` (
  `id` varchar(15) NOT NULL,
  `section_id` int(11) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `firstName` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `priority_id` int(11) NOT NULL,
  `status_id` int(11) NOT NULL,
  `createTime` int(11) NOT NULL,
  `staff_id` int(11) NOT NULL,
  `ip` varchar(50) NOT NULL,
  `file1` varchar(255) NOT NULL,
  `file2` varchar(255) NOT NULL,
  `file3` varchar(255) NOT NULL,
  `file4` varchar(255) NOT NULL,
  `updateTime` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `om_ticket`
--

INSERT INTO `om_ticket` (`id`, `section_id`, `subject`, `message`, `firstName`, `email`, `priority_id`, `status_id`, `createTime`, `staff_id`, `ip`, `file1`, `file2`, `file3`, `file4`, `updateTime`) VALUES
('57qt81tmnhz7', 1, 'Настройка скрипта Order Master 2.', 'Скрипт работает нормально но в панели для автора\r\nнету раздела ТОВАРЫ ', 'Алексей', 'alekseyy-chimiris@ro.ru', 4, 1, 1502655022, 1, '77.122.216.10', '3UWY8zcyXoUCnCQWNYYtWBBuBxtCMS6efYqSS1dm18Qsb16QxZtQWquYqkw62XuG.jpg', '3f3YoylhqhjKPwLSadbnPa3r3ZaRQPueLAmiHAHSOh7nedGFn1FhCpsU1xRAMuSu.jpg', '', '', 1502732124),
('boct43jys634', 1, 'Не смог оплатить товар', 'Здравствуйте.\r\nХотел оплатить товар - Order Master 2 nulled.\r\nперешёл на форму оплаты, выбрал способ - Яндекс.Деньги. Но ни один способ:\r\n1 Яндекс.Деньгами\r\n2 Банковской картой VISA/MasterCard\r\nне сработал.\r\nПолучается что скрипт не работает, или у вас не настроен. Получаете ли вы оплату через этот нулед скрипт?\r\nХотел уже было приобрести, а тут такие грабли.', 'Руслан', 'amirus@mail.ru', 2, 1, 1503141761, 1, '151.249.147.117', 'bAPSvCa2CM3SbE9lqrIsQ6f7AppTbC3SB1pCZBcU5MxekicLo3lLFWdt86Zfc9sk.jpg', '', '', '', 1503141761),
('5jj4n82c3zkb', 1, 'Не заходит в админку!', 'Здравствуйте. Приобрел у Вас скрипт Order Master 2 19.08.2017 на e-mail kilsvich@ukr.net, при установке вышла ошибка 500 но при возврате назад всё нормально, пишет \"Скрипт уже установлен или что то того\" при заходе в админку и вводе Логина: admin и Пароля: pass пишет опять ошибку только другая (обе связаны с таблицей) скриншот приложен только к одной (к админке). Помогите решить эту проблему. Использую VPS на hyperhost.ua!', 'Николай', 'kilsvich@ukr.net', 4, 3, 1503168835, 1, '178.62.249.240', 'iLCqneVziBCAwg1NQs8XG7mLcqvrGxrcCP8DmTaOOc4eidaVuVqTnaEn7SFpabFF.png', '', '', '', 1503179158);

-- --------------------------------------------------------

--
-- Структура таблицы `om_ticket_answer`
--

CREATE TABLE `om_ticket_answer` (
  `id` bigint(20) NOT NULL,
  `ticket_id` varchar(255) NOT NULL,
  `kind` varchar(5) NOT NULL,
  `staff_id` int(11) NOT NULL,
  `message` text NOT NULL,
  `updateTime` int(11) NOT NULL,
  `ip` varchar(50) NOT NULL,
  `file1` varchar(255) NOT NULL,
  `file2` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `om_ticket_answer`
--

INSERT INTO `om_ticket_answer` (`id`, `ticket_id`, `kind`, `staff_id`, `message`, `updateTime`, `ip`, `file1`, `file2`) VALUES
(1, '57qt81tmnhz7', 'you', 1, 'Соответственно автор не может добавить свой товар.Нужно решыть данную проблему.', 1502732124, '77.122.216.10', '', ''),
(2, '5jj4n82c3zkb', 'you', 1, 'Уже всё решил, извините.', 1503179158, '109.236.90.92', '', '');

-- --------------------------------------------------------

--
-- Структура таблицы `om_ticket_section`
--

CREATE TABLE `om_ticket_section` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `default_staff_id` int(11) NOT NULL,
  `position` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `om_ticket_section`
--

INSERT INTO `om_ticket_section` (`id`, `title`, `default_staff_id`, `position`) VALUES
(1, 'Основной', 1, 1);

-- --------------------------------------------------------

--
-- Структура таблицы `om_way`
--

CREATE TABLE `om_way` (
  `way_id` varchar(100) NOT NULL DEFAULT '',
  `title` varchar(255) DEFAULT NULL,
  `code` text
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `om_way`
--

INSERT INTO `om_way` (`way_id`, `title`, `code`) VALUES
('cardm', 'Карта VISA (вручную)', '<h4>Перевод на карту VISA (вручную)</h4>\r\n<div class=\"payimg\"><img src=\"{bu}images/front/bill/checkout.jpg\"></div><br>\r\n<div>Распечатайте реквизиты для перевода на счёт карты VISA через Сбербанк:</div>\r\n<script language=\"javascript\">\r\n$(function(){\r\n    $(\'#print_button\').click(function(){\r\n        var html_to_print=$(\'#to_print\').html();\r\n        var iframe=$(\'<iframe id=\"print_frame\">\');\r\n        $(\'body\').append(iframe);\r\n        var doc = $(\'#print_frame\')[0].contentDocument || $(\'#print_frame\')[0].contentWindow.document;\r\n        var win = $(\'#print_frame\')[0].contentWindow || $(\'#print_frame\')[0];\r\n        doc.getElementsByTagName(\'body\')[0].innerHTML=html_to_print;\r\n        win.print();\r\n        $(\'iframe\').remove();\r\n    });\r\n});\r\n</script>\r\n<style type=\"text/css\">\r\ntable#print {\r\n    width: 500px;\r\n}\r\n#print_button {\r\n    text-align: center;\r\n    text-decoration: underline;\r\n    cursor: pointer;\r\n}\r\n#print_frame{\r\n    display: none;\r\n}\r\n</style>\r\n<div id=\"to_print\">\r\n<table border=\"1\" cellpadding=\"0\" cellspacing=\"0\" id=\"print\">\r\n  <tr>\r\n    <td>Получатель<font color=\"#ff0000\">*</font>:</td>\r\n    <td><strong>Абзалов Артур Венерович</strong></td>\r\n  </tr>\r\n  <tr>\r\n    <td>Номер счёта<font color=\"#ff0000\">*</font>:</td>\r\n    <td><strong>40817810006000655224</strong></td>\r\n  </tr>\r\n  <tr>\r\n    <td>ИНН:</td>\r\n    <td><strong>027314391400</strong></td>\r\n  </tr>\r\n  <tr>\r\n    <td>Адрес:</td>\r\n    <td><strong>450069, Россия, г. Уфа, ул. Мелеузовская, д. 15, кв. 79</strong></td>\r\n  </tr>\r\n  <tr>\r\n    <td>Наименование банка получателя<font color=\"#ff0000\">*</font>:</td>\r\n    <td><strong>БАШКИРСКОЕ ОТДЕЛЕНИЕ N8598 ПАО СБЕРБАНК Г.УФА</strong></td>\r\n  </tr>\r\n  <tr>\r\n    <td>БИК<font color=\"#ff0000\">*</font>:</td>\r\n    <td><strong>048073601</strong></td>\r\n  </tr>\r\n  <tr>\r\n    <td>Корреспондентский счёт:</td>\r\n    <td><strong>30101810300000000601</strong></td>\r\n  </tr>\r\n  <tr>\r\n    <td>КПП:</td>\r\n    <td><strong>027802001</strong></td>\r\n  </tr>\r\n  <tr>\r\n    <td>ИНН:</td>\r\n    <td><strong>7707083893</strong></td>\r\n  </tr>\r\n  <tr>\r\n    <td>ОКПО:</td>\r\n    <td><strong>09105901</strong></td>\r\n  </tr>\r\n  <tr>\r\n    <td>ОГРН:</td>\r\n    <td><strong>1027700132195</strong></td>\r\n  </tr>\r\n  <tr>\r\n    <td>Юридический адрес банка:</td>\r\n    <td><strong>117997, МОСКВА, УЛ.ВАВИЛОВА,19</strong></td>\r\n  </tr>\r\n  <tr>\r\n    <td>Почтовый адрес банка:</td>\r\n    <td><strong>450059, УФА, ул. Р. Зорге, 5</strong></td>\r\n  </tr>\r\n  <tr>\r\n    <td>Почтовый адрес доп. офиса:</td>\r\n    <td><strong>г.Уфа, ул.Карла Маркса, д.25 ,450077</strong></td>\r\n  </tr>\r\n  <tr>\r\n    <td>Сумма платежа<font color=\"#ff0000\">*</font>:</td>\r\n    <td><strong>{rur} руб.</strong></td>\r\n  </tr>\r\n    <td>Назначение платежа<font color=\"#ff0000\">*</font>:</td>\r\n    <td><strong>Оплата услуг согласно СФ&nbsp;№{bill_id} от {date} без НДС</strong></td>\r\n  </tr>\r\n</table>\r\n<div><font color=\"#ff0000\">*</font> помечены обязательные поля.</div><br>\r\n</div>\r\n<div id=\"print_button\" title=\"Распечатать реквизиты\">Распечатать реквизиты</div><br>\r\n<div>Для совершения операций со счётом карты необходимо указать Вашу фамилию, имя, отчество полностью.</div><br>\r\n<div>По распечатанным реквизитам переведите {rur} руб. на счёт карты VISA через любой банк.</div><br>\r\n<div>После завершения оплаты перейдите по <a href=\"{notify_link}\" style=\"text-decoration: underline;\" target=\"_blank\" title=\"Уведомление об оплате счёта\">этой ссылке</a>, заполните форму и отправьте уведомление об оплате Администратору.</div>'),
('checkout', '2CheckOut', '<h4>Оплата кредитными картами (2CheckOut)</h4>\r\n<div class=\"payimg\"><img src=\"{bu}images/front/bill/checkout.jpg\"></div><br>\r\n<div>Чтобы перейти на сайт 2CO для оплаты кредитными картами или PayPal, нажмите:</div><br>\r\n<form action=\"https://www.2checkout.com/2co/buyer/purchase\" method=\"POST\" target=\"_blank\">\r\n  <input type=\"hidden\" name=\"sid\" value=\"{checkout_id}\">\r\n  <input type=\"hidden\" name=\"cart_order_id\" value=\"{checkout_num}\">\r\n  <input type=\"hidden\" name=\"total\" value=\"{usd}\">\r\n  <input type=\"hidden\" name=\"fixed\" value=\"Y\">\r\n  <input type=\"hidden\" name=\"demo\" value=\"N\">\r\n  <input type=\"hidden\" name=\"email\" value=\"{email}\">\r\n  <input type=\"hidden\" name=\"merchant_order_id\" value=\"{checkout_num}\">\r\n  <input type=\"hidden\" name=\"country\" value=\"RUS\">\r\n  <input type=\"hidden\" name=\"state\" value=\"XX\">\r\n<div class=\"paybtn\"><input id=\"subm\" class=\"submit\" type=\"submit\" value=\"Перейти к оплате {usd}$\"/></div>\r\n</form>'),
('interkassa', 'Интеркасса', '<h4>Оплата через Интеркассу</h4>\r\n<div class=\"payimg\"><img src=\"{bu}images/front/bill/iks.gif\"></div><br>\r\n<div>Оплата выбранным Вами способом будет происходить через посредника - компанию <b>&quot;Интеркасса&quot;</b>.</div><br>\r\n<div>Выберите удобный для Вас способ оплаты, заполните форму и следуйте дальнейшим инструкциям.</div><br>\r\n<div>Чтобы продолжить оплату, нажмите на кнопку:</div>\r\n<form accept-charset=\"UTF-8\" action=\"https://sci.interkassa.com/\" enctype=\"utf-8\" id=\"payment\" name=\"payment\" method=\"post\" target=\"_blank\">\r\n<input type=\"hidden\" name=\"ik_co_id\" value=\"{interkassa_id}\">\r\n<input type=\"hidden\" name=\"ik_pm_no\" value=\"{bill_id}\">\r\n<input type=\"hidden\" name=\"ik_am\" value=\"{rur}\">\r\n<input type=\"hidden\" name=\"ik_cur\" value=\"RUB\">\r\n<input type=\"hidden\" name=\"ik_desc\" value=\"Paybill #{bill_id} for {email}\">\r\n<div class=\"paybtn\"><input id=\"subm\" class=\"submit\" type=\"submit\" value=\"Перейти к оплате\"/></div>\r\n</form>'),
('liqpay', 'LiqPay', '<h4>Оплата через LiqPay</h4>\r\n<div class=\"payimg\"><img src=\"{bu}images/front/bill/liqpay.png\"></div><br>\r\n<div>Вы можете выполнить оплату со своего счёта в LiqPay или c кредитной карты.</div><br>\r\n<div>Чтобы продолжить, нажмите на кнопку:</div>\r\n<form accept-charset=\"utf-8\" action=\"https://www.liqpay.com/?do=clickNbuy\" method=\"POST\" target=\"_blank\">\r\n<input type=\"hidden\" name=\"operation_xml\" value=\"{liqpay_xml}\">\r\n<input type=\"hidden\" name=\"signature\" value=\"{liqpay_crc}\">\r\n<div class=\"paybtn\"><input id=\"subm\" class=\"submit\" type=\"submit\" value=\"Оплатить {usd}$\"></div>\r\n</form>'),
('onpay', 'OnPay', '<h4>Оплата через OnPay.ru (вручную)</h4>\r\n<div class=\"payimg\"><img src=\"{bu}images/front/bill/onpay.png\"></div>\r\n<div>Переведите {rur} рублей на счёт OnPay.ru,<br>нажав на кнопку Оплатить:</div>\r\n<style type=\"text/css\">\r\n<!--\r\na, a:active, a:hover {\r\n    color: #000;\r\n    text-decoration: none;\r\n    outline: 0;\r\n}\r\na:hover {\r\n    text-decoration: none;\r\n}\r\n.btn {\r\n    display: inline-block;\r\n    position: relative;\r\n    padding: 18px 32px;\r\n    border-radius: 50px;\r\n    color: #fff;\r\n    font-size: 16px;\r\n    letter-spacing: 1px;\r\n    text-decoration: none;\r\n    text-shadow: 0px 1px 1px rgba(0,0,0,0.4);\r\n    -webkit-box-shadow: 0px 1px 2px 1px rgba(0,0,0,0.2);\r\n    -moz-box-shadow: 0px 1px 2px 1px rgba(0,0,0,0.2);\r\n    box-shadow: 0px 1px 2px 1px rgba(0,0,0,0.2);\r\n    text-transform: uppercase;\r\n}\r\n.btn:hover {\r\n    -webkit-box-shadow: 0px 1px 4px 1px rgba(0,0,0,0.3);\r\n    -moz-box-shadow: 0px 1px 4px 1px rgba(0,0,0,0.3);\r\n    box-shadow: 0px 1px 4px 1px rgba(0,0,0,0.3);\r\n}\r\n.btn .m-green {\r\n    border-bottom: 3px solid #069c54;\r\n    border-top: 2px solid #66e000;\r\n    background: -moz-linear-gradient(top, #2bd100 1%, #00c100 100%);\r\n    background: -webkit-gradient(linear, left top, left bottom, color-stop(1%, #2bd100), color-stop(100%, #00c100));\r\n    background: -webkit-linear-gradient(top, #2bd100 1%, #00c100 100%);\r\n    background: -o-linear-gradient(top, #2bd100 1%, #00c100 100%);\r\n    background: -ms-linear-gradient(top, #2bd100 1%, #00c100 100%);\r\n    background: linear-gradient(to bottom, #2bd100 1%, #00c100 100%);\r\n}\r\n.btn .m-green:active {\r\n    border-top: 3px solid #73ef0b;\r\n    border-bottom: 2px solid #0e863b;\r\n}\r\n\r\n.btn .m-green:hover {\r\n    background: -moz-linear-gradient(top, #33de0a 1%, #0fb108 100%);\r\n    background: -webkit-gradient(linear, left top, left bottom, color-stop(1%, #33de0a), color-stop(100%, #0fb108));\r\n    background: -webkit-linear-gradient(top, #33de0a 1%, #0fb108 100%);\r\n    background: -o-linear-gradient(top, #33de0a 1%, #0fb108 100%);\r\n    background: -ms-linear-gradient(top, #33de0a 1%, #0fb108 100%);\r\n    background: linear-gradient(to bottom, #33de0a 1%, #0fb108 100%);\r\n    border-top: 2px solid #73ef0b;\r\n    border-bottom: 3px solid #0e863b;\r\n}\r\n-->\r\n</style>\r\n<div class=\"paybtn\"><a href=\"https://secure.onpay.ru/pay/{onpay_id}?pay_mode=fix&f=11&price={rur}&ticker=RUR&pay_for={bill_id}&md5={onpay_crc}&convert=yes&user_email={email}&price_final=true&url_success=http%3A//rolar.ru/om/ps/onpay/ok&url_fail=http%3A//rolar.ru/om/ps/onpay/fail\" target=\"_blank\" class=\"btn m-green\">Оплатить</a></div>'),
('payeer', 'Payeer', '<h4>Оплата через Payeer</h4>\r\n<div class=\"payimg\"><img src=\"{bu}images/front/bill/payeer.png\"></div><br>\r\n<div>Чтобы оплатить Visa/MasterCard и другими способами через мерчант Payeer нажмите кнопку ниже:</div><br>\r\n<form action=\"{bu}ps/payeer\" method=\"post\" target=\"_blank\">\r\n<input type=\"hidden\" name=\"bill_id\" value=\"{bill_id}\">\r\n<input type=\"hidden\" name=\"crc\" value=\"{status_link}\">\r\n<input type=\"submit\" value=\"Продолжить оплату\" />\r\n</form>\r\n<!--<div>Переведите {rur} рублей на счёт <strong>P37769433</strong>,<br>нажав на кнопку:</div><br>\r\n<form action=\"https://payeer.com/merchant/\" method=\"POST\" target=\"_blank\">\r\n  <input type=\"hidden\" name=\"m_shop\" value=\"{payeer_id}\">\r\n  <input type=\"hidden\" name=\"m_orderid\" value=\"{bill_id}\">\r\n  <input type=\"hidden\" name=\"m_amount\" value=\"{rur}\">\r\n  <input type=\"hidden\" name=\"m_curr\" value=\"RUB\">\r\n  <input type=\"hidden\" name=\"m_desc\" value=\"{payeer_desc}\">\r\n  <input type=\"hidden\" name=\"m_sign\" value=\"{payeer_crc}\">\r\n<div class=\"paybtn\"><input type=\"submit\" name=\"m_process\" value=\"Оплатить\" class=\"submit\"></div>\r\n</form>-->'),
('paypal', 'PayPal', '<h4>Оплата через PayPal</h4>\r\n<div class=\"payimg\"><img src=\"{bu}images/front/bill/paypal.gif\"></div><br>\r\n<div>Чтобы перейти к прямой оплате через PayPal, нажмите на кнопку:</div><br>\r\n<form action=\"https://www.paypal.com/cgi-bin/webscr\" method=\"post\" target=\"_blank\">\r\n<input name=\"cmd\" type=\"hidden\" value=\"_xclick\">\r\n<input name=\"business\" type=\"hidden\" value=\"{paypal_email}\">\r\n<input name=\"item_name\" type=\"hidden\" value=\"Oplata Scheta #{bill_id}\">\r\n<input name=\"item_number\" type=\"hidden\" value=\"{bill_id}\">\r\n<input name=\"amount\" type=\"hidden\" value=\"{rur}\">\r\n<input name=\"no_shipping\" type=\"hidden\" value=\"1\">\r\n<input name=\"rm\" type=\"hidden\" value=\"1\">\r\n<input name=\"return\" type=\"hidden\" value=\"{bu}f/ok\">\r\n<input name=\"cancel_return\" type=\"hidden\" value=\"{bu}f/fail\">\r\n<input name=\"currency_code\" type=\"hidden\" value=\"RUB\">\r\n<input name=\"notify_url\" type=\"hidden\" value=\"{bu}ps/paypal\">\r\n<input type=\"submit\" value=\"Платить через PayPal\">\r\n</form>'),
('paypalm', 'PayPal (вручную)', '<h4>Оплата через PayPal (вручную)</h4>\r\n<div class=\"payimg\"><img src=\"{bu}images/front/bill/paypal.gif\"></div><br>\r\n<div style=\"color:#ff0000;\">Этим способом Вы можете опталить <strong>только курс по Cisco</strong>, стоимостью 1753 руб.<br>Для других товаров цена будет неверной!</div><br>\r\n<div>Переведите 1753 рубля на счёт PayPal,<br> нажав на кнопку оплаты:</div><br>\r\n<form action=\"https://www.paypal.com/cgi-bin/webscr\" method=\"post\" target=\"_blank\">\r\n  <input type=\"hidden\" name=\"cmd\" value=\"_s-xclick\">\r\n  <input type=\"hidden\" name=\"hosted_button_id\" value=\"ZK5KCV84PELGJ\">\r\n<div class=\"paybtn\"><input type=\"image\" src=\"https://www.paypalobjects.com/ru_RU/RU/i/btn/btn_paynowCC_LG.gif\" border=\"0\" name=\"submit\" alt=\"PayPal — более безопасный и легкий способ оплаты через Интернет!\"></div>\r\n</form>\r\n<div>После завершения оплаты перейдите по <a href=\"{notify_link}\" style=\"text-decoration: underline;\" target=\"_blank\" title=\"Уведомление об оплате счёта\">этой ссылке</a>, заполните форму и отправьте уведомление об оплате Администратору.</div>'),
('pmoneym', 'Perfect Money (вручную)', '<h4>Оплата через Perfect Money (вручную)</h4>\r\n<div class=\"payimg\"><img src=\"{bu}images/front/bill/perfectmoney.png\"></div><br>\r\n<div>К оплате <strong>{usd} USD</strong></div><br>\r\n<div>Чтобы перейти к оплате через PerfectMoney, нажмите на кнопку:</div><br>\r\n<form action=\"https://perfectmoney.is/api/step1.asp\" method=\"POST\" target=\"_blank\">\r\n  <input type=\"hidden\" name=\"PAYEE_ACCOUNT\" value=\"U12663423\">\r\n  <input type=\"hidden\" name=\"PAYEE_NAME\" value=\"Paybill #{bill_id} for {email}\">\r\n  <input type=\"hidden\" name=\"PAYMENT_ID\" value=\"{bill_id}\">\r\n  <input type=\"hidden\" name=\"PAYMENT_AMOUNT\" value=\"{usd}\">\r\n  <input type=\"hidden\" name=\"PAYMENT_UNITS\" value=\"USD\">\r\n  <input type=\"hidden\" name=\"STATUS_URL\" value=\"http://rolar.ru/om/ps/perfectmoney\">\r\n  <input type=\"hidden\" name=\"PAYMENT_URL\" value=\"http://rolar.ru/om/f/ok/w/perfectmoney\">\r\n  <input type=\"hidden\" name=\"PAYMENT_URL_METHOD\" value=\"POST\">\r\n  <input type=\"hidden\" name=\"NOPAYMENT_URL\" value=\"http://rolar.ru/om/f/fail/w/perfectmoney\">\r\n  <input type=\"hidden\" name=\"NOPAYMENT_URL_METHOD\" value=\"POST\">\r\n  <input type=\"hidden\" name=\"SUGGESTED_MEMO\" value=\"\">\r\n  <input type=\"hidden\" name=\"BAGGAGE_FIELDS\" value=\"\">\r\n<div class=\"paybtn\"><input id=\"subm\" class=\"submit\" type=\"submit\" name=\"PAYMENT_METHOD\" value=\"Перейти к оплате\"></div>\r\n</form>\r\n<div>После завершения оплаты перейдите по <a href=\"{notify_link}\" style=\"text-decoration: underline;\" target=\"_blank\" title=\"Уведомление об оплате счёта\">этой ссылке</a>, заполните форму и отправьте уведомление об оплате Администратору.</div>'),
('qiwi', 'QIWI Wallet', '<h4>Оплата через QIWI Wallet</h4>\r\n<div class=\"payimg\"><img src=\"{bu}images/front/bill/qiwi.png\"></div><br>\r\n<div>Чтобы перейти к оплате через систему QIWI Wallet, введите Ваш номер Qiwi-кошелька в международном формате - <b>+79991111111</b> после нажатия на кнопку:</div><br>\r\n<form action=\"{qiwi_link}\" method=\"post\" target=\"_blank\">\r\n<input class=\"text\" type=\"text\" name=\"tel\" value=\"+\">\r\n<input type=\"submit\" value=\"Оплатить через QIWI Wallet\">\r\n</form>'),
('qiwim', 'QIWI Wallet (вручную)', '<h4>Оплата через QIWI Wallet (вручную)</h4>\r\n<div class=\"payimg\"><img src=\"{bu}images/front/bill/qiwi.png\"></div><br>\r\n<div>Переведите {rur} руб. на кошелёк <strong>+79872504631</strong>.</div><br>\r\n<div>Заполните форму, выберите удобный для Вас способ оплаты и следуйте дальнейшим инструкциям.</div><br>\r\n<div>Чтобы продолжить оплату, нажмите на кнопку:</div><br>\r\n<style type=\"text/css\">\r\na.paybuttonlink {\r\n    display: block;\r\n    position: relative;\r\n    min-height: 27px;\r\n    max-width: 180px;\r\n    margin: 0 auto;\r\n    padding: 10px 0px 5px 0px;\r\n    font-size: 16px;\r\n    font-family: Verdana;\r\n    font-weight: normal;\r\n    color: #000000;\r\n    background: #ededed;\r\n    background: -webkit-gradient(linear,left top,left bottom,from(#ededed),to(#c4c4c4));\r\n    background: -moz-linear-gradient(top,#ededed,#c4c4c4);\r\n    background: -o-linear-gradient(top,#ededed,#c4c4c4);\r\n    background: -ms-linear-gradient(top,#ededed,#c4c4c4);\r\n    background: linear-gradient(top,#ededed,#c4c4c4);\r\n    border: 1px solid #cdcdcd;\r\n    border-radius: 2px;\r\n    box-shadow: inset 0 1px 0 rgba(255,255,255,0.5);\r\n    -webkit-box-shadow: inset 0 1px 0 rgba(255,255,255,0.5);\r\n    -moz-box-shadow: inset 0 1px 0 rgba(255,255,255,0.5);\r\n    transition: all .2s ease-in-out;\r\n    -webkit-transition: all .2s ease-in-out;\r\n    -moz-transition: all .2s ease-in-out;\r\n    -o-transition: all .2s ease-in-out;\r\n    cursor: pointer;\r\n    text-decoration: none;\r\n    text-transform: uppercase;\r\n}\r\n</style>\r\n<div class=\"paybtn\"><a class=\"paybuttonlink\" href=\"https://w.qiwi.com/order/external/create.action?from=470237&summ={rur}&currency=RUB&comm=Paybill+%23{bill_id}&txn_id={bill_id}&iframe=false&successUrl=http%3A%2F%2Frolar.ru%2Fom%2Ff%2Fok%2Fw%2Fqiwi&failUrl=http%3A%2F%2Frolar.ru%2Fom%2Ff%2Ffail%2Fw%2Fqiwi&lifetime=1440\" target=\"_blank\" title=\"Оплатить\">Оплатить</a></div><br>\r\n<div>После завершения оплаты перейдите по <a href=\"{notify_link}\" style=\"text-decoration: underline;\" target=\"_blank\" title=\"Уведомление об оплате счёта\">этой ссылке</a>, заполните форму и отправьте уведомление об оплате Администратору.</div>'),
('rbkmoney', 'RBK Money', '<h4>Оплата через RBK Money</h4>\r\n<div class=\"payimg\"><img src=\"{bu}images/front/bill/rbkmoney.gif\"></div><br>\r\n<div>Оплата выбранным Вами способом будет происходить через посредника - компанию <b>ООО &quot;РБК Мани&quot;</b>.</div><br>\r\n<div>Выберите удобный для Вас способ оплаты, заполните форму и следуйте дальнейшим инструкциям.</div><br>\r\n<div>Чтобы продолжить оплату, нажмите на кнопку:<br>\r\n<form action=\"https://rbkmoney.ru/acceptpurchase.aspx\" method=\"POST\" target=\"_blank\">\r\n  <input type=\"hidden\" name=\"eShopId\" value=\"{rbkmoney_id}\">\r\n  <input type=\"hidden\" name=\"orderId\" value=\"{bill_id}\">\r\n  <input type=\"hidden\" name=\"serviceName\" value=\"Paybill #{bill_id} for {email}\">\r\n  <input type=\"hidden\" name=\"recipientAmount\" value=\"{rur}\">\r\n  <input type=\"hidden\" name=\"recipientCurrency\" value=\"RUR\">\r\n  <input type=\"hidden\" name=\"successUrl\" value=\"{bu}ps/rbkmoney/ok\">\r\n  <input type=\"hidden\" name=\"failUrl\" value=\"{bu}ps/rbkmoney/fail\">\r\n  <input type=\"hidden\" name=\"user_name\" value=\"{uname}\">\r\n  <input type=\"hidden\" name=\"user_email\" value=\"{email}\">\r\n<div class=\"paybtn\"><input id=\"subm\" class=\"submit\" type=\"submit\" value=\"Перейти к оплате\"/></div>\r\n</form>'),
('robox', 'ROBOKASSA', '<h4>Оплата через ROBOKASSA</h4>\r\n<div class=\"payimg\"><img src=\"{bu}images/front/bill/robokassa.png\"></div><br>\r\n<div>Чтобы произвести оплату различными электронными платежами через РобоКассу, нажмите на кнопку:</div><br>\r\n<form action=\"https://auth.robokassa.ru/Merchant/Index.aspx\" method=\"POST\" target=\"_blank\">\r\n<input type=\"hidden\" name=\"MrchLogin\" value=\"{robox_login}\">\r\n<input type=\"hidden\" name=\"OutSum\" value=\"{robox_sum}\">\r\n<input type=\"hidden\" name=\"InvId\" value=\"{robox_id}\">\r\n<input type=\"hidden\" name=\"Desc\" value=\"Oplata\">\r\n<input type=\"hidden\" name=\"SignatureValue\" value=\"{robox_crc}\">\r\n<input type=\"hidden\" name=\"Culture\" value=\"ru\">\r\n<input type=\"hidden\" name=\"Email\" value=\"{email}\">\r\n<div class=\"paybtn\"><input id=\"subm\" class=\"submit\" type=\"submit\" value=\"Перейти к оплате\"></div>\r\n</form><br>\r\n<div><font color=\"#cc0000\">Оплата этим способом требует бОльших затрат за оплату дополнительной комиссии!</font></div>'),
('sms', 'SMSCoin', '<h4>Оплата с помощью SMS</h4>\r\n<div class=\"payimg\"><img src=\"{bu}images/front/bill/smscoin.gif\"></div><br>\r\n<div>Оплата производится в долларах - <strong>{usd} USD</strong>.</div>\r\n<div>Чтобы перейти к инструкциям по отправке SMS, нажмите на кнопку:</div><br>\r\n<form action=\"{sms_url}\" method=\"POST\" target=\"_blank\">\r\n<input name=\"s_purse\" type=\"hidden\" value=\"{sms_id}\" />\r\n<input name=\"s_order_id\" type=\"hidden\" value=\"{bill_id}\" />\r\n<input name=\"s_amount\" type=\"hidden\" value=\"{usd}\" />\r\n<input name=\"s_clear_amount\" type=\"hidden\" value=\"{sms_cost}\" />\r\n<input name=\"s_description\" type=\"hidden\" value=\"Oplata scheta\" />\r\n<input name=\"s_sign\" type=\"hidden\" value=\"{sms_crc}\" />\r\n<div class=\"paybtn\"><input id=\"subm\" class=\"submit\" type=\"submit\" value=\"Перейти к оплате\"/></div>\r\n</form><br>\r\n<div><font color=\"#cc0000\">Внимание! Максимально допустимые тарифы за SMS <strong>не могут превышать 250 рублей</strong>! Если сумма Вашего заказа <strong>больше</strong> 250 руб, то оплата этим способом невозможна - список стран будет пустым.</font></div><br>\r\n<div><font color=\"#008000\">Оплата этим способом производится без комиссии (Комиссию платит продавец)!</font></div>'),
('sprypay', 'SpryPay', '<h4>Оплата через SpryPay</h4>\r\n<div class=\"payimg\"><img src=\"{bu}images/front/bill/sprypay.gif\"></div><br>\r\n<div>Оплата выбранным Вами способом будет происходить через посредника - <b>&quot;SpryPay&quot;</b>.</div><br>\r\n<div>Заполните форму и затем найдите выбранный Вами способ. Следуйте дальнейшим инструкциям.</div><br>\r\n<div>Чтобы продолжить оплату, нажмите на кнопку:</div><br>\r\n<form action=\"http://sprypay.ru/sppi/\" method=\"post\" target=\"_blank\">\r\n<input type=\"hidden\" name=\"spShopId\" value=\"{spry_id}\">\r\n<input type=\"hidden\" name=\"spShopPaymentId\" value=\"{bill_id}\">\r\n<input type=\"hidden\" name=\"spAmount\" value=\"{rur}\">\r\n<input type=\"hidden\" name=\"spCurrency\" value=\"rur\">\r\n<input type=\"hidden\" name=\"spPurpose\" value=\"Paybill {bill_id}\">\r\n<input type=\"hidden\" name=\"spUserEmail\" value=\"{email}\">\r\n<div class=\"paybtn\"><input id=\"subm\" class=\"submit\" type=\"submit\" value=\"Перейти к оплате\"/></div>\r\n</form>'),
('w1', 'Единая Касса W1', '<h4>Оплата через Единую Кассу W1</h4>\r\n<div class=\"payimg\">\r\n<img src=\"{bu}images/admin/pay/w1.jpg\">\r\n</div><br>\r\n<div>Чтобы перейти к оплате через систему Единая Касса W1, нажмите на кнопку:\r\n<form action=\"https://wl.walletone.com/checkout/checkout/Index\" method=\"post\" target=\"_blank\">\r\n{w1_form}\r\n<input type=\"submit\" value=\"Перейти к оплате\"/>\r\n</form>'),
('wme', 'WebMoney E', '<h4>Оплата через WebMoney E</h4>\r\n<div class=\"payimg\"><img src=\"{bu}images/front/bill/webmoney.png\"></div><br>\r\n<div>Чтобы перейти к прямой оплате через Webmoney Merchant, нажмите на кнопку:</div><br>\r\n<form accept-charset=\"cp1251\" action=\"https://merchant.webmoney.ru/lmi/payment.asp\" method=\"POST\" target=\"_blank\">\r\n<input type=\"hidden\" name=\"LMI_PAYEE_PURSE\" value=\"{wme}\">\r\n<input type=\"hidden\" name=\"LMI_PAYMENT_AMOUNT\" value=\"{eur}\">\r\n<input type=\"hidden\" name=\"LMI_PAYMENT_NO\" value=\"{bill_id}\">\r\n<input type=\"hidden\" name=\"LMI_PAYMENT_DESC\" value=\"Paybill #{bill_id} for {email}\">\r\n<div class=\"paybtn\"><input id=\"subm\" class=\"submit\" type=\"submit\" value=\"Оплатить {eur} WME\"/></div>\r\n</form>'),
('wmr', 'WebMoney R', '<h4>Оплата через WebMoney R</h4>\r\n<div class=\"payimg\"><img src=\"{bu}images/front/bill/webmoney.png\"></div><br>\r\n<div>Чтобы перейти к прямой оплате через Webmoney Merchant, нажмите на кнопку:</div><br>\r\n<form accept-charset=\"cp1251\" action=\"https://merchant.webmoney.ru/lmi/payment.asp\" method=\"POST\" target=\"_blank\">\r\n<input type=\"hidden\" name=\"LMI_PAYEE_PURSE\" value=\"{wmr}\">\r\n<input type=\"hidden\" name=\"LMI_PAYMENT_AMOUNT\" value=\"{rur}\">\r\n<input type=\"hidden\" name=\"LMI_PAYMENT_NO\" value=\"{bill_id}\">\r\n<input type=\"hidden\" name=\"LMI_PAYMENT_DESC\" value=\"Paybill #{bill_id} for {email}\">\r\n<div class=\"paybtn\"><input id=\"subm\" class=\"submit\" type=\"submit\" value=\"Оплатить {rur} WMR\"/></div>\r\n</form>'),
('wmu', 'WebMoney U', '<h4>Оплата через WebMoney U</h4>\r\n<div class=\"payimg\"><img src=\"{bu}images/front/bill/webmoney.png\"></div><br>\r\n<div>Чтобы перейти к прямой оплате через Webmoney Merchant, нажмите на кнопку:</div><br>\r\n<form accept-charset=\"cp1251\" action=\"https://merchant.webmoney.ru/lmi/payment.asp\" method=\"POST\" target=\"_blank\">\r\n<input type=\"hidden\" name=\"LMI_PAYEE_PURSE\" value=\"{wmu}\">\r\n<input type=\"hidden\" name=\"LMI_PAYMENT_AMOUNT\" value=\"{uah}\">\r\n<input type=\"hidden\" name=\"LMI_PAYMENT_NO\" value=\"{bill_id}\">\r\n<input type=\"hidden\" name=\"LMI_PAYMENT_DESC\" value=\"Paybill #{bill_id} for {email}\">\r\n<div class=\"paybtn\"><input id=\"subm\" class=\"submit\" type=\"submit\" value=\"Оплатить {uah} WMU\"/></div>\r\n</form>'),
('wmz', 'WebMoney Z', '<h4>Оплата через WebMoney Z</h4>\r\n<div class=\"payimg\"><img src=\"{bu}images/front/bill/webmoney.png\"></div><br>\r\n<div>Чтобы перейти к прямой оплате через Webmoney Merchant, нажмите на кнопку:</div><br>\r\n<form accept-charset=\"cp1251\" action=\"https://merchant.webmoney.ru/lmi/payment.asp\" method=\"POST\" target=\"_blank\">\r\n<input type=\"hidden\" name=\"LMI_PAYEE_PURSE\" value=\"{wmz}\">\r\n<input type=\"hidden\" name=\"LMI_PAYMENT_AMOUNT\" value=\"{usd}\">\r\n<input type=\"hidden\" name=\"LMI_PAYMENT_NO\" value=\"{bill_id}\">\r\n<input type=\"hidden\" name=\"LMI_PAYMENT_DESC\" value=\"Paybill #{bill_id} for {email}\">\r\n<div class=\"paybtn\"><input id=\"subm\" class=\"submit\" type=\"submit\" value=\"Оплатить {usd} WMZ\"/></div>\r\n</form>'),
('yandex', 'Яндекс.Деньги', '<h4>Оплата через Яндекс.Деньги</h4>\r\n<div class=\"payimg\"><img src=\"{bu}images/front/bill/yandex.png\"></div><br>\r\n<div>Чтобы перейти к прямой оплате через Яндекс.Деньги, выберите нужный способ оплаты и нажмите на кнопку &quot;Перейти к оплате&quot;.</div><br>\r\n<form action=\"https://money.yandex.ru/quickpay/confirm.xml\" method=\"POST\" target=\"_blank\">\r\n<input type=\"hidden\" name=\"receiver\" value=\"{yandex_account}\">\r\n<input type=\"hidden\" name=\"formcomment\" value=\"Оплата счёта {bill_id}\">\r\n<input type=\"hidden\" name=\"short-dest\" value=\"Оплата счёта {bill_id}\">\r\n<input type=\"hidden\" name=\"label\" value=\"Oplata_scheta_{bill_id}\">\r\n<input type=\"hidden\" name=\"quickpay-form\" value=\"shop\">\r\n<input type=\"hidden\" name=\"targets\" value=\"Oplata_scheta_{bill_id}\">\r\n<input type=\"hidden\" name=\"sum\" value=\"{rur}\" data-type=\"number\">\r\n<p align=\"left\" style=\"margin-left: 30px; margin-top: 15px;\"><input type=\"radio\" name=\"paymentType\" value=\"PC\" checked> Яндекс.Деньгами</input></p>\r\n<p align=\"left\" style=\"margin-left: 30px; margin-top: 15px;\"><input type=\"radio\" name=\"paymentType\" value=\"AC\"> Банковской картой VISA/MasterCard</input></p>\r\n<input style=\"margin-top: 18px;\" type=\"submit\" name=\"submit-button\" value=\"Перейти к оплате\">\r\n</form>'),
('yandexm', 'Яндекс.Деньги (вручную)', '<h4>Оплата через Яндекс.Деньги (вручную)</h4>\r\n<div class=\"payimg\"><img src=\"{bu}images/front/bill/yandex.png\"></div><br>\r\n<div>Переведите {rur} руб. на кошелёк <strong>410011123840928</strong> любым из предложенных способов, нажав на соответствующую кнопку оплаты:</div><br>\r\n<div>для платежей из Яндекс.Кошелька:</div>\r\n<div><iframe frameborder=\"0\" allowtransparency=\"true\" scrolling=\"no\" src=\"https://money.yandex.ru/embed/small.xml?account=410011123840928&quickpay=small&yamoney-payment-type=on&button-text=01&button-size=l&button-color=white&targets=Paybill+%23{bill_id}&default-sum={rur}&mail=on&successURL=http%3A%2F%2Frolar.ru%2Fom%2Ff%2Fok%2Fw%2Fyandex\" width=\"241\" height=\"54\"></iframe></div><br>\r\n<div>для платежей с помощью карт VISA и MasterCard:</div>\r\n<div><iframe frameborder=\"0\" allowtransparency=\"true\" scrolling=\"no\" src=\"https://money.yandex.ru/embed/small.xml?account=410011123840928&quickpay=small&any-card-payment-type=on&button-text=01&button-size=l&button-color=white&targets=Paybill+%23{bill_id}&default-sum={rur}&mail=on&successURL=http%3A%2F%2Frolar.ru%2Fom%2Ff%2Fok%2Fw%2Fyandex\" width=\"241\" height=\"54\"></iframe></div><br>\r\n<div>для платежей со счёта мобильного телефона:</div>\r\n<div><iframe frameborder=\"0\" allowtransparency=\"true\" scrolling=\"no\" src=\"https://money.yandex.ru/embed/small.xml?account=410011123840928&quickpay=small&mobile-payment-type=on&button-text=01&button-size=l&button-color=white&targets=Paybill+%23{bill_id}&default-sum={rur}&mail=on&successURL=http%3A%2F%2Frolar.ru%2Fom%2Ff%2Fok%2Fw%2Fyandex\" width=\"241\" height=\"54\"></iframe></div><br>\r\n<div>При оплате с помощью карт VISA/MasterCard и мобильного телефона, необходимо ввести ваши данные.</div><br>\r\n<div>После завершения оплаты перейдите по <a href=\"{notify_link}\" style=\"text-decoration: underline;\" target=\"_blank\" title=\"Уведомление об оплате счёта\">этой ссылке</a>, заполните форму и отправьте уведомление об оплате Администратору.</div><br>'),
('zpay', 'Z-Payment', '<h4>Оплата через Z-Payment</h4>\r\n<div class=\"payimg\"><img src=\"{bu}images/front/bill/zpayment.gif\"></div><br>\r\n<div>Оплата выбранным Вами способом будет происходить через посредника - компанию <b>ООО &quot;Зет Паймент&quot;</b>.</div><br>\r\n<div>Выберите удобный для Вас способ оплаты, заполните форму и следуйте дальнейшим инструкциям.</div><br>\r\n<div>Чтобы продолжить оплату, нажмите на кнопку:</div>\r\n<form action=\"https://z-payment.ru/merchant.php\" id=\"pay_zpayment\" method=\"POST\" name=\"pay_zpayment\" target=\"_blank\">\r\n  <input type=\"hidden\" name=\"LMI_PAYEE_PURSE\" value=\"{zpay_id}\">\r\n  <input type=\"hidden\" name=\"LMI_PAYMENT_AMOUNT\" value=\"{rur}\">\r\n  <input type=\"hidden\" name=\"LMI_PAYMENT_NO\" value=\"{bill_id}\">\r\n  <input type=\"hidden\" name=\"LMI_PAYMENT_DESC\" value=\"Paybill #{bill_id} for {email}\">\r\n  <input type=\"hidden\" name=\"CLIENT_MAIL\" value=\"{email}\">\r\n<div class=\"paybtn\"><input id=\"subm\" class=\"submit\" type=\"submit\" value=\"Перейти к оплате\"/></div>\r\n</form>'),
('yandex_online', 'Яндекс.Деньги (через сайт)', '<h4>Оплата с помощью Яндекс.Деньги</h4>\r\n\r\n<div class=\"payimg\">\r\n<img src=\"{bu}images/admin/pay/yandex.png\">\r\n</div>\r\n\r\n<br>\r\nЧтобы перейти к прямой оплате на Сайте Яндекс.Деньги, нажмите:\r\n\r\n\r\n<form method=\"POST\" action=\"https://money.yandex.ru/quickpay/confirm.xml\">\r\n<input type=\"hidden\" name=\"receiver\" value=\"{yandex_account}\">\r\n<input type=\"hidden\" name=\"formcomment\" value=\"Оплата счёта {bill_id}\">\r\n<input type=\"hidden\" name=\"short-dest\" value=\"Оплата счёта {bill_id}\">\r\n<input type=\"hidden\" name=\"label\" value=\"Oplata_scheta_{bill_id}\">\r\n<input type=\"hidden\" name=\"quickpay-form\" value=\"shop\">\r\n<input type=\"hidden\" name=\"targets\" value=\"Oplata_scheta_{bill_id}\">\r\n<input type=\"hidden\" name=\"sum\" value=\"{rur}\" data-type=\"number\">\r\n<p align=\"left\" style=\"margin-left: 30px; margin-top: 15px;\"><input type=\"radio\" name=\"paymentType\" value=\"PC\" checked> Яндекс.Деньгами</input></p>\r\n<p align=\"left\" style=\"margin-left: 30px; margin-top: 15px;\"><input type=\"radio\" name=\"paymentType\" value=\"AC\"> Банковской картой VISA/MasterCard</input> </p>\r\n<input style=\"margin-top: 18px;\" type=\"submit\" name=\"submit-button\" value=\"Продолжить оплату\">\r\n</form>'),
('paypal_online', 'С помощью PayPal', '﻿<h4>Оплата с помощью PayPal</h4>\r\n\r\n<div class=\"payimg\">\r\n<img src=\"{bu}images/admin/pay/paypal.jpg\">\r\n</div>\r\n\r\n<br>\r\nЧтобы перейти к прямой оплате на сайте PayPal, нажмите:\r\n\r\n<form action=\"https://www.paypal.com/cgi-bin/webscr\" method=\"post\">\r\n <input name=\"cmd\" type=\"hidden\" value=\"_xclick\">\r\n <input name=\"business\" type=\"hidden\" value=\"{paypal_email}\">\r\n <input name=\"item_name\" type=\"hidden\" value=\"Oplata Scheta #{bill_id}\">\r\n <input name=\"item_number\" type=\"hidden\" value=\"{bill_id}\">\r\n <input name=\"amount\" type=\"hidden\" value=\"{rur}\">\r\n <input name=\"no_shipping\" type=\"hidden\" value=\"1\">\r\n <input name=\"rm\" type=\"hidden\" value=\"1\">\r\n <input name=\"return\" type=\"hidden\" value=\"{bu}f/ok\">\r\n <input name=\"cancel_return\" type=\"hidden\" value=\"{bu}f/fail\">\r\n <input name=\"currency_code\" type=\"hidden\" value=\"RUB\">\r\n <input name=\"notify_url\" type=\"hidden\" value=\"{bu}ps/paypal\">\r\n <input type=\"submit\" value=\"Платить через PayPal\">\r\n</form>'),
('qiwi_online', 'Платёжная система Qiwi', '﻿<h4>Оплата с помощью Qiwi</h4>\r\n\r\n<div class=\"payimg\">\r\n<img src=\"{bu}images/admin/pay/qiwi.jpg\">\r\n</div>\r\n\r\n<br>\r\nЧтобы перейти к оплате с помощью Qiwi, введите Ваш номер Qiwi кошелька в международном формате - <b>+79991111111</b>:<br>&nbsp;<br>\r\n\r\n<form action=\"{qiwi_link}\" method=\"post\" target=\"_blank\">\r\n <input class=\"text\" type=\"text\" name=\"tel\" value=\"+\"><br>\r\n <input type=\"submit\" value=\"Оплата через Qiwi\">\r\n</form>'),
('w1_online', 'Единая Касса (W1)', '<h4>Оплата через Единую Кассу (W1)</h4>\r\n\r\n<div class=\"payimg\">\r\n<img src=\"{bu}images/admin/pay/w1.jpg\">\r\n</div>\r\n\r\n<br>\r\nЧтобы перейти к выбору способа оплаты через Единую Кассу (W1), нажмите:\r\n\r\n\r\n<form method=\"post\" action=\"https://wl.walletone.com/checkout/checkout/Index\">\r\n  {w1_form}\r\n  <input type=\"submit\" value=\"Продолжить оплату\"/>\r\n</form>'),
('yandexkassa', 'Яндекс.Касса', '<h4>Оплата через Яндекс.Кассу</h4>\r\n<div class=\"payimg\"><img src=\"{bu}images/front/bill/yandexkassa.png\"></div><br>\r\n<div>Чтобы оплатить Visa/MasterCard и другими способами через Яндекс.Кассу нажмите на кнопку ниже:</div><br>\r\n<form action=\"{bu}ps/yandexkassa/form\" method=\"post\" target=\"_blank\">\r\n<input type=\"hidden\" name=\"bill_id\" value=\"{bill_id}\">\r\n<input type=\"hidden\" name=\"crc\" value=\"{status_link}\">\r\n<input type=\"submit\" value=\"Продолжить оплату\" />\r\n</form>\r\n<!--<div>Чтобы перейти к прямой оплате через Яндекс.Деньги, выберите нужный способ оплаты и нажмите на кнопку &quot;Перейти к оплате&quot;.</div><br>\r\n<form action=\"https://money.yandex.ru/quickpay/confirm.xml\" method=\"POST\" target=\"_blank\">\r\n<input type=\"hidden\" name=\"receiver\" value=\"{yandex_account}\">\r\n<input type=\"hidden\" name=\"formcomment\" value=\"Оплата счёта {bill_id}\">\r\n<input type=\"hidden\" name=\"short-dest\" value=\"Оплата счёта {bill_id}\">\r\n<input type=\"hidden\" name=\"label\" value=\"Oplata_scheta_{bill_id}\">\r\n<input type=\"hidden\" name=\"quickpay-form\" value=\"shop\">\r\n<input type=\"hidden\" name=\"targets\" value=\"Oplata_scheta_{bill_id}\">\r\n<input type=\"hidden\" name=\"sum\" value=\"{rur}\" data-type=\"number\">\r\n<p align=\"left\" style=\"margin-left: 30px; margin-top: 15px;\"><input type=\"radio\" name=\"paymentType\" value=\"PC\" checked> Яндекс.Деньгами</input></p>\r\n<p align=\"left\" style=\"margin-left: 30px; margin-top: 15px;\"><input type=\"radio\" name=\"paymentType\" value=\"AC\"> Банковской картой VISA/MasterCard</input></p>\r\n<input style=\"margin-top: 18px;\" type=\"submit\" name=\"submit-button\" value=\"Перейти к оплате\">\r\n</form>-->'),
('sberbank_online', 'Сбербанк Online (вручную)', '<h4>Оплата через Сбербанк Online (вручную)</h4>\r\n<div class=\"payimg\"><a href=\"https://online.sberbank.ru/\" target=\"_blank\" title=\"Оплатить через Сбербанк Online\"><img alt=\"Оплатить через Сбербанк Online\" src=\"{bu}images/front/bill/sberbank.png\"></a></div><br>\r\n<style type=\"text/css\">\r\na#paybtn {\r\ncolor: #dd5500;\r\nfont-size: 12px;\r\nfont-weight: bold;\r\ntext-decoration: underline;\r\ncursor: pointer;\r\n}\r\n</style>\r\n<div>Переведите <strong>{rur} руб.</strong><br>на банковскую карту VISA <strong>4276 0600 1516 9009</strong><br>или на номер телефона <strong>+79872504631</strong><br>через сервис <a id=\"paybtn\" href=\"https://online.sberbank.ru/\" target=\"_blank\" title=\"Оплатить через Сбербанк Online\">Сбербанк Online</a>.</div><br>\r\n<div>После завершения оплаты перейдите по <a href=\"{notify_link}\" style=\"text-decoration: underline;\" target=\"_blank\" title=\"Уведомление об оплате счёта\">этой ссылке</a>, заполните форму и отправьте уведомление об оплате Администратору.</div>');

-- --------------------------------------------------------

--
-- Структура таблицы `om_way_list`
--

CREATE TABLE `om_way_list` (
  `plist_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `pic` varchar(255) NOT NULL,
  `url` varchar(255) NOT NULL,
  `ways` varchar(255) NOT NULL,
  `category` varchar(255) NOT NULL,
  `position` int(11) NOT NULL,
  `advanced` text
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `om_way_list`
--

INSERT INTO `om_way_list` (`plist_id`, `title`, `pic`, `url`, `ways`, `category`, `position`, `advanced`) VALUES
(1, 'Кредитные карты VISA/MasterCard/Maestro/American Express', 'card', '', 'zpay,liqpay,robox,yandexm,checkout', 'Кредитные карты', 1, ''),
(2, 'WebMoney R (Рубли)', 'webmoney', 'https://www.webmoney.ru/', 'wmr', 'Электронные платежи', 11, ''),
(3, 'WebMoney Z (Доллары)', 'webmoney', 'https://www.webmoney.ru/', 'wmz', 'Электронные платежи', 12, ''),
(4, 'WebMoney E (Евро)', 'webmoney', 'https://www.webmoney.ru/', 'wme', 'Электронные платежи', 13, ''),
(5, 'WebMoney U (Гривны)', 'webmoney', 'https://www.webmoney.ru/', 'wmu', 'Электронные платежи', 14, ''),
(6, 'Яндекс.Деньги', 'yandex', 'https://money.yandex.ru/', 'yandex', 'Электронные платежи', 15, ''),
(7, 'PayPal', 'paypal', 'https://www.paypal.com', 'paypal', 'Электронные платежи', 16, ''),
(8, 'QIWI Wallet', 'qiwi', 'https://qiwi.com', 'qiwi', 'Электронные платежи', 17, ''),
(9, 'RBK Money', 'rbkmoney', 'http://rbkmoney.ru/', 'rbkmoney', 'Электронные платежи', 18, ''),
(10, 'Z-Payment', 'zpay', 'https://z-payment.com/?partner=ZP39017723', 'zpay', 'Электронные платежи', 19, ''),
(11, 'ROBOKASSA', 'robox', 'https://robokassa.ru/', 'robox', 'Электронные платежи', 20, ''),
(12, 'Интеркасса', 'interkassa', 'https://www.interkassa.com/', 'interkassa', 'Электронные платежи', 21, ''),
(13, 'LiqPay', 'liqpay', 'https://www.liqpay.com', 'liqpay', 'Электронные платежи', 22, ''),
(14, 'SpryPay', 'sprypay', 'http://sprypay.ru?puid=576af8570dbf5', 'sprypay', 'Электронные платежи', 23, ''),
(15, 'Payeer', 'payeer', 'https://payeer.com/?partner=2471813', 'payeer', 'Электронные платежи', 24, ''),
(16, 'OnPay', 'onpay', 'http://onpay.ru/', 'onpay', 'Электронные платежи', 25, ''),
(17, 'Единая касса W1', 'w1', 'https://www.walletone.com/', 'w1', 'Электронные платежи', 26, ''),
(18, 'Сбербанк Online', 'sberbank', 'https://online.sberbank.ru/', 'sprypay,zpay', 'Банковские и другие переводы', 101, ''),
(19, 'Альфа-Клик', 'alfa', 'https://click.alfabank.ru', 'zpay,sprypay,robox,payeer', 'Банковские и другие переводы', 102, ''),
(20, 'Банковский перевод в России', 'bank', '', 'zpay,sprypay,payeer', 'Банковские и другие переводы', 103, ''),
(21, 'Почтовый перевод', 'post', 'https://www.pochta.ru/', 'sprypay,wmr', 'Банковские и другие переводы', 104, ''),
(22, 'Перевод по системе Контакт', 'contact', 'https://www.contact-sys.com/', 'payeer', 'Банковские и другие переводы', 105, ''),
(23, 'ПриватБанк или другой украинский банк', 'privat', 'https://privatbank.ua/', 'liqpay,payeer', 'Банковские и другие переводы', 106, ''),
(24, 'Перевод по системе Юнистрим', 'unistream', 'http://www.unistream.ru/', 'zpay,payeer', 'Банковские и другие переводы', 107, ''),
(25, 'Перевод Western Union', 'wu', 'http://www.westernunion.ru/', 'zpay,payeer', 'Банковские и другие переводы', 108, ''),
(26, 'Перевод по системе Золотая Корона', 'zkorona', 'http://www.perevod-korona.com/', 'zpay,payeer', 'Банковские и другие переводы', 109, ''),
(27, 'Международные банковские переводы (USD, EUR)', 'wire', '', 'zpay,interkassa,liqpay,payeer', 'Банковские и другие переводы', 110, ''),
(28, 'Яндекс.Деньги (вручную)', 'yandex', 'https://money.yandex.ru/', 'yandexm', 'Оплата вручную', 201, ''),
(29, 'QIWI Wallet (вручную)', 'qiwi', 'https://qiwi.com', 'qiwim', 'Оплата вручную', 202, ''),
(30, 'Perfect Money (вручную)', 'perfectmoney', 'https://perfectmoney.is/?ref=7073263', 'pmoneym', 'Оплата вручную', 203, ''),
(31, 'PayPal (вручную)', 'paypal', 'https://www.paypal.com', 'paypalm', 'Оплата вручную', 204, ''),
(32, 'На карту VISA (вручную)', 'card', '', 'cardm', 'Оплата вручную', 205, ''),
(33, 'Яндекс.Деньги (через посредников)', 'yandex', 'https://money.yandex.ru/', 'zpay,robox,payeer', 'Электронные платежи через посредников', 301, ''),
(34, 'QIWI Wallet (через посредников)', 'qiwi', 'https://qiwi.com', 'sprypay,zpay', 'Электронные платежи через посредников', 302, ''),
(35, 'Оплата наличными', 'nal', '', 'liqpay,sprypay,payeer', 'Прочие способы', 401, ''),
(36, 'SMS-сообщением', 'sms', 'https://smscoin.com/ru/', 'sms,payeer,zpay,yandexm', 'Прочие способы', 402, ''),
(37, 'Терминалы приёма оплаты, банкоматы', 'terminal', '', 'wmr,liqpay,qiwim', 'Прочие способы', 403, ''),
(38, 'Другие способы (выбор у посредников)', 'all', '', 'wmr,zpay,robox,interkassa,liqpay,sprypay,payeer', 'Прочие способы', 404, ''),
(39, 'Оплата Яндекс.Деньги или VISA/MasterCard', 'yandex', 'http://money.yandex.ru/', 'yandex_online', 'Электронные платежи', 180, NULL),
(40, 'Оплата через PayPal', 'paypal', 'http://paypal.com/', 'paypal_online', 'Электронные платежи', 182, NULL),
(41, 'Оплата с помощью Qiwi', 'qiwi', 'http://qiwi.ru/', 'qiwi_online', 'Электронные платежи', 184, NULL),
(42, 'Оплата через Единую Кассу (W1)', 'w1', 'http://w1.ru/', 'w1_online', 'Электронные платежи', 186, NULL),
(43, 'Яндекс.Касса', 'yandex', 'https://kassa.yandex.ru/', 'yandexkassa', 'Электронные платежи', 27, NULL),
(44, 'Сбербанк Online (вручную)', 'sberbank', 'https://online.sberbank.ru/', 'sberbank_online', 'Оплата вручную', 206, NULL);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `om_2checkout`
--
ALTER TABLE `om_2checkout`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `om_ad`
--
ALTER TABLE `om_ad`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `om_ad_category`
--
ALTER TABLE `om_ad_category`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `om_affstats`
--
ALTER TABLE `om_affstats`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `om_anew`
--
ALTER TABLE `om_anew`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `om_area`
--
ALTER TABLE `om_area`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `om_area_item`
--
ALTER TABLE `om_area_item`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `om_area_paylist`
--
ALTER TABLE `om_area_paylist`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `om_area_section`
--
ALTER TABLE `om_area_section`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `om_area_user`
--
ALTER TABLE `om_area_user`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `om_article`
--
ALTER TABLE `om_article`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `om_article_category`
--
ALTER TABLE `om_article_category`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `om_author`
--
ALTER TABLE `om_author`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `om_bill`
--
ALTER TABLE `om_bill`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `om_black`
--
ALTER TABLE `om_black`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `om_category`
--
ALTER TABLE `om_category`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `om_client`
--
ALTER TABLE `om_client`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `om_cupon`
--
ALTER TABLE `om_cupon`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `om_cupon_category`
--
ALTER TABLE `om_cupon_category`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `om_good`
--
ALTER TABLE `om_good`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `om_good_group`
--
ALTER TABLE `om_good_group`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `om_letter`
--
ALTER TABLE `om_letter`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `om_log`
--
ALTER TABLE `om_log`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `om_lookup`
--
ALTER TABLE `om_lookup`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `om_odno`
--
ALTER TABLE `om_odno`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `om_order`
--
ALTER TABLE `om_order`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `om_page`
--
ALTER TABLE `om_page`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `om_partner`
--
ALTER TABLE `om_partner`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `om_partner_auto`
--
ALTER TABLE `om_partner_auto`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `om_partner_personal`
--
ALTER TABLE `om_partner_personal`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `om_payout`
--
ALTER TABLE `om_payout`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `om_pin`
--
ALTER TABLE `om_pin`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `om_pincat`
--
ALTER TABLE `om_pincat`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `om_plink`
--
ALTER TABLE `om_plink`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `om_queue`
--
ALTER TABLE `om_queue`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `om_rass`
--
ALTER TABLE `om_rass`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `om_rass_letter`
--
ALTER TABLE `om_rass_letter`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `om_rass_sub`
--
ALTER TABLE `om_rass_sub`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `om_rass_user`
--
ALTER TABLE `om_rass_user`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `om_s`
--
ALTER TABLE `om_s`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `om_session`
--
ALTER TABLE `om_session`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `om_settings`
--
ALTER TABLE `om_settings`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `om_shorten`
--
ALTER TABLE `om_shorten`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `om_special`
--
ALTER TABLE `om_special`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `om_staff`
--
ALTER TABLE `om_staff`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `om_staff_access`
--
ALTER TABLE `om_staff_access`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `om_ticket`
--
ALTER TABLE `om_ticket`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `om_ticket_answer`
--
ALTER TABLE `om_ticket_answer`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `om_ticket_section`
--
ALTER TABLE `om_ticket_section`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `om_way`
--
ALTER TABLE `om_way`
  ADD PRIMARY KEY (`way_id`);

--
-- Индексы таблицы `om_way_list`
--
ALTER TABLE `om_way_list`
  ADD PRIMARY KEY (`plist_id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `om_2checkout`
--
ALTER TABLE `om_2checkout`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `om_ad`
--
ALTER TABLE `om_ad`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT для таблицы `om_ad_category`
--
ALTER TABLE `om_ad_category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT для таблицы `om_affstats`
--
ALTER TABLE `om_affstats`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `om_anew`
--
ALTER TABLE `om_anew`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `om_area`
--
ALTER TABLE `om_area`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `om_area_item`
--
ALTER TABLE `om_area_item`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `om_area_paylist`
--
ALTER TABLE `om_area_paylist`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `om_area_section`
--
ALTER TABLE `om_area_section`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `om_area_user`
--
ALTER TABLE `om_area_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `om_article`
--
ALTER TABLE `om_article`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT для таблицы `om_article_category`
--
ALTER TABLE `om_article_category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT для таблицы `om_bill`
--
ALTER TABLE `om_bill`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT для таблицы `om_black`
--
ALTER TABLE `om_black`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `om_category`
--
ALTER TABLE `om_category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT для таблицы `om_client`
--
ALTER TABLE `om_client`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT для таблицы `om_cupon`
--
ALTER TABLE `om_cupon`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT для таблицы `om_cupon_category`
--
ALTER TABLE `om_cupon_category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT для таблицы `om_good_group`
--
ALTER TABLE `om_good_group`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT для таблицы `om_log`
--
ALTER TABLE `om_log`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=220;

--
-- AUTO_INCREMENT для таблицы `om_lookup`
--
ALTER TABLE `om_lookup`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=70;

--
-- AUTO_INCREMENT для таблицы `om_odno`
--
ALTER TABLE `om_odno`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `om_order`
--
ALTER TABLE `om_order`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT для таблицы `om_page`
--
ALTER TABLE `om_page`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `om_partner_auto`
--
ALTER TABLE `om_partner_auto`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `om_partner_personal`
--
ALTER TABLE `om_partner_personal`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `om_payout`
--
ALTER TABLE `om_payout`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `om_pin`
--
ALTER TABLE `om_pin`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `om_pincat`
--
ALTER TABLE `om_pincat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `om_queue`
--
ALTER TABLE `om_queue`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=677;

--
-- AUTO_INCREMENT для таблицы `om_rass`
--
ALTER TABLE `om_rass`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `om_rass_letter`
--
ALTER TABLE `om_rass_letter`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `om_rass_sub`
--
ALTER TABLE `om_rass_sub`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `om_rass_user`
--
ALTER TABLE `om_rass_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `om_s`
--
ALTER TABLE `om_s`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT для таблицы `om_shorten`
--
ALTER TABLE `om_shorten`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `om_special`
--
ALTER TABLE `om_special`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT для таблицы `om_staff`
--
ALTER TABLE `om_staff`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT для таблицы `om_ticket_answer`
--
ALTER TABLE `om_ticket_answer`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT для таблицы `om_ticket_section`
--
ALTER TABLE `om_ticket_section`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT для таблицы `om_way_list`
--
ALTER TABLE `om_way_list`
  MODIFY `plist_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
