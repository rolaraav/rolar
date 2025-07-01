<?php

/**
 * Класс для аутентификации пользователя закрытой зоны
 *
 * @version $Id$
 * @copyright 2010
 */

class UserIdentity extends CUserIdentity
{
	private $_id;
	public function authenticate()
	{
		$record = Author::model()->findByAttributes(array('id'=>$this->username));
		if($record===null)
			$this->errorCode=self::ERROR_USERNAME_INVALID;
		else if($record->password!==$this->password)
			$this->errorCode=self::ERROR_PASSWORD_INVALID;
		else
		{

			$this->_id=$record->id;
			$this->setState('email', $record->email);                        
                        $this->setState('firstName', $record->uname);
			$this->errorCode=self::ERROR_NONE;

		}
		return !$this->errorCode;
	}

	public function getId()
	{
		return $this->_id;
	}
}


?>