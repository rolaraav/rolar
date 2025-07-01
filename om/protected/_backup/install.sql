DROP TABLE IF EXISTS `om_2checkout`;
CREATE TABLE `om_2checkout` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM /*!40101 DEFAULT CHARSET=utf8 */;

DROP TABLE IF EXISTS `om_ad`;
CREATE TABLE `om_ad` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `good_id` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `code` text NOT NULL,
  `adcategory_id` int(11) NOT NULL,
  `position` int(11) NOT NULL DEFAULT '0',
  `showcode` tinyint(4) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM /*!40101 DEFAULT CHARSET=utf8 */;

DROP TABLE IF EXISTS `om_ad_category`;
CREATE TABLE `om_ad_category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 /*!40101 DEFAULT CHARSET=utf8 */;

INSERT INTO `om_ad_category` VALUES
(1, 'Текстовые объявления', 'Текстовые объявления'),
(2, 'Баннеры', 'Баннеры для рекламы на сайтах');

DROP TABLE IF EXISTS `om_affstats`;
CREATE TABLE `om_affstats` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `partner_id` varchar(50) NOT NULL DEFAULT '',
  `komis` float NOT NULL DEFAULT '0',
  `prefid` varchar(50) NOT NULL DEFAULT '',
  `pkomis` float NOT NULL DEFAULT '0',
  `date` int(11) NOT NULL DEFAULT '0',
  `good_id` varchar(50) NOT NULL DEFAULT '',
  `kanal` varchar(255) NOT NULL DEFAULT 'default',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM /*!40101 DEFAULT CHARSET=utf8 */;

DROP TABLE IF EXISTS `om_anew`;
CREATE TABLE `om_anew` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `createTime` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM /*!40101 DEFAULT CHARSET=utf8 */;

DROP TABLE IF EXISTS `om_area`;
CREATE TABLE `om_area` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `active` tinyint(4) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM /*!40101 DEFAULT CHARSET=utf8 */;

DROP TABLE IF EXISTS `om_area_item`;
CREATE TABLE `om_area_item` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `area_id` int(11) NOT NULL,
  `area_section_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `icon` varchar(255) NOT NULL,
  `uploadDate` int(11) NOT NULL,
  `filename` varchar(255) NOT NULL,
  `position` int(11) NOT NULL,
  `size` varchar(40) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM /*!40101 DEFAULT CHARSET=utf8 */;

DROP TABLE IF EXISTS `om_area_paylist`;
CREATE TABLE `om_area_paylist` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `area_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `srok` int(11) NOT NULL,
  `price` float NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM /*!40101 DEFAULT CHARSET=utf8 */;

DROP TABLE IF EXISTS `om_area_section`;
CREATE TABLE `om_area_section` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `area_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `position` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM /*!40101 DEFAULT CHARSET=utf8 */;

DROP TABLE IF EXISTS `om_area_user`;
CREATE TABLE `om_area_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `area_id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `lastLogin` int(11) NOT NULL,
  `createDate` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `payTill` int(11) NOT NULL,
  `totalDays` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM /*!40101 DEFAULT CHARSET=utf8 */;

DROP TABLE IF EXISTS `om_article`;
CREATE TABLE `om_article` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `position` int(11) NOT NULL,
  `createTime` int(11) NOT NULL,
  `updateTime` int(11) NOT NULL,
  `visible` tinyint(4) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM /*!40101 DEFAULT CHARSET=utf8 */;

DROP TABLE IF EXISTS `om_article_category`;
CREATE TABLE `om_article_category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `position` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM /*!40101 DEFAULT CHARSET=utf8 */;

DROP TABLE IF EXISTS `om_author`;
CREATE TABLE `om_author` (
  `id` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `uname` varchar(255) NOT NULL,
  `total` float NOT NULL DEFAULT '0',
  `paid` float NOT NULL DEFAULT '0',
  `purse` varchar(255) NOT NULL,
  `kind` varchar(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM /*!40101 DEFAULT CHARSET=utf8 */;

DROP TABLE IF EXISTS `om_bill`;
CREATE TABLE `om_bill` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
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
  `curier` tinyint(4) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM /*!40101 DEFAULT CHARSET=utf8 */;

DROP TABLE IF EXISTS `om_black`;
CREATE TABLE `om_black` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `createDate` int(11) NOT NULL,
  `ip` varchar(100) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `comment` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM /*!40101 DEFAULT CHARSET=utf8 */;

DROP TABLE IF EXISTS `om_category`;
CREATE TABLE `om_category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `visible` tinyint(4) NOT NULL DEFAULT '1',
  `position` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 /*!40101 DEFAULT CHARSET=utf8 */;

INSERT INTO `om_category` VALUES
(1, 'Основная категория', '', 1, 1);

DROP TABLE IF EXISTS `om_client`;
CREATE TABLE `om_client` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `good_id` varchar(50) NOT NULL DEFAULT '',
  `uname` varchar(250) NOT NULL DEFAULT '',
  `email` varchar(250) NOT NULL DEFAULT '',
  `amail` varchar(250) NOT NULL DEFAULT '',
  `date` int(11) NOT NULL DEFAULT '0',
  `subscribe` tinyint(4) NOT NULL DEFAULT '1',
  `bill_id` bigint(20) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM /*!40101 DEFAULT CHARSET=utf8 */;

DROP TABLE IF EXISTS `om_cupon`;
CREATE TABLE `om_cupon` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
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
  `client_good_id` text,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM /*!40101 DEFAULT CHARSET=utf8 */;

DROP TABLE IF EXISTS `om_cupon_category`;
CREATE TABLE `om_cupon_category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `createDate` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 /*!40101 DEFAULT CHARSET=utf8 */;

INSERT INTO `om_cupon_category` VALUES
(1, 'Цифровые товары', 1299171295);

DROP TABLE IF EXISTS `om_good`;
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
  `csellOk` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM /*!40101 DEFAULT CHARSET=utf8 */;

DROP TABLE IF EXISTS `om_good_group`;
CREATE TABLE `om_good_group` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `group_id` int(11) NOT NULL,
  `good_id` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM /*!40101 DEFAULT CHARSET=utf8 */;

DROP TABLE IF EXISTS `om_letter`;
CREATE TABLE `om_letter` (
  `id` varchar(100) NOT NULL,
  `description` varchar(255) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `type` varchar(10) NOT NULL,
  `lon` tinyint(4) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM /*!40101 DEFAULT CHARSET=utf8 */;

INSERT INTO `om_letter` VALUES
('affreg', 'После регистрации в партнёрской программе', '%name%, Вы зарегистрировались в партнёрской программе', 'Здравствуйте, %name%!\r\n\r\nВы зарегистрированы в партнёрской программе.\r\n\r\nВаши данные для входа в аккаунт:\r\n\r\nЛогин: %partner_id%\r\nПароль: %password%\r\n\r\nВход в аккаунт здесь:\r\n%bu%aff/login\r\n\r\n\r\nP.S. Если Вы получили письмо по ошибке, пожалуйста, просто проигнорируйте его.\r\n--\r\n%site_title%\r\n%site_url%', 'plain', 1),
('forgot_pass', 'Восстановление пароля в партнёрской программе', '%name%, Ваш пароль к партнёрской программе', 'Здравствуйте, %name%!\r\n\r\nВы запросили восстановление пароля к партнёрской программе.\r\n\r\nВаши данные:\r\n\r\nЛогин (RefID): %partner_id%\r\nПароль: %password%\r\n\r\nВход в аккаунт:\r\n%bu%aff/default/login\r\n\r\nP.S. Если Вы получили данное письмо по ошибке, пожалуйста, проигнорируйте его или свяжитесь с администратором.\r\n\r\n--\r\n%site_title%\r\n%site_url%\r\n', 'plain', 1),
('admin_forgot_link', 'Запрос на восстановление пароля администратора', '[Order Master 2] - Ваша ссылка для восстановления пароля', 'Здравствуйте, %name%!\r\n\r\nВы запросили восстановление пароля для доступа к панели администратора.\r\n\r\nВаш Логин: %username%\r\nВремя запроса: %time%\r\nЗапрошено с IP: %ip%\r\n\r\nДля получения нового пароля, нажмите на следующую ссылку:\r\n%link%\r\n\r\nВам будет сгенерирован новый пароль и выслан на e-mail.\r\nСменить его сможет только администратор - в разделе \"Операторы\".', 'plain', 1),
('admin_forgot_pass', 'Новый пароль администратора', '[Order Master 2] - Новый пароль', 'Здравствуйте, %name%!\r\n\r\nДля Вашей учётной записи сгенерирован новый пароль.\r\n\r\nДанные для входа:\r\n\r\nЛогин: %username%\r\nПароль: %password%\r\n\r\nВход в аккаунт:\r\n%bu%admin/login', 'plain', 1),
('staff_answer', 'Служба поддержки добавила новый ответ', '%name%, добавлен новый ответ службы поддержки на Ваш запрос', '====================================================\r\n Не отвечайте на это письмо, так как оно отправлено автоматически.\r\n Пожалуйста, пройдите по ссылке, указанной в письме.\r\n====================================================\r\n\r\nЗдравствуйте, %name%.\r\n\r\nК отправленному Вами запросу добавлен новый ответ от Службы Поддержки.\r\n\r\nДанные тикета:\r\nID: %id%\r\nТема запроса: %subject%\r\nПросмотреть: %link%\r\n\r\nПо этой ссылке Вы также можете задать новый вопрос или же закрыть тикет.\r\n\r\nВсего наилучшего.\r\n\r\n---\r\n%site_title%\r\n%site_url%', 'plain', 1),
('staff_new_ticket', 'Пользователю, когда он создал новый тикет', 'Вы отправили новый запрос в службу поддержки. Номер тикета: %id%', '====================================================\r\nНе отвечайте на это письмо, так как оно отправлено автоматически.\r\n====================================================\r\n\r\nЗдравствуйте.\r\n\r\nВами был отправлен новый запрос в Службу Поддержки\r\n\r\nДанные тикета:\r\nID: %id%\r\nТема запроса: %subject%\r\n\r\nОтвет будет Вам выслан в срок примерно 1-3 рабочих дней. После ответа на Ваш запрос - Вы получите отдельное уведомление.\r\n\r\nТакже в любое время Вы можете просмотреть свой тикет по ID здесь:\r\n%site_url%/support/\r\n\r\nВсего Вам наилучшего!\r\n\r\nP.S. Если Вам письмо пришло по ошибке - просто проигнорируйте его, при необходимости - свяжитесь с владельцем сайта самостоятельно.\r\n\r\n---\r\n%site_title%\r\n%site_url%', 'plain', 1),
('bill_new', 'Выписан новый счёт (письмо пользователю)', 'Вы выписали новый счёт', 'Здравствуйте.\r\n\r\nВы выписали новый счёт:\r\n\r\nНомер счёта: %bill_id%\r\nСумма: %sum%\r\n\r\nПостоянная ссылка для отслеживания состояния Вашего заказа:\r\n%status_link%\r\n\r\nP.S. Если Вам письмо пришло по ошибке - просто проигнорируйте его, при необходимости - свяжитесь с администрацией сайта самостоятельно.\r\n---\r\n%site_title%\r\n%site_url%', 'plain', 0),
('nalozh_confirm', 'Письмо с ссылкой подтверждения наложенного платежа', 'Подтверждение заказа наложенным платежом', 'Здравствуйте.\r\n\r\nВы оформили заказ наложенным платежом:\r\n\r\nНомер счёта: %bill_id%\r\nСумма: %sum%\r\n\r\nЧтобы подтвердить данный заказ, следует перейти по ссылке:\r\n%nalozh_link%\r\n\r\nВНИМАНИЕ! Подтверждайте только в том случае, если Вы обязуетесь выкупить заказ, когда он прийдёт по почте. В противном случае - не нажимайте на ссылку и просто удалите данное письмо.\r\n\r\nПостоянная ссылка для отслеживания состояния Вашего заказа:\r\n%status_link%\r\n\r\nP.S. Если Вам письмо пришло по ошибке - просто проигнорируйте его, при необходимости - свяжитесь с администрацией сайта самостоятельно.\r\n---\r\n%site_title%\r\n%site_url%', 'plain', 1),
('nalozh_confirmed', 'Заказ наложенным платежом подтверждён', 'Ваш заказ наложенным платежом подтверждён', 'Здравствуйте, %name%.\r\n\r\nВаш заказ наложенным платежом успешно подтверждён.\r\nОтправка произойдёт в ближайшее время - в сроки, установленные продавцом.\r\n\r\nНомер счёта: %bill_id%\r\n\r\nПостоянная ссылка для отслеживания состояния Вашего заказа:\r\n%status_link%\r\n\r\n---\r\n%site_title%\r\n%site_url%', 'plain', 1),
('admin_nalozh_confirmed', 'Администратору уведомление о заказе наложенным платежом', 'Оформлен заказ №%bill_id% наложенным платежом', 'Здравствуйте.\r\n\r\nОформлен заказ №%bill_id% наложенным платежом с такими данными:\r\n\r\nСумма: %sum%\r\nКупон скидки (если есть): %cupon%\r\n\r\nE-mail: %email%\r\nДругой e-mail: %amail%\r\nТелефон: %phone%\r\nIP: %ip%\r\n\r\nКомментарий к заказу: %comment%\r\n\r\n===============================\r\n Содержимое заказа\r\n===============================\r\n\r\n%orders%\r\n===============================\r\n\r\nАдрес доставки:\r\n\r\nФамилия: %surname%\r\nИмя: %uname%\r\nОтчество: %otchestvo%\r\n\r\nСтрана: %strana%\r\nОбласть/регион: %region%\r\nГород: %gorod%\r\nАдрес: %address%\r\nПочтовый индекс: %postindex%\r\n\r\nДанный заказ подтверждён.\r\n\r\nСсылка на отслеживание статуса:\r\n%status_link%\r\n\r\nСсылка для просмотра счёта в Панели Администратора:\r\n%admin_link%\r\n\r\nВсего наилучшего.\r\n---\r\n[Отправлено системой Order Master 2]', 'plain', 1),
('rass_default', 'По умолчанию при выполнении рассылки', '%name%, важная новость', 'Здравствуйте, %name%.\r\n\r\n\r\n\r\n\r\n\r\nВсего наилучшего!\r\n--\r\n%site_title%\r\n%site_url%\r\n\r\nОтказаться от получения сообщений на e-mail (безвозвратно):\r\n%unsub%\r\n', 'plain', 1),
('admin_notify_paid', 'Уведомление о совершении платежа вручную', 'Пользователь сообщает о совершении платежа вручную', 'Здравствуйте.\r\n\r\nПользователь сообщате, что счёт №%bill_id% был оплачен вручную.\r\n\r\nСумма: %sum%\r\nСпособ: %way%\r\n\r\n===============================================\r\n Текст сообщения от пользователя\r\n===============================================\r\n\r\n%message%\r\n\r\n===============================================\r\n\r\nСсылка на отслеживание статуса:\r\n%status_link%\r\n\r\nСсылка для просмотра счёта в Панели Администратора:\r\n%admin_link%\r\n\r\nПроверьте действительно поступления оплаты и после этого отметьте счёт как оплаченный.\r\n\r\nВсего наилучшего.\r\n---\r\n[Отправлено системой Order Master 2]', 'plain', 1),
('aff_payout', 'Уведомление о выплате комиссионных', '%name%, Вам выплачены комиссионные!', 'Здравствуйте, %name%!\r\n\r\nВы являетесь участником партнёрской программы сайта:\r\n%site_url%\r\n\r\nВаш RefID: %refid%\r\n\r\nВам выплачены комиссионные в размере: %sum% руб.\r\n\r\nСпособ выплаты: %way%\r\nВыплачено на счёт: %purse%\r\n\r\nВсего наилучшего.\r\n\r\n---\r\n%site_title%\r\n%site_url%', 'plain', 1),
('author_payout', 'Уведомление о выплате авторского вознаграждения', '%name%, Вам выплачено авторское вознаграждение', 'Здравствуйте, %name%!\r\n\r\nВаш ID автора: %id%\r\n\r\nВам выплачено авторское вознаграждение в размере: %sum% руб.\r\n\r\nСпособ выплаты: %way%\r\nВыплачено на счёт: %purse%\r\n\r\nВсего наилучшего.\r\n\r\n---\r\n%site_title%\r\n%site_url%', 'plain', 1),
('good_default_letter', 'Письмо по умолчанию - при добавлении нового товара', '%name%, Ваша ссылка для скачивания товара', 'Здравствуйте, %name%.\r\n\r\nВаша ссылка для скачивания \"%good_title%\":\r\n%dlink%\r\n\r\nПостарайтесь скачать все файлы в течение 3-х суток.\r\n\r\nВсего доброго.\r\n\r\n--\r\n%site_title%\r\n%site_url%', 'plain', 1),
('area_data', 'Письмо с данными для доступа к Закрытой Зоне', '%name%, Ваши данные для доступа к Закрытой Зоне', 'Здравствуйте, %name%.\r\n\r\nВ данном письме находятся данные для доступа к Закрытой Зоне \"%title%\".\r\n\r\nЛогин: %username%\r\nПароль: %password%\r\n\r\nСсылка для входа:\r\n%area_link%\r\n\r\nВсего наилучшего.\r\n---\r\n%site_title%\r\n%site_url%', 'plain', 1),
('bill_notify_1', 'Первое напоминание о неоплаченном счёте', 'У вас имеется неоплаченный счёт', 'Здравствуйте.\r\n\r\nВы ранее оформляли заказ №%bill_id%, но оплата за него пока что не поступала.\r\n\r\nПожалуйста, просмотрите информацию о выписанном счёте и при необходимости - произведите оплату.\r\n\r\nИнформация:\r\n\r\nСчёт выписан: %date%\r\nСумма: %sum%\r\n\r\nСсылка на оплату: %pay_link%\r\n\r\nПостоянная ссылка для отслеживания состояния Вашего заказа:\r\n%status_link%\r\n\r\nВсего Вам наилучшего.\r\n\r\n---\r\n%site_title%\r\n%site_url%\r\n\r\nОтказаться от получения напоминаний:\r\n%unsub%', 'plain', 1),
('bill_notify_2', 'Второе напоминание о неоплаченном счёте', 'У вас имеется неоплаченный счёт', 'Здравствуйте.\r\n\r\nВы ранее оформляли заказ №%bill_id%, но оплата за него пока что не поступала.\r\n\r\nПожалуйста, просмотрите информацию о выписанном счёте и при необходимости - произведите оплату.\r\n\r\nИнформация:\r\n\r\nСчёт выписан: %date%\r\nСумма: %sum%\r\n\r\nСсылка на оплату: %pay_link%\r\n\r\nПостоянная ссылка для отслеживания состояния Вашего заказа:\r\n%status_link%\r\n\r\nВсего Вам наилучшего.\r\n\r\n---\r\n%site_title%\r\n%site_url%\r\n\r\nОтказаться от получения напоминаний:\r\n%unsub%', 'plain', 1),
('aff_notify', 'Уведомление партнёру о начислении комиссионных', '%name%, Вам начислены комиссионные за участие в партнёрской программе', 'Здравствуйте, %name%!\r\n\r\nПо Вашей партнёрской ссылке была совершена продажа и Вам зачислены комиссионные.\r\n\r\nНазвание товара: \"%good_title%\"\r\n\r\nE-mail покупателя: %client_mail%\r\nНомер счёта: %bill_id%\r\n\r\nВаше вознаграждение: %komis% руб.\r\n\r\nВойти в Ваш партнёрский аккаунт для просмотра статистики Вы можете здесь:\r\n\r\n%bu%aff/login\r\n\r\nВаш логин: %refid%\r\n\r\nКомиссионные для следующих продаж этого товара: %newkomis%\r\n\r\nКомиссионные будут выплачены Вам в срок, установленный автором. О выплате комиссионных Вы получите отдельное уведомление.\r\n\r\n--\r\nP.S. Вы получили это письмо, так как являетесь участником партнёрской программы сайта:\r\n\r\n%site_title%\r\n%site_url%', 'plain', 1),
('paff_notify', 'Уведомление партнёру 2-го уровня', '%name%, Вам начислены комиссионные 2-го уровня за участие в партнёрской программе', 'Здравствуйте, %name%!\r\n\r\nЗарегистрированный по Вашей партнёрской ссылке партнёр, привлёк покупателя. Совершена продажа и Вам зачислены комиссионные 2-го уровня.\r\n\r\nНазвание товара: \"%good_title%\"\r\n\r\nЛогин приведённого Вами партнёра: %prefid%\r\n\r\nВаше вознаграждение: %komis% руб.\r\n\r\nВойти в Ваш партнёрский аккаунт для просмотра статистики Вы можете здесь:\r\n\r\n%bu%aff/login\r\n\r\nВаш логин: %refid%\r\n\r\nКомиссионные будут выплачены Вам в срок, установленный автором. О выплате комиссионных Вы получите отдельное уведомление.\r\n\r\n--\r\nP.S. Вы получили это письмо, так как являетесь участником партнёрской программы сайта:\r\n\r\n%site_title%\r\n%site_url%', 'plain', 1),
('author_sell', 'Для автора - уведомление о совершении продажи', '%name%, совершена продажа Вашего продукта', 'Здравствуйте, %name%!\r\n\r\nСовершена продажа Вашего продукта и Вам начислено авторское вознаграждение.\r\n\r\nНазвание товара: \"%good_title%\"\r\n\r\nСумма, оплаченная за товар: %sum%.\r\nВаше вознаграждение: %komis% руб.\r\n\r\nНомер счёта: %bill_id%\r\nНомер заказа: %order_id%\r\n\r\n==========================================\r\n Данные покупателя\r\n==========================================\r\n\r\n Email: %cmail%\r\n \r\n Фамилия: %surname%\r\n Имя: %cname%\r\n Отчество: %otchestvo%\r\n\r\n Страна: %strana%\r\n Область/регион: %region%\r\n Город: %gorod%\r\n Почтовый индекс: %postindex%\r\n Адрес: %address%\r\n\r\n Телефон: %phone%\r\n\r\n==========================================\r\n\r\nВойти в Ваш авторский аккаунт для просмотра статистики Вы можете здесь:\r\n\r\n%bu%author/\r\n\r\nВаш логин: %login%\r\n\r\nВознаграждение будет выплачено Вам в срок, установленный администратором. О выплате вознаграждения Вы получите отдельное уведомление.\r\n\r\nВсего наилучшего!\r\n--\r\n%site_title%\r\n%site_url%', 'plain', 1),
('bill_error', 'Ошибка при оплате несуществующего или оплаченного счёта', 'Возможно произошла ошибка при оплате счёта', 'Здравствуйте.\r\n\r\nВозможно произошла ошибка при оплате счёта %bill_id%.\r\n\r\nПричина: %error%\r\n\r\nПроверьте поступления средств по данному счёту и при необходимости сделайте ручное зачисление.\r\n\r\nМожет быть это и не ошибка, а всего лишь повторное оповещение от платёжной системы - но рекомендуется проверить разделы \"Счета\" и \"Клиенты\" - всё ли в порядке по данному счёту.\r\n\r\n--\r\nСистема Order Master 2\r\n\r\n', 'plain', 1),
('mobile', 'Для Администратора на мобильный', 'PAID', 'Oplachen %bill_id% ID %good_id% Summa %cena% %valuta% refid \'%refid%\' email: %email%', 'plain', 1),
('nalozh_after', 'Клиенту после поступления денег от наложенного платежа', '%name%, Ваша оплата (по наложенному платежу) получена', 'Здравствуйте, %name%!\r\n\r\nВы ранее заказывали товар с оплатой наложенным платежом (при получении на почте):\r\n\r\n\"%good_title%\"\r\n\r\nЭто письмо просто уведомляет Вас о том, что оплата успешно получена продавцом и зачислена.\r\n\r\nСпасибо.\r\n\r\nP.S. Данное письмо носит информационный характер, отвечать на него не нужно.\r\n\r\n--\r\n%site_title%\r\n%site_url%', 'plain', 1),
('admin_nalozh_cross', 'Админу, когда добавился заказ к счёту (кроссел)', 'К счёту %bill_id% добавлен заказ номер %order_id%', 'Здравствуйте.\r\n\r\nПользователь воспользовался специальным предложением после заказа наложенным платежом.\r\n\r\nК счёту %bill_id% добавлен заказ на один товар:\r\n\r\nID товара: %good_id%\r\nНазвание товара: %good_title%\r\nНомер заказа: %order_id%\r\n\r\nСсылка на статус заказа:\r\n%status_link%\r\n\r\nПросмотреть в панели администратора данный счёт:\r\n%admin_link%\r\n\r\nВсего наилучшего.\r\n\r\n---\r\nСистема Order Master 2', 'plain', 1),
('area_long', 'Пользователь продлил закрытую зону', 'Вы продлили доступ к Закрытой Зоне', 'Здравствуйте.\r\n\r\nВы продлили доступ к Закрытой зоне.\r\nТеперь она действует до %till% (для обновления информации - войдите заново в Закрытую Зону)\r\n\r\nВаши данные для входа:\r\nЛогин: %username%\r\nПароль: %password%\r\n\r\nСсылка:\r\n%bu%area\r\n\r\nВсего наилучшего.', 'plain', 1),
('admin_ebook', 'Для Админа уведомление об оплате', 'Счёт оплачен', 'Здравствуйте.\r\n\r\nСчёт №%bill_id% оплачен и товар(ы) отправлен(ы) покупателю.\r\n\r\nСтатус счёта:\r\n%status_link%\r\n\r\nСсылка на счёт в Панели Администратора:\r\n%admin_link%\r\n\r\nДанные об этом счёте:\r\n\r\nID товара(ов):\r\n%good_id%\r\n\r\nСумма (с учётом скидки если есть): %sum%\r\nСумма в рублях: %rur% руб.\r\n\r\nИмя покупателя: %uname%\r\nE-mail покупателя: %email%\r\nАльтернативный E-mail покупателя: %amail%\r\nТелефон: %phone%\r\nКупон скидки: %kupon%\r\n\r\n%orders%\r\n\r\nКомиссионных партнёрам (всего): %komis% руб.\r\nАвторское вознаграждение: %akomis% руб.\r\n\r\nСпособ оплаты: %way%\r\n\r\nP.S. Если партнёрам положены комиссионные, то они зачислены и им отправлены соответствующие уведомления\r\n\r\nP.P.S. Для гарантии проверяйте эти сведения, войдя в Панель Администратора.\r\n\r\n--\r\nСистема Order Master 2', 'plain', 1),
('admin_disk', 'Для Админа о заказе физического товара', 'Счёт за физический товар(ы) оплачен', 'Здравствуйте.\r\n\r\nСчёт №%bill_id%, включающий физические товары - оплачен, теперь необходимо отправить товар покупателю.\r\n\r\nСтатус счёта:\r\n%status_link%\r\n\r\nСсылка на счёт в Панели Администратора:\r\n%admin_link%\r\n\r\nID товаров:\r\n%good_id%\r\n\r\nДанные для доставки:\r\n\r\nФамилия: %surname%\r\nИмя: %uname%\r\nОтчество: %otchestvo%\r\n\r\nСтрана: %strana%\r\nОбласть/Край: %region%\r\nПочтовый индекс: %postindex%\r\nГород: %gorod%\r\nАдрес: %address%\r\nТелефон: %phone%\r\nКомментарий к заказу: %comment%\r\n\r\n----------------------------\r\n\r\nДанные об этом счёте:\r\n\r\nСумма (с учётом скидки если есть): %sum%\r\nСумма в рублях: %rur% руб.\r\n\r\nE-mail покупателя: %email%\r\nАльтернативный E-mail покупателя: %amail%\r\nКупон скидки: %kupon%\r\n\r\nКомиссионных партнёрам (всего): %komis% руб.\r\nАвторское вознаграждение: %akomis% руб.\r\n\r\nСпособ оплаты: %way%\r\n\r\nP.S. Если партнёрам положены комиссионные, то они зачислены и им отправлены соответствующие уведомления\r\n\r\nP.P.S. Для гарантии проверяйте эти сведения, войдя в Панель Управления.\r\n\r\n--\r\nСистема Order Master 2', 'plain', 1),
('sent_nalozh', 'Пользователю отправлен заказ наложенным платежом', '%name%, Ваш заказ наложенным платежом отправлен', 'Здравствуйте, %name%.\r\n\r\nСделанный Вами заказ №%bill_id% отправлен наложенным платежом.\r\n\r\nНомер почтового отправления: %number%\r\n\r\nС помощью этого номера - на сайте Почты России Вы можете отследить путь данной посылки:\r\nhttp://russianpost.ru/rp/servise/ru/home/postuslug/trackingpo\r\n\r\nОбычно срок доставки посылок по России составляет 2-3 недели и зависит от расстояния, на которое идёт отправка.\r\n\r\nПосле того, как посылка поступит в Ваш город - Вам следует выкупить её в Вашем почтовом отделении.\r\n\r\nПостоянная ссылка с состоянием Вашего заказа:\r\n%status_link%\r\n\r\nВсего наилучшего.\r\n\r\n---\r\n%site_title%\r\n%site_url%', 'plain', 1),
('sent_prepaid', 'Отправлен предоплаченный физический товар', '%name%, Вам отправлена посылка с Вашим заказом', 'Здравствуйте, %name%.\r\n\r\nВаш заказ №%bill_id% был отправлен по почте.\r\n\r\nНомер почтового отправления: %number%\r\n\r\nС помощью этого номера - на сайте Почты России Вы можете отследить путь данной посылки:\r\nhttp://russianpost.ru/rp/servise/ru/home/postuslug/trackingpo\r\n\r\nОбычно срок доставки посылок по России составляет 2-3 недели - и зависит от расстояния, на которое идёт отправка.\r\n\r\nПостоянная ссылка с состоянием Вашего заказа:\r\n%status_link%\r\n\r\nВсего наилучшего.\r\n\r\n---\r\n%site_title%\r\n%site_url%', 'plain', 1),
('admin_nalozh_ok', 'Подтверждён наложенный платёж', 'Подтверждён наложенный платёж по счёту %bill_id%', 'Это системное уведомление от Order Master 2.\r\n\r\nПо счёту №%bill_id% наложенным платежом отмечено подтверждение оплаты заказа.\r\n\r\nСумма: %sum%\r\n\r\nE-mail: %email%\r\nДругой e-mail: %amail%\r\nТелефон: %phone%\r\nIP: %ip%\r\n\r\nКомментарий к заказу: %comment%\r\n\r\nАдрес доставки:\r\n\r\nФамилия: %surname%\r\nИмя: %uname%\r\nОтчество: %otchestvo%\r\n\r\nСтрана: %strana%\r\nОбласть/регион: %region%\r\nГород: %gorod%\r\nАдрес: %address%\r\nПочтовый индекс: %postindex%\r\n\r\nСсылка на отслеживание статуса:\r\n%status_link%\r\n\r\nСсылка для просмотра счёта в Панели Администратора:\r\n%admin_link%\r\n\r\nВсего наилучшего.\r\n\r\n---\r\n[Отправлено системой Order Master 2]', 'plain', 1),
('admin_odno', 'Админу заказ с одностраничника', 'Новый заказ товара %good_id%', 'Уведомление о новом заказе с одностраничника.\r\n\r\nИмя: %uname%\r\nТелефон: %phone%\r\n\r\nТовар: %good_id%\r\nСумма: %sum% %valuta%\r\n\r\nIP: %ip%\r\n\r\n--\r\nСистема Order Master 2', 'plain', 1),
('kurier_confirmed', 'Заказ с курьерской доставкой подтверждён', 'Ваш заказ курьерской доставкой подтверждён', 'Здравствуйте, %name%.\r\n\r\nВаш заказ курьерской доставкой успешно подтверждён.\r\nДоставка произойдёт в ближайшее время - в сроки, установленные продавцом.\r\n\r\nНомер счёта: %bill_id%\r\n\r\nПостоянная ссылка для отслеживания состояния Вашего заказа:\r\n%status_link%\r\n\r\n---\r\n%site_title%\r\n%site_url%', 'plain', 1),
('admin_kurier_confirmed', 'Администратору уведомление о заказе курьером', 'Подтверждён заказ №%bill_id% курьерской доставкой', 'Здравствуйте.\r\n\r\nОформлен и подтверждён заказ №%bill_id% курьерской с такими данными:\r\n\r\nСумма: %sum%\r\nКупон скидки (если есть): %cupon%\r\n\r\nE-mail: %email%\r\nДругой e-mail: %amail%\r\nТелефон: %phone%\r\nIP: %ip%\r\n\r\nКомментарий к заказу: %comment%\r\n\r\n===============================\r\n Содержимое заказа\r\n===============================\r\n\r\n%orders%\r\n===============================\r\n\r\nАдрес доставки:\r\n\r\nФамилия: %surname%\r\nИмя: %uname%\r\nОтчество: %otchestvo%\r\n\r\nСтрана: %strana%\r\nОбласть/регион: %region%\r\nГород: %gorod%\r\nАдрес: %address%\r\nПочтовый индекс: %postindex%\r\n\r\nДанный заказ подтверждён.\r\n\r\nСсылка на отслеживание статуса:\r\n%status_link%\r\n\r\nСсылка для просмотра счёта в Панели Администратора:\r\n%admin_link%\r\n\r\nВсего наилучшего.\r\n---\r\n[Отправлено системой Order Master 2]', 'plain', 1),
('kurier_confirm', 'Письмо с ссылкой подтверждения заказа курьером', 'Подтверждение заказа курьерской доставкой', 'Здравствуйте.\r\n\r\nВы оформили заказ курьерской доставкой:\r\n\r\nНомер счёта: %bill_id%\r\nСумма: %sum%\r\n\r\nЧтобы подтвердить данный заказ, следует перейти по ссылке:\r\n%nalozh_link%\r\n\r\nВНИМАНИЕ! Подтверждайте только в том случае, если Вы обязуетесь оплатить заказ, когда он будет доставлен Вам курьером. В противном случае - не нажимайте на ссылку и просто удалите данное письмо.\r\n\r\nПостоянная ссылка для отслеживания состояния Вашего заказа:\r\n%status_link%\r\n\r\nP.S. Если Вам письмо пришло по ошибке - просто проигнорируйте его, при необходимости - свяжитесь с администрацией сайта самостоятельно.\r\n---\r\n%site_title%\r\n%site_url%', 'plain', 1),
('admin_nalozh_notconfirmed', 'Администратору уведомление о НЕПОДТВЕРЖДЁННОМ заказе наложенным платежом', 'Оформлен, но не подтверждён ещё заказ №%bill_id% наложенным платежом', 'Здравствуйте.\r\n\r\nОформлен (но не подтверждён ещё) заказ №%bill_id% наложенным платежом с такими данными:\r\n\r\nСумма: %sum%\r\nКупон скидки (если есть): %cupon%\r\n\r\nE-mail: %email%\r\nДругой e-mail: %amail%\r\nТелефон: %phone%\r\nIP: %ip%\r\n\r\nКомментарий к заказу: %comment%\r\n\r\n===============================\r\n Содержимое заказа\r\n===============================\r\n\r\n%orders%\r\n===============================\r\n\r\nАдрес доставки:\r\n\r\nФамилия: %surname%\r\nИмя: %uname%\r\nОтчество: %otchestvo%\r\n\r\nСтрана: %strana%\r\nОбласть/регион: %region%\r\nГород: %gorod%\r\nАдрес: %address%\r\nПочтовый индекс: %postindex%\r\n\r\nДанный заказ ещё не подтверждён - требует подтверждения оператором или заказчиком по ссылке (если включено письмо).\r\n\r\nСсылка на отслеживание статуса:\r\n%status_link%\r\n\r\nСсылка для просмотра счёта в Панели Администратора:\r\n%admin_link%\r\n\r\nВсего наилучшего.\r\n---\r\n[Отправлено системой Order Master 2]', 'plain', 0),
('admin_kurier_notconfirmed', 'Администратору уведомление о НЕПОДТВЕРЖДЁННОМ заказе курьером', 'Оформлен, но не подтверждён ещё заказ №%bill_id% курьером', 'Здравствуйте.\r\n\r\nОформлен (но не подтверждён ещё) заказ №%bill_id% КУРЬЕРОМ с такими данными:\r\n\r\nСумма: %sum%\r\nКупон скидки (если есть): %cupon%\r\n\r\nE-mail: %email%\r\nДругой e-mail: %amail%\r\nТелефон: %phone%\r\nIP: %ip%\r\n\r\nКомментарий к заказу: %comment%\r\n\r\n===============================\r\n Содержимое заказа\r\n===============================\r\n\r\n%orders%\r\n===============================\r\n\r\nАдрес доставки:\r\n\r\nФамилия: %surname%\r\nИмя: %uname%\r\nОтчество: %otchestvo%\r\n\r\nСтрана: %strana%\r\nОбласть/регион: %region%\r\nГород: %gorod%\r\nАдрес: %address%\r\nПочтовый индекс: %postindex%\r\n\r\nДанный заказ ещё не подтверждён - требует подтверждения оператором или заказчиком по ссылке (если включено письмо).\r\n\r\nСсылка на отслеживание статуса:\r\n%status_link%\r\n\r\nСсылка для просмотра счёта в Панели Администратора:\r\n%admin_link%\r\n\r\nВсего наилучшего.\r\n---\r\n[Отправлено системой Order Master 2]', 'plain', 0),
('admin_new_ticket', 'Админу уведомление о новом тикете', 'Новый тикет %id%', 'Создан новый тикет %id%\r\n\Отправитель: %name%\r\n\Email отправителя: %email%\r\n\r\nТема письма: %subject%\r\n\r\nСодержание письма: %body%\r\n\r\nВыполните ответ: %bu%admin/support/tickets/id/1\r\n\r\n--\r\n\Система Order Master 2', 'plain', 1),
('admin_modify_ticket', 'Админу уведомление об изменении тикета', 'Тикет %id% изменён', 'Тикет %id% был изменён\r\n\Отправитель: %name%\r\n\Email отправителя: %email%\r\n\r\n\Тема письма: %subject%\r\n\r\Содержание письма: %body%\r\n\r\n\Выполните ответ: %bu%admin/support/tickets/id/1\r\n\r\n\--\r\n\Система Order Master 2', 'plain', 1);

DROP TABLE IF EXISTS `om_log`;
CREATE TABLE `om_log` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `date` int(11) DEFAULT NULL,
  `action` varchar(100) DEFAULT NULL,
  `user` varchar(100) DEFAULT NULL,
  `comment` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 /*!40101 DEFAULT CHARSET=utf8 */;

INSERT INTO `om_log` VALUES
(1, 1396959175, 'login', '1', 'Выполнен вход в админ-панель с логином admin IP-адрес 127.0.0.1');

DROP TABLE IF EXISTS `om_lookup`;
CREATE TABLE `om_lookup` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(128) NOT NULL,
  `code` varchar(100) NOT NULL,
  `type` varchar(128) NOT NULL,
  `position` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=70 /*!40101 DEFAULT CHARSET=utf8 */;

INSERT INTO `om_lookup` VALUES
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

DROP TABLE IF EXISTS `om_odno`;
CREATE TABLE `om_odno` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
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
  `visible` tinyint(4) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB /*!40101 DEFAULT CHARSET=utf8 */;

DROP TABLE IF EXISTS `om_order`;
CREATE TABLE `om_order` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `bill_id` bigint(20) NOT NULL,
  `good_id` varchar(255) NOT NULL,
  `createDate` int(11) NOT NULL,
  `cena` float NOT NULL,
  `valuta` varchar(255) NOT NULL,
  `partner_id` varchar(255) NOT NULL,
  `payDate` int(11) NOT NULL DEFAULT '0',
  `status_id` varchar(50) NOT NULL DEFAULT '',
  `country` varchar(255) NOT NULL,
  `kanal` varchar(255) NOT NULL DEFAULT 'default',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM /*!40101 DEFAULT CHARSET=utf8 */;

DROP TABLE IF EXISTS `om_page`;
CREATE TABLE `om_page` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `psevdo` varchar(100) NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `visible` tinyint(4) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB /*!40101 DEFAULT CHARSET=utf8 */;

DROP TABLE IF EXISTS `om_partner`;
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
  `way` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM /*!40101 DEFAULT CHARSET=utf8 */;

DROP TABLE IF EXISTS `om_partner_auto`;
CREATE TABLE `om_partner_auto` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `good_id` varchar(255) NOT NULL,
  `count` float NOT NULL,
  `komis` int(11) NOT NULL,
  `komis_type` varchar(5) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM /*!40101 DEFAULT CHARSET=utf8 */;

DROP TABLE IF EXISTS `om_partner_personal`;
CREATE TABLE `om_partner_personal` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `partner_id` varchar(255) NOT NULL,
  `good_id` varchar(255) NOT NULL,
  `komis` float NOT NULL,
  `komis_type_id` varchar(5) NOT NULL,
  `auto` tinyint(4) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM /*!40101 DEFAULT CHARSET=utf8 */;

DROP TABLE IF EXISTS `om_payout`;
CREATE TABLE `om_payout` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `kind` varchar(10) DEFAULT NULL,
  `date` int(11) DEFAULT NULL,
  `theid` varchar(255) DEFAULT NULL,
  `way` varchar(255) DEFAULT NULL,
  `sum` float DEFAULT NULL,
  `valuta` varchar(10) DEFAULT NULL,
  `rekv` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB /*!40101 DEFAULT CHARSET=utf8 */;

DROP TABLE IF EXISTS `om_pin`;
CREATE TABLE `om_pin` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `added` varchar(255) DEFAULT NULL,
  `pincat_id` int(11) NOT NULL,
  `code` text,
  `used` tinyint(4) NOT NULL DEFAULT '0',
  `email` varchar(255) DEFAULT NULL,
  `good_id` varchar(100) DEFAULT NULL,
  `client_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB /*!40101 DEFAULT CHARSET=utf8 */;

DROP TABLE IF EXISTS `om_pincat`;
CREATE TABLE `om_pincat` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `comment` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB /*!40101 DEFAULT CHARSET=utf8 */;

DROP TABLE IF EXISTS `om_plink`;
CREATE TABLE `om_plink` (
  `id` varchar(255) NOT NULL,
  `plink` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM /*!40101 DEFAULT CHARSET=utf8 */;

DROP TABLE IF EXISTS `om_queue`;
CREATE TABLE `om_queue` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `email` varchar(255) NOT NULL,
  `format` varchar(10) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `body` text NOT NULL,
  `priority` tinyint(4) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=677 /*!40101 DEFAULT CHARSET=utf8 */;

DROP TABLE IF EXISTS `om_rass`;
CREATE TABLE `om_rass` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) DEFAULT NULL,
  `good_id` varchar(100) DEFAULT NULL,
  `active` tinyint(4) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB /*!40101 DEFAULT CHARSET=utf8 */;

DROP TABLE IF EXISTS `om_rass_letter`;
CREATE TABLE `om_rass_letter` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `rass_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `hours` int(11) NOT NULL,
  `comment` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB /*!40101 DEFAULT CHARSET=utf8 */;

DROP TABLE IF EXISTS `om_rass_sub`;
CREATE TABLE `om_rass_sub` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `rass_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `letter_id` int(11) NOT NULL,
  `date` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB /*!40101 DEFAULT CHARSET=utf8 */;

DROP TABLE IF EXISTS `om_rass_user`;
CREATE TABLE `om_rass_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `rass_id` int(11) NOT NULL,
  `uname` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `sub` tinyint(4) NOT NULL DEFAULT '1',
  `date` int(11) DEFAULT NULL,
  `unsubdate` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB /*!40101 DEFAULT CHARSET=utf8 */;

DROP TABLE IF EXISTS `om_s`;
CREATE TABLE `om_s` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `date` int(11) DEFAULT NULL,
  `sb` varchar(100) DEFAULT NULL,
  `clicks` bigint(20) DEFAULT NULL,
  `p_id` varchar(100) DEFAULT NULL,
  `good_id` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB /*!40101 DEFAULT CHARSET=utf8 */;

DROP TABLE IF EXISTS `om_session`;
CREATE TABLE `om_session` (
  `id` char(32) NOT NULL,
  `expire` int(11) DEFAULT NULL,
  `data` text,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM /*!40101 DEFAULT CHARSET=utf8 */;

DROP TABLE IF EXISTS `om_settings`;
CREATE TABLE `om_settings` (
  `id` varchar(255) NOT NULL,
  `value` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM /*!40101 DEFAULT CHARSET=utf8 */;

INSERT INTO `om_settings` VALUES
('staffOn', '1'),
('staffBaseOn', '1'),
('affAllTrusted', '0'),
('adminEmail', 'my-email@domain.com'),
('adminName', 'Администратор'),
('sysEmail', 'sys-email@domain.com'),
('affCountry', '1'),
('affCity', '1'),
('affUrl', '1'),
('affAbout', '1'),
('affMaillist', '1'),
('affWmz', '1'),
('affWmr', '1'),
('affRbk', '0'),
('affYandex', '1'),
('affZpayment', '1'),
('affFrom', '1'),
('catalogOn', '1'),
('catalogPerPage', '5'),
('affLast', '1'),
('usualCartOn', '1'),
('affLink', ''),
('affShared', '1'),
('staffUploadOn', '1'),
('mailType', 'mail'),
('mailHost', 'smtp.mail.ru'),
('mailPort', '2525'),
('mailUsername', ''),
('mailPassword', ''),
('mailLimit', '50'),
('kursUsd', '66'),
('kursEur', '75'),
('kursUah', '3'),
('kursAuto', '0'),
('kursAutoMul', '1.03'),
('staffUploadExt', 'bmp, gif, jpg, png, zip, rar, csv, doc, docx, txt, pdf'),
('staffUploadMax', '1024'),
('staffPagination', '30'),
('siteName', 'Имя проекта'),
('siteUrl', 'https://google.com/'),
('staffBasePagination', '30'),
('staffBaseCategoryPage', '20'),
('phoneDisk', '1'),
('phoneEbook', '0'),
('areaPerPage', '20'),
('mobile', ''),
('copyEmail', ''),
('payWebmoneyOn', '0'),
('payWmz', ''),
('payWmr', ''),
('payWme', ''),
('payWmu', ''),
('payWebmoneyKey', ''),
('payRbkmoneyId', ''),
('payRbkmoneyOn', '0'),
('payRbkmoneyKey', ''),
('payRoboxOn', '0'),
('payRoboxLogin', ''),
('payRoboxPass1', ''),
('payRoboxPass2', ''),
('payRoboxValuta', 'usd'),
('payZpaymentOn', '0'),
('payZpaymentId', ''),
('payZpaymentKey', ''),
('pay2checkoutOn', '0'),
('pay2checkoutId', ''),
('pay2checkoutKey', ''),
('paySmsOn', '0'),
('paySmsId', ''),
('paySmsKey', ''),
('paySmsCost', '0'),
('payInterkassaOn', '0'),
('payInterkassaId', ''),
('payInterkassaKey', ''),
('paySprypayOn', '0'),
('paySprypayId', ''),
('paySprypayKey', ''),
('payLiqpayOn', '0'),
('payLiqpayId', ''),
('payLiqpayKey', ''),
('payLiqpayPhone', ''),
('payPosOn', ''),
('payPosId', ''),
('payPosKey', ''),
('payW1On', '0'),
('payW1Id', ''),
('payW1Key', ''),
('paySmsUrl', 'http://bank.smscoin.com/bank/'),
('payPaypalOn', '0'),
('payPaypalEmail', ''),
('payPaypalKey',''),
('payQiwiOn','0'),
('payQiwiId',''),
('payQiwiPass',''),
('payPayeerOn','0'),
('payPayeerId',''),
('payPayeerKey',''),
('payOnpayOn','0'),
('payOnpayId',''),
('payOnpayKey',''),
('payPayonlineOn','0'),
('payPayonlineId',''),
('payPayonlineKey',''),
('payYandexOn','0'),
('payYandexAccount', ''),
('payYandexKey', ''),
('payYandexkassaOn','0'),
('payYandexkassaShopId', ''),
('payYandexkassaShopPassword', ''),
('payYandexkassaScId', ''),
('affIp', '0'),
('affMin', '0'),
('anewPerPage', '3'),
('affNewsOn', '0'),
('adminAffPerPage', '25'),
('checkBlack', '1'),
('adminPage', '30'),
('adminPgBill', '30'),
('adminPgOrder', '30'),
('adminPgGood', '30'),
('adminPgAreaFile', '30'),
('adminPgAreaUser', '30'),
('adminPgPayout', '30'),
('adminPgAffnew', '30'),
('adminPgAd', '30'),
('supportLetter', '0'),
('adminPgClient', '30'),
('adminPgCupon', '30'),
('adminPgClick', '50'),
('nalozhCountries', 'Россия,Украина'),
('firstWay', '1'),
('crossLimit', '20'),
('nalozhEmail', '1'),
('securebookUrl', 'http://example.com/sbkey/request.php?email=*email*&alias=*id*&pass=мой_ключ&licenseCount=1'),
('cronWord', ''),
('cronLast', '0'),
('cronKurs', '0'),
('cronKursRate', '1440'),
('cronRass', '0'),
('mailInterval', '20'),
('cronNotify', '0'),
('notifyOn', '0'),
('notifyLimit', '10'),
('notifyInterval', '60'),
('notifyFirst', '3'),
('notifySecond', '8'),
('dv', 'rur'),
('logsendgood', '1'),
('logon', '1'),
('lognewclient', '1'),
('lognewpartner', '1'),
('logneworder', '1'),
('lognewpay', '1'),
('logpin', '1'),
('lognewchange', '1'),
('logpartner', '1'),
('logauthor', '1'),
('logpaypartner', '1'),
('logpayauthor', '1'),
('lognewrass', '1'),
('logsendmail', '1'),
('loglogin', '1'),
('staffReverse', '1'),
('staffFullAccess', '1'),
('staffAutoClose', '1'),
('nalozhManual', '1');

DROP TABLE IF EXISTS `om_shorten`;
CREATE TABLE `om_shorten` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `partner_id` varchar(100) NOT NULL,
  `description` varchar(50) NOT NULL,
  `url` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM /*!40101 DEFAULT CHARSET=utf8 */;

DROP TABLE IF EXISTS `om_special`;
CREATE TABLE `om_special` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `good_id` varchar(100) DEFAULT NULL,
  `newgood_id` varchar(100) DEFAULT NULL,
  `sum` float DEFAULT NULL,
  `valuta` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB /*!40101 DEFAULT CHARSET=utf8 */;

DROP TABLE IF EXISTS `om_staff`;
CREATE TABLE `om_staff` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `firstName` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `lastLogin` int(11) NOT NULL DEFAULT '0',
  `lastLoginIp` varchar(100) NOT NULL DEFAULT '127.0.0.1',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 /*!40101 DEFAULT CHARSET=utf8 */;

INSERT INTO `om_staff` VALUES
(1, 'Администратор', 'admin@example.com', 'admin', '8b16313e35b9a789eca6d1b44a9d16d7', 1396959175, '127.0.0.1');

DROP TABLE IF EXISTS `om_staff_access`;
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
  `special` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM /*!40101 DEFAULT CHARSET=utf8 */;

INSERT INTO `om_staff_access` VALUES
(0, 'index,view', 'index', '', 'index,view', '', 'index,view,create,delete', '', '', '', 'index,tickets,view,update', '', '', '', 'Россия,Украина', '', '', '', '', '', '', '', '', '', '', '', '', '', '');

DROP TABLE IF EXISTS `om_ticket`;
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
  `file1` varchar(255) NOT NULL DEFAULT '',
  `file2` varchar(255) NOT NULL DEFAULT '',
  `file3` varchar(255) NOT NULL DEFAULT '',
  `file4` varchar(255) NOT NULL DEFAULT '',
  `updateTime` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM /*!40101 DEFAULT CHARSET=utf8 */;

DROP TABLE IF EXISTS `om_ticket_answer`;
CREATE TABLE `om_ticket_answer` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `ticket_id` varchar(255) NOT NULL,
  `kind` varchar(5) NOT NULL,
  `staff_id` int(11) NOT NULL,
  `message` text NOT NULL,
  `updateTime` int(11) NOT NULL,
  `ip` varchar(50) NOT NULL,
  `file1` varchar(255) NOT NULL DEFAULT '',
  `file2` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM /*!40101 DEFAULT CHARSET=utf8 */;

DROP TABLE IF EXISTS `om_ticket_section`;
CREATE TABLE `om_ticket_section` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `default_staff_id` int(11) NOT NULL,
  `position` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM /*!40101 DEFAULT CHARSET=utf8 */;

DROP TABLE IF EXISTS `om_way`;
CREATE TABLE `om_way` (
  `way_id` varchar(100) NOT NULL DEFAULT '',
  `title` varchar(255) DEFAULT NULL,
  `code` text,
  PRIMARY KEY (`way_id`)
) ENGINE=MyISAM /*!40101 DEFAULT CHARSET=utf8 */;

INSERT INTO `om_way` VALUES
('cardm', 'Карта VISA (вручную)', '<h4>Перевод на карту VISA (вручную)</h4>\r\n<div class=\"payimg\"><img src=\"{bu}images/front/bill/checkout.jpg\"></div><br>\r\n<div>Распечатайте реквизиты для перевода на счёт карты VISA через Сбербанк:</div>\r\n<script language=\"javascript\">\r\n$(function(){\r\n    $(\'#print_button\').click(function(){\r\n        var html_to_print=$(\'#to_print\').html();\r\n        var iframe=$(\'<iframe id=\"print_frame\">\');\r\n        $(\'body\').append(iframe);\r\n        var doc = $(\'#print_frame\')[0].contentDocument || $(\'#print_frame\')[0].contentWindow.document;\r\n        var win = $(\'#print_frame\')[0].contentWindow || $(\'#print_frame\')[0];\r\n        doc.getElementsByTagName(\'body\')[0].innerHTML=html_to_print;\r\n        win.print();\r\n        $(\'iframe\').remove();\r\n    });\r\n});\r\n</script>\r\n<style type=\"text/css\">\r\ntable#print {\r\n    width: 500px;\r\n}\r\n#print_button {\r\n    text-align: center;\r\n    text-decoration: underline;\r\n    cursor: pointer;\r\n}\r\n#print_frame{\r\n    display: none;\r\n}\r\n</style>\r\n<div id=\"to_print\">\r\n<table border=\"1\" cellpadding=\"0\" cellspacing=\"0\" id=\"print\">\r\n  <tr>\r\n    <td>Получатель<font color=\"#ff0000\">*</font>:</td>\r\n    <td><strong>{ФИО получателя}</strong></td>\r\n  </tr>\r\n  <tr>\r\n    <td>Номер счёта<font color=\"#ff0000\">*</font>:</td>\r\n    <td><strong>{номер счёта}</strong></td>\r\n  </tr>\r\n  <tr>\r\n    <td>ИНН:</td>\r\n    <td><strong>{ИНН}</strong></td>\r\n  </tr>\r\n  <tr>\r\n    <td>Адрес:</td>\r\n    <td><strong>{адрес}</strong></td>\r\n  </tr>\r\n  <tr>\r\n    <td>Наименование банка получателя<font color=\"#ff0000\">*</font>:</td>\r\n    <td><strong>{банк}</strong></td>\r\n  </tr>\r\n  <tr>\r\n    <td>БИК<font color=\"#ff0000\">*</font>:</td>\r\n    <td><strong>{БИК}</strong></td>\r\n  </tr>\r\n  <tr>\r\n    <td>Корреспондентский счёт:</td>\r\n    <td><strong>{кор.счёт}</strong></td>\r\n  </tr>\r\n  <tr>\r\n    <td>КПП:</td>\r\n    <td><strong>{КПП}</strong></td>\r\n  </tr>\r\n  <tr>\r\n    <td>ИНН:</td>\r\n    <td><strong>{ИНН}</strong></td>\r\n  </tr>\r\n  <tr>\r\n    <td>ОКПО:</td>\r\n    <td><strong>{ОКПО}</strong></td>\r\n  </tr>\r\n  <tr>\r\n    <td>ОГРН:</td>\r\n    <td><strong>{ОГРН}</strong></td>\r\n  </tr>\r\n  <tr>\r\n    <td>Юридический адрес банка:</td>\r\n    <td><strong>{адрес банка}</strong></td>\r\n  </tr>\r\n  <tr>\r\n    <td>Почтовый адрес банка:</td>\r\n    <td><strong>{почтовый адрес банка}</strong></td>\r\n  </tr>\r\n  <tr>\r\n    <td>Почтовый адрес доп. офиса:</td>\r\n    <td><strong>{почтовый адрес}</strong></td>\r\n  </tr>\r\n  <tr>\r\n    <td>Сумма платежа<font color=\"#ff0000\">*</font>:</td>\r\n    <td><strong>{rur} руб.</strong></td>\r\n  </tr>\r\n    <td>Назначение платежа<font color=\"#ff0000\">*</font>:</td>\r\n    <td><strong>Оплата услуг согласно СФ&nbsp;№{bill_id} от {date} без НДС</strong></td>\r\n  </tr>\r\n</table>\r\n<div><font color=\"#ff0000\">*</font> помечены обязательные поля.</div><br>\r\n</div>\r\n<div id=\"print_button\" title=\"Распечатать реквизиты\">Распечатать реквизиты</div><br>\r\n<div>Для совершения операций со счётом карты необходимо указать Вашу фамилию, имя, отчество полностью.</div><br>\r\n<div>По распечатанным реквизитам переведите {rur} руб. на счёт карты VISA через любой банк.</div><br>\r\n<div>После завершения оплаты перейдите по <a href=\"{notify_link}\" style=\"text-decoration: underline;\" target=\"_blank\" title=\"Уведомление об оплате счёта\">этой ссылке</a>, заполните форму и отправьте уведомление об оплате Администратору.</div>'),
('checkout', '2CheckOut', '<h4>Оплата кредитными картами (2CheckOut)</h4>\r\n<div class=\"payimg\"><img src=\"{bu}images/front/bill/checkout.jpg\"></div><br>\r\n<div>Чтобы перейти на сайт 2CO для оплаты кредитными картами или PayPal, нажмите:</div><br>\r\n<form action=\"https://www.2checkout.com/2co/buyer/purchase\" method=\"POST\" target=\"_blank\">\r\n  <input type=\"hidden\" name=\"sid\" value=\"{checkout_id}\">\r\n  <input type=\"hidden\" name=\"cart_order_id\" value=\"{checkout_num}\">\r\n  <input type=\"hidden\" name=\"total\" value=\"{usd}\">\r\n  <input type=\"hidden\" name=\"fixed\" value=\"Y\">\r\n  <input type=\"hidden\" name=\"demo\" value=\"N\">\r\n  <input type=\"hidden\" name=\"email\" value=\"{email}\">\r\n  <input type=\"hidden\" name=\"merchant_order_id\" value=\"{checkout_num}\">\r\n  <input type=\"hidden\" name=\"country\" value=\"RUS\">\r\n  <input type=\"hidden\" name=\"state\" value=\"XX\">\r\n<div class=\"paybtn\"><input id=\"subm\" class=\"submit\" type=\"submit\" value=\"Перейти к оплате {usd}$\"/></div>\r\n</form>'),
('interkassa', 'Интеркасса', '<h4>Оплата через Интеркассу</h4>\r\n<div class=\"payimg\"><img src=\"{bu}images/front/bill/iks.gif\"></div><br>\r\n<div>Оплата выбранным Вами способом будет происходить через посредника - компанию <b>&quot;Интеркасса&quot;</b>.</div><br>\r\n<div>Выберите удобный для Вас способ оплаты, заполните форму и следуйте дальнейшим инструкциям.</div><br>\r\n<div>Чтобы продолжить оплату, нажмите на кнопку:</div>\r\n<form accept-charset=\"UTF-8\" action=\"https://sci.interkassa.com/\" enctype=\"utf-8\" id=\"payment\" name=\"payment\" method=\"post\" target=\"_blank\">\r\n<input type=\"hidden\" name=\"ik_co_id\" value=\"{interkassa_id}\">\r\n<input type=\"hidden\" name=\"ik_pm_no\" value=\"{bill_id}\">\r\n<input type=\"hidden\" name=\"ik_am\" value=\"{rur}\">\r\n<input type=\"hidden\" name=\"ik_cur\" value=\"RUB\">\r\n<input type=\"hidden\" name=\"ik_desc\" value=\"Paybill #{bill_id} for {email}\">\r\n<div class=\"paybtn\"><input id=\"subm\" class=\"submit\" type=\"submit\" value=\"Перейти к оплате\"/></div>\r\n</form>'),
('liqpay', 'LiqPay', '<h4>Оплата через LiqPay</h4>\r\n<div class=\"payimg\"><img src=\"{bu}images/front/bill/liqpay.png\"></div><br>\r\n<div>Вы можете выполнить оплату со своего счёта в LiqPay или c кредитной карты.</div><br>\r\n<div>Чтобы продолжить, нажмите на кнопку:</div>\r\n<form accept-charset=\"utf-8\" action=\"https://www.liqpay.com/?do=clickNbuy\" method=\"POST\" target=\"_blank\">\r\n<input type=\"hidden\" name=\"operation_xml\" value=\"{liqpay_xml}\">\r\n<input type=\"hidden\" name=\"signature\" value=\"{liqpay_crc}\">\r\n<div class=\"paybtn\"><input id=\"subm\" class=\"submit\" type=\"submit\" value=\"Оплатить {usd}$\"></div>\r\n</form>'),
('paypal', 'PayPal', '<h4>Оплата с помощью PayPal</h4>\r\n\r\n<div class=\"payimg\">\r\n<img src=\"{bu}images/admin/pay/paypal.jpg\">\r\n</div>\r\n\r\n<br>\r\nЧтобы перейти к прямой оплате на сайте PayPal, нажмите:\r\n\r\n<form action=\"https://www.paypal.com/cgi-bin/webscr\" method=\"post\">\r\n <input name=\"cmd\" type=\"hidden\" value=\"_xclick\">\r\n <input name=\"business\" type=\"hidden\" value=\"{paypal_email}\">\r\n <input name=\"item_name\" type=\"hidden\" value=\"Oplata Scheta #{bill_id}\">\r\n <input name=\"item_number\" type=\"hidden\" value=\"{bill_id}\">\r\n <input name=\"amount\" type=\"hidden\" value=\"{rur}\">\r\n <input name=\"no_shipping\" type=\"hidden\" value=\"1\">\r\n <input name=\"rm\" type=\"hidden\" value=\"1\">\r\n <input name=\"return\" type=\"hidden\" value=\"{bu}f/ok\">\r\n <input name=\"cancel_return\" type=\"hidden\" value=\"{bu}f/fail\">\r\n <input name=\"currency_code\" type=\"hidden\" value=\"RUB\">\r\n <input name=\"notify_url\" type=\"hidden\" value=\"{bu}ps/paypal\">\r\n <input type=\"submit\" value=\"Платить через PayPal\">\r\n</form>'),
('payeer', 'Payeer', '<h4>Оплата через Payeer</h4>\r\n<div class=\"payimg\"><img src=\"{bu}images/front/bill/payeer.png\"></div><br>\r\n\<div>Чтобы оплатить Visa/MasterCard и другими способами через мерчант Payeer нажмите на кнопку ниже:</div><br>\r\n\<form action=\"{bu}ps/payeer\" method=\"post\" target=\"_blank\">\r\n\<input type=\"hidden\" name=\"bill_id\" value=\"{bill_id}\">\r\n\<input type=\"hidden\" name=\"crc\" value=\"{status_link}\">\r\n\<input type=\"submit\" value=\"Продолжить оплату\" />\r\n\</form>'),
('qiwi', 'QIWI Wallet', '<h4>Оплата с помощью Qiwi</h4>\r\n\r\n<div class=\"payimg\">\r\n<img src=\"{bu}images/admin/pay/qiwi.jpg\">\r\n</div>\r\n\r\n<br>\r\nЧтобы перейти к оплате с помощью Qiwi, введите Ваш номер Qiwi кошелька в международном формате - <b>+79991111111</b>:<br>&nbsp;<br>\r\n\r\n<form action=\"{qiwi_link}\" method=\"post\" target=\"_blank\">\r\n <input class=\"text\" type=\"text\" name=\"tel\" value=\"+\"><br>\r\n <input type=\"submit\" value=\"Оплата через Qiwi\">\r\n</form>'),
('rbkmoney', 'RBK Money', '<h4>Оплата через RBK Money</h4>\r\n<div class=\"payimg\"><img src=\"{bu}images/front/bill/rbkmoney.gif\"></div><br>\r\n<div>Оплата выбранным Вами способом будет происходить через посредника - компанию <b>ООО &quot;РБК Мани&quot;</b>.</div><br>\r\n<div>Выберите удобный для Вас способ оплаты, заполните форму и следуйте дальнейшим инструкциям.</div><br>\r\n<div>Чтобы продолжить оплату, нажмите на кнопку:<br>\r\n<form action=\"https://rbkmoney.ru/acceptpurchase.aspx\" method=\"POST\" target=\"_blank\">\r\n  <input type=\"hidden\" name=\"eShopId\" value=\"{rbkmoney_id}\">\r\n  <input type=\"hidden\" name=\"orderId\" value=\"{bill_id}\">\r\n  <input type=\"hidden\" name=\"serviceName\" value=\"Paybill #{bill_id} for {email}\">\r\n  <input type=\"hidden\" name=\"recipientAmount\" value=\"{rur}\">\r\n  <input type=\"hidden\" name=\"recipientCurrency\" value=\"RUR\">\r\n  <input type=\"hidden\" name=\"successUrl\" value=\"{bu}ps/rbkmoney/ok\">\r\n  <input type=\"hidden\" name=\"failUrl\" value=\"{bu}ps/rbkmoney/fail\">\r\n  <input type=\"hidden\" name=\"user_name\" value=\"{uname}\">\r\n  <input type=\"hidden\" name=\"user_email\" value=\"{email}\">\r\n<div class=\"paybtn\"><input id=\"subm\" class=\"submit\" type=\"submit\" value=\"Перейти к оплате\"/></div>\r\n</form>'),
('robox', 'ROBOKASSA', '<h4>Оплата через ROBOKASSA</h4>\r\n<div class=\"payimg\"><img src=\"{bu}images/front/bill/robokassa.png\"></div><br>\r\n<div>Чтобы произвести оплату различными электронными платежами через РобоКассу, нажмите на кнопку:</div><br>\r\n<form action=\"https://auth.robokassa.ru/Merchant/Index.aspx\" method=\"POST\" target=\"_blank\">\r\n<input type=\"hidden\" name=\"MrchLogin\" value=\"{robox_login}\">\r\n<input type=\"hidden\" name=\"OutSum\" value=\"{robox_sum}\">\r\n<input type=\"hidden\" name=\"InvId\" value=\"{robox_id}\">\r\n<input type=\"hidden\" name=\"Desc\" value=\"Oplata\">\r\n<input type=\"hidden\" name=\"SignatureValue\" value=\"{robox_crc}\">\r\n<input type=\"hidden\" name=\"Culture\" value=\"ru\">\r\n<input type=\"hidden\" name=\"Email\" value=\"{email}\">\r\n<div class=\"paybtn\"><input id=\"subm\" class=\"submit\" type=\"submit\" value=\"Перейти к оплате\"></div>\r\n</form><br>\r\n<div><font color=\"#cc0000\">Оплата этим способом требует бОльших затрат за оплату дополнительной комиссии!</font></div>'),
('sms', 'SMSCoin', '<h4>Оплата с помощью SMS</h4>\r\n<div class=\"payimg\"><img src=\"{bu}images/front/bill/smscoin.gif\"></div><br>\r\n<div>Оплата производится в долларах - <strong>{usd} USD</strong>.</div>\r\n<div>Чтобы перейти к инструкциям по отправке SMS, нажмите на кнопку:</div><br>\r\n<form action=\"{sms_url}\" method=\"POST\" target=\"_blank\">\r\n<input name=\"s_purse\" type=\"hidden\" value=\"{sms_id}\" />\r\n<input name=\"s_order_id\" type=\"hidden\" value=\"{bill_id}\" />\r\n<input name=\"s_amount\" type=\"hidden\" value=\"{usd}\" />\r\n<input name=\"s_clear_amount\" type=\"hidden\" value=\"{sms_cost}\" />\r\n<input name=\"s_description\" type=\"hidden\" value=\"Oplata scheta\" />\r\n<input name=\"s_sign\" type=\"hidden\" value=\"{sms_crc}\" />\r\n<div class=\"paybtn\"><input id=\"subm\" class=\"submit\" type=\"submit\" value=\"Перейти к оплате\"/></div>\r\n</form><br>\r\n<div><font color=\"#cc0000\">Внимание! Максимально допустимые тарифы за SMS <strong>не могут превышать 250 рублей</strong>! Если сумма Вашего заказа <strong>больше</strong> 250 руб, то оплата этим способом невозможна - список стран будет пустым.</font></div><br>\r\n<div><font color=\"#008000\">Оплата этим способом производится без комиссии (Комиссию платит продавец)!</font></div>'),
('sprypay', 'SpryPay', '<h4>Оплата через SpryPay</h4>\r\n<div class=\"payimg\"><img src=\"{bu}images/front/bill/sprypay.gif\"></div><br>\r\n<div>Оплата выбранным Вами способом будет происходить через посредника - <b>&quot;SpryPay&quot;</b>.</div><br>\r\n<div>Заполните форму и затем найдите выбранный Вами способ. Следуйте дальнейшим инструкциям.</div><br>\r\n<div>Чтобы продолжить оплату, нажмите на кнопку:</div><br>\r\n<form action=\"http://sprypay.ru/sppi/\" method=\"post\" target=\"_blank\">\r\n<input type=\"hidden\" name=\"spShopId\" value=\"{spry_id}\">\r\n<input type=\"hidden\" name=\"spShopPaymentId\" value=\"{bill_id}\">\r\n<input type=\"hidden\" name=\"spAmount\" value=\"{rur}\">\r\n<input type=\"hidden\" name=\"spCurrency\" value=\"rur\">\r\n<input type=\"hidden\" name=\"spPurpose\" value=\"Paybill {bill_id}\">\r\n<input type=\"hidden\" name=\"spUserEmail\" value=\"{email}\">\r\n<div class=\"paybtn\"><input id=\"subm\" class=\"submit\" type=\"submit\" value=\"Перейти к оплате\"/></div>\r\n</form>'),
('w1', 'Единая Касса W1', '<h4>Оплата через Единую Кассу (W1)</h4>\r\n\r\n<div class=\"payimg\">\r\n<img src=\"{bu}images/admin/pay/w1.jpg\">\r\n</div>\r\n\r\n<br>\r\nЧтобы перейти к выбору способа оплаты через Единую Кассу (W1), нажмите:\r\n\r\n\r\n<form method=\"post\" action=\"https://wl.walletone.com/checkout/checkout/Index\">\r\n  {w1_form}\r\n  <input type=\"submit\" value=\"Продолжить оплату\"/>\r\n</form>'),
('wmr', 'WebMoney R', '<h4>Оплата через WebMoney R</h4>\r\n<div class=\"payimg\"><img src=\"{bu}images/front/bill/webmoney.png\"></div><br>\r\n<div>Чтобы перейти к прямой оплате через Webmoney Merchant, нажмите на кнопку:</div><br>\r\n<form accept-charset=\"cp1251\" action=\"https://merchant.webmoney.ru/lmi/payment.asp\" method=\"POST\" target=\"_blank\">\r\n<input type=\"hidden\" name=\"LMI_PAYEE_PURSE\" value=\"{wmr}\">\r\n<input type=\"hidden\" name=\"LMI_PAYMENT_AMOUNT\" value=\"{rur}\">\r\n<input type=\"hidden\" name=\"LMI_PAYMENT_NO\" value=\"{bill_id}\">\r\n<input type=\"hidden\" name=\"LMI_PAYMENT_DESC\" value=\"Paybill #{bill_id} for {email}\">\r\n<div class=\"paybtn\"><input id=\"subm\" class=\"submit\" type=\"submit\" value=\"Оплатить {rur} WMR\"/></div>\r\n</form>'),
('wmz', 'WebMoney Z', '<h4>Оплата через WebMoney Z</h4>\r\n<div class=\"payimg\"><img src=\"{bu}images/front/bill/webmoney.png\"></div><br>\r\n<div>Чтобы перейти к прямой оплате через Webmoney Merchant, нажмите на кнопку:</div><br>\r\n<form accept-charset=\"cp1251\" action=\"https://merchant.webmoney.ru/lmi/payment.asp\" method=\"POST\" target=\"_blank\">\r\n<input type=\"hidden\" name=\"LMI_PAYEE_PURSE\" value=\"{wmz}\">\r\n<input type=\"hidden\" name=\"LMI_PAYMENT_AMOUNT\" value=\"{usd}\">\r\n<input type=\"hidden\" name=\"LMI_PAYMENT_NO\" value=\"{bill_id}\">\r\n<input type=\"hidden\" name=\"LMI_PAYMENT_DESC\" value=\"Paybill #{bill_id} for {email}\">\r\n<div class=\"paybtn\"><input id=\"subm\" class=\"submit\" type=\"submit\" value=\"Оплатить {usd} WMZ\"/></div>\r\n</form>'),
('wme', 'WebMoney E', '<h4>Оплата через WebMoney E</h4>\r\n<div class=\"payimg\"><img src=\"{bu}images/front/bill/webmoney.png\"></div><br>\r\n<div>Чтобы перейти к прямой оплате через Webmoney Merchant, нажмите на кнопку:</div><br>\r\n<form accept-charset=\"cp1251\" action=\"https://merchant.webmoney.ru/lmi/payment.asp\" method=\"POST\" target=\"_blank\">\r\n<input type=\"hidden\" name=\"LMI_PAYEE_PURSE\" value=\"{wme}\">\r\n<input type=\"hidden\" name=\"LMI_PAYMENT_AMOUNT\" value=\"{eur}\">\r\n<input type=\"hidden\" name=\"LMI_PAYMENT_NO\" value=\"{bill_id}\">\r\n<input type=\"hidden\" name=\"LMI_PAYMENT_DESC\" value=\"Paybill #{bill_id} for {email}\">\r\n<div class=\"paybtn\"><input id=\"subm\" class=\"submit\" type=\"submit\" value=\"Оплатить {eur} WME\"/></div>\r\n</form>'),
('wmu', 'WebMoney U', '<h4>Оплата через WebMoney U</h4>\r\n<div class=\"payimg\"><img src=\"{bu}images/front/bill/webmoney.png\"></div><br>\r\n<div>Чтобы перейти к прямой оплате через Webmoney Merchant, нажмите на кнопку:</div><br>\r\n<form accept-charset=\"cp1251\" action=\"https://merchant.webmoney.ru/lmi/payment.asp\" method=\"POST\" target=\"_blank\">\r\n<input type=\"hidden\" name=\"LMI_PAYEE_PURSE\" value=\"{wmu}\">\r\n<input type=\"hidden\" name=\"LMI_PAYMENT_AMOUNT\" value=\"{uah}\">\r\n<input type=\"hidden\" name=\"LMI_PAYMENT_NO\" value=\"{bill_id}\">\r\n<input type=\"hidden\" name=\"LMI_PAYMENT_DESC\" value=\"Paybill #{bill_id} for {email}\">\r\n<div class=\"paybtn\"><input id=\"subm\" class=\"submit\" type=\"submit\" value=\"Оплатить {uah} WMU\"/></div>\r\n</form>'),
('yandex', 'Яндекс.Деньги', '<h4>Оплата с помощью Яндекс.Деньги</h4>\r\n<div class=\"payimg\"><img src=\"{bu}images/admin/pay/yandex.png\"></div><br>\r\n<div>Чтобы перейти к прямой оплате на Сайте Яндекс.Деньги, нажмите:</div>\r\n\r\n\r\n<form method=\"POST\" action=\"https://money.yandex.ru/quickpay/confirm.xml\">\r\n<input type=\"hidden\" name=\"receiver\" value=\"{yandex_account}\">\r\n<input type=\"hidden\" name=\"formcomment\" value=\"Оплата счёта {bill_id}\">\r\n<input type=\"hidden\" name=\"short-dest\" value=\"Оплата счёта {bill_id}\">\r\n<input type=\"hidden\" name=\"label\" value=\"Oplata_scheta_{bill_id}\">\r\n<input type=\"hidden\" name=\"quickpay-form\" value=\"shop\">\r\n<input type=\"hidden\" name=\"targets\" value=\"Oplata_scheta_{bill_id}\">\r\n<input type=\"hidden\" name=\"sum\" value=\"{rur}\" data-type=\"number\">\r\n<p align=\"left\" style=\"margin-left: 30px; margin-top: 15px;\"><input type=\"radio\" name=\"paymentType\" value=\"PC\" checked> Яндекс.Деньгами</input></p>\r\n<p align=\"left\" style=\"margin-left: 30px; margin-top: 15px;\"><input type=\"radio\" name=\"paymentType\" value=\"AC\"> Банковской картой VISA/MasterCard</input> </p>\r\n<input style=\"margin-top: 18px;\" type=\"submit\" name=\"submit-button\" value=\"Продолжить оплату\">\r\n</form>'),
('yandexkassa', 'Яндекс.Касса', '<h4>Оплата через Яндекс.Кассу</h4>\r\n<div class=\"payimg\"><img src=\"{bu}images/front/bill/yandexkassa.png\"></div><br>\r\n<div>Чтобы оплатить Visa/MasterCard и другими способами через Яндекс.Кассу нажмите на кнопку ниже:</div><br>\r\n\<form action=\"{bu}ps/yandexkassa/form\" method=\"post\" target=\"_blank\">\r\n\<input type=\"hidden\" name=\"bill_id\" value=\"{bill_id}\">\r\n\<input type=\"hidden\" name=\"crc\" value=\"{status_link}\">\r\n\<input type=\"submit\" value=\"Продолжить оплату\" />\r\n\</form>'),
('zpay', 'Z-Payment', '<h4>Оплата через Z-Payment</h4>\r\n<div class=\"payimg\"><img src=\"{bu}images/front/bill/zpayment.gif\"></div><br>\r\n<div>Оплата выбранным Вами способом будет происходить через посредника - компанию <b>ООО &quot;Зет Паймент&quot;</b>.</div><br>\r\n<div>Выберите удобный для Вас способ оплаты, заполните форму и следуйте дальнейшим инструкциям.</div><br>\r\n<div>Чтобы продолжить оплату, нажмите на кнопку:</div>\r\n<form action=\"https://z-payment.ru/merchant.php\" id=\"pay_zpayment\" method=\"POST\" name=\"pay_zpayment\" target=\"_blank\">\r\n  <input type=\"hidden\" name=\"LMI_PAYEE_PURSE\" value=\"{zpay_id}\">\r\n  <input type=\"hidden\" name=\"LMI_PAYMENT_AMOUNT\" value=\"{rur}\">\r\n  <input type=\"hidden\" name=\"LMI_PAYMENT_NO\" value=\"{bill_id}\">\r\n  <input type=\"hidden\" name=\"LMI_PAYMENT_DESC\" value=\"Paybill #{bill_id} for {email}\">\r\n  <input type=\"hidden\" name=\"CLIENT_MAIL\" value=\"{email}\">\r\n<div class=\"paybtn\"><input id=\"subm\" class=\"submit\" type=\"submit\" value=\"Перейти к оплате\"/></div>\r\n</form>');

DROP TABLE IF EXISTS `om_way_list`;
CREATE TABLE `om_way_list` (
  `plist_id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `pic` varchar(255) NOT NULL,
  `url` varchar(255) NOT NULL,
  `ways` varchar(255) NOT NULL,
  `category` varchar(255) NOT NULL,
  `position` int(11) NOT NULL,
  `advanced` text NOT NULL,
  PRIMARY KEY (`plist_id`)
) ENGINE=MyISAM AUTO_INCREMENT=25 /*!40101 DEFAULT CHARSET=utf8 */;

INSERT INTO `om_way_list` VALUES
(1, 'Кредитные карты VISA/MasterCard/Maestro/American Express', 'card', '', 'zpay,liqpay,robox,yandex,checkout', 'Кредитные карты', 1, ''),
(2, 'WebMoney R (Рубли)', 'webmoney', 'https://www.webmoney.ru/', 'wmr', 'Электронные платежи', 11, ''),
(3, 'WebMoney Z (Доллары)', 'webmoney', 'https://www.webmoney.ru/', 'wmz', 'Электронные платежи', 12, ''),
(4, 'WebMoney E (Евро)', 'webmoney', 'https://www.webmoney.ru/', 'wme', 'Электронные платежи', 13, ''),
(5, 'WebMoney U (Гривны)', 'webmoney', 'https://www.webmoney.ru/', 'wmu', 'Электронные платежи', 14, ''),
(6, 'Яндекс.Деньги', 'yandex', 'https://money.yandex.ru/', 'yandex', 'Электронные платежи', 15, ''),
(7, 'Яндекс.Касса', 'yandex', 'https://kassa.yandex.ru/', 'yandexkassa', 'Электронные платежи', 16, ''),
(8, 'PayPal', 'paypal', 'https://www.paypal.com', 'paypal', 'Электронные платежи', 17, ''),
(9, 'Payeer', 'payeer', 'https://www.payeer.com/?partner=2471813', 'payeer', 'Электронные платежи', 18, ''),
(10, 'QIWI Wallet', 'qiwi', 'https://qiwi.com', 'qiwi', 'Электронные платежи', 19, ''),
(11, 'RBK Money', 'rbkmoney', 'http://rbkmoney.ru/', 'rbkmoney', 'Электронные платежи', 20, ''),
(12, 'Z-Payment', 'zpay', 'https://z-payment.com/', 'zpay', 'Электронные платежи', 21, ''),
(13, 'ROBOKASSA', 'robox', 'https://robokassa.ru/', 'robox', 'Электронные платежи', 22, ''),
(14, 'Интеркасса', 'interkassa', 'https://www.interkassa.com/', 'interkassa', 'Электронные платежи', 23, ''),
(15, 'LiqPay', 'liqpay', 'https://www.liqpay.com', 'liqpay', 'Электронные платежи', 24, ''),
(16, 'SpryPay', 'sprypay', 'http://sprypay.ru/', 'sprypay', 'Электронные платежи', 25, ''),
(17, 'Единая касса W1', 'w1', 'https://www.walletone.com/', 'w1', 'Электронные платежи', 26, ''),
(18, 'Сбербанк Online', 'sberbank', 'https://online.sberbank.ru/', 'sprypay,zpay', 'Банковские и другие переводы', 101, ''),
(19, 'Альфа-Клик', 'alfa', 'https://click.alfabank.ru', 'zpay,sprypay,robox', 'Банковские и другие переводы', 102, ''),
(20, 'Банковский перевод в России', 'bank', '', 'zpay,sprypay', 'Банковские и другие переводы', 103, ''),
(21, 'Почтовый перевод', 'post', 'https://www.pochta.ru/', 'sprypay,wmr', 'Банковские и другие переводы', 104, ''),
(22, 'ПриватБанк или другой украинский банк', 'privat', 'https://privatbank.ua/', 'liqpay', 'Банковские и другие переводы', 105, ''),
(23, 'Перевод по системе Юнистрим', 'unistream', 'https://www.unistream.ru/', 'zpay', 'Банковские и другие переводы', 106, ''),
(24, 'Перевод Western Union', 'wu', 'https://www.westernunion.ru/', 'zpay', 'Банковские и другие переводы', 107, ''),
(25, 'Перевод по системе Золотая Корона', 'zkorona', 'https://www.perevod-korona.com/', 'zpay', 'Банковские и другие переводы', 108, ''),
(26, 'Международные банковские переводы (USD, EUR)', 'wire', '', 'zpay,interkassa,liqpay', 'Банковские и другие переводы', 109, ''),
(27, 'На карту VISA (вручную)', 'card', '', 'cardm', 'Оплата вручную', 205, ''),
(28, 'Оплата наличными', 'nal', '', 'liqpay,sprypay,payeer', 'Прочие способы', 301, ''),
(29, 'SMS-сообщением', 'sms', 'https://smscoin.com/ru/', 'sms,payeer,zpay', 'Прочие способы', 302, ''),
(30, 'Терминалы приёма оплаты, банкоматы', 'terminal', '', 'wmr,liqpay', 'Прочие способы', 303, ''),
(31, 'Другие способы (выбор у посредников)', 'all', '', 'wmr,zpay,robox,interkassa,liqpay,sprypay', 'Прочие способы', 304, '');