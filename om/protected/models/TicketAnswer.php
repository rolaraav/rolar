<?php

/**
 * This is the model class for table "op1_ticket_answer".
 *
 * The followings are the available columns in table 'op1_ticket_answer':
 * @property string $id
 * @property string $ticket_id
 * @property string $kind
 * @property integer $staff_id
 * @property string $message
 * @property integer $updateTime
 * @property string $ip
 */
class TicketAnswer extends CActiveRecord
{
	public $verifyCode;
        public $status_id = Ticket::HOLD_STATUS;

	/**
	 * Returns the static model of the specified AR class.
	 * @return TicketAnswer the static model class
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
		return '{{ticket_answer}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('message', 'required'),
			array('staff_id, status_id, updateTime', 'numerical', 'integerOnly'=>true),
			array('id', 'length', 'max'=>20),

			array('verifyCode', 'captcha', 'allowEmpty'=>!extension_loaded('gd')),

            array('file1, file2', 'file', 'allowEmpty' => TRUE,
                'wrongType' => 'Данный тип файлов не разрешён к загрузке',
                'types' => Settings::item('staffUploadExt'),
                'minSize' => 1, 'maxSize' => Settings::item('staffUploadMax')*1024),

			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, ticket_id, kind, staff_id, message, updateTime, ip', 'safe', 'on'=>'search'),
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
			'ticket' => array(self::BELONGS_TO, 'Ticket', 'ticket_id'),
			'staff' => array(self::BELONGS_TO, 'Staff', 'staff_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'ticket_id' => 'Ticket',
			'kind' => 'Kind',
			'staff_id' => 'Staff',
			'message' => 'Сообщение',
			'updateTime' => 'Update Time',
			'ip' => 'Ip',
			'verifyCode' => 'Код проверки',
                        'file1'     => 'Вложенный файл №1',
                        'file2'     => 'Вложенный файл №2',
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
		$criteria->compare('ticket_id',$this->ticket_id,true);
		$criteria->compare('kind',$this->kind,true);
		$criteria->compare('staff_id',$this->staff_id);
		$criteria->compare('message',$this->message,true);
		$criteria->compare('updateTime',$this->updateTime);
		$criteria->compare('ip',$this->ip,true);

		return new CActiveDataProvider(get_class($this), array(
			'criteria'=>$criteria,
		));
	}


	public function beforeSave ()
	{
		//Для не новых записей
		if (!$this->isNewRecord) {
			return parent::beforeSave ();
		}

		$this->id = NULL;
		//Время
		$this->updateTime = time ();
		//IP
		$this->ip = $_SERVER['REMOTE_ADDR'];

		return parent::beforeSave();
	}

        /*
         * Применяет стили к цитатам в тексте
         */
        public function cytate ($text) {
            $text = str_replace ('[QUOTE]','<div class="cytated_text">',$text);
            $text = str_replace ('[/QUOTE]','</div>',$text);
            return $text;
        }

}