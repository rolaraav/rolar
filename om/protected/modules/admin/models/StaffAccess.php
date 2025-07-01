<?php

/**
 * This is the model class for table "{{staff_access}}".
 *
 * The followings are the available columns in table '{{staff_access}}':
 * @property integer $id
 * @property string $bill
 * @property string $order
 * @property string $partner
 * @property string $client
 * @property string $subscriber
 * @property string $author
 * @property string $area
 * @property string $securebook
 * @property string $payout
 * @property string $support
 * @property string $cupon
 * @property string $affnew
 * @property string $rass
 * @property string $country
 * @property string $departaments
 */
class StaffAccess extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return StaffAccess the static model class
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
		return '{{staff_access}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			//array('id, bill, order, partner, client, subscriber, author, area, securebook, payout, support, cupon, affnew, rass, country, departaments', 'required'),
			array('id', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, bill, order, partner, client, subscriber, author, area, securebook, payout, support, cupon, affnew, rass, country, departaments', 'safe', 'on'=>'search'),
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
			'staff' => array(self::BELONGS_TO, 'Staff', 'id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'bill' => 'Счета',
			'order' => 'Заказы',
			'partner' => 'Partner',
			'client' => 'Client',
			'subscriber' => 'Subscriber',
			'author' => 'Author',
			'area' => 'Area',			
			'payout' => 'Payout',
			'support' => 'Support',
			'cupon' => 'Cupon',
			'affnew' => 'Affnew',
			'rass' => 'Rass',
			'country' => 'Показать только страны',
			'departaments' => 'Departaments',
		);
	}

	public static function allowed ($act)
	{
		//Получаем ID пользователя
		$id = Y::user()->id;

		if (!is_numeric($id)) {
			return array('none');
		}

		//Если админ - ему всё разрешено
		if ($id == 1) {
			return array();
		}

		$model = StaffAccess::model()->findByPk ($id);

		if ($model!=NULL) {

			//Читаем права оператора
			if (isset($model->$act)) {
				$acts = $model->$act;
				if (!empty ($acts)) {

					//Получаем список
					return explode (',',$acts);
				}
			}

		}

		//Получаем список прав доступ
		return array ('none');
	}

}