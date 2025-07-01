<?php

/**
 * This is the model class for table "op1_ticket_section".
 *
 * The followings are the available columns in table 'op1_ticket_section':
 * @property integer $id
 * @property string $title
 * @property integer $default_staff_id
 */
class TicketSection extends CActiveRecord
{
	//Список отделов поддержки
	private static $_items=array();

	/**
	 * Returns the static model of the specified AR class.
	 * @return TicketSection the static model class
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
		return '{{ticket_section}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('title, default_staff_id, position', 'required'),
			array('default_staff_id, position', 'numerical', 'integerOnly'=>true),
			array('title', 'length', 'max'=>255),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, title, default_staff_id, position', 'safe', 'on'=>'search'),
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
                        'totalCount' => array(self::STAT, 'Ticket', 'section_id'),
			'openedCount' => array(self::STAT, 'Ticket', 'section_id', 'condition'=>'status_id='.Ticket::OPEN_STATUS),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'title' => 'Название отдела',
			'default_staff_id' => 'Оператор по умолчанию',
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
		$criteria->compare('title',$this->title,true);
		$criteria->compare('default_staff_id',$this->default_staff_id);

		return new CActiveDataProvider(get_class($this), array(
			'criteria'=>$criteria,
                        'pagination' => array (
                            'pageSize' => Settings::item('adminPage'),
                        ),                                        
		));
	}

	/**
	 * Returns the item name for the specified type and code.
	 * @param string the item type (e.g. 'PostStatus').
	 * @param integer the item code (corresponding to the 'code' column value)
	 * @return string the item name for the specified the code. False is returned if the item type or code does not exist.
	 */
	public static function item($section_id)
	{
		if(empty(self::$_items))
			self::loadItems();
		return isset(self::$_items[$section_id]) ? self::$_items[$section_id] : false;
	}

	/**
	 * TicketSection::items()
	 * Передаёт список отделов поддержки для отображения
	 *
	 * @return
	 */
	public static function items()
	{
		if(empty(self::$_items))
			self::loadItems($type);
		return self::$_items;
	}

	/**
	 * TicketSection::loadItems()
	 * Загружает список всех отделов поддержки
	 *
	 * @return array ()
	 */
	private static function loadItems()
	{
		self::$_items=array();
		$models=self::model()->findAll(array(
		    'order'=>'position',
		));
		foreach($models as $model)
			self::$_items[$model->id]=$model->title;
	}

	/**
	 * TicketSection::getDefaultStaff()
	 * Возвращает оператора по умолчанию, которому назначается тикет
	 *
	 * @param mixed $section_id
	 * @return integer
	 */
	public static function getDefaultStaff ($section_id) {
		$ok = self::model()->find (array(
				'condition' => 'id=:id',
				'params' => array (':id'=>$section_id),
			));

		if ($ok == FALSE) {
			die ('Такого отдела поддержки не существует');
		}
		return $ok->default_staff_id;
	}



}