<?php

class Payouta extends CActiveRecord
{
        public $ways;
	/**
	 * Returns the static model of the specified AR class.
	 * @return Partner the static model class
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
		return '{{partner}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
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
			'id' => 'RefID',
			'wmz' => 'Webmoney Z',
			'wmr' => 'Webmoney R',
			'rbkmoney' => 'Счёт RBK Money',
			'yandex' => 'Кошелёк ЮMoney',
			'zpayment' => 'Кошелёк Z-Payment',
			'total' => 'Заработано',
			'paid' => 'Выплачено',
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

                $criteria->addCondition ('total > paid');

		return new CActiveDataProvider(get_class($this), array(
			'criteria'=>$criteria,
                        'pagination' => array (
                            'pageSize' => Settings::item('adminPgPayout'),
                        )
		));
	}

        static public function ways ($w1,$w2,$w3,$w4,$w5) {
            $ar = array ();
            $ar[] = empty($w1)?'':Lookup::item ('Purse','wmz');
            $ar[] = empty($w2)?'':Lookup::item ('Purse','wmr');
            $ar[] = empty($w3)?'':Lookup::item ('Purse','rbkmoney');
            $ar[] = empty($w4)?'':Lookup::item ('Purse','yandex');
            $ar[] = empty($w5)?'':Lookup::item ('Purse','zpayment');

            return trim (implode (' ',$ar));

        }

}