<?php

/**
 * This is the model class for table "{{pin}}".
 *
 * The followings are the available columns in table '{{pin}}':
 * @property integer $id
 * @property integer $pincat_id
 * @property integer $added
 * @property integer $used
 * @property string $good_id
 * @property integer $client_id
 * @property string $code
 */
class Pin extends CActiveRecord
{
        public $kind;
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Pin the static model class
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
		return '{{pin}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('pincat_id, added, used, code', 'required'),
			array('pincat_id, added, used, client_id', 'numerical', 'integerOnly'=>true),			
			array('code', 'length', 'max'=>255),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, pincat_id, added, used, good_id, client_id, code', 'safe', 'on'=>'search'),
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
			'pincat_id' => 'Категория',
			'added' => 'Добавлен',
			'used' => 'Использован',			
			'client_id' => 'ID клиента',
			'code' => 'PIN-код',
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
		$criteria->compare('pincat_id',$this->pincat_id);
		$criteria->compare('added',$this->added);
		
		$criteria->compare('good_id',$this->good_id,true);
		$criteria->compare('client_id',$this->client_id);
		$criteria->compare('code',$this->code,true);
                
                if ($this->kind == 2) {
                    $criteria->compare('used',1);
                } elseif ($this->kind == 3) {
                    $criteria->compare('used',0);
                } else {
                    $criteria->compare('used',$this->used);    
                }

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			'sort' => array (
				'defaultOrder' => 'id ASC',
			),
			'pagination' => array (
				'pageSize' => Settings::item('adminPage'),
			),                    
		));
	}
        
        public static function onepin ($cat_id, $client_id = false)
        {
            
            //Извлекаем один код
            $p = Pin::model ()->find (array (
                'condition' => 'pincat_id = :cat_id AND used = 0',
                'params' => array (
                    ':cat_id' => $cat_id+0,
                )
            ));
            
            //Если не найдено - пишем не найдено
            if (!$p) {
                //Здесь надо будет отправлять письмо админу что закончились
                return 'PIN-коды закончились. Обратитесь, пожалуйста, к администратору';                
            }
            
            //Если найдено - ставим статус использован
            $p->used = 1;
            $p->client_id = $client_id;
            $p->save (false);
            
            //Запись в лог
            Log::add ('pin','Использован PIN-код из категории '.$cat_id.' код '.$p->code.' для клиента #'.$client_id);
            
            //Возвращаем код
            return trim ($p->code);
            
            
        }
        
        
}