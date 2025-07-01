<?php

/**
 * This is the model class for table "{{area_user}}".
 *
 * The followings are the available columns in table '{{area_user}}':
 * @property integer $id
 * @property integer $area_id
 * @property string $username
 * @property string $password
 * @property integer $lastLogin
 * @property integer $createDate
 * @property integer $order_id
 * @property integer $payTill
 * @property integer $totalDays
 */
class AreaUser extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return AreaUser the static model class
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
		return '{{area_user}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('area_id, username, password, lastLogin, createDate, order_id, payTill, totalDays', 'required'),
			array('area_id, lastLogin, createDate, order_id, payTill, totalDays', 'numerical', 'integerOnly'=>true),
			array('username, password', 'length', 'max'=>255),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, area_id, username, password, lastLogin, createDate, order_id, payTill, totalDays', 'safe', 'on'=>'search'),
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
                    'area' => array(self::BELONGS_TO, 'Area', 'area_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'area_id' => 'Area',
			'username' => 'Username',
			'password' => 'Password',
			'lastLogin' => 'Last Login',
			'createDate' => 'Create Date',
			'order_id' => 'Order',
			'payTill' => 'Pay Till',
			'totalDays' => 'Total Days',
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
		$criteria->compare('area_id',$this->area_id);
		$criteria->compare('username',$this->username,true);
		$criteria->compare('password',$this->password,true);
		$criteria->compare('lastLogin',$this->lastLogin);
		$criteria->compare('createDate',$this->createDate);
		$criteria->compare('order_id',$this->order_id);
		$criteria->compare('payTill',$this->payTill);
		$criteria->compare('totalDays',$this->totalDays);

		return new CActiveDataProvider(get_class($this), array(
			'criteria'=>$criteria,
		));
	}
}