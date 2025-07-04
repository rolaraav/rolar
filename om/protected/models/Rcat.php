<?php

/**
 * This is the model class for table "{{rcat}}".
 *
 * The followings are the available columns in table '{{rcat}}':
 * @property integer $id
 * @property string $title
 * @property string $good_id
 * @property string $kind
 * @property string $unsubs
 * @property integer $active
 */
class Rcat extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Rcat the static model class
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
		return '{{rcat}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('title, good_id, kind, unsubs, active', 'required'),
			array('active', 'numerical', 'integerOnly'=>true),
			array('title, good_id, unsubs', 'length', 'max'=>255),
			array('kind', 'length', 'max'=>20),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, title, good_id, kind, unsubs, active', 'safe', 'on'=>'search'),
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
			'title' => 'Title',
			'good_id' => 'Good',
			'kind' => 'Kind',
			'unsubs' => 'Unsubs',
			'active' => 'Active',
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
		$criteria->compare('title',$this->title,true);
		$criteria->compare('good_id',$this->good_id,true);
		$criteria->compare('kind',$this->kind,true);
		$criteria->compare('unsubs',$this->unsubs,true);
		$criteria->compare('active',$this->active);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}