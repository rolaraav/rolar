<?php
/**
 * This is the model class for table "{{bill}}".
 *
 * The followings are the available columns in table '{{bill}}':
 * @property string $id
 * @property integer $createDate
 * @property double $sum
 * @property string $valuta
 * @property double $usdkurs
 * @property double $eurkurs
 * @property double $uahkurs
 * @property string $cupon
 * @property integer $payDate
 * @property integer $status_id
 * @property string $email
 * @property string $amail
 * @property string $uname
 * @property string $surname
 * @property string $otchestvo
 * @property string $strana
 * @property string $region
 * @property string $gorod
 * @property string $postindex
 * @property string $address
 * @property string $phone
 * @property string $ip
 * @property string $way
 * @property string $postNumber
 * @property string $kind
 * @property integer $orderCount
 */
class Bill extends CActiveRecord
{

        //Статусы для счёта
        const BILL_WAITING = 'waiting';
        const BILL_APPROVED = 'approved';

        public $disk = FALSE;
        
        public $notify = FALSE;
        
        public $paidOnly = FALSE;
        public $sendOnly = FALSE;
        public $waitOnly = FALSE;
        
        private $newbill;
        private $oldstatus;        

	/**
	 * Returns the static model of the specified AR class.
	 * @return Bill the static model class
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
		return '{{bill}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('email,phone', 'required'),


                        array (($this->disk == TRUE)?'uname, surname, otchestvo, strana, gorod, postindex, address':'uname','required'),

                        //, surname, otchestvo, strana, gorod, postindex, address, phone
			array('createDate, payDate, orderCount', 'numerical', 'integerOnly'=>true),
			array('sum, usdkurs, eurkurs, uahkurs, affpaid, curier', 'numerical'),
			array('valuta', 'length', 'max'=>3),
			array('cupon, email, amail, uname, surname, otchestvo, strana, region, gorod, address, phone, way, postNumber, kind,comment, purse', 'length', 'max'=>255),
			array('postindex', 'length', 'max'=>30),
			array('ip', 'length', 'max'=>100),
                        array ('email, amail','email'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, createDate, sum, valuta, usdkurs, eurkurs, uahkurs, cupon, payDate, status_id, email, amail, uname, surname, otchestvo, strana, region, gorod, postindex, address, phone, ip, way, postNumber, kind, orderCount, purse, affpaid, curier', 'safe', 'on'=>'search'),
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
                    'orders' => array(self::HAS_MANY, 'Order', 'bill_id'),                    
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => '№',
			'createDate' => Yii::t('modelBill','Дата создания'),
			'sum' => Yii::t('billModel','Сумма'),
			'valuta' => Yii::t('billModel','Валюта'),
			'usdkurs' => Yii::t('billModel','Курс USD'),
			'eurkurs' => Yii::t('billModel','Курс EUR'),
			'uahkurs' => Yii::t('billModel','Курс UAH'),
			'cupon' => Yii::t('billModel','Купон скидки'),
			'payDate' => Yii::t('billModel','Дата оплаты'),
			'status_id' => Yii::t('billModel','Статус'),
			'email' => Yii::t('billModel','E-mail'),
			'amail' => Yii::t('billModel','Другой E-mail'),
			'uname' => Yii::t('billModel','Имя'),
			'surname' => Yii::t('billModel','Фамилия'),
			'otchestvo' => Yii::t('billModel','Отчество'),
			'strana' => Yii::t('billModel','Страна'),
			'region' => Yii::t('billModel','Область'),
			'gorod' => Yii::t('billModel','Город'),
			'postindex' => Yii::t('billModel','Почтовый индекс'),
			'address' => Yii::t('billModel','Адрес'),
			'phone' => Yii::t('billModel','Телефон'),
                        'comment' => Yii::t('billModel','Комментарий к заказу'),
			'ip' => Yii::t('billModel','IP'),
			'way' => Yii::t('billModel','Способ оплаты'),
			'postNumber' => Yii::t('billModel','Номер посылки'),
			'kind' => Yii::t('billModel','Тип заказа'),
			'orderCount' => Yii::t('billModel','Заказов'),
                        'notifySent' => Yii::t('billModel','Получил напоминаний'),
			'purse' => 'Реквизиты оплаты',                        
                        'affpaid' => 'Партнёру начислено?',   
                        'curier' => 'Доставка курьером',   

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

                //$criteria->compare('id >',0,FALSE);		
		$criteria->compare('id',$this->id,FALSE);		
		$criteria->compare('sum',$this->sum);
		$criteria->compare('valuta',$this->valuta,true);
		$criteria->compare('usdkurs',$this->usdkurs);
		$criteria->compare('eurkurs',$this->eurkurs);
		$criteria->compare('uahkurs',$this->uahkurs);
		$criteria->compare('cupon',$this->cupon,true);
		$criteria->compare('payDate',$this->payDate);
                
                $criteria->compare('affpaid',$this->affpaid);
                $criteria->compare('curier',$this->curier);
                
		$criteria->compare('email',$this->email,true);
		$criteria->compare('amail',$this->amail,true);
		$criteria->compare('uname',$this->uname,true);
		$criteria->compare('surname',$this->surname,true);
		$criteria->compare('otchestvo',$this->otchestvo,true);
		$criteria->compare('strana',$this->strana,true);
		$criteria->compare('region',$this->region,true);
		$criteria->compare('gorod',$this->gorod,true);
		$criteria->compare('postindex',$this->postindex,true);
		$criteria->compare('address',$this->address,true);
		$criteria->compare('phone',$this->phone,true);
		$criteria->compare('ip',$this->ip,true);
		$criteria->compare('way',$this->way,true);
		$criteria->compare('postNumber',$this->postNumber,true);
		$criteria->compare('kind',$this->kind,true);
		$criteria->compare('orderCount',$this->orderCount);
                
                if ($this->paidOnly) {                    
                    
                                         
                    //$criteria->compare('status_id','approved',FALSE,'AND (');
                    if (!empty($criteria->condition)) {
                        $criteria->condition .= ' AND ';
                    }
                    $criteria->condition .= "(status_id = 'approved' OR status_id = 'processing' OR status_id = 'sent' OR status_id = 'nalozh_ok')";
                    //$criteria->compare('status_id','processing',FALSE,'OR');
                    //$criteria->compare('status_id','sent',FALSE,'OR');
                    //$criteria->compare('status_id','nalozh_ok',FALSE,'OR');                                                                            
                    //$criteria->condition .= ')';                    
                    //$criteria->compare('id',0,FALSE,') AND');            
                    
                } elseif ($this->sendOnly) {
                    
                    if (!empty($criteria->condition)) {
                        $criteria->condition .= ' AND ';
                    }
                    
                    $criteria->condition .= "(status_id = 'processing' OR status_id = 'nalozh_confirmed')";
                    //$criteria->compare('status_id','processing',FALSE,'AND (');
                    //$criteria->compare('status_id','nalozh_confirmed',FALSE,'OR');
                    
                } elseif ($this->waitOnly) {
                    
                    if (!empty($criteria->condition)) {
                        $criteria->condition .= ' AND ';
                    }
                    
                    $criteria->condition .= "(status_id = 'nalozh')";
                    
                } else {
                    $criteria->compare('status_id',$this->status_id,FALSE);
                }                
                
                
                $cn = StaffAccess::allowed ('country');
                
                if (!empty ($cn)) {
                    if ($cn[0]!='none') {
                        $nn=1;
                        
                    if (!empty($criteria->condition)) {
                        $criteria->condition .= ' AND ';
                    }
                        $criteria->condition .= '(';
                        foreach ($cn as $one) {
                            if ($nn==1) {                                
                                //$criteria->compare('strana',trim($one),FALSE,'OR');
                                $criteria->condition .= ("strana = :str".$nn);
                                $criteria->params[':str'.$nn] = trim ($one);
                            } else {                                
                                //$criteria->compare('strana',trim($one),FALSE,'AND (');
                                $criteria->condition .= (" OR strana = :str".$nn);
                                $criteria->params[':str'.$nn] = trim ($one);
                            }
                            $nn++;
                        }                        
                        $criteria->condition .= ')';
                    }
                }
                 

		return new CActiveDataProvider(get_class($this), array(
			'criteria'=>$criteria,
                        'pagination' => array (
                            'pageSize' => Settings::item('adminPgBill'),
                        ),                    
                        'sort' => array (
                            'defaultOrder' => 'createDate DESC',
                        ),
		));
	}


        /*
         * Хэш для счёта
         */
        public static function hashBill($billId) {
            return md5(Y::param('secretKey') . md5($billId*1145) . 'theBill');
        }
        
        
        //Счёт оплачен
        
        public static function payBill ($bid, $way = 'Admin', $sum = FALSE, $type = FALSE, $purse = '') {
        
            //Проверяем есть ли такой счёт
            $b = Bill::model()->findByPk ($bid);
            
            if (!$b) {
                self::err($bid,'Оплачен несуществующий счёт');                
            }
            
            //Проверяем статус
            //Разрещённые предыдущие статусы:
            //waiting
            //nalozh_sent
            
            if (($b->status_id!='waiting') AND ($b->status_id != 'nalozh_sent')) {
                self::err($bid,'Повторное оповещение об оплаченном счёте, или же с неверным статусом ('.Lookup::items('Status',$b-status_id).')');
            }
            
            if ($way != 'Admin') {
                Log::add ('newpay','Получено оповещение о зачислении счёта #'.$bid.' на сумму '.$sum.' платёжная система '.$type.' кошелёк '.$purse);
            }
            
            //Проверяем сумму если сумма передана
            if ($sum!==FALSE) {
                
                if (is_string ($sum)) {
                    $sum = trim(str_replace (',','.',$sum));
                }
                $sum = (float) $sum;
                //$vv = Valuta::conv ($sum,$type,$b->usdkurs,$b->eurkurs,$b->uahkurs);
                
                $vv2 = Valuta::conv ($b->sum,$b->valuta,$b->usdkurs,$b->eurkurs,$b->uahkurs);
                
                //Теперь сравниваем новую сумму
                if ($sum<($vv2[$type]-0.03)) {
                    self::err ($bid,'Сумма полученная способом '.$way.' составляет '.$sum.$type.' - она меньше необходимой ('.$b->sum.$b->valuta.' = '.$vv2[$type].$type.')');
                }
                
            }
            
            //Меняем статус
            //Какой будет статус?
            $nstat = 'approved';
            $ww = $way;
            
            //Исправляем для disk
            if (empty ($b->kind)) {
                $ggg = Good::model()->findByPk ($b->orders[0]->good_id);
                $b->kind = $ggg->kind;
            }
            
            //Если физический товар
            if ($b->kind == 'disk') {
                
                if ($b->status_id=='nalozh_sent') {
                    $nstat = 'nalozh_ok';
                    $ww = 'Наложенный';
                } else {
                    $nstat = 'processing';
                }
                
            }        
            
            //Сохранение
            $b->status_id = $nstat;
            $b->way = $ww;
            $b->purse = $purse;
            $b->payDate = time ();
            $affpaid = $b->affpaid;
            $b->affpaid = 1;
            $b->save (FALSE);
            
            
            
            //Если это была оплата продления закрытой зоны - то просто продлеваем зону и отправляем письмо, всё
            if ($b->kind == 'arealong') {
                Area::long ($b);
                return TRUE;
            }
            
            $ords = $b->orders;
            
            //Самоуничтожение купона скидки если нужно
            Cupon::selfDel ($b->cupon);
            
            $taff = 0;
            $tau = 0;
            
            //Список заказов для письма:
            $omail = '------ ТОВАРЫ ------'."\r\n\r\n";
            
            foreach ($ords as $o) {
                
                //Начисления партнёрам
                if ($affpaid == 0) {
                    $taff += Partner::doKomis ($o);
                }
                
                $omail .= 'ID товара: '.$o->good_id.' | RefID: '.(empty($o->partner_id)?'нет':$o->partner_id)."\r\n";

                //Начисления автору
                $tau += Author::doKomis ($o);
                
                $g = Good::model()->findByPk ($o->good_id);
                
                if ($g!==FALSE) {
                    //Высылаем товар
                    $g->sendGood ($b->uname,$b->email,$b->amail,$b->id,$ww);
                } else {
                    self::err ($bid,'Оплата несуществующего товара '.$o->good_id.' - не выслан',FALSE);
                }
                
            }
            
            $b->save (FALSE);
            
            $omail .= "\r\n".'-------------------';
            
            //Отправляем оповещение администратору и на мобильник об оплаченном счёте
            if ($nstat!='nalozh_ok') {            
            
                //Для мобильника:
                $mob = Settings::item ('mobile');
                if (!empty ($mob)) {

                    $l = Letter::model()->findByPk('mobile');

                    $sb = $l->subject;
                    $t = $l->message;

                    //Заменяем данные
                    $t=str_replace ('%bill_id%',$b->id,$t);
                    $t=str_replace ('%orders%',$omail,$t);
                    $t=str_replace ('%good_id%',$ords[0]->good_id.'['.$b->orderCount.']',$t);
                    $t=str_replace ('%cena%',$b->sum,$t);
                    $t=str_replace ('%valuta%',$b->valuta,$t);
                    $t=str_replace ('%refid%',$ords[0]->partner_id,$t);
                    $t=str_replace ('%email%',$b->email,$t);

                    mail ($mob,$sb,$t); //На мобильник!

                }
            
			}
            //Отправка большого уведомления для Администратора
            
            
            

                $tocopy = array ('email','amail','cupon','surname','uname','otchestvo',
                                'strana','gorod','region','address','postindex','phone','comment','ip');
                $d = array (
                    'bill_id' => $b->id,
                    'status_link' => Bill::statusLink ($b->id),                
                    'komis' => $taff,
                    'akomis' => $tau,
                    'way' => $way,
                    'rur' => $vv2['rur'],
                    'kupon' => $b->cupon,
                    'orders' => $omail,
                );

                foreach ($tocopy as $one) {
                    $d[$one] = $b->$one;
                }

                //Сумма
                $d['sum'] = H::mysum($b->sum).H::valuta($b->valuta);

                //Формируем список заказов:
                $ord = '';
                $orders = $b->orders;
                foreach ($orders as $one) {
                    $pt = ((!empty($one->partner_id))?' |RefID: '.$one->partner_id.'|':'');
                    $ord.= ' ['.$one->good->id.'] '.$one->good->title.$pt."\r\n";
                }
                $d['good_id'] = $ord;

                //Ссылка на счёт в админке
                $d['admin_link'] = Y::bu().'admin/bill/view/id/'.$b->id;

                //Собственно отправка - только если не подтверждение наложенного
            
            //Отправляем оповещение администратору и на мобильник об оплаченном счёте
            if ($nstat!='nalozh_ok') {            			
                Mail::sys (($b->kind=='disk')?'admin_disk':'admin_ebook',$d);           
            } else {				
				Mail::sys ('admin_nalozh_ok',$d);           
			}
            
            
            
            
            
            
            
        }   
        
        public function afterFind ()
        {
            $this->oldstatus = $this->status_id;
            return parent::afterFind ();
        }
        
        public function beforeSave () {
            
            $this->newbill = $this->isNewRecord;
            
            if ($this->isNewRecord) {
                $this->notifySent = (Settings::item('notifyOn')==1)?0:3;
            }
            if (!$this->notify) {
                $vv = Valuta::conv ($this->sum, $this->valuta,$this->usdkurs,$this->eurkurs,$this->uahkurs);
                $this->rur = $vv['rur'];
            }
            
            return parent::beforeSave ();
        }
        
        //Автоматическая смена статусов у заказов - при изменении статуса у счёта
        public function afterSave () {
            
            //Берём текущие заказы
            $orders = $this->orders;
            
            if ($this->newbill) {                
                Log::add ('newbill','Новый счёт №'.$this->id.' на сумму '.$this->sum.' '.$this->valuta.' e-mail '.$this->email.' '.$this->phone);
            } else {
                Log::add ('newchange','Изменён счёт №'.$this->id.' - предыдущий статус "'.Lookup::item('Status', $this->oldstatus).'", текущий статус "'.Lookup::item('Status', $this->status_id).'"',true);
            }
            
            
            if ((!$this->notify) AND (!$this->isNewRecord)) {
            
                if ((($this->status_id == 'processing') OR ($this->status_id == 'approved') OR ($this->status_id == 'sent') OR ($this->status_id == 'nalozh_ok')) AND ($this->payDate < 2)) {
                    $this->payDate = time();
                }
                
                foreach ($orders as $ord) {
                    $ord->status_id = $this->status_id;
                    if ($this->payDate > 2) {
                        $ord->payDate = $this->payDate;
                    }
                    $ord->save (FALSE);
                }                
                
                //Меняем дату последнего изменения                
                $this->lastDate = time ();
                $this->notify = TRUE;
                $this->save (FALSE);
                $this->notify = FALSE;
                
            }
            
            return parent::afterSave ();
        }
        
        public static function statusCrc ($bill) {
            return md5 ('status'.$bill.Y::param('secretKey').'crc');
        }
        
        public static function crossCrc ($bill) {
            return md5 ('status'.$bill.Y::param('secretKey').'crosscrc');
        }
        
        public static function cross2Crc ($bill,$good) {
            return md5 ('status'.$bill.Y::param('secretKey').$good.'crosscrc');
        }
        
        public static function nalozhCrc ($bill) {
            return md5 ('nalozhp'.$bill.Y::param('secretKey').'thecrc');
        }        
        
        public static function nalozh2Crc ($bill) {
            return md5 ('nalozhp'.$bill.Y::param('secretKey').'thecrcnalozh');
        }                

        public static function nalozh3Crc ($bill) {
            return md5 ('nalozhplat'.$bill.Y::param('secretKey').'thecrcnalozh');
        }                        
        
        public static function notifyCrc ($bill) {
            return md5 ('notifyme'.$bill.Y::param('secretKey').'thecrc');
        }                                
        
        public function cross ($good, $bill_id, $gg = FALSE, $check = true)
        {            
            //Проверка форматов, существования счёта и т.п.
            if (!is_numeric ($bill_id)) die ('Bad bill ID');
            
            if (!preg_match ('/^[0-9a-z_]+$/',$good)) die ('Bad good id');
            
            //Проверка на загрузку счёта
            $b = self::model()->findByPk ($bill_id);
            
            if (!$b) die ('Извините, но такого счёта не существует');
            
            if ($check) {
                //Проверка по времени
                $climit = Settings::item('crossLimit')*60;

                if (time ()>($b->createDate+$climit)) {
                    throw new CHttpException (404,'Извините, но отведённый срок для данного предложения - уже истёк...');
                }

                //Проверяем по статусу
                if ($b->status_id!='nalozh_confirmed' && $b->status_id!='nalozh') {                
                    die ('Данный заказ не может быть добавлен к этому счёту, т.к. он имеет неподходящий статус - '.$b->status_id);
                }
             }
                //Если всё в порядке - вначале формируем новый заказ
                $o = $b->orders[0];
            
                //Проверяем чтобы не было второго добавления кроссела в товар
                $tords = $b->orders;
                if ($check) {
                    foreach ($tords as $tord) {                             
                            if ($tord->good_id === $good) {
                            die ('Вы уже добавили один раз этот товар к заказу. Повторное добавление, к сожалению, невозможно');
                            }                    
                    }            
                }
                
            
            
            $g = Good::model()->findByPk ($good);
            
            if (!$g) die ('К сожалению, данное специальное предложение более не существует...');
            
            
                    //Делаем подмену цены - если есть назначение
                    $np = Special::check($gg, $good);
            
                    if (!empty ($np)) {
                        $g->price = $np['sum'];
                        $g->currency = $np['valuta'];
                    }            

            $o->isNewRecord = TRUE;
            $o->id = NULL;
            $o->createDate = time ();
            $o->good_id = $good;
            $o->cena = $g->price;
            $o->valuta = $g->currency;
            
            if (!$good->affOn) {
                $o->partner_id = '';
            }
            
            if ($check==false) {
                $o->partner_id = '';                
                $o->admin = true;
            }
            
            
            $o->save (FALSE);
            
            //Теперь добавляем информацию к существующему счёту
            $cn = Valuta::conv($o->cena, $o->valuta, $b->usdkurs, $b->eurkurs, $b->uahkurs);
            $b->sum += $cn[$b->valuta];
            $b->rur += $cn['rur'];
            $b->orderCount++;
            $b->save (FALSE); //Сохраняем изменённый счёт
            
            //Отправляем письмо администратору, что добавлен новый заказ
            $d = array (
                'bill_id' => $b->id,                
                'status_link' => Bill::statusLink ($b->id),
                'order_id' => $o->id,
                'good_id' => $o->good_id,
                'good_title' => $o->good->title,
                'admin_link' => Y::bu().'admin/bill/view/id/'.$b->id,
            );
              
            if ($check) {
                Mail::sys ('admin_nalozh_cross',$d);                
            }
            
            Log::add ('newchange','Добавлен товар '.$good.' к заказу №'.$b->id);
            
            return TRUE;
        }
        
        
        //Ссылка на отслеживание статуса
        public static function statusLink ($b) {
            return Y::bu().'status/index/b/'.$b.'/c/'.self::statusCrc($b);
        }
        
        
        //Счёт на продление закрытой зоны
        public static function areaBill ($area_id,$user_id,$srok,$sum) {
            
            //Загружаем пользователя
            $u = AreaUser::model()->findByPk ($user_id);
            
            if (!$u) die ('User not found');
            
            //Формируем ID
            $gid = 'area_'.$user_id.'_'.$srok;
            
            //Создаём новый счёт
            $b = new Bill;
            $b->isNewRecord = TRUE;
            $b->createDate = time();
            $b->sum = $sum;
            $b->valuta = 'rur';
            $b->usdkurs = Settings::item ('kursUsd');
            $b->uahkurs = Settings::item ('kursUah');
            $b->eurkurs = Settings::item ('kursEur');
            $b->cupon = '';
            $b->status_id = 'waiting';
            $b->email = $u->email;
            $b->uname = $u->username;
            $b->orderCount = 1;
            $b->notifySent = 2;
            $b->rur = $sum;
            $b->kind = 'arealong';
            $b->ip = $_SERVER['REMOTE_ADDR'];
            $b->save (FALSE); //Сохраняем счёт
            
            
            //Формируем заказ
            $o = new Order;
            $o->isNewRecord = TRUE;
            $o->good_id = $gid;
            $o->createDate = $b->createDate;
            $o->cena = $b->sum;
            $o->valuta = 'rur';
            $o->status_id = 'waiting';
            $o->bill_id = $b->id;
            
            $o->save (FALSE);
            
            //Переадресация на страничку оплаты
            Yii::app()->request->redirect (Y::bu().'bill/index?bill_id='.$b->id.'&hash='.Bill::hashBill($b->id));
            
        }
        
        //Отправляем сообщение об ошибке
        public static function err ($id,$msg, $die = TRUE) {
            
            $d = array (
                'bill_id' => $id,
                'error' => $msg,
            );
            
            Mail::sys ('bill_error',$d);
            if ($die) die ($msg);
        }
        
        public static function excel ($flds,$arr,$filename = 'default.xls') {
           
                 $headers = ''; // just creating the var for field headers to append to below
                 $data = ''; // just creating the var for field data to append to below

                 $xls = new PhpSimpleXlsGen;

                 $xls->totalcol = count ($flds);

                  foreach($flds as $key=>$value) {
                  	
                  		if (function_exists('iconv')) {
                  			$xls->InsertText (iconv ('utf-8','Windows-1251',$value));	
                  		} else {
                  			$xls->InsertText (mb_convert_encoding ($value,'Windows-1251','utf-8'));	
                  		}
                        
                  }

                  $pos = 1; 
                  foreach ($arr as $row) {

                          $first = true;
                      
                       $xls->ChangePos($pos,0);
                       foreach($row as $key=>$value) {
                                    //Сделать первую колонку чиcлом
                                            if ($first) {
                                                    $xls->InsertNumber ($value);
                                                    $first = false;
                                            }
                                            else {	           	
                  								if (function_exists('iconv')) {
                  									$xls->InsertText (iconv ('utf-8','Windows-1251',$value));	
                  								} else {
                  									$xls->InsertText (mb_convert_encoding ($value,'Windows-1251','utf-8'));	
                  								}
                                            	                                            }  

                       }
                    $pos++;
                  }


                 $xls->SendFile($filename);
                 exit;
            
            
        }
        
        //Возвращает список заказов данного товара
        public function lorders () {
            
            $oo = $this->orders;
            
            if (!is_array ($oo)) return '';
            
            $r = '';
            foreach ($oo as $one) {
                $r .= $one->good->title."\r\n";
            }
            
            return $r;
        }
        


}