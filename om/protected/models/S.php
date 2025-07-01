<?php

/**
 * This is the model class for table "{{s}}".
 *
 * The followings are the available columns in table '{{s}}':
 * @property string $id
 * @property integer $date
 * @property string $sb
 * @property string $clicks
 * @property string $p_id
 * @property string $good_id
 */
class S extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{s}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('date', 'numerical', 'integerOnly'=>true),
			array('sb, p_id, good_id', 'length', 'max'=>100),
			array('clicks', 'length', 'max'=>20),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, date, sb, clicks, p_id, good_id', 'safe', 'on'=>'search'),
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
			'date' => 'Date',
			'sb' => 'Sb',
			'clicks' => 'Clicks',
			'p_id' => 'P',
			'good_id' => 'Good',
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

		$criteria->compare('id',$this->id,true);
		$criteria->compare('date',$this->date);
		$criteria->compare('sb',$this->sb,true);
		$criteria->compare('clicks',$this->clicks,true);
		$criteria->compare('p_id',$this->p_id,true);
		$criteria->compare('good_id',$this->good_id,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return S the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
