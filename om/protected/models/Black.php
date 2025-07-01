<?php

/**
 * This is the model class for table "{{black}}".
 *
 * The followings are the available columns in table '{{black}}':
 * @property integer $id
 * @property integer $createDate
 * @property string $ip
 * @property string $email
 * @property string $phone
 * @property string $address
 * @property string $comment
 */
class Black extends CActiveRecord
{
        public $strana;
        public $gorod;        
	/**
	 * Returns the static model of the specified AR class.
	 * @return Black the static model class
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
		return '{{black}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(			
			array('createDate', 'numerical', 'integerOnly'=>true),
			array('ip', 'length', 'max'=>100),
			array('email, phone, address, comment,gorod,strana', 'length', 'max'=>255),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, createDate, ip, email, phone, address, comment', 'safe', 'on'=>'search'),
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
			'createDate' => 'Дата записи',
			'ip' => 'IP',
			'email' => 'E-mail',
			'phone' => 'Телефон',
			'address' => 'Адрес',
                        'strana' => 'Страна',
                        'gorod'  => 'Город',
			'comment' => 'Ваш комментарий',
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
		$criteria->compare('createDate',$this->createDate);
		$criteria->compare('ip',$this->ip,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('phone',$this->phone,true);
		$criteria->compare('address',$this->address,true);
		$criteria->compare('comment',$this->comment,true);

		return new CActiveDataProvider(get_class($this), array(
			'criteria'=>$criteria,
                        'pagination' => array (
                            'pageSize' => Settings::item('adminPage'),
                        ),                    
                        'sort' => array (
                            'defaultOrder' => 'createDate DESC',
                        ),                    
		));
	}
        
        //Функция проверяет или в чёрном списке
        public static function checkin ($ip, $phone, $email, $strana, $gorod, $address)
        {            
            
            if (Settings::item('checkBlack')!=1) return FALSE;
            
            //Преобразовываем телефон            
            if (!empty ($phone)) {
                $phone = H::allowChars ($phone,'0123456789');
            }
            
            if (function_exists('iconv')) {
            	
            	$all = iconv ('utf-8','Windows-1251','абвгдеёжзиклмнопрстуфхцчшщъыьэюяАБВГДЕЁЖЗИКЛМНОПРСТУФХЦЧШЩЪЫЬЭЮЯ0123456789');
            	
            } else {
            	$all = mb_convert_encoding ('абвгдеёжзиклмнопрстуфхцчшщъыьэюяАБВГДЕЁЖЗИКЛМНОПРСТУФХЦЧШЩЪЫЬЭЮЯ0123456789','Windows-1251','utf-8');
            }
            
            
            
            $email = strtolower (trim($email));            
            
            if (!empty ($address)) {
            
                //Составляем адрес
            	if (function_exists('iconv')) {
                	$adr = strtolower (trim (iconv('utf-8','Windows-1251',$address.$gorod.$strana)));
            	} else {
            		$adr = strtolower (trim (mb_convert_encoding ($address.$gorod.$strana,'Windows-1251','utf-8')));
            	}
                
                $adr = H::allowChars ($adr,$all);
            } else {
                $adr = '';
            }
            
            //Получаем все записи
            $bl = self::model ()->findAll ();
            
            foreach ($bl as $item) {
                
                //Проверяем $ip
                if (!empty ($item->ip)) {
                    
                    if (strpos ($ip,$item->ip)!==FALSE) {
                        return TRUE;
                    }
                    
                }
                
                //Проверяем по email
                if (!empty($item->email)) {
                    if (strpos($email,strtolower ($item->email))!==FALSE) {
                        return TRUE;
                    }
                }
                
                //Проверяем по телефону
                if (!empty ($phone)) {
                    if (!empty ($item->phone)) {
                        $nphone = H::allowChars ($item->phone,'0123456789');
                        if ($nphone==$phone) {
                            return TRUE;
                        }
                    }
                }
                
                //Проверяем по адресу
                if (!empty ($adr)) {
                    if (!empty ($item->address)) {
                        //Составляем адрес
                    	if (function_exists('iconv')) {
                        	$adr2 = strtolower (trim (iconv('utf-8','Windows-1251',$item->address)));
                    	} else {                    		
                    		$adr2 = strtolower (trim (mb_convert_encoding ($item->address,'Windows-1251','utf-8')));
                    	}
                        $adr2 = H::allowChars ($adr2,$all);                        
                        
                        if (!empty ($adr2)) {
                            if (strpos($adr,$adr2)!==FALSE) {
                                return TRUE;
                            }                            
                        }
                        
                    }
                }
                
            }
            
            return FALSE;
        }
}