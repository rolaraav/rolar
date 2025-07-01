<?php

/**
 * This is the model class for table "{{area}}".
 *
 * The followings are the available columns in table '{{area}}':
 * @property integer $id
 * @property string $title
 * @property integer $active
 */
class Area extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Area the static model class
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
		return '{{area}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('title', 'required'),
			array('active', 'numerical', 'integerOnly'=>true),
			array('title', 'length', 'max'=>255),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, title, active', 'safe', 'on'=>'search'),
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
                    'paylist' => array(self::HAS_MANY, 'AreaPaylist', 'area_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'title' => 'Название',
			'active' => 'Активна',
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

		$criteria->compare('id',$this->id);
		$criteria->compare('title',$this->title,true);
		$criteria->compare('active',$this->active);

		return new CActiveDataProvider(get_class($this), array(
			'criteria'=>$criteria,
                        'pagination' => array (
                            'pageSize' => Settings::item('adminPage'),
                        ),                                        
		));
	}
        
        // Добавляет пользователя в закрытую зону
        // Генерирует логин и пароль
        // Высылает письмо с данными
        // $good - загруженный товар
        public static function addUser ($good,$email,$uname, $amail = '', $order_id = FALSE) {
            
            if (!$good) die ('Не загружен товар!');
            
            //Получаем номер закрытой зоны и срок
            $zona = explode (',',$good->dlink);
            
            if (empty ($zona)) return FALSE;
            
            //Добавляем пользователя зоны
            $u = new AreaUser;
            $u->isNewRecord = TRUE;
            $u->area_id = $zona[0];
            $u->email = $email;
            $u->createDate = time ();
            $u->payTill = $zona[1]*86400 + $u->createDate;
            $u->totalDays = $zona[1];
            
            //Генерируем логин:
            $u->username = 'u'.H::random_string ('nozero',6);
                    
                    if (AreaUser::model()->find('username=:u',array(':u'=>$u->username))!=FALSE) {
                        $u->username = 'u'.H::random_string ('nozero',6);
                    }
                    
                    if (AreaUser::model()->find('username=:u',array(':u'=>$u->username))!=FALSE) {
                        $u->username = 'u'.H::random_string ('nozero',6);
                    }                    
            
            //Генерируем пароль:            
            $u->password = H::random_string ('alnum',8);
            
            //Сохраняем
            $u->save (FALSE);
            
            //Готовим для отправки письмо с данными для доступа
            $d = array (
                'name' => $uname,
                'username' => $u->username,
                'password' => $u->password,
                'area_link' => Y::bu().'area/',
                'title' => $u->area->title,
            );
            
            //Отправляем письмо
            Mail::letter ('area_data',$email,$uname,$d);
            
            //Если нужно - копию
            if (!empty ($amail)) {
                Mail::letter ('area_data',$amail,$uname,$d);
            }
            
            return TRUE;
        }
        
        //Продление закрытой зоны
        public static function long ($b) {
            
            $o = $b->orders[0];
            $aa = explode ('_',$o->good_id);
            
            //Получаем пользователя
            $u = AreaUser::model ()->findByPk ($aa[1]);
            
            if (!$u) {
                Bill::err ($b->id,'При продлении закрытой зоны - пользователь №'.$aa[1].' не найден');
            }
            
            //Дата
            if ($u->payTill<time()) {
                $u->payTill = time ()+$aa[2]*86400;
            } else {
                $u->payTill += ($aa[2]*86400);
            }
            //Увеличиваем число оплаченных дней:
            $u->totalDays += $aa[2];
            
            //Сохраняем изменения
            $u->save (FALSE);
            
            //Письмо пользователю
            $d = array (
                'till' => H::date($u->payTill),
                'username' => $u->username,
                'password' => $u->password,
            );
            
            Mail::letter ('area_long',$u->email,'',$d);
        }
        
        //Продление закрытой зоны
        public static function long2 ($uid, $days) {            
            
            //Получаем пользователя
            $u = AreaUser::model ()->findByPk ($uid);
            
            if (!$u) {
                Bill::err (0,'При продлении закрытой зоны - пользователь №'.$uid.' не найден');
            }
            
            //Дата
            if ($u->payTill<time()) {
                $u->payTill = time ()+$days*86400;
            } else {
                $u->payTill += ($days*86400);
            }
            //Увеличиваем число оплаченных дней:
            $u->totalDays += $days;
            
            //Сохраняем изменения
            $u->save (FALSE);

            return TRUE;
            
        }        
        
}