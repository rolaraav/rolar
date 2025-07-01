<?php

/**
 * This is the model class for table "{{rass}}".
 *
 * The followings are the available columns in table '{{rass}}':
 * @property integer $id
 * @property string $title
 * @property string $good_id
 * @property integer $active
 */
class Rass extends CActiveRecord
{
        public static $_items = array ();
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{rass}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(

                        array('active', 'numerical', 'integerOnly'=>true),			
                        array('title', 'length', 'max'=>255),
			array('good_id', 'length', 'max'=>100),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, title, good_id, active', 'safe', 'on'=>'search'),
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
			'id' => 'ID рассылки',
			'title' => 'Название рассылки',
			'good_id' => 'ID товара',
			'active' => 'Активна?',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('title',$this->title,true);
		$criteria->compare('good_id',$this->good_id,true);
		$criteria->compare('active',$this->active);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			'pagination' => array (
				'pageSize' => Settings::item('adminPage'),
			),
                    
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Rass the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
        
        
	public static function item($section_id)
	{
		if(empty(self::$_items))
			self::loadItems();
		return isset(self::$_items[$section_id]) ? self::$_items[$section_id] : false;
	}

	/**
	 * TicketSection::items()
	 * Передаёт список отделов поддержки для отображения
	 *
	 * @return
	 */
	public static function items()
	{
		if(empty(self::$_items))
			self::loadItems($type);
		return self::$_items;
	}

	/**
	 * TicketSection::loadItems()
	 * Загружает список всех отделов поддержки
	 *
	 * @return array ()
	 */
	private static function loadItems()
	{
		self::$_items=array();
		$models=self::model()->findAll(array(
		    
		));
		foreach($models as $model)
			self::$_items[$model->id]=$model->title;
	}        
        
        
        //Выполняет рассылку партии вместе с основной рассылкой
        public static function dorass ()
        {
            //Берём лимит в два раза меньше чем предложен
            $rlim = round (Settings::item('mailLimit')/2);
            
            $rr = RassSub::model ()->findAll ('date < '.time ().' LIMIT '.$rlim);
            
            $rass = array ();
            
            $bodybase = file_get_contents ('./protected/data/rassletter.txt');
            
            foreach ($rr as $one)
            {
                if (!isset ($rass[$one->rass_id])) {
                    $rass[$one->rass_id] = Rass::model ()->findByPk ($one->rass_id);
                    if (!$rass[$one->rass_id]) {
                        //Если не активна - тоже удаляем, а то очередь застопорится
                        $one->delete ();
                        continue;
                    }
                }
                if ($rass[$one->rass_id]->active!=1) continue; //По неактивным не шлём
                
                //Получаем письмо
                $l = RassLetter::model ()->findByPk ($one->letter_id);
                if (!$l) {
                    $one->delete ();
                    continue; //Если письма нет - удаляем из очереди
                }
                
                $u = RassUser::model ()->findByPk ($one->user_id);
                if (!$u) {
                    $one->delete ();
                    continue; //Если человека - удаляем из очереди                    
                }

                if (!$u->sub) {
                    $one->delete ();
                    continue; //Если не подписан - удаляем
                }                
                
                $subj = str_replace ('%name%',$u->uname,$l->title);
                
                $body = $bodybase;
                $body2 = str_replace ('%name%',$u->uname,$l->content);
                $body = str_replace ('{data}',$body2,$body);
                
                //Добавляем ссылку на отписку
                $body = str_replace ('{unsub}',self::unsublink($u->id),$body);
                
                //Само письмо
                Mail::send($u->email, $u->uname, $subj, $body);
                
                $one->delete ();
                
            }
            
        }
        
        //Функция проверяет есть ли рассылка для товара - если есть и активна, то подписываем
        public static function checkGood ($good_id,$email,$uname)
        {
            if ($email == 'noemail@example.com') return false;
            //Ищем рассылку с таким good_id
            $rass = Rass::model ()->find (array (
                'condition' => 'good_id = :gid AND active = 1',
                'params' => array (':gid' => $good_id),
            ));                
            
            //Если нет - то выход
            if (!$rass) return false;
            
            //Если есть - addUser
            self::addUser ($rass->id,$email,$uname);
        }
        
        //Функция добавляет подписчика и назначет ему очередь
        public static function addUser ($rid,$email,$uname)
        {
            $email = trim ($email);
            // Ищем нет ли подписчика у этой рассылки
            $u = RassUser::model ()->find (array (
                'condition' => 'email = :email',
                'params' => array (
                    ':email' => $email,
                )
            ));
            
            //Если найден - выходим с значением false
            if ($u) return false;
            
            //Получаем рассылку - если она неактивна, выходим
            $rass = Rass::model ()->findByPk ($rid);
            if (!$rass) return false;
            
            if ($rass->active != 1) return false;
            
            //Если нет - то подписываем (формируем подписчика)
            $u = new RassUser ();
            $u->isNewRecord = true;
            $u->id = false;            
            $u->date = time ();
            $u->uname = trim ($uname);
            $u->email = $email;
            $u->rass_id = $rid;            
            $u->sub = 1;
            $u->save (false);
            
            $u = RassUser::model ()->find (array (
                'condition' => 'email = :email',
                'params' => array (
                    ':email' => $email,
                )
            ));
            
            if (!$u) return false;
            
            //Получаем список всех писем
            $all = RassLetter::model ()->findAll ('rass_id = '.$rass->id);
            
            //Вызываем для каждого письма oneletter
            foreach ($all as $one)
            {                
                self::oneletter ($rass->id,$u,$one);
            }  
            //Выход
        }
        
        //Функция добавляет одно письмо в очередь подписчику
        public static function oneletter ($rid,$u,$l)
        {            
            $sb = $u->sub+0;                        
            if ($sb<1) return false; //Перестраховка            
            //Формируем новую запись
            //Просчитываем дату
            $s = new RassSub ();
            $s->id = false;            
            $s->isNewRecord = true;            
            $s->rass_id = $rid;
            $s->user_id = $u->id;
            $s->letter_id = $l->id;
            //Умножаем на часы
            $s->date = $u->date+3600*$l->hours;
            $s->save(false);            
        }
        
        //Функция добавляет новое письмо в очередь все подписчикам
        public static function allletters ($rid,$l)
        {
            //Получаем список подписчиков этой рассылки - активных только
            $all = RassUser::model ()->findAll ('sub = 1 AND rass_id = '.$rid);
            foreach ($all as $one) {
                //Выполняем oneletter для каждого            
                self::oneletter ($rid,$one,$l);
            }
        }
        
       public static function unsubCrc ($id) {
            return md5 ('unsubRassCrc'.$id.Y::param('secretKey'));
       }        
       
       public static function unsublink ($id) {
            return Y::bu ().'notify/unsubr/i/'.$id.'/c/'.self::unsubCrc($id);
       }               
        
        
        
}
