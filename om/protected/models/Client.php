<?php

/**
 * This is the model class for table "{{client}}".
 *
 * The followings are the available columns in table '{{client}}':
 * @property integer $id
 * @property string $good_id
 * @property string $uname
 * @property string $email
 * @property string $amail
 * @property integer $date
 * @property integer $subscribe
 * @property string $bill_id
 */
class Client extends CActiveRecord
{
        private $newclient;
	/**
	 * Returns the static model of the specified AR class.
	 * @return Client the static model class
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
		return '{{client}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('bill_id', 'required'),
			array('date, subscribe', 'numerical', 'integerOnly'=>true),
			array('good_id', 'length', 'max'=>50),
			array('uname, email, amail', 'length', 'max'=>250),
			array('bill_id', 'length', 'max'=>20),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, good_id, uname, email, amail, date, subscribe, bill_id', 'safe', 'on'=>'search'),
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
			'good_id' => 'Товар',
			'uname' => 'Имя',
			'email' => 'E-mail',
			'amail' => 'Другой e-mail',
			'date' => 'Дата',
			'subscribe' => 'Получать рассылку?',
			'bill_id' => 'Номер счёта',
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
		$criteria->compare('uname',$this->uname,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('amail',$this->amail,true);
		$criteria->compare('date',$this->date);
		$criteria->compare('subscribe',$this->subscribe);
		$criteria->compare('bill_id',$this->bill_id,true);

		return new CActiveDataProvider(get_class($this), array(
			'criteria'=>$criteria,
                        'pagination' => array (
                            'pageSize' => Settings::item('adminPgClient'),
                        ),                    
                        'sort' => array (
                            'defaultOrder' => 'date DESC',
                        ),
		));
	}
        
        public function beforeSave ()
        {
            $this->newclient = $this->isNewRecord;
            return parent::beforeSave ();
        }
        
        
        public function afterSave ()
        {
            if ($this->newclient) {
                $data = 'Добавлен новый клиент №'.$this->id.' для товара "'.$this->good_id.'" '."\r\n".'Имя клиента: "'.$this->uname.'"'."\r\n".'E-mail: '.$this->email.
                        "\r\n".'Счёт: '.$this->bill_id;
                Log::add ('newclient',$data,true);
            }
            return parent::afterSave ();
        }
}