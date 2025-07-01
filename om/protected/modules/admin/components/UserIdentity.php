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
		$record= Staff::model()->findByAttributes(array('username'=>$this->username));
		if($record===null)
			$this->errorCode=self::ERROR_USERNAME_INVALID;
		else if($record->password!==self::hash($this->password))
			$this->errorCode=self::ERROR_PASSWORD_INVALID;
		else
		{
			$this->_id=$record->id;
			$this->setState('firstName', $record->firstName);
			$this->setState('role', ($record->id == 1)?'admin':'staff');
			$this->errorCode=self::ERROR_NONE;

			//Делаем запись последней даты входа
			$record->_logging = TRUE;
			$record->lastLoginIp = Y::request()->userHostAddress;
			$record->lastLogin = time ();
			$record->save (FALSE, array('lastLoginIp','lastLogin'));

		}
		return !$this->errorCode;
	}

	public function getId()
	{
		return $this->_id;
	}

	public static function hash ($pass)
	{
		return md5($pass.'adminpassword'.Y::param('secretKey'));
	}
}


?>