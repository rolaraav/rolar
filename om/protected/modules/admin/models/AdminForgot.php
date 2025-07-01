<?php

class AdminForgot extends CFormModel
{
	public $id;
	public $email;
	public $verifyCode;

	/**
	 * Declares the validation rules.
	 */
	public function rules()
	{
		return array(
			// name, email, subject and body are required
			array('id, email', 'required'),
			array('id', 'length', 'max'=>50),
			array('email', 'length', 'max'=>120),
			array('email','email'),
			array('id','match','pattern' => '/^[a-z0-9]+$/', 'message' => 'RefID содержит недопустимые символы'),
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
			'id' => 'Логин',
			'email' => 'E-mail оператора',
			'verifyCode'=>'Код проверки',
		);
	}
}