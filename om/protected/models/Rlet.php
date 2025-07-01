<?php

/**
 * This is the model class for table "{{rlet}}".
 *
 * The followings are the available columns in table '{{rlet}}':
 * @property integer $id
 * @property integer $rasscat_id
 * @property integer $number
 * @property integer $day
 * @property string $subject
 * @property string $body
 * @property string $descr
 * @property string $format
 */
class Rlet extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Rlet the static model class
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
		return '{{rlet}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('rasscat_id, number, day, subject, body, descr, format', 'required'),
			array('rasscat_id, number, day', 'numerical', 'integerOnly'=>true),
			array('subject, descr', 'length', 'max'=>255),
			array('format', 'length', 'max'=>5),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, rasscat_id, number, day, subject, body, descr, format', 'safe', 'on'=>'search'),
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
			'rasscat_id' => 'Rasscat',
			'number' => 'Number',
			'day' => 'Day',
			'subject' => 'Subject',
			'body' => 'Body',
			'descr' => 'Descr',
			'format' => 'Format',
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
		$criteria->compare('rasscat_id',$this->rasscat_id);
		$criteria->compare('number',$this->number);
		$criteria->compare('day',$this->day);
		$criteria->compare('subject',$this->subject,true);
		$criteria->compare('body',$this->body,true);
		$criteria->compare('descr',$this->descr,true);
		$criteria->compare('format',$this->format,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}