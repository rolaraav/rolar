<?php

/**
 * This is the model class for table "{{partner_auto}}".
 *
 * The followings are the available columns in table '{{partner_auto}}':
 * @property integer $id
 * @property string $partner_id
 * @property string $good_id
 * @property double $count
 * @property integer $komis
 * @property integer $komis_type
 */
class PartnerAuto extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return PartnerAuto the static model class
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
		return '{{partner_auto}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('good_id, count, komis, komis_type', 'required'),
			array('komis', 'numerical', 'integerOnly'=>true),
			array('count', 'numerical'),
			array('good_id', 'length', 'max'=>255),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, good_id, count, komis, komis_type', 'safe', 'on'=>'search'),
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
			'good_id' => 'ID товара',
			'count' => 'Количество продаж',
			'komis' => 'Комиссия',
			'komis_type' => 'Тип комиссии',
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
		$criteria->compare('count',$this->count);
		$criteria->compare('komis',$this->komis);
		$criteria->compare('komis_type',$this->komis_type);

		return new CActiveDataProvider(get_class($this), array(
			'criteria'=>$criteria,
                        'pagination' => array (
                            'pageSize' => Settings::item('adminPage'),
                        ),                                        
		));
	}
        
        
	//Функция выполняет подстановку автокомиссий
	public static function doauto ($refid, $good_id) {
			
		//Вначале - список для конкретного товара
		
		//Число продаж
		//$this->load->model ('mdl_partners');
		$count = Partner::sales_count($refid,$good_id);
                
                //Запрос на автокомиссии
                $mx = self::model ()->findAll (
                        'good_id = :id AND count < :count ORDER BY count DESC',
                        array (
                            ':id' => $good_id,
                            ':count' => $count,
                        )
                 );
		
		//Если есть автокомиссии
		if ($mx) {
			
                        //Берём наибольшую
			$mx = $mx[0];			
                        
                        $pp = PartnerPersonal::model ()->findAll (
                                'auto=1 AND partner_id=:pid AND good_id=:gid',
                                array (
                                    ':pid' => $refid,
                                    ':gid' => $good_id,
                                )
                        );
                        
                        foreach ($pp as $one)
                        {
                            $one->delete (); //Удаляем автокомиссии
                        }
                        
			
			//Вместо них делаем одну новую
			$dd = new PartnerPersonal;
                        $dd->isNewRecord = TRUE;
			$dd->auto = 1;
			$dd->partner_id = $refid;
			$dd->good_id = $good_id;
			$dd->komis = $mx->komis;
			$dd->komis_type_id = $mx->komis_type;
			$dd->save (FALSE);			
		}
		//return 'Ok';
		
		//Тоже самое проверям, но для всех товаров
		$count = Partner::sales_count($refid);
                
                //Запрос на автокомиссии
                $mx = self::model ()->findAll (
                        'good_id = :id AND count < :count ORDER BY count DESC',
                        array (
                            ':id' => '*',
                            ':count' => $count,
                        )
                 );
		
		//Если есть автокомиссии
		if ($mx) {
			
                        //Берём наибольшую
			$mx = $mx[0];
                        
                        $pp = PartnerPersonal::model ()->findAll (
                                'auto=1 AND partner_id=:pid AND good_id=:gid',
                                array (
                                    ':pid' => $refid,
                                    ':gid' => '*',
                                )
                        );
                        
                        foreach ($pp as $one)
                        {
                            $one->delete (); //Удаляем автокомиссии
                        }                        
			
			//Вместо них делаем одну новую
			$dd = new PartnerPersonal;
                        $dd->isNewRecord = TRUE;
			$dd->auto = 1;
			$dd->partner_id = $refid;
			$dd->good_id = '*';
			$dd->komis = $mx->komis;
			$dd->komis_type_id = $mx->komis_type;
			$dd->save (FALSE);			
		}
		
		
		
	}	
        
        
        
}