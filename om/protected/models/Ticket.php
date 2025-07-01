<?php

/**
 * This is the model class for table "op1_ticket".
 *
 * The followings are the available columns in table 'op1_ticket':
 * @property string $id
 * @property integer $section_id
 * @property string $subject
 * @property string $message
 * @property string $firstName
 * @property string $email
 * @property integer $priority_id
 * @property integer $status_id
 * @property integer $createTime
 * @property integer $staff_id
 */
class Ticket extends CActiveRecord {
    const OPEN_STATUS = 1;
    const HOLD_STATUS = 2;
    const CLOSED_STATUS = 3;

    public $verifyCode;

    /**
     * Returns the static model of the specified AR class.
     * @return Ticket the static model class
     */
    public static function model($className=__CLASS__) {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return '{{ticket}}';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('section_id, subject, message, firstName, email, priority_id, verifyCode', 'required'),
            array('subject, message, firstName', 'safe'),
            array('section_id, priority_id, status_id, createTime, staff_id', 'numerical', 'integerOnly' => true),
            array('id', 'length', 'max' => 15),
            array('subject, firstName, email', 'length', 'max' => 255),
            array('message', 'length', 'max' => 15000),
            array('email', 'email'),
            array('verifyCode', 'captcha', 'allowEmpty' => !extension_loaded('gd')),
            array('file1, file2, file3, file4', 'file', 'allowEmpty' => TRUE,
                'wrongType' => 'Данный тип файлов не разрешён к загрузке',
                'types' => Settings::item('staffUploadExt'),
                'minSize' => 1, 'maxSize' => Settings::item('staffUploadMax')*1024),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('id, section_id, subject, message, firstName, email, priority_id, status_id, createTime, staff_id', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'answers' => array(self::HAS_MANY, 'TicketAnswer', 'ticket_id', 'order' => 'updateTime '.((Settings::item('staffReverse')==1)?'DESC':'ASC')),
            'answersCount' => array(self::STAT, 'TicketAnswer', 'ticket_id'),
            'staff' => array(self::BELONGS_TO, 'Staff', 'staff_id'),
            'section' => array(self::BELONGS_TO, 'TicketSection', 'section_id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'section_id' => 'Отдел',
            'subject' => 'Тема сообщения',
            'message' => 'Текст запроса',
            'firstName' => 'Ваше имя',
            'email' => 'E-mail',
            'priority_id' => 'Важность',
            'status_id' => 'Статус',
            'createTime' => 'Время создания',
            'updateTime' => 'Изменён',
            'staff_id' => 'Оператор',
            'verifyCode' => 'Код проверки',
            'file1' => 'Файл №1',
            'file2' => 'Файл №2',
            'file3' => 'Файл №3',
            'file4' => 'Файл №4',
        );
    }

    /**
     * Retrieves a list of models based on the current search/filter conditions.
     * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
     */
    public function search() {
        // Warning: Please modify the following code to remove attributes that
        // should not be searched.

        $criteria = new CDbCriteria;

        $criteria->compare('id', $this->id, true);
        $criteria->compare('section_id', $this->section_id);
        $criteria->compare('subject', $this->subject, true);
        $criteria->compare('message', $this->message, true);
        $criteria->compare('firstName', $this->firstName, true);
        $criteria->compare('email', $this->email, true);
        $criteria->compare('priority_id', $this->priority_id);
        $criteria->compare('status_id', $this->status_id);
        $criteria->compare('createTime', $this->createTime);
        $criteria->compare('staff_id', $this->staff_id);

        return new CActiveDataProvider(get_class($this), array(
            'criteria' => $criteria,
            'sort'=>array(
                'defaultOrder'=>'updateTime ASC',
            ),
            'pagination' => array (
                'pageSize' => Settings::item('staffPagination'),
            )
        ));
    }

    public static function hashTicket($ticketId) {
        return md5(Y::param('secretKey') . $ticketId . 'ticket');
    }

    /**
     * Ticket::beforeSave()
     * Назначает тикету оператора, ID, время создания
     *
     * @return
     */
    public function beforeSave() {
        //Для не новых записей
        if (!$this->isNewRecord) {
            $this->updateTime = time ();
            return parent::beforeSave ();
        }

        if (parent::beforeSave()) {

            //Случайный ID для тикета
            $ticket_id = H::random_string('lower', 12);

            //Проверка на уникальность
            while (Ticket::model()->find("id = '$ticket_id'") != NULL) {
                $ticket_id = H::random_string('lower', 12);
            }

            $this->id = $ticket_id;

            //Время
            $this->createTime = time ();
            //IP
            $this->ip = $_SERVER['REMOTE_ADDR'];

            //Статус - автоматически - открытый
            $this->status_id = Ticket::OPEN_STATUS;
            $this->staff_id = TicketSection::getDefaultStaff($this->section_id);
            $this->updateTime = $this->createTime;

            return TRUE;
        } else {
            return false;
        }
    }

    //Функция открывает тикет
    public function open() {
        $this->status_id = Ticket::OPEN_STATUS;
        $this->updateTime = time ();
        $this->save (FALSE);
    }

    //Функция закрывает тикет
    public function close() {
        $this->status_id = Ticket::CLOSED_STATUS;
        $this->update(array('status_id'));
    }

    /*
     * Функция определяет расширение файла
     */
    public static function findexts($filename) {
        $filename = strtolower($filename);
        $exts = explode ('.', $filename);
        $n = count($exts) - 1;
        $exts = $exts[$n];
        return strtoupper ($exts);
    }

}