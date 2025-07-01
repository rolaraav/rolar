<?php

/**
 * ContactForm class.
 * ContactForm is the data structure for keeping
 * contact form data. It is used by the 'contact' action of 'SiteController'.
 */
class NotifyForm extends CFormModel
{
	public $way;        
        public $message;                
	public $verifyCode;

	/**
	 * Declares the validation rules.
	 */
	public function rules()
	{
		return array(
			// name, email, subject and body are required
			array('way,message', 'required'),
                        array('way', 'length', 'max'=>255),
			array('message', 'length', 'max'=>2000),
                        array('message,way', 'safe'),
			// verifyCode needs to be entered correctly
			array('verifyCode', 'captcha', 'allowEmpty'=>!extension_loaded('gd')),
		);
	}

	/**
	 * Declares customized attribute labels.
	 * If not declared here, an attribute would have a label that is
	 * the same as its name with the first letter in upper case.
	 */
	public function attributeLabels()
	{
		return array(
                        'way' => 'Способ оплаты',
			'message' => 'Сообщение',
			'verifyCode'=>'Код проверки',
		);
	}
}