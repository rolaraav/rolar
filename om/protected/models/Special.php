<?php

/**
 * This is the model class for table "{{special}}".
 *
 * The followings are the available columns in table '{{special}}':
 * @property integer $id
 * @property string $good_id
 * @property string $newgood_id
 * @property double $sum
 * @property string $valuta
 */
class Special extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Special the static model class
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
		return '{{special}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('good_id, newgood_id, sum, valuta', 'required'),
			array('sum', 'numerical'),
			array('good_id, newgood_id', 'length', 'max'=>255),
			array('valuta', 'length', 'max'=>5),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, good_id, newgood_id, sum, valuta', 'safe', 'on'=>'search'),
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
			'id' => '№ записи',
			'good_id' => 'ID основного товара',
			'newgood_id' => 'ID акционного',
			'sum' => 'Сумма',
			'valuta' => 'Валюта',
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
		$criteria->compare('good_id',$this->good_id,true);
		$criteria->compare('newgood_id',$this->newgood_id,true);
		$criteria->compare('sum',$this->sum);
		$criteria->compare('valuta',$this->valuta,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
        
        //Основная функция, возвращающая массив с новой ценой
        public static function check ($mainid, $newid)
        {
            
            //Делаем запрос в БД
            $sp = self::model ()->find (
                    array (
                        'condition' => 'good_id = :gid AND newgood_id = :nid',
                        'params' => array (
                            ':gid' => $mainid,
                            ':nid' => $newid,
                        ),
                    )
            );
            
            if (!$sp) return FALSE;
            
            $r = array (
                'sum' => $sp->sum,
                'valuta' => $sp->valuta,
            );
            return $r;
        }
            
}