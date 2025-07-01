<?php

/**
 * This is the model class for table "{{ad}}".
 *
 * The followings are the available columns in table '{{ad}}':
 * @property integer $id
 * @property string $good_id
 * @property string $title
 * @property string $code
 * @property integer $adcategory_id
 */
class Ad extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Ad the static model class
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
		return '{{ad}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('good_id, title, code, adcategory_id', 'required'),
			array('adcategory_id,position,showcode', 'numerical', 'integerOnly'=>true),
			array('good_id, title', 'length', 'max'=>255),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, good_id, title, code, adcategory_id,position,showcode', 'safe', 'on'=>'search'),
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
			'good_id' => 'ID товара',
			'title' => 'Описание материала',
			'code' => 'HTML-код',
			'adcategory_id' => 'Категория',
                        'position' => 'Позиция',
                        'showcode' => 'Отображать код',
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
		$criteria->compare('good_id',$this->good_id,true);
		$criteria->compare('title',$this->title,true);
		$criteria->compare('code',$this->code,true);
		$criteria->compare('adcategory_id',$this->adcategory_id);

		return new CActiveDataProvider(get_class($this), array(
			'criteria'=>$criteria,
                        'pagination' => array (
                            'pageSize' => Settings::item('adminPgAd'),
                        )                    
		));
	}
        
        /*
         * Функция заменяет макросы ссылок на соответствующие
         */
        public static function repl ($code, $refid, $good_id) {
            
            $reflink = Y::bu().'go/'.$refid.'/p/'.$good_id;
            $orderlink = Y::bu().'go/'.$refid.'/order/'.$good_id;
            
            $code = str_replace ('%refid%',$refid,$code);
            $code = str_replace ('%reflink%',$reflink,$code);
            $code = str_replace ('%orderlink%',$orderlink,$code);
            
            return $code;
            
        }
}