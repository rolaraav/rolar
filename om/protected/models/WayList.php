<?php

/**
 * This is the model class for table "{{way_list}}".
 *
 * The followings are the available columns in table '{{way_list}}':
 * @property integer $plist_id
 * @property string $title
 * @property string $pic
 * @property string $url
 * @property string $ways
 * @property string $category
 * @property integer $position
 */
class WayList extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return WayList the static model class
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
		return '{{way_list}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('title, pic, ways, category, position', 'required'),
			array('position', 'numerical', 'integerOnly'=>true),
			array('title, pic, url, ways, category', 'length', 'max'=>255),
                        array ('advanced','unsafe'),
                       
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('plist_id, title, pic, url, ways, category, position,advanced', 'safe', 'on'=>'search'),
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
			'plist_id' => 'ID',
			'title' => 'Название',
			'pic' => 'Картинка',
			'url' => 'URL-сайта',
			'ways' => 'Способы оплаты',
			'category' => 'Категория',
			'position' => 'Позиция',
                        'advanced' => 'Дополнительный текст',
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

		$criteria->compare('plist_id',$this->plist_id);
		$criteria->compare('title',$this->title,true);
		$criteria->compare('pic',$this->pic,true);
		$criteria->compare('url',$this->url,true);
		$criteria->compare('ways',$this->ways,true);
		$criteria->compare('category',$this->category,true);
		$criteria->compare('position',$this->position);
                $criteria->compare('advanced',$this->advanced);

		return new CActiveDataProvider(get_class($this), array(
			'criteria'=>$criteria,
                        'pagination' => array (
                            'pageSize' => Settings::item('adminPage'),
                        ),                                        
                        'sort' => array (
                            'defaultOrder' => 'position ASC',
                        )
		));
	}
}