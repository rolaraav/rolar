<?php

/**
 * This is the model class for table "{{way}}".
 *
 * The followings are the available columns in table '{{way}}':
 * @property string $way_id
 * @property string $title
 * @property string $code
 */
class Way extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Way the static model class
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
		return '{{way}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('way_id', 'length', 'max'=>100),
			array('title', 'length', 'max'=>255),
			array('code', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('way_id, title, code', 'safe', 'on'=>'search'),
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
			'way_id' => 'Способ',
			'title' => 'Название',
			'code' => 'HTML-код',
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

		$criteria->compare('way_id',$this->way_id,true);
		$criteria->compare('title',$this->title,true);
		$criteria->compare('code',$this->code,true);

		return new CActiveDataProvider(get_class($this), array(
			'criteria'=>$criteria,
                        'pagination' => array (
                            'pageSize' => Settings::item('adminPage'),
                        ),                                        
		));
	}
        
        public static function repl ($code, $data) {
            
            foreach ($data as $key=>$one) {
                $code = str_replace ('{'.$key.'}',$one,$code);                
            }
            return $code;
            
        }
        
        //Функция относится только к шаблонам
        //Генерирует ссылку на редактирование шаблона
        public static function templ ($text, $tm, $module = 'main', $new = FALSE) {            
            
            if ($new!=FALSE) {
                return CHtml::link ($text,array('templates/edit?m='.$module.'&t='.$tm.'&n='.$new)).'<br><br>';
            } else {            
                return CHtml::link ($text,array('templates/edit?m='.$module.'&t='.$tm)).'<br><br>';
            }
            
        }
        
        
}