<?php

/**
 * This is the model class for table "{{area_section}}".
 *
 * The followings are the available columns in table '{{area_section}}':
 * @property integer $id
 * @property integer $area_id
 * @property string $title
 * @property string $description
 * @property integer $position
 */
class AreaSection extends CActiveRecord
{
        static public $_items;
	/**
	 * Returns the static model of the specified AR class.
	 * @return AreaSection the static model class
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
		return '{{area_section}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('area_id, title, description, position', 'required'),
			array('area_id, position', 'numerical', 'integerOnly'=>true),
			array('title', 'length', 'max'=>255),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, area_id, title, description, position', 'safe', 'on'=>'search'),
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
                    'itemCount' => array(self::STAT, 'AreaItem', 'area_section_id'),
                    'area' => array (self::BELONGS_TO,'Area','area_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'area_id' => 'Зона',
			'title' => 'Название категории',
			'description' => 'Описание',
			'position' => 'Позиция',
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
		$criteria->compare('title',$this->title,true);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('position',$this->position);

		return new CActiveDataProvider(get_class($this), array(
			'criteria'=>$criteria,
                        'pagination' => array (
                            'pageSize' => Settings::item('adminPage'),
                        ),                                        
		));
	}

	public static function item($section_id,$area_id)
	{
		if(empty(self::$_items))
			self::loadItems($area_id);
		return isset(self::$_items[$section_id]) ? self::$_items[$section_id] : false;
	}

	/**
	 * TicketSection::items()
	 * Передаёт список отделов поддержки для отображения
	 *
	 * @return
	 */
	public static function items($area_id)
	{
		if(empty(self::$_items))
			self::loadItems($area_id);
		return self::$_items;
	}

	/**
	 * TicketSection::loadItems()
	 * Загружает список всех отделов поддержки
	 *
	 * @return array ()
	 */
	private static function loadItems($area_id)
	{                
		self::$_items=array();
		$models=self::model()->findAll(array(
		    'order'=>'position',
                    'condition' => 'area_id = :id',
                    'params' => array (':id' => $area_id),
		));
		foreach($models as $model)
			self::$_items[$model->id]=$model->title;
	}


}