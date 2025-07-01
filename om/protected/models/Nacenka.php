<?php

/**
 * This is the model class for table "{{nacenka}}".
 *
 * The followings are the available columns in table '{{nacenka}}':
 * @property integer $id
 * @property string $good_id
 * @property string $strana
 * @property string $gorod
 * @property string $kind
 */
class Nacenka extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Nacenka the static model class
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
		return '{{nacenka}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('good_id, strana, gorod, kind', 'required'),
			array('good_id, strana, gorod', 'length', 'max'=>255),
			array('kind', 'length', 'max'=>10),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, good_id, strana, gorod, kind', 'safe', 'on'=>'search'),
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
			'id' => '№',
			'good_id' => 'ID товара',
			'strana' => 'Страна',
			'gorod' => 'Город',
			'kind' => 'Тип заказа',
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
		$criteria->compare('strana',$this->strana,true);
		$criteria->compare('gorod',$this->gorod,true);
		$criteria->compare('kind',$this->kind,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}