<?php

/**
 * This is the model class for table "{{ruser}}".
 *
 * The followings are the available columns in table '{{ruser}}':
 * @property integer $id
 * @property integer $rasscat_id
 * @property string $email
 * @property string $uname
 * @property integer $date
 * @property integer $undate
 * @property integer $active
 * @property integer $lastNum
 * @property integer $lastDate
 */
class Ruser extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Ruser the static model class
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
		return '{{ruser}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('rasscat_id, email, uname, date, undate, active, lastNum, lastDate', 'required'),
			array('rasscat_id, date, undate, active, lastNum, lastDate', 'numerical', 'integerOnly'=>true),
			array('email, uname', 'length', 'max'=>255),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, rasscat_id, email, uname, date, undate, active, lastNum, lastDate', 'safe', 'on'=>'search'),
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
			'email' => 'Email',
			'uname' => 'Uname',
			'date' => 'Date',
			'undate' => 'Undate',
			'active' => 'Active',
			'lastNum' => 'Last Num',
			'lastDate' => 'Last Date',
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
		$criteria->compare('email',$this->email,true);
		$criteria->compare('uname',$this->uname,true);
		$criteria->compare('date',$this->date);
		$criteria->compare('undate',$this->undate);
		$criteria->compare('active',$this->active);
		$criteria->compare('lastNum',$this->lastNum);
		$criteria->compare('lastDate',$this->lastDate);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}