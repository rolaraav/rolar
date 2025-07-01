<?php

/**
 * This is the model class for table "{{rass_user}}".
 *
 * The followings are the available columns in table '{{rass_user}}':
 * @property integer $id
 * @property integer $rass_id
 * @property string $uname
 * @property string $email
 * @property integer $sub
 * @property integer $date
 * @property integer $unsubdate
 */
class RassUser extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{rass_user}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('rass_id', 'required'),
			array('rass_id, sub, date, unsubdate', 'numerical', 'integerOnly'=>true),
			array('uname, email', 'length', 'max'=>255),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, rass_id, uname, email, sub, date, unsubdate', 'safe', 'on'=>'search'),
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
			'rass_id' => 'Рассылка',
			'uname' => 'Имя',
			'email' => 'E-mail',
			'sub' => 'Подписан?',
			'date' => 'Дата подписки',
			'unsubdate' => 'Дата отписки',
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
		$criteria->compare('rass_id',$this->rass_id);
		$criteria->compare('uname',$this->uname,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('sub',$this->sub);
		$criteria->compare('date',$this->date);
		$criteria->compare('unsubdate',$this->unsubdate);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			'sort' => array (
				'defaultOrder' => 'id DESC',
			),
			'pagination' => array (
				'pageSize' => Settings::item('adminPage'),
			),
                    
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return RassUser the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
