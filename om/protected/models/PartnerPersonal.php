<?php

/**
 * This is the model class for table "{{partner_personal}}".
 *
 * The followings are the available columns in table '{{partner_personal}}':
 * @property integer $id
 * @property string $partner_id
 * @property string $good_id
 * @property double $komis
 * @property integer $komis_type_id
 * @property integer $auto
 */
class PartnerPersonal extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return PartnerPersonal the static model class
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
		return '{{partner_personal}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('partner_id, good_id, komis, komis_type_id', 'required'),
			array('auto', 'numerical', 'integerOnly'=>true),
			array('komis', 'numerical'),
			array('partner_id, good_id', 'length', 'max'=>255),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, partner_id, good_id, komis, komis_type_id, auto', 'safe', 'on'=>'search'),
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
			'id' => '№',
			'partner_id' => 'RefID партнёра',
			'good_id' => 'Товар',
			'komis' => 'Размер комиссии',
			'komis_type_id' => 'Тип комиссии',
			'auto' => 'Автоматически?',
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
		$criteria->compare('good_id',$this->good_id,true);
		$criteria->compare('komis',$this->komis);
		$criteria->compare('komis_type_id',$this->komis_type_id);
		$criteria->compare('auto',$this->auto);

		return new CActiveDataProvider(get_class($this), array(
			'criteria'=>$criteria,
                        'pagination' => array (
                            'pageSize' => Settings::item('adminPage'),
                        ),                                        
		));
	}
        
        public static function sum ($partner_id, $good_id, $type, $cur)
        {
            //Проверяем есть ли для этого партнёра спецкомиссии с учётом товара
            
            $pers = self::model ()->find (
                    'partner_id=:id AND good_id=:gid',
                    array (
                        ':id' => $partner_id,
                        ':gid' => $good_id,
                    )
            );
            
            if ($pers) {
                if ($type == 's') {
                    return ($pers->komis);
                } else {
                    return ($pers->komis_type_id);
                }                
            }
            
            //Проверяем есть ли общее *
            
            //Проверяем есть ли для этого партнёра спецкомиссии с учётом товара
            
            $pers = self::model ()->find (
                    'partner_id=:id AND good_id=:gid',
                    array (
                        ':id' => $partner_id,
                        ':gid' => '*',
                    )
            );
            
            if ($pers) {
                if ($type == 's') {
                    return ($pers->komis);
                } else {
                    return ($pers->komis_type_id);
                }
            }            
            
            return $cur;            
        }
}