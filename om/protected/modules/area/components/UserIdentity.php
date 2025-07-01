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
		$record= AreaUser::model()->findByAttributes(array('username'=>$this->username));
		if($record===null)
			$this->errorCode=self::ERROR_USERNAME_INVALID;
		else if($record->password!==$this->password)
			$this->errorCode=self::ERROR_PASSWORD_INVALID;
		else
		{

                        if (!$record->area->active) {
                            throw new CHttpException(403, 'Извините, но данная закрытая зона отключена');
                        }

			$this->_id=$record->id;
			$this->setState('email', $record->email);
                        $this->setState('username', $record->username);
                        $this->setState('payTill', $record->payTill);
                        $this->setState('areaId', $record->area->id);
                        $this->setState('areaTitle', $record->area->title);
                        $this->setState('areaPaylist', $record->area->paylist);
			$this->errorCode=self::ERROR_NONE;

                        $record->lastLogin = time ();
                        $record->save (false,array('lastLogin'));

		}
		return !$this->errorCode;
	}

	public function getId()
	{
		return $this->_id;
	}
}


?>