<?php

/**
 * This is the model class for table "{{cupon}}".
 *
 * The followings are the available columns in table '{{cupon}}':
 * @property string $id
 * @property string $code
 * @property double $sum
 * @property integer $kind_id
 * @property integer $startDate
 * @property integer $stopDate
 * @property integer $komis
 * @property string $title
 */
class Cupon extends CActiveRecord
{
        const SUM_FIXED = 'fixed';
        const SUM_PERCENT = 'perc';
        
        public $pack;
	/**
	 * Returns the static model of the specified AR class.
	 * @return Cupon the static model class
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
		return '{{cupon}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('code, sum, kind_id, startDate, stopDate, komis, title, good_id, selfDelete, category_id', 'required'),
			array('komis', 'numerical', 'integerOnly'=>true),
			array('sum, pack', 'numerical'),                        
			array('code, title', 'length', 'max'=>255),
                        array('client_good_id','safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, code, sum, kind_id, startDate, stopDate, komis, title, good_id, selfDelete, category_id, client_good_id', 'safe', 'on'=>'search'),
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
			'code' => 'Купон скидки',
			'sum' => 'Сумма',
			'kind_id' => 'Тип скидки',
			'startDate' => 'Дата старта',
			'stopDate' => 'Дата окончания',
			'komis' => 'Комиссионные партнёрам',
			'title' => 'Краткое описание',
                        'good_id' => 'ID товара (ов)',
                        'client_good_id' => 'Только клиентам товаров',
                        'selfDelete' => 'Удалять после оплаты',
                        'category_id' => 'Категория купона',
                        'pack' => 'Создать пачку',
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
		$criteria->compare('code',$this->code,true);
		$criteria->compare('sum',$this->sum);
		$criteria->compare('kind_id',$this->kind_id);
                $criteria->compare('good_id',$this->good_id);
                $criteria->compare('client_good_id',$this->client_good_id);
		$criteria->compare('startDate',$this->startDate);
		$criteria->compare('stopDate',$this->stopDate);
		$criteria->compare('komis',$this->komis);
		$criteria->compare('title',$this->title,true);
                $criteria->compare('category_id',$this->category_id);
                $criteria->compare('selfDelete',$this->selfDelete);

		return new CActiveDataProvider(get_class($this), array(
			'criteria'=>$criteria,
                        'pagination' => array (
                            'pageSize' => Settings::item('adminPgCupon'),
                        ),
		));
	}


        /*
         * Подсчёт цены с учётом купона скидки
         */
	public static function goodCena ($kupon, $good) {
            

            if (empty ($kupon)) return ($good->price); //Без купона - просто цена

            //Шаг 1 - поиск купона в базе
            $kp = Cupon::model()->find (
                    'code=:code',
                    array (':code' => $kupon)
                );

            if (!$kp) return ($good->price);            

            //Если купон есть            

            	$kpcheck = FALSE;

            	if (strpos ($kp->good_id,',')!==FALSE) {

            		$kplist = explode (',',$kp->good_id);

            		foreach ($kplist as $onekp) {
            			$onekp = trim ($onekp);
            			if ($onekp == $good->id) {
            				$kpcheck = TRUE; //Использовать купон
            				$kp->good_id = $onekp;
            				break;
            			}
            		}

            	} else {
                        //Общий купон
                        if ($kp->good_id == '*')
                        {
                            $kpcheck = TRUE;
                        } else {
                            //Результат проверки на соответствие ID товара
                            $kpcheck = ($kp->good_id == $good->id);                            
                        }
            	}

             if ($kpcheck) {

                 

                $crdate = time ();                
                //Шаг 2 - проверка даты скидки
                if ( ($kp->startDate<=$crdate) && ($kp->stopDate>=time ()) ) {
                    
                    //Шаг 3 - подсчёт размера скидки
                    $sum = $kp->sum;

                    //Шаг 4 - если скидка в процентах - просчитываем
                    if ($kp->kind_id != self::SUM_FIXED) {

                        $sum = round (($good->price/100)*$kp->sum,2);

                    }

                    //Шаг 5 - уменьшаем сумму на полученную скидку
                    $cena = $good->price - $sum;

                    if ($cena<=0) return $good->price;

                    return $cena;
                    //return ($good['cena']);

	             }
				 else {

	                return ($good->price);

	             }

            } else {
                return ($good->price);
            }
            return $good->price;
     }
     
     //Проверяем купон на валидность и возвращаем его, если есть и срок впорядке
     public static function valid ($cupon, $email = false) {
         
         //Ищем купон:
         $c = Cupon::model()->find (
                    'code=:code',
                    array (':code' => $cupon)
                );
        
         if (!$c) return '';
         
         //Проверяем дату
         $d = time ();
         
         if ($c->startDate>$d) return '';
         if ($c->stopDate<$d) return '';
         
         if ((!empty ($email)) && (!empty ($c->client_good_id))) {
             
             $cc = explode (',',$c->client_good_id);
            
             $found = false;
             foreach ($cc as $one)
             {
                 $one = trim ($one);
                 $cl = Client::model ()->find (array (
                     'condition' => 'email = :email',
                     'params' => array (
                         ':email' => $email,
                     ),
                 ));
                 if ($cl) {
                     $found = true;
                     break;
                 }
             }
             
             if (!$found) return ''; //Клиент не в базе
             
         }
         
         
         return $cupon;
         
     }
     
     //Проверяем можно ли за этот купон начислять комиссионные
     public static function komisOk ($cupon, $good_id) {
         
         if (empty ($cupon) OR empty ($good_id))
             return TRUE;
         
         //Получаем данный купон и получаем список товаров
         //Ищем купон:
         $c = Cupon::model()->find (
                    'code=:code',
                    array (':code' => $cupon)
                );
        
         if (!$c) return TRUE;
         
         $goods = explode (',',$c->good_id);
         
         if (in_array ($good_id,$goods)) {
             
             //Проверяем опцию
             return ($c->komis==1)?TRUE:FALSE;
             
         }        
         
         return TRUE;
     }
     
     //Самоуничтожение купона
     public static function selfDel ($cupon) {
         
         if (empty ($cupon)) return FALSE;
         
         $c = Cupon::model()->find (
                    'code=:code',
                    array (':code' => $cupon)
                );
        
         if (!$c) return FALSE;
         
         //Если опция самоудаления - удаляем
         if ($c->selfDelete==1) {
             $c->delete ();
         }
         
     }



}