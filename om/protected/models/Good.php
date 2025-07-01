<?php

/**
 * This is the model class for table "{{good}}".
 *
 * The followings are the available columns in table '{{good}}':
 * @property string $id
 * @property integer $category_id
 * @property string $title
 * @property string $description
 * @property string $image
 * @property integer $catalog_on
 * @property integer $position
 * @property double $price
 * @property string $currency
 * @property string $kind
 * @property integer $affOn
 * @property string $affLink
 * @property double $affKomis
 * @property string $affKomisType
 * @property double $affPkomis
 * @property string $affPkomisType
 * @property integer $affShow
 * @property integer $used
 * @property string $disabledWays
 * @property integer $securebook
 * @property string $getUrl
 * @property string $dlink
 * @property integer $author_id
 * @property integer $cartOn
 * @property string $cartGoods
 * @property double $cartMinus
 * @property integer $upsellOn
 * @property string $upsellGood
 * @property integer $upsellText
 * @property string $tupsellOn
 * @property string $tupsellGood
 * @property string $tupsellText
 * @property integer $csellOn
 * @property string $csellGood
 * @property string $csellText
 * @property string $cartText
 */
class Good extends CActiveRecord
{
        //Цена с учётом купона скидки
        public $newprice;
        public $rurcena;
	/**
	 * Returns the static model of the specified AR class.
	 * @return Good the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{good}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id, category_id, title, price, currency, kind, affOn,  affShow, used', 'required'),
                        array('disabledWays, securebook, getUrl, dlink, cartOn, cartGoods, cartMinus, upsellOn, upsellGood, upsellText, tupsellOn, tupsellGood, tupsellText, csellOn, csellGood, csellText, cartText, ads, affLink, affKomis, affKomisType, affPkomis, affPkomisType, description, image, catalog_on,letterSubject,letterType,letterText,nalozhOn,csell2,csell3,csell2g,csell3g,csellOk','safe'),
			array('category_id, catalog_on, position, affOn, affShow, used, securebook, cartOn, upsellOn, csellOn, authorKomis', 'numerical', 'integerOnly'=>true),
			array('price, affKomis, affOrder, affPkomis, cartMinus', 'numerical'),
			array('id, needid, sendid, author_id', 'length', 'max'=>100),
                        array('id','match', 'pattern' => '/^[0-9a-z]+$/', 'allowEmpty' => TRUE, 'message' => 'ID товара может содержать только маленькие английские буквы и/или цифры!'),
			array('title, image, affLink, getUrl, dlink, cartGoods, upsellGood, tupsellGood, csellGood', 'length', 'max'=>255),
			array('currency', 'length', 'max'=>3),
			array('kind, affKomisType, affPkomisType', 'length', 'max'=>5),
                        array('aukind, comvalue, kurier, kurstrany, kurgorod, comtitle','safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, category_id, title, description, image, catalog_on, position, price, currency, kind, affOn, affLink, affKomis, affKomisType, affPkomis, affPkomisType, affShow, used, disabledWays, securebook, getUrl, dlink, author_id, cartOn, cartGoods, cartMinus, upsellOn, upsellGood, upsellText, tupsellOn, tupsellGood, tupsellText, csellOn, csellGood, csellText, cartText', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'category_id' => 'Категория',
			'title' => 'Название',
			'description' => 'Описание',
			'image' => 'URL картинки',
			'catalog_on' => 'Показывать в каталоге',
			'position' => 'Позиция',
			'price' => 'Цена',
			'currency' => 'Валюта',
			'kind' => 'Тип товара',
			'affOn' => 'Включить партнёрку',
			'affLink' => 'Рекламный текст (URL)',
			'affKomis' => 'Комиссионные',
			'affKomisType' => 'Тип комиссионных',
			'affPkomis' => 'Комиссия 2 уровня',
			'affPkomisType' => 'Тип комиссии 2 уровня',
                        'authorKomis' => 'Авторский процент',
			'affShow' => 'Показывать партнёру',
			'used' => 'Товар активен',
			'disabledWays' => 'Отключённые способы',
			'securebook' => 'SecureBook',
			'getUrl' => 'URL доп. оповещения',
			'dlink' => 'Ссылка для скачивания',
			'author_id' => 'Автор',
			'cartOn' => 'Корзина включена',
			'cartGoods' => 'Товары в корзине',
			'cartMinus' => 'Скидка для корзины',
			'upsellOn' => 'Включить апселл',
			'upsellGood' => 'Товар для 1 уровня',
			'upsellText' => 'Текст апселла',
			'tupsellOn' => 'Включить апселл',
			'tupsellGood' => 'Товар для 2 уровня',
			'tupsellText' => 'Текст апселла',
			'csellOn' => 'Включить кроссел',
			'csellGood' => 'Товар для кроссела',
			'csellText' => 'Текст кроссела',
			'cartText' => 'Текст для корзины',
                        'ads' => 'Свои рекламные материалы',
                        'letterSubject' => 'Тема письма',
                        'letterType' => 'Формат письма',
                        'letterText' => 'Текст письма',
                        'sendid' => 'Отправлять также',
                        'needid' => 'Заказ только клиентам',
                        'comvalues' => 'Варианты "Комментарий"',
                        'comtitle' => 'Название "Комментарий"',
                        'aukind' => 'Тип % для автора',
                        'kurier' => 'Доставка курьером',
                        'kurstrany' => 'Страны для курьера',
                        'kurgorod' => 'Города для курьера',
                        'nalozhOn' => 'Наложенный платёж',
						'csell2g' => 'Товар кроссела 2',
						'csell2' => 'URL кроссела 2',
						'csell3g' => 'Товар кроссела 3',
						'csell3' => 'URL кроссела 3',
						'csellOk' => 'URL после всех',
                                                'affOrder' => 'За что комиссионные',
		
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id,true);
		$criteria->compare('category_id',$this->category_id);
		$criteria->compare('title',$this->title,true);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('image',$this->image,true);
		$criteria->compare('catalog_on',$this->catalog_on);
		$criteria->compare('position',$this->position);
		$criteria->compare('price',$this->price);
		$criteria->compare('currency',$this->currency,true);
		$criteria->compare('kind',$this->kind,true);
		$criteria->compare('affOn',$this->affOn);
		$criteria->compare('affLink',$this->affLink,true);
		$criteria->compare('affKomis',$this->affKomis);
		$criteria->compare('affKomisType',$this->affKomisType,true);
		$criteria->compare('affPkomis',$this->affPkomis);
		$criteria->compare('affPkomisType',$this->affPkomisType,true);
		$criteria->compare('affShow',$this->affShow);
                $criteria->compare('affOrder',$this->affOrder);
		$criteria->compare('used',$this->used);
		$criteria->compare('disabledWays',$this->disabledWays,true);
		$criteria->compare('securebook',$this->securebook);
		$criteria->compare('getUrl',$this->getUrl,true);
		$criteria->compare('dlink',$this->dlink,true);
		$criteria->compare('author_id',$this->author_id);
		$criteria->compare('cartOn',$this->cartOn);
		$criteria->compare('cartGoods',$this->cartGoods,true);
		$criteria->compare('cartMinus',$this->cartMinus);
		$criteria->compare('upsellOn',$this->upsellOn);
		$criteria->compare('upsellGood',$this->upsellGood,true);
		$criteria->compare('upsellText',$this->upsellText);
		$criteria->compare('tupsellOn',$this->tupsellOn,true);
		$criteria->compare('tupsellGood',$this->tupsellGood,true);
		$criteria->compare('tupsellText',$this->tupsellText,true);
		$criteria->compare('csellOn',$this->csellOn);
		$criteria->compare('csellGood',$this->csellGood,true);
		$criteria->compare('csellText',$this->csellText,true);
		$criteria->compare('cartText',$this->cartText,true);

		return new CActiveDataProvider(get_class($this), array(
			'criteria'=>$criteria,
                        'pagination' => array (
                            'pageSize' => Settings::item('adminPgGood'),
                        ),                    
                        'sort' => array (
                            'defaultOrder' => 'id ASC',
                        )
		));
	}

        //Проверка - нужна ли шапка с номерами шагов
        public function stepOk () {
            if ($this->upsellOn OR $this->tupsellOn OR $this->cartOn) {
                return TRUE;
            } else {
                return FALSE;
            }
        }
        
        
        //Функция возвращает список всех товаров
        public static function items ($empty = FALSE) {
            
            $goods = self::model()->findAll();
            
            if (!$goods) return array ();
            
            $ng = array ();           
            foreach ($goods as $one) {
                $ng[$one->id] = $one->title;
            }
            asort ($ng);
            
            if ($empty) {
                $ng = array_merge (array(''=>' '),$ng);
            }
            
            return $ng;
        }
        
        /*
         * Все товары + первый пункт *
         */
        public static function sitems ()
        {
            return array_merge (array ('*' => 'Все товары'),self::items());
        }
        
        /*
         * Функция высылает товар
         */
        public function sendGood ($uname, $email, $amail = '', $bill_id = 0, $way = FALSE)
        {
            
            $email = strtolower ($email);
            //Проверяем нужно ли добавление клиента            
            
            $c = Client::model()->find (
                    'email = :email AND good_id = :id',
                    array (
                        ':email' => $email,
                        ':id' => $this->id,
                    )
            );
            
            if (!$c) {
                
                //Добавляем клиента
                $c = new Client;
                $c->isNewRecord = TRUE;
                $c->good_id = $this->id;
                $c->uname = $uname;
                $c->email = $email;
                $c->date = time ();
                $c->subscribe = 1;
                if ($email != 'noemail@example.com') {
                    $c->save (FALSE);
                }
                
            }
            
            //Собственно отправка письма
            
            //Если для наложенного
            if ($way == 'Наложенный') {
                
                $d = array (
                    'good_title' => $this->title,
                );
                Mail::letter ('nalozh_after',$email,$uname,$d);
                
            } else {
            
                if ($this->kind=='area') {

                    //Для Закрытой зоны
                    //Добавляем пользователя                
                    Area::addUser ($this,$email,$uname,$amail,$bill_id);

                } else {
                    //Для обычного товара

                    //Подготовка переменных
                    $d = array (
                        'good_id' => $this->id,
                        'good_title' => $this->title,
                        'dlink' => $this->dlink,
                        'name' => $uname,
                        'email' => $email,
                        'bill_id' => $bill_id,
                        'site_title' => Settings::item('siteName'),
                        'site_url' => Settings::item('siteUrl')
                    );            

                    $subj = $this->letterSubject;
                    $text = $this->letterText;

                    //Выполняем замену
                    foreach ($d as $k=>$one) {
                        $subj = str_replace ('%'.$k.'%',$one,$subj);
                        $text = str_replace ('%'.$k.'%',$one,$text);
                    }

                    //Выполняем подстановку шифрованных ссылок
                    //Формат: [[12,newland.zip]]

                    //Проверяем или есть такие ссылки
                    if (preg_match_all ('/\[\[([\d]+,.+)\]\]/',$text,$ms)) {
                        //print_r ($ms);
                        $ms = $ms[0];
                        
                        foreach ($ms as $one) {                 
                            //$one=$one[0];                    
                            $ln = explode (',',str_replace('[[','',str_replace (']]','',$one)));
                            $text = str_replace ($one,self::codeLink ($ln[0],$ln[1]),$text);
                        }
                    }            
                    
                    
                    //Здесь происходит подстановка пин-кода
                    if (strpos ($text,'{PIN_')!==false) {
                        
                        $num1 = H::cut_str('{PIN_', '}', $text);
                        $all1 = '{PIN_'.$num1.'}';
                        
                        $pin = Pin::onepin($num1,$c->id);
                        
                        $text = str_replace ($all1,$pin,$text);
                        
                    }
                            

                    //Сообствено шлём письмо
                    Mail::send ($email,$uname,$subj,$text,$this->letterType);
                    
                    $logdata = 'Отправлен товар покупателю '.$email.' с именем "'.$uname.'"'."\r\n";
                    $logdata .= 'Тема письма: "'.$subj.'"'."\r\n";
                    $logdata .= 'Текст письма: '.$text."\r\n";
                    
                    Log::add ('sendgood',$logdata,true); //Запись в лог отправки сообщения                    
                    

                    //Если нужно копию - шлём копию на другой емайл
                    if (!empty ($amail)) {
                        Mail::send ($amail,$uname,$subj,$text,$this->letterType);
                    }
                    
                    //Подписываем на рассылку если надо
                    Rass::checkGood($this->id, $email, $uname);

                }
            }
            
            //Отправка оповещения SecureBook
            $sb = Settings::item('securebookUrl');
		
            if (strlen ($sb)>4 && ($this->securebook==1)) {
			$this->do_url($sb,$this->id,$email);
            }    
        
            //Отправка дополнительных оповещений
            if (!empty ($this->getUrl)) {
        	$this->do_url ($this->getUrl,$this->id,$email);
            }
            
            //Отправка дополнительного товара если задан
            if (!empty ($this->sendid)) {
                $gs = Good::model ()->findByPk ($this->sendid);
                if ($gs)
                {
                    $gs->sendGood ($uname, $email, $amail, $bill_id, $way);   
                }
                 
            }
            
        }
        
        /*
         * Функция создаёт зашированную ссылку
         */
        public static function codeLink ($count,$filename)
        {
            
            $a = array ();
            
            $a['f'] = $filename;
            $a['t'] = time ()+86400*$count; //Время
            $a['c'] = md5 ($filename.Y::param('secretKey').$a['t']);
            
            $link = trim (H::mcode_str (base64_encode(serialize($a))));
            
            $link = Y::bu().'download/file/id/'.$link.'.'.strtolower(end(explode(".", $filename)));
            
            return $link;
            
        }
        
        public static function decodeLink ($str) {
            
            $s = base64_decode (H::mdecode_str (reset (explode (".",$str))));
            
            $a = unserialize($s);
            
            if (!is_array($a)) die ('Bad link');
            
            //Проверяем CRC
            $crc = md5 ($a['f'].Y::param('secretKey').$a['t']);
            
            if ($crc !== $a['c']) die ('Bad link CRC');
            
            //Проверяем срок годности ссылки
            if (time()>$a['t']) die ('Sorry, this link has expired. Извините, данная ссылка уже просрочена.');
            
            //Возвращаем имя файла если всё впорядке
            return $a['f'];
            
        }
        
        private function do_url ($url,$id,$email) {
    	
            $url = str_replace ('*cmail*',H::mcode_str($email),$url);
            $url = str_replace ('*email*',$email,$url);
            $url = str_replace ('*id*',$id,$url);    	
    	
            //$url = urlencode($url);
    	
            return file_get_contents ($url);
    	
        }    
        

}