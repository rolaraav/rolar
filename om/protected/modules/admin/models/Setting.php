<?php

class Setting extends CFormModel
{
	
	public $_attrNames = array();
	public $_attrs = array();

	/**
	 * Declares the validation rules.
	 * The rules state that username and password are required,
	 * and password needs to be authenticated.
	 */
	public function rules()
	{
		return array(
			array('kursEur, kursUah, kursUsd, kursAutoMul, kursAuto', 'numerical'),

			array ('mailHost, mailType, mailPort, mailUsername, mailPassword','safe'),

                        array ('adminEmail, adminName, sysEmail, mobile, siteName, copyEmail, siteUrl, dv','safe'),
                        array ('adminEmail, sysEmail, mobile, copyEmail','email'),
                        array ('siteUrl','url'),

                        array ('staffOn, staffBaseOn, staffUploadOn, staffUploadExt, staffUploadMax, supportLetter, staffReverse, staffFullAccess, staffAutoClose','safe'),
			array ('mailLimit','numerical'),


                        //Webmoney
                        array ('payWebmoneyOn, payWmz, payWmr, payWmp, payWmu, payWme, payWebmoneyKey', 'safe'),

                        //RbkMoney
                        array ('payRbkmoneyId, payRbkmoneyOn, payRbkmoneyKey','safe'),

                        //Zpayment
                        array ('payZpaymentOn, payZpaymentId, payZpaymentKey','safe'),

                        //Robox
                        array ('payRoboxOn, payRoboxLogin, payRoboxPass1, payRoboxPass2, payRoboxValuta','safe'),

                        //2 checkout
                        array ('pay2checkoutOn, pay2checkoutId, pay2checkoutKey','safe'),

                        //Sms Coin
                        array ('paySmsOn, paySmsId, paySmsKey, paySmsUrl, paySmsCost','safe'),

                        //Interkassa
                        array ('payInterkassaOn, payInterkassaId, payInterkassaKey','safe'),
                        
                        //LiqPay
                        array ('payLiqpayOn, payLiqpayId, payLiqpayKey, payLiqpayPhone','safe'),

                        //SpryPay
                        array ('paySprypayOn, paySprypayId, paySprypayKey','safe'),

                        //Payeer
                        array ('payPayeerOn, payPayeerId, payPayeerKey','safe'),

                        //Payonline
                        array ('payPayonlineOn, payPayonlineId, payPayonlineKey','safe'),

                        //OnPay
                        array ('payOnPayOn, payOnPayId, payOnPayKey','safe'),

                        //Единая касса W1
                        array ('payW1On, payW1Id, payW1Key','safe'),

                        //Yandex
                        array ('payYandexOn, payYandexAccount, payYandexKey','safe'),

                        //Yandex Kassa
                        array ('payYandexkassaOn, payYandexkassaShopId, payYandexkassaShopPassword, payYandexkassaScId','safe'),

                        //Paypal
                        array ('payPaypalOn, payPaypalEmail, payPaypalKey','safe'),

                        //Qiwi
                        array ('payQiwiOn, payQiwiId, payQiwiPass','safe'),

                        //Партнёрка
                        array ('affIp, affShared, affLast, affMin, affLink, affWmz, affWmr, affYandex, affRbk, affZpayment','safe'),
                        array ('affCountry, affCity, affUrl, affMaillist, affAbout, affFrom, affNewsOn','safe'),
                    
                    
                        //Настройки для pagination
                        array ('adminPage, catalogPerPage, anewPerPage', 'safe'), 
                    
                        array ('adminPgBill, adminPgOrder, adminPgGood, adminPgAreaFile, adminPgAreaUser, adminPgPayout, adminPgAffnew,'.
                                'adminPgAd, adminPgClient, adminPgCupon, staffPagination, staffBasePagination, adminPgClick', 'safe'),
                    
                        array ('catalogOn,usualCartOn,phoneDisk,phoneEbook,checkBlack,nalozhCountries,firstWay,crossLimit,nalozhEmail,nalozhManual,securebookUrl,cronWord,cronKursRate,mailInterval,notifyOn,notifyLimit,notifyInterval,notifyNalozh,notifyPrepaid,notifyFirst,notifySecond,affAllTrusted','safe'),
                    
                    
                        array ('logon, logsendgood, lognewclient, lognewpartner, logneworder, lognewpay, logpin, lognewchange, logpartner, logauthor, logpaypartner, logpayauthor, lognewrass, logsendmail, loglogin', 'safe'), 
                    

		);
	}

	/**
	 * Declares attribute labels.
	 */
	public function attributeLabels()
	{
		return array(
			'kursUsd' => '1 доллар в рублях',
			'kursEur' => '1 евро в рублях',
			'kursUah' => '1 гривня в рублях',
			'kursAuto' => 'Включить',
			'kursAutoMul' => 'Умножить на',
			'dv' => 'Основная валюта',

			//Для раздела "Параметры почты"
			'mailType' => 'Способ отправки',
			'mailLimit' => 'Лимит писем за раз',
			'mailHost' => 'SMTP Хост',
			'mailPort' => 'SMTP порт',
			'mailUsername' => 'SMTP логин',
			'mailPassword' => 'SMTP пароль',

                        //Для раздела поддержка
                        'staffOn'      => 'Поддержка включена',
                        'staffBaseOn'  => 'База Знаний включена',
                        'staffUploadOn'  => 'Вложения разрешены',
                        'staffUploadExt' => 'Типы вложений',
                        'staffUploadMax' => 'Макс. размер (КБ)',
                        'supportLetter'  => 'Новый тикет - письмо',
                        'staffReverse' => 'Отображение ответов',
                        'staffFullAccess' => 'Доступ операторов',
                        'staffAutoClose' => 'Автозакрытие (часов)',                    

                        //Раздел "Мои данные"
                        'adminName' => 'Имя администратора',
                        'adminEmail' => 'E-mail администратора',
                        'sysEmail' =>  'E-mail для оповещения',
                        'copyEmail' =>  'E-mail для копий',
                        'mobile'    => 'Моб. e-mail (если есть)',
                        'siteName'  => 'Название проекта',
                        'siteUrl'   => 'URL проекта',

                        //Платёжные системы
                        //Настройки
                        'payWebmoneyOn' => 'Включить WebMoney',
                        'payWmz' => 'WMZ-кошелёк',
                        'payWmr' => 'WMR-кошелёк',
                        'payWmp' => 'WMP-кошелёк',
                        'payWme' => 'WME-кошелёк',
                        'payWmu' => 'WMU-кошелёк',
                        'payWebmoneyKey' => 'Секретный ключ',

                        'payRbkmoneyOn' => 'Включить RBK Money',
                        'payRbkmoneyId' => 'ID сайта',
                        'payRbkmoneyKey' => 'Секретное слово',

                        'payZpaymentOn' => 'Включить Z-payment',
                        'payZpaymentId' => 'ID магазина',
                        'payZpaymentKey' => 'Секретный ключ',

                        'payRoboxOn' => 'Включить Робокассу',
                        'payRoboxPass1' => 'Пароль #1',
                        'payRoboxPass2' => 'Пароль #2',
                        'payRoboxLogin' => 'Логин',
                        'payRoboxValuta' => 'Валюта продавца',

                        'pay2checkoutOn' => 'Включить 2CheckOut',
                        'pay2checkoutId' => 'Номер аккаунта',
                        'pay2checkoutKey' => 'Secret Word',
                    
                        'paySmsOn' => 'Включить SMS Coin',
                        'paySmsId' => 'ID смс:банка',
                        'paySmsUrl' => 'Адрес шлюза',
                        'paySmsKey' => 'Секретный ключ',
                        'paySmsCost' => 'Учитывать комиссию',

                        'payInterkassaOn' => 'Включить Интеркассу',
                        'payInterkassaId' => 'ID магазина',
                        'payInterkassaKey' => 'Секретный ключ',
                    
                        'payLiqpayOn' => 'Включить LiqPay',
                        'payLiqpayId' => 'ID мерчанта LiqPay',
                        'payLiqpayPhone' => 'Телефон в LiqPay',
                        'payLiqpayKey' => 'Ключ ("для прочих")',
                    
                        'paySprypayOn' => 'Включить SpryPay',
                        'paySprypayId' => 'ID магазина SpryPay',
                        'paySprypayKey' => 'Секретный ключ',

                        'payPayeerOn' => 'Включить Payeer',
                        'payPayeerId' => 'ID магазина Payeer',
                        'payPayeerKey' => 'Секретный ключ',

                        'payPayonlineOn' => 'Включить PayOnline',
                        'payPayonlineId' => 'ID магазина PayOnline',
                        'payPayonlineKey' => 'Секретный ключ',

                        'payOnpayOn' => 'Включить OnPay',
                        'payOnpayId' => 'ID магазина OnPay',
                        'payOnpayKey' => 'Секретный ключ OnPay',

                        'payYandexOn'   => 'Включить ЮMoney',
                        'payYandexAccount'  => '№ счёта ЮMoney',
                        'payYandexKey'  => 'Секретное слово',

                        'payYandexkassaOn'   => 'Включить ЮKassa',
                        'payYandexkassaShopId'  => 'ID магазина',
                        'payYandexkassaShopPassword'  => 'Пароль магазина',
                        'payYandexkassaScId'  => 'ID витрины',

                        'payPaypalOn'   => 'Включить Paypal',
                        'payPaypalEmail'  => 'E-mail в Paypal',
                        'payPaypalKey'  => 'Секретный ключ',

                        'payQiwiOn' => 'Включить Qiwi',
                        'payQiwiId' => 'ID магазина Qiwi',
                        'payQiwiPass' => 'API_ID:API_KEY',

                        'payW1On' => 'Включить W1',
                        'payW1Id' => 'ID магазина W1',
                        'payW1Key' => 'Ключ для проверки',

                        'affIp' => 'Блокировать похожие IP',
                        'affShared' => 'Общая реф-ссылка',
                        'affLink' => 'Описание партнёрки',
                        'affMin' => 'Мин. сумма для выплат',
                        'affLast' => 'Начислять комиссионные',
                        'affWmz' => 'Включить WebMoney Z',
                        'affWmr' => 'Включить WebMoney R',
                        'affYandex' => 'Включить ЮMoney',
                        'affZpayment' => 'Включить Z-Payment',
                        'affRbk' => 'Включить RBK Money',
                        'affCountry' => 'Поле "Страна"',
                        'affCity' => 'Поле "Город"',
                        'affUrl' => 'Поле "URL-сайта"',
                        'affMaillist' => 'Поле "Подписчиков"',
                        'affAbout' => 'Поле "О проекте"',
                        'affFrom' => 'Поле "Откуда узнали"',
                        'affNewsOn' => 'Показывать Новости',                    
                        'affAllTrusted' => 'Все видят e-mail',
                    
                        'adminPage' => 'Общее для админки',
                        'catalogPerPage' => 'Товаров в каталоге',
                        'anewPerPage' => 'Новостей в акке партнёра',
                    
                        'adminPgBill'       => 'Счета',
                        'adminPgOrder'       => 'Заказы',
                        'adminPgGood'       => 'Товары',
                        'adminPgAreaFile'       => 'Файлы закрытой зоны',
                        'adminPgAreaUser'       => 'Участники закрытой зоны',
                        'adminPgPayout'       => 'Выплаты',
                        'adminPgAffnew'       => 'Новости',
                        'adminPgAd'       => 'Промо-материалы',
                        'adminPgClient'       => 'Клиенты',
                        'adminPgCupon'       => 'Скидки',
                        'staffPagination'       => 'Поддержка',
                        'staffBasePagination'       => 'База знаний',
                        'adminPgClick' => 'Статистика кликов',
                    
                        'catalogOn' => 'Каталог включён',
                        'usualCartOn' => 'Традиционная корзина',
                        'phoneDisk' => 'Телефон для физич.',
                        'phoneEbook' => 'Телефон для цифр.',
                        'checkBlack' => 'Чёрный список',
                        'nalozhCountries' => 'Страны наложенного',
                        'firstWay' => 'Только один способ',
                        'crossLimit' => 'Лимит кроссела (мин)',
                        'nalozhEmail' => 'Активация по e-mail',
                        'nalozhManual' => 'Подтв. оператором',
                        'securebookUrl' => 'SecureBook кейген URL',
                        'cronWord' => 'Секретное слово Крона',
                        'cronKursRate' => 'Интервал курсов(мин)',
                        'mailInterval' => 'Интервал писем(мин)',
                        'notifyOn' => 'Включить письма',
                        'notifyLimit' => 'Напоминаний за раз',
                        'notifyInterval' => 'Интервал рассылки',
                        'notifyFirst' => '1-е письмо (дней)',
                        'notifySecond' => '2-е письмо (дней)',
                        'notifyPrepaid' => 'После предопл. (дней)',
                        'notifyNalozh' => 'После налож. (дней)',
                    
                        //Лог
                        'logon' => 'Включить журнал (лог)',
                        'logsendgood' => 'Выслан товар',
                        'lognewclient' => 'Добавлен клиент',
                        'lognewpartner' => 'Новый партнёр',
                        'logneworder' => 'Выписан счёт',
                        'lognewpay' => 'POST платёжных систем',
                        'logpin' => 'Использован PIN-код',
                        'lognewchange' => 'Изменён статус счёта',
                        'logpartner' => 'Начисление партнёру',
                        'logauthor' => 'Начисление автору',
                        'logpaypartner' => 'Выплата партнёру',
                        'logpayauthor' => 'Выплата автору',
                        'lognewrass' => 'Новая рассылка/серия',
                        'logsendmail' => 'Часть очереди писем',
                        'loglogin' => 'Вход в админ-панель',

		);

	}

	//Сохранение настроек в БД
	public function save ()
	{
		$tableName = '{{settings}}';

		$builder = Yii::app()->db->commandBuilder;

		foreach ($this->attributes as $key=>$value){
			$ar = array (
				'value' => $value
			);
			$criteria = new CDbCriteria;
			$criteria->condition = 'id=:id';
			$criteria->params = array (':id' => $key);

			$command = $builder->createUpdateCommand ($tableName,$ar,$criteria);
			$command->execute ();
		}

		return TRUE;

	}

	public function attributeNames()
	{
		return $this->_attrNames;
	}

	//Загрузка полей по умолчанию
	public function loadFields ()
	{
                $tableName = '{{settings}}';

		$command = new CDbCommand (Yii::app()->db,'SELECT * FROM '.$tableName);
		$res = $command->queryAll ();

		$attrs = array();
		$attrNames = array ();
		foreach ($res as $one){
			$attrs[$one['id']] = $one['value'];
			$attrNames[] = $one['id'];
		}

		$this->_attrNames = $attrNames;
		$this->_attrs = $attrs;
		$this->attributes = $attrs;

		return TRUE;
	}

	public function __get($name)
	{
		if(in_array($name, $this->_attrNames)) {
			return $this->_attrs[$name];
		} else {
			return parent::__get($name);
		}
	}

	public function __set($name, $value)
	{
		if(in_array($name, $this->_attrNames)) {
			return $this->_attrs[$name] = $value;
		} else {
			return parent::__set($name, $value);
		}
	}

}
