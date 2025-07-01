<?php

/**
 * This is the model class for table "{{author}}".
 *
 * The followings are the available columns in table '{{author}}':
 * @property string $id
 * @property string $password
 * @property string $email
 * @property string $uname
 * @property double $total
 * @property double $paid
 * @property string $purse
 * @property string $kind
 */
class Author extends CActiveRecord
{
        public static $_items = array ();
	/**
	 * Returns the static model of the specified AR class.
	 * @return Author the static model class
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
		return '{{author}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id, password, email, uname, kind', 'required'),
			array('total, paid', 'numerical'),
			array('id, password, email, uname, purse', 'length', 'max'=>255),
			array('kind', 'length', 'max'=>10),
                        array ('email','email'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, password, email, uname, total, paid, purse, kind', 'safe', 'on'=>'search'),
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
                    'goods' => array(self::HAS_MANY, 'Good', 'author_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'Логин',
			'password' => 'Пароль',
			'email' => 'E-mail',
			'uname' => 'Имя',
			'total' => 'Начислено',
			'paid' => 'Выплачено',
			'purse' => 'Кошелёк',
			'kind' => 'Тип кошелька',
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
		$criteria->compare('password',$this->password,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('uname',$this->uname,true);
		$criteria->compare('total',$this->total);
		$criteria->compare('paid',$this->paid);
		$criteria->compare('purse',$this->purse,true);
		$criteria->compare('kind',$this->kind,true);

		return new CActiveDataProvider(get_class($this), array(
			'criteria'=>$criteria,
                        'pagination' => array (
                            'pageSize' => Settings::item('adminPage'),
                        ),                    
		));
	}
        
       	/**
	 * Returns the item name for the specified type and code.
	 * @param string the item type (e.g. 'PostStatus').
	 * @param integer the item code (corresponding to the 'code' column value)
	 * @return string the item name for the specified the code. False is returned if the item type or code does not exist.
	 */
	public static function item($section_id)
	{
		if(empty(self::$_items))
			self::loadItems();
		return isset(self::$_items[$section_id]) ? self::$_items[$section_id] : false;
	}

	/**
	 * TicketSection::items()
	 * Передаёт список отделов поддержки для отображения
	 *
	 * @return
	 */
	public static function items()
	{
		if(empty(self::$_items))
			self::loadItems($type);
		return self::$_items;
	}

	/**
	 * TicketSection::loadItems()
	 * Загружает список всех отделов поддержки
	 *
	 * @return array ()
	 */
	private static function loadItems()
	{
		self::$_items=array();
		$models=self::model()->findAll(array());
		foreach($models as $model)
			self::$_items[$model->id]=$model->uname;
	}
        
        //Начисление процента автору
        public static function doKomis ($o) {
            
            $g = Good::model ()->findByPk ($o->good_id);
            
            if (!$g) return FALSE;
            
            //Есть ли авторское вознаграждение?
            if ($g->authorKomis<=0) return FALSE;            
            
            //Проверяем есть ли автор - мало ли?
            if (!$g->author_id) return FALSE;
            
            //Загружаем автора:
            $a = Author::model()->findByPk ($g->author_id);
            
            if (!$a) return FALSE;
            
            //Подсчитываем процент
            
            $nncena = $o->cena;
            //Иначе процент от комиссии
            if (($g->aukind == 'total') AND (!empty ($o->partner_id))) {
                                    //Находим запись комиссионных
                    $xx = Affstats::model ()->findByPk($o->id);
                    $comis = $xx->komis + $xx->pkomis;
                    $osum = Valuta::conv ($o->cena,$o->valuta);
                    $nncena = $osum['rur'] - $comis;                    
                    
                    $ncena = round ($nncena*$g->authorKomis/100,2);
                    $vv = array ('rur' => $ncena); //Так как уже в рублях
                
            } else {

                $ncena = round ($nncena*$g->authorKomis/100,2);            
            
                //Переводим в рубли (по текущему курсу)
                $vv = Valuta::conv ($ncena,$o->valuta);
                
            }
               
            
            
            
            //Добавляем вознаграждение автору:
            $a->total += $vv['rur'];
            $a->save (FALSE);
            
            $b = $o->bill;
            
            $d = array (
                'good_title' => $g->title,
                'sum' => H::mysum($o->cena).H::valuta($o->valuta),
                'bill_id' => $o->bill_id,
                'order_id' => $o->id,
                'cmail' => $b->email,
                'surname' => $b->surname,
                'cname' => $b->uname,
                'otchestvo' => $b->otchestvo,
                'strana' => $b->strana,
                'region' => $b->region,
                'postindex' => $b->postindex,
                'gorod' => $b->gorod,
                'address' => $b->address,
                'phone' => $b->phone,
                'login' => $a->id,
                'komis' => $vv['rur'],
                
            );
            
            //Отправляем письмо автору, что он заработал денег
            Mail::letter ('author_sell',$a->email,$a->uname,$d);
            
            Log::add ('author','Начислены комиссионные по счёту №'.$o->bill_id.' заказ ID='.$o->id.' за товар '.$g->id.' для АВТОРА '.$a->email.' в размере '.$vv['rur'].' руб.');
                
            
            return $vv['rur'];
            
        }
        
}