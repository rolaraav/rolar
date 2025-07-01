<?php

/**
 * Класс для аутентификации партнёра
 *
 * @version $Id$
 * @copyright 2010
 */

class UserIdentity extends CUserIdentity
{
	private $_id;
	public function authenticate()
	{
		$record= Partner::model()->findByAttributes(array('id'=>$this->username));
		if($record===null)
			$this->errorCode=self::ERROR_USERNAME_INVALID;
		else if($record->password!==$this->password)
			$this->errorCode=self::ERROR_PASSWORD_INVALID;
		else
		{
			$this->_id=$record->id;
			$this->setState('title', $record->firstName);
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