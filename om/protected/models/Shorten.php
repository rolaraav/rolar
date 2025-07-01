<?php

/**
 * This is the model class for table "op1_shorten".
 *
 * The followings are the available columns in table 'op1_shorten':
 * @property string $id
 * @property string $partner_id
 * @property string $description
 * @property string $url
 */
class Shorten extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Shorten the static model class
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
		return '{{shorten}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('partner_id, description, url', 'required'),
			array('id', 'length', 'max'=>20),
			array('partner_id', 'length', 'max'=>100),
			array('description', 'length', 'max'=>50),
			array('url', 'length', 'max'=>255),
			array ('url','url'),
			array ('url','okshorten'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, partner_id, description, url', 'safe', 'on'=>'search'),
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
			'partner_id' => 'RefId',
			'description' => 'Описание (до 50 знаков)',
			'url' => 'URL длинной ссылки',
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
		$criteria->compare('partner_id',$this->partner_id,true);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('url',$this->url,true);

		return new CActiveDataProvider(get_class($this), array(
			'criteria'=>$criteria,
		));
	}

	public static function listItems($refid)
	{
		$items=array();
		$models=self::model()->findAll(array(
			'condition' => 'partner_id=:refid',
			'params' => array (':refid' => $refid),
		    'order'=>'id ASC',
		));

		foreach($models as $model) {
			$items[$model->id]=array('title' => $model->description, 'url' => $model->url);
		}
		return $items;
	}

	public function okshorten ($attribute,$params)
	{
		$bu = Y::bu();
		if ((strpos($this->url,$bu)!==0)) {
			$this->addError ('url', 'URL должен начинаться с '.$bu);
		}
	}



}