<?php

/**
 * This is the model class for table "{{area_item}}".
 *
 * The followings are the available columns in table '{{area_item}}':
 * @property integer $id
 * @property integer $area_id
 * @property integer $area_section_id
 * @property string $title
 * @property string $description
 * @property string $icon
 * @property integer $uploadDate
 * @property integer $link_id
 * @property integer $position
 */
class AreaItem extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return AreaItem the static model class
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
		return '{{area_item}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('area_id, area_section_id, title, description, icon, uploadDate, link_id, position', 'required'),
			array('area_id, area_section_id, uploadDate, link_id, position', 'numerical', 'integerOnly'=>true),
			array('title, icon', 'length', 'max'=>255),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, area_id, area_section_id, title, description, icon, uploadDate, link_id, position', 'safe', 'on'=>'search'),
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
			'area_id' => 'Area',
			'area_section_id' => 'Area Section',
			'title' => 'Title',
			'description' => 'Description',
			'icon' => 'Icon',
			'uploadDate' => 'Upload Date',
			'link_id' => 'Link',
			'position' => 'Position',
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
		$criteria->compare('area_section_id',$this->area_section_id);
		$criteria->compare('title',$this->title,true);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('icon',$this->icon,true);
		$criteria->compare('uploadDate',$this->uploadDate);
		$criteria->compare('link_id',$this->link_id);
		$criteria->compare('position',$this->position);

		return new CActiveDataProvider(get_class($this), array(
			'criteria'=>$criteria,
		));
	}
}