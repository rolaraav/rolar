<?php

/**
 * This is the model class for table "{{odno}}".
 *
 * The followings are the available columns in table '{{odno}}':
 * @property integer $id
 * @property string $good_id
 * @property string $title
 * @property string $dost
 * @property string $phone
 * @property integer $price
 * @property integer $oldprice
 * @property string $otz1
 * @property string $otz2
 * @property string $otz3
 * @property string $otz4
 * @property string $otz5
 * @property string $otz6
 * @property string $vkgroup
 * @property string $footer
 * @property string $video
 * @property integer $height
 * @property integer $width
 * @property string $zag1
 * @property string $content
 * @property string $block1
 * @property string $block1data
 * @property string $block2
 * @property string $block2data
 * @property string $block3
 * @property string $block3data
 * @property string $preorder
 * @property string $currency
 * @property integer $imgcount
 * @property integer $visible
 */
class Odno extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{odno}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('price, oldprice, height, width, imgcount, visible', 'numerical', 'integerOnly'=>true),
			array('good_id, vkgroup', 'length', 'max'=>100),
			array('title, video, zag1, block1, block2, block3, preorder', 'length', 'max'=>255),
			array('dost, phone', 'length', 'max'=>50),
			array('currency', 'length', 'max'=>40),
			array('otz1, otz2, otz3, otz4, otz5, otz6, footer, content, block1data, block2data, block3data', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, good_id, title, dost, phone, price, oldprice, otz1, otz2, otz3, otz4, otz5, otz6, vkgroup, footer, video, height, width, zag1, content, block1, block1data, block2, block2data, block3, block3data, preorder, currency, imgcount, visible', 'safe', 'on'=>'search'),
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
			'good_id' => 'ID товара',
			'title' => 'Заголовок',
			'dost' => 'Подзаголовок',
			'phone' => 'Телефон',
			'price' => 'Цена',
			'oldprice' => 'Зачёркнутая цена',
			'otz1' => 'Отзыв 1',
			'otz2' => 'Отзыв 2',
			'otz3' => 'Отзыв 3',
			'otz4' => 'Отзыв 4',
			'otz5' => 'Отзыв 5',
			'otz6' => 'Отзыв 6',
			'vkgroup' => 'ID группы ВК',
			'footer' => 'Подвал страницы',
			'video' => 'ID youtube-видео',
			'height' => 'Высота видео',
			'width' => 'Ширина видео',
			'zag1' => 'Заголовок описания',
			'content' => 'Описание товара',
			'block1' => 'Блок1 Заголовок',
			'block1data' => 'Блок1 Список',
			'block2' => 'Блок2 Заголовок',
			'block2data' => 'Блок2 Список',
			'block3' => 'Блок3 Заголовок',
			'block3data' => 'Блок3 Список',
			'preorder' => 'Над кнопкой заказа',
			'currency' => 'Валюта',
			'imgcount' => 'Количество картинок',
			'visible' => 'Отображать',
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

		$criteria->compare('id',$this->id);
		$criteria->compare('good_id',$this->good_id,true);
		$criteria->compare('title',$this->title,true);
		$criteria->compare('dost',$this->dost,true);
		$criteria->compare('phone',$this->phone,true);
		$criteria->compare('price',$this->price);
		$criteria->compare('oldprice',$this->oldprice);
		$criteria->compare('otz1',$this->otz1,true);
		$criteria->compare('otz2',$this->otz2,true);
		$criteria->compare('otz3',$this->otz3,true);
		$criteria->compare('otz4',$this->otz4,true);
		$criteria->compare('otz5',$this->otz5,true);
		$criteria->compare('otz6',$this->otz6,true);
		$criteria->compare('vkgroup',$this->vkgroup,true);
		$criteria->compare('footer',$this->footer,true);
		$criteria->compare('video',$this->video,true);
		$criteria->compare('height',$this->height);
		$criteria->compare('width',$this->width);
		$criteria->compare('zag1',$this->zag1,true);
		$criteria->compare('content',$this->content,true);
		$criteria->compare('block1',$this->block1,true);
		$criteria->compare('block1data',$this->block1data,true);
		$criteria->compare('block2',$this->block2,true);
		$criteria->compare('block2data',$this->block2data,true);
		$criteria->compare('block3',$this->block3,true);
		$criteria->compare('block3data',$this->block3data,true);
		$criteria->compare('preorder',$this->preorder,true);
		$criteria->compare('currency',$this->currency,true);
		$criteria->compare('imgcount',$this->imgcount);
		$criteria->compare('visible',$this->visible);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			'sort' => array (
				'defaultOrder' => 'id ASC',
			),
			'pagination' => array (
				'pageSize' => Settings::item('adminPage'),
			),
                    
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Odno the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
