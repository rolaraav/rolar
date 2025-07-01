<?php

/**
 * This is the model class for table "{{staff}}".
 *
 * The followings are the available columns in table '{{staff}}':
 * @property integer $id
 * @property string $firstName
 * @property string $email
 * @property integer $user_id
 */
class Staff extends CActiveRecord
{
	public $_logging = FALSE;
	public $passwordRepeat;
        private static $_items = array ();

	/**
	 * Returns the static model of the specified AR class.
	 * @return Staff the static model class
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
		return '{{staff}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('firstName, email, username, password, passwordRepeat', 'required'),
			array('firstName, email, username, password', 'length', 'max'=>255),
			array ('email','email'),
			array ('username','unique'),
			array('passwordRepeat', 'compare', 'compareAttribute'=>'password'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, firstName, email, username, password', 'safe', 'on'=>'search'),
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
			'firstName' => 'Имя',
			'email' => 'Email',
			'username' => 'Логин',
			'password' => 'Пароль',
			'passwordRepeat' => 'Повтор пароля',
			'lastLogin' => 'Последний вход',
			'lastLoginIp' => 'IP входа',
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
		$criteria->compare('firstName',$this->firstName,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('username',$this->username);
		$criteria->compare('password',$this->password);

		return new CActiveDataProvider(get_class($this), array(
			'criteria'=>$criteria,
                        'pagination' => array (
                            'pageSize' => Settings::item('adminPage'),
                        ),                                        
		));
	}

	public function beforeSave ()
	{
		if (parent::beforeSave ()) {
			if (!$this->_logging) {
				$this->password = UserIdentity::hash ($this->password);
			}
			return TRUE;
		} else {
			return FALSE;
		}
	}

        /*
         * Один оператор
         */
       	public static function item($staff_id)
	{
		if(empty(self::$_items))
			self::loadItems();
		return isset(self::$_items[$staff_id]) ? self::$_items[$staff_id] : false;
	}


	public static function items()
	{
		if(empty(self::$_items))
			self::loadItems();
		return self::$_items;
	}

	private static function loadItems()
	{
		self::$_items=array();
		$models=self::model()->findAll(array(		    
		));
		foreach($models as $model)
			self::$_items[$model->id]=$model->firstName;
	}

}