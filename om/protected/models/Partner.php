<?php

class Partner extends CActiveRecord
{
	public $verifyCode;
	public $passwordRepeat;
        public $notify = FALSE;
	public $way;

	/**
	 * Returns the static model of the specified AR class.
	 * @return Partner the static model class
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
		return '{{partner}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id, firstName, email, password, passwordRepeat', 'required'),
			array('password, passwordRepeat, rbkmoney, parent_id', 'length', 'max'=>100),
			array('firstName, email, country, from, city, url, aboutProject', 'length', 'max'=>255),
			array('id','length','max'=>32),
			array('id', 'filter', 'filter'=>'strtolower'),
			array ('email','email'),
			array ('url','url'),
			array ('id','match','pattern' => '/^[a-z0-9]{1,50}$/','message' => 'Недопустимые символы в RefID'),
			array('wmz, wmr', 'length', 'max'=>13),
			array('yandex', 'length', 'max'=>20),
			array('zpayment', 'length', 'max'=>14),
			array('maillist', 'length', 'max'=>30),
			array('passwordRepeat', 'compare', 'compareAttribute'=>'password'),
			array ('id', 'unique'),
			array ('trusted', 'numerical'),

			array('verifyCode', 'captcha', 'allowEmpty'=>((!extension_loaded('gd')) OR (!$this->isNewRecord))),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, firstName, email, password, wmz, wmr, rbkmoney, yandex, zpayment, country, maillist, from, parent_id, createTime, trusted, city, url, aboutProject, total, paid', 'safe', 'on'=>'search'),
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
                    'clickCount' => array(self::STAT, 'S', 'p_id', 'select'=> 'SUM(clicks)'),
                    'orderCount' => array(self::STAT, 'Affstats', 'partner_id'),
                    'partnerCount' => array(self::STAT, 'Partner', 'parent_id'),                    
                    'history' => array (self::HAS_MANY, 'Payout', 'theid', 'condition' => 'kind = "partner"', 'order' => 'date DESC'),
                    'partners' => array (self::HAS_MANY, 'Partner', 'parent_id'),
                    'lev2' => array (self::HAS_MANY, 'Affstats', 'prefid'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'RefID',
			'firstName' => 'Ваше имя',
			'email' => 'Ваш e-mail',
			'password' => 'Придумайте пароль',
			'passwordRepeat' => 'Пароль ещё раз',
			'wmz' => 'Webmoney Z',
			'wmr' => 'Webmoney R',
			'rbkmoney' => 'Счёт RBK Money',
			'yandex' => 'Кошелёк ЮMoney',
			'zpayment' => 'Кошелёк Z-Payment',
			'country' => 'Страна',
			'maillist' => 'Подписчиков (если есть)',
			'from' => 'Откуда Вы узнали о сайте',
			'parent_id' => 'Партнёр 2-го уровня',
			'createTime' => 'Дата регистрации',
			'updateTime' => 'Последнее изменение',
			'trusted' => 'Доверенный',
			'city' => 'Город',
			'url' => 'URL сайта (если есть)',
			'aboutProject' => 'Направление деятельности',
			'total' => 'Заработано',
			'paid' => 'Выплачено',
			'verifyCode' => 'Код проверки',
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
		$criteria->compare('firstName',$this->firstName,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('password',$this->password,true);
		$criteria->compare('wmz',$this->wmz,true);
		$criteria->compare('wmr',$this->wmr,true);
		$criteria->compare('rbkmoney',$this->rbkmoney,true);
		$criteria->compare('yandex',$this->yandex,true);
		$criteria->compare('zpayment',$this->zpayment,true);
		$criteria->compare('country',$this->country,true);
		$criteria->compare('maillist',$this->maillist,true);
		$criteria->compare('from',$this->from,true);
		$criteria->compare('parent_id',$this->parent_id,true);
		$criteria->compare('createTime',$this->createTime);
		$criteria->compare('trusted',$this->trusted);
		$criteria->compare('city',$this->city,true);
		$criteria->compare('url',$this->url,true);
		$criteria->compare('aboutProject',$this->aboutProject,true);
		$criteria->compare('total',$this->total);
		$criteria->compare('paid',$this->paid);

		return new CActiveDataProvider(get_class($this), array(
			'criteria'=>$criteria,
                        'pagination' => array (
                            'pageSize' => Settings::item('adminAffPerPage'),
                        ),
                        'sort' => array (
                            'defaultOrder' => 'createTime DESC',
                        ),

		));
	}

	public function beforeSave ()
	{
		//Для не новых записей
		if (!$this->isNewRecord) {
			if (parent::beforeSave ()) {
				//Вписываем время обновления
                                if (!$this->notify) {
                                    $this->updateTime = time ();
                                }
                                return TRUE;
                                				
			} else {
				return FALSE;
			}
		}

		if(parent::beforeSave())
		{

			//Родительский ID
			$this->parent_id = self::getAff();
                        $this->ip = $_SERVER['REMOTE_ADDR'];
			$this->createTime = time ();
			$this->updateTime = $this->createTime;
			$this->trusted = Settings::item ('affAllTrusted');

			//На нули остальные значения
			//$this->clicks = 0;
			$this->paid = 0;
			$this->total = 0;

			return TRUE;

		} else {
			return false;
		}


	}

	//Функция для получения партнёра из Cookies
	public static function getAff ($good_id = FALSE,$email = '',$cupon = '')
	{
                //Блокировщик комиссии
                if (Y::cookieGet ('om_block_'.$good_id)==1) {
                    return '';
                }
            
		$aff = Y::cookieGet ('om_affreg');

		if (empty($aff)) {
			return '';
		}

		if (Settings::item('affShared')) {
			$gaff = $aff;
		} elseif ($good_id !== FALSE) {
			$gaff = Y::cookieGet ('om_ref_'.$good_id);
		} else {
			$gaff = '';
		}

		if (empty($gaff) AND ($good_id != FALSE)) {

			//Подбираем из группы
			$gd = self::_ingroup($good_id);
			if ($gd!=FALSE) {

				foreach ($gd as $one){
				 	$ck = Y::cookieGet ('om_ref_'.$one);
					//Если хотя бы по одному товару из группы задан партнёр
					//то присваиваем этого партнёра
				 	if (!empty($ck)) {
				 			$gaff = $ck;
				 			break;
				 	}
				}

			}


		}

		if (empty($gaff) AND ($good_id != FALSE)) {
			return '';
		}

		//Проверка синтаксиса
		if (!preg_match('/^[a-z0-9_]{1,100}$/',$aff)) return '';

		if (!empty($gaff)) {
			if (!preg_match('/^[a-z0-9_]{1,100}$/',$gaff)) return '';
		}

		$partn = $aff;
		if ($good_id!==FALSE) {
			$partn = $gaff;
		}

		$pp = new Partner ();

		$pp = $pp->find (array(
			'condition' => 'id=:id',
			'params' => array(':id' => $partn),
		));

		if ($pp == NULL) {
			return ''; //Если партнёр не найден - значит пустое
		}

		if ($good_id === FALSE) {
			return $aff;
		} else {
                    
                        //Процедура проверки всех остальных параметров
                    
                    
                        //Проверяем блокировку IP
                        $ip = CHttpRequest::getUserHostAddress();
                        
                        if (Settings::item('affIp')==1) {
                            if ($ip == $pp->ip) return '';
                        }
                    
                        //Блокировка за совпадение e-mail
                        if ($pp->email == $email) {
                            return '';
                        }
                    
                        //Проверяем купон - если отключены комиссионные
                        if (!Cupon::komisOk($cupon,$good_id)) {
                            return '';
                        }
                        
                        //Проверяем по товару
                        $good = Good::model()->findByPk ($good_id);
                        
                        if (!$good) {
                            return '';
                        }
                        
                        //Проверяем - включена ли партнёрка и комиссионные больше 0
                        if (!$good->affOn) return '';
                        if ($good->affKomis<=0) return '';
                    
                    
			return $gaff;
		}

	}

	//Проверка групп товаров
	public static function _ingroup ($good_id) {

		$db = Yii::app()->db;
		$command = $db->createCommand ();
		$res = $command->select ('*')->
					from ('{{good_group}}')->
					where ('good_id = :id',array(':id' => $good_id))->
					queryRow ();

		if (empty($res)) {
			return FALSE;
		}

		$group_id = $res['group_id'];

		//Получаем список всех товаров, на которые распространяется RefID
		$command = $db->createCommand ();
		$res = $command->select ('*')->
					from ('{{good_group}}')->
					where ('group_id = :id',array(':id' => $group_id))->
					queryAll ();

		$ok = array ();

		foreach ($res as $one){
			$ok[]=trim($one['good_id']);
		}

		if (empty ($ok)) {
			return FALSE;
		} else {
			return $ok;
		}

	}
        
        //Функция возвращает список всех партнёров
        public static function items () {
            
            $goods = self::model()->findAll();
            
            if (!$goods) return array ();
            
            $ng = array ();           
            foreach ($goods as $one) {
                $ng[$one->id] = $one->id;
            }
            asort ($ng);
            return $ng;
        }    
        
      	//Число продаж товара партнёром
	public static function sales_count ($refid, $good_id = FALSE) {

            		if ($good_id !== FALSE) {
											
							$res = Yii::app()->db->createCommand()                                            
                                            ->select ('COUNT(id)')
                                            ->from ('{{affstats}}')
											->where ('partner_id = :pid AND good_id = :gid',array(
												':pid' => $refid,
												':gid' => $good_id,
											))->queryScalar();
											            
                        } else {
                            
							$res = Yii::app()->db->createCommand()                                            
                                            ->select ('COUNT(id)')
                                            ->from ('{{affstats}}')
											->where ('partner_id = :pid',array(
												':pid' => $refid,												
											))->queryScalar();
                        }
		
		
		return $res;		
		
	}
        
        /*
         * Группирует клики
         */
        static public function cgroupDays ($orders,$startDate,$stopDate) {
            
            $no = array ();

            for ($i=$startDate;$i<=$stopDate; $i = $i+86400) {
                $ndate = mktime (0,0,1,date('m',$i),date ('j',$i),date('Y',$i));
                $no[$ndate]['sum'] = 0;
                $no[$ndate]['count'] = 0;
            }

            foreach ($orders as $one) {
                $d = $one['date'];
                $ndate = mktime (0,0,1,date('m',$d),date ('j',$d),date('Y',$d));
                $no[$ndate]['sum'] += 1;                
                $no[$ndate]['count'] += 1;
            }
            ksort ($no);
            return $no;
        }

        /*
         * Группирует клики по месяцам
         */
        static public function cgroupMonth ($orders,$startDate,$stopDate) {

            $no = array ();

            for ($i=$startDate;$i<=$stopDate; $i = $i+2160000) {
                $ndate = mktime (0,0,1,date('m',$i),1,date('Y',$i));
                $no[$ndate]['sum'] = 0;
                $no[$ndate]['count'] = 0;
            }            

            foreach ($orders as $one) {
                $d = $one['date'];
                $ndate = mktime (0,0,1,date('m',$d),1,date('Y',$d));                                
                $no[$ndate]['sum'] += 1;
                $no[$ndate]['count'] += 1;
            }
            ksort ($no);
            return $no;


        }        
        
        
        //Начисление партнёрского вознаграждения
        public static function doKomis ($o) {
            $refid = $o->partner_id;
            
            if (empty ($refid)) return FALSE; //Нет партнёра - ничего не делаем
            
            //Загружаем партнёра
            $p = Partner::model ()->findByPk ($refid);
            
            if (!$p) return FALSE; //Не найден - уходим
            
            //Загружаем товар
            $g = Good::model ()->findByPk ($o->good_id);
            
            if (!$g) return FALSE;
            
            //Проверяем есть ли комиссия
            if (($g->affOn!=1) OR ($g->affKomis<=0)) return FALSE;
            
            //Текущее вознаграждение
            $a = new Affstats;
            $a->isNewRecord = TRUE;
            $a->id = $o->id;
            $a->partner_id = $refid;
            $a->kanal = $o->kanal;
            $a->good_id = $o->good_id;
            $a->date = time ();
            
            //Вычисляем комиссию
            $komis = PartnerPersonal::sum ($refid,$o->good_id,'s',$g->affKomis);
            $ktype = PartnerPersonal::sum ($refid,$o->good_id,'t',$g->affKomisType);
            
            $sum = 0;
            $val = 'rur';
            
            //Если фиксированная
            if ($ktype == 'fixed') {
                
                $sum = $komis;
                $val = $g->currency;
                
            } else {
                
                //Вычисляем процент
                $sum = round ($o->cena*$komis/100,2);
                $val = $o->valuta;
                
            }
            
            //Делаем свод валют
            $vv = Valuta::conv ($sum,$val,$o->bill->usdkurs,$o->bill->eurkurs,$o->bill->uahkurs);
            
            //Собственно вычисление комиссионных 1-го уровня в рублях
            $a->komis = $vv['rur'];
            
            //Проверяем вознаграждение 2-го уровня
            if ($g->affPkomis > 0) {
                
                //Есть ли родительский партнёр?
                if (!empty ($p->parent_id)) {
                    
                    //Есть ли такой партнёр?
                    $pp = Partner::model()->findByPk ($p->parent_id);
                    
                    if ($pp!=FALSE) {
                    
                            $a->prefid = $p->parent_id;
                            //Вычисляем комиссию для партнёра второго уровня (спецкомиссии не в счёт)
                            $komis = $g->affPkomis;
                            if ($g->affPkomisType == 'fixed') {

                                $sum = $komis;
                                $val = $g->currency;


                            } else {

                                //Вычисляем процент
                                $sum = round ($o->cena*$komis/100,2);
                                $val = $o->valuta;
                            }
                            //Собственно комиссия
                            //Делаем свод валют
                            $vv = Valuta::conv ($sum,$val,$o->bill->usdkurs,$o->bill->eurkurs,$o->bill->uahkurs);

                            //Собственно вычисление комиссионных 1-го уровня в рублях
                            $a->pkomis = $vv['rur'];
                    }
                }
                
                
            }
            
            
            //Сохраняем запись
            $a->save (FALSE);
            
            //Делаем начисление и рассылку партнёрам 1-го и 2-го уровней - кто сколько заработал
            if ($a->komis>0) {
                
                //Начисление
                $p->total += $a->komis;
                $p->notify = TRUE;
                $p->save (FALSE);
                
                //Ставим следующий уровень этому партнёру
                PartnerAuto::doauto ($refid,$o->good_id);
                
                //Узнаём новую комиссию
                $newkomis = ((PartnerPersonal::sum($refid, $g->id,"t",$g->affKomisType))=='fixed')?(PartnerPersonal::sum($refid, $g->id,"s",$g->affKomis).H::valuta($g->currency)):PartnerPersonal::sum($refid, $g->id,"s",$g->affKomis).'%';
                
                $email = $o->bill->email;
                if ($p->trusted!=1) {
                    $email = H::codemail ($email);
                }
                //Письмо
                $d = array (
                    'good_title' => $g->title,
                    'client_mail' => $email,
                    'bill_id' => $o->bill_id,
                    'komis' => $a->komis,
                    'refid' => $refid,
                    'newkomis' => $newkomis,
                );
                Mail::letter ('aff_notify',$p->email,$p->firstName,$d);
                
                
            }
            
            //Начисление 2-му уровню
            if ($a->pkomis > 0) {

                $pp->total += $a->pkomis;
                $pp->notify = TRUE;
                $pp->save (FALSE);
                
                //Письмо
                $d = array (
                    'good_title' => $g->title,
                    'prefid' => $refid,
                    'komis' => $a->pkomis,
                    'refid' => $pp->id,
                );
                Mail::letter ('paff_notify',$pp->email,$pp->firstName,$d); 
                
            }
            $tkomis = $a->komis + $a->pkomis;
            
            Log::add ('partner','Начислены комиссионные по счёту №'.$o->bill_id.' заказ ID='.$o->id.' за товар '.$g->id.' для партнёра '.$pp->id.' в размере '.$komis.' руб. и партнёру 2го уровня '.$refid.' в размере '.$a->pkomis.' руб.');
            
            return $tkomis;
            
        }


}