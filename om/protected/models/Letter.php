<?php

/**
 * This is the model class for table "op1_letter".
 *
 * The followings are the available columns in table 'op1_letter':
 * @property string $id
 * @property string $description
 * @property string $subject
 * @property string $message
 * @property string $type
 * @property integer $lon
 */
class Letter extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Letter the static model class
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
		return '{{letter}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id, description, subject, message, type', 'required'),
			array('lon', 'numerical', 'integerOnly'=>true),
			array('id', 'length', 'max'=>100),
			array('description, subject', 'length', 'max'=>255),
			array('type', 'length', 'max'=>10),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, description, subject, message, type, lon', 'safe', 'on'=>'search'),
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
			'description' => 'Описание',
			'subject' => 'Тема сообщения',
			'message' => 'Текст сообщения',
			'type' => 'Тип',
			'lon' => 'Включено',
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
		$criteria->compare('description',$this->description,true);
		$criteria->compare('subject',$this->subject,true);
		$criteria->compare('message',$this->message,true);
		$criteria->compare('type',$this->type,true);
		$criteria->compare('lon',$this->lon);

		return new CActiveDataProvider(get_class($this), array(
			'criteria'=>$criteria,
			'sort'=>array(
				'defaultOrder'=>'id ASC',
			),
                        'pagination' => array (
                            'pageSize' => Settings::item('adminPage'),
                        ),                    
		));
	}

	public function types (){
		return array (
			'plain' => 'Обычный текст',
			'html'	=> 'HTML-формат',
		);
	}

}