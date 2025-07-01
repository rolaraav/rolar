<?php

/**
 * This is the model class for table "{{plink}}".
 *
 * The followings are the available columns in table '{{plink}}':
 * @property string $id
 * @property string $plink
 * @property string $title
 */
class Plink extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Plink the static model class
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
		return '{{plink}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id, plink, title', 'required'),
			array('id, plink, title', 'length', 'max'=>255),
                        array('id', 'unique'),
                        array ('plink','url'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, plink, title', 'safe', 'on'=>'search'),
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
			'plink' => 'URL переадресации',
			'title' => 'Название ссылки',
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
		$criteria->compare('plink',$this->plink,true);
		$criteria->compare('title',$this->title,true);

		return new CActiveDataProvider(get_class($this), array(
			'criteria'=>$criteria,
                        'pagination' => array (
                            'pageSize' => Settings::item('adminPage'),
                        ),                                        
		));
	}
}