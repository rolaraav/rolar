<?php

/**
 * This is the model class for table "{{queue}}".
 *
 * The followings are the available columns in table '{{queue}}':
 * @property string $id
 * @property string $email
 * @property string $format
 * @property string $subject
 * @property string $body
 * @property integer $priority
 */
class Queue extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Queue the static model class
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
		return '{{queue}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('email, format, subject, body', 'required'),
			array('priority', 'numerical', 'integerOnly'=>true),
			array('email, subject', 'length', 'max'=>255),
			array('format', 'length', 'max'=>10),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, email, format, subject, body, priority', 'safe', 'on'=>'search'),
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
			'email' => 'E-mail',
			'format' => 'Формат',
			'subject' => 'Тема',
			'body' => 'Текст письма',
			'priority' => 'Приоритет',
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
		$criteria->compare('email',$this->email,true);
		$criteria->compare('format',$this->format,true);
		$criteria->compare('subject',$this->subject,true);
		$criteria->compare('body',$this->body,true);
		$criteria->compare('priority',$this->priority);

		return new CActiveDataProvider(get_class($this), array(
			'criteria'=>$criteria,
			'sort' => array (
				'defaultOrder' => 'id DESC',
			),
			'pagination' => array (
				'pageSize' => Settings::item('adminPage'),
			),
		));
	}
        
        public static function unsubCrc ($t,$id) {
            return md5 ('unsubCrc'.$id.Y::param('secretKey').$t);
        }
}