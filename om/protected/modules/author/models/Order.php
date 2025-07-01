<?php

/**
 * This is the model class for table "{{order}}".
 *
 * The followings are the available columns in table '{{order}}':
 * @property string $id
 * @property string $bill_id
 * @property string $good_id
 * @property integer $createDate
 * @property double $cena
 * @property integer $valuta
 * @property string $partner_id
 */
class Order extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Order the static model class
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
		return '{{order}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('bill_id, good_id, createDate, cena, valuta', 'required'),
			array('createDate', 'numerical', 'integerOnly'=>true),
			array('cena', 'numerical'),
			array('id, bill_id', 'length', 'max'=>20),
			array('good_id, partner_id, country, status_id', 'length', 'max'=>255),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, bill_id, good_id, createDate, cena, valuta, partner_id, country', 'safe', 'on'=>'search'),
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
                    'bill' => array(self::BELONGS_TO, 'Bill', 'bill_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => '№',
			'bill_id' => 'Номер счёта',
			'good_id' => 'Товар',
			'createDate' => 'Создан',
			'cena' => 'Цена',
			'valuta' => 'Валюта',
			'partner_id' => 'Партнёр',
                        'country' => 'Страна',
                        'status_id' => 'Статус',
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
		$criteria->compare('bill_id',$this->bill_id,true);
		$criteria->compare('good_id',$this->good_id,true);
		$criteria->compare('createDate',$this->createDate);
		$criteria->compare('cena',$this->cena);
		$criteria->compare('valuta',$this->valuta);
		$criteria->compare('partner_id',$this->partner_id,true);
                $criteria->compare('status_id',$this->status_id);                
                
                $model = Author::model()->findByPk(Y::user()->id);
                $goods = $model->goods;

                        $nn=1;
                        foreach ($goods as $one) {
                            if ($nn>1) {                                
                                $criteria->compare('good_id',trim($one->id),true,'OR');
                            } else {                                
                                $criteria->compare('good_id',trim($one->id),true);
                            }
                            $nn++;
                        }
                

		return new CActiveDataProvider(get_class($this), array(
			'criteria'=>$criteria,
                        'pagination' => array (
                            'pageSize' => Settings::item('adminPgOrder'),
                        ),                    
                        'sort' => array (
                            'defaultOrder' => 'createDate DESC',
                        ),
		));
	}

        /*
         * Группирует сумму заказов по дням
         */
        static public function groupDays ($orders,$startDate,$stopDate) {
            
            $no = array ();

            for ($i=$startDate;$i<=$stopDate; $i = $i+86400) {
                $ndate = mktime (0,0,1,date('m',$i),date ('j',$i),date('Y',$i));
                $no[$ndate]['sum'] = 0;
                $no[$ndate]['count'] = 0;
            }

            foreach ($orders as $one) {
                $d = $one['createDate'];
                $ndate = mktime (0,0,1,date('m',$d),date ('j',$d),date('Y',$d));
                $valuta = Valuta::conv($one['cena'], $one['valuta']);
                $no[$ndate]['sum'] += $valuta['rur'];
                $no[$ndate]['count'] += 1;
            }
            ksort ($no);
            return $no;
        }

        /*
         * Группирует заказы по месяцам
         */
        static public function groupMonth ($orders,$startDate,$stopDate) {

            $no = array ();

            for ($i=$startDate;$i<=$stopDate; $i = $i+2160000) {
                $ndate = mktime (0,0,1,date('m',$i),1,date('Y',$i));
                $no[$ndate]['sum'] = 0;
                $no[$ndate]['count'] = 0;
            }

            foreach ($orders as $one) {
                $d = $one['createDate'];
                $ndate = mktime (0,0,1,date('m',$d),1,date('Y',$d));
                $valuta = Valuta::conv($one['cena'], $one['valuta']);
                $no[$ndate]['sum'] += $valuta['rur'];
                $no[$ndate]['count'] += 1;
            }
            ksort ($no);
            return $no;


        }

}