<?php

/**
 * This is the model class for table "op1_article".
 *
 * The followings are the available columns in table 'op1_article':
 * @property integer $id
 * @property integer $category_id
 * @property string $title
 * @property string $content
 * @property integer $position
 * @property integer $createTime
 * @property integer $updateTime
 */
class Article extends CActiveRecord
{

	/**
	 * Returns the static model of the specified AR class.
	 * @return Article the static model class
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
		return '{{article}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('category_id, title, content, position', 'required'),
			array('category_id, position, visible', 'numerical', 'integerOnly'=>true),
			array('title', 'length', 'max'=>255),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, category_id, title, content, position, visible', 'safe', 'on'=>'search'),
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
			'category' => array(self::BELONGS_TO, 'ArticleCategory', 'category_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'category_id' => 'Категория',
			'title' => 'Название',
			'content' => 'Текст',
			'position' => 'Позиция',
			'createTime' => 'Дата создания',
			'updateTime' => 'Дата изменения',
                        'visible' => 'Показ',
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
		$criteria->compare('category_id',$this->category_id);
		$criteria->compare('title',$this->title,true);
		$criteria->compare('content',$this->content,true);
		$criteria->compare('position',$this->position);
		$criteria->compare('createTime',$this->createTime);
		$criteria->compare('updateTime',$this->updateTime);

		return new CActiveDataProvider(get_class($this), array(
			'criteria'=>$criteria,
                        'pagination' => array (
                            'pageSize' => Settings::item('staffBasePagination'),
                        )

		));
	}


	public function beforeSave ()
	{
		//Для не новых записей
		if (!$this->isNewRecord) {
			if (parent::beforeSave ()) {
				//Вписываем время обновления
				$this->updateTime = time ();
				return TRUE;
			} else {
				return FALSE;
			}
		}

		if(parent::beforeSave())
		{
			$this->createTime = time ();
			$this->updateTime = $this->createTime;
			return TRUE;

		} else {
			return false;
		}


	}

}