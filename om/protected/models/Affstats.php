<?php

/**
 * This is the model class for table "{{affstats}}".
 *
 * The followings are the available columns in table '{{affstats}}':
 * @property integer $id
 * @property string $partner_id
 * @property double $komis
 * @property string $prefid
 * @property double $pkomis
 * @property integer $date
 * @property string $good_id
 * @property string $kanal
 */
class Affstats extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Affstats the static model class
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
		return '{{affstats}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('kanal', 'required'),
			array('id, date', 'numerical', 'integerOnly'=>true),
			array('komis, pkomis', 'numerical'),
			array('partner_id, prefid, good_id', 'length', 'max'=>50),
			array('kanal', 'length', 'max'=>255),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, partner_id, komis, prefid, pkomis, date, good_id, kanal', 'safe', 'on'=>'search'),
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
			'partner_id' => 'Partner',
			'komis' => 'Komis',
			'prefid' => 'Prefid',
			'pkomis' => 'Pkomis',
			'date' => 'Date',
			'good_id' => 'Good',
			'kanal' => 'Kanal',
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
		$criteria->compare('partner_id',$this->partner_id,true);
		$criteria->compare('komis',$this->komis);
		$criteria->compare('prefid',$this->prefid,true);
		$criteria->compare('pkomis',$this->pkomis);
		$criteria->compare('date',$this->date);
		$criteria->compare('good_id',$this->good_id,true);
		$criteria->compare('kanal',$this->kanal,true);

		return new CActiveDataProvider(get_class($this), array(
			'criteria'=>$criteria,
		));
	}
}